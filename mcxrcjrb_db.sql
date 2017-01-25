-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 18 2014 г., 20:28
-- Версия сервера: 5.5.37-cll
-- Версия PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mcxrcjrb_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `drops`
--

CREATE TABLE IF NOT EXISTS `drops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `frozen_till` int(11) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `cat` int(11) NOT NULL,
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `drops`
--

INSERT INTO `drops` (`id`, `cdate`, `frozen_till`, `name`, `country`, `city`, `cat`, `count`) VALUES
(1, '2014-10-17 04:09:12', 0, 'Дроп1', 'Россия', 'Москва', 0, 0),
(2, '2014-10-17 04:09:23', 0, 'Дроп2', 'Россия', 'Москва', 1, -1),
(3, '2014-10-17 04:09:29', 0, 'Дроп3', 'Россия', 'Москва', 2, -1),
(4, '2014-10-17 04:09:35', 0, 'Дроп4', 'Россия', 'Москва', 2, -1),
(5, '2014-10-17 04:09:45', 0, '7Дроп7', 'Россия', 'Москва', 1, -1),
(6, '2014-10-17 22:33:33', 0, 'НОвый Дроп', 'Russia', 'Moscow', 2, -1),
(7, '2014-10-17 22:35:23', 0, 'Новый Дроп', 'Russia', 'Moscow', 2, -1),
(8, '2014-10-17 22:36:46', 0, 'Новый Дроп 1', 'Russia', 'Moscow', 2, -1),
(9, '2014-10-17 22:36:53', 0, '345345', 'Russia', 'Moscow', 2, -1),
(10, '2014-10-17 22:36:56', 0, '', 'Russia', 'Moscow', 2, 999999),
(11, '2014-10-17 22:42:35', 0, 'апрапрпар', 'Russia', 'Moscow', 2, 999999),
(12, '2014-10-17 22:42:40', 0, 'прпро', 'Russia', 'Moscow', 2, 999999),
(13, '2014-10-17 22:42:45', 0, 'попрор', 'Russia', 'Moscow', 2, 999999),
(14, '2014-10-17 22:42:54', 0, 'попо', 'Russia', 'Moscow', 1, 999999),
(15, '2014-10-17 22:44:48', 0, 'ввв', 'Russia', 'Moscow', 1, 999999),
(16, '2014-10-17 22:45:34', 0, 'ввв', 'Russia', 'Moscow', 1, 999999),
(17, '2014-10-17 22:45:53', 0, 'арапр', 'Russia', 'Moscow', 2, 999998),
(18, '2014-10-17 22:46:22', 0, '', 'Russia', 'Moscow', 2, 999999),
(19, '2014-10-17 22:50:41', 0, 'дддд', 'Russia', 'Moscow', 2, 999997),
(20, '2014-10-17 22:53:06', 0, '555', 'Russia', 'Moscow', 0, 0),
(21, '2014-10-17 22:53:14', 0, '555', 'Russia', 'Moscow', 1, 999998),
(22, '2014-10-17 22:53:21', 0, 'екнкен', 'Russia', 'Moscow', 0, 999996),
(23, '2014-10-17 22:54:57', 0, 'ерапрп', 'Russia', 'Moscow', 1, 999995),
(24, '2014-10-17 22:57:48', 0, 'прропро', 'Russia', 'Moscow', 0, 0),
(25, '2014-10-17 23:03:47', 0, '4545865', 'Russia', 'Moscow', 0, 0),
(26, '2014-10-17 23:03:53', 0, 'ghjghj', 'Russia', 'Moscow', 1, 999991),
(27, '2014-10-17 23:11:27', 0, 'fgdgd', 'Russia', 'Moscow', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `drop_orders`
--

CREATE TABLE IF NOT EXISTS `drop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drop_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ordered_by` int(11) NOT NULL,
  `mtcn` text NOT NULL,
  `country` text NOT NULL,
  `name` text NOT NULL,
  `amount` text NOT NULL,
  `currency` text NOT NULL,
  `comment` text NOT NULL,
  `order_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `drop_orders`
--

