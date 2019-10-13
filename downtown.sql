-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2019 at 12:54 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `downtown`
--

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_09_25_164726_create_sessions_table', 1),
(3, '2019_09_28_145009_laratrust_setup_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'permissionName', 'permissionDisplay', 'permissionDescription', '2019-09-28 20:22:21', '2019-09-28 20:22:21'),
(2, 1, 'SubPermissionnName', 'SubPermissionDisplay', 'SubPermissionDescription', '2019-09-28 20:24:27', '2019-09-28 20:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`, `user_type`) VALUES
(2, 34, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'role', 'dis_role', 'des_role', '2019-10-07 19:05:41', '2019-10-07 19:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(2, 34, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `updated_at`, `created_at`) VALUES
(23, 34, '', '', '1ae85075ea0c3f64f883c77a8d0a617c', 0, '2019-10-13 19:42:44', '2019-09-28 10:13:14'),
(24, 34, '', '', '192ad1ea2c3faa9c2443846afb2a2246', 0, '2019-10-13 19:42:44', '2019-09-28 10:15:06'),
(25, 34, '', '', '0eb42a9ce01d0d9114e4fb02e4ab86dc', 0, '2019-10-13 19:42:44', '2019-09-28 10:16:26'),
(26, 34, '', '', '6b22f0d3802d83a0c347a39048eefafe', 0, '2019-10-13 19:42:44', '2019-09-28 10:16:40'),
(27, 34, '', '', '22010fb8700186a4a33bd13282137f8c', 0, '2019-10-13 19:42:44', '2019-09-28 10:23:26'),
(28, 34, '', '', '0df14289eff398adaa580a6805dd0d8e', 0, '2019-10-13 19:42:44', '2019-09-28 10:24:03'),
(29, 34, '', '', 'c81152f4a04712fee3d78d86a0c8791b', 0, '2019-10-13 19:42:44', '2019-09-28 10:47:41'),
(30, 34, '', '', '1cef6074f0dc125e67e97b177a2116cb', 0, '2019-10-13 19:42:44', '2019-09-28 10:47:54'),
(31, 34, '', '', '9d5e4a6323ba1ea2d4ce83ecfda64786', 0, '2019-10-13 19:42:44', '2019-10-08 19:44:29'),
(32, 34, '', '', '1921dff0a95ee53e196339d5190a4f4f', 0, '2019-10-13 19:42:44', '2019-10-09 12:14:23'),
(33, 34, '', '', '829fc9f58d26f3d02c3979b237656f12', 0, '2019-10-13 19:42:44', '2019-10-09 12:21:42'),
(34, 34, '', '', '334b7fee98c88c41aea64b7b8b378666', 0, '2019-10-13 19:42:44', '2019-10-09 13:17:20'),
(35, 34, '', '', 'bd261bd53b4a6168b5ed3ea8c1c91635', 0, '2019-10-13 19:42:44', '2019-10-09 13:17:36'),
(36, 34, '', '', '8a86eb86624da43ff98793d527674557', 0, '2019-10-13 19:42:44', '2019-10-09 13:19:19'),
(37, 34, '', '', 'fdc7e5f0bad9deb2daf7d687a6cfdc26', 0, '2019-10-13 19:42:44', '2019-10-09 13:20:09'),
(38, 34, '', '', 'e3a67e9e7b168dd25031fc35758e5ed1', 0, '2019-10-13 19:42:44', '2019-10-09 13:21:32'),
(39, 34, '', '', '4473c012f68453862645e4f3cf2c21db', 0, '2019-10-13 19:42:44', '2019-10-09 13:21:57'),
(40, 34, '', '', 'f77fe3f00abc882fec5a7241ca97f7d0', 0, '2019-10-13 19:42:44', '2019-10-09 13:47:06'),
(41, 34, '', '', '41d5ef4e055f3d5bff01c7a33f6af7d1', 0, '2019-10-13 19:42:44', '2019-10-09 13:48:10'),
(42, 34, '', '', '3f51700abcb1dbefd93760e8aae00a07', 0, '2019-10-13 19:42:44', '2019-10-09 13:48:54'),
(43, 34, '', '', '7d123094ed9ea8a1f8a1b2ff27c677ad', 0, '2019-10-13 19:42:44', '2019-10-09 13:49:29'),
(44, 34, '', '', '992c8caeff5542e9ca3ed79411b565f2', 0, '2019-10-13 19:42:44', '2019-10-09 13:55:59'),
(45, 34, '', '', '507998e7b1dc08bbc651946d88f5c71c', 0, '2019-10-13 19:42:44', '2019-10-09 13:56:04'),
(46, 34, '', '', '846814e7748275056cad462f66f14d45', 0, '2019-10-13 19:42:44', '2019-10-09 13:57:01'),
(47, 34, '', '', '3f5ad6e5b71c2e30c4f02f3abb975893', 0, '2019-10-13 19:42:44', '2019-10-09 13:58:54'),
(48, 34, '', '', '895ca5503b5c6beefec5cb62408e158d', 0, '2019-10-13 19:42:44', '2019-10-09 13:58:58'),
(49, 34, '', '', 'b6b3360be7bf0374ea1a656748f1f093', 0, '2019-10-13 19:42:44', '2019-10-09 13:58:58'),
(50, 34, '', '', 'a72528a033a7d4e0bb2448805734e337', 0, '2019-10-13 19:42:44', '2019-10-09 13:58:59'),
(51, 34, '', '', '6dfbc8cff0e16d14c4933ed1086457a0', 0, '2019-10-13 19:42:44', '2019-10-09 13:58:59'),
(52, 34, '', '', '3b9f117c5b0d41d24a48d9a8f61beee4', 0, '2019-10-13 19:42:44', '2019-10-09 13:59:00'),
(53, 34, '', '', 'c8b0e79cca881b5e97cbbf61ebfb7db6', 0, '2019-10-13 19:42:44', '2019-10-09 13:59:04'),
(54, 34, '', '', '04c48a84ab1e03083c62bf6618968cc9', 0, '2019-10-13 19:42:44', '2019-10-09 13:59:18'),
(55, 34, '', '', 'e6f876ae9f7eaefa271891bd0db50951', 0, '2019-10-13 19:42:44', '2019-10-09 14:01:41'),
(56, 34, '', '', 'b7c0c2e4d3cbdc584966ef64ce12dcba', 0, '2019-10-13 19:42:44', '2019-10-09 14:02:16'),
(57, 34, '', '', '07c8293dfa480cf82cb7195eb6f38b51', 0, '2019-10-13 19:42:44', '2019-10-09 14:02:20'),
(58, 34, '', '', '9a68755fafe927046f85b8b8a580c416', 0, '2019-10-13 19:42:44', '2019-10-09 14:02:28'),
(59, 34, '', '', '97babce4704ace396a6162e1b7177638', 0, '2019-10-13 19:42:44', '2019-10-09 14:03:03'),
(60, 34, '', '', '61af5024adfaf41697ad28d59cd3e8e0', 0, '2019-10-13 19:42:44', '2019-10-09 14:03:21'),
(61, 34, '', '', 'bb3fee1b598e94b08bd285440ff2a2d5', 0, '2019-10-13 19:42:44', '2019-10-09 14:05:44'),
(62, 34, '', '', '252ab57bb5c252848f79a9d3dd744c3a', 0, '2019-10-13 19:42:44', '2019-10-09 14:06:20'),
(63, 34, '', '', 'f1c1acfc8398b7f2b38063798e941351', 0, '2019-10-13 19:42:44', '2019-10-09 14:06:56'),
(64, 34, '', '', 'eafa072a9e64935118a43bea8c78ddd4', 0, '2019-10-13 19:42:44', '2019-10-09 14:07:21'),
(65, 34, '', '', '250effc3669648e04a2225ce4dba9487', 0, '2019-10-13 19:42:44', '2019-10-09 14:08:16'),
(66, 34, '', '', 'e6425a24dc200942c13562031fea64e2', 0, '2019-10-13 19:42:44', '2019-10-09 14:09:02'),
(67, 34, '', '', '72186071eed966767f4e6c7556e4bac9', 0, '2019-10-13 19:42:44', '2019-10-11 09:42:29'),
(68, 34, '', '', 'ce6fb635770b356d623985ffbd1996e6', 0, '2019-10-13 19:42:44', '2019-10-11 09:44:48'),
(69, 34, '', '', '3c118044dbc025b624cc3efa428c580f', 0, '2019-10-13 19:42:44', '2019-10-11 09:44:57'),
(70, 34, '', '', '14f67e4c507736c399f4dd143ec3273f', 0, '2019-10-13 19:42:44', '2019-10-11 09:47:04'),
(71, 34, '', '', '28e75e93f81f457123cdf9cd3f6e5138', 0, '2019-10-13 19:42:44', '2019-10-11 09:48:48'),
(72, 34, '', '', '739a2932d2e3cbc511a66dcaf5300bfa', 0, '2019-10-13 19:42:44', '2019-10-11 09:50:23'),
(73, 34, '', '', '960875f95b4912f5c2ba46e723c2dcf3', 0, '2019-10-13 19:42:44', '2019-10-11 10:57:28'),
(74, 34, '', '', '420399729fb5f32b21614b8cc5557fc8', 0, '2019-10-13 19:42:44', '2019-10-11 10:59:19'),
(75, 34, '', '', 'a4d0389208edba9cefa3d73837a8f8b1', 0, '2019-10-13 19:42:44', '2019-10-11 11:34:33'),
(76, 34, '', '', '1802eee45df16add8932999f059641a6', 0, '2019-10-13 19:42:44', '2019-10-11 11:42:33'),
(77, 34, '', '', 'fe9a330521d465127437c028b1b29b1b', 0, '2019-10-13 19:42:44', '2019-10-11 11:42:58'),
(78, 34, '', '', '82c043d0f923eacb9290722e0dee5c59', 0, '2019-10-13 19:42:44', '2019-10-11 11:53:04'),
(79, 34, '', '', '084aed86e6424a50df45bc7dc0b7e989', 0, '2019-10-13 19:42:44', '2019-10-11 11:55:59'),
(80, 34, '', '', '56fdbfc52e89530cd4a83d3ed62e3d3b', 0, '2019-10-13 19:42:44', '2019-10-11 11:56:14'),
(81, 34, '', '', '2e84ba9815fcaee32c4d1947769ba7a3', 0, '2019-10-13 19:42:44', '2019-10-11 11:56:27'),
(82, 34, '', '', '17aac24d1d8c940166a4a422dbc1ae11', 0, '2019-10-13 19:42:44', '2019-10-11 11:56:43'),
(83, 34, '', '', '30c97213a0d8d8f9d3375ab4aba72480', 0, '2019-10-13 19:42:44', '2019-10-11 11:59:57'),
(84, 34, '', '', 'f8e4dac151f8e8589edc116633c3ebab', 0, '2019-10-13 19:42:44', '2019-10-11 12:23:16'),
(85, 34, '', '', '706fe7c91cf9fe419ee2cc7954906f09', 0, '2019-10-13 19:42:44', '2019-10-11 12:25:36'),
(86, 34, '', '', '20262471ba6033ebe355731417940256', 0, '2019-10-13 19:42:44', '2019-10-11 12:25:52'),
(87, 34, '', '', 'd9f82002809d90be046f9f2beda33fed', 0, '2019-10-13 19:42:44', '2019-10-11 12:25:58'),
(88, 34, '', '', '0d6ac4c249fc1cedde856ea45f12e100', 0, '2019-10-13 19:42:44', '2019-10-11 13:26:29'),
(89, 34, '', '', '3a0c587c8e65e8c1a793ce3ba26171f5', 0, '2019-10-13 19:42:44', '2019-10-11 13:26:39'),
(90, 34, '', '', '479075e381fc5ea405b21216a3e7b92c', 0, '2019-10-13 19:42:44', '2019-10-11 13:26:47'),
(91, 34, '', '', '40ecc435971482be25d138c85a3e4ca0', 0, '2019-10-13 19:42:44', '2019-10-11 13:47:55'),
(92, 34, '', '', '3c7be35f6799d1f0c3348468260f9b19', 0, '2019-10-13 19:42:44', '2019-10-11 13:48:09'),
(93, 34, '', '', '9b8cc28d34fe35680d17e2dabcb855f2', 0, '2019-10-13 19:42:44', '2019-10-11 13:52:23'),
(94, 34, '', '', '64246a3fa3c8dd17d45c3ce25a10ff35', 0, '2019-10-13 19:42:44', '2019-10-11 14:05:34'),
(95, 34, '', '', 'b2a15132bca17e7d0f20f04e5efb54dc', 0, '2019-10-13 19:42:44', '2019-10-12 01:42:24'),
(96, 34, '', '', '7684315ee1f34a3bd4552869b5ba9f0f', 0, '2019-10-13 19:42:44', '2019-10-12 02:02:52'),
(97, 34, '', '', 'b17b5105e1ba50c4b81701db384487d1', 0, '2019-10-13 19:42:44', '2019-10-12 19:17:47'),
(98, 34, '', '', 'd3ef3b5ceaf9e358fd8c8bba935af1a5', 0, '2019-10-13 19:42:44', '2019-10-12 19:21:39'),
(99, 34, '', '', '5a19cf47b7992503bc59815d8d27e85f', 0, '2019-10-13 19:42:44', '2019-10-12 19:21:48'),
(100, 34, '', '', '4ffb5aa8731cd3e41801716a25fefdd6', 0, '2019-10-13 19:42:44', '2019-10-12 21:23:16'),
(101, 34, '', '', 'b4be4d053d30b3428a41f76e75a1bb35', 0, '2019-10-13 19:42:44', '2019-10-12 21:25:36'),
(102, 34, '', '', '082e1686fda98c8e16b2e1def2ca5e18', 0, '2019-10-13 19:42:44', '2019-10-13 13:40:55'),
(103, 34, '', '', '98bac4230b8628fbf3f8d9379d30f19a', 0, '2019-10-13 19:42:44', '2019-10-13 13:41:08'),
(104, 34, '', '', '70e002f93eca47e457c08428ef547ee4', 0, '2019-10-13 19:42:44', '2019-10-13 13:41:46'),
(105, 34, '', '', 'f00bb0c1bed41bb31e8381ba1e77a9d4', 0, '2019-10-13 19:42:44', '2019-10-13 13:42:06'),
(106, 34, '', '', 'ab2d066fcc69d4f80d8067e276bc8bbb', 0, '2019-10-13 19:42:44', '2019-10-13 13:43:10'),
(107, 34, '', '', '1a50c055983c2c0f33a168b94f9052b8', 0, '2019-10-13 19:42:44', '2019-10-13 13:43:34'),
(108, 34, '', '', '5cfc8c1cad73d680265371b35664dad7', 0, '2019-10-13 19:42:44', '2019-10-13 13:45:27'),
(109, 34, '', '', 'ffdcecd681a8653dd6c677ade51c3bcf', 0, '2019-10-13 19:42:44', '2019-10-13 13:46:14'),
(110, 34, '', '', '7bf8d8e8d338cf87b68504df352b923e', 0, '2019-10-13 19:42:44', '2019-10-13 13:47:08'),
(111, 34, '', '', '07d6c50d64534cb8c871cb1fa8477ae8', 0, '2019-10-13 19:42:44', '2019-10-13 13:48:44'),
(112, 34, '', '', 'a1c3a56caf1e5658215c16074edd2dc6', 0, '2019-10-13 19:42:44', '2019-10-13 13:51:36'),
(113, 34, '', '', 'b05a2ff9fcf8c8e829a5a7f27033066e', 0, '2019-10-13 19:42:44', '2019-10-13 14:00:47'),
(114, 34, '', '', '068344c416b09d10a333d03d78d63a35', 0, '2019-10-13 19:42:44', '2019-10-13 17:24:04'),
(115, 34, '', '', 'e3330b41a188d65aee6a2ecec25c8912', 0, '2019-10-13 19:42:44', '2019-10-13 17:25:48'),
(116, 34, '', '', '5a55212e1cc15efe0eaf163605b31d39', 0, '2019-10-13 22:42:46', '2019-10-13 19:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `verified` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `verified`, `created_at`, `updated_at`) VALUES
(34, 'Abode', '123456', 1, '2019-09-28 13:47:45', '2019-09-28 10:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `verificationcodes`
--

CREATE TABLE `verificationcodes` (
  `user_id` int(11) NOT NULL,
  `verificationcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` int(11) NOT NULL,
  `verifingtype` int(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verificationcodes`
--

INSERT INTO `verificationcodes` (`user_id`, `verificationcode`, `used`, `verifingtype`, `created_at`, `updated_at`) VALUES
(34, '458276', 0, 1, '2019-09-28 09:51:32', '2019-09-28 09:51:32'),
(34, '255125', 1, 1, '2019-09-28 13:13:11', '2019-09-28 10:13:11'),
(34, '856510', 0, 2, '2019-09-28 10:30:55', '2019-09-28 10:30:55'),
(34, '332706', 0, 2, '2019-09-28 10:31:19', '2019-09-28 10:31:19'),
(34, '341081', 1, 2, '2019-09-28 13:45:46', '2019-09-28 10:45:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
