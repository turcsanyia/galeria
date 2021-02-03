-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Ápr 01. 17:28
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
-- Adatbázis: `esti_shop`
--
CREATE DATABASE IF NOT EXISTS `esti_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `esti_shop`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `megrendeles`
--

CREATE TABLE `megrendeles` (
  `id` int(11) NOT NULL,
  `vasarlo_id` int(11) NOT NULL,
  `idopont` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `elokeszitve` tinyint(4) NOT NULL DEFAULT '0',
  `szallitas_alatt` tinyint(4) NOT NULL DEFAULT '0',
  `fizetes_alatt` tinyint(4) NOT NULL DEFAULT '0',
  `fizetesi_mod` varchar(30) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `megrendeles`
--

INSERT INTO `megrendeles` (`id`, `vasarlo_id`, `idopont`, `elokeszitve`, `szallitas_alatt`, `fizetes_alatt`, `fizetesi_mod`) VALUES
(70, 2, '2020-04-01 15:31:02', 0, 0, 0, 'cash'),
(71, 2, '2020-04-01 15:31:49', 0, 0, 0, 'paypal'),
(72, 3, '2020-04-01 15:40:00', 0, 0, 0, 'card'),
(74, 3, '2020-04-01 15:42:09', 0, 0, 0, 'cash');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `ar` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `leiras` varchar(1000) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id`, `nev`, `ar`, `mennyiseg`, `leiras`) VALUES
(1, 'Póló', 3000, 5, 'Póló S méret'),
(2, 'Szabadidő felső', 14500, 1, 'Felső'),
(3, 'Vásárlási utalvány', 10000, 1000, '1000 Ft-os címletekben, szabadon felhasználható'),
(4, 'Sál', 3500, 101, 'Sál'),
(5, 'Galléros póló', 4000, 0, 'Majd nyáron'),
(6, 'Szabadidő alsó', 6250, 0, 'Felső párja'),
(7, 'Hátizsák', 7500, 12, '20 l'),
(8, 'Táska', 8200, 54, 'Nagy táska'),
(9, 'Kulacs', 1200, 45, '750 ml'),
(10, 'Korsó', 2500, 2000, '0,5 l'),
(11, 'Bögre', 2500, 3000, 'Kárácsonyi díszítéssel'),
(12, 'Kulcstartó', 1500, 101, 'Kerékpárra'),
(13, 'Téli sapka', 3000, 130, 'Kötött'),
(14, 'Baseball sapka', 5500, 1200, 'Fekete'),
(15, 'Törölköző', 6000, 123, 'Pamut'),
(16, 'Hűtőmágnes', 1500, 134, 'Hűtőre'),
(17, 'Kapucnis pulóver', 9800, 167, 'A hidegebb napokra'),
(18, 'Esernyő', 3500, 154, 'az esős napokra'),
(19, 'Hivatalos mez', 19900, 3400, 'a meccsekre'),
(20, 'Sörnyitó', 600, 2300, 'családi eseményekre');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tetelek`
--

CREATE TABLE `tetelek` (
  `id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `ar` int(11) NOT NULL,
  `megrendeles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tetelek`
--

INSERT INTO `tetelek` (`id`, `termek_id`, `mennyiseg`, `ar`, `megrendeles_id`) VALUES
(1, 1, 1, 3000, 70),
(2, 2, 1, 14500, 71),
(3, 9, 1, 1200, 71),
(4, 15, 1, 6000, 72),
(5, 9, 1, 1200, 74);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `regdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(4) DEFAULT NULL,
  `rights` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `address`, `regdate`, `active`, `rights`) VALUES
(1, 'user@vasvari.hu', '123456', 'Teszt Elek', '9000 Teszt, Elek utca 1.', '0000-00-00 00:00:00', 1, NULL),
(2, 'a@a.hu', '123456', 'Luz Er', 'nincs olyan hely', '0000-00-00 00:00:00', 1, NULL),
(3, 'robi@a.hu', 'robi', 'BR', '64654 Cím', '2019-11-18 16:59:48', NULL, NULL),
(4, 'robi@aa.hu', 'robi', 'BR', 'dwgasdfg', '2019-11-18 17:06:56', NULL, NULL),
(7, 'cim@vas.hu', '123456', 'Vas Botond', '6000 Kecskemét, Katona József u. 1.', '2020-04-01 16:18:07', NULL, NULL);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `megrendeles`
--
ALTER TABLE `megrendeles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vasarlo_id` (`vasarlo_id`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tetelek`
--
ALTER TABLE `tetelek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `megrendeles_id` (`megrendeles_id`),
  ADD KEY `termek_id` (`termek_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `megrendeles`
--
ALTER TABLE `megrendeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT a táblához `tetelek`
--
ALTER TABLE `tetelek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `megrendeles`
--
ALTER TABLE `megrendeles`
  ADD CONSTRAINT `megrendeles_ibfk_1` FOREIGN KEY (`vasarlo_id`) REFERENCES `user` (`id`);

--
-- Megkötések a táblához `tetelek`
--
ALTER TABLE `tetelek`
  ADD CONSTRAINT `tetelek_ibfk_1` FOREIGN KEY (`megrendeles_id`) REFERENCES `megrendeles` (`id`),
  ADD CONSTRAINT `tetelek_ibfk_2` FOREIGN KEY (`termek_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
