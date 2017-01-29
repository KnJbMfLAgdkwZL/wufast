-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 21 2014 г., 06:03
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

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`mcxrcjrb`@`localhost` PROCEDURE `ArchiveOperations`(IN `beg` INT, IN `lim` INT, IN `stat` INT)
    NO SQL
SELECT
            drop_orders.ordered_by as ordered_by,
            drop_orders.mtcn as DOmtcn,
            drop_orders.`status` as DOstatus,
            drop_orders.country as DOcountry,
            drop_orders.`name` as DOname,
            drop_orders.amount as DOamount,
            drop_orders.currency as DOcurrency,
            drop_orders.`comment` as DOcomment,
            drop_orders.order_creation as DOorder_creation,
            drops.cdate as Dcdate,
            drops.`name` as Dname,
            drops.count as Dcount,
            drops.country as Dcountry,
            drops.city as Dcity,
            drops.cat as Dcat,
            drops.count as Dcount
        FROM `drop_orders`, `drops`
        WHERE drop_orders.drop_id = drops.id
        AND drops.count > -1
        AND drop_orders.status = stat
        ORDER BY Dcdate DESC
        LIMIT beg, lim$$

CREATE DEFINER=`mcxrcjrb`@`localhost` PROCEDURE `ArchiveOperationsAll`(IN `beg` INT, IN `lim` INT)
    NO SQL
SELECT
            drop_orders.ordered_by as ordered_by,
            drop_orders.mtcn as DOmtcn,
            drop_orders.`status` as DOstatus,
            drop_orders.country as DOcountry,
            drop_orders.`name` as DOname,
            drop_orders.amount as DOamount,
            drop_orders.currency as DOcurrency,
            drop_orders.`comment` as DOcomment,
            drop_orders.order_creation as DOorder_creation,
            drops.cdate as Dcdate,
            drops.`name` as Dname,
            drops.count as Dcount,
            drops.country as Dcountry,
            drops.city as Dcity,
            drops.cat as Dcat,
            drops.count as Dcount
        FROM `drop_orders`, `drops`
        WHERE drop_orders.drop_id = drops.id
        AND drops.count > -1
        ORDER BY Dcdate DESC
        LIMIT beg, lim$$

