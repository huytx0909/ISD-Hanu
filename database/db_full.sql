-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 04:41 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `announcer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `book_title` varchar(30) NOT NULL,
  `author_name` varchar(30) NOT NULL,
  `date_publication` date DEFAULT NULL,
  `prize` varchar(255) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `max_expired_day` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `book_title`, `author_name`, `date_publication`, `prize`, `status`, `max_expired_day`, `id_category`, `id_image`) VALUES
(17, 'how to code', 'Hung beo', '2019-09-29', '1000000', 'available', 12, 5, 20),
(19, 'steak is good', 'Gordon Ramsay', '2019-10-01', '200000', 'available', 8, 1, 31);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'science'),
(2, 'literature'),
(5, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `description`) VALUES
(4, 'human resource', 'manage all employees				 	\r\n 				  				 	\r\n 				 '),
(6, 'Accountance', ' 				 	\r\n Accounting profit				 ');

-- --------------------------------------------------------

--
-- Table structure for table `employee_award`
--

CREATE TABLE `employee_award` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `award_title` varchar(255) DEFAULT NULL,
  `gift_item` varchar(255) DEFAULT NULL,
  `award_amount` varchar(255) DEFAULT NULL,
  `award_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_award`
--

INSERT INTO `employee_award` (`id`, `id_user`, `award_title`, `gift_item`, `award_amount`, `award_date`) VALUES
(3, 10, 'best staff of the month (May 2019)', 'Car', '10000000', '2019-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL,
  `event_name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `event_name`, `description`, `start_date`, `end_date`) VALUES
(4, 'New Year eve', 'clebrate new year eve', '2019-11-01', '2019-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `url`) VALUES
(6, 'iphoneX.jpg'),
(18, 'bump-collaboration-colleagues-1068523.jpg'),
(19, 'bump-collaboration-colleagues-1068523.jpg'),
(20, 'cardboard-communication-connecting-1246743.jpg'),
(21, 'bump-collaboration-colleagues-1068523.jpg'),
(22, 'bump-collaboration-colleagues-1068523.jpg'),
(23, 'camera-coffee-composition-1509428.jpg'),
(24, 'cardboard-communication-connecting-1246743.jpg'),
(25, 'cardboard-communication-connecting-1246743.jpg'),
(26, 'camera-coffee-composition-1509428.jpg'),
(27, 'cardboard-communication-connecting-1246743.jpg'),
(28, ''),
(29, 'táº£i xuá»‘ng.png'),
(30, 'Linemanager-5b62e38b46e0fb005028923a.jpg'),
(31, 'beneath_the_moon_and_the_stars.jpg'),
(32, 'Linemanager-5b62e38b46e0fb005028923a.jpg'),
(33, 'Linemanager-5b62e38b46e0fb005028923a.jpg'),
(34, 'Linemanager-5b62e38b46e0fb005028923a.jpg'),
(35, 'presenter2.png');

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `personal_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`id`, `id_user`, `leave_type`, `status`, `application_date`, `start_date`, `end_date`, `personal_reason`) VALUES
(4, 8, 'Vacation', 'accepted', '2019-10-09', '2019-11-02', '2019-11-22', 'vacation for 2 weeks');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_book` int(11) DEFAULT NULL,
  `placeOrder_date` date DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `id_user`, `id_book`, `placeOrder_date`, `type`, `expired_date`, `status`) VALUES
(48, 10, 19, '2019-10-31', 'borrow', '2019-11-08', 'completed'),
(49, 10, 19, '2019-10-31', 'borrow', '2019-11-08', 'completed'),
(50, 10, 19, '2019-10-31', 'borrow', '2019-11-08', 'completed'),
(51, 10, 19, '2019-10-31', 'borrow', '2019-11-08', 'completed'),
(52, 10, 19, '2019-10-31', 'borrow', '2019-11-08', 'completed'),
(53, 10, 19, '2019-10-31', 'borrow', '2019-11-08', 'completed'),
(54, 10, 19, '2019-10-31', 'borrow', '2019-11-08', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'HR employee', 'HR employee could use every function in Management website 				 	\r\n 				 '),
(2, 'Head of Department', 'Head of a department');

-- --------------------------------------------------------

--
-- Table structure for table `salary_deduction`
--

CREATE TABLE `salary_deduction` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `deduction_amount` varchar(255) DEFAULT NULL,
  `deduction_reason` varchar(255) DEFAULT NULL,
  `deduction_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary_deduction`
--

