-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db562832823.db.1and1.com
-- Generation Time: Sep 26, 2016 at 04:33 PM
-- Server version: 5.1.73-log
-- PHP Version: 5.4.45-0+deb7u5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db562832823`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1001 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `userid`) VALUES
(1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE IF NOT EXISTS `agent` (
  `agentid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `firstname` text COLLATE latin1_general_ci NOT NULL,
  `lastname` text COLLATE latin1_general_ci NOT NULL,
  `dateofbirth` date NOT NULL,
  `idnumber` text COLLATE latin1_general_ci NOT NULL,
  `gender` text COLLATE latin1_general_ci NOT NULL,
  `address` text COLLATE latin1_general_ci NOT NULL,
  `phonenumber` text COLLATE latin1_general_ci NOT NULL,
  `educationalbackground` text COLLATE latin1_general_ci NOT NULL,
  `points` int(11) NOT NULL,
  `hoursspent` int(11) NOT NULL,
  PRIMARY KEY (`agentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1004 ;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agentid`, `userid`, `firstname`, `lastname`, `dateofbirth`, `idnumber`, `gender`, `address`, `phonenumber`, `educationalbackground`, `points`, `hoursspent`) VALUES
(1002, 1008, '2rand[0,1,1]', 'qRhZKkiMwLYdvQxQd', '0000-00-00', '6550', 'male', '7k4KL3 http://brothosonkonlonwon.ru', '94368542573', '7k4KL3 http://brothosonkonlonwon.ru', 0, 0),
(1003, 1009, 'Danielbet', 'Danielbet', '0000-00-00', '855', 'male', 'Edson', '123456', 'http://mumsie.co.uk/index.php/component/k2/itemlist/user/805 \r\n5Dsa@13zwe3z2!43344xeee', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `applicationid` int(11) NOT NULL AUTO_INCREMENT,
  `taskid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `agentid` int(11) NOT NULL,
  `epoch` int(11) NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`applicationid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `clientid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `firstname` text COLLATE latin1_general_ci NOT NULL,
  `lastname` text COLLATE latin1_general_ci NOT NULL,
  `address` text COLLATE latin1_general_ci NOT NULL,
  `points` int(11) NOT NULL,
  `hoursspent` int(11) NOT NULL,
  PRIMARY KEY (`clientid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1005 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientid`, `userid`, `firstname`, `lastname`, `address`, `points`, `hoursspent`) VALUES
(1002, 1005, 'Pia', 'Froese', 'Innovation Park Karlstad Sweden', 38, 0),
(1003, 1006, 'Erica', 'Nyzell', 'Signalhornsgatan 96', 47, 0),
(1004, 1007, 'Marcus', 'SandÃ©n', 'Vintergatan\r\n8b', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `targetid` int(11) NOT NULL,
  `userlist` text COLLATE latin1_general_ci,
  `dateandtime` date NOT NULL,
  `type` text COLLATE latin1_general_ci NOT NULL,
  `comment` text COLLATE latin1_general_ci NOT NULL,
  `ext` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=89 ;

-- --------------------------------------------------------

--
-- Table structure for table `gadget`
--

CREATE TABLE IF NOT EXISTS `gadget` (
  `gadgetid` int(11) NOT NULL AUTO_INCREMENT,
  `agentid` int(11) NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `description` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `ext` text COLLATE latin1_general_ci NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  `epoch` int(11) NOT NULL,
  PRIMARY KEY (`gadgetid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `gadget`
--

INSERT INTO `gadget` (`gadgetid`, `agentid`, `name`, `description`, `cost`, `ext`, `status`, `epoch`) VALUES
(33, 0, 'Iphone 6', 0, 70, 'jpg', 'new', 1435279182),
(32, 0, 'Iphone5', 0, 50, 'jpg', 'new', 1435279082),
(34, 0, 'Iphone5', 0, 50, 'jpg', 'new', 1436370736);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notificationid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `note` text COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `epoch` text COLLATE latin1_general_ci NOT NULL,
  `link` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`notificationid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notificationid`, `userid`, `note`, `description`, `epoch`, `link`) VALUES
(23, 1005, 'created gadget', 'Your account as been credited', '', ''),
(24, 1005, 'created gadget', 'Your account as been credited', '', ''),
(25, 1005, 'created gadget', 'Your account as been credited', '', ''),
(26, 1005, 'created gadget', 'Your account as been credited', '', ''),
(27, 1005, 'created gadget', 'Your account as been credited', '', ''),
(28, 1005, 'created gadget', 'Your account as been credited', '', ''),
(29, 1005, 'created gadget', 'Your account as been credited', '', ''),
(30, 1005, 'created gadget', 'Your account as been credited', '', ''),
(31, 1006, 'created gadget', 'Your account as been credited', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `taskid` int(11) NOT NULL AUTO_INCREMENT,
  `clientid` int(11) NOT NULL,
  `agentlist` text COLLATE latin1_general_ci NOT NULL,
  `title` text COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `completiontime` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `epoch` int(11) NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  `privacy` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`taskid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskid`, `clientid`, `agentlist`, `title`, `description`, `completiontime`, `weight`, `epoch`, `status`, `privacy`) VALUES
(42, 1002, ' ', 'Translation', 'Please translate the attached document from German to Enlish', 3, 2, 1429296275, 'queued', 'public'),
(43, 1003, ' ', 'Song writing', 'write me a three versed song about the ocean', 3, 3, 1436371078, 'queued', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` text COLLATE latin1_general_ci NOT NULL,
  `typeid` int(11) NOT NULL,
  `username` text COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `email` text COLLATE latin1_general_ci NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  `epoch` int(11) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1010 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `usertype`, `typeid`, `username`, `password`, `email`, `status`, `epoch`) VALUES
(1000, 'admin', 1000, 'admin', 'admin', 'admin@iqueue.com', 'active', 0),
(1005, 'client', 1002, 'Pia', 'Schoco1lade', 'piafroese@web.de', 'active', 1429295795),
(1006, 'client', 1003, 'Scaler', 'Palla123', 'ericanyzell@msn.com', 'active', 1436370594),
(1007, 'client', 1004, 'sanden11', 'miller87', 'sanden11@hotmail.com', 'active', 1442773456),
(1008, 'agent', 1002, 'babsabtabkap', 'DL9hnf', '', 'pending', 1452790612),
(1009, 'agent', 1003, 'Danielbet', 'ryd6n6L1uG', 'danielzek@mail.ru', 'pending', 1474549472);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