INSERT INTO `drop_orders` (`id`, `drop_id`, `status`, `ordered_by`, `mtcn`, `country`, `name`, `amount`, `currency`, `comment`, `order_creation`) VALUES
(1, 1, 2, 16, '123456', 'Швеция', 'Вася', '999', 'USD', 'fhfghfgh', '2014-10-17 04:10:00'),
(2, 2, 1, 16, 'кк44кк45678', 'Сомали', 'tfhfghg', '1045', 'FS', 'gjhgjghj', '2014-10-17 04:10:02'),
(3, 4, 1, 16, 'МТААА987', 'Украина', 'drydg', '1523', 'EUR', 'ghjghjh', '2014-10-17 04:10:05'),
(6, 5, 1, 20, 'h0159', 'ghjg', 'Вася', 'hjghjgh', 'FS', 'jghjg', '2014-10-17 12:01:52'),
(5, 5, 2, 16, 'прор753', 'Швеция', 'etsddfd', 'опропр', 'USD', 'fhgfhg', '2014-10-17 04:25:14'),
(7, 27, 1, 16, 'к852', 'е', 'н', 'г', 'USD', 'ш', '2014-10-18 00:44:23'),
(8, 26, 1, 16, '456', '', '', '', 'USD', '', '2014-10-18 01:00:10'),
(9, 25, 1, 16, 'Заполненый789', 'Заказ', 'Имя', 'сума', 'USD', 'коментарий', '2014-10-18 01:00:35'),
(10, 24, 1, 20, 'апрап', 'апрап', 'апрап', 'апр', 'USD', '5546456', '2014-10-18 01:01:58'),
(11, 26, 1, 16, '678678', '', '', '67867867', 'USD', '', '2014-10-18 04:34:04'),
(12, 23, 1, 16, '678678', '678678', '', '678678', 'USD', '', '2014-10-18 04:34:08'),
(13, 22, 1, 16, '1973', 'hjkhj', '', 'khjkhjk', 'USD', '', '2014-10-18 04:34:12'),
(14, 21, 1, 16, 'hjkhjk9746', 'hjkhj', '', 'khjkjh', 'USD', '', '2014-10-18 04:34:15'),
(15, 22, 1, 20, '7594', '', '', '123', 'USD', '', '2014-10-18 04:40:58'),
(16, 19, 1, 20, '13879', '', '', '456', 'USD', '', '2014-10-18 04:41:01'),
(17, 26, 1, 16, '927183', '', '', '4564', 'USD', '', '2014-10-18 04:41:58'),
(18, 22, 1, 16, '761943', '', '', '456', 'USD', '', '2014-10-18 04:42:00'),
(19, 20, 1, 16, '465825', '', '', '456', 'USD', '', '2014-10-18 04:42:02'),
(20, 26, 1, 16, 'gh98413', '777', 'fghfh', 'gjghj', 'USD', 'ghjghj', '2014-10-18 05:20:27'),
(21, 26, 1, 16, 'ghj168', 'jghjghj', 'ghj', '678678', 'USD', 'ghjghjgh', '2014-10-18 05:32:01'),
(22, 26, 1, 16, 'hjkjhk795', 'hjkhjk', 'hjkhjk', '768678', 'USD', 'ghjghj', '2014-10-18 05:32:26'),
(23, 23, 1, 16, 'ghj79546', 'ghjgh', 'ghjghj', '789789', 'USD', '789', '2014-10-18 05:32:38'),
(26, 23, 0, 20, '13123', '123123', '123123', '123123', 'USD', '123123', '2014-10-18 14:17:50'),
(27, 19, 0, 20, '234234', '234234', '234234', '234234', 'USD', '324234', '2014-10-18 14:29:53'),
(28, 26, 0, 16, '456456', 'dfgdfg', 'ffvcb', '4345', 'USD', 'bcvbv', '2014-10-18 14:32:11'),
(29, 23, 0, 16, '456456', 'fgghf', 'vbvcb', '6557', 'USD', '56bv', '2014-10-18 14:32:18');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newstext` text NOT NULL,
  `datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `newstext`, `datecreate`) VALUES
