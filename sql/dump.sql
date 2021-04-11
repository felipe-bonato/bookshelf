-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 05, 2021 at 07:53 PM
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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `cover_image` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Path to the book cover',
  `author` varchar(64) NOT NULL,
  `genre` varchar(64) DEFAULT NULL,
  `isbn` varchar(16) DEFAULT NULL,
  `owner` int NOT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `cover_image`, `author`, `genre`, `isbn`, `owner`, `price`) VALUES
(19, 'Everlasting', 'eefd7dff95fe4bea10bd66af337cce6e7ac34ca67a973b0a7ee3cb223f93cac24d4d5943dca6f31154f4cdff25e9b7154b81c8dad1c51ec52bd13564a91c51fa.jpg', 'Katy Simpson Smith', NULL, '9780062873644', 23, 5),
(20, 'Lost Decades', '7469fa2e53a7b15971a8dffc8ddd7f7c9c82093bfbb331d67ea0b7ca5d5945bf9255302abeabb8e38b654633de21c2b9f1112b72866cb52259eb48d4f9fda55d.jpg', 'Menzie Chinn', 'Non Fiction', NULL, 23, 18),
(21, 'Numbers in the Dark', '7d024c6252ae2c7e00fe3079173687dd5da1aa085122519b034ea395435eefa7157cb38b4e5a22a8988f3b3746f325c279ddb8b3c012b6f4169b08d32761de15.jpg', 'Italo Calvino', 'Fiction', NULL, 25, 8),
(22, 'Romeo and Juliet', 'cfd0d53f6c9c141fbe11e2dc0ea1846f3b8daead0c6de658b91ec35bde60aa88384bcfced25b3031e9c4c8d7ccd2c330b38894a99653c9a135bebecea0e8edc2.jpg', 'William Shakespeare', 'Fiction', NULL, 28, 20),
(23, 'Dead Astronauts 15', '05f596f9049cecbbaeca354c12187ff10e58d6575cab4566bd3892951f3cd879832e29276d3721d1d213d5c2daaa6306a19e561e76192224285463ae1a66cc7f.jpg', 'IJeff Vandermeer', 'Fiction', '978-0374276805', 23, 12),
(24, 'The Colossus of Maroussi', '17b63cb9a41c7a1a684a41ccf8615a0abbd9913c8940a4e4c642a4e30a4bd5a3d13fea9822b3388fd26d125acf87d559e2a21740d10a91cd6c7d54689e24ba9b.jpg', 'Henry Miller', 'Fiction', '0811218570', 24, 30),
(25, 'The Essentual Goethe', '23dc9cc95460ce1067036d6555fa929c7ae7cee6ccc31990ab5d8d723098b52615bf13fb6fd8ab6bde80169cfa864a4f1bc7eaa602ef7f248b6460038b8fe6a0.jpg', 'Johann Wolfgang von Goethe', NULL, NULL, 28, 10),
(26, 'The Pale King', '649c136c1527819441e3e1b4ea47721fe121626ac9dd479861e405a789cf5210f5213c73784c8bb7bfc5e12c3502152f60831bd0f6f5812ff3a81d4bcf413421.jpg', 'David Foster Wallace', 'Fiction', NULL, 28, 3),
(27, 'The Science of the Bottom Line', '23fc97ce52167307462fb23ac86a882195b87deb7b88ac3e426abe510e93815563210304222116b881dc10f0638db3e27bc70defc9b10fbdd0d2c6e063c5b318.jpg', 'Kay Yut Chen', 'Non Fiction', NULL, 23, 14),
(28, 'Tyll', 'f19583020c9a8b3a75460c062be480c2714033cdb5ee3ecd44b7417298f73117a50c6cf5fcff25d254c9d3aef69cda0fadcdb483d97d47a88835d512b8d7ad04.jpg', 'Daniel Kehlmann', NULL, NULL, 23, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `nickname` varchar(32) DEFAULT NULL COMMENT 'User can asign a nickname',
  `birthday` date NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='users data table';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `nickname`, `birthday`, `address`, `deleted`) VALUES
(23, 'felipe.bonato@gmail.com', '$2y$10$OLhNN6hO6TFBNrwK7hDtLes/nS7sPxoGy1obZlnmv1ctt72Bpdvqu', 'Felipe Bonato', 'Felipe', '1999-04-05', 'Santa Catarina', 0),
(24, 'cleberson@yahoo.com', '$2y$10$JM3mdvmFfLt3gNUW/XIkFuJJX2VdaI9/q.ttP3UHrg2qbcBiC0x0m', 'Cleberson Silveira', NULL, '1987-11-26', 'Rua Faria Lima, nº15', 0),
(25, 'vinicius@email.com', '$2y$10$0hsbPy8xVVbo2uEa1Jvf7.NfQVz2qbPx0Rvsk6j9g/MBVLyEvf.tW', 'Vinicius Silva', 'Vinícius', '2020-12-09', 'Rua dos cravos, 920', 0),
(28, 'thomas.bugs@gmail.com', '$2y$10$Eu4BPckVV6aKVsjuEd4Z/O8/AT0mr.3ybmUNpcZxvI5SmgmYkDcj6', 'Thomas Bugs', 'Bugs', '1901-01-01', 'Rua dos bobos, nº 0', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
