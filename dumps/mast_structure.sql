-- MySQL dump 10.15  Distrib 10.0.30-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: maut
-- ------------------------------------------------------
-- Server version	10.0.30-MariaDB

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
-- Table structure for table `komponente_hat_attribute`
--

DROP TABLE IF EXISTS `komponente_hat_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komponente_hat_attribute` (
  `k_id` int(11) NOT NULL,
  `kat_id` int(11) NOT NULL,
  `khkat_wert` varchar(45) DEFAULT NULL,
  `khkat_erstellt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `khkat_geaendert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `khkat_geloescht` tinyint(1) NOT NULL,
  PRIMARY KEY (`k_id`,`kat_id`),
  KEY `fk_komponenten_has_komponentenattribute_komponentenattribute1` (`kat_id`),
  KEY `fk_komponenten_has_komponentenattribute_komponenten1` (`k_id`),
  CONSTRAINT `fk_komponenten_has_komponentenattribute_komponenten1` FOREIGN KEY (`k_id`) REFERENCES `komponenten` (`k_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_komponenten_has_komponentenattribute_komponentenattribute1` FOREIGN KEY (`kat_id`) REFERENCES `komponentenattribute` (`kat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `komponente_in_raum`
--

DROP TABLE IF EXISTS `komponente_in_raum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komponente_in_raum` (
  `k_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  PRIMARY KEY (`k_id`,`r_id`),
  KEY `r_id` (`r_id`),
  CONSTRAINT `komponente_in_raum_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `raeume` (`r_id`),
  CONSTRAINT `komponente_in_raum_ibfk_2` FOREIGN KEY (`k_id`) REFERENCES `komponenten` (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `komponenten`
--

DROP TABLE IF EXISTS `komponenten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komponenten` (
  `k_id` int(11) NOT NULL AUTO_INCREMENT,
  `k_name` varchar(45) NOT NULL,
  `l_id` int(11) NOT NULL,
  `k_einkaufsdatum` date DEFAULT NULL,
  `k_gewaehrleistung_bis` date DEFAULT NULL,
  `k_notiz` varchar(1024) DEFAULT NULL,
  `k_hersteller` varchar(45) DEFAULT NULL,
  `ka_id` int(11) NOT NULL,
  `k_erstellt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `k_geaendert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `k_geloescht` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`k_id`),
  KEY `fk_komponenten_haendler` (`l_id`),
  KEY `fk_komponenten_komponentenarten1` (`ka_id`),
  CONSTRAINT `fk_komponenten_haendler` FOREIGN KEY (`l_id`) REFERENCES `lieferanten` (`l_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_komponenten_komponentenarten1` FOREIGN KEY (`ka_id`) REFERENCES `komponentenarten` (`ka_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `komponentenarten`
--

DROP TABLE IF EXISTS `komponentenarten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komponentenarten` (
  `ka_id` int(11) NOT NULL AUTO_INCREMENT,
  `ka_komponentenart` varchar(45) DEFAULT NULL,
  `ka_einmalig` tinyint(1) NOT NULL DEFAULT '1',
  `ka_erstellt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ka_geaendert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ka_geloescht` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ka_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `komponentenattribute`
--

DROP TABLE IF EXISTS `komponentenattribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komponentenattribute` (
  `kat_id` int(11) NOT NULL AUTO_INCREMENT,
  `kat_typ` enum('bool','date','int','string','datetime','float') NOT NULL DEFAULT 'string',
  `kat_einheit` varchar(25) DEFAULT NULL,
  `kat_einzigartig` tinyint(1) NOT NULL DEFAULT '0',
  `kat_bezeichnung` varchar(25) NOT NULL,
  PRIMARY KEY (`kat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lieferanten`
--

DROP TABLE IF EXISTS `lieferanten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lieferanten` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_firmenname` varchar(45) DEFAULT NULL,
  `l_strasse` varchar(45) DEFAULT NULL,
  `l_plz` varchar(5) DEFAULT NULL,
  `l_ort` varchar(45) DEFAULT NULL,
  `l_tel` varchar(20) DEFAULT NULL,
  `l_mobil` varchar(20) DEFAULT NULL,
  `l_fax` varchar(20) DEFAULT NULL,
  `l_email` varchar(45) DEFAULT NULL,
  `l_erstellt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `l_geaendert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `l_geloescht` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `raeume`
--

DROP TABLE IF EXISTS `raeume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `raeume` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_nr` varchar(20) DEFAULT NULL COMMENT 'z.B. r014, W304, etc.',
  `r_bezeichnung` varchar(45) DEFAULT NULL COMMENT 'z.B. Werkstatt, Lager,...',
  `r_notiz` varchar(1024) DEFAULT NULL,
  `r_erstellt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `r_geaendert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `r_geloescht` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wird_beschrieben_durch`
--

DROP TABLE IF EXISTS `wird_beschrieben_durch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wird_beschrieben_durch` (
  `ka_id` int(11) NOT NULL,
  `kat_id` int(11) NOT NULL,
  PRIMARY KEY (`ka_id`,`kat_id`),
  KEY `fk_komponentenarten_has_komponentenattribute_komponentenattri1` (`kat_id`),
  KEY `fk_komponentenarten_has_komponentenattribute_komponentenarten1` (`ka_id`),
  CONSTRAINT `fk_komponentenarten_has_komponentenattribute_komponentenarten1` FOREIGN KEY (`ka_id`) REFERENCES `komponentenarten` (`ka_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_komponentenarten_has_komponentenattribute_komponentenattri1` FOREIGN KEY (`kat_id`) REFERENCES `komponentenattribute` (`kat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-29 11:56:31
