-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 03 2019 г., 14:25
-- Версия сервера: 5.6.38
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mingli`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone_number`) VALUES
(1, 'Вася', 'vasya@gmail.com', '9215552121'),
(2, 'Петя', 'petya@mail.ru', '9119995454'),
(5, 'ывафыва', 'petya@mail.ru', '9119995454'),
(8, 'Петя', 'vasya@gmail.com', '7898445644'),
(10, 'Петя', 'vasya@gmail.com', '78984456'),
(11, 'Кузя', 'kyza@ya.net', '9456456123'),
(12, '}asd', 'kyza@ya.net', '4215487121');

-- --------------------------------------------------------

--
-- Структура таблицы `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders_details`
--

INSERT INTO `orders_details` (`id`, `order_id`, `product_name`, `product_price`) VALUES
(1, 1, 'книга1', '11.99'),
(2, 1, 'яблоко', '5.99'),
(3, 2, 'стул', '22.11'),
(4, 0, 'фыв-123asd', '1.00'),
(5, 0, 'фыв-123asd', '1.00'),
(6, 0, 'фыв-123asd', '1.00'),
(7, 0, 'фыв-123asd', '1.00'),
(8, 0, 'фыв-123asd', '1.00'),
(9, 0, 'фыв-123asd', '1.00'),
(10, 0, 'фыв-123asd', '1.00'),
(11, 0, 'фыв-123asd', '1.00'),
(12, 0, 'фыв-123asd', '1.00'),
(13, 0, 'фыв-123asd', '1.00'),
(14, 0, 'фыв-123asd', '1.00'),
(15, 0, 'фыв-123asd', '1.00'),
(16, 0, 'фыв-123asd', '1.00'),
(17, 0, 'фыв-123asd', '1.00'),
(18, 0, 'фыв-123asd', '1.00'),
(19, 0, 'фыв-123asd', '1.00'),
(20, 0, 'фыв-123asd', '1.00'),
(21, 0, 'фыв-123asd', '1.00'),
(22, 0, 'фыв-123asd', '1.00'),
(23, 0, 'фыв-123asd', '1.00'),
(24, 0, 'фыв-123asd', '1.00'),
(25, 0, 'фыв-123asd', '1.00'),
(26, 0, 'фыв-123asd', '1.00'),
(27, 0, 'фыв-123asd', '1.00'),
(28, 0, 'фыв-123asd', '1.00'),
(29, 0, 'фыв-123asd', '1.00'),
(30, 0, 'фыв-123asd', '1.00'),
(31, 0, 'asfasd', '1.00'),
(32, 0, 'asfasd', '1.00'),
(33, 0, 'asfa', '1.00'),
(34, 0, 'asfa', '1.00'),
(35, 0, 'asfa', '1.00'),
(36, 0, 'asfa', '1.00'),
(37, 0, 'asfa', '1.00'),
(38, 0, 'asfa', '1.00'),
(39, 0, 'asfa', '1.00'),
(40, 0, 'asfa', '1234.00'),
(41, 0, 'qe', '2.00'),
(43, 1, 'кружка', '7.68'),
(45, 1, 'фыва', '12.00'),
(46, 2, 'sdf', '123.00'),
(47, 2, 'sdf', '123.00'),
(48, 1, 'asdf', '1.00'),
(50, 1, 'фыва', '33.47'),
(51, 1, 'asdf', '11.00'),
(53, 2, 'asdfdf', '12.00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
