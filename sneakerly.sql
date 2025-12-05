/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - sneakerly
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sneakerly` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `sneakerly`;

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `cache` */

insert  into `cache`(`key`,`value`,`expiration`) values 
('123456789user1@gmail.com|127.0.0.1','i:1;',1757486954),
('123456789user1@gmail.com|127.0.0.1:timer','i:1757486954;',1757486954),
('admin1@gmail.com|127.0.0.1','i:1;',1753242524),
('admin1@gmail.com|127.0.0.1:timer','i:1753242524;',1753242524),
('user1@gmail.com|127.0.0.1','i:1;',1757486946),
('user1@gmail.com|127.0.0.1:timer','i:1757486946;',1757486946);

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `barang_id` int DEFAULT NULL,
  `nama_barang` varchar(765) DEFAULT NULL,
  `photo` varchar(765) DEFAULT NULL,
  `harga` decimal(11,0) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis_barang` varchar(765) DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `barang_id` (`barang_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `t_barang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `cart` */

/*Table structure for table `carts` */

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `barang_id` bigint unsigned NOT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `jenis_barang` varchar(255) DEFAULT NULL,
  `harga` decimal(11,0) DEFAULT NULL,
  `nama_barang` varchar(765) DEFAULT NULL,
  `quantity` int NOT NULL,
  `photo` varchar(765) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `carts` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(4,'2025_07_16_035629_create_sneakerly',1),
(5,'2025_07_16_040032_sneakerly',1),
(6,'2025_07_16_043535_add_role_to_users_table',2),
(11,'0001_01_01_000000_create_users_table',3),
(12,'0001_01_01_000001_create_cache_table',3),
(13,'0001_01_01_000002_create_jobs_table',3),
(14,'2025_07_16_035920_sneakerly',3),
(15,'2025_07_16_040624_add_role_to_users_table',3),
(16,'2025_07_22_065552_add_google_id_to_users_table',3),
(17,'2025_07_22_070249_add_avatar_to_users_table',3),
(18,'2025_07_22_144107_add_photo_to_users_table',4),
(19,'2025_07_22_144619_add_phone_and_address_to_users_table',5),
(20,'2025_07_31_024554_create_xendit_transactions_table',6),
(21,'2025_08_04_025530_create_carts_table',7),
(23,'2025_10_15_030920_add_customer_fields_to_orders_table',8);

/*Table structure for table `order_items` */

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `order_items` */

insert  into `order_items`(`id`,`order_id`,`produk_id`,`nama_produk`,`harga`,`jumlah`,`subtotal`,`photo`,`created_at`,`updated_at`) values 
(43,44,169,'Air Jordan 1 Mid SE',2000000.00,1,2000000.00,'images/phfxAe6qKutqh3taybMXEFXUg3sFwLBBW4KJ7Cwc.avif','2025-11-14 04:25:18','2025-11-14 04:25:18'),
(44,45,171,'Air Jordan 1 Mid SE',2000000.00,1,2000000.00,'images/phfxAe6qKutqh3taybMXEFXUg3sFwLBBW4KJ7Cwc.avif','2025-11-18 04:00:20','2025-11-18 04:00:20');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `total` int DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`user_id`,`order_id`,`total`,`status`,`payment_method`,`catatan`,`created_at`,`updated_at`,`name`,`phone`,`email`,`address`,`city`,`province`,`postal_code`,`country`) values 
(44,4,NULL,2000000,'pending',NULL,NULL,'2025-11-14 04:25:18','2025-11-14 04:25:18','adi nugroho','01111111111','user@gmail.com','gg.sukaresmi','Kota Bandung','Jawa Barat','78291','Indonesia'),
(45,12,NULL,2000000,'pending',NULL,NULL,'2025-11-18 04:00:20','2025-11-18 04:00:20','user2','05495','user@gmail.com','shdbjasbd','bandung','90583054','0954','indonesia');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `reviews` */

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `barang_id` bigint unsigned NOT NULL,
  `rating` tinyint NOT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `reviews` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('0QxMXENvrVik1LIazvQhvBPOQZZ1IZl7phLXh3bE',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTdvR2dmYTJ1aTZ0cGVDbGlmekJWSjFaTmQ3Qmt4bjZJcXRvb2VIcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1763597958),
