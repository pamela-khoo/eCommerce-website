-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2020 at 09:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakerydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `pass`) VALUES
(1, 'admin', '123'),
(2, 'test', '12345'),
(3, 'john', '123');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodID` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `price` double(6,2) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodID`, `code`, `name`, `description`, `image`, `price`, `category`, `date`) VALUES
(2, 'D001', 'Matcha Cheesecake', 'Loaded with sweet green tea goodness, this creamy burnt basque matcha cheesecake really hits the spot', 'img/cake1.jpg', 7.50, 3, '2020-11-13 22:24:18'),
(3, 'B001', 'Grain Loaf', 'This delicious, hearty seed loaf is packed with fiber, protein and healthy fats, perfect to fill you up for breakfast', 'img/bread1.jpg', 12.00, 1, '2020-11-13 23:34:57'),
(4, 'D002', 'Chocolate Brownie', 'Ultra fudgy, slightly chewy, with a crisp top, this brownie has the deepest, darkest, chocolate flavor imaginable', 'img/cake2.jpg', 3.00, 3, '2020-11-13 23:49:22'),
(5, 'BK001', 'Artisan Loaf Kit', 'An astonishingly easy recipe — no kneading required and makes enough for three delicious loaves', 'img/diy1.jpg', 35.00, 4, '2020-11-13 23:54:41'),
(6, 'D003', 'Apple Cupcakes', 'Moist & flavorful apple spice cupcakes with salted caramel frosting on top and sprinkled with nuts', 'img/cake3.jpg', 5.50, 3, '2020-11-13 23:55:06'),
(8, 'P001', 'Danish Pastry', 'With its rich, buttery and flaky dough, there’s nothing more satisfying than the smell and taste of a Danish pastry', 'img/pastry3.jpg', 3.00, 2, '2020-11-16 03:09:50'),
(9, 'B002', 'Artisan Olive Bread', 'A mixture of Kalamata and green olives adds a distinctively buttery and fruity flavour to a fresh loaf of bread', 'img/bread2.jpg', 10.00, 1, '2020-11-16 03:13:12'),
(10, 'BK002', 'Scones Kit', 'Easy to make buttery scones, that are tender on the inside and crispy on the outside with hints of cinnamon', 'img/diy2.jpg', 30.00, 4, '2020-11-16 03:16:24'),
(11, 'D004', 'Fruit Tart', 'Rich creamy custard filling surrounded by a crisp sweet pastry shell and covered with fresh fruits', 'img/dessert2.jpg', 20.00, 3, '2020-11-16 03:24:00'),
(12, 'BK003', 'Cookies Kit', 'Simple recipe for crispy and chewy chocolate chip cookies that have golden edges with gooey centers', 'img/diy3.jpg', 25.00, 4, '2020-11-16 03:26:47'),
(13, 'B003', 'Sourdough Loaf', 'A naturally fermented sourdough bread that has a fluffy interior and golden brown crust', 'img/bread3.jpg', 8.00, 1, '2020-11-16 04:04:53'),
(14, 'P002', 'Apple Turnover', 'Golden puff pastry and sweet apple come together in this freshly baked tea-time treat', 'img/pastry2.jpg', 5.00, 2, '2020-11-16 04:21:53'),
(15, 'P003', 'Savoury Puff Pastry', 'Flaky golden pastry filled with meat and flavoured with pickle and thyme, these rolls will satisfy any appetite', 'img/pastry1.jpg', 4.50, 2, '2020-11-16 04:22:06'),
(16, 'D005', 'Bread Pudding', 'Warm dessert loaded with cinnamon, nutmeg, vanilla and topped with a light pomegranate sauce', 'img/dessert3.jpg', 10.00, 3, '2020-11-16 05:15:45'),
(17, 'D006', 'Lime Crepe', 'Soft and airy French crepes filled with the flavour of fresh limes  and topped with fruit jelly', 'img/dessert1.jpg', 25.00, 3, '2020-11-16 05:38:02'),
(18, 'D007', 'Macarons', 'Elegant, delicate, and delicious French macarons are the perfect small, sweet almond meringue cookies', 'img/dessert4.jpg', 2.50, 3, '2020-11-16 05:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `pass` char(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNo` varchar(20) DEFAULT NULL,
  `registerDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `fname`, `lname`, `email`, `pass`, `address`, `phoneNo`, `registerDate`) VALUES
(14, 'Elise', 'Song', 'lise@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2611 Mapleview Drive, 93513 Benton CA', '018-2340909', '2020-11-08 23:34:06'),
(15, 'Asher', 'Franz', 'asher@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2067 Hidden Meadow Drive, Devils Lake, 58301 ND', '019-2836953', '2020-11-12 06:55:37'),
(16, 'Aria', 'Roscente', 'aria@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '15, High Street 20450, Hawthorne Valley', '019-5601313', '2020-11-13 00:46:50'),
(17, 'Ishid', 'Crez', 'ishid@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '013-10298339', '2020-11-13 00:53:25'),
(18, 'Constantine', 'Tan', 'ct@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '2020-11-14 00:58:21'),
(19, 'Mary', 'Lamb', 'mary@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '012-5601313', '2020-11-14 01:00:23'),
(20, 'Jung', 'Yoo', 'jy@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '2020-11-15 01:03:13'),
(21, 'Seol', 'Hong', 'sh@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '2020-11-15 01:04:20'),
(22, 'Claude', 'Kaiser', 'ck@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '2020-11-15 01:11:52'),
(23, 'User', '123', '123@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '019-5601313', '2020-11-16 01:13:37'),
(24, 'Lucas', 'Black', 'lucas@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '016-38516667', '2020-11-16 01:35:05'),
(25, 'Terrance James', 'Wolfstern', 'terry@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '012-5601313', '2020-11-17 04:11:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodID`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
