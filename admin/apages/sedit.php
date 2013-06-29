<?php
define( 'ZX_CMS', true );
define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/' );

define( 'pages', true );

session_start(); 
if (isset($_SESSION['connect'])) {

	if ( file_exists( ABSPATH . 'engine/conf.php') ) {
		require_once( ABSPATH . 'engine/conf.php' );
			
		$id				=	mysql_real_escape_string(intval(@$_GET[id]));
		$surlid			=	mysql_real_escape_string($_POST[surl]);
		$stitle			=	mysql_real_escape_string($_POST[sname]);
		$sdef			=	mysql_real_escape_string($_POST[sact]);
		$stext			=	mysql_real_escape_string($_POST[stext]);
		// $sdescription	=	mysql_real_escape_string($_POST[edit_description]);
		// $skwords		=	mysql_real_escape_string($_POST[edit_keywords]);
	
		if (isset($_POST['submit'])) {
			if (($surlid != NULL) && ($stitle != NULL) && ($stext != NULL)) {
				$sesecond	=	mysql_query("UPDATE `zx_pages` SET `url`='".$surlid."',`name`='".$stitle."',`text`='".$stext."',`def`='".$sdef."' WHERE `id`='".$id."'"); 
				echo '<script>alert("Страница успешно изменена!");</script>';
				$redirurl = '/admin/';
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
			<ul class=\"data-header-actions\"><li><a class=\"btn btn-alt btn-inverse\" href=\"/admin/?a=add\">Добавить страницу</a></li></ul>
			</header><section>";
			
		$sefirst	=	mysql_fetch_array(mysql_query("SELECT `url`, `name`, `text`, `def` FROM `zx_pages` WHERE id=".$id.""));
?>
											<form method="post" class="form-horizontal" name="sedit" action="sedit.php<? echo "?id=".$id; ?>" >
												<fieldset>
													<div class="control-group">
														<label class="control-label" for="input">URL страницы</label>
														<div class="controls">
															<input name="surl" id="input" class="input-xlarge" type="text" value="<? echo htmlspecialchars($sefirst[url]);?>">
															<p class="help-block">Обязательно должен начинаться и заканчиваться слешем (/)</p>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="input">Название</label>
														<div class="controls">
															<input name="sname" id="input" class="input-xlarge" type="text" value="<? echo htmlspecialchars($sefirst[name]);?>">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="select">Активность страницы (Yes/No)</label>
														<div class="controls">
															<select name="sact" id="select">
																<option value="Y" <?php echo ($sefirst[def] == 'Y') ? 'selected="selected"': ''; ?>>Y</option>
																<option value="N" <?php echo ($sefirst[def] == 'N') ? 'selected="selected"': ''; ?>>N</option>
															</select>
														</div>
													</div>
													<div class="control-group">
														<div class="controls">
															<textarea name="stext" id="textarea3" class="sedittext" placeholder="Введите текст&hellip;" rows="8"><? echo htmlspecialchars($sefirst[text]); ?></textarea>
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