-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2011 at 07:14 PM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cinyWeb`
--

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `length` int(10) unsigned DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `story` text,
  `screenwriter` text,
  `director` text,
  `link_website` varchar(250) DEFAULT NULL,
  `link_trailer` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rating` (`rating`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `title`, `length`, `rating`, `story`, `screenwriter`, `director`, `link_website`, `link_trailer`) VALUES
(1, 'On the buses', 60, 1, 'A story about buses', NULL, NULL, NULL, NULL),
(2, 'test', 0, 2, '', '', '', '', ''),
(3, 'test2', 0, 1, '', '', '', '', ''),
(4, 'ddd', 0, 1, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `genres_to_films`
--

CREATE TABLE IF NOT EXISTS `genres_to_films` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `film_id` int(10) unsigned NOT NULL,
  `genre_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `genres` (`genre_id`),
  KEY `films` (`film_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `link` varchar(250) NOT NULL,
  `order` int(11) NOT NULL,
  `static_id` int(11) NOT NULL,
  `display_in_menu` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `link`, `order`, `static_id`, `display_in_menu`) VALUES
(1, 'Films', 'home', 0, 0, 1),
(2, 'Booking Info', '/cinema/index/page', 0, 1, 1),
(3, 'News', '', 0, 0, 1),
(4, 'About Us', '/cinema/index/page', 0, 2, 1),
(5, 'Contact Us', '/cinema/index/page', 0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `content` text,
  `date_published` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `label`) VALUES
(1, 'PG'),
(2, '18');

-- --------------------------------------------------------

--
-- Table structure for table `showings`
--

CREATE TABLE IF NOT EXISTS `showings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_time` datetime DEFAULT NULL,
  `three_d` int(10) unsigned DEFAULT NULL,
  `private` int(10) unsigned DEFAULT NULL,
  `film_id` int(10) unsigned NOT NULL,
  `added` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `film` (`film_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `showings`
--

INSERT INTO `showings` (`id`, `date_time`, `three_d`, `private`, `film_id`, `added`) VALUES
(1, '2011-12-01 09:30:00', 1, 0, 1, '2011-12-12 21:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `static_sections`
--

CREATE TABLE IF NOT EXISTS `static_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `static_sections`
--

INSERT INTO `static_sections` (`id`, `title`, `content`) VALUES
(1, 'Booking Information', 'Booking information content'),
(2, 'About us', 'About'),
(3, 'Contact Us', 'Contact'),
(4, 'Volunteer With us', 'Volunteer with us');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE IF NOT EXISTS `titles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `e-mail` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `title_id` int(11) DEFAULT NULL,
  `administrator` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `titles` (`title_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_showings`
--
CREATE TABLE IF NOT EXISTS `vw_showings` (
`title` varchar(250)
,`film_id` int(10) unsigned
,`date_time` varchar(139)
,`starts` varchar(10)
,`ratingLabel` varchar(250)
,`ratingId` int(11)
,`finishes` varchar(10)
);
-- --------------------------------------------------------

--
-- Structure for view `vw_showings`
--
DROP TABLE IF EXISTS `vw_showings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_showings` AS select `f`.`title` AS `title`,`f`.`id` AS `film_id`,date_format(`t`.`date_time`,'%W %D %M %Y') AS `date_time`,date_format(`t`.`date_time`,'%H:%i') AS `starts`,`ratings`.`label` AS `ratingLabel`,`ratings`.`id` AS `ratingId`,date_format((`t`.`date_time` + interval `f`.`length` minute),'%H:%i') AS `finishes` from ((`showings` `t` left join `films` `f` on((`t`.`film_id` = `f`.`id`))) left join `ratings` on((`f`.`rating` = `ratings`.`id`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`rating`) REFERENCES `ratings` (`id`);

--
-- Constraints for table `genres_to_films`
--
ALTER TABLE `genres_to_films`
  ADD CONSTRAINT `films` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `genres` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `showings`
--
ALTER TABLE `showings`
  ADD CONSTRAINT `film` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `titles` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
