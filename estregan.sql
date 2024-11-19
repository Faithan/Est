-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 01:19 AM
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
(1, 'admin', 'admin', 'admin', 'admin', 'admin');

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

--
-- Dumping data for table `cottage_tbl`
--

INSERT INTO `cottage_tbl` (`cottage_id`, `cottage_status`, `cottage_number`, `cottage_type`, `number_of_person`, `day_price`, `night_price`, `cottage_photo`) VALUES
(2, 'Available', 1239, 'Standard', 13, 1000, 1200, '../images/bg9.jpg'),
(3, 'Available', 1238, 'Standard', 13, 1000, 1200, '../images/cottage.jpg'),
(5, 'Available', 1237, 'Standard', 12, 1000, 1200, '../images/cottage.jpg'),
(6, 'Available', 1236, 'Standard', 12, 1000, 1200, '../images/cottage.jpg'),
(7, 'Available', 1235, 'Standard', 12, 1000, 1200, '../images/cottage.jpg'),
(8, 'Available', 1234, 'Standard', 12, 1000, 1200, '../images/cottage.jpg');

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
(1, '0975467346', 'gcash_photo/gcash_pic.jpg');

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
  `reference_number` bigint(255) NOT NULL,
  `cottage_reserve_fee` bigint(255) NOT NULL,
  `rejection_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserve_cottage_tbl`
--

