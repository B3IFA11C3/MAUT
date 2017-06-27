-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Jun 2017 um 11:51
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 7.0.13
CREATE DATABASE `user`;
USE `user`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `user`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gruppe`
--

CREATE TABLE `gruppe` (
  `G_ID` int(11) NOT NULL,
  `G_Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `G_Komp` int(1) NOT NULL DEFAULT '0',
  `G_Raum` int(1) NOT NULL DEFAULT '0',
  `G_Lief` int(1) NOT NULL DEFAULT '0',
  `G_Rep_Komp` int(1) NOT NULL DEFAULT '0',
  `G_Rep_Raum` int(1) NOT NULL DEFAULT '0',
  `G_Rep_Lief` int(1) DEFAULT '0',
  `G_User` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `gruppe`
--

INSERT INTO `gruppe` (`G_ID`, `G_Name`, `G_Komp`, `G_Raum`, `G_Lief`, `G_Rep_Komp`, `G_Rep_Raum`, `G_Rep_Lief`, `G_User`) VALUES
(0, 'Admin', 1, 1, 1, 1, 1, 1, 1),
(1, 'Systembetreuer', 1, 1, 1, 1, 1, 1, 1),
(2, 'Azubis', 1, 1, 1, 1, 1, 1, 0),
(3, 'Verwaltung', 0, 0, 0, 1, 1, 1, 0),
(4, 'Lehrer', 0, 0, 0, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `U_ID` int(11) NOT NULL,
  `U_Nachname` varchar(50) COLLATE utf8_bin NOT NULL,
  `U_Vorname` varchar(50) COLLATE utf8_bin NOT NULL,
  `U_Benutzername` varchar(50) COLLATE utf8_bin NOT NULL,
  `U_Passwort` varchar(50) COLLATE utf8_bin NOT NULL,
  `U_Gruppe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`U_ID`, `U_Nachname`, `U_Vorname`, `U_Benutzername`, `U_Passwort`, `U_Gruppe_id`) VALUES
(1, 'Barun', 'Günter', 'Baron', 'baron', 4),
(2, 'Riddler', 'Der Großartige', 'Little', 'little', 2),
(3, 'Tester', 'Test', 'Test', 'test', 1),
(4, 'Verwalter', 'Walter', 'Walter', 'walter', 3);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `gruppe`
--
ALTER TABLE `gruppe`
  ADD PRIMARY KEY (`G_ID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`U_ID`),
  ADD KEY `U_G_FK` (`U_Gruppe_id`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `U_G_FK` FOREIGN KEY (`U_Gruppe_id`) REFERENCES `gruppe` (`G_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
