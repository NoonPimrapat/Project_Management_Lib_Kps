-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2022 at 01:43 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lip_kps`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_request_adjust`
--

CREATE TABLE `project_request_adjust` (
  `pid` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `chk_date` tinyint(1) NOT NULL DEFAULT '0',
  `chk_indicator_goals` tinyint(1) NOT NULL DEFAULT '0',
  `chk_indicator` tinyint(1) NOT NULL DEFAULT '0',
  `chk_budget` tinyint(1) NOT NULL DEFAULT '0',
  `chk_another` tinyint(1) NOT NULL DEFAULT '0',
  `data_new` longtext,
  `data_old` longtext,
  `pro_reason` longtext,
  `request_by` int(8) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_request_adjust`
--

INSERT INTO `project_request_adjust` (`pid`, `project_id`, `chk_date`, `chk_indicator_goals`, `chk_indicator`, `chk_budget`, `chk_another`, `data_new`, `data_old`, `pro_reason`, `request_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 0, 0, 0, 'a:5:{s:8:\"val_time\";s:23:\"2022-03-20 / 2022-03-20\";s:18:\"val_indicator_goal\";s:0:\"\";s:13:\"val_indicator\";s:0:\"\";s:10:\"val_budget\";s:0:\"\";s:11:\"val_another\";s:0:\"\";}', 'a:22:{s:10:\"project_id\";s:1:\"1\";s:12:\"project_name\";s:2:\"22\";s:13:\"project_style\";s:1:\"1\";s:19:\"project_fiscal_year\";s:1:\"0\";s:12:\"routine_plan\";s:2:\"22\";s:13:\"department_id\";s:1:\"9\";s:6:\"reason\";s:2:\"22\";s:9:\"period_op\";s:10:\"2022-03-01\";s:9:\"period_ed\";s:10:\"2022-03-28\";s:6:\"status\";s:1:\"0\";s:7:\"user_id\";s:2:\"54\";s:10:\"perform_id\";s:1:\"0\";s:15:\"compensation_id\";s:1:\"0\";s:7:\"cost_id\";s:1:\"0\";s:8:\"material\";s:1:\"0\";s:6:\"pic_id\";s:1:\"0\";s:17:\"project_sum_total\";s:2:\"30\";s:16:\"assresultfile_id\";s:1:\"0\";s:15:\"restatusfile_id\";s:1:\"0\";s:11:\"submit_date\";s:19:\"2022-03-01 12:24:13\";s:13:\"project_place\";s:2:\"22\";s:16:\"project_strategy\";s:2:\"22\";}', 'ww', 54, '2022-03-20 17:02:23', '2022-03-20 17:02:23'),
(2, 1, 0, 1, 1, 0, 0, 'a:7:{s:8:\"val_time\";s:23:\"2022-03-20 / 2022-03-20\";s:11:\"indicator_1\";s:2:\"aa\";s:11:\"indicator_2\";s:2:\"ss\";s:17:\"indicator_1_value\";s:4:\"1111\";s:17:\"indicator_2_value\";s:4:\"2222\";s:10:\"val_budget\";s:0:\"\";s:11:\"val_another\";s:0:\"\";}', 'a:29:{s:10:\"project_id\";s:1:\"1\";s:12:\"project_name\";s:2:\"22\";s:13:\"project_style\";s:1:\"1\";s:19:\"project_fiscal_year\";s:1:\"0\";s:12:\"routine_plan\";s:2:\"22\";s:13:\"department_id\";s:1:\"9\";s:6:\"reason\";s:2:\"22\";s:9:\"period_op\";s:10:\"2022-03-01\";s:9:\"period_ed\";s:10:\"2022-03-30\";s:6:\"status\";s:1:\"0\";s:7:\"user_id\";s:2:\"54\";s:10:\"perform_id\";s:1:\"0\";s:15:\"compensation_id\";s:1:\"0\";s:7:\"cost_id\";s:1:\"0\";s:8:\"material\";s:1:\"0\";s:6:\"pic_id\";s:1:\"0\";s:17:\"project_sum_total\";s:2:\"30\";s:16:\"assresultfile_id\";s:1:\"0\";s:15:\"restatusfile_id\";s:1:\"0\";s:11:\"submit_date\";s:19:\"2022-03-01 12:24:13\";s:13:\"project_place\";s:2:\"22\";s:16:\"project_strategy\";s:2:\"22\";s:14:\"status_project\";N;s:11:\"indicator_1\";s:1:\"a\";s:17:\"indicator_1_value\";s:2:\"11\";s:11:\"indicator_2\";s:1:\"b\";s:17:\"indicator_2_value\";s:2:\"22\";s:9:\"operation\";N;s:9:\"objective\";N;}', 'ww', 54, '2022-03-20 18:28:50', '2022-03-20 18:28:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_request_adjust`
--
ALTER TABLE `project_request_adjust`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project_request_adjust`
--
ALTER TABLE `project_request_adjust`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
