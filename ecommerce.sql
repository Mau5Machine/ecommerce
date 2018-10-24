-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2018 at 04:25 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `sku` varchar(255) NOT NULL COMMENT 'Item SKU',
  `in_cart` int(11) NOT NULL COMMENT 'How many items are in the cart'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`sku`, `in_cart`) VALUES
('N82E16814137114', 4),
('N82E16814137341', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `sku` varchar(255) NOT NULL COMMENT 'Item SKU',
  `title` varchar(255) NOT NULL COMMENT 'Item title',
  `description` text NOT NULL COMMENT 'Item description',
  `unit_price` float NOT NULL COMMENT 'Item price (each)',
  `in_stock` int(11) NOT NULL COMMENT 'How many are currently in stock'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`sku`, `title`, `description`, `unit_price`, `in_stock`) VALUES
('9SIA6ZP6JP3598', 'EVGA GeForce GTX 1070 Ti SC GAMING', '8GB 256-Bit GDDR5\r\nCore Clock 1607 MHz\r\nBoost Clock 1683 MHz\r\n1 x DVI 1 x HDMI 2.0b 3 x DisplayPort 1.4\r\n2432 CUDA Cores\r\nPCI Express 3.0', 549.99, 29),
('N82E16814137114', 'MSI GeForce GTX 1080 Ti', '11GB 352-Bit GDDR5X\r\nCore Clock 1506 MHz (OC Mode)\r\n1493 MHz (Gaming Mode)\r\n1480 MHz (Silent Mode)\r\nBoost Clock 1620 MHz (OC Mode)\r\n1607 MHz (Gaming Mode)\r\n1582 MHz (Silent Mode)\r\n1 x DL-DVI-D 2 x HDMI 2.0 2 x DisplayPort 1.4\r\n3584 CUDA Cores\r\nPCI Express 3.0 x16', 739.99, 49),
('N82E16814137340', 'MSI GeForce RTX 2080', '8GB 256-Bit GDDR6\r\nCore Clock 1515 MHz\r\nBoost Clock 1860 MHz\r\n1 x HDMI 2.0b 3 x DisplayPort 1.4\r\n2944 CUDA Cores\r\nPCI Express 3.0 x16', 849.99, 120),
('N82E16814137341', 'MSI GeForce RTX 2080 DUKE 8G OC', '8GB 256-Bit GDDR6\r\nCore Clock 1515 MHz\r\nBoost Clock 1845 MHz\r\n1 x HDMI 2.0b 3 x DisplayPort 1.4\r\n2944 CUDA Cores\r\nPCI Express 3.0 x16', 829.99, 218),
('N82E16814487336', 'EVGA GeForce GTX 1080 Ti', 'Real Base Clock: 1556 MHz / Real Boost Clock: 1670 MHz; Memory Detail: 11264 MB GDDR5X\r\n1 x Dual Link DVI-D, 1 x HDMI 2.0b, 3 x DisplayPort 1.4\r\nRedesigned cooling with L-shaped contact fins to improve contact surface area for better heat dissipation.\r\nNew vented heatsink fin design and pin fins for optimized airflow', 789.99, 72),
('N82E16814487404', 'EVGA GeForce RTX 2080 XC GAMING', 'NVIDIA Turing GPU architecture gives up to 6X Faster Performance compared to previous-generation graphics cards.\r\nReal-Time RAY TRACING in games for cutting-edge, hyper-realistic graphics.\r\nDual HDB Fans offer higher performance cooling and much quieter acoustic noise.\r\nAdjustable RGB LED offers configuration options for all your PC lighting needs.', 799.99, 50),
('N82E16819117728', 'Intel Core i5-7600K Kaby Lake Quad-Core 3.8 GHz LGA 1151', '91W BX80677I57600K Desktop Processor', 250.99, 264),
('N82E16819117734', 'Intel Core i3-7100 Kaby Lake Dual-Core 3.9 GHz LGA 1151', '51W BX80677I37100 Desktop Processor Intel HD Graphics 630', 149.99, 10),
('N82E16819117827', 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz (4.7 GHz Turbo) LGA 1151', '(300 Series) 95W BX80684I78700K Desktop Processor Intel UHD Graphics 630', 389.99, 15),
('N82E16820232476', 'G.SKILL TridentZ RGB Series 16GB (2 x 8GB)', '288-Pin DDR4 SDRAM DDR4 3200 (PC4 25600) Desktop Memory Model F4-3200C16D-16GTZR', 154.99, 264),
('N82E16820233863', 'CORSAIR Vengeance LPX 16GB (2 x 8GB)', '288-Pin DDR4 SDRAM DDR4 3000 (PC4 24000) Desktop Memory Model CMK16GX4M2B3000C15R', 139.99, 512);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`sku`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`sku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
