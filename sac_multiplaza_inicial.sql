-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2018 a las 10:28:40
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
(1, 'CAJA', '2018-10-18 07:55:09'),
(2, 'SOBRE', '2018-10-18 07:55:22'),
(3, 'COMUNICADO', '2018-10-18 07:55:34'),
(4, 'MULTA', '2018-10-18 07:55:45'),
(5, 'AVISO', '2018-10-18 07:55:53'),
(6, 'RECIBO', '2018-10-18 07:56:01');

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
  `idempresa` int(11) NOT NULL,
  `idestablecimiento` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(1, 'FALABELLA -- FALABELLA DE COLOMBIA S.A.', '', 1),
(2, 'MNG (MANGO) -- PUNTO ESTILO COLOMBIA S.A.S', '', 1),
(3, 'WOK -- LAO KAO S.A.', '', 1),
(4, 'CREPES & WAFFLES -- CREPES & WAFFLES S.A.', '', 1),
(5, 'TOUCHE -- ALTERNATIVA DE MODA S.A.S', '', 1),
(6, 'MORPH -- DEKOGIFT S.A.S.', '', 1),
(7, 'NYX -- LOREAL COLOMBIA S.A.S', '', 1),
(8, 'BERSHKA -- IBEROMODA S.A.S', '', 1),
(9, 'KICKS -- CENTURY SPORTS S.A.S', '', 1),
(10, 'ESIKA -- BEL-STAR S.A', '', 1),
(11, 'VERSILIA -- ROSA DE CASTRO S.A.S', '', 1),
(12, 'INKA GRILL -- MARCO  ANTONIO MORALES', '', 1),
(13, 'LA BIFER?A -- LA BIFERIA S.A.', '', 1),
(14, 'ZARA -- TEXMODAS S.A.S.', '', 1),
(15, '?XITO -- ALMACENES EXITO S.A.', '', 1),
(16, 'ADIDAS -- ADIDAS COLOMBIA LTDA', '', 1),
(17, 'FERRETI -- INVERSIONES 12 GRADOS SAS', '', 1),
(18, 'NIKE -- CENTURY SPORTS S.A.S.', '', 1),
(19, 'SPORTLINE -- CENTURY SPORTS S.A.S.', '', 1),
(20, 'SPORTLINE KIDS -- CENTURY SPORTS S.A.S.', '', 1),
(21, 'REPLAYS -- GRUPO R S.A.S.', '', 1),
(22, 'AMERICAN EAGLE -- FRUTO DE LA MODA S.A.S', '', 1),
(23, 'JUAN VALDEZ -- PROMOTORA DE CAFE COLOMBIA S.A.', '', 1),
(24, 'MAC CENTER -- MAC CENTER COLOMBIA SOCIEDAD POR ACCIONES SIMPLIFICADA', '', 1),
(25, 'SAMSARA HINDU -- GRUPO URDA S.A.S.', '', 1),
(26, 'SUNGLASS HUT -- OPTICAS GMO COLOMBIA S.A.S', '', 1),
(27, 'SPEEDO -- CREACIONES NADAR S.A.', '', 1),
(28, 'EVERLAST -- ROUND 2 S.A.S.', '', 1),
(29, 'BONBONITE -- ZBC S.A.', '', 1),
(30, 'ESPRIT -- INDUSTRIA MERCADEO Y COLOR S.A.S', '', 1),
(31, 'NAF NAF -- NAFTALINAS.A.S', '', 1),
(32, 'ADDICT -- COMERCIALIZADORA BALDINI S.A. BALDINI', '', 1),
(33, 'ADIDAS ORIGINALS -- ADIDAS COLOMBIA LTDA', '', 1),
(34, 'OYSHO -- TEMATEXTIL S.A.S', '', 1),
(35, 'DIESEL -- ESTUDIO DE MODA S.A.S.', '', 1),
(36, 'AGUA BENDITA -- AGUA BENDITA S.A.S', '', 1),
(37, 'VACIO -- FALABELLA DE COLOMBIA S.A.', '', 1),
(38, 'PUMA -- ACQUA MARKETING COLOMBIA SAS', '', 1),
(39, 'VELEZ -- CUEROS VELEZ S.A.S', '', 1),
(40, 'CHEVIGNON -- MERCADEO Y MODA S.A.S', '', 1),
(41, 'FDS -- ISHAJON S.A.S', '', 1),
(42, 'CALVIN KLEIN -- KARIMKA SAS', '', 1),
(43, 'BELLA PIEL -- BELLA PIEL SAS', '', 1),
(44, 'TOMMY -- AMERICAN APPAREL COLOMBIA S.A.S.', '', 1),
(45, 'KIPLING -- ESTUDIO DE MODA S.A.S.', '', 1),
(46, 'PILATOS -- ESTUDIO DE MODA S.A.S.', '', 1),
(47, 'POPSY-COOKIE JAAR -- COMERCIAL ALLAN SAS', '', 1),
(48, 'AMPHORA -- AMP INTERNACIONAL DE COLOMBIA S.A.S.', '', 1),
(49, 'AMERICANINO -- COMODIN S.A.S', '', 1),
(50, 'OFFCORSS -- C.I HERMECO S.A.', '', 1),
(51, 'BOSI -- COMERCIALIZADORA BALDINI S.A. BALDINI', '', 1),
(52, 'PULL & BEAR -- ANDIMODA S.A.S', '', 1),
(53, 'BATH & BODY WORKS -- ANGELS GROUP SAS', '', 1),
(54, 'STRADIVARIUS -- TEXART S.A.S', '', 1),
(55, 'STRADIVARIUS MEN -- TEXART S.A.S', '', 1),
(56, 'ESCENTIA-LA PERFUMERIA -- GLAM DISTRIBUTION SAS', '', 1),
(57, 'BLIND -- PROSALON DISTRIBUCIONES S.A.S.', '', 1),
(58, 'GMO -- OPTICAS GMO COLOMBIA S.A.S', '', 1),
(59, 'CROMANTIC -- PROSALON DISTRIBUCIONES S.A.S.', '', 1),
(60, 'PUMA KIDS -- ACQUA MARKETING COLOMBIA SAS', '', 1),
(61, 'MINISO -- MINISO COLOMBIA S.A.S.', '', 1),
(62, 'BUFFALO WINGS -- OPERADORA DE FRANQUICIAS DE COLOMBIA S.A.', '', 1),
(63, 'DOS CHINGONES -- OPERADORA DE FRANQUICIAS DE COLOMBIA S.A.', '', 1),
(64, 'ARISTAS -- ', '', 1),
(65, 'TOTTO -- NALSANI S.A.S.', '', 1),
(66, 'ARTURO CALLE -- COMERCIALIZADORA ARTURO CALLE S.A.S.', '', 1),
(67, 'GEF MEN -- CRYSTAL S.A.S.', '', 1),
(68, 'GEF -- CRYSTAL S.A.S.', '', 1),
(69, 'KOAJ - ARMI PRONTO -- PERMODA LTDA', '', 1),
(70, 'CLUB HOUSE -- DISTRIBUIDORA MATEC S.A.S.', '', 1),
(71, 'D?LAR CITY -- SURAMERICA COMERCIAL S.A.S', '', 1),
(72, 'SANTORINI -- ILSIGANO S.A', '', 1),
(73, 'STUDIO F  -- STF GROUP S.A', '', 1),
(74, 'ELA  -- STF GROUP S.A', '', 1),
(75, 'CACHIVACHES -- OTAVI SAS', '', 1),
(76, 'TANINNO -- CUEROS VELEZ S.A.S', '', 1),
(77, 'TAIRONAS -- JAIRO GUALTEROS CRUZ', '', 1),
(78, 'LILI PINK -- PINK LIFE S.A.S.', '', 1),
(79, 'AQUILES -- HONGWEI S.A.S', '', 1),
(80, 'MOSTER CLOTHING -- MONSTER CLOTHING STORES SAS', '', 1),
(81, 'PIEL Y VIDA -- PIEL Y VIDA PRODUCTOS DERMATOL?GICOS S.A.S', '', 1),
(82, 'WANAAWA -- WANAAWAA S.A.S.', '', 1),
(83, 'FXA -- NUEVO AMANECER FXA S.A.S.', '', 1),
(84, 'BOGOTA BEER COMPANY -- BOGOTA BEER COMPANY', '', 1),
(85, 'MIC -- W STUDIO DE COLOMBIA S.A.S', '', 1),
(86, 'SPORT STATION -- PANOV S.A.S', '', 1),
(87, 'BUNNA -- INVERSIONES BUNNA S.A.S', '', 1),
(88, 'OPTICENTRO -- OPTICENTRO INTERNACIONAL SAS', '', 1),
(89, 'TRAVESURAS -- ALMACENES TRAVESURAS S.A.S.', '', 1),
(90, 'DEREK -- BAGUER S.A.S.', '', 1),
(91, 'BOSI BAMBINO -- COMERCIALIZADORA BALDINI S.A. BALDINI', '', 1),
(92, 'COSECHAS -- DIEGO AUGUSTO MILLAN', '', 1),
(93, 'FIORENZI -- ZAP MICHELLE S.A.S', '', 1),
(94, 'ROOTT+CO -- ROOT + CO S.A.S', '', 1),
(95, 'PAT PRIMO -- PASH S.A.S.', '', 1),
(96, 'MOVIES -- W STUDIO DE COLOMBIA S.A.S', '', 1),
(97, 'NEW BALANCE -- INTERNATIONAL FOOTWEAR CORPORATION S.A.', '', 1),
(98, 'SEVEN SEVEN -- PASH S.A.S.', '', 1),
(99, 'WOMEN SECRET -- COMERCIALIZADORA BALDINI S.A. BALDINI', '', 1),
(100, 'ST EVEN -- INDUSTRIAS ST EVEN S.A.', '', 1),
(101, 'CALZATODO -- CALZATODO S.A.', '', 1),
(102, 'MUSSI -- MUSSI ZAPATOS S.A.S', '', 1),
(103, 'BABY FRESH -- CRYSTAL S.A.S.', '', 1),
(104, 'STYLE LIQ -- STYLE & PEOPLE S.A.S.', '', 1),
(105, 'CALCANTE -- INVERSIONES BUNNA SAS', '', 1),
(106, 'NATURAL VISION -- NATURAL VISION GROUP S.A.S.', '', 1),
(107, 'PUNTO BLANCO -- CRYSTAL S.A.S.', '', 1),
(108, 'PUNTO BLANCO DEPORTIVO -- CRYSTAL S.A.S.', '', 1),
(109, 'KALIFA -- LUIS CARLOS TRIANA BRAND', '', 1),
(110, 'BESO DE COCO -- CONFECCIONES SIGMA S.A.S.', '', 1),
(111, 'LEONISA -- DISTRIBUIDORA COLOMBIANA DE SENTIMIENTOS DE BELLEZA S.A.S', '', 1),
(112, 'SMART FIT -- SPORTY CITY S.A.S', '', 1),
(113, 'LA PIZZERIA -- SIETE GRADOS S.A.S.', '', 1),
(114, 'DON BENITEZ -- LUISA FERNANDA BENITEZ ALVAREZ', '', 1),
(115, 'BEER -- RCA & HNOS S.A.S.', '', 1),
(116, 'BAD BURGER -- JAVIER V?LEZ MONCALEANO/ NICOL?S NIZO QUECAN', '', 1),
(117, 'MARCO ALDANY -- INVERSIONES B&M CENTRO MAYOR S.A.S', '', 1),
(118, 'ZERO GRAVITY -- INNOVATION IN MOTION COMPANY S.A.S', '', 1),
(119, 'MAGASIN -- ELKIN GIRALDO', '', 1),
(120, 'CITY PARK -- CITY PARK SOCIEDAD POR ACCIONES SIMPLIFICADAS', '', 1),
(121, 'CINEMARK -- CINEMARK COLOMBIA S.A.S', '', 1),
(122, 'WESTER UNION  -- GIROS Y FINANZAS COMPA?IA DE FINANCIAMIENTO S.A', '', 1),
(123, ' CLARO -- TELMEX COLOMBIA S.A.', '', 1),
(124, 'DAVIVIENDA -- BANCO DAVIVIENDA S.A.', '', 1),
(125, 'AV VILLAS -- BANCO COMERCIAL AV VILLAS S.A.    ', '', 1),
(126, 'BANCO CAJA SOCIAL -- BANCO CAJA SOCIAL S.A.', '', 1),
(127, 'BANCO FALABELLA -- BANCO FALABELLA S.A', '', 1),
(128, 'ALCANSA S.A. -- CAMBIOS ALCANSA S.A.', '', 1),
(129, 'BANCOLOMBIA -- BANCOLOMBIA S.A', '', 1),
(130, 'MOVISTAR -- COLOMBIA TELECOMUNICACIONES S.A. E.S.P.', '', 1),
(131, 'COLCHONES PARAISO -- DREAM REST COLOMBIA SAS', '', 1),
(132, 'ROMERO PELUQUERIA -- WILSON ROMERO MOJICA', '', 1),
(133, 'VIRGIN MOBILE -- ALL PHONE S.A.S.', '', 1),
(134, 'SERVIENTREGA -- JUAN CAMILO PARDO SALINAS', '', 1),
(135, 'SMOD TECH -- JOSE ARNUBIO RIVERA MENDOZA', '', 1),
(136, 'TIGO -- COLOMBIA MOVIL S.A. ESP', '', 1),
(137, 'MISTER FLOYD -- INVERSIONES WILDAR SAS', '', 1),
(138, 'KIRFA -- UMAR FARUCK RIVERA FONSECA', '', 1),
(139, 'POPSY -- COMERCIAL ALLAN SAS', '', 1),
(140, 'NATIVOS -- POSITIVE BUSINESS SAS', '', 1),
(141, 'SOPAS DE MAM? Y POSTRES DE LA ABUELA -- JBY SERVICIOS S.A.S.', '', 1),
(142, 'HOMBRE DE LA MANCHA -- EL HOMBRE DE LA MANCHA S.A.S', '', 1),
(143, 'CANDYS FACTORY -- CANDICOLOR S.A.S', '', 1),
(144, 'AVENA CUBANA -- NATURAL FOOD S.A.S', '', 1),
(145, 'COLCHONES COMOD?SIMOS -- ESPUMAS PLASTICAS S.A.', '', 1),
(146, 'COLCHONES EL DORADO  -- COLCHONES EL DORADO S.A. EN REESTRUCTURACION', '', 1),
(147, 'CHRONOS FACTORY -- CHRONOS FANTASY', '', 1),
(148, 'BRISSA -- MODANOVA S.A.S.', '', 1),
(149, 'DORMILIFE -- GRUPO KASAMIA S.A.S', '', 1),
(150, 'LLAO LLAO -- PANLLAO COLOMBIA SAS', '', 1),
(151, 'CINNABON -- FRISBY S.A.', '', 1),
(152, 'JENOS PIZZA -- DIFALGA SAS', '', 1),
(153, 'T4 -- LATAM T-INVESTMENTS SAS', '', 1),
(154, 'MC DONALD\'S -- ARCOS DORADOS COLOMBIA S.A.S', '', 1),
(155, 'EUROPIEL -- EUROPIEL COLOMBIANA S.A.S', '', 1),
(156, 'HELADERIA CREPES -- CREPES & WAFFLES S.A.', '', 1),
(157, 'PANELA ROLLS -- MERU GOURMET CENTER SAS', '', 1),
(158, 'SARKU -- FRANCORP S.A.S.', '', 1),
(159, 'CARBON 100 -- CARBON 100 S.A.S.', '', 1),
(160, 'EL CORRAL -- IRCC S.A.S INDUSTRIA DE RESTAURANTES CASUALES S.A.S.', '', 1),
(161, 'FRISBY -- FRISBY S.A.', '', 1),
(162, 'SUBWAY -- PROMOTORA BELLATRIX S.A.S', '', 1),
(163, 'FRUTOS DEL BOSQUE -- INVERSIONES SANTO Y LE?A LTDA', '', 1),
(164, 'PRESTO -- FRANQUICIAS Y CONCESIONES S.A.S.', '', 1),
(165, 'DON JEDIONDO -- DON JEDIONDO SOPITAS Y PARRILLA S.A.S.', '', 1),
(166, 'SPOLETTO -- SPOLETO CULINARIA ITALIANA SAS', '', 1),
(167, 'HARBIN -- RAFAEL ALEJANDRO BARRANTES SALAMANCA', '', 1),
(168, 'MASTER SUSHI -- INVERSIONES RESTAURANTE DIMAR DE COLOMBIA SAS', '', 1),
(169, 'DI MAR -- MASTER SUSHI S.A.S.', '', 1),
(170, 'PARRILLA COLOMBIA -- INVERSIONES MEGAVAL LTDA', '', 1),
(171, 'EL CARNAL -- INVERSIONES EL CARNAL S.A.S.', '', 1),
(172, 'PATACONES -- PLATANOS DE MI TIERRA S.A.S', '', 1),
(173, 'SANDWICH QBANO -- INVERSIONES NALO DE COLOMBIA S.A.S.', '', 1),
(174, 'MIS CARNES PARRILLA -- GRUPO MIS SOCIEDAD POR ACCIONES SIMPLIFICADAS', '', 1),
(175, 'LA BRASA ROJA -- GRUPO CBC S.A.', '', 1),
(176, 'CHINAWOK -- GRUPO TEMAKI S.A.S.', '', 1),
(177, 'EL KHALIFA -- SALEH HERMANOS S.A.S.', '', 1),
(178, 'HOMEDICS (MASAJES) -- MECANELECTRO SAS', '', 1),
(179, 'FLORIAN PERFUME BAR  -- DE LA ROCCA INVERSIONES S.A.S', '', 1),
(180, 'SMART SHIRTS -- ACTIVE ART MERCHANDISING S.A.S.', '', 1),
(181, 'DILETTO -- DILETTO CAF? E RISTORANTE SAS', '', 1),
(182, 'SENTHIA  -- ESSENSALE', '', 1),
(183, 'SOLUTIONS ACCESORIOS -- SOLUTIONS ACCESORIOS PLUS S.A.S.', '', 1),
(184, 'DIRECT TV -- DIRECTV COLOMBIA LTDA', '', 1),
(185, 'MOVITEAM (CAPSULA VIRTUAL) -- MOISES RODRIGUEZ', '', 1),
(186, 'GOYURT -- EBF INVERSIONES SAS', '', 1),
(187, 'MAXYBELT -- CARLOS BUITRAGO', '', 1),
(188, 'NOVAVENTA -- NOVAVENTA', '', 1),
(189, 'CANDYS FACTORY KIOSKO -- CANDICOLO SAS', '', 1),
(190, 'PINCHETTO -- CLAUDIA ZULUAGA', '', 1),
(191, 'MC DONALD?S -- ARCOS DORADOS COLOMBIA S.A.S.', '', 1),
(192, 'HAPPY PETS -- INVOKA BUSINESS & COMUNICATIONS', '', 1),
(193, 'SERVIBANCA -- SERVIBANCA S.A.', '', 1),
(194, 'STAND CARRITOS -- INVOKA BUSINESS & COMUNICATIONS', '', 1),
(195, 'BALOTO -- COMEXOS LOGISTICA S.A.S', '', 1),
(196, 'SAFARI KIDS  -- INVERSIONES CACHA S.A.S', '', 1),
(197, 'COORDINADORA -- COORDINADORA MERCANTIL S.A.', '', 1);

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
(1, 'A-101', 'Local', 1, 1),
(2, 'A-102', 'Local', 1, 2),
(3, 'A-102A', 'Local', 1, 3),
(4, 'A-103', 'Local', 1, 4),
(5, 'A-104', 'Local', 1, 5),
(6, 'A-105', 'Local', 1, 6),
(7, 'A-106', 'Local', 1, 7),
(8, 'A-107', 'Local', 1, 8),
(9, 'A-108', 'Local', 1, 9),
(10, 'A-109', 'Local', 1, 10),
(11, 'A-110', 'Local', 1, 11),
(12, 'A-111', 'Local', 1, 12),
(13, 'A-112', 'Local', 1, 13),
(14, 'A-114', 'Local', 1, 14),
(15, 'A-116', 'Local', 1, 15),
(16, 'A-119', 'Local', 1, 16),
(17, 'A-120', 'Local', 1, 17),
(18, 'A-123', 'Local', 1, 18),
(19, 'A-124', 'Local', 1, 19),
(20, 'A-125', 'Local', 1, 20),
(22, 'A-126', 'Local', 1, 22),
(23, 'A-128', 'Local', 1, 23),
(24, 'A-130', 'Local', 1, 24),
(25, 'A-131', 'Local', 1, 25),
(26, 'A-132', 'Local', 1, 26),
(27, 'A-133', 'Local', 1, 27),
(28, 'A-134', 'Local', 1, 28),
(29, 'A-135', 'Local', 1, 29),
(30, 'A-136', 'Local', 1, 30),
(31, 'A-137', 'Local', 1, 31),
(32, 'A-138 B', 'Local', 1, 32),
(33, 'A-139', 'Local', 1, 33),
(34, 'A-141', 'Local', 1, 34),
(35, 'A-143', 'Local', 1, 35),
(36, 'A-144', 'Local', 1, 36),
(37, 'A-145', 'Local', 1, 37),
(38, 'A-145A', 'Local', 1, 38),
(39, 'A-146', 'Local', 1, 39),
(40, 'A-147', 'Local', 1, 40),
(41, 'A-148', 'Local', 1, 41),
(42, 'A-149', 'Local', 1, 42),
(43, 'A-150', 'Local', 1, 43),
(44, 'A-151', 'Local', 1, 44),
(45, 'A-152A', 'Local', 1, 45),
(47, 'A-153', 'Local', 1, 47),
(48, 'A-154', 'Local', 1, 48),
(49, 'A-155', 'Local', 1, 49),
(50, 'A-156', 'Local', 1, 50),
(51, 'A-157', 'Local', 1, 51),
(52, 'A-158', 'Local', 1, 52),
(53, 'A-159', 'Local', 1, 53),
(54, 'A-160', 'Local', 1, 54),
(55, 'A-162', 'Local', 1, 55),
(56, 'A-164', 'Local', 1, 56),
(57, 'A-165', 'Local', 1, 57),
(58, 'A-166', 'Local', 1, 58),
(59, 'A-167', 'Local', 1, 59),
(60, 'A-168', 'Local', 1, 60),
(61, 'A-169', 'Local', 1, 61),
(62, 'A-170', 'Local', 1, 62),
(63, 'A-171', 'Local', 1, 63),
(64, 'B-102', 'Local', 1, 64),
(65, 'B-103', 'Local', 1, 65),
(66, 'B-105', 'Local', 1, 66),
(67, 'B-106', 'Local', 1, 67),
(68, 'B-108', 'Local', 1, 68),
(69, 'B-111B', 'Local', 1, 69),
(70, 'B-112', 'Local', 1, 70),
(71, 'B-112 A', 'Local', 1, 71),
(72, 'B-117', 'Local', 1, 72),
(73, 'B-120', 'Local', 1, 73),
(74, 'B-121', 'Local', 1, 74),
(75, 'B-122', 'Local', 1, 75),
(76, 'B-126', 'Local', 1, 76),
(77, 'B-130', 'Local', 1, 77),
(78, 'B-133', 'Local', 1, 78),
(79, 'B-134', 'Local', 1, 79),
(80, 'B-135', 'Local', 1, 80),
(81, 'B-136', 'Local', 1, 81),
(82, 'B-137', 'Local', 1, 82),
(83, 'B-138', 'Local', 1, 83),
(84, 'B-139', 'Local', 1, 84),
(85, 'B-140', 'Local', 1, 85),
(86, 'B-141', 'Local', 1, 86),
(87, 'B-142', 'Local', 1, 87),
(88, 'B-143', 'Local', 1, 88),
(89, 'B-144A', 'Local', 1, 89),
(90, 'B-144B', 'Local', 1, 90),
(91, 'B-146', 'Local', 1, 91),
(92, 'B-147', 'Local', 1, 92),
(93, 'B-149A', 'Local', 1, 93),
(94, 'B-149B', 'Local', 1, 94),
(95, 'B-150', 'Local', 1, 95),
(96, 'B-151', 'Local', 1, 96),
(97, 'B-153B', 'Local', 1, 97),
(98, 'B-154', 'Local', 1, 98),
(99, 'B-156', 'Local', 1, 99),
(100, 'B-158', 'Local', 1, 100),
(101, 'B-159', 'Local', 1, 101),
(102, 'B-160', 'Local', 1, 102),
(103, 'B-161', 'Local', 1, 103),
(104, 'B-162', 'Local', 1, 104),
(105, 'B-163', 'Local', 1, 105),
(106, 'B-164', 'Local', 1, 106),
(107, 'B-165', 'Local', 1, 107),
(108, 'B-167', 'Local', 1, 108),
(109, 'B-168', 'Local', 1, 109),
(110, 'B-169', 'Local', 1, 110),
(111, 'B-170', 'Local', 1, 111),
(112, 'C-102', 'Local', 1, 112),
(113, 'C-104', 'Local', 1, 113),
(114, 'C-105', 'Local', 1, 114),
(115, 'C-106', 'Local', 1, 115),
(116, 'C-106A', 'Local', 1, 116),
(117, 'C-107B', 'Local', 1, 117),
(118, 'C-107C', 'Local', 1, 118),
(119, 'C-108', 'Local', 1, 119),
(120, 'C-108A', 'Local', 1, 120),
(121, 'C-111', 'Local', 1, 121),
(122, 'C-115', 'Local', 1, 122),
(123, 'C-118', 'Local', 1, 123),
(124, 'C-119', 'Local', 1, 124),
(125, 'C-120', 'Local', 1, 125),
(126, 'C-121', 'Local', 1, 126),
(127, 'C-124', 'Local', 1, 127),
(128, 'C-126', 'Local', 1, 128),
(129, 'C-127', 'Local', 1, 129),
(130, 'C-129', 'Local', 1, 130),
(131, 'C-130', 'Local', 1, 131),
(132, 'C-131', 'Local', 1, 132),
(133, 'C-132', 'Local', 1, 133),
(134, 'C-133', 'Local', 1, 134),
(135, 'C-134', 'Local', 1, 135),
(136, 'C-135', 'Local', 1, 136),
(137, 'C-136', 'Local', 1, 137),
(138, 'C-137', 'Local', 1, 138),
(139, 'C-139', 'Local', 1, 139),
(140, 'C-140', 'Local', 1, 140),
(141, 'C-141A', 'Local', 1, 141),
(142, 'C-142', 'Local', 1, 142),
(143, 'C-143', 'Local', 1, 143),
(144, 'C-144', 'Local', 1, 144),
(145, 'C-145', 'Local', 1, 145),
(146, 'C-146A', 'Local', 1, 146),
(147, 'C-146B', 'Local', 1, 147),
(148, 'C-147', 'Local', 1, 148),
(149, 'C-150', 'Local', 1, 149),
(150, 'C-151', 'Local', 1, 150),
(151, 'C-152', 'Local', 1, 151),
(152, 'C-154', 'Local', 1, 152),
(153, 'C-155', 'Local', 1, 153),
(154, 'C-156', 'Local', 1, 154),
(155, 'C-157', 'Local', 1, 155),
(156, 'C-158', 'Local', 1, 156),
(157, 'C-159', 'Local', 1, 157),
(158, 'CFC-01', 'Local', 1, 158),
(159, 'CFC-02', 'Local', 1, 159),
(160, 'CFC-03', 'Local', 1, 160),
(161, 'CFC-04', 'Local', 1, 161),
(162, 'CFC-05', 'Local', 1, 162),
(163, 'CFC-06', 'Local', 1, 163),
(164, 'CFC-07', 'Local', 1, 164),
(165, 'CFC-08', 'Local', 1, 165),
(166, 'CFC-09A', 'Local', 1, 166),
(167, 'CFC-09B', 'Local', 1, 167),
(168, 'CFC-10A', 'Local', 1, 168),
(169, 'CFC-10B', 'Local', 1, 169),
(170, 'CFC-11', 'Local', 1, 170),
(171, 'CFC-12', 'Local', 1, 171),
(172, 'CFC-13', 'Local', 1, 172),
(173, 'CFC-14', 'Local', 1, 173),
(174, 'CFC-15', 'Local', 1, 174),
(175, 'CFC-16', 'Local', 1, 175),
(176, 'CFC-17', 'Local', 1, 176),
(177, 'CFC-18', 'Local', 1, 177),
(178, 'K-A07', 'Kiosko', 1, 178),
(179, 'K-A10', 'Kiosko', 1, 179),
(180, 'K-B01', 'Kiosko', 1, 180),
(181, 'K-B06', 'Kiosko', 1, 181),
(182, 'K-B08', 'Kiosko', 1, 182),
(183, 'K-A12', 'Kiosko', 1, 183),
(184, 'K-C03', 'Kiosko', 1, 184),
(185, 'K-C04', 'Kiosko', 1, 185),
(186, 'K-C05', 'Kiosko', 1, 186),
(187, 'K-C06', 'Kiosko', 1, 187),
(188, 'C03 Y C04', 'Kiosko', 1, 188),
(189, 'K-A06', 'Kiosko', 1, 189),
(190, 'K-B03', 'Kiosko', 1, 190),
(191, 'K-B05', 'Kiosko', 1, 191),
(192, 'K-A03', 'Kiosko', 1, 192),
(193, 'CA-02', 'Kiosko', 1, 193),
(194, 'K-A02', 'Kiosko', 1, 194),
(195, 'TERCER PISO', 'Kiosko', 1, 195),
(197, 'SOTANO 1', 'Kiosko', 1, 197);

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
  `correspondencia` text COLLATE utf8_spanish_ci,
  `tipo` text COLLATE utf8_spanish_ci,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remitentes`
--

CREATE TABLE `remitentes` (
  `id` int(11) NOT NULL,
  `remitente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(1, 'SERVIENTREGA', '', 1),
(2, 'COORDINADORA', '', 1),
(3, 'ENVIA ', '', 1),
(4, 'CODENSA', '', 1),
(5, 'ACUEDUCTO', '', 1),
(6, 'GAS NATURAL', '', 1),
(7, 'ECOCAPITAL', '', 1);

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
(1, 'admin', '$2a$07$N1c0las19s0n1aMAr71nau21DL1kcJ8upM.N05vvL.clkPU5iZwC6', 'Ruben Darío Ortiz', 'rubenortizg@gmail.com', 'Administrador', '', 1, '2018-10-18 02:43:56', '2018-10-18 07:43:56');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT de la tabla `establecimientos`
--
ALTER TABLE `establecimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT de la tabla `radicados`
--
ALTER TABLE `radicados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `remitentes`
--
ALTER TABLE `remitentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transportadoras`
--
ALTER TABLE `transportadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
