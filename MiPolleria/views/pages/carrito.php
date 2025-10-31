<?php require_once APPROOT . '/views/layouts/header.php'; ?>

<div class="carrito-container">
    <h1><?php echo $data['title']; ?></h1>

    <div class="carrito-content">
        <!-- SECCIÓN DE PRODUCTOS EN EL CARRITO -->
        <div class="productos-carrito" id="productos-carrito">
            <?php if (empty($data['productos'])) : ?>
                <p id="carrito-vacio">Tu carrito está vacío.</p>
            <?php else : ?>
                <?php foreach ($data['productos'] as $producto) : ?>
                    <div class="producto-item" data-product-id="<?php echo $producto->id; ?>">
                        <img src="<?php echo URLROOT; ?>/public/<?php echo htmlspecialchars($producto->imagen_url); ?>" alt="<?php echo htmlspecialchars($producto->nombre); ?>">
                        <div class="producto-info">
                            <p class="nombre"><?php echo htmlspecialchars($producto->nombre); ?></p>
                            <p class="precio">S/ <?php echo number_format($producto->precio, 2); ?></p>
                        </div>
                        <div class="producto-cantidad">
                            <button class="btn-restar" data-id="<?php echo $producto->id; ?>">-</button>
                            <input type="number" value="<?php echo $producto->cantidad; ?>" min="1" data-id="<?php echo $producto->id; ?>" readonly>
                            <button class="btn-sumar" data-id="<?php echo $producto->id; ?>">+</button>
                        </div>
                        <p class="subtotal-item">S/ <?php echo number_format($producto->precio * $producto->cantidad, 2); ?></p>
                        <button class="eliminar-item" data-id="<?php echo $producto->id; ?>">&times;</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- RESUMEN DEL PEDIDO -->
        <div class="resumen-carrito" id="resumen-carrito">
            <h2>Resumen del Pedido</h2>
            <p>Subtotal: S/ <span id="subtotal"><?php echo number_format($data['subtotal'], 2); ?></span></p>
            <p>Envío: S/ <span id="envio"><?php echo number_format($data['envio'], 2); ?></span></p>
            <hr>
            <p class="total">Total: <strong>S/ <span id="total"><?php echo number_format($data['total'], 2); ?></span></strong></p>
            <button class="pagar-btn" id="abrir-modal-pago">Proceder al Pago</button>
        </div>
    </div>
</div>

<!-- Contenedor para centrar el botón de volver -->
<div style="text-align: center; width: 100%;">
    <a href="<?php echo URLROOT; ?>/" class="volver-btn">← Volver al inicio</a>
</div>

<!-- MODAL DE CONFIRMACIÓN (REUTILIZABLE) -->
<div id="modal-confirmacion" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" id="cerrar-confirmacion">&times;</span>
        <h2 id="confirmacion-titulo"></h2>
        <p id="confirmacion-mensaje"></p>
        <div class="modal-botones">
            <button class="cancelar-btn" id="confirmacion-cancelar">Cancelar</button>
            <button class="confirmar-btn" id="confirmacion-aceptar">Aceptar</button>
        </div>
    </div>
</div>

<!-- MODAL DE BOLETA GENERADA -->
<div id="modal-boleta" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" id="cerrar-boleta">&times;</span>
        <h2>Boleta de Compra</h2>
        <div id="boleta-contenido">
            <p><strong>Ricos Chicken</strong></p>
            <p>Gracias por tu compra.</p>
            <hr>
            <div id="boleta-items">
                <!-- Los items se agregarán aquí con JS -->
            </div>
            <hr>
            <p><strong>Total:</strong> S/ <span id="total-boleta">0.00</span></p>
        </div>
        <div class="boleta-botones">
            <button class="imprimir-btn" id="imprimir-boleta">Imprimir</button>
            <button class="finalizar-btn" onclick="window.location.href='<?php echo URLROOT; ?>'">Finalizar</button>
        </div>
    </div>
</div>

<?php require_once APPROOT . '/views/layouts/footer.php'; ?>