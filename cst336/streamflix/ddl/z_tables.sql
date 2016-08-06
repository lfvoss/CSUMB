-- phpMyAdmin SQL Dump
-- version 4.0.10.16
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 05, 2016 at 10:05 PM
-- Server version: 5.5.31-cll
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sara3589`
--

-- --------------------------------------------------------

--
-- Table structure for table `Z_Assets`
--

CREATE TABLE IF NOT EXISTS `Z_Assets` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`asset_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `Z_Assets`
--

INSERT INTO `Z_Assets` (`asset_id`, `name`) VALUES
(16, 'Alfred Hitchcock'),
(29, 'Carrie-Anne Moss'),
(6, 'Cate Blanchett'),
(5, 'Daniel Day-Lewis'),
(9, 'David Lean'),
(13, 'Elia Kazan'),
(26, 'Ethan Coen'),
(15, 'Eva Marie-Saint'),
(2, 'Harrison Ford'),
(30, 'Hugo Weaving'),
(22, 'Jeff Bridges'),
(25, 'Joel Coen'),
(23, 'John Goodman'),
(24, 'Julianne Moore'),
(10, 'Julie Christie'),
(27, 'Keanu Reeves'),
(31, 'Lana Wachowski'),
(28, 'Laurence Fishburne'),
(32, 'Lilly Wachowski'),
(14, 'Marlon Brando'),
(35, 'Matt Damon'),
(33, 'Mel Gibson'),
(11, 'Michael Mann'),
(8, 'Omar Shariff'),
(1, 'Ridley Scott'),
(7, 'Rod Steiger'),
(3, 'Rutger Hauer'),
(4, 'Sean Young'),
(34, 'Sophie Marceau'),
(17, 'Tippi Hedren'),
(12, 'Woody Allen');

-- --------------------------------------------------------

--
-- Table structure for table `Z_Genres`
--

CREATE TABLE IF NOT EXISTS `Z_Genres` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`genre_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `Z_Genres`
--

INSERT INTO `Z_Genres` (`genre_id`, `name`) VALUES
(3, 'Action'),
(7, 'Adventure'),
(24, 'Comedy'),
(8, 'Crime'),
(4, 'Drama'),
(2, 'Film Noir'),
(9, 'Horror'),
(10, 'Mystery'),
(5, 'Romance'),
(1, 'Science-Fiction'),
(6, 'War'),
(25, 'Western');

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
  PRIMARY KEY (`movie_id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `Z_Movies`
--

INSERT INTO `Z_Movies` (`movie_id`, `title`, `year`, `description`, `rating`, `length`) VALUES
(1, 'Blade Runner', 1982, 0x446f20616e64726f69647320647265616d206f6620656c6563747269632073686565703f, 'R', 116),
(2, 'Doctor Zhivago', 1965, 0x546865206c696665206f662061205275737369616e2070687973696369616e20616e6420706f65742077686f2c20616c74686f756768206d61727269656420746f20616e6f746865722c2066616c6c7320696e206c6f76652077697468206120706f6c69746963616c2061637469766973742773207769666520616e6420657870657269656e63657320686172647368697020647572696e672074686520466972737420576f726c642057617220616e64207468656e20746865204f63746f626572205265766f6c7574696f6e2e, 'PG-13', 197),
(3, 'The Last of the Mohicans', 1992, 0x54687265652074726170706572732070726f74656374206f66204272697469736820436f6c6f6e656c27732064617567687465727320696e20746865206d69647374206f6620746865204672656e636820616e6420496e6469616e205761722e, 'R', 112),
(4, 'Blue Jasmine', 2013, 0x41204e657720596f726b20736f6369616c6974652c20646565706c792074726f75626c656420616e6420696e2064656e69616c2c206172726976657320696e2053616e204672616e636973636f20746f20696d706f73652075706f6e20686572207369737465722e20536865206c6f6f6b732061206d696c6c696f6e2c206275742069736e2774206272696e67696e67206d6f6e65792c2070656163652c206f72206c6f76652e2e2e, 'R', 98),
(5, 'On the Waterfront', 1954, 0x416e2065782d7072697a652066696768746572207475726e6564206c6f6e6773686f72656d616e207374727567676c657320746f207374616e6420757020746f2068697320636f727275707420756e696f6e20626f737365732e, 'Not Rated', 108),
(6, 'The Birds', 1963, 0x41207765616c7468792053616e204672616e636973636f20736f6369616c6974652070757273756573206120706f74656e7469616c20626f79667269656e6420746f206120736d616c6c204e6f72746865726e2043616c69666f726e696120746f776e207468617420736c6f776c792074616b65732061207475726e20666f72207468652062697a61727265207768656e206269726473206f6620616c6c206b696e64732073756464656e6c7920626567696e20746f2061747461636b2070656f706c652e, 'PG-13', 119),
(14, 'The Big Lebowski', 1998, 0x22546865204475646522204c65626f77736b692c206d697374616b656e20666f722061206d696c6c696f6e61697265204c65626f77736b692c207365656b73207265737469747574696f6e20666f7220686973207275696e65642072756720616e6420656e6c697374732068697320626f776c696e67206275646469657320746f2068656c70206765742069742e, 'R', 117),
(15, 'The Matrix', 1999, 0x4120636f6d7075746572206861636b6572206c6561726e732066726f6d206d7973746572696f757320726562656c732061626f7574207468652074727565206e6174757265206f6620686973207265616c69747920616e642068697320726f6c6520696e207468652077617220616761696e73742069747320636f6e74726f6c6c6572732e, 'R', 132),
(16, 'Braveheart', 1995, 0x5768656e206869732073656372657420627269646520697320657865637574656420666f722061737361756c74696e6720616e20456e676c69736820736f6c646965722077686f20747269656420746f2072617065206865722c2057696c6c69616d2057616c6c61636520626567696e732061207265766f6c7420616761696e7374204b696e67204564776172642049206f6620456e676c616e642e, 'R', 178),
(17, 'True Grit', 2010, 0x4120746f75676820552e532e204d61727368616c2068656c707320612073747562626f726e207465656e6167657220747261636b20646f776e20686572206661746865722773206d757264657265722e, 'PG-13', 110);

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
(3, 5, 2),
(4, 6, 2),
(2, 7, 2),
(5, 7, 2),
(2, 8, 2),
(2, 9, 1),
(2, 10, 2),
(3, 11, 1),
(4, 12, 1),
(5, 13, 1),
(5, 14, 2),
(6, 16, 1),
(6, 17, 2),
(14, 22, 2),
(17, 22, 2),
(14, 23, 2),
(14, 24, 2),
(14, 25, 1),
(17, 25, 1),
(14, 26, 1),
(17, 26, 1),
(15, 27, 2),
(15, 28, 2),
(15, 29, 2),
(15, 30, 2),
(15, 31, 1),
(15, 32, 1),
(16, 33, 1),
(16, 33, 2),
(16, 34, 2),
(17, 35, 2);

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
(15, 1),
(1, 2),
(1, 3),
(3, 3),
(15, 3),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(16, 4),
(17, 4),
(2, 5),
(5, 5),
(2, 6),
(3, 7),
(17, 7),
(5, 8),
(6, 9),
(6, 10),
(14, 24),
(17, 25);

-- --------------------------------------------------------

--
-- Table structure for table `Z_Roles`
--

CREATE TABLE IF NOT EXISTS `Z_Roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Z_Roles`
--

INSERT INTO `Z_Roles` (`role_id`, `name`) VALUES
(2, 'Cast'),
(1, 'Director');

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
