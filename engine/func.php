<?php
if( !defined('ZX_CMS') ) { die('Don\'t hack us, please! That\'s not good!'); }

function meta_head($pages_arr) {
	$charset	=	"UTF-8";
	echo '<meta http-equiv="content-type" content="text/html; charset='.$charset.'" />';
	echo '<title>'.$pages_arr['name'].'</title>';
	echo '<meta name="keywords" content="'.$pages_arr['mkwords'].'" />';
	echo '<meta name="description" content="'.$pages_arr['mdesc'].'" />';
}

function f_news($mysqli) {
	// Количество новостей на странице
	$on_page = 6;
	
	$count_records = 0;
	if ($res = $mysqli->query("SELECT * FROM `zx_news` ORDER BY `id`")) {
		$count_records = $res->num_rows;
		$res->close();
	}

	// Получаем количество страниц
	// Делим количество записей на количество новостей на странице
	// и округляем в большую сторону
	$num_pages = ceil($count_records / $on_page);

	// Текущая страница из GET-параметра page
	// Если параметр не определен, то текущая страница равна 1
	$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	
	// Если текущая страница меньше единицы, то страница равна 1
	if ($current_page < 1)
	{
		$current_page = 1;
	}
	// Если текущая страница больше общего количества страница, то
	// текущая страница равна количеству страниц
	elseif ($current_page > $num_pages)
	{
		$current_page = $num_pages;
	}

	// Начать получение данных от числа (текущая страница - 1) * количество записей на странице
	$start_from = ($current_page - 1) * $on_page;

	// Формат оператора LIMIT <ЗАПИСЬ ОТ>, <КОЛИЧЕСТВО ЗАПИСЕЙ>
	$res = $mysqli->query("SELECT `id`, `date`, `title`, `stext` FROM `zx_news` WHERE `def`='Y' ORDER BY `id` DESC LIMIT $start_from, $on_page");
	if (!$res) { echo "<p>Запрос новостей завершился неудачей.<br /><strong>Код ошибки:</strong></p>";
	exit ($mysqli->error); }

	// Вывод результатов
	echo '<ul class="cbp_tmtimeline">';
	while ($row = $res->fetch_assoc())
	{
		echo '<li>';
		$timestamp = explode(" ", $row['date']);
		echo '<time class="cbp_tmtime" datetime="'.$row['date'].'"><span>'.$timestamp[0].'</span> <span>'.$timestamp[1].'</span></time>';
		echo '<div class="cbp_tmicon cbp_tmicon-phone"></div>';
		echo '<div class="cbp_tmlabel">';
		echo '<h2>'.$row['title'].'</h2>';
		echo '<p>'.$row['stext'].'</p>';
		echo '</div></li>';
	}
	echo '</ul>';

	// Вывод списка страниц
	echo '<p style="padding-bottom: 20px;">';
	for ($page = 1; $page <= $num_pages; $page++)
	{
		if ($page == $current_page)
		{
        echo '<strong>'.$page.'</strong> &nbsp;';
		} else {
			echo '<a href="pages.php?page='.$page.'">'.$page.'</a> &nbsp;';
		}
	}
	echo '</p>';
}