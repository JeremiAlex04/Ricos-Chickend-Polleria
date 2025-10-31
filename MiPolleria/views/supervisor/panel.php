<?php
require_once APPROOT . '/views/layouts/supervisor_header.php';
?>
<div class="product-table-container">
    <h3>Pedidos Recibidos</h3>
    <p>A continuación se muestra la lista de todos los pedidos realizados por los clientes.</p>
    <br>
    <table class="product-table">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['pedidos'])): ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No hay pedidos registrados todavía.</td>
                </tr>
            <?php else: ?>
                <?php foreach($data['pedidos'] as $pedido): ?>
                <tr>
                    <td>#<?php echo $pedido->id; ?></td>
                    <td><?php echo htmlspecialchars($pedido->nombre_cliente); ?></td>
                    <td><?php echo date('d/m/Y h:i A', strtotime($pedido->fecha)); ?></td>
                    <td>S/ <?php echo number_format($pedido->total, 2); ?></td>
                    <td>
                        <span class="status-pendiente"><?php echo htmlspecialchars($pedido->estado); ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
.status-pendiente {
    background-color: #ffc107;
    color: #333;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 700;
}
</style>

<?php
require_once APPROOT . '/views/layouts/supervisor_footer.php';
?>
