-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2019 at 11:13 PM
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
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `ActionName` varchar(55) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `ActionName`, `created_at`, `updated_at`) VALUES
(1, 'login', NULL, NULL),
(2, 'logout', NULL, NULL),
(3, 'editUser', NULL, NULL),
(4, 'verifyaccount', NULL, NULL),
(5, 'verifyRestingPassword', NULL, NULL),
(6, 'sendVerificationCodeRegistering', NULL, NULL),
(7, 'sendVerificationCodeResetingPasssword', NULL, NULL),
(8, 'resetPassword', NULL, NULL),
(9, 'changePassword', NULL, NULL),
(10, 'getAllPermission', NULL, NULL),
(11, 'addMainPermission', NULL, NULL),
(12, 'addSubPermission', NULL, NULL),
(13, 'editPermission', NULL, NULL),
(14, 'deletePermission', NULL, NULL),
(15, 'GetAllRole', NULL, NULL),
(16, 'addRole', NULL, NULL),
(17, 'editRole', NULL, NULL),
(18, 'deleteRole', NULL, NULL),
(19, 'editRole', NULL, NULL),
(20, 'attachPermissionToRole', NULL, NULL),
(21, 'deAttachPermissionToRole', NULL, NULL),
(22, 'attachRoleToUser', NULL, NULL),
(23, 'deAttachRoleToUser', NULL, NULL),
(24, 'attachPermissionToUser', NULL, NULL),
(25, 'deAttachPermissionToUser', NULL, NULL),
(26, 'hasRole', NULL, NULL),
(27, 'hasPermission', NULL, NULL),
(28, 'createRealEstate', NULL, NULL),
(29, 'addNewCostMeasure', NULL, NULL),
(30, 'editCostMeasure', NULL, NULL),
(31, 'deleteCostMeasure', NULL, NULL),
(32, 'addNewSizeMeasure', NULL, NULL),
(33, 'editSizeMeasure', NULL, NULL),
(34, 'deleteSizeMeasure', NULL, NULL),
(35, 'like', '2019-11-15 12:56:39', '2019-11-15 12:56:39'),
(36, 'dislike', '2019-11-15 13:39:58', '2019-11-15 13:39:58'),
(37, 'likesUserListsOfRealEstate', '2019-11-15 14:19:20', '2019-11-15 14:19:20'),
(38, 'likesCountOfRealEsatate', '2019-11-15 14:21:37', '2019-11-15 14:21:37'),
(39, 'hardDelete', '2019-11-15 15:37:58', '2019-11-15 15:37:58'),
(40, 'DeleteRealEstate', '2019-11-16 07:11:00', '2019-11-16 07:11:00'),
(41, 'HideRealEstate', '2019-11-16 07:13:09', '2019-11-16 07:13:09'),
(42, 'unHideRealEstate', '2019-11-16 07:13:16', '2019-11-16 07:13:16'),
(43, 'addNotificationListener', '2019-11-16 08:33:02', '2019-11-16 08:33:02'),
(44, 'seenRealEstate', '2019-11-16 12:06:09', '2019-11-16 12:06:09'),
(45, 'getNumberOfNotification', '2019-11-16 20:32:34', '2019-11-16 20:32:34'),
(46, 'getNotificationList', '2019-11-16 20:32:36', '2019-11-16 20:32:36'),
(47, 'register', '2019-11-17 19:30:21', '2019-11-17 19:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `costmeasures`
--

CREATE TABLE `costmeasures` (
  `id` int(10) UNSIGNED NOT NULL,
  `measureName` varchar(55) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costmeasures`
--

INSERT INTO `costmeasures` (`id`, `measureName`, `created_at`, `updated_at`) VALUES
(1, 'Syrian pounds', '2019-11-13 06:58:30', '2019-11-13 06:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `realEstate_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(55) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `realEstate_id`, `name`, `created_at`, `updated_at`) VALUES
(111, 70, '1.png', '2019-11-14 10:20:14', '2019-11-14 10:20:14'),
(112, 70, '2.png', '2019-11-14 10:20:14', '2019-11-14 10:20:14'),
(113, 71, '1.png', '2019-11-14 10:21:58', '2019-11-14 10:21:58'),
(114, 71, '2.png', '2019-11-14 10:21:58', '2019-11-14 10:21:58'),
(115, 72, '1.png', '2019-11-14 10:22:00', '2019-11-14 10:22:00'),
(116, 72, '2.png', '2019-11-14 10:22:00', '2019-11-14 10:22:00'),
(117, 73, '1.png', '2019-11-14 10:22:02', '2019-11-14 10:22:02'),
(118, 73, '2.png', '2019-11-14 10:22:02', '2019-11-14 10:22:02'),
(119, 74, '1.png', '2019-11-14 10:22:15', '2019-11-14 10:22:15'),
(120, 74, '2.png', '2019-11-14 10:22:15', '2019-11-14 10:22:15'),
(121, 75, '1.png', '2019-11-14 10:23:06', '2019-11-14 10:23:06'),
(122, 75, '2.png', '2019-11-14 10:23:06', '2019-11-14 10:23:06'),
(123, 76, '1.png', '2019-11-14 10:24:20', '2019-11-14 10:24:20'),
(124, 76, '2.png', '2019-11-14 10:24:20', '2019-11-14 10:24:20'),
(125, 77, '1.png', '2019-11-14 10:25:27', '2019-11-14 10:25:27'),
(126, 77, '2.png', '2019-11-14 10:25:27', '2019-11-14 10:25:27'),
(127, 78, '1.png', '2019-11-14 10:28:18', '2019-11-14 10:28:18'),
(128, 78, '2.png', '2019-11-14 10:28:18', '2019-11-14 10:28:18'),
(129, 79, '1.png', '2019-11-14 10:28:42', '2019-11-14 10:28:42'),
(130, 79, '2.png', '2019-11-14 10:28:42', '2019-11-14 10:28:42'),
(131, 80, '1.png', '2019-11-14 10:29:28', '2019-11-14 10:29:28'),
(132, 80, '2.png', '2019-11-14 10:29:28', '2019-11-14 10:29:28'),
(133, 81, '1.png', '2019-11-14 10:30:32', '2019-11-14 10:30:32'),
(134, 81, '2.png', '2019-11-14 10:30:32', '2019-11-14 10:30:32'),
(135, 82, '1.png', '2019-11-14 10:30:37', '2019-11-14 10:30:37'),
(136, 82, '2.png', '2019-11-14 10:30:37', '2019-11-14 10:30:37'),
(137, 83, '1.png', '2019-11-15 06:55:39', '2019-11-15 06:55:39'),
(138, 83, '2.png', '2019-11-15 06:55:39', '2019-11-15 06:55:39'),
(139, 84, '', '2019-11-16 09:19:37', '2019-11-16 09:19:37'),
(140, 85, '', '2019-11-16 09:28:20', '2019-11-16 09:28:20'),
(141, 86, '', '2019-11-16 09:28:42', '2019-11-16 09:28:42'),
(142, 87, '', '2019-11-16 09:31:10', '2019-11-16 09:31:10'),
(143, 88, '', '2019-11-16 09:31:50', '2019-11-16 09:31:50'),
(144, 89, '', '2019-11-16 09:31:54', '2019-11-16 09:31:54'),
(145, 90, '', '2019-11-16 09:32:11', '2019-11-16 09:32:11'),
(146, 91, '', '2019-11-16 09:32:25', '2019-11-16 09:32:25'),
(147, 92, '', '2019-11-16 09:47:55', '2019-11-16 09:47:55'),
(148, 93, '', '2019-11-16 09:48:05', '2019-11-16 09:48:05'),
(149, 94, '', '2019-11-16 09:49:43', '2019-11-16 09:49:43'),
(150, 95, '', '2019-11-16 09:49:49', '2019-11-16 09:49:49'),
(151, 96, '', '2019-11-16 09:50:08', '2019-11-16 09:50:08'),
(152, 97, '', '2019-11-16 09:52:45', '2019-11-16 09:52:45'),
(153, 98, '', '2019-11-16 09:52:59', '2019-11-16 09:52:59'),
(154, 99, '', '2019-11-16 09:53:31', '2019-11-16 09:53:31'),
(155, 100, '', '2019-11-16 09:53:39', '2019-11-16 09:53:39'),
(156, 101, '', '2019-11-16 09:56:44', '2019-11-16 09:56:44'),
(157, 102, '', '2019-11-16 10:01:48', '2019-11-16 10:01:48'),
(158, 103, '', '2019-11-16 10:09:16', '2019-11-16 10:09:16'),
(159, 104, '', '2019-11-16 10:17:22', '2019-11-16 10:17:22'),
(160, 105, '', '2019-11-16 11:33:28', '2019-11-16 11:33:28'),
(161, 106, '', '2019-11-16 11:33:42', '2019-11-16 11:33:42'),
(162, 107, '', '2019-11-16 11:38:07', '2019-11-16 11:38:07'),
(163, 108, '', '2019-11-16 11:38:41', '2019-11-16 11:38:41'),
(164, 109, '', '2019-11-16 11:41:08', '2019-11-16 11:41:08'),
(165, 110, '', '2019-11-16 11:41:17', '2019-11-16 11:41:17'),
(166, 111, '', '2019-11-16 11:42:28', '2019-11-16 11:42:28'),
(167, 112, '', '2019-11-16 11:48:01', '2019-11-16 11:48:01'),
(168, 113, '', '2019-11-16 11:48:27', '2019-11-16 11:48:27'),
(169, 114, '', '2019-11-16 11:51:13', '2019-11-16 11:51:13'),
(170, 115, '', '2019-11-16 11:52:17', '2019-11-16 11:52:17'),
(171, 116, '', '2019-11-16 11:54:38', '2019-11-16 11:54:38'),
(172, 117, '', '2019-11-16 11:55:27', '2019-11-16 11:55:27'),
(173, 118, '', '2019-11-16 11:55:39', '2019-11-16 11:55:39'),
(174, 119, '', '2019-11-16 11:57:31', '2019-11-16 11:57:31'),
(175, 120, '', '2019-11-16 11:59:36', '2019-11-16 11:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `realEstate_id` int(10) UNSIGNED DEFAULT NULL,
  `type` int(5) DEFAULT NULL,
  `deleted` int(2) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `realEstate_id`, `type`, `deleted`, `updated_at`, `created_at`) VALUES
(34, 83, 1, 0, '2019-11-15 14:08:31', '2019-11-15 13:39:02'),
(41, 83, 1, 0, '2019-11-15 16:08:18', '2019-11-15 16:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `action_id` int(10) UNSIGNED DEFAULT NULL,
  `requestBody` varchar(500) DEFAULT NULL,
  `requestHeader` varchar(255) DEFAULT NULL,
  `device_id` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `code` int(5) DEFAULT NULL,
  `Msg` varchar(255) DEFAULT NULL,
  `delay_time` double DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action_id`, `requestBody`, `requestHeader`, `device_id`, `ip`, `code`, `Msg`, `delay_time`, `updated_at`, `created_at`) VALUES
(36, 34, 28, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"loggedIn\",\"size\":\"100\",\"size_id\":\"1\",\"roomNum\":\"5\",\"cost\":\"500000\",\"coste_id\":\"1\",\"description\":\"nice house\",\"available\":\"1\",\"phones\":\"0930451133&0993995987\",\"images\":\"1.png&2.png\",\"site_id\":\"65\",\"user_id\":34,\"realEstate_id\":79,\"GSM\":\"0993995987\",\"name\":\"2.png\"}', '[\"multipart\\/form-data; boundary=--------------------------863071674574545680404349\"]', NULL, NULL, 200, 'RealEstate has been added successfuly', 0, '2019-11-14 10:28:42', '2019-11-14 10:28:42'),
(37, 34, 28, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"loggedIn\",\"size\":\"100\",\"size_id\":\"1\",\"roomNum\":\"5\",\"cost\":\"500000\",\"coste_id\":\"1\",\"description\":\"nice house\",\"available\":\"1\",\"phones\":\"0930451133&0993995987\",\"images\":\"1.png&2.png\",\"site_id\":\"65\",\"user_id\":34,\"realEstate_id\":82,\"GSM\":\"0993995987\",\"name\":\"2.png\"}', '[\"multipart\\/form-data; boundary=--------------------------152335131622887084020523\"]', NULL, NULL, 200, 'RealEstate has been added successfuly', 0.049176931381225586, '2019-11-14 10:30:38', '2019-11-14 10:30:38'),
(38, 34, 28, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"loggedIn\",\"size\":\"100\",\"size_id\":\"1\",\"roomNum\":\"5\",\"cost\":\"500000\",\"coste_id\":\"1\",\"description\":\"nice house\",\"available\":\"1\",\"phones\":\"0930451133&0993995987\",\"images\":\"1.png&2.png\",\"site_id\":\"65\",\"user_id\":34,\"realEstate_id\":83,\"GSM\":\"0993995987\",\"name\":\"2.png\"}', '[\"multipart\\/form-data; boundary=--------------------------704551105981553530144428\"]', NULL, NULL, 200, 'RealEstate has been added successfuly', 0.6001389026641846, '2019-11-15 06:55:39', '2019-11-15 06:55:39'),
(39, NULL, 28, '[]', '[\"application\\/json\"]', NULL, NULL, 200, 'success!', 0.006371974945068359, '2019-11-15 06:58:42', '2019-11-15 06:58:42'),
(40, 34, 28, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------405128319873883801302426\"]', NULL, NULL, 200, 'success!', 0.011693000793457031, '2019-11-15 06:59:51', '2019-11-15 06:59:51'),
(41, 34, 10, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------821341765182039518030872\"]', NULL, NULL, 200, 'success!', 0.010215997695922852, '2019-11-15 07:00:13', '2019-11-15 07:00:13'),
(42, 34, 15, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------769090083004310607137723\"]', NULL, NULL, 200, 'success!', 0.6382551193237305, '2019-11-15 07:33:49', '2019-11-15 07:33:49'),
(43, 0, 4, '{\"username\":\"Abode\",\"verificationcode\":\"653861\",\"verificationType\":1,\"newpassword\":null}', '[\"multipart\\/form-data; boundary=--------------------------850879534784546335873620\"]', NULL, NULL, 400, '', 0.01800394058227539, '2019-11-15 11:31:41', '2019-11-15 11:31:41'),
(44, 0, 4, '{\"username\":\"Abode\",\"verificationcode\":\"653861\",\"verificationType\":1,\"newpassword\":null}', '[\"multipart\\/form-data; boundary=--------------------------619936639534655939512228\"]', NULL, NULL, 400, '', 0.01193094253540039, '2019-11-15 11:36:28', '2019-11-15 11:36:28'),
(45, 0, 4, '{\"username\":\"Abode\",\"verificationcode\":\"653861\",\"verificationType\":1,\"newpassword\":null}', '[\"multipart\\/form-data; boundary=--------------------------505865515870727383365271\"]', NULL, NULL, 400, 'there are no availble VerificationCode for this user!', 0.014784097671508789, '2019-11-15 11:37:53', '2019-11-15 11:37:53'),
(46, 34, 35, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"type\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------924046116587205620362565\"]', NULL, NULL, 200, 'success!', 0.015105009078979492, '2019-11-15 12:57:15', '2019-11-15 12:57:15'),
(47, 34, 35, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"type\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------769233494108968379840412\"]', NULL, NULL, 200, 'success!', 0.017166852951049805, '2019-11-15 13:06:57', '2019-11-15 13:06:57'),
(48, 34, 35, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"type\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------520937400191547469072370\"]', NULL, NULL, 400, 'you have add likes to this realEstate before!', 0.02179694175720215, '2019-11-15 13:33:34', '2019-11-15 13:33:34'),
(49, 34, 35, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"type\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------561693114024102029639889\"]', NULL, NULL, 200, 'success!', 0.020862102508544922, '2019-11-15 13:39:02', '2019-11-15 13:39:02'),
(50, 34, 35, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"type\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------050557143428202656928652\"]', NULL, NULL, 400, 'you have add likes to this realEstate before!', 0.00981903076171875, '2019-11-15 13:39:09', '2019-11-15 13:39:09'),
(51, 34, 36, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------204457070300657055166189\"]', NULL, NULL, 200, 'success!', 0.020851850509643555, '2019-11-15 13:39:58', '2019-11-15 13:39:58'),
(52, 34, 36, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------043853052586360944149353\"]', NULL, NULL, 200, 'success!', 0.12577104568481445, '2019-11-15 13:55:42', '2019-11-15 13:55:42'),
(53, 34, 36, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------186527197737306901846745\"]', NULL, NULL, 200, 'you have been disliked successfuly!', 0.01781916618347168, '2019-11-15 13:58:57', '2019-11-15 13:58:57'),
(54, 34, 36, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------044185134517743851154725\"]', NULL, NULL, 200, 'you have been disliked successfuly!', 0.12253189086914062, '2019-11-15 14:00:17', '2019-11-15 14:00:17'),
(55, 34, 36, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------446884162837317797548281\"]', NULL, NULL, 200, 'you have been disliked successfuly!', 0.016560077667236328, '2019-11-15 14:00:45', '2019-11-15 14:00:45'),
(56, 34, 35, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"type\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------825218627907536293421040\"]', NULL, NULL, 200, 'you have been like successfuly!', 0.01793503761291504, '2019-11-15 14:01:22', '2019-11-15 14:01:22'),
(57, 34, 36, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------325099939785697685419014\"]', NULL, NULL, 200, 'you have been disliked successfuly!', 0.01578211784362793, '2019-11-15 14:01:30', '2019-11-15 14:01:30'),
(58, 34, 35, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"83\",\"type\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------218768740084054242527596\"]', NULL, NULL, 200, 'you have been like successfuly!', 0.030352115631103516, '2019-11-15 14:08:31', '2019-11-15 14:08:31'),
(59, 0, 35, '{\"realEstate_id\":\"83\"}', '[\"multipart\\/form-data; boundary=--------------------------319000681532659050774666\"]', NULL, NULL, 200, 'success!', 0.01755690574645996, '2019-11-15 14:11:58', '2019-11-15 14:11:58'),
(60, 0, 37, '{\"realEstate_id\":\"83\"}', '[\"multipart\\/form-data; boundary=--------------------------849724431320099235940074\"]', NULL, NULL, 200, 'success!', 0.012750864028930664, '2019-11-15 14:19:20', '2019-11-15 14:19:20'),
(61, 0, 37, '{\"realEstate_id\":\"83\"}', '[\"multipart\\/form-data; boundary=--------------------------122139303663799631312815\"]', NULL, NULL, 200, 'success!', 0.01992511749267578, '2019-11-15 14:20:34', '2019-11-15 14:20:34'),
(62, 0, 38, '{\"realEstate_id\":\"83\"}', '[\"multipart\\/form-data; boundary=--------------------------149278964055342312107641\"]', NULL, NULL, 200, 'success!', 0.006730794906616211, '2019-11-15 14:21:37', '2019-11-15 14:21:37'),
(63, 34, 39, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------084247344653397274939120\"]', NULL, NULL, 200, 'RealEstate has been hard deleted!', 0.06082606315612793, '2019-11-15 15:37:58', '2019-11-15 15:37:58'),
(64, 34, 39, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"realEstate_id\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------358550626690295471399206\"]', NULL, NULL, 200, 'RealEstate has been hard deleted!', 0.7352449893951416, '2019-11-15 15:41:10', '2019-11-15 15:41:10'),
(65, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------667193568163114716362306\"]', NULL, NULL, 200, 'RealEstate has been added successfuly', 0.02052593231201172, '2019-11-15 15:53:28', '2019-11-15 15:53:28'),
(66, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------286167468372265920408685\"]', NULL, NULL, 200, 'RealEstate has been added successfuly', 0.01957988739013672, '2019-11-15 15:53:55', '2019-11-15 15:53:55'),
(67, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------192978804431174197462585\"]', NULL, NULL, 200, 'RealEstate has been added successfuly', 0.0060122013092041016, '2019-11-15 15:54:11', '2019-11-15 15:54:11'),
(68, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------755887974291038670790264\"]', NULL, NULL, 200, 'RealEstate has been added successfuly', 0.0077250003814697266, '2019-11-15 15:54:20', '2019-11-15 15:54:20'),
(69, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------375358047729065867628590\"]', NULL, NULL, 200, 'RealEstate has been added successfuly', 0.016981840133666992, '2019-11-15 15:54:30', '2019-11-15 15:54:30'),
(70, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------639311548390476465876980\"]', NULL, NULL, 200, 'RealEstate has been added successfuly', 0.005738019943237305, '2019-11-15 15:54:52', '2019-11-15 15:54:52'),
(71, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------487740116887485500670014\"]', NULL, NULL, 200, 'success!', 0.005888938903808594, '2019-11-15 15:55:49', '2019-11-15 15:55:49'),
(72, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------158370076666787433375318\"]', NULL, NULL, 200, 'success!', 0.016257047653198242, '2019-11-15 15:56:14', '2019-11-15 15:56:14'),
(73, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------603289815113657942138960\"]', NULL, NULL, 200, 'success!', 0.016459941864013672, '2019-11-15 15:56:33', '2019-11-15 15:56:33'),
(74, 0, 28, '{\"site_id\":\"49\",\"offset\":\"1\",\"roomNum\":null,\"size\":null,\"size_id\":null,\"cost\":null,\"coste_id\":null}', '[\"multipart\\/form-data; boundary=--------------------------720772196817487822412294\"]', NULL, NULL, 200, 'success!', 0.007953166961669922, '2019-11-15 15:56:38', '2019-11-15 15:56:38'),
(75, 34, 40, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"none\",\"realEstate_id\":\"70\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------292305870501380783663814\"]', NULL, NULL, 200, 'RealEstate has been deleted successfuly', 0.40697193145751953, '2019-11-16 07:11:00', '2019-11-16 07:11:00'),
(76, 34, 41, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"none\",\"realEstate_id\":\"70\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------237658581278713860849054\"]', NULL, NULL, 200, 'RealEstate has been hidden successfuly', 0.14096999168395996, '2019-11-16 07:13:09', '2019-11-16 07:13:09'),
(77, 34, 42, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"none\",\"realEstate_id\":\"70\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------025074695146320194009446\"]', NULL, NULL, 200, 'RealEstate has been unhidden successfuly', 0.02856898307800293, '2019-11-16 07:13:16', '2019-11-16 07:13:16'),
(78, 34, 43, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"none\",\"site_id\":\"49\",\"roomNum1\":null,\"roomNum2\":\"3\",\"m_cost\":\"1\",\"cost1\":null,\"cost2\":\"2000\",\"m_size\":\"1\",\"size1\":null,\"size2\":\"500\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------811485142104687020625902\"]', NULL, NULL, 200, 'event listener has been added successfuly!', 0.018640995025634766, '2019-11-16 08:33:02', '2019-11-16 08:33:02'),
(79, 34, 43, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"none\",\"site_id\":\"49\",\"roomNum1\":null,\"roomNum2\":\"3\",\"m_cost\":\"1\",\"cost1\":null,\"cost2\":\"2000\",\"m_size\":\"1\",\"size1\":null,\"size2\":\"500\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------637340029912547689198801\"]', NULL, NULL, 200, 'event listener has been added successfuly!', 0.032446861267089844, '2019-11-16 08:33:19', '2019-11-16 08:33:19'),
(80, 34, 43, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"none\",\"site_id\":\"49\",\"roomNum1\":null,\"roomNum2\":\"3\",\"m_cost\":\"1\",\"cost1\":null,\"cost2\":\"2000\",\"m_size\":\"1\",\"size1\":null,\"size2\":\"500\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------613631035862261944424841\"]', NULL, NULL, 200, 'event listener has been added successfuly!', 0.019234180450439453, '2019-11-16 08:33:34', '2019-11-16 08:33:34'),
(81, 34, 43, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"none\",\"site_id\":\"49\",\"roomNum1\":null,\"roomNum2\":\"3\",\"m_cost\":\"1\",\"cost1\":null,\"cost2\":\"2000\",\"m_size\":\"1\",\"size1\":null,\"size2\":\"500\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------732941543426551104756030\"]', NULL, NULL, 200, 'event listener has been added successfuly!', 0.015945911407470703, '2019-11-16 08:33:59', '2019-11-16 08:33:59'),
(82, 34, 43, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"none\",\"site_id\":\"49\",\"roomNum1\":\"1\",\"roomNum2\":\"3\",\"m_cost\":\"1\",\"cost1\":\"500\",\"cost2\":\"2000\",\"m_size\":\"1\",\"size1\":\"100\",\"size2\":\"500\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------970338773347714914794407\"]', NULL, NULL, 200, 'event listener has been added successfuly!', 0.029072046279907227, '2019-11-16 08:35:08', '2019-11-16 08:35:08'),
(83, 34, 43, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"none\",\"site_id\":\"49\",\"roomNum1\":\"1\",\"roomNum2\":\"3\",\"m_cost\":\"1\",\"cost1\":\"500\",\"cost2\":\"2000\",\"m_size\":\"1\",\"size1\":\"100\",\"size2\":\"500\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------689436205999998775722083\"]', NULL, NULL, 200, 'event listener has been added successfuly!', 0.029009103775024414, '2019-11-16 08:39:54', '2019-11-16 08:39:54'),
(84, 34, 28, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"loggedIn\",\"size\":\"400\",\"size_id\":\"1\",\"roomNum\":\"2\",\"cost\":\"1500\",\"coste_id\":\"1\",\"description\":\"hey\",\"phones\":\"0930451133&0993995987\",\"site_id\":\"51\",\"user_id\":34,\"realEstate_id\":109,\"GSM\":\"0993995987\",\"name\":\"\"}', '[\"multipart\\/form-data; boundary=--------------------------387159678194351309091118\"]', NULL, NULL, 200, 'RealEstate has been Added successfuly', 0.04206204414367676, '2019-11-16 11:41:08', '2019-11-16 11:41:08'),
(85, 34, 28, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"actionName\":\"loggedIn\",\"size\":\"400\",\"size_id\":\"1\",\"roomNum\":\"2\",\"cost\":\"1500\",\"coste_id\":\"1\",\"description\":\"hey\",\"phones\":\"0930451133&0993995987\",\"site_id\":\"51\",\"user_id\":34,\"realEstate_id\":120,\"GSM\":\"0993995987\",\"name\":\"\"}', '[\"multipart\\/form-data; boundary=--------------------------861636468476939566232342\"]', NULL, NULL, 200, 'RealEstate has been Added successfuly', 0.0610501766204834, '2019-11-16 11:59:36', '2019-11-16 11:59:36'),
(86, 34, 44, '{\"sessionkey\":\"1ae85075ea0c3f64f883c77a8d0a617c\",\"notification_id\":\"1\",\"user_id\":34}', '[\"multipart\\/form-data; boundary=--------------------------546077786286910806594983\"]', NULL, NULL, 200, 'RealEstate has been seen successfuly', 0.015100955963134766, '2019-11-16 12:06:09', '2019-11-16 12:06:09'),
(87, 0, 1, '{\"username\":\"aaaa\",\"password\":\"1234\"}', '[\"multipart\\/form-data; boundary=--------------------------658048544175246690851554\"]', NULL, NULL, 200, 'welcome', 0.2405838966369629, '2019-11-16 20:29:14', '2019-11-16 20:29:14'),
(88, 41, 43, '{\"sessionkey\":\"1901fb6e7b59c20b22fa83ee96b355f0\",\"user_id\":41}', '[\"multipart\\/form-data; boundary=--------------------------847550339789269680714054\"]', NULL, NULL, 200, 'event listener has been added successfuly!', 0.009119033813476562, '2019-11-16 20:31:26', '2019-11-16 20:31:26'),
(89, 41, 43, '{\"sessionkey\":\"1901fb6e7b59c20b22fa83ee96b355f0\",\"user_id\":41}', '[\"multipart\\/form-data; boundary=--------------------------187929901808407505549624\"]', NULL, NULL, 200, 'event listener has been added successfuly!', 0.009019136428833008, '2019-11-16 20:31:30', '2019-11-16 20:31:30'),
(90, 41, 45, '{\"sessionkey\":\"1901fb6e7b59c20b22fa83ee96b355f0\",\"user_id\":41}', '[\"multipart\\/form-data; boundary=--------------------------835244350816542674920697\"]', NULL, NULL, 200, 'success!', 0.12520289421081543, '2019-11-16 20:32:34', '2019-11-16 20:32:34'),
(91, 41, 46, '{\"sessionkey\":\"1901fb6e7b59c20b22fa83ee96b355f0\",\"user_id\":41}', '[\"multipart\\/form-data; boundary=--------------------------618719625059168247991410\"]', NULL, NULL, 200, 'success!', 0.010535001754760742, '2019-11-16 20:32:36', '2019-11-16 20:32:36'),
(92, 0, 47, '{\"username\":\"mhde7yfgjkhok\",\"firstName\":\"kjgkgkj\",\"lastName\":\"kjhkjh\",\"email\":\"kguihf@kjh.com\",\"bornDate\":\"1997-09-15\",\"phone\":\"0987654329\",\"image\":\"image1.jpg\",\"password\":\"123456\"}', '[\"multipart\\/form-data; boundary=--------------------------847935003004846977582696\"]', NULL, NULL, 200, 'you have been registered successfuly', 0.6249940395355225, '2019-11-17 19:30:21', '2019-11-17 19:30:21'),
(93, 0, 47, '{\"username\":\"mhde7yfgjkhok\",\"firstName\":\"kjgkgkj\",\"lastName\":\"kjhkjh\",\"email\":\"kguihf@kjh.com\",\"bornDate\":\"1997-09-15\",\"phone\":\"09876543\",\"image\":\"image1.jpg\",\"password\":\"123456\"}', '[\"multipart\\/form-data; boundary=--------------------------134320167724257336720221\"]', NULL, NULL, 400, 'username exist', 0.3978688716888428, '2019-11-17 20:03:07', '2019-11-17 20:03:07'),
(94, 0, 47, '{\"username\":\"mhde7yfttgjkhok\",\"firstName\":\"kjgkgkjtt\",\"lastName\":\"kjhkjhtt\",\"email\":\"kguitthf@kjh.com\",\"bornDate\":\"1997-09-15\",\"phone\":\"09876543\",\"image\":\"image1.jpg\",\"password\":\"123456\"}', '[\"multipart\\/form-data; boundary=--------------------------216930287946317673766033\"]', NULL, NULL, 200, 'you have been registered successfuly', 0.5516040325164795, '2019-11-17 20:03:34', '2019-11-17 20:03:34'),
(95, 0, 47, '{\"username\":\"mhde7yfttgjkhok\",\"firstName\":\"kjgkgkjtt\",\"lastName\":\"kjhkjhtt\",\"email\":\"kguitthf@kjh.com\",\"bornDate\":\"1997-09-15\",\"phone\":\"09876543\",\"image\":\"image1.jpg\",\"password\":\"123456\"}', '[\"multipart\\/form-data; boundary=--------------------------117101542631186935735396\"]', NULL, NULL, 200, 'you have been registered successfuly', 0.0581049919128418, '2019-11-17 20:08:04', '2019-11-17 20:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `measure_costes`
--

CREATE TABLE `measure_costes` (
  `coste_id` int(10) UNSIGNED DEFAULT NULL,
  `realEstate_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `measure_costes`
--

INSERT INTO `measure_costes` (`coste_id`, `realEstate_id`, `created_at`, `updated_at`) VALUES
(1, 70, '2019-11-14 10:20:14', '2019-11-14 10:20:14'),
(1, 71, '2019-11-14 10:21:58', '2019-11-14 10:21:58'),
(1, 72, '2019-11-14 10:22:00', '2019-11-14 10:22:00'),
(1, 73, '2019-11-14 10:22:02', '2019-11-14 10:22:02'),
(1, 74, '2019-11-14 10:22:15', '2019-11-14 10:22:15'),
(1, 75, '2019-11-14 10:23:06', '2019-11-14 10:23:06'),
(1, 76, '2019-11-14 10:24:20', '2019-11-14 10:24:20'),
(1, 77, '2019-11-14 10:25:27', '2019-11-14 10:25:27'),
(1, 78, '2019-11-14 10:28:18', '2019-11-14 10:28:18'),
(1, 79, '2019-11-14 10:28:42', '2019-11-14 10:28:42'),
(1, 80, '2019-11-14 10:29:28', '2019-11-14 10:29:28'),
(1, 81, '2019-11-14 10:30:32', '2019-11-14 10:30:32'),
(1, 82, '2019-11-14 10:30:37', '2019-11-14 10:30:37'),
(1, 83, '2019-11-15 06:55:39', '2019-11-15 06:55:39'),
(1, 84, '2019-11-16 09:19:37', '2019-11-16 09:19:37'),
(1, 85, '2019-11-16 09:28:20', '2019-11-16 09:28:20'),
(1, 86, '2019-11-16 09:28:42', '2019-11-16 09:28:42'),
(1, 87, '2019-11-16 09:31:10', '2019-11-16 09:31:10'),
(1, 88, '2019-11-16 09:31:50', '2019-11-16 09:31:50'),
(1, 89, '2019-11-16 09:31:54', '2019-11-16 09:31:54'),
(1, 90, '2019-11-16 09:32:11', '2019-11-16 09:32:11'),
(1, 91, '2019-11-16 09:32:25', '2019-11-16 09:32:25'),
(1, 92, '2019-11-16 09:47:55', '2019-11-16 09:47:55'),
(1, 93, '2019-11-16 09:48:05', '2019-11-16 09:48:05'),
(1, 94, '2019-11-16 09:49:43', '2019-11-16 09:49:43'),
(1, 95, '2019-11-16 09:49:49', '2019-11-16 09:49:49'),
(1, 96, '2019-11-16 09:50:08', '2019-11-16 09:50:08'),
(1, 97, '2019-11-16 09:52:45', '2019-11-16 09:52:45'),
(1, 98, '2019-11-16 09:52:59', '2019-11-16 09:52:59'),
(1, 99, '2019-11-16 09:53:31', '2019-11-16 09:53:31'),
(1, 100, '2019-11-16 09:53:39', '2019-11-16 09:53:39'),
(1, 101, '2019-11-16 09:56:44', '2019-11-16 09:56:44'),
(1, 102, '2019-11-16 10:01:48', '2019-11-16 10:01:48'),
(1, 103, '2019-11-16 10:09:16', '2019-11-16 10:09:16'),
(1, 104, '2019-11-16 10:17:22', '2019-11-16 10:17:22'),
(1, 105, '2019-11-16 11:33:28', '2019-11-16 11:33:28'),
(1, 106, '2019-11-16 11:33:42', '2019-11-16 11:33:42'),
(1, 107, '2019-11-16 11:38:07', '2019-11-16 11:38:07'),
(1, 108, '2019-11-16 11:38:41', '2019-11-16 11:38:41'),
(1, 109, '2019-11-16 11:41:08', '2019-11-16 11:41:08'),
(1, 110, '2019-11-16 11:41:17', '2019-11-16 11:41:17'),
(1, 111, '2019-11-16 11:42:28', '2019-11-16 11:42:28'),
(1, 112, '2019-11-16 11:48:01', '2019-11-16 11:48:01'),
(1, 113, '2019-11-16 11:48:27', '2019-11-16 11:48:27'),
(1, 114, '2019-11-16 11:51:13', '2019-11-16 11:51:13'),
(1, 115, '2019-11-16 11:52:17', '2019-11-16 11:52:17'),
(1, 116, '2019-11-16 11:54:38', '2019-11-16 11:54:38'),
(1, 117, '2019-11-16 11:55:27', '2019-11-16 11:55:27'),
(1, 118, '2019-11-16 11:55:39', '2019-11-16 11:55:39'),
(1, 119, '2019-11-16 11:57:31', '2019-11-16 11:57:31'),
(1, 120, '2019-11-16 11:59:36', '2019-11-16 11:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `measure_sizes`
--

CREATE TABLE `measure_sizes` (
  `realEstate_id` int(10) UNSIGNED DEFAULT NULL,
  `size_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `measure_sizes`
--

INSERT INTO `measure_sizes` (`realEstate_id`, `size_id`, `created_at`, `updated_at`) VALUES
(70, 1, '2019-11-14 10:20:14', '2019-11-14 10:20:14'),
(71, 1, '2019-11-14 10:21:58', '2019-11-14 10:21:58'),
(72, 1, '2019-11-14 10:22:00', '2019-11-14 10:22:00'),
(73, 1, '2019-11-14 10:22:02', '2019-11-14 10:22:02'),
(74, 1, '2019-11-14 10:22:15', '2019-11-14 10:22:15'),
(75, 1, '2019-11-14 10:23:06', '2019-11-14 10:23:06'),
(76, 1, '2019-11-14 10:24:20', '2019-11-14 10:24:20'),
(77, 1, '2019-11-14 10:25:27', '2019-11-14 10:25:27'),
(78, 1, '2019-11-14 10:28:18', '2019-11-14 10:28:18'),
(79, 1, '2019-11-14 10:28:42', '2019-11-14 10:28:42'),
(80, 1, '2019-11-14 10:29:28', '2019-11-14 10:29:28'),
(81, 1, '2019-11-14 10:30:32', '2019-11-14 10:30:32'),
(82, 1, '2019-11-14 10:30:37', '2019-11-14 10:30:37'),
(83, 1, '2019-11-15 06:55:39', '2019-11-15 06:55:39'),
(84, 1, '2019-11-16 09:19:37', '2019-11-16 09:19:37'),
(85, 1, '2019-11-16 09:28:20', '2019-11-16 09:28:20'),
(86, 1, '2019-11-16 09:28:42', '2019-11-16 09:28:42'),
(87, 1, '2019-11-16 09:31:10', '2019-11-16 09:31:10'),
(88, 1, '2019-11-16 09:31:50', '2019-11-16 09:31:50'),
(89, 1, '2019-11-16 09:31:54', '2019-11-16 09:31:54'),
(90, 1, '2019-11-16 09:32:11', '2019-11-16 09:32:11'),
(91, 1, '2019-11-16 09:32:25', '2019-11-16 09:32:25'),
(92, 1, '2019-11-16 09:47:55', '2019-11-16 09:47:55'),
(93, 1, '2019-11-16 09:48:05', '2019-11-16 09:48:05'),
(94, 1, '2019-11-16 09:49:43', '2019-11-16 09:49:43'),
(95, 1, '2019-11-16 09:49:49', '2019-11-16 09:49:49'),
(96, 1, '2019-11-16 09:50:08', '2019-11-16 09:50:08'),
(97, 1, '2019-11-16 09:52:45', '2019-11-16 09:52:45'),
(98, 1, '2019-11-16 09:52:59', '2019-11-16 09:52:59'),
(99, 1, '2019-11-16 09:53:31', '2019-11-16 09:53:31'),
(100, 1, '2019-11-16 09:53:39', '2019-11-16 09:53:39'),
(101, 1, '2019-11-16 09:56:44', '2019-11-16 09:56:44'),
(102, 1, '2019-11-16 10:01:48', '2019-11-16 10:01:48'),
(103, 1, '2019-11-16 10:09:16', '2019-11-16 10:09:16'),
(104, 1, '2019-11-16 10:17:22', '2019-11-16 10:17:22'),
(105, 1, '2019-11-16 11:33:28', '2019-11-16 11:33:28'),
(106, 1, '2019-11-16 11:33:42', '2019-11-16 11:33:42'),
(107, 1, '2019-11-16 11:38:07', '2019-11-16 11:38:07'),
(108, 1, '2019-11-16 11:38:42', '2019-11-16 11:38:42'),
(109, 1, '2019-11-16 11:41:08', '2019-11-16 11:41:08'),
(110, 1, '2019-11-16 11:41:17', '2019-11-16 11:41:17'),
(111, 1, '2019-11-16 11:42:28', '2019-11-16 11:42:28'),
(112, 1, '2019-11-16 11:48:01', '2019-11-16 11:48:01'),
(113, 1, '2019-11-16 11:48:27', '2019-11-16 11:48:27'),
(114, 1, '2019-11-16 11:51:13', '2019-11-16 11:51:13'),
(115, 1, '2019-11-16 11:52:17', '2019-11-16 11:52:17'),
(116, 1, '2019-11-16 11:54:38', '2019-11-16 11:54:38'),
(117, 1, '2019-11-16 11:55:27', '2019-11-16 11:55:27'),
(118, 1, '2019-11-16 11:55:39', '2019-11-16 11:55:39'),
(119, 1, '2019-11-16 11:57:31', '2019-11-16 11:57:31'),
(120, 1, '2019-11-16 11:59:36', '2019-11-16 11:59:36');

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
-- Table structure for table `notificationlisteners`
--

CREATE TABLE `notificationlisteners` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `site_id` int(10) UNSIGNED DEFAULT NULL,
  `m_size` int(10) UNSIGNED DEFAULT NULL,
  `size1` int(11) UNSIGNED DEFAULT NULL,
  `size2` int(11) UNSIGNED DEFAULT NULL,
  `m_cost` int(10) UNSIGNED DEFAULT NULL,
  `cost1` int(11) UNSIGNED DEFAULT NULL,
  `cost2` int(11) UNSIGNED DEFAULT NULL,
  `roomNum1` int(11) UNSIGNED DEFAULT NULL,
  `roomNum2` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notificationlisteners`
--

INSERT INTO `notificationlisteners` (`id`, `user_id`, `site_id`, `m_size`, `size1`, `size2`, `m_cost`, `cost1`, `cost2`, `roomNum1`, `roomNum2`, `created_at`, `updated_at`) VALUES
(1, 34, 49, 1, 100, 4294967295, 1, 1000, 4294967295, 2, 4294967295, '2019-11-16 08:30:56', '2019-11-16 08:30:56'),
(5, 34, 49, 1, 0, 500, 1, 0, 2000, 0, 3, '2019-11-16 08:33:59', '2019-11-16 08:33:59'),
(6, 34, 49, 1, 100, 500, 1, 500, 2000, 1, 3, '2019-11-16 08:35:08', '2019-11-16 08:35:08'),
(7, 41, 49, 1, 100, 4294967295, 1, 1000, 4294967295, 2, 4294967295, '2019-11-16 10:38:20', '2019-11-16 10:38:28'),
(8, 41, 49, 1, 0, 500, 1, 0, 2000, 0, 3, '2019-11-16 10:39:08', '2019-11-16 10:39:10'),
(9, 41, 49, 1, 100, 500, 1, 500, 2000, 1, 3, '2019-11-16 10:39:42', '2019-11-16 10:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `realEstate_id` int(10) UNSIGNED DEFAULT NULL,
  `seen` int(2) DEFAULT NULL,
  `seen_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `realEstate_id`, `seen`, `seen_at`, `created_at`, `updated_at`) VALUES
(1, 41, 120, 1, '2019-11-16 12:06:09', '2019-11-16 11:59:36', '2019-11-16 11:59:36');

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
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(10) UNSIGNED NOT NULL,
  `realEstate_id` int(10) UNSIGNED DEFAULT NULL,
  `GSM` int(22) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`id`, `realEstate_id`, `GSM`, `created_at`, `updated_at`) VALUES
(112, 70, 930451133, '2019-11-14 10:20:14', '2019-11-14 10:20:14'),
(113, 70, 993995987, '2019-11-14 10:20:14', '2019-11-14 10:20:14'),
(114, 71, 930451133, '2019-11-14 10:21:58', '2019-11-14 10:21:58'),
(115, 71, 993995987, '2019-11-14 10:21:58', '2019-11-14 10:21:58'),
(116, 72, 930451133, '2019-11-14 10:22:00', '2019-11-14 10:22:00'),
(117, 72, 993995987, '2019-11-14 10:22:00', '2019-11-14 10:22:00'),
(118, 73, 930451133, '2019-11-14 10:22:02', '2019-11-14 10:22:02'),
(119, 73, 993995987, '2019-11-14 10:22:02', '2019-11-14 10:22:02'),
(120, 74, 930451133, '2019-11-14 10:22:15', '2019-11-14 10:22:15'),
(121, 74, 993995987, '2019-11-14 10:22:15', '2019-11-14 10:22:15'),
(122, 75, 930451133, '2019-11-14 10:23:06', '2019-11-14 10:23:06'),
(123, 75, 993995987, '2019-11-14 10:23:06', '2019-11-14 10:23:06'),
(124, 76, 930451133, '2019-11-14 10:24:20', '2019-11-14 10:24:20'),
(125, 76, 993995987, '2019-11-14 10:24:20', '2019-11-14 10:24:20'),
(126, 77, 930451133, '2019-11-14 10:25:27', '2019-11-14 10:25:27'),
(127, 77, 993995987, '2019-11-14 10:25:27', '2019-11-14 10:25:27'),
(128, 78, 930451133, '2019-11-14 10:28:18', '2019-11-14 10:28:18'),
(129, 78, 993995987, '2019-11-14 10:28:18', '2019-11-14 10:28:18'),
(130, 79, 930451133, '2019-11-14 10:28:42', '2019-11-14 10:28:42'),
(131, 79, 993995987, '2019-11-14 10:28:42', '2019-11-14 10:28:42'),
(132, 80, 930451133, '2019-11-14 10:29:28', '2019-11-14 10:29:28'),
(133, 80, 993995987, '2019-11-14 10:29:28', '2019-11-14 10:29:28'),
(134, 81, 930451133, '2019-11-14 10:30:32', '2019-11-14 10:30:32'),
(135, 81, 993995987, '2019-11-14 10:30:32', '2019-11-14 10:30:32'),
(136, 82, 930451133, '2019-11-14 10:30:37', '2019-11-14 10:30:37'),
(137, 82, 993995987, '2019-11-14 10:30:37', '2019-11-14 10:30:37'),
(138, 83, 930451133, '2019-11-15 06:55:39', '2019-11-15 06:55:39'),
(139, 83, 993995987, '2019-11-15 06:55:39', '2019-11-15 06:55:39'),
(140, 84, 930451133, '2019-11-16 09:19:37', '2019-11-16 09:19:37'),
(141, 84, 993995987, '2019-11-16 09:19:37', '2019-11-16 09:19:37'),
(142, 85, 930451133, '2019-11-16 09:28:20', '2019-11-16 09:28:20'),
(143, 85, 993995987, '2019-11-16 09:28:20', '2019-11-16 09:28:20'),
(144, 86, 930451133, '2019-11-16 09:28:42', '2019-11-16 09:28:42'),
(145, 86, 993995987, '2019-11-16 09:28:42', '2019-11-16 09:28:42'),
(146, 87, 930451133, '2019-11-16 09:31:10', '2019-11-16 09:31:10'),
(147, 87, 993995987, '2019-11-16 09:31:10', '2019-11-16 09:31:10'),
(148, 88, 930451133, '2019-11-16 09:31:50', '2019-11-16 09:31:50'),
(149, 88, 993995987, '2019-11-16 09:31:50', '2019-11-16 09:31:50'),
(150, 89, 930451133, '2019-11-16 09:31:54', '2019-11-16 09:31:54'),
(151, 89, 993995987, '2019-11-16 09:31:54', '2019-11-16 09:31:54'),
(152, 90, 930451133, '2019-11-16 09:32:11', '2019-11-16 09:32:11'),
(153, 90, 993995987, '2019-11-16 09:32:11', '2019-11-16 09:32:11'),
(154, 91, 930451133, '2019-11-16 09:32:25', '2019-11-16 09:32:25'),
(155, 91, 993995987, '2019-11-16 09:32:25', '2019-11-16 09:32:25'),
(156, 92, 930451133, '2019-11-16 09:47:55', '2019-11-16 09:47:55'),
(157, 92, 993995987, '2019-11-16 09:47:55', '2019-11-16 09:47:55'),
(158, 93, 930451133, '2019-11-16 09:48:05', '2019-11-16 09:48:05'),
(159, 93, 993995987, '2019-11-16 09:48:05', '2019-11-16 09:48:05'),
(160, 94, 930451133, '2019-11-16 09:49:43', '2019-11-16 09:49:43'),
(161, 94, 993995987, '2019-11-16 09:49:43', '2019-11-16 09:49:43'),
(162, 95, 930451133, '2019-11-16 09:49:49', '2019-11-16 09:49:49'),
(163, 95, 993995987, '2019-11-16 09:49:49', '2019-11-16 09:49:49'),
(164, 96, 930451133, '2019-11-16 09:50:08', '2019-11-16 09:50:08'),
(165, 96, 993995987, '2019-11-16 09:50:08', '2019-11-16 09:50:08'),
(166, 97, 930451133, '2019-11-16 09:52:45', '2019-11-16 09:52:45'),
(167, 97, 993995987, '2019-11-16 09:52:45', '2019-11-16 09:52:45'),
(168, 98, 930451133, '2019-11-16 09:52:59', '2019-11-16 09:52:59'),
(169, 98, 993995987, '2019-11-16 09:52:59', '2019-11-16 09:52:59'),
(170, 99, 930451133, '2019-11-16 09:53:31', '2019-11-16 09:53:31'),
(171, 99, 993995987, '2019-11-16 09:53:31', '2019-11-16 09:53:31'),
(172, 100, 930451133, '2019-11-16 09:53:39', '2019-11-16 09:53:39'),
(173, 100, 993995987, '2019-11-16 09:53:39', '2019-11-16 09:53:39'),
(174, 101, 930451133, '2019-11-16 09:56:44', '2019-11-16 09:56:44'),
(175, 101, 993995987, '2019-11-16 09:56:44', '2019-11-16 09:56:44'),
(176, 102, 930451133, '2019-11-16 10:01:48', '2019-11-16 10:01:48'),
(177, 102, 993995987, '2019-11-16 10:01:48', '2019-11-16 10:01:48'),
(178, 103, 930451133, '2019-11-16 10:09:16', '2019-11-16 10:09:16'),
(179, 103, 993995987, '2019-11-16 10:09:16', '2019-11-16 10:09:16'),
(180, 104, 930451133, '2019-11-16 10:17:22', '2019-11-16 10:17:22'),
(181, 104, 993995987, '2019-11-16 10:17:22', '2019-11-16 10:17:22'),
(182, 105, 930451133, '2019-11-16 11:33:28', '2019-11-16 11:33:28'),
(183, 105, 993995987, '2019-11-16 11:33:28', '2019-11-16 11:33:28'),
(184, 106, 930451133, '2019-11-16 11:33:42', '2019-11-16 11:33:42'),
(185, 106, 993995987, '2019-11-16 11:33:42', '2019-11-16 11:33:42'),
(186, 107, 930451133, '2019-11-16 11:38:07', '2019-11-16 11:38:07'),
(187, 107, 993995987, '2019-11-16 11:38:07', '2019-11-16 11:38:07'),
(188, 108, 930451133, '2019-11-16 11:38:41', '2019-11-16 11:38:41'),
(189, 108, 993995987, '2019-11-16 11:38:41', '2019-11-16 11:38:41'),
(190, 109, 930451133, '2019-11-16 11:41:08', '2019-11-16 11:41:08'),
(191, 109, 993995987, '2019-11-16 11:41:08', '2019-11-16 11:41:08'),
(192, 110, 930451133, '2019-11-16 11:41:17', '2019-11-16 11:41:17'),
(193, 110, 993995987, '2019-11-16 11:41:17', '2019-11-16 11:41:17'),
(194, 111, 930451133, '2019-11-16 11:42:28', '2019-11-16 11:42:28'),
(195, 111, 993995987, '2019-11-16 11:42:28', '2019-11-16 11:42:28'),
(196, 112, 930451133, '2019-11-16 11:48:01', '2019-11-16 11:48:01'),
(197, 112, 993995987, '2019-11-16 11:48:01', '2019-11-16 11:48:01'),
(198, 113, 930451133, '2019-11-16 11:48:27', '2019-11-16 11:48:27'),
(199, 113, 993995987, '2019-11-16 11:48:27', '2019-11-16 11:48:27'),
(200, 114, 930451133, '2019-11-16 11:51:13', '2019-11-16 11:51:13'),
(201, 114, 993995987, '2019-11-16 11:51:13', '2019-11-16 11:51:13'),
(202, 115, 930451133, '2019-11-16 11:52:17', '2019-11-16 11:52:17'),
(203, 115, 993995987, '2019-11-16 11:52:17', '2019-11-16 11:52:17'),
(204, 116, 930451133, '2019-11-16 11:54:38', '2019-11-16 11:54:38'),
(205, 116, 993995987, '2019-11-16 11:54:38', '2019-11-16 11:54:38'),
(206, 117, 930451133, '2019-11-16 11:55:27', '2019-11-16 11:55:27'),
(207, 117, 993995987, '2019-11-16 11:55:27', '2019-11-16 11:55:27'),
(208, 118, 930451133, '2019-11-16 11:55:39', '2019-11-16 11:55:39'),
(209, 118, 993995987, '2019-11-16 11:55:39', '2019-11-16 11:55:39'),
(210, 119, 930451133, '2019-11-16 11:57:31', '2019-11-16 11:57:31'),
(211, 119, 993995987, '2019-11-16 11:57:31', '2019-11-16 11:57:31'),
(212, 120, 930451133, '2019-11-16 11:59:36', '2019-11-16 11:59:36'),
(213, 120, 993995987, '2019-11-16 11:59:36', '2019-11-16 11:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `realestates`
--

CREATE TABLE `realestates` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `roomNum` int(10) UNSIGNED NOT NULL,
  `cost` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `available` int(2) DEFAULT NULL,
  `deleted` int(2) DEFAULT '0',
  `hide` int(2) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realestates`
--

INSERT INTO `realestates` (`id`, `user_id`, `size`, `roomNum`, `cost`, `description`, `available`, `deleted`, `hide`, `created_at`, `updated_at`) VALUES
(70, 34, 100, 5, 500000, 'nice house14', 1, 1, 0, '2019-11-14 10:20:14', '2019-11-16 07:13:16'),
(71, 34, 100, 5, 500000, 'nice house13', 1, 0, 0, '2019-11-14 10:21:58', '2019-11-14 10:21:58'),
(72, 34, 100, 5, 500000, 'nice house12', 1, 0, 0, '2019-11-14 10:22:00', '2019-11-14 10:22:00'),
(73, 34, 100, 5, 500000, 'nice house11', 1, 0, 0, '2019-11-14 10:22:02', '2019-11-14 10:22:02'),
(74, 34, 100, 5, 500000, 'nice house10', 1, 0, 0, '2019-11-14 10:22:15', '2019-11-14 10:22:15'),
(75, 34, 100, 5, 500000, 'nice house9', 1, 0, 0, '2019-11-14 10:23:06', '2019-11-14 10:23:06'),
(76, 34, 100, 5, 500000, 'nice house8', 1, 0, 0, '2019-11-14 10:24:20', '2019-11-14 10:24:20'),
(77, 34, 100, 5, 500000, 'nice house7', 1, 0, 0, '2019-11-14 10:25:27', '2019-11-14 10:25:27'),
(78, 34, 100, 5, 500000, 'nice house6', 1, 0, 0, '2019-11-14 10:28:18', '2019-11-14 10:28:18'),
(79, 34, 100, 5, 500000, 'nice house5', 1, 0, 0, '2019-11-14 10:28:42', '2019-11-14 10:28:42'),
(80, 34, 100, 5, 500000, 'nice house4', 1, 0, 0, '2019-11-14 10:29:28', '2019-11-14 10:29:28'),
(81, 34, 100, 5, 500000, 'nice house3', 1, 0, 0, '2019-11-14 10:30:32', '2019-11-14 10:30:32'),
(82, 34, 100, 5, 500000, 'nice house2', 1, 0, 0, '2019-11-14 10:30:37', '2019-11-14 10:30:37'),
(83, 34, 100, 5, 500000, 'nice house1', 1, 0, 0, '2019-11-15 06:55:39', '2019-11-15 06:55:39'),
(84, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:19:37', '2019-11-16 09:19:37'),
(85, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:28:20', '2019-11-16 09:28:20'),
(86, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:28:42', '2019-11-16 09:28:42'),
(87, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:31:10', '2019-11-16 09:31:10'),
(88, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:31:50', '2019-11-16 09:31:50'),
(89, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:31:54', '2019-11-16 09:31:54'),
(90, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:32:11', '2019-11-16 09:32:11'),
(91, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:32:25', '2019-11-16 09:32:25'),
(92, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:47:55', '2019-11-16 09:47:55'),
(93, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:48:05', '2019-11-16 09:48:05'),
(94, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:49:43', '2019-11-16 09:49:43'),
(95, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:49:49', '2019-11-16 09:49:49'),
(96, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:50:08', '2019-11-16 09:50:08'),
(97, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:52:45', '2019-11-16 09:52:45'),
(98, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:52:59', '2019-11-16 09:52:59'),
(99, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:53:31', '2019-11-16 09:53:31'),
(100, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:53:39', '2019-11-16 09:53:39'),
(101, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 09:56:44', '2019-11-16 09:56:44'),
(102, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 10:01:48', '2019-11-16 10:01:48'),
(103, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 10:09:16', '2019-11-16 10:09:16'),
(104, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 10:17:22', '2019-11-16 10:17:22'),
(105, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 11:33:28', '2019-11-16 11:33:28'),
(106, 34, 600, 4, 2500, 'hey', 1, 0, 0, '2019-11-16 11:33:42', '2019-11-16 11:33:42'),
(107, 34, 600, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:38:07', '2019-11-16 11:38:07'),
(108, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:38:41', '2019-11-16 11:38:41'),
(109, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:41:08', '2019-11-16 11:41:08'),
(110, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:41:17', '2019-11-16 11:41:17'),
(111, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:42:28', '2019-11-16 11:42:28'),
(112, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:48:01', '2019-11-16 11:48:01'),
(113, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:48:27', '2019-11-16 11:48:27'),
(114, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:51:13', '2019-11-16 11:51:13'),
(115, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:52:17', '2019-11-16 11:52:17'),
(116, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:54:38', '2019-11-16 11:54:38'),
(117, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:55:27', '2019-11-16 11:55:27'),
(118, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:55:39', '2019-11-16 11:55:39'),
(119, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:57:31', '2019-11-16 11:57:31'),
(120, 34, 400, 2, 1500, 'hey', 1, 0, 0, '2019-11-16 11:59:36', '2019-11-16 11:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `realestate_sites`
--

CREATE TABLE `realestate_sites` (
  `realEstate_id` int(10) UNSIGNED DEFAULT NULL,
  `site_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realestate_sites`
--

INSERT INTO `realestate_sites` (`realEstate_id`, `site_id`, `created_at`, `updated_at`) VALUES
(70, 65, '2019-11-14 10:20:14', '2019-11-14 10:20:14'),
(71, 65, '2019-11-14 10:21:58', '2019-11-14 10:21:58'),
(72, 65, '2019-11-14 10:22:00', '2019-11-14 10:22:00'),
(73, 65, '2019-11-14 10:22:02', '2019-11-14 10:22:02'),
(74, 65, '2019-11-14 10:22:15', '2019-11-14 10:22:15'),
(75, 65, '2019-11-14 10:23:06', '2019-11-14 10:23:06'),
(76, 65, '2019-11-14 10:24:20', '2019-11-14 10:24:20'),
(77, 65, '2019-11-14 10:25:27', '2019-11-14 10:25:27'),
(78, 65, '2019-11-14 10:28:18', '2019-11-14 10:28:18'),
(79, 65, '2019-11-14 10:28:42', '2019-11-14 10:28:42'),
(80, 65, '2019-11-14 10:29:28', '2019-11-14 10:29:28'),
(81, 65, '2019-11-14 10:30:32', '2019-11-14 10:30:32'),
(82, 65, '2019-11-14 10:30:37', '2019-11-14 10:30:37'),
(83, 65, '2019-11-15 06:55:39', '2019-11-15 06:55:39'),
(84, 51, '2019-11-16 09:19:37', '2019-11-16 09:19:37'),
(85, 51, '2019-11-16 09:28:20', '2019-11-16 09:28:20'),
(86, 51, '2019-11-16 09:28:42', '2019-11-16 09:28:42'),
(87, 51, '2019-11-16 09:31:10', '2019-11-16 09:31:10'),
(88, 51, '2019-11-16 09:31:50', '2019-11-16 09:31:50'),
(89, 51, '2019-11-16 09:31:54', '2019-11-16 09:31:54'),
(90, 51, '2019-11-16 09:32:11', '2019-11-16 09:32:11'),
(91, 51, '2019-11-16 09:32:25', '2019-11-16 09:32:25'),
(92, 51, '2019-11-16 09:47:55', '2019-11-16 09:47:55'),
(93, 51, '2019-11-16 09:48:05', '2019-11-16 09:48:05'),
(94, 51, '2019-11-16 09:49:43', '2019-11-16 09:49:43'),
(95, 51, '2019-11-16 09:49:49', '2019-11-16 09:49:49'),
(96, 51, '2019-11-16 09:50:08', '2019-11-16 09:50:08'),
(97, 51, '2019-11-16 09:52:45', '2019-11-16 09:52:45'),
(98, 51, '2019-11-16 09:52:59', '2019-11-16 09:52:59'),
(99, 51, '2019-11-16 09:53:31', '2019-11-16 09:53:31'),
(100, 51, '2019-11-16 09:53:39', '2019-11-16 09:53:39'),
(101, 51, '2019-11-16 09:56:44', '2019-11-16 09:56:44'),
(102, 51, '2019-11-16 10:01:48', '2019-11-16 10:01:48'),
(103, 51, '2019-11-16 10:09:16', '2019-11-16 10:09:16'),
(104, 51, '2019-11-16 10:17:22', '2019-11-16 10:17:22'),
(105, 51, '2019-11-16 11:33:28', '2019-11-16 11:33:28'),
(106, 51, '2019-11-16 11:33:42', '2019-11-16 11:33:42'),
(107, 51, '2019-11-16 11:38:07', '2019-11-16 11:38:07'),
(108, 51, '2019-11-16 11:38:41', '2019-11-16 11:38:41'),
(109, 51, '2019-11-16 11:41:08', '2019-11-16 11:41:08'),
(110, 51, '2019-11-16 11:41:17', '2019-11-16 11:41:17'),
(111, 51, '2019-11-16 11:42:28', '2019-11-16 11:42:28'),
(112, 51, '2019-11-16 11:48:01', '2019-11-16 11:48:01'),
(113, 51, '2019-11-16 11:48:27', '2019-11-16 11:48:27'),
(114, 51, '2019-11-16 11:51:13', '2019-11-16 11:51:13'),
(115, 51, '2019-11-16 11:52:17', '2019-11-16 11:52:17'),
(116, 51, '2019-11-16 11:54:38', '2019-11-16 11:54:38'),
(117, 51, '2019-11-16 11:55:27', '2019-11-16 11:55:27'),
(118, 51, '2019-11-16 11:55:39', '2019-11-16 11:55:39'),
(119, 51, '2019-11-16 11:57:31', '2019-11-16 11:57:31'),
(120, 51, '2019-11-16 11:59:36', '2019-11-16 11:59:36');

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
(23, 34, '', '', '1ae85075ea0c3f64f883c77a8d0a617c', 0, '2019-11-13 11:54:40', '2019-09-28 10:13:14'),
(24, 34, '', '', '192ad1ea2c3faa9c2443846afb2a2246', 0, '2019-11-13 11:54:40', '2019-09-28 10:15:06'),
(25, 34, '', '', '0eb42a9ce01d0d9114e4fb02e4ab86dc', 0, '2019-11-13 11:54:40', '2019-09-28 10:16:26'),
(26, 34, '', '', '6b22f0d3802d83a0c347a39048eefafe', 0, '2019-11-13 11:54:40', '2019-09-28 10:16:40'),
(27, 34, '', '', '22010fb8700186a4a33bd13282137f8c', 0, '2019-11-13 11:54:40', '2019-09-28 10:23:26'),
(28, 34, '', '', '0df14289eff398adaa580a6805dd0d8e', 0, '2019-11-13 11:54:40', '2019-09-28 10:24:03'),
(29, 34, '', '', 'c81152f4a04712fee3d78d86a0c8791b', 0, '2019-11-13 11:54:40', '2019-09-28 10:47:41'),
(30, 34, '', '', '1cef6074f0dc125e67e97b177a2116cb', 0, '2019-11-13 11:54:40', '2019-09-28 10:47:54'),
(31, 34, '', '', '9d5e4a6323ba1ea2d4ce83ecfda64786', 0, '2019-11-13 11:54:40', '2019-10-08 19:44:29'),
(32, 34, '', '', '1921dff0a95ee53e196339d5190a4f4f', 0, '2019-11-13 11:54:40', '2019-10-09 12:14:23'),
(33, 34, '', '', '829fc9f58d26f3d02c3979b237656f12', 0, '2019-11-13 11:54:40', '2019-10-09 12:21:42'),
(34, 34, '', '', '334b7fee98c88c41aea64b7b8b378666', 0, '2019-11-13 11:54:40', '2019-10-09 13:17:20'),
(35, 34, '', '', 'bd261bd53b4a6168b5ed3ea8c1c91635', 0, '2019-11-13 11:54:40', '2019-10-09 13:17:36'),
(36, 34, '', '', '8a86eb86624da43ff98793d527674557', 0, '2019-11-13 11:54:40', '2019-10-09 13:19:19'),
(37, 34, '', '', 'fdc7e5f0bad9deb2daf7d687a6cfdc26', 0, '2019-11-13 11:54:40', '2019-10-09 13:20:09'),
(38, 34, '', '', 'e3a67e9e7b168dd25031fc35758e5ed1', 0, '2019-11-13 11:54:40', '2019-10-09 13:21:32'),
(39, 34, '', '', '4473c012f68453862645e4f3cf2c21db', 0, '2019-11-13 11:54:40', '2019-10-09 13:21:57'),
(40, 34, '', '', 'f77fe3f00abc882fec5a7241ca97f7d0', 0, '2019-11-13 11:54:40', '2019-10-09 13:47:06'),
(41, 34, '', '', '41d5ef4e055f3d5bff01c7a33f6af7d1', 0, '2019-11-13 11:54:40', '2019-10-09 13:48:10'),
(42, 34, '', '', '3f51700abcb1dbefd93760e8aae00a07', 0, '2019-11-13 11:54:40', '2019-10-09 13:48:54'),
(43, 34, '', '', '7d123094ed9ea8a1f8a1b2ff27c677ad', 0, '2019-11-13 11:54:40', '2019-10-09 13:49:29'),
(44, 34, '', '', '992c8caeff5542e9ca3ed79411b565f2', 0, '2019-11-13 11:54:40', '2019-10-09 13:55:59'),
(45, 34, '', '', '507998e7b1dc08bbc651946d88f5c71c', 0, '2019-11-13 11:54:40', '2019-10-09 13:56:04'),
(46, 34, '', '', '846814e7748275056cad462f66f14d45', 0, '2019-11-13 11:54:40', '2019-10-09 13:57:01'),
(47, 34, '', '', '3f5ad6e5b71c2e30c4f02f3abb975893', 0, '2019-11-13 11:54:40', '2019-10-09 13:58:54'),
(48, 34, '', '', '895ca5503b5c6beefec5cb62408e158d', 0, '2019-11-13 11:54:40', '2019-10-09 13:58:58'),
(49, 34, '', '', 'b6b3360be7bf0374ea1a656748f1f093', 0, '2019-11-13 11:54:40', '2019-10-09 13:58:58'),
(50, 34, '', '', 'a72528a033a7d4e0bb2448805734e337', 0, '2019-11-13 11:54:40', '2019-10-09 13:58:59'),
(51, 34, '', '', '6dfbc8cff0e16d14c4933ed1086457a0', 0, '2019-11-13 11:54:40', '2019-10-09 13:58:59'),
(52, 34, '', '', '3b9f117c5b0d41d24a48d9a8f61beee4', 0, '2019-11-13 11:54:40', '2019-10-09 13:59:00'),
(53, 34, '', '', 'c8b0e79cca881b5e97cbbf61ebfb7db6', 0, '2019-11-13 11:54:40', '2019-10-09 13:59:04'),
(54, 34, '', '', '04c48a84ab1e03083c62bf6618968cc9', 0, '2019-11-13 11:54:40', '2019-10-09 13:59:18'),
(55, 34, '', '', 'e6f876ae9f7eaefa271891bd0db50951', 0, '2019-11-13 11:54:40', '2019-10-09 14:01:41'),
(56, 34, '', '', 'b7c0c2e4d3cbdc584966ef64ce12dcba', 0, '2019-11-13 11:54:40', '2019-10-09 14:02:16'),
(57, 34, '', '', '07c8293dfa480cf82cb7195eb6f38b51', 0, '2019-11-13 11:54:40', '2019-10-09 14:02:20'),
(58, 34, '', '', '9a68755fafe927046f85b8b8a580c416', 0, '2019-11-13 11:54:40', '2019-10-09 14:02:28'),
(59, 34, '', '', '97babce4704ace396a6162e1b7177638', 0, '2019-11-13 11:54:40', '2019-10-09 14:03:03'),
(60, 34, '', '', '61af5024adfaf41697ad28d59cd3e8e0', 0, '2019-11-13 11:54:40', '2019-10-09 14:03:21'),
(61, 34, '', '', 'bb3fee1b598e94b08bd285440ff2a2d5', 0, '2019-11-13 11:54:40', '2019-10-09 14:05:44'),
(62, 34, '', '', '252ab57bb5c252848f79a9d3dd744c3a', 0, '2019-11-13 11:54:40', '2019-10-09 14:06:20'),
(63, 34, '', '', 'f1c1acfc8398b7f2b38063798e941351', 0, '2019-11-13 11:54:40', '2019-10-09 14:06:56'),
(64, 34, '', '', 'eafa072a9e64935118a43bea8c78ddd4', 0, '2019-11-13 11:54:40', '2019-10-09 14:07:21'),
(65, 34, '', '', '250effc3669648e04a2225ce4dba9487', 0, '2019-11-13 11:54:40', '2019-10-09 14:08:16'),
(66, 34, '', '', 'e6425a24dc200942c13562031fea64e2', 0, '2019-11-13 11:54:40', '2019-10-09 14:09:02'),
(67, 34, '', '', '72186071eed966767f4e6c7556e4bac9', 0, '2019-11-13 11:54:40', '2019-10-11 09:42:29'),
(68, 34, '', '', 'ce6fb635770b356d623985ffbd1996e6', 0, '2019-11-13 11:54:40', '2019-10-11 09:44:48'),
(69, 34, '', '', '3c118044dbc025b624cc3efa428c580f', 0, '2019-11-13 11:54:40', '2019-10-11 09:44:57'),
(70, 34, '', '', '14f67e4c507736c399f4dd143ec3273f', 0, '2019-11-13 11:54:40', '2019-10-11 09:47:04'),
(71, 34, '', '', '28e75e93f81f457123cdf9cd3f6e5138', 0, '2019-11-13 11:54:40', '2019-10-11 09:48:48'),
(72, 34, '', '', '739a2932d2e3cbc511a66dcaf5300bfa', 0, '2019-11-13 11:54:40', '2019-10-11 09:50:23'),
(73, 34, '', '', '960875f95b4912f5c2ba46e723c2dcf3', 0, '2019-11-13 11:54:40', '2019-10-11 10:57:28'),
(74, 34, '', '', '420399729fb5f32b21614b8cc5557fc8', 0, '2019-11-13 11:54:40', '2019-10-11 10:59:19'),
(75, 34, '', '', 'a4d0389208edba9cefa3d73837a8f8b1', 0, '2019-11-13 11:54:40', '2019-10-11 11:34:33'),
(76, 34, '', '', '1802eee45df16add8932999f059641a6', 0, '2019-11-13 11:54:40', '2019-10-11 11:42:33'),
(77, 34, '', '', 'fe9a330521d465127437c028b1b29b1b', 0, '2019-11-13 11:54:40', '2019-10-11 11:42:58'),
(78, 34, '', '', '82c043d0f923eacb9290722e0dee5c59', 0, '2019-11-13 11:54:40', '2019-10-11 11:53:04'),
(79, 34, '', '', '084aed86e6424a50df45bc7dc0b7e989', 0, '2019-11-13 11:54:40', '2019-10-11 11:55:59'),
(80, 34, '', '', '56fdbfc52e89530cd4a83d3ed62e3d3b', 0, '2019-11-13 11:54:40', '2019-10-11 11:56:14'),
(81, 34, '', '', '2e84ba9815fcaee32c4d1947769ba7a3', 0, '2019-11-13 11:54:40', '2019-10-11 11:56:27'),
(82, 34, '', '', '17aac24d1d8c940166a4a422dbc1ae11', 0, '2019-11-13 11:54:40', '2019-10-11 11:56:43'),
(83, 34, '', '', '30c97213a0d8d8f9d3375ab4aba72480', 0, '2019-11-13 11:54:40', '2019-10-11 11:59:57'),
(84, 34, '', '', 'f8e4dac151f8e8589edc116633c3ebab', 0, '2019-11-13 11:54:40', '2019-10-11 12:23:16'),
(85, 34, '', '', '706fe7c91cf9fe419ee2cc7954906f09', 0, '2019-11-13 11:54:40', '2019-10-11 12:25:36'),
(86, 34, '', '', '20262471ba6033ebe355731417940256', 0, '2019-11-13 11:54:40', '2019-10-11 12:25:52'),
(87, 34, '', '', 'd9f82002809d90be046f9f2beda33fed', 0, '2019-11-13 11:54:40', '2019-10-11 12:25:58'),
(88, 34, '', '', '0d6ac4c249fc1cedde856ea45f12e100', 0, '2019-11-13 11:54:40', '2019-10-11 13:26:29'),
(89, 34, '', '', '3a0c587c8e65e8c1a793ce3ba26171f5', 0, '2019-11-13 11:54:40', '2019-10-11 13:26:39'),
(90, 34, '', '', '479075e381fc5ea405b21216a3e7b92c', 0, '2019-11-13 11:54:40', '2019-10-11 13:26:47'),
(91, 34, '', '', '40ecc435971482be25d138c85a3e4ca0', 0, '2019-11-13 11:54:40', '2019-10-11 13:47:55'),
(92, 34, '', '', '3c7be35f6799d1f0c3348468260f9b19', 0, '2019-11-13 11:54:40', '2019-10-11 13:48:09'),
(93, 34, '', '', '9b8cc28d34fe35680d17e2dabcb855f2', 0, '2019-11-13 11:54:40', '2019-10-11 13:52:23'),
(94, 34, '', '', '64246a3fa3c8dd17d45c3ce25a10ff35', 0, '2019-11-13 11:54:40', '2019-10-11 14:05:34'),
(95, 34, '', '', 'b2a15132bca17e7d0f20f04e5efb54dc', 0, '2019-11-13 11:54:40', '2019-10-12 01:42:24'),
(96, 34, '', '', '7684315ee1f34a3bd4552869b5ba9f0f', 0, '2019-11-13 11:54:40', '2019-10-12 02:02:52'),
(97, 34, '', '', 'b17b5105e1ba50c4b81701db384487d1', 0, '2019-11-13 11:54:40', '2019-10-12 19:17:47'),
(98, 34, '', '', 'd3ef3b5ceaf9e358fd8c8bba935af1a5', 0, '2019-11-13 11:54:40', '2019-10-12 19:21:39'),
(99, 34, '', '', '5a19cf47b7992503bc59815d8d27e85f', 0, '2019-11-13 11:54:40', '2019-10-12 19:21:48'),
(100, 34, '', '', '4ffb5aa8731cd3e41801716a25fefdd6', 0, '2019-11-13 11:54:40', '2019-10-12 21:23:16'),
(101, 34, '', '', 'b4be4d053d30b3428a41f76e75a1bb35', 0, '2019-11-13 11:54:40', '2019-10-12 21:25:36'),
(102, 34, '', '', '082e1686fda98c8e16b2e1def2ca5e18', 0, '2019-11-13 11:54:40', '2019-10-13 13:40:55'),
(103, 34, '', '', '98bac4230b8628fbf3f8d9379d30f19a', 0, '2019-11-13 11:54:40', '2019-10-13 13:41:08'),
(104, 34, '', '', '70e002f93eca47e457c08428ef547ee4', 0, '2019-11-13 11:54:40', '2019-10-13 13:41:46'),
(105, 34, '', '', 'f00bb0c1bed41bb31e8381ba1e77a9d4', 0, '2019-11-13 11:54:40', '2019-10-13 13:42:06'),
(106, 34, '', '', 'ab2d066fcc69d4f80d8067e276bc8bbb', 0, '2019-11-13 11:54:40', '2019-10-13 13:43:10'),
(107, 34, '', '', '1a50c055983c2c0f33a168b94f9052b8', 0, '2019-11-13 11:54:40', '2019-10-13 13:43:34'),
(108, 34, '', '', '5cfc8c1cad73d680265371b35664dad7', 0, '2019-11-13 11:54:40', '2019-10-13 13:45:27'),
(109, 34, '', '', 'ffdcecd681a8653dd6c677ade51c3bcf', 0, '2019-11-13 11:54:40', '2019-10-13 13:46:14'),
(110, 34, '', '', '7bf8d8e8d338cf87b68504df352b923e', 0, '2019-11-13 11:54:40', '2019-10-13 13:47:08'),
(111, 34, '', '', '07d6c50d64534cb8c871cb1fa8477ae8', 0, '2019-11-13 11:54:40', '2019-10-13 13:48:44'),
(112, 34, '', '', 'a1c3a56caf1e5658215c16074edd2dc6', 0, '2019-11-13 11:54:40', '2019-10-13 13:51:36'),
(113, 34, '', '', 'b05a2ff9fcf8c8e829a5a7f27033066e', 0, '2019-11-13 11:54:40', '2019-10-13 14:00:47'),
(114, 34, '', '', '068344c416b09d10a333d03d78d63a35', 0, '2019-11-13 11:54:40', '2019-10-13 17:24:04'),
(115, 34, '', '', 'e3330b41a188d65aee6a2ecec25c8912', 0, '2019-11-13 11:54:40', '2019-10-13 17:25:48'),
(116, 34, '', '', '5a55212e1cc15efe0eaf163605b31d39', 0, '2019-11-13 11:54:40', '2019-10-13 19:42:44'),
(117, 34, '', '', '5d69e5aa05dd0f1cf578a60cdea9a484', 0, '2019-11-13 11:54:40', '2019-10-14 19:29:55'),
(118, 34, '', '', '2c8c088e7a4f537faed9fbde00009e3b', 0, '2019-11-13 11:54:40', '2019-10-25 19:57:42'),
(119, 34, '', '', '8c9361421e2da46d3dc998b5db945502', 0, '2019-11-13 11:54:40', '2019-10-25 19:58:28'),
(120, 41, '', '', '8d8773105d9e4124e89f45b1436c7abf', 0, '2019-11-16 20:29:14', '2019-11-05 20:27:53'),
(121, 41, '', '', '9bfeddd53d6ef6c75843fd3a34c1ed34', 0, '2019-11-16 20:29:14', '2019-11-05 20:57:49'),
(122, 41, '', '', 'f416edb2072692bb3a3618b69fd0663d', 0, '2019-11-16 20:29:14', '2019-11-05 20:58:08'),
(123, 41, '', '', 'c7e81185ad77cf0b59a2685588cc4647', 0, '2019-11-16 20:29:14', '2019-11-05 21:04:14'),
(124, 41, '', '', 'ac73565e5d663cd6c48b549f4362127b', 0, '2019-11-16 20:29:14', '2019-11-05 21:04:34'),
(125, 34, '', '', '8c2777581fbfc91c5cb27d3216738485', 0, '2019-11-13 11:54:40', '2019-11-13 11:20:35'),
(126, 34, '', '', 'f7cc2270ef49528e52be7b0ad514318c', 0, '2019-11-13 11:54:40', '2019-11-13 11:23:25'),
(127, 34, '', '', 'cc629ac17d5c66dd7649de935ebf2d03', 0, '2019-11-13 11:54:40', '2019-11-13 11:24:42'),
(128, 34, '', '', 'e22e8018ebf4ef173075a4b21d3d83b2', 0, '2019-11-13 11:54:40', '2019-11-13 11:27:29'),
(129, 34, '', '', '9f081d7a7e138bf10509b548cdbc2187', 0, '2019-11-13 11:54:40', '2019-11-13 11:32:24'),
(130, 34, '', '', 'ab4069235c967ce3bf0420a5f59b1247', 0, '2019-11-13 11:54:40', '2019-11-13 11:34:53'),
(131, 34, '', '', '22d2c81bb39aeedc1916b7c842aab832', 0, '2019-11-13 11:54:40', '2019-11-13 11:37:21'),
(132, 34, '', '', '22ccbd6fd29e3cf7171f9999e458dca3', 0, '2019-11-13 11:54:40', '2019-11-13 11:38:29'),
(133, 34, '', '', 'defdd8598cf3185fe810cd3d67f2e78a', 0, '2019-11-13 11:54:40', '2019-11-13 11:41:26'),
(134, 34, '', '', '0dd851a3d13f944e88de329562701207', 0, '2019-11-13 11:54:40', '2019-11-13 11:42:06'),
(135, 34, '', '', '5ea404632477a598815a23ebbc4e64eb', 0, '2019-11-13 11:54:40', '2019-11-13 11:43:32'),
(136, 34, '', '', '7e31d7a2b95844747bc2f140e303ee84', 0, '2019-11-13 11:54:40', '2019-11-13 11:44:15'),
(137, 34, '', '', 'cd820f416cfab61fc0f12f593cad2916', 0, '2019-11-13 11:54:40', '2019-11-13 11:45:22'),
(138, 34, '', '', '1bc58a0c50922230d26dc122c137bb84', 0, '2019-11-13 11:54:40', '2019-11-13 11:49:16'),
(139, 34, '', '', 'aefebc7482227df3e9cc9d22c7196c51', 0, '2019-11-13 11:54:40', '2019-11-13 11:50:00'),
(140, 34, '', '', '449783a0a3aa377fb1517cf1982ff79f', 0, '2019-11-13 11:54:40', '2019-11-13 11:52:13'),
(141, 34, '', '', 'ee28c45499f27900cc6d1f6561aaf94d', 0, '2019-11-13 11:54:40', '2019-11-13 11:52:55'),
(142, 34, '', '', '77c32e5d58d19980948a0a8cc50213fc', 0, '2019-11-13 14:07:00', '2019-11-13 11:54:40'),
(143, 41, '', '', '1901fb6e7b59c20b22fa83ee96b355f0', 1, '2019-11-16 20:29:14', '2019-11-16 20:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` int(4) NOT NULL,
  `inside` int(10) UNSIGNED DEFAULT NULL,
  `nameAr` varchar(55) CHARACTER SET utf16 NOT NULL,
  `nameEn` varchar(55) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `level`, `inside`, `nameAr`, `nameEn`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'سوريا', 'SYRIA', NULL, NULL),
(2, 2, 1, 'حلب', 'ALEPPO', NULL, NULL),
(3, 3, 2, 'جبل سمعان', 'Mount Simeon', NULL, NULL),
(4, 3, 2, 'حريتان', 'Huraytan', NULL, NULL),
(5, 3, 2, 'الزربة', 'al-Zirbah', NULL, NULL),
(6, 3, 2, 'دارة عزة', 'Darrat Izzah', NULL, NULL),
(7, 3, 2, 'الحاضر', 'al-Hadr', NULL, NULL),
(8, 3, 2, 'تل الضمان', 'Tell al-Daman', NULL, NULL),
(9, 3, 2, 'زمّار', 'Zammar', NULL, NULL),
(10, 3, 2, 'عفرين', 'Afrin', NULL, NULL),
(11, 3, 2, 'بلبل', 'Bulbul', NULL, NULL),
(12, 3, 2, 'جنديرس', 'Jindires', NULL, NULL),
(13, 3, 2, 'راجو', 'Rajo', NULL, NULL),
(14, 3, 2, 'شرّان', 'Sharan ', NULL, NULL),
(15, 3, 2, 'شيخ الحديد', 'Sheikh al-Hadeed', NULL, NULL),
(16, 3, 2, 'معبطلي', 'Maabatli', NULL, NULL),
(17, 3, 2, 'اعزاز', 'Azaz', NULL, NULL),
(18, 3, 2, 'أخترين', 'Akhtarin', NULL, NULL),
(19, 3, 2, 'تل رفعت', 'Tell Rfiat', NULL, NULL),
(20, 3, 2, 'مارع', 'Mare', NULL, NULL),
(21, 3, 2, 'نبّل', 'Nubl', NULL, NULL),
(22, 3, 2, 'صوران', 'Sawran ', NULL, NULL),
(23, 3, 2, 'السفيرة', 'al-Safira', NULL, NULL),
(24, 3, 2, 'خناصر', 'Khanasir', NULL, NULL),
(25, 3, 2, 'بنان', 'Banan', NULL, NULL),
(26, 3, 2, 'الحاجب', 'al-Hajib', NULL, NULL),
(27, 3, 2, 'تلعرن', 'Tell Arn', NULL, NULL),
(28, 3, 2, 'الباب', 'al-Bab', NULL, NULL),
(29, 3, 2, 'تادف', 'Tedef ', NULL, NULL),
(30, 3, 2, 'الراعي', 'al-Rayi', NULL, NULL),
(31, 3, 2, 'عريمة', 'Arima', NULL, NULL),
(32, 3, 2, 'منبج', 'Manbij', NULL, NULL),
(33, 3, 2, 'أبو قلقل', 'Abu Qilqil', NULL, NULL),
(34, 3, 2, 'خفسة', 'Khafsaf', NULL, NULL),
(35, 3, 2, 'مسكنة', 'Maskanah', NULL, NULL),
(36, 3, 2, 'أبو كهف', 'Abu Kahf', NULL, NULL),
(37, 3, 2, 'جرابلس', 'Jarabulus', NULL, NULL),
(38, 3, 2, 'غندورة', 'Ghandoura', NULL, NULL),
(39, 3, 2, 'عين العرب', 'Ayn al-Arab', NULL, NULL),
(40, 3, 2, 'شيوخ تحتاني', 'Shuyukh Tahtani', NULL, NULL),
(41, 3, 2, 'صرّين', 'Sarrin', NULL, NULL),
(42, 3, 2, 'الجلبية', 'al-Jalabiyah', NULL, NULL),
(43, 3, 2, 'الأتارب', 'Atarib', NULL, NULL),
(44, 3, 2, 'أبين سمعان', 'Ibbin Samaan', NULL, NULL),
(45, 3, 2, 'أورم الكبرى', 'Urum al-Kubrah', NULL, NULL),
(46, 3, 2, 'دير حافر', 'Deir Hafir', NULL, NULL),
(47, 3, 2, 'رسم حرمل الإمام', 'Rasm Harmil al-Imam', NULL, NULL),
(48, 3, 2, 'كويرس شرقي', 'Kuwayris Sharqi', NULL, NULL),
(49, 2, 1, 'دمشق', 'DAMASCUS', NULL, NULL),
(50, 3, 49, 'دمر', 'Dummar', NULL, NULL),
(51, 3, 49, 'مزة', 'Mazzeh', NULL, NULL),
(52, 3, 49, 'كفرسوسة', 'Kafr Souseh', NULL, NULL),
(53, 3, 49, 'القدم', 'al-Kadam', NULL, NULL),
(54, 3, 49, 'اليرموك', 'al-Yarmouk', NULL, NULL),
(55, 3, 49, 'الميدان', 'al-Maydan', NULL, NULL),
(56, 3, 49, 'الشاغور', 'al-Shaghour', NULL, NULL),
(57, 3, 49, 'القنوات', 'al-Qanawat', NULL, NULL),
(58, 3, 49, 'المهاجرين', 'Muhajreen', NULL, NULL),
(59, 3, 49, 'جوبر', 'Jobar', NULL, NULL),
(60, 3, 49, 'القابون', 'al-Kaboun', NULL, NULL),
(61, 3, 49, 'ركن الدين', 'Rukn Eldin', NULL, NULL),
(62, 3, 49, 'الصالحية', 'al-Salheya', NULL, NULL),
(63, 3, 49, 'ساروجة', 'Saroujah', NULL, NULL),
(64, 3, 49, 'دمشق القديمة', 'Old City', NULL, NULL),
(65, 3, 49, 'مساكن برزة', 'MASAKEN-BARZEH', NULL, NULL),
(66, 3, 49, 'برزة', 'BARZEH', NULL, NULL),
(67, 3, 49, 'حاميش', 'HAMISH', NULL, NULL),
(68, 2, 1, 'درعا', 'DARAA', NULL, NULL),
(69, 3, 68, 'الصنمين', 'al-Sanamayn', NULL, NULL),
(70, 3, 68, 'المسمية', 'al-Masmiyah', NULL, NULL),
(71, 3, 68, 'غباغب', 'Ghabaghib', NULL, NULL),
(72, 3, 68, 'بصرى', 'Bosra', NULL, NULL),
(73, 3, 68, 'خربة غزالة', 'Khirbet Ghazaleh', NULL, NULL),
(74, 3, 68, 'الشجرة', 'al-Shajareh', NULL, NULL),
(75, 3, 68, 'داعل', 'Dael', NULL, NULL),
(76, 3, 68, 'مزيريب', 'Muzayrib', NULL, NULL),
(77, 3, 68, 'الجيزة', 'al-Jiza', NULL, NULL),
(78, 3, 68, 'المسيفرة', 'al-Musayfirah', NULL, NULL),
(79, 3, 68, 'ازرع', 'Izra', NULL, NULL),
(80, 3, 68, 'جاسم', 'Jasim', NULL, NULL),
(81, 3, 68, 'الحراك', 'al-Hirak', NULL, NULL),
(82, 3, 68, 'نوى', 'Nawa', NULL, NULL),
(83, 3, 68, 'الشيخ مسكين', 'al-Sheikh Miskeen', NULL, NULL),
(84, 3, 68, 'تسيل', 'Tasil', NULL, NULL),
(85, 2, 1, 'دير الزور', 'DEIR EZZOR', NULL, NULL),
(86, 3, 85, 'البوكمال', 'al-Bukamal', NULL, NULL),
(87, 3, 85, 'هجين', 'Hajin', NULL, NULL),
(88, 3, 85, 'الجلاء', 'al-Jalaa', NULL, NULL),
(89, 3, 85, 'السوسة', 'al-Susah', NULL, NULL),
(90, 3, 85, 'الميادين', 'Mayadin', NULL, NULL),
(91, 3, 85, 'ذيبان', 'Diban', NULL, NULL),
(92, 3, 85, 'عشارة', 'Asharah', NULL, NULL),
(93, 3, 85, 'الكسرة', 'al-Kasrah', NULL, NULL),
(94, 3, 85, 'البصيرة', 'al-Busayrah', NULL, NULL),
(95, 3, 85, 'الموحسن', 'al-Muhasan', NULL, NULL),
(96, 3, 85, 'التبني', 'al-Tabni', NULL, NULL),
(97, 3, 85, 'خشام', 'Khasham', NULL, NULL),
(98, 3, 85, 'الصور', 'al-Sur', NULL, NULL),
(99, 2, 1, 'حماة', 'HAMA', NULL, NULL),
(100, 3, 99, 'السقيلبية', 'al-Suqaylabiyah', NULL, NULL),
(101, 3, 99, 'تلسلحب', 'Tell Salhab', NULL, NULL),
(102, 3, 99, 'الزيارة', 'al-Ziyarah', NULL, NULL),
(103, 3, 99, 'شطحة', 'Shathah ', NULL, NULL),
(104, 3, 99, 'قلعة المضيق', 'Qalaat al-Madiq', NULL, NULL),
(105, 3, 99, 'صوران', 'Suran', NULL, NULL),
(106, 3, 99, 'حربنفسه', 'Hirbnafsah', NULL, NULL),
(107, 3, 99, 'الحمراء', 'al-Hamraa', NULL, NULL),
(108, 3, 99, 'مصياف‎ ', 'Masyaf', NULL, NULL),
(109, 3, 99, 'جب رملة', 'Jub Ramlah', NULL, NULL),
(110, 3, 99, 'عوج', 'Awj', NULL, NULL),
(111, 3, 99, 'عين حلاقيم', 'Ayn Halaqim', NULL, NULL),
(112, 3, 99, 'وادي العيون', 'Wadi al-Uyun', NULL, NULL),
(113, 3, 99, 'محردة', 'Mahardeh', NULL, NULL),
(114, 3, 99, 'كفر زيتا', 'Kafr Zita', NULL, NULL),
(115, 3, 99, 'كرناز', 'Karnez', NULL, NULL),
(116, 3, 99, 'سلمية‎', 'Salamiyah', NULL, NULL),
(117, 3, 99, 'بري الشرقي', 'Barri Sharqi', NULL, NULL),
(118, 3, 99, 'السعن', 'al-Saan', NULL, NULL),
(119, 3, 99, 'صبورة', 'Sabburah', NULL, NULL),
(120, 3, 99, 'عقيربات', 'Uqayribat', NULL, NULL),
(121, 2, 1, 'الحسكة', 'AL-HASAKAH', NULL, NULL),
(122, 3, 121, 'تل تمر', 'Tell Tamr', NULL, NULL),
(123, 3, 121, 'مركدة', 'Markadah', NULL, NULL),
(124, 3, 121, 'بئر الحلو', 'Bir al-Helu', NULL, NULL),
(125, 3, 121, 'العريشة', 'al-Arisheh', NULL, NULL),
(126, 3, 121, 'الهول', 'al-Hawl', NULL, NULL),
(127, 2, 1, 'القامشلي', 'al-Qamishli', NULL, NULL),
(128, 3, 127, 'تل حميس', 'Tell Hamis', NULL, NULL),
(129, 3, 127, 'عامودا', 'Amuda', NULL, NULL),
(130, 3, 127, 'القحطانية', 'al-Qahtaniyah', NULL, NULL),
(131, 3, 127, 'اليرموك', 'al-Yarmouk', NULL, NULL),
(132, 3, 127, 'المالكية', 'al-Malikiyah', NULL, NULL),
(133, 3, 127, 'الجوادية', 'al-Jawadiyah', NULL, NULL),
(134, 3, 127, 'اليعربية', 'al-Yarubiyah', NULL, NULL),
(135, 3, 127, 'معبدة', 'Ma\'badah', NULL, NULL),
(136, 3, 127, 'أس العين', 'Ras al-Ayn', NULL, NULL),
(137, 3, 127, 'الدرباسية', 'al-Darbasiya', NULL, NULL),
(138, 3, 127, 'أبو راسين', 'Abu Rasain', NULL, NULL),
(139, 2, 1, 'حمص', 'HOMS', NULL, NULL),
(140, 3, 139, 'المخرم', 'al-Mukharam', NULL, NULL),
(141, 3, 139, 'جب الجراح', 'Jub al-Jarrah', NULL, NULL),
(142, 3, 139, 'القصير', 'al-Qusayr', NULL, NULL),
(143, 3, 139, 'الحوز', 'al-Hoz', NULL, NULL),
(144, 3, 139, 'الرستن', 'ar-Rastan', NULL, NULL),
(145, 3, 139, 'تلبيسة', 'al-Talbiseh', NULL, NULL),
(146, 3, 139, 'خربة تين نور', 'Khirbet Tin Nur', NULL, NULL),
(147, 3, 139, 'عين النسر', 'Ayn al-Nisr', NULL, NULL),
(148, 3, 139, 'الفرقلس', 'Furqlus', NULL, NULL),
(149, 3, 139, 'رقاما', 'Riqama', NULL, NULL),
(150, 3, 139, 'القريتين', 'al-Qaryatayn', NULL, NULL),
(151, 3, 139, 'مهين', 'Mahin', NULL, NULL),
(152, 3, 139, 'حسياء', 'Hisyah', NULL, NULL),
(153, 3, 139, 'صدد', 'Sadad', NULL, NULL),
(154, 3, 139, 'شين', 'Shin', NULL, NULL),
(155, 2, 1, 'تدمر', 'Tadmur', NULL, NULL),
(156, 3, 155, 'السخنة', 'al-Sukhnah', NULL, NULL),
(157, 3, 155, 'تلدو', 'Taldou', NULL, NULL),
(158, 3, 155, 'كفرلاها', 'Kafr Laha', NULL, NULL),
(159, 3, 155, 'القبو', 'al-Qalbu', NULL, NULL),
(160, 3, 155, 'تلكلخ', 'Talkalakh', NULL, NULL),
(161, 3, 155, 'حديدة', 'Hadidah', NULL, NULL),
(162, 3, 155, 'الناصرة', 'al-Nasirah', NULL, NULL),
(163, 3, 155, 'الحواش', 'al-Huwash', NULL, NULL),
(164, 2, 1, 'إدلب', 'IDLIB', NULL, NULL),
(165, 3, 164, 'أريحا', 'Ariha', NULL, NULL),
(166, 3, 164, 'احسم', 'Ihsim', NULL, NULL),
(167, 3, 164, 'محمبل', 'Muhambal', NULL, NULL),
(168, 3, 164, 'حارم', 'Harem', NULL, NULL),
(169, 3, 164, 'الدانا', 'al-Dana', NULL, NULL),
(170, 3, 164, 'سلقين', 'Salqin', NULL, NULL),
(171, 3, 164, 'كفر تخاريم', 'Kafr Takharim', NULL, NULL),
(172, 3, 164, 'قورقينا', 'Qurqina', NULL, NULL),
(173, 3, 164, 'أرمناز', 'Armanaz', NULL, NULL),
(174, 3, 164, 'أبو الظهور', 'Abu al-Duhur', NULL, NULL),
(175, 3, 164, 'بنش', 'Binnish', NULL, NULL),
(176, 3, 164, 'سراقب', 'Saraqib', NULL, NULL),
(177, 3, 164, 'تفتناز', 'Taftanaz', NULL, NULL),
(178, 3, 164, 'معرتمصرين', 'Maarat Misrin', NULL, NULL),
(179, 3, 164, 'سرمين', 'Sarmi', NULL, NULL),
(180, 3, 164, 'جسر الشغور', 'Jisr al-Shugur', NULL, NULL),
(181, 3, 164, 'بداما', 'Bidama', NULL, NULL),
(182, 3, 164, 'دركوش', 'Darkush', NULL, NULL),
(183, 3, 164, 'الجانودية', 'al-Janudiyah', NULL, NULL),
(184, 3, 164, 'معرة النعمان', 'Ma\'arrat al-Nu\'man', NULL, NULL),
(185, 3, 164, 'خان شيخون', 'Khan Shaykun', NULL, NULL),
(186, 3, 164, 'سنجار', 'Sinjar', NULL, NULL),
(187, 3, 164, 'التمانعة', 'al-Tamanah', NULL, NULL),
(188, 3, 164, 'حيش', 'Hish', NULL, NULL),
(189, 2, 1, 'اللاذقية', 'LATAKIA', NULL, NULL),
(190, 3, 189, 'الحفة', 'al-Haffah', NULL, NULL),
(191, 3, 189, 'صلنفة', 'Slinfah', NULL, NULL),
(192, 3, 189, 'عين التينة', 'Ayn al-Tinneh', NULL, NULL),
(193, 3, 189, 'كنسبّا', 'Kinsabba', NULL, NULL),
(194, 3, 189, 'مزيرعة', 'Muzayaraa', NULL, NULL),
(195, 3, 189, 'جبلة', 'Jableh', NULL, NULL),
(196, 3, 189, 'عين الشرقية', 'Ayn al-Sharqiyah', NULL, NULL),
(197, 3, 189, 'القطيلبية', 'al-Qutailibiyah', NULL, NULL),
(198, 3, 189, 'عين شقاق', 'Ayn Shiqaq', NULL, NULL),
(199, 3, 189, 'دالية', 'Daliyeh', NULL, NULL),
(200, 3, 189, 'بيت ياشوط', 'Beit Yashout', NULL, NULL),
(201, 3, 189, 'البهلولية', 'al-Bahluliyah', NULL, NULL),
(202, 3, 189, 'ربيعة', 'Rabia', NULL, NULL),
(203, 3, 189, 'عين البيضة', 'Ayn al-Baydah', NULL, NULL),
(204, 3, 189, 'قسطل معاف', 'Qastal Maaf', NULL, NULL),
(205, 3, 189, 'كسب', 'Kessab', NULL, NULL),
(206, 3, 189, 'هنادي', 'Hanadi', NULL, NULL),
(207, 3, 189, 'القرداحة', 'Qardaha', NULL, NULL),
(208, 3, 189, 'حرف المسيترة', 'Harf al-Musaytirah', NULL, NULL),
(209, 3, 189, 'الفاخورة', 'al-Fakhurah', NULL, NULL),
(210, 3, 189, 'جوبة برغال', 'Jawbat Burghal', NULL, NULL),
(211, 2, 1, 'القنيطرة', 'Quneitirah', NULL, NULL),
(212, 2, 1, 'الرقة', 'AR-RAQQAH', NULL, NULL),
(213, 3, 212, 'السبخة', 'al-Sabkhah', NULL, NULL),
(214, 3, 212, 'الكرامة', 'al-Karamah', NULL, NULL),
(215, 3, 212, 'معدان', 'Maadan', NULL, NULL),
(216, 3, 212, 'الثورة‎', 'al-Thowrah', NULL, NULL),
(217, 3, 212, 'المنصورة', 'al-Mansurah', NULL, NULL),
(218, 3, 212, 'الجرنية', 'al-Jarniyah', NULL, NULL),
(219, 3, 212, 'تل أبيض', 'Tell Abyad', NULL, NULL),
(220, 3, 212, 'سلوك', 'Suluk', NULL, NULL),
(221, 3, 212, 'عين عيسى', 'Ayn Issa', NULL, NULL),
(222, 2, 1, 'ريف دمشق', 'RIF DIMASHQ', NULL, NULL),
(223, 3, 222, 'القطيفة', 'al-Qutayfah', NULL, NULL),
(224, 3, 222, 'جيرود', 'Jayroud', NULL, NULL),
(225, 3, 222, 'معلولا', 'Maloula', NULL, NULL),
(226, 3, 222, 'الرحيبة', 'al-Ruhaybah', NULL, NULL),
(227, 3, 222, 'النبك', 'al-Nabk', NULL, NULL),
(228, 3, 222, 'دير عطية', 'Deir Atiyah', NULL, NULL),
(229, 3, 222, 'قارة', 'Qara', NULL, NULL),
(230, 3, 222, 'التل', 'al-Tall', NULL, NULL),
(231, 3, 222, 'صيدنايا', 'Saidnaya', NULL, NULL),
(232, 3, 222, 'رنكوس', 'Rankous', NULL, NULL),
(233, 3, 222, 'داريا', 'Darayya', NULL, NULL),
(234, 3, 222, 'صحنايا', 'Sahnaya', NULL, NULL),
(235, 3, 222, 'الحجر الأسود', 'al-Hajar al-Aswad', NULL, NULL),
(236, 3, 222, 'الكسوة', 'al-Kiswah', NULL, NULL),
(237, 3, 222, 'ببيلا', 'Babila', NULL, NULL),
(238, 3, 222, 'جرمانا', 'Jaramana', NULL, NULL),
(239, 3, 222, 'المليحة', 'al-Maliha', NULL, NULL),
(240, 3, 222, 'كفر بطنا', 'Kafr Batna', NULL, NULL),
(241, 3, 222, 'عربين', 'Arbin', NULL, NULL),
(242, 3, 222, 'دوما', 'Douma', NULL, NULL),
(243, 3, 222, 'حرستا', 'Harasta', NULL, NULL),
(244, 3, 222, 'السبع بيار', 'al-Sabe\' Biyar', NULL, NULL),
(245, 3, 222, 'الضمير', 'al-Dumayr', NULL, NULL),
(246, 3, 222, 'النشابية', 'al-Nashabiyah', NULL, NULL),
(247, 3, 222, 'الغزلانية', 'al-Ghizlaniyah', NULL, NULL),
(248, 3, 222, 'حران العواميد', 'Harran al-Awamid', NULL, NULL),
(249, 3, 222, 'قطنا', 'Qatana', NULL, NULL),
(250, 3, 222, 'بيت جن', 'Beit Jen', NULL, NULL),
(251, 3, 222, 'سعسع', 'Sasaa', NULL, NULL),
(252, 3, 222, 'قدسيا', 'Qudsaya', NULL, NULL),
(253, 3, 222, 'عين الفيجة', 'Ayn al-Fijah', NULL, NULL),
(254, 3, 222, 'الديماس', 'al-Dimas', NULL, NULL),
(255, 3, 222, 'يبرود', 'Yabroud', NULL, NULL),
(256, 3, 222, 'عسال الورد', 'Asal al-Ward', NULL, NULL),
(257, 3, 222, 'الزبداني', 'al-Zabadani', NULL, NULL),
(258, 3, 222, 'مضايا', 'Madaya', NULL, NULL),
(259, 3, 222, 'سرغايا', 'Serghaya', NULL, NULL),
(260, 2, 1, 'سويداء', 'Suwayda', NULL, NULL),
(261, 3, 260, 'المزرعة', 'al-Mazraa', NULL, NULL),
(262, 3, 260, 'المشنف', 'al-Mushannaf', NULL, NULL),
(263, 3, 260, 'صلخد', 'Salkhad', NULL, NULL),
(264, 3, 260, 'القريا', 'al-Qrayya', NULL, NULL),
(265, 3, 260, 'الغارية', 'al-Ghariyah', NULL, NULL),
(266, 3, 260, 'ذيبين', 'Thaybin', NULL, NULL),
(267, 3, 260, 'ملح', 'Malah', NULL, NULL),
(268, 3, 260, 'شهبا', 'Shabha', NULL, NULL),
(269, 3, 260, 'شقا', 'Shaqqa', NULL, NULL),
(270, 3, 260, 'العريقة', 'al-Ariqah', NULL, NULL),
(271, 3, 260, 'الصورة الصغيرة', 'al-Surah al-Saghirah', NULL, NULL),
(272, 2, 1, 'طرطوس', 'TARTUS', NULL, NULL),
(273, 3, 272, 'الشيخ بدر', 'al-Sheikh Badr', NULL, NULL),
(274, 3, 272, 'برمانة المشايخ', 'Brummanet al-Masheyekh', NULL, NULL),
(275, 3, 272, 'القمصية', 'al-Qamsiyah', NULL, NULL),
(276, 3, 272, 'بانياس', 'Baniyas', NULL, NULL),
(277, 3, 272, 'الروضة', 'al-Rawda', NULL, NULL),
(278, 3, 272, 'العنازة', 'al-Annazah', NULL, NULL),
(279, 3, 272, 'القدموس', 'al-Qadmus', NULL, NULL),
(280, 3, 272, 'حمام واصل', 'Hammam Wassel', NULL, NULL),
(281, 3, 272, 'الطواحين', 'al-Tawahin', NULL, NULL),
(282, 3, 272, 'تالين', 'Talin', NULL, NULL),
(283, 3, 272, 'دريكيش', 'Duraykish', NULL, NULL),
(284, 3, 272, 'جنينة رسلان', 'Junaynet Ruslan', NULL, NULL),
(285, 3, 272, 'حمين', 'Hamin', NULL, NULL),
(286, 3, 272, 'دوير رسلان', 'Dweir Ruslan', NULL, NULL),
(287, 3, 272, 'صافيتا', 'Safita', NULL, NULL),
(288, 3, 272, 'مشتى الحلو', 'Mashta al-Helu', NULL, NULL),
(289, 3, 272, 'البارقية', 'al-Bariqiyah', NULL, NULL),
(290, 3, 272, 'سبة', 'Sebah', NULL, NULL),
(291, 3, 272, 'السيسنية', 'al-Sisiniyah', NULL, NULL),
(292, 3, 272, 'رأس الخشوفة', 'Ras al-Khashufah', NULL, NULL),
(293, 3, 272, 'أرواد', 'Arwad', NULL, NULL),
(294, 3, 272, 'الحميدية', 'al-Hamidiyah', NULL, NULL),
(295, 3, 272, 'خربة المعزة', 'Khirbet al-Maazeh', NULL, NULL),
(296, 3, 272, 'السودا', 'al-Sawda', NULL, NULL),
(297, 3, 272, 'الكريمة', 'al-Karimah', NULL, NULL),
(298, 3, 272, 'صفصافة', 'Safsafah', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sizemeasures`
--

CREATE TABLE `sizemeasures` (
  `id` int(10) UNSIGNED NOT NULL,
  `sizeName` varchar(55) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sizemeasures`
--

INSERT INTO `sizemeasures` (`id`, `sizeName`, `created_at`, `updated_at`) VALUES
(1, 'meter', '2019-11-13 07:55:31', '2019-11-13 07:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bornDate` date DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `verified` int(11) NOT NULL,
  `blocked` int(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `bornDate`, `phone`, `image`, `password`, `verified`, `blocked`, `created_at`, `updated_at`) VALUES
(34, 'Abode', 'Abdelrahman', 'Alhorani', 'abd.r.horani@gmail.com', '1997-09-15', 930451133, '', '123456', 1, 0, '2019-10-25 19:04:35', '2019-10-25 17:04:35'),
(41, 'aaaa', 'asas', 'adada', 'aa@gmail.com', '2019-11-06', 999999999, NULL, '1234', 1, 0, '2019-11-05 22:27:06', '2019-11-05 20:27:06');

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
(34, '590082', 0, 2, '2019-10-25 16:57:58', '2019-10-25 16:57:58'),
(34, '547363', 0, 2, '2019-10-25 17:02:16', '2019-10-25 17:02:16'),
(34, '965436', 0, 2, '2019-10-25 17:04:07', '2019-10-25 17:04:07'),
(34, '337992', 1, 2, '2019-10-25 19:04:35', '2019-10-25 17:04:35'),
(34, '328937', 0, 2, '2019-10-25 20:02:19', '2019-10-25 20:02:19'),
(34, '315496', 0, 2, '2019-10-25 21:54:44', '2019-10-25 21:54:44'),
(41, '446329', 1, 1, '2019-11-05 22:27:06', '2019-11-05 20:27:06'),
(0, '999411', 0, 1, '2019-11-17 19:30:21', '2019-11-17 19:30:21'),
(42, '403349', 0, 1, '2019-11-17 20:03:34', '2019-11-17 20:03:34'),
(43, '838606', 0, 1, '2019-11-17 20:08:04', '2019-11-17 20:08:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costmeasures`
--
ALTER TABLE `costmeasures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_realestates_id_fk` (`realEstate_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `realEstates_likes_fk` (`realEstate_id`),
  ADD KEY `likes_users_id_fk` (`user_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Action_fk` (`action_id`);

--
-- Indexes for table `measure_costes`
--
ALTER TABLE `measure_costes`
  ADD KEY `measure_fk` (`coste_id`),
  ADD KEY `realestates_fk` (`realEstate_id`);

--
-- Indexes for table `measure_sizes`
--
ALTER TABLE `measure_sizes`
  ADD KEY `sizes_fk` (`size_id`),
  ADD KEY `realestate_sizes_fk` (`realEstate_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificationlisteners`
--
ALTER TABLE `notificationlisteners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notificationlisteners_cost_fk` (`m_cost`),
  ADD KEY `notificationlisteners_site_fk` (`site_id`),
  ADD KEY `notificationlisteners_size_fk` (`m_size`),
  ADD KEY `notificationlisteners_users_id_fk` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_realEstate_fk` (`realEstate_id`),
  ADD KEY `notifications_users_id_fk` (`user_id`);

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
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phones_realestates_id_fk` (`realEstate_id`);

--
-- Indexes for table `realestates`
--
ALTER TABLE `realestates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `realestates_users_id_fk` (`user_id`);

--
-- Indexes for table `realestate_sites`
--
ALTER TABLE `realestate_sites`
  ADD KEY `Sites_fk` (`site_id`),
  ADD KEY `realEstate_fk` (`realEstate_id`);

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
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizemeasures`
--
ALTER TABLE `sizemeasures`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `costmeasures`
--
ALTER TABLE `costmeasures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notificationlisteners`
--
ALTER TABLE `notificationlisteners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `realestates`
--
ALTER TABLE `realestates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `sizemeasures`
--
ALTER TABLE `sizemeasures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_realestates_id_fk` FOREIGN KEY (`realEstate_id`) REFERENCES `realestates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `realEstates_likes_fk` FOREIGN KEY (`realEstate_id`) REFERENCES `realestates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `Action_fk` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`);

--
-- Constraints for table `measure_costes`
--
ALTER TABLE `measure_costes`
  ADD CONSTRAINT `measure_fk` FOREIGN KEY (`coste_id`) REFERENCES `costmeasures` (`id`),
  ADD CONSTRAINT `realestates_fk` FOREIGN KEY (`realEstate_id`) REFERENCES `realestates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `measure_sizes`
--
ALTER TABLE `measure_sizes`
  ADD CONSTRAINT `realestate_sizes_fk` FOREIGN KEY (`realEstate_id`) REFERENCES `realestates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sizes_fk` FOREIGN KEY (`size_id`) REFERENCES `sizemeasures` (`id`);

--
-- Constraints for table `notificationlisteners`
--
ALTER TABLE `notificationlisteners`
  ADD CONSTRAINT `notificationlisteners_cost_fk` FOREIGN KEY (`m_cost`) REFERENCES `costmeasures` (`id`),
  ADD CONSTRAINT `notificationlisteners_site_fk` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`),
  ADD CONSTRAINT `notificationlisteners_size_fk` FOREIGN KEY (`m_size`) REFERENCES `sizemeasures` (`id`),
  ADD CONSTRAINT `notificationlisteners_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_realEstate_fk` FOREIGN KEY (`realEstate_id`) REFERENCES `realestates` (`id`),
  ADD CONSTRAINT `notifications_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_user_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phones_realestates_id_fk` FOREIGN KEY (`realEstate_id`) REFERENCES `realestates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `realestates`
--
ALTER TABLE `realestates`
  ADD CONSTRAINT `realestates_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `realestate_sites`
--
ALTER TABLE `realestate_sites`
  ADD CONSTRAINT `Sites_fk` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`),
  ADD CONSTRAINT `realEstate_fk` FOREIGN KEY (`realEstate_id`) REFERENCES `realestates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
