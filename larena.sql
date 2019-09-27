-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2019 a las 21:40:05
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `larena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autenticacion`
--

CREATE TABLE IF NOT EXISTS `autenticacion` (
`id` int(11) NOT NULL,
  `correo` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contrasena` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tipoUsuario` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autenticacion`
--

INSERT INTO `autenticacion` (`id`, `correo`, `contrasena`, `tipoUsuario`, `idUsuario`, `fechaActualizacion`) VALUES
(1, 'diego@gmail.com', '987654', 'paciente', 2, '2019-09-11 09:23:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `idtipoCita`, `idPaciente`, `idDoctor`, `fecha`, `hora`, `estado`, `formaPago`, `param`, `fechaSolicitud`, `tipoCita`) VALUES
(1, 2, 2, 2, '2019-09-22', '11:00:00', 'A', 'T', '-', '2019-09-18 06:21:12', 'psicologia'),
(3, 2, 2, 2, '2019-09-22', '11:00:00', 'A', 'T', '-', '0000-00-00 00:00:00', ''),
(4, 2, 1, 2, '2019-09-22', '11:00:00', 'A', 'T', '-', '2019-09-18 06:21:12', 'psicologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citavirtual`
--

CREATE TABLE IF NOT EXISTS `citavirtual` (
`id` int(11) NOT NULL,
  `idCita` int(11) NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'Activo: A - Inactivo: I',
  `param` text NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citavirtual`
--

INSERT INTO `citavirtual` (`id`, `idCita`, `estado`, `param`, `fecha`) VALUES
(1, 2, 'A', '-', '2019-09-22 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidadagenda`
--

CREATE TABLE IF NOT EXISTS `disponibilidadagenda` (
`id` int(11) NOT NULL,
  `idDoctor` int(11) NOT NULL,
  `idtipoCita` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `horaInicial` time NOT NULL,
  `fechaFinal` date NOT NULL,
  `horaFinal` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `disponibilidadagenda`
--

INSERT INTO `disponibilidadagenda` (`id`, `idDoctor`, `idtipoCita`, `fechaInicial`, `horaInicial`, `fechaFinal`, `horaFinal`) VALUES
(2, 2, 3, '2019-09-24', '09:00:00', '2019-09-24', '10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE IF NOT EXISTS `doctores` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'Disponible: D',
  `estadoVisible` char(1) NOT NULL COMMENT 'Visible: V',
  `foto` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `telefono` int(15) NOT NULL,
  `numIdentificacion` int(15) NOT NULL,
  `param` text NOT NULL,
  `fecha` datetime NOT NULL,
  `tarjetaProfesional` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id`, `nombre`, `correo`, `estado`, `estadoVisible`, `foto`, `titulo`, `descripcion`, `telefono`, `numIdentificacion`, `param`, `fecha`, `tarjetaProfesional`) VALUES
(1, 'Reuth Afef', 'reuth@gmail.com', 'A', 'V', 'fotoreuth.jpg', 'psicologo', 'especialista', 1112233, 987654321, '-', '2019-09-27 05:17:35', '147852369');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialpacientes`
--

CREATE TABLE IF NOT EXISTS `historialpacientes` (
`id` int(11) NOT NULL,
  `idPaciente` int(11) NOT NULL,
  `idDoctor` int(11) NOT NULL,
  `idcita` int(11) NOT NULL,
  `diagnostico` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `recomendaciones` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `observaciones` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `param` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historialpacientes`
--

INSERT INTO `historialpacientes` (`id`, `idPaciente`, `idDoctor`, `idcita`, `diagnostico`, `recomendaciones`, `observaciones`, `param`) VALUES
(2, 2, 2, 2, 'Paciente con alzheimer', 'No salir solo', 'Estar pendientes', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacioncompartidahistorial`
--

CREATE TABLE IF NOT EXISTS `informacioncompartidahistorial` (
`id` int(11) NOT NULL,
  `idHistorial` int(11) NOT NULL,
  `idInformacionCompartir` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `informacioncompartidahistorial`
--

INSERT INTO `informacioncompartidahistorial` (`id`, `idHistorial`, `idInformacionCompartir`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacioncompartir`
--

CREATE TABLE IF NOT EXISTS `informacioncompartir` (
`id` int(11) NOT NULL,
  `archivo` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `param` text NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `informacioncompartir`
--

INSERT INTO `informacioncompartir` (`id`, `archivo`, `url`, `titulo`, `descripcion`, `param`, `fecha`) VALUES
(2, 'archivo', 'archivo2.pdf', 'archivo2', 'archivo1', '-', '2019-09-24 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacionpagovirtual`
--

CREATE TABLE IF NOT EXISTS `informacionpagovirtual` (
`id` int(11) NOT NULL,
  `entidadPago` varchar(20) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `informacionpagovirtual`
--

INSERT INTO `informacionpagovirtual` (`id`, `entidadPago`, `link`) VALUES
(1, 'Bancolombia', 'www.grupobancolombia.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL COMMENT 'Activo: A - Inactivo: I',
  `fecha` datetime NOT NULL,
  `telefono` int(15) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `genero` char(1) NOT NULL COMMENT 'Masculino: M- Femenino: F',
  `fechaNacimiento` date NOT NULL,
  `domicilio` text NOT NULL,
  `EPS` varchar(30) NOT NULL,
  `numIdentificacion` varchar(15) NOT NULL,
  `politicas` varchar(255) NOT NULL,
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `correo`, `estado`, `fecha`, `telefono`, `ciudad`, `genero`, `fechaNacimiento`, `domicilio`, `EPS`, `numIdentificacion`, `politicas`, `foto`) VALUES
(1, 'chepe', 'chepe@gmail.com', 'A', '2019-09-27 00:00:00', 789456, 'Manizales', 'N', '1999-09-27', 'calle 12', 'sura', '52525252', 'A', 'fotochepe.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocitas`
--

CREATE TABLE IF NOT EXISTS `tipocitas` (
`id` int(11) NOT NULL,
  `especialidad` varchar(255) NOT NULL,
  `cede` varchar(30) NOT NULL,
  `valor` float NOT NULL,
  `Param` text NOT NULL,
  `tipo` char(1) NOT NULL COMMENT 'Vitual: V - Presencial: P - Domicilio: D - Otro: O',
  `tiempoSesion` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
-- Indices de la tabla `citavirtual`
--
ALTER TABLE `citavirtual`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `disponibilidadagenda`
--
ALTER TABLE `disponibilidadagenda`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
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
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `citavirtual`
--
ALTER TABLE `citavirtual`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `disponibilidadagenda`
--
ALTER TABLE `disponibilidadagenda`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `historialpacientes`
--
ALTER TABLE `historialpacientes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `informacioncompartidahistorial`
--
ALTER TABLE `informacioncompartidahistorial`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `informacioncompartir`
--
ALTER TABLE `informacioncompartir`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `informacionpagovirtual`
--
ALTER TABLE `informacionpagovirtual`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipocitas`
--
ALTER TABLE `tipocitas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
