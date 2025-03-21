﻿CREATE TABLE `forum_topic` 
(
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `topic` VARCHAR(255) NOT NULL,
  `detail` TEXT NOT NULL,
  `name` VARCHAR(32) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `datetime` DATETIME NOT NULL,  -- ⚠️ 去掉 DEFAULT '0000-00-00 00:00:00'
  `view` INT(10) NOT NULL DEFAULT '0',
  `reply` INT(10) NOT NULL DEFAULT '0',
  `locked` TINYINT(1) NOT NULL DEFAULT '0',
  `sticky` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `forum_reply` 
(
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `topic_id` INT(10) NOT NULL DEFAULT '0',
  `reply_id` INT(10) NOT NULL DEFAULT '0',
  `reply_name` VARCHAR(32) NOT NULL,
  `reply_email` VARCHAR(100) NOT NULL,
  `reply_detail` TEXT NOT NULL,
  `reply_datetime` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  KEY `a_id` (`reply_id`)
) ENGINE=MyISAM;

CREATE TABLE `forum_user`
(
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(32) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `realname` VARCHAR(50) NOT NULL,
  `regdate` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

INSERT INTO `forum_user` (`id`, `username`, `password`, `email`, `realname`, `regdate`) 
  VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@webmaster.com', 'Administrator', '2006-12-06 00:00:00');
