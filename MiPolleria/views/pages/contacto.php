<?php 
require_once APPROOT . '/views/layouts/header.php'; 
?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/contacto.css" />

<?php if (isset($_SESSION['user_id'])) : ?>
    <div class="contact-wrapper">
        <div class="contact-form-section">
            <h1>Déjanos tu Mensaje</h1>
            <p class="subtitulo">Nos pondremos en contacto contigo a la brevedad.</p>

            <form class="formulario-contacto" id="formulario-contacto">
                <div class="input-group">
                    <input type="text" id="contact-nombre" placeholder="Tu nombre" required value="" />
                </div>
                <div class="input-group">
                    <!-- Rellenamos el email del usuario en sesión y lo hacemos de solo lectura -->
                    <input type="email" id="contact-email" placeholder="Tu correo electrónico" required value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" readonly />
                </div>
                <div class="input-group">
                    <textarea id="contact-mensaje" placeholder="Escribe tu mensaje aquí..." rows="6" required></textarea>
                </div>
                <button type="submit">Enviar Mensaje por WhatsApp</button>
            </form>
        </div>

        <!-- Columna Derecha: Información Adicional -->
        <aside class="contact-info-section">
            <h2>Más Formas de Contacto</h2>
            <div class="info-item">
                <i class="fa fa-phone"></i>
                <p>(01) 123-4567</p>
            </div>
            <div class="info-item">
                <i class="fa fa-whatsapp"></i>
                <p>+51 924 834 338</p>
            </div>
            <div class="info-item">
                <i class="fa fa-envelope"></i>
                <p>pedidos@ricoschicken.com</p>
            </div>
            <div class="info-item">
                <i class="fa fa-map-marker"></i>
                <p>Av. Delicias #123, Lima, Perú</p>
            </div>
            <div class="mapa-contacto">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3904.7638406515457!2d-77.0862860147847!3d-11.851797412678746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105d73269e2d375%3A0xa245ee2c5f64484c!2sRIKOS%20CHIKEN!5e0!3m2!1ses!2spe!4v1748208772537!5m2!1ses!2spe" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </aside>

    </div>

<?php else : ?>

    <!-- VISTA PARA USUARIOS NO LOGUEADOS -->
    <div class="login-requerido">
        <h2><i class="fa fa-lock"></i> Contenido Protegido</h2>
        <p>Para enviar un mensaje, primero debes iniciar sesión en tu cuenta.</p>
        <a href="<?php echo URLROOT; ?>/auth/login" class="btn-login">Iniciar Sesión</a>
    </div>

<?php endif; ?>

<!-- Script para manejar el formulario (solo se activa si el formulario existe) -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const formulario = document.getElementById('formulario-contacto');

    if(formulario) {
        formulario.addEventListener('submit', function(e) {
            e.preventDefault();

            const nombre = document.getElementById('contact-nombre').value;
            const email = document.getElementById('contact-email').value;
            const mensaje = document.getElementById('contact-mensaje').value;
            
            const tuNumero = '51924834338'; 
            const textoWhatsApp = `¡Hola! Soy ${nombre} (${email}).\n\nMensaje:\n${mensaje}`;
            const textoCodificado = encodeURIComponent(textoWhatsApp);
            const urlWhatsApp = `https://wa.me/${tuNumero}?text=${textoCodificado}`;
            
            window.open(urlWhatsApp, '_blank');
        });
    }
});
</script>

<?php 
// Incluimos el pie de página (Footer, scripts, etc.)
require_once APPROOT . '/views/layouts/footer.php'; 
?>