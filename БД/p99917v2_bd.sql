-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 06 2022 г., 09:49
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `p99917v2_bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cafe`
--
-- Создание: Окт 19 2021 г., 10:54
--

DROP TABLE IF EXISTS `cafe`;
CREATE TABLE `cafe` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `status` float NOT NULL,
  `address` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cafe`
--

INSERT INTO `cafe` (`id`, `login`, `status`, `address`) VALUES
(2, 'COFFEE PLACE', 5.5, 'Корпус Д, уровень 7'),
(3, 'PRYANIK', 4.5, 'Корпус Д, уровень 5'),
(4, 'Море', 4.5, 'Корпус Д, уровень 7');

-- --------------------------------------------------------

--
-- Структура таблицы `cafe_delete`
--
-- Создание: Окт 19 2021 г., 10:54
--

DROP TABLE IF EXISTS `cafe_delete`;
CREATE TABLE `cafe_delete` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `status` float NOT NULL,
  `address` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cafe_delete`
--

INSERT INTO `cafe_delete` (`id`, `login`, `status`, `address`) VALUES
(5, 'FIO (удалено)', 4.5, 'Корпус Д, уровень 7'),
(6, 'FIO (удалено)', 4, 'Корпус Д, уровень 7');

-- --------------------------------------------------------

--
-- Структура таблицы `cafe_products`
--
-- Создание: Окт 19 2021 г., 10:54
--

DROP TABLE IF EXISTS `cafe_products`;
CREATE TABLE `cafe_products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `cafe_id` int(11) UNSIGNED NOT NULL,
  `price` float NOT NULL,
  `description` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cafe_products`
--

INSERT INTO `cafe_products` (`id`, `name`, `cafe_id`, `price`, `description`) VALUES
(1, 'Салат', 4, 150, '150г'),
(2, 'Бургер', 4, 180, '200г'),
(3, 'Пицца', 4, 60, '100г'),
(4, 'Ролл', 4, 150, '200г'),
(5, 'Сок Добрый', 4, 70, '330мл'),
(6, 'Сок Pulpy', 4, 80, '500мл'),
(7, 'Американо', 4, 80, '200мл'),
(8, 'Раф', 4, 180, '300мл'),
(9, 'Какао', 4, 120, '300мл'),
(10, 'Эспрессо', 4, 70, '100мл'),
(11, 'Латте', 4, 170, '400мл'),
(12, 'Капучино', 4, 170, '400мл'),
(13, 'Coca-Cola', 4, 80, '500мл'),
(14, 'Fanta', 4, 80, '500мл'),
(15, 'Sprite', 4, 80, '500мл'),
(16, 'Чай Fuzetea', 4, 80, '500мл'),
(17, 'Вода', 4, 60, '500мл'),
(18, 'Вода', 4, 70, '500мл'),
(19, 'Американо', 2, 70, '200мл'),
(20, 'Раф', 2, 160, '300мл'),
(21, 'Какао', 2, 110, '300мл'),
(22, 'Эспрессо', 2, 80, '100мл'),
(23, 'Латте', 2, 160, '400мл'),
(24, 'Капучино', 2, 175, '400мл'),
(25, 'Coca-Cola', 2, 90, '500мл'),
(27, 'Sprite', 2, 90, '500мл'),
(28, 'Вода', 2, 65, '500мл'),
(29, 'Салат', 3, 140, '150г'),
(30, 'Бургер', 3, 160, '200г'),
(31, 'Пицца', 3, 70, '100г'),
(32, 'Ролл', 3, 160, '200г'),
(33, 'Сок Добрый', 3, 75, '330мл'),
(34, 'Сок Pulpy', 3, 85, '500мл'),
(35, 'Чай Fuzetea', 3, 70, '500мл'),
(36, 'Вода', 3, 65, '500мл'),
(37, 'Fanta', 2, 90, '500мл');

-- --------------------------------------------------------

--
-- Структура таблицы `cafe_products_delete`
--
-- Создание: Окт 19 2021 г., 10:54
--

