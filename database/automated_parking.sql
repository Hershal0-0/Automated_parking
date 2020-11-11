-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2020 at 06:45 AM
-- Server version: 5.7.28
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automated_parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `booking_id` varchar(50) NOT NULL,
  `area_id` varchar(25) NOT NULL,
  `spot_id` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `booking_date` varchar(25) NOT NULL,
  `from_datetime` varchar(35) NOT NULL,
  `to_datetime` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`booking_id`, `area_id`, `spot_id`, `username`, `booking_date`, `from_datetime`, `to_datetime`) VALUES
('1', '1', '1', 'hershal', '2020-11-06 11:50:00', '2020-11-06 11:50:00', '2020-11-06 12:50:00'),
('1', '1', '2', 'hershal', '2020-11-06 11:50:00', '2020-11-06 11:50:00', '2020-11-06 12:50:00'),
('5fa4eea32c119', '3', '14', 'hershal', '2020-11-06', '2020-11-06 11:50:00', '2020-11-06 12:50:00'),
('5fa4eee449ab6', '4', '14', 'hershal', '2020-11-06', '2020-11-26 11:50:00', '2020-11-26 12:50:00'),
('5fa50eff4aaed', '4', '14', 'hershal', '2020-11-06', '2020-11-26 11:50:00', '2020-11-26 12:50:00'),
('5fa510fe759d2', '1', '1', 'hershal', '2020-11-06', '2020-11-06 00:50:00', '2020-11-06 01:50:00'),
('5fa51a3e984c7', '1', '3', 'hershal', '2020-11-06', '2020-11-06 11:50:00', '2020-11-06 13:50:00'),
('5fa51a4adc289', '1', '5', 'hershal', '2020-11-06', '2020-11-06 11:50:00', '2020-11-06 13:50:00'),
('5fa8dbcd2770c', '', '', 'hershal', '2020-11-09', '', ''),
('5fa8dbe86234c', '', '', 'hershal', '2020-11-09', '', ''),
('5fa8dbeaddb5f', '', '', 'hershal', '2020-11-09', '', ''),
('', '', '', 'hershal', '', '', ''),
('', '', '', 'hershal', '', '', ''),
('5fa8dc45b8f16', '4', '18', 'hershal', '2020-11-09', '', '2020-11-30 19:35:00'),
('5fa8dc7f66ccf', '4', '18', 'hershal', '2020-11-09', '', '2020-11-30 19:35:00'),
('5fa8dc84b0a11', '4', '18', 'hershal', '2020-11-09', '', '2020-11-30 19:35:00'),
('5fa8dca5626b2', '4', '18', 'hershal', '2020-11-09', '11:35', '2020-11-30 19:35:00'),
('5fa8dcb76f114', '4', '18', 'hershal', '2020-11-09', '11:35', '2020-11-30 19:35:00'),
('5fa8de258765e', '4', '12', 'hershal', '2020-11-09', '11:43', '2020-11-09 17:43:00'),
('5fa8def54da7a', '1', '4', 'hershal', '2020-11-09', '11:46', '2020-11-10 12:46:00'),
('5fa8e039cbd40', '1', '5', 'hershal', '2020-11-09', '2020-11-09 11:52:00', '2020-11-09 12:52:00'),
('5fa8e6452b4b7', '1', '5', 'hershal', '2020-11-09', '2020-11-09 11:52:00', '2020-11-09 12:52:00'),
('5fa8e6c0238c8', '1', '5', 'hershal', '2020-11-09', '2020-11-09 11:52:00', '2020-11-09 12:52:00'),
('5fa8e7653b66f', '1', '3', 'hershal', '2020-11-09', '2020-11-09 12:22:00', '2020-11-09 13:22:00'),
('5fa8f284d2580', '1', '3', 'hershal', '2020-11-09', '2020-11-09 12:22:00', '2020-11-09 13:22:00'),
('5fa8f48210d70', '1', '3', 'hershal', '2020-11-09', '2020-11-09 12:22:00', '2020-11-09 13:22:00'),
('5fa8f4870b26e', '1', '3', 'hershal', '2020-11-09', '2020-11-09 12:22:00', '2020-11-09 13:22:00'),
('', '', '', '', '', '', ''),
('5faa7a3d0cf7b', '1', '3', 'hershal', '2020-11-10', '2020-11-09 11:01:00', '2020-11-09 17:01:00'),
('5faaafd172ad0', '1', '3', 'hershal', '2020-11-10', '2020-11-09 11:01:00', '2020-11-09 17:01:00'),
('5faab09db3ca1', '1', '3', 'hershal', '2020-11-10', '2020-11-09 11:01:00', '2020-11-09 17:01:00'),
('5faab10f81634', '1', '3', 'hershal', '2020-11-10', '2020-11-09 11:01:00', '2020-11-09 17:01:00'),
('5faab53cd4c30', '1', '3', 'hershal', '2020-11-10', '2020-11-09 11:01:00', '2020-11-09 17:01:00'),
('5faab553429c7', '1', '3', 'hershal', '2020-11-10', '2020-11-09 11:01:00', '2020-11-09 17:01:00'),
('5faab55a930d2', '1', '3', 'hershal', '2020-11-10', '2020-11-09 11:01:00', '2020-11-09 17:01:00'),
('5faab55e6b3ae', '1', '3', 'hershal', '2020-11-10', '2020-11-09 11:01:00', '2020-11-09 17:01:00'),
('5faab57f05b09', '1', '5', 'hershal', '2020-11-10', '2020-11-09 11:14:00', '2020-11-09 18:14:00'),
('5faab59d28b47', '1', '5', 'hershal', '2020-11-10', '2020-11-09 11:14:00', '2020-11-09 18:14:00'),
('5faab5a172c44', '1', '5', 'hershal', '2020-11-10', '2020-11-09 11:14:00', '2020-11-09 18:14:00'),
('5faab5b877557', '1', '5', 'hershal', '2020-11-10', '2020-11-09 11:14:00', '2020-11-09 18:14:00'),
('5faab64224e56', '1', '5', 'hershal', '2020-11-10', '2020-11-09 11:14:00', '2020-11-09 18:14:00'),
('5faab7744183c', '1', '5', 'hershal', '2020-11-10', '2020-11-09 11:14:00', '2020-11-09 18:14:00'),
('5faab87f7452b', '1', '5', 'hershal', '2020-11-10', '2020-11-09 11:14:00', '2020-11-09 18:14:00'),
('5faad56981720', '4', '2', 'hershal', '2020-11-10', '2020-11-09 11:30:00', '2020-11-09 12:30:00'),
('5faad5cfcda24', '4', '2', 'hershal', '2020-11-10', '2020-11-09 11:30:00', '2020-11-09 12:30:00'),
('5faad5ef67003', '4', '2', 'hershal', '2020-11-10', '2020-11-09 11:30:00', '2020-11-09 12:30:00'),
('5faad6959973b', '4', '2', 'hershal', '2020-11-10', '2020-11-09 11:30:00', '2020-11-09 12:30:00'),
('5faad738e4a4c', '4', '2', 'hershal', '2020-11-10', '2020-11-09 11:30:00', '2020-11-09 12:30:00'),
('5faada9528a9d', '4', '2', 'hershal', '2020-11-10', '2020-11-09 11:30:00', '2020-11-09 12:30:00'),
('5faaebe740d20', '4', '2', 'hershal', '2020-11-10', '2020-11-09 11:30:00', '2020-11-09 12:30:00'),
('5faaeca0d095a', '4', '19', 'hershal', '2020-11-10', '2020-11-09 11:08:00', '2020-11-09 16:08:00'),
('5faaed7d77aac', '1', '2', 'hershal', '2020-11-10', '2020-11-09 11:13:00', '2020-11-09 15:13:00'),
('5faaf299443bb', '1', '2', 'hershal', '2020-11-10', '2020-11-09 11:13:00', '2020-11-09 15:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `username` varchar(12) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`username`, `email_id`, `mobile`, `password`) VALUES
('hello', 'hello@gmail.com', '7977391698', 'aaaaa'),
('hershal', 'hershalrao@gmail.com', '7977391698', 'aaaa'),
('number2', '', '0', '1234'),
('tanisha', '', '0', '1234'),
('user1', '', '0', 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `parking_areas`
--

CREATE TABLE `parking_areas` (
  `area_id` varchar(25) NOT NULL,
  `parking_spots` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking_areas`
--

INSERT INTO `parking_areas` (`area_id`, `parking_spots`) VALUES
('1', 5),
('2', 10),
('3', 15),
('4', 20);

-- --------------------------------------------------------

--
-- Table structure for table `parking_spots`
--

CREATE TABLE `parking_spots` (
  `spot_id` varchar(25) NOT NULL,
  `area_id` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `last_4digits` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `customer_id`, `booking_id`, `product`, `amount`, `currency`, `status`, `last_4digits`, `created_at`) VALUES
('', '', '', '', '', 'INR', 'Success', '', '2020-11-09 14:04:38'),
('ch_1HlUD5IT4kRr32BIqL1cvNID', 'hershal', '5fa8e6c0238c8', 'Parking Spot', '10', 'INR', 'Success', '', '2020-11-09 12:20:40'),
('ch_1HlUFkIT4kRr32BICcQXfoGN', 'hershal', '5fa8e7653b66f', 'Parking Spot', '10', 'INR', 'Success', '', '2020-11-09 12:23:25'),
('ch_1HlUzgIT4kRr32BIJNHE7NTa', 'hershal', '5fa8f284d2580', 'Parking Spot', '10', 'INR', 'Success', '', '2020-11-09 13:10:52'),
('ch_1Hlv56IT4kRr32BIslfLTpLH', 'hershal', '5faa7a3d0cf7b', 'Parking Spot', '60', 'INR', 'Success', '', '2020-11-10 17:02:13'),
('ch_1HlyeKIT4kRr32BILFus97GN', 'hershal', '5faaafd172ad0', 'Parking Spot', '60', 'INR', 'Success', '', '2020-11-10 20:50:49'),
('ch_1Hlz1mIT4kRr32BINnuZD0oC', 'hershal', '5faab57f05b09', 'Parking Spot', '70', 'INR', 'Success', '', '2020-11-10 21:15:03'),
('ch_1Hlz2hIT4kRr32BIevbIRiES', 'hershal', '5faab5b877557', 'Parking Spot', '70', 'INR', 'Success', '', '2020-11-10 21:16:00'),
('ch_1Hm19YIT4kRr32BIbRd03nDn', 'hershal', '5faad56981720', 'Parking Spot', '10', 'INR', 'Success', '', '2020-11-10 23:31:13'),
('ch_1Hm1BiIT4kRr32BIOsR4UV5o', 'hershal', '5faad5ef67003', 'Parking Spot', '10', 'INR', 'Success', '', '2020-11-10 23:33:27'),
('ch_1Hm1EOIT4kRr32BIfzNvOVLz', 'hershal', '5faad6959973b', 'Parking Spot', '10', 'INR', 'Success', '', '2020-11-10 23:36:13'),
('ch_1Hm1UuIT4kRr32BIlr7pUvXv', 'hershal', '5faada9528a9d', 'Parking Spot', '10', 'INR', 'Success', '', '2020-11-10 23:53:17'),
('ch_1Hm2hQIT4kRr32BIqpr2WYau', 'hershal', '5faaeca0d095a', 'Parking Spot', '50', 'INR', 'Success', '', '2020-11-11 01:10:16'),
('ch_1Hm2kyIT4kRr32BIbqchyGD6', 'hershal', '5faaed7d77aac', 'Parking Spot', '40', 'INR', 'Success', '', '2020-11-11 01:13:57'),
('ch_1Hm364IT4kRr32BIGCCXkDOn', 'hershal', '5faaf299443bb', 'Parking Spot', '40', 'INR', 'Success', '', '2020-11-11 01:35:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `parking_areas`
--
ALTER TABLE `parking_areas`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `parking_spots`
--
ALTER TABLE `parking_spots`
  ADD PRIMARY KEY (`spot_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
