-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2026 at 08:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jueli_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `subject_type` varchar(255) NOT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `subject_type`, `subject_id`, `description`, `created_at`) VALUES
(1, NULL, 'created', 'App\\Models\\User', 1, 'User \'Admin\' created', '2026-07-02 06:38:21'),
(2, NULL, 'created', 'App\\Models\\ProductCategory', 1, 'ProductCategory \'Mechanical & Cutting Tools\' created', '2026-07-02 06:38:21'),
(3, NULL, 'created', 'App\\Models\\ProductCategory', 2, 'ProductCategory \'Agricultural Implements\' created', '2026-07-02 06:38:21'),
(4, NULL, 'created', 'App\\Models\\ProductCategory', 3, 'ProductCategory \'Hardware & Fasteners\' created', '2026-07-02 06:38:21'),
(5, NULL, 'created', 'App\\Models\\ProductCategory', 4, 'ProductCategory \'Cleaning Equipment\' created', '2026-07-02 06:38:21'),
(6, NULL, 'created', 'App\\Models\\Product', 1, 'Product \'Rossel Sprinkler\' created', '2026-07-02 06:38:21'),
(7, NULL, 'created', 'App\\Models\\Product', 2, 'Product \'Metal Hedge Shear 10\"\' created', '2026-07-02 06:38:21'),
(8, NULL, 'created', 'App\\Models\\Product', 3, 'Product \'Castor Wheels\' created', '2026-07-02 06:38:21'),
(9, NULL, 'created', 'App\\Models\\Product', 4, 'Product \'Agricultural Hand Tool\' created', '2026-07-02 06:38:21'),
(10, NULL, 'created', 'App\\Models\\Product', 5, 'Product \'Assorted Bolts\' created', '2026-07-02 06:38:21'),
(11, NULL, 'created', 'App\\Models\\Product', 6, 'Product \'Plumbing Accessories Kit\' created', '2026-07-02 06:38:21'),
(12, NULL, 'created', 'App\\Models\\Product', 7, 'Product \'Roofing Screws\' created', '2026-07-02 06:38:21'),
(13, NULL, 'created', 'App\\Models\\Product', 8, 'Product \'Construction Tool Set\' created', '2026-07-02 06:38:21'),
(14, NULL, 'created', 'App\\Models\\Leader', 1, 'Leader \'Eliud Kiprotich\' created', '2026-07-02 06:38:21'),
(15, NULL, 'created', 'App\\Models\\Leader', 2, 'Leader \'Judy Wanjiru\' created', '2026-07-02 06:38:21'),
(16, NULL, 'created', 'App\\Models\\Leader', 3, 'Leader \'Peter Mwangi\' created', '2026-07-02 06:38:21'),
(17, 1, 'updated', 'App\\Models\\Product', 1, 'Product \'Activity Log Test Product\' updated', '2026-07-02 06:40:27'),
(18, 1, 'updated', 'App\\Models\\Product', 4, 'Product \'Agricultural Hand Tool\' updated', '2026-07-02 07:05:07'),
(19, 1, 'deleted', 'App\\Models\\Product', 8, 'Product \'Construction Tool Set\' deleted', '2026-07-02 08:16:14'),
(20, 1, 'updated', 'App\\Models\\Product', 2, 'Product \'Metal Hedge Shear 10\"\' updated', '2026-07-03 16:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'Quote for steel fabrication', 'Hi, I\'d like a quote for a steel structure fabrication project. Can someone get back to me?', NULL, '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(2, 'Mary Achieng', 'mary.a@example.com', 'HVAC installation inquiry', 'We are looking for HVAC installation services for a new commercial building in Nairobi. Please advise on availability.', NULL, '2026-07-02 06:38:21', '2026-07-02 06:38:21');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaders`
--

CREATE TABLE `leaders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaders`
--

INSERT INTO `leaders` (`id`, `fullname`, `position`, `department`, `phone_number`, `email`, `status`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, 'Eliud Kiprotich', 'Chief Executive Officer', 'Executive', '+254704553400', 'eliud@jueliengineeringltd.co.ke', 'active', 'leaders/ceo.jpg', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(2, 'Judy Wanjiru', 'Operations Manager', 'Operations', '+254700000001', 'judy@jueliengineeringltd.co.ke', 'active', 'leaders/leader-2.jpg', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(3, 'Peter Mwangi', 'Head of Engineering', 'Engineering', '+254700000002', 'peter@jueliengineeringltd.co.ke', 'active', 'leaders/leader-3.jpg', '2026-07-02 06:38:21', '2026-07-02 06:38:21');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_01_211103_create_product_categories_table', 1),
(5, '2026_07_01_211104_create_leaders_table', 1),
(6, '2026_07_01_211105_create_contact_messages_table', 1),
(7, '2026_07_01_211106_create_products_table', 1),
(8, '2026_07_02_083917_add_price_and_status_to_products_table', 1),
(9, '2026_07_02_083920_add_description_and_status_to_product_categories_table', 1),
(10, '2026_07_02_083924_add_department_email_status_to_leaders_table', 1),
(11, '2026_07_02_084232_create_roles_table', 1),
(12, '2026_07_02_084234_create_permissions_table', 1),
(13, '2026_07_02_084236_create_permission_role_table', 1),
(14, '2026_07_02_084238_add_role_id_to_users_table', 1),
(15, '2026_07_02_084240_create_activity_logs_table', 1),
(16, '2026_07_02_084241_create_page_views_table', 1),
(17, '2026_07_02_084243_create_settings_table', 1),
(18, '2026_07_02_085528_drop_legacy_role_column_from_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_views`
--

CREATE TABLE `page_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_views`
--

INSERT INTO `page_views` (`id`, `path`, `ip_address`, `created_at`) VALUES
(1, '/', '127.0.0.1', '2026-07-02 06:39:21'),
(2, '/', '127.0.0.1', '2026-07-02 06:39:27'),
(3, 'shop', '127.0.0.1', '2026-07-02 06:40:50'),
(4, 'contact', '127.0.0.1', '2026-07-02 06:40:52'),
(5, '/', '127.0.0.1', '2026-07-02 06:41:14'),
(6, 'about', '127.0.0.1', '2026-07-02 06:41:16'),
(7, 'services', '127.0.0.1', '2026-07-02 06:41:17'),
(8, 'shop', '127.0.0.1', '2026-07-02 06:41:19'),
(9, 'contact', '127.0.0.1', '2026-07-02 06:41:20'),
(10, '/', '127.0.0.1', '2026-07-02 06:52:32'),
(11, 'about', '127.0.0.1', '2026-07-02 06:52:45'),
(12, 'services', '127.0.0.1', '2026-07-02 06:52:46'),
(13, 'shop', '127.0.0.1', '2026-07-02 06:52:46'),
(14, 'contact', '127.0.0.1', '2026-07-02 06:52:47'),
(15, 'contact', '127.0.0.1', '2026-07-02 06:57:24'),
(16, 'contact', '127.0.0.1', '2026-07-02 06:57:28'),
(17, '/', '127.0.0.1', '2026-07-02 06:58:47'),
(18, '/', '127.0.0.1', '2026-07-02 06:59:13'),
(19, 'shop', '127.0.0.1', '2026-07-02 07:02:00'),
(20, 'shop', '127.0.0.1', '2026-07-02 11:39:55'),
(21, 'about', '127.0.0.1', '2026-07-02 11:40:01'),
(22, '/', '127.0.0.1', '2026-07-02 11:40:21'),
(23, '/', '127.0.0.1', '2026-07-02 14:25:17'),
(24, '/', '127.0.0.1', '2026-07-02 14:25:52'),
(25, '/', '127.0.0.1', '2026-07-03 16:25:04'),
(26, '/', '127.0.0.1', '2026-07-03 16:29:32'),
(27, '/', '127.0.0.1', '2026-07-03 16:31:16'),
(28, '/', '127.0.0.1', '2026-07-05 11:12:51'),
(29, '/', '127.0.0.1', '2026-07-05 11:13:05'),
(30, 'shop', '127.0.0.1', '2026-07-05 11:13:15'),
(31, '/', '127.0.0.1', '2026-07-06 14:45:24'),
(32, 'about', '127.0.0.1', '2026-07-06 14:45:48'),
(33, 'services', '127.0.0.1', '2026-07-06 14:45:58'),
(34, 'shop', '127.0.0.1', '2026-07-06 14:46:03');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `group`, `created_at`, `updated_at`) VALUES
(1, 'View Products', 'products.view', 'Products', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(2, 'Manage Products', 'products.manage', 'Products', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(3, 'View Categories', 'categories.view', 'Categories', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(4, 'Manage Categories', 'categories.manage', 'Categories', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(5, 'View Team', 'leaders.view', 'Team', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(6, 'Manage Team', 'leaders.manage', 'Team', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(7, 'View Messages', 'messages.view', 'Messages', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(8, 'Manage Website Settings', 'settings.manage', 'Settings', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(9, 'Manage Admin Users', 'users.manage', 'Settings', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(10, 'Manage Roles & Permissions', 'roles.manage', 'Settings', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(11, 'View Activity Logs', 'activity_logs.view', 'Settings', '2026-07-02 06:38:20', '2026-07-02 06:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`) VALUES
(8, 1, 1),
(7, 1, 2),
(3, 1, 3),
(2, 1, 4),
(5, 1, 5),
(4, 1, 6),
(6, 1, 7),
(10, 1, 8),
(11, 1, 9),
(9, 1, 10),
(1, 1, 11),
(18, 2, 1),
(17, 2, 2),
(13, 2, 3),
(12, 2, 4),
(15, 2, 5),
(14, 2, 6),
(16, 2, 7),
(24, 3, 1),
(23, 3, 2),
(20, 3, 3),
(19, 3, 4),
(22, 3, 5),
(21, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `product_picture` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_description`, `price`, `product_picture`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rossel Sprinkler', 'Durable garden sprinkler for irrigation projects.', 1250.00, 'products/sprinkler-rossel.jpg', 0, 'active', '2026-07-02 06:38:21', '2026-07-02 06:40:26'),
(2, 2, 'Metal Hedge Shear 10\"', 'Heavy-duty hedge shear with a metal handle for landscaping work.', 100000.00, 'products/hedge-shear.jpg', 1, 'active', '2026-07-02 06:38:21', '2026-07-03 16:27:51'),
(3, 3, 'Castor Wheels', 'Industrial-grade castor wheels for trolleys and equipment.', 600.00, 'products/castor-wheels.jpg', 0, 'active', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(4, 2, 'Agricultural Hand Tool', 'General-purpose hand tool for farm and garden use.', 480.00, 'products/agri-tool.png', 0, 'active', '2026-07-02 06:38:21', '2026-07-02 07:05:07'),
(5, 3, 'Assorted Bolts', 'Mixed sizes of galvanized bolts for construction and fabrication.', 320.00, 'products/bolts.jpg', 1, 'active', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(6, 1, 'Plumbing Accessories Kit', 'Fittings and accessories for residential and commercial plumbing.', 2100.00, 'products/plumbing-accessories.jpg', 0, 'active', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(7, 1, 'Roofing Screws', 'Corrosion-resistant screws for roofing sheet installation.', 150.00, 'products/roofing-screws.jpg', 0, 'draft', '2026-07-02 06:38:21', '2026-07-02 06:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_name`, `description`, `picture`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mechanical & Cutting Tools', 'Cutting tools, sprinklers, and general mechanical equipment for industrial and commercial use.', 'categories/mechanical.png', 'active', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(2, 'Agricultural Implements', 'Hand tools and implements for farm, garden, and landscaping work.', 'categories/agricultural.jpg', 'active', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(3, 'Hardware & Fasteners', 'Bolts, wheels, and other hardware components for construction and fabrication.', 'categories/hardware.jpg', 'active', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(4, 'Cleaning Equipment', 'Tools and equipment for site cleaning and maintenance.', 'categories/cleaning.jpg', 'draft', '2026-07-02 06:38:21', '2026-07-02 06:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(2, 'Manager', 'manager', '2026-07-02 06:38:20', '2026-07-02 06:38:20'),
(3, 'Editor', 'editor', '2026-07-02 06:38:20', '2026-07-02 06:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kEjt3E7afUFOn6dJM9Bhl96VJVDTq8eAuU67nitf', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXBjMTc2MGxmMm5yVEpTaUJnSnB1VGhJSUV2QkJZY2JmZjIxMzNSMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cz9mZWF0dXJlZD0xIjtzOjU6InJvdXRlIjtzOjIwOiJhZG1pbi5wcm9kdWN0cy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1783360115),
('NFPK9FnFSUmg5cEv6v5L3NT7U55H90SvwgaiHTDs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ1Jza2w3VXBFMHllMk9aMlR2eTdKbURLbFRTWEFCZm56Ym1mejQ5dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1783360057);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Jueli Engineering Ltd', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(2, 'contact_email', 'info@jueliengineeringltd.co.ke', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(3, 'contact_phone', '+254 704 553 400', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(4, 'contact_address', '15976-00100, Nairobi Industrial Area, Kenya', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(5, 'facebook_url', '', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(6, 'twitter_url', '', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(7, 'linkedin_url', '', '2026-07-02 06:38:21', '2026-07-02 06:38:21'),
(8, 'instagram_url', '', '2026-07-02 06:38:21', '2026-07-02 06:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@jueli.test', NULL, '$2y$12$yT2nzi8j6zns1GHWMfMlEe42mHFbOUlc1Q/OXu1FXOiGMPSlKuFXS', 1, NULL, '2026-07-02 06:38:21', '2026-07-02 06:38:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaders`
--
ALTER TABLE `leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_views`
--
ALTER TABLE `page_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_views_created_at_index` (`created_at`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_role_role_id_permission_id_unique` (`role_id`,`permission_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaders`
--
ALTER TABLE `leaders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `page_views`
--
ALTER TABLE `page_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
