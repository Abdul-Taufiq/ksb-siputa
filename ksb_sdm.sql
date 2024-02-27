/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - ksb_sdm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ksb_sdm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `ksb_sdm`;

/*Table structure for table `cabang` */

DROP TABLE IF EXISTS `cabang`;

CREATE TABLE `cabang` (
  `id_cabang` int(10) NOT NULL AUTO_INCREMENT,
  `cabang` varchar(25) DEFAULT NULL,
  `nama_pincab` varchar(200) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_cabang`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `cabang` */

insert  into `cabang`(`id_cabang`,`cabang`,`nama_pincab`,`alamat`,`kode`) values 
(1,'KPO Parakan','Rakhma Fitrianto','Parakan','Kp.kpo'),
(2,'KC Temanggung','Sigid Setiyawan','Temanggung','Kc.tmg'),
(3,'KC Wonosobo','Sigit Widihandoyo','Wonosobo','Kc.wsb'),
(4,'KC Ambarawa','Septo Purbo Setyanto','Ambarawa','Kc.amb'),
(5,'KC Semarang','Hendy Hadyan','Semarang','Kc.smg'),
(6,'KC Mranggen','Dody Arif Kiswadi','Mranggen','Kc.mrg'),
(7,'KC Sukorejo','Hanry Dwi Purnomo','Sukorejo','Kc.skj'),
(8,'KC Weleri','Sigit Purnomo Adi','Weleri','Kc.wlr'),
(9,'KC Delanggu','Bagas Hanat','Delanggu','Kc.dlg'),
(10,'KC Gombong','Wicaksono','Gombong','Kc.gmb'),
(11,'KC Sokaraja','Indra Prihanton','Sokaraja','Kc.srj');

/*Table structure for table `log_activity` */

DROP TABLE IF EXISTS `log_activity`;

CREATE TABLE `log_activity` (
  `id_log` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `aksi` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=650 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `log_activity` */

insert  into `log_activity`(`id_log`,`id_cabang`,`nama`,`email`,`level`,`kode_form`,`aksi`,`created_at`,`updated_at`) values 
(490,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','Kp.kpo/Email-P/2024/0001','(+) Pengajuan Email','2024-01-19 15:34:14','2024-01-19 15:34:14'),
(491,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','Kp.kpo/SiAdit-P/2024/0001','(+) Pengajuan User SiAdit','2024-01-19 15:41:46','2024-01-19 15:41:46'),
(492,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','/Email-P/2024/0002','(+) Pengajuan Email','2024-01-19 15:49:29','2024-01-19 15:49:29'),
(493,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','/Email-P/2024/0003','(+) Pengajuan Email','2024-01-19 15:50:42','2024-01-19 15:50:42'),
(494,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','/Email-P/2024/0001','(+) Pengajuan Reset Password Email','2024-01-19 15:58:24','2024-01-19 15:58:24'),
(495,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','/Email-P/2024/0002','(+) Pengajuan Reset Password Email','2024-01-19 15:59:42','2024-01-19 15:59:42'),
(496,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','/Email-P/2024/0004','(+) Pengajuan Email','2024-01-19 16:01:45','2024-01-19 16:01:45'),
(497,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0003','(+) Pengajuan Reset Password Email','2024-01-19 16:05:16','2024-01-19 16:05:16'),
(498,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0004','(+) Pengajuan Reset Password Email','2024-01-19 16:07:54','2024-01-19 16:07:54'),
(499,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0005','(+) Pengajuan Reset Password Email','2024-01-19 16:08:08','2024-01-19 16:08:08'),
(500,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0006','(+) Pengajuan Reset Password Email','2024-01-19 17:21:39','2024-01-19 17:21:39'),
(501,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0005','(+) Pengajuan Email','2024-01-19 17:24:52','2024-01-19 17:24:52'),
(502,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0002','(+) Pengajuan User SiAdit','2024-01-19 17:26:04','2024-01-19 17:26:04'),
(503,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0003','(+) Pengajuan User SiAdit','2024-01-19 17:59:28','2024-01-19 17:59:28'),
(504,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0004','(+) Pengajuan User SiAdit','2024-01-19 18:01:07','2024-01-19 18:01:07'),
(505,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0006','(+) Pengajuan Email','2024-01-19 18:04:30','2024-01-19 18:04:30'),
(506,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0007','(+) Pengajuan Email','2024-01-19 18:23:16','2024-01-19 18:23:16'),
(507,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0008','(+) Pengajuan Email','2024-01-19 18:23:17','2024-01-19 18:23:17'),
(508,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0009','(+) Pengajuan Email','2024-01-19 18:24:09','2024-01-19 18:24:09'),
(509,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0010','(+) Pengajuan Email','2024-01-19 18:24:09','2024-01-19 18:24:09'),
(510,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0011','(+) Pengajuan Email','2024-01-19 18:25:17','2024-01-19 18:25:17'),
(511,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0012','(+) Pengajuan Email','2024-01-19 18:25:18','2024-01-19 18:25:18'),
(512,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0013','(+) Pengajuan Email','2024-01-19 18:30:53','2024-01-19 18:30:53'),
(513,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0005','(+) Pengajuan User SiAdit','2024-01-19 18:37:06','2024-01-19 18:37:06'),
(514,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0006','(+) Pengajuan User SiAdit','2024-01-19 18:44:41','2024-01-19 18:44:41'),
(515,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0007','(+) Pengajuan User SiAdit','2024-01-19 18:45:10','2024-01-19 18:45:10'),
(516,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0008','(+) Pengajuan User SiAdit','2024-01-19 18:45:32','2024-01-19 18:45:32'),
(517,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0004','(u) Pengajuan User SiAdit','2024-01-19 19:38:52','2024-01-19 19:38:52'),
(518,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0005','(u) Pengajuan User SiAdit','2024-01-20 16:22:19','2024-01-20 16:22:19'),
(519,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0009','(+) Pengajuan User SiAdit','2024-01-22 08:19:31','2024-01-22 08:19:31'),
(520,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-P/2024/0010','(+) Pengajuan User SiAdit','2024-01-22 08:19:39','2024-01-22 08:19:39'),
(521,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-R/2024/0001','(+) Pengajuan User SiAdit','2024-01-22 13:48:53','2024-01-22 13:48:53'),
(522,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-R/2024/0002','(+) Pengajuan User SiAdit','2024-01-22 13:50:30','2024-01-22 13:50:30'),
(523,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-R/2024/0003','(+) Pengajuan Perubahan SiAdit','2024-01-22 14:34:14','2024-01-22 14:34:14'),
(524,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-R/2024/0001','(+) Update Perubahan SiAdit','2024-01-22 14:39:58','2024-01-22 14:39:58'),
(525,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/SiAdit-R/2024/0001','(+) Update Perubahan SiAdit','2024-01-22 14:41:36','2024-01-22 14:41:36'),
(526,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/Email-P/2024/0014','(+) Pengajuan Email','2024-01-22 16:56:37','2024-01-22 16:56:37'),
(527,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-P/2024/0002','(+) Pengajuan User MSO','2024-01-22 17:12:06','2024-01-22 17:12:06'),
(528,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-P/2024/0003','(+) Pengajuan User MSO','2024-01-22 17:21:15','2024-01-22 17:21:15'),
(529,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-P/2024/0004','(+) Pengajuan User MSO','2024-01-22 17:21:18','2024-01-22 17:21:18'),
(530,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-P/2024/0005','(+) Pengajuan User MSO','2024-01-22 17:21:20','2024-01-22 17:21:20'),
(531,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-P/2024/0006','(+) Pengajuan User MSO','2024-01-22 17:21:22','2024-01-22 17:21:22'),
(532,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-P/2024/0007','(+) Pengajuan User MSO','2024-01-22 17:21:24','2024-01-22 17:21:24'),
(533,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-P/2024/0008','(+) Pengajuan User MSO','2024-01-22 17:21:34','2024-01-22 17:21:34'),
(534,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-P/2024/0008','(+) Pengajuan User MSO','2024-01-23 08:39:49','2024-01-23 08:39:49'),
(535,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-R/2024/0007','(+) Reset Password MSO','2024-01-24 15:04:05','2024-01-24 15:04:05'),
(536,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-R/2024/0007','(+) Reset Password MSO','2024-01-24 15:30:43','2024-01-24 15:30:43'),
(537,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MbsUs-R/2024/0007','(+) Reset Password MSO','2024-01-24 15:32:11','2024-01-24 15:32:11'),
(538,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/MBSUS-P/2024/0009','(+) Pengajuan User MSO','2024-01-25 08:27:12','2024-01-25 08:27:12'),
(539,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-P/2024/0005','(+) Pengajuan User Ecoll','2024-01-25 09:14:07','2024-01-25 09:14:07'),
(540,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-P/2024/0005','(+) Pengajuan User Ecoll','2024-01-25 15:31:23','2024-01-25 15:31:23'),
(541,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-R/2024/0001','(+) Pengajuan User Ecoll','2024-01-25 15:43:20','2024-01-25 15:43:20'),
(542,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-R/2024/0002','(+) Pengajuan User Ecoll','2024-01-25 15:43:37','2024-01-25 15:43:37'),
(543,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-R/2024/0003','(+) Pengajuan User Ecoll','2024-01-25 15:43:41','2024-01-25 15:43:41'),
(544,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-R/2024/0004','(+) Pengajuan User Ecoll','2024-01-25 15:44:10','2024-01-25 15:44:10'),
(545,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-R/2024/0005','(+) Pengajuan User Ecoll','2024-01-25 15:44:14','2024-01-25 15:44:14'),
(546,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-R/2024/0006','(+) Pengajuan User Ecoll','2024-01-25 15:44:24','2024-01-25 15:44:24'),
(547,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-R/2024/0006','(+) Pengajuan User Ecoll','2024-01-25 15:51:08','2024-01-25 15:51:08'),
(548,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/ECOLL-R/2024/0007','(+) Pengajuan User Ecoll','2024-01-25 15:53:18','2024-01-25 15:53:18'),
(549,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-AKS/2024/0005','(+) Pengajuan Perubahan SiAdit','2024-01-26 11:13:42','2024-01-26 11:13:42'),
(550,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-AKS/2024/0005','(u) Edit Pengajuan Perubahan SiAdit','2024-01-26 14:00:57','2024-01-26 14:00:57'),
(551,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-AKS/2024/0006','(+) Pengajuan Pembatalan Transaksi Akuntansi','2024-01-26 15:16:31','2024-01-26 15:16:31'),
(552,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-BNK/2024/0004','(+) Pengajuan Pembatalan Transaksi ABA','2024-01-26 15:19:25','2024-01-26 15:19:25'),
(553,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-BNK/2024/0004','(u) Update Pembatalan Transaksi ABA','2024-01-26 15:47:23','2024-01-26 15:47:23'),
(554,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-KNR/2024/0005','(+) Pengajuan Pembatalan Transaksi AKA','2024-01-26 16:59:56','2024-01-26 16:59:56'),
(555,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-KNR/2024/0005','(u) Edit Pengajuan Pembatalan Transaksi AKA','2024-01-26 17:06:23','2024-01-26 17:06:23'),
(556,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-AKA/2024/0006','(+) Pengajuan Pembatalan Transaksi AKA','2024-01-26 17:16:20','2024-01-26 17:16:20'),
(557,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-AKA/2024/0006','(u) Edit Pengajuan Pembatalan Transaksi AKA','2024-01-26 17:16:31','2024-01-26 17:16:31'),
(558,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-AKA/2024/0007','(+) Pengajuan Pembatalan Transaksi AKA','2024-01-26 17:17:45','2024-01-26 17:17:45'),
(559,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-AKA/2024/0007','(u) Edit Pengajuan Pembatalan Transaksi AKA','2024-01-26 17:18:07','2024-01-26 17:18:07'),
(560,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-AKA/2024/0007','(u) Edit Pengajuan Pembatalan Transaksi AKA','2024-01-29 10:19:38','2024-01-29 10:19:38'),
(561,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-DPS/2024/0001','(+) Pengajuan Pembatalan Transaksi DPS','2024-01-29 11:05:14','2024-01-29 11:05:14'),
(562,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-DPS/2024/0002','(+) Pengajuan Pembatalan Transaksi DPS','2024-01-29 11:05:18','2024-01-29 11:05:18'),
(563,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-DPS/2024/0003','(+) Pengajuan Pembatalan Transaksi DPS','2024-01-29 11:05:29','2024-01-29 11:05:29'),
(564,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-DPS/2024/0003','(u) Update Pembatalan Transaksi DPS','2024-01-29 11:21:05','2024-01-29 11:21:05'),
(565,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-DPS/2024/0002','(u) Update Pembatalan Transaksi DPS','2024-01-29 11:21:25','2024-01-29 11:21:25'),
(566,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-DPS/2024/0001','(u) Update Pembatalan Transaksi DPS','2024-01-29 11:22:06','2024-01-29 11:22:06'),
(567,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-DPS/2024/0003','(u) Update Pembatalan Transaksi DPS','2024-01-29 11:26:49','2024-01-29 11:26:49'),
(568,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-DPS/2024/0001','(u) Update Pembatalan Transaksi DPS','2024-01-29 11:33:44','2024-01-29 11:33:44'),
(569,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-ECL/2024/0001','(+) Pengajuan Pembatalan Transaksi E-Collector','2024-01-29 11:57:48','2024-01-29 11:57:48'),
(570,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-ECL/2024/0002','(+) Pengajuan Pembatalan Transaksi E-Collector','2024-01-29 11:58:03','2024-01-29 11:58:03'),
(571,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-ECL/2024/0003','(+) Pengajuan Pembatalan Transaksi E-Collector','2024-01-29 11:58:32','2024-01-29 11:58:32'),
(572,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-ECL/2024/0003','(u) Update Pembatalan Transaksi E-Collector','2024-01-29 13:31:47','2024-01-29 13:31:47'),
(573,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-ECL/2024/0003','(u) Update Pembatalan Transaksi E-Collector','2024-01-29 13:32:38','2024-01-29 13:32:38'),
(574,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-ECL/2024/0003','(u) Update Pembatalan Transaksi E-Collector','2024-01-29 13:32:53','2024-01-29 13:32:53'),
(575,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-ECL/2024/0003','(u) Update Pembatalan Transaksi E-Collector','2024-01-29 13:33:05','2024-01-29 13:33:05'),
(576,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-INV/2024/0005','(+) Pengajuan Pembatalan Transaksi DPS','2024-01-29 14:23:36','2024-01-29 14:23:36'),
(577,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-INV/2024/0005','(u) Update Pembatalan Transaksi INV','2024-01-29 14:29:16','2024-01-29 14:29:16'),
(578,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-KRD/2024/0001','(+) Pengajuan Pembatalan Transaksi KRD','2024-01-29 15:48:23','2024-01-29 15:48:23'),
(579,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-KRD/2024/0002','(+) Pengajuan Pembatalan Transaksi KRD','2024-01-29 15:49:03','2024-01-29 15:49:03'),
(580,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-KRD/2024/0003','(+) Pengajuan Pembatalan Transaksi KRD','2024-01-29 15:49:45','2024-01-29 15:49:45'),
(581,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-KRD/2024/0003','(u) Update Pembatalan Transaksi KRD','2024-01-29 16:53:24','2024-01-29 16:53:24'),
(582,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-KRD/2024/0002','(u) Update Pembatalan Transaksi KRD','2024-01-29 16:54:32','2024-01-29 16:54:32'),
(583,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-KRD/2024/0001','(u) Update Pembatalan Transaksi KRD','2024-01-29 16:55:20','2024-01-29 16:55:20'),
(584,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-KRD/2024/0003','(u) Update Pembatalan Transaksi KRD','2024-01-29 16:55:55','2024-01-29 16:55:55'),
(585,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-TBG/2024/0004','(+) Pengajuan Pembatalan Transaksi TBG','2024-01-30 10:35:29','2024-01-30 10:35:29'),
(586,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-TBG/2024/0004','(u) Update Pembatalan Transaksi TBG','2024-01-30 11:03:59','2024-01-30 11:03:59'),
(587,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/BTT-CIF/2024/0001','(+) Pengajuan Perubahan Transaksi CIF','2024-01-30 16:57:12','2024-01-30 16:57:12'),
(588,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-CIF/2024/0002','(+) Pengajuan Perubahan Transaksi CIF','2024-01-30 17:00:22','2024-01-30 17:00:22'),
(589,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-CIF/2024/0003','(+) Pengajuan Perubahan Transaksi CIF','2024-01-30 17:01:29','2024-01-30 17:01:29'),
(590,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-CIF/2024/0004','(+) Pengajuan Perubahan Transaksi CIF','2024-01-30 17:01:57','2024-01-30 17:01:57'),
(591,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-CIF/2024/0005','(+) Pengajuan Perubahan Transaksi CIF','2024-01-30 17:02:27','2024-01-30 17:02:27'),
(592,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-CIF/2024/0005','(+) Update Perubahan Transaksi CIF','2024-01-31 09:39:08','2024-01-31 09:39:08'),
(593,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-CIF/2024/0005','(+) Update Perubahan Transaksi CIF','2024-01-31 09:39:24','2024-01-31 09:39:24'),
(594,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-CIF/2024/0005','(+) Update Perubahan Transaksi CIF','2024-01-31 09:40:07','2024-01-31 09:40:07'),
(595,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-CIF/2024/0005','(+) Update Perubahan Transaksi CIF','2024-01-31 09:41:40','2024-01-31 09:41:40'),
(596,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-CIF/2024/0004','(+) Update Perubahan Transaksi CIF','2024-01-31 09:42:49','2024-01-31 09:42:49'),
(597,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-KRD/2024/0001','(+) Pengajuan Perubahan Transaksi KRD','2024-01-31 11:54:13','2024-01-31 11:54:13'),
(598,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-KRD/2024/0002','(+) Pengajuan Perubahan Transaksi KRD','2024-01-31 13:50:53','2024-01-31 13:50:53'),
(599,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-KRD/2024/0003','(+) Pengajuan Perubahan Transaksi KRD','2024-01-31 13:52:11','2024-01-31 13:52:11'),
(600,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-KRD/2024/0003','(U) Update Perubahan Transaksi KRD','2024-01-31 14:02:40','2024-01-31 14:02:40'),
(601,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-KRD/2024/0003','(U) Update Perubahan Transaksi KRD','2024-01-31 14:08:43','2024-01-31 14:08:43'),
(602,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-DPS/2024/0003','(+) Pengajuan Perubahan Transaksi DPS','2024-01-31 15:56:12','2024-01-31 15:56:12'),
(603,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-DPS/2024/0004','(+) Pengajuan Perubahan Transaksi DPS','2024-01-31 16:45:13','2024-01-31 16:45:13'),
(604,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-DPS/2024/0005','(+) Pengajuan Perubahan Transaksi DPS','2024-01-31 16:47:06','2024-01-31 16:47:06'),
(605,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-DPS/2024/0005','(u) Update Perubahan Transaksi DPS','2024-01-31 16:49:08','2024-01-31 16:49:08'),
(606,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-KRD/2024/0002','(u) Update Perubahan Transaksi KRD','2024-01-31 17:23:04','2024-01-31 17:23:04'),
(607,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PRT-DPS/2024/0005','(u) Update Perubahan Transaksi DPS','2024-01-31 17:59:09','2024-01-31 17:59:09'),
(608,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/USLIK-P/2024/0005','(+) Pengajuan User SLIK','2024-01-31 19:30:38','2024-01-31 19:30:38'),
(609,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/USLIK-P/2024/0005','(u) Update Pengajuan User SLIK','2024-01-31 19:34:47','2024-01-31 19:34:47'),
(610,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PFNDO-P/2024/0004','(+) Pengajuan User PFNDO','2024-01-31 19:57:45','2024-01-31 19:57:45'),
(611,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PFNDO-P/2024/0004','(u) Update Pengajuan User PFNDO','2024-01-31 20:01:28','2024-01-31 20:01:28'),
(612,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PFNDO-P/2024/0005','(+) Pengajuan User PFNDO','2024-02-01 09:20:52','2024-02-01 09:20:52'),
(613,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PFNDO-R/2024/0005','(+) Pengajuan Reset Password User PFNDO','2024-02-01 09:29:26','2024-02-01 09:29:26'),
(614,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/PFNDO-R/2024/0005','(u) Update Pengajuan Reset Password PFNDO','2024-02-01 09:29:42','2024-02-01 09:29:42'),
(615,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0015','(+) Pengajuan Email','2024-02-05 10:37:07','2024-02-05 10:37:07'),
(616,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0016','(+) Pengajuan Email','2024-02-05 10:39:28','2024-02-05 10:39:28'),
(617,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0017','(+) Pengajuan Email','2024-02-05 10:44:28','2024-02-05 10:44:28'),
(618,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0018','(+) Pengajuan Email','2024-02-05 10:49:55','2024-02-05 10:49:55'),
(619,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0019','(+) Pengajuan Email','2024-02-05 10:58:20','2024-02-05 10:58:20'),
(620,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0020','(+) Pengajuan Email','2024-02-05 10:59:26','2024-02-05 10:59:26'),
(621,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0021','(+) Pengajuan Email','2024-02-05 11:00:44','2024-02-05 11:00:44'),
(622,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0022','(+) Pengajuan Email','2024-02-05 11:02:23','2024-02-05 11:02:23'),
(623,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0023','(+) Pengajuan Email','2024-02-05 11:04:51','2024-02-05 11:04:51'),
(624,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0024','(+) Pengajuan Email','2024-02-05 11:05:35','2024-02-05 11:05:35'),
(625,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0025','(+) Pengajuan Email','2024-02-05 11:06:56','2024-02-05 11:06:56'),
(626,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0026','(+) Pengajuan Email','2024-02-05 11:07:27','2024-02-05 11:07:27'),
(627,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/EMAIL-P/2024/0024','(cs) Approve Pengajuan Email','2024-02-05 14:26:42','2024-02-05 14:26:42'),
(628,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/EMAIL-P/2024/0023','(cs) Rejected Pengajuan Email','2024-02-05 15:08:47','2024-02-05 15:08:47'),
(629,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/EMAIL-P/2024/0022','(cs) Rejected Pengajuan Email','2024-02-05 15:10:10','2024-02-05 15:10:10'),
(630,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/EMAIL-P/2024/0021','(cs) Rejected Pengajuan Email','2024-02-05 15:18:13','2024-02-05 15:18:13'),
(631,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0027','(+) Pengajuan Email','2024-02-06 15:33:13','2024-02-06 15:33:13'),
(632,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0028','(+) Pengajuan Email','2024-02-06 15:34:01','2024-02-06 15:34:01'),
(633,1,'Dummy Kasi Operasional','dummy.kaops@gmail.com','Kasi Operasional','KP.KPO/EMAIL-P/2024/0029','(+) Pengajuan Email','2024-02-06 15:34:20','2024-02-06 15:34:20'),
(634,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/EMAIL-P/2024/0030','(+) Pengajuan Email','2024-02-07 11:36:17','2024-02-07 11:36:17'),
(635,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/EMAIL-P/2024/0030','(cs) Rejected Pengajuan Email','2024-02-07 15:04:00','2024-02-07 15:04:00'),
(636,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/EMAIL-P/2024/0029','(cs) Approve Pengajuan Email','2024-02-07 15:20:49','2024-02-07 15:20:49'),
(637,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/Email-P/2024/0006','(cs) Approve Pengajuan Email','2024-02-07 16:18:28','2024-02-07 16:18:28'),
(638,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/Email-P/2024/0005','(cs) Approve Pengajuan Email','2024-02-07 16:23:19','2024-02-07 16:23:19'),
(639,1,'Dummy Pimpinan Cabang','dummy.pincab@gmail.com','Pimpinan Cabang','KP.KPO/Email-P/2024/0004','(cs) Rejected Pengajuan Email','2024-02-07 16:23:28','2024-02-07 16:23:28'),
(640,0,'Dummy SDM','dummy.sdm@gmail.com','SDM','KP.KPO/EMAIL-P/2024/0029','(cs) Approve Pengajuan Email','2024-02-07 16:29:52','2024-02-07 16:29:52'),
(641,0,'Dummy SDM','dummy.sdm@gmail.com','SDM','KP.KPO/EMAIL-P/2024/0026','(cs) Approve Pengajuan Email','2024-02-07 16:31:18','2024-02-07 16:31:18'),
(642,0,'Dummy SDM','dummy.sdm@gmail.com','SDM','KP.KPO/EMAIL-P/2024/0025','(cs) Rejected Pengajuan Email','2024-02-07 16:32:17','2024-02-07 16:32:17'),
(643,0,'Dummy SDM','dummy.sdm@gmail.com','SDM','KP.KPO/EMAIL-P/2024/0024','(cs) Approve Pengajuan Email','2024-02-07 16:36:34','2024-02-07 16:36:34'),
(644,0,'Dummy Direktur Operasional','dummy.dir@gmail.com','Direktur Operasional','KP.KPO/EMAIL-P/2024/0029','(cs) Approve Pengajuan Email','2024-02-07 16:42:41','2024-02-07 16:42:41'),
(645,0,'Dummy Direktur Operasional','dummy.dir@gmail.com','Direktur Operasional','KP.KPO/EMAIL-P/2024/0026','(cs) Approve Pengajuan Email','2024-02-07 16:43:29','2024-02-07 16:43:29'),
(646,0,'Dummy Direktur Operasional','dummy.dir@gmail.com','Direktur Operasional','KP.KPO/EMAIL-P/2024/0024','(cs) Rejected Pengajuan Email','2024-02-07 16:43:45','2024-02-07 16:43:45'),
(647,0,'Dummy TSI','dummy.tsi@gmail.com','TSI','KP.KPO/EMAIL-P/2024/0029','(cs) Approve Pengajuan Email','2024-02-07 16:44:55','2024-02-07 16:44:55'),
(648,0,'Dummy TSI','dummy.tsi@gmail.com','TSI','KP.KPO/EMAIL-P/2024/0029','(cs) Approve Pengajuan Email','2024-02-07 16:52:44','2024-02-07 16:52:44'),
(649,0,'Dummy TSI','dummy.tsi@gmail.com','TSI','KP.KPO/EMAIL-P/2024/0026','(cs) Rejected Pengajuan Email','2024-02-07 16:56:16','2024-02-07 16:56:16');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_access_tokens` */

DROP TABLE IF EXISTS `permission_access_tokens`;

CREATE TABLE `permission_access_tokens` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) DEFAULT NULL,
  `tokenable_id` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `abilities` varchar(10) DEFAULT NULL,
  `last_used_at` datetime DEFAULT NULL,
  `now` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('is_active','is_deactive') DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `permission_access_tokens` */

