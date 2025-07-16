SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Структура таблицы `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `fname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `lname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `llname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `pass_number` int(11) NOT NULL,
  `pass_serial` int(11) NOT NULL,
  `dob` date NOT NULL,
  `pass_issued` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `pass_issued_date` date NOT NULL,
  `por` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



--
-- Структура таблицы `techins`
--

CREATE TABLE `techins` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `mileage` int(11) NOT NULL,
  `status` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `lname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `login` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `pass` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `can_people_select` tinyint(1) NOT NULL,
  `can_people_delete` tinyint(1) NOT NULL,
  `can_people_insert` tinyint(1) NOT NULL,
  `can_people_update` tinyint(1) NOT NULL,
  `can_techins_select` tinyint(1) NOT NULL,
  `can_techins_delete` tinyint(1) NOT NULL,
  `can_techins_insert` tinyint(1) NOT NULL,
  `can_techins_update` tinyint(1) NOT NULL,
  `can_vehicle_select` tinyint(1) NOT NULL,
  `can_vehicle_delete` tinyint(1) NOT NULL,
  `can_vehicle_insert` tinyint(1) NOT NULL,
  `can_vehicle_update` tinyint(1) NOT NULL,
  `can_users_select` tinyint(1) NOT NULL,
  `can_users_delete` tinyint(1) NOT NULL,
  `can_users_insert` tinyint(1) NOT NULL,
  `can_users_update` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `login`, `pass`, `can_people_select`, `can_people_delete`, `can_people_insert`, `can_people_update`, `can_techins_select`, `can_techins_delete`, `can_techins_insert`, `can_techins_update`, `can_vehicle_select`, `can_vehicle_delete`, `can_vehicle_insert`, `can_vehicle_update`, `can_users_select`, `can_users_delete`, `can_users_insert`, `can_users_update`) VALUES
(1, 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `make` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `model` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `type` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `state_number` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `number_engine` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `number_body` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `horsepower` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `techins`
--
ALTER TABLE `techins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `techins`
--
ALTER TABLE `techins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

