-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2020 at 11:47 AM
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
  `details` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `details`, `image`) VALUES
(1, 'Strings', 'String instruments, stringed instruments, or chordophones are musical instruments that produce sound from vibrating strings when the performer plays or sounds the strings in some manner.', 'img_upload/5f07d6d90731c6.33486492.jpg'),
(2, 'Winds', 'A wind instrument is a musical instrument that contains some type of resonator (usually a tube) in which a column of air is set into vibration by the player blowing into (or over) a mouthpiece set at or near the end of the resonator.', 'img_upload/5f0825ca4a9897.86203711.jpg'),
(3, 'Keys', 'A keyboard instrument is a musical instrument played using a keyboard, a row of levers which are pressed by the fingers. The most common of these are the piano, organ, and various electronic keyboards, including synthesizers and digital pianos.', 'img_upload/5f07d1ac048932.61456883.jpg'),
(4, 'Percussion', 'A percussion instrument is a musical instrument that is sounded by being struck or scraped by a beater including attached or enclosed beaters or rattles struck, scraped or rubbed by hand or struck against another similar instrument.', NULL),
(5, 'Electric Strings', 'Most string instruments can be fitted with piezoelectric or magnetic pickups to convert the string\'s vibrations into an electrical signal that is amplified and then converted back into sound by loudspeakers.', NULL),
(6, 'Electric Keys', 'An electronic keyboard, portable keyboard, or digital keyboard is an electronic musical instrument, derivative of keyboard instruments. These include synthesizers, digital pianos, stage pianos, electronic organs and digital audio workstations.', NULL),
(7, 'Drums', 'The drum is a member of the percussion group of musical instruments. In the Hornbostel-Sachs classification system, it is a membranophone. A number of different drums together with cymbals form the basic modern drum kit.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_ins_fk` int(11) NOT NULL,
  `id_user_fk` int(11) NOT NULL,
  `content` text NOT NULL,
  `rating` smallint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_ins_fk`, `id_user_fk`, `content`, `rating`) VALUES
(1, 1, 5, 'adongiasdo', 5),
(3, 6, 5, 'lol who even owns one of these xdxdxddxdxd', 3),
(4, 3, 2, 'Le daría más puntos pero el nombre \"cello\" no es muy representativo. Recomiendo renombrar a \"violoncello\". Saludos', 2),
(5, 6, 2, 'Éste es un instrumento muy bueno. 5/5', 5);

-- --------------------------------------------------------

--
-- Table structure for table `instrument`
--

CREATE TABLE `instrument` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(7,2) NOT NULL DEFAULT 0.00,
  `details` varchar(255) DEFAULT NULL,
  `id_categ_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instrument`
--

INSERT INTO `instrument` (`id`, `name`, `price`, `details`, `id_categ_fk`) VALUES
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
-- Table structure for table `ins_image`
--

CREATE TABLE `ins_image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `ins_album_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ins_image`
--

INSERT INTO `ins_image` (`id`, `image`, `ins_album_fk`) VALUES
(5, 'img_upload/5f07b6858d3d70.37769111.jpg', 1),
(7, 'img_upload/5f07b7e7712af0.25101652.jpg', 2),
(8, 'img_upload/5f07b7ebdced58.52057124.jpg', 2),
(9, 'img_upload/5f07b82eedb5c8.25851294.png', 3),
(10, 'img_upload/5f07b833b0a438.99677690.jpg', 3),
(11, 'img_upload/5f07b840632277.87960906.jpg', 4),
(12, 'img_upload/5f07b84f051926.00908791.jpg', 7),
(13, 'img_upload/5f07b8542add86.81119454.png', 7),
(14, 'img_upload/5f07b860e6e961.28475963.jpg', 8),
(15, 'img_upload/5f07b8d8479476.97017376.jpg', 9),
(16, 'img_upload/5f07b8e10eb964.76331477.png', 9),
(18, 'img_upload/5f07b93f5ee4f6.34550376.png', 5),
(19, 'img_upload/5f07b945151a12.15032663.jpg', 5),
(20, 'img_upload/5f07b95036f960.59567554.jpg', 6),
(21, 'img_upload/5f07de8c7c5991.09503228.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `owner` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `pass`, `admin`, `owner`) VALUES
(1, 'admin', '$2y$12$jFRyj5CS4kUC.xHGsT76b.dFFzCNShya3pLISA.7LY0YM9kidC/uO', 1, 1),
(2, 'Juan Perez', '$2y$12$5WwiRD/xFUnQrcWwPPJeRufPJ/R34SjFayvrHBKIyrRAWYW9MQ7Ii', 0, 0),
(3, 'Heraldo Ordonez', '$2y$10$fezRQsyHX9IM9ODQk6b3TOCds/YV/u3Sad/ARrm1/HoLvvYWfrezW', 0, 0),
(5, 'John Doe', '$2y$10$z/r7SJE6kqD3wFn9RtF3hO5qczMJT4HsoAXc8tRaqW6JMJzExPfS2', 0, 0),
(7, 'Francisco Hernandez', '$2y$10$ZFiwpirZHe7Wvsy0gTQgFu.xhUM25BxjEmVhrpW/nI8WVgsAEMIcS', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ins_fk` (`id_ins_fk`),
  ADD KEY `id_user_fk` (`id_user_fk`);

--
-- Indexes for table `instrument`
--
ALTER TABLE `instrument`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categ_fk` (`id_categ_fk`);

--
-- Indexes for table `ins_image`
--
ALTER TABLE `ins_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ins_album` (`ins_album_fk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `instrument`
--
ALTER TABLE `instrument`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ins_image`
--
ALTER TABLE `ins_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_ins_fk`) REFERENCES `instrument` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user_fk`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instrument`
--
ALTER TABLE `instrument`
  ADD CONSTRAINT `instrument_ibfk_1` FOREIGN KEY (`id_categ_fk`) REFERENCES `category` (`id`);

--
-- Constraints for table `ins_image`
--
ALTER TABLE `ins_image`
  ADD CONSTRAINT `ins_image_ibfk_1` FOREIGN KEY (`ins_album_fk`) REFERENCES `instrument` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
