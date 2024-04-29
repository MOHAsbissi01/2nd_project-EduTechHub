-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 29 avr. 2024 à 12:13
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `edutechhub`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_category` int(11) NOT NULL,
  `type_doc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_category`, `type_doc`) VALUES
(1, 'cours'),
(2, 'livre'),
(3, 'exercice');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id_cours` int(11) UNSIGNED NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `proprietaire` varchar(255) DEFAULT NULL,
  `prix` int(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `titre`, `proprietaire`, `prix`, `description`, `image`, `category`, `pdf`) VALUES
(1, 'Premier Cours', 'Selim', 1, 'MB4', 'https://th.bing.com/th/id/OIP.3MDxaU5izP9WJ-cRICZYhgHaHa?rs=1&amp;pid=ImgDetMain', '1', '../uploads/AA5 Domaine de définition d’une intégrale dépendant d’un paramètre.pdf'),
(2, 'Deuxième Cours', 'Selim', 1, 'MB4 Chap 3', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', '2', '../uploads/Exercice 2.pdf'),
(5, 'Deuxième Cours', 'Selim', 1, 'MB4 Chap 3', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', '2', '../uploads/Exercice 4.pdf'),
(7, 'Test', 'Esprit', 100, 'Exerice mathématiques du 3ème chapitre du mb4', 'https://www.garonapromotion.fr/wp-content/uploads/sites/4/2017/12/Image-test-1_large.jpg', '3', '../uploads/Exercice 5.pdf'),
(8, 'Deuxième Cours', 'Selim', 1, 'MB4', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', '1', '../uploads/Exercice 1.pdf'),
(9, 'Deuxième Cours', 'Selim', 999999, 'MB4', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', '1', '../uploads/Exercice 4.pdf'),
(10, 'TEST', 'TEST', 18, 'TEST', 'https://cdn.futura-sciences.com/sources/images/dossier/773/01-intro-773.jpg', '1', '../uploads/Exercice 2.pdf'),
(14, 'TEST2', 'TEST2', 11111, 'TEST2', 'https://cdn.futura-sciences.com/sources/images/dossier/773/01-intro-773.jpg', '3', '../uploads/Exercice 4.pdf'),
(15, 'Dix', 'Neuf', 19, 'X', 'https://cdn.futura-sciences.com/sources/images/dossier/773/01-intro-773.jpg', '1', '../uploads/Exercice 4.pdf'),
(16, 'test3', 'Esprit', 13, 'MB4', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', '1', '../uploads/Exercice 4.pdf'),
(20, 'Deuxième Cours', 'Selim', 1, 'MB4 Chap 3', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', '1', '../uploads/Exercice 2.pdf'),
(21, 'f', 'x', 0, 'x', 'https://www.garonapromotion.fr/wp-content/uploads/sites/4/2017/12/Image-test-1_large.jpg', '1', '../uploads/Exercice 1.pdf'),
(22, 'QQQQQQQ', 'QQQQQQQQQ', 1, 'QQQQQQQQ', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', '1', '../uploads/Exercice 1.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `option_1` varchar(100) NOT NULL,
  `option_2` varchar(100) NOT NULL,
  `option_3` varchar(100) NOT NULL,
  `correct_option` varchar(100) NOT NULL,
  `test_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_question`, `updated_at`, `created_at`, `quiz_title`, `question_text`, `option_1`, `option_2`, `option_3`, `correct_option`, `test_id`) VALUES
(6, '2024-04-23', '2024-04-23', 'Math', 'aaaaaaa', 'a', 'q', 'w', 'w', NULL),
(36, '2024-04-25', '2024-04-25', 'Math', 'zzzzzzz', 'a', 'q', 'w', 'q', NULL),
(37, '2024-04-25', '2024-04-25', 'essai', 'essaie', 'x', 'z', 'a', 'x', NULL),
(38, '2024-04-26', '2024-04-26', 'essai', 'essaie', 'x', 'z', 'a', 'ww', NULL),
(39, '2024-04-26', '2024-04-26', 'SVT', 'La question est ZZZ', 'Z', 'ZZ', 'ZZZ', 'ZZZ', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `utilisateur` varchar(255) NOT NULL,
  `note_obtenue` int(11) DEFAULT 0,
  `id_question` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`id_test`, `quiz_title`, `utilisateur`, `note_obtenue`, `id_question`) VALUES
(14, '1er test (1)', '', 0, NULL),
(16, '2ème test ', '', 0, NULL),
(18, '3ème', '', 0, NULL),
(19, '4ème (1)', '', 0, NULL),
(20, '5ème', '', 0, NULL),
(23, '6', '', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `test_question`
--

CREATE TABLE `test_question` (
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `test_question`
--

INSERT INTO `test_question` (`test_id`, `question_id`) VALUES
(14, 6),
(14, 38),
(16, 36),
(16, 37),
(18, 6),
(18, 36),
(18, 37),
(19, 38),
(20, 39),
(23, 38),
(23, 39);

-- --------------------------------------------------------

--
-- Structure de la table `test_results`
--

CREATE TABLE `test_results` (
  `id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `test_results`
--

INSERT INTO `test_results` (`id`, `test_id`, `username`, `score`, `created_at`) VALUES
(6, 14, 'Kp', 1, '2024-04-26 15:15:10'),
(7, 16, 'Selim', 2, '2024-04-26 15:22:00'),
(8, 14, 'a', 1, '2024-04-27 20:10:16'),
(11, 14, 'Selim', 0, '2024-04-27 20:40:19'),
(22, 20, 'cz', 1, '2024-04-27 23:37:02'),
(26, 14, 'gazo', 1, '2024-04-28 00:23:03'),
(56, 14, 'AAA', 1, '2024-04-29 08:51:00'),
(57, 20, 'aaasssknkczdvedl', 1, '2024-04-29 10:11:44');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `test_id` (`test_id`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`),
  ADD KEY `id_question` (`id_question`);

--
-- Index pour la table `test_question`
--
ALTER TABLE `test_question`
  ADD PRIMARY KEY (`test_id`,`question_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Index pour la table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id_test`);

--
-- Contraintes pour la table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

--
-- Contraintes pour la table `test_question`
--
ALTER TABLE `test_question`
  ADD CONSTRAINT `test_question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id_test`),
  ADD CONSTRAINT `test_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id_question`),
  ADD CONSTRAINT `test_question_ibfk_3` FOREIGN KEY (`test_id`) REFERENCES `test` (`id_test`),
  ADD CONSTRAINT `test_question_ibfk_4` FOREIGN KEY (`question_id`) REFERENCES `question` (`id_question`);

--
-- Contraintes pour la table `test_results`
--
ALTER TABLE `test_results`
  ADD CONSTRAINT `test_results_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id_test`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
