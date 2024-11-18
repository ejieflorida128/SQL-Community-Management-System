-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 11:53 AM
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
-- Database: `sqlcommunity_interaction`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `commenter_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `code` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `commenter_id`, `comment`, `code`, `comment_date`) VALUES
(7, 11, 12, 'The query will now return a list of email addresses that appear more than once in the users table, along with the count of how many times each appears.', 'SELECT LOWER(TRIM(email)) AS email, COUNT(*) as occurrences\r\nFROM users\r\nGROUP BY LOWER(TRIM(email))\r\nHAVING COUNT(*) > 1;\r\n', '2024-11-15 02:28:19'),
(8, 11, 13, 'TRIM(LOWER(email)): The LOWER() function converts all emails to lowercase, and TRIM() removes any leading or trailing spaces. This ensures that emails like \"example@example.com \" and \"Example@Example.com\" are treated as the same.', 'SELECT TRIM(LOWER(email)) AS email, COUNT(*) AS occurrences\r\nFROM users\r\nGROUP BY TRIM(LOWER(email))\r\nHAVING COUNT(*) > 1;\r\n', '2024-11-15 08:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `post_by` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `code` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `post_by`, `title`, `description`, `code`, `post_date`, `status`) VALUES
(1, 12, 'How to Improve Query Performance with Large Data Sets in MySQL?', 'I’m working with a MySQL database that contains millions of rows in several tables, and some of my queries are taking a long time to execute. I\'ve tried adding indexes, but the performance is still not satisfactory. I\'m especially struggling with JOIN ope', 'SELECT u.id, u.name, p.order_date, p.amount\r\nFROM users u\r\nJOIN purchases p ON u.id = p.user_id\r\nWHERE u.active = 1\r\nAND p.order_date BETWEEN \'2023-01-01\' AND \'2023-12-31\'\r\nORDER BY p.order_date DESC\r\nLIMIT 100;', '2024-11-14 03:06:44', 'Approved'),
(2, 12, 'How Do I Update Multiple Rows in a Table with Different Values?', 'I\'m trying to update multiple rows in a single table with different values for each row. I have a table called products with columns product_id, price, and quantity. I need to update specific rows based on product_id, each with a unique price and quantity', 'UPDATE products SET price = 19.99, quantity = 50 WHERE product_id = 101;\r\nUPDATE products SET price = 25.50, quantity = 30 WHERE product_id = 102;\r\nUPDATE products SET price = 12.75, quantity = 60 WHERE product_id = 103;\r\n', '2024-11-14 03:07:38', 'Approved'),
(9, 13, 'Error with INNER JOIN on Multiple Tables', 'I\'m trying to join three tables using INNER JOIN to retrieve data, but I keep getting an error related to ambiguous columns. I\'ve checked the column names, but I\'m not sure what\'s causing the issue. Can someone help me understand why this is happening and', 'SELECT orders.order_id, customers.customer_name, products.product_name\r\nFROM orders\r\nINNER JOIN customers ON orders.customer_id = customers.customer_id\r\nINNER JOIN products ON orders.product_id = products.product_id\r\nWHERE orders.order_date > \'2023-01-01\';\r\n', '2024-11-15 00:39:28', 'Approved'),
(10, 12, 'How to Update Records with a Condition in MySQL?', 'I want to update specific records in my employees table based on their department. I only want to change the salary for employees in the \'Sales\' department who have a performance rating above 8. I tried using the UPDATE statement with WHERE, but it’s upda', 'UPDATE employees\r\nSET salary = salary * 1.10\r\nWHERE department = \'Sales\' AND performance_rating > 8;\r\n', '2024-11-15 00:41:07', 'Approved'),
(11, 13, 'Using GROUP BY and COUNT to Find Duplicate Records', 'I\'m trying to find duplicate email addresses in my users table. I want to see a list of email addresses that appear more than once, along with the count of how many times each appears. However, my query seems to be giving incorrect results. Can someone he', 'SELECT email, COUNT(*) as occurrences\r\nFROM users\r\nGROUP BY email\r\nHAVING COUNT(*) > 1;\r\n', '2024-11-15 00:42:00', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `reply_by` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `reply_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `post_id`, `comment_id`, `reply_by`, `message`, `reply_date`) VALUES
(2, 11, 7, 12, 'second comment', '2024-11-15 08:35:39'),
(3, 11, 7, 13, 'third comment', '2024-11-15 08:37:18'),
(4, 11, 8, 13, 'fourth comment', '2024-11-15 09:12:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
