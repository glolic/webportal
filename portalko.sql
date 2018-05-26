-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2018 at 05:10 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portalko`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE cp1250_croatian_ci NOT NULL,
  `password` varchar(100) COLLATE cp1250_croatian_ci NOT NULL,
  `name` varchar(50) COLLATE cp1250_croatian_ci NOT NULL,
  `level` varchar(20) COLLATE cp1250_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `level`) VALUES
(4, 'glo', '4297f44b13955235245b2497399d7a93', 'goran', '2'),
(5, 'glolic', '4297f44b13955235245b2497399d7a93', 'Goran Lolic', ''),
(6, 'iafsoijsaoij', '4297f44b13955235245b2497399d7a93', 'ivan', '');

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `naslov` text COLLATE cp1250_croatian_ci NOT NULL,
  `tekst` text COLLATE cp1250_croatian_ci NOT NULL,
  `slika` varchar(64) COLLATE cp1250_croatian_ci NOT NULL,
  `sakrijVijest` varchar(12) COLLATE cp1250_croatian_ci NOT NULL,
  `kategorija` text COLLATE cp1250_croatian_ci NOT NULL,
  `kratkiSadrzaj` text COLLATE cp1250_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `tekst`, `slika`, `sakrijVijest`, `kategorija`, `kratkiSadrzaj`) VALUES
(10, '0000-00-00', 'adsasdasd', 'asdasdasdasd', '', '', 'Sport', 'adsasdadsasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
