SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `calendrier` (
  `idcoursbase` int NOT NULL,
  `idcoursassociee` int NOT NULL,
  `datecours` date NOT NULL,
  PRIMARY KEY (`idcoursbase`,`idcoursassociee`)
) ENGINE=InnoDB ;


CREATE TABLE IF NOT EXISTS `cavalerie` (
  `numsire` int NOT NULL AUTO_INCREMENT,
  `nomcheval` varchar(20) NOT NULL,
  `datenaissancecheval` date NOT NULL,
  `garot` int NOT NULL,
  `idrobe` int NOT NULL,
  `idrace` int NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`numsire`),
  KEY `fk_race` (`idrace`),
  KEY `fk_robe` (`idrobe`)
) ENGINE=InnoDB AUTO_INCREMENT=10 ;


INSERT INTO `cavalerie` (`numsire`, `nomcheval`, `datenaissancecheval`, `garot`, `idrobe`, `idrace`, `afficher`) VALUES
(1, 'EPICIER', '2024-11-15', 1, 5, 6, 0),
(2, 'EPICE', '2024-11-14', 1, 5, 6, 0),
(4, 'EPICE', '2024-11-22', 178, 5, 2, 0),
(5, 'ZEUB DE CHEVACHE', '2024-11-27', 200000000, 5, 6, 1),
(6, 'RAPHAEL', '2024-11-27', 200300, 5, 6, 1),
(7, 'PDO2', '2024-11-07', 35645, 5, 6, 1),
(8, 'STEAK POIVRE', '2024-11-28', 500, 5, 2, 1),
(9, 'TESTIMAGE', '2024-11-22', 120, 5, 6, 1);


CREATE TABLE IF NOT EXISTS `cavalier` (
  `idcavalier` int NOT NULL AUTO_INCREMENT,
  `nomcavalier` varchar(20) NOT NULL,
  `prenomcavalier` varchar(20) NOT NULL,
  `datenaissancecavalier` date NOT NULL,
  `nomresponsable` varchar(20) NOT NULL,
  `rueresponsable` varchar(20) NOT NULL,
  `telresponsable` int NOT NULL,
  `emailresponsable` varchar(20) NOT NULL,
  `password` text CHARACTER SET utf8mb4  NOT NULL,
  `numlicence` int NOT NULL,
  `numassurance` int NOT NULL,
  `idcommune` int NOT NULL,
  `idgalop` int NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  `iduser` int NOT NULL,
  PRIMARY KEY (`idcavalier`),
  KEY `fk_commune` (`idcommune`),
  KEY `fk_galop` (`idgalop`)
) ENGINE=InnoDB AUTO_INCREMENT=20 ;


INSERT INTO `cavalier` (`idcavalier`, `nomcavalier`, `prenomcavalier`, `datenaissancecavalier`, `nomresponsable`, `rueresponsable`, `telresponsable`, `emailresponsable`, `password`, `numlicence`, `numassurance`, `idcommune`, `idgalop`, `afficher`, `iduser`) VALUES
(2, 'a', 'a', '2024-10-09', 'a', 'a', 42454, 'e@gmail.com', '87546', 456456, 45645645, 1, 1, 0, 4),
(4, 'a', 'a', '2024-10-09', 'a', 'a', 42454, 'e@gmail.com', 'wscwdfd', 456456, 45645645, 2, 1, 0, 4),
(6, 'piera', 'nox', '2024-10-29', 'piera', 'dxdf4', 892951836, 'matteo@gmail.com', '', 0, 266, 1, 1, 0, 4),
(8, 'TESTJOURMEME', 'MEME', '2024-11-05', 'MOI', 'MARUE', 58651234, 'matteo@gmail.com', 'jpassedu45au635', 0, 1, 1, 1, 0, 4),
(11, 'Arthur mais le pas b', 'LA MEME CHOSE', '1985-11-12', 'MATTEO LE GOAT', '11 rue jean mich mic', 585865966, 'matteo@gmail.com', '', 155, 44, 2, 1, 1, 4),
(12, 'hero', 'nox', '2024-11-29', 'nox hero', '124', 55, 'matteo@gmail.com', '$2y$10$RDS2PpaRBkVVs0OGD.XcKuj9PabpB/EaaM2RGWB62VJ5kY899n4ce', 442, 42424, 2, 1, 1, 4),
(14, 'hero', 'nox', '2024-11-29', 'sd', '1 rue dicko mode', 54554435, 'matteo@gmail.com', '', 5512, 455, 2, 1, 1, 4),
(15, 'ZEUB DE CHEVAL 314', 'MICHELLLLLLLLLLE', '2024-11-28', 'ZEUB DE CHEVACHE', '11 rue ZEUB DE CHEVA', 5146565, 'matteo@gmail.com', '$2y$10$zFfzZOL2EA.VZVeeuoaf4ON5Wbb3MVfn6m8uLmTUZI3PA4eg42PJC', 157884, 654554, 2, 1, 1, 4),
(18, 'hero', 'zdqd', '2024-11-29', 'qsdsd', 'qsdqs', 42465, 'matteo.piera19@gmail', '$2y$10$3IpsAH7hbpSGod1Vnmf5xuoWm3S0q1umM9UudIv6rUuAde4/IkL3S', 54545, 4545454, 2, 1, 1, 4),
(19, 'YAAAAAAAA', 'YAAAAAAAAAAAAAAAAAAA', '2024-11-29', 'YAAAAAAAAAAa', 'YAAAAAAARRRR', 753556665, 'matteo@gmail.com', '$2y$10$/aak6v1I50tsOdhSdOcjX.XFJI2jUMtoMnmP.4gf7w/a3wTr1tFi2', 65455, 5465, 2, 1, 1, 4);

