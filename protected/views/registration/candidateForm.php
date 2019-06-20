<div id="tabs" class="tabs ui-tabs ui-widget ui-widget-content ui-corner-all" style="width:100%;">
  <div id="tabs-1" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
    <form method="post" action="<?php echo $this->createUrl('registration/saveCandidate', array('queryString' => $queryString)) ?>" id="candidateForm" name="candidateForm" enctype="multipart/form-data">
      <div>
        <img src="/images/alllanguages/sagaos_logo.png">
        <header><?php echo Yii::t('app', 'APPLICATION FOR EMPLOYMENT'); ?></header>
        <div id="upload">
          <div class="upload-child">
            <label for="pic">Please upload your photo (passport size)</label>
            <input type="file" name="pic" id="pic" accept="image/*">
          </div>
          <div class="upload-child">
            <label for="pic">Please upload your resume</label>
            <input type="file" name="resume" id="resume" accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
          </div>
          <div class="upload-child">
            <label for="pic">Please upload your cover letter</label>
            <input type="file" name="coverLetter" id="coverLetter" accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
          </div>
        </div>
        <fieldset class="fieldset">
          <legend class="legend">
            1.<?php echo Yii::t('app', 'PERSONAL PARTICULARS'); ?>
          </legend>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <span>
                  <?php echo Yii::t('app', 'Full Name as per NRIC'); ?> 
                  <span class="required">*</span>
                  :
                </span>
              </div>
              <div class="lables2">
                <input type="text" name="fullName" placeholder="(<?php echo Yii::t('app', 'IN BLOCK LETTERS'); ?>)" required>
                <input type="text" name="encryptedJobId" value="<?php echo $encryptedJobId ?>" style="display:none;">
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Contact No'); ?> 
                <span class="required">*</span>
                :
                </span>
              </div>
              <div class="lables2">
                <input type="text" name="contactNo" required>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span>
                  <?php echo Yii::t('app', 'Email Address'); ?> 
                  <span class="required">*</span>
                  :
                </span>
              </div>
              <div class="lables2">
                <input type="email" name="emailAddress" required>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span>
                  <?php echo Yii::t('app', 'Correspondence Address'); ?> 
                  <span class="required">*</span>
                  :
                </span>
              </div>
              <div class="lables2">
                <input type="text" name="address" required>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span>
                  <?php echo Yii::t('app', 'Date of birth'); ?> 
                  <span class="required">*</span>
                  :
                </span>
              </div>
              <div class="lables2">
                <input type="date" name="DOB" required>
              </div>
            </div>
          </div>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Gender'); ?> 
                <span class="required">*</span>
                :
                </span>
              </div>
              <div class="lables2">
                <label for="male"><input type="radio" name="gender" value="male" id="male" required><span>Male</span></label>
                <label for="female"><input type="radio" name="gender" value="female" id="female" required> <span>Female </span></label>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span>
                  <?php echo Yii::t('app', 'NRIC/Passport No'); ?>  
                  <span class="required">*</span>
                  :
                </span>
              </div>
              <div class="lables2">
                <input type="text" name="idNo" placeholder="<?php echo Yii::t('app', 'Please do not include dashes or empty spaces'); ?>" required>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span>
                  <?php echo Yii::t('app', 'Marital Status'); ?> 
                  <span class="required">*</span>
                  :
                </span>
              </div>
              <div class="lables2">
                <input type="text" name="maritalStatus" required>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span>
                  <?php echo Yii::t('app', 'Nationality'); ?> 
                  <span class="required">*</span>
                  :
                </span>
              </div>
              <div class="lables2">
                <input type="text" name="nationality" required>
              </div>
            </div>
          </div>
          <div class="radio-buttons">
            <span>
              <?php echo Yii::t('app', 'How did you find out about us'); ?>?
              <span class="required">*</span>
            </span>
          </div>
          <div class="radio-buttons">
            <input type="radio" name="findingMethod" value="jobstreet" id="jobstreet" required>&nbsp;
            <span>
              <label for="jobstreet"><?php echo Yii::t('app', 'Jobstreet'); ?></label>
            </span>
            <input type="radio" name="findingMethod" value="linkedin" id="linkedin" required>&nbsp;
            <span>
              <label for="linkedin"><?php echo Yii::t('app', 'LinkedIn'); ?></label>
            </span>
            <input type="radio" name="findingMethod" value="agency" id="agency" required>&nbsp;
            <span>
              <label for="agency"><?php echo Yii::t('app', 'Agency'); ?></label>
            </span>
            <input type="radio" name="findingMethod" value="internal-referral" id="internal-referral" required>&nbsp;
            <span>
              <label for="internal-referral"><?php echo Yii::t('app', 'Internal Referral'); ?></label>
            </span>
            <input type="radio" name="findingMethod" value="others" id="others" required>&nbsp;
            <span>
              <label for="others"><?php echo Yii::t('app', 'Others'); ?></label>
            </span>
            <input type="text" name="otherFindingMethod" id="otherInputLine" style="display:none; width:20%;" placeholder="Please specify">
            <input type="text" name="referralFindingMethod" id="referralInputLine" style="display:none; width:20%;" placeholder="Please specify who">
          </div>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            2.<?php echo Yii::t('app', 'EDUCATION & PROFESSIONAL QUALIFICATION'); ?>
          </legend>
          <?php $this->beginContent('//registration/education_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/education_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/education_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/education_section'); ?>
          <?php $this->endContent(); ?>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            3.<?php echo Yii::t('app', 'PRESENT AND PREVIOUS EMPLOYMENT'); ?>
          </legend>
          <?php $this->beginContent('//registration/company_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/company_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/company_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/company_section'); ?>
          <?php $this->endContent(); ?>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Have you ever been terminated/dismissed/suspended from the service of any employer'); ?>?<br>
                <?php echo Yii::t('app', 'If yes, please give details'); ?><br>
                <input type="text" name="terminationDetails" id="terminationReason" style="display:none;"><br><br>
              </div>
              <div class="lables2">
                <label for="terminatedYes"><input type="radio" name="terminatedBefore" id="terminatedYes" value="1" required> Yes<br></label>
                <label for="terminatedNo"><input type="radio" name="terminatedBefore" id="terminatedNo" value="0" required> No<br></label>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            4.<?php echo Yii::t('app', 'REFEREES (Previous Superiors)'); ?>
          </legend>
          <?php $this->beginContent('//registration/referee_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/referee_section'); ?>
          <?php $this->endContent(); ?>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Can we make references to your employment records with your previous employers/companies'); ?>?<br>
                <?php echo Yii::t('app', 'If no, please give reasons'); ?><br>
                <input type="text" name="noReferenceReason" id="noReference" style="display:none"><br><br>
              </div>
              <div class="lables2">
                <label for="referenceYes"><input type="radio" name="consent" value="1" id="referenceYes" required> Yes<br></label>
                <label for="referenceNo"><input type="radio" name="consent" value="0" id="referenceNo" required> No<br></label>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            5.<?php echo Yii::t('app', 'GENERAL') ?>
          </legend>
          <div class="general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                a) <?php echo Yii::t('app', 'Are you suffering from any physical disabilities or have ever been seriously ill'); ?>? 
                <span class="required" style="color:red;">*</span>
              </div>
              <div class="general_lables2">
                <label for="illnessYes"><input type="radio" name="illness" value="1" id="illnessYes" required> Yes</label>
                <label for="illnessNo"><input type="radio" name="illness" value="0" id="illnessNo" required> No<br></label>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                b) <?php echo Yii::t('app', 'Have you ever been convicted for a criminal offence, declared bankrupt, revoked of professional practicing license/certificate and/or charged in court'); ?>?
                <span class="required" style="color:red;">*</span> 
                <br>
                <?php echo Yii::t('app', 'If yes, please state offence and date of conviction and discharge'); ?>
               <input type="text" name="criminalOffenseInput" style="display: none;" id="criminalOffenseInput" class="crimeBox" placeholder="Offence">
               <input type="date" name="convictedDate" style="display: none;" id="convictedDate" class="crimeBox" title="Convicted date">
               <input type="date" name="dischargeDate" style="display: none;" id="dischargeDate" class="crimeBox" title="Date of discharge">
              </div>
              <div class="general_lables2">
                <label for="criminalYes"><input type="radio" name="criminalOffenseRadio" value="1" id="criminalYes" required> Yes</label>
                <label for="criminalNo"><input type="radio" name="criminalOffenseRadio" value="0" id="criminalNo" required> No<br></label>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                c) <?php echo Yii::t('app', 'Do you have any relatives or friends working in SagaOS or its subsidiaries? If so, please state name and relationship'); ?>? 
                <span class="required" style="color:red;">*</span>
                 <br>
                 <input type="text" name="sagaosContactNameInput" style="display: none; margin-bottom:5px; margin-top:5px;" id="sagaosContactName" placeholder="Contact name">
                 <input type="text" name="sagaosFamilyInput" style="display: none;" id="sagaosFamilyInput" placeholder="Relationship with him/her"><br>
              </div>
              <div class="general_lables2">
                <label for="sagaosYes"><input type="radio" name="sagaosRelative" value="1" id="sagaosYes" required> Yes<br></label>
                <label for="sagaosNo"><input type="radio" name="sagaosRelative" value="0" id="sagaosNo" required> No<br></label>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                d) <?php echo Yii::t('app', 'Any relatives involved directly or indirectly in similar company’s business'); ?>?
                <span class="required" style="color:red;">*</span>
              </div>
              <div class="general_lables2">
                <label for="conflictYes"><input type="radio" name="interestConflict" value="1" id="conflictYes" required> Yes</label>
                <label for="conflictNo"><input type="radio" name="interestConflict" value="0" id="conflictNo" required> No<br></label>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                e) <?php echo Yii::t('app', 'Do you possess a car or motorcycle'); ?>?
                <span class="required" style="color:red;">*</span>
              </div>
              <div class="general_lables2">
                <label for="transportYes"><input type="radio" name="ownTransport" value="1" id="transportYes" required> Yes</label>
                <label for="transportNo"><input type="radio" name="ownTransport" value="0" id="transportNo" required> No<br></label>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                f) <?php echo Yii::t('app', 'Have you ever applied to/worked at SagaOS before'); ?>?
                <span class="required" style="color:red;">*</span>
              </div>
              <div class="general_lables2" style="margin-bottom: 2px">
                <label for="appliedYes"><input type="radio" name="timesApplied" value="1" id="appliedYes" required> Yes</label>
                <label for="appliedNo"><input type="radio" name="timesApplied" value="0" id="appliedNo" required> No<br></label>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                g) <?php echo Yii::t('app', 'If you were offered employment, when can you commence work'); ?>?
                <span class="required" style="color:red;">*</span>
              </div>
              <div class="general_lables2">
                <input type="date" name="commencementDate"  required>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                h) <?php echo Yii::t('app', 'If hired, are you willing to submit to a good conduct certificate'); ?>?
                <span class="required" style="color:red;">*</span>
              </div>
              <div class="general_lables2">
                <label for="conductYes"><input type="radio" name="goodConductConsent" value="1" id="conductYes" required> Yes</label>
                <label for="conductNo"><input type="radio" name="goodConductConsent" value="0" id="conductNo" required> No<br></label>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                i) <?php echo Yii::t('app', 'Expected Salary'); ?>
                <span class="required" style="color:red;">*</span>
              </div>
              <div class="general_lables2">
                <input type="text" name="expectedSalary" required>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            6.<?php echo Yii::t('app', 'DECLARATION & CONSENT') ?>
          </legend>
          <div class="grid_block">
            <span>
              <?php echo Yii::t('app', 'I hereby declare that the information and personal data provided by me in the Application for Employment Form, including any accompanying document(s) are true, correct and complete in every aspect. I fully understand and accept that, if at any time after my employment with the Company, it is found that I have given false and misleading information in the Application for Employment Form, the Company has the right to forthwith terminate my employment. I understand that this application does not constitute an offer of employment. I understand that in some cases, credit checks, reference checks and/or good conduct checks will be required and I will be notified if said checks applies to this application. For the purpose of the Personal Data Protection Act 2010, I hereby give my consent to the Company to process all or any of my personal data and information for any purpose related to or in connection with this employment application and if required, to disclose or transfer such data to any company affiliate for the purpose of processing such data, which may be located outside Malaysia.') ?>
            </span>
            <span id="termsCheckBox">
              <div class="general_lables" style="width:40px;">
                <input type="checkbox" name="agreeTerms" id="agreeTerms" style="float: left;"  value="1" required>
              </div>
              <div class="general_lables2" style="margin-top: 12px; width: 300px;">
                <label for="agreeTerms"><?php echo Yii::t('app', 'I have read and agree to the above terms.') ?></label>
                <span class="required" style="color:red;">*</span>
              </div>
            </span>
          </div>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <input type="date" class="inputLine" name="signatureDate" value="<?php echo $dateToday ?>">
                <br>
                <span>
                  <?php echo Yii::t('app', 'Date') ?>
                </span>
              </div>
            </div>
            <div class="lable_block" id="save_button">
              <div class="row buttons">
                <?php echo CHtml::submitButton('Submit Application'); ?>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </form>
  </div>
</div>
<div id="registration-common-msg">
  <div id="msg-search-method" data-msg="<?php echo Yii::t('app', 'Please state a method'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
  <div id="msg-terminated_before" data-msg="<?php echo Yii::t('app', 'Please state why you were terminated'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
  <div id="msg-refuse-consent" data-msg="<?php echo Yii::t('app', 'Please explain why you would not want us to call for reference'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
  <div id="msg-criminal-offence" data-msg="<?php echo Yii::t('app', 'Please state your offence, date of conviction and date of discharge.'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
  <div id="msg-has-relative" data-msg="<?php echo Yii::t('app', 'Please state name of relative or friend'); ?>"><!-- Dialog Buttons Label --></div>
</div>