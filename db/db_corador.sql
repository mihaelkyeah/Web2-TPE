-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2020 at 07:04 PM
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
  `ins_desc` varchar(255) DEFAULT NULL,
  `id_categ_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instrument`
--

INSERT INTO `instrument` (`id_instrument`, `ins_name`, `price`, `ins_desc`, `id_categ_fk`) VALUES
(1, 'Violin', '699.99', 'The violin is a wooden string instrument in the violin family. It is the smallest and highest-pitched instrument (soprano) in the family in regular use.', 1),
(2, 'Viola', '896.00', 'The viola is a string instrument that is bowed, plucked, or played with varying techniques. Since the 18th century it has been the middle or alto voice of the violin family, between the violin and the cello.', 1),
(3, 'Cello', '12896.15', 'The cello or violoncello is a bowed (and occasionally plucked) string instrument of the violin family. Its four strings are usually tuned an octave lower than those of the viola.', 1),
(4, 'Double Bass', '99999.99', 'The double bass, also known as the contrabass, is the largest and lowest-pitched bowed, (or plucked) string instrument in the modern symphony orchestra.', 1),
(5, 'Piano', '65536.65', 'The word piano is a shortened form of pianoforte, the Italian term for the early 1700s versions of the instrument. The terms \"piano\" and \"forte\" indicate \"soft\" and \"loud\", referring to the variations in volume produced by a pianist\'s touch on the keys.', 3),
(6, 'Harpsichord', '86420.00', 'A harpsichord (Italian: clavicembalo, French: clavecin, German: Cembalo, Spanish: clavecín, Portuguese: cravo) is a musical instrument played by means of a keyboard.', 3),
(7, 'Baritone Sax', '5643.56', 'The baritone saxophone or \"bari sax\" is one of the larger members of the saxophone family, only being smaller than the bass, contrabass and subcontrabass saxophones. It is the lowest-pitched saxophone in common use.', 2),
(8, 'Tenor Sax', '789.99', 'The tenor saxophone is a medium-sized member of the saxophone family, a group of instruments invented by Adolphe Sax in the 1840s. The tenor and the alto are the two most commonly used saxophones.', 2),
(9, 'Alto Sax', '8910.00', 'The alto saxophone, also referred to as the alto sax or simply the alto, is a member of the saxophone family of woodwind instruments invented by Belgian instrument designer Adolphe Sax in the 1840s, and patented in 1846.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ins_category`
--

CREATE TABLE `ins_category` (
  `id_categ` int(11) NOT NULL,
  `categ_name` varchar(30) NOT NULL,
  `categ_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ins_category`
--

INSERT INTO `ins_category` (`id_categ`, `categ_name`, `categ_desc`) VALUES
(1, 'Strings', 'String instruments, stringed instruments, or chordophones are musical instruments that produce sound from vibrating strings when the performer plays or sounds the strings in some manner.'),
(2, 'Winds', 'A wind instrument is a musical instrument that contains some type of resonator (usually a tube) in which a column of air is set into vibration by the player blowing into (or over) a mouthpiece set at or near the end of the resonator.'),
(3, 'Keys', 'A keyboard instrument is a musical instrument played using a keyboard, a row of levers which are pressed by the fingers. The most common of these are the piano, organ, and various electronic keyboards, including synthesizers and digital pianos.'),
(4, 'Percussion', 'A percussion instrument is a musical instrument that is sounded by being struck or scraped by a beater including attached or enclosed beaters or rattles struck, scraped or rubbed by hand or struck against another similar instrument.'),
(5, 'Electric Strings', 'Most string instruments can be fitted with piezoelectric or magnetic pickups to convert the string\'s vibrations into an electrical signal that is amplified and then converted back into sound by loudspeakers.'),
(6, 'Electric Keys', 'An electronic keyboard, portable keyboard, or digital keyboard is an electronic musical instrument, derivative of keyboard instruments. These include synthesizers, digital pianos, stage pianos, electronic organs and digital audio workstations.'),
(7, 'Drums', 'The drum is a member of the percussion group of musical instruments. In the Hornbostel-Sachs classification system, it is a membranophone. A number of different drums together with cymbals form the basic modern drum kit.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `pass`, `is_admin`) VALUES
(1, 'admin', '$2y$12$jFRyj5CS4kUC.xHGsT76b.dFFzCNShya3pLISA.7LY0YM9kidC/uO', 1),
(2, 'Juan Perez', '$2y$12$5WwiRD/xFUnQrcWwPPJeRufPJ/R34SjFayvrHBKIyrRAWYW9MQ7Ii', 0);

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
-- Indexes for table `ins_category`
--
ALTER TABLE `ins_category`
  ADD PRIMARY KEY (`id_categ`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instrument`
--
ALTER TABLE `instrument`
  MODIFY `id_instrument` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ins_category`
--
ALTER TABLE `ins_category`
  MODIFY `id_categ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instrument`
--
ALTER TABLE `instrument`
  ADD CONSTRAINT `instrument_ibfk_1` FOREIGN KEY (`id_categ_fk`) REFERENCES `ins_category` (`id_categ`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
