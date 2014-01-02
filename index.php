<?php
define( 'ABSPATH', dirname(__FILE__) . '/' );
define( 'TPL_DIR', ABSPATH . 'templates/' );
define( 'TPL_SMART_DIR', '/templates/' );
define( 'ZX_CMS', true );

if ( file_exists( ABSPATH . 'engine/conf.php') ) {
	require_once( ABSPATH . 'engine/conf.php' );

	$zx_urlexp	=	explode('?',$_SERVER['REQUEST_URI']);
	$zx_murl	=	$zx_urlexp[0];
	$pages		=	$mysqli->query("SELECT `id`, `url`, `name`, `text`, `mdesc`, `mkwords`, `def` FROM `zx_pages` WHERE def='Y' AND url='".$zx_murl."'");
	$pages_arr	=	$pages->fetch_assoc();

	if ( !$pages_arr['id'] ) {
		$pages		=	$mysqli->query("SELECT `id`, `url`, `name`, `text`, `mdesc`, `mkwords`, `def` FROM `zx_pages` WHERE def='Y' AND url='/404/'");
		$pages_arr	=	$pages->fetch_assoc();
	}
	if ($pages_arr['id'] == 1){
		require ( TPL_DIR . $skin.'/header'. $tpl_ext);
		require ( TPL_DIR . $skin.'/menu'. $tpl_ext);
		require ( TPL_DIR . $skin.'/sidebar'. $tpl_ext);
		require ( TPL_DIR . $skin.'/content'. $tpl_ext);
		require ( TPL_DIR . $skin.'/news'. $tpl_ext);
		require ( TPL_DIR . $skin.'/footer'. $tpl_ext);
	} else {
		// include ( ABSPATH . 'news.php' );
		require ( TPL_DIR . $skin.'/header'. $tpl_ext);
		require ( TPL_DIR . $skin.'/menu'. $tpl_ext);
		require ( TPL_DIR . $skin.'/sidebar'. $tpl_ext);
		require ( TPL_DIR . $skin.'/content'. $tpl_ext);
			echo '<div style="padding-bottom: 20px;">'.$pages_arr['text'].'</div>';
		require ( TPL_DIR . $skin.'/footer'. $tpl_ext);
	}

} else {
	// A config file doesn't exist
	// Die with an error message
	die( 'Config Error' );
}