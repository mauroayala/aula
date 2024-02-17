-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2024 a las 10:03:29
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aula`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `ipComprador` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefono` varchar(200) DEFAULT NULL,
  `nombreyapellido` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `medio` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `foto1` varchar(300) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `descripcion` varchar(599) DEFAULT NULL,
  `precio` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`, `foto1`, `estado`, `descripcion`, `precio`) VALUES
(1, 'Lacteo', NULL, NULL, NULL, '0.00'),
(2, 'Fiambres', NULL, NULL, NULL, '0.00'),
(3, 'Cerdo', NULL, NULL, NULL, '0.00'),
(4, 'Fideos', NULL, NULL, NULL, '0.00'),
(5, 'Condimentos', NULL, NULL, NULL, '0.00'),
(6, 'Infusiones', NULL, NULL, NULL, '0.00'),
(7, 'Jugo', NULL, NULL, NULL, '0.00'),
(8, 'Vinos', NULL, NULL, NULL, '0.00'),
(9, 'Pollo', NULL, NULL, NULL, '0.00'),
(10, 'Aceitunas', NULL, NULL, NULL, '0.00'),
(11, 'Aceite', NULL, NULL, NULL, '0.00'),
(12, 'Hamburguesas', NULL, NULL, NULL, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle` int(11) NOT NULL,
  `id_producto` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_carrito` int(11) NOT NULL,
  `precio` varchar(10) NOT NULL,
  `medida` varchar(250) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'Publicada'),
(2, 'Despublicada'),
(3, 'Borrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id_examen` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_instituto` int(9) NOT NULL,
  `fecha_limite` date NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`id_examen`, `titulo`, `descripcion`, `id_instituto`, `fecha_limite`, `estado`) VALUES
(1, 'Examen Diagnóstico Operador de herramienta de marketing ', 'Examen Diagnóstico Operador de herramienta de marketing ', 1, '2024-02-29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituto`
--

