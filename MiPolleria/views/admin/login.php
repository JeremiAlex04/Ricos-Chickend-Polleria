<?php require_once APPROOT . '/views/layouts/header.php'; ?>
<!-- Enlace a la nueva hoja de estilos para el login -->
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/login.css" />

<div class="login-page-wrapper">
    <div class="login-container">
        <!-- Columna de Imagen Decorativa -->
        <div class="login-image-section"></div>

        <!-- Columna de Formulario -->
        <div class="login-form-section">
            <h2>Bienvenido a Ricos Chicken</h2>
            <p class="subtitulo">Ingresa tus credenciales para continuar.</p>
            
            <div class="info-credenciales">
                <p><strong>Datos de Prueba (Contraseña: 12345)</strong></p>
                <p><strong>Super Admin:</strong> superadmin@ricoschicken.com</p>
                <p><strong>Administrador:</strong> admin@ricoschicken.com</p>
                <p><strong>Supervisor:</strong> supervisor@ricoschicken.com</p>
                <p><strong>Cliente:</strong> cliente@ricoschicken.com</p>
            </div>

            <form class="formulario-login" action="<?php echo URLROOT; ?>/auth/login" method="POST">
                <!-- Mostrar mensaje de error si existe -->
                <?php if (!empty($data['error'])) : ?>
                    <div class="error-mensaje"><?php echo $data['error']; ?></div>
                <?php endif; ?>
                
                <input type="email" name="email" placeholder="Correo Electrónico" required value="<?php echo htmlspecialchars($data['email']); ?>">
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <a href="<?php echo URLROOT; ?>/" class="login-volver-btn">← Volver a la página principal</a>
        </div>
    </div>
</div>

<?php require_once APPROOT . '/views/layouts/footer.php'; ?>