INSERT INTO `reserve_cottage_tbl` (`reserve_id`, `user_id`, `reserve_status`, `reserve_type`, `first_name`, `middle_name`, `last_name`, `reserve_address`, `phone_number`, `email`, `date_of_arrival`, `time`, `price`, `cottage_number`, `cottage_type`, `number_of_person`, `special_request`, `cottage_photo`, `reference_number`, `cottage_reserve_fee`, `rejection_reason`) VALUES
(15, 0, 'checkedOut', 'walk-in', 'john ', 'Babayaga', 'wick', 'marandi,lala, ldn', 9079678585687, 'johnwick@gmail.com', '2024-10-06', 'Day (6:00 AM to 5:00 PM)', 1000, 1234, 'Standard', 12, '', '../images/cottage.jpg', 0, 100, ''),
(16, 38, 'checkedOut', 'online', 'arjay', 'llagas', 'bunostro', 'marandi,lala, ldn', 912151121, '', '2024-10-25', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 1281798571, 200, ''),
(17, 38, 'confirmed', 'online', 'sdfaa', 'fasfsa', 'asfaasf', 'hafafafaf', 89758438, '', '2024-10-26', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 200, ''),
(18, 38, 'pending', 'online', 'sdfaa', 'fasfsa', 'asfaasf', 'hafafafaf', 89758438, '', '2024-10-26', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 9999999999999999, 0, ''),
(19, 0, 'checkedOut', 'walk-in', 'john', 'llagas', 'bunostro', 'rebe, lala, lDN', 9121151161, '', '2024-11-17', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(20, 38, 'pending', 'online', 'john ', 'Babayaga', ' bonustro', 'rebe, lala, lDN', 92324234234, '', '2024-11-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(21, 38, 'pending', 'online', 'john ', 'Babayaga', ' bonustro', 'rebe, lala, lDN', 92324234234, '', '2024-11-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(22, 38, 'rejected', 'online', 'john ', 'llagas', ' bonustro', 'rebe, lala, lDN', 909685856757, '', '2024-11-18', 'Night (6:00 PM to 5:00 AM)', 1200, 1239, 'Standard', 13, '', '', 0, 0, ''),
(23, 38, 'rejected', 'online', 'john ', 'Babayaga', ' bonustro', 'rebe, lala, lDN', 956456456456, '', '2024-11-18', 'Night (6:00 PM to 5:00 AM)', 1200, 1239, 'Standard', 13, '', '', 0, 0, ''),
(24, 38, 'pending', 'online', 'john ', 'Babayaga', ' bonustro', 'rebe, lala, lDN', 954646456456, '', '2024-11-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '', 0, 0, ''),
(25, 38, 'rejected', 'online', 'john ', 'Babayaga', ' bonustro', 'marandi,lala, ldn', 945645645654, '', '2024-11-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '', 0, 0, ''),
(26, 38, 'pending', 'online', 'john ', 'Babayaga', ' bonustro', 'marandi,lala, ldn', 9456464564, '', '2024-11-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(27, 38, 'pending', 'online', 'john ', 'Babayaga', ' bonustro', 'marandi,lala, ldn', 9456464564, '', '2024-11-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(28, 38, 'pending', 'online', 'john ', 'Babayaga', ' bonustro', 'marandi,lala, ldn', 9456464564, '', '2024-11-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(29, 38, 'pending', 'online', 'john ', 'Babayaga', ' bonustro', 'marandi,lala, ldn', 9456464564, '', '2024-11-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(30, 38, 'pending', 'online', 'john ', 'Babayaga', ' bonustro', 'marandi,lala, ldn', 9456464564, '', '2024-11-18', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(31, 38, 'pending', 'online', 'adadasd', 'asdasdad', 'asdasdad', 'gfhfhghfhfg', 906757575, '', '2024-11-25', 'Night (6:00 PM to 5:00 AM)', 1200, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(32, 38, 'pending', 'online', 'adadasd', 'asdasdad', 'asdasdad', 'gfhfhghfhfg', 906757575, '', '2024-11-25', 'Night (6:00 PM to 5:00 AM)', 1200, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, ''),
(33, 38, 'checkedIn', 'online', 'john', 'asdasdad', 'adadasdas', 'asdadada', 908776867876, '', '2024-11-23', 'Day (6:00 AM to 5:00 PM)', 1000, 1238, 'Standard', 13, '', '../images/cottage.jpg', 0, 200, ''),
(34, 38, 'pending', 'online', 'asdads', 'asdasdad', 'adadada', 'asdada', 98798798, '', '2024-11-22', 'Day (6:00 AM to 5:00 PM)', 1000, 1239, 'Standard', 13, '', '../images/bg9.jpg', 0, 0, '');

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

INSERT INTO `reserve_room_tbl` (`reserve_id`, `user_id`, `status`, `reservation_type`, `fname`, `mname`, `lname`, `address`, `phone_number`, `email`, `date_of_arrival`, `time_of_arrival`, `room_number`, `room_type`, `bed_type`, `bed_quantity`, `number_of_person`, `amenities`, `price`, `special_request`, `photo`, `reference_number`, `reservation_fee`, `extra_bed`, `extra_person`, `total_fee`, `extend_time`, `extend_price`, `additional_payment`, `time_out`, `rejection_reason`) VALUES
(88, 0, 'checkedIn', 'walk-in', 'john ', 'Babayaga', 'wick', 'marandi,lala, ldn', 92352626, '', '2024-10-06', '18:29:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 0, 200, 0, 0, 1800, 0, 0, 0, '11:00:00', ''),
(89, 0, 'confirmed', 'walk-in', 'john ', 'llagas', 'Oni', 'rebe, lala, lDN', 923663626, '', '2024-10-15', '12:59:00', 1236, 'Standard', 'Single Bed', 2, 2, '', 1000, '', '../images/standard1.jpg', 0, 200, 0, 0, 1000, 0, 0, 0, '11:00:00', ''),
(90, 0, 'confirmed', 'walk-in', 'arjay', 'llagas', 'bonustro', 'rebe, lala, lDN', 92262625, '', '2024-10-15', '12:01:00', 1235, 'Standard', 'Single Bed', 1, 2, '', 1000, '', '../images/af11d9a50d3ce7d5d7929df98d25271b.jpg', 0, 200, 0, 0, 1000, 0, 0, 0, '11:00:00', ''),
(91, 38, 'checkedOut', 'online', 'username', 'usermname', 'userlastname', 'rebe, lala, lDN', 91215412516, 'user@gmail.com', '2024-10-26', '14:00:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 182515116, 200, 0, 0, 1800, 0, 0, 0, '11:00:00', ''),
(92, 38, 'confirmed', 'online', 'arjay', 'llagas', 'bunostro', 'marandi,lala, ldn', 912315116, '', '2024-10-26', '14:00:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 465485454, 200, 0, 0, 2000, 0, 0, 0, '11:00:00', ''),
(93, 0, 'checkedOut', 'walk-in', 'john ', 'llagas', ' bonustro', 'rebe, lala, lDN', 925262262, '', '2024-11-17', '00:20:00', 1236, 'Standard', 'Single Bed', 2, 2, '', 1000, '', '../images/standard1.jpg', 0, 0, 0, 0, 1000, 0, 0, 0, '11:00:00', ''),
(94, 38, 'pending', 'online', 'john ', 'Babayaga', ' bonustro', 'marandi,lala, ldn', 9345345345, '', '2024-11-22', '14:00:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(95, 38, 'pending', 'online', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 8898979, '', '2024-11-21', '14:00:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(96, 38, 'pending', 'online', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 8898979, '', '2024-11-21', '14:00:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(97, 38, 'pending', 'online', 'asdasd', 'asdasd', 'asdasdas', 'asdasd', 9787687, '', '2024-11-22', '14:00:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(98, 38, 'pending', 'online', 'ertert', 'ertert', 'ertet', 'rebe, lala, lDN', 9078978979, '', '2024-11-23', '14:00:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(99, 38, 'pending', 'online', 'john ', 'fdsfsf', 'sfsdfsf', 'sdfsf', 9675675756, '', '2024-11-23', '14:00:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(100, 38, 'cancelled', 'online', 'asdasd', 'asdasdasda', 'dasdasdad', 'adadasda', 965756757, '', '2024-11-22', '14:00:00', 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, '', '../images/single.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', ''),
(101, 38, 'cancelled', 'online', 'asdaa', 'asdadad', 'dad', 'asdads', 98978686, '', '2024-11-23', '14:00:00', 1236, 'Standard', 'Single Bed', 2, 2, '', 1000, '', '../images/standard1.jpg', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '');

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
(91, 1239, 'Standard', 'Single Bed', 1, 1, '', 2000, 'Available', '../images/single.jpg'),
(100, 1238, 'Barkadahan', 'King Bed', 2, 2, 'Air Condition, Wi-fi, Television', 2000, 'Available', '../images/single.jpg'),
(101, 1237, 'Family', 'Single Bed', 2, 2, '', 1000, 'Available', '../images/standard1.jpg'),
(102, 1236, 'Standard', 'Single Bed', 2, 2, '', 1000, 'Available', '../images/standard1.jpg'),
(104, 1235, 'Standard', 'Single Bed', 1, 2, '', 1000, 'Available', '../images/af11d9a50d3ce7d5d7929df98d25271b.jpg'),
(119, 1234, 'Standard', 'Single Bed', 1, 1, 'Wi-fi, Television, Robes And Slippers', 500, 'Available', '../images/670200092df4a5.59484472.jpg'),
(120, 1239, 'Standard', 'Single Bed', 2, 24, 'Air Condition, Wi-fi, Television, Robes And Slippers', 2000, 'Available', '../images/671723ddbd93e1.97552534.jpg');

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
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `reserve_room_tbl`
--
ALTER TABLE `reserve_room_tbl`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
