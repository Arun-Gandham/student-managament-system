-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2023 at 02:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms_qa`
--

-- --------------------------------------------------------

--
-- Table structure for table `sms_acdamic_years`
--

CREATE TABLE `sms_acdamic_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_acdamic_years`
--

INSERT INTO `sms_acdamic_years` (`id`, `name`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, '2022 - 2023', '2022-06-01', '2023-05-31', '2023-04-27 09:18:03', '2023-04-27 09:18:03'),
(2, '2023 - 2024', '2023-06-01', '2024-05-31', '2023-04-27 09:16:18', '2023-04-27 09:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `sms_attendance_types`
--

CREATE TABLE `sms_attendance_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_attendance_types`
--

INSERT INTO `sms_attendance_types` (`id`, `name`) VALUES
(1, 'Present'),
(2, 'Absent'),
(3, 'Late Arrival'),
(4, 'Leave');

-- --------------------------------------------------------

--
-- Table structure for table `sms_cities`
--

CREATE TABLE `sms_cities` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sms_cities`
--

INSERT INTO `sms_cities` (`id`, `city`, `state_id`) VALUES
(1, 'North and Middle Andaman', 32),
(2, 'South Andaman', 32),
(3, 'Nicobar', 32),
(4, 'Adilabad', 1),
(5, 'Anantapur', 1),
(6, 'Chittoor', 1),
(7, 'East Godavari', 1),
(8, 'Guntur', 1),
(9, 'Hyderabad', 1),
(10, 'Kadapa', 1),
(11, 'Karimnagar', 1),
(12, 'Khammam', 1),
(13, 'Krishna', 1),
(14, 'Kurnool', 1),
(15, 'Mahbubnagar', 1),
(16, 'Medak', 1),
(17, 'Nalgonda', 1),
(18, 'Nellore', 1),
(19, 'Nizamabad', 1),
(20, 'Prakasam', 1),
(21, 'Rangareddi', 1),
(22, 'Srikakulam', 1),
(23, 'Vishakhapatnam', 1),
(24, 'Vizianagaram', 1),
(25, 'Warangal', 1),
(26, 'West Godavari', 1),
(27, 'Anjaw', 3),
(28, 'Changlang', 3),
(29, 'East Kameng', 3),
(30, 'Lohit', 3),
(31, 'Lower Subansiri', 3),
(32, 'Papum Pare', 3),
(33, 'Tirap', 3),
(34, 'Dibang Valley', 3),
(35, 'Upper Subansiri', 3),
(36, 'West Kameng', 3),
(37, 'Barpeta', 2),
(38, 'Bongaigaon', 2),
(39, 'Cachar', 2),
(40, 'Darrang', 2),
(41, 'Dhemaji', 2),
(42, 'Dhubri', 2),
(43, 'Dibrugarh', 2),
(44, 'Goalpara', 2),
(45, 'Golaghat', 2),
(46, 'Hailakandi', 2),
(47, 'Jorhat', 2),
(48, 'Karbi Anglong', 2),
(49, 'Karimganj', 2),
(50, 'Kokrajhar', 2),
(51, 'Lakhimpur', 2),
(52, 'Marigaon', 2),
(53, 'Nagaon', 2),
(54, 'Nalbari', 2),
(55, 'North Cachar Hills', 2),
(56, 'Sibsagar', 2),
(57, 'Sonitpur', 2),
(58, 'Tinsukia', 2),
(59, 'Araria', 4),
(60, 'Aurangabad', 4),
(61, 'Banka', 4),
(62, 'Begusarai', 4),
(63, 'Bhagalpur', 4),
(64, 'Bhojpur', 4),
(65, 'Buxar', 4),
(66, 'Darbhanga', 4),
(67, 'Purba Champaran', 4),
(68, 'Gaya', 4),
(69, 'Gopalganj', 4),
(70, 'Jamui', 4),
(71, 'Jehanabad', 4),
(72, 'Khagaria', 4),
(73, 'Kishanganj', 4),
(74, 'Kaimur', 4),
(75, 'Katihar', 4),
(76, 'Lakhisarai', 4),
(77, 'Madhubani', 4),
(78, 'Munger', 4),
(79, 'Madhepura', 4),
(80, 'Muzaffarpur', 4),
(81, 'Nalanda', 4),
(82, 'Nawada', 4),
(83, 'Patna', 4),
(84, 'Purnia', 4),
(85, 'Rohtas', 4),
(86, 'Saharsa', 4),
(87, 'Samastipur', 4),
(88, 'Sheohar', 4),
(89, 'Sheikhpura', 4),
(90, 'Saran', 4),
(91, 'Sitamarhi', 4),
(92, 'Supaul', 4),
(93, 'Siwan', 4),
(94, 'Vaishali', 4),
(95, 'Pashchim Champaran', 4),
(96, 'Bastar', 36),
(97, 'Bilaspur', 36),
(98, 'Dantewada', 36),
(99, 'Dhamtari', 36),
(100, 'Durg', 36),
(101, 'Jashpur', 36),
(102, 'Janjgir-Champa', 36),
(103, 'Korba', 36),
(104, 'Koriya', 36),
(105, 'Kanker', 36),
(106, 'Kawardha', 36),
(107, 'Mahasamund', 36),
(108, 'Raigarh', 36),
(109, 'Rajnandgaon', 36),
(110, 'Raipur', 36),
(111, 'Surguja', 36),
(112, 'Diu', 29),
(113, 'Daman', 29),
(114, 'Central Delhi', 25),
(115, 'East Delhi', 25),
(116, 'New Delhi', 25),
(117, 'North Delhi', 25),
(118, 'North East Delhi', 25),
(119, 'North West Delhi', 25),
(120, 'South Delhi', 25),
(121, 'South West Delhi', 25),
(122, 'West Delhi', 25),
(123, 'North Goa', 26),
(124, 'South Goa', 26),
(125, 'Ahmedabad', 5),
(126, 'Amreli District', 5),
(127, 'Anand', 5),
(128, 'Banaskantha', 5),
(129, 'Bharuch', 5),
(130, 'Bhavnagar', 5),
(131, 'Dahod', 5),
(132, 'The Dangs', 5),
(133, 'Gandhinagar', 5),
(134, 'Jamnagar', 5),
(135, 'Junagadh', 5),
(136, 'Kutch', 5),
(137, 'Kheda', 5),
(138, 'Mehsana', 5),
(139, 'Narmada', 5),
(140, 'Navsari', 5),
(141, 'Patan', 5),
(142, 'Panchmahal', 5),
(143, 'Porbandar', 5),
(144, 'Rajkot', 5),
(145, 'Sabarkantha', 5),
(146, 'Surendranagar', 5),
(147, 'Surat', 5),
(148, 'Vadodara', 5),
(149, 'Valsad', 5),
(150, 'Ambala', 6),
(151, 'Bhiwani', 6),
(152, 'Faridabad', 6),
(153, 'Fatehabad', 6),
(154, 'Gurgaon', 6),
(155, 'Hissar', 6),
(156, 'Jhajjar', 6),
(157, 'Jind', 6),
(158, 'Karnal', 6),
(159, 'Kaithal', 6),
(160, 'Kurukshetra', 6),
(161, 'Mahendragarh', 6),
(162, 'Mewat', 6),
(163, 'Panchkula', 6),
(164, 'Panipat', 6),
(165, 'Rewari', 6),
(166, 'Rohtak', 6),
(167, 'Sirsa', 6),
(168, 'Sonepat', 6),
(169, 'Yamuna Nagar', 6),
(170, 'Palwal', 6),
(171, 'Bilaspur', 7),
(172, 'Chamba', 7),
(173, 'Hamirpur', 7),
(174, 'Kangra', 7),
(175, 'Kinnaur', 7),
(176, 'Kulu', 7),
(177, 'Lahaul and Spiti', 7),
(178, 'Mandi', 7),
(179, 'Shimla', 7),
(180, 'Sirmaur', 7),
(181, 'Solan', 7),
(182, 'Una', 7),
(183, 'Anantnag', 8),
(184, 'Badgam', 8),
(185, 'Bandipore', 8),
(186, 'Baramula', 8),
(187, 'Doda', 8),
(188, 'Jammu', 8),
(189, 'Kargil', 8),
(190, 'Kathua', 8),
(191, 'Kupwara', 8),
(192, 'Leh', 8),
(193, 'Poonch', 8),
(194, 'Pulwama', 8),
(195, 'Rajauri', 8),
(196, 'Srinagar', 8),
(197, 'Samba', 8),
(198, 'Udhampur', 8),
(199, 'Bokaro', 34),
(200, 'Chatra', 34),
(201, 'Deoghar', 34),
(202, 'Dhanbad', 34),
(203, 'Dumka', 34),
(204, 'Purba Singhbhum', 34),
(205, 'Garhwa', 34),
(206, 'Giridih', 34),
(207, 'Godda', 34),
(208, 'Gumla', 34),
(209, 'Hazaribagh', 34),
(210, 'Koderma', 34),
(211, 'Lohardaga', 34),
(212, 'Pakur', 34),
(213, 'Palamu', 34),
(214, 'Ranchi', 34),
(215, 'Sahibganj', 34),
(216, 'Seraikela and Kharsawan', 34),
(217, 'Pashchim Singhbhum', 34),
(218, 'Ramgarh', 34),
(219, 'Bidar', 9),
(220, 'Belgaum', 9),
(221, 'Bijapur', 9),
(222, 'Bagalkot', 9),
(223, 'Bellary', 9),
(224, 'Bangalore Rural District', 9),
(225, 'Bangalore Urban District', 9),
(226, 'Chamarajnagar', 9),
(227, 'Chikmagalur', 9),
(228, 'Chitradurga', 9),
(229, 'Davanagere', 9),
(230, 'Dharwad', 9),
(231, 'Dakshina Kannada', 9),
(232, 'Gadag', 9),
(233, 'Gulbarga', 9),
(234, 'Hassan', 9),
(235, 'Haveri District', 9),
(236, 'Kodagu', 9),
(237, 'Kolar', 9),
(238, 'Koppal', 9),
(239, 'Mandya', 9),
(240, 'Mysore', 9),
(241, 'Raichur', 9),
(242, 'Shimoga', 9),
(243, 'Tumkur', 9),
(244, 'Udupi', 9),
(245, 'Uttara Kannada', 9),
(246, 'Ramanagara', 9),
(247, 'Chikballapur', 9),
(248, 'Yadagiri', 9),
(249, 'Alappuzha', 10),
(250, 'Ernakulam', 10),
(251, 'Idukki', 10),
(252, 'Kollam', 10),
(253, 'Kannur', 10),
(254, 'Kasaragod', 10),
(255, 'Kottayam', 10),
(256, 'Kozhikode', 10),
(257, 'Malappuram', 10),
(258, 'Palakkad', 10),
(259, 'Pathanamthitta', 10),
(260, 'Thrissur', 10),
(261, 'Thiruvananthapuram', 10),
(262, 'Wayanad', 10),
(263, 'Alirajpur', 11),
(264, 'Anuppur', 11),
(265, 'Ashok Nagar', 11),
(266, 'Balaghat', 11),
(267, 'Barwani', 11),
(268, 'Betul', 11),
(269, 'Bhind', 11),
(270, 'Bhopal', 11),
(271, 'Burhanpur', 11),
(272, 'Chhatarpur', 11),
(273, 'Chhindwara', 11),
(274, 'Damoh', 11),
(275, 'Datia', 11),
(276, 'Dewas', 11),
(277, 'Dhar', 11),
(278, 'Dindori', 11),
(279, 'Guna', 11),
(280, 'Gwalior', 11),
(281, 'Harda', 11),
(282, 'Hoshangabad', 11),
(283, 'Indore', 11),
(284, 'Jabalpur', 11),
(285, 'Jhabua', 11),
(286, 'Katni', 11),
(287, 'Khandwa', 11),
(288, 'Khargone', 11),
(289, 'Mandla', 11),
(290, 'Mandsaur', 11),
(291, 'Morena', 11),
(292, 'Narsinghpur', 11),
(293, 'Neemuch', 11),
(294, 'Panna', 11),
(295, 'Rewa', 11),
(296, 'Rajgarh', 11),
(297, 'Ratlam', 11),
(298, 'Raisen', 11),
(299, 'Sagar', 11),
(300, 'Satna', 11),
(301, 'Sehore', 11),
(302, 'Seoni', 11),
(303, 'Shahdol', 11),
(304, 'Shajapur', 11),
(305, 'Sheopur', 11),
(306, 'Shivpuri', 11),
(307, 'Sidhi', 11),
(308, 'Singrauli', 11),
(309, 'Tikamgarh', 11),
(310, 'Ujjain', 11),
(311, 'Umaria', 11),
(312, 'Vidisha', 11),
(313, 'Ahmednagar', 12),
(314, 'Akola', 12),
(315, 'Amrawati', 12),
(316, 'Aurangabad', 12),
(317, 'Bhandara', 12),
(318, 'Beed', 12),
(319, 'Buldhana', 12),
(320, 'Chandrapur', 12),
(321, 'Dhule', 12),
(322, 'Gadchiroli', 12),
(323, 'Gondiya', 12),
(324, 'Hingoli', 12),
(325, 'Jalgaon', 12),
(326, 'Jalna', 12),
(327, 'Kolhapur', 12),
(328, 'Latur', 12),
(329, 'Mumbai City', 12),
(330, 'Mumbai suburban', 12),
(331, 'Nandurbar', 12),
(332, 'Nanded', 12),
(333, 'Nagpur', 12),
(334, 'Nashik', 12),
(335, 'Osmanabad', 12),
(336, 'Parbhani', 12),
(337, 'Pune', 12),
(338, 'Raigad', 12),
(339, 'Ratnagiri', 12),
(340, 'Sindhudurg', 12),
(341, 'Sangli', 12),
(342, 'Solapur', 12),
(343, 'Satara', 12),
(344, 'Thane', 12),
(345, 'Wardha', 12),
(346, 'Washim', 12),
(347, 'Yavatmal', 12),
(348, 'Bishnupur', 13),
(349, 'Churachandpur', 13),
(350, 'Chandel', 13),
(351, 'Imphal East', 13),
(352, 'Senapati', 13),
(353, 'Tamenglong', 13),
(354, 'Thoubal', 13),
(355, 'Ukhrul', 13),
(356, 'Imphal West', 13),
(357, 'East Garo Hills', 14),
(358, 'East Khasi Hills', 14),
(359, 'Jaintia Hills', 14),
(360, 'Ri-Bhoi', 14),
(361, 'South Garo Hills', 14),
(362, 'West Garo Hills', 14),
(363, 'West Khasi Hills', 14),
(364, 'Aizawl', 15),
(365, 'Champhai', 15),
(366, 'Kolasib', 15),
(367, 'Lawngtlai', 15),
(368, 'Lunglei', 15),
(369, 'Mamit', 15),
(370, 'Saiha', 15),
(371, 'Serchhip', 15),
(372, 'Dimapur', 16),
(373, 'Kohima', 16),
(374, 'Mokokchung', 16),
(375, 'Mon', 16),
(376, 'Phek', 16),
(377, 'Tuensang', 16),
(378, 'Wokha', 16),
(379, 'Zunheboto', 16),
(380, 'Angul', 17),
(381, 'Boudh', 17),
(382, 'Bhadrak', 17),
(383, 'Bolangir', 17),
(384, 'Bargarh', 17),
(385, 'Baleswar', 17),
(386, 'Cuttack', 17),
(387, 'Debagarh', 17),
(388, 'Dhenkanal', 17),
(389, 'Ganjam', 17),
(390, 'Gajapati', 17),
(391, 'Jharsuguda', 17),
(392, 'Jajapur', 17),
(393, 'Jagatsinghpur', 17),
(394, 'Khordha', 17),
(395, 'Kendujhar', 17),
(396, 'Kalahandi', 17),
(397, 'Kandhamal', 17),
(398, 'Koraput', 17),
(399, 'Kendrapara', 17),
(400, 'Malkangiri', 17),
(401, 'Mayurbhanj', 17),
(402, 'Nabarangpur', 17),
(403, 'Nuapada', 17),
(404, 'Nayagarh', 17),
(405, 'Puri', 17),
(406, 'Rayagada', 17),
(407, 'Sambalpur', 17),
(408, 'Subarnapur', 17),
(409, 'Sundargarh', 17),
(410, 'Karaikal', 27),
(411, 'Mahe', 27),
(412, 'Puducherry', 27),
(413, 'Yanam', 27),
(414, 'Amritsar', 18),
(415, 'Bathinda', 18),
(416, 'Firozpur', 18),
(417, 'Faridkot', 18),
(418, 'Fatehgarh Sahib', 18),
(419, 'Gurdaspur', 18),
(420, 'Hoshiarpur', 18),
(421, 'Jalandhar', 18),
(422, 'Kapurthala', 18),
(423, 'Ludhiana', 18),
(424, 'Mansa', 18),
(425, 'Moga', 18),
(426, 'Mukatsar', 18),
(427, 'Nawan Shehar', 18),
(428, 'Patiala', 18),
(429, 'Rupnagar', 18),
(430, 'Sangrur', 18),
(431, 'Ajmer', 19),
(432, 'Alwar', 19),
(433, 'Bikaner', 19),
(434, 'Barmer', 19),
(435, 'Banswara', 19),
(436, 'Bharatpur', 19),
(437, 'Baran', 19),
(438, 'Bundi', 19),
(439, 'Bhilwara', 19),
(440, 'Churu', 19),
(441, 'Chittorgarh', 19),
(442, 'Dausa', 19),
(443, 'Dholpur', 19),
(444, 'Dungapur', 19),
(445, 'Ganganagar', 19),
(446, 'Hanumangarh', 19),
(447, 'Juhnjhunun', 19),
(448, 'Jalore', 19),
(449, 'Jodhpur', 19),
(450, 'Jaipur', 19),
(451, 'Jaisalmer', 19),
(452, 'Jhalawar', 19),
(453, 'Karauli', 19),
(454, 'Kota', 19),
(455, 'Nagaur', 19),
(456, 'Pali', 19),
(457, 'Pratapgarh', 19),
(458, 'Rajsamand', 19),
(459, 'Sikar', 19),
(460, 'Sawai Madhopur', 19),
(461, 'Sirohi', 19),
(462, 'Tonk', 19),
(463, 'Udaipur', 19),
(464, 'East Sikkim', 20),
(465, 'North Sikkim', 20),
(466, 'South Sikkim', 20),
(467, 'West Sikkim', 20),
(468, 'Ariyalur', 21),
(469, 'Chennai', 21),
(470, 'Coimbatore', 21),
(471, 'Cuddalore', 21),
(472, 'Dharmapuri', 21),
(473, 'Dindigul', 21),
(474, 'Erode', 21),
(475, 'Kanchipuram', 21),
(476, 'Kanyakumari', 21),
(477, 'Karur', 21),
(478, 'Madurai', 21),
(479, 'Nagapattinam', 21),
(480, 'The Nilgiris', 21),
(481, 'Namakkal', 21),
(482, 'Perambalur', 21),
(483, 'Pudukkottai', 21),
(484, 'Ramanathapuram', 21),
(485, 'Salem', 21),
(486, 'Sivagangai', 21),
(487, 'Tiruppur', 21),
(488, 'Tiruchirappalli', 21),
(489, 'Theni', 21),
(490, 'Tirunelveli', 21),
(491, 'Thanjavur', 21),
(492, 'Thoothukudi', 21),
(493, 'Thiruvallur', 21),
(494, 'Thiruvarur', 21),
(495, 'Tiruvannamalai', 21),
(496, 'Vellore', 21),
(497, 'Villupuram', 21),
(498, 'Dhalai', 22),
(499, 'North Tripura', 22),
(500, 'South Tripura', 22),
(501, 'West Tripura', 22),
(502, 'Almora', 33),
(503, 'Bageshwar', 33),
(504, 'Chamoli', 33),
(505, 'Champawat', 33),
(506, 'Dehradun', 33),
(507, 'Haridwar', 33),
(508, 'Nainital', 33),
(509, 'Pauri Garhwal', 33),
(510, 'Pithoragharh', 33),
(511, 'Rudraprayag', 33),
(512, 'Tehri Garhwal', 33),
(513, 'Udham Singh Nagar', 33),
(514, 'Uttarkashi', 33),
(515, 'Agra', 23),
(516, 'Allahabad', 23),
(517, 'Aligarh', 23),
(518, 'Ambedkar Nagar', 23),
(519, 'Auraiya', 23),
(520, 'Azamgarh', 23),
(521, 'Barabanki', 23),
(522, 'Badaun', 23),
(523, 'Bagpat', 23),
(524, 'Bahraich', 23),
(525, 'Bijnor', 23),
(526, 'Ballia', 23),
(527, 'Banda', 23),
(528, 'Balrampur', 23),
(529, 'Bareilly', 23),
(530, 'Basti', 23),
(531, 'Bulandshahr', 23),
(532, 'Chandauli', 23),
(533, 'Chitrakoot', 23),
(534, 'Deoria', 23),
(535, 'Etah', 23),
(536, 'Kanshiram Nagar', 23),
(537, 'Etawah', 23),
(538, 'Firozabad', 23),
(539, 'Farrukhabad', 23),
(540, 'Fatehpur', 23),
(541, 'Faizabad', 23),
(542, 'Gautam Buddha Nagar', 23),
(543, 'Gonda', 23),
(544, 'Ghazipur', 23),
(545, 'Gorkakhpur', 23),
(546, 'Ghaziabad', 23),
(547, 'Hamirpur', 23),
(548, 'Hardoi', 23),
(549, 'Mahamaya Nagar', 23),
(550, 'Jhansi', 23),
(551, 'Jalaun', 23),
(552, 'Jyotiba Phule Nagar', 23),
(553, 'Jaunpur District', 23),
(554, 'Kanpur Dehat', 23),
(555, 'Kannauj', 23),
(556, 'Kanpur Nagar', 23),
(557, 'Kaushambi', 23),
(558, 'Kushinagar', 23),
(559, 'Lalitpur', 23),
(560, 'Lakhimpur Kheri', 23),
(561, 'Lucknow', 23),
(562, 'Mau', 23),
(563, 'Meerut', 23),
(564, 'Maharajganj', 23),
(565, 'Mahoba', 23),
(566, 'Mirzapur', 23),
(567, 'Moradabad', 23),
(568, 'Mainpuri', 23),
(569, 'Mathura', 23),
(570, 'Muzaffarnagar', 23),
(571, 'Pilibhit', 23),
(572, 'Pratapgarh', 23),
(573, 'Rampur', 23),
(574, 'Rae Bareli', 23),
(575, 'Saharanpur', 23),
(576, 'Sitapur', 23),
(577, 'Shahjahanpur', 23),
(578, 'Sant Kabir Nagar', 23),
(579, 'Siddharthnagar', 23),
(580, 'Sonbhadra', 23),
(581, 'Sant Ravidas Nagar', 23),
(582, 'Sultanpur', 23),
(583, 'Shravasti', 23),
(584, 'Unnao', 23),
(585, 'Varanasi', 23),
(586, 'Birbhum', 24),
(587, 'Bankura', 24),
(588, 'Bardhaman', 24),
(589, 'Darjeeling', 24),
(590, 'Dakshin Dinajpur', 24),
(591, 'Hooghly', 24),
(592, 'Howrah', 24),
(593, 'Jalpaiguri', 24),
(594, 'Cooch Behar', 24),
(595, 'Kolkata', 24),
(596, 'Malda', 24),
(597, 'Midnapore', 24),
(598, 'Murshidabad', 24),
(599, 'Nadia', 24),
(600, 'North 24 Parganas', 24),
(601, 'South 24 Parganas', 24),
(602, 'Purulia', 24),
(603, 'Uttar Dinajpur', 24);

