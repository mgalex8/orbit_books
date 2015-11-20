-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 14 2015 г., 00:35
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `process`
--

-- --------------------------------------------------------

--
-- Структура таблицы `processes`
--

CREATE TABLE IF NOT EXISTS `processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `creaby` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `status` enum('create','run','stop','end') NOT NULL DEFAULT 'create',
  `run_dt` varchar(10) NOT NULL,
  `limit_time` int(11) NOT NULL DEFAULT '0',
  `counter` int(11) NOT NULL DEFAULT '0',
  `created_at` varchar(10) NOT NULL,
  `updated_at` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `processes`
--

INSERT INTO `processes` (`id`, `name`, `creaby`, `active`, `status`, `run_dt`, `limit_time`, `counter`, `created_at`, `updated_at`, `created`) VALUES
(1, 'процесс 1', 1, 0, 'stop', '1442166435', 12000, 520, '1442154089', '1442168464', '2015-09-13 14:21:29'),
(2, 'процесс 2', 1, 0, 'stop', '1442166434', 3600, 557, '1442163019', '1442176435', '2015-09-13 16:50:19'),
(3, 'процесс 3', 1, 0, 'end', '1442168266', 45, 32, '1442164481', '1442176435', '2015-09-13 17:14:41'),
(4, 'процесс 4', 1, 0, 'stop', '1442169658', 265, 2, '1442168431', '1442176435', '2015-09-13 18:20:31'),
(5, 'процесс 5', 1, 0, 'create', '', 15678, 0, '1442168443', '1442176435', '2015-09-13 18:20:43'),
(6, 'процесс 6', 1, 0, 'create', '', 1254, 0, '1442168455', '1442176435', '2015-09-13 18:20:55');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `group_id` int(11) NOT NULL,
  `role` enum('admin','manager','guest') NOT NULL DEFAULT 'manager',
  `city` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `email_required` tinyint(1) NOT NULL,
  `access_token` varchar(32) NOT NULL,
  `mn` int(11) NOT NULL DEFAULT '0',
  `logins` int(11) NOT NULL,
  `last_login` varchar(10) NOT NULL,
  `created_at` varchar(10) NOT NULL,
  `updated_at` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `group_id`, `role`, `city`, `active`, `email_required`, `access_token`, `mn`, `logins`, `last_login`, `created_at`, `updated_at`, `created`) VALUES
(1, 'admin', 'mgalex8@gmail.com', '$2a$10$FsBh5AxwTMEUN8ByH1m8Keq9Oii9DyKY5IewGLH3pTaokgyU/ZDGK', 1, 'admin', '', 1, 1, 'd93cd926bc2befad358ddc2c1f12821c', 0, 0, '', '1424762115', '', '2015-09-13 19:48:29'),
(3, 'alex', 'admin@test.ru', '$2a$10$FsBh5AxwTMEUN8ByH1m8Keq9Oii9DyKY5IewGLH3pTaokgyU/ZDGK', 2, 'manager', '', 1, 0, 'e6c6a52d1e83a4b96a7bc11419e1f02b', 0, 0, '', '1442163865', '', '2015-09-13 19:02:54'),
(4, 'demo', 'demo@text.ru', '$2a$10$YJIfQbdsdvHUYp.A5A2GQOAwL3aBo9Vmj1UVjey1bWEXQ1B91Orw6', 2, 'manager', '', 1, 0, '990197b5ace1d6c209e168a9ca0edfb4', 0, 0, '', '1442163865', '', '2015-09-13 19:02:52'),
(6, 'admin2', 'text@test.ru', '$2a$10$6HF2KHvcj0A4XQZFQqCvz.jy17bOXP311tmobRBMcdbnvXOfF/Adq', 1, 'admin', '', 1, 0, '4c1a0013da34ee08c175ddbac047acba', 0, 0, '', '1442175490', '1442176065', '2015-09-13 20:18:10');

-- --------------------------------------------------------

--
-- Структура таблицы `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `title`) VALUES
(1, 'admin', 'Администратор'),
(2, 'manager', 'Процесс-менеджер');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
