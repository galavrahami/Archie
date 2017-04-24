-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2017 at 08:43 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ArchieUpdated`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `Category_ID` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`Category_ID`, `category_name`, `parent_id`) VALUES
(1, 'Art', NULL),
(2, 'Religion', NULL),
(3, 'Sport', NULL),
(4, 'Music', 1),
(5, 'Judaism', 2),
(6, 'Animals', NULL),
(7, 'Holiday', NULL),
(8, 'Alert', NULL),
(9, '', NULL),
(10, 'History', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Document_id` int(11) NOT NULL,
  `Category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Document_id`, `Category_id`) VALUES
(1, 4),
(2, 6),
(3, 7),
(4, 8),
(5, 9),
(7, 10),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `Picture_file` text,
  `Text_file` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `page`, `Picture_file`, `Text_file`) VALUES
(2, 1, '/Users/galavrahami/PhpstormProjects/ARCHIE/2', NULL),
(3, 0, '/Users/galavrahami/PhpstormProjects/ARCHIE/Screen Shot 2017-04-09 at 2.29.38 PM.png', NULL),
(3, 1, '/Users/galavrahami/PhpstormProjects/ARCHIE/Screen Shot 2017-04-11 at 5.35.32 PM.png', NULL),
(4, 0, '/Users/galavrahami/PhpstormProjects/ARCHIE/document-picture_file.png', NULL),
(5, 0, '/tmp', NULL),
(7, 0, '/tmpArchiePic.jpeg', NULL),
(8, 0, '/tmparchie2.jpeg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `Document_id` int(11) NOT NULL,
  `keyword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`Document_id`, `keyword`) VALUES
(1, 'Hebrew'),
(1, 'key1'),
(1, 'key2'),
(1, 'key3'),
(1, 'testfromhere'),
(2, 'Cat'),
(2, 'Dog'),
(2, 'Pig'),
(3, 'Easter'),
(3, 'Passover'),
(4, 'Alert'),
(5, ''),
(7, 'Dog'),
(8, 'color'),
(8, 'Red');

-- --------------------------------------------------------

--
-- Table structure for table `mainartifact`
--

CREATE TABLE `mainartifact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT '0001-01-17',
  `Updater_Name` varchar(50) DEFAULT NULL,
  `Author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mainartifact`
--

INSERT INTO `mainartifact` (`id`, `name`, `date`, `Updater_Name`, `Author`) VALUES
(1, 'A Hebrew Typewriter', '1898-02-04', 'ManagerUser', 'The Jewish World'),
(2, 'TestTest', '0000-00-00', 'ManagerUser', 'Author'),
(3, 'TestFiles', '2017-11-04', 'ManagerUser', 'Author'),
(4, 'TestOnlyOneKeywordAndAlert', '2015-04-04', 'ManagerUser', 'Author'),
(5, 'TestDate', '0000-00-00', 'ManagerUser', 'Michael'),
(7, 'TestDate2', '0000-00-00', 'ManagerUser', 'Author2'),
(8, 'Testdate3', '2017-04-13', 'ManagerUser', 'agasd');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `user_name`, `password`, `role`, `mail`) VALUES
('Name2', 'ManagerUser', 'Pass123', 'ManagerUser@gmail.com', 'Manager'),
('Name', 'Username', 'Password123', 'Researcher', 'Username@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`Category_ID`),
  ADD KEY `Parent_id` (`parent_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Document_id`,`Category_id`),
  ADD KEY `Category_id` (`Category_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`,`page`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`Document_id`,`keyword`);

--
-- Indexes for table `mainartifact`
--
ALTER TABLE `mainartifact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Updater_Name` (`Updater_Name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_name`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `name_2` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `mainartifact`
--
ALTER TABLE `mainartifact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `catalog`
--
ALTER TABLE `catalog`
  ADD CONSTRAINT `catalog_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `catalog` (`Category_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`Document_id`) REFERENCES `mainartifact` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_2` FOREIGN KEY (`Category_id`) REFERENCES `catalog` (`Category_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`id`) REFERENCES `mainartifact` (`id`);

--
-- Constraints for table `keywords`
--
ALTER TABLE `keywords`
  ADD CONSTRAINT `keywords_ibfk_1` FOREIGN KEY (`Document_id`) REFERENCES `mainartifact` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `mainartifact`
--
ALTER TABLE `mainartifact`
  ADD CONSTRAINT `UsernameFK` FOREIGN KEY (`Updater_Name`) REFERENCES `user` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
