-- MariaDB dump 10.19  Distrib 10.5.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: DB_OSA
-- ------------------------------------------------------
-- Server version	10.5.18-MariaDB-0+deb11u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(10000) DEFAULT NULL,
  `receiver_username` varchar(256) DEFAULT NULL,
  `sender_username` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (12,'best in town','mihai','andrew'),(13,'WASSUP','mihai','andrew'),(14,'imi cer scuze nu am vrut sa iti dau rating 6','andrew','mihai'),(16,'dc mi ai dat 8 la profil','mihai','vladutz'),(17,'te suport','andrew','mihai'),(18,'esti prea barosan\r\n','talisman','mihai'),(19,'sefu meu','talisman','vladutz'),(22,'ff','vladutz','mihai');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) DEFAULT NULL,
  `rated_user` varchar(256) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (1,'mihai','andrew',6),(2,'andrew','mihai',7),(3,'talisman','mihai',8),(5,'mihai','talisman',10),(6,'2alex','mihai',10),(7,'2alex','alex',1),(10,'mihai','vladutz',9),(11,'vladutz','mihai',10),(12,'talisman','vladutz',8);
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `full_name` varchar(256) DEFAULT NULL,
  `about_me` varchar(10000) DEFAULT NULL,
  `photo` varchar(256) DEFAULT 'https://i.imgur.com/MjbXfBz.jpeg',
  `email` varchar(256) DEFAULT 'Not setted',
  `instagram` varchar(256) DEFAULT 'Not setted',
  `facebook` varchar(256) DEFAULT 'Not setted',
  `whatsapp` varchar(256) DEFAULT 'Not setted',
  `backgroundColor` varchar(20) DEFAULT '#372557',
  `last_visitator` varchar(256) DEFAULT 'No one',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'mihai','123','Prodan Florin Mihai Alexandru','                                                                                                                        salut sunt mihai si sunt student la fils upb anul 1 la cti engleza grupa 1211ea subgrupa 1. cel mai mult imi place materia osa careia ii aloc in fiecare zi minim 2 ore de studiu intens si sper ca intr o buna zi sa devin un programator care lucreaza in limbajele de programare html css javascript php bash si java                                                                                                                                                                                                ','https://i.kym-cdn.com/photos/images/newsfeed/002/460/462/35f.jpg','mihaiprodann@gmail.com','https://instagram.com/mihaiprodann','https://fb.com/mihaiprodann','+4 (0770) 142 656','#2c0727','vladutz'),(11,'vladutz','123','Vlad Obu','salut sunt vlad obu si am dat spaga 10000 de euro pentru a scapa de acuzatia de distrugere si tulburare a linistii publice','https://evz.ro/wp-content/uploads/2022/10/vlad-obu-1024x576.jpg','vlad@obu.com','https://www.instagram.com/vladobuu/','https://ro-ro.facebook.com/xyzwq123/','911','#8d0202','mihai'),(12,'andrew','123','Emory Andrew Tate III','                                                hello\r\nsall','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiLxgVExwp8Qv2QXIkTvBKSR2lFFBHEhFclS-BVO6pNRhmU7TbXIBxrojdpzpuP_gN2XA&usqp=CAU','andrew@tate.com','BANNED','FOR OLD BAGS','+4 (0786) 194 395','#0a7f18','mihai'),(13,'talisman','123','Talisman Tate','                                                                        Hello! I am Andrew Tate brother                                                                   ','https://i.imgur.com/8PjOUAI.png','talisman@tate.com','https://www.instagram.com/talismantate/','https://www.facebook.com/tate.talisman.3','112','#372557','mihai'),(22,'test','123',NULL,NULL,'https://i.imgur.com/MjbXfBz.jpeg','Not setted','Not setted','Not setted','Not setted','#372557','No one'),(23,'alex','123',NULL,NULL,'https://i.imgur.com/MjbXfBz.jpeg','Not setted','Not setted','Not setted','Not setted','#372557','No one');
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

-- Dump completed on 2023-01-20 13:42:45
