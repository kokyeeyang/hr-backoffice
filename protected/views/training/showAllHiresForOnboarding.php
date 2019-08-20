<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Add New Hire'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span><?php echo Yii::t('app', 'All new hires'); ?></span>
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
					'id'=>'hire-list',
					'action'=>$this->CreateUrl('training/showAllHiresForOnboarding'),
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
								</div>
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
									<?php echo Yii::t('app', 'Name'); ?>
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
									<input type="button" title="<?php echo Yii::t('app', 'Delete this entry'); ?>" id="deleteJobOpeningButton" value="Delete selected entries" data-delete-url="<?php echo $this->createUrl('registration/deleteSelectedCandidates') ?>">
								</div>
							</div>
						</div>
					</th>
					<th>
						<div class="sort_wrapper_inner">
							<div class="sort_label_wrapper">
								<div class="sort_label">
									<?php echo Yii::t('app', 'View this onboarding checklist'); ?>
								</div>
							</div>
						</div>
					</th>
				</tr>
			</thead>
			<tbody id="data_table">
				<?php
				if(isset($hireArrRecords[0])){
					foreach($hireArrRecords as $intIndex => $objRecord){
				?>
					<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
							<?php echo $objRecord->full_name ?>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
							<input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox" value="<?php echo $objRecord->id_no ?>">
						</td>
						<td>
							<input type="button" data-view-url="<?php echo $this->createUrl('training/viewSelectedOnboardingChecklist', array('id' => $objRecord->id_no)); ?>" name="editChecklistButton" id="viewSelectedChecklistButton" value="<?php echo Yii::t('app', 'View'); ?>">
							</div>
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