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

function f_news(){
$page = $_GET['page'];
$fsel = mysql_query("SELECT COUNT(*) FROM `rze_news` WHERE `INF`=0");
$temp = mysql_fetch_array($fsel);
$posts = $temp[0];
$countposts = 5;

$total = (($posts - 1) / $countposts) + 1;
$total =  intval($total);
$page = intval($page);
if(empty($page) or $page < 0) $page = 1;
if($page > $total) $page = $total;
$start = $page * $countposts - $countposts; // Вычисляем начиная с какого номера следует выводить сообщения
$postsel = mysql_query("SELECT * FROM `rze_news` WHERE `INF`=0 ORDER BY `id` DESC LIMIT $start, $countposts"); // Выбираем кол-во сообщений начиная с номера $start

if (!$postsel) { echo "<p>Запрос новостей завершился неудачей.<br /><strong>Код ошибки:</strong></p>";
exit (mysql_error()); }

if (mysql_num_rows($postsel) > 0) {
$mainsel = mysql_fetch_array($postsel);

echo '<table style="font-size:12px;" width="95%" border=0 CELLPADDING=10 CELLSPACING=0>';
do{
    echo '<tr><td>';
    echo '<div id="nwhead"><div style="float:left;font-size:16px;"><b>'.$mainsel[NAME].'</b></div>
	<div style="float:right;font-size:14px;">Дата добавления: '.$mainsel[stamp].'</div></div>';
    echo '<div id="nwcont">';
	if ($mainsel[IMG] != NULL){ echo '<div id="newsimg"><img src="'.$mainsel["IMG"].'" /></div><br />'; }
	echo '<br />'.$mainsel[SHORTTEXT].'<br /><br /><div id="nwcont"><a href="/engine/news/'.$mainsel[ID].'"><div style="color:#32b9ff;">Подробнее -></div></a></div>';
	echo '</td></tr>';
	}
while ($mainsel = mysql_fetch_array($postsel));
echo '</table>';

// Проверяем нужны ли стрелки назад
if ($page != 1) $pervpage = '<a href=?page=1><<</a>  
                               <a href=?page='. ($page - 1) .'><</a> ';  
// Проверяем нужны ли стрелки вперед  
if ($page != $total) $nextpage = ' <a href=?page='. ($page + 1) .'>></a>  
                                   <a href=?page=' .$total. '>>></a>';  

// Находим две ближайшие станицы с обоих краев, если они есть  
if($page - 2 > 0) $page2left = ' <a href=?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';  
if($page - 1 > 0) $page1left = '<a href=?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';  
if($page + 2 <= $total) $page2right = ' | <a href=?page='. ($page + 2) .'>'. ($page + 2) .'</a>';  
if($page + 1 <= $total) $page1right = ' | <a href=?page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 

// Выводим панель переключения
echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;
} else { echo "<p>Новостей ещё нету.</p>"; }
}
?>