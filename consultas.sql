/* VERSION 1.0 SAC */

CREATE DATABASE `sac` COLLATE utf8_spanish_ci;

CREATE TABLE `sac`. `usuarios` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
 `password` text COLLATE utf8_spanish_ci NOT NULL,
 `nombre` text COLLATE utf8_spanish_ci NOT NULL,
 `correo` text COLLATE utf8_spanish_ci NOT NULL,
 `perfil` text COLLATE utf8_spanish_ci NOT NULL,
 `foto` text COLLATE utf8_spanish_ci NOT NULL,
 `estado` int(11) NOT NULL,
 `ultimo_login` datetime NOT NULL,
 `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO usuarios (id, usuario, password, nombre, correo, perfil, foto, estado, ultimo_login, fecha)
VALUES (
  NULL,
  'admin',
  '$2a$07$N1c0las19s0n1aMAr71nau21DL1kcJ8upM.N05vvL.clkPU5iZwC6',
  'Ruben Darío Ortiz',
  'rubenortizg@gmail.com',
  'Administrador',
  '',
  '1',
  '2018-02-23 18:06:30',
  NULL
  );

CREATE TABLE `sac`. `transportadoras` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `transportadora` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
 `logo` text COLLATE utf8_spanish_ci NOT NULL,
 `estado` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `transportadora` (`transportadora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `sac`.`clientes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `identificacion` int(11) NOT NULL,
 `tipoid` text COLLATE utf8_spanish_ci NOT NULL,
 `nombre` text COLLATE utf8_spanish_ci NOT NULL,
 `correo` text COLLATE utf8_spanish_ci DEFAULT NULL,
 `telfijo` text COLLATE utf8_spanish_ci DEFAULT NULL,
 `celular` text COLLATE utf8_spanish_ci DEFAULT NULL,
 `ciudad` text COLLATE utf8_spanish_ci DEFAULT NULL,
 `empresa` text COLLATE utf8_spanish_ci DEFAULT NULL,
 `oficinalocal` text COLLATE utf8_spanish_ci DEFAULT NULL,
 `idusuario` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci

CREATE TABLE `sac`. `empresas` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `empresa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
 `logo` text COLLATE utf8_spanish_ci NOT NULL,
 `estado` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `empresa` (`empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `sac`.`establecimientos` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `identificador` varchar(100) NOT NULL,
 `tipo` text COLLATE utf8_spanish_ci NOT NULL,
 `estado` int(11) NOT NULL,
 `idempresa` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `identificador` (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci
