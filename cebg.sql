-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 nov. 2024 à 11:11
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

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

CREATE TABLE `calendrier` (
  `idcoursbase` int(11) NOT NULL,
  `idcoursassociee` int(11) NOT NULL,
  `datecours` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `calendrier`
--

INSERT INTO `calendrier` (`idcoursbase`, `idcoursassociee`, `datecours`) VALUES
(1, 1, '2024-11-30');

-- --------------------------------------------------------

--
-- Structure de la table `cavalerie`
--

CREATE TABLE `cavalerie` (
  `numsire` int(11) NOT NULL,
  `nomcheval` varchar(20) NOT NULL,
  `datenaissancecheval` date NOT NULL,
  `garot` int(11) NOT NULL,
  `idrobe` int(11) NOT NULL,
  `idrace` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cavalerie`
--

INSERT INTO `cavalerie` (`numsire`, `nomcheval`, `datenaissancecheval`, `garot`, `idrobe`, `idrace`) VALUES
(1, 'zeb', '2024-11-01', 1, 1, 2),
(2, 'zebIWESH', '2024-11-01', 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cavalier`
--

CREATE TABLE `cavalier` (
  `idcavalier` int(11) NOT NULL,
  `nomcavalier` varchar(20) NOT NULL,
  `prenomcavalier` varchar(20) NOT NULL,
  `datenaissancecavalier` date NOT NULL,
  `nomresponsable` varchar(20) NOT NULL,
  `rueresponsable` varchar(20) NOT NULL,
  `telresponsable` int(11) NOT NULL,
  `emailresponsable` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `numlicence` int(11) NOT NULL,
  `numassurance` int(11) NOT NULL,
  `idcommune` int(11) NOT NULL,
  `idgalop` int(11) NOT NULL,
  `afficher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cavalier`
--

INSERT INTO `cavalier` (`idcavalier`, `nomcavalier`, `prenomcavalier`, `datenaissancecavalier`, `nomresponsable`, `rueresponsable`, `telresponsable`, `emailresponsable`, `password`, `numlicence`, `numassurance`, `idcommune`, `idgalop`, `afficher`) VALUES
(2, 'a', 'a', '2024-10-09', 'a', 'a', 42454, 'e@gmail.com', '87546', 456456, 45645645, 1, 1, 0),
(4, 'a', 'a', '2024-10-09', 'a', 'a', 42454, 'e@gmail.com', 'wscwdfd', 456456, 45645645, 2, 1, 0),
(6, 'piera', 'nox', '2024-10-29', 'piera', 'dxdf4', 892951836, 'matteo@gmail.com', '', 0, 266, 1, 1, 0),
(8, 'TESTJOURMEME', 'MEME', '2024-11-05', 'MOI', 'MARUE', 58651234, 'matteo@gmail.com', 'jpassedu45au635', 0, 1, 1, 1, 0),
(9, 'hghg gg', 't', '2024-11-08', 'hfgfjhg', 'hgfg', 774858, 'ntm@gmail.com', '', 78676, 786786786, 2, 1, 1),
(13, 'fgsdfgfdshd', 'gfdgsdgfdsgdf', '2024-10-30', 'fdgsd', 'sdfg', 55, 'ntm@gmail.com', '', 0, 0, 2, 1, 1),
(15, 'hghg gg', 't', '2024-11-07', 'hfgfjhg', 'hgfg', 774858, 'ntm@gmail.com', '$2y$10$uxsRgyFCSSG4mTc56bVGUOY1A0m9v4rPckDh.qDZiHjg6KC.nJzjC', 78676, 1101, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE `commune` (
  `idcommune` int(11) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `codepostal` int(11) NOT NULL,
  `afficher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`idcommune`, `ville`, `codepostal`, `afficher`) VALUES
(1, 'Paris', 75000, 0),
(2, 'Brive', 19100, 0);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `idcompte` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`idcompte`, `email`, `pseudo`, `mdp`) VALUES
(12, 'arthur.bramas@gmail.com', 'a', '$2y$10$IpO14cLCmGjFzPL6qkXQTumfeqcCWir0X2akxvRGktmdVEUHFWH/G');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `idcours` int(11) NOT NULL,
  `libcours` varchar(20) NOT NULL,
  `horairedebut` time NOT NULL,
  `horairefin` time NOT NULL,
  `jour` varchar(20) NOT NULL,
  `afficher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(14, 'COURS', '15:00:00', '16:00:00', 'TAMERE', 1),
(15, 'apagnan', '11:59:00', '11:57:00', 'ni', 0),
(16, '5', '04:45:00', '04:45:00', '5', 0),
(17, '45', '04:05:00', '04:05:00', '45', 0),
(18, '45', '05:46:00', '04:56:00', '456456456', 0),
(19, '45', '01:40:00', '22:00:00', 'JEUDI', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `idevenement` int(11) NOT NULL,
  `titreevenement` varchar(20) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idevenement`, `titreevenement`, `commentaire`) VALUES
(1, 'EVENEMENG', 'CEST UN EVENEMENT ');

-- --------------------------------------------------------

--
-- Structure de la table `galop`
--

CREATE TABLE `galop` (
  `idgalop` int(11) NOT NULL,
  `libgalop` varchar(20) NOT NULL,
  `afficher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `galop`
--

INSERT INTO `galop` (`idgalop`, `libgalop`, `afficher`) VALUES
(1, 'Galop 0', 1),
(2, 'Galop 1', 1),
(3, 'Galop 2', 1),
(4, 'Galop 3', 1),
(5, 'Galop 4', 1),
(6, 'Galop 5', 1),
(7, 'Galop 6', 1),
(8, 'Galop 7', 1);

-- --------------------------------------------------------

--
-- Structure de la table `inserer`
--

CREATE TABLE `inserer` (
  `idcours` int(11) NOT NULL,
  `idcavalier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inserer`
--

INSERT INTO `inserer` (`idcours`, `idcavalier`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `idcoursbase` int(11) NOT NULL,
  `idcoursassociee` int(11) NOT NULL,
  `idcavalier` int(11) NOT NULL,
  `present` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`idcoursbase`, `idcoursassociee`, `idcavalier`, `present`) VALUES
(1, 1111, 1, 0),
(5, 5, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

CREATE TABLE `pension` (
  `idpension` int(11) NOT NULL,
  `libpension` varchar(20) NOT NULL,
  `tarifpension` float NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `numsire` int(11) NOT NULL,
  `afficher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pension`
--

INSERT INTO `pension` (`idpension`, `libpension`, `tarifpension`, `datedebut`, `datefin`, `numsire`, `afficher`) VALUES
(3, 'niquer ta mère', 5, '2024-11-29', '2024-11-30', 1, 0),
(4, 'niquer ta mère', 5, '2024-11-29', '2024-11-30', 1, 0),
(5, 'niquer ta mère', 5, '2024-11-29', '2024-11-30', 1, 0),
(6, 'niquer ta mère', 5, '2024-11-29', '2024-11-30', 1, 0),
(7, 'niquer ta mère', 5, '2024-11-29', '2024-11-30', 1, 0),
(8, 'niquer ta mère', 5, '2024-11-29', '2024-11-30', 1, 0),
(9, 'niquer ta mère', 5, '2024-11-29', '2024-11-30', 1, 0),
(10, 'niquer ta GRAND MERE', 566, '2024-11-29', '2024-11-30', 2, 1),
(11, 'niquer ta mère', 1, '2024-11-01', '2024-11-16', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `idphoto` int(11) NOT NULL,
  `lien` text NOT NULL,
  `numsire` int(11) NOT NULL,
  `idevenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prend`
--

CREATE TABLE `prend` (
  `idcavalier` int(11) NOT NULL,
  `idpension` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prend`
--

INSERT INTO `prend` (`idcavalier`, `idpension`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `idrace` int(11) NOT NULL,
  `librace` varchar(20) NOT NULL,
  `afficher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`idrace`, `librace`, `afficher`) VALUES
(1, 'BEAU CHEVAL', 0),
(2, 'AH', 1),
(3, 'TESTSUPP', 0),
(4, 'CRF-YORSSI', 0),
(5, 'AH2', 0),
(6, 'RACE1', 1),
(7, 'ta grosse race', 1);

-- --------------------------------------------------------

--
-- Structure de la table `robe`
--

CREATE TABLE `robe` (
  `idrobe` int(11) NOT NULL,
  `librobe` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `robe`
--

INSERT INTO `robe` (`idrobe`, `librobe`) VALUES
(1, 'rouge');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`idcoursbase`,`idcoursassociee`);

--
-- Index pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  ADD PRIMARY KEY (`numsire`),
  ADD KEY `fk_race` (`idrace`),
  ADD KEY `fk_robe` (`idrobe`);

--
-- Index pour la table `cavalier`
--
ALTER TABLE `cavalier`
  ADD PRIMARY KEY (`idcavalier`),
  ADD KEY `fk_commune` (`idcommune`),
  ADD KEY `fk_galop` (`idgalop`);

--
-- Index pour la table `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`idcommune`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idcompte`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`idcours`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`idevenement`);

--
-- Index pour la table `galop`
--
ALTER TABLE `galop`
  ADD PRIMARY KEY (`idgalop`);

--
-- Index pour la table `inserer`
--
ALTER TABLE `inserer`
  ADD PRIMARY KEY (`idcours`,`idcavalier`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`idcoursbase`,`idcoursassociee`,`idcavalier`);

--
-- Index pour la table `pension`
--
ALTER TABLE `pension`
  ADD PRIMARY KEY (`idpension`),
  ADD KEY `fk_numsire` (`numsire`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`idphoto`);

--
-- Index pour la table `prend`
--
ALTER TABLE `prend`
  ADD PRIMARY KEY (`idcavalier`,`idpension`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`idrace`);

--
-- Index pour la table `robe`
--
ALTER TABLE `robe`
  ADD PRIMARY KEY (`idrobe`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  MODIFY `numsire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `cavalier`
--
ALTER TABLE `cavalier`
  MODIFY `idcavalier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commune`
--
ALTER TABLE `commune`
  MODIFY `idcommune` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `idcompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idcours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `idevenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `galop`
--
ALTER TABLE `galop`
  MODIFY `idgalop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pension`
--
ALTER TABLE `pension`
  MODIFY `idpension` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `idrace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `robe`
--
ALTER TABLE `robe`
  MODIFY `idrobe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  ADD CONSTRAINT `fk_race` FOREIGN KEY (`idrace`) REFERENCES `race` (`idrace`),
  ADD CONSTRAINT `fk_robe` FOREIGN KEY (`idrobe`) REFERENCES `robe` (`idrobe`);

--
-- Contraintes pour la table `cavalier`
--
ALTER TABLE `cavalier`
  ADD CONSTRAINT `fk_commune` FOREIGN KEY (`idcommune`) REFERENCES `commune` (`idcommune`),
  ADD CONSTRAINT `fk_galop` FOREIGN KEY (`idgalop`) REFERENCES `galop` (`idgalop`);

--
-- Contraintes pour la table `pension`
--
ALTER TABLE `pension`
  ADD CONSTRAINT `fk_numsire` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
