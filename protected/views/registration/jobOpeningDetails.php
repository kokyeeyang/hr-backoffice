<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top">
      <a class="top_level_item" href="<?php echo $this->createUrl('registration/showAllJobOpenings'); ?>">
	<?php echo Yii::t('app', 'Job Openings List'); ?>
      </a>
      >
      <?php echo Yii::t('app', 'Add New Job Openings'); ?>
    </div>
    <div class="breadcrumb-bottom breadcrumb-bottom-people">
      <div class="title">
        <span><?php echo Yii::t('app', 'Add new job openings'); ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <form method="post" enctype="multipart/form-data" id="jobOpeningForm" name="jobOpeningForm" action="<?php echo $this->createUrl('registration/saveJobOpenings') ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
	<fieldset class="fieldset">
	  <legend class="legend">
	    <?php echo Yii::t('app', '1. Job Opening Details'); ?>
	  </legend>
	  <div class="grid_block">
	    <div class ="lable_block">
	      <div class="lables">
		<span><?php echo Yii::t('app', 'Job title'); ?> </span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span>
		  <input type="text" name="jobTitle"/>
		</span>
	      </div>
	    </div>
	    <div class ="lable_block">
	      <div class="lables">
		<span><?php echo Yii::t('app', 'Department'); ?></span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span>
		  <select name="departmentDropdown" size=1>
		    <option value="" selected disabled hidden>Choose here</option>
		    <?php foreach ($departmentArr as $iKey => $departmentObj) { ?>
    		    <option value="<?php echo $departmentObj['id']; ?>"><?php echo $departmentObj['id']; ?></option>
		    <?php } ?>
		  </select>
		</span>
	      </div>
	    </div>
	    <div class ="lable_block">
	      <div class="lables">
		<span><?php echo Yii::t('app', 'Line manager'); ?></span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span>
		  <select name="interviewManager" size=1>
		    <?php foreach ($allManagers as $manager) { ?>
    		    <option value="<?php echo $manager['admin_display_name'] ?>"><?php echo $manager['admin_display_name']; ?></option>
		    <?php } ?>
		  </select>
		</span>
	      </div>
	    </div>
	    <div class ="lable_block">
	      <span>
		<input type="checkbox" name="isManagerialCheckbox" id="isManagerialCheckbox" value="1">
		<label for="isManagerialCheckbox"><?php echo Yii::t('app', 'Managerial position') ?></label>
	      </span>
	    </div>
	</fieldset>
	<div class="row buttons">
	  <?php echo CHtml::submitButton($objModel->isNewRecord ? 'Submit' : 'Save'); ?>
	</div>
      </table>
    </form>
  </div>
</div>