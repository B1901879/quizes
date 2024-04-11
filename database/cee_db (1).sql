-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2024 at 03:21 PM
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
-- Database: `cee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_acc`
--

CREATE TABLE `admin_acc` (
  `admin_id` int(11) NOT NULL,
  `admin_user` varchar(1000) NOT NULL,
  `admin_pass` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_acc`
--

INSERT INTO `admin_acc` (`admin_id`, `admin_user`, `admin_pass`) VALUES
(1, 'admin@username', 'admin@password');

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `cou_id` int(11) NOT NULL,
  `cou_name` varchar(1000) NOT NULL,
  `cou_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`cou_id`, `cou_name`, `cou_created`) VALUES
(81, 'TEST', '2024-03-29 15:00:51'),
(82, 'TESTING', '2024-03-29 15:04:52'),
(83, 'TESTING1', '2024-03-29 15:06:58'),
(84, 'SEJARAH YEAR2', '2024-04-06 10:29:49'),
(85, 'SADSD', '2024-04-06 11:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `examinee_tbl`
--

CREATE TABLE `examinee_tbl` (
  `exmne_id` int(11) NOT NULL,
  `exmne_fullname` varchar(1000) NOT NULL,
  `exmne_course` varchar(1000) NOT NULL,
  `exmne_gender` varchar(1000) NOT NULL,
  `exmne_birthdate` varchar(1000) NOT NULL,
  `exmne_year_level` varchar(1000) NOT NULL,
  `exmne_email` varchar(1000) NOT NULL,
  `exmne_password` varchar(1000) NOT NULL,
  `exmne_status` varchar(1000) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `examinee_tbl`
--

INSERT INTO `examinee_tbl` (`exmne_id`, `exmne_fullname`, `exmne_course`, `exmne_gender`, `exmne_birthdate`, `exmne_year_level`, `exmne_email`, `exmne_password`, `exmne_status`) VALUES
(9, 'zc', '83', 'male', '2024-03-30', 'year2', 'shablade1@hotmail.com', '123456789', 'active'),
(10, 'zi yen', '83', 'female', '2024-03-19', 'year2', 'ziyen@gmail.com', 'ziyen', 'active'),
(11, 'keat', '83', 'male', '2024-04-17', 'second year', 'keatrong@gmail.com', '123456789', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `exam_answers`
--

CREATE TABLE `exam_answers` (
  `exans_id` int(11) NOT NULL,
  `axmne_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `exans_answer` varchar(1000) NOT NULL,
  `exans_status` varchar(1000) NOT NULL DEFAULT 'new',
  `atmpAns` int(11) NOT NULL,
  `exans_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_answers`
--

INSERT INTO `exam_answers` (`exans_id`, `axmne_id`, `exam_id`, `quest_id`, `exans_answer`, `exans_status`, `atmpAns`, `exans_created`) VALUES
(455, 9, 26, 46, 'a', 'new', 0, '2024-04-05 20:07:36'),
(456, 9, 26, 45, 'a', 'new', 2, '2024-04-05 19:02:50'),
(457, 9, 26, 42, 'a', 'new', 2, '2024-04-05 19:02:50'),
(458, 9, 26, 44, 'a', 'new', 2, '2024-04-05 19:02:50'),
(459, 9, 26, 47, 'a', 'new', 2, '2024-04-05 19:02:50'),
(460, 9, 26, 42, 'd', 'new', 3, '2024-04-05 19:15:35'),
(461, 9, 26, 47, 'd', 'new', 3, '2024-04-05 19:15:35'),
(462, 9, 26, 45, 'd', 'new', 3, '2024-04-05 19:15:35'),
(463, 9, 26, 46, 'd', 'new', 3, '2024-04-05 19:15:35'),
(464, 9, 26, 44, 'd', 'new', 3, '2024-04-05 19:15:35'),
(465, 9, 26, 44, 'c', 'new', 4, '2024-04-05 19:23:46'),
(466, 9, 26, 46, 'c', 'new', 4, '2024-04-05 19:23:46'),
(467, 9, 26, 45, 'c', 'new', 4, '2024-04-05 19:23:46'),
(468, 9, 26, 47, 'c', 'new', 4, '2024-04-05 19:23:46'),
(469, 9, 26, 42, 'c', 'new', 4, '2024-04-05 19:23:46'),
(470, 9, 26, 47, 'a', 'new', 5, '2024-04-05 19:34:30'),
(471, 9, 26, 42, 'c', 'new', 5, '2024-04-05 19:34:30'),
(472, 9, 26, 45, 'b', 'new', 5, '2024-04-05 19:34:30'),
(473, 9, 26, 44, 'd', 'new', 5, '2024-04-05 19:34:30'),
(474, 9, 26, 46, 'a', 'new', 5, '2024-04-05 19:34:31'),
(475, 9, 26, 45, 'c', 'new', 6, '2024-04-05 19:40:17'),
(476, 9, 26, 46, 'c', 'new', 6, '2024-04-05 19:40:17'),
(477, 9, 26, 44, 'c', 'new', 6, '2024-04-05 19:40:17'),
(478, 9, 26, 47, 'c', 'new', 6, '2024-04-05 19:40:17'),
(479, 9, 26, 42, 'c', 'new', 6, '2024-04-05 19:40:17'),
(480, 9, 26, 45, 'd', 'new', 7, '2024-04-05 19:42:40'),
(481, 9, 26, 47, 'd', 'new', 7, '2024-04-05 19:42:40'),
(482, 9, 26, 42, 'd', 'new', 7, '2024-04-05 19:42:40'),
(483, 9, 26, 44, 'd', 'new', 7, '2024-04-05 19:42:40'),
(484, 9, 26, 46, 'd', 'new', 7, '2024-04-05 19:42:40'),
(485, 9, 26, 49, 'a', 'new', 7, '2024-04-05 19:58:49'),
(486, 9, 26, 51, 'a', 'new', 7, '2024-04-05 19:58:50'),
(487, 9, 26, 50, 'a', 'new', 7, '2024-04-05 19:58:50'),
(488, 9, 26, 52, 'a', 'new', 7, '2024-04-05 19:58:50'),
(489, 9, 26, 48, 'a', 'new', 7, '2024-04-05 19:58:50'),
(490, 9, 26, 51, 'a', 'new', 7, '2024-04-05 19:59:50'),
(491, 9, 26, 49, 'b', 'new', 7, '2024-04-05 19:59:50'),
(492, 9, 26, 48, 'a', 'new', 7, '2024-04-05 19:59:50'),
(493, 9, 26, 52, 'd', 'new', 7, '2024-04-05 19:59:50'),
(494, 9, 26, 50, 'a', 'new', 7, '2024-04-05 19:59:50'),
(495, 9, 26, 49, 'a', 'new', 7, '2024-04-05 20:04:29'),
(496, 9, 26, 48, 'a', 'new', 7, '2024-04-05 20:04:29'),
(497, 9, 26, 51, 'a', 'new', 7, '2024-04-05 20:04:29'),
(498, 9, 26, 50, 'a', 'new', 7, '2024-04-05 20:04:29'),
(499, 9, 26, 52, 'a', 'new', 7, '2024-04-05 20:04:29'),
(500, 9, 26, 51, 'a', 'new', 8, '2024-04-05 20:07:55'),
(501, 9, 26, 48, 'a', 'new', 8, '2024-04-05 20:07:55'),
(502, 9, 26, 49, 'a', 'new', 8, '2024-04-05 20:07:55'),
(503, 9, 26, 52, 'a', 'new', 8, '2024-04-05 20:07:55'),
(504, 9, 26, 50, 'a', 'new', 8, '2024-04-05 20:07:55'),
(505, 9, 26, 51, 'a', 'new', 9, '2024-04-06 11:38:45'),
(506, 9, 26, 50, 'a', 'new', 9, '2024-04-06 11:38:45'),
(507, 9, 26, 49, 'a', 'new', 9, '2024-04-06 11:38:45'),
(508, 9, 26, 48, 'a', 'new', 9, '2024-04-06 11:38:45'),
(509, 9, 26, 52, 'a', 'new', 9, '2024-04-06 11:38:45'),
(510, 9, 26, 48, 'a', 'new', 10, '2024-04-06 11:51:56'),
(511, 9, 26, 50, 'a', 'new', 10, '2024-04-06 11:51:56'),
(512, 9, 26, 49, 'a', 'new', 10, '2024-04-06 11:51:56'),
(513, 9, 26, 51, 'a', 'new', 10, '2024-04-06 11:51:57'),
(514, 9, 26, 52, 'a', 'new', 10, '2024-04-06 11:51:57'),
(515, 9, 26, 48, 'a', 'new', 11, '2024-04-06 14:05:58'),
(516, 9, 26, 49, 'a', 'new', 11, '2024-04-06 14:05:58'),
(517, 9, 26, 51, 'a', 'new', 11, '2024-04-06 14:05:58'),
(518, 9, 26, 50, 'a', 'new', 11, '2024-04-06 14:05:58'),
(519, 9, 26, 52, 'a', 'new', 11, '2024-04-06 14:05:58'),
(520, 9, 26, 49, 'a', 'new', 12, '2024-04-06 14:07:21'),
(521, 9, 26, 48, 'a', 'new', 12, '2024-04-06 14:07:21'),
(522, 9, 26, 50, 'a', 'new', 12, '2024-04-06 14:07:21'),
(523, 9, 26, 52, 'a', 'new', 12, '2024-04-06 14:07:21'),
(524, 9, 26, 51, 'a', 'new', 12, '2024-04-06 14:07:21'),
(525, 9, 26, 49, 'a', 'new', 13, '2024-04-06 14:24:16'),
(526, 9, 26, 48, 'b', 'new', 13, '2024-04-06 14:24:16'),
(527, 9, 26, 52, 'c', 'new', 13, '2024-04-06 14:24:16'),
(528, 9, 26, 50, 'd', 'new', 13, '2024-04-06 14:24:16'),
(529, 9, 26, 51, 'a', 'new', 13, '2024-04-06 14:24:16'),
(530, 9, 26, 50, 'a', 'new', 14, '2024-04-06 14:42:16'),
(531, 9, 26, 51, 'b', 'new', 14, '2024-04-06 14:42:16'),
(532, 9, 26, 52, 'c', 'new', 14, '2024-04-06 14:42:16'),
(533, 9, 26, 48, 'c', 'new', 14, '2024-04-06 14:42:16'),
(534, 9, 26, 49, 'c', 'new', 14, '2024-04-06 14:42:16'),
(535, 9, 26, 50, 'a', 'new', 15, '2024-04-06 14:42:21'),
(536, 9, 26, 51, 'b', 'new', 15, '2024-04-06 14:42:21'),
(537, 9, 26, 52, 'c', 'new', 15, '2024-04-06 14:42:21'),
(538, 9, 26, 48, 'c', 'new', 15, '2024-04-06 14:42:21'),
(539, 9, 26, 49, 'c', 'new', 15, '2024-04-06 14:42:21'),
(540, 9, 26, 50, 'a', 'new', 16, '2024-04-06 14:42:36'),
(541, 9, 26, 51, 'b', 'new', 16, '2024-04-06 14:42:36'),
(542, 9, 26, 52, 'c', 'new', 16, '2024-04-06 14:42:36'),
(543, 9, 26, 48, 'c', 'new', 16, '2024-04-06 14:42:36'),
(544, 9, 26, 49, 'c', 'new', 16, '2024-04-06 14:42:36'),
(545, 9, 26, 50, 'a', 'new', 17, '2024-04-06 14:44:11'),
(546, 9, 26, 51, 'b', 'new', 17, '2024-04-06 14:44:11'),
(547, 9, 26, 52, 'c', 'new', 17, '2024-04-06 14:44:11'),
(548, 9, 26, 48, 'c', 'new', 17, '2024-04-06 14:44:11'),
(549, 9, 26, 49, 'c', 'new', 17, '2024-04-06 14:44:11'),
(550, 9, 26, 50, 'a', 'new', 18, '2024-04-06 14:44:39'),
(551, 9, 26, 51, 'b', 'new', 18, '2024-04-06 14:44:39'),
(552, 9, 26, 52, 'c', 'new', 18, '2024-04-06 14:44:39'),
(553, 9, 26, 48, 'c', 'new', 18, '2024-04-06 14:44:39'),
(554, 9, 26, 49, 'c', 'new', 18, '2024-04-06 14:44:39'),
(555, 9, 26, 50, 'a', 'new', 19, '2024-04-06 14:45:05'),
(556, 9, 26, 51, 'b', 'new', 19, '2024-04-06 14:45:05'),
(557, 9, 26, 52, 'c', 'new', 19, '2024-04-06 14:45:05'),
(558, 9, 26, 48, 'c', 'new', 19, '2024-04-06 14:45:05'),
(559, 9, 26, 49, 'c', 'new', 19, '2024-04-06 14:45:05'),
(560, 9, 26, 52, 'a', 'new', 20, '2024-04-06 14:48:13'),
(561, 9, 26, 51, 'c', 'new', 20, '2024-04-06 14:48:13'),
(562, 9, 26, 50, 'c', 'new', 20, '2024-04-06 14:48:14'),
(563, 9, 26, 49, 'c', 'new', 20, '2024-04-06 14:48:14'),
(564, 9, 26, 48, 'd', 'new', 20, '2024-04-06 14:48:14'),
(565, 9, 26, 48, 'd', 'new', 21, '2024-04-06 15:19:06'),
(566, 9, 26, 50, 'd', 'new', 21, '2024-04-06 15:19:06'),
(567, 9, 26, 49, 'd', 'new', 21, '2024-04-06 15:19:06'),
(568, 9, 26, 52, 'd', 'new', 21, '2024-04-06 15:19:06'),
(569, 9, 26, 51, 'd', 'new', 21, '2024-04-06 15:19:06'),
(570, 9, 26, 50, 'a', 'new', 22, '2024-04-06 15:32:31'),
(571, 9, 26, 51, 'a', 'new', 22, '2024-04-06 15:32:31'),
(572, 9, 26, 52, 'a', 'new', 22, '2024-04-06 15:32:31'),
(573, 9, 26, 48, 'a', 'new', 22, '2024-04-06 15:32:32'),
(574, 9, 26, 49, 'a', 'new', 22, '2024-04-06 15:32:32'),
(575, 9, 26, 52, 'b', 'new', 23, '2024-04-06 15:42:14'),
(576, 9, 26, 49, 'b', 'new', 23, '2024-04-06 15:42:14'),
(577, 9, 26, 51, 'b', 'new', 23, '2024-04-06 15:42:14'),
(578, 9, 26, 48, 'b', 'new', 23, '2024-04-06 15:42:14'),
(579, 9, 26, 50, 'c', 'new', 23, '2024-04-06 15:42:14'),
(580, 9, 26, 49, 'b', 'new', 24, '2024-04-06 15:42:46'),
(581, 9, 26, 51, 'a', 'new', 24, '2024-04-06 15:42:46'),
(582, 9, 26, 48, 'a', 'new', 24, '2024-04-06 15:42:46'),
(583, 9, 26, 52, 'a', 'new', 24, '2024-04-06 15:42:46'),
(584, 9, 26, 50, 'b', 'new', 24, '2024-04-06 15:42:46'),
(585, 9, 26, 50, 'c', 'new', 25, '2024-04-06 16:22:58'),
(586, 9, 26, 49, 'b', 'new', 25, '2024-04-06 16:22:58'),
(587, 9, 26, 48, 'a', 'new', 25, '2024-04-06 16:22:58'),
(588, 9, 26, 51, 'a', 'new', 25, '2024-04-06 16:22:58'),
(589, 9, 26, 52, 'c', 'new', 25, '2024-04-06 16:22:58'),
(590, 9, 26, 49, 'a', 'new', 26, '2024-04-06 16:40:38'),
(591, 9, 26, 51, 'a', 'new', 26, '2024-04-06 16:40:38'),
(592, 9, 26, 50, 'a', 'new', 26, '2024-04-06 16:40:38'),
(593, 9, 26, 52, 'a', 'new', 26, '2024-04-06 16:40:38'),
(594, 9, 26, 48, 'a', 'new', 26, '2024-04-06 16:40:38'),
(595, 9, 26, 51, 'a', 'new', 27, '2024-04-06 16:47:17'),
(596, 9, 26, 48, 'a', 'new', 27, '2024-04-06 16:47:17'),
(597, 9, 26, 52, 'd', 'new', 27, '2024-04-06 16:47:17'),
(598, 9, 26, 49, 'b', 'new', 27, '2024-04-06 16:47:17'),
(599, 9, 26, 50, 'c', 'new', 27, '2024-04-06 16:47:17'),
(600, 9, 26, 49, 'c', 'new', 28, '2024-04-06 16:50:12'),
(601, 9, 26, 50, 'c', 'new', 28, '2024-04-06 16:50:12'),
(602, 9, 26, 51, 'c', 'new', 28, '2024-04-06 16:50:12'),
(603, 9, 26, 52, 'c', 'new', 28, '2024-04-06 16:50:12'),
(604, 9, 26, 48, 'c', 'new', 28, '2024-04-06 16:50:12'),
(605, 9, 26, 51, 'a', 'new', 29, '2024-04-06 17:15:33'),
(606, 9, 26, 52, 'a', 'new', 29, '2024-04-06 17:15:33'),
(607, 9, 26, 49, 'b', 'new', 29, '2024-04-06 17:15:33'),
(608, 9, 26, 48, 'a', 'new', 29, '2024-04-06 17:15:33'),
(609, 9, 26, 50, 'c', 'new', 29, '2024-04-06 17:15:33'),
(610, 9, 26, 52, 'a', 'new', 30, '2024-04-06 17:18:47'),
(611, 9, 26, 49, 'a', 'new', 30, '2024-04-06 17:18:47'),
(612, 9, 26, 48, 'a', 'new', 30, '2024-04-06 17:18:47'),
(613, 9, 26, 51, 'a', 'new', 30, '2024-04-06 17:18:47'),
(614, 9, 26, 50, 'a', 'new', 30, '2024-04-06 17:18:47'),
(615, 9, 26, 48, 'a', 'new', 31, '2024-04-06 17:20:22'),
(616, 9, 26, 51, 'a', 'new', 31, '2024-04-06 17:20:22'),
(617, 9, 26, 49, 'a', 'new', 31, '2024-04-06 17:20:22'),
(618, 9, 26, 52, 'a', 'new', 31, '2024-04-06 17:20:22'),
(619, 9, 26, 50, 'c', 'new', 31, '2024-04-06 17:20:22'),
(620, 10, 26, 48, 'a', 'new', 1, '2024-04-07 12:41:46'),
(621, 10, 26, 49, 'a', 'new', 1, '2024-04-07 12:41:46'),
(622, 10, 26, 52, 'a', 'new', 1, '2024-04-07 12:41:46'),
(623, 10, 26, 50, 'a', 'new', 1, '2024-04-07 12:41:46'),
(624, 10, 26, 51, 'a', 'new', 1, '2024-04-07 12:41:46'),
(625, 10, 26, 48, 'b', 'new', 2, '2024-04-07 12:42:52'),
(626, 10, 26, 51, 'a', 'new', 2, '2024-04-07 12:42:52'),
(627, 10, 26, 49, 'a', 'new', 2, '2024-04-07 12:42:52'),
(628, 10, 26, 52, 'd', 'new', 2, '2024-04-07 12:42:52'),
(629, 10, 26, 50, 'c', 'new', 2, '2024-04-07 12:42:52'),
(630, 10, 26, 51, 'a', 'new', 3, '2024-04-07 12:43:22'),
(631, 10, 26, 52, 'd', 'new', 3, '2024-04-07 12:43:22'),
(632, 10, 26, 50, 'c', 'new', 3, '2024-04-07 12:43:22'),
(633, 10, 26, 48, 'd', 'new', 3, '2024-04-07 12:43:22'),
(634, 10, 26, 49, 'a', 'new', 3, '2024-04-07 12:43:22'),
(635, 10, 26, 50, 'a', 'new', 4, '2024-04-07 14:07:49'),
(636, 10, 26, 52, 'a', 'new', 4, '2024-04-07 14:07:49'),
(637, 10, 26, 49, 'a', 'new', 4, '2024-04-07 14:07:49'),
(638, 10, 26, 48, 'a', 'new', 4, '2024-04-07 14:07:49'),
(639, 10, 26, 51, 'a', 'new', 4, '2024-04-07 14:07:49'),
(640, 10, 26, 49, 'a', 'new', 5, '2024-04-07 14:11:07'),
(641, 10, 26, 52, 'a', 'new', 5, '2024-04-07 14:11:07'),
(642, 10, 26, 48, 'a', 'new', 5, '2024-04-07 14:11:07'),
(643, 10, 26, 50, 'a', 'new', 5, '2024-04-07 14:11:07'),
(644, 10, 26, 51, 'a', 'new', 5, '2024-04-07 14:11:07'),
(645, 10, 26, 51, 'a', 'new', 6, '2024-04-07 14:26:32'),
(646, 10, 26, 52, 'a', 'new', 6, '2024-04-07 14:26:32'),
(647, 10, 26, 48, 'a', 'new', 6, '2024-04-07 14:26:32'),
(648, 10, 26, 50, 'a', 'new', 6, '2024-04-07 14:26:32'),
(649, 10, 26, 49, 'a', 'new', 6, '2024-04-07 14:26:32'),
(650, 10, 26, 52, 'a', 'new', 7, '2024-04-07 15:34:08'),
(651, 10, 26, 49, 'a', 'new', 7, '2024-04-07 15:34:08'),
(652, 10, 26, 48, 'a', 'new', 7, '2024-04-07 15:34:08'),
(653, 10, 26, 51, 'a', 'new', 7, '2024-04-07 15:34:08'),
(654, 10, 26, 50, 'a', 'new', 7, '2024-04-07 15:34:08'),
(655, 11, 26, 50, 'a', 'new', 1, '2024-04-07 15:35:30'),
(656, 11, 26, 51, 'a', 'new', 1, '2024-04-07 15:35:30'),
(657, 11, 26, 52, 'a', 'new', 1, '2024-04-07 15:35:30'),
(658, 11, 26, 49, 'a', 'new', 1, '2024-04-07 15:35:30'),
(659, 11, 26, 48, 'a', 'new', 1, '2024-04-07 15:35:30'),
(660, 11, 26, 50, 'a', 'new', 2, '2024-04-07 16:15:38'),
(661, 11, 26, 48, 'a', 'new', 2, '2024-04-07 16:15:38'),
(662, 11, 26, 49, 'a', 'new', 2, '2024-04-07 16:15:38'),
(663, 11, 26, 52, 'a', 'new', 2, '2024-04-07 16:15:38'),
(664, 11, 26, 51, 'a', 'new', 2, '2024-04-07 16:15:38'),
(665, 10, 26, 48, 'a', 'new', 8, '2024-04-07 16:21:52'),
(666, 10, 26, 50, 'a', 'new', 8, '2024-04-07 16:21:52'),
(667, 10, 26, 49, 'a', 'new', 8, '2024-04-07 16:21:52'),
(668, 10, 26, 52, 'a', 'new', 8, '2024-04-07 16:21:52'),
(669, 10, 26, 51, 'a', 'new', 8, '2024-04-07 16:21:52'),
(670, 10, 26, 48, 'a', 'new', 9, '2024-04-07 16:21:58'),
(671, 10, 26, 50, 'a', 'new', 9, '2024-04-07 16:21:58'),
(672, 10, 26, 49, 'a', 'new', 9, '2024-04-07 16:21:58'),
(673, 10, 26, 52, 'a', 'new', 9, '2024-04-07 16:21:58'),
(674, 10, 26, 51, 'a', 'new', 9, '2024-04-07 16:21:58'),
(675, 10, 26, 50, 'a', 'new', 10, '2024-04-07 16:29:10'),
(676, 10, 26, 51, 'a', 'new', 10, '2024-04-07 16:29:10'),
(677, 10, 26, 48, 'a', 'new', 10, '2024-04-07 16:29:10'),
(678, 10, 26, 49, 'a', 'new', 10, '2024-04-07 16:29:10'),
(679, 10, 26, 52, 'a', 'new', 10, '2024-04-07 16:29:10'),
(680, 10, 26, 52, 'a', 'new', 11, '2024-04-08 00:49:24'),
(681, 10, 26, 50, 'a', 'new', 11, '2024-04-08 00:49:24'),
(682, 10, 26, 48, 'a', 'new', 11, '2024-04-08 00:49:24'),
(683, 10, 26, 51, 'a', 'new', 11, '2024-04-08 00:49:24'),
(684, 10, 26, 49, 'a', 'new', 11, '2024-04-08 00:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `exam_attempt`
--

CREATE TABLE `exam_attempt` (
  `examat_id` int(11) NOT NULL,
  `exmne_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `atmpAns` int(11) NOT NULL,
  `examat_status` varchar(1000) NOT NULL DEFAULT 'used'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_attempt`
--

INSERT INTO `exam_attempt` (`examat_id`, `exmne_id`, `exam_id`, `atmpAns`, `examat_status`) VALUES
(59, 9, 26, 0, 'used'),
(86, 9, 26, 2, 'used'),
(87, 9, 26, 3, 'used'),
(88, 9, 26, 4, 'used'),
(89, 9, 26, 5, 'used'),
(90, 9, 26, 6, 'used'),
(94, 9, 26, 7, 'used'),
(95, 9, 26, 8, 'used'),
(96, 9, 26, 9, 'used'),
(97, 9, 26, 10, 'used'),
(98, 9, 26, 11, 'used'),
(99, 9, 26, 12, 'used'),
(100, 9, 26, 13, 'used'),
(101, 9, 26, 14, 'used'),
(102, 9, 26, 15, 'used'),
(103, 9, 26, 16, 'used'),
(104, 9, 26, 17, 'used'),
(105, 9, 26, 18, 'used'),
(106, 9, 26, 19, 'used'),
(107, 9, 26, 20, 'used'),
(108, 9, 26, 21, 'used'),
(109, 9, 26, 22, 'used'),
(110, 9, 26, 23, 'used'),
(111, 9, 26, 24, 'used'),
(112, 9, 26, 25, 'used'),
(113, 9, 26, 26, 'used'),
(114, 9, 26, 27, 'used'),
(115, 9, 26, 28, 'used'),
(116, 9, 26, 29, 'used'),
(117, 9, 26, 30, 'used'),
(118, 9, 26, 31, 'used'),
(119, 10, 26, 1, 'used'),
(120, 10, 26, 2, 'used'),
(121, 10, 26, 3, 'used'),
(122, 10, 26, 4, 'used'),
(123, 10, 26, 5, 'used'),
(124, 10, 26, 6, 'used'),
(125, 10, 26, 7, 'used'),
(126, 11, 26, 1, 'used'),
(127, 11, 26, 2, 'used'),
(128, 10, 26, 8, 'used'),
(129, 10, 26, 9, 'used'),
(130, 10, 26, 10, 'used'),
(131, 10, 26, 11, 'used');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question_tbl`
--

CREATE TABLE `exam_question_tbl` (
  `eqt_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `exam_question` varchar(1000) NOT NULL,
  `exam_ch1` varchar(1000) NOT NULL,
  `exam_ch2` varchar(1000) NOT NULL,
  `exam_ch3` varchar(1000) NOT NULL,
  `exam_ch4` varchar(1000) NOT NULL,
  `exam_answer` varchar(1000) NOT NULL,
  `exam_status` varchar(1000) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_question_tbl`
--

INSERT INTO `exam_question_tbl` (`eqt_id`, `exam_id`, `exam_question`, `exam_ch1`, `exam_ch2`, `exam_ch3`, `exam_ch4`, `exam_answer`, `exam_status`) VALUES
(48, 26, 'adrean', 'a', 'b', 'c', 'd', 'a', 'active'),
(49, 26, 'zhichung', 'a', 'b', 'c', 'd', 'b', 'active'),
(50, 26, 'celese', 'a', 'b', 'c', 'd', 'c', 'active'),
(51, 26, 'weijian', 'a', 'b', 'c', 'd', 'a', 'active'),
(52, 26, 'jieyu', 'a', 'b', 'c', 'd', 'd', 'active'),
(53, 28, 'Apakah yang diwarisi oleh Kesultanan Melayu Melaka daripada kerajaan Srivijaya?', 'Ciri-ciri negara bangsa', 'Upacara pertabalan raja', 'Penggunaan gelaran sultan', 'Sistem pemerintahan demokrasi', 'Ciri-ciri negara bangsa', 'active'),
(54, 28, 'Maklumat berikut berkaitan Undang-undang Laut Melaka. Nakhoda perlu diberikan keutamaan untuk berniaga selama 4 hari', 'Dianggap wakil kerajaan', 'Dikhuatiri berlaku penipuan', 'Diibaratkan raja dalam pelayaran', 'Dihormati pedagang di pelabuhan', 'Diibaratkan raja dalam pelayaran', 'active'),
(55, 28, 'Revolusi berikut berlaku di Barat. • Revolusi Keagungan di England • Revolusi Perancis Apakah persamaan yang terdapat antara revolusi tersebut?', 'Pemulauan proses pilihan raya', 'Pemberontakan golongan hamba', 'Pengurangan kuasa panglima tentera', 'Penentangan terhadap pemerintahan beraja', 'Penentangan terhadap pemerintahan beraja', 'active'),
(56, 28, 'Jadual berikut berkaitan tindakan pemerintah Thailand. Pemerintah Raja Mongkut Raja Chulalongkorn Tindakan Memodenkan negara dan mengamalkan dasar terbuka Mengapakah tindakan tersebut diambil oleh baginda berdua?', 'Menyaingi kuasa besar', 'Memantapkan kuasa pemerintah', 'Mengekalkan kedaulatan negara', 'Memodenkan sistem pendidikan', 'Mengekalkan kedaulatan negara', 'active'),
(57, 28, 'Maklumat berikut berkaitan nombor rujukan dalam \"Cerita Tekukur”. Tekukur nombor 1874 • Tekukur nombor 1909.Apakah yang dilambangkan dengan nombor tersebut?', 'Lokasi kawasan jajahan kuasa Barat', 'Tarikh negeri Melayu dikuasai British', 'Bilangan anggota pasukan keselamatan', 'Jumlah mangsa korban dalam peperangan', 'Tarikh negeri Melayu dikuasai British', 'active'),
(58, 28, 'Novel berikut merupakan karya Ahmad Murad Nasaruddin. Nyawa di-hujong Pedang Apakah mesej yang terkandung di dalam novel tersebut?', 'Ketidakadilan sistem perundangan', 'Kemunduran rakyat tempatan', 'Kekejaman tentera Jepun', 'Kelemahan pihak Britain', 'Ketidakadilan sistem perundangan', 'active'),
(59, 28, 'Rajah berikut berkaitan usaha British mengubah status Tanah Melayu. Negeri Naungan ke Bagaimanakah usaha tersebut berjaya dilakukan?', 'Melaksanakan dasar dekolonisasi Menggubal perlembagaan merdeka', 'Negeri Jajahan', 'Memperkenalkan Malayan Union', 'Membentuk Persekutuan Tanah Melayu', 'Memperkenalkan Malayan Union', 'active'),
(60, 28, 'Pekeliling berikut dikeluarkan oleh British pada Disember 1946 di Sarawak. Pekeliling no. 9/1946 Mengapakah pekeliling tersebut dikeluarkan?', 'Memberi amaran kepada parti politik', 'Mengawal pelantikan kakitangan kerajaan', 'Mengingatkan tentang kebebasan bersuara', 'Melarang penyertaan gerakan antipenyerahan', 'Melarang penyertaan gerakan antipenyerahan', 'active'),
(61, 28, 'Mengapakah Parti Kebangsaan Melayu Malaya (PKMM) tidak berpuas hati dengan British?', 'Dianggap golongan berhaluan kiri', 'Tidak diberi peluang dalam pentadbiran', 'Diketepikan daripada Jawatankuasa Kerja', 'Tanah Melayu disatukan dengan Singapura', 'Diketepikan daripada Jawatankuasa Kerja', 'active'),
(62, 28, 'Majlis Mesyuarat Persekutuan ditubuhkan bagi membantu Pesuruhjaya Tinggi British di Tanah Melayu. Manakah antara berikut merupakan bidang kuasa majlis tersebut?', 'Hal ehwal luar dan Ketenteraman awam', 'Hal ehwal luar dan Syarat kewarganegaraan', 'Ketenteraman awam dan Pelantikan pemerintah', 'Pelantikan pemerintah dan Syarat kewarganegaraan', 'Hal ehwal luar dan Ketenteraman awam', 'active'),
(63, 28, 'Mengapakah Parti Komunis Indonesia (PKI) berusaha menyebarkan pengaruh mereka di Tanah Melayu?', 'Kegagalan menguasai Pulau Jawa', 'Penubuhan Parti Komunis Nanyang', 'Keinginan menguasai bahan mentah', 'Peluasan pengaruh Parti Komunis China', 'Kegagalan menguasai Pulau Jawa', 'active'),
(64, 28, 'Mengapakah Parti Komunis Malaya (PKM) menyasarkan pasukan keselamatan dan menyerang balai polis?', 'Merampas senjata api', 'Menimbulkan ketakutan', 'Melambatkan kemerdekaan', 'Menonjolkan ketidakupayaan', 'Menonjolkan ketidakupayaan', 'active'),
(65, 28, 'Apakah idea kemerdekaan yang diperjuangkan oleh Kesatuan Melayu Muda?', 'Melayu Raya', 'Kerjasama kaum', 'Pemerintah sosialis', 'Raja Berperlembagaan', 'Melayu Raya', 'active'),
(66, 28, 'Jawatankuasa Hubungan Antara Kaum (CLC) ditubuhkan pada Januari 1949. Apakah objektif yang hendak dicapai melalui penubuhan jawatankuasa tersebut?', 'Mengukuhkan ekonomi negara dan Mewujudkan keadaan harmoni', 'Mengukuhkan ekonomi negara dan Menyelesaikan isu pergaduhan', 'Mewujudkan keadaan harmoni dan Mengkaji hubungan kaum', 'Mengkaji hubungan kaum dan Menyelesaikan isu pergaduhan', 'Mewujudkan keadaan harmoni dan Mengkaji hubungan kaum', 'active'),
(67, 28, 'Ordinan berikut telah diperkenalkan pada tahun 1950. Ordinan Pilihan Raya Pihak Berkuasa Tempatan Apakah kuasa yang diberikan kepada majlis tempatan mengikut ordinan tersebut?', 'Menubuhkan parti politik', 'Mengadakan pilihan raya', 'Menetapkan manifesto', 'Memilih calon', 'Menubuhkan parti politik', 'active'),
(68, 28, 'Rajah di bawah menunjukkan barisan kabinet pertama Persekutuan Tanah Melayu selepas Pilihan Raya Umum 1955. Sumber: Malaysia. Arkib Negara Malaysia, 2007, Merintis Denai Demokrasi, Kuala Lumpur, Arkib Negara Malaysia. Apakah peranan kabinet tersebut?', 'Menamatkan pentadbiran British', 'Membincangkan hubungan diplomatik', 'Mengubah sistem berasaskan Westminster', 'Membincangkan isu keselamatan dalam negeri', 'Membincangkan isu keselamatan dalam negeri', 'active'),
(69, 28, 'Suruhanjaya Perlembagaan Persekutuan Tanah Melayu ditubuhkan pada 8 Mac 1956. Mengapakah suruhanjaya ini di bentuk?', 'Menyusun perlembagaan', 'Menubuhkan negara baharu', 'Membuat rundingan di London', 'Melanjutkan tarikh kemerdekaan', 'Menyusun perlembagaan', 'active'),
(70, 28, 'Apakah peranan Bahasa Melayu menurut Perjanjian Persekutuan Tanah Melayu 1957?', 'Bahasa ilmu dan Bahasa pengantar', 'Bahasa ilmu dan Bahasa tunggal', 'Bahasa pengantar dan Bahasa komunikasi', 'Bahasa komunikasi dan Bahasa tunggal', 'Bahasa ilmu dan Bahasa pengantar', 'active'),
(71, 28, 'Pada pendapat anda, apakah kepentingan menghayati erti kemerdekaan negara?', 'Mengenali sejarah negara', 'Meningkatkan kemajuan', 'Mengukuhkan jati diri', 'Menjadi pemimpin', 'Mengukuhkan jati diri', 'active'),
(72, 28, 'Apakah tujuan Rancangan Buku Merah yang dilancarkan pada 25 Januari 1961?', 'Membuka tanah secara besar-besaran', 'Menyediakan peluang pekerjaan', 'Memantau projek pembangunan ', 'Menstabilkan kewangan negara', 'Menyediakan peluang pekerjaan', 'active'),
(73, 28, 'Rajah menunjukkan ciri-ciri negara yang berdaulat. Mempunyai sempadan Mempunyai perundangan Ciri-ciri negara berdaulat Mempunyai pemerintahan \"X\", Apakah ciri X?', 'Mempunyai rakyat', 'Mempunyai agama', 'Mempunyai lambang', 'Mempunyai ketenteraan', 'Mempunyai rakyat', 'active'),
(74, 28, ' Maklumat berikut berkaitan peranan rakyat dalam mempertahankan kedaulatan negara. • Menganggotai pasukan keselamatan • Memberikan maklumat tentang pencerobohan sempadan negara Apakah aspek yang ditekankan dalam dasar tersebut?', 'Meningkatkan kewibawaan pemimpin', 'Membawa kesejahteraan hidup', 'Mengukuhkan pertahanan', 'Melicinkan pentadbiran', 'Mengukuhkan pertahanan', 'active'),
(75, 28, 'Berkaitan badan pentadbiran negara. Apakah peranan institusi di atas?', 'Mengekalkan kedaulatan negara', 'Membentuk undang-undang negara', 'Melantik Yang di-Pertuan Agong', 'Memilih Timbalan dan Perdana Menteri', 'Melantik Yang di-Pertuan Agong', 'active'),
(76, 28, ' Rajah berikut berkaitan pindaan Perlembagaan 1963. Pindaan Perlembagaan 1963 Struktur mahkamah atasan Pembentukan mahkamah tinggi Borneo Apakah \"X\"?', 'Penggunaan bahasa Melayu', 'Pemansuhan kuasa imigresen', 'Pelaksanaan sistem Demokrasi Berparlimen', 'Pengenalan jawatan Yang di-Pertua Negeri', 'Penggunaan bahasa Melayu', 'active'),
(77, 28, ' Rajah menunjukkan pengasingan kuasa dalam pemerintahan negara. Yang di-Pertuan Agong Badan Perundangan Badan Eksekutif \"X\" .Apakah peranan X?', 'Membuat pindaan perlembagaan', 'Mentafsirkan undang-undang', 'Melaksanakan dasar-dasar', 'Menggubal perlembagaan', 'Mentafsirkan undang-undang', 'active'),
(78, 28, 'Perlembagaan Persekutuan memperuntukkan kuasa budi bicara pada Yang di-Pertuan Agong. Apakah tindakan yang membuktikan kuasa tersebut?', 'Melakukan pindaan perlembagaan', 'Menyelesaikan perisytiharan sempadan', 'Pengisytiharan undang-undang darurat', 'Pelantikan ketua kerajaan persekutuan', 'Pelantikan ketua kerajaan persekutuan', 'active'),
(79, 28, 'Senarai berikut adalah badan berkanun yang ditubuhkan bagi menjayakan sosioekonomi negara. • Lembaga Penyatuan dan Pemulihan Tanah Persekutuan (FELCRA) • Lembaga Kemajuan Tanah Persekutuan (FELDA) Apakah faktor kejayaan pengurusan badan berkanun tersebut?', 'Kepelbagaian kemudahan asas di luar bandar', 'Kerjasama Kerajaan Persekutuan dan Kerajaan Negeri', 'Kemajuan teknologi moden dalam pertanian', 'Keberkesanan Dasar Pertanian Negara', 'Kerjasama Kerajaan Persekutuan dan Kerajaan Negeri', 'active'),
(80, 28, 'Apakah majlis yang ditubuhkan untuk menyelaras pentadbiran Kerajaan Persekutuan dengan Kerajaan Negeri?', 'Majlis Persekutuan Negeri dan Majlis Khazanah Nasional', 'Majlis Persekutuan Negeri dan Majlis Tanah Negara', 'Majlis Khazanah Nasional dan Majlis Kewangan Negara', 'Majlis Kewangan Negara dan Majlis Tanah Negara', 'Majlis Kewangan Negara dan Majlis Tanah Negara', 'active'),
(81, 28, 'Tokoh berikut adalah Pegawai Tinggi British. Sir Gerald Templer Sir Geofroy Tory Apakah persamaan kedua-dua tokoh tersebut?', 'Mencadangkan penggabungan wilayah', 'Merancang pengasingan kuasa', 'Menganggotai Suruhanjaya Cobbold', 'Membubarkan Dewan Parlimen British', 'Mencadangkan penggabungan wilayah', 'active'),
(82, 28, 'Tarikh asal pembentukan Malaysia 31 Ogos 1963 ditangguhkan kepada 16 September 1963. Mengapa situasi ini berlaku?', 'Pembubaran parlimen Tanah Melayu', 'Kelewatan laporan Setiausaha PBB', 'Pemisahan Singapura dari Malaysia ', 'Tindakan ketenteraan Indonesia', 'Kelewatan laporan Setiausaha PBB', 'active'),
(83, 28, ' Mesyuarat berikut telah diadakan atas arahan Tunku Abdul Rahman Putra al-Haj. 1 Julai 1965 Mesyuarat antara Tun Abdul Razak Hussein bersama beberapa menteri seperti Dr. Ismail Abdul Rahman, Tan Siew Sin dan V.T. Sambathan. Apakah perkara yang dibincangkan dalam mesyuarat tersebut?', 'Pemisahan Singapura', 'Pembubaran Parlimen', 'Pembentukan Malaysia', 'Pengeboman Tugu Negara', 'Pemisahan Singapura', 'active'),
(84, 28, 'Mengapakah kerajaan melancarkan Operasi Hammer di Sarawak? Menghentikan rusuhan kaum', 'Melemahkan parti berhaluan kiri', 'Menghapuskan ancaman komunis', 'Menghalang pencerobohan pendatang', 'Menghentikan rusuhan kaum', 'Menghapuskan ancaman komunis', 'active'),
(85, 28, 'Institut Bahasa, Kesusasteraan dan Kebudayaan Melayu (IBKKM) ditubuhkan pada 1 Disember 1972 di Universiti Kebangsaan Malaysia (UKM). Apakah peranan institut tersebut?', 'Pusat penyelidikan', 'Pusat pengumpulan', 'Pusat penterjemahan', 'Pusat penerbitan', 'Pusat penyelidikan', 'active'),
(86, 28, 'Senarai berikut berkaitan sukan yang dianjurkan di negara kita. • · Majlis Sukan Sekolah-Sekolah Malaysia (MSSS) Majlis Sukan Universiti Malaysia (MASUM) • Sukan Malaysia (SUKMA) Apakah tujuan sukan tersebut diadakan?', 'Mengimbangi ekonomi antara kaum', 'Memajukan industri pelancongan', 'Memantapkan ekonomi', 'Memperkukuh perpaduan', 'Memperkukuh perpaduan', 'active'),
(87, 28, 'Rajah berikut berkaitan strategi Dasar Ekonomi Baru (DEB). Strategi DEB *Membasmi kemiskinan.Apakah \"X\"?', 'Menggiatkan sektor swasta', 'Menggalakkan perladangan', 'Menyusun semula masyarakat', 'Memajukan perindustrian berat', 'Menyusun semula masyarakat', 'active'),
(88, 28, 'Bagaimanakah kerajaan berjaya menurunkan kadar kemiskinan di Malaysia?', 'Membuka peluang pekerjaan dan Menyekat kemasukan imigran', 'Membuka peluang pekerjaan dan Mempelbagaikan kegiatan ekonomi', 'Menyekat kemasukan imigran dan Menyediakan kemudahan pinjaman', 'Menyediakan kemudahan pinjaman dan Mempelbagaikan kegiatan ekonomi', 'Membuka peluang pekerjaan dan Mempelbagaikan kegiatan ekonomi', 'active'),
(89, 28, 'Antara yang berikut, yang manakah faktor penggubalan dasar luar Malaysia?', 'Kesaksamaan budaya', 'Kedudukan strategik', 'Keperluan nasional', 'Melantik Yang di-Pertuan Agong', 'Keperluan nasional', 'active'),
(90, 28, 'Jadual berikut berkaitan dengan penglibatan Malaysia dalam Pergerakan Negara-negara Tanpa Pihak (NAM). Tahun 1970 Perjanjian Perisytiharan Lusaka Apakah kepentingan perjanjian tersebut?', 'Pencerobohan Palestin ditamatkan', 'Peningkatan kerjasama ekonomi', 'Pelarian Bosnia diselamatkan', 'Pengharaman senjata nuklear', 'Pengharaman senjata nuklear', 'active'),
(91, 28, 'Mengapakah Malaysia menjadi transit pemerdagangan orang ke negara lain?', 'Kedudukan yang strategik', 'Kemudahan pelabuhan banyak', 'Kawalan sempadan yang longgar', 'Kelemahan penguatkuasaan undang-undang', 'Kedudukan yang strategik', 'active'),
(92, 28, 'Bagaimanakah Malaysia berjaya menangani kemelesetan ekonomi pada tahun 1997-1998?', 'Menambat kadar mata wang', 'Membuat pinjaman Bank Dunia', 'Meningkatkan barangan eksport', 'Menggunakan pelan perancangan IMF', 'Menambat kadar mata wang', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `exam_tbl`
--

CREATE TABLE `exam_tbl` (
  `ex_id` int(11) NOT NULL,
  `cou_id` int(11) NOT NULL,
  `ex_title` varchar(1000) NOT NULL,
  `ex_time_limit` varchar(1000) NOT NULL,
  `ex_questlimit_display` int(11) NOT NULL,
  `ex_description` varchar(1000) NOT NULL,
  `ex_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_tbl`
--

INSERT INTO `exam_tbl` (`ex_id`, `cou_id`, `ex_title`, `ex_time_limit`, `ex_questlimit_display`, `ex_description`, `ex_created`) VALUES
(26, 83, 'Objective Question', '10', 5, 'this is to improve yr sejarah knowledge', '2024-03-31 15:18:11'),
(28, 84, 'Sejarah-Objective Question', '60', 40, 'A Sejarah Quiz for Students', '2024-04-06 10:31:23'),
(29, 85, 'sdasda', '10', 2, 'assdasdsa', '2024-04-06 11:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks_tbl`
--

CREATE TABLE `feedbacks_tbl` (
  `fb_id` int(11) NOT NULL,
  `exmne_id` int(11) NOT NULL,
  `fb_exmne_as` varchar(1000) NOT NULL,
  `fb_feedbacks` varchar(1000) NOT NULL,
  `fb_date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedbacks_tbl`
--

INSERT INTO `feedbacks_tbl` (`fb_id`, `exmne_id`, `fb_exmne_as`, `fb_feedbacks`, `fb_date`) VALUES
(10, 9, 'zc', 'the question is too hard', 'March 12, 2024'),
(11, 10, 'zi yen', 'asfasfasddas', 'March 13, 2024'),
(12, 9, 'zc', 'asdddas', 'March 29, 2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`cou_id`);

--
-- Indexes for table `examinee_tbl`
--
ALTER TABLE `examinee_tbl`
  ADD PRIMARY KEY (`exmne_id`);

--
-- Indexes for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD PRIMARY KEY (`exans_id`);

--
-- Indexes for table `exam_attempt`
--
ALTER TABLE `exam_attempt`
  ADD PRIMARY KEY (`examat_id`);

--
-- Indexes for table `exam_question_tbl`
--
ALTER TABLE `exam_question_tbl`
  ADD PRIMARY KEY (`eqt_id`);

--
-- Indexes for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `feedbacks_tbl`
--
ALTER TABLE `feedbacks_tbl`
  ADD PRIMARY KEY (`fb_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `cou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `examinee_tbl`
--
ALTER TABLE `examinee_tbl`
  MODIFY `exmne_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exam_answers`
--
ALTER TABLE `exam_answers`
  MODIFY `exans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=685;

--
-- AUTO_INCREMENT for table `exam_attempt`
--
ALTER TABLE `exam_attempt`
  MODIFY `examat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `exam_question_tbl`
--
ALTER TABLE `exam_question_tbl`
  MODIFY `eqt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `feedbacks_tbl`
--
ALTER TABLE `feedbacks_tbl`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
