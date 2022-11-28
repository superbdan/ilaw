-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2022 at 09:49 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(250) NOT NULL,
  `brand_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `category_id`, `brand_name`, `brand_status`) VALUES
(1, 1, 'Finibus', 'active'),
(2, 1, 'Lorem', 'active'),
(3, 1, 'Ipsum', 'active'),
(4, 8, 'Dolor', 'active'),
(5, 8, 'Amet', 'active'),
(6, 6, 'Aliquam', 'active'),
(7, 6, 'Maximus', 'active'),
(8, 10, 'Venenatis', 'active'),
(9, 10, 'Ligula', 'active'),
(10, 3, 'Vitae', 'active'),
(11, 3, 'Auctor', 'active'),
(12, 5, 'Luctus', 'active'),
(13, 5, 'Justo', 'active'),
(14, 2, 'Phasellus', 'active'),
(15, 2, 'Viverra', 'active'),
(16, 4, 'Elementum', 'active'),
(17, 4, 'Odio', 'active'),
(18, 7, 'Tellus', 'active'),
(19, 7, 'Curabitur', 'active'),
(20, 9, 'Commodo', 'active'),
(21, 9, 'Nullam', 'active'),
(22, 11, 'Quisques', 'active'),
(24, 11, 'XYZ', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`) VALUES
(14, 20, '::1', 0, 1),
(13, 19, '::1', 0, 1),
(14, 20, '::1', 0, 1),
(15, 19, '::1', -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'LED Bulb', 'active'),
(2, 'LED Lights', 'inactive'),
(4, 'LED Panel Light', 'active'),
(5, 'LED Lamp', 'active'),
(6, 'LED Concealed Light', 'inactive'),
(7, 'LED Spot Light', 'active'),
(8, 'LED Ceiling Light', 'active'),
(9, 'LED Tube Light', 'inactive'),
(10, 'LED Driver', 'active'),
(11, 'Led Floods Light', 'active'),
(13, 'LED Outdoor Lighting', 'active'),
(14, 'LED Indoor Lights', 'active'),
(16, 'LED Monitor', 'active'),
(20, 'Power Supply', 'active'),
(21, 'Connector', 'active'),
(22, 'X Led', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `courier_id` int(11) NOT NULL,
  `courier_name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `address` varchar(300) CHARACTER SET latin1 NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`courier_id`, `courier_name`, `contact_no`, `address`, `datecreated`) VALUES
(2, 'GO panda2', '09278176241', 'Carmona Estates', '2021-11-17 08:42:04'),
(3, 'LBC', '09372615816', 'GMA Cavite', '2022-01-04 08:20:57'),
(4, 'WangTang', '09567294812', 'San Pedro, Laguna', '2022-01-04 08:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` int(255) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`id`, `transaction_id`, `customer_id`, `customer_name`, `customer_no`, `address`, `status`, `date_created`) VALUES
(74, 'ILAW-0000001', '1653', 'ed', '162434', 'cavite', '0', '2021-11-18 08:00:00'),
(75, 'ILAW-0000002', '1653', 'SFSF', '00.1100110', '1010101001', '1', '2021-11-18 08:00:00'),
(76, 'ILAW-0000003', '1653', 'ed', '162434', 'afafasf', '2', '2021-11-18 08:00:00'),
(77, 'ILAW-0000004', '1653', 'SFSF', 'DADASD', 'afasfasfafaf', '3', '2021-11-18 08:00:00'),
(78, 'ILAW-0000005', '1653', 'ed', '162434', 'cavite city', '4', '2021-11-18 08:00:00'),
(79, 'ILAW-0000006', '1653', 'ed', 'DADASD', 'etivac ', '0', '2021-11-19 08:00:00'),
(80, 'ILAW-0000007', 'adad', 'ed', '31336661', 'Cavite', '0', '2021-12-03 08:00:00'),
(0, 'ILAW-0000008', '123', 'Patrick Lingahan', '09567485622', '159 General Malvar Street San Vicente Biñan City Laguna', '0', '2021-12-28 16:00:00'),
(0, 'ILAW-0000009', '1234', 'EFEPANIO DE AMOR LINGAHAN', '09567485622', 'GENERAL MALVAR', '0', '2021-12-28 16:00:00'),
(0, 'ILAW-0000010', '!801-00218', 'Patrick Lingahan', '09567485622', '159 General Malvar Street San Vicente Biñan City Laguna', '0', '2022-01-03 16:00:00'),
(0, 'ILAW-0000011', '!801-00219', 'Natasha Lingahan', 'w', '159 General Malvar Street San Vicente Biñan City Laguna', '0', '2022-01-03 16:00:00'),
(0, 'ILAW-0000012', 'sdsds', 'sss s s', 'ssdsds', '159 General Malvar Street San Vicente Biñan City Laguna', '0', '2022-01-03 16:00:00'),
(0, 'ILAW-0000013', '1801-8276', 'Leo Libued', '09082879173', 'San Pedro Laguna', '0', '2022-01-03 16:00:00'),
(74, 'ILAW-0000001', '1653', 'ed', '162434', 'cavite', '0', '2021-11-18 08:00:00'),
(75, 'ILAW-0000002', '1653', 'SFSF', '00.1100110', '1010101001', '1', '2021-11-18 08:00:00'),
(76, 'ILAW-0000003', '1653', 'ed', '162434', 'afafasf', '2', '2021-11-18 08:00:00'),
(77, 'ILAW-0000004', '1653', 'SFSF', 'DADASD', 'afasfasfafaf', '3', '2021-11-18 08:00:00'),
(78, 'ILAW-0000005', '1653', 'ed', '162434', 'cavite city', '4', '2021-11-18 08:00:00'),
(79, 'ILAW-0000006', '1653', 'ed', 'DADASD', 'etivac ', '0', '2021-11-19 08:00:00'),
(80, 'ILAW-0000007', 'adad', 'ed', '31336661', 'Cavite', '0', '2021-12-03 08:00:00'),
(0, 'ILAW-0000008', '123', 'Patrick Lingahan', '09567485622', '159 General Malvar Street San Vicente Biñan City Laguna', '0', '2021-12-28 16:00:00'),
(0, 'ILAW-0000009', '1234', 'EFEPANIO DE AMOR LINGAHAN', '09567485622', 'GENERAL MALVAR', '0', '2021-12-28 16:00:00'),
(0, 'ILAW-0000010', '!801-00218', 'Patrick Lingahan', '09567485622', '159 General Malvar Street San Vicente Biñan City Laguna', '0', '2022-01-03 16:00:00'),
(0, 'ILAW-0000011', '!801-00219', 'Natasha Lingahan', 'w', '159 General Malvar Street San Vicente Biñan City Laguna', '0', '2022-01-03 16:00:00'),
(0, 'ILAW-0000012', 'sdsds', 'sss s s', 'ssdsds', '159 General Malvar Street San Vicente Biñan City Laguna', '0', '2022-01-03 16:00:00'),
(0, 'ILAW-0000013', '1801-8276', 'Leo Libued', '09082879173', 'San Pedro Laguna', '0', '2022-01-03 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_product`
--

CREATE TABLE `customer_order_product` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(45) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `unit` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order_product`
--

INSERT INTO `customer_order_product` (`id`, `transaction_id`, `product_name`, `unit`, `quantity`, `price`) VALUES
(19, 'ILAW-0000003', 'LED 5131', 'ml', 4, 5),
(20, 'ILAW-0000004', 'LED 22W Strip', 'cC', 1, 1),
(21, 'ILAW-0000005', 'LED 100W Concert', '50', 5, 3),
(22, 'ILAW-0000006', 'LED 5131', 'ml', 500, 1),
(23, 'ILAW-0000006', '10W Bright Light', 'ml', 100, 3),
(24, 'ILAW-0000007', 'LED 22W Strip', 'ml', 100, 5),
(25, 'ILAW-0000007', 'LED 100W Concert', 'ml', 4, 3),
(26, 'ILAW-0000007', 'LED 22W Strip', '50', 4, 4),
(0, 'ILAW-0000008', 'COB Connector', '2', 5, 5),
(0, 'ILAW-0000008', 'RGB Ceiling Light', '2', 6, 4),
(0, 'ILAW-0000008', 'TY Led', '4', 12, 9),
(0, 'ILAW-0000009', 'TY Led', '2', 2, 232),
(0, 'ILAW-0000009', 'COB Strip Light', '2', 4, 333),
(0, 'ILAW-0000009', 'SMD 3528', '3', 4, 2134),
(0, 'ILAW-0000010', 'COB Connector', '2', 5, 5),
(0, 'ILAW-0000010', 'COB Connector', '2', 4, 565),
(0, 'ILAW-0000011', 'COB Connector', '2', 2, 500),
(0, 'ILAW-0000011', 'TY Led', '3', 5, 450),
(0, 'ILAW-0000012', 'COB Connector', '8', 2, 4324),
(0, 'ILAW-0000013', 'SMD 3528', '4', 2, 760),
(0, 'ILAW-0000013', 'RGB Ceiling Light', '2', 10, 450),
(19, 'ILAW-0000003', 'LED 5131', 'ml', 4, 5),
(20, 'ILAW-0000004', 'LED 22W Strip', 'cC', 1, 1),
(21, 'ILAW-0000005', 'LED 100W Concert', '50', 5, 3),
(22, 'ILAW-0000006', 'LED 5131', 'ml', 500, 1),
(23, 'ILAW-0000006', '10W Bright Light', 'ml', 100, 3),
(24, 'ILAW-0000007', 'LED 22W Strip', 'ml', 100, 5),
(25, 'ILAW-0000007', 'LED 100W Concert', 'ml', 4, 3),
(26, 'ILAW-0000007', 'LED 22W Strip', '50', 4, 4),
(0, 'ILAW-0000008', 'COB Connector', '2', 5, 5),
(0, 'ILAW-0000008', 'RGB Ceiling Light', '2', 6, 4),
(0, 'ILAW-0000008', 'TY Led', '4', 12, 9),
(0, 'ILAW-0000009', 'TY Led', '2', 2, 232),
(0, 'ILAW-0000009', 'COB Strip Light', '2', 4, 333),
(0, 'ILAW-0000009', 'SMD 3528', '3', 4, 2134),
(0, 'ILAW-0000010', 'COB Connector', '2', 5, 5),
(0, 'ILAW-0000010', 'COB Connector', '2', 4, 565),
(0, 'ILAW-0000011', 'COB Connector', '2', 2, 500),
(0, 'ILAW-0000011', 'TY Led', '3', 5, 450),
(0, 'ILAW-0000012', 'COB Connector', '8', 2, 4324),
(0, 'ILAW-0000013', 'SMD 3528', '4', 2, 760),
(0, 'ILAW-0000013', 'RGB Ceiling Light', '2', 10, 450);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_order`
--

CREATE TABLE `inventory_order` (
  `inventory_order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `inventory_order_total` double(10,2) NOT NULL,
  `inventory_order_date` date NOT NULL,
  `inventory_order_name` varchar(255) NOT NULL,
  `inventory_order_address` text NOT NULL,
  `payment_status` enum('cash','credit') NOT NULL,
  `inventory_order_status` varchar(100) NOT NULL,
  `inventory_order_created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_order`
--

INSERT INTO `inventory_order` (`inventory_order_id`, `user_id`, `inventory_order_total`, `inventory_order_date`, `inventory_order_name`, `inventory_order_address`, `payment_status`, `inventory_order_status`, `inventory_order_created_date`) VALUES
(1, 7, 4939.20, '2017-11-08', 'David Harper', '3188 Straford Park\r\nHarold, KY 41635', 'credit', 'active', '2017-11-08'),
(2, 7, 1310.40, '2017-11-08', 'Trevor Webster', '4275 Indiana Avenue\r\nHonolulu, HI 96816', 'cash', 'active', '2017-11-08'),
(3, 6, 265.65, '2017-11-08', 'Russell Barrett', '4687 Powder House Road\r\nJupiter, FL 33478', 'cash', 'active', '2017-11-08'),
(4, 6, 1546.80, '2017-11-08', 'Doloris Turner', '3057 Collins Avenue\r\nWesterville, OH 43081', 'credit', 'active', '2017-11-08'),
(5, 5, 1409.00, '2017-11-08', 'Georgette Blevins', '863 Simpson Avenue\r\nSteelton, PA 17113', 'cash', 'active', '2017-11-08'),
(6, 5, 558.90, '2017-11-08', 'Nancy Brook', '3460 Viking Drive\r\nBarnesville, OH 43713', 'credit', 'active', '2017-11-08'),
(7, 4, 1286.25, '2017-11-08', 'Joseph Smith', '190 Metz Lane\r\nCharlestown, MA 02129', 'cash', 'active', '2017-11-08'),
(8, 4, 1520.00, '2017-11-08', 'Maria Lafleur', '3878 Elkview Drive\r\nPort St Lucie, FL 33452', 'credit', 'active', '2017-11-08'),
(9, 4, 1604.00, '2017-11-08', 'David Smith', '4757 Little Acres Lane\r\nLoraine, IL 62349', 'cash', 'active', '2017-11-08'),
(10, 3, 1724.80, '2017-11-08', 'Michelle Hayes', '1140 C Street\r\nWorcester, MA 01609', 'cash', 'active', '2017-11-08'),
(11, 3, 1859.40, '2017-11-08', 'Brenna Hamilton', '2845 Davis Avenue\r\nPetaluma, CA 94952', 'cash', 'active', '2017-11-08'),
(12, 3, 2038.40, '2017-11-08', 'Robbie McKenzie', '3016 Horizon Circle\r\nEatonville, WA 98328', 'credit', 'active', '2017-11-08'),
(13, 2, 573.00, '2017-11-08', 'Jonathan Allen', '2426 Evergreen Lane\r\nAlhambra, CA 91801', 'cash', 'active', '2017-11-08'),
(14, 2, 1196.35, '2017-11-08', 'Mildred Paige', '3167 Oakway Lane\r\nReseda, CA 91335', 'cash', 'active', '2017-11-08'),
(15, 2, 1960.00, '2017-11-08', 'Elva Lott', '4032 Aaron Smith Drive\r\nHarrisburg, PA 17111', 'credit', 'active', '2017-11-08'),
(16, 2, 2700.00, '2017-11-08', 'Eric Johnson', '616 Devils Hill Road\r\nJackson, MS 39213', 'cash', 'active', '2017-11-08'),
(17, 1, 5615.20, '2017-11-09', 'Doris Oliver', '2992 Sycamore Fork Road Hopkins, MN 55343', 'cash', 'active', '2017-11-09'),
(26, 1, 2278.50, '2017-11-27', 'Janet Richardsons', '4799 Ryder Avenue Everett, WA 98210', 'credit', 'inactive', '2017-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_order_product`
--

CREATE TABLE `inventory_order_product` (
  `inventory_order_product_id` int(11) NOT NULL,
  `inventory_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `tax` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_order_product`
--

INSERT INTO `inventory_order_product` (`inventory_order_product_id`, `inventory_order_id`, `product_id`, `quantity`, `price`, `tax`) VALUES
(3, 1, 1, 10, 141.00, 12.00),
(4, 1, 3, 4, 800.00, 5.00),
(5, 2, 2, 3, 350.00, 12.00),
(6, 2, 17, 2, 60.00, 12.00),
(7, 3, 15, 1, 125.00, 5.00),
(8, 3, 17, 2, 60.00, 12.00),
(12, 4, 18, 4, 90.00, 12.00),
(13, 4, 20, 3, 100.00, 18.00),
(14, 4, 1, 5, 141.00, 12.00),
(15, 5, 4, 2, 550.00, 12.00),
(16, 5, 10, 1, 150.00, 18.00),
(17, 6, 8, 5, 15.00, 18.00),
(18, 6, 7, 2, 210.00, 12.00),
(19, 7, 16, 7, 175.00, 5.00),
(23, 8, 19, 5, 120.00, 18.00),
(24, 8, 11, 5, 85.00, 12.00),
(25, 8, 12, 5, 60.00, 12.00),
(26, 9, 13, 3, 200.00, 18.00),
(27, 9, 9, 2, 400.00, 12.00),
(28, 10, 9, 3, 400.00, 12.00),
(29, 10, 11, 4, 85.00, 12.00),
(30, 11, 6, 6, 250.00, 15.00),
(31, 11, 12, 2, 60.00, 12.00),
(32, 12, 2, 4, 350.00, 12.00),
(33, 12, 7, 2, 210.00, 12.00),
(34, 13, 18, 3, 90.00, 12.00),
(35, 13, 7, 1, 210.00, 12.00),
(36, 13, 8, 2, 15.00, 18.00),
(37, 14, 6, 2, 250.00, 15.00),
(38, 14, 13, 1, 200.00, 18.00),
(39, 14, 16, 1, 175.00, 5.00),
(40, 14, 17, 3, 60.00, 12.00),
(41, 15, 2, 5, 350.00, 12.00),
(42, 16, 4, 4, 550.00, 12.00),
(43, 16, 13, 1, 200.00, 18.00),
(46, 17, 21, 2, 500.00, 18.00),
(47, 17, 3, 5, 800.00, 5.00),
(48, 17, 7, 1, 210.00, 12.00),
(49, 0, 23, 5, 30.00, 12.00),
(50, 0, 12, 5, 60.00, 12.00),
(51, 0, 16, 5, 175.00, 5.00),
(52, 0, 6, 5, 250.00, 15.00),
(53, 0, 16, 5, 175.00, 5.00),
(54, 0, 7, 5, 210.00, 12.00),
(55, 0, 7, 5, 210.00, 12.00),
(56, 0, 7, 5, 210.00, 12.00),
(57, 25, 14, 5, 250.00, 18.00),
(58, 25, 11, 5, 85.00, 12.00),
(79, 26, 16, 6, 175.00, 5.00),
(80, 26, 7, 5, 210.00, 12.00),
(81, 0, 11, 2, 85.00, 12.00),
(82, 0, 11, 2, 85.00, 12.00),
(83, 0, 11, 2, 85.00, 12.00);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `items_id` int(11) NOT NULL,
  `items_name` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `items_cost` double NOT NULL,
  `items_price` double NOT NULL,
  `items_stocks` int(11) NOT NULL,
  `items_low` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `measurement_id` int(11) NOT NULL,
  `items_description` varchar(500) NOT NULL,
  `product_img1` varchar(255) NOT NULL,
  `product_img2` varchar(255) NOT NULL,
  `items_status` varchar(25) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `items_name`, `category_id`, `items_cost`, `items_price`, `items_stocks`, `items_low`, `supplier_id`, `measurement_id`, `items_description`, `product_img1`, `product_img2`, `items_status`, `datecreated`) VALUES
(19, 'RGB Ceiling Light', 21, 870, 900, 40, 20, 21, 17, '', '', '', 'active', '2021-10-21 09:28:58'),
(20, 'SMD 3528', 1, 870, 900, 311, 20, 21, 5, '', '', '', 'active', '2021-10-21 09:29:58'),
(21, 'LED REd Monitor', 14, 870, 900, 311, 20, 21, 18, '', '', '', 'active', '2021-10-21 09:39:31'),
(22, 'Mega Strip Light', 13, 870, 900, 10, 60, 21, 18, '', '', '', 'active', '2021-10-21 09:52:57'),
(23, 'LED Strip Light', 1, 870, 900, 2, 20, 21, 3, '', '', '', 'active', '2021-10-21 10:18:55'),
(24, 'TY Led', 10, 870, 900, 80, 40, 17, 3, '', '', '', 'active', '2021-10-21 10:20:17'),
(25, 'Ring Light', 7, 250, 350, 311, 60, 16, 18, '', '', '', 'active', '2021-10-22 03:34:15'),
(26, 'COB Strip Light', 8, 750, 800, 400, 60, 17, 3, '', '', '', 'active', '2021-11-05 08:49:24'),
(27, 'New RGB', 8, 750, 800, 311, 60, 21, 3, '', 'Clothe 1.png', 'COG_Lingahan.png', 'active', '2022-01-31 11:23:53'),
(28, 'SMD 3528', 21, 250, 900, 311, 60, 17, 3, '', 'Clothe 1.png', 'COG_LingahanJP.png', 'active', '2022-01-31 11:27:00'),
(29, 'RGB Ceiling Light', 21, 250, 170, 40, 20, 22, 17, '', 'Clothe 1.png', 'COG_Lingahan.png', 'active', '2022-01-31 11:32:11'),
(30, 'RGB Ceiling Light', 8, 870, 900, 311, 60, 17, 17, '', 'Full_v1.png', 'fire.png', 'active', '2022-01-31 13:35:30'),
(31, 'RGB Ceiling Light', 21, 250, 800, 600, 60, 17, 3, '', 'Hearts.png', 'MH.png', 'active', '2022-01-31 14:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `action` varchar(250) NOT NULL,
  `user` varchar(25) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `measurement`
--

CREATE TABLE `measurement` (
  `measurement_id` int(11) NOT NULL,
  `measurement_name` varchar(250) NOT NULL,
  `measurement_status` enum('active','inactive') NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `measurement`
--

INSERT INTO `measurement` (`measurement_id`, `measurement_name`, `measurement_status`, `datecreated`) VALUES
(3, 'Box', 'active', '2021-09-19 03:17:53'),
(5, 'Per Meter', 'active', '2021-09-19 09:13:27'),
(17, 'Bundle', 'active', '2021-09-20 03:24:04'),
(18, 'Per Piece', 'active', '2021-10-19 08:30:54'),
(19, 'Container', 'active', '2021-10-19 10:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `product_description` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_unit` varchar(150) NOT NULL,
  `product_base_price` double(10,2) NOT NULL,
  `product_tax` decimal(4,2) NOT NULL,
  `product_minimum_order` double(10,2) NOT NULL,
  `product_enter_by` int(11) NOT NULL,
  `product_status` enum('active','inactive') NOT NULL,
  `product_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_description`, `product_quantity`, `product_unit`, `product_base_price`, `product_tax`, `product_minimum_order`, `product_enter_by`, `product_status`, `product_date`) VALUES
(1, 1, 1, '4W LED Bulb', 'Base Type	B22, E27\r\nBulb Material	Aluminium\r\nItem Width	5 (cm)\r\nItem Height	10 (cm)\r\nItem Weight	0.07 (kg)', 100, 'Nos', 141.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(2, 1, 3, '17W B22 LED Bulb', 'Item Height	14.2 (cm)\r\nColor Temperature (Kelvin)	6500\r\nItem Weight	0.19 (kg)\r\nBulb Material	Aluminium\r\nBase Color	Aluminium\r\nVoltage	240\r\nUsages	Household, Commercial, Kitchen', 150, 'Nos', 350.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(3, 8, 5, '18W LED Ceiling Light', 'Round Ceiling Light 18w', 75, 'Nos', 800.00, '5.00', 0.00, 1, 'active', '2017-11-08'),
(4, 8, 4, 'Round LED Ceiling Light', 'Relying on our expertise in this domain, we are into offering Round LED Ceiling Light.	', 50, 'Nos', 550.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(5, 6, 6, '7W LED Concealed Light', 'Dimension \'3\" \'\r\n50000 hours burning life\r\ncost effective\r\nhigh quality led', 85, 'Nos', 240.00, '15.00', 0.00, 1, 'active', '2017-11-08'),
(6, 6, 7, '9w LED Concealed Light', 'dimension \'3\" \'\r\n50000 hours burning life\r\ncost effective\r\nhigh quality led', 65, 'Nos', 250.00, '15.00', 0.00, 1, 'active', '2017-11-08'),
(7, 10, 9, '24W Street Light Led Driver', 'Dc Voltage	36v\r\nRated Current	600ma\r\nRated Power	22w', 120, 'Nos', 210.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(8, 10, 8, 'BP1601 ICs', 'Backed by immense industry-experience & latest designing techniques, we are engaged in providing BP1601 ICs.', 200, 'Nos', 15.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(9, 3, 11, '5W LED Square Downlight', 'Wattage: 5 Watt\r\nInput Voltage: 150V to 265V, 50/60Hz\r\nLumens: 500 lumen (approx)\r\nPower Factor: 0.90pf', 50, 'Nos', 400.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(10, 3, 10, '10W LED Square Downlight', 'Wattage: 10 Watt\r\nInput Voltage: 150V to 265V, 50/60Hz\r\nLumens: 1000 lumen (approx)\r\nPower Factor: 0.90pf', 40, 'Nos', 150.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(11, 5, 13, ' 9w Deluxe LED Lamp', 'Lighting Color	Cool Daylight\r\nBase Type	B22', 100, 'Nos', 85.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(12, 5, 12, '5w LED Lamp', 'Lighting Color	Cool Daylight\r\nBody Material	Aluminum\r\nBase Type	B22', 75, 'Nos', 60.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(13, 2, 14, '15W Big LED Bay Light', 'Wattage: 15 Watt\r\nInput Voltage: 100V - 265V, 50/60Hz\r\nLumens: 1500 lumen (approx)\r\nPower Factor: 0.90pf', 60, 'Nos', 200.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(14, 2, 15, '15W Small LED Bay Light', 'Wattage: 15 Watt\r\nInput Voltage: 100V -265V, 50/60Hz\r\nLumens: 1500 lumen (approx)\r\nPower Factor: 0.90pf', 55, 'Nos', 250.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(15, 4, 16, '12W LED Panel Light', 'Body Material	Aluminum\r\nLighting Type	LED\r\nApplications	Hotel, House, etc', 85, 'Nos', 125.00, '5.00', 0.00, 1, 'active', '2017-11-08'),
(16, 4, 17, '15W LED Panel Light', 'IP Rating	IP40\r\nBody Material	Aluminum\r\nLighting Type	LED', 40, 'Nos', 175.00, '5.00', 0.00, 1, 'active', '2017-11-08'),
(17, 7, 19, '3W Round LED Spotlight', 'Lighting Color	Cool White\r\nBody Material	Aluminum\r\nCertification	ISO\r\nInput Voltage(V)	12 V\r\nIP Rating	IP33, IP40, IP44', 100, 'Nos', 60.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(18, 7, 18, '3W Square LED Spotlight', 'Lighting Color	Cool White\r\nBody Material	Aluminum\r\nInput Voltage(V)	12 V\r\nIP Rating	IP33, IP40', 85, 'Nos', 90.00, '12.00', 0.00, 1, 'active', '2017-11-08'),
(19, 9, 20, '18W LED Tube Light', 'Tube Base Type	T5\r\nIP Rating	IP66', 180, 'Nos', 120.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(20, 9, 21, '10W Ready Tube Light', 'Body Material	Aluminum, Ceramic\r\nPower	10W', 200, 'Nos', 100.00, '18.00', 0.00, 1, 'active', '2017-11-08'),
(21, 11, 22, '90W LED Flood Lights', 'Lighting Color	Cool White, Pure White, Warm White\r\nBody Material	Ceramic, Chrome, Iron\r\nIP Rating	IP33, IP40, IP44, IP55, IP66', 20, 'Nos', 500.00, '18.00', 0.00, 1, 'active', '2017-11-09'),
(23, 1, 3, '15 Watt LED Bulb', '15 Watt LED Bulb', 150, 'Nos', 30.00, '12.00', 0.00, 1, 'active', '2017-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `title_review` varchar(200) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_name`, `user_rating`, `title_review`, `user_review`, `datetime`) VALUES
(76, 'Best Jeanist', 5, 'RGB Red Light', 'The items are so cool! <3', '2021-12-04 11:05:08'),
(77, 'Endeavor', 5, 'COB LED LIGHT', 'Magnificent!!', '2021-12-04 11:05:44'),
(78, 'All Might', 4, 'COB LED LIGHT', 'Nice I can order more soon', '2021-12-04 11:06:10'),
(79, 'The Anonymous', 5, 'Red Light, Green Light', 'When it comes to online reviews, a high star rating isn’t enough to set your business apart from the competition. Without written reviews, a star rating (no matter how high) falls flat. The average consumer spends 13 minutes and 45 seconds reading through reviews and review responses before making a decision. The right review response from your business can make a 5-star review even more powerful and minimize the damage of a negative one.\n', '2021-12-06 03:12:11'),
(80, 'Natasha', 4, 'Mcdo', 'Super good', '2021-12-11 07:45:38'),
(81, 'Meiji', 4, 'RGB Red Light', 'Its okay...', '2022-01-07 06:29:15'),
(82, 'Natasha', 5, 'French fries', 'Gooooooodddddd yummyyyy', '2022-01-13 07:41:36'),
(83, 'Cleopatra0909', 4, 'RGB Red Light', 'Lights are amazing!!!!!!!!\n', '2022-01-27 07:46:36'),
(84, 'Diego', 3, 'COB Led Light', '50-50 I received it without the box', '2022-01-30 07:34:55'),
(85, 'ty', 4, 'COB LIGHT', 'dsds', '2022-02-03 10:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `address` varchar(300) CHARACTER SET latin1 NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `contact_no`, `address`, `datecreated`) VALUES
(16, 'ZeBeDee', '09567485622', 'Carmona Estates', '2021-10-19 10:34:42'),
(17, 'Kisame', '09087228409', 'Carmona Estates', '2021-10-19 10:35:49'),
(21, 'Elegant Lighting', '09372615812', '159 General Malvar Street San Vicente Biñan City Laguna', '2021-10-21 09:33:59'),
(22, 'Lalamove', '09278176241', 'Carmona Estates', '2021-11-15 02:09:35'),
(23, 'LongAgo', '09278176241', 'Biñan City', '2021-11-26 17:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `table_municipality`
--

CREATE TABLE `table_municipality` (
  `municipality_id` int(11) NOT NULL,
  `province_id` int(11) DEFAULT NULL,
  `municipality_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_municipality`
--

INSERT INTO `table_municipality` (`municipality_id`, `province_id`, `municipality_name`) VALUES
(1356, 1, 'Caloocan City'),
(1360, 1, 'Las Piñas City'),
(1361, 1, 'Makati City'),
(1357, 1, 'Malabon City'),
(1351, 1, 'Mandaluyong City'),
(1350, 1, 'Manila'),
(1352, 1, 'Marikina City'),
(1362, 1, 'Muntinlupa City'),
(1358, 1, 'Navotas City'),
(1363, 1, 'Parañaque City'),
(1364, 1, 'Pasay City'),
(1353, 1, 'Pasig City'),
(1365, 1, 'Pateros'),
(1354, 1, 'Quezon City'),
(1355, 1, 'San Juan City'),
(1366, 1, 'Taguig City'),
(1359, 1, 'Valenzuela City'),
(1, 2, 'Adams'),
(2, 2, 'Bacarra'),
(3, 2, 'Badoc'),
(4, 2, 'Bangui'),
(11, 2, 'Banna'),
(6, 2, 'Burgos'),
(7, 2, 'Carasi'),
(5, 2, 'City of Batac'),
(12, 2, 'City of Laoag (Capital)'),
(8, 2, 'Currimao'),
(9, 2, 'Dingras'),
(10, 2, 'Dumalneg'),
(13, 2, 'Marcos'),
(14, 2, 'Nueva Era'),
(15, 2, 'Pagudpud'),
(16, 2, 'Paoay'),
(17, 2, 'Pasuquin'),
(18, 2, 'Piddig'),
(19, 2, 'Pinili'),
(20, 2, 'San Nicolas'),
(21, 2, 'Sarrat'),
(22, 2, 'Solsona'),
(23, 2, 'Vintar'),
(24, 3, 'Alilem'),
(25, 3, 'Banayoyo'),
(26, 3, 'Bantay'),
(27, 3, 'Burgos'),
(28, 3, 'Cabugao'),
(30, 3, 'Caoayan'),
(31, 3, 'Cervantes'),
(29, 3, 'City of Candon'),
(57, 3, 'City of Vigan (Capital)'),
(32, 3, 'Galimuyod'),
(33, 3, 'Gregorio del Pilar'),
(34, 3, 'Lidlidda'),
(35, 3, 'Magsingal'),
(36, 3, 'Nagbukel'),
(37, 3, 'Narvacan'),
(38, 3, 'Quirino'),
(39, 3, 'Salcedo'),
(40, 3, 'San Emilio'),
(41, 3, 'San Esteban'),
(42, 3, 'San Ildefonso'),
(43, 3, 'San Juan'),
(44, 3, 'San Vicente'),
(45, 3, 'Santa'),
(46, 3, 'Santa Catalina'),
(47, 3, 'Santa Cruz'),
(48, 3, 'Santa Lucia'),
(49, 3, 'Santa Maria'),
(50, 3, 'Santiago'),
(51, 3, 'Santo Domingo'),
(52, 3, 'Sigay'),
(53, 3, 'Sinait'),
(54, 3, 'Sugpon'),
(55, 3, 'Suyo'),
(56, 3, 'Tagudin'),
(58, 4, 'Agoo'),
(59, 4, 'Aringay'),
(60, 4, 'Bacnotan'),
(61, 4, 'Bagulin'),
(62, 4, 'Balaoan'),
(63, 4, 'Bangar'),
(64, 4, 'Bauang'),
(65, 4, 'Burgos'),
(66, 4, 'Caba'),
(71, 4, 'City of San Fernando (Capital)'),
(67, 4, 'Luna'),
(68, 4, 'Naguilian'),
(69, 4, 'Pugo'),
(70, 4, 'Rosario'),
(72, 4, 'San Gabriel'),
(73, 4, 'San Juan'),
(74, 4, 'Santo Tomas'),
(75, 4, 'Santol'),
(76, 4, 'Sudipen'),
(77, 4, 'Tubao'),
(78, 5, 'Agno'),
(79, 5, 'Aguilar'),
(81, 5, 'Alcala'),
(82, 5, 'Anda'),
(83, 5, 'Asingan'),
(84, 5, 'Balungao'),
(85, 5, 'Bani'),
(86, 5, 'Basista'),
(87, 5, 'Bautista'),
(88, 5, 'Bayambang'),
(89, 5, 'Binalonan'),
(90, 5, 'Binmaley'),
(91, 5, 'Bolinao'),
(92, 5, 'Bugallon'),
(93, 5, 'Burgos'),
(94, 5, 'Calasiao'),
(80, 5, 'City of Alaminos'),
(95, 5, 'City of Dagupan'),
(109, 5, 'City of San Carlos'),
(123, 5, 'City of Urdaneta'),
(96, 5, 'Dasol'),
(97, 5, 'Infanta'),
(98, 5, 'Labrador'),
(125, 5, 'Laoac'),
(99, 5, 'Lingayen (Capital)'),
(100, 5, 'Mabini'),
(101, 5, 'Malasiqui'),
(102, 5, 'Manaoag'),
(103, 5, 'Mangaldan'),
(104, 5, 'Mangatarem'),
(105, 5, 'Mapandan'),
(106, 5, 'Natividad'),
(107, 5, 'Pozorrubio'),
(108, 5, 'Rosales'),
(110, 5, 'San Fabian'),
(111, 5, 'San Jacinto'),
(112, 5, 'San Manuel'),
(113, 5, 'San Nicolas'),
(114, 5, 'San Quintin'),
(115, 5, 'Santa Barbara'),
(116, 5, 'Santa Maria'),
(117, 5, 'Santo Tomas'),
(118, 5, 'Sison'),
(119, 5, 'Sual'),
(120, 5, 'Tayug'),
(121, 5, 'Umingan'),
(122, 5, 'Urbiztondo'),
(124, 5, 'Villasis'),
(126, 6, 'Basco (Capital)'),
(127, 6, 'Itbayat'),
(128, 6, 'Ivana'),
(129, 6, 'Mahatao'),
(130, 6, 'Sabtang'),
(131, 6, 'Uyugan'),
(132, 7, 'Abulug'),
(133, 7, 'Alcala'),
(134, 7, 'Allacapan'),
(135, 7, 'Amulung'),
(136, 7, 'Aparri'),
(137, 7, 'Baggao'),
(138, 7, 'Ballesteros'),
(139, 7, 'Buguey'),
(140, 7, 'Calayan'),
(141, 7, 'Camalaniugan'),
(142, 7, 'Claveria'),
(143, 7, 'Enrile'),
(144, 7, 'Gattaran'),
(145, 7, 'Gonzaga'),
(146, 7, 'Iguig'),
(147, 7, 'Lal-Lo'),
(148, 7, 'Lasam'),
(149, 7, 'Pamplona'),
(150, 7, 'Peñablanca'),
(151, 7, 'Piat'),
(152, 7, 'Rizal'),
(153, 7, 'Sanchez-Mira'),
(154, 7, 'Santa Ana'),
(155, 7, 'Santa Praxedes'),
(156, 7, 'Santa Teresita'),
(157, 7, 'Santo Niño'),
(158, 7, 'Solana'),
(159, 7, 'Tuao'),
(160, 7, 'Tuguegarao City (Capital)'),
(161, 8, 'Alicia'),
(162, 8, 'Angadanan'),
(163, 8, 'Aurora'),
(164, 8, 'Benito Soliven'),
(165, 8, 'Burgos'),
(166, 8, 'Cabagan'),
(167, 8, 'Cabatuan'),
(168, 8, 'City of Cauayan'),
(174, 8, 'City of Ilagan (Capital)'),
(195, 8, 'City of Santiago'),
(169, 8, 'Cordon'),
(178, 8, 'Delfin Albano'),
(170, 8, 'Dinapigue'),
(171, 8, 'Divilacan'),
(172, 8, 'Echague'),
(173, 8, 'Gamu'),
(175, 8, 'Jones'),
(176, 8, 'Luna'),
(177, 8, 'Maconacon'),
(179, 8, 'Mallig'),
(180, 8, 'Naguilian'),
(181, 8, 'Palanan'),
(182, 8, 'Quezon'),
(183, 8, 'Quirino'),
(184, 8, 'Ramon'),
(185, 8, 'Reina Mercedes'),
(186, 8, 'Roxas'),
(187, 8, 'San Agustin'),
(188, 8, 'San Guillermo'),
(189, 8, 'San Isidro'),
(190, 8, 'San Manuel'),
(191, 8, 'San Mariano'),
(192, 8, 'San Mateo'),
(193, 8, 'San Pablo'),
(194, 8, 'Santa Maria'),
(196, 8, 'Santo Tomas'),
(197, 8, 'Tumauini'),
(212, 9, 'Alfonso Castaneda'),
(198, 9, 'Ambaguio'),
(199, 9, 'Aritao'),
(200, 9, 'Bagabag'),
(201, 9, 'Bambang'),
(202, 9, 'Bayombong (Capital)'),
(203, 9, 'Diadi'),
(204, 9, 'Dupax del Norte'),
(205, 9, 'Dupax del Sur'),
(206, 9, 'Kasibu'),
(207, 9, 'Kayapa'),
(208, 9, 'Quezon'),
(209, 9, 'Santa Fe'),
(210, 9, 'Solano'),
(211, 9, 'Villaverde'),
(213, 10, 'Aglipay'),
(214, 10, 'Cabarroguis (Capital)'),
(215, 10, 'Diffun'),
(216, 10, 'Maddela'),
(218, 10, 'Nagtipunan'),
(217, 10, 'Saguday'),
(219, 11, 'Abucay'),
(220, 11, 'Bagac'),
(221, 11, 'City of Balanga (Capital)'),
(222, 11, 'Dinalupihan'),
(223, 11, 'Hermosa'),
(224, 11, 'Limay'),
(225, 11, 'Mariveles'),
(226, 11, 'Morong'),
(227, 11, 'Orani'),
(228, 11, 'Orion'),
(229, 11, 'Pilar'),
(230, 11, 'Samal'),
(231, 12, 'Angat'),
(232, 12, 'Balagtas'),
(233, 12, 'Baliuag'),
(234, 12, 'Bocaue'),
(235, 12, 'Bulacan'),
(236, 12, 'Bustos'),
(237, 12, 'Calumpit'),
(240, 12, 'City of Malolos (Capital)'),
(242, 12, 'City of Meycauayan'),
(250, 12, 'City of San Jose Del Monte'),
(254, 12, 'Doña Remedios Trinidad'),
(238, 12, 'Guiguinto'),
(239, 12, 'Hagonoy'),
(241, 12, 'Marilao'),
(243, 12, 'Norzagaray'),
(244, 12, 'Obando'),
(245, 12, 'Pandi'),
(246, 12, 'Paombong'),
(247, 12, 'Plaridel'),
(248, 12, 'Pulilan'),
(249, 12, 'San Ildefonso'),
(251, 12, 'San Miguel'),
(252, 12, 'San Rafael'),
(253, 12, 'Santa Maria'),
(255, 13, 'Aliaga'),
(256, 13, 'Bongabon'),
(258, 13, 'Cabiao'),
(259, 13, 'Carranglan'),
(257, 13, 'City of Cabanatuan'),
(262, 13, 'City of Gapan'),
(273, 13, 'City of Palayan (Capital)'),
(260, 13, 'Cuyapo'),
(261, 13, 'Gabaldon'),
(263, 13, 'General Mamerto Natividad'),
(264, 13, 'General Tinio'),
(265, 13, 'Guimba'),
(266, 13, 'Jaen'),
(267, 13, 'Laur'),
(268, 13, 'Licab'),
(269, 13, 'Llanera'),
(270, 13, 'Lupao'),
(272, 13, 'Nampicuan'),
(274, 13, 'Pantabangan'),
(275, 13, 'Peñaranda'),
(276, 13, 'Quezon'),
(277, 13, 'Rizal'),
(278, 13, 'San Antonio'),
(279, 13, 'San Isidro'),
(280, 13, 'San Jose City'),
(281, 13, 'San Leonardo'),
(282, 13, 'Santa Rosa'),
(283, 13, 'Santo Domingo'),
(271, 13, 'Science City of Muñoz'),
(284, 13, 'Talavera'),
(285, 13, 'Talugtug'),
(286, 13, 'Zaragoza'),
(288, 14, 'Apalit'),
(289, 14, 'Arayat'),
(290, 14, 'Bacolor'),
(291, 14, 'Candaba'),
(287, 14, 'City of Angeles'),
(302, 14, 'City of San Fernando (Capital)'),
(292, 14, 'Floridablanca'),
(293, 14, 'Guagua'),
(294, 14, 'Lubao'),
(295, 14, 'Mabalacat City'),
(296, 14, 'Macabebe'),
(297, 14, 'Magalang'),
(298, 14, 'Masantol'),
(299, 14, 'Mexico'),
(300, 14, 'Minalin'),
(301, 14, 'Porac'),
(303, 14, 'San Luis'),
(304, 14, 'San Simon'),
(305, 14, 'Santa Ana'),
(306, 14, 'Santa Rita'),
(307, 14, 'Santo Tomas'),
(308, 14, 'Sasmuan'),
(309, 15, 'Anao'),
(310, 15, 'Bamban'),
(311, 15, 'Camiling'),
(312, 15, 'Capas'),
(324, 15, 'City of Tarlac (Capital)'),
(313, 15, 'Concepcion'),
(314, 15, 'Gerona'),
(315, 15, 'La Paz'),
(316, 15, 'Mayantoc'),
(317, 15, 'Moncada'),
(318, 15, 'Paniqui'),
(319, 15, 'Pura'),
(320, 15, 'Ramos'),
(321, 15, 'San Clemente'),
(326, 15, 'San Jose'),
(322, 15, 'San Manuel'),
(323, 15, 'Santa Ignacia'),
(325, 15, 'Victoria'),
(327, 16, 'Botolan'),
(328, 16, 'Cabangan'),
(329, 16, 'Candelaria'),
(330, 16, 'Castillejos'),
(333, 16, 'City of Olongapo'),
(331, 16, 'Iba (Capital)'),
(332, 16, 'Masinloc'),
(334, 16, 'Palauig'),
(335, 16, 'San Antonio'),
(336, 16, 'San Felipe'),
(337, 16, 'San Marcelino'),
(338, 16, 'San Narciso'),
(339, 16, 'Santa Cruz'),
(340, 16, 'Subic'),
(341, 17, 'Baler (Capital)'),
(342, 17, 'Casiguran'),
(343, 17, 'Dilasag'),
(344, 17, 'Dinalungan'),
(345, 17, 'Dingalan'),
(346, 17, 'Dipaculao'),
(347, 17, 'Maria Aurora'),
(348, 17, 'San Luis'),
(349, 18, 'Agoncillo'),
(350, 18, 'Alitagtag'),
(351, 18, 'Balayan'),
(352, 18, 'Balete'),
(353, 18, 'Batangas City (Capital)'),
(354, 18, 'Bauan'),
(355, 18, 'Calaca'),
(356, 18, 'Calatagan'),
(362, 18, 'City of Lipa'),
(376, 18, 'City of Sto. Tomas'),
(379, 18, 'City of Tanauan'),
(357, 18, 'Cuenca'),
(358, 18, 'Ibaan'),
(359, 18, 'Laurel'),
(360, 18, 'Lemery'),
(361, 18, 'Lian'),
(363, 18, 'Lobo'),
(364, 18, 'Mabini'),
(365, 18, 'Malvar'),
(366, 18, 'Mataasnakahoy'),
(367, 18, 'Nasugbu'),
(368, 18, 'Padre Garcia'),
(369, 18, 'Rosario'),
(370, 18, 'San Jose'),
(371, 18, 'San Juan'),
(372, 18, 'San Luis'),
(373, 18, 'San Nicolas'),
(374, 18, 'San Pascual'),
(375, 18, 'Santa Teresita'),
(377, 18, 'Taal'),
(378, 18, 'Talisay'),
(380, 18, 'Taysan'),
(381, 18, 'Tingloy'),
(382, 18, 'Tuy'),
(383, 19, 'Alfonso'),
(384, 19, 'Amadeo'),
(386, 19, 'Carmona'),
(385, 19, 'City of Bacoor'),
(387, 19, 'City of Cavite'),
(388, 19, 'City of Dasmariñas'),
(390, 19, 'City of General Trias'),
(391, 19, 'City of Imus'),
(401, 19, 'City of Tagaytay'),
(404, 19, 'City of Trece Martires (Capital)'),
(405, 19, 'Gen. Mariano Alvarez'),
(389, 19, 'General Emilio Aguinaldo'),
(392, 19, 'Indang'),
(393, 19, 'Kawit'),
(394, 19, 'Magallanes'),
(395, 19, 'Maragondon'),
(396, 19, 'Mendez'),
(397, 19, 'Naic'),
(398, 19, 'Noveleta'),
(399, 19, 'Rosario'),
(400, 19, 'Silang'),
(402, 19, 'Tanza'),
(403, 19, 'Ternate'),
(406, 20, 'Alaminos'),
(407, 20, 'Bay'),
(411, 20, 'Calauan'),
(412, 20, 'Cavinti'),
(408, 20, 'City of Biñan'),
(409, 20, 'City of Cabuyao'),
(410, 20, 'City of Calamba'),
(429, 20, 'City of San Pablo'),
(430, 20, 'City of San Pedro'),
(433, 20, 'City of Santa Rosa'),
(413, 20, 'Famy'),
(414, 20, 'Kalayaan'),
(415, 20, 'Liliw'),
(416, 20, 'Los Baños'),
(417, 20, 'Luisiana'),
(418, 20, 'Lumban'),
(419, 20, 'Mabitac'),
(420, 20, 'Magdalena'),
(421, 20, 'Majayjay'),
(422, 20, 'Nagcarlan'),
(423, 20, 'Paete'),
(424, 20, 'Pagsanjan'),
(425, 20, 'Pakil'),
(426, 20, 'Pangil'),
(427, 20, 'Pila'),
(428, 20, 'Rizal'),
(431, 20, 'Santa Cruz (Capital)'),
(432, 20, 'Santa Maria'),
(434, 20, 'Siniloan'),
(435, 20, 'Victoria'),
(436, 21, 'Agdangan'),
(437, 21, 'Alabat'),
(438, 21, 'Atimonan'),
(439, 21, 'Buenavista'),
(440, 21, 'Burdeos'),
(441, 21, 'Calauag'),
(442, 21, 'Candelaria'),
(443, 21, 'Catanauan'),
(453, 21, 'City of Lucena (Capital)'),
(474, 21, 'City of Tayabas'),
(444, 21, 'Dolores'),
(445, 21, 'General Luna'),
(446, 21, 'General Nakar'),
(447, 21, 'Guinayangan'),
(448, 21, 'Gumaca'),
(449, 21, 'Infanta'),
(450, 21, 'Jomalig'),
(451, 21, 'Lopez'),
(452, 21, 'Lucban'),
(454, 21, 'Macalelon'),
(455, 21, 'Mauban'),
(456, 21, 'Mulanay'),
(457, 21, 'Padre Burgos'),
(458, 21, 'Pagbilao'),
(459, 21, 'Panukulan'),
(460, 21, 'Patnanungan'),
(461, 21, 'Perez'),
(462, 21, 'Pitogo'),
(463, 21, 'Plaridel'),
(464, 21, 'Polillo'),
(465, 21, 'Quezon'),
(466, 21, 'Real'),
(467, 21, 'Sampaloc'),
(468, 21, 'San Andres'),
(469, 21, 'San Antonio'),
(470, 21, 'San Francisco'),
(471, 21, 'San Narciso'),
(472, 21, 'Sariaya'),
(473, 21, 'Tagkawayan'),
(475, 21, 'Tiaong'),
(476, 21, 'Unisan'),
(477, 22, 'Angono'),
(479, 22, 'Baras'),
(480, 22, 'Binangonan'),
(481, 22, 'Cainta'),
(482, 22, 'Cardona'),
(478, 22, 'City of Antipolo (Capital)'),
(483, 22, 'Jala-Jala'),
(485, 22, 'Morong'),
(486, 22, 'Pililla'),
(484, 22, 'Rodriguez'),
(487, 22, 'San Mateo'),
(488, 22, 'Tanay'),
(489, 22, 'Taytay'),
(490, 22, 'Teresa'),
(491, 23, 'Boac (Capital)'),
(492, 23, 'Buenavista'),
(493, 23, 'Gasan'),
(494, 23, 'Mogpog'),
(495, 23, 'Santa Cruz'),
(496, 23, 'Torrijos'),
(497, 24, 'Abra De Ilog'),
(498, 24, 'Calintaan'),
(499, 24, 'Looc'),
(500, 24, 'Lubang'),
(501, 24, 'Magsaysay'),
(502, 24, 'Mamburao (Capital)'),
(503, 24, 'Paluan'),
(504, 24, 'Rizal'),
(505, 24, 'Sablayan'),
(506, 24, 'San Jose'),
(507, 24, 'Santa Cruz'),
(508, 25, 'Baco'),
(509, 25, 'Bansud'),
(510, 25, 'Bongabong'),
(511, 25, 'Bulalacao'),
(512, 25, 'City of Calapan (Capital)'),
(513, 25, 'Gloria'),
(514, 25, 'Mansalay'),
(515, 25, 'Naujan'),
(516, 25, 'Pinamalayan'),
(517, 25, 'Pola'),
(518, 25, 'Puerto Galera'),
(519, 25, 'Roxas'),
(520, 25, 'San Teodoro'),
(521, 25, 'Socorro'),
(522, 25, 'Victoria'),
(523, 26, 'Aborlan'),
(524, 26, 'Agutaya'),
(525, 26, 'Araceli'),
(526, 26, 'Balabac'),
(527, 26, 'Bataraza'),
(528, 26, 'Brooke\'S Point'),
(529, 26, 'Busuanga'),
(530, 26, 'Cagayancillo'),
(538, 26, 'City of Puerto Princesa (Capital)'),
(531, 26, 'Coron'),
(544, 26, 'Culion'),
(532, 26, 'Cuyo'),
(533, 26, 'Dumaran'),
(534, 26, 'El Nido'),
(543, 26, 'Kalayaan'),
(535, 26, 'Linapacan'),
(536, 26, 'Magsaysay'),
(537, 26, 'Narra'),
(539, 26, 'Quezon'),
(545, 26, 'Rizal'),
(540, 26, 'Roxas'),
(541, 26, 'San Vicente'),
(546, 26, 'Sofronio Española'),
(542, 26, 'Taytay'),
(547, 27, 'Alcantara'),
(548, 27, 'Banton'),
(549, 27, 'Cajidiocan'),
(550, 27, 'Calatrava'),
(551, 27, 'Concepcion'),
(552, 27, 'Corcuera'),
(562, 27, 'Ferrol'),
(553, 27, 'Looc'),
(554, 27, 'Magdiwang'),
(555, 27, 'Odiongan'),
(556, 27, 'Romblon (Capital)'),
(557, 27, 'San Agustin'),
(558, 27, 'San Andres'),
(559, 27, 'San Fernando'),
(560, 27, 'San Jose'),
(561, 27, 'Santa Fe'),
(563, 27, 'Santa Maria'),
(564, 28, 'Bacacay'),
(565, 28, 'Camalig'),
(569, 28, 'City of Legazpi (Capital)'),
(571, 28, 'City of Ligao'),
(580, 28, 'City of Tabaco'),
(566, 28, 'Daraga'),
(567, 28, 'Guinobatan'),
(568, 28, 'Jovellar'),
(570, 28, 'Libon'),
(572, 28, 'Malilipot'),
(573, 28, 'Malinao'),
(574, 28, 'Manito'),
(575, 28, 'Oas'),
(576, 28, 'Pio Duran'),
(577, 28, 'Polangui'),
(578, 28, 'Rapu-Rapu'),
(579, 28, 'Santo Domingo'),
(581, 28, 'Tiwi'),
(582, 29, 'Basud'),
(583, 29, 'Capalonga'),
(584, 29, 'Daet (Capital)'),
(586, 29, 'Jose Panganiban'),
(587, 29, 'Labo'),
(588, 29, 'Mercedes'),
(589, 29, 'Paracale'),
(585, 29, 'San Lorenzo Ruiz'),
(590, 29, 'San Vicente'),
(591, 29, 'Santa Elena'),
(592, 29, 'Talisay'),
(593, 29, 'Vinzons'),
(594, 30, 'Baao'),
(595, 30, 'Balatan'),
(596, 30, 'Bato'),
(597, 30, 'Bombon'),
(598, 30, 'Buhi'),
(599, 30, 'Bula'),
(600, 30, 'Cabusao'),
(601, 30, 'Calabanga'),
(602, 30, 'Camaligan'),
(603, 30, 'Canaman'),
(604, 30, 'Caramoan'),
(609, 30, 'City of Iriga'),
(617, 30, 'City of Naga'),
(605, 30, 'Del Gallego'),
(606, 30, 'Gainza'),
(607, 30, 'Garchitorena'),
(608, 30, 'Goa'),
(610, 30, 'Lagonoy'),
(611, 30, 'Libmanan'),
(612, 30, 'Lupi'),
(613, 30, 'Magarao'),
(614, 30, 'Milaor'),
(615, 30, 'Minalabac'),
(616, 30, 'Nabua'),
(618, 30, 'Ocampo'),
(619, 30, 'Pamplona'),
(620, 30, 'Pasacao'),
(621, 30, 'Pili (Capital)'),
(622, 30, 'Presentacion'),
(623, 30, 'Ragay'),
(624, 30, 'Sagñay'),
(625, 30, 'San Fernando'),
(626, 30, 'San Jose'),
(627, 30, 'Sipocot'),
(628, 30, 'Siruma'),
(629, 30, 'Tigaon'),
(630, 30, 'Tinambac'),
(631, 31, 'Bagamanoc'),
(632, 31, 'Baras'),
(633, 31, 'Bato'),
(634, 31, 'Caramoran'),
(635, 31, 'Gigmoto'),
(636, 31, 'Pandan'),
(637, 31, 'Panganiban'),
(638, 31, 'San Andres'),
(639, 31, 'San Miguel'),
(640, 31, 'Viga'),
(641, 31, 'Virac (Capital)'),
(642, 32, 'Aroroy'),
(643, 32, 'Baleno'),
(644, 32, 'Balud'),
(645, 32, 'Batuan'),
(646, 32, 'Cataingan'),
(647, 32, 'Cawayan'),
(652, 32, 'City of Masbate (Capital)'),
(648, 32, 'Claveria'),
(649, 32, 'Dimasalang'),
(650, 32, 'Esperanza'),
(651, 32, 'Mandaon'),
(653, 32, 'Milagros'),
(654, 32, 'Mobo'),
(655, 32, 'Monreal'),
(656, 32, 'Palanas'),
(657, 32, 'Pio V. Corpuz'),
(658, 32, 'Placer'),
(659, 32, 'San Fernando'),
(660, 32, 'San Jacinto'),
(661, 32, 'San Pascual'),
(662, 32, 'Uson'),
(663, 33, 'Barcelona'),
(664, 33, 'Bulan'),
(665, 33, 'Bulusan'),
(666, 33, 'Casiguran'),
(667, 33, 'Castilla'),
(677, 33, 'City of Sorsogon (Capital)'),
(668, 33, 'Donsol'),
(669, 33, 'Gubat'),
(670, 33, 'Irosin'),
(671, 33, 'Juban'),
(672, 33, 'Magallanes'),
(673, 33, 'Matnog'),
(674, 33, 'Pilar'),
(675, 33, 'Prieto Diaz'),
(676, 33, 'Santa Magdalena'),
(678, 34, 'Altavas'),
(679, 34, 'Balete'),
(680, 34, 'Banga'),
(681, 34, 'Batan'),
(682, 34, 'Buruanga'),
(683, 34, 'Ibajay'),
(684, 34, 'Kalibo (Capital)'),
(685, 34, 'Lezo'),
(686, 34, 'Libacao'),
(687, 34, 'Madalag'),
(688, 34, 'Makato'),
(689, 34, 'Malay'),
(690, 34, 'Malinao'),
(691, 34, 'Nabas'),
(692, 34, 'New Washington'),
(693, 34, 'Numancia'),
(694, 34, 'Tangalan'),
(695, 35, 'Anini-Y'),
(696, 35, 'Barbaza'),
(697, 35, 'Belison'),
(698, 35, 'Bugasong'),
(699, 35, 'Caluya'),
(700, 35, 'Culasi'),
(702, 35, 'Hamtic'),
(703, 35, 'Laua-An'),
(704, 35, 'Libertad'),
(705, 35, 'Pandan'),
(706, 35, 'Patnongon'),
(707, 35, 'San Jose (Capital)'),
(708, 35, 'San Remigio'),
(709, 35, 'Sebaste'),
(710, 35, 'Sibalom'),
(711, 35, 'Tibiao'),
(701, 35, 'Tobias Fornier'),
(712, 35, 'Valderrama'),
(726, 36, 'City of Roxas (Capital)'),
(713, 36, 'Cuartero'),
(714, 36, 'Dao'),
(715, 36, 'Dumalag'),
(716, 36, 'Dumarao'),
(717, 36, 'Ivisan'),
(718, 36, 'Jamindan'),
(719, 36, 'Ma-Ayon'),
(720, 36, 'Mambusao'),
(721, 36, 'Panay'),
(722, 36, 'Panitan'),
(723, 36, 'Pilar'),
(724, 36, 'Pontevedra'),
(725, 36, 'President Roxas'),
(727, 36, 'Sapi-An'),
(728, 36, 'Sigma'),
(729, 36, 'Tapaz'),
(730, 37, 'Ajuy'),
(731, 37, 'Alimodian'),
(732, 37, 'Anilao'),
(733, 37, 'Badiangan'),
(734, 37, 'Balasan'),
(735, 37, 'Banate'),
(736, 37, 'Barotac Nuevo'),
(737, 37, 'Barotac Viejo'),
(738, 37, 'Batad'),
(739, 37, 'Bingawan'),
(740, 37, 'Cabatuan'),
(741, 37, 'Calinog'),
(742, 37, 'Carles'),
(750, 37, 'City of Iloilo (Capital)'),
(761, 37, 'City of Passi'),
(743, 37, 'Concepcion'),
(744, 37, 'Dingle'),
(745, 37, 'Dueñas'),
(746, 37, 'Dumangas'),
(747, 37, 'Estancia'),
(748, 37, 'Guimbal'),
(749, 37, 'Igbaras'),
(751, 37, 'Janiuay'),
(752, 37, 'Lambunao'),
(753, 37, 'Leganes'),
(754, 37, 'Lemery'),
(755, 37, 'Leon'),
(756, 37, 'Maasin'),
(757, 37, 'Miagao'),
(758, 37, 'Mina'),
(759, 37, 'New Lucena'),
(760, 37, 'Oton'),
(762, 37, 'Pavia'),
(763, 37, 'Pototan'),
(764, 37, 'San Dionisio'),
(765, 37, 'San Enrique'),
(766, 37, 'San Joaquin'),
(767, 37, 'San Miguel'),
(768, 37, 'San Rafael'),
(769, 37, 'Santa Barbara'),
(770, 37, 'Sara'),
(771, 37, 'Tigbauan'),
(772, 37, 'Tubungan'),
(773, 37, 'Zarraga'),
(776, 38, 'Binalbagan'),
(778, 38, 'Calatrava'),
(779, 38, 'Candoni'),
(780, 38, 'Cauayan'),
(774, 38, 'City of Bacolod (Capital)'),
(775, 38, 'City of Bago'),
(777, 38, 'City of Cadiz'),
(782, 38, 'City of Escalante'),
(783, 38, 'City of Himamaylan'),
(788, 38, 'City of Kabankalan'),
(789, 38, 'City of La Carlota'),
(796, 38, 'City of Sagay'),
(797, 38, 'City of San Carlos'),
(799, 38, 'City of Silay'),
(800, 38, 'City of Sipalay'),
(801, 38, 'City of Talisay'),
(804, 38, 'City of Victorias'),
(781, 38, 'Enrique B. Magalona'),
(784, 38, 'Hinigaran'),
(785, 38, 'Hinoba-an'),
(786, 38, 'Ilog'),
(787, 38, 'Isabela'),
(790, 38, 'La Castellana'),
(791, 38, 'Manapla'),
(792, 38, 'Moises Padilla'),
(793, 38, 'Murcia'),
(794, 38, 'Pontevedra'),
(795, 38, 'Pulupandan'),
(805, 38, 'Salvador Benedicto'),
(798, 38, 'San Enrique'),
(802, 38, 'Toboso'),
(803, 38, 'Valladolid'),
(806, 39, 'Buenavista'),
(807, 39, 'Jordan (Capital)'),
(808, 39, 'Nueva Valencia'),
(809, 39, 'San Lorenzo'),
(810, 39, 'Sibunag'),
(811, 40, 'Alburquerque'),
(812, 40, 'Alicia'),
(813, 40, 'Anda'),
(814, 40, 'Antequera'),
(815, 40, 'Baclayon'),
(816, 40, 'Balilihan'),
(817, 40, 'Batuan'),
(858, 40, 'Bien Unido'),
(818, 40, 'Bilar'),
(819, 40, 'Buenavista'),
(820, 40, 'Calape'),
(821, 40, 'Candijay'),
(822, 40, 'Carmen'),
(823, 40, 'Catigbian'),
(852, 40, 'City of Tagbilaran (Capital)'),
(824, 40, 'Clarin'),
(825, 40, 'Corella'),
(826, 40, 'Cortes'),
(827, 40, 'Dagohoy'),
(828, 40, 'Danao'),
(829, 40, 'Dauis'),
(830, 40, 'Dimiao'),
(831, 40, 'Duero'),
(832, 40, 'Garcia Hernandez'),
(836, 40, 'Getafe'),
(833, 40, 'Guindulman'),
(834, 40, 'Inabanga'),
(835, 40, 'Jagna'),
(837, 40, 'Lila'),
(838, 40, 'Loay'),
(839, 40, 'Loboc'),
(840, 40, 'Loon'),
(841, 40, 'Mabini'),
(842, 40, 'Maribojoc'),
(843, 40, 'Panglao'),
(844, 40, 'Pilar'),
(845, 40, 'Pres. Carlos P. Garcia'),
(846, 40, 'Sagbayan'),
(847, 40, 'San Isidro'),
(848, 40, 'San Miguel'),
(849, 40, 'Sevilla'),
(850, 40, 'Sierra Bullones'),
(851, 40, 'Sikatuna'),
(853, 40, 'Talibon'),
(854, 40, 'Trinidad'),
(855, 40, 'Tubigon'),
(856, 40, 'Ubay'),
(857, 40, 'Valencia'),
(859, 41, 'Alcantara'),
(860, 41, 'Alcoy'),
(861, 41, 'Alegria'),
(862, 41, 'Aloguinsan'),
(863, 41, 'Argao'),
(864, 41, 'Asturias'),
(865, 41, 'Badian'),
(866, 41, 'Balamban'),
(867, 41, 'Bantayan'),
(868, 41, 'Barili'),
(870, 41, 'Boljoon'),
(871, 41, 'Borbon'),
(873, 41, 'Carmen'),
(874, 41, 'Catmon'),
(869, 41, 'City of Bogo'),
(872, 41, 'City of Carcar'),
(875, 41, 'City of Cebu (Capital)'),
(884, 41, 'City of Lapu-Lapu'),
(888, 41, 'City of Mandaue'),
(892, 41, 'City of Naga'),
(908, 41, 'City of Talisay'),
(909, 41, 'City of Toledo'),
(876, 41, 'Compostela'),
(877, 41, 'Consolacion'),
(878, 41, 'Cordova'),
(879, 41, 'Daanbantayan'),
(880, 41, 'Dalaguete'),
(881, 41, 'Danao City'),
(882, 41, 'Dumanjug'),
(883, 41, 'Ginatilan'),
(885, 41, 'Liloan'),
(886, 41, 'Madridejos'),
(887, 41, 'Malabuyoc'),
(889, 41, 'Medellin'),
(890, 41, 'Minglanilla'),
(891, 41, 'Moalboal'),
(893, 41, 'Oslob'),
(894, 41, 'Pilar'),
(895, 41, 'Pinamungajan'),
(896, 41, 'Poro'),
(897, 41, 'Ronda'),
(898, 41, 'Samboan'),
(899, 41, 'San Fernando'),
(900, 41, 'San Francisco'),
(901, 41, 'San Remigio'),
(902, 41, 'Santa Fe'),
(903, 41, 'Santander'),
(904, 41, 'Sibonga'),
(905, 41, 'Sogod'),
(906, 41, 'Tabogon'),
(907, 41, 'Tabuelan'),
(910, 41, 'Tuburan'),
(911, 41, 'Tudela'),
(912, 42, 'Amlan'),
(913, 42, 'Ayungon'),
(914, 42, 'Bacong'),
(916, 42, 'Basay'),
(918, 42, 'Bindoy'),
(915, 42, 'City of Bais'),
(917, 42, 'City of Bayawan'),
(919, 42, 'City of Canlaon'),
(921, 42, 'City of Dumaguete (Capital)'),
(922, 42, 'City of Guihulngan'),
(932, 42, 'City of Tanjay'),
(920, 42, 'Dauin'),
(923, 42, 'Jimalalud'),
(924, 42, 'La Libertad'),
(925, 42, 'Mabinay'),
(926, 42, 'Manjuyod'),
(927, 42, 'Pamplona'),
(928, 42, 'San Jose'),
(929, 42, 'Santa Catalina'),
(930, 42, 'Siaton'),
(931, 42, 'Sibulan'),
(933, 42, 'Tayasan'),
(934, 42, 'Valencia'),
(935, 42, 'Vallehermoso'),
(936, 42, 'Zamboanguita'),
(937, 43, 'Enrique Villanueva'),
(938, 43, 'Larena'),
(939, 43, 'Lazi'),
(940, 43, 'Maria'),
(941, 43, 'San Juan'),
(942, 43, 'Siquijor (Capital)'),
(943, 44, 'Arteche'),
(944, 44, 'Balangiga'),
(945, 44, 'Balangkayan'),
(947, 44, 'Can-Avid'),
(946, 44, 'City of Borongan (Capital)'),
(948, 44, 'Dolores'),
(949, 44, 'General Macarthur'),
(950, 44, 'Giporlos'),
(951, 44, 'Guiuan'),
(952, 44, 'Hernani'),
(953, 44, 'Jipapad'),
(954, 44, 'Lawaan'),
(955, 44, 'Llorente'),
(956, 44, 'Maslog'),
(957, 44, 'Maydolong'),
(958, 44, 'Mercedes'),
(959, 44, 'Oras'),
(960, 44, 'Quinapondan'),
(961, 44, 'Salcedo'),
(962, 44, 'San Julian'),
(963, 44, 'San Policarpo'),
(964, 44, 'Sulat'),
(965, 44, 'Taft'),
(966, 45, 'Abuyog'),
(967, 45, 'Alangalang'),
(968, 45, 'Albuera'),
(969, 45, 'Babatngon'),
(970, 45, 'Barugo'),
(971, 45, 'Bato'),
(973, 45, 'Burauen'),
(974, 45, 'Calubian'),
(975, 45, 'Capoocan'),
(976, 45, 'Carigara'),
(972, 45, 'City of Baybay'),
(1004, 45, 'City of Tacloban (Capital)'),
(977, 45, 'Dagami'),
(978, 45, 'Dulag'),
(979, 45, 'Hilongos'),
(980, 45, 'Hindang'),
(981, 45, 'Inopacan'),
(982, 45, 'Isabel'),
(983, 45, 'Jaro'),
(984, 45, 'Javier'),
(985, 45, 'Julita'),
(986, 45, 'Kananga'),
(987, 45, 'La Paz'),
(988, 45, 'Leyte'),
(989, 45, 'Macarthur'),
(990, 45, 'Mahaplag'),
(991, 45, 'Matag-Ob'),
(992, 45, 'Matalom'),
(993, 45, 'Mayorga'),
(994, 45, 'Merida'),
(995, 45, 'Ormoc City'),
(996, 45, 'Palo'),
(997, 45, 'Palompon'),
(998, 45, 'Pastrana'),
(999, 45, 'San Isidro'),
(1000, 45, 'San Miguel'),
(1001, 45, 'Santa Fe'),
(1002, 45, 'Tabango'),
(1003, 45, 'Tabontabon'),
(1005, 45, 'Tanauan'),
(1006, 45, 'Tolosa'),
(1007, 45, 'Tunga'),
(1008, 45, 'Villaba'),
(1009, 46, 'Allen'),
(1010, 46, 'Biri'),
(1011, 46, 'Bobon'),
(1012, 46, 'Capul'),
(1013, 46, 'Catarman (Capital)'),
(1014, 46, 'Catubig'),
(1015, 46, 'Gamay'),
(1016, 46, 'Laoang'),
(1017, 46, 'Lapinig'),
(1018, 46, 'Las Navas'),
(1019, 46, 'Lavezares'),
(1032, 46, 'Lope De Vega'),
(1020, 46, 'Mapanas'),
(1021, 46, 'Mondragon'),
(1022, 46, 'Palapag'),
(1023, 46, 'Pambujan'),
(1024, 46, 'Rosario'),
(1025, 46, 'San Antonio'),
(1026, 46, 'San Isidro'),
(1027, 46, 'San Jose'),
(1028, 46, 'San Roque'),
(1029, 46, 'San Vicente'),
(1030, 46, 'Silvino Lobos'),
(1031, 46, 'Victoria'),
(1033, 47, 'Almagro'),
(1034, 47, 'Basey'),
(1036, 47, 'Calbiga'),
(1035, 47, 'City of Calbayog'),
(1037, 47, 'City of Catbalogan (Capital)'),
(1038, 47, 'Daram'),
(1039, 47, 'Gandara'),
(1040, 47, 'Hinabangan'),
(1041, 47, 'Jiabong'),
(1042, 47, 'Marabut'),
(1043, 47, 'Matuguinao'),
(1044, 47, 'Motiong'),
(1058, 47, 'Pagsanghan'),
(1054, 47, 'Paranas'),
(1045, 47, 'Pinabacdao'),
(1057, 47, 'San Jorge'),
(1046, 47, 'San Jose De Buan'),
(1047, 47, 'San Sebastian'),
(1048, 47, 'Santa Margarita'),
(1049, 47, 'Santa Rita'),
(1050, 47, 'Santo Niño'),
(1056, 47, 'Tagapul-An'),
(1051, 47, 'Talalora'),
(1052, 47, 'Tarangnan'),
(1053, 47, 'Villareal'),
(1055, 47, 'Zumarraga'),
(1059, 48, 'Anahawan'),
(1060, 48, 'Bontoc'),
(1065, 48, 'City of Maasin (Capital)'),
(1061, 48, 'Hinunangan'),
(1062, 48, 'Hinundayan'),
(1063, 48, 'Libagon'),
(1064, 48, 'Liloan'),
(1077, 48, 'Limasawa'),
(1066, 48, 'Macrohon'),
(1067, 48, 'Malitbog'),
(1068, 48, 'Padre Burgos'),
(1069, 48, 'Pintuyan'),
(1070, 48, 'Saint Bernard'),
(1071, 48, 'San Francisco'),
(1072, 48, 'San Juan'),
(1073, 48, 'San Ricardo'),
(1074, 48, 'Silago'),
(1075, 48, 'Sogod'),
(1076, 48, 'Tomas Oppus'),
(1078, 49, 'Almeria'),
(1079, 49, 'Biliran'),
(1080, 49, 'Cabucgayan'),
(1081, 49, 'Caibiran'),
(1082, 49, 'Culaba'),
(1083, 49, 'Kawayan'),
(1084, 49, 'Maripipi'),
(1085, 49, 'Naval (Capital)'),
(1111, 50, 'Bacungan'),
(1109, 50, 'Baliguian'),
(1086, 50, 'City of Dapitan'),
(1087, 50, 'City of Dipolog (Capital)'),
(1110, 50, 'Godod'),
(1108, 50, 'Gutalac'),
(1107, 50, 'Jose Dalman'),
(1112, 50, 'Kalawit'),
(1088, 50, 'Katipunan'),
(1089, 50, 'La Libertad'),
(1090, 50, 'Labason'),
(1091, 50, 'Liloy'),
(1092, 50, 'Manukan'),
(1093, 50, 'Mutia'),
(1094, 50, 'Piñan'),
(1095, 50, 'Polanco'),
(1096, 50, 'Pres. Manuel A. Roxas'),
(1097, 50, 'Rizal'),
(1098, 50, 'Salug'),
(1099, 50, 'Sergio Osmeña Sr.'),
(1100, 50, 'Siayan'),
(1101, 50, 'Sibuco'),
(1102, 50, 'Sibutad'),
(1103, 50, 'Sindangan'),
(1104, 50, 'Siocon'),
(1105, 50, 'Sirawai'),
(1106, 50, 'Tampilisan'),
(1113, 51, 'Aurora'),
(1114, 51, 'Bayog'),
(1126, 51, 'City of Pagadian (Capital)'),
(1133, 51, 'City of Zamboanga'),
(1115, 51, 'Dimataling'),
(1116, 51, 'Dinas'),
(1117, 51, 'Dumalinao'),
(1118, 51, 'Dumingag'),
(1139, 51, 'Guipos'),
(1135, 51, 'Josefina'),
(1119, 51, 'Kumalarang'),
(1120, 51, 'Labangan'),
(1134, 51, 'Lakewood'),
(1121, 51, 'Lapuyan'),
(1122, 51, 'Mahayag'),
(1123, 51, 'Margosatubig'),
(1124, 51, 'Midsalip'),
(1125, 51, 'Molave'),
(1136, 51, 'Pitogo'),
(1127, 51, 'Ramon Magsaysay'),
(1128, 51, 'San Miguel'),
(1129, 51, 'San Pablo'),
(1137, 51, 'Sominot'),
(1130, 51, 'Tabina'),
(1131, 51, 'Tambulig'),
(1140, 51, 'Tigbao'),
(1132, 51, 'Tukuran'),
(1138, 51, 'Vincenzo A. Sagun'),
(1141, 52, 'Alicia'),
(1142, 52, 'Buug'),
(1157, 52, 'City of Isabela'),
(1143, 52, 'Diplahan'),
(1144, 52, 'Imelda'),
(1145, 52, 'Ipil (Capital)'),
(1146, 52, 'Kabasalan'),
(1147, 52, 'Mabuhay'),
(1148, 52, 'Malangas'),
(1149, 52, 'Naga'),
(1150, 52, 'Olutanga'),
(1151, 52, 'Payao'),
(1152, 52, 'Roseller Lim'),
(1153, 52, 'Siay'),
(1154, 52, 'Talusan'),
(1155, 52, 'Titay'),
(1156, 52, 'Tungawan'),
(1158, 53, 'Baungon'),
(1179, 53, 'Cabanglasan'),
(1169, 53, 'City of Malaybalay (Capital)'),
(1178, 53, 'City of Valencia'),
(1159, 53, 'Damulog'),
(1160, 53, 'Dangcagan'),
(1161, 53, 'Don Carlos'),
(1162, 53, 'Impasug-ong'),
(1163, 53, 'Kadingilan'),
(1164, 53, 'Kalilangan'),
(1165, 53, 'Kibawe'),
(1166, 53, 'Kitaotao'),
(1167, 53, 'Lantapan'),
(1168, 53, 'Libona'),
(1170, 53, 'Malitbog'),
(1171, 53, 'Manolo Fortich'),
(1172, 53, 'Maramag'),
(1173, 53, 'Pangantucan'),
(1174, 53, 'Quezon'),
(1175, 53, 'San Fernando'),
(1176, 53, 'Sumilao'),
(1177, 53, 'Talakag'),
(1180, 54, 'Catarman'),
(1181, 54, 'Guinsiliban'),
(1182, 54, 'Mahinog'),
(1183, 54, 'Mambajao (Capital)'),
(1184, 54, 'Sagay'),
(1185, 55, 'Bacolod'),
(1186, 55, 'Baloi'),
(1187, 55, 'Baroy'),
(1188, 55, 'City of Iligan'),
(1189, 55, 'Kapatagan'),
(1191, 55, 'Kauswagan'),
(1192, 55, 'Kolambugan'),
(1193, 55, 'Lala'),
(1194, 55, 'Linamon'),
(1195, 55, 'Magsaysay'),
(1196, 55, 'Maigo'),
(1197, 55, 'Matungao'),
(1198, 55, 'Munai'),
(1199, 55, 'Nunungan'),
(1200, 55, 'Pantao Ragat'),
(1207, 55, 'Pantar'),
(1201, 55, 'Poona Piagapo'),
(1202, 55, 'Salvador'),
(1203, 55, 'Sapad'),
(1190, 55, 'Sultan Naga Dimaporo'),
(1204, 55, 'Tagoloan'),
(1205, 55, 'Tangcal'),
(1206, 55, 'Tubod (Capital)'),
(1208, 56, 'Aloran'),
(1209, 56, 'Baliangao'),
(1210, 56, 'Bonifacio'),
(1211, 56, 'Calamba'),
(1216, 56, 'City of Oroquieta (Capital)'),
(1217, 56, 'City of Ozamiz'),
(1222, 56, 'City of Tangub'),
(1212, 56, 'Clarin'),
(1213, 56, 'Concepcion'),
(1224, 56, 'Don Victoriano Chiongbian'),
(1214, 56, 'Jimenez'),
(1215, 56, 'Lopez Jaena'),
(1218, 56, 'Panaon'),
(1219, 56, 'Plaridel'),
(1220, 56, 'Sapang Dalaga'),
(1221, 56, 'Sinacaban'),
(1223, 56, 'Tudela'),
(1225, 57, 'Alubijid'),
(1226, 57, 'Balingasag'),
(1227, 57, 'Balingoan'),
(1228, 57, 'Binuangan'),
(1229, 57, 'City of Cagayan De Oro (Capital)'),
(1231, 57, 'City of El Salvador'),
(1232, 57, 'City of Gingoog'),
(1230, 57, 'Claveria'),
(1233, 57, 'Gitagum'),
(1234, 57, 'Initao'),
(1235, 57, 'Jasaan'),
(1236, 57, 'Kinoguitan'),
(1237, 57, 'Lagonglong'),
(1238, 57, 'Laguindingan'),
(1239, 57, 'Libertad'),
(1240, 57, 'Lugait'),
(1241, 57, 'Magsaysay'),
(1242, 57, 'Manticao'),
(1243, 57, 'Medina'),
(1244, 57, 'Naawan'),
(1245, 57, 'Opol'),
(1246, 57, 'Salay'),
(1247, 57, 'Sugbongcogon'),
(1248, 57, 'Tagoloan'),
(1249, 57, 'Talisayan'),
(1250, 57, 'Villanueva'),
(1251, 58, 'Asuncion'),
(1260, 58, 'Braulio E. Dujali'),
(1252, 58, 'Carmen'),
(1255, 58, 'City of Panabo'),
(1258, 58, 'City of Tagum (Capital)'),
(1256, 58, 'Island Garden City of Samal'),
(1253, 58, 'Kapalong'),
(1254, 58, 'New Corella'),
(1261, 58, 'San Isidro'),
(1257, 58, 'Santo Tomas'),
(1259, 58, 'Talaingod'),
(1262, 59, 'Bansalan'),
(1263, 59, 'City of Davao'),
(1264, 59, 'City of Digos (Capital)'),
(1265, 59, 'Hagonoy'),
(1266, 59, 'Kiblawan'),
(1267, 59, 'Magsaysay'),
(1268, 59, 'Malalag'),
(1269, 59, 'Matanao'),
(1270, 59, 'Padada'),
(1271, 59, 'Santa Cruz'),
(1272, 59, 'Sulop'),
(1273, 60, 'Baganga'),
(1274, 60, 'Banaybanay'),
(1275, 60, 'Boston'),
(1276, 60, 'Caraga'),
(1277, 60, 'Cateel'),
(1281, 60, 'City of Mati (Capital)'),
(1278, 60, 'Governor Generoso'),
(1279, 60, 'Lupon'),
(1280, 60, 'Manay'),
(1282, 60, 'San Isidro'),
(1283, 60, 'Tarragona'),
(1284, 61, 'Compostela'),
(1285, 61, 'Laak'),
(1286, 61, 'Mabini'),
(1287, 61, 'Maco'),
(1288, 61, 'Maragusan'),
(1289, 61, 'Mawab'),
(1290, 61, 'Monkayo'),
(1291, 61, 'Montevista'),
(1292, 61, 'Nabunturan (Capital)'),
(1293, 61, 'New Bataan'),
(1294, 61, 'Pantukan'),
(1295, 62, 'Don Marcelino'),
(1296, 62, 'Jose Abad Santos'),
(1297, 62, 'Malita (Capital)'),
(1298, 62, 'Santa Maria'),
(1299, 62, 'Sarangani'),
(1300, 63, 'Alamada'),
(1316, 63, 'Aleosan'),
(1314, 63, 'Antipas'),
(1317, 63, 'Arakan'),
(1315, 63, 'Banisilan'),
(1301, 63, 'Carmen'),
(1303, 63, 'City of Kidapawan (Capital)'),
(1302, 63, 'Kabacan'),
(1304, 63, 'Libungan'),
(1309, 63, 'M\'Lang'),
(1305, 63, 'Magpet'),
(1306, 63, 'Makilala'),
(1307, 63, 'Matalam'),
(1308, 63, 'Midsayap'),
(1310, 63, 'Pigkawayan'),
(1311, 63, 'Pikit'),
(1312, 63, 'President Roxas'),
(1313, 63, 'Tulunan'),
(1318, 64, 'Banga'),
(1319, 64, 'City of General Santos'),
(1320, 64, 'City of Koronadal (Capital)'),
(1329, 64, 'Lake Sebu'),
(1321, 64, 'Norala'),
(1322, 64, 'Polomolok'),
(1328, 64, 'Santo Niño'),
(1323, 64, 'Surallah'),
(1326, 64, 'T\'Boli'),
(1324, 64, 'Tampakan'),
(1325, 64, 'Tantangan'),
(1327, 64, 'Tupi'),
(1330, 65, 'Bagumbayan'),
(1340, 65, 'City of Tacurong'),
(1331, 65, 'Columbio'),
(1332, 65, 'Esperanza'),
(1333, 65, 'Isulan (Capital)'),
(1334, 65, 'Kalamansig'),
(1337, 65, 'Lambayong'),
(1335, 65, 'Lebak'),
(1336, 65, 'Lutayan'),
(1338, 65, 'Palimbang'),
(1339, 65, 'President Quirino'),
(1341, 65, 'Sen. Ninoy Aquino'),
(1342, 66, 'Alabel (Capital)'),
(1349, 66, 'Cotabato City'),
(1343, 66, 'Glan'),
(1344, 66, 'Kiamba'),
(1345, 66, 'Maasim'),
(1346, 66, 'Maitum'),
(1347, 66, 'Malapatan'),
(1348, 66, 'Malungon'),
(1367, 67, 'Bangued (Capital)'),
(1368, 67, 'Boliney'),
(1369, 67, 'Bucay'),
(1370, 67, 'Bucloc'),
(1371, 67, 'Daguioman'),
(1372, 67, 'Danglas'),
(1373, 67, 'Dolores'),
(1374, 67, 'La Paz'),
(1375, 67, 'Lacub'),
(1376, 67, 'Lagangilang'),
(1377, 67, 'Lagayan'),
(1378, 67, 'Langiden'),
(1379, 67, 'Licuan-Baay'),
(1380, 67, 'Luba'),
(1381, 67, 'Malibcong'),
(1382, 67, 'Manabo'),
(1383, 67, 'Peñarrubia'),
(1384, 67, 'Pidigan'),
(1385, 67, 'Pilar'),
(1386, 67, 'Sallapadan'),
(1387, 67, 'San Isidro'),
(1388, 67, 'San Juan'),
(1389, 67, 'San Quintin'),
(1390, 67, 'Tayum'),
(1391, 67, 'Tineg'),
(1392, 67, 'Tubo'),
(1393, 67, 'Villaviciosa'),
(1394, 68, 'Atok'),
(1396, 68, 'Bakun'),
(1397, 68, 'Bokod'),
(1398, 68, 'Buguias'),
(1395, 68, 'City of Baguio'),
(1399, 68, 'Itogon'),
(1400, 68, 'Kabayan'),
(1401, 68, 'Kapangan'),
(1402, 68, 'Kibungan'),
(1403, 68, 'La Trinidad (Capital)'),
(1404, 68, 'Mankayan'),
(1405, 68, 'Sablan'),
(1406, 68, 'Tuba'),
(1407, 68, 'Tublay'),
(1415, 69, 'Aguinaldo'),
(1414, 69, 'Alfonso Lista'),
(1418, 69, 'Asipulo'),
(1408, 69, 'Banaue'),
(1416, 69, 'Hingyon'),
(1409, 69, 'Hungduan'),
(1410, 69, 'Kiangan'),
(1411, 69, 'Lagawe (Capital)'),
(1412, 69, 'Lamut'),
(1413, 69, 'Mayoyao'),
(1417, 69, 'Tinoc'),
(1419, 70, 'Balbalan'),
(1424, 70, 'City of Tabuk (Capital)'),
(1420, 70, 'Lubuagan'),
(1421, 70, 'Pasil'),
(1422, 70, 'Pinukpuk'),
(1423, 70, 'Rizal'),
(1425, 70, 'Tanudan'),
(1426, 70, 'Tinglayan'),
(1427, 71, 'Barlig'),
(1428, 71, 'Bauko'),
(1429, 71, 'Besao'),
(1430, 71, 'Bontoc (Capital)'),
(1431, 71, 'Natonin'),
(1432, 71, 'Paracelis'),
(1433, 71, 'Sabangan'),
(1434, 71, 'Sadanga'),
(1435, 71, 'Sagada'),
(1436, 71, 'Tadian'),
(1437, 72, 'Calanasan'),
(1438, 72, 'Conner'),
(1439, 72, 'Flora'),
(1440, 72, 'Kabugao (Capital)'),
(1441, 72, 'Luna'),
(1442, 72, 'Pudtol'),
(1443, 72, 'Santa Marcela'),
(1450, 73, 'Akbar'),
(1451, 73, 'Al-Barka'),
(1444, 73, 'City of Lamitan (Capital)'),
(1452, 73, 'Hadji Mohammad Ajul'),
(1454, 73, 'Hadji Muhtamad'),
(1445, 73, 'Lantawan'),
(1446, 73, 'Maluso'),
(1447, 73, 'Sumisip'),
(1455, 73, 'Tabuan-Lasa'),
(1448, 73, 'Tipo-Tipo'),
(1449, 73, 'Tuburan'),
(1453, 73, 'Ungkaya Pukan'),
(1491, 74, 'Amai Manabilang'),
(1456, 74, 'Bacolod-Kalawi'),
(1457, 74, 'Balabagan'),
(1458, 74, 'Balindong'),
(1459, 74, 'Bayang'),
(1460, 74, 'Binidayan'),
(1487, 74, 'Buadiposo-Buntong'),
(1461, 74, 'Bubong'),
(1462, 74, 'Butig'),
(1486, 74, 'Calanogas'),
(1471, 74, 'City of Marawi (Capital)'),
(1478, 74, 'Ditsaan-Ramain'),
(1463, 74, 'Ganassi'),
(1464, 74, 'Kapai'),
(1493, 74, 'Kapatagan'),
(1465, 74, 'Lumba-Bayabao'),
(1495, 74, 'Lumbaca-Unayan'),
(1466, 74, 'Lumbatan'),
(1490, 74, 'Lumbayanague'),
(1467, 74, 'Madalum'),
(1468, 74, 'Madamba'),
(1488, 74, 'Maguing'),
(1469, 74, 'Malabang'),
(1470, 74, 'Marantao'),
(1485, 74, 'Marogong'),
(1472, 74, 'Masiu'),
(1473, 74, 'Mulondo'),
(1474, 74, 'Pagayawan'),
(1475, 74, 'Piagapo'),
(1489, 74, 'Picong'),
(1476, 74, 'Poona Bayabao'),
(1477, 74, 'Pualas'),
(1479, 74, 'Saguiaran'),
(1494, 74, 'Sultan Dumalondong'),
(1492, 74, 'Tagoloan Ii'),
(1480, 74, 'Tamparan'),
(1481, 74, 'Taraka'),
(1482, 74, 'Tubaran'),
(1483, 74, 'Tugaya'),
(1484, 74, 'Wao'),
(1496, 75, 'Ampatuan'),
(1512, 75, 'Barira'),
(1497, 75, 'Buldon'),
(1498, 75, 'Buluan'),
(1522, 75, 'Datu Abdullah Sangki'),
(1525, 75, 'Datu Anggal Midtimbang'),
(1524, 75, 'Datu Blah T. Sinsuat'),
(1529, 75, 'Datu Hoffer Ampatuan'),
(1501, 75, 'Datu Odin Sinsuat'),
(1499, 75, 'Datu Paglas'),
(1500, 75, 'Datu Piang'),
(1530, 75, 'Datu Salibo'),
(1520, 75, 'Datu Saudi-Ampatuan'),
(1521, 75, 'Datu Unsay'),
(1513, 75, 'Gen. S.K. Pendatun'),
(1519, 75, 'Guindulungan'),
(1508, 75, 'Kabuntalan'),
(1514, 75, 'Mamasapano'),
(1526, 75, 'Mangudadatu'),
(1503, 75, 'Matanog'),
(1528, 75, 'Northern Kabuntalan'),
(1516, 75, 'Pagagawan'),
(1504, 75, 'Pagalungan'),
(1517, 75, 'Paglat'),
(1527, 75, 'Pandag'),
(1505, 75, 'Parang'),
(1523, 75, 'Rajah Buayan'),
(1502, 75, 'Shariff Aguak (Capital)'),
(1531, 75, 'Shariff Saydona Mustapha'),
(1511, 75, 'South Upi'),
(1506, 75, 'Sultan Kudarat'),
(1518, 75, 'Sultan Mastura'),
(1507, 75, 'Sultan Sa Barongis'),
(1510, 75, 'Talayan'),
(1515, 75, 'Talitay'),
(1509, 75, 'Upi'),
(1537, 76, 'Hadji Panglima Tahil'),
(1532, 76, 'Indanan'),
(1533, 76, 'Jolo (Capital)'),
(1534, 76, 'Kalingalan Caluang'),
(1548, 76, 'Lugus'),
(1535, 76, 'Luuk'),
(1536, 76, 'Maimbung'),
(1538, 76, 'Old Panamao'),
(1550, 76, 'Omar'),
(1549, 76, 'Pandami'),
(1547, 76, 'Panglima Estino'),
(1539, 76, 'Pangutaran'),
(1540, 76, 'Parang'),
(1541, 76, 'Pata'),
(1542, 76, 'Patikul'),
(1543, 76, 'Siasi'),
(1544, 76, 'Talipao'),
(1545, 76, 'Tapul'),
(1546, 76, 'Tongkil'),
(1552, 77, 'Bongao (Capital)'),
(1559, 77, 'Languyan'),
(1553, 77, 'Mapun'),
(1551, 77, 'Panglima Sugala'),
(1560, 77, 'Sapa-Sapa'),
(1561, 77, 'Sibutu'),
(1554, 77, 'Simunul'),
(1555, 77, 'Sitangkai'),
(1556, 77, 'South Ubian'),
(1557, 77, 'Tandubas'),
(1558, 77, 'Turtle Islands'),
(1562, 78, 'Buenavista'),
(1565, 78, 'Carmen'),
(1563, 78, 'City of Butuan (Capital)'),
(1564, 78, 'City of Cabadbaran'),
(1566, 78, 'Jabonga'),
(1567, 78, 'Kitcharao'),
(1568, 78, 'Las Nieves'),
(1569, 78, 'Magallanes'),
(1570, 78, 'Nasipit'),
(1573, 78, 'Remedios T. Romualdez'),
(1571, 78, 'Santiago'),
(1572, 78, 'Tubay'),
(1575, 79, 'Bunawan'),
(1574, 79, 'City of Bayugan'),
(1576, 79, 'Esperanza'),
(1577, 79, 'La Paz'),
(1578, 79, 'Loreto'),
(1579, 79, 'Prosperidad (Capital)'),
(1580, 79, 'Rosario'),
(1581, 79, 'San Francisco'),
(1582, 79, 'San Luis'),
(1583, 79, 'Santa Josefa'),
(1587, 79, 'Sibagat'),
(1584, 79, 'Talacogon'),
(1585, 79, 'Trento'),
(1586, 79, 'Veruela'),
(1588, 80, 'Alegria'),
(1589, 80, 'Bacuag'),
(1590, 80, 'Burgos'),
(1606, 80, 'City of Surigao (Capital)'),
(1591, 80, 'Claver'),
(1592, 80, 'Dapa'),
(1593, 80, 'Del Carmen'),
(1594, 80, 'General Luna'),
(1595, 80, 'Gigaquit'),
(1596, 80, 'Mainit'),
(1597, 80, 'Malimono'),
(1598, 80, 'Pilar'),
(1599, 80, 'Placer'),
(1600, 80, 'San Benito'),
(1601, 80, 'San Francisco'),
(1602, 80, 'San Isidro'),
(1603, 80, 'Santa Monica'),
(1604, 80, 'Sison'),
(1605, 80, 'Socorro'),
(1607, 80, 'Tagana-An'),
(1608, 80, 'Tubod'),
(1609, 81, 'Barobo'),
(1610, 81, 'Bayabas'),
(1612, 81, 'Cagwait'),
(1613, 81, 'Cantilan'),
(1614, 81, 'Carmen'),
(1615, 81, 'Carrascal'),
(1611, 81, 'City of Bislig'),
(1627, 81, 'City of Tandag (Capital)'),
(1616, 81, 'Cortes'),
(1617, 81, 'Hinatuan'),
(1618, 81, 'Lanuza'),
(1619, 81, 'Lianga'),
(1620, 81, 'Lingig'),
(1621, 81, 'Madrid'),
(1622, 81, 'Marihatag'),
(1623, 81, 'San Agustin'),
(1624, 81, 'San Miguel'),
(1625, 81, 'Tagbina'),
(1626, 81, 'Tago'),
(1628, 82, 'Basilisa'),
(1629, 82, 'Cagdianao'),
(1630, 82, 'Dinagat'),
(1631, 82, 'Libjo'),
(1632, 82, 'Loreto'),
(1633, 82, 'San Jose (Capital)'),
(1634, 82, 'Tubajon');

-- --------------------------------------------------------

--
-- Table structure for table `table_province`
--

CREATE TABLE `table_province` (
  `province_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_province`
--

INSERT INTO `table_province` (`province_id`, `region_id`, `province_name`) VALUES
(1, 1, 'Metro Manila'),
(67, 2, 'Abra'),
(72, 2, 'Apayao'),
(68, 2, 'Benguet'),
(69, 2, 'Ifugao'),
(70, 2, 'Kalinga'),
(71, 2, 'Mountain Province'),
(2, 3, 'Ilocos Norte'),
(3, 3, 'Ilocos Sur'),
(4, 3, 'La Union'),
(5, 3, 'Pangasinan'),
(6, 4, 'Batanes'),
(7, 4, 'Cagayan'),
(8, 4, 'Isabela'),
(9, 4, 'Nueva Vizcaya'),
(10, 4, 'Quirino'),
(17, 5, 'Aurora'),
(11, 5, 'Bataan'),
(12, 5, 'Bulacan'),
(13, 5, 'Nueva Ecija'),
(14, 5, 'Pampanga'),
(15, 5, 'Tarlac'),
(16, 5, 'Zambales'),
(18, 6, 'Batangas'),
(19, 6, 'Cavite'),
(20, 6, 'Laguna'),
(21, 6, 'Quezon'),
(22, 6, 'Rizal'),
(23, 7, 'Marinduque'),
(24, 7, 'Occidental Mindoro'),
(25, 7, 'Oriental Mindoro'),
(26, 7, 'Palawan'),
(27, 7, 'Romblon'),
(28, 8, 'Albay'),
(29, 8, 'Camarines Norte'),
(30, 8, 'Camarines Sur'),
(31, 8, 'Catanduanes'),
(32, 8, 'Masbate'),
(33, 8, 'Sorsogon'),
(34, 9, 'Aklan'),
(35, 9, 'Antique'),
(36, 9, 'Capiz'),
(39, 9, 'Guimaras'),
(37, 9, 'Iloilo'),
(38, 9, 'Negros Occidental'),
(40, 10, 'Bohol'),
(41, 10, 'Cebu'),
(42, 10, 'Negros Oriental'),
(43, 10, 'Siquijor'),
(49, 11, 'Biliran'),
(44, 11, 'Eastern Samar'),
(45, 11, 'Leyte'),
(46, 11, 'Northern Samar'),
(47, 11, 'Samar'),
(48, 11, 'Southern Leyte'),
(50, 12, 'Zamboanga del Norte'),
(51, 12, 'Zamboanga del Sur'),
(52, 12, 'Zamboanga Sibugay'),
(53, 13, 'Bukidnon'),
(54, 13, 'Camiguin'),
(55, 13, 'Lanao del Norte'),
(56, 13, 'Misamis Occidental'),
(57, 13, 'Misamis Oriental'),
(61, 14, 'Davao de Oro'),
(58, 14, 'Davao del Norte'),
(59, 14, 'Davao del Sur'),
(62, 14, 'Davao Occidental'),
(60, 14, 'Davao Oriental'),
(63, 15, 'Cotabato'),
(66, 15, 'Sarangani'),
(64, 15, 'South Cotabato'),
(65, 15, 'Sultan Kudarat'),
(78, 16, 'Agusan del Norte'),
(79, 16, 'Agusan del Sur'),
(82, 16, 'Dinagat Islands'),
(80, 16, 'Surigao del Norte'),
(81, 16, 'Surigao del Sur'),
(73, 17, 'Basilan'),
(74, 17, 'Lanao del Sur'),
(75, 17, 'Maguindanao'),
(76, 17, 'Sulu'),
(77, 17, 'Tawi-Tawi');

-- --------------------------------------------------------

--
-- Table structure for table `table_region`
--

CREATE TABLE `table_region` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(50) NOT NULL,
  `region_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_region`
--

INSERT INTO `table_region` (`region_id`, `region_name`, `region_description`) VALUES
(1, 'NCR', 'National Capital Region'),
(2, 'CAR', 'Cordillera Administrative Region'),
(3, 'Region I', 'Ilocos Region'),
(4, 'Region II', 'Cagayan Valley'),
(5, 'Region III', 'Central Luzon'),
(6, 'Region IV-A', 'CALABARZON'),
(7, 'Region IV-B', 'MIMAROPA'),
(8, 'Region V', 'Bicol Region'),
(9, 'Region VI', 'Western Visayas'),
(10, 'Region VII', 'Central Visayas'),
(11, 'Region VIII', 'Eastern Visayas'),
(12, 'Region IX', 'Zamboanga Peninsula'),
(13, 'Region X', 'Northern Mindanao'),
(14, 'Region XI', 'Davao Region'),
(15, 'Region XII', 'SOCCSKSARGEN'),
(16, 'Region XIII', 'CARAGA'),
(17, 'ARMM', 'Autonomous Region in Muslim Mindanao');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `TYPE_ID` int(11) NOT NULL,
  `TYPE` enum('user','master') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `profile` mediumblob DEFAULT NULL,
  `user_email` varchar(150) NOT NULL,
  `region` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `home_address` varchar(300) NOT NULL,
  `zip_code` varchar(45) NOT NULL,
  `user_contact` varchar(11) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_type` enum('user','master','staff') NOT NULL,
  `code` int(11) NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `profile`, `user_email`, `region`, `province`, `city`, `home_address`, `zip_code`, `user_contact`, `user_password`, `user_type`, `code`, `user_status`, `datecreated`) VALUES
(1, '0', 'Mark Deofat', 'B', 'Baluran', NULL, 'ilawnatinto2021@gmail.com', '6', '19', '386', 'Brgy Milagrosa', '4116', '099999999', '$2y$10$h6PbB7u6l42.Pzvl3vsKWuvc5DF.hy6KNArNTmjtYGH1GPIDe2SNS', 'master', 0, 'Active', '2022-02-19 06:35:34'),
(32, 'CUS-0000001', 'JM', 'M', 'Libued', NULL, 'jmlibued257@gmail.com', '11', '46', '1022', 'jmlibued25', '4023', '13131', '$2y$10$QjUfOx1CVri7e9lq0UkxuufANzDtxwhxJcI2.BWMCuS1fODvF.yi.', 'user', 0, 'Active', '2022-02-18 20:13:27'),
(45, 'CUS-0000002', 'JM', 'M', 'Libued', NULL, 'JM@yahoo.com', '14', '59', '1262', '66 P, Ocampo Barangay Pacita 1', '4023', '0909871787', '$2y$10$uhsN0ZdhCnMtvfDuKjuP7uI8470WTfmGuNOqpz4ZgKDub9GFxxRAG', 'user', 513279, 'Inactive', '2022-02-19 06:33:59'),
(49, 'CUS-0000004', 'JM', 'M', 'Libued', NULL, '123@gmail.com', '14', '58', '1255', '66 P, Ocampo Barangay Pacita 1', '4023', '09098178726', '$2y$10$dYhaWjYqUYqditQqMAtu4u4bDdjPFv3PK1qnv6d9dZ3nkW33tchmi', 'user', 435627, 'Inactive', '2022-02-19 06:48:24'),
(53, 'CUS-0000005', 'JM', 'M', 'Libued', NULL, '1234@gmail.com', '12', '51', '1122', '66 P, Ocampo Barangay Pacita 1', '4023', '09098178726', '$2y$10$tP0D908PShPWQUzFsbq6MeI8YJnBYe3HE5efQIIHzRAQo6XIbqlz6', 'user', 0, 'Active', '2022-02-19 07:10:33'),
(54, 'CUS-0000006', 'JM', 'M', 'Libued', NULL, '12345@gmail.com', '12', '51', '1122', '66 P, Ocampo Barangay Pacita 1', '4023', '090999999', '$2y$10$99nxQVXVt1w8bsFP3khI/uLXFAsO4cbtS.7R1P6faDO0RBU0ZztVC', 'user', 0, 'Active', '2022-02-19 07:14:31'),
(61, 'CUS-0000007', 'Patrick', 'Magsino', 'Lingahan', NULL, 'patricklingahan0509@gmail.com', '6', '20', '408', '159 General Malvar Street San Vicente', '4024', '09567485622', '$2y$10$0I3bZwZbxgqBQdXUoCUGJuY2Gse7IOGBrcbK.2BybplhqGXnz5q8m', 'user', 0, 'Active', '2022-02-21 07:08:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`courier_id`);

--
-- Indexes for table `inventory_order`
--
ALTER TABLE `inventory_order`
  ADD PRIMARY KEY (`inventory_order_id`);

--
-- Indexes for table `inventory_order_product`
--
ALTER TABLE `inventory_order_product`
  ADD PRIMARY KEY (`inventory_order_product_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`items_id`),
  ADD KEY `category` (`category_id`),
  ADD KEY `supplier` (`supplier_id`),
  ADD KEY `unit` (`measurement_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurement`
--
ALTER TABLE `measurement`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `table_municipality`
--
ALTER TABLE `table_municipality`
  ADD PRIMARY KEY (`municipality_id`),
  ADD UNIQUE KEY `UQT_municipality` (`province_id`,`municipality_name`),
  ADD KEY `IDX_province_id` (`province_id`) USING BTREE,
  ADD KEY `IDX_municipality_name` (`municipality_name`) USING BTREE;

--
-- Indexes for table `table_province`
--
ALTER TABLE `table_province`
  ADD PRIMARY KEY (`province_id`),
  ADD UNIQUE KEY `UQT_provincename` (`region_id`,`province_name`),
  ADD KEY `IDX_province_name` (`province_name`) USING BTREE,
  ADD KEY `IDX_region_id` (`region_id`) USING BTREE;

--
-- Indexes for table `table_region`
--
ALTER TABLE `table_region`
  ADD PRIMARY KEY (`region_id`),
  ADD UNIQUE KEY `UQT_region_name` (`region_name`) USING BTREE,
  ADD KEY `IDX_region_name` (`region_name`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`TYPE_ID`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `courier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory_order`
--
ALTER TABLE `inventory_order`
  MODIFY `inventory_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `inventory_order_product`
--
ALTER TABLE `inventory_order_product`
  MODIFY `inventory_order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `measurement`
--
ALTER TABLE `measurement`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `table_municipality`
--
ALTER TABLE `table_municipality`
  MODIFY `municipality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1635;

--
-- AUTO_INCREMENT for table `table_province`
--
ALTER TABLE `table_province`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `table_region`
--
ALTER TABLE `table_region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `TYPE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
