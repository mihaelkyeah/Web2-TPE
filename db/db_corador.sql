-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2020 a las 21:21:47
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_corador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `details`, `image`) VALUES
(1, 'Strings', 'String instruments, stringed instruments, or chordophones are musical instruments that produce sound from vibrating strings when the performer plays or sounds the strings in some manner.', ''),
(2, 'Winds', 'A wind instrument is a musical instrument that contains some type of resonator (usually a tube) in which a column of air is set into vibration by the player blowing into (or over) a mouthpiece set at or near the end of the resonator.', ''),
(3, 'Keys', 'A keyboard instrument is a musical instrument played using a keyboard, a row of levers which are pressed by the fingers. The most common of these are the piano, organ, and various electronic keyboards, including synthesizers and digital pianos.', ''),
(4, 'Percussion', 'A percussion instrument is a musical instrument that is sounded by being struck or scraped by a beater including attached or enclosed beaters or rattles struck, scraped or rubbed by hand or struck against another similar instrument.', ''),
(5, 'Electric Strings', 'Most string instruments can be fitted with piezoelectric or magnetic pickups to convert the string\'s vibrations into an electrical signal that is amplified and then converted back into sound by loudspeakers.', ''),
(6, 'Electric Keys', 'An electronic keyboard, portable keyboard, or digital keyboard is an electronic musical instrument, derivative of keyboard instruments. These include synthesizers, digital pianos, stage pianos, electronic organs and digital audio workstations.', ''),
(7, 'Drums', 'The drum is a member of the percussion group of musical instruments. In the Hornbostel-Sachs classification system, it is a membranophone. A number of different drums together with cymbals form the basic modern drum kit.', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instrument`
--

CREATE TABLE `instrument` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(7,2) NOT NULL DEFAULT 0.00,
  `details` varchar(255) DEFAULT NULL,
  `id_categ_fk` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instrument`
--

INSERT INTO `instrument` (`id`, `name`, `price`, `details`, `id_categ_fk`, `image`) VALUES
(1, 'Violin', '699.99', 'The violin is a wooden string instrument in the violin family. It is the smallest and highest-pitched instrument (soprano) in the family in regular use.', 1, ''),
(2, 'Viola', '896.00', 'The viola is a string instrument that is bowed, plucked, or played with varying techniques. Since the 18th century it has been the middle or alto voice of the violin family, between the violin and the cello.', 1, ''),
(3, 'Cello', '12896.15', 'The cello or violoncello is a bowed (and occasionally plucked) string instrument of the violin family. Its four strings are usually tuned an octave lower than those of the viola.', 1, ''),
(4, 'Double Bass', '99999.99', 'The double bass, also known as the contrabass, is the largest and lowest-pitched bowed, (or plucked) string instrument in the modern symphony orchestra.', 1, ''),
(5, 'Piano', '65536.65', 'The word piano is a shortened form of pianoforte, the Italian term for the early 1700s versions of the instrument. The terms \"piano\" and \"forte\" indicate \"soft\" and \"loud\", referring to the variations in volume produced by a pianist\'s touch on the keys.', 3, ''),
(6, 'Harpsichord', '86420.00', 'A harpsichord (Italian: clavicembalo, French: clavecin, German: Cembalo, Spanish: clavecín, Portuguese: cravo) is a musical instrument played by means of a keyboard.', 3, ''),
(7, 'Baritone Sax', '5643.56', 'The baritone saxophone or \"bari sax\" is one of the larger members of the saxophone family, only being smaller than the bass, contrabass and subcontrabass saxophones. It is the lowest-pitched saxophone in common use.', 2, ''),
(8, 'Tenor Sax', '789.99', 'The tenor saxophone is a medium-sized member of the saxophone family, a group of instruments invented by Adolphe Sax in the 1840s. The tenor and the alto are the two most commonly used saxophones.', 2, ''),
(9, 'Alto Sax', '8910.00', 'The alto saxophone, also referred to as the alto sax or simply the alto, is a member of the saxophone family of woodwind instruments invented by Belgian instrument designer Adolphe Sax in the 1840s, and patented in 1846.', 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ins_image`
--

CREATE TABLE `ins_image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `ins_album_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `pass`, `admin`) VALUES
(1, 'admin', '$2y$12$jFRyj5CS4kUC.xHGsT76b.dFFzCNShya3pLISA.7LY0YM9kidC/uO', 1),
(2, 'Juan Perez', '$2y$12$5WwiRD/xFUnQrcWwPPJeRufPJ/R34SjFayvrHBKIyrRAWYW9MQ7Ii', 0),
(3, 'Heraldo Ordoñez', '$2y$10$fezRQsyHX9IM9ODQk6b3TOCds/YV/u3Sad/ARrm1/HoLvvYWfrezW', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instrument`
--
ALTER TABLE `instrument`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categ_fk` (`id_categ_fk`);

--
-- Indices de la tabla `ins_image`
--
ALTER TABLE `ins_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ins_album` (`ins_album_fk`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `instrument`
--
ALTER TABLE `instrument`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ins_image`
--
ALTER TABLE `ins_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `instrument`
--
ALTER TABLE `instrument`
  ADD CONSTRAINT `instrument_ibfk_1` FOREIGN KEY (`id_categ_fk`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `ins_image`
--
ALTER TABLE `ins_image`
  ADD CONSTRAINT `ins_image_ibfk_1` FOREIGN KEY (`ins_album_fk`) REFERENCES `instrument` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
