-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: barredora
-- ------------------------------------------------------
-- Server version	5.6.25

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
-- Table structure for table `db_fanpage`
--

DROP TABLE IF EXISTS `db_fanpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_fanpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idRedSocial` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `idFanpage` text,
  `nombre` varchar(250) DEFAULT NULL,
  `estado` enum('N','S') DEFAULT 'S',
  `fechaLast` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_fanpage`
--

LOCK TABLES `db_fanpage` WRITE;
/*!40000 ALTER TABLE `db_fanpage` DISABLE KEYS */;
INSERT INTO `db_fanpage` VALUES (1,1,1,'303315045758','Nestlé','N',NULL,NULL),(2,1,1,'117517721657158','CONSTRUCTORA COANDES','N',NULL,NULL),(3,1,1,'327557000768','Claro El Salvador','N',NULL,NULL),(4,1,1,'337406841340','Claro Honduras','N',NULL,NULL),(5,1,1,'204164662946715','adidas Outdoor','N',NULL,NULL),(6,1,1,'84237528530','adidas Football','N',NULL,NULL),(7,1,1,'182162001806727','adidas','N',NULL,NULL),(8,1,1,'145629788018','adidas Running','N',NULL,NULL),(9,1,1,'9328458887','adidas Originals','N',NULL,NULL),(10,1,1,'15087023444','Nike','N',NULL,NULL),(11,1,1,'172129619569188','ASICS Colombia','N',NULL,NULL),(12,1,1,'795253457175086','PUMA','N',NULL,NULL),(13,1,1,'350220128992','Umbro Colombia','N',NULL,NULL),(14,1,1,'1518462205061824','New Balance Colombia','N',NULL,NULL),(15,1,1,'338298122932951','Onitsuka Tiger Colombia','N',NULL,NULL),(16,1,1,'150108525969','Converse Colombia','N',NULL,NULL),(17,1,1,'149180925093660','Vans','N',NULL,NULL),(18,1,1,'207709209271528','Under Armour Colombia','N',NULL,NULL),(19,NULL,NULL,'418331184885481','Mizuno','N',NULL,NULL),(20,NULL,NULL,'640508575966039','Durex Colombia','N',NULL,NULL),(21,NULL,NULL,'279982265470577','Durex Perú','N',NULL,NULL),(22,NULL,NULL,'268030949901346','Veet Colombia','N',NULL,NULL),(23,NULL,NULL,'321544941219256','Veet Perú','N',NULL,NULL),(24,NULL,NULL,'177497945599071','Veet Ecuador','N',NULL,NULL),(25,NULL,NULL,'190744324357770','Vanish Colombia','N',NULL,NULL),(26,NULL,NULL,'315938841814899','Vanish Perú (Oficial)','N',NULL,NULL),(27,NULL,NULL,'209299885826421','Vanish Ecuador (Oficial)','N',NULL,NULL),(28,NULL,NULL,'340307456174334','Amopé Colombia','N',NULL,NULL),(29,NULL,NULL,'158867210812129','Partido Nacional de Honduras','S',NULL,NULL),(30,NULL,NULL,'315759358593741','Gladis Aurora López','N',NULL,NULL),(31,NULL,NULL,'160671457301046','Claro Costa Rica','N',NULL,NULL),(32,NULL,NULL,'253635411315081','Luis Abinader','N',NULL,NULL),(33,NULL,NULL,'124300620957187','Juan Orlando Hernández','N',NULL,NULL),(34,NULL,NULL,'822022737837699','Partido Revolucionario Moderno PRM','N',NULL,NULL),(35,NULL,NULL,'112477522422248','David Collado','N',NULL,NULL),(36,NULL,NULL,'768647876541345','Eduardo Sanz Lovatón - Yayo','N',NULL,NULL),(37,NULL,NULL,'180779708635647','Juan Diego Zelaya','N',NULL,NULL),(38,NULL,NULL,'1528988480679175','Alberto Atallah','N',NULL,NULL),(39,NULL,NULL,'47735348138','Danilo Medina','N',NULL,NULL),(40,NULL,NULL,'720718844610243','Manuel Zelaya R.','N',NULL,NULL),(41,NULL,NULL,'179497378753875','LifeMiles','S',NULL,NULL);
/*!40000 ALTER TABLE `db_fanpage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_id_temp`
--

DROP TABLE IF EXISTS `db_id_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_id_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCampo` text,
  `tipoId` varchar(150) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_id_temp`
--

LOCK TABLES `db_id_temp` WRITE;
/*!40000 ALTER TABLE `db_id_temp` DISABLE KEYS */;
INSERT INTO `db_id_temp` VALUES (1,'','Post','2016-02-16 16:26:37'),(2,NULL,'Comment','2016-01-12 10:43:06'),(3,NULL,'LikePost','2016-01-12 09:08:57'),(4,NULL,'LikeComment','2016-01-12 09:23:44'),(5,NULL,'Event','2016-01-12 08:58:27'),(6,NULL,'EventAttending','2016-01-12 08:58:27'),(7,NULL,'EventDeclined','2016-01-12 08:58:27'),(8,NULL,'EventNoreply','2016-01-12 08:58:27'),(9,NULL,'ReplyComment','2016-01-12 10:57:10');
/*!40000 ALTER TABLE `db_id_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_googleanalytics`
--

DROP TABLE IF EXISTS `tb_googleanalytics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_googleanalytics` (
  `idrow` int(11) NOT NULL AUTO_INCREMENT,
  `ga_id` varchar(10) NOT NULL COMMENT '	',
  `ga_NombreCuenta` varchar(45) NOT NULL COMMENT '	',
  `ga_Estado` char(1) NOT NULL,
  `ga_Activo` char(1) NOT NULL,
  `ga_FhUltimaEJecucion` datetime DEFAULT NULL,
  PRIMARY KEY (`idrow`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_googleanalytics`
--

LOCK TABLES `tb_googleanalytics` WRITE;
/*!40000 ALTER TABLE `tb_googleanalytics` DISABLE KEYS */;
INSERT INTO `tb_googleanalytics` VALUES (1,'67806111','SedalColombia','L','S',NULL),(2,'74423586','Bloc_Sedal','L','S',NULL),(3,'74455603','SedalEcuador','E','S',NULL);
/*!40000 ALTER TABLE `tb_googleanalytics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_ytchannel`
--

DROP TABLE IF EXISTS `tb_ytchannel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_ytchannel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IdAccount` varchar(50) NOT NULL,
  `NombreCanal` varchar(150) NOT NULL,
  `Estado` varchar(3) DEFAULT NULL,
  `Activo` char(1) NOT NULL,
  `UltimaEjecucion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ytchannel`
--

LOCK TABLES `tb_ytchannel` WRITE;
/*!40000 ALTER TABLE `tb_ytchannel` DISABLE KEYS */;
INSERT INTO `tb_ytchannel` VALUES (1,'UCKFasNcl3uwQ6P-gSGb04DQ','BonBonBum','L','S',NULL),(2,'UCQOglvUpMKQPfH0T2SkEejw','VidaSedal','L','S',NULL),(3,'UCcjkzAcwGT-oECUt4XpJvSw','RexonaMDA','E','S',NULL);
/*!40000 ALTER TABLE `tb_ytchannel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-04 17:06:17
