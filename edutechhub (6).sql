-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 14 mai 2024 à 22:13
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
  `category` int(11) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `titre`, `proprietaire`, `prix`, `description`, `image`, `category`, `pdf`) VALUES
(1, 'Premier Cours', 'Selim', 1, 'MB4', 'https://th.bing.com/th/id/OIP.3MDxaU5izP9WJ-cRICZYhgHaHa?rs=1&amp;pid=ImgDetMain', 1, '../uploads/AA5 Domaine de définition d’une intégrale dépendant d’un paramètre.pdf'),
(2, 'Deuxième Cours', 'Selim', 1, 'MB4 Chap 3', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', 2, '../uploads/Exercice 2.pdf'),
(5, 'Deuxième Cours', 'Selim', 1, 'MB4 Chap 3', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', 2, '../uploads/Exercice 4.pdf'),
(7, 'Test', 'Esprit', 100, 'Exerice mathématiques du 3ème chapitre du mb4', 'https://www.garonapromotion.fr/wp-content/uploads/sites/4/2017/12/Image-test-1_large.jpg', 3, '../uploads/Exercice 5.pdf'),
(8, 'Deuxième Cours', 'Selim', 1, 'MB4', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', 1, '../uploads/Exercice 1.pdf'),
(9, 'Deuxième Cours', 'Selim', 999999, 'MB4', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', 1, '../uploads/Exercice 4.pdf'),
(10, 'TEST', 'TEST', 18, 'TEST', 'https://cdn.futura-sciences.com/sources/images/dossier/773/01-intro-773.jpg', 1, '../uploads/Exercice 2.pdf'),
(14, 'TEST2', 'TEST2', 11111, 'TEST2', 'https://cdn.futura-sciences.com/sources/images/dossier/773/01-intro-773.jpg', 3, '../uploads/Exercice 4.pdf'),
(15, 'Dix', 'Neuf', 19, 'X', 'https://cdn.futura-sciences.com/sources/images/dossier/773/01-intro-773.jpg', 1, '../uploads/Exercice 4.pdf'),
(16, 'test3', 'Esprit', 13, 'MB4', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', 1, '../uploads/Exercice 4.pdf'),
(20, 'Deuxième Cours', 'Selim', 1, 'MB4 Chap 3', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', 1, '../uploads/Exercice 2.pdf'),
(21, 'f', 'x', 0, 'x', 'https://www.garonapromotion.fr/wp-content/uploads/sites/4/2017/12/Image-test-1_large.jpg', 1, '../uploads/Exercice 1.pdf'),
(22, 'QQQQQQQ', 'QQQQQQQQQ', 1, 'QQQQQQQQ', 'https://img.freepik.com/vecteurs-premium/livre-scolaire-doodle-manuel-mathematiques-pour-education-clip-art-style-dessin-anime-illustration-vectorielle-isolee-fond-blanc_534604-1685.jpg', 1, '../uploads/Exercice 1.pdf'),
(23, 'AAAAAA', 'aaaaaa', 0, '1', 'https://www.garonapromotion.fr/wp-content/uploads/sites/4/2017/12/Image-test-1_large.jpg', 3, '../uploads/AA3  Intégrale impropre des fonctions à signe constant.pdf'),
(24, 'aaaaa', 'aaaaaa', 1111111111, 'aaaaaaaaaaaaa', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/SMPTE_Color_Bars.svg/1200px-SMPTE_Color_Bars.svg.png', 2, '../uploads/Exercice 1.pdf'),
(25, 'aaaaaa', 'aaaaaaa', 2147483647, 'aaaaaaaaaaaaaa', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/SMPTE_Color_Bars.svg/1200px-SMPTE_Color_Bars.svg.png', 1, '../uploads/Exercice 2.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `cours_test`
--

CREATE TABLE `cours_test` (
  `cours_id` int(11) UNSIGNED NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours_test`
--

INSERT INTO `cours_test` (`cours_id`, `test_id`) VALUES
(1, 24),
(1, 30),
(1, 31),
(2, 31),
(5, 14),
(14, 32),
(15, 19),
(15, 20),
(16, 16),
(16, 19),
(20, 23),
(20, 32),
(22, 18);

-- --------------------------------------------------------

--
-- Structure de la table `gestion_evenements`
--

CREATE TABLE `gestion_evenements` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `organizateur` varchar(255) NOT NULL,
  `affiche` varchar(255) NOT NULL,
  `type` enum('Conférence','Atelier','Séminaire','Formation en ligne','Table ronde','Forum','Hackathon') NOT NULL,
  `frais` varchar(255) NOT NULL,
  `duree` varchar(255) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gestion_evenements`
--

INSERT INTO `gestion_evenements` (`id`, `nom`, `sujet`, `date`, `lieu`, `organizateur`, `affiche`, `type`, `frais`, `duree`, `max`) VALUES
(1, 'event1', 'aaaaaaaaa', '2024-04-30 22:00:00', 'Esprit Bloc H', 'Dhia Mouha', 'meeting-01.jpg', 'Atelier', 'Gratuit', '3h', 10),
(4, 'event2', 'hello world', '2024-04-29 12:00:00', 'Esprit Bloc H', 'Dhia Mouha', 'meeting-02.jpg', 'Conférence', '10 dt', '5h', 10),
(10, 'Mouha', '777', '2024-04-30 14:05:00', 'Esprit Bloc G', 'Dhia Mouha', 'meeting-03.jpg', 'Forum', '10 dt', '5h', 10),
(13, 'test4', '4', '2024-04-30 18:36:00', 'Esprit Bloc G', 'Dhia Mouha', 'meeting-04.jpg', 'Atelier', 'Gratuit', '2h', 20),
(14, 'event777', 'event5', '2024-05-12 17:10:00', 'Esprit Bloc H', 'Dhia Mouhaa', 'meeting-03.jpg', 'Atelier', 'Gratuit', '3h', 15);

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `inscription_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`inscription_id`, `user_name`, `email`, `event_id`) VALUES
(40, 'aaaa', '1@esprit.tn', 4),
(41, 'msddd', 'adddd@esprit.tn', 4),
(42, 'b2023', 'b1@esprit.tn', 4),
(43, 'b51515', 'b@esprit.tn', 4),
(44, 'lo', 'lo@gmail.com', 4),
(45, 'mohamed', 'med@esprit.tn', 4),
(46, 'ms', 'sbiscmed@esprit.tn', 4),
(47, 'mdffff', 'sbisohamed@esprit.tn', 4),
(48, '', 'sbissi.mohamed@esprit.tn', 4),
(49, 'oll', 'sbissimohamed9@gmail.com', 4);

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
(39, '2024-04-26', '2024-04-26', 'SVT', 'La question est ZZZ', 'Z', 'ZZ', 'ZZZ', 'ZZZ', NULL),
(40, '2024-05-07', '2024-05-07', 'Quizz Suivie', 'Question suivie', 'A1', 'A2', 'A3', 'A3', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reclamations`
--

CREATE TABLE `reclamations` (
  `id_recla` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `num` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamations`
--

INSERT INTO `reclamations` (`id_recla`, `nom`, `num`, `email`, `description`) VALUES
(10, 'khalil', 31, 'sbissi.mohamed@esprit.tn', 'kjegkfugez'),
(63, 'khalil', 31, 'sbissi.mohamed@esprit.tn', 'kjegkfugez'),
(66, 'barga', 32003035, 'adddd@esprit.tn', 'samer');

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id_reponse` int(11) NOT NULL,
  `reclamation_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `msg` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id_reponse`, `reclamation_id`, `subject`, `msg`) VALUES
(60, NULL, 'zab', 'message'),
(85, 66, 'sasa', 'hahaha');

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
(19, '4ème', '', 0, NULL),
(20, '5ème (1)', '', 0, NULL),
(23, '6 ème test', '', 0, NULL),
(24, 'TEST', '', 0, NULL),
(30, 'test suivie', '', 0, NULL),
(31, 'test suivie 2', '', 0, NULL),
(32, 'Test suivie 3', '', 0, NULL);

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
(16, 6),
(16, 36),
(18, 39),
(19, 38),
(20, 37),
(23, 37),
(24, 6),
(30, 6),
(31, 6),
(31, 36),
(32, 39),
(32, 40);

-- --------------------------------------------------------

--
-- Structure de la table `test_results`
--

CREATE TABLE `test_results` (
  `id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `test_results`
--

INSERT INTO `test_results` (`id`, `test_id`, `username`, `score`, `created_at`, `email`) VALUES
(6, 14, 'Kp', 1, '2024-04-26 15:15:10', NULL),
(7, 16, 'Selim', 2, '2024-04-26 15:22:00', NULL),
(8, 14, 'a', 1, '2024-04-27 20:10:16', NULL),
(11, 14, 'Selim', 0, '2024-04-27 20:40:19', NULL),
(22, 20, 'cz', 1, '2024-04-27 23:37:02', NULL),
(26, 14, 'gazo', 1, '2024-04-28 00:23:03', NULL),
(56, 14, 'AAA', 1, '2024-04-29 08:51:00', NULL),
(57, 20, 'aaasssknkczdvedl', 1, '2024-04-29 10:11:44', NULL),
(58, 14, 'Selimmm', 1, '2024-05-01 14:15:43', NULL),
(59, 14, 'Selimmm', 0, '2024-05-01 16:39:08', NULL),
(60, 24, 'Selim', 1, '2024-05-01 17:03:39', NULL),
(61, 20, 'aaaaaa', 0, '2024-05-04 15:55:44', 'lo@gmail.com'),
(62, 32, 'CZ8', 1, '2024-05-07 10:41:23', 'b@esprit.tn'),
(63, 32, 'TestSui', 2, '2024-05-07 10:53:19', '1@esprit.tn');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `reset_token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `reset_token`) VALUES
(1, 'aaaa', '1@esprit.tn', '$2y$10$XWw5srJZQ2V9Fjp3mi2YuOT.Uqqw20r1rOM9o8icF82wzxcPFTjNe', 'uploaded_img/background.png', 0),
(3, 'msddd', 'adddd@esprit.tn', '$2y$10$7GMJseyL3.LjH1rP7MCy8eQ/0BN44CV5oO4yflDYu05V9ABuqh8JO', '', 0),
(2, 'b2023', 'b1@esprit.tn', '$2y$10$Bv/ulIblxSfZPuOD4cNP2eBOFH8qVNjXXYqT2.hzvaGv4kt5BfFJa', '', 0),
(1, 'b51515', 'b@esprit.tn', '$2y$10$qEwLt0Yhc4n/M33BMyixzeP2K.8tn/zpZ6.BYzt616ZZ/d18gh6yC', 'uploaded_img/1713193879_6axk28SZRSOMEbzIWJ7Gcw.png', 0),
(0, 'kkkkk', 'kkk@gmail.com', NULL, '', 0),
(3, 'lo', 'lo@gmail.com', '$2y$10$PFBHSiVhy7GmqXbSlwherOXWNv.8DrthWMZwcdJH1u6OcgJUG6Zq6', 'uploaded_img/fantasy-astronaut-space.jpg', 0),
(1, 'mohamed', 'med@esprit.tn', '$2y$10$35ZZVbSsg1bB.C00jemh.OAIBHNWT.qBuHl0lyeHq1kSBbWPj8nZm', 'uploaded_img/429510705_789510735839055_2423811623538829369_n.png', 0),
(3, 'ms', 'sbiscmed@esprit.tn', '$2y$10$pHuBi5OWSxEV.670PzaNVeetib0lTJjogY.IUAS9DpGA6GBCTPSGW', 'uploaded_img/fantasy-astronaut-space.jpg', 0),
(3, 'mdffff', 'sbisohamed@esprit.tn', '$2y$10$6nI6YG9UJM4CWLXm2LZSYe4BSE5evKPFLZyBSE9vEFc0ouyjKJK2W', '', 0),
(3, '', 'sbissi.mohamed@esprit.tn', '$2y$10$gWChlZAR1a3D.c0RMkHoVeTpHJ4.pZ1hFpoh/5.rVBeUirItU7yAa', 'uploaded_img/logo2.jpg', 4648),
(2, 'oll', 'sbissimohamed9@gmail.com', '$2y$10$Z9W6FSgdo.HAkYR2e90.7OeHEk.b4Z.5umzz60c3iKR98i9ZSiOCe', '', 5675);

-- --------------------------------------------------------

--
-- Structure de la table `user_courses`
--

CREATE TABLE `user_courses` (
  `email` varchar(255) NOT NULL,
  `cours_id` int(10) UNSIGNED NOT NULL
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
  ADD PRIMARY KEY (`id_cours`),
  ADD KEY `fk_cours_categorie` (`category`);

--
-- Index pour la table `cours_test`
--
ALTER TABLE `cours_test`
  ADD PRIMARY KEY (`cours_id`,`test_id`),
  ADD KEY `fk_cours_test_test` (`test_id`);

--
-- Index pour la table `gestion_evenements`
--
ALTER TABLE `gestion_evenements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`inscription_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `fk_email` (`email`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `test_id` (`test_id`);

--
-- Index pour la table `reclamations`
--
ALTER TABLE `reclamations`
  ADD PRIMARY KEY (`id_recla`),
  ADD KEY `fk_email2` (`email`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id_reponse`),
  ADD KEY `reponses_ibfk_1` (`reclamation_id`);

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
  ADD KEY `test_id` (`test_id`),
  ADD KEY `fk_test_results_email` (`email`) USING BTREE;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- Index pour la table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`email`,`cours_id`),
  ADD KEY `cours_id` (`cours_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `gestion_evenements`
--
ALTER TABLE `gestion_evenements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `inscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `reclamations`
--
ALTER TABLE `reclamations`
  MODIFY `id_recla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `fk_cours_categorie` FOREIGN KEY (`category`) REFERENCES `categorie` (`id_category`);

--
-- Contraintes pour la table `cours_test`
--
ALTER TABLE `cours_test`
  ADD CONSTRAINT `fk_cours_test_cours` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `fk_cours_test_test` FOREIGN KEY (`test_id`) REFERENCES `test` (`id_test`);

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `fk_email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscriptions_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `gestion_evenements` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id_test`);

--
-- Contraintes pour la table `reclamations`
--
ALTER TABLE `reclamations`
  ADD CONSTRAINT `fk_email2` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`reclamation_id`) REFERENCES `reclamations` (`id_recla`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_test_results_user_email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_email` FOREIGN KEY (`email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `test_results_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id_test`);

--
-- Contraintes pour la table `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `user_courses_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_courses_ibfk_2` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id_cours`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
