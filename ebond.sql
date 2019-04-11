-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Ápr 11. 19:58
-- Kiszolgáló verziója: 10.1.38-MariaDB
-- PHP verzió: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `ebond`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozo`
--

CREATE TABLE `dolgozo` (
  `id` int(11) NOT NULL,
  `nev` varchar(56) NOT NULL,
  `beosztas` varchar(56) NOT NULL,
  `email` varchar(56) NOT NULL,
  `telefon` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `dolgozo`
--

INSERT INTO `dolgozo` (`id`, `nev`, `beosztas`, `email`, `telefon`) VALUES
(1, 'Teszt Elek', 'Tesztelő', 'elek@melo.com', '+36201234567'),
(2, 'Kiss Ádám', 'Webfejlesztő', 'kiss@teszt.hu', '+36307654321'),
(8, 'Próba Ákos', 'Fejlesztő', 'proba@teszt.hu', '+36201111111'),
(9, 'Végh István', 'Backend fejlesztő', 'vegh@proba.hu', '+36701111222');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `elvegzett`
--

CREATE TABLE `elvegzett` (
  `id` int(11) NOT NULL,
  `feladat` int(11) NOT NULL,
  `dolgozo` int(11) NOT NULL,
  `oraszam` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `elvegzett`
--

INSERT INTO `elvegzett` (`id`, `feladat`, `dolgozo`, `oraszam`) VALUES
(1, 1, 1, 3),
(2, 8, 2, 4),
(3, 12, 9, 4);

--
-- Eseményindítók `elvegzett`
--
DELIMITER $$
CREATE TRIGGER `mark as finished` AFTER INSERT ON `elvegzett` FOR EACH ROW UPDATE feladat SET statusz='kész' WHERE feladat.id=new.feladat
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `feladat`
--

CREATE TABLE `feladat` (
  `id` int(11) NOT NULL,
  `megnevezes` varchar(128) NOT NULL,
  `leiras` text,
  `partner` int(11) NOT NULL,
  `statusz` enum('inaktív','folyamatban','kész','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `feladat`
--

INSERT INTO `feladat` (`id`, `megnevezes`, `leiras`, `partner`, `statusz`) VALUES
(1, 'Unit tesztek írása', 'Unit tesztek írása Projektnek', 1, 'kész'),
(8, 'Frontend fejlesztés', 'Frontend fejlesztése Próbának', 2, 'kész'),
(9, 'Backend fejlesztés', 'Backend fejlesztése Próbának', 2, 'folyamatban'),
(11, 'PHP fejlesztés', 'Weboldalak írása CI-vel és BS-el', 3, 'inaktív'),
(12, 'Végső tesztelés', 'Befejező tesztelés átadás előtt', 1, 'kész');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `partner`
--

CREATE TABLE `partner` (
  `id` int(11) NOT NULL,
  `nev` varchar(56) NOT NULL,
  `cim` varchar(56) NOT NULL,
  `email` varchar(56) NOT NULL,
  `telefon` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `partner`
--

INSERT INTO `partner` (`id`, `nev`, `cim`, `email`, `telefon`) VALUES
(1, 'Projekt Kft', 'Hódmezővásárhely, Lázár u. 14', 'info@projekt.hu', '+36201234567'),
(2, 'Próba Bt', 'Szeged, Vitéz u. 14', 'info@proba.hu', '+36302222222'),
(3, 'Finale Rt', 'Szentes, Herczeg u. 6-8', 'hr@finale.hu', '+36624564466');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `dolgozo`
--
ALTER TABLE `dolgozo`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `elvegzett`
--
ALTER TABLE `elvegzett`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feladat` (`feladat`),
  ADD KEY `dolgozo` (`dolgozo`);

--
-- A tábla indexei `feladat`
--
ALTER TABLE `feladat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partner` (`partner`);

--
-- A tábla indexei `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nev` (`nev`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `dolgozo`
--
ALTER TABLE `dolgozo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `elvegzett`
--
ALTER TABLE `elvegzett`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `feladat`
--
ALTER TABLE `feladat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `elvegzett`
--
ALTER TABLE `elvegzett`
  ADD CONSTRAINT `elvegzett_ibfk_1` FOREIGN KEY (`feladat`) REFERENCES `feladat` (`id`),
  ADD CONSTRAINT `elvegzett_ibfk_2` FOREIGN KEY (`dolgozo`) REFERENCES `dolgozo` (`id`);

--
-- Megkötések a táblához `feladat`
--
ALTER TABLE `feladat`
  ADD CONSTRAINT `feladat_ibfk_1` FOREIGN KEY (`partner`) REFERENCES `partner` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
