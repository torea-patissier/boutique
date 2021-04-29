-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 26 avr. 2021 à 12:11
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` text NOT NULL,
  `code_postal` int(20) NOT NULL,
  `ville` text NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `adresse`, `code_postal`, `ville`, `id_client`) VALUES
(18, '5 rue du pasteur Heuzé, 68', 13003, 'Marseille', 7);

-- --------------------------------------------------------

--
-- Structure de la table `adresse2`
--

DROP TABLE IF EXISTS `adresse2`;
CREATE TABLE IF NOT EXISTS `adresse2` (
  `id2` int(11) NOT NULL AUTO_INCREMENT,
  `adresse2` text NOT NULL,
  `code_postal2` int(20) NOT NULL,
  `ville2` text NOT NULL,
  `id_client2` int(11) NOT NULL,
  PRIMARY KEY (`id2`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse2`
--

INSERT INTO `adresse2` (`id2`, `adresse2`, `code_postal2`, `ville2`, `id_client2`) VALUES
(21, 'Campo longo 69', 20260, 'Calvi', 7);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(9, 'Kit'),
(10, 'Soins'),
(11, 'Accessoires');

-- --------------------------------------------------------

--
-- Structure de la table `code_promo`
--

DROP TABLE IF EXISTS `code_promo`;
CREATE TABLE IF NOT EXISTS `code_promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `valeur_code` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'Utilisateur'),
(666, 'Administrateur'),
(1, 'Utilisateur'),
(666, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `faq_question`
--

DROP TABLE IF EXISTS `faq_question`;
CREATE TABLE IF NOT EXISTS `faq_question` (
  `id` int(11) NOT NULL,
  `id_utilisateurQ` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `dateQ` date NOT NULL,
  `id_sous_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `faq_reponse`
--

DROP TABLE IF EXISTS `faq_reponse`;
CREATE TABLE IF NOT EXISTS `faq_reponse` (
  `id` int(11) NOT NULL,
  `id_utilisateurR` int(11) NOT NULL,
  `reponse` int(11) NOT NULL,
  `DateR` date NOT NULL,
  `id_sous_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `historique_achat`
--

DROP TABLE IF EXISTS `historique_achat`;
CREATE TABLE IF NOT EXISTS `historique_achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `info_client`
--

DROP TABLE IF EXISTS `info_client`;
CREATE TABLE IF NOT EXISTS `info_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `date_de_naissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `description`, `id_categorie`, `id_sous_categorie`, `stock`) VALUES
(9, 'Nettoyant pour Rouleau a Barbe', 15, 'Notre nettoyant unique est conÃ§u pour nettoyer efficacement votre Beard Roller. \r\n', 11, 14, 405),
(10, 'Activateur', 39, 'Vilain de nature. Croissance stimulante. Boostez la croissance de la barbe avec des ingrÃ©dients actifs naturels.\r\n', 10, 13, 400),
(11, 'Le kit de croissance de la barbe', 79, 'Le processus unique en 3 Ã©tapes pour booster la croissance de votre barbe.', 9, 19, 402),
(12, 'Le peigne porte-clÃ©s', 12, 'Durable. Indispensable. Pratique comme l\'enfer.', 11, 15, 400),
(13, 'Le rouleau Ã  barbe', 49, 'RÃ©volutionner. Stimulant la croissance. Activation du follicule. Rendez l\'absorption du sÃ©rum activateur aussi efficace que possible tout en stimulant la croissance de votre barbe Ã  son plein potentiel!', 11, 18, 400),
(14, 'Les ciseaux Ã  barbe', 44, 'Avec une technologie de pointe, nous avons crÃ©Ã© des ciseaux Ã  barbe qui coupent chaque pointe de cheveux avec une coupe droite Ã©vitant les pointes fourchues. ', 11, 16, 455),
(15, 'Le Greenkeeper', 27, 'Combattez la peau sÃ¨che, squameuse et irritÃ©e. Le Greenkeeper hydrate et apaise votre peau.', 10, 13, 455),
(16, 'Le hÃ©ros de la barbe', 34, 'Hydratant et nourrissant. Le sÃ©rum Ã  l\\\'huile de barbe qui donne Ã  toute barbe une apparence plus complÃ¨te et plus saine.', 10, 13, 400),
(17, 'Le kit de soin de la barbe', 67, 'Dans le jeu du soin et du coiffage de la barbe - n\'abandonnez pas, engagez-vous! Obtenez la boÃ®te Ã  outils avec tous les produits de soin et de coiffage de la barbe dont vous aurez besoin.', 9, 19, 400),
(18, 'Offzite', 24, 'Combattez efficacement les boutons et les poils incarnÃ©s tout en faisant pousser la barbe.', 10, 13, 400),
(19, 'Le rÃ©gulateur de vitesse', 27, 'Le baume Ã  barbe parfait pour coiffer et redresser votre barbe frisÃ©e et inÃ©gale.', 10, 13, 400),
(20, 'Le sac de vol', 12, 'Apportez tous vos essentiels pour la barbe avec vous, peu importe oÃ¹ vous allez. \r\n', 11, 17, 400),
(21, 'Le SideKick', 33, 'Soutenez la croissance de vos cheveux et de votre barbe de l\'intÃ©rieur avec The SideKick pour votre voyage barbe.\r\n', 10, 13, 400),
(22, 'Le Splash de 8h', 25, 'Un nettoyant pour barbe conÃ§u pour Ã©liminer la saletÃ© et la saletÃ© tout en laissant les huiles naturelles de votre barbe. \r\n', 10, 13, 400);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_categories` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `nom`, `id_categories`) VALUES
(12, 'Gelules', 10),
(13, 'Soins', 10),
(14, 'Nettoyants', 10),
(15, 'Peigne', 11),
(16, 'Ciseaux', 11),
(17, 'Trousse', 11),
(18, 'Rouleau', 11),
(19, 'Kit', 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
