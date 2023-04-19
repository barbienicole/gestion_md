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
  PRIMARY KEY (`id`),
  KEY `usuarios_id` (`usuarios_id`),
  KEY `clientes_id` (`clientes_id`),
  CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `cotizaciones_ibfk_2` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizaciones` */

insert  into `cotizaciones`(`id`,`codigo`,`fecha_creacion`,`titulo`,`descripcion`,`neto`,`iva`,`iva_historico`,`total`,`fecha_actualizacion`,`usuarios_id`,`clientes_id`,`neto_real`,`iva_real`,`total_real`,`cotizaciones_estado_id`,`fecha`) values (1,'1','2023-04-10 21:04:16','Cotización 1','Cotización 122',4500,855,0.19,5355,'2023-04-12 21:31:05',1,1,400,76,476,1,NULL),(2,'2','2023-04-10 21:12:47','Cotización 2','Cotización 2',600,114,0.19,714,'2023-04-11 23:57:21',1,1,0,0,0,1,NULL);

/*Table structure for table `cotizaciones_estado` */

DROP TABLE IF EXISTS `cotizaciones_estado`;

CREATE TABLE `cotizaciones_estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizaciones_estado` */

insert  into `cotizaciones_estado`(`id`,`nombre`) values (1,'Pendiente'),(2,'Aceptada'),(3,'Rechazada');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detalle_cotizacion` */

