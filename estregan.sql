-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 04:11 AM
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
(1, 'super admin', 'admin', 'admin', 'super admin', 'admin');

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
(1, 'standard', 'asdas'),
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

--
-- Dumping data for table `cottage_tbl`
--

INSERT INTO `cottage_tbl` (`cottage_id`, `cottage_status`, `cottage_number`, `cottage_type`, `number_of_person`, `day_price`, `night_price`, `cottage_photo`) VALUES
(1, 'Available', 1234, 'Standard', 12, 1000, 1200, '../images/cottage.jpg'),
(2, 'Available', 1234, 'Family', 13, 1000, 1200, '../images/bg9.jpg'),
(3, 'Available', 1236, 'Standard', 13, 1000, 1200, '../images/cottage.jpg'),
(5, 'Available', 1234, 'Standard', 12, 1000, 1200, '../images/cottage.jpg'),
(6, 'Available', 1234, 'Barkadahan', 12, 1000, 1200, '../images/cottage.jpg'),
(7, 'Available', 1235, 'Exclusive', 12, 1000, 1200, '../images/cottage.jpg'),
(8, 'Available', 3214, 'Barkadahan', 12, 1000, 1200, '../images/cottage.jpg');

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
(1, 'standard', '213124'),
(2, 'family', 'none'),
(6, 'barkadahan', 'none'),
(8, 'superior', 'none');

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
  `cottage_number` bigint(255) NOT NULL,
  `cottage_type` varchar(255) NOT NULL,
  `number_of_person` int(255) NOT NULL,
  `special_request` text NOT NULL,
  `cottage_photo` varchar(255) NOT NULL,
  `cottage_reserve_fee` bigint(255) NOT NULL,
  `rejection_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserve_cottage_tbl`
--

