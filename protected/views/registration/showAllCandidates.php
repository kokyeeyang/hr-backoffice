<div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php echo Yii::t('app', 'Show All Candidates'); ?></div>
		<div class="breadcrumb-bottom breadcrumb-bottom-people">
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
					'id'=>'candidate-list',
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
									<?php echo Yii::t('app', 'Job'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Interviewer'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<input type="button" title="<?php echo Yii::t('app', 'Delete this entry'); ?>" id="deleteJobOpeningButton" value="Delete selected entries" data-delete-url="<?php echo $this->createUrl('registration/deleteSelectedCandidates') ?>">
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Candidate Status'); ?>
								</div>
							</div>
						</div>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Confirm'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'View this candidate'); ?>
								</div>
							</div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody id="data_table">
				<?php
				if(isset($candidateArrRecords[0])){
					foreach($candidateArrRecords as $intIndex => $objRecord){
				?>
					<tr>
						<td>
							<?php echo $objRecord->full_name; ?>
						</td>
						<td>
							<?php echo substr($objRecord->created_date, 0, 10); ?>
						</td>
						<td>
							<?php echo EmploymentJobOpening::model()->queryForCandidateJob($objRecord->job_id); ?>
						</td>
						<td>
							<?php echo EmploymentJobOpening::model()->queryForCandidateInterviewingManager($objRecord->job_id); ?>
						</td>
						<td>
							<input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox" value="<?php echo $objRecord->id_no ?>">
						</td>
						<td>
							<?php echo EmploymentCandidate::model()->queryForCandidateStatus($objRecord->id_no); ?>
						</td>
						<td>
							<input type="button" data-confirm-url="<?php echo $this->createUrl('registration/confirmCandidate', array('id' => $objRecord->id_no)); ?>" name="confirmCandidateButton" value="<?php echo Yii::t('app', 'Confirm'); ?>">
						</td>
						<td>
							<input type="button" data-view-url="<?php echo $this->createUrl('registration/viewSelectedCandidate', array('id' => $objRecord->id_no)); ?>" name="editCandidateButton" id="viewSelectedCandidateButton" value="<?php echo Yii::t('app', 'View'); ?>">
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
	<div id="msg-select-registration-delete" data-msg="<?php echo Yii::t('app', 'Please select a candidate that you would like to delete'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
	<div id="msg-confirm-registration-delete" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to delete the selected candidates?'); ?>"><!-- Dialog Buttons Label --></div>
</div>