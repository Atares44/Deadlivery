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
  `user_id` int(11) NOT NULL,
  `client_rank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_orders` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C82E74A76ED395` (`user_id`),
  CONSTRAINT `FK_C82E74A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
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
  `client_id` int(11) DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `IDX_E52FFDEE19EB6921` (`client_id`),
  KEY `IDX_E52FFDEE7738FE2F` (`order_products_id`),
  KEY `IDX_E52FFDEE5E8654B3` (`order_service_id`),
  CONSTRAINT `FK_E52FFDEE19EB6921` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `FK_E52FFDEE5E8654B3` FOREIGN KEY (`order_service_id`) REFERENCES `services_type` (`id`),
  CONSTRAINT `FK_E52FFDEE7738FE2F` FOREIGN KEY (`order_products_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
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
  PRIMARY KEY (`id`),
  KEY `IDX_B3BA5A5A7E3BF6CD` (`product_service_id`),
  CONSTRAINT `FK_B3BA5A5A7E3BF6CD` FOREIGN KEY (`product_service_id`) REFERENCES `services_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,1,'Test4','test Desc 4','amorphe','Test4'),(3,1,'Test5','test desc 5','agressif','Test5');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Admin'),(2,'Gestionnaire'),(3,'Client');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services_type`
--

LOCK TABLES `services_type` WRITE;
/*!40000 ALTER TABLE `services_type` DISABLE KEYS */;
INSERT INTO `services_type` VALUES (1,'Compagnie',''),(2,'Divertissement',''),(3,'Sécurité','');
/*!40000 ALTER TABLE `services_type` ENABLE KEYS */;
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D6492BA7E081` (`user_mail`),
  KEY `IDX_8D93D649D60322AC` (`role_id`),
  CONSTRAINT `FK_8D93D649D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'Admin','Admin','Admin','admin@admin.com','00000000','[\"ROLE_ADMIN\"]','$argon2id$v=19$m=65536,t=4,p=1$GXiowpvb9Ur1vEhQZLPTjg$bHmRYyGVDNzFAu6st2F0uH8fKmEgu3rqT4UeVZA76Ns',1),(15,'Gestionnaire','Gestionnaire','Gestionnaire','gestionnaire@gestionnaire.com','00000000','[\"ROLE_GESTIONNAIRE\"]','$argon2id$v=19$m=65536,t=4,p=1$gaN0HD4aFICm6KbY3t1aiA$a7SocCpyX2ZrMU3moZSdWdM0w0xDQ3uI+TQMSYMH2q4',2),(16,'User','User','User','user@user.com','00000000','[]','$argon2id$v=19$m=65536,t=4,p=1$gdQ4l94O6d3MT9z16b+Wow$P03CEVWWy0OFGtDD4iQm1zh1ZoThoARPLWxcDN3NlMQ',NULL);
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

-- Dump completed on 2020-04-27 17:37:58
