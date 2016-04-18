-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2016 at 06:02 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demoximr_tamilmp3`
--

-- --------------------------------------------------------

--
-- Table structure for table `directed_by`
--

CREATE TABLE IF NOT EXISTS `directed_by` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `song_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `directed_by`
--

INSERT INTO `directed_by` (`id`, `song_id`, `director_id`) VALUES
(1, 2, 3),
(2, 3, 3),
(3, 4, 3),
(4, 5, 4),
(5, 6, 4),
(6, 7, 4),
(7, 8, 4),
(8, 9, 4),
(9, 10, 3),
(10, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE IF NOT EXISTS `directors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`id`, `name`) VALUES
(1, 'aaaaa'),
(2, 'bbbbb');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `year`, `image`) VALUES
(1, 'A', 1990, 'illa'),
(2, 'B', 1991, 'illa'),
(3, 'c', 1992, 'illa'),
(4, 'movie0', 2000, 'illa'),
(5, 'movie1', 2001, 'illa'),
(6, 'movie2', 2002, 'illa'),
(7, 'movie3', 2003, 'illa'),
(8, 'movie4', 2004, 'illa'),
(9, 'movie5', 2005, 'illa'),
(10, 'movie6', 2006, 'illa'),
(11, 'movie7', 2007, 'illa'),
(12, 'movie8', 2008, 'illa'),
(13, 'movie9', 2009, 'illa'),
(14, 'Kali', 2000, ''),
(15, 'Kalimba', 2005, '');

-- --------------------------------------------------------

--
-- Table structure for table `movie_directed_by`
--

CREATE TABLE IF NOT EXISTS `movie_directed_by` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `director_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `movie_directed_by`
--

INSERT INTO `movie_directed_by` (`id`, `director_id`, `movie_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `music_directors`
--

CREATE TABLE IF NOT EXISTS `music_directors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `music_directors`
--

INSERT INTO `music_directors` (`id`, `name`, `image`) VALUES
(1, 'music_director0', 'illa'),
(2, 'music_director1', 'illa'),
(3, 'music_director2', 'illa'),
(4, 'music_director3', 'illa'),
(5, 'music_director4', 'illa'),
(6, 'music_director5', 'illa'),
(7, 'music_director6', 'illa'),
(8, 'music_director7', 'illa'),
(9, 'music_director8', 'illa'),
(10, 'music_director9', 'illa');

-- --------------------------------------------------------

--
-- Table structure for table `singers`
--

CREATE TABLE IF NOT EXISTS `singers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `singers`
--

INSERT INTO `singers` (`id`, `name`, `image`) VALUES
(1, 'singer0', 'illa'),
(2, 'singer1', 'illa'),
(3, 'singer2', 'illa'),
(4, 'singer3', 'illa'),
(5, 'singer4', 'illa'),
(6, 'singer5', 'illa'),
(7, 'singer6', 'illa'),
(8, 'singer7', 'illa'),
(9, 'singer8', 'illa'),
(10, 'singer9', 'illa');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `name`, `movie_id`, `file`) VALUES
(1, 'Sadfnsakjdf', 2, 'dummy.php'),
(2, 'Sadfnsakjdf', 2, 'dummy.php'),
(6, 'First-song', 2, 'First-song.mp3'),
(7, 'First-song', 2, 'First-song.mp3'),
(8, 'Second-song', 2, 'Second-song.mp3'),
(9, 'Testing-song', 14, 'Testing-song.mp3'),
(10, 'Abcdefg', 15, 'Abcdefg.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `starred_by`
--

CREATE TABLE IF NOT EXISTS `starred_by` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `star_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `starred_by`
--

INSERT INTO `starred_by` (`id`, `movie_id`, `star_id`) VALUES
(1, 2, 2),
(2, 2, 3),
(3, 15, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE IF NOT EXISTS `stars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `stars`
--

INSERT INTO `stars` (`id`, `name`, `image`) VALUES
(1, 'start0', 'illa'),
(2, 'start1', 'illa'),
(3, 'start2', 'illa'),
(4, 'start3', 'illa'),
(5, 'start4', 'illa'),
(6, 'start5', 'illa'),
(7, 'start6', 'illa'),
(8, 'start7', 'illa'),
(9, 'start8', 'illa'),
(10, 'start9', 'illa');

-- --------------------------------------------------------

--
-- Table structure for table `sung_by`
--

CREATE TABLE IF NOT EXISTS `sung_by` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `song_id` int(11) NOT NULL,
  `singer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sung_by`
--

INSERT INTO `sung_by` (`id`, `song_id`, `singer_id`) VALUES
(1, 1, 3),
(2, 2, 3),
(3, 3, 4),
(4, 3, 5),
(5, 4, 3),
(6, 5, 3),
(7, 6, 3),
(8, 7, 3),
(9, 8, 3),
(10, 9, 3),
(11, 10, 3),
(12, 10, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
