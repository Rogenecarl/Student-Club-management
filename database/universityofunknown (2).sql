-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 09:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `ClubPicture` varchar(200) NOT NULL,
  `ClubName` varchar(255) NOT NULL,
  `Status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`ClubID`, `ClubPicture`, `ClubName`, `Status`) VALUES
(1, '', 'Science Club', ''),
(2, 'uploads/club2_chess.jpg', 'Chess Club', ''),
(3, '', 'Debate Club', ''),
(4, '', 'Art Club', ''),
(5, '', 'Music Clubb', ''),
(6, '', 'Drama Club', ''),
(7, '', 'PGITS Club', ''),
(8, '', 'GMITS Club', ''),
(9, '', 'PSITS Club', ''),
(10, '', 'Robotics Club', ''),
(11, '', 'Literature Club', ''),
(12, '', 'Film Club', ''),
(13, '', 'Math Club', ''),
(14, '', 'Sports Club', ''),
(15, '', 'Cooking Club', ''),
(16, '', 'Astronomy Club', ''),
(17, '', 'Dance Club', ''),
(18, '', 'Photography Club', ''),
(19, '', 'Volunteer Club', ''),
(20, '', 'Foreign Language Club', '');

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
