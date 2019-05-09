<div class="container">
	<form action="" id="candidateForm">
			<div id="candidateFormTitle">
		    <div id="candidateFormHeader">
		    	<div class="item_row animate0 bounceIn logo">
			    	<img src="<?php echo HTTP_MEDIA_IMAGES . '/alllanguages/sagaos_logo.png?sv='.SITE_VERSION;?>" alt="" />
			    </div>
		    	<?php echo Yii::t('app', 'APPLICATION FOR EMPLOYMENT'); ?>
	    	</div>
		    <div id="positionInput">
			    <?php echo Yii::t('app', 'Position applied for'); ?>:
			    <input type="text" name="positionApplied" class="inputLine">
			  </div>
		  </div>
	    <input type="file" id="pictureBox" onchange="readUrl(picture)" title="Please choose a picture">
	  <!-- </div> -->
	  <!-- <div class="row"> -->
		  <!-- <div class="primaryInfoBox"> -->
				<table id="candidateDetailsTable">
					<tr>
						<td colspan="6" id="candidateDetails" style="background-color: #0CFEFE;">1.<?php echo Yii::t('app', 'Personal Particulars'); ?></td>
					</tr>
					<tr>
					 	<td colspan="4">
					 		<?php echo Yii::t('app', 'Full Name as per NRIC'); ?><br>
					 		(<?php echo Yii::t('app', 'IN BLOCK LETTERS'); ?>)<br>
					 		<input type="text" name="fullName">
					 	</td>
					 	<td colspan="2">
					 		<?php echo Yii::t('app', 'NRIC/Passport No'); ?><br>
					 		<input type="number" name="idNo">
					 	</td>
					</tr>
					<tr>
					 	<td colspan="4">
					 		<?php echo Yii::t('app', 'Correspondence Address'); ?><br>
					 		<input type="text" name="address">
					 	</td>
					 	<td colspan="2" rowspan="3">
					 		<?php echo Yii::t('app', 'How did you find out about this position?'); ?><br>
					 		  <input type="checkbox" name="findingMethod" value="jobstreet"><?php echo Yii::t('app', 'Jobstreet'); ?><br>
							  <input type="checkbox" name="findingMethod" value="linkedin"><?php echo Yii::t('app', 'LinkedIn'); ?><br>
							  <input type="checkbox" name="findingMethod" value="agency"><?php echo Yii::t('app', 'Agency'); ?><br>
							  <input type="checkbox" name="findingMethod" value="internal referral"><?php echo Yii::t('app', 'Internal Referral'); ?><br>
							  <input type="checkbox" name="findingMethod" value=""><?php echo Yii::t('app', 'Others'); ?><br>
					 	</td>
					</tr>
					<tr>
					 	<td colspan="2">
					 		<?php echo Yii::t('app', 'Contact No'); ?>:<br>
							<input type="text" name="contactNo">
						</td>
					 	<td colspan="2">
					 		<?php echo Yii::t('app', 'Email Address'); ?>:<br>
					 		<input type="email" name="emailAddress">	
					  </td>
					</tr>
					<tr>
						<td colspan="1">
							<?php echo Yii::t('app', 'Date of Birth'); ?>:<br>
							<input type="date" name="DOB">
						</td>
						<td colspan="1">
							<?php echo Yii::t('app', 'Marital Status'); ?>:<br>
							<input type="text" name="maritalStatus">
						</td>
						<td colspan="1">
							<?php echo Yii::t('app', 'Gender'); ?>:<br>
							<input type="gender" name="gender">
						</td>
						<td colspan="1">
							<?php echo Yii::t('app', 'Nationality'); ?>:<br>
							<input type="text" name="nationality">
						</td>
					</tr>
				</table>
		  <!-- </div> -->
		</div>
	  <input type="submit" value="Submit">
	</form>
</div>