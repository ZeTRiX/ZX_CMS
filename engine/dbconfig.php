<? if(!defined('RZ_Engine')) {die("Don't Hack! That's not good =) ");}
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

$dblocation="localhost";
$dbuser="root";
$dbpasswd="";
$dbname="rze";

$timeout = time()-300;
$admin_password="dc76e9f0c0006e8f919e0c515c66dbba3982f785";

mysql_connect($dblocation,$dbuser,$dbpasswd); 
mysql_select_db($dbname);
mysql_query ("SET NAMES utf8");
mysql_query ("set character_set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_general_ci'"); ?>