<div id="tabs" class="tabs ui-tabs ui-widget ui-widget-content ui-corner-all" style="width:100%;">
  <div id="tabs-1" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
    <form method="post" action="<?php echo $this->createUrl('registration/saveCandidate') ?>" id="candidateForm" name="candidateForm">
      <div>
        <fieldset class="fieldset">
          <legend class="legend">
            1.<?php echo Yii::t('app', 'Personal Particulars'); ?>
          </legend>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <span>
                  <?php echo Yii::t('app', 'Full Name as per NRIC'); ?> :
                </span>
              </div>
              <div class="lables2">
                <input type="text" name="fullName" placeholder="(<?php echo Yii::t('app', 'IN BLOCK LETTERS'); ?>)">
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Contact No'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="text" name="contactNo">
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Email Address'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="email" name="emailAddress">
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Correspondence Address'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="text" name="address">
              </div>
            </div>
          </div>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Gender'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="radio" name="gender" value="male"> <span>Male </span>          
                <input type="radio" name="gender" value="female"> <span>Female </span>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'NRIC/Passport No'); ?>  :</span>
              </div>
              <div class="lables2">
                <input type="text" name="idNo">
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Marital Status'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="text" name="maritalStatus" value="">
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Nationality'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="text" name="nationality">
              </div>
            </div>
          </div>
          <div class="radio-buttons">
            <span>
              <label for="jobstreet"><?php echo Yii::t('app', 'How did you find out about us'); ?>?</label>
            </span>
          </div>
          <div class="radio-buttons">
            <input type="radio" name="findingMethod" value="jobstreet" id="jobstreet">&nbsp;
            <span>
              <label for="jobstreet"><?php echo Yii::t('app', 'Jobstreet'); ?></label>
            </span>
            <input type="radio" name="findingMethod" value="linkedin" id="linkedin">&nbsp;
            <span>
              <label for="linkedin"><?php echo Yii::t('app', 'LinkedIn'); ?></label>
            </span>
            <input type="radio" name="findingMethod" value="agency" id="agency">&nbsp;
            <span>
              <label for="agency"><?php echo Yii::t('app', 'Agency'); ?></label>
            </span>
            <input type="radio" name="findingMethod" value="internal-referral" id="internal-referral">&nbsp;
            <span>
              <label for="internal-referral"><?php echo Yii::t('app', 'Internal Referral'); ?></label>
            </span>
            <input type="radio" name="findingMethod" value="others" id="others">&nbsp;
            <span>
              <label for="others"><?php echo Yii::t('app', 'Others'); ?></label>
            </span>
            <input type="text" name="findingMethod" id="otherInputLine" style="display:none; width:20%;" placeholder="Please specify">
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
          <div class="grid_block" style="margin-left: 0px;">
            <div class="lable_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Have you ever been terminated/dismissed/suspended from the service of any employer'); ?>?<br>
                <?php echo Yii::t('app', 'If yes, please give details'); ?><br>
                <input type="text" name="terminationDetails[]" id="terminationReason" style="display:none;"><br><br>
              </div>
              <div class="lables2">
                <input type="radio" name="terminatedBefore" value="1"> Yes<br>
                <input type="radio" name="terminatedBefore" value="0"> No<br>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            4.<?php echo Yii::t('app', 'REFEREES (Previous Superiors'); ?>
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
                <input type="radio" name="consent" value="1"> Yes<br>
                <input type="radio" name="consent" value="0"> No<br>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            5.<?php echo Yii::t('app', 'General') ?>
          </legend>
          <div class="general_grid_block">
            <div class="lable_block">
              <div class="general_lables">
                a) <?php echo Yii::t('app', 'Are you suffering from any physical disabilities or have ever been seriously ill'); ?>?
              </div>
              <div class="general_lables2">
                <input type="radio" name="illness" value="1"> Yes
                <input type="radio" name="illness" value="0"> No<br>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="lable_block">
              <div class="general_lables">
                b) <?php echo Yii::t('app', 'Have you ever been convicted for a criminal offence, declared bankrupt, revoked of professional practicing license/certificate and/or charged in court?'); ?>? <br>
                <?php echo Yii::t('app', 'If yes, please state offence and date of conviction and discharge'); ?>
                <input type="text" name="criminalOffenseInput" style="display: none;" id="criminalOffenseInput">
              </div>
              <div class="general_lables2">
                <input type="radio" name="criminalOffenseRadio" value="1"> Yes
                <input type="radio" name="criminalOffenseRadio" value="0"> No<br>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="lable_block">
              <div class="general_lables">
                c) <?php echo Yii::t('app', 'Do you have any relatives or friends working in SagaOS or its subsidiaries? If so, please state name and relationship'); ?>? <br>
                 <input type="text" name="sagaosFamilyInput" style="display: none;" id="sagaosFamilyInput">
              </div>
              <div class="general_lables2">
                <input type="radio" name="sagaosRelative" value="1"> Yes
                <input type="radio" name="sagaosRelative" value="0"> No<br>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="lable_block">
              <div class="general_lables">
                d) <?php echo Yii::t('app', 'Any relatives involved directly or indirectly in similar company’s business'); ?>?
              </div>
              <div class="general_lables2">
                <input type="radio" name="interestConflict" value="1"> Yes
                <input type="radio" name="interestConflict" value="0"> No<br>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="lable_block">
              <div class="general_lables">
                e) <?php echo Yii::t('app', 'Do you possess a car or motorcycle'); ?>?
              </div>
              <div class="general_lables2">
                <input type="radio" name="ownTransport" value="1"> Yes
                <input type="radio" name="ownTransport" value="0"> No<br>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="lable_block">
              <div class="general_lables">
                g) <?php echo Yii::t('app', 'Have you ever applied to/worked at SagaOS before'); ?>?
              </div>
              <div class="general_lables2">
                <input type="radio" name="timesApplied" value="1"> Yes
                <input type="radio" name="timesApplied" value="0"> No<br>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="lable_block">
              <div class="general_lables">
                h) <?php echo Yii::t('app', 'If you were offered employment, when can you commence work'); ?>?
              </div>
              <div class="general_lables2">
                <input type="text" name="commencementDate">
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="lable_block">
              <div class="general_lables">
                i) <?php echo Yii::t('app', 'If hired, are you willing to submit to a good conduct certificate'); ?>?
              </div>
              <div class="general_lables2">
                <input type="radio" name="goodConductConsent" value="1"> Yes
                <input type="radio" name="goodConductConsent" value="0"> No<br>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="lable_block">
              <div class="general_lables">
                j) <?php echo Yii::t('app', 'Expected Salary'); ?>
              </div>
              <div class="general_lables2">
                <input type="text" name="expectedSalary">
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
          </div>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <input type="text" class="inputLine" name="signature">
                <br>
                <span>
                  <?php echo Yii::t('app', 'Signature') ?>
                </span>
              </div>
              <div class="lables2">
                <input type="text" class="inputLine" name="signatureDate">
                <br>
                <span>
                  <?php echo Yii::t('app', 'Date') ?>
                </span>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </form>
  </div>
</div>





