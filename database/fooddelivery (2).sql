-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2022 at 10:50 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fooddelivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `restau_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `picture` varchar(1000) DEFAULT NULL,
  `price` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `restau_id`, `name`, `cate_id`, `picture`, `price`) VALUES
(41, 9006, 'Ohm Delicious', 10, 'Capture.PNG', 5000000),
(42, 9006, 'Sappachok', 11, '2.png', 999999999999),
(44, 9006, 'Chicken222', 10, 'chicken2.png', 999999),
(45, 9006, 'nugget', 10, 'nugget.png', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `food_cart`
--

CREATE TABLE `food_cart` (
  `id` int(255) NOT NULL,
  `food_id` int(255) NOT NULL,
  `restau_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `amount` bigint(255) NOT NULL,
  `total_price` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `food_cate`
--

CREATE TABLE `food_cate` (
  `cate_id` int(11) NOT NULL,
  `restau_id` int(11) NOT NULL,
  `cate_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_cate`
--

INSERT INTO `food_cate` (`cate_id`, `restau_id`, `cate_name`) VALUES
(1, 1, 'drink'),
(2, 2, 'drink'),
(5, 2, 'food'),
(6, 3, 'KOT\'s drink'),
(7, 3, 'KOT\'s bakery'),
(8, 4, 'italian food'),
(9, 4, 'italian soda'),
(10, 9006, 'suicide'),
(11, 9006, 'poison');

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `order_id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `rider_id` int(11) DEFAULT NULL,
  `restau_id` int(255) NOT NULL,
  `order_amount` bigint(255) NOT NULL,
  `discount_amount` bigint(255) NOT NULL,
  `payment_amount` bigint(255) NOT NULL,
  `payment_method` int(255) NOT NULL,
  `payment_status` int(1) NOT NULL COMMENT '0-ยังไม่จ่าย 1-จ่ายแล้ว',
  `status` int(1) NOT NULL COMMENT '1-สั่งอาหาร\r\n2-ไรเดอร์รับออเดอร์\r\n3-รับอาหารแล้ว\r\n4-ส่งอาหารแล้ว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`order_id`, `food_id`, `user_id`, `rider_id`, `restau_id`, `order_amount`, `discount_amount`, `payment_amount`, `payment_method`, `payment_status`, `status`) VALUES
(63, NULL, 18, NULL, 9006, 5999994, 2399998, 3599996, 1, 0, 1),
(66, NULL, 22, NULL, 9006, 95108000, 38043200, 57064800, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_order_detail`
--

CREATE TABLE `food_order_detail` (
  `id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `food_id` int(255) NOT NULL,
  `restau_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `amount` bigint(255) NOT NULL,
  `price` bigint(255) NOT NULL,
  `total_price` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_order_detail`
--

INSERT INTO `food_order_detail` (`id`, `order_id`, `food_id`, `restau_id`, `user_id`, `amount`, `price`, `total_price`) VALUES
(25, 61, 21, 3, 18, 10, 49, 490),
(26, 61, 18, 3, 18, 15, 20, 300),
(27, 62, 42, 9006, 18, 5, 999999999999, 4999999999995),
(28, 63, 44, 9006, 18, 6, 999999, 5999994),
(29, 65, 41, 9006, 18, 18, 5000000, 90000000),
(30, 65, 45, 9006, 22, 16, 9000, 144000),
(31, 66, 45, 9006, 22, 12, 9000, 108000),
(32, 66, 41, 9006, 22, 19, 5000000, 95000000);

-- --------------------------------------------------------

--
-- Table structure for table `food_review`
--

CREATE TABLE `food_review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_comment` text DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `food_rating` int(1) NOT NULL,
  `review_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `restau`
--

CREATE TABLE `restau` (
  `restau_id` int(11) NOT NULL,
  `restau_name` varchar(30) NOT NULL,
  `restau_address` varchar(100) DEFAULT NULL,
  `restau_admin_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restau`
--

INSERT INTO `restau` (`restau_id`, `restau_name`, `restau_address`, `restau_admin_id`, `type_id`, `status`) VALUES
(1, 'Sappachok\'s Drink', '111 Bangkok, Thailand', 90000, 2, 1),
(2, 'Sea meat', '222 Bangkok, Thailand', 14, 1, 1),
(3, 'Oh my KOT! Beverage', '333 Bangkok, Thailand', 9000, 2, 1),
(4, 'Nut\'s Spaghetti', '444 Bangkok, Thailand', 16, 1, 1),
(9006, 'cccccccc', 'cccccccc', 8, 1, 0),
(9008, 'Chicken rice', 'Outer universe', 21, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `restau_discount`
--

CREATE TABLE `restau_discount` (
  `discount_id` int(11) NOT NULL,
  `restau_id` int(11) NOT NULL,
  `discount_percent` int(3) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restau_discount`
--

INSERT INTO `restau_discount` (`discount_id`, `restau_id`, `discount_percent`, `status`) VALUES
(1, 1, 40, 1),
(2, 4, 20, 1),
(4, 2, 35, 1),
(5, 3, 15, 1),
(9, 9006, 40, 1),
(11, 9008, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `restau_type`
--

CREATE TABLE `restau_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restau_type`
--

INSERT INTO `restau_type` (`id`, `type_name`) VALUES
(13, 'food'),
(14, 'drink');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL COMMENT 'ADMIN\r\nRESTAU_ADMIN\r\nCUSTOMER\r\nRIDER\r\n',
  `address` varchar(100) NOT NULL,
  `picture` varchar(400) DEFAULT NULL,
  `email` varchar(319) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `car_regis_no` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `full_name`, `user_type`, `address`, `picture`, `email`, `tel`, `car_regis_no`, `status`) VALUES
(4, '123', '123', '123456', 'admin', '12346', 'ohm.png', '12346@gmail.com', '22222222', NULL, 1),
(5, 'customer1', '123', 'aa', 'customer', 'Bangkok, Thailand', 'phupaacum.png', 'aa', '222-222-2222', NULL, 1),
(6, 'bb', 'bb', 'masked rider', 'rider', 'rider', 'phupaacum.png', 'rider@rider.com', '424-135-2452', 'rd 111', 1),
(7, 'customer2', '123', 'ccc', 'customer', 'Bangkok, Thailand', 'phupaacum.png', 'customer@customer.com', '086-444-2341', NULL, 1),
(8, 'rest', '123', 'rest', 'restau_admin', '111 Bangkok, Thailand', 'KoonBest.png', 'restaurant@restaurant.com', '675-435-1234', NULL, 1),
(9, 'sappachok', '123', 'สรรพโชค สิงหสุวรรณ', 'admin', 'Multiverse', 'phupaacum.png', 'suppachok_sin@nstru.ac.th', '191', NULL, 9000),
(11, 'customer3', '123', 'bbb', 'customer', 'Bangkok, Thailand', NULL, 'bbb', '090-213-2334', NULL, 0),
(12, 'admin2', '123', '123', 'admin', '123', 'ohm.png', '123@gmail.com', '123-123-1234', NULL, 1),
(13, 'rider', '123', 'masked rider', 'rider', 'rider', 'phupaacum.png', 'rider@rider.com', '413-565-1562', 'rd 222', 1),
(14, 'rest2', '123', 'rest', 'restau_admin', '222 Bangkok, Thailand', 'phupaacum.png', 'restaurant@restaurant.com', '124-413-2452', NULL, 1),
(15, 'rest3', '123', 'rest', 'restau_admin', '333 Bangkok, Thailand', 'phupaacum.png', 'restaurant@restaurant.com', '124-413-2452', NULL, 1),
(16, 'rest4', '123', 'rest', 'restau_admin', '444 Bangkok, Thailand', 'phupaacum.png', 'restaurant@restaurant.com', '124-413-2452', NULL, 1),
(17, 'rest5', '123', 'rest', 'restau_admin', '555 Bangkok, Thailand', 'phupaacum.png', 'restaurant@restaurant.com', '124-413-2452', NULL, 0),
(18, 'aa', 'aa', 'aa', 'customer', 'aa', NULL, 'aa', 'aa', NULL, 1),
(19, 'kot', 'kot', 'kot', 'restau_admin', 'kot', NULL, 'kot', 'kot', NULL, 1),
(20, 'cc', 'cc', 'cc', 'restau_admin', 'cc', NULL, 'cc', 'cc', NULL, 1),
(21, 'ooooo', 'ooooo', 'ooooo', 'restau_admin', 'ooooo', NULL, 'ooooo', '1231231241241', NULL, 1),
(22, 'kkk', 'kkk', 'kkk', 'customer', 'kkk', NULL, 'kkk', '6234123', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `food_cart`
--
ALTER TABLE `food_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_cate`
--
ALTER TABLE `food_cate`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `food_order_detail`
--
ALTER TABLE `food_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_review`
--
ALTER TABLE `food_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `restau`
--
ALTER TABLE `restau`
  ADD PRIMARY KEY (`restau_id`);

--
-- Indexes for table `restau_discount`
--
ALTER TABLE `restau_discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `restau_type`
--
ALTER TABLE `restau_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `food_cart`
--
ALTER TABLE `food_cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `food_cate`
--
ALTER TABLE `food_cate`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `food_order_detail`
--
ALTER TABLE `food_order_detail`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `food_review`
--
ALTER TABLE `food_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restau`
--
ALTER TABLE `restau`
  MODIFY `restau_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9009;

--
-- AUTO_INCREMENT for table `restau_discount`
--
ALTER TABLE `restau_discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `restau_type`
--
ALTER TABLE `restau_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
