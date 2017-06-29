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
-- Dumping data for table `komponente_hat_attribute`
--

LOCK TABLES `komponente_hat_attribute` WRITE;
/*!40000 ALTER TABLE `komponente_hat_attribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `komponente_hat_attribute` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `komponente_in_raum`
--

LOCK TABLES `komponente_in_raum` WRITE;
/*!40000 ALTER TABLE `komponente_in_raum` DISABLE KEYS */;
/*!40000 ALTER TABLE `komponente_in_raum` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `komponenten`
--

LOCK TABLES `komponenten` WRITE;
/*!40000 ALTER TABLE `komponenten` DISABLE KEYS */;
/*!40000 ALTER TABLE `komponenten` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `komponentenarten`
--

LOCK TABLES `komponentenarten` WRITE;
/*!40000 ALTER TABLE `komponentenarten` DISABLE KEYS */;
INSERT INTO `komponentenarten` VALUES (1,'PC',1,'2017-06-28 08:58:38','2017-06-28 08:58:38',0),(2,'Switch',1,'2017-06-28 08:58:38','2017-06-28 08:58:38',0),(3,'Router',1,'2017-06-28 08:58:38','2017-06-28 08:58:38',0),(4,'Accesspoint',1,'2017-06-28 08:58:38','2017-06-28 08:58:38',0),(5,'Drucker',1,'2017-06-28 08:58:38','2017-06-28 08:58:38',0),(6,'Beamer',1,'2017-06-28 08:58:38','2017-06-28 08:58:38',0),(7,'Visualizer',1,'2017-06-28 08:58:38','2017-06-28 08:58:38',0),(8,'Software',0,'2017-06-28 08:58:38','2017-06-28 08:58:38',0);
/*!40000 ALTER TABLE `komponentenarten` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `komponentenattribute`
--

LOCK TABLES `komponentenattribute` WRITE;
/*!40000 ALTER TABLE `komponentenattribute` DISABLE KEYS */;
INSERT INTO `komponentenattribute` VALUES (1,'string',NULL,1,'Seriennummer'),(2,'int','MB',0,'RAM Größe'),(3,'string',NULL,0,'CPU Bezeichnung'),(4,'float','GHz',0,'CPU Takt'),(5,'int','GB',0,'Festplatte Gröse'),(6,'string',NULL,0,'Festplattenart'),(7,'string',NULL,0,'Videoanschlüsse'),(8,'int',NULL,0,'Anzahl Ports'),(9,'string',NULL,0,'Uplink Typ'),(10,'string',NULL,0,'IPs'),(11,'string',NULL,0,'WLAN Standard'),(12,'string',NULL,0,'Druckertyp'),(13,'bool',NULL,0,'Farbdrucker'),(14,'string',NULL,0,'Druckerformat'),(15,'bool',NULL,0,'Beidseitig'),(16,'int','Lumen',0,'Helligkeit'),(17,'bool',NULL,0,'Lautsprecher'),(18,'string',NULL,0,'Versionsnummer'),(19,'string',NULL,0,'Lizenztyp'),(20,'date',NULL,0,'Lizenzende'),(21,'string',NULL,0,'Lizeninformationen'),(22,'string',NULL,0,'Installationshinweise'),(23,'int',NULL,0,'Lizenzanzahl');
/*!40000 ALTER TABLE `komponentenattribute` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `lieferanten`
--

LOCK TABLES `lieferanten` WRITE;
/*!40000 ALTER TABLE `lieferanten` DISABLE KEYS */;
INSERT INTO `lieferanten` VALUES (1,'Dl More Ram. GmbH','Münchner Str. 123','90471','Nürnberg','09111235864','01575896485','0911235865','support@dlmoreram.de','2017-06-28 07:04:47','2017-06-28 07:04:47',0),(2,'Spinn Netz werk AG','Bodenbacher Str. 43','90766','Fürth','09116546783','01774558648','09116546784','spiderman@web.de','2017-06-28 07:04:47','2017-06-28 07:04:47',0),(3,'Skynet software LTD','17th D Main Road 4','12345','Bangalore, Indien','+91576894884',NULL,NULL,'t800@sky.net','2017-06-28 07:09:16','2017-06-29 08:53:23',0),(4,'Evil Corp','3027 West 12th Street, Coney Island',NULL,'New York',NULL,NULL,NULL,'tyrell.willick@ecorp.com','2017-06-29 08:59:20','2017-06-29 08:59:20',0);
/*!40000 ALTER TABLE `lieferanten` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `raeume`
--

LOCK TABLES `raeume` WRITE;
/*!40000 ALTER TABLE `raeume` DISABLE KEYS */;
INSERT INTO `raeume` VALUES (1,'15','Computerraum 1',NULL,'2017-06-28 07:13:24','2017-06-28 07:13:24',0),(2,'17','Computerraum 2',NULL,'2017-06-28 07:13:24','2017-06-28 07:13:24',0),(3,'101',NULL,NULL,'2017-06-28 07:13:24','2017-06-28 07:13:24',0),(4,'207',NULL,NULL,'2017-06-28 07:13:24','2017-06-28 07:13:24',0);
/*!40000 ALTER TABLE `raeume` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Dumping data for table `wird_beschrieben_durch`
--

LOCK TABLES `wird_beschrieben_durch` WRITE;
/*!40000 ALTER TABLE `wird_beschrieben_durch` DISABLE KEYS */;
INSERT INTO `wird_beschrieben_durch` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,17),(2,1),(2,8),(2,9),(3,1),(3,8),(3,10),(4,1),(4,11),(5,1),(5,12),(5,13),(5,14),(5,15),(6,1),(6,7),(6,16),(6,17),(7,1),(7,7),(8,18),(8,19),(8,20),(8,21),(8,23);
/*!40000 ALTER TABLE `wird_beschrieben_durch` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-29 11:56:41
