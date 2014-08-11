-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2014 a las 08:23:27
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bdreportes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_apchck`
--

CREATE TABLE IF NOT EXISTS `tbl_apchck` (
  `cchkno` varchar(10) NOT NULL,
  `cvend` varchar(10) NOT NULL,
  `cpayto` varchar(40) NOT NULL,
  `cchktype` varchar(1) NOT NULL,
  `cbankno` varchar(10) NOT NULL,
  `ctogl` varchar(10) NOT NULL,
  `dcheck` datetime NOT NULL,
  `dcreate` datetime NOT NULL,
  `lcancel` tinyint(4) NOT NULL,
  `lhold` tinyint(4) NOT NULL,
  `nchkamt` decimal(16,2) NOT NULL,
  `nxchgrate` decimal(16,2) NOT NULL,
  `nbchkamt` decimal(16,2) NOT NULL,
  PRIMARY KEY (`cchkno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_departamento`
--

CREATE TABLE IF NOT EXISTS `tbl_departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_departamento` varchar(45) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_oficina`
--

CREATE TABLE IF NOT EXISTS `tbl_oficina` (
  `id_oficina` smallint(6) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `id_region` smallint(6) NOT NULL,
  PRIMARY KEY (`id_oficina`),
  UNIQUE KEY `id_region_UNIQUE` (`id_region`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_region`
--

CREATE TABLE IF NOT EXISTS `tbl_region` (
  `id_region` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre_region` varchar(45) NOT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol`
--

CREATE TABLE IF NOT EXISTS `tbl_rol` (
  `id_rol` smallint(6) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_rol`
--

INSERT INTO `tbl_rol` (`id_rol`, `descripcion`) VALUES
(1, 'Admin'),
(2, 'TI'),
(3, 'Contabilidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_rol_usuario` (
  `id_usuario` varchar(45) NOT NULL,
  `id_rol` smallint(6) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_rol_usuario`
--

INSERT INTO `tbl_rol_usuario` (`id_usuario`, `id_rol`) VALUES
('1', 1),
('2', 2),
('3', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id_usuario` varchar(45) NOT NULL,
  `prnombre` varchar(50) NOT NULL,
  `sgnombre` varchar(50) DEFAULT NULL,
  `prapellido` varchar(50) NOT NULL,
  `sgapellido` varchar(50) DEFAULT NULL,
  `clave` varchar(30) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_ultimo_ingreso` datetime DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `prnombre`, `sgnombre`, `prapellido`, `sgapellido`, `clave`, `fecha_creacion`, `fecha_ultimo_ingreso`, `email`) VALUES
('1', 'Osly', 'Jonathan', 'Salinas', 'Padilla', 'mapper', '2014-08-01 00:00:00', '2014-08-10 00:00:00', 'ojsalinas@ministerio.com'),
('2', 'Transito', 'Josue', 'Matamoros', 'Zuniga', 'transito', '2014-08-01 00:00:00', '2014-08-10 00:00:00', 'transito@ministerio.com'),
('3', 'Juan', 'Mekelele', 'Ramirez', 'Ruiz', 'juan', '2014-08-01 00:00:00', '2014-08-10 00:00:00', 'juan@ministerio.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
