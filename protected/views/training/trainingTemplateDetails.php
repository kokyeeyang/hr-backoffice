<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo $header; ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-people">
      <div class="title">
        <span><?php echo $header; ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <form method="post" enctype="multipart/form-data" id="trainingTemplateForm" name="trainingTemplateForm" action="<?php echo $formAction; ?>">
      <div id="offer-letter-template-input" style="margin-bottom:10px; margin-top: 10px;">
	<input type="hidden" id="hiddenVal" value="0"/>
	<input type="hidden" name="templateId" value="<?php echo isset($templateId) ? $templateId : ''; ?>">
	<fieldset class="fieldset">
	  <legend class="legend">
	    <?php echo Yii::t('app', '1.  Template details'); ?>
	  </legend>
	  <div class="grid_block">
	    <div class="lable_block">
	      <div class="lables">	      
		<span><?php echo Yii::t('app', 'Training Template Title'); ?> </span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span>
		  <?php isset($templateId) ? $templateTitle = $trainingTemplateObjRecord['title'] : $templateTitle = '' ?>
		  <input type="text" name="templateTitle" id="templateTitle" value="<?php echo $templateTitle; ?>"/>
		</span>
	      </div>
	    </div>
	    <div class="lable_block">
	      <div class="lables">
		<span><?php echo Yii::t('app', 'Description'); ?> </span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span>
		  <?php isset($templateId) ? $templateDescription = $trainingTemplateObjRecord['description'] : $templateDescription = '' ?>
		  <textarea name="templateDescription" id="templateDescription" rows="3" cols="22"><?php echo $templateDescription; ?></textarea>
		</span>
	      </div>
	    </div>
	  </div>
	</fieldset>
	<fieldset class="fieldset">
	  <legend class="legend" title="<?php echo Yii::t('app', 'Which department(s) is this training template for?'); ?>">
	    <?php echo Yii::t('app', '2. Department'); ?>
	  </legend>
	  <div id="department-dropdown" style="margin-top: 10px; margin-bottom: 10px;">
	    <?php foreach ($departmentArr as $iKey => $departmentObj) { ?>
		<?php $checkedStatus = preg_match("/" . $departmentObj['title'] . "/", $trainingTemplateObjRecord['department']) ? 'checked' : '' ?>
    	    <input type="checkbox" name="department[]" value="<?php echo $departmentObj['id']; ?>" class="department-dropdown" id="<?php echo $departmentObj['title']; ?>" <?php echo $checkedStatus; ?> >
    	    <label for="<?php echo $departmentObj['title']; ?>"><?php echo $departmentObj['title']; ?></label>
	    <?php } ?>
	  </div>
	</fieldset>
	<fieldset class="fieldset">
	  <legend class="legend">
	    <?php echo Yii::t('app', '3. Add more training items '); ?>
	  </legend>
	  <table class="widget_table grid">
	    <thead>
	      <tr>
		<th>
		  <div class="sort_wrapper_inner">
		    <div class="sort_label_wrapper">
		      <div class="sort_label">
			<?php echo Yii::t('app', 'Title'); ?>
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
		</th>
	      </tr>
	    </thead>
	    <tbody id="data_table">
	      <?php
	      $counter = 0;
	      if (isset($trainingItemArrRecord)) {
		  ?>
		  <?php foreach ($trainingItemsInTemplate as $trainingItemInTemplate) { ?>
		      <tr class="trainingItemTr">
			<td class="trainingItemTd">
			  <select name="trainingItemDropdown <?php echo $counter; ?>" size=1 class="selectTrainingItemTitle" data-render-url="<?php echo $_SERVER['PHP_SELF']; ?>">
			    <option value="">Choose here</option>
			    <?php foreach ($trainingItemTitleArrRecord as $intIndex => $trainingItemTitleObjRecord) { ?>
				<?php $trainingItemTitleObjRecord['title'] === $trainingItemInTemplate['title'] ? $selected = "selected" : $selected = ''; ?>
	    		    <option value="<?php echo $trainingItemTitleObjRecord['id']; ?>" <?php echo $selected; ?>>
				  <?php echo $trainingItemTitleObjRecord['title']; ?>
	    		    </option>
			    <?php } ?>
			  </select>
			</td>
			<td class="itemDescription">
			  <?php echo $trainingItemInTemplate['description']; ?>
			</td>
			<td class="itemResponsibility">
			  <?php echo $trainingItemInTemplate['responsibility']; ?>
			</td>
			<td class="removeTrainingItemButton">
			  <a href="#"><span class="removeTrainingItemButton" title="Remove this item">&#x2716;</span></a>
			</td>
		      </tr>
		      <?php
		      $counter ++;
		  }
		  ?>
	      <?php } ?>
	      <tr class="appendTrainingItemTr" style="display:none;">
		<td class="trainingItemTd">
		  <select name="appendTrainingItemDropdown" size=1 class="selectTrainingItemTitle" data-render-url="<?php echo $_SERVER['PHP_SELF']; ?>">
		    <option value="" selected>Choose here</option>
		    <?php if ($trainingItemTitleArrRecord != null) { ?>
			<?php foreach ($trainingItemTitleArrRecord as $intIndex => $trainingItemTitleObjRecord) { ?>
			    <option value="<?php echo $trainingItemTitleObjRecord['id']; ?>">
			      <?php echo $trainingItemTitleObjRecord['title']; ?>
			    </option>
			<?php } ?>
		    <?php } ?>
		  </select>
		</td>
		<td class="itemDescription">
		</td>
		<td class="itemResponsibility">
		</td>
		<td class="removeTrainingItemButton">
		  <a href="#"><span class="removeTrainingItemButton" title="Remove this item"></span></a>
		</td>
	      </tr>
	    </tbody>
	  </table>
	  <!-- need to add a bar containing title, description, department owner, is_offboarding_item, status, is_managerial for training items -->
	  <!-- would need ajax to append a dropdown to add training items -->
	  <!-- would need to pass php array containing all the training items that are available in the database into a dropdown menu for users to choose-->
	  <!-- ajax would then populate the data for the training item that the user chose -->
	  <button type="button" id="appendTrainingItem" title="Add more training items to this template">+</button>
	</fieldset>
	<button title="<?php echo $buttonTitle; ?>" class="<?php echo $buttonClass; ?>" disabled><?php echo $buttonShortTitle; ?></button>
      </div>
    </form>
  </div>
</div>
<div id="registration-common-msg">
  <div id="msg-confirm-delete" data-msg="<?php echo Yii::t('app', 'Are you sure that you want delete the selected item from this template?'); ?>"></div>
</div>

