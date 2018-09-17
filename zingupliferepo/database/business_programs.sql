
CREATE TABLE IF NOT EXISTS `business_programs` (
`id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT NULL,
  `program` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_programs`
--

INSERT INTO `business_programs` (`id`, `business_id`, `program`, `created_on`, `updated_at`) VALUES
(1, 1, 'Yoga Program', '2015-08-03 06:41:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_programs`
--
ALTER TABLE `business_programs`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_business_programs_id` (`business_id`), ADD KEY `program` (`program`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_programs`
--
ALTER TABLE `business_programs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
