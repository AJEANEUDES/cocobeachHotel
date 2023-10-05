-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour cocobeachdb
CREATE DATABASE IF NOT EXISTS `cocobeachdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cocobeachdb`;

-- Listage de la structure de la table cocobeachdb. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_categorie` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modifier` datetime NOT NULL,
  `status_categorie` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_497DD634FB88E14F` (`utilisateur_id`),
  CONSTRAINT `FK_497DD634FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.categorie : ~2 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id`, `utilisateur_id`, `libelle`, `delete_categorie`, `date_creation`, `date_modifier`, `status_categorie`) VALUES
	(6, 1, 'Simple', 0, '2021-12-28 16:51:06', '2021-12-28 16:51:06', 1),
	(7, 1, 'Double', 0, '2021-12-28 16:51:15', '2021-12-28 16:51:15', 1),
	(8, 1, 'Duplexhfhg', 0, '2022-01-10 12:41:47', '2022-01-10 12:41:56', 1);
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. chambre
CREATE TABLE IF NOT EXISTS `chambre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_chambre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule_chambre` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_chambre` tinyint(1) NOT NULL,
  `etat_chambre` tinyint(1) NOT NULL,
  `delete_chambre` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modifier` datetime NOT NULL,
  `prix_chambre` int(11) NOT NULL,
  `chambre_categorie_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `description_chambre` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_chambre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C509E4FF7508CAD5` (`chambre_categorie_id`),
  KEY `IDX_C509E4FFFB88E14F` (`utilisateur_id`),
  CONSTRAINT `FK_C509E4FF7508CAD5` FOREIGN KEY (`chambre_categorie_id`) REFERENCES `categorie` (`id`),
  CONSTRAINT `FK_C509E4FFFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.chambre : ~10 rows (environ)
