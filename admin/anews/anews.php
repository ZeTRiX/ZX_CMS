<?php
define( 'ZX_CMS', true );
define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/' );
define( 'news', true );

session_start(); 
if (isset($_SESSION['connect'])) {

	if ( file_exists( ABSPATH . 'engine/conf.php') ) {
		require_once( ABSPATH . 'engine/conf.php' );
		if ($_GET) {
			$act	=	mysql_real_escape_string(@$_GET[a]);
			// $act		=	htmlspecialchars($act, ENT_QUOTES, "utf-8");
			// $warn[0] = 	"UPDATE";
			// $warn[1] = 	"SELECT";
			// $warn[2] = 	"DELETE";
			// $act		=	str_replace($warn, "", $action);
			$id		=	mysql_real_escape_string(intval(@$_GET[id]));

			if (($act == 'del') && ($id != NULL)) {
				$sqldel	=	mysql_query("DELETE FROM `zx_news` WHERE id='".$id."'");
				echo "<script type=\"text/javascript\">
				$('.nws".$id."').click(function() {
					$('.nws".$id."').slideUp('slow', function() {
						$(this).remove();
					});
				});
				</script>";
			}
			
			if ($act == 'add') {
				$sqlins	=	mysql_query("INSERT INTO `zx_news` (`title`, `stext`, `ftext`, `author`, `def`) VALUES ('News Name ".rand(99, 999999)."', 'Short Text', 'Full Text.', 'ZeTRiX', 'N')");
			}
		}

	
		require ( '../skin/header'. $tpl_ext);
		echo "<header><h2><span class=\"icon-star\"></span> Новости сайта</h2>
			<ul class=\"data-header-actions\"><li><a class=\"btn btn-alt btn-inverse\" href=\"/admin/anews/?a=add\">Добавить новость</a></li></ul>
			</header><section>";
			
			//INSERT INTO `dbname`.`zx_news` (`id`, `title`, `stext`, `ftext`, `author`, `date`, `def`) VALUES (NULL, 'Тестовая новость', 'Короткий текст тестовой новости', 'Полный текст тестовой новости! Он должен быть длинее короткого.', 'ZeTRiX', CURRENT_TIMESTAMP, 'Y');
			echo '<table class="table table-stripped"><tbody>'; 
			$sql	=	mysql_query("SELECT * FROM `zx_news`"); 
			while ($res = mysql_fetch_array($sql)) { 
				echo '<tr class="nws'.$res[id].'"><td>'; 
				echo $res[id].'</td><td><a href="/news/?id='.$res[id].'" >'.$res[title].'</a> 
					<br>'.$res[ndate].' 
					</td>
					<td><center>[<a href="sedit.php?id='.$res[id].'" >редактировать</a>]</center></td>
					<td><center>[<a href="#openModal'.$res[id].'">удалить</a>]</center></td>';
				echo '</td></tr>';
				/* Модальное окошко подтверждения удаления */
				echo '<div id="openModal'.$res[id].'" class="mDiag">
					<div><a href="#close" title="Закрыть" class="close">X</a>
					<div align="center"><h2>Подтверждение удаления</h2>
					<p>Вы уверены, что хотите удалить эту новость?</p>
					<p><a href="?a=del&id='.$res[id].'">Да</a> | <a href="#close">Нет</a></p>
					</div></div></div>';
			}
			echo '</tbody></table>';
			

		echo "</section>";
		require ( '../skin/footer'. $tpl_ext);


	} else {
		// A config file doesn't exist
		// Die with an error message
		die( 'Config Error' );
	}
} else {
	header('Location: adminlogin.php');
}