(8, 'Новость Для юзеров', '2014-10-17 14:18:05');

-- --------------------------------------------------------

--
-- Структура таблицы `newsusers`
--

CREATE TABLE IF NOT EXISTS `newsusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idnews` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `newsusers`
--

INSERT INTO `newsusers` (`id`, `iduser`, `idnews`) VALUES
(1, 1, 1),
(2, 16, 4),
(3, 16, 6),
(4, 16, 5),
(5, 16, 7),
(6, 16, 3),
(7, 20, 6),
(8, 20, 5),
(9, 20, 4),
(10, 20, 7),
(11, 20, 3),
(12, 20, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session` longtext NOT NULL,
  `lifetime` bigint(20) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`session`, `lifetime`, `userid`) VALUES
('07b63daae0accbb05bc713f423f4138e', 1414149309, 20),
('9d864ff6f650dbaa6cd2ea7c56bf9f48', 1414149299, 16),
('980ee6afa4f61f3ee6333ecf9ab58486', 1414246614, 16),
('1be27864fff81dc7015f872695e66930', 1414223434, 2),
('3eb2167daef82fed9e17c0999b3ef7bc', 1414246502, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `smsnumber`
--

CREATE TABLE IF NOT EXISTS `smsnumber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PhoneNumber` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `smsnumber`
--

INSERT INTO `smsnumber` (`id`, `PhoneNumber`) VALUES
(1, '+79182974817');

-- --------------------------------------------------------

--
-- Структура таблицы `statistic`
--

CREATE TABLE IF NOT EXISTS `statistic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AmountForDay` int(11) NOT NULL DEFAULT '0',
  `AmountForWeek` int(11) NOT NULL DEFAULT '0',
  `AmountForMonth` int(11) NOT NULL DEFAULT '0',
  `AmountForAllTime` int(11) NOT NULL DEFAULT '0',
  `Day` timestamp NULL DEFAULT NULL,
  `Week` timestamp NULL DEFAULT NULL,
  `Month` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `statistic`
--

INSERT INTO `statistic` (`id`, `AmountForDay`, `AmountForWeek`, `AmountForMonth`, `AmountForAllTime`, `Day`, `Week`, `Month`) VALUES
(1, 0, 0, 0, 0, '2014-10-18 10:22:57', '2014-10-18 10:22:57', '2014-10-18 10:22:57');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fromid` int(11) NOT NULL DEFAULT '0',
  `toid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `new` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=137 ;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `cdate`, `fromid`, `toid`, `text`, `new`) VALUES
(79, '2014-10-17 11:07:19', 0, 16, 'hjkhjkhjk', 0),
(80, '2014-10-17 11:07:53', 16, 0, 'user посла сообщение 1', 0),
(81, '2014-10-17 11:07:57', 16, 0, 'user посла сообщение 2', 0),
(82, '2014-10-17 11:08:00', 16, 0, 'user посла сообщение 3', 0),
(83, '2014-10-17 11:08:31', 20, 0, 'user2 посла сообщение', 0),
(84, '2014-10-17 11:08:34', 20, 0, 'user2 посла сообщение 1', 0),
(85, '2014-10-17 11:13:44', 20, 0, 'user2 посла сообщение 3', 0),
(86, '2014-10-17 11:13:49', 20, 0, 'user2 посла сообщение 4', 0),
(87, '2014-10-17 11:15:58', 0, 16, 'Админ послал сообщение user', 0),
(88, '2014-10-17 11:16:37', 20, 0, 'fghfghfgh', 0),
(89, '2014-10-17 11:16:44', 16, 0, 'ghghfhg', 0),
(90, '2014-10-17 11:16:49', 0, 20, 'fghfghfghg', 0),
(91, '2014-10-17 11:17:12', 0, 16, 'kjhkhjkhjk', 0),
(92, '2014-10-17 11:17:26', 20, 0, '123', 0),
(93, '2014-10-17 11:17:33', 0, 20, '456', 0),
(94, '2014-10-17 11:17:39', 0, 16, '789', 0),
(95, '2014-10-17 11:17:47', 16, 0, '000', 0),
(96, '2014-10-17 11:22:39', 0, 16, '1111', 0),
(97, '2014-10-17 11:22:50', 0, 16, '222', 0),
(98, '2014-10-17 11:23:16', 0, 16, '333', 0),
(99, '2014-10-17 11:23:23', 16, 0, '444', 0),
(100, '2014-10-17 11:23:26', 16, 0, '555', 0),
(101, '2014-10-17 11:23:28', 16, 0, '666', 0),
(102, '2014-10-17 11:23:45', 0, 20, 'I I I', 0),
(103, '2014-10-17 11:23:54', 0, 20, 'II II II', 0),
(104, '2014-10-17 11:24:01', 0, 20, 'III III III', 0),
(105, '2014-10-17 11:24:18', 20, 0, 'IV IV IV', 0),
(106, '2014-10-17 11:24:24', 20, 0, 'V V V', 0),
(107, '2014-10-17 11:24:37', 20, 0, 'VI VI VI', 0),
(108, '2014-10-17 11:35:03', 16, 0, '77', 0),
(109, '2014-10-17 11:38:37', 16, 0, '88', 0),
(110, '2014-10-17 11:45:02', 16, 0, '99', 0),
(111, '2014-10-17 11:45:07', 20, 0, 'VII', 0),
(112, '2014-10-17 11:45:55', 16, 0, '10', 0),
(113, '2014-10-17 11:46:29', 16, 0, '11', 0),
(114, '2014-10-17 11:47:42', 16, 0, '12', 0),
(115, '2014-10-17 11:47:47', 20, 0, 'VII', 0),
(116, '2014-10-17 11:47:59', 0, 20, '**', 0),
(117, '2014-10-17 11:48:16', 0, 16, '13', 0),
(118, '2014-10-17 11:48:28', 0, 16, '14', 0),
(119, '2014-10-17 11:48:45', 16, 0, '15', 0),
(120, '2014-10-17 11:48:48', 20, 0, 'jkljkl', 0),
(121, '2014-10-17 11:48:55', 20, 0, 'klkl', 0),
(122, '2014-10-17 11:49:01', 20, 0, 'gjghjh', 0),
(123, '2014-10-17 11:58:34', 16, 0, '16', 0),
(124, '2014-10-17 11:58:43', 20, 0, 'VIII', 0),
(125, '2014-10-17 11:59:00', 16, 0, '17', 0),
(126, '2014-10-17 11:59:07', 20, 0, 'IX', 0),
(127, '2014-10-17 14:31:52', 0, 16, '123', 0),
(128, '2014-10-17 21:39:36', 16, 0, '222', 0),
(129, '2014-10-17 21:39:51', 20, 0, '99', 0),
(130, '2014-10-17 21:40:31', 20, 0, '99', 0),
(131, '2014-10-17 21:40:52', 16, 0, '99', 0),
(132, '2014-10-17 21:55:44', 16, 0, 'jkljkl', 0),
(133, '2014-10-17 21:55:56', 20, 0, 'ui7668768', 0),
(134, '2014-10-17 23:35:44', 16, 0, '123', 0),
(135, '2014-10-17 23:35:58', 20, 0, '46hf', 0),
(136, '2014-10-18 00:53:47', 16, 0, 'цкуцукуц', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nickname` text NOT NULL,
  `password` text NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `reg_date`, `nickname`, `password`, `group`) VALUES
(2, '2014-09-14 14:26:20', 'qwe', '7b0dd919dbcbfd6b0f75089d364b114c', 1),
(16, '2014-10-16 08:19:24', 'user', '1ed634f69326cb28aa2b0bc5cd398bc3', 3),
(20, '2014-10-17 09:38:29', 'user2', 'c4ecb333ad9cbfdf8f8f8cba9bd9ddee', 3),
(22, '2014-10-17 23:09:13', 'user3', '9132167be84378809b7e84458d2fda99', 3),
(10, '2014-10-11 15:56:01', 'aeq', '2cea3f9e8e685c9930bc92db60e3fca6', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
