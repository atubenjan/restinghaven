-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 02:12 PM
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
-- Database: `resting_haven`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reason` text NOT NULL,
  `assigned_to` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `fullname`, `date`, `time`, `reason`, `assigned_to`) VALUES
(22, 'Uma Wiley', '1999-12-14', '22:48:00', 'Sed inventore adipis', 'teruxa');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `branch_manager` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `location`, `branch_manager`, `contact`, `date_created`) VALUES
(13, 'Yardley Buck', 'Sit proident sint', 'Quidem elit aperiam', 'Et velit rerum quos', '2024-09-25 18:54:24'),
(14, 'Xavier Houston', 'Irure soluta culpa', 'Ab lorem excepteur m', 'Nulla voluptatem At', '2024-10-17 10:08:39'),
(15, 'Baker Briggs', 'Aspernatur ea deseru', '11', 'Est eos a sit occae', '2024-10-17 11:46:38'),
(16, 'Quemby Bender', 'Accusantium dolore u', '11', 'Qui nostrum ut est m', '2024-10-17 11:46:49'),
(17, 'Dawn Carter', 'Magnam sit iste et', '11', 'Optio rerum vitae n', '2024-10-18 19:32:15'),
(18, 'Lila Langley', 'Saepe nemo sit verit', '11', 'Ipsum perferendis et', '2024-10-18 19:33:13'),
(19, 'Carlos Cortez', 'Qui omnis fugit non', '11', 'Id eiusmod est duis', '2024-10-18 19:34:24'),
(20, 'Priscilla Payne', 'Delectus sapiente v', '11', 'Delectus facere und', '2024-10-18 19:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `burial_records`
--

CREATE TABLE `burial_records` (
  `burial_id` int(11) NOT NULL,
  `burial_date` date NOT NULL,
  `grave_number` varchar(50) NOT NULL,
  `deceased_id` varchar(50) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `cemetery_id` varchar(50) NOT NULL,
  `plot_id` varchar(50) NOT NULL,
  `time_of_burial` time NOT NULL,
  `burial_type` enum('Cremation','Traditional Burial','Others') NOT NULL,
  `officiant` varchar(100) DEFAULT NULL,
  `funeral_service_details` text DEFAULT NULL,
  `burial_status` enum('Scheduled','Completed') NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `burial_records`
--

INSERT INTO `burial_records` (`burial_id`, `burial_date`, `grave_number`, `deceased_id`, `location`, `cemetery_id`, `plot_id`, `time_of_burial`, `burial_type`, `officiant`, `funeral_service_details`, `burial_status`, `remarks`, `created_at`) VALUES
(4, '2007-06-15', '850', 'RHC002', NULL, 'Aut nemo ea autem en', 'Molestias sed culpa ', '16:12:00', 'Cremation', 'Officia Nam a laboru', 'Voluptatum in volupt', 'Completed', 'Laborum Deserunt mo', '2024-10-12 23:42:43'),
(5, '1972-11-13', '230', '2', NULL, 'Repellendus Porro a', 'Deleniti temporibus ', '13:59:00', '', 'Minus elit in quo d', 'Est sit accusamus ma', '', 'Nisi vitae molestiae', '2024-10-17 08:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `remarks`, `created_at`) VALUES
(14, 'Shannon Garrison', 'wosi@mailinator.com', '+1 (882) 703-8104', 'Sunt fugit volupta', '2024-10-17 09:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `deceased`
--

CREATE TABLE `deceased` (
  `deceased_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_death` date NOT NULL,
  `place_of_death` time DEFAULT NULL,
  `cause_of_death` varchar(255) DEFAULT NULL,
  `plot_number` varchar(255) DEFAULT NULL,
  `family_lineage` varchar(255) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `age_at_death` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `place_of_death` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deceased_records`
--

CREATE TABLE `deceased_records` (
  `deceased_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_death` date NOT NULL,
  `place_of_death` time DEFAULT NULL,
  `cause_of_death` varchar(255) DEFAULT NULL,
  `plot_number` varchar(255) DEFAULT NULL,
  `family_lineage` varchar(255) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `age_at_death` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `place_of_death` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `files` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `description`, `amount`, `category`, `remarks`, `created_at`, `updated_at`) VALUES
