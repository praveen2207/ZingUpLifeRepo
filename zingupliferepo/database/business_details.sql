
CREATE TABLE IF NOT EXISTS `business_details` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `street1` varchar(255) DEFAULT NULL,
  `street2` varchar(255) DEFAULT NULL,
  `suburb` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_details`
--

INSERT INTO `business_details` (`id`, `name`, `street1`, `street2`, `suburb`, `city`, `state`, `country`, `zipcode`, `latitude`, `longitude`, `created_on`, `updated_at`) VALUES
(1, 'The Windflower', 'brookfield', '3rd cross', 1, 'Banglore', 'Karnataka', 'India', '53005', '12.967543', '77.721209', '2015-08-04 11:09:39', NULL),
(2, 'Silent Shores', 'banaswadi', '7th main', 2, 'Banglore', 'Karnataka', 'India', '560037', '13.010554', '77.649520', '2015-08-04 11:14:37', NULL),
(3, 'Amanvana Spa on the river', 'rt nagar', '9th main', 3, 'Banglore', 'Karnataka', 'India', '560009', '12.9562', '77.7019', '2015-08-04 11:19:49', NULL),
(4, 'Grand Palace Hotel & Spa', 'mg road', '2nd cross', 2, 'Banglore', 'Karnataka', 'India', '56023', '12.9700', '77.7500', '2015-08-04 11:22:06', NULL),
(5, 'The Serai', 'mahadevapura', '1st main', 1, 'Mumbai', 'Karnataka', 'India', '560027', '13.0400', '77.5900', '2015-08-04 11:24:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_details`
--
ALTER TABLE `business_details`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_bussiness_details_location` (`suburb`), ADD KEY `name` (`name`), ADD KEY `suburb` (`suburb`), ADD KEY `city` (`city`), ADD KEY `lattitude` (`latitude`), ADD KEY `longitude` (`longitude`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_details`
--
ALTER TABLE `business_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
