-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2021 at 02:57 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cleveland`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_title` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `cat_desc` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_title`, `type`, `cat_desc`, `date_created`, `date_updated`) VALUES
(1, 'new category title', 'services', 'Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan t', '2021-01-23 06:28:40', NULL),
(2, 'Hello one five one ninde', 'services', 'Nulla porttitor accumsan tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Cras ultricies ligula sed magna dictum porta. Sed porttitor', '2021-01-22 15:27:35', NULL),
(5, 'Hello two', 'services', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur arcu erat, accumsa', '2021-01-22 15:35:43', NULL),
(7, 'gallery titlte one', 'gallery', NULL, '2021-01-23 06:51:50', NULL),
(8, 'Hello two', 'gallery', NULL, '2021-01-23 06:39:29', NULL),
(9, 'gallery title four', 'gallery', NULL, '2021-01-23 06:52:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `path` varchar(250) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `path`, `type`, `date_created`, `date_updated`) VALUES
(19, 'Abuja.jpg', 'food_60098bcf2785a2.45510067.jpg', 'image/jpeg', '2021-01-21 14:12:31', '2021-01-21 14:12:31'),
(20, 'Screenshot2020-10-13144944.png', 'food_5fec52cce08524.17887644.png', 'image/png', '2020-12-30 10:13:33', NULL),
(21, 'Screenshot2020-10-13145138.png', 'food_5fed6b6ce4c045.45344378.png', 'image/png', '2020-12-31 06:10:52', NULL),
(22, 'Screenshot2020-10-13144944.png', 'food_5fed6d66eba532.72930713.png', 'image/png', '2020-12-31 06:19:18', NULL),
(37, '5.png', 'food_5ff9866830ca33.93190566.png', 'image/png', '2021-01-09 10:33:12', '2021-01-09 10:33:12'),
(39, 'Screenshot2020-10-13145057.png', 'food_5ff415620cbc08.04140116.png', 'image/png', '2021-01-05 07:29:38', NULL),
(41, '4.png', 'food_5ff438f576e581.25627957.png', 'image/png', '2021-01-05 10:01:25', NULL),
(42, 'Screenshot2020-10-13144810.png', 'food_5ff4390925feb9.84227645.png', 'image/png', '2021-01-05 10:01:45', NULL),
(43, 'Screenshot2020-10-13144911.png', 'food_5ff43a3e6b7484.24836195.png', 'image/png', '2021-01-05 10:06:54', NULL),
(44, 'Screenshot2020-10-13144810.png', 'food_5ff44e10ea5327.51191333.png', 'image/png', '2021-01-05 11:31:28', NULL),
(45, '5.png', 'food_5ff456c4429c35.20141406.png', 'image/png', '2021-01-05 12:08:36', NULL),
(48, 'Screenshot2020-10-13144944.png', 'food_5ff96ff265aed0.67052500.png', 'image/png', '2021-01-09 08:57:22', '2021-01-09 08:57:22'),
(49, '3.png', 'food_5ff9966a4b5369.39892049.png', 'image/png', '2021-01-09 11:41:30', NULL),
(50, '6.png', 'food_5ff99bcd8578d5.82101071.png', 'image/png', '2021-01-09 12:04:29', '2021-01-09 12:04:29'),
(51, 'Screenshot2020-10-13144911.png', 'food_5ff99c29adc543.12215049.png', 'image/png', '2021-01-09 12:06:01', '2021-01-09 12:06:01'),
(52, '', 'food_5ff9dc7668eef7.72179384.png', 'image/png', '2021-01-09 16:40:22', NULL),
(53, '', 'food_5ff9dc76695891.72573971.png', 'image/png', '2021-01-09 16:40:22', NULL),
(54, '', 'food_5ff9dc7669c163.92286071.png', 'image/png', '2021-01-09 16:40:22', NULL),
(55, '', 'food_5ff9dc766a2847.04035622.png', 'image/png', '2021-01-09 16:40:23', NULL),
(56, '', 'food_5ff9dc766aabb7.10856310.png', 'image/png', '2021-01-09 16:40:23', NULL),
(57, '', 'food_5ff9dc766b14c0.95318914.png', 'image/png', '2021-01-09 16:40:23', NULL),
(58, '3.png', 'food_5ff9f05a2bca96.31495311.png', 'image/png', '2021-01-09 18:05:14', NULL),
(59, '4.png', 'food_5ff9f05a2c5eb3.52680282.png', 'image/png', '2021-01-09 18:05:14', NULL),
(60, '5.png', 'food_5ff9f05a2cc833.12187282.png', 'image/png', '2021-01-09 18:05:14', NULL),
(61, '6.png', 'food_5ff9f05a2d2319.50977101.png', 'image/png', '2021-01-09 18:05:14', NULL),
(62, '7.png', 'food_5ff9f05a2d7f92.30803799.png', 'image/png', '2021-01-09 18:05:14', NULL),
(63, '8.png', 'food_5ff9f05a2de905.61008035.png', 'image/png', '2021-01-09 18:05:15', NULL),
(64, '4.png', 'food_5ff9f34380b3b6.08471816.png', 'image/png', '2021-01-09 18:17:39', NULL),
(65, '5.png', 'food_5ff9f343811e88.96303768.png', 'image/png', '2021-01-09 18:17:39', NULL),
(66, '6.png', 'food_5ff9f343818849.22761959.png', 'image/png', '2021-01-09 18:17:39', NULL),
(67, '7.png', 'food_5ff9f34381e5e7.51473949.png', 'image/png', '2021-01-09 18:17:40', NULL),
(68, '3.png', 'food_5ffa1ae2c685e0.70200697.png', 'image/png', '2021-01-09 21:06:42', NULL),
(69, '4.png', 'food_5ffa1ae2c6e011.42724627.png', 'image/png', '2021-01-09 21:06:42', NULL),
(70, '5.png', 'food_5ffa1ae2c74a43.23682268.png', 'image/png', '2021-01-09 21:06:43', NULL),
(71, '6.png', 'food_5ffa1ae2c79d99.89465320.png', 'image/png', '2021-01-09 21:06:43', NULL),
(72, '7.png', 'food_5ffa1ae2c7eef4.36162172.png', 'image/png', '2021-01-09 21:06:43', NULL),
(73, '8.png', 'food_5ffa1ae2c86be4.02200673.png', 'image/png', '2021-01-09 21:06:43', NULL),
(74, '3.png', 'food_5ffa1b7b598e08.65230866.png', 'image/png', '2021-01-09 21:09:15', NULL),
(75, '3.png', 'food_5ffa1ba7da8498.67335090.png', 'image/png', '2021-01-09 21:09:59', NULL),
(76, '3.png', 'food_5ffa1c3d8683e1.51336660.png', 'image/png', '2021-01-09 21:12:29', NULL),
(77, '4.png', 'food_5ffa1c3d8727b0.16910862.png', 'image/png', '2021-01-09 21:12:29', NULL),
(78, '5.png', 'food_5ffa1c3d879e81.28289507.png', 'image/png', '2021-01-09 21:12:29', NULL),
(79, '6.png', 'food_5ffa1c3d881d47.39062898.png', 'image/png', '2021-01-09 21:12:29', NULL),
(80, '7.png', 'food_5ffa1c3d88d3a6.19556134.png', 'image/png', '2021-01-09 21:12:30', NULL),
(81, '8.png', 'food_5ffa1c3d898242.76053310.png', 'image/png', '2021-01-09 21:12:30', NULL),
(82, '3.png', 'food_5ffa1eef728186.47766178.png', 'image/png', '2021-01-09 21:23:59', NULL),
(83, '4.png', 'food_5ffa1eef72d826.94226122.png', 'image/png', '2021-01-09 21:23:59', NULL),
(84, '5.png', 'food_5ffa1eef7348f5.46783079.png', 'image/png', '2021-01-09 21:23:59', NULL),
(85, '6.png', 'food_5ffa1eef73f482.82297964.png', 'image/png', '2021-01-09 21:23:59', NULL),
(86, '7.png', 'food_5ffa1eef74a515.58347449.png', 'image/png', '2021-01-09 21:24:00', NULL),
(87, '8.png', 'food_5ffa1eef750a56.68045342.png', 'image/png', '2021-01-09 21:24:00', NULL),
(88, '3.png', 'food_5ffa1fa44f8f15.24307023.png', 'image/png', '2021-01-09 21:27:00', NULL),
(89, '4.png', 'food_5ffa1fa4500552.13102615.png', 'image/png', '2021-01-09 21:27:00', NULL),
(90, '5.png', 'food_5ffa1fa4506fd1.58646497.png', 'image/png', '2021-01-09 21:27:00', NULL),
(91, '6.png', 'food_5ffa1fa450e1a4.94917750.png', 'image/png', '2021-01-09 21:27:00', NULL),
(92, '7.png', 'food_5ffa1fa45155b6.63877416.png', 'image/png', '2021-01-09 21:27:01', NULL),
(93, '8.png', 'food_5ffa1fa451be38.86515247.png', 'image/png', '2021-01-09 21:27:01', NULL),
(94, '3.png', 'food_5ffa203f7b9c33.12665264.png', 'image/png', '2021-01-09 21:29:35', NULL),
(95, '4.png', 'food_5ffa203f7c1831.47388216.png', 'image/png', '2021-01-09 21:29:35', NULL),
(96, '5.png', 'food_5ffa203f7c8a35.17194274.png', 'image/png', '2021-01-09 21:29:35', NULL),
(97, '6.png', 'food_5ffa203f7d2297.19390459.png', 'image/png', '2021-01-09 21:29:35', NULL),
(98, '7.png', 'food_5ffa203f7d9fa4.04049323.png', 'image/png', '2021-01-09 21:29:36', NULL),
(99, '8.png', 'food_5ffa203f7e0ed8.94400273.png', 'image/png', '2021-01-09 21:29:36', NULL),
(100, '3-Copy2.png', 'food_5ffa2134504c69.07073127.png', 'image/png', '2021-01-09 21:33:40', NULL),
(101, '3-Copy3.png', 'food_5ffa213450ae79.66636372.png', 'image/png', '2021-01-09 21:33:40', NULL),
(102, '3-Copy4.png', 'food_5ffa21345119d8.52650232.png', 'image/png', '2021-01-09 21:33:40', NULL),
(103, '3-Copy5.png', 'food_5ffa2134516d35.41789492.png', 'image/png', '2021-01-09 21:33:40', NULL),
(104, '3-Copy6.png', 'food_5ffa213451bd63.87779119.png', 'image/png', '2021-01-09 21:33:41', NULL),
(105, '3-Copy.png', 'food_5ffa2134520fc3.48760312.png', 'image/png', '2021-01-09 21:33:41', NULL),
(106, '3.png', 'food_5ffa2134525ef0.70544957.png', 'image/png', '2021-01-09 21:33:41', NULL),
(107, '4-Copy2.png', 'food_5ffa213452b079.96160550.png', 'image/png', '2021-01-09 21:33:41', NULL),
(108, '4-Copy3.png', 'food_5ffa2134530014.44705243.png', 'image/png', '2021-01-09 21:33:41', NULL),
(159, '5-Copy.png', 'food_5ffa2e0cb51de5.59092890.png', 'image/png', '2021-01-09 22:29:23', NULL),
(161, 'Calabar.jpg', 'food_600993cae2bb73.22270431.jpg', 'image/jpeg', '2021-01-21 14:46:34', '2021-01-21 14:46:34'),
(162, 'Screenshot2020-10-13145057.png', 'food_600831b2b3a310.38100640.png', 'image/png', '2021-01-20 13:35:46', '2021-01-20 13:35:46'),
(166, '3.png', 'food_6009510e51a501.76457827.png', 'image/png', '2021-01-21 10:01:50', NULL),
(169, 'Abuja.jpg', 'food_600989a9910680.26363946.jpg', 'image/jpeg', '2021-01-21 14:03:21', '2021-01-21 14:03:21'),
(172, '5.png', 'food_60098334558672.25256261.png', 'image/png', '2021-01-21 13:35:48', '2021-01-21 13:35:48'),
(173, 'Uyo.jpg', 'food_60098df12d3af1.11712302.jpg', 'image/jpeg', '2021-01-21 14:21:37', '2021-01-21 14:21:37'),
(174, 'Abuja.jpg', 'food_600993b9a648f5.28209634.jpg', 'image/jpeg', '2021-01-21 14:46:17', NULL),
(175, 'Calabar.jpg', 'food_600b368f921e57.66307449.jpg', 'image/jpeg', '2021-01-22 20:33:19', '2021-01-22 20:33:19'),
(177, 'Abuja.jpg', 'food_600bc388e15708.77803198.jpg', 'image/jpeg', '2021-01-23 06:34:48', '2021-01-23 06:34:48'),
(179, 'Calabar.jpg', 'food_600bc347f35333.73199657.jpg', 'image/jpeg', '2021-01-23 06:33:44', NULL),
(180, 'Abuja.jpg', 'food_600c1456501050.54689928.jpg', 'image/jpeg', '2021-01-23 12:19:34', NULL),
(181, 'Abuja.jpg', 'food_600c147b1993e3.74282584.jpg', 'image/jpeg', '2021-01-23 12:20:11', NULL),
(182, 'Abuja.jpg', 'food_600c148bf2caf7.75453165.jpg', 'image/jpeg', '2021-01-23 12:20:27', NULL),
(183, 'Abuja.jpg', 'food_600c158dbebf81.07934006.jpg', 'image/jpeg', '2021-01-23 12:24:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `date_created`, `date_updated`) VALUES
(38, 'Home', '2021-01-05 08:41:17', NULL),
(39, ' About Us', '2020-12-24 19:20:35', NULL),
(40, ' Junk page', '2020-12-24 19:21:04', NULL),
(43, ' Silly page', '2021-01-05 08:37:59', NULL),
(44, ' Fake again 2 ', '2021-01-06 09:26:18', NULL),
(45, ' Silly page 3 ', '2021-01-09 10:36:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_datas`
--

