-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2019 at 12:56 PM
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
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `room_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(8, 1, 'Opt-in for room 1 by user 8'),
(8, 2, 'Opt-in for room 2 by user 8');

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
(9);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street_number` int(11) NOT NULL,
  `addition` varchar(255) DEFAULT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `owner_id`, `city`, `postal_code`, `street`, `street_number`, `addition`, `size`, `type`, `price`, `description`) VALUES
(1, 9, 'Groningen', '1234GR', 'Herestraat', 1, NULL, 25, 'studio', 500, 'Ruime studio in het centrum van Groningen.'),
(2, 9, 'Klijndijk', '1234KL', 'Melkweg', 2, 'B', 100, 'flatwoning', 600, 'Ruime woning op de 40ste etage in de gloednieuwe flat in klijndijk.'),
(3, 9, 'Randwijk', '1234RA', 'Bredeweg', 3, NULL, 200, 'stal', 20, 'Ruime woning, landelijk gelegen.');

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
(8);

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
(8, 'testu', '$2y$10$DzqLKz8FRxpt7jfBwu3m0.mgH6m8xCeqlPv/srJTBvS3AFUlcNg9C', 'First', 'Last', 'test@test.com', '0612345678', '2018-12-01', 'Dutch', 'Student Information Science', 'sumthn bout mself'),
(9, 'testo', '$2y$10$0GclR4tLEEwiaO0AqHlej.382.7WbAjqJogNcRwl5bzZiQTHgvOVu', 'First', 'Last', 'testo@test.nl', '0623456789', '2019-01-10', 'Italian', 'house owner', 'hahahaha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `optin`
--
ALTER TABLE `optin`
  ADD PRIMARY KEY (`tenant_id`,`room_id`),
  ADD KEY `room_id` (`room_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `optin`
--
ALTER TABLE `optin`
  ADD CONSTRAINT `optin_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `optin_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

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
