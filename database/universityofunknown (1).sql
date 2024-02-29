-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 06:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universityofunknown`
--

-- --------------------------------------------------------

--
-- Table structure for table `clubmembers`
--

CREATE TABLE `clubmembers` (
  `ClubID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `StudentName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubmembers`
--

INSERT INTO `clubmembers` (`ClubID`, `StudentID`, `StudentName`) VALUES
(9, 2, 'peter son'),
(10, 1234, 'John'),
(11, 1, 'james'),
(15, 22, 'Alex Thompson'),
(20, 2, 'ako si hehe');

-- --------------------------------------------------------

--
-- Table structure for table `clubofficers`
--

CREATE TABLE `clubofficers` (
  `ClubID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `StudentName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubofficers`
--

INSERT INTO `clubofficers` (`ClubID`, `StudentID`, `Position`, `StudentName`) VALUES
(1, 1, 'President', 'Alex Thompson'),
(1, 2, 'Vice President', 'Emily Rodriguez'),
(1, 3, 'Secretary', 'Ryan Mitchell'),
(1, 4, 'Treasurer', 'Jessica Carter'),
(2, 8, 'President', 'Sophia Lee'),
(2, 9, 'Vice President', 'Liam Davis'),
(2, 10, 'Secretary', 'Zoey Adams'),
(2, 11, 'Treasurer', 'Noah Garcia'),
(3, 15, 'President', 'Benjamin Cooper'),
(3, 17, 'Secretary', 'Caleb Martinez'),
(3, 18, 'Treasurer', 'Lily Johnson'),
(9, 31, 'President', 'ako si batman');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `ClubID` int(11) NOT NULL,
  `ClubLogo` varchar(255) NOT NULL,
  `ClubName` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`ClubID`, `ClubLogo`, `ClubName`, `Status`) VALUES
(1, '', 'Science Club', 0),
(2, '', 'Chess Club', 0),
(3, '', 'Debate Club', 0),
(4, '', 'Art Club', 0),
(5, '', 'Music Clubb', 0),
(6, '', 'Drama Club', 0),
(7, '', 'PGITS Club', 0),
(8, '', 'GMITS Club', 0),
(9, '', 'PSITS Club', 0),
(10, '', 'Robotics Club', 0),
(11, '', 'Literature Club', 0),
(12, '', 'Film Club', 0),
(13, '', 'Math Club', 0),
(14, '', 'Sports Club', 0),
(15, '', 'Cooking Club', 0),
(16, '', 'Astronomy Club', 0),
(17, '', 'Dance Club', 0),
(18, '', 'Photography Club', 0),
(19, '', 'Volunteer Club', 0),
(20, '', 'Foreign Language Club', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clubmembers`
--
ALTER TABLE `clubmembers`
  ADD PRIMARY KEY (`ClubID`,`StudentID`);

--
-- Indexes for table `clubofficers`
--
ALTER TABLE `clubofficers`
  ADD PRIMARY KEY (`ClubID`,`StudentID`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`ClubID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clubofficers`
--
ALTER TABLE `clubofficers`
  ADD CONSTRAINT `clubofficers_ibfk_1` FOREIGN KEY (`ClubID`) REFERENCES `clubs` (`ClubID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
