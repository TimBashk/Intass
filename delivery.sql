-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 26 2021 г., 21:55
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
-- База данных: `delivery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `courier_tab`
--

CREATE TABLE `courier_tab` (
  `id` int(11) NOT NULL,
  `courier_fio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `courier_tab`
--

INSERT INTO `courier_tab` (`id`, `courier_fio`) VALUES
(1, 'Иванов Иван Иванович'),
(2, 'Сидоров Петр Петрович'),
(3, 'Прохоров Олег Петрович'),
(4, 'Евсеев Антон Игоревич'),
(5, 'Смирнов Сергей Сергеевич'),
(6, 'Говоров Виктор Павлович'),
(7, 'Званцев Олег Андреевич'),
(9, 'Кузьмичев Сергей Андреевич'),
(11, 'Сабурцев Кирилл Иванович');

-- --------------------------------------------------------

--
-- Структура таблицы `region_tab`
--

CREATE TABLE `region_tab` (
  `id` int(11) NOT NULL,
  `region_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travel_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `region_tab`
--

INSERT INTO `region_tab` (`id`, `region_name`, `travel_duration`) VALUES
(1, 'Санкт-Петербург', 1),
(2, 'Уфа', 2),
(3, 'Нижний Новгород', 1),
(4, 'Владимир', 1),
(5, 'Кострома', 1),
(6, 'Владимир', 1),
(7, 'Екатеринбург', 2),
(8, 'Ковров', 1),
(9, 'Воронеж', 1),
(10, 'Самара', 2),
(11, 'Астрахань', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `travel_schedule_tab`
--

CREATE TABLE `travel_schedule_tab` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `courier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `travel_schedule_tab`
--

INSERT INTO `travel_schedule_tab` (`id`, `region_id`, `departure_date`, `arrival_date`, `courier_id`) VALUES
(54, 1, '2021-02-01', '2021-02-02', 1),
(55, 1, '2021-02-04', '2021-02-05', 2),
(56, 2, '2021-02-03', '2021-02-05', 9),
(57, 1, '2021-02-12', '2021-02-13', 5),
(58, 1, '2021-02-02', '2021-02-03', 3),
(59, 2, '2019-07-18', '2019-07-20', 6),
(60, 2, '2019-07-18', '2019-07-20', 4),
(61, 2, '2019-07-08', '2019-07-10', 7),
(62, 1, '2020-06-11', '2020-06-12', 11);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `courier_tab`
--
ALTER TABLE `courier_tab`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `region_tab`
--
ALTER TABLE `region_tab`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `travel_schedule_tab`
--
ALTER TABLE `travel_schedule_tab`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `courier_tab`
--
ALTER TABLE `courier_tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `region_tab`
--
ALTER TABLE `region_tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `travel_schedule_tab`
--
ALTER TABLE `travel_schedule_tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
