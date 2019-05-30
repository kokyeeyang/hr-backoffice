<div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php echo Yii::t('app', 'Candidate User Management') . ' - ' . Yii::t('app', 'Edit Candidates'); ?></div>
		<div class="breadcrumb-bottom breadcrumb-bottom-key">
			<div class="title">
				<span><?php echo Yii::t('app', 'Edit Candidates'); ?></span>
			</div>
		</div>
	</div>
</div>
<div class="common_content_wrapper admin_form">
	<div class="common_content_inner_wrapper">
		<h4 class="widget_title"><?php echo Yii::t('app', 'Edit Candidate'); ?></h4>
		<?php $this->renderPartial('candidateForm'); ?>
	</div>
</div>