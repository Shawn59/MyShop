-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 05 2018 г., 06:47
-- Версия сервера: 5.5.45
-- Версия PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `myBlog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `title`) VALUES
(1, 6, 'Моя жизнь, мои правила. Вот так то!!!'),
(2, 8, 'Измените вас статус');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `text` varchar(700) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`record_id`),
  KEY `record_id` (`record_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `record_id`, `text`, `user_id`) VALUES
(1, 12, 'dfd', 6),
(2, 12, 'gf', 6),
(3, 12, 'gf', 6),
(4, 12, 'sdf', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(3000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `records`
--

INSERT INTO `records` (`id`, `blog_id`, `title`, `text`) VALUES
(12, 1, 'dsfdsfsd', 'sdfsd'),
(13, 1, 'в', 'в'),
(14, 1, 'Гороскопы', 'Друзья, привет!\r\nВы верите в гороскопы?\r\nВот и я нет. Я вообще мало во что верю. Но одна девушка Ирина Светлая меня заинтересовала своим предложением составить гороскоп карьеры. Предложение было бесплатным для первых 5 участников, и я, конечно, решила быть в этой пятерке.\r\nЭто был очень интересный тренинг по выбору ниши, плюс для каждого участника Ирина составила гороскоп карьеры. Вы знаете, я была настолько удивлена результатом, потому что гороскоп просто на 96% описывал меня. Да, у меня сильно развито "Я сама всего добьюсь". Да, я часто бываю недовольна собой, мне кажется, что я все делаю не так. Да, карьера для меня много значит. Да, мне важно получить признание общественности. И многое многое другое.\r\nЭто было действительно интересно.\r\n\r\nЕще один положительный момент мероприятия был в том, что появилась возможность пообщаться с новыми людьми, так же как и я, строящими свое новое будущее. Я рассказала о своих идеях, получила обратную связь. И вынесла для себя нечто важное. Мне необязатель'),
(21, 2, 'fdgfd', 'gfdgdf'),
(22, 2, 'fdgdfhg', 'gfd');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fio` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `login`, `password`, `fio`) VALUES
(1, 1, 'admin', '123456', 'Админ Админов Админский'),
(6, 2, 'Shawn', 'b3a7f1b293e33cbb14de7f4f861fe585', 'Андрей'),
(7, 2, 'fgdfd', 'ad5f2dc853c92f12bd6e9d87aa396676', 'dsfds'),
(8, 2, 'daf', '7561f65ed74756ff8144496bb273f4b3', 'fffdfsfd');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