CREATE TABLE `page_datas` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text DEFAULT NULL,
  `file_id` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page_datas`
--

INSERT INTO `page_datas` (`id`, `title`, `content`, `file_id`, `date_created`, `date_updated`) VALUES
(18, 'slider', '{\"primary_title\":\"New slider title four\",\"enable_sec_title\":1,\"secondary_title\":\"New secondary title\",\"enable_btn_one\":1,\"btn_one_text\":\"button text one\",\"btn_one_link\":\"button one link\",\"enable_btn_two\":1,\"btn_two_text\":\"button two text\",\"btn_two_link\":\"button two link\"}', 19, '2021-01-21 14:12:41', '2021-01-21 02:12:41'),
(19, 'slider', '{\"primary_title\":\"Test slider\",\"enable_sec_title\":1,\"secondary_title\":\"hello one two\",\"enable_btn_one\":1,\"btn_one_text\":\"Hello world two\",\"btn_one_link\":\"Hello world three\",\"enable_btn_two\":1,\"btn_two_text\":\"Hello world four\",\"btn_two_link\":\"Helloo world four\"}', 20, '2020-12-30 10:13:33', NULL),
(36, 'home-advert', '{\"enable_advert_section\":\"1\",\"advert_title\":\"Hello titlee one\",\"advert_text\":\"Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Sed porttitor lectus nibh. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Proin eget tortor risus. Curabitur aliquet quam id dui posuer\",\"enable_advert_btn\":\"1\",\"advert_btn_text\":\"Hello world\",\"advert_btn_link\":\"Hello world two fake link\"}', 37, '2021-01-09 10:32:59', '2021-01-09 10:32:59'),
(38, 'home-health-tip', '{\"tip_title\":\"New title one\",\"enable_tip_subtitle\":\"1\",\"tip-subtitle\":\"New title Suntitle\",\"tip_description\":\"Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Proin eget tortor risus. Donec sollicitudin molestie malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec sollicitudin molestie malesuada. Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat.\"}', 39, '2021-01-05 07:29:38', NULL),
(40, 'home-advert', '', 41, '2021-01-05 10:01:25', NULL),
(41, 'home-advert', '', 42, '2021-01-05 10:01:45', NULL),
(42, 'home-advert', '', 43, '2021-01-05 10:06:54', NULL),
(43, 'home-health-tip', '{\"tip_title\":\"New title one\",\"enable_tip_subtitle\":\"1\",\"tip-subtitle\":\"New title Suntitle\",\"tip_description\":\"Hello world two\"}', 44, '2021-01-05 11:31:29', NULL),
(50, 'home-footer-banner', '{\"banner_title\":\"Hello one\",\"btn_text\":\"See All Cosmetology Courses\",\"btn_link\":\"https:\\/\\/cleveland.com\\/contact\"}', 0, '2021-01-09 08:47:16', '2021-01-09 08:47:16'),
(53, 'home-key-strength', '{\"section_title\":\"About Me, The Food Man three\",\"section_desc\":\"Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur aliquet quam id dui posuere blandit. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Nulla porttitor accumsan tincidunt. Vivamus suscipit torto\"}', 0, '2021-01-09 12:14:46', '2021-01-09 00:14:46'),
(54, 'home-strength-item', '{\"item_title\":\"hello one\",\"item_description\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vivamus magna justo, lacinia eget consectetur sed, convallis\"}', 49, '2021-01-09 11:41:30', NULL),
(57, 'home-equipment-section', '{\"section_title\":\"About Me, The Food Man 676\",\"section_desc\":\"Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec sollicitudin molestie malesuada. Proin eget tortor risus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquet quam id dui posuere blandit. Vivamus suscipit tortor eget felis porttitor volutpat. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. tytut\"}', 0, '2021-01-20 09:49:06', '2021-01-20 09:49:06'),
(185, 'home-equipment-item', '{\"path\":\"food_5ffa3f768610f5.18510276.png\"}', 0, '2021-01-09 23:42:46', NULL),
(226, 'main_faq', '{\"faq_title\":\"helele text one\",\"faq_answer\":\"Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Mauris blandit aliquet elit, eget tincidunt nibh p\"}', 0, '2021-01-11 17:23:17', NULL),
(227, 'main_faq', '{\"faq_title\":\"I am edited hello\",\"faq_answer\":\"Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.\"}', 0, '2021-01-11 22:29:38', NULL),
(228, 'home-equipment-item', '{\"path\":\"food_6007f9b8706061.28670544.png\"}', 0, '2021-01-20 09:36:56', NULL),
(229, 'home-equipment-item', '{\"path\":\"food_6008141b64b0e7.67256729.png\"}', 0, '2021-01-20 11:29:31', '2021-01-20 11:29:31'),
(231, 'home-equipment-item', '{\"path\":\"food_60081403f27a61.31564516.png\"}', 0, '2021-01-20 11:29:07', '2021-01-20 11:29:07'),
(232, 'main-section-about', '{\"section_title\":\"About Me, The Food Man nine\",\"enable_subtitle\":1,\"subtitle\":\"Silver Plan\",\"short_desc\":\"Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.\\r\\n\\r\\nNulla quis lorem ut libero malesuada feugiat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Pellentesque in ipsum id orci porta dapibus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec sollicitudin molestie malesuada.\\r\\n\\r\\nVivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur aliquet quam id dui posuere blandit.\",\"full_desc\":\"Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.\\r\\n\\r\\nNulla quis lorem ut libero malesuada feugiat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Pellentesque in ipsum id orci porta dapibus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec sollicitudin molestie malesuada.\\r\\n\\r\\nVivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur aliquet quam id dui posuere blandit.\",\"btn_text\":\"See All Cosmetology Courses\",\"btn_link\":\"hello thre\",\"vision_title\":\"our vission\",\"vision_content\":\"Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.\\r\\n\\r\\nNulla quis lorem ut libero malesuada feugiat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Pellentesque in ipsum id orci porta dapibus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec sollicitudin molestie malesuada.\\r\\n\\r\\nVivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur aliquet quam id dui posuere blandit.\",\"mission_title\":\"our mission\",\"mission_content\":\"Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.\\r\\n\\r\\nNulla quis lorem ut libero malesuada feugiat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Pellentesque in ipsum id orci porta dapibus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec sollicitudin molestie malesuada.\\r\\n\\r\\nVivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus. Pellentesque in ipsum id orci porta dapibus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur aliquet quam id dui posuere blandit.\"}', 0, '2021-01-22 13:30:14', '2021-01-22 01:30:14'),
(233, 'slider-image-about', '{\"path\":\"food_600ad389c7cea5.05018385.jpg\"}', 0, '2021-01-22 13:30:49', '2021-01-22 13:30:49'),
(234, 'slider-image-about', '{\"path\":\"food_600813d4e7dbf7.37287398.png\"}', 0, '2021-01-20 11:28:20', NULL),
(238, 'slider-image-about', '{\"path\":\"food_600816977edcc7.11064128.png\"}', 0, '2021-01-20 11:40:07', '2021-01-20 11:40:07'),
(239, 'about-challenge-item', '{\"challenge_title\":\"Hello world three\",\"challenge_desc\":\"ed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec sollicitudin molestie malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Nulla quis lorem ut libero malesuada feugiat. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur aliquet quam id dui posuere blandit. Cras ultricies ligula sed magna dictum porta. Quisque velit nisi, pretium ut lacinia in, elementum id enim.\"}', 161, '2021-01-20 13:34:58', '2021-01-20 01:34:58'),
(244, 'core-value-about', '{\"section_title\":\"About Us the food Man two uioi\",\"section_desc\":\"Donec sollicitudin molestie malesuada. Sed porttitor lectus nibh. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur aliquet quam id dui posuere blandit. Donec rutrum congue leo eget malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Sed porttitor lectus nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Sed porttitor lectus nibh.\"}', 0, '2021-01-22 13:31:14', '2021-01-22 01:31:14'),
(246, 'about-core-value-item', '{\"item_title\":\"Hello two thre\",\"item_desc\":\"Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Donec sollicitudin molestie malesuada. Nulla porttitor accumsan tincidunt. Donec sollicitudin molestie malesuada. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porttitor accumsan tincidunt. Ves\"}', 0, '2021-01-21 07:21:02', '2021-01-21 07:21:02'),
(248, 'about-core-value-item', '{\"item_title\":\"Hello five\",\"item_desc\":\"break;jj\"}', 0, '2021-01-22 13:31:47', '2021-01-22 13:31:47'),
(249, 'about-testimonial-section', '{\"section_title\":\"About Me, The Food Manie2jj\",\"section_desc\":\"Donec sollicitudin molestie malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Nulla porttitor accumsan tincidunt. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.\"}', 0, '2021-01-22 13:39:03', '2021-01-22 01:39:03'),
(250, 'about-team-member', '{\"member_name\":\"Hello one\",\"member_position\":\"Ok lagos\",\"member_desc\":\"Nulla quis lorem ut libero malesuada feugiat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan tincidunt. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vivamus suscipit tortor eget felis porttitor volutpat. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec rutrum congue leo eget malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.\\r\\nCurabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur aliquet quam id dui posuere blandit. Cras ultricies ligula sed magna dictum porta. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec rutrum congue leo eget malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Nulla quis lorem ut libero malesuada feugiat. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Nulla porttitor accumsan tincidunt.\",\"enable_fb\":1,\"member_fb\":\"hell one\",\"enable_lk\":1,\"member_lk\":\"Hello two\",\"enable_tw\":1,\"member_tw\":\"helloo three\"}', 166, '2021-01-21 10:01:50', NULL),
(253, 'about-team-member', '{\"member_name\":\"Hello one utitit\",\"member_position\":\"Ok lagos\",\"member_desc\":\"Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Lorem ipsum dolor sit amet, consec\",\"enable_fb\":1,\"member_fb\":\"hell one\",\"member_lk\":\"\",\"member_tw\":\"\",\"enable_lk\":0,\"enable_tw\":0}', 169, '2021-01-21 14:03:28', '2021-01-21 02:03:28'),
(256, 'about-testimonial-item', '{\"testifier_title\":\"tttt one and one\",\"testifier_name\":\"ttttt\",\"testifier_msg\":\"Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec soll\"}', 172, '2021-01-21 13:35:55', '2021-01-21 01:35:55'),
(257, 'about-testimonial-item', '{\"testifier_title\":\"tttt one and one5\",\"testifier_name\":\"ttttt\",\"testifier_msg\":\"Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit\"}', 173, '2021-01-21 14:21:49', '2021-01-21 02:21:49'),
(258, 'about-challenge-item', '{\"challenge_title\":\"Hello world three\",\"challenge_desc\":\"Curabitur aliquet quam id dui posuere blandit. Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Curabitur aliquet quam id dui posuere blandit. Vestibulu\"}', 174, '2021-01-21 02:46:17', NULL),
(259, 'about-footer-banner', '{\"banner_title\":\"Hello one two\",\"btn_text\":\"See All Cosmetology Courses\",\"btn_link\":\"https:\\/\\/cleveland.com\\/contact\"}', 0, '2021-01-21 15:26:58', '2021-01-21 03:26:58'),
(260, 'service-section-content', '{\"section_title\":\"hello oworld now again hell\",\"section_desc\":\"Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Proin eget tortor risus. Nulla porttitor accumsan tincidunt. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur aliquet quam id dui posuere blandit. Nulla porttitor accumsan tincidunt. Vivamus suscipit tortor eget felis porttitor volutpat. grabitur non n\"}', 0, '2021-01-21 15:47:14', '2021-01-21 03:47:14'),
(262, 'home-equipment-item', '{\"path\":\"food_600acffb5473f9.68708444.jpg\"}', 0, '2021-01-22 13:15:39', '2021-01-22 13:15:39'),
(263, 'home-equipment-item', '{\"path\":\"food_600acfceab46f0.33473033.jpg\"}', 0, '2021-01-22 13:14:54', NULL),
(264, 'home-equipment-item', '{\"path\":\"food_600acfdd538c37.98801476.jpg\"}', 0, '2021-01-22 13:15:09', '2021-01-22 13:15:09'),
(267, 'slider', '{\"primary_title\":\"New slider title\",\"enable_sec_title\":1,\"secondary_title\":\"New secondary title\",\"enable_btn_one\":1,\"btn_one_text\":\"button text one\",\"btn_one_link\":\"button one link\",\"enable_btn_two\":1,\"btn_two_text\":\"Hello world four\",\"btn_two_link\":\"button two link\"}', 175, '2021-01-22 01:17:08', NULL),
(269, 'service-item', '{\"short_title\":\"Hello short tile two\",\"full_title\":\"Hello full title three\",\"service_cat\":\"new category title\",\"service_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquet quam id dui posuere blandit. Vestibulum ante ipsum primis in faucibus orci luctus et ultricesvyuu\"}', 177, '2021-01-23 06:35:31', '2021-01-23 06:35:31'),
(271, 'service-item', '{\"short_title\":\"Hello short tile one\",\"full_title\":\"Hello full titledfedf\",\"service_cat\":\"new category title\",\"service_desc\":\"Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Cras ultricies ligula sed magna dictum porta. Cras ultricies ligula sed magna dictum porta. Don\"}', 179, '2021-01-23 06:33:44', NULL),
(272, 'gallery-item', '{\"gallery_cat\":\"gallery titlte one\",\"path\":\"food_600bd1523a01e6.58797750.jpg\"}', 0, '2021-01-23 07:33:38', NULL),
(273, 'gallery-item', '{\"gallery_cat\":\"gallery titlte one\",\"path\":\"food_600bd1523a6419.87731528.jpg\"}', 0, '2021-01-23 07:33:38', NULL),
(274, 'gallery-item', '{\"gallery_cat\":\"gallery titlte one\",\"path\":\"food_600bd1523abde0.71245763.jpg\"}', 0, '2021-01-23 07:33:38', NULL),
(275, 'gallery-item', '{\"gallery_cat\":\"gallery titlte one\",\"path\":\"food_600bd1523b1209.80866852.jpg\"}', 0, '2021-01-23 07:33:38', NULL),
(276, 'home-equipment-item', '{\"path\":\"food_600bd18b7e4207.03761446.jpg\"}', 0, '2021-01-23 07:34:35', NULL),
(277, 'home-equipment-item', '{\"path\":\"food_600bd18b7ea0c5.64144860.jpg\"}', 0, '2021-01-23 07:34:35', NULL),
(278, 'home-equipment-item', '{\"path\":\"food_600bd18b7efd44.49268091.jpg\"}', 0, '2021-01-23 07:34:35', NULL),
(281, 'gallery-item', '{\"gallery_cat\":\"gallery title four\",\"path\":\"food_600bd29fca07a5.01981592.jpg\"}', 0, '2021-01-23 07:39:11', NULL),
(282, 'gallery-item', '{\"path\":\"food_600bd31db2f819.56317818.jpg\",\"gallery_cat\":\"Hello two\"}', 0, '2021-01-23 07:41:17', '2021-01-23 07:41:17'),
(283, 'gallery-item', '{\"path\":\"food_600bd39d699ff5.64128951.jpg\",\"gallery_cat\":\"Hello two\"}', 0, '2021-01-23 07:43:25', '2021-01-23 07:43:25'),
(284, 'service-footer-banner', '{\"banner_title\":\"Hello onedd\",\"btn_text\":\"See All Cosmetology Courses\",\"btn_link\":\"https:\\/\\/cleveland.com\\/services\"}', 0, '2021-01-23 08:24:30', '2021-01-23 08:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `file_id` int(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `surname`, `username`, `email`, `file_id`, `password`, `date_created`, `date_updated`, `role`, `status`) VALUES
(2, 'Idiono-mfon', 'Etim', 'test', 'abrahamterahdebik@gmail.com', 183, '$2y$10$1BTJEkE3dXZ0hmibFQPhNueUE.5LXlBWE66MyHaIBOyhuFzeYi2Ea', '2021-01-23 12:30:37', NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `file_id` (`file_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `page_datas`
--
ALTER TABLE `page_datas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `file_id` (`file_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `page_datas`
--
ALTER TABLE `page_datas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
