<div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php echo Yii::t('app', 'Admin User Management') . ' - ' . Yii::t('app', 'Add Admin'); ?></div>
		<div class="breadcrumb-bottom breadcrumb-bottom-key">
			<div class="title">
				<span><?php echo Yii::t('app', 'Add Admin'); ?></span>
			</div>
		</div>
	</div>
</div>
<div class="common_content_wrapper admin_form">
	<div class="common_content_inner_wrapper">
		<h4 class="widget_title"><?php echo Yii::t('app', 'Add Admin'); ?></h4>
		<?php $this->renderPartial('_form', array('objModel'=>$objModel)); ?>
	</div>
</div>