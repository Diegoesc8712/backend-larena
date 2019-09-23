-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2019 a las 21:32:59
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `larena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autenticacion`
--

CREATE TABLE `autenticacion` (
  `id` int(11) NOT NULL,
  `correo` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contrasena` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tipoUsuario` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autenticacion`
--

INSERT INTO `autenticacion` (`id`, `correo`, `contrasena`, `tipoUsuario`, `idUsuario`, `fechaActualizacion`) VALUES
(1, 'diego@gmail.com', '987654', 'paciente', 2, '2019-09-11 09:23:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `idtipoCita` int(11) NOT NULL,
  `idPaciente` int(11) NOT NULL,
  `idDoctor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` char(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Activo: A - Inactivo: I',
  `formaPago` char(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Efectivo: E - Tarjeta: T',
  `param` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fechaSolicitud` datetime NOT NULL,
  `tipoCita` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `idtipoCita`, `idPaciente`, `idDoctor`, `fecha`, `hora`, `estado`, `formaPago`, `param`, `fechaSolicitud`, `tipoCita`) VALUES
(1, 2, 2, 2, '2019-09-22', '11:00:00', 'A', 'T', '-', '2019-09-18 06:21:12', 'psicologia'),
(3, 2, 2, 2, '2019-09-22', '11:00:00', 'A', 'T', '-', '0000-00-00 00:00:00', ''),
(4, 2, 1, 2, '2019-09-22', '11:00:00', 'A', 'T', '-', '2019-09-18 06:21:12', 'psicologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidadagenda`
--

CREATE TABLE `disponibilidadagenda` (
  `id` int(11) NOT NULL,
  `idDoctor` int(11) NOT NULL,
  `idtipoCita` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `horaInicial` time NOT NULL,
  `fechaFinal` date NOT NULL,
  `horaFinal` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `disponibilidadagenda`
--

INSERT INTO `disponibilidadagenda` (`id`, `idDoctor`, `idtipoCita`, `fechaInicial`, `horaInicial`, `fechaFinal`, `horaFinal`) VALUES
(2, 2, 3, '2019-09-24', '09:00:00', '2019-09-24', '10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialpacientes`
--

CREATE TABLE `historialpacientes` (
  `id` int(11) NOT NULL,
  `idPaciente` int(11) NOT NULL,
  `idDoctor` int(11) NOT NULL,
  `idcita` int(11) NOT NULL,
  `diagnostico` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `recomendaciones` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `observaciones` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `param` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historialpacientes`
--

INSERT INTO `historialpacientes` (`id`, `idPaciente`, `idDoctor`, `idcita`, `diagnostico`, `recomendaciones`, `observaciones`, `param`) VALUES
(2, 2, 2, 2, 'Paciente con alzheimer', 'No salir solo', 'Estar pendientes', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacioncompartidahistorial`
--

CREATE TABLE `informacioncompartidahistorial` (
  `id` int(11) NOT NULL,
  `idHistorial` int(11) NOT NULL,
  `idInformacionCompartir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacioncompartir`
--

CREATE TABLE `informacioncompartir` (
  `id` int(11) NOT NULL,
  `archivo` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `param` text NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `informacioncompartir`
--

INSERT INTO `informacioncompartir` (`id`, `archivo`, `url`, `titulo`, `descripcion`, `param`, `fecha`) VALUES
(2, 'archivo', 'archivo2.pdf', 'archivo2', 'archivo1', '-', '2019-09-24 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacionpagovirtual`
--

CREATE TABLE `informacionpagovirtual` (
  `id` int(11) NOT NULL,
  `entidadPago` varchar(20) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `informacionpagovirtual`
--

INSERT INTO `informacionpagovirtual` (`id`, `entidadPago`, `link`) VALUES
(1, 'Bancolombia', 'www.grupobancolombia.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocitas`
--

CREATE TABLE `tipocitas` (
  `id` int(11) NOT NULL,
  `especialidad` varchar(255) NOT NULL,
  `cede` varchar(30) NOT NULL,
  `valor` float NOT NULL,
  `Param` text NOT NULL,
  `tipo` char(1) NOT NULL COMMENT 'Vitual: V - Presencial: P - Domicilio: D - Otro: O',
  `tiempoSesion` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipocitas`
--

INSERT INTO `tipocitas` (`id`, `especialidad`, `cede`, `valor`, `Param`, `tipo`, `tiempoSesion`) VALUES
(2, 'psicologia', 'bogota', 180000, '-', 'D', '01:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autenticacion`
--
ALTER TABLE `autenticacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `disponibilidadagenda`
--
ALTER TABLE `disponibilidadagenda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historialpacientes`
--
ALTER TABLE `historialpacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informacioncompartidahistorial`
--
ALTER TABLE `informacioncompartidahistorial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informacioncompartir`
--
ALTER TABLE `informacioncompartir`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informacionpagovirtual`
--
ALTER TABLE `informacionpagovirtual`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipocitas`
--
ALTER TABLE `tipocitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autenticacion`
--
ALTER TABLE `autenticacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `disponibilidadagenda`
--
ALTER TABLE `disponibilidadagenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historialpacientes`
--
ALTER TABLE `historialpacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `informacioncompartidahistorial`
--
ALTER TABLE `informacioncompartidahistorial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informacioncompartir`
--
ALTER TABLE `informacioncompartir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `informacionpagovirtual`
--
ALTER TABLE `informacionpagovirtual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipocitas`
--
ALTER TABLE `tipocitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
