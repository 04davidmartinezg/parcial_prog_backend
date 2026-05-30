-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2026 a las 18:53:46
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
-- Base de datos: `vehiculos_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `placa` varchar(20) NOT NULL,
  `tipo_vehiculo` varchar(100) NOT NULL,
  `capacidad_carga` decimal(10,2) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `estado` enum('disponible','en_ruta','mantenimiento','inactivo') DEFAULT 'disponible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `placa`, `tipo_vehiculo`, `capacidad_carga`, `modelo`, `marca`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'ABC123', 'Camion', 5000.00, '2022', 'Chevrolet', 'disponible', '2026-05-30 16:53:36', '2026-05-30 16:53:36'),
(2, 'XYZ789', 'Furgon', 2500.00, '2021', 'Renault', 'disponible', '2026-05-30 16:53:36', '2026-05-30 16:53:36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
