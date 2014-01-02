<?php
define( 'ZX_CMS', true );
define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/' );

define( 'news', true );

session_start(); 
if (isset($_SESSION['connect'])) {

	if ( file_exists( ABSPATH . 'engine/conf.php') ) {
		require_once( ABSPATH . 'engine/conf.php' );
			
		$id				=	$mysqli->real_escape_string(intval(@$_GET[id]));
		$stit			=	$mysqli->real_escape_string($_POST[stitle]);
		$sat			=	$mysqli->real_escape_string($_POST[saut]);
		$sdef			=	$mysqli->real_escape_string($_POST[sact]);
		$stext			=	$mysqli->real_escape_string($_POST[stext]);
		$ftext			=	$mysqli->real_escape_string($_POST[ftext]);
		// $sdescription	=	$mysqli->real_escape_string($_POST[edit_description]);
		// $skwords		=	$mysqli->real_escape_string($_POST[edit_keywords]);
	
		if (isset($_POST['submit'])) {
			if (($stit != NULL) && ($sat != NULL) && ($stext != NULL)) {
				$sesecond	=	$mysqli->query("UPDATE `zx_news` SET `title`='".$stit."',`stext`='".$stext."',`ftext`='".$ftext."',`author`='".$sat."',`def`='".$sdef."' WHERE `id`='".$id."'"); 
				echo '<script>alert("Страница успешно изменена!");</script>';
				$redirurl = '/admin/anews/';
				echo "<script language=\"JavaScript\">\n";
				echo "<!-- \n\n";
				echo "function redirect() { window.location = \"" . $redirurl . "\"; }\n";
				echo "timer = setTimeout('redirect()', '" . ($seconds*1) . "');\n\n";
				echo "-->\n";
				echo "</script>\n";
			} else { echo '<script>alert("Не все поля заполнены!");</script>'; }
		}
		
		require ( '../skin/header'. $tpl_ext);
		echo "<header><h2><span class=\"icon-star\"></span> Страницы сайта</h2>
			<ul class=\"data-header-actions\"><li><a class=\"btn btn-alt btn-inverse\" href=\"/admin/anews/?a=add\">Добавить страницу</a></li></ul>
			</header><section>";
			
		$result		=	$mysqli->query("SELECT `title`, `stext`, `ftext`, `author`, `def` FROM `zx_news` WHERE id=".$id."");
		$sefirst	=	$result->fetch_array();
?>
											<form method="post" class="form-horizontal" name="sedit" action="sedit.php<? echo "?id=".$id; ?>" >
												<fieldset>
													<div class="control-group">
														<label class="control-label" for="input">Название</label>
														<div class="controls">
															<input name="stitle" id="input" class="input-xlarge" type="text" value="<? echo htmlspecialchars($sefirst[title]);?>">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="input">Автор</label>
														<div class="controls">
															<input name="saut" id="input" class="input-xlarge" type="text" value="<? echo htmlspecialchars($sefirst[author]);?>">
															<p class="help-block">Будет выводить ник или имя добавившего</p>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="select">Активность новости (Yes/No)</label>
														<div class="controls">
															<select name="sact" id="select">
																<option value="Y" <?php echo ($sefirst[def] == 'Y') ? 'selected="selected"': ''; ?>>Y</option>
																<option value="N" <?php echo ($sefirst[def] == 'N') ? 'selected="selected"': ''; ?>>N</option>
															</select>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="input">Краткое содержание</label>
														<div class="controls">
															<textarea name="stext" id="textarea3" class="sedittext" placeholder="Введите текст&hellip;" rows="8"><? echo htmlspecialchars($sefirst[stext]); ?></textarea>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="input">Полное содержание</label>
														<div class="controls">
															<textarea name="ftext" id="textarea4" class="sedittext" placeholder="Введите текст&hellip;" rows="8"><? echo htmlspecialchars($sefirst[ftext]); ?></textarea>
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