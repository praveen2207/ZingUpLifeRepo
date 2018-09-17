CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `created_on`, `updated_at`) VALUES
(1, 'SPA', '2015-07-27 07:54:03', '0000-00-00 00:00:00'),
(2, 'Ayuervedic Treatments', '2015-07-27 07:54:03', '0000-00-00 00:00:00'),
(3, 'Yoga', '2015-07-27 07:54:29', '0000-00-00 00:00:00'),
(4, 'healthclubs', '2015-07-27 07:54:29', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;



ALTER TABLE `services` ADD `slug` VARCHAR(255) NOT NULL AFTER `service_name`;


UPDATE `zingup`.`services` SET `slug` = 'spa' WHERE `services`.`id` = 1; UPDATE `zingup`.`services` SET `slug` = 'ayurvedic_treatments' WHERE `services`.`id` = 2; UPDATE `zingup`.`services` SET `slug` = 'yoga' WHERE `services`.`id` = 3; UPDATE `zingup`.`services` SET `slug` = 'healthclubs' WHERE `services`.`id` = 4;