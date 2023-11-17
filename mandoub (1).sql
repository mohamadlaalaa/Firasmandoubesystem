-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 09:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mandoub`
--

-- --------------------------------------------------------

--
-- Table structure for table `governorate`
--

CREATE TABLE `governorate` (
  `governorate-id` int(11) NOT NULL,
  `governorate-name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `governorate`
--

INSERT INTO `governorate` (`governorate-id`, `governorate-name`) VALUES
(1, 'محافظة بيروت'),
(2, 'محافظة جبل لبنان'),
(3, 'محافظة لبنان الشمالي'),
(4, 'محافظة لبنان الجنوبي'),
(5, 'محافظة البقاع'),
(6, 'محافظة النبطية'),
(7, 'محافظة بعلبك الهرمل'),
(8, 'محافظة عكار');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order-id` text NOT NULL,
  `orderInvoice` int(10) NOT NULL,
  `store-categorie` text NOT NULL,
  `store-type` varchar(100) NOT NULL,
  `company-name` text NOT NULL,
  `company-number` text NOT NULL,
  `store-location-governorate` text NOT NULL,
  `location-text` text NOT NULL,
  `location-map` text NOT NULL,
  `store-receiver-name` varchar(100) NOT NULL,
  `store-receiver-number` varchar(50) NOT NULL,
  `note` varchar(2000) NOT NULL,
  `representative` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `spoon-box-count` varchar(10) NOT NULL,
  `spoon-bag-count` varchar(10) NOT NULL,
  `total-price` varchar(10) NOT NULL,
  `order-date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order-id`, `orderInvoice`, `store-categorie`, `store-type`, `company-name`, `company-number`, `store-location-governorate`, `location-text`, `location-map`, `store-receiver-name`, `store-receiver-number`, `note`, `representative`, `status`, `spoon-box-count`, `spoon-bag-count`, `total-price`, `order-date`) VALUES
(43, '9370223069790296', 0, 'مؤسسة', '', 'صيدلية الاحمد', '767216912', 'محافظة لبنان الجنوبي', 'سيسي - يسيبي - لققلر -نبخقة - ةخيبن', 'https://www.google.com/maps?q=33.8937913,35.5017767', 'يبنة ةتيب', '5118156', 'يبيب بيب ي', 'فراس لعلع', 'ملغاة', '2', '3', '49.75', '2023-11-13 20:48:03'),
(63, '8952569228440126', 89596, 'مؤسسة', '', '3', '3', 'محافظة بعلبك الهرمل', '3', 'https://www.google.com/maps?q=34.4318663,35.8376351', '3', '3', '3', 'فراس لعلع', 'قيد الانتظار', '2', '2', '43.5', '2023-11-14 12:31:40'),
(64, '9339202481018818', 84818, 'مؤسسة', '', '3', '3', 'محافظة لبنان الشمالي', '3', '', '', '3', '', 'فراس لعلع', 'قيد الانتظار', '2', '1', '37.25', '2023-11-14 12:32:06'),
(65, '4136657425717956', 65535, 'مؤسسة', '', 'fgdg', 'dg', 'محافظة لبنان الشمالي', 'dg', 'https://www.google.com/maps?q=34.4446064,35.82629', 'dg', 'dg', 'dg', 'فراس لعلع', 'قيد الانتظار', '1', '2', '28', '2023-11-15 17:26:24'),
(66, '5680544311179552', 14655, 'مؤسسة', '', 'h', 'h', 'محافظة لبنان الشمالي', 'h', '', 'h', 'h', '', 'فراس لعلع', 'قيد الانتظار', '3', '4', '71.5', '2023-11-15 17:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `username`, `password`, `isAdmin`) VALUES
(1, 454545, 'محمد لعلع', 'm', '*E8BEE713F0CBBB9F9B09623007E2826138710274', 0),
(2, 629459256, 'فراس لعلع', 'f', '*241E241B694B4F0B740CF5B9775AFD9A511E1CEC', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
