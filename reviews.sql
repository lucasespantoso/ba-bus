-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2023 at 07:45 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `likes` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `rating`, `comment`, `date`, `likes`) VALUES
(1, 'Carlos', 5, 'Excelente servicio! Volveré a viajar con BA-BUS', '2023-07-01', 29),
(2, 'Maria', 4, 'Los micros son limpios y confortables pero no realizan paradas intermedias hacia Mar del Plata.', '2023-07-03', 35),
(6, 'Jose', 3, 'Mi experiencia no fue tan buena como esperaba.', '2023-06-30', 8),
(7, 'Margarita', 5, 'Hermoso viaje en familia hicimos gracias a ba-bus!!! Lo super recomiendo!', '2023-06-24', 13),
(8, 'Gonzalo', 4, 'Si viajás en primera tienen servicio a bordo, pero no me dieron coca-cola. El resto todo ok!', '2023-07-26', 18),
(9, 'Rosa', 5, 'Me encantó el viaje a Córdoba en primera clase tomando unos ricos matesitos.', '2023-07-01', 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
