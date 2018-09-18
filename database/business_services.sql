
CREATE TABLE IF NOT EXISTS `business_services` (
`id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `services` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_services`
--

INSERT INTO `business_services` (`id`, `program_id`, `services`, `created_on`, `updated_at`) VALUES
(1, 1, 'Yoga Service', '2015-08-03 06:41:55', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_services`
--
ALTER TABLE `business_services`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_business_services_id` (`program_id`), ADD KEY `services` (`services`), ADD KEY `program` (`program_id`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_services`
--
ALTER TABLE `business_services`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
