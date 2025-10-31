document.addEventListener('DOMContentLoaded', () => {

    const carritoContainer = document.querySelector('.carrito-container');

    if (carritoContainer) {
        carritoContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-sumar')) {
                actualizarCantidad(e.target.dataset.id, 'sumar');
            }
            if (e.target.classList.contains('btn-restar')) {
                actualizarCantidad(e.target.dataset.id, 'restar');
            }
            if (e.target.classList.contains('eliminar-item')) {
                const id = e.target.dataset.id;
                mostrarConfirmacion(
                    'Eliminar Producto',
                    '¿Estás seguro de que quieres eliminar este producto del carrito?', 
                    () => eliminarProducto(id)
                );
            }
        });
    }

    // --- MANEJO DE MODALES ---
    const modalConfirmacion = document.getElementById('modal-confirmacion');
    const cerrarConfirmacion = document.getElementById('cerrar-confirmacion');
    const btnConfirmar = document.getElementById('confirmacion-aceptar');
    const btnCancelar = document.getElementById('confirmacion-cancelar');
    const tituloConfirmacion = document.getElementById('confirmacion-titulo');
    const mensajeConfirmacion = document.getElementById('confirmacion-mensaje');

    const modalBoleta = document.getElementById('modal-boleta');
    const cerrarBoleta = document.getElementById('cerrar-boleta');
    const totalBoleta = document.getElementById('total-boleta');
    const boletaItems = document.getElementById('boleta-items');
    const imprimirBoletaBtn = document.getElementById('imprimir-boleta');
    const finalizarBoletaBtn = document.getElementById('boleta-finalizar');

    const abrirModalPagoBtn = document.getElementById('abrir-modal-pago');
    if (abrirModalPagoBtn) {
        abrirModalPagoBtn.onclick = () => {
            const totalElement = document.getElementById('total');
            if (totalElement) {
                const totalValue = parseFloat(totalElement.textContent);
                if (totalValue > 0) {
                    mostrarConfirmacion(
                        'Confirmar Pedido',
                        '¿Estás seguro de que quieres realizar este pedido?',
                        () => procesarPedido() // La acción a confirmar es procesar el pedido
                    );
                } else {
                    mostrarConfirmacion('Carrito Vacío', 'Tu carrito está vacío. Agrega productos antes de continuar.', null, true);
                }
            }
        };
    }

    if (cerrarConfirmacion) cerrarConfirmacion.onclick = () => modalConfirmacion.style.display = 'none';
    if (btnCancelar) btnCancelar.onclick = () => modalConfirmacion.style.display = 'none';
    if (cerrarBoleta) cerrarBoleta.onclick = () => modalBoleta.style.display = 'none';
    if (imprimirBoletaBtn) imprimirBoletaBtn.onclick = () => window.print();
    
    if(finalizarBoletaBtn) {
        finalizarBoletaBtn.onclick = () => {
            window.location.href = URLROOT;
        };
    }

    let accionConfirmada = null;
    function mostrarConfirmacion(titulo, mensaje, callback, soloInfo = false) {
        if(tituloConfirmacion) tituloConfirmacion.textContent = titulo;
        if(mensajeConfirmacion) mensajeConfirmacion.textContent = mensaje;
        accionConfirmada = callback;
        
        if (soloInfo) {
            if(btnConfirmar) btnConfirmar.style.display = 'none';
            if(btnCancelar) btnCancelar.textContent = 'Cerrar';
        } else {
            if(btnConfirmar) btnConfirmar.style.display = 'inline-block';
            if(btnCancelar) btnCancelar.textContent = 'Cancelar';
        }
        if(modalConfirmacion) modalConfirmacion.style.display = 'flex';
    }

    if(btnConfirmar) {
        btnConfirmar.onclick = () => {
            if (typeof accionConfirmada === 'function') {
                accionConfirmada();
            }
            if(modalConfirmacion) modalConfirmacion.style.display = 'none';
        };
    }

    /**
     * Llama al backend para guardar el pedido y LUEGO muestra la boleta.
     */
    async function procesarPedido() {
        try {
            const response = await fetch(`${URLROOT}/carrito/procesar`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
                body: JSON.stringify({}) // No se envía cuerpo, la info está en la sesión del servidor
            });

            const data = await response.json();

            if (data.status === 'success') {
                mostrarBoleta();
            } else {
                alert('Error al procesar el pedido: ' + data.message);
            }
        } catch (error) {
            console.error('Error de red:', error);
            alert('No se pudo conectar con el servidor para procesar el pedido.');
        }
    }

    /**
     * Rellena la boleta con los datos del carrito y la muestra.
     */
    function mostrarBoleta() {
        const totalFinal = document.getElementById('total').textContent;
        if(totalBoleta) totalBoleta.textContent = totalFinal;
        if(boletaItems) boletaItems.innerHTML = '';
        
        const productosEnCarrito = document.querySelectorAll('.producto-item');
        
        productosEnCarrito.forEach(producto => {
            const nombre = producto.querySelector('.nombre').textContent;
            const cantidad = producto.querySelector('.producto-cantidad input').value;
            const subtotalItem = producto.querySelector('.subtotal-item').textContent;
            const itemHTML = `<p>${cantidad} x ${nombre} - <strong>${subtotalItem}</strong></p>`;
            if(boletaItems) boletaItems.innerHTML += itemHTML;
        });

        if(modalBoleta) modalBoleta.style.display = 'flex';
    }
});

// --- FUNCIONES ASÍNCRONAS PARA ACTUALIZAR Y ELIMINAR (AJAX) ---

async function actualizarCantidad(id, operacion) {
    try {
        const response = await fetch(`${URLROOT}/carrito/actualizar`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            body: JSON.stringify({ id: id, operacion: operacion })
        });
        const data = await response.json();
        if (data.status === 'success') {
            window.location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    } catch (error) {
        alert('Hubo un problema al actualizar el carrito.');
    }
}

async function eliminarProducto(id) {
    try {
        const response = await fetch(`${URLROOT}/carrito/eliminar`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            body: JSON.stringify({ id: id })
        });
        const data = await response.json();
        if (data.status === 'success') {
            window.location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    } catch (error) {
        alert('Hubo un problema al eliminar el producto.');
    }
}
