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
include ($_SERVER['DOCUMENT_ROOT'].'/admin/dizconfig.php');

if ($_GET[id])
    {
    $id=mysql_real_escape_string(@$_GET[id]); 
	$id=intval($id);
    $fullnews=mysql_fetch_array(mysql_query("SELECT NAME,stamp,IMG,TEXT FROM rze_news WHERE id='".$id."'"));

    include ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/fullnews.tpl');
	echo '<div align="center"><table style="font-size:12px;" width="95%" border=0 CELLPADDING=10 CELLSPACING=0><tr><td>';
	echo '<div id="nwhead"><div style="float:left;font-size:16px;"><b>'.htmlspecialchars($fullnews[NAME]).'</b></div><div style="float:right;font-size:14px;">Дата добавления: '.htmlspecialchars($fullnews[stamp]).'</div></div>';
	echo '<div id="nwcont"><img src="'.htmlspecialchars($fullnews[IMG]).'" alt="'.htmlspecialchars($fullnews[NAME]).'" /><br />'.$fullnews[TEXT].'</div>';
	echo '</td></tr></table></div>';
    include ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/footer.tpl');
	}
?>
