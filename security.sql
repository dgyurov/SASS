-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Vært: 127.0.0.1
-- Genereringstid: 16. 03 2015 kl. 23:16:19
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

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(510) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Data dump for tabellen `pictures`
--

INSERT INTO `pictures` (`id`, `picture`, `owner_id`) VALUES
(1, 'GwyBzG3.jpg', 101),
(2, 'a9LYOg0_700b.jpg', 102),
(3, 'background.jpg ', 101),
(4, '1426537159GwyBzG3.jpg', 101),
(6, '1426542421background.jpg', 102);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `picture_comments`
--

CREATE TABLE IF NOT EXISTS `picture_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `picture_id` int(11) NOT NULL,
  `commentor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `picture_id` (`picture_id`),
  KEY `commentor_id` (`commentor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Data dump for tabellen `picture_comments`
--

INSERT INTO `picture_comments` (`id`, `text`, `created`, `picture_id`, `commentor_id`) VALUES
(1, 'So this is how its done!!!', '2015-03-15 12:28:23', 1, 101),
(2, 'Alright', '2015-03-15 15:24:18', 2, 101);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `picture_shared`
--

CREATE TABLE IF NOT EXISTS `picture_shared` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  `shared_with_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `picture_id` (`picture_id`),
  KEY `shared_with_id` (`shared_with_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Data dump for tabellen `picture_shared`
--

INSERT INTO `picture_shared` (`id`, `picture_id`, `shared_with_id`) VALUES
(1, 1, 102),
(2, 2, 101);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(101, 'dvid@itu.dk', '1234'),
(102, 'dimi@itu.dk', '1234'),
(103, 'mares@itu.dk', '1234');

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
