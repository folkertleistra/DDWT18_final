-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2018 at 08:18 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ddwt18_final`
--
CREATE DATABASE IF NOT EXISTS `ddwt18_final` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ddwt18_final`;

-- --------------------------------------------------------

--
-- Table structure for table `optin`
--

CREATE TABLE `optin` (
  `tenant_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `optin`
--

INSERT INTO `optin` (`tenant_id`, `room_id`, `message`) VALUES
(3, 1, 'Aanmelding tenant3 voor kamer 1.'),
(4, 2, 'Aanmelding tenant4 voor kamer 2.'),
(4, 3, 'Aanmelding tenant4 voor kamer 3.');

-- --------------------------------------------------------

--
-- Table structure for table `own`
--

CREATE TABLE `own` (
  `room_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `own`
--

INSERT INTO `own` (`room_id`, `owner_id`) VALUES
(1, 1),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street_number` int(11) NOT NULL,
  `addition` varchar(255) DEFAULT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `city`, `postal_code`, `street`, `street_number`, `addition`, `size`, `type`, `price`, `description`, `image`) VALUES
(1, 'Groningen', '1234GR', 'Herestraat', 1, NULL, 25, 'studio', 500, 'Ruime studio in het centrum van Groningen.', NULL),
(2, 'Klijndijk', '1234KL', 'Melkweg', 2, 'B', 100, 'flatwoning', 600, 'Ruime woning op de 40ste etage in de gloednieuwe flat in klijndijk.', NULL),
(3, 'Randwijk', '1234RA', 'Bredeweg', 3, NULL, 200, 'stal', 20, 'Ruime woning, landelijk gelegen.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tenant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenant_id`) VALUES
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `language` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `biography` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `phone`, `birthdate`, `language`, `occupation`, `biography`) VALUES
(1, 'testowner1', 'test', 'firstname1', 'lastname1', 'test1@test.com', '1234567890', '2000-01-01', 'English', 'bus driver', 'This is the test1 account for owners.'),
(2, 'testowner2', 'test', 'firstname2', 'lastname2', 'test2@test.com', '2345678901', '2000-01-02', 'Dutch', 'farmer', 'This is the test2 account for owners.'),
(3, 'testtenant3', 'test', 'firstname3', 'lastname3', 'test3@test.com', '3456789012', '2000-01-03', 'German', 'student Information Sciences', 'This is the test3 account for tenants.'),
(4, 'testtenant4', 'test', 'firstname4', 'lastname4', 'test4@test.com', '4567890123', '2000-01-04', 'French', 'student Psychology', 'This is the test4 account for tenants.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `optin`
--
ALTER TABLE `optin`
  ADD PRIMARY KEY (`tenant_id`,`room_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `own`
--
ALTER TABLE `own`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `optin`
--
ALTER TABLE `optin`
  ADD CONSTRAINT `optin_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `optin_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `own`
--
ALTER TABLE `own`
  ADD CONSTRAINT `own_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `own_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `tenant_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
