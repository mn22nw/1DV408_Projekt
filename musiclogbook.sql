-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 25 okt 2014 kl 03:59
-- Serverversion: 5.6.15-log
-- PHP-version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `musiclogbook`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `folder`
--

CREATE TABLE IF NOT EXISTS `folder` (
  `folderID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `userIDFK` int(11) NOT NULL,
  PRIMARY KEY (`folderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumpning av Data i tabell `folder`
--

INSERT INTO `folder` (`folderID`, `name`, `userIDFK`) VALUES
(11, 'GUITAR', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `instrument`
--

CREATE TABLE IF NOT EXISTS `instrument` (
  `instrumentID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `userIDFK` int(11) NOT NULL,
  PRIMARY KEY (`instrumentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumpning av Data i tabell `instrument`
--

INSERT INTO `instrument` (`instrumentID`, `name`, `userIDFK`) VALUES
(6, 'BASS', 2),
(8, 'UKULELE', 2),
(41, 'GITARR', 8),
(32, 'PIANO', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `song`
--

CREATE TABLE IF NOT EXISTS `song` (
  `songID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `practicedTime` float NOT NULL,
  `lastPracticed` date NOT NULL,
  `notes` varchar(1000) NOT NULL,
  `instrumentIDFK` varchar(255) NOT NULL,
  PRIMARY KEY (`songID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumpning av Data i tabell `song`
--

INSERT INTO `song` (`songID`, `name`, `practicedTime`, `lastPracticed`, `notes`, `instrumentIDFK`) VALUES
(26, 'Yeh', 5.03045, '0000-00-00', 'somewhere somehow', '6'),
(27, 'Long time ago', 0.0149, '0000-00-00', '', '8'),
(13, 'Cruella De vil', 0, '0000-00-00', '', '7'),
(35, 'Test', 0.0509, '0000-00-00', 'Jaha detta var ju intressant', '6'),
(39, 'Yuh', 0, '0000-00-00', '', '38'),
(38, 'Yt', 0, '0000-00-00', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjaskdjaskdj\r\nkghk', '37');

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `instrumentIDFK` int(11) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `instrumentIDFK`) VALUES
(8, 'annie', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', 41),
(2, 'miaaim', '10856aa99b49f9bf8792f671982412bbf8a82f9b', 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
