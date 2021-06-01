-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 01 2021 г., 13:16
-- Версия сервера: 10.4.19-MariaDB
-- Версия PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `comment_text` text COLLATE utf8mb4_polish_ci NOT NULL,
  `commenter_name` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `commenter_surname` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`comment_id`, `project_id`, `comment_text`, `commenter_name`, `commenter_surname`) VALUES
(1, 1, 'New comment!', 'Illia', 'Kononenko'),
(2, 1, 'New comment!', 'Illia', 'Kononenko'),
(3, 0, '', 'test', 'test'),
(4, 1, 'yrdy', 'test', 'test'),
(5, 1, 'tessssst', 'test', 'test'),
(6, 1, 'New comment here', 'test', 'test'),
(7, 2, 'And new comment there) ', 'test', 'test'),
(8, 1, 'Nowy komentarz', 'adam', 'mickiewicz'),
(9, 1, 'test new adam', 'test', 'asda'),
(10, 2, 'tstaa ', 'test', 'asda'),
(11, 2, 'xcsdfsdf', 'aSSDF', 'asdasd');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `name` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`name`, `surname`, `login`, `password`, `user_id`) VALUES
('adam', 'mickiewicz', 'Adam1', '$2y$10$gWv7s8P8BvYFMTHIpUOVUeeQtbcKW5FK4tWoWfVf.byy3URb./42y', 18),
('test', 'asda', 'Adam3', '$2y$10$0BJJwEvY0n/kFJEYms.vD.eVznRYLsOhAft6w5Q6uZ6zzr/.I23Vi', 19),
('aSSDF', 'asdasd', 'Test123', '$2y$10$/iRBQtvd2ukZB4Z0UZ3ejOgmbqpXKHjJj9sYRA6.vPb6eyCoaiP2q', 20);

-- --------------------------------------------------------

--
-- Структура таблицы `visitors`
--

CREATE TABLE `visitors` (
  `visitor_id` int(11) NOT NULL,
  `visitor_ip` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `visitor_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visit_num` int(12) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Дамп данных таблицы `visitors`
--

INSERT INTO `visitors` (`visitor_id`, `visitor_ip`, `visitor_time`, `visit_num`) VALUES
(3, '::1', '2021-05-28 08:55:06', 25),
(4, '1231', '2021-05-20 15:31:09', 1),
(5, '1231', '2021-05-20 15:31:16', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- Индексы таблицы `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
