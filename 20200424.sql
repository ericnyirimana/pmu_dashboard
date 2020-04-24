-- MySQL dump 10.16  Distrib 10.1.44-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: pickmealup-mysql    Database: pickmealup
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `corporate_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` bigint(20) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brands_owner_id_foreign` (`owner_id`),
  KEY `brands_identifier_index` (`identifier`),
  CONSTRAINT `brands_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (4,'b1a6db88-f768-42c6-944b-a04023d45413','Baobab','3','Baobab','Baobab SRL','123456789',90,1,'2020-04-02 07:17:13','2020-04-24 04:39:46',NULL),(5,'50fc31d5-a2c1-4bae-b3cd-7e6134c66099','Pizzaioli napoletani','12','Pizzerie','Pizzaioli napoletani SRL','123456789',1,1,'2020-04-02 08:17:59','2020-04-02 08:19:11',NULL),(7,'eecf7e47-f9f5-4815-a294-82a2b8a75d1e','Gruppo Scirocco','4','Gruppo Scirocco','Gruppo Scirocco','123456789',1,1,'2020-04-02 08:21:43','2020-04-02 08:21:49',NULL),(13,'fa0b2402-490d-4a1f-923c-5d8828e008f5','test company','6',NULL,'test company','12345',68,1,'2020-04-22 12:18:40','2020-04-22 13:03:01',NULL),(14,'c39186f9-a7ea-4c4e-84f8-637582e6c1fc','qweat','3',NULL,'qwer','245234',69,1,'2020-04-22 13:03:45','2020-04-22 13:03:45',NULL);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_id` bigint(20) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `emoji` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hide` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `categories_identifier_index` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'af644258-df21-4173-a6af-0713dede40a1',15,'Food',NULL,'2020-04-02 08:48:04',NULL,'🍕',0),(2,'51779965-faf7-42b6-8d44-60dfa46be462',20,'Food',NULL,'2020-04-02 08:49:10',NULL,'🍔',0),(3,'c6ee82b1-3674-4440-acd6-ea97bd33174e',13,'Food',NULL,'2020-04-02 08:49:26',NULL,'🍝',0),(4,'6f359ad7-a868-49b2-ab04-52389e9fe55b',25,'Food',NULL,'2020-04-03 14:00:17',NULL,'🍣',0),(5,'01b55419-7994-4fbc-b5b7-fceeabe6022b',NULL,'Dietary',NULL,'2020-04-02 08:49:57',NULL,'🥑',0),(6,'a1991085-5d53-43ce-8fc5-19363c360874',NULL,'Food',NULL,'2020-04-02 08:43:43',NULL,'🍷',1),(7,'756a29e7-3a49-4fe1-a02e-adfb5d0c56f9',NULL,'Allergen',NULL,'2020-04-02 08:44:50',NULL,'🍤🙅‍♀️',0),(8,'e20731eb-b066-4cf1-8264-5099000f10f5',NULL,'Allergen',NULL,'2020-04-02 08:45:43',NULL,'🍳🙅‍♂️',0),(9,'f4578f9d-9e37-440a-a3d8-532be879c7d5',NULL,'Allergen',NULL,'2020-04-02 08:45:35',NULL,'🥜🙅‍♂️',0),(10,'5441be7a-dfa2-4190-8186-4139c8038af4',NULL,'Allergen',NULL,'2020-04-02 08:46:03',NULL,'🥛🙅‍♂️',0),(11,'56087963-3059-4453-b586-2fbc962e48f2',NULL,'Dietary',NULL,'2020-04-02 08:50:29',NULL,'✡️',0),(12,'060839ea-9c07-48ec-b498-bd013ef099d3',NULL,'Dietary',NULL,'2020-04-02 08:50:42',NULL,'☪️',0),(13,'7492f6ca-d6a9-4eb8-9fd3-1decf2388fb7',NULL,'Allergen',NULL,'2020-04-02 08:51:08',NULL,'🍞🙅‍♀️',0),(14,'456cff15-46d1-4eb8-af03-6263a21a841a',19,'Allergen','2020-04-02 08:47:46','2020-04-02 08:47:46',NULL,'🐿🙅‍♀️',0),(15,'6e75cf71-db2e-43c4-8280-74079d2b0760',18,'Food','2020-04-02 08:49:50','2020-04-02 08:49:50',NULL,'🇮🇹',0),(16,'10746606-699e-4eb5-9e29-edb6769cdd9f',21,'Dietary','2020-04-02 08:52:07','2020-04-02 08:52:07',NULL,'🥛🥦',0),(17,'92b03f85-fde8-4354-9588-d9d471a93186',22,'Food','2020-04-02 09:24:27','2020-04-02 09:24:27',NULL,'🐠',0),(18,'88a2926a-53bd-451d-bdeb-8e841a67695e',24,'Food','2020-04-03 13:52:45','2020-04-03 13:52:52',NULL,'🌮',0);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_translations`
--

DROP TABLE IF EXISTS `category_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_translations_category_id_foreign` (`category_id`),
  KEY `category_translations_code_foreign` (`code`),
  CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_translations_code_foreign` FOREIGN KEY (`code`) REFERENCES `languages` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_translations`
--

LOCK TABLES `category_translations` WRITE;
/*!40000 ALTER TABLE `category_translations` DISABLE KEYS */;
INSERT INTO `category_translations` VALUES (2,1,'Pizza','Italian Pizza','en',NULL,NULL),(4,2,'Hamburger','','en',NULL,NULL),(6,3,'Pasta','','en',NULL,NULL),(8,4,'Sushi','','en',NULL,NULL),(10,5,'Vegan','','en',NULL,NULL),(12,6,'Drink','','en',NULL,NULL),(14,7,'Crustaceans','Ocean\'s crust','en',NULL,NULL),(16,8,'Eggs','','en',NULL,NULL),(18,9,'Peanuts','','en',NULL,NULL),(20,10,'Milk','','en',NULL,NULL),(22,11,'Kosher','','en',NULL,NULL),(24,12,'Halal','','en',NULL,NULL),(26,13,'Gluten free','','en',NULL,NULL),(31,6,'Bevande',NULL,'it','2020-04-02 08:43:43','2020-04-02 08:43:43'),(32,7,'Crostacei','Crostacei','it','2020-04-02 08:44:50','2020-04-02 08:44:50'),(34,9,'Arachidi',NULL,'it','2020-04-02 08:45:35','2020-04-02 08:45:35'),(35,8,'Uova',NULL,'it','2020-04-02 08:45:43','2020-04-02 08:45:43'),(36,10,'Latte',NULL,'it','2020-04-02 08:46:03','2020-04-02 08:46:03'),(37,14,'Frutta a guscio',NULL,'it','2020-04-02 08:47:46','2020-04-02 08:47:46'),(38,1,'Pizza','Pizza Italiana','it','2020-04-02 08:48:04','2020-04-02 08:48:04'),(39,2,'Hamburger',NULL,'it','2020-04-02 08:49:10','2020-04-02 08:49:10'),(40,3,'Pasta',NULL,'it','2020-04-02 08:49:26','2020-04-02 08:49:26'),(41,15,'Italiano',NULL,'it','2020-04-02 08:49:50','2020-04-02 08:49:50'),(42,5,'Vegano','Vegano','it','2020-04-02 08:49:57','2020-04-02 08:49:57'),(43,11,'Kosher',NULL,'it','2020-04-02 08:50:29','2020-04-02 08:50:29'),(44,12,'Halal',NULL,'it','2020-04-02 08:50:42','2020-04-02 08:50:42'),(45,13,'Senza glutine',NULL,'it','2020-04-02 08:51:08','2020-04-02 08:51:08'),(46,16,'Vegetariano',NULL,'it','2020-04-02 08:52:08','2020-04-02 08:52:08'),(47,17,'Pesce',NULL,'it','2020-04-02 09:24:27','2020-04-02 09:24:27'),(49,18,'Messicano',NULL,'it','2020-04-03 13:52:52','2020-04-03 13:52:52'),(51,4,'Sushi',NULL,'it','2020-04-03 14:00:17','2020-04-03 14:00:17');
/*!40000 ALTER TABLE `category_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `closed_days`
--

DROP TABLE IF EXISTS `closed_days`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `closed_days` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `repeat` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `closed_days_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `closed_days_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `closed_days`
--

