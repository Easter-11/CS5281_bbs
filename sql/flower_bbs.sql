/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `flowerbbs` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `flowerbbs`;

/* 修正 `forum_reply` 表结构 */
DROP TABLE IF EXISTS `forum_reply`;
CREATE TABLE `forum_reply` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `topic_id` int(10) NOT NULL DEFAULT '0',
  `reply_id` int(10) NOT NULL DEFAULT '0',
  `reply_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `reply_email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `reply_detail` text CHARACTER SET utf8 NOT NULL,
  `reply_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_reply_id` (`reply_id`),
  KEY `idx_topic_id` (`topic_id`)  -- 新增 topic_id 索引
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

/* 增加更多测试数据 */
INSERT INTO `forum_reply`(`topic_id`, `reply_id`, `reply_name`, `reply_email`, `reply_detail`, `reply_datetime`) VALUES
(32, 8, 'john_doe', 'john@example.com', '这个论坛的功能很棒！', '2023-03-01 14:05:00'),
(32, 9, 'alice', 'alice@example.com', '你好，大家好！', '2023-03-01 14:10:00'),
(33, 10, 'bob', 'bob@example.com', '我觉得UI可以再优化一些。', '2023-03-01 14:15:00'),
(34, 11, 'charlie', 'charlie@example.com', '测试一下多用户回复。', '2023-03-01 14:20:00');

/* 修正 `forum_topic` 表结构 */
DROP TABLE IF EXISTS `forum_topic`;
CREATE TABLE `forum_topic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `detail` text CHARACTER SET utf8 NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `view` int(10) NOT NULL DEFAULT '0',
  `reply` int(10) NOT NULL DEFAULT '0',
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/* 增加更多测试数据 */
INSERT INTO `forum_topic` (`topic`, `detail`, `name`, `email`, `datetime`, `view`, `reply`, `sticky`) VALUES
('新用户指南', '欢迎来到论坛！这里是新手指南。', 'admin', 'admin@example.com', '2023-03-01 14:00:00', 120, 10, 1),
('关于论坛规则', '请遵守论坛规则，文明发言。', 'moderator', 'mod@example.com', '2023-03-01 14:05:00', 98, 5, 1),
('前端开发交流', '讨论React、Vue等前端技术。', 'frontend_dev', 'frontend@example.com', '2023-03-01 14:10:00', 80, 7, 0),
('后端开发交流', '讨论Node.js、Django等后端技术。', 'backend_dev', 'backend@example.com', '2023-03-01 14:15:00', 75, 6, 0),
('数据库优化技巧', 'MySQL、PostgreSQL优化技巧分享。', 'db_admin', 'dbadmin@example.com', '2023-03-01 14:20:00', 60, 4, 0);

/* 修正 `forum_user` 表结构 */
DROP TABLE IF EXISTS `forum_user`;
CREATE TABLE `forum_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL, -- 增加密码长度以支持哈希
  `email` varchar(100) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `regdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/* 增加更多测试数据 */
INSERT INTO `forum_user`(`username`, `password`, `email`, `realname`, `regdate`) VALUES
('user1', 'e10adc3949ba59abbe56e057f20f883e', 'user1@example.com', 'User One', '2023-03-01 12:00:00'),
('user2', '4297f44b13955235245b2497399d7a93', 'user2@example.com', 'User Two', '2023-03-01 12:30:00'),
('user3', '5d41402abc4b2a76b9719d911017c592', 'user3@example.com', 'User Three', '2023-03-01 13:00:00'),
('user4', '7d793037a0760186574b0282f2f435e7', 'user4@example.com', 'User Four', '2023-03-01 13:30:00'),
('user5', '098f6bcd4621d373cade4e832627b4f6', 'user5@example.com', 'User Five', '2023-03-01 14:00:00');
