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
include ($_SERVER['DOCUMENT_ROOT'].'/engine/dbconfig.php');
session_start();
if (isset($_SESSION['connect'])) {

$action=mysql_real_escape_string($_GET[action]); 
$id=mysql_real_escape_string($_GET[id]);

if ($_POST){
	$n_name=mysql_real_escape_string($_POST[n_NAME]); 
    $n_shorttext=mysql_real_escape_string($_POST[n_SHORTTEXT]); 
    $n_text=mysql_real_escape_string($_POST[n_TEXT]);
	$n_img=mysql_real_escape_string($_POST[n_IMG]);
    if ($n_name != NULL && $n_shorttext != NULL && $n_text != NULL && $n_img != NULL)
    {
        $newsadd=mysql_query("INSERT INTO `rze_news` (`NAME`,`SHORTTEXT`,`TEXT`,`IMG`)
		VALUES ('".$n_name."', '".$n_shorttext."', '".$n_text."', '".$n_img."')");
        echo '<b><span style="color:red">Страница добавлена.</span></b><br>'; 
    }
	else {echo'<b><span style="color:red">Все поля должны быть заполнены.</span></b><br>';}
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Добавление новости</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="/engine/redactor/redactor.js"></script>
<link rel="stylesheet" href="/engine/redactor/css/redactor.css" type="text/css" />
<link href="/admin/skin/default/css/pages_style.css" rel="stylesheet" type="text/css"/>
</head>
<body style="color: #e6e6fa;; background: #21364e url(/admin/skin/default/diz/bg.gif) center 0;">
</body>
</html>

<center>
<form name="news_add" method="post" action="add.php">
<table border=1 width="1000">
    <tr>
        <td style="padding:2px;"><b>Название:</b></td>
        <td style="padding:2px;"><input name="n_NAME" type="text" size="55" class="edit bk"></td>
    </tr>
    <tr>
        <td style="padding:2px;"><b>Краткий текст новости:</b></td>
        <td style="padding-left:2px;"><textarea id="n_SHORTTEXT" name="n_SHORTTEXT" rows=10 class="edit bk"></textarea>
        <script type="text/javascript">$(document).ready(function(){$('#n_SHORTTEXT').redactor();});</script></td>
	</tr>
    <tr>
        <td style="padding:2px;"><b>Полный текст новости:</b></td>
        <td style="padding-left:2px;"><textarea id="n_TEXT" name="n_TEXT" rows=20 class="edit bk"></textarea>
        <script type="text/javascript">$(document).ready(function(){$('#n_TEXT').redactor();});</script></td>
	</tr>
	<tr>
        <td height="29" style="padding-left:5px;"><b>Адрес картинки для новости:</b></td>
        <td><input name="n_IMG" type="text" style="width:388px;" class="edit bk"></td>
    </tr>
	<tr><td colspan="2"><div class="unterline"></div></td></tr>
</table>
<table border=1 width="1000">
	    <tr align="center">
        <td><input type="submit" value="Добавить" class="buttons" style="width:80px;"></td>
	    </tr>
</table>
</form></center>

<?
}
else
{
header('Location: /admin/login.php');
}
?>