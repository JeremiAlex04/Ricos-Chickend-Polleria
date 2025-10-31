<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo isset($data['title']) ? $data['title'] : SITENAME; ?> - Ricos Chicken</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/styles.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/carrito.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/login.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/delivery.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/menu.css" />
    
</head>
<body>
    <nav class="navbar">
        <div class="logo">Ricos Chicken</div>
        <ul class="nav-links">
            <li><a href="<?php echo URLROOT; ?>/">Inicio</a></li>
            <li><a href="<?php echo URLROOT; ?>/producto/menu">Menú</a></li>
            <li><a href="<?php echo URLROOT; ?>/producto/index">Productos</a></li>
            <li><a href="<?php echo URLROOT; ?>/producto/ofertas">Ofertas</a></li>

            <li><a href="<?php echo URLROOT; ?>/pages/delivery">Delivery</a></li>
            <li><a href="<?php echo URLROOT; ?>/pages/contacto">Contacto</a></li>

            <?php if (isset($_SESSION['user_id'])) : ?>
                <li><a href="<?php echo URLROOT; ?>/auth/logout">Cerrar Sesión</a></li>
            <?php else : ?>
                <li><a href="<?php echo URLROOT; ?>/auth/login">Iniciar Sesion</a></li>
            <?php endif; ?>
            <li class="carrito-nav"><a href="<?php echo URLROOT; ?>/carrito/index"><i class="fa fa-shopping-cart"></i></a></li>
        </ul>
    </nav>
    <main>