DROP TRIGGER IF EXISTS `AfterInsertCavalier`;
DELIMITER $$
CREATE TRIGGER `AfterInsertCavalier` AFTER INSERT ON `cavalier` FOR EACH ROW BEGIN
    INSERT INTO log_cavalier (
        iduser,
        action,
        oldnomcavalier,
        newnomcavalier,
        oldprenomcavalier,
        newprenomcavalier,
        olddatenaissancecavalier,
        newdatenaissancecavalier,
        oldnomresponsable,
        newnomresponsable,
        oldrueresponsable,
        newrueresponsable,
        oldtelresponsable,
        newtelresponsable,
        oldemailresponsable,
        newemailresponsable,
        oldpassword,
        newpassword,
        oldnumlicence,
        newnumlicence,
        oldnumassurance,
        newnumassurance,
        oldidcommune,
        newidcommune,
        oldidgalop,
        newidgalop,
        idcavalier
    ) VALUES (
        NEW.iduser, -- Assurez-vous que cette colonne existe dans la table cavalier
        'Insertion',
        NULL, -- OLD.nomcavalier n'existe pas pour une insertion
        NEW.nomcavalier,
        NULL, -- OLD.prenomcavalier n'existe pas pour une insertion
        NEW.prenomcavalier,
        NULL, -- OLD.datenaissancecavalier n'existe pas pour une insertion
        NEW.datenaissancecavalier,
        NULL, -- OLD.nomresponsable n'existe pas pour une insertion
        NEW.nomresponsable,
        NULL, -- OLD.rueresponsable n'existe pas pour une insertion
        NEW.rueresponsable,
        NULL, -- OLD.telresponsable n'existe pas pour une insertion
        NEW.telresponsable,
        NULL, -- OLD.emailresponsable n'existe pas pour une insertion
        NEW.emailresponsable,
        NULL, -- OLD.password n'existe pas pour une insertion
        NEW.password,
        NULL, -- OLD.numlicence n'existe pas pour une insertion
        NEW.numlicence,
        NULL, -- OLD.numassurance n'existe pas pour une insertion
        NEW.numassurance,
        NULL, -- OLD.idcommune n'existe pas pour une insertion
        NEW.idcommune,
        NULL, -- OLD.idgalop n'existe pas pour une insertion
        NEW.idgalop,
        NEW.idcavalier
    );
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `AfterUpdateCavalier`;
DELIMITER $$
CREATE TRIGGER `AfterUpdateCavalier` AFTER UPDATE ON `cavalier` FOR EACH ROW BEGIN
    INSERT INTO log_cavalier (
        iduser,
        action,
        oldnomcavalier,
        newnomcavalier,
        oldprenomcavalier,
        newprenomcavalier,
        olddatenaissancecavalier,
        newdatenaissancecavalier,
        oldnomresponsable,
        newnomresponsable,
        oldrueresponsable,
        newrueresponsable,
        oldtelresponsable,
        newtelresponsable,
        oldemailresponsable,
        newemailresponsable,
        oldpassword,
        newpassword,
        oldnumlicence,
        newnumlicence,
        oldnumassurance,
        newnumassurance,
        oldidcommune,
        newidcommune,
        oldidgalop,
        newidgalop,
        idcavalier
    ) VALUES (
        NEW.iduser, -- Assurez-vous que cette colonne existe dans la table cavalier
        'modifier',
        OLD.nomcavalier,
        NEW.nomcavalier,
        OLD.prenomcavalier,
        NEW.prenomcavalier,
        OLD.datenaissancecavalier,
        NEW.datenaissancecavalier,
        OLD.nomresponsable,
        NEW.nomresponsable,
        OLD.rueresponsable,
        NEW.rueresponsable,
        OLD.telresponsable,
        NEW.telresponsable,
        OLD.emailresponsable,
        NEW.emailresponsable,
        OLD.password,
        NEW.password,
        OLD.numlicence,
        NEW.numlicence,
        OLD.numassurance,
        NEW.numassurance,
        OLD.idcommune,
        NEW.idcommune,
        OLD.idgalop,
        NEW.idgalop,
        NEW.idcavalier
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE IF NOT EXISTS `commune` (
  `idcommune` int NOT NULL AUTO_INCREMENT,
  `ville` varchar(20) NOT NULL,
  `codepostal` int NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcommune`)
) ENGINE=InnoDB AUTO_INCREMENT=5 ;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`idcommune`, `ville`, `codepostal`, `afficher`) VALUES
(1, 'Paris', 0, 0),
(2, 'Brive', 19100, 0),
(3, 'Brive-la-gaillarde', 19100, 1),
(4, 'Aigreur-MAXIMAL', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE IF NOT EXISTS `compte` (
  `idcompte` int NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` text CHARACTER SET utf8mb4  NOT NULL,
  PRIMARY KEY (`idcompte`)
) ENGINE=InnoDB AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `cours` (
  `idcours` int NOT NULL AUTO_INCREMENT,
  `libcours` varchar(20) NOT NULL,
  `horairedebut` timestamp NOT NULL,
  `horairefin` timestamp NOT NULL,
  `jour` varchar(20) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcours`)
) ENGINE=InnoDB AUTO_INCREMENT=53 ;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idcours`, `libcours`, `horairedebut`, `horairefin`, `jour`, `afficher`) VALUES
(1, 'ZEUBI WHESH', '2024-11-25 13:00:00', '2024-11-25 14:00:00', 'Lundi', 0),
(2, 'ZEUBI WHESH', '2024-12-02 13:00:00', '2024-12-02 14:00:00', 'Lundi', 1),
(3, 'ZEUBI WHESH', '2024-12-09 13:00:00', '2024-12-09 14:00:00', 'Lundi', 1),
(4, 'ZEUBI WHESH', '2024-12-16 13:00:00', '2024-12-16 14:00:00', 'Lundi', 1),
(5, 'ZEUBI WHESH', '2024-12-23 13:00:00', '2024-12-23 14:00:00', 'Lundi', 1),
(6, 'ZEUBI WHESH', '2024-12-30 13:00:00', '2024-12-30 14:00:00', 'Lundi', 1),
(7, 'ZEUBI WHESH', '2025-01-06 13:00:00', '2025-01-06 14:00:00', 'Lundi', 1),
(8, 'ZEUBI WHESH', '2025-01-13 13:00:00', '2025-01-13 14:00:00', 'Lundi', 1),
(9, 'ZEUBI WHESH', '2025-01-20 13:00:00', '2025-01-20 14:00:00', 'Lundi', 1),
(10, 'ZEUBI WHESH', '2025-01-27 13:00:00', '2025-01-27 14:00:00', 'Lundi', 1),
(11, 'ZEUBI WHESH', '2025-02-03 13:00:00', '2025-02-03 14:00:00', 'Lundi', 1),
(12, 'ZEUBI WHESH', '2025-02-10 13:00:00', '2025-02-10 14:00:00', 'Lundi', 1),
(13, 'ZEUBI WHESH', '2025-02-17 13:00:00', '2025-02-17 14:00:00', 'Lundi', 1),
(14, 'ZEUBI WHESH', '2025-02-24 13:00:00', '2025-02-24 14:00:00', 'Lundi', 1),
(15, 'ZEUBI WHESH', '2025-03-03 13:00:00', '2025-03-03 14:00:00', 'Lundi', 1),
(16, 'ZEUBI WHESH', '2025-03-10 13:00:00', '2025-03-10 14:00:00', 'Lundi', 1),
(17, 'ZEUBI WHESH', '2025-03-17 13:00:00', '2025-03-17 14:00:00', 'Lundi', 1),
(18, 'ZEUBI WHESH', '2025-03-24 13:00:00', '2025-03-24 14:00:00', 'Lundi', 1),
(19, 'ZEUBI WHESH', '2025-03-31 12:00:00', '2025-03-31 13:00:00', 'Lundi', 1),
(20, 'ZEUBI WHESH', '2025-04-07 12:00:00', '2025-04-07 13:00:00', 'Lundi', 1),
(21, 'ZEUBI WHESH', '2025-04-14 12:00:00', '2025-04-14 13:00:00', 'Lundi', 1),
(22, 'ZEUBI WHESH', '2025-04-21 12:00:00', '2025-04-21 13:00:00', 'Lundi', 1),
(23, 'ZEUBI WHESH', '2025-04-28 12:00:00', '2025-04-28 13:00:00', 'Lundi', 1),
(24, 'ZEUBI WHESH', '2025-05-05 12:00:00', '2025-05-05 13:00:00', 'Lundi', 1),
(25, 'ZEUBI WHESH', '2025-05-12 12:00:00', '2025-05-12 13:00:00', 'Lundi', 1),
(26, 'ZEUBI WHESH', '2025-05-19 12:00:00', '2025-05-19 13:00:00', 'Lundi', 1),
(27, 'ZEUBI WHESH', '2025-05-26 12:00:00', '2025-05-26 13:00:00', 'Lundi', 1),
(28, 'ZEUBI WHESH', '2025-06-02 12:00:00', '2025-06-02 13:00:00', 'Lundi', 1),
(29, 'ZEUBI WHESH', '2025-06-09 12:00:00', '2025-06-09 13:00:00', 'Lundi', 1),
(30, 'ZEUBI WHESH', '2025-06-16 12:00:00', '2025-06-16 13:00:00', 'Lundi', 1),
(31, 'ZEUBI WHESH', '2025-06-23 12:00:00', '2025-06-23 13:00:00', 'Lundi', 1),
(32, 'ZEUBI WHESH', '2025-06-30 12:00:00', '2025-06-30 13:00:00', 'Lundi', 1),
(33, 'ZEUBI WHESH', '2025-07-07 12:00:00', '2025-07-07 13:00:00', 'Lundi', 1),
(34, 'ZEUBI WHESH', '2025-07-14 12:00:00', '2025-07-14 13:00:00', 'Lundi', 1),
(35, 'ZEUBI WHESH', '2025-07-21 12:00:00', '2025-07-21 13:00:00', 'Lundi', 1),
(36, 'ZEUBI WHESH', '2025-07-28 12:00:00', '2025-07-28 13:00:00', 'Lundi', 1),
(37, 'ZEUBI WHESH', '2025-08-04 12:00:00', '2025-08-04 13:00:00', 'Lundi', 1),
(38, 'ZEUBI WHESH', '2025-08-11 12:00:00', '2025-08-11 13:00:00', 'Lundi', 1),
(39, 'ZEUBI WHESH', '2025-08-18 12:00:00', '2025-08-18 13:00:00', 'Lundi', 1),
(40, 'ZEUBI WHESH', '2025-08-25 12:00:00', '2025-08-25 13:00:00', 'Lundi', 1),
(41, 'ZEUBI WHESH', '2025-09-01 12:00:00', '2025-09-01 13:00:00', 'Lundi', 1),
(42, 'ZEUBI WHESH', '2025-09-08 12:00:00', '2025-09-08 13:00:00', 'Lundi', 1),
(43, 'ZEUBI WHESH', '2025-09-15 12:00:00', '2025-09-15 13:00:00', 'Lundi', 1),
(44, 'ZEUBI WHESH', '2025-09-22 12:00:00', '2025-09-22 13:00:00', 'Lundi', 1),
(45, 'ZEUBI WHESH', '2025-09-29 12:00:00', '2025-09-29 13:00:00', 'Lundi', 1),
(46, 'ZEUBI WHESH', '2025-10-06 12:00:00', '2025-10-06 13:00:00', 'Lundi', 1),
(47, 'ZEUBI WHESH', '2025-10-13 12:00:00', '2025-10-13 13:00:00', 'Lundi', 1),
(48, 'ZEUBI WHESH', '2025-10-20 12:00:00', '2025-10-20 13:00:00', 'Lundi', 1),
(49, 'ZEUBI WHESH', '2025-10-27 13:00:00', '2025-10-27 14:00:00', 'Lundi', 1),
(50, 'ZEUBI WHESH', '2025-11-03 13:00:00', '2025-11-03 14:00:00', 'Lundi', 1),
(51, 'ZEUBI WHESH', '2025-11-10 13:00:00', '2025-11-10 14:00:00', 'Lundi', 1),
(52, 'ZEUBI WHESH', '2025-11-17 13:00:00', '2025-11-17 14:00:00', 'Lundi', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `idevenement` int NOT NULL AUTO_INCREMENT,
  `titreevenement` varchar(20) NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`idevenement`)
) ENGINE=InnoDB AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `galop`
--

