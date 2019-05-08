<?php
	header("Content-type: text/css; charset=utf-8");
	$strProtectedDir 	= realpath(dirname(__FILE__).'/../../../../protected');
	$strConfigDir		= $strProtectedDir . '/config';
	$strModelsDir 		= $strProtectedDir . '/models';
	require_once($strConfigDir.'/main.php');
	
	ob_start();
?>
@charset "utf-8";

#site-error #tpl_main {
	background			: none !important;
}

#site-error #tpl_main_wrapper {
	margin				: 0 auto;
	width				: 1012px;
}

#site-error.logined #tpl_main_wrapper {
	margin-left			: 265px;
}

#site-error .main_content_wrapper {
	padding-top			: 20px;
}

#site-error.logined .main_content_wrapper {
	padding-top			: 1px;
	padding-bottom		: 20px;
}

#site-error .common_content_wrapper .common_content_inner_wrapper {
	padding				: 0px !important;
}

#site-error .content_header {
	height				: 5px;
}

#site-error .content_main {
	background					: #428bca;
	border-top-left-radius		: 3px;
	border-top-right-radius		: 3px;
	border-bottom-left-radius	: 3px;
	border-bottom-right-radius	: 3px;
   -moz-border-radius			: 3px;
   -webkit-border-radius		: 3px;
   border-radius				: 3px;	
}

#site-error .content_footer {
	height				: 10px;
}

#site-error .info {
	padding						: 5px 0px 5px 0px;
	font-size					: 15px;
	color						: #fff;
}
<?php
$strContent = str_compress(ob_get_contents());
ob_end_clean();
echo $strContent; ?>