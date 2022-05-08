-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: deadlivery
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-1ubuntu1

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
-- Table structure for table `adress`
--

DROP TABLE IF EXISTS `adress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adress_number` int(11) DEFAULT NULL,
  `adress_street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress_post_code` int(11) NOT NULL,
  `adress_town` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adress`
--

LOCK TABLES `adress` WRITE;
/*!40000 ALTER TABLE `adress` DISABLE KEYS */;
/*!40000 ALTER TABLE `adress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adress_user`
--

DROP TABLE IF EXISTS `adress_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adress_user` (
  `adress_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`adress_id`,`user_id`),
  KEY `IDX_222DFD048486F9AC` (`adress_id`),
  KEY `IDX_222DFD04A76ED395` (`user_id`),
  CONSTRAINT `FK_222DFD048486F9AC` FOREIGN KEY (`adress_id`) REFERENCES `adress` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_222DFD04A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adress_user`
--

LOCK TABLES `adress_user` WRITE;
/*!40000 ALTER TABLE `adress_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `adress_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_rank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_orders` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (13,'ClientTest',0),(14,'ClientTestGestion',0),(15,'zombNew',0),(16,'zombNew',0);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients_payment_card`
--

DROP TABLE IF EXISTS `clients_payment_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients_payment_card` (
  `clients_id` int(11) NOT NULL,
  `payment_card_id` int(11) NOT NULL,
  PRIMARY KEY (`clients_id`,`payment_card_id`),
  KEY `IDX_FDEBBECFAB014612` (`clients_id`),
  KEY `IDX_FDEBBECF538594CA` (`payment_card_id`),
  CONSTRAINT `FK_FDEBBECF538594CA` FOREIGN KEY (`payment_card_id`) REFERENCES `payment_card` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FDEBBECFAB014612` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients_payment_card`
--

LOCK TABLES `clients_payment_card` WRITE;
/*!40000 ALTER TABLE `clients_payment_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients_payment_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_client_id` int(11) NOT NULL,
  `comment_product_id` int(11) NOT NULL,
  `comment_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_note` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962AF0958877` (`comment_client_id`),
  KEY `IDX_5F9E962AC765EC7A` (`comment_product_id`),
  CONSTRAINT `FK_5F9E962AC765EC7A` FOREIGN KEY (`comment_product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_5F9E962AF0958877` FOREIGN KEY (`comment_client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,13,6,'Plus puissant que spider-man','Bien !',3),(2,13,6,'Mouais','Mouais !',1),(3,14,6,'Evil Dead mec !','Amusant ces noms',5),(4,14,8,'Pas d\'idées !','Encore moins d\'idées !',5),(5,13,8,'A mon tour !','Je ne connais même pas le réalisateur !',1),(6,13,8,'Encore ?!','Pardon...',1);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `order_products_id` int(11) NOT NULL,
  `order_service_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `shipping_anumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_astreet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_apost_code` int(11) NOT NULL,
  `shipping_atown` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_acountry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_anumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_astreet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_apost_code` int(11) NOT NULL,
  `billing_atown` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_acountry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_start_date` date NOT NULL,
  `order_end_date` date NOT NULL,
  `order_price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E52FFDEE19EB6921` (`client_id`),
  KEY `IDX_E52FFDEE7738FE2F` (`order_products_id`),
  KEY `IDX_E52FFDEE5E8654B3` (`order_service_id`),
  CONSTRAINT `FK_E52FFDEE19EB6921` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `FK_E52FFDEE5E8654B3` FOREIGN KEY (`order_service_id`) REFERENCES `services_type` (`id`),
  CONSTRAINT `FK_E52FFDEE7738FE2F` FOREIGN KEY (`order_products_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (28,15,9,1,'2020-05-06','16','16 La Ferdenais',44480,'DONGES','France','16','1 rue de Pilleux',44100,'NANTES','France','20200506133701_maxime.lopez44@gmail.com','New','2020-05-15','2020-05-30',200);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_card`
--

DROP TABLE IF EXISTS `payment_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_number` varchar(19) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_month` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_year` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_security_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_card`
--

LOCK TABLES `payment_card` WRITE;
/*!40000 ALTER TABLE `payment_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_service_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_nature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B3BA5A5A7E3BF6CD` (`product_service_id`),
  CONSTRAINT `FK_B3BA5A5A7E3BF6CD` FOREIGN KEY (`product_service_id`) REFERENCES `services_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (6,2,'SamRaimi','SamRaimi','accommodant','SamRaimi.jpg','Available'),(7,3,'GeorgeARomero','GeorgeARomero','agressif','GeorgeARomero.jpg','Available'),(8,2,'LucioFulci','LucioFulci','accommodant','LucioFulci.jpg','Available'),(9,1,'StuartGordon','StuartGordon','amorphe','StuartGordon.jpg','Available'),(10,2,'WesCraven','WesCraven','accommodant','WesCraven.jpg','Available'),(11,1,'MaryLambert','MaryLambert','amorphe','MaryLambert.jpg','Available'),(12,1,'WilsonYip','WilsonYip','amorphe','WilsonYip.jpg','Available'),(13,2,'RyuheiKitamura','RyuheiKitamura','accommodant','RyuheiKitamura.jpg','Available'),(14,3,'NaoyukiTomomatsu','NaoyukiTomomatsu','agressif','NaoyukiTomomatsu.jpg','Available'),(15,3,'DannyBoyle','DannyBoyle','agressif','DannyBoyle.jpg','Available'),(16,2,'PaulWSAnderson','PaulWSAnderson','accommodant','PaulWSAnderson.jpg','Available'),(17,1,'UweBoll','UweBoll','amorphe','UweBoll.jpg','Available'),(18,2,'ZackSnyder','ZackSnyder','accommodant','ZackSnyder.jpg','Available'),(19,3,'TimBurton','TimBurton','agressif','TimBurton.jpg','Available'),(20,2,'Sabu','Sabu','accommodant','Sabu.jpg','Available'),(21,3,'HenryHobson','HenryHobson','agressif','HenryHobson.jpg','Available'),(22,1,'JoeDante','JoeDante','amorphe','JoeDante.jpg','Available');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'[\"ROLE_ADMIN\"]'),(2,'[\"ROLE_GESTIONNAIRE\"]'),(3,'[\"ROLE_USER\"]'),(5,'[\"ROLE_CLIENT\"]');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services_type`
--

DROP TABLE IF EXISTS `services_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services_type`
--

LOCK TABLES `services_type` WRITE;
/*!40000 ALTER TABLE `services_type` DISABLE KEYS */;
INSERT INTO `services_type` VALUES (1,'Compagnie','test',809),(2,'Divertissement','test',100),(3,'Sécurité','test',150);
/*!40000 ALTER TABLE `services_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_order`
--

DROP TABLE IF EXISTS `temp_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `temp_start_date` date NOT NULL,
  `temp_end_date` date NOT NULL,
  `temp_order_serv_id` int(11) NOT NULL,
  `temp_order_product_id` int(11) NOT NULL,
  `temp_order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temp_order_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temp_order_price` decimal(10,0) NOT NULL,
  `temp_shipping_anumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_shipping_astreet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_shipping_apost_code` int(11) DEFAULT NULL,
  `temp_shipping_atown` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_shipping_acountry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_billing_anumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_billing_astreet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_billing_apost_code` int(11) DEFAULT NULL,
  `temp_billing_atown` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_billing_acountry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_order_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_order`
--

LOCK TABLES `temp_order` WRITE;
/*!40000 ALTER TABLE `temp_order` DISABLE KEYS */;
INSERT INTO `temp_order` VALUES (75,'2020-05-16','2020-05-22',1,5,'New','20200506105543_maxime.lopez44@gmail.com',200,'16','16 La Ferdenais',44480,'DONGES','France','16','16 La Ferdenais',44480,'DONGES','France','2020-05-06'),(76,'2020-05-13','2020-05-23',1,11,'New','20200506115523_maxime.lopez44@gmail.com',200,'16','1 rue de Pilleux',44100,'NANTES','France','16','16 La Ferdenais',44480,'DONGES','France','2020-05-06'),(77,'2020-05-15','2020-05-30',1,9,'New','20200506133701_maxime.lopez44@gmail.com',200,'16','16 La Ferdenais',44480,'DONGES','France','16','1 rue de Pilleux',44100,'NANTES','France','2020-05-06');
/*!40000 ALTER TABLE `temp_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_mail` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `old_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D6492BA7E081` (`user_mail`),
  UNIQUE KEY `UNIQ_8D93D64919EB6921` (`client_id`),
  KEY `IDX_8D93D649D60322AC` (`role_id`),
  CONSTRAINT `FK_8D93D64919EB6921` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `FK_8D93D649D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'Admin','Admin','zombieMaster','zombieMaster@admin.com','00000000','[\"ROLE_ADMIN\"]','$argon2id$v=19$m=65536,t=4,p=1$GXiowpvb9Ur1vEhQZLPTjg$bHmRYyGVDNzFAu6st2F0uH8fKmEgu3rqT4UeVZA76Ns',1,'',13),(15,'Gestionnaire','Gestionnaire','zombieHunter','zombieHunter@gestionnaire.com','00000000','[\"ROLE_GESTIONNAIRE\"]','$argon2id$v=19$m=65536,t=4,p=1$gaN0HD4aFICm6KbY3t1aiA$a7SocCpyX2ZrMU3moZSdWdM0w0xDQ3uI+TQMSYMH2q4',2,'',14);
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

-- Dump completed on 2020-05-06 14:45:52