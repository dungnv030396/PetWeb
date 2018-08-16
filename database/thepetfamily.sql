-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2018 at 06:26 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thepetfamily`
--
CREATE DATABASE IF NOT EXISTS `thepetfamily` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `thepetfamily`;

-- --------------------------------------------------------

--
-- Table structure for table `catalogs`
--

DROP TABLE IF EXISTS `catalogs`;
CREATE TABLE IF NOT EXISTS `catalogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catalogs`
--

INSERT INTO `catalogs` (`id`, `name`) VALUES
(1, 'Vật nuôi'),
(2, 'Sản phẩm'),
(3, 'Dịch vụ cho vật nuôi');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `catalog_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `catalog_id`, `created_at`, `updated_at`) VALUES
(1, 'chó', 1, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(2, 'mèo', 1, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(3, 'chim', 1, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(4, 'thức ăn', 2, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(5, 'đồ chơi', 2, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(6, 'quần áo', 2, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(7, 'làm đẹp', 3, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(8, 'trông giữ', 3, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(9, 'chữa trị', 3, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(10, 'đồ dùng', 2, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(11, 'Chim', 1, '2018-08-09 17:02:15', '2018-08-09 17:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `code` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`code`, `name`, `type`) VALUES
('01', 'Thành phố Hà Nội', 'Thành phố Trung ương'),
('02', 'Tỉnh Hà Giang', 'Tỉnh'),
('04', 'Tỉnh Cao Bằng', 'Tỉnh'),
('06', 'Tỉnh Bắc Kạn', 'Tỉnh'),
('08', 'Tỉnh Tuyên Quang', 'Tỉnh'),
('10', 'Tỉnh Lào Cai', 'Tỉnh'),
('11', 'Tỉnh Điện Biên', 'Tỉnh'),
('12', 'Tỉnh Lai Châu', 'Tỉnh'),
('14', 'Tỉnh Sơn La', 'Tỉnh'),
('15', 'Tỉnh Yên Bái', 'Tỉnh'),
('17', 'Tỉnh Hoà Bình', 'Tỉnh'),
('19', 'Tỉnh Thái Nguyên', 'Tỉnh'),
('20', 'Tỉnh Lạng Sơn', 'Tỉnh'),
('22', 'Tỉnh Quảng Ninh', 'Tỉnh'),
('24', 'Tỉnh Bắc Giang', 'Tỉnh'),
('25', 'Tỉnh Phú Thọ', 'Tỉnh'),
('26', 'Tỉnh Vĩnh Phúc', 'Tỉnh'),
('27', 'Tỉnh Bắc Ninh', 'Tỉnh'),
('30', 'Tỉnh Hải Dương', 'Tỉnh'),
('31', 'Thành phố Hải Phòng', 'Thành phố Trung ương'),
('33', 'Tỉnh Hưng Yên', 'Tỉnh'),
('34', 'Tỉnh Thái Bình', 'Tỉnh'),
('35', 'Tỉnh Hà Nam', 'Tỉnh'),
('36', 'Tỉnh Nam Định', 'Tỉnh'),
('37', 'Tỉnh Ninh Bình', 'Tỉnh'),
('38', 'Tỉnh Thanh Hóa', 'Tỉnh'),
('40', 'Tỉnh Nghệ An', 'Tỉnh'),
('42', 'Tỉnh Hà Tĩnh', 'Tỉnh'),
('44', 'Tỉnh Quảng Bình', 'Tỉnh'),
('45', 'Tỉnh Quảng Trị', 'Tỉnh'),
('46', 'Tỉnh Thừa Thiên Huế', 'Tỉnh'),
('48', 'Thành phố Đà Nẵng', 'Thành phố Trung ương'),
('49', 'Tỉnh Quảng Nam', 'Tỉnh'),
('51', 'Tỉnh Quảng Ngãi', 'Tỉnh'),
('52', 'Tỉnh Bình Định', 'Tỉnh'),
('54', 'Tỉnh Phú Yên', 'Tỉnh'),
('56', 'Tỉnh Khánh Hòa', 'Tỉnh'),
('58', 'Tỉnh Ninh Thuận', 'Tỉnh'),
('60', 'Tỉnh Bình Thuận', 'Tỉnh'),
('62', 'Tỉnh Kon Tum', 'Tỉnh'),
('64', 'Tỉnh Gia Lai', 'Tỉnh'),
('66', 'Tỉnh Đắk Lắk', 'Tỉnh'),
('67', 'Tỉnh Đắk Nông', 'Tỉnh'),
('68', 'Tỉnh Lâm Đồng', 'Tỉnh'),
('70', 'Tỉnh Bình Phước', 'Tỉnh'),
('72', 'Tỉnh Tây Ninh', 'Tỉnh'),
('74', 'Tỉnh Bình Dương', 'Tỉnh'),
('75', 'Tỉnh Đồng Nai', 'Tỉnh'),
('77', 'Tỉnh Bà Rịa - Vũng Tàu', 'Tỉnh'),
('79', 'Thành phố Hồ Chí Minh', 'Thành phố Trung ương'),
('80', 'Tỉnh Long An', 'Tỉnh'),
('82', 'Tỉnh Tiền Giang', 'Tỉnh'),
('83', 'Tỉnh Bến Tre', 'Tỉnh'),
('84', 'Tỉnh Trà Vinh', 'Tỉnh'),
('86', 'Tỉnh Vĩnh Long', 'Tỉnh'),
('87', 'Tỉnh Đồng Tháp', 'Tỉnh'),
('89', 'Tỉnh An Giang', 'Tỉnh'),
('91', 'Tỉnh Kiên Giang', 'Tỉnh'),
('92', 'Thành phố Cần Thơ', 'Thành phố Trung ương'),
('93', 'Tỉnh Hậu Giang', 'Tỉnh'),
('94', 'Tỉnh Sóc Trăng', 'Tỉnh'),
('95', 'Tỉnh Bạc Liêu', 'Tỉnh'),
('96', 'Tỉnh Cà Mau', 'Tỉnh');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `media_link` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `delete_flag` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `product_id`, `media_link`, `description`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 5, 13, NULL, 'good', 0, '2018-08-01 11:21:17', '2018-08-01 11:21:17'),
(2, 5, 2, NULL, 'good product :v', 0, '2018-08-01 11:22:27', '2018-08-01 11:22:27'),
(3, 5, 2, 'https://www.youtube.com/embed/owWLZq3y2-4', 'nice', 0, '2018-08-01 11:23:41', '2018-08-01 11:23:41'),
(4, 5, 2, NULL, '1', 0, '2018-08-01 12:19:21', '2018-08-01 12:19:21'),
(5, 5, 2, NULL, '2', 0, '2018-08-01 12:19:29', '2018-08-01 12:19:29'),
(6, 5, 2, NULL, '3', 0, '2018-08-01 12:19:37', '2018-08-01 12:19:37'),
(7, 5, 2, NULL, '5', 0, '2018-08-01 12:19:48', '2018-08-01 12:19:48'),
(8, 5, 2, NULL, 'sd', 0, '2018-08-01 13:14:27', '2018-08-01 13:14:27'),
(9, 5, 2, 'https://www.youtube.com/embed/owWLZq3y2-4', 'like that', 0, '2018-08-01 13:34:46', '2018-08-01 13:34:46'),
(10, 5, 2, 'sdsa', 'dsa', 0, '2018-08-01 13:42:32', '2018-08-01 13:42:32'),
(11, 5, 2, NULL, 'dsadasds', 0, '2018-08-04 14:33:00', '2018-08-04 14:33:00'),
(12, 5, 2, NULL, 'dsdsda', 0, '2018-08-04 14:33:22', '2018-08-04 14:33:22'),
(13, 5, 2, NULL, 's111111', 0, '2018-08-04 14:40:57', '2018-08-04 14:40:57'),
(14, 5, 2, NULL, 's111111', 0, '2018-08-04 14:40:58', '2018-08-04 14:40:58'),
(15, 5, 2, NULL, 's111111', 0, '2018-08-04 14:40:58', '2018-08-04 14:40:58'),
(16, 5, 2, NULL, 's111111', 0, '2018-08-04 14:40:58', '2018-08-04 14:40:58'),
(17, 5, 2, NULL, 's111111', 0, '2018-08-04 14:40:58', '2018-08-04 14:40:58'),
(18, 5, 2, NULL, 'fsdf', 0, '2018-08-04 15:08:28', '2018-08-04 15:08:28'),
(19, 5, 2, NULL, 'dsads', 0, '2018-08-04 15:09:50', '2018-08-04 15:09:50'),
(20, 5, 2, NULL, 'tesst', 0, '2018-08-04 15:12:50', '2018-08-04 15:12:50'),
(21, 5, 2, NULL, 'dsads', 0, '2018-08-04 15:15:09', '2018-08-04 15:15:09'),
(22, 5, 2, NULL, '1234355', 0, '2018-08-04 15:15:51', '2018-08-04 15:15:51'),
(23, 5, 2, NULL, 'đasadsdas', 0, '2018-08-05 11:56:14', '2018-08-05 11:56:14'),
(24, 5, 2, NULL, 'đá', 0, '2018-08-05 12:12:10', '2018-08-05 12:12:10'),
(25, 5, 18, NULL, 'dsad', 0, '2018-08-10 15:53:01', '2018-08-10 15:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `orderline_statuses`
--

DROP TABLE IF EXISTS `orderline_statuses`;
CREATE TABLE IF NOT EXISTS `orderline_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderline_statuses`
--

INSERT INTO `orderline_statuses` (`id`, `stt`) VALUES
(1, 'đang xử lý'),
(2, 'đang vận chuyển'),
(3, 'đã vào kho'),
(4, 'đang ship'),
(5, 'hoàn thành');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(4) NOT NULL DEFAULT '1',
  `address` varchar(255) NOT NULL,
  `city_code` int(11) NOT NULL DEFAULT '1',
  `warehouse_id` int(11) NOT NULL DEFAULT '1',
  `moderator_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `delete_flag` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status_id`, `address`, `city_code`, `warehouse_id`, `moderator_id`, `user_id`, `payment_id`, `delete_flag`, `created_at`, `updated_at`, `completed_at`) VALUES
(9, 2, 'HCM', 0, 1, 5, 5, 15, 0, '2018-08-04 13:28:56', '2018-08-10 13:06:47', NULL),
(10, 2, 'HCM', 0, 1, 5, 5, 16, 0, '2018-08-04 13:30:12', '2018-08-10 12:53:59', NULL),
(11, 2, 'HCM11111111', 0, 1, 5, 5, 17, 0, '2018-08-04 13:42:37', '2018-08-10 12:53:17', NULL),
(12, 3, 'Hà Nội', 0, 1, 5, 5, 18, 0, '2018-08-06 15:44:49', '2018-08-15 06:12:32', NULL),
(13, 2, 'dsadsadsad', 0, 1, 5, 5, 19, 0, '2018-08-06 15:45:18', '2018-08-10 13:10:08', NULL),
(14, 2, 'dsadsadsad', 0, 1, 5, 5, 20, 0, '2018-08-06 15:45:59', '2018-08-10 13:51:04', NULL),
(15, 2, 'HCM', 0, 1, 5, 5, 21, 0, '2018-08-06 15:46:28', '2018-08-14 10:11:32', NULL),
(16, 1, 'dsadsadsad', 0, 1, NULL, 5, 22, 0, '2018-08-09 11:28:56', '2018-08-09 11:28:56', NULL),
(17, 1, 'sads', 0, 1, NULL, 5, 23, 0, '2018-08-09 11:30:15', '2018-08-09 11:30:15', NULL),
(18, 1, 'dsadsadsad', 0, 1, NULL, 5, 24, 0, '2018-08-09 11:34:21', '2018-08-09 11:34:21', NULL),
(19, 1, 'dsadsadsad', 0, 1, NULL, 5, 25, 0, '2018-08-09 11:35:48', '2018-08-09 11:35:48', NULL),
(20, 1, 'Hà Nội', 0, 1, NULL, 5, 26, 0, '2018-08-09 11:37:02', '2018-08-09 11:37:02', NULL),
(21, 1, 'Hà Nội', 0, 1, NULL, 5, 27, 0, '2018-08-09 11:38:22', '2018-08-09 11:38:22', NULL),
(22, 1, 'dsad', 0, 1, NULL, 5, 28, 0, '2018-08-09 11:38:52', '2018-08-09 11:38:52', NULL),
(23, 1, 'Hà Nội', 0, 1, NULL, 5, 29, 0, '2018-08-09 11:39:15', '2018-08-09 11:39:15', NULL),
(24, 1, 'Hà Nội', 0, 1, NULL, 5, 30, 0, '2018-08-09 11:48:02', '2018-08-09 11:48:02', NULL),
(25, 1, 'Hà Nội', 0, 1, NULL, 5, 31, 0, '2018-08-09 11:49:43', '2018-08-09 11:49:43', NULL),
(26, 1, 'Hà Nội', 0, 1, NULL, 5, 32, 0, '2018-08-09 11:51:30', '2018-08-09 11:51:30', NULL),
(27, 1, 'Hà Nội', 0, 1, NULL, 5, 33, 0, '2018-08-09 11:52:57', '2018-08-09 11:52:57', NULL),
(28, 1, 'Hà Nội', 0, 1, NULL, 5, 34, 0, '2018-08-09 11:53:41', '2018-08-09 11:53:41', NULL),
(29, 1, 'Hà Nội', 0, 1, NULL, 5, 35, 0, '2018-08-09 11:54:41', '2018-08-09 11:54:41', NULL),
(30, 1, 'HCM11111111', 0, 1, NULL, 5, 36, 0, '2018-08-09 11:55:37', '2018-08-09 11:55:37', NULL),
(31, 1, 'Hà Nội', 0, 1, NULL, 5, 37, 0, '2018-08-09 11:57:54', '2018-08-09 11:57:54', NULL),
(32, 1, 'đường Đình Thôn, phường Mỹ Đình 1, quận Nam Từ Liêm, Hà Nội', 0, 1, NULL, 5, 38, 0, '2018-08-09 12:48:27', '2018-08-09 12:48:27', NULL),
(33, 1, 'Hà Nội', 0, 1, NULL, 5, 39, 0, '2018-08-09 13:05:57', '2018-08-09 13:05:57', NULL),
(34, 1, 'Hà Nội', 0, 1, NULL, 5, 40, 0, '2018-08-09 13:07:04', '2018-08-09 13:07:04', NULL),
(35, 1, 'Hà Nội', 0, 1, NULL, 5, 41, 0, '2018-08-09 13:11:06', '2018-08-09 13:11:06', NULL),
(36, 1, 'Hà Nội', 0, 1, NULL, 5, 42, 1, '2018-08-09 13:12:06', '2018-08-09 13:12:06', NULL),
(37, 1, 'dsadsadsad ,Tỉnh Vĩnh Phúc', 1, 1, NULL, 10, 43, 0, '2018-08-13 09:20:09', '2018-08-13 09:20:09', NULL),
(38, 3, 'dsadsadsad ,Tỉnh Vĩnh Phúc,Tỉnh Thái Nguyên', 1, 1, NULL, 10, 44, 0, '2018-08-13 09:21:11', '2018-08-14 15:52:36', NULL),
(39, 5, 'cho nay,Thành phố Hà Nội', 1, 1, 5, 10, 45, 0, '2018-08-13 09:22:18', '2018-08-14 12:20:19', NULL),
(40, 1, 'dsadsadsad ,Tỉnh Vĩnh Phúc,Tỉnh Thái Nguyên,Tỉnh Quảng Ninh', 22, 1, NULL, 10, 46, 0, '2018-08-13 09:24:43', '2018-08-14 12:23:25', NULL),
(41, 1, 'dấd,Tỉnh Đắk Lắk', 66, 2, NULL, 7, 47, 0, '2018-08-13 14:56:39', '2018-08-13 14:56:39', NULL),
(42, 1, 'số 117,Tỉnh Bà Rịa - Vũng Tàu', 77, 3, NULL, 7, 48, 0, '2018-08-13 15:03:39', '2018-08-13 15:03:39', NULL),
(43, 5, 'Hà Nội,Tỉnh Hà Giang,Tỉnh Bà Rịa - Vũng Tàu', 77, 3, 5, 7, 49, 0, '2018-08-13 15:09:35', '2018-08-16 15:14:59', NULL),
(44, 2, 'dsadasds,Tỉnh Hà Giang', 2, 1, 5, 7, 50, 1, '2018-08-13 15:14:01', '2018-08-14 10:07:01', NULL),
(47, 2, 'Hà Nội,Tỉnh Hà Giang,Tỉnh Bà Rịa - Vũng Tàu', 2, 1, 5, 7, 53, 1, '2018-08-13 15:22:23', '2018-08-14 12:24:24', NULL),
(48, 5, 'Hà Nội,Tỉnh Hà Giang,Tỉnh Bà Rịa - Vũng Tàu', 2, 1, 5, 7, 54, 0, '2018-08-13 15:23:38', '2018-08-14 12:23:46', NULL),
(49, 4, 'Hà Nội', 1, 1, 5, 1, 55, 1, '2018-08-13 18:58:57', '2018-08-14 10:12:33', NULL),
(50, 5, 'Hà Nội,Tỉnh Hà Giang,Tỉnh Bà Rịa - Vũng Tàu', 2, 1, 5, 7, 56, 0, '2018-08-14 15:30:21', '2018-08-14 15:37:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_lines`
--

DROP TABLE IF EXISTS `order_lines`;
CREATE TABLE IF NOT EXISTS `order_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `city_code` int(11) NOT NULL DEFAULT '1',
  `warehouse_id` int(11) NOT NULL DEFAULT '1',
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `orderline_status_id` int(11) NOT NULL DEFAULT '1',
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_lines`
--

INSERT INTO `order_lines` (`id`, `order_id`, `city_code`, `warehouse_id`, `product_id`, `quantity`, `amount`, `orderline_status_id`, `sent_at`, `created_at`, `updated_at`) VALUES
(8, 5, 1, 1, 2, 1, 6800000, 1, NULL, '2018-07-29 17:29:46', '2018-07-29 17:29:46'),
(9, 5, 1, 1, 3, 1, 10000000, 1, NULL, '2018-07-29 17:29:46', '2018-07-29 17:29:46'),
(10, 6, 1, 1, 10, 1, 11347500, 1, NULL, '2018-07-29 17:44:14', '2018-07-29 17:44:14'),
(11, 6, 1, 1, 6, 1, 3815000, 1, NULL, '2018-07-29 17:44:14', '2018-07-29 17:44:14'),
(12, 7, 1, 1, 2, 1, 6800000, 1, NULL, '2018-07-29 18:09:16', '2018-07-29 18:09:16'),
(13, 8, 1, 1, 2, 1, 6800000, 1, NULL, '2018-07-29 18:24:24', '2018-07-29 18:24:24'),
(14, 9, 1, 1, 2, 1, 6800000, 4, NULL, '2018-08-04 13:28:56', '2018-08-04 13:28:56'),
(15, 10, 1, 1, 2, 1, 6800000, 3, NULL, '2018-08-04 13:30:12', '2018-08-04 13:30:12'),
(16, 11, 1, 2, 3, 1, 10000000, 1, NULL, '2018-08-04 13:42:37', '2018-08-04 13:42:37'),
(17, 12, 1, 1, 7, 1, 2550000, 3, NULL, '2018-08-06 15:44:49', '2018-08-15 06:12:32'),
(18, 13, 1, 1, 7, 1, 2550000, 2, NULL, '2018-08-06 15:45:18', '2018-08-13 19:35:11'),
(19, 14, 1, 1, 7, 1, 2550000, 2, NULL, '2018-08-06 15:45:59', '2018-08-13 19:35:24'),
(20, 15, 1, 1, 7, 4, 10200000, 2, NULL, '2018-08-06 15:46:28', '2018-08-13 19:42:25'),
(21, 16, 1, 1, 10, 1, 11347500, 2, NULL, '2018-08-09 11:28:56', '2018-08-14 06:39:06'),
(22, 17, 1, 1, 7, 1, 2550000, 2, '2018-08-16 12:54:54', '2018-08-09 11:30:15', '2018-08-16 12:54:54'),
(23, 17, 1, 1, 1, 1, 10350000, 2, '2018-08-16 12:40:48', '2018-08-09 11:30:15', '2018-08-16 12:40:48'),
(24, 18, 1, 1, 1, 1, 10350000, 1, NULL, '2018-08-09 11:34:21', '2018-08-09 11:34:21'),
(25, 18, 1, 1, 7, 1, 2550000, 1, NULL, '2018-08-09 11:34:21', '2018-08-09 11:34:21'),
(26, 19, 1, 1, 3, 1, 10000000, 1, NULL, '2018-08-09 11:35:48', '2018-08-09 11:35:48'),
(27, 19, 1, 1, 7, 1, 2550000, 1, NULL, '2018-08-09 11:35:48', '2018-08-09 11:35:48'),
(28, 20, 1, 1, 3, 1, 10000000, 1, NULL, '2018-08-09 11:37:02', '2018-08-09 11:37:02'),
(29, 20, 1, 1, 7, 1, 2550000, 1, NULL, '2018-08-09 11:37:02', '2018-08-09 11:37:02'),
(30, 21, 1, 1, 3, 1, 10000000, 1, NULL, '2018-08-09 11:38:22', '2018-08-09 11:38:22'),
(31, 21, 1, 1, 7, 1, 2550000, 1, NULL, '2018-08-09 11:38:22', '2018-08-09 11:38:22'),
(32, 22, 1, 1, 3, 1, 10000000, 1, NULL, '2018-08-09 11:38:52', '2018-08-09 11:38:52'),
(33, 22, 1, 1, 7, 1, 2550000, 1, NULL, '2018-08-09 11:38:52', '2018-08-09 11:38:52'),
(34, 23, 1, 1, 3, 1, 10000000, 1, NULL, '2018-08-09 11:39:15', '2018-08-09 11:39:15'),
(35, 23, 1, 1, 7, 1, 2550000, 1, NULL, '2018-08-09 11:39:15', '2018-08-09 11:39:15'),
(36, 24, 1, 1, 3, 2, 20000000, 1, NULL, '2018-08-09 11:48:02', '2018-08-09 11:48:02'),
(37, 24, 1, 1, 7, 2, 5100000, 1, NULL, '2018-08-09 11:48:02', '2018-08-09 11:48:02'),
(38, 25, 1, 1, 3, 2, 20000000, 1, NULL, '2018-08-09 11:49:43', '2018-08-09 11:49:43'),
(39, 26, 1, 1, 3, 1, 10000000, 1, NULL, '2018-08-09 11:51:30', '2018-08-09 11:51:30'),
(40, 27, 1, 1, 4, 1, 4000000, 1, NULL, '2018-08-09 11:52:57', '2018-08-09 11:52:57'),
(41, 28, 1, 1, 7, 2, 5100000, 1, NULL, '2018-08-09 11:53:41', '2018-08-09 11:53:41'),
(42, 29, 1, 1, 7, 1, 2550000, 1, NULL, '2018-08-09 11:54:41', '2018-08-09 11:54:41'),
(43, 30, 1, 1, 7, 2, 5100000, 1, NULL, '2018-08-09 11:55:37', '2018-08-09 11:55:37'),
(44, 31, 1, 1, 7, 2, 5100000, 1, NULL, '2018-08-09 11:57:54', '2018-08-09 11:57:54'),
(45, 32, 1, 1, 7, 1, 2550000, 1, NULL, '2018-08-09 12:48:27', '2018-08-09 12:48:27'),
(46, 32, 1, 1, 8, 1, 13350000, 2, NULL, '2018-08-09 12:48:27', '2018-08-16 12:28:49'),
(47, 33, 1, 1, 1, 1, 10350000, 2, NULL, '2018-08-09 13:05:57', '2018-08-16 12:28:43'),
(48, 34, 1, 1, 7, 1, 2550000, 2, NULL, '2018-08-09 13:07:04', '2018-08-16 12:28:33'),
(49, 35, 1, 1, 7, 1, 2550000, 2, NULL, '2018-08-09 13:11:06', '2018-08-16 12:28:29'),
(50, 36, 1, 1, 7, 1, 2550000, 2, '2018-08-16 13:00:36', '2018-08-09 13:12:06', '2018-08-16 13:00:36'),
(51, 37, 26, 1, 7, 2, 5100000, 1, NULL, '2018-08-13 09:20:09', '2018-08-13 09:20:09'),
(52, 38, 19, 1, 7, 3, 7650000, 3, NULL, '2018-08-13 09:21:11', '2018-08-14 15:52:36'),
(53, 39, 1, 1, 7, 1, 2550000, 3, NULL, '2018-08-13 09:22:18', '2018-08-14 12:11:52'),
(54, 40, 22, 1, 7, 1, 2550000, 3, NULL, '2018-08-13 09:24:43', '2018-08-14 12:10:13'),
(55, 41, 66, 1, 7, 2, 5100000, 2, NULL, '2018-08-13 14:56:39', '2018-08-16 12:27:08'),
(56, 42, 77, 3, 7, 3, 7650000, 2, NULL, '2018-08-13 15:03:39', '2018-08-14 12:08:52'),
(57, 42, 77, 3, 16, 1, 500000, 1, NULL, '2018-08-13 15:03:39', '2018-08-13 15:03:39'),
(58, 43, 77, 3, 7, 2, 5100000, 5, NULL, '2018-08-13 15:09:35', '2018-08-16 15:14:59'),
(59, 44, 2, 1, 7, 1, 2550000, 1, NULL, '2018-08-13 15:14:01', '2018-08-13 15:14:01'),
(60, 45, 2, 1, 7, 3, 7650000, 1, NULL, '2018-08-13 15:16:12', '2018-08-13 15:16:12'),
(61, 45, 2, 1, 15, 1, 450000, 1, NULL, '2018-08-13 15:16:12', '2018-08-13 15:16:12'),
(62, 45, 2, 1, 2, 1, 6800000, 1, NULL, '2018-08-13 15:16:12', '2018-08-13 15:16:12'),
(63, 46, 2, 1, 7, 1, 2550000, 1, NULL, '2018-08-13 15:20:11', '2018-08-13 15:20:11'),
(64, 47, 2, 1, 7, 1, 2550000, 1, NULL, '2018-08-13 15:22:23', '2018-08-13 15:22:23'),
(65, 48, 2, 1, 17, 1, 50000, 5, NULL, '2018-08-13 15:23:38', '2018-08-14 12:23:46'),
(66, 48, 2, 1, 16, 1, 500000, 5, NULL, '2018-08-13 15:23:38', '2018-08-14 12:23:46'),
(67, 48, 2, 1, 15, 1, 450000, 5, NULL, '2018-08-13 15:23:38', '2018-08-14 12:23:46'),
(68, 48, 2, 1, 14, 1, 500000, 5, NULL, '2018-08-13 15:23:38', '2018-08-14 12:23:46'),
(69, 48, 2, 1, 7, 1, 2550000, 5, NULL, '2018-08-13 15:23:38', '2018-08-14 12:23:46'),
(70, 49, 1, 1, 7, 1, 2550000, 3, NULL, '2018-08-13 18:58:57', '2018-08-14 11:56:24'),
(71, 50, 2, 1, 7, 2, 5100000, 5, NULL, '2018-08-14 15:30:21', '2018-08-14 15:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_logs`
--

DROP TABLE IF EXISTS `order_logs`;
CREATE TABLE IF NOT EXISTS `order_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_tokens`
--

DROP TABLE IF EXISTS `password_tokens`;
CREATE TABLE IF NOT EXISTS `password_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(4) NOT NULL DEFAULT '1',
  `amount` int(11) NOT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `payment_info` text,
  `security` varchar(255) DEFAULT NULL,
  `user_message` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `status`, `amount`, `payment`, `payment_info`, `security`, `user_message`, `created_at`, `updated_at`) VALUES
(11, 1, 16800000, NULL, NULL, NULL, NULL, '2018-07-29 17:29:46', '2018-07-29 17:29:46'),
(12, 1, 15162500, NULL, NULL, NULL, NULL, '2018-07-29 17:44:14', '2018-07-29 17:44:14'),
(13, 1, 6800000, NULL, NULL, NULL, NULL, '2018-07-29 18:09:16', '2018-07-29 18:09:16'),
(14, 1, 6800000, NULL, NULL, NULL, NULL, '2018-07-29 18:24:24', '2018-07-29 18:24:24'),
(15, 1, 6800000, NULL, NULL, NULL, NULL, '2018-08-04 13:28:56', '2018-08-04 13:28:56'),
(16, 1, 6800000, NULL, NULL, NULL, NULL, '2018-08-04 13:30:12', '2018-08-04 13:30:12'),
(17, 1, 10000000, NULL, NULL, NULL, NULL, '2018-08-04 13:42:37', '2018-08-04 13:42:37'),
(18, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-06 15:44:49', '2018-08-06 15:44:49'),
(19, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-06 15:45:18', '2018-08-06 15:45:18'),
(20, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-06 15:45:59', '2018-08-06 15:45:59'),
(21, 1, 10200000, NULL, NULL, NULL, NULL, '2018-08-06 15:46:28', '2018-08-06 15:46:28'),
(22, 1, 11347500, NULL, NULL, NULL, NULL, '2018-08-09 11:28:56', '2018-08-09 11:28:56'),
(23, 1, 12900000, NULL, NULL, NULL, NULL, '2018-08-09 11:30:15', '2018-08-09 11:30:15'),
(24, 1, 12900000, NULL, NULL, NULL, NULL, '2018-08-09 11:34:21', '2018-08-09 11:34:21'),
(25, 1, 12550000, NULL, NULL, NULL, NULL, '2018-08-09 11:35:48', '2018-08-09 11:35:48'),
(26, 1, 12550000, NULL, NULL, NULL, NULL, '2018-08-09 11:37:02', '2018-08-09 11:37:02'),
(27, 1, 12550000, NULL, NULL, NULL, NULL, '2018-08-09 11:38:22', '2018-08-09 11:38:22'),
(28, 1, 12550000, NULL, NULL, NULL, NULL, '2018-08-09 11:38:52', '2018-08-09 11:38:52'),
(29, 1, 12550000, NULL, NULL, NULL, NULL, '2018-08-09 11:39:15', '2018-08-09 11:39:15'),
(30, 1, 15100000, NULL, NULL, NULL, NULL, '2018-08-09 11:48:02', '2018-08-09 11:48:02'),
(31, 1, 20000000, NULL, NULL, NULL, NULL, '2018-08-09 11:49:43', '2018-08-09 11:49:43'),
(32, 1, 10000000, NULL, NULL, NULL, NULL, '2018-08-09 11:51:30', '2018-08-09 11:51:30'),
(33, 1, 4000000, NULL, NULL, NULL, NULL, '2018-08-09 11:52:57', '2018-08-09 11:52:57'),
(34, 1, 5100000, NULL, NULL, NULL, NULL, '2018-08-09 11:53:41', '2018-08-09 11:53:41'),
(35, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-09 11:54:41', '2018-08-09 11:54:41'),
(36, 1, 5100000, NULL, NULL, NULL, NULL, '2018-08-09 11:55:37', '2018-08-09 11:55:37'),
(37, 1, 5100000, NULL, NULL, NULL, NULL, '2018-08-09 11:57:54', '2018-08-09 11:57:54'),
(38, 1, 28650000, NULL, NULL, NULL, 'Ship cho 4-5 ngày', '2018-08-09 12:48:27', '2018-08-09 12:48:27'),
(39, 1, 10350000, NULL, NULL, NULL, NULL, '2018-08-09 13:05:57', '2018-08-09 13:05:57'),
(40, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-09 13:07:04', '2018-08-09 13:07:04'),
(41, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-09 13:11:06', '2018-08-09 13:11:06'),
(42, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-09 13:12:06', '2018-08-09 13:12:06'),
(43, 1, 5100000, NULL, NULL, NULL, NULL, '2018-08-13 09:20:09', '2018-08-13 09:20:09'),
(44, 1, 7650000, NULL, NULL, NULL, NULL, '2018-08-13 09:21:11', '2018-08-13 09:21:11'),
(45, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-13 09:22:18', '2018-08-13 09:22:18'),
(46, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-13 09:24:43', '2018-08-13 09:24:43'),
(47, 1, 5100000, NULL, NULL, NULL, NULL, '2018-08-13 14:56:39', '2018-08-13 14:56:39'),
(48, 1, 8150000, NULL, NULL, NULL, NULL, '2018-08-13 15:03:39', '2018-08-13 15:03:39'),
(49, 1, 5100000, NULL, NULL, NULL, NULL, '2018-08-13 15:09:35', '2018-08-13 15:09:35'),
(50, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-13 15:14:01', '2018-08-13 15:14:01'),
(51, 1, 14900000, NULL, NULL, NULL, NULL, '2018-08-13 15:16:12', '2018-08-13 15:16:12'),
(52, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-13 15:20:11', '2018-08-13 15:20:11'),
(53, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-13 15:22:23', '2018-08-13 15:22:23'),
(54, 1, 4050000, NULL, NULL, NULL, NULL, '2018-08-13 15:23:38', '2018-08-13 15:23:38'),
(55, 1, 2550000, NULL, NULL, NULL, NULL, '2018-08-13 18:58:57', '2018-08-13 18:58:57'),
(56, 1, 5100000, NULL, NULL, NULL, NULL, '2018-08-14 15:30:21', '2018-08-14 15:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` double NOT NULL,
  `image_link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `delete_flag` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `name`, `price`, `quantity`, `discount`, `image_link`, `description`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Chó Husky', 11500000, 2, 99, 'husky.jpg', 'Chó Husky(chó tuyết kéo xe) có xuất xứ từ Siberia – Nga, rất giống cho sói. Được con người lai tạo lần đầu tiên để kéo xe tuyết chở hàng hóa khắp Siberia. Thân hình những chú chó Husky cân đối, dáng vẻ dũng mãnh và đặc biệt cực kỳ dẻo dai. Bộ lông của chúng rất dày có 2 lớp giúp giữ ấm cơ thể rất tốt, nhưng cũng chính lớp lông này khiến chúng khó thích nghi khi được nuôi trong thời tiết nắng nóng.', 0, '2018-07-17 17:11:28', '2018-08-16 16:23:22'),
(2, 1, 1, 'Chó Samoyed – Chó tuyết kéo xe', 8000000, 0, 15, 'Samoyed.jpg', 'Chó Samoyed có xuất xứ từ vùng núi Taiga, Tây Bắc Siberia – Nga. Cũng giống như Husky chúng cũng có cơ thể mạnh mẽ, dẻo dai, lớp lông dày có thể kéo xe tuyết trong thời gian dài. Chó Samoyed có địa vị rất cao trong xã hội người Samoyede giúp họ vận chuyển lương thực, săn bắt thú rừng và bảo vệ khỏi kẻ thù.', 1, '2018-07-17 17:24:52', '2018-08-13 15:59:49'),
(3, 2, 1, 'Chó Alaska (Alaska Malamute)', 10000000, 0, 0, 'Alaska.jpg', 'Chó Alaska cũng là một giống chó xứ lạnh giống Husky và Samoyed được thuần hóa bởi bộ tộc Mahlemute. Khi mới bắt đầu thuần hóa, chó Alaska cũng chỉ có kích thước ngang với Husky nhưng được người Eskimo lai tao để có được những chú chó Alaska to khỏe, dẻo dai và chịu được thời tiết khắc nghiệt hơn.', 0, '2018-07-17 17:24:52', '2018-08-09 11:51:30'),
(4, 1, 1, 'Chó Becgie – Chó chăn cừu', 4000000, 1, 10, 'Becgie.jpg', 'Chó Becgie được người Đức lai tạo lần đầu năm 1899, chủ yếu dùng để chăn cừu. Nhưng với sự thông minh vượt bậc, trung thành, nhanh nhẹn chúng nhanh chóng được huấn luyện để phục vụ trong ngành cảnh sát và quân đội. Theo thống kê, chó Becgie là giống chó phục vụ nhiều nhất trong lực lượng cảnh sát các nước trên thế giới.', 0, '2018-07-17 17:24:52', '2018-08-15 09:24:20'),
(5, 1, 1, 'Chó Golden(Golden Retriever)', 6000000, 0, 0, 'Golden.jpg', 'Đây là giống cho có nguồn gốc từ nước Anh, được lai tạo qua nhiều giống chó khác nhau. Nhưng chúng vẫn có bản năng săn mồi rất mạnh, khả năng đánh hơi tìm dấu vết hoàn hảo nên chúng cũng được cảnh sát các nước huấn luyện để dò tìm ma túy và các chất nổ.', 0, '2018-07-17 17:24:52', '2018-07-17 17:24:52'),
(6, 1, 1, 'Chó săn Poodle', 5450000, 0, 30, 'Poodle.jpg', 'Poodle là giống chó có xuất xứ từ Pháp, có khả năng bơi lội rất giỏi nên từ xưa chúng thường được người dân bản xứ dùng để săn vịt trời. Đặc điểm của chúng là có bộ lông xoăn tít, giữ ấm rất tốt.', 0, '2018-07-17 17:24:52', '2018-07-29 17:44:14'),
(7, 1, 1, 'Chó Labrador', 3000000, 6399949, 15, 'Labrador.jpg', 'Labrador là giống chó được coi là phổ biến nhất tại Mỹ, thường được các dân nuôi chó chuyên nghiệp huấn luyện để tha mồi trong các cuộc đi săn. Chó Labrador rất thông minh, có thể giúp con người làm được rất nhiều việc nên chúng thường được coi là một thành viên trong gia đình. ', 0, '2018-07-17 17:24:52', '2018-08-14 15:30:21'),
(8, 1, 1, 'Chó Dorberman', 13350000, 0, 0, 'Dorberman.jpg', 'Chó Dorberman được nhà lai tạo người Đức Louis Dorberman nhân giống thành công năm 1890 bởi ít nhất 4 giống chó. Tỉ lệ kết hợp giữa 4 giống chó với nhau gần như đã bị thất lạc.\r\nChó Dorberman rất dũng mãnh, cơ bắt, cổ cao, ta dụng chân dài và nhanh nhẹn. Một chú Dorberman trưởng thành nặng từ 30-45kg tùy theo giới tính đực cái, bản tính Dorberman khá hung giữ, rất cảnh giác với người lạ nhưng trung thành với chủ nên thường được các gia đình nuôi làm chó giữ nhà.', 0, '2018-07-17 17:24:52', '2018-08-09 12:48:27'),
(9, 1, 1, 'Chó Pitbull', 15000000, 1, 10, 'Pitbull.jpg', 'Chó Pitbull có nguồn gốc từ Anh, ban đầu có kích thước khá nhỏ bé, nhưng để phục vụ một thể thao “chọi chó” nhiều người tại Mỹ đã lai tạo chúng trở nên to lớn và hung dữ hơn. Và cái tên Pitbull cũng được bắt nguồn từ môn thể thao này. Vào đầu thế kỷ 20 do luật cấm những trò giải trí như “chọi chó” ra đời nên Pitbull được lai tạo cho trở nên hiền lành và dùng để nuôi trong nhà.', 0, '2018-07-17 17:24:52', '2018-07-17 17:24:52'),
(10, 1, 2, 'Mèo A', 13350000, 0, 15, 'husky.jpg', '', 0, '2018-07-19 16:43:29', '2018-08-09 11:28:56'),
(11, 1, 4, 'cám sinh học', 100000, 2, 13, 'husky.jpg', '', 0, '2018-07-19 16:43:29', '2018-08-16 10:23:13'),
(12, 1, 10, 'Bát đôi cấp nước tự động', 30000, 10, 0, 'batdoi.jpg', 'Bát ăn uống nước cấp nước tự động gắn chai nước ngọt (bát không bao gồm chai) \r\n- Sản phẩm được làm từ chất liệu nhựa cao cấp không gây hại, không làm ảnh hưởng đến chất lượng thức ăn, màu sắc bất mắt giúp thú cưng ăn ngon mệng hơn\r\n+ Sản phẩm xứng đáng là sự lựa chọn lý tưởng của bạn dành cho thú cưng.\r\n+ Bề mặt trơn láng, dễ dàng chùi rửa sạch sẽ sau khi sử dụng.\r\n+ Được thiết kế dựa trên tiêu chuẩn chất lượng của Châu Âu.\r\nBát ăn và uống nước cho chó mèo, chất liệu tốt, bền, đẹp, không độc hại, không kích ứng với da\r\n+ Bát sẽ thoải mái khi đi vắng mà không sợ cún bị khát nước.\r\n- Kích thước bát ( Không kèm bình nước) : 27x16x6cm\r\n>>> Bình nước là bình nước khoáng hoặc nước ngọt, bình, chai nào cũng có thể lắp vừa\r\n- Trọng lượng: 100', 0, '2018-07-22 22:48:22', '2018-07-22 22:48:22'),
(13, 1, 10, 'Bát đôi kèm lõi inox ', 99000, 54, 0, 'batan.jpg', 'Bát đôi kèm lõi inox cao cấp dành cho chó mèo - CutePets\r\n\r\n- Chất liệu: Nhựa PP không ôi nhiễm môi trường, lõi inox không gỉ\r\n\r\n- Màu sắc:hồng, xanh da trời, vàng màu xanh lá cây\r\n\r\n- Kích Thước bên ngoài:chiều dài = 32cm, chiều rộng = 16 cm, chiều cao = 6.5 cm;\r\n\r\n- Bát bên trong Đường Kính Miệng:14 cm.\r\n\r\n- Sử dụng:Pet (Chó & Mèo) trong Thực Phẩm & Bát Nước tính năng:\r\n\r\n1. chất liệu Inox chất lượng cao không gỉ làm cho các bát Độ Bền Cao hơn\r\n\r\n2. Vỏ làm từ nhựa PP Nhựa an toàn và không độc hại\r\n\r\n3. Tháo lắp một cách dễ dàng và dễ làm sạch', 0, '2018-07-22 22:48:22', '2018-07-22 22:48:22'),
(14, 5, 1, 'Chó ngu', 1000000, 999, 50, '1533821041.petshop.png', 'không', 0, '2018-08-09 13:24:01', '2018-08-13 15:23:38'),
(15, 5, 2, 'Chó ngu 1', 1000000, 98, 55, '1533833893.banner.png', 'ok', 0, '2018-08-09 16:58:13', '2018-08-13 15:23:38'),
(16, 5, 11, 'Chó ngu 2', 1000000, 998, 50, '1533834135.Screenshot.png', 'ok', 0, '2018-08-09 17:02:15', '2018-08-13 15:23:38'),
(17, 5, 1, 'Chó ngu 1', 50000, 999, 0, '1533834982.banner.png', 'dsds', 0, '2018-08-09 17:16:22', '2018-08-13 15:23:38'),
(18, 7, 8, 'Chó ngu 1', 1000000, 1, 0, '1533915744.batan.jpg', 'dsd', 0, '2018-08-10 15:42:24', '2018-08-10 15:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(4) NOT NULL DEFAULT '1',
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `reportTo_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `status`, `admin_id`, `user_id`, `reportTo_id`, `product_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 3, 5, 5, 5, 16, 'Sản Phẩm này sử dụng hình ảnh không thực tế', '2018-08-14 16:02:54', '2018-08-14 16:04:39'),
(2, 2, 5, 5, 1, NULL, 'Nhà cung câp này mạo danh bạn hoặc một người bạn quen', '2018-08-15 06:15:06', '2018-08-15 06:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `link`, `image`) VALUES
(1, '', 'banner1.jpg'),
(2, '', 'banner2.jpg'),
(3, '', 'banner3.jpg'),
(4, '', 'banner4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `stt`) VALUES
(1, 'Chưa xử lý'),
(2, 'Đang xử lý'),
(3, 'đủ hàng'),
(4, 'đang giao hàng'),
(5, 'hoàn thành');

-- --------------------------------------------------------

--
-- Table structure for table `store_benefits`
--

DROP TABLE IF EXISTS `store_benefits`;
CREATE TABLE IF NOT EXISTS `store_benefits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_comments`
--

DROP TABLE IF EXISTS `sub_comments`;
CREATE TABLE IF NOT EXISTS `sub_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_link` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_comments`
--

INSERT INTO `sub_comments` (`id`, `comment_id`, `user_id`, `media_link`, `description`, `created_at`, `updated_at`) VALUES
(1, 10, 5, NULL, 'alo alo', '2018-08-02 14:46:25', '2018-08-02 14:46:25'),
(2, 10, 5, NULL, 'nice job', '2018-08-02 14:57:01', '2018-08-02 14:57:01'),
(3, 13, 5, NULL, 'dsadsad', '2018-08-05 11:58:21', '2018-08-05 11:58:21'),
(4, 13, 5, NULL, 'dá', '2018-08-05 11:58:33', '2018-08-05 11:58:33'),
(5, 23, 5, NULL, 'dsdas', '2018-08-05 11:59:17', '2018-08-05 11:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_outfits`
--

DROP TABLE IF EXISTS `supplier_outfits`;
CREATE TABLE IF NOT EXISTS `supplier_outfits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(4) NOT NULL DEFAULT '1',
  `payment_id` int(11) NOT NULL,
  `suplier_id` int(11) NOT NULL,
  `amount_for_suplier` int(11) NOT NULL,
  `payment_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_registers`
--

DROP TABLE IF EXISTS `supplier_registers`;
CREATE TABLE IF NOT EXISTS `supplier_registers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` int(2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_code` int(11) NOT NULL DEFAULT '1',
  `card_number` varchar(255) NOT NULL,
  `bank_username` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch` varchar(255) NOT NULL,
  `chandung` varchar(255) NOT NULL,
  `cmnd` varchar(255) NOT NULL,
  `delete_flag` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_registers`
--

INSERT INTO `supplier_registers` (`id`, `user_id`, `name`, `gender`, `email`, `password`, `remember_token`, `phoneNumber`, `address`, `city_code`, `card_number`, `bank_username`, `bank_name`, `bank_branch`, `chandung`, `cmnd`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 10, 'Kazaki Kazua', 1, 'test@gmail.com', '$2y$10$XSQn8R3a7wak3yncO1O93ORAPQ1c.VaJMDCH2ZCoQmIhGQ7ArgfvS', NULL, '01697161671', 'dsadsadsad,Tỉnh Quảng Ninh', 22, '34324324343234', 'hiep@gmai.com', 'aaaaaa', 'aaaaaaaaa', '1534150431.banner.png', '1534150432.petshop.png', 0, '2018-08-13 08:51:59', '2018-08-13 08:53:52'),
(2, 11, 'Nguyễn Hiệp', 1, 'test1@gmail.com', '$2y$10$aboEQIhPw8Ekk3RIE3d7MuGryEoPyYeoXbC9o9Vqdrk7YfgmCE.xu', NULL, '01697161671', 'dsadsadsaddsd,Thành phố Hà Nội', 1, '32432432434234', 'hiep@gmai.com', 'aaaaaa', 'aaaaaaaaa', '1534191580.petshop.png', '1534191580.Login_Register.PNG', 0, '2018-08-13 20:19:40', '2018-08-13 20:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `gender` int(2) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city_code` int(11) NOT NULL DEFAULT '1',
  `card_number` varchar(255) DEFAULT NULL,
  `bank_username` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `roleId` int(4) NOT NULL DEFAULT '3',
  `avatar` varchar(255) NOT NULL,
  `delete_flag` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `password`, `remember_token`, `phoneNumber`, `address`, `city_code`, `card_number`, `bank_username`, `bank_name`, `bank_branch`, `roleId`, `avatar`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'Hyuga_', 1, 'hiepnhse03561@fpt.edu.vn', '$2y$10$GOScVmqbLAei2QnKkH.Ob.3yjO8aIyo9zMC2jlpvVrcZxNt1WCu1K', '49iRFkhXJrBkvXTNLFaDSwRpEECcyVkyeplhvOw9ZHznZExwdcbPD3DvnJdS', '01697161671', 'đình thôn mỹ đình 1 Nam Từ Liêm, Hà Nội', 1, NULL, NULL, NULL, NULL, 2, '1532978090.petshop.png', 0, '2018-07-19 21:26:11', '2018-07-30 19:14:50'),
(2, 'Nguyễn Hiệp', 0, 'hiepnhse03562@fpt.edu.vn', '$2y$10$F7GXS8erW99OtdQR2b0EXON1JI4zShQ1X4Hz0QytIe0tAQeO7XG0m', '53G6dxfoXxYeBJEwAE4nbTKjeKXvqzX6ptRtU2MkvK66htGHFabWgyUoW6nu', '01697161671', 'Hà Nội', 1, NULL, NULL, NULL, NULL, 2, 'user-default.png', 0, '2018-07-19 17:12:00', '2018-07-19 17:12:00'),
(5, 'Nguyễn Hữu Hiệp', 0, 'acquy_tokyo_95@yahoo.com.vn', '$2y$10$r0ld8F2dm3blCo5AMZqjNuGAkyVga2f5WzzMzPZ2gdM6lDfSv.47e', 'QuvGBiMnCFfxEoCfw1ITsy1i3BiNGzB7yRMKgHVmFQN701gLScsl2SlnmVNK', '01697161671', NULL, 1, NULL, NULL, NULL, NULL, 4, '1532627521.petshop.png', 0, '2018-07-24 10:19:05', '2018-08-13 08:21:49'),
(6, 'macro x xx x', 0, 'a.renji95@gmail.com', '$2y$10$pfSJ.rrRGdPNO2vPmGoEQuMdKE73lDQTCjt8C0Kr3C0NcUjuWZyES', 'FRJpgXINCHNNAxxxU7oDFYJyCxdsuKM28OFCWFEIhxehGO06p8XVVMtvI7qT', NULL, 'HASASHA', 1, NULL, NULL, NULL, NULL, 3, 'https://lh6.googleusercontent.com/-DRHnTWdkkCI/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7o--PHL9DAzQiKqagKotFAjEXeDUw/mo/photo.jpg?sz=50', 0, '2018-07-24 10:40:29', '2018-08-05 17:02:56'),
(7, 'Kazaki', 1, 'hie11p@gmai.com', '$2y$10$qexDKUrcOCoOOBLrcDBbHeXn2UpiFM0wAe/9.6gP0mh98jz2OQJru', 'aynRe5yeuXIibfmBOOjlKjzumNkdrxUBAawWrtqrmFCIGmLD97tjrwniYLxN', '01697161671', 'Hà Nội,Tỉnh Hà Giang,Tỉnh Bà Rịa - Vũng Tàu', 2, '4342342344234', 'dsadsada', 'đasd', 'aaaaaaaaa', 2, '1534145265.banner.png', 0, '2018-08-07 15:58:05', '2018-08-13 15:09:35'),
(8, 'Kakalot', 1, 'sfkfjkdsj@gmail.com', '$2y$10$VdcQG06XdIi/jnNiGkmBW.Hm4zHAUTvT9uR165sgBHv87/hQhnlvC', NULL, '01697161671', 'dsadsadsaddsad ,19}', 1, NULL, NULL, NULL, NULL, 3, 'user-default.png', 0, '2018-08-13 06:56:34', '2018-08-13 06:56:34'),
(9, 'Kakalot 12', 1, 'dsadsa@gmail.com', '$2y$10$2nev7GkVlilp/tQZbwkyouzLzaSjts3CaS.6fkkbjaCzVKIXpSuCG', NULL, '01697161671', 'dsadsadsadadsdsaad ,Tỉnh Lạng Sơn', 20, NULL, NULL, NULL, NULL, 3, 'user-default.png', 0, '2018-08-13 07:07:00', '2018-08-13 07:07:00'),
(10, 'Kazaki Kazua', 1, 'test@gmail.com', '$2y$10$UfSYM85mVUutCcAvckhNreEIjlLjzya55ewEzILcoIL3DeppPuZpy', NULL, '01697161671', 'dsadsadsad ,Tỉnh Vĩnh Phúc,Tỉnh Thái Nguyên,Tỉnh Quảng Ninh', 26, NULL, NULL, NULL, NULL, 3, 'user-default.png', 0, '2018-08-13 08:18:03', '2018-08-13 09:24:43'),
(11, 'Nguyễn Hiệp', 1, 'test1@gmail.com', '$2y$10$a583RvxOf765uPlVTlYyr.mTHCB2L/5al2SfHmp1SNBD2bFkHF5PC', NULL, '01697161671', 'dsadsadsaddsd ,Thành phố Hà Nội', 1, NULL, NULL, NULL, NULL, 3, 'user-default.png', 0, '2018-08-13 20:16:15', '2018-08-13 20:16:15'),
(12, 'Kazakidsad', 1, 'hiepnh.game@gmail.com', '$2y$10$sE702gop0tfjMGq6Ku5T/.e/42DOjqyLTZVXU9U6IcOmoDLFNBl6.', NULL, '01697161671', 'dsadsadsad ,Thành phố Hà Nội', 1, NULL, NULL, NULL, NULL, 3, 'user-default.png', 0, '2018-08-14 07:57:16', '2018-08-14 07:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'supplier'),
(3, 'customer'),
(4, 'moderator');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `address`) VALUES
(1, 'Kho HN', 'Hà Nội'),
(2, 'Kho Đà Nẵng', 'Đà Nẵng'),
(3, 'Kho HCM', 'Tp Hồ Chí Minh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
