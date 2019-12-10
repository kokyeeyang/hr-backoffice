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
  	<h4 class="widget_title"><?php echo $header; ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="onboardingChecklistTemplateForm" name="onboardingChecklistTemplateForm" action="<?php echo $formAction; ?>">
    	<div id="offer-letter-input" style="margin-bottom:10px; margin-top: 10px;">
    		<tr>
		    	<td><?php echo Yii::t('app', 'Onboarding Checklist Title'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<?php isset($_GET['id'])?$templateTitle = $templateObjRecord->title:$templateTitle = '' ?>
	  				<input type="text" name="templateTitle" id="templateTitle" value="<?php echo $templateTitle; ?>"/>
	  			</td>
	  			<td><?php echo Yii::t('app', 'Description'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<?php isset($_GET['id'])?$templateDescription = $templateObjRecord->title:$templateDescription = '' ?>
	  				<textarea name="templateDescription" id="templateDescription" rows="3"><?php echo $templateDescription; ?></textarea>
	  			</td>
	  		</tr>
	  		<legend class="legend" title="<?php echo Yii::t('app', 'Which department(s) is this offer letter template for?'); ?>">
          <?php echo Yii::t('app', 'Departments'); ?>
        </legend>
	    	<div id="department-dropdown" style="margin-top: 10px; margin-bottom: 10px;">
          <?php foreach($departmentArr as $iKey => $departmentObj){ ?>
            <?php $checkedStatus = preg_match("/" . $departmentObj['title'] . "/", $templateObjRecord->department)?'checked':'' ?>
            <input type="checkbox" name="department[]" value="<?php echo $departmentObj['id']; ?>" class="department-dropdown" id="<?php echo $departmentObj['title']; ?>" <?php echo $checkedStatus; ?> >
            <label for="<?php echo $departmentObj['title']; ?>"><?php echo $departmentObj['title']; ?></label>
					<?php } ?>
	    	</div>
  		</div>
    </form>
  </div>
</div>