/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.10-MariaDB : Database - db_produto
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_produto` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

/*Table structure for table `tbl_galeria_veiculo` */

DROP TABLE IF EXISTS `tbl_galeria_veiculo`;

CREATE TABLE `tbl_galeria_veiculo` (
  `cod_foto` int(40) NOT NULL AUTO_INCREMENT,
  `nome_foto` varchar(255) DEFAULT NULL,
  `cod_veiculo` int(40) DEFAULT NULL,
  `situacao` int(11) NOT NULL,
  `capa` enum('0','1') DEFAULT '0' NOT NULL
  PRIMARY KEY (`cod_foto`)
) ENGINE=InnoDB AUTO_INCREMENT=411 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_galeria_veiculo` */

insert  into `tbl_galeria_veiculo`(`cod_foto`,`nome_foto`,`cod_veiculo`,`situacao`) values (282,'28fb797d4a3e98de37e819e91f740b62-06-08-2020.jpg',102,0);
insert  into `tbl_galeria_veiculo`(`cod_foto`,`nome_foto`,`cod_veiculo`,`situacao`) values (283,'315816421eb8c778f5a3a89bea7eb649-06-08-2020.jpg',102,0);
insert  into `tbl_galeria_veiculo`(`cod_foto`,`nome_foto`,`cod_veiculo`,`situacao`) values (284,'0d5b1c4c7f720f698946c7f6ab08f687-06-08-2020.jpg',102,0);
insert  into `tbl_galeria_veiculo`(`cod_foto`,`nome_foto`,`cod_veiculo`,`situacao`) values (408,'644881f726ec69b59617b1f434082d79-06-08-2020.jpg',122,0);
insert  into `tbl_galeria_veiculo`(`cod_foto`,`nome_foto`,`cod_veiculo`,`situacao`) values (409,'d8e7daf6268f783f8e8b35b4b7809cb1-06-08-2020.jpg',122,0);

/*Table structure for table `tbl_veiculo` */

DROP TABLE IF EXISTS `tbl_veiculo`;

CREATE TABLE `tbl_veiculo` (
  `cod_veiculo` int(40) NOT NULL AUTO_INCREMENT,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_veiculo`),
  KEY `cod` (`cod_veiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_veiculo` */

insert  into `tbl_veiculo`(`cod_veiculo`,`marca`,`modelo`) values (102,'Ford','Ka');
insert  into `tbl_veiculo`(`cod_veiculo`,`marca`,`modelo`) values (122,'teste','teste');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
