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
$dbfile = fopen($_SERVER['DOCUMENT_ROOT'].'/engine/dbconfig.php', 'r');
if(fgetc($dbfile) === false) {
    header('Location: /engine/install.php');
}
fclose($dbfile);

include ($_SERVER['DOCUMENT_ROOT'].'/engine/dbconfig.php');
include ($_SERVER['DOCUMENT_ROOT'].'/admin/dizconfig.php');
include ($_SERVER['DOCUMENT_ROOT'].'/engine/functions.php');

$rze_urlexp=explode('?',$_SERVER['REQUEST_URI']); 
$rze_mainurl=$rze_urlexp[0]; 
$pages=mysql_fetch_array(mysql_query("SELECT * FROM rze_structure WHERE ACTIVE='Y' AND URLID='".$rze_mainurl."'"));

if (!$pages[ID]) { $pages=mysql_fetch_array(mysql_query("SELECT * FROM rze_structure WHERE ACTIVE='Y' AND URLID='/404/'")); }
if ($pages[ID] == 1){
require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/header.tpl');
require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/sidebar.tpl');
require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/news.tpl');
require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/footer.tpl');
} else {
require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/header.tpl');
require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/sidebar.tpl');
require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/content.tpl');
echo $pages[TEXT];
require ($_SERVER['DOCUMENT_ROOT'].'/templates/'.$skin.'/footer.tpl'); }

?>