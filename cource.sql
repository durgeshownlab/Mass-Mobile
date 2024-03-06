-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 04:36 AM
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
-- Database: `cource`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `pin_code` varchar(11) NOT NULL,
  `locality` text NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'India',
  `address_type` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `user_id`, `name`, `mobile`, `pin_code`, `locality`, `address`, `city`, `state`, `country`, `address_type`, `is_deleted`, `timestamp`) VALUES
(19, 9, 'Durgesh Kumar', '7667107173', '851133', 'rani bagh', 'Mokhtiyarpur bhagwanpur begusarai Bihar', 'Begusarai', 'Bihar', 'India', 'home', 0, '2023-06-30 10:14:47'),
(20, 9, 'vikash kumar', '7667107173', '585556', 'ranibagh', 'Mokhtiyarpur bhagwanpur begusarai Bihar', 'Begusarai', 'Delhi', 'India', 'office', 0, '2023-07-04 06:58:06'),
(23, 9, 'asd', '2342442424', '232323', 'sad', '23424', '234324', 'Arunachal Pradesh', 'India', 'office', 0, '2023-08-10 11:35:39'),
(24, 9, 'AMIT ', '1234567890', '124578', 'rani bagh', 'SDFASF', 'NEW DELHI', 'Rajasthan', 'India', 'office', 0, '2023-08-12 11:06:07'),
(25, 15, 'Suraj S/O Santosh sharma', '9817145647', '110044', 'India', 'Suraj S/O Santosh sharma H 22A Pooja Bhawan', 'New Delhi', 'Delhi', 'India', 'home', 0, '2023-08-12 11:41:35'),
(26, 15, 'Sujata Singh', '9171488528', '110052', 'Delhi', 'H 502 Lajpat nagar', 'New Delhi', 'Delhi', 'India', 'office', 0, '2023-08-12 11:43:38'),
(28, 9, 'sdfas', '3452345542', '234523', 'test', 'asdfasffasdf', 'asdfasdf', 'Arunachal Pradesh', 'India', 'home', 0, '2023-09-11 06:29:44'),
(29, 23, 'test name', '3425235235', '234345', 'fgsdgsd', 'asdfasdff', 'sadfsfs', 'Chhattisgarh', 'India', 'home', 0, '2023-09-11 06:44:48'),
(30, 23, 'Test Address', '1587496320', '851126', 'ranibagh', 'testt', 'dfgfg', 'Bihar', 'India', 'home', 0, '2023-11-24 06:40:21'),
(31, 23, 'demo name', '8826025399', '851126', 'ranibagh', 'testt', 'dfgfg', 'Bihar', 'India', 'home', 0, '2023-11-24 07:20:26'),
(32, 23, 'Test Address', '1587496320', '851126', 'ranibagh', 'testt', 'dfgfg', 'Bihar', 'India', 'home', 0, '2023-11-28 12:50:57'),
(33, 10, 'asda', '8826011435', '110062', 'asd', 'e', 'wef', 'Chhattisgarh', 'India', 'home', 0, '2023-12-05 07:13:18'),
(34, 24, 'asda', '8826011435', '110062', 'asd', 'e', 'wef', 'Andaman and Nicobar Islands', 'India', 'home', 0, '2024-01-12 09:16:38'),
(35, 24, 'asda', '8826011435', '110062', 'asd', 'e', 'wef', 'Andaman and Nicobar Islands', 'India', 'home', 0, '2024-01-12 09:16:38'),
(36, 24, 'asda', '8826011435', '110062', 'asd', 'e', 'wef', 'Andaman and Nicobar Islands', 'India', 'home', 0, '2024-01-12 09:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `banner_id` int(11) NOT NULL,
  `banner_name` varchar(255) NOT NULL,
  `banner_image` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `banner_name`, `banner_image`, `is_deleted`, `time_stamp`) VALUES
