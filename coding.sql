-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: coding
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `leaderboard`
--

DROP TABLE IF EXISTS `leaderboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaderboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(20) DEFAULT NULL,
  `problem_1` int(11) DEFAULT NULL,
  `problem_2` int(11) DEFAULT NULL,
  `problem_3` int(11) DEFAULT NULL,
  `total_time` int(11) DEFAULT NULL,
  `total_stars` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team` (`team`),
  CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`team`) REFERENCES `users` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaderboard`
--

LOCK TABLES `leaderboard` WRITE;
/*!40000 ALTER TABLE `leaderboard` DISABLE KEYS */;
INSERT INTO `leaderboard` VALUES (1,'admin',1,3,5,14811,9),(2,'adminx',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `leaderboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `num` int(11) NOT NULL DEFAULT '0',
  `star` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `descrip` varchar(10000) DEFAULT NULL,
  `inputs` varchar(10000) DEFAULT NULL,
  `output` varchar(10000) DEFAULT NULL,
  `const` varchar(10000) DEFAULT NULL,
  `examp` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,'Addition of two numbers','Given two numbers, output the sum of those two numbers','There first line of input contains an integer T - the number of test cases.\r\nThen T test cases follow.\r\nFor each test case there will be integers N and M\r\n','For each test case output the sum of the two numbers','1000<=T<=1000\r\n-10000<=N<=10000\r\n-10000<=M<=10000\r\n','Input:\r\n3\r\n-10 5\r\n10 10\r\n100 -1\r\n\r\nOutput:\r\n-5\r\n20\r\n99'),(2,3,'Subtraction of two numbers','Given two numbers, output the difference of those two numbers','There first line of input contains an integer T - the number of test cases.\r\nThen T test cases follow.\r\nFor each test case there will be integers N and M\r\n','For each test case output the sum of the two numbers','1000<=T<=1000\r\n-10000<=N<=10000\r\n-10000<=M<=10000\r\n','Input:\r\n5\r\n10 20\r\n5 5\r\n5 -5\r\n0 0\r\n100 -1\r\n\r\nOutput:\r\n-10\r\n0\r\n10\r\n0\r\n101'),(3,5,'Largest of two numbers','Given two numbers, output the larger of those two numbers','There first line of input contains an integer T - the number of test cases.\r\nThen T test cases follow.\r\nFor each test case there will be integers N and M\r\n','For each test case output the sum of the two numbers','1000<=T<=1000\r\n-10000<=N<=10000\r\n-10000<=M<=10000\r\n','Input:\r\n5\r\n10 20\r\n50 50\r\n0 -1\r\n-20 -30\r\n5 0\r\n\r\nOutput:\r\n20\r\n50\r\n0\r\n-20\r\n5');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `name` varchar(20) NOT NULL DEFAULT '',
  `actual_name` varchar(20) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `sem` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','Sridhar','admin123','7 CS','8867572063','g.sridhar53@gmail.com'),('adminx','Sridhar','asdf','7 CS','8867572063','g.sridhar53@gmail.com');
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

-- Dump completed on 2015-02-15  9:24:57
