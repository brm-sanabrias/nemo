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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_brand`
--

LOCK TABLES `mp_brand` WRITE;
/*!40000 ALTER TABLE `mp_brand` DISABLE KEYS */;
INSERT INTO `mp_brand` VALUES (14,1,'https://external.xx.fbcdn.net/safe_image.php?d=AQCjXVQT-CIyyuYn&w=100&h=300&url=http%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2F3%2F36%2FAdidasSuperstarII.jpg&fallback=hub_likes&prefix=s','adidas','2016-04-07 21:20:55'),(15,1,'https://scontent.xx.fbcdn.net/hprofile-xfa1/v/t1.0-1/c28.28.345.345/s100x100/550013_10151387007773445_409018869_n.jpg?oh=461d4ce647a895fbe43845ea30e485d7&oe=577FE219','nike','2016-04-07 21:38:15');
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
  PRIMARY KEY (`id`),
  KEY `fk_mp_brand_has_mp_social_network_mp_social_network1_idx` (`idSocialNetwork`),
  KEY `fk_mp_brand_has_mp_social_network_mp_brand_idx` (`idBrand`),
  KEY `fk_mp_brand_x_social_network_mp_interaction1_idx` (`idInteraction`),
  CONSTRAINT `fk_mp_brand_has_mp_social_network_mp_brand` FOREIGN KEY (`idBrand`) REFERENCES `mp_brand` (`idBrand`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mp_brand_has_mp_social_network_mp_social_network1` FOREIGN KEY (`idSocialNetwork`) REFERENCES `mp_social_network` (`idSocialNetwork`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mp_brand_x_social_network_mp_interaction1` FOREIGN KEY (`idInteraction`) REFERENCES `mp_interaction` (`idInteraction`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_brand_x_social_network`
--

LOCK TABLES `mp_brand_x_social_network` WRITE;
/*!40000 ALTER TABLE `mp_brand_x_social_network` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_brand_x_social_network` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_category`
--

LOCK TABLES `mp_category` WRITE;
/*!40000 ALTER TABLE `mp_category` DISABLE KEYS */;
INSERT INTO `mp_category` VALUES (1,'Deportes','2016-04-07'),(2,'Alimentos','2016-04-07');
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
  `idBrandXSocialNetwork` int(11) DEFAULT NULL,
  `idFbField` text,
  `typeFbField` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mp_id_temp_mp_brand_x_social_network1_idx` (`idBrandXSocialNetwork`),
  CONSTRAINT `fk_mp_id_temp_mp_brand_x_social_network1` FOREIGN KEY (`idBrandXSocialNetwork`) REFERENCES `mp_brand_x_social_network` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `idInteraction` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idInteraction`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_interaction`
--

LOCK TABLES `mp_interaction` WRITE;
/*!40000 ALTER TABLE `mp_interaction` DISABLE KEYS */;
INSERT INTO `mp_interaction` VALUES (1,'Likes','2016-04-07 20:54:30'),(2,'Post','2016-04-07 20:54:30');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_social_network`
--

LOCK TABLES `mp_social_network` WRITE;
/*!40000 ALTER TABLE `mp_social_network` DISABLE KEYS */;
INSERT INTO `mp_social_network` VALUES (1,'Facebook','2016-04-07'),(2,'Twitter','2016-04-07');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_user_fb`
--

LOCK TABLES `mp_user_fb` WRITE;
/*!40000 ALTER TABLE `mp_user_fb` DISABLE KEYS */;
INSERT INTO `mp_user_fb` VALUES (1,'Cristian Tangarife','256301091132754','dc897d6e5ec629a429aa39c416b506e1','100004387741316','2016-03-15 14:58:58');
/*!40000 ALTER TABLE `mp_user_fb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `mp_view_fanpage`
--

DROP TABLE IF EXISTS `mp_view_fanpage`;
/*!50001 DROP VIEW IF EXISTS `mp_view_fanpage`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mp_view_fanpage` (
  `id` tinyint NOT NULL,
  `snID` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `idFbField` tinyint NOT NULL,
  `typeFbField` tinyint NOT NULL,
  `dateUpdate` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `mp_web`
--

DROP TABLE IF EXISTS `mp_web`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mp_web` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idBrand` int(11) NOT NULL,
  `url` varchar(150) DEFAULT NULL,
  `analyticsUser` varchar(255) DEFAULT NULL,
  `analyticsPass` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mp_web_mp_brand1_idx` (`idBrand`),
  CONSTRAINT `fk_mp_web_mp_brand1` FOREIGN KEY (`idBrand`) REFERENCES `mp_brand` (`idBrand`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_web`
--

LOCK TABLES `mp_web` WRITE;
/*!40000 ALTER TABLE `mp_web` DISABLE KEYS */;
/*!40000 ALTER TABLE `mp_web` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `mp_view_fanpage`
--

/*!50001 DROP TABLE IF EXISTS `mp_view_fanpage`*/;
/*!50001 DROP VIEW IF EXISTS `mp_view_fanpage`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sebas1022`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `mp_view_fanpage` AS select `mp_brand_x_social_network`.`id` AS `id`,`mp_brand_x_social_network`.`snID` AS `snID`,`mp_brand`.`name` AS `name`,`mp_brand_x_social_network`.`date` AS `date`,`mp_brand_x_social_network`.`status` AS `status`,`mp_id_temp`.`idFbField` AS `idFbField`,`mp_id_temp`.`typeFbField` AS `typeFbField`,`mp_id_temp`.`date` AS `dateUpdate` from ((`mp_brand_x_social_network` join `mp_id_temp` on((`mp_id_temp`.`idBrandXSocialNetwork` = `mp_brand_x_social_network`.`id`))) join `mp_brand` on((`mp_brand`.`idBrand` = `mp_brand_x_social_network`.`idBrand`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-07 22:17:00
