<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo $breadcrumbTop; ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-people">
      <div class="title">
        <span><?php echo $title; ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <form method="post" enctype="multipart/form-data" id="trainingItemForm" name="trainingItemForm" action="<?php echo $formAction ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
	<fieldset class="fieldset">
	  <legend class="legend">
	    <?php echo Yii::t('app', '1. Training Item Details'); ?>
	  </legend>
	  <div class="grid_block">
	    <div class="lable_block">
	      <div class="lables">
		<span><?php echo Yii::t('app', 'Training item'); ?> </span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span>
		  <?php isset($_GET['id']) ? $trainingItemTitle = $trainingItemObjRecord->title : $trainingItemTitle = '' ?>
		  <input type="text" name="trainingItemTitle" value="<?php echo $trainingItemTitle ?>" value="<?php ?>" required/>
		</span>
	      </div>
	    </div>
	    <div class="lable_block">
	      <div class="lables">
		<span>
		  <?php echo Yii::t('app', 'Give a short description'); ?>
		</span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span>
		  <?php isset($_GET['id']) ? $trainingItemDescription = $trainingItemObjRecord->description : $trainingItemDescription = '' ?>
		  <textarea rows="4" name="trainingItemDescription" id="trainingItemDescription" cols="22" required/><?php echo $trainingItemDescription; ?></textarea>
		</span>
	      </div>
	    </div>
	    <div class="lable_block">
	      <div class="lables">
		<span><?php echo Yii::t('app', 'Responsibility'); ?></span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span>
		  <select name="responsibilityDropdown" size=1>
		    <?php !isset($_GET['id']) ? $defaultOption = 'selected' : $defaultOption = ''; ?>
		    <option value="" <?php echo $defaultOption ?> disabled hidden required>Choose here</option>
		    <?php foreach ($adminArr as $adminObj) { ?>
			<?php isset($_GET['id']) && $trainingItemObjRecord->department_owner == $departmentObj['id'] ? $selectedStatus = "selected" : $selectedStatus = ''; ?>
    		    <option value="<?php echo $adminObj['id']; ?>" <?php echo $selectedStatus; ?>><?php echo $adminObj['admin_display_name']; ?></option>
		    <?php } ?>
		  </select>
		</span>
	      </div>
	    </div>
	  </div>
	</fieldset>
	<fieldset class="fieldset">
	  <legend class="legend">
	    <?php echo Yii::t('app', '2. Others'); ?>
	  </legend>
	  <div class="grid_block">
	    <div class="lable_block">
	      <span>
		<?php isset($_GET['id']) && $trainingItemObjRecord->status == 1 ? $checkedStatus = 'checked' : $checkedStatus = '' ?>
		<input type="checkbox" name="isActiveCheckbox" id="isActiveCheckbox" value="1" <?php echo $checkedStatus ?>>
		<label for="isActiveCheckbox"><?php echo Yii::t('app', 'Is this item still active?') ?></label>
	      </span>
	    </div>
	  </div>
	</fieldset>
	<span>
	  <input type="submit" value="<?php echo $buttonTitle; ?>">
	  <?php isset($_GET['id']) ? $onboardingItemId = $onboardingItemObjRecord->id : $onboardingItemId = '' ?>
	  <input type="hidden" name="onboardingItemId" value="<?php echo $onboardingItemId ?>"/>             
	</span>
      </table>
    </form>
  </div>
</div>