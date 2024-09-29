-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 29 sep. 2024 à 17:11
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `porco`
--

-- --------------------------------------------------------

--
-- Structure de la table `codes_promo`
--

CREATE TABLE `codes_promo` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `formules_partage_id` int(11) DEFAULT NULL,
  `nombre_utilisations` int(11) DEFAULT 0,
  `date_creation` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `codes_promo`
--

INSERT INTO `codes_promo` (`id`, `utilisateur_id`, `code`, `formules_partage_id`, `nombre_utilisations`, `date_creation`) VALUES
(1, 1, '4Y0GZ6', 6, 4, '2024-09-28 15:46:35'),
(2, 2, '5W792M', 1, 3, '2024-09-28 15:49:19'),
(3, 3, 'ESJ4DT', 4, 2, '2024-09-28 18:25:59'),
(4, 3, 'E2HGSF', 6, 1, '2024-09-28 18:28:52'),
(5, 1, '6QD6UR', NULL, 0, '2024-09-29 17:05:17'),
(6, 4, 'F29L9C', NULL, 0, '2024-09-29 17:07:20');

-- --------------------------------------------------------

--
-- Structure de la table `formules_partage`
--

CREATE TABLE `formules_partage` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `pourcentage_principal` int(11) DEFAULT NULL,
  `pourcentage_secondaire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formules_partage`
--

INSERT INTO `formules_partage` (`id`, `nom`, `pourcentage_principal`, `pourcentage_secondaire`) VALUES
(1, '10%', 10, 0),
(2, '9%-1%', 9, 1),
(3, '8%-2%', 8, 2),
(4, '7%-3%', 7, 3),
(5, '6%-4%', 6, 4),
(6, '5%-5%', 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `numero`, `mot_de_passe`) VALUES
(1, 'akkoula', '1234567890', '$2y$10$PO3K0NnuoHmmUXPHI53jY./EgAu7ADNPLnEcvlaH./5wrfR0a32xa'),
(2, 'akoula2', '123456789', '$2y$10$PO3K0NnuoHmmUXPHI53jY./EgAu7ADNPLnEcvlaH./5wrfR0a32xa'),
(3, 'akk', '1234567899', '$2y$10$PO3K0NnuoHmmUXPHI53jY./EgAu7ADNPLnEcvlaH./5wrfR0a32xa'),
(4, 'didi b', '987654321', '$2y$10$Q14GXX7c1UBYoUjQPoC9wOZ5yyFF0LyafcO9quq0qcaEf3QNisNUq');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `codes_promo`
--
ALTER TABLE `codes_promo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `formules_partage_id` (`formules_partage_id`);

--
-- Index pour la table `formules_partage`
--
ALTER TABLE `formules_partage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `codes_promo`
--
ALTER TABLE `codes_promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `formules_partage`
--
ALTER TABLE `formules_partage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `codes_promo`
--
ALTER TABLE `codes_promo`
  ADD CONSTRAINT `codes_promo_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `codes_promo_ibfk_2` FOREIGN KEY (`formules_partage_id`) REFERENCES `formules_partage` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
