-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 15 Février 2017 à 09:53
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
(16, 'Un concours', 'zehrbgzeorughybzevncdvb efhzebrogzhebgiazeyrgzeorgzbyeofg', ' zjzbgozehgbzerhzebgzeuigybeighzebgizeybgziehgbzehvgbzviehurvbgzoerygb', '2017-02-15 00:26:11', '2017-02-12 00:26:21', '2017-02-15 00:00:00', 'Un prix', 'public/images/contest/gift.jpg', 1, 0, 0),
(19, 'uuuuuuuuuuuuu', 'azertyuiopqsdfghjklmwxcvbn', ' azertyuiopqsdfghjklmwxcvbnazertyuiopqsdfghjklmwxcvbn', '2017-02-15 01:09:05', '2017-02-15 01:02:00', '2017-03-15 05:03:00', 'iiiiiiiiiiiiiiii', 'public/images/contest/tatoo4.jpg', 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `likes`
--

INSERT INTO `likes` (`like_id`, `photo_id`, `user_id`) VALUES
(4, 13, 24),
(5, 14, 24),
(6, 14, 25);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `participant_id` int(11) NOT NULL,
  `participant_name` varchar(45) NOT NULL,
  `participant_surname` varchar(45) NOT NULL,
  `participant_email` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `participant`
--

INSERT INTO `participant` (`participant_id`, `participant_name`, `participant_surname`, `participant_email`) VALUES
(25, 'McFly', 'Vag', 'mcflygeorge55@gmail.com'),
(24, 'Padenom', 'Guigui', 'screy@icloud.com');

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
(13, 25, 16, 'https://scontent.xx.fbcdn.net/v/t1.0-0/p130x130/16142870_109889866190470_8983031518020398231_n.jpg?oh=457458d881593340bb813d35629c4813&oe=594B2C8C', 1);

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
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

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
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `facebook_photos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
