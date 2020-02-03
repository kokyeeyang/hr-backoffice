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
	  				<?php isset($_GET['id'])?$templateTitle = $onboardingChecklistTemplateObjRecord->title:$templateTitle = '' ?>
	  				<input type="text" name="templateTitle" id="templateTitle" value="<?php echo $templateTitle; ?>"/>
	  			</td>
	  			<td><?php echo Yii::t('app', 'Description'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<?php isset($_GET['id'])?$templateDescription = $onboardingChecklistTemplateObjRecord->description:$templateDescription = '' ?>
	  				<textarea name="templateDescription" id="templateDescription" rows="3"><?php echo $templateDescription; ?></textarea>
	  			</td>
	  		</tr>
        <!-- need to add a bar containing title, description, department owner, is_offboarding_item, status, is_managerial for onboarding items -->
        <!-- would need ajax to append a dropdown to add onboarding items -->
        <!-- would need to pass php array containing all the onboarding items that are available in the database into a dropdown menu for users to choose-->
        <!-- ajax would then populate the data for the onboarding item that the user chose -->
  		</div>
    </form>
  </div>
</div>