CREATE TABLE IF NOT EXISTS `galop` (
  `idgalop` int NOT NULL AUTO_INCREMENT,
  `libgalop` varchar(20) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idgalop`)
) ENGINE=InnoDB AUTO_INCREMENT=2 ;

--
-- Déchargement des données de la table `galop`
--

INSERT INTO `galop` (`idgalop`, `libgalop`, `afficher`) VALUES
(1, 'Galop 0', 0);

-- --------------------------------------------------------

--
-- Structure de la table `inserer`
--

CREATE TABLE IF NOT EXISTS `inserer` (
  `idcours` int NOT NULL,
  `idcavalier` int NOT NULL,
  PRIMARY KEY (`idcours`,`idcavalier`)
) ENGINE=InnoDB ;

-- --------------------------------------------------------

--
-- Structure de la table `log_cavalier`
--

CREATE TABLE IF NOT EXISTS `log_cavalier` (
  `idlog` int NOT NULL AUTO_INCREMENT,
  `iduser` int NOT NULL,
  `action` varchar(50) NOT NULL,
  `oldnomcavalier` varchar(50) CHARACTER SET utf8mb4  DEFAULT NULL,
  `newnomcavalier` varchar(50) NOT NULL,
  `oldprenomcavalier` varchar(50) CHARACTER SET utf8mb4  DEFAULT NULL,
  `newprenomcavalier` varchar(50) NOT NULL,
  `olddatenaissancecavalier` date DEFAULT NULL,
  `newdatenaissancecavalier` date NOT NULL,
  `oldnomresponsable` varchar(50) CHARACTER SET utf8mb4  DEFAULT NULL,
  `newnomresponsable` varchar(50) NOT NULL,
  `oldrueresponsable` varchar(50) CHARACTER SET utf8mb4  DEFAULT NULL,
  `newrueresponsable` varchar(50) NOT NULL,
  `oldtelresponsable` int DEFAULT NULL,
  `newtelresponsable` int NOT NULL,
  `oldemailresponsable` varchar(50) CHARACTER SET utf8mb4  DEFAULT NULL,
  `newemailresponsable` varchar(50) NOT NULL,
  `oldpassword` text CHARACTER SET utf8mb4 ,
  `newpassword` text NOT NULL,
  `oldnumlicence` int DEFAULT NULL,
  `newnumlicence` int NOT NULL,
  `oldnumassurance` int DEFAULT NULL,
  `newnumassurance` int NOT NULL,
  `oldidcommune` int DEFAULT NULL,
  `newidcommune` int NOT NULL,
  `oldidgalop` int DEFAULT NULL,
  `newidgalop` int NOT NULL,
  `idcavalier` int NOT NULL,
  PRIMARY KEY (`idlog`),
  KEY `fk_iduser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=14 ;

--
-- Déchargement des données de la table `log_cavalier`
--

INSERT INTO `log_cavalier` (`idlog`, `iduser`, `action`, `oldnomcavalier`, `newnomcavalier`, `oldprenomcavalier`, `newprenomcavalier`, `olddatenaissancecavalier`, `newdatenaissancecavalier`, `oldnomresponsable`, `newnomresponsable`, `oldrueresponsable`, `newrueresponsable`, `oldtelresponsable`, `newtelresponsable`, `oldemailresponsable`, `newemailresponsable`, `oldpassword`, `newpassword`, `oldnumlicence`, `newnumlicence`, `oldnumassurance`, `newnumassurance`, `oldidcommune`, `newidcommune`, `oldidgalop`, `newidgalop`, `idcavalier`) VALUES
(2, 4, 'modifier', 'a', 'a', 'a', 'a', '2024-10-09', '2024-10-09', 'a', 'a', 'a', 'a', 42454, 42454, 'e@gmail.com', 'e@gmail.com', '87546', '87546', 456456, 456456, 45645645, 45645645, 1, 1, 1, 1, 2),
(3, 4, 'modifier', 'a', 'a', 'a', 'a', '2024-10-09', '2024-10-09', 'a', 'a', 'a', 'a', 42454, 42454, 'e@gmail.com', 'e@gmail.com', 'wscwdfd', '0', 456456, 456456, 45645645, 45645645, 2, 2, 1, 1, 4),
(4, 4, 'modifier', 'piera', 'piera', 'nox', 'nox', '2024-10-29', '2024-10-29', 'piera', 'piera', 'dxdf4', 'dxdf4', 892951836, 892951836, 'matteo@gmail.com', 'matteo@gmail.com', '', '0', 0, 0, 266, 266, 1, 1, 1, 1, 6),
(5, 4, 'modifier', 'TESTJOURMEME', 'TESTJOURMEME', 'MEME', 'MEME', '2024-11-05', '2024-11-05', 'MOI', 'MOI', 'MARUE', 'MARUE', 58651234, 58651234, 'matteo@gmail.com', 'matteo@gmail.com', 'jpassedu45au635', '0', 0, 0, 1, 1, 1, 1, 1, 1, 8),
(6, 4, 'modifier', 'Arthur mais le pas b', 'Arthur mais le pas b', 'LA MEME CHOSE', 'LA MEME CHOSE', '1985-11-12', '1985-11-12', 'MATTEO LE GOAT', 'MATTEO LE GOAT', '11 rue jean mich mic', '11 rue jean mich mic', 585865966, 585865966, 'matteo@gmail.com', 'matteo@gmail.com', '$2y$10$ophQSXibMrcxSWbB2hHSS.HqNH9tHld6L3lT21ucLMd', '0', 155, 155, 44, 44, 2, 2, 1, 1, 11),
(7, 4, 'modifier', 'Arthur mais le pas b', 'Arthur mais le pas b', 'LA MEME CHOSE', 'LA MEME CHOSE', '1985-11-12', '1985-11-12', 'MATTEO LE GOAT', 'MATTEO LE GOAT', '11 rue jean mich mic', '11 rue jean mich mic', 585865966, 585865966, 'matteo@gmail.com', 'matteo@gmail.com', '$2y$10$ophQSXibMrcxSWbB2hHSS.HqNH9tHld6L3lT21ucLMd', '0', 155, 155, 44, 44, 2, 2, 1, 1, 11),
(9, 4, 'modifier', 'hero', 'hero', 'nox', 'nox', '2024-11-29', '2024-11-29', 'nox hero', 'nox hero', '124', '124', 55, 55, 'matteo@gmail.com', 'matteo@gmail.com', '$2y$10$d6mw.sZaTXtzccD4GAvUPuAcY07aHOqpjgGcLQLpDeHXqHyY7Zz5K', '0', 442, 442, 42424, 42424, 2, 2, 1, 1, 14),
(10, 4, 'modifier', 'hero', 'hero', 'nox', 'nox', '2024-11-29', '2024-11-29', 'nox hero', 'nox hero', '124', '124', 55, 55, 'matteo@gmail.com', 'matteo@gmail.com', '$2y$10$RDS2PpaRBkVVs0OGD.XcKuj9PabpB/EaaM2RGWB62VJ5kY899n4ce', '0', 442, 442, 42424, 42424, 2, 2, 1, 1, 12),
(11, 4, 'modifier', 'hero', 'hero', 'nox', 'nox', '2024-11-29', '2024-11-29', 'nox hero', 'sd', '124', '1 rue dicko mode', 55, 54554435, 'matteo@gmail.com', 'matteo@gmail.com', '$2y$10$d6mw.sZaTXtzccD4GAvUPuAcY07aHOqpjgGcLQLpDeHXqHyY7Zz5K', '0', 442, 5512, 42424, 455, 2, 2, 1, 1, 14),
(12, 4, 'Insertion', NULL, 'hero', NULL, 'zdqd', NULL, '2024-11-29', NULL, 'qsdsd', NULL, 'qsdqs', NULL, 42465, NULL, 'matteo.piera19@gmail', NULL, '0', NULL, 54545, NULL, 4545454, NULL, 2, NULL, 1, 18),
(13, 4, 'Insertion', NULL, 'YAAAAAAAA', NULL, 'YAAAAAAAAAAAAAAAAAAA', NULL, '2024-11-29', NULL, 'YAAAAAAAAAAa', NULL, 'YAAAAAAARRRR', NULL, 753556665, NULL, 'matteo@gmail.com', NULL, '$2y$10$/aak6v1I50tsOdhSdOcjX.XFJI2jUMtoMnmP.4gf7w/a3wTr1tFi2', NULL, 65455, NULL, 5465, NULL, 2, NULL, 1, 19);

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE IF NOT EXISTS `participation` (
  `idcoursbase` int NOT NULL,
  `idcoursassociee` int NOT NULL,
  `idcavalier` int NOT NULL,
  `present` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcoursbase`,`idcoursassociee`,`idcavalier`)
) ENGINE=InnoDB ;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`idcoursbase`, `idcoursassociee`, `idcavalier`, `present`) VALUES
(1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

CREATE TABLE IF NOT EXISTS `pension` (
  `idpension` int NOT NULL AUTO_INCREMENT,
  `libpension` varchar(20) NOT NULL,
  `tarifpension` float NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `numsire` int NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idpension`),
  KEY `fk_numsire` (`numsire`)
) ENGINE=InnoDB ;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `idphoto` int NOT NULL AUTO_INCREMENT,
  `nom_photo` varchar(50) NOT NULL,
  `lien` text NOT NULL,
  `numsire` int NOT NULL,
  `idevenement` int NOT NULL,
  PRIMARY KEY (`idphoto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 ;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idphoto`, `nom_photo`, `lien`, `numsire`, `idevenement`) VALUES
