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
									<?php echo Yii::t('app', 'Line manager'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<input type="button" title="<?php echo Yii::t('app', 'Delete this entry'); ?>" id="deleteCandidateButton" value="Delete selected entries" data-delete-url="<?php echo $this->createUrl('registration/deleteSelectedCandidates') ?>">
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
				</tr>
			</thead>
			<tbody id="data_table">
				<?php
				if(isset($candidateArrRecords[0])){
					foreach($candidateArrRecords as $intIndex => $objRecord){
				?>
					<tr>
						<td title="<?php echo Yii::t('app', 'Click here to view this candidate'); ?>">
							<a href="<?php echo $this->createUrl('registration/viewSelectedCandidate', array('candidateId' => $objRecord->id_no)); ?>">
								<?php echo $objRecord->full_name; ?>
							</a>
						</td>
						<td>
							<?php echo substr($objRecord->created_date, 0, 10); ?>
						</td>
						<td>
							<select name="positionDropdown" size=1 class="changeCandidatePosition" data-change-url="<?php echo $this->createUrl('registration/changeCandidatePosition', array('candidateId' => $objRecord->id_no)); ?>" title="Select here if you would like to change this candidate's applied for job">
								 <option value="<?php echo($objRecord->job_id); ?>" selected disabled hidden><?php echo EmploymentJobOpening::model()->queryForCandidateInformation($objRecord->job_id, EmploymentJobOpeningEnum::CANDIDATE_JOB, EmploymentJobOpeningEnum::ID); ?></option>
								<?php foreach($jobTitleArrRecords as $intIndex => $jobTitleObjRecord){ ?>
									<option value="<?php echo($jobTitleObjRecord['id']); ?>"><?php echo $jobTitleObjRecord['job_title']; ?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<?php //echo EmploymentJobOpening::model()->queryForCandidateDepartment($objRecord->job_id); ?>
							<?php echo EmploymentJobOpening::model()->queryForCandidateInformation($objRecord->job_id, EmploymentJobOpeningEnum::DEPARTMENT, EmploymentJobOpeningEnum::ID); ?>
						</td>
						<td>
							<?php //echo EmploymentJobOpening::model()->queryForCandidateInterviewingManager($objRecord->job_id); ?>
							<?php echo EmploymentJobOpening::model()->queryForCandidateInformation($objRecord->job_id, EmploymentJobOpeningEnum::INTERVIEWING_MANAGER, EmploymentJobOpeningEnum::ID); ?>
						</td>
						<td>
							<input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox" value="<?php echo $objRecord->id_no ?>">
						</td>
						<td>
							<?php echo EmploymentCandidate::model()->queryForCandidateStatus($objRecord->id_no); ?>
						</td>
						<td>
							<select name="dropdown" data-confirm-url="<?php echo $this->createUrl('registration/confirmCandidate', array('candidateId' => $objRecord->id_no)); ?>" size=1>
								<option value="" selected disabled hidden>Choose here</option>
						    <option value="1">Accepted</option>
						    <option value="2">Shortlisted</option>
						    <option value="3">No Show</option>
						    <option value="4">Not Suitable</option>
						    <option value="5">Rescheduled</option>
						    <option value="6" title="This will generate onboarding checklist for this candidate">Offer letter signed</option>
						    <option value="7">Offer letter generated</option>
							</select>
						</td>
					</tr>
				<?php 
					}
				} 
				?>
			</tbody>
		</table> 
		<?php
		if(isset($candidateArrRecords[0])){		
			echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/pagination.php', array('objPagination' => $objPagination));
		} // - end: if ?>	 
	<?php $this->endWidget(); ?> 	
	</div>
</div>

<div id="registration-common-msg">
	<div id="msg-select-registration-delete" data-msg="<?php echo Yii::t('app', 'Please select a candidate that you would like to delete'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
	<div id="msg-confirm-registration-delete" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to delete the selected candidates?'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
	<div id="msg-confirm-candidate" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to change this candidate\'s status?'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
	<div id="msg-confirm-change" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to change this candidate\'s applied for job?'); ?>"><!-- Dialog Buttons Label --></div>
</div>

