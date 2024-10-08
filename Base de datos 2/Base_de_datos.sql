-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2024 a las 16:33:40
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
-- Base de datos: `aplicacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$MW3Sw2ivwbCC6s9OUHb0weRhYyo9oJcdT2p5poEdBYsfCWG99O1FC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(11) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `genero` enum('MASCULINO','FEMENINO') NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `parroquia` varchar(100) NOT NULL,
  `recinto` varchar(100) NOT NULL,
  `telefono` varchar(7) NOT NULL,
  `celular_1` varchar(15) NOT NULL,
  `celular_2` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `tiene_redes` enum('SI','NO') NOT NULL,
  `tiktok` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `nivel_instruccion` enum('PRIMARIA','SECUNDARIA','CURSANDO UNIVERSIDAD','TERCER NIVEL') NOT NULL,
  `unidad_educativa` varchar(100) NOT NULL,
  `tiene_hijos` enum('SI','NO') NOT NULL,
  `cuantos_hijos` varchar(50) NOT NULL,
  `trabaja` enum('SI','NO') NOT NULL,
  `en_que_trabaja` varchar(255) NOT NULL,
  `recibido_cursos` enum('SI','NO') NOT NULL,
  `cursos_recibidos` varchar(255) NOT NULL,
  `iniciar_emprendimiento` enum('SI','NO') NOT NULL,
  `posee_emprendimiento` enum('SI','NO') NOT NULL,
  `tipo_emprendimiento` varchar(255) NOT NULL,
  `nombre_emprendimiento` varchar(255) NOT NULL,
  `participar_ferias` enum('SI','NO') NOT NULL,
  `calificacion` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `cedula`, `nombre`, `apellido`, `fecha_nacimiento`, `edad`, `estado_civil`, `genero`, `direccion`, `parroquia`, `recinto`, `telefono`, `celular_1`, `celular_2`, `correo`, `tiene_redes`, `tiktok`, `facebook`, `instagram`, `nivel_instruccion`, `unidad_educativa`, `tiene_hijos`, `cuantos_hijos`, `trabaja`, `en_que_trabaja`, `recibido_cursos`, `cursos_recibidos`, `iniciar_emprendimiento`, `posee_emprendimiento`, `tipo_emprendimiento`, `nombre_emprendimiento`, `participar_ferias`, `calificacion`) VALUES
(63, '0147895465', 'test ', 'test ', '2010-12-27', 14, 'casado', 'FEMENINO', 'Cdla. Las orquideas', '', '', '0960021', '0988006452', '0653153163', 'cesarcerezo@gmail.com', 'NO', '', '', '', 'PRIMARIA', 'ecotec', 'NO', '', 'NO', '', 'NO', '', 'NO', 'NO', '', '', 'NO', NULL),
(68, '0944214170', 'AXEL', 'FRANCO MAGALLANES', '2000-10-04', 24, 'soltero', 'MASCULINO', 'SAMBORONDON', '', '', '0944214', '0988006452', '', 'axelfram04@gmail.com', 'NO', '', '', '', 'PRIMARIA', 'ecotec', 'NO', '', 'NO', '', 'NO', '', 'NO', 'NO', '', '', 'NO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_cursos`
--

CREATE TABLE `alumnos_cursos` (
  `id` int(11) NOT NULL,
  `idalumno` int(255) NOT NULL,
  `idcurso` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_cursos`
--

INSERT INTO `alumnos_cursos` (`id`, `idalumno`, `idcurso`) VALUES
(67, 68, 74),
(68, 68, 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(255) NOT NULL,
  `codigo_curso` varchar(255) NOT NULL,
  `nombre_curso` varchar(255) NOT NULL,
  `ciclo_curso` varchar(255) NOT NULL,
  `jornada_curso` varchar(255) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `profesor_curso` varchar(255) NOT NULL,
  `sede_curso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `codigo_curso`, `nombre_curso`, `ciclo_curso`, `jornada_curso`, `hora_inicio`, `hora_fin`, `profesor_curso`, `sede_curso`) VALUES
(74, 'EC01', 'HERRAMIENTAS DIGITALES', 'agosto', 'vespertina ', '14:00:00', '15:00:00', 'Ing.chavez', 'samborondon'),
(76, 'EC04', 'Belleza', 'agosto', 'vespertina ', '14:04:00', '14:04:00', 'Ing. Karl', 'tarifa'),
(77, 'EC02', 'Corte y confeciones ', 'agosto', 'matutina', '10:15:00', '23:15:00', 'Ing. jorge', 'tarifa'),
(78, 'EC05', 'Maquillaje ', 'Agosto', 'matutina', '07:16:00', '20:16:00', 'Ing.chavez', 'samborondon'),
(80, 'SA02', 'ENFEREMERIA', 'JULIO', 'VESPERTINA', '15:00:00', '16:00:00', 'ALBERTO GUTIERREZ', 'TARIFA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumnos_cursos`
--
ALTER TABLE `alumnos_cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idalumno` (`idalumno`),
  ADD KEY `idcurso` (`idcurso`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `alumnos_cursos`
--
ALTER TABLE `alumnos_cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos_cursos`
--
ALTER TABLE `alumnos_cursos`
  ADD CONSTRAINT `alumnos_cursos_ibfk_1` FOREIGN KEY (`idalumno`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnos_cursos_ibfk_2` FOREIGN KEY (`idcurso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