/*!40000 ALTER TABLE `chambre` DISABLE KEYS */;
INSERT INTO `chambre` (`id`, `libelle_chambre`, `matricule_chambre`, `status_chambre`, `etat_chambre`, `delete_chambre`, `date_creation`, `date_modifier`, `prix_chambre`, `chambre_categorie_id`, `utilisateur_id`, `description_chambre`, `image_chambre`, `image1`, `image2`, `image3`, `image4`) VALUES
	(7, 'Chambre Simple', '02', 1, 0, 0, '2021-12-28 17:25:44', '2021-12-28 17:29:03', 32000, 6, 1, 'Chambre simple au niveau du rez chaussee', '', NULL, NULL, NULL, NULL),
	(8, 'Chambre Simple', '03', 1, 0, 0, '2021-12-28 17:27:17', '2021-12-28 17:27:17', 32000, 6, 1, 'Chambre simple au niveau du rez de chaussée', '', NULL, NULL, NULL, NULL),
	(9, 'Chambre Simple', '04', 1, 0, 0, '2021-12-28 17:32:51', '2021-12-28 17:32:51', 32000, 6, 1, 'Chambre simple au niveau du rez de chaussee', '', NULL, NULL, NULL, NULL),
	(10, 'Chambre Simple', '11', 1, 0, 0, '2021-12-28 17:55:35', '2021-12-28 17:55:35', 42000, 6, 1, 'Chambre simple au niveau du 1 er etage - vue jardins', '', NULL, NULL, NULL, NULL),
	(11, 'Chambre Simple', '13', 1, 0, 0, '2021-12-28 17:57:33', '2021-12-28 17:57:33', 40000, 6, 1, 'Chambre simple  au niveau du 1 er etage - vue jardins', '', NULL, NULL, NULL, NULL),
	(12, 'Chambre Simple', '15', 1, 0, 0, '2021-12-28 18:00:06', '2022-01-06 13:17:52', 40000, 6, 1, 'Chambre simple au niveau du 1 er etage - vue jardins', 'e756abe935e18755d3f2964f52946f13.jpeg', 'f64a9df1a0e45ce7961d75db927d2f54.jpeg', 'ba562f3378a7646216c29b2fe461678a.jpeg', 'd11271fe0d733cd701a4998802919ace.jpeg', 'e756abe935e18755d3f2964f52946f13.jpeg'),
	(13, 'Chambre Simple', '12', 1, 0, 0, '2021-12-28 18:03:42', '2022-01-06 13:18:47', 42000, 6, 1, 'Chambre simple au niveau 1 er etage - vue mer', '98295925692a0716497db2186b4ba544.jpeg', 'bc88348df7aa14b50ec4abdd9314df0d.jpeg', NULL, NULL, NULL),
	(14, 'Chambre Simple', '14', 1, 0, 0, '2021-12-28 18:05:18', '2022-01-04 16:28:52', 42000, 6, 1, 'Chambre simple au niveau du 1 er etage - vue sur mer', 'e3489ce32c56a7686ba22c5147b0b354.jpeg', NULL, NULL, NULL, NULL),
	(15, 'Chambre Simple', '26', 1, 0, 0, '2021-12-29 14:36:56', '2022-01-10 09:57:05', 52000, 6, 1, 'Chambre Simple ', 'cf4f2d5f197d2949b8f9c956a7ff8832.jpeg', NULL, NULL, NULL, NULL),
	(16, 'Chambre Simple ', '35', 1, 0, 1, '2021-12-29 14:43:21', '2022-01-06 21:39:08', 65000, 7, 1, 'Lorem ipsum dolor Globally revolutionize compelling information after ubiquitous methodologies. Appropriately build resource-leveling initiatives after error-free web-readiness. Competently implement open-source vortals rather than functionalized synergy. ', 'f25c6fcfc4a9511683d1e7cfc9da0668.jpeg', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `chambre` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. client
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_client` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_client` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_client` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_client` tinyint(1) NOT NULL,
  `delete_client` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modifier` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.client : ~4 rows (environ)
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`id`, `nom_client`, `prenom_client`, `telephone_client`, `email_client`, `status_client`, `delete_client`, `date_creation`, `date_modifier`) VALUES
	(6, 'Kothor', 'Claude', '22893075913', 'ckothor7@gmail.com', 1, 0, '2021-12-29 11:48:46', '2021-12-29 11:48:46'),
	(7, 'Fondey', 'Omar', '22894725241', 'omarf@gmail.com', 1, 0, '2021-12-29 12:46:00', '2021-12-29 12:46:00'),
	(8, 'Kothor', 'Claude', '93075913', 'ckothor7@gmail.com', 1, 1, '2022-01-05 15:06:15', '2022-01-05 15:06:15'),
	(16, 'Abdoulaye', 'Razak', '22866398998', '', 1, 0, '2022-01-07 09:38:48', '2022-01-07 09:38:48'),
	(17, 'Koglo', 'Jacques', '22898688739', 'jacqueskoglo@gmail.com', 1, 0, '2022-01-10 12:38:31', '2022-01-10 12:38:31');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. contact
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_contact` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `delete_message` tinyint(1) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.contact : ~3 rows (environ)
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` (`id`, `nom_contact`, `email_contact`, `message_contact`, `date_creation`, `delete_message`, `is_read`) VALUES
	(1, 'Omar Fondey', 'omarf@gmail.com', 'Assertively revolutionize vertical strategic theme areas with frictionless web-readiness. Dynamically maximize client-centered users without multimedia based technology. Competently seize effective action items before enabled intellectual capital.', '2021-12-29 09:05:44', 0, 1),
	(2, 'Sossou koffi', 'sossou@gmail.com', 'Authoritatively parallel task multidisciplinary e-services and distributed infrastructures. Phosfluorescently e-enable market-driven leadership skills through vertical web services. Objectively mesh tactical schemas and dynamic infomediaries. ', '2021-12-29 10:48:23', 0, 1),
	(3, 'Claude Kothor', 'ckothor7@gmail.com', 'Bonjour hotel coco beach', '2021-12-29 10:59:05', 0, 1),
	(4, 'Sidike Sokoto', 'sidike@gmail.com', 'Seamlessly benchmark superior functionalities via professional innovation. Competently deploy pandemic manufactured products before plug-and-play leadership. Seamlessly benchmark superior functionalities via professional innovation. Competently deploy pandemic manufactured products before plug-and-play leadership.', '2022-01-10 10:17:23', 0, 1);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table cocobeachdb.doctrine_migration_versions : ~42 rows (environ)
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20211220213134', '2021-12-20 21:32:01', 482),
	('DoctrineMigrations\\Version20211221205109', '2021-12-21 20:51:19', 1973),
	('DoctrineMigrations\\Version20211222022938', '2021-12-22 02:29:42', 394),
	('DoctrineMigrations\\Version20211222134232', '2021-12-22 13:42:37', 1702),
	('DoctrineMigrations\\Version20211222135722', '2021-12-22 13:57:32', 815),
	('DoctrineMigrations\\Version20211222213531', '2021-12-22 21:35:36', 593),
	('DoctrineMigrations\\Version20211222213719', '2021-12-22 21:37:23', 329),
	('DoctrineMigrations\\Version20211222222750', '2021-12-22 22:27:54', 351),
	('DoctrineMigrations\\Version20211222225709', '2021-12-22 22:57:14', 1742),
	('DoctrineMigrations\\Version20211222230652', '2021-12-22 23:06:55', 180),
	('DoctrineMigrations\\Version20211223005522', '2021-12-23 00:55:26', 216),
	('DoctrineMigrations\\Version20211223111418', '2021-12-23 11:14:26', 2536),
	('DoctrineMigrations\\Version20211223130301', '2021-12-23 13:03:07', 948),
	('DoctrineMigrations\\Version20211223131304', '2021-12-23 13:13:08', 157),
	('DoctrineMigrations\\Version20211223140233', '2021-12-23 14:04:46', 344),
	('DoctrineMigrations\\Version20211223141211', '2021-12-23 14:12:14', 113),
	('DoctrineMigrations\\Version20211223162348', '2021-12-23 16:23:51', 209),
	('DoctrineMigrations\\Version20211223170213', '2021-12-23 17:02:17', 183),
	('DoctrineMigrations\\Version20211224142339', '2021-12-24 14:23:46', 543),
	('DoctrineMigrations\\Version20211225235412', '2021-12-25 23:54:18', 1098),
	('DoctrineMigrations\\Version20211227104301', '2021-12-27 10:43:07', 570),
	('DoctrineMigrations\\Version20211227104451', '2021-12-27 10:44:57', 199),
	('DoctrineMigrations\\Version20211227162320', '2021-12-27 16:23:25', 888),
	('DoctrineMigrations\\Version20211227163619', '2021-12-27 16:36:26', 1164),
	('DoctrineMigrations\\Version20211227172629', '2021-12-27 17:26:34', 1085),
	('DoctrineMigrations\\Version20211227174104', '2021-12-27 17:41:10', 1325),
	('DoctrineMigrations\\Version20211227230227', '2021-12-27 23:02:32', 356),
	('DoctrineMigrations\\Version20211228170443', '2021-12-28 17:04:49', 1059),
	('DoctrineMigrations\\Version20211228190029', '2021-12-28 19:00:35', 1259),
	('DoctrineMigrations\\Version20211228193831', '2021-12-28 19:38:38', 344),
	('DoctrineMigrations\\Version20211228232642', '2021-12-28 23:26:53', 690),
	('DoctrineMigrations\\Version20211229084831', '2021-12-29 08:48:42', 1636),
	('DoctrineMigrations\\Version20211229112321', '2021-12-29 11:23:31', 786),
	('DoctrineMigrations\\Version20211229115217', '2021-12-29 11:52:22', 458),
	('DoctrineMigrations\\Version20211229143530', '2021-12-29 14:35:37', 932),
	('DoctrineMigrations\\Version20220105143128', '2022-01-05 14:31:36', 1557),
	('DoctrineMigrations\\Version20220105170155', '2022-01-05 17:01:59', 712),
	('DoctrineMigrations\\Version20220105173159', '2022-01-05 17:32:03', 227),
	('DoctrineMigrations\\Version20220105175729', '2022-01-05 17:57:35', 1265),
	('DoctrineMigrations\\Version20220106123054', '2022-01-06 12:31:00', 1688),
	('DoctrineMigrations\\Version20220106231939', '2022-01-06 23:19:45', 1920),
	('DoctrineMigrations\\Version20220106234809', '2022-01-06 23:48:17', 1334),
	('DoctrineMigrations\\Version20220122113045', '2022-01-22 11:30:57', 2342),
	('DoctrineMigrations\\Version20220122113751', '2022-01-22 11:37:59', 401);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. evenement
CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_event` tinyint(1) NOT NULL,
  `date_event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_event` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modifier` datetime NOT NULL,
  `titre_event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_event` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.evenement : ~2 rows (environ)
/*!40000 ALTER TABLE `evenement` DISABLE KEYS */;
INSERT INTO `evenement` (`id`, `image`, `status_event`, `date_event`, `delete_event`, `date_creation`, `date_modifier`, `titre_event`, `description_event`) VALUES
	(1, '5606f69e103921d657bb33db669c3101.jpeg', 1, '2022-01-16', 0, '2022-01-22 12:12:24', '2022-01-22 12:12:24', 'Sporting event', 'Evenement de sport (footing) avec un coach professionnel'),
	(2, '98b03a409340bb78c00b1499c862572d.jpeg', 1, '2022-01-09', 0, '2022-01-22 12:37:13', '2022-01-22 12:37:13', 'Soirée dégustation liqueur et gin', 'Soirée dégustation liqueur et gin');
/*!40000 ALTER TABLE `evenement` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_menu` tinyint(1) NOT NULL,
  `delete_menu` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.menu : ~2 rows (environ)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `nom_menu`, `status_menu`, `delete_menu`, `date_creation`) VALUES
	(1, 'Liqueurs', 1, 0, '2022-01-05 17:36:29'),
	(2, 'Fruit de mer', 1, 0, '2022-01-05 17:37:03'),
	(3, 'Poisson de mer', 1, 0, '2022-01-05 22:21:10');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. notification
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `count_send` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.notification : ~3 rows (environ)
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` (`id`, `message`, `date_creation`, `is_read`, `count_send`) VALUES
	(1, 'testNotification message reservation', '2021-12-27 10:30:41', 1, 1),
	(2, 'La reservation de la chambre Chambre Simple est terminée', '2022-01-07 11:31:32', 0, 1),
	(3, 'La reservation de la chambre Chambre Simple est terminée', '2022-01-07 11:34:30', 0, 1);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. online
CREATE TABLE IF NOT EXISTS `online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_arrivee` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_depart` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree_reservation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_reservation` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `etat_reservation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_reservation` tinyint(1) NOT NULL,
  `new_date_ajuster` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_date_depart` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_duree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duree_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_modifier` datetime DEFAULT NULL,
  `nombre_chambre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_adulte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_enfant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.online : ~3 rows (environ)
