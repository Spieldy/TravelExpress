-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 01 Avril 2015 à 16:43
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `travel_express`
--

-- --------------------------------------------------------

--
-- Structure de la table `booked`
--

CREATE TABLE IF NOT EXISTS `booked` (
`id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `lift_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `booked_passenger`
--

CREATE TABLE IF NOT EXISTS `booked_passenger` (
`id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `booked_id` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `voted` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lift`
--

CREATE TABLE IF NOT EXISTS `lift` (
`id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `fromCity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `toCity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateLift` datetime NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `seats` int(11) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL,
  `frequency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `positive` int(11) NOT NULL,
  `negative` int(11) NOT NULL,
  `cellphone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `positive`, `negative`, `cellphone`, `comment`) VALUES
(1, 'admin', 'admin', 'admin@email.com', 'admin@email.com', 1, '6ml21odeanswk0wkw0cosw4cwgoc8k0', 'bkeJa/qQ2/Mvik95L/L4GQCcN7+dJyOBT7++ihP1gSIaQXKClcheHqEqCrWOjkTnX9Ufjy3kzanUr/2LKEyrMg==', '2015-04-01 14:01:55', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, 0, 0, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `booked`
--
ALTER TABLE `booked`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_9A0E1659C3423909` (`driver_id`), ADD KEY `IDX_9A0E165995AE0E79` (`lift_id`);

--
-- Index pour la table `booked_passenger`
--
ALTER TABLE `booked_passenger`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_B29AE4F94502E565` (`passenger_id`), ADD KEY `IDX_B29AE4F9FE0C4845` (`booked_id`);

--
-- Index pour la table `lift`
--
ALTER TABLE `lift`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_737D1E0CC3423909` (`driver_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`), ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `booked`
--
ALTER TABLE `booked`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `booked_passenger`
--
ALTER TABLE `booked_passenger`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `lift`
--
ALTER TABLE `lift`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `booked`
--
ALTER TABLE `booked`
ADD CONSTRAINT `FK_9A0E165995AE0E79` FOREIGN KEY (`lift_id`) REFERENCES `lift` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_9A0E1659C3423909` FOREIGN KEY (`driver_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `booked_passenger`
--
ALTER TABLE `booked_passenger`
ADD CONSTRAINT `FK_B29AE4F94502E565` FOREIGN KEY (`passenger_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FK_B29AE4F9FE0C4845` FOREIGN KEY (`booked_id`) REFERENCES `booked` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lift`
--
ALTER TABLE `lift`
ADD CONSTRAINT `FK_737D1E0CC3423909` FOREIGN KEY (`driver_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
