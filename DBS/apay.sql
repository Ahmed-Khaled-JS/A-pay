-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 12:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apay`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `iban` int(11) NOT NULL,
  `Balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `user_id`, `bank_id`, `iban`, `Balance`) VALUES
(1, 4, 1, 4030, 274),
(4, 4, 2, 4060, 79),
(5, 4, 2, 7030, 134),
(7, 4, 1, 2020, 1193),
(8, 5, 1, 3030, 2810),
(9, 11, 1, 40112, 804),
(10, 4, 2, 5050, 412),
(11, 15, 2, 40230, 734);

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`) VALUES
(1, 'QNB'),
(2, 'CIB');

-- --------------------------------------------------------

--
-- Table structure for table `fav_account`
--

CREATE TABLE `fav_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `is_collect` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `rec_phone` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rec_id` int(11) NOT NULL,
  `acc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `sender_id`, `rec_phone`, `amount`, `created_at`, `rec_id`, `acc`) VALUES
(1, 4, 1234566, 200, '2023-05-10 09:17:41', 5, 1),
(2, 5, 1234567, 100, '2023-05-10 09:20:07', 4, 2),
(3, 5, 1234567, 100, '2023-05-10 09:21:24', 4, 1),
(4, 5, 1234567, 100, '2023-05-10 09:21:48', 4, 2),
(5, 4, 1159137398, 10, '2023-05-10 10:53:16', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'blocked');

-- --------------------------------------------------------

--
-- Table structure for table `trans`
--

CREATE TABLE `trans` (
  `id` int(11) NOT NULL,
  `sender_iban` int(11) NOT NULL,
  `rec_iban` int(11) NOT NULL,
  `rec_phone` text NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans`
--

INSERT INTO `trans` (`id`, `sender_iban`, `rec_iban`, `rec_phone`, `amount`, `created_at`) VALUES
(3, 4060, 2020, '', 100, '2023-05-08 23:02:07'),
(4, 2020, 7030, '01234567', 100, '2023-05-09 13:30:21'),
(5, 2020, 7030, '01234567', 100, '2023-05-09 13:40:55'),
(6, 4030, 3030, '', 100, '2023-05-09 10:16:54'),
(7, 4060, 3030, '', 100, '2023-05-09 10:21:25'),
(8, 7030, 4030, '', 200, '2023-05-09 15:58:24'),
(9, 7030, 2020, '01234567', 300, '2023-05-09 16:02:49'),
(10, 5050, 7030, '', 200, '2023-05-10 08:19:55'),
(11, 4030, 40230, '', 100, '2023-05-10 12:30:38'),
(12, 5050, 0, '1159137398', 10, '2023-05-10 12:34:46'),
(13, 5050, 40230, '', 10, '2023-05-10 12:35:06'),
(14, 5050, 40230, '', 10, '2023-05-10 12:35:47'),
(15, 7030, 40230, '', 10, '2023-05-10 12:37:19'),
(16, 4030, 0, '1159137398', 10, '2023-05-10 12:39:26'),
(17, 7030, 0, '1159137398', 10, '2023-05-10 12:40:00'),
(18, 7030, 0, '1159137398', 10, '2023-05-10 12:47:32'),
(19, 7030, 0, '1159137398', 10, '2023-05-10 12:48:21'),
(20, 7030, 5050, '', 10, '2023-05-10 12:50:49'),
(21, 4030, 3030, '', 10, '2023-05-10 12:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `phone`, `password`, `role_id`, `status`, `email`) VALUES
(4, 'ahmed', 'khaled', '01234567', '1234567', 1, 'active', 'test@gmail.com'),
(5, 'khaled', 'mohamed', '1234566', '1234567', 1, 'active', 'test2@gmail.com'),
(9, 'ahmed', 'khaled', '12344512', '1234', 3, 'active', 'mohamed@ema'),
(10, 'ahmed', 'khaled', '123445311', '1234', 1, 'active', 'm@gmail.com'),
(11, 'ahmed', 'khaled', '123442', '1233', 1, 'active', 'm@gmail.com'),
(12, 'ahmed', 'khaled', '1233423423', '1233', 3, 'active', '123432'),
(13, 'ahmed', 'shafik', '0991134', '1234', 1, 'active', 'shafik@gmail'),
(14, 'ahmed', 'khaled', '333444', '3344', 2, 'active', 'admin@gmail.com'),
(15, 'a', 'k', '1159137398', '1234', 1, 'active', 'a7med454542@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fav_account`
--
ALTER TABLE `fav_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans`
--
ALTER TABLE `trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fav_account`
--
ALTER TABLE `fav_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
