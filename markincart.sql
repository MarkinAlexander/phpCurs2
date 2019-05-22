-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 22 2019 г., 11:29
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `markincart`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `data_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `cart_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `data_created`, `cart_status`) VALUES
(1, 0, '2019-04-23 21:08:14', 0),
(2, 0, '2019-04-24 00:19:35', 0),
(3, 0, '2019-04-24 02:13:14', 0),
(4, 8, '2019-04-29 16:23:32', 0),
(5, 9, '2019-04-30 14:52:16', 0),
(6, 10, '2019-04-30 18:57:05', 1),
(7, 1, '2019-04-30 19:36:12', 1),
(8, 1, '2019-05-15 13:54:26', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(10) UNSIGNED NOT NULL,
  `good_id` int(10) UNSIGNED NOT NULL,
  `good_count` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `good_sum` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `carts`
--

INSERT INTO `carts` (`cart_id`, `good_id`, `good_count`, `good_sum`) VALUES
(1, 3, 1, 300),
(1, 4, 1, 655),
(1, 5, 1, 399),
(1, 6, 1, 290),
(3, 3, 1, 300),
(3, 6, 1, 290),
(4, 3, 1, 300),
(4, 4, 1, 655),
(4, 5, 1, 399),
(4, 6, 1, 290),
(5, 3, 1, 300),
(5, 4, 1, 655),
(5, 5, 1, 399),
(5, 6, 1, 290),
(6, 3, 1, 300),
(6, 5, 1, 399),
(7, 3, 1, 300),
(7, 4, 1, 655),
(7, 5, 1, 399),
(7, 6, 1, 290);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_title` varchar(255) NOT NULL,
  `categoru_cpu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `category_title`, `categoru_cpu`) VALUES
