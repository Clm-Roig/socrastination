-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 10 Juillet 2016 à 17:50
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
CREATE DATABASE `chacc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chacc`;

-- --------------------------------------------------------

--
-- Structure de la table `Chat_messages`
--

CREATE TABLE IF NOT EXISTS `Chat_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id_membre` int(11) NOT NULL,
  `message_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_text` varchar(255) NOT NULL,
  `id_partie` int(11) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1762 ;

-- --------------------------------------------------------

--
-- Structure de la table `Forums`
--

CREATE TABLE IF NOT EXISTS `Forums` (
  `idForum` int(11) NOT NULL,
  `idPartie` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idForum`),
  UNIQUE KEY `idForum` (`idForum`),
  KEY `FK_PARTIE_FORUM` (`idPartie`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Structure de la table `Membres`
--

CREATE TABLE IF NOT EXISTS `Membres` (
  `idMembre` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) DEFAULT NULL,
  `motDePasse` varchar(255) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `points` int(7) DEFAULT NULL,
  `nbPartiesGagnees` int(4) DEFAULT NULL,
  `nbTotalParties` int(5) DEFAULT NULL,
  PRIMARY KEY (`idMembre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

-- --------------------------------------------------------

--
-- Structure de la table `Parties`
--

CREATE TABLE IF NOT EXISTS `Parties` (
  `idPartie` int(11) NOT NULL,
  `idSujet` int(11) DEFAULT NULL,
  `tour_joueur` int(11) NOT NULL DEFAULT '0',
  `time_fin_partie` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idPartie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Role`
--

CREATE TABLE IF NOT EXISTS `Role` (
  `role` tinyint(1) DEFAULT NULL,
  `idPartie` int(11) NOT NULL DEFAULT '0',
  `idMembre` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPartie`,`idMembre`),
  KEY `FK_MEMBRE` (`idMembre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Sujets`
--

CREATE TABLE IF NOT EXISTS `Sujets` (
  `idSujet` int(255) NOT NULL,
  `nomSujet` varchar(255) NOT NULL,
  PRIMARY KEY (`idSujet`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Votes`
--

CREATE TABLE IF NOT EXISTS `Votes` (
  `idArbitre` int(11) NOT NULL DEFAULT '0',
  `idMessage` int(11) NOT NULL DEFAULT '0',
  `vote` int(11) DEFAULT NULL,
  PRIMARY KEY (`idArbitre`,`idMessage`),
  KEY `FK_MESSAGE` (`idMessage`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `informaticiens`
--

CREATE TABLE IF NOT EXISTS `informaticiens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(8) DEFAULT NULL,
  `nom` varchar(16) DEFAULT NULL,
  `naissance` int(11) DEFAULT NULL,
  `mort` int(11) DEFAULT NULL,
  `pays` enum('Pays-Bas','Etats-Unis','Finlande','Angleterre') DEFAULT NULL,
  `contribution` varchar(255) DEFAULT NULL,
  `distinctions` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;
