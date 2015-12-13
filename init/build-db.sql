-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2015 at 02:05 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brownequipment`
--
CREATE DATABASE IF NOT EXISTS `brownequipment` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `brownequipment`;

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `ID` int(100) NOT NULL,
  `Type` varchar(32) NOT NULL,
  `Subtype` varchar(32) NOT NULL,
  `Quantity` int(12) NOT NULL,
  `Year` year(4) DEFAULT NULL,
  `Make` varchar(32) NOT NULL,
  `Model` varchar(32) DEFAULT NULL,
  `S_N` varchar(32) DEFAULT NULL,
  `Cost` decimal(65,0) NOT NULL,
  `Price` decimal(65,0) NOT NULL,
  `Seller` varchar(32) NOT NULL,
  `Location` int(11) NOT NULL,
  `Date_Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Picture_URL` varchar(256) DEFAULT NULL,
  `Visible` tinyint(1) NOT NULL DEFAULT '0',
  `Description` varchar(256) DEFAULT NULL,
  `Comment` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `ID` int(11) NOT NULL,
  `Street` varchar(64) DEFAULT NULL,
  `City` varchar(32) DEFAULT NULL,
  `ZIP` int(5) DEFAULT NULL,
  `State` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Table structure for table `makes`
--

CREATE TABLE IF NOT EXISTS `makes` (
  `Make` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `sellerlocation`
--

CREATE TABLE IF NOT EXISTS `sellerlocation` (
  `Seller` varchar(32) NOT NULL,
  `LocationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `sellers`
--

CREATE TABLE IF NOT EXISTS `sellers` (
  `Seller` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `subtypes`
--

CREATE TABLE IF NOT EXISTS `subtypes` (
  `Type` varchar(32) NOT NULL,
  `SubType` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `Type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-----------------------------------------------------------
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `makes`
--
ALTER TABLE `makes`
  ADD PRIMARY KEY (`Make`) USING BTREE;

--
-- Indexes for table `sellerlocation`
--
ALTER TABLE `sellerlocation`
  ADD PRIMARY KEY (`Seller`,`LocationID`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`Seller`) USING BTREE;

--
-- Indexes for table `subtypes`
--
ALTER TABLE `subtypes`
  ADD PRIMARY KEY (`Type`,`SubType`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`Type`) USING BTREE;

-----------------------------------------------------------
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