(1, 'Ð¡ÑƒÑˆÐ¸', 'sushi'),
(2, 'ÐŸÐ¸Ñ†Ñ†Ð°', 'picca'),
(3, 'Ð Ð¾Ð»Ñ‹', 'roly'),
(4, 'ÐÐ°Ð¿Ð¸Ñ‚ÐºÐ¸', 'napitki'),
(5, 'Ð¡Ñ‚ÐµÐ¹ÐºÐ¸', 'stejki');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `good_id` int(10) UNSIGNED NOT NULL,
  `good_title` varchar(255) NOT NULL,
  `good_short_desc` varchar(255) NOT NULL,
  `good_full_desc` text NOT NULL,
  `good_price` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `storage_count` int(10) UNSIGNED NOT NULL,
  `views_count` int(10) DEFAULT '0',
  `image_name` varchar(255) DEFAULT NULL,
  `good_cpu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`good_id`, `good_title`, `good_short_desc`, `good_full_desc`, `good_price`, `category_id`, `storage_count`, `views_count`, `image_name`, `good_cpu`) VALUES
(3, 'Ð¤Ð¸Ð»Ð°Ð´ÐµÐ»ÑŒÑ„Ð¸Ñ', 'Ð¡ÑƒÐ¿ÐµÑ€ Ð¿Ð¾Ð¿ÑƒÐ»ÑÑ€Ð½Ñ‹Ðµ ÑÑƒÑˆÐ¸ Ñ Ð¼ÑÐ³ÐºÐ¸Ð¼ ÑÑ‹Ñ€Ð¾Ð¼', 'Ð¾Ð¿Ð¸ÑÐ°Ð½Ð¸ 1', 300, 1, 0, 0, 'filadelfiya.jpeg', 'filadelfiya'),
(4, 'ÐœÐ°Ñ€Ð³Ð°Ñ€Ð¸Ñ‚Ð°', 'ÐŸÐ¸Ñ†Ñ†Ð° ÐœÐ°Ñ€Ð³Ð°Ñ€Ð¸Ñ‚Ð° - ÑÑ‚Ð¾ Ñ‚Ð¸Ð¿Ð¸Ñ‡Ð½Ð°Ñ Ð½ÐµÐ°Ð¿Ð¾Ð»Ð¸Ñ‚Ð°Ð½ÑÐºÐ°Ñ Ð¿Ð¸Ñ†Ñ†Ð°,', 'ÐŸÐ¸Ñ†Ñ†Ð° ÐœÐ°Ñ€Ð³Ð°Ñ€Ð¸Ñ‚Ð° - ÑÑ‚Ð¾ Ñ‚Ð¸Ð¿Ð¸Ñ‡Ð½Ð°Ñ Ð½ÐµÐ°Ð¿Ð¾Ð»Ð¸Ñ‚Ð°Ð½ÑÐºÐ°Ñ Ð¿Ð¸Ñ†Ñ†Ð°, Ð¿Ñ€Ð¸Ð³Ð¾Ñ‚Ð¾Ð²Ð»ÐµÐ½Ð½Ð°Ñ Ð¸Ð· Ð¿Ð¾Ð¼Ð¸Ð´Ð¾Ñ€Ð¾Ð² Ð¡Ð°Ð½-ÐœÐ°Ñ€Ñ†Ð°Ð½Ð¾, Ð¼Ð¾Ñ†Ð°Ñ€ÐµÐ»Ð»Ñ‹ Ð¤Ð¸Ð¾Ñ€ Ð´Ð¸ Ð›Ð°Ñ‚Ñ‚Ðµ, ÑÐ²ÐµÐ¶ÐµÐ³Ð¾ Ð±Ð°Ð·Ð¸Ð»Ð¸ÐºÐ°, ÑÐ¾Ð»Ð¸ Ð¸ Ð¾Ð»Ð¸Ð²ÐºÐ¾Ð²Ð¾Ð³Ð¾ Ð¼Ð°ÑÐ»Ð° ÑÐºÑÑ‚Ñ€Ð°-ÐºÐ»Ð°ÑÑÐ°.', 655, 2, 0, 0, 'margarita.jpeg', 'margarita'),
(5, 'ÐšÐ°Ð»Ð¸Ñ„Ð¾Ñ€Ð½Ð¸Ñ', 'ÐšÐ°Ð»Ð¸Ñ„Ð¾Ñ€Ð½Ð¸Ñ - Ð¡Ð½ÐµÐ¶Ð½Ñ‹Ð¹ ÐºÑ€Ð°Ð±, Ð¸ÐºÑ€Ð° Ð¼Ð°ÑÐ°Ð³Ð¾, ÑÐ»Ð¸Ð²Ð¾Ñ‡Ð½Ñ‹Ð¹ ÑÑ‹Ñ€, Ð¾Ð³ÑƒÑ€ÐµÑ†, ÐºÑƒÐ½Ð¶ÑƒÑ‚.', 'ÐšÐ°Ð»Ð¸Ñ„Ð¾Ñ€Ð½Ð¸Ñ - Ð¡Ð½ÐµÐ¶Ð½Ñ‹Ð¹ ÐºÑ€Ð°Ð±, Ð¸ÐºÑ€Ð° Ð¼Ð°ÑÐ°Ð³Ð¾, ÑÐ»Ð¸Ð²Ð¾Ñ‡Ð½Ñ‹Ð¹ ÑÑ‹Ñ€, Ð¾Ð³ÑƒÑ€ÐµÑ†, ÐºÑƒÐ½Ð¶ÑƒÑ‚.', 399, 1, 0, 0, 'b96b09c5d9550cc3b8d50cbf7e826acc.jpeg', 'kaliforniya'),
(6, 'ÐšÐ¾ÐºÐ° ÐºÐ¾Ð»Ð°', 'ÐšÐ¾ÐºÐ° ÐºÐ¾Ð»Ð° Ð² ÐŸÐ­Ð¢ Ð±ÑƒÑ‚Ñ‹Ð»ÐºÐµ 2Ð».', 'ÐÐ°Ð¿Ð¸Ñ‚Ð¾Ðº Â«ÐšÐ¾ÐºÐ°-ÐšÐ¾Ð»Ð°Â» Ð±Ñ‹Ð» Ð¿Ñ€Ð¸Ð´ÑƒÐ¼Ð°Ð½ Ð² ÐÑ‚Ð»Ð°Ð½Ñ‚Ðµ (ÑˆÑ‚Ð°Ñ‚ Ð”Ð¶Ð¾Ñ€Ð´Ð¶Ð¸Ñ, Ð¡Ð¨Ð) 8 Ð¼Ð°Ñ 1886 Ð³Ð¾Ð´Ð° Ñ„Ð°Ñ€Ð¼Ð°Ñ†ÐµÐ²Ñ‚Ð¾Ð¼ Ð”Ð¶Ð¾Ð½Ð¾Ð¼ Ð¡Ñ‚Ð¸Ñ‚Ð¾Ð¼ ÐŸÐµÐ¼Ð±ÐµÑ€Ñ‚Ð¾Ð½Ð¾Ð¼ â€” Ð±Ñ‹Ð²ÑˆÐ¸Ð¼ Ð¾Ñ„Ð¸Ñ†ÐµÑ€Ð¾Ð¼ Ð°Ð¼ÐµÑ€Ð¸ÐºÐ°Ð½ÑÐºÐ¾Ð¹ ÐÑ€Ð¼Ð¸Ð¸ ÐºÐ¾Ð½Ñ„ÐµÐ´ÐµÑ€Ð°Ñ†Ð¸Ð¸ (ÐµÑÑ‚ÑŒ Ð»ÐµÐ³ÐµÐ½Ð´Ð°, Ñ‡Ñ‚Ð¾ ÐµÐ³Ð¾ Ð¿Ñ€Ð¸Ð´ÑƒÐ¼Ð°Ð» Ñ„ÐµÑ€Ð¼ÐµÑ€, ÐºÐ¾Ñ‚Ð¾Ñ€Ñ‹Ð¹ Ð¿Ñ€Ð¾Ð´Ð°Ð» ÑÐ²Ð¾Ð¹ Ñ€ÐµÑ†ÐµÐ¿Ñ‚ Ð”Ð¶Ð¾Ð½Ñƒ Ð¡Ñ‚Ð¸Ñ‚Ñƒ Ð·Ð° 250 $, Ð¾ Ñ‡Ñ‘Ð¼ Ð”Ð¶Ð¾Ð½ Ð¡Ñ‚Ð¸Ñ‚ ÑÐºÐ¾Ð±Ñ‹ ÑÐºÐ°Ð·Ð°Ð» Ð² Ð¾Ð´Ð½Ð¾Ð¼ Ð¸Ð· ÑÐ²Ð¾Ð¸Ñ… Ð¸Ð½Ñ‚ÐµÑ€Ð²ÑŒÑŽ). ÐÐ°Ð·Ð²Ð°Ð½Ð¸Ðµ Ð´Ð»Ñ Ð½Ð¾Ð²Ð¾Ð³Ð¾ Ð½Ð°Ð¿Ð¸Ñ‚ÐºÐ° Ð¿Ñ€Ð¸Ð´ÑƒÐ¼Ð°Ð» Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€ ÐŸÐµÐ¼Ð±ÐµÑ€Ñ‚Ð¾Ð½Ð° â€” Ð¤Ñ€ÑÐ½Ðº Ð Ð¾Ð±Ð¸Ð½ÑÐ¾Ð½, ÐºÐ¾Ñ‚Ð¾Ñ€Ñ‹Ð¹ Ñ‚Ð°ÐºÐ¶Ðµ, Ð²Ð»Ð°Ð´ÐµÑ ÐºÐ°Ð»Ð»Ð¸Ð³Ñ€Ð°Ñ„Ð¸ÐµÐ¹, Ð½Ð°Ð¿Ð¸ÑÐ°Ð» ÑÐ»Ð¾Ð²Ð° Â«Coca-ColaÂ» Ñ„Ð¸Ð³ÑƒÑ€Ð½Ñ‹Ð¼Ð¸ Ð±ÑƒÐºÐ²Ð°Ð¼Ð¸, Ð´Ð¾ ÑÐ¸Ñ… Ð¿Ð¾Ñ€ ÑÐ²Ð»ÑÑŽÑ‰Ð¸Ð¼Ð¸ÑÑ Ð»Ð¾Ð³Ð¾Ñ‚Ð¸Ð¿Ð¾Ð¼ Ð½Ð°Ð¿Ð¸Ñ‚ÐºÐ°. ', 290, 4, 0, 0, 'kokakola.jpg', 'koka_kola'),
(7, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita2'),
(8, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita2'),
(9, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita3'),
(10, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita4'),
(11, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita5'),
(12, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita6'),
(13, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita7'),
(14, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita8'),
(15, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita9'),
(16, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita10'),
(17, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita11'),
(18, '', '', '', 0, NULL, 0, 0, NULL, ''),
(19, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita12'),
(20, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita13'),
(21, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita14'),
(22, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita15'),
(23, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita16'),
(24, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita17'),
(25, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita18'),
(26, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita19'),
(27, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita20'),
(28, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita21'),
(29, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita22'),
(30, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita23'),
(31, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita24'),
(32, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita25'),
(33, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita26'),
(34, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita27'),
(35, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita28'),
(36, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita29'),
(37, 'margarita2', 'text', 'text', 300, 1, 0, 0, 'margarita.jpeg', 'margarita30');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `reviews_text` text NOT NULL,
  `reviews_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `author_name`, `reviews_text`, `reviews_date`) VALUES
