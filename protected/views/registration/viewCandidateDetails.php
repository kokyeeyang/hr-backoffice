<div id="tabs" class="tabs ui-tabs ui-widget ui-widget-content ui-corner-all" style="width:100%;">
  <div id="tabs-1" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
    <form method="post" action="<?php echo $this->createUrl('registration/updateSelectedCandidate', array('candidateId' => $candidateId)) ?>" id="candidateForm" name="candidateForm">
      <div>
        <fieldset class="fieldset">
          <legend class="legend">
            1.<?php echo Yii::t('app', 'PERSONAL PARTICULARS'); ?>
          </legend>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <span>
                  <?php echo Yii::t('app', 'Full Name as per NRIC'); ?> :
                </span>
              </div>
              <?php foreach($candidateArrRecords as $candidateObjRecord){ ?>
              <div class="lables2">
                <input type="text" name="fullName" placeholder="(<?php echo Yii::t('app', 'IN BLOCK LETTERS'); ?>)" value="<?php echo $candidateObjRecord->full_name ?>"required <?php echo $access ?>>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Contact No'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="text" name="contactNo" value="<?php echo $candidateObjRecord->contact_no ?>" required <?php echo $access ?>>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Email Address'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="email" name="emailAddress" value="<?php echo $candidateObjRecord->email_address ?>" required <?php echo $access ?>>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Correspondence Address'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="text" name="address" value="<?php echo $candidateObjRecord->address ?>" required <?php echo $access ?>>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Date of birth'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="text" name="DOB" value="<?php echo str_replace('00:00:00', '', $candidateObjRecord->date_of_birth) ?>" required <?php echo $access ?>>
              </div>
            </div>
          </div>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Gender'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="radio" name="gender" value="male" id="male" <?php echo($candidateObjRecord->gender == 'male')?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="male"><span>Male </span></label>          
                <input type="radio" name="gender" value="female" id="female" <?php echo($candidateObjRecord->gender == 'female')?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="female"><span>Female </span></label>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'NRIC/Passport No'); ?>  :</span>
              </div>
              <div class="lables2">
                <input type="text" name="idNo" value="<?php echo $candidateObjRecord->id_no ?>" required <?php echo $access ?>>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Marital Status'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="text" name="maritalStatus" value="<?php echo $candidateObjRecord->marital_status ?>" required <?php echo $access ?>>
              </div>
            </div>
            <div class="lable_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Nationality'); ?> :</span>
              </div>
              <div class="lables2">
                <input type="text" name="nationality" value="<?php echo $candidateObjRecord->nationality ?>" required <?php echo $access ?>>
              </div>
            </div>
          </div>
          <div class="radio-buttons">
            <span>
              <label for="jobstreet"><?php echo Yii::t('app', 'How did you find out about SagaOs'); ?>?</label>
            </span>
          </div>
          <div class="radio-buttons">
            <input type="radio" name="findingMethod" value="jobstreet" id="jobstreet" <?php echo($candidateObjRecord->finding_method == 'JOBSTREET')?'checked ':'' ?>required <?php echo $access ?>>&nbsp;
            <span>
              <label for="jobstreet"><?php echo Yii::t('app', 'Jobstreet'); ?></label>
            </span>

            <input type="radio" name="findingMethod" value="linkedin" id="linkedin" <?php echo($candidateObjRecord->finding_method == 'LINKEDIN')?'checked ':'' ?> required <?php echo $access ?>>&nbsp;
            <span>
              <label for="linkedin"><?php echo Yii::t('app', 'LinkedIn'); ?></label>
            </span>

            <input type="radio" name="findingMethod" value="agency" id="agency" <?php echo($candidateObjRecord->finding_method == 'AGENCY')?'checked ':'' ?>required <?php echo $access ?>>&nbsp;
            <span>
              <label for="agency"><?php echo Yii::t('app', 'Agency'); ?></label>
            </span>

            <input type="radio" name="findingMethod" value="internal-referral" id="internal-referral" <?php echo(strpos($candidateObjRecord->finding_method, 'NTERNAL-REFERRAL-') == 1)?'checked ':'' ?> required <?php echo $access ?>>&nbsp;
            <span>
              <label for="internal-referral"><?php echo Yii::t('app', 'Internal Referral'); ?></label>
            </span>

            <input type="radio" name="findingMethod" value="others" id="others" <?php echo(strpos($candidateObjRecord->finding_method, 'THERS-') == 1)?'checked ':'' ?> required <?php echo $access ?>>&nbsp;
            <span>
              <label for="others"><?php echo Yii::t('app', 'Others'); ?></label>
            </span>

            <input type="text" name="otherFindingMethod" id="otherInputLine" style="display:none; width:20%;" placeholder="Please specify" value="<?php echo(strpos($candidateObjRecord->finding_method, 'THERS-') == 1)?str_replace('OTHERS-', '', $candidateObjRecord->finding_method):'' ?>" <?php echo $access ?>>

            <input type="text" name="referralFindingMethod" id="referralInputLine" style="display:none; width:20%;" placeholder="Please specify who" value="<?php echo(strpos($candidateObjRecord->finding_method, 'NTERNAL-REFERRAL-') == 1)?str_replace('INTERNAL-REFERRAL-', '', $candidateObjRecord->finding_method):'' ?>" <?php echo $access ?>>
          </div>
        <?php } ?>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            2.<?php echo Yii::t('app', 'EDUCATION & PROFESSIONAL QUALIFICATION'); ?>
          </legend>
          <?php foreach($educationArrRecords as $educationObjRecord){ ?>
            <div class="grid_block">
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Name of School/College/University'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="text" name="schoolName[]" class="educationSectionInput" value="<?php echo $educationObjRecord->school_name ?>" <?php echo $access ?>><br>
                </div>
              </div>
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Year from'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="year" name="startYear[]" class="educationSectionInput" value="<?php echo $educationObjRecord->start_year ?>" <?php echo $access ?>><br>
                </div>
              </div>
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Year to'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="year" name="endYear[]" class="educationSectionInput" value="<?php echo $educationObjRecord->end_year ?>" <?php echo $access ?>><br>
                </div>
              </div>
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Qualification & Subject Obtained'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="text" name="qualification[]" class="educationSectionInput" value="<?php echo $educationObjRecord->qualification ?>" <?php echo $access ?>><br>
                </div>
              </div>
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Grade/CGPA'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="text" name="cgpa[]" class="educationSectionInput" value="<?php echo $educationObjRecord->grade ?>" <?php echo $access ?>><br>
                </div>
              </div>
            </div>            
          <?php } ?>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            3.<?php echo Yii::t('app', 'PRESENT AND PREVIOUS EMPLOYMENT'); ?>
          </legend>
          <?php foreach($jobExperienceArrRecords as $jobExperienceObjRecord){ ?>
          <div class="grid_block">
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Name of Company'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="companyName[]" value="<?php echo $jobExperienceObjRecord->company_name ?>" <?php echo $access ?>>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'From'); ?>
              </div>
              <div class="lables2">
                <input type="year" name="startDate[]" placeholder="E.g: 01/2018 for Jan 2018" value="<?php echo $jobExperienceObjRecord->start_date ?>" <?php echo $access ?>>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'To'); ?>
              </div>
              <div class="lables2">
                <input type="year" name="endDate[]" placeholder="E.g: 01/2018 for Jan 2018" value="<?php echo $jobExperienceObjRecord->end_date ?>" <?php echo $access ?>>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Position Held'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="positionHeld[]" value="<?php echo $jobExperienceObjRecord->position_held ?>" <?php echo $access ?>>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Final Salary'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="endingSalary[]" value="<?php echo $jobExperienceObjRecord->ending_salary ?>" <?php echo $access ?>>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Allowances'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="allowances[]" value="<?php echo $jobExperienceObjRecord->allowances ?>" <?php echo $access ?>>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Reason for leaving'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="leaveReason[]" value="<?php echo $jobExperienceObjRecord->leave_reason ?>" <?php echo $access ?>>
              </div>
            </div>
          </div>          
          <?php } ?>
          <?php foreach($candidateArrRecords as $candidateObjRecord){ ?>
          <!-- <div class="grid_block"> -->
            <div class="display_inline_block" style="margin-left: 10px;">
              <div class="lables">
                <?php echo Yii::t('app', 'Have you ever been terminated/dismissed/suspended from the service of any employer'); ?>?<br>
                <?php echo Yii::t('app', 'If yes, please give details'); ?><br>
                <input type="text" name="terminationDetails" class="inputLine" id="terminationReason" style="display:none;" <?php echo($candidateObjRecord->terminated_before == 1)?"value='$candidateObjRecord->termination_reason'":'' ?> <?php echo $access ?>><br><br>
              </div>
              <div class="lables2">
                <input type="radio" name="terminatedBefore" value="1" id="terminatedYes" <?php echo($candidateObjRecord->terminated_before == 1)?'checked="checked"':'' ?> <?php echo $access ?>> <label for="terminatedYes">Yes</label><br>
                <input type="radio" name="terminatedBefore" value="0" id="terminatedNo" <?php echo($candidateObjRecord->terminated_before == 0)?'checked="checked"':'' ?> <?php echo $access ?>> <label for="terminatedNo">No</label><br>
              </div>
            </div>
          <!-- </div> -->
          <?php } ?>
        </fieldset>
        <fieldset class="fieldset">
          <legend class="legend">
            4.<?php echo Yii::t('app', 'REFEREES (Previous Superiors)'); ?>
          </legend>
          <?php foreach($refereeArrRecords as $refereeObjRecord){ ?>
          <div class="grid_block">
            <div class="display_inline_block">
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Name'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="text" name="superiorName[]" value="<?php echo $refereeObjRecord->supervisor_name ?>" <?php echo $access ?>>
                </div>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Company'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="year" name="superiorCompany[]" value="<?php echo $refereeObjRecord->supervisor_company ?>" <?php echo $access ?>>
                </div>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Occupation'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="year" name="superiorOccupation[]" value="<?php echo $refereeObjRecord->supervisor_occupation ?>" <?php echo $access ?>>
                </div>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Contact No.'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="text" name="superiorContact[]" value="<?php echo $refereeObjRecord->supervisor_contact ?>" <?php echo $access ?>>
                </div>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lable_block">
                <div class="lables">
                  <span><?php echo Yii::t('app', 'Years Known'); ?>:</span><br>
                </div>
                <div class="lables2">
                  <input type="text" name="yearsKnown[]" value="<?php echo $refereeObjRecord->years_known ?>" <?php echo $access ?>>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php foreach($candidateArrRecords as $candidateObjRecord){ ?>
          <!-- <div class="grid_block"> -->
            <div class="display_inline_block">
              <div class="lable_block">
                <div class="lables">
                  <?php echo Yii::t('app', 'Can we make references to your employment records with your previous employers/companies'); ?>?<br>
                  <?php echo Yii::t('app', 'If no, please give reasons'); ?><br>
                  <input type="text" name="noReferenceReason" id="noReference" value="<?php echo($candidateObjRecord->reference_consent == 0)?'$candidateObjRecord->refuse_reference_reason':'' ?>" style="display:none" <?php echo $access ?>><br><br>
                </div>
                <div class="lables2">
                  <input type="radio" name="consent" value="1" id="referenceYes" <?php echo($candidateObjRecord->reference_consent == 1)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="referenceYes">Yes<br></label>
                  <input type="radio" name="consent" value="0" id="referenceNo" <?php echo($candidateObjRecord->reference_consent == 0)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="referenceNo">No<br></label>
                </div>
              </div>
            </div>
          <!-- </div> -->
          <?php } ?>
        </fieldset>
        <?php foreach($generalQuestionArrRecords as $generalQuestionObjRecord){ ?>
        <!-- <?php } ?> -->
        <fieldset class="fieldset">
          <legend class="legend">
            5.<?php echo Yii::t('app', 'GENERAL') ?>
          </legend>
          <div class="general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                a) <?php echo Yii::t('app', 'Are you suffering from any physical disabilities or have ever been seriously ill'); ?>?
              </div>
              <div class="general_lables2">
                <input type="radio" name="illness" value="1" id="illnessYes" <?php echo($generalQuestionObjRecord->has_physical_ailment == 1)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="illnessYes">Yes</label>
                <input type="radio" name="illness" value="0" id="illnessNo" <?php echo($generalQuestionObjRecord->has_physical_ailment == 0)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="illnessNo">No<br></label>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                b) <?php echo Yii::t('app', 'Have you ever been convicted for a criminal offence, declared bankrupt, revoked of professional practicing license/certificate and/or charged in court?'); ?>? <br>
                <?php echo Yii::t('app', 'If yes, please state offence and date of conviction and discharge'); ?>
               <input type="text" name="criminalOffenseInput" style="display: none;" id="criminalOffenseInput" class="crimeBox" placeholder="Offence" <?php echo $access ?>>
               <input type="date" name="convictedDate" style="display: none;" id="convictedDate" class="crimeBox" title="Convicted date" <?php echo $access ?>>
               <input type="date" name="dischargeDate" style="display: none;" id="dischargeDate" class="crimeBox" title="Date of discharge" <?php echo $access ?>>
              </div>
              <div class="general_lables2">
                <input type="radio" name="criminalOffenseRadio" value="1" id="convictedYes" <?php echo($generalQuestionObjRecord->has_been_convicted == 1)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="convictedYes">Yes</label>
                <input type="radio" name="criminalOffenseRadio" value="0" id="convictedNo" <?php echo($generalQuestionObjRecord->has_been_convicted == 0)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="convictedNo">No</label><br>
              </div>
            </div>
          </div>
          <div class="general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                c) <?php echo Yii::t('app', 'Do you have any relatives or friends working in SagaOS or its subsidiaries? If so, please state name and relationship'); ?>? <br>
                 <input type="text" name="sagaosContactNameInput" style="display: none; margin-bottom:5px; margin-top:5px;" id="sagaosContactName" placeholder="Contact name" <?php echo $access ?>>
                 <input type="text" name="sagaosFamilyInput" style="display: none;" id="sagaosFamilyInput" placeholder="Relationship with him/her" <?php echo $access ?>><br>
              </div>
              <div class="general_lables2">
                <input type="radio" name="sagaosRelative" value="1" id="relativeYes" <?php echo($generalQuestionObjRecord->has_company_contact == 1)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="relativeYes">Yes</label><br>
                <input type="radio" name="sagaosRelative" value="0" id="relativeNo" <?php echo($generalQuestionObjRecord->has_company_contact == 0)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="relativeNo">No</label><br>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                d) <?php echo Yii::t('app', 'Any relatives involved directly or indirectly in similar company’s business'); ?>?
              </div>
              <div class="general_lables2">
                <input type="radio" name="interestConflict" value="1" id="conflictYes" <?php echo($generalQuestionObjRecord->has_conflict_of_interest == 1)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="conflictYes"> Yes</label>
                <input type="radio" name="interestConflict" value="0" id="conflictNo" <?php echo($generalQuestionObjRecord->has_conflict_of_interest == 0)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="conflictNo"> No</label><br>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                e) <?php echo Yii::t('app', 'Do you possess a car or motorcycle'); ?>?
              </div>
              <div class="general_lables2">
                <input type="radio" name="ownTransport" value="1" id="transportYes" <?php echo($generalQuestionObjRecord->has_own_transport == 1)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="transportYes">Yes</label>
                <input type="radio" name="ownTransport" value="0" id="transportNo" <?php echo($generalQuestionObjRecord->has_own_transport == 0)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="transportNo">No</label><br>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                g) <?php echo Yii::t('app', 'Have you ever applied to/worked at SagaOS before'); ?>?
              </div>
              <div class="general_lables2" style="margin-bottom: 2px">
                <input type="radio" name="timesApplied" value="1" id="appliedYes" <?php echo($generalQuestionObjRecord->has_applied_before == 1)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="appliedYes"> Yes</label>
                <input type="radio" name="timesApplied" value="0" id="appliedNo" <?php echo($generalQuestionObjRecord->has_applied_before == 0)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="appliedNo"> No</label><br>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                h) <?php echo Yii::t('app', 'If you were offered employment, when can you commence work'); ?>?
              </div>
              <div class="general_lables2">
                <input type="text" name="commencementDate" value="<?php echo str_replace('00:00:00', '', $generalQuestionObjRecord->commencement_date) ?>" required <?php echo $access ?>>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                i) <?php echo Yii::t('app', 'If hired, are you willing to submit to a good conduct certificate'); ?>?
              </div>
              <div class="general_lables2">
                <input type="radio" name="goodConductConsent" value="1" id="conductYes" <?php echo($generalQuestionObjRecord->good_conduct_consent == 1)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="conductYes">Yes</label>
                <input type="radio" name="goodConductConsent" value="0" id="conductNo" <?php echo($generalQuestionObjRecord->good_conduct_consent == 0)?'checked="checked"':'' ?> required <?php echo $access ?>> <label for="conductNo">No</label><br>
              </div>
            </div>
          </div>
          <div class="short_general_grid_block">
            <div class="general_lable_block">
              <div class="general_lables">
                j) <?php echo Yii::t('app', 'Expected Salary'); ?>
              </div>
              <div class="general_lables2">
                <input type="text" name="expectedSalary" value="<?php echo $generalQuestionObjRecord->expected_salary ?>" required <?php echo $access ?>>
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
                <input type="checkbox" name="agreeTerms" id="agreeTerms" style="float: left;"  value="1" <?php echo($candidateObjRecord->candidate_agree_terms == 1)?'checked="checked"':'' ?> <?php echo $access ?> required>
              </div>
              <div class="general_lables2" style="margin-top: 12px; width: 300px;">
                <label for="agreeTerms"><?php echo Yii::t('app', 'I have read and agree to the above terms.') ?></label>
              </div>
            </span>
          </div>
          <?php foreach($candidateArrRecords as $candidateObjRecord){ ?>
          <div class="grid_block">
            <div class="lable_block">
              <div class="lables">
                <input type="text" class="inputLine" name="signatureDate" value="<?php echo str_replace('00:00:00', '', $candidateObjRecord->candidate_signature_date) ?>" <?php echo $access ?>>
                <br>
                <span>
                  <?php echo Yii::t('app', 'Date') ?>
                </span>
              </div>
            </div>
            <div class="lable_block" id="save_button">
              <div class="row buttons">
                <?php echo CHtml::submitButton('Save'); ?>
              </div>
            </div>
          </div>
          <?php } ?>
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




