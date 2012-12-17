-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: cal
-- ------------------------------------------------------
-- Server version	5.5.24-0ubuntu0.12.04.1

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
-- Table structure for table `cal`
--

DROP TABLE IF EXISTS `cal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cal` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_uid` int(11) DEFAULT NULL,
  `event_title` varchar(80) DEFAULT NULL,
  `event_desc` text,
  `event_start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`event_id`),
  KEY `event_start` (`event_start`),
  KEY `event_id_idx` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cal`
--

LOCK TABLES `cal` WRITE;
/*!40000 ALTER TABLE `cal` DISABLE KEYS */;
INSERT INTO `cal` VALUES (1,211094,'New year','happy new year!','2009-12-31 16:00:00','2010-01-01 15:59:59'),(2,211094,'Last Day of January','Last day of the mouth','2010-01-30 16:00:00','2010-01-31 15:59:59'),(7,211094,'Party&#26202;&#20250;','&#20170;&#22825;&#35201;&#21507;&#26202;&#39277;,&#20320;&#24320;&#19981;&#24320;&#26032;','2010-01-22 09:00:00','2010-01-22 11:00:00'),(8,211094,'&#26089;&#39277;','&#22909;&#21543;&#65292;&#25105;&#25215;&#35748;&#25105;&#36755;&#20102;,zhende ','2010-01-21 09:00:00','2010-01-21 11:00:00'),(10,211094,'&#19978;&#35838;','&#19978;&#20844;&#36873;&#35838;','2010-02-28 23:00:00','2010-03-02 15:59:59'),(11,1,'','xx','0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,1,'play','play','2010-01-22 09:00:00','2010-01-22 11:00:00'),(13,1,'admin','qqq','2010-01-17 12:00:00','2010-01-17 12:00:00'),(14,1,'aa','xx','2010-01-22 09:00:00','2010-01-22 11:00:00'),(15,1,'33','ddd','2010-01-18 09:00:00','2010-01-18 11:00:00'),(16,1,'ad','ddd','2010-01-18 09:00:00','2010-01-18 11:00:00'),(17,1,'ss','xx','2010-01-18 09:00:00','2010-01-18 14:00:00'),(18,1,'ss','xx','2010-01-19 11:00:00','2010-01-19 11:00:00'),(19,1,'www','ccc','2010-01-24 09:00:00','2010-01-24 11:00:00'),(20,1,'çœŸçš„','qq','2012-10-07 04:00:00','2012-10-07 05:00:00'),(21,1,'å¥½å§','ä¹ˆä¹ˆä¹ˆä¹ˆ','2012-10-08 04:00:00','2012-10-08 06:00:00'),(22,2,'qq','qq','2012-10-07 04:00:00','2012-10-07 05:00:00'),(23,2,'qq','qq','2012-10-07 04:00:00','2012-10-07 05:00:00'),(24,2,'qq','qq','2012-10-07 04:00:00','2012-10-07 05:00:00'),(25,2,'qq','qq','2012-10-07 04:00:00','2012-10-07 05:00:00'),(26,1,'ä½ å¥½å•Š','aaa','2012-10-14 04:00:00','2012-10-14 05:00:00'),(27,1,'4444','4444','2012-10-13 04:00:00','2012-10-13 04:00:00'),(28,1,'ä½ å¥½å','ä½ å¥½å','2012-10-07 04:00:00','2012-10-07 05:00:00'),(29,1,'1111','å¶ä¸å','2012-10-09 04:00:00','2012-10-09 05:00:00'),(30,1,'ç¾Žå¥½','??','2012-10-07 04:00:00','2012-10-07 05:00:00'),(32,1,'??','??','2012-10-07 04:00:00','2012-10-07 05:00:00'),(33,1,'22','æ–°','2012-10-07 04:00:00','2012-10-07 05:00:00'),(34,1,'å¥½å§','å¥½å§','2012-10-21 04:00:00','2012-10-21 04:00:00'),(35,NULL,'999','22222','2012-10-07 04:00:00','2012-10-07 05:00:00'),(36,211094,'444','4444','2012-10-07 04:00:00','2012-10-07 05:00:00');
/*!40000 ALTER TABLE `cal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(80) DEFAULT NULL,
  `user_pass` varchar(47) DEFAULT NULL,
  `user_email` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','6d9f2d190855fbb68caaf4b765596b44771759f967f15ea','admin@admin.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-10-14  0:09:28
