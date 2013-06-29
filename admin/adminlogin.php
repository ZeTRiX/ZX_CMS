<?php
define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/' );

if ( file_exists( ABSPATH . 'engine/conf.php') ) {

	require_once( ABSPATH . 'engine/conf.php' );
	session_start();

	$login	=	$_POST['username'];
	$pass	=	$_POST['password'];

	if (isset($login) && isset($pass)) {
		if (($login != NULL) && ($pass != NULL)) {
			if ((ADMIN == $login) && (AUTH_KEY == sha1($pass))) {
				$_SESSION['connect'] = 'true';
				header('Location: adminindex.php');
			} else {
				echo "<div align=\"center\" style=\"color: red\">Ошибка. Неверная комбинация логин-пароль.</div>";
			}
		} else {
				echo "<div align=\"center\" style=\"color: red\">Ошибка. Вы не ввели логин или пароль.</div>";
		}
	}

	if (!isset($_SESSION['connect'])) {
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Вход в Админ-Панель - ZX CMS</title>
<link href="skin/css/lgstyles.css" rel="stylesheet" type="text/css"/>
</head>

<body class='centre' style='margin-top: 15px; text-align: centre; background: #fff; font-family: Tahoma,Verdana,Arial, Sans-serif; font-size: 9pt; color: #666;'>
<div class="topimg"></div>
<div align="center" id='effective-body'>
<table class='not-foldable' background="skin/images/login_panel_gradient.jpg" width=467 height=350><tr><td style='text-align: center'>
<h1 style='font-size: 130%;'>Вход в панель управления</h1>

<p>Текущие дата: <b><? echo date('Y-m-d') ?></b> и время: <b><? echo date('H:i:s') ?></b></p>
<form name="auth" method="post" action="adminlogin.php">
<table>
<tbody>
<tr>
<th style="width: 25%; text-align: right;">Логин: </th>
<td><input type="text" name="username" size="30" maxlength="80"/></td>
</tr>
<tr>
<th style='text-align: right;'>Пароль: </th>
<td><input type="password" name="password" size="30" maxlength="80"/></td>
</tr>
</tbody>
</table><br>
  
<input style='margin-top: 1.5em' type="submit" name="sub" value="Войти"/>
</form>
</center>
</div>
</td></tr></tr></table>

</div></div>
</body></html>

<?php
	} else {
		header('Location: adminindex.php');
	}

} else {
	// A config file doesn't exist
	// Die with an error message
	die( 'Config Error' );
}
?>