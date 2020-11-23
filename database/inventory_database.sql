-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2020 at 12:58 PM
-- Server version: 5.7.28
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ellipse_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Shah', 1, 1, '2020-10-18 10:51:22', '2020-10-18 10:51:22'),
(2, 'Holcim', 1, 1, '2020-10-18 10:51:31', '2020-10-18 10:51:31'),
(3, 'Bashundhara', 2, 1, '2020-10-18 10:55:21', '2020-10-18 10:55:21'),
(4, 'Aman', 2, 1, '2020-10-18 10:55:39', '2020-10-18 10:55:39'),
(5, 'Unique', 2, 1, '2020-10-18 10:55:57', '2020-10-18 10:55:57'),
(6, 'Confidence', 3, 1, '2020-10-18 10:56:19', '2020-10-18 10:56:19'),
(7, 'Royal', 3, 1, '2020-10-18 10:56:32', '2020-10-18 10:56:32'),
(8, 'Anwar', 3, 1, '2020-10-18 10:56:44', '2020-10-18 10:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Ordinary Portland Cement', 1, '2020-10-18 10:46:19', '2020-10-18 10:46:19'),
(2, 'Portland Pozzolana Cement', 1, '2020-10-18 10:46:36', '2020-10-18 10:46:36'),
(3, 'Rapid Hardening Cement', 1, '2020-10-18 10:46:46', '2020-10-18 10:46:46'),
(4, 'Low Heat Cement', 1, '2020-10-18 10:46:58', '2020-10-18 10:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nid_number` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(128) NOT NULL,
  `photo` text NOT NULL,
  `access_level` enum('Supplier','Account') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `nid_number`, `address`, `city`, `photo`, `access_level`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 7, '3412345335', 'Kazipara, Mirpur', 'Dhaka', '1_201018141509023.JPG', 'Supplier', 1, '2020-10-19 14:22:20', '2020-10-19 08:22:20'),
