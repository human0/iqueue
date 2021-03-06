-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db574507426.db.1and1.com
-- Generation Time: Sep 26, 2016 at 04:34 PM
-- Server version: 5.1.73-log
-- PHP Version: 5.4.45-0+deb7u5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db574507426`
--

-- --------------------------------------------------------

--
-- Table structure for table `gals`
--

CREATE TABLE IF NOT EXISTS `gals` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `cepoch` int(11) NOT NULL,
  `uepoch` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `gals`
--

-- --------------------------------------------------------

--
-- Table structure for table `pics`
--

CREATE TABLE IF NOT EXISTS `pics` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `cepoch` int(11) NOT NULL,
  `uepoch` int(11) NOT NULL,
  `galID` int(11) NOT NULL,
  `ext` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pics`
--

INSERT INTO `pics` (`ID`, `name`, `description`, `cepoch`, `uepoch`, `galID`, `ext`) VALUES
(10, '', 'The name says it all', 1445151657, 1445158149, 10, '.jpeg'),
(11, '', 'The goodness of this one will have saving galaxies far far away.', 1445155851, 1445160286, 10, '.jpeg'),
(12, '', 'This one definately packs a punch', 1445156230, 1445157409, 10, '.jpeg'),
(13, '', 'Garden1', 1445160350, 1445160503, 11, '.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `youthereresponses`
--

CREATE TABLE IF NOT EXISTS `youthereresponses` (
  `responseid` int(11) NOT NULL AUTO_INCREMENT,
  `surveyid` text COLLATE latin1_general_ci NOT NULL,
  `fullpath` text COLLATE latin1_general_ci NOT NULL,
  `timespaperstatus` text COLLATE latin1_general_ci NOT NULL,
  `guardianpaperstatus` text COLLATE latin1_general_ci NOT NULL,
  `scottishpowerstatus` text COLLATE latin1_general_ci NOT NULL,
  `ppistatus` text COLLATE latin1_general_ci NOT NULL,
  `funeralstatus` text COLLATE latin1_general_ci NOT NULL,
  `endownmentstatus` text COLLATE latin1_general_ci NOT NULL,
  `atriumstatus` text COLLATE latin1_general_ci NOT NULL,
  `agent` text COLLATE latin1_general_ci NOT NULL,
  `epoch` int(11) NOT NULL,
  `ans_title` text COLLATE latin1_general_ci NOT NULL,
  `ans_firstname` text COLLATE latin1_general_ci NOT NULL,
  `ans_surname` text COLLATE latin1_general_ci NOT NULL,
  `ans_addr1` text COLLATE latin1_general_ci NOT NULL,
  `ans_addr2` text COLLATE latin1_general_ci NOT NULL,
  `ans_addr3` text COLLATE latin1_general_ci NOT NULL,
  `ans_town` text COLLATE latin1_general_ci NOT NULL,
  `ans_country` text COLLATE latin1_general_ci NOT NULL,
  `ans_postcode` text COLLATE latin1_general_ci NOT NULL,
  `ans_phone` text COLLATE latin1_general_ci NOT NULL,
  `ans_ipaddress` text COLLATE latin1_general_ci NOT NULL,
  `ans_gender` text COLLATE latin1_general_ci NOT NULL,
  `ans_email` text COLLATE latin1_general_ci NOT NULL,
  `ans_dob_text` text COLLATE latin1_general_ci NOT NULL,
  `ans_TimesPaper` text COLLATE latin1_general_ci NOT NULL,
  `ans_GuardianPaper` text COLLATE latin1_general_ci NOT NULL,
  `ans_age` text COLLATE latin1_general_ci NOT NULL,
  `ans_billpayer` text COLLATE latin1_general_ci NOT NULL,
  `ans_energysupplier` text COLLATE latin1_general_ci NOT NULL,
  `ans_paymenttypeq` text COLLATE latin1_general_ci NOT NULL,
  `ans_call` text COLLATE latin1_general_ci NOT NULL,
  `ans_prv_date` text COLLATE latin1_general_ci NOT NULL,
  `ans_FuneralPlan` text COLLATE latin1_general_ci NOT NULL,
  `ans_password` text COLLATE latin1_general_ci NOT NULL,
  `ans_ppi` text COLLATE latin1_general_ci NOT NULL,
  `ans_ever_worked` text COLLATE latin1_general_ci NOT NULL,
  `ans_call_you` text COLLATE latin1_general_ci NOT NULL,
  `ans_HaveEndownment` text COLLATE latin1_general_ci NOT NULL,
  `ans_date_time` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`responseid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `youthereresponses`
--

INSERT INTO `youthereresponses` (`responseid`, `surveyid`, `fullpath`, `timespaperstatus`, `guardianpaperstatus`, `scottishpowerstatus`, `ppistatus`, `funeralstatus`, `endownmentstatus`, `atriumstatus`, `agent`, `epoch`, `ans_title`, `ans_firstname`, `ans_surname`, `ans_addr1`, `ans_addr2`, `ans_addr3`, `ans_town`, `ans_country`, `ans_postcode`, `ans_phone`, `ans_ipaddress`, `ans_gender`, `ans_email`, `ans_dob_text`, `ans_TimesPaper`, `ans_GuardianPaper`, `ans_age`, `ans_billpayer`, `ans_energysupplier`, `ans_paymenttypeq`, `ans_call`, `ans_prv_date`, `ans_FuneralPlan`, `ans_password`, `ans_ppi`, `ans_ever_worked`, `ans_call_you`, `ans_HaveEndownment`, `ans_date_time`) VALUES
(1, '', 'null', 'new', 'new', 'new', 'new', 'new', 'new', 'new', 'unknown', 1431397832, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, '1', '', 'restricted', 'new', 'new', 'new', 'new', 'new', 'new', 'unknown', 1431402410, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, '2', '', 'new', 'new', 'new', 'new', 'new', 'restricted', 'new', 'unknown', 1431402873, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, '3', '', 'new', 'new', 'new', 'new', 'new', 'new', 'new', 'unknown', 1431404079, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, '4', '', 'new', 'new', 'restricted', 'new', 'new', 'new', 'new', 'unknown', 1431404271, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, '5', '', 'rejected', 'rejected', 'restricted', 'restricted', 'restricted', 'restricted', 'restricted', 'unknown', 1431404556, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ' ', ' ', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, '6', '', 'new', 'new', 'new', 'new', 'new', 'new', 'new', 'unknown', 1431404632, 'Mrs', 'Catherine ', 'Wright', '10 Drummond Road', 'Enderby', 'NULL', 'Leicester ', 'UK', 'LE19 4QL', '162848094', '192.168.0.111', 'Female', 'chris@gmail.com', '15/12/1982', 'Times', 'Guardian', '30-35', 'Y', 'First Utility ', '1', 'Y', '', 'Y', 'Durban', 'Y', 'Yes', 'Y', 'Y', '2015-04-22 12:18:35'),
(8, '7', '', 'rejected', 'rejected', 'rejected', 'rejected', 'restricted', 'rejected', 'rejected', 'unknown', 1431404772, 'Mrs', 'Catherine ', 'Wright', '10 Drummond Road', 'Enderby', 'NULL', 'Leicester ', 'UK', 'LE19 4QL', '162848094', '192.168.0.111', 'Female', 'chris@gmail.com', '15/12/1982', 'Times', 'Guardian', '30-35', 'Y', 'First Utility ', '1', 'Y', '', 'Y', 'Durban', 'Y', 'Yes', 'Y', 'Y', '2015-04-22 12:18:35'),
(9, '9', '', 'rejected', 'rejected', 'rejected', 'rejected', 'restricted', 'rejected', 'restricted', 'unknown', 1431404788, 'Mrs', 'Catherine', 'right', '9 Drummond Road', 'Enderby', 'NULL', 'Leicester ', 'UK', 'LE19 4QL', '162848097', '192.168.0.111', 'Female', 'chris@gmail.com', '1982-12-15', 'Times', 'Guardian', '25-34', 'Y', 'First Utility ', '1', 'Y', '', 'Y', 'Durban', 'Y', 'Yes', 'Y', 'Y', '2015-04-22 12:18:35'),
(10, '20', '', 'new', 'new', 'new', 'new', 'new', 'new', 'new', 'unknown', 1431404819, 'Mrs', 'Catherine ', 'Wright', '10 Drummond Road', 'Enderby', 'NULL', 'Leicester', 'UK', 'LE19 4QL', '162848094', '192.168.0.111', 'Female', 'chris@gmail.com', '15/12/1982', 'Times', 'Guardian', '30-35', 'Y', 'First Utility ', '1', 'Y', '', 'Y', 'Durban', 'Y', 'Yes', 'Y', 'Y', '2015-04-22 12:18:35'),
(11, '13', '', 'rejected', 'rejected', 'rejected', 'rejected', 'restricted', 'rejected', 'rejected', 'emmanuel', 1431688447, 'Mrs', 'Catherine ', 'Surnames', '10 Drummond Road', 'Enderby', ' ', 'Leicester ', 'UK', 'LE19 4QL', '162848094', '192.168.0.111', 'Female', 'chris@gmail.com', '15/12/1982', 'Times', 'null', '30-35', 'Y', 'First Utility ', '1', 'Y', ' ', 'Y', 'Durban', 'Y', 'Yes', 'Y', 'Y', '2015-04-22 12:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `youthereusers`
--

CREATE TABLE IF NOT EXISTS `youthereusers` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `name` text COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci,
  `type` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `youthereusers`
--

INSERT INTO `youthereusers` (`userid`, `name`, `password`, `type`) VALUES
(0, 'emmanuel', 'tOjyuyUM', 'agent');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
