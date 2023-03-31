-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 30 mars 2023 à 13:19
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetrest`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `idPublication` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `aimer` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idPublication`,`idUtilisateur`),
  KEY `IdUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`idPublication`, `idUtilisateur`, `aimer`) VALUES
(19, 1, 1),
(19, 2, 0),
(19, 3, 1),
(19, 4, 1),
(20, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `idPublication` int(11) NOT NULL AUTO_INCREMENT,
  `dateP` datetime DEFAULT CURRENT_TIMESTAMP,
  `contenu` text,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idPublication`),
  KEY `IdUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`idPublication`, `dateP`, `contenu`, `idUtilisateur`) VALUES
(19, '2023-03-30 08:31:04', 'moncontenu', 1),
(20, '2023-03-30 08:33:57', 'changement', 1),
(21, '2023-03-30 14:38:08', 'monco', 3),
(22, '2023-03-30 14:44:46', 'deuxieme', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(50) DEFAULT NULL,
  `motDePasse` varchar(50) DEFAULT NULL,
  `role` enum('moderator','publisher') DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `utilisateur_identifiant_unique` (`identifiant`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `identifiant`, `motDePasse`, `role`) VALUES
(1, 'leo', 'leo', 'moderator'),
(2, 'med', 'med', 'moderator'),
(3, 'moderator', 'm', 'moderator'),
(4, 'publisher', 'p', 'publisher');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
