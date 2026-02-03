-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2025 a las 05:54:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `direccion_adicional` varchar(80) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `nombre`, `apellido`, `direccion`, `direccion_adicional`, `ciudad`, `telefono`, `correo`) VALUES
(1, 'Alexander Gilberto', 'Reyes Villanueva', 'cra 45 #127-57', '', '', 2147483647, 'alexis@gmail.com'),
(2, 'Paola', 'Lara', 'cra 24 #27-51', '', '', 2147483647, 'Paola@gmail.com'),
(6, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(7, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(8, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(9, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(10, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(11, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(12, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(13, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(16, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(17, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(20, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(21, 'alexis', 'reyes', 'Cra 52 #70-50', 'Casa', 'Bogota', 2147483647, 'notiene@gmail.com'),
(22, 'saco so so', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(26, 'alexis', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(28, 'asd', 'asd', 'asd', 'asd', 'asd', 0, 'asd'),
(29, 'asd', 'asd', 'asd', 'asd', 'asd', 0, 'asd'),
(30, 'juan', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(31, 'juan', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(36, 'Karen', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(37, 'Karen', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(38, 'Yilmer', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(39, 'Yilmer', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(40, 'alexis', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(41, 'alexis', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(42, 'pepe', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(43, 'pepe', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(45, 'alexis', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(48, 'saco unisex', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(49, 'saco unisex', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(50, 'alexis', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(51, 'alexis', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(52, 'alexis', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(54, 'alexis', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com'),
(56, 'alexis', 'reyes', 'Cra 46 #128-71', 'Cra 46 #128-71', 'Bogota', 2147483647, 'alexis20212223@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `detalle_id` int(11) NOT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`detalle_id`, `venta_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 51, 2, 39500.00),
(2, 4, 62, 1, 22.00),
(3, 5, 62, 1, 22.00),
(4, 7, 64, 1, 2222.00),
(5, 8, 64, 1, 2222.00),
(6, 11, 62, 1, 22.00),
(7, 12, 51, 1, 12.00),
(10, 15, 62, 1, 22.00),
(11, 16, 62, 1, 22.00),
(12, 17, 64, 1, 2222.00),
(16, 21, 64, 6, 222200.00),
(17, 21, 63, 3, 20000.00),
(18, 21, 63, 1, 20000.00),
(19, 21, 64, 1, 222200.00),
(21, 23, 63, 1, 20000.00),
(22, 23, 64, 1, 222200.00),
(23, 23, 65, 1, 2000000.00),
(24, 24, 63, 1, 20000.00),
(25, 24, 64, 1, 222200.00),
(26, 24, 65, 1, 2000000.00),
(27, 25, 63, 1, 20000.00),
(28, 26, 63, 1, 20000.00),
(33, 31, 64, 3, 222200.00),
(34, 31, 51, 1, 1200.00),
(35, 31, 63, 1, 20000.00),
(36, 32, 64, 3, 222200.00),
(37, 32, 51, 1, 1200.00),
(38, 32, 63, 1, 20000.00),
(39, 33, 64, 2, 222200.00),
(40, 33, 64, 1, 222200.00),
(41, 34, 64, 2, 222200.00),
(42, 34, 64, 1, 222200.00),
(43, 35, 63, 1, 20000.00),
(44, 36, 63, 1, 20000.00),
(45, 37, 63, 1, 20000.00),
(46, 37, 62, 1, 2200.00),
(47, 38, 63, 1, 20000.00),
(48, 38, 62, 1, 2200.00),
(49, 40, 64, 2, 222200.00),
(51, 40, 63, 1, 20000.00),
(52, 40, 63, 1, 20000.00),
(55, 43, 64, 1, 222200.00),
(56, 44, 64, 1, 222200.00),
(57, 45, 65, 1, 2000000.00),
(58, 45, 63, 1, 20000.00),
(59, 46, 65, 1, 2000000.00),
(60, 46, 63, 1, 20000.00),
(61, 47, 63, 1, 20000.00),
(62, 47, 51, 2, 1200.00),
(63, 47, 65, 2, 2000000.00),
(64, 47, 62, 1, 2200.00),
(65, 47, 63, 1, 20000.00),
(67, 49, 63, 1, 20000.00),
(69, 51, 63, 1, 20000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_adicionales`
--

CREATE TABLE `imagenes_adicionales` (
  `imagenes_adicionales_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `url_imagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes_adicionales`
--

INSERT INTO `imagenes_adicionales` (`imagenes_adicionales_id`, `producto_id`, `url_imagen`) VALUES
(136, 64, 'https://www.venuzstore.com/fotos/file.png'),
(159, 51, 'https://venuzstore.com/fotos/saco2.webp'),
(160, 51, 'https://venuzstore.com/fotos/saco2.webp'),
(161, 51, 'https://venuzstore.com/fotos/saco2.webp'),
(162, 62, 'https://venuzstore.com/fotos/saco6.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `venta_id` int(11) NOT NULL,
  `token` varchar(64) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL,
  `estado` enum('pendiente','pagado','enviado','cancelado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`venta_id`, `token`, `cliente_id`, `fecha`, `total`, `estado`) VALUES
(1, NULL, 1, '2025-08-20 02:23:23', 79000.00, 'pendiente'),
(2, NULL, 6, '2025-08-22 12:53:43', 1335400.00, 'pendiente'),
(3, NULL, 7, '2025-08-22 12:57:13', 22.00, 'pendiente'),
(4, NULL, 8, '2025-08-22 13:03:10', 22.00, 'pendiente'),
(5, NULL, 10, '2025-08-22 13:08:35', 22.00, 'pendiente'),
(6, NULL, 11, '2025-08-22 15:56:54', 2222.00, 'pendiente'),
(7, NULL, 12, '2025-08-22 15:58:16', 2222.00, 'pendiente'),
(8, NULL, 13, '2025-08-22 16:02:59', 2222.00, 'pendiente'),
(11, NULL, 16, '2025-08-22 16:28:40', 22.00, 'pendiente'),
(12, NULL, 17, '2025-08-22 17:06:59', 12.00, 'pendiente'),
(15, NULL, 20, '2025-08-22 17:18:41', 22.00, 'pendiente'),
(16, 'a8597b0bd5d331cbb67f2b36ee5541d1', 21, '2025-08-22 20:09:40', 22.00, 'pendiente'),
(17, '4505cbcbf2ed43d5a352f5ebe9bab611', 22, '2025-08-24 20:42:24', 2222.00, 'pendiente'),
(21, '08039cc765bb714347f76114aafafd40', 26, '2025-08-25 02:11:39', 1635400.00, 'pendiente'),
(23, 'bca7a8100b9693ef05a02fcbf75e36a1', 28, '2025-08-25 02:12:49', 2242200.00, 'pendiente'),
(24, 'a0bb9b47df63094dab78d77cbb429c5f', 29, '2025-08-25 02:12:49', 2242200.00, 'pendiente'),
(25, '3385294e750c022b425a065a13f01428', 30, '2025-08-25 02:13:32', 20000.00, 'pendiente'),
(26, 'a7e82b9ca0e68c73e7516dd6e74276b6', 31, '2025-08-25 02:13:32', 20000.00, 'pendiente'),
(31, 'f8ec9ab4c0c448fbf3d68708dd961741', 36, '2025-08-26 01:13:36', 687800.00, 'pendiente'),
(32, 'bad37b8059176ffa9fb6a57b4264a233', 37, '2025-08-26 01:13:36', 687800.00, 'pendiente'),
(33, '0781dfef0c6151789464ecf3e4468479', 38, '2025-08-26 01:27:12', 666600.00, 'pendiente'),
(34, 'bae5a02a2b54f2ac1899782d95e33fd6', 39, '2025-08-26 01:27:12', 666600.00, 'pendiente'),
(35, 'd0e4b7e2ef5ae59918cca64305f95d7b', 40, '2025-08-27 01:54:31', 20000.00, 'pendiente'),
(36, '27ae53231c8d134f9069b513b3ff6383', 41, '2025-08-27 01:54:31', 20000.00, 'pendiente'),
(37, '180ce0de61e21a7520775a4c59a6c42e', 42, '2025-08-29 01:53:41', 22200.00, 'pendiente'),
(38, '626f8916119e59b24d79ab56db589e26', 43, '2025-08-29 01:53:41', 22200.00, 'pendiente'),
(40, '4a82e70bf682fc28f3d87f334da9ee84', 45, '2025-08-30 04:12:10', 484400.00, 'pendiente'),
(43, '8f15588504f4926b2d6cffa3e3444827', 48, '2025-08-30 04:14:21', 222200.00, 'pendiente'),
(44, 'c9c1e01969926eadcc836ff6140abc68', 49, '2025-08-30 04:14:21', 222200.00, 'pendiente'),
(45, '23fd7703f79e582258310a330ec87969', 50, '2025-08-30 04:15:34', 2020000.00, 'pendiente'),
(46, '7d650b2c7bcd59b4de20a7b7a668a8fa', 51, '2025-08-30 04:15:34', 2020000.00, 'pendiente'),
(47, '754705872bb95a3fb927bb7913e58c9d', 52, '2025-08-30 04:17:28', 4044600.00, 'pendiente'),
(49, 'a03fde43f464c62322f632e6944f4c67', 54, '2025-08-30 04:19:00', 20000.00, 'pendiente'),
(51, '5aa094b9278add92218cecfc570262de', 56, '2025-08-30 04:28:33', 20000.00, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `tipo_producto` enum('saco','otro') NOT NULL,
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `genero` enum('hombre','mujer','unisex') NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `imagen_back` varchar(80) NOT NULL,
  `color` varchar(20) NOT NULL,
  `fecha_ingreso` date DEFAULT current_timestamp(),
  `destacado_newin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`tipo_producto`, `producto_id`, `nombre`, `descripcion`, `precio`, `genero`, `imagen`, `imagen_back`, `color`, `fecha_ingreso`, `destacado_newin`) VALUES
('saco', 51, 'saco so so', 'Vestibulum sed commodo dui. Mauris aliquet risus vel', 12.00, 'mujer', 'https://venuzstore.com/fotos/saco2.webp', 'https://venuzstore.com/fotos/saco2.webp', 'Gris', '2025-08-15', 1),
('otro', 62, 'saco so so', 'ut bibendum libero luctus. Fusce eu est aliqueut bibendum libero luctus. Fusce eu est aliqueut bibendum u est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus. Fusce eu esu est aliqueut bibendum libero luctus.', 22.00, 'hombre', 'https://venuzstore.com/fotos/saco2.webp', 'https://venuzstore.com/fotos/saco3.webp', 'blanco', '2025-08-13', 1),
('saco', 63, 'saco rico', 'Vestibulum sed commodo dui. Mauris', 200.00, 'hombre', 'https://venuzstore.com/fotos/saco2.webp', 'https://venuzstore.com/fotos/saco3.webp', 'Negro', '2025-08-15', 1),
('saco', 64, 'saco unisex', 'asdasdadasd', 2222.00, 'hombre', 'https://venuzstore.com/fotos/saco3.webp', 'https://venuzstore.com/fotos/saco2.webp', 'Cafe', '2025-08-15', 1),
('otro', 65, 'Blazer HZ Negro', 'sagittis enim eget, pharetra sapien.', 20000.00, 'hombre', 'https://venuzstore.com/fotos/saco3.webp', 'https://venuzstore.com/fotos/saco2.webp', 'cafe', '2025-08-15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas_productos`
--

CREATE TABLE `tallas_productos` (
  `tallas_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `talla` varchar(10) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tallas_productos`
--

INSERT INTO `tallas_productos` (`tallas_id`, `producto_id`, `talla`, `stock`) VALUES
(144, 64, 'M', 10),
(145, 64, 'L', 10),
(147, 63, 'S', 1),
(148, 63, 'M', 5),
(160, 51, 'S', 6),
(161, 65, 'M', 0),
(162, 62, 'M', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `imagenes_adicionales`
--
ALTER TABLE `imagenes_adicionales`
  ADD PRIMARY KEY (`imagenes_adicionales_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`venta_id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `tallas_productos`
--
ALTER TABLE `tallas_productos`
  ADD PRIMARY KEY (`tallas_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `imagenes_adicionales`
--
ALTER TABLE `imagenes_adicionales`
  MODIFY `imagenes_adicionales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `venta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `tallas_productos`
--
ALTER TABLE `tallas_productos`
  MODIFY `tallas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `pedido` (`venta_id`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`);

--
-- Filtros para la tabla `imagenes_adicionales`
--
ALTER TABLE `imagenes_adicionales`
  ADD CONSTRAINT `imagenes_adicionales_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`);

--
-- Filtros para la tabla `tallas_productos`
--
ALTER TABLE `tallas_productos`
  ADD CONSTRAINT `tallas_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
