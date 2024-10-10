-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 oct. 2024 à 06:13
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cebg`
--

-- --------------------------------------------------------

--
-- Structure de la table `cavalerie`
--

DROP TABLE IF EXISTS `cavalerie`;
CREATE TABLE IF NOT EXISTS `cavalerie` (
  `numSire` int NOT NULL,
  `nomCheval` varchar(20) DEFAULT NULL,
  `dateNaissanceCheval` date DEFAULT NULL,
  `garot` float DEFAULT NULL,
  `idRobe` int DEFAULT NULL,
  `idRace` int DEFAULT NULL,
  `idPension` int DEFAULT NULL,
  PRIMARY KEY (`numSire`),
  KEY `idRobe` (`idRobe`),
  KEY `idRace` (`idRace`),
  KEY `idPension` (`idPension`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cavalier`
--

DROP TABLE IF EXISTS `cavalier`;
CREATE TABLE IF NOT EXISTS `cavalier` (
  `idCavalier` int NOT NULL AUTO_INCREMENT,
  `nomResponsable` varchar(20) DEFAULT NULL,
  `prenomResponsable` varchar(20) DEFAULT NULL,
  `rueResponsable` varchar(20) DEFAULT NULL,
  `villeResponsible` varchar(20) DEFAULT NULL,
  `codePostalResponsable` int DEFAULT NULL,
  `telResponsable` int DEFAULT NULL,
  `emailResponsable` varchar(20) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `numLicence` int DEFAULT NULL,
  PRIMARY KEY (`idCavalier`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `idCours` int NOT NULL AUTO_INCREMENT,
  `libCours` varchar(20) DEFAULT NULL,
  `horaireDebut` timestamp NULL DEFAULT NULL,
  `horaireFin` timestamp NULL DEFAULT NULL,
  `jour` date DEFAULT NULL,
  PRIMARY KEY (`idCours`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvenement` int NOT NULL AUTO_INCREMENT,
  `titreEvenement` varchar(20) DEFAULT NULL,
  `commentaire` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idEvenement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `galop`
--

DROP TABLE IF EXISTS `galop`;
CREATE TABLE IF NOT EXISTS `galop` (
  `idGalop` int NOT NULL AUTO_INCREMENT,
  `libGalop` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idGalop`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

DROP TABLE IF EXISTS `pension`;
CREATE TABLE IF NOT EXISTS `pension` (
  `idPension` int NOT NULL AUTO_INCREMENT,
  `libPension` varchar(20) DEFAULT NULL,
  `tarifPension` float DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  PRIMARY KEY (`idPension`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `idPhoto` int NOT NULL AUTO_INCREMENT,
  `lien` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idPhoto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prend`
--

DROP TABLE IF EXISTS `prend`;
CREATE TABLE IF NOT EXISTS `prend` (
  `idCavalier` int NOT NULL,
  `idPension` int NOT NULL,
  PRIMARY KEY (`idCavalier`,`idPension`),
  KEY `idPension` (`idPension`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

DROP TABLE IF EXISTS `race`;
CREATE TABLE IF NOT EXISTS `race` (
  `idRace` int NOT NULL AUTO_INCREMENT,
  `libRace` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idRace`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `robe`
--

DROP TABLE IF EXISTS `robe`;
CREATE TABLE IF NOT EXISTS `robe` (
  `idRobe` int NOT NULL AUTO_INCREMENT,
  `libRobe` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idRobe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
