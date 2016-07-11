-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 10 Juillet 2016 à 17:51
-- Version du serveur: 5.1.73
-- Version de PHP: 5.5.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `chacc`
--

-- --------------------------------------------------------

--
-- Structure de la table `Sujets`
--

CREATE TABLE IF NOT EXISTS `Sujets` (
  `idSujet` int(255) NOT NULL,
  `nomSujet` varchar(255) NOT NULL,
  PRIMARY KEY (`idSujet`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Sujets`
--

INSERT INTO `Sujets` (`idSujet`, `nomSujet`) VALUES
(1, 'La domination masculine'),
(2, 'L''énergie nucléaire'),
(3, ' Le bien-être au travail'),
(4, 'Argent = bonheur'),
(7, 'L''Intelligence Artificielle'),
(12, 'Les jeux vidéos, vecteurs de violence'),
(8, 'La peine de mort'),
(9, 'La légalisation du cannabis'),
(10, 'Le clonage'),
(11, 'Le droit de vote obligatoire');
