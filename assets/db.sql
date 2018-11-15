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

insert  into `admin`(`a_id`,`role`,`name`,`email`,`mobile`,`altmobile`,`gstin`,`address1`,`address2`,`city`,`state`,`country`,`zipcode`,`profile_pic`,`password`,`org_password`,`status`,`created_at`,`updated_at`,`created_by`) values (1,1,'Admin','admin@gmail.com','8500050944','8019345212','123sds','kadapa','mydikur','mydukur','Andhra Pradesh','india','516172','1540984309.jpg','e10adc3949ba59abbe56e057f20f883e','123456',1,'2018-10-31 14:38:39','2018-10-31 19:00:04',1),(2,2,'maxcure','maxcure@gmail.com','8500050944','8019345212','123sdsdd','kothapalli ','','mydukur','Andhra Pradesh','india','516172',NULL,'e10adc3949ba59abbe56e057f20f883e','123456',1,'2018-10-31 18:12:31','2018-11-01 10:34:40',1),(3,2,'vasudevareddy','test@gmail.com','8500050944','8019345212','123sds','kadapa','','mydukur','Andhra Pradesh','india','516172',NULL,'e10adc3949ba59abbe56e057f20f883e','123456',1,'2018-10-31 18:12:31','2018-10-31 19:09:36',1),(4,3,'vasudevareddy','testing123@gmail.com','8500050944','8019345212','123sds','kadapa','','mydukur','Karnataka','india','516172',NULL,'e10adc3949ba59abbe56e057f20f883e','123456',1,'2018-10-31 19:26:07','2018-11-01 10:33:55',1);

/*Table structure for table `lab_cart` */

DROP TABLE IF EXISTS `lab_cart`;

CREATE TABLE `lab_cart` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `l_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `delivery_charge` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `lab_cart` */

insert  into `lab_cart`(`c_id`,`a_id`,`test_id`,`l_id`,`qty`,`delivery_charge`,`status`,`created_at`,`updated_at`,`created_by`) values (22,1,1,2,0,NULL,1,'2018-11-06 16:02:07','2018-11-06 16:02:07',1),(23,1,2,2,0,NULL,1,'2018-11-06 19:06:11','2018-11-06 19:06:11',1);

/*Table structure for table `lab_order_items` */

DROP TABLE IF EXISTS `lab_order_items`;

CREATE TABLE `lab_order_items` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `l_id` int(11) DEFAULT NULL,
  `delivery_charge` varchar(250) DEFAULT NULL,
  `total_amt` varchar(250) DEFAULT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `crerated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `lab_order_items` */

/*Table structure for table `lab_orders` */

DROP TABLE IF EXISTS `lab_orders`;

CREATE TABLE `lab_orders` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT '0' COMMENT '1=online;2=cashon delivery;3=swipe on delivery',
  `billing_id` int(11) DEFAULT NULL,
  `razorpay_payment_id` varchar(250) DEFAULT NULL,
  `razorpay_order_id` varchar(250) DEFAULT NULL,
  `razorpay_signature` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `lab_orders` */

/*Table structure for table `lab_patient_billing` */

DROP TABLE IF EXISTS `lab_patient_billing`;

