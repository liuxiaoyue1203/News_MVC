

CREATE DATABASE IF NOT EXISTS `newsreport` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `newsreport`;

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '���',
  `username` varchar(50) NOT NULL COMMENT '����Ա�û���',
  `password` varchar(50) NOT NULL COMMENT '����Ա����',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


--
-- ת����е����� `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');


-- --------------------------------------------------------

--
-- ��Ľṹ `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '���',
  `title` char(50)  NOT NULL COMMENT '����',
  `author` varchar(20) NOT NULL COMMENT '����',
  `from` varchar(20)  NOT NULL COMMENT '����',
  `content` text  NOT NULL COMMENT '����',
  `dateline` int(4) DEFAULT '0' COMMENT 'ʱ��',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


