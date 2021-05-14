-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 10 2021 г., 18:22
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `adkurs1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `aspects`
--

CREATE TABLE `aspects` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `aspects`
--

INSERT INTO `aspects` (`id`, `id_project`, `name`, `text`) VALUES
(1, 39, 'Аспект 1', ''),
(2, 1, 'admin 1', '');

-- --------------------------------------------------------

--
-- Структура таблицы `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `chapters`
--

INSERT INTO `chapters` (`id`, `id_project`, `name`, `number`) VALUES
(1, 39, 'Глава 1', 1),
(3, 39, 'Глава без номера', 0),
(6, 39, 'Глава 2', 2),
(7, 39, 'Глава 3', 3),
(9, 39, 'Глава 4', 4),
(10, 39, 'ыфарквепокп', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `id_users`, `name`, `text`) VALUES
(1, 3, 'Заметка 1', '<p><a href=\"https://www.google.com/search?q=mysqli_query+%D0%BE%D1%82%D1%87%D0%B5%D1%82&amp;rlz=1C1AVUA_enRU821RU945&amp;oq=mysqli_query+%D0%BE%D1%82%D1%87%D0%B5%D1%82&amp;aqs=chrome..69i57j33i160l3.2966j0j7&amp;sourceid=chrome&amp;ie=UTF-8\"><span style=\"background-color:#ffffff\">https://www.google.com/search?q=mysqli_query+%D0%BE%D1%82%D1%87%D0%B5%D1%82&amp;rlz=1C1AVUA_enRU821RU945&amp;oq=mysqli_query+%D0%BE%D1%82%D1%87%D0%B5%D1%82&amp;aqs=chrome..69i57j33i160l3.2966j0j7&amp;sourceid=chrome&amp;ie=UTF-8</span></a></p>\n\n<p>&nbsp;</p>\n');

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `id_users`, `name`) VALUES
(1, 1, 'Проект1'),
(2, 1, 'Проект2'),
(3, 1, 'Проект3'),
(39, 3, 'Проект 1');

-- --------------------------------------------------------

--
-- Структура таблицы `scenes`
--

CREATE TABLE `scenes` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_chapters` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL DEFAULT 0,
  `discription` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `scenes`
--

INSERT INTO `scenes` (`id`, `id_project`, `id_chapters`, `name`, `number`, `discription`, `text`) VALUES
(1, 39, 1, 'Сцена 1', 1, 'Таким образом реализация намеченных плановых заданий позволяет оценить значение новых предложений. Идейные соображения высшего порядка, а также начало повседневной работы по формированию позиции ', ''),
(2, 39, NULL, 'Сцена вне главы', 0, 'кне ыдгаргшыв ыпшн ып гпры ы ы7п ашгрыщшпшгщыв пгшывап а8п 9нп8вына7п выапг 9п8нвыа7п рыав98пн у9пн 87ывнп98 щвы98пнщ 9', ''),
(3, 39, 1, 'Сцена для главы 1, без номера', 0, 'sdhbdhbdg th dgh dfh  hdfh rjhyjrj reyj reyj ryj ryj rj ryj ry jry ', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `id_project`, `name`, `color`) VALUES
(2, 39, 'Тег 2', 'rgb(48, 78, 254)'),
(4, 39, 'Тег 3', 'rgb(178, 156, 218)'),
(5, 39, 'Тег 3', 'rgb(178, 156, 218)'),
(6, 39, 'Тег 4', 'rgb(120, 84, 70)'),
(7, 39, 'Тег 5', 'rgb(48, 78, 254)'),
(8, 39, 'Тег 6', 'rgb(105, 26, 153)'),
(9, 39, 'Тег 6', 'rgb(120, 84, 70)'),
(10, 39, 'Тег 6', 'rgb(46, 124, 49)'),
(12, 39, 'Тег 65', 'rgb(48, 78, 254)'),
(14, 39, 'Тег 6', 'rgb(233, 29, 98)'),
(15, 39, 'Тег 6', 'rgb(0, 230, 255)'),
(38, 39, 'Тег 6', 'rgb(48, 78, 254)'),
(40, 1, 'Тег проекта', 'rgb(120, 84, 70)'),
(41, 39, 'Тег 4', 'rgb(48, 78, 254)');

-- --------------------------------------------------------

--
-- Структура таблицы `tag_aspects`
--

CREATE TABLE `tag_aspects` (
  `id` int(11) NOT NULL,
  `id_aspects` int(11) NOT NULL,
  `id_tags` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tag_aspects`
--

INSERT INTO `tag_aspects` (`id`, `id_aspects`, `id_tags`) VALUES
(73, 1, 6),
(58, 1, 10),
(69, 2, 40);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin', '1'),
(3, 'ad', 'ad@ad', '1'),
(4, 'ad', 'ad1@ad', '1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `aspects`
--
ALTER TABLE `aspects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project` (`id_project`);

--
-- Индексы таблицы `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project` (`id_project`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Индексы таблицы `scenes`
--
ALTER TABLE `scenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project` (`id_project`,`id_chapters`),
  ADD KEY `id_chapters` (`id_chapters`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project` (`id_project`);

--
-- Индексы таблицы `tag_aspects`
--
ALTER TABLE `tag_aspects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aspects` (`id_aspects`,`id_tags`),
  ADD KEY `id_tags` (`id_tags`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `aspects`
--
ALTER TABLE `aspects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `scenes`
--
ALTER TABLE `scenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `tag_aspects`
--
ALTER TABLE `tag_aspects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `aspects`
--
ALTER TABLE `aspects`
  ADD CONSTRAINT `aspects_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `scenes`
--
ALTER TABLE `scenes`
  ADD CONSTRAINT `scenes_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scenes_ibfk_2` FOREIGN KEY (`id_chapters`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tag_aspects`
--
ALTER TABLE `tag_aspects`
  ADD CONSTRAINT `tag_aspects_ibfk_1` FOREIGN KEY (`id_aspects`) REFERENCES `aspects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_aspects_ibfk_2` FOREIGN KEY (`id_tags`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
