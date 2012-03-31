<? define('RZ_Engine', true);
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
session_start();

include($_SERVER['DOCUMENT_ROOT'].'/engine/dbconfig.php');
$pass=$_POST['password'];
if (isset($pass))
{
    if ($pass != NULL)
    {
	$pass=sha1($pass);
		if ($admin_password == $pass)
			$_SESSION['connect'] = 'true';
			header('Location: index.php');
	}
}

if (!isset($_SESSION['connect'])) {
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Вход в Админ-Панель - RZ_Engine</title>
<link href="/admin/skin/default/css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="wrapper">
<header><div id="top_bg"><div id="top_menu">
<div><b>Вход в Админ-Панель - RZ_Engine</b></div>
</div></div></header>

<div id="main"><div id="content">
<div style="text-align:center; width: 100%;
	font-size: 14px;
	text-align: center;
	color: #fff;
	border-radius: 3px 3px 0 0;
	-moz-border-radius: 3px 3px 0 0;
	-webkit-border-radius: 3px 3px 0 0;">
<br /><form name="auth" method="post" action="login.php">
  <input name="password" type="password" size="30">
  <br /><br /><input type="submit" value="Войти" size="10" style="width: 10%">
 </form>
<br />Текущая дата: <b><? echo date('Y-m-d') ?></b> и время: <b><? echo date('H:i:s') ?></b>
</div>
</div><div id="bottom"></div></div>

</div></body>
</html>

<?php
}
else
	header('Location: index.php');
?>
