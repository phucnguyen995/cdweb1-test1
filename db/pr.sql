-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2019 at 05:12 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pr`
--

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE IF NOT EXISTS `airport` (
  `id` int(11) NOT NULL,
  `airport_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`id`, `airport_name`, `country`) VALUES
(1, 'Noi Bai International Airport', 'Việt Nam'),
(2, 'Tan Son Nhat International Airport', 'Việt Nam'),
(3, 'Phu Quoc Airport', 'Việt Nam');

-- --------------------------------------------------------

--
-- Table structure for table `city_from`
--

CREATE TABLE IF NOT EXISTS `city_from` (
  `id` int(11) NOT NULL,
  `name_city` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city_code` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `city_from`
--

INSERT INTO `city_from` (`id`, `name_city`, `city_code`) VALUES
(1, 'TP. Hồ Chí Minh (SGN)', 'SGN'),
(2, 'Hà Nội (HAN)', 'HAN'),
(3, 'Phú Quốc (PQC)', 'PQC');

-- --------------------------------------------------------

--
-- Table structure for table `city_to`
--

CREATE TABLE IF NOT EXISTS `city_to` (
  `id` int(11) NOT NULL,
  `name_city` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `city_to`
--

INSERT INTO `city_to` (`id`, `name_city`) VALUES
(1, 'TP. Hồ Chí Minh (SGN)'),
(2, 'Hà Nội (HAN)'),
(3, 'Phú Quốc (PQC)');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE IF NOT EXISTS `flight` (
  `id` int(11) NOT NULL,
  `plane_id` int(11) NOT NULL,
  `id_cityFrom` int(11) NOT NULL,
  `airport_from` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `time_from` time NOT NULL,
  `id_cityTo` int(11) NOT NULL,
  `airport_to` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `time_to` time NOT NULL,
  `duration` time NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `plane_id`, `id_cityFrom`, `airport_from`, `time_from`, `id_cityTo`, `airport_to`, `time_to`, `duration`, `price`) VALUES
(1, 1, 1, '2', '07:30:00', 2, '1', '09:30:00', '02:00:00', 1000000),
(2, 2, 1, '2', '07:30:00', 2, '1', '09:30:00', '02:00:00', 800000),
(3, 1, 2, '1', '09:30:00', 1, '2', '11:30:00', '02:00:00', 1200000),
(4, 2, 2, '1', '09:30:00', 1, '2', '11:30:00', '02:00:00', 1000000),
(5, 1, 1, '1', '07:30:00', 3, '3\n', '09:30:00', '02:00:00', 1400000);

-- --------------------------------------------------------

--
-- Table structure for table `fly_book`
--

CREATE TABLE IF NOT EXISTS `fly_book` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `person` int(11) NOT NULL,
  `price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `time_book` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fly_detail`
--

CREATE TABLE IF NOT EXISTS `fly_detail` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `time_fly` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_city`
--

CREATE TABLE IF NOT EXISTS `list_city` (
  `id` int(11) NOT NULL,
  `city_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city_code` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `list_city`
--

INSERT INTO `list_city` (`id`, `city_name`, `city_code`) VALUES
(1, 'TP. Hồ Chí Minh', 'SGN'),
(2, 'Hà Nội', 'HAN'),
(3, 'Phú Quốc', 'PQC');

-- --------------------------------------------------------

--
-- Table structure for table `plane`
--

CREATE TABLE IF NOT EXISTS `plane` (
  `id` int(11) NOT NULL,
  `airways` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `plane_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plane`
--

INSERT INTO `plane` (`id`, `airways`, `plane_name`) VALUES
(1, 'Vietnam Airlines', 'AL-102'),
(2, 'VieJetAir', 'VJ-7708');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `last_access` datetime NOT NULL,
  `attempt` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `gender`, `birthdate`, `address`, `last_access`, `attempt`) VALUES
(5, 'phuc', 'phuc.nv995@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1676093546', 0, '0000-00-00', '', '0000-00-00 00:00:00', 0),
(6, 'phuc', 'phuc@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1676093546', 1, '2019-02-14', '48, 48', '2019-02-27 11:46:49', 1),
(7, 'anh', 'a@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1676093546', 0, '0000-00-00', '', '0000-00-00 00:00:00', 0),
(8, 'hanh', 'hanh@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1234567890', 0, '0000-00-00', '', '2019-02-26 11:17:44', 3),
(9, 'bun', 'bc@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1676093546', 0, '0000-00-00', '', '0000-00-00 00:00:00', 0),
(10, 'Anh', 'abc@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1676093546', 1, '2019-02-16', '12333', '2019-02-27 12:11:52', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_from`
--
ALTER TABLE `city_from`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_to`
--
ALTER TABLE `city_to`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plane_id` (`plane_id`),
  ADD KEY `id_cityFrom` (`id_cityFrom`),
  ADD KEY `id_cityTo` (`id_cityTo`);

--
-- Indexes for table `fly_book`
--
ALTER TABLE `fly_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `fly_detail`
--
ALTER TABLE `fly_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `list_city`
--
ALTER TABLE `list_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plane`
--
ALTER TABLE `plane`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `city_from`
--
ALTER TABLE `city_from`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `city_to`
--
ALTER TABLE `city_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fly_book`
--
ALTER TABLE `fly_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fly_detail`
--
ALTER TABLE `fly_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `list_city`
--
ALTER TABLE `list_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `plane`
--
ALTER TABLE `plane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`plane_id`) REFERENCES `plane` (`id`),
  ADD CONSTRAINT `flight_ibfk_2` FOREIGN KEY (`id_cityTo`) REFERENCES `city_to` (`id`),
  ADD CONSTRAINT `flight_ibfk_3` FOREIGN KEY (`id_cityFrom`) REFERENCES `city_from` (`id`);

--
-- Constraints for table `fly_book`
--
ALTER TABLE `fly_book`
  ADD CONSTRAINT `fly_book_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `fly_detail`
--
ALTER TABLE `fly_detail`
  ADD CONSTRAINT `fly_detail_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
