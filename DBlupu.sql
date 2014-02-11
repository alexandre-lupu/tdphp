-- phpMyAdmin SQL Dump
-- version 4.1.5
-- http://www.phpmyadmin.net
--
-- Client :  info2
-- Généré le :  Mar 11 Février 2014 à 09:50
-- Version du serveur :  5.5.24-4-log
-- Version de PHP :  5.4.9-4ubuntu2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `DBlupu`
--

-- --------------------------------------------------------

--
-- Structure de la table `Activites`
--

CREATE TABLE IF NOT EXISTS `Activites` (
  `nom` varchar(20) NOT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Activites`
--

INSERT INTO `Activites` (`nom`) VALUES
('Anglais'),
('Café'),
('Java'),
('PHP'),
('Python'),
('Repos');

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE IF NOT EXISTS `participer` (
  `login` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `heure` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`login`,`nom`,`heure`,`Date`),
  KEY `participer_nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `participer`
--

INSERT INTO `participer` (`login`, `nom`, `heure`, `Date`) VALUES
('toto', 'Java', 13, '2014-02-23'),
('toto', 'Repos', 8, '2014-02-17'),
('toto', 'Repos', 12, '2014-02-24');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `USER` varchar(20) NOT NULL,
  `PASSWD` varchar(60) NOT NULL,
  PRIMARY KEY (`USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`USER`, `PASSWD`) VALUES
('moi', '8f8ad28dd6debff410e630ae13436709'),
('toto', 'f71dbe52628a3f83a77ab494817525c6');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_login` FOREIGN KEY (`login`) REFERENCES `utilisateurs` (`USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participer_nom` FOREIGN KEY (`nom`) REFERENCES `Activites` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