DELIMITER ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

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
(10, '2014-10-17 22:36:56', 0, '', 'Russia', 'Moscow', 2, -1),
(11, '2014-10-17 22:42:35', 0, 'апрапрпар', 'Russia', 'Moscow', 2, -1),
(12, '2014-10-17 22:42:40', 0, 'прпро', 'Russia', 'Moscow', 2, -1),
(13, '2014-10-17 22:42:45', 0, 'попрор', 'Russia', 'Moscow', 2, -1),
(14, '2014-10-17 22:42:54', 0, 'попо', 'Russia', 'Moscow', 1, -1),
(15, '2014-10-17 22:44:48', 0, 'ввв', 'Russia', 'Moscow', 1, -1),
(16, '2014-10-17 22:45:34', 0, 'ввв', 'Russia', 'Moscow', 1, -1),
(17, '2014-10-17 22:45:53', 0, 'арапр', 'Russia', 'Moscow', 2, -1),
(18, '2014-10-17 22:46:22', 0, '', 'Russia', 'Moscow', 2, -1),
(19, '2014-10-17 22:50:41', 0, 'дддд', 'Russia', 'Moscow', 2, -1),
(20, '2014-10-17 22:53:06', 0, '555', 'Russia', 'Moscow', 0, 0),
(21, '2014-10-17 22:53:14', 0, '555', 'Russia', 'Moscow', 1, -1),
(22, '2014-10-17 22:53:21', 0, 'екнкен', 'Russia', 'Moscow', 0, -1),
(23, '2014-10-17 22:54:57', 0, 'ерапрп', 'Russia', 'Moscow', 1, -1),
(24, '2014-10-17 22:57:48', 0, 'прропро', 'Russia', 'Moscow', 0, 0),
(25, '2014-10-17 23:03:47', 0, '4545865', 'Russia', 'Moscow', 0, 0),
(26, '2014-10-17 23:03:53', 0, 'ghjghj', 'Russia', 'Moscow', 1, -1),
(27, '2014-10-17 23:11:27', 0, 'fgdgd', 'Russia', 'Moscow', 0, 0),
(28, '2014-10-19 09:54:35', 0, 'Новый дроп 17', 'Russia', 'Moscow', 1, -1),
(29, '2014-10-19 09:56:14', 0, 'Новый дроп 18', 'Russia', 'Moscow', 0, 0),
(30, '2014-10-19 09:56:22', 0, 'Новый дроп 19', 'Russia', 'Moscow', 1, -1),
(31, '2014-10-19 09:56:28', 0, 'Иван Иванов', 'Russia', 'Moscow', 0, -1),
(32, '2014-10-19 10:06:45', 0, 'Иванов Иван', 'Russia', 'Moscow', 2, -1),
(33, '2014-10-19 10:13:24', 0, 'Новейший дроп', 'Russia', 'Moscow', 0, 0),
(34, '2014-10-19 12:22:43', 0, 'Мария Васильевна', 'Russia', 'Moscow', 0, 0),
(35, '2014-10-19 12:22:47', 0, 'Дроп 25', 'Russia', 'Moscow', 1, -1),
(36, '2014-10-19 12:22:50', 0, 'Илларион Илларионович', 'Russia', 'Moscow', 2, -1),
(37, '2014-10-19 18:06:23', 0, 'Иван Петров', 'Russia', 'Moscow', 1, 999990),
(38, '2014-10-19 18:06:32', 0, 'Петр Иванов', 'Russia', 'Moscow', 2, 999990),
(39, '2014-10-19 18:06:41', 0, 'Мария Ивановна', 'Russia', 'Moscow', 0, -1),
(40, '2014-10-19 18:08:34', 0, 'Люкс дроп', 'Russia', 'Moscow', 0, -1),
(41, '2014-10-19 19:12:36', 0, 'Abc', 'Russia', 'Moscow', 1, -1),
(42, '2014-10-19 19:13:01', 0, '123', 'Russia', 'Moscow', 0, -1),
(43, '2014-10-19 19:22:10', 0, '123', 'Russia', 'Moscow', 0, -1),
(44, '2014-10-19 19:24:21', 0, 'sdfsf', 'Russia', 'Moscow', 2, -1),
(45, '2014-10-19 19:25:09', 0, '1111111', 'Russia', 'Moscow', 2, -1),
(46, '2014-10-19 19:26:13', 0, 'имя', 'Russia', 'Moscow', 0, -1),
(47, '2014-10-19 19:27:02', 0, 'тест1', 'Russia', 'Moscow', 2, -1),
(48, '2014-10-19 19:27:23', 0, 'тест2', 'Russia', 'Moscow', 1, -1),
(49, '2014-10-19 19:35:39', 0, '123', 'Russia', 'Moscow', 0, -1),
(50, '2014-10-19 19:48:14', 0, '2222', 'Russia', 'Moscow', 2, -1),
(51, '2014-10-19 19:52:02', 0, 'asdasd', 'Russia', 'Moscow', 1, -1),
(52, '2014-10-19 19:54:44', 0, '123', 'Russia', 'Moscow', 0, -1),
(54, '2014-10-19 20:32:40', 0, 'Илларион Пантелупиков', 'Russia', 'Moscow', 1, -1),
(53, '2014-10-19 20:23:09', 0, '', 'Russia', 'Moscow', 2, -1),
(55, '2014-10-20 03:38:24', 0, 'Тестовый дроп', 'Russia', 'Moscow', 0, 0),
(56, '2014-10-20 03:38:42', 0, 'Тестовый дроп 2', 'Russia', 'Moscow', 1, -1),
(57, '2014-10-20 03:38:48', 0, 'Тестовый дроп 3', 'Russia', 'Moscow', 2, -1),
(58, '2014-10-20 03:58:27', 0, 'Тестовый дроп 3', 'Russia', 'Moscow', 2, -1),
(59, '2014-10-20 04:04:48', 0, 'Тестовый дроп 4', 'Russia', 'Moscow', 1, -1),
(60, '2014-10-20 04:04:59', 0, 'Тестовый дроп 5', 'Russia', 'Moscow', 2, -1),
(61, '2014-10-20 17:45:15', 0, '', 'Russia', 'Moscow', 0, -1),
(62, '2014-10-20 18:41:01', 0, 'пропро', 'Russia', 'Moscow', 0, -1),
(63, '2014-10-20 18:41:04', 0, 'пропро', 'Russia', 'Moscow', 1, -1),
(64, '2014-10-20 18:41:08', 0, 'пропро', 'Russia', 'Moscow', 2, -1),
(65, '2014-10-20 18:46:57', 0, '567па', 'Russia', 'Moscow', 2, -1),
(66, '2014-10-20 19:23:10', 0, '324', 'Russia', 'Moscow', 0, 0),
(67, '2014-10-20 19:23:31', 0, '123123', 'Russia', 'Moscow', 1, -1),
(68, '2014-10-20 19:23:58', 0, '4852', 'Russia', 'Moscow', 2, -1),
(69, '2014-10-20 19:24:10', 0, 'мропро', 'Russia', 'Moscow', 1, -1),
(70, '2014-10-20 19:24:14', 0, '123123123', 'Russia', 'Moscow', 0, 0),
(71, '2014-10-20 19:24:18', 0, 'пропро', 'Russia', 'Moscow', 0, 0),
(72, '2014-10-20 19:24:21', 0, '4134124', 'Russia', 'Moscow', 0, 0),
(73, '2014-10-21 05:47:51', 0, 'Длиное название дропаааааааааааа', 'Russiaааааааааа ghhhhhhhhhhhhhhhhhhhhhhh', 'Moscowwwwwwwwww rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 1, -1),
(74, '2014-10-21 07:47:33', 0, '123123', 'Russia', 'Moscow', 1, -1),
(75, '2014-10-21 07:56:16', 0, '123123', 'Russia', 'Moscow', 2, -1),
(76, '2014-10-21 07:56:45', 0, 'hjkhjk', 'Russia', 'Moscow', 1, -1),
(77, '2014-10-21 07:58:04', 0, 'ghghj', 'Russia', 'Moscow', 1, -1),
(78, '2014-10-21 07:58:08', 0, 'ghjghj', 'Russia', 'Moscow', 2, -1),
(79, '2014-10-21 07:59:41', 0, 'zxczxc', 'Russia', 'Moscow', 0, -1),
(80, '2014-10-21 09:21:38', 0, 'fffffffffffffffffffffffffffffffff ffffffffffffffff ffffffffffffffff ffffffffffffffff fffff', 'Russiafffffffffffffff ffffffffffffff fffffffffffff ffffffffffff', 'Moscow ffffffffff ffffffffffff fffff', 1, -1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

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
(26, 23, 2, 20, '13123', '123123', '123123', '123123', 'USD', '123123', '2014-10-18 14:17:50'),
(27, 19, 2, 20, '234234', '234234', '234234', '234234', 'USD', '324234', '2014-10-18 14:29:53'),
(28, 26, 2, 16, '456456', 'dfgdfg', 'ffvcb', '4345', 'USD', 'bcvbv', '2014-10-18 14:32:11'),
(29, 23, 2, 16, '456456', 'fgghf', 'vbvcb', '6557', 'USD', '56bv', '2014-10-18 14:32:18'),
(31, 28, 2, 16, '1', '1', '1', '1', 'USD', '123123', '2014-10-19 09:54:54'),
(32, 29, 2, 16, '', '', '', '', 'USD', '', '2014-10-19 09:57:11'),
(33, 31, 2, 16, '', '', '', '', 'USD', '', '2014-10-19 09:57:12'),
(34, 31, 0, 16, '654321', 'Нигерия', 'Али', '500', 'USD', 'коммент', '2014-10-19 09:57:35'),
(35, 30, 2, 16, '1', '3', '2', '4', 'USD', '5', '2014-10-19 09:58:44'),
(36, 32, 1, 16, '', '', '', '', 'USD', '', '2014-10-19 10:06:59'),
(37, 32, 2, 16, '', '', '', '', 'USD', '', '2014-10-19 10:07:04'),
(38, 32, 1, 16, '', '', '', '', 'USD', '', '2014-10-19 10:07:06'),
(39, 32, 0, 16, '', '', '', '', 'USD', '', '2014-10-19 10:13:24'),
(40, 32, 1, 16, '', '', '', '', 'USD', '', '2014-10-19 10:13:28'),
(41, 33, 1, 16, '654', '321', '321', '321', 'USD', '321', '2014-10-19 10:13:33'),
(42, 32, 0, 16, '', '', '', '', 'USD', '', '2014-10-19 10:15:40'),
(43, 32, 0, 16, '', '', '', '', 'USD', '', '2014-10-19 10:15:44'),
(44, 32, 1, 16, '', '', '', '', 'USD', '', '2014-10-19 10:15:47'),
(45, 32, 1, 16, '', '', '', '', 'USD', '', '2014-10-19 10:15:49'),
(46, 32, 1, 16, '', '', '', '', 'USD', '', '2014-10-19 10:15:51'),
(47, 32, 1, 16, '', '', '', '', 'USD', '', '2014-10-19 10:15:53'),
(48, 32, 1, 16, '321654', 'Australia', 'King Kong', '500', 'EUR', 'pp@mail.com', '2014-10-19 10:50:06'),
(49, 32, 0, 16, '445654', 'England', 'Ivan', '500', 'FS', 'To get your domain up and running fast it is critical that you log into your domain registrar and change the name-servers to point to the Bitcoinwebhosting servers.', '2014-10-19 11:17:55'),
(50, 38, 1, 16, '321564', 'Australia', 'John Doe', '500', 'EUR', 'Комментарий мой не длинный.', '2014-10-19 20:45:44'),
(51, 58, 2, 16, '556677', 'Россия', 'Виктор Викторовичь', '412', 'EUR', 'Test@mail.ru', '2014-10-20 03:59:51'),
(52, 60, 2, 16, '44778899', 'Украина', 'Виктор', '456', 'EUR', 'ww@mail.ru', '2014-10-20 05:21:20'),
(60, 72, 2, 16, '66', '55', '', '77', 'EUR', 'fghfgh', '2014-10-20 20:20:46'),
(61, 72, 1, 16, 'MTCN 12545 hj hjkjhk', 'Украина h jkhjk', 'Виктор Викторовичjhk h', '456hj jhkj', 'USD', 'My@mail.ru', '2014-10-21 06:27:26'),
(62, 69, 0, 16, 'MTCN', 'Страна', 'Имя', '44', 'EUR', 'test@.mail.ru', '2014-10-21 07:03:14'),
(67, 58, 0, 16, 'yrt', 'tr', 'rtu', '555', 'FS', 'hjkhjk', '2014-10-21 07:04:50');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newstext` text NOT NULL,
  `datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `newstext`, `datecreate`) VALUES
(8, 'Новость Для юзеров', '2014-10-17 14:18:05'),
(9, 'Проверка новостей', '2014-10-19 09:58:13'),
(10, 'To get your domain up and running fast it is critical that you log into your domain registrar and change the name-servers to point to the Bitcoinwebhosting servers. Your name-servers are listed below in this email. Please keep in mind that your domain name will not be visible on the internet for between 12 and 48 hours. This process is called Propagation. Until your domain has Propagated your website and email will not function, we have provided a temporary url which you may use to view your website and upload files in the meantime.\r\nBelow are your account details, you will need your username and password to access ftp and your control panel.', '2014-10-19 13:35:06'),
(11, 'Новость!\r\nTo get your domain up and running fast it is critical that you log into your domain registrar and change the name-servers to point to the Bitcoinwebhosting servers. Your name-servers are listed below in this email. Please keep in mind that your domain name will not be visible on the internet for between 12 and 48 hours.', '2014-10-19 13:41:21'),
(12, '&lt;h1&gt;Обновление дизайна!&lt;/h1&gt;\r\nPropagated your website and email will not function, we have provided a temporary url which you may use to view your website and upload files in the meantime.', '2014-10-19 13:41:56'),
(13, '&lt;h1&gt;Обновление дизайна!&lt;/h1&gt;\r\nPropagated your website and email will not function, we have provided a temporary url which you may use to view your website and upload files in the meantime.', '2014-10-19 13:44:57'),
(14, 'The management of your email addresses is performed in your web hosting control panel under the Email Menu. The URL to login to The Hosting Control Panel can be found in this Welcome Email.', '2014-10-19 13:48:07'),
(15, 'The management of your email addresses is performed in your web hosting control panel under the Email Menu. The URL to login to The Hosting Control Panel can be found in this Welcome Email.', '2014-10-19 13:53:29'),
(16, 'Новость тут!', '2014-10-20 10:32:43'),
(17, 'Тест новости 1', '2014-10-20 10:33:25'),
(18, 'ыавпвапв', '2014-10-20 10:38:10'),
(19, 'Новость 2', '2014-10-20 10:47:45'),
(20, 'Новость 3', '2014-10-20 10:47:48'),
(21, 'Новость 4', '2014-10-20 10:47:52'),
(22, 'Новость 5', '2014-10-20 10:47:55'),
(23, 'Новость 6', '2014-10-20 10:47:59'),
(24, 'Новость 7', '2014-10-20 10:48:03');

-- --------------------------------------------------------

--
-- Структура таблицы `newsusers`
--

CREATE TABLE IF NOT EXISTS `newsusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idnews` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

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
(12, 20, 8),
(13, 16, 8),
(14, 16, 9),
(15, 16, 10),
(16, 16, 12),
(17, 16, 13),
(18, 16, 11),
(19, 16, 14),
(20, 16, 15),
(21, 20, 12),
(22, 20, 13),
(23, 20, 14),
(24, 20, 15),
(25, 20, 10),
(26, 22, 10),
(27, 22, 15),
(28, 22, 14),
(29, 22, 12),
(30, 22, 13),
(31, 23, 12),
(32, 23, 13),
(33, 23, 14),
(34, 23, 15),
(35, 23, 10),
(36, 23, 12),
(37, 23, 13),
(38, 23, 14),
(39, 23, 15),
(40, 23, 10),
(41, 23, 8),
(42, 23, 9),
(43, 23, 11),
(44, 23, 16),
(45, 23, 17),
(46, 23, 18),
(47, 23, 19),
(48, 23, 20),
(49, 23, 21),
(50, 23, 22),
(51, 23, 23),
(52, 23, 24),
(53, 16, 16),
(54, 16, 17),
(55, 20, 9),
(56, 20, 11),
(57, 20, 16),
(58, 20, 17),
(59, 20, 18),
(60, 20, 19),
(61, 20, 20),
(62, 20, 21),
(63, 20, 21),
(64, 20, 21),
(65, 20, 22),
(66, 20, 23),
(67, 20, 24),
(68, 16, 18),
(69, 16, 20),
(70, 16, 21),
(71, 16, 21),
(72, 16, 21),
(73, 16, 21),
(74, 16, 21),
(75, 16, 21),
(76, 16, 21),
(77, 16, 21),
(78, 16, 21),
(79, 16, 22),
(80, 16, 19),
(81, 16, 23),
(82, 16, 24);

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
('b28a1f9e36219fbc7e4071aa9e60d812', 1414318386, 16),
('79374baf80e32dff31a47eaa5299eb23', 1414317458, 2),
('f1bfddbe90d224451600175bf2936881', 1414494154, 2),
('2f95eabb55d7f1b01cd95e4bce54cf3e', 1414317263, 23),
('73ebec2275c47af887a5b294cf446d96', 1414426657, 2),
('3f5988c1e49702846138061c8c76756c', 1414476458, 2),
('a6e62deabc360a551190dc96c5e442c8', 1414483071, 2),
('3dbc95a75d082c123bb0961604090e6c', 1414356309, 16),
('fa2bacb48929edad2a53b87189abc291', 1414349502, 2),
('8a04b87cc388875f64e55e0a2ecbb2fb', 1414350700, 2),
('76cb6e897e996a53d2d5f2c61fe937b4', 1414356025, 2),
('12f715ca6508768429c6445bf18df631', 1414356035, 2),
('75009675a575d93cf3ced8f50281b8ff', 1414356085, 2),
('dc01b054545cf6a0d896bf5c7a4f2f66', 1414356103, 2),
('2f112ce54c7665c0afdd305a5b556987', 1414356107, 2),
('fa7fc694c2b5c0d3e4408e40dc7263cf', 1414356122, 2),
('08ba3181d8db57cd2f4937bc05075ee4', 1414492320, 2),
('ca58191cc57c1bdbc0d1b744586e21e7', 1414476464, 2),
('e88a86d81a0f80fec60d9cde3971c096', 1414476623, 2);

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
(1, '');

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
(1, 0, 0, 0, 0, '2014-10-21 08:03:29', '2014-10-21 08:03:29', '2014-10-21 08:03:29');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `cdate`, `fromid`, `toid`, `text`, `new`) VALUES
(1, '2014-10-20 06:48:37', 16, 0, '123', 0),
(2, '2014-10-20 06:48:42', 16, 0, '456', 0),
(3, '2014-10-20 06:48:46', 16, 0, '789', 0),
(4, '2014-10-20 06:49:00', 0, 16, '10 11 12 13', 0),
(5, '2014-10-20 06:49:05', 0, 16, '14 15 16', 0),
(6, '2014-10-20 06:49:23', 20, 0, '20 21 22 23', 0),
(7, '2014-10-20 06:49:36', 0, 20, '24 25 26 27', 0),
(8, '2014-10-20 06:49:50', 0, 16, '17 18 19', 0),
(9, '2014-10-20 06:52:39', 0, 16, '111 112 113', 0),
(10, '2014-10-20 06:53:10', 0, 16, '14 15 16', 0),
(11, '2014-10-20 06:53:17', 0, 16, '17 18 19', 0),
(12, '2014-10-20 06:53:31', 16, 0, '20 21 22', 0),
(13, '2014-10-20 06:53:43', 0, 16, '23 24 25', 0),
(14, '2014-10-20 06:53:56', 20, 0, '28 29 30 31', 0),
(15, '2014-10-20 06:54:02', 20, 0, '32 33 34 35', 0),
(16, '2014-10-20 06:54:28', 0, 20, '36 37 38 39', 0),
(17, '2014-10-20 06:54:33', 0, 20, '40 41 42 43', 0),
(18, '2014-10-20 06:55:37', 20, 0, '44 45 456', 0),
(19, '2014-10-20 06:55:47', 0, 20, '12 14 15', 0),
(20, '2014-10-20 07:00:22', 0, 20, 'попро', 0),
(21, '2014-10-20 07:00:24', 0, 20, 'родрол', 0),
(22, '2014-10-20 07:00:26', 0, 20, 'поопр', 0),
(23, '2014-10-20 07:00:49', 0, 20, 'попоп', 0),
(24, '2014-10-20 07:00:51', 0, 20, 'прлпропрл', 0),
(25, '2014-10-20 07:01:05', 16, 0, 'пропопро', 0),
(26, '2014-10-20 07:01:15', 22, 0, 'олдод', 0),
(27, '2014-10-20 07:01:34', 0, 22, 'енк рап рапрап', 0),
(28, '2014-10-20 10:21:15', 0, 22, 'йцу', 0),
(29, '2014-10-20 10:21:19', 0, 22, '12', 0),
(30, '2014-10-20 10:21:23', 0, 22, 'пропо', 0),
(31, '2014-10-20 10:21:30', 0, 16, 'фыв', 0),
(32, '2014-10-20 10:22:03', 0, 22, '3', 0),
(33, '2014-10-20 11:03:07', 0, 0, '4', 1),
(34, '2014-10-20 11:03:10', 0, 0, '5', 1),
(35, '2014-10-20 11:03:47', 20, 0, '456789', 1),
(36, '2014-10-20 11:03:50', 20, 0, '7258', 1),
(37, '2014-10-20 11:05:45', 20, 0, '456789', 1),
(38, '2014-10-20 11:09:01', 20, 0, 'ваыва', 1),
(39, '2014-10-20 11:16:07', 20, 0, '789', 1),
(40, '2014-10-20 11:16:20', 0, 0, '789', 1),
(41, '2014-10-20 17:42:49', 0, 0, 'hdgdg', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `reg_date`, `nickname`, `password`, `group`) VALUES
(2, '2014-09-14 14:26:20', 'qwe', '7b0dd919dbcbfd6b0f75089d364b114c', 1),
(16, '2014-10-16 08:19:24', 'user', '1ed634f69326cb28aa2b0bc5cd398bc3', 3),
(10, '2014-10-11 15:56:01', 'aeq', '2cea3f9e8e685c9930bc92db60e3fca6', 2),
(27, '2014-10-20 11:34:38', 'admin', '953bc9ce9dbb2faf97a5634947d83c2a', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