INSERT INTO `reserve_cottage_tbl` (`reserve_id`, `user_id`, `reserve_status`, `reserve_type`, `first_name`, `middle_name`, `last_name`, `reserve_address`, `phone_number`, `email`, `date_of_arrival`, `time`, `price`, `cottage_number`, `cottage_type`, `number_of_person`, `special_request`, `cottage_photo`, `cottage_reserve_fee`, `rejection_reason`) VALUES
(1, 38, 'cancelled', 'online', 'mark', 'jon', 'paul', 'asdafasf', 91215613215, '', '2024-07-26', 'Day (6:00 AM to 5:00 PM)', 1000, 1234, 'Standard', 12, '', '../images/cottage.jpg', 100, ''),
(2, 38, 'checkedOut', 'online', 'asasfasa', 'sfasfas', 'safasfa', 'sfasfasd', 34265235, '', '2024-08-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1234, 'Standard', 12, '', '../images/cottage.jpg', 100, ''),
(3, 50, 'rejected', 'online', 'john ', 'asfas', ' bonustro', 'rebe, lala, lDN', 9456632525, 'Arjay@gmail.com', '2024-08-24', 'Night (6:00 PM to 5:00 AM)', 1200, 1234, 'Standard', 12, '', '../images/cottage.jpg', 0, ''),
(4, 38, 'pending', 'online', 'user', 'user', 'user', 'marandi,lala, ldn', 968685567, '', '2024-08-25', 'Night (6:00 PM to 5:00 AM)', 1200, 1234, 'Standard', 12, '', '../images/cottage.jpg', 0, ''),
(5, 38, 'checkedOut', 'online', 'arjay', 'llagas', 'bonustro', 'rebe, lala, ldn', 92632134125, '', '2024-08-28', 'Night (6:00 PM to 5:00 AM)', 1200, 1234, 'Standard', 12, '', '../images/cottage.jpg', 100, ''),
(6, 0, 'pending', 'walk-in', 'arjay', 'bonustro', 'vvv', 'rebe', 9567473435, '', '2024-08-28', 'Day (6:00 AM to 5:00 PM)', 1000, 1234, 'Standard', 12, '', '../images/cottage.jpg', 0, ''),
(7, 0, 'pending', 'walk-in', 'arjay', 'llgas', 'bonustro', 'rebe, ', 91231512, '', '2024-08-28', 'Day (6:00 AM to 5:00 PM)', 1000, 1234, 'Standard', 12, '', '../images/cottage.jpg', 0, ''),
(8, 0, 'rejected', 'walk-in', 'hagorn', 'yb', 'huy', 'huyuhuy', 1234, 'ardbhs@gmail.com', '2024-08-28', 'Night (6:00 PM to 5:00 AM)', 1200, 1234, 'Standard', 12, 'naay chix', '../images/cottage.jpg', 0, ''),
(9, 0, 'pending', 'walk-in', 'newuser', 'new', 'new', 'newuser', 92131515, '', '2024-08-31', 'Day (6:00 AM to 5:00 PM)', 1000, 1234, 'Standard', 12, '', '../images/cottage.jpg', 0, ''),
(10, 0, 'pending', 'walk-in', 'new', 'new', 'nrew', 'new', 91231512, '', '2024-08-30', 'Day (6:00 AM to 5:00 PM)', 1000, 1234, 'Standard', 12, '', '../images/cottage.jpg', 0, '');

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
  `reservation_fee` bigint(255) NOT NULL,
  `extra_bed` int(255) NOT NULL,
  `extra_person` int(255) NOT NULL,
  `total_fee` bigint(255) NOT NULL,
  `extend_time` int(255) NOT NULL,
  `extend_price` bigint(255) NOT NULL,
  `additional_payment` bigint(255) NOT NULL,
  `time_out` time NOT NULL,
  `rejection_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserve_room_tbl`
--

INSERT INTO `reserve_room_tbl` (`reserve_id`, `user_id`, `status`, `reservation_type`, `fname`, `mname`, `lname`, `address`, `phone_number`, `email`, `date_of_arrival`, `time_of_arrival`, `room_number`, `room_type`, `bed_type`, `bed_quantity`, `number_of_person`, `amenities`, `price`, `special_request`, `photo`, `reservation_fee`, `extra_bed`, `extra_person`, `total_fee`, `extend_time`, `extend_price`, `additional_payment`, `time_out`, `rejection_reason`) VALUES
(48, 0, 'checkedOut', '', 'arjay', '', 'bonustro', 'Purok-3 Rebe, Lala, Lanao Del Norte ', 9366307608, ' arjaybonustro@gmail.com', '2024-04-26', '15:00:00', 0, 'Standard', 'Double bed', 1, 2, 'Free wifi and Aircon split type', 91, '', '../images/standard1.jpg', 100, 0, 0, 0, 0, 0, 0, '12:00:00', ''),
(49, 0, 'confirmed', '', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '13:00:00', 0, 'Barkadahan', 'Bunk bed', 5, 10, 'Aircon-wifi-Dining area', 341, '', '../images/fg.jpg', 100, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(50, 0, 'checkedOut', '', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '11:00:00', 0, 'Standard', 'Double bed', 1, 2, 'Free wifi and Aircon split type', 91, '', '../images/standard1.jpg', 100, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(51, 0, 'checkedOut', '', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9366307608, ' paul@gmail.com', '2024-04-25', '11:00:00', 0, 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, '', '../images/sax.jpg', 100, 0, 0, 0, 0, 0, 0, '12:00:00', ''),
(52, 0, 'rejected', '', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 74298472398, ' paul@gmail.com', '2024-04-26', '14:00:00', 0, 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, '', '../images/sax.jpg', 100, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(53, 0, 'checkedOut', '', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 9309023902, ' paul@gmail.com', '2024-04-25', '14:00:00', 0, 'Barkadahan', 'Bunk bed', 5, 12, 'Aircon-wifi-Dining area-TV', 350, '', '../images/sax.jpg', 100, 0, 0, 0, 0, 0, 0, '15:00:00', ''),
(54, 0, 'checkedOut', '', 'paul', '', 'eyy', 'purok 3 Banana village, Kapatagan Lanao del norte ', 255444645, ' paul@gmail.com', '2024-04-25', '14:00:00', 0, 'Standard', 'Queen bed', 1, 2, 'Free wifi, Aircon split type and TV', 100, '', '../images/qw.jpg', 100, 0, 0, 0, 2, 200, 400, '10:00:00', ''),
(55, 0, 'checkedOut', '', 'jm', '', 'maka', 'lapinig Kapatagan lala lanao del norte ', 9366639585, ' jm@gmail.com', '2024-04-26', '14:00:00', 0, 'Family', 'Bunk bed', 4, 10, 'Aircon-wifi-Dining area', 250, '', '../images/pa.jpg', 100, 0, 0, 150, 0, 0, 0, '11:00:00', ''),
(56, 0, 'cancelled', '', 'paul', '', 'eyy', 'Purok-3 Rebe, Lala, Lanao Del Norte ', 9366307608, ' paul@gmail.com', '2024-05-05', '14:00:00', 0, 'Standard', 'Double bed', 1, 2, 'Free wifi, Aircon split type and TV', 150, '', '../images/qw.jpg', 100, 0, 0, 150, 0, 0, 0, '11:00:00', 'wa ni dayun'),
(57, 0, 'checkedOut', '', 'arjay', 'loverboy', ' bonustro', 'marandi,lala, ldn ', 91251616136, ' Arjay@gmail.com', '2024-05-28', '14:00:00', 0, 'Superior', 'Double bed', 12, 12, 'free wifi and aircon', 2000, 'none', '../images/standard1.jpg', 0, 0, 0, 2000, 0, 0, 0, '11:00:00', ''),
(66, 38, 'cancelled', 'online', 'john ', 'loverboy', 'Oni', 'marandi,lala, ldn', 4745464327, '', '2024-07-03', '14:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, '', 'images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(71, 50, 'cancelled', 'online', 'arjay', 'llagas', 'Bonustro', 'rebe, lala, lDN', 123456, 'Arjay@gmail.com', '2024-08-24', '14:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(72, 50, 'cancelled', 'online', 'john ', 'Babayaga', ' bonustro', 'rebe, lala, lDN', 123151346, 'johnwick@gmail.com', '2024-08-24', '14:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(76, 38, 'confirmed', 'online', 'john ', 'Babayaga', 'wick', 'marandi,lala, ldn', 92523513, 'johnwick@gmail.com', '2024-08-24', '14:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, '', '../images/single.jpg', 0, 0, 0, 2000, 0, 0, 0, '11:00:00', ''),
(77, 38, 'extended', 'online', 'john ', 'Babayaga', ' bonustro', 'marandi,lala, ldn', 89676854, 'user@gmail.com', '2024-08-24', '14:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, '', '../images/single.jpg', 200, 1, 0, 2400, 1, 100, 100, '12:00:00', ''),
(78, 38, 'rejected', 'online', 'john ', 'Babayaga', 'wick', 'marandi,lala, ldn', 9798795, 'user@gmail.com', '2024-08-24', '14:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', 'no vacant'),
(79, 38, 'pending', 'online', 'user', 'user', 'user', 'tenazas, Lala, LDN', 92314125124, '', '2024-08-25', '14:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(80, 0, 'pending', 'walk-in', 'arjay', 'llagas', 'bonustro', 'rebe,lala, ldn', 9213241254, '', '2024-08-28', '00:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 0, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(81, 0, 'pending', 'walk-in', 'arjay', 'llasga', 'adagasdr', 'reve', 987436345, '', '2024-08-28', '00:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 1, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(82, 0, 'pending', 'walk-in', 'arjau', 'asdafaga', 'adasdad', 'fafafa', 9867855, '', '2024-08-28', '14:38:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 1, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(83, 0, 'pending', 'walk-in', 'arjay', 'llagas', 'bonustro', 'rebe', 91234125, '', '2024-08-28', '15:04:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(84, 0, 'pending', 'walk-in', 'new', 'new', 'new', 'new', 98678595, '', '2024-08-30', '02:00:00', 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, '00:00:00', '');

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
(2, 'occupied', 'none'),
(4, 'unavailable', 'none'),
(5, 'under management', 'under2');

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
(89, 1214, 'Superior', 'Double bed', 12, 12, 'free wifi and aircon', 2000, 'Coming soon', '../images/standard1.jpg'),
(91, 1235, 'Standard', 'Single bed', 1, 1, 'free wifi', 2000, 'Available', '../images/single.jpg'),
(98, 1858, 'Exclusive', 'King bed', 2, 2, 'free wifi, aircon, hot and cold shower and dining area', 2000, 'Available', '../images/single.jpg'),
(100, 12443, 'Barkadahan', 'King bed', 2, 2, 'free wifi, aircon, hot and cold shower and dining area', 2000, 'Available', '../images/single.jpg'),
(101, 1231541, 'Family', 'Single bed', 2, 2, 'free wifi, aircon, hot and cold shower and dining area', 1000, 'Available', '../images/standard1.jpg'),
(102, 12415, 'Standard', 'Single bed', 2, 2, 'free wifi, aircon, hot and cold shower and dining area', 1000, 'Occupied', '../images/standard1.jpg'),
(104, 1241, 'Standard', 'Single Bed', 1, 2, 'free wifi and aircon', 1000, 'Available', '../images/af11d9a50d3ce7d5d7929df98d25271b.jpg');

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
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `full_name`, `contact_number`, `email`, `password`, `gender`, `birthdate`, `address`, `date_created`, `account_status`) VALUES
(37, '', 9510324586, 'arjaybonustro@gmail.com', 'arjay123', '', '0000-00-00', '', '2024-07-07', 'active'),
(38, 'first user', 9366307608, 'user@gmail.com', 'user', 'male', '2005-08-18', 'Maranding, Lala, LDN', '2024-07-07', 'active'),
(47, 'john cena', 9214167412, 'john@gmail.com', 'john', '', '0000-00-00', '', '2024-07-07', 'active'),
(48, 'firstname lastname', 9123115124, 'user2@gmail.com', 'user2', '', '0000-00-00', '', '2024-07-07', 'deleted'),
(49, 'john wick', 91234567, 'johnwick@gmail.com', 'johnwick2', 'male', '2024-08-16', '', '2024-08-17', 'active'),
(50, 'arjay', 123456, 'Arjay@gmail.com', 'qwert', '', '0000-00-00', '', '2024-08-23', 'active'),
(51, 'new user', 9242515, 'newuser@gmail.com', 'newuser', '', '0000-00-00', '', '2024-08-28', 'active'),
(52, 'new user2', 92131545123, 'newuser2@gmail.com', 'newuser2', '', '0000-00-00', '', '2024-08-30', 'active'),
(53, 'qwer', 689678, 'qwett@gmail.com', 'pasword', '', '0000-00-00', '', '2024-08-30', 'active'),
(54, 'ououi', 456798564, 'iouio@gmail.com', 'soljaboi', '', '0000-00-00', '', '2024-08-30', 'active'),
(55, 'ghjfjfgh', 7867868564, 'dhfgret@gmail.com', 'boiiii', '', '0000-00-00', '', '2024-08-30', 'active'),
(56, 'weqrtert', 8979708, 'gdfdh@gmail.com', 'dgsdfsa', '', '0000-00-00', '', '2024-08-30', 'active'),
(57, 'user2', 912151512, 'user3@gmail.com', 'user3', '', '0000-00-00', '', '2024-09-03', 'active');

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
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reserve_room_tbl`
--
ALTER TABLE `reserve_room_tbl`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `room_status_tbl`
--
ALTER TABLE `room_status_tbl`
  MODIFY `room_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_tbl`
--
ALTER TABLE `room_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `room_type_tbl`
--
ALTER TABLE `room_type_tbl`
  MODIFY `room_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
