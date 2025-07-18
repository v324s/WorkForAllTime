-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 18 2025 г., 07:34
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
-- Структура таблицы `resultsroad`
--

CREATE TABLE `resultsroad` (
  `id` int(11) NOT NULL,
  `nick` text NOT NULL,
  `score` int(11) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `resultsroad`
--

INSERT INTO `resultsroad` (`id`, `nick`, `score`, `date`, `time`) VALUES
(1, '23', 828, '10.02.2019', '14:44:37'),
(2, 'Player', 453, '10.02.2019', '15:02:51'),
(3, '23124124', 465, '10.02.2019', '15:03:52'),
(4, 'паавкнрек', 600, '10.02.2019', '15:05:38'),
(5, 'ерека', 639, '10.02.2019', '15:08:39'),
(6, 'Владводила', 11063, '23.06.2019', '4:58:48'),
(7, 'ezdok', 4781, '26.08.2019', '17:02:04'),
(8, 'Voditel', 6530, '26.08.2019', '17:03:53'),
(9, '5156', 7999, '11.08.2021', '6:04:24'),
(10, 'Player', 12148, '12.05.2022', '23:37:06'),
(11, 'VanyaGamer', 22550, '17.10.2022', '19:45:29'),
(12, 'Player12', 9100, '18.07.2025', '8:26:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `resultsroad`
--
ALTER TABLE `resultsroad`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `resultsroad`
--
ALTER TABLE `resultsroad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
