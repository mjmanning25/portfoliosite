-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2019 at 07:09 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `uid` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date` datetime NOT NULL,
  `hide` tinyint(1) NOT NULL,
  `priority` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`uid`, `title`, `description`, `date`, `hide`, `priority`) VALUES
(6, 'low', 'low test', '2019-09-13 18:24:28', 1, 0),
(7, 'med', 'med test', '2019-09-13 18:24:37', 1, 1),
(8, 'high', 'high test', '2019-09-13 18:24:53', 1, 2),
(9, 'not hidden', 'dont click done', '2019-09-13 22:21:41', 1, 2),
(10, 'test', 'asdf', '2019-09-13 22:27:41', 1, 2),
(11, 'high', 'memes', '2019-09-13 22:42:03', 1, 2),
(12, 'high', 'sghasd', '2019-09-13 23:18:37', 1, 2),
(13, 'hello', 'test 1', '2019-09-14 10:34:54', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
