-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2026 a las 18:51:44
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
-- Base de datos: `rutas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programaciones_viajes`
--

CREATE TABLE `programaciones_viajes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conductor_id` bigint(20) UNSIGNED NOT NULL,
  `vehiculo_id` bigint(20) UNSIGNED NOT NULL,
  `ruta_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_salida` date NOT NULL,
  `hora_salida` time NOT NULL,
  `fecha_estimada_llegada` date NOT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` enum('programado','en_transito','retrasado','finalizado','cancelado') DEFAULT 'programado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programaciones_viajes`
--

INSERT INTO `programaciones_viajes` (`id`, `conductor_id`, `vehiculo_id`, `ruta_id`, `fecha_salida`, `hora_salida`, `fecha_estimada_llegada`, `observaciones`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2026-06-15', '06:00:00', '2026-06-15', 'Carga de alimentos', 'programado', '2026-05-30 16:51:19', '2026-05-30 16:51:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ciudad_origen` varchar(100) NOT NULL,
  `ciudad_destino` varchar(100) NOT NULL,
  `distancia` decimal(10,2) NOT NULL,
  `tiempo_estimado` varchar(50) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `ciudad_origen`, `ciudad_destino`, `distancia`, `tiempo_estimado`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 'Bogota', 'Medellin', 420.00, '8 horas', 'Ruta principal nacional', '2026-05-30 16:51:19', '2026-05-30 16:51:19'),
(2, 'Tunja', 'Bogota', 150.00, '3 horas', 'Ruta regional', '2026-05-30 16:51:19', '2026-05-30 16:51:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `programaciones_viajes`
--
ALTER TABLE `programaciones_viajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `programaciones_viajes`
--
ALTER TABLE `programaciones_viajes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
