<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top">
      <?php echo $header; ?>
    </div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span>
	  <?php echo $header; ?>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <form method="post" enctype="multipart/form-data" id="departmentForm" name="departmentForm" action="<?php echo $formAction; ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
	<fieldset class="fieldset">
	  <legend class="legend">
	    <?php echo Yii::t('app', '1. Department Details'); ?>
	  </legend>
	  <div class="grid_block">
	    <div class="lable_block">
	      <div class="lables">
		<span><?php echo Yii::t('app', 'Please specify your department name'); ?> </span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span><input type="text" name="newDepartment" id="newDepartment" value="<?php echo $departmentTitle; ?>" required/></span>
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
		  <textarea rows="4" name="departmentDescription" id="departmentDescription" cols="22" required/><?php echo $departmentDescription; ?></textarea>
		</span>
	      </div>
	    </div>
	  </div>
	</fieldset>
	<input type="submit" value="<?php echo $buttonTitle; ?>">
      </table>
    </form>
  </div>
</div>