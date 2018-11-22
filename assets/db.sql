/*
SQLyog Community v11.52 (64 bit)
MySQL - 10.1.32-MariaDB : Database - mlab
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mlab` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mlab`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `altmobile` varchar(250) DEFAULT NULL,
  `gstin` varchar(250) DEFAULT NULL,
  `address1` varchar(250) DEFAULT NULL,
  `address2` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `zipcode` varchar(250) DEFAULT NULL,
  `accrediations` varchar(250) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `org_password` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT '0',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`a_id`,`role`,`name`,`email`,`mobile`,`altmobile`,`gstin`,`address1`,`address2`,`city`,`state`,`country`,`zipcode`,`accrediations`,`profile_pic`,`password`,`org_password`,`status`,`created_at`,`updated_at`,`created_by`) values (1,1,'Admin','admin@gmail.com','8500050944','8019345212','123sds','kadapa','mydikur','mydukur','Andhra Pradesh','india','516172','cvxc','1540984309.jpg','e10adc3949ba59abbe56e057f20f883e','123456',1,'2018-10-31 14:38:39','2018-10-31 19:00:04',1),(2,2,'maxcure','maxcure@gmail.com','8500050944','8019345212','123sdsdd','kothapalli ','','mydukur','Andhra Pradesh','india','516172','cv',NULL,'e10adc3949ba59abbe56e057f20f883e','123456',1,'2018-10-31 18:12:31','2018-11-01 10:34:40',1),(3,2,'vasudevareddy','test@gmail.com','8500050944','8019345212','123sds','kadapa','','mydukur','Andhra Pradesh','india','516172','vvvv',NULL,'e10adc3949ba59abbe56e057f20f883e','123456',1,'2018-10-31 18:12:31','2018-10-31 19:09:36',1),(4,3,'vasudevareddy','testing123@gmail.com','8500050944','8019345212','123sds','kadapa','','mydukur','Karnataka','india','516172','rrr',NULL,'e10adc3949ba59abbe56e057f20f883e','123456',1,'2018-10-31 19:26:07','2018-11-01 10:33:55',1);

/*Table structure for table `lab_cart` */

DROP TABLE IF EXISTS `lab_cart`;

CREATE TABLE `lab_cart` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT '0',
  `package_id` int(11) DEFAULT '0',
  `type` int(11) DEFAULT '1' COMMENT '1=test;0=package',
  `l_id` int(11) DEFAULT NULL,
  `test_duartion` varchar(250) DEFAULT NULL,
  `delivery_charge` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `org_amount` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `percentage` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `lab_cart` */

insert  into `lab_cart`(`c_id`,`a_id`,`test_id`,`package_id`,`type`,`l_id`,`test_duartion`,`delivery_charge`,`amount`,`org_amount`,`qty`,`discount`,`percentage`,`status`,`created_at`,`updated_at`,`created_by`) values (11,1,0,2,0,2,NULL,'0.00','450.00','500.00',1,'50.00','10.00',1,'2018-11-22 14:46:32','2018-11-22 14:46:32',1);

/*Table structure for table `lab_order_items` */

DROP TABLE IF EXISTS `lab_order_items`;

CREATE TABLE `lab_order_items` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `l_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `delivery_charge` decimal(10,2) DEFAULT NULL,
  `total_amt` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `org_amount` decimal(10,2) DEFAULT NULL,
  `percentage` decimal(10,2) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `lab_status` int(11) DEFAULT '0' COMMENT '0=pending;1=success',
  `crerated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `lab_order_items` */

insert  into `lab_order_items`(`order_item_id`,`order_id`,`a_id`,`test_id`,`l_id`,`package_id`,`delivery_charge`,`total_amt`,`amount`,`org_amount`,`percentage`,`payment_type`,`status`,`lab_status`,`crerated_at`,`updated_at`,`created_by`) values (7,16,1,0,2,1,'0.00','500.00','500.00','1000.00','50.00',0,1,0,'2018-11-19 12:44:18','2018-11-19 12:44:18',1),(8,17,1,1,2,0,'45.00','245.00','200.00','0.00','0.00',0,1,0,'2018-11-19 12:45:31','2018-11-19 12:45:31',1),(9,17,1,2,2,0,'45.00','145.00','100.00','0.00','0.00',0,1,0,'2018-11-19 12:45:31','2018-11-19 12:45:31',1),(10,18,1,0,2,1,'0.00','500.00','500.00','1000.00','50.00',0,1,0,'2018-11-19 13:02:33','2018-11-19 13:02:33',1),(11,19,1,1,2,0,'45.00','245.00','200.00','0.00','0.00',0,1,0,'2018-11-19 13:05:01','2018-11-19 13:05:01',1),(12,19,1,2,2,0,'45.00','145.00','100.00','0.00','0.00',0,1,0,'2018-11-19 13:05:01','2018-11-19 13:05:01',1),(13,20,1,1,2,0,'45.00','245.00','200.00','0.00','0.00',1,1,0,'2018-11-21 16:24:13','2018-11-21 16:24:13',1),(14,20,1,2,2,0,'45.00','145.00','100.00','0.00','0.00',1,1,0,'2018-11-21 16:24:14','2018-11-21 16:24:14',1),(15,21,1,0,2,1,'0.00','500.00','500.00','1000.00','50.00',0,1,0,'2018-11-22 14:14:51','2018-11-22 14:14:51',1);

