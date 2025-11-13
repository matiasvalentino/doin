-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2025 a las 00:57:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` enum('pendiente','enProgreso','terminado') DEFAULT 'pendiente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaFinalizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `user_id`, `titulo`, `descripcion`, `estado`, `fecha_creacion`, `fechaFinalizacion`) VALUES
(1, 1, 'Primer tarea', 'hola mundo pero version tarea', 'pendiente', '2025-11-11 01:12:21', '2025-11-18'),
(4, 1, 'Esta es una tarea de prueba pero terminada', 'esta es la descripcion de la tarea de prueba terminadaesta es la descripcion de la tarea de prueba terminadaesta es la descripcion de la tarea de prueba terminadaesta es la descripcion de la tarea de prueba terminada', 'enProgreso', '2025-11-12 00:50:24', '2025-11-14'),
(7, 1, 'hacer el logout', 'la ultima tarea es hacer el cierre de sesión', 'terminado', '2025-11-12 01:08:40', '2025-11-11'),
(9, 4, 'puta', 'asd', 'terminado', '2025-11-12 15:20:39', '2025-11-08'),
(10, 4, 'tarea en progreso', 'descripcion de la tarea', 'enProgreso', '2025-11-12 15:20:58', '2025-11-12'),
(11, 4, 'se puede poner', 'tareas en cualquiera de las tres columnas aunque toques en el boton de crear tarea de una co;lumna en especifico', 'pendiente', '2025-11-12 15:21:37', '2025-11-27'),
(12, 1, 'queasdasdsa', 'qué porque por qué. quéqqqqqqq', 'pendiente', '2025-11-12 17:42:38', '2025-11-02'),
(13, 5, 'dsasdasdas', 'asdasdsa', 'pendiente', '2025-11-12 23:15:58', '2027-03-03'),
(14, 1, 'jere putp', 'csfgerfgewdc', 'enProgreso', '2025-11-13 20:04:43', '2024-10-29'),
(15, 6, 'ewfrwef', 'ewfwefw', 'enProgreso', '2025-11-13 20:06:53', '2025-11-14'),
(16, 6, 'kkk', 'hbhbb', 'terminado', '2025-11-13 20:07:59', '2025-12-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `fecha_registro` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `mail`, `pass`, `fecha_registro`) VALUES
(1, 'Matias', 'Morales', 'matias@doin.com', '$2y$10$FU5YOxVMEKVoip0fE4o6UeXzX4A8sWO5Q5Eh/SGH3E1yna3gElvHe', '2025-09-25'),
(2, 'Paula', 'Haunau', 'pau@gmail.com', '$2y$10$zEUPkZ.gAlAOls0yNgO7zeT6AuHb3faVbZo2ZcpW2j6mhUkPoDCK2', '2025-09-26'),
(3, 'juan', 'perez', 'juan@perez.com', '$2y$10$fdR89WxdwHTsfayzzXXWxeVoEwGQghXdBAirnkwRVfYEZb28onIGi', '2025-11-11'),
(4, 'Aramis', 'Terza', 'aramis@mail.com', '$2y$10$P9gSO9WKusdLcz/G35E.1uwtp50lbpOPAHcQlOkqQaG96Rc5DET4.', '2025-11-12'),
(5, 'user', 'de mentira', 'user@mentira.com', '$2y$10$gNxsRPOJ1.iynAGGyMFrzub1fNurskWKWQiC65LNam1MvS0b2zo36', '2025-11-12'),
(6, 'jere', 'mai', 'jere@mail.com', '$2y$10$TZK0GF/9Rz2h207VJZlYz.45aGUsCS3QgZ7xlXz6I6RqZQz7WBDvi', '2025-11-13'),
(7, 'Valentin', 'Figun', 'vfigun@gmail.com', '$2y$10$ZUmpmGbBWl0B7ye0b2NEnOnzaG9r4e4i8lPr4PoeaAVR3bwV85U2.', '2025-11-13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `fk_tareas_user` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_tareas_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
