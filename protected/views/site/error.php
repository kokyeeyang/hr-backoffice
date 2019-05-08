<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('app', 'Notice');
/*$this->breadcrumbs=array(
	'Error',
);*/
?>
<div class="common_content_wrapper error_form">
	<div class="common_content_inner_wrapper">
		<div class="content_header">&nbsp;</div>
		<div class="content_main">
			<div class="content_main_box">
				<div class="info">
					<center>
						<?php
						if(Yii::app()->user->isGuest === true){ ?>									
							<?php echo Yii::t('app', 'Notice'); ?>: <?php echo Yii::t('app', 'Opps something went wrong! Please try again.'); ?>
						<?php
						}
						else{ ?>
							<h2>Error <?php echo $code; ?></h2>
							<div class="error">
								<?php echo CHtml::encode($message); ?>
							</div>
						<?php
						} // - end: if else ?>								
					</center>		
				</div>
			</div>
		</div>
		<div class="content_footer">&nbsp;</div>
	</div>
</div>