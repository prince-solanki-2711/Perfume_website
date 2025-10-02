-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 23, 2025 at 04:46 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perfume_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_detail`
--

DROP TABLE IF EXISTS `admin_detail`;
CREATE TABLE IF NOT EXISTS `admin_detail` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pass` varchar(10) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_detail`
--

INSERT INTO `admin_detail` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`) VALUES
(1, 'admin', 'admin@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

DROP TABLE IF EXISTS `cart_detail`;
CREATE TABLE IF NOT EXISTS `cart_detail` (
  `cart_id` int(10) NOT NULL,
  `perfume_id` int(10) NOT NULL,
  `cart_quantity` int(10) NOT NULL,
  `cart_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`cart_id`, `perfume_id`, `cart_quantity`, `cart_price`) VALUES
(2, 1, 1, 500),
(3, 4, 1, 5000),
(4, 6, 1, 8000),
(4, 11, 1, 11000),
(4, 4, 1, 5000),
(4, 6, 1, 8000),
(4, 5, 1, 3000),
(4, 6, 1, 8000),
(1, 2, 11, 8500),
(2, 5, 1, 3000),
(3, 1, 1, 500),
(4, 1, 2, 500),
(5, 1, 2, 500),
(5, 2, 2, 8500),
(6, 4, 10, 5000),
(7, 12, 1, 2200),
(8, 6, 4, 8000),
(8, 1, 2, 500),
(9, 7, 1, 2500),
(10, 4, 1, 5000),
(11, 3, 2, 7500),
(12, 4, 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `cart_master`
--

DROP TABLE IF EXISTS `cart_master`;
CREATE TABLE IF NOT EXISTS `cart_master` (
  `cart_id` int(10) NOT NULL,
  `cart_date` date NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_master`
--

INSERT INTO `cart_master` (`cart_id`, `cart_date`) VALUES
(1, '2025-09-02'),
(2, '2025-09-02'),
(3, '2025-09-06'),
(4, '2025-09-09'),
(5, '2025-09-10'),
(6, '2025-09-15'),
(7, '2025-09-16'),
(8, '2025-09-16'),
(9, '2025-09-16'),
(10, '2025-09-16'),
(11, '2025-09-17'),
(12, '2025-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `category_perfume`
--

DROP TABLE IF EXISTS `category_perfume`;
CREATE TABLE IF NOT EXISTS `category_perfume` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_perfume`
--

INSERT INTO `category_perfume` (`category_id`, `category_name`) VALUES
(1, 'women'),
(2, 'men'),
(3, 'unisex');

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

DROP TABLE IF EXISTS `customer_detail`;
CREATE TABLE IF NOT EXISTS `customer_detail` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` varchar(200) NOT NULL,
  `customer_city` varchar(50) NOT NULL,
  `customer_mobile` varchar(10) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_pass` varchar(10) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_detail`
--

INSERT INTO `customer_detail` (`customer_id`, `customer_name`, `customer_address`, `customer_city`, `customer_mobile`, `customer_email`, `customer_pass`) VALUES
(1, 'tushar', 'halar', 'valsad', '5676456764', 'customer@gmail.com', '123456'),
(2, 'prince', 'valsad pardi', 'valsad', '7800988990', 'prince@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `cart_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `order_address` varchar(200) NOT NULL,
  `order_mobile` varchar(10) NOT NULL,
  `order_amount` int(10) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `order_date`, `cart_id`, `customer_id`, `order_address`, `order_mobile`, `order_amount`) VALUES
(1, '2025-09-16', 8, 1, 'valsad ', '9876543210', 33000),
(2, '2025-09-16', 9, 1, 'halar', '8967834234', 10000),
(3, '2025-09-16', 9, 1, 'halar', '3423465456', 2500),
(4, '2025-09-16', 10, 2, 'valsad', '6787655441', 5000),
(5, '2025-09-17', 11, 1, '', '', 15000),
(6, '2025-09-17', 12, 1, '', '', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `perfume_detail`
--

DROP TABLE IF EXISTS `perfume_detail`;
CREATE TABLE IF NOT EXISTS `perfume_detail` (
  `perfume_id` int(10) NOT NULL,
  `perfume_name` varchar(50) NOT NULL,
  `category_id` int(10) NOT NULL,
  `perfume_description` varchar(200) NOT NULL,
  `perfume_price` int(10) NOT NULL,
  `perfume_image` varchar(50) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  PRIMARY KEY (`perfume_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perfume_detail`
--

INSERT INTO `perfume_detail` (`perfume_id`, `perfume_name`, `category_id`, `perfume_description`, `perfume_price`, `perfume_image`, `supplier_id`) VALUES
(1, 'FOGG', 2, 'exciting perfume for men', 500, 'perfume_img/1756046417.png', 1),
(2, 'Bleu de Chanel', 2, 'A woody aromatic fragrance with citrus notes.', 8500, 'perfume_img/1756046488.png', 1),
(3, 'Sauvage', 2, 'Fresh and spicy fragrance with bergamot.', 7500, 'perfume_img/1756053589.png', 1),
(4, 'Acqua di Gio', 2, 'Marine-inspired fragrance with citrus freshness.', 5000, 'perfume_img/1756046736.png', 1),
(5, 'Black Opium', 1, 'Warm and spicy with coffee and vanilla notes.', 3000, 'perfume_img/1756046885.png', 1),
(6, 'Gucci Bloom', 1, 'Floral fragrance with tuberose and jasmine.', 8000, 'perfume_img/1756046978.png', 1),
(7, 'Light Blue', 1, 'Fresh fruity fragrance with Sicilian lemon.', 2500, 'perfume_img/1756047088.png', 1),
(8, 'CK One', 3, 'Citrus aromatic fragrance for all genders.', 3500, 'perfume_img/1756047186.png', 1),
(9, 'Tom Ford Neroli Portofino', 3, 'Fresh citrus and floral fragrance.', 18000, 'perfume_img/1756047272.png', 1),
(10, 'Molecule ', 3, 'Unique woody aroma with ISO E Super note.', 3000, 'perfume_img/1756047420.png', 1),
(11, 'Byredo Gypsy Water', 3, 'Woody aromatic fragrance with vanilla hint.', 11000, 'perfume_img/1756047458.png', 1),
(12, 'Nautica Voyage', 2, 'Fresh aquatic scent with apple, green leaves, and musk.', 2200, 'perfume_img/1756868010.png', 1),
(13, 'Jaguar Classic Black', 2, 'Elegant fragrance with mandarin, green apple, and sandalwood.', 2800, 'perfume_img/1756868106.png', 1),
(14, 'Versace Bright Crystal', 1, 'Floral fruity fragrance with pomegranate, lotus, and musk.', 4600, 'perfume_img/1756868243.png', 1),
(15, 'Elizabeth Arden Green Tea', 1, 'Light refreshing fragrance with green tea, mint, and lemon.', 2100, 'perfume_img/1756868345.png', 1),
(16, 'Victoria Secret Bombshell', 1, 'Fresh floral fragrance with passionfruit, peony, and musk.', 3900, 'perfume_img/1756868540.png', 1),
(17, 'Davidoff Cool Water Wave', 3, 'Fresh oceanic fragrance with grapefruit, marine notes, and patchouli.', 3000, 'perfume_img/1756868569.png', 1),
(18, 'Montale Intense Cafe', 3, 'Warm gourmand fragrance with coffee, vanilla, and rose.', 7500, 'perfume_img/1756868650.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_detail`
--

DROP TABLE IF EXISTS `supplier_detail`;
CREATE TABLE IF NOT EXISTS `supplier_detail` (
  `supplier_id` int(10) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_address` varchar(200) NOT NULL,
  `supplier_city` varchar(50) NOT NULL,
  `supplier_mobile` varchar(10) NOT NULL,
  `supplier_email` varchar(50) NOT NULL,
  `supplier_pass` varchar(10) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_detail`
--

INSERT INTO `supplier_detail` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_city`, `supplier_mobile`, `supplier_email`, `supplier_pass`) VALUES
(1, 'prince', 'valsad', 'valsad', '9089765567', 'supplier@gmail.com', '123456'),
(2, 'viraj', 'mograwadi', 'valsad', '6767898786', 'viraj@gmail.com', '123456');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perfume_detail`
--
ALTER TABLE `perfume_detail`
  ADD CONSTRAINT `perfume_detail_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_perfume` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
