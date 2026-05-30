-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2026 a las 18:23:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conductores_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE `conductores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `documento` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `numero_licencia` varchar(50) NOT NULL,
  `categoria_licencia` varchar(20) NOT NULL,
  `fecha_vencimiento_licencia` date NOT NULL,
  `estado` enum('disponible','en_ruta','inactivo') DEFAULT 'disponible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`id`, `nombres`, `apellidos`, `documento`, `telefono`, `correo`, `numero_licencia`, `categoria_licencia`, `fecha_vencimiento_licencia`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Carlos', 'Ramirez', '1000123456', '3001234567', 'carlos@logitrans.com', 'LIC-1001', 'C2', '2027-05-10', 'disponible', '2026-05-30 16:23:09', '2026-05-30 16:23:09'),
(2, 'Andres', 'Martinez', '1000789456', '3014567890', 'andres@logitrans.com', 'LIC-1002', 'C3', '2026-12-15', 'disponible', '2026-05-30 16:23:09', '2026-05-30 16:23:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conductores`
--
ALTER TABLE `conductores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `numero_licencia` (`numero_licencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conductores`
--
ALTER TABLE `conductores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
