-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2015 at 01:23 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `Citizen`
--

CREATE TABLE IF NOT EXISTS `Citizen` (
  `cID` int(11) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mob` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `address_line1` varchar(50) NOT NULL,
  `address_line2` varchar(50) DEFAULT NULL,
  `city` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pin_code` varchar(7) NOT NULL,
  `pp_path` varchar(30) DEFAULT NULL,
  `citizen_govt_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cID`,`email`),
  UNIQUE KEY `mob` (`citizen_govt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores information about citizen';

--
-- Dumping data for table `Citizen`
--

INSERT INTO `Citizen` (`cID`, `f_name`, `l_name`, `email`, `mob`, `dob`, `address_line1`, `address_line2`, `city`, `district`, `state`, `pin_code`, `pp_path`, `citizen_govt_id`) VALUES
(2, 'Aravind', 'Ashok', 'aravindasokcn@gmail.com', '8374318559', '1995-02-05', 'boys hostel', 'iiit', 'Sri City', 'Chittoor', 'Andhra Pradesh', '517588', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `Citizen_reg`
--

CREATE TABLE IF NOT EXISTS `Citizen_reg` (
  `cID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date_reg` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cID`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Citizen_reg`
--

INSERT INTO `Citizen_reg` (`cID`, `email`, `password`, `date_reg`, `active`) VALUES
(2, 'aravindasokcn@gmail.com', 'b691c96a0e0e2674df4943221d5b4767', '2015-12-02 16:47:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Citizen_voted_comment`
--

CREATE TABLE IF NOT EXISTS `Citizen_voted_comment` (
  `comment_id` int(11) NOT NULL,
  `pID` int(11) NOT NULL,
  `cID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `gID` int(11) NOT NULL,
  `dep_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_num` varchar(15) NOT NULL,
  `city` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pin_code` varchar(7) NOT NULL,
  PRIMARY KEY (`gID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Govt`
--

INSERT INTO `Govt` (`gID`, `dep_name`, `email`, `contact_num`, `city`, `district`, `state`, `pin_code`) VALUES
(2, 'Water', 'water.chittoor@mail.com', '123456', 'Sri City', 'Chittoor', 'Andhra Pradesh', '517588');

-- --------------------------------------------------------

--
-- Table structure for table `Govt_reg`
--

CREATE TABLE IF NOT EXISTS `Govt_reg` (
  `gID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date_registered` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Govt_reg`
--

INSERT INTO `Govt_reg` (`gID`, `email`, `password`, `date_registered`, `active`) VALUES
(2, 'water.chittoor@mail.com', '94978e53e0b8829141aebc78bc917fc8', '2015-12-02 18:07:08', 1);

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
-- Table structure for table `Govt_voted_comment`
--

CREATE TABLE IF NOT EXISTS `Govt_voted_comment` (
  `comment_id` int(11) NOT NULL,
  `pID` int(11) NOT NULL,
  `gID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `pin_code` varchar(7) NOT NULL,
  `date_created` datetime NOT NULL,
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
  `date_notified` datetime NOT NULL,
  PRIMARY KEY (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Problem_responded`
--

CREATE TABLE IF NOT EXISTS `Problem_responded` (
  `pID` int(11) NOT NULL,
  `response` varchar(200) NOT NULL,
  `date_responded` datetime NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Problem_solved`
--

CREATE TABLE IF NOT EXISTS `Problem_solved` (
  `pID` int(11) NOT NULL,
  `verified_by_citizen` tinyint(1) NOT NULL DEFAULT '0',
  `date_verified_by_citizen` datetime DEFAULT NULL,
  `verified_by_govt` tinyint(1) NOT NULL DEFAULT '0',
  `date_verified_by_govt` datetime DEFAULT NULL,
  `solved` tinyint(1) NOT NULL DEFAULT '0',
  `date_solved` datetime DEFAULT NULL,
  PRIMARY KEY (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Problem_status`
--

CREATE TABLE IF NOT EXISTS `Problem_status` (
  `pID` int(11) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'created, notified, taken_up, declined, notified_pincode, notified_local, solved',
  `date_created` datetime NOT NULL,
  `date_notified` datetime DEFAULT NULL,
  `date_taken_up` datetime DEFAULT NULL,
  `date_declined` datetime DEFAULT NULL,
  `date_notified_pincode` datetime DEFAULT NULL,
  `date_notified_local` datetime DEFAULT NULL,
  `date_solved` datetime DEFAULT NULL,
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
