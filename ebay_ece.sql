-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 15 avr. 2020 à 16:35
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ebay_ece`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `adresse` text NOT NULL,
  `infos_bancaires` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MySQL AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id`, `type`, `pseudo`, `mail`, `mdp`, `items`, `adresse`, `infos_bancaires`) VALUES
(1, 'Acheteur', 'Zorro', 'alexandre.bizord@gmail.com', 'aze', '', '', ''),
(2, 'Admin', 'Alexandre', 'alexbdu92@hotmail.fr', 'aze', '', '', ''),
(6, 'Vendeur', 'Alexandre2', 'alexbdu92@hotmail.fr', '123', '', '', ''),
(7, 'Vendeur', 'Vendeur', 'vendeur@vendeur.com', ' ', '', '', ''),
(8, 'Acheteur', 'Acheteur', 'acheteur@acheteur.com', ' ', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `photos` text NOT NULL,
  `desc_courte` varchar(255) NOT NULL,
  `desc_longue` text NOT NULL,
  `video` text NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `prix_min` double NOT NULL,
  `type_vente` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` varchar(255) NOT NULL,
  `echeance` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MySQL AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `nom`, `photos`, `desc_courte`, `desc_longue`, `video`, `categorie`, `prix`, `prix_min`, `type_vente`, `statut`, `echeance`) VALUES
(1, 'Mon premier item', 'a:4:{i:0;s:8:\"item.jpg\";i:1;s:5:\"1.jpg\";i:2;s:5:\"2.jpg\";i:3;s:5:\"3.jpg\";}', 'description courte', 'description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue ', 'none', 'musée', 100, 20, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:7:\"enchere\";}', 'en vente', '2020-04-13'),
(2, 'Mon deuxième item', 'a:4:{i:0;s:8:\"item.jpg\";i:1;s:5:\"1.jpg\";i:2;s:5:\"2.jpg\";i:3;s:5:\"3.jpg\";}', 'description courte', 'description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue ', 'none', 'musée', 100, 20, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:11:\"proposition\";}', 'en vente', '2020-04-13'),
(8, 'Mon item vendu par ici', 'a:3:{i:0;s:13:\"JDsYHvL5.jpeg\";i:1;s:13:\"h3bZJiaQ.jpeg\";i:2;s:12:\"ko5I97UX.png\";}', 'c\'est un sniper stylé', 'Dion Timmer\r\nLike → https://www.facebook.com/DYTimmer\r\nFollow → https://twitter.com/diontimmermusic\r\nListen → https://soundcloud.com/diontimmer\r\nInstagram → https://www.instagram.com/dion_timmer\r\n\r\nThe Arcturians\r\nLike → https://www.facebook.com/TheArcturiansMusic/\r\nFollow → https://twitter.com/thearcturians\r\nListen → https://soundcloud.com/thearcturiansmusic\r\nInstagram → https://www.instagram.com/thearcturiansmusic/', '', 'vip', 200, 20, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:7:\"enchere\";}', 'en vente', '2020-04-16'),
(9, 'Lab 3 - H00333094', 'a:1:{i:0;s:12:\"P5aRGA08.png\";}', 'yes', '\r\nAirsoft Entrepot\r\nWell Sniper MB4418-2C\r\n5\r\n(1)\r\n· 109,90 €*\r\nCe spring tactique et , moderne dispose d\'une lunette, crosse type M4, rabattable sur le côté et de , nombreux rails sur le garde-main pour la ...\r\n* Pour connaître les derniers tarifs et la disponibilité, consultez le site Web. Les image', '', 'musée', 0, 0, 'a:1:{i:0;s:11:\"proposition\";}', 'en vente', '0000-00-00'),
(10, 'Lab 3 - H00333094', 'a:1:{i:0;s:12:\"hQApL1fc.png\";}', 'yes', '\r\nAirsoft Entrepot\r\nWell Sniper MB4418-2C\r\n5\r\n(1)\r\n· 109,90 €*\r\nCe spring tactique et , moderne dispose d\'une lunette, crosse type M4, rabattable sur le côté et de , nombreux rails sur le garde-main pour la ...\r\n* Pour connaître les derniers tarifs et la disponibilité, consultez le site Web. Les image', '', 'musée', 0, 0, 'a:1:{i:0;s:11:\"proposition\";}', 'en vente', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `item` int(11) NOT NULL,
  `acheteur` int(11) NOT NULL,
  `prix` double NOT NULL,
  `n_proposition` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MySQL AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `item`, `acheteur`, `prix`, `n_proposition`) VALUES
(1, 'enchere', 1, 1, 51, 5),
(2, 'enchere', 1, 2, 52, 0),
(4, 'enchere', 1, 1, 6, 0),
(6, 'enchere', 1, 1, 5253, 0),
(12, 'enchere', 1, 1, 12245, 0),
(11, 'enchere', 1, 7, 6666, 0),
(10, 'proposition', 2, 1, 58, 1),
(13, 'proposition', 10, 8, 12, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