LOCK TABLES `closed_days` WRITE;
/*!40000 ALTER TABLE `closed_days` DISABLE KEYS */;
/*!40000 ALTER TABLE `closed_days` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_preferences`
--

DROP TABLE IF EXISTS `food_preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_preferences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `food_preferences_user_id_foreign` (`user_id`),
  KEY `food_preferences_category_id_foreign` (`category_id`),
  CONSTRAINT `food_preferences_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `food_preferences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_preferences`
--

LOCK TABLES `food_preferences` WRITE;
/*!40000 ALTER TABLE `food_preferences` DISABLE KEYS */;
/*!40000 ALTER TABLE `food_preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `languages_code_index` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES ('en','English',NULL,NULL),('it','Italiano',NULL,NULL);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mealtype_translations`
--

DROP TABLE IF EXISTS `mealtype_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mealtype_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mealtype_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mealtype_translations_mealtype_id_foreign` (`mealtype_id`),
  KEY `mealtype_translations_code_foreign` (`code`),
  CONSTRAINT `mealtype_translations_code_foreign` FOREIGN KEY (`code`) REFERENCES `languages` (`code`),
  CONSTRAINT `mealtype_translations_mealtype_id_foreign` FOREIGN KEY (`mealtype_id`) REFERENCES `mealtypes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mealtype_translations`
--

LOCK TABLES `mealtype_translations` WRITE;
/*!40000 ALTER TABLE `mealtype_translations` DISABLE KEYS */;
INSERT INTO `mealtype_translations` VALUES (1,1,'Pranzo','it',NULL,NULL),(2,1,'Lunch','en',NULL,NULL),(3,2,'Cena','it',NULL,NULL),(4,2,'Dinner','en',NULL,NULL);
/*!40000 ALTER TABLE `mealtype_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mealtypes`
--

DROP TABLE IF EXISTS `mealtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mealtypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hour_ini` time NOT NULL,
  `hour_end` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mealtypes`
--

LOCK TABLES `mealtypes` WRITE;
/*!40000 ALTER TABLE `mealtypes` DISABLE KEYS */;
INSERT INTO `mealtypes` VALUES (1,'10:00:00','15:00:00',NULL,NULL,NULL),(2,'18:00:00','22:00:00',NULL,NULL,NULL);
/*!40000 ALTER TABLE `mealtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_brand_id_foreign` (`brand_id`),
  CONSTRAINT `media_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'A-Milano-puoi_Mangiare-sano-a-Milano-5-1024x1024.jpg','5e85905278151A-Milano-puoi_Mangiare-sano-a-Milano-5-1024x1024.jpg',NULL,'2020-04-02 07:12:19','2020-04-02 07:12:19'),(2,'baobab-burger-organico.jpg','5e859053ab8fabaobab-burger-organico.jpg',NULL,'2020-04-02 07:12:20','2020-04-02 07:12:20'),(3,'ec131a7c8664f3ef6f50b4b28ebf9d42.jpg','5e85905b17443ec131a7c8664f3ef6f50b4b28ebf9d42.jpg',NULL,'2020-04-02 07:12:29','2020-04-02 07:12:29'),(4,'Esternopescaria.jpg','5e85905ebc75dEsternopescaria.jpg',NULL,'2020-04-02 07:12:31','2020-04-02 07:12:31'),(5,'hamburger-gamberoni-al.jpg','5e85905ff0a99hamburger-gamberoni-al.jpg',NULL,'2020-04-02 07:12:32','2020-04-02 07:12:32'),(6,'miscusi-colonne-esterno.jpg','5e859061e0e30miscusi-colonne-esterno.jpg',NULL,'2020-04-02 07:12:35','2020-04-02 07:12:35'),(7,'pescaria-via-solari-polpo-fritto.jpg','5e85906487196pescaria-via-solari-polpo-fritto.jpg',NULL,'2020-04-02 07:12:37','2020-04-02 07:12:37'),(8,'Pescobar-Panino-Polpo-e1533546266145.jpg','5e859072e60bcPescobar-Panino-Polpo-e1533546266145.jpg',NULL,'2020-04-02 07:12:53','2020-04-02 07:12:53'),(9,'pesto-e-burrata.jpg','5e859075f02e6pesto-e-burrata.jpg',NULL,'2020-04-02 07:12:54','2020-04-02 07:12:54'),(10,'photo0jpg.jpg','5e8590772aaccphoto0jpg.jpg',NULL,'2020-04-02 07:12:55','2020-04-02 07:12:55'),(11,'piatto-molto-delizioso.jpg','5e85907844d5dpiatto-molto-delizioso.jpg',NULL,'2020-04-02 07:12:56','2020-04-02 07:12:56'),(12,'slider-duomo-mob01.jpg','5e85907cf2b68slider-duomo-mob01.jpg',NULL,'2020-04-02 07:13:01','2020-04-02 07:13:01'),(13,'tagliatelle-ragu.jpg','5e8590820dd45tagliatelle-ragu.jpg',NULL,'2020-04-02 07:13:07','2020-04-02 07:13:07'),(14,'Pizza Crudo e rucola.jpg','5e8590b700a2bPizza Crudo e rucola.jpg',NULL,'2020-04-02 07:13:59','2020-04-02 07:13:59'),(15,'Pizza Margherita.png','5e8590c97c837Pizza Margherita.png',NULL,'2020-04-02 07:14:19','2020-04-02 07:14:19'),(16,'Pizza Marinara.png','5e8590deeed98Pizza Marinara.png',NULL,'2020-04-02 07:14:40','2020-04-02 07:14:40'),(17,'Pizza Salsiccia e friarielli.jpg','5e8590e20b0c7Pizza Salsiccia e friarielli.jpg',NULL,'2020-04-02 07:14:42','2020-04-02 07:14:42'),(18,'Notte-bianca-Cibo-italiano-Made-Italy-piazza-agosto656x489.jpg','5e85a59c04a72Notte-bianca-Cibo-italiano-Made-Italy-piazza-agosto656x489.jpg',NULL,'2020-04-02 08:43:08','2020-04-02 08:43:08'),(19,'frutta-secca-dimare-fb-magazine.jpg','5e85a6ae8700bfrutta-secca-dimare-fb-magazine.jpg',NULL,'2020-04-02 08:47:43','2020-04-02 08:47:43'),(20,'all-american-burger-50271412.jpg','5e85a701561afall-american-burger-50271412.jpg',NULL,'2020-04-02 08:49:06','2020-04-02 08:49:06'),(21,'unnamed.jpg','5e85a7abcbd7bunnamed.jpg',NULL,'2020-04-02 08:51:56','2020-04-02 08:51:56'),(22,'Unknown.jpeg','5e85af3d628baUnknown.jpeg',NULL,'2020-04-02 09:24:14','2020-04-02 09:24:14'),(23,'b61b08a2cb140088e6078acc98244796.jpg','5e85b26ee22c3b61b08a2cb140088e6078acc98244796.jpg',NULL,'2020-04-02 09:37:51','2020-04-02 09:37:51'),(24,'burrito-638x425.jpg','5e873fa40d6f9burrito-638x425.jpg',NULL,'2020-04-03 13:52:36','2020-04-03 13:52:36'),(25,'hinode-sushi-suggerimento-dello-chef-51a07.jpg','5e87415a9ce84hinode-sushi-suggerimento-dello-chef-51a07.jpg',NULL,'2020-04-03 13:59:55','2020-04-03 13:59:55'),(26,'329852_sld.jpg','5e87512c2bd50329852_sld.jpg',NULL,'2020-04-03 15:07:24','2020-04-03 15:07:24'),(27,'photo0jpg.jpg','5e875131e0c99photo0jpg.jpg',NULL,'2020-04-03 15:07:30','2020-04-03 15:07:30');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_section_translations`
--

DROP TABLE IF EXISTS `menu_section_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_section_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_section_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_section_translations_menu_section_id_foreign` (`menu_section_id`),
  KEY `menu_section_translations_code_foreign` (`code`),
  CONSTRAINT `menu_section_translations_code_foreign` FOREIGN KEY (`code`) REFERENCES `languages` (`code`),
  CONSTRAINT `menu_section_translations_menu_section_id_foreign` FOREIGN KEY (`menu_section_id`) REFERENCES `menu_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_section_translations`
--

LOCK TABLES `menu_section_translations` WRITE;
/*!40000 ALTER TABLE `menu_section_translations` DISABLE KEYS */;
INSERT INTO `menu_section_translations` VALUES (22,14,'Bevande','it','2020-04-02 08:14:56','2020-04-02 08:14:56'),(35,26,'Drink','it','2020-04-22 10:08:01','2020-04-22 10:08:01'),(36,27,'Dish','it','2020-04-24 07:13:09','2020-04-24 07:13:09'),(37,28,'Piatti','it','2020-04-24 11:01:58','2020-04-24 11:01:58');
/*!40000 ALTER TABLE `menu_section_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_sections`
--

DROP TABLE IF EXISTS `menu_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` bigint(20) unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT '100',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_sections_menu_id_foreign` (`menu_id`),
  KEY `menu_sections_identifier_index` (`identifier`),
  CONSTRAINT `menu_sections_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_sections`
--

LOCK TABLES `menu_sections` WRITE;
/*!40000 ALTER TABLE `menu_sections` DISABLE KEYS */;
INSERT INTO `menu_sections` VALUES (14,'002f99ad-ad72-47d7-895d-8eb4555fa533',5,'Drink',100,'2020-04-02 08:14:56','2020-04-02 08:14:56'),(26,'6dbaefcc-4ecc-4ae1-b27c-c023c15709b3',9,'Drink',100,'2020-04-22 10:08:01','2020-04-22 10:08:01'),(27,'96c84e77-ca5e-489c-85e4-d2ebb680ccd1',11,'Dish',100,'2020-04-24 07:13:09','2020-04-24 07:13:09'),(28,'939f78b4-904e-4fbd-8062-8de13cc6c388',8,'Dish',100,'2020-04-24 11:01:58','2020-04-24 11:01:58');
/*!40000 ALTER TABLE `menu_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_restaurant_id_foreign` (`restaurant_id`),
  KEY `menus_identifier_index` (`identifier`),
  CONSTRAINT `menus_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (5,'d18c6d98-742a-4644-9c7a-6f6dee5649c5','Menu Sorbillo',5,0,'2020-04-02 08:10:57','2020-04-02 08:15:04',NULL),(8,'c1765f02-6e93-42c6-b9a6-d35531a20a0d','Menu Baobab',7,0,'2020-04-02 08:15:18','2020-04-02 08:15:18',NULL),(9,'58b9e274-3d59-4cbb-98c7-da49fbdf3dc1','Nuovo menu Pescaria',6,0,'2020-04-03 13:32:05','2020-04-03 13:32:05',NULL),(11,'505227fa-bfc8-448a-a160-f573a73aad65','Test menu',7,0,'2020-04-24 07:12:59','2020-04-24 07:12:59',NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_11_07_090639_create_languages_table',1),(4,'2019_11_07_092810_create_brands_table',1),(5,'2019_11_07_092820_create_media_table',1),(6,'2019_11_07_094758_create_restaurants_table',1),(7,'2019_11_07_094759_create_restaurant_details_table',1),(8,'2019_11_07_095327_create_restaurant_translations_table',1),(9,'2019_11_07_102827_create_menus_table',1),(10,'2019_11_07_102857_create_section_table',1),(11,'2019_11_07_102928_create_menu_section_translations_table',1),(12,'2019_11_07_104708_create_categories_table',1),(13,'2019_11_07_104758_create_products_table',1),(14,'2019_11_07_110427_create_product_translations_table',1),(15,'2019_11_07_110906_create_category_translations_table',1),(16,'2019_11_07_131815_create_meal_types_table',1),(17,'2019_11_07_132453_create_pu_time_slots_table',1),(18,'2019_11_07_133430_create_product_images_table',1),(19,'2019_11_07_140906_create_mealtype_translations_table',1),(20,'2019_11_07_145449_create_pick_ups_table',1),(21,'2019_11_07_150309_create_pick_up_product_table',1),(22,'2019_11_07_151556_create_offers_table',1),(23,'2019_11_07_151556_create_subscription_table',1),(24,'2019_11_07_151606_create_pickup_translations_table',1),(25,'2019_11_07_164709_create_opening_hours_table',1),(26,'2019_12_06_152133_create_closed_days_table',1),(27,'2019_12_18_090152_create_showcases_table',1),(28,'2019_12_18_095810_create_showcase_translations_table',1),(29,'2020_01_09_115031_create_restaurants_media_table',1),(30,'2020_01_24_164301_create_products_menu_sections_table',1),(31,'2020_02_03_084200_create_user_brands_table',1),(32,'2020_02_11_164227_create_products_categories_table',1),(33,'2020_02_14_162513_add_showcase_restaurants_table',1),(34,'2020_02_14_162528_add_showcase_timeslots_table',1),(35,'2020_02_14_162537_add_showcase_categories_table',1),(36,'2020_02_18_101306_add_columns_first_name_last_name_gender_birtday_table_users',1),(37,'2020_02_18_111308_create_food_preferences_table',1),(38,'2020_02_19_151802_add_column_title_showcase',1),(39,'2020_02_21_111308_create_locations_user_table',1),(40,'2020_02_26_155432_add_column_category_id_food_preferences_table',1),(41,'2020_03_02_143052_add_emoji_categories_table',1),(42,'2020_03_02_143055_add_identifier_pickup',1),(43,'2020_03_03_083039_create_orders_table',1),(44,'2020_03_03_105345_create_order_products_table',1),(45,'2020_03_05_115539_create_order_pickups_table',1),(46,'2020_04_01_144310_create_pickup_media_table',1),(47,'2020_03_31_084856_add_quantity_to_order_pickups_table',2),(48,'2020_03_31_105151_add_quantity_to_order_products_table',2),(49,'2020_04_02_081619_add_hide_column_to_categories_table',3),(50,'2020_04_06_151908_add_stripe_customer_id_to_users_table',4),(51,'2020_04_07_094104_add_billing_longitude_to_restaurants',5),(52,'2020_04_07_094120_add_billing_latitude_to_restaurants',5),(53,'2020_04_07_094321_add_billing_address_to_restaurants',5),(54,'2020_04_07_094418_add_iva_to_restaurants',5),(55,'2020_04_07_094430_add_iban_to_restaurants',5),(56,'2020_04_07_094444_add_fee_to_restaurants',5),(57,'2020_04_07_095230_add_pec_to_restaurants',5),(58,'2020_04_07_095516_add_id_code_to_restaurants',5),(59,'2020_04_08_160331_add_stripe_account_id_to_restaurants_table',6),(60,'2020_04_10_121939_create_user_restaurants_table',7),(61,'2020_04_14_155258_add_coloumn_closed_to_orders_table',8),(62,'2020_04_15_150732_add_coloumn_closed_to_orderpickups_table',9),(63,'2020_04_16_080318_add_coloumn_pickup_id_to_orderproducts_table',9),(64,'2020_04_17_122050_add_foreignkey_menu_section_id_on_products_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opening_hours`
--

DROP TABLE IF EXISTS `opening_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opening_hours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `day_of_week` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hour_ini` time NOT NULL,
  `hour_end` time NOT NULL,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `opening_hours_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `opening_hours_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opening_hours`
--

LOCK TABLES `opening_hours` WRITE;
/*!40000 ALTER TABLE `opening_hours` DISABLE KEYS */;
INSERT INTO `opening_hours` VALUES (20,6,'monday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(21,6,'tuesday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(22,6,'wednesday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(23,6,'thursday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(24,6,'friday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(25,6,'saturday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(26,6,'sunday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(55,7,'monday','18:00:00','22:00:00',0,'2020-04-03 15:29:28','2020-04-03 15:29:28'),(56,7,'monday','11:00:00','14:00:00',0,'2020-04-03 15:29:28','2020-04-03 15:29:28'),(57,7,'tuesday','10:00:00','15:00:00',0,'2020-04-03 15:29:28','2020-04-03 15:29:28'),(58,7,'wednesday','10:00:00','15:00:00',0,'2020-04-03 15:29:28','2020-04-03 15:29:28'),(59,7,'thursday','10:00:00','15:00:00',0,'2020-04-03 15:29:28','2020-04-03 15:29:28'),(60,7,'friday','10:00:00','15:00:00',0,'2020-04-03 15:29:28','2020-04-03 15:29:28'),(61,7,'saturday','10:00:00','15:00:00',0,'2020-04-03 15:29:28','2020-04-03 15:29:28'),(62,7,'sunday','10:00:00','15:00:00',0,'2020-04-03 15:29:28','2020-04-03 15:29:28'),(63,5,'monday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(64,5,'monday','18:00:00','22:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(65,5,'tuesday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(66,5,'wednesday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(67,5,'thursday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(68,5,'friday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(69,5,'saturday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(70,5,'sunday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26');
/*!40000 ALTER TABLE `opening_hours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_pickups`
--

DROP TABLE IF EXISTS `order_pickups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_pickups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `pickup_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `closed` int(11) NOT NULL DEFAULT '0',
  `is_coming` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_pickups_order_id_foreign` (`order_id`),
  KEY `order_pickups_pickup_id_foreign` (`pickup_id`),
  CONSTRAINT `order_pickups_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_pickups_pickup_id_foreign` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_pickups`
--

LOCK TABLES `order_pickups` WRITE;
/*!40000 ALTER TABLE `order_pickups` DISABLE KEYS */;
INSERT INTO `order_pickups` VALUES (1,1,4,'2020-04-08',5,0,0),(27,48,3,'2020-04-13',1,0,0),(28,49,3,'2020-04-13',1,0,0),(29,50,3,'2020-04-13',1,0,0),(30,51,3,'2020-04-13',1,0,0),(31,52,3,'2020-04-13',1,0,0),(32,53,3,'2020-04-13',1,0,0),(34,55,3,'2020-04-13',1,0,0),(35,56,3,'2020-04-13',1,0,0),(36,57,3,'2020-04-13',1,0,0),(37,58,3,'2020-04-13',1,0,0),(47,76,5,'2020-04-15',1,0,0),(49,89,4,'2020-04-15',1,0,0),(50,90,4,'2020-04-15',1,0,0),(51,91,4,'2020-04-15',1,0,0),(52,93,4,'2020-04-15',1,0,0),(53,94,4,'2020-04-15',1,0,0),(55,101,5,'2020-04-15',1,0,0),(56,102,28,'2020-04-15',3,0,0),(59,106,28,'2020-04-15',1,0,0),(61,108,5,'2020-04-15',1,0,0),(65,112,5,'2020-04-15',1,0,0),(68,115,5,'2020-04-15',6,0,0);
/*!40000 ALTER TABLE `order_pickups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `pickup_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_products_order_id_foreign` (`order_id`),
  KEY `order_products_product_id_foreign` (`product_id`),
  KEY `order_products_pickup_id_foreign` (`pickup_id`),
  CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_products_pickup_id_foreign` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` VALUES (1,1,42,'2020-04-08',3,NULL),(63,76,13,'2020-04-15',1,NULL),(65,89,43,'2020-04-15',1,NULL),(66,90,43,'2020-04-15',1,NULL),(67,91,43,'2020-04-15',1,NULL),(68,93,43,'2020-04-15',1,NULL),(69,94,43,'2020-04-15',1,NULL),(71,101,13,'2020-04-15',1,NULL),(72,102,56,'2020-04-15',3,NULL),(75,106,56,'2020-04-15',1,NULL),(77,108,43,'2020-04-15',1,NULL),(81,112,13,'2020-04-15',1,NULL),(84,115,15,'2020-04-15',6,NULL);
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `closed` int(11) NOT NULL DEFAULT '0',
  `is_coming` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_identifier_index` (`identifier`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'7fdd42da-576b-4847-9352-845b34f33de6',59,1,'2020-04-08 10:09:15','2020-04-08 10:09:15',0,0),(2,'60f57713-bcd3-4d2f-9a73-f738196b110f',42,1,'2020-04-08 10:19:35','2020-04-08 10:19:35',0,0),(3,'3f7c1866-f777-4c17-817e-15483f957bf9',42,1,'2020-04-08 10:45:42','2020-04-08 10:45:42',0,0),(33,'2ff36643-71b9-4dbf-98f4-98e871a71827',42,1,'2020-04-10 17:30:16','2020-04-10 17:30:16',0,0),(38,'5b16ec4b-18a5-482e-b9d1-55c3aa83fe7d',4,1,'2020-04-13 09:47:13','2020-04-13 09:47:13',0,0),(39,'05aa6dbe-9962-4a58-bcbf-67b26cb7c581',4,1,'2020-04-13 10:05:36','2020-04-13 10:05:36',0,0),(40,'0a0ce84d-3aa3-4b13-a29d-6891871076ce',4,1,'2020-04-13 10:06:39','2020-04-13 10:06:39',0,0),(41,'09285966-82e3-4b68-bbb8-329d9424484f',4,1,'2020-04-13 10:08:19','2020-04-13 10:08:19',0,0),(42,'257b7188-f9cd-44ad-ab0f-a4d42a3e820f',4,1,'2020-04-13 10:16:11','2020-04-13 10:16:11',0,0),(43,'bf7d5df7-e492-4650-b73e-0ff1c484bf66',4,1,'2020-04-13 10:17:53','2020-04-13 10:17:53',0,0),(44,'8ad2ff42-3483-4d57-a99c-3683ca0b6e6d',4,1,'2020-04-13 11:35:02','2020-04-13 11:35:02',0,0),(45,'6b832742-dd64-411d-915d-7ff802437b6b',4,1,'2020-04-13 13:33:14','2020-04-13 13:33:14',0,0),(48,'44ac5b3e-41e1-4444-b3d8-4e28ce44f3fc',4,1,'2020-04-13 14:02:20','2020-04-13 14:02:20',0,0),(49,'86aec2e6-9211-4e3c-b061-cd533bd7bd61',4,1,'2020-04-13 14:09:14','2020-04-13 14:09:14',0,0),(50,'5ae942f9-dd9e-4699-8ce1-bc8587fd1738',4,1,'2020-04-13 14:36:27','2020-04-13 14:36:27',0,0),(51,'536a2bdc-25a0-44a7-a744-f2723c35dbf5',4,1,'2020-04-13 14:36:53','2020-04-13 14:36:53',0,0),(52,'67030bc2-a97b-4a3d-966d-561232851bc9',4,1,'2020-04-13 14:40:54','2020-04-13 14:40:54',0,0),(53,'e4811dff-1e9c-4ea9-ac72-1806aeeeeef6',4,1,'2020-04-13 14:41:45','2020-04-13 14:41:45',0,0),(54,'840f0538-f86c-4154-960f-d5edd2f2fe17',4,1,'2020-04-13 14:42:51','2020-04-13 14:42:51',0,0),(55,'d87f7b42-04e2-40de-869d-bbe984dac1c8',4,1,'2020-04-13 14:45:18','2020-04-13 14:45:18',0,0),(56,'83a084a7-d6cf-4ea4-b617-3b07c8111ea2',4,1,'2020-04-13 14:47:57','2020-04-13 14:47:57',0,0),(57,'2b01534c-50cc-433e-8d63-2a7e4b3a8a26',4,1,'2020-04-13 14:49:05','2020-04-13 14:49:05',0,0),(58,'ac741803-8fd7-468a-a205-2e00f4f7d626',4,1,'2020-04-13 14:49:33','2020-04-13 14:49:33',0,0),(69,'23eb39bd-4fc9-4bba-9e6f-ed8bcbaaf861',4,1,'2020-04-15 08:22:05','2020-04-15 08:22:05',0,0),(70,'c5092d9a-8bec-40f8-9092-01f3ce599763',4,1,'2020-04-15 08:27:34','2020-04-15 08:27:34',0,0),(71,'a5aebc6a-0b37-4520-a7e6-865d0a19b57c',4,1,'2020-04-15 09:10:25','2020-04-15 09:10:25',0,0),(72,'bf6413c3-2206-48b3-9eb5-e3a4869de9f0',4,1,'2020-04-15 09:14:42','2020-04-15 09:14:42',0,0),(73,'7b9d48a3-1152-4c38-b653-a79d53272360',4,1,'2020-04-15 09:18:50','2020-04-15 09:18:50',0,0),(74,'6a7ecc49-d6c1-4ec0-9a2e-583550ef3b01',4,1,'2020-04-15 09:20:42','2020-04-15 09:20:42',0,0),(75,'b83a1891-e0ed-4961-809b-ed768c93dbb6',4,1,'2020-04-15 09:24:16','2020-04-15 09:24:16',0,0),(76,'8f5e0224-6675-4fb6-b8fa-3e8d4aa9230c',4,1,'2020-04-15 11:02:56','2020-04-15 11:02:56',0,0),(77,'1b5d24d6-1c23-43c6-825a-04af53982f27',4,1,'2020-04-15 11:04:55','2020-04-15 11:04:55',0,0),(78,'ee0b8786-ea0b-4008-8189-711bb65de0a8',4,1,'2020-04-15 11:06:12','2020-04-15 11:06:12',0,0),(80,'9c45854f-1620-4ac6-b81d-408a04d3a6e9',4,1,'2020-04-15 11:07:51','2020-04-15 11:07:51',0,0),(81,'57265e8f-932a-4604-acc4-94d29f0f4500',4,1,'2020-04-15 11:10:44','2020-04-15 11:10:44',0,0),(82,'898c0187-ab2c-4f9b-982a-7a96bf0eb858',4,1,'2020-04-15 11:12:16','2020-04-15 11:12:16',0,0),(83,'24ca4622-7323-43ca-ac57-d68933642e16',4,1,'2020-04-15 11:14:25','2020-04-15 11:14:25',0,0),(84,'ea1c6619-bdc0-451d-a234-c133dda9726a',4,1,'2020-04-15 11:15:49','2020-04-15 11:15:49',0,0),(85,'b05095f9-d005-44be-a027-2c8e717a3c97',4,1,'2020-04-15 11:20:43','2020-04-15 11:20:43',0,0),(86,'d669d3ea-1023-4033-87a2-abbdcd1127fd',4,1,'2020-04-15 11:24:56','2020-04-15 11:24:56',0,0),(87,'034b0d14-62ee-4c80-88ac-c95ccdd39e9b',4,1,'2020-04-15 11:27:35','2020-04-15 11:27:35',0,0),(88,'24469345-be97-4bcf-beef-3af773b18e3a',4,1,'2020-04-15 11:33:23','2020-04-15 11:33:23',0,0),(89,'c6854ebd-6bda-4197-ae83-c9738c4a6d99',4,1,'2020-04-15 11:33:49','2020-04-15 11:33:49',0,0),(90,'dbc6b2be-9470-4c6d-a475-0461898b4035',4,1,'2020-04-15 11:35:23','2020-04-15 11:35:23',0,0),(91,'c64a9c3c-ae7e-4924-900a-074b4c710031',4,1,'2020-04-15 11:36:53','2020-04-15 11:36:53',0,0),(92,'06d8b8cb-6284-45e8-a0c4-43d9916754ef',4,1,'2020-04-15 11:42:07','2020-04-15 11:42:07',0,0),(93,'b51bce4e-8c2a-4835-b166-080592f6ac28',4,1,'2020-04-15 11:45:26','2020-04-15 11:45:26',0,0),(94,'44b62d38-988b-425c-8ba3-7581b5b09506',4,1,'2020-04-15 11:46:34','2020-04-15 11:46:34',0,0),(95,'50f09e30-048c-4980-b0ba-4e4e3e585286',4,1,'2020-04-15 12:06:08','2020-04-15 12:06:08',0,0),(96,'cc8c4307-ab6a-4395-b670-c4c0c3f0d59f',4,1,'2020-04-15 12:36:10','2020-04-15 12:36:10',0,0),(97,'7182ec9a-7ecd-4b00-8fe8-38adb50ee93a',4,1,'2020-04-15 12:41:27','2020-04-15 12:41:27',0,0),(98,'d9653db4-3f3f-45af-ba51-fd840e2f187b',4,1,'2020-04-15 12:41:29','2020-04-15 12:41:29',0,0),(101,'38cabc0b-8225-447d-9b16-82e11b698beb',4,0,'2020-04-15 12:55:56','2020-04-15 12:55:56',0,0),(102,'2efea31e-b070-4d85-8a6f-8763b296bd65',4,0,'2020-04-15 12:56:38','2020-04-15 12:56:38',0,0),(104,'fbb389b1-7953-4ae7-8dbb-5a5746339a4c',4,0,'2020-04-15 12:57:57','2020-04-15 12:57:57',0,0),(106,'340cd154-28d8-405b-ad53-b3e1a801df1f',59,0,'2020-04-15 13:02:04','2020-04-15 13:02:04',0,0),(108,'38ec17a0-b504-4c6e-b750-d76f0a50bd0d',4,0,'2020-04-15 13:10:17','2020-04-15 13:10:17',0,0),(112,'d951e7bf-51d4-4014-b141-0e5018bc2168',4,0,'2020-04-15 13:24:38','2020-04-15 13:24:38',0,0),(115,'c1b9bfcd-30ce-4bdd-9645-facec7f3a5bb',4,1,'2020-04-15 13:37:41','2020-04-15 13:37:43',0,0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_media`
--

DROP TABLE IF EXISTS `pickup_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pickup_media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pickup_id` bigint(20) unsigned NOT NULL,
  `media_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pickup_media_pickup_id_foreign` (`pickup_id`),
  KEY `pickup_media_media_id_foreign` (`media_id`),
  CONSTRAINT `pickup_media_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pickup_media_pickup_id_foreign` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_media`
--

LOCK TABLES `pickup_media` WRITE;
/*!40000 ALTER TABLE `pickup_media` DISABLE KEYS */;
INSERT INTO `pickup_media` VALUES (1,3,15,NULL,NULL),(2,4,16,NULL,NULL),(3,4,17,NULL,NULL),(4,4,15,NULL,NULL),(5,5,17,NULL,NULL),(6,6,15,NULL,NULL),(7,10,15,NULL,NULL),(8,11,2,NULL,NULL),(9,12,10,NULL,NULL),(15,25,7,NULL,NULL),(16,28,7,NULL,NULL),(21,34,14,NULL,NULL),(22,37,2,NULL,NULL);
/*!40000 ALTER TABLE `pickup_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_offers`
--

DROP TABLE IF EXISTS `pickup_offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pickup_offers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pickup_id` bigint(20) unsigned NOT NULL,
  `type_offer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_offer` int(11) NOT NULL DEFAULT '1',
  `quantity_remain` int(11) NOT NULL DEFAULT '1',
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pickup_offers_pickup_id_foreign` (`pickup_id`),
  CONSTRAINT `pickup_offers_pickup_id_foreign` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_offers`
--

LOCK TABLES `pickup_offers` WRITE;
/*!40000 ALTER TABLE `pickup_offers` DISABLE KEYS */;
INSERT INTO `pickup_offers` VALUES (3,3,'combo',10,1,7,'2020-04-02 08:39:06','2020-04-22 05:42:34',NULL),(4,4,'single',10,1,7,'2020-04-02 08:56:17','2020-04-02 08:56:17',NULL),(5,5,'single',10,1,14,'2020-04-02 08:57:09','2020-04-02 08:57:42',NULL),(9,10,'single',10,1,7,'2020-04-02 09:43:32','2020-04-02 09:43:32',NULL),(10,11,'single',10,1,7,'2020-04-02 09:44:13','2020-04-02 09:44:13',NULL),(11,12,'single',10,1,14,'2020-04-02 09:44:47','2020-04-02 09:45:17',NULL),(23,25,'single',10,1,7,'2020-04-03 13:33:14','2020-04-03 13:33:14',NULL),(26,28,'single',10,1,7,'2020-04-03 14:46:31','2020-04-03 14:46:31',NULL),(29,34,'single',40,1,7,'2020-04-15 13:27:27','2020-04-15 13:27:48',NULL),(30,35,'single',10,1,7,'2020-04-24 07:59:06','2020-04-24 07:59:06',NULL),(31,36,'single',10,1,7,'2020-04-24 07:59:56','2020-04-24 07:59:56',NULL),(32,37,'single',10,1,7,'2020-04-24 10:58:22','2020-04-24 10:58:22',NULL);
/*!40000 ALTER TABLE `pickup_offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_products`
--

DROP TABLE IF EXISTS `pickup_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pickup_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `pickup_id` bigint(20) unsigned NOT NULL,
  `quantity_offer` int(11) NOT NULL DEFAULT '1',
  `quantity_remain` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pickup_products_product_id_foreign` (`product_id`),
  KEY `pickup_products_pickup_id_foreign` (`pickup_id`),
  CONSTRAINT `pickup_products_pickup_id_foreign` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pickup_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_products`
--

LOCK TABLES `pickup_products` WRITE;
/*!40000 ALTER TABLE `pickup_products` DISABLE KEYS */;
INSERT INTO `pickup_products` VALUES (8,42,4,10,1,NULL,NULL),(9,43,4,10,1,NULL,NULL),(12,42,5,10,1,NULL,NULL),(13,43,5,10,1,NULL,NULL),(14,13,5,10,1,NULL,NULL),(15,14,5,10,1,NULL,NULL),(16,15,5,10,1,NULL,NULL),(18,17,5,10,1,NULL,NULL),(20,13,6,10,1,NULL,NULL),(21,14,6,10,1,NULL,NULL),(22,15,6,10,1,NULL,NULL),(24,17,6,10,1,NULL,NULL),(26,43,10,20,1,NULL,NULL),(28,42,10,20,1,NULL,NULL),(32,52,12,20,1,NULL,NULL),(33,19,12,20,1,NULL,NULL),(34,22,12,20,1,NULL,NULL),(35,25,12,20,1,NULL,NULL),(36,28,12,20,1,NULL,NULL),(37,31,12,20,1,NULL,NULL),(69,55,25,1,1,NULL,NULL),(70,59,25,1,1,NULL,NULL),(71,60,25,1,1,NULL,NULL),(72,61,25,1,1,NULL,NULL),(82,42,34,40,1,NULL,NULL),(83,13,3,1,1,NULL,NULL),(84,14,3,1,1,NULL,NULL),(85,15,3,1,1,NULL,NULL),(87,43,3,1,1,NULL,NULL),(88,42,3,1,1,NULL,NULL),(90,59,28,1,1,NULL,NULL),(91,51,37,1,1,NULL,NULL);
/*!40000 ALTER TABLE `pickup_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_subscriptions`
--

DROP TABLE IF EXISTS `pickup_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pickup_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pickup_id` bigint(20) unsigned NOT NULL,
  `type_offer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_offer` int(11) NOT NULL DEFAULT '1',
  `quantity_remain` int(11) NOT NULL DEFAULT '1',
  `price` int(11) NOT NULL,
  `validate_days` int(11) NOT NULL,
  `quantity_per_subscription` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pickup_subscriptions_pickup_id_foreign` (`pickup_id`),
  CONSTRAINT `pickup_subscriptions_pickup_id_foreign` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_subscriptions`
--

LOCK TABLES `pickup_subscriptions` WRITE;
/*!40000 ALTER TABLE `pickup_subscriptions` DISABLE KEYS */;
INSERT INTO `pickup_subscriptions` VALUES (1,6,'single',10,1,7,10,10,'2020-04-02 08:58:09','2020-04-03 15:29:40',NULL),(3,30,'single',10,1,7,5,1,'2020-04-06 09:54:45','2020-04-06 09:54:45',NULL);
/*!40000 ALTER TABLE `pickup_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_translations`
--

DROP TABLE IF EXISTS `pickup_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pickup_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pickup_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pickup_translations_code_foreign` (`code`),
  KEY `pickup_translations_pickup_id_foreign` (`pickup_id`),
  CONSTRAINT `pickup_translations_code_foreign` FOREIGN KEY (`code`) REFERENCES `languages` (`code`),
  CONSTRAINT `pickup_translations_pickup_id_foreign` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_translations`
--

LOCK TABLES `pickup_translations` WRITE;
/*!40000 ALTER TABLE `pickup_translations` DISABLE KEYS */;
INSERT INTO `pickup_translations` VALUES (8,4,'Pizza a scelta',NULL,'it','2020-04-02 08:56:52','2020-04-02 08:56:52'),(19,11,'Panino a scelta',NULL,'it','2020-04-02 09:44:31','2020-04-02 09:44:31'),(29,5,'Pizza + bibita',NULL,'it','2020-04-03 07:30:37','2020-04-03 07:30:37'),(30,10,'Pizza a scelta 2',NULL,'it','2020-04-03 07:32:02','2020-04-03 07:32:02'),(31,12,'Panino + bibita',NULL,'it','2020-04-03 07:32:37','2020-04-03 07:32:37'),(46,25,'Panino a scelta',NULL,'it','2020-04-03 13:49:37','2020-04-03 13:49:37'),(52,6,'10 x Pizza margherita + bibita',NULL,'it','2020-04-03 15:29:40','2020-04-03 15:29:40'),(56,30,'5xPanino',NULL,'it','2020-04-06 09:54:45','2020-04-06 09:54:45'),(68,34,'Pizza crudo, rucola e scaglie',NULL,'it','2020-04-15 13:27:48','2020-04-15 13:27:48'),(71,3,'Pizza Margherita',NULL,'it','2020-04-22 05:42:34','2020-04-22 05:42:34'),(73,28,'Polpo fritto',NULL,'it','2020-04-22 10:08:33','2020-04-22 10:08:33'),(74,35,'test offer baobab',NULL,'it','2020-04-24 07:59:06','2020-04-24 07:59:06'),(75,36,'test offer baobab',NULL,'it','2020-04-24 07:59:56','2020-04-24 07:59:56'),(77,37,'rrrrr',NULL,'it','2020-04-24 12:01:12','2020-04-24 12:01:12');
/*!40000 ALTER TABLE `pickup_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickups`
--

DROP TABLE IF EXISTS `pickups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pickups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type_pickup` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeslot_id` bigint(20) unsigned NOT NULL,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `media_id` bigint(20) unsigned DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `date_ini` date NOT NULL,
  `date_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pickups_media_id_foreign` (`media_id`),
  KEY `pickups_timeslot_id_foreign` (`timeslot_id`),
  KEY `pickups_restaurant_id_foreign` (`restaurant_id`),
  KEY `pickups_identifier_index` (`identifier`),
  CONSTRAINT `pickups_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`),
  CONSTRAINT `pickups_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pickups_timeslot_id_foreign` FOREIGN KEY (`timeslot_id`) REFERENCES `timeslots` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickups`
--

LOCK TABLES `pickups` WRITE;
/*!40000 ALTER TABLE `pickups` DISABLE KEYS */;
INSERT INTO `pickups` VALUES (3,'offer',3,5,NULL,1,'2020-04-03','2020-04-23','2020-04-02 08:39:06','2020-04-03 14:46:04',NULL,'785ad074-806d-4f47-b9d4-f7824d84a4fd'),(4,'offer',3,5,NULL,1,'2020-04-02','2020-04-02','2020-04-02 08:56:17','2020-04-02 08:56:52',NULL,'64918448-ea88-4a11-b6be-56d69d4276d4'),(5,'offer',3,5,NULL,1,'2020-04-03','2020-04-03','2020-04-02 08:57:09','2020-04-03 07:30:37',NULL,'1f6c7c64-c565-4cd6-94d7-fcfb444c3912'),(6,'subscription',3,5,NULL,1,'2020-04-02','2020-04-02','2020-04-02 08:58:09','2020-04-02 08:58:45',NULL,'42077947-fa99-4389-8b96-e8253e525899'),(10,'offer',3,5,NULL,1,'2020-04-03','2020-04-03','2020-04-02 09:43:32','2020-04-03 07:32:02',NULL,'bdcd770e-f2b2-46b0-b48f-bc4f2cbf9302'),(11,'offer',7,7,NULL,1,'2020-04-02','2020-04-02','2020-04-02 09:44:13','2020-04-02 09:44:31',NULL,'a448f45d-e30b-4753-b1d4-af1c7a20e973'),(12,'offer',7,7,NULL,1,'2020-04-03','2020-04-03','2020-04-02 09:44:47','2020-04-03 07:32:37',NULL,'c8d0969c-5c0a-4bc6-bf2e-3718f0e720c7'),(25,'offer',6,6,NULL,0,'2020-04-03','2020-04-03','2020-04-03 13:33:14','2020-04-03 13:49:37',NULL,'b74949a7-5424-4f0f-909a-2426c4eac0c0'),(28,'offer',6,6,NULL,0,'2020-04-03','2020-04-25','2020-04-03 14:46:31','2020-04-03 14:46:31',NULL,'e00423a9-34c6-453a-a05a-1e4e48902255'),(30,'subscription',6,6,NULL,0,'2020-04-06','2020-04-30','2020-04-06 09:54:45','2020-04-06 09:54:45',NULL,'f6ea9cbd-dec9-4803-b857-41a3a4e6af39'),(34,'offer',3,5,NULL,0,'2020-04-15','2020-04-15','2020-04-15 13:27:27','2020-04-15 13:27:27',NULL,'c585fd31-f1a3-438d-86d9-81bf9fd4f2b3'),(35,'offer',7,7,NULL,0,'2020-04-24','2020-04-24','2020-04-24 07:59:06','2020-04-24 07:59:06',NULL,'a1ab3605-7438-487c-a446-f6043f07dc78'),(36,'offer',7,7,NULL,0,'2020-04-24','2020-04-24','2020-04-24 07:59:56','2020-04-24 07:59:56',NULL,'6d978121-05a6-4cc4-b5ef-9115b7fb282a'),(37,'offer',7,7,NULL,0,'2020-04-24','2020-04-24','2020-04-24 10:58:22','2020-04-24 10:58:22',NULL,'555e0038-5d78-4974-a2fc-9b8c1b8f5c37');
/*!40000 ALTER TABLE `pickups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_menu_sections`
--

DROP TABLE IF EXISTS `product_menu_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_menu_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `menu_section_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_menu_sections_product_id_foreign` (`product_id`),
  KEY `product_menu_sections_menu_section_id_foreign` (`menu_section_id`),
  CONSTRAINT `product_menu_sections_menu_section_id_foreign` FOREIGN KEY (`menu_section_id`) REFERENCES `menu_sections` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_menu_sections_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_menu_sections`
--

LOCK TABLES `product_menu_sections` WRITE;
/*!40000 ALTER TABLE `product_menu_sections` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_menu_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_translations`
--

DROP TABLE IF EXISTS `product_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `ingredients` text COLLATE utf8mb4_unicode_ci,
  `categories` text COLLATE utf8mb4_unicode_ci,
  `allergens` text COLLATE utf8mb4_unicode_ci,
  `dietary` text COLLATE utf8mb4_unicode_ci,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_translations_product_id_foreign` (`product_id`),
  KEY `product_translations_code_foreign` (`code`),
  CONSTRAINT `product_translations_code_foreign` FOREIGN KEY (`code`) REFERENCES `languages` (`code`),
  CONSTRAINT `product_translations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_translations`
--

LOCK TABLES `product_translations` WRITE;
/*!40000 ALTER TABLE `product_translations` DISABLE KEYS */;
INSERT INTO `product_translations` VALUES (24,13,'Acqua naturale','500 ml.','Acqua',NULL,NULL,NULL,'it','2020-04-02 07:42:59','2020-04-02 07:42:59'),(25,14,'Acqua frizzante','500 ml.','Acqua frizzante',NULL,NULL,NULL,'it','2020-04-02 07:43:20','2020-04-02 07:43:20'),(26,15,'Birra alla spina','400 ml.','Birra alla spina',NULL,NULL,NULL,'it','2020-04-02 07:43:40','2020-04-02 07:43:40'),(28,17,'Sprite','330 ml.','Sprite',NULL,NULL,NULL,'it','2020-04-02 07:44:10','2020-04-02 07:44:10'),(30,19,'Acqua naturale','500 ml.','Acqua naturale',NULL,NULL,NULL,'it','2020-04-02 07:48:20','2020-04-02 07:48:20'),(34,22,'Acqua frizzante','500 ml.','Acqua frizzante',NULL,NULL,NULL,'it','2020-04-02 07:49:03','2020-04-02 07:49:03'),(37,25,'Birra alla spina','400 ml.','Birra alla spina',NULL,NULL,NULL,'it','2020-04-02 07:49:43','2020-04-02 07:49:43'),(40,28,'Coca cola','330 ml.','Coca cola',NULL,NULL,NULL,'it','2020-04-02 07:50:15','2020-04-02 07:50:15'),(43,31,'Sprite','330 ml.','Sprite',NULL,NULL,NULL,'it','2020-04-02 07:52:39','2020-04-02 07:52:39'),(56,42,'Pizza crudo, rucole e scaglie di grana','Pizza crudo, rucole e scaglie di grana','Crudo, rucole e scaglie di grana',NULL,NULL,NULL,'it','2020-04-02 08:54:15','2020-04-02 08:54:15'),(58,43,'Pizza marinara','Pizza marinara','Pomodoro, origano, aglio',NULL,NULL,NULL,'it','2020-04-02 08:55:12','2020-04-02 08:55:12'),(67,51,'Hamburger bufala','100% manzo italiano, mozzarella di bufala campana doc, pomodoro di Sorrento','100% manzo italiano, mozzarella di bufala campana doc, pomodoro di Sorrento',NULL,NULL,NULL,'it','2020-04-02 09:36:31','2020-04-02 09:36:31'),(68,52,'Hamburger parmigiana','100% manzo italiano, parmigiana di melanzane scomposta, salsa di basilico','100% manzo italiano, parmigiana di melanzane scomposta, salsa di basilico',NULL,NULL,NULL,'it','2020-04-02 09:38:52','2020-04-02 09:38:52'),(72,55,'Acqua naturale','500 ml.','Acqua',NULL,NULL,NULL,'it','2020-04-03 13:36:50','2020-04-03 13:36:50'),(73,56,'Polpo fritto','300g di polpo fritto, rape aglio e olio, mosto cotto di fichi, ricotta e pepe, olio alle alici','300g di polpo fritto, rape aglio e olio, mosto cotto di fichi, ricotta e pepe, olio alle alici',NULL,NULL,NULL,'it','2020-04-03 13:38:13','2020-04-03 13:38:13'),(74,57,'Gamberoni al ghiaccio','170g di gamberoni leggermente bolliti, melanzana infornata, fiordilatte, pancetta Santoro, chips di patate, ketchup fatto in casa, maionese affumicata e rucola fresca','170g di gamberoni leggermente bolliti, melanzana infornata, fiordilatte, pancetta Santoro, chips di patate, ketchup fatto in casa, maionese affumicata e rucola fresca',NULL,NULL,NULL,'it','2020-04-03 13:45:28','2020-04-03 13:45:28'),(75,58,'Tartare di tonno','100g di tartare di tonno, burrata, pomodoro fresco, olio al cappero e pesto al basilico','100g di tartare di tonno, burrata, pomodoro fresco, olio al cappero e pesto al basilico',NULL,NULL,NULL,'it','2020-04-03 13:46:00','2020-04-03 13:46:00'),(76,59,'Acqua frizzante','500 ml.','Acqua frizzante',NULL,NULL,NULL,'it','2020-04-03 13:46:23','2020-04-03 13:46:23'),(77,60,'Coca cola','330 ml.','Coca cola',NULL,NULL,NULL,'it','2020-04-03 13:46:41','2020-04-03 13:46:41'),(78,61,'Vino bianco della casa','400 ml.','Vino bianco della casa',NULL,NULL,NULL,'it','2020-04-03 13:47:02','2020-04-03 13:47:02');
/*!40000 ALTER TABLE `product_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `menu_section_id` bigint(20) unsigned DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT '100',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_restaurant_id_foreign` (`restaurant_id`),
  KEY `products_menu_section_id_foreign` (`menu_section_id`),
  KEY `products_identifier_index` (`identifier`),
  CONSTRAINT `products_menu_section_id_foreign` FOREIGN KEY (`menu_section_id`) REFERENCES `menu_sections` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (13,'4708864d-8d61-4045-9537-4bff472720af',2.50,5,14,0,'Drink',100,'2020-04-02 07:42:59','2020-04-02 08:15:01',NULL),(14,'22e10126-ce2d-4871-85b5-b52ba91927af',2.50,5,14,0,'Drink',100,'2020-04-02 07:43:20','2020-04-02 08:15:01',NULL),(15,'4b9f8f8c-a267-4801-8bd7-dbbfe213b7a1',4.50,5,14,0,'Drink',100,'2020-04-02 07:43:40','2020-04-02 08:15:01',NULL),(17,'a2dbffd4-aa24-451a-bf7a-8e30380b7a3f',3.50,5,NULL,0,'Drink',100,'2020-04-02 07:44:10','2020-04-22 05:38:05',NULL),(19,'4708864d-8d61-4045-9537-4bff472720af',2.50,7,NULL,0,'Drink',100,'2020-04-02 07:42:59','2020-04-02 08:15:59',NULL),(22,'22e10126-ce2d-4871-85b5-b52ba91927af',2.50,7,NULL,0,'Drink',100,'2020-04-02 07:43:20','2020-04-02 08:15:59',NULL),(25,'4b9f8f8c-a267-4801-8bd7-dbbfe213b7a1',4.50,7,NULL,0,'Drink',100,'2020-04-02 07:43:40','2020-04-02 08:15:59',NULL),(28,'fba3c1bf-3640-4ded-a1e9-bd23283c7f02',3.50,7,NULL,0,'Drink',100,'2020-04-02 07:43:57','2020-04-02 08:15:59',NULL),(31,'a2dbffd4-aa24-451a-bf7a-8e30380b7a3f',3.50,7,NULL,0,'Drink',100,'2020-04-02 07:44:10','2020-04-02 08:15:59',NULL),(42,'72366a6d-01de-4038-a920-222ea73f622b',10.00,5,NULL,0,'Dish',3,'2020-04-02 08:54:15','2020-04-02 09:29:27',NULL),(43,'3c9f798d-0ca1-4033-b152-339aafd44513',7.50,5,NULL,0,'Dish',1,'2020-04-02 08:55:02','2020-04-02 09:29:27',NULL),(51,'a180a73c-4492-4243-99c9-40dc1895cc2c',10.50,7,28,0,'Dish',100,'2020-04-02 09:36:31','2020-04-24 11:02:32',NULL),(52,'3ae38098-ad96-4037-813c-605871e7cb13',12.00,7,28,0,'Dish',100,'2020-04-02 09:38:52','2020-04-24 11:08:38',NULL),(55,'4911f899-0b38-4e18-8f66-5917f0c69804',2.50,6,NULL,0,'Drink',100,'2020-04-03 13:36:50','2020-04-03 13:36:59',NULL),(56,'035a35e7-0e1d-46c9-966a-fdfc9f279304',8.00,6,NULL,0,'Dish',100,'2020-04-03 13:38:13','2020-04-03 13:38:21',NULL),(57,'44d78725-fb12-4a33-977c-26cc79ff2827',8.00,6,NULL,0,'Dish',100,'2020-04-03 13:45:28','2020-04-22 10:02:27',NULL),(58,'737df3ab-a633-4832-a765-479681e79aa0',8.00,6,NULL,0,'Dish',100,'2020-04-03 13:46:00','2020-04-22 09:58:09',NULL),(59,'ee7caab1-c229-4cf4-95ae-e27a7946d10a',2.50,6,26,0,'Drink',100,'2020-04-03 13:46:23','2020-04-22 10:08:06',NULL),(60,'1c8c8362-b0bf-4b51-bce3-889e25491c66',3.50,6,NULL,0,'Drink',100,'2020-04-03 13:46:41','2020-04-03 13:47:20',NULL),(61,'8986c837-a679-48e8-b295-82eb091b833f',4.50,6,NULL,0,'Drink',100,'2020-04-03 13:47:02','2020-04-03 13:47:20',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_categories`
--

DROP TABLE IF EXISTS `products_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_categories_category_id_foreign` (`category_id`),
  KEY `products_categories_product_id_foreign` (`product_id`),
  CONSTRAINT `products_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_categories`
--

LOCK TABLES `products_categories` WRITE;
/*!40000 ALTER TABLE `products_categories` DISABLE KEYS */;
INSERT INTO `products_categories` VALUES (14,1,42,NULL,NULL),(15,15,42,NULL,NULL),(16,1,43,NULL,NULL),(17,15,43,NULL,NULL),(18,5,43,NULL,NULL),(38,2,51,NULL,NULL),(39,15,51,NULL,NULL),(40,8,51,NULL,NULL),(41,10,51,NULL,NULL),(42,2,52,NULL,NULL),(43,15,52,NULL,NULL),(48,15,56,NULL,NULL),(49,17,56,NULL,NULL),(50,15,57,NULL,NULL),(51,17,57,NULL,NULL),(52,7,57,NULL,NULL),(53,15,58,NULL,NULL),(54,17,58,NULL,NULL);
/*!40000 ALTER TABLE `products_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_media`
--

DROP TABLE IF EXISTS `products_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `media_id` bigint(20) unsigned NOT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_media_product_id_foreign` (`product_id`),
  KEY `products_media_media_id_foreign` (`media_id`),
  CONSTRAINT `products_media_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_media_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_media`
--

LOCK TABLES `products_media` WRITE;
/*!40000 ALTER TABLE `products_media` DISABLE KEYS */;
INSERT INTO `products_media` VALUES (14,42,14,1,NULL,NULL),(15,43,16,1,NULL,NULL),(23,51,10,1,NULL,NULL),(24,52,23,1,NULL,NULL),(27,56,7,1,NULL,NULL),(28,57,5,1,NULL,NULL),(29,58,1,1,NULL,NULL);
/*!40000 ALTER TABLE `products_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_details`
--

DROP TABLE IF EXISTS `restaurant_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `logo_media_id` bigint(20) unsigned DEFAULT NULL,
  `billing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iva` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_details_restaurant_id_foreign` (`restaurant_id`),
  KEY `restaurant_details_logo_media_id_foreign` (`logo_media_id`),
  CONSTRAINT `restaurant_details_logo_media_id_foreign` FOREIGN KEY (`logo_media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restaurant_details_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_details`
--

LOCK TABLES `restaurant_details` WRITE;
/*!40000 ALTER TABLE `restaurant_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_media`
--

DROP TABLE IF EXISTS `restaurant_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `media_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_media_restaurant_id_foreign` (`restaurant_id`),
  KEY `restaurant_media_media_id_foreign` (`media_id`),
  CONSTRAINT `restaurant_media_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restaurant_media_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_media`
--

LOCK TABLES `restaurant_media` WRITE;
/*!40000 ALTER TABLE `restaurant_media` DISABLE KEYS */;
INSERT INTO `restaurant_media` VALUES (1,5,12,NULL,NULL),(2,6,4,NULL,NULL),(3,7,3,NULL,NULL);
/*!40000 ALTER TABLE `restaurant_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_translations`
--

DROP TABLE IF EXISTS `restaurant_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `info` text COLLATE utf8mb4_unicode_ci,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_translations_restaurant_id_foreign` (`restaurant_id`),
  KEY `restaurant_translations_code_foreign` (`code`),
  CONSTRAINT `restaurant_translations_code_foreign` FOREIGN KEY (`code`) REFERENCES `languages` (`code`),
  CONSTRAINT `restaurant_translations_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_translations`
--

LOCK TABLES `restaurant_translations` WRITE;
/*!40000 ALTER TABLE `restaurant_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_stripe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(11,6) NOT NULL,
  `longitude` decimal(11,6) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `billing_longitude` decimal(11,6) NOT NULL,
  `billing_latitude` decimal(11,6) NOT NULL,
  `billing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iva` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pec` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_account_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurants_brand_id_foreign` (`brand_id`),
  KEY `restaurants_identifier_index` (`identifier`),
  CONSTRAINT `restaurants_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurants`
--

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
INSERT INTO `restaurants` VALUES (5,'7f1bf71d-210d-4c9b-86fb-a204aad5a466',5,'Pizzeria Gino Sorbillo','acct_1GSLHnD65xdUlaAo','Via Savona, 24, Milano - 20144',45.455045,9.166798,0,'2020-04-02 07:19:54','2020-04-02 07:19:54',NULL,0.000000,0.000000,NULL,NULL,NULL,'23.5',NULL,'','acct_1GSLHnD65xdUlaAo'),(6,'a1576c3e-3d89-40fa-b3a2-c4bf990587b7',7,'Pescaria - Solari','acct_1GSLHnD65xdUlaAo','Milano, Via Andrea Solari, Milano - 20144',45.455206,9.162457,0,'2020-04-02 07:20:29','2020-04-02 07:20:29',NULL,0.000000,0.000000,NULL,NULL,NULL,'23.5',NULL,'','acct_1GSLHnD65xdUlaAo'),(7,'8cd827d8-c035-45c1-b9a3-794c4e49add1',4,'Baobab - Burger organico','acct_1GSLHnD65xdUlaAo','Milano, Corso Garibaldi, Milano - 20121',45.476645,9.184162,0,'2020-04-02 07:21:15','2020-04-02 07:21:15',NULL,0.000000,0.000000,NULL,NULL,NULL,'23.5',NULL,'','acct_1GSLHnD65xdUlaAo');
/*!40000 ALTER TABLE `restaurants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `showcase_categories`
--

DROP TABLE IF EXISTS `showcase_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `showcase_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `showcase_id` bigint(20) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `showcase_categories_showcase_id_foreign` (`showcase_id`),
  KEY `showcase_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `showcase_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `showcase_categories_showcase_id_foreign` FOREIGN KEY (`showcase_id`) REFERENCES `showcases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `showcase_categories`
--

LOCK TABLES `showcase_categories` WRITE;
/*!40000 ALTER TABLE `showcase_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `showcase_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `showcase_restaurants`
--

DROP TABLE IF EXISTS `showcase_restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `showcase_restaurants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `showcase_id` bigint(20) unsigned NOT NULL,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `showcase_restaurants_showcase_id_foreign` (`showcase_id`),
  KEY `showcase_restaurants_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `showcase_restaurants_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `showcase_restaurants_showcase_id_foreign` FOREIGN KEY (`showcase_id`) REFERENCES `showcases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `showcase_restaurants`
--

LOCK TABLES `showcase_restaurants` WRITE;
/*!40000 ALTER TABLE `showcase_restaurants` DISABLE KEYS */;
/*!40000 ALTER TABLE `showcase_restaurants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `showcase_timeslots`
--

DROP TABLE IF EXISTS `showcase_timeslots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `showcase_timeslots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `showcase_id` bigint(20) unsigned NOT NULL,
  `timeslot_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `showcase_timeslots_showcase_id_foreign` (`showcase_id`),
  KEY `showcase_timeslots_timeslot_id_foreign` (`timeslot_id`),
  CONSTRAINT `showcase_timeslots_showcase_id_foreign` FOREIGN KEY (`showcase_id`) REFERENCES `showcases` (`id`) ON DELETE CASCADE,
  CONSTRAINT `showcase_timeslots_timeslot_id_foreign` FOREIGN KEY (`timeslot_id`) REFERENCES `timeslots` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `showcase_timeslots`
--

LOCK TABLES `showcase_timeslots` WRITE;
/*!40000 ALTER TABLE `showcase_timeslots` DISABLE KEYS */;
INSERT INTO `showcase_timeslots` VALUES (1,1,3),(2,2,4),(5,1,7),(6,2,8),(11,1,5),(12,2,6);
/*!40000 ALTER TABLE `showcase_timeslots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `showcase_translations`
--

DROP TABLE IF EXISTS `showcase_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `showcase_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `showcase_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `showcase_translations_code_foreign` (`code`),
  KEY `showcase_translations_showcase_id_foreign` (`showcase_id`),
  CONSTRAINT `showcase_translations_code_foreign` FOREIGN KEY (`code`) REFERENCES `languages` (`code`),
  CONSTRAINT `showcase_translations_showcase_id_foreign` FOREIGN KEY (`showcase_id`) REFERENCES `showcases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `showcase_translations`
--

LOCK TABLES `showcase_translations` WRITE;
/*!40000 ALTER TABLE `showcase_translations` DISABLE KEYS */;
INSERT INTO `showcase_translations` VALUES (1,1,'Pranzo Tempo','it',NULL,NULL),(2,1,'Lunch Time','en',NULL,NULL),(3,2,'Cena Tempo','it',NULL,NULL),(4,2,'Cena Time','en',NULL,NULL);
/*!40000 ALTER TABLE `showcase_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `showcases`
--

DROP TABLE IF EXISTS `showcases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `showcases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `showcases_identifier_index` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `showcases`
--

LOCK TABLES `showcases` WRITE;
/*!40000 ALTER TABLE `showcases` DISABLE KEYS */;
INSERT INTO `showcases` VALUES (1,'4c5521ec-1d2f-4738-8d06-3f5a7c0f0456','timeslots','',NULL,NULL,NULL,'Pranzo'),(2,'441784f5-d893-4c22-94ad-a3a372a5a2f9','timeslots','',NULL,NULL,NULL,'Cena');
/*!40000 ALTER TABLE `showcases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeslots`
--

DROP TABLE IF EXISTS `timeslots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timeslots` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `mealtype_id` int(10) unsigned NOT NULL,
  `hour_ini` time NOT NULL,
  `hour_end` time NOT NULL,
  `fixed` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timeslots_restaurant_id_foreign` (`restaurant_id`),
  KEY `timeslots_mealtype_id_foreign` (`mealtype_id`),
  KEY `timeslots_identifier_index` (`identifier`),
  CONSTRAINT `timeslots_mealtype_id_foreign` FOREIGN KEY (`mealtype_id`) REFERENCES `mealtypes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `timeslots_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeslots`
--

LOCK TABLES `timeslots` WRITE;
/*!40000 ALTER TABLE `timeslots` DISABLE KEYS */;
INSERT INTO `timeslots` VALUES (3,'bbe4e639-74bc-11ea-be39-121d6fa1bf65',5,1,'12:00:00','15:00:00',1,NULL,NULL,NULL),(4,'ec012a4c-74bc-11ea-be39-121d6fa1bf65',5,2,'18:00:00','22:00:00',1,NULL,NULL,NULL),(5,'e31f4da9-74bc-11ea-be39-121d6fa1bf65',6,1,'12:00:00','15:00:00',1,NULL,NULL,NULL),(6,'f5bc045d-74bc-11ea-be39-121d6fa1bf65',6,2,'18:00:00','22:00:00',1,NULL,NULL,NULL),(7,'fbf296ff-74bc-11ea-be39-121d6fa1bf65',7,1,'12:00:00','15:00:00',1,NULL,NULL,NULL),(8,'022d9234-74bd-11ea-be39-121d6fa1bf65',7,2,'18:00:00','22:00:00',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `timeslots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_brands`
--

DROP TABLE IF EXISTS `user_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `brand_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_brands_user_id_foreign` (`user_id`),
  KEY `user_brands_brand_id_foreign` (`brand_id`),
  CONSTRAINT `user_brands_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_brands_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_brands`
--

LOCK TABLES `user_brands` WRITE;
/*!40000 ALTER TABLE `user_brands` DISABLE KEYS */;
INSERT INTO `user_brands` VALUES (13,68,13,NULL,NULL),(14,69,14,NULL,NULL),(16,82,4,NULL,NULL),(17,90,4,NULL,NULL);
/*!40000 ALTER TABLE `user_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_locations`
--

DROP TABLE IF EXISTS `user_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_locations_user_id_foreign` (`user_id`),
  CONSTRAINT `user_locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_locations`
--

LOCK TABLES `user_locations` WRITE;
/*!40000 ALTER TABLE `user_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_restaurants`
--

DROP TABLE IF EXISTS `user_restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_restaurants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_restaurants_user_id_foreign` (`user_id`),
  KEY `user_restaurants_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `user_restaurants_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_restaurants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_restaurants`
--

LOCK TABLES `user_restaurants` WRITE;
/*!40000 ALTER TABLE `user_restaurants` DISABLE KEYS */;
INSERT INTO `user_restaurants` VALUES (3,82,7,NULL,NULL);
/*!40000 ALTER TABLE `user_restaurants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sub` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CUSTOMER',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `stripe_customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_sub_index` (`sub`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'5d53ec7a-a098-4d4d-ad69-b36d84ecc62c','','','','','igor.squadra@21ilab.com','$2y$10$gTUSWA7dGusw8sYceFzuveprKcFV.EBmZN7uqgr67qyK4c.98d62i',NULL,NULL,'{\"sub\":\"5d53ec7a-a098-4d4d-ad69-b36d84ecc62c\",\"name\":\"Igor - Admin\",\"email\":\"igor.squadra@21ilab.com\",\"role\":\"ADMIN\"}','ADMIN','2020-04-02 07:11:03','2020-04-21 06:07:32',NULL,''),(4,'12454ed8-8209-47ce-b416-478456cfe733','','','','','roberto.mezza@gmail.com','$2y$10$FvBlr2vtueDWSRmtEhKT4euXABsy4CtOvIPe6uCdfX2RiAYbO2aBG',NULL,NULL,'{\"sub\":\"12454ed8-8209-47ce-b416-478456cfe733\",\"name\":\"Roberto Mezzalira\",\"email\":\"roberto.mezza@gmail.com\",\"role\":null}','CUSTOMER','2020-01-30 12:24:15','2020-04-23 18:18:25',NULL,'cus_H5a2jTDnJM00g1'),(6,'1f21e29f-fca5-4891-a33c-c128abbadd28','','','','','marco+15@pickmealup.com','$2y$10$nbl23j0GnGJ1T9KGMMc8z.lu9FCs3XdkvxNsLLeI35YnpEHI8O.HG',NULL,NULL,'{\"sub\":\"1f21e29f-fca5-4891-a33c-c128abbadd28\",\"name\":null,\"email\":\"marco+15@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-31 09:23:31','2020-03-31 07:23:31',NULL,''),(7,'1f4daaf2-b713-44f9-9b70-d9db40d293f4','','','','','marco@pickmealup.com','$2y$10$XZkYy7UeLmNttRbuxk2ame6dejIZI1aHKqzkI/d9TxwLSTCJh5Ib6',NULL,NULL,'{\"sub\":\"1f4daaf2-b713-44f9-9b70-d9db40d293f4\",\"name\":\"Marco Vitolo\",\"email\":\"marco@pickmealup.com\",\"role\":\"PMU\"}','PMU','2019-12-01 15:21:21','2020-04-02 12:16:12',NULL,''),(8,'31d15c78-48cc-450b-9d3d-7289a6639b7d','','','','','carlo+1@pickmealup.com','$2y$10$7X7BSb6dtNeNwVjKo2OnquWTbgrjkWon8w62mBmlj0yp/.l.WcPcy',NULL,NULL,'{\"sub\":\"31d15c78-48cc-450b-9d3d-7289a6639b7d\",\"name\":\"carlo\",\"email\":\"carlo+1@pickmealup.com\",\"role\":null}','CUSTOMER','2020-02-19 09:11:11','2020-02-19 08:11:11',NULL,''),(9,'35619b95-5091-4b83-a553-34c5c32d48d5','','','','','davi.leichsenring@21ilab.com','$2y$10$dW5gfsmA5Sk68gRqn7OYm.yN6IhMYJF1zxh3.zA8Ao78xPm312PsO',NULL,NULL,'{\"sub\":\"35619b95-5091-4b83-a553-34c5c32d48d5\",\"name\":\"Davi Admin\",\"email\":\"davi.leichsenring@21ilab.com\",\"role\":\"ADMIN\"}','ADMIN','2020-01-15 17:26:43','2020-02-14 09:48:11',NULL,''),(10,'3c300cf1-fdcf-4242-9eb8-9a35c30722d1','','','','','marco+9@pickmealup.com','$2y$10$cN39j.QsBKX8b3e5py7NjOmPnJTKiNQWRTK.Q3yIyk0EMEAqGuOXu',NULL,NULL,'{\"sub\":\"3c300cf1-fdcf-4242-9eb8-9a35c30722d1\",\"name\":null,\"email\":\"marco+9@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-31 08:25:36','2020-03-31 06:25:36',NULL,''),(12,'4ba2b09c-4c3f-4e83-9479-3c55f25808ba','','','','','carlo@pickmealup.com','$2y$10$9rbtY5JY9Sr0kRjByeYwf.b4nNQSzAlwC3QA82WEAEqY07F86sb7q',NULL,NULL,'{\"sub\":\"4ba2b09c-4c3f-4e83-9479-3c55f25808ba\",\"name\":\"Carlo\",\"email\":\"carlo@pickmealup.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-02 14:04:30','2020-03-02 13:05:52',NULL,''),(14,'4ed9c725-59ee-460d-88d2-a67ab78f2d92','','','','','andrea.forzani@valuepartners.com','$2y$10$aZGWTYsjLkYw2mprX8/7POIeKZfxLw1rnLOfGs8SFmIcrqwebA8oa',NULL,NULL,'{\"sub\":\"4ed9c725-59ee-460d-88d2-a67ab78f2d92\",\"name\":\"Andrea Forzani\",\"email\":\"andrea.forzani@valuepartners.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-25 08:41:37','2020-03-25 15:34:47',NULL,''),(15,'5a143eb1-6b35-4500-ac79-1d7a1075247e','','','','','marco.vitolo@gmail.com','$2y$10$sHhxqmm3acT36FEB414pjenyzTSE9I61COJe.AzDYfejkVu8.BYqy',NULL,NULL,'{\"sub\":\"5a143eb1-6b35-4500-ac79-1d7a1075247e\",\"name\":\"Marco\",\"email\":\"marco.vitolo@gmail.com\",\"role\":null}','CUSTOMER','2020-03-30 09:26:22','2020-04-23 14:54:06',NULL,''),(16,'62083244-84dd-4247-b5e6-76297129af03','','','','','mirko.pilato@valuepartners.com','$2y$10$C55spD3X2E1Y2q.GC4wnpeoN8WFAYL/0/hOVJb3HietPBLGsR2aCe',NULL,NULL,'{\"sub\":\"62083244-84dd-4247-b5e6-76297129af03\",\"name\":\"Mirko Pilato\",\"email\":\"mirko.pilato@valuepartners.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-25 08:42:08','2020-04-24 10:59:54',NULL,''),(17,'669e500b-b2ab-42a3-bada-bff782e5f3c5','','','','','Aa@aa.ii','$2y$10$xOs6ElHj8DMcc26HZQm5K.Z2eMMTdIQqRfdoO3ntCUp5PjNE.w5m6',NULL,NULL,'{\"sub\":\"669e500b-b2ab-42a3-bada-bff782e5f3c5\",\"name\":\"Io\",\"email\":\"Aa@aa.ii\",\"role\":null}','CUSTOMER','2020-03-24 15:13:29','2020-03-24 14:13:29',NULL,''),(18,'68c3ed5a-14b9-4e0d-8380-8b136b56b074','','','','','carlo+4@pickmealup.com','$2y$10$4K3UyBwQ.7wr3OY3Cwog2uMxP0sVgMFZ8uaTY9D.DjKvaDMcOXtEq',NULL,NULL,'{\"sub\":\"68c3ed5a-14b9-4e0d-8380-8b136b56b074\",\"name\":\"carlo+4@pickmealup.com\",\"email\":\"carlo+4@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-26 16:51:07','2020-03-26 15:55:21',NULL,''),(19,'6cc5b0d8-1bbf-4a4c-a00b-4b73f7ad4340','','','','','marco+10@pickmealup.com','$2y$10$KTLuM/f4CQZQmhxKN5HX2eLKvTIAu2oqAbwkb8GMahukNlWKVdV4q',NULL,NULL,'{\"sub\":\"6cc5b0d8-1bbf-4a4c-a00b-4b73f7ad4340\",\"name\":null,\"email\":\"marco+10@pickmealup.com\",\"role\":null}','CUSTOMER','2020-02-21 14:25:04','2020-02-21 13:25:04',NULL,''),(20,'78aede67-c0c4-4927-8e7c-b8bdde8375ff','','','','','dev-ext@21ilab.com','$2y$10$RDwEH4MX0I/V68cxdCHBSOs8qR2zFi7Q5lgEzlFCoyR8craxamh.e',NULL,NULL,'{\"sub\":\"78aede67-c0c4-4927-8e7c-b8bdde8375ff\",\"name\":\"DEV User\",\"email\":\"dev-ext@21ilab.com\",\"role\":\"ADMIN\"}','ADMIN','2020-01-28 14:22:17','2020-01-28 13:22:48',NULL,''),(22,'82b574bc-3586-4837-bb85-48e72a5f3bc2','','','','','carlo+3@pickmealup.com','$2y$10$o3x4b8bxFA7snG//DibLqemLqgN.z05lD5JFbCf210SjILXffmY3W',NULL,NULL,'{\"sub\":\"82b574bc-3586-4837-bb85-48e72a5f3bc2\",\"name\":\"carlo+3@pickmealup.com\",\"email\":\"carlo+3@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-26 14:47:48','2020-03-26 13:47:48',NULL,''),(23,'85a4ae01-24e5-4651-baab-ba550185b3bf','','','','','carletto.led@gmail.com','$2y$10$XYwB1dqoHKvnLtkOP9QyXudggEFoFpR5IWTZOFIqP7rDB.oqk2NI.',NULL,NULL,'{\"sub\":\"85a4ae01-24e5-4651-baab-ba550185b3bf\",\"name\":\"carlo\",\"email\":\"carletto.led@gmail.com\",\"role\":null}','CUSTOMER','2020-02-13 08:50:18','2020-02-13 07:50:18',NULL,''),(25,'86c0bc31-2fc7-4b95-a835-c8c630efc29d','','','','','marco.vitolo+7@gmail.com','$2y$10$jlUyWVn4mOoWonqoOzazFOmMsYltOKBwrkHlr9RwbVrhovUNIdG5K',NULL,NULL,'{\"sub\":\"86c0bc31-2fc7-4b95-a835-c8c630efc29d\",\"name\":null,\"email\":\"marco.vitolo+7@gmail.com\",\"role\":null}','CUSTOMER','2020-03-31 08:22:15','2020-03-31 06:22:15',NULL,''),(26,'8ab3f256-f566-46e2-8b9d-52e2f595221c','','','','','test1@test1.com','$2y$10$KfVYWUJtpCmW9tTQEhyq4u5RLmYtJYCwRHNrTI0ny4TJqNGyN3zYK',NULL,NULL,'{\"sub\":\"8ab3f256-f566-46e2-8b9d-52e2f595221c\",\"name\":null,\"email\":\"test1@test1.com\",\"role\":null}','CUSTOMER','2020-03-13 07:36:14','2020-03-13 06:36:14',NULL,''),(27,'8b5829da-5aa2-4fdb-aea9-2e0721123bd2','','','','','marco.vitolo+3@gmail.com','$2y$10$Lk/tPJopRFoKHKCP4Imnd.DSiP.92YNWoycyUApJpNBpKrOp/cTli',NULL,NULL,'{\"sub\":\"8b5829da-5aa2-4fdb-aea9-2e0721123bd2\",\"name\":null,\"email\":\"marco.vitolo+3@gmail.com\",\"role\":null}','CUSTOMER','2020-02-14 13:56:19','2020-02-14 12:56:19',NULL,''),(28,'8ee7c7f0-0e39-4b9b-84f7-24f2c575feb4','','','','','enrico.tenca@21ilab.com','$2y$10$6lhb3vmkCtbCa8kucHxMA.gdX.LrGWpWNmHFirptN3NpXQGEVAdfW',NULL,NULL,'{\"sub\":\"8ee7c7f0-0e39-4b9b-84f7-24f2c575feb4\",\"name\":null,\"email\":\"enrico.tenca@21ilab.com\",\"role\":null}','CUSTOMER','2020-03-31 09:32:04','2020-03-31 07:32:04',NULL,''),(29,'92bbb75e-0146-4f0a-be72-ad3c27d021fd','','','','','marco+5@pickmealup.com','$2y$10$6Lbzi3Jo5Ko5uE3l1RZyE.jB4q7t7BJCd7wHOISe1aTpdftpjFseO',NULL,NULL,'{\"sub\":\"92bbb75e-0146-4f0a-be72-ad3c27d021fd\",\"name\":null,\"email\":\"marco+5@pickmealup.com\",\"role\":null}','CUSTOMER','2020-02-21 14:20:39','2020-02-21 13:20:39',NULL,''),(30,'9f152a45-f40b-4b37-a318-db6200a5caa1','','','','','marco.vitolo+11@gmail.com','$2y$10$Y9QwIp/bNT7y3x3tT7.eOe/hsWuOF9x61lemBNlP8mDfOExavPCQa',NULL,NULL,'{\"sub\":\"9f152a45-f40b-4b37-a318-db6200a5caa1\",\"name\":\"Marco Vitolo\",\"email\":\"marco.vitolo+11@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-01-23 14:14:32','2020-04-07 06:51:25',NULL,''),(31,'9f7e2b4e-e7e9-4b96-9832-26a97e33f1dc','','','','','marco+12@pickmealup.com','$2y$10$9HxQWdSnLic/ST42WVtI/uWa9A.SMKBMN6OKYdHYhbuC4i0wTA.hG',NULL,NULL,'{\"sub\":\"9f7e2b4e-e7e9-4b96-9832-26a97e33f1dc\",\"name\":null,\"email\":\"marco+12@pickmealup.com\",\"role\":null}','CUSTOMER','2020-02-21 14:46:14','2020-02-21 13:46:14',NULL,''),(32,'a800716e-8500-4f5d-b259-d618a87edc9d','','','','','mirco.santori@gmail.com','$2y$10$jvK17dG0QlcoYHvPlcf2ruOkIBzFAZkXTeOlM8uumag7RYC2g54lC',NULL,NULL,'{\"sub\":\"a800716e-8500-4f5d-b259-d618a87edc9d\",\"name\":\"Mirco\",\"email\":\"mirco.santori@gmail.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-02 13:21:34','2020-03-02 12:21:34',NULL,''),(33,'a935218f-4667-46af-8bf5-a27b6ed65a6c','','','','','marco.vitolo+2@gmail.com','$2y$10$zgN5GlVon.8igWFeqZPtPujj1zvYS/piu.m7DFZ6eL3qSilRCVBkS',NULL,NULL,'{\"sub\":\"a935218f-4667-46af-8bf5-a27b6ed65a6c\",\"name\":\"Marco Vitolo\",\"email\":\"marco.vitolo+2@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-01-30 13:36:10','2020-01-30 12:38:41',NULL,''),(36,'d4d38d42-02e4-43c6-b912-e8a627d340c1','','','','','marco.vitolo+10@gmail.com','$2y$10$BHQCTFHZ7hcgGSShKtAyQeUQrND18.WApBlmB22d47UZyXCYf/aOa',NULL,NULL,'{\"sub\":\"d4d38d42-02e4-43c6-b912-e8a627d340c1\",\"name\":null,\"email\":\"marco.vitolo+10@gmail.com\",\"role\":null}','CUSTOMER','2020-02-14 13:59:15','2020-02-14 12:59:15',NULL,''),(39,'def1ad52-9d70-4655-980a-fcf5c67b273a','','','','','marco+1@pickmealup.com','$2y$10$ZCRy16XnhcvoNo1oCWnVE.VVbGqzG0mWzFrrGWQrVUxSBhqspHHCK',NULL,NULL,'{\"sub\":\"def1ad52-9d70-4655-980a-fcf5c67b273a\",\"name\":null,\"email\":\"marco+1@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-26 14:46:00','2020-03-26 13:46:00',NULL,''),(40,'dfd97c32-7c38-4bdb-88d9-223bb299f425','','','','','marco+11@pickmealup.com','$2y$10$m8.oeVYNnviKuArEjcCDweZuRFdMDOZUMqasyR.QU18aiZj69VO9m',NULL,NULL,'{\"sub\":\"dfd97c32-7c38-4bdb-88d9-223bb299f425\",\"name\":null,\"email\":\"marco+11@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-30 08:25:02','2020-03-30 06:25:02',NULL,''),(41,'e0f0ccfa-b0c7-42d7-97f4-56062d2d6fb1','','','','','alessandro.lanza@valuepartners.com','$2y$10$J/43ygd3DFo9DZGK.5WjIO/z6o9VIBjVUtkQAnzjm3F1QUVSCqv7y',NULL,NULL,'{\"sub\":\"e0f0ccfa-b0c7-42d7-97f4-56062d2d6fb1\",\"name\":\"Alessandro\",\"email\":\"alessandro.lanza@valuepartners.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-23 14:51:27','2020-03-23 13:52:45',NULL,''),(42,'e0ffab5a-66fc-400f-9792-945bad4b8315','','','','','giorgia.bertoni@21ilab.com','$2y$10$5Gp0pBMKIGyy6kZN/IWxmuz1VK9ERvoo1g2WHxIUb6e/hB5ppGHi.',NULL,NULL,'{\"sub\":\"e0ffab5a-66fc-400f-9792-945bad4b8315\",\"name\":\"Giorgia Bertoni\",\"email\":\"giorgia.bertoni@21ilab.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-05 09:44:37','2020-03-05 08:45:29',NULL,''),(43,'e36b3f4f-8af8-4bec-a21b-ae9e7b07ee9d','','','','','davi.leichsenring+21@21ilab.com','$2y$10$Aaffiie9uSrw9L/jtK9cWuyKjMUyJJHSBaBCe.UcwPQ1xuwx1ZOfq',NULL,NULL,'{\"sub\":\"e36b3f4f-8af8-4bec-a21b-ae9e7b07ee9d\",\"name\":\"Davi Teste\",\"email\":\"davi.leichsenring+21@21ilab.com\",\"role\":\"OWNER\"}','OWNER','2020-01-29 16:36:16','2020-01-31 15:45:46',NULL,''),(47,'4a9ed5c1-9998-4672-b962-7bd3dbe65bfa','','','','','marco.vitolo+19@gmail.com','$2y$10$noC5nhVF6q1l1hijLrTFeunDL2anQMKfs7ntiNT1DLMZJ5HsTAAne',NULL,NULL,'{\"sub\":\"4a9ed5c1-9998-4672-b962-7bd3dbe65bfa\",\"name\":null,\"email\":\"marco.vitolo+19@gmail.com\",\"role\":null}','CUSTOMER','2020-04-02 14:28:21','2020-04-02 12:28:21',NULL,''),(58,'9f5c46ce-8940-4ef3-b757-ebe7ce29f12c','','','','','marco.vitolo+36@gmail.com','$2y$10$wX7lh6H7pDIPW7itYQ7Av.23tgWESbqhlwEdVTuwGn586YmWMKZvK',NULL,NULL,'{\"sub\":\"9f5c46ce-8940-4ef3-b757-ebe7ce29f12c\",\"name\":\"Marco owner\",\"email\":\"marco.vitolo+36@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-07 08:45:18','2020-04-07 06:46:05',NULL,''),(59,'bfb1c127-b4cb-45df-996f-5af0a12c923f','','','','','igor.squad@gmail.com','$2y$10$GtgIgyvaz3LcbATy5oxsBO8o5eGLqcnPr3s03VxWrg3dbaCH9gv3.',NULL,NULL,'{\"sub\":\"bfb1c127-b4cb-45df-996f-5af0a12c923f\",\"name\":\"Igor\",\"email\":\"igor.squad@gmail.com\",\"role\":null}','CUSTOMER','2020-04-08 05:45:48','2020-04-23 13:47:19',NULL,'cus_H6NdY04CoyByjN'),(61,'db165a45-4664-4b85-b186-fe159bee24d7','','','','','paololimone@paolo.com','$2y$10$oCOojCn5gfh.LzhbJOFml.STt9k7vjqeswwhcyDG8vuEknf9Mxt.G',NULL,NULL,'{\"sub\":\"db165a45-4664-4b85-b186-fe159bee24d7\",\"name\":\"paololimone\",\"email\":\"paololimone@paolo.com\",\"role\":null}','CUSTOMER','2020-04-09 10:42:54','2020-04-09 10:00:09',NULL,''),(64,'2410d36c-87cd-4626-b3c4-b0a522a25c7d','','','','','luca.raccampo+owner10@gmail.com','$2y$10$6WKdmU.yHxBphjrv8aPibueeG4xb6QhF3ydkiz1/KpuQlqW1Aswta',NULL,NULL,'{\"sub\":\"2410d36c-87cd-4626-b3c4-b0a522a25c7d\",\"name\":\"Owner 10\",\"email\":\"luca.raccampo+owner10@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-10 10:56:11','2020-04-10 08:56:11',NULL,''),(65,'51f25a8c-3324-469d-a63c-b1b39af819d7','','','','','luca.raccampo+owner3@gmail.com','$2y$10$glj0rKjT.Fbhbd34zM6IQ.SQJ0CuuuElBuXusiAiH7IeUwVnQb7yO',NULL,NULL,'{\"sub\":\"51f25a8c-3324-469d-a63c-b1b39af819d7\",\"name\":\"Owner 3\",\"email\":\"luca.raccampo+owner3@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-09 15:00:29','2020-04-09 13:00:29',NULL,''),(66,'590ee8f9-bbdc-4086-b8ec-12a95cde8db2','','','','','luca.raccampo+owner20@gmail.com','$2y$10$YG6rHLVhWRHp4AzuwKrx9Oo25ay.QOAFhF2G0YsFx2BfGYEyfbQHe',NULL,NULL,'{\"sub\":\"590ee8f9-bbdc-4086-b8ec-12a95cde8db2\",\"name\":\"Ower 20\",\"email\":\"luca.raccampo+owner20@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-10 12:42:14','2020-04-10 14:16:20',NULL,''),(67,'7e48ca3e-ff56-421e-b6b5-399c876c44d6','','','','','luca.raccampo+owner1@gmail.com','$2y$10$dEylEnECxOWIblOEqIHAvuumLBFg8OqVKzUJdIs1Emxn/hgz7jpFS',NULL,NULL,'{\"sub\":\"7e48ca3e-ff56-421e-b6b5-399c876c44d6\",\"name\":\"Owner 1\",\"email\":\"luca.raccampo+owner1@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-09 14:51:18','2020-04-09 12:51:18',NULL,''),(68,'acd86bf1-9997-480f-999d-ca439eae5beb','','','','','luca.raccampo+owner12@gmail.com','$2y$10$N7zgsepOBuvwiAyKEJePxe8G2iDACEGr5Y/6FVuvABAYcd/r5PEsy',NULL,NULL,'{\"sub\":\"acd86bf1-9997-480f-999d-ca439eae5beb\",\"name\":\"Owner 12\",\"email\":\"luca.raccampo+owner12@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-10 12:22:43','2020-04-22 12:38:49',NULL,''),(69,'c345baea-d391-4e8f-aa10-c1d339ad58ff','','','','','luca.raccampo+owner7@gmail.com','$2y$10$2KsO8JWzuK284SJgVPH9pOQUcpkeZ86ZvV3whY2Qzl08hxUQMnsNG',NULL,NULL,'{\"sub\":\"c345baea-d391-4e8f-aa10-c1d339ad58ff\",\"name\":\"Owner 7\",\"email\":\"luca.raccampo+owner7@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-10 07:15:15','2020-04-22 13:02:44',NULL,''),(72,'1d5abbec-d046-4b50-8002-bdba723ea91a','','','','','tes@tes.it','$2y$10$PGJ389YtrUWQZQOMK0Y4u.u3wJKxAmelb5jIqoKVymK7eFSaYOnVe',NULL,NULL,'{\"sub\":\"1d5abbec-d046-4b50-8002-bdba723ea91a\",\"name\":\"test\",\"email\":\"tes@tes.it\",\"role\":\"OWNER\"}','OWNER','2020-04-10 14:11:11','2020-04-10 12:12:37',NULL,''),(73,'5b64943c-555c-4f80-9b8c-8da3e23bb90c','','','','','carlo+7@pickmealup.com','$2y$10$/2G5fVRYVmmGOmaTagnK8OdyGvrHLlyvx8yqRl.rhx1LbRMhWyrCy',NULL,NULL,'{\"sub\":\"5b64943c-555c-4f80-9b8c-8da3e23bb90c\",\"name\":\"Carl\",\"email\":\"carlo+7@pickmealup.com\",\"role\":null}','CUSTOMER','2020-04-10 15:20:31','2020-04-10 13:20:31',NULL,''),(74,'87adfa86-e3c9-47d4-a6d4-7d54b176cd53','','','','','luca.raccampo+testerr@gmail.com','$2y$10$x4j4VIJMzO0xyvFHrnA3muSiQhKxNFaFpI6lwv4tRrt1lsZaSyxHG',NULL,NULL,'{\"sub\":\"87adfa86-e3c9-47d4-a6d4-7d54b176cd53\",\"name\":\"test\",\"email\":\"luca.raccampo+testerr@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-14 07:34:08','2020-04-14 05:34:08',NULL,''),(75,'0621e20a-9238-4ff2-ae19-1857037c0652','','','','','igor.squad+1@gmail.com','$2y$10$IpbRUI1qIoszhF83OmHELe5bUKoiPK.LOAd6fWPXrOfm6Hb.HOkVK',NULL,NULL,'{\"sub\":\"0621e20a-9238-4ff2-ae19-1857037c0652\",\"name\":\"Igor\",\"email\":\"igor.squad+1@gmail.com\",\"role\":\"CUSTOMER\"}','CUSTOMER','2020-04-21 08:20:20','2020-04-21 08:20:42',NULL,''),(76,'22395522-347e-40a5-ae8a-41f8355260cd','','','','','luca.raccampo+ownermiscusi@gmail.com','$2y$10$QbSP6z28DUnPIDq8nOnLRujeq79YEL8XlPe6HiT6JLryO/cFkoKUm',NULL,NULL,'{\"sub\":\"22395522-347e-40a5-ae8a-41f8355260cd\",\"name\":\"Owner mi scusi\",\"email\":\"luca.raccampo+ownermiscusi@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-17 12:42:09','2020-04-17 12:42:09',NULL,''),(77,'80a36525-e2ed-4b62-9f83-a3d5519e11fe','','','','','luca.racccampo+owbaboba@gmail.com','$2y$10$DwJ9bAfU3FFfOtzqkUsdS.pWyOdB9WamTs2uYKYkX4BmJCiCvu1pi',NULL,NULL,'{\"sub\":\"80a36525-e2ed-4b62-9f83-a3d5519e11fe\",\"name\":\"Owener Baobab\",\"email\":\"luca.racccampo+owbaboba@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-17 12:31:27','2020-04-17 12:31:58',NULL,''),(78,'83278908-4631-4dbb-b162-df701ab40b99','','','','','10157565221909864@default.com','$2y$10$JRB/G/08k6HkD.h9E9aVSe0m/VHpeQ6XXr9zWXrOEjndj76TuSU0S',NULL,NULL,'{\"sub\":\"83278908-4631-4dbb-b162-df701ab40b99\",\"name\":\"Roberto Mezzalira\",\"email\":\"10157565221909864@default.com\",\"role\":null}','CUSTOMER','2020-04-17 12:36:50','2020-04-17 13:16:40',NULL,''),(79,'91973456-89d9-424d-8e29-c6e636673c70','','','','','luca.raccampo+lucaadmin@gmail.com','$2y$10$YZNYqQS/WDhK67x3e50VTuQeWpmtsFtX1Ry77NBnD6/F4AE5wco0C',NULL,NULL,'{\"sub\":\"91973456-89d9-424d-8e29-c6e636673c70\",\"name\":\"luca\",\"email\":\"luca.raccampo+lucaadmin@gmail.com\",\"role\":\"ADMIN\"}','ADMIN','2020-04-17 05:21:29','2020-04-17 05:21:29',NULL,''),(80,'7d73b34e-d3b5-40a0-8cbd-349b6ce7cc57','','','','','8wasdzj7dp@privaterelay.appleid.com','$2y$10$reAkLwpgUMKodkT9x4qqnuPO8k3im5fiz5wVYcR6hzlfwmS.fVQyW',NULL,NULL,'{\"sub\":\"7d73b34e-d3b5-40a0-8cbd-349b6ce7cc57\",\"name\":\"Igor\",\"email\":\"8wasdzj7dp@privaterelay.appleid.com\",\"role\":null}','CUSTOMER','2020-04-16 12:11:50','2020-04-23 12:09:06',NULL,''),(82,'68fe48af-0307-4319-9a17-29883e9aa497','','','','','luca.raccampo+ristoratore@gmail.com','$2y$10$rNvfX5MHDXYak7NOfGJfR.tXrKZrhLd6did6HE3SlcXboJXeZsiOi',NULL,'syeJF7r8gbTYiFcI6JTQImxXYStT4kGog6bMrqgyESlK16eX8nGUgcwzIEzf','{\"sub\":\"68fe48af-0307-4319-9a17-29883e9aa497\",\"name\":\"Luca Ristoratore\",\"email\":\"luca.raccampo+ristoratore@gmail.com\",\"role\":\"RESTAURATEUR\"}','RESTAURATEUR','2020-04-22 11:04:54','2020-04-24 04:40:20',NULL,''),(84,'07e31bd7-bbe4-4bfe-83b4-12798c03e6a8','','','','','davediverson1@gmail.com','$2y$10$JsOo7ZRLkxqobpFt9K9m6.JdCIatiWAfZgVbyDz4P53Fk8EEr8gyi',NULL,NULL,'{\"sub\":\"07e31bd7-bbe4-4bfe-83b4-12798c03e6a8\",\"name\":\"Test\",\"email\":\"davediverson1@gmail.com\",\"role\":null}','CUSTOMER','2020-04-24 04:28:09','2020-04-24 04:28:09',NULL,''),(85,'19a01d65-535d-4dd2-b4a0-c6881c22bd34','','','','','m.vitolo@codermine.com','$2y$10$ExpOWnFACyxYpI1yhhG83.nV.7UphWIFtX5AMOfc3dMcPGgxy7OZO',NULL,NULL,'{\"sub\":\"19a01d65-535d-4dd2-b4a0-c6881c22bd34\",\"name\":\"Marco\",\"email\":\"m.vitolo@codermine.com\",\"role\":null}','CUSTOMER','2020-04-23 17:05:28','2020-04-23 17:05:28',NULL,''),(86,'3b4150bb-6147-4ac0-a82e-39be419b4008','','','','','marco.vitolo+5@gmail.com','$2y$10$f5vcqPOOBM/IHjFv1nVb0ePYTrsTwiOTlH1gJSkJpomHTsipN1ho2',NULL,NULL,'{\"sub\":\"3b4150bb-6147-4ac0-a82e-39be419b4008\",\"name\":\"marco \",\"email\":\"marco.vitolo+5@gmail.com\",\"role\":null}','CUSTOMER','2020-04-23 14:56:49','2020-04-23 14:56:49',NULL,''),(87,'57e15370-3b3d-49c8-829f-327c522664f7','','','','','marco.vitolo@icloud.com','$2y$10$NT/bQU/Mf8/rGpcOVal/m.eV7abD1R3I4GpE0ZtXW7Vv3WNzgxwv2',NULL,NULL,'{\"sub\":\"57e15370-3b3d-49c8-829f-327c522664f7\",\"name\":\"Marco\",\"email\":\"marco.vitolo@icloud.com\",\"role\":null}','CUSTOMER','2020-04-23 14:48:52','2020-04-23 14:48:52',NULL,''),(88,'5df3bfb5-499d-4890-8b5d-3b300ebf6c09','','','','','marco.vitolo+6@gmail.com','$2y$10$0mGQUcOnc95nvz/dzcMQoOC10y.k0x7hNF7CTvikKwD3RJrVYMl1K',NULL,NULL,'{\"sub\":\"5df3bfb5-499d-4890-8b5d-3b300ebf6c09\",\"name\":\"marcolo\",\"email\":\"marco.vitolo+6@gmail.com\",\"role\":null}','CUSTOMER','2020-04-23 15:13:06','2020-04-23 15:13:06',NULL,''),(89,'6574c72b-a859-4506-9489-3aa4113bd4c7','','','','','marco.vitolo+21@gmail.com','$2y$10$Y5eXSA.kmChFdXSeatdjSuXITSlx3sj4NXrODR54b8UfHr5s6YLbq',NULL,NULL,'{\"sub\":\"6574c72b-a859-4506-9489-3aa4113bd4c7\",\"name\":\"Marco\",\"email\":\"marco.vitolo+21@gmail.com\",\"role\":null}','CUSTOMER','2020-04-23 17:07:47','2020-04-23 17:07:47',NULL,''),(90,'68e20771-17a4-4e78-bc2b-a7de97f4358b','','','','','igor.squadra+baobab@21ilab.com','$2y$10$DZcfTeSTlmA1TQgk1e1XpeLZ/.h5BR2FYELzTmO42sjbylMLFew6a',NULL,NULL,'{\"sub\":\"68e20771-17a4-4e78-bc2b-a7de97f4358b\",\"name\":\"Igor - Baobab\",\"email\":\"igor.squadra+baobab@21ilab.com\",\"role\":\"OWNER\"}','OWNER','2020-04-22 13:29:08','2020-04-24 06:24:15',NULL,''),(91,'609ef1f3-21a7-4e15-94b9-57dddd0ade47','','','','','marco.vitolo+23@gmail.com','$2y$10$gImvcwiZBPWT2lwEAFPsFeE1M32en2BUWVQEgxXNUTd9kPQf8ej/S',NULL,NULL,'{\"sub\":\"609ef1f3-21a7-4e15-94b9-57dddd0ade47\",\"name\":\"marcolo\",\"email\":\"marco.vitolo+23@gmail.com\",\"role\":null}','CUSTOMER','2020-04-24 06:05:31','2020-04-24 06:05:31',NULL,'');
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

-- Dump completed on 2020-04-24 15:48:13
