<div class="logo"><img alt="" src="<?php echo HTTP_MEDIA_CURRENT_THEME . '/images/alllanguages/site_logo.png'; ?>" /></div>
<div class="header_inner">
	<ul class="head_menu">
		<li class="odd">
			<a class="admin_logout" rel="<?php echo $this->createUrl('site/logout');?>">
				<span class="head-icon head-admin-logout"></span>
				<span class="headmenu-label"><?php echo Yii::t('app', 'Logout'); ?></span>
			</a>
		</li>
		<li class="clear"><!--Clear--></li>
	</ul><!--headmenu-->
</div>
<div class="header_right">
	<ul class="admin_info">
		<?php
		if(isset(Yii::app()->user->display_name)){ ?>
		<li class="admin_name"><a href="javascript:void(0);"><?php echo Yii::t('app', 'User') . ': ' . Yii::app()->user->display_name; ?></a></li>
		<?php
		} // end: if ?>
		<?php
		if(isset(Yii::app()->user->last_login)){ ?>
		<li class="admin_last_login"><a href="javascript:void(0);"><?php echo Yii::t('app', 'Last Login') . ': ' . Yii::app()->user->last_login; ?></a></li>
		<?php
		} // end: if ?>
		<li class="theme">
			<?php echo CHtml::dropDownList('theme', THEME, Controller::$arrThemes, ['rel' => $this->createUrl('site/welcome'), 'style' => 'width:200px']); ?>
		</li>
	</ul>
</div>
<div class="clear"><!--Clear--></div>		