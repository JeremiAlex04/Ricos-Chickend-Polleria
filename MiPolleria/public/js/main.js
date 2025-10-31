document.addEventListener('DOMContentLoaded', () => {

    const botonesAgregar = document.querySelectorAll('.boton-agregar');

    botonesAgregar.forEach(boton => {
        boton.addEventListener('click', function(e) {
            e.preventDefault();

            const productoId = this.dataset.id;
            
            if (!productoId) {
                console.error('El botón no tiene un data-id válido.');
                return;
            }

            this.textContent = 'Agregando...';
            this.disabled = true;
            this.style.backgroundColor = '#d35400';

            agregarAlCarrito(productoId, this);
        });
    });
});

/**
 * Envía el ID del producto al servidor usando fetch (AJAX).
 * @param {string} id
 * @param {HTMLElement} boton
 */
async function agregarAlCarrito(id, boton) {
    const url = `${URLROOT}/carrito/agregar`; 

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },

            body: JSON.stringify({ id: id }) 
        });

        const data = await response.json();

        if (response.ok && data.status === 'success') {
            console.log('Respuesta del servidor:', data.message);

            actualizarContadorCarrito(data.total_items);

            boton.textContent = '¡Agregado!';
            boton.style.backgroundColor = '#27ae60';

            setTimeout(() => {
                boton.textContent = 'Agregar al carrito';
                boton.style.backgroundColor = '#e67e22';
                boton.disabled = false;
            }, 1500);

        } else {
            console.error('Error del servidor:', data.message);
            alert('Error: ' + (data.message || 'No se pudo procesar la solicitud.'));
            revertirBoton(boton);
        }

    } catch (error) {
        console.error('Error de red o de fetch:', error);
        alert('No se pudo conectar con el servidor. Revisa tu conexión o la consola.');
        revertirBoton(boton);
    }
}

/**
 * Actualiza el número que se muestra en el ícono del carrito en la barra de navegación.
 * @param {number} totalItems
 */
function actualizarContadorCarrito(totalItems) {
    let contador = document.querySelector('.carrito-nav .cart-counter');

    if (!contador) {
        contador = document.createElement('span');
        contador.className = 'cart-counter';
        const carritoLink = document.querySelector('.carrito-nav a');
        if (carritoLink) {
            carritoLink.appendChild(contador);
        }
    }

    if (totalItems > 0) {
        contador.textContent = totalItems;
        contador.style.display = 'inline-flex';
    } else {
        contador.style.display = 'none';
    }
}

/**
 * Restaura el botón a su estado original en caso de error.
 * @param {HTMLElement} boton
 */
function revertirBoton(boton) {
    boton.textContent = 'Agregar al carrito';
    boton.style.backgroundColor = '#e67e22';
    boton.disabled = false;
}

const style = document.createElement('style');
style.textContent = `
    .carrito-nav a {
        position: relative;
        padding-right: 15px;
    }
    .cart-counter {
        background-color: #e63946;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        font-weight: bold;
        position: absolute;
        top: 0px;
        right: 0px;
        display: none; /* Oculto hasta que se añada el primer item */
        justify-content: center;
        align-items: center;
        border: 2px solid #222;
    }
`;
document.head.appendChild(style);