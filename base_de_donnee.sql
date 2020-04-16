-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  jeu. 16 avr. 2020 à 11:21
-- Version du serveur :  5.7.25
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `memory`
--

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200331124929', '2020-03-31 12:49:38'),
('20200331133102', '2020-03-31 13:31:51');

-- --------------------------------------------------------

--
-- Structure de la table `party`
--

CREATE TABLE `party` (
  `id` int(11) NOT NULL,
  `date_started` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `nb_try` int(11) NOT NULL,
  `cards` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_cards` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `party`
--

INSERT INTO `party` (`id`, `date_started`, `user_id`, `nb_try`, `cards`, `nb_cards`, `state`) VALUES
(20, '2020-04-01 14:36:44', 1, 5, '2x1;1x1;2x1;1x1', 4, 1),
(21, '2020-04-01 14:39:19', 1, 17, '2x1;4x1;2x1;1x1;7x1;5x1;8x1;1x1;5x1;8x1;3x1;3x1;6x1;6x1;4x1;7x1', 16, 1),
(22, '2020-04-01 14:44:59', 1, 24, '5x1;2x1;7x1;3x1;6x1;4x1;8x1;1x1;4x1;1x1;3x1;5x1;2x1;6x1;7x1;8x1', 16, 1),
(26, '2020-04-06 11:36:06', 1, 15, '4x1;8x1;7x1;7x1;2x1;5x1;3x1;3x1;1x1;8x1;4x1;5x1;6x1;6x1;2x1;1x1', 16, 1),
(29, '2020-04-16 08:02:09', 1, 19, '10x1;9x1;11x1;3x1;8x1;2x1;5x1;8x1;4x1;11x1;3x1;6x1;1x1;7x1;5x1;7x1;9x1;2x1;10x1;4x1;1x1;6x1', 22, 1),
(32, '2020-04-16 08:08:17', 1, 10, '5x1;1x1;4x1;2x1;5x1;2x1;3x1;3x1;4x1;1x1', 10, 1),
(33, '2020-04-16 08:09:35', 1, 25, '2x1;7x1;7x1;6x1;8x1;6x1;4x1;5x1;3x1;3x1;8x1;1x1;1x1;4x1;2x1;5x1', 16, 1),
(38, '2020-04-16 09:17:44', 1, 131, '29x1;11x1;3x1;28x1;20x1;3x1;6x1;24x1;2x1;9x1;4x1;23x1;18x1;15x1;24x1;31x1;29x1;4x1;14x1;5x1;21x1;25x1;8x1;26x1;15x1;32x1;19x1;13x1;32x1;17x1;28x1;16x1;22x1;10x1;19x1;17x1;1x1;8x1;23x1;2x1;7x1;12x1;10x1;5x1;9x1;31x1;25x1;27x1;30x1;1x1;21x1;12x1;22x1;6x1;13x1;20x1;18x1;11x1;30x1;26x1;16x1;7x1;14x1;27x1', 64, 1),
(39, '2020-04-16 09:24:12', 1, 21, '7x1;6x1;8x1;2x1;1x1;2x1;4x1;7x1;8x1;3x1;6x1;4x1;5x1;1x1;3x1;5x1', 16, 1),
(40, '2020-04-16 11:19:21', 1, 9, '4x1;2x1;4x1;2x1;1x1;3x1;3x1;1x1', 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(1, 'admin', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Q8wNKZOtuCh+eOLBi9BdDA$yUPm2Mm5DFLUQWj0LhFsjJxbs7Xix3mRl7lO1fol1Po');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `party`
--
ALTER TABLE `party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
