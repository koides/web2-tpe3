-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 03:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musica`
--

-- --------------------------------------------------------

--
-- Table structure for table `albumes`
--

CREATE TABLE `albumes` (
  `album_id` int(3) NOT NULL,
  `album_nombre` varchar(50) NOT NULL,
  `artista` varchar(50) NOT NULL,
  `anio` int(4) NOT NULL,
  `discografica` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `albumes`
--

INSERT INTO `albumes` (`album_id`, `album_nombre`, `artista`, `anio`, `discografica`) VALUES
(29, 'Black Album', 'Metallica', 1991, 'Elektra Records'),
(30, 'Blood Sugar Sex Magik', 'Red Hot Chili Peppers', 1991, 'Warner Bros. Records'),
(31, 'OK Computer', 'Radiohead', 1997, 'Parlophone, Capitol Records');

-- --------------------------------------------------------

--
-- Table structure for table `canciones`
--

CREATE TABLE `canciones` (
  `cancion_id` int(4) NOT NULL,
  `cancion_nombre` varchar(50) NOT NULL,
  `album` int(3) NOT NULL,
  `duracion` int(4) NOT NULL,
  `track` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `canciones`
--

INSERT INTO `canciones` (`cancion_id`, `cancion_nombre`, `album`, `duracion`, `track`) VALUES
(39, 'Enter Sandman', 29, 329, 1),
(40, 'Sad but True', 29, 324, 2),
(41, 'Holier Than Thou', 29, 227, 3),
(42, 'The Unforgiven', 29, 386, 4),
(43, 'Wherever I May Roam', 29, 402, 5),
(44, 'Don\'t Tread on Me', 29, 239, 6),
(45, 'Through the Neve', 29, 241, 7),
(46, 'Nothing Else Matters', 29, 388, 8),
(47, 'Of Wolf and Man', 29, 256, 9),
(48, 'The God That Failed', 29, 306, 10),
(49, 'My Friend of Misery', 29, 407, 11),
(50, 'The Struggle Within', 29, 231, 12),
(51, 'The Power of Equality', 30, 244, 1),
(52, 'If You Have to Ask', 30, 217, 2),
(53, 'Breaking the Gil', 30, 295, 3),
(54, 'Funky Monks', 30, 323, 4),
(55, 'Suck My Kiss', 30, 217, 5),
(56, 'I Could Have Lied', 30, 244, 6),
(57, 'Mellowship Slinky in B Major', 30, 240, 7),
(58, 'The Righteous & the Wicked', 30, 248, 8),
(59, 'Give It Away', 30, 283, 9),
(60, 'Blood Sugar Sex Magik', 30, 271, 10),
(61, 'Under the Bridge', 30, 267, 11),
(62, 'Naked in the Rain', 30, 266, 12),
(63, 'Apache Rose Peacock', 30, 282, 13),
(64, 'The Greeting Song', 30, 194, 14),
(65, 'My Lovely Man', 30, 279, 15),
(66, 'Sir Psycho Sexy', 30, 497, 16),
(67, 'They\'re Red Hot', 30, 71, 17),
(68, 'Airbag', 31, 284, 1),
(69, 'Paranoid Android', 31, 383, 2),
(70, 'Subterranean Homesick Alien', 31, 267, 3),
(71, 'Exit Music (For a Film)', 31, 264, 4),
(72, 'Let Down', 31, 299, 5),
(73, 'Karma Police', 31, 261, 6),
(74, 'Fitter Happier', 31, 117, 7),
(75, 'Electioneering', 31, 230, 8),
(76, 'Climbing Up the Walls', 31, 285, 9),
(77, 'No Surprises', 31, 228, 10),
(78, 'Lucky', 31, 259, 11),
(79, 'The Tourist', 31, 324, 12);

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `comentario_id` int(3) NOT NULL,
  `comentario` varchar(300) NOT NULL,
  `puntuacion` int(1) NOT NULL,
  `album` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`comentario_id`, `comentario`, `puntuacion`, `album`) VALUES
(1, 'el mejor disco de la banda!!', 5, 29),
(2, '', 4, 30),
(3, 'Tiene mejores pero se deja escuchar', 3, 31),
(4, 'dsadsada', 4, 29),
(5, 'dsadsada', 4, 29),
(6, 'dsadsada', 4, 29),
(7, 'dsadsada', 4, 29),
(8, 'dsadsada', 4, 29),
(9, 'dsadsada', 4, 29),
(10, 'dsadsada', 4, 29);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(3) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user`, `password`) VALUES
(1, 'webadmin', '$2y$10$bFU9Mj1GMR6yzxoQ06i.8Oc6B6x1ZYCAtOop7LzXDvJxlee29KA9W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `canciones`
--
ALTER TABLE `canciones`
  ADD PRIMARY KEY (`cancion_id`),
  ADD KEY `FK_album` (`album`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`comentario_id`),
  ADD KEY `FK_album` (`album`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albumes`
--
ALTER TABLE `albumes`
  MODIFY `album_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `canciones`
--
ALTER TABLE `canciones`
  MODIFY `cancion_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `comentario_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `canciones`
--
ALTER TABLE `canciones`
  ADD CONSTRAINT `canciones_ibfk_1` FOREIGN KEY (`album`) REFERENCES `albumes` (`album_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`album`) REFERENCES `albumes` (`album_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
