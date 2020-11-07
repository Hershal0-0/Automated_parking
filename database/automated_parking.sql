-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2020 at 11:54 AM
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
('5fa51a4adc289', '1', '5', 'hershal', '2020-11-06', '2020-11-06 11:50:00', '2020-11-06 13:50:00');

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
('hershal', '', '0', 'aaaa'),
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

--
-- Indexes for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
