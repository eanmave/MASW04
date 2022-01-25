-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2022 at 02:15 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `actividad1`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `id` int(11) NOT NULL,
  `given_name` varchar(256) NOT NULL,
  `surnames` varchar(256) NOT NULL,
  `birth_date` date NOT NULL,
  `country` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `actor_serie`
--

CREATE TABLE `actor_serie` (
  `actor_id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `given_name` varchar(256) NOT NULL,
  `surnames` varchar(256) NOT NULL,
  `birth_date` date NOT NULL,
  `country` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `iso_code` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `platform`
--

CREATE TABLE `platform` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `serie`
--

CREATE TABLE `serie` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `platform_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `serie_audio_language`
--

CREATE TABLE `serie_audio_language` (
  `serie_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `serie_subtitle_language`
--

CREATE TABLE `serie_subtitle_language` (
  `serie_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_actor` (`given_name`,`surnames`);

--
-- Indexes for table `actor_serie`
--
ALTER TABLE `actor_serie`
  ADD KEY `actor_serie_actor_fk` (`actor_id`),
  ADD KEY `actor_serie_serie_fk` (`serie_id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_director` (`given_name`,`surnames`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_language_iso_code` (`iso_code`) USING BTREE;

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `idx_serie_director_id` (`director_id`),
  ADD KEY `idx_serie_platform_id` (`platform_id`);

--
-- Indexes for table `serie_audio_language`
--
ALTER TABLE `serie_audio_language`
  ADD UNIQUE KEY `idx_serie_audio_language` (`serie_id`,`language_id`),
  ADD KEY `fk_serie_audio_language_language_id` (`language_id`);

--
-- Indexes for table `serie_subtitle_language`
--
ALTER TABLE `serie_subtitle_language`
  ADD UNIQUE KEY `idx_serie_subtitle_language` (`serie_id`,`language_id`),
  ADD KEY `fk_language_id` (`language_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actor`
--
ALTER TABLE `actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platform`
--
ALTER TABLE `platform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serie`
--
ALTER TABLE `serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actor_serie`
--
ALTER TABLE `actor_serie`
  ADD CONSTRAINT `actor_serie_actor_fk` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`),
  ADD CONSTRAINT `actor_serie_serie_fk` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`);

--
-- Constraints for table `serie`
--
ALTER TABLE `serie`
  ADD CONSTRAINT `idx_serie_director_id` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`),
  ADD CONSTRAINT `idx_serie_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`);

--
-- Constraints for table `serie_audio_language`
--
ALTER TABLE `serie_audio_language`
  ADD CONSTRAINT `fk_serie_audio_language_language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `fk_serie_audio_language_serie_id` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`);

--
-- Constraints for table `serie_subtitle_language`
--
ALTER TABLE `serie_subtitle_language`
  ADD CONSTRAINT `fk_language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `fk_serie_subtitle_id` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