INSERT INTO `salary_deduction` (`id`, `id_user`, `deduction_amount`, `deduction_reason`, `deduction_date`) VALUES
(1, 10, '10000', 'fat and stupid', '2019-10-19'),
(5, 10, '1000', 'fat', '2019-10-11'),
(6, 10, '5000', 'fat', '2019-10-12'),
(7, 10, '6000', 'fat', '2019-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `task_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `id_team`, `task_name`, `description`, `deadline`, `status`) VALUES
(9, 9, 'month salary report ', 'account award amount for employees in May 2019', '2019-11-21', 'completed'),
(10, 1, 'staff attitude report', 'manage staff attitude report and produce a report', '2019-11-13', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `description`, `id_department`) VALUES
(1, 'HR1', 'salary calculation				 	\r\n 				  				 	\r\n 				  				 	\r\n 				  				 	\r\n 				  				 	\r\n 				 ', 4),
(9, 'ACC1', 'accounting', 6),
(11, 'HR2', 'human resource', 4);

-- --------------------------------------------------------

--
-- Table structure for table `trainee`
--

CREATE TABLE `trainee` (
  `id` int(11) NOT NULL,
  `id_training` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainee`
--

INSERT INTO `trainee` (`id`, `id_training`, `id_user`) VALUES
(23, 6, 10),
(24, 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `training_name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `id_trainer` int(11) DEFAULT NULL,
  `max_trainees` int(11) DEFAULT NULL,
  `number_trainees` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `training_name`, `description`, `start_date`, `end_date`, `id_trainer`, `max_trainees`, `number_trainees`) VALUES
(6, 'JAVA', 'basic JAVA', '2019-11-01', '2019-12-12', 10, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `gross_salary` varchar(255) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  `id_team` int(11) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `id_image` int(11) DEFAULT NULL,
  `net_salary` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `phone`, `address`, `gross_salary`, `id_role`, `date_created`, `id_department`, `id_team`, `fullName`, `level`, `DOB`, `gender`, `id_image`, `net_salary`) VALUES
(8, 'lam123', '25d55ad283aa400af464c76d713c07', 'baolamvu98@gmail.com', '0123456789', 'co nhue', '1000000', 1, '2019-10-08', 6, 9, 'bao lam', 'level 1', NULL, NULL, NULL, '870000'),
(9, 'lamVB', '25d55ad283aa400af464c76d713c07', 'baolamvu98@gmail.com', '0123456789', 'co nhue', '3000000', 1, '2019-10-09', 4, 1, 'Bao Lam', 'level 1', '1998-10-18', 'male', NULL, '2610000'),
(10, 'lamVB1', '25d55ad283aa400af464c76d713c07ad', 'baolamvu98@gmail.com', '0123456789', 'co nhue HANOI', '3000000', 1, '2019-10-10', 4, 1, 'Vu Bao Lam', 'level 1', '1998-10-19', 'male', 30, '2588000'),
(11, 'lam12', '25d55ad283aa400af464c76d713c07ad', 'baolamvu98@gmail.com', '0123456789', 'co nhue', '3000000', 1, '2019-10-14', 4, 9, 'Vu Bao Lam', 'level 1', '1998-10-17', 'male', 18, '2610000'),
(12, 'Hai123', '8f9e11c8a31910336e65278ab982b104', 'baolamvu98@gmail.com', '0123456789', 'co nhue', '30000000', 2, '2019-11-05', 4, 11, 'Do Manh Hai', 'level 2', '1998-12-12', 'male', 30, NULL),
(13, 'huy123', '25d55ad283aa400af464c76d713c07ad', 'baolamvu98@gmail.com', '0123456789', 'co nhue', '30000000', 1, '2019-11-05', 4, 11, 'Tran Huy', 'level 2', '1998-12-12', 'male', 35, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_BookCategory` (`id_category`),
  ADD KEY `FK_BookImage` (`id_image`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_award`
--
ALTER TABLE `employee_award`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserAward` (`id_user`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserLeaveApp` (`id_user`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_OrderUser` (`id_user`),
  ADD KEY `FK_OrderBook` (`id_book`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_deduction`
--
ALTER TABLE `salary_deduction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserSalary` (`id_user`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TeamTask` (`id_team`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TeamDepartment` (`id_department`);

--
-- Indexes for table `trainee`
--
ALTER TABLE `trainee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_training` (`id_training`),
  ADD KEY `FK_trainingUser` (`id_user`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_trainer` (`id_trainer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserRole` (`id_role`),
  ADD KEY `FK_UserDepartment` (`id_department`),
  ADD KEY `FK_UserTeam` (`id_team`),
  ADD KEY `FK_UserImage` (`id_image`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_award`
--
ALTER TABLE `employee_award`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary_deduction`
--
ALTER TABLE `salary_deduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trainee`
--
ALTER TABLE `trainee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_BookCategory` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BookImage` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_award`
--
ALTER TABLE `employee_award`
  ADD CONSTRAINT `FK_UserAward` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD CONSTRAINT `FK_UserLeaveApp` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_OrderBook` FOREIGN KEY (`id_book`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_OrderUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_deduction`
--
ALTER TABLE `salary_deduction`
  ADD CONSTRAINT `FK_UserSalary` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_TeamTask` FOREIGN KEY (`id_team`) REFERENCES `team` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `FK_TeamDepartment` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainee`
--
ALTER TABLE `trainee`
  ADD CONSTRAINT `FK_training` FOREIGN KEY (`id_training`) REFERENCES `training` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_trainingUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `FK_trainer` FOREIGN KEY (`id_trainer`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_UserDepartment` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserImage` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserRole` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserTeam` FOREIGN KEY (`id_team`) REFERENCES `team` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
