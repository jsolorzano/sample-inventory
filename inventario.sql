-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-11-2021 a las 01:24:02
-- Versión del servidor: 5.7.36-0ubuntu0.18.04.1
-- Versión de PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--
CREATE DATABASE IF NOT EXISTS `inventario` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `inventario`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_catalogoproducto`
--

CREATE TABLE `tbl_catalogoproducto` (
  `id` int(11) NOT NULL,
  `CodigoProducto` varchar(10) NOT NULL,
  `NombreProducto` varchar(50) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `PrecioUnitario` float NOT NULL,
  `Unidades` int(11) NOT NULL,
  `Direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_catalogoproducto`
--

INSERT INTO `tbl_catalogoproducto` (`id`, `CodigoProducto`, `NombreProducto`, `Descripcion`, `PrecioUnitario`, `Unidades`, `Direccion`) VALUES
(1, '0001', 'Producto 1', 'Producto de prueba 1', 50, 100, 'Dirección de prueba 1'),
(2, '0002', 'Producto 2', 'Producto de prueba 2', 50, 100, 'Dirección de prueba 2'),
(3, '0003', 'Producto 3', 'Producto de prueba 3', 50, 100, 'Dirección de prueba 3'),
(4, '0004', 'Producto 4', 'Producto de prueba 4', 50, 100, 'Dirección de prueba 4'),
(5, '0005', 'Producto 5', 'Producto de prueba 5', 50, 100, 'Dirección de prueba 5'),
(6, '0006', 'Computador HP', 'Computador HP Compac', 200, 500, 'Dirección de prueba 6'),
(7, '0007', 'Computador DELL', 'Computador DELL Renew', 200, 500, 'Dirección de prueba 7');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_catalogoproducto`
--
ALTER TABLE `tbl_catalogoproducto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_catalogoproducto`
--
ALTER TABLE `tbl_catalogoproducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
