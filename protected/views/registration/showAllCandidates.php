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
		<?php echo CHtml::hiddenField('mode', 'candidate-list'); ?>
		<?php echo CHtml::hiddenField('sort_key', $strSortKey); ?>
		<h4 class="widget_title"><?php echo Yii::t('app', 'Interview Candidates List'); ?>
		<input type="text" value="" placeholder="<?php echo Yii::t('app', 'Filter results'); ?>" name="label_filter" id="label_filter" style="width:30%"/>
		</h4> 
		<table class="widget_table grid">
			<thead>
				<tr>
					<th>
						<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_full_name_desc'){?> desc<?php }elseif($strSortKey === 'sort_full_name_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_full_name">
							<a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
								<div class="sort_wrapper_inner">
									<div class="sort_label_wrapper">
										<div class="sort_label">
											<?php echo Yii::t('app', 'Name'); ?>
										</div>
									</div>
									<div class="sort_icon_wrapper">
										<div class="sort_icon">&nbsp;</div>
									</div>
									<div class="clear"><!--clear--></div>
								</div>
							</a>
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
				if(isset($candidateArrRecord[0])){
					foreach($candidateArrRecord as $intIndex => $objRecord){
				?>
					<tr>
						<td title="<?php echo Yii::t('app', 'Click here to view this candidate'); ?>">
							<a href="<?php echo $this->createUrl('registration/viewSelectedCandidate', array('candidateId' => $objRecord['id_no'])); ?>">
								<?php echo $objRecord['full_name']; ?>
							</a>
						</td>
						<td>
							<?php echo substr($objRecord['created_date'], 0, 10); ?>
						</td>
						<td>
							<select name="positionDropdown" size=1 class="changeCandidatePosition" data-change-url="<?php echo $this->createUrl('registration/changeCandidatePosition', array('candidateId' => $objRecord['id_no'])); ?>" title="Select here if you would like to change this candidate's applied for job">
								<option value="<?php echo($objRecord['job_id']); ?>" selected disabled hidden><?php echo $objRecord['job_title'] ?></option>
								<?php foreach($jobTitleArrRecords as $intIndex => $jobTitleObjRecord){ ?>
									<option value="<?php echo($jobTitleObjRecord['id']); ?>"><?php echo $jobTitleObjRecord['job_title']; ?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<?php echo $objRecord['department'] ?>
						</td>
						<td>
							<?php echo $objRecord['interviewing_manager'] ?>
						</td>
						<td>
							<input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox" value="<?php echo $objRecord['id_no'] ?>">
						</td>
						<td>
							<?php echo $objRecord['candidate_status'] ?>
						</td>
						<td>
							<select name="dropdown" data-confirm-url="<?php echo $this->createUrl('registration/confirmCandidate', array('candidateId' => $objRecord['id_no'])); ?>" size=1>
								<option value="" selected disabled hidden>Choose here</option>
								<?php foreach($candidateStatusArrRecord as $candidateStatusObjRecord){ ?>
						    <option value="<?php echo $candidateStatusObjRecord['id'] ?>"><?php echo $candidateStatusObjRecord['title'] ?></option>
							  <?php } ?>
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
		if(isset($candidateArrRecord[0])){		
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

