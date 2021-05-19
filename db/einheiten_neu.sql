-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Okt 2020 um 06:18
-- Server-Version: 10.4.14-MariaDB
-- PHP-Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `sushi`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `einheiten`
--

DROP TABLE IF EXISTS `einheiten`;
CREATE TABLE `einheiten` (
  `ehid` int(2) UNSIGNED NOT NULL,
  `einheit_lang` varchar(16) COLLATE utf8_bin NOT NULL,
  `einheit_kurz` varchar(9) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `einheiten`
--

INSERT INTO `einheiten` (`ehid`, `einheit_lang`, `einheit_kurz`) VALUES
(1, '---', '---'),
(4, 'Becher', 'Be'),
(6, 'Blatt', 'BL'),
(7, 'Beutel', 'Btl.'),
(8, 'Bund', 'Bu'),
(9, 'Zentiliter', 'cl'),
(10, 'Dezigramm', 'dg'),
(11, 'Deziliter', 'dl'),
(12, 'Dose', 'Dos'),
(13, 'Esslöffel', 'El'),
(14, 'etwas', 'etw.'),
(15, 'Flasche', 'FL'),
(16, 'Gramm', 'g'),
(17, 'gestr. Teelöffel', 'gTL'),
(18, 'gestr. Esslöffel', 'gEL'),
(19, 'Glas', 'G'),
(20, 'gross', 'Gr'),
(21, 'Handvoll', 'Hdv'),
(22, 'Karton', 'K.'),
(23, 'Kilogramm', 'Kg'),
(24, 'Kugel', 'Kugel'),
(25, 'klein', 'kl'),
(26, 'Knolle', 'kn'),
(27, 'Kopf', 'Kopf'),
(28, 'Liter', 'L'),
(29, 'Milligramm', 'mg'),
(30, 'mittel', 'md'),
(31, 'Milliliter', 'ml'),
(33, 'Packung', 'Pkt.'),
(34, 'Pfund', 'Pf'),
(35, 'Pint', 'pt'),
(36, 'Päckchen', 'Pkt'),
(37, 'Prise', 'Pr'),
(38, 'Quart', 'qt'),
(39, 'Röhrchen', ''),
(40, 'Scheibe(n)', 'Sch'),
(41, 'Spritzer', 'Sp'),
(42, 'Stück(e)', 'St'),
(43, 'Stange(n)', 'Stg'),
(44, 'Tasse/n', 'Tas'),
(45, 'Teelöffel', 'Tl'),
(46, 'Tropfen', 'Tr'),
(47, 'Tube', 'Tube'),
(48, 'Ounze', 'oz'),
(49, 'wenig', 'wenig'),
(50, 'Würfel', 'Wf'),
(51, 'pro Portion', 'p.P.'),
(52, 'Zehe(n)', 'Z'),
(53, 'Zweig/e', 'Zw'),
(54, 'nach Belieben', 'n.B.'),
(55, 'eventuell', 'evt.'),
(56, 'Messerspitze', 'Msp.'),
(57, 'einige Stiele', 'e. Stiele'),
(58, 'große Flasche', 'gr. Fl.'),
(59, 'Strauch', 'Strauch'),
(60, 'Ecke/n', 'eck'),
(61, 'Schale(n)', 'Sch'),
(62, 'Schuss', ''),
(63, 'kleine Dose', 'kl. Dose');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `einheiten`
--
ALTER TABLE `einheiten`
  ADD PRIMARY KEY (`ehid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `einheiten`
--
ALTER TABLE `einheiten`
  MODIFY `ehid` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
