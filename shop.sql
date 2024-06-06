-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 08:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `beauticians`
--

CREATE TABLE `beauticians` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beauticians`
--

INSERT INTO `beauticians` (`id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Dheiva', 'dheiva@gmail.com', '9790064531', '2024-05-29 11:32:20', '2024-05-29 17:48:19'),
(2, 'kavitha', 'kavitha@gmail.com', '9976793309', '2024-05-29 11:34:25', '2024-05-29 17:04:25'),
(3, 'Logesh', 'logesh@gmail.com', '6374038832', '2024-05-29 11:35:24', '2024-05-29 17:05:24'),
(4, 'tamil', 'tamil@gmail.com', '9965488725', '2024-05-29 11:36:33', '2024-05-30 14:11:54'),
(5, 'priya', 'priya@gmail.com', '6314020563', '2024-05-29 11:37:37', '2024-05-29 17:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `beautician_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `slot` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `beautician_id`, `name`, `phone`, `date`, `slot`, `created_at`, `updated_at`) VALUES
(1, 3, 'vijay', '9790064531', '2024-06-06', '11:00 to 12:00', '2024-05-30 12:54:50', '2024-05-30 18:24:50'),
(2, 3, 'ajay', '9976793309', '2024-06-06', '13:00 to 14:00', '2024-05-30 12:55:39', '2024-05-30 18:25:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beauticians`
--
ALTER TABLE `beauticians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beauticians`
--
ALTER TABLE `beauticians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
