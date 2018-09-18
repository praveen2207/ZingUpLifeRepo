CREATE TABLE IF NOT EXISTS `services_slots` (
`id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_slots` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services_slots`
--

INSERT INTO `services_slots` (`id`, `service_id`, `date`, `start_time`, `end_time`, `number_of_slots`, `created_on`, `updated_at`) VALUES
(1, 1, '2015-08-03', '11:00', '13:00', 10, '2015-08-03 06:40:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services_slots`
--
ALTER TABLE `services_slots`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_services_slots_id` (`service_id`), ADD KEY `service_id` (`service_id`), ADD KEY `date` (`date`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services_slots`
--
ALTER TABLE `services_slots`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
