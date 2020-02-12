-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 12, 2020 at 02:52 PM
-- Server version: 10.3.21-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appone_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `parent_name` varchar(50) NOT NULL,
  `mobileno` int(10) NOT NULL,
  `standard` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birth_certificate` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `parent_name`, `mobileno`, `standard`, `course`, `email`, `birth_certificate`, `created_at`) VALUES
(1, 'Dilip Singh', 'Shekhawat', 'Mohan Singh Shekhawat', 2147483647, 'B.com', 'Information Technology', 'dilip@gmail.com', '', '2020-02-11 13:17:03'),
(4, 'Sonu123', 'Jadoun123', 'Xyz Jadoun123', 1234567890, 'B.Tech', 'Information Technology', 'sonu@gmail.com', 'uploads/7081d5a9493740be83ec72bbf09ec8e1.pdf', '2020-02-12 07:35:05'),
(5, 'Dilip Singh', 'Shekhawat', 'Mohan Singh Shekhawat', 2147483647, 'B.com', 'Information Technology', 'dilipsingh123@gmail.com', 'uploads/e38bb1775a684fd56f6bb19381cdc2b0.jpg', '2020-02-11 14:25:47'),
(6, 'Dilip Singh', 'Shekhawat', 'Mohan Singh Shekhawat', 2147483647, 'B.com', 'Information Technology', 'dilipsingh12@gmail.com', 'uploads/f0b0af3e0a585b3ff4913c35f9375e84.pdf', '2020-02-11 14:28:32'),
(7, 'Dilip Singh', 'Shekhawat', 'Mohan Singh Shekhawat', 2147483647, 'B.Com', 'Information Technology', 'dilip11@gmail.com', 'uploads/fefd4eb55886243d4bdce6e9395168d9.pdf', '2020-02-12 07:40:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
