-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2019 at 03:48 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animes`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `video_id` int(10) NOT NULL,
  `text` text NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_key`) VALUES
('195d03a9');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alternative_name` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `genres` text NOT NULL,
  `descriptions` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `favorite` int(1) NOT NULL,
  `ongoing` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `name`, `alternative_name`, `rating`, `genres`, `descriptions`, `image`, `favorite`, `ongoing`, `created_at`, `modified_at`) VALUES
(3, 'Try Knights', 'ãƒˆãƒ©ã‚¤ãƒŠã‚¤ãƒ„   ', 'None', 'Sports,School', 'Riku Haruma enters high school without a future in sight. He sees people playing like monsters on the ground, jumping higher than anyone else, running fast, deciding to try their best. There, he sees Akira Kariya playing rugby, a sport he was once passionate about but gave up due to his physique. While Akira is running roughly, Riku gives him a piece of advice without thinking. From that, Riku feels his dying passion for the sport set ablaze, and his future starts to brighten up... ', 'try-knights.jpg', 1, 0, '2019-08-06 15:45:04', '2019-08-07 08:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `device_key` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `series_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `server1_name` text NOT NULL,
  `server1_link` text NOT NULL,
  `server2_name` text NOT NULL,
  `server2_link` text NOT NULL,
  `server3_name` text NOT NULL,
  `server3_link` text NOT NULL,
  `server4_name` text NOT NULL,
  `server4_link` text NOT NULL,
  `server5_name` text NOT NULL,
  `server5_link` text NOT NULL,
  `server6_name` text NOT NULL,
  `server6_link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `series_id`, `title`, `server1_name`, `server1_link`, `server2_name`, `server2_link`, `server3_name`, `server3_link`, `server4_name`, `server4_link`, `server5_name`, `server5_link`, `server6_name`, `server6_link`, `created_at`, `modified_at`) VALUES
(1, 3, 'Episode 1 - The Moon and the Sun', 'Openload', 'https://openload.co/embed/HbxBZj-WKM0/', 'RapidVideo', 'https://www.rapidvideo.is/e/G5IJ26DPV8/', 'VCDN', 'https://animeproxy.info/v/pyg10hmx4xpx33w/', '', '', '', '', '', '', '2019-08-07 09:02:36', '2019-08-07 09:57:27'),
(2, 3, 'Episode 2 - Athleticism and Tactics', 'Rapidvideo', 'https://www.rapidvideo.is/e/G5QHGVSYHQ/', 'VCDN', 'https://animeproxy.info/v/kygwzh3-341j523/', 'Openload', 'https://openload.co/embed/mHTTcOaypzA/', '', '', '', '', '', '', '2019-08-07 09:04:35', '2019-08-07 09:05:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
