-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 04 2025 г., 14:34
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `participating`
--

-- --------------------------------------------------------

--
-- Структура таблицы `participants`
--

CREATE TABLE `participants` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `report_subject` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `participants`
--

INSERT INTO `participants` (`id`, `first_name`, `last_name`, `birthdate`, `report_subject`, `country`, `phone`, `email`, `company`, `position`, `about`, `photo`) VALUES
(15, 'Oleksii', 'Borzenko', '2024-03-15', 'Report', 'Ukraine', '+380999999999', 'borzenko.alexey11@gmail.com', '', '', '', 'uploads/richard-horvath-RAZU_R66vUc-unsplash.jpg'),
(18, 'asdfsadfasd', 'sdffafdsf', '2024-03-03', 'FINAL TEST', '', '+1(555)-555-5555', 'testting@gmail.com', '', '', 'NO', 'uploads/pawel-czerwinski-yn97LNy0bao-unsplash.jpg'),
(19, 'TEST', 'DB', '2024-03-03', 'asdfsadfasdf', 'Antarctica', '+1(555)-555-5555', 'afksadfasdf@gmail.com', '', '', '', NULL),
(20, 'NEW ', 'FINAL', '2024-03-03', 'DB TESTE', 'Bangladesh', '+1(555)-555-5555', 'newnenwnne@gmail.com', '', '', '', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