(2, '2020-11-18', 'ytyttyt', 72.00, 'Nostrum cumque ea la', 'Et magni et nostrum ', '2024-10-17 09:01:55', '2024-10-17 09:02:08'),
(3, '1992-05-18', 'Corrupti aut adipis', 53.00, 'Mollit architecto et', 'Eaque officiis nostr', '2024-10-17 09:24:03', '2024-10-17 09:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `grave_management`
--

CREATE TABLE `grave_management` (
  `cemetery_id` int(11) NOT NULL,
  `plot_number` varchar(50) NOT NULL,
  `size` enum('single','double','family') NOT NULL,
  `section_name` int(11) NOT NULL,
  `availability_status` enum('available','occupied','reserved') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `coordinates` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grave_management`
--

INSERT INTO `grave_management` (`cemetery_id`, `plot_number`, `size`, `section_name`, `availability_status`, `price`, `coordinates`, `created_at`, `updated_at`) VALUES
(21, '597', 'family', 0, 'available', 850.00, 'Deleniti est soluta', '2024-10-18 19:20:01', '2024-10-18 19:20:01'),
(32, '716', 'double', 0, 'available', 202.00, 'Quibusdam aliquip si', '2024-10-18 19:13:12', '2024-10-18 19:13:12'),
(57, '782', 'single', 0, 'occupied', 543.00, 'Harum eum aut tempor', '2024-10-17 06:57:21', '2024-10-17 06:57:21'),
(71, '445', 'single', 0, 'occupied', 2.00, 'Esse est iusto atqu', '2024-10-17 06:56:32', '2024-10-17 06:56:32'),
(76, '984', 'single', 0, 'available', 206.00, 'Cupiditate laudantiu', '2024-10-17 09:26:43', '2024-10-17 09:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `grave_mapping`
--

CREATE TABLE `grave_mapping` (
  `id` int(11) NOT NULL,
  `grave_number` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `lot_number` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grave_mapping`
--

INSERT INTO `grave_mapping` (`id`, `grave_number`, `location`, `lot_number`, `size`, `status`, `remarks`) VALUES
(1, 'G-123', 'Section A, Row 5', '222ad', '234', 'assd', 'ddd'),
(2, '309', 'Animi pariatur Nih', '680', 'Est aspernatur aute', 'Aut labore fugiat ne', 'Fugiat veniam debit'),
(3, '319', 'Illo laboriosam err', '336', 'Ratione proident qu', 'Neque at eiusmod bea', 'Facilis placeat iur'),
(4, '774', 'Eum sed est dolor vo', '93', 'Rerum natus adipisic', 'Doloremque nisi tota', 'Eu delectus fugit ');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `unit_of_measurement` varchar(50) DEFAULT NULL,
  `reorder_level` int(11) DEFAULT 0,
  `supplier_id` varchar(255) DEFAULT NULL,
  `cost_per_unit` decimal(10,2) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_name`, `product_code`, `category`, `description`, `quantity`, `unit_of_measurement`, `reorder_level`, `supplier_id`, `cost_per_unit`, `total_cost`, `status`, `date_added`) VALUES
(1, 'Product', 'code', 'category', 'product well', 6, 'cm', 7, '1', 9.00, 54.00, 'Active', '2024-10-10'),
(2, 'Anne Mcguire', 'Sint non in volupta', 'Ut quia sed aut repe', 'In voluptatem repudi', 13, 'Omnis cillum nihil r', 28, '2', 61.00, 88.00, 'Active', '1972-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `role` varchar(50) NOT NULL,
  `login_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `username`, `ip_address`, `role`, `login_time`) VALUES
(1111, 'ccd', 'ss', 'ss', '2024-10-12 02:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `plots`
--

CREATE TABLE `plots` (
  `id` int(11) NOT NULL,
  `plot_location` varchar(100) NOT NULL,
  `plot_number` varchar(50) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plots`
--

INSERT INTO `plots` (`id`, `plot_location`, `plot_number`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'Location A', 'PN-001', 'Close to main road', '2024-10-15 16:46:20', '2024-10-15 16:46:20'),
(2, 'Location B', 'PN-002', 'Has a water well', '2024-10-15 16:46:20', '2024-10-15 16:46:20'),
(3, 'Location C', 'PN-003', 'Corner plot, good view', '2024-10-15 16:46:20', '2024-10-15 16:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(4,0) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_name`, `quantity`, `price`, `date`) VALUES
(1, 'Product', 23, 23, '2024-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('Active','Not Active') NOT NULL DEFAULT 'Active',
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `contact_person`, `contact_email`, `contact_phone`, `address`, `status`, `date_added`) VALUES
(5, 'Calvin Washington', 'Quis minus soluta re', 'gelem@mailinator.com', '+1 (112) 957-1505', 'Id sed rerum quos re', 'Active', '2006-06-18'),
(6, 'Caldwell Powell', 'Nesciunt officia do', 'syne@mailinator.com', '+1 (883) 421-4859', 'Nulla exercitationem', '', '2008-07-11'),
(7, 'Ivor Carpenter', 'Velit ea praesentium', 'welygy@mailinator.com', '+1 (671) 971-5796', 'Alias consequatur N', 'Active', '2011-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `user_role` enum('Admin','SuperAdmin','Manager','FuneralDirector','CemeteryStaff','Accounting','Maintenance') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `national_id`, `user_role`, `password`, `photo`, `created_at`, `updated_at`) VALUES
(4, 'RHC', 'superadmin@gmail.com', '77565786987698', 'SuperAdmin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'http://localhost/restinghaven//uploads/3610805171332', '2024-10-12 23:00:54', '2024-10-12 23:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

CREATE TABLE `work_orders` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Pending','In Progress','Completed') NOT NULL,
  `priority` enum('Low','Medium','High') NOT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `description`, `status`, `priority`, `assigned_to`, `due_date`, `created_at`) VALUES
(9, 'Eius illum suscipit', 'In Progress', 'High', 'Accounting', '2021-03-27', '2024-10-17 10:35:48'),
(10, 'Soluta qui in mollit', 'Pending', 'Low', 'Admin', '1971-10-15', '2024-10-17 10:35:59'),
(11, 'Ratione ad eum expli', 'Completed', 'Low', 'Accounting', '2013-04-04', '2024-10-17 11:13:01'),
(12, 'Nihil vel duis volup', 'In Progress', 'Low', 'SuperAdmin', '1978-03-30', '2024-10-21 09:32:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `fullname` (`fullname`),
  ADD KEY `date` (`date`),
  ADD KEY `assigned_to` (`assigned_to`),
  ADD KEY `fullname_idx` (`fullname`),
  ADD KEY `date_idx` (`date`),
  ADD KEY `assigned_to_idx` (`assigned_to`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `burial_records`
--
ALTER TABLE `burial_records`
  ADD PRIMARY KEY (`burial_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`),
  ADD KEY `phone_idx` (`phone`);

--
-- Indexes for table `deceased`
--
ALTER TABLE `deceased`
  ADD PRIMARY KEY (`deceased_id`);

--
-- Indexes for table `deceased_records`
--
ALTER TABLE `deceased_records`
  ADD PRIMARY KEY (`deceased_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grave_management`
--
ALTER TABLE grave_management
ADD CONSTRAINT unique_cemetery_id UNIQUE (cemetery_id);

-- 
-- 
ALTER TABLE grave_management
ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY FIRST;

--
-- Indexes for table `grave_mapping`
--
ALTER TABLE `grave_mapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_idx` (`location`),
  ADD KEY `status_idx` (`status`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD KEY `category_idx` (`category`),
  ADD KEY `supplier_id_idx` (`supplier_id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plots`
--
ALTER TABLE `plots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_name_idx` (`product_name`),
  ADD KEY `date_idx` (`date`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_name` (`supplier_name`,`contact_email`),
  ADD KEY `contact_person_idx` (`contact_person`),
  ADD KEY `status_idx` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_idx` (`status`),
  ADD KEY `priority_idx` (`priority`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `burial_records`
--
ALTER TABLE `burial_records`
  MODIFY `burial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `deceased`
--
ALTER TABLE `deceased`
  MODIFY `deceased_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deceased_records`
--
ALTER TABLE `deceased_records`
  MODIFY `deceased_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grave_mapping`
--
ALTER TABLE `grave_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1112;

--
-- AUTO_INCREMENT for table `plots`
--
ALTER TABLE `plots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