/*Table structure for table `lab_orders` */

DROP TABLE IF EXISTS `lab_orders`;

CREATE TABLE `lab_orders` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT '0' COMMENT '1=online;2=cashon delivery;3=swipe on delivery',
  `patient_details_id` int(11) DEFAULT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `razorpay_payment_id` varchar(250) DEFAULT NULL,
  `razorpay_order_id` varchar(250) DEFAULT NULL,
  `razorpay_signature` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `lab_orders` */

insert  into `lab_orders`(`r_id`,`a_id`,`payment_type`,`patient_details_id`,`billing_id`,`razorpay_payment_id`,`razorpay_order_id`,`razorpay_signature`,`status`,`created_at`,`updated_at`,`created_by`) values (1,1,1,NULL,5,'pay_BMAKd0TOXr7o6G','order_BMAGmd2sRKMBc2','cca43176dfcd48347d4d2b5f11a4612ad70cb276edfa8bf5d31ed73357846275',1,'2018-11-15 17:19:31','2018-11-15 17:19:31',1),(2,1,1,NULL,5,'pay_BMAKd0TOXr7o6G','order_BMAGmd2sRKMBc2','cca43176dfcd48347d4d2b5f11a4612ad70cb276edfa8bf5d31ed73357846275',1,'2018-11-15 17:23:47','2018-11-15 17:23:47',1),(3,1,1,NULL,5,'pay_BMAKd0TOXr7o6G','order_BMAGmd2sRKMBc2','cca43176dfcd48347d4d2b5f11a4612ad70cb276edfa8bf5d31ed73357846275',1,'2018-11-15 17:45:55','2018-11-15 17:45:55',1),(4,1,1,NULL,5,'pay_BMAKd0TOXr7o6G','order_BMAGmd2sRKMBc2','cca43176dfcd48347d4d2b5f11a4612ad70cb276edfa8bf5d31ed73357846275',1,'2018-11-15 17:47:41','2018-11-15 17:47:41',1),(5,1,1,13,1,'pay_BMTfkTjACNNzXF','order_BMTfdUkZQdGDCQ','0c203ac028002a5e44463c2dad00e836ce051cfc6ac7cea987e11d7662be5203',1,'2018-11-16 12:09:54','2018-11-16 12:09:54',1),(6,1,2,14,1,'','','',1,'2018-11-16 12:44:54','2018-11-16 12:44:54',1),(7,1,1,20,3,'pay_BNep08Q3piWxXK','order_BNeo44OCespYKX','996030294940d0e506860505d72aa93fc978c1523a73095a91aec312d3961b91',1,'2018-11-19 11:42:17','2018-11-19 11:42:17',1),(8,1,3,22,5,'','','',1,'2018-11-19 12:36:25','2018-11-19 12:36:25',1),(9,1,3,22,5,'','','',1,'2018-11-19 12:36:54','2018-11-19 12:36:54',1),(10,1,3,22,5,'','','',1,'2018-11-19 12:38:14','2018-11-19 12:38:14',1),(11,1,3,22,5,'','','',1,'2018-11-19 12:38:31','2018-11-19 12:38:31',1),(12,1,3,22,5,'','','',1,'2018-11-19 12:39:17','2018-11-19 12:39:17',1),(13,1,3,22,5,'','','',1,'2018-11-19 12:40:46','2018-11-19 12:40:46',1),(14,1,3,22,5,'','','',1,'2018-11-19 12:41:27','2018-11-19 12:41:27',1),(15,1,3,22,5,'','','',1,'2018-11-19 12:43:52','2018-11-19 12:43:52',1),(16,1,3,22,5,'','','',1,'2018-11-19 12:44:17','2018-11-19 12:44:17',1),(17,1,1,23,1,'pay_BNftnUWoXwkKgx','order_BNftejRid6g3HD','8ef43866a848aefee1c8aa9f007ac6d584af78066a16a29e8e11cf76a91476ca',1,'2018-11-19 12:45:31','2018-11-19 12:45:31',1),(18,1,1,24,1,'pay_BNgBmMpoj0RVgQ','order_BNgBd3LEDGj4GA','5d2a83f465ea7c3251cb17953a964c3c0f7a4469c10ada1f20af33b9dc654fe4',1,'2018-11-19 13:02:33','2018-11-19 13:02:33',1),(19,1,3,25,1,'','','',1,'2018-11-19 13:05:01','2018-11-19 13:05:01',1),(20,1,1,28,8,'pay_BNep08Q3piWxXK','1','',1,'2018-11-21 16:24:12','2018-11-21 16:24:12',1),(21,1,1,30,7,'pay_BOt1O8bfQHYDv6','order_BOt128vXDHqY0b','a6109fe8cfe0b23c69da4b5b5145f14142c6c3c4663ff11c8eb1a19fd711813c',1,'2018-11-22 14:14:50','2018-11-22 14:14:50',1);

