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
                <p>Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="<?php echo URLROOT; ?>/admin/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                    <li><a href="<?php echo URLROOT; ?>/admin/gestionarProductos"><i class="fa fa-cutlery"></i> Gestionar Productos</a></li>
                    <li><a href="<?php echo URLROOT; ?>/admin/verPedidos"><i class="fa fa-shopping-bag"></i> Ver Pedidos</a></li>
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