-- --------------------------------------------------------

--
-- Table structure for table `sms_classes`
--

CREATE TABLE `sms_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tution_fee` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_classes`
--

INSERT INTO `sms_classes` (`id`, `school_id`, `name`, `tution_fee`, `created_at`, `updated_at`) VALUES
(9, 1, '1st Class', 0, '2023-04-18 05:48:58', '2023-04-18 05:48:58'),
(10, 1, 'Class 2', 12312312, '2023-04-27 08:01:27', '2023-04-27 23:55:42'),
(11, 1, 'fasdf', 123123, '2023-04-27 23:53:03', '2023-04-27 23:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `sms_classes_sections_mapping`
--

CREATE TABLE `sms_classes_sections_mapping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `max_strength` int(5) NOT NULL DEFAULT 0,
  `class_teacher_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_classes_sections_mapping`
--

INSERT INTO `sms_classes_sections_mapping` (`id`, `school_id`, `class_id`, `section_id`, `max_strength`, `class_teacher_id`, `created_at`, `updated_at`) VALUES
(54, 1, 9, 17, 100, 69, '2023-04-18 05:48:58', '2023-04-18 05:48:58'),
(56, 1, 9, 19, 76, 69, '2023-04-18 05:55:29', '2023-04-18 05:55:53'),
(57, 1, 9, 18, 100, 69, '2023-04-18 05:56:07', '2023-04-18 05:56:07'),
(58, 1, 9, 20, 190, 69, '2023-04-18 05:57:58', '2023-04-18 05:57:58'),
(59, 1, 10, 17, 12, 69, '2023-04-27 08:01:27', '2023-04-27 08:01:27'),
(60, 1, 10, 18, 12, 69, '2023-04-27 08:01:27', '2023-04-27 08:01:27'),
(61, 1, 11, 17, 234, 69, '2023-04-27 23:53:03', '2023-04-27 23:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `sms_countries`
--

CREATE TABLE `sms_countries` (
  `id` int(5) NOT NULL,
  `countryCode` char(2) NOT NULL DEFAULT '',
  `name` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sms_countries`
--

INSERT INTO `sms_countries` (`id`, `countryCode`, `name`) VALUES
(1, 'AD', 'Andorra'),
(2, 'AE', 'United Arab Emirates'),
(3, 'AF', 'Afghanistan'),
(4, 'AG', 'Antigua and Barbuda'),
(5, 'AI', 'Anguilla'),
(6, 'AL', 'Albania'),
(7, 'AM', 'Armenia'),
(8, 'AO', 'Angola'),
(9, 'AQ', 'Antarctica'),
(10, 'AR', 'Argentina'),
(11, 'AS', 'American Samoa'),
(12, 'AT', 'Austria'),
(13, 'AU', 'Australia'),
(14, 'AW', 'Aruba'),
(15, 'AX', 'Åland'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BA', 'Bosnia and Herzegovina'),
(18, 'BB', 'Barbados'),
(19, 'BD', 'Bangladesh'),
(20, 'BE', 'Belgium'),
(21, 'BF', 'Burkina Faso'),
(22, 'BG', 'Bulgaria'),
(23, 'BH', 'Bahrain'),
(24, 'BI', 'Burundi'),
(25, 'BJ', 'Benin'),
(26, 'BL', 'Saint Barthélemy'),
(27, 'BM', 'Bermuda'),
(28, 'BN', 'Brunei'),
(29, 'BO', 'Bolivia'),
(30, 'BQ', 'Bonaire'),
(31, 'BR', 'Brazil'),
(32, 'BS', 'Bahamas'),
(33, 'BT', 'Bhutan'),
(34, 'BV', 'Bouvet Island'),
(35, 'BW', 'Botswana'),
(36, 'BY', 'Belarus'),
(37, 'BZ', 'Belize'),
(38, 'CA', 'Canada'),
(39, 'CC', 'Cocos [Keeling] Islands'),
(40, 'CD', 'Democratic Republic of the Congo'),
(41, 'CF', 'Central African Republic'),
(42, 'CG', 'Republic of the Congo'),
(43, 'CH', 'Switzerland'),
(44, 'CI', 'Ivory Coast'),
(45, 'CK', 'Cook Islands'),
(46, 'CL', 'Chile'),
(47, 'CM', 'Cameroon'),
(48, 'CN', 'China'),
(49, 'CO', 'Colombia'),
(50, 'CR', 'Costa Rica'),
(51, 'CU', 'Cuba'),
(52, 'CV', 'Cape Verde'),
(53, 'CW', 'Curacao'),
(54, 'CX', 'Christmas Island'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DE', 'Germany'),
(58, 'DJ', 'Djibouti'),
(59, 'DK', 'Denmark'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'DZ', 'Algeria'),
(63, 'EC', 'Ecuador'),
(64, 'EE', 'Estonia'),
(65, 'EG', 'Egypt'),
(66, 'EH', 'Western Sahara'),
(67, 'ER', 'Eritrea'),
(68, 'ES', 'Spain'),
(69, 'ET', 'Ethiopia'),
(70, 'FI', 'Finland'),
(71, 'FJ', 'Fiji'),
(72, 'FK', 'Falkland Islands'),
(73, 'FM', 'Micronesia'),
(74, 'FO', 'Faroe Islands'),
(75, 'FR', 'France'),
(76, 'GA', 'Gabon'),
(77, 'GB', 'United Kingdom'),
(78, 'GD', 'Grenada'),
(79, 'GE', 'Georgia'),
(80, 'GF', 'French Guiana'),
(81, 'GG', 'Guernsey'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GL', 'Greenland'),
(85, 'GM', 'Gambia'),
(86, 'GN', 'Guinea'),
(87, 'GP', 'Guadeloupe'),
(88, 'GQ', 'Equatorial Guinea'),
(89, 'GR', 'Greece'),
(90, 'GS', 'South Georgia and the South Sandwich Islands'),
(91, 'GT', 'Guatemala'),
(92, 'GU', 'Guam'),
(93, 'GW', 'Guinea-Bissau'),
(94, 'GY', 'Guyana'),
(95, 'HK', 'Hong Kong'),
(96, 'HM', 'Heard Island and McDonald Islands'),
(97, 'HN', 'Honduras'),
(98, 'HR', 'Croatia'),
(99, 'HT', 'Haiti'),
(100, 'HU', 'Hungary'),
(101, 'ID', 'Indonesia'),
(102, 'IE', 'Ireland'),
(103, 'IL', 'Israel'),
(104, 'IM', 'Isle of Man'),
(105, 'IN', 'India'),
(106, 'IO', 'British Indian Ocean Territory'),
(107, 'IQ', 'Iraq'),
(108, 'IR', 'Iran'),
(109, 'IS', 'Iceland'),
(110, 'IT', 'Italy'),
(111, 'JE', 'Jersey'),
(112, 'JM', 'Jamaica'),
(113, 'JO', 'Jordan'),
(114, 'JP', 'Japan'),
(115, 'KE', 'Kenya'),
(116, 'KG', 'Kyrgyzstan'),
(117, 'KH', 'Cambodia'),
(118, 'KI', 'Kiribati'),
(119, 'KM', 'Comoros'),
(120, 'KN', 'Saint Kitts and Nevis'),
(121, 'KP', 'North Korea'),
(122, 'KR', 'South Korea'),
(123, 'KW', 'Kuwait'),
(124, 'KY', 'Cayman Islands'),
(125, 'KZ', 'Kazakhstan'),
(126, 'LA', 'Laos'),
(127, 'LB', 'Lebanon'),
(128, 'LC', 'Saint Lucia'),
(129, 'LI', 'Liechtenstein'),
(130, 'LK', 'Sri Lanka'),
(131, 'LR', 'Liberia'),
(132, 'LS', 'Lesotho'),
(133, 'LT', 'Lithuania'),
(134, 'LU', 'Luxembourg'),
(135, 'LV', 'Latvia'),
(136, 'LY', 'Libya'),
(137, 'MA', 'Morocco'),
(138, 'MC', 'Monaco'),
(139, 'MD', 'Moldova'),
(140, 'ME', 'Montenegro'),
(141, 'MF', 'Saint Martin'),
(142, 'MG', 'Madagascar'),
(143, 'MH', 'Marshall Islands'),
(144, 'MK', 'Macedonia'),
(145, 'ML', 'Mali'),
(146, 'MM', 'Myanmar [Burma]'),
(147, 'MN', 'Mongolia'),
(148, 'MO', 'Macao'),
(149, 'MP', 'Northern Mariana Islands'),
(150, 'MQ', 'Martinique'),
(151, 'MR', 'Mauritania'),
(152, 'MS', 'Montserrat'),
(153, 'MT', 'Malta'),
(154, 'MU', 'Mauritius'),
(155, 'MV', 'Maldives'),
(156, 'MW', 'Malawi'),
(157, 'MX', 'Mexico'),
(158, 'MY', 'Malaysia'),
(159, 'MZ', 'Mozambique'),
(160, 'NA', 'Namibia'),
(161, 'NC', 'New Caledonia'),
(162, 'NE', 'Niger'),
(163, 'NF', 'Norfolk Island'),
(164, 'NG', 'Nigeria'),
(165, 'NI', 'Nicaragua'),
(166, 'NL', 'Netherlands'),
(167, 'NO', 'Norway'),
(168, 'NP', 'Nepal'),
(169, 'NR', 'Nauru'),
(170, 'NU', 'Niue'),
(171, 'NZ', 'New Zealand'),
(172, 'OM', 'Oman'),
(173, 'PA', 'Panama'),
(174, 'PE', 'Peru'),
(175, 'PF', 'French Polynesia'),
(176, 'PG', 'Papua New Guinea'),
(177, 'PH', 'Philippines'),
(178, 'PK', 'Pakistan'),
(179, 'PL', 'Poland'),
(180, 'PM', 'Saint Pierre and Miquelon'),
(181, 'PN', 'Pitcairn Islands'),
(182, 'PR', 'Puerto Rico'),
(183, 'PS', 'Palestine'),
(184, 'PT', 'Portugal'),
(185, 'PW', 'Palau'),
(186, 'PY', 'Paraguay'),
(187, 'QA', 'Qatar'),
(188, 'RE', 'Réunion'),
(189, 'RO', 'Romania'),
(190, 'RS', 'Serbia'),
(191, 'RU', 'Russia'),
(192, 'RW', 'Rwanda'),
(193, 'SA', 'Saudi Arabia'),
(194, 'SB', 'Solomon Islands'),
(195, 'SC', 'Seychelles'),
(196, 'SD', 'Sudan'),
(197, 'SE', 'Sweden'),
(198, 'SG', 'Singapore'),
(199, 'SH', 'Saint Helena'),
(200, 'SI', 'Slovenia'),
(201, 'SJ', 'Svalbard and Jan Mayen'),
(202, 'SK', 'Slovakia'),
(203, 'SL', 'Sierra Leone'),
(204, 'SM', 'San Marino'),
(205, 'SN', 'Senegal'),
(206, 'SO', 'Somalia'),
(207, 'SR', 'Suriname'),
(208, 'SS', 'South Sudan'),
(209, 'ST', 'São Tomé and Príncipe'),
(210, 'SV', 'El Salvador'),
(211, 'SX', 'Sint Maarten'),
(212, 'SY', 'Syria'),
(213, 'SZ', 'Swaziland'),
(214, 'TC', 'Turks and Caicos Islands'),
(215, 'TD', 'Chad'),
(216, 'TF', 'French Southern Territories'),
(217, 'TG', 'Togo'),
(218, 'TH', 'Thailand'),
(219, 'TJ', 'Tajikistan'),
(220, 'TK', 'Tokelau'),
(221, 'TL', 'East Timor'),
(222, 'TM', 'Turkmenistan'),
(223, 'TN', 'Tunisia'),
(224, 'TO', 'Tonga'),
(225, 'TR', 'Turkey'),
(226, 'TT', 'Trinidad and Tobago'),
(227, 'TV', 'Tuvalu'),
(228, 'TW', 'Taiwan'),
(229, 'TZ', 'Tanzania'),
(230, 'UA', 'Ukraine'),
(231, 'UG', 'Uganda'),
(232, 'UM', 'U.S. Minor Outlying Islands'),
(233, 'US', 'United States'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VA', 'Vatican City'),
(237, 'VC', 'Saint Vincent and the Grenadines'),
(238, 'VE', 'Venezuela'),
(239, 'VG', 'British Virgin Islands'),
(240, 'VI', 'U.S. Virgin Islands'),
(241, 'VN', 'Vietnam'),
(242, 'VU', 'Vanuatu'),
(243, 'WF', 'Wallis and Futuna'),
(244, 'WS', 'Samoa'),
(245, 'XK', 'Kosovo'),
(246, 'YE', 'Yemen'),
(247, 'YT', 'Mayotte'),
(248, 'ZA', 'South Africa'),
(249, 'ZM', 'Zambia'),
(250, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `sms_days`
--

CREATE TABLE `sms_days` (
  `id` bigint(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sms_days`
--

INSERT INTO `sms_days` (`id`, `name`) VALUES
(1, 'Sunday'),
(2, 'Monday'),
(3, 'Tuesday'),
(4, 'Wednesday'),
(5, 'Thursday'),
(6, 'Friday'),
(7, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `sms_failed_jobs`
--

CREATE TABLE `sms_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_fee_management`
--

CREATE TABLE `sms_fee_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `fee_paid_date` varchar(255) NOT NULL,
  `fee_description` varchar(255) NOT NULL,
  `acdamic_year_id` int(11) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `payment_type_id` bigint(11) UNSIGNED NOT NULL,
  `paid_to` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_fee_management`
--

INSERT INTO `sms_fee_management` (`id`, `student_id`, `fee_type_id`, `fee_paid_date`, `fee_description`, `acdamic_year_id`, `payment_amount`, `payment_type_id`, `paid_to`, `created_at`, `updated_at`) VALUES
(1, 51, 1, '2023-04-27', 'asdfsdf', 2, 123, 1, 66, '2023-04-27 06:04:13', '2023-04-27 06:04:13'),
(2, 51, 1, '2023-04-27', 'noting', 2, 1231312, 1, 66, '2023-04-27 06:24:39', '2023-04-27 06:24:39'),
(3, 49, 1, '2023-04-27', 'asdfasd', 2, 123, 1, 66, '2023-04-27 07:24:22', '2023-04-27 07:24:22'),
(4, 49, 1, '2023-04-27', '', 2, 12312, 1, 66, '2023-04-27 07:25:31', '2023-04-27 07:25:31'),
(5, 49, 1, '2023-04-27', '', 2, 432, 2, 66, '2023-04-27 07:25:48', '2023-04-27 07:25:48'),
(6, 47, 2, '2023-04-27', 'noting', 2, 8900, 1, 66, '2023-04-27 08:05:16', '2023-04-27 08:05:16'),
(7, 49, 1, '2023-04-28', 'testing', 2, 123123123, 2, 66, '2023-04-28 04:47:53', '2023-04-28 04:47:53'),
(8, 47, 2, '2023-04-28', 'sdfasfdasdfasdf', 2, 2323, 2, 66, '2023-04-28 06:40:40', '2023-04-28 06:40:40'),
(9, 47, 1, '2023-04-28', 'asdfsadfasd', 2, 1231, 2, 66, '2023-04-28 06:40:54', '2023-04-28 06:40:54'),
(10, 47, 4, '2023-04-28', 'safdfasdf', 2, 4321, 1, 66, '2023-04-28 06:41:11', '2023-04-28 06:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `sms_fee_types`
--

CREATE TABLE `sms_fee_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `school_id` bigint(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_fee_types`
--

INSERT INTO `sms_fee_types` (`id`, `name`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Tution Fee', 0, '2023-04-27 04:54:32', '2023-04-27 12:07:48'),
(2, 'Bus Fees 123', 1, '2023-04-27 04:54:43', '2023-04-28 01:26:48'),
(3, 'Fine', 1, '2023-04-27 04:54:56', '2023-04-27 04:54:56'),
(4, 'Dress Fee', 1, '2023-04-27 04:55:06', '2023-04-27 04:55:06'),
(5, 'Tour Fee', 1, '2023-04-27 07:43:18', '2023-04-27 07:43:18'),
(6, 'Discount', 1, '2023-04-27 07:48:30', '2023-04-27 07:48:30'),
(7, 'rserser', 1, '2023-04-27 12:11:13', '2023-04-27 12:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `sms_genders`
--

CREATE TABLE `sms_genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_genders`
--

INSERT INTO `sms_genders` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Male', '2023-04-12 07:29:49', '2023-04-12 07:29:49'),
(2, 'Female', '2023-04-12 07:29:49', '2023-04-12 07:29:49'),
(3, 'Other', '2023-04-12 07:29:49', '2023-04-12 07:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `sms_master_settings`
--

CREATE TABLE `sms_master_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `current_academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_master_settings`
--

INSERT INTO `sms_master_settings` (`id`, `current_academic_year_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_migrations`
--

CREATE TABLE `sms_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_migrations`
--

INSERT INTO `sms_migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(15, '2023_04_07_070218_roles', 1),
(16, '2023_04_07_072352_create_sessions_table', 1),
(17, '2023_04_07_105545_schools', 2),
(18, '2014_10_12_000000_create_users_table', 1),
(19, '2023_04_10_070958_permissions', 3),
(21, '2023_04_10_121337_permission_modules', 4),
(22, '2023_04_10_074227_permission_role', 5),
(24, '2023_04_11_151551_user_address', 6),
(25, '2023_04_12_072648_genders', 7),
(27, '2023_04_12_105743_students', 8),
(29, '2023_04_13_104833_parents', 9),
(30, '2023_04_13_111913_subdomains', 10),
(31, '2023_04_17_093746_student_address', 11),
(32, '2023_04_17_114244_classes', 12),
(33, '2023_04_17_114251_sections', 12),
(34, '2023_04_17_114407_classes_sections', 12),
(35, '2023_04_18_131757_student_attendance', 13),
(36, '2023_04_19_071305_attendance_status_types', 14),
(37, '2023_04_25_091601_create_time_tables_table', 15),
(38, '2023_04_27_080513_create_fee_management_table', 16),
(39, '2023_04_27_091307_create_acdamic_years_table', 17),
(40, '2023_04_27_092238_create_fee_types_table', 18),
(41, '2023_04_27_092746_create_payment_types_table', 19),
(42, '2023_04_27_111201_create_master_settings_table', 20),
(43, '2023_04_27_174235_create_studen_fees_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `sms_parents`
--

CREATE TABLE `sms_parents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 4,
  `school_id` int(11) DEFAULT NULL,
  `student_registration_number` varchar(150) NOT NULL,
  `primary_name` varchar(255) DEFAULT NULL,
  `primary_phone` varchar(255) DEFAULT NULL,
  `primary_alt_phone` varchar(255) DEFAULT NULL,
  `primary_email` varchar(255) DEFAULT NULL,
  `primary_education` varchar(255) DEFAULT NULL,
  `primary_ocupation` varchar(255) DEFAULT NULL,
  `primary_relation` int(11) DEFAULT NULL,
  `secondary_name` varchar(255) DEFAULT NULL,
  `secondary_phone` varchar(255) DEFAULT NULL,
  `secondary_alt_phone` varchar(255) DEFAULT NULL,
  `secondary_email` varchar(255) DEFAULT NULL,
  `secondary_education` varchar(255) DEFAULT NULL,
  `secondary_ocupation` varchar(255) DEFAULT NULL,
  `secondary_relation` varchar(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_parents`
--

INSERT INTO `sms_parents` (`id`, `student_id`, `role`, `school_id`, `student_registration_number`, `primary_name`, `primary_phone`, `primary_alt_phone`, `primary_email`, `primary_education`, `primary_ocupation`, `primary_relation`, `secondary_name`, `secondary_phone`, `secondary_alt_phone`, `secondary_email`, `secondary_education`, `secondary_ocupation`, `secondary_relation`, `password`, `created_at`, `updated_at`) VALUES
(4, 43, 4, 1, '1234567890', 'fasdf', '9765432456', '', '', '', '', 1, '', '', '', '', '', '', '', '$2y$10$jrHP3Vm3iVP.2SQBRgnRReVVJiYfjyu4PSnbe/8xYa17sZ0fLsH5S', '2023-04-17 04:02:30', '2023-04-17 04:19:48'),
(5, 44, 4, 1, 'asdfasdfasdf', 'asdfasd', '9876543223', '', '', '', '', 2, '', '', '', '', '', '', '', '$2y$10$UX0A6i8SQkn45QVELmLYJugHx2jK98QcThGVmMr2VkHS7hew.Dv4S', '2023-04-17 04:26:47', '2023-04-17 04:26:47'),
(6, 45, 4, 1, '23424234234234', 'fasdfasdf', '9765432456', 'fasdf', 'asdfas', 'sdfasdf', 'adf', 2, 'asdf', '9345234243', '9234234324', 'asdfasd', 'asdfasdf', 'asfdadfs', '2', '$2y$10$JyBjyL5aBOTS1eFhUsEBUu4njgGoLekIpkehaW4c5BEni6Tz729Ie', '2023-04-17 04:27:42', '2023-04-17 04:40:50'),
(7, 46, 4, 1, '123324324234234', 'gsdfgsdfg', '9765432456', '9876543456', 'sdfgsdfg', 'sdfgsdfg', 'sdfgsdfg', 1, 'gsdfgsdfg', '9345234243', '', 'sdfgd@fasdfa.dsfasdfas', 'sdgsdgfsd', 'gsdfgsdfgsdgff', '1', '$2y$10$n8cnYOYsCIXtRDiHl35sbONw2KFTdYxrXO75cExB4YVRQ4mbBa0OS', '2023-04-17 05:54:52', '2023-04-17 05:54:52'),
(8, 47, 4, 1, 'ABC123', 'Veera brahmama gandham', '9666938409', '9951307660', 'veerabrahmamgandham@gmail.com', '10th class', 'Travels', 1, '', '', '', '', '', '', '', '$2y$10$gbxhdXYEQo3HYX3zGDHL7OD4nwXrNf15XtuxxbcJRniSGReXWwPtW', '2023-04-18 06:01:25', '2023-04-18 06:01:25'),
(9, 48, 4, 1, 'ABC111', 'Prasad Kotiboina', '9876543211', '', '', '', '', 1, '', '', '', '', '', '', '', '$2y$10$Zb1HFXtADqSmSKABtoyGi.fCE6XCsh5ryeywDvSxpf2t8lZxOkOrm', '2023-04-18 07:56:21', '2023-04-18 07:56:21'),
(10, 49, 4, 1, 'ABC222', 'Vardhan', '9876543212', '', '', '', '', 1, '', '', '', '', '', '', '', '$2y$10$Z6djTdp57Yc92f26JhmTgeVybOt8/mRd6usq3kKaUZQYEB0vX5LlG', '2023-04-18 08:17:22', '2023-04-18 08:17:22'),
(11, 50, 4, 1, 'ABC321', 'vardhan', '9876543212', '', '', '', '', 1, '', '', '', '', '', '', '', '$2y$10$w.wm9iNq9N7Y2b85oUQZpezKWhXFVmVr7poJL1gIQ.Web2qHGT9pm', '2023-04-19 00:42:23', '2023-04-19 00:42:23'),
(12, 51, 4, 1, 'ABC124', 'Arun', '8765432123', '', '', '', '', 2, '', '', '', '', '', '', '', '$2y$10$QhM0k1dae2CLRIbbSXnVEuyYTdp.BB9MNkh6GW1nB94/3QkWC/m92', '2023-04-19 01:03:44', '2023-04-19 01:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `sms_password_resets`
--

CREATE TABLE `sms_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_password_reset_tokens`
--

CREATE TABLE `sms_password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_password_reset_tokens`
--

INSERT INTO `sms_password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('arun@arun.com', '$2y$10$AKf/zXp4y4CgA3HjYFecc.Pi9deu6qV.ApiCGpjsOMaz.T99cgnT2', '2023-04-13 01:11:37'),
('student@gmail.com', '$2y$10$SgzP9QhDA88MG4vonDvy2eN48bqD2WnDaLk.8HWz/jLhSICTob5cS', '2023-04-07 05:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `sms_payment_types`
--

CREATE TABLE `sms_payment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_payment_types`
--

INSERT INTO `sms_payment_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cash', '2023-04-27 11:04:16', '2023-04-27 11:04:16'),
(2, 'UPI', '2023-04-27 11:04:16', NULL),
(3, 'Debit/Credit Card', '2023-04-27 11:04:40', NULL),
(4, 'Cheque', '2023-04-27 11:04:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_periods`
--

CREATE TABLE `sms_periods` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `period_name` varchar(150) NOT NULL,
  `school_id` int(11) NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sms_periods`
--

INSERT INTO `sms_periods` (`id`, `period_name`, `school_id`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, 'Period 1', 1, '05:18:00', '16:19:00', '2023-04-25 07:48:24', '2023-04-25 11:42:02'),
(2, 'Period 2', 1, '05:18:00', '16:19:00', '2023-04-25 07:49:26', '2023-04-25 11:42:09'),
(3, 'Period 3', 1, '05:26:00', '13:23:00', '2023-04-25 07:53:29', '2023-04-25 11:42:17'),
(4, 'Period 4', 1, '05:18:00', '16:19:00', '2023-04-25 08:04:44', '2023-04-25 11:42:24'),
(5, 'Launch break', 1, '01:18:00', '16:19:00', '2023-04-25 08:06:02', '2023-04-25 11:42:40'),
(6, 'Period 5', 1, '14:05:00', '14:56:00', '2023-04-25 08:32:39', '2023-04-25 11:42:49'),
(7, 'Period 6', 1, '18:12:00', '19:16:00', '2023-04-25 11:43:05', '2023-04-25 11:43:05'),
(8, 'Period 7', 1, '16:14:00', '19:15:00', '2023-04-25 11:43:18', '2023-04-25 11:43:18'),
(9, 'Period 8', 1, '01:14:00', '18:15:00', '2023-04-25 11:43:31', '2023-04-25 11:43:31'),
(10, 'Period 9', 1, '08:04:00', '20:05:00', '2023-04-27 13:32:29', '2023-04-27 13:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `sms_permission_module`
--

CREATE TABLE `sms_permission_module` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_permission_module`
--

INSERT INTO `sms_permission_module` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Student', 'Student module', b'1', '2023-04-10 23:37:43', '2023-04-15 22:38:01'),
(2, 'Teacher', 'Teacher module', b'1', '2023-04-10 23:37:55', '2023-04-10 23:37:55'),
(3, 'Parent', 'Parent Module', b'1', '2023-04-10 23:38:12', '2023-04-10 23:38:12'),
(4, 'Library', 'Library Module', b'1', '2023-04-10 23:38:39', '2023-04-10 23:38:39'),
(5, 'Office Admin', 'Office Admin Module.', b'1', '2023-04-10 23:39:02', '2023-04-10 23:39:14'),
(6, 'dsfs', 'dfsdf', b'1', '2023-04-13 03:51:01', '2023-04-13 03:51:01'),
(7, 'fasfdas', 'sadfasdf', b'1', '2023-04-13 03:52:38', '2023-04-13 03:52:38'),
(8, 'fas', 'fasfdsadf', b'1', '2023-04-13 03:52:47', '2023-04-13 03:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `sms_personal_access_tokens`
--

CREATE TABLE `sms_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_roles`
--

CREATE TABLE `sms_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_roles`
--

INSERT INTO `sms_roles` (`id`, `name`, `description`, `school_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Super admin have all rights to add, edit and delete permissions for every thing.', 0, b'1', '2023-04-07 07:42:43', '2023-04-07 07:42:43'),
(2, 'School Admin', 'Super admin have all rights to add, edit and delete permissions for every thing related to schools.', 0, b'1', '2023-04-07 07:42:43', '2023-04-07 07:42:43'),
(3, 'Teacher', 'Teacher can mark attendance, conduct assignments or tests online, can update offline marks and grades, contact with parents and related stuff to students.', 0, b'1', '2023-04-07 07:42:43', '2023-04-07 07:42:43'),
(4, 'Parent', 'Parent can check there children marks, attendance, grades, reports, activity, apply leave and can contact teacher.', 0, b'1', '2023-04-07 07:42:43', '2023-04-07 07:42:43'),
(5, 'Student', 'Student can check there marks, attendance, analysis, grades, reports, time table, home work, period or lunch timings and can write there online test.', 0, b'1', '2023-04-07 07:42:43', '2023-04-07 07:42:43'),
(17, 'Librarian', 'Librarian will manage all the books inventory in library and can mange the book status and book exact location', 46, b'1', '2023-04-10 23:41:31', '2023-04-10 23:41:31'),
(18, 'Office Admin', 'Office admin only can view all the school data.', 46, b'1', '2023-04-10 23:42:16', '2023-04-10 23:42:53'),
(19, 'Student', 'asdfsd', 46, b'1', '2023-04-11 01:31:29', '2023-04-11 01:31:29'),
(20, 'Role testing', 'asdfasdf', 46, b'1', '2023-04-11 01:38:32', '2023-04-11 01:38:32'),
(21, 'ASd', 'ADSas', 1, b'1', '2023-04-25 01:06:12', '2023-04-25 01:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `sms_role_permissions`
--

CREATE TABLE `sms_role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `is_view` bit(1) NOT NULL DEFAULT b'0',
  `is_add` bit(1) NOT NULL DEFAULT b'0',
  `is_edit` bit(1) NOT NULL DEFAULT b'0',
  `is_delete` bit(1) NOT NULL DEFAULT b'0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_role_permissions`
--

INSERT INTO `sms_role_permissions` (`id`, `role_id`, `module_id`, `school_id`, `is_view`, `is_add`, `is_edit`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '3', '1', '1', b'0', b'1', b'0', b'0', '2023-04-15 04:13:37', '2023-04-15 04:13:37'),
(2, '3', '2', '1', b'0', b'0', b'0', b'0', '2023-04-15 04:13:37', '2023-04-15 04:13:37'),
(3, '3', '3', '1', b'0', b'0', b'0', b'0', '2023-04-15 04:13:37', '2023-04-15 04:13:37'),
(4, '3', '4', '1', b'0', b'0', b'0', b'0', '2023-04-15 04:13:37', '2023-04-15 04:13:37'),
(5, '3', '5', '1', b'0', b'0', b'0', b'0', '2023-04-15 04:13:37', '2023-04-15 04:13:37'),
(6, '3', '6', '1', b'0', b'0', b'0', b'0', '2023-04-15 04:13:37', '2023-04-15 04:13:37'),
(7, '3', '7', '1', b'0', b'0', b'0', b'0', '2023-04-15 04:13:37', '2023-04-15 04:13:37'),
(8, '3', '8', '1', b'0', b'0', b'0', b'0', '2023-04-15 04:13:37', '2023-04-15 04:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `sms_schools`
--

CREATE TABLE `sms_schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_description` varchar(255) NOT NULL,
  `school_started_on` varchar(255) DEFAULT NULL,
  `school_image` varchar(255) DEFAULT NULL,
  `school_land_line` varchar(255) DEFAULT NULL,
  `school_phone1` varchar(255) DEFAULT NULL,
  `school_phone2` varchar(255) DEFAULT NULL,
  `school_address1` varchar(255) DEFAULT NULL,
  `school_address2` varchar(255) DEFAULT NULL,
  `school_street` varchar(255) NOT NULL,
  `school_city` varchar(255) DEFAULT NULL,
  `school_district` varchar(255) DEFAULT NULL,
  `school_state` varchar(255) DEFAULT NULL,
  `school_pincode` varchar(255) DEFAULT NULL,
  `school_meta_title` varchar(255) DEFAULT NULL,
  `school_status` bit(1) NOT NULL DEFAULT b'1',
  `school_short_name` varchar(255) DEFAULT NULL,
  `school_short_description` varchar(255) DEFAULT NULL,
  `school_subscription` varchar(255) DEFAULT '1',
  `school_favicon` varchar(255) DEFAULT NULL,
  `subdomain_id` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_schools`
--

INSERT INTO `sms_schools` (`id`, `school_name`, `school_description`, `school_started_on`, `school_image`, `school_land_line`, `school_phone1`, `school_phone2`, `school_address1`, `school_address2`, `school_street`, `school_city`, `school_district`, `school_state`, `school_pincode`, `school_meta_title`, `school_status`, `school_short_name`, `school_short_description`, `school_subscription`, `school_favicon`, `subdomain_id`, `created_at`, `updated_at`) VALUES
(1, 'Green Land', 'My green land schools', '1997-06-10', 'uploads/schools/1/SCHOOL_IMAGE_IMG_3458 - Croped (1)-min (2)_16814747059203.jpg', '9876545678', '8674523452', '6235234523', '', '', '', '', '', '', '', '', b'1', 'Green Land', '', '1', 'uploads/schools/2/FAVICON_favicon_16814951692904.ico', '1681474602', '2023-04-14 06:48:25', '2023-04-14 06:48:25'),
(2, 'Ashram Public Schools', 'Ashram Public Schools', '', NULL, '', '', '', '', '', '', '', '', '', '', '', b'1', 'Ashram', '', '1', 'uploads/schools/2/FAVICON_favicon_16814951692904.ico', '1681474618', '2023-04-14 06:48:56', '2023-04-14 12:29:29'),
(3, 'woods School', '', '1993-04-02', NULL, '', '', '', '', '', '', '', '', '', '', '', b'1', '', '', '1', NULL, '1681474625', '2023-04-14 06:50:05', '2023-04-14 06:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `sms_sections`
--

CREATE TABLE `sms_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_sections`
--

INSERT INTO `sms_sections` (`id`, `school_id`, `name`, `created_at`, `updated_at`) VALUES
(17, 1, 'section A', '2023-04-18 05:42:12', '2023-04-18 05:42:12'),
(18, 1, 'Section B', '2023-04-18 05:42:17', '2023-04-18 05:42:17'),
(19, 1, 'Section C', '2023-04-18 05:42:21', '2023-04-18 05:42:21'),
(20, 1, 'Section D', '2023-04-18 05:42:26', '2023-04-18 05:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `sms_sessions`
--

CREATE TABLE `sms_sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_sessions`
--

INSERT INTO `sms_sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jv2H9yYVthr48xU68Dw3WNnshiNlt8RXDvo9pUmv', 66, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoidmdiOEFzVTRZSkl0dXlFVlU3WWg0Z1Ryb1c3NnRqck1ndURHZENuVyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2dyZWVubGFuZC9zY2hvb2xhZG1pbi9mZWUvc3R1ZGVudHMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjY7czoxOToiU0NIT09MX0ZBVklDT05fUEFUSCI7czo1MjoidXBsb2Fkcy9zY2hvb2xzLzIvRkFWSUNPTl9mYXZpY29uXzE2ODE0OTUxNjkyOTA0LmljbyI7czo5OiJzdWJkb21haW4iO3M6OToiZ3JlZW5sYW5kIjtzOjExOiJwZXJtaXNzaW9ucyI7YTowOnt9czo3OiJtb2R1bGVzIjthOjg6e3M6NzoiU3R1ZGVudCI7aToxO3M6NzoiVGVhY2hlciI7aToyO3M6NjoiUGFyZW50IjtpOjM7czo3OiJMaWJyYXJ5IjtpOjQ7czoxMjoiT2ZmaWNlIEFkbWluIjtpOjU7czo0OiJkc2ZzIjtpOjY7czo3OiJmYXNmZGFzIjtpOjc7czozOiJmYXMiO2k6ODt9fQ==', 1682684909);

-- --------------------------------------------------------

--
-- Table structure for table `sms_states`
--

CREATE TABLE `sms_states` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sms_states`
--

INSERT INTO `sms_states` (`id`, `name`, `country_id`) VALUES
(1, 'ANDHRA PRADESH', 105),
(2, 'ASSAM', 105),
(3, 'ARUNACHAL PRADESH', 105),
(4, 'BIHAR', 105),
(5, 'GUJRAT', 105),
(6, 'HARYANA', 105),
(7, 'HIMACHAL PRADESH', 105),
(8, 'JAMMU & KASHMIR', 105),
(9, 'KARNATAKA', 105),
(10, 'KERALA', 105),
(11, 'MADHYA PRADESH', 105),
(12, 'MAHARASHTRA', 105),
(13, 'MANIPUR', 105),
(14, 'MEGHALAYA', 105),
(15, 'MIZORAM', 105),
(16, 'NAGALAND', 105),
(17, 'ORISSA', 105),
(18, 'PUNJAB', 105),
(19, 'RAJASTHAN', 105),
(20, 'SIKKIM', 105),
(21, 'TELANGANA', 105),
(22, 'TAMIL NADU', 105),
(23, 'TRIPURA', 105),
(24, 'UTTAR PRADESH', 105),
(25, 'WEST BENGAL', 105),
(26, 'DELHI', 105),
(27, 'GOA', 105),
(28, 'PONDICHERY', 105),
(29, 'LAKSHDWEEP', 105),
(30, 'DAMAN & DIU', 105),
(31, 'DADRA & NAGAR', 105),
(32, 'CHANDIGARH', 105),
(33, 'ANDAMAN & NICOBAR', 105),
(34, 'UTTARANCHAL', 105),
(35, 'JHARKHAND', 105),
(36, 'CHATTISGARH', 105);

-- --------------------------------------------------------

--
-- Table structure for table `sms_students`
--

CREATE TABLE `sms_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registration_number` varchar(100) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `school_id` int(5) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `sur_name` varchar(200) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 5,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_students`
--

INSERT INTO `sms_students` (`id`, `registration_number`, `roll_no`, `school_id`, `first_name`, `last_name`, `sur_name`, `gender`, `dob`, `email`, `phone`, `role`, `password`, `profile_photo`, `class_id`, `section_id`, `created_at`, `updated_at`) VALUES
(47, 'ABC123', 3, 1, 'Arun Sai', '', 'Gandham', 1, '1998-12-21', 'arunsaigandham1998@gmail.com', '9121855669', 5, '$2y$10$AlBbbGnJ2y46AdcJjsprCeTB4Ysp26SWLguDNWlNhnUp/0k5CM8Ku', 'uploads/schools/1/students/1681817485_android-chrome-192x192_16818174851701.png', 9, 18, '2023-04-18 06:01:25', '2023-04-18 12:34:26'),
(48, 'ABC111', 2, 1, 'Venkata Naga', 'Vyshnavi', 'Kotiboina', 2, '2004-08-11', '', '', 5, '$2y$10$0fjOqflZ.v8I0q79y3NZueiliKi99.1EXHZ4lKi6S1HwfLIeIDegC', NULL, 9, 17, '2023-04-18 07:56:21', '2023-04-28 00:23:20'),
(49, 'ABC222', 3, 1, 'Surya', '', 'Chakra', 1, '2023-04-05', '', '', 5, '$2y$10$Xt5cVD2HYdXYAnEWtBrYnOtL5DArkx/WJgbxQ5rf0xrWMIip/.TRe', NULL, 9, 18, '2023-04-18 08:17:22', '2023-04-19 01:04:24'),
(50, 'ABC321', 4, 1, 'Hari Krishna', '', 'Bala', 1, '1994-06-15', '', '', 5, '$2y$10$5vU4nqIypqzvHW4ZEUq1ruGqDQkSB0m1xeBJ2yzc/C9TE73pV6DrG', 'uploads/schools/1/students/1681884743_ashish_16818847437070.png', 9, 18, '2023-04-19 00:42:23', '2023-04-19 00:42:23'),
(51, 'ABC124', 5, 1, 'Varun', '', 'Gandham', 1, '2023-03-30', '', '8989576984', 5, '$2y$10$7PeV3rKrhWrU5GD.jP/lc.gWQzxa8bhrcm.5CKFXmC8Iq7oNpeEmq', NULL, 9, 18, '2023-04-19 01:03:44', '2023-04-19 01:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `sms_student_address`
--

CREATE TABLE `sms_student_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `d_no` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_student_address`
--

INSERT INTO `sms_student_address` (`id`, `student_id`, `d_no`, `street`, `city`, `district`, `state`, `pincode`, `created_at`, `updated_at`) VALUES
(1, NULL, 'fasd', 'fasdfsadf', 'asdfasd', 'asdfadsf', 'asdfasdf', 'fasdfasdf', '2023-04-17 04:26:47', '2023-04-17 04:26:47'),
(2, 45, 'fasdfsa', 'dfsadfasfd', 'asdf', 'sadfasdfasdf', 'asdfasdf', '243234234', '2023-04-17 04:27:42', '2023-04-17 04:27:42'),
(3, 46, 'sdfgsdfgsfdg', 'dfgsdfgsdf', 'gsdfgsd', 'gfsdfgsdfgs', 'gsdfgsdf', '32423424', '2023-04-17 05:54:52', '2023-04-17 05:54:52'),
(4, 47, '3-41', 'NALLAVARI STREET', 'kakinnada', 'east godavari', 'Andhra pradesh', '533005', '2023-04-18 06:01:25', '2023-04-18 06:01:25'),
(5, 48, '', '', '', '', '', '', '2023-04-18 07:56:21', '2023-04-18 07:56:21'),
(6, 49, '', '', '', '', '', '', '2023-04-18 08:17:22', '2023-04-18 08:17:22'),
(7, 50, '', '', '', '', '', '', '2023-04-19 00:42:23', '2023-04-19 00:42:23'),
(8, 51, '', '', '', '', '', '', '2023-04-19 01:03:44', '2023-04-19 01:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `sms_student_attendance`
--

CREATE TABLE `sms_student_attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_student_attendance`
--

INSERT INTO `sms_student_attendance` (`id`, `student_id`, `status_id`, `date`, `created_at`, `updated_at`) VALUES
(37, 47, 1, '2023-04-19', '2023-04-19 05:21:39', '2023-04-19 05:28:52'),
(38, 49, 2, '2023-04-19', '2023-04-19 05:21:39', '2023-04-19 05:21:39'),
(39, 50, 2, '2023-04-19', '2023-04-19 05:21:39', '2023-04-24 02:32:04'),
(40, 51, 3, '2023-04-19', '2023-04-19 05:21:39', '2023-04-19 05:22:21'),
(41, 48, 3, '2023-04-19', '2023-04-19 05:22:27', '2023-04-19 05:22:31'),
(42, 47, 1, '2023-04-18', '2023-04-19 05:22:44', '2023-04-19 05:22:44'),
(43, 49, 1, '2023-04-18', '2023-04-19 05:22:44', '2023-04-19 05:22:44'),
(44, 50, 1, '2023-04-18', '2023-04-19 05:22:44', '2023-04-19 05:22:44'),
(45, 51, 1, '2023-04-18', '2023-04-19 05:22:44', '2023-04-19 05:22:44'),
(46, 47, 1, '2023-04-24', '2023-04-24 02:30:38', '2023-04-24 02:30:38'),
(47, 49, 3, '2023-04-24', '2023-04-24 02:30:38', '2023-04-24 02:35:12'),
(48, 50, 2, '2023-04-24', '2023-04-24 02:30:38', '2023-04-24 02:30:38'),
(49, 51, 1, '2023-04-24', '2023-04-24 02:30:38', '2023-04-24 02:30:38'),
(50, 47, 1, '2023-04-25', '2023-04-24 23:42:14', '2023-04-24 23:42:14'),
(51, 49, 4, '2023-04-25', '2023-04-24 23:42:14', '2023-04-24 23:47:41'),
(52, 50, 1, '2023-04-25', '2023-04-24 23:42:14', '2023-04-24 23:42:14'),
(53, 51, 2, '2023-04-25', '2023-04-24 23:42:14', '2023-04-24 23:46:25'),
(54, 47, 2, '2023-04-27', '2023-04-27 02:20:33', '2023-04-27 02:20:33'),
(55, 49, 2, '2023-04-27', '2023-04-27 02:20:33', '2023-04-27 02:20:46'),
(56, 50, 1, '2023-04-27', '2023-04-27 02:20:33', '2023-04-27 02:20:33'),
(57, 51, 1, '2023-04-27', '2023-04-27 02:20:33', '2023-04-27 02:20:33'),
(58, 48, 2, '2023-04-28', '2023-04-28 00:01:11', '2023-04-28 00:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `sms_student_fee`
--

CREATE TABLE `sms_student_fee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `tution_fee` bigint(22) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_student_fee`
--

INSERT INTO `sms_student_fee` (`id`, `student_id`, `academic_id`, `tution_fee`, `created_at`, `updated_at`) VALUES
(1, 48, 2, 34545, '2023-04-28 00:20:14', '2023-04-28 00:22:54'),
(2, 48, 3, 41234, '2023-04-28 00:23:20', '2023-04-28 00:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `sms_subdomains`
--

CREATE TABLE `sms_subdomains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subdomain` varchar(255) NOT NULL,
  `strong_id` varchar(11) NOT NULL,
  `status` bit(4) NOT NULL DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_subdomains`
--

INSERT INTO `sms_subdomains` (`id`, `subdomain`, `strong_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'greenland', '1681474602', b'0001', '2023-04-14 06:46:50', '2023-04-14 06:46:50'),
(2, 'ashram', '1681474618', b'0001', '2023-04-14 06:47:03', '2023-04-14 06:47:03'),
(3, 'woods', '1681474625', b'0001', '2023-04-14 06:47:15', '2023-04-14 06:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `sms_subjects`
--

CREATE TABLE `sms_subjects` (
  `id` bigint(11) NOT NULL,
  `subject_name` varchar(200) NOT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sms_subjects`
--

INSERT INTO `sms_subjects` (`id`, `subject_name`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Telugu', 1, '2023-04-25 12:13:48', '2023-04-26 09:48:53'),
(2, 'English 123', 1, '2023-04-25 12:13:48', '2023-04-26 04:19:30'),
(3, 'M1', 1, '2023-04-26 04:19:39', '2023-04-26 04:29:19'),
(4, 'M2', 1, '2023-04-26 04:29:24', '2023-04-26 04:29:24'),
(5, 'M3', 1, '2023-04-26 04:29:32', '2023-04-26 04:29:32'),
(6, 'PWA test', 1, '2023-04-26 05:37:01', '2023-04-26 05:37:01'),
(7, 'PWA test 2', 1, '2023-04-26 05:37:10', '2023-04-26 05:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `sms_time_tables`
--

CREATE TABLE `sms_time_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_time_tables`
--

INSERT INTO `sms_time_tables` (`id`, `school_id`, `day_id`, `class_id`, `section_id`, `period_id`, `subject_id`, `staff_id`, `created_at`, `updated_at`) VALUES
(55, 1, 2, 9, 17, 1, 1, 69, '2023-04-25 23:53:33', '2023-04-25 23:53:33'),
(56, 1, 3, 9, 17, 1, 2, 69, '2023-04-25 23:53:33', '2023-04-25 23:53:33'),
(57, 1, 4, 9, 17, 1, 2, 69, '2023-04-25 23:53:33', '2023-04-25 23:53:33'),
(58, 1, 5, 9, 17, 1, 1, 69, '2023-04-25 23:53:33', '2023-04-25 23:53:33'),
(59, 1, 6, 9, 17, 1, 1, 69, '2023-04-25 23:53:33', '2023-04-25 23:53:33'),
(60, 1, 7, 9, 17, 1, 1, 69, '2023-04-25 23:53:33', '2023-04-25 23:53:33'),
(63, 1, 4, 9, 18, 1, 4, 69, '2023-04-25 23:54:06', '2023-04-26 04:34:39'),
(64, 1, 5, 9, 18, 1, 5, 69, '2023-04-25 23:54:06', '2023-04-26 04:34:39'),
(65, 1, 6, 9, 18, 1, 1, 69, '2023-04-25 23:54:06', '2023-04-26 04:34:39'),
(66, 1, 7, 9, 18, 1, 4, 69, '2023-04-25 23:54:06', '2023-04-26 04:34:39'),
(72, 1, 4, 9, 18, 3, 1, 69, '2023-04-26 00:23:58', '2023-04-26 00:23:58'),
(73, 1, 2, 9, 18, 2, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(74, 1, 2, 9, 18, 3, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(75, 1, 2, 9, 18, 4, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(76, 1, 2, 9, 18, 6, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(77, 1, 2, 9, 18, 7, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(78, 1, 2, 9, 18, 8, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(79, 1, 2, 9, 18, 9, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(80, 1, 3, 9, 18, 2, 5, 69, '2023-04-26 00:25:51', '2023-04-26 04:34:39'),
(81, 1, 3, 9, 18, 3, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(82, 1, 3, 9, 18, 4, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(83, 1, 3, 9, 18, 6, 1, 69, '2023-04-26 00:25:51', '2023-04-26 00:25:51'),
(84, 1, 3, 9, 18, 7, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(85, 1, 3, 9, 18, 8, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(86, 1, 3, 9, 18, 9, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(87, 1, 4, 9, 18, 2, 2, 69, '2023-04-26 00:25:52', '2023-04-26 04:34:39'),
(88, 1, 4, 9, 18, 4, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(89, 1, 4, 9, 18, 6, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(90, 1, 4, 9, 18, 7, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(91, 1, 4, 9, 18, 8, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(92, 1, 4, 9, 18, 9, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(93, 1, 5, 9, 18, 2, 3, 69, '2023-04-26 00:25:52', '2023-04-26 04:34:39'),
(94, 1, 5, 9, 18, 3, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(95, 1, 5, 9, 18, 4, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(96, 1, 5, 9, 18, 6, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(97, 1, 5, 9, 18, 7, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(98, 1, 5, 9, 18, 8, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(99, 1, 5, 9, 18, 9, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(100, 1, 6, 9, 18, 2, 5, 69, '2023-04-26 00:25:52', '2023-04-26 04:34:39'),
(101, 1, 6, 9, 18, 3, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(102, 1, 6, 9, 18, 4, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(103, 1, 6, 9, 18, 6, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(104, 1, 6, 9, 18, 7, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(105, 1, 6, 9, 18, 8, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(106, 1, 6, 9, 18, 9, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(107, 1, 7, 9, 18, 2, 2, 69, '2023-04-26 00:25:52', '2023-04-26 04:34:39'),
(108, 1, 7, 9, 18, 3, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(109, 1, 7, 9, 18, 4, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(110, 1, 7, 9, 18, 6, 2, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(111, 1, 7, 9, 18, 7, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(112, 1, 7, 9, 18, 8, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(113, 1, 7, 9, 18, 9, 1, 69, '2023-04-26 00:25:52', '2023-04-26 00:25:52'),
(114, 1, 3, 9, 18, 1, 4, 69, '2023-04-26 02:34:41', '2023-04-26 04:34:39'),
(115, 1, 2, 9, 17, 3, 2, 69, '2023-04-26 02:41:37', '2023-04-26 02:41:37'),
(116, 1, 2, 9, 18, 1, 2, 69, '2023-04-26 03:18:08', '2023-04-26 04:34:39'),
(117, 1, 4, 9, 17, 4, 1, 69, '2023-04-26 03:24:56', '2023-04-26 03:24:56'),
(118, 1, 2, 9, 17, 6, 1, 69, '2023-04-26 03:27:06', '2023-04-26 03:27:06'),
(119, 1, 4, 9, 19, 4, 1, 69, '2023-04-26 03:35:04', '2023-04-26 03:35:04'),
(120, 1, 5, 9, 19, 4, 1, 69, '2023-04-26 03:35:04', '2023-04-26 03:35:04'),
(121, 1, 2, 9, 18, 10, 2, 69, '2023-04-27 08:02:57', '2023-04-27 08:02:57'),
(122, 1, 3, 9, 18, 10, 1, 69, '2023-04-27 08:02:57', '2023-04-27 08:02:57'),
(123, 1, 4, 9, 18, 10, 3, 69, '2023-04-27 08:02:57', '2023-04-27 08:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `sms_users`
--

CREATE TABLE `sms_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` bigint(20) NOT NULL DEFAULT 0,
  `doj` varchar(20) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `alt_phone` varchar(12) DEFAULT NULL,
  `school_id` bigint(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo` blob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_users`
--

INSERT INTO `sms_users` (`id`, `name`, `email`, `role`, `doj`, `phone`, `alt_phone`, `school_id`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin@gmail.com', 1, NULL, NULL, NULL, 0, NULL, '$2y$10$t8zs85MgnqMgiR6ndTQqJ.Vl12632nT0JrVs6sEwokg8UxioEUXOS', NULL, NULL, NULL, 'nIY2oQVOxjmDgVWqPfMGJeOqcvaQW8vi52et58P0M0U7qNa3wyrtNWnUrofp', NULL, NULL, '2023-04-07 02:14:38', '2023-04-07 02:14:38'),
(2, 'School Admin', 'school-admin@gmail.com', 2, NULL, NULL, NULL, NULL, NULL, '$2y$10$jNH5Q9WAZBXHMwOTRBjVxuYMU3dv/pWqmNJPt4d6MdBxIJ52sFwkS', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-07 02:15:44', '2023-04-07 02:15:44'),
(3, 'Teacher', 'teacher@gmail.com', 3, NULL, NULL, NULL, NULL, NULL, '$2y$10$HVUV5Zkv5moGoEJrt1zK5eyGKR/SOadBhtEHnSipr7MUqEjemAzBS', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-07 02:16:05', '2023-04-07 02:16:05'),
(4, 'Staff', 'staff@gmail.com', 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$qqBlTRyu0jyeLCP59JQjsuVIhFR8m4okTXNOKUwMqeSPBjmocOww6', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-07 02:16:40', '2023-04-07 02:16:40'),
(5, 'Student', 'student@gmail.com', 5, NULL, NULL, NULL, NULL, NULL, '$2y$10$OLJNRETCdJFFNO5AWbylAOVjJyTVhQ3ZSOPi1acnGkUoRvlF9cu4m', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-07 02:17:08', '2023-04-07 02:17:08'),
(66, 'Green Land', 'greenland@gmail.com', 2, NULL, NULL, NULL, 1, NULL, '$2y$10$Akv4D2WX0BS/lmP/EVPPIuIiizQdU6cbo1TDdV/V48ei/cQKukpli', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-14 06:48:25', '2023-04-14 06:48:25'),
(67, 'Ashram Public Schools', 'ashram@gmail.com', 2, NULL, NULL, NULL, 2, NULL, '$2y$10$Akv4D2WX0BS/lmP/EVPPIuIiizQdU6cbo1TDdV/V48ei/cQKukpli', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-14 06:48:56', '2023-04-14 06:48:56'),
(68, 'woods School', 'woods@gmail.com', 2, NULL, NULL, NULL, 3, NULL, '$2y$10$.fIxbkhRRnUasF1dwGohxu03qlz2/UpS5e3omXZApFhaqHWwcWtHm', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-14 06:50:05', '2023-04-14 06:50:05'),
(69, 'greenlandstaff', 'greenlandstaff@gmail.com', 3, '', '9876543211', '', 1, NULL, '$2y$10$/0WnzeOGgbGdXBJB2lNrSOPsjIoNDtnP0r1ozCt/5he2jtpnD2qRG', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-14 07:39:00', '2023-04-14 07:39:00'),
(70, 'greenlandstaff', 'ashramstaff@gmail.com', 3, '', '9876543211', '', 2, NULL, '$2y$10$/0WnzeOGgbGdXBJB2lNrSOPsjIoNDtnP0r1ozCt/5he2jtpnD2qRG', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-14 07:39:00', '2023-04-14 07:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `sms_user_address`
--

CREATE TABLE `sms_user_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `house_no` varchar(150) DEFAULT NULL,
  `street` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `district` varchar(200) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `pincode` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_user_address`
--

INSERT INTO `sms_user_address` (`id`, `user_id`, `house_no`, `street`, `city`, `district`, `state`, `pincode`, `created_at`, `updated_at`) VALUES
(2, 54, '22342', 'test 123 street', 'test ciyt', 'test descript', '17', '533003', '2023-04-11 11:22:49', '2023-04-11 11:27:24'),
(3, 53, '111111111111111', '1111111111111', '11111111', '111111111111111', '14', '111111', '2023-04-11 11:38:14', '2023-04-11 11:45:57'),
(4, 55, '', '', '', '', '', '', '2023-04-12 00:05:35', '2023-04-12 00:05:35'),
(5, 69, '', '', '', '', '', '', '2023-04-14 07:39:00', '2023-04-14 07:39:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms_acdamic_years`
--
ALTER TABLE `sms_acdamic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_attendance_types`
--
ALTER TABLE `sms_attendance_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_cities`
--
ALTER TABLE `sms_cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `sms_classes`
--
ALTER TABLE `sms_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_classes_sections_mapping`
--
ALTER TABLE `sms_classes_sections_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_countries`
--
ALTER TABLE `sms_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_days`
--
ALTER TABLE `sms_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_failed_jobs`
--
ALTER TABLE `sms_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sms_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `sms_fee_management`
--
ALTER TABLE `sms_fee_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_fee_types`
--
ALTER TABLE `sms_fee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_genders`
--
ALTER TABLE `sms_genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_master_settings`
--
ALTER TABLE `sms_master_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_migrations`
--
ALTER TABLE `sms_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_parents`
--
ALTER TABLE `sms_parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_password_resets`
--
ALTER TABLE `sms_password_resets`
  ADD KEY `sms_password_resets_email_index` (`email`);

--
-- Indexes for table `sms_password_reset_tokens`
--
ALTER TABLE `sms_password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sms_payment_types`
--
ALTER TABLE `sms_payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_periods`
--
ALTER TABLE `sms_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_permission_module`
--
ALTER TABLE `sms_permission_module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sms_permission_module_name_unique` (`name`);

--
-- Indexes for table `sms_personal_access_tokens`
--
ALTER TABLE `sms_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sms_personal_access_tokens_token_unique` (`token`),
  ADD KEY `sms_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sms_roles`
--
ALTER TABLE `sms_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_role_permissions`
--
ALTER TABLE `sms_role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_schools`
--
ALTER TABLE `sms_schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sms_schools_school_name_unique` (`school_name`);

--
-- Indexes for table `sms_sections`
--
ALTER TABLE `sms_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_sessions`
--
ALTER TABLE `sms_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_sessions_user_id_index` (`user_id`),
  ADD KEY `sms_sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sms_states`
--
ALTER TABLE `sms_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_students`
--
ALTER TABLE `sms_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_student_address`
--
ALTER TABLE `sms_student_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_student_attendance`
--
ALTER TABLE `sms_student_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dtudent_id_to_students` (`student_id`);

--
-- Indexes for table `sms_student_fee`
--
ALTER TABLE `sms_student_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_subdomains`
--
ALTER TABLE `sms_subdomains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_subjects`
--
ALTER TABLE `sms_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_time_tables`
--
ALTER TABLE `sms_time_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_users`
--
ALTER TABLE `sms_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sms_users_email_unique` (`email`),
  ADD KEY `pk_users_fk_schools` (`school_id`);

--
-- Indexes for table `sms_user_address`
--
ALTER TABLE `sms_user_address`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_acdamic_years`
--
ALTER TABLE `sms_acdamic_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sms_attendance_types`
--
ALTER TABLE `sms_attendance_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_cities`
--
ALTER TABLE `sms_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=604;

--
-- AUTO_INCREMENT for table `sms_classes`
--
ALTER TABLE `sms_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sms_classes_sections_mapping`
--
ALTER TABLE `sms_classes_sections_mapping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `sms_countries`
--
ALTER TABLE `sms_countries`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `sms_days`
--
ALTER TABLE `sms_days`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sms_failed_jobs`
--
ALTER TABLE `sms_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_fee_management`
--
ALTER TABLE `sms_fee_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sms_fee_types`
--
ALTER TABLE `sms_fee_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sms_genders`
--
ALTER TABLE `sms_genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_master_settings`
--
ALTER TABLE `sms_master_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_migrations`
--
ALTER TABLE `sms_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `sms_parents`
--
ALTER TABLE `sms_parents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sms_payment_types`
--
ALTER TABLE `sms_payment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_periods`
--
ALTER TABLE `sms_periods`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sms_permission_module`
--
ALTER TABLE `sms_permission_module`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sms_personal_access_tokens`
--
ALTER TABLE `sms_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_roles`
--
ALTER TABLE `sms_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sms_role_permissions`
--
ALTER TABLE `sms_role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sms_schools`
--
ALTER TABLE `sms_schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_sections`
--
ALTER TABLE `sms_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sms_students`
--
ALTER TABLE `sms_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sms_student_address`
--
ALTER TABLE `sms_student_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sms_student_attendance`
--
ALTER TABLE `sms_student_attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `sms_student_fee`
--
ALTER TABLE `sms_student_fee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sms_subdomains`
--
ALTER TABLE `sms_subdomains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_subjects`
--
ALTER TABLE `sms_subjects`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sms_time_tables`
--
ALTER TABLE `sms_time_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `sms_users`
--
ALTER TABLE `sms_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `sms_user_address`
--
ALTER TABLE `sms_user_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sms_student_attendance`
--
ALTER TABLE `sms_student_attendance`
  ADD CONSTRAINT `fk_dtudent_id_to_students` FOREIGN KEY (`student_id`) REFERENCES `sms_students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
