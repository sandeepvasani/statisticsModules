-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2015 at 02:31 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_statistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `ques_tbl`
--

CREATE TABLE IF NOT EXISTS `ques_tbl` (
  `qno` int(11) NOT NULL,
  `question` varchar(255) CHARACTER SET latin1 NOT NULL,
  `opt1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `opt2` varchar(255) CHARACTER SET latin1 NOT NULL,
  `opt3` varchar(255) CHARACTER SET latin1 NOT NULL,
  `opt4` varchar(255) CHARACTER SET latin1 NOT NULL,
  `rightans` float NOT NULL,
  `ques_type` int(2) NOT NULL,
  PRIMARY KEY (`qno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ques_tbl`
--

INSERT INTO `ques_tbl` (`qno`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `rightans`, `ques_type`) VALUES
(1, '3,4,5,6,7,8', '0', '0', '0', '0', 5.5, 0),
(2, '1,4,5,6,7,8,9', '0', '0', '0', '0', 6, 0),
(3, '17,18,19', '0', '0', '0', '0', 18, 0),
(4, '17,18,19,20,21', '0', '0', '0', '0', 19, 0),
(5, '50,51,52,53', '0', '0', '0', '0', 52.5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE IF NOT EXISTS `user_tbl` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(150) DEFAULT NULL,
  `LastName` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `upassword` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_role` varchar(15) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`PID`, `FirstName`, `LastName`, `email`, `upassword`, `phone_number`, `address`, `user_role`, `date`) VALUES
(1, 'Admin', 'Patel', 'admin@statistics.com', 'admin', '8324657891', '1620 Bay Area Blvd', 'admin', '2015-09-21 00:00:00'),
(2, 'Ankur', 'Patel', 'ankur@gmail.com', 'Password123', '8326149706', '2001 Gemini Street, Apt 1503\r\nCove', 'student', NULL),
(13, 'sandeep', 'vasani', 'sandeep@gmail.com', '9eab4851cca0f61bba23a2531dd4250638754e8f8beb12d950d816569abac207e86f99025f39f5e6db11cd5d14bcc9d1baf47155d83cafe044e1de999c945934', '1234567890', 'abc', 'student', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
