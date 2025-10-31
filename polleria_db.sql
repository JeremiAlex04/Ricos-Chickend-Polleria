-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2025 a las 10:13:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `polleria_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 1, 'Combo Familiar', 1, 69.90),
(2, 2, 4, 'Pollo a la Brasa Entero', 1, 45.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(50) NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `nombre_cliente`, `total`, `fecha`, `estado`) VALUES
(1, 4, 'Carlos Cliente', 74.90, '2025-07-14 07:51:27', 'Completado'),
(2, NULL, 'Cliente Invitado', 50.00, '2025-07-14 08:10:20', 'Completado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) NOT NULL,
  `es_oferta` tinyint(1) NOT NULL DEFAULT 0,
  `precio_oferta` decimal(10,2) DEFAULT NULL,
  `es_popular` tinyint(1) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen_url`, `categoria`, `es_oferta`, `precio_oferta`, `es_popular`, `activo`) VALUES
(1, 'Combo Familiar', '1 Pollo + Papas + Ensalada + Chaufa + Gaseosa 1.5L', 69.90, 'images/combo_familiar.png', 'Combos', 1, 59.90, 1, 1),
(2, '1/2 Pollo + Papas', 'Ideal para una persona con hambre de verdad.', 29.90, 'images/medio_pollo.png', 'Pollos', 1, 24.90, 1, 1),
(3, 'Cuarto de Pollo', 'Perfecto para el almuerzo diario. ¡Disfrútalo!', 19.90, 'images/cuarto_pollo.png', 'Pollos', 1, 15.90, 0, 1),
(4, 'Pollo a la Brasa Entero', 'Pollo jugoso cocinado a la leña, ideal para compartir.', 45.00, 'images/pollo_brasa.png', 'Pollos', 0, NULL, 1, 1),
(5, 'Papas Crocantes', 'Papas fritas doradas y crujientes acompañadas de salsas.', 9.90, 'images/papassss.png', 'Acompañamientos', 0, NULL, 1, 1),
(6, 'Gaseosa 1.5L', 'Bebida refrescante para acompañar tu comida (Inca Kola o Coca-Cola).', 8.00, 'images/gaseosas.png', 'Bebidas', 0, NULL, 0, 1),
(7, 'Anticuchos de Corazón', '2 palitos de tiernos trozos de corazón de res marinado en ají panca.', 18.00, 'images/Anticuchos.png', 'Parrillas', 0, NULL, 1, 1),
(8, 'Chaufa de Pollo', 'Abundante arroz chaufa con trozos de pollo y tortilla.', 14.50, 'images/chaufa.png', 'Acompañamientos', 0, NULL, 0, 1),
(9, 'Lomo Fino a la Parrilla', '200gr de lomo fino jugoso, servido con papas y ensalada.', 34.90, 'images/lomo_fino.png', 'Parrillas', 0, NULL, 0, 1),
(10, 'Chicharrón de Pollo', 'Crujientes trozos de pollo arrebozado con papas fritas.', 16.90, 'images/chicharron.png', 'Parrillas', 0, NULL, 0, 1),
(11, 'Ensalada de la Casa', 'Fresca, con lechuga, tomate, pepino y aderezo especial.', 9.90, 'images/ensalada.png', 'Ensaladas', 0, NULL, 0, 1),
(12, 'Combo Parrillero', '4 Anticuchos + 4 Brochetas de pollo + Papas + Ensalada.', 59.90, 'images/combo_parrillero.png', 'Combos', 1, 49.90, 1, 1),
(14, 'Prueba1', 'pruebita', 54.00, 'images/combo_parrillero.png', 'no se, prueba supongo', 1, 25.00, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`) VALUES
(1, 'Super Administrador', 'superadmin@ricoschicken.com', '$2a$12$HhdOZQ9zpxi1OalNfxXoiezbF323DT9lVq4YcbUi4kiSbOnsligou', 'superadmin'),
(2, 'Admin Pollería', 'admin@ricoschicken.com', '$2a$12$HhdOZQ9zpxi1OalNfxXoiezbF323DT9lVq4YcbUi4kiSbOnsligou', 'admin'),
(3, 'Juan Supervisor', 'supervisor@ricoschicken.com', '$2a$12$HhdOZQ9zpxi1OalNfxXoiezbF323DT9lVq4YcbUi4kiSbOnsligou', 'supervisor'),
(4, 'Carlos Cliente', 'cliente@ricoschicken.com', '$2a$12$HhdOZQ9zpxi1OalNfxXoiezbF323DT9lVq4YcbUi4kiSbOnsligou', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
