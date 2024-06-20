-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:33066
-- Tiempo de generación: 20-06-2024 a las 16:57:47
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `360eva`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `acondicionamiento` ()   BEGIN
	TRUNCATE TABLE data_result;
    INSERT INTO data_result (id_resp, id_com, id_userx, data_result,evaluated_at)
    SELECT id_resp, id_com, id_userx, SUBSTRING_INDEX(SUBSTRING_INDEX(data_result, ',', n), ',', -1) AS data_result,evaluated_at
    FROM respuesta
    CROSS JOIN (
        SELECT a.N + b.N * 10 + 1 AS n
        FROM (
            SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL 
            SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
        ) a,
        (
            SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL 
            SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
        ) b
        ORDER BY n
    ) numeros
    WHERE LENGTH(data_result) - LENGTH(REPLACE(data_result, ',', '')) >= n - 1;
    
    TRUNCATE TABLE data_result2;
    INSERT INTO data_result2 (id_resp,id_com,id_userx,id_user,id_preg,rate,evaluated_at)
SELECT id_resp,id_com,id_userx,
		SUBSTRING_INDEX(data_result, '_', 1),
       SUBSTRING_INDEX(SUBSTRING_INDEX(data_result, '_', 2), '_', -1),
       SUBSTRING_INDEX(data_result, '_', -1),evaluated_at
FROM data_result;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_respuesta` (IN `p_id_com` INT, IN `p_id_userx` INT, IN `p_decode` TEXT)   BEGIN
    INSERT INTO respuesta (id_resp, id_com, id_userx, data_result, evaluated_at) 
    VALUES (NULL, p_id_com, p_id_userx, p_decode, NOW());
	
    CALL acondicionamiento();

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencia`
--