(1, 'user1', 'Ð’ÑÑ‘ ÑÑƒÐ¿ÐµÑ€ Ð²ÑÑ‘ Ð¾Ñ‡ÐµÐ½ÑŒ Ð¿Ð¾Ð½Ñ€Ð°Ð²Ð¸Ð»Ð¾ÑÑŒ!', '2019-04-07 18:24:55'),
(2, 'admin', 'Ð¡Ð¿Ð°ÑÐ¸Ð±Ð¾ Ð·Ð° Ñ…Ð¾Ñ€Ð¾ÑˆÐ¸Ðµ Ð¾Ñ‚Ð·Ñ‹Ð²Ñ‹, Ñ€Ð°Ð´Ñ‹ ÑÑ‚Ð°Ñ€Ð°Ñ‚ÑŒÑÑ!', '2019-04-07 18:25:33'),
(3, 'admin', 'Ð¡ÑƒÐ¿ÐµÑ€!', '2019-04-07 18:57:58'),
(4, 'ÐŸÐµÑ‚Ñ', 'Ð£Ð¶Ð°ÑÐ½Ñ‹Ð¹ Ð¼Ð°Ð³Ð°Ð·Ð¸Ð½!', '2019-04-07 21:29:16');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(45) NOT NULL,
  `user_role` int(10) UNSIGNED NOT NULL DEFAULT '10',
  `user_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_role`, `user_name`) VALUES
