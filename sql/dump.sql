-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2021 at 01:20 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avii_desenvweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_owner` int NOT NULL,
  `id_buyer` int DEFAULT NULL,
  `id_genre` int DEFAULT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author` varchar(64) NOT NULL,
  `isbn` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `last_modified_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `id_owner`, `id_buyer`, `id_genre`, `name`, `author`, `isbn`, `price`, `created_at`, `last_modified_at`, `deleted_at`) VALUES
(19, 23, NULL, NULL, 'Everlasting', 'Katy Simpson Smith', '9780062873644', '5.00', '0000-00-00 00:00:00', '2021-05-14 00:08:51', '2021-05-16 14:47:51'),
(33, 23, NULL, 3, 'Silent History', 'Eli Horowitz', '', '10.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(20, 23, NULL, 2, 'Lost Decades', 'Menzie Chinn', NULL, '18.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-05-18 20:04:46'),
(21, 25, NULL, 5, 'Numbers in the Dark', 'Italo Calvino', NULL, '8.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(22, 28, NULL, 3, 'Romeo and Juliet', 'William Shakespeare', NULL, '20.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(23, 23, NULL, 4, 'Dead Astronauts 15', 'IJeff Vandermeer', '978-0374276805', '12.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(24, 24, NULL, 11, 'The Colossus of Maroussi', 'Henry Miller', '0811218570', '30.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(25, 28, NULL, NULL, 'The Essentual Goethe', 'Johann Wolfgang von Goethe', NULL, '10.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(26, 28, NULL, 3, 'The Pale King', 'David Foster Wallace', NULL, '3.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(27, 23, NULL, 12, 'The Science of the Bottom Line', 'Kay Yut Chen', NULL, '14.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(28, 23, NULL, NULL, 'Tyll', 'Daniel Kehlmann', NULL, '9.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(39, 23, NULL, 1, 'Test ', 'Myself', '13543', '22.00', '2021-05-14 00:22:26', '2021-05-14 00:22:26', '2021-05-14 00:23:48'),
(45, 23, NULL, 5, 'Alena', 'Rachel Pastan', '1594632928', '7.99', '2021-05-16 21:31:05', '2021-05-16 21:31:05', NULL),
(44, 49, NULL, 1, 'And Then There\'s This', 'Bill Wasik', '64110518', '21.00', '2021-05-16 20:34:41', '2021-05-16 20:34:41', NULL),
(43, 49, NULL, 1, 'Everlasting', 'Katy Simpson Smith', '34830354', '23.00', '2021-05-16 20:29:47', '2021-05-16 20:29:47', NULL),
(46, 23, NULL, 2, 'Cunning Plans', 'Warren Ellis', '', '5.00', '2021-05-16 21:41:51', '2021-05-16 21:41:51', NULL),
(47, 50, NULL, 2, 'Supermaket', 'Satoshi Azuchi', '0312382944', '9.99', '2021-05-18 19:35:36', '2021-05-18 19:36:02', '2021-05-18 19:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `book_genre`
--

DROP TABLE IF EXISTS `book_genre`;
CREATE TABLE IF NOT EXISTS `book_genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_genre`
--

INSERT INTO `book_genre` (`id`, `name`) VALUES
(1, 'Fantasy'),
(2, 'Non-Fiction'),
(3, 'Romance'),
(4, 'Science Fiction'),
(5, 'Mystery'),
(6, 'Dystopian'),
(7, 'Horror'),
(8, 'Thriller'),
(9, 'Cooking'),
(10, 'Art'),
(11, 'Travel'),
(12, 'Economy');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user_type` int NOT NULL DEFAULT '1',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `nickname` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'User can asign a nickname',
  `birthday` date NOT NULL,
  `address` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `last_modified_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='users data table';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_user_type`, `email`, `password`, `fullname`, `nickname`, `birthday`, `address`, `created_at`, `last_modified_at`, `deleted_at`) VALUES
(23, 1, 'felipe.bonato@gmail.com', '$2y$10$OLhNN6hO6TFBNrwK7hDtLes/nS7sPxoGy1obZlnmv1ctt72Bpdvqu', 'Felipe Bonato', 'Felipe', '1999-04-05', 'Santa Catarina', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(24, 1, 'cleberson@yahoo.com', '$2y$10$JM3mdvmFfLt3gNUW/XIkFuJJX2VdaI9/q.ttP3UHrg2qbcBiC0x0m', 'Cleberson Silveira', 'Clebs', '1987-11-26', 'Rua Faria Lima, nº15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(25, 1, 'vinicius@email.com', '$2y$10$0hsbPy8xVVbo2uEa1Jvf7.NfQVz2qbPx0Rvsk6j9g/MBVLyEvf.tW', 'Vinicius Silva', 'Vinícius', '2020-12-09', 'Rua dos cravos, 920', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(28, 1, 'thomas.bugs@gmail.com', '$2y$10$Eu4BPckVV6aKVsjuEd4Z/O8/AT0mr.3ybmUNpcZxvI5SmgmYkDcj6', 'Thomas Bugs', 'Bugs', '1901-01-01', 'Rua dos bobos, nº 0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(29, 1, 'maria@gmail.com', '$2y$10$qvUNpxzla.nn3bJcxAFJ4.Krfm4jGWg38v7yBc5TSpeHv0s/hUOX.', 'Maria Amália', 'Maria', '1999-12-12', 'Rua Col. Peixoto, nº205', '2021-05-08 20:27:12', '0000-00-00 00:00:00', NULL),
(1, 2, 'dev@bookshelf.com', '$2y$10$ZxOyQYAUOe0ospkqQqn3Ou4BuOtQNFPrKkKiWWErpS4mkFCQZOsYm', 'Developer', 'Dev', '1970-01-01', 'Coutry, State, City - Street, Number', '1970-01-01 00:00:00', '0000-00-00 00:00:00', NULL),
(48, 1, 'user@bookshelf.com', '$2y$10$ZxOyQYAUOe0ospkqQqn3Ou4BuOtQNFPrKkKiWWErpS4mkFCQZOsYm', 'User', 'User', '2000-01-01', 'Country, State, City', '2021-05-13 14:13:03', '0000-00-00 00:00:00', NULL),
(49, 1, 'deisi@yahoo.com', '$2y$10$MviHdnc6hPiG5rnRFIrA.uC3q1X.gCLev/LtXoWFDaT3xUDPm3Mcu', 'Deisi Karina de Souza', 'Deisi', '1999-03-16', 'Rua Col. Antônio Carlos', '2021-05-16 19:06:10', '2021-05-16 19:06:10', NULL),
(50, 1, 'felipe@yahoo.com.br', '$2y$10$h/s.QFSuxcn6bbs8zx9AU.f3ogsyvT36MDMEBSEJuIBojIKNcfF8.', 'Felipe Bonato', 'Felipe', '1999-05-04', 'Rua das Violeta, 101', '2021-05-18 19:09:34', '2021-05-18 23:30:31', '2021-05-18 23:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'default'),
(2, 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