/*!40000 ALTER TABLE `online` DISABLE KEYS */;
INSERT INTO `online` (`id`, `date_arrivee`, `date_depart`, `duree_reservation`, `delete_reservation`, `date_creation`, `etat_reservation`, `status_reservation`, `new_date_ajuster`, `new_date_depart`, `new_duree`, `duree_total`, `date_modifier`, `nombre_chambre`, `nombre_adulte`, `nombre_enfant`) VALUES
	(1, '06/01/2022', '08/01/2022', '2', 0, '2022-01-06 23:50:34', '0', 1, NULL, NULL, NULL, NULL, '2022-01-07 10:14:53', '1', 'Simple', '0'),
	(2, '07/01/2022', '08/01/2022', '1', 0, '2022-01-07 09:38:48', '0', 1, NULL, NULL, NULL, NULL, '2022-01-10 10:00:52', '1', 'Simple', NULL),
	(3, '10/01/2022', '10/01/2022', '0', 0, '2022-01-10 12:38:31', '0', 1, NULL, NULL, NULL, NULL, '2022-01-10 12:41:05', '1', 'Simple', NULL);
/*!40000 ALTER TABLE `online` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chambre_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date_arrivee` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_depart` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree_reservation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_reservation` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `etat_reservation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `status_reservation` tinyint(1) NOT NULL,
  `new_date_ajuster` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_date_depart` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_duree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duree_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_modifier` datetime DEFAULT NULL,
  `code_reservation` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `nombre_chambre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_adulte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_enfant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `online_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C849559B177F54` (`chambre_id`),
  KEY `IDX_42C8495519EB6921` (`client_id`),
  KEY `IDX_42C84955FB88E14F` (`utilisateur_id`),
  KEY `IDX_42C84955ED5CA9E6` (`service_id`),
  KEY `IDX_42C8495570A5426E` (`online_id`),
  CONSTRAINT `FK_42C8495519EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  CONSTRAINT `FK_42C8495570A5426E` FOREIGN KEY (`online_id`) REFERENCES `online` (`id`),
  CONSTRAINT `FK_42C849559B177F54` FOREIGN KEY (`chambre_id`) REFERENCES `chambre` (`id`),
  CONSTRAINT `FK_42C84955ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`),
  CONSTRAINT `FK_42C84955FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.reservation : ~0 rows (environ)
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` (`id`, `chambre_id`, `client_id`, `date_arrivee`, `date_depart`, `duree_reservation`, `delete_reservation`, `date_creation`, `etat_reservation`, `utilisateur_id`, `status_reservation`, `new_date_ajuster`, `new_date_depart`, `new_duree`, `duree_total`, `date_modifier`, `code_reservation`, `service_id`, `nombre_chambre`, `nombre_adulte`, `nombre_enfant`, `online_id`) VALUES
	(1, 9, 6, '05/01/2022', '09/01/2022', '4', 0, '2022-01-05 14:44:49', '4', 1, 1, '06/01/2022', '10/01/2022', '3', '7', '2022-01-07 10:21:01', '860125468', NULL, '0', '0', '0', NULL);
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. restaurant
CREATE TABLE IF NOT EXISTS `restaurant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_plat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_plat` tinyint(1) NOT NULL,
  `delete_plat` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `prix_plat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menus_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EB95123F14041B84` (`menus_id`),
  CONSTRAINT `FK_EB95123F14041B84` FOREIGN KEY (`menus_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.restaurant : ~17 rows (environ)
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` (`id`, `nom_plat`, `status_plat`, `delete_plat`, `date_creation`, `prix_plat`, `menus_id`) VALUES
	(1, 'Rhum Saint James', 1, 0, '2022-01-05 18:20:14', '1600', 1),
	(2, 'J & B', 1, 0, '2022-01-05 18:43:21', '1800', 1),
	(3, 'Red Label', 1, 0, '2022-01-05 18:43:43', '1800', 1),
	(4, 'Black Label', 1, 0, '2022-01-05 18:44:01', '2700', 1),
	(5, 'Suze', 1, 0, '2022-01-05 18:44:22', '1800', 1),
	(6, 'Martini B.R', 1, 0, '2022-01-05 18:46:50', '1800', 1),
	(7, 'Cognac', 1, 0, '2022-01-05 18:47:08', '2700', 1),
	(8, 'Armagnac', 1, 0, '2022-01-05 18:47:24', '2700', 1),
	(9, 'Grand Marnier', 1, 0, '2022-01-05 18:47:46', '2700', 1),
	(10, 'Get 27', 1, 0, '2022-01-05 18:48:04', '2700', 1),
	(11, 'Langouste 500g', 1, 0, '2022-01-05 18:49:05', '12000', 2),
	(12, 'Gambas 500g', 1, 0, '2022-01-05 18:49:33', '13000', 2),
	(13, 'Crevette de mer', 1, 0, '2022-01-05 18:50:06', '5800', 2),
	(14, 'Calamar', 1, 0, '2022-01-05 18:50:25', '5000', 2),
	(15, 'Carpes', 1, 0, '2022-01-05 22:21:33', '6200', 3),
	(16, 'Daurades', 1, 0, '2022-01-05 22:21:52', '6200', 3),
	(17, 'Soles', 1, 0, '2022-01-05 22:22:10', '6200', 3),
	(18, 'Bars', 1, 0, '2022-01-05 22:22:24', '6200', 3);
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. service
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_service` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `delete_service` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E19D9AD2B83297E7` (`reservation_id`),
  CONSTRAINT `FK_E19D9AD2B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.service : ~0 rows (environ)
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` (`id`, `libelle_service`, `prix_service`, `date_creation`, `date_service`, `reservation_id`, `delete_service`) VALUES
	(1, 'Achat de credit de communication', 2000, '2022-01-06 23:42:57', '2022-01-06', 1, 0),
	(2, 'Achat de djama pilsner', 500, '2022-01-10 10:01:39', '2022-01-10', 1, 0);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. temoignage
CREATE TABLE IF NOT EXISTS `temoignage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `delete_temoig` tinyint(1) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.temoignage : ~2 rows (environ)
/*!40000 ALTER TABLE `temoignage` DISABLE KEYS */;
INSERT INTO `temoignage` (`id`, `client`, `note`, `date_creation`, `status`, `delete_temoig`, `message`) VALUES
	(1, 'Kothor Claude', '4', '2021-12-29 11:52:38', 1, 0, 'Compellingly simplify backward-compatible data after front-end vortals. Holisticly visualize ubiquitous services and real-time processes. Monotonectally evolve market-driven e-tailers rather than team driven vortals. Completely pursue sustainable architectures vis-a-vis competitive leadership. '),
	(2, 'Zontodji Cornelus', '5', '2021-12-29 12:46:23', 1, 0, 'Seamlessly restore interactive "outside the box" thinking rather than client-focused information. Globally redefine clicks-and-mortar interfaces through wireless systems. Completely engineer e-business schemas rather than user friendly ROI. '),
	(3, 'Abdoulaye Razak', '1', '2022-01-10 10:05:06', 1, 1, 'hjfhfjhgkj');
