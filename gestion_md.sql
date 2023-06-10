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
  `razonsocial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comuna` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rut` (`rut`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`rut`,`nombre`,`razonsocial`,`telefono`,`email`,`direccion`,`comuna`) values (1,'77.808.700-6','Mujica y Docmac Servicios Electrónicos','Mujica y Docmac Comercial y Servicios Electronicos Ltda.','+56981821885','bgonzalez@mdsg.cl','Calle René León N° 80','Curicó'),(2,'76.454.929-5','MUJICA Y DOCMAC ALERTA','ALERTA MD SECURITY SPA','+56981821885','bgonzalez@mdsg.cl','Calle René León N° 80','Curicó');

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

insert  into `configuraciones`(`id`,`nombre`,`acronimo`,`parametro`,`tipo`,`valor`) values (1,'Impuesto valor agregado','IVA','iva','double','0.19');

/*Table structure for table `cotizacion_material_presupuestado` */

DROP TABLE IF EXISTS `cotizacion_material_presupuestado`;

CREATE TABLE `cotizacion_material_presupuestado` (
  `cotizacion_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `n_linea` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  PRIMARY KEY (`cotizacion_id`,`material_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizacion_material_presupuestado` */

/*Table structure for table `cotizacion_material_real` */

DROP TABLE IF EXISTS `cotizacion_material_real`;

CREATE TABLE `cotizacion_material_real` (
  `cotizacion_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `n_linea` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  PRIMARY KEY (`cotizacion_id`,`material_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizacion_material_real` */

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
  `descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neto` int(11) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `iva_historico` double DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuarios_id` int(11) DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `neto_real` int(11) DEFAULT 0,
  `iva_real` int(11) DEFAULT 0,
  `total_real` int(11) DEFAULT 0,
  `cotizaciones_estado_id` int(11) DEFAULT 1,
  `fecha` datetime DEFAULT NULL,
  `material_neto_real` int(11) DEFAULT 0,
  `material_iva_real` int(11) DEFAULT 0,
  `material_total_real` int(11) DEFAULT 0,
  `material_neto` int(11) DEFAULT 0,
  `material_iva` int(11) DEFAULT 0,
  `material_total` int(11) DEFAULT 0,
  `margen` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totales_presupuestado` int(11) DEFAULT NULL,
  `totales_real` int(11) DEFAULT NULL,
  `diferencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarios_id` (`usuarios_id`),
  KEY `clientes_id` (`clientes_id`),
  CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `cotizaciones_ibfk_2` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizaciones` */

/*Table structure for table `cotizaciones_estado` */

DROP TABLE IF EXISTS `cotizaciones_estado`;

CREATE TABLE `cotizaciones_estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizaciones_estado` */

insert  into `cotizaciones_estado`(`id`,`nombre`) values (1,'No Iniciada'),(2,'Iniciada'),(3,'Finalizada');

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
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarios_id` (`usuarios_id`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `logs` */

insert  into `logs`(`id`,`accion`,`entidad`,`identificador`,`data`,`usuarios_id`,`fecha`) values (1,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-03-17 20:09:18'),(2,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"12345dasd\"}',3,'2023-03-17 20:10:38'),(3,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-03-17 20:12:15'),(4,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-06 17:25:27'),(5,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-06 17:25:33'),(6,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-06 17:54:02'),(7,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:29:24'),(8,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:29:28'),(9,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:29:33'),(10,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:49:31'),(11,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:49:53'),(12,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:52:19'),(13,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:53:33'),(14,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:57:49'),(15,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:58:31'),(16,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:59:15'),(17,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:59:28'),(18,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:01:50'),(19,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:02:03'),(20,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:04:52'),(21,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:05:58'),(22,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:06:21'),(23,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:07:43'),(24,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:08:13'),(25,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:17:26'),(26,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:17:32'),(27,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:17:57'),(28,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:30:08'),(29,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:30:25'),(30,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:31:31'),(31,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:32:06'),(32,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:32:41'),(33,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:33:25'),(34,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:14'),(35,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:28'),(36,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:35'),(37,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:36'),(38,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:37'),(39,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:37'),(40,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:38'),(41,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:38'),(42,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:43'),(43,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:35:07'),(44,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:35:22'),(45,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:35:27'),(46,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:36:07'),(47,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:36:13'),(48,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:36:28'),(49,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:39:06'),(50,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:39:10'),(51,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:41:28'),(52,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:41:40'),(53,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:49:55'),(54,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 06:06:32'),(55,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"0\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 06:38:55'),(56,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 06:39:07'),(57,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 01:32:34'),(58,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 14:33:09'),(59,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 14:33:25'),(60,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 21:17:21'),(61,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-11 22:06:16'),(62,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 14:34:09'),(63,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 20:39:57'),(64,'Login Incorrecto','usuarios',3,'{\"usuario\":\"mobile@gmail.com\",\"password\":\"12345\"}',3,'2023-04-12 22:20:00'),(65,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 22:20:02'),(66,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 22:24:09'),(67,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 22:26:10'),(68,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 22:29:50'),(69,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-18 16:16:39'),(70,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-18 21:11:21'),(71,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-19 18:42:47'),(72,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-25 16:46:09'),(73,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-05-09 20:13:41'),(74,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-05-15 11:45:44'),(75,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-05-18 11:13:49'),(76,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-05-18 13:00:39'),(77,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-05-18 13:44:04'),(78,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-05-30 12:06:48'),(79,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-06-07 21:30:31'),(80,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-06-10 10:09:03');

/*Table structure for table `materiales` */

DROP TABLE IF EXISTS `materiales`;

CREATE TABLE `materiales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` decimal(9,0) DEFAULT NULL,
  `stockideal` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `materiales` */

insert  into `materiales`(`id`,`codigo`,`nombre`,`valor`,`stockideal`,`stock`) values (1,1,'M1',3400,20,25),(2,2,'M2',5000,25,30),(86,3,'M3',1500,45,60);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`nombre`) values (1,'Administrador'),(2,'Usuario'),(3,'Cliente');

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `servicios` */

insert  into `servicios`(`id`,`nombre`) values (1,'CCTV.'),(2,'Alarmas'),(3,'Voceo'),(4,'Portones'),(5,'Monitoreo');

/*Table structure for table `serviciosfinalizados` */

DROP TABLE IF EXISTS `serviciosfinalizados`;

CREATE TABLE `serviciosfinalizados` (
  `id` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `istt` int(11) NOT NULL,
  `cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servicio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `nv` int(11) DEFAULT NULL,
  `oc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factura` int(11) DEFAULT NULL,
  `detalle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `iva_historico` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `serviciosfinalizados` */

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`usuario`,`password`,`nombre`,`email`,`roles_id`,`escribir`,`editar`,`eliminar`) values (1,'admin','827ccb0eea8a706c4c34a16891f84e7b','Matías Quezada','admin@mdsg.cl',1,1,1,1),(3,'prueba','827ccb0eea8a706c4c34a16891f84e7b','N/A','usuario@gmail.com',1,1,1,1),(4,'admin2','827ccb0eea8a706c4c34a16891f84e7b','MATIAS','el_mts@hotmail.com',3,1,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
