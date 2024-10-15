-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2024 at 07:50 AM
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
(1, 'Don', '2024-10-10', '21:46:00', 'wanna meet up', 'you and me'),
(2, 'Moses', '2024-10-10', '21:01:00', 'Meeting in progress', 'John Moses'),
(3, 'coder', '2024-10-10', '21:05:00', 'to code ko', 'coded'),
(4, 'Kenya Uganda', '2024-10-10', '21:19:00', 'Touring', 'Move around and chop money');

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

--
-- Dumping data for table `burial_records`
--

INSERT INTO `burial_records` (`id`, `burial_date`, `grave_number`, `deceased_id`, `location`, `remarks`, `created_at`) VALUES
(1, '2024-10-10', 'G-123', 22, 'Section A, Row 5', 'www', '2024-10-10 20:46:32');

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
(1, 'Customer 1', 'cus@gmail.com', '98744999', 'hhhhhh', '2024-10-10 19:37:27');

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

--
-- Dumping data for table `deceased_records`
--

INSERT INTO `deceased_records` (`id`, `name`, `date_of_birth`, `date_of_death`, `time_of_death`, `cause_of_death`, `plot_number`, `family_lineage`, `spouse`, `origin`, `place_of_birth`, `place_of_death`, `nationality`, `occupation`, `remarks`, `files`, `date_added`, `gender`) VALUES
(1, 'Not Holy', '2024-10-10', '2013-01-28', '21:30:00', 'malaria', 'number 1', 'black', 'Trial', 'not coder', 'Non known', 'Here and there', 'Uganda', 'Peasant', 'He was awesome', NULL, '2024-10-10 18:31:45', NULL);

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

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `description`, `amount`, `category`, `remarks`, `created_at`, `updated_at`) VALUES
(1, '2024-10-10', 'expense for now', 345.00, 'that one', 'Hello now', '2024-10-10 18:45:56', '2024-10-10 18:45:56');

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
(1, 'G-123', 'Section A, Row 5', '222ad', '234', 'assd', 'ddd');

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
(1, 'Product', 'code', 'category', 'product well', 6, 'cm', 7, '1', 9.00, 54.00, 'Active', '2024-10-10');

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

--
-- Dumping data for table `lot_management`
--

INSERT INTO `lot_management` (`id`, `section`, `lot_number`, `location`, `status`, `date_added`) VALUES
(1, 'section 1', '222ad', 'Section A, Row 5', 'Reserved', '2024-10-10 18:26:56');

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
(1, 'Supplier horror', 'Mr. Jonz', 'j@gmail.com', '8989898', 'Home', 'Active', '2024-10-10'),
(2, 'supplier 1', 'Mr. Jonz', 'j@gmail.com', '8989898', 'helo there', 'Active', '2024-10-10'),
(3, 'Ricky', 'Monte', 'richy@gmail.com', '3333333333', 'Montes Home', 'Active', '2024-10-10');

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
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `description`, `status`, `priority`, `assigned_to`, `due_date`, `created_at`) VALUES
(1, 'd', 'Pending', 'Low', 'dd', '2024-10-10', '2024-10-10 19:07:41'),
(2, 'sss', 'Pending', 'Low', 'sss', '2024-10-10', '2024-10-10 19:08:58'),
(3, 'Timed now', 'In Progress', 'Medium', 'don\'t', '2024-10-10', '2024-10-10 19:19:36');

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
-- Indexes for table `grave_mapping`
--
ALTER TABLE `grave_mapping`
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
-- Indexes for table `sales`
--
ALTER TABLE `sales`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `burial_records`
--
ALTER TABLE `burial_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deceased_records`
--
ALTER TABLE `deceased_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grave_mapping`
--
ALTER TABLE `grave_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lot_management`
--
ALTER TABLE `lot_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
