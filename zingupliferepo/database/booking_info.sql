CREATE TABLE IF NOT EXISTS `booking_info` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `program_type` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `booking_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `booking_info`
--

INSERT INTO `booking_info` (`id`, `user_id`, `program_type`, `service_id`, `slot_id`, `booking_date`, `amount`, `transaction_id`, `booking_status`, `created_on`, `updated_at`) VALUES
(1, 18, 1, 1, 1, '2015-08-03 00:00:00', '100', 'alz123h3777s', 'Success', '2015-08-03 04:55:12', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_info`
--
ALTER TABLE `booking_info`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_booking_info_service_id` (`service_id`), ADD KEY `fk_booking_info_slot_id` (`slot_id`), ADD KEY `fk_booking_info_user_id` (`user_id`), ADD KEY `program_type` (`program_type`), ADD KEY `booking_date` (`booking_date`), ADD KEY `amount` (`amount`), ADD KEY `transaction_id` (`transaction_id`), ADD KEY `booking_status` (`booking_status`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_info`
--
ALTER TABLE `booking_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
