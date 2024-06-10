-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 03:49 PM
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
-- Database: `gymwebshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(3, 4, 25, 1),
(7, 6, 25, 1),
(8, 6, 26, 1),
(9, 6, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(22, 'Adjustable Dumbbells', 'Set of 2 adjustable dumbbells', 49.99, 'slike/Adjustable Dumbbells.jpg'),
(24, 'Agility Ladder', 'Speed agility training ladder', 14.99, 'slike/Agility Ladder.jpg'),
(25, 'Ankle Weights', 'Pair of adjustable ankle weights', 19.99, 'slike/Ankle Weights.jpg'),
(26, 'Battle Ropes', 'Heavy-duty battle ropes', 29.99, 'slike/Battle Ropes.jpg'),
(27, 'Boxing Gloves', 'Pair of professional boxing gloves', 34.99, 'slike/Boxing Gloves.jpg'),
(28, 'Boxing Reflex Ball', 'Training reflex ball set', 12.99, 'slike/Boxing Reflex Ball.jpg'),
(29, 'Calf Raise Machine', 'Calf raise exercise machine', 199.99, 'slike/Calf Raise Machine.jpg'),
(30, 'Climbing Rope', 'Gym climbing rope', 24.99, 'slike/Climbing Rope.jpg'),
(31, 'Cycling Trainer', 'Indoor cycling trainer', 299.99, 'slike/Cycling Trainer.jpg'),
(32, 'Dip Station', 'Sturdy dip station', 89.99, 'slike/Dip Station.jpg'),
(33, 'Elliptical Bike', 'Elliptical exercise bike', 499.99, 'slike/Elliptical Bike.jpg'),
(34, 'Fitness Gloves', 'Pair of fitness gloves', 14.99, 'slike/Fitness Gloves.jpg'),
(35, 'Fitness Tracker', 'Wearable fitness tracker', 39.99, 'slike/Fitness Tracker.jpg'),
(36, 'Foam Roller', 'High-density foam roller', 22.99, 'slike/Foam Roller.jpg'),
(37, 'Grip Strengthener', 'Adjustable grip strength trainer', 9.99, 'slike/Grip Strengthener.jpg'),
(38, 'Gymball Chair', 'Balance ball chair', 59.99, 'slike/Gymball Chair.jpg'),
(39, 'Hexagonal Dumbbells', 'Set of 2 hexagonal dumbbells', 29.99, 'slike/Hexagonal Dumbbells.jpg'),
(40, 'Hula Hoop', 'Weighted hula hoop', 19.99, 'slike/Hula Hoop.jpg'),
(41, 'Kettlebell Set', 'Set of 3 kettlebells', 59.99, 'slike/Kettlebell Set.jpg'),
(42, 'Leg Press Machine', 'Leg press exercise machine', 399.99, 'slike/Leg Press Machine.jpg'),
(43, 'Massage Foam Roller', 'Textured foam roller', 19.99, 'slike/Massage Foam Roller.jpg'),
(44, 'Medicine Ball Set', 'Set of 3 medicine balls', 49.99, 'slike/Medicine Ball Set.jpg'),
(45, 'Mini Stepper', 'Compact mini stepper', 69.99, 'slike/Mini Stepper.jpg'),
(46, 'Multi-Station Home Gym', 'All-in-one home gym', 699.99, 'slike/Multi-Station Home Gym.jpg'),
(47, 'Pec Deck Machine', 'Pec deck exercise machine', 299.99, 'slike/Pec Deck Machine.jpg'),
(48, 'Pilates Ball', 'Stability exercise ball', 14.99, 'slike/Pilates Ball.jpg'),
(49, 'Pilates Reformer', 'Pilates reformer machine', 799.99, 'slike/Pilates Reformer.jpg'),
(50, 'Plyometric Box', 'Plyometric jump box', 79.99, 'slike/Plyometric Box.jpg'),
(51, 'Power Rack', 'Heavy-duty power rack', 399.99, 'slike/Power Rack.jpg'),
(52, 'Powerflex Pro Bands', 'Set of resistance bands', 34.99, 'slike/Powerflex Pro Bands.jpg'),
(53, 'Pull-Up Bar', 'Doorway pull-up bar', 29.99, 'slike/Pull-Up Bar.jpg'),
(54, 'Punching Bag', 'Heavy-duty punching bag', 99.99, 'slike/Punching Bag.jpg'),
(55, 'Push-Up Handles', 'Pair of push-up handles', 19.99, 'slike/Push-Up Handles.jpg'),
(56, 'Resistance Bands', 'Set of 5 resistance bands', 14.99, 'slike/Resistance Bands.jpg'),
(57, 'Rowing Machine', 'Magnetic rowing machine', 299.99, 'slike/Rowing Machine.jpg'),
(58, 'Spinning Bike', 'Indoor spinning bike', 399.99, 'slike/Spinning Bike.jpg'),
(59, 'Stability Disc', 'Balance stability disc', 24.99, 'slike/Stability Disc.jpg'),
(60, 'Suspension Yoga Swing', 'Aerial yoga swing', 69.99, 'slike/Suspension Yoga Swing.jpg'),
(61, 'TRX Suspension Trainer', 'Bodyweight suspension trainer', 129.99, 'slike/TRX Suspension Trainer.jpg'),
(62, 'Weight Bench', 'Adjustable weight bench', 119.99, 'slike/Weight Bench.jpg'),
(63, 'Weighted Jump Rope', 'Weighted speed jump rope', 14.99, 'slike/Weighted Jump Rope.jpg'),
(64, 'Weighted Sandbag', 'Adjustable weighted sandbag', 49.99, 'slike/Weighted Sandbag.jpg'),
(65, 'Weightlifting Belt', 'Leather weightlifting belt', 29.99, 'slike/Weightlifting Belt.jpg'),
(66, 'Wrist Roller', 'Forearm wrist roller', 14.99, 'slike/Wrist Roller.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(2, 'luxyz', '$2y$10$6yjATlwIMbeh6yvC0qJmVuTJFuL29t54d72losc3hVK8FGclTm.ay', 'luxyz@gmail.com', 'user'),
(3, 'l.aracic', '$2y$10$DgncqVzpYHEBzz4phXJt2OZNB/ssCG7vZV9Fg8ihPoVngJ4qaciuu', 'aracic@gmail.com', 'user'),
(4, 'macak123', '$2y$10$pIL1cQyNrlNFJ0.x2sRhtOkyiXhvJ3.maFcpKbUFZkKGr2u1iCtf2', 'macak@gmail.com', 'user'),
(5, 'admin', '$2y$10$z1uNfYWTprWQ8cDZM4suOu7bqhVx6yzFrqujEscH3cuwRSOmxVizi', 'admin@gmail.com', 'user'),
(6, 'admincek', '$2y$10$0WNgzn7m/BextJDIEcujW.XDGLIbPdi6Q7FXsieoO7KKsvOyVznHS', 'admincek@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
