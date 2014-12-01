-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2014 at 10:11 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `accomplishment`
--
CREATE DATABASE IF NOT EXISTS `accomplishment` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `accomplishment`;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `billing_type`) VALUES
(1, 'Per Piece'),
(2, 'Crew Type'),
(3, 'Lump Sum'),
(4, 'Progress'),
(5, 'Cost +');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE IF NOT EXISTS `contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `area_id` varchar(200) NOT NULL,
  `billing_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contract` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `con_id`, `area_id`, `billing_id`, `user_id`, `contract`) VALUES
(1, 2, '1,3,4', '1,3,4', 1, 'RJG'),
(2, 3, '5', '1', 2, 'KHJL'),
(3, 4, '6', '1', 2, 'LKK'),
(4, 5, '1', '1', 2, 'HLT'),
(6, 8, '1,7,8', '1', 1, 'RTB'),
(7, 8, '5,4,1,2', '3', 1, 'GHR'),
(8, 9, '2,6,7', '1', 2, 'JDB'),
(9, 10, '9,10,11,12', '4', 2, 'JKL');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE IF NOT EXISTS `dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `d_dates` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`id`, `d_dates`) VALUES
(1, '2014-01-01'),
(2, '2014-01-02'),
(3, '2014-01-03'),
(4, '2014-01-04'),
(5, '2014-01-05'),
(6, '2014-01-06'),
(7, '2014-01-08'),
(8, '1970-01-01'),
(9, '2014-01-09'),
(10, '2014-01-10'),
(11, '2014-01-07'),
(12, '2014-01-11'),
(13, '2014-01-12'),
(14, '2014-01-13'),
(15, '2014-01-14'),
(16, '2014-01-15'),
(17, '2014-01-16'),
(18, '2014-01-17'),
(19, '2014-01-18'),
(20, '2014-01-19'),
(21, '2014-01-20'),
(22, '2014-01-21'),
(23, '2014-01-22'),
(24, '2014-01-23'),
(25, '2014-01-24'),
(26, '2014-01-25'),
(27, '2014-01-26'),
(28, '2014-01-27'),
(29, '2014-01-28'),
(30, '2014-01-29'),
(31, '2014-01-30'),
(32, '2014-01-31'),
(33, '2014-02-01'),
(34, '2014-02-02'),
(35, '2014-02-03'),
(36, '2014-02-04'),
(37, '2014-02-05'),
(38, '2014-02-06'),
(39, '2014-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `executed`
--

CREATE TABLE IF NOT EXISTS `executed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `executed`
--

INSERT INTO `executed` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '9', 1),
(2, 2, 2, '12', 1),
(3, 2, 3, '5', 1),
(4, 2, 4, '18', 1),
(5, 3, 1, '4', 5),
(6, 3, 2, '5', 5),
(7, 3, 3, '6', 5),
(8, 2, 5, '0', 1),
(9, 2, 6, '4', 1),
(10, 2, 7, '9', 1),
(11, 2, 9, '15', 1),
(12, 2, 10, '15', 1),
(13, 2, 11, '8', 1),
(14, 2, 12, '8', 1),
(15, 2, 13, '8', 1),
(16, 2, 14, '8', 1),
(17, 2, 15, '8', 1),
(18, 2, 16, '8', 1),
(19, 2, 17, '8', 1),
(20, 2, 18, '8', 1),
(21, 2, 19, '8', 1),
(22, 2, 20, '8', 1),
(23, 2, 21, '8', 1),
(24, 2, 22, '8', 1),
(25, 2, 23, '8', 1),
(26, 2, 24, '8', 1),
(27, 2, 25, '8', 1),
(28, 2, 26, '8', 1),
(29, 2, 27, '8', 1),
(30, 2, 28, '8', 1),
(31, 2, 29, '8', 1),
(32, 2, 30, '8', 1),
(33, 2, 31, '8', 1),
(34, 2, 32, '8', 1),
(35, 2, 33, '9', 1),
(36, 2, 34, '10', 1),
(37, 2, 35, '10', 1),
(38, 2, 36, '15', 1),
(39, 2, 37, '7', 1),
(40, 2, 38, '8', 1),
(41, 0, 0, '8', 7),
(42, 0, 0, '8', 2),
(43, 8, 1, '8', 2),
(44, 8, 2, '5', 2),
(45, 8, 33, '6', 2),
(46, 8, 34, '9', 2);

-- --------------------------------------------------------

--
-- Table structure for table `for_billing`
--

CREATE TABLE IF NOT EXISTS `for_billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `for_billing`
--

INSERT INTO `for_billing` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '8', 1),
(2, 2, 2, '9', 1),
(3, 2, 3, '10', 1),
(4, 2, 4, '11', 1),
(5, 2, 5, '12', 1),
(6, 2, 8, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guaranteed`
--

CREATE TABLE IF NOT EXISTS `guaranteed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `guaranteed`
--

INSERT INTO `guaranteed` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 8, '', 1),
(2, 2, 1, '10', 1),
(3, 2, 2, '10', 1),
(4, 2, 3, '10', 1),
(5, 2, 4, '10', 1),
(6, 2, 5, '0', 1),
(7, 2, 7, '9', 1),
(8, 2, 9, '10', 1),
(9, 2, 10, '15', 1),
(10, 2, 6, '8', 1),
(11, 2, 11, '8', 1),
(12, 2, 12, '8', 1),
(13, 2, 13, '8', 1),
(14, 2, 14, '8', 1),
(15, 2, 15, '8', 1),
(16, 2, 16, '8', 1),
(17, 2, 17, '8', 1),
(18, 2, 18, '8', 1),
(19, 2, 19, '8', 1),
(20, 2, 20, '8', 1),
(21, 2, 21, '8', 1),
(22, 2, 22, '8', 1),
(23, 2, 23, '8', 1),
(24, 2, 24, '8', 1),
(25, 2, 25, '8', 1),
(26, 2, 26, '8', 1),
(27, 2, 27, '8', 1),
(28, 2, 28, '8', 1),
(29, 2, 29, '8', 1),
(30, 2, 30, '8', 1),
(31, 2, 31, '8', 1),
(32, 2, 32, '8', 1),
(33, 2, 33, '9', 1),
(34, 2, 34, '10', 1),
(35, 2, 35, '10', 1),
(36, 2, 36, '15', 1),
(37, 2, 37, '9', 1),
(38, 2, 38, '8', 1),
(39, 0, 0, '8', 7),
(40, 0, 0, '8', 2),
(41, 8, 1, '8', 2),
(42, 8, 2, '5', 2),
(43, 8, 33, '9', 2),
(44, 8, 34, '6', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lump_ofs`
--

CREATE TABLE IF NOT EXISTS `lump_ofs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lump_ofs`
--

INSERT INTO `lump_ofs` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '5', 1),
(2, 2, 2, '30', 1),
(3, 2, 33, '10', 1),
(4, 2, 34, '5', 1),
(5, 2, 35, '20', 1),
(6, 7, 1, '6', 5),
(7, 7, 2, '10', 5),
(8, 7, 33, '0', 5),
(9, 7, 34, '5', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lump_penalty`
--

CREATE TABLE IF NOT EXISTS `lump_penalty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lump_penalty`
--

INSERT INTO `lump_penalty` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '5', 1),
(2, 2, 2, '5', 1),
(3, 2, 33, '10', 1),
(4, 2, 34, '5', 1),
(5, 2, 35, '5', 1),
(6, 7, 1, '5', 5),
(7, 7, 2, '8', 5),
(8, 7, 33, '0', 5),
(9, 7, 34, '2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lump_planned`
--

CREATE TABLE IF NOT EXISTS `lump_planned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lump_planned`
--

INSERT INTO `lump_planned` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '50', 1),
(2, 2, 2, '40', 1),
(3, 2, 33, '20', 1),
(4, 2, 34, '30', 1),
(5, 2, 35, '40', 1),
(6, 7, 1, '9', 5),
(7, 7, 2, '10', 5),
(8, 7, 33, '7', 5),
(9, 7, 34, '12', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lump_sum`
--

CREATE TABLE IF NOT EXISTS `lump_sum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lump_sum`
--

INSERT INTO `lump_sum` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '50', 1),
(2, 2, 2, '20', 1),
(3, 2, 33, '15', 1),
(4, 2, 34, '20', 1),
(5, 2, 35, '30', 1),
(6, 7, 1, '5', 5),
(7, 7, 2, '5', 5),
(8, 7, 33, '7', 5),
(9, 7, 34, '10', 5);

-- --------------------------------------------------------

--
-- Table structure for table `planned`
--

CREATE TABLE IF NOT EXISTS `planned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `planned`
--

INSERT INTO `planned` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '9', 1),
(2, 2, 2, '9', 1),
(3, 2, 3, '3', 1),
(4, 2, 4, '4', 1),
(5, 3, 1, '4', 5),
(6, 3, 2, '5', 5),
(7, 3, 3, '6', 5),
(8, 2, 5, '0', 1),
(9, 2, 6, '8', 1),
(10, 2, 7, '13', 1),
(11, 2, 9, '10', 1),
(12, 2, 10, '15', 1),
(13, 2, 11, '8', 1),
(14, 2, 12, '8', 1),
(15, 2, 13, '8', 1),
(16, 2, 14, '8', 1),
(17, 2, 15, '8', 1),
(18, 2, 16, '8', 1),
(19, 2, 17, '8', 1),
(20, 2, 18, '8', 1),
(21, 2, 19, '8', 1),
(22, 2, 20, '8', 1),
(23, 2, 21, '8', 1),
(24, 2, 22, '8', 1),
(25, 2, 23, '8', 1),
(26, 2, 24, '8', 1),
(27, 2, 25, '8', 1),
(28, 2, 26, '8', 1),
(29, 2, 27, '8', 1),
(30, 2, 28, '8', 1),
(31, 2, 29, '8', 1),
(32, 2, 30, '8', 1),
(33, 2, 31, '8', 1),
(34, 2, 32, '8', 1),
(35, 2, 33, '9', 1),
(36, 2, 34, '10', 1),
(37, 2, 35, '10', 1),
(38, 2, 36, '15', 1),
(39, 2, 37, '8', 1),
(40, 2, 38, '8', 1),
(41, 0, 0, '8', 7),
(42, 0, 0, '8', 2),
(43, 8, 1, '8', 2),
(44, 8, 2, '9', 2),
(45, 8, 33, '9', 2),
(46, 8, 34, '9', 2);

