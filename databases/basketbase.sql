-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2016 a las 17:52:15
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basketbase`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `provincia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clubs`
--

CREATE TABLE `clubs` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `provincia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores`
--

CREATE TABLE `entrenadores` (
  `dni` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ape1` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ape2` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(5000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `provincia` int(11) NOT NULL,
  `fecha_ini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrena_equipo`
--

CREATE TABLE `entrena_equipo` (
  `equipo` int(11) NOT NULL DEFAULT '0',
  `entrenador` varchar(9) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `fecha_ini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `club` int(11) DEFAULT NULL,
  `cami_loc` varchar(7) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cami_vis` varchar(7) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora_juego` time DEFAULT NULL,
  `pabellon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_fase_cat`
--

CREATE TABLE `equipos_fase_cat` (
  `equipo` int(11) NOT NULL DEFAULT '0',
  `fase` int(11) NOT NULL DEFAULT '0',
  `categoria` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_equipos`
--

CREATE TABLE `evento_equipos` (
  `evento` int(11) NOT NULL,
  `equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fases`
--

CREATE TABLE `fases` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `codigo` int(11) NOT NULL,
  `titulo` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `subtitulo` varchar(1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cuerpo` varchar(10000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vistas` int(11) DEFAULT '0',
  `club` int(11) DEFAULT NULL,
  `evento` int(11) DEFAULT NULL,
  `autor` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `codigo` int(11) NOT NULL,
  `mensaje` varchar(1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `patrocinador` int(11) DEFAULT NULL,
  `evento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pabellones`
--

CREATE TABLE `pabellones` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `ayuntamiento` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lugar` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `provincia` int(11) DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pabellones`
--

INSERT INTO `pabellones` (`codigo`, `nombre`, `latitud`, `longitud`, `ayuntamiento`, `lugar`, `provincia`, `direccion`) VALUES
(1, 'Pavillón de Canide', 43.3694, -8.33379, 'Oleiros', 'Mera', 15, 'Avda María Pita, 22'),
(2, 'Pavillón de Bastiagueiro', 43.3397, -8.35066, 'Oleiros', 'Bastiagueiro', 15, 'Rúa Uxío Novo Neira, 144'),
(3, 'Pavillón de Perillo', 43.3351, -8.36313, 'Oleiros', 'Perillo', 15, 'Rúa Anduriñas, 13'),
(4, 'Pavillón Arsenio Iglesias', 43.3467, -8.34223, 'Oleiros', 'Santa Cruz', 15, 'Praza Arsenio Iglesias, 6'),
(5, 'Pavillón Oleiros', 43.3304, -8.32421, 'Oleiros', 'Oleiros', 15, 'Rúa Ensino, 3'),
(6, 'Polideportivo Agra II', 43.3686, -8.42254, 'A Coruña', 'A Coruña', 15, 'Rúa Manuel Murguía, 42'),
(7, 'Riazor 1', 43.3677, -8.41876, 'A Coruña', 'A Coruña', 15, 'Avda de la Habana, 15-21'),
(8, 'Riazor 2', 43.3677, -8.41876, 'A Coruña', 'A Coruña', 15, 'Avda de la Habana, 15-21'),
(9, 'Cocheras', 43.3729, -8.42762, 'A Coruña', 'A Coruña', 15, 'Estrada Os Fortes, 24'),
(10, 'Los Rosales', 43.3762, -8.42875, 'A Coruña', 'A Coruña', 15, 'Rúa Alfonso Rodríguez Castelao'),
(11, 'Dominicos', 43.3703, -8.3914, 'A Coruña', 'A Coruña', 15, 'Praza Santo Domingo, 3'),
(12, 'Santa María del Mar', 43.3355, -8.38898, 'A Coruña', 'A Coruña', 15, 'Avenida Pasaxe, 69'),
(13, 'Maristas', 43.3358, -8.39943, 'A Coruña', 'A Coruña', 15, 'Lugar Elviña, 149'),
(14, 'Elviña I', 43.3417, -8.41382, 'A Coruña', 'A Coruña', 15, 'Avda Glasgow, 7'),
(15, 'Elviña II', 43.3439, -8.41125, 'A Coruña', 'A Coruña', 15, 'Praza Manuel Guitian, 1'),
(16, 'Ventorrillo', 43.3605, -8.42605, 'A Coruña', 'A Coruña', 15, 'Rúa Alcalde Peñamaría de Llano, 10'),
(17, 'Sagrada Familia', 43.3564, -8.41736, 'A Coruña', 'A Coruña', 15, 'Rúa Pasteur, 45-71'),
(18, 'A Sardiñeira', 43.3512, -8.41628, 'A Coruña', 'A Coruña', 15, 'Avenida Arteijo, 112'),
(19, 'Elviña I', 43.3417, -8.41382, 'A Coruña', 'A Coruña', 15, 'Avda Glasgow, 7'),
(20, 'Polideportivo Mun. de O Burgo', 43.3133, -8.37235, 'Culleredo', 'O Burgo', 15, 'Rúa de Cacabelos, s/n'),
(21, 'Polideportivo Mun. de Almeiras', 43.3039, -8.36816, 'Culleredo', 'Almeiras', 15, 'Rúa Catas, 35'),
(22, 'Polideportivo Mun. de Tarrío', 43.2891, -8.37803, 'Culleredo', 'Tarrío', 15, 'Rúa Paxariñas, 16'),
(23, 'Polideportivo Mun. de Vilaboa', 43.3141, -8.38143, 'Culleredo', 'Vilaboa', 15, 'Rúa da Calzada, 7'),
(24, 'Polideportivo Ría do Burgo', 43.3201, -8.3794, 'Culleredo', 'O Burgo', 15, 'Rúa María Cagiao, 3'),
(25, 'Pavillón Sofía Toro', 43.2917, -8.34713, 'Cambre', 'Cambre', 15, 'Rúa Wenceslao Fernández Flórez, 14'),
(26, 'Pavillón Polideportivo Brexo Lema', 43.2744, -8.31906, 'Cambre', 'Brexo Lema', 15, 'Lugar Cereixeiro, 1'),
(27, 'Pavillón Polideportivo O Graxal', 43.3198, -8.35582, 'Cambre', 'O Temple', 15, 'Rúa Francisco Rodríguez, 5'),
(28, 'Pavillón Polideportivo Os Campóns', 43.2873, -8.35547, 'Cambre', 'Os Campóns', 15, 'Campóns, 6'),
(29, 'Pazo dos Deportes de Arteixo', 43.3088, -8.50884, 'Arteixo', 'Arteixo', 15, 'Av Arsenio Iglesias, 43'),
(30, 'Polideportivo Mun. San Xosé Obreiro', 43.3454, -8.44779, 'Arteixo', 'Meicende', 15, 'Travesía de Meirás, 86'),
(31, 'Pabellón del IES Agra de Leborís', 43.2469, -8.58413, 'A Laracha', 'A Laracha', 15, 'Rúa Manuel Murguía, s/n'),
(32, 'Pabellón Municipal de A Laracha', 43.2508, -8.57686, 'A Laracha', 'A Laracha', 15, 'Campo, s/n'),
(33, 'Pabellón Municipal de Caión', 43.3167, -8.59379, 'A Laracha', 'Xermaña', 15, ''),
(34, 'Pabellón Municipal de Paiosaco', 43.2495, -8.55525, 'A Laracha', 'Paiosaco', 15, 'Carretera Soandres, 18'),
(35, 'Polideportivo Bergantiños', 43.2175, -8.69737, 'Carballo', 'Carballo', 15, 'Rúa Carballo Calero, 21'),
(36, 'Pabellón Vila de Noia', 43.2174, -8.68366, 'Carballo', 'Carballo', 15, 'Rúa Vila de Noia, s/n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `codigo` int(11) NOT NULL,
  `resultado` varchar(7) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `local` int(11) DEFAULT NULL,
  `visitante` int(11) DEFAULT NULL,
  `evento` int(11) DEFAULT NULL,
  `jornada` int(11) DEFAULT NULL,
  `aplazado` binary(1) NOT NULL DEFAULT '0',
  `pabellon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinadores`
--

CREATE TABLE `patrocinadores` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ofertas` int(11) DEFAULT NULL,
  `sector` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `fecha_ini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `provincia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_club`
--

CREATE TABLE `permiso_club` (
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_eve`
--

CREATE TABLE `permiso_eve` (
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `evento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_patro`
--

CREATE TABLE `permiso_patro` (
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `patrocinador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `cp` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`cp`, `nombre`) VALUES
(15, 'A Coruña'),
(2, 'Albacete'),
(3, 'Alicante'),
(4, 'Almería'),
(1, 'Araba'),
(33, 'Asturias'),
(5, 'Ávila'),
(6, 'Badajoz'),
(8, 'Barcelona'),
(48, 'Bizkaia'),
(9, 'Burgos'),
(10, 'Cáceres'),
(11, 'Cádiz'),
(39, 'Cantabria'),
(12, 'Castellón'),
(51, 'Ceuta'),
(13, 'Ciudad Real'),
(14, 'Córdoba'),
(16, 'Cuenca'),
(20, 'Gipuzkoa'),
(17, 'Girona'),
(18, 'Granada'),
(19, 'Guadalajara'),
(21, 'Huelva'),
(22, 'Huesca'),
(7, 'Illes Balears'),
(23, 'Jaén'),
(26, 'La Rioja'),
(35, 'Las Palmas'),
(24, 'León'),
(25, 'Lleida'),
(27, 'Lugo'),
(28, 'Madrid'),
(29, 'Málaga'),
(52, 'Melilla'),
(30, 'Murcia'),
(31, 'Navarra'),
(32, 'Ourense'),
(34, 'Palencia'),
(36, 'Pontevedra'),
(37, 'Salamanca'),
(38, 'Santa de Cruz de Tenerife'),
(40, 'Segovia'),
(41, 'Sevilla'),
(42, 'Soria'),
(43, 'Tarragona'),
(44, 'Teruel'),
(45, 'Toledo'),
(46, 'Valencia'),
(47, 'Valladolid'),
(49, 'Zamora'),
(50, 'Zaragoza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provisional`
--

CREATE TABLE `provisional` (
  `codigo` int(11) NOT NULL,
  `partido` int(11) NOT NULL,
  `resultado` varchar(7) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `nick` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ape1` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ape2` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pass` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(5000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_ini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acceso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nick`, `email`, `nombre`, `ape1`, `ape2`, `pass`, `imagen`, `descripcion`, `admin`, `fecha_ini`, `acceso`) VALUES
('00397089V', 'chema', 'chema_glez@terra.com', 'jose maria', 'gonzalez', 'rodriguez', '03557b6fea4ad426f2addef2ffcc23c4', NULL, NULL, 0, '2016-05-12 14:35:08', NULL),
('32770634G', 'Malipo', 'malipomac@gmail.com', 'Manuel', 'Liñares', 'Porto', '2c019b25c1efc88f10c4c7904777b52d', NULL, NULL, 0, '2016-05-12 14:44:01', NULL),
('47386285Y', 'rgeo9', 'hermidamourelle@gmail.com', 'Pablo', 'Hermida', 'Mourelle', '428890a572934edc46cc4168af5bcb66', NULL, NULL, 0, '2016-06-04 18:14:12', '2016-06-15 02:21:56'),
('76583817G', 'xoelfolgueiras', 'xoel16@gmail.com', 'Xoel', 'Folgueiras', 'Arias', '98d8a1c4651dd43c7f7eeeab2e3a7843', NULL, NULL, 0, '2016-05-12 14:27:12', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_catProv` (`provincia`);

--
-- Indices de la tabla `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_clubProv` (`provincia`);

--
-- Indices de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_entProv` (`provincia`);

--
-- Indices de la tabla `entrena_equipo`
--
ALTER TABLE `entrena_equipo`
  ADD PRIMARY KEY (`equipo`,`entrenador`),
  ADD KEY `fk_entrenaDni` (`entrenador`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_eqClub` (`club`),
  ADD KEY `pabellon` (`pabellon`);

--
-- Indices de la tabla `equipos_fase_cat`
--
ALTER TABLE `equipos_fase_cat`
  ADD PRIMARY KEY (`equipo`,`fase`,`categoria`),
  ADD KEY `fk_eqFaseCatFa` (`fase`),
  ADD KEY `fk_eqFaseCatCa` (`categoria`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_eveProv` (`provincia`);

--
-- Indices de la tabla `evento_equipos`
--
ALTER TABLE `evento_equipos`
  ADD PRIMARY KEY (`evento`,`equipo`),
  ADD KEY `fk_eveqEquipo` (`equipo`);

--
-- Indices de la tabla `fases`
--
ALTER TABLE `fases`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_notClub` (`club`),
  ADD KEY `fk_notEvento` (`evento`),
  ADD KEY `fk_notAutor` (`autor`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_ofPatro` (`patrocinador`),
  ADD KEY `fk_ofEvento` (`evento`);

--
-- Indices de la tabla `pabellones`
--
ALTER TABLE `pabellones`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_pabProv` (`provincia`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_partLoc` (`local`),
  ADD KEY `fk_partVis` (`visitante`),
  ADD KEY `fk_partEve` (`evento`),
  ADD KEY `fk_partPabellon` (`pabellon`);

--
-- Indices de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_patroProv` (`provincia`);

--
-- Indices de la tabla `permiso_club`
--
ALTER TABLE `permiso_club`
  ADD PRIMARY KEY (`dni`,`club`),
  ADD KEY `fk_pcClub` (`club`);

--
-- Indices de la tabla `permiso_eve`
--
ALTER TABLE `permiso_eve`
  ADD PRIMARY KEY (`dni`,`evento`),
  ADD KEY `fk_puEvento` (`evento`);

--
-- Indices de la tabla `permiso_patro`
--
ALTER TABLE `permiso_patro`
  ADD PRIMARY KEY (`dni`,`patrocinador`),
  ADD KEY `fk_ppPatro` (`patrocinador`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`cp`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `cp` (`cp`);

--
-- Indices de la tabla `provisional`
--
ALTER TABLE `provisional`
  ADD PRIMARY KEY (`codigo`,`partido`),
  ADD KEY `fk_provisPart` (`partido`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `nick` (`nick`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fases`
--
ALTER TABLE `fases`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pabellones`
--
ALTER TABLE `pabellones`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `provisional`
--
ALTER TABLE `provisional`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_catProv` FOREIGN KEY (`provincia`) REFERENCES `provincias` (`cp`);

--
-- Filtros para la tabla `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `fk_clubProv` FOREIGN KEY (`provincia`) REFERENCES `provincias` (`cp`);

--
-- Filtros para la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  ADD CONSTRAINT `fk_entProv` FOREIGN KEY (`provincia`) REFERENCES `provincias` (`cp`);

--
-- Filtros para la tabla `entrena_equipo`
--
ALTER TABLE `entrena_equipo`
  ADD CONSTRAINT `fk_entrenaDni` FOREIGN KEY (`entrenador`) REFERENCES `entrenadores` (`dni`),
  ADD CONSTRAINT `fk_entrenaEquipo` FOREIGN KEY (`equipo`) REFERENCES `equipos` (`codigo`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `fk_eqClub` FOREIGN KEY (`club`) REFERENCES `clubs` (`codigo`),
  ADD CONSTRAINT `fk_equipoPab` FOREIGN KEY (`pabellon`) REFERENCES `pabellones` (`codigo`);

--
-- Filtros para la tabla `equipos_fase_cat`
--
ALTER TABLE `equipos_fase_cat`
  ADD CONSTRAINT `fk_eqFaseCatCa` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`codigo`),
  ADD CONSTRAINT `fk_eqFaseCatEq` FOREIGN KEY (`equipo`) REFERENCES `equipos` (`codigo`),
  ADD CONSTRAINT `fk_eqFaseCatFa` FOREIGN KEY (`fase`) REFERENCES `fases` (`codigo`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_eveProv` FOREIGN KEY (`provincia`) REFERENCES `provincias` (`cp`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_notAutor` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `fk_notClub` FOREIGN KEY (`club`) REFERENCES `clubs` (`codigo`),
  ADD CONSTRAINT `fk_notEvento` FOREIGN KEY (`evento`) REFERENCES `eventos` (`codigo`);

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `fk_ofEvento` FOREIGN KEY (`evento`) REFERENCES `eventos` (`codigo`),
  ADD CONSTRAINT `fk_ofPatro` FOREIGN KEY (`patrocinador`) REFERENCES `patrocinadores` (`codigo`);

--
-- Filtros para la tabla `pabellones`
--
ALTER TABLE `pabellones`
  ADD CONSTRAINT `fk_pabProv` FOREIGN KEY (`provincia`) REFERENCES `provincias` (`cp`);

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `fk_partEve` FOREIGN KEY (`evento`) REFERENCES `eventos` (`codigo`),
  ADD CONSTRAINT `fk_partLoc` FOREIGN KEY (`local`) REFERENCES `equipos` (`codigo`),
  ADD CONSTRAINT `fk_partPabellon` FOREIGN KEY (`pabellon`) REFERENCES `pabellones` (`codigo`),
  ADD CONSTRAINT `fk_partVis` FOREIGN KEY (`visitante`) REFERENCES `equipos` (`codigo`);

--
-- Filtros para la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD CONSTRAINT `fk_patroProv` FOREIGN KEY (`provincia`) REFERENCES `provincias` (`cp`);

--
-- Filtros para la tabla `permiso_club`
--
ALTER TABLE `permiso_club`
  ADD CONSTRAINT `fk_pcClub` FOREIGN KEY (`club`) REFERENCES `clubs` (`codigo`),
  ADD CONSTRAINT `fk_pcDni` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`dni`);

--
-- Filtros para la tabla `permiso_eve`
--
ALTER TABLE `permiso_eve`
  ADD CONSTRAINT `fk_puDni` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `fk_puEvento` FOREIGN KEY (`evento`) REFERENCES `eventos` (`codigo`);

--
-- Filtros para la tabla `permiso_patro`
--
ALTER TABLE `permiso_patro`
  ADD CONSTRAINT `fk_ppDni` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `fk_ppPatro` FOREIGN KEY (`patrocinador`) REFERENCES `patrocinadores` (`codigo`);

--
-- Filtros para la tabla `provisional`
--
ALTER TABLE `provisional`
  ADD CONSTRAINT `fk_provisPart` FOREIGN KEY (`partido`) REFERENCES `partidos` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
