-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 14 2015 г., 14:22
-- Версия сервера: 5.6.24
-- Версия PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `newcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `rol` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`, `rol`) VALUES
('admin', '2', NULL, 1),
('sooperadmin', '4', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, NULL, NULL),
('create-page', 1, NULL, NULL, NULL, NULL, NULL),
('create-post', 1, NULL, NULL, NULL, NULL, NULL),
('sooperadmin', 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('sooperadmin', 'admin'),
('admin', 'create-post');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `title` varchar(250) CHARACTER SET armscii8 NOT NULL,
  `lang` varchar(250) CHARACTER SET armscii8 DEFAULT NULL,
  `paret_id` int(11) NOT NULL,
  `img` varchar(50) CHARACTER SET armscii8 DEFAULT NULL,
  `description` text CHARACTER SET armscii8,
  `forlang_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`, `lang`, `paret_id`, `img`, `description`, `forlang_id`) VALUES
(30, 'asdasd-2', 'asdasd', 'am', 0, 'scarlett_johansson_2013-wide.jpg', '', 30);

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `user_ip` varchar(50) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `is_new` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `name`, `email`, `subject`, `body`, `user_ip`, `created_at`, `is_new`) VALUES
(2, 'asdasd', 'assd@sad.fg', 'asd', 'asd', '127.0.0.1', '1434708582', 1),
(3, 'asda', 'asd@asdsd.sd', 'asd', 'asd', '127.0.0.1', '1434709054', 1),
(6, 'sfsdf', 'ssfd@sd.hg', 'asdsd', 'ssds', '127.0.0.1', '1434712505', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `created_at`) VALUES
(7, 'asdasd', '', '2015-06-15'),
(10, '7', 'fgh', '2015-06-07'),
(11, '14', 'sdfsdf', '2015-06-11 20:25'),
(12, '17', 'fgjghj', '2015-06-16'),
(13, 'asdasd', '', '2015-06-26 18:50'),
(14, 'asdads', 'asdsada  ', '2015-06-26 19:45');

-- --------------------------------------------------------

--
-- Структура таблицы `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `default` smallint(6) NOT NULL DEFAULT '0',
  `date_update` int(11) NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lang`
--

INSERT INTO `lang` (`id`, `url`, `local`, `name`, `default`, `date_update`, `date_create`) VALUES
(1, 'en', 'en-EN', 'English', 0, 1430754453, 1430754453),
(2, 'ru', 'ru-RU', 'Русский', 0, 1431428627, 1430754453),
(3, 'am', 'am-AM', 'Հայերեն', 1, 1431428613, 1430901563);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1433340074),
('m130524_201442_init', 1433340078);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `img` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `lang` varchar(10) NOT NULL,
  `parrent_id` int(11) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `img`, `created_at`, `cat_id`, `lang`, `parrent_id`, `slug`, `updated_at`) VALUES
(7, 'asd', '', 'image_1436875351.jpg', '2015-06-11 13:18:25', 2, 'am', 7, 'asd', '2015-07-14 16:02:41'),
(8, NULL, NULL, NULL, NULL, NULL, 'ru', 7, NULL, NULL),
(13, NULL, NULL, NULL, NULL, NULL, 'en', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `statistics`
--

CREATE TABLE IF NOT EXISTS `statistics` (
  `id` int(11) NOT NULL,
  `ip_adress` varchar(50) DEFAULT NULL,
  `session_id` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `date` datetime(6) DEFAULT NULL,
  `brauzer` varchar(50) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `statistics`
--

INSERT INTO `statistics` (`id`, `ip_adress`, `session_id`, `country`, `city`, `date`, `brauzer`, `count`, `platform`) VALUES
(14, '127.0.0.1', 'qv54ejhqk8ubm32hkghrp24vo0', 'AM', '', '2015-06-23 13:06:09.000000', 'Chrome', 4, NULL),
(15, 'asdasd', 'asdasd', 'RU', NULL, '2015-06-24 00:00:00.000000', 'Opera', 1, NULL),
(16, 'asd', 'asd', 'AM', 'asd', '2015-06-23 00:00:00.000000', 'Opera', 1, NULL),
(18, 'sdfsdf', 'sdfsdf', 'RU', NULL, '2015-06-19 00:00:00.000000', NULL, 3, NULL),
(19, 'sdfsdf', 'sdfsdf', 'AM', NULL, '2015-06-19 00:00:00.000000', NULL, 1, NULL),
(21, '127.0.0.1', 'rc0nao9df6dbcagvgkd44hrnt6', 'AM', '', '2015-06-23 17:03:17.000000', 'Chrome', 2, 'Windows'),
(22, '127.0.0.1', 'ssnt5f50gt5hr9iooedrf58o66', '', '', '2015-06-25 15:33:29.000000', 'Chrome', 1, 'Windows'),
(23, '127.0.0.1', 'p82ct9d0277jln8q31p1af9uq2', '', '', '2015-06-29 12:39:38.000000', 'Chrome', 7, 'Windows'),
(24, '127.0.0.1', 'a4e8g6nefmmbbfmfq82qvndv51', '', '', '2015-07-09 15:50:22.000000', 'Chrome', 1, 'Windows'),
(25, '127.0.0.1', 'viegjcf7e71oa6tv77hshgdso6', '', '', '2015-07-10 12:55:57.000000', 'Chrome', 3, 'Windows');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
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
  `updated_at` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastename` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `name`, `lastename`) VALUES
(2, 'admin', 'PGo3XfxbFgkMeuK9NRyGFN8RQL9KQon4', '$2y$13$6ecPSF2UVQKygUPktVIxF.O5CiRA58.9wrQlUQdEAcDrXupaGvL5i', NULL, 'movses.meliksetyan@mail.ru', 10, 1434008185, 1434008185, 'admin', 'admin'),
(4, 'MOSOSJAN', 'gDARBLZOdxr2r_S2apNo4UkcKeIhyJik', '$2y$13$OWoAtF.3BPTJx6wG3zR85.Vvo8BO9p7cCacUQb39.TIhyx7oHbwvy', NULL, 'movses.meliksetyan1991@gmail.com', 10, 1434793741, 1434793741, 'Movses', 'Meliksetyan');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT для таблицы `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
