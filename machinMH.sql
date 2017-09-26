-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2017 at 07:09 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `machin`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `ID` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `sort_order` bigint(20) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID`, `title`, `link`, `parent_id`, `sort_order`, `type`) VALUES
(2, 'Tin tức', '10', 0, 0, 'tin-tuc'),
(4, 'Facebook', 'http://fb.com', 2, 0, 'link'),
(5, 'Google', 'http://google.com', 4, 0, 'link'),
(6, 'Vui Ghê', 'http://vuighe.net', 2, 1, 'link');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `ID` bigint(20) NOT NULL,
  `option_name` text NOT NULL,
  `option_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`ID`, `option_name`, `option_value`) VALUES
(27, 'web-domain', 'http://localhost/machin'),
(28, 'web-title', 'Mạch in Minh Hà'),
(29, 'web-description', 'Xưởng Mạch in Minh Hà'),
(30, 'web-email', 'phammanh.1221998@gmail.com'),
(31, 'post_type', 'a:2:{i:0;a:2:{i:0;s:9:\"Tin tức\";i:1;s:7:\"tin-tuc\";}i:1;a:2:{i:0;s:5:\"Trang\";i:1;s:5:\"trang\";}}'),
(32, 'index_slider', 'a:2:{i:0;a:2:{s:4:\"link\";s:17:\"http://google.com\";s:3:\"src\";s:85:\"https://www.google.com.vn/images/branding/googlelogo/2x/googlelogo_color_120x44dp.png\";}i:1;a:2:{s:4:\"link\";s:13:\"http://fb.com\";s:3:\"src\";s:147:\"https://scontent.fhan2-1.fna.fbcdn.net/v/t31.0-8/19944485_503084846697045_8607685521166699811_o.png?oh=e3b2ce507a64dc5aee19390c8b26c3c6&oe=5A0F7BBA\";}}'),
(33, 'index_video', 'a:2:{i:0;s:41:\"https://www.youtube.com/embed/AmvA-XJF0j8\";i:1;s:41:\"https://www.youtube.com/embed/z5Jc7KiTLbs\";}');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` bigint(20) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_phone` text NOT NULL,
  `customer_email` text NOT NULL,
  `address` text NOT NULL,
  `receive_after` int(11) NOT NULL,
  `accept_time` text NOT NULL,
  `will_receive_time` text NOT NULL,
  `receive_time` text NOT NULL,
  `total_cost` bigint(20) NOT NULL,
  `status` text NOT NULL,
  `ship_to_home` varchar(5) NOT NULL,
  `code` varchar(7) NOT NULL,
  `view_code` varchar(7) NOT NULL,
  `user` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `customer_name`, `customer_phone`, `customer_email`, `address`, `receive_after`, `accept_time`, `will_receive_time`, `receive_time`, `total_cost`, `status`, `ship_to_home`, `code`, `view_code`, `user`) VALUES
