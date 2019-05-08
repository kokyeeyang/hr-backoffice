<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('app', 'Login');
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="login_panel">
    <div class="login_panel_linner">
        <form name="login_form" id="login_form" autocomplete="off" action="<?php echo $this->createUrl('site/login');?>" method="post" enctype="multipart/form-data">
			<input type="hidden" value="<?php echo LANG; ?>" name="lang"/>	
            <div class="input_wrapper login-alert">
				<div id="login-error-message" rel="<?php if(isset($objError -> arrKeyError)){ foreach($objError -> arrKeyError as $key => $message){ echo $key . '|' . $message . '|'; } } ?>"><!-- Error Messages --></div>
				<div id="login-message" rel="<?php if(isset($arrMessage) && count($arrMessage) == 2){ echo $arrMessage['title'] . '|' . $arrMessage['message']; } ?>"><!-- Messages --></div>
            </div>
			<div class="item_row animate0 bounceIn logo"><center><img src="<?php echo HTTP_MEDIA_IMAGES . '/alllanguages/site_logo.png?sv='.SITE_VERSION;?>" alt="" /></center></div>
            <div class="item_row input_wrapper animate1 bounceIn">
                <input placeholder="<?php echo Yii::t('app', 'Username'); ?>" type="text" value="<?php echo(isset($strUsername)?$strUsername:'');?>" name="login_username" id="login_username" />
            </div>
            <div class="item_row input_wrapper animate2 bounceIn">
				<input placeholder="<?php echo Yii::t('app', 'Password'); ?>" type="password" value="" name="login_password" id="login_password" />
            </div>
			<div class="item_row input_wrapper animate3 bounceIn login_captcha_input" style="display:<?php echo $visibility ?>">
				<input placeholder="<?php echo Yii::t('app', 'Verification Code'); ?>" type="text" name="login_captcha" id="login_captcha" size="10" />
			</div>
			<div class="item_row animate4 bounceIn login_captcha_img" style="display:<?php echo $visibility ?>">
				<a href="javascript:void(0);" title="<?php echo Yii::t('app', 'Refresh Verification Code'); ?>"><img id="login_captcha_img" src="<?php echo $this->createUrl('site/captcha');?>" border="0" alt="<?php echo Yii::t('app', 'Refresh Verification Code'); ?>" title="<?php echo Yii::t('app', 'Refresh Verification Code'); ?>" /></a>		
			</div>			
            <div class="item_row input_wrapper animate5 bounceIn">
                 <button id="btnLoginSubmit"><?php echo Yii::t('app', 'Login'); ?></button>
            </div> 
        </form>
    </div><!--loginpanelinner-->	
</div><!--loginpanel-->
