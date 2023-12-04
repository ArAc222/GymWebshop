-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 12:13 PM
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
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(126, 3, 4, 1),
(127, 3, 10, 1),
(128, 3, 1, 2),
(129, 3, 2, 3),
(130, 3, 5, 7),
(131, 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `time_and_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `username`, `action`, `time_and_date`) VALUES
(1, 'laracic', 'Login', '2023-12-03 19:56:59'),
(2, 'laracic', 'Logout', '2023-12-03 19:57:01'),
(47, 'laracic', 'Login', '2023-12-03 20:04:53'),
(48, 'laracic', 'Logout', '2023-12-03 20:17:18'),
(49, 'laracic', 'Login', '2023-12-03 20:32:19'),
(50, 'laracic', 'Logout', '2023-12-03 21:45:05'),
(51, 'laracic', 'Login', '2023-12-04 10:58:04'),
(52, 'laracic', 'Logout', '2023-12-04 10:58:15'),
(53, 'robi', 'Login', '2023-12-04 11:00:21'),
(54, 'robi', 'Logout', '2023-12-04 11:00:32'),
(55, 'laracic', 'Login', '2023-12-04 11:12:37'),
(58, 'laracic', 'Added product to cart', '2023-12-04 11:37:23'),
(59, 'laracic', 'Logout', '2023-12-04 11:39:12'),
(60, 'laracic', 'Login', '2023-12-04 11:39:53'),
(61, 'laracic', 'Logout', '2023-12-04 11:39:58'),
(62, 'mkovacevic', 'Login', '2023-12-04 11:40:03'),
(63, 'mkovacevic', 'Added product to cart', '2023-12-04 11:40:06'),
(64, 'mkovacevic', 'Logout', '2023-12-04 11:42:12'),
(65, 'doboronjek', 'Register', '2023-12-04 11:42:34'),
(66, 'doboronjek', 'Login', '2023-12-04 11:42:49'),
(67, 'doboronjek', 'Logout', '2023-12-04 11:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`) VALUES
(1, 'Weighted Jump Rope', 'Enhance your cardio with a durable weighted jump rope.', 'Weighted Jump Rope.jpg', 14.99),
(2, 'Adjustable Dumbbells', 'Versatile dumbbell set with adjustable weights for various exercises.', 'Adjustable Dumbbells.jpg', 129.99),
(3, 'Yoga Mat', 'High-quality non-slip yoga mat for comfortable workouts.', 'Yoga Mat.jpg', 24.99),
(4, 'Resistance Bands', 'Set of resistance bands for strength training and flexibility.', 'Resistance Bands.jpg', 19.99),
(5, 'Kettlebell Set', 'Durable kettlebell set for full-body workouts.', 'Kettlebell Set.jpg', 49.99),
(6, 'Foam Roller', 'Relieve muscle tension with a textured foam roller.', 'Foam Roller.jpg', 19.99),
(7, 'Ab Roller', 'Strengthen your core with a sturdy ab roller.', 'Ab Roller .jpg', 29.99),
(8, 'Elliptical Bike', '2-in-1 elliptical and stationary bike for a complete workout.', 'Elliptical Bike.jpg', 299.99),
(9, 'Pull-Up Bar', 'Easily installable pull-up bar for upper body strength training.', 'Pull-Up Bar.jpg', 34.99),
(10, 'Weight Bench', 'Adjustable weight bench for various strength exercises.', 'Weight Bench.jpg', 89.99),
(11, 'Treadmill', 'Foldable treadmill with speed and incline settings.', 'Treadmill.jpg', 599.99),
(12, 'Boxing Gloves', 'Premium boxing gloves for sparring and bag workouts.', 'Boxing Gloves.jpg', 49.99),
(13, 'Pilates Ball', 'Anti-burst pilates ball for core strengthening exercises.', 'Pilates Ball.jpg', 16.99),
(14, 'Medicine Ball Set', 'Durable medicine ball set for dynamic workouts.', 'Medicine Ball Set.jpg', 39.99),
(15, 'Cycling Trainer', 'Indoor cycling trainer for realistic bike workouts.', 'Cycling Trainer.jpg', 199.99),
(16, 'Push-Up Handles', 'Ergonomic push-up handles for wrist comfort.', 'Push-Up Handles.jpg', 14.99),
(17, 'Hexagonal Dumbbells', 'Hex-shaped dumbbells for stability during lifts.', 'Hexagonal Dumbbells.jpg', 49.99),
(18, 'Fitness Tracker', 'Smart fitness tracker to monitor your workouts.', 'Fitness Tracker.jpg', 79.99),
(19, 'Rowing Machine', 'Compact rowing machine for effective cardio.', 'Rowing Machine.jpg', 249.99),
(20, 'Battle Ropes', 'Heavy-duty battle ropes for intense full-body workouts.', 'Battle Ropes.jpg', 54.99),
(21, 'Plyometric Box', 'Sturdy plyometric box for explosive jump training.', 'Plyometric Box.jpg', 79.99),
(22, 'Weighted Vest', 'Adjustable weighted vest for added resistance.', 'Weighted Vest.jpg', 44.99),
(23, 'TRX Suspension Trainer', 'Versatile TRX system for bodyweight exercises.', 'TRX Suspension Trainer.jpg', 69.99),
(24, 'Climbing Rope', 'Durable climbing rope for a challenging upper body workout.', 'Climbing Rope.jpg', 39.99),
(25, 'Gymball Chair', 'Stability ball chair for improved posture.', 'Gymball Chair.jpg', 64.99),
(26, 'Fitness Gloves', 'Breathable fitness gloves for weightlifting.', 'Fitness Gloves.jpg', 19.99),
(27, 'Multi-Station Home Gym', 'Compact home gym with multiple exercise stations.', 'Multi-Station Home Gym.jpg', 699.99),
(28, 'Hula Hoop', 'Weighted hula hoop for a fun and effective workout.', 'Hula Hoop.jpg', 24.99),
(29, 'Power Rack', 'Heavy-duty power rack for safe and efficient lifting.', 'Power Rack.jpg', 349.99),
(30, 'Boxing Reflex Ball', 'Reflex ball for boxing training and hand-eye coordination.', 'Boxing Reflex Ball.jpg', 14.99),
(31, 'Suspension Yoga Swing', 'Yoga swing for aerial yoga and flexibility training.', 'Suspension Yoga Swing.jpg', 89.99),
(32, 'Ankle Weights', 'Adjustable ankle weights for targeted leg workouts.', 'Ankle Weights.jpg', 19.99),
(33, 'Punching Bag', 'Heavy-duty punching bag for boxing and kickboxing.', 'Punching Bag.jpg', 79.99),
(34, 'Spinning Bike', 'Commercial-grade spinning bike for intense cycling sessions.', 'Spinning Bike.jpg', 499.99),
(35, 'Weighted Sandbag', 'Versatile sandbag for functional strength training.', 'Weighted Sandbag.jpg', 34.99),
(36, 'Stability Disc', 'Inflatable stability disc for balance and core exercises.', 'Stability Disc.jpg', 12.99),
(37, 'Mini Stepper', 'Compact mini stepper for low-impact cardiovascular exercise.', 'Mini Stepper.jpg', 69.99),
(38, 'Weightlifting Belt', 'Supportive weightlifting belt for safe heavy lifting.', 'Weightlifting Belt.jpg', 29.99),
(39, 'Massage Foam Roller', 'Vibrating foam roller for muscle recovery and relaxation.', 'Massage Foam Roller.jpg', 79.99),
(40, 'Pilates Reformer', 'Professional pilates reformer for comprehensive workouts.', 'Pilates Reformer.jpg', 899.99),
(41, 'Adjustable Weighted Vest', 'Customizable weighted vest for progressive resistance.', 'Adjustable Weighted Vest.jpg', 54.99),
(42, 'Grip Strengthener', 'Hand grip strengthener for forearm and hand strength.', 'Grip Strengthener.jpg', 9.99),
(43, 'Leg Press Machine', 'Compact leg press machine for lower body strength.', 'Leg Press Machine.jpg', 449.99),
(44, 'Agility Ladder', 'Durable agility ladder for speed and coordination drills.', 'Agility Ladder.jpg', 16.99),
(45, 'Pec Deck Machine', 'Pec deck machine for isolating chest muscles.', 'Pec Deck Machine.jpg', 299.99),
(46, 'Yoga Block Set', 'High-density yoga block set for yoga and stretching.', 'Yoga Block Set.jpg', 19.99),
(47, 'Dip Station', 'Stable dip station for effective tricep and chest exercises.', 'Dip Station.jpg', 89.99),
(48, 'Wrist Roller', 'Wrist roller for forearm and grip strength development.', 'Wrist Roller.jpg', 24.99),
(49, 'Calf Raise Machine', 'Calf raise machine for targeted calf muscle workouts.', 'Calf Raise Machine.jpg', 129.99),
(51, 'PowerFlex Pro Resistance Bands Set', 'Enhance your workout with the versatile PowerFlex Pro Resistance Bands Set.', 'powerflex_pro_bands.jpg', 39.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(2, 'mkovacevic', '$2y$10$mejtLRqNkwYGx6Hkaecx.OK1HyI6uEt5T4hIlBe2FGiDpSDfGdCwS', 'matokova@gmail.com'),
(3, 'laracic', '$2y$10$QHKxJH3x4aPIonfxkC.Y0./vPL.uWTSCqSTK144lUr3gkt9H4T4/.', 'laracic@gmail.com'),
(4, 'robi', '$2y$10$H/X2OJ07UzErXNIHTWWt8uG9NEGDjK7NEQBGlvJfVVazwidKxDO9G', 'robi@gmail.com'),
(5, 'doboronjek', '$2y$10$Kk6JY/iKTIvYb1mSHVa7rOk3oo99cIOL2S4Bf2.E4VNp2MQYF29Gm', 'dboronjek@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_interactions`
--

CREATE TABLE `user_interactions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_interactions`
--

INSERT INTO `user_interactions` (`id`, `name`, `email`, `message`, `submission_date`) VALUES
(8, 'Luka Aracic', 'luka.worthy.shop@gmail.com', 'Hi man, love your work!', '2023-12-03 18:23:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_interactions`
--
ALTER TABLE `user_interactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_interactions`
--
ALTER TABLE `user_interactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
