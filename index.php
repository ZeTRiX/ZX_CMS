<? define('RZ_Engine', true);
define('ROOT_DIR', dirname (__FILE__));
define('ENGINE_DIR', ROOT_DIR.'/engine/');
define('ADMIN_DIR', ROOT_DIR.'/admin/');
define('TPL_DIR', ROOT_DIR.'/templates/');
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
$db_file = ENGINE_DIR.'dbconfig.php';
if ( !file_exists($db_file)) {
    header('Location: /engine/install/install.php');
}

include (ENGINE_DIR.'dbconfig.php');
include (ADMIN_DIR.'dizconfig.php');
include (ENGINE_DIR.'functions.php');

$rze_urlexp=explode('?',$_SERVER['REQUEST_URI']); 
$rze_mainurl=$rze_urlexp[0]; 
$pages=mysql_fetch_array(mysql_query("SELECT * FROM rze_structure WHERE ACTIVE='Y' AND URLID='".$rze_mainurl."'"));

if (!$pages[ID]) { $pages=mysql_fetch_array(mysql_query("SELECT * FROM rze_structure WHERE ACTIVE='Y' AND URLID='/404/'")); }
if ($pages[ID] == 1){
require (TPL_DIR.$skin.'/header.tpl');
require (TPL_DIR.$skin.'/sidebar.tpl');
require (TPL_DIR.$skin.'/news.tpl');
require (TPL_DIR.$skin.'/footer.tpl');
} else {
require (TPL_DIR.$skin.'/header.tpl');
require (TPL_DIR.$skin.'/sidebar.tpl');
require (TPL_DIR.$skin.'/content.tpl');
echo $pages[TEXT];
require (TPL_DIR.$skin.'/footer.tpl'); }

?>