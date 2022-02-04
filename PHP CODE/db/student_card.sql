-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 11:26 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_card`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cardnumber` varchar(100) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `balance` varchar(20) NOT NULL,
  `cardstatus` int(50) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cardnumber`, `firstname`, `lastname`, `department`, `telephone`, `balance`, `cardstatus`) VALUES
('1581078215560', 'KIRUHURA', 'GENTIL', 'ict', '0785510947', '4002', 1),
('228239287691', 'Aline ', 'MANIZABAYO', 'MPE', '0785510947', '200', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(20) NOT NULL,
  `transaction_type` varchar(40) NOT NULL,
  `cardnumber` varchar(100) NOT NULL,
  `amount` varchar(40) NOT NULL,
  `availablebalance` varchar(40) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `transaction_type`, `cardnumber`, `amount`, `availablebalance`, `date`, `time`) VALUES
(1, 'Pull', '1581078215560', '500', '8002', '2021-09-17', '01:15:15'),
(2, 'Pull', '1581078215560', '500', '7502', '2021-09-17', '01:16:59'),
(3, 'Pull', '1581078215560', '500', '7002', '2021-09-17', '01:30:59'),
(4, 'Pull', '1581078215560', '500', '6502', '2021-09-20', '10:25:19'),
(5, 'Pull', '1581078215560', '500', '6002', '2021-09-20', '12:52:53'),
(6, 'Push', '1581078215560', '5000', '11002', '2021-09-20', '01:15:34'),
(7, 'Pull', '1581078215560', '500', '10502', '2021-09-24', '10:01:50'),
(8, 'Pull', '1581078215560', '500', '10002', '2021-09-24', '10:03:21'),
(9, 'Pull', '1581078215560', '500', '9502', '2021-09-24', '10:18:33'),
(10, 'Pull', '1581078215560', '500', '9002', '2021-09-24', '10:18:47'),
(11, 'Pull', '1581078215560', '500', '8502', '2021-09-24', '10:18:57'),
(12, 'Pull', '1581078215560', '500', '8002', '2021-09-24', '11:09:27'),
(13, 'Pull', '1581078215560', '500', '7502', '2021-09-24', '11:13:06'),
(14, 'Pull', '1581078215560', '500', '7002', '2021-09-24', '11:14:07'),
(15, 'Push', '228239287691', '200', '200', '2021-09-24', '12:58:53'),
(16, 'Push', '228239287691', '200', '400', '2021-09-24', '12:59:07'),
(17, 'Push', '228239287691', '200', '600', '2021-09-24', '12:59:13'),
(18, 'Pull', '1581078215560', '500', '6502', '2021-09-24', '01:04:24'),
(19, 'Pull', '1581078215560', '500', '6002', '2021-09-24', '06:27:50'),
(20, 'Pull', '1581078215560', '500', '5502', '2021-09-24', '06:28:02'),
(21, 'Pull', '1581078215560', '500', '5002', '2021-09-25', '01:17:44'),
(22, 'Pull', '1581078215560', '500', '4502', '2021-09-25', '01:20:12'),
(23, 'Pull', '1581078215560', '500', '4002', '2021-09-25', '01:20:12'),
(24, 'Pull', '1581078215560', '500', '3502', '2021-09-25', '01:30:47'),
(25, 'Pull', '1581078215560', '500', '3002', '2021-09-25', '01:30:56'),
(26, 'Pull', '1581078215560', '500', '2502', '2021-09-25', '01:31:19'),
(27, 'Pull', '1581078215560', '500', '2002', '2021-09-25', '08:34:48'),
(28, 'Push', '1581078215560', '2000', '4002', '2021-09-25', '09:14:38'),
(29, 'Push', '228239287691', '5000', '5200', '2021-09-25', '09:22:44'),
(30, 'Pull', '228239287691', '500', '4700', '2021-09-25', '09:22:58'),
(31, 'Pull', '228239287691', '500', '4200', '2021-09-25', '09:23:06'),
(32, 'Pull', '228239287691', '500', '3700', '2021-09-25', '09:23:19'),
(33, 'Pull', '228239287691', '500', '3200', '2021-09-25', '09:23:20'),
(34, 'Pull', '228239287691', '500', '2700', '2021-09-25', '09:23:22'),
(35, 'Pull', '228239287691', '500', '2200', '2021-09-25', '09:23:32'),
(36, 'Pull', '228239287691', '500', '1700', '2021-09-25', '09:23:37'),
(37, 'Pull', '228239287691', '500', '1200', '2021-09-25', '09:23:40'),
(38, 'Pull', '228239287691', '500', '700', '2021-09-26', '08:51:15'),
(39, 'Pull', '228239287691', '500', '200', '2021-09-26', '08:55:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cardnumber`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CardNumber` (`cardnumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`cardnumber`) REFERENCES `customer` (`cardnumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
