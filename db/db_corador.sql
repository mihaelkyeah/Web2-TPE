-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 11:20 PM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `details`) VALUES
(1, 'Strings', 'String instruments, stringed instruments, or chordophones are musical instruments that produce sound from vibrating strings when the performer plays or sounds the strings in some manner.'),
(2, 'Winds', 'A wind instrument is a musical instrument that contains some type of resonator (usually a tube) in which a column of air is set into vibration by the player blowing into (or over) a mouthpiece set at or near the end of the resonator.'),
(3, 'Keys', 'A keyboard instrument is a musical instrument played using a keyboard, a row of levers which are pressed by the fingers. The most common of these are the piano, organ, and various electronic keyboards, including synthesizers and digital pianos.'),
(4, 'Percussion', 'A percussion instrument is a musical instrument that is sounded by being struck or scraped by a beater including attached or enclosed beaters or rattles struck, scraped or rubbed by hand or struck against another similar instrument.'),
(5, 'Electric Strings', 'Most string instruments can be fitted with piezoelectric or magnetic pickups to convert the string\'s vibrations into an electrical signal that is amplified and then converted back into sound by loudspeakers.'),
(6, 'Electric Keys', 'An electronic keyboard, portable keyboard, or digital keyboard is an electronic musical instrument, derivative of keyboard instruments. These include synthesizers, digital pianos, stage pianos, electronic organs and digital audio workstations.'),
(7, 'Drums', 'The drum is a member of the percussion group of musical instruments. In the Hornbostel-Sachs classification system, it is a membranophone. A number of different drums together with cymbals form the basic modern drum kit.'),
(8, 'Sasarasa', 'dfjgiosdjgposdfimtgpaosdijfmnpsadoijfmapsdoifjdsampofijadspofadsijfasdpmofijsadmpfoisjdmfpoaigjmdfpoishfjhmpofsdijh,fsdpogijdsfpogisdjfgposdfijgperoituerpotyepgoirmpsnpfoiudsfoiasdjfnpoadsifjgndfpoigjsmdpfogijsdmpogdfij,gpodfisjg,s\'o8tnepaotfhermpotujearp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
