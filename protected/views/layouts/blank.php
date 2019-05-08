<?php $this->beginContent('//layouts/blank_main'); ?>
<div id="tpl_main_wrapper" style="margin-left:0px">
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