/*Table structure for table `lab_patient_billing` */

DROP TABLE IF EXISTS `lab_patient_billing`;

CREATE TABLE `lab_patient_billing` (
  `l_t_b_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `locality` varchar(250) DEFAULT NULL,
  `pincode` varchar(45) DEFAULT NULL,
  `address` text,
  `landmark` varchar(250) DEFAULT NULL,
  `address_lable` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`l_t_b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `lab_patient_billing` */

insert  into `lab_patient_billing`(`l_t_b_id`,`patient_id`,`a_id`,`mobile`,`locality`,`pincode`,`address`,`landmark`,`address_lable`,`status`,`created_at`,`updated_at`,`created_by`) values (1,NULL,1,'8500050944','Locality','516172','kothapalli village  khajipet  mandal','kothappali','Work',1,'2018-11-06 14:28:43','2018-11-06 14:28:43',1),(2,NULL,1,'8500050944','Locality','516172','kothapalli  vil  kadapa dist','kothappali','Home',1,'2018-11-06 16:22:14','2018-11-06 16:22:14',1),(3,NULL,1,'8500050944','Locality','516172','asu','kothappali','Home',1,'2018-11-06 16:37:30','2018-11-06 16:37:30',1),(4,NULL,41,'8500050944','Locality','516172','gfghfh','kothappali','Home',1,'2018-11-15 11:17:53','2018-11-15 11:17:53',41),(5,NULL,1,'8500050944','Locality','516172','testing','kothappali','Work',1,'2018-11-15 17:09:58','2018-11-15 17:09:58',1),(6,12,1,'8500050944','Locality','516172','ddsf','dsfsdf','Work',1,'2018-11-15 18:44:08','2018-11-15 18:44:08',1),(7,NULL,1,'1234567890','testq','500072','testing like  this','testing  like  this','Work',1,'2018-11-21 14:14:59','2018-11-21 14:14:59',1),(8,NULL,1,'8019345212','kukatpalli','500072','shesadri nagar','community hall','room address',1,'2018-11-21 14:35:40','2018-11-21 14:35:40',1);

/*Table structure for table `lab_patient_details` */

DROP TABLE IF EXISTS `lab_patient_details`;

CREATE TABLE `lab_patient_details` (
  `l_t_a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) DEFAULT NULL,
  `date` varchar(250) DEFAULT NULL,
  `time` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `age` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `gender` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`l_t_a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `lab_patient_details` */

insert  into `lab_patient_details`(`l_t_a_id`,`a_id`,`date`,`time`,`name`,`mobile`,`age`,`email`,`gender`,`status`,`created_at`,`updated_at`,`created_by`) values (1,1,NULL,'06:30 am','vasudevareddy','8500050944','26','admin@gmail.com','Male',1,'2018-11-06 12:54:42','2018-11-06 12:54:42',1),(2,1,'','','','8500050944','','','',1,'2018-11-06 14:20:53','2018-11-06 14:20:53',1),(3,1,'2018-11-06','07:00 am','vasudevareddy','8500050944','26','admin@gmail.com','Male',1,'2018-11-06 16:07:51','2018-11-06 16:07:51',1),(4,1,'2018-11-06','06:30 am','vasudevareddy','8500050944','26','admin@gmail.com','Male',1,'2018-11-06 16:14:00','2018-11-06 16:14:00',1),(5,1,'2018-11-06','06:30 am','vasudevareddy','8500050944','26','admin@gmail.com','Male',1,'2018-11-06 16:17:40','2018-11-06 16:17:40',1),(6,1,'2018-11-06','06:00 am','vasudevareddy','8500050944','26','admin@gmail.com','Female',1,'2018-11-06 16:20:14','2018-11-06 16:20:14',1),(7,41,'2018-11-15','06:00 am','vasudevareddy','8500050944','26','admin@gmail.com','Male',1,'2018-11-15 11:17:39','2018-11-15 11:17:39',41),(8,1,'2018-11-15','06:00 am','Ajay','8500050944','26','adminvasu@gmail.com','Male',1,'2018-11-15 17:09:34','2018-11-15 17:09:34',1),(9,1,'2018-11-15','06:00 am','patient details','8500050944','26','patient@gmail.com','Male',1,'2018-11-15 18:27:49','2018-11-15 18:27:49',1),(12,1,'2018-11-22','06:00 am','dabur','8688683222','26','dabur@gmail.com','Female',1,'2018-11-15 18:40:05','2018-11-15 18:40:05',1),(13,1,'2018-11-16','06:00 am','vasudevareddy','8500050944','26','adminxczx@gmail.com','Female',1,'2018-11-16 11:16:05','2018-11-16 11:16:05',1),(14,1,'2018-11-16','06:00 am','Admin','8500050944','26','admin@gmail.com','Male',1,'2018-11-16 12:44:43','2018-11-16 12:44:43',1),(15,1,'2018-11-16','06:00 am','Admin','8500050944','26','admin@gmail.com','Female',1,'2018-11-16 17:54:41','2018-11-16 17:54:41',1),(16,1,'2018-11-19','06:30 am','Admin','8500050944','26','admin@gmail.com','Male',1,'2018-11-19 10:26:31','2018-11-19 10:26:31',1),(17,1,'2018-11-19','01:30 pm','Admin','8500050944','26','admin@gmail.com','Female',1,'2018-11-19 10:35:05','2018-11-19 10:35:05',1),(18,1,'2018-11-19','06:00 am','vasudeva reddy r','8500050944','26','admin@gmail.com','Male',1,'2018-11-19 11:05:35','2018-11-19 11:05:35',1),(19,1,'2018-11-19','06:30 am','Admin','8500050944','26','admin@gmail.com','Male',1,'2018-11-19 11:34:29','2018-11-19 11:34:29',1),(20,1,'2018-11-20','09:30 am','56','8500050944','56','56@gmail.com','Male',1,'2018-11-19 11:36:43','2018-11-19 11:36:43',1),(21,1,'2018-11-20','06:30 am','testing like that','8500050944','29','admintesting@gmail.com','Male',1,'2018-11-19 12:31:06','2018-11-19 12:31:06',1),(22,1,'2018-11-20','07:30 am','vassudevareddy','8500050944','32','admintesting@gmail.com','Male',1,'2018-11-19 12:35:26','2018-11-19 12:35:26',1),(23,1,'2018-11-21','07:00 am','raghu','8500050944','29','raghu@gmail.com','Male',1,'2018-11-19 12:45:15','2018-11-19 12:45:15',1),(24,1,'2018-11-20','09:30 am','pushkar','8500050944','22','admin@gmail.com','Male',1,'2018-11-19 13:02:13','2018-11-19 13:02:13',1),(25,1,'2018-11-20','11:30 am','raghu','8500050944','25','raghu@gmail.com','Male',1,'2018-11-19 13:04:52','2018-11-19 13:04:52',1),(26,1,'2018-11-06','07:00 am','vasudevareddy','8500050944','26','test@gmail.com','Male',1,'2018-11-21 13:00:35','2018-11-21 13:00:35',1),(27,1,'2018-11-06','07:00 am','vasudevareddy','8500050944','26','test@gmail.com','Male',1,'2018-11-21 13:12:00','2018-11-21 13:12:00',1),(28,1,'2018-11-22','11:00 am','testing','8500050944','24','admintest@gmail.com','Male',1,'2018-11-21 14:13:57','2018-11-21 14:13:57',1),(29,1,'2018-11-22','07:00 am','Admin','8500050944','269','admincvcv@gmail.com','Male',1,'2018-11-22 13:48:07','2018-11-22 13:48:07',1),(30,1,'2018-11-22','07:00 am','Admin','8500050944','26','admin@gmail.com','Male',1,'2018-11-22 14:13:59','2018-11-22 14:13:59',1);

/*Table structure for table `lab_tests` */

DROP TABLE IF EXISTS `lab_tests`;

CREATE TABLE `lab_tests` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_id` int(11) DEFAULT NULL,
  `test_type` varchar(250) DEFAULT NULL,
  `test_name` varchar(250) DEFAULT NULL,
  `test_duartion` varchar(250) DEFAULT NULL,
  `test_amount` varchar(250) DEFAULT NULL,
  `delivery_charge` varchar(250) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `lab_tests` */

insert  into `lab_tests`(`l_id`,`lab_id`,`test_type`,`test_name`,`test_duartion`,`test_amount`,`delivery_charge`,`discount`,`status`,`created_at`,`updated_at`,`created_by`) values (1,2,'test','like','10','200','45',NULL,1,'2018-11-01 17:34:06','2018-11-02 13:00:08',2),(2,2,'test','like that','20','100','45',NULL,1,'2018-11-01 17:39:08','2018-11-02 13:00:41',2),(3,3,'thoride','sugar','10 min','250','25',NULL,1,'2018-11-02 17:21:32','2018-11-02 17:21:32',3),(4,3,'thoride','blood','30 min','300','25',NULL,1,'2018-11-02 17:21:49','2018-11-02 17:21:49',3),(5,2,'All','boold','30 min','120','20',NULL,1,'2018-11-19 15:47:22','2018-11-19 15:47:22',2);

/*Table structure for table `packages_test_list` */

DROP TABLE IF EXISTS `packages_test_list`;

CREATE TABLE `packages_test_list` (
  `p_t_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_t_p_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `packages_test_list` */

insert  into `packages_test_list`(`p_t_id`,`l_t_p_id`,`test_id`,`status`,`created_at`,`updated_at`,`created_by`) values (1,1,1,1,'2018-11-02 14:38:49','2018-11-02 18:48:51',2),(2,1,2,1,'2018-11-02 14:38:49','2018-11-22 11:50:20',2),(3,2,1,1,'2018-11-02 14:39:30','2018-11-02 18:50:05',2),(4,1,2,0,'2018-11-02 17:02:29','2018-11-22 11:36:06',2),(5,1,2,0,'2018-11-02 17:02:42','2018-11-22 11:36:06',2),(6,2,2,0,'2018-11-02 17:06:49','2018-11-22 11:36:06',2),(7,3,3,1,'2018-11-02 17:22:13','2018-11-02 18:51:45',3),(8,4,3,1,'2018-11-02 17:22:34','2018-11-02 18:51:50',3),(9,8,4,1,'2018-11-02 17:22:34','2018-11-02 17:22:34',3);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

insert  into `role`(`r_id`,`role`,`status`,`created_at`) values (1,'Amin',1,NULL),(2,'Seller',1,NULL),(3,'Pharmacy',1,NULL);

/*Table structure for table `test_packages` */

DROP TABLE IF EXISTS `test_packages`;

CREATE TABLE `test_packages` (
  `l_t_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_id` int(11) DEFAULT NULL,
  `test_package_name` varchar(250) DEFAULT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `discount` varchar(250) DEFAULT NULL,
  `percentage` varchar(250) DEFAULT NULL,
  `instruction` text,
  `delivery_charge` decimal(10,2) DEFAULT NULL,
  `reports_time` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`l_t_p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `test_packages` */

insert  into `test_packages`(`l_t_p_id`,`lab_id`,`test_package_name`,`amount`,`discount`,`percentage`,`instruction`,`delivery_charge`,`reports_time`,`status`,`created_at`,`updated_at`,`created_by`) values (1,2,'pack1','1000','500','50.00%','testing  mode',NULL,'10 ',1,'2018-11-02 14:38:49','2018-11-02 18:48:51',2),(2,2,'pack2','500','50','10.00%','same  as  above',NULL,'30 ',1,'2018-11-02 14:39:30','2018-11-02 18:50:05',2),(3,3,'bpack1','1000','500','50.00%','testing  mode',NULL,'20 ',1,'2018-11-02 17:22:13','2018-11-02 18:51:45',3),(4,3,'bpack2','10033','500','4.98%','testing  mode dfd',NULL,'30',1,'2018-11-02 17:22:34','2018-11-02 18:51:50',3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
