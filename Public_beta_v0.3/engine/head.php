<?
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
function meta_head() {
        global $pages;
        $charset="UTF-8";
        echo '<title>'.$pages['TITLE'].'</title>';
        echo '<meta name="DESCRIPTION" content="'.$pages['DESCRIPTION'].'">';
        echo '<meta name="KEYWORDS" content="'.$pages['KEYWORDS'].'">';
		echo '<meta http-equiv="content-type" content="text/html; charset='.$charset.'">';
                      }
?>