('79hPzqGRMONP2uu3zDCYMhvjYPcV3x92TBYbmAf5',13,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMUx5cGlCaHJicVpDN0RkRmNNM0VWVUxnTk9XNFgzUnF2Q1QzeGUwYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTM7fQ==',1763694176),
('RYIh35D4vDAYFst6K2xtkRatjI82tx04qsWWUmjY',12,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW95VkJaMmRPNjk0dU1HNmwzUWE0dldNcmQ1NzdQU0J0M3VJZURFWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXRhaWwvNSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEyO30=',1763438544),
('xt9xQjQqNKiqRtVQansEeZHLJHsUYfttCiuMvkm3',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoieHF0MlJQdVYzMXRkMVRGUW5JaExyc20zVWI4UE5RaUJJb0ZxOERGWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qZW5pcyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==',1763438539);

/*Table structure for table `shipping_addresses` */

DROP TABLE IF EXISTS `shipping_addresses`;

CREATE TABLE `shipping_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kode_pos` varchar(255) NOT NULL,
  `negara` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `alamat_sama` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `shipping_addresses` */

/*Table structure for table `sneakerly` */

DROP TABLE IF EXISTS `sneakerly`;

CREATE TABLE `sneakerly` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `sneakerly` */

/*Table structure for table `t_alamat_user` */

DROP TABLE IF EXISTS `t_alamat_user`;

CREATE TABLE `t_alamat_user` (
  `id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `telepon` varchar(300) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(300) DEFAULT NULL,
  `kode_pos` varchar(30) DEFAULT NULL,
  `negara` varchar(300) DEFAULT NULL,
  `provinsi` varchar(300) DEFAULT NULL,
  `utama` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_alamat_user` */

insert  into `t_alamat_user`(`id`,`user_id`,`name`,`telepon`,`alamat`,`kota`,`kode_pos`,`negara`,`provinsi`,`utama`,`created_at`,`updated_at`,`email`) values 
(NULL,4,'adi nugroho','01111111111','gg.sukaresmi','Kota Bandung','78291','Indonesia','Jawa Barat',1,'2025-10-20 04:09:22','2025-10-20 04:09:22','user@gmail.com');

/*Table structure for table `t_barang` */

DROP TABLE IF EXISTS `t_barang`;

CREATE TABLE `t_barang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `jenis_barang` varchar(255) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `photo` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ukuran` json DEFAULT NULL,
  `warna` varchar(255) DEFAULT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `negara` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_barang` */

insert  into `t_barang`(`id`,`nama_barang`,`harga`,`jenis_barang`,`stok`,`photo`,`created_at`,`updated_at`,`description`,`ukuran`,`warna`,`model`,`negara`) values 
(5,'Air Jordan 1 Mid SE',2000000.00,'Sneakers',5,'[\"images\\/phfxAe6qKutqh3taybMXEFXUg3sFwLBBW4KJ7Cwc.avif\",\"images\\/61r0t0rWwN3pvTMKwUU6QCtwyzsvwwgUm5eZ4p55.avif\",\"images\\/Xivvu6fK2IhTVbYmdjpMfXap5aXgmeUIw9Bm14Fq.avif\",\"images\\/bSLjSYxVAnXsUVPqLXt0kL524WfASF10bvVnglvc.avif\",\"images\\/RoHsXBDoqmlYrhqMdv0SepUgYGx21s88bxCrUq4n.avif\",\"images\\/hEyrpKpwkfBPnLHIzWskecD4kQu2mzen3Ba5yNYN.avif\",\"images\\/WDRfdjMehiiE6jSlDQ2tMLescgfC3GxuT4tzjdCn.avif\"]','2025-07-28 04:06:18','2025-07-28 06:51:19','Air Jordan 1 Mid SE adalah versi mid-cut dengan detail dan bahan premium. Menawarkan tampilan klasik dengan sentuhan modern, cocok untuk gaya kasual yang standout','[{\"stok\": \"15\", \"ukuran\": \"38\"}, {\"stok\": \"20\", \"ukuran\": \"39\"}, {\"stok\": \"15\", \"ukuran\": \"40\"}, {\"stok\": \"7\", \"ukuran\": \"41\"}]','Cobalt Bliss/White/Pink Glow','HQ1999-400','Indonesia'),
(6,'Air Jordan 3 Retro \'Starfish\'',3169000.00,'Sneakers',3,'[\"images\\/WO80OTBbmsPQfAcBaMkHjYFGbfDmJIvbfPvSkqAe.avif\",\"images\\/nVUXEVQF2fGAF5Y5RSAbPFRKgvyugApgnhPrNZff.avif\",\"images\\/1vR0JAzlluADyAfvuUr99bYe97EVcbhSO9E1C4TM.avif\",\"images\\/RA93MXi8pgHVPYFcCBaQTidIp3O9mKSAiLKYZNfe.avif\"]','2025-07-24 06:53:26','2025-07-28 11:56:12','Air Jordan 3 Retro \'Starfish\' menampilkan kombinasi warna putih, oranye terang, dan abu-abu dengan aksen elephant print khas. Desainnya ikonik dan stylish, cocok untuk penggemar sneaker dengan gaya mencolok namun tetap klasik.','[{\"stok\": \"10\", \"ukuran\": \"38\"}, {\"stok\": \"27\", \"ukuran\": \"39\"}, {\"stok\": \"15\", \"ukuran\": \"40\"}, {\"stok\": \"15\", \"ukuran\": \"41\"}]','Fossil/Sail/Starfish','IH7694-200','Vietnam'),
(7,'Air Jordan 1 Mid SE',2129000.00,'Sneakers',16,'[\"images\\/VsCiCA4jbOGrdV8JqtDWXFuDCrKIcQFM8AqTorTY.avif\"]','2025-07-24 06:54:57','2025-07-28 07:44:06','Air Jordan 1 Mid SE hadir dengan siluet mid-cut dan warna atraktif. Menawarkan gaya klasik Jordan 1 dengan sentuhan modern, cocok untuk tampilan kasual maupun koleksi sneaker sehari-hari.','[]','White/Cave Stone/Dark Sulphur/Oil Grey','HQ2011-100','China'),
(8,'Air Jordan 1 Low',1909000.00,'Sneakers',10,'[\"images\\/45jJVixUgYKmBHP56OzmJwFrZUPb2HPyl9ndiFOB.avif\"]','2025-07-24 06:57:07','2025-07-28 07:44:28','Air Jordan 1 Low adalah versi low-cut dari AJ1 klasik, dengan desain simpel, logo Swoosh, dan kenyamanan ringan. Cocok untuk gaya kasual sehari-hari dengan sentuhan sporty ikonik.','[]','Sail/Off-Noir/Light Smoke Grey/Soft Pearl','IH7323-100','China'),
(9,'Jordan 1 Retro High OG',1169000.00,'Sneakers',3,'[\"images\\/StnMwCzl1Tlfys7S8APmR69w42FNP80YDTJy16OX.avif\"]','2025-07-24 06:48:53','2025-07-28 07:44:48','Jordan 1 Retro High OG adalah sepatu ikonik dengan desain high-cut klasik, logo Wings, dan branding Nike Air di lidah. Terbuat dari kulit premium, cocok untuk gaya kasual dan koleksi sneaker.','[]','Black/Sail/Starfish/Black','FD1412-008','Indonesia'),
(10,'Jordan Trunner LX',2099000.00,'Sneakers',7,'[\"images\\/GqJfP0mJ6iHJataa0d43ot9VZ0tkd2FvequloAUE.avif\"]','2025-07-24 06:59:05','2025-07-28 07:45:06','Jordan Trunner LX adalah sepatu training dengan desain slip-on dan strap elastis, memberikan kenyamanan, stabilitas, dan gaya sporty. Cocok untuk latihan ringan maupun aktivitas harian.','[]','Black/Coconut Milk/Orange Blaze/White','IM6531-001','Vietnam'),
(11,'Jordan CMFT Era',1909000.00,'Sneakers',15,'[\"images\\/59kooRiP8EhDYjb4OO4pQ7UrvvQftv7r8Yv9NlKB.avif\"]','2025-07-24 07:00:24','2025-07-28 07:45:24','Jordan CMFT Era menggabungkan gaya klasik Jordan dengan kenyamanan maksimal. Dilengkapi bantalan empuk dan desain kasual, cocok untuk dipakai sehari-hari dengan nuansa sporty.','[]','Cannon/Sail','HJ6778-002','Vietnam'),
(18,'Nike Blazer Mid \'77 Vintage',1000000.00,'Sneakers',NULL,'[\"images\\/ZdZUMwqy8FOqT5lerVaKZRSjCveEYuUHiWrRLzWP.jpg\",\"images\\/2BF4X5zqZDSzUlcbdG9XHN5XpwVBhU2MvKIpKV6L.jpg\"]','2025-11-18 03:59:02','2025-11-18 03:59:01','aaaaaaa','[{\"stok\": \"1\", \"ukuran\": \"10\"}, {\"stok\": \"2\", \"ukuran\": \"15\"}]','biru','BQ6806-100','Indonesia');

/*Table structure for table `t_jenis` */

DROP TABLE IF EXISTS `t_jenis`;

CREATE TABLE `t_jenis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_barang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_jenis` */

insert  into `t_jenis`(`id`,`jenis_barang`,`created_at`,`updated_at`) values 
(15,'Sneakers','2025-07-22 03:54:57','2025-07-22 03:54:57'),
(16,'Running Shoes','2025-07-22 03:55:17','2025-07-22 03:55:17'),
(17,'Slip On','2025-07-22 03:55:29','2025-07-22 03:55:29'),
(18,'Loafers','2025-07-22 03:55:41','2025-07-22 03:55:41'),
(19,'Boots','2025-07-22 03:56:00','2025-07-22 03:56:00'),
(20,'Stiletto','2025-07-22 03:56:18','2025-07-22 03:56:18'),
(21,'Wedges','2025-07-22 03:56:25','2025-07-22 03:56:25'),
(22,'Flat Shoes','2025-07-22 03:56:37','2025-07-22 03:56:37'),
(23,'Mary Janes','2025-07-22 03:56:46','2025-07-22 03:56:46'),
(24,'Ballerina Flats','2025-11-13 23:16:50','2025-11-13 23:16:50');

/*Table structure for table `t_pembayaran` */

DROP TABLE IF EXISTS `t_pembayaran`;

CREATE TABLE `t_pembayaran` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `total` int DEFAULT NULL,
  `status` enum('di bayar','belum di bayar','gagal','expired') DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `transaction_time` datetime DEFAULT NULL,
  `payment_code` varchar(100) DEFAULT NULL,
  `pdf_url` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_pembayaran` */

/*Table structure for table `t_pesanan` */

DROP TABLE IF EXISTS `t_pesanan`;

CREATE TABLE `t_pesanan` (
  `id_pesanan` int NOT NULL AUTO_INCREMENT,
  `barang_id` int DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `telepon` varchar(300) DEFAULT NULL,
  `kode_pos` int DEFAULT NULL,
  `kota` varchar(300) DEFAULT NULL,
  `alamat` text,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga` decimal(11,0) DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `status` enum('pending','success') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_barang` varchar(255) DEFAULT NULL,
  `photo` varchar(765) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_pesanan` */

/*Table structure for table `t_photo` */

DROP TABLE IF EXISTS `t_photo`;

CREATE TABLE `t_photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `barang_id` int DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_barang_id` (`barang_id`),
  CONSTRAINT `fk_barang_id` FOREIGN KEY (`barang_id`) REFERENCES `t_barang` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_photo` */

/*Table structure for table `t_ukuran` */

DROP TABLE IF EXISTS `t_ukuran`;

CREATE TABLE `t_ukuran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `barang_id` int NOT NULL,
  `ukuran` int NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_ukuran` */

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `total` int NOT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_code` varchar(255) DEFAULT NULL,
  `pdf_url` varchar(255) DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qris_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_order_id_unique` (`order_id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `transactions` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text,
  `photo` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`phone`,`address`,`photo`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`google_id`,`avatar`,`role`) values 
(1,'adi nugroho','AdiNugroho13@gmail.com','08513632039555','jakarta','1753931568_cheats downhill ps2.jpg',NULL,'$2y$12$VpwFW9xlO500E5Mi7vN/cOZVVgz2Eas5ctqV08O/2DxsfsxeQXz6C',NULL,'2025-07-22 07:35:33','2025-07-31 03:12:48','100231309155992278398','https://lh3.googleusercontent.com/a/ACg8ocImkjAR83ZuNy1dcY4qIyi40GbQsmgTE_4_ksrgfQvMGSv1uE0=s96-c','user'),
(2,'lia two','liatwo24@gmail.com',NULL,NULL,NULL,NULL,'$2y$12$7IsuORasVjQVMpuU5Le6z.4l6djCevUwCDZaanR2FJ78fg3uaeC7C',NULL,'2025-07-22 07:55:04','2025-07-22 07:55:28','111484743532289295260','https://lh3.googleusercontent.com/a/ACg8ocIfGjYo6s81g3vHAu-EwAqkMDoYOqJ_AsXTaVlZhYWlnM1XlSo=s96-c','user'),
(3,'admin','admin@gmail.com',NULL,NULL,NULL,NULL,'$2y$12$GGhy6DFjp0/8yereRStxA.Ghr7CfrkAjnveacNI2wDNBWjacO6z0C',NULL,'2025-07-23 03:52:22','2025-07-23 03:52:22',NULL,NULL,'admin'),
(4,'user','user@gmail.com',NULL,NULL,'1753949910_730x480-img-61794-game-ps2-bully.jpg',NULL,'$2y$12$f2gExaixoBMf4/buzVbchO/LKysD5Y.ERwAlgkCQm7Ub8cwvbx.Ny','MKfpJqxmbd7JOhU5LHrbnBapA8PvUi53XxHN1sYV7o0boGQ2ejJhl0g4AmpI','2025-07-23 07:48:37','2025-07-31 08:18:30',NULL,NULL,'user'),
(5,'adii','adiii@gmail.com',NULL,NULL,NULL,NULL,'$2y$12$Xn23eEzAHCcxVbsRYn1iFuxLPlQKwwPGIEX6vqVyJB.n8p89rGuPy',NULL,'2025-09-11 02:24:55','2025-09-11 02:24:55',NULL,NULL,'user'),
(6,'Jek','jeki@gmail.com',NULL,NULL,NULL,NULL,'$2y$12$wrzr0DDA4LMO./XvfUu0CuzHuL25.c5lKq5QMsVd3hylQ9oSYDNaa',NULL,'2025-09-11 02:39:35','2025-09-11 02:39:35',NULL,NULL,'user'),
(9,'adi nugroho','adinugroho12131415@gmail.com','01111111111','gg.sukaresmi','1761019691_Adi.jpg',NULL,'$2y$12$orvLjS8lrtde7pPZWG6liOA7lLoAZ3h.7p8lHjIjPe15Y5i/yMnKG',NULL,'2025-10-21 04:08:00','2025-11-18 01:21:36','115203757866342775547','https://lh3.googleusercontent.com/a/ACg8ocKqddQEoHOMYLjDXRK_cb6ogxY5MbJEmgEFa_ysBjEiTPkkhA=s96-c',NULL),
(10,'Adi Nugroho','adin47563@gmail.com',NULL,NULL,NULL,NULL,'$2y$12$3.oCiNWqaRmxLzskC4n3zOnSpbRtxIak2H3EY0G/ROMFdBMkfAJkS',NULL,'2025-11-13 23:15:35','2025-11-13 23:15:35',NULL,NULL,NULL),
(11,'user2','user2@gmail.com',NULL,NULL,NULL,NULL,'$2y$12$xmSzC8M2FnLDywDXlntzue4H4SxLSXpdN0OZtv.ZDlolRXAjHUW2m',NULL,'2025-11-18 03:54:32','2025-11-18 03:54:32',NULL,NULL,'user'),
(12,'user3','user3@gmail.com',NULL,NULL,NULL,NULL,'$2y$12$/m0OboPL8PNWaRu5hKVC2OJ3t25YNmyJe604PyZgJYS8jNwFgay/m',NULL,'2025-11-18 03:56:11','2025-11-18 03:56:11',NULL,NULL,'user'),
(13,'Adi Nugrohoo','adi1ii@gmail.com',NULL,NULL,NULL,NULL,'$2y$12$B0gVbK70el6X13xkHol/MuQehTm2yck.NNcFddvOHA3m3nhDeMcu6',NULL,'2025-11-21 03:02:55','2025-11-21 03:02:55',NULL,NULL,'user');

/*Table structure for table `xendit_transactions` */

DROP TABLE IF EXISTS `xendit_transactions`;

CREATE TABLE `xendit_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference_id` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'PENDING',
  `amount` int NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `checkout_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `xendit_transactions_reference_id_unique` (`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `xendit_transactions` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
