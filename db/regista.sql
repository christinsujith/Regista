-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2012 at 04:50 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `regista`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `memberid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `born` int(11) NOT NULL,
  `games` varchar(10) NOT NULL,
  `goals` varchar(10) NOT NULL,
  `arrived` int(11) NOT NULL,
  `firstclub` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `imageurl` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`memberid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `pageid` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `externalid` int(11) NOT NULL,
  `url` varchar(500) NOT NULL,
  `headline` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `imageurl` varchar(500) NOT NULL,
  `post_from` datetime NOT NULL,
  `post_to` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`pageid`),
  KEY `userid` (`userid`),
  KEY `page_typeid` (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `page_type`
--

CREATE TABLE IF NOT EXISTS `page_type` (
  `typeid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(12) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `page_type`
--

INSERT INTO `page_type` (`typeid`, `name`, `created`, `updated`) VALUES
(1, 'page', '2012-02-01 00:00:00', '2012-02-01 13:08:00'),
(2, 'news', '2012-02-01 00:00:00', '2012-02-01 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `enabled` bit(1) NOT NULL DEFAULT b'1',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`userid`),
  KEY `typeid` (`typeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `typeid`, `name`, `username`, `pass`, `lastlogin`, `enabled`, `created`, `updated`) VALUES
(1, 3, 'Administra', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2012-02-03 14:41:52', '1', '2012-02-03 14:41:52', '2012-02-07 15:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `typeid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(12) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`typeid`, `name`, `created`, `updated`) VALUES
(1, 'customer', '2012-02-01 00:00:00', '2012-02-01 06:09:00'),
(2, 'team', '2012-02-01 00:00:00', '2012-02-01 09:00:00'),
(3, 'admin', '2012-02-03 00:00:00', '2012-02-03 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `page_type` (`typeid`),
  ADD CONSTRAINT `page_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `user_type` (`typeid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
