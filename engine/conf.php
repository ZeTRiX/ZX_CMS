<?php
if( !defined('ZX_CMS') ) { die('Don\'t hack us, please! That\'s not good!'); }


/* Имя сервера MySQL */
define('DB_HOST', 'localhost');

/* Имя пользователя MySQL */
define('DB_USER', 'dbusername');

/* Пароль к базе данных MySQL */
define('DB_PASSWORD', 'dbpassword');

/* Имя базы данных */
define('DB_NAME', 'dbname');

/* Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

define('ADMIN_LGN', 'тут логин админа');
define('AUTH_KEY', sha1('тут пароль'));
// define('AUTH_KEY', 'тут sha1 хэш пароля админа (замутить тут: http://sha1hash.com)');

/** Инициализирует переменные и подключает файлы. */
require_once(dirname(__FILE__) . '/sett.php');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

/** Проверка подключения. */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

$mysqli->query ("SET NAMES ". DB_CHARSET);
$mysqli->query ("set character_set_client='" . DB_CHARSET . "'");
$mysqli->query ("set character_set_results='" . DB_CHARSET . "'");
$mysqli->query ("set collation_connection='" . DB_CHARSET . "_general_ci'");