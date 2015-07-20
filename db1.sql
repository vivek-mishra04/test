-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2013 at 05:23 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `blabbing`
--

CREATE TABLE IF NOT EXISTS `blabbing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_id` int(11) NOT NULL,
  `the_blab` varchar(255) NOT NULL,
  `blab_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blab_type` enum('a','b') NOT NULL,
  `device` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bookinfo`
--

CREATE TABLE IF NOT EXISTS `bookinfo` (
  `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT,
  `BOOK_NAME` varchar(40) NOT NULL,
  `BOOK_DESC` longtext NOT NULL,
  `BOOK_AUTHOR` longtext NOT NULL,
  `BOOK_SUBJECT` varchar(40) NOT NULL,
  `BOOK_BRANCH_ID` int(11) NOT NULL,
  `BOOK_YEAR` varchar(5) NOT NULL,
  `BOOK_IMG` blob NOT NULL,
  PRIMARY KEY (`BOOK_ID`),
  KEY `BOOK_SUBJECT_ID` (`BOOK_SUBJECT`),
  KEY `BOOK_SUBJECT_ID_2` (`BOOK_SUBJECT`),
  KEY `BOOK_BRANCH_ID` (`BOOK_BRANCH_ID`),
  KEY `BOOK_YEAR_ID` (`BOOK_YEAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `bookinfo`
--

INSERT INTO `bookinfo` (`BOOK_ID`, `BOOK_NAME`, `BOOK_DESC`, `BOOK_AUTHOR`, `BOOK_SUBJECT`, `BOOK_BRANCH_ID`, `BOOK_YEAR`, `BOOK_IMG`) VALUES
(1, 'Advance Microprocessors', 'No description currently available.', 'Narula Harish', 'ADVANCE MICROPROCESSOR', 1, 'TE', ''),
(2, 'Data Mining-Concepts and Techniques, 3e', 'No description currently available.', 'Han', 'DATA WAREHOUSE AND MINING', 1, 'TE', ''),
(3, 'Database System Concepts', 'No description currently available.', 'Abraham Silberschatz, Henry F. Korth, S. Sudarshan', 'DATA WAREHOUSE AND MINING', 1, 'TE', ''),
(4, 'ADVANCED COMPUTER NETWORK', 'No description currently available.', 'PROF. DAYANAND AMBAWADE, DR. DEVEN SHAH', 'ADVANCE COMPUTER NETWORK', 1, 'TE', ''),
(5, 'Intelligent Systems', 'No description currently available.', 'Borde Santosh P.', 'ROBOTICS AND ARTIFICIAL INTELLIGENCE', 1, 'BE', ''),
(6, 'Security systems', 'No description currently available.', '  Gondal A & Gawande A', 'SYSTEM SECURITY', 1, 'BE', ''),
(7, 'Digital Signal & Image Processing', 'No description currently available.', 'Dhanajay Thekedath', 'DIGITAL SIGNAL AND IMAGE PROCESSING', 1, 'BE', ''),
(8, 'Digital Signal Processing', 'No description currently available.', 'R.A. Barapte', 'DIGITAL SIGNAL AND IMAGE PROCESSING', 1, 'BE', ''),
(9, 'Digital Signal Processing', 'No description currently available.', 'Ganesh Rao', 'DIGITAL SIGNAL AND IMAGE PROCESSING', 1, 'BE', ''),
(10, 'Applied Chemistry 1', 'No description currently available.', 'S. S. Dara', 'Chemistry 1', 1, 'FE', ''),
(11, 'Applied Chemistry 1 (2012 Edition)', 'No description currently available.', 'Dr. (Mrs) jayshree A. Parikh', 'Chemistry 1', 1, 'FE', ''),
(12, 'Applied Chemistry 2', 'No description currently available.', 'S. D Shete, S. S Dara', 'Chemistry 2', 1, 'FE', ''),
(13, 'Applied Chemistry II', 'No description currently available.', 'Paradkar', 'Chemistry 2', 1, 'FE', ''),
(14, 'Applied Chemistry II', 'No description currently available.', 'Dr. Trupti Paradkar', 'Chemistry 2', 1, 'FE', ''),
(15, 'Applied Physics 1 (2012 Edition)', 'No description currently available.', 'Dr. I.A. Shaikh', 'Physics 1', 1, 'FE', ''),
(16, 'Applied Physics II', 'No description currently available.', 'S.S.Patwardhan', 'Physics 2', 1, 'FE', ''),
(17, 'Applied Physics-II', 'No description currently available.', 'Shaikh I. A.', 'Physics 2', 1, 'FE', ''),
(18, 'Basic Electrical & Electronics Engineeri', 'No description currently available.', 'Ravish Singh', 'BASIC ELECTRONIC ELECTRICAL ENGG', 1, 'FE', ''),
(19, 'Basic Electrical And Electronics enginee', 'No description currently available.', 'J S Katre , H. Narula', 'BASIC ELECTRONIC ELECTRICAL ENGG', 1, 'FE', ''),
(20, 'Business Communication', 'No description currently available.', 'Urmila Rai and S.M. Rai', 'COMMUNICATION SKILLS', 1, 'FE', ''),
(21, 'Communication Skills', 'No description currently available.', 'Sanyukta Shah Yeb', 'COMMUNICATION SKILLS', 1, 'FE', ''),
(22, 'Computer Graphics', 'No description currently available.', 'Pawale Sanjesh', 'COMPUTER GRAPHICS', 1, 'SE', ''),
(23, 'Communication Skills', 'No description currently available.', 'Vaishali ghadyali', 'COMMUNICATION SKILLS', 1, 'FE', ''),
(24, 'Computer Graphics', 'No description currently available.', 'A.P.Godse', 'COMPUTER GRAPHICS', 1, 'SE', ''),
(25, 'Database Management System', 'No description currently available.', 'Mali Mahesh', 'DATABASE MANAGEMENT SYSTEMS', 1, 'SE', ''),
(26, 'Database System Concepts', 'No description currently available.', 'Abraham Silberschatz, Henry F. Korth, S. Sudarshan', 'DATABASE MANAGEMENT SYSTEMS', 0, 'SE', '');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `BRANCH_ID` int(11) NOT NULL,
  `BRANCH_NAME` varchar(30) NOT NULL,
  `BRANCH_DESC` longtext NOT NULL,
  PRIMARY KEY (`BRANCH_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BRANCH_ID`, `BRANCH_NAME`, `BRANCH_DESC`) VALUES
(1, 'COMPUTER', ''),
(2, 'ELECTRONICS', ''),
(3, 'ELECTRONICS AND TELECOMMUNICAT', ''),
(4, 'MECHANICAL', ''),
(5, 'CIVIL', ''),
(6, 'CHEMICAL', ''),
(7, 'PRODUCTION', '');

-- --------------------------------------------------------

--
-- Table structure for table `dev`
--

CREATE TABLE IF NOT EXISTS `dev` (
  `BOOK_ID_1` int(11) NOT NULL,
  `BOOK_ID_2` int(11) NOT NULL,
  `COUNT` int(11) NOT NULL,
  `SUM` int(11) NOT NULL,
  KEY `BOOK_ID_1` (`BOOK_ID_1`,`BOOK_ID_2`),
  KEY `BOOK_ID_2` (`BOOK_ID_2`),
  KEY `BOOK_ID_2_2` (`BOOK_ID_2`),
  KEY `BOOK_ID_1_2` (`BOOK_ID_1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dev`
--

INSERT INTO `dev` (`BOOK_ID_1`, `BOOK_ID_2`, `COUNT`, `SUM`) VALUES
(6, 8, 4, -14),
(8, 6, 4, 14),
(6, 6, 13, -2),
(10, 6, 6, 20),
(6, 10, 6, -20),
(10, 10, 1, 0),
(11, 11, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `post_author_id` int(4) NOT NULL,
  `otid` int(4) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` enum('a','b') NOT NULL,
  `view_count` int(4) NOT NULL,
  `section_title` varchar(64) NOT NULL,
  `thread_title` varchar(64) NOT NULL,
  `post_body` text NOT NULL,
  `closed` enum('0','1') NOT NULL,
  `section_id` int(4) NOT NULL,
  `post_author` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`id`, `post_author_id`, `otid`, `date_time`, `type`, `view_count`, `section_title`, `thread_title`, `post_body`, `closed`, `section_id`, `post_author`) VALUES
