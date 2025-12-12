-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 déc. 2025 à 20:34
-- Version du serveur : 9.4.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `touche_pas_au_klaxon`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

DROP TABLE IF EXISTS `agence`;
CREATE TABLE IF NOT EXISTS `agence` (
  `id_agence` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de l''agence',
  `nom_ville` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nom de la ville/site',
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date d''ajout de l''agence',
  PRIMARY KEY (`id_agence`),
  UNIQUE KEY `nom_ville` (`nom_ville`),
  KEY `idx_nom_ville` (`nom_ville`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des agences (sites géographiques)';

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`id_agence`, `nom_ville`, `date_creation`) VALUES
(1, 'Paris', '2025-12-07 17:08:43'),
(2, 'Lyon', '2025-12-07 17:08:43'),
(3, 'Marseille', '2025-12-07 17:08:43'),
(4, 'Toulouse', '2025-12-07 17:08:43'),
(5, 'Nice', '2025-12-07 17:08:43'),
(6, 'Nantes', '2025-12-07 17:08:43'),
(7, 'Strasbourg', '2025-12-07 17:08:43'),
(8, 'Montpellier', '2025-12-07 17:08:43'),
(9, 'Bordeaux', '2025-12-07 17:08:43'),
(10, 'Lille', '2025-12-07 17:08:43'),
(11, 'Rennes', '2025-12-07 17:08:43'),
(12, 'Reims', '2025-12-07 17:08:43'),
(13, 'Berlin', '2025-12-10 20:52:48');

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

DROP TABLE IF EXISTS `trajet`;
CREATE TABLE IF NOT EXISTS `trajet` (
  `id_trajet` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `id_agence_depart` int NOT NULL,
  `id_agence_arrivee` int NOT NULL,
  `date_heure_depart` datetime NOT NULL,
  `date_heure_arrivee` datetime NOT NULL,
  `nb_places_total` int NOT NULL,
  `nb_places_disponibles` int NOT NULL,
  PRIMARY KEY (`id_trajet`),
  KEY `fk_trajet_auteur` (`id_utilisateur`),
  KEY `fk_trajet_agence_depart` (`id_agence_depart`),
  KEY `fk_trajet_agence_arrivee` (`id_agence_arrivee`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`id_trajet`, `id_utilisateur`, `id_agence_depart`, `id_agence_arrivee`, `date_heure_depart`, `date_heure_arrivee`, `nb_places_total`, `nb_places_disponibles`) VALUES
(1, 1, 1, 2, '2025-12-10 08:00:00', '2025-12-10 10:30:00', 4, 3),
(2, 2, 3, 5, '2025-12-11 09:00:00', '2025-12-11 12:30:00', 3, 1),
(3, 3, 4, 1, '2025-12-12 14:00:00', '2025-12-12 17:00:00', 4, 2),
(4, 4, 6, 8, '2025-12-13 06:30:00', '2025-12-13 10:00:00', 5, 5),
(5, 5, 7, 10, '2025-12-14 18:00:00', '2025-12-14 22:00:00', 3, 1),
(6, 6, 9, 11, '2025-12-15 13:00:00', '2025-12-15 16:30:00', 2, 1),
(7, 7, 2, 6, '2025-12-16 07:00:00', '2025-12-16 11:00:00', 4, 4),
(8, 8, 5, 7, '2025-12-17 19:30:00', '2025-12-17 23:00:00', 3, 2),
(9, 9, 8, 3, '2025-12-18 10:00:00', '2025-12-18 14:30:00', 4, 3),
(10, 10, 11, 4, '2025-12-19 09:30:00', '2025-12-19 13:00:00', 2, 0),
(12, 1, 9, 3, '2026-02-05 11:00:00', '2026-02-05 21:00:00', 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de l''utilisateur',
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nom de famille',
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Prénom',
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email utilisé pour la connexion',
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Numéro de téléphone',
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mot de passe hashé (password_hash)',
  `est_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'TRUE = administrateur, FALSE = utilisateur standard',
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création du compte',
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_email` (`email`),
  KEY `idx_est_admin` (`est_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table des utilisateurs de l''application';

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `telephone`, `mot_de_passe`, `est_admin`, `date_creation`) VALUES
(1, 'Martin', 'Alexandre', 'alexandre.martin@email.fr', '0612345678', 'azerty', 1, '2025-12-07 17:16:59'),
(2, 'Dubois', 'Sophie', 'sophie.dubois@email.fr', '0698765432', 'azerty', 0, '2025-12-07 17:16:59'),
(3, 'Bernard', 'Julien', 'julien.bernard@email.fr', '0622446688', 'azerty', 0, '2025-12-07 17:16:59'),
(4, 'Moreau', 'Camille', 'camille.moreau@email.fr', '0611223344', 'azerty', 0, '2025-12-07 17:16:59'),
(5, 'Lefevre', 'Lucie', 'lucie.lefevre@email.fr', '0777889900', 'azerty', 0, '2025-12-07 17:16:59'),
(6, 'Leroy', 'Thomas', 'thomas.leroy@email.fr', '0655443322', 'azerty', 0, '2025-12-07 17:16:59'),
(7, 'Roux', 'Chloe', 'chloe.roux@email.fr', '0633221199', 'azerty', 0, '2025-12-07 17:16:59'),
(8, 'Petit', 'Maxime', 'maxime.petit@email.fr', '0766778899', 'azerty', 0, '2025-12-07 17:16:59'),
(9, 'Garnier', 'Laura', 'laura.garnier@email.fr', '0688776655', 'azerty', 0, '2025-12-07 17:16:59'),
(10, 'Dupuis', 'Antoine', 'antoine.dupuis@email.fr', '0744556677', 'azerty', 0, '2025-12-07 17:16:59'),
(11, 'Admin', 'Site', 'admin@site.fr', '0102030405', 'azerty', 1, '2025-12-07 20:50:07');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `fk_trajet_agence_arrivee` FOREIGN KEY (`id_agence_arrivee`) REFERENCES `agence` (`id_agence`),
  ADD CONSTRAINT `fk_trajet_agence_depart` FOREIGN KEY (`id_agence_depart`) REFERENCES `agence` (`id_agence`),
  ADD CONSTRAINT `fk_trajet_auteur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
