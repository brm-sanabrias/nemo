/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : nemo

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-03-14 15:36:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mp_brand
-- ----------------------------
DROP TABLE IF EXISTS `mp_brand`;
CREATE TABLE `mp_brand` (
  `idBrand` int(11) NOT NULL AUTO_INCREMENT,
  `idCategory` int(11) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idBrand`),
  KEY `fk_mp_brand_mp_category1_idx` (`idCategory`),
  CONSTRAINT `fk_mp_brand_mp_category1` FOREIGN KEY (`idCategory`) REFERENCES `mp_category` (`idCategory`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mp_brand_x_social_network
-- ----------------------------
DROP TABLE IF EXISTS `mp_brand_x_social_network`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mp_category
-- ----------------------------
DROP TABLE IF EXISTS `mp_category`;
CREATE TABLE `mp_category` (
  `idCategory` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mp_id_temp
-- ----------------------------
DROP TABLE IF EXISTS `mp_id_temp`;
CREATE TABLE `mp_id_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idBrandXSocialNetwork` varchar(45) NOT NULL,
  `idFbField` text,
  `typeFbField` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mp_interaction
-- ----------------------------
DROP TABLE IF EXISTS `mp_interaction`;
CREATE TABLE `mp_interaction` (
  `idInteraction` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idInteraction`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mp_report
-- ----------------------------
DROP TABLE IF EXISTS `mp_report`;
CREATE TABLE `mp_report` (
  `idReport` int(11) NOT NULL,
  `idBrand` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `recurrence` varchar(45) NOT NULL,
  PRIMARY KEY (`idReport`),
  KEY `fk_mp_report_mp_brand1_idx` (`idBrand`),
  CONSTRAINT `fk_mp_report_mp_brand1` FOREIGN KEY (`idBrand`) REFERENCES `mp_brand` (`idBrand`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mp_report_log
-- ----------------------------
DROP TABLE IF EXISTS `mp_report_log`;
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

-- ----------------------------
-- Table structure for mp_social_network
-- ----------------------------
DROP TABLE IF EXISTS `mp_social_network`;
CREATE TABLE `mp_social_network` (
  `idSocialNetwork` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`idSocialNetwork`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for mp_token
-- ----------------------------
DROP TABLE IF EXISTS `mp_token`;
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

-- ----------------------------
-- Table structure for mp_user_fb
-- ----------------------------
DROP TABLE IF EXISTS `mp_user_fb`;
CREATE TABLE `mp_user_fb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `clientIdFb` text,
  `clientSecretFb` text,
  `idFb` varchar(75) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
