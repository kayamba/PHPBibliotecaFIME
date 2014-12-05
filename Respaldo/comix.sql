-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-08-2014 a las 20:49:40
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `comix`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `paterno` varchar(50) NOT NULL,
  `matero` varchar(50) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `cp` int(10) unsigned NOT NULL,
  `correo` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de clientes para la renta de libros' AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `paterno`, `matero`, `direccion`, `telefono`, `cp`, `correo`) VALUES
(1, 'Francisco', 'Lumbreras', 'Fabian', 'Calle falsa #123', '8116633804', 66444, 'lumbreras20@hotmail.com'),
(3, 'Tannia Melissa ', 'Venegas', 'Chavez', 'Calle falsa 123', '', 66444, 'tannia.melissa@gmail.com'),
(4, 'Tannia Melissa ', 'Venegas', 'Chavez', 'Calle falsa 123', '', 66444, 'tannia.melissa@gmail.com'),
(5, 'Tannia Melissa ', 'Venegas', 'Chavez', 'Calle falsa 123', '', 66444, 'tannia.melissa@gmail.com');

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
  `Precio` decimal(10,0) NOT NULL,
  `Descripcion` text,
  `URL` varchar(80) DEFAULT 'imagen.jpg',
  PRIMARY KEY (`IdProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IdProducto`, `Titulo`, `Tipo`, `Editorial`, `Autor`, `Disponibilidad`, `Precio`, `Descripcion`, `URL`) VALUES
(5, 'Manga', 'Otaku', 'Takataka', 'Ksutsek', 10, '79', '                                    sdfsdfsdf          sada                    ', 'uploads/kyoukai_no_kanata_013.jpg'),
(7, 'Superboy', 'Comic', 'DC Universe', 'Jerry Siegel', 40, '50', '', 'uploads/superboy.jpg'),
(8, 'Naruto', 'Manga', 'Panini', 'Masashi Kishimoto', 63, '120', '', 'uploads/147980dz.jpg'),
(9, 'One Piece', 'Manga', 'Panini', 'Eiichiro Oda', 69, '120', '', 'uploads/001ka3.jpg'),
(10, 'Death Note', 'Manga', 'Panini', 'Tsugumi Oba & Takeshi Oba', 12, '100', '', 'uploads/Death_Note-1.jpg'),
(11, 'Tengen Toppa Gurren-Laggan', 'Manga', 'Glenat', 'Hiroyuki Imaishi', 27, '100', '', 'uploads/lagann1.jpg'),
(12, 'Sword Art Online', 'Manga', 'Glenat', 'Reki Kawahara & Abec', 13, '100', '', 'uploads/sao.jpg'),
(13, 'Ultimate Comics All New Spiderman ', 'Comic', 'Marvel', 'Brian Michaels Bendis', 27, '50', '', 'uploads/all_new_spiderman.jpg'),
(14, 'Superior Spiderman', 'Comic', 'Marvel', 'Dan Slott', 18, '50', '', 'uploads/Superior_Spider-Man_Vol_1_1_Giuseppe_Camuncoli_Variant.jpg'),
(15, 'Batman new 52', 'Comic', 'DC Universe', 'Bob Kane', 52, '50', '', 'uploads/btaman.jpg'),
(16, 'The Amazing Spiderman', 'Comic', 'Marvel', 'Stan Lee', 700, '50', '', 'uploads/AmazingSpider-Man001.jpg'),
(17, '3 Story', 'Comic', 'Dark Horse', 'Cristos Cage', 24, '50', '', 'uploads/3story.jpg'),
(18, 'Claymore', 'Manga', 'Ivrea', 'Norihiro Yagi', 23, '100', '', 'uploads/claymore.jpg'),
(19, 'Sakura Card Captors ', 'Manga', 'Ivrea', 'CLAMP', 12, '100', '', 'uploads/Cardcaptor_Sakura_vol1_cover.jpg'),
(20, 'Web of Spiderman', 'Comic', 'Marvel', 'Stan Lee', 12, '50', '', 'uploads/web-of-spider-man-1_final-cover-art.jpg'),
(21, 'Green Lantern', 'Comic', 'DC Universe', 'Jhon Broome', 50, '50', '', 'uploads/COMIC_green_lantern_1.jpg');

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
(1, 'asd', '2e3817293fc275dbee74bd71ce6eb056', 'Cliente'),
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
