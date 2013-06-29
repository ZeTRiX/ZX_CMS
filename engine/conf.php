<?php
if( !defined('ZX_CMS') ) { die('Don\'t hack us, please! That\'s not good!'); }

/* Имя базы данных */
define('DB_NAME', 'database');

/* Имя пользователя MySQL */
define('DB_USER', 'root');

/* Пароль к базе данных MySQL */
define('DB_PASSWORD', 'password');

/* Имя сервера MySQL */
define('DB_HOST', 'localhost');

/* Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

define('AUTH_KEY', 'впишите сюда sha1() хэш пароля админа');
define('ADMIN', 'впишите сюда ник админа');

/** Инициализирует переменные и подключает файлы. */
require_once(dirname(__FILE__) . '/sett.php');

mysql_connect(DB_HOST, DB_USER, DB_PASSWORD); 
mysql_select_db(DB_NAME);
mysql_query ("SET NAMES ". DB_CHARSET);
mysql_query ("set character_set_client='" . DB_CHARSET . "'");
mysql_query ("set character_set_results='" . DB_CHARSET . "'");
mysql_query ("set collation_connection='" . DB_CHARSET . "_general_ci'");