-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Vært: 127.0.0.1
-- Genereringstid: 18. 03 2015 kl. 22:24:00
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Data dump for tabellen `pictures`
--

INSERT INTO `pictures` (`id`, `picture`, `owner_id`) VALUES
(10, '7341702943904b1fa69808b8f1dd5c14screenshot.jpg', 105),
(11, 'b04520c9bbf4023b224b955b600aa5e5Class diagram jUnit.jpg', 106),
(12, '09664b212cd7a1b8dc4c93ac76940491Question 3.png', 105),
(13, '4e7ac1aed0c89c028d0698a447c17105chart (9).png', 106);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Data dump for tabellen `picture_comments`
--

INSERT INTO `picture_comments` (`id`, `text`, `created`, `picture_id`, `commentor_id`) VALUES
(1, 'This is awesome!', '2015-03-18 00:00:00', 10, 105),
(2, 'Sure, not bad!', '2015-03-18 01:00:00', 10, 106),
(6, 'test', '2015-03-18 22:11:10', 10, 105),
(7, 'My first comment...', '2015-03-18 22:11:23', 12, 105),
(8, 'See how fare this can get when we write a long text...', '2015-03-18 22:18:15', 10, 105),
(9, 'Some more stuff', '2015-03-18 22:19:03', 10, 105),
(10, 'First comment', '2015-03-18 22:19:19', 12, 105),
(11, 'Comment', '2015-03-18 22:20:53', 11, 105),
(12, 'Thanks', '2015-03-18 22:21:31', 11, 106),
(13, 'I like your picture', '2015-03-18 22:21:44', 10, 106);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Data dump for tabellen `picture_shared`
--

INSERT INTO `picture_shared` (`id`, `picture_id`, `shared_with_id`) VALUES
(7, 11, 105),
(8, 10, 106),
(13, 12, 107),
(14, 13, 105);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(105, 'dvid@itu.dk', '$2y$11$wNRNQeGj.p81l4rl2wlaDuH5MLtSwfc8QKcT0VfvbxsT3WSvyllH.'),
(106, 'dimi@itu.dk', '$2y$11$V1RUwkBK9XlGIjogLVPUSO0fGNxlCiYi3N88NPl6WgxJpC9jAtOf2'),
(107, 'mares@itu.dk', '$2y$11$WPidSOzGXMD/mq49eY1VAO5gYi643ew.IOvr65RKWsLxx6acq2CSG');

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
