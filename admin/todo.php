<?php
define( 'ABSPATH', dirname(__FILE__) . '/' );

if ($_POST['task']) {
	$mfile		=	ABSPATH . 'skin/todo.zxtpl';
	$contents	=	stripslashes($_POST['task']);
	// $contents = str_replace('\n', '<br />', $contents);
	file_put_contents($mfile, $contents);
	die ('OK');
} else {
	die ('Error. Content: <br />' . $contents);
}