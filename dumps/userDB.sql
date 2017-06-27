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
(1, 'Barun', 'Günter', 'Baron', '$1$fe2.6I/.$ECQ/153UjuB/IUnVHx8ON.', 4),
(2, 'Riddler', 'Der Großartige', 'Little', '$1$uC1.f74.$GszKtOcEUyN0uc2dCfrfB1', 2),
(3, 'Tester', 'Test', 'Test', '$1$li2.KW3.$zaGH6cjEf3Quedk2Lnyoq/', 1),
(4, 'Verwalter', 'Walter', 'Walter', '$1$l.5.KA4.$rbBwNeMmZ/chjnHvXwAe51', 3);

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
