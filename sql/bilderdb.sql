-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 01, 2016 at 04:54 
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
(3, 'Test Album', 5);

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
(5, 'Jonas', 'Cosandey', 'jonascosandey@hotmail.com', '$2y$10$O42qs2hGlrjq640iYb7jpun5wpdo.Ivg/p4AKJRfq5qbRc6dLj1d2');

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
(178, 3),
(179, 3),
(180, 3),
(181, 3),
(182, 3),
(183, 3),
(185, 3),
(186, 3),
(187, 3),
(188, 3);

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
(229, 178, 134),
(230, 178, 135),
(231, 178, 136),
(232, 178, 137),
(233, 179, 134),
(234, 179, 138),
(235, 180, 134),
(236, 180, 139),
(237, 180, 140),
(238, 181, 134),
(239, 181, 141),
(240, 182, 134),
(241, 182, 142),
(242, 183, 134),
(243, 183, 139),
(244, 185, 134),
(245, 185, 138),
(246, 186, 134),
(247, 186, 135),
(248, 186, 136),
(249, 186, 137),
(250, 187, 134),
(251, 187, 143),
(252, 188, 134),
(253, 188, 144),
(254, 191, 145),
(255, 191, 146),
(256, 192, 147),
(257, 193, 148),
(258, 194, 149),
(259, 195, 150),
(260, 196, 151),
(261, 197, 152);

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
(134, 'Guild Wars 2'),
(135, 'Epic'),
(136, 'Boss'),
(137, 'Dragon'),
(138, 'Beautifull'),
(139, 'Amazing'),
(140, 'Christmas'),
(141, 'Char'),
(142, 'Desert'),
(143, 'Charlet'),
(144, 'Char Wallpaper'),
(145, 'Joker'),
(146, 'Pokemon'),
(147, 'Nvidia'),
(148, 'Galaxy'),
(149, 'LinuxFTW'),
(150, 'Blurry'),
(151, 'Assassins Creed'),
(152, 'Mass Effect');

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
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `fotos`
--
ALTER TABLE `fotos`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `fotos_tag`
--
ALTER TABLE `fotos_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
