<div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php echo Yii::t('app', 'Show All Departments'); ?></div>
		<div class="breadcrumb-bottom breadcrumb-bottom-key">
			<div class="title">
				<span><?php echo Yii::t('app', 'All departments'); ?></span>
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
					'id'=>'departments-list',
					'action'=>$this->CreateUrl('admin/showAllDepartments'),
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
				)
			); 
		?>    	
			<h4 class="widget_title"><?php echo Yii::t('app', 'Departments List'); ?>
			</h4>
			<a href="<?php echo $this->createUrl('admin/addNewDepartment'); ?>">
				<input type="button" value="<?php echo Yii::t('app', 'Add new department'); ?>">
			</a>
			<?php echo CHtml::hiddenField('mode', 'department-list'); ?>
			<?php //echo CHtml::hiddenField('sort_key', $strSortKey); ?>
			<table class="widget_table grid">
				<thead>
					<tr>
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
										<?php echo Yii::t('app', 'Description'); ?>
									</div>
								</div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody id="data_table">
					<?php 
					if(isset($departmentArr[0])){
				  ?>
				  <?php
				  	foreach($departmentArr as $intIndex => $departmentObj){ 
				  ?>
						  <tr>
						  	<td>
						  		<?php echo $departmentObj->department_title ?>
						  	</td>
						  	<td>
						  		<?php echo $departmentObj->department_description ?>
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