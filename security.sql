-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Vært: 127.0.0.1
-- Genereringstid: 24. 03 2015 kl. 08:20:00
-- Serverversion: 5.6.17
-- PHP-version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `security`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(510) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `picture_comments`
--

DROP TABLE IF EXISTS `picture_comments`;
CREATE TABLE IF NOT EXISTS `picture_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `picture_id` int(11) NOT NULL,
  `commentor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `picture_id` (`picture_id`),
  KEY `commentor_id` (`commentor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `picture_shared`
--

DROP TABLE IF EXISTS `picture_shared`;
CREATE TABLE IF NOT EXISTS `picture_shared` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  `shared_with_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `picture_id` (`picture_id`),
  KEY `shared_with_id` (`shared_with_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`);

--
-- Begrænsninger for tabel `picture_comments`
--
ALTER TABLE `picture_comments`
  ADD CONSTRAINT `picture_comments_ibfk_2` FOREIGN KEY (`commentor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `picture_comments_ibfk_1` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`id`);

--
-- Begrænsninger for tabel `picture_shared`
--
ALTER TABLE `picture_shared`
  ADD CONSTRAINT `picture_shared_ibfk_2` FOREIGN KEY (`shared_with_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `picture_shared_ibfk_1` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
