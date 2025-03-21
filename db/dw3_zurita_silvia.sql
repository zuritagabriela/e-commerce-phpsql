-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-08-2024 a las 16:55:46
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw3_zurita_silvia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idcarrito` int(10) UNSIGNED NOT NULL,
  `idorden` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usuario_fk` int(10) UNSIGNED NOT NULL,
  `producto_fk` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `color` varchar(30) DEFAULT NULL,
  `talle` varchar(5) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`idcarrito`, `idorden`, `usuario_fk`, `producto_fk`, `cantidad`, `color`, `talle`, `estado`) VALUES
(96, '25120482024', 25, 1, 2, 'Celeste', 'S', 'finalizado'),
(101, '255614682024', 25, 1, 1, 'Celeste', 'S', 'finalizado'),
(106, '253616682024', 25, 2, 1, 'Negro', 'S', 'finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `idcolor` int(11) NOT NULL,
  `producto_fk` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `codigohex` varchar(7) NOT NULL,
  `estado` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`idcolor`, `producto_fk`, `nombre`, `codigohex`, `estado`) VALUES
(6, 1, 'Blanco', '#ffffff', 'activo'),
(7, 1, 'Celeste', '#00ADEE', 'activo'),
(8, 2, 'Negro', '#000000', 'activo'),
(9, 2, 'Rojo', '#B21016', 'No activo'),
(10, 3, 'Amarillo', '#FFFF00', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_publicacion`
--

CREATE TABLE `estados_publicacion` (
  `estado_publicacion_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `idmarca` int(10) UNSIGNED NOT NULL,
  `nombre_marca` varchar(50) NOT NULL,
  `idproducto_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`idmarca`, `nombre_marca`, `idproducto_fk`) VALUES
(6, 'Orbea', 1),
(7, 'Terra', 2),
(8, 'Orbea', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idnoticia` int(10) UNSIGNED NOT NULL,
  `idusuario_fk` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `sinopsis` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `imagen` varchar(120) DEFAULT NULL,
  `imagen_descripcion` varchar(150) DEFAULT NULL,
  `usuarios_idusuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idnoticia`, `idusuario_fk`, `titulo`, `fecha_publicacion`, `sinopsis`, `text`, `imagen`, `imagen_descripcion`, `usuarios_idusuario`) VALUES
(7, 1, 'BUENAS NOTICIAS PARA LOS CICLISTAS URBANOS!', '2023-04-02 10:52:16', '¡Se extiende la bici hasta Av. Gral Paz!. En el último año los viajes en bicicleta se ven cada ves más. Ampliaron la red de bicisendas de las avenidas Corrientes y Córdoba en el 2020[...]', '', 'viaurbanacaba.jpg', 'Un ciclista disfrutando de la bicisenda en la Ciudad de Buenos Aires', 0),
(8, 1, 'LA ACTIVIDAD QUE FUNCIONA PARA TODOS Y ES FUROR', '2023-04-02 10:52:16', 'Las bicicletas de aventura encabezan el crecimiento con una suba del 100% en dos años; por qué cada vez más personas eligen este deporte que combina lo mejor [...]', '', 'gravel.jpg', 'Dos ciclista disfrutando de la bici gravel', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(10) UNSIGNED NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(120) NOT NULL,
  `imagen_descripcion` varchar(150) NOT NULL,
  `texto` varchar(150) NOT NULL,
  `clase` varchar(10) DEFAULT NULL,
  `amortiguador` varchar(50) DEFAULT NULL,
  `rueda` varchar(50) DEFAULT NULL,
  `cubiertas` varchar(55) DEFAULT NULL,
  `sillin` varchar(50) DEFAULT NULL,
  `bateria` varchar(45) DEFAULT NULL,
  `categoria` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `nombre_producto`, `precio`, `imagen`, `imagen_descripcion`, `texto`, `clase`, `amortiguador`, `rueda`, `cubiertas`, `sillin`, `bateria`, `categoria`) VALUES
(1, 'WILD M-LTD 2023', 100.35, '20240803002832_N246TTCC-MN-SIDE-OIZ_M-LTD_1.jpg', 'RISE M-LTD 2023 para disfrutar en montaña', 'Disfruta de tu Rise, designada como Best Buy 2023 por la Enduro Mountainbike Magazine, ahora y por tiempo limitado con seguro gratuito.               ', 'active', 'Fox Float DPS Factory 3-Position Adjust Evol Kashi', 'OQUO Mountain Performance MP30LTD Carbon', 'Maxxis Rekon 2.60', 'Fizik Antares R1 142mm', 'Orbea Internal 360Wh (Optional 540Wh)', ''),
(2, 'GAIN M10i 2023', 100.35, '20240806162800_big-20240802151254_N327TTCC-D4-SIDE-GAIN_M10i_1.jpg', 'RISE M-LTD 2023 potencia y natural pedaleo', 'En terminos de potencia, Rse ofrece mucho más que un simple ajuste en un motor EP. Y es que nuestro RS Firmware te otorgará la expereciencia de pedale', '', '-', 'OQUO Mountain Performance MP30LTD Carbon', 'PIRELLI P ZERO™ RACE TLR 700X30C', 'Fizik Antares R5 Versus EVO Regular', '-', ''),
(3, 'WILD M-LTD 2024', 100.35, '20240805213523_20230605154745_3.jpg', 'WILD M-LTD 2023 una bicicleta para disfrutar en la montaña', 'En terminos de potencia, Rse ofrece mucho más que un simple ajuste en un motor EP. Y es que nuestro RS Firmware te otorgará la expereciencia de pedale', '', 'Fox Float DPS Factory 3-Position Adjust Evol Kashi', 'OQUO Mountain Performance MP30LTD Carbon', 'Maxxis Minion DHF 2.60', 'Fox Transfer Factory Kashima Dropper 31.6', 'BOSCH Powertube 625Wh Horizontal BBP3760', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrol` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idrol`, `nombre`) VALUES
(1, 'Administracion'),
(2, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `idstock` int(10) UNSIGNED NOT NULL,
  `producto_fk` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`idstock`, `producto_fk`, `cantidad`) VALUES
