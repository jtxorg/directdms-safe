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
INSERT INTO `odm_access_log` VALUES (1,1,'2024-06-12 13:40:46','A'),(1,1,'2024-06-12 13:40:51','X'),(2,1,'2024-06-12 13:47:39','A'),(2,1,'2024-06-12 13:47:52','X'),(3,1,'2024-06-12 13:56:48','A'),(3,1,'2024-06-12 13:56:58','D'),(4,1,'2024-06-12 13:57:44','A'),(5,1,'2024-06-12 13:59:50','A'),(3,1,'2024-06-12 14:01:16','R'),(4,1,'2024-06-12 14:01:16','R'),(5,1,'2024-06-12 14:01:16','R'),(6,1,'2024-06-12 14:01:27','A'),(6,1,'2024-06-12 14:01:43','X'),(3,1,'2024-06-12 14:02:14','X'),(4,1,'2024-06-12 14:02:20','X'),(5,1,'2024-06-12 14:02:26','X'),(7,1,'2024-06-12 14:02:44','A'),(7,1,'2024-06-12 14:02:54','V'),(7,1,'2024-06-12 14:03:09','X'),(8,1,'2024-06-12 14:41:36','A'),(8,1,'2024-06-12 14:41:41','V'),(8,1,'2024-06-12 14:42:02','X'),(9,1,'2024-06-12 19:35:24','A'),(10,1,'2024-06-12 19:35:24','A'),(11,1,'2024-06-12 20:09:40','A'),(11,1,'2024-06-12 20:09:50','X'),(12,1,'2024-06-12 20:19:01','A'),(9,1,'2024-06-12 20:22:08','V'),(10,1,'2024-06-12 20:46:24','D'),(13,1,'2024-06-12 20:47:04','A'),(13,1,'2024-06-12 20:47:24','D'),(13,1,'2024-06-12 20:54:00','X'),(14,1,'2024-06-12 20:58:05','A'),(15,1,'2024-06-12 21:02:06','A'),(14,1,'2024-06-12 21:03:17','M'),(9,1,'2024-06-12 21:03:58','M'),(12,1,'2024-06-12 21:05:14','M'),(16,1,'2024-06-12 21:12:40','A'),(14,1,'2024-06-12 23:10:29','V'),(17,1,'2024-06-12 23:26:26','A'),(17,1,'2024-06-12 23:28:15','M'),(14,1,'2024-06-12 23:44:12','V'),(14,1,'2024-06-12 23:44:19','D'),(18,1,'2024-06-13 18:29:25','A'),(19,1,'2024-06-13 20:52:48','A'),(20,1,'2024-06-13 22:46:14','A'),(9,1,'2024-06-14 21:57:12','M'),(16,1,'2024-06-14 21:59:44','O'),(16,1,'2024-06-14 21:59:44','D'),(10,1,'2024-06-14 22:02:16','V'),(9,1,'2024-06-14 23:10:01','V'),(14,1,'2024-06-14 23:21:10','V'),(16,1,'2024-06-15 20:40:48','I'),(13,1,'2024-06-17 21:54:00','R'),(11,1,'2024-06-17 21:54:00','R'),(16,1,'2024-06-25 20:34:06','O'),(16,1,'2024-06-25 20:34:06','D'),(21,1,'2024-06-26 18:54:52','A'),(21,1,'2024-06-26 18:58:57','M'),(21,1,'2024-06-26 19:00:24','V'),(21,1,'2024-06-26 21:13:04','V'),(16,1,'2024-06-27 00:02:46','V'),(16,1,'2024-06-27 00:03:16','V'),(15,1,'2024-06-27 00:03:39','V'),(11,1,'2024-06-27 00:18:47','D'),(11,1,'2024-06-27 00:19:32','V'),(11,1,'2024-06-27 00:22:10','Y'),(22,1,'2024-06-27 03:37:16','A'),(23,1,'2024-06-27 03:53:18','A'),(24,1,'2024-06-27 17:10:06','A'),(24,1,'2024-06-28 19:14:49','V'),(23,1,'2024-06-28 19:16:10','V');
/*!40000 ALTER TABLE `odm_access_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_admin`
--

DROP TABLE IF EXISTS `odm_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_admin` (
  `id` int(11) unsigned DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_admin`
--

LOCK TABLES `odm_admin` WRITE;
/*!40000 ALTER TABLE `odm_admin` DISABLE KEYS */;
INSERT INTO `odm_admin` VALUES (4,1),(1,1),(5,1),(6,1),(7,1);
/*!40000 ALTER TABLE `odm_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_category`
--

DROP TABLE IF EXISTS `odm_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_category`
--

LOCK TABLES `odm_category` WRITE;
/*!40000 ALTER TABLE `odm_category` DISABLE KEYS */;
INSERT INTO `odm_category` VALUES (2,'Training Manual'),(6,'Purchase Orders'),(4,'Presentation'),(5,'User Guide and Web Application'),(7,'Invoices'),(8,'Quotes'),(9,'Setup Forms'),(10,'Request A Demonstration'),(11,'Data Slicks');
/*!40000 ALTER TABLE `odm_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_data`
--

DROP TABLE IF EXISTS `odm_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(11) unsigned NOT NULL DEFAULT '0',
  `owner` int(11) unsigned DEFAULT NULL,
  `realname` varchar(255) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT '',
  `status` smallint(6) DEFAULT NULL,
  `department` smallint(6) unsigned DEFAULT NULL,
  `default_rights` tinyint(4) DEFAULT NULL,
  `publishable` tinyint(4) DEFAULT NULL,
  `reviewer` int(11) unsigned DEFAULT NULL,
  `reviewer_comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_idx` (`id`,`owner`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `publishable` (`publishable`),
  KEY `description` (`description`(200))
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_data`
--

LOCK TABLES `odm_data` WRITE;
/*!40000 ALTER TABLE `odm_data` DISABLE KEYS */;
INSERT INTO `odm_data` VALUES (15,4,1,'DocuWorks_PPT.pptx','2024-06-12 21:02:06','DocuWorks Pro Power Point','DocuWorks PowerPoint Presentation',0,3,0,1,NULL,NULL),(13,7,5,'jimmy_pixel.png','2024-06-12 20:47:04','Jimmy Pixel','Just a pixel',0,1,0,-1,1,'To=Author(s);Subject=Reject;Comments=Just Testing;'),(14,9,1,'Avidian Setup Form.pdf','2024-06-12 20:58:05','Avid Product Set-Up Forms','On Boarding ',0,4,0,1,NULL,NULL),(12,2,1,'MTC-DMS-user-manual-3.7.3 v2 (PDF).pdf','2024-06-12 20:19:01','Avid DocuWorks Pro Web Application and User Manual Pro ','https://dms.avidian.com/demo',0,2,0,1,NULL,NULL),(11,7,1,'BIGIMAGE.jpg','2024-06-12 20:09:40','TEST','TEST',0,1,0,1,1,'To= Author(s);Subject=Looks good;Comments=Looks good to me. ;'),(9,5,4,'Avid Web Conferences User Guide.pdf','2024-06-12 17:40:03','Avid Web Conferencing Application and User Guide','https://webconferencing.mytruecloud.com/signin',0,7,0,1,NULL,NULL),(10,5,1,'Avid  ERP Manual.pdf','2024-06-12 17:42:22','Avid ERP Web Application and User Manual','https://cloudapps.mytruecloud.com/erp_myerp/login.php',0,2,0,1,NULL,NULL),(16,10,1,'Avid CRM Brochure.pdf','2024-06-12 21:12:40','Request A Demonstration / Pricing','https://avidian.com/schedule-a-demo/',1,2,0,1,NULL,NULL),(17,4,1,'Avidian\'s_Overview_Brochure_Template_11x17 v8 (Final).pdf','2024-06-12 23:26:26','Avid\'s Product Overview Brochure','Avid\'s Product Overview Brochure',0,3,0,1,NULL,NULL),(18,5,1,'Avid DocuWorks User Guide.pdf','2024-06-13 18:29:25','DocuWorks Standard User Guide','https://standarddms.mytruecloud.com/',0,6,0,1,NULL,NULL),(19,11,1,'TOP 11 REASONS TO SUBSCRIBE TO DOCUWORKS BY AVIDIAN.pdf','2024-06-13 20:52:48','Top 11 Reasons to Subscribe to DocuWorks','Top 11 Reasons to Subscribe to DocuWorks',0,3,0,1,NULL,NULL),(20,11,1,'Avid Customer Relationship Management Web Application.pdf','2024-06-13 22:46:14','Avid CRM Management Web Application and Data Slick','https://manage.mytruecloud.com/admin',0,3,0,1,NULL,NULL),(21,11,1,'Avid CRM Embedded in Outlook.pdf','2024-06-26 18:54:52','Avid CRM Embedded into Outlook','https://devtest51.avidian.com/prophetwebaddin/module/login',0,2,0,1,NULL,NULL),(22,4,1,'Avid CRM Learning - 2024 - 2.pptx','2024-06-27 03:37:16','Avid Training Syllabus','Training slide deck',0,1,0,1,NULL,NULL),(23,11,1,'How to Import Contacts Into Google Maps (2).mp4','2024-06-27 03:53:18','Training video ','Training video ',0,1,0,1,NULL,NULL),(24,11,1,'Standard-Luke-Edit.pbix','2024-06-27 17:10:06','PBIX test','PBIX test',0,1,0,1,NULL,NULL);
/*!40000 ALTER TABLE `odm_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_department`
--

DROP TABLE IF EXISTS `odm_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_department`
--

LOCK TABLES `odm_department` WRITE;
/*!40000 ALTER TABLE `odm_department` DISABLE KEYS */;
INSERT INTO `odm_department` VALUES (1,'Information Systems'),(2,'Sales Department'),(3,'Marketing Department'),(4,'On-Boarding Department'),(5,'Finance Department'),(6,'Research & Development'),(7,'Corporate');
/*!40000 ALTER TABLE `odm_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_dept_perms`
--

DROP TABLE IF EXISTS `odm_dept_perms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_dept_perms` (
  `fid` int(11) unsigned DEFAULT NULL,
  `dept_id` int(11) unsigned DEFAULT NULL,
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
INSERT INTO `odm_dept_perms` VALUES (1,1,1),(2,1,1),(3,1,1),(4,1,1),(5,1,1),(6,1,1),(7,1,1),(8,1,1),(9,2,4),(9,6,4),(9,4,4),(9,3,4),(9,1,4),(9,5,2),(10,5,4),(10,1,4),(10,3,4),(10,4,4),(10,6,4),(10,2,4),(11,7,0),(11,5,0),(11,1,1),(11,3,0),(11,4,0),(11,6,0),(11,2,0),(12,2,4),(12,6,4),(12,4,4),(12,3,4),(12,1,4),(12,5,4),(12,7,4),(13,7,0),(13,5,0),(13,1,1),(13,3,0),(13,4,0),(13,6,0),(13,2,0),(14,2,4),(14,6,4),(14,4,4),(14,3,1),(14,1,4),(14,5,1),(14,7,4),(15,7,4),(15,5,1),(15,1,4),(15,3,4),(15,4,4),(15,6,4),(15,2,4),(9,7,4),(16,7,4),(16,5,1),(16,1,4),(16,3,4),(16,4,4),(16,6,4),(16,2,4),(17,2,4),(17,6,4),(17,4,4),(17,3,4),(17,1,4),(17,5,1),(17,7,4),(18,7,4),(18,5,4),(18,1,4),(18,3,4),(18,4,4),(18,6,4),(18,2,4),(19,7,4),(19,5,4),(19,1,4),(19,3,4),(19,4,4),(19,6,2),(19,2,4),(20,7,4),(20,5,1),(20,1,4),(20,3,4),(20,4,4),(20,6,4),(20,2,4),(21,2,4),(21,6,4),(21,4,4),(21,3,4),(21,1,1),(21,5,1),(21,7,1),(22,7,0),(22,5,0),(22,1,1),(22,3,0),(22,4,0),(22,6,0),(22,2,0),(23,7,0),(23,5,0),(23,1,1),(23,3,0),(23,4,0),(23,6,0),(23,2,0),(24,7,0),(24,5,0),(24,1,1),(24,3,0),(24,4,0),(24,6,0),(24,2,0);
/*!40000 ALTER TABLE `odm_dept_perms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_dept_reviewer`
--

DROP TABLE IF EXISTS `odm_dept_reviewer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_dept_reviewer` (
  `dept_id` int(11) unsigned DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL
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
  `id` int(11) unsigned NOT NULL DEFAULT '0',
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
INSERT INTO `odm_log` VALUES (1,'2024-06-12 13:40:46','admin','Initial import','current'),(2,'2024-06-12 13:47:39','admin','Initial import','current'),(3,'2024-06-12 13:56:48','admin','Initial import','current'),(4,'2024-06-12 13:57:44','admin','Initial import','current'),(5,'2024-06-12 13:59:50','admin','Initial import','current'),(6,'2024-06-12 14:01:27','admin','Initial import','current'),(7,'2024-06-12 14:02:44','admin','Initial import','current'),(8,'2024-06-12 14:41:36','admin','Initial import','current'),(9,'2024-06-12 17:40:03','admin','Initial import','current'),(10,'2024-06-12 17:42:22','admin','Initial import','current'),(11,'2024-06-12 20:09:40','admin','Initial import','current'),(12,'2024-06-12 20:19:01','admin','Initial import','current'),(13,'2024-06-12 20:47:04','admin','Initial import','current'),(14,'2024-06-12 20:58:05','admin','Initial import','current'),(15,'2024-06-12 21:02:06','admin','Initial import','current'),(16,'2024-06-12 21:12:40','admin','Initial import','0'),(17,'2024-06-12 23:26:26','admin','Initial import','current'),(18,'2024-06-13 18:29:25','admin','Initial import','current'),(19,'2024-06-13 20:52:48','admin','Initial import','current'),(20,'2024-06-13 22:46:14','admin','Initial import','current'),(16,'2024-06-15 20:40:48','admin','Finished Changes','current'),(21,'2024-06-26 18:54:52','admin','Initial import','current'),(22,'2024-06-27 03:37:16','admin','Initial import','current'),(23,'2024-06-27 03:53:18','admin','Initial import','current'),(24,'2024-06-27 17:10:06','admin','Initial import','current');
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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_settings`
--

LOCK TABLES `odm_settings` WRITE;
/*!40000 ALTER TABLE `odm_settings` DISABLE KEYS */;
INSERT INTO `odm_settings` VALUES (1,'debug','False','(True/False) - Default=False - Debug the installation (not working)','bool'),(2,'demo','False','(True/False) This setting is for a demo installation, where random people will be all loggging in as the same username/password like \"demo/demo\". This will keep users from removing files, users, etc.','bool'),(3,'authen','mysql','(Default = mysql) Currently only MySQL authentication is supported',''),(4,'title','DocuWorks Outlook and Gmail','This is the browser window title','maxsize=255'),(5,'site_mail','jbaggio@rsttechnology.com','The email address of the administrator of this site','email|maxsize=255|req'),(6,'root_id','1','This variable sets the root user id.  The root user will be able to access all files and have authority for everything.','num|req'),(7,'dataDir','/var/www/file_store/','location of file repository. This should ideally be outside the Web server root. Make sure the server has permissions to read/write files to this folder!. (Examples: Linux - /var/www/document_repository/ : Windows - c:/document_repository/','maxsize=255'),(8,'max_filesize','50000000','Set the maximum file upload size','num|maxsize=255'),(9,'revision_expiration','90','This var sets the amount of days until each file needs to be revised,  assuming that there are 30 days in a month for all months.','num|maxsize=255'),(10,'file_expired_action','3','Choose an action option when a file is found to be expired The first two options also result in sending email to reviewer  (1) Remove from file list until renewed (2) Show in file list but non-checkoutable (3) Send email to reviewer only (4) Do Nothing','num'),(11,'authorization','False','True or False. If set True, every document must be reviewed by an admin before it can go public. To disable set to False. If False, all newly added/checked-in documents will immediately be listed','bool'),(12,'allow_signup','True','Should we display the sign-up link?','bool'),(13,'allow_password_reset','True','Should we allow users to reset their forgotten password?','bool'),(14,'try_nis','False','Attempt NIS password lookups from YP server?','bool'),(15,'theme','default','Which theme to use?',''),(16,'language','english','Set the default language (english, spanish, turkish, etc.). Local users may override this setting. Check include/language folder for languages available','alpha|req'),(17,'max_query','500','Set this to the maximum number of rows you want to be returned in a file listing. If your file list is slow decrease this value.','num');
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_udf`
--

LOCK TABLES `odm_udf` WRITE;
/*!40000 ALTER TABLE `odm_udf` DISABLE KEYS */;
/*!40000 ALTER TABLE `odm_udf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_user`
--

DROP TABLE IF EXISTS `odm_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `department` int(11) unsigned DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `pw_reset_code` char(32) DEFAULT NULL,
  `can_add` tinyint(1) DEFAULT '1',
  `can_checkin` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odm_user`
--

LOCK TABLES `odm_user` WRITE;
/*!40000 ALTER TABLE `odm_user` DISABLE KEYS */;
INSERT INTO `odm_user` VALUES (5,'jtx','8a64baf20611d520cc84b8d4fc10d6ab',1,'3109908356','jtx@jtxmail.com','Taylor','James',NULL,1,1),(1,'admin','ae016509b56f5d2867998b15c3d0e560',1,'949 413 3217','jbaggio@rsttechnology.com','Baggio','Joseph',NULL,1,1),(4,'nsaxena','ae016509b56f5d2867998b15c3d0e560',7,'5714810086','panayaholdings@gmail.com','Saxena','Nitin',NULL,1,1),(6,'jopanel','ae016509b56f5d2867998b15c3d0e560',7,'5626686170','josepho@avidian.com','Joseph','Opanel',NULL,1,1),(7,'Warren Test','87916085e60593f33ca38e48cdcc7db3',2,'4252170343','warrendstokes@outlook.com','Stokes ','Warren ',NULL,1,1);
/*!40000 ALTER TABLE `odm_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odm_user_perms`
--

DROP TABLE IF EXISTS `odm_user_perms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odm_user_perms` (
  `fid` int(11) unsigned DEFAULT NULL,
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
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
INSERT INTO `odm_user_perms` VALUES (9,1,4),(9,4,4),(9,5,4),(10,1,4),(11,1,4),(12,1,4),(12,4,4),(12,5,4),(13,1,4),(14,1,4),(14,4,4),(14,5,4),(15,1,4),(16,1,4),(16,4,4),(16,5,4),(17,1,4),(17,4,4),(17,5,4),(18,1,4),(18,4,4),(18,5,4),(19,1,4),(19,4,4),(19,5,4),(20,1,4),(20,4,4),(20,5,4),(21,1,4),(21,4,4),(21,5,4),(21,6,4),(22,1,4),(23,1,4),(24,1,4);
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

-- Dump completed on 2024-07-09 17:29:37
