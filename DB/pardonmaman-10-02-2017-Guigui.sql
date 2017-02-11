-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 11 Février 2017 à 19:32
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

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
(1, 'Test contest', '', '', '2016-12-01 00:00:00', '2016-12-02 00:00:00', '2016-12-05 00:00:00', 'Trip to Venise', '', 0, 1, 1),
(14, 'Une concour', 'des règles\r\n- jrezeoirgze\r\n-azjfhzerglozeg\r\n-zehrgbzekgzebhrgkz\r\n-zergjzoer guizergzeguezog', ' Petite présentation', '2017-02-11 18:08:40', '2017-02-11 18:08:40', '2017-12-20 11:11:00', 'Le prix du concours !', 'public/images/contest/eyJ1cmwiOiJodHRwczovL2kueXRpbWcuY29tL3ZpL1hXZFBQNGZITjlzL21heHJlc2RlZmF1bHQuanBnIn0.jpg', 1, 0, 0);

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
(37, 'McFly', 'Vag', 'mcflygeorge55@gmail.com', '1985-04-01 12:04:00');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `facebook_photos_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `photo`
--

INSERT INTO `photo` (`facebook_photos_id`, `participant_id`, `contest_id`, `link`) VALUES
(1, 1, 1, '');

--
-- Index pour les tables exportées
--

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
  ADD PRIMARY KEY (`facebook_photos_id`,`participant_id`,`contest_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contest`
--
ALTER TABLE `contest`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
