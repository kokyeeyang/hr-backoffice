<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Onboarding Checklist'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span><?php echo Yii::t('app', 'Onboarding Checklist'); ?></span>
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
					'id'=>'onboarding-checklist',
					// 'action'=>$this->CreateUrl('training/saveOnboardingChecklist'),
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
				)
			); 
		?>
		<?php ?>
		<h4 class="widget_title"><?php echo Yii::t('app', 'Onboarding Checklist Items for '); ?> <?php echo(EmploymentCandidate::model()->queryForCandidateName($id)) ?>
		<!-- <input type="text" value="" placeholder="<?php // echo Yii::t('app', 'Filter results'); ?>" name="label_filter" id="label_filter" style="width:30%"/> -->
		</h4> 
		<table class="widget_table grid">
			<thead>
				<tr>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Induction Element'); ?>
								</div>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Responsibility'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Date'); ?>
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'Signature'); ?>
								</div>
							</div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody id="data_table">
				<?php
				if(isset($onboardingChecklistArrRecords[0])){
					foreach($onboardingChecklistArrRecords as $intIndex => $objRecord){
				?>
					<tr>
						<td>
							<?php echo TrainingOnboardingItems::model()->queryForOnboardingItem($objRecord->onboarding_item_id); ?>
						</td>
						<td>
							<?php echo TrainingOnboardingItems::model()->queryForResponsibility($objRecord->onboarding_item_id); ?>
						</td>
						<td>
							<?php echo $objRecord->completed_date; ?>
						</td>
						<td>
							<?php //echo $objRecord->full_name ?>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
							<!-- <input check-data-url="<?php //echo $this->createUrl('training/checkForCheckedState') ?>" input type="hidden"> -->
							<input type="checkbox" name="completedCheckBox[]" class="completedCheckBox" id="<?php echo TrainingOnboardingItems::model()->queryForOnboardingItem($objRecord->onboarding_item_id); ?>" value="<?php echo $objRecord->onboarding_item_id ?>" <?php echo($objRecord->completed == 1)?'checked="checked"':'' ?>>
							<input type="checkbox" name="uncompletedCheckBox[]" class="uncompletedCheckBox" id="<?php echo $objRecord->onboarding_item_id ?>" value="<?php echo $objRecord->onboarding_item_id ?>" <?php echo($objRecord->completed == 0)?'checked="checked"':'' ?>>
						</td>
					</tr>
				<?php 
					}
				} 
				?>
			</tbody>
			<tbody id="data_table">
				<input type="button" name="saveChecklistButton" id="saveChecklistButton" data-save-url="<?php echo $this->createUrl('saveOnboardingChecklist',array('id' => $objRecord->candidate_id)) ?>" value="<?php echo Yii::t('app', 'Save'); ?>">
			</tbody>
		</table>  
	<?php $this->endWidget(); ?> 	
	</div>
</div>

<div id="training-common-msg">
	<div id="msg-update-checklist" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to save this checklist?'); ?>"><!-- Dialog Buttons Label --></div>
</div>

<input id="checkedStatus" type="hidden" value="">

<input id="uncheckedStatus" type="hidden" value="">

<p id="demo"></p>