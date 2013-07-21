

CREATE TABLE IF NOT EXISTS `listitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_id` int(10) unsigned NOT NULL,
  `text` varchar(150) DEFAULT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `pos` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `listID` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `userID` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `lists` (`id`, `user_id`, `name`) VALUES
(1, 1, 'default');

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL,
  `ver_code` varchar(64) DEFAULT NULL,
  `verified` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `users` (`id`, `username`, `email`, `ver_code`, `verified`) VALUES
(1, 'demo', 'no_email', 'no_code', 1);


ALTER TABLE `listitems`
  ADD CONSTRAINT `listitems_lists` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `lists`
  ADD CONSTRAINT `users_lists` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
