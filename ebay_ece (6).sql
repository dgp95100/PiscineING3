-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2020 at 03:19 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebay_ece`
--

-- --------------------------------------------------------

--
-- Table structure for table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `date_inscription` date NOT NULL,
  `items` text NOT NULL,
  `adresse` text NOT NULL,
  `infos_bancaires` text NOT NULL,
  `solde` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comptes`
--

INSERT INTO `comptes` (`id`, `type`, `pseudo`, `mail`, `mdp`, `date_inscription`, `items`, `adresse`, `infos_bancaires`, `solde`) VALUES
(1, 'Acheteur', 'Zorroror', 'alexandre.bizord@gmail.com', 'aze', '0000-00-01', 'a:1:{i:0;s:4:\"true\";}', 'a:8:{s:4:\"name\";s:9:\"Alexandre\";s:8:\"lastname\";s:7:\"Bizorde\";s:8:\"address1\";s:14:\"7, rue Marcel \";s:8:\"address2\";s:0:\"\";s:4:\"city\";s:8:\"Marakech\";s:8:\"postcode\";s:5:\"92300\";s:7:\"country\";s:6:\"France\";s:5:\"phone\";s:10:\"0687517799\";}', 'a:5:{s:8:\"cardname\";s:1:\"z\";s:8:\"cardtype\";s:1:\"a\";s:10:\"cardnumber\";s:1:\"e\";s:14:\"cardexpiration\";s:1:\"r\";s:8:\"cardcode\";s:1:\"t\";}', 66),
(2, 'Admin', 'Admin', 'alexbdu92@hotmail.fr', 'aze', '0000-00-00', '', '', '', 0),
(6, 'Vendeur', 'Alexandre', 'alexbdu92@hotmail.fr3', '1233', '0000-00-00', '', '', '', 0),
(7, 'Vendeur', 'Vendeur', 'vendeur@vendeur.com', 'merde', '0000-00-00', '', '', '', 16000),
(8, 'Acheteur', 'Acheteur', 'acheteur@acheteur.com', ' ', '0000-00-00', 'a:1:{i:0;s:2:\"34\";}', 'a:8:{s:4:\"name\";s:7:\"Virgile\";s:8:\"lastname\";s:6:\"Thomas\";s:8:\"address1\";s:18:\"81bis rue perronet\";s:8:\"address2\";s:0:\"\";s:4:\"city\";s:17:\"Neuilly-Sur-Seine\";s:8:\"postcode\";s:5:\"92200\";s:7:\"country\";s:6:\"France\";s:5:\"phone\";s:10:\"0687517799\";}', '', 29000),
(10, 'Vendeur', 'Ululu', 'ululu@ululu.fr', 'aze', '0000-00-00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `photos` text NOT NULL,
  `desc_courte` varchar(255) NOT NULL,
  `desc_longue` text NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `prix_min` double NOT NULL,
  `type_vente` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vendeur` int(11) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `echeance` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nom`, `photos`, `desc_courte`, `desc_longue`, `categorie`, `prix`, `prix_min`, `type_vente`, `vendeur`, `statut`, `echeance`) VALUES