(1, 0, 0, '2013-04-08 09:08:55', 'a', 0, 'COMPS A', 'Computer Vision Related Queries', 'Post your doubts on CV', '0', 1, 'vivek'),
(2, 0, 1, '2013-04-08 09:10:03', 'b', 0, '', '', 'Can someone explain me Hit and Miss transform?', '0', 0, 'pankaj'),
(3, 0, 0, '2013-04-08 09:10:48', 'a', 0, 'Project Buddy', 'Seminar Papers', 'Post your technical papers here', '0', 4, 'pankaj'),
(4, 0, 3, '2013-04-08 09:49:29', 'b', 0, '', '', 'seminar paper available', '0', 0, 'vaibhav'),
(5, 0, 0, '2013-04-08 10:50:01', 'a', 0, 'lounge', 'ZxZx', 'zcxczxc', '0', 3, 'ravisha'),
(6, 0, 5, '2013-04-08 10:50:09', 'b', 0, '', '', 'zxcknsd,n s,n,jsnd,n s,dnksndkfnsdfsdfsd', '0', 0, 'ravisha');

-- --------------------------------------------------------

--
-- Table structure for table `forum_sections`
--

CREATE TABLE IF NOT EXISTS `forum_sections` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `ordered` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `forum_sections`
--

INSERT INTO `forum_sections` (`id`, `title`, `ordered`) VALUES
(1, 'COMPS A', 1),
(2, 'COMPS B', 2),
(3, 'lounge', 3),
(4, 'Project Buddy', 4);

