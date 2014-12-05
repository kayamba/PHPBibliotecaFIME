-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-05-2014 a las 16:44:46
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `comix`
--
CREATE DATABASE IF NOT EXISTS `comix` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `comix`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `IdPedido` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  PRIMARY KEY (`IdPedido`),
  KEY `IdUsuario` (`IdUsuario`),
  KEY `IdProducto` (`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `IdProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(45) NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  `Editorial` varchar(45) NOT NULL,
  `Autor` varchar(45) NOT NULL,
  `Disponibilidad` int(11) DEFAULT '0',
  `Descripcion` text,
  `URL` varchar(80) DEFAULT 'imagen.jpg',
  PRIMARY KEY (`IdProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IdProducto`, `Titulo`, `Tipo`, `Editorial`, `Autor`, `Disponibilidad`, `Descripcion`, `URL`) VALUES
(5, 'Manga', 'Otaku', 'Takataka', 'Ksutsek', 10, '                                    sdfsdfsdf          sada                    ', 'uploads/kyoukai_no_kanata_013.jpg'),
(7, 'Superboy', 'Comic', 'DC Universe', 'Jerry Siegel', 40, '', 'uploads/superboy.jpg'),
(8, 'Naruto', 'Manga', 'Panini', 'Masashi Kishimoto', 63, '', 'uploads/147980dz.jpg'),
(9, 'One Piece', 'Manga', 'Panini', 'Eiichiro Oda', 69, '', 'uploads/001ka3.jpg'),
(10, 'Death Note', 'Manga', 'Panini', 'Tsugumi Oba & Takeshi Oba', 12, '', 'uploads/Death_Note-1.jpg'),
(11, 'Tengen Toppa Gurren-Laggan', 'Manga', 'Glenat', 'Hiroyuki Imaishi', 27, '', 'uploads/lagann1.jpg'),
(12, 'Sword Art Online', 'Manga', 'Glenat', 'Reki Kawahara & Abec', 13, '', 'uploads/sao.jpg'),
(13, 'Ultimate Comics All New Spiderman ', 'Comic', 'Marvel', 'Brian Michaels Bendis', 27, '', 'uploads/all_new_spiderman.jpg'),
(14, 'Superior Spiderman', 'Comic', 'Marvel', 'Dan Slott', 18, '', 'uploads/Superior_Spider-Man_Vol_1_1_Giuseppe_Camuncoli_Variant.jpg'),
(15, 'Batman new 52', 'Comic', 'DC Universe', 'Bob Kane', 52, '', 'uploads/btaman.jpg'),
(16, 'The Amazing Spiderman', 'Comic', 'Marvel', 'Stan Lee', 700, '', 'uploads/AmazingSpider-Man001.jpg'),
(17, '3 Story', 'Comic', 'Dark Horse', 'Cristos Cage', 24, '', 'uploads/3story.jpg'),
(18, 'Claymore', 'Manga', 'Ivrea', 'Norihiro Yagi', 23, '', 'uploads/claymore.jpg'),
(19, 'Sakura Card Captors ', 'Manga', 'Ivrea', 'CLAMP', 12, '', 'uploads/Cardcaptor_Sakura_vol1_cover.jpg'),
(20, 'Web of Spiderman', 'Comic', 'Marvel', 'Stan Lee', 12, '', 'uploads/web-of-spider-man-1_final-cover-art.jpg'),
(21, 'Green Lantern', 'Comic', 'DC Universe', 'Jhon Broome', 50, '', 'uploads/COMIC_green_lantern_1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nick` varchar(30) NOT NULL,
  `Pass` varchar(32) NOT NULL,
  `Tipo` varchar(10) DEFAULT 'Cliente',
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `Nick`, `Pass`, `Tipo`) VALUES
(1, 'asd', 'c55d52d0b68a73e44dd7dc6bd0381b47', 'Cliente'),
(2, 'Yamba', '9f18c7241adac2def11af1f77d5548ec', 'Admin');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `IdProducto` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`IdProducto`),
  ADD CONSTRAINT `IdUsuario` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
