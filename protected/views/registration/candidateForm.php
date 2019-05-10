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
		<table class="candidateTable">
			<tr>
				<td colspan="6" class="candidateDetailsTitle" style="background-color: #0CFEFE;">1.<?php echo Yii::t('app', 'Personal Particulars'); ?></td>
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
		<table class="candidateTable">
			<tr>
				<td colspan="6" class="candidateDetailsTitle" style="background-color: #0CFEFE;">
					2.<?php echo Yii::t('app', 'EDUCATION & PROFESSIONAL QUALIFICATION'); ?>
				</td>
			</tr>
			<tr>
				<td colspan="1" rowspan="2">
					<?php echo Yii::t('app', 'Name of School/College/University'); ?>
				</td>
				<td scope="col" colspan="2" rowspan="1">
					<?php echo Yii::t('app', 'Year'); ?>
				</td>
				<td colspan="1" rowspan="2">
					<?php echo Yii::t('app', 'Qualification & Subject Obtained'); ?>
				</td>
				<td colspan="2" rowspan="2">
					<?php echo Yii::t('app', 'Grade/CGPA'); ?>
				</td>
			</tr>
			<tr>
				<td><?php echo Yii::t('app', 'From'); ?></td>
				<td><?php echo Yii::t('app', 'To'); ?></td>
			</tr>
			<tr>
				<td colspan="1">
					<input type="text" name="schoolName">
				</td>
				<td colspan="1">
					<input type="year" name="startYear">
				</td>
				<td colspan="1">
					<input type="year" name="endYear">
				</td>
				<td colspan="1">
					<input type="text" name="qualification">
				</td>
				<td colspan="2">
					<input type="text" name="cgpa">
				</td>
			</tr>
		</table>
		<table class="candidateTable">
			<tr>
				<td colspan="6" class="candidateDetailsTitle" style="background-color: #0CFEFE;">
					3.<?php echo Yii::t('app', 'PRESENT AND PREVIOUS EMPLOYMENT'); ?>
				</td>
			</tr>
			<tr>
				<td colspan="1" rowspan="2">
					<?php echo Yii::t('app', 'Name of Company'); ?>
				</td>
				<td colspan="1" rowspan="1">
					<?php echo Yii::t('app', 'From'); ?>
				</td>
				<td colspan="1" rowspan="1">
					<?php echo Yii::t('app', 'To'); ?>
				</td>
				<td colspan="1" rowspan="2">
					<?php echo Yii::t('app', 'Position Held'); ?>
				</td>
				<td colspan="1" rowspan="1">
					<?php echo Yii::t('app', 'Basic Salary'); ?>
				</td>
				<td colspan="1" rowspan="2">
					<?php echo Yii::t('app', 'Allowances'); ?>
				</td>
				<td colspan="1" rowspan="2">
					<?php echo Yii::t('app', 'Reason for leaving'); ?>
				</td>
			</tr>
		</table>
<!-- </div> -->
	  <input type="submit" value="Submit">
	</form>
</div>