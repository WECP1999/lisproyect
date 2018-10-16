-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-10-2018 a las 19:43:49
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lisproyect`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `id` varchar(5) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `contra` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `apellido`, `usuario`, `contra`, `created_at`, `updated_at`) VALUES
('D0001', 'Herson Antonio', 'Castillo Tevez', 'herson1', '123456', '2018-04-16', '2018-04-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` varchar(5) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `telefono` varchar(150) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `contra` varchar(150) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_seccion` (`id_seccion`),
  KEY `especialidad` (`id_especialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellido`, `telefono`, `id_especialidad`, `direccion`, `estado`, `contra`, `id_seccion`, `created_at`, `updated_at`) VALUES
('A0001', 'Walter Ernesto', 'Corpeño Parada', '7685-7731', 3, 'Calle El Progreso 2748, San Salvador', 1, '123456', 5, '2018-04-16', '2018-05-04'),
('A0002', 'Marvin', 'Pocasangre', '6532-6598', 1, 'Col Altavista primera etapa', 1, 'Onepiece2', 2, '2018-04-27', '2018-05-05'),
('A0003', 'Raul', 'López Torres', '6872-8795', 1, 'Soyapango, San Salvador', 1, 'Raulito1', 2, '2018-05-11', '2018-05-11'),
('A0008', 'Claudia', 'Corpeño', '2265-7865', 1, 'Mi casa', 1, 'Onepiece1', 3, '2018-05-05', '2018-05-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

DROP TABLE IF EXISTS `asignacion`;
CREATE TABLE IF NOT EXISTS `asignacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_maestro` varchar(5) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_maestro` (`id_maestro`),
  KEY `id_materia` (`id_materia`),
  KEY `id_seccion` (`id_seccion`),
  KEY `id_seccion_2` (`id_seccion`),
  KEY `id_materia_2` (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignacion`
--

INSERT INTO `asignacion` (`id`, `id_maestro`, `id_materia`, `id_seccion`, `created_at`, `updated_at`) VALUES
(1, 'M0003', 1, 2, '2018-04-27', '2018-04-27'),
(3, 'M0003', 2, 3, '2018-04-27', '2018-04-27'),
(4, 'M0004', 2, 3, '2018-05-11', '2018-05-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE IF NOT EXISTS `especialidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Informática', '2018-04-16', '2018-04-16'),
(2, 'Electrónica', '2018-04-16', '2018-04-16'),
(3, 'Diseño gráfico', '2018-04-16', '2018-04-16'),
(4, 'Mecánica', '2018-04-16', '2018-04-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `porcentaje` decimal(10,0) NOT NULL,
  `periodo` int(11) NOT NULL,
  `id_asignacion` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_asignacion` (`id_asignacion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`id`, `nombre`, `descripcion`, `porcentaje`, `periodo`, `id_asignacion`, `created_at`, `updated_at`) VALUES
(1, 'Robot', 'Consiste en que vas a hacer un robot que saque informacion de una url', '60', 1, 1, '2018-04-27', '2018-04-27'),
(2, 'Parcial', 'Parcial teorico de los fundamentos de PHP', '35', 1, 1, '2018-04-27', '2018-04-27'),
(3, 'Avance', 'Avance de proyecto', '5', 1, 1, '2018-04-27', '2018-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

DROP TABLE IF EXISTS `maestros`;
CREATE TABLE IF NOT EXISTS `maestros` (
  `id` varchar(5) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `contra` varchar(150) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`id`, `nombre`, `apellido`, `usuario`, `contra`, `estado`, `created_at`, `updated_at`) VALUES
('M0001', 'Guillermo', 'Calderon', 'guille2', '123456', 1, '2018-04-16', '2018-05-04'),
('M0002', 'Miguel', 'Orellana García', 'miguel1', 'oNEPIECE1', 1, '2018-04-16', '2018-04-27'),
('M0003', 'Henry', 'Avalos', 'hpor1', 'oNEPIECE2', 0, '2018-04-23', '2018-05-11'),
('M0004', 'Manuel Francisco', 'Guandique Lovo', 'guandique1', 'Lovo123456', 1, '2018-05-11', '2018-05-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Lenguaje interpretedo en el cliente', '2018-04-27', '2018-04-27'),
(2, 'Programacion oriente a objetos l', '2018-04-27', '2018-04-27'),
(3, 'Técnica y análisis de diseño de sistemas', '2018-05-11', '2018-05-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

DROP TABLE IF EXISTS `nota`;
CREATE TABLE IF NOT EXISTS `nota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nota` decimal(10,0) NOT NULL,
  `id_evaluacion` int(11) NOT NULL,
  `id_alumno` varchar(5) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evaluacion` (`id_evaluacion`),
  KEY `id_alumno` (`id_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id`, `nota`, `id_evaluacion`, `id_alumno`, `created_at`, `updated_at`) VALUES
(2, '10', 3, 'A0002', 2018, 2018),
(3, '5', 1, 'A0002', 2018, 2018),
(4, '0', 1, 'A0002', 2018, 2018),
(5, '10', 1, 'A0003', 2018, 2018),
(6, '10', 2, 'A0002', 2018, 2018),
(7, '0', 2, 'A0002', 2018, 2018),
(8, '0', 2, 'A0003', 2018, 2018),
(9, '0', 3, 'A0002', 2018, 2018),
(10, '0', 3, 'A0003', 2018, 2018);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `seccion` varchar(5) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `year`, `seccion`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', '2018-04-16', '2018-04-16'),
(2, 1, 'B', '2018-04-16', '2018-04-16'),
(3, 1, 'C', '2018-04-16', '2018-04-16'),
(4, 1, 'D', '2018-04-16', '2018-04-16'),
(5, 1, 'E', '2018-04-16', '2018-04-16'),
(6, 1, 'F', '2018-04-16', '2018-04-16');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`id_maestro`) REFERENCES `maestros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignacion_ibfk_3` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `evaluacion_ibfk_1` FOREIGN KEY (`id_asignacion`) REFERENCES `asignacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_evaluacion`) REFERENCES `evaluacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
