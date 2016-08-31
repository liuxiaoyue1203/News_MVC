

CREATE DATABASE IF NOT EXISTS `newsreport` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `newsreport`;

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `username` varchar(50) NOT NULL COMMENT '管理员用户名',
  `password` varchar(50) NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');


-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `title` char(50)  NOT NULL COMMENT '标题',
  `author` varchar(20) NOT NULL COMMENT '作者',
  `from` varchar(20)  NOT NULL COMMENT '出处',
  `content` text  NOT NULL COMMENT '内容',
  `dateline` int(4) DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


