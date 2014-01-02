<?php
define( 'ZX_CMS_ADM', true );
define( 'ZX_CMS', true );
define( 'ATPL_DIR', dirname(__FILE__) . '/skin/' );
define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/' );

define( 'pages', true );

session_start(); 
if (isset($_SESSION['connect'])) {

	if ( file_exists( ABSPATH . 'engine/conf.php') ) {
		require_once( ABSPATH . 'engine/conf.php' );
		if ($_GET) {
			$act	=	$mysqli->real_escape_string(@$_GET[a]);
			// $act		=	htmlspecialchars($act, ENT_QUOTES, "utf-8");
			// $warn[0] = 	"UPDATE";
			// $warn[1] = 	"SELECT";
			// $warn[2] = 	"DELETE";
			// $act		=	str_replace($warn, "", $action);
			$id		=	$mysqli->real_escape_string(intval(@$_GET[id]));

			if ($act == 'exit') {
				destroySession();
				@header('Location: adminlogin.php');
				exit;
			}

			if (($act == 'del') && ($id != NULL)) {
				$sqldel	=	$mysqli->query("DELETE FROM `zx_pages` WHERE id='".$id."'");
			}
			
			if ($act == 'add') {
				$sqlins	=	$mysqli->query("INSERT INTO `zx_pages` (`url`, `name`, `text`, `mdesc`, `mkwords`, `def`) VALUES ('/".rand(99, 999999)."/', 'Sample', 'Sample', 'Sample', 'Sample', 'N')");
			}
		}

		require ( ATPL_DIR .'/header'. $tpl_ext);
		echo "<header><h2><span class=\"icon-star\"></span> Страницы сайта</h2>
			<ul class=\"data-header-actions\"><li><a class=\"btn btn-alt btn-inverse\" href=\"?a=add\">Добавить страницу</a></li></ul>
			</header><section>";
			
			
			echo '<table class="table table-stripped"><tbody>'; 
			$sql	=	$mysqli->query("SELECT * FROM `zx_pages`") or die($mysqli->error); 
			while ($res = $sql->fetch_array()) { 
				echo '<tr class="pgc'.$res[id].'"><td>'; 
				echo $res[id].'</td><td><a href="'.$res[url].'" >'.$res[name].'</a> 
					<br>'.$res[url].'
					</td>
					<td><center>[<a href="apages/sedit.php?id='.$res[id].'" >редактировать</a>]</center></td>
					<td><center>[<a href="#om'.$res[id].'">удалить</a>]</center></td>';
				echo '</td></tr>';
				/* Модальное окошко подтверждения удаления */
				echo '<div id="om'.$res[id].'" class="mDiag">
					<div><a href="#close" title="Закрыть" class="close">X</a>
					<div align="center"><h2>Подтверждение удаления</h2>
					<p>Вы уверены, что хотите удалить эту страницу?</p>
					<p><input type="button" id="mDbt" value="Да" onclick="location.href=\'?a=del&id='.$res[id].'\';" />
					<input type="button" id="mDbt" value="Нет" onclick="location.href=\'#close\';" /></p>
					</div></div></div>';
			}
			echo '</tbody></table>';
			

		echo "</section>";
		require ( ATPL_DIR .'/footer'. $tpl_ext);


	} else {
		// A config file doesn't exist
		// Die with an error message
		die( 'Config Error' );
	}
} else {
	header('Location: adminlogin.php');
}

function destroySession() {
    if ( session_id() ) {
        session_unset();
        setcookie(session_name(), session_id(), time()-60*60*24);
        session_destroy();
    }
}