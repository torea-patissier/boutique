-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 30 mars 2021 à 18:26
-- Version du serveur :  5.7.30
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `adresse` (
  `id` int(11) NOT NULL,
  `adresse` text NOT NULL,
  `code_postal` int(20) NOT NULL,
  `ville` text NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `adresse`, `code_postal`, `ville`, `id_client`) VALUES
(32, '5 rue du pasteur Heuzé, 68', 13003, 'Marseille', 7),
(41, '5 rue du pasteur Heuzé', 13003, 'Marseille', 11);

-- --------------------------------------------------------

--
-- Structure de la table `adresse2`
--

CREATE TABLE `adresse2` (
  `id2` int(11) NOT NULL,
  `adresse2` text NOT NULL,
  `code_postal2` int(20) NOT NULL,
  `ville2` text NOT NULL,
  `id_client2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse2`
--

INSERT INTO `adresse2` (`id2`, `adresse2`, `code_postal2`, `ville2`, `id_client2`) VALUES
(15, 'Campo longo 69', 20260, 'Calvi', 11);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(21, 'Kit de croissance'),
(22, 'Soins'),
(23, 'Accessoires');

-- --------------------------------------------------------

--
-- Structure de la table `code_promo`
--

CREATE TABLE `code_promo` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `valeur_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
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

CREATE TABLE `faq_question` (
  `id` int(11) NOT NULL,
  `id_utilisateurQ` int(200) NOT NULL,
  `question` text NOT NULL,
  `dateQ` datetime NOT NULL,
  `id_sous_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq_question`
--

INSERT INTO `faq_question` (`id`, `id_utilisateurQ`, `question`, `dateQ`, `id_sous_categorie`) VALUES
(70, 7, 'Je me suis coupé la jugulaire avec vos ciseaux, c\'est normal? :\'(', '2021-03-29 15:24:11', 34);

-- --------------------------------------------------------

--
-- Structure de la table `faq_reponse`
--

CREATE TABLE `faq_reponse` (
  `id` int(11) NOT NULL,
  `id_utilisateurR` int(11) NOT NULL,
  `reponse` varchar(1000) NOT NULL,
  `dateR` datetime NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq_reponse`
--

INSERT INTO `faq_reponse` (`id`, `id_utilisateurR`, `reponse`, `dateR`, `id_question`) VALUES
(22, 7, 'Désolé..', '2021-03-29 15:24:26', 70);

-- --------------------------------------------------------

--
-- Structure de la table `historique_achat`
--

CREATE TABLE `historique_achat` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `info_client`
--

CREATE TABLE `info_client` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `date_de_naissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL,
  `id_droits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `info_client`
--

INSERT INTO `info_client` (`id`, `login`, `password`, `nom`, `prenom`, `date_de_naissance`, `email`, `tel`, `id_droits`) VALUES
(3, 'Kns', '$2y$12$WpJ3K1.n8IoaCqMVlkNoMO6h6sOFvSq.wxWIqIeq5Q.3d/y/uJGPu', 'Barbosa', 'Nuno', '1995-08-20', 'kns@kns.fr', 623468138, 1),
(4, 'toreapat', '$2y$12$94a1WlJYebse2QfyvWTryersy81nRwfDivXYqBxVg0XdZjB9Qt2h6', 'Ponars', 'Toréa', '1996-01-04', 'p.torea@icloud.com', 681472329, 1),
(6, 'antho', '$2y$12$Snw0kLwru9xtF6sim2H..e6gfVYkwM4uYMpTW6XQa4PH34r2W7P3C', 'Bibi', 'Antho', '1990-02-01', 'bibi@icloud.fr', 618356705, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `description`, `id_categorie`, `id_sous_categorie`, `stock`) VALUES
(41, 'DDD', 80, 'DDD', 21, 31, 90),
(42, 'SSS', 90, 'SSS', 21, 31, 9),
(43, 'PPP', 90, 'PPP', 21, 31, 90),
(44, 'MMM', 90, 'MMM', 21, 31, 90),
(45, 'NNN', 90, 'NNN', 21, 31, 90);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

CREATE TABLE `sous_categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_categories` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `nom`, `id_categories`) VALUES
(31, 'Gelules de croissance', 22),
(32, 'Soins pour la barbe', 22),
(45, 'Kit', 21);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `adresse2`
--
ALTER TABLE `adresse2`
  ADD PRIMARY KEY (`id2`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `code_promo`
--
ALTER TABLE `code_promo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faq_question`
--
ALTER TABLE `faq_question`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faq_reponse`
--
ALTER TABLE `faq_reponse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historique_achat`
--
ALTER TABLE `historique_achat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `info_client`
--
ALTER TABLE `info_client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `adresse2`
--
ALTER TABLE `adresse2`
  MODIFY `id2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `code_promo`
--
ALTER TABLE `code_promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `faq_question`
--
ALTER TABLE `faq_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `faq_reponse`
--
ALTER TABLE `faq_reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `historique_achat`
--
ALTER TABLE `historique_achat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `info_client`
--
ALTER TABLE `info_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
