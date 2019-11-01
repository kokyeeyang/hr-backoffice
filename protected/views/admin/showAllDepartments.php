<!-- <div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php //echo Yii::t('app', 'Show All Departments'); ?></div>
		<div class="breadcrumb-bottom breadcrumb-bottom-key">
			<div class="title">
				<span><?php //echo Yii::t('app', 'All departments'); ?></span>
			</div>
		</div>
	</div>
</div> -->
<?php echo PageHelper::printViewAllHeader($breadcrumbTop, $spanTitle); ?>
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
				<a href="<?php echo $this->createUrl('admin/addNewDepartment'); ?>">
					<input type="button" value="<?php echo Yii::t('app', 'Add new department'); ?>">
				</a>
			</h4>
			-- rewrite this table into a function --
			<?php echo CHtml::hiddenField('mode', 'department-list'); ?>
			<?php echo CHtml::hiddenField('sort_key', $strSortKey); ?>
			<table class="widget_table grid">
				<thead>
					<tr>
						<th>
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_department_desc'){?> desc<?php }elseif($strSortKey === 'sort_department_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_department">
								<a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
								<div class="sort_wrapper_inner">
									<div class="sort_label_wrapper">
										<div class="sort_label">
											<?php echo Yii::t('app', 'Department'); ?>
										</div>
									</div>
									<div class="sort_icon_wrapper">
										<div class="sort_icon">&nbsp;</div>
									</div>
								</div>
							</div>
						</th>
						<th>
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_department_description_desc'){?> desc<?php }elseif($strSortKey === 'sort_department_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_department_description">
								<a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
								<div class="sort_wrapper_inner">
									<div class="sort_label_wrapper">
										<div class="sort_label">
											<?php echo Yii::t('app', 'Description'); ?>
										</div>
									</div>
									<div class="sort_icon_wrapper">
										<div class="sort_icon">&nbsp;</div>
									</div>
								</div>
							</div>
						</th>
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										<input type="button" title="<?php echo Yii::t('app', 'Delete this entry'); ?>" id="deleteDepartmentButton" value="Delete selected entries" data-delete-url="<?php echo $this->createUrl('admin/deleteSelectedDepartments') ?>">
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
						  		<a href="<?php echo $this->createUrl('admin/viewSelectedDepartment', ['departmentId' => $departmentObj->id]); ?>">
							  		<?php echo $departmentObj->title ?>
							  	</a>
						  	</td>
						  	<td>
						  		<?php echo $departmentObj->description ?>
						  	</td>
						  	<td>
						  		<input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox" value="<?php echo $departmentObj->id ?>">
						  	</td>
						  </tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
			<?php
			if(isset($departmentArr[0])){		
				echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/pagination.php', array('objPagination' => $objPagination));
			} // - end: if ?>
		<?php $this->endWidget(); ?>
	</div>
</div>
<div id="registration-common-msg">
	<div id="msg-confirm-department-delete" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to delete the selected departments?'); ?>"><!-- Dialog Buttons Label -->
	</div>
</div>
<div id="registration-common-msg">
	<div id="msg-select-department-delete" data-msg="<?php echo Yii::t('app', 'Please select a department that you would like to delete'); ?>"><!-- Dialog Buttons Label --></div>
</div>