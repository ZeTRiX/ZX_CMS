<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RZ_Engine: Установка</title>
<link href="/engine/install/install.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div align="center">
<? if (filesize('dbconfig.php') == 0) { ?>
<h2>Установка RZ_Engine: Введите данные</h2>
<form action='install.php' method=post>
<table align="center">
<tr><td align=right>Хост (Сервер SQL):</td>
<td align=left><input type=text name=host></td></tr>
<tr><td align=right>База:</td>
<td align=left><input type=text name=database></td></tr>
<tr><td align=right>Пользователь БД:</td>
<td align=left><input type=text name=blogin></td></tr>
<tr><td align=right>Пароль БД:</td>
<td aling=left><input type=password name=pass></td></tr>
<br />
<tr><td align=right>Пароль Админ-Панели:</td>
<td align=left><input type=password name=admin_password></td></tr>
</table>
<input type=submit name=inst value="Сохранить">
</form><br />


<? function error() {
// Выводим сообщение об ощибке
  echo "Ошибка #".mysql_errno().": ".mysql_error();
  exit;
}

if($_POST){
	$dblocation=$_POST['host'];
	$dbuser=$_POST['blogin'];
    $dbpasswd=$_POST['pass'];
    $dbname=$_POST['database'];
    $admin_password=sha1($_POST['admin_password']);
echo "<b>Подключаюсь к SQL-серверу... <span style=\"color:green;\">OK</span></b><br />\n";
mysql_connect($dblocation,$dbuser,$dbpasswd) or error();
echo "<b>Выбираю базу данных... <span style=\"color:green;\">OK</span></b><br />\n";
mysql_select_db($dbname) or error();
mysql_query ("SET NAMES utf8") or error();
mysql_query ("set character_set_client='utf8'") or error();
mysql_query ("set character_set_results='utf8'") or error();
mysql_query ("set collation_connection='utf8_general_ci'") or error();

echo "<b>Создаю таблицы... <span style=\"color:green;\">OK</span></b><br />\n";
echo "<b>Создаю структуру... <span style=\"color:green;\">OK</span></b><br />\n";
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
echo "<b>Формирую страницы... <span style=\"color:green;\">OK</span></b><br />\n";
mysql_query("INSERT INTO `rze_structure` (`URLID`, `NAME`, `TEXT`, `ACTIVE`, `TITLE`, `DESCRIPTION`, `KEYWORDS`) VALUES
('/', 'Главная страница', '<p>\r\n	<span style=\"font-size:16px;\"><strong>Главная страницы</strong></span></p>\r\n', 'Y', 'Главная страница', 'Главная страница powered by RZ_Engine', 'Главная, RZ_Engine'),
('/about/', 'О Сайте', '<p>\r\n	<strong><span style=\"font-size:16px;\">Данные о Сайте</span></strong></p>\r\n', 'Y', 'О Сайте', 'Данные о сайте', 'О, сайте, RZ_Engine'),
('/404/', 'Страница не найдена', '<span style=\"text-align: center; font-size:18px; color:red;\">404<br />Страница не найдена</span>', 'Y', '404 - Страница не найдена', '404 - Страница не найдена', '404 - Страница не найдена');");

echo "<b>Подключаю новости... <span style=\"color:green;\">OK</span></b><br />\n";
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

echo "<b>Создаю конфигурационный файл... <span style=\"color:green;\">OK</span></b><br>\n";
$file=fopen('dbconfig.php','w+');
  if(!$file)
    {
      echo('Ошибка Записи конфигурации');
    }
$confinfo="<? if(!defined('RZ_Engine')) {die(\"Don't Hack! That's not good =) \");}
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
mysql_query (\"set collation_connection='utf8_general_ci'\"); ?>";
  if ( !$file )
  {
      echo('Ошибка создания конфигурационного файла');
	  exit;
  }
else { fwrite ($file, $confinfo); }
  fclose ($file);
echo "<b>Файл успешно создан... <span style=\"color:green;\">OK</span></b><br>\n";

echo "<b>Настраиваю права доступа... <span style=\"color:green;\">OK</span></b><br>\n";
exec(escapeshellcmd('chmod 644 dbconfig.php'));
exec(escapeshellcmd('chmod 600 install.php'));
echo "<span style=\"color:red;\">Если выше выдало 2 ошибки по поводу <b>exec()</b> - не страшно - просто ваш хостер очень суеверный =)</span><br>\n";

echo "<b>Инсталяция завершена</b><br /><br />";
echo "<div align=\"center\" style=\"width:30%;\"><div style=\"float:left\"><a href=/><span style=\"color:green;\">Перейти на созданный сайт</span></a></div><div style=\"float:right\"><a href=/admin/><span style=\"color:green;\">Перейти в Админ-Панель</span></a></div>";
}

} else {echo '<br /><br /><p align="center" style="color:red; font-weight:20px;">RZ_Engine уже установлен. Можете удалить файл устанощика.</p><br />';
echo '<p align="center" style="color:red; font-weight:16px;">Для повторной установке очистите файл <b>dbconfig.php</b></p>';}
?>
</div>
</body>
</html>