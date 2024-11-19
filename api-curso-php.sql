-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2024 a las 07:32:51
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
-- Base de datos: `api-curso-php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `telefono`, `direccion`, `password`) VALUES
(1, 'Juan Pérez', 'juan.perez@example.com', '123456789', 'Calle Falsa 123, Ciudadela, Buenos Aires', ''),
(2, 'María Gómez', 'maria.gomez@example.com', '987654321', 'Avenida Siempre Viva 456, Ciudadela, Buenos Aires', ''),
(3, 'Carlos López', 'carlos.lopez@example.com', '456789123', 'Boulevard de los Sueños 789, Ciudadela, Buenos Aires', ''),
(4, 'Ana Martínez', 'ana.martinez@example.com', '321654987', 'Plaza de la Libertad 101, Ciudadela, Buenos Aires', ''),
(5, 'Luis Fernández', 'luis.fernandez@example.com', '654987321', 'Calle de la Paz 202, Ciudadela, Buenos Aires', ''),
(6, '', 'onnembol@gmail.com', NULL, NULL, '$2y$10$BjAw6BErGAgAa0wZIopb9ea7o9leSEFut.vyBR9RUsjK9TobtRn0y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `descripcion`) VALUES
(1, 'Laptop', 1200.00, 'Laptop de alta gama con 16GB de RAM y 512GB SSD'),
(2, 'Smartphone', 800.00, 'Smartphone con pantalla AMOLED y cámara de 48MP'),
(3, 'Auriculares', 150.00, 'Auriculares inalámbricos con cancelación de ruido'),
(4, 'Monitor', 300.00, 'Monitor 4K de 27 pulgadas con HDR'),
(5, 'Teclado', 50.00, 'Teclado mecánico con retroiluminación RGB');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
