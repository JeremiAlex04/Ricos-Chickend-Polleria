<?php require_once APPROOT . '/views/layouts/header.php'; ?>

<!-- Enlace al nuevo archivo CSS específico para esta página -->
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/delivery.css" />

<div class="delivery-wrapper">
    <i class="fa fa-motorcycle icon-header"></i>
    <h1>Servicio de Delivery</h1>
    <p class="subtitulo">¿Antojo de un delicioso pollo a la brasa? ¡Llevamos el sabor de Ricos Chicken hasta la puerta de tu casa!</p>

    <!-- Sección de Pasos -->
    <div class="delivery-seccion">
        <h2>¿Cómo hacer tu pedido?</h2>
        <div class="delivery-pasos">
            <div class="paso">
                <span class="numero">1</span>
                <p>Consulta nuestro <a href="<?php echo URLROOT; ?>/producto/menu">menú en línea</a> y elige tus platos favoritos.</p>
            </div>
            <div class="paso">
                <span class="numero">2</span>
                <p>Comunícate al <strong>(01) 123-4567</strong> o escríbenos por <strong>WhatsApp</strong> para tomar tu orden.</p>
            </div>
            <div class="paso">
                <span class="numero">3</span>
                <p>¡Relájate y espera tu pedido! Llegaremos lo más pronto posible a la puerta de tu casa.</p>
            </div>
        </div>
    </div>

    <!-- Sección de Zonas de Cobertura -->
    <div class="delivery-seccion">
        <h2>Zonas de Cobertura</h2>
        <ul class="zonas-lista">
            <li><i class="fa fa-map-marker"></i> Lima Centro</li>
            <li><i class="fa fa-map-marker"></i> San Miguel</li>
            <li><i class="fa fa-map-marker"></i> Pueblo Libre</li>
            <li><i class="fa fa-map-marker"></i> Jesús María</li>
            <!-- Puedes añadir más zonas fácilmente -->
        </ul>
    </div>

    <a href="<?php echo URLROOT; ?>/" class="volver-btn">← Volver al inicio</a>
</div>

<!-- El botón flotante de WhatsApp se mantiene igual -->
<a href="https://wa.me/51924834338?text=Hola,%20deseo%20hacer%20un%20pedido%20por%20delivery"
   class="float-wa"
   target="_blank"
   rel="noopener noreferrer"
   aria-label="Contáctanos por WhatsApp">
    <i class="fa fa-whatsapp" aria-hidden="true"></i>
</a>

<?php require_once APPROOT . '/views/layouts/footer.php'; ?>