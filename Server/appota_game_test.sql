-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2015 at 11:38 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

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
  `game_user_id` int(11) NOT NULL,
  `game_user_name` varchar(200) NOT NULL,
  `appota_user_name` varchar(200) NOT NULL,
  `appota_user_id` varchar(40) NOT NULL,
  `server_id` varchar(40) NOT NULL,
  `level` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `diamond` int(11) NOT NULL,
  `is_vip` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_user`
--

INSERT INTO `game_user` (`game_user_id`, `game_user_name`, `appota_user_name`, `appota_user_id`, `server_id`, `level`, `gold`, `diamond`, `is_vip`) VALUES
(1, 'chuanpn', 'chuanpn', '1', '1', 1, 0, 20, 0),
(2, 'tuent', 'tue', '2', '1', 0, 0, 0, 0),
(41, 'hieutt', 'hieu', '4', '1', 0, 0, 0, 0),
(44, 'XuanXuXu', 'XuanXuXu', '2618078', '', 0, 0, 401, 0);

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE IF NOT EXISTS `server` (
  `server_id` int(11) NOT NULL,
  `server_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
  `package_id` int(11) NOT NULL,
  `transaction_type` enum('SMS','CARD','BANK','PAYPAL','APPLE_ITUNES') NOT NULL,
  `currency` enum('VND','USD') NOT NULL,
  `exchange_rate` float NOT NULL COMMENT 'exchange rate change to diamond'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
  `package_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_tracking`
--

INSERT INTO `transaction_tracking` (`transaction_id`, `game_user_id`, `server_id`, `package_id`) VALUES
('C7454F92BC2B269A', 44, 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game_user`
--
ALTER TABLE `game_user`
  ADD PRIMARY KEY (`game_user_id`), ADD UNIQUE KEY `game_user_name` (`game_user_name`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`server_id`);

--
-- Indexes for table `transaction_package`
--
ALTER TABLE `transaction_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `transaction_tracking`
--
ALTER TABLE `transaction_tracking`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game_user`
--
ALTER TABLE `game_user`
  MODIFY `game_user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `server`
--
ALTER TABLE `server`
  MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaction_package`
--
ALTER TABLE `transaction_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
