-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2025 a las 00:26:22
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
-- Base de datos: `pokeadso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gyms`
--

CREATE TABLE `gyms` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gyms`
--

INSERT INTO `gyms` (`id`, `name`, `create_at`) VALUES
(1, 'Saffron', '2025-11-12 01:45:46'),
(2, 'Fucshia', '2025-11-12 01:45:46'),
(3, 'Tomato', '2025-11-12 01:45:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  `strenght` int(11) NOT NULL,
  `stamina` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemons`
--

INSERT INTO `pokemons` (`id`, `name`, `type`, `strenght`, `stamina`, `speed`, `accuracy`, `trainer_id`, `created_at`) VALUES
(1, 'pikachu', 'Electric', 90, 80, 96, 79, 1, '2025-11-12 01:59:31'),
(2, 'charmander', 'Fire', 95, 78, 80, 82, 1, '2025-11-12 01:59:31'),
(3, 'bulbasaour', 'Grass', 80, 88, 70, 75, 1, '2025-11-12 01:59:31'),
(4, 'squirtle', 'Water', 70, 90, 75, 90, 1, '2025-11-12 01:59:31'),
(5, 'Snorlax', 'Normal', 180, 320, 50, 180, 1, '2025-11-12 01:59:31'),
(6, 'Vaporeon', 'Water', 186, 260, 90, 168, 1, '2025-11-12 01:59:31'),
(7, 'Lapras', 'Water', 111, 255, 100, 168, 1, '2025-11-12 01:59:31'),
(8, 'Blastoise', 'Water', 720, 158, 70, 222, 1, '2025-11-12 01:59:31'),
(9, 'Golem', 'Water', 500, 160, 80, 198, 1, '2025-11-12 01:59:31'),
(10, 'Dragonite', 'Dragon', 900, 250, 120, 182, 1, '2025-11-12 01:59:31'),
(11, 'Exeggutor', 'Grass', 596, 190, 90, 232, 1, '2025-11-12 01:59:31'),
(12, 'Omaster', 'Rock', 1500, 140, 112, 202, 1, '2025-11-12 01:59:31'),
(13, 'Muk', 'Poison', 1070, 210, 112, 180, 1, '2025-11-12 01:59:31'),
(14, 'Onix', 'Rock', 662, 70, 80, 90, 1, '2025-11-12 01:59:31'),
(15, 'Poliwag', 'Water', 815, 80, 70, 108, 1, '2025-11-12 01:59:31'),
(16, 'Mankey', 'Water', 563, 80, 70, 122, 2, '2025-11-12 01:59:31'),
(17, 'Magnemite', 'Electric', 750, 50, 40, 128, 2, '2025-11-12 01:59:31'),
(18, 'Pidgey', 'Normal', 818, 80, 95, 90, 2, '2025-11-12 01:59:31'),
(19, 'Gastly', 'Ghost', 750, 60, 60, 82, 2, '2025-11-12 01:59:31'),
(20, 'Rattata', 'Normal', 810, 60, 65, 22, 2, '2025-11-12 01:59:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `level` int(11) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `level`, `gym_id`, `created_at`) VALUES
(1, 'Ash Ketchum', 2, 1, '2025-11-12 01:58:12'),
(2, 'Misty', 4, 2, '2025-11-12 01:58:12'),
(3, 'Brok', 6, 2, '2025-11-12 01:58:12'),
(4, 'Serena', 4, 2, '2025-11-12 01:58:39'),
(5, 'Oak', 9, 1, '2025-11-12 01:58:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gyms`
--
ALTER TABLE `gyms`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indices de la tabla `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `gym_id` (`gym_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gyms`
--
ALTER TABLE `gyms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pokemons`
--
ALTER TABLE `pokemons`
  ADD CONSTRAINT `pokemons_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`);

--
-- Filtros para la tabla `trainers`
--
ALTER TABLE `trainers`
  ADD CONSTRAINT `trainers_ibfk_1` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
