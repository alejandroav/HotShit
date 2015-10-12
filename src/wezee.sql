-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-10-2015 a las 20:29:02
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
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `video` int(11) NOT NULL COMMENT 'video id',
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `handle` varchar(10) NOT NULL COMMENT '@handle',
  `username` varchar(30) NOT NULL COMMENT 'public name'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'video name',
  `user` int(11) NOT NULL COMMENT 'user id',
  `description` text,
  `thumbnail` varchar(100) NOT NULL COMMENT 'location of thumbnail image',
  `file` varchar(500) NOT NULL COMMENT 'video file location',
  `trendlevel` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`video`,`tag`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`,`handle`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`,`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
