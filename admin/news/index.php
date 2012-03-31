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
define ( 'RZ_Engine', true );

$action=mysql_real_escape_string(@$_GET[action]);
$action=htmlspecialchars($action,ENT_QUOTES,"utf-8");
$warn[0] = "UPDATE";$warn[1] = "SELECT";$warn[2] = "DELETE";
$action=str_replace($warn,"",$action);
$id=mysql_real_escape_string(intval(@$_GET[id]));

include ($_SERVER['DOCUMENT_ROOT'].'/admin/skin/default/header.tpl');

if ($_GET[action] == 'del')
    {
        $sqldel=mysql_query("DELETE FROM rze_news WHERE ID='".$id."'");
		echo '<script>alert("Новость успешно удалена.");</script>';
		$redirurl = '/admin/news/';
		echo "<script language=\"JavaScript\">\n";
		echo "<!-- \n\n";
		echo "function redirect() { window.location = \"" . $redirurl . "\"; }\n";
		echo "timer = setTimeout('redirect()', '" . ($seconds*1) . "');\n\n";
		echo "-->\n";
		echo "</script>\n";
    }
?>

<h4>Новости сайта</h4>
<br /><p><a href="add.php" onclick="return openNewWindow(this)" title="Добавить новость." class="buttons">Добавить Новость.</a></p>

<? 
echo '<table align="center" cellpadding=5 cellspacing=1 width=90%>'; 
$sql=mysql_query("SELECT * FROM rze_news ORDER BY `id` DESC"); 
while ($res=mysql_fetch_array($sql)) 
    { 
       echo '<tr bgcolor=#545166>'; 
       echo '<td valign=top>'; 
        echo $res[ID].'</td><td><a href="/engine/news.php?id='.$res[ID].'">'.$res[NAME].'</a> 
        <br>'.$res[IMG].' 
        </td> 
        <td valign=top width=120><center>[<a href="/admin/news/edit.php?id='.$res[ID].'" onclick="return openNewWindow(this)" title="Редактировать новость.">Редактировать</a>]</center></td> 
        <td valign=top width=70><center>[<a href="/admin/news/?action=del&id='.$res[ID].'">Удалить</a>]</center></td>';
       echo '</td>'; 
       echo '</tr>'; 
    } 
echo '</table>'; 
?>
<br />Текущая дата: <b><? echo date('Y-m-d') ?></b> и время: <b><? echo date('H:i:s') ?></b>

<? include ($_SERVER['DOCUMENT_ROOT'].'/admin/skin/default/footer.tpl'); 
}
else
{
header('Location: /admin/login.php');
}
?>