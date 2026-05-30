-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2026 a las 18:55:57
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
-- Base de datos: `viajes_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos_viajes`
--

CREATE TABLE `seguimientos_viajes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programacion_viaje_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` enum('programado','en_transito','retrasado','finalizado','cancelado') NOT NULL,
  `novedad` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seguimientos_viajes`
--

INSERT INTO `seguimientos_viajes` (`id`, `programacion_viaje_id`, `fecha`, `hora`, `estado`, `novedad`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-06-15', '06:00:00', 'en_transito', 'Vehiculo inicia recorrido hacia Medellin', '2026-05-30 16:55:40', '2026-05-30 16:55:40'),
(2, 1, '2026-06-15', '10:30:00', 'retrasado', 'Retraso por trafico en carretera', '2026-05-30 16:55:40', '2026-05-30 16:55:40');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `seguimientos_viajes`
--
ALTER TABLE `seguimientos_viajes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `seguimientos_viajes`
--
ALTER TABLE `seguimientos_viajes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
