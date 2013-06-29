<?php
if( !defined('ZX_CMS') ) { die('Don\'t hack us, please! That\'s not good!'); }

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );

$skin	=	"default";
$tpl_ext	=	".zxtpl";

require_once(dirname(__FILE__) . '/func.php');