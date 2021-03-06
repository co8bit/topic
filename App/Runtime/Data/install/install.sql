SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `Topic`
--

-- --------------------------------------------------------

--
-- 表的结构 `talk_message`
--

CREATE TABLE IF NOT EXISTS `talk_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_uid` int(11) NOT NULL,
  `receiver_uid` int(11) NOT NULL,
  `last_uid` int(11) DEFAULT NULL,
  `last_content` text,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `talk_message_chat`
--

CREATE TABLE IF NOT EXISTS `talk_message_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ms_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `content` text,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `talk_notify`
--

CREATE TABLE IF NOT EXISTS `talk_notify` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `from_uid` mediumint(8) DEFAULT NULL,
  `to_uid` mediumint(8) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `appid` mediumint(8) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '1话题',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `talk_settings`
--

CREATE TABLE IF NOT EXISTS `talk_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `talk_settings`
--

INSERT INTO `talk_settings` (`id`, `type`, `value`) VALUES
(1, 'site', 'a:5:{s:8:"web_name";s:21:"Topic";s:12:"web_keywords";s:21:"Topic";s:7:"web_des";s:21:"Topic";s:13:"web_copyright";s:24:"基于LBS的可视化校园论坛";s:10:"web_statis";s:0:"";}'),
(2, 'email', 'a:7:{s:10:"email_open";i:0;s:9:"smtp_host";s:0:"";s:9:"smtp_port";s:0:"";s:9:"smtp_user";s:0:"";s:8:"smtp_pwd";s:0:"";s:9:"from_name";s:0:"";s:10:"from_email";s:0:"";}');

-- --------------------------------------------------------

--
-- 表的结构 `talk_topic`
--

CREATE TABLE IF NOT EXISTS `talk_topic` (
  `tid` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `view_num` int(10) unsigned DEFAULT '0',
  `post_num` int(10) unsigned NOT NULL DEFAULT '0',
  `is_stick` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `update_time` int(11) DEFAULT NULL,
  coordinate text NOT NULL,
  isPush boolean NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `subject` (`subject`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `talk_topic_category`
--

CREATE TABLE IF NOT EXISTS `talk_topic_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `topic_num` int(10) DEFAULT '0',
  `post_num` int(10) DEFAULT '0',
  `view_sort` int(5) NOT NULL,
  `des` text,
  `create_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
INSERT INTO `talk_topic_category` VALUES (1,0,"教学区",0,0,1,"教学区板块",1399793461,1);
INSERT INTO `talk_topic_category` VALUES (2,0,"宿舍区",0,0,2,"宿舍区板块",1399793461,1);
INSERT INTO `talk_topic_category` VALUES (3,0,"食堂",0,0,3,"食堂板块",1399793461,1);
INSERT INTO `talk_topic_category` VALUES (4,0,"失物招领",0,0,4,"失物招领板块",1399793461,1);
INSERT INTO `talk_topic_category` VALUES (5,0,"社团活动",0,0,5,"社团活动板块",1399793461,1);

-- --------------------------------------------------------

--
-- 表的结构 `talk_topic_post`
--

CREATE TABLE IF NOT EXISTS `talk_topic_post` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `tid` int(10) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `first` tinyint(1) DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `talk_user`
--

CREATE TABLE IF NOT EXISTS `talk_user` (
  `uid` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `area` varchar(255) DEFAULT NULL,
  `intro` text,
  `salt` varchar(100) DEFAULT NULL,
  `at_num` int(8) DEFAULT '0',
  `inbox_num` int(8) DEFAULT '0',
  `credit` int(11) DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0' COMMENT '0用户 1管理员',
  `is_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `is_active` (`is_active`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `talk_user_follow`
--

CREATE TABLE IF NOT EXISTS `talk_user_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_uid` int(11) DEFAULT NULL,
  `to_uid` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `talk_user_token`
--

CREATE TABLE IF NOT EXISTS `talk_user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1.激活注册 2.找回密码',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE IF NOT EXISTS `talk_deletelist` (
  `tid` int(11) NOT NULL,
  fordel boolean NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

