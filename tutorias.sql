-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2023 a las 18:37:59
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tutorias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `ci_adm` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `biografia` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`ci_adm`, `nombre`, `apellido`, `direccion`, `telefono`, `biografia`, `email`, `contrasena`) VALUES
(23550000, 'Cuenta Admin', 'Prueba Test', 'Hogar Admin', 123456789, '', 'admin@gmail.com', '$2y$10$p6T9idGOfIwhg64/DDL99OdEBT/Zx7IiI6TouVuDP9Sgq36LUlWRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`area`) VALUES
(28),
(60),
(262),
(320),
(364),
(388),
(801),
(802),
(915);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id_clase` int(11) NOT NULL,
  `id_tut` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `salon` int(11) NOT NULL,
  `realizado` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id_clase`, `id_tut`, `fecha`, `hora_inicio`, `hora_final`, `salon`, `realizado`) VALUES
(1, 2, '2023-08-01', '18:30:00', '02:07:02', 5, ''),
(2, 3, '2023-08-01', '18:30:00', '02:07:02', 16, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `ci_doc` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `biografia` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`ci_doc`, `nombre`, `apellido`, `direccion`, `telefono`, `biografia`, `email`, `contrasena`) VALUES
(22446688, 'Segundo Docente', 'Prueba Test', 'Hogar Docente', '123456789', '', '2o_docente@gmail.com', '$2y$10$879XH1/FKIC89RD5ca22XusOV/9eNqBDeCVpBsaS/n5UFkMJd5Dr2'),
(87654321, 'Cuenta Docente', 'Prueba Test', 'Hogar Docente', '123456789', '', 'docente@gmail.com', '$2y$10$KP.Xvv/gyhpT6hiVRFFy.uBRcThSh25wy9W1Ae8zGV0RB5VgQPgGi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doc_areas`
--

CREATE TABLE `doc_areas` (
  `id_doc_areas` int(11) NOT NULL,
  `ci_doc` int(11) NOT NULL,
  `area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doc_areas`
--

INSERT INTO `doc_areas` (`id_doc_areas`, `ci_doc`, `area`) VALUES
(1, 87654321, 915),
(2, 22446688, 262),
(3, 22446688, 915);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `ci_est` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `biografia` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`ci_est`, `nombre`, `apellido`, `direccion`, `biografia`, `email`, `contrasena`) VALUES
(55746914, 'Elias Gabriel', 'Pereyra Olivera', 'Mi casa', '', 'eliasp.reyra06@gmail.com', '$2y$10$itXH6v6eSLpWPISWdrsghuoxs/TgqytoWn.MM.HpkO0uJsuS7jcKu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_mat` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_mat`, `nombre`, `area`) VALUES
(0, 'Historia', 364),
(1, 'Educacion Fisica', 262),
(2, 'Ingles', 388),
(3, 'Matematica', 801),
(4, 'Geometria', 802),
(5, 'Cien. Soc. Historia', 364),
(6, 'Biologia', 28),
(7, 'Geografia', 60),
(8, 'Fisica', 320);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rendimientos`
--

CREATE TABLE `rendimientos` (
  `id_rend` int(11) NOT NULL,
  `ci_est` int(11) NOT NULL,
  `id_tut` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `inasistencias` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `juicio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE `telefonos` (
  `telefono` int(11) NOT NULL,
  `ci_est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `telefonos`
--

INSERT INTO `telefonos` (`telefono`, `ci_est`) VALUES
(99832334, 55746914);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutorias`
--

CREATE TABLE `tutorias` (
  `id_tut` int(11) NOT NULL,
  `materia` int(11) NOT NULL,
  `docente` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tutorias`
--

INSERT INTO `tutorias` (`id_tut`, `materia`, `docente`, `fecha_creacion`, `tipo`, `area`) VALUES
(2, 6, 87654321, '2023-08-11 16:22:12', 'coord', 28),
(3, 8, 87654321, '2023-08-13 18:11:50', 'exam', 320),
(6, 7, 22446688, '2023-08-31 15:15:53', 'coord', 60);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`ci_adm`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`area`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id_clase`),
  ADD KEY `id_tut` (`id_tut`),
  ADD KEY `fecha` (`fecha`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`ci_doc`);

--
-- Indices de la tabla `doc_areas`
--
ALTER TABLE `doc_areas`
  ADD PRIMARY KEY (`id_doc_areas`),
  ADD KEY `ci_doc` (`ci_doc`),
  ADD KEY `area` (`area`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`ci_est`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_mat`),
  ADD KEY `area` (`area`);

--
-- Indices de la tabla `rendimientos`
--
ALTER TABLE `rendimientos`
  ADD PRIMARY KEY (`id_rend`),
  ADD UNIQUE KEY `ci_est` (`ci_est`),
  ADD UNIQUE KEY `id_tut` (`id_tut`),
  ADD KEY `fecha` (`fecha`);

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`telefono`),
  ADD UNIQUE KEY `ci_estudiante` (`ci_est`);

--
-- Indices de la tabla `tutorias`
--
ALTER TABLE `tutorias`
  ADD PRIMARY KEY (`id_tut`),
  ADD KEY `ci_doc` (`docente`),
  ADD KEY `id_mat` (`materia`),
  ADD KEY `area` (`area`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `doc_areas`
--
ALTER TABLE `doc_areas`
  MODIFY `id_doc_areas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id_mat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `rendimientos`
--
ALTER TABLE `rendimientos`
  MODIFY `id_tut` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tutorias`
--
ALTER TABLE `tutorias`
  MODIFY `id_tut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`id_tut`) REFERENCES `tutorias` (`id_tut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `doc_areas`
--
ALTER TABLE `doc_areas`
  ADD CONSTRAINT `doc_areas_ibfk_1` FOREIGN KEY (`ci_doc`) REFERENCES `docentes` (`ci_doc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doc_areas_ibfk_2` FOREIGN KEY (`area`) REFERENCES `areas` (`area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`area`) REFERENCES `areas` (`area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rendimientos`
--
ALTER TABLE `rendimientos`
  ADD CONSTRAINT `rendimientos_ibfk_1` FOREIGN KEY (`ci_est`) REFERENCES `estudiantes` (`ci_est`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rendimientos_ibfk_2` FOREIGN KEY (`id_tut`) REFERENCES `tutorias` (`id_tut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rendimientos_ibfk_3` FOREIGN KEY (`fecha`) REFERENCES `clases` (`fecha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD CONSTRAINT `telefonos_ibfk_1` FOREIGN KEY (`ci_est`) REFERENCES `estudiantes` (`ci_est`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tutorias`
--
ALTER TABLE `tutorias`
  ADD CONSTRAINT `tutorias_ibfk_2` FOREIGN KEY (`area`) REFERENCES `materias` (`area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutorias_ibfk_3` FOREIGN KEY (`docente`) REFERENCES `docentes` (`ci_doc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutorias_ibfk_4` FOREIGN KEY (`materia`) REFERENCES `materias` (`id_mat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
