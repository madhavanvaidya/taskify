-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2023 at 06:26 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `company`, `email`, `phone`, `password`, `address`, `city`, `state`, `country`, `zip`, `profile`, `created_at`, `updated_at`) VALUES
(8, 'Elon', 'Musk', 'Tesla', 'elon@tesla.com', 9786543210, '$2y$10$T001CpadaRInVuA8vxVqxecep0MWDq84f/v2qpBCuoB36X8ZDiu9K', 'Mountain View', 'San Jose', 'CA', 'U.S.A', 511613, 'photos/z9wdNSOXM26lOnVfXBSvmPhyXhP5atKsASNH8JYy.png', '2023-01-17 04:59:30', '2023-01-17 04:59:30'),
(9, 'Tony', 'Stark', 'Stark Industries', 'tony@stark.com', 7896541230, '$2y$10$0OXguD7Df1iSSHYDz5cNhu.YYDFRxfW7b2TKOwbnBSfPIvIDbm5oS', 'tony@starkindustries.com', 'New York', 'NY', 'U.S.A', 654987, 'photos/DUYZQX2bGiTIutXCUvxEeLhhGCalOi3dbIrKMgty.png', '2023-01-17 05:00:28', '2023-01-17 05:00:28'),
(14, 'Jeff', 'Bezos', 'Amazon co.', 'jeff@amazon.com', 7895461230, '$2y$10$aanu7/oz0Or55BcLnc4QiuFYhxu.958CjGkHjtST3sS/pDbTYzmuy', 'Long Beach', 'L.A.', 'C.A.', 'U.S.A', 215466, 'photos/Tbby2kiwr0aXSf2V3YL1ywLCs3oNM8K7Ar8IWIhB.png', '2023-03-15 04:58:05', '2023-03-15 05:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `client_project`
--

CREATE TABLE `client_project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_project`
--

INSERT INTO `client_project` (`id`, `project_id`, `client_id`) VALUES
(8, 59, 8),
(11, 60, 9),
(14, 61, 14);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_05_044027_create_clients_table', 2),
(6, '2023_01_09_041709_create_projects_table', 3),
(7, '2023_01_12_095035_create_tasks_table', 4),
(8, '2023_01_25_061517_create_project_user_table', 5),
(9, '2023_01_27_044336_create_project_client_table', 6),
(10, '2023_01_30_050742_create_task_user_table', 7),
(11, '2023_01_30_060853_create_task_user_table', 8),
(12, '2023_03_02_051733_create_todo_table', 9),
(13, '2023_03_06_043616_create_status_table', 9),
(14, '2023_03_14_045106_create_permission_tables', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 7),
(8, 'App\\Models\\User', 9),
(8, 'App\\Models\\User', 10),
(9, 'App\\Models\\User', 12),
(9, 'App\\Models\\User', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('madhavanvaidya@gmail.com', '$2y$10$qlg5QhfOLOEvh8PYaTy1oOMEoD1P.WYWqcen7pqdZXIhKMhsvYpTC', '2023-03-08 23:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'edit_tasks', 'web', '2023-03-14 00:32:57', '2023-03-14 00:32:57'),
(3, 'delete_tasks', 'web', '2023-03-14 01:09:18', '2023-03-14 01:09:18'),
(4, 'edit_projects', 'web', '2023-03-14 03:22:52', '2023-03-14 03:22:52'),
(5, 'delete_projects', 'web', '2023-03-14 03:23:43', '2023-03-14 03:23:43'),
(6, 'edit_clients', 'web', '2023-03-14 03:23:53', '2023-03-14 03:23:53'),
(7, 'delete_clients', 'web', '2023-03-14 03:24:01', '2023-03-14 03:24:01'),
(8, 'create_projects', 'web', '2023-03-14 23:12:29', '2023-03-14 23:12:29'),
(9, 'create_tasks', 'web', '2023-03-14 23:12:34', '2023-03-14 23:12:34'),
(10, 'create_clients', 'web', '2023-03-14 23:12:38', '2023-03-14 23:12:38'),
(11, 'edit_users', 'web', '2023-03-17 00:51:15', '2023-03-17 00:51:15'),
(12, 'delete_users', 'web', '2023-03-17 00:57:41', '2023-03-17 00:57:41'),
(13, 'manage_users', 'web', '2023-03-27 00:04:49', '2023-03-27 00:04:49'),
(14, 'manage_projects', 'web', '2023-03-27 00:04:54', '2023-03-27 00:04:54'),
(15, 'manage_tasks', 'web', '2023-03-27 00:04:58', '2023-03-27 00:04:58'),
(16, 'manage_clients', 'web', '2023-03-27 00:05:02', '2023-03-27 00:05:02'),
(17, 'create_users', 'web', '2023-03-27 00:19:25', '2023-03-27 00:19:25');

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
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `budget` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `status_id`, `budget`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(59, 'Flask Dev', 'Lorem ipsum', 1, 3200, '2023-02-01', '2023-03-10', '2023-02-12 23:55:31', '2023-03-28 01:07:38'),
(60, 'EGrocer Mobile App', 'Online grocery delivery app', 2, 10000, '2023-03-29', '2023-04-28', '2023-04-14 22:41:32', '2023-04-14 22:41:32'),
(61, 'Flash News Frontend', 'News application frontend.', 2, 5000, '2023-04-07', '2023-04-29', '2023-04-14 22:54:32', '2023-04-14 22:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`id`, `project_id`, `user_id`) VALUES
(12, 59, 7),
(13, 59, 9),
(19, 59, 10),
(14, 59, 12),
(20, 60, 10),
(21, 60, 18),
(22, 61, 10),
(23, 61, 18);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2023-03-13 23:28:49', '2023-03-13 23:28:49'),
(8, 'HR', 'web', '2023-03-31 06:21:15', '2023-03-31 06:21:15'),
(9, 'Member', 'web', '2023-03-31 06:21:47', '2023-03-31 06:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 8),
(13, 9),
(14, 1),
(14, 8),
(14, 9),
(15, 1),
(15, 8),
(15, 9),
(16, 1),
(16, 8),
(16, 9),
(17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `title`, `slug`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Started', 'started', 'primary', '2023-03-07 08:54:49', '2023-03-07 08:54:49'),
(2, 'On Going', 'on-going', 'info', '2023-03-07 03:26:07', '2023-03-07 03:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `priority` varchar(255) NOT NULL DEFAULT 'Low',
  `status` varchar(255) NOT NULL DEFAULT 'Ongoing',
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `title`, `description`, `priority`, `status`, `start_date`, `due_date`, `created_at`, `updated_at`) VALUES
(19, 59, 'Frontend', 'Lorem', 'Low', 'started', '2023-02-26', '2023-02-27', '2023-03-15 05:59:11', '2023-04-21 08:03:45'),
(20, 59, 'Backend', 'asdvasdv', 'Low', 'cancelled', '2023-02-27', '2023-03-30', '2023-03-16 00:44:39', '2023-03-24 23:02:30'),
(21, 60, 'Dashboard', 'Impressive UI for EGrocer Dashboard', 'Low', 'completed', '2023-04-04', '2023-04-26', '2023-04-14 22:44:06', '2023-04-21 08:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE `task_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`id`, `task_id`, `user_id`) VALUES
(26, 19, 7),
(27, 19, 12),
(28, 20, 9),
(29, 21, 10);

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL DEFAULT 'low',
  `description` text DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `title`, `priority`, `description`, `completed`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 'Presentation', 'low', 'dasdga', 0, 7, '2023-03-15 00:18:35', '2023-04-14 22:45:22'),
(57, 'meeting', 'high', 'asdasdvas', 1, 7, '2023-03-19 23:53:19', '2023-03-28 00:59:04'),
(60, 'Client Call', 'medium', 'Inform client about current status of project.', 0, 7, '2023-04-14 22:45:46', '2023-04-14 22:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `address`, `city`, `state`, `country`, `zip`, `password`, `photo`, `created_at`, `updated_at`) VALUES
(7, 'Madhavan', 'Vaidya', 9876543201, 'madhavan@gmail.com', 'Devonshire', 'Windsor', 'ON', 'Canada', 123654, '$2y$10$/n.fwwjbq5Xqiz5mrTP5NurRcf0pRdEUt0f3VFMcvD/acGVM6Jkj.', 'photos/slKEWkT6TwUSfyU5VOO6rerl5xvfjOBHq90Iykjf.png', '2023-01-03 05:07:20', '2023-02-22 23:45:07'),
(9, 'Tanzeel', 'Khan', 7894561023, 'admin@mail.com', '2nd Street', 'Surrey', 'ON', 'Canada', 1368684, '$2y$10$uGRlkMhakGODq4EGQxIh0uS0W.0SNSM5sQqtXzuSobG5zIfd9q.p2', 'photos/GWyLONtJSxvCkTP4Mh7wlCVkDpBs8vN3ypSlyXFk.png', '2023-01-04 04:26:02', '2023-03-17 01:02:33'),
(10, 'Steve', 'Rogers', 8899776655, 'steve@rogers.com', 'Beverly Hills', 'Los Angeles', 'CA', 'USA', 456654, '$2y$10$bz9cIbhqLvfwITgmFLGFKe/A.oJlusQWw353L3WayD5sE4Gw.nn3i', 'photos/oCyIHIR7DTuo3my3kD0VH9cQCHrIAsBwKGI0EbJR.jpg', '2023-01-06 05:27:57', '2023-01-06 06:01:46'),
(12, 'Lisa', 'Marie Presley', 9638527410, 'lisa@presley.com', '2nd Street', 'Nashville', 'Tennessee', 'U.S.A', 159357, '$2y$10$SsT6sd1Gg4XinUtWINrPyurXV2kxTl6CZiB6S4fKR3.ZVumiCqN1u', 'photos/yHAKJ0rUjZZY3O4QhjH70ZlgqK8TdQreJyD6EbUv.png', '2023-01-17 05:15:04', '2023-03-17 00:44:08'),
(18, 'Bruce', 'Wayne', 6549873210, 'bruce@wayne.com', 'Gotham st.', 'New York', 'NY', 'U.S.A', 61618, '$2y$10$0qOCSf6RtWtAYBrUMlX63O9y6ZBncHirCFchzRRz.L4y5mZd/dxAu', 'photos/3YQpjIdmKdDoU9k1GkaevMWzKON5fBVPMj8u5Vg5.png', '2023-03-27 03:55:36', '2023-03-28 06:08:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `client_project`
--
ALTER TABLE `client_project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_client_project_id_client_id_unique` (`project_id`,`client_id`),
  ADD KEY `project_client_client_id_foreign` (`client_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_status_id_foreign` (`status_id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_user_project_id_user_id_unique` (`project_id`,`user_id`),
  ADD KEY `project_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `task_user_task_id_user_id_unique` (`task_id`,`user_id`),
  ADD KEY `task_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `todos_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `client_project`
--
ALTER TABLE `client_project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `task_user`
--
ALTER TABLE `task_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_project`
--
ALTER TABLE `client_project`
  ADD CONSTRAINT `project_client_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_client_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `project_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `project_user_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_user`
--
ALTER TABLE `task_user`
  ADD CONSTRAINT `task_user_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `todos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
