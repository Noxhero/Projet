-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 07 nov. 2024 à 08:06
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
-- Structure de la table `calendrier`
--

DROP TABLE IF EXISTS `calendrier`;
CREATE TABLE IF NOT EXISTS `calendrier` (
  `idcoursbase` int NOT NULL,
  `idcoursassociee` int NOT NULL,
  `datecours` date NOT NULL,
  PRIMARY KEY (`idcoursbase`,`idcoursassociee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cavalerie`
--

DROP TABLE IF EXISTS `cavalerie`;
CREATE TABLE IF NOT EXISTS `cavalerie` (
  `numsire` int NOT NULL AUTO_INCREMENT,
  `nomcheval` varchar(20) NOT NULL,
  `datenaissancecheval` date NOT NULL,
  `garot` int NOT NULL,
  `idrobe` int NOT NULL,
  `idrace` int NOT NULL,
  PRIMARY KEY (`numsire`),
  KEY `fk_race` (`idrace`),
  KEY `fk_robe` (`idrobe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cavalier`
--

DROP TABLE IF EXISTS `cavalier`;
CREATE TABLE IF NOT EXISTS `cavalier` (
  `idcavalier` int NOT NULL AUTO_INCREMENT,
  `nomcavalier` varchar(20) NOT NULL,
  `prenomcavalier` varchar(20) NOT NULL,
  `datenaissancecavalier` date NOT NULL,
  `nomresponsable` varchar(20) NOT NULL,
  `rueresponsable` varchar(20) NOT NULL,
  `telresponsable` int NOT NULL,
  `emailresponsable` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `numlicence` int NOT NULL,
  `numassurance` int NOT NULL,
  `idcommune` int NOT NULL,
  `idgalop` int NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcavalier`),
  KEY `fk_commune` (`idcommune`),
  KEY `fk_galop` (`idgalop`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cavalier`
--

INSERT INTO `cavalier` (`idcavalier`, `nomcavalier`, `prenomcavalier`, `datenaissancecavalier`, `nomresponsable`, `rueresponsable`, `telresponsable`, `emailresponsable`, `password`, `numlicence`, `numassurance`, `idcommune`, `idgalop`, `afficher`) VALUES
(2, 'a', 'a', '2024-10-09', 'a', 'a', 42454, 'e@gmail.com', '87546', 456456, 45645645, 1, 1, 0),
(4, 'a', 'a', '2024-10-09', 'a', 'a', 42454, 'e@gmail.com', 'wscwdfd', 456456, 45645645, 2, 1, 1),
(6, 'piera', 'nox', '2024-10-29', 'piera', 'dxdf4', 892951836, 'matteo@gmail.com', '', 0, 266, 1, 1, 1),
(8, 'TESTJOURMEME', 'MEME', '2024-11-05', 'MOI', 'MARUE', 58651234, 'matteo@gmail.com', 'jpassedu45au635', 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

DROP TABLE IF EXISTS `commune`;
CREATE TABLE IF NOT EXISTS `commune` (
  `idcommune` int NOT NULL AUTO_INCREMENT,
  `ville` varchar(20) NOT NULL,
  `codepostal` int NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcommune`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`idcommune`, `ville`, `codepostal`, `afficher`) VALUES
(1, 'Paris', 0, 0),
(2, 'Brive', 19100, 0),
(3, 'Brive', 19100, 1);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `idcompte` int NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idcompte`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`idcompte`, `email`, `pseudo`, `mdp`) VALUES
(1, 'arthur@gmail.com', 'arthur', '$2y$10$4YNqjgdbbsXxB5ldmxboEuCHJsfbQGUom/Z2.l8L/6NO.SEOkZUkC'),
(2, 'arthur@gmail.com', 'arthur', '$2y$10$mncCIaf8CyjjCTZ7Aam5j.Bxurmcqi8CL129ss0MdYEWqqErjbYOC'),
(3, 'arthur@gmail.com', 'arthur', '$2y$10$Fe00Yx74w/yvW9vEIqE.WuLTLHmiJeCEMA86aLX7XXlWDAQ4f1O0O'),
(4, 'noxerocum1@gmail.com', 'nox', '$2y$10$sqI1W89C8cZ3mc3EEtInzOmteu7ZYkurMe.EgpZyONBVN5eol8wVa');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `idcours` int NOT NULL AUTO_INCREMENT,
  `libcours` varchar(20) NOT NULL,
  `horairedebut` time NOT NULL,
  `horairefin` time NOT NULL,
  `jour` varchar(20) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcours`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idcours`, `libcours`, `horairedebut`, `horairefin`, `jour`, `afficher`) VALUES
(3, 'Piera', '16:32:00', '19:35:00', 'Jeudi', 0),
(4, 'MACHIN', '16:35:00', '18:38:00', 'Lundi', 0),
(5, 'YAAAAA', '18:45:00', '18:45:00', 'Lundi', 0),
(6, 'arthur', '22:44:00', '20:44:00', 'Jeudi', 0),
(7, 'PIERROT', '20:33:00', '23:36:00', 'JEUDI', 0),
(8, 'PIERROT', '20:33:00', '23:36:00', 'JEUDI', 0),
(9, '', '00:00:00', '00:00:00', '', 0),
(10, 'MACHIN', '14:00:00', '23:00:00', 'JEUDI', 0),
(11, 'Piera', '11:23:00', '13:25:00', 'JSP', 0),
(12, 'arthur', '23:00:00', '05:59:00', 'YES', 0),
(13, 'TEST', '14:00:00', '17:00:00', 'Jeudi', 0),
(14, 'COURS', '15:00:00', '16:00:00', 'Jeudi', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idevenement` int NOT NULL AUTO_INCREMENT,
  `titreevenement` varchar(20) NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`idevenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `galop`
--

DROP TABLE IF EXISTS `galop`;
CREATE TABLE IF NOT EXISTS `galop` (
  `idgalop` int NOT NULL AUTO_INCREMENT,
  `libgalop` varchar(20) NOT NULL,
  PRIMARY KEY (`idgalop`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `galop`
--

INSERT INTO `galop` (`idgalop`, `libgalop`) VALUES
(1, 'Galop 0');

-- --------------------------------------------------------

--
-- Structure de la table `inserer`
--

DROP TABLE IF EXISTS `inserer`;
CREATE TABLE IF NOT EXISTS `inserer` (
  `idcours` int NOT NULL,
  `idcavalier` int NOT NULL,
  PRIMARY KEY (`idcours`,`idcavalier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `idcoursbase` int NOT NULL,
  `idcoursassociee` int NOT NULL,
  `idcavalier` int NOT NULL,
  `present` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcoursbase`,`idcoursassociee`,`idcavalier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

DROP TABLE IF EXISTS `pension`;
CREATE TABLE IF NOT EXISTS `pension` (
  `idpension` int NOT NULL AUTO_INCREMENT,
  `libpension` varchar(20) NOT NULL,
  `tarifpension` float NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `numsire` int NOT NULL,
  PRIMARY KEY (`idpension`),
  KEY `fk_numsire` (`numsire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idphoto` int NOT NULL AUTO_INCREMENT,
  `lien` text NOT NULL,
  `numsire` int NOT NULL,
  `idevenement` int NOT NULL,
  PRIMARY KEY (`idphoto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prend`
--

DROP TABLE IF EXISTS `prend`;
CREATE TABLE IF NOT EXISTS `prend` (
  `idcavalier` int NOT NULL,
  `idpension` int NOT NULL,
  PRIMARY KEY (`idcavalier`,`idpension`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

DROP TABLE IF EXISTS `race`;
CREATE TABLE IF NOT EXISTS `race` (
  `idrace` int NOT NULL AUTO_INCREMENT,
  `librace` varchar(20) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idrace`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`idrace`, `librace`, `afficher`) VALUES
(1, 'BEAU CHEVAL', 0),
(2, 'AH', 1),
(3, 'TESTSUPP', 0),
(4, 'CRF-YORSSI', 0),
(5, 'AH2', 0),
(6, 'RACE1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `robe`
--

DROP TABLE IF EXISTS `robe`;
CREATE TABLE IF NOT EXISTS `robe` (
  `idrobe` int NOT NULL AUTO_INCREMENT,
  `librobe` int NOT NULL,
  PRIMARY KEY (`idrobe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  ADD CONSTRAINT `fk_race` FOREIGN KEY (`idrace`) REFERENCES `race` (`idrace`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_robe` FOREIGN KEY (`idrobe`) REFERENCES `robe` (`idrobe`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `cavalier`
--
ALTER TABLE `cavalier`
  ADD CONSTRAINT `fk_commune` FOREIGN KEY (`idcommune`) REFERENCES `commune` (`idcommune`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_galop` FOREIGN KEY (`idgalop`) REFERENCES `galop` (`idgalop`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `pension`
--
ALTER TABLE `pension`
  ADD CONSTRAINT `fk_numsire` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
