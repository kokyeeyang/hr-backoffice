<?php 

//write a function that would print pages showing all content

//first function is to to print out title(breadcrumbs)
// - variables 
//1. <div class="breadcrumb-top"><?php echo Yii::t('app', 'Show All Departments'); ></div>
//2. <div class="breadcrumb-bottom breadcrumb-bottom-people">
//3. <span><?php echo Yii::t('app', 'Candidates'); ></span>
// first function -END 


//second function is to print out table
//1. 'id'=>'departments-list',
//2. 'action'=>$this->CreateUrl('admin/showAllDepartments'),
//3. <h4 class="widget_title"><?php echo Yii::t('app', 'Departments List'); >
//4. <a href="<?php echo $this->createUrl('admin/addNewDepartment'); >">
	// 	<input type="button" value="<?php //echo Yii::t('app', 'Add new department'); >">
	// </a>
//6. <?php echo CHtml::hiddenField('mode', '%%Title%%-list');
//6.1 <?php echo CHtml::hiddenField('sort_key', $strSortKey); >
// 7. <div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_department_desc'){> desc<?php }elseif($strSortKey === 'sort_department_asc'){ > asc<?php } >" rel="sort" rev="sort_department">
// 								<a title="<?php echo Yii::t('app', 'Sort'); >" href="javascript:void(0);">
// 								<div class="sort_wrapper_inner">
// 									<div class="sort_label_wrapper">
// 										<div class="sort_label">
// 											<?php echo Yii::t('app', 'Department'); >
// 										</div>
// 									</div>
// 									<div class="sort_icon_wrapper">
// 										<div class="sort_icon">&nbsp;</div>
// 									</div>
// 								</div>
// 							</div>
//8.
// <thead>
	//<th>
		 // <div class="sort_wrapper_inner">
			 // <div class="sort_label_wrapper">
			 	// <div class="sort_label">
			 		// <?php echo Yii::t('app', '%%Column%%'); >
				// </div> -->
			// </div> -->
		// </div> -->
	// </th> -->
// </thead> -->

//9. -->
// <th>
// 	<div class="sort_wrapper_inner">
// 		<div class="sort_label_wrapper">
// 			<div class="sort_label">
// 				<input type="button" title="<?php //echo Yii::t('app', 'Delete this entry'); >" id="delete%%table%%Button" value="Delete selected entries" data-delete-url="<?php //echo $this->createUrl('%%controller%%/%%deleteFunction%%') >">
// 			</div>
// 		</div>
// 	</div>
// </th>


// 10.
// <tbody id="data_table">
// $arrRecords should go here
	// foreach($arrRecords as $intIndex => $objRecord){
	// <tr>
// 		<td>
//      <a href="<?php echo $this->createUrl('admin/viewSelectedDepartment', ['departmentId' => $departmentObj->id]); >">
//    		<?php $objRecord->title >
//      </a>
// 		</td>
//		<td>
//				<?php echo $departmentObj->description >
//		</td>
//	  <td>
//	  	<input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox" value="<?php echo $departmentObj->id >">
//	  </td>
// 	 </tr>
// </tbody>

// 10. inside controller
// for sorting to work, the viewpage has to be json encoded
// instead of json_encode viewpage, we json_encode the three functions that echo the viewpage
// second function -END 

// <!-- third function for alert messages -->
// <!-- <div id="registration-common-msg">
// 	<div id="msg-select-registration-delete" data-msg="<?php //echo Yii::t('app', '%%message%%'); >"></div>
// </div> -->
// third function -END
