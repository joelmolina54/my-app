-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2024 a las 22:08:41
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
-- Base de datos: `actividades`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_inicio` varchar(100) NOT NULL,
  `fecha_final` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`codigo`, `nombre`, `fecha_inicio`, `fecha_final`, `descripcion`) VALUES
('12345', 'juegos Carrera', '2024-08-10', '12/12/2024', 'juegos de tic'),
('1356', 'reinado', '2024-08-10', '12/12/2024', 'xd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_activities`
--

CREATE TABLE `user_activities` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `activity_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `user_activities`
--

INSERT INTO `user_activities` (`id`, `usuario`, `activity_code`) VALUES
(2, 'carlos123', '12345'),
(1, 'carlos123', '1356'),
(3, 'johana90', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `rol` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `contrasena`, `rol`, `foto`) VALUES
('admin2003', 'admin123', 'admin', ''),
('carlos123', '2024', NULL, 'carlos123.jpg'),
('johana90', 'johana123', NULL, 'johana90.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`,`activity_code`),
  ADD KEY `activity_code` (`activity_code`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_activities_ibfk_2` FOREIGN KEY (`activity_code`) REFERENCES `actividad` (`codigo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