DROP TABLE IF EXISTS `cafe_products_delete`;
CREATE TABLE `cafe_products_delete` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `cafe_id` int(11) UNSIGNED NOT NULL,
  `price` float NOT NULL,
  `description` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cafe_products_delete`
--

INSERT INTO `cafe_products_delete` (`id`, `name`, `cafe_id`, `price`, `description`) VALUES
(38, 'Fanta (удален)', 5, 90, '500мл'),
(39, 'Пицца (удален)', 5, 80, '100гр'),
(40, 'Fanta (удален)', 6, 90, '500мл'),
(41, 'Пицца (удален)', 6, 80, '100гр');

-- --------------------------------------------------------

--
-- Структура таблицы `cafe_users`
--
-- Создание: Окт 19 2021 г., 10:54
--

DROP TABLE IF EXISTS `cafe_users`;
CREATE TABLE `cafe_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `cafe_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cafe_users`
--

INSERT INTO `cafe_users` (`id`, `login`, `status`, `password`, `hash`, `cafe_id`) VALUES
(1, 'MORE_21', 'barista', 'MOREbarista_21', '', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--
-- Создание: Окт 19 2021 г., 10:54
--

DROP TABLE IF EXISTS `product_order`;
CREATE TABLE `product_order` (
  `id` int(11) UNSIGNED NOT NULL,
  `amount` int(5) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `user` varchar(30) NOT NULL,
  `cafe` int(11) UNSIGNED NOT NULL,
  `status` varchar(30) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `amount`, `time`, `date`, `user`, `cafe`, `status`, `content`) VALUES
(4, 350, '20:33:00', '2021-09-01', 'liyatest', 4, 'отказ', '{\"1\":1,\"3\":1,\"5\":2}'),
(6, 300, '20:36:00', '2021-09-01', 'liyatest', 4, 'выдано', '{\"4\":2}'),
(7, 385, '20:37:00', '2021-09-01', 'liyatest', 2, 'выдано', '{\"20\":2,\"28\":1}'),
(16, 365, '22:45:00', '2021-09-16', 'Liya', 3, 'принято', '{\"29\":2,\"34\":1}'),
(17, 420, '18:29:00', '2021-09-17', 'admin', 6, 'отправлено', '{\"40\":2,\"41\":3}'),
(18, 70, '22:25:00', '2021-09-17', 'admin', 2, 'отправлено', '{\"19\":1}'),
(19, 380, '19:13:00', '2021-09-17', 'admin', 2, 'отправлено', '{\"20\":1,\"21\":2}'),
(20, 650, '17:15:00', '2021-09-19', 'Liya', 3, 'отправлено', '{\"30\":2,\"34\":2,\"32\":1}'),
(21, 540, '10:23:00', '2021-09-22', 'admin', 4, 'выдано', '{\"2\":3}'),
(22, 200, '23:32:00', '2021-10-13', 'liyatest', 4, 'выдано', '{\"3\":2,\"6\":1}'),
(23, 140, '20:59:00', '2021-10-19', 'admin', 2, 'выдано', '{\"19\":2}'),
(27, 650, '17:30:00', '2021-12-08', 'LiyaStepanova', 4, 'отправлено', '{\"1\":3,\"3\":2,\"15\":1}');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--
-- Создание: Окт 19 2021 г., 10:54
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `FIO` varchar(50) NOT NULL,
  `number` varchar(11) NOT NULL,
  `role` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `hash`, `FIO`, `number`, `role`) VALUES
(1, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', NULL, 'Админ', '88112233445', 'admin'),
(2, 'liyatest', '0d6fea0940239832a16baf7c6253aeda', NULL, 'Степанова Лилия', '81122334455', NULL),
(3, 'Liya', '7b6707b68bddbfca874fd47a20cc4f30', NULL, 'Степанова Лилия Станиславовна', '89991744304', NULL),
(4, 'LiyaStepanova', '7b6707b68bddbfca874fd47a20cc4f30', NULL, 'Степанова Лилия Станиставовна', '88112233445', 'user'),
(5, 'PavelK', 'd9b1d7db4cd6e70935368a1efb10e377', NULL, 'Павел К', '12345678910', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cafe`
--
ALTER TABLE `cafe`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cafe_delete`
--
ALTER TABLE `cafe_delete`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cafe_products`
--
ALTER TABLE `cafe_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cafe_id` (`cafe_id`);

--
-- Индексы таблицы `cafe_products_delete`
--
ALTER TABLE `cafe_products_delete`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cafe_users`
--
ALTER TABLE `cafe_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cafe_id` (`cafe_id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_cafe` (`cafe`),
  ADD KEY `order_user` (`user`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cafe`
--
ALTER TABLE `cafe`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `cafe_products`
--
ALTER TABLE `cafe_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `cafe_users`
--
ALTER TABLE `cafe_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
