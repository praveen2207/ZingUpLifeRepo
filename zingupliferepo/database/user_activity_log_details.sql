
--
-- Table structure for table `user_activity_log_details`
--

CREATE TABLE IF NOT EXISTS `user_activity_log_details` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_visited` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `user_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_activity_log_details`
--

INSERT INTO `user_activity_log_details` (`id`, `user_id`, `url_visited`, `user_agent`, `session_id`, `date`, `start_time`, `end_time`, `duration`, `user_type`, `ip_address`, `created_at`) VALUES
(1, NULL, 'http://localhost/zing/login', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '22936cee52e97897f7783fc217bd1d400b827fce', '2015-08-05', '06:58:10', NULL, NULL, NULL, '127.0.0.1', '2015-08-05 04:58:10'),
(2, NULL, 'http://localhost/zing/doLogin', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:02:13', NULL, NULL, NULL, '127.0.0.1', '2015-08-05 05:02:13'),
(3, '18', 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:02:14', '07:03:17', '00:00:00', 'user', '127.0.0.1', '2015-08-05 05:02:14'),
(4, '18', 'http://localhost/zing/dashboard', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:03:18', '07:03:20', '00:00:02', 'user', '127.0.0.1', '2015-08-05 05:03:18'),
(5, '18', 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:03:20', '07:04:05', '00:00:45', 'user', '127.0.0.1', '2015-08-05 05:03:20'),
(6, '18', 'http://localhost/zing/editProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:04:05', '07:05:01', '00:00:56', 'user', '127.0.0.1', '2015-08-05 05:04:05'),
(7, '18', 'http://localhost/zing/myProfile', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:05:02', '07:05:14', '00:00:12', 'user', '127.0.0.1', '2015-08-05 05:05:02'),
(8, '18', 'http://localhost/zing/myBookings', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'ce11b28d6be95cf88f544af9b2349e7e1ec1def2', '2015-08-05', '07:05:14', NULL, NULL, 'user', '127.0.0.1', '2015-08-05 05:05:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_activity_log_details`
--
ALTER TABLE `user_activity_log_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_activity_log_details_id` (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `url_visited` (`url_visited`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_activity_log_details`
--
ALTER TABLE `user_activity_log_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;