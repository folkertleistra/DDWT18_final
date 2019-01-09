-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2019 at 02:34 PM
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
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `optin`
--

INSERT INTO `optin` (`tenant_id`, `room_id`, `message`) VALUES
(17, 28, 'This room seems like the perfect place for me to live, because it is so close to my school. I would love to stay there.'),
(17, 29, 'This room is perfect for me, because my work is nearby. I am a quiet tenant, so I won\'t bother you.'),
(17, 30, 'I want to live in this room. Waaahhhh!'),
(21, 33, 'Meeoowww');

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
(14),
(15),
(16),
(20);

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
(27, 14, 'Groningen', '1234GR', 'Ebbingestraat', 42, '', 28, 'studio', 670, 'A studio near the centre of Groningen with separate kitchen and bathroom facilities. Apart from the occasional (agreed upon) parties, tenant should be quiet after 11pm.'),
(28, 15, 'Groningen', '1234ON', 'Schoolholm', 9, 'B', 16, 'bedroom', 390, 'A bedroom in a recently renovated student house. Kitchen and 2 bathrooms shared with 3 other rooms. University, shops and bars are all within walking distance.'),
(29, 15, 'Groningen', '1234ON', 'Schoolholm', 9, 'C', 15, 'bedroom', 370, 'A bedroom in a recently renovated student house. Kitchen and 2 bathrooms shared with 3 other rooms. University, shops and bars are all within walking distance.'),
(30, 15, 'Groningen', '1234ON', 'Schoolholm', 9, 'D', 17, 'bedroom', 410, 'A bedroom in a recently renovated student house. Kitchen and 2 bathrooms shared with 3 other rooms. University, shops and bars are all within walking distance.'),
(31, 16, 'Stiens', '1234ST', 'Nije Poarte', 71, '', 19, 'bedroom', 280, 'A nice room in the quiet place of Stiens. Transport to Ljouwert or Groningen only takes about 2 hours.'),
(33, 20, 'Bikini Bottom', '1234BB', 'Conch Street', 124, '', 124, 'pineapple', 2, 'A pineapple under the sea in the outskirts of Bikini Bottom. Walking distance to diners. Friendly neighbours.');

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
(17),
(21),
(22);

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
  `biography` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `phone`, `birthdate`, `language`, `occupation`, `biography`) VALUES
(14, 'ownerjan', '$2y$10$Js5O23PkjkiIftUv8eWQ3.F45aso6Uky6TEJOUCx/8cJ0qbzDgq7S', 'Jan', 'Janssen', 'jan.janssen@mail.com', '0676956256', '1967-11-19', 'Dutch', 'Baker', 'I own a bakery shop in the centre of Groningen. Because my son moved out, I have a spare room for lent to a student.'),
(15, 'ownermario', '$2y$10$43B/UbrKENCOS9carJrN3ORuyjkWxP9VPZzsBGUJzeH7LiKI2gT6i', 'Mario', 'Segale', 'mariosegale@mail.com', '0685133149', '1969-06-11', 'Italian', 'Plumber', 'I am Italian plumber, looking for renters in my new student house. I won\'t be home often because I have to save a princess!'),
(16, 'ownerpiet', '$2y$10$S1xWxR3S1rbjG6g.DRd2reyXRFx3xitSC/tppJdNF8fZLI6LZ0uPG', 'Piet', 'Paulusma', 'pietpaulusma@mail.com', '0643728147', '1974-10-03', 'Frisian', 'Weatherman', 'I am a weather presenter from Fryslân. Because my wife divorced me and took the kids I have a lot of rooms. I need company, so I want to let my empty rooms.'),
(17, 'tenantluigi', '$2y$10$ekSGE4Ngr71HnEctjI8TfO/Rys6gbqDQr.FWW80Ek3CttQUxWd1I.', 'Luigi', 'Segale', 'luigisegale@mail.com', '0695523606', '1978-02-07', 'Italian', 'Construction', 'I am a woodworkers apprentice looking for a place to stay in Groningen. I am skilled with tools, so I can help around the house!'),
(20, 'ownerspongebob', '$2y$10$W3RkBZ0ywLw0G8B6e438zuUIb7dKA6X7jmYpkMHOgOqMkhqNoVp0m', 'Spongebob', 'Squarepants', 'spongebob@mail.com', '0643845339', '1999-05-01', 'English', 'Fry cook', 'I live in a pineapple under the sea. I am absorbent, yellow and porous. I like nautical nonsense, such as dropping on the deck and flopping like a fish. '),
(21, 'tenantgary', '$2y$10$muJ7IkvdVkvz5WhhJ0xQ8Oz8RsC8HwZbmgRgl0bWMl0NaRry9WUpW', 'Gary', 'the Snail', 'gary@snailmail.com', '0643553172', '1999-05-01', 'Snail', 'Pet', 'Meow!'),
(22, 'tenanttjepke', '$2y$10$pm9C8Mqk4wd1rVCahipXR.Y.UfkqTNoeHODh8pb3z78/3zw271h2C', 'Tjepke', 'Tjepkema', 'tjepketjepkema@mail.com', '0625549817', '1996-04-01', 'Frisian', 'Student Fryske Taal en Kultuer', 'Ik bin in spontane jonge út it noarden. Ik hâld fan fierljeppen en Fryske dúmkes.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `optin`
--
ALTER TABLE `optin`
  ADD PRIMARY KEY (`tenant_id`,`room_id`),
  ADD KEY `optin_ibfk_2` (`room_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `optin`
--
ALTER TABLE `optin`
  ADD CONSTRAINT `optin_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `optin_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
