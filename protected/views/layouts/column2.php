<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php
if(Yii::app()->user->isGuest === false){ ?>
<div id="tpl_left_wrapper">
	<div class="tpl_left_wrapper_content">
		<center><?php echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/left_nav.php'); ?></center>
	</div>
</div>
<?php
} // - end: if ?>
<div id="tpl_main_wrapper">
	<div class="tpl_main_wrapper_content">
		<div id="main_content">
			<div class="main_content_wrapper">
			<?php 
				echo $content;
			?>									
			</div>
		</div>
		<?php
		if(Yii::app()->user->isGuest === false){ ?>							
		<div class="footer">
			<center><?php echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/footer.php'); ?></center>
		</div>
		<?php
		} // - end: if ?>
	</div>
	<div class="clear"><!--Clear--></div>
</div>
<div class="clear"><!--Clear--></div>
<?php $this->endContent(); ?>