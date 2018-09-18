-- --------------------------------------------------------

--
-- Table structure for table `booking_info`
--

CREATE TABLE IF NOT EXISTS `booking_info` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_type` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `booking_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `booking_info`
--

INSERT INTO `booking_info` (`id`, `user_id`, `program_type`, `service_id`, `slot_id`, `booking_date`, `amount`, `transaction_id`, `booking_status`, `created_on`, `updated_at`) VALUES
(1, 18, 1, 1, 1, '2015-08-03 00:00:00', '100', 'alz123h3777s', 'Success', '2015-08-03 04:55:12', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_details`
--

CREATE TABLE IF NOT EXISTS `business_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `street1` varchar(255) DEFAULT NULL,
  `street2` varchar(255) DEFAULT NULL,
  `suburb` int(11) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_details`
--

INSERT INTO `business_details` (`id`, `name`, `street1`, `street2`, `suburb`, `city`, `state`, `country`, `zipcode`, `latitude`, `longitude`, `created_on`, `updated_at`) VALUES
(1, 'The Windflower', 'brookfield', '3rd cross', 4, 'Banglore', 'Karnataka', 'India', '53005', '12.967543', '77.721209', '2015-08-04 05:39:39', '0000-00-00 00:00:00'),
(2, 'Silent Shores', 'banaswadi', '7th main', 7, 'Banglore', 'Karnataka', 'India', '560037', '13.010554', '77.649520', '2015-08-04 05:44:37', '0000-00-00 00:00:00'),
(3, 'Amanvana Spa on the river', 'rt nagar', '9th main', 3, 'Banglore', 'Karnataka', 'India', '560009', '12.9562', '77.7019', '2015-08-04 05:49:49', '0000-00-00 00:00:00'),
(4, 'Grand Palace Hotel & Spa', 'B Block', '2nd cross', 9, 'Banglore', 'Karnataka', 'India', '56023', '12.9700', '77.7500', '2015-08-04 05:52:06', '0000-00-00 00:00:00'),
(5, 'The Serai', 'A Block', '1st main', 9, 'Bangalore', 'Karnataka', 'India', '560027', '13.0400', '77.5900', '2015-08-04 05:54:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_gallery`
--

CREATE TABLE IF NOT EXISTS `business_gallery` (
`id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_gallery`
--

INSERT INTO `business_gallery` (`id`, `business_id`, `images`, `created_on`, `updated_at`) VALUES
(1, 4, 'orange-county-kabini.jpg', '2015-08-10 07:40:46', '0000-00-00 00:00:00'),
(2, 4, 'silent-20shores.jpg', '2015-08-10 07:40:46', '0000-00-00 00:00:00'),
(3, 4, 'sparsa-tiruvannamalai-1.jpg', '2015-08-10 07:40:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_programs`
--

CREATE TABLE IF NOT EXISTS `business_programs` (
`id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `program` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_programs`
--

INSERT INTO `business_programs` (`id`, `business_id`, `program`, `created_on`, `updated_at`) VALUES
(1, 4, 'Yoga Program', '2015-08-03 06:41:19', '0000-00-00 00:00:00'),
(2, 4, 'Maharishi Yoga', '2015-08-11 06:41:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_services`
--

CREATE TABLE IF NOT EXISTS `business_services` (
`id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `services` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_services`
--

INSERT INTO `business_services` (`id`, `program_id`, `services`, `created_on`, `updated_at`) VALUES
(1, 1, 'Yoga Service', '2015-08-03 06:41:55', '0000-00-00 00:00:00'),
(2, 1, 'Testing Service', '2015-08-03 01:11:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_services_details`
--

CREATE TABLE IF NOT EXISTS `business_services_details` (
`id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_services_details`
--

INSERT INTO `business_services_details` (`id`, `service_id`, `description`, `duration`, `price`, `discount`, `discount_value`, `created_on`, `updated_at`) VALUES
(1, 1, 'good environment,with fully specialised trainers.', '2 Hours', '1500', '2%', '150', '2015-08-07 01:32:45', '0000-00-00 00:00:00'),
(2, 2, 'good environment,with fully specialised trainers.', '1 Hour', '1500', '2%', '150', '2015-08-07 01:32:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_service_gallery`
--

CREATE TABLE IF NOT EXISTS `business_service_gallery` (
`id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_service_gallery`
--

INSERT INTO `business_service_gallery` (`id`, `service_id`, `images`, `created_on`, `updated_at`) VALUES
(1, 1, 'silent-20shores.jpg', '2015-08-07 07:05:30', '0000-00-00 00:00:00'),
(2, 1, 'orange-county-kabini.jpg', '2015-08-11 12:10:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
`id` int(11) NOT NULL,
  `latitude` varchar(10) NOT NULL,
  `longitude` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `radius` float NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=550 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `latitude`, `longitude`, `city`, `suburb`, `radius`, `added_on`) VALUES
(1, '12.966700', '77.566700', 'Bangalore', '', 50, '2015-02-01 13:00:00'),
(2, '28.613900', '77.208900', 'New Delhi', '', 50, '2015-02-01 13:00:00'),
(3, '12.943712', '77.607769', 'Bangalore', 'Adugodi', 2, '2015-02-01 13:00:00'),
(4, '12.970844', '77.604786', 'Bangalore', 'Ashok Nagar', 2, '2015-02-01 13:00:00'),
(5, '12.961798', '77.613294', 'Bangalore', 'Austin Town', 2, '2015-02-01 13:00:00'),
(6, '12.966775', '77.577968', 'Bangalore', 'Avenue Road', 2, '2015-02-01 13:00:00'),
(7, '12.973662', '77.576442', 'Bangalore', 'Balepet', 2, '2015-02-01 13:00:00'),
(8, '12.931223', '77.552272', 'Bangalore', 'Banashankari', 2, '2015-02-01 13:00:00'),
(9, '13.010554', '77.649520', 'Bangalore', 'Banaswadi', 2, '2015-02-01 13:00:00'),
(10, '12.813698', '77.581107', 'Bangalore', 'Bannerghatta Road', 2, '2015-02-01 13:00:00'),
(11, '12.941406', '77.572518', 'Bangalore', 'Basavanagudi', 2, '2015-02-01 13:00:00'),
(12, '12.991614', '77.538383', 'Bangalore', 'Basaveshwara Nagar', 2, '2015-02-01 13:00:00'),
(13, '13.030933', '77.570335', 'Bangalore', 'Bel Road', 2, '2015-02-01 13:00:00'),
(14, '12.931589', '77.675306', 'Bangalore', 'Bellandur', 2, '2015-02-01 13:00:00'),
(15, '12.998819', '77.650783', 'Bangalore', 'Bennigana Halli', 2, '2015-02-01 13:00:00'),
(16, '13.001493', '77.604522', 'Bangalore', 'Benson Town', 2, '2015-02-01 13:00:00'),
(17, '12.898275', '77.617844', 'Bangalore', 'Bommanahalli', 2, '2015-02-01 13:00:00'),
(18, '12.962631', '77.596415', 'Bangalore', 'Brigade Road', 2, '2015-02-01 13:00:00'),
(19, '12.967543', '77.721209', 'Bangalore', 'Brookefield', 2, '2015-02-01 13:00:00'),
(20, '12.916346', '77.610230', 'Bangalore', 'BTM Layout', 2, '2015-02-01 13:00:00'),
(21, '13.061686', '77.594952', 'Bangalore', 'Byatarayanapura', 2, '2015-02-01 13:00:00'),
(22, '12.980769', '77.679326', 'Bangalore', 'C.V. Raman Nagar', 2, '2015-02-01 13:00:00'),
(23, '12.958661', '77.563925', 'Bangalore', 'Chamarajpet', 2, '2015-02-01 13:00:00'),
(24, '12.970960', '77.576252', 'Bangalore', 'Chickpet', 2, '2015-02-01 13:00:00'),
(25, '12.975066', '77.604659', 'Bangalore', 'Church Street', 2, '2015-02-01 13:00:00'),
(26, '12.982187', '77.608316', 'Bangalore', 'Commercial Street', 2, '2015-02-01 13:00:00'),
(27, '12.993727', '77.623571', 'Bangalore', 'Cox Town', 2, '2015-02-01 13:00:00'),
(28, '12.986318', '77.581351', 'Bangalore', 'Crescent Road', 2, '2015-02-01 13:00:00'),
(29, '12.990873', '77.587059', 'Bangalore', 'Cunningham', 2, '2015-02-01 13:00:00'),
(30, '13.045866', '77.510930', 'Bangalore', 'Dasarahalli', 2, '2015-02-01 13:00:00'),
(31, '13.240358', '77.714853', 'Bangalore', 'Devanahalli', 2, '2015-02-01 13:00:00'),
(32, '12.980935', '77.610079', 'Bangalore', 'Dickenson Road', 2, '2015-02-01 13:00:00'),
(33, '12.878855', '77.558083', 'Bangalore', 'Doddakallasandra', 2, '2015-02-01 13:00:00'),
(34, '12.956192', '77.583278', 'Bangalore', 'Doddamavalli', 2, '2015-02-01 13:00:00'),
(35, '12.963786', '77.635449', 'Bangalore', 'Domlur Layout', 2, '2015-02-01 13:00:00'),
(36, '13.005670', '77.670490', 'Bangalore', 'Dooravani Nagar', 2, '2015-02-01 13:00:00'),
(37, '12.834495', '77.671418', 'Bangalore', 'Electronics City', 2, '2015-02-01 13:00:00'),
(38, '12.996113', '77.613071', 'Bangalore', 'Frazer Town', 2, '2015-02-01 13:00:00'),
(39, '13.020928', '77.587986', 'Bangalore', 'Ganga Nagar', 2, '2015-02-01 13:00:00'),
(40, '12.981315', '77.578484', 'Bangalore', 'Gandhi Nagar', 2, '2015-02-01 13:00:00'),
(41, '12.946485', '77.560597', 'Bangalore', 'Gavipuram', 2, '2015-02-01 13:00:00'),
(42, '12.942870', '77.562379', 'Bangalore', 'Hanumanthanagar', 2, '2015-02-01 13:00:00'),
(43, '13.035550', '77.598044', 'Bangalore', 'Hebbal', 2, '2015-02-01 13:00:00'),
(44, '13.036104', '77.646823', 'Bangalore', 'Hennur', 2, '2015-02-01 13:00:00'),
(45, '13.084986', '77.548438', 'Bangalore', 'Hesaraghatta', 2, '2015-02-01 13:00:00'),
(46, '12.988007', '77.584787', 'Bangalore', 'High Grounds', 2, '2015-02-01 13:00:00'),
(47, '12.902928', '77.631440', 'Bangalore', 'Hosur Road', 2, '2015-02-01 13:00:00'),
(48, '13.020781', '77.646476', 'Bangalore', 'HRBR Layout', 2, '2015-02-01 13:00:00'),
(49, '12.912622', '77.646776', 'Bangalore', 'HSR Layout', 2, '2015-02-01 13:00:00'),
(50, '12.974757', '77.640572', 'Bangalore', 'Indira Nagar', 2, '2015-02-01 13:00:00'),
(51, '12.979989', '77.605098', 'Bangalore', 'Infantry Road', 2, '2015-02-01 13:00:00'),
(52, '12.996501', '77.692599', 'Bangalore', 'ITPL Road', 2, '2015-02-01 13:00:00'),
(53, '12.896050', '77.578403', 'Bangalore', 'J. P. Nagar', 2, '2015-02-01 13:00:00'),
(54, '13.055200', '77.540714', 'Bangalore', 'Jalahalli', 2, '2015-02-01 13:00:00'),
(55, '12.930405', '77.590758', 'Bangalore', 'Jaya Nagar', 2, '2015-02-01 13:00:00'),
(56, '12.961066', '77.584043', 'Bangalore', 'Jayachamaraja Road', 2, '2015-02-01 13:00:00'),
(57, '12.999049', '77.596207', 'Bangalore', 'Jayamahal Road', 2, '2015-02-01 13:00:00'),
(58, '12.963582', '77.660012', 'Bangalore', 'Jeevan Bheema Nagar', 2, '2015-02-01 13:00:00'),
(59, '12.992598', '77.762473', 'Bangalore', 'Kadugodi', 2, '2015-02-01 13:00:00'),
(60, '13.018404', '77.619021', 'Bangalore', 'Kadugondanahalli', 2, '2015-02-01 13:00:00'),
(61, '12.961329', '77.580428', 'Bangalore', 'Kalasipalyam', 2, '2015-02-01 13:00:00'),
(62, '13.022575', '77.641556', 'Bangalore', 'Kalyan Nagar', 2, '2015-02-01 13:00:00'),
(63, '13.016945', '77.637684', 'Bangalore', 'Kammanahalli', 2, '2015-02-01 13:00:00'),
(64, '12.945384', '77.577518', 'Bangalore', 'Kanakapura', 2, '2015-02-01 13:00:00'),
(65, '12.972155', '77.593693', 'Bangalore', 'Kasturba Road', 2, '2015-02-01 13:00:00'),
(66, '13.005454', '77.659254', 'Bangalore', 'Kasturi Nagar', 2, '2015-02-01 13:00:00'),
(67, '12.928562', '77.556249', 'Bangalore', 'Kathriguppe', 2, '2015-02-01 13:00:00'),
(68, '12.974589', '77.578202', 'Bangalore', 'Kempe Gowda Road', 2, '2015-02-01 13:00:00'),
(69, '12.963908', '77.648172', 'Bangalore', 'Kodihalli', 2, '2015-02-01 13:00:00'),
(70, '12.884069', '77.562474', 'Bangalore', 'Konanakunte', 2, '2015-02-01 13:00:00'),
(71, '12.928850', '77.624639', 'Bangalore', 'Koramangala', 2, '2015-02-01 13:00:00'),
(72, '13.000887', '77.674608', 'Bangalore', 'Krishnaraja Puram', 2, '2015-02-01 13:00:00'),
(73, '13.004821', '77.584545', 'Bangalore', 'Kumara Krupa Road', 2, '2015-02-01 13:00:00'),
(74, '12.903886', '77.564924', 'Bangalore', 'Kumaraswamy Layout', 2, '2015-02-01 13:00:00'),
(75, '12.983536', '77.603332', 'Bangalore', 'Lady Curzon Road', 2, '2015-02-01 13:00:00'),
(76, '12.958079', '77.602760', 'Bangalore', 'Langford Town', 2, '2015-02-01 13:00:00'),
(77, '12.971463', '77.597803', 'Bangalore', 'Lavelle Road', 2, '2015-02-01 13:00:00'),
(78, '13.009343', '77.629744', 'Bangalore', 'Lingarajapuram', 2, '2015-02-01 13:00:00'),
(79, '12.923104', '77.617657', 'Bangalore', 'Madivala', 2, '2015-02-01 13:00:00'),
(80, '12.983854', '77.529909', 'Bangalore', 'Magadi Road', 2, '2015-02-01 13:00:00'),
(81, '12.970038', '77.613366', 'Bangalore', 'Magrath Road', 2, '2015-02-01 13:00:00'),
(82, '12.991210', '77.687434', 'Bangalore', 'Mahadevapura', 2, '2015-02-01 13:00:00'),
(83, '12.975031', '77.609339', 'Bangalore', 'MG Road', 2, '2015-02-01 13:00:00'),
(84, '13.006807', '77.568943', 'Bangalore', 'Malleshwaram', 2, '2015-02-01 13:00:00'),
(85, '12.959221', '77.697011', 'Bangalore', 'Marathahalli', 2, '2015-02-01 13:00:00'),
(86, '12.924842', '77.612404', 'Bangalore', 'Maruthi Nagar', 2, '2015-02-01 13:00:00'),
(87, '13.033434', '77.562494', 'Bangalore', 'Mathikere', 2, '2015-02-01 13:00:00'),
(88, '12.962806', '77.592113', 'Bangalore', 'Mission Road', 2, '2015-02-01 13:00:00'),
(89, '12.972573', '77.604324', 'Bangalore', 'Museum Road', 2, '2015-02-01 13:00:00'),
(90, '12.967379', '77.582398', 'Bangalore', 'Nagarathpet', 2, '2015-02-01 13:00:00'),
(91, '13.043408', '77.500802', 'Bangalore', 'Nagasandra', 2, '2015-02-01 13:00:00'),
(92, '13.044372', '77.572416', 'Bangalore', 'Nagashetty Halli', 2, '2015-02-01 13:00:00'),
(93, '13.042325', '77.613698', 'Bangalore', 'Nagavara', 2, '2015-02-01 13:00:00'),
(94, '13.015354', '77.533648', 'Bangalore', 'Nandhini Layout', 2, '2015-02-01 13:00:00'),
(95, '12.966953', '77.581065', 'Bangalore', 'O.T.C. Road', 2, '2015-02-01 13:00:00'),
(96, '12.957003', '77.664770', 'Bangalore', 'Old Airport Road', 2, '2015-02-01 13:00:00'),
(97, '12.916489', '77.555613', 'Bangalore', 'Padmanabhanagar', 2, '2015-02-01 13:00:00'),
(98, '12.979393', '77.584921', 'Bangalore', 'Palace Road', 2, '2015-02-01 13:00:00'),
(99, '13.221560', '77.662839', 'Bangalore', 'Palya', 2, '2015-02-01 13:00:00'),
(100, '13.029007', '77.515123', 'Bangalore', 'Peenya', 2, '2015-02-01 13:00:00'),
(101, '13.021451', '77.595766', 'Bangalore', 'R.T. Nagar', 2, '2015-02-01 13:00:00'),
(102, '12.982386', '77.591496', 'Bangalore', 'Raj Bhavan Road', 2, '2015-02-01 13:00:00'),
(103, '12.924820', '77.517694', 'Bangalore', 'Raja Rajeshwari Nagar', 2, '2015-02-01 13:00:00'),
(104, '12.968101', '77.590572', 'Bangalore', 'Raja Ram Mohan Roy Road', 2, '2015-02-01 13:00:00'),
(105, '12.990167', '77.552599', 'Bangalore', 'Rajaji Nagar', 2, '2015-02-01 13:00:00'),
(106, '13.016822', '77.679800', 'Bangalore', 'Ramamurthy Nagar', 2, '2015-02-01 13:00:00'),
(107, '12.971788', '77.606121', 'Bangalore', 'Residency Road', 2, '2015-02-01 13:00:00'),
(108, '12.965778', '77.601986', 'Bangalore', 'Richmond Road', 2, '2015-02-01 13:00:00'),
(109, '12.962533', '77.604041', 'Bangalore', 'Richmond Town', 2, '2015-02-01 13:00:00'),
(110, '13.007133', '77.580755', 'Bangalore', 'Sadashiva Nagar', 2, '2015-02-01 13:00:00'),
(111, '13.063296', '77.584792', 'Bangalore', 'Sahakara Nagar', 2, '2015-02-01 13:00:00'),
(112, '12.992696', '77.575606', 'Bangalore', 'Sampangiram Nagar', 2, '2015-02-01 13:00:00'),
(113, '13.034280', '77.578491', 'Bangalore', 'Sanjay Nagar', 2, '2015-02-01 13:00:00'),
(114, '13.005208', '77.581385', 'Bangalore', 'Sankey Road', 2, '2015-02-01 13:00:00'),
(115, '12.927899', '77.621041', 'Bangalore', 'Sarjapur Road', 2, '2015-02-01 13:00:00'),
(116, '12.980530', '77.573331', 'Bangalore', 'Seshadri Road', 2, '2015-02-01 13:00:00'),
(117, '12.990143', '77.576303', 'Bangalore', 'Seshadripuram', 2, '2015-02-01 13:00:00'),
(118, '12.956534', '77.599359', 'Bangalore', 'Shanti Nagar', 2, '2015-02-01 13:00:00'),
(119, '12.986042', '77.604937', 'Bangalore', 'Shivajinagar', 2, '2015-02-01 13:00:00'),
(120, '12.990093', '77.564702', 'Bangalore', 'Srirampuram', 2, '2015-02-01 13:00:00'),
(121, '12.969860', '77.600672', 'Bangalore', 'St. Mark''s Road', 2, '2015-02-01 13:00:00'),
(122, '13.013503', '77.623475', 'Bangalore', 'St. Thomas Town', 2, '2015-02-01 13:00:00'),
(123, '12.980835', '77.574876', 'Bangalore', 'Subedar Chatram Road', 2, '2015-02-01 13:00:00'),
(124, '12.896558', '77.541109', 'Bangalore', 'Subramanyapura', 2, '2015-02-01 13:00:00'),
(125, '12.912765', '77.751817', 'Bangalore', 'Thippasandra', 2, '2015-02-01 13:00:00'),
(126, '12.982746', '77.624493', 'Bangalore', 'Ulsoor', 2, '2015-02-01 13:00:00'),
(127, '12.906278', '77.549437', 'Bangalore', 'Uttarahalli', 2, '2015-02-01 13:00:00'),
(128, '13.004196', '77.574705', 'Bangalore', 'Vaiyyalikaval', 2, '2015-02-01 13:00:00'),
(129, '12.941967', '77.740871', 'Bangalore', 'Varthur', 2, '2015-02-01 13:00:00'),
(130, '12.990073', '77.592650', 'Bangalore', 'Vasanth Nagar', 2, '2015-02-01 13:00:00'),
(131, '12.967880', '77.673492', 'Bangalore', 'Vimanapura', 2, '2015-02-01 13:00:00'),
(132, '12.970367', '77.594374', 'Bangalore', 'Vittal Mallya Road', 2, '2015-02-01 13:00:00'),
(133, '12.953359', '77.621346', 'Bangalore', 'Vivek Nagar', 2, '2015-02-01 13:00:00'),
(134, '12.952423', '77.576414', 'Bangalore', 'VV Puram', 2, '2015-02-01 13:00:00'),
(135, '12.970599', '77.739269', 'Bangalore', 'Whitefield', 2, '2015-02-01 13:00:00'),
(136, '12.947488', '77.597892', 'Bangalore', 'Wilson Garden', 2, '2015-02-01 13:00:00'),
(137, '13.112512', '77.594165', 'Bangalore', 'Yelahanka', 2, '2015-02-01 13:00:00'),
(138, '13.028609', '77.543410', 'Bangalore', 'Yeshwanthpur', 2, '2015-02-01 13:00:00'),
(139, '28.535662', '77.196046', 'New Delhi', 'Adhchini', 2, '2015-02-01 13:00:00'),
(140, '28.528874', '77.250136', 'New Delhi', 'Alaknanda', 2, '2015-02-01 13:00:00'),
(141, '28.669106', '77.297205', 'New Delhi', 'Ambedkar Nagar', 2, '2015-02-01 13:00:00'),
(142, '28.557110', '77.218875', 'New Delhi', 'Anand Lok', 2, '2015-02-01 13:00:00'),
(143, '28.579018', '77.164335', 'New Delhi', 'Anand Niketan', 2, '2015-02-01 13:00:00'),
(144, '28.563446', '77.227929', 'New Delhi', 'Andrews Ganj', 2, '2015-02-01 13:00:00'),
(145, '28.565551', '77.210224', 'New Delhi', 'Ansari Nagar', 2, '2015-02-01 13:00:00'),
(146, '28.560919', '77.198782', 'New Delhi', 'Arjun Nagar', 2, '2015-02-01 13:00:00'),
(147, '28.511328', '77.336269', 'New Delhi', 'Ashram', 2, '2015-02-01 13:00:00'),
(148, '28.472051', '77.127189', 'New Delhi', 'Aya Nagar', 2, '2015-02-01 13:00:00'),
(149, '28.505205', '77.305907', 'New Delhi', 'Badarpur', 2, '2015-02-01 13:00:00'),
(150, '28.568802', '77.187034', 'New Delhi', 'Bhikaji Cama Place', 2, '2015-02-01 13:00:00'),
(151, '28.583585', '77.248282', 'New Delhi', 'Bhogal', 2, '2015-02-01 13:00:00'),
(152, '28.593942', '77.186683', 'New Delhi', 'Chanakyapuri', 2, '2015-02-01 13:00:00'),
(153, '28.496757', '77.181756', 'New Delhi', 'Chattarpur', 2, '2015-02-01 13:00:00'),
(154, '28.537910', '77.249039', 'New Delhi', 'Chitranjan Park', 2, '2015-02-01 13:00:00'),
(155, '28.572364', '77.232100', 'New Delhi', 'Defence Colony', 2, '2015-02-01 13:00:00'),
(156, '28.595002', '77.163229', 'New Delhi', 'Dhaula Kuan', 2, '2015-02-01 13:00:00'),
(157, '28.557476', '77.250788', 'New Delhi', 'East of Kailash', 2, '2015-02-01 13:00:00'),
(158, '28.562382', '77.213119', 'New Delhi', 'Gautam Nagar', 2, '2015-02-01 13:00:00'),
(159, '28.502194', '77.136593', 'New Delhi', 'Ghitorni', 2, '2015-02-01 13:00:00'),
(160, '28.550482', '77.234292', 'New Delhi', 'Greater Kailash - 1', 2, '2015-02-01 13:00:00'),
(161, '28.533650', '77.242214', 'New Delhi', 'Greater Kailash - 2', 2, '2015-02-01 13:00:00'),
(162, '28.537480', '77.236060', 'New Delhi', 'Greater Kailash - 3', 2, '2015-02-01 13:00:00'),
(163, '28.558447', '77.203733', 'New Delhi', 'Green Park', 2, '2015-02-01 13:00:00'),
(164, '28.557314', '77.212296', 'New Delhi', 'Gulmohar Park', 2, '2015-02-01 13:00:00'),
(165, '28.550046', '77.195656', 'New Delhi', 'Hauz Khas', 2, '2015-02-01 13:00:00'),
(166, '28.554162', '77.194345', 'New Delhi', 'Hauz Khas Village', 2, '2015-02-01 13:00:00'),
(167, '28.576429', '77.213283', 'New Delhi', 'I. N. A', 2, '2015-02-01 13:00:00'),
(168, '28.556285', '77.099915', 'New Delhi', 'Indira Gandhi Internatio..', 2, '2015-02-01 13:00:00'),
(169, '28.582105', '77.249525', 'New Delhi', 'Jangpura', 2, '2015-02-01 13:00:00'),
(170, '28.547320', '77.288762', 'New Delhi', 'Jasola', 2, '2015-02-01 13:00:00'),
(171, '28.587975', '77.215900', 'New Delhi', 'Jor Bagh', 2, '2015-02-01 13:00:00'),
(172, '28.553606', '77.240132', 'New Delhi', 'Kailash Colony', 2, '2015-02-01 13:00:00'),
(173, '28.540168', '77.258762', 'New Delhi', 'Kalkaji', 2, '2015-02-01 13:00:00'),
(174, '28.541161', '77.189882', 'New Delhi', 'Katwaria Sarai', 2, '2015-02-01 13:00:00'),
(175, '28.600168', '77.226156', 'New Delhi', 'Khan Market', 2, '2015-02-01 13:00:00'),
(176, '28.509494', '77.231000', 'New Delhi', 'Khanpur', 2, '2015-02-01 13:00:00'),
(177, '28.550953', '77.210911', 'New Delhi', 'Khel Gaon Marg', 2, '2015-02-01 13:00:00'),
(178, '28.526856', '77.196111', 'New Delhi', 'Lado Sarai', 2, '2015-02-01 13:00:00'),
(179, '28.568614', '77.241532', 'New Delhi', 'Lajpat Nagar', 2, '2015-02-01 13:00:00'),
(180, '28.585426', '77.224619', 'New Delhi', 'Lodhi Colony', 2, '2015-02-01 13:00:00'),
(181, '28.573368', '77.262584', 'New Delhi', 'Maharani Bagh', 2, '2015-02-01 13:00:00'),
(182, '28.548155', '77.137150', 'New Delhi', 'Mahipalpur', 2, '2015-02-01 13:00:00'),
(183, '28.533549', '77.209645', 'New Delhi', 'Malviya Nagar', 2, '2015-02-01 13:00:00'),
(184, '28.598082', '77.241270', 'New Delhi', 'Mathura Road', 2, '2015-02-01 13:00:00'),
(185, '28.585865', '77.227887', 'New Delhi', 'Mehar Chand Market', 2, '2015-02-01 13:00:00'),
(186, '28.521204', '77.179201', 'New Delhi', 'Mehrauli', 2, '2015-02-01 13:00:00'),
(187, '28.582279', '77.170050', 'New Delhi', 'Moti Bagh', 2, '2015-02-01 13:00:00'),
(188, '28.553143', '77.173941', 'New Delhi', 'Munirka', 2, '2015-02-01 13:00:00'),
(189, '28.506711', '77.206782', 'New Delhi', 'Neb Sarai', 2, '2015-02-01 13:00:00'),
(190, '28.549721', '77.252959', 'New Delhi', 'Nehru Place', 2, '2015-02-01 13:00:00'),
(191, '28.577331', '77.278109', 'New Delhi', 'New Friends Colony', 2, '2015-02-01 13:00:00'),
(192, '28.590673', '77.250612', 'New Delhi', 'Nizamuddin', 2, '2015-02-01 13:00:00'),
(193, '28.562904', '77.294320', 'New Delhi', 'Okhla', 2, '2015-02-01 13:00:00'),
(194, '28.543116', '77.213976', 'New Delhi', 'Panchsheel', 2, '2015-02-01 13:00:00'),
(195, '28.586484', '77.234756', 'New Delhi', 'Pragati Vihar', 2, '2015-02-01 13:00:00'),
(196, '28.566269', '77.177181', 'New Delhi', 'R. K. Puram', 2, '2015-02-01 13:00:00'),
(197, '28.599685', '77.223370', 'New Delhi', 'Rabindra Nagar', 2, '2015-02-01 13:00:00'),
(198, '28.564555', '77.194400', 'New Delhi', 'Safdarjang Enclave', 2, '2015-02-01 13:00:00'),
(199, '28.515994', '77.200122', 'New Delhi', 'Saidulajab', 2, '2015-02-01 13:00:00'),
(200, '28.507164', '77.209047', 'New Delhi', 'Sainik Farms', 2, '2015-02-01 13:00:00'),
(201, '28.523906', '77.209067', 'New Delhi', 'Saket', 2, '2015-02-01 13:00:00'),
(202, '28.498895', '77.238974', 'New Delhi', 'Sangam Vihar', 2, '2015-02-01 13:00:00'),
(203, '28.554381', '77.251685', 'New Delhi', 'Sant Nagar', 2, '2015-02-01 13:00:00'),
(204, '28.589889', '77.262866', 'New Delhi', 'Sarai Kale Khan', 2, '2015-02-01 13:00:00'),
(205, '28.532684', '77.291680', 'New Delhi', 'Sarita Vihar', 2, '2015-02-01 13:00:00'),
(206, '28.575614', '77.196393', 'New Delhi', 'Sarojini Nagar', 2, '2015-02-01 13:00:00'),
(207, '28.587843', '77.168662', 'New Delhi', 'Satya Niketan', 2, '2015-02-01 13:00:00'),
(208, '28.548982', '77.213412', 'New Delhi', 'Shahpur Jat', 2, '2015-02-01 13:00:00'),
(209, '28.577370', '77.168882', 'New Delhi', 'Shanti Niketan', 2, '2015-02-01 13:00:00'),
(210, '28.535772', '77.223043', 'New Delhi', 'Sheikh Sarai', 2, '2015-02-01 13:00:00'),
(211, '28.532985', '77.205563', 'New Delhi', 'Shivalik', 2, '2015-02-01 13:00:00'),
(212, '28.571428', '77.173945', 'New Delhi', 'Som Vihar', 2, '2015-02-01 13:00:00'),
(213, '28.572895', '77.222485', 'New Delhi', 'South Extension', 2, '2015-02-01 13:00:00'),
(214, '28.565190', '77.219939', 'New Delhi', 'South Extension - 1', 2, '2015-02-01 13:00:00'),
(215, '28.568378', '77.220766', 'New Delhi', 'South Extension - 2', 2, '2015-02-01 13:00:00'),
(216, '28.564729', '77.256748', 'New Delhi', 'Srinivas Puri', 2, '2015-02-01 13:00:00'),
(217, '28.602677', '77.249111', 'New Delhi', 'Sunder Nagar', 2, '2015-02-01 13:00:00'),
(218, '28.509925', '77.271889', 'New Delhi', 'Tuglakabad', 2, '2015-02-01 13:00:00'),
(219, '28.525672', '77.149721', 'New Delhi', 'Vasant Kunj', 2, '2015-02-01 13:00:00'),
(220, '28.559950', '77.158269', 'New Delhi', 'Vasant Vihar', 2, '2015-02-01 13:00:00'),
(221, '28.559230', '77.208322', 'New Delhi', 'Yusuf Sarai', 2, '2015-02-01 13:00:00'),
(222, '28.655398', '77.131787', 'New Delhi', 'Bali Nagar', 2, '2015-02-01 13:00:00'),
(223, '28.529987', '77.054232', 'New Delhi', 'Bijwasan', 2, '2015-02-01 13:00:00'),
(224, '28.714589', '77.086582', 'New Delhi', 'Buddh Vihar', 2, '2015-02-01 13:00:00'),
(225, '28.609283', '77.089592', 'New Delhi', 'Dabri', 2, '2015-02-01 13:00:00'),
(226, '28.596275', '77.127088', 'New Delhi', 'Delhi Cantonment', 2, '2015-02-01 13:00:00'),
(227, '28.581149', '77.050336', 'New Delhi', 'Dwarka', 2, '2015-02-01 13:00:00'),
(228, '28.646215', '77.173881', 'New Delhi', 'East Patel Nagar', 2, '2015-02-01 13:00:00'),
(229, '28.626119', '77.110310', 'New Delhi', 'Hari Nagar', 2, '2015-02-01 13:00:00'),
(230, '28.619886', '77.092203', 'New Delhi', 'Janakpuri', 2, '2015-02-01 13:00:00'),
(231, '28.646012', '77.202687', 'New Delhi', 'Jhandewalan', 2, '2015-02-01 13:00:00'),
(232, '28.525059', '77.079501', 'New Delhi', 'Kapashera', 2, '2015-02-01 13:00:00'),
(233, '28.666348', '77.152800', 'New Delhi', 'Karampura', 2, '2015-02-01 13:00:00'),
(234, '28.649414', '77.143818', 'New Delhi', 'Kirti Nagar', 2, '2015-02-01 13:00:00'),
(235, '28.676412', '77.119477', 'New Delhi', 'Madipur', 2, '2015-02-01 13:00:00'),
(236, '28.691583', '77.086912', 'New Delhi', 'Mangol Puri', 2, '2015-02-01 13:00:00'),
(237, '28.643524', '77.132679', 'New Delhi', 'Mansarover Garden', 2, '2015-02-01 13:00:00'),
(238, '28.626082', '77.123453', 'New Delhi', 'Mayapuri', 2, '2015-02-01 13:00:00'),
(239, '28.662412', '77.140570', 'New Delhi', 'Moti Nagar', 2, '2015-02-01 13:00:00'),
(240, '28.608817', '76.983152', 'New Delhi', 'Najafgarh', 2, '2015-02-01 13:00:00'),
(241, '28.609036', '77.109451', 'New Delhi', 'Nangal Raya', 2, '2015-02-01 13:00:00'),
(242, '28.672918', '77.065757', 'New Delhi', 'Nangloi', 2, '2015-02-01 13:00:00'),
(243, '28.630375', '77.137584', 'New Delhi', 'Naraina', 2, '2015-02-01 13:00:00'),
(244, '28.590195', '77.086320', 'New Delhi', 'Palam', 2, '2015-02-01 13:00:00'),
(245, '28.668967', '77.098127', 'New Delhi', 'Paschim Vihar', 2, '2015-02-01 13:00:00'),
(246, '28.678060', '77.094583', 'New Delhi', 'Peera Garhi', 2, '2015-02-01 13:00:00'),
(247, '28.671039', '77.134460', 'New Delhi', 'Punjabi Bagh', 2, '2015-02-01 13:00:00'),
(248, '28.652330', '77.125191', 'New Delhi', 'Raja Garden', 2, '2015-02-01 13:00:00'),
(249, '28.642517', '77.178066', 'New Delhi', 'Rajendra Place', 2, '2015-02-01 13:00:00'),
(250, '28.642519', '77.121481', 'New Delhi', 'Rajouri Garden', 2, '2015-02-01 13:00:00'),
(251, '28.649920', '77.132987', 'New Delhi', 'Ramesh Nagar', 2, '2015-02-01 13:00:00'),
(252, '28.673177', '77.146237', 'New Delhi', 'Rohtak Road', 2, '2015-02-01 13:00:00'),
(253, '28.604407', '77.099153', 'New Delhi', 'Sagarpur', 2, '2015-02-01 13:00:00'),
(254, '28.608163', '77.189183', 'New Delhi', 'Sardar Patel Marg', 2, '2015-02-01 13:00:00'),
(255, '28.652066', '77.121738', 'New Delhi', 'Shivaji Place', 2, '2015-02-01 13:00:00'),
(256, '28.700072', '77.066694', 'New Delhi', 'Sultan Puri', 2, '2015-02-01 13:00:00'),
(257, '28.654093', '77.114868', 'New Delhi', 'Tagore Garden', 2, '2015-02-01 13:00:00'),
(258, '28.639671', '77.089813', 'New Delhi', 'Tilak Nagar', 2, '2015-02-01 13:00:00'),
(259, '28.619668', '77.056335', 'New Delhi', 'Uttam Nagar', 2, '2015-02-01 13:00:00'),
(260, '28.640128', '77.072482', 'New Delhi', 'Vikas Puri', 2, '2015-02-01 13:00:00'),
(261, '28.651563', '77.165048', 'New Delhi', 'West Patel Nagar', 2, '2015-02-01 13:00:00'),
(262, '28.714706', '77.166728', 'New Delhi', 'Adarsh Nagar', 2, '2015-02-01 13:00:00'),
(263, '28.673747', '77.225772', 'New Delhi', 'Alipur Road', 2, '2015-02-01 13:00:00'),
(264, '28.692074', '77.174249', 'New Delhi', 'Ashok Vihar', 2, '2015-02-01 13:00:00'),
(265, '28.713577', '77.173416', 'New Delhi', 'Azadpur', 2, '2015-02-01 13:00:00'),
(266, '28.804272', '77.046100', 'New Delhi', 'Bawana', 2, '2015-02-01 13:00:00'),
(267, '28.639525', '77.210847', 'New Delhi', 'Bharat Nagar', 2, '2015-02-01 13:00:00'),
(268, '28.754386', '77.196396', 'New Delhi', 'Burari', 2, '2015-02-01 13:00:00'),
(269, '28.681514', '77.222032', 'New Delhi', 'Civil Lines', 2, '2015-02-01 13:00:00'),
(270, '28.669379', '77.174336', 'New Delhi', 'Daya Basti', 2, '2015-02-01 13:00:00'),
(271, '28.697916', '77.188860', 'New Delhi', 'Derawal Nagar', 2, '2015-02-01 13:00:00'),
(272, '28.695978', '77.185208', 'New Delhi', 'G.T. Karnal Road', 2, '2015-02-01 13:00:00'),
(273, '28.697658', '77.202823', 'New Delhi', 'G.T.B. Nagar', 2, '2015-02-01 13:00:00'),
(274, '28.700890', '77.188966', 'New Delhi', 'Gujranwala Town', 2, '2015-02-01 13:00:00'),
(275, '28.672378', '77.190912', 'New Delhi', 'Gulabi Bagh', 2, '2015-02-01 13:00:00'),
(276, '28.720005', '77.149754', 'New Delhi', 'Haiderpur', 2, '2015-02-01 13:00:00'),
(277, '28.701830', '77.210756', 'New Delhi', 'Hakikat Nagar', 2, '2015-02-01 13:00:00'),
(278, '28.729664', '77.166573', 'New Delhi', 'Jahangir Puri', 2, '2015-02-01 13:00:00'),
(279, '28.680815', '77.203792', 'New Delhi', 'Kamla Nagar', 2, '2015-02-01 13:00:00'),
(280, '28.666513', '77.232761', 'New Delhi', 'Kashmiri Gate', 2, '2015-02-01 13:00:00'),
(281, '28.687145', '77.158066', 'New Delhi', 'Keshavpuram', 2, '2015-02-01 13:00:00'),
(282, '28.697885', '77.198349', 'New Delhi', 'Kingsway Camp', 2, '2015-02-01 13:00:00'),
(283, '28.661461', '77.200395', 'New Delhi', 'Kishan Ganj', 2, '2015-02-01 13:00:00'),
(284, '28.696258', '77.139494', 'New Delhi', 'Kohat Enclave', 2, '2015-02-01 13:00:00'),
(285, '28.685077', '77.151412', 'New Delhi', 'Lawrence Road', 2, '2015-02-01 13:00:00'),
(286, '28.704596', '77.228331', 'New Delhi', 'Majnu ka Tilla', 2, '2015-02-01 13:00:00'),
(287, '28.677331', '77.209539', 'New Delhi', 'Malka Ganj', 2, '2015-02-01 13:00:00'),
(288, '28.715862', '77.191074', 'New Delhi', 'Model Town', 2, '2015-02-01 13:00:00'),
(289, '28.710450', '77.209557', 'New Delhi', 'Mukherjee Nagar', 2, '2015-02-01 13:00:00'),
(290, '28.844993', '77.094035', 'New Delhi', 'Narela', 2, '2015-02-01 13:00:00'),
(291, '28.696709', '77.133329', 'New Delhi', 'Pitampura', 2, '2015-02-01 13:00:00'),
(292, '28.635543', '77.224917', 'New Delhi', 'Prashant Vihar', 2, '2015-02-01 13:00:00'),
(293, '28.666619', '77.207361', 'New Delhi', 'Pulbangansh', 2, '2015-02-01 13:00:00'),
(294, '28.686167', '77.193318', 'New Delhi', 'Rana Pratap Bagh', 2, '2015-02-01 13:00:00'),
(295, '28.690194', '77.132817', 'New Delhi', 'Rani Bagh', 2, '2015-02-01 13:00:00'),
(296, '28.721098', '77.107078', 'New Delhi', 'Rithala', 2, '2015-02-01 13:00:00'),
(297, '28.739869', '77.090365', 'New Delhi', 'Rohini', 2, '2015-02-01 13:00:00'),
(298, '28.665619', '77.190170', 'New Delhi', 'Sarai Rohilla', 2, '2015-02-01 13:00:00'),
(299, '28.696703', '77.124093', 'New Delhi', 'Saraswati Vihar', 2, '2015-02-01 13:00:00'),
(300, '28.677426', '77.197716', 'New Delhi', 'Shakti Nagar', 2, '2015-02-01 13:00:00'),
(301, '28.681753', '77.116758', 'New Delhi', 'Shakur Basti', 2, '2015-02-01 13:00:00'),
(302, '28.715852', '77.156516', 'New Delhi', 'Shalimar bagh', 2, '2015-02-01 13:00:00'),
(303, '28.676005', '77.225170', 'New Delhi', 'Sham Nath Marg', 2, '2015-02-01 13:00:00'),
(304, '28.675619', '77.180143', 'New Delhi', 'Shastri Nagar', 2, '2015-02-01 13:00:00'),
(305, '28.670607', '77.203595', 'New Delhi', 'Subzi Mandi', 2, '2015-02-01 13:00:00'),
(306, '28.702021', '77.221511', 'New Delhi', 'Timarpur', 2, '2015-02-01 13:00:00'),
(307, '28.679938', '77.156706', 'New Delhi', 'Tri Nagar', 2, '2015-02-01 13:00:00'),
(308, '28.691925', '77.202873', 'New Delhi', 'Vijay Nagar', 2, '2015-02-01 13:00:00'),
(309, '28.668756', '77.185813', 'New Delhi', 'Vivekanand Puri', 2, '2015-02-01 13:00:00'),
(310, '28.698201', '77.160357', 'New Delhi', 'Wazirpur', 2, '2015-02-01 13:00:00'),
(311, '28.642996', '77.222961', 'New Delhi', 'Ajmeri Gate', 2, '2015-02-01 13:00:00'),
(312, '28.602970', '77.220087', 'New Delhi', 'Aurangzeb Road', 2, '2015-02-01 13:00:00'),
(313, '28.629754', '77.232188', 'New Delhi', 'Bengali Market', 2, '2015-02-01 13:00:00'),
(314, '28.614062', '77.213418', 'New Delhi', 'Central Secretariat', 2, '2015-02-01 13:00:00'),
(315, '28.652247', '77.230681', 'New Delhi', 'Chandni Chowk', 2, '2015-02-01 13:00:00'),
(316, '28.648250', '77.226972', 'New Delhi', 'Chawri Bazar', 2, '2015-02-01 13:00:00'),
(317, '28.629442', '77.215652', 'New Delhi', 'Connaught Place', 2, '2015-02-01 13:00:00'),
(318, '28.645510', '77.241842', 'New Delhi', 'Darya Ganj', 2, '2015-02-01 13:00:00'),
(319, '28.645104', '77.242140', 'New Delhi', 'Dayanand Road', 2, '2015-02-01 13:00:00'),
(320, '28.634998', '77.204561', 'New Delhi', 'Gole Market', 2, '2015-02-01 13:00:00'),
(321, '28.621734', '77.248649', 'New Delhi', 'I P Estate', 2, '2015-02-01 13:00:00'),
(322, '28.632382', '77.250200', 'New Delhi', 'ITO', 2, '2015-02-01 13:00:00'),
(323, '28.625980', '77.217016', 'New Delhi', 'Janpath', 2, '2015-02-01 13:00:00'),
(324, '28.652627', '77.191264', 'New Delhi', 'Karol Bagh', 2, '2015-02-01 13:00:00'),
(325, '28.629492', '77.233610', 'New Delhi', 'Mandi House', 2, '2015-02-01 13:00:00'),
(326, '28.692843', '77.254729', 'New Delhi', 'Mansingh Road', 2, '2015-02-01 13:00:00'),
(327, '28.716648', '77.206142', 'New Delhi', 'Nirankari Colony', 2, '2015-02-01 13:00:00'),
(328, '28.644145', '77.214098', 'New Delhi', 'Paharganj', 2, '2015-02-01 13:00:00'),
(329, '28.606066', '77.230470', 'New Delhi', 'Pandara Road', 2, '2015-02-01 13:00:00'),
(330, '28.615632', '77.234415', 'New Delhi', 'Patiala House', 2, '2015-02-01 13:00:00'),
(331, '28.614873', '77.243851', 'New Delhi', 'Pragati Maidan', 2, '2015-02-01 13:00:00'),
(332, '28.599059', '77.203208', 'New Delhi', 'Race Course', 2, '2015-02-01 13:00:00'),
(333, '28.640885', '77.249446', 'New Delhi', 'Raj Ghat', 2, '2015-02-01 13:00:00'),
(334, '28.638246', '77.181562', 'New Delhi', 'Rajender Nagar', 2, '2015-02-01 13:00:00'),
(335, '28.613618', '77.218398', 'New Delhi', 'Rajpath', 2, '2015-02-01 13:00:00'),
(336, '28.652627', '77.308093', 'New Delhi', 'Anand Vihar', 2, '2015-02-01 13:00:00'),
(337, '28.637366', '77.102124', 'New Delhi', 'Ashok Nagar', 2, '2015-02-01 13:00:00'),
(338, '28.700078', '77.259970', 'New Delhi', 'Bhajan Pura', 2, '2015-02-01 13:00:00'),
(339, '28.627240', '77.076913', 'New Delhi', 'Chander Nagar', 2, '2015-02-01 13:00:00'),
(340, '28.684741', '77.314500', 'New Delhi', 'Dilshad Garden', 2, '2015-02-01 13:00:00'),
(341, '28.690668', '77.294129', 'New Delhi', 'Durgapuri', 2, '2015-02-01 13:00:00'),
(342, '28.661066', '77.256774', 'New Delhi', 'Gandhi Nagar', 2, '2015-02-01 13:00:00'),
(343, '28.625252', '77.283878', 'New Delhi', 'Ganesh Nagar', 2, '2015-02-01 13:00:00'),
(344, '28.651154', '77.270463', 'New Delhi', 'Geeta Colony', 2, '2015-02-01 13:00:00'),
(345, '28.630594', '77.308740', 'New Delhi', 'Indraprastha Extension', 2, '2015-02-01 13:00:00'),
(346, '28.672827', '77.308287', 'New Delhi', 'Jhilmil Colony', 2, '2015-02-01 13:00:00'),
(347, '28.619586', '77.314747', 'New Delhi', 'Kalyanpuri', 2, '2015-02-01 13:00:00'),
(348, '28.729192', '77.272259', 'New Delhi', 'Karawal Nagar', 2, '2015-02-01 13:00:00'),
(349, '28.652695', '77.303029', 'New Delhi', 'Karkardooma', 2, '2015-02-01 13:00:00'),
(350, '28.653172', '77.285047', 'New Delhi', 'Krishna Nagar', 2, '2015-02-01 13:00:00'),
(351, '28.635215', '77.271103', 'New Delhi', 'Laxmi Nagar', 2, '2015-02-01 13:00:00'),
(352, '28.636374', '77.304128', 'New Delhi', 'Madhu Vihar', 2, '2015-02-01 13:00:00'),
(353, '28.616553', '77.311911', 'New Delhi', 'Mayur Vihar', 2, '2015-02-01 13:00:00'),
(354, '28.604203', '77.297487', 'New Delhi', 'Mayur Vihar Phase - 1', 2, '2015-02-01 13:00:00'),
(355, '28.694973', '77.307669', 'New Delhi', 'Nand Nagri', 2, '2015-02-01 13:00:00'),
(356, '28.685644', '77.330659', 'New Delhi', 'New Seemapuri', 2, '2015-02-01 13:00:00'),
(357, '28.680876', '77.254086', 'New Delhi', 'New Usmanpur', 2, '2015-02-01 13:00:00'),
(358, '28.634984', '77.287904', 'New Delhi', 'Nirman Vihar', 2, '2015-02-01 13:00:00'),
(359, '28.610893', '77.268036', 'New Delhi', 'Pandav Nagar', 2, '2015-02-01 13:00:00'),
(360, '28.611491', '77.287422', 'New Delhi', 'Patparganj', 2, '2015-02-01 13:00:00'),
(361, '28.636564', '77.292617', 'New Delhi', 'Preet Vihar', 2, '2015-02-01 13:00:00'),
(362, '28.542569', '77.207016', 'New Delhi', 'Sarvapriya Vihar', 2, '2015-02-01 13:00:00'),
(363, '28.684378', '77.265667', 'New Delhi', 'Shahdara', 2, '2015-02-01 13:00:00'),
(364, '28.628742', '77.280683', 'New Delhi', 'Shakarpur', 2, '2015-02-01 13:00:00'),
(365, '28.663459', '77.308579', 'New Delhi', 'Surajmal Vihar', 2, '2015-02-01 13:00:00'),
(366, '28.641550', '77.289282', 'New Delhi', 'Swasthya Vihar', 2, '2015-02-01 13:00:00'),
(367, '28.604433', '77.305890', 'New Delhi', 'Trilok Puri', 2, '2015-02-01 13:00:00'),
(368, '28.598183', '77.318794', 'New Delhi', 'Vasundhara Enclave', 2, '2015-02-01 13:00:00'),
(369, '28.669091', '77.317272', 'New Delhi', 'Vivek Vihar', 2, '2015-02-01 13:00:00'),
(370, '28.730702', '77.224472', 'New Delhi', 'Wazirabad', 2, '2015-02-01 13:00:00'),
(371, '28.700225', '77.274664', 'New Delhi', 'Yamuna Vihar', 2, '2015-02-01 13:00:00'),
(372, '28.663032', '77.316467', 'New Delhi', 'Yojana Vihar', 2, '2015-02-01 13:00:00'),
(373, '28.681839', '77.270953', 'New Delhi', 'Zafrabad', 2, '2015-02-01 13:00:00'),
(374, '28.443555', '76.980169', 'Gurgaon', '', 20, '2015-02-10 13:00:00'),
(375, '28.548424', '77.376844', 'Noida', '', 20, '2015-02-10 13:00:00'),
(376, '28.513143', '77.516682', 'Greater Noida', '', 20, '2015-02-10 13:00:00'),
(377, '28.403139', '77.321478', 'Faridabad', '', 20, '2015-02-10 13:00:00'),
(378, '28.678721', '77.414254', 'Ghaziabad', '', 20, '2015-02-10 13:00:00'),
(379, '19.115666', '72.880518', 'Mumbai', '', 50, '2015-02-10 13:00:00'),
(380, '18.517943', '73.867431', 'Pune', '', 20, '2015-02-10 13:00:00'),
(381, '23.033300', '72.595535', 'Ahmdebad', '', 20, '2015-02-10 13:00:00'),
(382, '22.313686', '73.171713', 'Vadodara', '', 20, '2015-02-10 13:00:00'),
(383, '15.396851', '74.071283', 'Goa', '', 20, '2015-02-10 13:00:00'),
(384, '23.221182', '77.425804', 'Bhopal', '', 20, '2015-02-10 13:00:00'),
(385, '30.736578', '76.774997', 'Chandigarh', '', 20, '2015-02-10 13:00:00'),
(386, '26.887354', '75.801544', 'Jaipur', '', 20, '2015-02-10 13:00:00'),
(387, '24.585485', '73.707711', 'Udaipur', '', 20, '2015-02-10 13:00:00'),
(388, '27.180908', '78.008165', 'Agra', '', 20, '2015-02-10 13:00:00'),
(389, '26.226014', '78.187122', 'Gwalior', '', 20, '2015-02-10 13:00:00'),
(390, '26.455627', '80.327740', 'Kanpur', '', 20, '2015-02-10 13:00:00'),
(391, '26.853287', '80.946633', 'Lucknow', '', 20, '2015-02-10 13:00:00'),
(392, '31.629890', '74.876643', 'Amritsar', '', 20, '2015-02-10 13:00:00'),
(393, '31.330756', '75.586023', 'Jalandhar', '', 20, '2015-02-10 13:00:00'),
(394, '30.897252', '75.864570', 'Ludhiana', '', 20, '2015-02-10 13:00:00'),
(395, '21.260146', '81.635553', 'Raipur', '', 20, '2015-02-10 13:00:00'),
(396, '17.407435', '78.438258', 'Hyderabad', '', 50, '2015-02-10 13:00:00'),
(397, '13.049233', '80.215133', 'Chennai', '', 50, '2015-02-10 13:00:00'),
(398, '9.972764', '76.298461', 'Kochi', '', 20, '2015-02-10 13:00:00'),
(399, '11.027717', '76.961970', 'Coimbatore', '', 20, '2015-02-10 13:00:00'),
(400, '9.922803', '78.120935', 'Madurai', '', 20, '2015-02-10 13:00:00'),
(401, '12.909181', '79.123836', 'Vellore', '', 20, '2015-02-10 13:00:00'),
(402, '22.609817', '88.375453', 'Kolkata', '', 50, '2015-02-10 13:00:00'),
(403, '25.602690', '85.133945', 'Patna', '', 20, '2015-02-10 13:00:00'),
(404, '28.536491', '77.275042', 'New Delhi', 'Okhla Phase - II', 2, '2015-05-08 22:39:24'),
(405, '28.644558', '77.168028', 'New Delhi', 'South Patel Nagar', 1, '2015-05-08 22:42:28'),
(406, '28.642470', '77.106270', 'New Delhi', 'Pacific Mall', 1, '2015-05-08 22:51:56'),
(407, '28.528269', '77.218314', 'New Delhi', 'Select Citywalk', 1, '2015-05-08 22:54:15'),
(408, '28.528164', '77.216595', 'New Delhi', 'DLF Place Saket', 1, '2015-05-08 22:56:09'),
(409, '28.637453', '77.286743', 'New Delhi', 'V3S Mall, Laxmi Nagar', 1, '2015-05-08 22:59:01'),
(410, '28.657012', '77.146780', 'New Delhi', 'Moments Mall, Kirti Nagar', 1, '2015-05-08 23:02:10'),
(411, '28.486965', '77.015062', 'Gurgaon', 'Ashok Vihar', 2, '2015-05-11 13:00:00'),
(412, '28.455197', '77.032344', 'Gurgaon', 'Civil Lines', 2, '2015-05-11 13:00:00'),
(413, '28.49517', '77.090258', 'Gurgaon', 'DLF Cybercity', 2, '2015-05-11 13:00:00'),
(414, '28.486363', '77.083495', 'Gurgaon', 'DLF-II', 2, '2015-05-11 13:00:00'),
(415, '28.493862', '77.103828', 'Gurgaon', 'DLF-III', 2, '2015-05-11 13:00:00'),
(416, '28.465607', '77.083316', 'Gurgaon', 'DLF-IV', 2, '2015-05-11 13:00:00'),
(417, '28.41136', '77.043396', 'Gurgaon', 'Dwarka Expressway', 2, '2015-05-11 13:00:00'),
(418, '28.412374', '77.074343', 'Gurgaon', 'Golf Course Extn', 2, '2015-05-11 13:00:00'),
(419, '28.455952', '77.098053', 'Gurgaon', 'Golf Course Road', 2, '2015-05-11 13:00:00'),
(420, '28.409272', '77.207161', 'Gurgaon', 'Gurgaon-Faridabad Road', 2, '2015-05-11 13:00:00'),
(421, '28.353754', '76.939638', 'Gurgaon', 'Manesar', 2, '2015-05-11 13:00:00'),
(422, '28.479605', '77.07992', 'Gurgaon', 'MG Road', 2, '2015-05-11 13:00:00'),
(423, '28.515054', '77.077482', 'Gurgaon', 'Old Delhi Gurgaon Road', 2, '2015-05-11 13:00:00'),
(424, '28.508133', '77.030748', 'Gurgaon', 'Palam Vihar', 2, '2015-05-11 13:00:00'),
(425, '28.499087', '77.048192', 'Gurgaon', 'Palam Vihar Extension', 2, '2015-05-11 13:00:00'),
(426, '28.517493', '77.040565', 'Gurgaon', 'Sector-1', 2, '2015-05-11 13:00:00'),
(427, '28.454168', '77.001381', 'Gurgaon', 'Sector-10', 2, '2015-05-11 13:00:00'),
(428, '28.445473', '77.008189', 'Gurgaon', 'Sector-10 A', 2, '2015-05-11 13:00:00'),
(429, '28.461212', '76.971631', 'Gurgaon', 'Sector-100', 2, '2015-05-11 13:00:00'),
(430, '28.468316', '76.980127', 'Gurgaon', 'Sector-101', 2, '2015-05-11 13:00:00'),
(431, '28.475651', '76.970537', 'Gurgaon', 'Sector-102', 2, '2015-05-11 13:00:00'),
(432, '28.493926', '76.985128', 'Gurgaon', 'Sector-103', 2, '2015-05-11 13:00:00'),
(433, '28.480313', '76.99434', 'Gurgaon', 'Sector-104', 2, '2015-05-11 13:00:00'),
(434, '28.495847', '77.009607', 'Gurgaon', 'Sector-105', 2, '2015-05-11 13:00:00'),
(435, '28.499339', '76.999487', 'Gurgaon', 'Sector-106', 2, '2015-05-11 13:00:00'),
(436, '28.506222', '76.971674', 'Gurgaon', 'Sector-107', 2, '2015-05-11 13:00:00'),
(437, '28.513918', '76.982464', 'Gurgaon', 'Sector-108', 2, '2015-05-11 13:00:00'),
(438, '28.508269', '77.009737', 'Gurgaon', 'Sector-109', 2, '2015-05-11 13:00:00'),
(439, '28.452511', '77.022489', 'Gurgaon', 'Sector-11', 2, '2015-05-11 13:00:00'),
(440, '28.508469', '77.020375', 'Gurgaon', 'Sector-110', 2, '2015-05-11 13:00:00'),
(441, '28.516378', '77.02921', 'Gurgaon', 'Sector-110 A', 2, '2015-05-11 13:00:00'),
(442, '28.528272', '77.016897', 'Gurgaon', 'Sector-112', 2, '2015-05-11 13:00:00'),
(443, '28.529649', '77.023559', 'Gurgaon', 'Sector-113', 2, '2015-05-11 13:00:00'),
(444, '28.532973', '77.011891', 'Gurgaon', 'Sector-114', 2, '2015-05-11 13:00:00'),
(445, '28.53779', '77.006923', 'Gurgaon', 'Sector-115', 2, '2015-05-11 13:00:00'),
(446, '28.467716', '77.03091', 'Gurgaon', 'Sector-12', 2, '2015-05-11 13:00:00'),
(447, '28.476046', '77.039746', 'Gurgaon', 'Sector-13', 2, '2015-05-11 13:00:00'),
(448, '28.471261', '77.044459', 'Gurgaon', 'Sector-14', 2, '2015-05-11 13:00:00'),
(449, '28.460123', '77.045553', 'Gurgaon', 'Sector-15', 2, '2015-05-11 13:00:00'),
(450, '28.46772', '77.052403', 'Gurgaon', 'Sector-16', 2, '2015-05-11 13:00:00'),
(451, '28.479501', '77.058432', 'Gurgaon', 'Sector-17', 2, '2015-05-11 13:00:00'),
(452, '28.491868', '77.070693', 'Gurgaon', 'Sector-18', 2, '2015-05-11 13:00:00'),
(453, '28.503302', '77.080645', 'Gurgaon', 'Sector-19', 2, '2015-05-11 13:00:00'),
(454, '28.50792', '77.032878', 'Gurgaon', 'Sector-2', 2, '2015-05-11 13:00:00'),
(455, '28.509801', '77.085915', 'Gurgaon', 'Sector-20', 2, '2015-05-11 13:00:00'),
(456, '28.513887', '77.071635', 'Gurgaon', 'Sector-21', 2, '2015-05-11 13:00:00'),
(457, '28.50588', '77.064654', 'Gurgaon', 'Sector-22', 2, '2015-05-11 13:00:00'),
(458, '28.510172', '77.052812', 'Gurgaon', 'Sector-23', 2, '2015-05-11 13:00:00'),
(459, '28.505758', '77.045883', 'Gurgaon', 'Sector-23A', 2, '2015-05-11 13:00:00'),
(460, '28.492278', '77.100308', 'Gurgaon', 'Sector-24', 2, '2015-05-11 13:00:00'),
(461, '28.484242', '77.08138', 'Gurgaon', 'Sector-25', 2, '2015-05-11 13:00:00'),
(462, '28.477546', '77.102933', 'Gurgaon', 'Sector-26', 2, '2015-05-11 13:00:00'),
(463, '28.468587', '77.099273', 'Gurgaon', 'Sector-26 A', 2, '2015-05-11 13:00:00'),
(464, '28.465584', '77.091515', 'Gurgaon', 'Sector-27', 2, '2015-05-11 13:00:00'),
(465, '28.47418', '77.084584', 'Gurgaon', 'Sector-28', 2, '2015-05-11 13:00:00'),
(466, '28.467842', '77.067179', 'Gurgaon', 'Sector-29', 2, '2015-05-11 13:00:00'),
(467, '28.493507', '77.017574', 'Gurgaon', 'Sector-3', 2, '2015-05-11 13:00:00'),
(468, '28.461372', '77.05632', 'Gurgaon', 'Sector-30', 2, '2015-05-11 13:00:00'),
(469, '28.453221', '77.048613', 'Gurgaon', 'Sector-31', 2, '2015-05-11 13:00:00'),
(470, '28.446', '77.041292', 'Gurgaon', 'Sector-32', 2, '2015-05-11 13:00:00'),
(471, '28.437876', '77.024192', 'Gurgaon', 'Sector-33', 2, '2015-05-11 13:00:00'),
(472, '28.428853', '77.007304', 'Gurgaon', 'Sector-34', 2, '2015-05-11 13:00:00'),
(473, '28.417384', '77.0012', 'Gurgaon', 'Sector-35', 2, '2015-05-11 13:00:00'),
(474, '28.417847', '76.988033', 'Gurgaon', 'Sector-36', 2, '2015-05-11 13:00:00'),
(475, '28.437288', '76.996747', 'Gurgaon', 'Sector-37', 2, '2015-05-11 13:00:00'),
(476, '28.441151', '76.992815', 'Gurgaon', 'Sector-37 A', 2, '2015-05-11 13:00:00'),
(477, '28.438437', '76.985338', 'Gurgaon', 'Sector-37 B', 2, '2015-05-11 13:00:00'),
(478, '28.450389', '76.987886', 'Gurgaon', 'Sector-37 C', 2, '2015-05-11 13:00:00'),
(479, '28.445335', '76.971793', 'Gurgaon', 'Sector-37 D', 2, '2015-05-11 13:00:00'),
(480, '28.435996', '77.039722', 'Gurgaon', 'Sector-38', 2, '2015-05-11 13:00:00'),
(481, '28.442397', '77.049908', 'Gurgaon', 'Sector-39', 2, '2015-05-11 13:00:00'),
(482, '28.474158', '77.009766', 'Gurgaon', 'Sector-4', 2, '2015-05-11 13:00:00'),
(483, '28.449649', '77.057951', 'Gurgaon', 'Sector-40', 2, '2015-05-11 13:00:00'),
(484, '28.456582', '77.064548', 'Gurgaon', 'Sector-41', 2, '2015-05-11 13:00:00'),
(485, '28.457394', '77.108813', 'Gurgaon', 'DLF Golf Course', 2, '2015-05-11 13:00:00'),
(486, '28.455018', '77.086217', 'Gurgaon', 'Sector-43', 2, '2015-05-11 13:00:00'),
(487, '28.448794', '77.075836', 'Gurgaon', 'Sector-44', 2, '2015-05-11 13:00:00'),
(488, '28.447152', '77.067637', 'Gurgaon', 'Sector-45', 2, '2015-05-11 13:00:00'),
(489, '28.436123', '77.057741', 'Gurgaon', 'Sector-46', 2, '2015-05-11 13:00:00'),
(490, '28.425622', '77.046114', 'Gurgaon', 'Sector-47', 2, '2015-05-11 13:00:00'),
(491, '28.415939', '77.036765', 'Gurgaon', 'Sector-48', 2, '2015-05-11 13:00:00'),
(492, '28.411202', '77.048811', 'Gurgaon', 'Sector-49', 2, '2015-05-11 13:00:00'),
(493, '28.479916', '77.019396', 'Gurgaon', 'Sector-5', 2, '2015-05-11 13:00:00'),
(494, '28.415267', '77.060842', 'Gurgaon', 'Sector-50', 2, '2015-05-11 13:00:00'),
(495, '28.429714', '77.06727', 'Gurgaon', 'Sector-51', 2, '2015-05-11 13:00:00'),
(496, '28.437224', '77.079086', 'Gurgaon', 'Sector-52', 2, '2015-05-11 13:00:00'),
(497, '28.440285', '77.090072', 'Gurgaon', 'Sector-52 A', 2, '2015-05-11 13:00:00'),
(498, '28.440693', '77.09706', 'Gurgaon', 'Sector-53', 2, '2015-05-11 13:00:00'),
(499, '28.441169', '77.112048', 'Gurgaon', 'Sector-54', 2, '2015-05-11 13:00:00'),
(500, '28.426911', '77.109779', 'Gurgaon', 'Sector-55', 2, '2015-05-11 13:00:00'),
(501, '28.424985', '77.097927', 'Gurgaon', 'Sector-56', 2, '2015-05-11 13:00:00'),
(502, '28.422139', '77.079263', 'Gurgaon', 'Sector-57', 2, '2015-05-11 13:00:00'),
(503, '28.416797', '77.110707', 'Gurgaon', 'Sector-58', 2, '2015-05-11 13:00:00'),
(504, '28.405931', '77.110844', 'Gurgaon', 'Sector-59', 2, '2015-05-11 13:00:00'),
(505, '28.474164', '77.024469', 'Gurgaon', 'Sector-6', 2, '2015-05-11 13:00:00'),
(506, '28.400022', '77.097641', 'Gurgaon', 'Sector-60', 2, '2015-05-11 13:00:00'),
(507, '28.409863', '77.096033', 'Gurgaon', 'Sector-61', 2, '2015-05-11 13:00:00'),
(508, '28.408426', '77.084192', 'Gurgaon', 'Sector-62', 2, '2015-05-11 13:00:00'),
(509, '28.397337', '77.087266', 'Gurgaon', 'Sector-63', 2, '2015-05-11 13:00:00'),
(510, '28.391664', '77.075508', 'Gurgaon', 'Sector-64', 2, '2015-05-11 13:00:00'),
(511, '28.402954', '77.070059', 'Gurgaon', 'Sector-65', 2, '2015-05-11 13:00:00'),
(512, '28.396917', '77.054674', 'Gurgaon', 'Sector-66', 2, '2015-05-11 13:00:00'),
(513, '28.385972', '77.060275', 'Gurgaon', 'Sector-67', 2, '2015-05-11 13:00:00'),
(514, '28.384208', '77.04845', 'Gurgaon', 'Sector-68', 2, '2015-05-11 13:00:00'),
(515, '28.397606', '77.037804', 'Gurgaon', 'Sector-69', 2, '2015-05-11 13:00:00'),
(516, '28.464269', '77.013074', 'Gurgaon', 'Sector-7', 2, '2015-05-11 13:00:00'),
(517, '28.397636', '77.022794', 'Gurgaon', 'Sector-70', 2, '2015-05-11 13:00:00'),
(518, '28.38384', '77.022196', 'Gurgaon', 'Sector-70A', 2, '2015-05-11 13:00:00'),
(519, '28.407088', '77.022462', 'Gurgaon', 'Sector-71', 2, '2015-05-11 13:00:00'),
(520, '28.417082', '77.028624', 'Gurgaon', 'Sector-72', 2, '2015-05-11 13:00:00'),
(521, '28.423533', '77.020103', 'Gurgaon', 'Sector-72A', 2, '2015-05-11 13:00:00'),
(522, '28.406857', '77.011195', 'Gurgaon', 'Sector-73', 2, '2015-05-11 13:00:00'),
(523, '28.416149', '77.012214', 'Gurgaon', 'Sector-74', 2, '2015-05-11 13:00:00'),
(524, '28.407622', '76.998476', 'Gurgaon', 'Sector-74 A', 2, '2015-05-11 13:00:00'),
(525, '28.394199', '77.009631', 'Gurgaon', 'Sector-75', 2, '2015-05-11 13:00:00'),
(526, '28.392231', '76.990278', 'Gurgaon', 'Sector-76', 2, '2015-05-11 13:00:00'),
(527, '28.383301', '76.981544', 'Gurgaon', 'Sector-77', 2, '2015-05-11 13:00:00'),
(528, '28.372465', '76.970086', 'Gurgaon', 'Sector-78', 2, '2015-05-11 13:00:00'),
(529, '28.363016', '76.98077', 'Gurgaon', 'Sector-79', 2, '2015-05-11 13:00:00'),
(530, '28.460863', '77.021018', 'Gurgaon', 'Sector-8', 2, '2015-05-11 13:00:00'),
(531, '28.366468', '76.958027', 'Gurgaon', 'Sector-80', 2, '2015-05-11 13:00:00'),
(532, '28.388191', '76.947341', 'Gurgaon', 'Sector-81', 2, '2015-05-11 13:00:00'),
(533, '28.379045', '76.954958', 'Gurgaon', 'Sector-81A', 2, '2015-05-11 13:00:00'),
(534, '28.402122', '76.935561', 'Gurgaon', 'New Gurgaon', 2, '2015-05-11 13:00:00'),
(535, '28.46372', '76.99878', 'Gurgaon', 'Sector-9', 2, '2015-05-11 13:00:00'),
(536, '28.468727', '76.997279', 'Gurgaon', 'Sector-9A', 2, '2015-05-11 13:00:00'),
(537, '28.459321', '76.984012', 'Gurgaon', 'Sector-9B', 2, '2015-05-11 13:00:00'),
(538, '28.247588', '77.069852', 'Gurgaon', 'Sohna', 2, '2015-05-11 13:00:00'),
(539, '28.405565', '77.04382', 'Gurgaon', 'Sohna Road', 2, '2015-05-11 13:00:00'),
(540, '28.456855', '77.065839', 'Gurgaon', 'South City I', 2, '2015-05-11 13:00:00'),
(541, '28.418084', '77.051778', 'Gurgaon', 'South City II', 2, '2015-05-11 13:00:00'),
(542, '28.463499', '77.076499', 'Gurgaon', 'Sushant Lok I', 2, '2015-05-11 13:00:00'),
(543, '28.426345', '77.11171', 'Gurgaon', 'Sushant Lok II', 2, '2015-05-11 13:00:00'),
(544, '28.420169', '77.079951', 'Gurgaon', 'Sushant Lok III', 2, '2015-05-11 13:00:00'),
(545, '28.505389', '77.070384', 'Gurgaon', 'Udyog Vihar', 2, '2015-05-11 13:00:00'),
(546, '28.46742', '77.081618', 'Gurgaon', 'DLF Galleria Market', 2, '2015-05-11 13:00:00'),
(547, '28.495783', '77.08826', 'Gurgaon', 'Cyberhub', 2, '2015-05-11 13:00:00'),
(548, '28.503889', '77.097303', 'Gurgaon', 'Ambience Mall', 2, '2015-05-11 13:00:00'),
(549, '28.479624', '77.07992', 'Gurgaon', 'MG Road', 2, '2015-05-11 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
`id` int(11) NOT NULL,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `slug`, `created_on`, `updated_at`) VALUES
(1, 'SPA', 'spa', '2015-07-27 02:24:03', '0000-00-00 00:00:00'),
(2, 'Ayuervedic Treatments', 'ayurvedic_treatments', '2015-07-27 02:24:03', '0000-00-00 00:00:00'),
(3, 'Yoga', 'yoga', '2015-07-27 02:24:29', '0000-00-00 00:00:00'),
(4, 'healthclubs', 'healthclubs', '2015-07-27 02:24:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `services_business_mapping`
--

CREATE TABLE IF NOT EXISTS `services_business_mapping` (
`id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services_business_mapping`
--

INSERT INTO `services_business_mapping` (`id`, `services_id`, `business_id`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 4),
(4, 3, 5),
(5, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `services_slots`
--

CREATE TABLE IF NOT EXISTS `services_slots` (
`id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_slots` int(11) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services_slots`
--

INSERT INTO `services_slots` (`id`, `service_id`, `date`, `start_time`, `end_time`, `number_of_slots`, `created_on`, `updated_at`) VALUES
(1, 1, '2015-08-03', '11:00', '13:00', 10, '2015-08-03 06:40:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE IF NOT EXISTS `transaction_details` (
`id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `transaction_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  `paid_by` int(11) NOT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_information` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `booking_id`, `transaction_id`, `transaction_status`, `transaction_date`, `paid_by`, `payment_mode`, `amount`, `other_information`, `created_on`, `updated_at`) VALUES
(1, 1, 0, 'success', '2015-08-03 06:10:36', 18, 'Paypal', '100', 'testing', '2015-08-03 04:52:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_time` datetime NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_logged_in` datetime NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `status`, `activation_token`, `reset_password_token`, `reset_password_time`, `salt`, `last_logged_in`, `ip_address`) VALUES
(9, 'vikrant@nuvodev.com', 'sha256:1000:F1QkKPPAZzn9WZtBN9jyCLx94hchTj6T:dksCrt/l/Zv3A86g5aXEB652kg5Hkbkr', 'Vikrant Trivedi', 'Active', '', NULL, '0000-00-00 00:00:00', 'F1QkKPPAZzn9WZtBN9jyCLx94hchTj6T', '2015-08-07 11:46:34', '::1'),
(18, 'test@nuvodev.com', 'sha256:1000:gz0atJxzVDu+5lrXwBrbuG9psVFlbNdx:Jse4ErdPYyRNBKKAAv+VCX10CJz5vxD4', 'Vikrant Trivedi', 'Active', '', NULL, '2015-08-06 08:10:23', 'wH6g8prOBLZ0DB2evf0dYLwUxTVmrROI', '2015-08-11 11:49:51', '::1'),
(26, 'test@zingup.com', 'sha256:1000:EFnrf7a29uLLMwkuzls5Qj8Y9RPS1Xom:BiJXvTvxHWEYZ9xFnXs2y13P2VqPc4R3', 'Vikrant Trivedi', 'De-active', 'NBktfYiZ2Ud8FXr+/hqeR+GOTPrKWrdW', '', '0000-00-00 00:00:00', 'NBktfYiZ2Ud8FXr+/hqeR+GOTPrKWrdW', '2015-08-06 08:38:35', '::1'),
(47, '1318aman@gmail.com', NULL, 'Aman Sharma', 'Active', NULL, NULL, '0000-00-00 00:00:00', NULL, '2015-08-07 12:06:39', '::1'),
(48, 'vikrant.nuvodev@gmail.com', NULL, 'Vikrant Trivedi', 'Active', NULL, NULL, '0000-00-00 00:00:00', NULL, '2015-08-10 08:52:03', '::1'),
(49, 'anitha236.m@gmail.com', NULL, 'Anitha Mandalapu', 'Active', NULL, NULL, '0000-00-00 00:00:00', NULL, '2015-08-12 10:14:30', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_log_details`
--

CREATE TABLE IF NOT EXISTS `user_activity_log_details` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url_visited` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` time NOT NULL,
  `user_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1008 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_activity_log_details`
--

INSERT INTO `user_activity_log_details` (`id`, `user_id`, `url_visited`, `user_agent`, `session_id`, `date`, `start_time`, `end_time`, `duration`, `user_type`, `ip_address`, `created_at`) VALUES
(1, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '22936cee52e97897f7783fc217bd1d400b827fce', '2015-08-05', '06:58:10', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 04:58:10'),
(2, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:02:13', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 05:02:13'),
(3, 18, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:02:14', '07:03:17', '00:00:00', 'user', '127.0.0.1', '2015-08-05 05:02:14'),
(4, 18, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:03:18', '07:03:20', '00:00:02', 'user', '127.0.0.1', '2015-08-05 05:03:18'),
(5, 18, 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:03:20', '07:04:05', '00:00:45', 'user', '127.0.0.1', '2015-08-05 05:03:20'),
(6, 18, 'http://localhost/zing/editProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:04:05', '07:05:01', '00:00:56', 'user', '127.0.0.1', '2015-08-05 05:04:05'),
(7, 18, 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:05:02', '07:05:14', '00:00:12', 'user', '127.0.0.1', '2015-08-05 05:05:02'),
(8, 18, 'http://localhost/zing/myBookings', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:05:14', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 05:05:14'),
(9, 18, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '36aeb356a1e5023445b5a476db153f94bc084aca', '2015-08-05', '07:32:44', '07:36:43', '00:02:39', 'user', '127.0.0.1', '2015-08-05 05:32:44'),
(10, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '36aeb356a1e5023445b5a476db153f94bc084aca', '2015-08-05', '07:32:44', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 05:32:44'),
(11, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '36aeb356a1e5023445b5a476db153f94bc084aca', '2015-08-05', '07:36:43', '07:36:45', '00:00:02', NULL, '127.0.0.1', '2015-08-05 05:36:43'),
(12, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '36aeb356a1e5023445b5a476db153f94bc084aca', '2015-08-05', '07:36:45', '07:36:51', '00:00:06', NULL, '127.0.0.1', '2015-08-05 05:36:45'),
(13, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '36aeb356a1e5023445b5a476db153f94bc084aca', '2015-08-05', '07:36:51', '07:36:51', '00:00:00', NULL, '127.0.0.1', '2015-08-05 05:36:51'),
(14, 18, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '36aeb356a1e5023445b5a476db153f94bc084aca', '2015-08-05', '07:36:51', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 05:36:51'),
(15, 18, 'http://localhost/zing/activateAccount/F1QkKPPAZzn9WZtBN9jyCLx94hchTj6T', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'da9ac16347eec1d11d40d9cf271d3d8aef226387', '2015-08-05', '07:58:07', '07:58:22', '00:00:15', 'user', '127.0.0.1', '2015-08-05 05:58:07'),
(16, 18, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'da9ac16347eec1d11d40d9cf271d3d8aef226387', '2015-08-05', '07:58:07', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 05:58:07'),
(17, 18, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'da9ac16347eec1d11d40d9cf271d3d8aef226387', '2015-08-05', '07:58:22', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 05:58:22'),
(18, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac6a64ead715e09b490d8083aa0aa863b38823b7', '2015-08-05', '07:58:22', '07:58:24', '00:00:02', NULL, '127.0.0.1', '2015-08-05 05:58:22'),
(19, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac6a64ead715e09b490d8083aa0aa863b38823b7', '2015-08-05', '07:58:24', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 05:58:24'),
(20, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cdd6775a474c7d2ab3ee3fd2f0e04a805f39485', '2015-08-05', '11:37:33', '11:37:54', '00:00:21', NULL, '127.0.0.1', '2015-08-05 09:37:33'),
(21, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cdd6775a474c7d2ab3ee3fd2f0e04a805f39485', '2015-08-05', '11:37:54', '11:38:27', '00:00:33', NULL, '127.0.0.1', '2015-08-05 09:37:54'),
(22, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cdd6775a474c7d2ab3ee3fd2f0e04a805f39485', '2015-08-05', '11:38:27', '11:38:49', '00:00:22', NULL, '127.0.0.1', '2015-08-05 09:38:27'),
(23, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cdd6775a474c7d2ab3ee3fd2f0e04a805f39485', '2015-08-05', '11:38:49', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 09:38:49'),
(24, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:18:00', '12:18:06', '00:00:06', NULL, '127.0.0.1', '2015-08-05 10:18:00'),
(25, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:18:06', '12:18:10', '00:00:04', NULL, '127.0.0.1', '2015-08-05 10:18:06'),
(26, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:18:11', '12:20:36', '00:01:45', NULL, '127.0.0.1', '2015-08-05 10:18:11'),
(27, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:20:36', '12:20:41', '00:00:05', NULL, '127.0.0.1', '2015-08-05 10:20:36'),
(28, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:20:41', '12:20:50', '00:00:09', NULL, '127.0.0.1', '2015-08-05 10:20:41'),
(29, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:20:50', '12:20:53', '00:00:03', NULL, '127.0.0.1', '2015-08-05 10:20:50'),
(30, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:20:53', '12:20:54', '00:00:01', NULL, '127.0.0.1', '2015-08-05 10:20:53'),
(31, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:20:54', '12:21:16', '00:00:22', NULL, '127.0.0.1', '2015-08-05 10:20:54'),
(32, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:21:16', '12:21:17', '00:00:01', NULL, '127.0.0.1', '2015-08-05 10:21:16'),
(33, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:21:17', '12:21:18', '00:00:01', NULL, '127.0.0.1', '2015-08-05 10:21:17'),
(34, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:21:17', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:21:17'),
(35, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:21:17', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:21:17'),
(36, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:21:18', '12:21:20', '00:00:02', NULL, '127.0.0.1', '2015-08-05 10:21:18'),
(37, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:21:18', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:21:18'),
(38, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:21:18', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:21:18'),
(39, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:21:20', '12:21:20', '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:21:20'),
(40, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9d3eed9a4bb742f4b9c28dfe9d26108a0adba4bb', '2015-08-05', '12:21:20', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:21:20'),
(41, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '847d28e5e81bacca285e2a190bd32a1291e66bb0', '2015-08-05', '12:24:16', '12:24:19', '00:00:03', NULL, '127.0.0.1', '2015-08-05 10:24:16'),
(42, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '847d28e5e81bacca285e2a190bd32a1291e66bb0', '2015-08-05', '12:24:19', '12:24:55', '00:00:36', NULL, '127.0.0.1', '2015-08-05 10:24:19'),
(43, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '847d28e5e81bacca285e2a190bd32a1291e66bb0', '2015-08-05', '12:24:55', '12:24:57', '00:00:02', NULL, '127.0.0.1', '2015-08-05 10:24:55'),
(44, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '847d28e5e81bacca285e2a190bd32a1291e66bb0', '2015-08-05', '12:24:57', '12:24:58', '00:00:01', NULL, '127.0.0.1', '2015-08-05 10:24:57'),
(45, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '847d28e5e81bacca285e2a190bd32a1291e66bb0', '2015-08-05', '12:24:58', '12:25:52', '00:00:54', NULL, '127.0.0.1', '2015-08-05 10:24:58'),
(46, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '847d28e5e81bacca285e2a190bd32a1291e66bb0', '2015-08-05', '12:25:52', '12:25:55', '00:00:03', NULL, '127.0.0.1', '2015-08-05 10:25:52'),
(47, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '847d28e5e81bacca285e2a190bd32a1291e66bb0', '2015-08-05', '12:25:55', '12:25:56', '00:00:01', NULL, '127.0.0.1', '2015-08-05 10:25:55'),
(48, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '847d28e5e81bacca285e2a190bd32a1291e66bb0', '2015-08-05', '12:25:56', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:25:56'),
(49, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5579ef938408cda5875f544b70918ebbd476e803', '2015-08-05', '12:30:40', '12:30:44', '00:00:04', NULL, '127.0.0.1', '2015-08-05 10:30:40'),
(50, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5579ef938408cda5875f544b70918ebbd476e803', '2015-08-05', '12:30:44', '12:30:45', '00:00:01', NULL, '127.0.0.1', '2015-08-05 10:30:44'),
(51, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5579ef938408cda5875f544b70918ebbd476e803', '2015-08-05', '12:30:45', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:30:45'),
(52, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f5dd827a2f55738b5bc12dbdce45f283a104ec49', '2015-08-05', '12:43:40', '12:43:44', '00:00:04', NULL, '127.0.0.1', '2015-08-05 10:43:40'),
(53, 18, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f5dd827a2f55738b5bc12dbdce45f283a104ec49', '2015-08-05', '12:43:40', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 10:43:40'),
(54, 18, 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f5dd827a2f55738b5bc12dbdce45f283a104ec49', '2015-08-05', '12:43:44', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 10:43:44'),
(55, 18, 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '824873cd3190ce07cef8d8e45642faedee6925a1', '2015-08-05', '12:49:19', '12:49:24', '00:00:05', 'user', '127.0.0.1', '2015-08-05 10:49:19'),
(56, 18, 'http://localhost/zing/editProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '824873cd3190ce07cef8d8e45642faedee6925a1', '2015-08-05', '12:49:24', '12:50:34', '00:00:00', 'user', '127.0.0.1', '2015-08-05 10:49:24'),
(57, 18, 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '824873cd3190ce07cef8d8e45642faedee6925a1', '2015-08-05', '12:50:34', '12:50:38', '00:00:04', 'user', '127.0.0.1', '2015-08-05 10:50:34'),
(58, 18, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '824873cd3190ce07cef8d8e45642faedee6925a1', '2015-08-05', '12:50:38', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 10:50:38'),
(59, 0, 'http://localhost/zing/register', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '19d4181a2f8b15028c4350d31bcc53d8610cff65', '2015-08-05', '12:50:53', '12:55:13', '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:50:53'),
(60, 0, 'http://localhost/zing/register', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '19d4181a2f8b15028c4350d31bcc53d8610cff65', '2015-08-05', '12:55:13', '12:55:18', '00:00:05', NULL, '127.0.0.1', '2015-08-05 10:55:13'),
(61, 0, 'http://localhost/zing/doRegistration', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '19d4181a2f8b15028c4350d31bcc53d8610cff65', '2015-08-05', '12:55:18', '12:55:33', '00:00:15', NULL, '127.0.0.1', '2015-08-05 10:55:18'),
(62, 0, 'http://localhost/zing/register', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '19d4181a2f8b15028c4350d31bcc53d8610cff65', '2015-08-05', '12:55:33', '12:55:35', '00:00:02', NULL, '127.0.0.1', '2015-08-05 10:55:33'),
(63, 0, 'http://localhost/zing/register', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '19d4181a2f8b15028c4350d31bcc53d8610cff65', '2015-08-05', '12:55:35', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 10:55:35'),
(64, 0, 'http://localhost/zing/doRegistration', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:56:24', '12:56:27', '00:00:03', NULL, '127.0.0.1', '2015-08-05 10:56:24'),
(65, 0, 'http://localhost/zing/register', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:56:27', '12:58:22', '00:01:15', NULL, '127.0.0.1', '2015-08-05 10:56:27'),
(66, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:58:22', '12:58:29', '00:00:07', NULL, '127.0.0.1', '2015-08-05 10:58:22'),
(67, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:58:29', '12:58:31', '00:00:02', NULL, '127.0.0.1', '2015-08-05 10:58:29'),
(68, 26, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:58:29', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 10:58:29'),
(69, 26, 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:58:31', '12:58:34', '00:00:03', 'user', '127.0.0.1', '2015-08-05 10:58:31'),
(70, 26, 'http://localhost/zing/editProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:58:34', '12:59:29', '00:00:55', 'user', '127.0.0.1', '2015-08-05 10:58:34'),
(71, 26, 'http://localhost/zing/editProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:59:29', '12:59:39', '00:00:10', 'user', '127.0.0.1', '2015-08-05 10:59:29'),
(72, 26, 'http://localhost/zing/updateProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:59:39', '12:59:47', '00:00:08', 'user', '127.0.0.1', '2015-08-05 10:59:39'),
(73, 26, 'http://localhost/zing/editProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:59:39', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 10:59:39'),
(74, 26, 'http://localhost/zing/updateProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:59:47', '12:59:49', '00:00:02', 'user', '127.0.0.1', '2015-08-05 10:59:47'),
(75, 26, 'http://localhost/zing/editProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:59:47', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 10:59:47'),
(76, 26, 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:59:49', '12:59:55', '00:00:06', 'user', '127.0.0.1', '2015-08-05 10:59:49'),
(77, 26, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '29b6f576bb926450bd374208c277a4c564347807', '2015-08-05', '12:59:55', NULL, '00:00:00', 'user', '127.0.0.1', '2015-08-05 10:59:55'),
(78, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '47e4b0a485304d84f86ff535a0899bd90d035a92', '2015-08-05', '13:17:07', '13:17:12', '00:00:05', NULL, '127.0.0.1', '2015-08-05 11:17:07'),
(79, 0, 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '47e4b0a485304d84f86ff535a0899bd90d035a92', '2015-08-05', '13:17:12', '13:20:34', '00:02:02', NULL, '127.0.0.1', '2015-08-05 11:17:12'),
(80, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '47e4b0a485304d84f86ff535a0899bd90d035a92', '2015-08-05', '13:20:34', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 11:20:34'),
(81, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'a5a2245eae6822c94880d1e8b0ba9ba3a809513e', '2015-08-05', '13:22:51', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 11:22:51'),
(82, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '94ec84e782985c6d692de1de064755de61e3cd3b', '2015-08-05', '13:34:52', '13:36:08', '00:00:00', NULL, '127.0.0.1', '2015-08-05 11:34:52'),
(83, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '94ec84e782985c6d692de1de064755de61e3cd3b', '2015-08-05', '13:36:08', '13:37:42', '00:00:00', NULL, '127.0.0.1', '2015-08-05 11:36:08'),
(84, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '94ec84e782985c6d692de1de064755de61e3cd3b', '2015-08-05', '13:37:42', '13:39:07', '00:00:00', NULL, '127.0.0.1', '2015-08-05 11:37:42'),
(85, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '94ec84e782985c6d692de1de064755de61e3cd3b', '2015-08-05', '13:39:07', '13:39:35', '00:00:28', NULL, '127.0.0.1', '2015-08-05 11:39:07'),
(86, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '94ec84e782985c6d692de1de064755de61e3cd3b', '2015-08-05', '13:39:35', NULL, '00:00:00', NULL, '127.0.0.1', '2015-08-05 11:39:35'),
(87, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'eddad294ec12c2d72dc06fc70bab833eb99d4ffd', '2015-08-06', '05:54:35', '05:54:37', '00:00:02', NULL, '::1', '2015-08-06 03:54:35'),
(88, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'eddad294ec12c2d72dc06fc70bab833eb99d4ffd', '2015-08-06', '05:54:37', NULL, '00:00:00', NULL, '::1', '2015-08-06 03:54:37'),
(89, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'b0ffeb526d079b5fc706d271b2227f390accd678', '2015-08-06', '06:40:59', '06:42:27', '00:00:00', NULL, '::1', '2015-08-06 04:40:59'),
(90, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'b0ffeb526d079b5fc706d271b2227f390accd678', '2015-08-06', '06:42:27', NULL, '00:00:00', NULL, '::1', '2015-08-06 04:42:27'),
(91, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '22dd34fe307d8a8c2ed08befb2d138c641365a4b', '2015-08-06', '07:29:09', NULL, '00:00:00', NULL, '::1', '2015-08-06 05:29:09'),
(92, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf8ad37600661670063bef81b290c8fc2627d643', '2015-08-06', '07:36:10', '07:36:57', '00:00:47', NULL, '::1', '2015-08-06 05:36:10'),
(93, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf8ad37600661670063bef81b290c8fc2627d643', '2015-08-06', '07:36:57', '07:37:06', '00:00:09', NULL, '::1', '2015-08-06 05:36:57'),
(94, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf8ad37600661670063bef81b290c8fc2627d643', '2015-08-06', '07:37:06', '07:37:33', '00:00:27', NULL, '::1', '2015-08-06 05:37:06'),
(95, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf8ad37600661670063bef81b290c8fc2627d643', '2015-08-06', '07:37:33', NULL, '00:00:00', NULL, '::1', '2015-08-06 05:37:33'),
(96, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1d67848399b5aa0cb527985e1045589056301bd1', '2015-08-06', '07:43:44', '07:43:50', '00:00:06', NULL, '::1', '2015-08-06 05:43:44'),
(97, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1d67848399b5aa0cb527985e1045589056301bd1', '2015-08-06', '07:43:50', '07:44:47', '00:00:57', NULL, '::1', '2015-08-06 05:43:50'),
(98, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1d67848399b5aa0cb527985e1045589056301bd1', '2015-08-06', '07:44:47', '07:45:05', '00:00:18', NULL, '::1', '2015-08-06 05:44:47'),
(99, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1d67848399b5aa0cb527985e1045589056301bd1', '2015-08-06', '07:45:05', NULL, '00:00:00', NULL, '::1', '2015-08-06 05:45:05'),
(100, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '584d1f0cff686822041067ff58cb2813552683a0', '2015-08-06', '07:54:29', '07:54:41', '00:00:12', NULL, '::1', '2015-08-06 05:54:29'),
(101, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '584d1f0cff686822041067ff58cb2813552683a0', '2015-08-06', '07:54:41', '07:55:48', '00:00:00', NULL, '::1', '2015-08-06 05:54:41'),
(102, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '584d1f0cff686822041067ff58cb2813552683a0', '2015-08-06', '07:55:48', '07:55:57', '00:00:09', NULL, '::1', '2015-08-06 05:55:48'),
(103, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '584d1f0cff686822041067ff58cb2813552683a0', '2015-08-06', '07:55:57', '07:56:00', '00:00:03', NULL, '::1', '2015-08-06 05:55:57'),
(104, 26, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '584d1f0cff686822041067ff58cb2813552683a0', '2015-08-06', '07:55:57', NULL, '00:00:00', 'user', '::1', '2015-08-06 05:55:57'),
(105, 26, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '584d1f0cff686822041067ff58cb2813552683a0', '2015-08-06', '07:56:00', NULL, '00:00:00', 'user', '::1', '2015-08-06 05:56:00'),
(106, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:03:58', '08:04:00', '00:00:02', NULL, '::1', '2015-08-06 06:03:58'),
(107, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:04:00', '08:04:06', '00:00:06', NULL, '::1', '2015-08-06 06:04:00'),
(108, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:04:06', '08:06:07', '00:01:21', NULL, '::1', '2015-08-06 06:04:06'),
(109, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:06:07', '08:06:27', '00:00:20', NULL, '::1', '2015-08-06 06:06:07'),
(110, 0, 'http://localhost/zing/storeNewPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:06:27', '08:06:28', '00:00:01', NULL, '::1', '2015-08-06 06:06:27'),
(111, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:06:28', '08:06:53', '00:00:25', NULL, '::1', '2015-08-06 06:06:28'),
(112, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:06:53', '08:07:01', '00:00:08', NULL, '::1', '2015-08-06 06:06:53'),
(113, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:06:53', NULL, '00:00:00', NULL, '::1', '2015-08-06 06:06:53'),
(114, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:07:01', '08:07:01', '00:00:00', NULL, '::1', '2015-08-06 06:07:01'),
(115, 26, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1cd583149604db2e6e0e9114ebf3ecd32aa3380b', '2015-08-06', '08:07:01', NULL, '00:00:00', 'user', '::1', '2015-08-06 06:07:01'),
(116, 26, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'b3fa4b7d2bc11aa49a7ba75085d49f2dd01486fa', '2015-08-06', '08:10:12', '08:10:14', '00:00:02', 'user', '::1', '2015-08-06 06:10:12'),
(117, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'b3fa4b7d2bc11aa49a7ba75085d49f2dd01486fa', '2015-08-06', '08:10:14', '08:10:16', '00:00:02', NULL, '::1', '2015-08-06 06:10:14'),
(118, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'b3fa4b7d2bc11aa49a7ba75085d49f2dd01486fa', '2015-08-06', '08:10:16', '08:10:23', '00:00:07', NULL, '::1', '2015-08-06 06:10:16'),
(119, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'b3fa4b7d2bc11aa49a7ba75085d49f2dd01486fa', '2015-08-06', '08:10:23', NULL, '00:00:00', NULL, '::1', '2015-08-06 06:10:23'),
(120, 0, 'http://localhost/zing/forgotPassword', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:25:55', '08:26:04', '00:00:09', NULL, '::1', '2015-08-06 06:25:55'),
(121, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:26:04', '08:26:20', '00:00:16', NULL, '::1', '2015-08-06 06:26:04'),
(122, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:26:20', '08:26:22', '00:00:02', NULL, '::1', '2015-08-06 06:26:20'),
(123, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:26:22', '08:27:49', '00:00:00', 'user', '::1', '2015-08-06 06:26:22'),
(124, 9, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:26:22', NULL, '00:00:00', 'user', '::1', '2015-08-06 06:26:22'),
(125, 9, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:27:49', '08:27:57', '00:00:08', 'user', '::1', '2015-08-06 06:27:49'),
(126, 9, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:27:57', '08:27:58', '00:00:01', 'user', '::1', '2015-08-06 06:27:57'),
(127, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:27:58', '08:28:23', '00:00:25', 'user', '::1', '2015-08-06 06:27:58'),
(128, 9, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:27:58', NULL, '00:00:00', 'user', '::1', '2015-08-06 06:27:58'),
(129, 9, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:28:23', '08:28:25', '00:00:02', 'user', '::1', '2015-08-06 06:28:23'),
(130, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:28:25', '08:30:08', '00:01:03', 'user', '::1', '2015-08-06 06:28:25'),
(131, 9, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:28:25', NULL, '00:00:00', 'user', '::1', '2015-08-06 06:28:25'),
(132, 9, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:30:08', '08:30:09', '00:00:01', 'user', '::1', '2015-08-06 06:30:08'),
(133, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:30:09', '08:30:12', '00:00:03', 'user', '::1', '2015-08-06 06:30:09'),
(134, 9, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ac44eea8dff714cf19b51b1ccfdf109cb4ed569e', '2015-08-06', '08:30:12', NULL, '00:00:00', 'user', '::1', '2015-08-06 06:30:12'),
(135, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6b231d97d1aa7598c4a0ef97cf289b781046d72b', '2015-08-06', '08:30:14', '08:30:17', '00:00:03', NULL, '::1', '2015-08-06 06:30:14'),
(136, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6b231d97d1aa7598c4a0ef97cf289b781046d72b', '2015-08-06', '08:30:17', '08:30:19', '00:00:02', NULL, '::1', '2015-08-06 06:30:17'),
(137, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6b231d97d1aa7598c4a0ef97cf289b781046d72b', '2015-08-06', '08:30:19', '08:30:22', '00:00:03', 'user', '::1', '2015-08-06 06:30:19'),
(138, 9, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6b231d97d1aa7598c4a0ef97cf289b781046d72b', '2015-08-06', '08:30:22', NULL, '00:00:00', 'user', '::1', '2015-08-06 06:30:22'),
(139, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '81e50894ba4c2444f6ab73aa809da1e34c139cbd', '2015-08-06', '08:37:16', '08:37:19', '00:00:03', NULL, '::1', '2015-08-06 06:37:16'),
(140, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '81e50894ba4c2444f6ab73aa809da1e34c139cbd', '2015-08-06', '08:37:19', '08:37:21', '00:00:02', NULL, '::1', '2015-08-06 06:37:19'),
(141, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '81e50894ba4c2444f6ab73aa809da1e34c139cbd', '2015-08-06', '08:37:21', '08:37:31', '00:00:10', 'user', '::1', '2015-08-06 06:37:21'),
(142, 9, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '81e50894ba4c2444f6ab73aa809da1e34c139cbd', '2015-08-06', '08:37:31', NULL, '00:00:00', 'user', '::1', '2015-08-06 06:37:31'),
(143, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '3e4d6fdf288ba8d711f1ab5919342a07fe620492', '2015-08-06', '08:38:19', '08:38:33', '00:00:14', NULL, '::1', '2015-08-06 06:38:19'),
(144, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '3e4d6fdf288ba8d711f1ab5919342a07fe620492', '2015-08-06', '08:38:33', '08:38:35', '00:00:02', NULL, '::1', '2015-08-06 06:38:33'),
(145, 26, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '3e4d6fdf288ba8d711f1ab5919342a07fe620492', '2015-08-06', '08:38:33', NULL, '00:00:00', 'user', '::1', '2015-08-06 06:38:33'),
(146, 26, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '3e4d6fdf288ba8d711f1ab5919342a07fe620492', '2015-08-06', '08:38:35', NULL, '00:00:00', 'user', '::1', '2015-08-06 06:38:35'),
(147, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e0354dde2a3877e4e5bcde6148e3e72b714e36ac', '2015-08-06', '09:48:06', '09:48:26', '00:00:20', NULL, '::1', '2015-08-06 07:48:06'),
(148, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e0354dde2a3877e4e5bcde6148e3e72b714e36ac', '2015-08-06', '09:48:26', '09:48:27', '00:00:01', NULL, '::1', '2015-08-06 07:48:26'),
(149, 18, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e0354dde2a3877e4e5bcde6148e3e72b714e36ac', '2015-08-06', '09:48:27', '09:48:35', '00:00:08', 'user', '::1', '2015-08-06 07:48:27'),
(150, 18, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e0354dde2a3877e4e5bcde6148e3e72b714e36ac', '2015-08-06', '09:48:35', NULL, '00:00:00', 'user', '::1', '2015-08-06 07:48:35'),
(151, 0, 'http://localhost/zing/selectLocation/1', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5cfda5f35403214819265dd61cbf71d0a06dcfc1', '2015-08-06', '12:54:26', '12:54:52', '00:00:26', NULL, '::1', '2015-08-06 10:54:26'),
(152, 0, 'http://localhost/zing/selectLocation/1', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5cfda5f35403214819265dd61cbf71d0a06dcfc1', '2015-08-06', '12:54:52', NULL, '00:00:00', NULL, '::1', '2015-08-06 10:54:52'),
(153, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:20:48', '14:20:52', '00:00:04', NULL, '::1', '2015-08-06 12:20:48'),
(154, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:20:52', '14:20:58', '00:00:06', NULL, '::1', '2015-08-06 12:20:52'),
(155, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:20:58', '14:21:01', '00:00:03', NULL, '::1', '2015-08-06 12:20:58'),
(156, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:21:01', '14:21:11', '00:00:10', NULL, '::1', '2015-08-06 12:21:01'),
(157, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:21:01', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:21:01'),
(158, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:21:11', '14:21:12', '00:00:01', NULL, '::1', '2015-08-06 12:21:11'),
(159, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:21:12', '14:23:03', '00:01:11', NULL, '::1', '2015-08-06 12:21:12'),
(160, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:21:12', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:21:12'),
(161, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:23:03', '14:23:06', '00:00:03', NULL, '::1', '2015-08-06 12:23:03'),
(162, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:23:06', '14:23:09', '00:00:03', 'user', '::1', '2015-08-06 12:23:06'),
(163, 9, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7091c5d5e9c8d6ad5ad8daa19d343f0556e62ab5', '2015-08-06', '14:23:09', NULL, '00:00:00', 'user', '::1', '2015-08-06 12:23:09'),
(164, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:23:11', '14:23:13', '00:00:02', NULL, '::1', '2015-08-06 12:23:11'),
(165, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:23:13', '14:23:16', '00:00:03', NULL, '::1', '2015-08-06 12:23:13'),
(166, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:23:16', '14:23:17', '00:00:01', NULL, '::1', '2015-08-06 12:23:16'),
(167, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:23:17', '14:23:28', '00:00:11', NULL, '::1', '2015-08-06 12:23:17'),
(168, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:23:17', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:23:17'),
(169, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:23:28', '14:23:29', '00:00:01', NULL, '::1', '2015-08-06 12:23:28'),
(170, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:23:29', '14:24:27', '00:00:58', NULL, '::1', '2015-08-06 12:23:29'),
(171, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:23:29', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:23:29'),
(172, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:24:27', '14:26:25', '00:01:18', NULL, '::1', '2015-08-06 12:24:27'),
(173, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:24:27', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:24:27'),
(174, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:24:27', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:24:27'),
(175, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:25', '14:26:27', '00:00:02', NULL, '::1', '2015-08-06 12:26:25'),
(176, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:27', '14:26:28', '00:00:01', NULL, '::1', '2015-08-06 12:26:27'),
(177, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:28', '14:26:33', '00:00:05', NULL, '::1', '2015-08-06 12:26:28'),
(178, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:28', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:26:28'),
(179, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:33', '14:26:36', '00:00:03', NULL, '::1', '2015-08-06 12:26:33'),
(180, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:33', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:26:33'),
(181, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:33', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:26:33'),
(182, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:36', '14:26:37', '00:00:01', NULL, '::1', '2015-08-06 12:26:36'),
(183, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:37', '14:26:38', '00:00:01', NULL, '::1', '2015-08-06 12:26:37'),
(184, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:37', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:26:37'),
(185, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:38', '14:26:39', '00:00:01', NULL, '::1', '2015-08-06 12:26:38'),
(186, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:39', '14:26:40', '00:00:01', NULL, '::1', '2015-08-06 12:26:39'),
(187, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:39', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:26:39'),
(188, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:40', '14:26:41', '00:00:01', NULL, '::1', '2015-08-06 12:26:40'),
(189, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:40', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:26:40'),
(190, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd8d8acf71c4cab153c785de3ae76feff22a53d79', '2015-08-06', '14:26:41', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:26:41'),
(191, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:32:42', '14:32:45', '00:00:03', NULL, '::1', '2015-08-06 12:32:42'),
(192, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:32:45', '14:34:19', '00:00:00', NULL, '::1', '2015-08-06 12:32:45'),
(193, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:32:45', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:32:45'),
(194, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:32:45', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:32:45'),
(195, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:34:19', '14:34:21', '00:00:02', NULL, '::1', '2015-08-06 12:34:19'),
(196, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:34:21', '14:34:21', '00:00:00', NULL, '::1', '2015-08-06 12:34:21'),
(197, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:34:22', '14:34:29', '00:00:07', NULL, '::1', '2015-08-06 12:34:22'),
(198, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:34:29', '14:34:30', '00:00:01', NULL, '::1', '2015-08-06 12:34:29'),
(199, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:34:30', '14:34:32', '00:00:02', 'user', '::1', '2015-08-06 12:34:30'),
(200, 9, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:34:32', '14:34:35', '00:00:03', 'user', '::1', '2015-08-06 12:34:32'),
(201, 9, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:34:35', '14:36:08', '00:00:00', 'user', '::1', '2015-08-06 12:34:35'),
(202, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:34:35', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:34:35'),
(203, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:36:08', '14:36:11', '00:00:03', NULL, '::1', '2015-08-06 12:36:08'),
(204, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:36:11', '14:36:27', '00:00:16', NULL, '::1', '2015-08-06 12:36:11'),
(205, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:36:27', '14:36:30', '00:00:03', NULL, '::1', '2015-08-06 12:36:27');
INSERT INTO `user_activity_log_details` (`id`, `user_id`, `url_visited`, `user_agent`, `session_id`, `date`, `start_time`, `end_time`, `duration`, `user_type`, `ip_address`, `created_at`) VALUES
(206, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e7587da3692a5c0a1d5c5269f9403911b1e1c0ef', '2015-08-06', '14:36:30', NULL, '00:00:00', NULL, '::1', '2015-08-06 12:36:30'),
(207, 0, 'http://localhost/zing/selectLocation/1', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9c4a9edf5bc7ebaf63d8dd71dc8589981b3b065d', '2015-08-07', '06:14:01', '06:14:32', '00:00:31', NULL, '::1', '2015-08-07 04:14:01'),
(208, 0, 'http://localhost/zing/selectLocation/1', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9c4a9edf5bc7ebaf63d8dd71dc8589981b3b065d', '2015-08-07', '06:14:32', NULL, '00:00:00', NULL, '::1', '2015-08-07 04:14:32'),
(209, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bb35cb2f63471a3830bc0a65f0185a5ac24f9164', '2015-08-07', '07:10:15', '07:10:32', '00:00:17', NULL, '::1', '2015-08-07 05:10:15'),
(210, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bb35cb2f63471a3830bc0a65f0185a5ac24f9164', '2015-08-07', '07:10:33', NULL, '00:00:00', NULL, '::1', '2015-08-07 05:10:33'),
(211, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '8827156393794e58b4a25de9fadb76dd6dbe121a', '2015-08-07', '07:35:42', '07:37:02', '00:00:00', NULL, '::1', '2015-08-07 05:35:42'),
(212, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '8827156393794e58b4a25de9fadb76dd6dbe121a', '2015-08-07', '07:37:02', '07:37:51', '00:00:49', NULL, '::1', '2015-08-07 05:37:02'),
(213, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '8827156393794e58b4a25de9fadb76dd6dbe121a', '2015-08-07', '07:37:51', '07:38:08', '00:00:17', NULL, '::1', '2015-08-07 05:37:51'),
(214, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '8827156393794e58b4a25de9fadb76dd6dbe121a', '2015-08-07', '07:38:08', NULL, '00:00:00', NULL, '::1', '2015-08-07 05:38:08'),
(215, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5eea89170ec0cf09df1ca9f9e0f5425b6c82ebae', '2015-08-07', '07:41:14', '07:41:38', '00:00:24', NULL, '::1', '2015-08-07 05:41:14'),
(216, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5eea89170ec0cf09df1ca9f9e0f5425b6c82ebae', '2015-08-07', '07:41:38', '07:41:47', '00:00:09', NULL, '::1', '2015-08-07 05:41:38'),
(217, 0, 'http://localhost/zing/test', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5eea89170ec0cf09df1ca9f9e0f5425b6c82ebae', '2015-08-07', '07:41:48', '07:46:13', '00:00:00', NULL, '::1', '2015-08-07 05:41:48'),
(218, 0, 'http://localhost/zing/test', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5eea89170ec0cf09df1ca9f9e0f5425b6c82ebae', '2015-08-07', '07:46:13', NULL, '00:00:00', NULL, '::1', '2015-08-07 05:46:13'),
(219, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '75d30f1dab2b9717c2e1196d60b2c8241e8102d1', '2015-08-07', '07:46:24', '07:47:01', '00:00:37', NULL, '::1', '2015-08-07 05:46:24'),
(220, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '75d30f1dab2b9717c2e1196d60b2c8241e8102d1', '2015-08-07', '07:47:01', '07:47:10', '00:00:09', NULL, '::1', '2015-08-07 05:47:01'),
(221, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '75d30f1dab2b9717c2e1196d60b2c8241e8102d1', '2015-08-07', '07:47:10', '07:49:16', '00:01:26', NULL, '::1', '2015-08-07 05:47:10'),
(222, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '75d30f1dab2b9717c2e1196d60b2c8241e8102d1', '2015-08-07', '07:49:16', '07:49:19', '00:00:03', NULL, '::1', '2015-08-07 05:49:16'),
(223, 0, 'http://localhost/zing/test', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '75d30f1dab2b9717c2e1196d60b2c8241e8102d1', '2015-08-07', '07:49:19', '07:49:20', '00:00:01', NULL, '::1', '2015-08-07 05:49:19'),
(224, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '75d30f1dab2b9717c2e1196d60b2c8241e8102d1', '2015-08-07', '07:49:20', '07:49:21', '00:00:01', NULL, '::1', '2015-08-07 05:49:20'),
(225, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '75d30f1dab2b9717c2e1196d60b2c8241e8102d1', '2015-08-07', '07:49:21', '07:49:32', '00:00:11', NULL, '::1', '2015-08-07 05:49:21'),
(226, 0, 'http://localhost/zing/healthclubs', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '75d30f1dab2b9717c2e1196d60b2c8241e8102d1', '2015-08-07', '07:49:32', '07:49:36', '00:00:04', NULL, '::1', '2015-08-07 05:49:32'),
(227, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '75d30f1dab2b9717c2e1196d60b2c8241e8102d1', '2015-08-07', '07:49:36', NULL, '00:00:00', NULL, '::1', '2015-08-07 05:49:36'),
(228, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4390b93f554c6523fc613c3cfc2f742e182d881d', '2015-08-07', '07:58:21', '08:01:07', '00:00:00', NULL, '::1', '2015-08-07 05:58:21'),
(229, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4390b93f554c6523fc613c3cfc2f742e182d881d', '2015-08-07', '08:01:07', '08:01:23', '00:00:16', NULL, '::1', '2015-08-07 06:01:07'),
(230, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4390b93f554c6523fc613c3cfc2f742e182d881d', '2015-08-07', '08:01:23', NULL, '00:00:00', NULL, '::1', '2015-08-07 06:01:23'),
(231, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5c0e4085d3acf9a1697214450fd4406c46ed4c8a', '2015-08-07', '08:08:57', NULL, '00:00:00', NULL, '::1', '2015-08-07 06:08:57'),
(232, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9463feaee93beadbbadef401eb4c6d2c3961ebc1', '2015-08-07', '08:28:57', '08:32:11', '00:00:00', NULL, '::1', '2015-08-07 06:28:57'),
(233, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9463feaee93beadbbadef401eb4c6d2c3961ebc1', '2015-08-07', '08:32:11', '08:33:07', '00:00:56', NULL, '::1', '2015-08-07 06:32:11'),
(234, 0, 'http://localhost/zing/spa/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9463feaee93beadbbadef401eb4c6d2c3961ebc1', '2015-08-07', '08:33:07', '08:33:53', '00:00:46', NULL, '::1', '2015-08-07 06:33:07'),
(235, 0, 'http://localhost/zing/spa/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9463feaee93beadbbadef401eb4c6d2c3961ebc1', '2015-08-07', '08:33:53', NULL, '00:00:00', NULL, '::1', '2015-08-07 06:33:53'),
(236, 0, 'http://localhost/zing/spa/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c37003a8b726b50386f14f9bbb8ce5e84a82a140', '2015-08-07', '08:34:34', '08:34:40', '00:00:06', NULL, '::1', '2015-08-07 06:34:34'),
(237, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c37003a8b726b50386f14f9bbb8ce5e84a82a140', '2015-08-07', '08:34:40', '08:34:42', '00:00:02', NULL, '::1', '2015-08-07 06:34:40'),
(238, 0, 'http://localhost/zing/spa/7', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c37003a8b726b50386f14f9bbb8ce5e84a82a140', '2015-08-07', '08:34:42', '08:34:44', '00:00:02', NULL, '::1', '2015-08-07 06:34:42'),
(239, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c37003a8b726b50386f14f9bbb8ce5e84a82a140', '2015-08-07', '08:34:44', '08:34:48', '00:00:04', NULL, '::1', '2015-08-07 06:34:44'),
(240, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c37003a8b726b50386f14f9bbb8ce5e84a82a140', '2015-08-07', '08:34:48', '08:34:49', '00:00:01', NULL, '::1', '2015-08-07 06:34:48'),
(241, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c37003a8b726b50386f14f9bbb8ce5e84a82a140', '2015-08-07', '08:34:49', NULL, '00:00:00', NULL, '::1', '2015-08-07 06:34:49'),
(242, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '741d86562646137e1a463348c1602f484072d926', '2015-08-07', '09:08:06', '09:08:52', '00:00:46', NULL, '::1', '2015-08-07 07:08:06'),
(243, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '741d86562646137e1a463348c1602f484072d926', '2015-08-07', '09:08:52', '09:09:14', '00:00:22', NULL, '::1', '2015-08-07 07:08:52'),
(244, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '741d86562646137e1a463348c1602f484072d926', '2015-08-07', '09:09:14', '09:10:24', '00:00:00', NULL, '::1', '2015-08-07 07:09:14'),
(245, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '741d86562646137e1a463348c1602f484072d926', '2015-08-07', '09:10:24', '09:10:43', '00:00:19', NULL, '::1', '2015-08-07 07:10:24'),
(246, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '741d86562646137e1a463348c1602f484072d926', '2015-08-07', '09:10:43', '09:10:46', '00:00:03', NULL, '::1', '2015-08-07 07:10:43'),
(247, 0, 'http://localhost/zing/spa/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '741d86562646137e1a463348c1602f484072d926', '2015-08-07', '09:10:46', '09:10:59', '00:00:13', NULL, '::1', '2015-08-07 07:10:46'),
(248, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '741d86562646137e1a463348c1602f484072d926', '2015-08-07', '09:10:59', '09:12:07', '00:00:00', NULL, '::1', '2015-08-07 07:10:59'),
(249, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '741d86562646137e1a463348c1602f484072d926', '2015-08-07', '09:12:07', NULL, '00:00:00', NULL, '::1', '2015-08-07 07:12:07'),
(250, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd859276c111f05db6a091274026c6aadfaa45115', '2015-08-07', '09:13:27', '09:16:49', '00:02:02', NULL, '::1', '2015-08-07 07:13:27'),
(251, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd859276c111f05db6a091274026c6aadfaa45115', '2015-08-07', '09:16:49', '09:17:02', '00:00:13', NULL, '::1', '2015-08-07 07:16:49'),
(252, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd859276c111f05db6a091274026c6aadfaa45115', '2015-08-07', '09:17:02', '09:17:08', '00:00:06', NULL, '::1', '2015-08-07 07:17:02'),
(253, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd859276c111f05db6a091274026c6aadfaa45115', '2015-08-07', '09:17:08', '09:17:52', '00:00:44', NULL, '::1', '2015-08-07 07:17:08'),
(254, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd859276c111f05db6a091274026c6aadfaa45115', '2015-08-07', '09:17:52', NULL, '00:00:00', NULL, '::1', '2015-08-07 07:17:52'),
(255, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:19:49', '09:20:40', '00:00:51', NULL, '::1', '2015-08-07 07:19:49'),
(256, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:20:40', '09:21:06', '00:00:26', NULL, '::1', '2015-08-07 07:20:40'),
(257, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:21:06', '09:21:30', '00:00:24', NULL, '::1', '2015-08-07 07:21:06'),
(258, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:21:30', '09:21:43', '00:00:13', NULL, '::1', '2015-08-07 07:21:30'),
(259, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:21:44', '09:22:33', '00:00:49', NULL, '::1', '2015-08-07 07:21:44'),
(260, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:22:33', '09:23:01', '00:00:28', NULL, '::1', '2015-08-07 07:22:33'),
(261, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:23:01', '09:23:04', '00:00:03', NULL, '::1', '2015-08-07 07:23:01'),
(262, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:23:04', '09:23:07', '00:00:03', NULL, '::1', '2015-08-07 07:23:04'),
(263, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:23:07', '09:23:08', '00:00:01', NULL, '::1', '2015-08-07 07:23:07'),
(264, 0, 'http://localhost/zing/yoga/7', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:23:08', '09:23:11', '00:00:03', NULL, '::1', '2015-08-07 07:23:08'),
(265, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:23:11', '09:24:11', '00:00:00', NULL, '::1', '2015-08-07 07:23:11'),
(266, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1246032b2ca784f75062d68ff5183b8660811510', '2015-08-07', '09:24:11', NULL, '00:00:00', NULL, '::1', '2015-08-07 07:24:11'),
(267, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:32:08', '09:32:14', '00:00:06', NULL, '::1', '2015-08-07 07:32:08'),
(268, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:32:14', '09:32:27', '00:00:13', NULL, '::1', '2015-08-07 07:32:14'),
(269, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:32:27', '09:34:06', '00:00:00', NULL, '::1', '2015-08-07 07:32:27'),
(270, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:34:06', '09:34:14', '00:00:08', NULL, '::1', '2015-08-07 07:34:06'),
(271, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:34:14', '09:34:27', '00:00:13', NULL, '::1', '2015-08-07 07:34:14'),
(272, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:34:27', '09:34:28', '00:00:01', NULL, '::1', '2015-08-07 07:34:27'),
(273, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:34:28', '09:35:03', '00:00:35', NULL, '::1', '2015-08-07 07:34:28'),
(274, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:34:28', NULL, '00:00:00', NULL, '::1', '2015-08-07 07:34:28'),
(275, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:34:28', NULL, '00:00:00', NULL, '::1', '2015-08-07 07:34:28'),
(276, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:34:28', NULL, '00:00:00', NULL, '::1', '2015-08-07 07:34:28'),
(277, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:34:28', NULL, '00:00:00', NULL, '::1', '2015-08-07 07:34:28'),
(278, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:35:03', '09:35:30', '00:00:27', NULL, '::1', '2015-08-07 07:35:03'),
(279, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:35:30', '09:36:06', '00:00:36', NULL, '::1', '2015-08-07 07:35:30'),
(280, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:36:07', '09:36:15', '00:00:08', NULL, '::1', '2015-08-07 07:36:07'),
(281, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4d6f9b70928d0cd65b7cd4bd5ddb9f7254ad2a16', '2015-08-07', '09:36:15', NULL, '00:00:00', NULL, '::1', '2015-08-07 07:36:15'),
(282, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '726d20ccf92d32065e422ee40484c94d71c7e4c9', '2015-08-07', '09:53:32', '09:53:48', '00:00:16', NULL, '::1', '2015-08-07 07:53:32'),
(283, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '726d20ccf92d32065e422ee40484c94d71c7e4c9', '2015-08-07', '09:53:48', '09:53:49', '00:00:01', NULL, '::1', '2015-08-07 07:53:48'),
(284, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '726d20ccf92d32065e422ee40484c94d71c7e4c9', '2015-08-07', '09:53:49', '09:54:13', '00:00:24', NULL, '::1', '2015-08-07 07:53:49'),
(285, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '726d20ccf92d32065e422ee40484c94d71c7e4c9', '2015-08-07', '09:54:13', '09:54:46', '00:00:33', NULL, '::1', '2015-08-07 07:54:13'),
(286, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '726d20ccf92d32065e422ee40484c94d71c7e4c9', '2015-08-07', '09:54:46', '09:55:52', '00:00:00', NULL, '::1', '2015-08-07 07:54:46'),
(287, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '726d20ccf92d32065e422ee40484c94d71c7e4c9', '2015-08-07', '09:55:52', '09:56:02', '00:00:10', NULL, '::1', '2015-08-07 07:55:52'),
(288, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '726d20ccf92d32065e422ee40484c94d71c7e4c9', '2015-08-07', '09:56:02', '09:56:04', '00:00:02', NULL, '::1', '2015-08-07 07:56:02'),
(289, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '726d20ccf92d32065e422ee40484c94d71c7e4c9', '2015-08-07', '09:56:04', '09:56:09', '00:00:05', 'user', '::1', '2015-08-07 07:56:04'),
(290, 9, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '726d20ccf92d32065e422ee40484c94d71c7e4c9', '2015-08-07', '09:56:10', NULL, '00:00:00', 'user', '::1', '2015-08-07 07:56:10'),
(291, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e8759144a36e75f1194426cb64dc86b3768acaea', '2015-08-07', '09:56:29', '09:56:33', '00:00:04', NULL, '::1', '2015-08-07 07:56:29'),
(292, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e8759144a36e75f1194426cb64dc86b3768acaea', '2015-08-07', '09:56:33', '09:56:34', '00:00:01', NULL, '::1', '2015-08-07 07:56:33'),
(293, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e8759144a36e75f1194426cb64dc86b3768acaea', '2015-08-07', '09:56:34', '09:56:37', '00:00:03', 'user', '::1', '2015-08-07 07:56:34'),
(294, 9, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e8759144a36e75f1194426cb64dc86b3768acaea', '2015-08-07', '09:56:37', NULL, '00:00:00', 'user', '::1', '2015-08-07 07:56:37'),
(295, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '285d1d776b4bded615ed3d1d4535d82840a567df', '2015-08-07', '09:56:39', '09:56:41', '00:00:02', NULL, '::1', '2015-08-07 07:56:39'),
(296, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '285d1d776b4bded615ed3d1d4535d82840a567df', '2015-08-07', '09:56:41', '09:56:45', '00:00:04', NULL, '::1', '2015-08-07 07:56:41'),
(297, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '285d1d776b4bded615ed3d1d4535d82840a567df', '2015-08-07', '09:56:45', '09:56:47', '00:00:02', NULL, '::1', '2015-08-07 07:56:45'),
(298, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '285d1d776b4bded615ed3d1d4535d82840a567df', '2015-08-07', '09:56:47', '09:56:47', '00:00:00', NULL, '::1', '2015-08-07 07:56:47'),
(299, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '285d1d776b4bded615ed3d1d4535d82840a567df', '2015-08-07', '09:56:47', NULL, '00:00:00', NULL, '::1', '2015-08-07 07:56:47'),
(300, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1e58a79500433640877aa5be1893f013d6440579', '2015-08-07', '11:46:12', '11:46:15', '00:00:03', NULL, '::1', '2015-08-07 09:46:12'),
(301, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1e58a79500433640877aa5be1893f013d6440579', '2015-08-07', '11:46:15', '11:46:16', '00:00:01', NULL, '::1', '2015-08-07 09:46:15'),
(302, 9, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1e58a79500433640877aa5be1893f013d6440579', '2015-08-07', '11:46:16', '11:46:34', '00:00:18', 'user', '::1', '2015-08-07 09:46:16'),
(303, 9, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1e58a79500433640877aa5be1893f013d6440579', '2015-08-07', '11:46:34', NULL, '00:00:00', 'user', '::1', '2015-08-07 09:46:34'),
(304, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '722f3f855cc92711928bce9bd84f4c67a46c9b1c', '2015-08-07', '11:46:36', '11:48:34', '00:01:18', NULL, '::1', '2015-08-07 09:46:36'),
(305, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '722f3f855cc92711928bce9bd84f4c67a46c9b1c', '2015-08-07', '11:48:34', '11:48:46', '00:00:12', NULL, '::1', '2015-08-07 09:48:34'),
(306, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '722f3f855cc92711928bce9bd84f4c67a46c9b1c', '2015-08-07', '11:48:46', '11:50:41', '00:01:15', NULL, '::1', '2015-08-07 09:48:46'),
(307, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '722f3f855cc92711928bce9bd84f4c67a46c9b1c', '2015-08-07', '11:50:41', '11:50:45', '00:00:04', NULL, '::1', '2015-08-07 09:50:41'),
(308, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '722f3f855cc92711928bce9bd84f4c67a46c9b1c', '2015-08-07', '11:50:45', '11:51:05', '00:00:20', NULL, '::1', '2015-08-07 09:50:45'),
(309, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '722f3f855cc92711928bce9bd84f4c67a46c9b1c', '2015-08-07', '11:51:05', '11:51:16', '00:00:11', NULL, '::1', '2015-08-07 09:51:05'),
(310, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '722f3f855cc92711928bce9bd84f4c67a46c9b1c', '2015-08-07', '11:51:16', '11:51:18', '00:00:02', NULL, '::1', '2015-08-07 09:51:16'),
(311, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '722f3f855cc92711928bce9bd84f4c67a46c9b1c', '2015-08-07', '11:51:18', '11:51:18', '00:00:00', NULL, '::1', '2015-08-07 09:51:18'),
(312, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '722f3f855cc92711928bce9bd84f4c67a46c9b1c', '2015-08-07', '11:51:18', NULL, '00:00:00', NULL, '::1', '2015-08-07 09:51:18'),
(313, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:52:44', '11:53:16', '00:00:32', NULL, '::1', '2015-08-07 09:52:44'),
(314, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:53:16', '11:53:19', '00:00:03', NULL, '::1', '2015-08-07 09:53:16'),
(315, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:53:19', '11:53:23', '00:00:04', NULL, '::1', '2015-08-07 09:53:19'),
(316, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:53:23', '11:56:28', '00:00:00', NULL, '::1', '2015-08-07 09:53:23'),
(317, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:56:28', '11:56:32', '00:00:04', NULL, '::1', '2015-08-07 09:56:28'),
(318, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:56:32', '11:56:35', '00:00:03', NULL, '::1', '2015-08-07 09:56:32'),
(319, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:56:35', '11:57:07', '00:00:32', NULL, '::1', '2015-08-07 09:56:35'),
(320, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:57:07', '11:57:10', '00:00:03', NULL, '::1', '2015-08-07 09:57:07'),
(321, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:57:10', '11:57:13', '00:00:03', NULL, '::1', '2015-08-07 09:57:10'),
(322, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1a02c0bd41ab9828589a275deee58c923e911288', '2015-08-07', '11:57:13', NULL, '00:00:00', NULL, '::1', '2015-08-07 09:57:13'),
(323, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e9ff05fc061e7fc1459d965d56bc75708c75a242', '2015-08-07', '11:58:00', '11:58:05', '00:00:05', NULL, '::1', '2015-08-07 09:58:00'),
(324, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e9ff05fc061e7fc1459d965d56bc75708c75a242', '2015-08-07', '11:58:05', '11:58:08', '00:00:03', NULL, '::1', '2015-08-07 09:58:05'),
(325, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e9ff05fc061e7fc1459d965d56bc75708c75a242', '2015-08-07', '11:58:08', '12:02:14', '00:02:46', NULL, '::1', '2015-08-07 09:58:08'),
(326, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e9ff05fc061e7fc1459d965d56bc75708c75a242', '2015-08-07', '12:02:14', '12:02:16', '00:00:02', NULL, '::1', '2015-08-07 10:02:14'),
(327, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e9ff05fc061e7fc1459d965d56bc75708c75a242', '2015-08-07', '12:02:16', '12:02:19', '00:00:03', NULL, '::1', '2015-08-07 10:02:16'),
(328, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e9ff05fc061e7fc1459d965d56bc75708c75a242', '2015-08-07', '12:02:19', '12:02:53', '00:00:34', NULL, '::1', '2015-08-07 10:02:19'),
(329, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e9ff05fc061e7fc1459d965d56bc75708c75a242', '2015-08-07', '12:02:53', '12:02:56', '00:00:03', NULL, '::1', '2015-08-07 10:02:53'),
(330, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e9ff05fc061e7fc1459d965d56bc75708c75a242', '2015-08-07', '12:02:56', NULL, '00:00:00', NULL, '::1', '2015-08-07 10:02:56'),
(331, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce42855ed358c03a12cbdae847287aef0bf7b90a', '2015-08-07', '12:03:08', '12:03:10', '00:00:02', NULL, '::1', '2015-08-07 10:03:08'),
(332, 47, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce42855ed358c03a12cbdae847287aef0bf7b90a', '2015-08-07', '12:03:10', '12:03:12', '00:00:02', 'user', '::1', '2015-08-07 10:03:10'),
(333, 47, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce42855ed358c03a12cbdae847287aef0bf7b90a', '2015-08-07', '12:03:12', NULL, '00:00:00', 'user', '::1', '2015-08-07 10:03:12'),
(334, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7dc6b230f6363d5aff1862593c1e36e70be77e87', '2015-08-07', '12:03:24', '12:03:27', '00:00:03', NULL, '::1', '2015-08-07 10:03:24'),
(335, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7dc6b230f6363d5aff1862593c1e36e70be77e87', '2015-08-07', '12:03:27', '12:03:29', '00:00:02', NULL, '::1', '2015-08-07 10:03:27'),
(336, 47, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7dc6b230f6363d5aff1862593c1e36e70be77e87', '2015-08-07', '12:03:29', '12:04:59', '00:00:00', 'user', '::1', '2015-08-07 10:03:29'),
(337, 47, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7dc6b230f6363d5aff1862593c1e36e70be77e87', '2015-08-07', '12:04:59', NULL, '00:00:00', 'user', '::1', '2015-08-07 10:04:59'),
(338, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '86b314004e7ed27825a3dd6167084c2239374a20', '2015-08-07', '12:05:01', '12:05:03', '00:00:02', NULL, '::1', '2015-08-07 10:05:01'),
(339, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '86b314004e7ed27825a3dd6167084c2239374a20', '2015-08-07', '12:05:03', '12:05:06', '00:00:03', NULL, '::1', '2015-08-07 10:05:03'),
(340, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '86b314004e7ed27825a3dd6167084c2239374a20', '2015-08-07', '12:05:06', '12:05:07', '00:00:01', NULL, '::1', '2015-08-07 10:05:06'),
(341, 48, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '86b314004e7ed27825a3dd6167084c2239374a20', '2015-08-07', '12:05:07', '12:05:10', '00:00:03', 'user', '::1', '2015-08-07 10:05:07'),
(342, 48, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '86b314004e7ed27825a3dd6167084c2239374a20', '2015-08-07', '12:05:10', NULL, '00:00:00', 'user', '::1', '2015-08-07 10:05:10'),
(343, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '27c919936184bac5416a16268248d5572556ad23', '2015-08-07', '12:05:23', '12:05:31', '00:00:08', NULL, '::1', '2015-08-07 10:05:23'),
(344, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '27c919936184bac5416a16268248d5572556ad23', '2015-08-07', '12:05:31', '12:05:35', '00:00:04', NULL, '::1', '2015-08-07 10:05:31'),
(345, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '27c919936184bac5416a16268248d5572556ad23', '2015-08-07', '12:05:35', '12:05:36', '00:00:01', NULL, '::1', '2015-08-07 10:05:35'),
(346, 48, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '27c919936184bac5416a16268248d5572556ad23', '2015-08-07', '12:05:36', '12:05:38', '00:00:02', 'user', '::1', '2015-08-07 10:05:36'),
(347, 48, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '27c919936184bac5416a16268248d5572556ad23', '2015-08-07', '12:05:38', NULL, '00:00:00', 'user', '::1', '2015-08-07 10:05:38'),
(348, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4ff321505a0c8213e46bf44f97665755d7e67762', '2015-08-07', '12:05:42', '12:06:24', '00:00:42', NULL, '::1', '2015-08-07 10:05:42'),
(349, 0, 'http://localhost/zing/facebbokLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4ff321505a0c8213e46bf44f97665755d7e67762', '2015-08-07', '12:06:24', '12:06:25', '00:00:01', NULL, '::1', '2015-08-07 10:06:24'),
(350, 47, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4ff321505a0c8213e46bf44f97665755d7e67762', '2015-08-07', '12:06:25', '12:06:36', '00:00:11', 'user', '::1', '2015-08-07 10:06:25'),
(351, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '7c05eea0bb164034d72415760fc32277cf9eef37', '2015-08-07', '12:06:32', NULL, '00:00:00', NULL, '::1', '2015-08-07 10:06:32'),
(352, 47, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4ff321505a0c8213e46bf44f97665755d7e67762', '2015-08-07', '12:06:36', '12:06:39', '00:00:03', 'user', '::1', '2015-08-07 10:06:36'),
(353, 47, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4ff321505a0c8213e46bf44f97665755d7e67762', '2015-08-07', '12:06:39', NULL, '00:00:00', 'user', '::1', '2015-08-07 10:06:39'),
(354, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:02:24', '13:02:37', '00:00:13', NULL, '::1', '2015-08-07 11:02:24'),
(355, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:02:37', '13:03:28', '00:00:51', NULL, '::1', '2015-08-07 11:02:37'),
(356, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:03:28', '13:03:36', '00:00:08', NULL, '::1', '2015-08-07 11:03:28'),
(357, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:03:36', '13:03:37', '00:00:01', NULL, '::1', '2015-08-07 11:03:36'),
(358, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:03:37', '13:03:45', '00:00:08', NULL, '::1', '2015-08-07 11:03:37'),
(359, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:03:37', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:03:37'),
(360, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:03:45', '13:04:14', '00:00:29', NULL, '::1', '2015-08-07 11:03:45'),
(361, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:04:14', '13:04:15', '00:00:01', NULL, '::1', '2015-08-07 11:04:14'),
(362, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:04:15', '13:04:16', '00:00:01', NULL, '::1', '2015-08-07 11:04:15'),
(363, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:04:15', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:04:15'),
(364, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:04:16', '13:04:36', '00:00:20', NULL, '::1', '2015-08-07 11:04:16'),
(365, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:04:36', '13:04:49', '00:00:13', NULL, '::1', '2015-08-07 11:04:36'),
(366, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9db717fabf088fefab64c0433405fe7c8be54a12', '2015-08-07', '13:04:49', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:04:49'),
(367, 0, 'http://localhost/zing/yoga/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'fbe8ad8057a7e16acd48e09a3fcc36ba124a86d1', '2015-08-07', '13:08:53', '13:08:58', '00:00:05', NULL, '::1', '2015-08-07 11:08:53'),
(368, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'fbe8ad8057a7e16acd48e09a3fcc36ba124a86d1', '2015-08-07', '13:08:58', '13:09:12', '00:00:14', NULL, '::1', '2015-08-07 11:08:58'),
(369, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'fbe8ad8057a7e16acd48e09a3fcc36ba124a86d1', '2015-08-07', '13:09:12', '13:09:13', '00:00:01', NULL, '::1', '2015-08-07 11:09:12'),
(370, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'fbe8ad8057a7e16acd48e09a3fcc36ba124a86d1', '2015-08-07', '13:09:13', '13:10:24', '00:00:00', NULL, '::1', '2015-08-07 11:09:13'),
(371, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'fbe8ad8057a7e16acd48e09a3fcc36ba124a86d1', '2015-08-07', '13:10:24', '13:10:25', '00:00:01', NULL, '::1', '2015-08-07 11:10:24'),
(372, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'fbe8ad8057a7e16acd48e09a3fcc36ba124a86d1', '2015-08-07', '13:10:25', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:10:25'),
(373, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:15:01', '13:16:05', '00:00:00', NULL, '::1', '2015-08-07 11:15:01'),
(374, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:05', '13:16:05', '00:00:00', NULL, '::1', '2015-08-07 11:16:05'),
(375, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:05', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:16:05'),
(376, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:05', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:16:05'),
(377, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:05', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:16:05'),
(378, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:05', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:16:05'),
(379, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:05', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:16:05'),
(380, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:06', '13:16:13', '00:00:07', NULL, '::1', '2015-08-07 11:16:06'),
(381, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:06', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:16:06'),
(382, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:13', '13:16:45', '00:00:32', NULL, '::1', '2015-08-07 11:16:13'),
(383, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '387bf94c5eec93eb7a69eafc77ca28e7a0e1ad37', '2015-08-07', '13:16:45', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:16:45'),
(384, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e74694d059e05f80ff533e0d7cbe615cbbf0b62d', '2015-08-07', '13:21:42', '13:23:13', '00:00:00', NULL, '::1', '2015-08-07 11:21:42'),
(385, 0, 'http://localhost/zing/providerDetails', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e74694d059e05f80ff533e0d7cbe615cbbf0b62d', '2015-08-07', '13:23:13', '13:23:24', '00:00:11', NULL, '::1', '2015-08-07 11:23:13'),
(386, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e74694d059e05f80ff533e0d7cbe615cbbf0b62d', '2015-08-07', '13:23:24', '13:23:32', '00:00:08', NULL, '::1', '2015-08-07 11:23:24'),
(387, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e74694d059e05f80ff533e0d7cbe615cbbf0b62d', '2015-08-07', '13:23:32', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:23:32'),
(388, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '38c7a89c9151f420c48f8d6258bade1629fcc831', '2015-08-07', '13:30:49', '13:31:06', '00:00:17', NULL, '::1', '2015-08-07 11:30:49'),
(389, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '38c7a89c9151f420c48f8d6258bade1629fcc831', '2015-08-07', '13:31:06', '13:31:23', '00:00:17', NULL, '::1', '2015-08-07 11:31:06'),
(390, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '38c7a89c9151f420c48f8d6258bade1629fcc831', '2015-08-07', '13:31:23', '13:32:12', '00:00:49', NULL, '::1', '2015-08-07 11:31:23'),
(391, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '38c7a89c9151f420c48f8d6258bade1629fcc831', '2015-08-07', '13:32:12', '13:32:30', '00:00:18', NULL, '::1', '2015-08-07 11:32:12'),
(392, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '38c7a89c9151f420c48f8d6258bade1629fcc831', '2015-08-07', '13:32:30', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:32:30'),
(393, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd330afef29829fc1293ecb2aabda37ba6f657186', '2015-08-07', '13:36:19', '13:36:20', '00:00:01', NULL, '::1', '2015-08-07 11:36:19'),
(394, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd330afef29829fc1293ecb2aabda37ba6f657186', '2015-08-07', '13:36:20', '13:39:49', '00:02:09', NULL, '::1', '2015-08-07 11:36:20'),
(395, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd330afef29829fc1293ecb2aabda37ba6f657186', '2015-08-07', '13:39:49', '13:39:54', '00:00:05', NULL, '::1', '2015-08-07 11:39:49'),
(396, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd330afef29829fc1293ecb2aabda37ba6f657186', '2015-08-07', '13:39:54', '13:40:03', '00:00:09', NULL, '::1', '2015-08-07 11:39:54'),
(397, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd330afef29829fc1293ecb2aabda37ba6f657186', '2015-08-07', '13:40:03', '13:40:27', '00:00:24', NULL, '::1', '2015-08-07 11:40:03'),
(398, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'd330afef29829fc1293ecb2aabda37ba6f657186', '2015-08-07', '13:40:27', NULL, '00:00:00', NULL, '::1', '2015-08-07 11:40:27'),
(399, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1ed428df4e5a0738667a1d099462810aced4e04c', '2015-08-07', '14:15:15', '14:15:17', '00:00:02', NULL, '::1', '2015-08-07 12:15:15'),
(400, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1ed428df4e5a0738667a1d099462810aced4e04c', '2015-08-07', '14:15:17', '14:15:32', '00:00:15', NULL, '::1', '2015-08-07 12:15:17'),
(401, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1ed428df4e5a0738667a1d099462810aced4e04c', '2015-08-07', '14:15:32', '14:15:35', '00:00:03', NULL, '::1', '2015-08-07 12:15:32'),
(402, 48, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1ed428df4e5a0738667a1d099462810aced4e04c', '2015-08-07', '14:15:35', NULL, '00:00:00', 'user', '::1', '2015-08-07 12:15:35'),
(403, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e62da7bf9473a69031bbf882346ab63a5fa66f5c', '2015-08-10', '06:18:34', '06:18:38', '00:00:04', NULL, '::1', '2015-08-10 04:18:34'),
(404, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e62da7bf9473a69031bbf882346ab63a5fa66f5c', '2015-08-10', '06:18:38', '06:18:41', '00:00:03', NULL, '::1', '2015-08-10 04:18:38'),
(405, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'e62da7bf9473a69031bbf882346ab63a5fa66f5c', '2015-08-10', '06:18:41', NULL, '00:00:00', NULL, '::1', '2015-08-10 04:18:41'),
(406, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '442981dbd4bdff108e3480b83d6c1ba146e07cb4', '2015-08-10', '06:36:33', '06:36:54', '00:00:21', NULL, '::1', '2015-08-10 04:36:33'),
(407, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '442981dbd4bdff108e3480b83d6c1ba146e07cb4', '2015-08-10', '06:36:54', '06:37:19', '00:00:25', NULL, '::1', '2015-08-10 04:36:54'),
(408, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '442981dbd4bdff108e3480b83d6c1ba146e07cb4', '2015-08-10', '06:37:19', '06:37:29', '00:00:10', NULL, '::1', '2015-08-10 04:37:19'),
(409, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '442981dbd4bdff108e3480b83d6c1ba146e07cb4', '2015-08-10', '06:37:29', NULL, '00:00:00', NULL, '::1', '2015-08-10 04:37:29'),
(410, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1b4e112b00966dad0c6fa2487c82b9c585292149', '2015-08-10', '06:42:02', '06:42:05', '00:00:03', NULL, '::1', '2015-08-10 04:42:02'),
(411, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1b4e112b00966dad0c6fa2487c82b9c585292149', '2015-08-10', '06:42:05', '06:42:17', '00:00:12', NULL, '::1', '2015-08-10 04:42:05');
INSERT INTO `user_activity_log_details` (`id`, `user_id`, `url_visited`, `user_agent`, `session_id`, `date`, `start_time`, `end_time`, `duration`, `user_type`, `ip_address`, `created_at`) VALUES
(412, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1b4e112b00966dad0c6fa2487c82b9c585292149', '2015-08-10', '06:42:17', '06:42:22', '00:00:05', NULL, '::1', '2015-08-10 04:42:17'),
(413, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1b4e112b00966dad0c6fa2487c82b9c585292149', '2015-08-10', '06:42:22', '06:43:00', '00:00:38', NULL, '::1', '2015-08-10 04:42:22'),
(414, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '1b4e112b00966dad0c6fa2487c82b9c585292149', '2015-08-10', '06:43:00', NULL, '00:00:00', NULL, '::1', '2015-08-10 04:43:00'),
(415, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ae976c1ca48c62d7daf425440eaef835700bf3c7', '2015-08-10', '06:47:03', '06:47:16', '00:00:13', NULL, '::1', '2015-08-10 04:47:03'),
(416, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ae976c1ca48c62d7daf425440eaef835700bf3c7', '2015-08-10', '06:47:16', NULL, '00:00:00', NULL, '::1', '2015-08-10 04:47:16'),
(417, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f19b3b71d5e3f7bb3b6897b6bbd14307659a3eea', '2015-08-10', '07:01:20', '07:04:04', '00:00:00', NULL, '::1', '2015-08-10 05:01:20'),
(418, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f19b3b71d5e3f7bb3b6897b6bbd14307659a3eea', '2015-08-10', '07:04:04', '07:04:17', '00:00:13', NULL, '::1', '2015-08-10 05:04:04'),
(419, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f19b3b71d5e3f7bb3b6897b6bbd14307659a3eea', '2015-08-10', '07:04:17', NULL, '00:00:00', NULL, '::1', '2015-08-10 05:04:17'),
(420, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ec29c9a12eb74547b11c7e8e3097a2a4e2972125', '2015-08-10', '07:07:59', '07:09:24', '00:00:00', NULL, '::1', '2015-08-10 05:07:59'),
(421, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ec29c9a12eb74547b11c7e8e3097a2a4e2972125', '2015-08-10', '07:09:24', '07:09:55', '00:00:31', NULL, '::1', '2015-08-10 05:09:24'),
(422, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ec29c9a12eb74547b11c7e8e3097a2a4e2972125', '2015-08-10', '07:09:55', '07:10:52', '00:00:57', NULL, '::1', '2015-08-10 05:09:55'),
(423, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ec29c9a12eb74547b11c7e8e3097a2a4e2972125', '2015-08-10', '07:10:52', NULL, '00:00:00', NULL, '::1', '2015-08-10 05:10:52'),
(424, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '8bbc58ec15d819e0c329c788f506a42aeb7d0327', '2015-08-10', '07:18:08', '07:19:19', '00:00:00', NULL, '::1', '2015-08-10 05:18:08'),
(425, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '8bbc58ec15d819e0c329c788f506a42aeb7d0327', '2015-08-10', '07:19:19', NULL, '00:00:00', NULL, '::1', '2015-08-10 05:19:19'),
(426, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f6b04f9418c3efecad6843d278c923e48eae1f92', '2015-08-10', '07:41:49', NULL, '00:00:00', NULL, '::1', '2015-08-10 05:41:49'),
(427, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf3ccecfb8cd1b8daf2f1af49bc60af2a1ddd1e5', '2015-08-10', '08:11:59', '08:12:25', '00:00:26', NULL, '::1', '2015-08-10 06:11:59'),
(428, 0, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf3ccecfb8cd1b8daf2f1af49bc60af2a1ddd1e5', '2015-08-10', '08:12:25', NULL, '00:00:00', NULL, '::1', '2015-08-10 06:12:25'),
(429, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5f347c70fc8aea4167b5eb5b9cc56eca2a3fab75', '2015-08-10', '08:12:28', '08:12:37', '00:00:09', NULL, '::1', '2015-08-10 06:12:28'),
(430, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5f347c70fc8aea4167b5eb5b9cc56eca2a3fab75', '2015-08-10', '08:12:37', '08:12:56', '00:00:19', NULL, '::1', '2015-08-10 06:12:37'),
(431, 18, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5f347c70fc8aea4167b5eb5b9cc56eca2a3fab75', '2015-08-10', '08:12:37', NULL, '00:00:00', 'user', '::1', '2015-08-10 06:12:37'),
(432, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5f347c70fc8aea4167b5eb5b9cc56eca2a3fab75', '2015-08-10', '08:12:57', '08:13:04', '00:00:07', 'user', '::1', '2015-08-10 06:12:57'),
(433, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5f347c70fc8aea4167b5eb5b9cc56eca2a3fab75', '2015-08-10', '08:13:04', '08:13:06', '00:00:02', 'user', '::1', '2015-08-10 06:13:04'),
(434, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5f347c70fc8aea4167b5eb5b9cc56eca2a3fab75', '2015-08-10', '08:13:06', '08:13:10', '00:00:04', 'user', '::1', '2015-08-10 06:13:06'),
(435, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5f347c70fc8aea4167b5eb5b9cc56eca2a3fab75', '2015-08-10', '08:13:10', '08:13:24', '00:00:14', 'user', '::1', '2015-08-10 06:13:10'),
(436, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5f347c70fc8aea4167b5eb5b9cc56eca2a3fab75', '2015-08-10', '08:13:24', '08:13:32', '00:00:08', 'user', '::1', '2015-08-10 06:13:24'),
(437, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5f347c70fc8aea4167b5eb5b9cc56eca2a3fab75', '2015-08-10', '08:13:32', NULL, '00:00:00', 'user', '::1', '2015-08-10 06:13:32'),
(438, 18, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e097acb1a501f42380c023248dae252d5f73d89', '2015-08-10', '08:51:48', '08:51:52', '00:00:04', 'user', '::1', '2015-08-10 06:51:48'),
(439, 18, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e097acb1a501f42380c023248dae252d5f73d89', '2015-08-10', '08:51:52', '08:51:55', '00:00:03', 'user', '::1', '2015-08-10 06:51:52'),
(440, 18, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e097acb1a501f42380c023248dae252d5f73d89', '2015-08-10', '08:51:55', '08:51:58', '00:00:03', 'user', '::1', '2015-08-10 06:51:55'),
(441, 48, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e097acb1a501f42380c023248dae252d5f73d89', '2015-08-10', '08:51:58', '08:52:03', '00:00:05', 'user', '::1', '2015-08-10 06:51:58'),
(442, 48, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e097acb1a501f42380c023248dae252d5f73d89', '2015-08-10', '08:52:03', NULL, '00:00:00', 'user', '::1', '2015-08-10 06:52:03'),
(443, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:08:19', '12:09:05', '00:00:46', NULL, '::1', '2015-08-10 10:08:19'),
(444, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:09:05', '12:09:13', '00:00:08', NULL, '::1', '2015-08-10 10:09:05'),
(445, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:09:14', '12:09:31', '00:00:17', NULL, '::1', '2015-08-10 10:09:14'),
(446, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:09:31', '12:09:55', '00:00:24', NULL, '::1', '2015-08-10 10:09:31'),
(447, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:09:55', '12:10:15', '00:00:20', NULL, '::1', '2015-08-10 10:09:55'),
(448, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:10:15', '12:10:26', '00:00:11', NULL, '::1', '2015-08-10 10:10:15'),
(449, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:10:26', '12:10:31', '00:00:05', NULL, '::1', '2015-08-10 10:10:26'),
(450, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:10:31', '12:10:38', '00:00:07', NULL, '::1', '2015-08-10 10:10:31'),
(451, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:10:38', '12:11:08', '00:00:30', NULL, '::1', '2015-08-10 10:10:38'),
(452, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:11:08', '12:11:32', '00:00:24', NULL, '::1', '2015-08-10 10:11:08'),
(453, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:11:32', '12:11:37', '00:00:05', NULL, '::1', '2015-08-10 10:11:32'),
(454, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:11:37', '12:11:43', '00:00:06', NULL, '::1', '2015-08-10 10:11:37'),
(455, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:11:43', '12:11:50', '00:00:07', NULL, '::1', '2015-08-10 10:11:43'),
(456, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:11:50', '12:12:03', '00:00:13', NULL, '::1', '2015-08-10 10:11:50'),
(457, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:12:03', '12:12:34', '00:00:31', NULL, '::1', '2015-08-10 10:12:03'),
(458, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:12:34', '12:12:42', '00:00:08', NULL, '::1', '2015-08-10 10:12:34'),
(459, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ab58240abccc07676eccf0d0a74353baf787a1c0', '2015-08-10', '12:12:42', NULL, '00:00:00', NULL, '::1', '2015-08-10 10:12:42'),
(460, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6e4ebf0b05963cf1f4fba6949d206ea712eb36cd', '2015-08-10', '12:13:40', '12:13:44', '00:00:04', NULL, '::1', '2015-08-10 10:13:40'),
(461, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6e4ebf0b05963cf1f4fba6949d206ea712eb36cd', '2015-08-10', '12:13:44', NULL, '00:00:00', NULL, '::1', '2015-08-10 10:13:44'),
(462, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '57a0678f3e08b82d74f9703afedd36f793810ae2', '2015-08-10', '12:38:07', '12:38:29', '00:00:22', NULL, '::1', '2015-08-10 10:38:07'),
(463, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '57a0678f3e08b82d74f9703afedd36f793810ae2', '2015-08-10', '12:38:29', '12:40:09', '00:01:00', NULL, '::1', '2015-08-10 10:38:29'),
(464, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '57a0678f3e08b82d74f9703afedd36f793810ae2', '2015-08-10', '12:40:09', '12:40:19', '00:00:10', NULL, '::1', '2015-08-10 10:40:09'),
(465, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '57a0678f3e08b82d74f9703afedd36f793810ae2', '2015-08-10', '12:40:19', NULL, '00:00:00', NULL, '::1', '2015-08-10 10:40:19'),
(466, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '653224627b42e9cd43049df404e43596f134c3cc', '2015-08-10', '12:44:58', '12:46:09', '00:00:00', NULL, '::1', '2015-08-10 10:44:58'),
(467, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '653224627b42e9cd43049df404e43596f134c3cc', '2015-08-10', '12:46:09', '12:46:37', '00:00:28', NULL, '::1', '2015-08-10 10:46:09'),
(468, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '653224627b42e9cd43049df404e43596f134c3cc', '2015-08-10', '12:46:37', '12:46:49', '00:00:12', NULL, '::1', '2015-08-10 10:46:37'),
(469, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '653224627b42e9cd43049df404e43596f134c3cc', '2015-08-10', '12:46:49', NULL, '00:00:00', NULL, '::1', '2015-08-10 10:46:49'),
(470, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '0a49c9b6e791997778a677cab3137ddd34175658', '2015-08-10', '12:50:18', NULL, '00:00:00', NULL, '::1', '2015-08-10 10:50:18'),
(471, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '11b1e404bdfb1a183bca00afa969aca234cf81eb', '2015-08-10', '13:24:48', '13:25:18', '00:00:30', NULL, '::1', '2015-08-10 11:24:48'),
(472, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '11b1e404bdfb1a183bca00afa969aca234cf81eb', '2015-08-10', '13:25:18', NULL, '00:00:00', NULL, '::1', '2015-08-10 11:25:18'),
(473, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'b831460eb38ce0f0603ca5a10993590ddbd17b1e', '2015-08-10', '13:42:20', NULL, '00:00:00', NULL, '::1', '2015-08-10 11:42:20'),
(474, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '2dbaa8701cfc50667715317c49862be667dea200', '2015-08-10', '13:49:17', NULL, '00:00:00', NULL, '::1', '2015-08-10 11:49:17'),
(475, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:10:55', '07:10:56', '00:00:01', NULL, '::1', '2015-08-11 05:10:55'),
(476, 0, 'http://localhost/zing/yoga/location/7', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:10:56', '07:11:09', '00:00:13', NULL, '::1', '2015-08-11 05:10:56'),
(477, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:11:09', '07:11:15', '00:00:06', NULL, '::1', '2015-08-11 05:11:09'),
(478, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:11:15', '07:11:19', '00:00:04', NULL, '::1', '2015-08-11 05:11:15'),
(479, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:11:19', '07:11:59', '00:00:40', NULL, '::1', '2015-08-11 05:11:19'),
(480, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:11:59', '07:12:07', '00:00:08', NULL, '::1', '2015-08-11 05:11:59'),
(481, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:12:07', '07:12:07', '00:00:00', NULL, '::1', '2015-08-11 05:12:07'),
(482, 18, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:12:08', '07:12:11', '00:00:03', 'user', '::1', '2015-08-11 05:12:08'),
(483, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:12:11', '07:12:20', '00:00:09', 'user', '::1', '2015-08-11 05:12:11'),
(484, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:12:20', '07:12:47', '00:00:27', 'user', '::1', '2015-08-11 05:12:20'),
(485, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'f1d42a0869c164f117f74d4df43a3a8456047e37', '2015-08-11', '07:12:47', NULL, '00:00:00', 'user', '::1', '2015-08-11 05:12:47'),
(486, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c1ddf9d1443cdba570f20616a965b904350c27ba', '2015-08-11', '07:39:49', '07:40:05', '00:00:16', 'user', '::1', '2015-08-11 05:39:49'),
(487, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c1ddf9d1443cdba570f20616a965b904350c27ba', '2015-08-11', '07:40:05', '07:40:50', '00:00:45', 'user', '::1', '2015-08-11 05:40:05'),
(488, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c1ddf9d1443cdba570f20616a965b904350c27ba', '2015-08-11', '07:40:50', '07:41:15', '00:00:25', 'user', '::1', '2015-08-11 05:40:50'),
(489, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c1ddf9d1443cdba570f20616a965b904350c27ba', '2015-08-11', '07:41:15', '07:41:21', '00:00:06', 'user', '::1', '2015-08-11 05:41:15'),
(490, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c1ddf9d1443cdba570f20616a965b904350c27ba', '2015-08-11', '07:41:21', '07:41:51', '00:00:30', 'user', '::1', '2015-08-11 05:41:21'),
(491, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c1ddf9d1443cdba570f20616a965b904350c27ba', '2015-08-11', '07:41:52', '07:42:04', '00:00:12', 'user', '::1', '2015-08-11 05:41:52'),
(492, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c1ddf9d1443cdba570f20616a965b904350c27ba', '2015-08-11', '07:42:04', '07:42:11', '00:00:07', 'user', '::1', '2015-08-11 05:42:04'),
(493, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c1ddf9d1443cdba570f20616a965b904350c27ba', '2015-08-11', '07:42:11', '07:43:47', '00:00:00', 'user', '::1', '2015-08-11 05:42:11'),
(494, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'c1ddf9d1443cdba570f20616a965b904350c27ba', '2015-08-11', '07:43:48', NULL, '00:00:00', 'user', '::1', '2015-08-11 05:43:48'),
(495, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6e2f0dc44b87351639c6a9dc398a78ccef11cbcc', '2015-08-11', '07:48:39', '07:49:00', '00:00:21', 'user', '::1', '2015-08-11 05:48:39'),
(496, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6e2f0dc44b87351639c6a9dc398a78ccef11cbcc', '2015-08-11', '07:49:00', '07:50:56', '00:01:16', 'user', '::1', '2015-08-11 05:49:00'),
(497, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6e2f0dc44b87351639c6a9dc398a78ccef11cbcc', '2015-08-11', '07:50:56', '07:51:14', '00:00:18', 'user', '::1', '2015-08-11 05:50:56'),
(498, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6e2f0dc44b87351639c6a9dc398a78ccef11cbcc', '2015-08-11', '07:51:14', '07:51:56', '00:00:42', 'user', '::1', '2015-08-11 05:51:14'),
(499, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6e2f0dc44b87351639c6a9dc398a78ccef11cbcc', '2015-08-11', '07:51:56', '07:52:56', '00:00:00', 'user', '::1', '2015-08-11 05:51:56'),
(500, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6e2f0dc44b87351639c6a9dc398a78ccef11cbcc', '2015-08-11', '07:52:56', NULL, '00:00:00', 'user', '::1', '2015-08-11 05:52:56'),
(501, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5434b71cd8d2dc51f3fb8d74e1828b52b7b1cdbd', '2015-08-11', '07:54:14', '07:55:10', '00:00:56', 'user', '::1', '2015-08-11 05:54:14'),
(502, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5434b71cd8d2dc51f3fb8d74e1828b52b7b1cdbd', '2015-08-11', '07:55:10', '07:55:25', '00:00:15', 'user', '::1', '2015-08-11 05:55:10'),
(503, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5434b71cd8d2dc51f3fb8d74e1828b52b7b1cdbd', '2015-08-11', '07:55:25', '07:56:19', '00:00:54', 'user', '::1', '2015-08-11 05:55:25'),
(504, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5434b71cd8d2dc51f3fb8d74e1828b52b7b1cdbd', '2015-08-11', '07:56:19', '07:56:26', '00:00:07', 'user', '::1', '2015-08-11 05:56:19'),
(505, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5434b71cd8d2dc51f3fb8d74e1828b52b7b1cdbd', '2015-08-11', '07:56:26', '07:57:00', '00:00:34', 'user', '::1', '2015-08-11 05:56:26'),
(506, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5434b71cd8d2dc51f3fb8d74e1828b52b7b1cdbd', '2015-08-11', '07:57:00', '07:57:02', '00:00:02', 'user', '::1', '2015-08-11 05:57:00'),
(507, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '5434b71cd8d2dc51f3fb8d74e1828b52b7b1cdbd', '2015-08-11', '07:57:02', NULL, '00:00:00', 'user', '::1', '2015-08-11 05:57:02'),
(508, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:20:19', '08:21:28', '00:00:00', 'user', '::1', '2015-08-11 06:20:19'),
(509, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:21:28', '08:21:29', '00:00:01', 'user', '::1', '2015-08-11 06:21:28'),
(510, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:21:29', '08:21:30', '00:00:01', 'user', '::1', '2015-08-11 06:21:29'),
(511, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:21:30', '08:21:30', '00:00:00', 'user', '::1', '2015-08-11 06:21:30'),
(512, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:21:30', '08:21:30', '00:00:00', 'user', '::1', '2015-08-11 06:21:30'),
(513, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:21:30', NULL, '00:00:00', 'user', '::1', '2015-08-11 06:21:30'),
(514, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:21:30', NULL, '00:00:00', 'user', '::1', '2015-08-11 06:21:30'),
(515, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:21:31', '08:21:46', '00:00:15', 'user', '::1', '2015-08-11 06:21:31'),
(516, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:21:46', '08:22:24', '00:00:38', 'user', '::1', '2015-08-11 06:21:46'),
(517, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:22:24', '08:22:25', '00:00:01', 'user', '::1', '2015-08-11 06:22:24'),
(518, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:22:25', '08:22:26', '00:00:01', 'user', '::1', '2015-08-11 06:22:25'),
(519, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:22:26', '08:23:15', '00:00:49', 'user', '::1', '2015-08-11 06:22:26'),
(520, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:23:15', '08:23:37', '00:00:22', 'user', '::1', '2015-08-11 06:23:15'),
(521, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:23:37', '08:24:04', '00:00:27', 'user', '::1', '2015-08-11 06:23:37'),
(522, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:24:04', '08:24:23', '00:00:19', 'user', '::1', '2015-08-11 06:24:04'),
(523, 18, 'http://localhost/zing/providerDetails/5', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9595c43c05aa668bcd67c51d35008f12d9a1f391', '2015-08-11', '08:24:23', NULL, '00:00:00', 'user', '::1', '2015-08-11 06:24:23'),
(524, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf3a36c6f38161ef750e6378c696848fd9a7d8fc', '2015-08-11', '08:29:39', '08:29:42', '00:00:03', 'user', '::1', '2015-08-11 06:29:39'),
(525, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf3a36c6f38161ef750e6378c696848fd9a7d8fc', '2015-08-11', '08:29:42', '08:29:47', '00:00:05', 'user', '::1', '2015-08-11 06:29:42'),
(526, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf3a36c6f38161ef750e6378c696848fd9a7d8fc', '2015-08-11', '08:29:47', '08:34:03', '00:02:56', 'user', '::1', '2015-08-11 06:29:47'),
(527, 18, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf3a36c6f38161ef750e6378c696848fd9a7d8fc', '2015-08-11', '08:34:03', '08:34:07', '00:00:04', 'user', '::1', '2015-08-11 06:34:03'),
(528, 18, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'bf3a36c6f38161ef750e6378c696848fd9a7d8fc', '2015-08-11', '08:34:07', NULL, '00:00:00', 'user', '::1', '2015-08-11 06:34:07'),
(529, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ba16411a99941b67025715435b37b03da8d68fbd', '2015-08-11', '08:37:54', '08:38:00', '00:00:06', 'user', '::1', '2015-08-11 06:37:54'),
(530, 18, 'http://localhost/zing/programs/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ba16411a99941b67025715435b37b03da8d68fbd', '2015-08-11', '08:38:00', '08:38:30', '00:00:30', 'user', '::1', '2015-08-11 06:38:00'),
(531, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ba16411a99941b67025715435b37b03da8d68fbd', '2015-08-11', '08:38:30', '08:38:34', '00:00:04', 'user', '::1', '2015-08-11 06:38:30'),
(532, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ba16411a99941b67025715435b37b03da8d68fbd', '2015-08-11', '08:38:34', NULL, '00:00:00', 'user', '::1', '2015-08-11 06:38:34'),
(533, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4ecb5466be0fe4acea7c1d3551f9f1f7924998f4', '2015-08-11', '08:45:41', '08:48:35', '00:00:00', 'user', '::1', '2015-08-11 06:45:41'),
(534, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4ecb5466be0fe4acea7c1d3551f9f1f7924998f4', '2015-08-11', '08:48:35', '08:49:02', '00:00:27', 'user', '::1', '2015-08-11 06:48:35'),
(535, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '4ecb5466be0fe4acea7c1d3551f9f1f7924998f4', '2015-08-11', '08:49:02', NULL, '00:00:00', 'user', '::1', '2015-08-11 06:49:02'),
(536, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6084e2f78b53c9947c0890081a0611e575d10300', '2015-08-11', '08:51:06', '08:51:35', '00:00:29', 'user', '::1', '2015-08-11 06:51:06'),
(537, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6084e2f78b53c9947c0890081a0611e575d10300', '2015-08-11', '08:51:35', '08:52:44', '00:00:00', 'user', '::1', '2015-08-11 06:51:35'),
(538, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6084e2f78b53c9947c0890081a0611e575d10300', '2015-08-11', '08:52:44', '08:52:47', '00:00:03', 'user', '::1', '2015-08-11 06:52:44'),
(539, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6084e2f78b53c9947c0890081a0611e575d10300', '2015-08-11', '08:52:47', '08:52:54', '00:00:07', 'user', '::1', '2015-08-11 06:52:47'),
(540, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6084e2f78b53c9947c0890081a0611e575d10300', '2015-08-11', '08:52:54', '08:53:24', '00:00:30', 'user', '::1', '2015-08-11 06:52:54'),
(541, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6084e2f78b53c9947c0890081a0611e575d10300', '2015-08-11', '08:53:24', '08:53:45', '00:00:21', 'user', '::1', '2015-08-11 06:53:24'),
(542, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6084e2f78b53c9947c0890081a0611e575d10300', '2015-08-11', '08:53:45', '08:54:51', '00:00:00', 'user', '::1', '2015-08-11 06:53:45'),
(543, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6084e2f78b53c9947c0890081a0611e575d10300', '2015-08-11', '08:54:52', '08:55:02', '00:00:10', 'user', '::1', '2015-08-11 06:54:52'),
(544, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '6084e2f78b53c9947c0890081a0611e575d10300', '2015-08-11', '08:55:02', NULL, '00:00:00', 'user', '::1', '2015-08-11 06:55:02'),
(545, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '8b2260a425e3c1db03b7b7bdbca7cc558d02b7a4', '2015-08-11', '08:57:22', '08:57:47', '00:00:25', 'user', '::1', '2015-08-11 06:57:22'),
(546, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '8b2260a425e3c1db03b7b7bdbca7cc558d02b7a4', '2015-08-11', '08:57:47', NULL, '00:00:00', 'user', '::1', '2015-08-11 06:57:47'),
(547, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '881c3430dd7a0e6d27e429ced54672a29a39fd39', '2015-08-11', '09:21:32', NULL, '00:00:00', 'user', '::1', '2015-08-11 07:21:32'),
(548, 18, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e4293500a5766a0c544f96229e127bfe62c3ad4', '2015-08-11', '09:39:42', '09:39:45', '00:00:03', 'user', '::1', '2015-08-11 07:39:42'),
(549, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e4293500a5766a0c544f96229e127bfe62c3ad4', '2015-08-11', '09:39:45', '09:40:19', '00:00:34', 'user', '::1', '2015-08-11 07:39:45'),
(550, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e4293500a5766a0c544f96229e127bfe62c3ad4', '2015-08-11', '09:40:19', '09:40:34', '00:00:15', 'user', '::1', '2015-08-11 07:40:19'),
(551, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e4293500a5766a0c544f96229e127bfe62c3ad4', '2015-08-11', '09:40:34', '09:40:38', '00:00:04', 'user', '::1', '2015-08-11 07:40:34'),
(552, 18, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e4293500a5766a0c544f96229e127bfe62c3ad4', '2015-08-11', '09:40:38', '09:40:40', '00:00:02', 'user', '::1', '2015-08-11 07:40:38'),
(553, 18, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e4293500a5766a0c544f96229e127bfe62c3ad4', '2015-08-11', '09:40:40', '09:40:43', '00:00:03', 'user', '::1', '2015-08-11 07:40:40'),
(554, 18, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '9e4293500a5766a0c544f96229e127bfe62c3ad4', '2015-08-11', '09:40:43', NULL, '00:00:00', 'user', '::1', '2015-08-11 07:40:43'),
(555, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:03:59', '10:04:00', '00:00:01', NULL, '::1', '2015-08-11 08:03:59'),
(556, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:00', '10:04:03', '00:00:03', NULL, '::1', '2015-08-11 08:04:00'),
(557, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:04', '10:04:16', '00:00:12', NULL, '::1', '2015-08-11 08:04:04'),
(558, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:16', '10:04:20', '00:00:04', NULL, '::1', '2015-08-11 08:04:16'),
(559, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:20', '10:04:22', '00:00:02', NULL, '::1', '2015-08-11 08:04:20'),
(560, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:22', '10:04:35', '00:00:13', NULL, '::1', '2015-08-11 08:04:22'),
(561, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:35', '10:04:38', '00:00:03', NULL, '::1', '2015-08-11 08:04:35'),
(562, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:38', '10:04:46', '00:00:08', NULL, '::1', '2015-08-11 08:04:38'),
(563, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:46', '10:04:48', '00:00:02', NULL, '::1', '2015-08-11 08:04:46'),
(564, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:49', '10:04:51', '00:00:02', NULL, '::1', '2015-08-11 08:04:49'),
(565, 0, 'http://localhost/zing/offeringPrograms/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:51', '10:04:55', '00:00:04', NULL, '::1', '2015-08-11 08:04:51'),
(566, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:55', '10:04:59', '00:00:04', NULL, '::1', '2015-08-11 08:04:55'),
(567, 0, 'http://localhost/zing/offeringPrograms/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:04:59', '10:05:02', '00:00:03', NULL, '::1', '2015-08-11 08:04:59'),
(568, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:05:02', '10:05:03', '00:00:01', NULL, '::1', '2015-08-11 08:05:02'),
(569, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a22fe746b9f7fd2cd4bcb52174bc2525b820445d', '2015-08-11', '10:05:03', NULL, '00:00:00', NULL, '::1', '2015-08-11 08:05:03'),
(570, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '57de142187c93a12e01c0a94b52f6616e46fd91e', '2015-08-11', '10:52:22', '10:52:36', '00:00:14', NULL, '::1', '2015-08-11 08:52:22'),
(571, 0, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '57de142187c93a12e01c0a94b52f6616e46fd91e', '2015-08-11', '10:52:36', '10:52:37', '00:00:01', NULL, '::1', '2015-08-11 08:52:36'),
(572, 18, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '57de142187c93a12e01c0a94b52f6616e46fd91e', '2015-08-11', '10:52:37', '10:52:54', '00:00:17', 'user', '::1', '2015-08-11 08:52:37'),
(573, 18, 'http://localhost/zing/offeringPrograms/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '57de142187c93a12e01c0a94b52f6616e46fd91e', '2015-08-11', '10:52:54', '10:52:58', '00:00:04', 'user', '::1', '2015-08-11 08:52:54'),
(574, 18, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '57de142187c93a12e01c0a94b52f6616e46fd91e', '2015-08-11', '10:52:58', NULL, '00:00:00', 'user', '::1', '2015-08-11 08:52:58'),
(575, 18, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7f0b4e3bc15e2a071a6141ff7995000a1216cd28', '2015-08-11', '11:49:51', NULL, '00:00:00', 'user', '::1', '2015-08-11 09:49:51'),
(576, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '092cb2b4af0da264700290aad55d4f0cc41517ee', '2015-08-11', '11:49:56', '11:50:02', '00:00:06', NULL, '::1', '2015-08-11 09:49:56'),
(577, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '092cb2b4af0da264700290aad55d4f0cc41517ee', '2015-08-11', '11:50:02', '11:50:10', '00:00:08', NULL, '::1', '2015-08-11 09:50:02'),
(578, 0, 'http://localhost/zing/offeringPrograms/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '092cb2b4af0da264700290aad55d4f0cc41517ee', '2015-08-11', '11:50:10', '11:50:14', '00:00:04', NULL, '::1', '2015-08-11 09:50:10'),
(579, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '092cb2b4af0da264700290aad55d4f0cc41517ee', '2015-08-11', '11:50:14', '11:50:17', '00:00:03', NULL, '::1', '2015-08-11 09:50:14'),
(580, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '092cb2b4af0da264700290aad55d4f0cc41517ee', '2015-08-11', '11:50:17', '11:50:20', '00:00:03', NULL, '::1', '2015-08-11 09:50:17'),
(581, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '092cb2b4af0da264700290aad55d4f0cc41517ee', '2015-08-11', '11:50:20', '11:50:23', '00:00:03', NULL, '::1', '2015-08-11 09:50:20'),
(582, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '092cb2b4af0da264700290aad55d4f0cc41517ee', '2015-08-11', '11:50:23', NULL, '00:00:00', NULL, '::1', '2015-08-11 09:50:23'),
(583, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:09:15', '12:09:17', '00:00:02', NULL, '::1', '2015-08-11 10:09:15'),
(584, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:09:17', '12:09:21', '00:00:04', NULL, '::1', '2015-08-11 10:09:17'),
(585, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:09:21', '12:11:43', '00:01:42', NULL, '::1', '2015-08-11 10:09:21'),
(586, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:11:44', '12:11:46', '00:00:02', NULL, '::1', '2015-08-11 10:11:44'),
(587, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:11:46', '12:11:52', '00:00:06', NULL, '::1', '2015-08-11 10:11:46'),
(588, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:11:53', '12:12:00', '00:00:07', NULL, '::1', '2015-08-11 10:11:53'),
(589, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:01', '12:12:03', '00:00:02', NULL, '::1', '2015-08-11 10:12:01'),
(590, 0, 'http://localhost/zing/offeringPrograms/5', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:04', '12:12:06', '00:00:02', NULL, '::1', '2015-08-11 10:12:04'),
(591, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:06', '12:12:09', '00:00:03', NULL, '::1', '2015-08-11 10:12:06'),
(592, 0, 'http://localhost/zing/providerDetails/5', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:09', '12:12:13', '00:00:04', NULL, '::1', '2015-08-11 10:12:09'),
(593, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:13', '12:12:16', '00:00:03', NULL, '::1', '2015-08-11 10:12:13'),
(594, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:16', '12:12:23', '00:00:07', NULL, '::1', '2015-08-11 10:12:16'),
(595, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:23', '12:12:28', '00:00:05', NULL, '::1', '2015-08-11 10:12:23'),
(596, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:29', '12:12:47', '00:00:18', NULL, '::1', '2015-08-11 10:12:29'),
(597, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:47', '12:12:49', '00:00:02', NULL, '::1', '2015-08-11 10:12:47'),
(598, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:49', '12:12:50', '00:00:01', NULL, '::1', '2015-08-11 10:12:49'),
(599, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:50', '12:12:55', '00:00:05', NULL, '::1', '2015-08-11 10:12:50'),
(600, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:55', '12:12:59', '00:00:04', NULL, '::1', '2015-08-11 10:12:55'),
(601, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:12:59', '12:13:05', '00:00:06', NULL, '::1', '2015-08-11 10:12:59'),
(602, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:05', '12:13:07', '00:00:02', NULL, '::1', '2015-08-11 10:13:05'),
(603, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:07', '12:13:09', '00:00:02', NULL, '::1', '2015-08-11 10:13:07');
INSERT INTO `user_activity_log_details` (`id`, `user_id`, `url_visited`, `user_agent`, `session_id`, `date`, `start_time`, `end_time`, `duration`, `user_type`, `ip_address`, `created_at`) VALUES
(604, 0, 'http://localhost/zing/offeringPrograms/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:09', '12:13:13', '00:00:04', NULL, '::1', '2015-08-11 10:13:09'),
(605, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:13', '12:13:15', '00:00:02', NULL, '::1', '2015-08-11 10:13:13'),
(606, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:15', '12:13:37', '00:00:22', NULL, '::1', '2015-08-11 10:13:15'),
(607, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:37', '12:13:40', '00:00:03', NULL, '::1', '2015-08-11 10:13:37'),
(608, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:40', '12:13:43', '00:00:03', NULL, '::1', '2015-08-11 10:13:40'),
(609, 0, 'http://localhost/zing/register', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:43', '12:13:52', '00:00:09', NULL, '::1', '2015-08-11 10:13:43'),
(610, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:52', '12:13:55', '00:00:03', NULL, '::1', '2015-08-11 10:13:52'),
(611, 0, 'http://localhost/zing/register', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:56', '12:13:58', '00:00:02', NULL, '::1', '2015-08-11 10:13:56'),
(612, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:13:58', '12:14:00', '00:00:02', NULL, '::1', '2015-08-11 10:13:58'),
(613, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:14:00', '12:14:03', '00:00:03', NULL, '::1', '2015-08-11 10:14:00'),
(614, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '543213d697414e5dab1fbfc193ed50497b6b5fc9', '2015-08-11', '12:14:04', NULL, '00:00:00', NULL, '::1', '2015-08-11 10:14:04'),
(615, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '370bb3eb9d751adebcc033a637ce8847a0900ca9', '2015-08-11', '12:19:36', '12:19:38', '00:00:02', NULL, '::1', '2015-08-11 10:19:36'),
(616, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '370bb3eb9d751adebcc033a637ce8847a0900ca9', '2015-08-11', '12:19:38', '12:19:40', '00:00:02', NULL, '::1', '2015-08-11 10:19:38'),
(617, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '370bb3eb9d751adebcc033a637ce8847a0900ca9', '2015-08-11', '12:19:40', NULL, '00:00:00', NULL, '::1', '2015-08-11 10:19:40'),
(618, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'ee75db97d42bd9b9bdd4fe98abcbd6c4e758fb52', '2015-08-11', '12:28:16', NULL, '00:00:00', NULL, '::1', '2015-08-11 10:28:16'),
(619, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '2c5fbe01ab68e172f652a771c1803b49dfda1f43', '2015-08-12', '06:14:45', '06:14:55', '00:00:10', NULL, '::1', '2015-08-12 04:14:45'),
(620, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '2c5fbe01ab68e172f652a771c1803b49dfda1f43', '2015-08-12', '06:14:56', '06:15:00', '00:00:04', NULL, '::1', '2015-08-12 04:14:56'),
(621, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '2c5fbe01ab68e172f652a771c1803b49dfda1f43', '2015-08-12', '06:15:00', NULL, '00:00:00', NULL, '::1', '2015-08-12 04:15:00'),
(622, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '82d08f31844c44855d917fc14ab1ed1f755d6758', '2015-08-12', '07:58:22', '07:58:26', '00:00:04', NULL, '::1', '2015-08-12 05:58:22'),
(623, 0, 'http://localhost/zing/google', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '82d08f31844c44855d917fc14ab1ed1f755d6758', '2015-08-12', '07:58:27', '07:59:47', '00:00:00', NULL, '::1', '2015-08-12 05:58:27'),
(624, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '82d08f31844c44855d917fc14ab1ed1f755d6758', '2015-08-12', '07:59:49', '07:59:52', '00:00:03', NULL, '::1', '2015-08-12 05:59:49'),
(625, 0, 'http://localhost/zing/google', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '82d08f31844c44855d917fc14ab1ed1f755d6758', '2015-08-12', '07:59:53', '08:02:35', '00:00:00', NULL, '::1', '2015-08-12 05:59:53'),
(626, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '82d08f31844c44855d917fc14ab1ed1f755d6758', '2015-08-12', '08:02:36', '08:02:39', '00:00:03', NULL, '::1', '2015-08-12 06:02:36'),
(627, 0, 'http://localhost/zing/google', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '82d08f31844c44855d917fc14ab1ed1f755d6758', '2015-08-12', '08:02:40', NULL, '00:00:00', NULL, '::1', '2015-08-12 06:02:40'),
(628, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a86c4ad8ef5d65ffda0b0966182eff7b1ea77db3', '2015-08-12', '08:03:23', '08:03:27', '00:00:04', NULL, '::1', '2015-08-12 06:03:23'),
(629, 0, 'http://localhost/zing/google', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a86c4ad8ef5d65ffda0b0966182eff7b1ea77db3', '2015-08-12', '08:03:27', '08:04:00', '00:00:33', NULL, '::1', '2015-08-12 06:03:27'),
(630, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a86c4ad8ef5d65ffda0b0966182eff7b1ea77db3', '2015-08-12', '08:04:01', '08:05:22', '00:00:00', NULL, '::1', '2015-08-12 06:04:01'),
(631, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a86c4ad8ef5d65ffda0b0966182eff7b1ea77db3', '2015-08-12', '08:05:23', '08:08:01', '00:01:58', NULL, '::1', '2015-08-12 06:05:23'),
(632, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a86c4ad8ef5d65ffda0b0966182eff7b1ea77db3', '2015-08-12', '08:08:04', '08:08:16', '00:00:12', NULL, '::1', '2015-08-12 06:08:04'),
(633, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a86c4ad8ef5d65ffda0b0966182eff7b1ea77db3', '2015-08-12', '08:08:17', '08:08:20', '00:00:03', NULL, '::1', '2015-08-12 06:08:17'),
(634, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a86c4ad8ef5d65ffda0b0966182eff7b1ea77db3', '2015-08-12', '08:08:21', NULL, '00:00:00', NULL, '::1', '2015-08-12 06:08:21'),
(635, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '3af21a3524a1f2a60fdd1cee423322226b6e522b', '2015-08-12', '08:11:35', '08:12:21', '00:00:46', NULL, '::1', '2015-08-12 06:11:35'),
(636, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '3af21a3524a1f2a60fdd1cee423322226b6e522b', '2015-08-12', '08:12:21', NULL, '00:00:00', NULL, '::1', '2015-08-12 06:12:21'),
(637, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '883c645b9b6fc67e0daead0b22eb66506a6e0f26', '2015-08-12', '08:13:44', '08:14:18', '00:00:34', NULL, '::1', '2015-08-12 06:13:44'),
(638, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '883c645b9b6fc67e0daead0b22eb66506a6e0f26', '2015-08-12', '08:14:18', '08:14:53', '00:00:35', NULL, '::1', '2015-08-12 06:14:18'),
(639, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '883c645b9b6fc67e0daead0b22eb66506a6e0f26', '2015-08-12', '08:14:53', '08:15:23', '00:00:30', NULL, '::1', '2015-08-12 06:14:53'),
(640, 0, 'http://localhost/zing/undefined', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', 'eaf16e2632469b4ef6a4e261c3441aa7c079fece', '2015-08-12', '08:15:03', NULL, '00:00:00', NULL, '::1', '2015-08-12 06:15:03'),
(641, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '883c645b9b6fc67e0daead0b22eb66506a6e0f26', '2015-08-12', '08:15:23', '08:16:05', '00:00:42', NULL, '::1', '2015-08-12 06:15:23'),
(642, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '883c645b9b6fc67e0daead0b22eb66506a6e0f26', '2015-08-12', '08:16:06', '08:16:58', '00:00:52', NULL, '::1', '2015-08-12 06:16:06'),
(643, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '883c645b9b6fc67e0daead0b22eb66506a6e0f26', '2015-08-12', '08:16:58', '08:17:52', '00:00:54', NULL, '::1', '2015-08-12 06:16:58'),
(644, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '883c645b9b6fc67e0daead0b22eb66506a6e0f26', '2015-08-12', '08:17:52', '08:17:53', '00:00:01', NULL, '::1', '2015-08-12 06:17:52'),
(645, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '883c645b9b6fc67e0daead0b22eb66506a6e0f26', '2015-08-12', '08:17:53', '08:17:53', '00:00:00', NULL, '::1', '2015-08-12 06:17:53'),
(646, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '883c645b9b6fc67e0daead0b22eb66506a6e0f26', '2015-08-12', '08:17:53', NULL, '00:00:00', NULL, '::1', '2015-08-12 06:17:53'),
(647, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'bfce0cc11cbc17c24767901a4ac265556c6d5071', '2015-08-12', '08:27:10', NULL, '00:00:00', NULL, '::1', '2015-08-12 06:27:10'),
(648, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '08:57:43', '08:57:47', '00:00:04', NULL, '::1', '2015-08-12 06:57:43'),
(649, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '08:57:47', '08:57:52', '00:00:05', NULL, '::1', '2015-08-12 06:57:47'),
(650, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '08:57:52', '08:59:43', '00:01:11', NULL, '::1', '2015-08-12 06:57:52'),
(651, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '08:59:45', '08:59:45', '00:00:00', 'user', '::1', '2015-08-12 06:59:45'),
(652, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '08:59:46', '08:59:49', '00:00:03', 'user', '::1', '2015-08-12 06:59:46'),
(653, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '08:59:50', '09:00:31', '00:00:41', 'user', '::1', '2015-08-12 06:59:50'),
(654, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '09:00:31', '09:00:35', '00:00:04', 'user', '::1', '2015-08-12 07:00:31'),
(655, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '09:00:36', '09:01:17', '00:00:41', 'user', '::1', '2015-08-12 07:00:36'),
(656, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '09:01:17', '09:01:20', '00:00:03', 'user', '::1', '2015-08-12 07:01:17'),
(657, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7a201fc0dcacc5e2df8b2aa5065f6e5e66a67996', '2015-08-12', '09:01:20', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:01:20'),
(658, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:02:46', '09:02:50', '00:00:04', 'user', '::1', '2015-08-12 07:02:46'),
(659, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:02:50', '09:03:43', '00:00:53', 'user', '::1', '2015-08-12 07:02:50'),
(660, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:03:43', '09:03:46', '00:00:03', 'user', '::1', '2015-08-12 07:03:43'),
(661, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:03:47', '09:04:39', '00:00:52', 'user', '::1', '2015-08-12 07:03:47'),
(662, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:04:39', '09:04:42', '00:00:03', 'user', '::1', '2015-08-12 07:04:39'),
(663, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:04:43', '09:05:17', '00:00:34', 'user', '::1', '2015-08-12 07:04:43'),
(664, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:05:18', '09:05:21', '00:00:03', 'user', '::1', '2015-08-12 07:05:18'),
(665, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:05:21', '09:05:35', '00:00:14', 'user', '::1', '2015-08-12 07:05:21'),
(666, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:05:35', '09:05:46', '00:00:11', 'user', '::1', '2015-08-12 07:05:35'),
(667, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:05:46', '09:05:49', '00:00:03', 'user', '::1', '2015-08-12 07:05:46'),
(668, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:05:49', '09:06:52', '00:00:00', 'user', '::1', '2015-08-12 07:05:49'),
(669, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:06:52', '09:06:55', '00:00:03', 'user', '::1', '2015-08-12 07:06:52'),
(670, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:06:55', '09:07:28', '00:00:33', 'user', '::1', '2015-08-12 07:06:55'),
(671, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:07:28', '09:07:32', '00:00:04', 'user', '::1', '2015-08-12 07:07:28'),
(672, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f8ec5f32252f915ba8fa409a374f5e0b261cc575', '2015-08-12', '09:07:32', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:07:32'),
(673, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e7da824d753aa35c370f36e96183aa37e3d442ac', '2015-08-12', '09:08:23', '09:08:25', '00:00:02', 'user', '::1', '2015-08-12 07:08:23'),
(674, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e7da824d753aa35c370f36e96183aa37e3d442ac', '2015-08-12', '09:08:26', '09:09:38', '00:00:00', 'user', '::1', '2015-08-12 07:08:26'),
(675, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e7da824d753aa35c370f36e96183aa37e3d442ac', '2015-08-12', '09:09:38', '09:09:39', '00:00:01', 'user', '::1', '2015-08-12 07:09:38'),
(676, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e7da824d753aa35c370f36e96183aa37e3d442ac', '2015-08-12', '09:09:39', '09:09:42', '00:00:03', 'user', '::1', '2015-08-12 07:09:39'),
(677, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e7da824d753aa35c370f36e96183aa37e3d442ac', '2015-08-12', '09:09:43', '09:10:41', '00:00:58', 'user', '::1', '2015-08-12 07:09:43'),
(678, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e7da824d753aa35c370f36e96183aa37e3d442ac', '2015-08-12', '09:10:41', '09:10:45', '00:00:04', 'user', '::1', '2015-08-12 07:10:41'),
(679, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e7da824d753aa35c370f36e96183aa37e3d442ac', '2015-08-12', '09:10:45', '09:10:50', '00:00:05', 'user', '::1', '2015-08-12 07:10:45'),
(680, 49, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e7da824d753aa35c370f36e96183aa37e3d442ac', '2015-08-12', '09:10:50', '09:10:57', '00:00:07', 'user', '::1', '2015-08-12 07:10:50'),
(681, 49, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e7da824d753aa35c370f36e96183aa37e3d442ac', '2015-08-12', '09:10:57', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:10:57'),
(682, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '571a441a8751492e18ee8ce6cd0dd93495b4d3af', '2015-08-12', '09:11:01', '09:11:03', '00:00:02', NULL, '::1', '2015-08-12 07:11:01'),
(683, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '571a441a8751492e18ee8ce6cd0dd93495b4d3af', '2015-08-12', '09:11:03', '09:11:07', '00:00:04', NULL, '::1', '2015-08-12 07:11:03'),
(684, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '571a441a8751492e18ee8ce6cd0dd93495b4d3af', '2015-08-12', '09:11:07', '09:11:11', '00:00:04', NULL, '::1', '2015-08-12 07:11:07'),
(685, 49, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '571a441a8751492e18ee8ce6cd0dd93495b4d3af', '2015-08-12', '09:11:11', '09:11:24', '00:00:13', 'user', '::1', '2015-08-12 07:11:11'),
(686, 49, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '571a441a8751492e18ee8ce6cd0dd93495b4d3af', '2015-08-12', '09:11:24', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:11:24'),
(687, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'aae105c55878e83170a07ec5be232e0b5637877a', '2015-08-12', '09:11:26', '09:11:28', '00:00:02', NULL, '::1', '2015-08-12 07:11:26'),
(688, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'aae105c55878e83170a07ec5be232e0b5637877a', '2015-08-12', '09:11:28', '09:11:31', '00:00:03', NULL, '::1', '2015-08-12 07:11:28'),
(689, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'aae105c55878e83170a07ec5be232e0b5637877a', '2015-08-12', '09:11:31', '09:11:33', '00:00:02', NULL, '::1', '2015-08-12 07:11:31'),
(690, 49, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'aae105c55878e83170a07ec5be232e0b5637877a', '2015-08-12', '09:11:33', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:11:33'),
(691, 0, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '8716ee96bae7242c3bddf9f374c0c1ac2e12e9eb', '2015-08-12', '09:18:53', NULL, '00:00:00', NULL, '::1', '2015-08-12 07:18:53'),
(692, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'ab5298690a9fc78369a9568886c2590d2d6466d1', '2015-08-12', '09:18:57', '09:18:59', '00:00:02', NULL, '::1', '2015-08-12 07:18:57'),
(693, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'ab5298690a9fc78369a9568886c2590d2d6466d1', '2015-08-12', '09:18:59', '09:19:05', '00:00:06', NULL, '::1', '2015-08-12 07:18:59'),
(694, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'ab5298690a9fc78369a9568886c2590d2d6466d1', '2015-08-12', '09:19:05', '09:19:07', '00:00:02', NULL, '::1', '2015-08-12 07:19:05'),
(695, 49, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'ab5298690a9fc78369a9568886c2590d2d6466d1', '2015-08-12', '09:19:07', '09:19:13', '00:00:06', 'user', '::1', '2015-08-12 07:19:07'),
(696, 49, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'ab5298690a9fc78369a9568886c2590d2d6466d1', '2015-08-12', '09:19:13', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:19:13'),
(697, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '4d54100d44a0c41776db9e143e339a2c3939374e', '2015-08-12', '09:19:44', '09:19:46', '00:00:02', NULL, '::1', '2015-08-12 07:19:44'),
(698, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '4d54100d44a0c41776db9e143e339a2c3939374e', '2015-08-12', '09:19:46', '09:19:49', '00:00:03', NULL, '::1', '2015-08-12 07:19:46'),
(699, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '4d54100d44a0c41776db9e143e339a2c3939374e', '2015-08-12', '09:19:49', NULL, '00:00:00', NULL, '::1', '2015-08-12 07:19:49'),
(700, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e2452fb14837669b43ab6c4832da518b88cf73c3', '2015-08-12', '09:24:53', '09:24:56', '00:00:03', 'user', '::1', '2015-08-12 07:24:53'),
(701, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'e2452fb14837669b43ab6c4832da518b88cf73c3', '2015-08-12', '09:24:57', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:24:57'),
(702, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:31:10', '09:31:14', '00:00:04', 'user', '::1', '2015-08-12 07:31:10'),
(703, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:31:14', '09:32:05', '00:00:51', 'user', '::1', '2015-08-12 07:31:14'),
(704, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:32:05', '09:32:24', '00:00:19', 'user', '::1', '2015-08-12 07:32:05'),
(705, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:32:24', '09:33:14', '00:00:50', 'user', '::1', '2015-08-12 07:32:24'),
(706, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:33:14', '09:33:22', '00:00:08', 'user', '::1', '2015-08-12 07:33:14'),
(707, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:33:22', '09:33:26', '00:00:04', 'user', '::1', '2015-08-12 07:33:22'),
(708, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:33:26', '09:33:31', '00:00:05', 'user', '::1', '2015-08-12 07:33:26'),
(709, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:33:32', '09:33:34', '00:00:02', 'user', '::1', '2015-08-12 07:33:32'),
(710, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:33:34', '09:34:28', '00:00:54', 'user', '::1', '2015-08-12 07:33:34'),
(711, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:34:28', '09:34:28', '00:00:00', 'user', '::1', '2015-08-12 07:34:28'),
(712, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:34:28', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:34:28'),
(713, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:34:29', '09:34:32', '00:00:03', 'user', '::1', '2015-08-12 07:34:29'),
(714, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:34:29', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:34:29'),
(715, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:34:32', '09:34:38', '00:00:06', 'user', '::1', '2015-08-12 07:34:32'),
(716, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:34:38', '09:34:41', '00:00:03', 'user', '::1', '2015-08-12 07:34:38'),
(717, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:34:42', '09:34:44', '00:00:02', 'user', '::1', '2015-08-12 07:34:42'),
(718, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:34:44', '09:35:31', '00:00:47', 'user', '::1', '2015-08-12 07:34:44'),
(719, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:31', '09:35:31', '00:00:00', 'user', '::1', '2015-08-12 07:35:31'),
(720, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:32', '09:35:33', '00:00:01', 'user', '::1', '2015-08-12 07:35:32'),
(721, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:32', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:35:32'),
(722, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:32', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:35:32'),
(723, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:33', '09:35:33', '00:00:00', 'user', '::1', '2015-08-12 07:35:33'),
(724, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:33', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:35:33'),
(725, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:33', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:35:33'),
(726, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:34', '09:35:34', '00:00:00', 'user', '::1', '2015-08-12 07:35:34'),
(727, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:34', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:35:34'),
(728, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:35', '09:35:38', '00:00:03', 'user', '::1', '2015-08-12 07:35:35'),
(729, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '46539c93dbfd517bd94f9657c89867061884d684', '2015-08-12', '09:35:38', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:35:38'),
(730, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1a25d7e74453fb97a5d1070c28ca4659e15860ea', '2015-08-12', '09:36:18', '09:36:21', '00:00:03', 'user', '::1', '2015-08-12 07:36:18'),
(731, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1a25d7e74453fb97a5d1070c28ca4659e15860ea', '2015-08-12', '09:36:21', '09:36:23', '00:00:02', 'user', '::1', '2015-08-12 07:36:21'),
(732, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1a25d7e74453fb97a5d1070c28ca4659e15860ea', '2015-08-12', '09:36:23', '09:36:42', '00:00:19', 'user', '::1', '2015-08-12 07:36:23'),
(733, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1a25d7e74453fb97a5d1070c28ca4659e15860ea', '2015-08-12', '09:36:42', '09:36:44', '00:00:02', 'user', '::1', '2015-08-12 07:36:42'),
(734, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1a25d7e74453fb97a5d1070c28ca4659e15860ea', '2015-08-12', '09:36:44', '09:36:46', '00:00:02', 'user', '::1', '2015-08-12 07:36:44'),
(735, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '1a25d7e74453fb97a5d1070c28ca4659e15860ea', '2015-08-12', '09:36:46', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:36:46'),
(736, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:41:25', '09:41:27', '00:00:02', 'user', '::1', '2015-08-12 07:41:25'),
(737, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:41:27', '09:41:30', '00:00:03', 'user', '::1', '2015-08-12 07:41:27'),
(738, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:41:30', '09:42:05', '00:00:35', 'user', '::1', '2015-08-12 07:41:30'),
(739, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:42:05', '09:42:13', '00:00:08', 'user', '::1', '2015-08-12 07:42:05'),
(740, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:42:14', '09:42:16', '00:00:02', 'user', '::1', '2015-08-12 07:42:14'),
(741, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:42:17', '09:43:38', '00:00:00', 'user', '::1', '2015-08-12 07:42:17'),
(742, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:43:39', '09:43:41', '00:00:02', 'user', '::1', '2015-08-12 07:43:39'),
(743, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:43:41', '09:44:17', '00:00:36', 'user', '::1', '2015-08-12 07:43:41'),
(744, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:44:17', '09:44:21', '00:00:04', 'user', '::1', '2015-08-12 07:44:17'),
(745, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '540bbe398717bf69820833076802a1daf199fbac', '2015-08-12', '09:44:21', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:44:21'),
(746, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '3e779e34cbe872a07f7204694b113783e5a9f80a', '2015-08-12', '09:47:00', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:47:00'),
(747, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'b00f124295c94ca8cb18751feceb236214848a0f', '2015-08-12', '09:47:00', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:47:00'),
(748, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '80e89effb6f5252e435fedd1821eb4e8cf4b3dfa', '2015-08-12', '09:47:00', '09:47:03', '00:00:03', 'user', '::1', '2015-08-12 07:47:00'),
(749, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '80e89effb6f5252e435fedd1821eb4e8cf4b3dfa', '2015-08-12', '09:47:03', '09:49:29', '00:01:46', 'user', '::1', '2015-08-12 07:47:03'),
(750, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '80e89effb6f5252e435fedd1821eb4e8cf4b3dfa', '2015-08-12', '09:49:29', '09:49:31', '00:00:02', 'user', '::1', '2015-08-12 07:49:29'),
(751, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '80e89effb6f5252e435fedd1821eb4e8cf4b3dfa', '2015-08-12', '09:49:31', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:49:31'),
(752, 49, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'baf1837a4fa0926a946b2fddf3eced33f9e6ce25', '2015-08-12', '09:52:56', '09:52:58', '00:00:02', 'user', '::1', '2015-08-12 07:52:56'),
(753, 49, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'baf1837a4fa0926a946b2fddf3eced33f9e6ce25', '2015-08-12', '09:52:58', '09:53:03', '00:00:05', 'user', '::1', '2015-08-12 07:52:58'),
(754, 49, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'baf1837a4fa0926a946b2fddf3eced33f9e6ce25', '2015-08-12', '09:53:03', '09:54:11', '00:00:00', 'user', '::1', '2015-08-12 07:53:03'),
(755, 49, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'baf1837a4fa0926a946b2fddf3eced33f9e6ce25', '2015-08-12', '09:54:11', '09:54:14', '00:00:03', 'user', '::1', '2015-08-12 07:54:11'),
(756, 49, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'baf1837a4fa0926a946b2fddf3eced33f9e6ce25', '2015-08-12', '09:54:14', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:54:14'),
(757, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'b0b52c38c00c8027c3038b36724b5692836ad72c', '2015-08-12', '09:54:17', '09:54:19', '00:00:02', NULL, '::1', '2015-08-12 07:54:17'),
(758, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'b0b52c38c00c8027c3038b36724b5692836ad72c', '2015-08-12', '09:54:19', '09:54:22', '00:00:03', NULL, '::1', '2015-08-12 07:54:19'),
(759, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'b0b52c38c00c8027c3038b36724b5692836ad72c', '2015-08-12', '09:54:22', '09:54:24', '00:00:02', NULL, '::1', '2015-08-12 07:54:22'),
(760, 49, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'b0b52c38c00c8027c3038b36724b5692836ad72c', '2015-08-12', '09:54:24', '09:56:30', '00:01:26', 'user', '::1', '2015-08-12 07:54:24'),
(761, 49, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'b0b52c38c00c8027c3038b36724b5692836ad72c', '2015-08-12', '09:56:30', NULL, '00:00:00', 'user', '::1', '2015-08-12 07:56:30'),
(762, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:56:33', '09:56:36', '00:00:03', NULL, '::1', '2015-08-12 07:56:33'),
(763, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:56:36', '09:56:38', '00:00:02', NULL, '::1', '2015-08-12 07:56:36'),
(764, 0, 'http://localhost/zing/offeringPrograms/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:56:38', '09:56:40', '00:00:02', NULL, '::1', '2015-08-12 07:56:38'),
(765, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:56:40', '09:56:42', '00:00:02', NULL, '::1', '2015-08-12 07:56:40'),
(766, 0, 'http://localhost/zing/providerDetails/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:56:42', '09:58:17', '00:00:00', NULL, '::1', '2015-08-12 07:56:42'),
(767, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:17', '09:58:18', '00:00:01', NULL, '::1', '2015-08-12 07:58:17'),
(768, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:18', '09:58:22', '00:00:04', NULL, '::1', '2015-08-12 07:58:18'),
(769, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:22', '09:58:24', '00:00:02', NULL, '::1', '2015-08-12 07:58:22'),
(770, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:24', '09:58:25', '00:00:01', NULL, '::1', '2015-08-12 07:58:24'),
(771, 0, 'http://localhost/zing/providerDetails/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:26', '09:58:28', '00:00:02', NULL, '::1', '2015-08-12 07:58:26'),
(772, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:28', '09:58:30', '00:00:02', NULL, '::1', '2015-08-12 07:58:28'),
(773, 0, 'http://localhost/zing/offeringPrograms/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:30', '09:58:33', '00:00:03', NULL, '::1', '2015-08-12 07:58:30'),
(774, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:33', '09:58:34', '00:00:01', NULL, '::1', '2015-08-12 07:58:33'),
(775, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:34', '09:58:37', '00:00:03', NULL, '::1', '2015-08-12 07:58:34'),
(776, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:37', '09:58:39', '00:00:02', NULL, '::1', '2015-08-12 07:58:37'),
(777, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:40', '09:58:42', '00:00:02', NULL, '::1', '2015-08-12 07:58:40');
INSERT INTO `user_activity_log_details` (`id`, `user_id`, `url_visited`, `user_agent`, `session_id`, `date`, `start_time`, `end_time`, `duration`, `user_type`, `ip_address`, `created_at`) VALUES
(778, 0, 'http://localhost/zing/offeringPrograms/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:42', '09:58:45', '00:00:03', NULL, '::1', '2015-08-12 07:58:42'),
(779, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:45', '09:58:46', '00:00:01', NULL, '::1', '2015-08-12 07:58:45'),
(780, 0, 'http://localhost/zing/providerDetails/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:46', '09:58:49', '00:00:03', NULL, '::1', '2015-08-12 07:58:46'),
(781, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:49', '09:58:50', '00:00:01', NULL, '::1', '2015-08-12 07:58:49'),
(782, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:50', '09:58:53', '00:00:03', NULL, '::1', '2015-08-12 07:58:50'),
(783, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:53', '09:58:56', '00:00:03', NULL, '::1', '2015-08-12 07:58:53'),
(784, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:56', '09:58:57', '00:00:01', NULL, '::1', '2015-08-12 07:58:56'),
(785, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:58:58', '09:59:04', '00:00:06', NULL, '::1', '2015-08-12 07:58:58'),
(786, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:04', '09:59:06', '00:00:02', NULL, '::1', '2015-08-12 07:59:04'),
(787, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:06', '09:59:09', '00:00:03', NULL, '::1', '2015-08-12 07:59:06'),
(788, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:09', '09:59:12', '00:00:03', NULL, '::1', '2015-08-12 07:59:09'),
(789, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:12', '09:59:16', '00:00:04', NULL, '::1', '2015-08-12 07:59:12'),
(790, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:16', '09:59:19', '00:00:03', NULL, '::1', '2015-08-12 07:59:16'),
(791, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:19', '09:59:21', '00:00:02', NULL, '::1', '2015-08-12 07:59:19'),
(792, 0, 'http://localhost/zing/offeringPrograms/5', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:21', '09:59:23', '00:00:02', NULL, '::1', '2015-08-12 07:59:21'),
(793, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:23', '09:59:25', '00:00:02', NULL, '::1', '2015-08-12 07:59:23'),
(794, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:26', '09:59:27', '00:00:01', NULL, '::1', '2015-08-12 07:59:26'),
(795, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:27', '09:59:29', '00:00:02', NULL, '::1', '2015-08-12 07:59:27'),
(796, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:29', '09:59:31', '00:00:02', NULL, '::1', '2015-08-12 07:59:29'),
(797, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:31', '09:59:34', '00:00:03', NULL, '::1', '2015-08-12 07:59:31'),
(798, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:34', '09:59:39', '00:00:05', NULL, '::1', '2015-08-12 07:59:34'),
(799, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:39', '09:59:40', '00:00:01', NULL, '::1', '2015-08-12 07:59:39'),
(800, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:40', '09:59:41', '00:00:01', NULL, '::1', '2015-08-12 07:59:40'),
(801, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:41', '09:59:44', '00:00:03', NULL, '::1', '2015-08-12 07:59:41'),
(802, 0, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:44', '09:59:55', '00:00:11', NULL, '::1', '2015-08-12 07:59:44'),
(803, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:44', NULL, '00:00:00', NULL, '::1', '2015-08-12 07:59:44'),
(804, 0, 'http://localhost/zing/healthclubs', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '6f5be4b786a9d575256ec9df0739f20fe7d40dbe', '2015-08-12', '09:59:55', NULL, '00:00:00', NULL, '::1', '2015-08-12 07:59:55'),
(805, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '4524718034e8eb82c0a40dbd595ddb41d23d2707', '2015-08-12', '10:14:18', '10:14:21', '00:00:03', NULL, '::1', '2015-08-12 08:14:18'),
(806, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '4524718034e8eb82c0a40dbd595ddb41d23d2707', '2015-08-12', '10:14:21', '10:14:25', '00:00:04', NULL, '::1', '2015-08-12 08:14:21'),
(807, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '4524718034e8eb82c0a40dbd595ddb41d23d2707', '2015-08-12', '10:14:25', '10:14:27', '00:00:02', NULL, '::1', '2015-08-12 08:14:25'),
(808, 49, 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '4524718034e8eb82c0a40dbd595ddb41d23d2707', '2015-08-12', '10:14:27', '10:14:29', '00:00:02', 'user', '::1', '2015-08-12 08:14:27'),
(809, 49, 'http://localhost/zing/logout', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '4524718034e8eb82c0a40dbd595ddb41d23d2707', '2015-08-12', '10:14:30', NULL, '00:00:00', 'user', '::1', '2015-08-12 08:14:30'),
(810, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:14:35', '10:14:38', '00:00:03', NULL, '::1', '2015-08-12 08:14:35'),
(811, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:14:38', '10:14:41', '00:00:03', NULL, '::1', '2015-08-12 08:14:38'),
(812, 0, 'http://localhost/zing/offeringPrograms/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:14:41', '10:14:44', '00:00:03', NULL, '::1', '2015-08-12 08:14:41'),
(813, 0, 'http://localhost/zing/spa/location/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:14:44', '10:14:46', '00:00:02', NULL, '::1', '2015-08-12 08:14:44'),
(814, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:14:46', '10:14:50', '00:00:04', NULL, '::1', '2015-08-12 08:14:46'),
(815, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:14:50', '10:14:53', '00:00:03', NULL, '::1', '2015-08-12 08:14:50'),
(816, 0, 'http://localhost/zing/yoga/location/7', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:14:53', '10:14:56', '00:00:03', NULL, '::1', '2015-08-12 08:14:53'),
(817, 0, 'http://localhost/zing/offeringPrograms/2', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:14:56', '10:14:58', '00:00:02', NULL, '::1', '2015-08-12 08:14:56'),
(818, 0, 'http://localhost/zing/yoga/location/7', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:14:58', '10:15:00', '00:00:02', NULL, '::1', '2015-08-12 08:14:58'),
(819, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:15:00', '10:15:01', '00:00:01', NULL, '::1', '2015-08-12 08:15:00'),
(820, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:15:02', '10:15:09', '00:00:07', NULL, '::1', '2015-08-12 08:15:02'),
(821, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:15:09', '10:15:14', '00:00:05', NULL, '::1', '2015-08-12 08:15:09'),
(822, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:15:14', '10:15:19', '00:00:05', NULL, '::1', '2015-08-12 08:15:14'),
(823, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:15:19', '10:15:21', '00:00:02', NULL, '::1', '2015-08-12 08:15:19'),
(824, 0, 'http://localhost/zing/offeringPrograms/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:15:21', '10:15:24', '00:00:03', NULL, '::1', '2015-08-12 08:15:21'),
(825, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:15:24', '10:15:25', '00:00:01', NULL, '::1', '2015-08-12 08:15:24'),
(826, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:15:25', '10:16:00', '00:00:35', NULL, '::1', '2015-08-12 08:15:25'),
(827, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:00', '10:16:01', '00:00:01', NULL, '::1', '2015-08-12 08:16:00'),
(828, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:01', '10:16:03', '00:00:02', NULL, '::1', '2015-08-12 08:16:01'),
(829, 0, 'http://localhost/zing/providerDetails/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:03', '10:16:06', '00:00:03', NULL, '::1', '2015-08-12 08:16:03'),
(830, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:06', '10:16:08', '00:00:02', NULL, '::1', '2015-08-12 08:16:06'),
(831, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:08', '10:16:15', '00:00:07', NULL, '::1', '2015-08-12 08:16:08'),
(832, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:15', '10:16:17', '00:00:02', NULL, '::1', '2015-08-12 08:16:15'),
(833, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:17', '10:16:19', '00:00:02', NULL, '::1', '2015-08-12 08:16:17'),
(834, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:19', '10:16:37', '00:00:18', NULL, '::1', '2015-08-12 08:16:19'),
(835, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:37', '10:16:42', '00:00:05', NULL, '::1', '2015-08-12 08:16:37'),
(836, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:42', '10:16:46', '00:00:04', NULL, '::1', '2015-08-12 08:16:42'),
(837, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:16:46', '10:17:51', '00:00:00', NULL, '::1', '2015-08-12 08:16:46'),
(838, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:17:51', '10:18:00', '00:00:09', NULL, '::1', '2015-08-12 08:17:51'),
(839, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:18:00', '10:18:04', '00:00:04', NULL, '::1', '2015-08-12 08:18:00'),
(840, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:18:04', '10:18:07', '00:00:03', NULL, '::1', '2015-08-12 08:18:04'),
(841, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd00e843a006cc607f9503ad3349e7ff68cc51a0b', '2015-08-12', '10:18:07', NULL, '00:00:00', NULL, '::1', '2015-08-12 08:18:07'),
(842, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7c1f8dd1ee38f79a040760fa7294e566e07e17ff', '2015-08-12', '10:26:14', '10:26:17', '00:00:03', NULL, '::1', '2015-08-12 08:26:14'),
(843, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7c1f8dd1ee38f79a040760fa7294e566e07e17ff', '2015-08-12', '10:26:17', '10:26:20', '00:00:03', NULL, '::1', '2015-08-12 08:26:17'),
(844, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7c1f8dd1ee38f79a040760fa7294e566e07e17ff', '2015-08-12', '10:26:21', '10:27:15', '00:00:54', NULL, '::1', '2015-08-12 08:26:21'),
(845, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7c1f8dd1ee38f79a040760fa7294e566e07e17ff', '2015-08-12', '10:27:16', '10:27:18', '00:00:02', NULL, '::1', '2015-08-12 08:27:16'),
(846, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7c1f8dd1ee38f79a040760fa7294e566e07e17ff', '2015-08-12', '10:27:18', '10:27:21', '00:00:03', NULL, '::1', '2015-08-12 08:27:18'),
(847, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7c1f8dd1ee38f79a040760fa7294e566e07e17ff', '2015-08-12', '10:27:21', '10:30:55', '00:02:14', NULL, '::1', '2015-08-12 08:27:21'),
(848, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7c1f8dd1ee38f79a040760fa7294e566e07e17ff', '2015-08-12', '10:30:55', '10:30:58', '00:00:03', NULL, '::1', '2015-08-12 08:30:55'),
(849, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7c1f8dd1ee38f79a040760fa7294e566e07e17ff', '2015-08-12', '10:30:58', '10:31:01', '00:00:03', NULL, '::1', '2015-08-12 08:30:58'),
(850, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '7c1f8dd1ee38f79a040760fa7294e566e07e17ff', '2015-08-12', '10:31:01', NULL, '00:00:00', NULL, '::1', '2015-08-12 08:31:01'),
(851, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '30c57f510a337fdf79e5b731d705f683f9052014', '2015-08-12', '10:32:50', '10:32:53', '00:00:03', NULL, '::1', '2015-08-12 08:32:50'),
(852, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '30c57f510a337fdf79e5b731d705f683f9052014', '2015-08-12', '10:32:53', '10:32:57', '00:00:04', NULL, '::1', '2015-08-12 08:32:53'),
(853, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '30c57f510a337fdf79e5b731d705f683f9052014', '2015-08-12', '10:32:57', '10:33:59', '00:00:00', NULL, '::1', '2015-08-12 08:32:57'),
(854, 0, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '30c57f510a337fdf79e5b731d705f683f9052014', '2015-08-12', '10:33:59', '10:34:03', '00:00:04', NULL, '::1', '2015-08-12 08:33:59'),
(855, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '30c57f510a337fdf79e5b731d705f683f9052014', '2015-08-12', '10:34:03', '10:34:06', '00:00:03', NULL, '::1', '2015-08-12 08:34:03'),
(856, 0, 'http://localhost/zing/googleLogin', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '30c57f510a337fdf79e5b731d705f683f9052014', '2015-08-12', '10:34:06', NULL, '00:00:00', NULL, '::1', '2015-08-12 08:34:06'),
(857, 0, 'http://localhost/zing/healthclubs', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', '06c88bc0ada79f341da4894a605a8138dc5ad4e5', '2015-08-12', '10:48:49', '10:49:04', '00:00:15', NULL, '::1', '2015-08-12 08:48:49'),
(858, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', '06c88bc0ada79f341da4894a605a8138dc5ad4e5', '2015-08-12', '10:49:04', '10:49:08', '00:00:04', NULL, '::1', '2015-08-12 08:49:04'),
(859, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', '06c88bc0ada79f341da4894a605a8138dc5ad4e5', '2015-08-12', '10:49:09', '10:49:15', '00:00:06', NULL, '::1', '2015-08-12 08:49:09'),
(860, 0, 'http://localhost/zing/offeringPrograms/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', '06c88bc0ada79f341da4894a605a8138dc5ad4e5', '2015-08-12', '10:49:15', NULL, '00:00:00', NULL, '::1', '2015-08-12 08:49:15'),
(861, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '9ed7b1e4702e5837afc2f5df36f86dae646c494b', '2015-08-12', '12:45:43', '12:46:19', '00:00:36', NULL, '::1', '2015-08-12 10:45:43'),
(862, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '9ed7b1e4702e5837afc2f5df36f86dae646c494b', '2015-08-12', '12:46:19', '12:46:25', '00:00:06', NULL, '::1', '2015-08-12 10:46:19'),
(863, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '9ed7b1e4702e5837afc2f5df36f86dae646c494b', '2015-08-12', '12:46:25', '12:46:38', '00:00:13', NULL, '::1', '2015-08-12 10:46:25'),
(864, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '9ed7b1e4702e5837afc2f5df36f86dae646c494b', '2015-08-12', '12:46:38', '12:49:23', '00:00:00', NULL, '::1', '2015-08-12 10:46:38'),
(865, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '9ed7b1e4702e5837afc2f5df36f86dae646c494b', '2015-08-12', '12:49:23', NULL, '00:00:00', NULL, '::1', '2015-08-12 10:49:23'),
(866, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '8e9c2c7a5f3faaa5e2c99e628b9bf63c2930c732', '2015-08-12', '13:02:37', '13:02:43', '00:00:06', NULL, '::1', '2015-08-12 11:02:37'),
(867, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '8e9c2c7a5f3faaa5e2c99e628b9bf63c2930c732', '2015-08-12', '13:02:43', '13:02:45', '00:00:02', NULL, '::1', '2015-08-12 11:02:43'),
(868, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '8e9c2c7a5f3faaa5e2c99e628b9bf63c2930c732', '2015-08-12', '13:02:45', '13:02:48', '00:00:03', NULL, '::1', '2015-08-12 11:02:45'),
(869, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '8e9c2c7a5f3faaa5e2c99e628b9bf63c2930c732', '2015-08-12', '13:02:48', '13:04:33', '00:01:05', NULL, '::1', '2015-08-12 11:02:48'),
(870, 0, 'http://localhost/zing/spa', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '8e9c2c7a5f3faaa5e2c99e628b9bf63c2930c732', '2015-08-12', '13:04:33', NULL, '00:00:00', NULL, '::1', '2015-08-12 11:04:33'),
(871, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c6c8e8e73b6e1931af2dd0d5a2111203bf77b8aa', '2015-08-12', '13:26:03', '13:27:50', '00:01:07', NULL, '::1', '2015-08-12 11:26:03'),
(872, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c6c8e8e73b6e1931af2dd0d5a2111203bf77b8aa', '2015-08-12', '13:27:50', '13:28:24', '00:00:34', NULL, '::1', '2015-08-12 11:27:50'),
(873, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c6c8e8e73b6e1931af2dd0d5a2111203bf77b8aa', '2015-08-12', '13:28:24', '13:28:36', '00:00:12', NULL, '::1', '2015-08-12 11:28:24'),
(874, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c6c8e8e73b6e1931af2dd0d5a2111203bf77b8aa', '2015-08-12', '13:28:36', '13:30:30', '00:01:14', NULL, '::1', '2015-08-12 11:28:36'),
(875, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c6c8e8e73b6e1931af2dd0d5a2111203bf77b8aa', '2015-08-12', '13:30:30', NULL, '00:00:00', NULL, '::1', '2015-08-12 11:30:30'),
(876, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '3ee5b56e1e2ce839830be421de49e9c7da6a9470', '2015-08-12', '13:33:21', NULL, '00:00:00', NULL, '::1', '2015-08-12 11:33:21'),
(877, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'cc0c517661c50c1161a242565e17a314ad9e2db3', '2015-08-12', '13:43:22', '13:43:35', '00:00:13', NULL, '::1', '2015-08-12 11:43:22'),
(878, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'cc0c517661c50c1161a242565e17a314ad9e2db3', '2015-08-12', '13:43:36', '13:44:10', '00:00:34', NULL, '::1', '2015-08-12 11:43:36'),
(879, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'cc0c517661c50c1161a242565e17a314ad9e2db3', '2015-08-12', '13:44:11', '13:44:15', '00:00:04', NULL, '::1', '2015-08-12 11:44:11'),
(880, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'cc0c517661c50c1161a242565e17a314ad9e2db3', '2015-08-12', '13:44:15', '13:44:17', '00:00:02', NULL, '::1', '2015-08-12 11:44:15'),
(881, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'cc0c517661c50c1161a242565e17a314ad9e2db3', '2015-08-12', '13:44:17', '13:44:20', '00:00:03', NULL, '::1', '2015-08-12 11:44:17'),
(882, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'cc0c517661c50c1161a242565e17a314ad9e2db3', '2015-08-12', '13:44:20', '13:44:39', '00:00:19', NULL, '::1', '2015-08-12 11:44:20'),
(883, 0, 'http://localhost/zing/ayurvedic_treatments/location/3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'cc0c517661c50c1161a242565e17a314ad9e2db3', '2015-08-12', '13:44:39', '13:44:47', '00:00:08', NULL, '::1', '2015-08-12 11:44:39'),
(884, 0, 'http://localhost/zing/ayurvedic_treatments', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'cc0c517661c50c1161a242565e17a314ad9e2db3', '2015-08-12', '13:44:47', '13:45:00', '00:00:13', NULL, '::1', '2015-08-12 11:44:47'),
(885, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'cc0c517661c50c1161a242565e17a314ad9e2db3', '2015-08-12', '13:45:00', NULL, '00:00:00', NULL, '::1', '2015-08-12 11:45:00'),
(886, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '14a954de382281aad91fd068eb4c9ea90e8db560', '2015-08-12', '13:56:00', '13:56:03', '00:00:03', NULL, '::1', '2015-08-12 11:56:00'),
(887, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '14a954de382281aad91fd068eb4c9ea90e8db560', '2015-08-12', '13:56:03', '13:56:57', '00:00:54', NULL, '::1', '2015-08-12 11:56:03'),
(888, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '14a954de382281aad91fd068eb4c9ea90e8db560', '2015-08-12', '13:56:57', '13:58:54', '00:01:17', NULL, '::1', '2015-08-12 11:56:57'),
(889, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '14a954de382281aad91fd068eb4c9ea90e8db560', '2015-08-12', '13:58:54', '14:00:46', '00:01:12', NULL, '::1', '2015-08-12 11:58:54'),
(890, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '14a954de382281aad91fd068eb4c9ea90e8db560', '2015-08-12', '14:00:46', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:00:46'),
(891, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '73c351d35a75d91037db8d94a7af119d529bebf5', '2015-08-12', '14:01:05', '14:01:12', '00:00:07', NULL, '::1', '2015-08-12 12:01:05'),
(892, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '73c351d35a75d91037db8d94a7af119d529bebf5', '2015-08-12', '14:01:12', '14:02:13', '00:00:00', NULL, '::1', '2015-08-12 12:01:12'),
(893, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '73c351d35a75d91037db8d94a7af119d529bebf5', '2015-08-12', '14:02:13', '14:03:35', '00:00:00', NULL, '::1', '2015-08-12 12:02:13'),
(894, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '73c351d35a75d91037db8d94a7af119d529bebf5', '2015-08-12', '14:03:35', '14:04:00', '00:00:25', NULL, '::1', '2015-08-12 12:03:35'),
(895, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '73c351d35a75d91037db8d94a7af119d529bebf5', '2015-08-12', '14:04:00', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:04:00'),
(896, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd7ca652133b0879c4a08fd6552f180de9fd67f29', '2015-08-12', '14:09:55', '14:10:58', '00:00:00', NULL, '::1', '2015-08-12 12:09:55'),
(897, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd7ca652133b0879c4a08fd6552f180de9fd67f29', '2015-08-12', '14:10:59', '14:12:22', '00:00:00', NULL, '::1', '2015-08-12 12:10:59'),
(898, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd7ca652133b0879c4a08fd6552f180de9fd67f29', '2015-08-12', '14:12:22', '14:12:24', '00:00:02', NULL, '::1', '2015-08-12 12:12:22'),
(899, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd7ca652133b0879c4a08fd6552f180de9fd67f29', '2015-08-12', '14:12:24', '14:12:24', '00:00:00', NULL, '::1', '2015-08-12 12:12:24'),
(900, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd7ca652133b0879c4a08fd6552f180de9fd67f29', '2015-08-12', '14:12:24', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:12:24'),
(901, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd7ca652133b0879c4a08fd6552f180de9fd67f29', '2015-08-12', '14:12:25', '14:12:53', '00:00:28', NULL, '::1', '2015-08-12 12:12:25'),
(902, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd7ca652133b0879c4a08fd6552f180de9fd67f29', '2015-08-12', '14:12:53', '14:13:25', '00:00:32', NULL, '::1', '2015-08-12 12:12:53'),
(903, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd7ca652133b0879c4a08fd6552f180de9fd67f29', '2015-08-12', '14:13:25', '14:14:55', '00:00:00', NULL, '::1', '2015-08-12 12:13:25'),
(904, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd7ca652133b0879c4a08fd6552f180de9fd67f29', '2015-08-12', '14:14:55', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:14:55'),
(905, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '34a213ae52ed029923abb47adff27dde611abe52', '2015-08-12', '14:18:08', '14:20:33', '00:01:45', NULL, '::1', '2015-08-12 12:18:08'),
(906, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '34a213ae52ed029923abb47adff27dde611abe52', '2015-08-12', '14:20:33', '14:21:24', '00:00:51', NULL, '::1', '2015-08-12 12:20:33'),
(907, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '34a213ae52ed029923abb47adff27dde611abe52', '2015-08-12', '14:21:24', '14:22:30', '00:00:00', NULL, '::1', '2015-08-12 12:21:24'),
(908, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '34a213ae52ed029923abb47adff27dde611abe52', '2015-08-12', '14:22:31', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:22:31'),
(909, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0193b65e7367f31e73b5df071a420deb1e971e99', '2015-08-12', '14:23:09', '14:27:22', '00:02:53', NULL, '::1', '2015-08-12 12:23:09'),
(910, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0193b65e7367f31e73b5df071a420deb1e971e99', '2015-08-12', '14:27:22', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:27:22'),
(911, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '608c29a37fda07623e77dbd3091fad7816b0aee9', '2015-08-12', '14:29:03', '14:31:51', '00:00:00', NULL, '::1', '2015-08-12 12:29:03'),
(912, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '608c29a37fda07623e77dbd3091fad7816b0aee9', '2015-08-12', '14:31:51', '14:32:47', '00:00:56', NULL, '::1', '2015-08-12 12:31:51'),
(913, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '608c29a37fda07623e77dbd3091fad7816b0aee9', '2015-08-12', '14:32:47', '14:33:50', '00:00:00', NULL, '::1', '2015-08-12 12:32:47'),
(914, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '608c29a37fda07623e77dbd3091fad7816b0aee9', '2015-08-12', '14:33:50', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:33:50'),
(915, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f0084bb239b2c596ca881233484be6cf4e65a707', '2015-08-12', '14:35:22', '14:35:51', '00:00:29', NULL, '::1', '2015-08-12 12:35:22'),
(916, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f0084bb239b2c596ca881233484be6cf4e65a707', '2015-08-12', '14:35:51', '14:36:12', '00:00:21', NULL, '::1', '2015-08-12 12:35:51'),
(917, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f0084bb239b2c596ca881233484be6cf4e65a707', '2015-08-12', '14:36:12', '14:37:56', '00:01:04', NULL, '::1', '2015-08-12 12:36:12'),
(918, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f0084bb239b2c596ca881233484be6cf4e65a707', '2015-08-12', '14:37:56', '14:38:36', '00:00:40', NULL, '::1', '2015-08-12 12:37:56'),
(919, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'f0084bb239b2c596ca881233484be6cf4e65a707', '2015-08-12', '14:38:36', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:38:36'),
(920, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd4bdfef7b28a210754c36e3a0602c70d27615195', '2015-08-12', '14:41:11', '14:43:41', '00:01:50', NULL, '::1', '2015-08-12 12:41:11'),
(921, 0, 'http://localhost/zing/yoga/location/orange-county-kabini.jpg', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd4bdfef7b28a210754c36e3a0602c70d27615195', '2015-08-12', '14:41:11', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:41:11'),
(922, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd4bdfef7b28a210754c36e3a0602c70d27615195', '2015-08-12', '14:43:41', '14:44:56', '00:00:00', NULL, '::1', '2015-08-12 12:43:41'),
(923, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd4bdfef7b28a210754c36e3a0602c70d27615195', '2015-08-12', '14:44:56', '14:44:57', '00:00:01', NULL, '::1', '2015-08-12 12:44:56'),
(924, 0, 'http://localhost/zing/yoga/location/orange-county-kabini.jpg', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd4bdfef7b28a210754c36e3a0602c70d27615195', '2015-08-12', '14:44:57', '14:45:45', '00:00:48', NULL, '::1', '2015-08-12 12:44:57'),
(925, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'd4bdfef7b28a210754c36e3a0602c70d27615195', '2015-08-12', '14:45:45', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:45:45'),
(926, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0ae76755d3e40a4f8a8a152e6040a4cdbe8b1c13', '2015-08-12', '14:46:43', '14:46:55', '00:00:12', NULL, '::1', '2015-08-12 12:46:43'),
(927, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0ae76755d3e40a4f8a8a152e6040a4cdbe8b1c13', '2015-08-12', '14:46:55', '14:47:07', '00:00:12', NULL, '::1', '2015-08-12 12:46:55'),
(928, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0ae76755d3e40a4f8a8a152e6040a4cdbe8b1c13', '2015-08-12', '14:47:07', '14:48:15', '00:00:00', NULL, '::1', '2015-08-12 12:47:07'),
(929, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0ae76755d3e40a4f8a8a152e6040a4cdbe8b1c13', '2015-08-12', '14:48:15', '14:49:08', '00:00:53', NULL, '::1', '2015-08-12 12:48:15'),
(930, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0ae76755d3e40a4f8a8a152e6040a4cdbe8b1c13', '2015-08-12', '14:49:08', '14:49:50', '00:00:42', NULL, '::1', '2015-08-12 12:49:08'),
(931, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0ae76755d3e40a4f8a8a152e6040a4cdbe8b1c13', '2015-08-12', '14:49:50', '14:50:26', '00:00:36', NULL, '::1', '2015-08-12 12:49:50'),
(932, 0, 'http://localhost/zing/yoga/location/%3C', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0ae76755d3e40a4f8a8a152e6040a4cdbe8b1c13', '2015-08-12', '14:49:50', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:49:50'),
(933, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0ae76755d3e40a4f8a8a152e6040a4cdbe8b1c13', '2015-08-12', '14:50:26', '14:50:56', '00:00:30', NULL, '::1', '2015-08-12 12:50:26'),
(934, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0ae76755d3e40a4f8a8a152e6040a4cdbe8b1c13', '2015-08-12', '14:50:56', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:50:56'),
(935, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c69d17c6e07268a6c7e403f78844aec79d03933e', '2015-08-12', '14:51:58', '14:52:10', '00:00:12', NULL, '::1', '2015-08-12 12:51:58'),
(936, 0, 'http://localhost/zing/offeringPrograms/5', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c69d17c6e07268a6c7e403f78844aec79d03933e', '2015-08-12', '14:52:10', '14:52:13', '00:00:03', NULL, '::1', '2015-08-12 12:52:10'),
(937, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c69d17c6e07268a6c7e403f78844aec79d03933e', '2015-08-12', '14:52:13', '14:54:05', '00:01:12', NULL, '::1', '2015-08-12 12:52:13'),
(938, 0, 'http://localhost/zing/offeringPrograms/4', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c69d17c6e07268a6c7e403f78844aec79d03933e', '2015-08-12', '14:54:05', '14:54:08', '00:00:03', NULL, '::1', '2015-08-12 12:54:05'),
(939, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c69d17c6e07268a6c7e403f78844aec79d03933e', '2015-08-12', '14:54:08', NULL, '00:00:00', NULL, '::1', '2015-08-12 12:54:08'),
(940, 0, 'http://localhost/zing/servicesDetails/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c777a600604e50eb381e0212e4173a3212ead1aa', '2015-08-13', '08:46:06', NULL, '00:00:00', NULL, '::1', '2015-08-13 06:46:06'),
(941, 0, 'http://localhost/zing/servicesDetails/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '722278e2787e27b058bdee7d122d4cbb486b59a3', '2015-08-13', '08:53:09', '08:56:21', '00:00:00', NULL, '::1', '2015-08-13 06:53:09'),
(942, 0, 'http://localhost/zing/servicesDetails/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '722278e2787e27b058bdee7d122d4cbb486b59a3', '2015-08-13', '08:56:22', '08:57:18', '00:00:56', NULL, '::1', '2015-08-13 06:56:22'),
(943, 0, 'http://localhost/zing/servicesDetails/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '722278e2787e27b058bdee7d122d4cbb486b59a3', '2015-08-13', '08:57:18', '08:57:33', '00:00:15', NULL, '::1', '2015-08-13 06:57:18'),
(944, 0, 'http://localhost/zing/servicesDetails/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '722278e2787e27b058bdee7d122d4cbb486b59a3', '2015-08-13', '08:57:33', NULL, '00:00:00', NULL, '::1', '2015-08-13 06:57:33'),
(945, 0, 'http://localhost/zing/servicesDetails/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'ff4a95e3401cd588a5dc86aec0c307ce00ef44ae', '2015-08-13', '08:58:47', NULL, '00:00:00', NULL, '::1', '2015-08-13 06:58:47'),
(946, 0, 'http://localhost/zing/servicesDetails/1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'de9eeb145c91ca7fc0ff6720234d8c3e9f53a60b', '2015-08-13', '09:09:51', '09:09:53', '00:00:02', NULL, '::1', '2015-08-13 07:09:51'),
(947, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'de9eeb145c91ca7fc0ff6720234d8c3e9f53a60b', '2015-08-13', '09:09:53', '09:10:05', '00:00:12', NULL, '::1', '2015-08-13 07:09:53'),
(948, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'de9eeb145c91ca7fc0ff6720234d8c3e9f53a60b', '2015-08-13', '09:10:07', '09:10:56', '00:00:49', NULL, '::1', '2015-08-13 07:10:07');
INSERT INTO `user_activity_log_details` (`id`, `user_id`, `url_visited`, `user_agent`, `session_id`, `date`, `start_time`, `end_time`, `duration`, `user_type`, `ip_address`, `created_at`) VALUES
(949, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'de9eeb145c91ca7fc0ff6720234d8c3e9f53a60b', '2015-08-13', '09:10:56', '09:10:58', '00:00:02', NULL, '::1', '2015-08-13 07:10:56'),
(950, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'de9eeb145c91ca7fc0ff6720234d8c3e9f53a60b', '2015-08-13', '09:10:58', NULL, '00:00:00', NULL, '::1', '2015-08-13 07:10:58'),
(951, 0, 'http://localhost/zing/yoga/location/9', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'c49bcf703c9d6321e3278db392fba5ee6b6b2c62', '2015-08-13', '10:13:36', NULL, '00:00:00', NULL, '::1', '2015-08-13 08:13:36'),
(952, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a58c40518583ccde58cf1bd52e31b6d7405fd05d', '2015-08-13', '13:16:06', '13:16:17', '00:00:11', NULL, '::1', '2015-08-13 11:16:06'),
(953, 0, 'http://localhost/zing/yoga', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a58c40518583ccde58cf1bd52e31b6d7405fd05d', '2015-08-13', '13:16:18', '13:16:25', '00:00:07', NULL, '::1', '2015-08-13 11:16:18'),
(954, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a58c40518583ccde58cf1bd52e31b6d7405fd05d', '2015-08-13', '13:16:25', '13:16:33', '00:00:08', NULL, '::1', '2015-08-13 11:16:25'),
(955, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a58c40518583ccde58cf1bd52e31b6d7405fd05d', '2015-08-13', '13:16:33', '13:16:38', '00:00:05', NULL, '::1', '2015-08-13 11:16:33'),
(956, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a58c40518583ccde58cf1bd52e31b6d7405fd05d', '2015-08-13', '13:16:38', '13:16:49', '00:00:11', NULL, '::1', '2015-08-13 11:16:38'),
(957, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a58c40518583ccde58cf1bd52e31b6d7405fd05d', '2015-08-13', '13:16:49', '13:16:52', '00:00:03', NULL, '::1', '2015-08-13 11:16:49'),
(958, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a58c40518583ccde58cf1bd52e31b6d7405fd05d', '2015-08-13', '13:16:52', '13:16:58', '00:00:06', NULL, '::1', '2015-08-13 11:16:52'),
(959, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'a58c40518583ccde58cf1bd52e31b6d7405fd05d', '2015-08-13', '13:16:58', NULL, '00:00:00', NULL, '::1', '2015-08-13 11:16:58'),
(960, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '58dbf0e5352254362071abca127ec3a457ffd18a', '2015-08-13', '13:28:53', '13:29:00', '00:00:07', NULL, '::1', '2015-08-13 11:28:53'),
(961, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '58dbf0e5352254362071abca127ec3a457ffd18a', '2015-08-13', '13:29:00', '13:29:08', '00:00:08', NULL, '::1', '2015-08-13 11:29:00'),
(962, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '58dbf0e5352254362071abca127ec3a457ffd18a', '2015-08-13', '13:29:08', '13:29:50', '00:00:42', NULL, '::1', '2015-08-13 11:29:08'),
(963, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '58dbf0e5352254362071abca127ec3a457ffd18a', '2015-08-13', '13:29:52', '13:32:02', '00:01:30', NULL, '::1', '2015-08-13 11:29:52'),
(964, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '58dbf0e5352254362071abca127ec3a457ffd18a', '2015-08-13', '13:32:02', '13:32:07', '00:00:05', NULL, '::1', '2015-08-13 11:32:02'),
(965, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '58dbf0e5352254362071abca127ec3a457ffd18a', '2015-08-13', '13:32:07', NULL, '00:00:00', NULL, '::1', '2015-08-13 11:32:07'),
(966, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0fc5e6af1332c783025dc1165b8f6d2d67da779f', '2015-08-13', '13:34:13', '13:34:16', '00:00:03', NULL, '::1', '2015-08-13 11:34:13'),
(967, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0fc5e6af1332c783025dc1165b8f6d2d67da779f', '2015-08-13', '13:34:16', '13:35:32', '00:00:00', NULL, '::1', '2015-08-13 11:34:16'),
(968, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0fc5e6af1332c783025dc1165b8f6d2d67da779f', '2015-08-13', '13:35:32', '13:36:03', '00:00:31', NULL, '::1', '2015-08-13 11:35:32'),
(969, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0fc5e6af1332c783025dc1165b8f6d2d67da779f', '2015-08-13', '13:36:03', '13:36:06', '00:00:03', NULL, '::1', '2015-08-13 11:36:03'),
(970, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0fc5e6af1332c783025dc1165b8f6d2d67da779f', '2015-08-13', '13:36:06', '13:36:28', '00:00:22', NULL, '::1', '2015-08-13 11:36:06'),
(971, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0fc5e6af1332c783025dc1165b8f6d2d67da779f', '2015-08-13', '13:36:28', '13:36:31', '00:00:03', NULL, '::1', '2015-08-13 11:36:28'),
(972, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0fc5e6af1332c783025dc1165b8f6d2d67da779f', '2015-08-13', '13:36:31', '13:36:38', '00:00:07', NULL, '::1', '2015-08-13 11:36:31'),
(973, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0fc5e6af1332c783025dc1165b8f6d2d67da779f', '2015-08-13', '13:36:38', '13:38:51', '00:01:33', NULL, '::1', '2015-08-13 11:36:38'),
(974, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '0fc5e6af1332c783025dc1165b8f6d2d67da779f', '2015-08-13', '13:38:51', NULL, '00:00:00', NULL, '::1', '2015-08-13 11:38:51'),
(975, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '8cd6cde57c740eb44e1908122524ac29fec3287f', '2015-08-13', '13:39:40', '13:39:45', '00:00:05', NULL, '::1', '2015-08-13 11:39:40'),
(976, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '8cd6cde57c740eb44e1908122524ac29fec3287f', '2015-08-13', '13:39:45', '13:39:56', '00:00:11', NULL, '::1', '2015-08-13 11:39:45'),
(977, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '8cd6cde57c740eb44e1908122524ac29fec3287f', '2015-08-13', '13:39:56', NULL, '00:00:00', NULL, '::1', '2015-08-13 11:39:56'),
(978, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:03:47', '14:03:50', '00:00:03', NULL, '::1', '2015-08-13 12:03:47'),
(979, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:03:50', '14:03:52', '00:00:02', NULL, '::1', '2015-08-13 12:03:50'),
(980, 0, 'http://localhost/zing/getVendor', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:03:52', '14:05:08', '00:00:00', NULL, '::1', '2015-08-13 12:03:52'),
(981, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:05:10', '14:05:19', '00:00:09', NULL, '::1', '2015-08-13 12:05:10'),
(982, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:05:20', '14:05:27', '00:00:07', NULL, '::1', '2015-08-13 12:05:20'),
(983, 0, 'http://localhost/zing/getVendor', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:05:29', '14:06:15', '00:00:46', NULL, '::1', '2015-08-13 12:05:29'),
(984, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:06:15', '14:06:29', '00:00:14', NULL, '::1', '2015-08-13 12:06:15'),
(985, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:06:29', '14:06:34', '00:00:05', NULL, '::1', '2015-08-13 12:06:29'),
(986, 0, 'http://localhost/zing/getVendor', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:06:34', '14:08:31', '00:01:17', NULL, '::1', '2015-08-13 12:06:34'),
(987, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:08:32', '14:08:39', '00:00:07', NULL, '::1', '2015-08-13 12:08:32'),
(988, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '91bf98211c101587fd86ecbb24c7878d4fb881f2', '2015-08-13', '14:08:39', NULL, '00:00:00', NULL, '::1', '2015-08-13 12:08:39'),
(989, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'fe1d0d3e0c3b7d35dc146d9a9cb2ac1acace3588', '2015-08-13', '14:09:59', '14:10:05', '00:00:06', NULL, '::1', '2015-08-13 12:09:59'),
(990, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'fe1d0d3e0c3b7d35dc146d9a9cb2ac1acace3588', '2015-08-13', '14:10:05', '14:10:08', '00:00:03', NULL, '::1', '2015-08-13 12:10:05'),
(991, 0, 'http://localhost/zing/getVendor', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'fe1d0d3e0c3b7d35dc146d9a9cb2ac1acace3588', '2015-08-13', '14:10:08', '14:20:00', '00:00:00', NULL, '::1', '2015-08-13 12:10:08'),
(992, 0, 'http://localhost/zing/getVendor', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 'fe1d0d3e0c3b7d35dc146d9a9cb2ac1acace3588', '2015-08-13', '14:20:00', NULL, '00:00:00', NULL, '::1', '2015-08-13 12:20:00'),
(993, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:20:36', '14:20:44', '00:00:08', NULL, '::1', '2015-08-13 12:20:36'),
(994, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:20:44', '14:20:49', '00:00:05', NULL, '::1', '2015-08-13 12:20:44'),
(995, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:20:49', '14:21:00', '00:00:11', NULL, '::1', '2015-08-13 12:20:49'),
(996, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:21:00', '14:21:06', '00:00:06', NULL, '::1', '2015-08-13 12:21:00'),
(997, 0, 'http://localhost/zing/getVendor', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:21:06', '14:23:14', '00:01:28', NULL, '::1', '2015-08-13 12:21:06'),
(998, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:23:15', '14:23:20', '00:00:05', NULL, '::1', '2015-08-13 12:23:15'),
(999, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:23:20', '14:23:25', '00:00:05', NULL, '::1', '2015-08-13 12:23:20'),
(1000, 0, 'http://localhost/zing/getVendor', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:23:25', '14:24:17', '00:00:52', NULL, '::1', '2015-08-13 12:23:25'),
(1001, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:24:17', '14:24:28', '00:00:11', NULL, '::1', '2015-08-13 12:24:17'),
(1002, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:24:28', '14:24:34', '00:00:06', NULL, '::1', '2015-08-13 12:24:28'),
(1003, 0, 'http://localhost/zing/getVendor', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:24:35', '14:24:59', '00:00:24', NULL, '::1', '2015-08-13 12:24:35'),
(1004, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:25:00', '14:25:05', '00:00:05', NULL, '::1', '2015-08-13 12:25:00'),
(1005, 0, 'http://localhost/zing/getLocationsByService', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:25:05', '14:25:09', '00:00:04', NULL, '::1', '2015-08-13 12:25:05'),
(1006, 0, 'http://localhost/zing/getVendor', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', '680e7597f9cc7748cf8d00bdc071e515808c558d', '2015-08-13', '14:25:09', NULL, '00:00:00', NULL, '::1', '2015-08-13 12:25:09'),
(1007, 0, 'http://localhost/zing/', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 'e630a0c8ad533ce38634d2aadeccc88e6f77b884', '2015-08-14', '05:47:32', NULL, '00:00:00', NULL, '::1', '2015-08-14 03:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `anniversary` date NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_of_interest` int(11) NOT NULL,
  `facebook_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `gender`, `date_of_birth`, `anniversary`, `phone`, `address`, `city`, `state`, `country`, `zipcode`, `area_of_interest`, `facebook_id`, `google_id`, `created_on`, `updated_at`) VALUES
(1, 9, 'Female', '1987-07-13', '2014-02-26', NULL, 'Mathikere', 'Bangalore', 'Karnataka', 'India', '560054', 2, NULL, NULL, '2015-07-28 11:30:28', '0000-00-00 00:00:00'),
(10, 18, 'Female', '1987-07-13', '2014-02-26', NULL, 'Mathikere', 'Bangalore', 'Karnataka', 'India', '560054', 2, NULL, NULL, '2015-07-31 07:37:56', '2015-07-31 09:54:14'),
(18, 26, 'Male', '1987-07-13', '2014-02-26', '9993332068', 'Mathikere', 'Bangalore', 'Karnataka', 'India', '560054', 2, NULL, NULL, '2015-08-05 10:56:24', '2015-08-05 12:59:47'),
(39, 47, 'Male', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 3, '798587666906546', NULL, '2015-08-07 10:03:10', '0000-00-00 00:00:00'),
(40, 48, 'Male', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '110809311294220739638', '2015-08-07 10:05:07', '0000-00-00 00:00:00'),
(41, 49, 'Female', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '104012950795036062736', '2015-08-12 06:57:57', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_info`
--
ALTER TABLE `booking_info`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_booking_info_service_id` (`service_id`), ADD KEY `fk_booking_info_slot_id` (`slot_id`), ADD KEY `fk_booking_info_user_id` (`user_id`), ADD KEY `program_type` (`program_type`), ADD KEY `booking_date` (`booking_date`), ADD KEY `amount` (`amount`), ADD KEY `transaction_id` (`transaction_id`), ADD KEY `booking_status` (`booking_status`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `business_details`
--
ALTER TABLE `business_details`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_bussiness_details_location` (`suburb`), ADD KEY `name` (`name`), ADD KEY `suburb` (`suburb`), ADD KEY `city` (`city`), ADD KEY `lattitude` (`latitude`), ADD KEY `longitude` (`longitude`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `business_gallery`
--
ALTER TABLE `business_gallery`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_business_gallery_id` (`business_id`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `business_programs`
--
ALTER TABLE `business_programs`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_business_programs_id` (`business_id`), ADD KEY `program` (`program`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `business_services`
--
ALTER TABLE `business_services`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_business_services_id` (`program_id`), ADD KEY `services` (`services`), ADD KEY `program` (`program_id`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `business_services_details`
--
ALTER TABLE `business_services_details`
 ADD PRIMARY KEY (`id`), ADD KEY `price` (`price`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`), ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `business_service_gallery`
--
ALTER TABLE `business_service_gallery`
 ADD PRIMARY KEY (`id`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`), ADD KEY `fk_business_service_service_id` (`service_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_business_mapping`
--
ALTER TABLE `services_business_mapping`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_slots`
--
ALTER TABLE `services_slots`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_services_slots_id` (`service_id`), ADD KEY `service_id` (`service_id`), ADD KEY `date` (`date`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_transaction_details_booking_id` (`booking_id`), ADD KEY `fk_transaction_details_user_id` (`paid_by`), ADD KEY `transaction_id` (`transaction_id`), ADD KEY `transaction_status` (`transaction_status`), ADD KEY `transaction_date` (`transaction_date`), ADD KEY `payment_mode` (`payment_mode`), ADD KEY `amount` (`amount`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `username` (`username`,`last_logged_in`), ADD KEY `name` (`name`), ADD KEY `status` (`status`), ADD KEY `last_logged_in` (`last_logged_in`);

--
-- Indexes for table `user_activity_log_details`
--
ALTER TABLE `user_activity_log_details`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_activity_log_details_id` (`id`), ADD KEY `date` (`date`), ADD KEY `user_id` (`user_id`) USING BTREE, ADD KEY `url_visited` (`url_visited`) USING BTREE;

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_details_id` (`user_id`), ADD KEY `city` (`city`), ADD KEY `area_of_interest` (`area_of_interest`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_info`
--
ALTER TABLE `booking_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `business_gallery`
--
ALTER TABLE `business_gallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `business_programs`
--
ALTER TABLE `business_programs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `business_services`
--
ALTER TABLE `business_services`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `business_services_details`
--
ALTER TABLE `business_services_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `business_service_gallery`
--
ALTER TABLE `business_service_gallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=550;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `services_business_mapping`
--
ALTER TABLE `services_business_mapping`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `services_slots`
--
ALTER TABLE `services_slots`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `user_activity_log_details`
--
ALTER TABLE `user_activity_log_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1008;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
ADD CONSTRAINT `fk_user_details_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;