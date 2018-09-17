
CREATE TABLE IF NOT EXISTS `business_service_gallery` (
`id` int(11) NOT NULL,
  `service_id` varchar(45) NOT NULL,
  `images` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_service_gallery`
--

INSERT INTO `business_service_gallery` (`id`, `service_id`, `images`, `created_on`, `updated_at`) VALUES
(1, '1', 'flower.png', '2015-08-07 07:05:30', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_service_gallery`
--
ALTER TABLE `business_service_gallery`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_service_gallery`
--
ALTER TABLE `business_service_gallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
