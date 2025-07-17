-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 17 2025 г., 10:25
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gameresults`
--

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `nick` text NOT NULL,
  `score` int(11) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`id`, `nick`, `score`, `date`, `time`) VALUES
(1, 'zetronix', 40, '27.10.2018', '18:12:04'),
(2, 'Player', 200, '27.10.2018', '18:14:51'),
(3, '324324', 200, '10.11.2018', '20:50:46'),
(4, 'ВЛАДКА', 200, '23.06.2019', '4:57:20'),
(5, 'o4Metkiy', 10, '26.08.2019', '17:00:33'),
(6, 'Player468513', 110, '12.05.2022', '23:35:45'),
(7, 'VanyaGamer5k', 120, '17.10.2022', '19:41:50'),
(8, 'Player', 150, '17.07.2025', '11:16:23'),
(9, 'terter', 200, '17.07.2025', '11:20:43'),
(10, 'Player56', 50, '17.07.2025', '11:20:58'),
(11, 'Player1', 20, '17.07.2025', '11:24:06'),
(12, '12', 20, '17.07.2025', '11:24:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
