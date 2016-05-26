-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 21. Mai 2016 um 09:38
-- Server-Version: 10.1.jpg.13-MariaDB
-- PHP-Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bilderdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `bid` int(11) NOT NULL,
  `vorname` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `nachname` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `passwort` char(60) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`bid`, `vorname`, `nachname`, `email`, `passwort`) VALUES
(5, 'Jonas', 'Cosandey', 'jonascosandey@hotmail.com', '$2y$10$O42qs2hGlrjq640iYb7jpun5wpdo.Ivg/p4AKJRfq5qbRc6dLj1d2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fotos`
--

CREATE TABLE `fotos` (
  `fid` int(11) NOT NULL,
  `idb` int(11) NOT NULL,
  `idg` int(11) NOT NULL,
  `pfad` varchar(255) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fotos_tag`
--

CREATE TABLE `fotos_tag` (
  `id` int(11) NOT NULL,
  `idf` int(11) NOT NULL,
  `idt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gallerie`
--

CREATE TABLE `gallerie` (
  `gid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tag`
--

CREATE TABLE `tag` (
  `tid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`fid`),
  ADD UNIQUE KEY `pfad` (`pfad`),
  ADD KEY `idu` (`idb`);

--
-- Indizes für die Tabelle `fotos_tag`
--
ALTER TABLE `fotos_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gallerie`
--
ALTER TABLE `gallerie`
  ADD PRIMARY KEY (`gid`);

--
-- Indizes für die Tabelle `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `fotos`
--
ALTER TABLE `fotos`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
