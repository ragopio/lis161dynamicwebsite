-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2017 at 08:00 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gopio_lis161`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(15) NOT NULL,
  `game_title` varchar(255) NOT NULL,
  `year_released` int(4) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `console` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `game_title`, `year_released`, `genre`, `console`, `description`) VALUES
(1, 'Super Mario Bros.', 1985, 'PTFRM', 'NES', 'Super Mario Bros. is a game about Mario, a plumber who wishes to rescue a Princess named Peach who is kidnapped by the evil Bowser.'),
(2, 'Sonic the Hedgehog', 1991, 'PTFRM', 'SEGAGNS', 'Sonic the Hedgehog is a game about Sonic, a blue hedgehog with the power of super speed and his mission to save his fellow animal critters from the evil Dr. Eggman.'),
(3, 'Street Fighter II: The World Warrior', 1987, 'FIGHT', 'SNES', 'Street Fighter II, a sequel to the successsful arcade fighting game Street Fighter, introduces new characters to fight as with their own unique fighting styles to win battles.'),
(4, 'Final Fantasy ', 1987, 'RPG', 'NES', 'Final Fantasy is an RPG about a hero getting all the 4 crystals of the elements to save the world.'),
(5, 'Altered Beast', 1988, 'BTMUP', 'SEGAMSTR', 'Altered Beast is a SEGA Beat-em-up game set in Ancient Greece about a centurion who is rescued by Zeus and asked to rescue Athena.'),
(6, 'F-Zero', 1990, 'RACE', 'NES', 'F-Zero is a racing game set in a distant future where technology is as high as the speed that these futuristic hovercars can reach.'),
(7, 'The Legend of Zelda', 1986, 'ADV', 'NES', 'The Legend of Zelda tells the tale of an adventurer named Link and his mission to save Hyrule from the evil Ganondorf.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
