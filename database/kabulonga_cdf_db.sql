-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 03, 2023 at 10:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kabulonga_cdf_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(5) NOT NULL,
  `category` varchar(50) NOT NULL,
  `pro_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `pro_id`) VALUES
(1, 'Construction', 2),
(10, 'Education', 6),
(12, 'Schools', 7),
(14, 'Shopping', 7);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(5) NOT NULL,
  `feature` varchar(50) NOT NULL,
  `progress` varchar(5) NOT NULL,
  `pro_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature`, `progress`, `pro_id`) VALUES
(9, 'Foundation', '43', 5),
(10, 'Roof', '32', 7),
(12, 'Painting', '34', 5);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(15) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `title`, `description`, `image`, `date`) VALUES
(5, 'Mizu Eco-Care invited by Latitude 15 Hotel and affected Kabulonga area residents to visit gold refinery project', 'Mizu Eco-Care was invited by Latitude 15 Hotel and affected Kabulonga area residents to visit the proposed site for offices and a gold refinery along Leopards Hill road in Kabulonga, Lusaka. The visit was lead by the Minister of Justice Hon. Mulambo Haimbe who is the area Member of Parliament and also a resident in the area. Also present was the area ward councillor Mr. Kosamu Tembo.\n\nOur take away from:\n\nThere is a reason why areas are designated as residential, commercial and industrial areas. There are certain commercial and industrial scale activities that just cant be conducted in a residential areas. There are implications and consequences arising from the pollutants released into the air, water and land. There is also the issue of noise pollution for the residents near by.\n\nIt is our hope that the commercial/industrial component of the site (as evidenced by the standing infrastructure on the site) will be transferred to another appropriate location.\n\nAs a nation that that is on a path to attaining a Green Economy, development must respect certain environmental and social boundaries. It can not occur without respect for nature. The times we live in require that we attain development in an environmentally sustainable manner always.              ', 'image.jpg', '2023-07-15 19:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `role` enum('Admin','Member') NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `Password`, `role`, `date`) VALUES
(4, 'Geoffrey Zimba', 'admin@example.com\r\n', '+260 97 6499595', 'e3afed0047b08059d0fada10f400c1e5', 'Admin', '2023-07-05 22:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