-- --------------------------------------------------------

--
-- Table structure for table `prog_actual`
--

CREATE TABLE IF NOT EXISTS `prog_actual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `prog_actual`
--

INSERT INTO `prog_actual` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '1%', 1),
(2, 2, 2, '5%', 1),
(3, 2, 3, '9%', 1),
(4, 2, 33, '3%', 1),
(5, 2, 34, '3%', 1),
(6, 2, 35, '4%', 1),
(7, 2, 36, '9%', 1),
(8, 2, 37, '13%', 1),
(9, 2, 38, '18%', 1),
(10, 2, 39, '25%', 1),
(11, 9, 1, '5%', 9),
(12, 9, 2, '8%', 9),
(13, 9, 3, '14%', 9),
(14, 9, 4, '20%', 9);

-- --------------------------------------------------------

--
-- Table structure for table `prog_contract`
--

CREATE TABLE IF NOT EXISTS `prog_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prog_contract`
--

INSERT INTO `prog_contract` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '2700000', 1),
(2, 2, 33, '8000', 1),
(3, 9, 1, '500000000', 9);

-- --------------------------------------------------------

--
-- Table structure for table `prog_planned`
--

CREATE TABLE IF NOT EXISTS `prog_planned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `prog_planned`
--

INSERT INTO `prog_planned` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 1, '2%', 1),
(2, 2, 2, '6%', 1),
(3, 2, 3, '10%', 1),
(4, 2, 33, '3%', 1),
(5, 2, 34, '5%', 1),
(6, 2, 35, '8%', 1),
(7, 2, 36, '10%', 1),
(8, 2, 37, '15%', 1),
(9, 2, 38, '20%', 1),
(10, 2, 39, '25%', 1),
(11, 9, 1, '6%', 9),
(12, 9, 2, '10%', 9),
(13, 9, 3, '15%', 9),
(14, 9, 4, '20%', 9);

