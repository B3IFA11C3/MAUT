-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Jun 2017 um 11:39
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `User`
--

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
