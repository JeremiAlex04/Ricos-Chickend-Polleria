<?php 
// Incluimos la cabecera (Navbar, <head>, etc.)
require_once APPROOT . '/views/layouts/header.php'; 
?>

<!-- SECCIÓN DEL MENÚ -->
<section class="menu-section" style="padding: 3rem 2rem;">
    <div class="container">
        <h1><?php echo htmlspecialchars($data['title']); ?></h1>
        
        <?php if (!empty($data['productos'])) : ?>
            <div class="cards">
                <?php foreach ($data['productos'] as $producto) : ?>
                    <div class="card">
                        <img src="<?php echo URLROOT; ?>/public/<?php echo htmlspecialchars($producto->imagen_url); ?>" alt="<?php echo htmlspecialchars($producto->nombre); ?>">
                        <h3><?php echo htmlspecialchars($producto->nombre); ?></h3>
                        <p><?php echo htmlspecialchars($producto->descripcion); ?></p>
                        <?php if ($producto->es_oferta && !is_null($producto->precio_oferta)) : ?>
                            <div>
                                <span class="precio-antes">S/ <?php echo number_format($producto->precio, 2); ?></span>
                                <span class="precio-oferta">S/ <?php echo number_format($producto->precio_oferta, 2); ?></span>
                            </div>
                        <?php else : ?>
                            <span>S/ <?php echo number_format($producto->precio, 2); ?></span>
                        <?php endif; ?>
                        <a class="boton-agregar" href="#" data-id="<?php echo $producto->id; ?>">Agregar al carrito</a>
                        <a href="https://wa.me/51924834338?text=Hola, Me interesa el producto: <?php echo urlencode($producto->nombre); ?>" target="_blank" rel="noopener" class="whatsapp-btn">
                            <i class="fa fa-whatsapp"></i> Pedir por Whatsapp
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p style="margin-top: 2rem; font-size: 1.2rem;">No hay productos disponibles en el menú en este momento.</p>
        <?php endif; ?>

        <a href="<?php echo URLROOT; ?>/" class="volver-btn">← Volver al inicio</a>
    </div>
</section>

<!-- BOTÓN WHATSAPP FLOTANTE -->
<a href="https://wa.me/51924834338?text=Hola, deseo pedir algo" class="float-wa" target="_blank" rel="noopener" title="Contáctanos por WhatsApp">
    <i class="fa fa-whatsapp" style="margin-top:16px;" aria-hidden="true"></i>
</a>

<?php 
// Incluimos el pie de página (Footer, scripts, etc.)
require_once APPROOT . '/views/layouts/footer.php'; 
?>
