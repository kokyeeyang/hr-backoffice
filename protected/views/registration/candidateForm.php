<div class="container">
	<form method="post" action="<?php echo $this->createUrl('registration/saveCandidate') ?>" id="candidateForm" name="candidateForm">
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
    <input type="file" name="profilePicture" id="pictureBox" onchange="readUrl(picture)" title="Please choose a picture">
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
			 		<input type="text" name="idNo">
			 	</td>
			</tr>
			<tr>
			 	<td colspan="4">
			 		<?php echo Yii::t('app', 'Correspondence Address'); ?><br>
			 		<input type="text" name="address">
			 	</td>
			 	<td colspan="2" rowspan="3">
			 		<?php echo Yii::t('app', 'How did you find out about this position?'); ?><br>
		 			<input type="radio" name="findingMethod" value="jobstreet" id="jobstreet" class="methodRadio">
	 		  		<label for="jobstreet">
		 				<?php echo Yii::t('app', 'Jobstreet'); ?>
		 			</label><br>
					<input type="radio" name="findingMethod" value="linkedin" id="linkedin" class="methodRadio">
					<label for="linkedin">
						<?php echo Yii::t('app', 'LinkedIn'); ?>
					</label><br>
					<input type="radio" name="findingMethod" value="agency" id="agency" class="methodRadio">
				  	<label for="agency">
						<?php echo Yii::t('app', 'Agency'); ?>
					</label><br>
					<input type="radio" name="findingMethod" value="internal referral" id="referral" class="methodRadio">
				  	<label for="referral">
					  <?php echo Yii::t('app', 'Internal Referral'); ?>
					</label><br>
					<input type="radio" name="findingMethod" id="others" class="methodRadio" value="others">
				  	<label for="others">
						<?php echo Yii::t('app', 'Others'); ?>
					</label><br>
					<input type="text" name="findingMethod" class="inputLine" id="otherInputLine" disabled="disabled">
					<br>
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
					<input type="text" name="schoolName[]">
				</td>
				<td colspan="1">
					<input type="year" name="startYear[]">
				</td>
				<td colspan="1">
					<input type="year" name="endYear[]">
				</td>
				<td colspan="1">
					<input type="text" name="qualification[]">
				</td>
				<td colspan="2">
					<input type="text" name="cgpa[]">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					<input type="text" name="schoolName[]">
				</td>
				<td colspan="1">
					<input type="year" name="startYear[]">
				</td>
				<td colspan="1">
					<input type="year" name="endYear[]">
				</td>
				<td colspan="1">
					<input type="text" name="qualification[]">
				</td>
				<td colspan="2">
					<input type="text" name="cgpa[]">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					<input type="text" name="schoolName[]">
				</td>
				<td colspan="1">
					<input type="year" name="startYear[]">
				</td>
				<td colspan="1">
					<input type="year" name="endYear[]">
				</td>
				<td colspan="1">
					<input type="text" name="qualification[]">
				</td>
				<td colspan="2">
					<input type="text" name="cgpa[]">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					<input type="text" name="schoolName[]">
				</td>
				<td colspan="1">
					<input type="year" name="startYear[]">
				</td>
				<td colspan="1">
					<input type="year" name="endYear[]">
				</td>
				<td colspan="1">
					<input type="text" name="qualification[]">
				</td>
				<td colspan="2">
					<input type="text" name="cgpa[]">
				</td>
			</tr>			
		</table>
		<table class="candidateTable">
			<tr>
				<td colspan="8" class="candidateDetailsTitle" style="background-color: #0CFEFE;">
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
				<td colspan="2" rowspan="1">
					<?php echo Yii::t('app', 'Basic Salary'); ?> (RM)
				</td>
				<td colspan="1" rowspan="2">
					<?php echo Yii::t('app', 'Allowances'); ?>
				</td>
				<td colspan="1" rowspan="2">
					<?php echo Yii::t('app', 'Reason for leaving'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo Yii::t('app', 'Month/Year'); ?>
				</td>
				<td>
					<?php echo Yii::t('app', 'Month/Year'); ?>
				</td>
				<td>
					<?php echo Yii::t('app', 'Start'); ?>
				</td>
				<td>
					<?php echo Yii::t('app', 'Final'); ?>
				</td>
			</tr>
			<tr>
				<td colspan="1">
					<input type="text" name="companyName[]">
				</td>
				<td colspan="1">
					<input type="year" name="startDate[]" placeholder="E.g: 01/2018 for Jan 2018">
				</td>
				<td colspan="1">
					<input type="year" name="endDate[]" placeholder="E.g: 01/2018 for Jan 2018">
				</td>
				<td colspan="1">
					<input type="text" name="positionHeld[]">
				</td>
				<td colspan="1">
					<input type="text" name="startingSalary[]">
				</td>
				<td colspan="1">
					<input type="text" name="endingSalary[]">
				</td>
				<td colspan="1">
					<input type="text" name="allowances[]">
				</td>
				<td colspan="1">
					<input type="text" name="leaveReason[]">
				</td>
			</tr>
			<tr>
				<td colspan="8">
					<?php echo Yii::t('app', 'Have you ever been terminated/dismissed/suspended from the service of any employer'); ?>?<br>
				  <input type="radio" name="terminatedBefore" value="1"> Yes<br>
				  <input type="radio" name="terminatedBefore" value="0"> No<br>
					<?php echo Yii::t('app', 'If yes, please give details'); ?><br>
					<input type="text" name="terminationDetails" class="inputLine" id="terminationReason" disabled="disabled"><br><br>
				</td>
			</tr>
		</table>
		<table class="candidateTable">
			<tr>
				<td colspan="6" class="candidateDetailsTitle" style="background-color: #0CFEFE;">
					4.<?php echo Yii::t('app', 'REFEREES (Previous Superiors)'); ?>
				</td>
			</tr>
			<tr>
				<td colspan="1">
					<?php echo Yii::t('app', 'Name'); ?>
				</td>
				<td colspan="2">
					<?php echo Yii::t('app', 'Company'); ?>
				</td>
				<td colspan="1">
					<?php echo Yii::t('app', 'Occupation'); ?>
				</td>
				<td colspan="1">
					<?php echo Yii::t('app', 'Contact No.'); ?>
				</td>
				<td colspan="1">
					<?php echo Yii::t('app', 'Years Known'); ?>
				</td>
			</tr>
			<tr>
				<td colspan="1">
					<input type="text" name="superiorName">
				</td>
				<td colspan="2">
					<input type="year" name="superiorCompany">
				</td>
				<td colspan="1">
					<input type="year" name="superiorOccupation">
				</td>
				<td colspan="1">
					<input type="text" name="superiorContact">
				</td>
				<td colspan="1">
					<input type="text" name="yearsKnown">
				</td>
			</tr>
			<tr>
				<td colspan="6">
					<?php echo Yii::t('app', 'Can we make references to your employment records with your previous employers/companies'); ?>?<br>
				  <input type="radio" name="consent" value="1"> Yes<br>
				  <input type="radio" name="consent" value="0"> No<br>
					<?php echo Yii::t('app', 'If no, please give reasons'); ?><br>
					<input type="text" name="noReferenceReason" class="inputLine" disabled="disabled"><br><br>
				</td>
			</tr>
		</table>
		<table class="candidateTable">
			<tr>
				<td colspan="2" class="candidateDetailsTitle" style="background-color: #0CFEFE;">
					5.<?php echo Yii::t('app', 'GENERAL'); ?>
				</td>
			</tr>
			<tr>
				<td colspan="1">
					a) <?php echo Yii::t('app', 'Are you suffering from any physical disabilities or have ever been seriously ill'); ?>?
				</td>
				<td colspan="1">
					<input type="text" name="illness">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					b) <?php echo Yii::t('app', 'Have you ever been convicted for a criminal offence, declared bankrupt, revoked of professional practicing license/certificate and/or charged in court?'); ?>? <br>
					<?php echo Yii::t('app', 'If yes, please state offence and date of conviction and discharge'); ?>
				</td>
				<td colspan="1">
					<input type="text" name="criminalOffense">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					c) <?php echo Yii::t('app', 'Do you have any relatives or friends working in SagaOS or its subsidiaries? If so, please state name and relationship'); ?>?
				</td>
				<td colspan="1">
					<input type="text" name="sagaosRelative">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					d) <?php echo Yii::t('app', 'Any relatives involved directly or indirectly in similar company’s business'); ?>?
				</td>
				<td colspan="1">
					<input type="text" name="similarBusiness">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					e) <?php echo Yii::t('app', 'Do you possess a car or motorcycle'); ?>?
				</td>
				<td colspan="1">
					<input type="text" name="modeOfTransport">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					f) <?php echo Yii::t('app', 'How did you find this employment opportunity'); ?>?<br>
						 <?php echo Yii::t('app', 'E.g. Newspaper/Online/Recruitment Agency/SagaOS website/Others'); ?>
				</td>
				<td colspan="1">
					<input type="text" name="methodForFindingJob">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					g) <?php echo Yii::t('app', 'Have you ever applied to/worked at SagaOS before'); ?>?
				</td>
				<td colspan="1">
					<input type="text" name="methodForFindingJob">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					h) <?php echo Yii::t('app', 'If you were offered employment, when can you commence work'); ?>?
				</td>
				<td colspan="1">
					<input type="text" name="commencementDate">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					i) <?php echo Yii::t('app', 'If hired, are you willing to submit to a good conduct certificate'); ?>?
				</td>
				<td colspan="1">
					<input type="text" name="goodConduct">
				</td>
			</tr>
			<tr>
				<td colspan="1">
					j) <?php echo Yii::t('app', 'Expected Salary'); ?>
				</td>
				<td colspan="1">
					<input type="text" name="expectedSalary">
				</td>
			</tr>
		</table>
		<table class="candidateTable">
			<tr>
				<td colspan="6" class="candidateDetailsTitle" style="background-color: #0CFEFE;">
					6.<?php echo Yii::t('app', 'DECLARATION & CONSENT'); ?>
				</td>
			</tr>
			<tr>
				<td colspan="6">
					<?php echo Yii::t('app', 'I hereby declare that the information and personal data provided by me in the Application for Employment Form, including any accompanying document(s) are true, correct and complete in every aspect. I fully understand and accept that, if at any time after my employment with the Company, it is found that I have given false and misleading information in the Application for Employment Form, the Company has the right to forthwith terminate my employment. I understand that this application does not constitute an offer of employment. I understand that in some cases, credit checks, reference checks and/or good conduct checks will be required and I will be notified if said checks applies to this application. For the purpose of the Personal Data Protection Act 2010, I hereby give my consent to the Company to process all or any of my personal data and information for any purpose related to or in connection with this employment application and if required, to disclose or transfer such data to any company affiliate for the purpose of processing such data, which may be located outside Malaysia.') ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="text" name="signature" class="inputLine"><br>
					<?php echo Yii::t('app', 'Signature of Applicant'); ?>
				</td>
				<td colspan="3">
					<input type="text" name="dateSigned" class="inputLine"><br>
					<?php echo Yii::t('app', 'Date'); ?>
				</td>
			</tr>
		</table>
	  <div class="row buttons">
      <?php echo CHtml::submitButton('Save'); ?>
    </div>
	</form>
</div>