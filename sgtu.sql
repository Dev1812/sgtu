-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 16 2016 г., 19:21
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sgtu`
--

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `owner_id` int(9) NOT NULL,
  `title` varchar(32) NOT NULL,
  `photo_counter` int(5) NOT NULL DEFAULT '0',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cover` varchar(51) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `albums`
--

INSERT INTO `albums` (`id`, `owner_id`, `title`, `photo_counter`, `date_creation`, `cover`) VALUES
(1, 1, 'Университет', 1, '2016-10-16 15:53:02', '/files/s_hqqi19s1dsux18dj18.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `owner_id` int(9) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `forum_messages`
--

CREATE TABLE IF NOT EXISTS `forum_messages` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `owner_id` int(9) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `room_id` int(4) NOT NULL,
  `text` varchar(67) NOT NULL,
  `attachments` varchar(279) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `forum_rooms`
--

CREATE TABLE IF NOT EXISTS `forum_rooms` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `owner_id` int(9) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` int(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `owner_id` int(9) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(81) NOT NULL,
  `text` text NOT NULL,
  `attachments` varchar(279) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `owner_id`, `date_created`, `title`, `text`, `attachments`) VALUES
(1, 1, '2016-10-16 15:40:37', 'Поздравление ректора СГТУ им. Гагарина Ю.А. Игоря Плеве с Днем знаний', 'От руководства технического университета и себя лично поздравляю вас с Днем знаний!\n\nПо традиции в этот день особо хочу обратиться к первокурсникам. Вам повезло дважды. Во-первых, потому что вы учитесь и взрослеете в ту пору, когда все делается для вас: обновляется, становится удобнее для жизни наш город Саратов, готовится первый фестиваль первокурсников «Поехали!», полноправными участниками которого вы сможете стать уже 4 сентября. Во-вторых, вуз не отстает от города и в скором времени подарит вам обновленный удобный стадион и самую современную библиотеку в области. Кроме того, для вас – всегда лучшие традиции технической научной школы и незамедлительно вводимые в работу достижения современности в области образования. Помните, что преподаватель, куратор, декан – каждый друг для вас, каждый работает для того, чтоб вы комфортно и качественно учились и всесторонне развивались.\n\nПриобретя определенные знания и навыки, обладая креативностью, которой, уверен, вам не занимать, к старшим курсам вы сможете быть соавторами проектов по развитию города, родного вуза, страны. К вашему мнению будут прислушиваться, ваши идеи будут воплощать в жизнь. Поздравляю вас с правильным выбором!\n\nЖелаю всем нам плодотворной работы! С праздником!\n\n\n', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo_path` varchar(51) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `owner_id`, `album_id`, `date_created`, `photo_path`) VALUES
(1, 1, 1, '2016-10-16 15:52:23', '/files/s_hqqi19s1dsux18dj18.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `questbook`
--

CREATE TABLE IF NOT EXISTS `questbook` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `owner_name` varchar(32) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` varchar(67) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `universities`
--

CREATE TABLE IF NOT EXISTS `universities` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(41) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(9) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(31) NOT NULL,
  `lastname` varchar(35) NOT NULL,
  `email` varchar(51) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `birth_date` timestamp NULL DEFAULT NULL,
  `hashed_password` varchar(63) NOT NULL,
  `salt` varchar(21) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'ru',
  `small_photo` varchar(51) NOT NULL,
  `big_photo` varchar(51) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT '1' COMMENT '1)Обычный пользователь, 2) Администратор',
  `university` int(3) DEFAULT NULL,
  `university_direction` int(3) DEFAULT NULL,
  `university_course` int(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
