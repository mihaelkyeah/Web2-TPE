-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2020 at 08:11 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `ins_name` varchar(30) NOT NULL,
  `price` decimal(7,2) NOT NULL DEFAULT 0.00,
  `details` varchar(128) NOT NULL,
  `id_categ_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instrument`
--

INSERT INTO `instrument` (`id_instrument`, `ins_name`, `price`, `details`, `id_categ_fk`) VALUES
(1, 'violin', '699.99', 'Nicolas Marty and Antonio Stella Bottom Tile in the Italian Craig mona', 1),
(2, 'viola', '896.00', 'the family is the main members of the family system of other members are: (the viola, the cello and the bass).', 1),
(3, 'cello', '12896.15', 'the family is the main members of the family system of other members are: (tthe cello and the bass).', 1),
(4, 'doubleBass', '99999.99', 'the family is the main members of the family system of other members are: (the the bass).', 1),
(5, 'piano', '65536.65', 'the piano is qque king of instruments idsjlk', 3),
(6, 'clavicembalo', '86420.00', 'twangy instrument for funk lol dates back to the baroque period', 3),
(7, 'harpsichord', '999.00', 'serious baroque insturment royalty family lol bach made so many cool jams with this thing xdxdxddxd or they play it here idk', 3),
(8, 'baritoneSax', '5643.56', 'lo que daria por oir a lisa tocar una de esas melodias de jazz\r\nsaxobofooon saxobofoooon', 2),
(9, 'tenorSax', '789.99', 'saxotenoooor, saxootenooooor', 2),
(10, 'altoSax', '8910.00', 'el saxo alto es un saxo que es más alto que el tenor y por eso se le dice alto. porque es muy alto. jajajaja qué gracioso soy', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ins_categ`
--

CREATE TABLE `ins_categ` (
  `id_categ` int(11) NOT NULL,
  `categ_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ins_categ`
--

INSERT INTO `ins_categ` (`id_categ`, `categ_name`) VALUES
(1, 'strings'),
(2, 'winds'),
(3, 'keys'),
(4, 'percussion'),
(5, 'elecStrings'),
(6, 'elecKeys'),
(7, 'drums');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instrument`
--
ALTER TABLE `instrument`
  ADD PRIMARY KEY (`id_instrument`),
  ADD KEY `id_categ_fk` (`id_categ_fk`);

--
-- Indexes for table `ins_categ`
--
ALTER TABLE `ins_categ`
  ADD PRIMARY KEY (`id_categ`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instrument`
--
ALTER TABLE `instrument`
  MODIFY `id_instrument` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ins_categ`
--
ALTER TABLE `ins_categ`
  MODIFY `id_categ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instrument`
--
ALTER TABLE `instrument`
  ADD CONSTRAINT `instrument_ibfk_1` FOREIGN KEY (`id_categ_fk`) REFERENCES `ins_categ` (`id_categ`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
