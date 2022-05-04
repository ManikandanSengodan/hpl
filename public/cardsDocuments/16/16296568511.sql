-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 06:25 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yenjoyin_carddesign`
--

-- --------------------------------------------------------

--
-- Table structure for table `design_cards`
--

CREATE TABLE `design_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `front_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `all_view_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `design_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salesrep_id` bigint(20) UNSIGNED DEFAULT NULL,
  `weaver` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warps_id` bigint(20) UNSIGNED DEFAULT NULL,
  `finishing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_label` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tab_label` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_label` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_on_main_cost` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_on_tab_cost` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_on_size_cost` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `needle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speed_effiency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chart` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `design_cards`
--

INSERT INTO `design_cards` (`id`, `customer_id`, `label`, `date`, `front_image`, `back_image`, `all_view_image`, `design_file`, `designer_id`, `salesrep_id`, `weaver`, `warps_id`, `finishing`, `description`, `main_label`, `tab_label`, `size_label`, `add_on_main_cost`, `add_on_tab_cost`, `add_on_size_cost`, `needle`, `speed_effiency`, `customer_grade`, `category`, `chart`, `created_at`, `updated_at`) VALUES
(1, 2, 'adf', '2021-08-11', NULL, NULL, NULL, NULL, 1, 4, '[\"50\",\"60\",\"70\"]', 1, 'ad', 'ad', '[\"50\",\"60\",\"70\",\"80\",\"90\",\"100\",\"110\",\"120\",\"130\",\"140\"]', '[\"50\",\"60\",\"70\",\"80\",\"90\",\"100\",\"110\",\"120\",\"130\",\"140\"]', '[\"50\",\"60\",\"70\",\"80\",\"90\",\"100\",\"110\",\"120\",\"130\",\"140\"]', '[\"20\",\"60\",\"80\",\"90\",\"11\",\"50\",\"556\",\"555\"]', '[\"47\",\"55\",\"78\",\"98\",\"45\",\"85\",\"44\",\"55\"]', '[\"10\",\"22\",\"555\",\"88\",\"99\",\"99\",\"99\",\"100\"]', '{\"0\":{\"needle_no_pantone\":\"13\",\"column\":\"column2\",\"color\":\"#c11f1f\",\"color_shade\":\"#14b81a\",\"denier\":\"blcak\",\"a\":\"a1\",\"b\":\"b1\",\"c\":\"c2\",\"d\":\"d2\",\"e\":\"e2\"},\"2\":{\"needle_no_pantone\":\"asdf\",\"column\":\"adf\",\"color\":\"#000000\",\"color_shade\":\"#000000\",\"denier\":\"adf\",\"a\":\"adsf\",\"b\":\"asdf\",\"c\":\"asdf\",\"d\":\"adf\",\"e\":\"adf\"}}', NULL, NULL, NULL, NULL, '2021-08-17 14:47:36', '2021-08-17 16:46:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `design_cards`
--
ALTER TABLE `design_cards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `design_cards`
--
ALTER TABLE `design_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
