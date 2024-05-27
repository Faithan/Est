-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 10:29 PM
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
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `reserve_room_tbl`
--

CREATE TABLE `reserve_room_tbl` (
  `reserve_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
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
  `rate_per_hour` bigint(255) NOT NULL,
  `special_request` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `reservation_fee` bigint(255) NOT NULL,
  `extra_bed` int(255) NOT NULL,
  `extra_person` int(255) NOT NULL,
  `total_fee` bigint(255) NOT NULL,
  `extend_time` int(255) NOT NULL,
  `extend_price` bigint(255) NOT NULL,
  `additional_payment` bigint(255) NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserve_room_tbl`
--

INSERT INTO `reserve_room_tbl` (`reserve_id`, `status`, `fname`, `mname`, `lname`, `address`, `phone_number`, `email`, `date_of_arrival`, `time_of_arrival`, `room_number`, `room_type`, `bed_type`, `bed_quantity`, `number_of_person`, `amenities`, `rate_per_hour`, `special_request`, `photo`, `reservation_fee`, `extra_bed`, `extra_person`, `total_fee`, `extend_time`, `extend_price`, `additional_payment`, `time_out`) VALUES
(47, 'rejected', 'paul', '', 'eyy', 'Purok-4 banana village-Kapatagan-Lanao Del Norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '13:00:00', 0, 'Standard', 'Double bed', 1, 2, 'Free wifi and Aircon split type', 91, '', '../images/standard1.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00'),
(48, 'checkedOut', 'arjay', '', 'bonustro', 'Purok-3 Rebe, Lala, Lanao Del Norte ', 9366307608, ' arjaybonustro@gmail.com', '2024-04-26', '15:00:00', 0, 'Standard', 'Double bed', 1, 2, 'Free wifi and Aircon split type', 91, '', '../images/standard1.jpg', 100, 0, 0, 0, 0, 0, 0, '12:00:00'),
(49, 'rejected', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '13:00:00', 0, 'Barkadahan', 'Bunk bed', 5, 10, 'Aircon-wifi-Dining area', 341, '', '../images/fg.jpg', 100, 0, 0, 0, 0, 0, 0, '00:00:00'),
(50, 'checkedOut', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '11:00:00', 0, 'Standard', 'Double bed', 1, 2, 'Free wifi and Aircon split type', 91, '', '../images/standard1.jpg', 100, 0, 0, 0, 0, 0, 0, '00:00:00'),
(51, 'checkedOut', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '11:00:00', 0, 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, '', '../images/sax.jpg', 100, 0, 0, 0, 0, 0, 0, '12:00:00'),
(52, 'confirmed', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 74298472398, ' paul@gmail.com', '2024-04-26', '14:00:00', 0, 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, '', '../images/sax.jpg', 100, 0, 0, 0, 0, 0, 0, '00:00:00'),
(53, 'checkedOut', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9309023902, ' paul@gmail.com', '2024-04-25', '14:00:00', 0, 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, '', '../images/sax.jpg', 100, 0, 0, 0, 0, 0, 0, '15:00:00'),
(54, 'checkedIn', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 255444645, ' paul@gmail.com', '2024-04-25', '14:00:00', 0, 'Standard', 'Queen bed', 1, 2, 'Free wifi, Aircon split type and TV', 100, '', '../images/qw.jpg', 100, 0, 0, 0, 0, 0, 0, '11:00:00'),
(55, 'extended', 'jm', '', 'maka', 'lapinig Kapatagan lala lanao del norte ', 9366639585, ' jm@gmail.com', '2024-04-26', '14:00:00', 0, 'Family', 'Bunk bed', 4, 10, 'Aircon-wifi-Dining area', 250, '', '../images/pa.jpg', 100, 0, 0, 150, 0, 0, 0, '11:00:00'),
(56, 'pending', 'paul', '', 'eyy', 'Purok-3 Rebe, Lala, Lanao Del Norte ', 9366307608, ' paul@gmail.com', '2024-05-05', '14:00:00', 0, 'Standard', 'Double bed', 1, 2, 'Free wifi, Aircon split type and TV', 150, '', '../images/qw.jpg', 200, 0, 0, 0, 0, 0, 0, '12:00:00'),
(57, 'checkedOut', 'arjay', 'loverboy', ' bonustro', 'marandi,lala, ldn ', 91251616136, ' Arjay@gmail.com', '2024-05-28', '14:00:00', 0, 'Superior', 'Double bed', 12, 12, 'free wifi and aircon', 2000, 'none', '../images/standard1.jpg', 0, 0, 0, 2000, 0, 0, 0, '11:00:00');

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

--
-- Dumping data for table `room_tbl`
--

INSERT INTO `room_tbl` (`id`, `room_number`, `room_type`, `bed_type`, `bed_quantity`, `no_persons`, `amenities`, `price`, `status`, `photo`) VALUES
(89, 1214, 'Superior', 'Double bed', 12, 12, 'free wifi and aircon', 2000, 'Coming soon', '../images/standard1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` bigint(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `first_name`, `middle_name`, `last_name`, `contact_number`, `email`, `password`) VALUES
(37, 'arjay', 'llagas', 'bonustro', 9510324586, 'arjaybonustro@gmail.com', 'arjay123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `reserve_room_tbl`
--
ALTER TABLE `reserve_room_tbl`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `room_tbl`
--
ALTER TABLE `room_tbl`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `reserve_room_tbl`
--
ALTER TABLE `reserve_room_tbl`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `room_tbl`
--
ALTER TABLE `room_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
