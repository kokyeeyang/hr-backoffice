<!-- <script type="text/javascript" src="tinymce/TinyMCEe.min.js"></script> -->
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
    <form method="post" enctype="multipart/form-data" id="createOfferLetterForm" name="createOfferLetterForm" action="<?php echo $this->createUrl('registration/saveOfferLetterTemplate') ?>" >
    	<table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
    		<tr>
    			<td><?php echo Yii::t('app', 'Offer Letter Title'); ?> </td>
    			<td>:</td>
    			<td>
    				<input type="text" name="offerLetterTitle"/>
    			</td>
    		</tr>
    		<tr>
    			<td><?php echo Yii::t('app', 'Description'); ?> </td>
    			<td>:</td>
    			<td>
    				<input type="text" name="offerLetterDescription"/>
    			</td>
    		</tr>
    		<tr>
	    		<textarea id="basic-example">
					  <p style="text-align: left; margin:40px;">
					    <img src="/images/alllanguages/sagaos_logo.png">
					  </p>
						<p style="text-align: left; margin:40px;">
							<b>PRIVATE & CONFIDENTIAL</b>
							<br/><br/>
							<input type="text" name="offerLetterDate" value="<?php echo $dateToday; ?>">
							<br/><br/>
							IC No: <input type="text" name="offerLetterIC" value="%%Candidate ID%%">
							<br/><br/>
							Address: <input type="text" name="offerLetterAddress" value="%%Candidate Address%%" style="width: 15px;">
							<br/><br/>
							LETTER OF APPOINTMENT - <input type="text" name="offerLetterIC" value="%%Candidate name%%">
							<br/>
						</p>
						<p style="margin:40px;">
							We are pleased to offer you employment as Online Customer Support Agent with SAGAOS SDN. BHD. (herein after referred to as "the Company") with effect from the <input type="text" name="candidateOfferDate" value="%%Candidate Offer date%%">.

							The Company reserves the right to introduce, modify, amend or annul any terms and conditions at any time during its operations. Any such changes shall be notified by issuance of circulars, memorandums or other instructions by whatever means from time to time, will form part of the terms and conditions of employment.
							<br/><br/>
							You will be reporting to <input type="text" name="candidateSuperior" value="%%Candidate's superior%%">.  
						</p>
						<p style="margin:40px;">
							The terms and conditions of your appointment are as follows:
							<div style="padding-left:60px;"><b> 1)Commencement </b></div>
								The date of commencement is provisionally set as the <input type="text" name="candidateStartDate" value="%%Candidate's start date%%">.

								Your official working hours shall not exceed (48) forty-eight hours per calendar week until and unless consent is given by Employee to work additional hours. 

								You will initially be employed for a probation (qualifying) period of 3 months. This period is agreed as reasonable having regard to the nature and circumstances of your employment. After successful completion of the Probationary Period, the Company shall confirm to the Employee in writing about such successful completion of the Probationary Period. The said probationary period may be reduced or extended at the discretion of the Company.
						</p>
					</textarea>
	    	</tr>
    	</table>
    </form>
  </div>
</div>