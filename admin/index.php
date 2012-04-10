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

$id=mysql_real_escape_string($_GET[id]);

include ($_SERVER['DOCUMENT_ROOT'].'/admin/skin/default/header.tpl');

if (isset($_POST['submit'])){
$diz=htmlspecialchars(trim($_POST['diz']));
$file=fopen('dizconfig.php','w+');
  if(!$file)
    {
      echo('Ошибка Записи');
    }
$str = "<?\$skin=\"".$diz."\";?>";
  if ( !$file )
  {
    echo('Ошибка Записи');
  }
  else
  {
    fwrite ($file, $str);
  }
  fclose ($file);
}
include ($_SERVER['DOCUMENT_ROOT'].'/admin/dizconfig.php');
?>

<br/><table align="center" cellpadding=5 cellspacing=1 width=90%>
<tr bgcolor=#565366>
<td valign=top width=180>Смена шаблона:</td>
<td valign=top><center>
<form method="post" action="index.php"> 
<select name="diz">
<?
$path = "".$_SERVER['DOCUMENT_ROOT']."/templates/";
$handle = @opendir($path) or die("Невозможно открыть $path");
    $dir =$path.'/'.$entry;
    while (false !== ($entry = readdir($handle)) && is_dir($dir)) {
	    if ($entry != "." && $entry != "..") {
            echo '<option value="'.$entry.'"';
			if ($skin == $entry){echo ' selected>';}else{echo ' >';}
			echo ''.$entry.'</option>';
        }
    }
    closedir($handle);
?>
</select>
<input name="submit" type=submit value="Сменить" />
</form>
</center></td></tr>
<tr bgcolor=#565366>
<td valign=top width=180>Сократить ссылку:</td>
<td valign=top><center><? include ($_SERVER['DOCUMENT_ROOT'].'/admin/shorter.php'); ?></center></td></tr></table>
<br /><br />Текущая дата: <b><? echo date('Y-m-d') ?></b> и время: <b><? echo date('H:i:s') ?></b><br/>

<? include ($_SERVER['DOCUMENT_ROOT'].'/admin/skin/default/footer.tpl');

}
else
{
header('Location: login.php');
}
 ?>