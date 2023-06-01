-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2023 at 09:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spellsofnimhdora`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatar_images`
--

CREATE TABLE `avatar_images` (
  `id` int(11) NOT NULL,
  `avatar_naam` varchar(255) NOT NULL,
  `avatar_imgSrc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avatar_images`
--

INSERT INTO `avatar_images` (`id`, `avatar_naam`, `avatar_imgSrc`) VALUES
(0, 'Standard Image', 'Presentation/stylesheets/avatar_img/standard_avatar.png'),
(1, 'Whiskered Witchcraft', 'Presentation/stylesheets/avatar_img/avatar_img1.png'),
(2, 'All Seeing Force', 'Presentation/stylesheets/avatar_img/avatar_img2.png'),
(3, 'Sacred Youngling', 'Presentation/stylesheets/avatar_img/avatar_img3.png');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `card_naam` varchar(255) NOT NULL,
  `card_imgSrc` varchar(255) NOT NULL,
  `defence` int(11) NOT NULL,
  `attack` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `card_naam`, `card_imgSrc`, `defence`, `attack`) VALUES
(1, 'Experienced Adventurer', 'Presentation/stylesheets/game_img/card_img/experienced_adventurer.png', 7, 6),
(2, 'Otherworldly Threats', 'Presentation/stylesheets/game_img/card_img/otherwordly_threats.png', 3, 7),
(3, 'All Seeing Force', 'Presentation/stylesheets/game_img/card_img/all_seeing_force.png', 7, 4),
(4, 'Vicious Fluffness Of Caerbannog', 'Presentation/stylesheets/game_img/card_img/vicious_fluffness.png', 3, 6),
(5, 'Sacred Youngling', 'Presentation/stylesheets/game_img/card_img/sacred_youngling.png', 3, 3),
(6, 'Paranormal Protector', 'Presentation/stylesheets/game_img/card_img/paranormal_protector.png', 6, 1),
(7, 'Paranormal Protector', 'Presentation/stylesheets/game_img/card_img/paranormal_protector2.png', 6, 1),
(8, 'Gelatinous Ambition', 'Presentation/stylesheets/game_img/card_img/gelatinous_ambition.png', 3, 5),
(9, 'Whiskered Witchcraft', 'Presentation/stylesheets/game_img/card_img/whiskered_witchcraft.png', 4, 4),
(10, 'Friendly Soulcollector', 'Presentation/stylesheets/game_img/card_img/friendly_soulcollector.png', 3, 4),
(11, 'All Consuming Greed', 'Presentation/stylesheets/game_img/card_img/all_consuming_greed.png', 2, 7),
(12, 'Disasterly Sweet Delight', 'Presentation/stylesheets/game_img/card_img/disasterly_sweet_delight.png', 5, 7),
(13, 'Disasterly Sweet Delight', 'Presentation/stylesheets/game_img/card_img/disasterly_sweet_delight2.png', 3, 5),
(14, 'Priestess Dark Belonging', 'Presentation/stylesheets/game_img/card_img/priestess_Dark_belonging.png', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `accountNr` int(11) NOT NULL,
  `avatarId` int(11) NOT NULL,
  `playerAge` int(11) NOT NULL,
  `playerGender` varchar(200) NOT NULL,
  `playerBio` varchar(255) NOT NULL,
  `LVL` int(11) NOT NULL,
  `XP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`accountNr`, `avatarId`, `playerAge`, `playerGender`, `playerBio`, `LVL`, `XP`) VALUES
(13, 2, 30, 'female', 'test', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userNickname` varchar(50) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userAccountNr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userNickname`, `userEmail`, `userPassword`, `userAccountNr`) VALUES
(10, 'user', 'kimberly.verhecken@vdabcampus.be', '$2y$10$lsgcMficyp/7KxUDYx.CMunCWj4r6nORbjNKuMFVwM2UTG.twkAR2', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatar_images`
--
ALTER TABLE `avatar_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`accountNr`),
  ADD KEY `avatarId` (`avatarId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `userAccountNr` (`userAccountNr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatar_images`
--
ALTER TABLE `avatar_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `accountNr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD CONSTRAINT `useraccounts_ibfk_1` FOREIGN KEY (`avatarId`) REFERENCES `avatar_images` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userAccountNr`) REFERENCES `useraccounts` (`accountNr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
