-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 03:45 PM
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
CREATE TABLE `catalogs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `catalog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `catalog_id`) VALUES
(1, 'chó', 1),
(2, 'mèo', 1),
(3, 'chim', 1),
(4, 'thức ăn', 2),
(5, 'đồ chơi', 2),
(6, 'quần áo', 2),
(7, 'làm đẹp', 3),
(8, 'trông giữ', 3),
(9, 'chữa trị', 3),
(10, 'đồ dùng', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `media_link` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `delete_flag` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(10, 5, 2, 'sdsa', 'dsa', 0, '2018-08-01 13:42:32', '2018-08-01 13:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '1',
  `moderator_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `moderator_id`, `user_id`, `payment_id`, `created_at`, `updated_at`, `completed_at`) VALUES
(5, 1, NULL, 5, 11, '2018-07-29 17:29:46', '2018-07-29 17:29:46', NULL),
(6, 1, NULL, 5, 12, '2018-07-29 17:44:14', '2018-07-29 17:44:14', NULL),
(7, 1, NULL, 5, 13, '2018-07-29 18:09:16', '2018-07-29 18:09:16', NULL),
(8, 1, NULL, 5, 14, '2018-07-29 18:24:24', '2018-07-29 18:24:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_lines`
--

DROP TABLE IF EXISTS `order_lines`;
CREATE TABLE `order_lines` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_lines`
--

INSERT INTO `order_lines` (`id`, `order_id`, `product_id`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(8, 5, 2, 1, 6800000, '2018-07-29 17:29:46', '2018-07-29 17:29:46'),
(9, 5, 3, 1, 10000000, '2018-07-29 17:29:46', '2018-07-29 17:29:46'),
(10, 6, 10, 1, 11347500, '2018-07-29 17:44:14', '2018-07-29 17:44:14'),
(11, 6, 6, 1, 3815000, '2018-07-29 17:44:14', '2018-07-29 17:44:14'),
(12, 7, 2, 1, 6800000, '2018-07-29 18:09:16', '2018-07-29 18:09:16'),
(13, 8, 2, 1, 6800000, '2018-07-29 18:24:24', '2018-07-29 18:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_logs`
--

DROP TABLE IF EXISTS `order_logs`;
CREATE TABLE `order_logs` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '1',
  `amount` int(11) NOT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `payment_info` text,
  `security` varchar(255) DEFAULT NULL,
  `user_message` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `status`, `amount`, `payment`, `payment_info`, `security`, `user_message`, `created_at`, `updated_at`) VALUES
(11, 1, 16800000, NULL, NULL, NULL, NULL, '2018-07-29 17:29:46', '2018-07-29 17:29:46'),
(12, 1, 15162500, NULL, NULL, NULL, NULL, '2018-07-29 17:44:14', '2018-07-29 17:44:14'),
(13, 1, 6800000, NULL, NULL, NULL, NULL, '2018-07-29 18:09:16', '2018-07-29 18:09:16'),
(14, 1, 6800000, 'Visa', 'a:4:{s:8:\"username\";s:4:\"Hiep\";s:11:\"card_number\";s:16:\"1234123412331234\";s:16:\"Expiration_month\";s:1:\"2\";s:15:\"Expiration_year\";s:4:\"2020\";}', '3', NULL, '2018-07-29 18:24:24', '2018-07-29 18:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
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
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `name`, `price`, `quantity`, `discount`, `image_link`, `description`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Chó Husky', 11500000, 5, 10, 'husky.jpg', 'Chó Husky(chó tuyết kéo xe) có xuất xứ từ Siberia – Nga, rất giống cho sói. Được con người lai tạo lần đầu tiên để kéo xe tuyết chở hàng hóa khắp Siberia. Thân hình những chú chó Husky cân đối, dáng vẻ dũng mãnh và đặc biệt cực kỳ dẻo dai. Bộ lông của chúng rất dày có 2 lớp giúp giữ ấm cơ thể rất tốt, nhưng cũng chính lớp lông này khiến chúng khó thích nghi khi được nuôi trong thời tiết nắng nóng.', 0, '2018-07-17 17:11:28', '2018-07-17 17:11:28'),
(2, 1, 1, 'Chó Samoyed – Chó tuyết kéo xe', 8000000, 3, 15, 'Samoyed.jpg', 'Chó Samoyed có xuất xứ từ vùng núi Taiga, Tây Bắc Siberia – Nga. Cũng giống như Husky chúng cũng có cơ thể mạnh mẽ, dẻo dai, lớp lông dày có thể kéo xe tuyết trong thời gian dài. Chó Samoyed có địa vị rất cao trong xã hội người Samoyede giúp họ vận chuyển lương thực, săn bắt thú rừng và bảo vệ khỏi kẻ thù.', 0, '2018-07-17 17:24:52', '2018-07-29 18:24:24'),
(3, 1, 1, 'Chó Alaska (Alaska Malamute)', 10000000, 0, 0, 'Alaska.jpg', 'Chó Alaska cũng là một giống chó xứ lạnh giống Husky và Samoyed được thuần hóa bởi bộ tộc Mahlemute. Khi mới bắt đầu thuần hóa, chó Alaska cũng chỉ có kích thước ngang với Husky nhưng được người Eskimo lai tao để có được những chú chó Alaska to khỏe, dẻo dai và chịu được thời tiết khắc nghiệt hơn.', 0, '2018-07-17 17:24:52', '2018-07-29 17:29:46'),
(4, 1, 1, 'Chó Becgie – Chó chăn cừu', 4000000, 1, 0, 'Becgie.jpg', 'Chó Becgie được người Đức lai tạo lần đầu năm 1899, chủ yếu dùng để chăn cừu. Nhưng với sự thông minh vượt bậc, trung thành, nhanh nhẹn chúng nhanh chóng được huấn luyện để phục vụ trong ngành cảnh sát và quân đội. Theo thống kê, chó Becgie là giống chó phục vụ nhiều nhất trong lực lượng cảnh sát các nước trên thế giới.', 0, '2018-07-17 17:24:52', '2018-07-17 17:24:52'),
(5, 1, 1, 'Chó Golden(Golden Retriever)', 6000000, 0, 0, 'Golden.jpg', 'Đây là giống cho có nguồn gốc từ nước Anh, được lai tạo qua nhiều giống chó khác nhau. Nhưng chúng vẫn có bản năng săn mồi rất mạnh, khả năng đánh hơi tìm dấu vết hoàn hảo nên chúng cũng được cảnh sát các nước huấn luyện để dò tìm ma túy và các chất nổ.', 0, '2018-07-17 17:24:52', '2018-07-17 17:24:52'),
(6, 1, 1, 'Chó săn Poodle', 5450000, 0, 30, 'Poodle.jpg', 'Poodle là giống chó có xuất xứ từ Pháp, có khả năng bơi lội rất giỏi nên từ xưa chúng thường được người dân bản xứ dùng để săn vịt trời. Đặc điểm của chúng là có bộ lông xoăn tít, giữ ấm rất tốt.', 0, '2018-07-17 17:24:52', '2018-07-29 17:44:14'),
(7, 1, 1, 'Chó Labrador', 3000000, 6400000, 15, 'Labrador.jpg', 'Labrador là giống chó được coi là phổ biến nhất tại Mỹ, thường được các dân nuôi chó chuyên nghiệp huấn luyện để tha mồi trong các cuộc đi săn. Chó Labrador rất thông minh, có thể giúp con người làm được rất nhiều việc nên chúng thường được coi là một thành viên trong gia đình. ', 0, '2018-07-17 17:24:52', '2018-07-17 17:24:52'),
(8, 1, 1, 'Chó Dorberman', 13350000, 1, 0, 'Dorberman.jpg', 'Chó Dorberman được nhà lai tạo người Đức Louis Dorberman nhân giống thành công năm 1890 bởi ít nhất 4 giống chó. Tỉ lệ kết hợp giữa 4 giống chó với nhau gần như đã bị thất lạc.\r\nChó Dorberman rất dũng mãnh, cơ bắt, cổ cao, ta dụng chân dài và nhanh nhẹn. Một chú Dorberman trưởng thành nặng từ 30-45kg tùy theo giới tính đực cái, bản tính Dorberman khá hung giữ, rất cảnh giác với người lạ nhưng trung thành với chủ nên thường được các gia đình nuôi làm chó giữ nhà.', 0, '2018-07-17 17:24:52', '2018-07-17 17:24:52'),
(9, 1, 1, 'Chó Pitbull', 15000000, 1, 10, 'Pitbull.jpg', 'Chó Pitbull có nguồn gốc từ Anh, ban đầu có kích thước khá nhỏ bé, nhưng để phục vụ một thể thao “chọi chó” nhiều người tại Mỹ đã lai tạo chúng trở nên to lớn và hung dữ hơn. Và cái tên Pitbull cũng được bắt nguồn từ môn thể thao này. Vào đầu thế kỷ 20 do luật cấm những trò giải trí như “chọi chó” ra đời nên Pitbull được lai tạo cho trở nên hiền lành và dùng để nuôi trong nhà.', 0, '2018-07-17 17:24:52', '2018-07-17 17:24:52'),
(10, 1, 2, 'Mèo A', 13350000, 1, 15, 'husky.jpg', '', 0, '2018-07-19 16:43:29', '2018-07-29 17:44:14'),
(11, 1, 4, 'Thức ăn', 100000, 2, 10, 'husky.jpg', '', 0, '2018-07-19 16:43:29', '2018-07-19 16:43:29'),
(12, 1, 10, 'Bát đôi cấp nước tự động', 30000, 10, 0, 'batdoi.jpg', 'Bát ăn uống nước cấp nước tự động gắn chai nước ngọt (bát không bao gồm chai) \r\n- Sản phẩm được làm từ chất liệu nhựa cao cấp không gây hại, không làm ảnh hưởng đến chất lượng thức ăn, màu sắc bất mắt giúp thú cưng ăn ngon mệng hơn\r\n+ Sản phẩm xứng đáng là sự lựa chọn lý tưởng của bạn dành cho thú cưng.\r\n+ Bề mặt trơn láng, dễ dàng chùi rửa sạch sẽ sau khi sử dụng.\r\n+ Được thiết kế dựa trên tiêu chuẩn chất lượng của Châu Âu.\r\nBát ăn và uống nước cho chó mèo, chất liệu tốt, bền, đẹp, không độc hại, không kích ứng với da\r\n+ Bát sẽ thoải mái khi đi vắng mà không sợ cún bị khát nước.\r\n- Kích thước bát ( Không kèm bình nước) : 27x16x6cm\r\n>>> Bình nước là bình nước khoáng hoặc nước ngọt, bình, chai nào cũng có thể lắp vừa\r\n- Trọng lượng: 100', 0, '2018-07-22 22:48:22', '2018-07-22 22:48:22'),
(13, 1, 10, 'Bát đôi kèm lõi inox ', 99000, 54, 0, 'batan.jpg', 'Bát đôi kèm lõi inox cao cấp dành cho chó mèo - CutePets\r\n\r\n- Chất liệu: Nhựa PP không ôi nhiễm môi trường, lõi inox không gỉ\r\n\r\n- Màu sắc:hồng, xanh da trời, vàng màu xanh lá cây\r\n\r\n- Kích Thước bên ngoài:chiều dài = 32cm, chiều rộng = 16 cm, chiều cao = 6.5 cm;\r\n\r\n- Bát bên trong Đường Kính Miệng:14 cm.\r\n\r\n- Sử dụng:Pet (Chó & Mèo) trong Thực Phẩm & Bát Nước tính năng:\r\n\r\n1. chất liệu Inox chất lượng cao không gỉ làm cho các bát Độ Bền Cao hơn\r\n\r\n2. Vỏ làm từ nhựa PP Nhựa an toàn và không độc hại\r\n\r\n3. Tháo lắp một cách dễ dàng và dễ làm sạch', 0, '2018-07-22 22:48:22', '2018-07-22 22:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '1',
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `reportTo_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `store_benefits`
--

DROP TABLE IF EXISTS `store_benefits`;
CREATE TABLE `store_benefits` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_comments`
--

DROP TABLE IF EXISTS `sub_comments`;
CREATE TABLE `sub_comments` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `media_link` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_outfits`
--

DROP TABLE IF EXISTS `supplier_outfits`;
CREATE TABLE `supplier_outfits` (
  `id` int(11) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '1',
  `payment_id` int(11) NOT NULL,
  `suplier_id` int(11) NOT NULL,
  `amount_for_suplier` int(11) NOT NULL,
  `payment_time` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` int(2) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL,
  `bank_username` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `roleId` int(4) NOT NULL DEFAULT '3',
  `avatar` varchar(255) NOT NULL,
  `delete_flag` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `supplier_registers`;
CREATE TABLE `supplier_registers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` int(2) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL,
  `bank_username` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
   `chandung` varchar(255) NOT NULL,
    `cmnd` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `password`, `remember_token`, `phoneNumber`, `address`, `card_number`, `bank_username`, `bank_name`, `bank_branch`, `roleId`, `avatar`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'Hyuga_', 1, 'hiepnhse03561@fpt.edu.vn', '$2y$10$GOScVmqbLAei2QnKkH.Ob.3yjO8aIyo9zMC2jlpvVrcZxNt1WCu1K', NULL, '01697161671', 'Hà Nội', NULL, NULL, NULL, NULL, 2, '1532978090.petshop.png', 0, '2018-07-19 21:26:11', '2018-07-30 19:14:50'),
(2, 'Nguyễn Hiệp', 0, 'hiepnhse03562@fpt.edu.vn', '$2y$10$F7GXS8erW99OtdQR2b0EXON1JI4zShQ1X4Hz0QytIe0tAQeO7XG0m', '53G6dxfoXxYeBJEwAE4nbTKjeKXvqzX6ptRtU2MkvK66htGHFabWgyUoW6nu', '01697161671', 'Hà Nội', NULL, NULL, NULL, NULL, 3, 'user-default.png', 0, '2018-07-19 17:12:00', '2018-07-19 17:12:00'),
(5, 'Nguyễn Hữu Hiệp', NULL, 'acquy_tokyo_95@yahoo.com.vn', '$2y$10$Q81NeEgJUtuojvC18COuqe4a9JWq71MorN92120YvYjha0bg.SFF2', 'h5aDHLDlWl0BXxhyhTnbqVP5TdjbH4uVlJxCvFvsJLqhdkCv3QawVc64yy6W', NULL, NULL, NULL, NULL, NULL, NULL, 1, '1532627521.petshop.png', 0, '2018-07-24 10:19:05', '2018-07-26 17:52:01'),
(6, 'Nguyen Hiep', 0, 'a.renji95@gmail.com', '$2y$10$pfSJ.rrRGdPNO2vPmGoEQuMdKE73lDQTCjt8C0Kr3C0NcUjuWZyES', 'FRJpgXINCHNNAxxxU7oDFYJyCxdsuKM28OFCWFEIhxehGO06p8XVVMtvI7qT', NULL, NULL, NULL, NULL, NULL, NULL, 3, 'https://lh6.googleusercontent.com/-DRHnTWdkkCI/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7o--PHL9DAzQiKqagKotFAjEXeDUw/mo/photo.jpg?sz=50', 0, '2018-07-24 10:40:29', '2018-07-24 10:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

DROP TABLE IF EXISTS `users_role`;
CREATE TABLE `users_role` (
  `id` int(11) NOT NULL,
  `role` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalogs`
--
ALTER TABLE `catalogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_lines`
--
ALTER TABLE `order_lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_logs`
--
ALTER TABLE `order_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_benefits`
--
ALTER TABLE `store_benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_comments`
--
ALTER TABLE `sub_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_outfits`
--
ALTER TABLE `supplier_outfits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalogs`
--
ALTER TABLE `catalogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_lines`
--
ALTER TABLE `order_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_logs`
--
ALTER TABLE `order_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store_benefits`
--
ALTER TABLE `store_benefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_comments`
--
ALTER TABLE `sub_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_outfits`
--
ALTER TABLE `supplier_outfits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
