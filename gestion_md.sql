/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.24-MariaDB : Database - gestion_md
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gestion_md` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `gestion_md`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comuna` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rut` (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clientes` */

/*Table structure for table `configuraciones` */

DROP TABLE IF EXISTS `configuraciones`;

CREATE TABLE `configuraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acronimo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parametro` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `configuraciones` */

insert  into `configuraciones`(`id`,`nombre`,`acronimo`,`parametro`,`tipo`,`valor`) values (1,'Impuesto valor agregado','IVA','iva','double','19');

/*Table structure for table `cotizacion_servicio` */

DROP TABLE IF EXISTS `cotizacion_servicio`;

CREATE TABLE `cotizacion_servicio` (
  `cotizaciones_id` int(11) NOT NULL,
  `servicios_id` int(11) NOT NULL,
  PRIMARY KEY (`cotizaciones_id`,`servicios_id`),
  KEY `servicios_id` (`servicios_id`),
  CONSTRAINT `cotizacion_servicio_ibfk_1` FOREIGN KEY (`cotizaciones_id`) REFERENCES `cotizaciones` (`id`),
  CONSTRAINT `cotizacion_servicio_ibfk_2` FOREIGN KEY (`servicios_id`) REFERENCES `servicios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizacion_servicio` */

/*Table structure for table `cotizaciones` */

DROP TABLE IF EXISTS `cotizaciones`;

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `titulo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neto` int(11) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `iva_historico` double DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuarios_id` int(11) DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarios_id` (`usuarios_id`),
  KEY `clientes_id` (`clientes_id`),
  CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `cotizaciones_ibfk_2` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizaciones` */

/*Table structure for table `detalle_cotizacion` */

DROP TABLE IF EXISTS `detalle_cotizacion`;

CREATE TABLE `detalle_cotizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cotizaciones_id` int(11) DEFAULT NULL,
  `items_id` int(11) DEFAULT NULL,
  `n_linea` smallint(6) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cotizaciones_id` (`cotizaciones_id`),
  KEY `items_id` (`items_id`),
  CONSTRAINT `detalle_cotizacion_ibfk_1` FOREIGN KEY (`cotizaciones_id`) REFERENCES `cotizaciones` (`id`),
  CONSTRAINT `detalle_cotizacion_ibfk_2` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detalle_cotizacion` */

/*Table structure for table `detalle_cotizacion_real` */

DROP TABLE IF EXISTS `detalle_cotizacion_real`;

CREATE TABLE `detalle_cotizacion_real` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cotizaciones_id` int(11) DEFAULT NULL,
  `items_id` int(11) DEFAULT NULL,
  `n_linea` smallint(6) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cotizaciones_id` (`cotizaciones_id`),
  KEY `items_id` (`items_id`),
  CONSTRAINT `detalle_cotizacion_real_ibfk_1` FOREIGN KEY (`cotizaciones_id`) REFERENCES `cotizaciones` (`id`),
  CONSTRAINT `detalle_cotizacion_real_ibfk_2` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detalle_cotizacion_real` */

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `items` */

insert  into `items`(`id`,`nombre`) values (1,'Hora hombre (hh)'),(2,'Materiales'),(3,'Colación'),(4,'Traslado'),(5,'Caja chica'),(6,'Compras menores');

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identificador` int(11) DEFAULT NULL,
  `data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarios_id` (`usuarios_id`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `logs` */

/*Table structure for table `opcion_rol` */

DROP TABLE IF EXISTS `opcion_rol`;

CREATE TABLE `opcion_rol` (
  `roles_id` int(11) NOT NULL,
  `opciones_id` int(11) NOT NULL,
  PRIMARY KEY (`roles_id`,`opciones_id`),
  KEY `opciones_id` (`opciones_id`),
  CONSTRAINT `opcion_rol_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `opcion_rol_ibfk_2` FOREIGN KEY (`opciones_id`) REFERENCES `opciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `opcion_rol` */

/*Table structure for table `opciones` */

DROP TABLE IF EXISTS `opciones`;

CREATE TABLE `opciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `opciones` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`nombre`) values (1,'Administrador'),(2,'Usuario');

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `servicios` */

insert  into `servicios`(`id`,`nombre`) values (1,'CCTV'),(2,'Alarmas'),(3,'Voceo'),(4,'Portones');

/*Table structure for table `sucursales` */

DROP TABLE IF EXISTS `sucursales`;

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientes_id` int(11) DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comuna` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientes_id` (`clientes_id`),
  CONSTRAINT `sucursales_ibfk_1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sucursales` */

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles_id` int(11) DEFAULT NULL,
  `escribir` tinyint(1) NOT NULL DEFAULT 1,
  `editar` tinyint(1) NOT NULL DEFAULT 1,
  `eliminar` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `roles_id` (`roles_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`usuario`,`password`,`nombre`,`email`,`roles_id`,`escribir`,`editar`,`eliminar`) values (1,'admin','827ccb0eea8a706c4c34a16891f84e7b','Administrador','admin@mdsg.cl',1,1,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
