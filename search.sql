-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 26, 2015 at 10:42 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rekaweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE IF NOT EXISTS `search` (
`id_search` int(11) NOT NULL,
  `id_from` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `id_to` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `search`
--

INSERT INTO `search` (`id_search`, `id_from`, `id_to`, `price`, `date`) VALUES
(1, '1101', '1102', 100, '2015-12-27 00:00:00'),
(2, '1101', '1102', 1, '2015-12-27 00:00:00'),
(3, '1101', '1102', 50, '2015-12-27 00:00:00'),
(4, '1101', '1104', 700, '2015-12-27 00:00:00'),
(5, '1101', '1102', 500, '2015-12-31 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `search`
--
ALTER TABLE `search`
 ADD PRIMARY KEY (`id_search`), ADD KEY `search_id_from` (`id_from`), ADD KEY `search_id_to` (`id_to`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `search`
--
ALTER TABLE `search`
MODIFY `id_search` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `search`
--
ALTER TABLE `search`
ADD CONSTRAINT `search_id_from` FOREIGN KEY (`id_from`) REFERENCES `regencies` (`id`),
ADD CONSTRAINT `search_id_to` FOREIGN KEY (`id_to`) REFERENCES `regencies` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
