-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2015 at 06:29 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `MAD`
--
CREATE DATABASE IF NOT EXISTS `MAD` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `MAD`;

-- --------------------------------------------------------

--
-- Table structure for table `Citizen`
--

CREATE TABLE IF NOT EXISTS `Citizen` (
  `cID` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mob` varchar(15) NOT NULL,
  `address_line1` varchar(50) NOT NULL,
  `address_line2` varchar(50) DEFAULT NULL,
  `city` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pin_code` varchar(7) NOT NULL,
  `citizen_govt_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cID`,`email`),
  UNIQUE KEY `mob` (`mob`,`citizen_govt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores information about citizen' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Citizen_reg`
--

CREATE TABLE IF NOT EXISTS `Citizen_reg` (
  `cID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cID`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Citizen_voted_problem`
--

CREATE TABLE IF NOT EXISTS `Citizen_voted_problem` (
  `cID` int(11) NOT NULL,
  `pID` int(11) NOT NULL,
  PRIMARY KEY (`cID`,`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Govt`
--

CREATE TABLE IF NOT EXISTS `Govt` (
  `gID` int(11) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_num` varchar(15) NOT NULL,
  `city` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pin_code` varchar(7) NOT NULL,
  PRIMARY KEY (`gID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Govt_reg`
--

CREATE TABLE IF NOT EXISTS `Govt_reg` (
  `gID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Govt_response_media`
--

CREATE TABLE IF NOT EXISTS `Govt_response_media` (
  `media_ID` int(11) NOT NULL AUTO_INCREMENT,
  `pID` int(11) NOT NULL,
  `media_path` varchar(100) NOT NULL,
  PRIMARY KEY (`media_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Problem`
--

CREATE TABLE IF NOT EXISTS `Problem` (
  `pID` int(11) NOT NULL AUTO_INCREMENT,
  `cID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `to_whom` int(11) NOT NULL COMMENT 'Will have gID as foreign key',
  `city` varchar(30) DEFAULT NULL,
  `district` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pin_code` varchar(7) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `votes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Problem_comment`
--

CREATE TABLE IF NOT EXISTS `Problem_comment` (
  `comment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `pID` int(11) NOT NULL,
  `cID` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Problem_media`
--

CREATE TABLE IF NOT EXISTS `Problem_media` (
  `media_ID` int(11) NOT NULL AUTO_INCREMENT,
  `pID` int(11) NOT NULL,
  `media_path` varchar(100) NOT NULL,
  PRIMARY KEY (`media_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Problem_notified`
--

CREATE TABLE IF NOT EXISTS `Problem_notified` (
  `pID` int(11) NOT NULL,
  `date_notified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Problem_responded`
--

CREATE TABLE IF NOT EXISTS `Problem_responded` (
  `pID` int(11) NOT NULL,
  `response` varchar(200) NOT NULL,
  `date_responded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Problem_solved`
--

CREATE TABLE IF NOT EXISTS `Problem_solved` (
  `pID` int(11) NOT NULL,
  `date_solved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `verified_by_citizen` tinyint(1) NOT NULL DEFAULT '0',
  `verified_by_govt` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Response_citizen_comment`
--

CREATE TABLE IF NOT EXISTS `Response_citizen_comment` (
  `ccID` int(11) NOT NULL AUTO_INCREMENT,
  `pID` int(11) NOT NULL,
  `cID` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ccID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Response_govt_comment`
--

CREATE TABLE IF NOT EXISTS `Response_govt_comment` (
  `gcID` int(11) NOT NULL DEFAULT '0',
  `pID` int(11) NOT NULL,
  `gID` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gcID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
