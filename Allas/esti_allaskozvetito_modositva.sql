-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Ápr 04. 10:01
-- Kiszolgáló verziója: 10.1.25-MariaDB
-- PHP verzió: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `esti_allaskozvetito`
--
CREATE DATABASE IF NOT EXISTS `esti_allaskozvetito` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `esti_allaskozvetito`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allasok`
--

CREATE TABLE `allasok` (
  `id` int(11) NOT NULL,
  `kategoria_id` int(11) NOT NULL,
  `munkaado` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `munkakor` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `leiras` varchar(1000) COLLATE utf8_hungarian_ci NOT NULL,
  `fizetes` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `hely` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `kapcsolat_id` int(11) NOT NULL,
  `rogzitve` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `allasok`
--

INSERT INTO `allasok` (`id`, `kategoria_id`, `munkaado`, `munkakor`, `leiras`, `fizetes`, `hely`, `kapcsolat_id`, `rogzitve`) VALUES
(1, 6, 'Siemens', 'Senior Frontend fejlesztő', 'Tapasztalt, új technológiák felé nyitott frontend szoftverfejlesztő kollégákat keresünk SCRUM csapatunkba, akik\r\n    megbízható és innovatív alkalmazásokat készítenek megfogalmazott követelmények alapján vasúttechnikai területre - Linux platformon.\r\n    A felelősségi körbe beletartozik a specifikációk készítése, az implementáció, a tesztelés, a szoftver integráció és bizony a dokumentálás is.\r\n    Ehhez kapcsolatban kell lennünk az irodában dolgozó és a külföldi kollégákkal is,\r\n    akikkel közösen készítjük a reszponzív dizájnt megvalósító (okostelefonon, tableten és PCn is megjelenni képes) megoldásokat.\r\n', '700000', 'Budapest', 1, '2020-04-01 07:29:39'),
(2, 6, 'EPAM', 'Junior tesztelő', 'Tesztelési munkák', '200eFt', 'Szeged', 1, '2020-04-04 07:29:39'),
(3, 6, 'EPAM', 'Junior JAVA fejlesztő', 'CSapatjátékos, projektek megvalósításában való részvétel', '200eFt', 'Szeged', 1, '2020-04-04 07:29:39'),
(4, 6, 'EPAM', 'DevOps', 'Docker specialista, tesztkörnyezetek kialakítása', '200eFt', 'Szeged', 1, '2020-04-04 07:29:39'),
(5, 6, 'Vasvári P.', 'rendszergazda', 'Helyrerakni, amit a felhasználók elrontanak.', '150000', 'Szeged', 1, '2020-03-03 08:29:39'),
(7, 7, 'Halaggyámán Bt.', 'Talicskatologató', 'Talicskát jobbra-balra tologatni.', 'ócccó', 'homokkupac mellett', 1, '2020-04-02 07:29:39'),
(8, 6, 'Kiss Bt.', 'fitt IT', 'kerékpáron áramgenerálással programozás', '100000', 'Szeged', 1, '2020-04-04 07:29:39'),
(9, 2, 'Dakk Zrt.', 'buszsofőr', 'Emberek szállítása.', '150 000 Ft', 'Szeged', 1, '2020-04-01 06:29:39'),
(10, 4, 'SPAR', 'pénztáros', 'Beosztás szerint pénztárosi feladatok ellátása, esetenként egyéb feladatok elvégzése', 'Mgegyezés szerint', 'Szeged', 2, '2020-04-04 07:29:39'),
(11, 8, 'Üvegház Bt.', 'Mezőgazdasági munkás', 'Üvegházban a napi feladatok ellátása', 'Megegyezés szerint', 'Szentes', 2, '2020-04-04 07:29:39'),
(12, 4, 'OC - ingatlanközvetítő', 'Ingatlanértékesítő', 'Ingatlanok felmérése, bemutatása, hirdetések feladása', 'Megbízás szerint', 'Kecskemét', 2, '2020-04-04 07:29:39'),
(13, 10, 'SZTE klinikák', 'nővér', 'Nővéri feladatok ellátása', 'Vonatkozó jogszabályok szerint', 'Szeged II. kórház', 2, '2020-04-04 07:29:39');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kapcsolatok`
--

CREATE TABLE `kapcsolatok` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kapcsolatok`
--

INSERT INTO `kapcsolatok` (`id`, `nev`, `email`, `jelszo`) VALUES
(1, 'Zoltan', 'zoltan@allaskozvetito.hu', 'jelszo123'),
(2, 'Regina', 'regina@allaskozvetito.hu', 'jelszo123');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `id` int(11) NOT NULL,
  `kategoria` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kategoriak`
--

INSERT INTO `kategoriak` (`id`, `kategoria`) VALUES
(2, 'Személyszállítás'),
(4, 'Értékesítés, kereskedelem'),
(6, 'Informatika, telekommunikáció'),
(7, 'Építőipar'),
(8, 'Mezőgazdaság'),
(9, 'Logisztika, beszerzés'),
(10, 'Egészségügy, gyógyszeripar');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allasok`
--
ALTER TABLE `allasok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kapcsolat_id` (`kapcsolat_id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- A tábla indexei `kapcsolatok`
--
ALTER TABLE `kapcsolatok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `allasok`
--
ALTER TABLE `allasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT a táblához `kapcsolatok`
--
ALTER TABLE `kapcsolatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `allasok`
--
ALTER TABLE `allasok`
  ADD CONSTRAINT `allasok_ibfk_1` FOREIGN KEY (`kapcsolat_id`) REFERENCES `kapcsolatok` (`id`),
  ADD CONSTRAINT `allasok_ibfk_2` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoriak` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
