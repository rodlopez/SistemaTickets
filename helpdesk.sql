-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2014 a las 02:25:07
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `helpdesk`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `apellipa` varchar(20) NOT NULL,
  `apellima` varchar(20) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `apellipa`, `apellima`, `usuario`) VALUES
(1, 'Marco', 'Lopez', 'Escalante', 'marlopez'),
(3, 'Rodrigo', 'Lopez', 'Escalante', 'rodlopez'),
(4, 'Master', 'System', 'Administrador', 'admin'),
(5, 'Blanca', 'Lopez', 'Esclante', 'blalopez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_comentarios`
--

CREATE TABLE IF NOT EXISTS `reportes_comentarios` (
  `id_reporte` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `comentario` text NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `reportes_comentarios`
--

INSERT INTO `reportes_comentarios` (`id_reporte`, `date`, `id_user`, `comentario`, `id`) VALUES
('20140216230444', '20140216231258', 'blalopez', 'swfsdfsdf', 52),
('20140216230444', '20140216233733', 'blalopez', 'sdmlskmvlkdmvkldmfvkldmfkvl', 53),
('20140216230444', '20140217181753', 'blalopez', 'vsvvsvssssssssssssssssssssssssss', 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numrep` varchar(80) NOT NULL,
  `id_error` int(15) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `estatus` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `reports`
--

INSERT INTO `reports` (`id`, `numrep`, `id_error`, `descripcion`, `id_user`, `estatus`) VALUES
(30, '20140216230444', 4, 'scfscfsdr', 'blalopez', 'Cerrado'),
(32, '20140217190310', 5, 'dfvdfv', 'blalopez', '0'),
(33, '20140217191147', 1, 'kmklklnklnklnkl', 'marlopez', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_error`
--

CREATE TABLE IF NOT EXISTS `tipos_error` (
  `id_error` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `error` varchar(200) NOT NULL,
  PRIMARY KEY (`id_error`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `tipos_error`
--

INSERT INTO `tipos_error` (`id_error`, `error`) VALUES
(1, 'No enciende'),
(2, 'Se traba'),
(3, 'No Reconoce nuevos dispositivos'),
(4, 'No Funciona Tecaldo/Mouse'),
(5, 'No lee Discos'),
(6, 'Monitor no se Ve'),
(7, 'Instalar un Programa nuevo'),
(8, 'Actualizar algun Programa'),
(9, 'Borrar algun Programa'),
(10, 'Programa No sirve'),
(11, 'Acceso a una Pagina Externa'),
(12, 'No puedo Acceder a ninguna Pagina'),
(13, 'Alta de Usuario '),
(14, 'Baja de Usuario'),
(15, 'Solicitar Cambio de ContraseÃ±a'),
(16, 'Solicitar Cambio de Permisos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `privilegios` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`, `privilegios`) VALUES
(6, 'marlopez', 'roy5526', 'Usuario'),
(7, 'rodlopez', 'roy5526', 'Administrador'),
(8, 'admin', 'admin', 'Administrador'),
(9, 'blalopez', '12345', 'Usuario');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
