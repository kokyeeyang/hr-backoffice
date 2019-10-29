<!-- <script type="text/javascript" src="tinymce/TinyMCEe.min.js"></script> -->
<style>
	input[type='checkbox'] {
		width: 20px;
	} 

	div #offer-letter-input {
		height: 80px;
		margin-bottom: 30px;
	}

</style>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
 tinymce.init({
   selector: 'textarea#editor',  //Change this value according to your HTML
   auto_focus: 'element1',
   width: "400",
   height: "100"
 }); 
 
 </script>

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
    <form method="post" enctype="multipart/form-data" id="createOfferLetterForm" name="createOfferLetterForm" action="<?php echo $this->createUrl('registration/saveOfferLetterTemplate'); ?>">
    	<div id="offer-letter-input" style="margin-bottom:10px; margin-top: 10px;">
    		<tr>
		    	<td><?php echo Yii::t('app', 'Offer Letter Title'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<input type="text" name="offerLetterTitle" id="offerLetterTitle" value="<?php echo $offerLetterTitle; ?>"/>
	  			</td>
	  			<td><?php echo Yii::t('app', 'Description'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<textarea name="offerLetterDescription" id="offerLetterDescription" rows="3"><?php echo $offerLetterDescription; ?></textarea>
	  			</td>
	  		</tr>
  		</div>
    	<table style="line-height: 32px;padding-left: 10px;font-size: 15px; margin-bottom:10px;">
    		<textarea id="offerLetterTemplate" name="offerLetterTemplate"><?php echo $offerLetterContent;?></textarea>
        <legend class="legend" title="<?php echo Yii::t('app', 'Which department(s) is this offer letter template for?'); ?>">
          <?php echo Yii::t('app', 'Departments'); ?>
        </legend>
	    	<div id="department-dropdown" style="margin-top: 10px; margin-bottom: 10px;">
	    		<?php foreach($departmentArr as $iKey => $departmentObj){ ?>
            <?php $checkedStatus = preg_match("/" . $departmentObj['title'] . "/", $offerLetterDepartment)?'checked':'' ?>
						<input type="checkbox" name="department[]" value="<?php echo $departmentObj['title']; ?>" class="department-dropdown" id="<?php echo $departmentObj['title']; ?>" <?php echo $checkedStatus; ?> >
						<label for="<?php echo $departmentObj['title']; ?>"><?php echo $departmentObj['title']; ?></label>
					<?php } ?>
	    	</div>
    		<input type="checkbox" name="offerLetterIsManagerial" id="offerLetterIsManagerial" value="1" class="department-dropdown" <?php echo $offerLetterIsManagerial==1?'checked':'' ?>>
    		<label for="offerLetterIsManagerial">Is for a managerial position</label>
    	</table>
      <?php if($_SERVER['QUERY_STRING'] != "" && isset($_GET['offerLetterId'])){ ?>
       <input type="button" id="copyOfferLetterButton" name="copyOfferLetterButton" value="<?php echo Yii::t('app', 'Copy this template'); ?>" data-copy-url="<?php echo $this->createUrl('registration/viewSelectedOfferLetter'); ?>">
       <input type="button" id="updateOfferLetterButton" name="updateOfferLetterButton" value="<?php echo Yii::t('app', 'Update this template'); ?>" data-update-url="<?php echo $this->createUrl('registration/updateOfferLetterTemplate',['offerLetterId'=>$offerLetterId]); ?>">
      <?php } else if ($_SERVER['QUERY_STRING'] == "" && !isset($_GET['offerLetterId'])){ ?>
        <div class="buttons">
          <div class="lable_block" id="saveOfferLetterButton">
            <div class="row_buttons">
              <?php echo CHtml::submitButton('Save this offer letter'); ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </form>
  </div>
</div>
<div id="registration-common-msg">
  <div id="msg-confirm-offerletter-duplicate" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to create a duplicate of this offer letter template?'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
  <div id="msg-confirm-save-template" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to save this offer letter template?'); ?>"></div>
</div>
<div id="registration-common-msg">
  <div id="msg-department-reminder" data-msg="<?php echo Yii::t('app', 'Please state which department this template is for.'); ?>"></div>
</div>