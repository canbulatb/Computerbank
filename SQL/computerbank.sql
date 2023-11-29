-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 nov 2023 om 18:38
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computerbank`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_successful` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reparatie`
--

CREATE TABLE `reparatie` (
  `id` int(11) NOT NULL,
  `datum_aanname` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `aangenomen_door` varchar(255) DEFAULT NULL,
  `naam_klant` varchar(255) DEFAULT NULL,
  `telefoonnummer_klant` varchar(20) DEFAULT NULL,
  `email_klant` varchar(255) DEFAULT NULL,
  `kenmerk_computer` text DEFAULT NULL,
  `opbergplaats_computer` varchar(255) DEFAULT NULL,
  `opmerking` text DEFAULT NULL,
  `omschrijving_probleem` text DEFAULT NULL,
  `wie_repareren` varchar(255) DEFAULT NULL,
  `kost` decimal(10,2) DEFAULT NULL,
  `kost_b` varchar(20) DEFAULT NULL,
  `resultaten` varchar(1) NOT NULL,
  `sil` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reparatie`
--

INSERT INTO `reparatie` (`id`, `datum_aanname`, `user_id`, `aangenomen_door`, `naam_klant`, `telefoonnummer_klant`, `email_klant`, `kenmerk_computer`, `opbergplaats_computer`, `opmerking`, `omschrijving_probleem`, `wie_repareren`, `kost`, `kost_b`, `resultaten`, `sil`) VALUES
(9, '2023-09-25', 4, 'bilal', 'Bilal', 'hdfghdfg', 'ghdfghdfg', 'hdfghdfg', 'hdfghdfgh', 'dfghdfgh', 'dfghdfgh', 'dfghdfgh', 100.00, 'Euro', '1', 0),
(10, '2023-09-23', 2, 'Bilal', 'canblt', 'sadfa', 'asdf', 'asdf\' asdlkjfasdj ', 'asdf', 'sdfas', 'asdfa', 'asdfas', 150.00, 'Euro', '0', 0),
(11, '2023-09-27', 3, 'deneme', 'Alex', '99879890', 'jasdflahsd@gmail.com', 'aşlkjdfşalk', 'kajsdşlfj', 'ljalşkjsdfl', 'ljşlkjşlkasjdf', 'kjasldfkjşl', 145.00, 'Euro', '0', 0),
(12, '2023-09-25', 7, 'Alican', 'Albert', 'asdgasdg', 'safgasd', 'asdfasdg', 'asdgas', 'asdgasdg', 'asgasd', 'asgasd', 175.00, 'Euro', '0', 0),
(13, '2023-09-29', 3, 'Baas', 'Ali', '987', 'aşlksfjaskdj', 'aşsldfjaşlskd', 'aşslkdfjşalksjd', 'şalkdjfşalskdjfşlskdj', 'şlaksdjfşalkjsdşflk', 'alksdjfşalkjsdf', 150.00, 'Euro', '1', 0),
(14, '2023-09-29', 1, 'baas', 'Henk', '12345', 'ljşlksjaoıwejşfas^\'£\'@', 'şlkjasdofıjaşoıj', 'şlasjdfıasşdfıjş', 'şaosıdfoşaısdjf', 'jşaosıdfjşaıosjdş', 'jaosıdfjşoaısdjş', 149.00, 'Euro', '0', 0),
(15, '2023-10-25', 1, 'baas', 'wfeqw', 'qqwer', 'werqw', '12\'', '', '', '', '', 0.00, 'Euro', '0', 0),
(16, '2023-10-25', 2, 'Bilal', '1233344444', 'eadfa', '', 'deneme12', '', '', '', '', 0.00, 'Euro', '0', 0),
(17, '2023-10-25', 2, 'Bilal', '123', '123', '12\'', '', '', '', '', '', 0.00, 'Euro', '0', 0),
(18, '0000-00-00', 2, 'Bilal', 'deneme\'', '', '', '', '', '', '', '', 0.00, 'Euro', '0', 0),
(19, '2023-11-15', 2, 'Bilal', 'adsfa', 'asdfas', 'asdf', 'asdf', 'asdf', 'sadf', 'asdf', '', 0.00, 'Euro', '0', 0),
(20, '2023-11-15', 13, 'BBB', 'ALEX', 'QREWER', 'QWERQ', 'QWERQ', 'QWER', 'QWERQ', 'QWERQ', 'QWE', 130.00, 'Euro', '0', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `yetki` tinyint(4) NOT NULL,
  `sil` tinyint(4) NOT NULL,
  `kim_gorebilir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `isAdmin`, `created_at`, `yetki`, `sil`, `kim_gorebilir`) VALUES
(1, 'baas', '$2y$10$Y2o4zoiH.suU.7f7FyYIquzeIONU2d3AEvuWnCvYUCm5EEGXEU7t2', 1, '2023-09-19 21:10:23', 5, 0, '0'),
(2, 'Bilal', '$2y$10$3GeMy3TQmXYbaqY5tGRwquWOQqnVeJY3dn8fEh/cZhFrcJhS5Ggbq', 1, '2023-09-20 11:49:44', 9, 0, ''),
(3, 'deneme', '$2y$10$ng47vtRG1/WZeIBWspXrBuyA2wa88ATwaLmWa4tfN8aTC9lwpaUAm', 0, '2023-09-20 12:56:08', 5, 0, '0'),
(4, 'computerbank', '$2y$10$NITMo2nt0Mg4YW4jtXnI3OYVzdwl2CmJITfetmHDceW1gknbRGXpS', 1, '2023-09-27 08:32:07', 5, 0, ''),
(5, 'asdf', '$2y$10$8dmvbk3m4xTI/ASZm5Ex5eZEdC/x90IbGTXviI95R606bDnmO6xM6', 0, '2023-09-27 08:35:56', 5, 0, ''),
(7, 'baas10', '$2y$10$WzgQ884abelkJfFSCibJ4Oem2ZBx.ogZ/xOp5PsABAIgEy6uxhDgK', 0, '2023-09-27 10:42:47', 5, 0, ''),
(8, 'AHMET', '$2y$10$3GeMy3TQmXYbaqY5tGRwquWOQqnVeJY3dn8fEh/cZhFrcJhS5Ggbq', 1, '2023-10-04 10:00:47', 5, 1, ''),
(9, 'ALİ', '$2y$10$gnk3Q2gH.N5u7R59mbTP1u5An/DVjHZ7HM1f0KVTCoQ4VVePE7osS', 1, '2023-10-04 10:01:17', 5, 1, ''),
(10, 'ASDFG', '$2y$10$uAYSXy1r5j15G4zfRyVIUOPlvXwC.06TlrzDOSqadvHVu2GhR97Fa', 1, '2023-10-04 10:02:22', 5, 1, ''),
(11, 'veli', '$2y$10$r2yRdW5kJNUluteEczWKRulgeinzgqCbIv8y58RI5Ba6/4zZNMkhi', 1, '2023-11-01 10:40:32', 9, 0, ''),
(12, 'AAA', '$2y$10$Uy3dK.j5hh2Az3waTnhfr.XUSsNDWjP12qW0gE4hNI6utW1.qYSX2', 1, '2023-11-15 13:08:43', 5, 0, '0'),
(13, 'BBB', '$2y$10$TTbaCjzQdKT9v741QXYeMeCo9LVYf7epMjpMglTCzeyjzgWDyzxG.', 1, '2023-11-15 13:36:08', 5, 0, '0');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `reparatie`
--
ALTER TABLE `reparatie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT voor een tabel `reparatie`
--
ALTER TABLE `reparatie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
