-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 18, 2022 at 08:15 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_exam_db`
--
CREATE DATABASE IF NOT EXISTS `php_exam_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `php_exam_db`;

-- --------------------------------------------------------

--
-- Table structure for table `Articles`
--

CREATE TABLE `Articles` (
  `ID` int(11) NOT NULL,
  `title` char(255) NOT NULL,
  `description` char(255) NOT NULL,
  `date` date NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Articles`
--

INSERT INTO `Articles` (`ID`, `title`, `description`, `date`, `author`) VALUES
(1, 'Salam papa', 'Voici un article qui parle de plein de choses divertissantes...', '2022-01-05', 5),
(4, 'Salam pas', 'zdzdzd', '2022-01-16', 4),
(5, 'salemddddd', 'zpdkofhzohizf', '2022-01-16', 6);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL,
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `username`, `password`, `email`, `admin`) VALUES
(4, 'Ruby', 'e93e24c1b877a15df5e4a8cbb20f351b891b750779cf5e8fb99119a7142d89cf', 'ruby@gmail.com', 0),
(5, 'enzx', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 'enzx@gmail.com', 1),
(6, 'Raf', 'a3ee9d88c3e0ee59bdc9dfe051e18d2d5d38ac0eda8f804f50226bdef4a78848', 'rafadkdakdad', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Articles`
--
ALTER TABLE `Articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
