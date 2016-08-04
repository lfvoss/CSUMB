-- phpMyAdmin SQL Dump
-- version 4.0.10.16
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2016 at 01:00 PM
-- Server version: 5.5.31-cll
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `will1680`
--


-- --------------------------------------------------------

--
-- Table structure for table `Z_Assets`
--

CREATE TABLE IF NOT EXISTS `Z_Assets` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`asset_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Z_Assets`
--

INSERT INTO `Z_Assets` (`asset_id`, `name`) VALUES
(1, 'Ridley Scott'),
(2, 'Harrison Ford'),
(3, 'Rutger Hauer'),
(4, 'Sean Young'),
(5, 'Daniel Day-Lewis'),
(6, 'Cate Blanchett'),
(7, 'Rod Steiger'),
(8, 'Omar Shariff'),
(9, 'David Lean'),
(10, 'Julie Christie'),
(11, 'Michael Mann'),
(12, 'Woody Allen'),
(13, 'Elia Kazan'),
(14, 'Marlon Brando'),
(15, 'Eva Marie-Saint'),
(16, 'Alfred Hitchcock'),
(17, 'Tippi Hedren');

-- --------------------------------------------------------

--
-- Table structure for table `Z_Genres`
--

CREATE TABLE IF NOT EXISTS `Z_Genres` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Z_Genres`
--

INSERT INTO `Z_Genres` (`genre_id`, `name`) VALUES
(1, 'Science-Fiction'),
(2, 'Film Noir'),
(3, 'Action'),
(4, 'Drama'),
(5, 'Romance'),
(6, 'War'),
(7, 'Adventure'),
(8, 'Crime'),
(9, 'Horror'),
(10, 'Mystery');

-- --------------------------------------------------------

--
-- Table structure for table `Z_Movies`
--

CREATE TABLE IF NOT EXISTS `Z_Movies` (
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `description` blob,
  `rating` varchar(10) DEFAULT NULL,
  `length` int(11) NOT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Z_Movies`
--

INSERT INTO `Z_Movies` (`movie_id`, `title`, `year`, `description`, `rating`, `length`) VALUES
(1, 'Blade Runner', 1982, '0x446f20616e64726f69647320647265616d206f6620656c6563747269632073686565703f', 'R', 116);

INSERT INTO `Z_Movies` (`movie_id`, `title`, `year`, `description`, `rating`, `length`) VALUES
(2, 'Doctor Zhivago', 1965, 'The life of a Russian physician and poet who, although married to another, falls in love with a political activist''s wife and experiences hardship during the First World War and then the October Revolution.', 'PG-13', 197);

INSERT INTO `Z_Movies` (`movie_id`, `title`, `year`, `description`, `rating`, `length`) VALUES
(3, 'The Last of the Mohicans', 1992, 'Three trappers protect of British Colonel''s daughters in the midst of the French and Indian War.', 'R', 112);

INSERT INTO `Z_Movies` (`movie_id`, `title`, `year`, `description`, `rating`, `length`) VALUES
(4, 'Blue Jasmine', 2013, 'A New York socialite, deeply troubled and in denial, arrives in San Francisco to impose upon her sister. She looks a million, but isn''t bringing money, peace, or love...', 'R', 98);

INSERT INTO `Z_Movies` (`movie_id`, `title`, `year`, `description`, `rating`, `length`) VALUES
(5, 'On the Waterfront', 1954, 'An ex-prize fighter turned longshoreman struggles to stand up to his corrupt union bosses.', 'Not Rated', 108);

INSERT INTO `Z_Movies` (`movie_id`, `title`, `year`, `description`, `rating`, `length`) VALUES
(6, 'The Birds', 1963, 'A wealthy San Francisco socialite pursues a potential boyfriend to a small Northern California town that slowly takes a turn for the bizarre when birds of all kinds suddenly begin to attack people.', 'PG-13', 119);
-- --------------------------------------------------------

--
-- Table structure for table `Z_Movie_Assets`
--

CREATE TABLE IF NOT EXISTS `Z_Movie_Assets` (
  `movie_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_id`,`asset_id`,`role_id`),
  KEY `asset_id` (`asset_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Z_Movie_Assets`
--

INSERT INTO `Z_Movie_Assets` (`movie_id`, `asset_id`, `role_id`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 2),
(1, 4, 2),
(2, 7, 2),
(2, 8, 2),
(2, 9, 1),
(2, 10, 2),
(3, 5, 2),
(3, 11, 1),
(4, 6, 2),
(4, 12, 1),
(5, 7, 2),
(5, 13, 1),
(5, 14, 2),
(5, 15, 2),
(6, 16, 1)
(6, 17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Z_Movie_Genres`
--

CREATE TABLE IF NOT EXISTS `Z_Movie_Genres` (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_id`,`genre_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Z_Movie_Genres`
--

INSERT INTO `Z_Movie_Genres` (`movie_id`, `genre_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 3),
(3, 4),
(3, 7),
(4, 4),
(5, 4),
(5, 5),
(5, 8),
(6, 4),
(6, 9),
(6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `Z_Roles`
--

CREATE TABLE IF NOT EXISTS `Z_Roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Z_Roles`
--

INSERT INTO `Z_Roles` (`role_id`, `name`) VALUES
(1, 'Director'),
(2, 'Cast');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Z_Movie_Assets`
--
ALTER TABLE `Z_Movie_Assets`
  ADD CONSTRAINT `Z_Movie_Assets_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Z_Movies` (`movie_id`),
  ADD CONSTRAINT `Z_Movie_Assets_ibfk_2` FOREIGN KEY (`asset_id`) REFERENCES `Z_Assets` (`asset_id`),
  ADD CONSTRAINT `Z_Movie_Assets_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `Z_Roles` (`role_id`);

--
-- Constraints for table `Z_Movie_Genres`
--
ALTER TABLE `Z_Movie_Genres`
  ADD CONSTRAINT `Z_Movie_Genres_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Z_Movies` (`movie_id`),
  ADD CONSTRAINT `Z_Movie_Genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `Z_Genres` (`genre_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