(1, 'Mon premier item', 'a:4:{i:0;s:8:\"item.jpg\";i:1;s:5:\"1.jpg\";i:2;s:5:\"2.jpg\";i:3;s:5:\"3.jpg\";}', 'description courte', 'description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue description plus longue ', 'musée', 100, 20, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:7:\"enchere\";}', 7, 'vendu', '2020-04-13'),
(20, 'Vieux porte-bougie', 'a:2:{i:0;s:13:\"YRG9U2gK.jpeg\";i:1;s:13:\"QUwaaZkf.jpeg\";}', 'La flamme s\'est éteinte depuis', 'Durant des siècles, le jonc a été utilisé pour faire des chandelles. Fendu avec précaution pour ne pas en abimer la moelle, il était trempé dans de la graisse végétale ou animale qu\'on laissait ensuite durcir. On le faisait brûler dans des brûle-joncs. En Occident, à partir du Moyen Âge la chandelle rivalise avec la lampe à huile. Cette dernière a l\'inconvénient de réclamer une attention constante : il faut la remplir régulièrement, couper et remonter la mèche qui charbonne, nettoyer l\'huile qui coule. La chandelle, seulement constituée d\'une mèche entourée de suif de bœuf ou de mouton, est plus pratique sans être excessivement chère (mais elle est taxée et l\'huile reste moins économique). Moins de liquide qui se renverse, de flamme à ajuster, de réservoir à remplir. Mais le suif coule et blesse les doigts, la flamme demeure jaune et fumeuse, il faut toujours entretenir la mèche qui finit par charbonner.', 'ferraille/trésor', 0, 0, 'a:1:{i:0;s:11:\"proposition\";}', 7, 'en vente', '0000-00-00'),
(17, 'Vieille radio', 'a:2:{i:0;s:13:\"tp3mIjsC.jpeg\";i:1;s:13:\"1iswigBJ.jpeg\";}', 'Pour écouter les programmes des années 1960', 'Un récepteur radio (aussi appelé : poste de radio, transistor, tuner, autoradio, etc.) est un appareil électronique destiné à capter, sélectionner et décoder les ondes radioélectriques émises par les émetteurs radio. La fonction de décodage est d\'extraire des ondes captées les informations, qui y ont été incorporées avant d’être émises : sons ou signaux numériques (RDS, DRM Digital Radio Mondiale, signaux horaires, etc.).', 'ferraille/trésor', 0, 150, 'a:1:{i:0;s:7:\"enchere\";}', 7, 'en vente', '2020-04-18'),
(18, 'Throne de fer', 'a:1:{i:0;s:13:\"IFdR9eY7.jpeg\";}', 'Un throne de fer comme dans game of throne', 'l s\'agit de l\'adaptation de la série de romans écrits par George R. R. Martin depuis 1996, saga réputée pour son réalisme et par ses nombreuses inspirations tirées d’événements, lieux et personnages historiques réels, tels que la guerre des Deux-Roses, le mur d\'Hadrien ou Henri VII Tudor2.', 'ferraille/trésor', 450, 0, 'a:1:{i:0;s:14:\"achat_immediat\";}', 7, 'vendu', '0000-00-00'),
(21, 'Trio de femmes nues', 'a:3:{i:0;s:13:\"mOH4ldZU.jpeg\";i:1;s:13:\"wrpT7IAQ.jpeg\";i:2;s:13:\"SJuP8sHy.jpeg\";}', 'Parce que jamais deux sans trois', 'Une femme est un être humain de sexe ou de genre féminin et d\'âge adulte. Avant l\'âge adulte, on parle de fille.\r\n\r\nSon sexe génétique ou sexe génotypique est déterminé par la présence de deux chromosomes X (et/ou par l\'absence du gène SRY) sur la vingt-troisième paire. L\'embryon est cependant physiologiquement indifférencié jusqu\'à la septième semaine de grossesse. À partir de la huitième semaine, commence la différenciation des gonades et des organes génitaux internes puis des organes externes au cours du troisième mois de vie fœtale. La maturité sexuelle féminine (capacité à se reproduire) est bornée par les étapes de la ménarche et de la ménopause. La période de gestation, d\'une durée de neuf mois environ, est appelée « grossesse ».', 'musée', 450, 300, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:7:\"enchere\";}', 7, 'vendu', '2020-04-19'),
(22, 'Sculpture de Jules César', 'a:1:{i:0;s:13:\"w2ikpH5m.jpeg\";}', 'Je crois que c\'est pas Jules César', 'Jules César (latin : Caius Iulius Caesar IV à sa naissance, Imperator Iulius Caesar Divus après sa mort), aussi appelé simplement César, est un général, homme politique et écrivain romain, né à Rome le 12 ou le 13 juillet 100 av. J.-C. et mort le 15 mars 44 av. J.-C. (aux ides de mars)7 dans la même ville.\r\n\r\nSon parcours unique, au cœur du dernier siècle de la République romaine, bouleversée par les tensions sociales et les guerres civiles, marqua le monde romain et l\'histoire universelle : ambitieux, il s\'appuya sur le courant réformateur et démagogue qui traversait la cité romaine pour favoriser son ascension politique ; stratège et tacticien, il repoussa à l\'aide de ses armées les frontières de la République romaine jusqu\'au Rhin et à l\'océan Atlantique en conquérant la Gaule, puis utilisa ses légions pour s’emparer du pouvoir au cours de la guerre civile qui l\'opposa à Pompée, son ancien allié, puis aux républicains.', 'musée', 650, 0, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:11:\"proposition\";}', 7, 'en vente', '0000-00-00'),
(23, 'Boucles d\'oreille Hermes 24 Carats', 'a:2:{i:0;s:13:\"k0kMdFZU.jpeg\";i:1;s:13:\"e61ByQNO.jpeg\";}', 'Parce que toujours plus de bling bling', 'Dans la mythologie grecque, Hermès (Ἑρμῆς / Hermễs en grec, Ἑρμᾶς / Hermãs en dorien) est une des divinités de l\'Olympe. Il est le messager des dieux, principalement de Zeus, comme Iris est la messagère d\'Héra, donneur de la chance, inventeur des poids et des mesures, gardien des routes et carrefours, dieu des voyageurs, des commerçants, des voleurs et des orateurs. Il conduit les âmes aux Enfers1. Son équivalent latin est Mercure.', 'vip', 350, 0, 'a:1:{i:0;s:14:\"achat_immediat\";}', 7, 'en vente', '0000-00-00'),
(24, 'Peinture au plafond', 'a:2:{i:0;s:13:\"jkUtbEb6.jpeg\";i:1;s:13:\"Gch222CC.jpeg\";}', 'On ne vend pas le plafond avec', 'Un plafond désigne une surface horizontale délimitée qui se situe au-dessus de l\'observateur et par extension, la borne maximale que l\'on peut atteindre. Il est employé dans plusieurs domaines.', 'musée', 0, 520, 'a:1:{i:0;s:7:\"enchere\";}', 7, 'en vente', '2020-04-26'),
(25, 'Boucles d\'oreille coquillages', 'a:2:{i:0;s:13:\"Ea5Hlfn5.jpeg\";i:1;s:13:\"DTaSCggt.jpeg\";}', 'Pour entendre la mer', 'Le terme générique de mer1,2 recouvre plusieurs réalités et peut désigner une grande étendue d’eau salée différente des océans3, l\'ensemble des espaces d\'eau salée en communication libre et naturelle sur toute l\'étendue du globe ou encore une grande étendue sombre à la surface de la Lune.', 'vip', 0, 0, 'a:1:{i:0;s:11:\"proposition\";}', 7, 'en vente', '0000-00-00'),
(26, 'Pendentif en perle pour les oreilles', 'a:3:{i:0;s:13:\"6tJZMbxe.jpeg\";i:1;s:13:\"355mqvoi.jpeg\";i:2;s:13:\"eByzlhUd.jpeg\";}', 'De la marque Hermès collection 2006', 'Une boucle d\'oreille est un article de bijouterie qui est porté à l\'oreille. Elle peut être fixée à l\'aide d\'un clou d\'oreille ou d\'une pince. Elles sont portées à travers le monde par les représentants des deux sexes, mais majoritairement par les femmes. Les bijoux sont fixés à l\'oreille grâce à une perforation le plus souvent effectuée dans le lobe d\'oreille. Certaines boucles d\'oreille peuvent cependant se fixer sans perforation, grâce à un mécanisme à pince.\r\n\r\nLa boucle d\'oreille peut être composée de nombreux matériaux, du métal au bois en passant par le plastique ou le verre, certaines peuvent être agrémentées de pierres précieuses ou de perles. Elles peuvent être de taille et de style très différents, au gré de la volonté du bijoutier. La seule limite à la mode réside dans la résistance mécanique du lobe, qui pourrait se déchirer en cas de poids trop important ; les personnes qui portent habituellement les boucles d\'oreille lourdes peuvent d\'ailleurs constater un élargissement de leur lobe. De tous les types de bijoux, les boucles d\'oreille sont actuellement les bijoux les plus portés par les femmes1.', 'vip', 200, 100, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:7:\"enchere\";}', 7, 'en vente', '2020-04-19'),
(27, 'Peinture d\'un démon de l\'an 1450', 'a:2:{i:0;s:13:\"6RWDv9aw.jpeg\";i:1;s:13:\"B9ATIIp4.jpeg\";}', 'La peinture, pas le démon', 'Platon en parle dans La République et dans Le Banquet. Dans ce dernier Diotime propose une définition: Un être intermédiaire entre le dieu et les hommes. Un exemple est, selon Diotime, Eros qui serait enfant d\'une mère humaine, la pauvreté, et un dieux, Poros.1.\r\nPour Socrate, le démon (δαιμόνιον) est une voix qui le guide, le conseille et l\'inspire (le retenant par exemple lorsqu\'il s\'apprêtait à se mettre en danger ou à commettre une erreur).\r\nLe démon de Laplace, une expérience de pensée proposée par Pierre-Simon de Laplace afin d\'illustrer sa conception du déterminisme[Lequel ?].\r\nLe démon de Maxwell, une expérience de pensée inventée par James Clerk Maxwell concernant le deuxième principe de la thermodynamique.\r\nArt et culture', 'musée', 80, 0, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:11:\"proposition\";}', 7, 'en vente', '0000-00-00'),
(28, 'Sac à main Prada', 'a:1:{i:0;s:13:\"1QY8ypl5.jpeg\";}', 'Prada Prada Prada Prada Prada ', 'Personne responsable de l’accès aux documents administratifs dans la législation française, fonction définie aux articles L330-1 et suivants du Code des relations entre le public et l’administration, chargée de faire la liaison entre son organisme de rattachement, le public et la Commission d\'accès aux documents administratifs', 'vip', 120, 0, 'a:1:{i:0;s:14:\"achat_immediat\";}', 7, 'en vente', '0000-00-00'),
(33, 'Visage d\'une Princesse du Sahara', 'a:3:{i:0;s:13:\"jRYC7eks.jpeg\";i:1;s:13:\"INU6Pkp4.jpeg\";i:2;s:13:\"jEtOSuVb.jpeg\";}', 'Découvrez une beauté millénaire issue des tréfonds de l\'Afrique saharienne', 'Bien que certains archéologues pensent qu\'il s\'agit de la princesse Tokou, l\'identité de ce visage reste un réel mystère. De quoi ajouter du charme aux traits fins de ce chef d\'oeuvre.\r\nMoulée dans l\'argile et détaillée par les plus grands artistes de son temps, cette trouvaille saura briller dans un mobilier simple et neutre, voire minimaliste.', 'musée', 0, 500, 'a:1:{i:0;s:7:\"enchere\";}', 7, 'en vente', '2020-04-20'),
(34, 'Le soin de Cupidon', 'a:1:{i:0;s:13:\"PBLqE1qV.jpeg\";}', 'Peinture, huile sur toile 4m x 4m de Georgio Delavega, 1755', 'Laissez vous touché par la fragilité d\'Eros, à l\'aube de sa déchéance. Il reçoit des soins par les mains de Luciane, nom stratégique proposé par l\'auteur pour définir le caractère androgyne du personnage. Peut être pour exprimer que l\'Amour n\'a pas de genre.', 'musée', 16000, 0, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:11:\"proposition\";}', 7, 'vendu', '0000-00-00'),
(35, 'Suspension en acier, motifs kaléidoscopiques', 'a:3:{i:0;s:13:\"vme6yhQM.jpeg\";i:1;s:13:\"m4aRurvI.jpeg\";i:2;s:13:\"FDWTmou1.jpeg\";}', 'Design visionnaire de Marc Celdor imaginé en 2015', 'Ajouter une touche mystérieuse et profonde à votre intérieur grâce et cette suspension, qui donnera une dimension psychique à la pièce tout en se mariant à un décor sophistiqué. ', 'ferraille/trésor', 0, 0, 'a:1:{i:0;s:11:\"proposition\";}', 7, 'en vente', '0000-00-00'),
(36, 'Set de poêles de Pez Gonzales', 'a:1:{i:0;s:13:\"W9bN27t8.jpeg\";}', 'Attirail légendaire du célèbre cuistot royal espagnol ', 'Bon pour la collection ou la passion, retracez le passé culinaire du chef Gonzales, et retentez, si vous l\'osez, ces plus grand chef d’œuvres, servi directement à la famille royale du 20e siècle. ', 'ferraille/trésor', 0, 850, 'a:1:{i:0;s:7:\"enchere\";}', 7, 'en vente', '2020-04-20'),
(37, 'Talons aiguille  \"Starfield\" porté par Lady Gaga', 'a:3:{i:0;s:13:\"T4FC5u9e.jpeg\";i:1;s:13:\"rIwBkVPd.jpeg\";i:2;s:13:\"Q52KLuxn.jpeg\";}', 'Collection JIMMY CHOO X Swarovski été 2020', 'Issus du derneir clip \"Stupid Love\" de Gaga, vibrez devant la pureté des spinelles personnellement sélectionnées par CHOO, grand fan de l\'artiste.', 'vip', 0, 22000, 'a:1:{i:0;s:7:\"enchere\";}', 7, 'en vente', '2020-04-22'),
(38, 'Robe Versace Jungle Red', 'a:3:{i:0;s:13:\"f9cMGR8P.jpeg\";i:1;s:13:\"ATmGXsCu.jpeg\";i:2;s:13:\"wkQrkNsN.jpeg\";}', 'Collection printemps - été 2020', 'Encore une trouvaille signée Donatella, vibrez devant ce jeu de couleur et d\'imprimés. Innovation de la maison, ce design est né après que Jennifer Lopez ait littéralement \"Broke the Internet\" lors du dernier déffilé de la Fashion Week de Milan; en arborant le modèle d\'origine, couleur vert-été.', 'vip', 2000, 0, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:11:\"proposition\";}', 7, 'en vente', '0000-00-00'),
(39, 'Réplique en Or massif des crampons de Lionel Messy', 'a:1:{i:0;s:13:\"kCsQWoY5.jpeg\";}', 'Design d\'Arcelor Mittal, 2015', 'En l\'honneur des prouesses du sportif lors de cet année, la célèbre entreprise de sidérurgie (dont le PDG  est un fan incontesté) a déployé son savoir-faire, dans le but d\'immortaliser les fidèles compagnons du footballeur. ', 'ferraille/trésor', 0, 1500, 'a:1:{i:0;s:7:\"enchere\";}', 7, 'en vente', '2020-04-22'),
(40, 'Ballon Final Superbowl', 'a:2:{i:0;s:13:\"pLPw0WJz.jpeg\";i:1;s:13:\"3RvAACYM.jpeg\";}', 'Ballon du Superbowl 2015', 'Mettez la main sur le ballon utilisé lors de l\'emblématique finale de football américain. Pièce d\'exception.', 'ferraille/trésor', 0, 1000, 'a:1:{i:0;s:7:\"enchere\";}', 7, 'en vente', '2020-04-22'),
(41, 'Appareil photo vintage 1940', 'a:1:{i:0;s:13:\"ui7KAJee.jpeg\";}', 'Polaroid d\'exception', 'Fonctionnel, trésor de l\'époque pré-guerre. Fourni avec un kit d\'entretien et une pellicule.', 'ferraille/trésor', 200, 0, 'a:1:{i:0;s:14:\"achat_immediat\";}', 7, 'en vente', '0000-00-00'),
(42, 'Yeezy 350 V2', 'a:1:{i:0;s:13:\"wEDMZAlp.jpeg\";}', 'par Addidas x Kanye West 2018', 'Pointure au choix, Couleur saumon (CLAY), livré avec la paire de chaussette qui va avec.', 'vip', 750, 0, 'a:2:{i:0;s:14:\"achat_immediat\";i:1;s:11:\"proposition\";}', 7, 'en vente', '0000-00-00'),
(43, 'Bottines Hommes Cuir Noir', 'a:1:{i:0;s:13:\"v78QNIBr.jpeg\";}', 'Dock Marteens 2019', 'Taille petit, livré avec un kit d\'entretien.', 'vip', 250, 0, 'a:1:{i:0;s:14:\"achat_immediat\";}', 7, 'en vente', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `item`, `acheteur`, `prix`, `n_proposition`) VALUES
(1, 'enchere', 1, 1, 51, 5),
(2, 'enchere', 1, 2, 52, 0),
(4, 'enchere', 1, 1, 6, 0),
(6, 'enchere', 1, 1, 5253, 0),
(12, 'enchere', 1, 1, 12245, 0),
(11, 'enchere', 1, 7, 6666, 0),
(10, 'proposition', 2, 1, 58, 1),
(13, 'proposition', 10, 8, 12, 1),
(14, 'enchere', 8, 1, 21, 0),
(15, 'enchere', 26, 1, 150, 0),
(16, 'proposition', 27, 1, 60, 1),
(17, 'proposition', 25, 1, 50, 1),
(18, 'enchere', 19, 1, 151, 0),
(19, 'enchere', 37, 8, 22001, 0),
(20, 'enchere', 37, 8, 22002, 0),
(21, 'proposition', 35, 8, 165, 1),
(22, 'proposition', 35, 8, 165, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
