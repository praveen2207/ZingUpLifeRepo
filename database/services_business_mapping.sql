
CREATE TABLE IF NOT EXISTS `services_business_mapping` (
`id` int(11) NOT NULL,
  `services_id` int(11) DEFAULT NULL,
  `business_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services_business_mapping`
--

INSERT INTO `services_business_mapping` (`id`, `services_id`, `business_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 4),
(4, 2, 5),
(5, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services_business_mapping`
--
ALTER TABLE `services_business_mapping`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_services_business_mapping_service_id` (`services_id`), ADD KEY `fk_services_business_mapping_business_id` (`business_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services_business_mapping`
--
ALTER TABLE `services_business_mapping`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
