-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 22, 2023 at 05:55 AM
-- Server version: 10.11.4-MariaDB
-- PHP Version: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_review`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@gmail.com', NULL, '$2y$10$VmC0WF/2/8o/LSfeyY7m0uMZQpsZFOZvs/pPSfhJdYEcJ0fgupLBq', NULL, '2023-08-07 05:15:30', '2023-08-07 05:15:30'),
(2, 'Admin', 'admin@mailinator.com', NULL, '$2y$10$nmtLx7NBFc.eJl7drmImNe4RAQYgAvLe8.6nyBgfVglHni63Kjb/a', NULL, '2023-08-07 05:18:40', '2023-08-07 05:18:40'),
(3, 'New', 'new@gmail.com', NULL, '$2y$10$DEaQvNhQdcJWF.VfiA16we0CWMgaFm1ULfoh0fBp8lH2Prcfg.aVq', NULL, '2023-08-07 05:47:48', '2023-08-07 05:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `type_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `type`, `type_id`, `name`, `path`, `created_at`, `updated_at`) VALUES
(1, 'property_live_proof_doc', '8', 'fulbrix-chicago-il-building-photo.jpg', 'documents/properties/1694427380.fulbrix-chicago-il-building-photo.jpg', '2023-09-11 10:16:20', '2023-09-11 10:16:20'),
(2, 'property_live_proof_doc', '9', 'call-of-duty-mobile-2019-24.jpg', 'documents/properties/1694427391.call-of-duty-mobile-2019-24.jpg', '2023-09-11 10:16:31', '2023-09-11 10:16:31'),
(3, 'property_live_proof_doc', '12', 'fulbrix-chicago-il-building-photo (2).jpg', 'documents/properties/1694441187.fulbrix-chicago-il-building-photo (2).jpg', '2023-09-11 14:06:27', '2023-09-11 14:06:27'),
(4, 'property_live_proof_doc', '2', 'Test_po119hp.pdf', 'documents/properties/1694504263.Test_po119hp.pdf', '2023-09-12 07:37:43', '2023-09-12 07:37:43'),
(5, 'property_live_proof_doc', '7', 'Layer 20.png', 'documents/properties/1694585332.Layer 20.png', '2023-09-13 06:08:52', '2023-09-13 06:08:52'),
(6, 'property_live_proof_doc', '13', 'fulbrix-chicago-il-building-photo (3).jpg', 'documents/properties/1694590152.fulbrix-chicago-il-building-photo (3).jpg', '2023-09-13 07:29:12', '2023-09-13 07:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_properties`
--

CREATE TABLE `favorite_properties` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorite_properties`
--

INSERT INTO `favorite_properties` (`id`, `property_id`, `user_id`, `updated_at`, `created_at`) VALUES
(1, 1, 3, '2023-09-04 16:08:09', '2023-09-04 16:08:09'),
(2, 4, 1, '2023-09-05 09:46:07', '2023-09-05 09:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `type_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `type`, `type_id`, `name`, `path`, `created_at`, `updated_at`) VALUES
(2, 'property_image', '2', 'service-1.jpg', 'images/properties/1693906640.service-1.jpg', '2023-09-05 09:37:20', '2023-09-05 09:43:36'),
(3, 'property_image', '3', 'service-2.jpg', 'images/properties/1693907073.service-2.jpg', '2023-09-05 09:44:33', '2023-09-05 09:44:56'),
(4, 'property_image', '4', 'service-3.jpg', 'images/properties/1693907124.service-3.jpg', '2023-09-05 09:45:24', '2023-09-05 09:45:39'),
(5, 'property_image', '5', 'service-5.jpg', 'images/properties/1693907194.service-5.jpg', '2023-09-05 09:46:34', '2023-09-05 09:46:50'),
(6, 'property_image', '6', 'service-6.jpg', 'images/properties/1693907257.service-6.jpg', '2023-09-05 09:47:37', '2023-09-05 09:47:53'),
(9, 'property_image', '2', 'service-6.jpg', 'images/properties/1694151390.service-6.jpg', '2023-09-08 05:36:30', '2023-09-08 05:36:36'),
(10, 'property_image', '3', 'service-5.jpg', 'images/properties/1694151477.service-5.jpg', '2023-09-08 05:37:57', '2023-09-08 05:38:04'),
(11, 'property_image', NULL, 'istockphoto-621827654-612x612.jpg', 'images/properties/1694151532.istockphoto-621827654-612x612.jpg', '2023-09-08 05:38:52', '2023-09-08 05:38:52'),
(12, 'property_image', '5', 'service-4.jpg', 'images/properties/1694151611.service-4.jpg', '2023-09-08 05:40:11', '2023-09-08 05:40:14'),
(13, 'property_image', '6', 'service-1.jpg', 'images/properties/1694151637.service-1.jpg', '2023-09-08 05:40:37', '2023-09-08 05:40:41'),
(14, 'property_image', '4', 'service-2.jpg', 'images/properties/1694151678.service-2.jpg', '2023-09-08 05:41:18', '2023-09-08 05:41:22'),
(15, 'property_image', '8', 'fulbrix-chicago-il-building-photo (3).jpg', 'images/properties/1694589048.fulbrix-chicago-il-building-photo (3).jpg', '2023-09-13 07:10:48', '2023-09-13 07:10:48'),
(16, 'property_image', '8', 'fulbrix-chicago-il-building-photo (2).jpg', 'images/properties/1694589048.fulbrix-chicago-il-building-photo (2).jpg', '2023-09-13 07:10:48', '2023-09-13 07:10:48'),
(17, 'property_image', '8', 'fulbrix-chicago-il-building-photo (1).jpg', 'images/properties/1694589050.fulbrix-chicago-il-building-photo (1).jpg', '2023-09-13 07:10:50', '2023-09-13 07:10:50'),
(18, 'property_image', '8', 'fulbrix-chicago-il-building-photo.jpg', 'images/properties/1694589050.fulbrix-chicago-il-building-photo.jpg', '2023-09-13 07:10:50', '2023-09-13 07:10:50'),
(19, 'property_image', '13', 'fulbrix-chicago-il-building-photo.jpg', 'images/properties/1694590151.fulbrix-chicago-il-building-photo.jpg', '2023-09-13 07:29:11', '2023-09-13 07:29:11'),
(20, 'property_image', '13', 'fulbrix-chicago-il-building-photo (3).jpg', 'images/properties/1694590152.fulbrix-chicago-il-building-photo (3).jpg', '2023-09-13 07:29:12', '2023-09-13 07:29:12'),
(21, 'property_image', '13', 'fulbrix-chicago-il-building-photo (1).jpg', 'images/properties/1694590153.fulbrix-chicago-il-building-photo (1).jpg', '2023-09-13 07:29:13', '2023-09-13 07:29:13'),
(22, 'property_image', '7', 'pexels-vecislavas-popa-1571460.jpg', 'images/properties/1694839608.pexels-vecislavas-popa-1571460.jpg', '2023-09-16 04:46:48', '2023-09-16 04:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_08_07_102332_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(12) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `suburb` varchar(255) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rent_move_in` int(12) DEFAULT NULL,
  `rent_increase` enum('0','1') DEFAULT '1',
  `rent_increase_opinion` text DEFAULT NULL,
  `rent_increase_file` varchar(255) DEFAULT NULL,
  `property_condition` enum('0','1','2','3','4','5') DEFAULT NULL COMMENT '0:dangerous;1:heavydamage,2:uncomfortabledamage,3:faircondition,4:goodcondition,5:perfectcondition',
  `property_condition_opinion` text DEFAULT NULL,
  `property_file` varchar(255) DEFAULT NULL,
  `relation_landlord` enum('0','1','2','3','4','5') DEFAULT NULL COMMENT '0:unmanageable;1:unsatisfactory,2:passable,3:moderate;4:good;5:excellent',
  `relation_landlord_opinion` text DEFAULT NULL,
  `property_living_condition` enum('0','1','2','3','4','5') DEFAULT NULL COMMENT '''0'': Unmanageable\r\n''1'': Unsatisfactory\r\n''2'': Passable\r\n''3'': Moderate\r\n''4'': Good\r\n''5'': Excellent',
  `property_living_condition_opinion` text DEFAULT NULL,
  `relation_landlord_file` varchar(255) DEFAULT NULL,
  `legal_issue_property` enum('0','1') DEFAULT '1',
  `legal_issue_property_opinion` text DEFAULT NULL,
  `legal_issue_landlord` enum('0','1') DEFAULT '1',
  `legal_issue_landlord_opinion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('0','1','2') DEFAULT '0' COMMENT '0:Pending;1:Approved;2:Rejected',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `slug`, `user_id`, `name`, `address`, `suburb`, `latitude`, `longitude`, `image`, `rent_move_in`, `rent_increase`, `rent_increase_opinion`, `rent_increase_file`, `property_condition`, `property_condition_opinion`, `property_file`, `relation_landlord`, `relation_landlord_opinion`, `property_living_condition`, `property_living_condition_opinion`, `relation_landlord_file`, `legal_issue_property`, `legal_issue_property_opinion`, `legal_issue_landlord`, `legal_issue_landlord_opinion`, `created_at`, `status`, `updated_at`) VALUES
(2, '26c244b2-a891-4128-b2a9-ebcccd7751ff', 1, 'Real Estate Property', 'Sydney NSW 2000 Australia', 'sydney', -33.8567844, 151.2152967, NULL, 15000, '1', NULL, NULL, '4', NULL, NULL, '4', NULL, '1', NULL, NULL, '1', NULL, '1', NULL, '2023-09-05 09:43:36', '0', '2023-09-13 07:20:28'),
(3, '6125c191-351d-48e3-928a-ce997d1a9526', 1, 'New Estate Property', 'WA  Australia', 'sydney', -31.952312469482422, 115.8613052368164, NULL, 30000, '0', NULL, NULL, '5', NULL, NULL, '5', NULL, NULL, NULL, NULL, '1', NULL, '0', NULL, '2023-09-05 09:44:56', '0', '2023-09-06 14:15:09'),
(4, 'b17eb627-2f45-41a4-9fcb-a0df3d6f7761', 1, 'Test Estate', 'Melrose Park NSW 2114 Australia', 'sydney', -33.81413650512695, 151.0705108642578, NULL, 45000, '0', NULL, NULL, '5', NULL, NULL, '3', NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2023-09-05 09:45:39', '0', '2023-09-06 14:15:18'),
(5, '7f57084f-0642-4a59-8e5c-a9caa4ea8675', 1, 'Renter Estate', 'VIC  Australia', 'sydney', -37.813629150390625, 144.9630584716797, NULL, 12000, '0', NULL, NULL, '4', NULL, NULL, '4', NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, '2023-09-05 09:46:50', '0', '2023-09-06 14:15:25'),
(6, 'ac797626-21c6-44d4-bd95-3aec738379d2', 1, 'Test Property', 'Gables NSW 2765 Australia', 'sydney', -33.62430953979492, 150.9132843017578, NULL, 5598, '0', NULL, NULL, '2', NULL, NULL, '1', NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2023-09-05 09:47:53', '0', '2023-09-06 14:15:31'),
(7, '80d818ed-aa65-4f1c-9bf8-57efe035cf36', 3, 'test property', '14 Glen Street Eastwood NSW 2122 Australia', 'sydney', -33.79084014892578, 151.0789031982422, NULL, 412, '0', NULL, NULL, '0', NULL, NULL, '0', NULL, '0', NULL, NULL, '1', NULL, '1', NULL, '2023-09-05 16:57:45', '0', '2023-09-13 06:09:00'),
(8, '09491034-b7f3-4984-a774-b42c5c4eab8f', 4, 'Spark Abduls Property', 'Mascot NSW 2020 Australia', 'sydney', -33.8688197, 151.2092955, NULL, 100, '1', NULL, NULL, '3', 'The condition is fair, and well located front, have good condition of bedrooms and kitchen', NULL, '2', NULL, '1', 'Unsatisfactory (loud noises - from streets or neighbors -, rude neighbors, other issues)', NULL, '1', 'there is legal issues around the property (in your tenancy or concerning the property directly)', '1', 'those are legal issues managed appropriately by the landlord/real estate agency', '2023-09-11 10:02:06', '0', '2023-09-13 07:26:55'),
(12, 'd499ceef-943f-44b9-abe1-74c683194aec', 4, 'LMS', 'Asquith NSW 2077 Australia', 'sydney', -33.68818664550781, 151.1095733642578, NULL, 222, '1', NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, '2023-09-11 14:05:31', '0', '2023-09-11 14:06:27'),
(13, '527178c3-22e5-43e5-a7a8-dfaeb3a1d0d5', 4, 'Abduls Property', 'NSW  Australia', 'sydney', -33.8708464, 151.20733, NULL, 500, '0', NULL, NULL, '3', NULL, NULL, '4', 'Opinions or details about relationship with the landlord', '2', 'Passable (not a good experience overall)', NULL, '1', 'Were there any legal issues around the property (in your tenancy or concerning the property directly)', '0', NULL, '2023-09-13 07:28:04', '0', '2023-09-13 07:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'step', '{\"step_1\":\"Read reviews or add own review, or if you\'re the property owner, claim the property. Search your rental by address or if it\'s not there, request for it to be added to our database\",\"step_2\":\"Rent with Confidence and make the world a better place\",\"step_3\":\"Search your rental by address or if it\'s not there, request for it to be added to our database\",\"step_4\":\"Rent with Confidence and make the world a better place\"}', '2023-09-04 05:00:59', '2023-09-05 14:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_no`, `city`, `country`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abduls', 'abdul@gmail.com', '4545454545', 'Sydney', 'Austria', NULL, '$2y$10$VmC0WF/2/8o/LSfeyY7m0uMZQpsZFOZvs/pPSfhJdYEcJ0fgupLBq', NULL, '2023-08-07 05:15:30', '2023-09-05 14:43:28'),
(2, 'Admin', 'admin@mailinator.com', NULL, NULL, NULL, NULL, '$2y$10$nmtLx7NBFc.eJl7drmImNe4RAQYgAvLe8.6nyBgfVglHni63Kjb/a', NULL, '2023-08-07 05:18:40', '2023-08-07 05:18:40'),
(3, 'shivam', 'shivam@itradicals.com', NULL, NULL, NULL, NULL, '$2y$10$J6JnMbPe.Q3gZ28twn860u5QliA.omec3Q3auk7qrwNte8DeJHEqi', NULL, '2023-09-01 06:01:13', '2023-09-01 06:01:13'),
(4, 'Abduls', 'abdul@itradicals.com', NULL, NULL, NULL, NULL, '$2y$10$ctqwj328POvmt0iqWsBHOeNKX3.LNDK0x3cFgwWOI2RqPx0ojH2B2', NULL, '2023-09-05 13:48:13', '2023-09-05 13:48:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorite_properties`
--
ALTER TABLE `favorite_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite_properties`
--
ALTER TABLE `favorite_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
