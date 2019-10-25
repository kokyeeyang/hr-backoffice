<?php 

//write a function that would print pages showing all content

//first function is to to print out title(breadcrumbs)
// - variables 
//1. <div class="breadcrumb-top">%%Title%%</div>
//2. <span>%%Title%%</span>


//second function is to print out header
//1. 'id'=>'%%table%%-list',
//2. 'action'=>$this->CreateUrl('%%controller%%/%%function%%'),
// - the showall function
//3. <h4 class="widget_title"><?php echo Yii::t('app', '%%Title%% List');
//4. <a href="<?php echo $this->createUrl('%%controller%%/%%function%%'); ">
// - the add new record function
//5. <input type="button" value="%%Title%%">
//6. <?php echo CHtml::hiddenField('mode', '%%Title%%-list');
//7.
// <thead>
	//<th>
		 // <div class="sort_wrapper_inner">
			 // <div class="sort_label_wrapper">
			 	// <div class="sort_label">
			 		// <?php echo Yii::t('app', '%%Column%%'); ?>
				<!-- </div> -->
			<!-- </div> -->
		<!-- </div> -->
	<!-- </th> -->
<!-- </thead> -->

<!-- 8. -->
<!-- <th>
	<div class="sort_wrapper_inner">
		<div class="sort_label_wrapper">
			<div class="sort_label">
				<input type="button" title="<?php //echo Yii::t('app', 'Delete this entry'); ?>" id="delete%%table%%Button" value="Delete selected entries" data-delete-url="<?php //echo $this->createUrl('%%controller%%/%%deleteFunction%%') ?>">
			</div>
		</div>
	</div>
</th> -->


<!-- third function is to print out body -->
<!-- <tbody id="data_table"> -->
	<!-- $arrRecords should go here -->
	<!-- foreach($arrRecords as $intIndex => $objRecord){ -->
	<!-- 	<tr>
			<td>
				<?php $objRecord ?>
			</td>
		</tr> -->
<!-- </tbody> -->


<!-- fourth function for alert messages -->
<!-- <div id="registration-common-msg">
	<div id="msg-select-registration-delete" data-msg="<?php //echo Yii::t('app', '%%message%%'); ?>"></div>
</div> -->
