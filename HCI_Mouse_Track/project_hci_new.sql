-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2017 at 12:07 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_hci_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'shirts'),
(2, 'pants');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_details`
--

CREATE TABLE IF NOT EXISTS `product_attribute_details` (
  `product_attribute_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_attribute_detail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `product_attribute_details`
--

INSERT INTO `product_attribute_details` (`product_attribute_detail_id`, `product_id`, `attribute_id`, `attribute_value`) VALUES
(1, 1, 1, 'Red Full Sleeve Shirt '),
(2, 1, 2, '$15.50'),
(3, 1, 3, '/images/1.jpg'),
(4, 1, 4, 'Armani'),
(5, 1, 5, 'Cotton'),
(6, 1, 6, 'Casual'),
(7, 1, 7, 'Red'),
(8, 1, 8, 'Large'),
(9, 2, 1, 'Green Full Sleeve Shirt'),
(10, 2, 2, '$10.00'),
(11, 2, 3, '/images/2.jpg'),
(12, 2, 4, 'Tommy Hilfiger'),
(13, 2, 5, 'Cotton'),
(14, 2, 6, 'Formal'),
(15, 2, 7, 'Green'),
(16, 2, 8, 'Medium'),
(17, 3, 1, 'Blue Formal Shirt'),
(18, 3, 2, '$11.50'),
(19, 3, 3, '/images/3.jpg'),
(20, 3, 4, 'Burberry'),
(21, 3, 5, 'Flannel'),
(22, 3, 6, 'Slim Fit'),
(23, 3, 7, 'Blue'),
(24, 3, 8, 'Large'),
(25, 4, 1, 'Black Casual Shirt'),
(26, 4, 2, '$7.00'),
(27, 4, 3, '/images/4.jpg'),
(28, 4, 4, 'Diesel'),
(29, 4, 5, 'Chambray'),
(30, 4, 6, 'Slim Fit'),
(31, 4, 7, 'Black'),
(32, 4, 8, 'Small'),
(33, 5, 1, 'Pink Casual Shirt'),
(34, 5, 2, '$20.00'),
(35, 5, 3, '/images/5.jpg'),
(36, 5, 4, 'Gucci'),
(37, 5, 5, 'Denim'),
(38, 5, 6, 'Casual'),
(39, 5, 7, 'Pink'),
(40, 5, 8, 'Extra Large');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE IF NOT EXISTS `product_attributes` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`attribute_id`, `attribute_name`) VALUES
(1, 'Product Name'),
(2, 'Price'),
(3, 'Picture'),
(4, 'Vendor'),
(5, 'Fabric'),
(6, 'Type'),
(7, 'Color'),
(8, 'Size');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchased_products`
--

CREATE TABLE IF NOT EXISTS `purchased_products` (
  `purchased_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`purchased_product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `purchased_products`
--

INSERT INTO `purchased_products` (`purchased_product_id`, `product_id`, `user_id`) VALUES
(5, 3, 1),
(10, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `spent_time`
--

CREATE TABLE IF NOT EXISTS `spent_time` (
  `spent_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_attribute_detail_id` int(11) NOT NULL,
  `spent_milisec` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `purchased_product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`spent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `spent_time`
--

INSERT INTO `spent_time` (`spent_id`, `user_id`, `product_attribute_detail_id`, `spent_milisec`, `start_time`, `end_time`, `purchased_product_id`) VALUES
(97, 1, 8, 7, NULL, NULL, NULL),
(96, 1, 7, 5, NULL, NULL, NULL),
(95, 1, 5, 11, NULL, NULL, NULL),
(94, 1, 2, 6, NULL, NULL, NULL),
(15, 1, 5, 2368, NULL, NULL, 5),
(16, 1, 6, 2367, NULL, NULL, 5),
(17, 1, 15, 4063, NULL, NULL, 5),
(18, 1, 23, 23, NULL, NULL, 5),
(19, 1, 22, 2432, NULL, NULL, 5),
(20, 1, 21, 3647, NULL, NULL, 5),
(21, 1, 20, 3528, NULL, NULL, 5),
(22, 1, 18, 3351, NULL, NULL, 5),
(93, 1, 24, 71, NULL, NULL, 10),
(92, 1, 23, 367, NULL, NULL, 10),
(91, 1, 21, 553, NULL, NULL, 10),
(90, 1, 20, 495, NULL, NULL, 10),
(89, 1, 17, 2659, NULL, NULL, 10),
(88, 1, 18, 2501, NULL, NULL, 10),
(87, 1, 4, 351, NULL, NULL, 10),
(86, 1, 12, 285, NULL, NULL, 10),
(85, 1, 13, 245, NULL, NULL, 10),
(84, 1, 22, 542, NULL, NULL, 10),
(83, 1, 2, 510, NULL, NULL, 10),
(82, 1, 1, 488, NULL, NULL, 10),
(81, 1, 5, 553, NULL, NULL, 10),
(80, 1, 6, 376, NULL, NULL, 10),
(79, 1, 7, 280, NULL, NULL, 10),
(78, 1, 8, 232, NULL, NULL, 10),
(77, 1, 16, 358, NULL, NULL, 10),
(76, 1, 15, 430, NULL, NULL, 10),
(75, 1, 14, 359, NULL, NULL, 10),
(74, 1, 10, 367, NULL, NULL, 10),
(73, 1, 9, 663, NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `user_ip`) VALUES
(1, 'sujit', 'sujit@gmail.com', 'maniac.sujit', '::1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
