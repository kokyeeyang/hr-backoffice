<?php 
//output the content header
echo PageHelper::printFormListingHeader($pageType); 

//output the body content
echo PageHelper::printFormListingBody($pageType, $strSortKey, true, $departmentArr);

//output the alert message
//echo PageHelper::printViewAllHeader($pageType); 
?>



<div class="common_content_wrapper">
	<div class="common_content_inner_wrapper">
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
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_department_description_desc'){?> desc<?php }elseif($strSortKey === 'sort_department_description_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_department_description">
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
				  echo "find out what is inside this object<br/>";
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
			</table> -->
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