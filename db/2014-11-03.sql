-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2014 at 10:24 PM
-- Server version: 5.5.40-0+wheezy1
-- PHP Version: 5.4.4-14+deb7u14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `kcms_articles`
--

CREATE TABLE IF NOT EXISTS `kcms_articles` (
`id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `hidden` int(11) NOT NULL,
  `publish_from` int(11) NOT NULL,
  `publish_to` int(11) NOT NULL,
  `last_edit` int(11) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kcms_articles`
--

INSERT INTO `kcms_articles` (`id`, `alias`, `title`, `body`, `hidden`, `publish_from`, `publish_to`, `last_edit`, `added`) VALUES
(1, 'example-article', 'Example Article', '<p>This is an example article huh?</p>', 0, 0, 0, 0, 0),
(2, 'second-example', 'Second Example', '<p>This would be a second example article, which obviously is pretty cool!</p>', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kcms_pages`
--

CREATE TABLE IF NOT EXISTS `kcms_pages` (
`id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `hidden` int(11) NOT NULL,
  `last_edit` int(11) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kcms_pages`
--

INSERT INTO `kcms_pages` (`id`, `alias`, `title`, `body`, `hidden`, `last_edit`, `added`) VALUES
(1, '', 'Example page', '<p>This is an example page. Awesome huh?</p>', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kcms_settings`
--

CREATE TABLE IF NOT EXISTS `kcms_settings` (
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kcms_settings`
--

INSERT INTO `kcms_settings` (`key`, `value`) VALUES
('frontpage_type', 'articles'),
('articles_per_page', '10'),
('date_format', 'Y-m-d H:i:s');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kcms_articles`
--
ALTER TABLE `kcms_articles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kcms_pages`
--
ALTER TABLE `kcms_pages`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kcms_articles`
--
ALTER TABLE `kcms_articles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kcms_pages`
--
ALTER TABLE `kcms_pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
