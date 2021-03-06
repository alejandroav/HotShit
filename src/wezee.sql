-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.6.17 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para wezee
DROP DATABASE IF EXISTS `wezee`;
CREATE DATABASE IF NOT EXISTS `wezee` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wezee`;


-- Volcando estructura para tabla wezee.follows
DROP TABLE IF EXISTS `follows`;
CREATE TABLE IF NOT EXISTS `follows` (
  `follower` int(11) NOT NULL DEFAULT '0',
  `followed` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `tag` varchar(50) NOT NULL DEFAULT '""',
  PRIMARY KEY (`follower`,`followed`,`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla wezee.follows: ~0 rows (aproximadamente)
DELETE FROM `follows`;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;


-- Volcando estructura para tabla wezee.likes
DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `user` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`user`,`video`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla wezee.likes: ~0 rows (aproximadamente)
DELETE FROM `likes`;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;


-- Volcando estructura para tabla wezee.tags
DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `video` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL,
  PRIMARY KEY (`video`,`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla wezee.tags: ~0 rows (aproximadamente)
DELETE FROM `tags`;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;


-- Volcando estructura para tabla wezee.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `displayname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`email`,`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla wezee.users: ~4 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `username`, `img`, `displayname`) VALUES
	(17, 'alejandroalarcon93@gmail.com', '5dff8adeea2d2eb0f4f39c291e1f0888c50e5cdc1bf06aa0d7bccbc5b9f3e6612c4a1aff02c35969bc249330acfdedac6d6ac263794524fc86a7f31ffca2d3d5', 'Jandor', NULL, NULL),
	(14, 'prueba3@prueba.com', '99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8', 'User3', NULL, NULL),
	(15, 'prueba5@gmail.com', '99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8', 'User5', NULL, NULL),
	(16, 'prueba@prueba.com', '99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8', 'User', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Volcando estructura para tabla wezee.videos
DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `name` varchar(500) NOT NULL,
  `user` varchar(50) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL,
  `trendlevel` double DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla wezee.videos: ~0 rows (aproximadamente)
DELETE FROM `videos`;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
