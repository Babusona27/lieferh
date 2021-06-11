-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2021 at 04:46 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lieferh`
--

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_address_book`
--

CREATE TABLE `lieferh_address_book` (
  `address_book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flat_no` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `entry_street_address` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_postcode` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `entry_city` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `entry_state` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_country_id` int(11) NOT NULL DEFAULT 0,
  `entry_latitude` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_longitude` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lieferh_address_book`
--

INSERT INTO `lieferh_address_book` (`address_book_id`, `user_id`, `flat_no`, `area`, `entry_street_address`, `entry_postcode`, `entry_city`, `entry_state`, `entry_country_id`, `entry_latitude`, `entry_longitude`) VALUES
(6, 10, '543', 'kol', 'AJC', '700084', '', NULL, 99, NULL, NULL),
(7, 10, '45', 'Kolkata', 'xyz', '700084', '', NULL, 99, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_client_details`
--

CREATE TABLE `lieferh_client_details` (
  `client_details_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `company_name` varchar(129) DEFAULT NULL,
  `alt_adddress` varchar(255) DEFAULT NULL,
  `alt_city` varchar(129) DEFAULT NULL,
  `alt_pincode` varchar(129) DEFAULT NULL,
  `alt_latitude` varchar(129) DEFAULT NULL,
  `alt_longitude` varchar(129) DEFAULT NULL,
  `alt_mobile` varchar(129) DEFAULT NULL,
  `best_time_to_contact` time DEFAULT NULL,
  `regi_no` varchar(129) DEFAULT NULL,
  `vat_no` varchar(129) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lieferh_client_details`
--

INSERT INTO `lieferh_client_details` (`client_details_id`, `client_id`, `company_name`, `alt_adddress`, `alt_city`, `alt_pincode`, `alt_latitude`, `alt_longitude`, `alt_mobile`, `best_time_to_contact`, `regi_no`, `vat_no`) VALUES
(1, 28, 'Xyz Pvt. Ltd.', '231 Crown Street, Brooklyn, NY, USA', 'San Diego', '11225', '40.66666290000001', '-73.9521948', '000000000', '11:14:00', 'JKDSFGDF0887676', 'JDDGGD76545'),
(2, 29, 'Xyz Company', '12830 Columbia Way, Downey, CA, USA', 'Downey', '90242', '33.91475140000001', '-118.1325341', '11:50', NULL, 'GFGDFFD98765', 'JHGSDFG8765');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_content_pages`
--

CREATE TABLE `lieferh_content_pages` (
  `id` int(11) NOT NULL,
  `page_name` text DEFAULT NULL,
  `page_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lieferh_content_pages`
--

INSERT INTO `lieferh_content_pages` (`id`, `page_name`, `page_text`) VALUES
(1, 'terms_of_use', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s,</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s <strong><em>standard dummy text ever since the 1500s,</em></strong></p>'),
(2, 'help', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s,</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s <strong><em>standard dummy text ever since the 1500s,</em></strong></p>'),
(3, 'privacy_policy', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s,</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s <strong><em>standard dummy text ever since the 1500s,</em></strong></p>');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_customers`
--

CREATE TABLE `lieferh_customers` (
  `customers_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `customers_email` varchar(255) NOT NULL,
  `customers_phone` varchar(255) DEFAULT NULL,
  `city` varchar(129) DEFAULT NULL,
  `pincode` varchar(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` varchar(129) DEFAULT NULL,
  `longitude` varchar(129) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lieferh_customers`
--

INSERT INTO `lieferh_customers` (`customers_id`, `client_id`, `name`, `customers_email`, `customers_phone`, `city`, `pincode`, `address`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(2, 16, 'Customer 2', 'customer2@gmail.com', '2147483647', 'Kolkata', '700019', 'Ballygunge Station Road, Dhakuria, Kankulia, Gariahat, Kolkata, West Bengal, India', '22.5166221', '88.3709598', '2021-03-17 09:19:29', '2021-03-25 02:07:24'),
(3, 0, 'Customer 1', 'customer123@gmail.com', '2147483647', 'Kolkata', '700052', 'Park Street, Mullick Bazar, Beniapukur, Kolkata, West Bengal, India', '22.547349', '88.35990989999999', '2021-03-23 08:00:28', '2021-03-25 02:13:38'),
(4, 0, 'Test user', 'testuser@gmail.com', '2147483647', 'Kolkata', '700055', 'Gariahat Road, Dhakuria, Babu Bagan, South End Park, Jodhpur Park, Kolkata, West Bengal, India', '22.5086851', '88.36731240000002', '2021-03-24 05:52:15', '2021-03-25 02:12:56'),
(5, 0, 'Customer 3', 'customer3@gmail.com', '2147483647', 'Kolkata', '700033', 'Tollygunge Bangur High School (H.S.), Golf Club Road, Rajendra Prasad Colony, Tollygunge, Kolkata, West Bengal, India', '22.497763', '88.3464842', '2021-03-25 02:08:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_customer_notification`
--

CREATE TABLE `lieferh_customer_notification` (
  `id` int(11) NOT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `date_and_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lieferh_customer_notification`
--

INSERT INTO `lieferh_customer_notification` (`id`, `customers_id`, `order_id`, `type`, `status`, `text`, `date_and_time`) VALUES
(87, 10, 1, 'order', 1, 'Your order is in pending status. ', '2021-01-25 05:15:51'),
(88, 10, 2, 'order', 1, 'Your order is in pending status. ', '2021-01-25 05:17:22'),
(89, 10, 3, 'order', 1, 'Your order is in pending status. ', '2021-01-25 05:19:18'),
(90, 10, 4, 'order', 1, 'Your order is in pending status. ', '2021-01-25 07:00:09'),
(91, 10, 5, 'order', 1, 'Your order is in pending status. ', '2021-01-25 07:02:57'),
(92, 10, 6, 'order', 1, 'Your order is in pending status. ', '2021-01-27 11:13:56'),
(93, 10, 7, 'order', 1, 'Your order is in pending status. ', '2021-01-30 02:24:40'),
(94, 10, 8, 'order', 1, 'Your order is in pending status. ', '2021-01-30 02:34:51'),
(95, 10, 9, 'order', 1, 'Your order is in pending status. ', '2021-01-30 02:36:03'),
(96, 10, 10, 'order', 1, 'Your order is in pending status. ', '2021-02-01 06:13:47'),
(97, 10, 11, 'order', 1, 'Your order is in pending status. ', '2021-02-01 06:32:04'),
(98, 10, 12, 'order', 1, 'Your order is in pending status. ', '2021-02-01 06:33:40'),
(99, 10, 13, 'order', 1, 'Your order is in pending status. ', '2021-02-01 06:35:28'),
(100, 10, 14, 'order', 1, 'Your order is in pending status. ', '2021-02-01 07:50:55'),
(101, 10, 15, 'order', 1, 'Your order is in pending status. ', '2021-02-01 08:45:41'),
(102, 10, 16, 'order', 1, 'Your order is in pending status. ', '2021-02-01 09:07:55'),
(103, 10, 17, 'order', 1, 'Your order is in pending status. ', '2021-02-01 10:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_driver_details`
--

CREATE TABLE `lieferh_driver_details` (
  `driver_details_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `proprietor` varchar(129) DEFAULT NULL,
  `company_name` varchar(129) DEFAULT NULL,
  `address_proof` varchar(255) DEFAULT NULL,
  `regi_no` varchar(129) DEFAULT NULL,
  `vat_no` varchar(129) DEFAULT NULL,
  `whatsapp` varchar(129) DEFAULT NULL,
  `vehicle_type` varchar(129) DEFAULT NULL,
  `bank` varchar(129) DEFAULT NULL,
  `iban` varchar(129) DEFAULT NULL,
  `swift` varchar(129) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lieferh_driver_details`
--

INSERT INTO `lieferh_driver_details` (`driver_details_id`, `driver_id`, `proprietor`, `company_name`, `address_proof`, `regi_no`, `vat_no`, `whatsapp`, `vehicle_type`, `bank`, `iban`, `swift`) VALUES
(1, 31, 'Other', 'Abc Pvt.Ltd.', '/home/dipanbarun15/public_html/developer/lieferh/public/uploads/1617886516blank-avatar.jpg', 'JHVGDSF765', 'JHVF555', '6545225445', 'TWO whiller', 'Dyguyg', 'hgyugf876', 'iohhfdd65');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_failed_jobs`
--

CREATE TABLE `lieferh_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_feedback`
--

CREATE TABLE `lieferh_feedback` (
  `id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `drivers_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lieferh_feedback`
--

INSERT INTO `lieferh_feedback` (`id`, `customers_id`, `drivers_id`, `feedback`, `created_at`) VALUES
(1, 1, 14, 'Beware of the dog', '2021-03-19 17:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_images`
--

CREATE TABLE `lieferh_images` (
  `images_id` bigint(20) UNSIGNED NOT NULL,
  `images_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lieferh_images`
--

INSERT INTO `lieferh_images` (`images_id`, `images_name`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(10, 'Z63x002811.jpg', 1, NULL, NULL, NULL),
(13, '6HX1C02712.jpg', 1, NULL, NULL, NULL),
(14, 'rj6Km21901.jpg', 1, NULL, NULL, NULL),
(15, 'oGmfI21201.jpg', 1, NULL, NULL, NULL),
(16, 'O8mm521601.jpg', 1, NULL, NULL, NULL),
(17, 'hHH0r21901.jpg', 1, NULL, NULL, NULL),
(18, 'C5WAO21601.jpg', 1, NULL, NULL, NULL),
(19, 'lNVeJ21801.jpg', 1, NULL, NULL, NULL),
(20, 'nti2g21201.jpg', 1, NULL, NULL, NULL),
(21, 'BUNgQ21601.jpg', 1, NULL, NULL, NULL),
(22, 'OWbDS21901.jpg', 1, NULL, NULL, NULL),
(23, 'Pnzxs21101.jpg', 1, NULL, NULL, NULL),
(24, 'TxUST21801.jpg', 1, NULL, NULL, NULL),
(25, 'otFak25508.jpg', 1, NULL, NULL, NULL),
(26, 'hnh6t25108.jpg', 1, NULL, NULL, NULL),
(27, 's7CKV25208.jpg', 1, NULL, NULL, NULL),
(28, 'PYLPq25408.jpg', 1, NULL, NULL, NULL),
(29, 'bhZl125508.jpg', 1, NULL, NULL, NULL),
(30, 'LCS5s25108.jpg', 1, NULL, NULL, NULL),
(31, 'pc2RR25508.jpg', 1, NULL, NULL, NULL),
(32, 'd76jr25308.jpg', 1, NULL, NULL, NULL),
(33, 'Ek53O25408.jpg', 1, NULL, NULL, NULL),
(34, 'UPvkU25108.jpg', 1, NULL, NULL, NULL),
(35, 'IyqCP25308.jpg', 1, NULL, NULL, NULL),
(36, '8ZmMn25508.jpg', 1, NULL, NULL, NULL),
(37, 'Ejgkc25608.jpg', 1, NULL, NULL, NULL),
(38, '2Xu0E25708.jpg', 1, NULL, NULL, NULL),
(39, 'Fm2uz25408.jpg', 1, NULL, NULL, NULL),
(40, 'XgvB725108.jpg', 1, NULL, NULL, NULL),
(41, '6QRR725708.jpg', 1, NULL, NULL, NULL),
(42, 'q86Ha25908.jpg', 1, NULL, NULL, NULL),
(43, 'uSM1i25708.jpg', 1, NULL, NULL, NULL),
(44, 'xrvC725908.jpg', 1, NULL, NULL, NULL),
(45, 'x5ym225308.jpg', 1, NULL, NULL, NULL),
(46, '2Afvh25908.jpg', 1, NULL, NULL, NULL),
(47, 'U5VGd25308.jpg', 1, NULL, NULL, NULL),
(48, 'iECdQ25708.jpg', 1, NULL, NULL, NULL),
(49, 'w7zsY25608.jpg', 1, NULL, NULL, NULL),
(50, 'NfKw125408.jpg', 1, NULL, NULL, NULL),
(51, 'b6PnG25308.jpg', 1, NULL, NULL, NULL),
(52, 'bGNi425808.jpg', 1, NULL, NULL, NULL),
(53, 'DVuD225208.jpg', 1, NULL, NULL, NULL),
(54, 'fEh0625808.jpg', 1, NULL, NULL, NULL),
(55, '3xHig25908.jpg', 1, NULL, NULL, NULL),
(56, 'YyRf025908.jpg', 1, NULL, NULL, NULL),
(57, 'EaOCJ25608.jpg', 1, NULL, NULL, NULL),
(58, 'Epglz25108.jpg', 1, NULL, NULL, NULL),
(59, 'fJpI725308.jpg', 1, NULL, NULL, NULL),
(60, 'yVSiG25108.jpg', 1, NULL, NULL, NULL),
(61, 'W7A4r25308.jpg', 1, NULL, NULL, NULL),
(62, 'eyoui25308.jpg', 1, NULL, NULL, NULL),
(63, 'hbTZL25708.jpg', 1, NULL, NULL, NULL),
(64, 'qPSLv25808.jpg', 1, NULL, NULL, NULL),
(65, 'K2BIA25908.jpg', 1, NULL, NULL, NULL),
(66, 'HTzs725808.jpg', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_image_categories`
--

CREATE TABLE `lieferh_image_categories` (
  `image_categories_id` bigint(20) UNSIGNED NOT NULL,
  `images_id` int(11) NOT NULL,
  `images_type` enum('ACTUAL','THUMBNAIL','LARGE','MEDIUM') COLLATE utf8mb4_unicode_ci NOT NULL,
  `images_height` int(11) DEFAULT NULL,
  `images_width` int(11) DEFAULT NULL,
  `images_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lieferh_image_categories`
--

INSERT INTO `lieferh_image_categories` (`image_categories_id`, `images_id`, `images_type`, `images_height`, `images_width`, `images_path`, `created_at`, `updated_at`) VALUES
(16, 10, 'ACTUAL', 1500, 1500, 'images/media/2021/01/Z63x002811.jpg', NULL, NULL),
(17, 10, 'THUMBNAIL', 150, 150, 'images/media/2021/01/thumbnail1609586617Z63x002811.jpg', NULL, '2021-01-02 13:14:28'),
(18, 10, 'MEDIUM', 400, 400, 'images/media/2021/01/medium1609586617Z63x002811.jpg', NULL, '2021-01-02 13:14:28'),
(19, 10, 'LARGE', 900, 900, 'images/media/2021/01/large1609586618Z63x002811.jpg', NULL, '2021-01-02 13:14:28'),
(27, 13, 'ACTUAL', 400, 400, 'images/media/2021/01/6HX1C02712.jpg', NULL, NULL),
(28, 13, 'THUMBNAIL', 150, 150, 'images/media/2021/01/thumbnail16095922176HX1C02712.jpg', NULL, '2021-01-02 13:14:28'),
(29, 13, 'MEDIUM', 400, 400, 'images/media/2021/01/medium16095922176HX1C02712.jpg', NULL, '2021-01-02 13:14:28'),
(30, 14, 'ACTUAL', 1104, 1199, 'images/media/2021/01/rj6Km21901.jpg', NULL, NULL),
(31, 14, 'THUMBNAIL', 138, 150, 'images/media/2021/01/thumbnail1611237114rj6Km21901.jpg', NULL, '2021-01-21 13:51:54'),
(32, 14, 'MEDIUM', 368, 400, 'images/media/2021/01/medium1611237114rj6Km21901.jpg', NULL, '2021-01-21 13:51:54'),
(33, 14, 'LARGE', 829, 900, 'images/media/2021/01/large1611237114rj6Km21901.jpg', NULL, '2021-01-21 13:51:54'),
(34, 15, 'ACTUAL', 417, 626, 'images/media/2021/01/oGmfI21201.jpg', NULL, NULL),
(35, 15, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611237135oGmfI21201.jpg', NULL, '2021-01-21 13:52:15'),
(36, 15, 'MEDIUM', 266, 400, 'images/media/2021/01/medium1611237135oGmfI21201.jpg', NULL, '2021-01-21 13:52:15'),
(37, 16, 'ACTUAL', 800, 1540, 'images/media/2021/01/O8mm521601.jpg', NULL, NULL),
(38, 16, 'THUMBNAIL', 78, 150, 'images/media/2021/01/thumbnail1611237135O8mm521601.jpg', NULL, '2021-01-21 13:52:15'),
(39, 16, 'MEDIUM', 208, 400, 'images/media/2021/01/medium1611237135O8mm521601.jpg', NULL, '2021-01-21 13:52:15'),
(40, 16, 'LARGE', 468, 900, 'images/media/2021/01/large1611237135O8mm521601.jpg', NULL, '2021-01-21 13:52:15'),
(41, 17, 'ACTUAL', 950, 1500, 'images/media/2021/01/hHH0r21901.jpg', NULL, NULL),
(42, 17, 'THUMBNAIL', 95, 150, 'images/media/2021/01/thumbnail1611237136hHH0r21901.jpg', NULL, '2021-01-21 13:52:16'),
(43, 18, 'ACTUAL', 800, 1200, 'images/media/2021/01/C5WAO21601.jpg', NULL, NULL),
(44, 17, 'MEDIUM', 253, 400, 'images/media/2021/01/medium1611237136hHH0r21901.jpg', NULL, '2021-01-21 13:52:16'),
(45, 18, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611237136C5WAO21601.jpg', NULL, '2021-01-21 13:52:16'),
(46, 18, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611237136C5WAO21601.jpg', NULL, '2021-01-21 13:52:16'),
(47, 17, 'LARGE', 570, 900, 'images/media/2021/01/large1611237136hHH0r21901.jpg', NULL, '2021-01-21 13:52:16'),
(48, 18, 'LARGE', 600, 900, 'images/media/2021/01/large1611237136C5WAO21601.jpg', NULL, '2021-01-21 13:52:16'),
(49, 19, 'ACTUAL', 720, 1080, 'images/media/2021/01/lNVeJ21801.jpg', NULL, NULL),
(50, 19, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611237137lNVeJ21801.jpg', NULL, '2021-01-21 13:52:17'),
(51, 20, 'ACTUAL', 350, 800, 'images/media/2021/01/nti2g21201.jpg', NULL, NULL),
(52, 20, 'THUMBNAIL', 66, 150, 'images/media/2021/01/thumbnail1611237137nti2g21201.jpg', NULL, '2021-01-21 13:52:17'),
(53, 20, 'MEDIUM', 175, 400, 'images/media/2021/01/medium1611237137nti2g21201.jpg', NULL, '2021-01-21 13:52:17'),
(54, 19, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611237137lNVeJ21801.jpg', NULL, '2021-01-21 13:52:17'),
(55, 19, 'LARGE', 600, 900, 'images/media/2021/01/large1611237137lNVeJ21801.jpg', NULL, '2021-01-21 13:52:17'),
(56, 21, 'ACTUAL', 932, 1280, 'images/media/2021/01/BUNgQ21601.jpg', NULL, NULL),
(57, 22, 'ACTUAL', 400, 400, 'images/media/2021/01/OWbDS21901.jpg', NULL, NULL),
(58, 21, 'THUMBNAIL', 109, 150, 'images/media/2021/01/thumbnail1611237137BUNgQ21601.jpg', NULL, '2021-01-21 13:52:17'),
(59, 22, 'THUMBNAIL', 150, 150, 'images/media/2021/01/thumbnail1611237137OWbDS21901.jpg', NULL, '2021-01-21 13:52:17'),
(60, 22, 'MEDIUM', 400, 400, 'images/media/2021/01/medium1611237137OWbDS21901.jpg', NULL, '2021-01-21 13:52:17'),
(61, 21, 'MEDIUM', 291, 400, 'images/media/2021/01/medium1611237137BUNgQ21601.jpg', NULL, '2021-01-21 13:52:17'),
(62, 21, 'LARGE', 655, 900, 'images/media/2021/01/large1611237138BUNgQ21601.jpg', NULL, '2021-01-21 13:52:18'),
(63, 23, 'ACTUAL', 368, 491, 'images/media/2021/01/Pnzxs21101.jpg', NULL, NULL),
(64, 23, 'THUMBNAIL', 112, 150, 'images/media/2021/01/thumbnail1611237138Pnzxs21101.jpg', NULL, '2021-01-21 13:52:18'),
(65, 23, 'MEDIUM', 300, 400, 'images/media/2021/01/medium1611237138Pnzxs21101.jpg', NULL, '2021-01-21 13:52:18'),
(66, 24, 'ACTUAL', 533, 800, 'images/media/2021/01/TxUST21801.jpg', NULL, NULL),
(67, 24, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611237138TxUST21801.jpg', NULL, '2021-01-21 13:52:18'),
(68, 24, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611237138TxUST21801.jpg', NULL, '2021-01-21 13:52:18'),
(69, 25, 'ACTUAL', 240, 490, 'images/media/2021/01/otFak25508.jpg', NULL, NULL),
(70, 25, 'THUMBNAIL', 73, 150, 'images/media/2021/01/thumbnail1611605321otFak25508.jpg', NULL, '2021-01-25 20:08:41'),
(71, 25, 'MEDIUM', 196, 400, 'images/media/2021/01/medium1611605321otFak25508.jpg', NULL, '2021-01-25 20:08:41'),
(72, 26, 'ACTUAL', 240, 360, 'images/media/2021/01/hnh6t25108.jpg', NULL, NULL),
(73, 26, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611605329hnh6t25108.jpg', NULL, '2021-01-25 20:08:49'),
(74, 27, 'ACTUAL', 360, 988, 'images/media/2021/01/s7CKV25208.jpg', NULL, NULL),
(75, 27, 'THUMBNAIL', 55, 150, 'images/media/2021/01/thumbnail1611605334s7CKV25208.jpg', NULL, '2021-01-25 20:08:54'),
(76, 27, 'MEDIUM', 146, 400, 'images/media/2021/01/medium1611605334s7CKV25208.jpg', NULL, '2021-01-25 20:08:54'),
(77, 27, 'LARGE', 328, 900, 'images/media/2021/01/large1611605334s7CKV25208.jpg', NULL, '2021-01-25 20:08:54'),
(78, 28, 'ACTUAL', 360, 833, 'images/media/2021/01/PYLPq25408.jpg', NULL, NULL),
(79, 28, 'THUMBNAIL', 65, 150, 'images/media/2021/01/thumbnail1611605344PYLPq25408.jpg', NULL, '2021-01-25 20:09:04'),
(80, 28, 'MEDIUM', 173, 400, 'images/media/2021/01/medium1611605344PYLPq25408.jpg', NULL, '2021-01-25 20:09:04'),
(81, 29, 'ACTUAL', 360, 1045, 'images/media/2021/01/bhZl125508.jpg', NULL, NULL),
(82, 29, 'THUMBNAIL', 52, 150, 'images/media/2021/01/thumbnail1611605355bhZl125508.jpg', NULL, '2021-01-25 20:09:15'),
(83, 29, 'MEDIUM', 138, 400, 'images/media/2021/01/medium1611605355bhZl125508.jpg', NULL, '2021-01-25 20:09:15'),
(84, 29, 'LARGE', 310, 900, 'images/media/2021/01/large1611605355bhZl125508.jpg', NULL, '2021-01-25 20:09:15'),
(85, 30, 'ACTUAL', 360, 640, 'images/media/2021/01/LCS5s25108.jpg', NULL, NULL),
(86, 30, 'THUMBNAIL', 84, 150, 'images/media/2021/01/thumbnail1611605365LCS5s25108.jpg', NULL, '2021-01-25 20:09:25'),
(87, 30, 'MEDIUM', 225, 400, 'images/media/2021/01/medium1611605365LCS5s25108.jpg', NULL, '2021-01-25 20:09:25'),
(88, 31, 'ACTUAL', 360, 965, 'images/media/2021/01/pc2RR25508.jpg', NULL, NULL),
(89, 31, 'THUMBNAIL', 56, 150, 'images/media/2021/01/thumbnail1611605376pc2RR25508.jpg', NULL, '2021-01-25 20:09:36'),
(90, 31, 'MEDIUM', 149, 400, 'images/media/2021/01/medium1611605376pc2RR25508.jpg', NULL, '2021-01-25 20:09:36'),
(91, 31, 'LARGE', 336, 900, 'images/media/2021/01/large1611605376pc2RR25508.jpg', NULL, '2021-01-25 20:09:36'),
(92, 32, 'ACTUAL', 360, 1446, 'images/media/2021/01/d76jr25308.jpg', NULL, NULL),
(93, 32, 'THUMBNAIL', 37, 150, 'images/media/2021/01/thumbnail1611605383d76jr25308.jpg', NULL, '2021-01-25 20:09:43'),
(94, 32, 'MEDIUM', 100, 400, 'images/media/2021/01/medium1611605383d76jr25308.jpg', NULL, '2021-01-25 20:09:43'),
(95, 32, 'LARGE', 224, 900, 'images/media/2021/01/large1611605383d76jr25308.jpg', NULL, '2021-01-25 20:09:43'),
(96, 33, 'ACTUAL', 360, 480, 'images/media/2021/01/Ek53O25408.jpg', NULL, NULL),
(97, 33, 'THUMBNAIL', 113, 150, 'images/media/2021/01/thumbnail1611605425Ek53O25408.jpg', NULL, '2021-01-25 20:10:25'),
(98, 33, 'MEDIUM', 300, 400, 'images/media/2021/01/medium1611605425Ek53O25408.jpg', NULL, '2021-01-25 20:10:25'),
(99, 34, 'ACTUAL', 360, 540, 'images/media/2021/01/UPvkU25108.jpg', NULL, NULL),
(100, 34, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611605958UPvkU25108.jpg', NULL, '2021-01-25 20:19:18'),
(101, 34, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611605958UPvkU25108.jpg', NULL, '2021-01-25 20:19:18'),
(102, 35, 'ACTUAL', 240, 360, 'images/media/2021/01/IyqCP25308.jpg', NULL, NULL),
(103, 35, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611605992IyqCP25308.jpg', NULL, '2021-01-25 20:19:52'),
(104, 36, 'ACTUAL', 240, 360, 'images/media/2021/01/8ZmMn25508.jpg', NULL, NULL),
(105, 36, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail16116059968ZmMn25508.jpg', NULL, '2021-01-25 20:19:56'),
(106, 37, 'ACTUAL', 240, 360, 'images/media/2021/01/Ejgkc25608.jpg', NULL, NULL),
(107, 37, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606004Ejgkc25608.jpg', NULL, '2021-01-25 20:20:04'),
(108, 38, 'ACTUAL', 240, 361, 'images/media/2021/01/2Xu0E25708.jpg', NULL, NULL),
(109, 38, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail16116060072Xu0E25708.jpg', NULL, '2021-01-25 20:20:07'),
(110, 39, 'ACTUAL', 240, 360, 'images/media/2021/01/Fm2uz25408.jpg', NULL, NULL),
(111, 39, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606014Fm2uz25408.jpg', NULL, '2021-01-25 20:20:14'),
(112, 40, 'ACTUAL', 360, 540, 'images/media/2021/01/XgvB725108.jpg', NULL, NULL),
(113, 40, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606024XgvB725108.jpg', NULL, '2021-01-25 20:20:24'),
(114, 40, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606024XgvB725108.jpg', NULL, '2021-01-25 20:20:24'),
(115, 41, 'ACTUAL', 360, 640, 'images/media/2021/01/6QRR725708.jpg', NULL, NULL),
(116, 41, 'THUMBNAIL', 84, 150, 'images/media/2021/01/thumbnail16116060376QRR725708.jpg', NULL, '2021-01-25 20:20:37'),
(117, 41, 'MEDIUM', 225, 400, 'images/media/2021/01/medium16116060376QRR725708.jpg', NULL, '2021-01-25 20:20:37'),
(118, 42, 'ACTUAL', 360, 540, 'images/media/2021/01/q86Ha25908.jpg', NULL, NULL),
(119, 42, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606066q86Ha25908.jpg', NULL, '2021-01-25 20:21:06'),
(120, 42, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606066q86Ha25908.jpg', NULL, '2021-01-25 20:21:06'),
(121, 43, 'ACTUAL', 360, 539, 'images/media/2021/01/uSM1i25708.jpg', NULL, NULL),
(122, 43, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606076uSM1i25708.jpg', NULL, '2021-01-25 20:21:16'),
(123, 43, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606076uSM1i25708.jpg', NULL, '2021-01-25 20:21:16'),
(124, 44, 'ACTUAL', 360, 1080, 'images/media/2021/01/xrvC725908.jpg', NULL, NULL),
(125, 44, 'THUMBNAIL', 50, 150, 'images/media/2021/01/thumbnail1611606128xrvC725908.jpg', NULL, '2021-01-25 20:22:08'),
(126, 44, 'MEDIUM', 133, 400, 'images/media/2021/01/medium1611606128xrvC725908.jpg', NULL, '2021-01-25 20:22:08'),
(127, 44, 'LARGE', 300, 900, 'images/media/2021/01/large1611606128xrvC725908.jpg', NULL, '2021-01-25 20:22:08'),
(128, 45, 'ACTUAL', 360, 540, 'images/media/2021/01/x5ym225308.jpg', NULL, NULL),
(129, 45, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606134x5ym225308.jpg', NULL, '2021-01-25 20:22:14'),
(130, 45, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606134x5ym225308.jpg', NULL, '2021-01-25 20:22:14'),
(131, 46, 'ACTUAL', 360, 530, 'images/media/2021/01/2Afvh25908.jpg', NULL, NULL),
(132, 46, 'THUMBNAIL', 102, 150, 'images/media/2021/01/thumbnail16116061442Afvh25908.jpg', NULL, '2021-01-25 20:22:24'),
(133, 46, 'MEDIUM', 272, 400, 'images/media/2021/01/medium16116061442Afvh25908.jpg', NULL, '2021-01-25 20:22:24'),
(134, 47, 'ACTUAL', 360, 540, 'images/media/2021/01/U5VGd25308.jpg', NULL, NULL),
(135, 47, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606152U5VGd25308.jpg', NULL, '2021-01-25 20:22:32'),
(136, 47, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606152U5VGd25308.jpg', NULL, '2021-01-25 20:22:32'),
(137, 48, 'ACTUAL', 360, 540, 'images/media/2021/01/iECdQ25708.jpg', NULL, NULL),
(138, 48, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606160iECdQ25708.jpg', NULL, '2021-01-25 20:22:40'),
(139, 48, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606160iECdQ25708.jpg', NULL, '2021-01-25 20:22:40'),
(140, 49, 'ACTUAL', 360, 540, 'images/media/2021/01/w7zsY25608.jpg', NULL, NULL),
(141, 49, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606169w7zsY25608.jpg', NULL, '2021-01-25 20:22:49'),
(142, 49, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606169w7zsY25608.jpg', NULL, '2021-01-25 20:22:49'),
(143, 50, 'ACTUAL', 360, 539, 'images/media/2021/01/NfKw125408.jpg', NULL, NULL),
(144, 50, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606178NfKw125408.jpg', NULL, '2021-01-25 20:22:58'),
(145, 50, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606178NfKw125408.jpg', NULL, '2021-01-25 20:22:58'),
(146, 51, 'ACTUAL', 360, 540, 'images/media/2021/01/b6PnG25308.jpg', NULL, NULL),
(147, 51, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606184b6PnG25308.jpg', NULL, '2021-01-25 20:23:04'),
(148, 51, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606184b6PnG25308.jpg', NULL, '2021-01-25 20:23:04'),
(149, 52, 'ACTUAL', 360, 540, 'images/media/2021/01/bGNi425808.jpg', NULL, NULL),
(150, 52, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606194bGNi425808.jpg', NULL, '2021-01-25 20:23:14'),
(151, 52, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606194bGNi425808.jpg', NULL, '2021-01-25 20:23:14'),
(152, 53, 'ACTUAL', 360, 539, 'images/media/2021/01/DVuD225208.jpg', NULL, NULL),
(153, 53, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606203DVuD225208.jpg', NULL, '2021-01-25 20:23:23'),
(154, 53, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606203DVuD225208.jpg', NULL, '2021-01-25 20:23:23'),
(155, 54, 'ACTUAL', 360, 524, 'images/media/2021/01/fEh0625808.jpg', NULL, NULL),
(156, 54, 'THUMBNAIL', 103, 150, 'images/media/2021/01/thumbnail1611606214fEh0625808.jpg', NULL, '2021-01-25 20:23:34'),
(157, 54, 'MEDIUM', 275, 400, 'images/media/2021/01/medium1611606214fEh0625808.jpg', NULL, '2021-01-25 20:23:34'),
(158, 55, 'ACTUAL', 360, 539, 'images/media/2021/01/3xHig25908.jpg', NULL, NULL),
(159, 55, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail16116063403xHig25908.jpg', NULL, '2021-01-25 20:25:40'),
(160, 55, 'MEDIUM', 267, 400, 'images/media/2021/01/medium16116063403xHig25908.jpg', NULL, '2021-01-25 20:25:40'),
(161, 56, 'ACTUAL', 360, 1440, 'images/media/2021/01/YyRf025908.jpg', NULL, NULL),
(162, 56, 'THUMBNAIL', 38, 150, 'images/media/2021/01/thumbnail1611606345YyRf025908.jpg', NULL, '2021-01-25 20:25:45'),
(163, 56, 'MEDIUM', 100, 400, 'images/media/2021/01/medium1611606345YyRf025908.jpg', NULL, '2021-01-25 20:25:45'),
(164, 56, 'LARGE', 225, 900, 'images/media/2021/01/large1611606345YyRf025908.jpg', NULL, '2021-01-25 20:25:45'),
(165, 57, 'ACTUAL', 360, 640, 'images/media/2021/01/EaOCJ25608.jpg', NULL, NULL),
(166, 57, 'THUMBNAIL', 84, 150, 'images/media/2021/01/thumbnail1611606353EaOCJ25608.jpg', NULL, '2021-01-25 20:25:53'),
(167, 57, 'MEDIUM', 225, 400, 'images/media/2021/01/medium1611606353EaOCJ25608.jpg', NULL, '2021-01-25 20:25:53'),
(168, 58, 'ACTUAL', 360, 240, 'images/media/2021/01/Epglz25108.jpg', NULL, NULL),
(169, 58, 'THUMBNAIL', 150, 100, 'images/media/2021/01/thumbnail1611606359Epglz25108.jpg', NULL, '2021-01-25 20:25:59'),
(170, 59, 'ACTUAL', 360, 545, 'images/media/2021/01/fJpI725308.jpg', NULL, NULL),
(171, 59, 'THUMBNAIL', 99, 150, 'images/media/2021/01/thumbnail1611606369fJpI725308.jpg', NULL, '2021-01-25 20:26:09'),
(172, 59, 'MEDIUM', 264, 400, 'images/media/2021/01/medium1611606369fJpI725308.jpg', NULL, '2021-01-25 20:26:09'),
(173, 60, 'ACTUAL', 360, 540, 'images/media/2021/01/yVSiG25108.jpg', NULL, NULL),
(174, 60, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606390yVSiG25108.jpg', NULL, '2021-01-25 20:26:30'),
(175, 60, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606390yVSiG25108.jpg', NULL, '2021-01-25 20:26:30'),
(176, 61, 'ACTUAL', 360, 540, 'images/media/2021/01/W7A4r25308.jpg', NULL, NULL),
(177, 61, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606397W7A4r25308.jpg', NULL, '2021-01-25 20:26:37'),
(178, 61, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606397W7A4r25308.jpg', NULL, '2021-01-25 20:26:37'),
(179, 62, 'ACTUAL', 360, 540, 'images/media/2021/01/eyoui25308.jpg', NULL, NULL),
(180, 62, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606410eyoui25308.jpg', NULL, '2021-01-25 20:26:50'),
(181, 62, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606410eyoui25308.jpg', NULL, '2021-01-25 20:26:50'),
(182, 63, 'ACTUAL', 360, 540, 'images/media/2021/01/hbTZL25708.jpg', NULL, NULL),
(183, 63, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606417hbTZL25708.jpg', NULL, '2021-01-25 20:26:57'),
(184, 63, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606417hbTZL25708.jpg', NULL, '2021-01-25 20:26:57'),
(185, 64, 'ACTUAL', 360, 1460, 'images/media/2021/01/qPSLv25808.jpg', NULL, NULL),
(186, 64, 'THUMBNAIL', 37, 150, 'images/media/2021/01/thumbnail1611606455qPSLv25808.jpg', NULL, '2021-01-25 20:27:35'),
(187, 64, 'MEDIUM', 99, 400, 'images/media/2021/01/medium1611606455qPSLv25808.jpg', NULL, '2021-01-25 20:27:35'),
(188, 64, 'LARGE', 222, 900, 'images/media/2021/01/large1611606455qPSLv25808.jpg', NULL, '2021-01-25 20:27:35'),
(189, 65, 'ACTUAL', 360, 540, 'images/media/2021/01/K2BIA25908.jpg', NULL, NULL),
(190, 65, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606470K2BIA25908.jpg', NULL, '2021-01-25 20:27:50'),
(191, 65, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606470K2BIA25908.jpg', NULL, '2021-01-25 20:27:50'),
(192, 66, 'ACTUAL', 360, 539, 'images/media/2021/01/HTzs725808.jpg', NULL, NULL),
(193, 66, 'THUMBNAIL', 100, 150, 'images/media/2021/01/thumbnail1611606475HTzs725808.jpg', NULL, '2021-01-25 20:27:55'),
(194, 66, 'MEDIUM', 267, 400, 'images/media/2021/01/medium1611606475HTzs725808.jpg', NULL, '2021-01-25 20:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_image_settings`
--

CREATE TABLE `lieferh_image_settings` (
  `image_settings_id` bigint(20) UNSIGNED NOT NULL,
  `large_width` bigint(20) DEFAULT NULL,
  `large_height` bigint(20) DEFAULT NULL,
  `thumbnail_width` bigint(20) DEFAULT NULL,
  `thumbnail_height` bigint(20) DEFAULT NULL,
  `medium_width` bigint(20) DEFAULT NULL,
  `medium_height` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lieferh_image_settings`
--

INSERT INTO `lieferh_image_settings` (`image_settings_id`, `large_width`, `large_height`, `thumbnail_width`, `thumbnail_height`, `medium_width`, `medium_height`, `created_at`, `updated_at`) VALUES
(1, 900, 900, 150, 150, 400, 400, '2020-12-29 13:13:45', '2021-01-02 13:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_migrations`
--

CREATE TABLE `lieferh_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lieferh_migrations`
--

INSERT INTO `lieferh_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_29_072707_create_image_settings_table', 2),
(5, '2020_12_29_073420_create_images_table', 2),
(6, '2020_12_29_073438_create_image_categories_table', 2),
(8, '2021_01_04_055728_create_categories_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_password_resets`
--

CREATE TABLE `lieferh_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_payment_description`
--

CREATE TABLE `lieferh_payment_description` (
  `id` int(11) NOT NULL,
  `payment_methods_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `language_id` int(11) NOT NULL,
  `sub_name_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sub_name_2` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lieferh_payment_description`
--

INSERT INTO `lieferh_payment_description` (`id`, `payment_methods_id`, `name`, `language_id`, `sub_name_1`, `sub_name_2`) VALUES
(1, 1, 'Braintree', 1, 'Credit Card', 'Paypal'),
(4, 2, 'Stripe', 1, '', ''),
(6, 4, 'Cash on Delivery', 1, '', ''),
(7, 5, 'Instamojo', 1, '', ''),
(8, 0, 'Cybersoure', 1, '', ''),
(9, 6, 'Hyperpay', 1, '', ''),
(10, 7, 'Razor Pay', 1, '', ''),
(11, 8, 'PayTm', 1, '', ''),
(12, 9, 'Direct Bank Transfer', 1, 'Make your payment directly into our bank account. Please use your Order ID as the payment reference.', ''),
(13, 10, 'Paystack', 1, '', ''),
(14, 11, 'Midtrans', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_payment_methods`
--

CREATE TABLE `lieferh_payment_methods` (
  `payment_methods_id` int(11) NOT NULL,
  `payment_method` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `environment` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lieferh_payment_methods`
--

INSERT INTO `lieferh_payment_methods` (`payment_methods_id`, `payment_method`, `status`, `environment`, `created_at`, `updated_at`) VALUES
(1, 'braintree', 0, 0, '2019-09-18 11:10:13', '0000-00-00 00:00:00'),
(2, 'stripe', 0, 0, '2019-09-18 11:26:17', '0000-00-00 00:00:00'),
(4, 'cash_on_delivery', 1, 0, '2019-09-18 11:26:37', '0000-00-00 00:00:00'),
(5, 'instamojo', 0, 0, '2019-09-18 11:27:23', '0000-00-00 00:00:00'),
(6, 'hyperpay', 0, 0, '2019-09-18 11:26:44', '0000-00-00 00:00:00'),
(7, 'razor_pay', 0, 0, '2019-09-18 11:26:44', '0000-00-00 00:00:00'),
(8, 'pay_tm', 0, 0, '2019-09-18 11:26:44', '0000-00-00 00:00:00'),
(9, 'banktransfer', 0, 0, '2019-09-18 11:26:44', '0000-00-00 00:00:00'),
(10, 'paystack', 0, 0, '2019-09-18 11:26:44', '0000-00-00 00:00:00'),
(11, 'midtrans', 0, 0, '2019-09-18 11:26:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_payment_methods_detail`
--

CREATE TABLE `lieferh_payment_methods_detail` (
  `id` int(11) NOT NULL,
  `payment_methods_id` int(11) NOT NULL,
  `key` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lieferh_payment_methods_detail`
--

INSERT INTO `lieferh_payment_methods_detail` (`id`, `payment_methods_id`, `key`, `value`) VALUES
(3, 1, 'merchant_id', ''),
(4, 1, 'public_key', ''),
(5, 1, 'private_key', ''),
(9, 2, 'secret_key', ''),
(10, 2, 'publishable_key', ''),
(21, 5, 'api_key', ''),
(22, 5, 'auth_token', ''),
(23, 5, 'client_id', ''),
(24, 5, 'client_secret', ''),
(32, 6, 'userid', ''),
(33, 6, 'password', ''),
(34, 6, 'entityid', ''),
(35, 7, 'RAZORPAY_KEY', ''),
(36, 7, 'RAZORPAY_SECRET', ''),
(37, 8, 'paytm_mid', ''),
(39, 8, 'paytm_key', 'w#'),
(40, 8, 'current_domain_name', ''),
(41, 9, 'account_name', ''),
(42, 9, 'account_number', ''),
(43, 9, 'bank_name', ''),
(44, 9, 'short_code', ''),
(45, 9, 'iban', ''),
(46, 9, 'swift', ''),
(47, 10, 'secret_key', ''),
(48, 10, 'public_key', ''),
(49, 11, 'merchant_id', ''),
(50, 11, 'server_key', ''),
(51, 11, 'client_key', '');

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_tasks`
--

CREATE TABLE `lieferh_tasks` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(129) NOT NULL,
  `task_number` varchar(129) DEFAULT NULL,
  `type` varchar(129) NOT NULL COMMENT '1=regular, 2=delevery, 3=pickup',
  `task_date` date NOT NULL,
  `task_time` time NOT NULL,
  `task_status` varchar(129) NOT NULL,
  `client_id` int(10) DEFAULT NULL,
  `drivers_id` int(11) NOT NULL,
  `drivers_fare` int(11) DEFAULT NULL,
  `drivers_fare_type` int(11) DEFAULT NULL COMMENT '1 = Pre Delivery Amount, 2=Total Delivery Amount',
  `collection_time` time NOT NULL,
  `task_complete` int(11) NOT NULL DEFAULT 0 COMMENT '0=not complete,1=complete',
  `created_at` date NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lieferh_tasks`
--

INSERT INTO `lieferh_tasks` (`task_id`, `task_name`, `task_number`, `type`, `task_date`, `task_time`, `task_status`, `client_id`, `drivers_id`, `drivers_fare`, `drivers_fare_type`, `collection_time`, `task_complete`, `created_at`, `updated_at`) VALUES
(4, 'Test Task 1', 'Task000012', '2', '2021-03-26', '16:16:00', '1', 20, 15, 40, 1, '16:16:00', 0, '2021-03-24', 21),
(6, 'Task 4', 'Task000023', '2', '2021-03-26', '20:45:00', '1', 28, 14, 40, 1, '20:45:00', 0, '2021-03-25', 21),
(7, 'Task 5', 'Task000032', '3', '2021-03-27', '13:00:00', '1', 22, 14, 30, 1, '13:00:00', 0, '2021-03-26', 21),
(8, 'Task 2', 'Task000022', '2', '2021-03-28', '01:25:00', '1', 19, 15, 2000, 2, '20:26:00', 0, '2021-03-27', 21),
(11, 'new task3', 'Clie000011', '1', '2021-04-18', '18:28:00', '1', 22, 15, 40, 1, '00:00:00', 1, '0000-00-00', 0),
(12, 'Task 6', 'clie000012', '3', '2021-06-25', '18:41:00', '1', 19, 14, 40, 1, '00:00:00', 0, '2021-06-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_task_details`
--

CREATE TABLE `lieferh_task_details` (
  `task_details_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_order` int(11) DEFAULT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `customer_del_time` datetime DEFAULT NULL,
  `kilomiter` int(11) DEFAULT NULL,
  `complete_status` int(11) DEFAULT 0 COMMENT '0=not complete, 1=complete',
  `delivered_image` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lieferh_task_details`
--

INSERT INTO `lieferh_task_details` (`task_details_id`, `task_id`, `task_order`, `customers_id`, `customer_del_time`, `kilomiter`, `complete_status`, `delivered_image`, `reason`) VALUES
(62, 4, 1, 3, NULL, NULL, 0, NULL, NULL),
(63, 4, 2, 2, NULL, NULL, 0, NULL, NULL),
(64, 4, 3, 4, NULL, NULL, 0, NULL, NULL),
(65, 4, 4, 5, NULL, NULL, 1, '/home/dipanbarun15/public_html/developer/lieferh/public/uploads/1620474273_Capture.JPG', NULL),
(68, 11, 1, 3, NULL, NULL, 1, NULL, NULL),
(73, 8, 1, 3, NULL, NULL, 1, NULL, NULL),
(74, 8, 2, 5, NULL, NULL, 1, NULL, NULL),
(75, 8, 3, 2, NULL, NULL, 1, NULL, NULL),
(76, 8, 4, 4, NULL, NULL, 0, NULL, NULL),
(77, 6, 1, 3, NULL, NULL, 1, '/home/dipanbarun15/public_html/developer/lieferh/public/uploads/1620476737_77482453-557e-4a92-a848-2f402439e779.jpg', NULL),
(78, 6, 2, 2, NULL, NULL, 1, '/home/dipanbarun15/public_html/developer/lieferh/public/uploads/1620889344_c0ede096-620c-4bb3-ab3d-877407a05815.jpg', NULL),
(79, 6, 3, 4, NULL, NULL, 0, '/home/dipanbarun15/public_html/developer/lieferh/public/uploads/1620478478_400184a9-00f2-4ec4-a136-d9556bca4756.jpg', 'Customer not able to pickup the call'),
(80, 6, 4, 5, NULL, NULL, 0, NULL, NULL),
(81, 7, 1, 3, NULL, NULL, 1, NULL, NULL),
(82, 7, 2, 2, NULL, NULL, 0, NULL, NULL),
(83, 7, 3, 4, NULL, NULL, 0, NULL, NULL),
(84, 12, 1, 3, NULL, NULL, 0, NULL, NULL),
(85, 12, 2, 2, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lieferh_users`
--

CREATE TABLE `lieferh_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_type` int(11) DEFAULT 0 COMMENT '1=admin,2=Clint,3=driver',
  `user_type_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sur_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_address_id` int(11) NOT NULL DEFAULT 0,
  `user_pincode` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `user_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_pass_otp` varchar(192) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lieferh_users`
--

INSERT INTO `lieferh_users` (`id`, `role_type`, `user_type_name`, `user_name`, `name`, `sur_name`, `middle_name`, `email`, `email_verified_at`, `password`, `default_address_id`, `user_pincode`, `user_address`, `user_city`, `latitude`, `longitude`, `user_phone`, `f_pass_otp`, `user_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', NULL, 'Super Admin', NULL, NULL, 'admin@lieferh.com', NULL, '$2y$12$WHsYccWXK2b1v5a3gtcOnufRW7gI6Dr69OcETCl2GxR0IHgXhQgAi', 0, '0', NULL, NULL, '0', '0', NULL, NULL, 1, NULL, NULL, NULL),
(12, 4, NULL, NULL, 'Raj Sarma', NULL, NULL, 'rajsarma@email.com', NULL, '$2y$10$A.bnLi5o/GELU4uT1sVNQeVMWfC979tcPc0wUJgFVXokuv1DPW5T.', 0, '0', 'abc', NULL, '0', '0', '9999999999', NULL, 1, NULL, NULL, '2021-03-16 10:53:03'),
(14, 3, NULL, NULL, 'driver_1', NULL, NULL, 'driver_1@gmail.com', NULL, '$2y$10$dvz6iAtRWMwYOquIZ0Mbd.wzfhIMzXcmh7xRTY1wzGMuER9nfiJ1.', 0, '0', '711-2880 Nulla St.', NULL, '22.5544738', '88.3387073', '5555555555', NULL, 1, NULL, '2021-03-17 11:32:38', '2021-03-17 11:56:04'),
(15, 3, NULL, NULL, 'driver_2', NULL, NULL, 'driver_2@gmail.com', NULL, '$2y$10$lMc/ETmU4SH0VY0m9VFIHuuzdJzJ0UrhgExFHNhRklmQ3j.FdfLNG', 0, '0', '3 Kaplan St.', NULL, '22.5841869', '88.3524283', '4444444444', NULL, 1, NULL, '2021-03-17 11:57:40', NULL),
(19, 2, NULL, NULL, 'client3', NULL, NULL, 'client3@gmail.com', NULL, '$2y$10$5XK2oh.hSD7sNfXDCLsR3uFUtZYToEYicmNN32VC4aepoe7xSWXJ6', 0, '79664', 'Schwörstadter Straße, Wehr, Germany', 'Wehr', '48', '8', '7654567654', NULL, 1, NULL, '2021-03-22 08:54:47', '2021-03-31 16:45:20'),
(20, 2, NULL, NULL, 'Client 2', NULL, NULL, 'client123@gmail.com', NULL, '$2y$10$rO5SPBAcIKqf1FY5T737a.SJ8Vu/wXQToa62iPcPuYWv.wKvBM85G', 0, '700014', 'Sealdah Railway Station No 1 & 2, Sealdah, Raja Bazar, Kolkata, West Bengal, India', 'Kolkata', '22.5690575', '88.3720316', '9797676373', NULL, 1, NULL, '2021-03-23 16:23:05', '2021-03-26 16:44:09'),
(21, 2, NULL, NULL, 'Test client', NULL, NULL, 'testclient@gmail.com', NULL, '$2y$10$398CDCw3KvIMNxtuJEBZ3O7OgsSibwtJZ6J0sIOToovBK9zCd1y1q', 0, '700014', 'Sealdah, Sealdah, Raja Bazar, Kolkata, West Bengal, India', 'Kolkata', '22.5676462', '88.3707442', '6523654789', NULL, 1, NULL, '2021-03-25 09:17:02', '2021-03-26 16:43:36'),
(22, 2, NULL, NULL, 'Client 4', NULL, NULL, 'client4@gmail.com', NULL, '$2y$10$dPBwM04.CtPJ9XfdXA4fDO9vUW4//WzxjH.oxwxhHofcMLMAho0q6', 0, '700001', 'Howrah Tram Depot, Bara Bazar, Barabazar Market, Kolkata, West Bengal', 'Kolkata', '22.581847', '88.35098599999999', '6589647562', NULL, 1, NULL, '2021-03-26 14:44:25', '2021-03-26 16:44:18'),
(28, 2, NULL, NULL, 'Sagar', 'Mondal', 'Kumar', 'sagar@gmail.com', NULL, '$2y$10$D1agNPSCwA9oc1hPSYK3vucB4UxIJOW.0rhBJveWrtHPfKRu6dXz.', 0, '700001', 'Howrah Tram Depot, Bara Bazar, Barabazar Market, Kolkata, West Bengal', 'Kolkata', '22.581847', '88.35098599999999', '9898787876', NULL, 0, NULL, '2021-04-06 18:52:56', '2021-04-06 08:18:37'),
(29, 2, 'Client', NULL, 'Suraj', 'Sarma', 'Kumar', 'suraj@gmail.com', NULL, '$2y$10$ErUw1XG.bk1olRiNlDN.g.2kcCCt8F9YwTkmAXsrrGWU5iZz.5Nfy', 0, '60018', '1155 East Oakton Street, Des Plaines, IL, USA', 'Des Plaines', '42.0221454', '-87.8958479', '9879879878', NULL, 1, NULL, '2021-04-06 09:23:32', '2021-04-06 09:30:44'),
(31, 3, NULL, NULL, 'Caravaggio', 'Alessia', NULL, 'alessia@gmail.com', NULL, '$2y$10$buCXoGIMssfK2MrxspiEUu.PcbANQ4NLfyFaXQGoDVkaH0zdG2/lS', 0, '887453', 'xyz', 'rdgdsg', NULL, NULL, '6545225445', NULL, 1, NULL, '2021-04-08 16:56:55', '2021-04-08 19:55:34'),
(34, 3, NULL, NULL, 'Testname', 'TestSurname', NULL, 'Testname@gmail.com', NULL, '$2y$10$iW9uHxzm0WboOmlzAHPuhujBlQ.wWmRPlsJWY4vE6yRrbCONsxGOS', 0, '0', NULL, NULL, NULL, NULL, '7676767676', NULL, 1, NULL, '2021-04-27 08:31:00', '2021-05-04 20:03:27'),
(37, 3, NULL, NULL, 'testUser', 'surName', NULL, 'testuser5@gmail.com', NULL, '$2y$10$OdYhyeI48I8aIRxNy8ByW.aoRAq5so6.b79pkDhLPz4vLP/4ctbAO', 0, '0', NULL, NULL, NULL, NULL, '4545454545', '449728', 1, NULL, '2021-05-04 14:14:13', '2021-05-05 13:53:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lieferh_address_book`
--
ALTER TABLE `lieferh_address_book`
  ADD PRIMARY KEY (`address_book_id`),
  ADD KEY `idx_address_book_customers_id` (`user_id`);

--
-- Indexes for table `lieferh_client_details`
--
ALTER TABLE `lieferh_client_details`
  ADD PRIMARY KEY (`client_details_id`);

--
-- Indexes for table `lieferh_content_pages`
--
ALTER TABLE `lieferh_content_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lieferh_customers`
--
ALTER TABLE `lieferh_customers`
  ADD PRIMARY KEY (`customers_id`);

--
-- Indexes for table `lieferh_customer_notification`
--
ALTER TABLE `lieferh_customer_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lieferh_driver_details`
--
ALTER TABLE `lieferh_driver_details`
  ADD PRIMARY KEY (`driver_details_id`);

--
-- Indexes for table `lieferh_failed_jobs`
--
ALTER TABLE `lieferh_failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lieferh_feedback`
--
ALTER TABLE `lieferh_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lieferh_images`
--
ALTER TABLE `lieferh_images`
  ADD PRIMARY KEY (`images_id`);

--
-- Indexes for table `lieferh_image_categories`
--
ALTER TABLE `lieferh_image_categories`
  ADD PRIMARY KEY (`image_categories_id`);

--
-- Indexes for table `lieferh_image_settings`
--
ALTER TABLE `lieferh_image_settings`
  ADD PRIMARY KEY (`image_settings_id`);

--
-- Indexes for table `lieferh_migrations`
--
ALTER TABLE `lieferh_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lieferh_password_resets`
--
ALTER TABLE `lieferh_password_resets`
  ADD KEY `freshh_password_resets_email_index` (`email`(191));

--
-- Indexes for table `lieferh_payment_description`
--
ALTER TABLE `lieferh_payment_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lieferh_payment_methods`
--
ALTER TABLE `lieferh_payment_methods`
  ADD PRIMARY KEY (`payment_methods_id`);

--
-- Indexes for table `lieferh_payment_methods_detail`
--
ALTER TABLE `lieferh_payment_methods_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lieferh_tasks`
--
ALTER TABLE `lieferh_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `lieferh_task_details`
--
ALTER TABLE `lieferh_task_details`
  ADD PRIMARY KEY (`task_details_id`);

--
-- Indexes for table `lieferh_users`
--
ALTER TABLE `lieferh_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lieferh_address_book`
--
ALTER TABLE `lieferh_address_book`
  MODIFY `address_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lieferh_client_details`
--
ALTER TABLE `lieferh_client_details`
  MODIFY `client_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lieferh_content_pages`
--
ALTER TABLE `lieferh_content_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lieferh_customers`
--
ALTER TABLE `lieferh_customers`
  MODIFY `customers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lieferh_customer_notification`
--
ALTER TABLE `lieferh_customer_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `lieferh_driver_details`
--
ALTER TABLE `lieferh_driver_details`
  MODIFY `driver_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lieferh_failed_jobs`
--
ALTER TABLE `lieferh_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lieferh_feedback`
--
ALTER TABLE `lieferh_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lieferh_images`
--
ALTER TABLE `lieferh_images`
  MODIFY `images_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `lieferh_image_categories`
--
ALTER TABLE `lieferh_image_categories`
  MODIFY `image_categories_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `lieferh_image_settings`
--
ALTER TABLE `lieferh_image_settings`
  MODIFY `image_settings_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lieferh_migrations`
--
ALTER TABLE `lieferh_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lieferh_payment_description`
--
ALTER TABLE `lieferh_payment_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lieferh_payment_methods`
--
ALTER TABLE `lieferh_payment_methods`
  MODIFY `payment_methods_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lieferh_payment_methods_detail`
--
ALTER TABLE `lieferh_payment_methods_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `lieferh_tasks`
--
ALTER TABLE `lieferh_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lieferh_task_details`
--
ALTER TABLE `lieferh_task_details`
  MODIFY `task_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `lieferh_users`
--
ALTER TABLE `lieferh_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
