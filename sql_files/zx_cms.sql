-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Время создания: Июн 29 2013 г., 16:18
-- Версия сервера: 5.6.12
-- Версия PHP: 5.4.16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `zx_cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `zx_news`
--

CREATE TABLE IF NOT EXISTS `zx_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `stext` text NOT NULL,
  `ftext` text NOT NULL,
  `author` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `def` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `zx_news`
--

INSERT INTO `zx_news` (`id`, `title`, `stext`, `ftext`, `author`, `date`, `def`) VALUES
(1, 'Test', '<h1 style="text-align: center;"><u><i>Test</i></u></h1><p></p>', '<h1 style="text-align: left;">Test</h1>', 'ZeTRiX', '2013-06-12 11:57:14', 'Y');

-- --------------------------------------------------------

--
-- Структура таблицы `zx_pages`
--

CREATE TABLE IF NOT EXISTS `zx_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `name` text NOT NULL,
  `text` text NOT NULL,
  `mdesc` text NOT NULL,
  `mkwords` text NOT NULL,
  `def` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `zx_pages`
--

INSERT INTO `zx_pages` (`id`, `url`, `name`, `text`, `mdesc`, `mkwords`, `def`) VALUES
(1, '/', 'Главная - ZX CMS', '<p>Main</p>', 'ZX CMS', 'ZX, CMS, ZeTRiX', 'Y'),
(2, '/about/', 'О нас - ZX CMS', '<br /><h2><b>Тестовая страница О нас - ZX CMS</b></h2>', 'Sample', 'Sample', 'Y');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
