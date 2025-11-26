-- Adminer 4.8.4 MySQL 9.1.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `clicks`;
CREATE TABLE `clicks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `offer_id` bigint unsigned NOT NULL,
  `webmaster_id` bigint unsigned NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `redirected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clicks_offer_id_foreign` (`offer_id`),
  KEY `clicks_webmaster_id_foreign` (`webmaster_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `clicks` (`id`, `offer_id`, `webmaster_id`, `ip_address`, `user_agent`, `redirected_at`, `created_at`, `updated_at`) VALUES
(1,	3,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:00',	'2025-11-25 19:42:00',	'2025-11-25 19:42:00'),
(2,	3,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:04',	'2025-11-25 19:42:04',	'2025-11-25 19:42:04'),
(3,	3,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:09',	'2025-11-25 19:42:09',	'2025-11-25 19:42:09'),
(4,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:46',	'2025-11-25 19:42:46',	'2025-11-25 19:42:46'),
(5,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:49',	'2025-11-25 19:42:49',	'2025-11-25 19:42:49'),
(6,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:51',	'2025-11-25 19:42:51',	'2025-11-25 19:42:51'),
(7,	5,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:41:29',	'2025-11-25 21:41:29',	'2025-11-25 21:41:29'),
(8,	5,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:41:32',	'2025-11-25 21:41:32',	'2025-11-25 21:41:32'),
(9,	5,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:41:35',	'2025-11-25 21:41:35',	'2025-11-25 21:41:35');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `link_logs`;
CREATE TABLE `link_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `webmaster_id` bigint unsigned NOT NULL,
  `offer_id` bigint unsigned NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `link_logs_webmaster_id_foreign` (`webmaster_id`),
  KEY `link_logs_offer_id_foreign` (`offer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `link_logs` (`id`, `webmaster_id`, `offer_id`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:33:08',	'2025-11-25 19:33:08'),
(2,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:33:08',	'2025-11-25 19:33:08'),
(3,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:14',	'2025-11-25 19:42:14'),
(4,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:14',	'2025-11-25 19:42:14'),
(5,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:42',	'2025-11-25 19:42:42'),
(6,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:42:42',	'2025-11-25 19:42:42'),
(7,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:52:06',	'2025-11-25 19:52:06'),
(8,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:52:06',	'2025-11-25 19:52:06'),
(9,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 19:52:18',	'2025-11-25 19:52:18'),
(10,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 20:03:44',	'2025-11-25 20:03:44'),
(11,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 20:03:44',	'2025-11-25 20:03:44'),
(12,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 20:04:07',	'2025-11-25 20:04:07'),
(13,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 20:06:33',	'2025-11-25 20:06:33'),
(14,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 20:09:06',	'2025-11-25 20:09:06'),
(15,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 20:09:28',	'2025-11-25 20:09:28'),
(16,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 20:14:43',	'2025-11-25 20:14:43'),
(17,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 20:14:56',	'2025-11-25 20:14:56'),
(18,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:13:47',	'2025-11-25 21:13:47'),
(19,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:13:47',	'2025-11-25 21:13:47'),
(20,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:14:06',	'2025-11-25 21:14:06'),
(21,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:14:14',	'2025-11-25 21:14:14'),
(22,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:14:20',	'2025-11-25 21:14:20'),
(23,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:14:20',	'2025-11-25 21:14:20'),
(24,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:14:23',	'2025-11-25 21:14:23'),
(25,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:14:23',	'2025-11-25 21:14:23'),
(26,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:14:33',	'2025-11-25 21:14:33'),
(27,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:14:33',	'2025-11-25 21:14:33'),
(28,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:18:13',	'2025-11-25 21:18:13'),
(29,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:18:13',	'2025-11-25 21:18:13'),
(30,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:19:51',	'2025-11-25 21:19:51'),
(31,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:20:10',	'2025-11-25 21:20:10'),
(32,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:20:21',	'2025-11-25 21:20:21'),
(33,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:20:21',	'2025-11-25 21:20:21'),
(34,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:20:26',	'2025-11-25 21:20:26'),
(35,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:20:26',	'2025-11-25 21:20:26'),
(36,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:20:32',	'2025-11-25 21:20:32'),
(37,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:20:37',	'2025-11-25 21:20:37'),
(38,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:20:37',	'2025-11-25 21:20:37'),
(39,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:21:54',	'2025-11-25 21:21:54'),
(40,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:22:01',	'2025-11-25 21:22:01'),
(41,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:22:01',	'2025-11-25 21:22:01'),
(42,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:22:18',	'2025-11-25 21:22:18'),
(43,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:22:18',	'2025-11-25 21:22:18'),
(44,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:12',	'2025-11-25 21:23:12'),
(45,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:12',	'2025-11-25 21:23:12'),
(46,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:28',	'2025-11-25 21:23:28'),
(47,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:28',	'2025-11-25 21:23:28'),
(48,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:33',	'2025-11-25 21:23:33'),
(49,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:33',	'2025-11-25 21:23:33'),
(50,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:44',	'2025-11-25 21:23:44'),
(51,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:44',	'2025-11-25 21:23:44'),
(52,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:52',	'2025-11-25 21:23:52'),
(53,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:23:52',	'2025-11-25 21:23:52'),
(54,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:24:17',	'2025-11-25 21:24:17'),
(55,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:24:17',	'2025-11-25 21:24:17'),
(56,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:24:36',	'2025-11-25 21:24:36'),
(57,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:24:36',	'2025-11-25 21:24:36'),
(58,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:24:40',	'2025-11-25 21:24:40'),
(59,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:24:40',	'2025-11-25 21:24:40'),
(60,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:26:33',	'2025-11-25 21:26:33'),
(61,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:26:33',	'2025-11-25 21:26:33'),
(62,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:27:44',	'2025-11-25 21:27:44'),
(63,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:27:44',	'2025-11-25 21:27:44'),
(64,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:30:46',	'2025-11-25 21:30:46'),
(65,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:30:46',	'2025-11-25 21:30:46'),
(66,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:32:02',	'2025-11-25 21:32:02'),
(67,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:32:02',	'2025-11-25 21:32:02'),
(68,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:32:22',	'2025-11-25 21:32:22'),
(69,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:32:22',	'2025-11-25 21:32:22'),
(70,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:32:29',	'2025-11-25 21:32:29'),
(71,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:32:29',	'2025-11-25 21:32:29'),
(72,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:32:32',	'2025-11-25 21:32:32'),
(73,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:32:32',	'2025-11-25 21:32:32'),
(74,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:34:34',	'2025-11-25 21:34:34'),
(75,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:34:34',	'2025-11-25 21:34:34'),
(76,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:37:26',	'2025-11-25 21:37:26'),
(77,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:37:26',	'2025-11-25 21:37:26'),
(78,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:37:31',	'2025-11-25 21:37:31'),
(79,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:37:31',	'2025-11-25 21:37:31'),
(80,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:37:46',	'2025-11-25 21:37:46'),
(81,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:37:53',	'2025-11-25 21:37:53'),
(82,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:37:53',	'2025-11-25 21:37:53'),
(83,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:39:44',	'2025-11-25 21:39:44'),
(84,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:39:44',	'2025-11-25 21:39:44'),
(85,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:41:23',	'2025-11-25 21:41:23'),
(86,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:41:23',	'2025-11-25 21:41:23'),
(87,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:41:23',	'2025-11-25 21:41:23'),
(88,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:43:23',	'2025-11-25 21:43:23'),
(89,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:43:23',	'2025-11-25 21:43:23'),
(90,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:43:23',	'2025-11-25 21:43:23'),
(91,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:57:45',	'2025-11-25 21:57:45'),
(92,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:57:45',	'2025-11-25 21:57:45'),
(93,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 21:57:45',	'2025-11-25 21:57:45'),
(94,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 23:44:27',	'2025-11-25 23:44:27'),
(95,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-25 23:44:27',	'2025-11-25 23:44:27'),
(96,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 00:41:15',	'2025-11-26 00:41:15'),
(97,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 00:41:15',	'2025-11-26 00:41:15'),
(98,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:10:54',	'2025-11-26 01:10:54'),
(99,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:10:54',	'2025-11-26 01:10:54'),
(100,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:12:19',	'2025-11-26 01:12:19'),
(101,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:12:19',	'2025-11-26 01:12:19'),
(102,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:15:15',	'2025-11-26 01:15:15'),
(103,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:15:15',	'2025-11-26 01:15:15'),
(104,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:18:13',	'2025-11-26 01:18:13'),
(105,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:18:13',	'2025-11-26 01:18:13'),
(106,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:19:20',	'2025-11-26 01:19:20'),
(107,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:19:20',	'2025-11-26 01:19:20'),
(108,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:31:29',	'2025-11-26 01:31:29'),
(109,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:31:29',	'2025-11-26 01:31:29'),
(110,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:34:59',	'2025-11-26 01:34:59'),
(111,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:34:59',	'2025-11-26 01:34:59'),
(112,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:35:08',	'2025-11-26 01:35:08'),
(113,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:35:08',	'2025-11-26 01:35:08'),
(114,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:35:11',	'2025-11-26 01:35:11'),
(115,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:35:11',	'2025-11-26 01:35:11'),
(116,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:35:52',	'2025-11-26 01:35:52'),
(117,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:35:52',	'2025-11-26 01:35:52'),
(118,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:36:18',	'2025-11-26 01:36:18'),
(119,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:36:18',	'2025-11-26 01:36:18'),
(120,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:44:43',	'2025-11-26 01:44:43'),
(121,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:44:43',	'2025-11-26 01:44:43'),
(122,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:46:25',	'2025-11-26 01:46:25'),
(123,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:46:25',	'2025-11-26 01:46:25'),
(124,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:47:54',	'2025-11-26 01:47:54'),
(125,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:47:54',	'2025-11-26 01:47:54'),
(126,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:48:17',	'2025-11-26 01:48:17'),
(127,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:48:17',	'2025-11-26 01:48:17'),
(128,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:48:21',	'2025-11-26 01:48:21'),
(129,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:48:21',	'2025-11-26 01:48:21'),
(130,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:49:31',	'2025-11-26 01:49:31'),
(131,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:49:31',	'2025-11-26 01:49:31'),
(132,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:51:03',	'2025-11-26 01:51:03'),
(133,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:51:03',	'2025-11-26 01:51:03'),
(134,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:52:37',	'2025-11-26 01:52:37'),
(135,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:52:37',	'2025-11-26 01:52:37'),
(136,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:53:20',	'2025-11-26 01:53:20'),
(137,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:53:20',	'2025-11-26 01:53:20'),
(138,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:53:30',	'2025-11-26 01:53:30'),
(139,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:53:30',	'2025-11-26 01:53:30'),
(140,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:53:51',	'2025-11-26 01:53:51'),
(141,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:53:51',	'2025-11-26 01:53:51'),
(142,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:58:52',	'2025-11-26 01:58:52'),
(143,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:58:52',	'2025-11-26 01:58:52'),
(144,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:59:01',	'2025-11-26 01:59:01'),
(145,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 01:59:01',	'2025-11-26 01:59:01'),
(146,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 03:51:49',	'2025-11-26 03:51:49'),
(147,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 03:51:49',	'2025-11-26 03:51:49'),
(148,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:08:15',	'2025-11-26 04:08:15'),
(149,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:10:45',	'2025-11-26 04:10:45'),
(150,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:11:16',	'2025-11-26 04:11:16'),
(151,	4,	1,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:11:16',	'2025-11-26 04:11:16'),
(152,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:11:26',	'2025-11-26 04:11:26'),
(153,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:27:46',	'2025-11-26 04:27:46'),
(154,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:27:46',	'2025-11-26 04:27:46'),
(155,	4,	1,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:27:46',	'2025-11-26 04:27:46'),
(156,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:30:43',	'2025-11-26 04:30:43'),
(157,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:30:43',	'2025-11-26 04:30:43'),
(158,	4,	1,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 04:30:43',	'2025-11-26 04:30:43'),
(159,	4,	4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 05:15:45',	'2025-11-26 05:15:45'),
(160,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 05:15:45',	'2025-11-26 05:15:45'),
(161,	4,	1,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 05:15:45',	'2025-11-26 05:15:45'),
(162,	4,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 05:15:55',	'2025-11-26 05:15:55'),
(163,	4,	5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 05:15:55',	'2025-11-26 05:15:55'),
(164,	4,	1,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'2025-11-26 05:15:55',	'2025-11-26 05:15:55');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2025_11_24_072635_create_permission_tables',	1),
(6,	'2025_11_24_073349_create_offers_table',	1),
(7,	'2025_11_24_073557_create_subscriptions_table',	1),
(8,	'2025_11_24_073625_create_clicks_table',	1),
(9,	'2025_11_24_073640_create_statistics_table',	1),
(10,	'2025_11_24_104134_add_role_to_users_table',	1),
(11,	'2025_11_24_140131_add_markup_to_subscriptions_table',	2),
(12,	'2025_11_25_052848_add_soft_deletes_to_offers_table',	3),
(13,	'2025_11_25_111334_create_link_logs_table',	4),
(14,	'2025_11_25_111549_create_redirect_failures_table',	4),
(15,	'2025_11_26_110501_add_is_active_to_users_table',	5);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1,	'App\\Models\\User',	2),
(2,	'App\\Models\\User',	1),
(2,	'App\\Models\\User',	3),
(2,	'App\\Models\\User',	5),
(2,	'App\\Models\\User',	7),
(2,	'App\\Models\\User',	8),
(2,	'App\\Models\\User',	11),
(2,	'App\\Models\\User',	13),
(3,	'App\\Models\\User',	4),
(3,	'App\\Models\\User',	6),
(3,	'App\\Models\\User',	9),
(3,	'App\\Models\\User',	10),
(3,	'App\\Models\\User',	12),
(3,	'App\\Models\\User',	14);

DROP TABLE IF EXISTS `offers`;
CREATE TABLE `offers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_per_click` decimal(8,2) NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `advertiser_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offers_advertiser_id_foreign` (`advertiser_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `offers` (`id`, `name`, `target_url`, `cost_per_click`, `category`, `status`, `is_active`, `advertiser_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'comments',	'https://www.google.com/',	12.00,	'Продвижение сайта',	'active',	1,	1,	'2025-11-25 06:29:03',	'2025-11-25 21:59:35',	NULL),
(2,	'Wha-my',	'http://cat-rocket.ru/',	1.00,	'Животные',	'inactive',	0,	1,	'2025-11-25 06:34:04',	'2025-11-25 15:03:37',	NULL),
(5,	'Пройти',	'https://www.google.com/',	40.00,	'Продвижение сайта',	'active',	1,	1,	'2025-11-25 21:21:12',	'2025-11-25 21:42:35',	'2025-11-25 21:42:35'),
(3,	'test',	'https://www.google.com/',	20.00,	'Шут',	'active',	1,	1,	'2025-11-25 13:52:39',	'2025-11-25 21:20:35',	NULL),
(4,	'comments',	'http://127.0.0.1:8000/offers',	7.00,	'Шут',	'active',	1,	1,	'2025-11-25 13:53:08',	'2025-11-26 04:31:51',	NULL);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `redirect_failures`;
CREATE TABLE `redirect_failures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `webmaster_id` bigint unsigned DEFAULT NULL,
  `offer_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `redirect_failures_webmaster_id_foreign` (`webmaster_id`),
  KEY `redirect_failures_offer_id_foreign` (`offer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `redirect_failures` (`id`, `webmaster_id`, `offer_id`, `ip_address`, `user_agent`, `reason`, `created_at`, `updated_at`) VALUES
(1,	1,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'not subscribed',	'2025-11-26 00:44:31',	'2025-11-26 00:44:31'),
(2,	3,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'not subscribed',	'2025-11-26 00:44:36',	'2025-11-26 00:44:36'),
(3,	10,	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',	'not subscribed',	'2025-11-26 00:44:40',	'2025-11-26 00:44:40');

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'web',	'2025-11-25 06:09:56',	'2025-11-25 06:09:56'),
(2,	'advertiser',	'web',	'2025-11-25 06:09:56',	'2025-11-25 06:09:56'),
(3,	'webmaster',	'web',	'2025-11-25 06:09:56',	'2025-11-25 06:09:56');

DROP TABLE IF EXISTS `statistics`;
CREATE TABLE `statistics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `offer_id` bigint unsigned DEFAULT NULL,
  `webmaster_id` bigint unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `clicks_count` int unsigned NOT NULL DEFAULT '0',
  `revenue` decimal(10,2) NOT NULL DEFAULT '0.00',
  `system_revenue` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `statistics_offer_id_webmaster_id_date_unique` (`offer_id`,`webmaster_id`,`date`),
  KEY `statistics_webmaster_id_foreign` (`webmaster_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `statistics` (`id`, `offer_id`, `webmaster_id`, `date`, `clicks_count`, `revenue`, `system_revenue`, `created_at`, `updated_at`) VALUES
(1,	3,	4,	'2025-11-26',	3,	48.00,	12.00,	'2025-11-25 19:42:00',	'2025-11-25 19:42:09'),
(2,	4,	4,	'2025-11-26',	3,	2.70,	0.66,	'2025-11-25 19:42:46',	'2025-11-25 19:42:51'),
(3,	5,	4,	'2025-11-26',	3,	96.00,	24.00,	'2025-11-25 21:41:29',	'2025-11-25 21:41:35');

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `webmaster_id` bigint unsigned NOT NULL,
  `offer_id` bigint unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `markup` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_webmaster_id_foreign` (`webmaster_id`),
  KEY `subscriptions_offer_id_foreign` (`offer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `subscriptions` (`id`, `webmaster_id`, `offer_id`, `is_active`, `markup`, `created_at`, `updated_at`) VALUES
(132,	4,	4,	0,	0.01,	'2025-11-25 19:58:17',	'2025-11-26 05:15:51'),
(131,	4,	3,	1,	1.00,	'2025-11-25 19:58:14',	'2025-11-26 05:15:55'),
(133,	4,	5,	1,	5.00,	'2025-11-25 21:41:17',	'2025-11-25 21:41:17'),
(134,	4,	1,	1,	0.00,	'2025-11-26 04:06:28',	'2025-11-26 04:11:30');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'webmaster',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `account_is_active` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `status`, `account_is_active`) VALUES
(1,	'advertiser_2',	'advertiser_2@bk.ru',	NULL,	'$2y$12$ao2vO1QmejCKwCJqWGBwR./kvMJmjin4qXdrt8dCYbrEJ6IDclWYi',	NULL,	'2025-11-25 06:12:04',	'2025-11-25 06:27:58',	'advertiser',	'approved',	1),
(2,	'admin',	'admin@bk.ru',	NULL,	'$2y$12$pdQG8KxpUQT2i1/cvablV.teN0vcvWCdYj0X/NVX3w6poqLBsVRQe',	NULL,	'2025-11-25 06:12:41',	'2025-11-25 06:27:04',	'admin',	'approved',	1),
(3,	'webmaster_1',	'webmaster_1@bk.ru',	NULL,	'$2y$12$ehdXYlHT.C55fB/RFKZkAuBiN8XG7lAfQD4wJ3DJ0IzFkRQ85rDL6',	NULL,	'2025-11-25 13:53:54',	'2025-11-25 13:55:10',	'advertiser',	'rejected',	1),
(4,	'webmaster_2',	'webmaster_2@bk.ru',	NULL,	'$2y$12$vl63L..t6j2HytAxzH6iweh2PH.FwRCCrr9wzcbKDBigJyM1su7Kq',	NULL,	'2025-11-25 13:54:46',	'2025-11-26 04:31:51',	'webmaster',	'approved',	1),
(5,	'1',	'hhh@vb.com',	NULL,	'$2y$12$ZKa.1WiW00Fxn2OZtRM2..oKknMsdtTs/iV2ic5cj1sncAHCxrtU.',	NULL,	'2025-11-26 01:37:12',	'2025-11-26 05:11:40',	'advertiser',	'approved',	0),
(6,	'2',	'hhh@vb.com1',	NULL,	'$2y$12$TzNHahgMr6PDXpUFsfVMxusylpPmfubB1URvKnV7DXEN6tmiOEXe.',	NULL,	'2025-11-26 01:38:54',	'2025-11-26 01:38:54',	'webmaster',	'approved',	0),
(7,	'Проверки',	'hhh123@vb.com',	NULL,	'$2y$12$KAXtoqNTBKUxg6LuWzSLB.F0bdNy3U7KAcQ5.Cln5hoGa5PRs5nY2',	NULL,	'2025-11-26 02:28:53',	'2025-11-26 08:19:21',	'advertiser',	'approved',	1),
(8,	'Wha-my',	'hhh12@vb.com',	NULL,	'$2y$12$xpih7ese83RyK02C0eIOROxTopdRYtKkqqCw2vhndKG1lN27cKepq',	NULL,	'2025-11-26 07:39:40',	'2025-11-26 08:19:21',	'advertiser',	'approved',	1),
(9,	'Тест входа',	'vxod@bk.ru',	NULL,	'$2y$12$aUaVfdO8x9J6HNAfnpLDEudUKCUmYrdqRXOM4mQgWN7RKFAsC0UMS',	NULL,	'2025-11-26 08:17:50',	'2025-11-26 08:20:25',	'webmaster',	'approved',	1),
(10,	'comments',	'hhh111111@vb.com',	NULL,	'$2y$12$TpIvURVE6rbilVVqBt8eS.cpgp2AQNfyiKom3.kmq0QCgJQx60aBm',	NULL,	'2025-11-26 09:03:33',	'2025-11-26 09:03:33',	'webmaster',	'pending',	0),
(11,	'comments11111111',	'3zop@bk.ru',	NULL,	'$2y$12$I4.OI2T9CpsEBELeUjUEcO1B2iIxnAA.a22TfOcLgu8ZoB.qGpBZu',	NULL,	'2025-11-26 09:10:58',	'2025-11-26 09:11:39',	'advertiser',	'approved',	1),
(12,	'users',	'agent@f.com',	NULL,	'$2y$12$UUT1D7XdLxLHb0fa77toE.KzXIrWjnfm2.bpRDumStZg5f9wB3e2G',	NULL,	'2025-11-26 09:14:08',	'2025-11-26 09:14:08',	'webmaster',	'pending',	0),
(13,	'1',	'1@bk.ru',	NULL,	'$2y$12$.6DfhVPUfF.LqTfhtH2vkulMIdVtx2QjZdxyYtwmW.br6R1KYKxku',	NULL,	'2025-11-26 09:14:40',	'2025-11-26 09:14:40',	'advertiser',	'approved',	0),
(14,	'images',	'hghg@bl.ru',	NULL,	'$2y$12$HS7wIoUtY5RoMeXsEEefFOxp9J5Fh2frUAGI/K3paZwR4a1s9jCcq',	NULL,	'2025-11-26 09:16:38',	'2025-11-26 09:16:38',	'webmaster',	'approved',	0);

-- 2025-11-26 19:23:25