-- --------------------------------------------------------

--
-- Table structure for table `friends_requests`
--

CREATE TABLE IF NOT EXISTS `friends_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mem1` int(11) NOT NULL,
  `mem2` int(11) NOT NULL,
  `timedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `friends_requests`
--

INSERT INTO `friends_requests` (`id`, `mem1`, `mem2`, `timedate`) VALUES
(1, 2, 13, '2013-04-21 18:25:12'),
(2, 2, 14, '2013-04-21 18:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `GROUP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_NAME` varchar(120) NOT NULL,
  `MEMBERS_LIST` varchar(120) NOT NULL,
  PRIMARY KEY (`GROUP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`GROUP_ID`, `GROUP_NAME`, `MEMBERS_LIST`) VALUES
(1, 'TESTGROUP2', '702,TESTGROUP2,703,707,708,709,1,Create'),
(2, 'TESTGROUP3', '702,TESTGROUP3,703,707,708,709,2,Create'),
(3, 'bev', '702,bev,703,3,Create'),
(4, 'vs', '702'),
(5, 'mmmm', '702'),
(10, 'TESTGROUP1', '702');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `IMAGE_ID` int(4) NOT NULL AUTO_INCREMENT,
  `IMAGE_NAME` varchar(10) NOT NULL,
  `IMAGE_DESCRIPTION` text NOT NULL,
  `IMAGE_UPLOAD` varchar(40) NOT NULL,
  `IMAGE_TYPE` varchar(10) NOT NULL,
  `USER_ID` int(5) NOT NULL,
  `uploader` varchar(15) NOT NULL,
  PRIMARY KEY (`IMAGE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`IMAGE_ID`, `IMAGE_NAME`, `IMAGE_DESCRIPTION`, `IMAGE_UPLOAD`, `IMAGE_TYPE`, `USER_ID`, `uploader`) VALUES
(28, 'test', 'asdasd', 'e05e181fc0e52bbeae0ad6529f256c48', 'jpeg', 703, 'vivek'),
(29, 'asda', 'asdasdasd', '992bf1086b55850a765d869604bfc3fd', 'jpeg', 707, 'vaibhav'),
(31, 'asda', 'asdasdasdasda', 'f14940c8f7e4817a426e837ac0374278', 'jpeg', 703, 'vivek'),
(32, 'sadasdaa', 'aaaaa', 'a4799c23a90241b54e0b6a55143e6d7d', 'jpeg', 703, 'vivek');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `MESSSAGE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SENDER` int(11) NOT NULL,
  `RECIPIENT` int(11) NOT NULL,
  `MESSAGE` varchar(1000) NOT NULL,
  `TIME` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`MESSSAGE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MESSSAGE_ID`, `SENDER`, `RECIPIENT`, `MESSAGE`, `TIME`) VALUES
(12, 702, 703, 'Are you sure the results are out?', '2013-03-11 04:01:42'),
(13, 702, 703, 'Check this awesome messaging feature!', '2013-04-02 09:13:32'),
(14, 707, 702, 'testing', '2013-04-03 14:09:22'),
(15, 707, 703, 'message succesfully sent', '2013-04-03 14:50:29'),
(16, 707, 703, 'no issues ?', '2013-04-03 14:59:21'),
(17, 707, 702, 'This is a big text\r\nThis is a big text\r\nThis is a big text\r\nThis is a big text\r\nThis is a big text\r\nThis is a big text\r\nThis is a big text\r\nThis is a big text\r\nThis is a big text\r\nThis is a big text\r\n', '2013-04-03 15:14:59'),
(18, 707, 702, 'test 4', '2013-04-03 15:15:56'),
(19, 707, 703, 'testing some errors', '2013-04-03 15:18:29'),
(20, 707, 703, 'last time with old css', '2013-04-03 15:22:52'),
(21, 707, 702, 'test final', '2013-04-03 15:24:46'),
(22, 707, 703, 'send on new css', '2013-04-03 15:26:58'),
(23, 707, 703, 'final on new css', '2013-04-03 15:28:11'),
(24, 707, 703, 'this is the final test for messages', '2013-04-03 16:18:58'),
(25, 702, 703, 'load testing', '2013-04-04 16:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `mymembers`
--

CREATE TABLE IF NOT EXISTS `mymembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` enum('m','f') NOT NULL DEFAULT 'm',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `sign_up_date` date NOT NULL DEFAULT '0000-00-00',
  `last_log_date` date NOT NULL DEFAULT '0000-00-00',
  `bio_body` text,
  `website` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `friend_array` text,
  `account_type` enum('a','b','c') NOT NULL DEFAULT 'a',
  `email_activated` enum('0','1') NOT NULL DEFAULT '1',
  `USER_ID` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `mymembers`
--

INSERT INTO `mymembers` (`id`, `username`, `firstname`, `lastname`, `gender`, `birthday`, `country`, `state`, `city`, `email`, `password`, `ipaddress`, `sign_up_date`, `last_log_date`, `bio_body`, `website`, `youtube`, `facebook`, `twitter`, `friend_array`, `account_type`, `email_activated`, `USER_ID`) VALUES
(1, 'admin123', '', '', 'm', '1991-01-01', '', '', '', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '::1', '2013-04-06', '2013-04-06', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 0),
(2, 'vaibhav', 'Vaibhav', 'Nachankar', 'm', '2010-01-01', '', '', '', 'vai@gmail.com', '310a87565a48526e9d096f917007dbfe', '::1', '2013-04-06', '2013-04-21', NULL, '', '', '', 'overthinker_', '3,4,5,6,7,8,9,10,11,12', 'a', '1', 707),
(3, 'vivek', 'Vivek', 'Mishra', 'm', '2010-01-01', '', '', '', 'viv@gmail.com', '061a01a98f80f415b1431236b62bb10b', '::1', '2013-04-06', '2013-04-16', NULL, NULL, NULL, NULL, NULL, '2,4', 'a', '1', 703),
(4, 'sidhesh', 'Sidhesh', 'Mhatre', 'm', '2010-01-01', '', '', '', 'sid@gmail.com', 'f0c8457561c6067321dd04cde912f83c', '::1', '2013-04-06', '2013-04-16', NULL, NULL, NULL, NULL, NULL, '3,2', 'a', '1', 702),
(5, 'atharva', 'Atharva', 'Vaidya', 'm', '2010-01-01', '', '', '', 'atharva@gmail.com', '33f4d8d0f9cdd179799fb33d3bd1e1ee', '::1', '2013-04-06', '2013-04-15', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 731),
(6, 'reema', 'Reema', 'Kuvadia', 'm', '2010-01-01', '', '', '', 'reema@gmail.com', '04f459e03003549c661afc0ef5bc37ac', '::1', '2013-04-06', '2013-04-15', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 708),
(7, 'pankaj', 'Pankaj', 'Uchil', 'm', '2010-01-01', '', '', '', 'pankz@gmail.com', '95deb5011a8fe1ccf6552bb5bcda2ff0', '::1', '2013-04-06', '2013-04-08', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 732),
(8, 'ravisha', 'Ravisha', 'Gaur', 'f', '2010-01-01', '', '', '', 'rav@gmail.com', '888fea3b81f6091f2f7faf5f7306e694', '::1', '2013-04-06', '2013-04-08', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 721),
(9, 'sidhant', 'Sidhant', 'Morajkar', 'm', '2010-01-01', '', '', '', 'mozy@gmail.com', '13cdea47a5fef8b1d79b91424aeeb2f0', '::1', '2013-04-06', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 705),
(10, 'surabhi', 'Surabhi', 'Jain', 'f', '2010-01-01', '', '', '', 'surabhi@gmail.com', 'aeb6b3ff2608256c8a0abc26acfdb70d', '::1', '2013-04-06', '2013-04-08', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 722),
(11, 'nano', 'Ankit', 'Nanavati', 'm', '2010-01-01', '', '', '', 'nano@gmail.com', '1657ec96792937f71c20c9e1bdc2300f', '::1', '2013-04-06', '2013-04-08', NULL, NULL, NULL, NULL, NULL, '', 'a', '1', 710),
(12, 'jeetyog', 'Jeetyog', 'Rangnekar', 'm', '2010-01-01', '', '', '', 'jeetyog@gmail.com', '34c151e37db58ce354917a7dcee75652', '::1', '2013-04-06', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 741),
(13, 'shristi', 'Shristi', 'Hingle', 'f', '2010-01-01', '', '', '', 'shristi@gmail.com', '3968f3bf0cc5f4f102681910939e1730', '::1', '2013-04-06', '2013-04-06', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 723),
(14, 'indranil', 'indranil', 'ghosh', 'm', '2010-01-01', '', '', '', 'indra@gmail.com', '5510cb16c54575f90289799f0a853d23', '::1', '2013-04-08', '2013-04-08', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 866),
(16, 'gulla', '', '', 'm', '1991-01-01', '', '', '', 'gulla@gmail.com', '44aeeba66bea02fb895b7f7beb06eeac', '::1', '2013-04-21', '2013-04-21', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1', 724);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `NOTICE_ID` int(11) NOT NULL,
  `NOTICE_NAME` varchar(25) NOT NULL,
  `UPLOADER_NAME` varchar(25) NOT NULL,
  `DATE_UPLOADED` datetime NOT NULL,
  `NOTICE_DESC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`NOTICE_ID`, `NOTICE_NAME`, `UPLOADER_NAME`, `DATE_UPLOADED`, `NOTICE_DESC`) VALUES
