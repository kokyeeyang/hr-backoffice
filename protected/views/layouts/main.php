<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<link rel="icon" type="image/x-icon" href="<?php echo HTTP_MEDIA_WEBROOT.'/favicon.ico'; ?>" />
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<meta name="robots" content="noindex"/>
		<meta name="googlebot" content="noindex"/>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
	</head> 
	<body id="<?php echo $this->uniqueid .'-'. (!empty($this->action->Id) ? $this->action->Id : 'error'); ?>" <?php if(Yii::app()->user->isGuest === false){ ?>class="logined"<?php } ?>>
		<div class="outer-wrapper">
			<div class="wrapper">
				<?php
				if(Yii::app()->user->isGuest === false){ ?>
				<div id="header">
					<div id="top_header">
						<?php echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/top_header.php'); ?>
					</div>
				</div>
				<?php
				} // - end: if ?>
				<div id="tpl_main">
					<?php echo $content; ?>
				</div>			
			</div>
		</div>
		<div class="flash_error">
			<?php echo Yii::app()->user->getFlash('flash_error'); ?>
		</div>
		<div class="flash_alert">
			<?php echo Yii::app()->user->getFlash('flash_alert'); ?>
		</div>		
		<div id="common-msg" style="display:none">
			<div id="dialog-buttons-label" rel="<?php echo Yii::t('app', 'Confirm') . '|' . Yii::t('app', 'Cancel'); ?>"><!-- Dialog Buttons Label --></div>
			<div id="dialog-error" title="<?php echo Yii::t('app', 'Notice'); ?>"><?php echo Yii::t('app', 'Operation failed, please try again later.'); ?></div>
			<div id="dialog-confirm" title="<?php echo Yii::t('app', 'Notice'); ?>"><?php echo Yii::t('app', 'Confirm to proceed with this operation?'); ?></div>
			<div id="dialog-message" title="<?php echo Yii::t('app', 'Notice'); ?>"><!--messages--></div>		
			<div class="msg_operation_failed" rel="<?php echo Yii::t('app', 'Operation failed, please try again later.'); ?>"></div>
			<div class="msg_required_login" rel="<?php echo Yii::t('app', 'Operation failed, please login again to try.'); ?>"></div>
			<div class="msg_loading_img"><img src="<?php echo HTTP_MEDIA_CURRENT_THEME . '/images/alllanguages/loading.gif';?>" border="0" alt="" /></div>
			<div class="msg_loading"><?php echo Yii::t('app', 'Loading...'); ?></div>
			<div class="msg_coming_soon" rel="<?php echo Yii::t('app', 'Coming Soon'); ?>"></div>
			<div class="msg_report_range_day" rel="<?php echo Yii::t('app', 'Date range should not exceed [#day#] day(s).'); ?>"></div>
			<div class="msg_void" rel="<?php echo Yii::t('app', 'Void'); ?>"></div>
		</div>	
	</body>
</html>