-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2020 a las 14:30:44
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adminsistemas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

CREATE TABLE `historico` (
  `id_ticket` int(100) NOT NULL,
  `id_tecnico` int(100) NOT NULL,
  `texto` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historico`
--

INSERT INTO `historico` (`id_ticket`, `id_tecnico`, `texto`, `fecha`) VALUES
(28, 2, 'El cable ha sido comprado', '2020-12-03 17:03:47'),
(28, 2, 'Correos ha entregado el cable', '2020-12-03 17:04:01'),
(29, 2, 'La pantalla ha sido comprada', '2020-12-03 17:11:11'),
(40, 2, 'La alarma ha sido desmontada', '2020-12-03 17:11:40'),
(40, 2, 'La alarma ha sido arreglada', '2020-12-03 17:11:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(9) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` text NOT NULL,
  `creador` int(5) NOT NULL,
  `tecnico` int(5) DEFAULT NULL,
  `prioridad` varchar(9) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `escalabilidad` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `fecha`, `descripcion`, `creador`, `tecnico`, `prioridad`, `estado`, `escalabilidad`) VALUES
(28, '2020-01-15 16:04:03', 'Fallo en la impresora de la oficina nº 2', 13, 2, 'media', 'en proceso', 'basica'),
(29, '2020-01-23 16:05:54', 'Fallo en la pantalla del ordenador en el escritorio de la oficina nº 4', 13, 2, 'alta', 'en proceso', 'basica'),
(30, '2020-02-20 16:06:43', 'Fallo en la contabilidad de los presupuestos para el proyecto', 13, 3, 'grave', 'asignado', 'tecnico'),
(31, '2020-03-19 16:06:57', 'Fallo en la reserva de los hoteles', 13, NULL, 'crítica', 'en proceso', 'externa'),
(32, '2020-03-19 16:06:57', 'Fallo en las luces de la sala de pruebas', 13, 11, 'alta', 'finalizado', 'tecnico'),
(33, '2020-03-19 16:06:57', 'Fallo en el ascensor', 14, 3, 'grave', 'en proceso', 'tecnico'),
(34, '2020-03-19 16:06:57', 'Rotura de la puerta de la oficina nº 8', 14, 11, 'baja', 'asignado', 'tecnico'),
(35, '2020-04-16 16:08:14', 'Puerta de seguridad no cierra', 14, NULL, 'baja', 'asignado', 'externa'),
(36, '2020-04-29 16:08:27', 'Arco de seguridad no deja de pitar', 14, NULL, 'media', 'asignado', 'externa'),
(37, '2020-05-22 16:08:49', 'Rotura del escáner de rayos X', 14, 10, 'alta', 'finalizado', 'tecnico'),
(38, '2020-06-16 16:09:16', 'Solicitud de cambio de oficina', 15, 12, 'baja', 'asignado', 'basica'),
(39, '2020-07-23 16:09:33', 'Vertido de fluidos contaminantes en el mar', 15, 11, 'crítica', 'finalizado', 'tecnico'),
(40, '2020-07-29 16:09:49', 'Alarma iniciada sin problema aparente', 15, 2, 'crítica', 'finalizado', 'tecnico'),
(41, '2020-08-21 16:10:05', 'Fallo en la luz del baño del segundo piso', 15, 11, 'alta', 'en proceso', 'basica'),
(42, '2020-08-22 16:10:18', 'Solicitud de cambio de monitor por uno 4K', 15, 3, 'media', 'en proceso', 'basica'),
(43, '2020-08-23 16:10:46', 'Solicitud de reserva de sala de conferencias', 16, 12, 'grave', 'asignado', 'tecnico'),
(44, '2020-09-18 16:10:58', 'Petición de cambio de silla en el despacho nº 5', 16, NULL, 'crítica', 'en proceso', 'externa'),
(45, '2020-11-18 16:11:19', 'Imposibilidad a la hora de efectuar pago por PayPal', 16, NULL, 'alta', 'finalizado', 'externa'),
(46, '2020-11-17 16:11:44', 'Fallo en el disco duro del CPD en el rack nº 45', 16, 10, 'baja', 'en proceso', 'basica'),
(47, '2020-11-21 16:12:06', 'Fallo del SAI en el CPD de Barcelona', 16, NULL, 'media', 'finalizado', 'externa'),
(48, '2020-11-22 16:13:30', 'Equipaje extraviado en la aerolínea alemana', 17, NULL, 'baja', 'inicio', 'basica'),
(49, '2020-11-26 16:14:02', 'Fallo en el Kernel del sistema en el CPD de Lugo', 17, NULL, 'baja', 'inicio', 'basica'),
(50, '2020-11-29 16:14:28', 'Fallo en el sistema neuronal de la cámara de reconocimiento facial', 17, NULL, 'baja', 'inicio', 'basica'),
(51, '2020-12-03 16:14:47', 'Solicitud de la sala de actos para exposición', 17, NULL, 'baja', 'inicio', 'basica'),
(52, '2020-12-03 16:15:04', 'No se puede acceder a las plantillas de los trabajadores', 17, NULL, 'baja', 'inicio', 'basica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nivel` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `user`, `password`, `nivel`) VALUES
(1, 'José Velázquez Mirador', 'admin', '$2y$12$8qKYJo5VJ0bAbrDzBTPAMeJ1HDonG5TFfskf3.AvWs0B/e7/kbpZW', 2),
(2, 'Pere Garriga Muntanya', 'tecnico1', '$2y$10$dIYotNJ/to/STjp9/IoXr.KM0gszdr0cTrV6WYF5Q8CZD73l4MPJG', 1),
(3, 'Josepe Geranio Velmonte', 'tecnico2', '$2y$10$dIYotNJ/to/STjp9/IoXr.KM0gszdr0cTrV6WYF5Q8CZD73l4MPJG', 1),
(10, 'Jose Roberto Carlos Pérez', 'tecnico3', '$2y$10$dIYotNJ/to/STjp9/IoXr.KM0gszdr0cTrV6WYF5Q8CZD73l4MPJG', 1),
(11, 'Adrián José Roberto', 'tecnico4', '$2y$10$dIYotNJ/to/STjp9/IoXr.KM0gszdr0cTrV6WYF5Q8CZD73l4MPJG', 1),
(12, 'Pere De La Pradera', 'tecnico5', '$2y$10$dIYotNJ/to/STjp9/IoXr.KM0gszdr0cTrV6WYF5Q8CZD73l4MPJG', 1),
(13, 'Helena Fiol Moyá', 'cliente1', '$2y$10$dIYotNJ/to/STjp9/IoXr.KM0gszdr0cTrV6WYF5Q8CZD73l4MPJG', 0),
(14, 'Lisandro Rocha Tau', 'cliente2', '$2y$10$dIYotNJ/to/STjp9/IoXr.KM0gszdr0cTrV6WYF5Q8CZD73l4MPJG', 0),
(15, 'Ramon Cabanillas', 'cliente3', '$2y$10$JlmMTueiAuug8rKZx3M4ZONsl5ziGZdoPnmKp3LUI6l5Pc5373anW', 0),
(16, 'Juana Mohamed', 'cliente4', '$2y$10$JlmMTueiAuug8rKZx3M4ZONsl5ziGZdoPnmKp3LUI6l5Pc5373anW', 0),
(17, 'María Auxiliadora Gil', 'cliente5', '$2y$10$JlmMTueiAuug8rKZx3M4ZONsl5ziGZdoPnmKp3LUI6l5Pc5373anW', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
