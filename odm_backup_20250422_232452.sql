-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: avid
-- ------------------------------------------------------
-- Server version	5.7.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `odm_2fa_tokens`
--

DROP TABLE IF EXISTS `odm_2fa_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_2fa_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL,
  `used` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `token` (`token`),
  CONSTRAINT `odm_2fa_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `odm_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_2fa_tokens`
--

LOCK TABLES `odm_2fa_tokens` WRITE;
/*!40000 ALTER TABLE `odm_2fa_tokens` DISABLE KEYS */;
INSERT INTO `odm_2fa_tokens` VALUES (1,11,'908526','2025-03-29 02:23:00','2025-03-29 02:28:00',0),(2,9,'654192','2025-03-29 03:41:57','2025-03-29 03:46:57',0),(3,9,'241089','2025-03-29 03:42:58','2025-03-29 03:47:58',0),(4,9,'387620','2025-03-29 03:43:10','2025-03-29 03:48:10',0),(5,9,'982673','2025-03-29 03:43:53','2025-03-29 03:48:53',0),(6,9,'283705','2025-03-29 03:44:02','2025-03-29 03:49:02',0),(7,9,'487635','2025-03-29 03:57:57','2025-03-29 04:02:57',0),(8,9,'613509','2025-03-29 04:00:24','2025-03-29 04:05:24',0),(9,9,'278630','2025-03-29 04:00:28','2025-03-29 04:05:28',0),(10,9,'342751','2025-03-29 04:01:00','2025-03-29 04:06:00',0),(11,11,'864531','2025-03-29 04:08:35','2025-03-29 04:13:35',0),(12,11,'781095','2025-03-29 04:17:40','2025-03-29 04:22:40',1),(13,11,'798130','2025-03-29 04:33:34','2025-03-29 04:38:34',0),(14,11,'671809','2025-03-29 04:54:31','2025-03-29 04:59:31',0),(15,11,'360971','2025-03-29 04:59:44','2025-03-29 05:04:44',0),(16,11,'750423','2025-03-29 05:04:23','2025-03-29 05:09:23',0),(17,11,'592607','2025-03-29 05:07:41','2025-03-29 05:12:41',0),(18,9,'618073','2025-03-29 06:13:13','2025-03-29 06:18:13',0),(19,9,'012479','2025-03-29 06:15:54','2025-03-29 06:20:54',0),(20,9,'084725','2025-03-29 17:54:43','2025-03-29 17:59:43',0);
/*!40000 ALTER TABLE `odm_2fa_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_access_log`
--

DROP TABLE IF EXISTS `odm_access_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_access_log` (
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` enum('A','B','C','V','D','M','X','I','O','Y','R') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_access_log`
--

LOCK TABLES `odm_access_log` WRITE;
/*!40000 ALTER TABLE `odm_access_log` DISABLE KEYS */;
INSERT INTO `odm_access_log` VALUES (25,1,'2025-03-19 20:46:14','A'),(26,1,'2025-03-19 20:48:21','A'),(26,1,'2025-03-19 20:57:35','X'),(25,1,'2025-03-19 20:57:39','X'),(27,1,'2025-03-19 20:57:52','A'),(27,1,'2025-03-19 20:58:58','X'),(28,1,'2025-03-19 21:00:08','A'),(26,1,'2025-03-19 21:00:45','V'),(27,1,'2025-03-19 21:00:53','V'),(28,1,'2025-03-19 21:01:07','X'),(29,1,'2025-03-19 21:17:29','A'),(30,1,'2025-03-19 21:25:16','A'),(30,1,'2025-03-19 21:29:30','D'),(30,1,'2025-03-19 21:29:51','X'),(29,1,'2025-03-19 21:29:53','X'),(31,1,'2025-03-19 22:13:37','A'),(31,1,'2025-03-19 22:14:59','M'),(31,1,'2025-03-19 22:17:07','Y'),(32,1,'2025-03-19 22:19:36','A'),(32,1,'2025-03-19 22:20:17','Y'),(31,1,'2025-03-19 22:20:40','M'),(33,1,'2025-03-19 22:23:06','A'),(33,1,'2025-03-19 22:23:43','Y'),(34,1,'2025-03-19 22:25:16','A'),(34,1,'2025-03-19 22:25:46','Y'),(35,1,'2025-03-19 22:27:52','A'),(35,1,'2025-03-19 22:28:20','Y'),(31,1,'2025-03-19 22:30:07','M'),(32,1,'2025-03-19 22:30:21','M'),(33,1,'2025-03-19 22:30:34','M'),(34,1,'2025-03-19 22:30:48','M'),(35,1,'2025-03-19 22:31:02','M'),(36,1,'2025-03-19 22:32:53','A'),(36,1,'2025-03-19 22:33:26','Y'),(37,1,'2025-03-19 22:35:15','A'),(37,1,'2025-03-19 22:35:48','Y'),(38,1,'2025-03-19 22:37:56','A'),(38,1,'2025-03-19 22:38:52','Y'),(39,1,'2025-03-19 22:40:59','A'),(39,1,'2025-03-19 22:41:27','Y'),(40,1,'2025-03-19 22:43:18','A'),(40,1,'2025-03-19 22:43:53','Y'),(41,1,'2025-03-19 22:45:15','A'),(41,1,'2025-03-19 22:45:34','Y'),(42,1,'2025-03-19 22:47:28','A'),(42,1,'2025-03-19 22:47:55','Y'),(43,1,'2025-03-19 22:49:24','A'),(43,1,'2025-03-19 22:49:42','Y'),(44,1,'2025-03-19 22:52:30','A'),(45,1,'2025-03-19 22:54:13','A'),(44,1,'2025-03-19 22:55:09','M'),(45,1,'2025-03-19 22:55:34','M'),(44,1,'2025-03-19 22:56:48','Y'),(44,1,'2025-03-19 22:57:13','M'),(45,1,'2025-03-19 22:57:36','Y'),(45,1,'2025-03-19 22:58:00','M'),(44,1,'2025-03-19 22:58:47','M'),(33,1,'2025-03-19 22:59:52','O'),(33,1,'2025-03-19 22:59:52','D'),(31,1,'2025-03-19 23:14:30','M'),(46,1,'2025-03-19 23:33:27','A'),(45,1,'2025-03-20 00:00:55','V'),(45,10,'2025-03-20 00:02:45','V'),(44,9,'2025-03-20 00:21:00','M'),(31,1,'2025-03-20 06:38:52','M'),(32,1,'2025-03-20 06:39:30','M'),(32,1,'2025-03-20 06:39:36','M'),(34,1,'2025-03-20 06:40:17','M'),(35,1,'2025-03-20 06:40:38','M'),(36,1,'2025-03-20 06:41:03','M'),(37,1,'2025-03-20 06:42:09','M'),(38,1,'2025-03-20 06:42:38','M'),(39,1,'2025-03-20 06:42:59','M'),(40,1,'2025-03-20 06:43:28','M'),(41,1,'2025-03-20 06:43:50','M'),(42,1,'2025-03-20 06:44:10','M'),(43,1,'2025-03-20 06:45:08','M'),(44,1,'2025-03-20 06:45:33','M'),(45,1,'2025-03-20 06:46:00','M'),(47,1,'2025-03-20 06:48:51','A'),(48,1,'2025-03-20 06:51:36','A'),(47,1,'2025-03-20 06:52:21','Y'),(48,1,'2025-03-20 06:52:21','Y'),(47,1,'2025-03-20 06:53:10','V'),(42,1,'2025-03-20 17:06:15','M'),(34,1,'2025-03-21 02:41:39','M'),(49,1,'2025-03-25 22:18:07','A'),(49,1,'2025-03-25 22:19:14','V'),(50,1,'2025-03-26 20:03:12','A'),(50,1,'2025-03-26 20:03:35','Y'),(51,1,'2025-03-26 20:20:47','A'),(51,1,'2025-03-26 20:21:18','Y'),(49,1,'2025-03-26 20:21:42','R'),(35,1,'2025-03-26 20:54:26','V'),(52,1,'2025-03-26 20:56:49','A'),(52,1,'2025-03-26 20:57:16','Y'),(52,1,'2025-03-26 20:57:39','V'),(35,1,'2025-03-26 20:58:43','X'),(53,1,'2025-03-30 00:33:18','A'),(53,1,'2025-03-30 00:33:54','Y'),(44,1,'2025-03-30 19:31:02','X'),(45,1,'2025-03-30 19:31:56','X'),(54,1,'2025-04-01 22:05:04','A'),(54,1,'2025-04-01 22:05:35','Y');
/*!40000 ALTER TABLE `odm_access_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_admin`
--

DROP TABLE IF EXISTS `odm_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_admin` (
  `id` int(10) unsigned DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_admin`
--

LOCK TABLES `odm_admin` WRITE;
/*!40000 ALTER TABLE `odm_admin` DISABLE KEYS */;
INSERT INTO `odm_admin` VALUES (4,1),(1,1),(5,1),(6,1),(7,1),(9,1),(10,1),(11,1),(12,1);
/*!40000 ALTER TABLE `odm_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_category`
--

DROP TABLE IF EXISTS `odm_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_category`
--

LOCK TABLES `odm_category` WRITE;
/*!40000 ALTER TABLE `odm_category` DISABLE KEYS */;
INSERT INTO `odm_category` VALUES (2,'Training Manual'),(6,'Purchase Orders'),(4,'Presentation'),(5,'User Guides'),(7,'Invoices'),(8,'Quotes'),(9,'Setup Forms'),(10,'Request A Demonstration'),(11,'Data Slicks'),(12,'Smart Money Group Folder'),(13,'RST Technology Folder'),(14,'Channel Sales'),(15,'Legal'),(16,'Promotional'),(17,'DirectRM Inc Folder'),(18,'Financial '),(19,'Research and Development'),(20,'Product Brochures'),(21,'Network Diagrams');
/*!40000 ALTER TABLE `odm_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_data`
--

DROP TABLE IF EXISTS `odm_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(10) unsigned NOT NULL DEFAULT '0',
  `odm_udftbl_Medi_primary` int(11) DEFAULT NULL,
  `odm_udftbl_Medi_secondary` int(11) DEFAULT NULL,
  `odm_udftbl_Impor_primary` int(11) DEFAULT NULL,
  `odm_udftbl_Impor_secondary` int(11) DEFAULT NULL,
  `odm_udftbl_onboa_primary` int(11) DEFAULT NULL,
  `odm_udftbl_onboa_secondary` int(11) DEFAULT NULL,
  `odm_udftbl_Arch_primary` int(11) DEFAULT NULL,
  `odm_udftbl_Arch_secondary` int(11) DEFAULT NULL,
  `odm_udftbl_ranso` int(11) DEFAULT NULL,
  `odm_udftbl_ranso_primary` int(11) DEFAULT NULL,
  `odm_udftbl_ranso_secondary` int(11) DEFAULT NULL,
  `owner` int(10) unsigned DEFAULT NULL,
  `realname` varchar(255) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT '',
  `status` smallint(6) DEFAULT NULL,
  `department` smallint(5) unsigned DEFAULT NULL,
  `default_rights` tinyint(4) DEFAULT NULL,
  `publishable` tinyint(4) DEFAULT NULL,
  `reviewer` int(10) unsigned DEFAULT NULL,
  `reviewer_comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_idx` (`id`,`owner`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `publishable` (`publishable`),
  KEY `description` (`description`(200))
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_data`
--

LOCK TABLES `odm_data` WRITE;
/*!40000 ALTER TABLE `odm_data` DISABLE KEYS */;
INSERT INTO `odm_data` VALUES (31,12,1,NULL,2,NULL,5,NULL,1,NULL,4,4,0,9,'Smart Money Channel Sales for SaaS.pdf','2025-03-19 22:13:37','Document Management for SaaS','Marketing for Channel',0,10,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved for Publication;'),(32,12,1,NULL,2,NULL,5,NULL,1,NULL,4,5,0,9,'Smart Money ERP New Fetures.pdf','2025-03-19 22:19:36','Smart Money ERP New features','New Version with New Features',0,10,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved for Publication;'),(33,12,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,4,4,0,9,'Smart Money ERP.pdf','2025-03-19 22:23:06','Smart Money ERP','New Release',1,10,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved for Distribution;'),(34,9,1,NULL,2,NULL,5,NULL,1,NULL,4,4,0,9,'Smart Money Setup Form.pdf','2025-03-19 22:25:16','Smart Money Customer Set-Up Form','Smart Money Customer Set-Up Form',0,8,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved;'),(35,12,5,NULL,2,NULL,5,NULL,1,NULL,4,4,0,9,'Smart Money Document Management Power Point.pptx','2025-03-19 22:27:52','Smart Money Document Management Power Point','Smart Money Document Management Power Point',0,10,0,2,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved;'),(36,12,1,NULL,1,NULL,5,NULL,2,0,4,4,0,9,'Smart Money Document Management P_L Report Fiscal Year 2024.pdf','2025-03-19 22:32:52','Smart Money Document Management 2024 P&L Report','Confidential',0,12,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Confidential;'),(37,15,1,NULL,2,NULL,5,NULL,1,0,4,4,0,9,'Smart Money MNDA.pdf','2025-03-19 22:35:15','Smart Money MNDA','MNDA',0,8,0,1,1,'To= Author(s);Subject=Smart Money MNDA;Comments=Smart Money MNDA;'),(38,12,1,NULL,2,NULL,5,NULL,1,0,4,4,0,9,'Smart Money Document Management Vs SharePoint.pdf','2025-03-19 22:37:56','Smart Money Document Management Vs. Sharepoint','Testimonial',0,10,0,1,1,'To= Author(s);Subject=Smart Money Document Management Vs. SharePoint;Comments=Smart Money Document Management Vs. SharePoint;'),(39,12,1,NULL,1,NULL,5,NULL,1,0,4,4,0,9,'Smart Money Document Management Pricing.pdf','2025-03-19 22:40:59','Smart Money Document Management Pricing','New Pricing Schedule',0,8,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved;'),(40,14,1,NULL,2,NULL,5,NULL,1,0,4,4,0,9,'Smart Money Document Management Specs and Features.pdf','2025-03-19 22:43:18','Smart Money Document Management Features and Specs','Smart Money Document Management Features and Specs',0,10,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved for Publication;'),(41,12,1,NULL,2,NULL,5,NULL,1,0,4,4,0,9,'TOP 11 REASONS TO SUBSCRIBE TO SMART MONEY DOCUMENT MANAGEMENT.pdf','2025-03-19 22:45:15','Top 11 Reasons to Subscribe to Smart Money Document Management','Top 11 Reasons',0,10,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved;'),(42,5,1,NULL,1,NULL,4,NULL,1,0,4,4,0,9,'Smart Money Document Management User Guide.pdf','2025-03-19 22:47:28','Smart Money Document Management User Guide','User Manual',0,8,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved for Publication;'),(43,16,1,NULL,2,NULL,5,NULL,1,0,4,4,0,9,'Smart Money Group Free 14 Day Trial.pdf','2025-03-19 22:49:24','Document Management 14 Day Trial Promotion','Document Management 14 Day Trial Promotion',0,8,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved;'),(46,12,NULL,NULL,NULL,NULL,1,0,1,0,4,5,0,9,'Smart Money_Overview_Brochure_MySecurity.pdf','2025-03-19 23:33:26','Smart Money Brochure','Overview Brochure',0,10,0,0,NULL,NULL),(54,2,1,0,1,0,4,0,1,0,4,4,0,9,'Smart Money Web and Video User Guide.pdf','2025-04-01 22:05:04','Smart Money Web and Video User Guide','Smart Money Web and Video User Guide',0,10,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=;'),(47,14,2,0,3,0,5,0,1,0,NULL,4,0,9,'Temptation Eyes New Version.mp3','2025-03-20 06:48:51','Temptation Eyes Remake Audio File MP3','Joe\'s Studio Recording',0,9,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved;'),(48,14,3,0,1,0,5,0,1,0,NULL,4,0,1,'Smart Money Document Management User Guide.pdf','2025-03-20 06:51:36','Smart Money Document Management Training Video','https://youtu.be/cjORH9k4KEA',0,10,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved;'),(49,14,1,0,1,0,4,0,1,0,4,4,0,1,'DocuWorks Pricing.pdf','2025-03-25 22:18:07','Docuworks Pricing','Not Approved',0,10,0,-1,1,'To=Author(s);Subject=Rejected Documents;Comments=Rejected;'),(50,2,1,0,1,0,2,0,1,0,4,4,0,9,'Smart ERP User Guide.pdf','2025-03-26 20:03:12','Smart ERP User Guide','Smart ERP User Guide',0,1,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved;'),(51,20,1,0,1,0,2,0,1,0,1,6,0,9,'Smart Money ERP Brochure.pdf','2025-03-26 20:20:47','Smart ERP Brochure','Smart ERP Product Brochure',0,10,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Approved;'),(52,4,1,0,1,0,4,0,1,0,4,5,0,9,'Smart Money Document Management Power Point.pptx','2025-03-26 20:56:49','Smart Money Document Management Power Point II','Power Point II',0,10,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Second Power Point;'),(53,21,5,0,1,0,4,0,1,0,4,4,0,9,'RST Technology Network Diagram.pdf','2025-03-30 00:33:18','RST Technology Network Diagram','Confidential',0,1,0,1,1,'To= Author(s);Subject=Approved Documents by Admin;Comments=Confidential;');
/*!40000 ALTER TABLE `odm_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_department`
--

DROP TABLE IF EXISTS `odm_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_department`
--

LOCK TABLES `odm_department` WRITE;
/*!40000 ALTER TABLE `odm_department` DISABLE KEYS */;
INSERT INTO `odm_department` VALUES (1,'Information Systems'),(8,'Sales'),(9,'Corporate'),(10,'Marketing Department'),(11,'Research & Development'),(12,'Finance Department'),(13,'Human Resources'),(14,'On-Boarding Department'),(15,'Mail Room');
/*!40000 ALTER TABLE `odm_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_dept_perms`
--

DROP TABLE IF EXISTS `odm_dept_perms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_dept_perms` (
  `fid` int(10) unsigned DEFAULT NULL,
  `dept_id` int(10) unsigned DEFAULT NULL,
  `rights` tinyint(4) NOT NULL DEFAULT '0',
  KEY `rights` (`rights`),
  KEY `dept_id` (`dept_id`),
  KEY `fid` (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_dept_perms`
--

LOCK TABLES `odm_dept_perms` WRITE;
/*!40000 ALTER TABLE `odm_dept_perms` DISABLE KEYS */;
INSERT INTO `odm_dept_perms` VALUES (1,1,1),(31,11,0),(31,14,0),(31,10,4),(31,1,4),(31,13,0),(31,12,0),(32,8,4),(32,11,4),(32,14,0),(32,10,4),(32,1,4),(32,13,0),(33,8,4),(33,11,4),(33,10,4),(33,1,4),(33,12,1),(33,9,1),(34,8,4),(34,11,1),(34,14,0),(34,10,4),(34,1,1),(34,13,0),(35,14,0),(35,10,4),(35,1,1),(35,13,0),(35,12,1),(35,9,1),(36,14,0),(36,10,0),(36,1,0),(36,13,0),(36,12,4),(36,9,4),(37,14,0),(37,10,4),(37,1,1),(37,13,0),(37,12,4),(37,9,4),(38,14,0),(38,10,4),(38,1,4),(38,13,0),(38,12,1),(38,9,1),(39,14,0),(39,10,4),(39,1,1),(39,13,0),(39,12,1),(39,9,1),(40,14,0),(40,10,4),(40,1,4),(40,13,0),(40,12,1),(40,9,1),(41,14,0),(41,10,4),(41,1,1),(41,13,0),(41,12,1),(41,9,1),(42,8,1),(42,11,4),(42,14,0),(42,10,4),(42,1,1),(42,13,0),(43,14,0),(43,10,4),(43,1,1),(43,13,0),(43,12,1),(43,9,1),(54,11,4),(54,14,4),(54,10,4),(54,15,0),(54,1,4),(54,13,1),(54,12,1),(31,9,0),(46,9,1),(46,12,1),(46,13,1),(46,1,1),(46,10,1),(46,11,1),(46,8,1),(31,8,4),(32,12,1),(32,9,4),(34,12,1),(34,9,1),(35,11,4),(35,8,4),(36,11,0),(36,8,0),(37,11,4),(37,8,4),(38,11,1),(38,8,4),(39,11,1),(39,8,4),(40,11,4),(40,8,4),(41,11,1),(41,8,4),(42,12,1),(42,9,1),(43,11,1),(43,8,4),(54,8,4),(54,9,1),(47,9,4),(47,12,4),(47,13,4),(47,1,4),(47,10,4),(47,14,4),(47,11,4),(47,8,4),(48,9,4),(48,12,4),(48,13,4),(48,1,4),(48,10,4),(48,14,4),(48,11,4),(48,8,0),(49,9,-1),(49,12,-1),(49,13,-1),(49,1,-1),(49,10,4),(49,14,-1),(49,11,-1),(49,8,4),(50,9,4),(50,12,1),(50,13,4),(50,1,4),(50,15,0),(50,10,4),(50,14,4),(50,11,4),(50,8,4),(51,9,1),(51,12,1),(51,13,1),(51,1,4),(51,15,0),(51,10,4),(51,14,4),(51,11,4),(51,8,4),(52,9,4),(52,12,1),(52,13,1),(52,1,4),(52,15,0),(52,10,4),(52,14,4),(52,11,4),(52,8,4),(53,9,4),(53,12,0),(53,13,0),(53,1,4),(53,15,0),(53,10,4),(53,14,4),(53,11,4),(53,8,4);
/*!40000 ALTER TABLE `odm_dept_perms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_dept_reviewer`
--

DROP TABLE IF EXISTS `odm_dept_reviewer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_dept_reviewer` (
  `dept_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_dept_reviewer`
--

LOCK TABLES `odm_dept_reviewer` WRITE;
/*!40000 ALTER TABLE `odm_dept_reviewer` DISABLE KEYS */;
INSERT INTO `odm_dept_reviewer` VALUES (1,1);
/*!40000 ALTER TABLE `odm_dept_reviewer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_filetypes`
--

DROP TABLE IF EXISTS `odm_filetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_filetypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_filetypes`
--

LOCK TABLES `odm_filetypes` WRITE;
/*!40000 ALTER TABLE `odm_filetypes` DISABLE KEYS */;
INSERT INTO `odm_filetypes` VALUES (1,'image/gif',1),(2,'text/html',1),(3,'text/plain',1),(4,'application/pdf',1),(5,'image/pdf',1),(6,'application/x-pdf',1),(7,'application/msword',1),(8,'image/jpeg',1),(9,'image/pjpeg',1),(10,'image/png',1),(11,'application/msexcel',1),(12,'application/msaccess',1),(13,'text/richtxt',1),(14,'application/mspowerpoint',1),(15,'application/octet-stream',1),(16,'application/x-zip-compressed',1),(17,'application/x-zip',1),(18,'application/zip',1),(19,'image/tiff',1),(20,'image/tif',1),(21,'application/vnd.ms-powerpoint',1),(22,'application/vnd.ms-excel',1),(23,'application/vnd.openxmlformats-officedocument.presentationml.presentation',1),(24,'application/vnd.openxmlformats-officedocument.wordprocessingml.document',1),(25,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',1),(26,'application/vnd.oasis.opendocument.chart',1),(27,'application/vnd.oasis.opendocument.chart-template',1),(28,'application/vnd.oasis.opendocument.formula',1),(29,'application/vnd.oasis.opendocument.formula-template',1),(30,'application/vnd.oasis.opendocument.graphics',1),(31,'application/vnd.oasis.opendocument.graphics-template',1),(32,'application/vnd.oasis.opendocument.image',1),(33,'application/vnd.oasis.opendocument.image-template',1),(34,'application/vnd.oasis.opendocument.presentation',1),(35,'application/vnd.oasis.opendocument.presentation-template',1),(36,'application/vnd.oasis.opendocument.spreadsheet',1),(37,'application/vnd.oasis.opendocument.spreadsheet-template',1),(38,'application/vnd.oasis.opendocument.text',1),(39,'application/vnd.oasis.opendocument.text-master',1),(40,'application/vnd.oasis.opendocument.text-template',1),(41,'application/vnd.oasis.opendocument.text-web',1),(42,'text/csv',1),(43,'audio/mpeg',1),(44,'image/x-dwg',1),(45,'image/x-dfx',1),(46,'drawing/x-dwf',1),(47,'image/svg',1),(48,'video/3gpp',1),(49,'video/mp4',1),(50,'PBIX',1);
/*!40000 ALTER TABLE `odm_filetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_log`
--

DROP TABLE IF EXISTS `odm_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_log` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL,
  `modified_by` varchar(25) DEFAULT NULL,
  `note` text,
  `revision` varchar(255) DEFAULT NULL,
  KEY `id` (`id`),
  KEY `modified_on` (`modified_on`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_log`
--

LOCK TABLES `odm_log` WRITE;
/*!40000 ALTER TABLE `odm_log` DISABLE KEYS */;
INSERT INTO `odm_log` VALUES (34,'2025-03-19 22:25:16','admin','Initial import','current'),(33,'2025-03-19 22:23:06','admin','Initial import','current'),(32,'2025-03-19 22:19:36','admin','Initial import','current'),(31,'2025-03-19 22:13:37','admin','Initial import','current'),(35,'2025-03-19 22:27:52','admin','Initial import','current'),(36,'2025-03-19 22:32:53','admin','Initial import','current'),(37,'2025-03-19 22:35:15','admin','Initial import','current'),(38,'2025-03-19 22:37:56','admin','Initial import','current'),(39,'2025-03-19 22:40:59','admin','Initial import','current'),(40,'2025-03-19 22:43:18','admin','Initial import','current'),(41,'2025-03-19 22:45:15','admin','Initial import','current'),(42,'2025-03-19 22:47:28','admin','Initial import','current'),(43,'2025-03-19 22:49:24','admin','Initial import','current'),(54,'2025-04-01 22:05:04','admin','Initial import','current'),(46,'2025-03-19 23:33:27','admin','Initial import','current'),(47,'2025-03-20 06:48:51','admin','Initial import','current'),(48,'2025-03-20 06:51:36','admin','Initial import','current'),(49,'2025-03-25 22:18:07','admin','Initial import','current'),(50,'2025-03-26 20:03:12','admin','Initial import','current'),(51,'2025-03-26 20:20:47','admin','Initial import','current'),(52,'2025-03-26 20:56:49','admin','Initial import','current'),(53,'2025-03-30 00:33:18','admin','Initial import','current');
/*!40000 ALTER TABLE `odm_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_odmsys`
--

DROP TABLE IF EXISTS `odm_odmsys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_odmsys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sys_name` varchar(16) DEFAULT NULL,
  `sys_value` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_odmsys`
--

LOCK TABLES `odm_odmsys` WRITE;
/*!40000 ALTER TABLE `odm_odmsys` DISABLE KEYS */;
INSERT INTO `odm_odmsys` VALUES (1,'version','1.4.0');
/*!40000 ALTER TABLE `odm_odmsys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_rights`
--

DROP TABLE IF EXISTS `odm_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_rights` (
  `RightId` tinyint(4) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_rights`
--

LOCK TABLES `odm_rights` WRITE;
/*!40000 ALTER TABLE `odm_rights` DISABLE KEYS */;
INSERT INTO `odm_rights` VALUES (0,'none'),(1,'view'),(-1,'forbidden'),(2,'read'),(3,'write'),(4,'admin');
/*!40000 ALTER TABLE `odm_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_settings`
--

DROP TABLE IF EXISTS `odm_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `validation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`(200))
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_settings`
--

LOCK TABLES `odm_settings` WRITE;
/*!40000 ALTER TABLE `odm_settings` DISABLE KEYS */;
INSERT INTO `odm_settings` VALUES (1,'debug','False','(True/False) - Default=False - Debug the installation (not working)','bool'),(2,'demo','False','(True/False) This setting is for a demo installation, where random people will be all loggging in as the same username/password like \"demo/demo\". This will keep users from removing files, users, etc.','bool'),(3,'authen','mysql','(Default = mysql) Currently only MySQL authentication is supported',''),(4,'title','Smart Money Group Outlook and Gmail','This is the browser window title','maxsize=255'),(5,'site_mail','support@smart-moneygroup.com','The email address of the administrator of this site','email|maxsize=255|req'),(6,'root_id','1','This variable sets the root user id.  The root user will be able to access all files and have authority for everything.','num|req'),(7,'dataDir','/var/www/file_store','location of file repository. This should ideally be outside the Web server root. Make sure the server has permissions to read/write files to this folder!. (Examples: Linux - /var/www/document_repository/ : Windows - c:/document_repository/','maxsize=255'),(8,'max_filesize','50000000','Set the maximum file upload size','num|maxsize=255'),(9,'revision_expiration','90','This var sets the amount of days until each file needs to be revised,  assuming that there are 30 days in a month for all months.','num|maxsize=255'),(10,'file_expired_action','3','Choose an action option when a file is found to be expired The first two options also result in sending email to reviewer  (1) Remove from file list until renewed (2) Show in file list but non-checkoutable (3) Send email to reviewer only (4) Do Nothing','num'),(11,'authorization','True','True or False. If set True, every document must be reviewed by an admin before it can go public. To disable set to False. If False, all newly added/checked-in documents will immediately be listed','bool'),(12,'allow_signup','True','Should we display the sign-up link?','bool'),(13,'allow_password_reset','True','Should we allow users to reset their forgotten password?','bool'),(14,'try_nis','False','Attempt NIS password lookups from YP server?','bool'),(15,'theme','default','Which theme to use?',''),(16,'language','english','Set the default language (english, spanish, turkish, etc.). Local users may override this setting. Check include/language folder for languages available','alpha|req'),(17,'max_query','500','Set this to the maximum number of rows you want to be returned in a file listing. If your file list is slow decrease this value.','num'),(18,'smtp_host','smtp.ipower.com','Host of the SMTP mail out server.','maxsize=255'),(19,'smtp_port','587','Port of the SMTP mail out server.','maxsize=255'),(20,'smtp_user','otp@smart-moneygroup.com','The user for the SMTP mail out server, (likely an email address).','maxsize=255'),(21,'smtp_password','Conv3rg3nt','The password for the SMTP mail out server.','maxsize=255');
/*!40000 ALTER TABLE `odm_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udf`
--

DROP TABLE IF EXISTS `odm_udf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(50) DEFAULT NULL,
  `display_name` varchar(16) DEFAULT NULL,
  `field_type` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udf`
--

LOCK TABLES `odm_udf` WRITE;
/*!40000 ALTER TABLE `odm_udf` DISABLE KEYS */;
INSERT INTO `odm_udf` VALUES (1,'odm_udftbl_ranso_primary','Ranson Ware',4),(2,'odm_udftbl_ranso','Scanned',2),(3,'odm_udftbl_Arch_primary','Archived',4),(4,'odm_udftbl_onboa_primary','Onboarding',4),(5,'odm_udftbl_Impor_primary','Importance Level',4),(6,'odm_udftbl_Medi_primary','Media Type',4);
/*!40000 ALTER TABLE `odm_udf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_Arch_primary`
--

DROP TABLE IF EXISTS `odm_udftbl_Arch_primary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_Arch_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_Arch_primary`
--

LOCK TABLES `odm_udftbl_Arch_primary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_Arch_primary` DISABLE KEYS */;
INSERT INTO `odm_udftbl_Arch_primary` VALUES (1,'Files Saved'),(2,'In Progress');
/*!40000 ALTER TABLE `odm_udftbl_Arch_primary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_Arch_secondary`
--

DROP TABLE IF EXISTS `odm_udftbl_Arch_secondary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_Arch_secondary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_id` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_Arch_secondary`
--

LOCK TABLES `odm_udftbl_Arch_secondary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_Arch_secondary` DISABLE KEYS */;
/*!40000 ALTER TABLE `odm_udftbl_Arch_secondary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_Impor_primary`
--

DROP TABLE IF EXISTS `odm_udftbl_Impor_primary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_Impor_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_Impor_primary`
--

LOCK TABLES `odm_udftbl_Impor_primary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_Impor_primary` DISABLE KEYS */;
INSERT INTO `odm_udftbl_Impor_primary` VALUES (1,'High'),(2,'Medium'),(3,'Low');
/*!40000 ALTER TABLE `odm_udftbl_Impor_primary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_Impor_secondary`
--

DROP TABLE IF EXISTS `odm_udftbl_Impor_secondary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_Impor_secondary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_id` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_Impor_secondary`
--

LOCK TABLES `odm_udftbl_Impor_secondary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_Impor_secondary` DISABLE KEYS */;
/*!40000 ALTER TABLE `odm_udftbl_Impor_secondary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_Medi_primary`
--

DROP TABLE IF EXISTS `odm_udftbl_Medi_primary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_Medi_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_Medi_primary`
--

LOCK TABLES `odm_udftbl_Medi_primary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_Medi_primary` DISABLE KEYS */;
INSERT INTO `odm_udftbl_Medi_primary` VALUES (1,'Text'),(2,'Audio'),(3,'Video'),(4,'Streaming'),(5,'Power Point'),(6,'YouTube');
/*!40000 ALTER TABLE `odm_udftbl_Medi_primary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_Medi_secondary`
--

DROP TABLE IF EXISTS `odm_udftbl_Medi_secondary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_Medi_secondary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_id` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_Medi_secondary`
--

LOCK TABLES `odm_udftbl_Medi_secondary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_Medi_secondary` DISABLE KEYS */;
/*!40000 ALTER TABLE `odm_udftbl_Medi_secondary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_onboa_primary`
--

DROP TABLE IF EXISTS `odm_udftbl_onboa_primary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_onboa_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_onboa_primary`
--

LOCK TABLES `odm_udftbl_onboa_primary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_onboa_primary` DISABLE KEYS */;
INSERT INTO `odm_udftbl_onboa_primary` VALUES (1,'Scheduled'),(2,'In Progress'),(3,'LDAP Linked'),(4,'Completed'),(5,'N/A');
/*!40000 ALTER TABLE `odm_udftbl_onboa_primary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_onboa_secondary`
--

DROP TABLE IF EXISTS `odm_udftbl_onboa_secondary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_onboa_secondary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_id` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_onboa_secondary`
--

LOCK TABLES `odm_udftbl_onboa_secondary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_onboa_secondary` DISABLE KEYS */;
/*!40000 ALTER TABLE `odm_udftbl_onboa_secondary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_ranso`
--

DROP TABLE IF EXISTS `odm_udftbl_ranso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_ranso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_ranso`
--

LOCK TABLES `odm_udftbl_ranso` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_ranso` DISABLE KEYS */;
INSERT INTO `odm_udftbl_ranso` VALUES (1,'In Progress'),(2,'Malware Removed'),(3,'Not Checked Yet'),(4,'Clean'),(5,'Malware Found');
/*!40000 ALTER TABLE `odm_udftbl_ranso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_ranso_primary`
--

DROP TABLE IF EXISTS `odm_udftbl_ranso_primary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_ranso_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_ranso_primary`
--

LOCK TABLES `odm_udftbl_ranso_primary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_ranso_primary` DISABLE KEYS */;
INSERT INTO `odm_udftbl_ranso_primary` VALUES (4,'Scanned'),(5,'Clean'),(6,'In Progress');
/*!40000 ALTER TABLE `odm_udftbl_ranso_primary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_udftbl_ranso_secondary`
--

DROP TABLE IF EXISTS `odm_udftbl_ranso_secondary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_udftbl_ranso_secondary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_id` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udftbl_ranso_secondary`
--

LOCK TABLES `odm_udftbl_ranso_secondary` WRITE;
/*!40000 ALTER TABLE `odm_udftbl_ranso_secondary` DISABLE KEYS */;
/*!40000 ALTER TABLE `odm_udftbl_ranso_secondary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_user`
--

DROP TABLE IF EXISTS `odm_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `department` int(10) unsigned DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `pw_reset_code` char(32) DEFAULT NULL,
  `can_add` tinyint(1) DEFAULT '1',
  `can_checkin` tinyint(1) DEFAULT '1',
  `2fa_enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_user`
--

LOCK TABLES `odm_user` WRITE;
/*!40000 ALTER TABLE `odm_user` DISABLE KEYS */;
INSERT INTO `odm_user` VALUES (1,'admin','ae016509b56f5d2867998b15c3d0e560',9,'9494133217','support@smart-moneygroup.com','admin','Administrator',NULL,1,1,0),(9,'jbaggio','ae016509b56f5d2867998b15c3d0e560',9,'9494133217','jbaggio@smart-moneygroup.com','Baggio','Joseph',NULL,1,1,0),(10,'fyamamoto','ae016509b56f5d2867998b15c3d0e560',13,'9493316503','fyamamoto@rsttechnology.com','Yamamoto','Fumiko',NULL,1,1,0),(11,'jopanel','ae016509b56f5d2867998b15c3d0e560',11,'5626686170','josepho@smart-moneygroup.com','Opanel','Joseph',NULL,1,1,0),(12,'jtx','bf7e11da32cea3a2ab42825381baa954',11,'3109908356','jtx@jtxmail.com','Taylor','James',NULL,1,1,0),(13,'thorton','c71fa1b0798694917c1707ffd7182070',9,'1231231234','billybob@thorton.com','Billy','Bob',NULL,1,1,0);
/*!40000 ALTER TABLE `odm_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_user_perms`
--

DROP TABLE IF EXISTS `odm_user_perms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_user_perms` (
  `fid` int(10) unsigned DEFAULT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `rights` tinyint(4) NOT NULL DEFAULT '0',
  KEY `user_perms_idx` (`fid`,`uid`,`rights`),
  KEY `fid` (`fid`),
  KEY `uid` (`uid`),
  KEY `rights` (`rights`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_user_perms`
--

LOCK TABLES `odm_user_perms` WRITE;
/*!40000 ALTER TABLE `odm_user_perms` DISABLE KEYS */;
INSERT INTO `odm_user_perms` VALUES (31,1,4),(31,9,4),(32,1,4),(32,9,4),(33,1,4),(33,9,4),(34,1,4),(34,9,4),(35,1,4),(35,9,4),(36,1,-1),(36,9,4),(37,1,4),(37,9,4),(38,1,4),(38,9,4),(39,1,4),(39,9,4),(40,1,4),(40,9,4),(41,1,4),(41,9,4),(42,1,4),(42,9,4),(43,1,4),(43,9,4),(46,1,4),(46,9,4),(46,10,-1),(47,1,4),(47,9,4),(47,10,4),(47,11,4),(47,12,4),(48,1,4),(48,9,4),(48,10,4),(48,11,4),(48,12,4),(49,1,4),(49,9,4),(50,1,4),(50,9,4),(50,10,4),(50,12,4),(51,1,4),(51,9,4),(51,10,4),(51,12,4),(52,1,4),(52,9,4),(52,10,4),(52,12,4),(53,1,4),(53,9,4),(53,11,-1),(53,12,4),(53,13,-1),(54,1,4),(54,9,4),(54,10,4),(54,12,4),(54,13,-1);
/*!40000 ALTER TABLE `odm_user_perms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-22 23:24:53