-- --------------------------------------------------------

--
-- Table structure for table `proj_area`
--

CREATE TABLE IF NOT EXISTS `proj_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `proj_area`
--

INSERT INTO `proj_area` (`id`, `area_name`) VALUES
(1, 'Pasig'),
(2, 'Manila'),
(3, 'Quezon'),
(4, 'Bulacan'),
(5, 'Dasmariñas'),
(6, 'Cavite'),
(7, 'QC'),
(8, 'Caloocan'),
(9, 'Mandaluyong'),
(10, 'Plaridel'),
(11, 'Rizal'),
(12, 'Malolos');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(1, 2, 8, '', 1),
(2, 2, 1, '12.6', 1),
(3, 2, 2, '12.6', 1),
(4, 2, 3, '12.6', 1),
(5, 2, 4, '12.6', 1),
(6, 2, 5, '0', 1),
(7, 2, 7, '9', 1),
(8, 2, 9, '15', 1),
(9, 2, 10, '15', 1),
(10, 2, 6, '8', 1),
(11, 2, 11, '8', 1),
(12, 2, 12, '8', 1),
(13, 2, 13, '8', 1),
(14, 2, 14, '8', 1),
(15, 2, 15, '8', 1),
(16, 2, 16, '8', 1),
(17, 2, 17, '8', 1),
(18, 2, 18, '8', 1),
(19, 2, 19, '8', 1),
(20, 2, 20, '8', 1),
(21, 2, 21, '8', 1),
(22, 2, 22, '8', 1),
(23, 2, 23, '8', 1),
(24, 2, 24, '8', 1),
(25, 2, 25, '8', 1),
(26, 2, 26, '8', 1),
(27, 2, 27, '8', 1),
(28, 2, 28, '8', 1),
(29, 2, 29, '8', 1),
(30, 2, 30, '8', 1),
(31, 2, 31, '8', 1),
(32, 2, 32, '8', 1),
(33, 2, 33, '9', 1),
(34, 2, 34, '10', 1),
(35, 2, 35, '10', 1),
(36, 2, 36, '15', 1),
(37, 2, 37, '9', 1),
(38, 2, 38, '8', 1),
(39, 0, 0, '8', 7),
(40, 0, 0, '8', 2),
(41, 8, 1, '8', 2),
(42, 8, 2, '9', 2),
(43, 8, 33, '12', 2),
(44, 8, 34, '3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reg_project`
--

