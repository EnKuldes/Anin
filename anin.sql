/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - anin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`anin` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `anin`;

/*Table structure for table `c_layanan` */

DROP TABLE IF EXISTS `c_layanan`;

CREATE TABLE `c_layanan` (
  `c_layanan` smallint(5) NOT NULL AUTO_INCREMENT,
  `layanan_desc` text DEFAULT NULL,
  `layanan_status` int(1) DEFAULT 1,
  `lup` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT 0,
  PRIMARY KEY (`c_layanan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `c_layanan` */

insert  into `c_layanan`(`c_layanan`,`layanan_desc`,`layanan_status`,`lup`,`created_by`) values 
(1,'Layanan 1',1,'2020-04-06 16:18:14',0);

/*Table structure for table `c_shift` */

DROP TABLE IF EXISTS `c_shift`;

CREATE TABLE `c_shift` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `shift` varchar(10) DEFAULT NULL,
  `shift_desc` text DEFAULT NULL,
  `login_time` time NOT NULL,
  `logout_time` time NOT NULL,
  `kategori_shift` int(1) DEFAULT NULL,
  `lup` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `UNIQUE` (`shift`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `c_shift` */

insert  into `c_shift`(`idx`,`shift`,`shift_desc`,`login_time`,`logout_time`,`kategori_shift`,`lup`,`created_by`) values 
(1,'A','Pagi 1','07:00:00','16:00:00',1,'2020-04-15 17:20:43',NULL),
(2,'B','Pagi 2','08:00:00','17:00:00',1,'2020-04-15 17:20:44',NULL),
(3,'D','Middle 1','10:00:00','19:00:00',1,'2020-04-15 17:20:45',NULL),
(4,'E','Middle 2','11:00:00','20:00:00',1,'2020-04-15 17:20:45',NULL),
(5,'G','Siang','13:00:00','22:00:00',1,'2020-04-15 17:20:46',NULL),
(6,'X','Libur','00:00:00','00:00:00',0,'2020-04-15 17:20:48',NULL),
(7,'CT','Cuti','00:00:00','00:00:00',0,'2020-04-15 17:20:49',NULL),
(8,'CDK','Cudak','00:00:00','00:00:00',2,'2020-04-17 18:46:22',NULL),
(9,'CML','Cuti Melahirkan','00:00:00','00:00:00',0,'2020-04-15 17:20:58',NULL),
(10,'CIK','Cuti Ijin Khusus','00:00:00','00:00:00',2,'2020-04-17 16:04:53',NULL),
(11,'AP','Alpa','00:00:00','00:00:00',2,'2020-04-15 17:21:00',NULL),
(12,'CTF','Sakit','00:00:00','00:00:00',2,'2020-04-15 17:21:02',NULL),
(13,'OP','Opname','00:00:00','00:00:00',2,'2020-04-15 17:21:07',NULL),
(14,'C','Pagi 3','09:00:00','18:00:00',1,'2020-04-15 17:21:08',NULL),
(15,'F','Middle 3','12:00:00','20:00:00',1,'2020-04-15 17:21:08',NULL),
(16,'H','Siang 2','14:00:00','23:00:00',1,'2020-04-15 17:21:10',NULL);

/*Table structure for table `ci_access` */

DROP TABLE IF EXISTS `ci_access`;

CREATE TABLE `ci_access` (
  `id_group` smallint(4) NOT NULL,
  `id_menu` smallint(4) NOT NULL,
  UNIQUE KEY `idx1` (`id_group`,`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ci_access` */

insert  into `ci_access`(`id_group`,`id_menu`) values 
(1,11),
(1,12),
(1,13),
(2,2),
(2,3),
(2,4),
(2,5),
(2,6),
(2,7),
(2,8),
(2,10);

/*Table structure for table `ci_group` */

DROP TABLE IF EXISTS `ci_group`;

CREATE TABLE `ci_group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name_group` varchar(30) NOT NULL,
  `desc_group` varchar(200) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `lup` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_group`),
  KEY `id_user` (`name_group`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

/*Data for the table `ci_group` */

insert  into `ci_group`(`id_group`,`name_group`,`desc_group`,`date_create`,`lup`) values 
(1,'Role 1','Role 1','2019-08-02 19:01:57','2019-08-02 19:01:57'),
(2,'Role 2','Role 2','2019-08-02 19:01:31','2019-08-02 19:01:31'),
(97,'Super User','Super User','2019-08-02 19:01:31','2019-08-02 19:01:44');

/*Table structure for table `ci_menu` */

DROP TABLE IF EXISTS `ci_menu`;

CREATE TABLE `ci_menu` (
  `menu_id` int(5) NOT NULL AUTO_INCREMENT,
  `menu_parent` int(5) DEFAULT NULL,
  `menu_name` varchar(50) DEFAULT NULL,
  `menu_icon` varchar(50) NOT NULL DEFAULT 'icon-puzzle4',
  `menu_link` varchar(100) NOT NULL DEFAULT '#',
  `menu_sort` int(5) NOT NULL DEFAULT 0,
  `menu_child` int(5) NOT NULL DEFAULT 0,
  `menu_status` enum('1','0') NOT NULL DEFAULT '1',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `ci_menu` */

insert  into `ci_menu`(`menu_id`,`menu_parent`,`menu_name`,`menu_icon`,`menu_link`,`menu_sort`,`menu_child`,`menu_status`,`last_update`) values 
(1,0,'Attendance','icon-puzzle4','Attendance',0,0,'1','2019-08-06 11:05:11'),
(2,0,'Admin','fas fa-user-astronaut','Admin',0,1,'1','2019-08-06 14:53:23'),
(3,2,'Upload Roster','icon-puzzle4','Admin/upload_roster',0,0,'1','2019-08-06 14:54:21'),
(4,5,'Tes','icon-puzzle4','#',1,0,'0','2019-08-08 12:44:34'),
(5,2,'Tes 01','icon-puzzle4','#',0,1,'0','2019-08-08 12:48:29'),
(6,2,'Dashboard','icon-puzzle4','Admin/dashboard',0,0,'1','2019-08-21 14:14:40'),
(7,2,'Management','icon-puzzle4','#',0,1,'0','2019-08-21 14:31:52'),
(8,7,'Users','icon-puzzle4','Admin/users',0,0,'1','2019-08-21 14:32:10'),
(9,0,'Menu','icon-puzzle4','#',0,0,'1','2019-08-21 14:32:22'),
(10,2,'Report','icon-puzzle4','Admin/report',2,0,'1','2020-04-03 16:36:41'),
(11,0,'Agent','icon-puzzle4','Agent',0,1,'1','2020-04-07 21:10:27'),
(12,11,'Dashboard','icon-puzzle4','Agent/dashboard',0,0,'1','2020-04-07 21:10:40'),
(13,11,'Request','icon-puzzle4','Agent/request',1,0,'1','2020-04-07 21:10:55');

/*Table structure for table `ci_user` */

DROP TABLE IF EXISTS `ci_user`;

CREATE TABLE `ci_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Index',
  `user_name` varchar(125) NOT NULL COMMENT 'Username',
  `no_perner` varchar(125) NOT NULL,
  `user_login` varchar(30) NOT NULL COMMENT 'Login',
  `user_password` varchar(150) NOT NULL COMMENT 'Password',
  `user_group` tinyint(3) DEFAULT NULL COMMENT 'User sebagai ..',
  `user_avatar` varchar(125) DEFAULT NULL,
  `layanan_id` tinyint(3) DEFAULT NULL COMMENT 'Layanan User',
  `sub_layanan` varchar(191) DEFAULT NULL,
  `user_jobdesk` varchar(125) DEFAULT NULL COMMENT 'User Jobdesk',
  `user_status` tinyint(1) NOT NULL COMMENT 'Aktif/Nonaktif',
  `tanggal_awal_bergabung` date DEFAULT NULL,
  `jenis_kelamin` varchar(191) DEFAULT NULL,
  `tempat_lahir` varchar(191) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(191) DEFAULT NULL,
  `status_pernikahan` varchar(191) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `telp` varchar(191) DEFAULT NULL,
  `no_ktp` varchar(191) DEFAULT NULL,
  `level_pendidikan` varchar(191) DEFAULT NULL,
  `jurusan` varchar(191) DEFAULT NULL,
  `nama_sekolah` varchar(191) DEFAULT NULL,
  `no_bpjs_ketenagakerjaan` varchar(191) DEFAULT NULL,
  `no_bpjs_kesehatan` varchar(191) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `lup` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UNIQUE` (`no_perner`,`user_name`,`user_login`)
) ENGINE=InnoDB AUTO_INCREMENT=1043 DEFAULT CHARSET=latin1;

/*Data for the table `ci_user` */

insert  into `ci_user`(`user_id`,`user_name`,`no_perner`,`user_login`,`user_password`,`user_group`,`user_avatar`,`layanan_id`,`sub_layanan`,`user_jobdesk`,`user_status`,`tanggal_awal_bergabung`,`jenis_kelamin`,`tempat_lahir`,`tanggal_lahir`,`agama`,`status_pernikahan`,`alamat_lengkap`,`telp`,`no_ktp`,`level_pendidikan`,`jurusan`,`nama_sekolah`,`no_bpjs_ketenagakerjaan`,`no_bpjs_kesehatan`,`created_by`,`lup`) values 
(582,'user 1','131807','131807','936d3a897a1258adaff8fd49d73ac1b3c6f09055',1,'user-3',1,'xxx','xxx',1,'2019-01-21','xxx','xxx','1996-01-25','xxx','xxx','Pxxx','08111111111','xxx','xxx','xxx','xxx','xxx','xxx',NULL,'2020-04-06 16:28:31'),
(1024,'Admin','admin','admin','d033e22ae348aeb5660fc2140aec35850c4da997',2,'user-4',0,NULL,'',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-04-06 16:35:07'),
(1028,'nps','nps','nps','10ac2f5e9ec5a6bb177eecaa0134377c13e8b470',2,'user-4',1,'xxx','Admin',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-04-30 13:41:01'),
;

/*Table structure for table `p_message` */

DROP TABLE IF EXISTS `p_message`;

CREATE TABLE `p_message` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `arrival_status` int(10) NOT NULL,
  `arrival_idx` int(10) NOT NULL,
  `c_message` text DEFAULT NULL,
  `image_icon` varchar(100) DEFAULT NULL,
  `lup` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `p_message` */

insert  into `p_message`(`idx`,`arrival_status`,`arrival_idx`,`c_message`,`image_icon`,`lup`,`created_by`) values 
(1,1,1,'Wow, kamu datang lebih awal hari ini &#128525 Happy Working &#128521','assets/images/p_message/early_1.gif','2020-04-13 12:07:02',NULL),
(2,1,2,'Selamat datang! Kamu datang tepat waktu hari ini &#128516 Happy Working &#128521','assets/images/p_message/ontime_1.gif','2020-04-13 12:07:20',NULL),
(3,1,3,'Kamu TERLAMBAT! &#128530','assets/images/p_message/late_1.gif','2020-04-13 12:07:29',NULL),
(4,0,1,'Kamu pulang lebih awal &#128528 Hati hati dijalan ya &#128521','assets/images/p_message/early_0.gif','2020-04-13 12:08:25',NULL),
(5,0,2,'Kamu pulang tepat waktu &#128516 Hati hati dijalan ya &#128521','assets/images/p_message/ontime_0.gif','2020-04-13 12:08:20',NULL),
(6,0,3,'Wow, kamu pulang telat &#128564  Hati hati di jalan dan selamat beristirahat &#128521','assets/images/p_message/late_0.gif','2020-04-13 12:09:12',NULL);

/*Table structure for table `tb_rooster` */

DROP TABLE IF EXISTS `tb_rooster`;

CREATE TABLE `tb_rooster` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `no_perner` varchar(125) NOT NULL,
  `rooster_date` date NOT NULL,
  `id_shift` int(10) NOT NULL COMMENT 'Idx C_Shift',
  `logon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logoff` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `log_status` int(10) DEFAULT 0,
  `status_absensi` int(10) DEFAULT NULL COMMENT 'status akhir absensi',
  `lup` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idx`),
  UNIQUE KEY `UNIQUE` (`no_perner`,`rooster_date`)
) ENGINE=InnoDB AUTO_INCREMENT=22455 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
