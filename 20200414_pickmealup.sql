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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (4,'b1a6db88-f768-42c6-944b-a04023d45413','Baobab','3','Baobab','Baobab SRL','123456789',1,1,'2020-04-02 07:17:13','2020-04-02 08:23:20',NULL),(5,'50fc31d5-a2c1-4bae-b3cd-7e6134c66099','Pizzaioli napoletani','12','Pizzerie','Pizzaioli napoletani SRL','123456789',NULL,1,'2020-04-02 08:17:59','2020-04-10 11:16:07',NULL),(6,'13fbd562-ad31-4c5f-8ded-6489228e0e97','Miscusi','6','Miscusi','Miscusi SRL','123456789',1,1,'2020-04-02 08:20:24','2020-04-02 08:20:29',NULL),(7,'eecf7e47-f9f5-4815-a294-82a2b8a75d1e','Gruppo Scirocco','4','Gruppo Scirocco','Gruppo Scirocco','123456789',1,1,'2020-04-02 08:21:43','2020-04-02 08:21:49',NULL),(8,'c69a18d4-a015-42c0-ac17-53553a126e5e','Trattorie Milanesi','26','Degustazioni di cantina con cucina','Trattorie Milanesi SRL','123456789',21,1,'2020-04-03 15:07:53','2020-04-03 15:08:00',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_section_translations`
--

LOCK TABLES `menu_section_translations` WRITE;
/*!40000 ALTER TABLE `menu_section_translations` DISABLE KEYS */;
INSERT INTO `menu_section_translations` VALUES (20,12,'Bevande','it','2020-04-02 08:14:12','2020-04-02 08:14:12'),(22,14,'Bevande','it','2020-04-02 08:14:56','2020-04-02 08:14:56'),(24,16,'Bevande','it','2020-04-02 08:15:51','2020-04-02 08:15:51'),(25,17,'Pizze','it','2020-04-02 08:40:40','2020-04-02 08:40:40'),(27,19,'Primi','it','2020-04-02 09:28:51','2020-04-02 09:28:51'),(28,20,'Panini','it','2020-04-02 09:30:07','2020-04-02 09:30:07'),(30,22,'Bevande','it','2020-04-03 13:32:21','2020-04-03 13:32:21'),(32,24,'Secondi','it','2020-04-06 09:14:48','2020-04-06 09:14:48'),(33,25,'Bevande','it','2020-04-06 09:14:59','2020-04-06 09:14:59'),(34,23,'Panini con il mare','it','2020-04-06 09:54:20','2020-04-06 09:54:20'),(35,26,'Antipasti','it','2020-04-14 11:26:29','2020-04-14 11:26:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_sections`
--

LOCK TABLES `menu_sections` WRITE;
/*!40000 ALTER TABLE `menu_sections` DISABLE KEYS */;
INSERT INTO `menu_sections` VALUES (12,'e6c1f0de-cbdf-4362-aea5-9cb544ea8779',7,'Drink',100,'2020-04-02 08:14:12','2020-04-02 08:14:12'),(14,'002f99ad-ad72-47d7-895d-8eb4555fa533',5,'Drink',100,'2020-04-02 08:14:56','2020-04-02 08:14:56'),(16,'86c38814-b41e-4333-b61c-d472c569d096',8,'Drink',100,'2020-04-02 08:15:51','2020-04-02 08:15:51'),(17,'993231fb-d1bb-44b6-ad5d-27f6b5cd6857',5,'Dish',100,'2020-04-02 08:40:40','2020-04-02 08:40:40'),(19,'f5498606-99ed-4292-878a-271620e7bf04',7,'Dish',100,'2020-04-02 09:28:51','2020-04-02 09:28:51'),(20,'5185b60c-c00f-4fd1-98c5-eaa2ef04f381',8,'Dish',100,'2020-04-02 09:30:07','2020-04-02 09:30:07'),(22,'3ad55e99-afb4-47fa-9bcc-cab832c5c434',9,'Drink',100,'2020-04-03 13:32:21','2020-04-03 13:32:21'),(23,'a4266533-addf-49c1-8d49-f4f9645da797',9,'Dish',100,'2020-04-03 13:37:37','2020-04-03 13:37:37'),(24,'ed9fbd14-60d8-4160-add1-710d9f36d3f5',10,'Dish',100,'2020-04-06 09:14:48','2020-04-06 09:14:48'),(25,'5d8890c4-231f-4dd6-b3ed-0df1358cfa6a',10,'Drink',100,'2020-04-06 09:14:59','2020-04-06 09:14:59'),(26,'6d313db9-0967-4487-aa80-d992e7f41403',5,'Dish',100,'2020-04-14 11:26:29','2020-04-14 11:26:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (5,'d18c6d98-742a-4644-9c7a-6f6dee5649c5','Menu Sorbillo',5,0,'2020-04-02 08:10:57','2020-04-02 08:15:04',NULL),(7,'833f015c-8149-4b1a-a56e-8ff831a1e26c','Menu Miscusi',8,0,'2020-04-02 08:13:49','2020-04-02 08:13:49',NULL),(8,'c1765f02-6e93-42c6-b9a6-d35531a20a0d','Menu Baobab',7,0,'2020-04-02 08:15:18','2020-04-02 08:15:18',NULL),(9,'58b9e274-3d59-4cbb-98c7-da49fbdf3dc1','Nuovo menu Pescaria',6,0,'2020-04-03 13:32:05','2020-04-03 13:32:05',NULL),(10,'79a95a1f-fedb-4646-8e6d-9b96c1a3b195','Menu Amici Miei',10,0,'2020-04-06 09:14:38','2020-04-06 09:14:38',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_11_07_090639_create_languages_table',1),(4,'2019_11_07_092810_create_brands_table',1),(5,'2019_11_07_092820_create_media_table',1),(6,'2019_11_07_094758_create_restaurants_table',1),(7,'2019_11_07_094759_create_restaurant_details_table',1),(8,'2019_11_07_095327_create_restaurant_translations_table',1),(9,'2019_11_07_102827_create_menus_table',1),(10,'2019_11_07_102857_create_section_table',1),(11,'2019_11_07_102928_create_menu_section_translations_table',1),(12,'2019_11_07_104708_create_categories_table',1),(13,'2019_11_07_104758_create_products_table',1),(14,'2019_11_07_110427_create_product_translations_table',1),(15,'2019_11_07_110906_create_category_translations_table',1),(16,'2019_11_07_131815_create_meal_types_table',1),(17,'2019_11_07_132453_create_pu_time_slots_table',1),(18,'2019_11_07_133430_create_product_images_table',1),(19,'2019_11_07_140906_create_mealtype_translations_table',1),(20,'2019_11_07_145449_create_pick_ups_table',1),(21,'2019_11_07_150309_create_pick_up_product_table',1),(22,'2019_11_07_151556_create_offers_table',1),(23,'2019_11_07_151556_create_subscription_table',1),(24,'2019_11_07_151606_create_pickup_translations_table',1),(25,'2019_11_07_164709_create_opening_hours_table',1),(26,'2019_12_06_152133_create_closed_days_table',1),(27,'2019_12_18_090152_create_showcases_table',1),(28,'2019_12_18_095810_create_showcase_translations_table',1),(29,'2020_01_09_115031_create_restaurants_media_table',1),(30,'2020_01_24_164301_create_products_menu_sections_table',1),(31,'2020_02_03_084200_create_user_brands_table',1),(32,'2020_02_11_164227_create_products_categories_table',1),(33,'2020_02_14_162513_add_showcase_restaurants_table',1),(34,'2020_02_14_162528_add_showcase_timeslots_table',1),(35,'2020_02_14_162537_add_showcase_categories_table',1),(36,'2020_02_18_101306_add_columns_first_name_last_name_gender_birtday_table_users',1),(37,'2020_02_18_111308_create_food_preferences_table',1),(38,'2020_02_19_151802_add_column_title_showcase',1),(39,'2020_02_21_111308_create_locations_user_table',1),(40,'2020_02_26_155432_add_column_category_id_food_preferences_table',1),(41,'2020_03_02_143052_add_emoji_categories_table',1),(42,'2020_03_02_143055_add_identifier_pickup',1),(43,'2020_03_03_083039_create_orders_table',1),(44,'2020_03_03_105345_create_order_products_table',1),(45,'2020_03_05_115539_create_order_pickups_table',1),(46,'2020_04_01_144310_create_pickup_media_table',1),(47,'2020_03_31_084856_add_quantity_to_order_pickups_table',2),(48,'2020_03_31_105151_add_quantity_to_order_products_table',2),(49,'2020_04_02_081619_add_hide_column_to_categories_table',3),(50,'2020_04_06_151908_add_stripe_customer_id_to_users_table',4),(51,'2020_04_07_094104_add_billing_longitude_to_restaurants',5),(52,'2020_04_07_094120_add_billing_latitude_to_restaurants',5),(53,'2020_04_07_094321_add_billing_address_to_restaurants',5),(54,'2020_04_07_094418_add_iva_to_restaurants',5),(55,'2020_04_07_094430_add_iban_to_restaurants',5),(56,'2020_04_07_094444_add_fee_to_restaurants',5),(57,'2020_04_07_095230_add_pec_to_restaurants',5),(58,'2020_04_07_095516_add_id_code_to_restaurants',5),(65,'2020_04_08_160331_add_stripe_account_id_to_restaurants_table',6),(66,'2020_04_10_121939_create_user_restaurants_table',6);
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
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opening_hours`
--

LOCK TABLES `opening_hours` WRITE;
/*!40000 ALTER TABLE `opening_hours` DISABLE KEYS */;
INSERT INTO `opening_hours` VALUES (20,6,'monday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(21,6,'tuesday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(22,6,'wednesday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(23,6,'thursday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(24,6,'friday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(25,6,'saturday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(26,6,'sunday','10:00:00','15:00:00',0,'2020-04-02 07:20:29','2020-04-02 07:20:29'),(34,8,'monday','10:00:00','15:00:00',0,'2020-04-02 07:21:53','2020-04-02 07:21:53'),(35,8,'tuesday','10:00:00','15:00:00',0,'2020-04-02 07:21:53','2020-04-02 07:21:53'),(36,8,'wednesday','10:00:00','15:00:00',0,'2020-04-02 07:21:53','2020-04-02 07:21:53'),(37,8,'thursday','10:00:00','15:00:00',0,'2020-04-02 07:21:53','2020-04-02 07:21:53'),(38,8,'friday','10:00:00','15:00:00',0,'2020-04-02 07:21:53','2020-04-02 07:21:53'),(39,8,'saturday','10:00:00','15:00:00',0,'2020-04-02 07:21:53','2020-04-02 07:21:53'),(40,8,'sunday','10:00:00','15:00:00',0,'2020-04-02 07:21:53','2020-04-02 07:21:53'),(63,5,'monday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(64,5,'monday','18:00:00','22:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(65,5,'tuesday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(66,5,'wednesday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(67,5,'thursday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(68,5,'friday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(69,5,'saturday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(70,5,'sunday','10:00:00','15:00:00',0,'2020-04-03 15:30:26','2020-04-03 15:30:26'),(71,10,'monday','10:00:00','15:00:00',0,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(72,10,'monday','18:00:00','22:00:00',0,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(73,10,'tuesday','10:00:00','15:00:00',0,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(74,10,'tuesday','18:00:00','22:00:00',0,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(75,10,'wednesday','12:00:00','15:00:00',0,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(76,10,'wednesday','18:00:00','22:00:00',0,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(77,10,'thursday','10:00:00','15:00:00',1,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(78,10,'friday','10:00:00','15:00:00',1,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(79,10,'saturday','10:00:00','15:00:00',1,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(80,10,'sunday','10:00:00','15:00:00',1,'2020-04-06 09:11:51','2020-04-06 09:11:51'),(193,11,'monday','10:00:00','15:00:00',1,'2020-04-09 07:20:02','2020-04-09 07:20:02'),(194,11,'tuesday','10:00:00','15:00:00',1,'2020-04-09 07:20:02','2020-04-09 07:20:02'),(195,11,'wednesday','10:00:00','15:00:00',1,'2020-04-09 07:20:02','2020-04-09 07:20:02'),(196,11,'thursday','10:00:00','15:00:00',1,'2020-04-09 07:20:02','2020-04-09 07:20:02'),(197,11,'friday','10:00:00','15:00:00',1,'2020-04-09 07:20:02','2020-04-09 07:20:02'),(198,11,'saturday','10:00:00','15:00:00',1,'2020-04-09 07:20:02','2020-04-09 07:20:02'),(199,11,'sunday','10:00:00','15:00:00',1,'2020-04-09 07:20:02','2020-04-09 07:20:02'),(200,7,'monday','11:00:00','14:00:00',0,'2020-04-09 07:20:13','2020-04-09 07:20:13'),(201,7,'monday','18:00:00','22:00:00',0,'2020-04-09 07:20:13','2020-04-09 07:20:13'),(202,7,'tuesday','10:00:00','15:00:00',0,'2020-04-09 07:20:13','2020-04-09 07:20:13'),(203,7,'wednesday','10:00:00','15:00:00',0,'2020-04-09 07:20:13','2020-04-09 07:20:13'),(204,7,'thursday','10:00:00','15:00:00',0,'2020-04-09 07:20:13','2020-04-09 07:20:13'),(205,7,'friday','10:00:00','15:00:00',0,'2020-04-09 07:20:13','2020-04-09 07:20:13'),(206,7,'saturday','10:00:00','15:00:00',0,'2020-04-09 07:20:13','2020-04-09 07:20:13'),(207,7,'sunday','10:00:00','15:00:00',0,'2020-04-09 07:20:13','2020-04-09 07:20:13');
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
  PRIMARY KEY (`id`),
  KEY `order_pickups_order_id_foreign` (`order_id`),
  KEY `order_pickups_pickup_id_foreign` (`pickup_id`),
  CONSTRAINT `order_pickups_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_pickups_pickup_id_foreign` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_pickups`
--

LOCK TABLES `order_pickups` WRITE;
/*!40000 ALTER TABLE `order_pickups` DISABLE KEYS */;
INSERT INTO `order_pickups` VALUES (6,14,4,'2020-04-09',5),(7,16,4,'2020-04-09',5),(8,17,4,'2020-04-09',5),(9,18,4,'2020-04-09',5);
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
  PRIMARY KEY (`id`),
  KEY `order_products_order_id_foreign` (`order_id`),
  KEY `order_products_product_id_foreign` (`product_id`),
  CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` VALUES (17,18,42,'2020-04-09',3),(18,18,41,'2020-04-09',2);
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
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_identifier_index` (`identifier`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'280dfe2f-a46f-48f4-b5b0-b4c89f9cf0a9',59,1,'2020-04-08 13:11:21','2020-04-08 13:11:21'),(2,'5f6efe01-41dd-4f01-9439-9460b466c4e4',59,1,'2020-04-08 13:11:27','2020-04-08 13:11:27'),(3,'5ac1f263-a5a4-4554-8667-d0a4f0ac42a7',59,1,'2020-04-08 13:13:39','2020-04-08 13:13:39'),(4,'e0c5c49f-dcf9-42d1-8b9c-9d6438cf89ac',59,1,'2020-04-08 13:15:44','2020-04-08 13:15:44'),(5,'a369aa2e-6c71-4855-947e-c799b524d7b0',59,1,'2020-04-08 13:18:11','2020-04-08 13:18:11'),(6,'7ff88d25-6ada-4a2d-88cd-205b5cd63d12',59,1,'2020-04-09 09:46:07','2020-04-09 09:46:07'),(7,'bdcc967d-e623-4fe1-8dbc-dec99cc16602',59,1,'2020-04-09 09:49:31','2020-04-09 09:49:31'),(8,'2917e7d7-ca6a-4dab-897b-eb6b091915d6',42,1,'2020-04-09 09:50:37','2020-04-09 09:50:37'),(9,'5dd2799c-a3cd-4812-8add-5e10ed27cb84',42,1,'2020-04-09 09:51:47','2020-04-09 09:51:47'),(10,'945c0e60-b6f8-4f5f-a5c8-05257bd2dbe4',42,1,'2020-04-09 09:52:42','2020-04-09 09:52:42'),(11,'5a9102d3-db32-4d85-89e9-3d94cdc8b1d1',42,1,'2020-04-09 09:55:30','2020-04-09 09:55:30'),(12,'e6b68770-8a5b-4df8-a0a5-c1b00f58cbf5',42,1,'2020-04-09 09:56:19','2020-04-09 09:56:19'),(13,'858f7764-2d54-4305-b091-2b4ed661091a',42,1,'2020-04-09 10:42:56','2020-04-09 10:42:56'),(14,'bd191a34-2445-496b-a751-bdd785542804',42,1,'2020-04-09 10:44:44','2020-04-09 10:44:44'),(15,'09057766-6e27-4781-bc3b-0139a57af731',42,1,'2020-04-09 12:54:20','2020-04-09 12:54:20'),(16,'44193919-5011-4d8f-880c-c4047de5ae90',42,1,'2020-04-09 12:55:11','2020-04-09 12:55:11'),(17,'d0ee71ff-a486-4ffa-a0fa-eaee19b2ff32',42,1,'2020-04-09 13:02:52','2020-04-09 13:02:52'),(18,'6baedc9b-458a-43fb-a0d6-80d3df082048',42,1,'2020-04-09 13:06:26','2020-04-09 13:06:26');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_media`
--

LOCK TABLES `pickup_media` WRITE;
/*!40000 ALTER TABLE `pickup_media` DISABLE KEYS */;
INSERT INTO `pickup_media` VALUES (1,3,15,NULL,NULL),(2,4,16,NULL,NULL),(3,4,17,NULL,NULL),(4,4,15,NULL,NULL),(5,5,17,NULL,NULL),(6,6,15,NULL,NULL),(7,10,15,NULL,NULL),(8,11,2,NULL,NULL),(9,12,10,NULL,NULL),(12,17,11,NULL,NULL),(13,18,9,NULL,NULL),(14,19,13,NULL,NULL),(15,25,7,NULL,NULL),(16,28,7,NULL,NULL),(18,31,27,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_offers`
--

LOCK TABLES `pickup_offers` WRITE;
/*!40000 ALTER TABLE `pickup_offers` DISABLE KEYS */;
INSERT INTO `pickup_offers` VALUES (3,3,'combo',10,1,7,'2020-04-02 08:39:06','2020-04-14 11:27:36',NULL),(4,4,'single',100,1,7,'2020-04-02 08:56:17','2020-04-02 08:56:17',NULL),(5,5,'single',10,1,14,'2020-04-02 08:57:09','2020-04-02 08:57:42',NULL),(9,10,'single',10,1,7,'2020-04-02 09:43:32','2020-04-02 09:43:32',NULL),(10,11,'single',10,1,7,'2020-04-02 09:44:13','2020-04-02 09:44:13',NULL),(11,12,'single',10,1,14,'2020-04-02 09:44:47','2020-04-02 09:45:17',NULL),(16,17,'single',10,1,7,'2020-04-03 13:02:08','2020-04-03 13:02:08',NULL),(17,18,'single',10,1,7,'2020-04-03 13:02:46','2020-04-03 13:02:46',NULL),(23,25,'single',10,1,7,'2020-04-03 13:33:14','2020-04-03 13:33:14',NULL),(26,28,'single',10,1,7,'2020-04-03 14:46:31','2020-04-03 14:46:31',NULL),(27,34,'combo',10,1,7,'2020-04-14 11:16:00','2020-04-14 11:16:32',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_products`
--

LOCK TABLES `pickup_products` WRITE;
/*!40000 ALTER TABLE `pickup_products` DISABLE KEYS */;
INSERT INTO `pickup_products` VALUES (5,40,3,10,1,NULL,NULL),(6,40,4,10,1,NULL,NULL),(7,41,4,10,1,NULL,NULL),(8,42,4,10,1,NULL,NULL),(9,43,4,10,1,NULL,NULL),(10,40,5,10,1,NULL,NULL),(11,41,5,10,1,NULL,NULL),(12,42,5,10,1,NULL,NULL),(13,43,5,10,1,NULL,NULL),(14,13,5,10,1,NULL,NULL),(15,14,5,10,1,NULL,NULL),(16,15,5,10,1,NULL,NULL),(17,16,5,10,1,NULL,NULL),(18,17,5,10,1,NULL,NULL),(19,40,6,10,1,NULL,NULL),(20,13,6,10,1,NULL,NULL),(21,14,6,10,1,NULL,NULL),(22,15,6,10,1,NULL,NULL),(23,16,6,10,1,NULL,NULL),(24,17,6,10,1,NULL,NULL),(25,40,10,20,1,NULL,NULL),(26,43,10,20,1,NULL,NULL),(27,41,10,20,1,NULL,NULL),(28,42,10,20,1,NULL,NULL),(29,51,11,20,1,NULL,NULL),(30,52,11,20,1,NULL,NULL),(31,51,12,20,1,NULL,NULL),(32,52,12,20,1,NULL,NULL),(33,19,12,20,1,NULL,NULL),(34,22,12,20,1,NULL,NULL),(35,25,12,20,1,NULL,NULL),(36,28,12,20,1,NULL,NULL),(37,31,12,20,1,NULL,NULL),(52,48,17,20,1,NULL,NULL),(53,49,17,20,1,NULL,NULL),(54,50,17,20,1,NULL,NULL),(55,48,18,20,1,NULL,NULL),(56,49,18,20,1,NULL,NULL),(57,50,18,20,1,NULL,NULL),(58,20,18,20,1,NULL,NULL),(59,23,18,20,1,NULL,NULL),(60,26,18,20,1,NULL,NULL),(61,29,18,20,1,NULL,NULL),(62,32,18,20,1,NULL,NULL),(63,48,19,1,1,NULL,NULL),(64,49,19,1,1,NULL,NULL),(65,50,19,1,1,NULL,NULL),(66,56,25,1,1,NULL,NULL),(67,57,25,1,1,NULL,NULL),(68,58,25,1,1,NULL,NULL),(69,55,25,1,1,NULL,NULL),(70,59,25,1,1,NULL,NULL),(71,60,25,1,1,NULL,NULL),(72,61,25,1,1,NULL,NULL),(73,56,28,10,1,NULL,NULL),(77,62,31,10,1,NULL,NULL),(78,63,31,10,1,NULL,NULL),(79,64,31,10,1,NULL,NULL),(80,51,32,1,1,NULL,NULL),(81,52,32,1,1,NULL,NULL),(82,62,34,1,1,NULL,NULL),(83,63,34,1,1,NULL,NULL),(84,64,34,1,1,NULL,NULL),(85,43,3,1,1,NULL,NULL),(86,13,3,1,1,NULL,NULL),(87,14,3,1,1,NULL,NULL),(88,15,3,1,1,NULL,NULL),(89,16,3,1,1,NULL,NULL),(90,17,3,1,1,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_subscriptions`
--

LOCK TABLES `pickup_subscriptions` WRITE;
/*!40000 ALTER TABLE `pickup_subscriptions` DISABLE KEYS */;
INSERT INTO `pickup_subscriptions` VALUES (1,6,'single',10,1,7,10,10,'2020-04-02 08:58:09','2020-04-03 15:29:40',NULL),(2,19,'single',10,1,7,5,10,'2020-04-03 13:07:27','2020-04-06 08:50:59',NULL),(3,30,'single',10,1,7,5,1,'2020-04-06 09:54:45','2020-04-06 09:54:45',NULL),(4,31,'single',10,1,14,5,10,'2020-04-06 14:14:26','2020-04-06 14:14:59',NULL),(5,32,'single',70,1,7,5,5,'2020-04-08 11:36:13','2020-04-08 11:37:14',NULL),(6,33,'single',10,1,7,5,1,'2020-04-08 12:07:29','2020-04-08 12:07:29',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_translations`
--

LOCK TABLES `pickup_translations` WRITE;
/*!40000 ALTER TABLE `pickup_translations` DISABLE KEYS */;
INSERT INTO `pickup_translations` VALUES (8,4,'Pizza a scelta',NULL,'it','2020-04-02 08:56:52','2020-04-02 08:56:52'),(19,11,'Panino a scelta',NULL,'it','2020-04-02 09:44:31','2020-04-02 09:44:31'),(29,5,'Pizza + bibita',NULL,'it','2020-04-03 07:30:37','2020-04-03 07:30:37'),(30,10,'Pizza a scelta 2',NULL,'it','2020-04-03 07:32:02','2020-04-03 07:32:02'),(31,12,'Panino + bibita',NULL,'it','2020-04-03 07:32:37','2020-04-03 07:32:37'),(33,17,'Primo a scelta',NULL,'it','2020-04-03 13:02:31','2020-04-03 13:02:31'),(35,18,'Primo + bibita',NULL,'it','2020-04-03 13:03:17','2020-04-03 13:03:17'),(46,25,'Panino a scelta',NULL,'it','2020-04-03 13:49:37','2020-04-03 13:49:37'),(50,28,'Polpo fritto',NULL,'it','2020-04-03 14:46:51','2020-04-03 14:46:51'),(52,6,'10 x Pizza margherita + bibita',NULL,'it','2020-04-03 15:29:40','2020-04-03 15:29:40'),(53,19,'10xPrimi',NULL,'it','2020-04-06 08:50:59','2020-04-06 08:50:59'),(56,30,'5xPanino',NULL,'it','2020-04-06 09:54:45','2020-04-06 09:54:45'),(59,31,'Cotoletta+bibita a scelta',NULL,'it','2020-04-06 14:31:50','2020-04-06 14:31:50'),(61,32,'test subscription',NULL,'it','2020-04-08 11:37:14','2020-04-08 11:37:14'),(62,33,'test',NULL,'it','2020-04-08 12:07:29','2020-04-08 12:07:29'),(65,34,'test',NULL,'it','2020-04-14 11:17:28','2020-04-14 11:17:28'),(66,3,'Pizza Margherita',NULL,'it','2020-04-14 11:27:36','2020-04-14 11:27:36');
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickups`
--

LOCK TABLES `pickups` WRITE;
/*!40000 ALTER TABLE `pickups` DISABLE KEYS */;
INSERT INTO `pickups` VALUES (3,'offer',3,5,NULL,1,'2020-04-03','2020-04-23','2020-04-02 08:39:06','2020-04-03 14:46:04',NULL,'785ad074-806d-4f47-b9d4-f7824d84a4fd'),(4,'offer',3,5,NULL,1,'2020-04-02','2020-04-02','2020-04-02 08:56:17','2020-04-02 08:56:52',NULL,'64918448-ea88-4a11-b6be-56d69d4276d4'),(5,'offer',3,5,NULL,1,'2020-04-03','2020-04-03','2020-04-02 08:57:09','2020-04-03 07:30:37',NULL,'1f6c7c64-c565-4cd6-94d7-fcfb444c3912'),(6,'subscription',3,5,NULL,1,'2020-04-02','2020-04-02','2020-04-02 08:58:09','2020-04-02 08:58:45',NULL,'42077947-fa99-4389-8b96-e8253e525899'),(10,'offer',3,5,NULL,1,'2020-04-03','2020-04-03','2020-04-02 09:43:32','2020-04-03 07:32:02',NULL,'bdcd770e-f2b2-46b0-b48f-bc4f2cbf9302'),(11,'offer',7,7,NULL,1,'2020-04-02','2020-04-02','2020-04-02 09:44:13','2020-04-02 09:44:31',NULL,'a448f45d-e30b-4753-b1d4-af1c7a20e973'),(12,'offer',7,7,NULL,1,'2020-04-03','2020-04-03','2020-04-02 09:44:47','2020-04-03 07:32:37',NULL,'c8d0969c-5c0a-4bc6-bf2e-3718f0e720c7'),(17,'offer',13,8,NULL,0,'2020-04-03','2020-04-03','2020-04-03 13:02:08','2020-04-03 13:02:31',NULL,'be158e9a-2854-402a-b794-26e996f92d1f'),(18,'offer',13,8,NULL,0,'2020-04-03','2020-04-03','2020-04-03 13:02:46','2020-04-03 13:03:17',NULL,'5de82748-e5dc-42dd-a18a-3ffc75615a7b'),(19,'subscription',12,8,NULL,0,'2020-04-03','2020-04-03','2020-04-03 13:07:27','2020-04-03 13:07:54',NULL,'605af471-6f92-4342-92b7-0881cb77e07b'),(25,'offer',6,6,NULL,0,'2020-04-03','2020-04-03','2020-04-03 13:33:14','2020-04-03 13:49:37',NULL,'b74949a7-5424-4f0f-909a-2426c4eac0c0'),(28,'offer',6,6,NULL,0,'2020-04-03','2020-04-25','2020-04-03 14:46:31','2020-04-03 14:46:31',NULL,'e00423a9-34c6-453a-a05a-1e4e48902255'),(30,'subscription',6,6,NULL,0,'2020-04-06','2020-04-30','2020-04-06 09:54:45','2020-04-06 09:54:45',NULL,'f6ea9cbd-dec9-4803-b857-41a3a4e6af39'),(31,'subscription',17,10,NULL,0,'2020-04-06','2020-04-30','2020-04-06 14:14:26','2020-04-06 14:14:26',NULL,'38c8bdae-200e-45e3-8f21-09ce82fc5c22'),(32,'subscription',7,7,NULL,0,'2020-04-08','2020-04-08','2020-04-08 11:36:13','2020-04-08 11:36:13',NULL,'dfcb2953-fc63-48b2-8ce1-029d3307bbb7'),(33,'subscription',3,5,NULL,0,'2020-04-08','2020-04-08','2020-04-08 12:07:29','2020-04-08 12:07:29',NULL,'dc23b875-4eb0-4f54-93a2-fa63d53cf2dd'),(34,'offer',16,10,NULL,0,'2020-04-15','2020-04-17','2020-04-14 11:16:00','2020-04-14 11:16:00',NULL,'69d51a45-b1a2-4145-86a5-2e7d316d6d5b');
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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_translations`
--

LOCK TABLES `product_translations` WRITE;
/*!40000 ALTER TABLE `product_translations` DISABLE KEYS */;
INSERT INTO `product_translations` VALUES (24,13,'Acqua naturale','500 ml.','Acqua',NULL,NULL,NULL,'it','2020-04-02 07:42:59','2020-04-02 07:42:59'),(25,14,'Acqua frizzante','500 ml.','Acqua frizzante',NULL,NULL,NULL,'it','2020-04-02 07:43:20','2020-04-02 07:43:20'),(26,15,'Birra alla spina','400 ml.','Birra alla spina',NULL,NULL,NULL,'it','2020-04-02 07:43:40','2020-04-02 07:43:40'),(27,16,'Coca cola','330 ml.','Coca cola',NULL,NULL,NULL,'it','2020-04-02 07:43:57','2020-04-02 07:43:57'),(28,17,'Sprite','330 ml.','Sprite',NULL,NULL,NULL,'it','2020-04-02 07:44:10','2020-04-02 07:44:10'),(30,19,'Acqua naturale','500 ml.','Acqua naturale',NULL,NULL,NULL,'it','2020-04-02 07:48:20','2020-04-02 07:48:20'),(31,20,'Acqua naturale','500 ml.','Acqua naturale',NULL,NULL,NULL,'it','2020-04-02 07:48:31','2020-04-02 07:48:31'),(34,22,'Acqua frizzante','500 ml.','Acqua frizzante',NULL,NULL,NULL,'it','2020-04-02 07:49:03','2020-04-02 07:49:03'),(35,23,'Acqua frizzante','500 ml.','Acqua frizzante',NULL,NULL,NULL,'it','2020-04-02 07:49:11','2020-04-02 07:49:11'),(37,25,'Birra alla spina','400 ml.','Birra alla spina',NULL,NULL,NULL,'it','2020-04-02 07:49:43','2020-04-02 07:49:43'),(38,26,'Birra alla spina','400 ml.','Birra alla spina',NULL,NULL,NULL,'it','2020-04-02 07:49:52','2020-04-02 07:49:52'),(40,28,'Coca cola','330 ml.','Coca cola',NULL,NULL,NULL,'it','2020-04-02 07:50:15','2020-04-02 07:50:15'),(41,29,'Coca cola','330 ml.','Coca cola',NULL,NULL,NULL,'it','2020-04-02 07:50:24','2020-04-02 07:50:24'),(43,31,'Sprite','330 ml.','Sprite',NULL,NULL,NULL,'it','2020-04-02 07:52:39','2020-04-02 07:52:39'),(44,32,'Sprite','330 ml.','Sprite',NULL,NULL,NULL,'it','2020-04-02 07:52:46','2020-04-02 07:52:46'),(54,40,'Pizza Margherita','Pizza Margherita','Pomodoro, mozzarella e basilico',NULL,NULL,NULL,'it','2020-04-02 08:52:56','2020-04-02 08:52:56'),(55,41,'Pizza salsiccia e friarielli','Pizza salsiccia e friarielli','salsiccia, friarielli e provola',NULL,NULL,NULL,'it','2020-04-02 08:53:39','2020-04-02 08:53:39'),(56,42,'Pizza crudo, rucole e scaglie di grana','Pizza crudo, rucole e scaglie di grana','Crudo, rucole e scaglie di grana',NULL,NULL,NULL,'it','2020-04-02 08:54:15','2020-04-02 08:54:15'),(58,43,'Pizza marinara','Pizza marinara','Pomodoro, origano, aglio',NULL,NULL,NULL,'it','2020-04-02 08:55:12','2020-04-02 08:55:12'),(64,48,'Rigatoni al pesto di rucola e noci','Rigatoni al pesto di rucola e noci','Pesto di rucola e noci',NULL,NULL,NULL,'it','2020-04-02 09:32:46','2020-04-02 09:32:46'),(65,49,'Paccheri crema di zucchine e burrata','Paccheri crema di zucchine e burrata','Crema di zucchine e burrata',NULL,NULL,NULL,'it','2020-04-02 09:33:29','2020-04-02 09:33:29'),(66,50,'Tagliatelle al ragù bolognese','Tagliatelle al ragù bolognese','Ragù bolognese',NULL,NULL,NULL,'it','2020-04-02 09:34:10','2020-04-02 09:34:10'),(67,51,'Hamburger bufala','100% manzo italiano, mozzarella di bufala campana doc, pomodoro di Sorrento','100% manzo italiano, mozzarella di bufala campana doc, pomodoro di Sorrento',NULL,NULL,NULL,'it','2020-04-02 09:36:31','2020-04-02 09:36:31'),(68,52,'Hamburger parmigiana','100% manzo italiano, parmigiana di melanzane scomposta, salsa di basilico','100% manzo italiano, parmigiana di melanzane scomposta, salsa di basilico',NULL,NULL,NULL,'it','2020-04-02 09:38:52','2020-04-02 09:38:52'),(72,55,'Acqua naturale','500 ml.','Acqua',NULL,NULL,NULL,'it','2020-04-03 13:36:50','2020-04-03 13:36:50'),(73,56,'Polpo fritto','300g di polpo fritto, rape aglio e olio, mosto cotto di fichi, ricotta e pepe, olio alle alici','300g di polpo fritto, rape aglio e olio, mosto cotto di fichi, ricotta e pepe, olio alle alici',NULL,NULL,NULL,'it','2020-04-03 13:38:13','2020-04-03 13:38:13'),(74,57,'Gamberoni al ghiaccio','170g di gamberoni leggermente bolliti, melanzana infornata, fiordilatte, pancetta Santoro, chips di patate, ketchup fatto in casa, maionese affumicata e rucola fresca','170g di gamberoni leggermente bolliti, melanzana infornata, fiordilatte, pancetta Santoro, chips di patate, ketchup fatto in casa, maionese affumicata e rucola fresca',NULL,NULL,NULL,'it','2020-04-03 13:45:28','2020-04-03 13:45:28'),(75,58,'Tartare di tonno','100g di tartare di tonno, burrata, pomodoro fresco, olio al cappero e pesto al basilico','100g di tartare di tonno, burrata, pomodoro fresco, olio al cappero e pesto al basilico',NULL,NULL,NULL,'it','2020-04-03 13:46:00','2020-04-03 13:46:00'),(76,59,'Acqua frizzante','500 ml.','Acqua frizzante',NULL,NULL,NULL,'it','2020-04-03 13:46:23','2020-04-03 13:46:23'),(77,60,'Coca cola','330 ml.','Coca cola',NULL,NULL,NULL,'it','2020-04-03 13:46:41','2020-04-03 13:46:41'),(78,61,'Vino bianco della casa','400 ml.','Vino bianco della casa',NULL,NULL,NULL,'it','2020-04-03 13:47:02','2020-04-03 13:47:02'),(79,62,'Cotoletta alla milanese','Cotoletta alla milanese con patate al forno','Cotoletta alla milanese con patate al forno',NULL,NULL,NULL,'it','2020-04-06 09:13:20','2020-04-06 09:13:20'),(80,63,'Acqua frizzante','500 ml.','Acqua frizzante',NULL,NULL,NULL,'it','2020-04-06 09:13:53','2020-04-06 09:13:53'),(81,64,'Vino rosso','500 ml.','Vino rosso della casa',NULL,NULL,NULL,'it','2020-04-06 09:14:22','2020-04-06 09:14:22');
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
  CONSTRAINT `products_menu_section_id_foreign` FOREIGN KEY (`menu_section_id`) REFERENCES `menu_sections` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (13,'4708864d-8d61-4045-9537-4bff472720af',2.50,5,14,0,'Drink',100,'2020-04-02 07:42:59','2020-04-02 08:15:01',NULL),(14,'22e10126-ce2d-4871-85b5-b52ba91927af',2.50,5,14,0,'Drink',100,'2020-04-02 07:43:20','2020-04-02 08:15:01',NULL),(15,'4b9f8f8c-a267-4801-8bd7-dbbfe213b7a1',4.50,5,14,0,'Drink',100,'2020-04-02 07:43:40','2020-04-02 08:15:01',NULL),(16,'fba3c1bf-3640-4ded-a1e9-bd23283c7f02',3.50,5,14,0,'Drink',100,'2020-04-02 07:43:57','2020-04-02 08:15:01',NULL),(17,'a2dbffd4-aa24-451a-bf7a-8e30380b7a3f',3.50,5,14,0,'Drink',100,'2020-04-02 07:44:10','2020-04-02 08:15:01',NULL),(19,'4708864d-8d61-4045-9537-4bff472720af',2.50,7,16,0,'Drink',100,'2020-04-02 07:42:59','2020-04-02 08:15:59',NULL),(20,'4708864d-8d61-4045-9537-4bff472720af',2.50,8,12,0,'Drink',100,'2020-04-02 07:42:59','2020-04-02 08:14:17',NULL),(22,'22e10126-ce2d-4871-85b5-b52ba91927af',2.50,7,16,0,'Drink',100,'2020-04-02 07:43:20','2020-04-02 08:15:59',NULL),(23,'22e10126-ce2d-4871-85b5-b52ba91927af',2.50,8,12,0,'Drink',100,'2020-04-02 07:43:20','2020-04-02 08:14:17',NULL),(25,'4b9f8f8c-a267-4801-8bd7-dbbfe213b7a1',4.50,7,16,0,'Drink',100,'2020-04-02 07:43:40','2020-04-02 08:15:59',NULL),(26,'4b9f8f8c-a267-4801-8bd7-dbbfe213b7a1',4.50,8,12,0,'Drink',100,'2020-04-02 07:43:40','2020-04-02 08:14:17',NULL),(28,'fba3c1bf-3640-4ded-a1e9-bd23283c7f02',3.50,7,16,0,'Drink',100,'2020-04-02 07:43:57','2020-04-02 08:15:59',NULL),(29,'fba3c1bf-3640-4ded-a1e9-bd23283c7f02',3.50,8,12,0,'Drink',100,'2020-04-02 07:43:57','2020-04-02 08:14:17',NULL),(31,'a2dbffd4-aa24-451a-bf7a-8e30380b7a3f',3.50,7,16,0,'Drink',100,'2020-04-02 07:44:10','2020-04-02 08:15:59',NULL),(32,'a2dbffd4-aa24-451a-bf7a-8e30380b7a3f',3.50,8,12,0,'Drink',100,'2020-04-02 07:44:10','2020-04-02 08:14:17',NULL),(40,'ba820c59-7316-431d-96b7-e09fec8db0d3',7.50,5,17,0,'Dish',0,'2020-04-02 08:42:20','2020-04-02 09:29:27',NULL),(41,'20eb0218-5a97-47cf-a1e0-e0e7828b85d7',9.50,5,17,0,'Dish',2,'2020-04-02 08:53:39','2020-04-02 09:29:27',NULL),(42,'72366a6d-01de-4038-a920-222ea73f622b',10.00,5,17,0,'Dish',3,'2020-04-02 08:54:15','2020-04-02 09:29:27',NULL),(43,'3c9f798d-0ca1-4033-b152-339aafd44513',7.50,5,26,0,'Dish',1,'2020-04-02 08:55:02','2020-04-14 11:27:07',NULL),(48,'04466fa7-97e8-4df6-ac03-8cab79df2916',7.50,8,19,0,'Dish',100,'2020-04-02 09:32:46','2020-04-02 09:32:46',NULL),(49,'b49c3a45-54bf-4aca-89ec-e773519ce5b0',8.00,8,19,0,'Dish',100,'2020-04-02 09:33:29','2020-04-02 09:33:29',NULL),(50,'daf6198c-876d-48d6-a636-0f51ee96d056',8.50,8,19,0,'Dish',100,'2020-04-02 09:34:10','2020-04-02 09:34:10',NULL),(51,'a180a73c-4492-4243-99c9-40dc1895cc2c',10.50,7,20,0,'Dish',100,'2020-04-02 09:36:31','2020-04-02 09:36:31',NULL),(52,'3ae38098-ad96-4037-813c-605871e7cb13',12.00,7,20,0,'Dish',100,'2020-04-02 09:38:52','2020-04-02 09:38:52',NULL),(55,'4911f899-0b38-4e18-8f66-5917f0c69804',2.50,6,22,0,'Drink',100,'2020-04-03 13:36:50','2020-04-03 13:36:59',NULL),(56,'035a35e7-0e1d-46c9-966a-fdfc9f279304',8.00,6,23,0,'Dish',100,'2020-04-03 13:38:13','2020-04-03 13:38:21',NULL),(57,'44d78725-fb12-4a33-977c-26cc79ff2827',8.00,6,23,0,'Dish',100,'2020-04-03 13:45:28','2020-04-03 13:47:15',NULL),(58,'737df3ab-a633-4832-a765-479681e79aa0',8.00,6,23,0,'Dish',100,'2020-04-03 13:46:00','2020-04-03 13:47:15',NULL),(59,'ee7caab1-c229-4cf4-95ae-e27a7946d10a',2.50,6,22,0,'Drink',100,'2020-04-03 13:46:23','2020-04-03 13:47:20',NULL),(60,'1c8c8362-b0bf-4b51-bce3-889e25491c66',3.50,6,22,0,'Drink',100,'2020-04-03 13:46:41','2020-04-03 13:47:20',NULL),(61,'8986c837-a679-48e8-b295-82eb091b833f',4.50,6,22,0,'Drink',100,'2020-04-03 13:47:02','2020-04-03 13:47:20',NULL),(62,'196f591f-bbe0-4bbb-bc19-436b4c653041',17.00,10,24,0,'Dish',100,'2020-04-06 09:13:20','2020-04-06 09:14:53',NULL),(63,'ed086dfe-d16f-4d76-b371-2199666f2794',2.50,10,25,0,'Drink',100,'2020-04-06 09:13:53','2020-04-06 09:15:03',NULL),(64,'8aefff0e-d6ad-46b7-b02d-afb8108300bc',8.00,10,25,0,'Drink',100,'2020-04-06 09:14:22','2020-04-06 09:15:03',NULL);
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
INSERT INTO `products_categories` VALUES (9,1,40,NULL,NULL),(10,15,40,NULL,NULL),(11,16,40,NULL,NULL),(12,1,41,NULL,NULL),(13,15,41,NULL,NULL),(14,1,42,NULL,NULL),(15,15,42,NULL,NULL),(16,1,43,NULL,NULL),(17,15,43,NULL,NULL),(18,5,43,NULL,NULL),(28,3,48,NULL,NULL),(29,15,48,NULL,NULL),(30,3,49,NULL,NULL),(31,15,49,NULL,NULL),(32,7,49,NULL,NULL),(33,9,49,NULL,NULL),(34,10,49,NULL,NULL),(35,16,49,NULL,NULL),(36,3,50,NULL,NULL),(37,15,50,NULL,NULL),(38,2,51,NULL,NULL),(39,15,51,NULL,NULL),(40,8,51,NULL,NULL),(41,10,51,NULL,NULL),(42,2,52,NULL,NULL),(43,15,52,NULL,NULL),(48,15,56,NULL,NULL),(49,17,56,NULL,NULL),(50,15,57,NULL,NULL),(51,17,57,NULL,NULL),(52,7,57,NULL,NULL),(53,15,58,NULL,NULL),(54,17,58,NULL,NULL),(55,15,62,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_media`
--

LOCK TABLES `products_media` WRITE;
/*!40000 ALTER TABLE `products_media` DISABLE KEYS */;
INSERT INTO `products_media` VALUES (12,40,15,1,NULL,NULL),(13,41,17,1,NULL,NULL),(14,42,14,1,NULL,NULL),(15,43,16,1,NULL,NULL),(20,48,11,1,NULL,NULL),(21,49,9,1,NULL,NULL),(22,50,13,1,NULL,NULL),(23,51,10,1,NULL,NULL),(24,52,23,1,NULL,NULL),(27,56,7,1,NULL,NULL),(28,57,5,1,NULL,NULL),(29,58,1,1,NULL,NULL),(30,62,27,1,NULL,NULL);
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
INSERT INTO `restaurant_media` VALUES (1,5,12,NULL,NULL),(2,6,4,NULL,NULL),(3,7,3,NULL,NULL),(4,8,6,NULL,NULL),(6,10,26,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurants`
--

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
INSERT INTO `restaurants` VALUES (5,'7f1bf71d-210d-4c9b-86fb-a204aad5a466',5,'Pizzeria Gino Sorbillo','acct_1FhcU9LM89FngJk6','Via Savona, 24, Milano - 20144',45.455045,9.166798,0,'2020-04-02 07:19:54','2020-04-02 07:19:54',NULL,0.000000,0.000000,NULL,NULL,NULL,NULL,NULL,'',''),(6,'a1576c3e-3d89-40fa-b3a2-c4bf990587b7',7,'Pescaria - Solari',NULL,'Milano, Via Andrea Solari, Milano - 20144',45.455206,9.162457,0,'2020-04-02 07:20:29','2020-04-02 07:20:29',NULL,0.000000,0.000000,NULL,NULL,NULL,NULL,NULL,'',''),(7,'8cd827d8-c035-45c1-b9a3-794c4e49add1',4,'Baobab - Burger organico','acct_1FhcU9LM89FngJk6','Milano, Corso Garibaldi, Milano - 20121',45.476645,9.184162,0,'2020-04-02 07:21:15','2020-04-09 07:20:13',NULL,9.657369,45.685206,'Bergamo, Via Giovanni Battista Moroni, Bergamo - IT','000000000999','IT28V0303201605099999999','25','luca.raccampo+pec@gmail.com','12345',''),(8,'52a48339-1054-440e-983b-a705c363c426',6,'Miscusi - Colonne',NULL,'Milano, Via Urbano III, Milano - 20123',45.459107,9.181144,0,'2020-04-02 07:21:53','2020-04-02 07:21:53',NULL,0.000000,0.000000,NULL,NULL,NULL,NULL,NULL,'',''),(10,'5557ca98-684d-4b97-948e-5a96b247ae53',8,'Amici Miei',NULL,'Milano, Viale Bligny, Milano - IT',45.450952,9.191115,0,'2020-04-06 09:11:51','2020-04-06 09:11:51',NULL,0.000000,0.000000,NULL,NULL,NULL,NULL,NULL,'',''),(11,'ed5a2a21-003f-4ece-ab75-9dd359d680e3',4,'Prova ristorante stripe','acct_1FhcU9LM89FngJk6','Trezzano sul Naviglio, IT, Trezzano sul Naviglio - 20090',45.430057,9.058258,0,'2020-04-08 13:39:39','2020-04-09 07:19:53',NULL,9.058258,45.430057,'Trezzano sul Naviglio, IT, Trezzano sul Naviglio - 20090','000000000999','IT28V0303201605099999998','25','luca.raccampo+pec@gmail.com','12345','');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `showcase_timeslots`
--

LOCK TABLES `showcase_timeslots` WRITE;
/*!40000 ALTER TABLE `showcase_timeslots` DISABLE KEYS */;
INSERT INTO `showcase_timeslots` VALUES (1,1,3),(2,2,4),(5,1,7),(6,2,8),(9,1,12),(10,2,13),(11,1,5),(12,2,6),(13,1,16),(14,2,17),(15,1,18),(16,2,19);
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeslots`
--

LOCK TABLES `timeslots` WRITE;
/*!40000 ALTER TABLE `timeslots` DISABLE KEYS */;
INSERT INTO `timeslots` VALUES (3,'bbe4e639-74bc-11ea-be39-121d6fa1bf65',5,1,'12:00:00','15:00:00',1,NULL,NULL,NULL),(4,'ec012a4c-74bc-11ea-be39-121d6fa1bf65',5,2,'18:00:00','22:00:00',1,NULL,NULL,NULL),(5,'e31f4da9-74bc-11ea-be39-121d6fa1bf65',6,1,'12:00:00','15:00:00',1,NULL,NULL,NULL),(6,'f5bc045d-74bc-11ea-be39-121d6fa1bf65',6,2,'18:00:00','22:00:00',1,NULL,NULL,NULL),(7,'fbf296ff-74bc-11ea-be39-121d6fa1bf65',7,1,'12:00:00','15:00:00',1,NULL,NULL,NULL),(8,'022d9234-74bd-11ea-be39-121d6fa1bf65',7,2,'18:00:00','22:00:00',1,NULL,NULL,NULL),(12,'30f47e6c-74c9-11ea-be39-121d6fa1bf65',8,1,'12:00:00','15:00:00',1,NULL,NULL,NULL),(13,'3e5ac4bd-74c9-11ea-be39-121d6fa1bf65',8,2,'18:00:00','22:00:00',1,NULL,NULL,NULL),(16,'2f572d4e-89fc-460d-84d0-4096bc457dcc',10,1,'11:00:00','15:00:00',1,'2020-04-06 09:11:51','2020-04-06 09:11:51',NULL),(17,'098a4058-7335-494a-97ca-d2839c57f8b1',10,2,'19:00:00','23:00:00',1,'2020-04-06 09:11:51','2020-04-06 09:11:51',NULL),(18,'5057315a-1aec-439c-b504-9c22311a6491',11,1,'11:00:00','15:00:00',1,'2020-04-08 13:39:40','2020-04-08 13:39:40',NULL),(19,'6b449a8a-a0dd-4973-9288-2b54f67f4c62',11,2,'19:00:00','23:00:00',1,'2020-04-08 13:39:40','2020-04-08 13:39:40',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_brands`
--

LOCK TABLES `user_brands` WRITE;
/*!40000 ALTER TABLE `user_brands` DISABLE KEYS */;
INSERT INTO `user_brands` VALUES (9,77,5,NULL,NULL),(10,78,5,NULL,NULL),(12,82,5,NULL,NULL),(13,84,4,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_restaurants`
--

LOCK TABLES `user_restaurants` WRITE;
/*!40000 ALTER TABLE `user_restaurants` DISABLE KEYS */;
INSERT INTO `user_restaurants` VALUES (1,77,5,NULL,NULL),(2,78,5,NULL,NULL),(3,82,5,NULL,NULL),(4,84,7,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'1c886961-2766-4f5a-97e3-6e1ba7ecdf1b','','','','','igor.squadra@21ilab.com','$2y$10$0D3Ttu3woH5trNl2vqWRqei7Jks7U6zxGgPRziLMh8o4Wd2Q50xxq',NULL,NULL,'{\"sub\":\"1c886961-2766-4f5a-97e3-6e1ba7ecdf1b\",\"name\":\"Igor\",\"email\":\"igor.squadra@21ilab.com\",\"role\":\"ADMIN\"}','ADMIN','2020-04-02 07:11:03','2020-04-07 08:33:51',NULL,''),(2,'00dd59ce-4fd4-41ff-8aeb-d1cb7a6821dd','','','','','igor.squad+test3@gmail.com','$2y$10$ACrZ.mq/deAEaIf/cMOVKOlisaxoUQw.eNJV6vVL1DMnOgsmdFqJu',NULL,NULL,'{\"sub\":\"00dd59ce-4fd4-41ff-8aeb-d1cb7a6821dd\",\"name\":null,\"email\":\"igor.squad+test3@gmail.com\",\"role\":null}','CUSTOMER','2020-03-13 07:44:33','2020-03-13 06:44:33',NULL,''),(3,'07b8bdd9-3f61-42e3-81b7-89358eb79ace','','','','','igor.squad+25@gmail.com','$2y$10$PUiKb8FHmcC5osQgWd0yk.LuwHAXrcQXDPr.xxH1WGZzXVQlBMqOG',NULL,NULL,'{\"sub\":\"07b8bdd9-3f61-42e3-81b7-89358eb79ace\",\"name\":null,\"email\":\"igor.squad+25@gmail.com\",\"role\":null}','CUSTOMER','2020-03-31 09:25:53','2020-03-31 07:25:53',NULL,''),(4,'1289d0b6-0829-4729-85cb-148e9f6ff3d3','','','','','roberto.mezza@gmail.com','$2y$10$FvBlr2vtueDWSRmtEhKT4euXABsy4CtOvIPe6uCdfX2RiAYbO2aBG',NULL,NULL,'{\"sub\":\"1289d0b6-0829-4729-85cb-148e9f6ff3d3\",\"name\":\"Roberto Mezzalira\",\"email\":\"roberto.mezza@gmail.com\",\"role\":null}','CUSTOMER','2020-01-30 12:24:15','2020-04-13 07:45:32',NULL,''),(5,'14393b76-32ab-4e3a-b0e1-56654e3910b2','','','','','Roberto.mezza+666@gmail.com','$2y$10$Riob05/CBFGJSY58IQ4QGOR.hO.LKDPJP6jJ5vaCRFbF6vkOIo5Dq',NULL,NULL,'{\"sub\":\"14393b76-32ab-4e3a-b0e1-56654e3910b2\",\"name\":\"Rob\",\"email\":\"Roberto.mezza+666@gmail.com\",\"role\":null}','CUSTOMER','2020-02-19 13:16:06','2020-03-09 17:17:54',NULL,''),(6,'1f21e29f-fca5-4891-a33c-c128abbadd28','','','','','marco+15@pickmealup.com','$2y$10$nbl23j0GnGJ1T9KGMMc8z.lu9FCs3XdkvxNsLLeI35YnpEHI8O.HG',NULL,NULL,'{\"sub\":\"1f21e29f-fca5-4891-a33c-c128abbadd28\",\"name\":null,\"email\":\"marco+15@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-31 09:23:31','2020-03-31 07:23:31',NULL,''),(7,'1f4daaf2-b713-44f9-9b70-d9db40d293f4','','','','','marco@pickmealup.com','$2y$10$XZkYy7UeLmNttRbuxk2ame6dejIZI1aHKqzkI/d9TxwLSTCJh5Ib6',NULL,NULL,'{\"sub\":\"1f4daaf2-b713-44f9-9b70-d9db40d293f4\",\"name\":\"Marco Vitolo\",\"email\":\"marco@pickmealup.com\",\"role\":\"PMU\"}','PMU','2019-12-01 15:21:21','2020-04-02 12:16:12',NULL,''),(8,'31d15c78-48cc-450b-9d3d-7289a6639b7d','','','','','carlo+1@pickmealup.com','$2y$10$7X7BSb6dtNeNwVjKo2OnquWTbgrjkWon8w62mBmlj0yp/.l.WcPcy',NULL,NULL,'{\"sub\":\"31d15c78-48cc-450b-9d3d-7289a6639b7d\",\"name\":\"carlo\",\"email\":\"carlo+1@pickmealup.com\",\"role\":null}','CUSTOMER','2020-02-19 09:11:11','2020-02-19 08:11:11',NULL,''),(9,'35619b95-5091-4b83-a553-34c5c32d48d5','','','','','davi.leichsenring@21ilab.com','$2y$10$dW5gfsmA5Sk68gRqn7OYm.yN6IhMYJF1zxh3.zA8Ao78xPm312PsO',NULL,NULL,'{\"sub\":\"35619b95-5091-4b83-a553-34c5c32d48d5\",\"name\":\"Davi Admin\",\"email\":\"davi.leichsenring@21ilab.com\",\"role\":\"ADMIN\"}','ADMIN','2020-01-15 17:26:43','2020-02-14 09:48:11',NULL,''),(10,'3c300cf1-fdcf-4242-9eb8-9a35c30722d1','','','','','marco+9@pickmealup.com','$2y$10$cN39j.QsBKX8b3e5py7NjOmPnJTKiNQWRTK.Q3yIyk0EMEAqGuOXu',NULL,NULL,'{\"sub\":\"3c300cf1-fdcf-4242-9eb8-9a35c30722d1\",\"name\":null,\"email\":\"marco+9@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-31 08:25:36','2020-03-31 06:25:36',NULL,''),(11,'44eea5a6-68ab-4413-9552-d827bf32e214','','','','','test@test.com','$2y$10$GRzX6eo1xrYa.l5xXl3XBuTRq01XY2Lw46HnrHgFs3eIfJBh8RkI.',NULL,NULL,'{\"sub\":\"44eea5a6-68ab-4413-9552-d827bf32e214\",\"name\":null,\"email\":\"test@test.com\",\"role\":null}','CUSTOMER','2020-02-13 10:09:01','2020-02-13 09:09:01',NULL,''),(12,'4ba2b09c-4c3f-4e83-9479-3c55f25808ba','','','','','carlo@pickmealup.com','$2y$10$9rbtY5JY9Sr0kRjByeYwf.b4nNQSzAlwC3QA82WEAEqY07F86sb7q',NULL,NULL,'{\"sub\":\"4ba2b09c-4c3f-4e83-9479-3c55f25808ba\",\"name\":\"Carlo\",\"email\":\"carlo@pickmealup.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-02 14:04:30','2020-03-02 13:05:52',NULL,''),(13,'4d18cf1c-781a-4303-87fe-2e552c46f032','','','','','roberto.mezza+6666@gmail.com','$2y$10$09uZqAZ/hjKf7DwiVSOUnO4FiU6KnntbHyREQAfpG7lMFCXMeXmtC',NULL,NULL,'{\"sub\":\"4d18cf1c-781a-4303-87fe-2e552c46f032\",\"name\":null,\"email\":\"roberto.mezza+6666@gmail.com\",\"role\":null}','CUSTOMER','2020-03-24 15:16:17','2020-04-13 07:43:19',NULL,''),(14,'4ed9c725-59ee-460d-88d2-a67ab78f2d92','','','','','andrea.forzani@valuepartners.com','$2y$10$aZGWTYsjLkYw2mprX8/7POIeKZfxLw1rnLOfGs8SFmIcrqwebA8oa',NULL,NULL,'{\"sub\":\"4ed9c725-59ee-460d-88d2-a67ab78f2d92\",\"name\":\"Andrea Forzani\",\"email\":\"andrea.forzani@valuepartners.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-25 08:41:37','2020-03-25 15:34:47',NULL,''),(15,'5d6a5a93-89b7-4b6e-9187-9ac8471d3bfe','','','','','marco.vitolo@gmail.com','$2y$10$sHhxqmm3acT36FEB414pjenyzTSE9I61COJe.AzDYfejkVu8.BYqy',NULL,NULL,'{\"sub\":\"5d6a5a93-89b7-4b6e-9187-9ac8471d3bfe\",\"name\":null,\"email\":\"marco.vitolo@gmail.com\",\"role\":null}','CUSTOMER','2020-03-30 09:26:22','2020-04-02 12:23:14',NULL,''),(16,'62083244-84dd-4247-b5e6-76297129af03','','','','','mirko.pilato@valuepartners.com','$2y$10$hrvtOelLJrmKXGigH9ypwOqrPrrRsh92/ZPcD/qaGFinPnKncvOHq',NULL,'psB0Vl9ildO6KhzVceSPizDFdjx5CHfL44ihpm4FIZwgQKmt3oQddobpBFFD','{\"sub\":\"62083244-84dd-4247-b5e6-76297129af03\",\"name\":\"Mirko Pilato\",\"email\":\"mirko.pilato@valuepartners.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-25 08:42:08','2020-04-14 11:11:47',NULL,''),(17,'669e500b-b2ab-42a3-bada-bff782e5f3c5','','','','','Aa@aa.ii','$2y$10$xOs6ElHj8DMcc26HZQm5K.Z2eMMTdIQqRfdoO3ntCUp5PjNE.w5m6',NULL,NULL,'{\"sub\":\"669e500b-b2ab-42a3-bada-bff782e5f3c5\",\"name\":\"Io\",\"email\":\"Aa@aa.ii\",\"role\":null}','CUSTOMER','2020-03-24 15:13:29','2020-03-24 14:13:29',NULL,''),(18,'68c3ed5a-14b9-4e0d-8380-8b136b56b074','','','','','carlo+4@pickmealup.com','$2y$10$4K3UyBwQ.7wr3OY3Cwog2uMxP0sVgMFZ8uaTY9D.DjKvaDMcOXtEq',NULL,NULL,'{\"sub\":\"68c3ed5a-14b9-4e0d-8380-8b136b56b074\",\"name\":\"carlo+4@pickmealup.com\",\"email\":\"carlo+4@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-26 16:51:07','2020-03-26 15:55:21',NULL,''),(19,'6cc5b0d8-1bbf-4a4c-a00b-4b73f7ad4340','','','','','marco+10@pickmealup.com','$2y$10$KTLuM/f4CQZQmhxKN5HX2eLKvTIAu2oqAbwkb8GMahukNlWKVdV4q',NULL,NULL,'{\"sub\":\"6cc5b0d8-1bbf-4a4c-a00b-4b73f7ad4340\",\"name\":null,\"email\":\"marco+10@pickmealup.com\",\"role\":null}','CUSTOMER','2020-02-21 14:25:04','2020-02-21 13:25:04',NULL,''),(20,'78aede67-c0c4-4927-8e7c-b8bdde8375ff','','','','','dev-ext@21ilab.com','$2y$10$RDwEH4MX0I/V68cxdCHBSOs8qR2zFi7Q5lgEzlFCoyR8craxamh.e',NULL,NULL,'{\"sub\":\"78aede67-c0c4-4927-8e7c-b8bdde8375ff\",\"name\":\"DEV User\",\"email\":\"dev-ext@21ilab.com\",\"role\":\"ADMIN\"}','ADMIN','2020-01-28 14:22:17','2020-01-28 13:22:48',NULL,''),(21,'805f1a7d-e6d4-4a92-8ab6-819913839970','','','','','igor.squadra+1@21ilab.com','$2y$10$yd0Iz3c2VwnCiIpAp6uXFOoUEmqSa2eHn6L12kti7Nx4XmDHjQ.em',NULL,NULL,'{\"sub\":\"805f1a7d-e6d4-4a92-8ab6-819913839970\",\"name\":\"Igor Squadra Owner\",\"email\":\"igor.squadra+1@21ilab.com\",\"role\":\"OWNER\"}','OWNER','2020-02-13 09:40:35','2020-02-19 08:27:45',NULL,''),(22,'82b574bc-3586-4837-bb85-48e72a5f3bc2','','','','','carlo+3@pickmealup.com','$2y$10$o3x4b8bxFA7snG//DibLqemLqgN.z05lD5JFbCf210SjILXffmY3W',NULL,NULL,'{\"sub\":\"82b574bc-3586-4837-bb85-48e72a5f3bc2\",\"name\":\"carlo+3@pickmealup.com\",\"email\":\"carlo+3@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-26 14:47:48','2020-03-26 13:47:48',NULL,''),(23,'85a4ae01-24e5-4651-baab-ba550185b3bf','','','','','carletto.led@gmail.com','$2y$10$XYwB1dqoHKvnLtkOP9QyXudggEFoFpR5IWTZOFIqP7rDB.oqk2NI.',NULL,NULL,'{\"sub\":\"85a4ae01-24e5-4651-baab-ba550185b3bf\",\"name\":\"carlo\",\"email\":\"carletto.led@gmail.com\",\"role\":null}','CUSTOMER','2020-02-13 08:50:18','2020-02-13 07:50:18',NULL,''),(25,'86c0bc31-2fc7-4b95-a835-c8c630efc29d','','','','','marco.vitolo+7@gmail.com','$2y$10$jlUyWVn4mOoWonqoOzazFOmMsYltOKBwrkHlr9RwbVrhovUNIdG5K',NULL,NULL,'{\"sub\":\"86c0bc31-2fc7-4b95-a835-c8c630efc29d\",\"name\":null,\"email\":\"marco.vitolo+7@gmail.com\",\"role\":null}','CUSTOMER','2020-03-31 08:22:15','2020-03-31 06:22:15',NULL,''),(26,'8ab3f256-f566-46e2-8b9d-52e2f595221c','','','','','test1@test1.com','$2y$10$KfVYWUJtpCmW9tTQEhyq4u5RLmYtJYCwRHNrTI0ny4TJqNGyN3zYK',NULL,NULL,'{\"sub\":\"8ab3f256-f566-46e2-8b9d-52e2f595221c\",\"name\":null,\"email\":\"test1@test1.com\",\"role\":null}','CUSTOMER','2020-03-13 07:36:14','2020-03-13 06:36:14',NULL,''),(27,'8b5829da-5aa2-4fdb-aea9-2e0721123bd2','','','','','marco.vitolo+3@gmail.com','$2y$10$Lk/tPJopRFoKHKCP4Imnd.DSiP.92YNWoycyUApJpNBpKrOp/cTli',NULL,NULL,'{\"sub\":\"8b5829da-5aa2-4fdb-aea9-2e0721123bd2\",\"name\":null,\"email\":\"marco.vitolo+3@gmail.com\",\"role\":null}','CUSTOMER','2020-02-14 13:56:19','2020-02-14 12:56:19',NULL,''),(28,'8ee7c7f0-0e39-4b9b-84f7-24f2c575feb4','','','','','enrico.tenca@21ilab.com','$2y$10$6lhb3vmkCtbCa8kucHxMA.gdX.LrGWpWNmHFirptN3NpXQGEVAdfW',NULL,NULL,'{\"sub\":\"8ee7c7f0-0e39-4b9b-84f7-24f2c575feb4\",\"name\":null,\"email\":\"enrico.tenca@21ilab.com\",\"role\":null}','CUSTOMER','2020-03-31 09:32:04','2020-03-31 07:32:04',NULL,''),(29,'92bbb75e-0146-4f0a-be72-ad3c27d021fd','','','','','marco+5@pickmealup.com','$2y$10$6Lbzi3Jo5Ko5uE3l1RZyE.jB4q7t7BJCd7wHOISe1aTpdftpjFseO',NULL,NULL,'{\"sub\":\"92bbb75e-0146-4f0a-be72-ad3c27d021fd\",\"name\":null,\"email\":\"marco+5@pickmealup.com\",\"role\":null}','CUSTOMER','2020-02-21 14:20:39','2020-02-21 13:20:39',NULL,''),(30,'9f152a45-f40b-4b37-a318-db6200a5caa1','','','','','marco.vitolo+11@gmail.com','$2y$10$Y9QwIp/bNT7y3x3tT7.eOe/hsWuOF9x61lemBNlP8mDfOExavPCQa',NULL,NULL,'{\"sub\":\"9f152a45-f40b-4b37-a318-db6200a5caa1\",\"name\":\"Marco Vitolo\",\"email\":\"marco.vitolo+11@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-01-23 14:14:32','2020-04-07 06:51:25',NULL,''),(31,'9f7e2b4e-e7e9-4b96-9832-26a97e33f1dc','','','','','marco+12@pickmealup.com','$2y$10$9HxQWdSnLic/ST42WVtI/uWa9A.SMKBMN6OKYdHYhbuC4i0wTA.hG',NULL,NULL,'{\"sub\":\"9f7e2b4e-e7e9-4b96-9832-26a97e33f1dc\",\"name\":null,\"email\":\"marco+12@pickmealup.com\",\"role\":null}','CUSTOMER','2020-02-21 14:46:14','2020-02-21 13:46:14',NULL,''),(32,'a800716e-8500-4f5d-b259-d618a87edc9d','','','','','mirco.santori@gmail.com','$2y$10$jvK17dG0QlcoYHvPlcf2ruOkIBzFAZkXTeOlM8uumag7RYC2g54lC',NULL,NULL,'{\"sub\":\"a800716e-8500-4f5d-b259-d618a87edc9d\",\"name\":\"Mirco\",\"email\":\"mirco.santori@gmail.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-02 13:21:34','2020-03-02 12:21:34',NULL,''),(33,'a935218f-4667-46af-8bf5-a27b6ed65a6c','','','','','marco.vitolo+2@gmail.com','$2y$10$zgN5GlVon.8igWFeqZPtPujj1zvYS/piu.m7DFZ6eL3qSilRCVBkS',NULL,NULL,'{\"sub\":\"a935218f-4667-46af-8bf5-a27b6ed65a6c\",\"name\":\"Marco Vitolo\",\"email\":\"marco.vitolo+2@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-01-30 13:36:10','2020-01-30 12:38:41',NULL,''),(34,'c84da035-8892-49ff-91c6-396ab859d627','','','Uomo','Sun Apr 03 07:49:54 +0000 1988','igor.squad+test36@gmail.com','$2y$10$NBRnkmdxy0fkBa9EDLrj5.ku535UdJ1bR2jUNiD4cV7KY032mWfru',NULL,NULL,'{\"sub\":\"c84da035-8892-49ff-91c6-396ab859d627\",\"name\":null,\"email\":\"igor.squad+test36@gmail.com\",\"role\":null}','CUSTOMER','2020-03-19 10:35:50','2020-04-09 12:38:51',NULL,'cus_H3NzalXnjNVlCt'),(35,'c8b3dc67-d9ff-438b-84f4-7d9fe35b284b','','','','','roberto.mezza+1234@gmail.com','$2y$10$963f35IH6LxU5EXcZ5d1zulu2ng1Ozp4PIyAN13IGWki1GaYN53Q6',NULL,NULL,'{\"sub\":\"c8b3dc67-d9ff-438b-84f4-7d9fe35b284b\",\"name\":null,\"email\":\"roberto.mezza+1234@gmail.com\",\"role\":null}','CUSTOMER','2020-02-17 17:10:25','2020-02-17 16:10:25',NULL,''),(36,'d4d38d42-02e4-43c6-b912-e8a627d340c1','','','','','marco.vitolo+10@gmail.com','$2y$10$BHQCTFHZ7hcgGSShKtAyQeUQrND18.WApBlmB22d47UZyXCYf/aOa',NULL,NULL,'{\"sub\":\"d4d38d42-02e4-43c6-b912-e8a627d340c1\",\"name\":null,\"email\":\"marco.vitolo+10@gmail.com\",\"role\":null}','CUSTOMER','2020-02-14 13:59:15','2020-02-14 12:59:15',NULL,''),(37,'d504c4dc-c85a-49e1-8039-829026ba9993','','','','','Roberto.mezza+999@gmail.com','$2y$10$MCOmv2QXgie9IPzAr6ZdbuzmHvUMW63xp3XqQ14wYieGkhwGrOVpe',NULL,NULL,'{\"sub\":\"d504c4dc-c85a-49e1-8039-829026ba9993\",\"name\":\"Rob\",\"email\":\"Roberto.mezza+999@gmail.com\",\"role\":null}','CUSTOMER','2020-02-19 14:07:34','2020-02-19 13:07:34',NULL,''),(38,'da891a48-f5f9-4db4-b88c-d8d85d6d5722','','','','','igor.squad+test1@gmail.com','$2y$10$gnoSACgh5bj9wBHL9Dnaget.62.M7taTyNpHN6JWl5yZxF1WqDAVm',NULL,NULL,'{\"sub\":\"da891a48-f5f9-4db4-b88c-d8d85d6d5722\",\"name\":null,\"email\":\"igor.squad+test1@gmail.com\",\"role\":null}','CUSTOMER','2020-02-21 14:27:35','2020-02-21 13:27:35',NULL,''),(39,'def1ad52-9d70-4655-980a-fcf5c67b273a','','','','','marco+1@pickmealup.com','$2y$10$ZCRy16XnhcvoNo1oCWnVE.VVbGqzG0mWzFrrGWQrVUxSBhqspHHCK',NULL,NULL,'{\"sub\":\"def1ad52-9d70-4655-980a-fcf5c67b273a\",\"name\":null,\"email\":\"marco+1@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-26 14:46:00','2020-03-26 13:46:00',NULL,''),(40,'dfd97c32-7c38-4bdb-88d9-223bb299f425','','','','','marco+11@pickmealup.com','$2y$10$m8.oeVYNnviKuArEjcCDweZuRFdMDOZUMqasyR.QU18aiZj69VO9m',NULL,NULL,'{\"sub\":\"dfd97c32-7c38-4bdb-88d9-223bb299f425\",\"name\":null,\"email\":\"marco+11@pickmealup.com\",\"role\":null}','CUSTOMER','2020-03-30 08:25:02','2020-03-30 06:25:02',NULL,''),(41,'e0f0ccfa-b0c7-42d7-97f4-56062d2d6fb1','','','','','alessandro.lanza@valuepartners.com','$2y$10$J/43ygd3DFo9DZGK.5WjIO/z6o9VIBjVUtkQAnzjm3F1QUVSCqv7y',NULL,NULL,'{\"sub\":\"e0f0ccfa-b0c7-42d7-97f4-56062d2d6fb1\",\"name\":\"Alessandro\",\"email\":\"alessandro.lanza@valuepartners.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-23 14:51:27','2020-03-23 13:52:45',NULL,''),(42,'e0ffab5a-66fc-400f-9792-945bad4b8315','','','','','giorgia.bertoni@21ilab.com','$2y$10$NIXvQHk8ib9KAAeENCjhTu/uhWsPZgjyfmxE9VzOBpxVnKeRrImz2',NULL,NULL,'{\"sub\":\"e0ffab5a-66fc-400f-9792-945bad4b8315\",\"name\":\"Giorgia Bertoni\",\"email\":\"giorgia.bertoni@21ilab.com\",\"role\":\"ADMIN\"}','ADMIN','2020-03-05 09:44:37','2020-03-05 08:45:29',NULL,''),(43,'e36b3f4f-8af8-4bec-a21b-ae9e7b07ee9d','','','','','davi.leichsenring+21@21ilab.com','$2y$10$Aaffiie9uSrw9L/jtK9cWuyKjMUyJJHSBaBCe.UcwPQ1xuwx1ZOfq',NULL,NULL,'{\"sub\":\"e36b3f4f-8af8-4bec-a21b-ae9e7b07ee9d\",\"name\":\"Davi Teste\",\"email\":\"davi.leichsenring+21@21ilab.com\",\"role\":\"OWNER\"}','OWNER','2020-01-29 16:36:16','2020-01-31 15:45:46',NULL,''),(47,'4a9ed5c1-9998-4672-b962-7bd3dbe65bfa','','','','','marco.vitolo+19@gmail.com','$2y$10$noC5nhVF6q1l1hijLrTFeunDL2anQMKfs7ntiNT1DLMZJ5HsTAAne',NULL,NULL,'{\"sub\":\"4a9ed5c1-9998-4672-b962-7bd3dbe65bfa\",\"name\":null,\"email\":\"marco.vitolo+19@gmail.com\",\"role\":null}','CUSTOMER','2020-04-02 14:28:21','2020-04-02 12:28:21',NULL,''),(50,'04200dc1-0cb4-4e72-988c-130a2c739c53','','','','','luca.raccampo@valuepartners.com','$2y$10$4xYDgk2.3kSVzf8df72eFOa6D4.mwf8WHrIl0whb0sOgXt8AW2ADi',NULL,NULL,'{\"sub\":\"04200dc1-0cb4-4e72-988c-130a2c739c53\",\"name\":\"Luca Raccampo\",\"email\":\"luca.raccampo@valuepartners.com\",\"role\":\"ADMIN\"}','ADMIN','2020-04-03 13:27:19','2020-04-03 11:27:20',NULL,''),(53,'d4ffa748-98ff-46ad-b269-5ded11ee37c4','','','','','igor.squad+35@gmail.com','$2y$10$fQF82hASn20rkrTLoIUD8Okwpw2OFuqKlQrmazvH5TncgFjernmAm',NULL,NULL,'{\"sub\":\"d4ffa748-98ff-46ad-b269-5ded11ee37c4\",\"name\":null,\"email\":\"igor.squad+35@gmail.com\",\"role\":null}','CUSTOMER','2020-04-07 08:32:58','2020-04-07 06:32:58',NULL,''),(54,'e3fa2cdd-2f8d-4dc4-8a29-cc93ef87f50a','','','','','marco.vitolo+1@gmail.com','$2y$10$bkqQQToV3.d7/F1Qu5A82uNFW8EXkgRbYN4SvdTxv4bFgHtm/IMkS',NULL,NULL,'{\"sub\":\"e3fa2cdd-2f8d-4dc4-8a29-cc93ef87f50a\",\"name\":\"Marco Vitolo Ristorante\",\"email\":\"marco.vitolo+1@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-06 16:17:53','2020-04-07 06:41:41',NULL,''),(55,'18732df8-522a-4154-92d8-4e620ce29719','','','','','igor.squad+test37@gmail.com','$2y$10$yuKNIMh4xeEU3gw.EzgXTOVXtw1m9YyrdbpvCjgBXfOprEs3bEedK',NULL,NULL,'{\"sub\":\"18732df8-522a-4154-92d8-4e620ce29719\",\"name\":null,\"email\":\"igor.squad+test37@gmail.com\",\"role\":null}','CUSTOMER','2020-04-07 08:36:29','2020-04-07 06:36:29',NULL,''),(57,'92b246bc-de38-4368-900a-98c7e6361f5d','','','','','igor.squadra+2@21ilab.com','$2y$10$dkTv7K1./VSRjh716z7T6.8nY/gyPcJ0tMfzbWHYZvaUqEfLvxvom',NULL,NULL,'{\"sub\":\"92b246bc-de38-4368-900a-98c7e6361f5d\",\"name\":\"Igor\",\"email\":\"igor.squadra+2@21ilab.com\",\"role\":\"OWNER\"}','OWNER','2020-04-07 08:58:15','2020-04-07 06:59:03',NULL,''),(58,'9f5c46ce-8940-4ef3-b757-ebe7ce29f12c','','','','','marco.vitolo+36@gmail.com','$2y$10$wX7lh6H7pDIPW7itYQ7Av.23tgWESbqhlwEdVTuwGn586YmWMKZvK',NULL,NULL,'{\"sub\":\"9f5c46ce-8940-4ef3-b757-ebe7ce29f12c\",\"name\":\"Marco owner\",\"email\":\"marco.vitolo+36@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-07 08:45:18','2020-04-07 06:46:05',NULL,''),(59,'1d7f01d9-99fa-4e9e-becf-0a37b51bc479','','','','','igor.squad@gmail.com','$2y$10$GtgIgyvaz3LcbATy5oxsBO8o5eGLqcnPr3s03VxWrg3dbaCH9gv3.',NULL,NULL,'{\"sub\":\"1d7f01d9-99fa-4e9e-becf-0a37b51bc479\",\"name\":null,\"email\":\"igor.squad@gmail.com\",\"role\":null}','CUSTOMER','2020-04-08 05:45:48','2020-04-09 08:28:56',NULL,'cus_H3lHXutWNyseyc'),(60,'db165a45-4664-4b85-b186-fe159bee24d7','','','','','paololimone@paolo.com','$2y$10$WYDVdLqTBRJe6V/NK0NkmO2Su7yazZiGNmrWAh6YV7ZKGTcW9q90G',NULL,NULL,'{\"sub\":\"db165a45-4664-4b85-b186-fe159bee24d7\",\"name\":\"paololimone\",\"email\":\"paololimone@paolo.com\",\"role\":null}','CUSTOMER','2020-04-09 08:42:54','2020-04-09 10:00:09',NULL,''),(61,'7e48ca3e-ff56-421e-b6b5-399c876c44d6','','','','','luca.raccampo+owner1@gmail.com','$2y$10$iAnBqb5C2v5g2Gnbp6w4c.nma9H4Lakl1L64I9fF9qJpWpVj/n/By',NULL,NULL,'{\"sub\":\"7e48ca3e-ff56-421e-b6b5-399c876c44d6\",\"name\":\"Owner 1\",\"email\":\"luca.raccampo+owner1@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-09 12:51:17','2020-04-09 12:51:18',NULL,''),(63,'51f25a8c-3324-469d-a63c-b1b39af819d7','','','','','luca.raccampo+owner3@gmail.com','$2y$10$J6h4G4fipQbjviNlwgElfOfq7P6gICYewUrWjDvWCx0zTQy.eiUqa',NULL,NULL,'{\"sub\":\"51f25a8c-3324-469d-a63c-b1b39af819d7\",\"name\":\"Owner 3\",\"email\":\"luca.raccampo+owner3@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-09 13:00:28','2020-04-09 13:00:29',NULL,''),(71,'c345baea-d391-4e8f-aa10-c1d339ad58ff','','','','','luca.raccampo+owner7@gmail.com','$2y$10$k4E0qOhado3kEfJ0uChLLO6zowN0tx7BeL99YRGrI21PTyePbBqSu',NULL,NULL,'{\"sub\":\"c345baea-d391-4e8f-aa10-c1d339ad58ff\",\"name\":\"Owner 7\",\"email\":\"luca.raccampo+owner7@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-10 05:15:14','2020-04-10 05:15:15',NULL,''),(75,'2410d36c-87cd-4626-b3c4-b0a522a25c7d','','','','','luca.raccampo+owner10@gmail.com','$2y$10$gfd05mn/KaHp9d6ZM2cvJu4.m/Gq17b8ykpksLlz6akbEvE6ozl0W',NULL,NULL,'{\"sub\":\"2410d36c-87cd-4626-b3c4-b0a522a25c7d\",\"name\":\"Owner 10\",\"email\":\"luca.raccampo+owner10@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-10 08:56:10','2020-04-10 08:56:11',NULL,''),(77,'acd86bf1-9997-480f-999d-ca439eae5beb','','','','','luca.raccampo+owner12@gmail.com','$2y$10$NHe.oFZ.3DVdMHfA95EnxecfxrcrSH9WBm4.Q6wUiJ05rYUnIxByi',NULL,NULL,'{\"sub\":\"acd86bf1-9997-480f-999d-ca439eae5beb\",\"name\":\"Owner 12\",\"email\":\"luca.raccampo+owner12@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-10 10:22:43','2020-04-10 10:22:43',NULL,''),(78,'590ee8f9-bbdc-4086-b8ec-12a95cde8db2','','','','','luca.raccampo+owner20@gmail.com','$2y$10$s5JGVOK3uT8sj8GY5HYPv.WZLWQ7SNkUvHJz3z5vRLa5FrVZZuxLq',NULL,NULL,'{\"sub\":\"590ee8f9-bbdc-4086-b8ec-12a95cde8db2\",\"name\":\"Ower 20\",\"email\":\"luca.raccampo+owner20@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-10 10:42:13','2020-04-10 14:16:20',NULL,''),(82,'1d5abbec-d046-4b50-8002-bdba723ea91a','','','','','tes@tes.it','$2y$10$29rjS6OIw11T7UWOmBUgReTJgsPIQ/KKeudCKc8lTE8xYviGGSPMS',NULL,NULL,'{\"sub\":\"1d5abbec-d046-4b50-8002-bdba723ea91a\",\"name\":\"test\",\"email\":\"tes@tes.it\",\"role\":\"OWNER\"}','OWNER','2020-04-10 12:11:10','2020-04-10 12:12:37',NULL,''),(83,'5b64943c-555c-4f80-9b8c-8da3e23bb90c','','','','','carlo+7@pickmealup.com','$2y$10$wg58YRULRDaIKe7VE8roP.mJdg1xQ2ExSc0/AllyKevi2CTUMSGZ2',NULL,NULL,'{\"sub\":\"5b64943c-555c-4f80-9b8c-8da3e23bb90c\",\"name\":\"Carl\",\"email\":\"carlo+7@pickmealup.com\",\"role\":null}','CUSTOMER','2020-04-10 13:20:31','2020-04-10 13:20:31',NULL,''),(84,'87adfa86-e3c9-47d4-a6d4-7d54b176cd53','','','','','luca.raccampo+testerr@gmail.com','$2y$10$sGcVS1ILn/C/dg8It8akp.ltFpaTKFPxHaRNDNHE3IMRannfIfiyW',NULL,NULL,'{\"sub\":\"87adfa86-e3c9-47d4-a6d4-7d54b176cd53\",\"name\":\"test\",\"email\":\"luca.raccampo+testerr@gmail.com\",\"role\":\"OWNER\"}','OWNER','2020-04-14 05:34:07','2020-04-14 05:34:08',NULL,'');
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

-- Dump completed on 2020-04-14 13:35:18
