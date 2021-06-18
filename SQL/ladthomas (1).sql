-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 18 juin 2021 à 22:38
-- Version du serveur :  10.4.19-MariaDB
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ladthomas`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(256) NOT NULL,
  `resumee` text NOT NULL,
  `contenu` text NOT NULL,
  `categories` text NOT NULL,
  `images` text NOT NULL,
  `actif` varchar(5) NOT NULL,
  `posteur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `resumee`, `contenu`, `categories`, `images`, `actif`, `posteur`, `date`) VALUES
(22, 'Apprendre Avez OpenClassRoom', 'lknmmmmmmmmmmmmmmmmmmmm', 'klnnnnnnnnnnnnnnnnnnnn', 'RNB', 'upload/1280x680_prince_22_avril_2021_gettyimages-1268347593.jpg', 'oui', 3, '2021-06-17 02:26:33');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `date`) VALUES
(1, 'RNB', '2021-06-16 15:50:13'),
(2, 'RAP', '2021-06-16 15:50:13'),
(9, 'Classic', '2021-06-16 16:38:23'),
(10, 'DJ', '2021-06-16 16:48:35');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `posteur` text NOT NULL,
  `messages` text NOT NULL,
  `idArticles` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `userdb`
--

CREATE TABLE `userdb` (
  `id` int(11) NOT NULL,
  `nom` text DEFAULT NULL,
  `prenom` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `biographie` text DEFAULT NULL,
  `motdepasse` text DEFAULT NULL,
  `is_Admin` varchar(5) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `userdb`
--

INSERT INTO `userdb` (`id`, `nom`, `prenom`, `email`, `biographie`, `motdepasse`, `is_Admin`, `date`) VALUES
(3, 'Sara', 'Thomas ', 'ladThomad225@gmail.com ', 'je suis Lad Thomas ', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'yes', '2021-06-06 17:15:13'),
(4, 'Jefferson', 'Saraa', 'Hermaneleroux@gmail.com', NULL, 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'no', '2021-06-06 19:51:18'),
(5, 'Jefferson', 'Sara', 'test@gmail.com', NULL, '02e0a51e74de584591fb1037b10bada5a4053b1e', 'non', '2021-06-17 01:45:15');

-- --------------------------------------------------------

--
-- Structure de la table `usernewsletter`
--

CREATE TABLE `usernewsletter` (
  `id` int(11) NOT NULL,
  `mail` text NOT NULL,
  `categorie` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `usernewsletter`
--

INSERT INTO `usernewsletter` (`id`, `mail`, `categorie`, `date`) VALUES
(7, 'jeanphilippesara225@gmail.com', 'RNB', '2021-06-16 20:02:21'),
(8, 'ladouyouthomas@outlook.fr', 'RAP', '2021-06-16 20:02:28'),
(9, 'test@gmail.com', 'DJ', '2021-06-17 01:46:19'),
(11, 'ladThomad225@gmail.com', 'Classic', '2021-06-17 13:00:26');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `userdb`
--
ALTER TABLE `userdb`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usernewsletter`
--
ALTER TABLE `usernewsletter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `userdb`
--
ALTER TABLE `userdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `usernewsletter`
--
ALTER TABLE `usernewsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
