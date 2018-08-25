-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2018 at 04:34 PM
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
(1, 'Chó', 1, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(2, 'Mèo', 1, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(3, 'Chim', 1, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(4, 'Thức ăn', 2, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(5, 'Đồ chơi', 2, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(6, 'Quần áo', 2, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(7, 'Làm đẹp', 3, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(8, 'Trông giữ', 3, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(9, 'Chữa trị', 3, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(10, 'Đồ dùng', 2, '2018-08-10 00:00:45', '2018-08-10 00:00:45'),
(11, 'Bò sát', 1, '2018-08-09 17:02:15', '2018-08-09 17:02:15');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orderlinepayment_statuses`
--

DROP TABLE IF EXISTS `orderlinepayment_statuses`;
CREATE TABLE IF NOT EXISTS `orderlinepayment_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderlinepayment_statuses`
--

INSERT INTO `orderlinepayment_statuses` (`id`, `name`) VALUES
(1, 'Chưa thanh toán'),
(2, 'Đã thanh toán');

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
(1, 'Đang xử lý'),
(2, 'Đang vận chuyển'),
(3, 'Đã vào kho'),
(4, 'Đang giao hàng'),
(5, 'Đã hoàn thành');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(4) NOT NULL DEFAULT '1',
  `finance_status` int(2) NOT NULL DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status_id`, `finance_status`, `address`, `city_code`, `warehouse_id`, `moderator_id`, `user_id`, `payment_id`, `delete_flag`, `created_at`, `updated_at`, `completed_at`) VALUES
(1, 5, 2, 'đường đình thôn mỹ đình 1', 1, 1, 5, 5, 1, 0, '2018-08-23 13:28:27', '2018-08-22 13:37:34', '2018-08-29 20:34:15'),
(2, 5, 2, 'đường đình thôn mỹ đình 1', 1, 1, 5, 5, 2, 0, '2018-08-22 13:29:49', '2018-08-22 13:34:38', '2018-08-29 20:34:00'),
(3, 4, 1, 'Mỹ Đình 4 ,Thành phố Hà Nội', 1, 1, 5, 12, 3, 0, '2017-07-22 17:13:24', '2018-08-22 17:15:26', NULL),
(4, 1, 1, 'Mỹ Đình 4 ,Thành phố Hà Nội', 1, 1, NULL, 12, 4, 0, '2016-08-23 13:53:58', '2018-08-23 13:53:58', NULL),
(5, 1, 1, 'Mỹ Đình 4 ,Thành phố Hà Nội', 1, 1, NULL, 12, 5, 0, '2015-08-23 13:54:18', '2018-08-23 13:54:18', NULL),
(6, 1, 1, 'Mỹ Đình 4 ,Thành phố Hà Nội', 1, 1, NULL, 12, 6, 0, '2015-08-23 13:54:35', '2018-08-23 13:54:35', NULL);

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
  `finance_status` int(2) NOT NULL DEFAULT '1',
  `sent_at` datetime DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_lines`
--

INSERT INTO `order_lines` (`id`, `order_id`, `city_code`, `warehouse_id`, `product_id`, `quantity`, `amount`, `orderline_status_id`, `finance_status`, `sent_at`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 77, 1, 3500000, 5, 2, '2018-08-22 13:32:47', '2018-08-29', '2018-08-22 13:28:27', '2018-08-22 13:37:34'),
(2, 2, 1, 1, 74, 2, 570000, 5, 2, '2018-08-22 13:32:53', '2018-08-29', '2018-08-22 13:29:49', '2018-08-22 13:34:38'),
(3, 3, 1, 1, 78, 2, 700000, 5, 1, '2018-08-22 17:14:33', '2018-08-30', '2018-08-22 17:13:24', '2018-08-22 17:15:26'),
(4, 4, 1, 1, 76, 1, 720000, 1, 1, NULL, NULL, '2018-08-23 13:53:58', '2018-08-23 13:53:58'),
(5, 5, 1, 1, 77, 1, 3500000, 1, 1, NULL, NULL, '2018-08-23 13:54:18', '2018-08-23 13:54:18'),
(6, 6, 1, 1, 70, 1, 2500000, 1, 1, NULL, NULL, '2018-08-23 13:54:35', '2018-08-23 13:54:35');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `status`, `amount`, `payment`, `payment_info`, `security`, `user_message`, `created_at`, `updated_at`) VALUES
(1, 1, 3500000, NULL, NULL, NULL, NULL, '2018-08-22 13:28:27', '2018-08-22 13:28:27'),
(2, 1, 570000, NULL, NULL, NULL, NULL, '2018-08-22 13:29:49', '2018-08-22 13:29:49'),
(3, 1, 700000, NULL, NULL, NULL, NULL, '2017-07-22 17:13:24', '2018-08-22 17:13:24'),
(4, 1, 720000, NULL, NULL, NULL, NULL, '2016-08-23 13:53:58', '2018-08-23 13:53:58'),
(5, 1, 3500000, NULL, NULL, NULL, NULL, '2015-08-23 13:54:18', '2018-08-23 13:54:18'),
(6, 1, 2500000, NULL, NULL, NULL, NULL, '2015-08-23 13:54:35', '2018-08-23 13:54:35');

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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `name`, `price`, `quantity`, `discount`, `image_link`, `description`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Chó Husky', 11500000, 2, 99, 'husky.jpg', 'Chó Husky(chó tuyết kéo xe) có xuất xứ từ Siberia – Nga, rất giống cho sói. Được con người lai tạo lần đầu tiên để kéo xe tuyết chở hàng hóa khắp Siberia. Thân hình những chú chó Husky cân đối, dáng vẻ dũng mãnh và đặc biệt cực kỳ dẻo dai. Bộ lông của chúng rất dày có 2 lớp giúp giữ ấm cơ thể rất tốt, nhưng cũng chính lớp lông này khiến chúng khó thích nghi khi được nuôi trong thời tiết nắng nóng.', 1, '2018-07-17 17:11:28', '2018-08-18 15:51:39'),
(2, 1, 1, 'Chó Samoyed – Chó tuyết kéo xe', 8000000, 0, 15, 'Samoyed.jpg', 'Chó Samoyed có xuất xứ từ vùng núi Taiga, Tây Bắc Siberia – Nga. Cũng giống như Husky chúng cũng có cơ thể mạnh mẽ, dẻo dai, lớp lông dày có thể kéo xe tuyết trong thời gian dài. Chó Samoyed có địa vị rất cao trong xã hội người Samoyede giúp họ vận chuyển lương thực, săn bắt thú rừng và bảo vệ khỏi kẻ thù.', 1, '2018-07-17 17:24:52', '2018-08-13 15:59:49'),
(3, 2, 1, 'Chó Alaska (Alaska Malamute)', 10000000, 0, 0, 'Alaska.jpg', 'Chó Alaska cũng là một giống chó xứ lạnh giống Husky và Samoyed được thuần hóa bởi bộ tộc Mahlemute. Khi mới bắt đầu thuần hóa, chó Alaska cũng chỉ có kích thước ngang với Husky nhưng được người Eskimo lai tao để có được những chú chó Alaska to khỏe, dẻo dai và chịu được thời tiết khắc nghiệt hơn.', 0, '2018-07-17 17:24:52', '2018-08-09 11:51:30'),
(4, 1, 1, 'Chó Becgie – Chó chăn cừu', 4000000, 1, 10, 'Becgie.jpg', 'Chó Becgie được người Đức lai tạo lần đầu năm 1899, chủ yếu dùng để chăn cừu. Nhưng với sự thông minh vượt bậc, trung thành, nhanh nhẹn chúng nhanh chóng được huấn luyện để phục vụ trong ngành cảnh sát và quân đội. Theo thống kê, chó Becgie là giống chó phục vụ nhiều nhất trong lực lượng cảnh sát các nước trên thế giới.', 0, '2018-07-17 17:24:52', '2018-08-15 09:24:20'),
(5, 1, 1, 'Chó Golden(Golden Retriever)', 6000000, 0, 0, 'Golden.jpg', 'Đây là giống cho có nguồn gốc từ nước Anh, được lai tạo qua nhiều giống chó khác nhau. Nhưng chúng vẫn có bản năng săn mồi rất mạnh, khả năng đánh hơi tìm dấu vết hoàn hảo nên chúng cũng được cảnh sát các nước huấn luyện để dò tìm ma túy và các chất nổ.', 1, '2018-07-17 17:24:52', '2018-08-18 16:02:58'),
(6, 1, 1, 'Chó săn Poodle', 5450000, 0, 30, 'Poodle.jpg', 'Poodle là giống chó có xuất xứ từ Pháp, có khả năng bơi lội rất giỏi nên từ xưa chúng thường được người dân bản xứ dùng để săn vịt trời. Đặc điểm của chúng là có bộ lông xoăn tít, giữ ấm rất tốt.', 1, '2018-07-17 17:24:52', '2018-08-18 16:02:53'),
(7, 1, 1, 'Chó Labrador', 10000000, 6, 15, 'Labrador.jpg', 'Labrador là giống chó được coi là phổ biến nhất tại Mỹ, thường được các dân nuôi chó chuyên nghiệp huấn luyện để tha mồi trong các cuộc đi săn. Chó Labrador rất thông minh, có thể giúp con người làm được rất nhiều việc nên chúng thường được coi là một thành viên trong gia đình. ', 0, '2018-07-17 17:24:52', '2018-08-18 16:04:42'),
(8, 1, 1, 'Chó Dorberman', 13350000, 0, 0, 'Dorberman.jpg', 'Chó Dorberman được nhà lai tạo người Đức Louis Dorberman nhân giống thành công năm 1890 bởi ít nhất 4 giống chó. Tỉ lệ kết hợp giữa 4 giống chó với nhau gần như đã bị thất lạc.\r\nChó Dorberman rất dũng mãnh, cơ bắt, cổ cao, ta dụng chân dài và nhanh nhẹn. Một chú Dorberman trưởng thành nặng từ 30-45kg tùy theo giới tính đực cái, bản tính Dorberman khá hung giữ, rất cảnh giác với người lạ nhưng trung thành với chủ nên thường được các gia đình nuôi làm chó giữ nhà.', 1, '2018-07-17 17:24:52', '2018-08-18 16:02:48'),
(9, 1, 1, 'Chó Pitbull', 15000000, 1, 10, 'Pitbull.jpg', 'Chó Pitbull có nguồn gốc từ Anh, ban đầu có kích thước khá nhỏ bé, nhưng để phục vụ một thể thao “chọi chó” nhiều người tại Mỹ đã lai tạo chúng trở nên to lớn và hung dữ hơn. Và cái tên Pitbull cũng được bắt nguồn từ môn thể thao này. Vào đầu thế kỷ 20 do luật cấm những trò giải trí như “chọi chó” ra đời nên Pitbull được lai tạo cho trở nên hiền lành và dùng để nuôi trong nhà.', 0, '2018-07-17 17:24:52', '2018-07-17 17:24:52'),
(10, 1, 2, 'Mèo giống chó', 13350000, 0, 15, 'husky.jpg', '', 1, '2018-07-19 16:43:29', '2018-08-18 15:59:06'),
(11, 1, 4, 'Cám sinh học', 100000, 2, 13, 'husky.jpg', '', 1, '2018-07-19 16:43:29', '2018-08-18 15:58:52'),
(12, 1, 10, 'Bát đôi cấp nước tự động', 50000, 10, 10, 'batdoi.jpg', 'Bát ăn uống nước cấp nước tự động gắn chai nước ngọt (bát không bao gồm chai) \r\n- Sản phẩm được làm từ chất liệu nhựa cao cấp không gây hại, không làm ảnh hưởng đến chất lượng thức ăn, màu sắc bất mắt giúp thú cưng ăn ngon mệng hơn\r\n+ Sản phẩm xứng đáng là sự lựa chọn lý tưởng của bạn dành cho thú cưng.\r\n+ Bề mặt trơn láng, dễ dàng chùi rửa sạch sẽ sau khi sử dụng.\r\n+ Được thiết kế dựa trên tiêu chuẩn chất lượng của Châu Âu.\r\nBát ăn và uống nước cho chó mèo, chất liệu tốt, bền, đẹp, không độc hại, không kích ứng với da\r\n+ Bát sẽ thoải mái khi đi vắng mà không sợ cún bị khát nước.\r\n- Kích thước bát ( Không kèm bình nước) : 27x16x6cm\r\n>>> Bình nước là bình nước khoáng hoặc nước ngọt, bình, chai nào cũng có thể lắp vừa\r\n- Trọng lượng: 100', 0, '2018-07-22 22:48:22', '2018-08-18 15:58:39'),
(13, 1, 10, 'Bát đôi kèm lõi inox', 150000, 54, 10, 'batan.jpg', 'Bát đôi kèm lõi inox cao cấp dành cho chó mèo - CutePets\r\n\r\n- Chất liệu: Nhựa PP không ôi nhiễm môi trường, lõi inox không gỉ\r\n\r\n- Màu sắc:hồng, xanh da trời, vàng màu xanh lá cây\r\n\r\n- Kích Thước bên ngoài:chiều dài = 32cm, chiều rộng = 16 cm, chiều cao = 6.5 cm;\r\n\r\n- Bát bên trong Đường Kính Miệng:14 cm.\r\n\r\n- Sử dụng:Pet (Chó & Mèo) trong Thực Phẩm & Bát Nước tính năng:\r\n\r\n1. chất liệu Inox chất lượng cao không gỉ làm cho các bát Độ Bền Cao hơn\r\n\r\n2. Vỏ làm từ nhựa PP Nhựa an toàn và không độc hại\r\n\r\n3. Tháo lắp một cách dễ dàng và dễ làm sạch', 0, '2018-07-22 22:48:22', '2018-08-18 15:58:02'),
(20, 1, 1, 'Chó Husky Baby', 6000000, 3, 0, '1534607774.20476389_1203977863081143_1925437180399203974_n.jpg', 'Chó husky baby  nâu đỏ 2 tháng tuổi,bố mẹ thuần chủng,mắt 2 màu cực hiếm,đã tiêm phòng và tẩy giun đầy đủ.Sức khỏe tốt,ăn tốt và rất nghịch ngợm', 0, '2018-08-18 15:56:15', '2018-08-18 15:56:15'),
(21, 1, 1, 'Chó Bull Pháp (Bò Sữa)', 18000000, 2, 0, '1534608529.ban-cho-bull-phap-moon-dog-shop.png', 'Các bé Bull Pháp “mặt xệ và bụng phệ” của The Pet Family sẵn sàng về nhà mới ngay trong tháng này. Tất cả các bé đều được sinh tại các trại thành viên của Thú Kiểng, có xác nhận nguồn gốc, chủ sở hữu và microchip. Tất cả các bé đều được tiêm vaccine đầy đủ, bảo hành 15 ngày với mọi loại bệnh tật sau khi về nhà mới', 1, '2018-08-18 16:08:49', '2018-08-18 16:19:25'),
(22, 1, 1, 'Chó Bull Pháp(Trắng)', 16000000, 1, 5, '1534608622.1.jpg', 'Giống chó Bull Pháp (chó Bulldog Pháp hay French Bulldog) là một giống chó nhỏ, thông minh, nhanh nhẹn và được coi là quý hiếm. Chúng bắt nguồn từ giống Bulldog Anh nổi tiếng. Bull Pháp là một giống chó còn khá mới, lịch sử của chúng chỉ mới bắt đầu từ nửa cuối thế kỉ 19, khi những người Anh di cư sang pháp để tìm kiếm một cuộc sống tốt hơn. Họ đã mang theo Bulldog Anh và lai tạo với giống chó Terrier Pháp (chó sục Pháp) để cho ra đời chú chó Bull Pháp đầu tiên vào năm 1860.', 1, '2018-08-18 16:10:22', '2018-08-18 16:11:02'),
(23, 1, 1, 'Chó Bull Pháp Baby', 17500000, 1, 5, '1534608733.cach-nuoi-cho-bull-1.jpg', 'Giống chó Bull Pháp (chó Bulldog Pháp hay French Bulldog) là một giống chó nhỏ, thông minh, nhanh nhẹn và được coi là quý hiếm. Chúng bắt nguồn từ giống Bulldog Anh nổi tiếng. Bull Pháp là một giống chó còn khá mới, lịch sử của chúng chỉ mới bắt đầu từ nửa cuối thế kỉ 19, khi những người Anh di cư sang pháp để tìm kiếm một cuộc sống tốt hơn. Họ đã mang theo Bulldog Anh và lai tạo với giống chó Terrier Pháp (chó sục Pháp) để cho ra đời chú chó Bull Pháp đầu tiên vào năm 1860.', 0, '2018-08-18 16:12:13', '2018-08-18 16:12:13'),
(24, 1, 1, 'Chó Tiny Poodle', 8500000, 2, 0, '1534608906.Nguon-goc-Tiny-Poodle.jpg', 'Tiny Poodle là chú chó nhỏ xíu dễ thương, và cũng đang trở thành trào lưu thú cưng của nhiều người đam mê chó cảnh. Cùng với thân hinh nhỏ nhắn, và sự thông minh của mình, Tiny Poodle đã khiến không ít người phải thổn thức.', 0, '2018-08-18 16:15:06', '2018-08-18 16:18:44'),
(25, 1, 1, 'Chó Toy Poodle', 7000000, 3, 0, '1534609112.hinh-anh-cho-toy-poodle-07.jpg', 'Các bé Poodle trắng tuyết, nâu đỏ và socola rất ngoan ngoãn đáng yêu sinh tại The Pet Family cần tìm chủ yêu thương. Các bé đã được tiêm phòng + tẩy đầy đủ, sức khỏe rất tốt, ăn uống khỏe, sẵn sàng về nhà mới trong tháng này. The Pet Family bảo hành sức khỏe toàn diện với tất cả các bệnh 15 ngày (có hỗ trợ chi phí khám chữa bệnh sau bảo hành). Tất cả các bé Poodle cũng có đầy đủ giấy chứng nhận nguồn gốc, chủ sở hữu và microchip.', 0, '2018-08-18 16:18:32', '2018-08-18 16:18:32'),
(26, 1, 1, 'Chó Bull Pháp (Bò Sữa)', 18000000, 2, 10, '1534609217.ban-cho-bull-phap-moon-dog-shop.png', 'Các bé Bull Pháp “mặt xệ và bụng phệ” của The Pet Family sẵn sàng về nhà mới ngay trong tháng này. Tất cả các bé đều được sinh tại các trại thành viên của The Pet Family, có xác nhận nguồn gốc, chủ sở hữu và microchip. Tất cả các bé đều được tiêm vaccine đầy đủ, bảo hành 15 ngày với mọi loại bệnh tật sau khi về nhà mới', 0, '2018-08-18 16:20:17', '2018-08-18 16:20:17'),
(27, 1, 1, 'Chó Phốc Sóc(Trắng)', 12000000, 1, 0, '1534609392.cho-phoc-soc-bao-nhieu-tien.jpg', 'Chó phốc sóc, hay còn được gọi là Pomeranian (Pom) là giống chó rất nổi tiếng trên thế giới. Kể từ khi xuất hiện, đầu thế kỷ 15, giống chó này đã làm điên đảo giới quý tộc châu Âu.', 0, '2018-08-18 16:23:12', '2018-08-18 16:23:12'),
(28, 1, 1, 'Chó Alaska(Xám Trắng)', 11500000, 2, 5, '1534609508.16999146_231433697322089_481855061068265220_n.jpg', 'Alaska là một trong những giống chó có hình dáng to lớn nhưng tính tình lại hiền lành, thân thiện nên được người nuôi cũng như cộng đồng những người yêu thú cưng cực ưa chuộng.', 0, '2018-08-18 16:25:08', '2018-08-18 16:25:08'),
(29, 1, 1, 'Chó Pug Baby', 9000000, 4, 10, '1534609641.images.jpg', 'Chó Pug, hay còn có tên gọi thân thiện khác được nhiều người đặt cho chúng đó là chó mặt xệ. Với khuôn mặt ngộ nghĩnh và dâm đãng, những chú chó Pug đã lấy được tình yêu của rất nhiều gia đình.', 1, '2018-08-18 16:27:21', '2018-08-18 16:42:26'),
(30, 1, 1, 'Chó Corgi', 25000000, 2, 5, '1534609786.Dac-diem-cho-corgi.jpg', 'Chó Corgi có ngoại hình nhỏ bé và rất ngộ nghĩnh, đáng yêu. Chúng cũng rất năng động và thông minh nên được rất nhiều người ưa thích và mong muốn sở hữu một bé.', 0, '2018-08-18 16:29:46', '2018-08-18 16:29:46'),
(31, 1, 2, 'Mèo Ba Tư Lông Dài', 5000000, 1, 0, '1534609962.tải xuống.jpg', 'Mèo Ba Tư hay còn gọi là mèo Ba Tư mặt tịt là một giống mèo có nguồn gốc từ Ba Tư.Giống mèo này có vẻ như không thích hợp lắm với những người chủ nhân ưa sạch sẽ vì chúng rụng lông rất nhiều. Tuy nhiên, nhờ có bản tính mềm mại, dễ chịu và ôn hòa, giống mèo Ba Tư vẫn tiếp tục được xếp vào những con vật được yêu thích nhất trong gia đình. Chúng rất thông minh, thân thiện và quyến luyến với chủ.', 0, '2018-08-18 16:32:42', '2018-08-18 16:44:31'),
(32, 1, 2, 'Mèo Anh Lông Ngắn', 5000000, 2, 10, '1534610122.tải xuống (1).jpg', 'Giống mèo Anh lông ngắn (hay còn gọi là mèo Aln) đang rất được ưa chuộng ở Việt Nam trong vài năm trở lại đây, vì thân hình mập mạp đáng yêu, tính lười và không kén ăn, lại không tốn nhiều công chăm sóc nên rất dễ nuôi, thích hợp cả với những người bận rộn.', 1, '2018-08-18 16:35:22', '2018-08-18 16:40:51'),
(33, 1, 2, 'Mèo Anh Lông Dài', 4000000, 1, 5, '1534610252.tải xuống.jpg', 'Mèo Anh lông dài, hay còn được gọi là Mèo Ald, là giống mèo có nguồn gốc từ Anh Quốc, hậu duệ của mèo Anh lông ngắn và mèo Ba Tư truyền thống. Mặc dù xuất xứ từ Anh nhưng nó lại không phổ biến tại Anh và cũng không được Hiệp hội mèo Anh (GCCF – Governing Council of the Cat Fancy) công nhận là một giống mèo độc lập, mà chỉ là một nhánh của mèo Anh lông ngắn. Tuy nhiên, giống mèo này lại được nhiều tổ chức lớn khác công nhận, trong đó có cả TICA (Hiệp hội mèo Quốc tế). Tuy không phổ biến tại Anh nhưng giống mèo Anh lông dài hiện đang rất yêu thích tại Mỹ và phần lớn châu Âu.', 1, '2018-08-18 16:37:32', '2018-08-18 16:38:23'),
(34, 1, 2, 'Mèo Anh Lông Dài', 4000000, 1, 5, '1534610293.huong-dan-cham-soc-meo-Anh-long-dai-2.jpg', 'Mèo Anh lông dài, hay còn được gọi là Mèo Ald, là giống mèo có nguồn gốc từ Anh Quốc, hậu duệ của mèo Anh lông ngắn và mèo Ba Tư truyền thống. Mặc dù xuất xứ từ Anh nhưng nó lại không phổ biến tại Anh và cũng không được Hiệp hội mèo Anh (GCCF – Governing Council of the Cat Fancy) công nhận là một giống mèo độc lập, mà chỉ là một nhánh của mèo Anh lông ngắn. Tuy nhiên, giống mèo này lại được nhiều tổ chức lớn khác công nhận, trong đó có cả TICA (Hiệp hội mèo Quốc tế). Tuy không phổ biến tại Anh nhưng giống mèo Anh lông dài hiện đang rất yêu thích tại Mỹ và phần lớn châu Âu.', 0, '2018-08-18 16:38:13', '2018-08-18 16:38:13'),
(35, 1, 2, 'Mèo Anh Lông Ngắn', 5000000, 1, 10, '1534610473.images (1).jpg', 'Giống mèo Anh lông ngắn (hay còn gọi là mèo Aln) đang rất được ưa chuộng ở Việt Nam trong vài năm trở lại đây, vì thân hình mập mạp đáng yêu, tính lười và không kén ăn, lại không tốn nhiều công chăm sóc nên rất dễ nuôi, thích hợp cả với những người bận rộn.', 0, '2018-08-18 16:41:13', '2018-08-18 16:41:13'),
(36, 1, 1, 'Chó Pug Baby', 9000000, 2, 5, '1534610574.pug_puppy.jpg', 'Chó Pug, hay còn có tên gọi thân thiện khác được nhiều người đặt cho chúng đó là chó mặt xệ. Với khuôn mặt ngộ nghĩnh và dâm đãng, những chú chó Pug đã lấy được tình yêu của rất nhiều gia đình.', 0, '2018-08-18 16:42:54', '2018-08-18 16:42:54'),
(37, 1, 2, 'Mèo tai cụp Scotland', 8000000, 1, 15, '1534610844.tải xuống (1).jpg', 'Tiếp tục là một giống mèo nữa đặc biệt nhờ đôi tai. Scottish Folds có đôi tai cụp về phía trước cùng khuôn mặt tròn, chiếc mũi khá ngắn và đôi mắt to ngây thơ khiến cho tổng thể khuôn mặt của mèo tai cụp thật là tròn trịa như một trái bóng rất ngộ nghĩnh đáng yêu.', 0, '2018-08-18 16:47:24', '2018-08-18 16:47:24'),
(38, 1, 2, 'Mèo nhân sư không lông - Sphy', 20000000, 2, 0, '1534610970.meo-khong-long-sphynx-cpq.vn-1492763816944.jpg', 'Mèo Sphynx là một giống mèo đột biến tự nhiên, không qua cấy ghép. Nguồn gốc của chúng từ một chú mèo sinh ra bị đột biến xấu xí, không lông, da trắng bệch vào năm 1966. Sau đó nó được nhân giống với mèo mẹ và sinh ra thêm nhiều chú mèo không lông khác. Từ khi được công nhận là một giống mèo chính thức vào năm 2005, Sphynx đã đoạt danh hiệu giống mèo \"Kinh dị nhất thế giới\".\r\n\r\nĐiều đặc biệt là những chú Sphynx có khuôn mặt rất giống những bức tượng nhân sư trong các lăng mộ cổ ở Ai Cập nên được đặt tên là Sphynx - tên tượng nhân sư Ai Cập. Ngoài ra, chúng còn được mệnh danh là mèo xấu nhất thế giới bởi khuôn mặt nhăn nheo xấu xí có vẻ già nua, cau có và cơ thể \"chảy xệ\", không lông.', 0, '2018-08-18 16:49:30', '2018-08-18 16:49:30'),
(39, 1, 2, 'Mèo Xiêm - Siamese', 2000000, 3, 0, '1534611060.giá-mua-bán-mèo-xiêm-2.jpg', 'Là một trong những nòi mèo đầu tiên của mèo lông ngắn phương Đông được công nhận. Nguồn gốc của mèo Xiêm cho đến nay vẫn chưa được rõ ràng, nhưng Thái Lan được tin rằng là nơi xuất xứ của giống mèo độc đáo này.Mèo Xiêm có đặc điểm là mắt xanh dương, với khuôn mặt đen và màu lông tro phổ biến. Mèo Xiêm hiện đại thân dài và gầy hơn so với giống mèo Xiêm truyền thống - khá mũm mĩm và béo tròn.', 0, '2018-08-18 16:51:00', '2018-08-18 16:51:00'),
(40, 1, 2, 'Mèo Munchkin', 10000000, 1, 5, '1534611180.munchkin-cat-8.jpg', 'èo Munchkin (hay còn được gọi là Mèo Weirner, Mèo Corgi) là một trong những giống mèo dễ thương nhất có nguồn gốc từ Hoa Kỳ. Cái tên Munchkin ngày nay rất nổi tiếng với nhiều người yêu mèo trên toàn Thế giới bởi chúng rất đáng yêu, ngộ nghĩnh, dễ tính và quấn quýt với chủ. Với chân ngắn, mình dài, thân hình mũm mĩm đáng yêu, mèo Munchkin còn được gọi là Corgi trong thế giới mèo.', 0, '2018-08-18 16:53:00', '2018-08-18 16:53:00'),
(41, 2, 4, 'Thức ăn chó trưởng thành', 200000, 30, 10, '1534611422.1852_8801007285719-280x315.jpg', 'O’Fresh – O’Nature là thương hiệu thức ăn cao cấp siêu sạch cho chó mèo của tập đoàn CJ (Hàn Quốc) danh tiếng. Các sản phẩm O’fresh- O’Nature đều đáp ứng các tiêu chuẩn quốc tế cao nhất về thức ăn, thực phẩm cho chó mèo.\r\n\r\nNguyên liệu chính: Gạo bột gia cầm bột thịt mỡ gà hạt lanh bột nguyên trứng beet pulp các loại vitamin (A B1 B2 B12 Niacin D3 E K Biotin Folic acid) các loại khoáng chất ( Fe Zn Mn Se I Cu) cây hương thảo chất chống oxy hóa choline muối posstasium Chloride.\r\n\r\nTrong trường hợp mèo thừa cân hãy tham khảo tư vấn của bác sỹ thú y và cho ăn lượng thức ăn phù hợp. Luôn chú ý để chó lúc nào cũng được uống nước sạch.', 0, '2018-08-18 16:57:02', '2018-08-18 17:00:43'),
(42, 2, 4, 'Hộp thức ăn cao cấp 900g', 210000, 25, 0, '1534611484.1811096_L-280x315.jpg', 'O’Fresh – O’Nature là thương hiệu thức ăn cao cấp siêu sạch cho chó mèo của tập đoàn CJ (Hàn Quốc) danh tiếng. Các sản phẩm O’fresh- O’Nature đều đáp ứng các tiêu chuẩn quốc tế cao nhất về thức ăn, thực phẩm cho chó mèo.\r\n\r\nNguyên liệu chính: Bột cá hồi thủy phân, bột thịt gà thủy phân, bột thịt gà, bột khoai lang, mỡ gà, bột trứng, hạt lanh, dầu cá,  Beet pulp, Inulin, Vitamin( A, B1, B2, Pyridoxine, B12, Folic acid, Niacin, Pantothenic acid, Biotin, D3), khoáng chất( Organic Cu, Organic Zn, Fe, Mn, Se, Calcium idoate), chiết xuất cây Yucca, hương liệu tự nhiên, muối tinh, Choline chloride, Taurine, Potassium chloride, chất chống oxy hóa.\r\n*Nguyên liệu sử dụng trên đây tỉ lệ pha trộn có thể thay đổi tùy thuộc vào tình hình sản xuất.', 0, '2018-08-18 16:58:04', '2018-08-18 17:00:55'),
(43, 2, 4, 'Pate Cho Mèo Các Vị Cá Biển 85', 20000, 10, 0, '1534611545.20140923063919-280x315.jpg', 'WHISKAS gói làm từ cá thực sự. Nhẹ nhàng nấu chín để hoàn thiện và cung cấp sự thoải mái trong một bữa ăn. Nấu chín bằng hơi nước và được bao bọc trong giấy nhôm để bảo quản độ tươi, hương vị và hương vị phong phú trong mỗi bữa ăn con mèo của bạn. Gói WHISKAS cũng cung cấp đầy đủ dinh dưỡng Thành phần: cá biển, gel ejen, dầu đậu nành, các loại vitamin và khoáng chất', 0, '2018-08-18 16:59:05', '2018-08-18 16:59:05'),
(44, 2, 4, 'Thức ăn chó O’fresh vị gà 1.3k', 200000, 5, 5, '1534611594.1849_8801007272016-280x315.jpg', 'O’Fresh – O’Nature là thương hiệu thức ăn cao cấp siêu sạch cho chó mèo của tập đoàn CJ (Hàn Quốc) danh tiếng. Các sản phẩm O’fresh- O’Nature đều đáp ứng các tiêu chuẩn quốc tế cao nhất về thức ăn, thực phẩm cho chó mèo.\r\n\r\nNguyên liệu chính: Gạo bột gia cầm bột thịt mỡ gà hạt lanh bột nguyên trứng beet pulp các loại vitamin (A B1 B2 B12 Niacin D3 E K Biotin Folic acid) các loại khoáng chất ( Fe Zn Mn Se I Cu) cây hương thảo chất chống oxy hóa choline muối posstasium Chloride.\r\n\r\nTrong trường hợp mèo thừa cân hãy tham khảo tư vấn của bác sỹ thú y và cho ăn lượng thức ăn phù hợp. Luôn chú ý để chó lúc nào cũng được uống nước sạch.', 0, '2018-08-18 16:59:54', '2018-08-18 16:59:54'),
(45, 2, 4, 'Thức ăn chó con', 180000, 21, 0, '1534611797.2371_home-dog-junior-1-5kg-petcity-280x315.jpg', 'Thức ăn cho chó Home Dog Junior túi 1.5kg\r\n\r\nĐối tượng sử dụng: (Thức ăn dành cho chó đến 12 tháng tuổi)\r\n\r\nThức ăn cho chó Home Dog Junior giúp tăng cường hệ miễn dịch, sử dụng gạo không có chất phụ gia có khả năng tiêu hóa giúp làm giảm dị ứng, giảm mùi hôi của phân.', 0, '2018-08-18 17:03:17', '2018-08-18 17:03:17'),
(46, 2, 4, 'Bate Monge Pork 100gr', 40000, 13, 0, '1534611932.1841950_L-480x540.png', 'Pate Monge cho chó là sản phẩm của Monge, Ý. Đây là dòng pate rất được ưa chuộng tại các nước Châu Âu với hương vị thơm ngon từ những loại thịt đặc trưng như thịt gà, thịt gà tây, cá ngừ… Pate Monge Cho Chó còn là sản phẩm an toàn đạt chất lượng vì không có chứa gluten, chất gây dị ứng ở cả động vật và người.\r\nPate Monge Fresh kích thích khả năng ăn uống của chó, giúp chó bạn tăng cân, nuôi dưỡng bộ lông và da dẻ hồng hào. Ngoài ra, Monge tập trung đưa ra những sản phẩm không chứa đường, gluten giúp hạn chế các ảnh hưởng tiêu cực đến sức khoẻ của chó như dị ứng, mẩn ngứa, khó tiêu, bệnh tiểu đường…', 0, '2018-08-18 17:05:32', '2018-08-18 17:05:32'),
(47, 2, 4, 'Thức ăn Iskhan Performance', 240000, 6, 0, '1534612046.2351_iskhanperformancepetcity-280x315.jpg', 'Là dòng sản phẩm thức ăn hạt dành cho thú cưng mới với công thức vượt trội không chứa ngũ cốc, không chứa chất bảo quản, không có sản phẩm làm thay đổi gen từ thương hiệu Iskhan Hàn Quốc.\r\n\r\nHạt Iskhan Performance Cho Chó Lớn Túi 1.3Kg được chọn lừa từ những nguyên liệu đặc biệt giúp cơ, khớp, xương của các chú chó được bảo vệ và tăng cường mạnh mẽ, giúp da và lông bóng khỏe mượt mà.', 0, '2018-08-18 17:07:26', '2018-08-18 17:07:26'),
(48, 2, 10, 'Ổ đệm nằm cho chó mèo', 150000, 6, 0, '1534612210.IMG_0758-480x540.jpg', 'Sản phẩm có nhiều size để phù hợp với từng bé . Giá từ 150.000 đến 600.000 tùy size và tùy mẫu\r\n\r\nSize XS : 150k\r\n\r\nSize S : 200 – 250k\r\n\r\nSize M : 250 – 300k\r\n\r\nSize L : 300 – 350k\r\n\r\nSize XL : 400 – 450k\r\n\r\nSize XXL : 500 – 600k\r\n\r\nChất liệu bông mềm bên trong , vải nỉ bên ngoài , được may hết sức tỉ mỉ và đẹp mắt với nhiều mẫu mã cũng như kiểu dáng xinh xắn\r\n\r\nĐệm nằm tạo cảm giác ấm áp và dễ chịu cho cún mèo cưng , nhất là trong mùa đông lạnh\r\n\r\nSản phẩm dễ dàng giặt sạch , có thể cho vào máy giặt hoặc giặt tay đều được , không lo bị ám mùi hôi', 0, '2018-08-18 17:10:10', '2018-08-18 17:10:10'),
(49, 2, 10, 'Đệm mỏng cho chó mèo', 150000, 7, 0, '1534612282.IMG_0593-280x315.jpg', 'Chất liệu bông mềm bên trong , vải nỉ bên ngoài , được may hết sức tỉ mỉ và đẹp mắt với nhiều mẫu mã cũng như kiểu dáng xinh xắn\r\n\r\nĐệm nằm tạo cảm giác ấm áp và dễ chịu cho cún mèo cưng , nhất là trong mùa đông lạnh\r\n\r\nSản phẩm dễ dàng giặt sạch , có thể cho vào máy giặt hoặc giặt tay đều được , không lo bị ám mùi hôi', 0, '2018-08-18 17:11:22', '2018-08-18 17:11:22'),
(50, 2, 10, 'Ổ đệm nằm cho mèo', 150000, 12, 0, '1534612320.IMG_0582-280x315.jpg', 'Chất liệu bông mềm bên trong , vải nỉ bên ngoài , được may hết sức tỉ mỉ và đẹp mắt với nhiều mẫu mã cũng như kiểu dáng xinh xắn\r\n\r\nĐệm nằm tạo cảm giác ấm áp và dễ chịu cho cún mèo cưng , nhất là trong mùa đông lạnh\r\n\r\nSản phẩm dễ dàng giặt sạch , có thể cho vào máy giặt hoặc giặt tay đều được , không lo bị ám mùi hôi', 0, '2018-08-18 17:12:00', '2018-08-18 17:12:00'),
(51, 2, 10, 'Địu chó mèo', 200000, 4, 0, '1534612423.IMG_0752-280x315.jpg', 'Địu chó mèo,dành cho chó mèo nhỏ từ 3-6 kg.', 0, '2018-08-18 17:13:43', '2018-08-18 17:13:43'),
(52, 2, 6, 'Áo Superman', 60000, 14, 0, '1534612538.ao-ba-lo-cho-cho-1.jpg', 'Các mẫu quần áo mùa hè dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:15:38', '2018-08-18 17:15:38'),
(53, 2, 6, 'Áo mũ kẻ caro', 120000, 8, 0, '1534612615.6541efb53510bd69dfcb6cfba046fe97.jpg', 'Các mẫu quần áo mùa hè dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:16:55', '2018-08-18 17:16:55'),
(54, 2, 6, 'Áo bọ rùa', 200000, 18, 0, '1534612668.bo-quan-ao-petstyle-ong-canh-cam-5-min.jpg', 'Các mẫu quần áo mùa đông dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:17:48', '2018-08-18 17:17:48'),
(55, 2, 6, 'Áo vịt có mũ', 90000, 10, 0, '1534612754.1660_ao_thu_hinh_con_vit_tong_hop__49191_zoom.PNG', 'Các mẫu quần áo  dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:19:14', '2018-08-18 17:19:14'),
(56, 2, 6, 'Bộ chú hề', 250000, 4, 5, '1534612782.dogloveit-halloween-clown-costumes-soft-dog-clothes-for-007.jpg', 'Các mẫu quần áo  dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:19:42', '2018-08-18 17:19:42'),
(57, 2, 6, 'Áo thủy thủ', 80000, 6, 0, '1534612814.images.jpg', 'Các mẫu quần áo  dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:20:14', '2018-08-18 17:20:14'),
(58, 2, 6, 'Áo mũ Totoro', 160000, 7, 0, '1534612928.images (3).jpg', 'Các mẫu quần áo  dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:22:08', '2018-08-18 17:22:08'),
(59, 2, 6, 'Bộ Cướp Biển', 250000, 3, 0, '1534612964.Funny-Halloween-pet-cat-dog-Pirate-costume-cosplay-clothes-with-dog-Skull-hat-dog-puppy-party.jpg_640x640.jpg', 'Các mẫu quần áo  dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:22:44', '2018-08-18 17:23:02'),
(60, 2, 6, 'Bộ Quàng Thượng', 290000, 1, 0, '1534613022.3967455554_518795706.400x400.jpg', 'Các mẫu quần áo  dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:23:42', '2018-08-18 17:24:00'),
(61, 2, 6, 'Bộ Bạch Tuyết', 160000, 13, 0, '1534613071.Clothes-for-dogs-Pet-Dog-Dress-for-Chihuahua-Yorkies-Classic-Princess-Lace-Wedding-Dresses-Clothing-for.jpg_640x640.jpg', 'Các mẫu quần áo  dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:24:31', '2018-08-18 17:24:31'),
(62, 2, 6, 'Áo Pikachu', 200000, 25, 0, '1534613100.3366845273_181355791.jpg', 'Các mẫu quần áo  dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:25:00', '2018-08-18 17:25:09'),
(63, 2, 6, 'Áo Panda đỏ', 130000, 8, 0, '1534613144.images (2).jpg', 'Các mẫu quần áo  dành cho các bé có cân nặng từ 3 đến 6 kg\r\n\r\nRất nhiều mẫu mã đa dạng và đẹp mắt , phù hợp với tất cả các dòng chó', 0, '2018-08-18 17:25:44', '2018-08-18 17:25:44'),
(64, 2, 5, 'Gà cao su', 60000, 15, 0, '1534613335.shrilling-chicken.jpg', 'Đồ chơi dành cho chó mèo', 0, '2018-08-18 17:28:55', '2018-08-18 17:28:55'),
(65, 2, 5, 'Quả cầu cao su', 80000, 12, 0, '1534613391.tải xuống (2).jpg', 'Đồ chơi dành cho chó mèo.', 0, '2018-08-18 17:29:51', '2018-08-18 17:29:51'),
(66, 2, 5, 'Chuột len', 40000, 14, 0, '1534613431.images (4).jpg', 'Đồ chơi dành cho chó mèo.', 0, '2018-08-18 17:30:31', '2018-08-18 17:30:31'),
(67, 2, 5, 'Bộ xương đồ chơi', 60000, 32, 0, '1534613471.do-choi-thu-cung-600x450.jpg', 'Đồ chơi dành cho chó mèo.', 0, '2018-08-18 17:31:11', '2018-08-18 17:31:11'),
(68, 2, 11, 'Blue Iguana - Rồng Nam Mỹ', 3500000, 2, 0, '1534613679.1499177674_hqdefault.jpg_crop278x278.jpg', 'Rồng Nam Mỹ Blue iguana ngoại nhập .Là lọai động vật cảnh quý hiếm,dễ nuôi, ăn hoàn toàn rau củ quả, tuổi thọ cao từ 20-30 năm trong môi trường nuôi. Kích cỡ từ 1m6-1m8, có chỉ số IQ cao.', 0, '2018-08-18 17:34:39', '2018-08-18 17:34:39'),
(69, 2, 11, 'Rùa sao Ấn Độ', 2500000, 3, 0, '1534613743.rua-sao-an-do-1493977958.jpg_crop278x278.jpg', 'Rùa sao Ấn Độ có đặc điểm dễ nuôi, ít bệnh tật, bề ngoài bắt mắt.Giá cả cũng khá mềm hơn so với các loại rùa sống trên cạn khác như Radiated, Sulcata, Red Foot,....', 0, '2018-08-18 17:35:43', '2018-08-18 17:35:43'),
(70, 2, 11, 'Rùa Da Báo - Leopard tortoise', 2500000, 3, 0, '1534613861.rua-canh-leopard-tortoise-1493977970.jpg_crop278x278.jpg', 'Rùa Da Báo - Leopard tortoise có tên thường gọi là Leopard tortoise, tên khoa học là Stigmochelys pardalis.\r\n\r\nSize: Chiều dài cơ thể của con trưởng thành trung bình là 46cm và nặng 18kg, khi lớn hết cỡ mai của chúng sẽ đạt tới 61cm,', 0, '2018-08-18 17:37:41', '2018-08-23 13:54:35'),
(71, 2, 11, 'Hognose Snake - Rắn mũi hếch', 3000000, 6, 0, '1534613956.1517400902_048c74776df48d621d77f26529df9a82.jpg_crop278x278.jpg', 'Rắn mũi hếch từ lâu đã được con người thuần hóa làm thú cưng, với đặc tính hiền lành dễ thương và khuôn mặt ngốc nghếch, chúng nhanh chóng chiếm được tình cảm sâu sắc của con người, từ đó hàng loạt các màu', 0, '2018-08-18 17:39:16', '2018-08-18 17:39:16'),
(72, 2, 11, 'Rắn ngô - Corn Snake', 800000, 12, 0, '1534614000.ran-ngo-amel-corn-snake-1493977814_2.jpg_crop278x278.jpg', 'Rắn ngô Corn Snake là loài loài bò sát cảnh hiền lành, dễ thuần phục, không độc. Có nhiều màu sắc đẹp.', 0, '2018-08-18 17:40:00', '2018-08-18 17:40:00'),
(73, 2, 11, 'Rắn sữa - Milk Snake', 250000, 5, 10, '1534614051.tải xuống (3).jpg', 'Rắn cảnh milk snake là một loài bò sát cảnh đang được rất nhiều bạn trẻ tìm nuôi, màu sắc đẹp và không độc hại, dễ chăm sóc, đễ thuần hóa', 0, '2018-08-18 17:40:51', '2018-08-18 17:40:51'),
(74, 2, 11, 'Ếch Pacman', 300000, 2, 5, '1534614129.11188235_904190309640283_1467709934941534535_n__65866.1433449772.1280.1280.jpg', 'Những chú Pacman với thân hình hết sức ngộ nghĩnh cùng màu sắc sặc sỡ sống động như 1 nhân vật hoạt họa với cái đầu chỉ bằng 1/2 cơ thể,chiếc mồm rộng đến cuối xương hàm và 1 thân hình tròn xoe,béo hú đã giúp chúng ngày càng được nuôi phổ biến như 1 thú cưng tại các gia đình ở Mỹ và châu âu .', 0, '2018-08-18 17:42:09', '2018-08-22 13:29:49'),
(75, 2, 11, 'Leopard Gecko', 800000, 10, 0, '1534614210.leopard-gecko-1493977837.jpg_crop278x278.jpg', 'Thằn lằn da báo Size baby', 1, '2018-08-18 17:43:30', '2018-08-18 17:43:38'),
(76, 2, 11, 'Thằn lằn da báo', 800000, 11, 10, '1534614277.tải xuống (4).jpg', 'Thằn lằn da báo Size baby', 0, '2018-08-18 17:44:37', '2018-08-23 13:53:58'),
(77, 2, 11, 'Trăn cây Green Tree Python', 3500000, 0, 0, '1534614345.tran-cay-green-tree-python-1493977966.jpg_crop278x278.jpg', 'Trăn cây xanh được biết đến như 1 trong số các ngôi sao trong giới bò sát cảnh, nói về ngoại hình, chúng có một vẻ đẹp khó cưỡng lại, với màu sắc thay đổi theo từng thời điểm của sự phát triển, từ nhỏ tới lớn, màu sắc được chuyển đổi từ vàng hoặc nâu đỏ, nâu đen. Khi bạn được sở hữu một chú Trăn Cây Xanh, điều đó đồng nghĩa với việc đã được tiếp cận với 1 trong số các loài trăn thú vị nhất thế giới, kích thước khá nhỏ gọn, màu sắc đẹp, cơ thể với những đường cong tuyệt mỹ đem lại cho người nhìn cảm giác cuốn hút khó tả…', 0, '2018-08-18 17:45:45', '2018-08-23 13:54:18'),
(78, 2, 11, 'Nhện chân trắng', 350000, 3, 0, '1534614445.nhen-chan-trang-white-knee-tarantula-1493977957.jpg_crop278x278.jpg', 'Nhện chân trằng - White knee tarantula , đặc điểm dễ nuôi, màu sắc đẹp- là một ttrong ba loài nhện lớn nhanh nhất thế giới', 0, '2018-08-18 17:47:25', '2018-08-22 17:13:24'),
(79, 2, 7, 'Spa Grooming', 300000, 99, 0, '1534614588.tam-say-thu-cung.jpg', 'Spa Grooming là dịch vụ chăm sóc sắc đẹp thú cưng cực kỳ nổi tiếng. Nó làm cho thú của bạn trở nên đẹp hơn, thoải mái và khỏe mạnh hơn.', 0, '2018-08-18 17:49:48', '2018-08-18 17:49:48'),
(80, 2, 8, 'Trông giữ thú cưng', 150000, 99, 0, '1534614752.khach-san-cho-meo-1.jpg', 'Dịch Vụ Trông giữ thú cưng', 0, '2018-08-18 17:52:32', '2018-08-18 17:52:32'),
(81, 2, 9, 'Tiêm chủng tại nhà', 200000, 99, 0, '1534614853.tiêm-vaxin-cho-chó.jpg', 'Dịch vụ tiêm phòng cho thú nuôi tại nhà', 0, '2018-08-18 17:54:13', '2018-08-18 17:54:13');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `link`, `image`) VALUES
(1, '', 'banner1.jpg'),
(2, '', 'banner2.jpg'),
(3, '', 'banner3.jpg');

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
(3, 'Đủ hàng'),
(4, 'Đang giao hàng'),
(5, 'Đã hoàn thành');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_benefits`
--

INSERT INTO `store_benefits` (`id`, `payment_id`, `amount`) VALUES
(1, 2, 57000),
(2, 1, 350000),
(3, 3, 70000);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `password`, `remember_token`, `phoneNumber`, `address`, `city_code`, `card_number`, `bank_username`, `bank_name`, `bank_branch`, `roleId`, `avatar`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'Hyuga_', 1, 'hiepnhse03561@fpt.edu.vn', '$2y$10$GOScVmqbLAei2QnKkH.Ob.3yjO8aIyo9zMC2jlpvVrcZxNt1WCu1K', 'rwpp6ijGgvews3NsvoeTZlwLGifcmbFrPjGW5OYQy1fmLfFb9R64v0DkmqCc', '01697161671', 'đình thôn mỹ đình 1 Nam Từ Liêm, Hà Nội', 1, '12345678909876', 'Nguyễn Hữu Hiệp', 'Vietcombank', 'Mỹ Đình 1', 2, '1532978090.petshop.png', 0, '2018-07-19 21:26:11', '2018-08-19 12:22:14'),
(2, 'Nguyễn Hiệp', 0, 'hiepnhse03562@fpt.edu.vn', '$2y$10$F7GXS8erW99OtdQR2b0EXON1JI4zShQ1X4Hz0QytIe0tAQeO7XG0m', 'Cn1ktZLTAR3TSzeLxSrB1aaqBOEgU9mhsFY4cLiGCjc8St2OmbONueNXuSjV', '01697161671', 'Từ Liêm', 1, NULL, NULL, NULL, NULL, 2, 'user-default.png', 0, '2018-07-19 17:12:00', '2018-07-19 17:12:00'),
(5, 'Nguyễn Hữu Hiệp', 0, 'acquy_tokyo_95@yahoo.com.vn', '$2y$10$r0ld8F2dm3blCo5AMZqjNuGAkyVga2f5WzzMzPZ2gdM6lDfSv.47e', 'LQ9RzjErPEhpuI22HukSFSZ61pOb0PKcb7VvSPOhOUWvhhndffaNRUlzfiix', '01697161671', 'đường đình thôn mỹ đình 1', 1, NULL, NULL, NULL, NULL, 4, '1532627521.petshop.png', 0, '2018-07-24 10:19:05', '2018-08-19 12:25:36'),
(6, 'Monkey D. Luffy', 0, 'ludeptrai@gmail.com', '$2y$10$pfSJ.rrRGdPNO2vPmGoEQuMdKE73lDQTCjt8C0Kr3C0NcUjuWZyES', 'FRJpgXINCHNNAxxxU7oDFYJyCxdsuKM28OFCWFEIhxehGO06p8XVVMtvI7qT', NULL, 'Cầu Giấy', 1, NULL, NULL, NULL, NULL, 3, 'https://lh6.googleusercontent.com/-DRHnTWdkkCI/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7o--PHL9DAzQiKqagKotFAjEXeDUw/mo/photo.jpg?sz=50', 1, '2018-07-24 10:40:29', '2018-08-19 12:28:57'),
(7, 'Hashimoto Kanna', 1, 'voanhhiep@gmai.com', '$2y$10$qexDKUrcOCoOOBLrcDBbHeXn2UpiFM0wAe/9.6gP0mh98jz2OQJru', 'aynRe5yeuXIibfmBOOjlKjzumNkdrxUBAawWrtqrmFCIGmLD97tjrwniYLxN', '01697161671', 'Mỹ Đình 1', 2, '4342342344234', 'dsadsada', 'đasd', 'aaaaaaaaa', 2, '1534145265.banner.png', 0, '2018-08-07 15:58:05', '2018-08-19 11:24:37'),
(8, 'Portgas D. Ace', 1, 'portgas@gmail.com', '$2y$10$VdcQG06XdIi/jnNiGkmBW.Hm4zHAUTvT9uR165sgBHv87/hQhnlvC', NULL, '01697161671', 'dsadsadsaddsad ,19}', 1, NULL, NULL, NULL, NULL, 3, 'user-default.png', 1, '2018-08-13 06:56:34', '2018-08-19 12:45:09'),
(9, 'Kakalot', 1, 'kakalot@gmail.com', '$2y$10$2nev7GkVlilp/tQZbwkyouzLzaSjts3CaS.6fkkbjaCzVKIXpSuCG', NULL, '01697161671', 'Mỹ Đình 3 ,Tỉnh Lạng Sơn', 20, NULL, NULL, NULL, NULL, 3, 'user-default.png', 0, '2018-08-13 07:07:00', '2018-08-19 12:27:24'),
(10, 'Kazaki Kazua', 1, 'kazaki_jp@gmail.com', '$2y$10$UfSYM85mVUutCcAvckhNreEIjlLjzya55ewEzILcoIL3DeppPuZpy', NULL, '01697161671', 'Mỹ Đình 2,Tỉnh Quảng Ninh', 26, NULL, NULL, NULL, NULL, 4, 'user-default.png', 0, '2018-08-13 08:18:03', '2018-08-13 09:24:43'),
(11, 'Sabo', 1, 'emanhace@gmail.com', '$2y$10$a583RvxOf765uPlVTlYyr.mTHCB2L/5al2SfHmp1SNBD2bFkHF5PC', 'bGOLEJHvs7BGjme5iCBE4uvUuEBOSGTGfjNBwK6OAXfmnJiN9BF65dN7UcgF', '01697161671', 'Mỹ Đình ,Thành phố Hà Nội', 1, NULL, NULL, NULL, NULL, 1, 'user-default.png', 0, '2018-08-13 20:16:15', '2018-08-13 20:16:15'),
(12, 'Minamoto Monogatari', 1, 'chac_ai_do_se_hieu@gmail.com', '$2y$10$sE702gop0tfjMGq6Ku5T/.e/42DOjqyLTZVXU9U6IcOmoDLFNBl6.', 'CBiMgCFRwAKL1aHnWsdMEsVWwJAIr0kLXlm0xwHxaG9vZaCrirhi0copCCur', '01697161671', 'Mỹ Đình 4 ,Thành phố Hà Nội', 1, NULL, NULL, NULL, NULL, 3, 'user-default.png', 0, '2018-08-14 07:57:16', '2018-08-19 12:27:32'),
(13, 'SYSTEM ADMIN', 1, 'tpfteam1111@gmail.com', '$2y$10$zdfWD3jNhulLxXzHeOfBsuF1c8.m655GPr08voqJ5Ui9yPdJVybva', 'HNcKIMeIItGINUh3lFwVhjoKzhcT0A43Gm90zDZFHFrIcKvwkxXHMobsRIYq', '01697161671', 'Khu công nghệ cao Hòa Lạc, Thạch Thất ,Thành phố Hà Nội', 1, NULL, NULL, NULL, NULL, 1, 'user-default.png', 0, '2018-08-20 16:53:47', '2018-08-20 16:53:47');

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
(1, 'Kho Hà Nội', 'Khu công nghệ cao Hòa Lạc, Thạch Thất, Hà Nội'),
(2, 'Kho Đà Nẵng', 'Nguyễn Văn Linh, An Hải Trung, Hải Châu, Đà Nẵng'),
(3, 'Kho Sài Gòn', 'Công xã Paris, Bến Nghé, Quận 1, Quận 1 Hồ Chí Minh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
