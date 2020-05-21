-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2020 at 05:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwm`
--

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `user_id`, `name`, `img`, `create_at`) VALUES
(1, 1, 'Gunungpati', 'landscape-02.jpg', '2020-05-13 04:31:36'),
(2, 1, 'Gunungpati on the sky', 'landscape-03.jpg', '2020-05-13 04:31:36'),
(3, 1, 'images', 'zukcrhlr.jpg', '2020-05-20 14:51:23'),
(4, 1, 'images', 'zukcrhlr.jpg', '2020-05-20 14:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `img` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `biodata` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `username`, `password`, `img`, `email`, `biodata`, `create_at`) VALUES
(1, 'Robby Birham', 'robbybirham', '202cb962ac59075b964b07152d234b70', 'bos 01.jpg', 'robby@internetclub.or.id', 'Universitas Stikubank Semarnag Student 2017', '2020-05-13 04:26:56'),
(2, 'Berliana Siwi W', 'berliberli', '202cb962ac59075b964b07152d234b70', 'bos 02.png', 'berliana@internetclub.or.id', 'Universitas Stikubank Semarnag Student 2017', '2020-05-13 04:26:56'),
(3, 'Uswatun Utami', 'uswatun', '202cb962ac59075b964b07152d234b70', 'bos 03.jpg', 'uswatun@internetclub.or.id', 'Universitas Stikubank Semarnag Student 2017', '2020-05-13 04:27:35'),
(4, 'Deni', 'deni', '202cb962ac59075b964b07152d234b70', 'deni.png', 'deni@internetclub.or.id', 'Universitas Stikubank Semarnag Student 2017', '2020-05-13 04:27:35'),
(5, 'Lindri Kumarani', 'lindrikum', '202cb962ac59075b964b07152d234b70', 'lindri.jpeg', 'lindri@internetclub.or.id', 'Universitas Stikubank Semarnag Student 2017', '2020-05-13 04:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `upid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tweet` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tweet`
--

INSERT INTO `tweet` (`id`, `upid`, `user_id`, `tweet`, `time`) VALUES
(1, 0, 1, 'aku cinta Universitas Stikubank', '2020-05-13 04:35:34'),
(2, 0, 2, 'Mata kuliah PWM asik juga', '2020-05-13 04:35:34'),
(3, 0, 1, 'Mars Unisbank', '2020-05-13 04:43:24'),
(4, 0, 1, 'Mars Unisbank', '2020-05-13 04:45:07'),
(5, 0, 2, 'saya berli saya sehat', '2020-05-13 04:45:31'),
(6, 0, 3, 'saya uswatun saya sehat', '2020-05-13 04:45:48'),
(7, 0, 4, 'saya Deni saya sehat', '2020-05-13 04:46:00'),
(8, 0, 5, 'saya Lindri saya bukan laki-lai', '2020-05-13 04:46:14'),
(9, 0, 5, 'apalagi brewokan', '2020-05-13 04:46:22'),
(11, 9, 1, 'iya juga ya', '2020-05-20 15:08:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
