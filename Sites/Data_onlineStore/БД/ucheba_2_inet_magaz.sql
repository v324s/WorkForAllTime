-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 02 2022 г., 14:43
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ucheba_2_inet_magaz`
--
CREATE DATABASE IF NOT EXISTS `ucheba_2_inet_magaz` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ucheba_2_inet_magaz`;

-- --------------------------------------------------------

--
-- Структура таблицы `cart_users`
--

DROP TABLE IF EXISTS `cart_users`;
CREATE TABLE `cart_users` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_size` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `cart_users`
--

INSERT INTO `cart_users` (`id`, `id_user`, `id_product`, `id_size`, `id_color`, `count`) VALUES
(1, 8, 3, 14, 3, 1),
(2, 8, 3, 8, 1, 1),
(3, 1, 1, 13, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Футболки'),
(2, 'Шорты'),
(3, 'Куртки'),
(4, 'Носки'),
(5, 'Толстовки'),
(6, 'Штаны'),
(8, 'Рубашки'),
(9, 'Джинсы'),
(10, 'Шапки'),
(11, 'Перчатки'),
(15, 'Обувь');

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(1, 'Черный'),
(2, 'Белый'),
(3, 'Серый'),
(4, 'Красный'),
(6, 'Оранжевый'),
(7, 'Синий'),
(8, 'Голубой');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_size` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price_for_one` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `address` text NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `id_product`, `id_size`, `id_color`, `count`, `price_for_one`, `price`, `address`, `status`) VALUES
(1, 1, 3, 15, 3, 1, 1999, 1999, '433213, г.Ульяновск, ул. Чекалова, д.23', 'Доставлен'),
(2, 8, 1, 25, 2, 2, 4980, 9960, '412344, Г. Новосибирск, Ул. Кузнецова, д.213, кв. 321', 'В пути'),
(3, 7, 3, 17, 8, 1, 1000, 1000, '412344, Ульяновская обл., г.Димитровград, ул. Победы 145, кв. 432', 'Собирается'),
(4, 8, 3, 8, 6, 1, 1690, 1690, '412344, Г. Новосибирск, Ул. Кузнецова, д.213, кв. 321', 'Доставлен');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_subcategory` int(11) DEFAULT NULL,
  `id_size` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `id_category`, `id_subcategory`, `id_size`, `id_color`, `name`, `description`, `price`, `discount`, `count`) VALUES
(1, 3, 1, 13, 3, 'Куртка Infashion', 'Для осени самое то!', 8000, 25, 100),
(3, 15, 16, 11, 1, 'Кросовки Nike', 'Спортивные кросовки', 2500, 3, 250),
(4, 11, 10, 32, 3, 'Руковицы', 'Теплые для зимы', 600, 0, 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `sizes`
--

INSERT INTO `sizes` (`id`, `number`) VALUES
(1, 34),
(2, 35),
(3, 36),
(4, 37),
(5, 38),
(6, 39),
(7, 40),
(8, 41),
(9, 42),
(10, 43),
(11, 44),
(12, 45),
(13, 46),
(14, 47),
(15, 48),
(16, 49),
(17, 50),
(18, 51),
(19, 52),
(20, 53),
(21, 54),
(22, 55),
(23, 56),
(25, 57),
(26, 1),
(27, 2),
(28, 3),
(29, 4),
(30, 5),
(31, 6),
(32, 7),
(33, 8),
(34, 9),
(35, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `subcategory`
--

INSERT INTO `subcategory` (`id`, `id_category`, `name`) VALUES
(1, 3, 'Осенние'),
(2, 1, 'Поло'),
(3, 15, 'Зимняя'),
(4, 4, 'Гольфы'),
(5, 4, 'Чулки'),
(6, 4, 'Подследники'),
(9, 11, 'Резиновые'),
(10, 11, 'Зимние'),
(11, 6, 'Брюки'),
(12, 15, 'Кросовки'),
(13, 15, 'Ботинки зимние'),
(14, 15, 'Тапки'),
(15, 15, 'Сандали'),
(16, 15, 'Шлепки'),
(17, 6, 'Джогеры'),
(18, 6, 'Шорты');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` tinytext NOT NULL,
  `last_name` tinytext NOT NULL,
  `dob` date NOT NULL,
  `sex` tinytext NOT NULL,
  `telephone` tinytext NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `dob`, `sex`, `telephone`, `address`) VALUES
(1, 'Игорь', 'Орлов', '1999-12-12', 'Мужской', '+79021234567', '433512, Ульяновская обл., г. Димитровград, ул. Строителей, д. 34, кв. 112'),
(7, 'Алексей', 'Иванов', '2001-03-05', 'Мужской', '+79233215321', '442344, г. Ульяновск, Менделеева, д.31'),
(8, 'Эмилия', 'Степанова', '2004-02-25', 'Женский', '+79055446428', '412344, г. Воронеж, Ул. Курчатова, д. 123, кв. 432');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart_users`
--
ALTER TABLE `cart_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_size` (`id_size`),
  ADD KEY `id_color` (`id_color`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_size` (`id_size`),
  ADD KEY `id_color` (`id_color`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_subcategory` (`id_subcategory`),
  ADD KEY `id_size` (`id_size`),
  ADD KEY `id_color` (`id_color`);

--
-- Индексы таблицы `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart_users`
--
ALTER TABLE `cart_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart_users`
--
ALTER TABLE `cart_users`
  ADD CONSTRAINT `cart_users_ibfk_1` FOREIGN KEY (`id_color`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `cart_users_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_users_ibfk_3` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id`),
  ADD CONSTRAINT `cart_users_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_color`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`id_subcategory`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
