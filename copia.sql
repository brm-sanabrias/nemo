-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: nemo
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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
-- Table structure for table `mp_brand`
--

DROP TABLE IF EXISTS `mp_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_brand` (
  `idBrand` int(11) NOT NULL AUTO_INCREMENT,
  `idCategory` int(11) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `name` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idBrand`),
  KEY `fk_mp_brand_mp_category1_idx` (`idCategory`),
  CONSTRAINT `fk_mp_brand_mp_category1` FOREIGN KEY (`idCategory`) REFERENCES `mp_category` (`idCategory`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_brand`
--

LOCK TABLES `mp_brand` WRITE;
/*!40000 ALTER TABLE `mp_brand` DISABLE KEYS */;
INSERT INTO `mp_brand` VALUES (133,1,'https://scontent.xx.fbcdn.net/hprofile-xla1/v/t1.0-1/p100x100/10550819_550968961698553_8692789402634739993_n.png?oh=8aebe7ca623f6214f267124cfdecad1b&oe=57854CE2','Facebook','2016-04-01 19:26:33'),(134,1,'https://external.xx.fbcdn.net/safe_image.php?d=AQCjXVQT-CIyyuYn&w=100&h=300&url=http%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2F3%2F36%2FAdidasSuperstarII.jpg&fallback=hub_likes&prefix=s','adidas','2016-04-04 15:19:55'),(135,1,'https://scontent.xx.fbcdn.net/hprofile-xtp1/v/t1.0-1/p100x100/10407457_10153320029325040_7499493335517296115_n.png?oh=2507271d21f0a8d7fc33749c83c81fba&oe=57735AEE','lenovo','2016-04-04 17:10:09');
/*!40000 ALTER TABLE `mp_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_brand_x_social_network`
--

DROP TABLE IF EXISTS `mp_brand_x_social_network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_brand_x_social_network` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idBrand` int(11) NOT NULL,
  `idSocialNetwork` int(11) NOT NULL,
  `idInteraction` int(11) NOT NULL,
  `snID` text NOT NULL,
  `ownedBrand` enum('S','N') DEFAULT 'N',
  `status` enum('E','P','L') DEFAULT 'L',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`,`idBrand`,`idSocialNetwork`),
  KEY `fk_mp_brand_has_mp_social_network_mp_social_network1_idx` (`idSocialNetwork`),
  KEY `fk_mp_brand_has_mp_social_network_mp_brand_idx` (`idBrand`),
  KEY `fk_mp_brand_x_social_network_mp_interaction1_idx` (`idInteraction`),
  KEY `id` (`id`),
  CONSTRAINT `fk_mp_brand_has_mp_social_network_mp_brand` FOREIGN KEY (`idBrand`) REFERENCES `mp_brand` (`idBrand`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mp_brand_has_mp_social_network_mp_social_network1` FOREIGN KEY (`idSocialNetwork`) REFERENCES `mp_social_network` (`idSocialNetwork`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mp_brand_x_social_network_mp_interaction1` FOREIGN KEY (`idInteraction`) REFERENCES `mp_interaction` (`idInteraction`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_brand_x_social_network`
--

LOCK TABLES `mp_brand_x_social_network` WRITE;
/*!40000 ALTER TABLE `mp_brand_x_social_network` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_brand_x_social_network` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_brand_x_social_network_seq`
--

DROP TABLE IF EXISTS `mp_brand_x_social_network_seq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_brand_x_social_network_seq` (
  `sequence` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sequence`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_brand_x_social_network_seq`
--

LOCK TABLES `mp_brand_x_social_network_seq` WRITE;
/*!40000 ALTER TABLE `mp_brand_x_social_network_seq` DISABLE KEYS */;
INSERT INTO `mp_brand_x_social_network_seq` VALUES (117);
/*!40000 ALTER TABLE `mp_brand_x_social_network_seq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_category`
--

DROP TABLE IF EXISTS `mp_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_category` (
  `idCategory` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_category`
--

LOCK TABLES `mp_category` WRITE;
/*!40000 ALTER TABLE `mp_category` DISABLE KEYS */;
INSERT INTO `mp_category` VALUES (1,'Default','2016-03-14'),(2,'Default','2016-03-14');
/*!40000 ALTER TABLE `mp_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_id_temp`
--

DROP TABLE IF EXISTS `mp_id_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_id_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idBrandXSocialNetwork` varchar(45) NOT NULL,
  `idFbField` text,
  `typeFbField` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_id_temp`
--

LOCK TABLES `mp_id_temp` WRITE;
/*!40000 ALTER TABLE `mp_id_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_id_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_interaction`
--

DROP TABLE IF EXISTS `mp_interaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_interaction` (
  `idInteraction` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idInteraction`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_interaction`
--

LOCK TABLES `mp_interaction` WRITE;
/*!40000 ALTER TABLE `mp_interaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_interaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_report`
--

DROP TABLE IF EXISTS `mp_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_report` (
  `idReport` int(11) NOT NULL,
  `idBrand` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `recurrence` varchar(45) NOT NULL,
  PRIMARY KEY (`idReport`),
  KEY `fk_mp_report_mp_brand1_idx` (`idBrand`),
  CONSTRAINT `fk_mp_report_mp_brand1` FOREIGN KEY (`idBrand`) REFERENCES `mp_brand` (`idBrand`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_report`
--

LOCK TABLES `mp_report` WRITE;
/*!40000 ALTER TABLE `mp_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_report_log`
--

DROP TABLE IF EXISTS `mp_report_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_report_log` (
  `idReportLog` int(11) NOT NULL,
  `idReport` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `date` datetime NOT NULL,
  `URL` text,
  PRIMARY KEY (`idReportLog`),
  KEY `fk_mp_report_log_mp_report1_idx` (`idReport`),
  CONSTRAINT `fk_mp_report_log_mp_report1` FOREIGN KEY (`idReport`) REFERENCES `mp_report` (`idReport`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_report_log`
--

LOCK TABLES `mp_report_log` WRITE;
/*!40000 ALTER TABLE `mp_report_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_report_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_social_network`
--

DROP TABLE IF EXISTS `mp_social_network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_social_network` (
  `idSocialNetwork` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`idSocialNetwork`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_social_network`
--

LOCK TABLES `mp_social_network` WRITE;
/*!40000 ALTER TABLE `mp_social_network` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_social_network` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_token`
--

DROP TABLE IF EXISTS `mp_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUserFb` int(11) NOT NULL,
  `token` text,
  `status` enum('S','N') DEFAULT 'N',
  `dateUpdate` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mp_token_mp_user_fb1_idx` (`idUserFb`),
  CONSTRAINT `fk_mp_token_mp_user_fb1` FOREIGN KEY (`idUserFb`) REFERENCES `mp_user_fb` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_token`
--

LOCK TABLES `mp_token` WRITE;
/*!40000 ALTER TABLE `mp_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_user_fb`
--

DROP TABLE IF EXISTS `mp_user_fb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_user_fb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `clientIdFb` text,
  `clientSecretFb` text,
  `idFb` varchar(75) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_user_fb`
--

LOCK TABLES `mp_user_fb` WRITE;
/*!40000 ALTER TABLE `mp_user_fb` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_user_fb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_web`
--

DROP TABLE IF EXISTS `mp_web`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_web` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idBrand` int(11) NOT NULL,
  `url` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_web`
--

LOCK TABLES `mp_web` WRITE;
/*!40000 ALTER TABLE `mp_web` DISABLE KEYS */;
INSERT INTO `mp_web` VALUES (10,130,'en-gb.facebook.com','2016-04-01 20:34:11'),(11,130,'www.facebook.com','2016-04-01 20:34:11'),(12,130,'en-gb.facebook.com','2016-04-01 20:34:32'),(13,130,'www.facebook.com','2016-04-01 20:34:32'),(14,130,'en-gb.facebook.com','2016-04-01 20:34:49'),(15,130,'m.facebook.com','2016-04-01 20:34:49'),(16,130,'en-gb.facebook.com','2016-04-01 20:35:18'),(17,130,'m.facebook.com','2016-04-01 20:35:18'),(18,130,'www.facebook.com','2016-04-01 20:36:11'),(19,130,'developers.facebook.com','2016-04-01 20:36:11'),(20,130,'en-gb.facebook.com','2016-04-01 20:38:20'),(21,130,'www.facebook.com','2016-04-01 20:38:20'),(22,130,'en-gb.facebook.com','2016-04-01 20:43:17'),(23,130,'www.facebook.com','2016-04-01 20:43:17'),(24,130,'en-gb.facebook.com','2016-04-01 20:44:42'),(25,130,'m.facebook.com','2016-04-01 20:44:42'),(26,130,'www.facebook.com','2016-04-01 20:44:42'),(27,130,'en-gb.facebook.com','2016-04-01 21:01:50'),(28,130,'m.facebook.com','2016-04-01 21:01:50'),(29,130,'www.facebook.com','2016-04-01 21:01:50'),(30,130,'en-gb.facebook.com','2016-04-01 21:08:00'),(31,130,'m.facebook.com','2016-04-01 21:08:00'),(32,130,'en-gb.facebook.com','2016-04-01 21:24:35'),(33,130,'www.facebook.com','2016-04-01 21:24:35'),(34,130,'developers.facebook.com','2016-04-01 21:24:35'),(35,130,'en-gb.facebook.com','2016-04-01 21:31:06'),(36,130,'www.facebook.com','2016-04-01 21:31:06'),(37,130,'en-gb.facebook.com','2016-04-01 21:36:01'),(38,130,'m.facebook.com','2016-04-01 21:36:01'),(39,130,'www.facebook.com','2016-04-01 21:36:01'),(40,130,'developers.facebook.com','2016-04-01 21:36:01'),(41,130,'en-gb.facebook.com','2016-04-01 21:41:08'),(42,130,'m.facebook.com','2016-04-01 21:41:08'),(43,130,'en-gb.facebook.com','2016-04-01 21:43:14'),(44,130,'en-gb.facebook.com','2016-04-01 21:43:57'),(45,130,'m.facebook.com','2016-04-01 21:43:57'),(46,130,'www.facebook.com','2016-04-01 21:43:57'),(47,130,'developers.facebook.com','2016-04-01 21:43:57'),(48,130,'en-gb.facebook.com','2016-04-01 21:45:15'),(49,130,'m.facebook.com','2016-04-01 21:45:15'),(50,130,'www.facebook.com','2016-04-01 21:45:15'),(51,130,'developers.facebook.com','2016-04-01 21:45:15'),(52,130,'en-gb.facebook.com','2016-04-01 21:45:59'),(53,130,'www.facebook.com','2016-04-01 21:45:59'),(54,130,'en-gb.facebook.com','2016-04-01 21:51:47'),(55,130,'m.facebook.com','2016-04-01 21:51:47'),(56,130,'en-gb.facebook.com','2016-04-01 21:51:59'),(57,130,'m.facebook.com','2016-04-01 21:51:59'),(58,130,'www.facebook.com','2016-04-01 21:51:59'),(59,130,'en-gb.facebook.com','2016-04-01 21:52:59'),(60,130,'m.facebook.com','2016-04-01 21:52:59'),(61,130,'www.facebook.com','2016-04-01 21:52:59'),(62,130,'developers.facebook.com','2016-04-01 21:52:59'),(63,130,'en-gb.facebook.com','2016-04-01 21:54:16'),(64,130,'m.facebook.com','2016-04-01 21:54:16'),(65,130,'en-gb.facebook.com','2016-04-01 22:07:28'),(66,130,'m.facebook.com','2016-04-01 22:07:28'),(67,130,'en-gb.facebook.com','2016-04-01 22:07:30'),(68,130,'m.facebook.com','2016-04-01 22:07:30'),(69,130,'en-gb.facebook.com','2016-04-01 22:07:34'),(70,130,'m.facebook.com','2016-04-01 22:07:34'),(71,130,'en-gb.facebook.com','2016-04-01 22:07:37'),(72,130,'m.facebook.com','2016-04-01 22:07:37'),(73,130,'en-gb.facebook.com','2016-04-01 22:07:41'),(74,130,'m.facebook.com','2016-04-01 22:07:41'),(75,130,'en-gb.facebook.com','2016-04-01 22:07:41'),(76,130,'m.facebook.com','2016-04-01 22:07:41'),(77,130,'en-gb.facebook.com','2016-04-01 22:07:42'),(78,130,'m.facebook.com','2016-04-01 22:07:42'),(79,130,'en-gb.facebook.com','2016-04-01 22:07:42'),(80,130,'m.facebook.com','2016-04-01 22:07:42'),(81,130,'en-gb.facebook.com','2016-04-01 22:07:43'),(82,130,'m.facebook.com','2016-04-01 22:07:43'),(83,130,'en-gb.facebook.com','2016-04-01 22:07:43'),(84,130,'m.facebook.com','2016-04-01 22:07:43'),(85,130,'en-gb.facebook.com','2016-04-01 22:07:43'),(86,130,'m.facebook.com','2016-04-01 22:07:43'),(87,130,'en-gb.facebook.com','2016-04-01 22:07:43'),(88,130,'m.facebook.com','2016-04-01 22:07:43'),(89,130,'en-gb.facebook.com','2016-04-01 22:07:43'),(90,130,'m.facebook.com','2016-04-01 22:07:43'),(91,130,'en-gb.facebook.com','2016-04-01 22:13:00'),(92,130,'m.facebook.com','2016-04-01 22:13:00'),(93,130,'en-gb.facebook.com','2016-04-01 22:14:16'),(94,130,'m.facebook.com','2016-04-01 22:14:16'),(95,130,'www.facebook.com','2016-04-01 22:14:16'),(96,130,'en-gb.facebook.com','2016-04-01 22:19:47'),(97,130,'en-gb.facebook.com','2016-04-01 22:21:21'),(98,130,'en-gb.facebook.com','2016-04-01 22:21:51'),(99,130,'en-gb.facebook.com','2016-04-01 22:22:26'),(100,130,'m.facebook.com','2016-04-01 22:22:26'),(101,130,'www.facebook.com','2016-04-01 22:22:26'),(102,130,'en-gb.facebook.com','2016-04-01 22:23:00'),(103,130,'m.facebook.com','2016-04-01 22:23:00'),(104,130,'www.facebook.com','2016-04-01 22:23:00'),(105,130,'en-gb.facebook.com','2016-04-01 22:24:32'),(106,130,'m.facebook.com','2016-04-01 22:24:32'),(107,130,'www.facebook.com','2016-04-01 22:24:32'),(108,130,'en-gb.facebook.com','2016-04-01 22:25:45'),(109,130,'m.facebook.com','2016-04-01 22:25:45'),(110,130,'www.facebook.com','2016-04-01 22:25:45'),(111,130,'en-gb.facebook.com','2016-04-01 22:26:42'),(112,130,'www.facebook.com','2016-04-01 22:26:42'),(113,130,'en-gb.facebook.com','2016-04-01 22:27:22'),(114,130,'www.facebook.com','2016-04-01 22:27:22'),(115,130,'en-gb.facebook.com','2016-04-01 22:31:45'),(116,130,'www.facebook.com','2016-04-01 22:31:45'),(117,130,'en-gb.facebook.com','2016-04-01 22:34:02'),(118,130,'m.facebook.com','2016-04-01 22:34:02'),(119,130,'www.facebook.com','2016-04-01 22:34:02'),(120,134,'www.adidas.com','2016-04-04 15:21:09'),(121,134,'www.adidas.com','2016-04-04 16:23:44'),(122,134,'www.adidas.com','2016-04-04 16:25:46'),(123,134,'www.adidas.com','2016-04-04 16:34:55'),(124,134,'www.adidas.com','2016-04-04 16:38:19'),(125,134,'www.adidas.com','2016-04-04 16:39:09'),(126,134,'www.adidas.com','2016-04-04 16:43:33'),(127,134,'www.adidas.com','2016-04-04 16:44:05'),(128,134,'www.adidas.com','2016-04-04 16:53:00'),(129,134,'www.adidas.com','2016-04-04 16:55:27'),(130,134,'www.adidas.com','2016-04-04 16:57:43'),(131,135,'support.lenovo.com','2016-04-04 17:11:26'),(132,135,'en.wikipedia.org','2016-04-04 17:11:26'),(133,135,'shop.lenovo.com','2016-04-04 17:11:26'),(134,135,'support.lenovo.com','2016-04-04 17:17:06'),(135,135,'en.wikipedia.org','2016-04-04 17:17:06'),(136,135,'shop.lenovo.com','2016-04-04 17:17:06'),(137,135,'support.lenovo.com','2016-04-04 17:18:26'),(138,135,'en.wikipedia.org','2016-04-04 17:18:26'),(139,135,'support.lenovo.com','2016-04-04 17:21:17'),(140,135,'en.wikipedia.org','2016-04-04 17:21:17'),(141,135,'support.lenovo.com','2016-04-04 17:27:28'),(142,135,'en.wikipedia.org','2016-04-04 17:27:28'),(143,135,'shop.lenovo.com','2016-04-04 17:27:28');
/*!40000 ALTER TABLE `mp_web` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-05 15:01:20
