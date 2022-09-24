-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 02:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sulibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `accession_details`
--

CREATE TABLE `accession_details` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `accession_number` varchar(25) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accession_details`
--

INSERT INTO `accession_details` (`id`, `book_id`, `accession_number`, `status`) VALUES
(118, 42, '1qsc', 1),
(119, 42, '2qsc', 0),
(120, 42, '3qsc', 0),
(121, 42, '4qsc', 0),
(122, 42, '5qsc', 0),
(123, 42, '6qsc', 0),
(124, 42, '7qsc', 0),
(125, 42, '8qsc', 0),
(126, 42, '9qsc', 0),
(127, 42, '10qsc', 0),
(128, 42, '11qsc', 0),
(129, 42, '12qsc', 0),
(130, 42, '13qsc', 0),
(131, 42, '14qsc', 0),
(132, 42, '15qsc', 0),
(133, 42, '16qsc', 0),
(134, 42, '17qsc', 0),
(135, 42, '18qsc', 0),
(136, 42, '19qsc', 0),
(137, 42, '20qsc', 0),
(138, 42, '21qsc', 0),
(139, 42, '22qsc', 0),
(140, 42, '23qsc', 0),
(141, 42, '24qsc', 0),
(142, 43, '1qaz', 0),
(143, 43, '2qaz', 0),
(144, 43, '3qaz', 0),
(145, 43, '4qaz', 0),
(146, 43, '5qaz', 0),
(147, 43, '6qazz', 0),
(148, 43, '7qaz', 0),
(149, 43, '8qaz', 0),
(150, 43, '9qaz', 0),
(151, 43, '10qaz', 0),
(152, 43, '11qaz', 0),
(153, 43, '12qaz', 0),
(154, 43, '13qaz', 0),
(155, 43, '20qaz', 0),
(156, 43, '14qaz', 0),
(157, 43, '15qaz', 0),
(158, 43, '16qaz', 0),
(159, 43, '17qaz', 0),
(160, 43, '18qaz', 0),
(161, 43, '19qaz', 0);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `edition` varchar(30) DEFAULT NULL,
  `author` varchar(20) NOT NULL,
  `total_stock` int(11) NOT NULL,
  `book_department` varchar(20) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `cover_photo` varchar(100) NOT NULL DEFAULT 'default_book_cover.jpg',
  `book_type` varchar(20) NOT NULL,
  `pdf` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `edition`, `author`, `total_stock`, `book_department`, `description`, `cover_photo`, `book_type`, `pdf`) VALUES
(42, 'python', '1', 'james', 24, 'Computer Science', 'Even bad code can function. But if code isn\'t clean, it can bring a development organization to its knees. Every year, countless hours and significant resources are lost because of poorly written code', 'SUbook8b6a56dc604d058d240607d11fbf00f3.jpg', 'physical book', ''),
(43, 'C- Programming', '3', 'james', 20, 'Computer Science', 'Even bad code can function. But if code isn\'t clean, it can bring a development organization to its knees. Every year, countless hours and significant resources are lost because of poorly written code', 'SUbookba65dd741be39fc7146020c7e998e1cf.jpg', 'physical book', ''),
(44, 'Previos Question -papers', '2', 'su', 0, 'Computer Science', 'Previous year question paper collection', 'SUbook3a9b1d42c49e29de5ab27933a2e257f7.jpg', 'e book', 'SUEbook43147b4e48fac5fd19676b3effb3706f.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `books_owned`
--

CREATE TABLE `books_owned` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_owned`
--

INSERT INTO `books_owned` (`id`, `user_id`, `book_id`) VALUES
(10, 36, 44);

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_number` varchar(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `user_id`, `card_number`, `status`) VALUES
(43, 35, '1234', 0),
(44, 36, '124', 1),
(45, 36, '142', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `card_number` varchar(11) NOT NULL,
  `accession_number` varchar(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `comment` varchar(100) DEFAULT NULL,
  `returned_date` date DEFAULT NULL,
  `fine` int(11) NOT NULL DEFAULT 0,
  `aprove_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `card_number`, `accession_number`, `book_id`, `user_id`, `order_date`, `return_date`, `status`, `comment`, `returned_date`, `fine`, `aprove_time`) VALUES
(52, 112, '124', '1qsc', 42, 36, '2021-11-14', '2021-12-04', 0, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pending_aproval`
--

CREATE TABLE `pending_aproval` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`id`, `username`, `password`, `name`, `email`) VALUES
(1, 'professor', '1234', 'professor', 'professor@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

CREATE TABLE `reserved` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `accession_number` varchar(50) NOT NULL,
  `reservation_date` date NOT NULL,
  `issue_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `course` varchar(20) DEFAULT NULL,
  `regno` varchar(20) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL,
  `exipry_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone`, `email`, `course`, `regno`, `password`, `role`, `exipry_date`, `status`) VALUES
(19, 'librarian', 'su', 1234567890, 'lib@su.com', '', NULL, 'su@1234', 'librarian', NULL, 1),
(35, 'new', 'user', 1234567899, 'user@gmail.com', 'mca', '345', '1234', 'student', '2023-07-07', 0),
(36, 'student', 'student', 2314261728, 'student@gmail.com', 'mca', '123mca23', '1234', 'student', '2023-07-07', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accession_details`
--
ALTER TABLE `accession_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `books_owned`
--
ALTER TABLE `books_owned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_aproval`
--
ALTER TABLE `pending_aproval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserved`
--
ALTER TABLE `reserved`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accession_details`
--
ALTER TABLE `accession_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `books_owned`
--
ALTER TABLE `books_owned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `pending_aproval`
--
ALTER TABLE `pending_aproval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reserved`
--
ALTER TABLE `reserved`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
