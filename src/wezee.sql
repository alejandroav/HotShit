-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-10-2015 a las 13:21:50
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `wezee`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `follows`
--

CREATE TABLE `follows` (
  `follower` int(11) NOT NULL DEFAULT '0',
  `followed` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `followtags`
--

CREATE TABLE `followtags` (
  `follower` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `user` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `video` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `displayname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `img`, `displayname`) VALUES
(1, 'alejandroalarcon93@gmail.com', '5dff8adeea2d2eb0f4f39c291e1f0888c50e5cdc1bf06aa0d7bccbc5b9f3e6612c4a1aff02c35969bc249330acfdedac6d6ac263794524fc86a7f31ffca2d3d5', 'Jandor', '1.bmp', NULL),
(3, 'alexei-117@hotmail.com', 'f2e05e21a5d9f4e166073427e03cd66775e4860d6c1673d8bd0672443d9c7f9d0fa80aabc6578d476443f8c054ffe9e0d2310de79a794a4bb497309199eec0f6', 'Alexei', NULL, NULL),
(6, 'alexisgenio10@gmail.com', 'f2e05e21a5d9f4e166073427e03cd66775e4860d6c1673d8bd0672443d9c7f9d0fa80aabc6578d476443f8c054ffe9e0d2310de79a794a4bb497309199eec0f6', 'pepitoGrillo', NULL, NULL),
(11, 'h1263220@trbvm.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'DFM', NULL, NULL),
(10, 'ignacioferrando@gmail.com', '8f2adfaa3ee19d297001672d556107c59bf1def6b9ee32cf303b2cb975bbae56015f8ba6d41f484fc81f4823119b21b5a5111cb12c975d791fa20d46f02ecdc1', 'Noctropolitan', NULL, NULL),
(5, 'jehernandez1996@gmail.com', 'd1a6ea6716d760e01b3b4912f626b30074fe0ae593a65c73a87e50873f5ecf8c0e890a4852989f6abba001e3319ed2d4e3de4922a11499dd6d1f3647426b132e', 'jesus34', NULL, NULL),
(8, 'laura.perez.bernabe@gmail.com', '0721842389870f0b740556763dbb5722f14bc91b2693212b44f12da3851bd98100b6d48f1c03ed980a874953a9e8d26d5f0ab113fc55ffaeed1f73d14e0b774d', 'Ninji_n', NULL, NULL),
(13, 'luis_phoenix-conexion@hotmail.com', '0e7b0333854454b8c94442f96b0684858cbdad2ef1b9be8c468941a5d4d8f1c13a429c334560de094e58c947bbe9d3da7a1b78d3379603dbc0eafb291bf03fca', 'AntoineGriezzman', NULL, NULL),
(12, 'marcos97skater@gmail.com', '95b61f466a7d97675db5a8078fdbd32dbb1781cb083ed0e23f548dd89bd94977ac2a8750a0526f9926d8d0d36d04f96b0cde3fd3bd14d110a95d65354a6aef38', 'Mark Says', NULL, NULL),
(2, 'marioga2512@gmail.com', 'bc24d5979be05c84440f8e054b7d50d82c060e8c3ee35227dbf9d0d16d93df6fb2a26fcd3d3b338195561784a2863c9069f3c9c3b65086e70915fc6ea3bdb3cf', 'themarioga', NULL, NULL),
(9, 'notediremicorreo@gmail.com', '56bc9823b1415de84e7d21fd262a480fdde377a92067faa75caa0346baf06a24b012224a1dc4a7c1935d8b959a5c7c413e8c29ff33943170cf987bff7a3a84f9', 'hola', NULL, NULL),
(7, 'p.lopez.iborra@gmail.com', '4c7af5fd4ef4354f53d2ec38a681da8082b66cec721ac1ea3721ef71ebb07f6d4c604675a601026fa9c5e73751de13014e161242a2c7671e7e4833a0a7c372ea', 'Matador4ko', NULL, NULL),
(4, 'sultangelhd@gmail.com', 'f2aa6d72cc3084c1cb12e033c61966fb347b9d9daa628858863c5fdbf3d3f3d09a226dceff734fc3532ea1bf6200002dc69eefe4a4e807001458fbcdc4737751', 'sultangel', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(500) NOT NULL,
  `user` varchar(50) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL,
  `trendlevel` double DEFAULT NULL,
  `views` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Índices para tablas volcadas
--

--
-- Indices de la tabla `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower`,`followed`);

--
-- Indices de la tabla `followtags`
--
ALTER TABLE `followtags`
  ADD PRIMARY KEY (`follower`,`tag`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`user`,`video`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`video`,`tag`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`,`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
