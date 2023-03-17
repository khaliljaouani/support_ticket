-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 01 oct. 2021 à 21:54
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `support_ticket`
--

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `support_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `support_id`, `type`, `category`, `subject`, `description`, `attachment`, `created_at`, `updated_at`, `level`, `status`) VALUES
(62, 4, 2, 'Demande', 'Software License', 'office', 'office', '2zbo789og.png', '2021-09-30 21:23:29', '2021-09-30 21:23:29', '4', 'Closed'),
(63, 4, 2, 'Demande', 'Hardware', 'office', 'office', '2zbo789og1.png', '2021-09-30 21:27:14', '2021-09-30 21:27:14', '2', 'Closed'),
(64, 4, 2, 'Demande', 'Access', 'access site', 'access site', '2zbo789og2.png', '2021-09-30 21:27:50', '2021-09-30 21:27:50', '2', 'Closed'),
(65, 4, 2, 'Demande', 'Software License', 'office', 'office key', NULL, '2021-10-01 11:49:36', '2021-10-01 11:49:36', '2', 'Closed'),
(66, 4, 2, 'Incident', 'Access', 'acces', 'site', NULL, '2021-10-01 12:12:25', '2021-10-01 12:12:25', '4', 'Closed'),
(67, 4, 2, 'Incident', 'Access', 'acces', 'acces site', NULL, '2021-10-01 13:41:13', '2021-10-01 13:41:13', '2', 'Closed'),
(68, 4, 2, 'Demande', 'Access', 'acces', 'acces', NULL, '2021-10-01 14:08:36', '2021-10-01 14:08:36', '4', 'New'),
(69, 4, 2, 'Incident', 'materiel', 'souris', 'Souris ne marche pas', '2zbo789og3.png', '2021-10-01 18:35:52', '2021-10-01 18:35:52', '4', 'Closed'),
(70, 4, 2, 'Demande', 'll', 'll', 'll', NULL, '2021-10-01 18:36:46', '2021-10-01 18:36:46', '1', 'Closed'),
(71, 4, NULL, 'Request', 'Software License', 'sss', 'sss', '2zbo789og4.png', '2021-10-01 18:37:33', '2021-10-01 18:37:33', '2', 'New'),
(72, 4, NULL, 'Request', 'Software License', 'access site', 'k', NULL, '2021-10-01 18:38:54', '2021-10-01 18:38:54', '1', 'New'),
(73, 4, NULL, 'Request', 'Software License', 'access site', 'k', 'error.PNG', '2021-10-01 18:39:01', '2021-10-01 18:39:01', '1', 'New'),
(74, 3, NULL, 'Request', 'Software License', 'acces', 'lll', NULL, '2021-10-01 19:05:01', '2021-10-01 19:05:01', '2', 'Closed'),
(75, 3, NULL, 'Demande', 'Software License', 'office', 'office key', 'error1.PNG', '2021-10-01 22:15:53', '2021-10-01 22:15:53', '3', 'New'),
(76, 3, 2, 'Demande', 'Hardware', 'Souris', 'Souris ne fonctionne pas', 'error2.PNG', '2021-10-01 22:22:05', '2021-10-01 21:34:41', '4', 'Closed'),
(77, 3, NULL, 'Demande', 'Un accÃ¨s', 'Site', 'Site ne marche pas', 'error3.PNG', '2021-10-01 22:24:10', '2021-10-01 22:24:10', '2', 'Closed'),
(78, 3, 2, 'Demande', 'Un matÃ©riel', 'Clavier', 'Clavier ne fonctionne pas', 'error4.PNG', '2021-10-01 22:27:55', '2021-10-01 22:27:55', '3', 'New'),
(79, 3, NULL, 'Demande', 'Licence dâ€™un logiciel', 'Office', 'licence Office', 'error5.PNG', '2021-10-01 22:29:09', '2021-10-01 22:29:09', '4', 'New'),
(80, 3, 2, 'Demande', 'Un matÃ©riel', 'Ecranc', 'Ecranc casse', '2zbo789og5.png', '2021-10-01 22:45:13', '2021-10-01 22:45:13', '4', 'New'),
(81, 3, NULL, 'Demande', 'Un matÃ©riel', 'Ecran', 'Ecran casse', '2zbo789og6.png', '2021-10-01 22:47:12', '2021-10-01 22:47:12', '4', 'New');

-- --------------------------------------------------------

--
-- Structure de la table `ticket_comments`
--

DROP TABLE IF EXISTS `ticket_comments`;
CREATE TABLE IF NOT EXISTS `ticket_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ticket_comments`
--

INSERT INTO `ticket_comments` (`id`, `user_id`, `ticket_id`, `description`, `created_at`, `updated_at`) VALUES
(18, 17, 76, 'Bonjour ton demande est en train de prepare', '2021-10-01 22:31:31', '2021-10-01 22:31:31'),
(19, 11, 76, 'Merci bcp', '2021-10-01 22:32:32', '2021-10-01 22:32:32'),
(20, 17, 76, 'Ton demande est pret', '2021-10-01 22:34:41', '2021-10-01 22:34:41');

-- --------------------------------------------------------

--
-- Structure de la table `ticket_levels`
--

DROP TABLE IF EXISTS `ticket_levels`;
CREATE TABLE IF NOT EXISTS `ticket_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ticket_levels`
--

INSERT INTO `ticket_levels` (`id`, `level`) VALUES
(1, 'Moyen'),
(2, 'Urgente'),
(3, 'Tres Urgente'),
(4, 'Bloquante');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `created_at`) VALUES
(1, 'khalil', 'jaouani', 'khalil.jaouani29@gmail.com', '$2y$10$tB7S.SMBEwWKsSJ9Hfokn.ay7c85yg.aNImBJnMjylDthzjC/WVju', 'user', '2021-09-30 21:22:26'),
(2, 'khalil', 'jaouani', 'jaouanikhalil@gmail.com', '$2y$10$uQU53VActKP21MB.99iFme1JwKGcCJ5XJi1UuUGXVBNIZsiijLAQy', 'support', '2021-09-30 21:29:56'),
(3, 'hajar', 'jaouani', 'hajar.jaouani29@gmail.com', '$2y$10$JnlELkGkpm6m80bLa8tO8ub.sJbDAqWTy6Tgg5a87U2mKiXxorec6', 'user', '2021-10-01 11:48:45'),
(4, 'wissal', 'jaouani', 'wissal.jaouani29@gmail.com', '$2y$10$RVYX3P6HrTEM9ORQ8uqoQuNiwgFUs76cg/ycN1up9RwdDq1NxLr52', 'user', '2021-10-01 12:02:53'),
(5, 'naima', 'kherchouch', 'naima.kherchouch29@gmail.com', '$2y$10$sRFa/33d248nKPqukI7YruUVioHUts905qO30AuUxfF0JWzfkSR0a', 'user', '2021-10-01 12:08:49'),
(6, 'Said', 'Riffi', 'said.riffi@gmail.com', '$2y$10$biAx76inmTORalTMwilNcuPEmtDbLHhIz14z39WGtJA24hTzdZ64a', 'support', '2021-10-01 18:44:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
