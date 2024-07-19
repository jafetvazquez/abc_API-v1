-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para abc-database
CREATE DATABASE IF NOT EXISTS `abc-database` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `abc-database`;

-- Volcando estructura para tabla abc-database.blogs
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `autor` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `image` blob DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla abc-database.blogs: ~5 rows (aproximadamente)
INSERT IGNORE INTO `blogs` (`id`, `title`, `content`, `autor`, `category`, `date`, `image`) VALUES
	(1, 'Errores en NgModel', 'If you stumble upon the error message "\r\nCan\'t bind to \'routerLink\' since it isn\'t a known property\r\n" while working with Angular - here is how to solve it. This error is usually displayed when you are using [routerLink]', 'Tempore', 'Programming', '1975-04-23', NULL),
	(9, 'Spotify sube el precio de todos sus planes en México', 'Spotify aumenta sus precios en México y otras partes del mundo. La plataforma de streaming de música ha anunciado un incremento en el costo de su servicio que afecta también a nuestro país, citando que "el panorama del mercado ha evolucionado" desde su lanzamiento, y para seguir evolucionando, es necesario este incremento de precio.', 'test', 'Music', '2023-07-25', NULL),
	(10, 'Cruz Azul tendrá refuerzo para la jornada 3 de la Leagues Cup', 'El conjunto de Cruz Azul confirmó a través de sus redes sociales que Willer Ditta consiguió su visa por lo que podrá disputar la Leagues Cup 2023', 'Jafet', 'Deportes', '2023-07-25', NULL),
	(11, 'México comete ecocidio y etnocidio por construcción del Tren Maya: Tribunal internacional', 'Este Tribunal determinó que el gobierno violenta los derechos bioculturales de los pueblos mayas, quienes son guardianes de cenotes y selvas del sureste', 'Jafet', 'Noticias', '2023-07-26', NULL);

-- Volcando estructura para tabla abc-database.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla abc-database.roles: ~2 rows (aproximadamente)
INSERT IGNORE INTO `roles` (`id`, `rol`) VALUES
	(1, 'admin'),
	(2, 'user');

-- Volcando estructura para tabla abc-database.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `username` varchar(255) DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `rol` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla abc-database.users: ~2 rows (aproximadamente)
INSERT IGNORE INTO `users` (`id`, `name`, `username`, `password`, `email`, `rol`) VALUES
	(1, 'test', 'test', '149815eb972b3c370dee3b89d645ae14', 'test@gmail.com', 'admin'),
	(10, 'jafet', 'jafet', '827ccb0eea8a706c4c34a16891f84e7b', 'jafet@gmail.com', 'user'),
	(11, 'Juan', 'juan', '5f4dcc3b5aa765d61d8327deb882cf99', 'juan@gmail.com', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
