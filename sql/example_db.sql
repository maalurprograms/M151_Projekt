-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2016 at 03:40 
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bilderdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `aid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_german2_ci NOT NULL,
  `idb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`aid`, `name`, `idb`) VALUES
(26, 'Beispiel', 9);

-- --------------------------------------------------------

--
-- Table structure for table `benutzer`
--

CREATE TABLE `benutzer` (
  `bid` int(11) NOT NULL,
  `vorname` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `nachname` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `passwort` char(60) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `benutzer`
--

INSERT INTO `benutzer` (`bid`, `vorname`, `nachname`, `email`, `passwort`) VALUES
(9, 'Jonas', 'Cosandey', 'jonascosandey@hotmail.com', '$2y$10$zuFwwalwzSBAeNknjsvaYeeB4iYV.DwxikjjWsSBsXLVUHNxZkyl2');

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

CREATE TABLE `fotos` (
  `fid` int(11) NOT NULL,
  `ida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `fotos`
--

INSERT INTO `fotos` (`fid`, `ida`) VALUES
(235, 26),
(236, 26),
(237, 26),
(238, 26),
(239, 26),
(240, 26),
(241, 26),
(242, 26),
(243, 26),
(244, 26),
(245, 26);

-- --------------------------------------------------------

--
-- Table structure for table `fotos_tag`
--

CREATE TABLE `fotos_tag` (
  `id` int(11) NOT NULL,
  `idf` int(11) NOT NULL,
  `idt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `fotos_tag`
--

INSERT INTO `fotos_tag` (`id`, `idf`, `idt`) VALUES
(282, 235, 166),
(283, 235, 167),
(284, 235, 168),
(285, 236, 167),
(286, 236, 169),
(287, 236, 170),
(288, 237, 171),
(289, 237, 168),
(290, 237, 172),
(291, 238, 173),
(292, 238, 174),
(293, 238, 175),
(294, 239, 176),
(295, 239, 168),
(296, 239, 167),
(297, 240, 173),
(298, 240, 174),
(299, 240, 177),
(300, 241, 171),
(301, 241, 178),
(302, 242, 179),
(303, 242, 180),
(304, 243, 170),
(305, 243, 181),
(306, 243, 182),
(307, 244, 183),
(308, 244, 184),
(309, 244, 185),
(310, 245, 183),
(311, 245, 184),
(312, 245, 185);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tid`, `name`) VALUES
(166, 'space'),
(167, 'beautifull'),
(168, 'epic'),
(169, 'beach'),
(170, 'miami'),
(171, 'cat'),
(172, 'animal'),
(173, 'linux'),
(174, 'tux'),
(175, 'cosplay'),
(176, 'earth'),
(177, 'linux mint'),
(178, 'animal:epic'),
(179, 'smite'),
(180, 'wallpaper'),
(181, 'sunset'),
(182, 'america'),
(183, 'nvidia'),
(184, ' green'),
(185, 'claw');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `fotos_tag`
--
ALTER TABLE `fotos_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `fotos`
--
ALTER TABLE `fotos`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `fotos_tag`
--
ALTER TABLE `fotos_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
