-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 11:19 AM
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
-- Database: `estregan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `admin_type` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_type`, `first_name`, `last_name`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 'admin_arjay', 'arjaybonustro');

-- --------------------------------------------------------

--
-- Table structure for table `bed_type_tbl`
--

CREATE TABLE `bed_type_tbl` (
  `bed_type_id` int(11) NOT NULL,
  `bed_type_name` varchar(255) NOT NULL,
  `bed_type_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bed_type_tbl`
--

INSERT INTO `bed_type_tbl` (`bed_type_id`, `bed_type_name`, `bed_type_description`) VALUES
(1, 'single bed', 'none'),
(2, 'double bed', 'none'),
(3, 'queen bed', 'none'),
(4, 'king bed', 'none'),
(5, 'sofa bed', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `cottage_status_tbl`
--

CREATE TABLE `cottage_status_tbl` (
  `cottage_status_id` int(11) NOT NULL,
  `cottage_status_name` varchar(255) NOT NULL,
  `cottage_status_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cottage_status_tbl`
--

INSERT INTO `cottage_status_tbl` (`cottage_status_id`, `cottage_status_name`, `cottage_status_description`) VALUES
(1, 'available', 'none'),
(2, 'occupied', 'none\r\n'),
(5, 'under management', 'none'),
(6, 'under management', 'none'),
(7, 'under management', 'none'),
(8, 'under management', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `cottage_tbl`
--

CREATE TABLE `cottage_tbl` (
  `cottage_id` int(11) NOT NULL,
  `cottage_status` varchar(255) NOT NULL,
  `cottage_number` bigint(255) NOT NULL,
  `cottage_type` varchar(255) NOT NULL,
  `number_of_person` int(255) NOT NULL,
  `day_price` bigint(255) NOT NULL,
  `night_price` bigint(255) NOT NULL,
  `cottage_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cottage_type_tbl`
--

CREATE TABLE `cottage_type_tbl` (
  `cottage_type_id` int(11) NOT NULL,
  `cottage_type_name` varchar(255) NOT NULL,
  `cottage_type_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cottage_type_tbl`
--

INSERT INTO `cottage_type_tbl` (`cottage_type_id`, `cottage_type_name`, `cottage_type_description`) VALUES
(1, 'standard', '213124');

-- --------------------------------------------------------

--
-- Table structure for table `gcash_tbl`
--

CREATE TABLE `gcash_tbl` (
  `id` int(11) NOT NULL,
  `gcash_number` varchar(255) NOT NULL,
  `gcash_photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gcash_tbl`
--

INSERT INTO `gcash_tbl` (`id`, `gcash_number`, `gcash_photo`) VALUES
(1, '0975467346', 'gcash_photo/QR ECC Low Example.png');

-- --------------------------------------------------------

--
-- Table structure for table `reserve_cottage_tbl`
--

CREATE TABLE `reserve_cottage_tbl` (
  `reserve_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `reserve_status` varchar(255) NOT NULL,
  `reserve_type` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `reserve_address` text NOT NULL,
  `phone_number` bigint(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_arrival` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `price` bigint(255) NOT NULL,
  `payment` bigint(255) NOT NULL,
  `balance` bigint(255) NOT NULL,
  `cottage_number` bigint(255) NOT NULL,
  `cottage_type` varchar(255) NOT NULL,
  `number_of_person` int(255) NOT NULL,
  `special_request` text NOT NULL,
  `cottage_photo` varchar(255) NOT NULL,
  `reference_number` bigint(255) NOT NULL,
  `cottage_reserve_fee` bigint(255) NOT NULL,
  `rejection_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reserve_room_tbl`
--

CREATE TABLE `reserve_room_tbl` (
  `reserve_id` int(11) NOT NULL,
  `user_id` bigint(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reservation_type` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` bigint(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_arrival` text NOT NULL,
  `time_of_arrival` time NOT NULL,
  `room_number` bigint(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `bed_type` varchar(255) NOT NULL,
  `bed_quantity` int(50) NOT NULL,
  `number_of_person` int(255) NOT NULL,
  `amenities` varchar(255) NOT NULL,
  `price` bigint(255) NOT NULL,
  `special_request` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `reference_number` bigint(255) NOT NULL,
  `reservation_fee` bigint(255) NOT NULL,
  `extra_bed_and_person` int(255) NOT NULL,
  `total_fee` bigint(255) NOT NULL,
  `payment` bigint(255) NOT NULL,
  `balance` bigint(255) NOT NULL,
  `extend_time` int(255) NOT NULL,
  `extend_price` bigint(255) NOT NULL,
  `additional_payment` bigint(255) NOT NULL,
  `time_out` time NOT NULL,
  `rejection_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_amenities_tbl`
--

CREATE TABLE `room_amenities_tbl` (
  `amenity_id` int(11) NOT NULL,
  `amenity_name` varchar(255) NOT NULL,
  `amenity_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_amenities_tbl`
--

INSERT INTO `room_amenities_tbl` (`amenity_id`, `amenity_name`, `amenity_description`) VALUES
(1, 'air condition', 'none'),
(2, 'wi-fi', 'none'),
(3, 'television', 'none'),
(4, 'robes and slippers', 'none'),
(6, 'hair dryer', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `room_status_tbl`
--

CREATE TABLE `room_status_tbl` (
  `room_status_id` int(11) NOT NULL,
  `room_status_name` varchar(255) NOT NULL,
  `room_status_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_status_tbl`
--

INSERT INTO `room_status_tbl` (`room_status_id`, `room_status_name`, `room_status_description`) VALUES
(1, 'available', 'none\r\n'),
(4, 'unavailable', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `room_tbl`
--

CREATE TABLE `room_tbl` (
  `id` int(11) NOT NULL,
  `room_number` bigint(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `bed_type` varchar(255) NOT NULL,
  `bed_quantity` int(20) NOT NULL,
  `no_persons` int(50) NOT NULL,
  `amenities` varchar(255) NOT NULL,
  `price` bigint(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type_tbl`
--

CREATE TABLE `room_type_tbl` (
  `room_type_id` int(11) NOT NULL,
  `room_type_name` varchar(255) NOT NULL,
  `room_type_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type_tbl`
--

INSERT INTO `room_type_tbl` (`room_type_id`, `room_type_name`, `room_type_description`) VALUES
(1, 'standard', 'none'),
(2, 'superior', 'none'),
(3, 'family', 'barkadahan'),
(4, 'barkadahan', 'none'),
(5, 'exclusive', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `contact_number` bigint(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `account_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bed_type_tbl`
--
ALTER TABLE `bed_type_tbl`
  ADD PRIMARY KEY (`bed_type_id`);

--
-- Indexes for table `cottage_status_tbl`
--
ALTER TABLE `cottage_status_tbl`
  ADD PRIMARY KEY (`cottage_status_id`);

--
-- Indexes for table `cottage_tbl`
--
ALTER TABLE `cottage_tbl`
  ADD PRIMARY KEY (`cottage_id`);

--
-- Indexes for table `cottage_type_tbl`
--
ALTER TABLE `cottage_type_tbl`
  ADD PRIMARY KEY (`cottage_type_id`);

--
-- Indexes for table `gcash_tbl`
--
ALTER TABLE `gcash_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve_cottage_tbl`
--
ALTER TABLE `reserve_cottage_tbl`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `reserve_room_tbl`
--
ALTER TABLE `reserve_room_tbl`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `room_amenities_tbl`
--
ALTER TABLE `room_amenities_tbl`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `room_status_tbl`
--
ALTER TABLE `room_status_tbl`
  ADD PRIMARY KEY (`room_status_id`);

--
-- Indexes for table `room_tbl`
--
ALTER TABLE `room_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type_tbl`
--
ALTER TABLE `room_type_tbl`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bed_type_tbl`
--
ALTER TABLE `bed_type_tbl`
  MODIFY `bed_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cottage_status_tbl`
--
ALTER TABLE `cottage_status_tbl`
  MODIFY `cottage_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cottage_tbl`
--
ALTER TABLE `cottage_tbl`
  MODIFY `cottage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cottage_type_tbl`
--
ALTER TABLE `cottage_type_tbl`
  MODIFY `cottage_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reserve_cottage_tbl`
--
ALTER TABLE `reserve_cottage_tbl`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `reserve_room_tbl`
--
ALTER TABLE `reserve_room_tbl`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `room_amenities_tbl`
--
ALTER TABLE `room_amenities_tbl`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room_status_tbl`
--
ALTER TABLE `room_status_tbl`
  MODIFY `room_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_tbl`
--
ALTER TABLE `room_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `room_type_tbl`
--
ALTER TABLE `room_type_tbl`
  MODIFY `room_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
