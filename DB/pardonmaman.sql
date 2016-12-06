-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2016 at 12:00 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pardonmaman`
--
CREATE DATABASE IF NOT EXISTS `pardonmaman` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pardonmaman`;

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

DROP TABLE IF EXISTS `contest`;
CREATE TABLE `contest` (
  `contest_id` int(11) NOT NULL,
  `contest_name` varchar(45) NOT NULL,
  `contest_creation_date` datetime NOT NULL,
  `contest_begin_date` datetime NOT NULL,
  `contest_end_date` datetime NOT NULL,
  `contest_prize` varchar(45) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `winner_participant_id` int(11) NOT NULL,
  `winner_image_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `contest`:
--   `winner_image_id`
--       `photo` -> `facebook_photos_id`
--   `winner_participant_id`
--       `participant` -> `participant_id`
--

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`contest_id`, `contest_name`, `contest_creation_date`, `contest_begin_date`, `contest_end_date`, `contest_prize`, `is_active`, `winner_participant_id`, `winner_image_id`) VALUES
(1, 'Test contest', '2016-12-01 00:00:00', '2016-12-02 00:00:00', '2016-12-05 00:00:00', 'Trip to Venise', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE `participant` (
  `participant_id` int(11) NOT NULL,
  `participant_name` varchar(45) NOT NULL,
  `participant_surname` varchar(45) NOT NULL,
  `participant_email` varchar(45) NOT NULL,
  `birthdate_participant` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `participant`:
--

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`participant_id`, `participant_name`, `participant_surname`, `participant_email`, `birthdate_participant`) VALUES
(1, 'LENFANT', 'Valentin', 'valentin.lenfant@hotmail.com', '1995-09-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `facebook_photos_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `photo`:
--   `contest_id`
--       `contest` -> `contest_id`
--   `participant_id`
--       `participant` -> `participant_id`
--

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`facebook_photos_id`, `participant_id`, `contest_id`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`contest_id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`participant_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`facebook_photos_id`,`participant_id`,`contest_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
