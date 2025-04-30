-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para mealmatch
CREATE DATABASE IF NOT EXISTS `mealmatch` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mealmatch`;

-- Volcando estructura para tabla mealmatch.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.dishes
CREATE TABLE IF NOT EXISTS `dishes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` json DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dishes_user_id_foreign` (`user_id`),
  CONSTRAINT `dishes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.dishes: ~3 rows (aproximadamente)
INSERT INTO `dishes` (`id`, `name`, `description`, `price`, `image`, `tags`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'paella', 'paella valenciana', 10.00, 'dishes/OrYdTMIqle5s0S3eloatUZxZayUextDhz7qRmXrU.jpg', NULL, 1, '2025-03-31 06:25:28', '2025-03-31 06:25:28'),
	(3, 'carne con papas', 'plato con sabor especial', 10.00, 'dishes/KA5UWsLyqTws2aIQdt8ZGEalKJxOQxVyqcFplJot.jpg', '"[\\"Comida Familiar Casera\\",\\"Confort Food \\\\/ Comida Reconfortante\\",\\"Hecho con Amor\\",\\"100% Casero\\"]"', 1, '2025-04-23 07:49:38', '2025-04-23 07:49:38'),
	(5, 'paella', 'rico', 10.00, 'dishes/SDNMvN9PcPBBqPl7w3FFeI69dwG92MwFwUUccOTJ.jpg', '"[\\"Comida Familiar Casera\\",\\"Para Consentirte\\",\\"Desayuno de Domingo\\",\\"Hecho con Amor\\"]"', 2, '2025-04-25 08:38:02', '2025-04-25 08:38:02'),
	(6, 'comida', 'rico', 10.00, 'dishes/fLgDsk456C1BHG9Yo7lsCzznltAHvbc4vtWGMDSm.jpg', '"[\\"Ideal para una Primera Cita\\",\\"Para Recargar Energ\\\\u00edas\\"]"', 1, '2025-04-28 09:20:27', '2025-04-28 09:20:27');

-- Volcando estructura para tabla mealmatch.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.job_batches: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.migrations: ~8 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_03_06_092600_add_rol_to_users_table', 1),
	(5, '2025_03_07_120539_add_profile_fields_to_users_table', 1),
	(6, '2025_03_07_133644_create_dishes_table', 2),
	(7, '2025_03_31_065619_add_profile_photo_url_to_users_table', 3),
	(8, '2025_03_31_093534_create_ratings_table', 4),
	(9, '2025_04_23_081726_add_latitud_longitud_to_users_table', 5),
	(10, '2025_04_23_083459_add_tags_to_dishes_table', 6),
	(11, '2025_04_28_093514_add_location_to_users_table', 7),
	(12, '2025_04_28_104347_create_orders_table', 8);

-- Volcando estructura para tabla mealmatch.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `cocinero_id` bigint unsigned NOT NULL,
  `items` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_cocinero_id_foreign` (`cocinero_id`),
  CONSTRAINT `orders_cocinero_id_foreign` FOREIGN KEY (`cocinero_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.orders: ~1 rows (aproximadamente)
INSERT INTO `orders` (`id`, `user_id`, `cocinero_id`, `items`, `created_at`, `updated_at`) VALUES
	(1, 13, 1, '[{"id": 1, "key": 1745838904239.5186, "name": "paella", "tags": null, "image": "dishes/OrYdTMIqle5s0S3eloatUZxZayUextDhz7qRmXrU.jpg", "price": "10.00", "user_id": 1, "quantity": 1, "created_at": "2025-03-31T07:25:28.000000Z", "updated_at": "2025-03-31T07:25:28.000000Z", "description": "paella valenciana"}]', '2025-04-28 09:52:17', '2025-04-28 10:15:05'),
	(2, 13, 2, '[{"id": 5, "key": 1745839066175.7715, "name": "paella", "tags": "[\\"Comida Familiar Casera\\",\\"Para Consentirte\\",\\"Desayuno de Domingo\\",\\"Hecho con Amor\\"]", "image": "dishes/SDNMvN9PcPBBqPl7w3FFeI69dwG92MwFwUUccOTJ.jpg", "price": "10.00", "user_id": 2, "quantity": 1, "created_at": "2025-04-25T09:38:02.000000Z", "updated_at": "2025-04-25T09:38:02.000000Z", "description": "rico"}]', '2025-04-28 10:17:47', '2025-04-28 10:17:47');

-- Volcando estructura para tabla mealmatch.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.ratings
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `seller_id` bigint unsigned NOT NULL,
  `rating` tinyint unsigned NOT NULL COMMENT 'Valoración 1-5',
  `comment` text COLLATE utf8mb4_unicode_ci COMMENT 'Comentario opcional',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  KEY `ratings_seller_id_foreign` (`seller_id`),
  CONSTRAINT `ratings_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`),
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.ratings: ~5 rows (aproximadamente)
INSERT INTO `ratings` (`id`, `user_id`, `seller_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
	(1, 12, 1, 3, NULL, '2025-03-31 08:56:01', '2025-03-31 08:56:01'),
	(2, 12, 2, 5, 'buen servicio', '2025-03-31 08:57:12', '2025-03-31 08:57:12'),
	(3, 13, 3, 2, NULL, '2025-04-23 06:59:03', '2025-04-23 06:59:03'),
	(4, 13, 1, 3, 'rico', '2025-04-25 08:27:30', '2025-04-25 08:27:30'),
	(5, 13, 2, 3, 'vacio', '2025-04-25 08:34:34', '2025-04-25 08:34:34');

-- Volcando estructura para tabla mealmatch.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.sessions: ~1 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('rli1328J3qo5XmGTadPAWqORiXwhpqDqHUnGumk5', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMUNNbENNb2NWS056b2xibURkTjJBUzdLbmt1SXBJVmdjRlpJbmM5VyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb2NpbmVyb3MvMSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEzO30=', 1745839183);

-- Volcando estructura para tabla mealmatch.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.users: ~13 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `location`, `profile_photo_url`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `rol`) VALUES
	(1, 'Chef Carlos', 'chef1@prueba.com', 'Costa Teguise', 'chef-profiles/chef1.jpg', NULL, '$2y$12$usczTNgsA3cF/cKuaCnWTubuCcYV0s931LYnSdRNPyYQVyOaOPYpO', NULL, '2025-03-31 06:08:15', '2025-04-28 08:50:57', 'cocinero'),
	(2, 'Chef María', 'chef2@prueba.com', 'Puerto del Carmen', 'chef-profiles/acY95Jw9LklwwMXo5qGphtPOBpTl83WfjjMnqJBw.jpg', NULL, '$2y$12$c/aILQCOIFZeaeevme/opuIZvKt5WemfzqRS0EEIQwiFmM2gmwbsK', NULL, '2025-03-31 06:08:15', '2025-04-28 08:50:57', 'cocinero'),
	(3, 'Chef Juan', 'chef3@prueba.com', 'San Bartolomé', 'chef-profiles/chef3.jpg', NULL, '$2y$12$br0hS9215kJi50UUL206oeqAoxt18dkQw6koMFf771FHlebzbc1hy', NULL, '2025-03-31 06:08:15', '2025-04-28 08:50:57', 'cocinero'),
	(4, 'Chef Laura', 'chef4@prueba.com', 'Tinajo', 'chef-profiles/chef4.jpg', NULL, '$2y$12$EeQ2C3ResbZbYABLrA7MBu5WNMVYptYNeVoEPNChtSkCSJiOh96x6', NULL, '2025-03-31 06:08:15', '2025-04-28 08:50:57', 'cocinero'),
	(5, 'Chef Pedro', 'chef5@prueba.com', 'Teguise', 'chef-profiles/chef5.jpg', NULL, '$2y$12$0o.x0PVSeWxxf33D2dPAkeaoVjCLF2SfqGkPE5h4SCkn7Ne96RsAG', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(6, 'Chef Sofia', 'chef6@prueba.com', 'San Bartolomé', 'chef-profiles/chef6.jpg', NULL, '$2y$12$NDVgYiy/SO5DoDaP/7o6f.em1Z4yX0.Fo5d.wFF5MYBoYG.2.F4pK', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(7, 'Chef Antonio', 'chef7@prueba.com', 'Arrecife', 'chef-profiles/chef7.jpg', NULL, '$2y$12$2w6N6DjGqgiLKebwykGob.W4KmOizblL9Ar5bUOf/zAs8PNtyUnLC', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(8, 'Chef Julia', 'chef8@prueba.com', 'Costa Teguise', 'chef-profiles/chef8.jpg', NULL, '$2y$12$I41r30WUyGf2bQAC8kGQZOiFBs5epBHtYMYL33wi/DaJWCS3ByW9O', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(9, 'Chef Miguel', 'chef9@prueba.com', 'Arrecife', 'chef-profiles/chef9.jpg', NULL, '$2y$12$I3XQ3Izc2siTx9jHi1gZQOHQB9rL7/lxCurY/1qz/GjQw.QKrlBSS', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(10, 'Chef Elena', 'chef10@prueba.com', 'Playa Blanca', 'chef-profiles/chef10.jpg', NULL, '$2y$12$uUaREagbZpaVo9I3p8bK/.L.X3DsdMKMa9c942pHhcON.Jw.7ArwS', NULL, '2025-03-31 06:08:17', '2025-04-28 08:50:57', 'cocinero'),
	(11, 'carlos', 'carlos@gmail.com', 'San Bartolomé', NULL, NULL, '$2y$12$sEqVWGxisKFgm1AmL/g/6u3L2va5Z/2sU8O0wag1RVoq2lxIuhWMy', NULL, '2025-03-31 06:10:35', '2025-04-28 08:50:57', 'cliente'),
	(12, 'marquito', 'marcos@gmail.com', 'Teguise', NULL, NULL, '$2y$12$dm8UZ59arUPcXE9a4t/7J..Cwqe5Y0MjYXstkv3DA.Lat.Xo/GRQC', NULL, '2025-03-31 06:13:26', '2025-04-28 08:50:57', 'cliente'),
	(13, 'jorge morfi', 'morfijorge@gmail.com', 'Tinajo', NULL, NULL, '$2y$12$hJ4xH.rK3Fd4wC4wzJLu1OBVp0NlKB7A.Z54WmDwhP9UC8ZDY1k9O', NULL, '2025-04-21 05:33:31', '2025-04-28 08:50:57', 'cliente'),
	(14, 'manuel', 'manuel@gmail.com', 'arrecife', NULL, NULL, '$2y$12$Jiu24RC6HXJ0O9bNxT/PjOm5QuYD4QoUfLZKkcv683ol98zZ3vGF.', NULL, '2025-04-28 08:56:24', '2025-04-28 08:56:24', 'cliente');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para mealmatch
CREATE DATABASE IF NOT EXISTS `mealmatch` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mealmatch`;

-- Volcando estructura para tabla mealmatch.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.dishes
CREATE TABLE IF NOT EXISTS `dishes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` json DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dishes_user_id_foreign` (`user_id`),
  CONSTRAINT `dishes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.dishes: ~3 rows (aproximadamente)
INSERT INTO `dishes` (`id`, `name`, `description`, `price`, `image`, `tags`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'paella', 'paella valenciana', 10.00, 'dishes/OrYdTMIqle5s0S3eloatUZxZayUextDhz7qRmXrU.jpg', NULL, 1, '2025-03-31 06:25:28', '2025-03-31 06:25:28'),
	(3, 'carne con papas', 'plato con sabor especial', 10.00, 'dishes/KA5UWsLyqTws2aIQdt8ZGEalKJxOQxVyqcFplJot.jpg', '"[\\"Comida Familiar Casera\\",\\"Confort Food \\\\/ Comida Reconfortante\\",\\"Hecho con Amor\\",\\"100% Casero\\"]"', 1, '2025-04-23 07:49:38', '2025-04-23 07:49:38'),
	(5, 'paella', 'rico', 10.00, 'dishes/SDNMvN9PcPBBqPl7w3FFeI69dwG92MwFwUUccOTJ.jpg', '"[\\"Comida Familiar Casera\\",\\"Para Consentirte\\",\\"Desayuno de Domingo\\",\\"Hecho con Amor\\"]"', 2, '2025-04-25 08:38:02', '2025-04-25 08:38:02'),
	(6, 'comida', 'rico', 10.00, 'dishes/fLgDsk456C1BHG9Yo7lsCzznltAHvbc4vtWGMDSm.jpg', '"[\\"Ideal para una Primera Cita\\",\\"Para Recargar Energ\\\\u00edas\\"]"', 1, '2025-04-28 09:20:27', '2025-04-28 09:20:27');

-- Volcando estructura para tabla mealmatch.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.job_batches: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.migrations: ~8 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_03_06_092600_add_rol_to_users_table', 1),
	(5, '2025_03_07_120539_add_profile_fields_to_users_table', 1),
	(6, '2025_03_07_133644_create_dishes_table', 2),
	(7, '2025_03_31_065619_add_profile_photo_url_to_users_table', 3),
	(8, '2025_03_31_093534_create_ratings_table', 4),
	(9, '2025_04_23_081726_add_latitud_longitud_to_users_table', 5),
	(10, '2025_04_23_083459_add_tags_to_dishes_table', 6),
	(11, '2025_04_28_093514_add_location_to_users_table', 7),
	(12, '2025_04_28_104347_create_orders_table', 8);

-- Volcando estructura para tabla mealmatch.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `cocinero_id` bigint unsigned NOT NULL,
  `items` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_cocinero_id_foreign` (`cocinero_id`),
  CONSTRAINT `orders_cocinero_id_foreign` FOREIGN KEY (`cocinero_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.orders: ~1 rows (aproximadamente)
INSERT INTO `orders` (`id`, `user_id`, `cocinero_id`, `items`, `created_at`, `updated_at`) VALUES
	(1, 13, 1, '[{"id": 1, "key": 1745838904239.5186, "name": "paella", "tags": null, "image": "dishes/OrYdTMIqle5s0S3eloatUZxZayUextDhz7qRmXrU.jpg", "price": "10.00", "user_id": 1, "quantity": 1, "created_at": "2025-03-31T07:25:28.000000Z", "updated_at": "2025-03-31T07:25:28.000000Z", "description": "paella valenciana"}]', '2025-04-28 09:52:17', '2025-04-28 10:15:05'),
	(2, 13, 2, '[{"id": 5, "key": 1745839066175.7715, "name": "paella", "tags": "[\\"Comida Familiar Casera\\",\\"Para Consentirte\\",\\"Desayuno de Domingo\\",\\"Hecho con Amor\\"]", "image": "dishes/SDNMvN9PcPBBqPl7w3FFeI69dwG92MwFwUUccOTJ.jpg", "price": "10.00", "user_id": 2, "quantity": 1, "created_at": "2025-04-25T09:38:02.000000Z", "updated_at": "2025-04-25T09:38:02.000000Z", "description": "rico"}]', '2025-04-28 10:17:47', '2025-04-28 10:17:47');

-- Volcando estructura para tabla mealmatch.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla mealmatch.ratings
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `seller_id` bigint unsigned NOT NULL,
  `rating` tinyint unsigned NOT NULL COMMENT 'Valoración 1-5',
  `comment` text COLLATE utf8mb4_unicode_ci COMMENT 'Comentario opcional',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  KEY `ratings_seller_id_foreign` (`seller_id`),
  CONSTRAINT `ratings_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`),
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.ratings: ~5 rows (aproximadamente)
INSERT INTO `ratings` (`id`, `user_id`, `seller_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
	(1, 12, 1, 3, NULL, '2025-03-31 08:56:01', '2025-03-31 08:56:01'),
	(2, 12, 2, 5, 'buen servicio', '2025-03-31 08:57:12', '2025-03-31 08:57:12'),
	(3, 13, 3, 2, NULL, '2025-04-23 06:59:03', '2025-04-23 06:59:03'),
	(4, 13, 1, 3, 'rico', '2025-04-25 08:27:30', '2025-04-25 08:27:30'),
	(5, 13, 2, 3, 'vacio', '2025-04-25 08:34:34', '2025-04-25 08:34:34');

-- Volcando estructura para tabla mealmatch.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.sessions: ~1 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('rli1328J3qo5XmGTadPAWqORiXwhpqDqHUnGumk5', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMUNNbENNb2NWS056b2xibURkTjJBUzdLbmt1SXBJVmdjRlpJbmM5VyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb2NpbmVyb3MvMSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEzO30=', 1745839183);

-- Volcando estructura para tabla mealmatch.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla mealmatch.users: ~13 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `location`, `profile_photo_url`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `rol`) VALUES
	(1, 'Chef Carlos', 'chef1@prueba.com', 'Costa Teguise', 'chef-profiles/chef1.jpg', NULL, '$2y$12$usczTNgsA3cF/cKuaCnWTubuCcYV0s931LYnSdRNPyYQVyOaOPYpO', NULL, '2025-03-31 06:08:15', '2025-04-28 08:50:57', 'cocinero'),
	(2, 'Chef María', 'chef2@prueba.com', 'Puerto del Carmen', 'chef-profiles/acY95Jw9LklwwMXo5qGphtPOBpTl83WfjjMnqJBw.jpg', NULL, '$2y$12$c/aILQCOIFZeaeevme/opuIZvKt5WemfzqRS0EEIQwiFmM2gmwbsK', NULL, '2025-03-31 06:08:15', '2025-04-28 08:50:57', 'cocinero'),
	(3, 'Chef Juan', 'chef3@prueba.com', 'San Bartolomé', 'chef-profiles/chef3.jpg', NULL, '$2y$12$br0hS9215kJi50UUL206oeqAoxt18dkQw6koMFf771FHlebzbc1hy', NULL, '2025-03-31 06:08:15', '2025-04-28 08:50:57', 'cocinero'),
	(4, 'Chef Laura', 'chef4@prueba.com', 'Tinajo', 'chef-profiles/chef4.jpg', NULL, '$2y$12$EeQ2C3ResbZbYABLrA7MBu5WNMVYptYNeVoEPNChtSkCSJiOh96x6', NULL, '2025-03-31 06:08:15', '2025-04-28 08:50:57', 'cocinero'),
	(5, 'Chef Pedro', 'chef5@prueba.com', 'Teguise', 'chef-profiles/chef5.jpg', NULL, '$2y$12$0o.x0PVSeWxxf33D2dPAkeaoVjCLF2SfqGkPE5h4SCkn7Ne96RsAG', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(6, 'Chef Sofia', 'chef6@prueba.com', 'San Bartolomé', 'chef-profiles/chef6.jpg', NULL, '$2y$12$NDVgYiy/SO5DoDaP/7o6f.em1Z4yX0.Fo5d.wFF5MYBoYG.2.F4pK', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(7, 'Chef Antonio', 'chef7@prueba.com', 'Arrecife', 'chef-profiles/chef7.jpg', NULL, '$2y$12$2w6N6DjGqgiLKebwykGob.W4KmOizblL9Ar5bUOf/zAs8PNtyUnLC', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(8, 'Chef Julia', 'chef8@prueba.com', 'Costa Teguise', 'chef-profiles/chef8.jpg', NULL, '$2y$12$I41r30WUyGf2bQAC8kGQZOiFBs5epBHtYMYL33wi/DaJWCS3ByW9O', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(9, 'Chef Miguel', 'chef9@prueba.com', 'Arrecife', 'chef-profiles/chef9.jpg', NULL, '$2y$12$I3XQ3Izc2siTx9jHi1gZQOHQB9rL7/lxCurY/1qz/GjQw.QKrlBSS', NULL, '2025-03-31 06:08:16', '2025-04-28 08:50:57', 'cocinero'),
	(10, 'Chef Elena', 'chef10@prueba.com', 'Playa Blanca', 'chef-profiles/chef10.jpg', NULL, '$2y$12$uUaREagbZpaVo9I3p8bK/.L.X3DsdMKMa9c942pHhcON.Jw.7ArwS', NULL, '2025-03-31 06:08:17', '2025-04-28 08:50:57', 'cocinero'),
	(11, 'carlos', 'carlos@gmail.com', 'San Bartolomé', NULL, NULL, '$2y$12$sEqVWGxisKFgm1AmL/g/6u3L2va5Z/2sU8O0wag1RVoq2lxIuhWMy', NULL, '2025-03-31 06:10:35', '2025-04-28 08:50:57', 'cliente'),
	(12, 'marquito', 'marcos@gmail.com', 'Teguise', NULL, NULL, '$2y$12$dm8UZ59arUPcXE9a4t/7J..Cwqe5Y0MjYXstkv3DA.Lat.Xo/GRQC', NULL, '2025-03-31 06:13:26', '2025-04-28 08:50:57', 'cliente'),
	(13, 'jorge morfi', 'morfijorge@gmail.com', 'Tinajo', NULL, NULL, '$2y$12$hJ4xH.rK3Fd4wC4wzJLu1OBVp0NlKB7A.Z54WmDwhP9UC8ZDY1k9O', NULL, '2025-04-21 05:33:31', '2025-04-28 08:50:57', 'cliente'),
	(14, 'manuel', 'manuel@gmail.com', 'arrecife', NULL, NULL, '$2y$12$Jiu24RC6HXJ0O9bNxT/PjOm5QuYD4QoUfLZKkcv683ol98zZ3vGF.', NULL, '2025-04-28 08:56:24', '2025-04-28 08:56:24', 'cliente');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