(1, 'Test notice1 1453 11 03 2', 'Sidhesh Mhatre', '2013-03-11 09:24:08', 'Test notice1 DESC 1453 11 03 2013'),
(2, '', 'Vaibhav Nachankar', '2013-04-17 21:30:55', '');

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE IF NOT EXISTS `private_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `time_sent` datetime NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `opened` enum('0','1') NOT NULL,
  `recipientDelete` enum('0','1') NOT NULL,
  `senderDelete` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `private_messages`
--

INSERT INTO `private_messages` (`id`, `to_id`, `from_id`, `time_sent`, `subject`, `message`, `opened`, `recipientDelete`, `senderDelete`) VALUES
(2, 4, 3, '2013-04-02 14:23:19', 'zxa', 'asdasd', '0', '0', '0'),
(3, 3, 4, '2013-04-02 15:09:17', 'dfgfdgdgdfg', 'dfgfd', '0', '0', '0'),
(4, 3, 4, '2013-04-02 15:20:45', 'zxczxzxcz', 'zxczxc', '0', '0', '0'),
(5, 4, 1, '2013-04-06 04:46:06', 'gdgsg', 'ggdfgdf', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `quiztab`
--

CREATE TABLE IF NOT EXISTS `quiztab` (
  `username` varchar(20) NOT NULL,
  `score` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiztab`
