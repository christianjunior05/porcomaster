-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 19 sep. 2024 à 11:17
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
-- Structure de la table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `numero_telephone` varchar(15) NOT NULL,
  `code_promo` varchar(50) NOT NULL,
  `nombre_fois_utilise` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `promotions`
--

INSERT INTO `promotions` (`id`, `nom`, `numero_telephone`, `code_promo`, `nombre_fois_utilise`) VALUES
(1, 'Jean Dupont', '0601020304', 'PROMO2024', 2),
(2, 'Anne Dupré', '1235467', 'PROMO2424', 2),
(3, 'Anne Dupré', '000000000', 'DLFQJDF3', 10),
(4, 'ZABGA', '000000000', 'KJDFJF778', 10),
(5, 'DIDI B', '1111111111', 'DFLFK454', 5),
(6, 'MAMI ', '00345444', 'LOSL34465', 7),
(7, 'TONTON', '345675', 'GOERN3456', 4),
(8, 'LOPÈRE', '4444444', 'DFLFK454', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