CREATE TABLE `competencia` (
  `id_com` int(10) NOT NULL,
  `name_com` varchar(50) NOT NULL,
  `description_com` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `competencia`
--

INSERT INTO `competencia` (`id_com`, `name_com`, `description_com`, `created_at`, `updated_at`) VALUES
(1, 'COMPROMISO', 'El compromiso es la capacidad que tiene una persona para tomar consciencia de la importancia que existe en cumplir con algo acordado anteriormente.', '2023-02-02 04:15:53', NULL),
(2, 'INSTITUCIONALIDAD', 'Conjunto de principios, valores, ideas, creencias y representaciones colectivas que norman las conductas de los individuos dentro de una organización.', '2023-02-02 04:15:53', NULL),
(3, 'INTEGRIDAD', 'La integridad es la condición de un individuo u objeto de mantener todas sus partes. Esto no incluye solo lo físico, sino los valores y convicciones.\r\n', '2023-02-02 04:15:53', NULL),
(4, 'ORIENTACION A LA CALIDAD', 'Establecer estándares de alta calidad y esforzarse para mejorar de manera continua y garantizar la calidad.\n', '2023-02-02 04:15:53', NULL),
(5, 'DESARROLLO PERSONAL O DE OTROS', 'Actividades que impulsan el desarrollo de las habilidades personales, hábitos y forma de pensar adecuadas como medio para intentar mejorar la calidad de vida, y contribuir a la realización de sueños y', '2023-02-02 04:15:53', NULL),
(6, 'INNOVACION', 'Es un proceso mediante el cual un dominio, producto o servicio se renueva y actualiza por medio de la aplicación de nuevos procesos, la introducción de nuevas técnicas o el establecimiento de ideas ex', '2023-02-02 04:15:53', NULL),
(7, 'LIDERAZGO', 'Es la capacidad que tiene una persona de influir, motivar, organizar y llevar a cabo acciones para lograr sus fines y objetivos que involucren a personas y grupos en una marco de valores.', '2023-02-02 04:15:53', NULL),
(8, 'PRIORIZAR', 'Evaluar un grupo de elementos y clasificarlos en orden de importancia o urgencia', '2023-02-02 04:15:53', NULL),
(9, 'ORGANIZACIÓN', 'Es mantener una congruencia en cada paso que se da, es saber el camino a recorrer y las puertas que atravesar para llegar a determinado fin.', '2023-02-02 04:15:53', NULL),
(10, 'NEGOCIACION', 'Proceso de comunicación entre al menos dos partes dirigido a alcanzar un acuerdo sobre intereses que se perciben como divergentes.', '2023-02-02 04:15:53', NULL),
(11, 'ANALITICO', 'Habilidad que nos permite procesar la información de una forma que, posteriormente, nos ayudará a tomar mejores decisiones y a obtener mejores resultados', '2023-02-02 04:15:53', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_result`
--

CREATE TABLE `data_result` (
  `id_resp` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  `id_userx` int(11) NOT NULL,
  `data_result` varchar(255) DEFAULT NULL,
  `evaluated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_result2`
--

CREATE TABLE `data_result2` (
  `id_resp` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  `id_userx` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_preg` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `evaluated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_dep` int(10) NOT NULL,
  `name_dep` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_dep`, `name_dep`, `created_at`, `updated_at`) VALUES
(1, 'CONSUMO MASIVO', '2023-02-02 03:30:00', NULL),
(2, 'HOSPITALITY', '2023-02-02 03:30:00', NULL),
(3, 'RRHH', '2023-02-02 03:30:00', NULL),
(4, 'FINANZAS', '2023-02-02 03:30:00', NULL),
(5, 'TI', '2023-02-02 03:30:00', NULL),
(6, 'GERENCIA DE TIENDAS', '2023-02-02 03:28:41', NULL),
(7, 'PENDIENTES DE DEFINIR', '2023-02-02 16:07:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `id_eva` int(20) NOT NULL,
  `name_eva` varchar(50) NOT NULL,
  `description_eva` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `est_eva` varchar(15) NOT NULL COMMENT '0 pendiente; 1 iniciada; 2 finalizada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`id_eva`, `name_eva`, `description_eva`, `created_at`, `updated_at`, `est_eva`) VALUES
(1, 'Evaluación 360 - 2023', 'Evaluación 360 para el año 2022, realizada en febrero del 2023', '2023-02-02 04:00:00', NULL, 'Iniciada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_preg`
--

CREATE TABLE `lista_preg` (
  `id_lp` int(30) NOT NULL,
  `id_preg` int(10) NOT NULL,
  `id_wl` int(30) NOT NULL,
  `id_com` int(10) NOT NULL,
  `id_eva` int(30) NOT NULL,
  `est_ql` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `lista_preg`
--

INSERT INTO `lista_preg` (`id_lp`, `id_preg`, `id_wl`, `id_com`, `id_eva`, `est_ql`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 1),
(3, 9, 1, 2, 1, 1),
(4, 10, 1, 2, 1, 1),
(5, 20, 1, 3, 1, 1),
(6, 21, 1, 3, 1, 1),
(7, 22, 1, 3, 1, 1),
(8, 28, 1, 4, 1, 1),
(9, 29, 1, 4, 1, 1),
(10, 30, 1, 4, 1, 1),
(11, 44, 1, 5, 1, 1),
(12, 45, 1, 5, 1, 1),
(13, 54, 1, 6, 1, 1),
(14, 55, 1, 6, 1, 1),
(15, 56, 1, 6, 1, 1),
(16, 65, 1, 7, 1, 1),
(17, 66, 1, 7, 1, 1),
(18, 77, 1, 8, 1, 1),
(19, 85, 1, 9, 1, 1),
(20, 91, 1, 10, 1, 1),
(21, 92, 1, 10, 1, 1),
(22, 93, 1, 10, 1, 1),
(23, 94, 1, 10, 1, 1),
(24, 95, 1, 10, 1, 1),
(25, 104, 1, 11, 1, 1),
(26, 1, 2, 1, 1, 1),
(27, 2, 2, 1, 1, 1),
(28, 3, 2, 1, 1, 1),
(29, 4, 2, 1, 1, 1),
(30, 9, 2, 2, 1, 1),
(31, 10, 2, 2, 1, 1),
(32, 11, 2, 2, 1, 1),
(33, 12, 2, 2, 1, 1),
(34, 13, 2, 2, 1, 1),
(35, 20, 2, 3, 1, 1),
(36, 21, 2, 3, 1, 1),
(37, 22, 2, 3, 1, 1),
(38, 23, 2, 3, 1, 1),
(39, 24, 2, 3, 1, 1),
(40, 28, 2, 4, 1, 1),
(41, 29, 2, 4, 1, 1),
(42, 30, 2, 4, 1, 1),
(43, 31, 2, 4, 1, 1),
(44, 32, 2, 4, 1, 1),
(45, 44, 2, 5, 1, 1),
(46, 45, 2, 5, 1, 1),
(47, 46, 2, 5, 1, 1),
(48, 47, 2, 5, 1, 1),
(49, 54, 2, 6, 1, 1),
(50, 55, 2, 6, 1, 1),
(51, 56, 2, 6, 1, 1),
(52, 57, 2, 6, 1, 1),
(53, 58, 2, 6, 1, 1),
(54, 65, 2, 7, 1, 1),
(55, 66, 2, 7, 1, 1),
(56, 67, 2, 7, 1, 1),
(57, 68, 2, 7, 1, 1),
(58, 69, 2, 7, 1, 1),
(59, 77, 2, 8, 1, 1),
(60, 78, 2, 8, 1, 1),
(61, 79, 2, 8, 1, 1),
(62, 80, 2, 8, 1, 1),
(63, 85, 2, 9, 1, 1),
(64, 86, 2, 9, 1, 1),
(65, 87, 2, 9, 1, 1),
(66, 88, 2, 9, 1, 1),
(67, 91, 2, 10, 1, 1),
(68, 92, 2, 10, 1, 1),
(69, 93, 2, 10, 1, 1),
(70, 94, 2, 10, 1, 1),
(71, 95, 2, 10, 1, 1),
(72, 96, 2, 10, 1, 1),
(73, 97, 2, 10, 1, 1),
(74, 98, 2, 10, 1, 1),
(75, 99, 2, 10, 1, 1),
(76, 104, 2, 11, 1, 1),
(77, 105, 2, 11, 1, 1),
(78, 106, 2, 11, 1, 1),
(79, 1, 3, 1, 1, 1),
(80, 2, 3, 1, 1, 1),
(81, 3, 3, 1, 1, 1),
(82, 4, 3, 1, 1, 1),
(83, 5, 3, 1, 1, 1),
(84, 6, 3, 1, 1, 1),
(85, 7, 3, 1, 1, 1),
(86, 9, 3, 2, 1, 1),
(87, 10, 3, 2, 1, 1),
(88, 11, 3, 2, 1, 1),
(89, 12, 3, 2, 1, 1),
(90, 13, 3, 2, 1, 1),
(91, 14, 3, 2, 1, 1),
(92, 15, 3, 2, 1, 1),
(93, 16, 3, 2, 1, 1),
(94, 20, 3, 3, 1, 1),
(95, 21, 3, 3, 1, 1),
(96, 22, 3, 3, 1, 1),
(97, 23, 3, 3, 1, 1),
(98, 24, 3, 3, 1, 1),
(99, 25, 3, 3, 1, 1),
(100, 28, 3, 4, 1, 1),
(101, 29, 3, 4, 1, 1),
(102, 30, 3, 4, 1, 1),
(103, 31, 3, 4, 1, 1),
(104, 32, 3, 4, 1, 1),
(105, 33, 3, 4, 1, 1),
(106, 34, 3, 4, 1, 1),
(107, 35, 3, 4, 1, 1),
(108, 36, 3, 4, 1, 1),
(109, 37, 3, 4, 1, 1),
(110, 38, 3, 4, 1, 1),
(111, 39, 3, 4, 1, 1),
(112, 40, 3, 4, 1, 1),
(113, 44, 3, 5, 1, 1),
(114, 45, 3, 5, 1, 1),
(115, 46, 3, 5, 1, 1),
(116, 47, 3, 5, 1, 1),
(117, 48, 3, 5, 1, 1),
(118, 49, 3, 5, 1, 1),
(119, 50, 3, 5, 1, 1),
(120, 51, 3, 5, 1, 1),
(121, 52, 3, 5, 1, 1),
(122, 54, 3, 6, 1, 1),
(123, 55, 3, 6, 1, 1),
(124, 56, 3, 6, 1, 1),
(125, 57, 3, 6, 1, 1),
(126, 58, 3, 6, 1, 1),
(127, 59, 3, 6, 1, 1),
(128, 60, 3, 6, 1, 1),
(129, 61, 3, 6, 1, 1),
(130, 65, 3, 7, 1, 1),
(131, 66, 3, 7, 1, 1),
(132, 67, 3, 7, 1, 1),
(133, 68, 3, 7, 1, 1),
(134, 69, 3, 7, 1, 1),
(135, 70, 3, 7, 1, 1),
(136, 71, 3, 7, 1, 1),
(137, 72, 3, 7, 1, 1),
(138, 77, 3, 8, 1, 1),
(139, 78, 3, 8, 1, 1),
(140, 79, 3, 8, 1, 1),
(141, 80, 3, 8, 1, 1),
(142, 81, 3, 8, 1, 1),
(143, 82, 3, 8, 1, 1),
(144, 85, 3, 9, 1, 1),
(145, 86, 3, 9, 1, 1),
(146, 87, 3, 9, 1, 1),
(147, 88, 3, 9, 1, 1),
(148, 89, 3, 9, 1, 1),
(149, 91, 3, 10, 1, 1),
(150, 92, 3, 10, 1, 1),
(151, 93, 3, 10, 1, 1),
(152, 94, 3, 10, 1, 1),
(153, 95, 3, 10, 1, 1),
(154, 96, 3, 10, 1, 1),
(155, 97, 3, 10, 1, 1),
(156, 98, 3, 10, 1, 1),
(157, 99, 3, 10, 1, 1),
(158, 100, 3, 10, 1, 1),
(159, 101, 3, 10, 1, 1),
(160, 104, 3, 11, 1, 1),
(161, 105, 3, 11, 1, 1),
(162, 106, 3, 11, 1, 1),
(163, 107, 3, 11, 1, 1),
(164, 108, 3, 11, 1, 1),
(165, 1, 4, 1, 1, 1),
(166, 2, 4, 1, 1, 1),
(167, 3, 4, 1, 1, 1),
(168, 4, 4, 1, 1, 1),
(169, 5, 4, 1, 1, 1),
(170, 6, 4, 1, 1, 1),
(171, 7, 4, 1, 1, 1),
(172, 8, 4, 1, 1, 1),
(173, 9, 4, 2, 1, 1),
(174, 10, 4, 2, 1, 1),
(175, 11, 4, 2, 1, 1),
(176, 12, 4, 2, 1, 1),
(177, 13, 4, 2, 1, 1),
(178, 14, 4, 2, 1, 1),
(179, 15, 4, 2, 1, 1),
(180, 16, 4, 2, 1, 1),
(181, 17, 4, 2, 1, 1),
(182, 18, 4, 2, 1, 1),
(183, 19, 4, 2, 1, 1),
(184, 20, 4, 3, 1, 1),
(185, 21, 4, 3, 1, 1),
(186, 22, 4, 3, 1, 1),
(187, 23, 4, 3, 1, 1),
(188, 24, 4, 3, 1, 1),
(189, 25, 4, 3, 1, 1),
(190, 26, 4, 3, 1, 1),
(191, 27, 4, 3, 1, 1),
(192, 28, 4, 4, 1, 1),
(193, 29, 4, 4, 1, 1),
(194, 30, 4, 4, 1, 1),
(195, 31, 4, 4, 1, 1),
(196, 32, 4, 4, 1, 1),
(197, 33, 4, 4, 1, 1),
(198, 34, 4, 4, 1, 1),
(199, 35, 4, 4, 1, 1),
(200, 36, 4, 4, 1, 1),
(201, 37, 4, 4, 1, 1),
(202, 38, 4, 4, 1, 1),
(203, 39, 4, 4, 1, 1),
(204, 40, 4, 4, 1, 1),
(205, 41, 4, 4, 1, 1),
(206, 42, 4, 4, 1, 1),
(207, 43, 4, 4, 1, 1),
(208, 44, 4, 5, 1, 1),
(209, 45, 4, 5, 1, 1),
(210, 46, 4, 5, 1, 1),
(211, 47, 4, 5, 1, 1),
(212, 48, 4, 5, 1, 1),
(213, 49, 4, 5, 1, 1),
(214, 50, 4, 5, 1, 1),
(215, 51, 4, 5, 1, 1),
(216, 52, 4, 5, 1, 1),
(217, 53, 4, 5, 1, 1),
(218, 54, 4, 6, 1, 1),
(219, 55, 4, 6, 1, 1),
(220, 56, 4, 6, 1, 1),
(221, 57, 4, 6, 1, 1),
(222, 58, 4, 6, 1, 1),
(223, 59, 4, 6, 1, 1),
(224, 60, 4, 6, 1, 1),
(225, 61, 4, 6, 1, 1),
(226, 62, 4, 6, 1, 1),
(227, 63, 4, 6, 1, 1),
(228, 64, 4, 6, 1, 1),
(229, 65, 4, 7, 1, 1),
(230, 66, 4, 7, 1, 1),
(231, 67, 4, 7, 1, 1),
(232, 68, 4, 7, 1, 1),
(233, 69, 4, 7, 1, 1),
(234, 70, 4, 7, 1, 1),
(235, 71, 4, 7, 1, 1),
(236, 72, 4, 7, 1, 1),
(237, 73, 4, 7, 1, 1),
(238, 74, 4, 7, 1, 1),
(239, 75, 4, 7, 1, 1),
(240, 76, 4, 7, 1, 1),
(241, 77, 4, 8, 1, 1),
(242, 78, 4, 8, 1, 1),
(243, 79, 4, 8, 1, 1),
(244, 80, 4, 8, 1, 1),
(245, 81, 4, 8, 1, 1),
(246, 82, 4, 8, 1, 1),
(247, 83, 4, 8, 1, 1),
(248, 84, 4, 8, 1, 1),
(249, 85, 4, 9, 1, 1),
(250, 86, 4, 9, 1, 1),
(251, 87, 4, 9, 1, 1),
(252, 88, 4, 9, 1, 1),
(253, 89, 4, 9, 1, 1),
(254, 90, 4, 9, 1, 1),
(255, 91, 4, 10, 1, 1),
(256, 92, 4, 10, 1, 1),
(257, 93, 4, 10, 1, 1),
(258, 94, 4, 10, 1, 1),
(259, 95, 4, 10, 1, 1),
(260, 96, 4, 10, 1, 1),
(261, 97, 4, 10, 1, 1),
(262, 98, 4, 10, 1, 1),
(263, 99, 4, 10, 1, 1),
(264, 100, 4, 10, 1, 1),
(265, 101, 4, 10, 1, 1),
(266, 102, 4, 10, 1, 1),
(267, 103, 4, 10, 1, 1),
(268, 104, 4, 11, 1, 1),
(269, 105, 4, 11, 1, 1),
(270, 106, 4, 11, 1, 1),
(271, 107, 4, 11, 1, 1),
(272, 108, 4, 11, 1, 1),
(273, 109, 4, 11, 1, 1),
(274, 110, 4, 11, 1, 1),
(275, 111, 4, 11, 1, 1),
(276, 112, 4, 11, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_preg` int(10) NOT NULL,
  `pregunta` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `est_preg` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_preg`, `pregunta`, `created_at`, `updated_at`, `est_preg`) VALUES
(1, 'Realiza su trabajo con entusiasmo y de manera positiva.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(2, 'Cumple las tareas asignadas en las fechas establecidas', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(3, 'Establece metas claras a los miembros de su equipo y les da seguimiento.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(4, 'Identifica y sobrepasa las barreras que dificultan o retrasan el logro de los planes u objetivos de su unidad de trabajo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(5, 'Identifica y elimina oportunamente los desempe?os ineficientes en su equipo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(6, 'Promueve en su equipo el sentido de cumplimiento y compromiso, con su propio ejemplo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(7, 'Prioriza el uso de recursos y mantiene orientado a su equipo sobre los niveles de prioridad requeridos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(8, 'Identifica y se enfoca en la entrega de prioridades claves, reorganizando proactivamente la distribuci?n de funciones, cargas de trabajo, y recursos disponibles.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(9, 'Cumple con las normas, politicas y valores de la compania.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(10, 'Se adapta a la organizacion respetando la cultura de la empresa.  ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(11, 'Se identiftica con la mision, vision y directrices de la empresa, y manifiesta conducta consistente con los intereses y valores de la organizacion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(12, 'Modela con su actuacion las politicas, procedimientos y cultura organizacional.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(13, 'Toma las medidas disciplinarias necesarias en caso de identificar el no cumplimiento  con los lineamientos establecidos por parte de los miembros de su equipo o de su unidad de trabajo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(14, 'Revisa, mejora y promueve constamenteme las politicas o normas que sean requeridas para el desempeno eficiente, eficaz  e integro de la empresa.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(15, 'Respeta y apoya las decisiones que beneficien a la empresa aun cuando estas sean controversiales.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(16, 'Exhibe en la comunidad los valores que tiene la compania.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(17, 'Se asegura de que todo el mundo conozca la filosofia empresarial.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(18, 'Promueve y reconoce el cumplimiento por parte de todos los empleados de la empresa de las politicas, procedimientos y cultura empresarial.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(19, 'Identifica actitudes y comportamientos no acordes con los lineamientos de la empresa y toma acciones para la eliminacion de los mismos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(20, 'Dice siempre la verdad y la expone a su supervisor aun cuando esta vaya en su propio perjuicio.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(21, 'Identifica situaciones no integras y las notifica inmediatamente a su supervisor.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(22, 'No se identifica ni participa con actividades no integras.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(23, 'Actua en base a principios aun cuando no es facil hacerlo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(24, 'Premia actuaciones de integridad o en caso contrario es inflexible ante situaciones deshonestas.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(25, 'Explica tanto las fortalezas como debilidades de la empresa o los productos que vende, los proyectos, las actividades, en las que se embarca o en las que la institucion se embarca aunque esto pueda ir en detrimento de logro de algun objetivo o venta. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(26, 'Fomenta la cultura de integridad en la empresa.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(27, 'Se preocupa porque en todas las politicas, procedimientos, y cultura de la empresa se acaten los lineamientos morales, eticos y legales.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(28, 'Trata de hacer las cosas bien desde la primera vez.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(29, 'Se preocupa por conocer perfectamente las actividades relacionadas a su trabajo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(30, 'Conoce y cumple con los estandares y las especificaciones de los productos y los procesos que realiza. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(31, 'Se preocupa porque los procesos, productos y servicios que realiza pasen a la siguiente etapa libre de defectos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(32, 'Detecta problemas operativos en su entorno de trabajo que afecten la calidad del producto y propicia la correccion de los mismos, ya sea en procesos, maquinas, companeros de trabajo, materias primas, etc.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(33, 'Garantiza que los productos y servicios realizados por el y/o por su personal directo cumplan con las especificaciones y estandares.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(34, 'Es analitico y mantiene ojo critico permanentemente sobre su entorno de trabajo (productos, procesos, servicios, personal, materias primas y maquinaria, etc. ).', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(35, 'Se preocupa porque el y/o el personal a su cargo cuente con todas las herramientas,  capacitacion y recursos necesarios para lograr el nivel de calidad esperado en los productos y servicios, segun las especificaciones y estandares.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(36, 'Establece clara y oportunamente las especificaciones y los estandares de los productos, servicios, procesos, materias primas y maquinarias, acorde a los requerimientos de sus clientes externos o internos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(37, 'Implementa los mecanismos de medicion y Monitorea periodicamente los resultados de \'el o su equipo para asegurar el cumplimiento de los mismos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(38, 'Se preocupa constamentemente por la identificacion de oportunidades de mejora e implementa los proyectos o planes requeridos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(39, 'Consigue informacion de todas las fuentes disponibles (empleados, clientes internos y externos, proveedores, competidores, y el mercado) para mejorar los productos, procesos y servicios y ser competitivos en el mercado.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(40, 'Verifica periodicamente la satisfaccion del cliente sobre la calidad de los servicios y productos que ofrecemos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(41, 'Define la filosofia de calidad de la empresa y asegura que llegue a todos los niveles de la organizacion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(42, 'Ante situaciones de indecision sobre rentabilidad, motivacion personal, siempre prioriza la calidad del producto o servicio. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(43, 'Vela por la imagen de la empresa ante la sociedad como fabricante de productos y servicios de alta calidad. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(44, 'Muestra inter?s por capacitarse, aprovechando las oportunidades que se presentan de aprender cosas nuevas tanto dentro de sus labores diarias como asistiendo a los cursos y entrenamientos que se le ofrecen. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(45, 'Comparte conocimientos con compa?eros de menos experiencia y los instruye sobre el trabajo a realizar cuando es necesario. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(46, 'Se asegura de la realizaci?n de revisiones peri?dicas de los planes de desarrollo dentro de su equipo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(47, 'Usa los talentos y contribuciones de cada individuo para incrementar la efectividad, reconoce y recompensa los logros, y celebra los acontecimientos positivos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(48, 'Identifica las necesidades de desarrollo y sus tendencias dentro de su grupo de trabajo, proponiendo las soluciones apropiadas.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(49, 'Promueve una cultura que valoriza y reconoce el desarrollo personal', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(50, 'Provee a los miembros de su equipo con retroalilmentaci?n continua y gu?a (coaching) para desarrollar sus desempe?os.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(51, 'Apoya la cultura de ?no culpabilidad? posibilitando a las personas el aprendizaje de sus errores.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(52, ' Identifica y desarrolla sucesores de las posiciones claves, incluyendo su propia posici?n. Atrae, desarrolla y retiene personal de alto calibre.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(53, 'Propicia un clima organizacional donde todos se sientan motivados a desarrollar sus potencialidades. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(54, 'Es flexible y se adapta a las nuevas ideas y nuevas funciones en su operacion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(55, 'Identifica y notifica/sugiere sobre posibles mejoras en su operacion. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(56, 'Solicita que se hagan las mejoras en su area tal y como se han hecho en otras areas.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(57, 'Hace cosas nuevas o diferentes con impacto en los resultados de su unidad.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(58, 'Identifica frecuentemetne posibilidades de mejora, eliminacion de procesos innecesarios, oportunidades de mejora de calidad,  reduccion de costos, etc. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(59, 'Asume responsabilidad y orienta sobre el impacto del cambio sobre las persona, sistemas y procesos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(60, 'Reduce la incertidumbre frente al cambio afrontando los problemas de los diferentes grupos de interes.  .', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(61, 'Constantemente motiva, investiga e implementa las mas valiosas ideas, suyas y las de otros.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(62, 'Propician la cultura de innovacion a todo lo largo de la empresa generando soluciones innovadoras a situaciones que retan el estatus quo de la empresa orientandolos al crecimiento del negocio.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(63, 'Desarrolla la capacidad de manejar eficientemente el cambio en la empresa. Identifica y remueve las barreras al cambio dentro de la organizacion. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(64, 'Crea un ambiente donde las personas no sientan que el cambio no es una amenaza para la organizacion y sus miembros. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(65, ' Aun cuando no tiene personal a su cargo, influye en forma positiva en su entorno de trabajo modelando los valores de la organizaci?n en sus actuaciones. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(66, 'Suele orientar de manera proactiva a sus compa?eros de trabajo, alent?ndolos a una mejor realizaci?n de su trabajo para el logro de los objetivos del equipo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(67, 'Instruye efectivamente al equipo de trabajo a su cargo sobre las tareas a realizar, logrando los resultados esperados.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(68, 'Comunica oportunamente a su equipo los objetivos a alcanzar, localizando los recursos necesarios para completarlos y motiv?ndoles a hacer su mejor esfuerzo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_preg` int(3) NOT NULL,
  `pregunta` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `est_preg` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_preg`, `pregunta`, `created_at`, `updated_at`, `est_preg`) VALUES
(1, 'Realiza su trabajo con entusiasmo y de manera positiva.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(2, 'Cumple las tareas asignadas en las fechas establecidas', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(3, 'Establece metas claras a los miembros de su equipo y les da seguimiento.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(4, 'Identifica y sobrepasa las barreras que dificultan o retrasan el logro de los planes u objetivos de su unidad de trabajo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(5, 'Identifica y elimina oportunamente los desempe?os ineficientes en su equipo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(6, 'Promueve en su equipo el sentido de cumplimiento y compromiso, con su propio ejemplo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(7, 'Prioriza el uso de recursos y mantiene orientado a su equipo sobre los niveles de prioridad requeridos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(8, 'Identifica y se enfoca en la entrega de prioridades claves, reorganizando proactivamente la distribuci?n de funciones, cargas de trabajo, y recursos disponibles.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(9, 'Cumple con las normas, politicas y valores de la compania.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(10, 'Se adapta a la organizacion respetando la cultura de la empresa.  ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(11, 'Se identiftica con la mision, vision y directrices de la empresa, y manifiesta conducta consistente con los intereses y valores de la organizacion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(12, 'Modela con su actuacion las politicas, procedimientos y cultura organizacional.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(13, 'Toma las medidas disciplinarias necesarias en caso de identificar el no cumplimiento  con los lineamientos establecidos por parte de los miembros de su equipo o de su unidad de trabajo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(14, 'Revisa, mejora y promueve constamenteme las politicas o normas que sean requeridas para el desempeno eficiente, eficaz  e integro de la empresa.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(15, 'Respeta y apoya las decisiones que beneficien a la empresa aun cuando estas sean controversiales.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(16, 'Exhibe en la comunidad los valores que tiene la compania.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(17, 'Se asegura de que todo el mundo conozca la filosofia empresarial.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(18, 'Promueve y reconoce el cumplimiento por parte de todos los empleados de la empresa de las politicas, procedimientos y cultura empresarial.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(19, 'Identifica actitudes y comportamientos no acordes con los lineamientos de la empresa y toma acciones para la eliminacion de los mismos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(20, 'Dice siempre la verdad y la expone a su supervisor aun cuando esta vaya en su propio perjuicio.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(21, 'Identifica situaciones no integras y las notifica inmediatamente a su supervisor.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(22, 'No se identifica ni participa con actividades no integras.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(23, 'Actua en base a principios aun cuando no es facil hacerlo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(24, 'Premia actuaciones de integridad o en caso contrario es inflexible ante situaciones deshonestas.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(25, 'Explica tanto las fortalezas como debilidades de la empresa o los productos que vende, los proyectos, las actividades, en las que se embarca o en las que la institucion se embarca aunque esto pueda ir en detrimento de logro de algun objetivo o venta. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(26, 'Fomenta la cultura de integridad en la empresa.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(27, 'Se preocupa porque en todas las politicas, procedimientos, y cultura de la empresa se acaten los lineamientos morales, eticos y legales.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(28, 'Trata de hacer las cosas bien desde la primera vez.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(29, 'Se preocupa por conocer perfectamente las actividades relacionadas a su trabajo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(30, 'Conoce y cumple con los estandares y las especificaciones de los productos y los procesos que realiza. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(31, 'Se preocupa porque los procesos, productos y servicios que realiza pasen a la siguiente etapa libre de defectos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(32, 'Detecta problemas operativos en su entorno de trabajo que afecten la calidad del producto y propicia la correccion de los mismos, ya sea en procesos, maquinas, companeros de trabajo, materias primas, etc.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(33, 'Garantiza que los productos y servicios realizados por el y/o por su personal directo cumplan con las especificaciones y estandares.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(34, 'Es analitico y mantiene ojo critico permanentemente sobre su entorno de trabajo (productos, procesos, servicios, personal, materias primas y maquinaria, etc. ).', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(35, 'Se preocupa porque el y/o el personal a su cargo cuente con todas las herramientas,  capacitacion y recursos necesarios para lograr el nivel de calidad esperado en los productos y servicios, segun las especificaciones y estandares.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(36, 'Establece clara y oportunamente las especificaciones y los estandares de los productos, servicios, procesos, materias primas y maquinarias, acorde a los requerimientos de sus clientes externos o internos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(37, 'Implementa los mecanismos de medicion y Monitorea periodicamente los resultados de \'el o su equipo para asegurar el cumplimiento de los mismos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(38, 'Se preocupa constamentemente por la identificacion de oportunidades de mejora e implementa los proyectos o planes requeridos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(39, 'Consigue informacion de todas las fuentes disponibles (empleados, clientes internos y externos, proveedores, competidores, y el mercado) para mejorar los productos, procesos y servicios y ser competitivos en el mercado.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(40, 'Verifica periodicamente la satisfaccion del cliente sobre la calidad de los servicios y productos que ofrecemos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(41, 'Define la filosofia de calidad de la empresa y asegura que llegue a todos los niveles de la organizacion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(42, 'Ante situaciones de indecision sobre rentabilidad, motivacion personal, siempre prioriza la calidad del producto o servicio. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(43, 'Vela por la imagen de la empresa ante la sociedad como fabricante de productos y servicios de alta calidad. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(44, 'Muestra inter?s por capacitarse, aprovechando las oportunidades que se presentan de aprender cosas nuevas tanto dentro de sus labores diarias como asistiendo a los cursos y entrenamientos que se le ofrecen. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(45, 'Comparte conocimientos con compa?eros de menos experiencia y los instruye sobre el trabajo a realizar cuando es necesario. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(46, 'Se asegura de la realizaci?n de revisiones peri?dicas de los planes de desarrollo dentro de su equipo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(47, 'Usa los talentos y contribuciones de cada individuo para incrementar la efectividad, reconoce y recompensa los logros, y celebra los acontecimientos positivos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(48, 'Identifica las necesidades de desarrollo y sus tendencias dentro de su grupo de trabajo, proponiendo las soluciones apropiadas.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(49, 'Promueve una cultura que valoriza y reconoce el desarrollo personal', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(50, 'Provee a los miembros de su equipo con retroalilmentaci?n continua y gu?a (coaching) para desarrollar sus desempe?os.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(51, 'Apoya la cultura de ?no culpabilidad? posibilitando a las personas el aprendizaje de sus errores.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(52, ' Identifica y desarrolla sucesores de las posiciones claves, incluyendo su propia posici?n. Atrae, desarrolla y retiene personal de alto calibre.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(53, 'Propicia un clima organizacional donde todos se sientan motivados a desarrollar sus potencialidades. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(54, 'Es flexible y se adapta a las nuevas ideas y nuevas funciones en su operacion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(55, 'Identifica y notifica/sugiere sobre posibles mejoras en su operacion. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(56, 'Solicita que se hagan las mejoras en su area tal y como se han hecho en otras areas.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(57, 'Hace cosas nuevas o diferentes con impacto en los resultados de su unidad.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(58, 'Identifica frecuentemetne posibilidades de mejora, eliminacion de procesos innecesarios, oportunidades de mejora de calidad,  reduccion de costos, etc. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(59, 'Asume responsabilidad y orienta sobre el impacto del cambio sobre las persona, sistemas y procesos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(60, 'Reduce la incertidumbre frente al cambio afrontando los problemas de los diferentes grupos de interes.  .', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(61, 'Constantemente motiva, investiga e implementa las mas valiosas ideas, suyas y las de otros.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(62, 'Propician la cultura de innovacion a todo lo largo de la empresa generando soluciones innovadoras a situaciones que retan el estatus quo de la empresa orientandolos al crecimiento del negocio.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(63, 'Desarrolla la capacidad de manejar eficientemente el cambio en la empresa. Identifica y remueve las barreras al cambio dentro de la organizacion. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(64, 'Crea un ambiente donde las personas no sientan que el cambio no es una amenaza para la organizacion y sus miembros. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(65, ' Aun cuando no tiene personal a su cargo, influye en forma positiva en su entorno de trabajo modelando los valores de la organizaci?n en sus actuaciones. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(66, 'Suele orientar de manera proactiva a sus compa?eros de trabajo, alent?ndolos a una mejor realizaci?n de su trabajo para el logro de los objetivos del equipo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(67, 'Instruye efectivamente al equipo de trabajo a su cargo sobre las tareas a realizar, logrando los resultados esperados.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(68, 'Comunica oportunamente a su equipo los objetivos a alcanzar, localizando los recursos necesarios para completarlos y motiv?ndoles a hacer su mejor esfuerzo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(69, 'Logra que los dem?s apoyen las los objetivos del equipo y se sientan motivados a su realizaci?n.,', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(70, 'Es un modelo de actuaci?n para los dem?s y transmite credibilidad y confianza. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(71, 'Se preocupa por poner retos que contribuyan al desarrollo de los miembros de su equipo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(72, 'Reconoce y premia oportunamente actuaciones que excedan los estandares.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(73, 'Gu?a la organizaci?n hacia el cumplimiento de la visi?n y las estrategias corporativas.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(74, 'Fomenta la creaci?n de un ambiente de participaci?n y comunicaci?n a todos los niveles, transmietiendo de manera clara y efectiva los objetivos de la empresa.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(75, 'Define las estrategias, pol?ticas y planes organizacionales, logrando que los dem?s los apoyen y sigan.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(76, 'Direcciona y promueve la cultura organizacional a travez de la definici?n y difusi?n de los lineamientos corporativos claves.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(77, 'Puede clasificar los requerimientos que se le realizan de acuerdo al criterio b?sico de urgente y/o importante, y las combinaciones de las mismas, para decidir el orden de las acciones a realizar.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(78, 'Se preocupa por conocer la informaci?n relativa a las prioridades de la empresa para distribuir las tareas del grupo bajo su supervision de modo que vayan alineadas a las mismas.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(79, 'Comunica al personal a su cargo las prioridades de la empresa y los objetivos de sus departamentos o areas.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(80, 'Conoce los factores criticos que pueden alterar  los resultados de la unidad de trabajo.  ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(81, 'El  orden de ejecucion de sus acciones  o de su area de negocio se  fundamenta en la utilizacion de criterios de impacto sobre la creacion de valor para los clientes, accionistas y empleados.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(82, 'Distribuye adecuadamente su tiempo y el de su equipo de trabajo de forma que pueda completar las tareas o acciones en orden de importancia o prioridad requerido, usa eficientemente el  tiempo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(83, 'Plantea y ejecuta  la planificacion estrategica de la empresa en orden de importancia y urgencia  para los resultados esperados de la organizaci?n. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(84, 'Se preocupa por conocer ifnormacion de relevancia, tendencias de la industria en todos sus ambitos, y establece las prioridades de la empresa.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(85, 'Se preocupa porque todos los elementos necesarios para la realizaci?n de sus labores est?n debidamente colocados o disponibles en el momento oportuno.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(86, 'Se asegura de que los miembros de su equipo dispongan oportunamente de los elementos o informaciones necesarias para el cumplimiento de sus tareas de manera eficiente y efectiva. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(87, 'Se prepara anticipadamente a la realizaci?n de sus compromisos de modo tal que las mismas se realicen seg?n lo esperado', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(88, 'Modela y motiva una conducta de orden y preparaci?n,  no dejando para ?ltimo momento las responsabilidades a su cargo.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(89, 'Prioriza sus asignaciones, cumple con los objetivos ropuestos y entrega los trabajos en tiempos razonables.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(90, 'Maneja el tiempo de forma eficiente, organiza sus proyectos y decisiones de forma efectiva, evitando cambios poco planificados que puedan afectar la rentabilidad del negocio y los recursos de la empresa.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(91, 'Escucha las necesidades del otro y demuestra entendimiento.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(92, 'Explica adecuadamente sus necesidades al otro.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(93, 'Acepta las decisiones de concenso.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(94, 'Llega a acuerdos segun la politica y procedimientos establecidos y en caso de dudas remite a su supervisor. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(95, 'Tiene claro los objetivos de la empresa en cada negociacion. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(96, 'Determina las estrategias a seguir para lograr los objetivos en cada negociaci?n.,', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(97, 'Se preocupa por conocer y manejar la informacion adecuada para la negociacion', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(98, 'Consigue resultados de valor para la empresa y para las diferentes partes de una negociacion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(99, 'Es abierto a nuevas altenativas que resulten m?s beneficiosas, diferentes a las propuestas originalmente por ambas partes. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(100, 'Evalua los riesgos y el impacto de las negociaciones en la empresa.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(101, 'Tiene la habilidad de conocer las referencias en el mercado sobre tema objeto de negociacion, de escuchar a las partes de integrar posiciones divergentes y lograr acuerdos beneficiosos para todos. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(102, 'Consigue acuerdos de largo plazo alineados a la planificacion estrategica y altamente rentables para la empresa.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(103, 'Establece acuerdos estrategicos con instituciones gubernamentales y privadas, clientes y proveedores de alto nivel, alianzas comerciales, fusiones, compras de empresas. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(104, 'Observa y comunica detalles, actividades o condiciones que considere relevantes para el logro de sus tareas o el cumplimiento con los estandares de la empresa.  ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(105, 'Se preocupa por obtener informacion relativa a su trabajo y su entorno y la compara contra los estandares establecidos.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(106, 'Identifica desviaciones de resultados no acorde a los estandares y  propone posibles alternativas de solucion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(107, 'Evalua las situaciones u oportunidades considerando los diferentes escenarios resultantes en cuanto a su posible impacto sobre la rentabilidad, la calidad, seguridad, servicio al cliente y motivacion del personal, y toma la decision de mayor valor agregado.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(108, 'Es capaz de desglozar sistematicamente una situacion compleja en partes manejables, puede anticipar obstaculos que podrian aparecer en un proceso o situacion, toma accion.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(109, 'Identifica areas de oportunidad para la empresa en el ambito de innovacion, mercadeo, etc. y las aprovecha.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(110, 'Identifica y promueve personal analitico.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(111, 'Toma las mejores decisiones donde todo el mundo sale beneficiado . ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on'),
(112, 'Hace comparaciones entre los estandares de la empresa y los de la industria y puede tomar la mejor alternativa. A partir de informacion compilada, puede orientar la empresa al logro de las mismas.  ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'on');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_resp` int(10) NOT NULL,
  `id_com` int(11) NOT NULL,
  `id_userx` int(11) NOT NULL,
  `data_result` varchar(1000) NOT NULL,
  `evaluated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restablecimiento`
--

CREATE TABLE `restablecimiento` (
  `id_rest` int(11) NOT NULL,
  `email_user` int(11) NOT NULL,
  `token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `restablecimiento`
--

INSERT INTO `restablecimiento` (`id_rest`, `email_user`, `token`) VALUES
(1, 0, 97);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` bigint(20) UNSIGNED NOT NULL,
  `name_roles` varchar(20) NOT NULL,
  `description_roles` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `name_roles`, `description_roles`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2023-01-10 22:18:51', '2023-01-10 22:18:51'),
(2, 'user', 'User', '2023-01-10 22:18:51', '2023-01-10 22:18:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Evaluación 360', 'info@example.com', '1111111', 'REP. DOM.', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(10) NOT NULL,
  `name_user` varchar(200) NOT NULL,
  `email_user` varchar(200) NOT NULL,
  `pass_user` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo_user` bigint(10) NOT NULL,
  `cargo_user` varchar(50) NOT NULL,
  `supervisor_user` varchar(50) NOT NULL,
  `id_dep` int(10) NOT NULL,
  `id_roles` int(10) NOT NULL,
  `id_wl` int(10) NOT NULL,
  `est_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `worklevel`
--

CREATE TABLE `worklevel` (
  `id_wl` bigint(20) UNSIGNED NOT NULL,
  `name_wl` varchar(50) NOT NULL,
  `description_wl` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `worklevel`
--

INSERT INTO `worklevel` (`id_wl`, `name_wl`, `description_wl`, `created_at`, `updated_at`) VALUES
(1, 'Worklevel 1', 'Worklevel 1', '2023-02-02 12:56:37', NULL),
(2, 'Worklevel 2', 'Worklevel 2', '2023-02-02 12:56:37', NULL),
(3, 'Worklevel 3', 'Worklevel 3', '2023-02-02 12:56:37', NULL),
(4, 'Worklevel 4', 'Worklevel 4', '2023-02-02 12:56:37', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `competencia`
--
ALTER TABLE `competencia`
  ADD PRIMARY KEY (`id_com`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`id_eva`);

--
-- Indices de la tabla `lista_preg`
--
ALTER TABLE `lista_preg`
  ADD PRIMARY KEY (`id_lp`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_preg`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_preg`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_resp`);

--
-- Indices de la tabla `restablecimiento`
--
ALTER TABLE `restablecimiento`
  ADD PRIMARY KEY (`id_rest`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `worklevel`
--
ALTER TABLE `worklevel`
  ADD PRIMARY KEY (`id_wl`),
  ADD UNIQUE KEY `worklevel_name_unique` (`name_wl`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `competencia`
--
ALTER TABLE `competencia`
  MODIFY `id_com` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_dep` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `id_eva` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lista_preg`
--
ALTER TABLE `lista_preg`
  MODIFY `id_lp` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_preg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_preg` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_resp` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `restablecimiento`
--
ALTER TABLE `restablecimiento`
  MODIFY `id_rest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `worklevel`
--
ALTER TABLE `worklevel`
  MODIFY `id_wl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
