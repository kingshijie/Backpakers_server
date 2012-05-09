-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 05 月 09 日 16:57
-- 服务器版本: 5.1.61
-- PHP 版本: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `backpackers`
--

-- --------------------------------------------------------

--
-- 表的结构 `abilities`
--

CREATE TABLE IF NOT EXISTS `abilities` (
  `ability_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`ability_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `abilities`
--

INSERT INTO `abilities` (`ability_id`, `description`) VALUES
(1, '审核新增的旅店'),
(2, '审核新增的旅游点'),
(3, '审核新增的露营点'),
(4, '审核修改的旅店'),
(5, '审核修改的旅游点'),
(6, '审核修改的露营点'),
(7, '审核举报信息'),
(8, '用户管理'),
(9, '管理员管理'),
(10, '用户组管理'),
(13, '权限管理'),
(14, '评论审核'),
(15, '短消息管理');

-- --------------------------------------------------------

--
-- 表的结构 `additions`
--

CREATE TABLE IF NOT EXISTS `additions` (
  `addition_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `is_approve` tinyint(4) NOT NULL COMMENT '0-not checked;1-approved;2-denied;3-uncertain',
  `is_checking` tinyint(4) NOT NULL COMMENT '0-accessible;1-checking',
  PRIMARY KEY (`addition_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `additions`
--

INSERT INTO `additions` (`addition_id`, `user_id`, `module_id`, `item`, `admin_id`, `is_approve`, `is_checking`) VALUES
(1, 1, 1, 4, 1, 3, 1),
(2, 1, 1, 5, 1, 1, 1),
(3, 1, 1, 2, 1, 1, 1),
(4, 1, 1, 6, 0, 0, 0),
(5, 1, 1, 7, 0, 0, 0),
(6, 1, 1, 8, 0, 0, 0),
(7, 1, 1, 9, 0, 0, 0),
(8, 1, 1, 10, 0, 0, 0),
(9, 1, 1, 11, 0, 0, 0),
(10, 1, 1, 12, 0, 0, 0),
(11, 1, 1, 13, 0, 0, 0),
(12, 2, 1, 14, 0, 0, 0),
(13, 1, 2, 1, 0, 0, 0),
(14, 1, 3, 1, 0, 0, 0),
(15, 1, 3, 17, 0, 0, 0),
(16, 1, 3, 18, 0, 0, 0),
(17, 1, 3, 19, 0, 0, 0),
(18, 1, 1, 15, 0, 0, 0),
(19, 1, 2, 2, 0, 0, 0),
(20, 1, 3, 20, 0, 0, 0),
(21, 1, 2, 3, 0, 0, 0),
(22, 2, 1, 16, 0, 0, 0),
(23, 1, 1, 17, 0, 0, 0),
(24, 1, 4, 1, 0, 0, 0),
(25, 1, 1, 18, 0, 0, 0),
(26, 1, 1, 19, 0, 0, 0),
(27, 1, 3, 21, 0, 0, 0),
(28, 1, 3, 22, 0, 0, 0),
(29, 1, 4, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `group_id`) VALUES
(1, 'kingshijie', 'e7e515bdbad55e795b9f248183374d8d', 1),
(3, 'abcdefg', 'fcea920f7412b5da7be0cf42b8c93759', 3),
(4, 'kinsdf', '96e79218965eb72c92a549dd5a330112', 1),
(5, 'hellokitty', 'e7e515bdbad55e795b9f248183374d8d', 3);

-- --------------------------------------------------------

--
-- 表的结构 `campings`
--

CREATE TABLE IF NOT EXISTS `campings` (
  `camping_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `score` int(10) unsigned NOT NULL,
  `voted` int(10) unsigned NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `city` varchar(20) NOT NULL,
  `description` varchar(280) NOT NULL,
  `notice` varchar(280) NOT NULL,
  `is_approve` tinyint(4) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`camping_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `campings`
--

INSERT INTO `campings` (`camping_id`, `name`, `score`, `voted`, `x`, `y`, `city`, `description`, `notice`, `is_approve`, `user_id`) VALUES
(1, '露露', 0, 0, 36.0136070251465, 120.132881164551, '青岛市', '咯磨', '辛辛苦苦九牛一毛', 0, 1),
(2, '测试', 0, 0, 36.0147552490234, 120.124877929688, '青岛市', '家里', '', 0, 1),
(3, '山科大', 0, 0, 36.0147552490234, 120.124877929688, '青岛市', '韩国堵塞收到', '', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `province_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `module_id` tinyint(3) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `contents` varchar(280) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `editions`
--

CREATE TABLE IF NOT EXISTS `editions` (
  `edition_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `module_id` tinyint(3) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `description` varchar(280) NOT NULL,
  `notice` varchar(280) NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `is_approve` tinyint(4) NOT NULL,
  `is_checking` tinyint(1) NOT NULL,
  PRIMARY KEY (`edition_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `destination` varchar(20) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `time` datetime NOT NULL,
  `spot` varchar(20) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `content` varchar(280) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `events`
--

INSERT INTO `events` (`event_id`, `name`, `x`, `y`, `destination`, `user_id`, `time`, `spot`, `contact`, `content`) VALUES
(1, '拼车', 36.013671875, 120.132789611816, '黄岛小珠山', 1, '2012-05-10 14:37:20', '山东科技大学北门', '手机15863060518，QQ309645964（注明身份）', '去小珠山逛一下，领略下美景'),
(2, '', 0, 0, '', 0, '2012-05-04 21:04:09', '', '', ''),
(3, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(4, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(5, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(6, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(7, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(8, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(9, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(10, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(11, 'hh', 36.0136833190918, 120.132797241211, 'bn', 1, '2012-05-07 10:40:00', 'bbj', 'vvb', 'bb'),
(12, 'nnj', 36.0136833190918, 120.132797241211, 'ggf', 1, '2012-05-07 10:13:00', 'bnb', 'nnjh', 'bbn'),
(13, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(14, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(15, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(16, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(17, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(18, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(19, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(20, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(21, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-06 12:00:00', 'spot', 'contact', 'content'),
(22, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-10 12:00:00', 'spot', 'contact', 'content'),
(23, 'name', 36.0139236450195, 120.133224487305, '目的地', 1, '2012-05-10 12:00:00', 'spot', 'contact', 'content'),
(24, '岳亚雷', 36.0136947631836, 120.1328125, '209', 1, '2012-05-08 00:19:00', '北门', '12345', '去青青'),
(25, '岳亚雷', 36.0136947631836, 120.1328125, '209', 1, '2012-05-08 00:19:00', '北门', '12345', '去青青'),
(26, '过会', 36.0136947631836, 120.1328125, '发王宁', 1, '2012-05-10 09:23:00', '公司', '冰冰', '的vv'),
(27, '过会', 36.0136947631836, 120.1328125, '发王宁', 1, '2012-05-10 09:23:00', '公司', '冰冰', '的vv'),
(28, '和建建', 36.0136947631836, 120.1328125, '凤飞飞', 1, '2012-05-10 08:31:00', '程程下', '兴冲冲', '卫东sdafkaejflaesjlsj看了飞洒的家乐福就啊饿死空间斯大林房计算计算司机 科技第三方理解死了房间送积分经历就'),
(29, '''', 36.0122261047363, 120.132011413574, '''', 2, '2012-05-08 09:34:00', '''', '''', ''''),
(30, 'jj ', 36.0136947631836, 120.1328125, 'ggw', 1, '2012-05-08 10:55:00', 'ggg', 'xxx', 'xxx '),
(31, 'ggv', 36.0136947631836, 120.1328125, 'fgh', 1, '2012-05-08 11:04:00', 'cvb', 'chhh', 'vhhh'),
(32, 'hjj', 36.0136947631836, 120.1328125, 'xbn', 1, '2012-05-08 11:05:00', 'vbjj', 'cvn', 'fbjk'),
(33, 'vbh', 36.0136947631836, 120.1328125, 'cvb', 1, '2012-05-08 11:08:00', 'cvv', 'cvv', 'cvvvn'),
(34, 'vb', 36.0136947631836, 120.1328125, 'vf', 1, '2012-05-08 00:09:00', 'cc', 'cx', 'cc'),
(35, 'gg', 36.0136947631836, 120.1328125, 'vv', 1, '2012-05-08 11:10:00', 'CVS ', 'vc ', 'cc'),
(36, 'ggg', 36.0136947631836, 120.1328125, 'cf', 1, '2012-05-08 10:14:00', 'cc', 'cc', 'cc'),
(37, '十七世纪', 36.0144805908203, 120.129768371582, '他们家里兔兔', 1, '2012-05-12 21:00:00', '拖拉机家里哭了呕吐太极拳巴勒莫我', '309645964，15863060518', '5551159聊聊天磨'),
(38, '。不', 36.0144805908203, 120.129768371582, '吐', 1, '2012-06-09 23:02:00', '兔兔', '土', '同学');

-- --------------------------------------------------------

--
-- 表的结构 `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `groups`
--

INSERT INTO `groups` (`group_id`, `name`) VALUES
(1, '超级管理员'),
(3, '旅店添加审核员');

-- --------------------------------------------------------

--
-- 表的结构 `group_ability`
--

CREATE TABLE IF NOT EXISTS `group_ability` (
  `group_id` int(10) unsigned NOT NULL,
  `ability_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `group_ability`
--

INSERT INTO `group_ability` (`group_id`, `ability_id`) VALUES
(1, 10),
(1, 9),
(1, 8),
(3, 1),
(1, 7),
(1, 6),
(1, 5),
(1, 4),
(1, 3),
(1, 2),
(1, 1),
(1, 13),
(1, 14),
(1, 15);

-- --------------------------------------------------------

--
-- 表的结构 `hostels`
--

CREATE TABLE IF NOT EXISTS `hostels` (
  `hostel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `score` int(10) unsigned NOT NULL,
  `voted` int(10) unsigned NOT NULL,
  `min_expense` int(11) unsigned NOT NULL,
  `max_expense` int(11) unsigned NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `city` varchar(20) NOT NULL,
  `description` varchar(280) NOT NULL,
  `notice` varchar(280) NOT NULL,
  `is_approve` tinyint(4) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`hostel_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `hostels`
--

INSERT INTO `hostels` (`hostel_id`, `name`, `score`, `voted`, `min_expense`, `max_expense`, `x`, `y`, `city`, `description`, `notice`, `is_approve`, `user_id`) VALUES
(1, '山东科技大学209宿舍', 0, 0, 0, 0, 36.0133743286133, 120.131858825684, '', '相当不错', '', 0, 0),
(2, '山东科技大学209宿舍', 0, 0, 0, 0, 36.0133743286133, 120.131858825684, '', '相当不错', '', 1, 0),
(3, '榕树下旅店', 0, 0, 0, 0, 234.23412, 213.234324, '', '', '无', 0, 1),
(4, '里深旅店', 0, 0, 0, 0, 234.3532324, 542.32432, '', '', '有老鼠', 3, 1),
(5, '如家', 0, 0, 0, 0, 123.123, 21.423, '', '7天连锁', '干净', 1, 1),
(6, '123haha', 0, 0, 0, 0, 111, 222, '', 'bucuobucuo', '1111', 0, 1),
(7, '???', 0, 0, 0, 0, 36.0147552490234, 120.124877929688, '', '???209?????????????', '????', 0, 1),
(8, '??????', 0, 0, 0, 0, 36.013988494873, 120.131271362305, '', '?????????', '', 0, 1),
(9, '孔丽丽鲁鲁', 0, 0, 0, 0, 36.0134773254395, 120.131889343262, '', '俱乐部孔丽丽', '', 0, 1),
(10, '贾继超', 0, 0, 0, 0, 36.013988494873, 120.131271362305, '', '会计科目嗯', '', 0, 1),
(11, '山东科技大学', 0, 0, 0, 0, 36.0147552490234, 120.124877929688, '青岛市', '209宿舍', '', 0, 1),
(12, '巴黎', 0, 0, 0, 0, 36.0147552490234, 120.124877929688, '青岛市', '连接数据库某基金经理涂抹魔女啦精神生活刻录痛快淋漓 连接数据库某基金经理涂抹魔女啦精神生活刻录痛快淋漓 连接数据库某基金经理涂抹魔女啦精神生活刻录痛快淋漓 连接数据库某基金经理涂抹魔女啦精神生活刻录痛快淋漓', '基金经理途径了', 0, 1),
(13, '很高兴', 0, 0, 0, 0, 36.0147552490234, 120.124877929688, '青岛市', '一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二三四五 一二', '', 0, 1),
(14, '岳亚雷', 0, 0, 0, 0, 36.0119895935059, 120.132232666016, '青岛市', '在209', '试试看', 0, 2),
(15, '测试', 0, 0, 0, 0, 36.014575958252, 120.131805419922, '青岛市', '吧', '', 0, 1),
(16, '111', 0, 0, 0, 0, 0, 0, '', '111', '111', 0, 2),
(17, '无视糖厂', 0, 0, 0, 0, 36.0144805908203, 120.129768371582, '青岛市', '淋漓尽致那痛快淋漓图书出版女李佳翰兔兔', '太郎', 0, 1),
(18, 'kk ', 0, 0, 0, 0, 36.0137023925781, 120.1328125, '青岛市', 'uu', 'qq', 0, 1),
(19, 'kk ', 0, 0, 0, 0, 36.0137023925781, 120.1328125, '青岛市', 'uu', 'qq', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `contents` text NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `module_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `table_name` varchar(20) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `modules`
--

INSERT INTO `modules` (`module_id`, `name`, `table_name`) VALUES
(1, '旅店', 'hostels'),
(2, '露营点', 'campings'),
(3, '旅游点', 'sceneries'),
(4, '购物点', 'shops');

-- --------------------------------------------------------

--
-- 表的结构 `provinces`
--

CREATE TABLE IF NOT EXISTS `provinces` (
  `province_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `report_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `contents` text NOT NULL,
  `is_checking` tinyint(1) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `reports`
--

INSERT INTO `reports` (`report_id`, `user_id`, `module_id`, `item`, `admin_id`, `contents`, `is_checking`) VALUES
(1, 1, 1, 7, 0, '哈哈', 0),
(2, 1, 3, 7, 0, '绿卡的司机分开了', 0),
(3, 1, 3, 8, 0, '地址信息不正确', 0),
(4, 1, 3, 13, 0, '内容包含不和谐因素', 0),
(5, 1, 3, 7, 0, '', 0),
(6, 1, 3, 7, 0, '', 0),
(7, 1, 3, 7, 0, '', 0),
(8, 1, 3, 8, 0, '地址内容不真实', 0),
(9, 1, 3, 13, 0, '地址内容不真实', 0),
(10, 1, 3, 13, 0, '内容包含不和谐因素', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sceneries`
--

CREATE TABLE IF NOT EXISTS `sceneries` (
  `scenery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `score` int(10) unsigned NOT NULL,
  `voted` int(10) unsigned NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `city` varchar(20) NOT NULL,
  `description` varchar(280) NOT NULL,
  `notice` varchar(280) NOT NULL,
  `is_approve` tinyint(4) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`scenery_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `sceneries`
--

INSERT INTO `sceneries` (`scenery_id`, `name`, `score`, `voted`, `x`, `y`, `city`, `description`, `notice`, `is_approve`, `user_id`) VALUES
(1, '看了看了', 0, 0, 36.0147552490234, 120.124877929688, '青岛市', '咯某流口水', '基金经理了', 0, 1),
(2, '209宿舍', 0, 0, 36.0136222839355, 120.132858276367, '青岛市', '符枫是宿舍', '', 0, 1),
(3, '测试', 0, 0, 123, 321, '青岛', '萨迪克了房间啊', '测试', 0, 1),
(4, '209宿舍楼下', 0, 0, 36.0139656066895, 120.133262634277, '青岛市', '晒太阳', '', 0, 1),
(5, '宿舍楼', 0, 0, 36.0139236450195, 120.133224487305, '青岛市', '额', '', 0, 1),
(6, '北门', 0, 0, 36.0139656066895, 120.129745483398, '青岛市', '丰', '', 0, 1),
(7, '庆客隆', 26, 8, 36.0149040222168, 120.129806518555, '青岛市', '个', '12', 1, 1),
(8, '知音网吧', 26, 7, 36.0146827697754, 120.130668640137, '青岛市', '有', '', 1, 1),
(9, '阿兰', 4, 1, 36.0147933959961, 120.130989074707, '青岛市', '有', '', 0, 1),
(10, '荷谷园', 0, 0, 36.0148048400879, 120.130882263184, '青岛市', '个', '', 1, 1),
(11, '味缘', 0, 0, 36.0149307250977, 120.131652832031, '青岛市', '和', '', 0, 1),
(12, '雅香居', 0, 0, 36.0149345397949, 120.131729125977, '青岛市', '个', '', 1, 1),
(13, '江边诱惑', 15, 4, 36.014965057373, 120.132362365723, '青岛市', '有', '', 1, 1),
(14, '清雅轩', 0, 0, 36.0150184631348, 120.132392883301, '青岛市', '个', '', 0, 1),
(15, '兰州拉面', 0, 0, 36.0152282714844, 120.130966186523, '青岛市', '和', '', 1, 1),
(16, '山西面馆', 0, 0, 36.0153579711914, 120.130783081055, '青岛市', '和', '', 0, 1),
(17, 'try', 0, 0, 2432, 23432, 'qingdao', 'safjk', 'sadklfj', 0, 1),
(18, 'sdaf', 0, 0, 13, 43, 'qingdao', 'aesfwaertq32reasfasrgtawdhaehretaegsdfhgas', 'sadf', 0, 1),
(19, 'zaishi', 0, 0, 123, 333, 'qingdao', 'kjfdea', '123', 0, 1),
(20, '咯嗯踢', 0, 0, 36.014575958252, 120.131805419922, '青岛市', '蜡笔孔丽丽', '', 0, 1),
(21, '11', 0, 0, 11, 44, 'qingdao', '22', '33', 0, 1),
(22, '11', 0, 0, 11, 44, 'qingdao', '22', '33', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `shops`
--

CREATE TABLE IF NOT EXISTS `shops` (
  `shop_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `score` int(10) unsigned NOT NULL,
  `voted` int(10) unsigned NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `city` varchar(20) NOT NULL,
  `description` varchar(280) NOT NULL,
  `notice` varchar(280) NOT NULL,
  `is_approve` tinyint(4) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `shops`
--

INSERT INTO `shops` (`shop_id`, `name`, `score`, `voted`, `x`, `y`, `city`, `description`, `notice`, `is_approve`, `user_id`) VALUES
(1, '家里', 0, 0, 36.0137023925781, 120.1328125, '青岛', '具体', '图像', 1, 1),
(2, 'bbb ', 0, 0, 36.0137023925781, 120.1328125, '青岛市', 'uqu ', 'uuqq', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `is_banned` tinyint(1) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `birth_city` smallint(5) unsigned NOT NULL,
  `live_city` smallint(5) unsigned NOT NULL,
  `credit` int(10) unsigned NOT NULL,
  `interests` varchar(100) NOT NULL,
  `my_x` double NOT NULL,
  `my_y` double NOT NULL,
  `on_travel` smallint(6) NOT NULL,
  `on_listening` tinyint(4) NOT NULL,
  `device_id` varchar(16) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `is_banned`, `sex`, `birth_city`, `live_city`, `credit`, `interests`, `my_x`, `my_y`, `on_travel`, `on_listening`, `device_id`) VALUES
(1, 'kingshijie@163.com', 'e7e515bdbad55e795b9f248183374d8d', 0, 0, 0, 0, 6, '', 36.0141067504883, 120.129806518555, 0, 0, 'bfb84be0e1b2e9e8'),
(2, 'yueyalei@live.cn', 'fcea920f7412b5da7be0cf42b8c93759', 0, 0, 0, 0, 0, '', 36.0122261047363, 120.132011413574, 1, 1, '8e66c2fca4264e03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
