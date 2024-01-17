-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 16, 2023 at 08:43 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mati`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_license`
--

CREATE TABLE `category_license` (
  `category_ID` int(11) NOT NULL,
  `category_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_license`
--

INSERT INTO `category_license` (`category_ID`, `category_name`) VALUES
(1, 'Bezpieczeństwo'),
(2, 'Grafika'),
(3, 'Analiza danych');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `license`
--

CREATE TABLE `license` (
  `license_ID` int(11) NOT NULL,
  `license_name` varchar(50) NOT NULL,
  `license_supplier` varchar(50) NOT NULL,
  `license_serialNumber` varchar(100) NOT NULL,
  `license_buyDate` date NOT NULL,
  `license_endDate` date NOT NULL,
  `license_description` longtext NOT NULL,
  `category_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `license`
--

INSERT INTO `license` (`license_ID`, `license_name`, `license_supplier`, `license_serialNumber`, `license_buyDate`, `license_endDate`, `license_description`, `category_ID`) VALUES
(1, 'FirewallGuardPro', 'SecuritySoft Solutions', '1234-ABCD-5678-EFGH', '2023-06-15', '2023-06-16', 'Licencja zapewniająca zaawansowany firewall, ochronę przed atakami sieciowymi i filtrowanie ruchu w celu zabezpieczenia sieci przed zagrożeniami.                                                                        ', 1),
(2, 'GraphicDesign Pro', 'CreativeTech Solutions', 'WXYZ-2468-QWER-1357', '2023-06-15', '2024-06-11', 'Licencja wieczysta umożliwiająca profesjonalne projektowanie graficzne, w tym tworzenie logotypów, projektowanie materiałów reklamowych i edycję zdjęć.', 2),
(3, 'DataAnalytics Pro', 'DataMetrics Corporation', 'POIU-9876-LKJH-5432', '2023-06-14', '2024-06-06', 'Licencja umożliwiająca zaawansowaną analizę danych, w tym modelowanie predykcyjne, segmentację danych i zaawansowane raportowanie.', 3),
(5, 'ProjectPlanner Pro', 'ProjectSoft Systems', '9753-QWER-7412-POIU', '2023-06-16', '2023-07-21', 'Licencja wieczysta umożliwiająca kompleksowe zarządzanie projektami, w tym zarządzanie zadaniami, harmonogramowanie, zarządzanie ryzykiem i generowanie raportów.', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(40) NOT NULL,
  `users_surename` varchar(40) NOT NULL,
  `users_email` varchar(60) NOT NULL,
  `users_pesel` varchar(15) NOT NULL,
  `users_pwd` varchar(60) NOT NULL,
  `users_role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `users_surename`, `users_email`, `users_pesel`, `users_pwd`, `users_role`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '12345678901', '$2y$10$Tle/FRB.bpYOX9LpG6W62.f857HK8MunUOE9tddXeREitNASgq9b6', 'admin'),
(2, 'Jan', 'Malarz', 'jan@malarz.com', '12345678901', '$2y$10$BRnDgZCnIadDoIhdiMN5HOZUC9jPaYXQ01LkIR2H3OkXmGAx2u7gG', 'pracownik'),
(3, 'filip', 'filip', 'filip@filip.com', '12345678901', '$2y$10$PXLOp0h1FSEzgGFtaYe3VuYPRuP5sEw0BwL1x1n8v61At6M9ku2u2', 'kierownik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_license`
--

CREATE TABLE `users_license` (
  `ID` int(11) NOT NULL,
  `license_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_license`
--

INSERT INTO `users_license` (`ID`, `license_id`, `users_id`, `status`) VALUES
(1, 2, 1, 'accept'),
(2, 2, 2, 'accept'),
(3, 1, 3, 'reject'),
(4, 2, 3, 'waiting'),
(5, 2, 1, 'reject'),
(6, 4, 1, 'waiting'),
(7, 4, 1, 'waiting'),
(8, 3, 1, 'waiting');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category_license`
--
ALTER TABLE `category_license`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indeksy dla tabeli `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`license_ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indeksy dla tabeli `users_license`
--
ALTER TABLE `users_license`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_license`
--
ALTER TABLE `category_license`
  MODIFY `category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `license`
--
ALTER TABLE `license`
  MODIFY `license_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_license`
--
ALTER TABLE `users_license`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
