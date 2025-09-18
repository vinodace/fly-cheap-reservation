-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 12, 2025 at 02:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelweb_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `flight_id` varchar(100) NOT NULL,
  `booking_status` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `flight_id`, `booking_status`, `payment_status`, `created_at`) VALUES
(1, '22', '1', 'pending', 'pending', '2025-09-12 09:46:48'),
(2, '22', '1', 'pending', 'pending', '2025-09-12 09:47:29'),
(3, '22', '1', 'pending', 'pending', '2025-09-12 09:48:05'),
(4, '22', '1', 'pending', 'pending', '2025-09-12 09:48:53'),
(5, '22', '1', 'pending', 'pending', '2025-09-12 10:44:01'),
(6, '22', '1', 'pending', 'pending', '2025-09-12 10:49:34'),
(7, '22', '1', 'pending', 'pending', '2025-09-12 10:51:00'),
(8, '22', '1', 'pending', 'pending', '2025-09-12 10:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_name` varchar(250) NOT NULL,
  `flight_number` varchar(250) NOT NULL,
  `origin` varchar(250) NOT NULL,
  `destination` varchar(250) NOT NULL,
  `departure_time` varchar(250) NOT NULL,
  `arrival_time` varchar(250) NOT NULL,
  `price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flight_search`
--

CREATE TABLE `flight_search` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `origin` varchar(250) NOT NULL,
  `origin_name` varchar(250) NOT NULL,
  `destination` varchar(250) NOT NULL,
  `destination_name` varchar(250) NOT NULL,
  `departure_date` date NOT NULL,
  `return_date` date NOT NULL,
  `passenger` varchar(250) NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `infants` int(11) NOT NULL,
  `travel_class` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight_search`
--

INSERT INTO `flight_search` (`id`, `user_id`, `origin`, `origin_name`, `destination`, `destination_name`, `departure_date`, `return_date`, `passenger`, `adults`, `children`, `infants`, `travel_class`, `created_at`) VALUES
(2, 22, 'DEL', 'INDIRA GANDHI INTL', 'BOM', 'CHHATRAPATI S MAHARAJ', '2025-09-22', '0000-00-00', '1 Adult - Economy', 1, 0, 0, 'Economy', '2025-09-12 06:43:57'),
(3, 22, 'DEL', 'INDIRA GANDHI INTL', 'BOM', 'CHHATRAPATI S MAHARAJ', '2025-09-29', '2025-09-30', '2 Adults, 1 Child - Economy', 2, 1, 0, 'Economy', '2025-09-12 06:45:00'),
(4, 22, 'SJD', 'LOS CABOS INTL', 'MUC', 'MUNICH INTERNATIONAL', '2025-09-29', '0000-00-00', '1 Adult - Economy', 1, 0, 0, 'Economy', '2025-09-12 08:09:33'),
(5, 22, 'SJD', 'LOS CABOS INTL', 'MUC', 'MUNICH INTERNATIONAL', '2025-09-29', '0000-00-00', '1 Passenger - Economy', 1, 0, 0, 'Economy', '2025-09-12 08:10:04'),
(6, 22, 'DEL', 'INDIRA GANDHI INTL', 'GOI', 'DABOLIM', '2025-09-21', '0000-00-00', '1 Adult - Economy', 1, 0, 0, 'Economy', '2025-09-12 08:11:02'),
(7, 22, 'DEL', 'INDIRA GANDHI INTL', 'GOI', 'DABOLIM', '2025-09-27', '0000-00-00', '2 Adults - Economy', 2, 0, 0, 'Economy', '2025-09-12 09:14:51'),
(8, 22, 'BOM', 'CHHATRAPATI S MAHARAJ', 'MUC', 'MUNICH INTERNATIONAL', '2025-09-29', '0000-00-00', '1 Adult - Economy', 1, 0, 0, 'Economy', '2025-09-12 09:25:04'),
(9, 22, 'DEL', 'INDIRA GANDHI INTL', 'GOI', 'DABOLIM', '2025-09-15', '0000-00-00', '2 Adults - Economy', 2, 0, 0, 'Economy', '2025-09-12 10:43:12'),
(10, 22, 'DEL', 'INDIRA GANDHI INTL', 'GOI', 'DABOLIM', '2025-09-15', '0000-00-00', '2 Adults - Economy', 2, 0, 0, 'Economy', '2025-09-12 10:50:02'),
(11, 22, 'DEL', 'INDIRA GANDHI INTL', 'GOI', 'DABOLIM', '2025-09-15', '0000-00-00', '2 Adults - Economy', 2, 0, 0, 'Economy', '2025-09-12 10:50:04'),
(12, 22, 'JFK', 'JOHN F KENNEDY INTL', 'MUC', 'MUNICH INTERNATIONAL', '2025-09-29', '0000-00-00', '1 Adult, 1 Child - Economy', 1, 1, 0, 'Economy', '2025-09-12 10:50:33'),
(13, 22, 'JFK', 'JOHN F KENNEDY INTL', 'MUC', 'MUNICH INTERNATIONAL', '2025-09-29', '0000-00-00', '1 Adult, 1 Child - Economy', 1, 1, 0, 'Economy', '2025-09-12 10:59:08'),
(14, 22, 'JFN', 'NORTHEAST OHIO RGNL', 'MUC', 'MUNICH INTERNATIONAL', '2025-09-29', '2025-09-29', '2 Adults, 1 Child - Economy', 2, 1, 0, 'Economy', '2025-09-12 11:14:34'),
(15, 22, 'MUC', 'MUNICH INTERNATIONAL', 'JFK', 'JOHN F KENNEDY INTL', '2025-09-22', '0000-00-00', '2 Adults, 1 Child - Economy', 2, 1, 0, 'Economy', '2025-09-12 11:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `passenger_details`
--

CREATE TABLE `passenger_details` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger_details`
--

INSERT INTO `passenger_details` (`id`, `booking_id`, `first_name`, `last_name`, `gender`, `date_of_birth`) VALUES
(1, '1', 'Vinod', 'Kumar', 'Male', '2010-02-08'),
(2, '2', 'Vinod', 'Kumar', 'Male', '2010-02-08'),
(3, '3', 'Vinod', 'Kumar', 'Male', '2022-02-06'),
(4, '4', 'Vinod', 'Kumar', 'Male', '2025-09-04'),
(5, '5', 'Vinod', 'Kumar', 'Male', '1998-02-03'),
(6, '6', 'Vinod', 'Kumar', 'Male', '1998-02-03'),
(7, '7', 'Vinod', 'Kumar', 'Male', '2005-02-07'),
(8, '8', 'Vinod', 'Kumar', 'Male', '2014-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `first_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_email` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address_1` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address_2` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `state` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `city` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `created_at` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_email`, `user_password`, `user_phone`, `gender`, `date_of_birth`, `address_1`, `address_2`, `country`, `state`, `city`, `zipcode`, `created_at`) VALUES
(22, 'Vinod', 'Kumar', 'vinodkumarace01@gmail.com', '$2y$10$/TVMnAtonCS9k1ovRbyaw.qH/ynhpYpTvhO4yoRTcRxgNSu4b0RFK', '9711539752', 'Male', '0000-00-00', 'Sector-19, Udhyog Vihar', 'DLF City', 'India', 'Haryana', 'Gurgaon', 121001, '2025-09-10 17:54:51'),
(24, 'Ravi', 'Kumar', 'ravi@gmail.com', '$2y$10$Z6ZyovmMl6UXwBG1AioP6OeoMRf.PBdd26JqbbXuz0LZIX5TbhsLq', '9711539752', 'Male', '0000-00-00', '', '', '', '', '', 0, '2025-09-11 15:29:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight_search`
--
ALTER TABLE `flight_search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passenger_details`
--
ALTER TABLE `passenger_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email_Id` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flight_search`
--
ALTER TABLE `flight_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `passenger_details`
--
ALTER TABLE `passenger_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
