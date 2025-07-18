-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 18 2025 г., 10:21
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
-- База данных: `imavto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fio` tinytext NOT NULL,
  `date` date NOT NULL,
  `tel` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `cart` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `fio`, `date`, `tel`, `email`, `cart`) VALUES
(1, 'Проверка Проверков Проверкович', '2017-10-01', '+71234567890', 'Proverka.2@ya.ru', '2|1|5');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `kateg` tinytext NOT NULL,
  `img` tinytext NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `kateg`, `img`, `price`) VALUES
(1, 'Зеленая светодиодная лента для подсветки днища', 'Подсветка днища', '1.jpg', 978),
(2, 'Синяя лента для подсветки четырех дисков', 'Подсветка колес', '2.jpg', 978),
(3, 'Хромированные накладки на фары Chevrolet Malibu 8 2012+', 'Накладки на фары', '3.jpg', 1353),
(4, 'Оплетка на руль черная перфорация, с иглой', 'Оплетка на руль', '4.jpg', 978),
(5, 'Ангельские глазки на Mitsubishi LANCER X', 'Ангельские глазки', '5.jpg', 2678),
(6, 'Светодиодные противотуманные фары с ангельскими глазками для AC Ace', 'Противотуманные фары', '6.jpg', 5151);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
