<div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php echo Yii::t('app', 'Show All Job Openings'); ?></div>
		<div class="breadcrumb-bottom breadcrumb-bottom-people">
			<div class="title">
				<span><?php echo Yii::t('app', 'Job Openings'); ?></span>
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
					'id'=>'jobopening-list',
					'action'=>$this->CreateUrl('registration/showAllJobOpenings'),
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
				)
			); 
		?> 
		<h4 class="widget_title"><?php echo Yii::t('app', 'Job Openings List'); ?>
			<input type="text" value="" placeholder="<?php echo Yii::t('app', 'Filter results'); ?>" name="label_filter" id="label_filter" style="width:30%"/>
		</h4>
		<?php echo CHtml::hiddenField('mode', 'jobopening-list'); ?>
		<table class="widget_table grid">
			<thead>
				<tr>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Job Title'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Department'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Interviewing manager'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Created date'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Email'); ?>
									<input type="text" id="copiedText" value="" style="display:none">
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<input type="button" title="<?php echo Yii::t('app', 'Delete this entry'); ?>" id="deleteJobOpeningButton" value="Delete selected entries" data-delete-url="<?php echo $this->createUrl('registration/deleteSelectedJobOpenings') ?>">
								</div>
							</div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody id="data_table">
				<?php 
					if(isset($arrRecords[0])){
				  ?>
				  <?php
				  	foreach($arrRecords as $intIndex => $objRecord){ 
				  ?>
				  		<tr>
				  			<td>
						  		<?php echo $objRecord->job_title ?>
						  	</td>
						  	<td>
						  		<?php echo $objRecord->department ?>
						  	</td>
						  	<td>
						  		<?php echo $objRecord->interviewing_manager ?>
						  	</td>
						  	<td>
						  		<?php echo $objRecord->created_date ?>
						  	</td>
						  	<td>
								  <input type="button" id="generateEmail" data-email-url="<?php echo $this->createUrl('registration/generateEmail', array('jobId' => $objRecord->id, 'jobTitle' => $objRecord->job_title)); ?>" value="<?php echo Yii::t('app', 'Generate email'); ?>">
						  	</td>
						  	<td>
						  		<input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox" value="<?php echo $objRecord->id ?>">
						  	</td>
				  		</tr>
				  <?php
						}
					}
					?>
			</tbody>
		</table>
		<?php $this->endWidget(); ?> 
	</div>
</div>

<div id="registration-common-msg">
	<div id="msg-select-registration-delete" data-msg="<?php echo Yii::t('app', 'Please select a job opening that you would like to delete'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
	<div id="msg-confirm-registration-delete" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to delete selected job openings?'); ?>"><!-- Dialog Buttons Label --></div>
</div>