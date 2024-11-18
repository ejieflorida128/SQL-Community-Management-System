-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 11:54 AM
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
-- Database: `sqlcommunity_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `fullname`, `gmail`, `password`, `profile_picture`, `age`, `location`, `status`, `date`) VALUES
(1, 'admin1', 'admin1@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Approve', '2024-11-10 07:54:01'),
(2, 'admin2', 'admin2@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Pending', '2024-11-10 06:29:45'),
(4, 'admin3', 'admin3@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Pending', '2024-11-10 06:29:45'),
(5, 'admin4', 'admin4@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Approve', '2024-11-10 08:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `fullname`, `gmail`, `password`, `profile_picture`, `age`, `location`, `status`, `date`) VALUES
(1, 'user1', 'user1@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Approve', '2024-11-10 07:51:20'),
(4, 'user3', 'user3@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Approve', '2024-11-10 08:42:13'),
(5, 'user4', 'user4@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Approve', '2024-11-10 08:42:17'),
(6, 'user5', 'user5@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Approve', '2024-11-10 07:51:20'),
(7, 'user6', 'user6@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Approve', '2024-11-10 08:42:20'),
(8, 'user7', 'user7@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Pending', '2024-11-10 08:12:57'),
(9, 'user8', 'user8@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Pending', '2024-11-10 08:12:57'),
(10, 'user9', 'user9@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Pending', '2024-11-10 08:12:57'),
(11, 'example', 'example1@gmail.com', '123', '../profile_pictures/default.jpg', 0, '', 'Pending', '2024-11-13 12:53:05'),
(12, 'Ejie C. Florida', 'ejieflorida123@gmail.com', '123', '../profile_pictures/sg-11134201-22120-zwz8983xwjkv41.jpg', 0, '', 'Approve', '2024-11-13 16:02:45'),
(13, 'Athena Campania', 'athenajoycampania123@gmail.com', '123', '../profile_pictures/i1.jpg', 0, '', 'Approve', '2024-11-15 00:39:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
