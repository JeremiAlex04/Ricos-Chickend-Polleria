<?php 
// Incluimos la cabecera (Navbar, <head>, etc.)
require_once APPROOT . '/views/layouts/header.php'; 
?>

<!-- CONTENIDO PRINCIPAL DE LA PÁGINA DE OFERTAS -->
<section class="ofertas">
    <div class="container">
        <h1><?php echo $data['title']; ?></h1>
        <p>¡Aprovecha nuestras promociones por tiempo limitado!</p>
        <div class="cards">
            <?php if (!empty($data['productos'])) : ?>
                <?php foreach ($data['productos'] as $oferta) : ?>
                    <div class="card">
                        <img src="<?php echo URLROOT; ?>/public/<?php echo htmlspecialchars($oferta->imagen_url); ?>" alt="<?php echo htmlspecialchars($oferta->nombre); ?>">
                        <h3><?php echo htmlspecialchars($oferta->nombre); ?></h3>
                        <p><?php echo htmlspecialchars($oferta->descripcion); ?></p>
                        <div>
                            <span class="precio-antes">S/ <?php echo number_format($oferta->precio, 2); ?></span>
                            <span class="precio-oferta">S/ <?php echo number_format($oferta->precio_oferta, 2); ?></span>
                        </div>
                        <a class="boton-agregar" href="#" data-id="<?php echo $oferta->id; ?>">Agregar al carrito</a>
                        <a href="https://wa.me/51924834338?text=Hola, Me interesa la oferta: <?php echo urlencode($oferta->nombre); ?>" target="_blank" rel="noopener" class="whatsapp-btn"><i class="fa fa-whatsapp"></i> Pedir por Whatsapp</a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No hay ofertas disponibles en este momento.</p>
            <?php endif; ?>
        </div>
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