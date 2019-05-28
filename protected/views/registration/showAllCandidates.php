<div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php echo Yii::t('app', 'Show All Candidates'); ?></div>
		<div class="breadcrumb-bottom breadcrumb-bottom-key">
			<div class="title">
				<span><?php echo Yii::t('app', 'Candidates'); ?></span>
			</div>
		</div>
	</div>
</div>
<div class="common_content_wrapper admin_list">
	<div class="common_content_inner_wrapper">
		<?php 
			$objForm = $this->beginWidget(
				'CActiveForm', 
				array(
					'id'=>'whitelistip-list',
					'action'=>$this->CreateUrl('registration/showAllCandidates'),
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
				)
			); 
		?>
		<h4 class="widget_title"><?php echo Yii::t('app', 'Interview Candidates List'); ?>
		<input type="text" value="" placeholder="<?php echo Yii::t('app', 'Filter results'); ?>" name="label_filter" id="label_filter" style="width:30%"/>
		</h4> 
		<?php echo CHtml::hiddenField('mode', 'whitelistip-list'); ?>
		<?php echo CHtml::hiddenField('sort_key', $strSortKey); ?>
		<table class="widget_table grid">
			<thead>
				<tr>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Name'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Created Date'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Interview Manager'); ?>
								</div>
							</div>
						</div>
					</th>
				</tr>
			</thead>
		</table>  
	<?php $this->endWidget(); ?> 	
	</div>
</div>