(2, 8, '343243514345', 'Barisal, Road', 'Barisal', '1_201018150624537.JPG', 'Account', 1, '2020-10-18 15:06:42', '2020-10-18 09:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_29_050709_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ref_number` varchar(180) NOT NULL,
  `total_amount` float NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ref_number`, `total_amount`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '20201021171257', 10000, 1, 1, '2020-10-27 13:02:47', '2020-10-27 07:02:47'),
(2, '20201021171346', 10000, 0, 1, '2020-10-21 11:13:46', '2020-10-21 11:13:46'),
(11, '20201027122323', 250, 0, 1, '2020-10-27 06:23:23', '2020-10-27 06:23:23'),
(12, '20201027123203', 250, 0, 1, '2020-10-27 06:32:03', '2020-10-27 06:32:03'),
(13, '20201027123231', 250, 0, 1, '2020-10-27 06:32:31', '2020-10-27 06:32:31'),
(14, '20201027143147', 37500, 0, 10, '2020-10-27 08:31:47', '2020-10-27 08:31:47'),
(15, '20201029144949', 35000, 1, 10, '2020-10-29 14:52:34', '2020-10-29 08:52:34'),
(16, '20201029145017', 50000, 1, 10, '2020-10-29 14:52:42', '2020-10-29 08:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(80) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 40, '2020-10-21 11:12:57', '2020-10-21 11:12:57'),
(2, 2, 1, 40, '2020-10-21 11:13:46', '2020-10-21 11:13:46'),
(4, 11, 1, 1, '2020-10-27 06:23:23', '2020-10-27 06:23:23'),
(5, 12, 1, 1, '2020-10-27 06:32:03', '2020-10-27 06:32:03'),
(6, 13, 1, 1, '2020-10-27 06:32:31', '2020-10-27 06:32:31'),
(7, 14, 1, 150, '2020-10-27 08:31:47', '2020-10-27 08:31:47'),
(8, 15, 1, 140, '2020-10-29 08:49:50', '2020-10-29 08:49:50'),
(9, 16, 1, 200, '2020-10-29 08:50:17', '2020-10-29 08:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `code` varchar(120) NOT NULL,
  `garage` varchar(200) NOT NULL,
  `route` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `buying_price` int(120) NOT NULL,
  `unit` varchar(180) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `brand_id`, `employee_id`, `code`, `garage`, `route`, `image`, `buying_price`, `unit`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Durable Concrete', 1, 2, 1, 'C-0231', 'Mirpur', 'Kazipara road', '1_201021155413964.jpg', 250, 'Sack', 1, '2020-10-21 16:25:19', '2020-10-21 10:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `site_managers`
--

CREATE TABLE `site_managers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nid_number` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(128) NOT NULL,
  `photo` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_managers`
--

INSERT INTO `site_managers` (`id`, `user_id`, `nid_number`, `address`, `city`, `photo`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 10, '342354353455', 'Mirpur', 'Dhaka', '1_201019132909327.JPG', 1, '2020-10-19 14:19:42', '2020-10-19 08:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `reserve_number` int(120) NOT NULL,
  `amount` int(150) NOT NULL,
  `previous_stock` int(130) NOT NULL,
  `restock` int(180) NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `reserve_number`, `amount`, `previous_stock`, `restock`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 660, 165000, 30, 200, 1, 0, '2020-10-23 05:53:12', '2020-10-22 23:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `stock_records`
--

CREATE TABLE `stock_records` (
  `id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `current_amount` int(180) NOT NULL,
  `current_quantity` int(120) NOT NULL,
  `withdraw_amount` int(180) NOT NULL,
  `withdraw_quantity` int(120) NOT NULL,
  `restock_quantity` int(120) NOT NULL,
  `status` varchar(180) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_records`
--

INSERT INTO `stock_records` (`id`, `stock_id`, `current_amount`, `current_quantity`, `withdraw_amount`, `withdraw_quantity`, `restock_quantity`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 10000, 40, 0, 0, 0, 'created', 1, '2020-10-21 10:40:44', '2020-10-21 10:40:44'),
(2, 1, 122500, 490, 0, 0, 0, 'edited', 1, '2020-10-21 10:55:56', '2020-10-21 10:55:56'),
(3, 1, 115000, 460, 7500, 30, 0, 'withdraw', 1, '2020-10-21 10:56:11', '2020-10-21 10:56:11'),
(4, 1, 165000, 660, 7500, 30, 200, 'restock', 1, '2020-10-21 10:56:27', '2020-10-21 10:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `access_level` enum('master_admin','site_manager','employee') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile_no`, `gender`, `access_level`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Safwan', 'test@gmail.com', '01703980563', 0, 'master_admin', NULL, '$2y$10$C3F0gsaeFMv3AgVeG6ASoujvxLCVzJDvb4r0lTFCAvvTx.qHz7MTC', NULL, '2020-10-17 21:40:39', '2020-10-17 21:40:39'),
(7, 'Rumi Rashid', 'Rumi@gmail.com', '01943837962', 0, 'employee', NULL, '$2y$10$lh/ccp0qAoJ6iBxzZiziHumt20wnYX0pSZV0KWtLpUEMQz2cthJye', NULL, '2020-10-18 08:15:08', '2020-10-18 08:15:08'),
(8, 'Simsabil Binte Ahmed Peu', 'Simsabil@gmail.com', '01743837962', 1, 'employee', NULL, '$2y$10$O03BEjIpvvbHTuBkGZ8EFeQpArah8mOyWGJaYRdGgmyNpoGHXN9CW', NULL, '2020-10-18 08:41:52', '2020-10-18 08:41:52'),
(10, 'Adeeb Imtiaz', 'Adeeb@gmail.com', '01343837962', 0, 'site_manager', NULL, '$2y$10$hWRE5qKi.9ymbQueJym5yOs1c8FgOCJ.3idwIcspVRY8kRyoL0UZa', NULL, '2020-10-19 07:29:09', '2020-10-19 07:29:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_managers`
--
ALTER TABLE `site_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_records`
--
ALTER TABLE `stock_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_managers`
--
ALTER TABLE `site_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_records`
--
ALTER TABLE `stock_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
