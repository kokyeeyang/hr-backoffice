<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top">
      <a class="top_level_item" href="<?php echo $this->createUrl('registration/showAllCandidateStatus'); ?>">
	<?php echo Yii::t('app', 'Candidate Status List'); ?>
      </a>
      >
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
    <form method="post" enctype="multipart/form-data" id="candidateStatusForm" name="candidateStatusForm" action="<?php echo $formAction; ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
	<fieldset class="fieldset">
	  <legend class="legend">
	    <?php echo Yii::t('app', '1. Candidate Status Details'); ?>
	  </legend>
	  <div class="grid_block">
	    <div class="lable_block">
	      <div class="lables">
		<span><?php echo Yii::t('app', 'Please put in status that you would desire for candidate'); ?> </span>
		<span>:</span>
	      </div>
	      <div class="lables2">
		<span><input type="text" name="newCandidateStatus" id="newCandidateStatus" value="<?php echo $candidateStatusTitle; ?>" required/></span>
	      </div>
	    </div>
	  </div>
	</fieldset>
        <tr>
          <td>
            <input type="submit" value="<?php echo $buttonTitle; ?>">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>