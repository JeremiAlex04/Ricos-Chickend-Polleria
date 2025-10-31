<?php require_once APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="product-table-container">
    <h3>Historial de Todos los Pedidos</h3>
    <table class="product-table">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['pedidos'])): ?>
                <tr><td colspan="6" style="text-align: center;">No hay pedidos registrados todavía.</td></tr>
            <?php else: ?>
                <?php foreach($data['pedidos'] as $pedido): ?>
                <tr>
                    <td>#<?php echo $pedido->id; ?></td>
                    <td><?php echo htmlspecialchars($pedido->nombre_cliente); ?></td>
                    <td><?php echo date('d/m/Y h:i A', strtotime($pedido->fecha)); ?></td>
                    <td>S/ <?php echo number_format($pedido->total, 2); ?></td>
                    <td>
                        <form action="<?php echo URLROOT; ?>/admin/cambiarEstadoPedido/<?php echo $pedido->id; ?>" method="post" class="form-estado">
                            <select name="estado" onchange="this.form.submit()">
                                <option value="Pendiente" <?php echo ($pedido->estado == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="Enviado" <?php echo ($pedido->estado == 'Enviado') ? 'selected' : ''; ?>>Enviado</option>
                                <option value="Completado" <?php echo ($pedido->estado == 'Completado') ? 'selected' : ''; ?>>Completado</option>
                                <option value="Cancelado" <?php echo ($pedido->estado == 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                            </select>
                            </form>
                    </td>
                    <td class="acciones">
                        <button class="btn-ver-detalle" onclick="verDetalle(<?php echo $pedido->id; ?>)">Ver Detalle</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<div id="detalle-pedido-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 id="detalle-titulo">Detalle del Pedido</h3>
            <button class="admin-modal-close" onclick="cerrarDetalleModal()">&times;</button>
        </div>
        <div class="admin-modal-body" id="detalle-cuerpo">
            </div>
    </div>
</div>

<script>
    const detalleModal = document.getElementById('detalle-pedido-modal');

    async function verDetalle(pedidoId) {
        const titulo = document.getElementById('detalle-titulo');
        const cuerpo = document.getElementById('detalle-cuerpo');
        titulo.innerText = 'Detalle del Pedido #' + pedidoId;
        cuerpo.innerHTML = '<p>Cargando detalles...</p>';
        detalleModal.style.display = 'flex';

        try {
            const response = await fetch('<?php echo URLROOT; ?>/admin/verDetallePedido/' + pedidoId);
            const detalles = await response.json();

            let html = '<ul>';
            if (detalles.length > 0) {
                detalles.forEach(item => {
                    html += `<li>${item.cantidad} x ${item.nombre_producto} (S/ ${parseFloat(item.precio_unitario).toFixed(2)})</li>`;
                });
            } else {
                html += '<li>No se encontraron detalles para este pedido.</li>';
            }
            html += '</ul>';
            cuerpo.innerHTML = html;

        } catch (error) {
            cuerpo.innerHTML = '<p>Error al cargar los detalles.</p>';
        }
    }

    function cerrarDetalleModal() {
        detalleModal.style.display = 'none';
    }
</script>

<style>
/* Estilos para la página de ver pedidos */
.status-pendiente {
    background-color: #ffc107;
    color: #333;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 700;
}
.btn-ver-detalle {
    background-color: #17a2b8;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
</style>

<?php require_once APPROOT . '/views/layouts/admin_footer.php'; ?>
