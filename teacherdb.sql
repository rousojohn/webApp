-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2014 at 05:27 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `teacherdb`
--
CREATE DATABASE IF NOT EXISTS `teacherdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `teacherdb`;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `office_hours`
--

DROP TABLE IF EXISTS `office_hours`;
CREATE TABLE IF NOT EXISTS `office_hours` (
  `office` varchar(50) COLLATE utf8_bin NOT NULL,
  `day` int(11) NOT NULL,
  `hour_from` time NOT NULL,
  `hour_to` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_about`
--

DROP TABLE IF EXISTS `tbl_about`;
CREATE TABLE IF NOT EXISTS `tbl_about` (
  `about` text COLLATE utf8_bin,
  `photo` text CHARACTER SET utf16 COLLATE utf16_bin,
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addresses`
--

DROP TABLE IF EXISTS `tbl_addresses`;
CREATE TABLE IF NOT EXISTS `tbl_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(100) COLLATE utf8_bin NOT NULL,
  `primary_address` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_bin NOT NULL,
  `postal_code` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_certifications`
--

DROP TABLE IF EXISTS `tbl_certifications`;
CREATE TABLE IF NOT EXISTS `tbl_certifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `authority` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `link` text COLLATE utf8_bin,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `does_not_expire` tinyint(1) DEFAULT NULL,
  `licenseno` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

DROP TABLE IF EXISTS `tbl_company`;
CREATE TABLE IF NOT EXISTS `tbl_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin,
  `phone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `link` text COLLATE utf8_bin,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

DROP TABLE IF EXISTS `tbl_courses`;
CREATE TABLE IF NOT EXISTS `tbl_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `review` text COLLATE utf8_bin NOT NULL,
  `courses_from` date NOT NULL,
  `courses_to` date DEFAULT NULL,
  `courses_current` tinyint(1) NOT NULL,
  `co_teachers` text COLLATE utf8_bin,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `school_id` (`school_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_degree`
--

DROP TABLE IF EXISTS `tbl_degree`;
CREATE TABLE IF NOT EXISTS `tbl_degree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_education`
--

DROP TABLE IF EXISTS `tbl_education`;
CREATE TABLE IF NOT EXISTS `tbl_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attended_from` date NOT NULL,
  `attended_to` date DEFAULT NULL,
  `current_education` tinyint(1) NOT NULL,
  `fieldOfStudy` text COLLATE utf8_bin NOT NULL,
  `grade` float DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `degree_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `school_id` (`school_id`),
  KEY `degree_id` (`degree_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emails`
--

DROP TABLE IF EXISTS `tbl_emails`;
CREATE TABLE IF NOT EXISTS `tbl_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `primary_mail` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_honors_awards`
--

DROP TABLE IF EXISTS `tbl_honors_awards`;
CREATE TABLE IF NOT EXISTS `tbl_honors_awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `issuer` text COLLATE utf8_bin,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_interests`
--

DROP TABLE IF EXISTS `tbl_interests`;
CREATE TABLE IF NOT EXISTS `tbl_interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_languages`
--

DROP TABLE IF EXISTS `tbl_languages`;
CREATE TABLE IF NOT EXISTS `tbl_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `level_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level_id` (`level_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_levels`
--

DROP TABLE IF EXISTS `tbl_levels`;
CREATE TABLE IF NOT EXISTS `tbl_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

DROP TABLE IF EXISTS `tbl_news`;
CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8_bin,
  `file` text COLLATE utf8_bin,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organizations`
--

DROP TABLE IF EXISTS `tbl_organizations`;
CREATE TABLE IF NOT EXISTS `tbl_organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `position` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `current_position` tinyint(1) NOT NULL,
  `description` text COLLATE utf8_bin,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personaldata`
--

DROP TABLE IF EXISTS `tbl_personaldata`;
CREATE TABLE IF NOT EXISTS `tbl_personaldata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `surname` varchar(100) COLLATE utf8_bin NOT NULL,
  `birthdate` date DEFAULT NULL,
  `IM` text COLLATE utf8_bin,
  `title` text COLLATE utf8_bin,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phones`
--

DROP TABLE IF EXISTS `tbl_phones`;
CREATE TABLE IF NOT EXISTS `tbl_phones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects_research`
--

DROP TABLE IF EXISTS `tbl_projects_research`;
CREATE TABLE IF NOT EXISTS `tbl_projects_research` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `current_project` tinyint(1) NOT NULL,
  `team_members` text COLLATE utf8_bin,
  `link` text COLLATE utf8_bin,
  `company_id` int(11) DEFAULT NULL,
  `education_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `education_id` (`education_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_publications`
--

DROP TABLE IF EXISTS `tbl_publications`;
CREATE TABLE IF NOT EXISTS `tbl_publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `link` text COLLATE utf8_bin,
  `publisher` text COLLATE utf8_bin,
  `authors` text COLLATE utf8_bin,
  `description` text COLLATE utf8_bin,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school`
--

DROP TABLE IF EXISTS `tbl_school`;
CREATE TABLE IF NOT EXISTS `tbl_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin,
  `phone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `link` text COLLATE utf8_bin,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workingexperience`
--

DROP TABLE IF EXISTS `tbl_workingexperience`;
CREATE TABLE IF NOT EXISTS `tbl_workingexperience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_bin NOT NULL,
  `timeperiod_from` date NOT NULL,
  `timeperiod_to` date DEFAULT NULL,
  `current_job` tinyint(1) NOT NULL,
  `description` text COLLATE utf8_bin,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `office_hours`
--
ALTER TABLE `office_hours`
  ADD CONSTRAINT `office_hours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_addresses`
--
ALTER TABLE `tbl_addresses`
  ADD CONSTRAINT `tbl_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_certifications`
--
ALTER TABLE `tbl_certifications`
  ADD CONSTRAINT `tbl_certifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD CONSTRAINT `tbl_company_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD CONSTRAINT `tbl_courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_courses_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`);

--
-- Constraints for table `tbl_education`
--
ALTER TABLE `tbl_education`
  ADD CONSTRAINT `tbl_education_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`),
  ADD CONSTRAINT `tbl_education_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_education_ibfk_3` FOREIGN KEY (`degree_id`) REFERENCES `tbl_degree` (`id`);

--
-- Constraints for table `tbl_emails`
--
ALTER TABLE `tbl_emails`
  ADD CONSTRAINT `tbl_emails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_honors_awards`
--
ALTER TABLE `tbl_honors_awards`
  ADD CONSTRAINT `tbl_honors_awards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_interests`
--
ALTER TABLE `tbl_interests`
  ADD CONSTRAINT `tbl_interests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_languages`
--
ALTER TABLE `tbl_languages`
  ADD CONSTRAINT `tbl_languages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_languages_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `tbl_levels` (`id`);

--
-- Constraints for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD CONSTRAINT `tbl_news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_organizations`
--
ALTER TABLE `tbl_organizations`
  ADD CONSTRAINT `tbl_organizations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_personaldata`
--
ALTER TABLE `tbl_personaldata`
  ADD CONSTRAINT `tbl_personaldata_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_phones`
--
ALTER TABLE `tbl_phones`
  ADD CONSTRAINT `tbl_phones_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_projects_research`
--
ALTER TABLE `tbl_projects_research`
  ADD CONSTRAINT `tbl_projects_research_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company` (`id`),
  ADD CONSTRAINT `tbl_projects_research_ibfk_2` FOREIGN KEY (`education_id`) REFERENCES `tbl_education` (`id`),
  ADD CONSTRAINT `tbl_projects_research_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_publications`
--
ALTER TABLE `tbl_publications`
  ADD CONSTRAINT `tbl_publications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_school`
--
ALTER TABLE `tbl_school`
  ADD CONSTRAINT `tbl_school_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_workingexperience`
--
ALTER TABLE `tbl_workingexperience`
  ADD CONSTRAINT `tbl_workingexperience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_workingexperience_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `tbl_company` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
