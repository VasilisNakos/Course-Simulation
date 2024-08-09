-- MySQL dump 10.16  Distrib 10.1.48-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: webpagesdb.it.auth.gr    Database: student4041partB
-- ------------------------------------------------------
-- Server version	10.1.48-MariaDB-0ubuntu0.18.04.1

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
-- Current Database: `student4041partB`
--


--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `Ayxwn_arithmos` int(11) NOT NULL AUTO_INCREMENT,
  `Hmeromhnia` date NOT NULL,
  `Thema` varchar(30) NOT NULL,
  `Kyriws_Keimeno` text NOT NULL,
  PRIMARY KEY (`Ayxwn_arithmos`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (6,'2008-12-15','Ανάρτηση εργασίας','Η 1η εργασία έχει ανακοινωθεί στην ιστοσελίδα «Εργασίες». Τα μαθήματα αρχίζουν τη Δευτέρα 17/12/2008'),(8,'2008-12-12','Έναρξη μαθημάτων','Τα μαθήματα αρχίζουν την Δευτέρα 17/12/2008 ');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `Ayxwn_arithmos` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(30) NOT NULL,
  `descriptions` text NOT NULL,
  `File_name` varchar(30) NOT NULL,
  PRIMARY KEY (`Ayxwn_arithmos`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'Η μνήμη και οι βασικές συναρτή','Η μνήμη του υπολογιστή είναι ένα πολύ μεγάλο σύστημα από bit','example.png'),(4,'Οι τύποι δεδομένων','Η C χειρίζεται 3 βασικούς τύπους δεδομένων: char, int και float.\r\n','example.png');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homeworks`
--

DROP TABLE IF EXISTS `homeworks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homeworks` (
  `Ayxwn_arithmos` int(11) NOT NULL AUTO_INCREMENT,
  `Stoxoi` text NOT NULL,
  `Ekfwnhsh` text NOT NULL,
  `Paradotea` text NOT NULL,
  `Hmeromhnia` date NOT NULL,
  PRIMARY KEY (`Ayxwn_arithmos`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homeworks`
--

LOCK TABLES `homeworks` WRITE;
/*!40000 ALTER TABLE `homeworks` DISABLE KEYS */;
INSERT INTO `homeworks` VALUES (3,'1. Εφαρμογή της γνώσης στην πράξη  2. Αναζήτηση, ανάλυση και σύνθεση δεδομένων και πληροφοριών, με τη χρήση και των απαραίτητων τεχνολογιών  3. Λήψη αποφάσεων','ergasia1.doc','1.Γραπτή αναφορά σε word  2.Παρουσίαση σε powerpoint','2009-05-12'),(4,'1. Ομαδική εργασία  2. Σχεδίαση, υλοποίηση, διόρθωση και τεκμηρίωση προγραμμάτων  3. Λήψη αποφάσεων','example.png','1.Γραπτή αναφορά σε word 2. Παρουσίαση σε powerpoint','2009-05-15');
/*!40000 ALTER TABLE `homeworks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `Onoma` varchar(20) NOT NULL,
  `Epwnymo` varchar(20) NOT NULL,
  `Loginame` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` enum('Tutor','Student') NOT NULL,
  UNIQUE KEY `Loginame` (`Loginame`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('Petros','Panopoulos','petrospanopoulos@gmail.com','diadiktyo1234','Student'),('Thanasis','Ioannidis','thanasis4@gmail.com','ekpaideytika1234','Student'),('Vasilis','Nakos','vasilisnakos2002@gmail.com','mathima1234','Tutor');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-13 19:14:17

