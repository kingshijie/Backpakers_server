-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 04 月 13 日 19:28
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `additions`
--

CREATE TABLE IF NOT EXISTS `additions` (
  `addition_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `module_id` tinyint(3) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `is_approve` tinyint(4) NOT NULL,
  `is_checking` tinyint(1) NOT NULL,
  PRIMARY KEY (`addition_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `admin_ability`
--

CREATE TABLE IF NOT EXISTS `admin_ability` (
  `admin_id` int(10) unsigned NOT NULL,
  `ability_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `campings`
--

CREATE TABLE IF NOT EXISTS `campings` (
  `camping_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `score` int(10) unsigned NOT NULL,
  `voted` int(10) unsigned NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `description` varchar(280) NOT NULL,
  `notice` varchar(280) NOT NULL,
  `is_approve` tinyint(4) NOT NULL,
  PRIMARY KEY (`camping_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- 表的结构 `hostels`
--

CREATE TABLE IF NOT EXISTS `hostels` (
  `hostel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `score` int(10) unsigned NOT NULL,
  `voted` int(10) unsigned NOT NULL,
  `min_expense` int(11) unsigned NOT NULL,
  `max_expense` int(11) unsigned NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `description` varchar(280) NOT NULL,
  `notice` varchar(280) NOT NULL,
  `is_approve` tinyint(4) NOT NULL,
  PRIMARY KEY (`hostel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `modules`
--

INSERT INTO `modules` (`module_id`, `name`) VALUES
(1, '旅店'),
(2, '露营点'),
(3, '旅游点');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sceneries`
--

CREATE TABLE IF NOT EXISTS `sceneries` (
  `scenery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `score` int(10) unsigned NOT NULL,
  `voted` int(10) unsigned NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `description` varchar(280) NOT NULL,
  `notice` varchar(280) NOT NULL,
  `is_approve` tinyint(4) NOT NULL,
  PRIMARY KEY (`scenery_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `is_banned` tinyint(1) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `birth_city` smallint(5) unsigned NOT NULL,
  `live_city` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