(1, 'cheval', 'https://cdn.ehorses.media/image/xxl/sang-chaud-lourd-etalon-2ans-noir-chevaux-elevage-attelage-moritzburg_40f89509-0ed4-4ec5-80e6-5b527a204cee.jpg', 6, 1),
(2, 'steak de cheval', 'https://static.750g.com/images/1200-630/ef7f94374e05859bdc3bd18870d51935/steak-de-cheval-au-poivre.jpeg', 5, 1),
(3, 'EPICE.png', '../../uploads/photos/EPICE.png', 6, 0),
(4, 'PDO.png', '/uploads/photos/PDO.png', 5, 0),
(5, 'RAPH.png', '/uploads/photos/RAPH.png', 6, 0),
(6, 'ZBEUBZBEUB.png', '/uploads/photos/ZBEUBZBEUB.png', 7, 0),
(7, 'STEAKPOIVRE.jpg', '../../uploads/photos/STEAKPOIVRE.jpg', 8, 0),
(8, 'CHEVAL.jpg', '../../uploads/photos/CHEVAL.jpg', 9, 0);

-- --------------------------------------------------------

--
-- Structure de la table `prend`
--

CREATE TABLE IF NOT EXISTS `prend` (
  `idcavalier` int NOT NULL,
  `idpension` int NOT NULL,
  PRIMARY KEY (`idcavalier`,`idpension`)
) ENGINE=InnoDB ;

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE IF NOT EXISTS `race` (
  `idrace` int NOT NULL AUTO_INCREMENT,
  `librace` varchar(20) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idrace`)
) ENGINE=InnoDB AUTO_INCREMENT=7 ;

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

CREATE TABLE IF NOT EXISTS `robe` (
  `idrobe` int NOT NULL AUTO_INCREMENT,
  `librobe` varchar(20) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idrobe`)
) ENGINE=InnoDB AUTO_INCREMENT=6 ;

--
-- Déchargement des données de la table `robe`
--

INSERT INTO `robe` (`idrobe`, `librobe`, `afficher`) VALUES
(3, 'DE MARIAGE', 0),
(4, 'MACHIN', 0),
(5, 'MARIAGE', 1);

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
-- Contraintes pour la table `log_cavalier`
--
ALTER TABLE `log_cavalier`
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`iduser`) REFERENCES `compte` (`idcompte`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `pension`
--
ALTER TABLE `pension`
  ADD CONSTRAINT `fk_numsire` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

