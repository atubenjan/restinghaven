-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 11:56 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `burial_records`
--

CREATE TABLE `burial_records` (
  `id` int(11) NOT NULL,
  `burial_date` date NOT NULL,
  `grave_number` varchar(50) NOT NULL,
  `deceased_id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `deceased_records`
--

CREATE TABLE `deceased_records` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_death` date NOT NULL,
  `time_of_death` time DEFAULT NULL,
  `cause_of_death` varchar(255) DEFAULT NULL,
  `plot_number` varchar(100) DEFAULT NULL,
  `family_lineage` varchar(255) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `place_of_death` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `files` text DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(10) DEFAULT NULL
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
  `category` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `lot_management`
--

CREATE TABLE `lot_management` (
  `id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `lot_number` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('Available','Occupied','Reserved') NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `user_role` enum('admin','super admin') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `national_id`, `user_role`, `password`, `file`, `created_at`, `updated_at`) VALUES
(1, 'Matsiko Elia', 'admin@gmail.com', 'HGIU540584973H9U', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'http://localhost/lsk/uploads/9460922519656.jpg', '2024-09-04 11:07:30', '2024-09-08 05:02:14'),
(2, 'Mikelson', 'superadmin@gmail.com', '98765467890', 'super admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'http://localhost/lsk/uploads/98765467890-987654325678908765.jpg', '2024-09-05 06:49:12', '2024-09-08 05:01:59'),
(4, 'lydexociju', 'hukoromawa@mailinator.com', 'Duis dolore debitis ', 'admin', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', 'http://localhost/restinghaven//uploads/3744072967026.png', '2024-09-18 17:18:29', '2024-09-18 17:18:29'),
(5, 'soteq', 'kemilowabe@mailinator.com', 'Facere sint aliqua', 'admin', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', 'http://localhost/restinghaven//uploads/6519752700500.png', '2024-09-18 17:22:08', '2024-09-18 17:22:08'),
(6, 'bofuwezex', 'husy@mailinator.com', 'Aut vero deserunt of', 'admin', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', 'http://localhost/restinghaven//uploads/6249891085986.png', '2024-09-18 17:22:53', '2024-09-18 17:22:53');

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
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `burial_records`
--
ALTER TABLE `burial_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deceased_records`
--
ALTER TABLE `deceased_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `lot_management`
--
ALTER TABLE `lot_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_name` (`supplier_name`,`contact_email`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `burial_records`
--
ALTER TABLE `burial_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deceased_records`
--
ALTER TABLE `deceased_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lot_management`
--
ALTER TABLE `lot_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
