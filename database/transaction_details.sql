CREATE TABLE IF NOT EXISTS `transaction_details` (
`id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `paid_by` int(11) DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_information` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `booking_id`, `transaction_id`, `transaction_status`, `transaction_date`, `paid_by`, `payment_mode`, `amount`, `other_information`, `created_on`, `updated_at`) VALUES
(1, 1, 'alz123h3777s', 'success', '2015-08-03 06:10:36', 18, 'Paypal', '100', 'testing', '2015-08-03 04:52:54', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_transaction_details_booking_id` (`booking_id`), ADD KEY `fk_transaction_details_user_id` (`paid_by`), ADD KEY `transaction_id` (`transaction_id`), ADD KEY `transaction_status` (`transaction_status`), ADD KEY `transaction_date` (`transaction_date`), ADD KEY `payment_mode` (`payment_mode`), ADD KEY `amount` (`amount`), ADD KEY `created_on` (`created_on`), ADD KEY `updated_at` (`updated_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