CREATE TABLE `lab_patient_billing` (
  `l_t_b_id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `lab_patient_billing` */

insert  into `lab_patient_billing`(`l_t_b_id`,`a_id`,`mobile`,`locality`,`pincode`,`address`,`landmark`,`address_lable`,`status`,`created_at`,`updated_at`,`created_by`) values (1,1,'8500050944','Locality','516172','kothapalli village  khajipet  mandal','kothappali','Work',1,'2018-11-06 14:28:43','2018-11-06 14:28:43',1),(2,1,'8500050944','Locality','516172','kothapalli  vil  kadapa dist','kothappali','Home',1,'2018-11-06 16:22:14','2018-11-06 16:22:14',1),(3,1,'8500050944','Locality','516172','asu','kothappali','Home',1,'2018-11-06 16:37:30','2018-11-06 16:37:30',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `lab_patient_details` */

insert  into `lab_patient_details`(`l_t_a_id`,`a_id`,`date`,`time`,`name`,`mobile`,`age`,`email`,`gender`,`status`,`created_at`,`updated_at`,`created_by`) values (1,1,NULL,'06:30 am','vasudevareddy','8500050944','26','admin@gmail.com','Male',1,'2018-11-06 12:54:42','2018-11-06 12:54:42',1),(2,1,'','','','8500050944','','','',1,'2018-11-06 14:20:53','2018-11-06 14:20:53',1),(3,1,'2018-11-06','07:00 am','vasudevareddy','8500050944','26','admin@gmail.com','Male',1,'2018-11-06 16:07:51','2018-11-06 16:07:51',1),(4,1,'2018-11-06','06:30 am','vasudevareddy','8500050944','26','admin@gmail.com','Male',1,'2018-11-06 16:14:00','2018-11-06 16:14:00',1),(5,1,'2018-11-06','06:30 am','vasudevareddy','8500050944','26','admin@gmail.com','Male',1,'2018-11-06 16:17:40','2018-11-06 16:17:40',1),(6,1,'2018-11-06','06:00 am','vasudevareddy','8500050944','26','admin@gmail.com','Female',1,'2018-11-06 16:20:14','2018-11-06 16:20:14',1);

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
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `lab_tests` */

insert  into `lab_tests`(`l_id`,`lab_id`,`test_type`,`test_name`,`test_duartion`,`test_amount`,`delivery_charge`,`status`,`created_at`,`updated_at`,`created_by`) values (1,2,'test','like','10','200','45',1,'2018-11-01 17:34:06','2018-11-02 13:00:08',2),(2,2,'test','like that','20','100','45',1,'2018-11-01 17:39:08','2018-11-02 13:00:41',2),(3,3,'thoride','sugar','10 min','250','25',1,'2018-11-02 17:21:32','2018-11-02 17:21:32',3),(4,3,'thoride','blood','30 min','300','25',1,'2018-11-02 17:21:49','2018-11-02 17:21:49',3);

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

insert  into `packages_test_list`(`p_t_id`,`l_t_p_id`,`test_id`,`status`,`created_at`,`updated_at`,`created_by`) values (1,1,1,1,'2018-11-02 14:38:49','2018-11-02 18:48:51',2),(2,1,2,2,'2018-11-02 14:38:49','2018-11-02 16:58:37',2),(3,2,1,1,'2018-11-02 14:39:30','2018-11-02 18:50:05',2),(4,1,2,2,'2018-11-02 17:02:29','2018-11-02 17:02:36',2),(5,1,2,1,'2018-11-02 17:02:42','2018-11-02 18:48:51',2),(6,2,2,1,'2018-11-02 17:06:49','2018-11-02 18:50:05',2),(7,3,3,1,'2018-11-02 17:22:13','2018-11-02 18:51:45',3),(8,4,3,1,'2018-11-02 17:22:34','2018-11-02 18:51:50',3),(9,8,4,1,'2018-11-02 17:22:34','2018-11-02 17:22:34',3);

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
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`l_t_p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `test_packages` */

insert  into `test_packages`(`l_t_p_id`,`lab_id`,`test_package_name`,`amount`,`discount`,`percentage`,`instruction`,`status`,`created_at`,`updated_at`,`created_by`) values (1,2,'pack1','1000','500','50.00%','testing  mode',1,'2018-11-02 14:38:49','2018-11-02 18:48:51',2),(2,2,'pack2','500','50','10.00%','same  as  above',1,'2018-11-02 14:39:30','2018-11-02 18:50:05',2),(3,3,'bpack1','1000','500','50.00%','testing  mode',1,'2018-11-02 17:22:13','2018-11-02 18:51:45',3),(4,3,'bpack2','10033','500','4.98%','testing  mode dfd',1,'2018-11-02 17:22:34','2018-11-02 18:51:50',3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
