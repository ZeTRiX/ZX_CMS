<?
	define('INST_DIR', dirname (__FILE__));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RZ_Engine: Установка</title>
<link href="/install.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div align="center">
<?
$db_file = $_SERVER['DOCUMENT_ROOT'].'/engine/dbconfig.php';
if ( !file_exists($db_file)) {
?>
<h2>Установка RZ_Engine: Введите данные</h2>
<form action="install.php" method="post">
<table align="center">
<tr><td align="right">Хост (Сервер SQL):</td>
<td align="left"><input type="text" name="host"></td></tr>
<tr><td align="right">База:</td>
<td align="left"><input type="text" name="database"</td></tr>
<tr><td align="right">Пользователь БД:</td>
<td align="left"><input type="text" name="blogin"></td></tr>
<tr><td align="right">Пароль БД:</td>
<td aling="left"><input type="password" name="pass"></td></tr>
<br />
<tr><td align="right">Пароль Админ-Панели:</td>
<td align="left"><input type="password" name="admin_password"></td></tr>
</table>
<input type="submit" name="inst" value="Сохранить">
</form><br />


<? function error() {
// Выводим сообщение об ощибке
  echo "Ошибка #".mysql_errno().": ".mysql_error();
  exit;
}

echo"<div><table width=\"60%\"><tr>
<td height=\"25\" width=\"250\">&nbsp;Минимальные требования скрипта
<td height=\"25\" colspan=2>&nbsp;Текущее значение
<tr><td colspan=3><div class=\"hr_line\"></div></td></tr>";
 
$status = phpversion() < '5.1' ? '<font color=red><b>Нет</b></font>' : '<font color=green><b>Да</b></font>';

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Версия PHP 5.1 и выше</td>
         <td>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

$status = function_exists('mysql_connect') ? '<font color=green><b>Да</b></font>' : '<font color=red><b>Нет</b></font>';;

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Поддержка MySQL</td>
         <td colspan=2>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";


$status = extension_loaded('zlib') ? '<font color=green><b>Да</b></font>' : '<font color=red><b>Нет</b></font>';

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Поддержка сжатия ZLib</td>
         <td colspan=2>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

$status = extension_loaded('xml') ? '<font color=green><b>Да</b></font>' : '<font color=red><b>Нет</b></font>';

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Поддержка XML</td>
         <td colspan=2>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

$status = function_exists('iconv') ? '<font color=green><b>Да</b></font>' : '<font color=red><b>Нет</b></font>';;

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Поддержка iconv</td>
         <td colspan=2>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

   echo"<tr>
         <td colspan=3 class=\"navigation\"><br />Если любой из этих пунктов выделен красным, то пожалуйста выполните действия для исправления положения. В случае несоблюдения минимальных требований скрипта возможна его некорректная работа в системе.<br /><br /></td>
         </tr>";

echo"<tr><td colspan=3><div class=\"hr_line\"></div></td></tr><tr>
<td height=\"25\">&nbsp;Рекомендуемые настройки
<td height=\"25\" width=\"200\">&nbsp;Рекомендуемое значение
<td height=\"25\">&nbsp;Текущее значение
<tr><td colspan=3><div class=\"hr_line\"></div></td></tr>";

$status = ini_get('safe_mode') ? '<font color=red><b>Включено</b></font>' : '<font color=green><b>Выключено</b></font>';;

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Safe Mode</td>
         <td>&nbsp;Выключено</td>
         <td>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

$status = function_exists('mysqli_connect') ? '<font color=green><b>Да</b></font>' : '<font color=red><b>Нет</b></font>';;

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Поддержка MySQLi</td>
         <td>&nbsp;Да</td>
         <td>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";


$status = ini_get('file_uploads') ? '<font color=green><b>Включено</b></font>' : '<font color=red><b>Выключено</b></font>';;

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Загрузка файлов</td>
         <td>&nbsp;Включено</td>
         <td>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

$status = ini_get('output_buffering') ? '<font color=red><b>Включено</b></font>' : '<font color=green><b>Выключено</b></font>';;

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Буферизация вывода</td>
         <td>&nbsp;Выключено</td>
         <td>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

$status = ini_get('magic_quotes_runtime') ? '<font color=red><b>Включено</b></font>' : '<font color=green><b>Выключено</b></font>';;

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Magic Quotes Runtime</td>
         <td>&nbsp;Выключено</td>
         <td>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

$status = ini_get('register_globals') ? '<font color=red><b>Включено</b></font>' : '<font color=green><b>Выключено</b></font>';;

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Register Globals</td>
         <td>&nbsp;Выключено</td>
         <td>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

$status = ini_get('session.auto_start') ? '<font color=red><b>Включено</b></font>' : '<font color=green><b>Выключено</b></font>';;

   echo"<tr>
         <td height=\"22\" class=\"tableborder main\">&nbsp;Session auto start</td>
         <td>&nbsp;Выключено</td>
         <td>&nbsp;$status</td>
         </tr><tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=3></td></tr>";

   echo"<tr><td colspan=3 class=\"navigation\"><br />Данные настройки являются рекомендуемыми для полной совместимости, однако скрипт способен работать даже если рекомендуемые настройки несовпадают с текущими.<br /><br /></td>
         </tr></table></div>";

if(isset($_POST['inst'])){
	$dblocation=$_POST['host'];
	$dbuser=$_POST['blogin'];
    $dbpasswd=$_POST['pass'];
    $dbname=$_POST['database'];
    $admin_password=sha1($_POST['admin_password']);
echo "<b>Подключаюсь к SQL-серверу... ";
mysql_connect($dblocation,$dbuser,$dbpasswd) or error();
echo "<span style=\"color:green;\">OK</span></b><br />\n";

echo "<b>Выбираю базу данных... ";
mysql_select_db($dbname) or error();
mysql_query ("SET NAMES utf8") or error();
mysql_query ("set character_set_client='utf8'") or error();
mysql_query ("set character_set_results='utf8'") or error();
mysql_query ("set collation_connection='utf8_general_ci'") or error();
echo "<span style=\"color:green;\">OK</span></b><br />\n";

echo "<b>Создаю таблицы... <span style=\"color:green;\">OK</span></b><br />\n";
echo "<b>Создаю структуру... ";
mysql_query("CREATE TABLE IF NOT EXISTS `rze_structure` (
  `ID` int(11) NOT NULL auto_increment,
  `URLID` varchar(255) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `TEXT` longtext NOT NULL,
  `ACTIVE` varchar(1) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `KEYWORDS` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`)
)") or error();
echo "<span style=\"color:green;\">OK</span></b><br />\n";
echo "<b>Формирую страницы... ";
mysql_query("INSERT INTO `rze_structure` (`URLID`, `NAME`, `TEXT`, `ACTIVE`, `TITLE`, `DESCRIPTION`, `KEYWORDS`) VALUES
('/', 'Главная страница', '<p>\r\n	<span style=\"font-size:16px;\"><strong>Главная страницы</strong></span></p>\r\n', 'Y', 'Главная страница', 'Главная страница powered by RZ_Engine', 'Главная, RZ_Engine'),
('/about/', 'О Сайте', '<p>\r\n	<strong><span style=\"font-size:16px;\">Данные о Сайте</span></strong></p>\r\n', 'Y', 'О Сайте', 'Данные о сайте', 'О, сайте, RZ_Engine'),
('/404/', 'Страница не найдена', '<span style=\"text-align: center; font-size:18px; color:red;\">404<br />Страница не найдена</span>', 'Y', '404 - Страница не найдена', '404 - Страница не найдена', '404 - Страница не найдена');");
echo "<span style=\"color:green;\">OK</span></b><br />\n";

echo "<b>Подключаю новости... ";
mysql_query("CREATE TABLE IF NOT EXISTS `rze_news` (
  `ID` int(11) NOT NULL auto_increment,
  `NAME` varchar(100) NOT NULL,
  `SHORTTEXT` text NOT NULL,
  `TEXT` longtext NOT NULL,
  `IMG` text NOT NULL,
  `INF` int(1) NOT NULL default '0',
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ID`),
  FULLTEXT KEY `SHORTTEXT` (`SHORTTEXT`)
)") or error();
echo "<b>Формирую тестовый контент... <span style=\"color:green;\">OK</span></b><br />\n";
mysql_query("INSERT INTO `rze_news` (`NAME`, `SHORTTEXT`, `TEXT`, `IMG`) VALUES
('Название тестовой новости', 'Тестовый краткий контент тестовой новости', 'Тестовый полный контент тестовой новости... длинныыыыеее записииии, тееееессссттт =)', '/templates/default/diz/rzelogo.png');");
echo "<span style=\"color:green;\">OK</span></b><br />\n";

echo "<b>Создаю конфигурационный файл... ";

$confinfo=<<<HTML
<? if(!defined('RZ_Engine')) {die(\"Don't Hack! That's not good =) \");}
/*************************************************
Copyright 2012 © ZeTRiX zetlog.ru - Evgeny
**************************************************
This file is part of RZ_Engine. RZ_Engine is a simple CMS (Content Management System) made for non-commercial use.

    RZ_Engine is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    RZ_Engine is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with RZ_Engine.  If not, see <http://www.gnu.org/licenses/>.
**************************************************/

\$dblocation=\"".$dblocation."\";
\$dbuser=\"".$dbuser."\";
\$dbpasswd=\"".$dbpasswd."\";
\$dbname=\"".$dbname."\";

\$timeout = time()-300;
\$admin_password=\"".$admin_password."\";

mysql_connect(\$dblocation,\$dbuser,\$dbpasswd); 
mysql_select_db(\$dbname);
mysql_query (\"SET NAMES utf8\");
mysql_query (\"set character_set_client='utf8'\");
mysql_query (\"set character_set_results='utf8'\");
mysql_query (\"set collation_connection='utf8_general_ci'\"); ?>
HTML;

$con_file = fopen('./dbconfig.php', "w+") or die("Извините, но невозможно создать файл <b>dbconfig.php</b>.<br />Проверьте права доступа!");
fwrite($con_file, $confinfo);
fclose($con_file);
echo "<span style=\"color:green;\">OK</span></b><br />\n";

echo "<b>Настраиваю права доступа...";
@chmod("dbconfig.php", 0666);
@chmod("install.php", 0600);
echo "<span style=\"color:green;\">OK</span></b><br />\n";

echo "<b>Инсталяция завершена</b><br /><br />";
echo "<div align=\"center\" style=\"width:30%;\"><div style=\"float:left\"><a href=/><span style=\"color:green;\">Перейти на созданный сайт</span></a></div><div style=\"float:right\"><a href=/admin/><span style=\"color:green;\">Перейти в Админ-Панель</span></a></div>";
}

} else {echo '<br /><br /><p align="center" style="color:red; font-weight:20px;">RZ_Engine уже установлен. Можете удалить файл устанощика.</p><br />';
echo '<p align="center" style="color:red; font-weight:16px;">Для повторной установке удалите файл <b>dbconfig.php</b></p>';}
?>
</div>
</body>
</html>