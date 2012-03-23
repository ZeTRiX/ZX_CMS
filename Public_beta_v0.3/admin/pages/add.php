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
if (isset($_SESSION['connect'])) {

include ($_SERVER['DOCUMENT_ROOT'].'/engine/dbconfig.php');

$action=mysql_real_escape_string($_GET[action]); 
$id=mysql_real_escape_string($_GET[id]);

if ($_POST) {
    $add_urlid=mysql_real_escape_string($_POST['URLID']); 
	$add_name=mysql_real_escape_string($_POST['NAME']);
    $add_text=mysql_real_escape_string($_POST['TEXT']); 
    $add_title=mysql_real_escape_string($_POST['TITLE']); 
    $add_description=mysql_real_escape_string($_POST['DESCRIPTION']); 
    $add_keywords=mysql_real_escape_string($_POST['KEYWORDS']);
	
    if ($add_urlid != NULL && $add_name != NULL && $add_text != NULL && $add_title != NULL && $add_description != NULL && $add_keywords != NULL)
    {
        $pageadd=mysql_query("INSERT INTO `rze_structure`
            (`URLID`,`NAME`,`TEXT`,`ACTIVE`,`TITLE`,`DESCRIPTION`,`KEYWORDS`)  
            VALUES('/".$add_urlid."/','".$add_name."','".$add_text."','Y','".$add_title."','".$add_description."','".$add_keywords."')
			"); 
        echo '<b><span style="color:red">Страница добавлена.</span></b><br>'; 
    }
	else {echo'<b><span style="color:red">Все поля должны быть заполнены.</span></b><br>';}
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Добавление страницы</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="/engine/redactor/redactor.js"></script>
<link rel="stylesheet" href="/engine/redactor/css/redactor.css" type="text/css" />
<link href="/admin/skin/default/css/pages_style.css" rel="stylesheet" type="text/css"/>
</head>
<body style="color: #e6e6fa;; background: #21364e url(/admin/skin/default/diz/bg.gif) center 0;">
</body>
</html>

<center>
<form name="auth" method="post" action="add.php">
<table border=1 width="1000">
    <tr>
        <td width="150" style="padding:2px;"><b>Адрес страницы:</b></td>
        <td style="padding:2px;"><input name="URLID" maxlength="10" type="text" size="55" class="edit bk"></td>
    </tr>
    <tr>
        <td style="padding:2px;"><b>Название:</b></td>
        <td style="padding:2px;"><input name="NAME" type="text" size="55" class="edit bk"></td>
    </tr>

    <tr><td style="padding:2px;"><b>Текст:</b></td>
        <td style="padding-left:2px;"><textarea id="TEXT" name="TEXT" rows=20 class="edit bk" required></textarea>
	<script type="text/javascript">$(document).ready(function(){$('#TEXT').redactor();});</script></td></tr>
	    <tr>
	        <td height="29" style="padding-left:5px;"><b>Метатег title:</b></td>
	        <td><input name="TITLE" type="text" style="width:388px;" class="edit bk"></td>
	    </tr>
	    <tr>
	        <td height="29" style="padding-left:5px;"><b>Описание для статьи</b></td>
	        <td><input name="DESCRIPTION" type="text" style="width:388px;" class="edit bk"></td>
	    </tr>
	    <tr>
	        <td height="29" style="padding-left:5px;"><b>Ключевые слова</b></td>
	        <td><textarea name="KEYWORDS" type="text" style="width:388px;height:70px;" class="bk"></textarea></td>
	    </tr>
		<tr><td colspan="2"><div class="unterline"></div></td></tr></table>
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