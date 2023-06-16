-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 16 juin 2023 à 22:19
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bilemoapi`
--
CREATE DATABASE IF NOT EXISTS `bilemoapi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bilemoapi`;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `authorized_until` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `manager_id`, `email`, `roles`, `password`, `created_at`, `authorized_until`) VALUES
(4, 3, 'mobile-shop@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$6HJwlWlU.7NQofQgF8/vwuAqkMyWLyokAuQPOIltIfYh/qfxRjyZm', '2023-06-16 22:17:48', '2023-07-16 22:17:48'),
(5, 3, 'mobileAvenue@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$7XEUdB5V/Oro3GZ6KbGviO97N6uPQwDx/0bmpH/ZzqLC6HaUwZf4u', '2023-06-16 22:17:48', '2023-07-16 22:17:48');

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `manager`
--

INSERT INTO `manager` (`id`, `email`, `roles`, `password`) VALUES
(3, 'BileMo@super_admin.com', '[\"ROLE_SUPER_ADMIN\"]', '$2y$13$2qLvWVjRW79cGTZgVrZvhumfUFdRWGsKiRnpACWmUC67YOmV2od/2');

-- --------------------------------------------------------

--
-- Structure de la table `mobile`
--

DROP TABLE IF EXISTS `mobile`;
CREATE TABLE `mobile` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `storage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mobile`
--

INSERT INTO `mobile` (`id`, `manager_id`, `name`, `brand`, `price`, `created_at`, `updated_at`, `storage`, `description`) VALUES
(22, 3, 'galaxy s1', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S1 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(23, 3, 'galaxy s2', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S2 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(24, 3, 'galaxy s3', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S3 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(25, 3, 'galaxy s4', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S4 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(26, 3, 'galaxy s5', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S5 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(27, 3, 'galaxy s6', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S6 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(28, 3, 'galaxy s7', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S7 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(29, 3, 'galaxy s8', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S8 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(30, 3, 'galaxy s9', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S9 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(31, 3, 'galaxy s10', 'samsung', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'Le Samsung Galaxy S10 est le flagship de Samsung pour 2019. Il est équipé \r\n                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.'),
(32, 3, 'iphone1', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 1 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)'),
(33, 3, 'iphone2', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 2 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)'),
(34, 3, 'iphone3', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 3 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)'),
(35, 3, 'iphone4', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 4 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)'),
(36, 3, 'iphone5', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 5 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)'),
(37, 3, 'iphone6', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 6 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)'),
(38, 3, 'iphone7', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 7 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)'),
(39, 3, 'iphone8', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 8 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)'),
(40, 3, 'iphone9', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 9 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)'),
(41, 3, 'iphone10', 'apple', '980 €', '2023-06-16 22:18:04', NULL, '64GB', 'L\'écran de l\'iPhone 10 a des angles arrondis qui suivent la ligne élégante \r\n                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche\r\n                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `client_id`, `email`, `roles`, `password`, `created_at`) VALUES
(42, 4, 'user1@gmail.com', '[\"ROLE_USER\"]', '$2y$13$wOb5AwZRwu9VE91rPUrbPuW6IPf9wzuJc/V2JlY7Mw2Pp2CXksmn2', '2023-06-16 22:17:49'),
(43, 4, 'user2@gmail.com', '[\"ROLE_USER\"]', '$2y$13$0zpTuaxALtadc9OZxGiz2uuyqnUH7ZD6JyDrXsGGbp3ZAOV6fixGe', '2023-06-16 22:17:49'),
(44, 4, 'user3@gmail.com', '[\"ROLE_USER\"]', '$2y$13$V85MFu//iOIWt82ckwMJVeV8y09rjXho6qdMRHQ5BTjn8d.hxnmCi', '2023-06-16 22:17:50'),
(45, 4, 'user4@gmail.com', '[\"ROLE_USER\"]', '$2y$13$1n3.qnm2sS4wHUYco6wfIe140vz5bg6yv9lgOBvroVGhf9t7wrk.W', '2023-06-16 22:17:50'),
(46, 4, 'user5@gmail.com', '[\"ROLE_USER\"]', '$2y$13$/bOVkuwhu.mVHQHcWqnI6OZ55.PYD2rkZboLsyDJAXynpdePmHQxW', '2023-06-16 22:17:50'),
(47, 4, 'user6@gmail.com', '[\"ROLE_USER\"]', '$2y$13$/swliNcR92/.zwDbssCHIeyMY/RMYRTF0Yb1lOOQaPvOB0V5NqP6C', '2023-06-16 22:17:51'),
(48, 4, 'user7@gmail.com', '[\"ROLE_USER\"]', '$2y$13$89NhKHuvyIdNomfX0nsQjOckXWg9VugF4F4cRnGQX4WUQEYTAeFeS', '2023-06-16 22:17:51'),
(49, 4, 'user8@gmail.com', '[\"ROLE_USER\"]', '$2y$13$ZOeqQDpa2haovLMmyvoxeOv1sj1Hh7JsLN6Feb5E9Ryg9pP.IxKuO', '2023-06-16 22:17:51'),
(50, 4, 'user9@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OfdnyQqVee119EjvwlMfSOz5QpupWKaQqzQ6QBRhgBMKd5fFgcd7G', '2023-06-16 22:17:52'),
(51, 4, 'user10@gmail.com', '[\"ROLE_USER\"]', '$2y$13$0DCSd584p3VV0jCpjnKMzOtgw2pEzozGif4X/ppTlnD7qJHh/h/Y2', '2023-06-16 22:17:52'),
(52, 4, 'user11@gmail.com', '[\"ROLE_USER\"]', '$2y$13$oPv.VauZxDOqpBHjWTtZMeZ4ZS8HYCIFnbTDOvvTmEFskLaGE.l5u', '2023-06-16 22:17:53'),
(53, 4, 'user12@gmail.com', '[\"ROLE_USER\"]', '$2y$13$LJh8tc8Uu3aSkmjbXRNbSuwURxNds9qQhVZPU.VlYHy6SMhMgGiX6', '2023-06-16 22:17:53'),
(54, 4, 'user13@gmail.com', '[\"ROLE_USER\"]', '$2y$13$XoH7H7Ft9EoiM/KZ1dYmg.8gaNyGef84Trr2tlVp1dVS34JHtSGtO', '2023-06-16 22:17:53'),
(55, 4, 'user14@gmail.com', '[\"ROLE_USER\"]', '$2y$13$FyBXpkuzeT/ktfoqJ5.sDuypbk9kSaZ0PlNw.cmo/oh6N3yvmsZdO', '2023-06-16 22:17:54'),
(56, 4, 'user15@gmail.com', '[\"ROLE_USER\"]', '$2y$13$YVh0n4YMWV0aX1I/S4f4NOHQseVQB.AFXHg9LQJkGjJsooMUcUPTe', '2023-06-16 22:17:54'),
(57, 4, 'user16@gmail.com', '[\"ROLE_USER\"]', '$2y$13$.cR2t5YaPtGm/r2kYDsJuO/9JCdW6y1XYsZ1ltkYBbvqSOk82YUXC', '2023-06-16 22:17:54'),
(58, 4, 'user17@gmail.com', '[\"ROLE_USER\"]', '$2y$13$AiBLIkzKAFFe0bQbTlL94OxvMD6nQNNCOzCXt3rp1OaJv68ImIhp2', '2023-06-16 22:17:55'),
(59, 4, 'user18@gmail.com', '[\"ROLE_USER\"]', '$2y$13$um6YJHzT5q9V9svz556gz.s0SEN5e86WhYHb3fTvonXj/a33FR/r6', '2023-06-16 22:17:55'),
(60, 4, 'user19@gmail.com', '[\"ROLE_USER\"]', '$2y$13$/pRWuBwzyZnOOyTx7kwI.e7holELbfgsGyJ.IShd9uDUEL6P2Txcq', '2023-06-16 22:17:56'),
(61, 4, 'user20@gmail.com', '[\"ROLE_USER\"]', '$2y$13$/aIfop/5iBJWLMqnCcypruozwMiel8oWhgd35QEZVRebHqVsCCYRG', '2023-06-16 22:17:56'),
(62, 4, 'user21@gmail.com', '[\"ROLE_USER\"]', '$2y$13$3QxWrX3OVb0Qvys1tX1Sk./r6PepYFn1z.mMLwpBnUJ54yHW/OJPi', '2023-06-16 22:17:56'),
(63, 4, 'user22@gmail.com', '[\"ROLE_USER\"]', '$2y$13$FUxB8NR.XnzjmdlI4zlA6.zwmQpoLdbmdlfhqNEl6UdVrumGj0v2e', '2023-06-16 22:17:57'),
(64, 4, 'user23@gmail.com', '[\"ROLE_USER\"]', '$2y$13$wIXF7GCV9sImsMmlk9B0suPzOyPnGawcI4vYt9sZBXREO8DI2GgLO', '2023-06-16 22:17:57'),
(65, 4, 'user24@gmail.com', '[\"ROLE_USER\"]', '$2y$13$JO5ce26pZdVIspYHm.WttO/W/O0YIouLuSgMwIXlooZyMb1ulausK', '2023-06-16 22:17:57'),
(66, 4, 'user25@gmail.com', '[\"ROLE_USER\"]', '$2y$13$0ylNU4iyEoBwcHh8AkwTHeSfBPZGyNcB4ozdSvVZmCEmirodPpPbO', '2023-06-16 22:17:58'),
(67, 5, 'user100@gmail.com', '[\"ROLE_USER\"]', '$2y$13$n4h84h79dk7T8E94VtnJMOM1BG8SAC8qTc0ryg6zjTr5HtVDd6FQO', '2023-06-16 22:17:58'),
(68, 5, 'user101@gmail.com', '[\"ROLE_USER\"]', '$2y$13$sdwUctx4oFYeRro0ziaVPuJ5t4bCf2Q0/HxvZK.VyvKvY3k7YEVRe', '2023-06-16 22:17:59'),
(69, 5, 'user102@gmail.com', '[\"ROLE_USER\"]', '$2y$13$Yw5nML3oB2sNuMRmX7vzx.3SHatuZEZkO5lsLExhmnkw95B8B1/Xu', '2023-06-16 22:17:59'),
(70, 5, 'user103@gmail.com', '[\"ROLE_USER\"]', '$2y$13$ucSyysR75m10qZmNVI5uzOzVqQ0vYL6g7x2K9XGK19yaE1pA5lx0u', '2023-06-16 22:17:59'),
(71, 5, 'user104@gmail.com', '[\"ROLE_USER\"]', '$2y$13$va5HVK2OcvbKJKZ7DoEQWOZZ68mg2Q.6s88V7eaRicTmCeD/6CYgK', '2023-06-16 22:18:00'),
(72, 5, 'user105@gmail.com', '[\"ROLE_USER\"]', '$2y$13$3JXYKetIpoxswuM/mKMMOeVtNmCkwpu8xa1Z0lQgstIlTbsZ5AVBS', '2023-06-16 22:18:00'),
(73, 5, 'user106@gmail.com', '[\"ROLE_USER\"]', '$2y$13$ptLYjoYzwPI4xwUmWydIKe5wAXaCc0AVyWjNteMp5VT32Lzt4veSi', '2023-06-16 22:18:00'),
(74, 5, 'user107@gmail.com', '[\"ROLE_USER\"]', '$2y$13$aPZzpuD3404r8ykRRwOYSO8WJasoqH.qPixZBgDBQitfUw.2ojoIu', '2023-06-16 22:18:01'),
(75, 5, 'user108@gmail.com', '[\"ROLE_USER\"]', '$2y$13$U5UbHKJKKGc28mnVUXDm4.X5dOweFRWohBwyoiw5gsxuyJZ41LrtG', '2023-06-16 22:18:01'),
(76, 5, 'user109@gmail.com', '[\"ROLE_USER\"]', '$2y$13$eIkl97yB7irofDHLLRzeC.UnxkLhnXi/o9k8UmDwvHnRrkammFcsK', '2023-06-16 22:18:02'),
(77, 5, 'user110@gmail.com', '[\"ROLE_USER\"]', '$2y$13$5lVgnisWA6r.VHYKcKTi0uRNMbr3..idqx.JeMWQj/YKlgfV2VVxS', '2023-06-16 22:18:02'),
(78, 5, 'user111@gmail.com', '[\"ROLE_USER\"]', '$2y$13$DjrWKAMO.47ogA.bEjNtyOsX1s19jXLxkaNCE1lZ/pSqdNdbnlESy', '2023-06-16 22:18:02'),
(79, 5, 'user112@gmail.com', '[\"ROLE_USER\"]', '$2y$13$Jg2qNIMEEThelAg.znTL9u8SZ3dh3lIoolgHV2e/CdYZiRhhuKQu6', '2023-06-16 22:18:03'),
(80, 5, 'user113@gmail.com', '[\"ROLE_USER\"]', '$2y$13$dbHdiuQpoJxzhI0MplcKSuKxVdNrAcsZeR9LJvn2PJeyBkeHC8G8W', '2023-06-16 22:18:03'),
(81, 5, 'user114@gmail.com', '[\"ROLE_USER\"]', '$2y$13$R.5EiYT6qKsZdG545.XocOoc4d0YxSH1BCmS5Wogoj7W79t6CQome', '2023-06-16 22:18:03'),
(82, 5, 'user115@gmail.com', '[\"ROLE_USER\"]', '$2y$13$atcc260dQkO3xMq2Ae7Xr.bFA6ONxsrXdOqhoAoebuWlGSFnHlAj.', '2023-06-16 22:18:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C7440455E7927C74` (`email`),
  ADD KEY `IDX_C7440455783E3463` (`manager_id`);

--
-- Index pour la table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_FA2425B9E7927C74` (`email`);

--
-- Index pour la table `mobile`
--
ALTER TABLE `mobile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3C7323E0783E3463` (`manager_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D64919EB6921` (`client_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `mobile`
--
ALTER TABLE `mobile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_C7440455783E3463` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`);

--
-- Contraintes pour la table `mobile`
--
ALTER TABLE `mobile`
  ADD CONSTRAINT `FK_3C7323E0783E3463` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64919EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
