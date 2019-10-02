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
    	<div id="offer-letter-input" style="margin-bottom:10px; margin-top: 10px;">
    		<tr>
		    	<td><?php echo Yii::t('app', 'Offer Letter Title'); ?> </td>
	  			<td>:</td>
	  			<?php 
          if (count($offerLetterArr) > 0) {
            $offerLetterObj = $offerLetterArr[0];
          }
          var_dump($_SERVER['REQUEST_URI']); 
          ?>
	  			<td>
	  				<input type="text" name="offerLetterTitle" id="offerLetterTitle" value="<?php echo $currentFunction=="viewSelectedOfferLetter"?$offerLetterObj->offer_letter_title:''; ?>"/>
	  			</td>
	  			<td><?php echo Yii::t('app', 'Description'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<textarea name="offerLetterDescription" id="offerLetterDescription" rows="3"><?php echo $currentFunction=="viewSelectedOfferLetter"?$offerLetterObj->offer_letter_description:''; ?></textarea>
	  			</td>
	  		</tr>
  		</div>
    	<table style="line-height: 32px;padding-left: 10px;font-size: 15px; margin-bottom:10px;">
    		<textarea id="offer-letter-template" name="offer-letter-template">
					<?php 
						echo $offerLetterObj->offer_letter_content;
					?>
				</textarea>
	    	<div id="department-dropdown" style="margin-top: 10px; margin-bottom: 10px;">
	    		<?php foreach($departmentArr as $iKey => $departmentObj){ ?>
            <?php $checkedStatus = preg_match("/" . $departmentObj['department_title'] . "/", $offerLetterObj->department)?'checked':'' ?>
						<input type="checkbox" name="department[]" value="<?php echo $departmentObj['department_title']; ?>" class="department-dropdown" id="<?php echo $departmentObj['department_title']; ?>" <?php echo $checkedStatus; ?> >
						<label for="<?php echo $departmentObj['department_title']; ?>"><?php echo $departmentObj['department_title']; ?></label>
					<?php } ?>
	    	</div>
    		<input type="checkbox" name="offerLetterIsManagerial" id="offerLetterIsManagerial" value="1" class="department-dropdown" <?php echo $offerLetterObj->is_managerial==1?'checked':'' ?>>
    		<label for="offerLetterIsManagerial">Is for a managerial position</label>
    	</table>
    	 <input type="button" id="copyOfferLetterButton" name="copyOfferLetterButton" value="<?php echo Yii::t('app', 'Copy this template'); ?>" data-copy-url="<?php echo $this->createUrl('registration/copyOfferLetterTemplate'); ?>">
       <input type="button" id="updateOfferLetterButton" name="updateOfferLetterButton" value="<?php echo Yii::t('app', 'Update this template'); ?>" data-update-url="<?php echo $this->createUrl('registration/updateOfferLetterTemplate',['offerLetterId'=>$offerLetterId]); ?>">
       <input type="button" id="saveOfferLetterButton" name="saveOfferLetterButton" style="display:none;" value="<?php echo Yii::t('app', 'Save this template'); ?>" data-save-url="<?php echo $this->createUrl('registration/saveOfferLetterTemplate'); ?>">
       <input type="hidden" id="copyTemplateUrl" name="copyTemplateUrl" value="">
    </form>
  </div>
</div>