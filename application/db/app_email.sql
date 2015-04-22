-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-04-2014 a las 00:44:34
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `app_email`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dep`
--

CREATE TABLE IF NOT EXISTS `dep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `cantidad` text NOT NULL,
  `marcacion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `dep`
--

INSERT INTO `dep` (`id`, `nombre`, `cantidad`, `marcacion`) VALUES
(1, 'Petén', '10', '6024'),
(2, 'Huehuetenango', '10', '6024'),
(3, 'Quiché', '10', '6024'),
(4, 'Alta Verapaz', '10', '6024'),
(5, 'Izabal', '10', '6024'),
(6, 'San Marcos', '10', '6024'),
(7, 'Quetzaltenango', '10', '6024'),
(8, 'Totonicapán', '10', '6024'),
(9, 'Sololá', '10', '6024'),
(10, 'Chimaltenango', '10', '6024'),
(11, 'Sacatepéquez', '10', '6024'),
(12, 'Guatemala', '10', '6024'),
(13, 'Baja Verapaz', '10', '6024'),
(14, 'El Progreso', '10', '6024'),
(15, 'Jalapa', '10', '6024'),
(16, 'Zacapa', '10', '6024'),
(17, 'Chiquimula', '10', '6024'),
(18, 'Retalhuleu', '10', '6024'),
(19, 'Suchitepéquez', '10', '6024'),
(20, 'Escuintla', '10', '6024'),
(21, 'Santa Rosa', '10', '6024'),
(22, 'Jutiapa', '10', '6024');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mensaje` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `dep_id`, `fecha`, `mensaje`) VALUES
(1, 1, '2014-04-07 21:35:58', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes'),
(2, 2, '2014-04-07 21:35:58', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes'),
(3, 3, '2014-04-07 21:36:21', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes'),
(4, 4, '2014-04-07 21:36:21', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes'),
(5, 3, '2014-04-07 21:36:32', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes'),
(6, 4, '2014-04-07 21:36:32', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes'),
(7, 5, '2014-04-07 21:36:56', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes'),
(8, 6, '2014-04-07 21:36:56', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
