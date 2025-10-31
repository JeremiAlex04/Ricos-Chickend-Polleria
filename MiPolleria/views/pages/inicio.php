<?php require_once APPROOT . '/views/layouts/header.php'; ?>

<header class="hero">
    <div class="hero-content">
        <h1>¡El mejor pollo a la brasa de la ciudad!</h1>
        <p>Sabor, tradición y calidad en cada porción.</p>
        <a href="<?php echo URLROOT; ?>/producto/menu" class="btn">Ver Menú</a>
    </div>
</header>

<!-- SECCIÓN DE OFERTAS DINÁMICA -->
<section class="ofertas">
    <h2>Ofertas del Día</h2>
    <div class="cards">
        <?php if (!empty($data['ofertas'])) : ?>
            <?php foreach ($data['ofertas'] as $oferta) : ?>
                <div class="card">
                    <img src="<?php echo URLROOT; ?>/public/<?php echo htmlspecialchars($oferta->imagen_url); ?>" alt="<?php echo htmlspecialchars($oferta->nombre); ?>">
                    <h3><?php echo htmlspecialchars($oferta->nombre); ?></h3>
                    <p><?php echo htmlspecialchars($oferta->descripcion); ?></p>
                    <div>
                        <span class="precio-antes">S/ <?php echo number_format($oferta->precio, 2); ?></span>
                        <span class="precio-oferta">S/ <?php echo number_format($oferta->precio_oferta, 2); ?></span>
                    </div>
                    <a class="boton-agregar" href="#" data-id="<?php echo $oferta->id; ?>">Agregar al carrito</a>
                    <a href="https://wa.me/51924834338?text=Hola, Me interesa la oferta: <?php echo urlencode($oferta->nombre); ?>" target="_blank" rel="noopener" class="whatsapp-btn">
                        <i class="fa fa-whatsapp"></i> Pedir por Whatsapp</a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No hay ofertas disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</section>

<!-- SECCIÓN DE POPULARES DINÁMICA -->
<section class="productos">
    <h2>Productos Populares</h2>
    <div class="cards">
        <?php if (!empty($data['populares'])) : ?>
            <?php foreach ($data['populares'] as $popular) : ?>
                <div class="card">
                    <img src="<?php echo URLROOT; ?>/public/<?php echo htmlspecialchars($popular->imagen_url); ?>" alt="<?php echo htmlspecialchars($popular->nombre); ?>">
                    <h3><?php echo htmlspecialchars($popular->nombre); ?></h3>
                    <p><?php echo htmlspecialchars($popular->descripcion); ?></p>
                    <span>S/ <?php echo number_format($popular->precio, 2); ?></span>
                    <a class="boton-agregar" href="#" data-id="<?php echo $popular->id; ?>">Agregar al carrito</a>
                    <a href="https://wa.me/51924834338?text=Hola, Me interesa el producto: <?php echo urlencode($popular->nombre); ?>" target="_blank" rel="noopener" class="whatsapp-btn">
                        <i class="fa fa-whatsapp"></i> Pedir por Whatsapp</a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No hay productos populares destacados.</p>
        <?php endif; ?>
    </div>
</section>

<section class="ubicacion">
    <h2>Ubícanos aquí</h2>
    <p>Estamos en una zona de fácil acceso. ¡Te esperamos!</p>
    <div class="mapa-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3904.7638406515457!2d-77.0862860147847!3d-11.851797412678746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105d73269e2d375%3A0xa245ee2c5f64484c!2sRIKOS%20CHIKEN!5e0!3m2!1ses!2spe!4v1748208772537!5m2!1ses!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<a href="https://wa.me/51924834338?text=Hola, deseo pedir algo" class="float-wa" target="_blank" rel="noopener" title="Contáctanos por WhatsApp">
    <i class="fa fa-whatsapp" aria-hidden="true"></i>
</a>

<?php require_once APPROOT . '/views/layouts/footer.php'; ?>