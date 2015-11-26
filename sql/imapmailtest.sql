
CREATE TABLE IF NOT EXISTS `imap_detail` (
`id` int(11) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `imapPath` varchar(150) NOT NULL,
  `serverEncoding` varchar(150) NOT NULL,
  `attachmentsDir` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imap_detail`
--

INSERT INTO `imap_detail` (`id`, `mail`, `imapPath`, `serverEncoding`, `attachmentsDir`) VALUES
(1, 'gmail', '{imap.gmail.com:993/imap/ssl}', 'encoding', '/'),
(2, 'yahoo', '{imap.mail.yahoo.com:993/imap/ssl}', 'encoding', '/'),
(3, 'live', '{imap-mail.outlook.com:993/imap/ssl}', 'encoding', '/');

-- --------------------------------------------------------

--
-- Table structure for table `mail_detail`
--

CREATE TABLE IF NOT EXISTS `mail_detail` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `imapLogin` varchar(150) NOT NULL,
  `imapPassword` varchar(150) NOT NULL,
  `folder` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `imap_detail`
--
ALTER TABLE `imap_detail`
 ADD PRIMARY KEY (`id`), ADD KEY `mail` (`mail`);

--
-- Indexes for table `mail_detail`
--
ALTER TABLE `mail_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imap_detail`
--
ALTER TABLE `imap_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mail_detail`
--
ALTER TABLE `mail_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'aDbw3aK4IoVNcRuRiezcSp-84p6lIaEN', '$2y$13$ShOGphQfhdGjoWdw9.dyN.mAM/nBpERG9PQU0vjzd3KXb1NSKzh/G', NULL, 'admin@admin.com', 10, 1447921512, 1447921512);

