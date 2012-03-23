<? define('RZ_Engine', true);
set_magic_quotes_runtime(0);
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
$id=mysql_real_escape_string($_GET[id]);

	$e_name=mysql_real_escape_string($_POST[edit_name]); 
    $e_active=mysql_real_escape_string($_POST[edit_active]); 
    $e_urlid=mysql_real_escape_string($_POST[edit_url]); 
    $e_text=mysql_real_escape_string($_POST[edit_text]); 
    $e_title=mysql_real_escape_string($_POST[edit_title]); 
    $e_description=mysql_real_escape_string($_POST[edit_description]); 
    $e_keywords=mysql_real_escape_string($_POST[edit_keywords]);

if ($_POST) {	
	if ($e_name != NULL) {
     $pageedit=mysql_query("UPDATE `rze_structure` SET 
						   `NAME`='".$e_name."', 
                           `ACTIVE`='".$e_active."', 
                           `URLID`='".$e_urlid."', 
                           `TEXT`='".$e_text."', 
                           `TITLE`='".$e_title."', 
                           `DESCRIPTION`='".$e_description."', 
                           `KEYWORDS`='".$e_keywords."'

                            WHERE `ID`=".$id."
                           "); 
    echo '<b><span style="color:red">Страница успешно изменена.</span></b><br>'; 
    }
	else {echo '<b><span style="color:red">Не все поля заполнены.</span></b><br>'; }
	}
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Редактирование страницы</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="/engine/redactor/redactor.js"></script>
<link rel="stylesheet" href="/engine/redactor/css/redactor.css" type="text/css" />
<link href="/admin/skin/default/css/pages_style.css" rel="stylesheet" type="text/css"/>
</head>
<body style="color: #e6e6fa;; background: #21364e url(/admin/skin/default/diz/bg.gif) center 0;">
</body>
</html>
<?
$editsql=mysql_fetch_array(mysql_query("SELECT * FROM `rze_structure` WHERE id=".$id.""));
?>
<center>
<form name="edit" method="post" action="edit.php?id=<? echo $id; ?>">
<table border=1 width="1000">
    <tr>
        <td width="150" style="padding:2px;"><b>Адрес страницы:</b></td>
        <td style="padding:2px;"><input name="edit_url" maxlength="10" type="text" size="55" class="edit bk" value="<? echo htmlspecialchars($editsql[URLID]);?>"> (id: <? echo $editsql[ID]; ?>)</td>
    </tr>
	<? IF ($editsql[ACTIVE]==Y) $ACT='checked' ?>
	<tr>
        <td style="padding:2px;"><b>Активность:</b></td>
        <td style="padding:2px;">
		<input type=checkbox name="edit_active" class="edit bk" <? echo $ACT;?> value="Y"></td>
    </tr>
    <tr>
        <td style="padding:2px;"><b>Название:</b></td>
        <td style="padding:2px;"><input name="edit_name" size="55" class="edit bk" value="<? echo htmlspecialchars($editsql[NAME]);?>"></td>
    </tr>
    <tr>
		<td style="padding:2px;"><b>Текст:</b></td>
        <td style="padding-left:2px;"><textarea id="edit_text" name="edit_text" rows=20 class="edit bk"><? echo htmlspecialchars($editsql[TEXT]); ?></textarea>
	    <script type="text/javascript">$(document).ready(function(){$('#edit_text').redactor();});</script></td>
	</tr>
	    <tr>
	        <td height="29" style="padding-left:5px;"><b>Мета title:</b></td>
	        <td><input name="edit_title" style="width:388px;" class="edit bk" value="<? echo htmlspecialchars($editsql[TITLE]);?>"></td>
	    </tr>
	    <tr>
	        <td height="29" style="padding-left:5px;"><b>Описание для страницы</b></td>
	        <td><input name="edit_description" style="width:388px;" class="edit bk" value="<? echo htmlspecialchars($editsql[DESCRIPTION]);?>"></td>
	    </tr>
	    <tr>
	        <td height="29" style="padding-left:5px;"><b>Ключевые слова</b></td>
	        <td><input name="edit_keywords" style="width:388px;" class="bk" value="<? echo htmlspecialchars($editsql[KEYWORDS]);?>"></td>
	    </tr>
		<tr><td colspan="2"><div class="unterline"></div></td></tr></table>
<table border=1 width="1000">
	    <tr align="center">
        <td><input type="submit" value="Сохранить" class="buttons" style="width:80px;"></td>
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