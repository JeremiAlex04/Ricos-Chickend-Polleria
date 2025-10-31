<?php require_once APPROOT . '/views/layouts/admin_header.php'; ?>

<button class="btn-agregar-nuevo" onclick="abrirModalProducto()">
    <i class="fa fa-plus"></i> Agregar Nuevo Producto
</button>

<div class="product-table-container">
    <h3>Productos Existentes</h3>
    <table class="product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['productos'] as $producto): ?>
            <tr class="<?php echo ($producto->activo == 0) ? 'producto-inactivo' : ''; ?>">
                <td><?php echo $producto->id; ?></td>
                <td><?php echo htmlspecialchars($producto->nombre); ?></td>
                <td>S/ <?php echo number_format($producto->precio, 2); ?></td>
                <td><?php echo htmlspecialchars($producto->categoria); ?></td>
                <td>
                    <?php if ($producto->activo == 1): ?>
                        <span class="status-activo">Activo</span>
                    <?php else: ?>
                        <span class="status-inactivo">Inactivo</span>
                    <?php endif; ?>
                </td>
                <td class="acciones">
                    <button class="btn-editar" onclick='abrirModalProducto(<?php echo json_encode($producto); ?>)'>Editar</button>
                    <?php if ($producto->activo == 1): ?>
                        <button class="btn-desactivar" onclick="abrirModalConfirmacion('Desactivar Producto', '¿Estás seguro de que quieres DESACTIVAR este producto?', '<?php echo URLROOT; ?>/admin/desactivarProducto/<?php echo $producto->id; ?>')">Desactivar</button>
                    <?php else: ?>
                        <button class="btn-reactivar" onclick="abrirModalConfirmacion('Reactivar Producto', '¿Estás seguro de que quieres REACTIVAR este producto?', '<?php echo URLROOT; ?>/admin/reactivarProducto/<?php echo $producto->id; ?>')">Reactivar</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="producto-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 id="modal-titulo"></h3>
            <button class="admin-modal-close" onclick="cerrarModalProducto()">&times;</button>
        </div>
        <form action="<?php echo URLROOT; ?>/admin/gestionarProductos" method="post" id="product-form">
            <input type="hidden" name="id" id="producto-id">
            <div class="form-row">
                <div class="form-group"><label for="nombre">Nombre:</label><input type="text" name="nombre" id="nombre" required></div>
                <div class="form-group"><label for="precio">Precio (S/):</label><input type="number" step="0.01" name="precio" id="precio" required></div>
            </div>
            <div class="form-group"><label for="descripcion">Descripción:</label><textarea name="descripcion" id="descripcion" rows="3" required></textarea></div>
            <div class="form-row">
                <div class="form-group"><label for="categoria">Categoría:</label><input type="text" name="categoria" id="categoria" required></div>
                <div class="form-group"><label for="imagen_url">URL de Imagen:</label><input type="text" name="imagen_url" id="imagen_url" placeholder="ej: images/nuevo.png"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label for="precio_oferta">Precio Oferta (S/):</label><input type="number" step="0.01" name="precio_oferta" id="precio_oferta"></div>
                <div class="form-group checkbox-group"><input type="checkbox" name="es_oferta" id="es_oferta" value="1"><label for="es_oferta">¿Es Oferta?</label></div>
                <div class="form-group checkbox-group"><input type="checkbox" name="es_popular" id="es_popular" value="1"><label for="es_popular">¿Es Popular?</label></div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="btn-limpiar" onclick="cerrarModalProducto()">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<div id="confirmacion-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 id="confirmacion-titulo"></h3>
            <button class="admin-modal-close" onclick="cerrarModalConfirmacion()">&times;</button>
        </div>
        <div class="admin-modal-body">
            <p id="confirmacion-mensaje"></p>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="btn-limpiar" onclick="cerrarModalConfirmacion()">Cancelar</button>
            <form id="form-confirmacion" action="" method="post">
                <button type="submit" class="btn-eliminar">Sí, Continuar</button>
            </form>
        </div>
    </div>
</div>

<script>
    const productoModal = document.getElementById('producto-modal');
    const confirmacionModal = document.getElementById('confirmacion-modal');

    function abrirModalProducto(producto = null) {
        const form = document.getElementById('product-form');
        const titulo = document.getElementById('modal-titulo');
        form.reset();
        document.getElementById('producto-id').value = '';

        if (producto) {
            titulo.innerText = 'Editando Producto: ' + producto.nombre;
            document.getElementById('producto-id').value = producto.id;
            document.getElementById('nombre').value = producto.nombre;
            document.getElementById('descripcion').value = producto.descripcion;
            document.getElementById('precio').value = producto.precio;
            document.getElementById('categoria').value = producto.categoria;
            document.getElementById('imagen_url').value = producto.imagen_url;
            document.getElementById('precio_oferta').value = producto.precio_oferta;
            document.getElementById('es_oferta').checked = !!parseInt(producto.es_oferta);
            document.getElementById('es_popular').checked = !!parseInt(producto.es_popular);
        } else {
            titulo.innerText = 'Agregar Nuevo Producto';
        }
        productoModal.style.display = 'flex';
    }

    function cerrarModalProducto() {
        productoModal.style.display = 'none';
    }

    function abrirModalConfirmacion(titulo, mensaje, url) {
        document.getElementById('confirmacion-titulo').innerText = titulo;
        document.getElementById('confirmacion-mensaje').innerText = mensaje;
        document.getElementById('form-confirmacion').action = url;
        confirmacionModal.style.display = 'flex';
    }

    function cerrarModalConfirmacion() {
        confirmacionModal.style.display = 'none';
    }
</script>

<?php require_once APPROOT . '/views/layouts/admin_footer.php'; ?>