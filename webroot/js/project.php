<?php
	header("Content-type: text/javascript; charset=utf-8");
	define('DIR_WEB_JS', dirname(__FILE__));

	if(is_file(DIR_WEB_JS . '/project.js')){
		echo file_get_contents(DIR_WEB_JS . '/project.js');
	}
	
	if(is_file(DIR_WEB_JS . '/sections/admin.js')){
		echo file_get_contents(DIR_WEB_JS . '/sections/admin.js');
	}
	
	if(is_file(DIR_WEB_JS . '/sections/setting.js')){
		echo file_get_contents(DIR_WEB_JS . '/sections/setting.js');
	}
?>