CREATE TABLE `instituto` (
  `id_instituto` int(9) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instituto`
--

INSERT INTO `instituto` (`id_instituto`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Instituto Madero', 'Escuela Secundaria Técnica\r\nCentro de Formación Profesional\r\nTalleres Tecnológicos para chicos de 9 a 13 años', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(9) NOT NULL,
  `id_viaje` int(9) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `reserva` varchar(100) DEFAULT NULL,
  `idiomas` varchar(100) DEFAULT NULL,
  `requerimientos` varchar(100) DEFAULT NULL,
  `fechareserva` date DEFAULT NULL,
  `guia` varchar(100) DEFAULT NULL,
  `bus` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `down_payment` varchar(20) DEFAULT NULL,
  `amount_due` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` int(9) NOT NULL,
  `pregunta` varchar(500) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `respuesta1` int(9) NOT NULL,
  `respuesta2` int(9) NOT NULL,
  `respuesta3` int(9) NOT NULL,
  `respuesta4` int(9) NOT NULL,
  `respuesta5` int(9) NOT NULL,
  `respuesta_correcta` int(9) NOT NULL,
  `estado` int(1) NOT NULL,
  `puntaje` int(3) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` bigint(20) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `medidas` varchar(100) DEFAULT NULL,
  `precio` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `foto1` varchar(1000) DEFAULT NULL,
  `colores` varchar(100) DEFAULT NULL,
  `foto2` varchar(1000) DEFAULT NULL,
  `foto3` varchar(1000) DEFAULT NULL,
  `foto4` varchar(1000) DEFAULT NULL,
  `foto5` varchar(200) DEFAULT NULL,
  `descripcion` varchar(1500) DEFAULT NULL,
  `categoria` varchar(40) DEFAULT NULL,
  `stock` char(3) NOT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `foto6` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidades`
--

CREATE TABLE `publicidades` (
  `id_publicidad` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `cuerpo` varchar(500) NOT NULL,
  `link` varchar(200) NOT NULL,
  `id_estado_p` int(11) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id_respuesta` int(9) NOT NULL,
  `respuesta` varchar(500) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id_subcategoria` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `subcategoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id_subcategoria`, `id_categoria`, `subcategoria`) VALUES
(1, 1, 'Leches'),
(2, 1, 'Quesos'),
(3, 1, 'Yogures'),
(5, 1, 'Cremas'),
(6, 1, 'Untables'),
(7, 1, 'Arroz con leche'),
(8, 1, 'Ricota '),
(9, 1, 'Dulce de leche'),
(10, 1, 'Postres'),
(11, 2, 'Secos'),
(12, 2, 'Jamonería'),
(13, 2, 'Embutido fresco '),
(15, 2, 'Al vacio'),
(16, 3, 'Cortes especiales '),
(17, 3, 'Chorizo de cerdo '),
(18, 3, 'Menudo de cerdo '),
(19, 3, 'Otros'),
(20, 4, 'Pastas Frescas'),
(21, 4, 'Pastas secas'),
(22, 5, 'Sobres'),
(23, 5, 'Bolsas x 1Kg'),
(24, 6, 'Infusiones'),
(25, 7, 'Tetra'),
(26, 7, 'Bidón'),
(27, 8, 'Malbec'),
(28, 8, 'Cabernet'),
(29, 8, 'Patero endulzado'),
(30, 8, 'Botellon de mimbre'),
(31, 9, 'Pollo entero '),
(32, 9, 'Trozados  '),
(33, 9, 'Otros'),
(34, 10, 'Aceitunas'),
(35, 11, 'Aceite'),
(36, 12, 'Hamburguesas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `Cod_Tipo_Producto` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariositumanda`
--

CREATE TABLE `usuariositumanda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `provincia` varchar(200) NOT NULL,
  `localidad` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `cp` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `documento` varchar(200) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `nivel` varchar(100) NOT NULL,
  `celular` varchar(100) NOT NULL,
  `empresa` varchar(200) NOT NULL,
  `tarjetas` char(2) NOT NULL,
  `envios` char(2) NOT NULL,
  `horarios` varchar(100) NOT NULL,
  `facebook` varchar(300) NOT NULL,
  `instagram` varchar(300) NOT NULL,
  `twitter` varchar(300) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `subtitulo` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuariositumanda`
--

INSERT INTO `usuariositumanda` (`id`, `nombre`, `apellido`, `email`, `provincia`, `localidad`, `direccion`, `cp`, `telefono`, `documento`, `usuario`, `pass`, `fecha`, `estado`, `pais`, `clave`, `nivel`, `celular`, `empresa`, `tarjetas`, `envios`, `horarios`, `facebook`, `instagram`, `twitter`, `logo`, `subtitulo`) VALUES
(1, 'ADMINISTRADOR2', 'ADMINISTRADOR', 'ADMIN@GMAIL.COM', '', '', '', '', '', '', 'ADMIN@GMAIL.COM', '202cb962ac59075b964b07152d234b70', '0000-00-00', 3, '', '', '00983488300833', '', '', '', '', '', '', '', '', '', ''),
(1179, '', '', '', '', '', '', '', '', '', '', '6c9449cbe65b8e6e528617bef78c251c', '2021-05-20', 1, '', '', '1', '', '', '', '', '', '', '', '', '', ''),
(1175, 'SOL', 'SOL', 'SOL@GMAIL.COM', '', '', '', '', '', '', 'SOL@GMAIL.COM', 'b7a73d6e47628e8580190e12ec1b90c5', '0000-00-00', 3, '', '', '00983488300833', '', '', '', '', '', '', '', '', '', ''),
(1178, 'Julian', 'Julian', 'mauro.julian.ayala@gmail.com', '', '', 'El Tirador', '', '01137700680', '', 'mauro.julian.ayala@gmail.com', '8cc4db1d5f5797417115b86e3279605f', '2021-05-20', 1, '', '', '1', '', '', '', '', '', '', '', '', '', ''),
(1177, 'ABC', 'ABC', 'PONCESOL@GMAIL.COM', '', '', 'ABC', '', '123', '', 'PONCESOL@GMAIL.COM', '635dd94da6c43762f9c39b5c5dae22fb', '2021-05-19', 1, '', '', '1', '', '', '', '', '', '', '', '', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id_examen`);

--
-- Indices de la tabla `instituto`
--
ALTER TABLE `instituto`
  ADD PRIMARY KEY (`id_instituto`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `publicidades`
--
ALTER TABLE `publicidades`
  ADD PRIMARY KEY (`id_publicidad`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_respuesta`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_subcategoria`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`Cod_Tipo_Producto`);

--
-- Indices de la tabla `usuariositumanda`
--
ALTER TABLE `usuariositumanda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id_examen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `instituto`
--
ALTER TABLE `instituto`
  MODIFY `id_instituto` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicidades`
--
ALTER TABLE `publicidades`
  MODIFY `id_publicidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuesta` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `Cod_Tipo_Producto` smallint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuariositumanda`
--
ALTER TABLE `usuariositumanda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1180;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