(1, 'admin@adminsite.com', 'ed10ecca4ab293745eaa2e433c8939ae', 80, 'admin'),
(2, 'admin2@adminsite.com', '566d064b5001bec79d86b2d9e91d5c93', 50, 'admin'),
(3, 'vasya@yandex.ru', 'd610a537ad85fab1326b0895a9f147ef', 10, 'Ð’Ð°ÑÐ¸Ð»Ð¸Ð¹'),
(4, 'content@yandex.ru', 'ed10ecca4ab293745eaa2e433c8939ae', 40, 'content'),
(5, 'user1@yandex.ru', 'ed10ecca4ab293745eaa2e433c8939ae', 10, 'user1'),
(6, 'petya@mail.ru', 'ed10ecca4ab293745eaa2e433c8939ae', 10, 'ÐŸÐµÑ‚Ñ'),
(7, 'user2@ya.ru', 'ed10ecca4ab293745eaa2e433c8939ae', 10, 'User2'),
(8, 'test@ya.ru', 'ed10ecca4ab293745eaa2e433c8939ae', 10, 'ÐŸÐµÑ‚Ñ€ Ð’Ð°ÑÐ¸Ð»ÑŒÐµÐ²Ð¸Ñ‡'),
(9, 'ivanov@mail.ru', 'ed10ecca4ab293745eaa2e433c8939ae', 10, 'ÐŸÐµÑ‚Ñ€ Ð˜Ð²Ð°Ð½Ð¾Ð²'),
(10, 'markin@yandex.ru', 'ed10ecca4ab293745eaa2e433c8939ae', 10, 'ÐÐ»ÐµÐºÑÐ°Ð½Ð´Ñ€');

-- --------------------------------------------------------

--
-- Структура таблицы `users_data`
--

CREATE TABLE `users_data` (
  `users_data_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_phone` varchar(45) DEFAULT NULL,
  `user_addres` varchar(255) DEFAULT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `users_cteated_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`,`good_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`good_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`users_data_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `good_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users_data`
--
ALTER TABLE `users_data`
  MODIFY `users_data_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
