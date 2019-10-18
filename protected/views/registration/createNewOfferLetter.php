<!-- <script type="text/javascript" src="tinymce/TinyMCEe.min.js"></script> -->
<style>
	input[type='checkbox'] {
		width: 20px;
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
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Add New Offer Letter Template'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-people">
      <div class="title">
        <span><?php echo Yii::t('app', 'Add a new offer letter template'); ?></span>
      </div>
    </div>
  </div>
</div>
<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Add a new offer letter template'); ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="createOfferLetterForm" name="createOfferLetterForm" action="<?php echo $this->createUrl('registration/saveOfferLetterTemplate'); ?>">
    	<div id="offer-letter-input">
      <!-- <div id="offer-letter-input" style="margin-bottom:10px; margin-top: 10px;"> -->
    		<tr>
		    	<td><?php echo Yii::t('app', 'Offer Letter Title'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<input type="text" name="offerLetterTitle" value="<?php echo $currentFunction=="viewSelectedOfferLetter"?$offerLetterObj->offer_letter_title:''; ?>"/>
	  			</td>
	  			<td><?php echo Yii::t('app', 'Description'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<textarea name="offerLetterDescription" rows="3"><?php echo $currentFunction=="viewSelectedOfferLetter"?$offerLetterObj->offer_letter_description:''; ?></textarea>
	  			</td>
	  		</tr>
  		</div>
    	<!-- <table style="line-height: 32px;padding-left: 10px;font-size: 15px; margin-bottom:10px;"> -->
      <table class="offer-letter-content">
    		<textarea id="offerLetterTemplate" name="offerLetterTemplate">
				</textarea>
	    	<div id="department-dropdown">
	    		<?php foreach($departmentArr as $iKey => $departmentObj){ ?>
						<input type="checkbox" name="department[]" value="<?php echo $departmentObj['department_title']; ?>" class="department-dropdown" id="<?php echo $departmentObj['department_title']; ?>">
						<label for="<?php echo $departmentObj['department_title']; ?>"><?php echo $departmentObj['department_title']; ?></label>
					<?php } ?>
	    	</div>
    		<input type="checkbox" name="offerLetterIsManagerial" id="offerLetterIsManagerial" value="1" class="department-dropdown">
    		<label for="offerLetterIsManagerial">Is for a managerial position</label>
    	</table>
        <div class="buttons">
          <div class="lable_block" id="saveOfferLetterButton">
            <div class="row_buttons">
              <?php echo CHtml::submitButton('Save this offer letter'); ?>
            </div>
          </div>
        </div>
    </form>
  </div>
</div>
<div id="registration-common-msg">
  <div id="msg-confirm-save-template" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to save this offer letter template?'); ?>"></div>
</div>
<div id="registration-common-msg">
  <div id="msg-department-reminder" data-msg="<?php echo Yii::t('app', 'Please state which department this template is for.'); ?>"></div>
</div>