(4, 'Phạm Văn Mạnh', '968864783', 'phammanh.1221998@gmail.com', '10b/Ngõ 55/Chính Kinh/Thanh Xuân/Hà Nội', 5, '', '', '', 540000, '0', 'yes', 'Bt0m3t', 'hi2ijD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_print_curcuits`
--

CREATE TABLE `order_print_curcuits` (
  `print_curcuit_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `number` int(11) NOT NULL,
  `cost` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_print_curcuits`
--

INSERT INTO `order_print_curcuits` (`print_curcuit_id`, `order_id`, `number`, `cost`) VALUES
(25, 4, 2, 540000);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` bigint(20) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` longtext NOT NULL,
  `post_date` text NOT NULL,
  `date_edited` text NOT NULL,
  `post_author` bigint(20) NOT NULL,
  `post_type` text NOT NULL,
  `post_thumbnail` text NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `post_title`, `post_content`, `post_date`, `date_edited`, `post_author`, `post_type`, `post_thumbnail`, `url`) VALUES
(10, 'Tin tức', 'Nội dung tin tức', '2017-08-16 20:03:47', '2017-08-16 20:03:47', 8, 'tin-tuc', '/images/post/download (2).png', 'tin-tuc'),
(11, 'Tin tức mới', '<p>Nội dung tin tức</p>', '2017-09-20 15:14:23', '2017-09-20 15:14:23', 11, 'tin-tuc', '/images/post/default_image_post.png', 'tin-tuc-moi'),
(18, 'Tin tuyển dụng', 'Nội dung tin tuyển dụng', '2017-09-20 15:21:15', '2017-09-24 20:27:05', 11, 'tin-tuc', '/images/post/164957.jpg', 'tin-tuyen-dung');

-- --------------------------------------------------------

--
-- Table structure for table `post_terms`
--

CREATE TABLE `post_terms` (
  `ID` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `term_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_terms`
--

INSERT INTO `post_terms` (`ID`, `post_id`, `term_id`) VALUES
(4, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `print_curcuit`
--

CREATE TABLE `print_curcuit` (
  `ID` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `url` text NOT NULL,
  `feature_image` text NOT NULL,
  `featured` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `print_curcuit`
--

INSERT INTO `print_curcuit` (`ID`, `name`, `type`, `url`, `feature_image`, `featured`) VALUES
(25, 'Mạch in OWG4RRVQ31', 'Order', 'mach-in-owg4rrvq31', '', 0),
(26, 'Test Print Curcuit', 'Mẫu', 'test-print-curcuit', '/images/print-curcuit/gXG3DXPkYltA.png', 1),
(27, 'Test Print Curcuit 2', 'Mẫu', 'test-print-curcuit-2', '/images/print-curcuit/uBr5dJiwPJtN.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `print_curcuit_properties`
--

CREATE TABLE `print_curcuit_properties` (
  `ID` bigint(20) NOT NULL,
  `property` bigint(20) NOT NULL,
  `print_curcuit` bigint(20) NOT NULL,
  `value` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `print_curcuit_properties`
--

INSERT INTO `print_curcuit_properties` (`ID`, `property`, `print_curcuit`, `value`) VALUES
(74, 5, 25, 19),
(75, 6, 25, 22),
(76, 7, 25, 24),
(77, 5, 26, 20),
(78, 6, 26, 22),
(79, 7, 26, 25),
(80, 5, 27, 20),
(81, 6, 27, 22),
(82, 7, 27, 25);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `ID` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `sort_order` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`ID`, `name`, `sort_order`) VALUES
(5, 'Thuộc tính mới', 0),
(6, 'Thuộc tính 1', 1),
(7, 'Thuộc tính khác', 2);

-- --------------------------------------------------------

--
-- Table structure for table `property_chose_value`
--

CREATE TABLE `property_chose_value` (
  `ID` bigint(20) NOT NULL,
  `property` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_chose_value`
--

INSERT INTO `property_chose_value` (`ID`, `property`, `value`, `price`) VALUES
(19, 5, 'Lựa chọn', 120000),
(20, 5, 'Lựa chọn 3', 240000),
(21, 6, 'Lựa chọn', 200000),
(22, 6, 'Lựa chọn 2', 100000),
(23, 6, 'Lựa chọn 3', 50000),
(24, 7, 'Màu 1', 50000),
(25, 7, 'Màu 2', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `quan_huyen`
--

CREATE TABLE `quan_huyen` (
  `ID` int(11) NOT NULL,
  `quan_huyen` text NOT NULL,
  `thanh_pho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quan_huyen`
--

INSERT INTO `quan_huyen` (`ID`, `quan_huyen`, `thanh_pho`) VALUES
(1, '', 1),
(2, 'A Lưới', 2),
(3, 'An Biên', 3),
(4, 'An Dương', 4),
(5, 'An Khê', 5),
(6, 'An Lão', 4),
(7, 'An Lão', 6),
(8, 'An Minh', 3),
(9, 'An Nhơn', 6),
(10, 'An Phú', 7),
(11, 'Anh Sơn', 8),
(12, 'Ayun Pa', 5),
(13, 'Ân Thi', 9),
(14, 'Ba Bể', 10),
(15, 'Ba Chẽ', 11),
(16, 'Ba Đình', 12),
(17, 'Ba Đồn', 13),
(18, 'Ba Tơ', 14),
(19, 'Ba Tri', 15),
(20, 'Ba Vì', 12),
(21, 'Bà Rịa', 55),
(22, 'Bá Thước', 17),
(23, 'Bác Ái', 18),
(24, 'Bạc Liêu', 19),
(25, 'Bạch Long Vĩ', 4),
(26, 'Bạch Thông', 10),
(27, 'Bảo Lạc', 20),
(28, 'Bảo Lâm', 20),
(29, 'Bảo Lâm', 21),
(30, 'Bảo Lộc', 21),
(31, 'Bảo Thắng', 22),
(32, 'Bảo Yên', 22),
(33, 'Bát Xát', 22),
(34, 'Bàu Bàng', 23),
(35, 'Bắc Bình', 24),
(36, 'Bắc Giang', 25),
(37, 'Bắc Hà', 22),
(38, 'Bắc Kạn', 10),
(39, 'Bắc Mê', 26),
(40, 'Bắc Ninh', 27),
(41, 'Bắc Quang', 26),
(42, 'Bắc Sơn', 28),
(43, 'Bắc Tân Uyên', 23),
(44, 'Bắc Trà My', 29),
(45, 'Bắc Từ Liêm', 12),
(46, 'Bắc Yên', 30),
(47, 'Bến Cát', 23),
(48, 'Bến Cầu', 31),
(49, 'Bến Lức', 32),
(50, 'Bến Tre', 15),
(51, 'Biên Hòa', 33),
(52, 'Bỉm Sơn', 17),
(53, 'Bình Chánh', 34),
(54, 'Bình Đại', 15),
(55, 'Bình Gia', 28),
(56, 'Bình Giang', 35),
(57, 'Bình Liêu', 11),
(58, 'Bình Long', 36),
(59, 'Bình Lục', 37),
(60, 'Bình Minh', 38),
(61, 'Bình Sơn', 14),
(62, 'Bình Tân', 34),
(63, 'Bình Tân', 38),
(64, 'Bình Thạnh', 34),
(65, 'Bình Thủy', 39),
(66, 'Bình Xuyên', 40),
(67, 'Bố Trạch', 13),
(68, 'Bù Đăng', 36),
(69, 'Bù Đốp', 36),
(70, 'Bù Gia Mập', 36),
(71, 'Buôn Đôn', 41),
(72, 'Buôn Hồ', 41),
(73, 'Buôn Ma Thuột', 41),
(74, 'Cà Mau', 42),
(75, 'Cai Lậy', 43),
(76, 'Cai Lậy', 43),
(77, 'Cái Bè', 43),
(78, 'Cái Nước', 42),
(79, 'Cái Răng', 39),
(80, 'Cam Lâm', 44),
(81, 'Cam Lộ', 45),
(82, 'Cam Ranh', 44),
(83, 'Can Lộc', 46),
(84, 'Càng Long', 47),
(85, 'Cao Bằng', 20),
(86, 'Cao Lãnh', 48),
(87, 'Cao Lãnh', 48),
(88, 'Cao Lộc', 28),
(89, 'Cao Phong', 49),
(90, 'Cát Hải', 4),
(91, 'Cát Tiên', 21),
(92, 'Cẩm Giàng', 35),
(93, 'Cẩm Khê', 50),
(94, 'Cẩm Lệ', 51),
(95, 'Cẩm Mỹ', 33),
(96, 'Cẩm Phả', 11),
(97, 'Cẩm Thủy', 17),
(98, 'Cẩm Xuyên', 46),
(99, 'Cần Đước', 32),
(100, 'Cần Giờ', 34),
(101, 'Cần Giuộc', 32),
(102, 'Cầu Giấy', 12),
(103, 'Cầu Kè', 47),
(104, 'Cầu Ngang', 47),
(105, 'Châu Đốc', 7),
(106, 'Châu Đức', 55),
(107, 'Châu Phú', 7),
(108, 'Châu Thành', 7),
(109, 'Châu Thành', 15),
(110, 'Châu Thành', 48),
(111, 'Châu Thành', 52),
(112, 'Châu Thành', 3),
(113, 'Châu Thành', 32),
(114, 'Châu Thành', 53),
(115, 'Châu Thành', 31),
(116, 'Châu Thành', 43),
(117, 'Châu Thành', 47),
(118, 'Châu Thành A', 52),
(119, 'Chi Lăng', 28),
(120, 'Chí Linh', 35),
(121, 'Chiêm Hóa', 54),
(122, 'Chợ Đồn', 10),
(123, 'Chợ Gạo', 43),
(124, 'Chợ Lách', 15),
(125, 'Chợ Mới', 10),
(126, 'Chợ Mới', 7),
(127, 'Chơn Thành', 36),
(128, 'Chư Păh', 5),
(129, 'Chư Prông', 5),
(130, 'Chư Pưh', 5),
(131, 'Chư Sê', 5),
(132, 'Chương Mỹ', 12),
(133, 'Con Cuông', 8),
(134, 'Cô Tô', 11),
(135, 'Côn Đảo', 55),
(136, 'Cồn Cỏ', 45),
(137, 'Cờ Đỏ', 39),
(138, 'Cù Lao Dung', 53),
(139, 'Củ Chi', 34),
(140, 'Cư Kuin', 41),
(141, 'Cư Jút', 56),
(142, 'Cửa Lò', 8),
(143, 'Dầu Tiếng', 23),
(144, 'Di Linh', 21),
(145, 'Dĩ An', 23),
(146, 'Diên Khánh', 44),
(147, 'Diễn Châu', 8),
(148, 'Duy Tiên', 37),
(149, 'Duy Xuyên', 29),
(150, 'Duyên Hải', 47),
(151, 'Duyên Hải', 47),
(152, 'Dương Kinh', 4),
(153, 'Dương Minh Châu', 31),
(154, 'Đa Krông', 45),
(155, 'Đà Bắc', 49),
(156, 'Đà Lạt', 21),
(157, 'Đạ Huoai', 21),
(158, 'Đạ Tẻh', 21),
(159, 'Đại Lộc', 29),
(160, 'Đại Từ', 57),
(161, 'Đắk Đoa', 5),
(162, 'Đak Pơ', 5),
(163, 'Đan Phượng', 12),
(164, 'Đắk Glei', 58),
(165, 'Đắk Glong', 56),
(166, 'Đắk Hà', 58),
(167, 'Đắk Mil', 56),
(168, 'Đăk Song', 56),
(169, 'Đăk Tô', 58),
(170, 'Đầm Dơi', 42),
(171, 'Đầm Hà', 11),
(172, 'Đam Rông', 21),
(173, 'Đất Đỏ', 55),
(174, 'Điện Bàn', 29),
(175, 'Điện Biên', 59),
(176, 'Điện Biên Đông', 59),
(177, 'Điện Biên Phủ', 59),
(178, 'Đình Lập', 28),
(179, 'Định Hóa', 57),
(180, 'Định Quán', 33),
(181, 'Đoan Hùng', 50),
(182, 'Đô Lương', 8),
(183, 'Đồ Sơn', 4),
(184, 'Đông Anh', 12),
(185, 'Đông Giang', 29),
(186, 'Đông Hà', 45),
(187, 'Đông Hải', 19),
(188, 'Đông Hòa', 60),
(189, 'Đông Hưng', 61),
(190, 'Đông Sơn', 17),
(191, 'Đông Triều', 11),
(192, 'Đồng Hới', 13),
(193, 'Đồng Hỷ', 57),
(194, 'Đồng Phú', 36),
(195, 'Đồng Văn', 26),
(196, 'Đồng Xoài', 36),
(197, 'Đồng Xuân', 60),
(198, 'Đống Đa', 12),
(199, 'Đơn Dương', 21),
(200, 'Đức Cơ', 5),
(201, 'Đức Hòa', 32),
(202, 'Đức Huệ', 32),
(203, 'Đức Linh', 24),
(204, 'Đức Phổ', 14),
(205, 'Đức Thọ', 46),
(206, 'Đức Trọng', 21),
(207, 'Ea Kar', 41),
(208, 'Ea Súp', 41),
(209, 'Gia Bình', 27),
(210, 'Gia Lâm', 12),
(211, 'Gia Lộc', 35),
(212, 'Gia Nghĩa', 56),
(213, 'Gia Viễn', 62),
(214, 'Giá Rai', 19),
(215, 'Giang Thành', 3),
(216, 'Giao Thủy', 63),
(217, 'Gio Linh', 45),
(218, 'Giồng Riềng', 3),
(219, 'Giồng Trôm', 15),
(220, 'Gò Công', 43),
(221, 'Gò Công Đông', 43),
(222, 'Gò Công Tây', 43),
(223, 'Gò Dầu', 31),
(224, 'Gò Quao', 3),
(225, 'Gò Vấp', 34),
(226, 'Hà Đông', 12),
(227, 'Hà Giang', 26),
(228, 'Hà Quảng', 20),
(229, 'Hà Tiên', 3),
(230, 'Hà Tĩnh', 46),
(231, 'Hà Trung', 17),
(232, 'Hạ Hòa', 50),
(233, 'Hạ Lang', 20),
(234, 'Hạ Long', 11),
(235, 'Hai Bà Trưng', 12),
(236, 'Hải An', 4),
(237, 'Hải Châu', 51),
(238, 'Hải Dương', 35),
(239, 'Hải Hà', 11),
(240, 'Hải Hậu', 63),
(241, 'Hải Lăng', 45),
(242, 'Hàm Tân', 24),
(243, 'Hàm Thuận Bắc', 24),
(244, 'Hàm Thuận Nam', 24),
(245, 'Hàm Yên', 54),
(246, 'Hậu Lộc', 17),
(247, 'Hiệp Đức', 29),
(248, 'Hiệp Hòa', 25),
(249, 'Hoa Lư', 62),
(250, 'Hòa An', 20),
(251, 'Hoà Bình', 19),
(252, 'Hoà Bình', 49),
(253, 'Hòa Thành', 31),
(254, 'Hòa Vang', 51),
(255, 'Hoài Ân', 6),
(256, 'Hoài Đức', 12),
(257, 'Hoài Nhơn', 6),
(258, 'Hoàn Kiếm', 12),
(259, 'Hoàng Mai', 12),
(260, 'Hoàng Mai', 8),
(261, 'Hoàng Sa', 51),
(262, 'Hoàng Su Phì', 26),
(263, 'Hoành Bồ', 11),
(264, 'Hoằng Hóa', 17),
(265, 'Hóc Môn', 34),
(266, 'Hòn Đất', 3),
(267, 'Hớn Quản', 36),
(268, 'Hội An', 29),
(269, 'Hồng Bàng', 4),
(270, 'Hồng Dân', 19),
(271, 'Hồng Lĩnh', 46),
(272, 'Hồng Ngự', 48),
(273, 'Hồng Ngự', 48),
(274, 'Huế', 64),
(275, 'Hưng Hà', 61),
(276, 'Hưng Nguyên', 8),
(277, 'Hưng Yên', 9),
(278, 'Hương Khê', 46),
(279, 'Hương Sơn', 46),
(280, 'Hương Thủy', 64),
(281, 'Hương Trà', 64),
(282, 'Hướng Hóa', 45),
(283, 'Hữu Lũng', 28),
(284, 'Ia Grai', 5),
(285, 'Ia Pa', 5),
(286, 'KBang', 5),
(287, 'Kế Sách', 53),
(288, 'Khánh Sơn', 44),
(289, 'Khánh Vĩnh', 44),
(290, 'Khoái Châu', 9),
(291, 'Kiên Hải', 3),
(292, 'Kiên Lương', 3),
(293, 'Kiến An', 4),
(294, 'Kiến Thụy', 4),
(295, 'Kiến Xương', 61),
(296, 'Kiến Tường', 32),
(297, 'Kim Bảng', 37),
(298, 'Kim Bôi', 49),
(299, 'Kim Động', 9),
(300, 'Kim Sơn', 62),
(301, 'Kim Thành', 35),
(302, 'Kinh Môn', 35),
(303, 'Kon Plông', 58),
(304, 'Kon Rẫy', 58),
(305, 'Kon Tum', 58),
(306, 'Kông Chro', 5),
(307, 'Krông Ana', 41),
(308, 'Krông Bông', 41),
(309, 'Krông Búk', 41),
(310, 'Krông Năng', 41),
(311, 'Krông Nô', 56),
(312, 'Krông Pa', 5),
(313, 'Krông Pắk', 41),
(314, 'Kỳ Anh', 46),
(315, 'Kỳ Anh', 46),
(316, 'Kỳ Sơn', 49),
(317, 'Kỳ Sơn', 8),
(318, 'La Gi', 24),
(319, 'Lạc Dương', 21),
(320, 'Lạc Sơn', 49),
(321, 'Lạc Thủy', 49),
(322, 'Lai Châu', 65),
(323, 'Lai Vung', 48),
(324, 'Lang Chánh', 17),
(325, 'Lạng Giang', 25),
(326, 'Lạng Sơn', 28),
(327, 'Lào Cai', 22),
(328, 'Lắk', 41),
(329, 'Lâm Bình', 54),
(330, 'Lâm Hà', 21),
(331, 'Lâm Thao', 50),
(332, 'Lấp Vò', 48),
(333, 'Lập Thạch', 40),
(334, 'Lê Chân', 4),
(335, 'Lệ Thủy', 13),
(336, 'Liên Chiểu', 51),
(337, 'Long Biên', 12),
(338, 'Long Điền', 55),
(339, 'Long Hồ', 38),
(340, 'Long Khánh', 33),
(341, 'Long Mỹ', 52),
(342, 'Long Mỹ', 52),
(343, 'Long Phú', 53),
(344, 'Long Thành', 33),
(345, 'Long Xuyên', 7),
(346, 'Lộc Bình', 28),
(347, 'Lộc Hà', 46),
(348, 'Lộc Ninh', 36),
(349, 'Lục Nam', 25),
(350, 'Lục Ngạn', 25),
(351, 'Lục Yên', 66),
(352, 'Lương Sơn', 49),
(353, 'Lương Tài', 27),
(354, 'Lý Nhân', 37),
(355, 'Lý Sơn', 14),
(356, 'Mai Châu', 49),
(357, 'Mai Sơn', 30),
(358, 'Mang Thít', 38),
(359, 'Mang Yang', 5),
(360, 'Mèo Vạc', 26),
(361, 'Mê Linh', 12),
(362, 'Minh Hóa', 13),
(363, 'Minh Long', 14),
(364, 'Mỏ Cày Bắc', 15),
(365, 'Mỏ Cày Nam', 15),
(366, 'Móng Cái', 11),
(367, 'Mộ Đức', 14),
(368, 'Mộc Châu', 30),
(369, 'Mộc Hóa', 32),
(370, 'Mù Căng Chải', 66),
(371, 'Mường Ảng', 59),
(372, 'Mường Chà', 59),
(373, 'Mường Khương', 22),
(374, 'Mường La', 30),
(375, 'Mường Lát', 17),
(376, 'Mường Lay', 59),
(377, 'Mường Nhé', 59),
(378, 'Mường Tè', 65),
(379, 'Mỹ Đức', 12),
(380, 'Mỹ Hào', 9),
(381, 'Mỹ Lộc', 63),
(382, 'Mỹ Tho', 43),
(383, 'Mỹ Tú', 53),
(384, 'Mỹ Xuyên', 53),
(385, 'Na Hang', 54),
(386, 'Na Rì', 10),
(387, 'Nam Đàn', 8),
(388, 'Nam Định', 63),
(389, 'Nam Đông', 64),
(390, 'Nam Giang', 29),
(391, 'Nam Sách', 35),
(392, 'Nam Trà My', 29),
(393, 'Nam Trực', 63),
(394, 'Nam Từ Liêm', 12),
(395, 'Năm Căn', 42),
(396, 'Nậm Pồ', 59),
(397, 'Nậm Nhùn', 65),
(398, 'Nga Sơn', 17),
(399, 'Ngã Bảy', 52),
(400, 'Ngã Năm', 53),
(401, 'Ngân Sơn', 10),
(402, 'Nghi Lộc', 8),
(403, 'Nghi Xuân', 46),
(404, 'Nghĩa Đàn', 8),
(405, 'Nghĩa Hành', 14),
(406, 'Nghĩa Hưng', 63),
(407, 'Nghĩa Lộ', 66),
(408, 'Ngọc Hiển', 42),
(409, 'Ngọc Hồi', 58),
(410, 'Ngọc Lặc', 17),
(411, 'Ngô Quyền', 4),
(412, 'Ngũ Hành Sơn', 51),
(413, 'Nguyên Bình', 20),
(414, 'Nha Trang', 44),
(415, 'Nhà Bè', 34),
(416, 'Nho Quan', 62),
(417, 'Nhơn Trạch', 33),
(418, 'Như Thanh', 17),
(419, 'Như Xuân', 17),
(420, 'Ninh Bình', 62),
(421, 'Ninh Giang', 35),
(422, 'Ninh Hải', 18),
(423, 'Ninh Hòa', 44),
(424, 'Ninh Kiều', 39),
(425, 'Ninh Phước', 18),
(426, 'Ninh Sơn', 18),
(427, 'Nông Cống', 17),
(428, 'Nông Sơn', 29),
(429, 'Núi Thành', 29),
(430, 'Ô Môn', 39),
(431, 'Pác Nặm', 10),
(432, 'Phan Rang-Tháp Chàm', 18),
(433, 'Phan Thiết', 24),
(434, 'Phong Điền', 2),
(435, 'Phong Điền', 39),
(436, 'Phong Thổ', 65),
(437, 'Phổ Yên', 57),
(438, 'Phú Bình', 57),
(439, 'Phú Giáo', 23),
(440, 'Phú Hòa', 60),
(441, 'Phú Lộc', 2),
(442, 'Phú Lương', 57),
(443, 'Phú Nhuận', 34),
(444, 'Phú Ninh', 29),
(445, 'Phú Quý', 24),
(446, 'Phú Quốc', 3),
(447, 'Phú Riềng', 36),
(448, 'Phú Tân', 7),
(449, 'Phú Tân', 42),
(450, 'Phú Thiện', 5),
(451, 'Phú Thọ', 50),
(452, 'Phú Vang', 2),
(453, 'Phú Xuyên', 12),
(454, 'Phù Cát', 6),
(455, 'Phù Cừ', 9),
(456, 'Phù Mỹ', 6),
(457, 'Phù Ninh', 50),
(458, 'Phù Yên', 30),
(459, 'Phủ Lý', 37),
(460, 'Phúc Thọ', 12),
(461, 'Phúc Yên', 40),
(462, 'Phục Hòa', 20),
(463, 'Phụng Hiệp', 52),
(464, 'Phước Long', 36),
(465, 'Phước Long', 19),
(466, 'Phước Sơn', 29),
(467, 'Pleiku', 5),
(468, 'Quan Hóa', 17),
(469, 'Quan Sơn', 17),
(470, 'Quản Bạ', 26),
(471, 'Quang Bình', 26),
(472, 'Quảng Điền', 2),
(473, 'Quảng Ngãi', 14),
(474, 'Quảng Ninh', 13),
(475, 'Quảng Trạch', 13),
(476, 'Quảng Trị', 45),
(477, 'Quảng Yên', 11),
(478, 'Quảng Uyên', 20),
(479, 'Quảng Xương', 17),
(480, 'Quận 1', 34),
(481, 'Quận 2', 34),
(482, 'Quận 3', 34),
(483, 'Quận 4', 34),
(484, 'Quận 5', 34),
(485, 'Quận 6', 34),
(486, 'Quận 7', 34),
(487, 'Quận 8', 34),
(488, 'Quận 9', 34),
(489, 'Quận 10', 34),
(490, 'Quận 11', 34),
(491, 'Quận 12', 34),
(492, 'Quế Phong', 8),
(493, 'Quế Sơn', 29),
(494, 'Quế Võ', 27),
(495, 'Quy Nhơn', 6),
(496, 'Quốc Oai', 12),
(497, 'Quỳ Châu', 8),
(498, 'Quỳ Hợp', 8),
(499, 'Quỳnh Lưu', 8),
(500, 'Quỳnh Nhai', 30),
(501, 'Quỳnh Phụ', 61),
(502, 'Rạch Giá', 3),
(503, 'Sa Đéc', 48),
(504, 'Sa Pa', 22),
(505, 'Sa Thầy', 58),
(506, 'Sầm Sơn', 17),
(507, 'Si Ma Cai', 22),
(508, 'Sìn Hồ', 65),
(509, 'Sóc Sơn', 12),
(510, 'Sóc Trăng', 53),
(511, 'Sông Cầu', 60),
(512, 'Sông Công', 57),
(513, 'Sông Hinh', 60),
(514, 'Sông Lô', 40),
(515, 'Sông Mã', 30),
(516, 'Sốp Cộp', 30),
(517, 'Sơn Động', 25),
(518, 'Sơn Dương', 54),
(519, 'Sơn Hà', 14),
(520, 'Sơn Hòa', 60),
(521, 'Sơn La', 30),
(522, 'Sơn Tây', 12),
(523, 'Sơn Tây', 14),
(524, 'Sơn Tịnh', 14),
(525, 'Sơn Trà', 51),
(526, 'Tam Bình', 38),
(527, 'Tam Dương', 40),
(528, 'Tam Đảo', 40),
(529, 'Tam Điệp', 62),
(530, 'Tam Đường', 65),
(531, 'Tam Kỳ', 29),
(532, 'Tam Nông', 48),
(533, 'Tam Nông', 50),
(534, 'Tánh Linh', 24),
(535, 'Tân An', 32),
(536, 'Tân Biên', 31),
(537, 'Tân Bình', 34),
(538, 'Tân Châu', 7),
(539, 'Tân Châu', 31),
(540, 'Tân Hiệp', 3),
(541, 'Tân Hồng', 48),
(542, 'Tân Hưng', 32),
(543, 'Tân Kỳ', 8),
(544, 'Tân Lạc', 49),
(545, 'Tân Phú', 33),
(546, 'Tân Phú', 34),
(547, 'Tân Phú Đông', 43),
(548, 'Tân Phước', 43),
(549, 'Tân Sơn', 50),
(550, 'Tân Thành', 55),
(551, 'Tân Thạnh', 32),
(552, 'Tân Trụ', 32),
(553, 'Tân Uyên', 23),
(554, 'Tân Uyên', 65),
(555, 'Tân Yên', 25),
(556, 'Tây Giang', 29),
(557, 'Tây Hòa', 60),
(558, 'Tây Hồ', 12),
(559, 'Tây Ninh', 31),
(560, 'Tây Sơn', 6),
(561, 'Tây Trà', 14),
(562, 'Thạch An', 20),
(563, 'Thạch Hà', 46),
(564, 'Thạch Thành', 17),
(565, 'Thạch Thất', 12),
(566, 'Thái Bình', 61),
(567, 'Thái Hòa', 8),
(568, 'Thái Nguyên', 57),
(569, 'Thái Thụy', 61),
(570, 'Than Uyên', 65),
(571, 'Thanh Ba', 50),
(572, 'Thanh Bình', 48),
(573, 'Thanh Chương', 8),
(574, 'Thanh Hà', 35),
(575, 'Thanh Hóa', 17),
(576, 'Thanh Khê', 51),
(577, 'Thanh Liêm', 37),
(578, 'Thanh Miện', 35),
(579, 'Thanh Oai', 12),
(580, 'Thanh Sơn', 50),
(581, 'Thanh Thủy', 50),
(582, 'Thanh Trì', 12),
(583, 'Thanh Xuân', 12),
(584, 'Thạnh Hóa', 32),
(585, 'Thạnh Phú', 15),
(586, 'Thạnh Trị', 53),
(587, 'Tháp Mười', 48),
(588, 'Thăng Bình', 29),
(589, 'Thiệu Hóa', 17),
(590, 'Thọ Xuân', 17),
(591, 'Thoại Sơn', 7),
(592, 'Thông Nông', 20),
(593, 'Thống Nhất', 33),
(594, 'Thốt Nốt', 39),
(595, 'Thới Bình', 42),
(596, 'Thới Lai', 39),
(597, 'Thủ Dầu Một', 23),
(598, 'Thủ Đức', 34),
(599, 'Thủ Thừa', 32),
(600, 'Thuận An', 23),
(601, 'Thuận Bắc', 18),
(602, 'Thuận Châu', 30),
(603, 'Thuận Nam', 18),
(604, 'Thuận Thành', 27),
(605, 'Thuỷ Nguyên', 4),
(606, 'Thường Tín', 12),
(607, 'Thường Xuân', 17),
(608, 'Tiên Du', 27),
(609, 'Tiền Hải', 61),
(610, 'Tiên Lãng', 4),
(611, 'Tiên Lữ', 9),
(612, 'Tiên Phước', 29),
(613, 'Tiên Yên', 11),
(614, 'Tiểu Cần', 47),
(615, 'Tĩnh Gia', 17),
(616, 'Tịnh Biên', 7),
(617, 'Trà Bồng', 14),
(618, 'Trà Cú', 47),
(619, 'Trà Lĩnh', 20),
(620, 'Trà Ôn', 38),
(621, 'Trà Vinh', 47),
(622, 'Trạm Tấu', 66),
(623, 'Tràng Định', 28),
(624, 'Trảng Bàng', 31),
(625, 'Trảng Bom', 33),
(626, 'Trấn Yên', 66),
(627, 'Trần Đề', 53),
(628, 'Trần Văn Thời', 42),
(629, 'Tri Tôn', 7),
(630, 'Triệu Phong', 45),
(631, 'Triệu Sơn', 17),
(632, 'Trùng Khánh', 20),
(633, 'Trực Ninh', 63),
(634, 'Trường Sa', 44),
(635, 'Tủa Chùa', 59),
(636, 'Tuần Giáo', 59),
(637, 'Tu Mơ Rông', 58),
(638, 'Tuy An', 60),
(639, 'Tuy Đức', 56),
(640, 'Tuy Hòa', 60),
(641, 'Tuy Phong', 24),
(642, 'Tuy Phước', 6),
(643, 'Tuyên Hóa', 13),
(644, 'Tuyên Quang', 54),
(645, 'Tư Nghĩa', 14),
(646, 'Tứ Kỳ', 35),
(647, 'Từ Sơn', 27),
(648, 'Tương Dương', 8),
(649, 'U Minh', 42),
(650, 'U Minh Thượng', 3),
(651, 'Uông Bí', 11),
(652, 'Ứng Hòa', 12),
(653, 'Vạn Ninh', 44),
(654, 'Văn Bàn', 22),
(655, 'Văn Chấn', 66),
(656, 'Văn Giang', 9),
(657, 'Vãn Lãng', 28),
(658, 'Văn Lâm', 9),
(659, 'Văn Quan', 28),
(660, 'Văn Yên', 66),
(661, 'Vân Canh', 6),
(662, 'Vân Đồn', 11),
(663, 'Vân Hồ', 30),
(664, 'Vị Thanh', 52),
(665, 'Vị Thủy', 52),
(666, 'Vị Xuyên', 26),
(667, 'Việt Trì', 50),
(668, 'Việt Yên', 25),
(669, 'Vinh', 8),
(670, 'Vĩnh Bảo', 4),
(671, 'Vĩnh Châu', 53),
(672, 'Vĩnh Cửu', 33),
(673, 'Vĩnh Hưng', 32),
(674, 'Vĩnh Linh', 45),
(675, 'Vĩnh Long', 38),
(676, 'Vĩnh Lộc', 17),
(677, 'Vĩnh Lợi', 19),
(678, 'Vĩnh Thạnh', 6),
(679, 'Vĩnh Thạnh', 39),
(680, 'Vĩnh Thuận', 3),
(681, 'Vĩnh Tường', 40),
(682, 'Vĩnh Yên', 40),
(683, 'Võ Nhai', 57),
(684, 'Vũ Quang', 46),
(685, 'Vũ Thư', 61),
(686, 'Vụ Bản', 63),
(687, 'Vũng Liêm', 38),
(688, 'Vũng Tàu', 55),
(689, 'Xín Mần', 26),
(690, 'Xuân Lộc', 33),
(691, 'Xuân Trường', 63),
(692, 'Xuyên Mộc', 55),
(693, 'Ý Yên', 63),
(694, 'Yên Bái', 66),
(695, 'Yên Bình', 66),
(696, 'Yên Châu', 30),
(697, 'Yên Dũng', 25),
(698, 'Yên Định', 17),
(699, 'Yên Khánh', 62),
(700, 'Yên Lạc', 40),
(701, 'Yên Lập', 50),
(702, 'Yên Minh', 26),
(703, 'Yên Mô', 62),
(704, 'Yên Mỹ', 9),
(705, 'Yên Phong', 27),
(706, 'Yên Sơn', 54),
(707, 'Yên Thành', 8),
(708, 'Yên Thế', 25),
(709, 'Yên Thủy', 49);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `ID` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `post_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`ID`, `title`, `slug`, `post_type`) VALUES
(1, 'Tuyển dụng', 'tuyen-dung', 'tin-tuc'),
(2, 'Khuyến mãi', 'khuyen-mai', 'tin-tuc'),
(3, 'Mạch in mới', 'mach-in-moi', 'tin-tuc');

-- --------------------------------------------------------

--
-- Table structure for table `thanh_pho`
--

CREATE TABLE `thanh_pho` (
  `ID` int(11) NOT NULL,
  `thanh_pho` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thanh_pho`
--

INSERT INTO `thanh_pho` (`ID`, `thanh_pho`) VALUES
(1, ''),
(2, 'Thừa Thiên-Huế'),
(3, 'Kiên Giang'),
(4, 'Hải Phòng'),
(5, 'Gia Lai'),
(6, 'Bình Định'),
(7, 'An Giang'),
(8, 'Nghệ An'),
(9, 'Hưng Yên'),
(10, 'Bắc Kạn'),
(11, 'Quảng Ninh'),
(12, 'Hà Nội'),
(13, 'Quảng Bình'),
(14, 'Quảng Ngãi'),
(15, 'Bến Tre'),
(17, 'Thanh Hóa'),
(18, 'Ninh Thuận'),
(19, 'Bạc Liêu'),
(20, 'Cao Bằng'),
(21, 'Lâm Đồng'),
(22, 'Lào Cai'),
(23, 'Bình Dương'),
(24, 'Bình Thuận'),
(25, 'Bắc Giang'),
(26, 'Hà Giang'),
(27, 'Bắc Ninh'),
(28, 'Lạng Sơn'),
(29, 'Quảng Nam'),
(30, 'Sơn La'),
(31, 'Tây Ninh'),
(32, 'Long An'),
(33, 'Đồng Nai'),
(34, 'Hồ Chí Minh'),
(35, 'Hải Dương'),
(36, 'Bình Phước'),
(37, 'Hà Nam'),
(38, 'Vĩnh Long'),
(39, 'Cần Thơ'),
(40, 'Vĩnh Phúc'),
(41, 'Đắk Lắk'),
(42, 'Cà Mau'),
(43, 'Tiền Giang'),
(44, 'Khánh Hòa'),
(45, 'Quảng Trị'),
(46, 'Hà Tĩnh'),
(47, 'Trà Vinh'),
(48, 'Đồng Tháp'),
(49, 'Hoà Bình'),
(50, 'Phú Thọ'),
(51, 'Đà Nẵng'),
(52, 'Hậu Giang'),
(53, 'Sóc Trăng'),
(54, 'Tuyên Quang'),
(55, 'Bà Rịa - Vũng Tàu'),
(56, 'Đắk Nông'),
(57, 'Thái Nguyên'),
(58, 'Kon Tum'),
(59, 'Điện Biên'),
(60, 'Phú Yên'),
(61, 'Thái Bình'),
(62, 'Ninh Bình'),
(63, 'Nam Định'),
(64, 'Thừa Thiên - Huế'),
(65, 'Lai Châu'),
(66, 'Yên Bái');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `display_name` text NOT NULL,
  `birth_date` text NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `avatar` text NOT NULL,
  `sex` varchar(5) NOT NULL,
  `role` varchar(12) NOT NULL,
  `fb_id` text NOT NULL,
  `token_pass` text NOT NULL,
  `token_reset` text NOT NULL,
  `reset_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `display_name`, `birth_date`, `email`, `phone`, `address`, `avatar`, `sex`, `role`, `fb_id`, `token_pass`, `token_reset`, `reset_time`) VALUES
(11, 'niku98', '1fca79394ed22df30d74fe78c0f814fe05fce88a', 'Niku', '09/27/2017', 'sentodniku98@yahoo.com', '', '', '/images/avatar/e5LBshdT5pVL.png', 'Nam', 'admin', '', 'Bk7795OrP5fr', '', ''),
(15, 'pham-van-manh', '6ee84d4b2e95400eecec1502f7a5b401c4c03fbd', 'Phạm Văn Mạnh', '', 'phammanh.1221998@gmail.com', '', '', '', 'Nam', '', '1127443614055135', 'vncqYc8dF4G5', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `post_terms`
--
ALTER TABLE `post_terms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `print_curcuit`
--
ALTER TABLE `print_curcuit`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `print_curcuit_properties`
--
ALTER TABLE `print_curcuit_properties`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `property_chose_value`
--
ALTER TABLE `property_chose_value`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `quan_huyen`
--
ALTER TABLE `quan_huyen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `thanh_pho`
--
ALTER TABLE `thanh_pho`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `post_terms`
--
ALTER TABLE `post_terms`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `print_curcuit`
--
ALTER TABLE `print_curcuit`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `print_curcuit_properties`
--
ALTER TABLE `print_curcuit_properties`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `property_chose_value`
--
ALTER TABLE `property_chose_value`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `quan_huyen`
--
ALTER TABLE `quan_huyen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=710;
--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `thanh_pho`
--
ALTER TABLE `thanh_pho`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