(2, 'Mellophone', '6502aeb3041b86.39974210.jpg', 0, '2023-09-14 06:56:51'),
(3, 'Sitar Customized', '6502aed33f0305.79982315.jpg', 0, '2023-09-14 06:57:23'),
(4, 'Saxophone', '6502aeea8fa025.02672567.jpg', 0, '2023-09-14 06:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `total_price`, `is_deleted`, `timestamp`) VALUES
(16, 9, 4, 2, 90, 0, '2023-09-18 11:36:21'),
(17, 9, 8, 2, 88, 0, '2023-09-18 11:36:23'),
(21, 9, 10, 3, 1065, 0, '2023-09-19 04:42:57'),
(23, 9, 2, 2, 15120, 0, '2023-09-19 07:45:44'),
(28, 10, 1, 7, 34993, 0, '2023-12-05 07:11:25'),
(29, 10, 10, 1, 355, 0, '2023-12-05 07:15:18'),
(31, 24, 1, 4, 19996, 0, '2024-01-12 09:15:02'),
(32, 24, 3, 2, 11732, 0, '2024-01-12 09:15:27'),
(33, 24, 2, 2, 15120, 0, '2024-01-12 09:18:02'),
(34, 23, 3, 1, 5866, 0, '2024-01-15 15:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `is_deleted`, `timestamp`) VALUES
(1, 'BRASS INSTRUMENTS', '6502ca0281f636.20916674.jpg', 0, '2023-08-19 07:04:44'),
(2, 'SILVER INSTRUMENTS', '6502ca1456b453.81364102.jpg', 0, '2023-08-19 07:05:13'),
(3, 'WOODEN INSTRUMENTS', '6502ca1ac80eb2.18850162.jpg', 0, '2023-08-19 07:05:49'),
(4, 'Drum', '6502ca801f3428.47149417.jpg', 0, '2023-09-14 08:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price_single_unit` bigint(20) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `delivery_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_event` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_canceled` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `product_id`, `address_id`, `transaction_id`, `quantity`, `price_single_unit`, `total_price`, `payment_method`, `payment_status`, `delivery_status`, `order_status`, `order_event`, `order_date`, `is_deleted`, `is_canceled`, `timestamp`) VALUES
(1, '1692598502f0d38c08', 9, 3, 23, NULL, 1, 4999, 4999, 'pod', 'pending', 'canceled', 'canceled', '[{\"event_name\":\"order placed\",\"Date\":\"21-08-2023\",\"Time\":\"11:45:02\"},{\"event_name\":\"order canceled\",\"Date\":\"21-08-2023\",\"Time\":\"12:04:59\"}]', '2023-08-21 11:45:02', 0, 1, '2023-08-21 06:15:02'),
(2, '1692598502647f5899', 9, 9, 23, NULL, 1, 4650, 4650, 'pod', 'pending', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"21-08-2023\",\"Time\":\"11:45:02\"}]', '2023-08-21 11:45:02', 0, 0, '2023-08-21 06:15:02'),
(3, '1692599353e7c70558', 9, 2, 20, NULL, 1, 8999, 8999, 'pod', 'pending', 'canceled', 'canceled', '[{\"event_name\":\"order placed\",\"Date\":\"21-08-2023\",\"Time\":\"11:59:13\"},{\"event_name\":\"order confirmed\",\"Date\":\"21-08-2023\",\"Time\":\"12:04:49\"},{\"event_name\":\"order canceled\",\"Date\":\"21-08-2023\",\"Time\":\"12:06:27\"}]', '2023-08-21 11:59:13', 0, 1, '2023-08-21 06:29:13'),
(4, '1692783748a5a09c7f', 9, 3, 20, NULL, 1, 4999, 4999, 'pod', 'pending', 'canceled', 'canceled', '[{\"event_name\":\"order placed\",\"Date\":\"23-08-2023\",\"Time\":\"15:12:28\"},{\"event_name\":\"order canceled\",\"Date\":\"11-09-2023\",\"Time\":\"14:29:05\"}]', '2023-08-23 15:12:28', 0, 1, '2023-08-23 09:42:28'),
(5, '1695035916d5cb82ea', 9, 10, 24, '55213276640948639', 1, 355, 355, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"16:48:36\"}]', '2023-09-18 16:48:36', 0, 0, '2023-09-18 11:18:36'),
(6, '16950360217ca9df19', 9, 10, 24, '1JV744292P324200S', 1, 355, 355, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"16:50:21\"}]', '2023-09-18 16:50:21', 0, 0, '2023-09-18 11:20:21'),
(7, '1695037131285d1a47', 9, 10, 23, '8N188221LE420605E', 1, 355, 355, 'online', 'success', 'canceled', 'canceled', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"17:08:51\"},{\"event_name\":\"order canceled\",\"Date\":\"18-09-2023\",\"Time\":\"17:15:17\"}]', '2023-09-18 17:08:51', 0, 1, '2023-09-18 11:38:51'),
(8, '1695037131dbd99b3c', 9, 4, 23, '8N188221LE420605E', 2, 45, 90, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"17:08:51\"}]', '2023-09-18 17:08:51', 0, 0, '2023-09-18 11:38:51'),
(9, '16950371316badc3c3', 9, 8, 23, '8N188221LE420605E', 1, 44, 44, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"17:08:51\"}]', '2023-09-18 17:08:51', 0, 0, '2023-09-18 11:38:51'),
(10, '1695037587327125ee', 9, 4, 20, '5CM29440S0025754J', 2, 45, 90, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"17:16:27\"}]', '2023-09-18 17:16:27', 0, 0, '2023-09-18 11:46:27'),
(11, '16950375873fbbb8e4', 9, 8, 20, '5CM29440S0025754J', 2, 44, 88, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"17:16:27\"}]', '2023-09-18 17:16:27', 0, 0, '2023-09-18 11:46:27'),
(12, '169503767067972996', 9, 4, 24, '41L15928GK807101L', 2, 45, 90, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"17:17:50\"}]', '2023-09-18 17:17:50', 0, 0, '2023-09-18 11:47:50'),
(13, '1695037670aa126d7b', 9, 8, 24, '41L15928GK807101L', 2, 44, 88, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"17:17:50\"}]', '2023-09-18 17:17:50', 0, 0, '2023-09-18 11:47:50'),
(14, '1695040906b46ed69b', 9, 5, 23, '77U505668R758710X', 1, 522, 522, 'online', 'success', 'canceled', 'canceled', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"18:11:46\"},{\"event_name\":\"order canceled\",\"Date\":\"18-09-2023\",\"Time\":\"18:13:24\"}]', '2023-09-18 18:11:46', 0, 1, '2023-09-18 12:41:46'),
(15, '16950410451849e090', 9, 5, 24, '2DA29502NC2662318', 1, 522, 522, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"18:14:05\"}]', '2023-09-18 18:14:05', 0, 0, '2023-09-18 12:44:05'),
(16, '16950412233a67ec03', 9, 4, 23, '5C9278766V964611A', 2, 45, 90, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"18:17:03\"}]', '2023-09-18 18:17:03', 0, 0, '2023-09-18 12:47:03'),
(17, '169504122354ceb909', 9, 8, 23, '5C9278766V964611A', 2, 44, 88, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"18:17:03\"}]', '2023-09-18 18:17:03', 0, 0, '2023-09-18 12:47:03'),
(18, '1695041630c5ee2cbf', 9, 4, 23, '0VW29141A7347720H', 2, 45, 90, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"18:23:50\"}]', '2023-09-18 18:23:50', 0, 0, '2023-09-18 12:53:50'),
(19, '169504163087f6e6a8', 9, 8, 23, '0VW29141A7347720H', 2, 44, 88, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"18:23:50\"}]', '2023-09-18 18:23:50', 0, 0, '2023-09-18 12:53:50'),
(20, '169504179254341bae', 9, 4, 28, '0H064427TE816850J', 2, 45, 90, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"18:26:32\"}]', '2023-09-18 18:26:32', 0, 0, '2023-09-18 12:56:32'),
(21, '1695041792abb76709', 9, 8, 28, '0H064427TE816850J', 2, 44, 88, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"18-09-2023\",\"Time\":\"18:26:32\"}]', '2023-09-18 18:26:32', 0, 0, '2023-09-18 12:56:32'),
(22, '1695096821904aedfe', 9, 1, 23, '5K177196DH109981W', 1, 4999, 4999, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"19-09-2023\",\"Time\":\"09:43:41\"}]', '2023-09-19 09:43:41', 0, 0, '2023-09-19 04:13:41'),
(23, '1695098637be7cedee', 9, 10, 24, '93H956325G613223X', 2, 355, 710, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"19-09-2023\",\"Time\":\"10:13:57\"}]', '2023-09-19 10:13:57', 0, 0, '2023-09-19 04:43:57'),
(24, '16950987349a743282', 9, 5, 20, '8FY40944DR826025B', 1, 522, 522, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"19-09-2023\",\"Time\":\"10:15:34\"}]', '2023-09-19 10:15:34', 0, 0, '2023-09-19 04:45:34'),
(25, '169509926500a2b1c5', 9, 4, 23, '2EH11205YE5231846', 2, 45, 90, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"19-09-2023\",\"Time\":\"10:24:25\"}]', '2023-09-19 10:24:25', 0, 0, '2023-09-19 04:54:25'),
(26, '16950992658fa72262', 9, 8, 23, '2EH11205YE5231846', 2, 44, 88, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"19-09-2023\",\"Time\":\"10:24:25\"}]', '2023-09-19 10:24:25', 0, 0, '2023-09-19 04:54:25'),
(27, '16950992654e0725b5', 9, 10, 23, '2EH11205YE5231846', 2, 355, 710, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"19-09-2023\",\"Time\":\"10:24:25\"}]', '2023-09-19 10:24:25', 0, 0, '2023-09-19 04:54:25'),
(28, '1700809173f3f124f3', 23, 7, 30, 'pi_3OFtMfSCQnrG2Gyf1i2vVQgd', 1, 255, 255, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"12:29:54\"}]', '2023-11-24 01:59:54', 0, 0, '2023-11-24 06:59:54'),
(29, '170080954082309704', 23, 8, 29, 'pi_3OFtShSCQnrG2Gyf0XkVn2t3', 3, 44, 132, 'online', 'success', 'canceled', 'canceled', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"12:36:07\"},{\"event_name\":\"order canceled\",\"Date\":\"24-11-2023\",\"Time\":\"12:37:32\"}]', '2023-11-24 02:06:07', 0, 1, '2023-11-24 07:06:07'),
(30, '1700809540de423965', 23, 10, 29, 'pi_3OFtShSCQnrG2Gyf0XkVn2t3', 1, 355, 355, 'online', 'success', 'order confirmed', 'confirmed', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"12:36:07\"},{\"event_name\":\"order confirmed\",\"Date\":\"24-11-2023\",\"Time\":\"12:39:03\"}]', '2023-11-24 02:06:07', 0, 0, '2023-11-24 07:06:07'),
(31, '170080954000b600fd', 23, 7, 29, 'pi_3OFtShSCQnrG2Gyf0XkVn2t3', 1, 255, 255, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"12:36:07\"}]', '2023-11-24 02:06:07', 0, 0, '2023-11-24 07:06:07'),
(32, '1700810439491d734f', 23, 8, 31, 'pi_3OFthLSCQnrG2Gyf00AugGuW', 3, 44, 132, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"12:51:17\"}]', '2023-11-24 02:21:17', 0, 0, '2023-11-24 07:21:17'),
(33, '1700810439087459b5', 23, 10, 31, 'pi_3OFthLSCQnrG2Gyf00AugGuW', 1, 355, 355, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"12:51:17\"}]', '2023-11-24 02:21:17', 0, 0, '2023-11-24 07:21:17'),
(34, '17008104397323b2ed', 23, 7, 31, 'pi_3OFthLSCQnrG2Gyf00AugGuW', 1, 255, 255, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"12:51:17\"}]', '2023-11-24 02:21:17', 0, 0, '2023-11-24 07:21:17'),
(35, '1700810439f67c4ef3', 23, 1, 31, 'pi_3OFthLSCQnrG2Gyf00AugGuW', 1, 4999, 4999, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"12:51:17\"}]', '2023-11-24 02:21:17', 0, 0, '2023-11-24 07:21:17'),
(36, '1700808789b50eec82', 23, 8, 29, 'pi_3OFtGRSCQnrG2Gyf1NS2kviY', 3, 44, 132, 'online', 'success', 'canceled', 'canceled', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"13:24:35\"},{\"event_name\":\"order canceled\",\"Date\":\"15-01-2024\",\"Time\":\"20:55:29\"}]', '2023-11-24 02:54:35', 0, 1, '2023-11-24 07:54:35'),
(37, '17008087892f64e283', 23, 10, 29, 'pi_3OFtGRSCQnrG2Gyf1NS2kviY', 1, 355, 355, 'online', 'success', 'order placed', 'pending', '[{\"event_name\":\"order placed\",\"Date\":\"24-11-2023\",\"Time\":\"13:24:35\"}]', '2023-11-24 02:54:35', 0, 0, '2023-11-24 07:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_image` text NOT NULL,
  `product_price` bigint(20) NOT NULL,
  `product_desc` text NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `base_price` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `product_price`, `product_desc`, `sub_category_id`, `base_price`, `quantity`, `is_deleted`, `timestamp`) VALUES
(1, 'Brass Flugel Horn', '6502cf1b409637.33984379.jpg', 4999, 'Brass Flugel Horn', 2, 6999, 3, 0, '2023-09-14 09:15:07'),
(2, 'Clarinet Flute', '6502cfb4abca27.10272403.jpg', 7560, 'The Brand New Execellent Bb Low Pitch Tuneable Army Bugle,militaria Bugle,school Bugle,scout Bugle Is Made Of Good Quality Brass And Materials And Well Finished.our All Musical Instruments Have Good Quality Components,professional Sound And Technically Approved By The Musicians World Wide.', 6, 9999, 100, 0, '2023-09-14 09:17:40'),
(3, 'Brass Trombone', '6502d054d46c65.07902791.jpg', 5866, 'The Modern Bass Trombone Is Pitched In B It Is Identical In Length To The Tenor Trombone, But Has A Wider Bore And A Larger Bell To Aid In The Production Of A Fuller, Deeper Tone In The Lower Register.', 3, 6999, 155, 0, '2023-09-14 09:20:20'),
(4, 'Brass Trombone', '6502d0f06af9a7.84634334.jpg', 45, 'The Modern Bass Trombone Is Pitched In B It Is Identical In Length To The Tenor Trombone, But Has A Wider Bore And A Larger Bell To Aid In The Production Of A Fuller, Deeper Tone In The Lower Register', 3, 85, 55, 0, '2023-09-14 09:22:56'),
(5, 'Cornet Silver', '6502dac3cdc186.04450282.jpg', 522, 'Our Product Quality Attention We Believe That No Product Is Complete Without Putting It In To Practical Experience. This Is The Main Strength Of Our Products. All Our Products Like Trombone, Euphonium, Bugel Cooper, Trumpet, Pocket Cornet, Tenor Core, French Horn And Other Musical Instruments Are Well Accepted In The Market Mainly Because Of The Quality It Maintains All Through These Years.', 7, 566, 52, 0, '2023-09-14 10:04:51'),
(6, 'Silver Bugle ', '6502dc1ea97af9.21505711.jpg', 4555, 'Silver Bugle Is Becoming A Most Demandable Instrument Nowadays, It Demand Increase In School Functions, Marriage Band, Government Sector Supply.', 8, 8666, 88, 0, '2023-09-14 10:10:38'),
(7, 'Silver Mellophone', '6502ddd208c621.86215660.jpg', 255, 'Backed Ourselves With A Crew Of Dexterous Workers, We Are Readily Affianced In Providing A Distinctive Plethora Of Mellophone Horn Silver. In Conformism With The Advancement Taking Place In The Market, These Presented Products Are Developed With Utmost Excellence', 10, 755, 85, 0, '2023-09-14 10:17:54'),
(8, 'Dilruba', '6502df13a8a6b7.96262589.jpg', 44, 'Special Type Dilruba Professional Type Generally Use By Raggis Wtth Adjustable Horse Hair Bow In Spl.fibre Box.available In 2 Colors.', 5, 45, 45, 0, '2023-09-14 10:23:15'),
(9, 'Clarinet', '6502dfee71a746.26057193.jpg', 453, 'Special Type Clarinet Professional Type Generally Use By Raggis Wtth Adjustable Horse Hair Bow In Spl.fibre Box.available In 2 Colors.', 6, 455, 56, 0, '2023-09-14 10:26:54'),
(10, 'Dhol', '6502e0b2698f69.38231184.jpg', 355, 'Dhol', 11, 455, 455, 0, '2023-09-14 10:30:10'),
(11, 'Euphonium', '6502e129805435.97404295.jpg', 755, 'Euphonium', 9, 855, 455, 0, '2023-09-14 10:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_path`, `is_deleted`, `time_stamp`) VALUES
(1, 1, '6502cf1b432662.52969414.jpg', 0, '2023-09-14 09:15:07'),
(2, 2, '6502cfb4aeb675.22228709.jpg', 0, '2023-09-14 09:17:40'),
(3, 3, '6502d054d4ff67.89195430.jpg', 0, '2023-09-14 09:20:20'),
(4, 4, '6502d0f06da409.39737222.jpg', 0, '2023-09-14 09:22:56'),
(5, 5, '6502dac3cf35c7.20700328.jpg', 0, '2023-09-14 10:04:51'),
(6, 6, '6502dc1eac6971.94334281.jpg', 0, '2023-09-14 10:10:38'),
(7, 7, '6502ddd20b6957.28706296.jpg', 0, '2023-09-14 10:17:54'),
(8, 8, '6502df13acf676.37706150.jpg', 0, '2023-09-14 10:23:15'),
(9, 9, '6502dfee737dd4.91985963.jpg', 0, '2023-09-14 10:26:54'),
(10, 10, '6502e0b26aa339.10974922.jpg', 0, '2023-09-14 10:30:10'),
(11, 11, '6502e12980ed72.90812146.jpg', 0, '2023-09-14 10:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `razorpay_record`
--

CREATE TABLE `razorpay_record` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `razorpay_order_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

CREATE TABLE `specifications` (
  `specification_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specifications`
--

INSERT INTO `specifications` (`specification_id`, `product_id`, `name`, `value`, `is_deleted`, `timestamp`) VALUES
(1, 1, ' Color', 'Nickel', 0, '2023-09-14 09:15:07'),
(2, 1, 'Material Type', 'Brass, Nickel', 0, '2023-09-14 09:15:07'),
(3, 1, 'Style', 'Mouthpiece, Flat', 0, '2023-09-14 09:15:07'),
(4, 1, 'Finish Type', 'Polished', 0, '2023-09-14 09:15:07'),
(5, 2, 'Material Type', 'Brass', 0, '2023-09-14 09:17:40'),
(6, 2, 'Instrument Key', 'BB', 0, '2023-09-14 09:17:40'),
(7, 2, 'Size', 'BELL DIAMETER: 4 inches.', 0, '2023-09-14 09:17:40'),
(8, 4, 'Valve', '7.5 INCHES', 0, '2023-09-14 09:22:56'),
(9, 4, 'Feature', 'MUSICAL BANDS', 0, '2023-09-14 09:22:56'),
(10, 4, 'Application', 'MUSICAL FUNCTIONS', 0, '2023-09-14 09:22:56'),
(11, 4, 'Usage', 'IDEAL FOR FUNCTIONS', 0, '2023-09-14 09:22:56'),
(12, 4, 'Bell Diameter	', '7.5 inch', 0, '2023-09-14 09:22:56'),
(13, 5, 'Mounting Hardware', 'Case', 0, '2023-09-14 10:04:51'),
(14, 5, 'Batteries Required', 'No', 0, '2023-09-14 10:04:51'),
(15, 5, 'Material', 'Silver', 0, '2023-09-14 10:04:51'),
(16, 6, 'Material', 'Brass', 0, '2023-09-14 10:10:38'),
(17, 6, 'Color', 'Silver', 0, '2023-09-14 10:10:38'),
(18, 6, 'Weight', '4 to 5 kg', 0, '2023-09-14 10:10:38'),
(19, 6, 'Surface Finish', 'Nickel Polished', 0, '2023-09-14 10:10:38'),
(20, 6, 'Packaging Type', 'Box', 0, '2023-09-14 10:10:38'),
(21, 7, 'Material', 'Silver', 0, '2023-09-14 10:17:54'),
(22, 7, 'Color', 'Silver', 0, '2023-09-14 10:17:54'),
(23, 7, 'Packaging Type', 'Box', 0, '2023-09-14 10:17:54'),
(24, 7, 'Weight', '3 Kg', 0, '2023-09-14 10:17:54'),
(25, 7, 'Surface Finish', 'Nickel Plated', 0, '2023-09-14 10:17:54'),
(26, 7, 'Country Of Origin', 'India', 0, '2023-09-14 10:17:54'),
(27, 8, 'Width', '45 cm', 0, '2023-09-14 10:23:15'),
(28, 8, 'Type', 'Electric Guitars', 0, '2023-09-14 10:23:15'),
(30, 8, 'Performance Level', 'Intermediate', 0, '2023-09-14 10:23:15'),
(31, 8, 'Color', 'Multicolor', 0, '2023-09-14 10:23:15'),
(32, 8, 'Material', 'Wooden', 0, '2023-09-14 10:23:15'),
(33, 8, 'No Of Strings', '6', 0, '2023-09-14 10:23:15'),
(34, 9, 'Material', 'Wooden', 0, '2023-09-14 10:26:54'),
(35, 9, 'Performance Level', 'Intermediate', 0, '2023-09-14 10:26:54'),
(36, 9, 'Color', 'Multicolor', 0, '2023-09-14 10:26:54'),
(37, 10, 'Material', 'Steel', 0, '2023-09-14 10:30:10'),
(38, 10, 'Color', 'White', 0, '2023-09-14 10:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `sub_category_image` varchar(255) NOT NULL DEFAULT '64e08c25accea3.88930104.jpg',
  `category_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `name`, `sub_category_image`, `category_id`, `is_deleted`, `timestamp`) VALUES
(1, 'Bugle', '6502b139932589.99493409.jpg', 1, 0, '2023-09-14 07:07:37'),
(2, 'Flugel', '6502b1568b8526.36374678.jpg', 1, 0, '2023-09-14 07:08:06'),
(3, 'Trombone', '6502b17b92fc21.06505533.jpg', 1, 0, '2023-09-14 07:08:43'),
(4, 'Trumpet', '6502b1915ffd99.48128645.jpg', 1, 0, '2023-09-14 07:09:05'),
(5, 'Sitar', '6502d771cd2631.46721945.jpg', 3, 0, '2023-09-14 09:50:41'),
(6, 'Flute', '6502d77fd4eb19.49059931.jpg', 3, 0, '2023-09-14 09:50:55'),
(7, 'Baritone', '6502d7b167c7f1.55486093.jpg', 2, 0, '2023-09-14 09:51:45'),
(8, 'Bugle', '6502d7d57fd326.63491264.jpg', 2, 0, '2023-09-14 09:52:21'),
(9, 'Euphonium', '6502d7f2967363.66664446.jpg', 2, 0, '2023-09-14 09:52:50'),
(10, 'Mellophone', '6502d920111079.16755949.jpg', 2, 0, '2023-09-14 09:57:52'),
(11, 'Dhol', '6502e04c6a03c2.75471774.jpg', 4, 0, '2023-09-14 10:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `mobile`, `password`, `user_type`, `is_deleted`, `timestamp`) VALUES
(1, 'admin', 'admin@gmail.com', '7667107173', '12345', 'admin', 0, '2023-06-21 17:29:23'),
(9, 'vikash kumar', 'durgeshkumarraj62@gmail.com', '9508727678', '12345', 'customer', 0, '2023-06-23 17:27:25'),
(10, 'naveen', 'naveen@gmail.com', '6205925686', '12345', 'customer', 0, '2023-06-28 04:10:23'),
(15, 'Suraj', 'suraj.sinha@gmail.com', '9898120141', 'Suraj@1', 'customer', 0, '2023-08-12 11:24:31'),
(17, 'shariq', 'er.shariq057@gmail.com', '8545856598', '123', 'customer', 0, '2023-08-18 06:33:19'),
(23, 'test', 'test@gmail.com', '7667107175', '12', 'customer', 0, '2023-09-07 12:56:31'),
(24, 'ranbir kapoor', 'ranbeer@gmail.com', '8826014344', '123', 'customer', 0, '2024-01-12 09:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`wishlist_id`, `user_id`, `product_id`, `is_deleted`, `timestamp`) VALUES
(6, 9, 9, 0, '2023-09-14 12:37:17'),
(7, 9, 1, 0, '2023-09-14 12:40:14'),
(13, 10, 1, 0, '2023-12-05 07:11:07'),
(15, 24, 5, 0, '2024-01-12 09:20:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_table_ibfk_1` (`sub_category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `razorpay_record`
--
ALTER TABLE `razorpay_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`specification_id`),
  ADD KEY `product_specifications_table_ibfk_1` (`product_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`),
  ADD KEY `sub_category_ibfk_1` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `razorpay_record`
--
ALTER TABLE `razorpay_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specifications`
--
ALTER TABLE `specifications`
  MODIFY `specification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`sub_category_id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `razorpay_record`
--
ALTER TABLE `razorpay_record`
  ADD CONSTRAINT `razorpay_record_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `razorpay_record_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `specifications`
--
ALTER TABLE `specifications`
  ADD CONSTRAINT `specifications_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
