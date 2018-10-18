-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2018 a las 09:41:50
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'Sobre', '2018-07-23 02:04:24'),
(2, 'Revista', '2018-07-23 02:05:30'),
(3, 'Paquete', '2018-07-23 02:05:58'),
(4, 'Folleto', '2018-07-23 02:14:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `identificacion` int(11) NOT NULL,
  `tipoid` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `correo` text COLLATE utf8_spanish_ci,
  `telfijo` text COLLATE utf8_spanish_ci,
  `celular` text COLLATE utf8_spanish_ci,
  `ciudad` text COLLATE utf8_spanish_ci,
  `idempresa` int(11) DEFAULT NULL,
  `idestablecimiento` int(11) DEFAULT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `identificacion`, `tipoid`, `nombre`, `correo`, `telfijo`, `celular`, `ciudad`, `idempresa`, `idestablecimiento`, `idusuario`) VALUES
(1, 80241168, 'Cedula de Ciudadania', 'Rubén Darío Ortiz G', 'ruben@ruddor.com.co', '(1) 564-6595', '(311) 265-3265', 'Bogotá', 2, 1, 1),
(4, 21254659, 'Cedula de Ciudadania', 'Carla Robledo Palma', 'carlarobledo@gmail.com', '(1) 659-3147', '(310) 569-8214', 'Bogotá', 1, 1, 1),
(5, 1019096258, 'Cedula de Ciudadania', 'Juan Andres Diaz', 'juanadiaz@gmail.com', '(1) 221-5498', '(312) 585-6697', 'Bogotá', 4, 1, 1),
(6, 56166116, 'Cedula de Extranjeria', 'Iker Casillas', 'icasillas@gmail.com', '(1) 231-1654', '(321) 322-3131', 'Bogotá', 2, 2, 1),
(7, 21207758, 'Cedula de Ciudadania', 'Carlos Andres Davila', 'carlosdavila@avianca.com', '(1) 564-5646', '(311) 564-8971', 'Bogotá', 2, 6, 1),
(8, 6451844, 'Cedula de Ciudadania', 'David Diaz Duarte', 'dduarte@avianca.com', '(1) 446-4646', '(315) 646-4977', 'Bogotá', 1, 1, 1),
(9, 15984646, 'Cedula de Ciudadania', 'Juan Jose Moncada', 'jjmoncada@ruddorconsultoria.com', '(1) 899-7464', '(311) 589-8979', 'Bogotá', 4, 11, 1),
(10, 1019095788, 'Cedula de Ciudadania', 'Esteban Villanova Garcia', 'evillanova@ruddorconsultoria.com', '(1) 589-7915', '(314) 594-1456', 'Bogotá', 4, 11, 1),
(11, 1454999, 'Cedula de Extranjeria', 'Johan Strubelt', 'johan.strubelt@colciencias.gov.co', '(1) 568-9891', '(318) 589-8910', 'Bogotá', 1, 1, 1),
(12, 2147483647, 'Cedula de Extranjeria', 'Dana Greipel', 'dana.greipel@avianca.com', '(1) 856-6565', '(316) 997-7512', 'Bogotá', 2, 2, 1),
(13, 21547895, 'Cedula de Ciudadania', 'Cladia Marcela Rivas', 'claudiarivas@cofircolombiana.com', '(1) 568-9791', '(320) 569-8411', 'Bogotá', 3, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `empresa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `logo` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `empresa`, `logo`, `estado`) VALUES
(1, 'Colciencias', 'vistas/img/empresas/Colciencias/431.jpg', 1),
(2, 'Avianca S.A.', 'vistas/img/empresas/Avianca_S_A_/461.png', 1),
(3, 'Corficolombiana', 'vistas/img/empresas/Corficolombiana/528.png', 1),
(4, 'Ruddor Consultoria', 'vistas/img/empresas/Ruddor_Consultoria/739.jpg', 1),
(5, 'Colanta', 'vistas/img/empresas/Colanta/671.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimientos`
--

CREATE TABLE `establecimientos` (
  `id` int(11) NOT NULL,
  `identificador` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `establecimientos`
--

INSERT INTO `establecimientos` (`id`, `identificador`, `tipo`, `estado`, `idempresa`) VALUES
(1, 'L001', 'Local', 1, 1),
(2, 'L002', 'Local', 1, 1),
(5, 'OF001', 'Oficina', 1, 2),
(6, 'L003', 'Local', 1, 3),
(7, 'B001', 'Bodega', 1, 4),
(8, 'OF002', 'Oficina', 1, 4),
(9, 'L004', 'Local', 1, 3),
(10, 'L005', 'Local', 1, 2),
(11, 'L006', 'Local', 1, 4),
(12, 'L007', 'Local', 1, 3),
(13, 'L008', 'Local', 1, 2),
(14, 'L009', 'Local', 1, 1),
(15, 'L010', 'Local', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `radicados`
--

CREATE TABLE `radicados` (
  `id` int(11) NOT NULL,
  `radicado` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idtransportadora` int(11) NOT NULL,
  `idremitente` int(11) NOT NULL,
  `destinatario` text COLLATE utf8_spanish_ci,
  `tipo` text COLLATE utf8_spanish_ci NOT NULL,
  `correspondencia` text COLLATE utf8_spanish_ci,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `radicados`
--

INSERT INTO `radicados` (`id`, `radicado`, `fecha`, `idtransportadora`, `idremitente`, `destinatario`, `tipo`, `correspondencia`, `idusuario`) VALUES
(1, 1, '2018-10-10 17:25:49', 6, 3, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"5\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"Prueba Sobre Edición\"}]', 1),
(2, 2, '2018-10-10 17:34:54', 5, 7, '[{\"idEstablecimiento\":\"6\",\"idEmpresa\":\"3\",\"idCliente\":\"7\"}]', 'Masiva', '[{\"id\":\"1\",\"cantidad\":\"2\",\"observacion\":\"\"},{\"id\":\"3\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(3, 3, '2018-10-10 17:39:18', 6, 3, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"1\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(4, 4, '2018-10-10 17:39:41', 5, 3, '[{\"idEstablecimiento\":\"2\",\"idEmpresa\":\"1\",\"idCliente\":\"6\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(5, 5, '2018-10-10 17:40:40', 6, 6, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"3\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(6, 6, '2018-10-10 18:32:01', 5, 3, '[{\"idEstablecimiento\":\"9\",\"idEmpresa\":\"3\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(7, 7, '2018-10-11 20:59:29', 8, 9, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(8, 8, '2018-10-11 21:01:41', 7, 6, '[{\"idEstablecimiento\":\"10\",\"idEmpresa\":\"2\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(10, 10, '2018-10-13 18:37:27', 6, 7, '[{\"idEstablecimiento\":\"11\",\"idEmpresa\":\"4\",\"idCliente\":\"\"}]', 'Masiva', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"},{\"id\":\"4\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(11, 11, '2018-10-13 18:40:05', 6, 7, '[{\"idEstablecimiento\":\"11\",\"idEmpresa\":\"4\",\"idCliente\":\"9\"}]', 'Masiva', '[{\"id\":\"4\",\"cantidad\":\"1\",\"observacion\":\"Alcaldia de Bogota\"}]', 1),
(12, 12, '2018-10-15 09:47:19', 8, 7, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"8\"}]', 'Masiva', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"Prueba Sobre\"},{\"id\":\"3\",\"cantidad\":\"2\",\"observacion\":\"Prueba paquetes\"}]', 1),
(13, 13, '2018-10-15 11:50:25', 5, 6, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"5\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"Prueba Sobre\"}]', 1),
(14, 14, '2018-10-16 01:42:07', 6, 6, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(15, 15, '2018-10-17 13:16:03', 5, 6, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"Prueba Correo\"}]', 2),
(16, 16, '2018-10-18 01:50:41', 5, 6, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"1\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"Prueba Sobre\"}]', 1),
(17, 17, '2018-10-18 01:51:34', 5, 3, '[{\"idEstablecimiento\":\"5\",\"idEmpresa\":\"2\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(18, 18, '2018-10-18 01:52:21', 6, 3, '[{\"idEstablecimiento\":\"2\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"3\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(19, 19, '2018-10-18 01:54:22', 7, 7, '[{\"idEstablecimiento\":\"2\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(20, 19, '2018-10-18 01:54:33', 6, 6, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(21, 20, '2018-10-18 02:02:41', 6, 7, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"3\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(22, 21, '2018-10-18 02:09:48', 6, 9, '[{\"idEstablecimiento\":\"6\",\"idEmpresa\":\"3\",\"idCliente\":\"7\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(23, 22, '2018-10-18 02:11:27', 7, 6, '[{\"idEstablecimiento\":\"6\",\"idEmpresa\":\"3\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(24, 23, '2018-10-18 02:14:07', 7, 6, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"8\"}]', 'Individual', '[{\"id\":\"1\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(25, 24, '2018-10-18 02:20:12', 6, 7, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(26, 24, '2018-10-18 02:20:22', 5, 7, '[{\"idEstablecimiento\":\"5\",\"idEmpresa\":\"2\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(27, 25, '2018-10-18 02:22:21', 5, 7, '[{\"idEstablecimiento\":\"1\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(28, 25, '2018-10-18 02:22:33', 5, 6, '[{\"idEstablecimiento\":\"2\",\"idEmpresa\":\"1\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(29, 26, '2018-10-18 02:26:47', 7, 9, '[{\"idEstablecimiento\":\"10\",\"idEmpresa\":\"2\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"2\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(30, 27, '2018-10-18 02:27:57', 7, 7, '[{\"idEstablecimiento\":\"9\",\"idEmpresa\":\"3\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"4\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1),
(31, 28, '2018-10-18 02:31:05', 7, 9, '[{\"idEstablecimiento\":\"10\",\"idEmpresa\":\"2\",\"idCliente\":\"\"}]', 'Individual', '[{\"id\":\"3\",\"cantidad\":\"1\",\"observacion\":\"\"}]', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remitentes`
--

CREATE TABLE `remitentes` (
  `id` int(11) NOT NULL,
  `remitente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `remitentes`
--

INSERT INTO `remitentes` (`id`, `remitente`, `fecha`) VALUES
(3, 'Avianca S.A.', '2018-07-22 12:03:47'),
(6, 'Telmex Colombia', '2018-07-22 12:29:20'),
(7, 'El tiempo', '2018-10-10 20:20:16'),
(9, 'Colciencias', '2018-07-23 07:21:28'),
(10, 'Corficolombiana', '2018-07-23 07:24:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `tipo`, `fecha`) VALUES
(1, 'Local', '2018-07-23 02:57:14'),
(2, 'Bodega', '2018-07-23 02:57:27'),
(3, 'Oficina', '2018-07-23 02:57:35'),
(4, 'KIOSCO', '2018-10-11 13:23:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportadoras`
--

CREATE TABLE `transportadoras` (
  `id` int(11) NOT NULL,
  `transportadora` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `logo` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `transportadoras`
--

INSERT INTO `transportadoras` (`id`, `transportadora`, `logo`, `estado`) VALUES
(5, 'Interrapidisimo', 'vistas/img/transportadoras/Interrapidisimo/659.png', 1),
(6, 'Coordinadora S.A.', 'vistas/img/transportadoras/Coordinadora_S_A_/697.png', 0),
(7, 'Servientrega', 'vistas/img/transportadoras/Servientrega/443.png', 0),
(8, 'Deprisa', 'vistas/img/transportadoras/Deprisa/927.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `correo` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `nombre`, `correo`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'admin', '$2a$07$N1c0las19s0n1aMAr71nau21DL1kcJ8upM.N05vvL.clkPU5iZwC6', 'Ruben Darío Ortiz', 'rubenortizg@gmail.com', 'Administrador', 'vistas/img/usuarios/admin/771.jpg', 1, '2018-10-17 22:05:52', '2018-10-18 03:05:52'),
(2, 'rvargas', '$2a$07$N1c0las19s0n1aMAr71nauBb/N9AumY.ql/Z.sCCIIzlE33jX0p5S', 'Ricardo Vargas', 'rvargas@informark.com', 'Especial', 'vistas/img/usuarios/rvargas/131.png', 1, '2018-10-17 13:15:55', '2018-10-17 18:15:55'),
(4, 'sclaverde', '$2a$07$N1c0las19s0n1aMAr71nauDDoX0kZwx4huYAwnwq0eCwbecmXlVpG', 'Sonia C Laverde', 'sclaverde@gmail.com', 'Especial', 'vistas/img/usuarios/sclaverde/630.png', 1, '2018-05-23 22:58:43', '2018-07-18 05:31:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria` (`categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empresa` (`empresa`);

--
-- Indices de la tabla `establecimientos`
--
ALTER TABLE `establecimientos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificador` (`identificador`);

--
-- Indices de la tabla `radicados`
--
ALTER TABLE `radicados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `remitentes`
--
ALTER TABLE `remitentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `remitente` (`remitente`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo` (`tipo`);

--
-- Indices de la tabla `transportadoras`
--
ALTER TABLE `transportadoras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transportadora` (`transportadora`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `establecimientos`
--
ALTER TABLE `establecimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `radicados`
--
ALTER TABLE `radicados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `remitentes`
--
ALTER TABLE `remitentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `transportadoras`
--
ALTER TABLE `transportadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
