-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 02 jan. 2021 à 22:03
-- Version du serveur :  8.0.22-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pingme`
--

-- --------------------------------------------------------

--
-- Structure de la table `black_side`
--

USE `pingme`;

CREATE TABLE `black_side` (
  `id` int NOT NULL,
  `speed` int NOT NULL,
  `control` int NOT NULL,
  `rotation` int NOT NULL,
  `racket_id` int NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `racket`
--

CREATE TABLE `racket` (
  `id` int NOT NULL,
  `speed` int NOT NULL,
  `control` int NOT NULL,
  `rotation` int NOT NULL,
  `user_id` int NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `red_side`
--

CREATE TABLE `red_side` (
  `id` int NOT NULL,
  `speed` int NOT NULL,
  `control` int NOT NULL,
  `rotation` int NOT NULL,
  `racket_id` int NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `connection` datetime DEFAULT NULL,
  `victories` int NOT NULL DEFAULT '0',
  `defeats` int NOT NULL DEFAULT '0'
);

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int NOT NULL,
  `author_id` int NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `black_side`
--
ALTER TABLE `black_side`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `racket_id` (`racket_id`);

--
-- Index pour la table `racket`
--
ALTER TABLE `racket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Index pour la table `red_side`
--
ALTER TABLE `red_side`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `racket_id` (`racket_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `black_side`
--
ALTER TABLE `black_side`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `racket`
--
ALTER TABLE `racket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `red_side`
--
ALTER TABLE `red_side`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
