-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2020 at 04:15 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_corador`
--

-- --------------------------------------------------------

--
-- Table structure for table `instrument`
--

CREATE TABLE `instrument` (
  `id_instrument` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(7,2) NOT NULL DEFAULT 0.00,
  `details` varchar(128) NOT NULL,
  `id_type_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instrument`
--

INSERT INTO `instrument` (`id_instrument`, `name`, `price`, `details`, `id_type_fk`) VALUES
(1, 'violin', '696.99', 'Nicolas Marty and Antonio Stella Bottom Tile in the Italian Craig mona ', 1),
(2, 'viola', '896.00', 'the family is the main members of the family system of other members are: (the viola, the cello and the bass).', 1),
(3, 'cello', '12896.15', 'the family is the main members of the family system of other members are: (tthe cello and the bass).', 1),
(4, 'doubleBass', '99999.99', 'the family is the main members of the family system of other members are: (the the bass).', 1),
(5, 'piano', '65536.65', 'the piano is qque king of instruments idsjlk', 3),
(6, 'clavicembalo', '86420.00', 'twangy instrument for funk lol dates back to the baroque period', 3),
(7, 'harpsichord', '999.00', 'serious baroque insturment royalty family lol bach made so many cool jams with this thing xdxdxddxd or they play it here idk', 3),
(8, 'baritoneSax', '5643.56', 'lo que daria por oir a lisa tocar una de esas melodias de jazz\r\nsaxobofooon saxobofoooon', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ins_type`
--

CREATE TABLE `ins_type` (
  `id_type` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ins_type`
--

INSERT INTO `ins_type` (`id_type`, `name`) VALUES
(1, 'strings'),
(2, 'winds'),
(3, 'keys'),
(4, 'percussion'),
(5, 'drums'),
(6, 'elecStrings'),
(7, 'elecKeys');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instrument`
--
ALTER TABLE `instrument`
  ADD KEY `id_type_fk` (`id_type_fk`);

--
-- Indexes for table `ins_type`
--
ALTER TABLE `ins_type`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ins_type`
--
ALTER TABLE `ins_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instrument`
--
ALTER TABLE `instrument`
  ADD CONSTRAINT `instrument_ibfk_1` FOREIGN KEY (`id_type_fk`) REFERENCES `ins_type` (`id_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
