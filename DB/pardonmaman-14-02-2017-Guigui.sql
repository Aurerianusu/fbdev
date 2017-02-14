-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 14 Février 2017 à 16:37
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pardonmaman`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_surname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_name`, `admin_surname`) VALUES
(1, 'screy@icloud.com', 'Padenom', 'Guigui');

-- --------------------------------------------------------

--
-- Structure de la table `contest`
--

CREATE TABLE `contest` (
  `contest_id` int(11) NOT NULL,
  `contest_name` varchar(45) NOT NULL,
  `contest_rules` text NOT NULL,
  `contest_home` text NOT NULL,
  `contest_creation_date` datetime NOT NULL,
  `contest_begin_date` datetime NOT NULL,
  `contest_end_date` datetime NOT NULL,
  `contest_prize` varchar(45) NOT NULL,
  `contest_image` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `winner_participant_id` int(11) NOT NULL,
  `winner_image_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contest`
--

INSERT INTO `contest` (`contest_id`, `contest_name`, `contest_rules`, `contest_home`, `contest_creation_date`, `contest_begin_date`, `contest_end_date`, `contest_prize`, `contest_image`, `is_active`, `winner_participant_id`, `winner_image_id`) VALUES
(16, 'Un concours', 'zehrbgzeorughybzevncdvb efhzebrogzhebgiazeyrgzeorgzbyeofg', ' zjzbgozehgbzerhzebgzeuigybeighzebgizeybgziehgbzehvgbzviehurvbgzoerygb', '2017-02-14 01:05:11', '2017-02-14 01:02:00', '2017-11-28 22:11:00', 'Un prix', 'public/images/contest/eyJ1cmwiOiJodHRwczovL2kueXRpbWcuY29tL3ZpL1hXZFBQNGZITjlzL21heHJlc2RlZmF1bHQuanBnIn0.jpg', 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `participant_id` int(11) NOT NULL,
  `participant_name` varchar(45) NOT NULL,
  `participant_surname` varchar(45) NOT NULL,
  `participant_email` varchar(45) NOT NULL,
  `birthdate_participant` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `participant`
--

INSERT INTO `participant` (`participant_id`, `participant_name`, `participant_surname`, `participant_email`, `birthdate_participant`) VALUES
(21, 'Padenom', 'Guigui', 'screy@icloud.com', '0000-00-00 00:00:00'),
(22, 'McFly', 'Vag', 'mcflygeorge55@gmail.com', '1985-04-01 12:04:00');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `facebook_photos_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `photo`
--

INSERT INTO `photo` (`facebook_photos_id`, `participant_id`, `contest_id`, `link`, `likes`) VALUES
(2, 21, 16, 'https://scontent.xx.fbcdn.net/v/t1.0-0/p130x130/15825835_10211764134448327_5776804063763847092_n.jpg?oh=7d27027cc8f0f6dcb5e66b148123b068&oe=59079D32', 0),
(5, 22, 16, 'https://scontent.xx.fbcdn.net/v/t1.0-0/p130x130/16142870_109889866190470_8983031518020398231_n.jpg?oh=457458d881593340bb813d35629c4813&oe=594B2C8C', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`contest_id`);

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`participant_id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`facebook_photos_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `contest`
--
ALTER TABLE `contest`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `facebook_photos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