CREATE TABLE IF NOT EXISTS `reg_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `ca` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `reg_project`
--

INSERT INTO `reg_project` (`id`, `contract`, `description`, `ca`) VALUES
(2, 'FO', 'Field Order 211', '69987'),
(3, 'EVS', 'EVS INI', '58895'),
(4, 'PLDT', 'PLDT', '78595'),
(5, 'FO', 'FO 215', '99682'),
(6, 'EVS', 'EVS', '123'),
(8, 'FO', 'Field Order', '135'),
(9, 'LP', 'Load Profile', '4585'),
(10, 'Test', 'Test', '1221');

-- --------------------------------------------------------

--
-- Table structure for table `t_assigned`
--

CREATE TABLE IF NOT EXISTS `t_assigned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `executed` varchar(50) NOT NULL,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `t_assigned`
--

INSERT INTO `t_assigned` (`id`, `con_id`, `date_id`, `executed`, `area_id`) VALUES
(2, 2, 1, '9', 1),
(3, 2, 2, '5', 1),
(4, 2, 3, '10', 1),
(5, 2, 4, '15', 1),
(6, 2, 8, '', 1),
(7, 2, 5, '0', 1),
(8, 2, 7, '9', 1),
(9, 2, 9, '10', 1),
(10, 2, 10, '15', 1),
(11, 2, 6, '8', 1),
(12, 2, 11, '8', 1),
(13, 2, 12, '8', 1),
(14, 2, 13, '8', 1),
(15, 2, 14, '8', 1),
(16, 2, 15, '8', 1),
(17, 2, 16, '8', 1),
(18, 2, 17, '8', 1),
(19, 2, 18, '8', 1),
(20, 2, 19, '8', 1),
(21, 2, 20, '8', 1),
(22, 2, 21, '8', 1),
(23, 2, 22, '8', 1),
(24, 2, 23, '8', 1),
(25, 2, 24, '8', 1),
(26, 2, 25, '8', 1),
(27, 2, 26, '8', 1),
(28, 2, 27, '8', 1),
(29, 2, 28, '8', 1),
(30, 2, 29, '8', 1),
(31, 2, 30, '8', 1),
(32, 2, 31, '8', 1),
(33, 2, 32, '8', 1),
(34, 2, 33, '9', 1),
(35, 2, 34, '10', 1),
(36, 2, 35, '10', 1),
(37, 2, 36, '15', 1),
(38, 2, 37, '7', 1),
(39, 2, 38, '8', 1),
(40, 0, 0, '8', 7),
(41, 0, 0, '8', 2),
(42, 8, 1, '8', 2),
(43, 8, 2, '8', 2),
(44, 8, 33, '9', 2),
(45, 8, 34, '6', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(100) NOT NULL,
  `u_pass` varchar(100) NOT NULL,
  `designation` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_name`, `u_pass`, `designation`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator'),
(2, 'test', '098f6bcd4621d373cade4e832627b4f6', 'Supervisor'),
(4, 'head', '96e89a298e0a9f469b9ae458d6afae9f', 'BU Head');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
