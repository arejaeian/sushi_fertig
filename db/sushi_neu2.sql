-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Okt 2020 um 05:45
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
CREATE DATABASE IF NOT EXISTS `sushi` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `sushi`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `anlass`
--

CREATE TABLE `anlass` (
  `aid` int(10) UNSIGNED NOT NULL,
  `aname` varchar(80) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `anlass`
--

INSERT INTO `anlass` (`aid`, `aname`) VALUES
(1, 'Reisrezepte zum Lunch'),
(2, 'Reisrezepte zum Abend'),
(3, 'Dessert'),
(4, 'Schnelle Reisrezepte'),
(5, 'Sommer Rezepte');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bilder`
--

CREATE TABLE `bilder` (
  `bid` int(10) UNSIGNED NOT NULL,
  `rid` int(10) UNSIGNED NOT NULL,
  `pfad` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `bilder`
--

INSERT INTO `bilder` (`bid`, `rid`, `pfad`) VALUES
(3, 1, 'img/ID1004516510.jpg'),
(4, 3, 'img/sushisummerrolls0.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `einheiten`
--

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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `erneahrung`
--

CREATE TABLE `erneahrung` (
  `eid` int(10) UNSIGNED NOT NULL,
  `rart` varchar(80) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `erneahrung`
--

INSERT INTO `erneahrung` (`eid`, `rart`) VALUES
(1, 'Kalorienarme Rezepte'),
(2, 'Vegane Rezepte'),
(3, 'Vegetarische Rezepte'),
(4, 'Fettarme Reisrezepte'),
(5, 'Gesund');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorie`
--

CREATE TABLE `kategorie` (
  `kid` int(10) UNSIGNED NOT NULL,
  `kname` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `kategorie`
--

INSERT INTO `kategorie` (`kid`, `kname`) VALUES
(1, 'Reis'),
(2, 'Füllung'),
(3, 'Zusätzlich'),
(4, 'Sesamdip'),
(5, 'Zum servieren'),
(6, 'Dazu braucht ihr noch'),
(7, 'Zutaten für Teriyaki Sauce'),
(8, 'Topping');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `laender`
--

CREATE TABLE `laender` (
  `lid` int(10) UNSIGNED NOT NULL,
  `land` varchar(80) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `laender`
--

INSERT INTO `laender` (`lid`, `land`) VALUES
(1, 'Alle'),
(2, 'Japan'),
(3, 'China'),
(4, 'Asiatisch');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezepte`
--

CREATE TABLE `rezepte` (
  `rid` int(10) UNSIGNED NOT NULL,
  `sid` int(10) UNSIGNED NOT NULL,
  `lid` int(10) UNSIGNED NOT NULL,
  `eid` int(10) UNSIGNED NOT NULL,
  `aid` int(10) UNSIGNED NOT NULL,
  `personen` int(2) NOT NULL,
  `rezeptname` varchar(100) COLLATE utf8_bin NOT NULL,
  `beschreibung` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `rezepte`
--

INSERT INTO `rezepte` (`rid`, `sid`, `lid`, `eid`, `aid`, `personen`, `rezeptname`, `beschreibung`) VALUES
(1, 2, 2, 1, 1, 2, 'Maki Sushi mit Süßkartoffeln, Avocado und Rote Beete', '<ol>\r\n<li>Heize den Ofen auf 200°C vor.<br />Schneide die Süßkartoffel in 1cm dicke Streifen und lege sie so auf ein Backblech mit Backpapier.<br /><br />Backe sie für ca. 30 Min.<br /><br /></li>\r\n<li>Reis in einen Kochtopf geben.<br />Reis zweimal im Topf durchwaschen, um die überschüssige Stärke zu entfernen. Wasser dazugeben.<br />Reis 10 Minuten einweichen lassen.<br />Herd auf die höchste Hitzestufe stellen und Reis aufkochen lassen.<br />Sobald das Wasser kocht, den Herd auf die mittlere Hitzestufe stellen und den Reis ca. 20 Minuten bei geschlossenem Deckel köcheln lassen bis das Wasser verdampft ist. 5 Minuten ruhen lassen.<br />1.5 EL Reissessig mit 0.5 EL Zucker und 0.5 TL Salz verrühren.<br />Reis in eine Schüssel (am besten Hangiri) geben und Reisessigmischung durchziehen lassen.<br /><br /></li>\r\n<li>Bereite das Gemüse am Besten vor während der Reis kocht.<br />Schneide dazu die Avocado in ca 1cm dicke Streifen.<br />Und die Rote Beete erst in ca. 2mm dünne Scheiben und dann in 2mm breite Streifen.<br /><br /></li>\r\n<li>Lege ein Nori Blatt auf deine Sushi Rollmatte, verteile den noch warmen Reis auf der unteren Hälfte des Blattes und drücke ihn mit angefeuchteten Fingern fest.<br />Lege das Gemüse an den unteren Rand des Nori Blattes, halte es mit den Fingern fest und rolle es zusammen mit der Matte von unten nach oben ein.<br /><br /></li>\r\n<li>Schneide die Sushi Rolle mit einem scharfen (!) und glatten Messer in ca. 2,5 - 3cm Dicke Scheiben.<br />FERTIG :)<br /><br />Gib etwas Sesam über dein Sushi und genieße es mit Sojasauce.</li>\r\n</ol>'),
(3, 2, 4, 5, 5, 2, 'Sushi Summer Rolls ', '<ol>\r\n<li>Reis in einen Kochtopf geben.<br />Reis zweimal im Topf durchwaschen, um die überschüssige Stärke zu entfernen.<br />Wasser dazugeben.<br />Reis 10 Minuten einweichen lassen.<br />Herd auf die höchste Hitzestufe stellen und Reis aufkochen lassen.<br />Sobald das Wasser kocht, den Herd auf die mittlere Hitzestufe stellen und den Reis ca. 20 Minuten bei geschlossenem Deckel köcheln lassen bis das Wasser verdampft ist.<br />5 Minuten ruhen lassen.<br />1.5 EL Reissessig mit 0.5 EL Zucker und 0.5 TL Salz verrühren.<br />Reis in eine Schüssel (am besten Hangiri) geben und Reisessigmischung durchziehen lassen.<br><br></li>\r\n<li>Reispapier kurz in Wasser einweichen, dann auf ein feuchtes Holzbrett legen.<br><br></li>\r\n<li>Sesam mittig darauf streuen. Lachs und Algensalat ebenfalls mittig platzieren und etwas Sushi Reis darauf geben.<br><br></li>\r\n<li>Das Reispapier falten: Oberes und unteres Ende zuerst einklappen. Die linke Seite ebenfalls einklappen und fest einrollen.<br><br></li>\r\n<li>Schritt 2-4 wiederholen bis das ganze Reispapier aufgebraucht ist.<br><br></li>\r\n<li>Sushi Summer Rolls mit Sojasoße und Wasabi servieren. Guten Reishunger! :)</li>\r\n</ol>\r\n<p> </p>');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `seiten`
--

CREATE TABLE `seiten` (
  `seitenid` int(10) UNSIGNED NOT NULL,
  `seite` varchar(30) COLLATE utf8_bin NOT NULL,
  `inhalt` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `seiten`
--

INSERT INTO `seiten` (`seitenid`, `seite`, `inhalt`) VALUES
(1, 'index', '<h1>Die Geschichte von Sushi</h1>\r\n<h3 class=\"mitte\"> </h3>\r\n<h3 class=\"mitte\">Ursprung</h3>\r\n<p> </p>\r\n<p>In seiner heutigen Form ist Sushi ein japanisches Gericht, stammt aber ursprünglich nicht aus Japan. Seinen Ursprung hat Sushi in einer Konservierungsmethode für Süßwasserfisch entlang des Mekong Flusses in Südostasien, mit der die Menschen ihren frischen Fisch konservierten. Der fertig ausgenommene Fisch wurde zusammen mit gekochtem Reis in Gefäßen eingelegt so dass ein Fermentierungsprozess entstand. In den verschlossenen Gefäßen war der Fisch über einen längeren Zeitraum genießbar. Der säuerlich gewordene Reis wurde weggeworfen.<br /><br />Angeblich hielt so der Fisch bis zu einem Jahr, eine Fischkonserve war erfunden.<br /><br />Ausgehend vom Mekong Fluß breitete sich diese Methode über verschiedene Provinzen Chinas bis nach Japan aus.<br /><br /><img src=\"../img/bild2.jpg\" alt=\"\" width=\"400\" height=\"266\" />Während diese Zubereitungsform heute in China nicht mehr praktiziert wird, findet man auf Taiwan und in Thailand immer noch Fisch, der mit der Fermentierungsmethode haltbar gemacht wird.<br />In Japan findet sich die erste urkundliche Erwähnung in einem Regierungsdokument aus dem <strong>Jahre 718</strong>. Auch hier wurde bis Ende 9. Jahrhundert vorwiegend Süßwasserfisch durch Fermentierung haltbar gemacht.<br /><strong>Funazushi</strong> ist noch heute eine japanische Spezialität, Süßwasserfisch aus dem Biwa-See wird aufwändig verarbeitet und in Reis fermentiert. Wegen des hohen Nährstoffgehaltes nennt man ihn <strong>„japanischen Käse“</strong>, Ähnlich wie dieser Funazushi, wird Sushi, welches auch durch Milchsäuregärung entsteht als Narezushi bezeichnet, in Japan ein traditionelles Gericht.<br />Im Laufe der Jahrhunderte wurde der Fisch immer kürzer fermentiert.<br /><br />Etwa ab dem 14. Jahrhundert verspeiste man den Fisch zu einem sehr frühen Fermentierungsgrad, bei dem das Fischfleisch noch ziemlich frisch war und man auch den Reis noch essen konnte. Der säuerliche Geschmack aus der Fermentierung bliebt jedoch erhalten.</p>\r\n<p> </p>\r\n<h3 class=\"mitte\">Die Weiterentwicklung von Sushi in Japan</h3>\r\n<p> </p>\r\n<p>Seit dem Ende des 16. Jahrhunderts mischen Köche dem Sushi Reisessig bei, um den ursprünglich säuerlichen Geschmack zu erzeugen. Der gesäuerte Reis wurde dafür in Holzkästchen gepresst, mit Fischscheiben belegt und mit einem Stein beschwert um den Gärungsprozess einzuleiten.<br />Der Fisch wurde zart, der Reis geniessbar und der klassische Fermentierungsprozess zur Reissäuerung überflüssig.<br />Erfunden wurde diese Methode angeblich von dem <em>Arzt Matsumoto Yoshiichi</em>.Diese Reis-Fisch-Schichtung wurde <strong>Haya-sushi</strong> genannt und ist immer noch Grundlage vieler moderner Sushivariationen.</p>\r\n<p> </p>\r\n<h3 class=\"mitte\">Die heutige Form des Sushi</h3>\r\n<p> </p>\r\n<p>Im damaligen Edo, dem heutigen Tokyo, entstand etwa ab dem 18. Jahrhundert die Form des Sushi wie wir es heute kennen.<br />Inzwischen konnten sich immer mehr Menschen den teureren fangfrischen Meeresfisch leisten, der am Hafen belegt auf Reis angeboten wurde. Diese Zubereitungssform ist heute als <strong>Nigiri-Sushi</strong> bekannt. Im frühen 20. Jahrhundert war die Entwicklung zum modernen Sushi zwar abgeschlossen, jedoch wird bis heute weltweit an immer raffinierteren Variationen experimentiert.</p>\r\n<p> </p>\r\n<h3 class=\"mitte\">Sushi im Westen</h3>\r\n<p> </p>\r\n<p>In den westlichen Zivilisationen wurde Sushi erst in der zweiten Hälfte des 20. Jahrhunderts, nach dem zweiten Weltkrieg, populär.<br />Die ersten Sushi-Restaurants wurden von Exiljapanern besucht, die im Ausland, vornehmlich den USA lebten.<br />1966 eröffnete Noritoshi Kanai die erste Sushi Bar in Little Tokyo, einem Stadtteil in Los Angeles und zwar im japanischen Restaurant Kawafuku.<br /><br />Er war ein Amerikaner japanischer Abstammung, arbeitete im Japanhandel in einer Im-und Exportfirma und überredete einen japanischen Koch in die USA zu kommen. Den frischen Fisch, der lokal nicht verfügbar war, lies er extra aus Japan einfliegen.Die hohen Transportkosten für den Frischfisch waren anfänglich der Grund für den hohen Sushi Preis.<br /><br />Die berühmte California Roll mit dem Reis auf der Außenseite wurde 1971 in Vancouver kreiert - aus ästhetischen Gründen!<br />Viele Kunden empfanden Meeresalgen als unappetitlich. Die japanischen Köche wussten sich zu helfen, rollten die Rolle einfach anders herum und packten den Reis auf die Außenseite.<br /><br />Diese „amerikanisierte“ Rolle war bald in Los Angeles sehr beliebt, als California Roll bekannt und wird inzwischen weltweit serviert.<br />In Deutschland entstanden die ersten Sushi Restaurants in den frühen achtziger Jahren in Düsseldorf und Hamburg im Windschatten der Deutschlandzentralen japanischer Firmen. <br /><br />Die Entwicklung von Sushi ist ein wunderbarer Beweis für die Veränderung von Speisen unter dem Einfluss neuer Kulturen. Eines der jüngsten Beispiele ist die <strong>Philadelphia Roll</strong>, mit einem hohen Anteil des beliebten, gleichnamigen Frischkäses.</p>\r\n<p> </p>\r\n<address class=\"quelle\">Quelle: https://www.black-glass.de/</address>');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sushiarten`
--

CREATE TABLE `sushiarten` (
  `sid` int(10) UNSIGNED NOT NULL,
  `art` varchar(50) COLLATE utf8_bin NOT NULL,
  `info` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `sushiarten`
--

INSERT INTO `sushiarten` (`sid`, `art`, `info`) VALUES
(2, 'Maki', 'Maki: (übersetzt “gerollte Sushi”) sind die bekannteste Form von Sushi. Sie werden mit einer Bambusmatte (Makisu) von Hand gerollt – dabei kann das Algenblatt (Nori) sowohl außen (Hoso-Maki, Futo-Maki) als auch innen (Ura-Maki) sein. Gefüllt werden Maki mit gesäuertem Reis, rohem Fisch und Gemüse.<br><br>\r\n\r\nTraditionelle, japanische Maki werden typischerweise mit rohem Lachs, Thunfisch (Maguro), Aal, Tofu, Omelett, eingelegtem Rettich, Gurke und Karotte gefüllt.'),
(3, 'Hoso-Maki', 'Hoso-Maki: (übersetzt “dünne Rolle“) Bei den Hoso-Maki wird ein Noriblatt (Algenblatt) halbiert und meist mit nur einer bis maximal zwei Zutaten gefüllt. Dazu wird Sojasauce gereicht.\r\n<br><br>\r\nDie mundgerechten Happen dippt man übrigens nur mit dem Algenblatt und nicht mit der Füllung in die Sojasauce, da sonst der Geschmack der Füllung vollständig überdeckt würde. '),
(4, 'Futo-Maki', 'Futo-Maki: (übersetzt: “dicke Rolle“) ist die große Variante der Makirolle. Futomaki werden aus einem ganzen Noriblatt hergestellt, das mit Reis, Fisch und Gemüse gefüllt wird. Bei Futomaki befinden sich mindestens 3 oder mehr Füllungen in der Rolle.'),
(5, 'Ura-Maki', 'Ura-Maki: Diese Maki sind auch unter dem Namen Inside-Out oder California-Rolls bekannt. Dabei werden die Zutaten wie Fisch und Gemüse direkt vom Noriblatt umhüllt und der Reis befindet sich außen an der Rolle. Meist wird der Reis dann mit Gomashio, Sesam oder Fischeiern dekoriert. Ura-Maki zählen nicht zu den traditionellen japanischen Sushiformen, sondern wurden von, wie der Name “California-Rolls” schon erahnen lässt, japanischen Einwanderern in den USA entwickelt.'),
(6, 'Temaki', 'Temaki sind kleine, spitze Tütchen aus Noriblättern, die von Hand ohne Bambusmatte gerollt und dann mit Reis, frischem Fisch und Gemüse gefüllt werden. '),
(7, 'Gunkan-Maki', 'Gunkan-Maki heißen übersetzt “Schlachtschiff-Rollen-Sushi” und sind in schmale Streifen geschnittene Noriblätter, die zu niedrigen Rollen geformt werden. Auf einem Boden aus Reis im Inneren der Norirolle sind dann bevorzugt druckempfindliche Füllungen wie Fischrogen und Kaviar enthalten, die in gerollten Maki sonst zerquetscht würden. '),
(8, 'Nigiri-Sushi', 'Nigiri-Sushi: (übersetzt: “Ballen-Sushi” oder “Griff-Sushi”) Bei dieser Sushiform wird eine kleine Menge Sushireis zu einer schmalen, fingerlangen Rolle geformt und dann mit Fisch oder Tamagoyaki (Omelett) belegt. Um dem Belag Halt zu verleihen, wird manchmal noch ein dünner Streifen Nori um das Nigiri gewickelt.<br><br>\r\n\r\nBei dieser Sushiform dippt man nur den Fisch vorsichtig in die Sojasauce, da sonst das ganze Gebilde zerfällt.'),
(9, 'Sashimi', 'Sashimi ist die purste Form von Sushi. Hier wird komplett auf Reis oder andere Beilagen verzichtet. Sashimi ist lediglich der rohe, fein filetierte, ganz frische Fisch. Für diese Sushiform wird ausschließlich bestes Filet verwendet, das mit einem speziellen Messer (Hocho) in 3–4mm dünne Scheiben geschnitten wird. Sashimi wird nicht gewürzt. Besonders wichtig bei Sashimi ist auch die kunstvolle und ästhetische Präsentation des Fisches, wie sie z.B. auch beim traditionellen Kaiseki-Menü eingesetzt wird.'),
(10, 'Chirashi', 'Chirashi-Sushi: (übersetzt “gestreutes Sushi”) Bei dieser Sushi-Variante werden Fisch und Gemüse filetiert und geschnitten und anmutig dekoriert lose in einer Schüssel auf einem Bett von Reis serviert.'),
(11, 'Oshi', 'Oshi-Sushi: (übersetzt “gepresstes Sushi”) Bei dieser Sushiform werden Reis, Fisch und Gemüse in eine Form aus Holz gelegt, mit Steinen beschwert und gepresst. Der Sushi-Laib wird dann in kleine Scheiben geschnitten.'),
(12, 'Inari', 'Inari-Sushi: Auch Fuchs-Sushi genannt ist frittiertes Sushi. Dabei wird eine Teigtasche aus frittiertem Tofu (Aburaage) mit Reis und gelegentlich auch Fisch oder Gemüse gefüllt. Inari ist die japanische Gottheit der Fruchtbarkeit, der Füchse und des Reises. Nach einer Legende soll die frittierte Teigtasche das Leibgericht der Füchse sein – daher trägt dieses Sushi den Namen der Gottheit Inari.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutaten`
--

CREATE TABLE `zutaten` (
  `zid` int(10) UNSIGNED NOT NULL,
  `rid` int(10) UNSIGNED NOT NULL,
  `ehid` int(10) UNSIGNED NOT NULL,
  `kid` int(10) UNSIGNED NOT NULL,
  `menge` float UNSIGNED NOT NULL,
  `zutat` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `zutaten`
--

INSERT INTO `zutaten` (`zid`, `rid`, `ehid`, `kid`, `menge`, `zutat`) VALUES
(1, 1, 16, 1, 200, 'Sushi Reis'),
(2, 1, 13, 1, 3, 'Reisessig'),
(3, 1, 45, 1, 1, 'Salz'),
(4, 1, 1, 2, 0.5, 'reife Avocado'),
(5, 1, 1, 2, 1, 'mittelgroße Süßkartoffel'),
(6, 1, 1, 2, 1, 'Rote Beete (roh)'),
(7, 1, 1, 3, 0, 'Nori Algenblätter'),
(8, 1, 1, 3, 0, 'Sojasauce'),
(9, 1, 1, 3, 0, 'Sesamkörner, Geröstete Sesam Körner zur Veredelung'),
(12, 3, 16, 1, 150, 'Sushi Reis'),
(13, 3, 31, 1, 10, 'Reisessig'),
(14, 3, 37, 1, 1, 'Salz'),
(15, 3, 37, 1, 1, 'Zucker / alternatives Süßungsmittel (Erythrit, Ahornsirup...)'),
(16, 3, 1, 3, 6, 'Reispapier'),
(17, 3, 42, 3, 6, 'Sashimi'),
(18, 3, 16, 3, 100, 'Algensalat'),
(19, 3, 1, 6, 0, 'Sesamkörner'),
(20, 3, 1, 6, 0, 'Sojasauce'),
(21, 3, 1, 6, 0, 'Wasabi');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `anlass`
--
ALTER TABLE `anlass`
  ADD PRIMARY KEY (`aid`);

--
-- Indizes für die Tabelle `bilder`
--
ALTER TABLE `bilder`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `rid` (`rid`);

--
-- Indizes für die Tabelle `einheiten`
--
ALTER TABLE `einheiten`
  ADD PRIMARY KEY (`ehid`);

--
-- Indizes für die Tabelle `erneahrung`
--
ALTER TABLE `erneahrung`
  ADD PRIMARY KEY (`eid`);

--
-- Indizes für die Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`kid`);

--
-- Indizes für die Tabelle `laender`
--
ALTER TABLE `laender`
  ADD PRIMARY KEY (`lid`);

--
-- Indizes für die Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `lid` (`lid`),
  ADD KEY `eid` (`eid`),
  ADD KEY `aid` (`aid`);

--
-- Indizes für die Tabelle `seiten`
--
ALTER TABLE `seiten`
  ADD PRIMARY KEY (`seitenid`);

--
-- Indizes für die Tabelle `sushiarten`
--
ALTER TABLE `sushiarten`
  ADD PRIMARY KEY (`sid`);

--
-- Indizes für die Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  ADD PRIMARY KEY (`zid`),
  ADD KEY `rid` (`rid`),
  ADD KEY `kid` (`kid`),
  ADD KEY `ehid` (`ehid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `anlass`
--
ALTER TABLE `anlass`
  MODIFY `aid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `bilder`
--
ALTER TABLE `bilder`
  MODIFY `bid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `einheiten`
--
ALTER TABLE `einheiten`
  MODIFY `ehid` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT für Tabelle `erneahrung`
--
ALTER TABLE `erneahrung`
  MODIFY `eid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `kid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `laender`
--
ALTER TABLE `laender`
  MODIFY `lid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  MODIFY `rid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `seiten`
--
ALTER TABLE `seiten`
  MODIFY `seitenid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `sushiarten`
--
ALTER TABLE `sushiarten`
  MODIFY `sid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  MODIFY `zid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bilder`
--
ALTER TABLE `bilder`
  ADD CONSTRAINT `bilder_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `rezepte` (`rid`);

--
-- Constraints der Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  ADD CONSTRAINT `rezepte_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sushiarten` (`sid`),
  ADD CONSTRAINT `rezepte_ibfk_2` FOREIGN KEY (`lid`) REFERENCES `laender` (`lid`),
  ADD CONSTRAINT `rezepte_ibfk_4` FOREIGN KEY (`eid`) REFERENCES `erneahrung` (`eid`),
  ADD CONSTRAINT `rezepte_ibfk_5` FOREIGN KEY (`aid`) REFERENCES `anlass` (`aid`);

--
-- Constraints der Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  ADD CONSTRAINT `zutaten_ibfk_2` FOREIGN KEY (`kid`) REFERENCES `kategorie` (`kid`),
  ADD CONSTRAINT `zutaten_ibfk_3` FOREIGN KEY (`rid`) REFERENCES `rezepte` (`rid`),
  ADD CONSTRAINT `zutaten_ibfk_4` FOREIGN KEY (`ehid`) REFERENCES `einheiten` (`ehid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
