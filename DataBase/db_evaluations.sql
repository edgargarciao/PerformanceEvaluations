-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2018 at 09:58 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_evaluations`
--

-- --------------------------------------------------------

--
-- Table structure for table `asignatura`
--

CREATE TABLE `asignatura` (
  `codigo` varchar(7) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asignatura`
--

INSERT INTO `asignatura` (`codigo`, `nombre`, `id_programa`, `estado`) VALUES
('1002', 'Asor', 1, 'Activo'),
('1212', 'Ingenieria del software', 1, 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `criterio`
--

CREATE TABLE `criterio` (
  `id` int(11) NOT NULL,
  `nombreCriterio` varchar(1000) NOT NULL,
  `tipoEvaluacion` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criterio`
--

INSERT INTO `criterio` (`id`, `nombreCriterio`, `tipoEvaluacion`, `estado`) VALUES
(1, 'Compromiso institucional 2', 2, 'Activo'),
(2, 'test3', 3, 'Activo'),
(4, 'Test Auto Dir', 4, 'Activo'),
(5, 'New aut dir', 4, 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `criteriopregunta`
--

CREATE TABLE `criteriopregunta` (
  `id` int(11) NOT NULL,
  `nombrePregunta` varchar(10000) NOT NULL,
  `criterio` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteriopregunta`
--

INSERT INTO `criteriopregunta` (`id`, `nombrePregunta`, `criterio`, `estado`) VALUES
(1, 'Participa en los diversos comites y equipos de trabajo que desarrollan acciones de mejora de los procesos pedagogicos.', 4, 'Activo'),
(3, 'qwqwqwqwq2', 4, 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`) VALUES
(1, 'Ingeniería de Sistemas');

-- --------------------------------------------------------

--
-- Table structure for table `docente`
--

CREATE TABLE `docente` (
  `codigo` varchar(5) NOT NULL,
  `id_persona` varchar(11) NOT NULL,
  `id_tipo_docente` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docente`
--

INSERT INTO `docente` (`codigo`, `id_persona`, `id_tipo_docente`, `id_departamento`) VALUES
('01080', '1093783417', 1, 1),
('01995', '1093783416', 2, 1),
('10000', '1234', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `estudiante`
--

CREATE TABLE `estudiante` (
  `codigo` varchar(7) NOT NULL,
  `id_persona` varchar(11) NOT NULL,
  `id_programa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estudiante`
--

INSERT INTO `estudiante` (`codigo`, `id_persona`, `id_programa`) VALUES
('1151177', '1093783415', 1);

-- --------------------------------------------------------

--
-- Table structure for table `estudianteasignatura`
--

CREATE TABLE `estudianteasignatura` (
  `id_estudiante` varchar(7) NOT NULL,
  `id_grupo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evaluacion`
--

CREATE TABLE `evaluacion` (
  `id` int(11) NOT NULL,
  `resultado` decimal(2,0) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_tipo_evaluacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evaluaciondocente`
--

CREATE TABLE `evaluaciondocente` (
  `codigo_docente` varchar(5) NOT NULL,
  `id_evaluacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evaluacionestudiante`
--

CREATE TABLE `evaluacionestudiante` (
  `id` int(11) NOT NULL,
  `codigo_estudiante` varchar(7) NOT NULL,
  `id_grupo` char(1) NOT NULL,
  `id_evaluacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `id` char(1) NOT NULL,
  `codigo_asignatura` varchar(7) NOT NULL,
  `id_docente` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `dni` varchar(10) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`dni`, `nombres`, `apellidos`, `celular`, `direccion`, `correo`) VALUES
('1090480361', 'Derly Zuley', 'null', 'null', 'null', 'derlyzuley@gmail.com'),
('1093783415', 'Lizeth', 'Rios Epalza', '3006741974', 'Mz 3 Lote 97 BR. Valles de Giron', 'lizethre@ufps.edu.co'),
('1093783416', 'Judith del Pilar', 'Rodriguez Tenjo', '3006741978', 'Av 0 Cll 0 # 0-0 BR.', 'judithdelpilarrt@ufps.edu.co'),
('1093783417', 'Oscar Alberto', 'Gallardo Perez', '3186230805', 'Mz 5 Lote 98 BR. Valles de Giron', 'oscargallardo@ufps.edu.co'),
('1234', 'Juan medrano2', 'null', 'null', 'null', 'juan.medrano@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_evaluacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `programa`
--

CREATE TABLE `programa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programa`
--

INSERT INTO `programa` (`id`, `nombre`, `id_departamento`) VALUES
(1, 'Ingeniería de Sistemas', 0);

-- --------------------------------------------------------

--
-- Table structure for table `respuestadocente`
--

CREATE TABLE `respuestadocente` (
  `id` int(11) NOT NULL,
  `codigo_docente` varchar(5) NOT NULL,
  `id_evaluacion` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `respuestaestudiante`
--

CREATE TABLE `respuestaestudiante` (
  `id_Evaluacion_Estudiante` int(11) NOT NULL,
  `respuesta` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipodocente`
--

CREATE TABLE `tipodocente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipodocente`
--

INSERT INTO `tipodocente` (`id`, `nombre`) VALUES
(1, 'Director'),
(2, 'Docente');

-- --------------------------------------------------------

--
-- Table structure for table `tipoevaluacion`
--

CREATE TABLE `tipoevaluacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipoevaluacion`
--

INSERT INTO `tipoevaluacion` (`id`, `nombre`) VALUES
(1, 'director-profesor'),
(2, 'profesor-profesor'),
(3, 'Autoevaluacion profesor'),
(4, 'Autoevaluacion director');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(7) NOT NULL,
  `clave` varchar(32) NOT NULL,
  `tipousuario` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`usuario`, `clave`, `tipousuario`, `estado`) VALUES
('01080', 'oscar', 1, 'Activo'),
('01995', 'pilar', 2, 'Activo'),
('10000', '1234', 2, 'Activo'),
('1090', '123', 2, 'Activo'),
('11111', '11111', 2, 'Activo'),
('1151007', '1090480361', 2, 'Activo'),
('1151177', 'lizeth', 3, 'Activo'),
('200', '111', 2, 'Activo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `id_programa` (`id_programa`);

--
-- Indexes for table `criterio`
--
ALTER TABLE `criterio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombreCriterio_2` (`nombreCriterio`),
  ADD KEY `tipoEvaluacion` (`tipoEvaluacion`);

--
-- Indexes for table `criteriopregunta`
--
ALTER TABLE `criteriopregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criterio` (`criterio`);

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_tipo_docente` (`id_tipo_docente`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indexes for table `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_carrera` (`id_programa`),
  ADD KEY `id_programa` (`id_programa`);

--
-- Indexes for table `estudianteasignatura`
--
ALTER TABLE `estudianteasignatura`
  ADD PRIMARY KEY (`id_estudiante`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indexes for table `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_evaluacion` (`id_tipo_evaluacion`);

--
-- Indexes for table `evaluaciondocente`
--
ALTER TABLE `evaluaciondocente`
  ADD PRIMARY KEY (`codigo_docente`,`id_evaluacion`),
  ADD KEY `id_evaluacion` (`id_evaluacion`);

--
-- Indexes for table `evaluacionestudiante`
--
ALTER TABLE `evaluacionestudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_estudiante` (`codigo_estudiante`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_evaluacion` (`id_evaluacion`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_asignatura` (`codigo_asignatura`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`dni`);

--
-- Indexes for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evaluacion` (`id_evaluacion`);

--
-- Indexes for table `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `respuestadocente`
--
ALTER TABLE `respuestadocente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_docente` (`codigo_docente`),
  ADD KEY `id_evaluacion` (`id_evaluacion`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indexes for table `respuestaestudiante`
--
ALTER TABLE `respuestaestudiante`
  ADD PRIMARY KEY (`id_Evaluacion_Estudiante`,`id_pregunta`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indexes for table `tipodocente`
--
ALTER TABLE `tipodocente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipoevaluacion`
--
ALTER TABLE `tipoevaluacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criterio`
--
ALTER TABLE `criterio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `criteriopregunta`
--
ALTER TABLE `criteriopregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `evaluacionestudiante`
--
ALTER TABLE `evaluacionestudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `programa`
--
ALTER TABLE `programa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `respuestadocente`
--
ALTER TABLE `respuestadocente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipodocente`
--
ALTER TABLE `tipodocente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipoevaluacion`
--
ALTER TABLE `tipoevaluacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `asignatura_ibfk_1` FOREIGN KEY (`id_programa`) REFERENCES `programa` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `criterio`
--
ALTER TABLE `criterio`
  ADD CONSTRAINT `criterio_ibfk_1` FOREIGN KEY (`tipoEvaluacion`) REFERENCES `tipoevaluacion` (`id`);

--
-- Constraints for table `criteriopregunta`
--
ALTER TABLE `criteriopregunta`
  ADD CONSTRAINT `criteriopregunta_ibfk_1` FOREIGN KEY (`criterio`) REFERENCES `criterio` (`id`);

--
-- Constraints for table `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_2` FOREIGN KEY (`id_tipo_docente`) REFERENCES `tipodocente` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `docente_ibfk_3` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `docente_ibfk_4` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`dni`) ON UPDATE CASCADE,
  ADD CONSTRAINT `docente_ibfk_5` FOREIGN KEY (`codigo`) REFERENCES `usuario` (`usuario`) ON UPDATE CASCADE;

--
-- Constraints for table `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_2` FOREIGN KEY (`id_programa`) REFERENCES `programa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiante_ibfk_3` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`dni`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiante_ibfk_4` FOREIGN KEY (`codigo`) REFERENCES `usuario` (`usuario`) ON UPDATE CASCADE;

--
-- Constraints for table `estudianteasignatura`
--
ALTER TABLE `estudianteasignatura`
  ADD CONSTRAINT `EstudianteAsignatura_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `EstudianteAsignatura_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `evaluacion_ibfk_1` FOREIGN KEY (`id_tipo_evaluacion`) REFERENCES `tipoevaluacion` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `evaluaciondocente`
--
ALTER TABLE `evaluaciondocente`
  ADD CONSTRAINT `EvaluacionDocente_ibfk_1` FOREIGN KEY (`codigo_docente`) REFERENCES `docente` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `EvaluacionDocente_ibfk_2` FOREIGN KEY (`id_evaluacion`) REFERENCES `evaluacion` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `evaluacionestudiante`
--
ALTER TABLE `evaluacionestudiante`
  ADD CONSTRAINT `EvaluacionEstudiante_ibfk_1` FOREIGN KEY (`codigo_estudiante`) REFERENCES `estudianteasignatura` (`id_estudiante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `EvaluacionEstudiante_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `estudianteasignatura` (`id_grupo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `EvaluacionEstudiante_ibfk_3` FOREIGN KEY (`id_evaluacion`) REFERENCES `evaluacion` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`codigo_asignatura`) REFERENCES `asignatura` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`codigo`) ON UPDATE CASCADE;

--
-- Constraints for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`id_evaluacion`) REFERENCES `evaluacion` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `respuestadocente`
--
ALTER TABLE `respuestadocente`
  ADD CONSTRAINT `respuestaDocente_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `respuestaDocente_ibfk_2` FOREIGN KEY (`codigo_docente`) REFERENCES `evaluaciondocente` (`codigo_docente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `respuestaDocente_ibfk_3` FOREIGN KEY (`id_evaluacion`) REFERENCES `evaluaciondocente` (`id_evaluacion`) ON UPDATE CASCADE;

--
-- Constraints for table `respuestaestudiante`
--
ALTER TABLE `respuestaestudiante`
  ADD CONSTRAINT `respuestaEstudiante_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `respuestaEstudiante_ibfk_2` FOREIGN KEY (`id_Evaluacion_Estudiante`) REFERENCES `evaluacionestudiante` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;