(9, 1, 0),
(10, 2, 5),
(11, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talles`
--

CREATE TABLE `talles` (
  `idtalle` int(11) NOT NULL,
  `producto_fk` int(10) UNSIGNED NOT NULL,
  `talle` varchar(5) NOT NULL,
  `estado` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `talles`
--

INSERT INTO `talles` (`idtalle`, `producto_fk`, `talle`, `estado`) VALUES
(3, 1, 'S', 'activo'),
(4, 1, 'M', 'activo'),
(5, 2, 'S', 'activo'),
(6, 2, 'M', 'No activo'),
(7, 3, 'M', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(10) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `idrol_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre_usuario`, `apellido`, `telefono`, `email`, `password`, `username`, `idrol_fk`) VALUES
(1, 'gabi', 'zuri', '22222-222', 'pepe@pepe.com', '$2y$10$mlTnBOxlrMY7wmUIr2TpCOdIaQ3IEtSuwre6ovwRKp33yHb9vDg/u', 'gzurita', 1),
(25, 'gzurita', 'gzurita', NULL, 'gzurita@lala.com', '$2y$10$1n7wOburk7Mut/qTYFppZ.63Bp5rGl2eP/M1z5NxI4FFzeE7vwS0y', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idventa` int(11) NOT NULL,
  `usuario_fk` int(10) UNSIGNED NOT NULL,
  `estado` varchar(20) NOT NULL,
  `idorden` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idventa`, `usuario_fk`, `estado`, `idorden`, `fecha`) VALUES
(63, 25, 'finalizado', '25120482024', '2024-08-04'),
(64, 25, 'finalizado', '25120482024', '2024-08-05'),
(65, 25, 'finalizado', '25120482024', '2024-08-06'),
(66, 25, 'finalizado', '255614682024', '2024-08-06'),
(67, 25, 'finalizado', '253616682024', '2024-08-06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idcarrito`),
  ADD KEY `carrito_items_cliente_idx` (`usuario_fk`),
  ADD KEY `carrito_productos_idx` (`producto_fk`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`idcolor`),
  ADD KEY `colores_productos_idx` (`producto_fk`);

--
-- Indices de la tabla `estados_publicacion`
--
ALTER TABLE `estados_publicacion`
  ADD PRIMARY KEY (`estado_publicacion_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`idmarca`),
  ADD UNIQUE KEY `idmarcas_UNIQUE` (`idmarca`),
  ADD KEY `marcas_productos_idx` (`idproducto_fk`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idnoticia`),
  ADD UNIQUE KEY `idnoticia_UNIQUE` (`idnoticia`),
  ADD KEY `fk_noticias_usuarios1_idx` (`idusuario_fk`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idroles_UNIQUE` (`idrol`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idstock`),
  ADD UNIQUE KEY `idstock_UNIQUE` (`idstock`),
  ADD KEY `stock_productos_idx` (`producto_fk`);

--
-- Indices de la tabla `talles`
--
ALTER TABLE `talles`
  ADD PRIMARY KEY (`idtalle`),
  ADD KEY `talle_productos_idx` (`producto_fk`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `Fk_usuarios_roles_idx` (`idrol_fk`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `ventas_usuarios_idx` (`usuario_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idcarrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `idcolor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estados_publicacion`
--
ALTER TABLE `estados_publicacion`
  MODIFY `estado_publicacion_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `idmarca` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idnoticia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idrol` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `idstock` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `talles`
--
ALTER TABLE `talles`
  MODIFY `idtalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_items_cliente` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_productos` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `colores`
--
ALTER TABLE `colores`
  ADD CONSTRAINT `colores_productos` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD CONSTRAINT `marcas_productos` FOREIGN KEY (`idproducto_fk`) REFERENCES `productos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_noticias_usuarios` FOREIGN KEY (`idusuario_fk`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_productos` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `talles`
--
ALTER TABLE `talles`
  ADD CONSTRAINT `talle_productos` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `Fk_usuarios_roles` FOREIGN KEY (`idrol_fk`) REFERENCES `roles` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_usuarios` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