/*!40000 ALTER TABLE `temoignage` ENABLE KEYS */;

-- Listage de la structure de la table cocobeachdb. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `nom_utilisateur` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_utilisateur` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe_utilisateur` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_utilisateur` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_utilisateur` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_utilisateur` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_utilisateur` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_utilisateur` tinyint(1) NOT NULL,
  `delete_utilisateur` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modifier` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1D1C63B3FB88E14F` (`utilisateur_id`),
  CONSTRAINT `FK_1D1C63B3FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table cocobeachdb.utilisateur : ~4 rows (environ)
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`id`, `utilisateur_id`, `nom_utilisateur`, `prenom_utilisateur`, `sexe_utilisateur`, `email_utilisateur`, `adresse_utilisateur`, `telephone_utilisateur`, `password`, `level_utilisateur`, `status_utilisateur`, `delete_utilisateur`, `date_creation`, `date_modifier`) VALUES
	(1, NULL, 'Kothor', 'Axel', 'M', 'axel@gmail.com', 'Agoe Kleve', '22896548299', '$argon2id$v=19$m=65536,t=4,p=1$YzNQcnQuZUlxaHlkb3cxRg$RFqgPIMcy4fIb4Xd0XchdIWwWruMQ+6fhv6CnikuMYI', 'R02', 1, 0, '2021-12-21 00:09:43', '2021-12-21 00:09:44'),
	(2, NULL, 'Zontodji', 'Cornelus', 'F', 'cornelus@gmail.com', 'Leo 2000', '22896745217', '$argon2id$v=19$m=65536,t=4,p=1$YzNQcnQuZUlxaHlkb3cxRg$RFqgPIMcy4fIb4Xd0XchdIWwWruMQ+6fhv6CnikuMYI', 'G03', 1, 0, '2021-12-21 09:43:55', '2021-12-23 00:06:37'),
	(3, NULL, 'Fondeh', 'Totorino', 'M', 'totorino@gmail.com', 'Agoe Assiyeye', '22898527410', '$argon2id$v=19$m=65536,t=4,p=1$dlRxMi9VWDhVSVg0ZktzMQ$acfOQgfIjFk/HjAzWjPrLspqVIhq61oy1wrDmX5Vz54', 'G03', 1, 0, '2021-12-21 11:24:29', '2021-12-21 16:22:25'),
	(4, NULL, 'Bagou', 'Gracia', 'F', 'gracia@gmail.com', 'Adidogome', '22891526341', '$argon2id$v=19$m=65536,t=4,p=1$YzNQcnQuZUlxaHlkb3cxRg$RFqgPIMcy4fIb4Xd0XchdIWwWruMQ+6fhv6CnikuMYI', 'A01', 1, 0, '2021-12-21 11:53:10', '2021-12-22 18:10:31'),
	(5, 1, 'Sossou', 'Koffiaghrhr', 'M', 'sossou@gmail.com', 'Tabligbo', '22896417263', '$argon2id$v=19$m=65536,t=4,p=1$WkM1S0JjbHZjbTZyR3N4Qw$UiqCDXileHiXn+vg6LitX3TmDKM/SCpzGPz+OWBJB4M', 'A01', 1, 0, '2021-12-21 15:18:54', '2021-12-27 11:52:15');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
