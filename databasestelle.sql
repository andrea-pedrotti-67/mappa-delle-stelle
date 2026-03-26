-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 26, 2026 alle 12:00
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databasestelle`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `costellazioni`
--

CREATE TABLE `costellazioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `costellazioni`
--

INSERT INTO `costellazioni` (`id`, `nome`) VALUES
(1, 'Orione'),
(2, 'Orsa Maggiore'),
(3, 'Lira'),
(4, 'Cane Maggiore'),
(5, 'Cigno');

-- --------------------------------------------------------

--
-- Struttura della tabella `stelle`
--

CREATE TABLE `stelle` (
  `codice_sao` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `coordinate` varchar(255) NOT NULL,
  `id_costellazione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `stelle`
--

INSERT INTO `stelle` (`codice_sao`, `nome`, `coordinate`, `id_costellazione`) VALUES
(49941, 'Deneb', '20h 41m 25s | +45° 16′ 49″', 5),
(67315, 'Vega', '18h 36m 56s | +38° 47′ 01″', 3),
(112444, 'Rigel', '05h 14m 32s | -08° 12′ 06″', 1),
(113271, 'Betelgeuse', '05h 55m 10s | +07° 24′ 25″', 1),
(151881, 'Sirio', '06h 45m 08s | -16° 42′ 58″', 4);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `costellazioni`
--
ALTER TABLE `costellazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `stelle`
--
ALTER TABLE `stelle`
  ADD PRIMARY KEY (`codice_sao`),
  ADD KEY `fk_stella_costellazione` (`id_costellazione`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `costellazioni`
--
ALTER TABLE `costellazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `stelle`
--
ALTER TABLE `stelle`
  ADD CONSTRAINT `fk_stella_costellazione` FOREIGN KEY (`id_costellazione`) REFERENCES `costellazioni` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
