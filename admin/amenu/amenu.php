<?php
define( 'ZX_CMS', true );
define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/' );
define( 'menu', true );

session_start(); 
if (isset($_SESSION['connect'])) {

	if ( file_exists( ABSPATH . 'engine/conf.php') ) {
		require_once( ABSPATH . 'engine/conf.php' );
		
		$mfile				=	ABSPATH . 'templates/' . $skin . '/menu'. $tpl_ext;
		$contents			=	$_POST[mtext];
	
		if (isset($_POST['submit'])) {
			// if ($contents != NULL) {
			
			file_put_contents($mfile, $contents);
			// if ( is_writable($mfile) ) {
				// $r = fopen($mfile, 'a')
				// if ( $r ) {
					// fwrite($r, $contents);
					// fclose($handle);
				// }
			// }
				echo '<script>alert("Меню успешно изменено!");</script>';
				$redirurl = '/admin/';
				echo "<script language=\"JavaScript\">\n";
				echo "<!-- \n\n";
				echo "function redirect() { window.location = \"" . $redirurl . "\"; }\n";
				echo "timer = setTimeout('redirect()', '" . ($seconds*1) . "');\n\n";
				echo "-->\n";
				echo "</script>\n";
			// } else { echo '<script>alert("Введите код меню!");</script>'; }
		}
		
		require ( '../skin/header'. $tpl_ext);
		echo "<header><h2><span class=\"icon-star\"></span> Меню сайта</h2>
			<ul class=\"data-header-actions\"><li><a class=\"btn btn-alt btn-inverse\" href=\"/admin/amenu/\">Обновить</a></li></ul>
			</header><section>";
?>
											<form method="post" class="form-horizontal" name="sedit" action="amenu.php" >
												<fieldset>
													<div class="control-group">
														<label class="control-label" for="input">Меню</label>
														<div class="controls">
															<textarea name="mtext" id="mtext" rows="20" style="width: 650px; -webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;"><? 
$fobj	=	fopen($mfile, "r");
$text	=	fread($fobj, filesize($mfile));
echo htmlspecialchars($text);
fclose($fobj);
															?></textarea>
														</div>
													</div>
													<div class="form-actions">
														<button name="submit" type="submit" class="btn btn-alt btn-large btn-primary">Сохранить изменения</button>
													</div>
												</fieldset>
											</form>

<?
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
?>