insert  into `detalle_cotizacion`(`id`,`cotizaciones_id`,`items_id`,`n_linea`,`cantidad`,`valor`) values (1,1,1,1,1,200),(2,1,2,2,1,300),(3,2,1,1,3,200),(4,1,3,3,4,1000);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detalle_cotizacion_real` */

insert  into `detalle_cotizacion_real`(`id`,`cotizaciones_id`,`items_id`,`n_linea`,`cantidad`,`valor`) values (1,1,1,1,1,100),(2,1,2,2,2,150);

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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `logs` */

insert  into `logs`(`id`,`accion`,`entidad`,`identificador`,`data`,`usuarios_id`,`fecha`) values (1,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-03-17 20:09:18'),(2,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"12345dasd\"}',3,'2023-03-17 20:10:38'),(3,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-03-17 20:12:15'),(4,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-06 17:25:27'),(5,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-06 17:25:33'),(6,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-06 17:54:02'),(7,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:29:24'),(8,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:29:28'),(9,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:29:33'),(10,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:49:31'),(11,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:49:53'),(12,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:52:19'),(13,'Login Incorrecto','usuarios',3,'{\"usuario\":\"admin\",\"password\":\"admin\"}',3,'2023-04-10 04:53:33'),(14,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:57:49'),(15,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:58:31'),(16,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:59:15'),(17,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 04:59:28'),(18,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:01:50'),(19,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:02:03'),(20,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:04:52'),(21,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:05:58'),(22,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:06:21'),(23,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:07:43'),(24,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:08:13'),(25,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:17:26'),(26,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:17:32'),(27,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:17:57'),(28,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:30:08'),(29,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:30:25'),(30,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:31:31'),(31,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:32:06'),(32,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:32:41'),(33,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:33:25'),(34,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:14'),(35,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:28'),(36,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:35'),(37,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:36'),(38,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:37'),(39,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:37'),(40,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:38'),(41,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:38'),(42,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:34:43'),(43,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:35:07'),(44,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:35:22'),(45,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:35:27'),(46,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:36:07'),(47,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:36:13'),(48,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:36:28'),(49,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:39:06'),(50,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:39:10'),(51,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:41:28'),(52,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:41:40'),(53,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 05:49:55'),(54,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 06:06:32'),(55,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"0\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 06:38:55'),(56,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 06:39:07'),(57,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 01:32:34'),(58,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 14:33:09'),(59,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 14:33:25'),(60,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-10 21:17:21'),(61,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-11 22:06:16'),(62,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 14:34:09'),(63,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 20:39:57'),(64,'Login Incorrecto','usuarios',3,'{\"usuario\":\"mobile@gmail.com\",\"password\":\"12345\"}',3,'2023-04-12 22:20:00'),(65,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 22:20:02'),(66,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 22:24:09'),(67,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 22:26:10'),(68,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-12 22:29:50'),(69,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-18 16:16:39'),(70,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-18 21:11:21'),(71,'Login Correcto','usuarios',1,'{\"usuario_id\":\"1\",\"usuario_usuario\":\"admin\",\"usuario_password_raw\":\"12345\",\"usuario_password\":\"827ccb0eea8a706c4c34a16891f84e7b\",\"usuario_nombre\":\"Mat\\u00edas Quezada\",\"usuario_email\":\"admin@mdsg.cl\",\"usuario_escribir\":\"1\",\"usuario_editar\":\"1\",\"usuario_eliminar\":\"1\",\"roles_id\":\"1\",\"roles_nombre\":\"Administrador\"}',1,'2023-04-19 18:42:47');

/*Table structure for table `materiales` */

DROP TABLE IF EXISTS `materiales`;

CREATE TABLE `materiales` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `codigo` int(9) NOT NULL,
  `nombre` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(9,0) DEFAULT NULL,
  `stockideal` int(100) NOT NULL,
  `stock` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `materiales` */

insert  into `materiales`(`id`,`codigo`,`nombre`,`modelo`,`valor`,`stockideal`,`stock`) values (1,1051197,'Adaptador Cámara Plug DC Macho','N/A',230,15,35),(2,950342,'Aslador de Paso Tipo Corcho ','N/A',100,20,58),(3,950338,'Aislador Intermedio Plano','N/A',30,20,113),(4,667001,'Antena Adicional Para Respaldo','N/A',30,3,4),(5,1056195,'Balum','N/A',30,15,12),(6,1442277,'Batería 12V 5A','N/A',10,5,5),(7,1442276,'Batería 12V 7A','N/A',10,5,11),(8,662104,'Bocina Parlante ','N/A',10,2,7),(9,643097,'Botón de Pánico Pulsador','N/A',10,5,3),(10,643099,'Botón Tamper Seco ','Larm SS-072Q',10,5,20),(11,849002,'Cable 2x20 Paralelo Blanco','N/A',10,100,400),(12,849009,'Cable 2x24 Paralelo Blanco','N/A',10,100,600),(13,849027,'Cable Adaptador Alcom Voz','N/A',10,1,1),(14,849023,'Cable Pin 4 Cobre','N/A',10,200,300),(15,849005,'Cable Pin 8','N/A',10,100,300),(16,849007,'Cable UTP','Cat.5e',10,610,1525),(17,849008,'Cable UTP','Cat.6e',10,305,610),(18,1053172,'Cámara Bullet ','HDCVI 2MG',10,7,5),(19,1053176,'Cámara Ip','Bullet 2MG',10,2,1),(20,1053188,'Cámara Ip Domo','Barifocal 2MG',10,1,2),(21,660031,'Central ','Lightsys Risco',10,2,5),(22,634127,'Comunicador ','TL2803 GE Dual',10,1,3),(23,634131,'Comunicador ','Universal 3G4000W',10,3,1),(24,1567231,'Condensador 25uF','N/A',10,1,1),(25,1432293,'Conector RJ45 ','Cat.5e',10,50,120),(26,639061,'Contacto Inalámbrico','DSC Neo PG9303 Blanco',10,2,2),(27,639060,'Contacto Inalámbrico','DSC Neo PG9303 Café',10,2,2),(28,1568220,'Control Remoto 2 Botones ','Centurión',10,5,1),(29,849035,'Cordón ','Cat.5e 1 mt',10,5,10),(30,849036,'Cordón ','Cat.5e 2 mt',10,5,3),(31,849025,'Cordón ','Cat.6e 2 mt',10,5,6),(32,637082,'Detector Infrarrojo','Bravo 360',10,2,11),(33,637079,'Detector Infrarrojo','LC-100',10,5,1),(34,637080,'Detector Infrarrojo','LC-104',10,2,5),(35,1051198,'Disco Duro','1 Tb',10,1,0),(36,1051199,'Disco Duro','2 Tb',10,1,1),(37,641071,'Expansor 8 zonas','Light Risco',10,1,1),(38,1567233,'Fotocelda','Desme BFT',10,2,0),(39,1463297,'Fuente de Poder','12VDC 4A',10,5,10),(40,1463294,'Fuente de Poder','14.4 Risco',10,2,1),(41,1463295,'Fuente de Poder','3A',10,5,1),(42,1463296,'Fuente de Poder','5A',10,5,6),(43,1464275,'Fuente de Poder','Switching 12VDC 2A',10,5,5),(44,1464276,'Fuente de Poder','Switching 12VDC 1A',10,3,3),(45,640115,'Gabinete Sirena ','15W',10,2,1),(46,640116,'Gabinete Sirena ','30W',10,2,3),(47,632153,'Inyector Poe','24V',10,3,3),(48,632159,'Inyector Poe','48V',10,3,3),(49,635093,'Magnético','Cortina Metálico',10,2,2),(50,1536211,'Magnético','Extrafuerte Café Tane',10,2,2),(51,635097,'Magnético','Inalámbrico con Interruptor',10,2,1),(52,635099,'Magnético','Inalámbrico DSC Neo PG9945',10,2,8),(53,1535208,'Magnético','Sobrepuesto Blanco',10,2,1),(54,1535207,'Magnético','Sobrepuesto Café',10,5,7),(55,1535206,'Magnético','Sobrepuesto Pill Cafe',10,2,16),(56,662105,'Mini Sirena ','N/A',10,2,1),(57,1568217,'Control Remoto','Mitto 2',10,10,13),(58,632160,'Módulo Audio ','Vox 100 Hangroy',10,3,7),(59,660036,'Módulo Central Alarma','2032',10,2,1),(60,632152,'Módulo Antena ','DSC Neo PCL-422',10,2,12),(61,641074,'Módulo Central Alarma','DSC Neo HSM2HOST9 Trans 915MHz',10,1,2),(62,641064,'Módulo Expansor 8 zonas ','HSM2108',10,2,9),(63,641080,'Módulo Expansor 8 zonas ','PC5108 Serie Power',10,2,4),(64,641075,'Módulo Ip','Msocket Risco',10,1,1),(65,660034,'Panel Alcom Voz','N/A',10,1,1),(66,632133,'Relé Simple Portón','12V 16A',10,5,6),(67,632134,'Relé Simple Alarma ','12V 7A',10,5,0),(68,639059,'Repetidor ','DSC Neo PG9920',10,1,2),(69,1458284,'Silicona','N/A',10,30,15),(70,662108,'Sirena ','20W',10,2,1),(71,662107,'Sirena ','30W',10,2,0),(72,632151,'Sirena Exterior Azul','N/A',10,2,3),(73,767354,'Soporte Muro PTZ','N/A',10,1,3),(74,767356,'Switch 4 Poe','N/A',10,3,17),(75,647061,'Teclado','DSC Neo Icono HS21CN',10,1,1),(76,1047162,'Teclado','DSC Icono',10,1,2),(77,647065,'Teclado','LCD Icono SDC PK5501',10,1,3),(78,647063,'Teclado','LCD Inalámbrico RKF',10,1,2),(79,1332328,'Transformador ','N/A',10,2,1),(80,632136,'UPS ','600VA',10,2,7),(81,632141,'Velcro','N/A',30,10,22),(82,1056196,'Video Balum','N/A',10,5,11),(83,632142,'UPS','1KVA',10,1,0);

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
