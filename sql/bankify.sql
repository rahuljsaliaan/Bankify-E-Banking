SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users` (
  `user_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `interest_rate` decimal(10,2) NOT NULL DEFAULT 1.20,
  `currency` varchar(4) NOT NULL DEFAULT 'USD',
  `locale` varchar(6) NOT NULL DEFAULT 'en-us'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `movements` (
  `user_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
   FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `interest_rate`, `currency`, `locale`) VALUES
(1, 'Rahul', 'J', 'rahuljsaliaan@gmail.com', 'rahul@123', 1.20, 'INR', 'en-IN');

INSERT INTO `movements` (`user_id`, `amount`, `date_time`) VALUES
(1, 50000.00, '2023-05-16 22:35:37'),
(1, 400.00, '2023-05-16 22:36:19'),
(1, 500.00, '2023-05-16 22:49:21'),
(1, -5000.00, '2023-05-16 22:52:25'),
(1, -200.55, '2023-05-16 22:52:57'),
(1, 100.00, '2023-05-16 23:40:53'),
(1, 100.00, '2023-05-17 10:46:24'),
(1, 300.00, '2023-05-17 13:50:42'),
(1, 400.00, '2023-05-17 14:59:47');