insert  into `permission_access_tokens`(`id`,`tokenable_type`,`tokenable_id`,`name`,`token`,`abilities`,`last_used_at`,`now`,`date`,`status`,`updated_at`) values 
(1,'b24176d34261f3e5cd8b3b78bc90072b','28c8edde3d61a0411511','ksb','6999195147dd30ecccc814cc45890bf90c908a3c4ab1d5adfb5891ec7f80ff34','yes','2023-11-13 16:07:11','2024-02-12','2024-04-01','is_active','2024-02-12 08:21:37');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `tb_bantuan_tsi` */

DROP TABLE IF EXISTS `tb_bantuan_tsi`;

CREATE TABLE `tb_bantuan_tsi` (
  `id_bantuan` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `no_inventaris` varchar(100) DEFAULT NULL,
  `jns_kerusakan` varchar(50) DEFAULT NULL,
  `detail_kerusakan` varchar(250) DEFAULT NULL,
  `gambar` varchar(250) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tgl_status` datetime DEFAULT NULL,
  `pegawai` varchar(50) DEFAULT NULL,
  `catatan` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_bantuan`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_bantuan_tsi_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_bantuan_tsi` */

/*Table structure for table `tb_ecoll_p` */

DROP TABLE IF EXISTS `tb_ecoll_p`;

CREATE TABLE `tb_ecoll_p` (
  `id_ecoll_p` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `no_kode` varchar(50) DEFAULT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `aktif` date DEFAULT NULL,
  `non_aktif` date DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_sdm` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `status_pincab` varchar(20) DEFAULT NULL,
  `status_sdm` varchar(20) DEFAULT NULL,
  `status_dirops` varchar(20) DEFAULT NULL,
  `status_tsi` varchar(20) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `catatan_sdm` varchar(250) DEFAULT NULL,
  `catatan_dirops` varchar(250) DEFAULT NULL,
  `catatan_tsi` varchar(250) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `kabid` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ecoll_p`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_ecoll_p` */

insert  into `tb_ecoll_p`(`id_ecoll_p`,`id_cabang`,`kode_form`,`no_kode`,`keperluan`,`nik`,`nama`,`jabatan`,`user`,`no_telp`,`keterangan`,`aktif`,`non_aktif`,`nama_pincab`,`nama_sdm`,`nama_dirops`,`nama_tsi`,`status_pincab`,`status_sdm`,`status_dirops`,`status_tsi`,`status_akhir`,`tgl_status_pincab`,`tgl_status_dirops`,`tgl_status_sdm`,`tgl_status_tsi`,`tgl_status_akhir`,`catatan_sdm`,`catatan_dirops`,`catatan_tsi`,`izin_edit`,`kabid`,`created_at`,`updated_at`) values 
(19,1,'KP.KPO/ECOLL-P/2024/0001',NULL,'Permohonan User Baru','2458121','Taufiq','Kasi Operasional',NULL,'6282182100051','pengganti',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 09:11:51','2024-01-25 09:11:51'),
(20,1,'KP.KPO/ECOLL-P/2024/0002',NULL,'Permohonan User Baru','2458121','Taufiq','Kasi Operasional',NULL,'6282182100051','pengganti',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 09:12:41','2024-01-25 09:12:41'),
(21,1,'KP.KPO/ECOLL-P/2024/0003',NULL,'Permohonan User Baru','2458121','Taufiq','Kasi Operasional',NULL,'6282182100051','pengganti',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 09:12:43','2024-01-25 09:12:43'),
(22,1,'KP.KPO/ECOLL-P/2024/0004',NULL,'Permohonan User Baru','2458121','Taufiq','Kasi Operasional',NULL,'6282182100051','pengganti',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 09:12:51','2024-01-25 09:12:51'),
(23,1,'KP.KPO/ECOLL-P/2024/0005',NULL,'Permohonan User Baru','245812100','Taufiq120','Kasi Operasional0',NULL,'62821821000510','pengganti0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 15:31:23','2024-01-25 15:31:23');

/*Table structure for table `tb_ecoll_r` */

DROP TABLE IF EXISTS `tb_ecoll_r`;

CREATE TABLE `tb_ecoll_r` (
  `id_ecoll_r` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nik` varchar(10) DEFAULT NULL,
  `user` varchar(200) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keperluan` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `tempat` varchar(50) DEFAULT NULL,
  `nama_pincab` varchar(200) DEFAULT NULL,
  `nama_sdm` varchar(50) DEFAULT NULL,
  `nama_tsi` varchar(200) DEFAULT NULL,
  `nama_dirops` varchar(100) DEFAULT NULL,
  `status_pincab` enum('Approve','Reject','--') DEFAULT NULL,
  `status_sdm` enum('Approve','Reject') DEFAULT NULL,
  `status_dirops` enum('Approve','Reject') DEFAULT NULL,
  `status_tsi` enum('Approve','Reject') DEFAULT NULL,
  `status_akhir` enum('Selesai','Proses','Ditolak') DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `catatan_dirops` varchar(300) DEFAULT NULL,
  `catatan_tsi` varchar(300) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `kabid` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ecoll_r`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_ecoll_r` */

insert  into `tb_ecoll_r`(`id_ecoll_r`,`id_cabang`,`kode_form`,`nama`,`nik`,`user`,`keterangan`,`no_telp`,`keperluan`,`jabatan`,`tempat`,`nama_pincab`,`nama_sdm`,`nama_tsi`,`nama_dirops`,`status_pincab`,`status_sdm`,`status_dirops`,`status_tsi`,`status_akhir`,`tgl_status_pincab`,`tgl_status_dirops`,`tgl_status_sdm`,`tgl_status_tsi`,`tgl_status_akhir`,`catatan_dirops`,`catatan_tsi`,`izin_edit`,`kabid`,`created_at`,`updated_at`) values 
(25,1,'KP.KPO/ECOLL-R/2024/0001','Eka','20238215',NULL,'-','625181000005','User Lupa Password','TSI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 15:43:20','2024-01-25 15:43:20'),
(26,1,'KP.KPO/ECOLL-R/2024/0002','Eka','20238215',NULL,'-','625181000005','User Lupa Password','TSI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 15:43:37','2024-01-25 15:43:37'),
(27,1,'KP.KPO/ECOLL-R/2024/0003','Eka','20238215',NULL,'-','625181000005','User Lupa Password','TSI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 15:43:41','2024-01-25 15:43:41'),
(28,1,'KP.KPO/ECOLL-R/2024/0004','Eka','20238215','eka','-','625181000005','User Lupa Password','TSI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 15:44:10','2024-01-25 15:44:10'),
(29,1,'KP.KPO/ECOLL-R/2024/0005','Eka','20238215','eka','-','625181000005','User Lupa Password','TSI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 15:44:14','2024-01-25 15:44:14'),
(30,1,'KP.KPO/ECOLL-R/2024/0006','Eka00','2023821500','eka00','-000','625181000005000','User Lupa Password','TSI00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 15:51:08','2024-01-25 15:51:08'),
(31,1,'KP.KPO/ECOLL-R/2024/0007','Ika Aliana','3305080580','ika_1','user baru lupa ganti pass','6282135341259','User Lupa Password','TSI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 15:53:18','2024-01-25 15:53:18');

/*Table structure for table `tb_email_p` */

DROP TABLE IF EXISTS `tb_email_p`;

CREATE TABLE `tb_email_p` (
  `id_pengajuan` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `no_kode` varchar(50) DEFAULT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `aktif` date DEFAULT NULL,
  `non_aktif` date DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_sdm` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `status_pincab` varchar(20) DEFAULT NULL,
  `status_sdm` varchar(20) DEFAULT NULL,
  `status_dirops` varchar(20) DEFAULT NULL,
  `status_tsi` varchar(20) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `catatan_sdm` varchar(250) DEFAULT NULL,
  `catatan_dirops` varchar(250) DEFAULT NULL,
  `catatan_tsi` varchar(250) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `kabid` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_email_p_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_email_p` */

insert  into `tb_email_p`(`id_pengajuan`,`id_cabang`,`kode_form`,`no_kode`,`keperluan`,`nik`,`nama`,`jabatan`,`user`,`no_telp`,`keterangan`,`aktif`,`non_aktif`,`nama_pincab`,`nama_sdm`,`nama_dirops`,`nama_tsi`,`status_pincab`,`status_sdm`,`status_dirops`,`status_tsi`,`status_akhir`,`tgl_status_pincab`,`tgl_status_dirops`,`tgl_status_sdm`,`tgl_status_tsi`,`tgl_status_akhir`,`catatan_sdm`,`catatan_dirops`,`catatan_tsi`,`izin_edit`,`kabid`,`created_at`,`updated_at`) values 
(2,3,'Kc.wsb/user-email/2023-1',NULL,'Pengajuan Email Baru','20312500','Savia Andrianii',NULL,'1','082','pegawai baru',NULL,NULL,'TAUFIQ','Diah Hapsari','Renard','Abdul Taufiq','Approve','Approve','Approve','Approve','Selesai','2023-05-26 10:06:24','2023-05-26 10:06:29','2023-05-26 10:06:34','2023-05-26 10:06:36','2023-05-26 10:06:38','NOthing','Nothing','Nothing juga',NULL,NULL,'2023-05-16 09:31:19','2023-05-30 17:09:25'),
(15,3,'Kc.wsb/user-email/2023-2',NULL,'Pengajuan Email Baru','21102','REZA R',NULL,NULL,'085025333','SS',NULL,NULL,'TAUFIQ',NULL,NULL,NULL,'Approve',NULL,NULL,NULL,'Proses','2023-06-09 13:07:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-06-09 11:29:12','2023-06-09 13:07:24'),
(16,3,'Kc.wsb/user-email/2023-3',NULL,'Pengajuan Email Baru','as','sa',NULL,NULL,'sa','sa',NULL,NULL,'TAUFIQ',NULL,NULL,NULL,'Approve',NULL,NULL,NULL,'Proses','2023-06-09 15:33:19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-06-09 15:14:42','2023-06-09 15:33:19'),
(17,3,'Kc.wsb/user-email/2023-4',NULL,'Penghapusan Email','hjg','jhhgj',NULL,NULL,'111','mvgm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pengajuan',NULL,'2023-06-12 17:07:53','2023-06-22 09:28:29'),
(31,1,'Kp.kpo/Email-P/2024/0001',NULL,'Pengajuan User Baru','225050','Taufiq',NULL,NULL,'08213534125','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 15:34:14','2024-01-19 15:34:14'),
(32,1,'/Email-P/2024/0002',NULL,'Pengajuan Email Baru','559899','Ruska',NULL,NULL,'08213351541050','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 15:49:29','2024-01-19 15:49:29'),
(33,1,'/Email-P/2024/0003',NULL,'Penghapusan Email','330605659','Elza',NULL,NULL,'0802548450105','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 15:50:42','2024-01-19 15:50:42'),
(34,1,'/Email-P/2024/0004',NULL,'Penghapusan Email','3242','dwda',NULL,NULL,'2324242','rrse',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 16:01:45','2024-01-19 16:01:45'),
(35,1,'KP.KPO/Email-P/2024/0005',NULL,'Pengajuan Email Baru','24','dwa',NULL,NULL,'432','dada',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 17:24:52','2024-01-19 17:24:52'),
(36,1,'KP.KPO/Email-P/2024/0006',NULL,'Penghapusan Email',NULL,'sda',NULL,NULL,'32423','423',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:04:30','2024-01-19 18:04:30'),
(37,1,'KP.KPO/Email-P/2024/0007',NULL,'Pengajuan Email Baru','323','qqqqq',NULL,NULL,'432424','qqqq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:23:16','2024-01-19 18:23:16'),
(38,1,'KP.KPO/Email-P/2024/0008',NULL,'Pengajuan Email Baru','323','qqqqq',NULL,NULL,'432424','qqqq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:23:17','2024-01-19 18:23:17'),
(39,1,'KP.KPO/Email-P/2024/0009',NULL,'Pengajuan Email Baru','2222','222',NULL,NULL,'222','222',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:24:09','2024-01-19 18:24:09'),
(40,1,'KP.KPO/Email-P/2024/0010',NULL,'Pengajuan Email Baru','2222','222',NULL,NULL,'222','222',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:24:09','2024-01-19 18:24:09'),
(41,1,'KP.KPO/Email-P/2024/0011',NULL,'Pengajuan Email Baru','111','111',NULL,NULL,'11','111',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:25:17','2024-01-19 18:25:17'),
(42,1,'KP.KPO/Email-P/2024/0012',NULL,'Pengajuan Email Baru','111','111',NULL,NULL,'11','111',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:25:18','2024-01-19 18:25:18'),
(43,1,'KP.KPO/Email-P/2024/0013',NULL,'Pengajuan Email Baru','1231111','333333',NULL,NULL,'3333','3333',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:30:53','2024-01-19 18:30:53'),
(44,1,'KP.KPO/Email-P/2024/0014',NULL,'Permohonan User Baru (Alternate)','33025150','Asrui','Kasi Komersial',NULL,'082113285055','=-',NULL,NULL,'Dummy Pimpinan Cabang',NULL,NULL,NULL,'Approve',NULL,NULL,NULL,'Proses','2024-02-05 11:08:31',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 16:56:37','2024-02-05 11:08:31'),
(45,1,'KP.KPO/EMAIL-P/2024/0015',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-05 10:37:07','2024-02-05 10:37:07'),
(46,1,'KP.KPO/EMAIL-P/2024/0016',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-05 10:39:28','2024-02-05 10:39:28'),
(47,1,'KP.KPO/EMAIL-P/2024/0017',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-05 10:44:28','2024-02-05 10:44:28'),
(48,1,'KP.KPO/EMAIL-P/2024/0018',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-05 10:49:55','2024-02-05 10:49:55'),
(49,1,'KP.KPO/EMAIL-P/2024/0019',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-05 10:58:20','2024-02-05 10:58:20'),
(50,1,'KP.KPO/EMAIL-P/2024/0020',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-05 10:59:26','2024-02-05 10:59:26'),
(51,1,'KP.KPO/EMAIL-P/2024/0021',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,'Dummy Pimpinan Cabang',NULL,NULL,NULL,'Reject',NULL,NULL,NULL,'Ditolak','2024-02-05 15:17:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-05 11:00:44','2024-02-05 15:17:57'),
(52,1,'KP.KPO/EMAIL-P/2024/0022',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,'Dummy Pimpinan Cabang',NULL,NULL,NULL,'Reject',NULL,NULL,NULL,'Ditolak','2024-02-05 15:10:10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-05 11:02:23','2024-02-05 15:10:10'),
(53,1,'KP.KPO/EMAIL-P/2024/0023',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,'Dummy Pimpinan Cabang',NULL,NULL,NULL,'Reject',NULL,NULL,NULL,'Ditolak','2024-02-05 15:08:47',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-05 11:04:51','2024-02-05 15:08:47'),
(54,1,'KP.KPO/EMAIL-P/2024/0024',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,'Dummy Pimpinan Cabang','Dummy SDM','Dummy Direktur Operasional',NULL,'Approve','Approve','Reject',NULL,'Ditolak','2024-02-05 14:26:32','2024-02-07 16:43:35','2024-02-07 16:36:19',NULL,NULL,'zzz','ddd',NULL,NULL,NULL,'2024-02-05 11:05:35','2024-02-07 16:43:35'),
(55,1,'KP.KPO/EMAIL-P/2024/0025',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,'Dummy Pimpinan Cabang','Dummy SDM',NULL,NULL,'Approve','Reject',NULL,NULL,'Ditolak','2024-02-05 13:39:02',NULL,'2024-02-07 16:32:03',NULL,NULL,'c',NULL,NULL,NULL,NULL,'2024-02-05 11:06:56','2024-02-07 16:32:03'),
(56,1,'KP.KPO/EMAIL-P/2024/0026',NULL,'Pengajuan Email Baru','323','da','da',NULL,'3232323232','eeda',NULL,NULL,'Dummy Pimpinan Cabang','Dummy SDM','Dummy Direktur Operasional','Dummy TSI','Approve','Approve','Approve','Reject','Ditolak','2024-02-05 11:48:09','2024-02-07 16:43:16','2024-02-07 16:31:05','2024-02-07 16:56:00','2024-02-07 16:56:00','okeee','c','xxx',NULL,NULL,'2024-02-05 11:07:27','2024-02-07 16:56:00'),
(57,1,'KP.KPO/EMAIL-P/2024/0027',NULL,'Pengajuan Email Baru','2323','e2e','wre',NULL,'4343','rew',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-06 15:33:13','2024-02-06 15:33:13'),
(58,1,'KP.KPO/EMAIL-P/2024/0028',NULL,'Pengajuan Email Baru','4343','efs','fse',NULL,'33535','3s',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-06 15:34:01','2024-02-06 15:34:01'),
(59,1,'KP.KPO/EMAIL-P/2024/0029',NULL,'Pengajuan Email Baru','464','46464','646',NULL,'46464','6464',NULL,NULL,'Dummy Pimpinan Cabang','Dummy SDM','Dummy TSI','Dummy TSI','Approve','Approve','Approve','Approve','Selesai','2024-02-07 15:20:30','2024-02-07 16:44:40','2024-02-07 16:29:35','2024-02-07 16:52:27',NULL,'oke','xxx','ddd',NULL,NULL,'2024-02-06 15:34:20','2024-02-07 16:52:27'),
(60,1,'KP.KPO/EMAIL-P/2024/0030',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Dummy Pimpinan Cabang',NULL,NULL,NULL,'Reject',NULL,NULL,NULL,'Ditolak','2024-02-07 15:03:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-07 11:36:17','2024-02-07 15:03:43');

/*Table structure for table `tb_email_r` */

DROP TABLE IF EXISTS `tb_email_r`;

CREATE TABLE `tb_email_r` (
  `id_reset` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nik` varchar(10) DEFAULT NULL,
  `user` varchar(200) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `keperluan` varchar(50) DEFAULT NULL,
  `tempat` varchar(50) DEFAULT NULL,
  `nama_pincab` varchar(200) DEFAULT NULL,
  `nama_sdm` varchar(50) DEFAULT NULL,
  `nama_pelaksana` varchar(200) DEFAULT NULL,
  `nama_mengetahui` varchar(100) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status` enum('Approve','Reject') DEFAULT NULL,
  `status_dirops` enum('Approve','Reject') DEFAULT NULL,
  `status_tsi` enum('Approve','Reject') DEFAULT NULL,
  `status_akhir` enum('Selesai','Proses','Ditolak') DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `catatan_dirops` varchar(300) DEFAULT NULL,
  `catatan_tsi` varchar(300) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `kabid` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_reset`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_email_r_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_email_r` */

insert  into `tb_email_r`(`id_reset`,`id_cabang`,`kode_form`,`nama`,`nik`,`user`,`keterangan`,`no_telp`,`jabatan`,`keperluan`,`tempat`,`nama_pincab`,`nama_sdm`,`nama_pelaksana`,`nama_mengetahui`,`status_pincab`,`status`,`status_dirops`,`status_tsi`,`status_akhir`,`tgl_status_pincab`,`tgl_status_dirops`,`tgl_status_sdm`,`tgl_status_tsi`,`tgl_status_akhir`,`catatan_dirops`,`catatan_tsi`,`izin_edit`,`kabid`,`created_at`,`updated_at`) values 
(14,3,'Kc.wnb/reset-email/2023-1','Riki Prayuda','102033','riki','aoq','6282135341258',NULL,'Lupa Password','Wonosobo','TAUFIQ','Diah Hapsari','Abdul Taufiq','Renard','Approve','Approve','Approve','Approve','Selesai','2023-05-26 10:46:27','2023-05-26 10:46:33','2023-05-26 10:46:35','2023-05-26 10:46:36','2023-05-26 10:46:39','oke','oke',NULL,NULL,'2023-05-01 14:29:33','2023-03-20 11:56:49'),
(18,3,'Kc.wsb/reset-email/2023-2','Dinistyana Arlinda Putri','30220165','aa','-1','082311058',NULL,'Lupa Password','Wonosobo','TAUFIQ',NULL,NULL,NULL,'Approve',NULL,NULL,NULL,'Proses','2023-06-13 08:45:31',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'2023-06-13 08:39:13','2023-06-13 08:45:31'),
(27,1,'/Email-P/2024/0001','Elsa','5282500','elsa@bprkusumasumbing.com','-','05801541140',NULL,'User Expired',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 15:58:24','2024-01-19 15:58:24'),
(28,1,'/Email-P/2024/0002','Reza','546484','reza@bprkusumasumbing.com','-','08213515484484',NULL,'User Expired',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 15:59:42','2024-01-19 15:59:42'),
(29,1,'KP.KPO/Email-P/2024/0003','e','43423','e@gmail.con','45','5454',NULL,'User Expired',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 16:05:16','2024-01-19 16:05:16'),
(30,1,'KP.KPO/Email-P/2024/0004','e','43423','e@gmail.con','45','5454',NULL,'User Expired',NULL,'Dummy Pimpinan Cabang',NULL,NULL,NULL,'Reject',NULL,NULL,NULL,'Ditolak','2024-02-07 16:23:27',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 16:07:54','2024-02-07 16:23:27'),
(31,1,'KP.KPO/Email-P/2024/0005','e','43423','e@gmail.con','45','5454',NULL,'User Expired',NULL,'Dummy Pimpinan Cabang',NULL,NULL,NULL,'Approve',NULL,NULL,NULL,'Proses','2024-02-07 16:23:02',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 16:08:08','2024-02-07 16:23:02'),
(32,1,'KP.KPO/Email-P/2024/0006','fsdf','5352','rrew@gmail.com','dwa','232332',NULL,'User Expired',NULL,'Dummy Pimpinan Cabang',NULL,NULL,NULL,'Approve',NULL,NULL,NULL,'Proses','2024-02-07 16:18:12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 17:21:39','2024-02-07 16:18:12');

/*Table structure for table `tb_mso_pembatalan` */

DROP TABLE IF EXISTS `tb_mso_pembatalan`;

CREATE TABLE `tb_mso_pembatalan` (
  `id_del` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(300) DEFAULT NULL,
  `kode_no` varchar(300) DEFAULT NULL,
  `no_rek` varchar(300) DEFAULT NULL,
  `jns_transaksi` varchar(300) DEFAULT NULL,
  `id_transaksi` varchar(300) DEFAULT NULL,
  `keterangan` varchar(750) DEFAULT NULL,
  `alasan_kesalahan` varchar(750) DEFAULT NULL,
  `keperluan` varchar(205) DEFAULT NULL,
  `nominal` varchar(250) DEFAULT NULL,
  `user` varchar(750) DEFAULT NULL,
  `nama_pincab` varchar(750) DEFAULT NULL,
  `nama_kaops` varchar(750) DEFAULT NULL,
  `nama_korektor` varchar(750) DEFAULT NULL,
  `nama_dirops` varchar(750) DEFAULT NULL,
  `status_pincab` varchar(60) DEFAULT NULL,
  `status_kaops` varchar(60) DEFAULT NULL,
  `status_korektor` varchar(60) DEFAULT NULL,
  `status_dirops` varchar(60) DEFAULT NULL,
  `status_akhir` varchar(60) DEFAULT NULL,
  `catatan_korektor` varchar(750) DEFAULT NULL,
  `catatan_dirops` varchar(750) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_del`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_mso_pembatalan` */

insert  into `tb_mso_pembatalan`(`id_del`,`id_cabang`,`kode_form`,`kode_no`,`no_rek`,`jns_transaksi`,`id_transaksi`,`keterangan`,`alasan_kesalahan`,`keperluan`,`nominal`,`user`,`nama_pincab`,`nama_kaops`,`nama_korektor`,`nama_dirops`,`status_pincab`,`status_kaops`,`status_korektor`,`status_dirops`,`status_akhir`,`catatan_korektor`,`catatan_dirops`,`created_at`,`updated_at`) values 
(1,3,'Kc.wsb/BtlTrx/2023-1',NULL,'025.002.04441','E-coll1','86751548521','Kesalahan Inpout1','salah inpoyttt1','Pembatalan Transaksi','80.0001','gw1',NULL,'ABDUL','Abdul Taufiq','Renard',NULL,'Approve','Approve','Approve','Selesai',NULL,NULL,'2023-04-26 10:49:11','2023-04-26 10:49:11'),
(2,3,'Kc.wsb/BtlTrx/2023-2',NULL,'s\';a','aaaa','sq;ld,ms','knskd','flksf','Pembatalan Transaksi','dklmsk','djk','TAUFIQ','ABDUL','Abdul Taufiq','Renard','Approve','Approve',NULL,'Approve','Selesai',NULL,NULL,'2023-05-12 16:17:34','2023-04-26 10:59:31');

/*Table structure for table `tb_mso_perubahan` */

DROP TABLE IF EXISTS `tb_mso_perubahan`;

CREATE TABLE `tb_mso_perubahan` (
  `id_fix` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(100) DEFAULT NULL,
  `kode_no` varchar(100) DEFAULT NULL,
  `no_rek` varchar(100) DEFAULT NULL,
  `nama_debitur` varchar(250) DEFAULT NULL,
  `kepada` varchar(100) DEFAULT NULL,
  `keperluan` varchar(500) DEFAULT NULL,
  `jns_transaksi` varchar(100) DEFAULT NULL,
  `id_transaksi` varchar(100) DEFAULT NULL,
  `data_salah` varchar(250) DEFAULT NULL,
  `data_benar` varchar(250) DEFAULT NULL,
  `alasan_kesalahan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_korektor` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `status_pincab` varchar(20) DEFAULT NULL,
  `status_kaops` varchar(20) DEFAULT NULL,
  `status_korektor` varchar(20) DEFAULT NULL,
  `status_dirops` varchar(20) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `catatan_korektor` varchar(250) DEFAULT NULL,
  `catatan_dirops` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_fix`),
  KEY `tb_mso_fixing_ibfk_1` (`id_cabang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_mso_perubahan` */

insert  into `tb_mso_perubahan`(`id_fix`,`id_cabang`,`kode_form`,`kode_no`,`no_rek`,`nama_debitur`,`kepada`,`keperluan`,`jns_transaksi`,`id_transaksi`,`data_salah`,`data_benar`,`alasan_kesalahan`,`user`,`nama_pincab`,`nama_kaops`,`nama_korektor`,`nama_dirops`,`status_pincab`,`status_kaops`,`status_korektor`,`status_dirops`,`status_akhir`,`catatan_korektor`,`catatan_dirops`,`created_at`,`updated_at`) values 
(1,3,'Kc.wsb/RevData/2023-1','221','06.003.0010.2222','tau ah2','21','21','Rekening Kredit','77.77.112','tidak ada2','Nothing2','2121','12122','TAUFIQ','12','Abdul Taufiq','Renard','Approve','W','Approve','Approve','Selesai','nothingd','tidak ada','2023-04-11 15:47:51','2023-04-26 10:54:42'),
(2,3,'Kc.wsb/RevData/2023-2',NULL,'20.02.23.23','Taufiq',NULL,'Perubahan Data','Rekening Kredit','771000','Nothing','Bre',NULL,'brotherhood','TAUFIQ','ABDUL','Abdul Taufiq','Renard','Approve','Approve','Reject','Approve','Selesai',NULL,NULL,'2023-04-12 10:17:21','2023-04-26 11:05:25');

/*Table structure for table `tb_msop` */

DROP TABLE IF EXISTS `tb_msop`;

CREATE TABLE `tb_msop` (
  `id_msop` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `no_kode` varchar(50) DEFAULT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `aktif` date DEFAULT NULL,
  `non_aktif` date DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_sdm` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `status_pincab` varchar(20) DEFAULT NULL,
  `status_sdm` varchar(20) DEFAULT NULL,
  `status_dirops` varchar(20) DEFAULT NULL,
  `status_tsi` varchar(20) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `catatan_sdm` varchar(250) DEFAULT NULL,
  `catatan_dirops` varchar(250) DEFAULT NULL,
  `catatan_tsi` varchar(250) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `kabid` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_msop`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_msop` */

insert  into `tb_msop`(`id_msop`,`id_cabang`,`kode_form`,`no_kode`,`keperluan`,`nik`,`nama`,`jabatan`,`user`,`no_telp`,`keterangan`,`aktif`,`non_aktif`,`nama_pincab`,`nama_sdm`,`nama_dirops`,`nama_tsi`,`status_pincab`,`status_sdm`,`status_dirops`,`status_tsi`,`status_akhir`,`tgl_status_pincab`,`tgl_status_dirops`,`tgl_status_sdm`,`tgl_status_tsi`,`tgl_status_akhir`,`catatan_sdm`,`catatan_dirops`,`catatan_tsi`,`izin_edit`,`kabid`,`created_at`,`updated_at`) values 
(2,3,'Kc.wsb/user-id/2023-1',NULL,'Permohonan User Baru (Alternate)','02588 ALT','Sulistyono ALT',NULL,NULL,'08213532465 ALT','-alt','2023-03-24','2023-03-26','TAUFIQ','Diah Hapsari','Renard','Abdul Taufiq','Approve','Approve','Approve','Approve','Selesai','2023-05-29 15:28:41','2023-05-29 15:28:43','2023-05-29 15:28:44','2023-05-29 15:28:47','2023-05-29 15:28:53',NULL,NULL,NULL,NULL,NULL,'2023-03-27 11:31:14','2023-03-27 11:31:14'),
(11,3,'Kc.wsb/user-id/2023-2',NULL,'Permohonan User Baru','1023302','Lorenzo','lk',NULL,'-','-','2023-06-07','2023-06-05','TAUFIQ',NULL,NULL,NULL,'Approve',NULL,NULL,NULL,'Proses','2023-06-09 16:26:01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-05-04 16:49:59','2023-06-09 16:26:01'),
(12,3,'Kc.wsb/user-id/2023-3',NULL,'Penonaktifan User','055','l','l',NULL,'08552',';','2023-06-12','2023-06-23',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'2023-06-13 09:07:24','2023-06-13 09:23:01'),
(19,1,'KP.KPO/MbsUs-P/2024/0001',NULL,'Permohonan User Baru (Alternate)','23','xxxx','xx',NULL,'333','xxx',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 17:10:26','2024-01-22 17:10:26'),
(20,1,'KP.KPO/MbsUs-P/2024/0002',NULL,'Permohonan User Baru (Alternate)','23','xxxx','xx',NULL,'333','xxx',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 17:12:06','2024-01-22 17:12:06'),
(21,1,'KP.KPO/MbsUs-P/2024/0003',NULL,'Penonaktifan User','2631651','Sahroni','AO',NULL,'0821354545454','new member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 17:21:15','2024-01-22 17:21:15'),
(22,1,'KP.KPO/MbsUs-P/2024/0004',NULL,'Permohonan User Baru (Alternate)','2631651','Sahroni','AO',NULL,'0821354545454','new member','2024-01-24','2024-01-25',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 17:21:18','2024-01-22 17:21:18'),
(23,1,'KP.KPO/MbsUs-P/2024/0005',NULL,'Penonaktifan User','2631651','Sahroni','AO',NULL,'0821354545454','new member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 17:21:20','2024-01-22 17:21:20'),
(24,1,'KP.KPO/MbsUs-P/2024/0006',NULL,'Penonaktifan User','2631651','Sahroni','AO',NULL,'0821354545454','new member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 17:21:22','2024-01-22 17:21:22'),
(25,1,'KP.KPO/MbsUs-P/2024/0007',NULL,'Penonaktifan User','2631651','Sahroni','AO',NULL,'0821354545454','new member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 17:21:24','2024-01-22 17:21:24'),
(26,1,'KP.KPO/MbsUs-P/2024/0008',NULL,'Permohonan User Baru','263165177','Sahroni Abdullah','AO 1',NULL,'08213545454541','new member1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-23 08:39:49','2024-01-23 08:39:49'),
(27,1,'KP.KPO/MBSUS-P/2024/0009',NULL,'Permohonan User Baru','123456789','Taufiq','kasi Operasional',NULL,'08216558848400','pengganti user',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-25 08:27:12','2024-01-25 08:27:12');

/*Table structure for table `tb_msor` */

DROP TABLE IF EXISTS `tb_msor`;

CREATE TABLE `tb_msor` (
  `id_msor` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `keperluan` varchar(50) DEFAULT NULL,
  `nik` varchar(10) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `user` varchar(200) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `tempat` varchar(50) DEFAULT NULL,
  `nama_pincab` varchar(200) DEFAULT NULL,
  `nama_sdm` varchar(50) DEFAULT NULL,
  `nama_tsi` varchar(200) DEFAULT NULL,
  `nama_dirops` varchar(100) DEFAULT NULL,
  `status_pincab` enum('Approve','Reject','--') DEFAULT NULL,
  `status_sdm` enum('Approve','Reject') DEFAULT NULL,
  `status_dirops` enum('Approve','Reject') DEFAULT NULL,
  `status_tsi` enum('Approve','Reject') DEFAULT NULL,
  `status_akhir` enum('Selesai','Proses','Ditolak') DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `catatan_dirops` varchar(300) DEFAULT NULL,
  `catatan_tsi` varchar(300) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `kabid` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_msor`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_msor` */

insert  into `tb_msor`(`id_msor`,`id_cabang`,`kode_form`,`keperluan`,`nik`,`nama`,`user`,`keterangan`,`no_telp`,`jabatan`,`tempat`,`nama_pincab`,`nama_sdm`,`nama_tsi`,`nama_dirops`,`status_pincab`,`status_sdm`,`status_dirops`,`status_tsi`,`status_akhir`,`tgl_status_pincab`,`tgl_status_dirops`,`tgl_status_sdm`,`tgl_status_tsi`,`tgl_status_akhir`,`catatan_dirops`,`catatan_tsi`,`izin_edit`,`kabid`,`created_at`,`updated_at`) values 
(18,3,'Kc.wsb/user-reset/2023-1','User Expired','dad33','da33','bf33','adaad33','adadad33','bn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Proses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'2023-03-30 15:44:37','2023-06-13 09:50:30'),
(19,3,'Kc.wsb/user-reset/2023-2','Lupa Password','yyykkk','yykk','kkkk','yyykkk','yykk','Analis',NULL,'TAUFIQ','Diah Hapsari','Abdul Taufiq','Renard','Approve','Approve','Approve','Approve','Selesai','2023-05-29 15:27:47','2023-05-29 15:27:49','2023-05-29 15:27:51','2023-05-29 15:27:55','2023-05-29 15:27:58',NULL,NULL,NULL,NULL,'2023-03-30 16:28:13','2023-04-26 08:36:23'),
(25,1,'KP.KPO/MbsUs-R/2024/0001','User Expired','22102505','Rizald','rizald_1','-','08213698060','Analis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-24 15:02:37','2024-01-24 15:02:37'),
(26,1,'KP.KPO/MbsUs-R/2024/0002','User Expired','22102505','Rizald','rizald_1','-','08213698060','Analis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-24 15:02:45','2024-01-24 15:02:45'),
(27,1,'KP.KPO/MbsUs-R/2024/0003','User Expired','22102505','Rizald','rizald_1','-','08213698060','Analis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-24 15:02:50','2024-01-24 15:02:50'),
(28,1,'KP.KPO/MbsUs-R/2024/0004','User Expired','22102505','Rizald','rizald_1','-','08213698060','Analis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-24 15:02:55','2024-01-24 15:02:55'),
(29,1,'KP.KPO/MbsUs-R/2024/0005','User Expired','22102505','Rizald','rizald_1','-','08213698060','Analis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-24 15:02:58','2024-01-24 15:02:58'),
(30,1,'KP.KPO/MbsUs-R/2024/0006','User Expired','22102505','Rizald','rizald_1','-','08213698060','Analis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-24 15:03:05','2024-01-24 15:03:05'),
(31,1,'KP.KPO/MbsUs-R/2024/0007','User Expired','2210250500','Rizald0','rizald_10','-0','082136980600','Analis0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-24 15:32:11','2024-01-24 15:32:11');

/*Table structure for table `tb_pefindo` */

DROP TABLE IF EXISTS `tb_pefindo`;

CREATE TABLE `tb_pefindo` (
  `id_pefindo` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `no_kode` varchar(50) DEFAULT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `jabatan` varchar(250) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `status_pincab` varchar(20) DEFAULT NULL,
  `status_dirops` varchar(20) DEFAULT NULL,
  `status_tsi` varchar(20) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `catatan_sdm` varchar(250) DEFAULT NULL,
  `catatan_dirops` varchar(250) DEFAULT NULL,
  `catatan_tsi` varchar(250) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pefindo`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pefindo_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pefindo` */

insert  into `tb_pefindo`(`id_pefindo`,`id_cabang`,`kode_form`,`no_kode`,`keperluan`,`nik`,`nama`,`jabatan`,`no_telp`,`keterangan`,`nama_pincab`,`nama_dirops`,`nama_tsi`,`status_pincab`,`status_dirops`,`status_tsi`,`status_akhir`,`tgl_status_pincab`,`tgl_status_sdm`,`tgl_status_tsi`,`tgl_status_akhir`,`catatan_sdm`,`catatan_dirops`,`catatan_tsi`,`izin_edit`,`created_at`,`updated_at`) values 
(18,1,'KP.KPO/PFNDO-P/2024/0001',NULL,'Permohonan User Baru','12121','12121','2121','21','21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 19:57:30','2024-01-31 19:57:30'),
(19,1,'KP.KPO/PFNDO-P/2024/0002',NULL,'Permohonan User Baru','12121','12121','2121','21','21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 19:57:33','2024-01-31 19:57:33'),
(20,1,'KP.KPO/PFNDO-P/2024/0003',NULL,'Permohonan User Baru','12121','12121','2121','21','21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 19:57:38','2024-01-31 19:57:38'),
(21,1,'KP.KPO/PFNDO-P/2024/0004',NULL,'Permohonan User Baru','12121000','12121000','2121000','21000','21000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 19:57:45','2024-01-31 20:01:28'),
(22,1,'KP.KPO/PFNDO-P/2024/0005',NULL,'Reset Password User','343','fs','ds','3535353','fd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-01 09:20:52','2024-02-01 09:20:52');

/*Table structure for table `tb_pefindo_reset` */

DROP TABLE IF EXISTS `tb_pefindo_reset`;

CREATE TABLE `tb_pefindo_reset` (
  `id_pefindo_reset` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `no_kode` varchar(50) DEFAULT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `jabatan` varchar(250) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `status_pincab` varchar(20) DEFAULT NULL,
  `status_dirops` varchar(20) DEFAULT NULL,
  `status_tsi` varchar(20) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `catatan_sdm` varchar(250) DEFAULT NULL,
  `catatan_dirops` varchar(250) DEFAULT NULL,
  `catatan_tsi` varchar(250) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pefindo_reset`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pefindo_reset_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pefindo_reset` */

insert  into `tb_pefindo_reset`(`id_pefindo_reset`,`id_cabang`,`kode_form`,`no_kode`,`keperluan`,`nik`,`nama`,`jabatan`,`no_telp`,`keterangan`,`nama_pincab`,`nama_dirops`,`nama_tsi`,`status_pincab`,`status_dirops`,`status_tsi`,`status_akhir`,`tgl_status_pincab`,`tgl_status_sdm`,`tgl_status_tsi`,`tgl_status_akhir`,`catatan_sdm`,`catatan_dirops`,`catatan_tsi`,`izin_edit`,`created_at`,`updated_at`) values 
(18,1,'KP.KPO/PFNDO-R/2024/0001',NULL,'Reset Password User','24','dx','cc','333','cdfe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-01 09:29:14','2024-02-01 09:29:14'),
(19,1,'KP.KPO/PFNDO-R/2024/0002',NULL,'Reset Password User','24','dx','cc','333','cdfe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-01 09:29:16','2024-02-01 09:29:16'),
(20,1,'KP.KPO/PFNDO-R/2024/0003',NULL,'Reset Password User','24','dx','cc','333','cdfe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-01 09:29:18','2024-02-01 09:29:18'),
(21,1,'KP.KPO/PFNDO-R/2024/0004',NULL,'Reset Password User','24','dx','cc','333','cdfe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-01 09:29:19','2024-02-01 09:29:19'),
(22,1,'KP.KPO/PFNDO-R/2024/0005',NULL,'Reset Password User','2444','dx44','cc44','33344','cdfe444',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-01 09:29:26','2024-02-01 09:29:42');

/*Table structure for table `tb_pembatalan_akuntansi` */

DROP TABLE IF EXISTS `tb_pembatalan_akuntansi`;

CREATE TABLE `tb_pembatalan_akuntansi` (
  `id_akuntansi` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `jns_akuntansi` varchar(50) DEFAULT NULL,
  `id_transaksi` varchar(250) DEFAULT NULL,
  `nominal` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_akuntansi`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pembatalan_akuntansi_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pembatalan_akuntansi` */

insert  into `tb_pembatalan_akuntansi`(`id_akuntansi`,`id_cabang`,`kode_form`,`jns_akuntansi`,`id_transaksi`,`nominal`,`alasan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`status_pincab`,`status_pembukuan`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`izin_edit`,`created_at`,`updated_at`) values 
(1,1,'Kc.wsb/Btx-Aks/2023-1','Transaksi Jurnal Kas','11023354','1000','Kesalahan Input','reza',NULL,NULL,'TAUFIQ','Pembukuan','Renard','pincab','L','/','Approve','Approve','Reject','Ditolak','2023-06-06 11:35:25','2023-05-31 16:14:15','2023-06-07 09:45:01','2023-05-30 14:21:50','Pelanggara','Bukan Pela',NULL,'2023-05-30 14:22:12','2023-06-07 09:45:01'),
(2,3,'Kc.wsb/Btx-Aks/2023-2','Transaksi Jurnal Kas','110233','1000000','Salah input','rez_1',NULL,NULL,'TAUFIQ',NULL,NULL,NULL,'Pembukuan',NULL,NULL,NULL,NULL,'Proses','2023-06-06 11:03:41',NULL,NULL,NULL,'Pelanggaran',NULL,'Tolak','2023-05-30 15:35:34','2023-06-12 14:22:13'),
(6,3,'Kc.wsb/Btx-Aks/2023-3','Transaksi Jurnal Non Kas','755','6564','54654','465',NULL,'ABDUL','TAUFIQ','Pembukuan','Renard',NULL,'DITOLAK KARENA DATA TIDAK LENGKAP','OKE DARI DIREKTUR','Approve','','','Proses','2023-06-13 16:11:16','2023-06-14 11:58:55','2023-06-14 13:35:19','2023-06-14 13:35:19',NULL,'Pelanggaran','','2023-06-12 09:57:25','2023-06-14 13:35:19'),
(14,1,'KP.KPO/BTT-AKS/2024/0001','Transaksi Jurnal Kas','10051.05420.5','Rp. 1.000.000,75',NULL,'taufiq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 11:10:06','2024-01-26 11:10:06'),
(15,1,'KP.KPO/BTT-AKS/2024/0002','Transaksi Jurnal Kas','10051.05420.5','Rp. 1.000.000,75',NULL,'taufiq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 11:10:08','2024-01-26 11:10:08'),
(16,1,'KP.KPO/BTT-AKS/2024/0003','Transaksi Jurnal Kas','10051.05420.5','Rp. 1.000.000,75','kesalahan input','taufiq','lupa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 11:11:17','2024-01-26 11:11:17'),
(17,1,'KP.KPO/BTT-AKS/2024/0004','Transaksi Jurnal Kas','10051.05420.5','Rp. 1.000.000,75','kesalahan input','taufiq','lupa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 11:11:24','2024-01-26 11:11:24'),
(18,1,'KP.KPO/BTT-AKS/2024/0005','Transaksi Jurnal Non Kas','10051.05420.50','Rp. 1.000.000,70','kesalahan input0','taufiq0','lupa0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 14:00:57','2024-01-26 14:00:57'),
(19,1,'KP.KPO/BTT-AKS/2024/0006',NULL,'2202.6620.220','Rp. 1.000.000,41','kesalahan input','taufiq','enathlah',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 15:16:31','2024-01-26 15:16:31');

/*Table structure for table `tb_pembatalan_antar_bank` */

DROP TABLE IF EXISTS `tb_pembatalan_antar_bank`;

CREATE TABLE `tb_pembatalan_antar_bank` (
  `id_antar_bank` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `id_transaksi` varchar(250) DEFAULT NULL,
  `nama_bank` varchar(250) DEFAULT NULL,
  `nominal` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_antar_bank`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pembatalan_antar_bank_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pembatalan_antar_bank` */

insert  into `tb_pembatalan_antar_bank`(`id_antar_bank`,`id_cabang`,`kode_form`,`id_transaksi`,`nama_bank`,`nominal`,`alasan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`status_pincab`,`status_pembukuan`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`izin_edit`,`created_at`,`updated_at`) values 
(1,3,'Kc.wsb/Btx-Anb/2023-1','99018922','BANK BCA','9000000','salah input tydak sengaja','reza1',NULL,NULL,'TAUFIQ','Pembukuan','Renard','pincab','PEMBUKUAN','DIROSP','Approve','Approve','Approve','Selesai','2023-06-06 11:49:42','2023-06-07 09:29:40','2023-06-07 09:45:37',NULL,'Pelanggaran','Bukan Pelanggaran',NULL,'2023-06-05 15:16:33','2023-06-07 09:45:37'),
(3,3,'Kc.wsb/Btx-Anb/2023-2','111202','BANK BNI','20000','5','4',NULL,'ABDUL',NULL,NULL,NULL,NULL,NULL,NULL,'Approve',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','2023-06-08 11:22:46','2023-06-12 15:05:13'),
(4,1,'KP.KPO/BTT-BNK/2024/0001','22.3040.210','BANK BNI','Rp. 1.000.000,10','salah input','taufiq','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 15:19:00','2024-01-26 15:19:00'),
(5,1,'KP.KPO/BTT-BNK/2024/0002','22.3040.210','BANK BNI','Rp. 1.000.000,10','salah input','taufiq','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 15:19:05','2024-01-26 15:19:05'),
(6,1,'KP.KPO/BTT-BNK/2024/0003','22.3040.210','BANK BNI','Rp. 1.000.000,10','salah input','taufiq','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 15:19:09','2024-01-26 15:19:09'),
(7,1,'KP.KPO/BTT-BNK/2024/0004','22.3040.000','BANK BRI','Rp. 1.000.000,00','salah input00','taufiq00','-00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 15:47:23','2024-01-26 15:47:23');

/*Table structure for table `tb_pembatalan_antar_kantor` */

DROP TABLE IF EXISTS `tb_pembatalan_antar_kantor`;

CREATE TABLE `tb_pembatalan_antar_kantor` (
  `id_antar_kantor` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `id_transaksi` varchar(250) DEFAULT NULL,
  `nominal` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_antar_kantor`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pembatalan_antar_kantor_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pembatalan_antar_kantor` */

insert  into `tb_pembatalan_antar_kantor`(`id_antar_kantor`,`id_cabang`,`kode_form`,`id_transaksi`,`nominal`,`alasan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`status_pincab`,`status_pembukuan`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`izin_edit`,`created_at`,`updated_at`) values 
(1,3,'Kc.wsb/Btx-Ank/2023-1','1002365','10000000','Kesalahan INputgg','Rizky_09',NULL,'ABDUL','TAUFIQ',NULL,NULL,'PINXCAB OKE',NULL,NULL,'Approve',NULL,NULL,'Proses','2023-06-14 17:12:04',NULL,NULL,NULL,NULL,NULL,'','2023-06-14 16:54:48','2023-06-14 17:12:04'),
(2,1,'KP.KPO/BTT-KNR/2024/0001','220235.202','Rp. 1.000.000','salah input','dodi','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 16:59:39','2024-01-26 16:59:39'),
(3,1,'KP.KPO/BTT-KNR/2024/0002','220235.202','Rp. 1.000.000','salah input','dodi','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 16:59:44','2024-01-26 16:59:44'),
(4,1,'KP.KPO/BTT-KNR/2024/0003','220235.202','Rp. 1.000.000','salah input','dodi','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 16:59:46','2024-01-26 16:59:46'),
(5,1,'KP.KPO/BTT-KNR/2024/0004','220235.202','Rp. 1.000.000','salah input','dodi','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 16:59:50','2024-01-26 16:59:50'),
(6,1,'KP.KPO/BTT-KNR/2024/0005','220235001','Rp. 10.000.001','salah input1','dodi1','-1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 17:06:23','2024-01-26 17:06:23'),
(7,1,'KP.KPO/BTT-AKA/2024/0006','rw34r','Rp. 545','454','5454r','5454r',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 17:16:20','2024-01-26 17:16:31'),
(8,1,'KP.KPO/BTT-AKA/2024/0007','xxffdds','Rp. 222.222','xx2ewdd','xxds','xxds',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 17:17:45','2024-01-29 10:19:38');

/*Table structure for table `tb_pembatalan_deposito` */

DROP TABLE IF EXISTS `tb_pembatalan_deposito`;

CREATE TABLE `tb_pembatalan_deposito` (
  `id_deposito` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `id_transaksi` varchar(250) DEFAULT NULL,
  `no_rek` varchar(250) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `nominal` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_deposito`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pembatalan_deposito_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pembatalan_deposito` */

insert  into `tb_pembatalan_deposito`(`id_deposito`,`id_cabang`,`kode_form`,`id_transaksi`,`no_rek`,`nama`,`nominal`,`alasan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`status_pincab`,`status_pembukuan`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`izin_edit`,`created_at`,`updated_at`) values 
(4,1,'KP.KPO/BTT-DPS/2024/0001','45410.220212','sss112','112','Rp. 333.112','dd112','dd112','dd112',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 11:22:06','2024-01-29 11:33:44'),
(5,1,'KP.KPO/BTT-DPS/2024/0002','45410.22011','sss11','ika211','Rp. 33.311','dd11','dd111','dd11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 11:21:25','2024-01-29 11:21:25'),
(6,1,'KP.KPO/BTT-DPS/2024/0003','45410.220111','sss111','ika1111','Rp. 3.331.111','dd111','dd111','dd111',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 11:26:49','2024-01-29 11:26:49');

/*Table structure for table `tb_pembatalan_ecoll` */

DROP TABLE IF EXISTS `tb_pembatalan_ecoll`;

CREATE TABLE `tb_pembatalan_ecoll` (
  `id_ecoll` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `id_transaksi` varchar(250) DEFAULT NULL,
  `no_rek` varchar(250) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `nominal` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_tsi` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_tsi` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_tsi` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ecoll`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pembatalan_ecoll_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pembatalan_ecoll` */

insert  into `tb_pembatalan_ecoll`(`id_ecoll`,`id_cabang`,`kode_form`,`id_transaksi`,`no_rek`,`nama`,`nominal`,`alasan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_tsi`,`nama_dirops`,`catatan_pincab`,`catatan_pembukuan`,`catatan_tsi`,`catatan_dirops`,`status_pincab`,`status_pembukuan`,`status_tsi`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_tsi`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_tsi`,`pelanggaran_dirops`,`izin_edit`,`created_at`,`updated_at`) values 
(1,3,'Kc.wsb/Btx-Ecl/2023-1','198820','23456698','Reza Raharjo','90000','Kesalahn INpuT','REZA_03',NULL,NULL,'TAUFIQ','Pembukuan',NULL,NULL,'Pincab','PEM BUKU AN',NULL,NULL,'Approve','',NULL,NULL,'Proses','2023-06-07 13:43:25',NULL,'2023-06-07 14:20:21',NULL,NULL,'',NULL,NULL,'2023-06-07 10:45:55','2023-06-07 13:55:24'),
(2,3,'Kc.wsb/Btx-Ecl/2023-1','198820','23456698','Reza Raharjo','90000','Kesalahn INpuT','REZA_03',NULL,NULL,'TAUFIQ','Pembukuan','Abdul Taufiq','Renard','PINCAB','PEMBUKUAN L','TSI OKE','Direktur Operasional','Approve','Approve','Approve','Approve','Selesai','2023-06-07 13:39:35',NULL,'2023-06-07 14:26:31','2023-06-07 14:11:18',NULL,'Bukan Pelanggaran','Bukan Pelanggaran',NULL,'2023-06-07 10:46:17','2023-06-07 14:26:31'),
(4,3,'Kc.wsb/Btx-Ecl/2023-2','hd','hdff','hfdf','55','uyou','iy',NULL,'ABDUL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','2023-06-12 15:14:03','2023-06-12 15:24:03'),
(5,1,'KP.KPO/BTT-ECL/2024/0001','2032','02315','ika','Rp. 1.000.000','salah input','erniq','123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 11:57:48','2024-01-29 11:57:48'),
(6,1,'KP.KPO/BTT-ECL/2024/0002','2032','02315','ika','Rp. 1.000.000','salah input','erniq','123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 11:58:03','2024-01-29 11:58:03'),
(7,1,'KP.KPO/BTT-ECL/2024/0003','12300','12300','Eka','Rp. 31.200','31200','Reza','31200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 11:58:32','2024-01-29 13:33:05');

/*Table structure for table `tb_pembatalan_inventaris` */

DROP TABLE IF EXISTS `tb_pembatalan_inventaris`;

CREATE TABLE `tb_pembatalan_inventaris` (
  `id_inventaris` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `id_transaksi` varchar(250) DEFAULT NULL,
  `nomor_seri` varchar(250) DEFAULT NULL,
  `nama_barang` varchar(250) DEFAULT NULL,
  `nominal` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_inventaris`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pembatalan_inventaris_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pembatalan_inventaris` */

insert  into `tb_pembatalan_inventaris`(`id_inventaris`,`id_cabang`,`kode_form`,`id_transaksi`,`nomor_seri`,`nama_barang`,`nominal`,`alasan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`status_pincab`,`status_pembukuan`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`izin_edit`,`created_at`,`updated_at`) values 
(1,3,'Kc.wsb/Btx-Inv/2023-1','39332106','11036','BUKU TABUNGAN','30000','SALAH KIRIM','reza_09',NULL,NULL,'ABDUL','REza','Renard','Pincab','pembukuan','Dirops','Approve','Approve','Approve','Selesai','2023-06-08 10:54:48','2023-06-08 10:54:50','2023-06-08 16:42:32','2023-06-08 16:42:32','YA','TIDAK',NULL,'2023-06-08 09:30:44','2023-06-08 16:42:32'),
(2,3,'Kc.wsb/Btx-Inv/2023-2','00325500','003200','SURAT PEMBUKUAN','880000','SALH KIRIM','rexa_001',NULL,NULL,'TAUFIQ','Pembukuan','Renard','Pincab','Pembukuan ok','DIrops OKe','Approve','Approve','Reject','Ditolak','2023-06-08 11:01:58','2023-06-08 14:24:15','2023-06-08 16:45:45','2023-06-08 16:45:45','Bukan Pelanggaran','Bukan Pelanggaran',NULL,'2023-06-08 09:55:33','2023-06-08 16:45:45'),
(3,3,'Kc.wsb/Btx-Inv/2023-3','852','uio','oiu','752','jyg','jyg',NULL,'ABDUL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Izinkan','2023-06-12 16:28:30','2023-06-12 16:34:46'),
(4,1,'KP.KPO/BTT-INV/2024/0001','dd','dd','dd','Rp. 3.224','dd','dd','ddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 14:22:47','2024-01-29 14:22:47'),
(5,1,'KP.KPO/BTT-INV/2024/0002','dd','dd','dd','Rp. 3.224','dd','dd','ddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 14:23:12','2024-01-29 14:23:12'),
(6,1,'KP.KPO/BTT-INV/2024/0003','dd','dd','dd','Rp. 3.224','dd','dd','ddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 14:23:17','2024-01-29 14:23:17'),
(7,1,'KP.KPO/BTT-INV/2024/0004','dd','dd','dd','Rp. 3.224','dd','dd','ddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 14:23:22','2024-01-29 14:23:22'),
(8,1,'KP.KPO/BTT-INV/2024/0005','ID.3051520','SR-40512','Mc book','Rp. 1.000.000','kesalahan input nominal','eka','Harusnya 10 jt. kurang 0 satu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 14:23:36','2024-01-29 14:29:16');

/*Table structure for table `tb_pembatalan_kredit` */

DROP TABLE IF EXISTS `tb_pembatalan_kredit`;

CREATE TABLE `tb_pembatalan_kredit` (
  `id_kredit` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `jns_kredit` varchar(250) DEFAULT NULL,
  `id_transaksi` varchar(250) DEFAULT NULL,
  `no_rek` varchar(250) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `nominal` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kredit`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pembatalan_kredit_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pembatalan_kredit` */

insert  into `tb_pembatalan_kredit`(`id_kredit`,`id_cabang`,`kode_form`,`jns_kredit`,`id_transaksi`,`no_rek`,`nama`,`nominal`,`alasan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`status_pincab`,`status_pembukuan`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`izin_edit`,`created_at`,`updated_at`) values 
(1,3,'Kc.wsb/Btx-Kdt/2023-1','Transaksi Autodebet Kredit','5559','2205','TQZA','5255559','NOT9','','',NULL,'TAUFIQ',NULL,NULL,NULL,NULL,NULL,'Approve',NULL,NULL,'Proses','2023-06-20 17:05:14',NULL,NULL,NULL,NULL,NULL,'Izinkan','2023-06-16 10:33:49','2023-06-20 17:05:14'),
(2,1,'KP.KPO/BTT-KRD/2024/0001','Transaksi Autodebet Kredit','TR.001','RK.001','Eka001','Rp. 100.000.001','salah input001','-','-001',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 16:55:20','2024-01-29 16:55:20'),
(3,1,'KP.KPO/BTT-KRD/2024/0002','LY.002','TR.002','yanto002','edo002','Rp. 40.000.002','kebanyakan 002','dini002','hehehe002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 16:54:32','2024-01-29 16:54:32'),
(4,1,'KP.KPO/BTT-KRD/2024/0003','Transaksi Manual Kredit','TMK003','RK.003','nisa003','Rp. 19.000.003','salah e003','eka003','hahaha003',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-29 16:53:24','2024-01-29 16:55:55');

/*Table structure for table `tb_pembatalan_tabungan` */

DROP TABLE IF EXISTS `tb_pembatalan_tabungan`;

CREATE TABLE `tb_pembatalan_tabungan` (
  `id_tabungan` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `id_transaksi` varchar(250) DEFAULT NULL,
  `no_rek` varchar(250) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `nominal` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tabungan`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_pembatalan_tabungan_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pembatalan_tabungan` */

insert  into `tb_pembatalan_tabungan`(`id_tabungan`,`id_cabang`,`kode_form`,`id_transaksi`,`no_rek`,`nama`,`nominal`,`alasan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`status_pincab`,`status_pembukuan`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`izin_edit`,`created_at`,`updated_at`) values 
(1,3,'Kc.wsb/Btx-Tbg/2023-1','002351408','02877728','REZA8','580008','TIDAK ADA','ifnus22',NULL,'ABDUL','TAUFIQ',NULL,NULL,'PIncab OKWE',NULL,NULL,'Approve',NULL,NULL,'Proses','2023-06-16 16:11:33',NULL,NULL,NULL,NULL,NULL,'','2023-06-16 15:05:26','2023-06-16 16:11:33'),
(2,1,'KP.KPO/BTT-TBG/2024/0001','TRS.001','NR.001','AN.Ika','Rp. 10.000','salah input','endang','tidak ada',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-30 10:35:14','2024-01-30 10:35:14'),
(3,1,'KP.KPO/BTT-TBG/2024/0002','TRS.001','NR.001','AN.Ika','Rp. 10.000','salah input','endang','tidak ada',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-30 10:35:19','2024-01-30 10:35:19'),
(4,1,'KP.KPO/BTT-TBG/2024/0003','TRS.001','NR.001','AN.Ika','Rp. 10.000','salah input','endang','tidak ada',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-30 10:35:21','2024-01-30 10:35:21'),
(5,1,'KP.KPO/BTT-TBG/2024/0004','TRS.004','NR.004','AN.Ika4','Rp. 10.004','salah input4','endang4','tidak ada4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-30 11:03:59','2024-01-30 11:03:59');

/*Table structure for table `tb_perubahan_cif` */

DROP TABLE IF EXISTS `tb_perubahan_cif`;

CREATE TABLE `tb_perubahan_cif` (
  `id_cif` int(11) NOT NULL AUTO_INCREMENT,
  `kode_form` varchar(100) DEFAULT NULL,
  `id_cabang` int(10) DEFAULT NULL,
  `jns_cif` varchar(250) DEFAULT NULL,
  `nama_nasabah` varchar(200) DEFAULT NULL,
  `no_cif_utama` varchar(250) DEFAULT NULL,
  `no_cif_merger` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `ktp` varchar(250) DEFAULT NULL,
  `nama_ibu` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `catatan_tsi` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_tsi` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(50) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(10) DEFAULT NULL,
  `pelanggaran_dirops` varchar(10) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cif`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_perubahan_cif_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_perubahan_cif` */

insert  into `tb_perubahan_cif`(`id_cif`,`kode_form`,`id_cabang`,`jns_cif`,`nama_nasabah`,`no_cif_utama`,`no_cif_merger`,`alasan`,`ktp`,`nama_ibu`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`nama_tsi`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`catatan_tsi`,`status_pincab`,`status_pembukuan`,`status_tsi`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_tsi`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`izin_edit`,`created_at`,`updated_at`) values 
(4,'Kc.wsb/Pbn-Cif/2023-4',3,'Pengkinian Data CIF','AA','AAA','',NULL,'user profil.png','A',NULL,'ABDUL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-06-19 15:23:45','2023-06-19 15:23:45'),
(5,'Kc.wsb/Pbn-Cif/2023-5',3,'Merger CIF','ELSA Frozen','33112','1,2,3','Banyak akun','null','null',NULL,'ABDUL','TAUFIQ','Pembukuan','Renard','Abdul Taufiq','pincab panggah okey','data oke - DiACC Oleh Admin Pembukuan Pada 2023-06-20 10:27:49','OK','okkkk','Approve','Edited','Approve','Approve','Selesai','2023-06-20 09:03:46','2023-06-20 10:27:49','2023-06-20 10:36:25','2023-06-20 10:29:25','2023-06-20 10:29:25',NULL,NULL,'Izinkan','2023-06-19 16:24:15','2023-06-20 10:36:25'),
(6,'Kc.wsb/Pbn-Cif/2023-6',3,'Merger CIF','REXA','224','22, 11','oop',NULL,'null',NULL,'ABDUL','TAUFIQ','Pembukuan',NULL,NULL,NULL,'Ditolak gak lengkap - Ditolak Oleh Admin Pembukuan Pada 2023-06-20 10:28:38',NULL,NULL,'Approve','Reject',NULL,NULL,'Ditolak','2023-06-20 09:03:57','2023-06-20 10:28:38',NULL,NULL,'2023-06-20 10:28:38',NULL,NULL,NULL,'2023-06-19 16:27:57','2023-06-20 10:28:42'),
(21,'KP.KPO/BTT-CIF/2024/0001',1,'Merger CIF','ns','ncu','ci1','al',NULL,NULL,'ket',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-30 16:57:12','2024-01-30 16:57:12'),
(22,'KP.KPO/PRT-CIF/2024/0002',1,'Merger CIF','ns1','ncu','ncm1','al',NULL,'-','ket',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-30 17:00:22','2024-01-30 17:00:22'),
(23,'KP.KPO/PRT-CIF/2024/0003',1,'Merger CIF','x','x','x1, x2','z',NULL,'-','x',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-30 17:01:29','2024-01-30 17:01:29'),
(24,'KP.KPO/PRT-CIF/2024/0004',1,'Pengkinian Data CIF','xx1','xx1','-','-','Screenshot 2024-01-25 084551.png','x1','x1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 09:42:49','2024-01-31 09:42:49'),
(25,'KP.KPO/PRT-CIF/2024/0005',1,'Merger CIF','xxxxx1323','xxx1232','872, 873, 874','-232','-','-','x13212',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 09:41:40','2024-01-31 09:41:40');

/*Table structure for table `tb_perubahan_deposito` */

DROP TABLE IF EXISTS `tb_perubahan_deposito`;

CREATE TABLE `tb_perubahan_deposito` (
  `id_deposito` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(100) DEFAULT NULL,
  `jns_deposito` varchar(250) DEFAULT NULL,
  `no_rek` varchar(250) DEFAULT NULL,
  `nama_nasabah` varchar(250) DEFAULT NULL,
  `data_salah` varchar(250) DEFAULT NULL,
  `pembetulan` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(200) DEFAULT NULL,
  `nama_pincab` varchar(200) DEFAULT NULL,
  `nama_pembukuan` varchar(200) DEFAULT NULL,
  `nama_dirops` varchar(200) DEFAULT NULL,
  `nama_tsi` varchar(200) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `catatan_tsi` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_tsi` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(50) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `pelanggaran_tsi` varchar(50) DEFAULT NULL,
  `izin_edit` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_deposito`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_perubahan_deposito_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_perubahan_deposito` */

insert  into `tb_perubahan_deposito`(`id_deposito`,`id_cabang`,`kode_form`,`jns_deposito`,`no_rek`,`nama_nasabah`,`data_salah`,`pembetulan`,`alasan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`nama_tsi`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`catatan_tsi`,`status_pincab`,`status_pembukuan`,`status_tsi`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_tsi`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`pelanggaran_tsi`,`izin_edit`,`created_at`,`updated_at`) values 
(1,3,'Kc.wsb/Pbn-Dep/2023-1','Jangka Waktu','110220','h0','00','0-0','j0','j0','j0','ABDUL','TAUFIQ','Pembukuan','Renard',NULL,'oke deh pincab','Pembukkuan OK - DiACC Oleh Admin Pembukuan Pada 2023-06-21 13:17:18','Dirops Ok',NULL,'Approve','Approve',NULL,'Approve','Selesai','2023-06-21 11:31:33','2023-06-21 13:31:33',NULL,'2023-06-21 13:20:01','2023-06-21 13:20:01','Pelanggaran','Pelanggaran',NULL,'Izinkan','2023-06-21 11:08:41','2023-06-21 13:31:33'),
(3,1,'KP.KPO/PRT-DPS/2024/0001','Jangka Waktu','xxx','xxx','xx','xxx','xx','xx','xx','Dummy Kasi Operasional',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 15:55:59','2024-01-31 15:55:59'),
(4,1,'KP.KPO/PRT-DPS/2024/0002','Jangka Waktu','xxx','xxx','xx','xxx','xx','xx','xx','Dummy Kasi Operasional',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 15:56:02','2024-01-31 15:56:02'),
(5,1,'KP.KPO/PRT-DPS/2024/0003','Jangka Waktu','xxx','xxx','xx','xxx','xx','xx','xx','Dummy Kasi Operasional',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 15:56:12','2024-01-31 15:56:12'),
(6,1,'KP.KPO/PRT-DPS/2024/0004','Valuta dan Suku Bunga','21','21',NULL,NULL,'22','22','22','Dummy Kasi Operasional',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 16:45:13','2024-01-31 16:45:13'),
(7,1,'KP.KPO/PRT-DPS/2024/0005','xxcx','xxx','xxxx','dxxx','hxxx','22xxx','222xx','222xx','Dummy Kasi Operasional',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 17:59:09','2024-01-31 17:59:09');

/*Table structure for table `tb_perubahan_kredit` */

DROP TABLE IF EXISTS `tb_perubahan_kredit`;

CREATE TABLE `tb_perubahan_kredit` (
  `id_kredit` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `id_agunan` varchar(250) DEFAULT NULL,
  `kode_form` varchar(100) DEFAULT NULL,
  `jns_kredit` varchar(250) DEFAULT NULL,
  `no_rek` varchar(250) DEFAULT NULL,
  `nama_nasabah` varchar(250) DEFAULT NULL,
  `data_salah` varchar(250) DEFAULT NULL,
  `pembetulan` varchar(250) DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_pembukuan` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `catatan_pincab` varchar(1000) DEFAULT NULL,
  `catatan_pembukuan` varchar(1000) DEFAULT NULL,
  `catatan_dirops` varchar(1000) DEFAULT NULL,
  `catatan_tsi` varchar(1000) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_tsi` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(50) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `pelanggaran_tsi` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  PRIMARY KEY (`id_kredit`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_perubahan_kredit_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_perubahan_kredit` */

insert  into `tb_perubahan_kredit`(`id_kredit`,`id_cabang`,`id_agunan`,`kode_form`,`jns_kredit`,`no_rek`,`nama_nasabah`,`data_salah`,`pembetulan`,`alasan`,`keterangan`,`user`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`nama_tsi`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`catatan_tsi`,`status_pincab`,`status_pembukuan`,`status_tsi`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_tsi`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`pelanggaran_tsi`,`created_at`,`updated_at`,`izin_edit`) values 
(1,3,'','Kc.wsb/Pbn-Kre/2023-1','Lainnya','14te','bggte','wwe','wwe','099te','779te','i9te','ABDUL','TAUFIQ',NULL,NULL,NULL,'oke pincab',NULL,NULL,NULL,'Approve',NULL,NULL,NULL,'Proses','2023-06-20 17:10:25',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-06-20 15:34:07','2023-06-21 10:21:15','Tolak'),
(5,1,NULL,'KP.KPO/PRT-KRD/2024/0001','Cara Angsur','NR1',NULL,'DS','DP','ALP','KET','U1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 11:54:13','2024-01-31 11:54:13',NULL),
(6,1,'-','KP.KPO/PRT-KRD/2024/0002','xxx','ss','ss',NULL,NULL,'ss','ss','ss','Dummy Kasi Operasional',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 17:23:04','2024-01-31 17:23:04',NULL),
(7,1,'dddd','KP.KPO/PRT-KRD/2024/0003','Data Agunan','XX','XXx',' - ',' - ','XX','X','X','Dummy Kasi Operasional',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 14:08:43','2024-01-31 14:08:43',NULL);

/*Table structure for table `tb_siadit_perubahan` */

DROP TABLE IF EXISTS `tb_siadit_perubahan`;

CREATE TABLE `tb_siadit_perubahan` (
  `id_siadit_perubahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(100) DEFAULT NULL,
  `keperluan` varchar(250) DEFAULT NULL,
  `no_spk` varchar(250) DEFAULT NULL,
  `nama_nasabah` varchar(250) DEFAULT NULL,
  `data_salah` varchar(450) DEFAULT NULL,
  `pembetulan` varchar(450) DEFAULT NULL,
  `user` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_kaops` varchar(200) DEFAULT NULL,
  `nama_pincab` varchar(200) DEFAULT NULL,
  `nama_pembukuan` varchar(200) DEFAULT NULL,
  `nama_dirops` varchar(200) DEFAULT NULL,
  `nama_tsi` varchar(200) DEFAULT NULL,
  `catatan_pincab` varchar(350) DEFAULT NULL,
  `catatan_pembukuan` varchar(350) DEFAULT NULL,
  `catatan_dirops` varchar(350) DEFAULT NULL,
  `catatan_tsi` varchar(350) DEFAULT NULL,
  `status_pincab` varchar(50) DEFAULT NULL,
  `status_pembukuan` varchar(50) DEFAULT NULL,
  `status_tsi` varchar(50) DEFAULT NULL,
  `status_dirops` varchar(50) DEFAULT NULL,
  `status_akhir` varchar(50) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_pembukuan` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `pelanggaran_pembukuan` varchar(50) DEFAULT NULL,
  `pelanggaran_dirops` varchar(50) DEFAULT NULL,
  `pelanggaran_tsi` varchar(50) DEFAULT NULL,
  `izin_edit` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_siadit_perubahan`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_siadit_perubahan_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_siadit_perubahan` */

insert  into `tb_siadit_perubahan`(`id_siadit_perubahan`,`id_cabang`,`kode_form`,`keperluan`,`no_spk`,`nama_nasabah`,`data_salah`,`pembetulan`,`user`,`keterangan`,`nama_kaops`,`nama_pincab`,`nama_pembukuan`,`nama_dirops`,`nama_tsi`,`catatan_pincab`,`catatan_pembukuan`,`catatan_dirops`,`catatan_tsi`,`status_pincab`,`status_pembukuan`,`status_tsi`,`status_dirops`,`status_akhir`,`tgl_status_pincab`,`tgl_status_pembukuan`,`tgl_status_tsi`,`tgl_status_dirops`,`tgl_status_akhir`,`pelanggaran_pembukuan`,`pelanggaran_dirops`,`pelanggaran_tsi`,`izin_edit`,`created_at`,`updated_at`) values 
(3,1,'KP.KPO/SIADIT-R/2024/0001','Penghapusan Data SPK','spk  002','nsaabah','salah','betul','user','keterangan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 14:41:36','2024-01-22 14:41:36'),
(4,1,'KP.KPO/SiAdit-R/2024/0002','Perubahan Data SPK','NO SPK','COba 1','ajuan butuh pembetulan','pembetulannya','pelaku_1','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 13:50:30','2024-01-22 13:50:30'),
(5,1,'KP.KPO/SiAdit-R/2024/0003','Penghapusan Data SPK','SPK/001','Arianto','data salah','data betul','user_pelaku','tidak ada keterangan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-22 14:34:14','2024-01-22 14:34:14');

/*Table structure for table `tb_siadit_user` */

DROP TABLE IF EXISTS `tb_siadit_user`;

CREATE TABLE `tb_siadit_user` (
  `id_siadit_user` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `aktif` date DEFAULT NULL,
  `non_aktif` date DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `status_pincab` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `nama_sdm` varchar(250) DEFAULT NULL,
  `status_sdm` varchar(20) DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `catatan_sdm` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `status_dirops` varchar(20) DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `catatan_dirops` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `status_tsi` varchar(20) DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `catatan_tsi` varchar(250) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `kabid` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_siadit_user`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_siadit_user_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_siadit_user` */

insert  into `tb_siadit_user`(`id_siadit_user`,`id_cabang`,`kode_form`,`keperluan`,`nik`,`nama`,`jabatan`,`no_telp`,`keterangan`,`aktif`,`non_aktif`,`nama_pincab`,`status_pincab`,`tgl_status_pincab`,`nama_sdm`,`status_sdm`,`tgl_status_sdm`,`catatan_sdm`,`nama_dirops`,`status_dirops`,`tgl_status_dirops`,`catatan_dirops`,`nama_tsi`,`status_tsi`,`tgl_status_tsi`,`catatan_tsi`,`status_akhir`,`tgl_status_akhir`,`izin_edit`,`kabid`,`created_at`,`updated_at`) values 
(31,1,'Kp.kpo/SiAdit-P/2024/0001','Alternate User','2508808','Taufiq','Kakom','0821354545','menggantikan user Analis Karena sakit',NULL,'0000-00-00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 15:41:46','2024-01-19 15:41:46'),
(32,1,'KP.KPO/SiAdit-P/2024/0002','Pengajuan User Baru','1212','eko','spi','084546545','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 17:26:04','2024-01-19 17:26:04'),
(33,1,'KP.KPO/SiAdit-P/2024/0003','Alternate User','33','fsd','34','242','da',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 17:59:28','2024-01-19 17:59:28'),
(34,1,'KP.KPO/SiAdit-P/2024/0004','Pengajuan User Baru','3420000','dwadxxx','dawxxx','24210000','xxxx',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:01:07','2024-01-19 19:38:52'),
(35,1,'KP.KPO/SiAdit-P/2024/0005','Penghapusan User','5505410','Ultramen','Staff','08213536695','karyawan baru',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:37:06','2024-01-20 16:22:19'),
(36,1,'KP.KPO/SiAdit-P/2024/0006','Pengajuan User Baru','424','22','22','22','22',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:44:41','2024-01-19 18:44:41'),
(37,1,'KP.KPO/SiAdit-P/2024/0007','Alternate User','444','44','44','44','44','2024-01-19','2024-01-20',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:45:10','2024-01-19 18:45:10'),
(38,1,'KP.KPO/SiAdit-P/2024/0008','Alternate User','888','88','88','88','88','2024-01-19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-19 18:45:32','2024-01-19 18:45:32');

/*Table structure for table `tb_slik` */

DROP TABLE IF EXISTS `tb_slik`;

CREATE TABLE `tb_slik` (
  `id_slik` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `kode_form` varchar(50) DEFAULT NULL,
  `no_kode` varchar(50) DEFAULT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `jabatan` varchar(250) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_pincab` varchar(250) DEFAULT NULL,
  `nama_sdm` varchar(250) DEFAULT NULL,
  `nama_dirops` varchar(250) DEFAULT NULL,
  `nama_tsi` varchar(250) DEFAULT NULL,
  `status_pincab` varchar(20) DEFAULT NULL,
  `status_sdm` varchar(20) DEFAULT NULL,
  `status_dirops` varchar(20) DEFAULT NULL,
  `status_tsi` varchar(20) DEFAULT NULL,
  `status_akhir` varchar(20) DEFAULT NULL,
  `tgl_status_pincab` datetime DEFAULT NULL,
  `tgl_status_dirops` datetime DEFAULT NULL,
  `tgl_status_sdm` datetime DEFAULT NULL,
  `tgl_status_tsi` datetime DEFAULT NULL,
  `tgl_status_akhir` datetime DEFAULT NULL,
  `catatan_sdm` varchar(250) DEFAULT NULL,
  `catatan_dirops` varchar(250) DEFAULT NULL,
  `catatan_tsi` varchar(250) DEFAULT NULL,
  `izin_edit` enum('Izinkan','Tolak','Pengajuan') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_slik`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `tb_slik_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_slik` */

insert  into `tb_slik`(`id_slik`,`id_cabang`,`kode_form`,`no_kode`,`keperluan`,`nik`,`nama`,`jabatan`,`no_telp`,`keterangan`,`nama_pincab`,`nama_sdm`,`nama_dirops`,`nama_tsi`,`status_pincab`,`status_sdm`,`status_dirops`,`status_tsi`,`status_akhir`,`tgl_status_pincab`,`tgl_status_dirops`,`tgl_status_sdm`,`tgl_status_tsi`,`tgl_status_akhir`,`catatan_sdm`,`catatan_dirops`,`catatan_tsi`,`izin_edit`,`created_at`,`updated_at`) values 
(18,1,'KP.KPO/USLIK-P/2024/0001',NULL,'Permohonan User Baru','330501550','Widianto','IA','628213531425','tidak ada',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 19:30:19','2024-01-31 19:30:19'),
(19,1,'KP.KPO/USLIK-P/2024/0002',NULL,'Permohonan User Baru','330501550','Widianto','IA','628213531425','tidak ada',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 19:30:24','2024-01-31 19:30:24'),
(20,1,'KP.KPO/USLIK-P/2024/0003',NULL,'Permohonan User Baru','330501550','Widianto','IA','628213531425','tidak ada',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 19:30:29','2024-01-31 19:30:29'),
(21,1,'KP.KPO/USLIK-P/2024/0004',NULL,'Permohonan User Baru','330501550','Widianto','IA','628213531425','tidak ada',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 19:30:31','2024-01-31 19:30:31'),
(22,1,'KP.KPO/USLIK-P/2024/0005',NULL,'Permohonan User Baru','330111111','Widiantoro_1','IA_1','62821353111111','tidak ada_11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-31 19:30:38','2024-01-31 19:34:47');

/*Table structure for table `tb_tracking` */

DROP TABLE IF EXISTS `tb_tracking`;

CREATE TABLE `tb_tracking` (
  `id_tracking` int(10) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `id_reset` int(10) DEFAULT NULL,
  `id_pengajuan` int(10) DEFAULT NULL,
  `id_msop` int(10) DEFAULT NULL,
  `id_msor` int(10) DEFAULT NULL,
  `id_fix` int(10) DEFAULT NULL,
  `id_del` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tracking`),
  KEY `tb_tracking_ibfk_1` (`id_reset`),
  KEY `id_cabang` (`id_cabang`),
  KEY `tb_tracking_ibfk_3` (`id_pengajuan`),
  KEY `id_fix` (`id_fix`),
  KEY `id_del` (`id_del`),
  CONSTRAINT `tb_tracking_ibfk_1` FOREIGN KEY (`id_reset`) REFERENCES `tb_email_r` (`id_reset`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_tracking_ibfk_2` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_tracking_ibfk_3` FOREIGN KEY (`id_pengajuan`) REFERENCES `tb_email_p` (`id_pengajuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_tracking_ibfk_4` FOREIGN KEY (`id_fix`) REFERENCES `tb_mso_perubahan` (`id_fix`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_tracking_ibfk_5` FOREIGN KEY (`id_del`) REFERENCES `tb_mso_pembatalan` (`id_del`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_tracking` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `username_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_uniqe` (`email`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/* Trigger structure for table `permission_access_tokens` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `access_tokens` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `access_tokens` BEFORE UPDATE ON `permission_access_tokens` FOR EACH ROW BEGIN
	IF new.now <= new.date THEN
		SET new.status = 'is_active';
	ELSE
		SET new.status = 'is_deactive';
	END IF;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