--

INSERT INTO `quiztab` (`username`, `score`) VALUES
('vivek', 9),
('sidhesh', 4),
('vaibhav', 4);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `BOOK_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `RATING_VALUE` int(11) NOT NULL,
  KEY `BOOK_ID` (`BOOK_ID`,`USER_ID`),
  KEY `USER_ID` (`USER_ID`),
  KEY `USER_ID_2` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`BOOK_ID`, `USER_ID`, `RATING_VALUE`) VALUES
(9, 702, 8),
(8, 702, 8),
(8, 703, 9),
(5, 702, 3),
(6, 702, 5),
(0, 702, 6),
(6, 702, 5),
(6, 702, 8),
(6, 707, 2),
(6, 707, 2),
(6, 703, 7),
(10, 707, 9),
(11, 721, 10),
(6, 707, 10);

-- --------------------------------------------------------

--
-- Table structure for table `status_comments`
--

CREATE TABLE IF NOT EXISTS `status_comments` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `comments` text NOT NULL,
  `date_created` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status_comments`
--

INSERT INTO `status_comments` (`c_id`, `comments`, `date_created`, `post_id`, `user_name`, `uid`) VALUES
(1, 'Upload it!', 1365392177, 24, 'vaibhav', 0),
(2, 'It tomorrow', 1365392227, 24, 'vivek', 0),
(3, '27th April', 1365392271, 25, 'vivek', 0),
(4, 'AWWWWWWWW', 1365398131, 27, 'ravisha', 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_posts`
--

CREATE TABLE IF NOT EXISTS `status_posts` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `post` varchar(100) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `date_created` int(11) NOT NULL,
  `USER_ID` int(5) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `status_posts`
--

INSERT INTO `status_posts` (`p_id`, `post`, `user_name`, `date_created`, `USER_ID`) VALUES
(24, 'Exam timetable out!!!!', 'vivek', 1362994220, 703),
(25, 'When is convocation?', 'vaibhav', 1365392193, 707),
(26, 'All the best for vivas', 'vivek', 1365392248, 703),
(27, 'in reltionship with kandoi', 'nano', 1365395263, 710),
(29, 'This is sidhesh status', 'sidhesh', 1366040635, 702),
(30, 'This is atharva''s status', 'atharva', 1366041116, 731),
(31, 'this is atharva''s second status', 'atharva', 1366041354, 731),
(32, 'reema''s status', 'reema', 1366041505, 708);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `SUBJECT_ID` int(11) NOT NULL,
  `SUBJECT_NAME` varchar(40) NOT NULL,
  `SUBJECT_DESC` longtext NOT NULL,
  `SUBJECT_ABBR` varchar(8) NOT NULL,
  `SUBJECT_YEAR` int(11) NOT NULL,
  PRIMARY KEY (`SUBJECT_ABBR`),
  KEY `SUBJECT_YEAR` (`SUBJECT_YEAR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SUBJECT_ID`, `SUBJECT_NAME`, `SUBJECT_DESC`, `SUBJECT_ABBR`, `SUBJECT_YEAR`) VALUES
(39, 'ADVANCE COMPUTER NETWORK', '0', 'ACN', 3),
(37, 'ADVANCE MICROPROCESSOR', '0', 'AMP', 3),
(45, 'Chemistry 1', '0', 'CHEM1', 1),
(46, 'Chemistry 2', '0', 'CHEM2', 1),
(53, 'Communication Skills', '0', 'CS', 1),
(43, 'DIGITAL SIGNAL AND IMAGE PROCESSING', '0', 'DSIP', 4),
(38, 'DATA WAREHOUSE AND MINING', '0', 'DWM', 3),
(49, 'Math 1', '0', 'MATH1', 1),
(50, 'Math 2', '0', 'MATH2', 1),
(51, 'Math 3', '0', 'MATH3', 2),
(52, 'Math 4', '0', 'MATH4', 2),
(44, 'MOBILE COMPUTING', '0', 'MC', 4),
(47, 'Physics 1', '0', 'PHY1', 1),
(48, 'Physics 2', '0', 'PHY2', 1),
(41, 'ROBOTICS AND ARTIFICIAL INTELLIGENCE', '0', 'RAI', 4),
(40, 'SOFT COMPUTING', '0', 'SC', 4),
(36, 'SYSTEM PROGRAMS AND COMPILER C', '0', 'SPCC', 3),
(42, 'SYSTEM SECURITY', '0', 'SS', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subject_attendance`
--

CREATE TABLE IF NOT EXISTS `subject_attendance` (
  `USER_ID` int(11) NOT NULL,
  `SPCC` int(11) NOT NULL DEFAULT '0',
  `ACN` int(11) NOT NULL DEFAULT '0',
  `AMP` int(11) NOT NULL DEFAULT '0',
  `CHEM1` int(11) NOT NULL DEFAULT '0',
  `CHEM2` int(11) NOT NULL DEFAULT '0',
  `CS` int(11) NOT NULL DEFAULT '0',
  `DSIP` int(11) NOT NULL DEFAULT '0',
  `DWM` int(11) NOT NULL DEFAULT '0',
  `MATH1` int(11) NOT NULL DEFAULT '0',
  `MATH2` int(11) NOT NULL DEFAULT '0',
  `MATH3` int(11) NOT NULL DEFAULT '0',
  `MATH4` int(11) NOT NULL DEFAULT '0',
  `MC` int(11) NOT NULL DEFAULT '0',
  `PHY1` int(11) NOT NULL DEFAULT '0',
  `PHY2` int(11) NOT NULL DEFAULT '0',
  `RAI` int(11) NOT NULL DEFAULT '0',
  `SC` int(11) NOT NULL DEFAULT '0',
  `SS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`USER_ID`),
  KEY `SPCC` (`SPCC`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_attendance`
--

INSERT INTO `subject_attendance` (`USER_ID`, `SPCC`, `ACN`, `AMP`, `CHEM1`, `CHEM2`, `CS`, `DSIP`, `DWM`, `MATH1`, `MATH2`, `MATH3`, `MATH4`, `MC`, `PHY1`, `PHY2`, `RAI`, `SC`, `SS`) VALUES
(702, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0),
(703, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(707, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 4, 0, 0, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `test1`
--

CREATE TABLE IF NOT EXISTS `test1` (
  `rno` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test1`
--

INSERT INTO `test1` (`rno`, `name`) VALUES
(1, 'sidhesh'),
(2, 'vivek'),
(3, 'mozzy'),
(4, 'nacho'),
(5, 'nana');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(11) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `SID` varchar(50) NOT NULL,
  `FIRST_NAME` varchar(15) NOT NULL,
  `LAST_NAME` varchar(15) NOT NULL,
  `LOGGED_IN` int(1) NOT NULL DEFAULT '0',
  `GROUP_MEMBERSHIP` varchar(45) NOT NULL,
  `PRIVILEGE_LEVEL` int(1) NOT NULL,
  `SUBJECTS` varchar(40) NOT NULL,
  `YEAR` int(11) NOT NULL,
  `style` varchar(30) NOT NULL DEFAULT 'style.css',
  `gender` enum('M','F') NOT NULL,
  `birthday` date NOT NULL,
  `country` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `sign_up_date` date NOT NULL,
  `last_log_date` date NOT NULL,
  `bio_body` text NOT NULL,
  `facebook` varchar(20) NOT NULL,
  `twitter` varchar(20) NOT NULL,
  `friend_array` text NOT NULL,
  `youtube` varchar(20) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  PRIMARY KEY (`USER_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `USERNAME`, `PASSWORD`, `SID`, `FIRST_NAME`, `LAST_NAME`, `LOGGED_IN`, `GROUP_MEMBERSHIP`, `PRIVILEGE_LEVEL`, `SUBJECTS`, `YEAR`, `style`, `gender`, `birthday`, `country`, `state`, `city`, `email`, `ipaddress`, `sign_up_date`, `last_log_date`, `bio_body`, `facebook`, `twitter`, `friend_array`, `youtube`, `account_type`) VALUES
(0, 'admin123', '0192023a7bbd73250516f069df18b500', '9ab31f0267e21177628c2412d086e1cf', '', '', 0, '', 1, '', 0, 'style.css', 'M', '1991-01-01', '', '', '', 'admin@gmail.com', '::1', '2013-04-06', '0000-00-00', '', '', '', '', '', ''),
(702, 'sidhesh', 'f0c8457561c6067321dd04cde912f83c', 'b335fbe034fc1489948c127a84be911d', 'Sidhesh', 'Mhatre', 0, '', 1, 'DSIP,MC,RAI,SC,SS,', 4, 'skins/Town.css', 'M', '0000-00-00', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', ''),
(703, 'vivek', '061a01a98f80f415b1431236b62bb10b', '5d0aaad7a19757c12d65d0246118334a', 'Vivek', 'Mishra', 1, '', 1, '', 4, 'skins/Arsenal.css', 'M', '0000-00-00', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', ''),
(705, 'sidhant', '13cdea47a5fef8b1d79b91424aeeb2f0', '', 'Sidhant', 'Morajkar', 0, '', 0, '', 0, 'style.css', 'M', '2010-01-01', '', '', '', 'mozy@gmail.com', '::1', '2013-04-06', '0000-00-00', '', '', '', '', '', ''),
(707, 'vaibhav', '310a87565a48526e9d096f917007dbfe', '580b96c8abd2b2a017a20770e529ea77', 'Vaibhav', 'Nachankar', 1, '', 1, 'MC,RAI,SS,DSIP,SC,', 4, 'skins/Night.css', 'M', '0000-00-00', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', ''),
(708, 'reema', '04f459e03003549c661afc0ef5bc37ac', 'eb530a0abb50dba7cf16ca97c04dc0ce', 'Reema', 'Kuvadia', 1, '', 0, '', 4, 'style.css', 'F', '0000-00-00', '', '', '', 'reema@gmail.com', '', '0000-00-00', '0000-00-00', '', '', '', '', '', ''),
(710, 'nano', '1657ec96792937f71c20c9e1bdc2300f', '596dc5e078dc7c861ff69e276525b42a', 'Nano', 'Nanavaty', 0, '', 0, '', 0, 'style.css', 'M', '2010-01-01', '', '', '', 'nano@gmail.com', '::1', '2013-04-06', '0000-00-00', '', '', '', '', '', ''),
(721, 'ravisha', '888fea3b81f6091f2f7faf5f7306e694', '2624d30512a1c196afa4a3cdf1f78945', 'Ravisha', 'Gaur', 0, '', 0, '', 0, 'style.css', 'F', '2010-01-01', '', '', '', 'rav@gmail.com', '::1', '2013-04-06', '0000-00-00', '', '', '', '', '', ''),
(722, 'surabhi', 'aeb6b3ff2608256c8a0abc26acfdb70d', '5be951bc5570155b0954ff3116e1c497', 'Surbhi', 'Jain', 0, '', 0, '', 0, 'style.css', 'F', '2010-01-01', '', '', '', 'surabhi@gmail.com', '::1', '2013-04-06', '0000-00-00', '', '', '', '', '', ''),
(723, 'shristi', '3968f3bf0cc5f4f102681910939e1730', '17895aff678e8233e6369d5ac22936f6', 'Shristi', 'Hingle', 1, '', 0, '', 0, 'style.css', 'F', '2010-01-01', '', '', '', 'shristi@gmail.com', '::1', '2013-04-06', '0000-00-00', '', '', '', '', '', ''),
(724, 'gulla', '44aeeba66bea02fb895b7f7beb06eeac', '74ada6f7646bba9800fd83c595084d7f', '', '', 0, '', 0, '', 0, 'style.css', 'M', '1991-01-01', '', '', '', 'gulla@gmail.com', '::1', '2013-04-21', '0000-00-00', '', '', '', '', '', ''),
(731, 'atharva', '33f4d8d0f9cdd179799fb33d3bd1e1ee', 'da6b3707702e0e74209a32a35d767ae1', 'Atharva', 'Vaidya', 0, '', 0, '', 4, 'skins/Green_Abstract.css', 'M', '1991-03-06', '', '', '', 'atharva@gmail.com', '::1', '2013-04-06', '0000-00-00', '', '', '', '', '', ''),
(732, 'pankaj', '95deb5011a8fe1ccf6552bb5bcda2ff0', 'd8e652be351d8358ce680371461b5cae', 'Pankaj', 'Uchil', 0, '', 0, '', 0, 'style.css', 'M', '2010-01-01', '', '', '', 'pankz@gmail.com', '::1', '2013-04-06', '0000-00-00', '', '', '', '', '', ''),
(741, 'jeetyog', '34c151e37db58ce354917a7dcee75652', '', 'Jeetyog', 'Ragnekar', 0, '', 0, '', 0, 'style.css', 'M', '2010-01-01', '', '', '', 'jeetyog@gmail.com', '::1', '2013-04-06', '0000-00-00', '', '', '', '', '', ''),
(866, 'indranil', '5510cb16c54575f90289799f0a853d23', '35122f0c3075dce638cedf4d658b5153', 'Indranil', 'Ghosh', 0, '', 0, '', 0, 'style.css', 'M', '2010-01-01', '', '', '', 'indra@gmail.com', '::1', '2013-04-08', '0000-00-00', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE IF NOT EXISTS `year` (
  `YEAR_ID` int(11) NOT NULL,
  `YEAR_NAME` varchar(10) NOT NULL,
  PRIMARY KEY (`YEAR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`YEAR_ID`, `YEAR_NAME`) VALUES
(1, 'FE'),
(2, 'SE'),
(3, 'TE'),
(4, 'BE');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dev`
--
ALTER TABLE `dev`
  ADD CONSTRAINT `dev_ibfk_1` FOREIGN KEY (`BOOK_ID_1`) REFERENCES `bookinfo` (`BOOK_ID`),
  ADD CONSTRAINT `dev_ibfk_2` FOREIGN KEY (`BOOK_ID_2`) REFERENCES `bookinfo` (`BOOK_ID`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`SUBJECT_YEAR`) REFERENCES `year` (`YEAR_ID`);

--
-- Constraints for table `subject_attendance`
--
ALTER TABLE `subject_attendance`
  ADD CONSTRAINT `subject_attendance_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
