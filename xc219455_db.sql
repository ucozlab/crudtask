-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Хост: xc219455.mysql.ukraine.com.ua
-- Время создания: Май 30 2016 г., 12:14
-- Версия сервера: 5.6.27-75.0-log
-- Версия PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `xc219455_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Телевизоры'),
(2, 'Телефоны'),
(3, 'Планшеты');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `img`, `description`, `price`, `cat_id`) VALUES
(1, 'LG 43UF680V', 'http://i2.rozetka.ua/goods/1436376/lg_43uf680v_images_1436376283.jpg', '<ul class="g-i-tile-short-detail">\r\n																												<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Диагональ экрана:</span>\r\n											<span class="g-i-tile-short-detail-i-field">43"</span>\r\n																			</li>\r\n																																									<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Поддержка Smart TV:</span>\r\n											<span class="g-i-tile-short-detail-i-field">Есть</span>\r\n																			</li>\r\n																																																								<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Разрешение:</span>\r\n											<span class="g-i-tile-short-detail-i-field">3840x2160</span>\r\n																			</li>\r\n																																									<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Wi-Fi:</span>\r\n											<span class="g-i-tile-short-detail-i-field">Да</span>\r\n																			</li>\r\n																																									<li class="g-i-tile-short-detail-i">\r\n																																																																							<span class="g-i-tile-short-detail-i-title">Диапазоны цифрового тюнера:</span>\r\n																										<span class="g-i-tile-short-detail-i-field">DVB-S2, </span>\r\n																																																													<span class="g-i-tile-short-detail-i-field">DVB-C, </span>\r\n																																																													<span class="g-i-tile-short-detail-i-field">DVB-T2</span>\r\n																																										</li>\r\n																																																								<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Частота обновления:</span>\r\n											<span class="g-i-tile-short-detail-i-field">PMI 1000 Гц</span>\r\n																			</li>\r\n																														</ul>', 17999, 1),
(2, 'Samsung UE32J5530', 'http://i1.rozetka.ua/goods/846523/samsung_ue32j5530auxua_images_846523516.jpg', '<ul class="g-i-tile-short-detail">\r\n																												<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Диагональ экрана:</span>\r\n											<span class="g-i-tile-short-detail-i-field">32"</span>\r\n																			</li>\r\n																																									<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Поддержка Smart TV:</span>\r\n											<span class="g-i-tile-short-detail-i-field">Есть</span>\r\n																			</li>\r\n																																																								<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Разрешение:</span>\r\n											<span class="g-i-tile-short-detail-i-field">1920x1080</span>\r\n																			</li>\r\n																																									<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Wi-Fi:</span>\r\n											<span class="g-i-tile-short-detail-i-field">Да</span>\r\n																			</li>\r\n																																									<li class="g-i-tile-short-detail-i">\r\n																																																																							<span class="g-i-tile-short-detail-i-title">Диапазоны цифрового тюнера:</span>\r\n																										<span class="g-i-tile-short-detail-i-field">DVB-S2, </span>\r\n																																																													<span class="g-i-tile-short-detail-i-field">DVB-C, </span>\r\n																																																													<span class="g-i-tile-short-detail-i-field">DVB-T2</span>\r\n																																										</li>\r\n																																																								<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Частота обновления:</span>\r\n											<span class="g-i-tile-short-detail-i-field">100 Гц (CMR)</span>\r\n																			</li>\r\n																														</ul>', 10499, 1),
(3, 'Sony KDL-32R503C', 'http://i2.rozetka.ua/goods/622406/sony_kdl_32r503cbr2_images_622406797.jpg', '<ul class="g-i-tile-short-detail">\r\n																												<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Диагональ экрана:</span>\r\n											<span class="g-i-tile-short-detail-i-field">32"</span>\r\n																			</li>\r\n																																									<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Поддержка Smart TV:</span>\r\n											<span class="g-i-tile-short-detail-i-field">Есть</span>\r\n																			</li>\r\n																																																								<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Разрешение:</span>\r\n											<span class="g-i-tile-short-detail-i-field">1366x768</span>\r\n																			</li>\r\n																																									<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Wi-Fi:</span>\r\n											<span class="g-i-tile-short-detail-i-field">Да</span>\r\n																			</li>\r\n																																									<li class="g-i-tile-short-detail-i">\r\n																																																																							<span class="g-i-tile-short-detail-i-title">Диапазоны цифрового тюнера:</span>\r\n																										<span class="g-i-tile-short-detail-i-field">DVB-C, </span>\r\n																																																													<span class="g-i-tile-short-detail-i-field">DVB-T2, </span>\r\n																																																													<span class="g-i-tile-short-detail-i-field">DVB-T</span>\r\n																																										</li>\r\n																																																								<li class="g-i-tile-short-detail-i">\r\n																					<span class="g-i-tile-short-detail-i-title">Частота обновления:</span>\r\n											<span class="g-i-tile-short-detail-i-field">100 Гц (MotionFlow)</span>\r\n																			</li>\r\n																														</ul>', 8399, 1),
(4, 'Samsung Galaxy Tab E 9.6', 'http://i2.rozetka.ua/goods/749136/samsung_galaxy_tab_e_3g_brown_images_749136512.jpg', 'Экран 9.6" (1280x800) емкостный MultiTouch / T-Shark2 (1.3 ГГц) / RAM 1.5 ГБ / 8 ГБ встроенной памяти + microSD / 3G / Wi-Fi 802.11a/b/g/n / Bluetooth 4.0 / основная камера 5 Мп, фронтальная 2 Мп / GPS / ГЛОНАСС / Android 4.4 (KitKat) / 490 г / коричневый', 5999, 3),
(5, 'Samsung Galaxy Tab S2', 'http://i2.rozetka.ua/goods/1062079/samsung_galaxy_tab_s2_97_32gb_gold_images_1062079806.jpg', 'Экран 9.7" Super AMOLED (2048x1536) емкостный MultiTouch / Samsung Exynos 5433 (1.9 ГГц + 1.3 ГГц) / RAM 3 ГБ / 32 ГБ встроенной памяти + microSD / 802.11 a/b/g/n/ac / Bluetooth 4.1 / основная камера 8 Мп, фронтальная 2.1 Мп / GPS / ГЛОНАСС / Android 5.0 (Lollipop) / 375 г / золотистый', 13999, 3),
(6, 'Apple iPhone 6 16GB Space Gray', 'http://i1.rozetka.ua/goods/1537986/apple_iphone_6_16gb_space_gray_cpo_images_1537986556.jpg', 'Экран (4.7", IPS, 1334x750)/ Apple A8 (1.4 ГГц)/ основная камера: 8 Мп, фронтальная камера: 1.2 Мп/ RAM 1 ГБ/ 16 ГБ встроенной памяти/ 3G/ LTE/ GPS/ Nano-SIM/ iOS 9/ 1810 мА*ч', 13999, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`) VALUES
(2, 'admin', 'b67f97a5fae84c9dc336835fdfb41cf9945917fcb531b4c54f589fc63c66dbe0', '350d9eea72695f81', 'la-3111@mail.ru');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
