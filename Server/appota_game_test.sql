-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2015 at 02:14 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `appota_game_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `game_user`
--

CREATE TABLE IF NOT EXISTS `game_user` (
  `game_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_user_name` varchar(200) NOT NULL,
  `appota_user_id` varchar(40) NOT NULL,
  `appota_user_name` varchar(200) NOT NULL,
  `server_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `diamond` int(11) NOT NULL,
  `is_vip` tinyint(1) NOT NULL,
  PRIMARY KEY (`game_user_id`),
  UNIQUE KEY `game_user_name` (`game_user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE IF NOT EXISTS `server` (
  `server_id` int(11) NOT NULL AUTO_INCREMENT,
  `server_name` varchar(255) NOT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`server_id`, `server_name`) VALUES
(1, 'Huyen Vu'),
(2, 'Chu Tuoc');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_package`
--

CREATE TABLE IF NOT EXISTS `transaction_package` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_type` enum('SMS','CARD','BANK','PAYPAL','APPLE_ITUNES') NOT NULL,
  `currency` enum('VND','USD') NOT NULL,
  `exchange_rate` float NOT NULL COMMENT 'exchange rate change to diamond',
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `transaction_package`
--

INSERT INTO `transaction_package` (`package_id`, `transaction_type`, `currency`, `exchange_rate`) VALUES
(1, 'SMS', 'VND', 100),
(2, 'CARD', 'VND', 100),
(3, 'BANK', 'VND', 100),
(4, 'PAYPAL', 'USD', 0.05),
(5, 'APPLE_ITUNES', 'USD', 0.05);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_tracking`
--

CREATE TABLE IF NOT EXISTS `transaction_tracking` (
  `transaction_id` varchar(255) NOT NULL,
  `game_user_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
