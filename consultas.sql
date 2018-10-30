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
 `idempresa` int(11) NOT NULL,
 `idestablecimiento` int(11) NOT NULL,
 `idusuario` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `sac`. `empresas` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `empresa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
 `logo` text COLLATE utf8_spanish_ci NOT NULL,
 `estado` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `empresa` (`empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `sac`.`tipos` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
 `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `sac`.`establecimientos` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `identificador` varchar(100) NOT NULL,
 `tipo` text COLLATE utf8_spanish_ci NOT NULL,
 `estado` int(11) NOT NULL,
 `idempresa` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `identificador` (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `sac`.`remitentes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `remitente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
 `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 UNIQUE KEY `remitente` (`remitente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `sac`.`categorias` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `categoria` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
 `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 UNIQUE KEY `categoria` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `sac`.`radicados` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `radicado` int(11) NOT NULL,
 `fecha` datetime NOT NULL,
 `idtransportadora` int(11) NOT NULL,
 `idremitente` int(11) NOT NULL,
 `destinatario` text COLLATE utf8_spanish_ci DEFAULT NULL,
 `correspondencia` text COLLATE utf8_spanish_ci DEFAULT NULL,
 `tipo` text COLLATE utf8_spanish_ci DEFAULT NULL,
 `idusuario` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `sac`. `perfiles` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `perfil` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
 `inicio` int(11) NOT NULL,
 `usuarios` int(11) NOT NULL,
 `transportadoras` int(11) NOT NULL,
 `empresas` int(11) NOT NULL,
 `clientes` int(11) NOT NULL,
 `establecimientos` int(11) NOT NULL,
 `remitentes` int(11) NOT NULL,
 `categorias` int(11) NOT NULL,
 `radicados` int(11) NOT NULL,
 `reportes` int(11) NOT NULL,
 `opciones` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `perfil` (`perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO perfiles (id, perfil, inicio, usuarios,transportadoras, empresas, clientes, establecimientos, remitentes, categorias, radicados, reportes, opciones)
VALUES (
  NULL,
  'Administrador',
  '6',
  '6',
  '6',
  '6',
  '6',
  '6',
  '6',
  '6',
  '6',
  '6',
  '6'
  );

  INSERT INTO perfiles (id, perfil, inicio, usuarios,transportadoras, empresas, clientes, establecimientos, remitentes, categorias, radicados, reportes, opciones)
  VALUES (
    NULL,
    'Especial',
    '6',
    '0',
    '5',
    '5',
    '5',
    '5',
    '5',
    '5',
    '5',
    '5',
    '0'
    );

    INSERT INTO perfiles (id, perfil, inicio, usuarios,transportadoras, empresas, clientes, establecimientos, remitentes, categorias, radicados, reportes, opciones)
    VALUES (
      NULL,
      'Consulta',
      '6',
      '0',
      '4',
      '4',
      '4',
      '4',
      '4',
      '0',
      '4',
      '4',
      '0'
      );
