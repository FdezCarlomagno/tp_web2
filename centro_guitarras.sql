-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2024 a las 21:34:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `centro_guitarras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(1, 'Eléctrica'),
(2, 'Acústica'),
(3, 'Electro-acústica'),
(4, 'sin_categoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guitarra`
--

CREATE TABLE `guitarra` (
  `id_guitarra` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `imagen_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `guitarra`
--

INSERT INTO `guitarra` (`id_guitarra`, `nombre`, `categoria_id`, `precio`, `imagen_url`) VALUES
(16, 'Fender Stratocaster', 1, 3000000, 'https://www.heavenimagenes.com/heavencommerce/0c3d234c-03b5-48ac-85a1-10e80752be67/images/v2/FENDER/1608201401585595_01_medium.jpg'),
(20, 'Gibson Les Paul', 1, 12000000, 'https://musichall.com.py/tienda/wp-content/uploads/2023/05/1GUIGILPDX007CCH1E.jpg'),
(21, 'Ibanez RG550', 1, 5000000, 'https://mariogomez.com.ar/wp-content/uploads/2023/09/ibanez-rg550-rf-principal.jpg'),
(22, 'PRS Custom 24', 1, 7500000, 'https://tiendafeedback.com.ar/64393-large_default/guitarra-electrica-prs-se-custom-24-08-color-orange-paul-reed-smith.jpg'),
(23, 'Martin D-28', 2, 4500000, 'https://http2.mlstatic.com/D_Q_NP_692098-MLA74782360301_022024-O.webp'),
(24, 'Taylor 214ce', 2, 6800000, 'https://http2.mlstatic.com/D_Q_NP_678507-MLA74780228331_022024-O.webp'),
(25, 'Gibson J-45', 2, 1050000, 'https://rvb-img.reverb.com/image/upload/s--4-AUm09z--/f_auto,t_large/v1574800222/giz6pbdsy5zu2qxwrgzh.jpg'),
(26, 'Fender CD-60SCE', 3, 5600000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSYRGswIDCfwsD-aLdmSrqrZabo6uhBDlhpA&s'),
(28, 'Strandberg', 1, 15000000, 'https://www.megamusiconline.com.au/wp-content/uploads/2023/10/SBGBDNSTDNX8NAT.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nickname`, `password`) VALUES
(1, 'webadmin', '$2y$10$G7oyiZuGz8fqMfnieHSxCO7VzRjYGGa/wgOD95SLvrCpzJ5Bx2KN.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `guitarra`
--
ALTER TABLE `guitarra`
  ADD PRIMARY KEY (`id_guitarra`),
  ADD KEY `INDICE CATEGORIA` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `guitarra`
--
ALTER TABLE `guitarra`
  MODIFY `id_guitarra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `guitarra`
--
ALTER TABLE `guitarra`
  ADD CONSTRAINT `guitarra_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
