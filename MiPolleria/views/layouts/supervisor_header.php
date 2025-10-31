<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> - Ricos Chicken</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin.css" />
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3>Ricos Chicken</h3>
                <p>Panel de Supervisor</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="<?php echo URLROOT; ?>/supervisor/index"><i class="fa fa-eye"></i> Ver Pedidos</a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <a href="<?php echo URLROOT; ?>/auth/logout" class="logout-btn"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>
            </div>
        </aside>
        <main class="main-content">
            <header class="main-header">
                <h2><?php echo $data['title']; ?></h2>
                <p>Bienvenido, <?php echo htmlspecialchars($data['nombre_usuario']); ?></p>
            </header>
            <div class="content-body">
