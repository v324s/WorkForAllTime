-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 18 2025 г., 08:14
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
-- База данных: `imt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `fio` tinytext NOT NULL,
  `tel` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `gorod` tinytext NOT NULL,
  `address` tinytext NOT NULL,
  `cart` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `date`, `fio`, `tel`, `email`, `gorod`, `address`, `cart`) VALUES
(1, '2017-10-01', 'Маркелова Светлана Алексеевна', '+79123456789', 'kioy2@gmail.com', 'Ульяновск', 'Ул.Кутузова, д.258, кв.501', '6|2|4'),
(2, '2017-10-12', 'Гоголев Сергей Петрович', '+79785586758', 'eshkere1@mail.ru', 'Ульяновск', 'ул.Степкина, д.99, кв.228', '6|2|4'),
(3, '2017-12-03', 'Ручков Алик Пестронов', '+79004578585', 'etrg1@u.ru', 'Ульяновск', 'ул.Греческая, д.148, кв.488', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `section` tinytext NOT NULL,
  `link` tinytext NOT NULL,
  `img` tinytext NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `section`, `link`, `img`, `price`) VALUES
(1, 'Apple iPhone 7 Plus 128Gb', 'Смартфон', '<a href=s1.php>s1.php</a>', '<img src=s1.jpg weight=150 height=150>', 75990),
(2, 'Microsoft Lumia 650', 'Смартфон', '<a href=s2.php>s2.php</a>', '<img src=s2.jpg weight=150 height=150>', 4990),
(3, 'Meizu M5 Note 32Gb', 'Смартфон', '<a href=s3.php>s3.php</a>', '<img src=s3.jpg weight=150 height=150>', 18990),
(4, 'LG X Power K220DS', 'Смартфон', '<a href=s4.php>s4.php</a>', '<img src=s4.jpg weight=150 height=150>', 12990),
(5, 'Lenovo Vibe S1', 'Смартфон', '<a href=s5.php>s5.php</a>', '<img src=s5.jpg weight=150 height=150>', 11990),
(6, 'Nokia 3310 (2017)', 'Телефон', '<a href=k1.php>k1.php</a>', '<img src=k1.jpg weight=150 height=150>', 4990),
(7, 'Philips Xenium E570', 'Телефон', '<a href=k2.php>k2.php</a>', '<img src=k2.jpg weight=150 height=150>', 4150),
(8, 'KENEKSI X9', 'Телефон', '<a href=k3.php>k3.php</a>', '<img src=k3.jpg weight=150 height=150>', 1999),
(9, 'Alcatel 2051D', 'Телефон', '<a href=k4.php>k4.php</a>', '<img src=k4.jpg weight=150 height=150>', 2580),
(10, 'Fly TS112', 'Телефон', '<a href=k5.php>k5.php</a>', '<img src=k5.jpg weight=150 height=150>', 1780);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
