-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 12:49 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` bigint(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_arrival` text NOT NULL,
  `time_of_arrival` time NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `bed_type` varchar(255) NOT NULL,
  `bed_quantity` int(50) NOT NULL,
  `number_of_person` int(255) NOT NULL,
  `amenities` varchar(255) NOT NULL,
  `rate_per_hour` bigint(255) NOT NULL,
  `special_request` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `reservation_fee` bigint(255) NOT NULL,
  `hours_of_stay` int(255) NOT NULL,
  `total_price` bigint(255) NOT NULL,
  `payment` bigint(255) NOT NULL,
  `cash_change` bigint(255) NOT NULL,
  `hours_ext` int(255) NOT NULL,
  `payment_ext` bigint(255) NOT NULL,
  `cash_change_ext` bigint(255) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserve_room_tbl`
--

INSERT INTO `reserve_room_tbl` (`reserve_id`, `status`, `fname`, `lname`, `address`, `phone_number`, `email`, `date_of_arrival`, `time_of_arrival`, `room_type`, `bed_type`, `bed_quantity`, `number_of_person`, `amenities`, `rate_per_hour`, `special_request`, `photo`, `reservation_fee`, `hours_of_stay`, `total_price`, `payment`, `cash_change`, `hours_ext`, `payment_ext`, `cash_change_ext`, `time_in`, `time_out`) VALUES
(47, 'rejected', 'paul', 'eyy', 'Purok-4 banana village-Kapatagan-Lanao Del Norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '13:00:00', 'Standard', 'Double bed', 1, 2, 'Free wifi and Aircon split type', 91, '', '../images/standard1.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00'),
(48, 'checkedOut', 'arjay', 'bonustro', 'Purok-3 Rebe, Lala, Lanao Del Norte ', 9366307608, ' arjaybonustro@gmail.com', '2024-04-26', '15:00:00', 'Standard', 'Double bed', 1, 2, 'Free wifi and Aircon split type', 91, '', '../images/standard1.jpg', 100, 22, 2002, 2002, 100, 0, 0, 0, '14:00:00', '12:00:00'),
(49, 'rejected', 'paul', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '13:00:00', 'Barkadahan', 'Bunk bed', 5, 10, 'Aircon-wifi-Dining area', 341, '', '../images/fg.jpg', 100, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00'),
(50, 'checkedOut', 'paul', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '11:00:00', 'Standard', 'Double bed', 1, 2, 'Free wifi and Aircon split type', 91, '', '../images/standard1.jpg', 100, 22, 2002, 2002, 100, 3, 273, 0, '11:00:00', '00:00:00'),
(51, 'checkedOut', 'paul', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '11:00:00', 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, '', '../images/sax.jpg', 100, 22, 7700, 7700, 100, 3, 1050, 0, '11:00:00', '12:00:00'),
(52, 'confirmed', 'paul', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 74298472398, ' paul@gmail.com', '2024-04-26', '14:00:00', 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, '', '../images/sax.jpg', 100, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00'),
(53, 'checkedOut', 'paul', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9309023902, ' paul@gmail.com', '2024-04-25', '14:00:00', 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, '', '../images/sax.jpg', 100, 22, 7700, 7700, 100, 3, 1050, 0, '14:00:00', '15:00:00'),
(54, 'pending', 'paul', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 255444645, ' paul@gmail.com', '2024-04-25', '14:00:00', 'Standard', 'Queen bed', 1, 2, 'Free wifi, Aircon split type and TV', 100, '', '../images/qw.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00'),
(55, 'pending', 'jm', 'maka', 'lapinig Kapatagan lala lanao del norte ', 9366639585, ' jm@gmail.com', '2024-04-26', '14:00:00', 'Family', 'Bunk bed', 4, 10, 'Aircon-wifi-Dining area', 250, '', '../images/pa.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00'),
(56, 'checkedIn', 'paul', 'eyy', 'Purok-3 Rebe, Lala, Lanao Del Norte ', 9366307608, ' paul@gmail.com', '2024-05-05', '14:00:00', 'Standard', 'Double bed', 1, 2, 'Free wifi, Aircon split type and TV', 150, '', '../images/qw.jpg', 200, 22, 3300, 3300, 200, 0, 0, 0, '14:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `room_tbl`
--

CREATE TABLE `room_tbl` (
  `id` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `bed_type` varchar(255) NOT NULL,
  `bed_quantity` int(20) NOT NULL,
  `no_persons` int(50) NOT NULL,
  `amenities` varchar(255) NOT NULL,
  `price` bigint(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_tbl`
--

INSERT INTO `room_tbl` (`id`, `room_type`, `bed_type`, `bed_quantity`, `no_persons`, `amenities`, `price`, `status`, `photo`) VALUES
(73, 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area', 341, 'Available', '../images/fg.jpg'),
(74, 'Family', 'Bunk bed', 3, 6, 'Aircon-wifi-Dining area-TV', 205, 'Available', '../images/op.jpg'),
(75, 'Superior', 'Queen bed', 1, 2, 'Aircon-wifi-Dining area-TV', 137, 'Available', '../images/uu.jpg'),
(78, 'Superior', 'King bed', 1, 2, 'Aircon-wifi-Dining area-TV', 160, 'Available', '../images/rt.jpg'),
(79, 'Family', 'Bunk bed', 4, 10, 'Aircon-wifi-Dining area', 250, 'Available', '../images/pa.jpg'),
(80, 'Standard', 'Queen bed', 1, 2, 'Free wifi, Aircon split type and TV', 100, 'Available', '../images/qw.jpg'),
(81, 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, 'Available', '../images/sax.jpg'),
(82, 'Standard', 'Double bed', 1, 2, 'Free wifi, Aircon split type and TV', 150, 'Available', '../images/qw.jpg'),
(83, 'Standard', 'Double bed', 3, 2, 'Free wifi, Aircon split type and TV', 150, 'Available', '../images/er.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `room_tbl`
--
ALTER TABLE `room_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
