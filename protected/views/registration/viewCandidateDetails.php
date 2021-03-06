<div id="tabs" class="tabs ui-tabs ui-widget ui-widget-content ui-corner-all" style="width:100%;">
    <div id="tabs-1" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
        <form method="post" action="<?php echo $this->createUrl('registration/updateSelectedCandidate', array('candidateId' => $candidateId)) ?>" id="candidateForm" name="candidateForm">
            <div>
                <fieldset class="fieldset">
                    <div id="mediaSection">
                        <div id="candidateResume" style="display:<?php echo $displayResumeSection ?>">
                            <a href="<?php echo $resumeSource ?>" title="Click here to download resume" download>
                                <img src="/images/alllanguages/download-logo.png" class="candidateDocument">
                            </a>
                        </div>
                        <div id="candidateCoverLetter" style="display:<?php echo $displayCoverLetterSection ?>">
                            <a href="<?php echo $coverLetterSource ?>" title="Click here to download cover letter" download>
                                <img src="/images/alllanguages/download-logo.png" class="candidateDocument">
                            </a>
                        </div>
                    </div>
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
                                <input type="text" name="fullName" placeholder="(<?php echo Yii::t('app', 'IN BLOCK LETTERS'); ?>)" value="<?php echo $candidateArrRecords['full_name'] ?>"required <?php echo $access ?>>
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span>
                                    <?php echo Yii::t('app', 'Contact No'); ?>
                                    <span class="required">*</span> 
                                    :
                                </span>
                            </div>
                            <div class="lables2">
                                <input type="text" name="contactNo" value="<?php echo $candidateArrRecords['contact_no'] ?>" required <?php echo $access ?>>
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
                                <input type="email" name="emailAddress" value="<?php echo $candidateArrRecords['email_address'] ?>" required <?php echo $access ?>>
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
                                <input type="text" name="address" value="<?php echo $candidateArrRecords['address'] ?>" required <?php echo $access ?>>
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
                                <input type="text" name="DOB" value="<?php echo str_replace('00:00:00', '', $candidateArrRecords['date_of_birth']) ?>" required <?php echo $access ?>>
                            </div>
                        </div>
                    </div>
                    <div class="grid_block">
                        <div class="lable_block">
                            <div class="lables">
                                <span>
                                    <?php echo Yii::t('app', 'Gender'); ?> 
                                    <span class="required">*</span>
                                    :
                                </span>
                            </div>
                            <div class="lables2">
                                <input type="radio" name="gender" value="MALE" id="male" <?php echo($candidateArrRecords['gender'] == 'MALE') ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="male"><span>Male </span></label>          
                                <input type="radio" name="gender" value="FEMALE" id="female" <?php echo($candidateArrRecords['gender'] == 'FEMALE') ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="female"><span>Female </span></label>
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
                                <input type="text" name="idNo" value="<?php echo $candidateArrRecords['id_no'] ?>" required <?php echo $access ?>>
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
                                <input type="text" name="maritalStatus" value="<?php echo $candidateArrRecords['marital_status'] ?>" required <?php echo $access ?>>
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
                                <input type="text" name="nationality" value="<?php echo $candidateArrRecords['nationality'] ?>" required <?php echo $access ?>>
                            </div>
                        </div>
                    </div>
                    <div class="radio-buttons">
                        <span>
                            <label for="jobstreet">
                                <?php echo Yii::t('app', 'How did you find out about SagaOs'); ?>?
                                <span class="required">*</span>
                            </label>
                        </span>
                    </div>
                    <div class="radio-buttons">
                        <input type="radio" name="findingMethod" value="jobstreet" id="jobstreet" <?php echo($candidateArrRecords['finding_method'] == 'JOBSTREET') ? 'checked ' : '' ?>required <?php echo $access ?>>&nbsp;
                        <span>
                            <label for="jobstreet"><?php echo Yii::t('app', 'Jobstreet'); ?></label>
                        </span>

                        <input type="radio" name="findingMethod" value="linkedin" id="linkedin" <?php echo($candidateArrRecords['finding_method'] == 'LINKEDIN') ? 'checked ' : '' ?> required <?php echo $access ?>>&nbsp;
                        <span>
                            <label for="linkedin"><?php echo Yii::t('app', 'LinkedIn'); ?></label>
                        </span>

                        <input type="radio" name="findingMethod" value="agency" id="agency" <?php echo($candidateArrRecords['finding_method'] == 'AGENCY') ? 'checked ' : '' ?>required <?php echo $access ?>>&nbsp;
                        <span>
                            <label for="agency"><?php echo Yii::t('app', 'Agency'); ?></label>
                        </span>

                        <input type="radio" name="findingMethod" value="internal-referral" id="internal-referral" <?php echo(strpos($candidateArrRecords['finding_method'], 'NTERNAL-REFERRAL-') == 1) ? 'checked ' : '' ?> required <?php echo $access ?>>&nbsp;
                        <span>
                            <label for="internal-referral"><?php echo Yii::t('app', 'Internal Referral'); ?></label>
                        </span>

                        <input type="radio" name="findingMethod" value="others" id="others" <?php echo(strpos($candidateArrRecords['finding_method'], 'THERS-') == 1) ? 'checked ' : '' ?> required <?php echo $access ?>>&nbsp;
                        <span>
                            <label for="others"><?php echo Yii::t('app', 'Others'); ?></label>
                        </span>

                        <input type="text" name="otherFindingMethod" id="otherInputLine" style="display:none; width:20%;" placeholder="Please specify" value="<?php echo(strpos($candidateArrRecords['finding_method'], 'THERS-') == 1) ? str_replace('OTHERS-', '', $candidateArrRecords['finding_method']) : '' ?>" <?php echo $access ?>>

                        <input type="text" name="referralFindingMethod" id="referralInputLine" style="display:none; width:20%;" placeholder="Please specify who" value="<?php echo(strpos($candidateArrRecords['finding_method'], 'NTERNAL-REFERRAL-') == 1) ? str_replace('INTERNAL-REFERRAL-', '', $candidateArrRecords['finding_method']) : '' ?>" <?php echo $access ?>>
                    </div>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="legend">
                        2.<?php echo Yii::t('app', 'EDUCATION & PROFESSIONAL QUALIFICATION'); ?>
                    </legend>
                    <?php foreach ($educationArrRecords as $educationObjRecord) { ?>
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
                    <?php foreach ($jobExperienceArrRecords as $jobExperienceObjRecord) { ?>
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
                    <div class="display_inline_block" style="margin-left: 10px;">
                        <div class="lables">
                            <?php echo Yii::t('app', 'Have you ever been terminated/dismissed/suspended from the service of any employer'); ?>?<br>
                            <?php echo Yii::t('app', 'If yes, please give details'); ?><br>
                            <?php $candidateArrRecords['terminated_before'] == 1 ? $value = $candidateArrRecords['termination_reason'] : $value = '' ?>
                            <input type="text" name="terminationDetails" class="inputLine" id="terminationReason" style="display:none;" value="<?php echo $value ?>" <?php echo $access ?>><br><br>
                        </div>
                        <div class="lables2">
                            <input type="radio" name="terminatedBefore" value="1" id="terminatedYes" <?php echo($candidateArrRecords['terminated_before'] == 1) ? 'checked="checked"' : '' ?> <?php echo $access ?>> <label for="terminatedYes">Yes</label><br>
                            <input type="radio" name="terminatedBefore" value="0" id="terminatedNo" <?php echo($candidateArrRecords['terminated_before'] == 0) ? 'checked="checked"' : '' ?> <?php echo $access ?>> <label for="terminatedNo">No</label><br>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="legend">
                        4.<?php echo Yii::t('app', 'REFEREES (Previous Superiors)'); ?>
                    </legend>
                    <?php foreach ($refereeArrRecords as $refereeObjRecord) { ?>
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
                                        <span><?php echo Yii::t('app', 'Email Address'); ?>:</span><br>
                                    </div>
                                    <div class="lables2">
                                        <input type="text" name="superiorEmail[]" value="<?php echo $refereeObjRecord->supervisor_email ?>">
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
                    <div class="grid_block" id="extraReferee1" style="display:none">
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Name'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="extraSuperiorName1" <?php echo $access ?>>
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Company'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="year" name="extraSuperiorCompany1">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Occupation'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="year" name="extraSuperiorOccupation1">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Contact No.'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="extraSuperiorContact1">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Email Address'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="extraSuperiorEmail1">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Years Known'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="extraYearsKnown1">
                            </div>
                        </div>
                    </div>
                    <div class="grid_block" id="extraReferee2" style="display:none">
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Name'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="extraSuperiorName2">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Company'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="year" name="extraSuperiorCompany2">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Occupation'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="year" name="extraSuperiorOccupation2">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Contact No.'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="extraSuperiorContact2">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Email Address'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="extraSuperiorEmail2">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Years Known'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="extraYearsKnown2">
                            </div>
                        </div>
                    </div>
                    <div class="display_inline_block">
                        <input type="button" id="add" value="<?php echo Yii::t('app', 'Add more referees'); ?>" <?php echo $access ?>>
                    </div>
                    <div class="display_inline_block">
                        <div class="lable_block">
                            <div class="lables">
                                <?php echo Yii::t('app', 'Can we make references to your employment records with your previous employers/companies'); ?>?<br>
                                <?php echo Yii::t('app', 'If no, please give reasons'); ?><br>
                                <input type="text" name="noReferenceReason" id="noReference" value="<?php echo($candidateArrRecords['reference_consent'] == 0) ? $candidateArrRecords['refuse_reference_reason'] : '' ?>" style="display:none" <?php echo $access ?>><br><br>
                            </div>
                            <div class="lables2">
                                <input type="radio" name="consent" value="1" id="referenceYes" <?php echo($candidateArrRecords['reference_consent'] == 1) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="referenceYes">Yes<br></label>
                                <input type="radio" name="consent" value="0" id="referenceNo" <?php echo($candidateArrRecords['reference_consent'] == 0) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="referenceNo">No<br></label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <?php foreach ($generalQuestionArrRecords as $generalQuestionObjRecord) { ?>
                    <fieldset class="fieldset">
                        <legend class="legend">
                            5.<?php echo Yii::t('app', 'GENERAL') ?>
                        </legend>
                        <div class="general_grid_block">
                            <div class="general_lable_block">
                                <div class="general_lables">
                                    a) <?php echo Yii::t('app', 'Are you suffering from any physical disabilities or have ever been diagnosed with any illnesses?'); ?>?
                                    <span class="required" style="color:red;">*</span>
                                    <input type="text" name="typeOfIllness" id="typeOfIllness" value="<?php echo($generalQuestionObjRecord->ailment_description == null) ? '' : $generalQuestionObjRecord->ailment_description; ?>" title="Briefly describe" style="display:none"><br><br>
                                </div>
                                <div class="general_lables2">
                                    <input type="radio" name="illness" value="1" id="illnessYes" <?php echo($generalQuestionObjRecord->has_physical_ailment == 1) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="illnessYes">Yes</label>
                                    <input type="radio" name="illness" value="0" id="illnessNo" <?php echo($generalQuestionObjRecord->has_physical_ailment == 0) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="illnessNo">No<br></label>
                                </div>
                            </div>
                        </div>
                        <div class="general_grid_block">
                            <div class="general_lable_block">
                                <div class="general_lables">
                                    b) <?php echo Yii::t('app', 'Have you ever been convicted for a criminal offence, declared bankrupt, revoked of professional practicing license/certificate and/or charged in court?'); ?>? 
                                    <span class="required" style="color:red;">*</span>
                                    <br>
                                    <?php echo Yii::t('app', 'If yes, please state offence and date of conviction and discharge'); ?>
                                    <input type="text" name="criminalOffenseInput" style="display: none;" id="criminalOffenseInput" class="crimeBox" placeholder="Offence" value="<?php echo($generalQuestionObjRecord->offense == null) ? '' : $generalQuestionObjRecord->offense; ?>" <?php echo $access ?>>
                                    <input type="date" name="convictedDate" value="<?php echo($generalQuestionObjRecord->convicted_date == "0000-00-00 00:00:00") ? '' : substr($generalQuestionObjRecord->convicted_date, 0, 10); ?>" style="display: none;" id="convictedDate" class="crimeBox" title="Convicted date" <?php echo $access ?>>
                                    <input type="date" name="dischargeDate" value="<?php echo($generalQuestionObjRecord->convicted_date == "0000-00-00 00:00:00") ? '' : substr($generalQuestionObjRecord->date_of_discharge, 0, 10); ?>" style="display: none;" id="dischargeDate" class="crimeBox" title="Date of discharge" <?php echo $access ?>>
                                </div>
                                <div class="general_lables2">
                                    <input type="radio" name="criminalOffenseRadio" value="1" id="convictedYes" <?php echo($generalQuestionObjRecord->has_been_convicted == 1) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="convictedYes">Yes</label>
                                    <input type="radio" name="criminalOffenseRadio" value="0" id="convictedNo" <?php echo($generalQuestionObjRecord->has_been_convicted == 0) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="convictedNo">No</label><br>
                                </div>
                            </div>
                        </div>
                        <div class="general_grid_block">
                            <div class="general_lable_block">
                                <div class="general_lables">
                                    c) <?php echo Yii::t('app', 'Do you have any relatives or friends working in SagaOS or its subsidiaries? If so, please state name and relationship'); ?>? 
                                    <span class="required" style="color:red;">*</span>
                                    <br>
                                    <input type="text" name="sagaosContactNameInput" style="display: none; margin-bottom:5px; margin-top:5px;" id="sagaosContactName" value="<?php echo($generalQuestionObjRecord->company_contact_name == null) ? '' : $generalQuestionObjRecord->company_contact_name; ?>" placeholder="Contact name" <?php echo $access ?>>
                                    <input type="text" name="sagaosFamilyInput" style="display: none;" id="sagaosFamilyInput" value="<?php echo($generalQuestionObjRecord->relationship_with_candidate == null) ? '' : $generalQuestionObjRecord->relationship_with_candidate; ?>" placeholder="Relationship with him/her" <?php echo $access ?>><br>
                                </div>
                                <div class="general_lables2">
                                    <input type="radio" name="sagaosRelative" value="1" id="relativeYes" <?php echo($generalQuestionObjRecord->has_company_contact == 1) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="relativeYes">Yes</label><br>
                                    <input type="radio" name="sagaosRelative" value="0" id="relativeNo" <?php echo($generalQuestionObjRecord->has_company_contact == 0) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="relativeNo">No</label><br>
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
                                    <input type="radio" name="interestConflict" value="1" id="conflictYes" <?php echo($generalQuestionObjRecord->has_conflict_of_interest == 1) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="conflictYes"> Yes</label>
                                    <input type="radio" name="interestConflict" value="0" id="conflictNo" <?php echo($generalQuestionObjRecord->has_conflict_of_interest == 0) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="conflictNo"> No</label><br>
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
                                    <input type="radio" name="ownTransport" value="1" id="transportYes" <?php echo($generalQuestionObjRecord->has_own_transport == 1) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="transportYes">Yes</label>
                                    <input type="radio" name="ownTransport" value="0" id="transportNo" <?php echo($generalQuestionObjRecord->has_own_transport == 0) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="transportNo">No</label><br>
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
                                    <input type="radio" name="timesApplied" value="1" id="appliedYes" <?php echo($generalQuestionObjRecord->has_applied_before == 1) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="appliedYes"> Yes</label>
                                    <input type="radio" name="timesApplied" value="0" id="appliedNo" <?php echo($generalQuestionObjRecord->has_applied_before == 0) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="appliedNo"> No</label><br>
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
                                    <input type="text" name="commencementDate" value="<?php echo str_replace('00:00:00', '', $generalQuestionObjRecord->commencement_date) ?>" required <?php echo $access ?>>
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
                                    <input type="radio" name="goodConductConsent" value="1" id="conductYes" <?php echo($generalQuestionObjRecord->good_conduct_consent == 1) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="conductYes">Yes</label>
                                    <input type="radio" name="goodConductConsent" value="0" id="conductNo" <?php echo($generalQuestionObjRecord->good_conduct_consent == 0) ? 'checked="checked"' : '' ?> required <?php echo $access ?>> <label for="conductNo">No</label><br>
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
                                    <input type="text" name="expectedSalary" value="<?php echo $generalQuestionObjRecord->expected_salary ?>" required <?php echo $access ?>>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
                                <input type="checkbox" name="agreeTerms" id="agreeTerms" style="float: left;"  value="1" <?php echo($candidateArrRecords['candidate_agree_terms'] == 1) ? 'checked="checked"' : '' ?> <?php echo $access ?> disabled required>
                            </div>
                            <div class="general_lables2" style="margin-top: 12px; width: 300px;">
                                <label for="agreeTerms"><?php echo Yii::t('app', 'I have read and agree to the above terms.') ?></label>
                            </div>
                        </span>
                    </div>
                    <div class="grid_block">
                        <div class="lable_block">
                            <div class="lables">
                                <input type="text" class="inputLine" name="signatureDate" value="<?php echo str_replace('00:00:00', '', $candidateArrRecords['candidate_signature_date']) ?>" <?php echo $access ?> disabled>
                                <br>
                                <span>
                                    <?php echo Yii::t('app', 'Date') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="legend">
                        7.<?php echo Yii::t('app', 'Additional remarks *For internal use only') ?>
                    </legend>
                    <!-- <textarea rows="8" cols="165" name="comment">Enter text here...</textarea> -->
                    <textarea rows="8" name="comment" style="width:100%"><?php echo($candidateArrRecords['remarks'] != '') ? $candidateArrRecords['remarks'] : 'Please enter remarks here' ?></textarea>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="legend">
                        8.<?php echo Yii::t('app', 'General questions *For internal use only') ?>
                    </legend>
                    <?php foreach ($interviewQuestionsArrRecords as $interviewQuestionsObjRecord) { ?>
                        <div class="grid_block">
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'Job Experience'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="suitableExperience" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->suitable_experience; ?></textarea>
                                </div>
                            </div>
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'Aspirations'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="aspirations" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->aspirations; ?></textarea>
                                </div>
                            </div>
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'Passion'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="passion" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->passion; ?></textarea>
                                </div>
                            </div>
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'Background'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="background" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->background; ?></textarea>
                                </div>
                            </div>
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'How do you commute to work?'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="commute" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->commute; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="grid_block">
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'Experience'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="experience" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->experience; ?></textarea>
                                </div>
                            </div>
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'Reason for leaving last company?'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="leaveReason" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->leave_reason; ?></textarea>
                                </div>
                            </div>
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'Current company\'s notice period?'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="noticePeriod" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->notice_period; ?></textarea>
                                </div>
                            </div>
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'Interviewing for other positions?'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="interviewingWithOtherCompanies" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->interviewing_with_other_companies; ?></textarea>
                                </div>
                            </div>
                            <div class="label_block">
                                <div class="lables">
                                    <span><?php echo Yii::t('app', 'Family status (parents, siblings?)'); ?>:</span>
                                </div>
                                <div class="lables2">
                                    <textarea name="familyStatus" rows="3" cols="35"><?php echo $interviewQuestionsObjRecord->family_status; ?></textarea>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="legend">
                        9.<?php echo Yii::t('app', 'Confirm offer letter details') ?>
                    </legend>
                    <div class="lable_block">
                        <div class="lables">
                            <span><?php echo Yii::t('app', 'Full name'); ?>:</span><br>
                        </div>
                        <div class="lables2">
                            <input type="text" name="offerLetterFullName" value="<?php echo $candidateArrRecords['full_name']; ?>">
                        </div>
                    </div>
                    <div class="lable_block">
                        <div class="lables">
                            <span><?php echo Yii::t('app', 'ID No'); ?>:</span><br>
                        </div>
                        <div class="lables2">
                            <input type="text" name="offerLetterIdNo" value="<?php echo $candidateArrRecords['id_no']; ?>">
                        </div>
                    </div>
                    <div class="lable_block">
                        <div class="lables">
                            <span><?php echo Yii::t('app', 'Role'); ?>:</span><br>
                        </div>
                        <div class="lables2">
                            <input type="text" name="offerLetterRole" value="<?php echo EmploymentJobOpening::model()->queryForCandidateInformation($candidateArrRecords['job_id'], EmploymentJobOpeningEnum::CANDIDATE_JOB, EmploymentJobOpeningEnum::ID); ?>" disabled>
                        </div>
                    </div>
                    <?php foreach ($generalQuestionArrRecords as $generalQuestionObjRecord) { ?>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Salary offered to candidate'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="offerLetterExpectedSalary" value="<?php echo $generalQuestionObjRecord->expected_salary; ?>">
                            </div>
                        </div>
                        <div class="lable_block">
                            <div class="lables">
                                <span><?php echo Yii::t('app', 'Probationary salary'); ?>:</span><br>
                            </div>
                            <div class="lables2">
                                <input type="text" name="offerLetterProbationarySalary" value="<?php echo $generalQuestionObjRecord->probationary_salary; ?>">
                            </div>
                        </div>
                    <?php } ?>
                    <div class="buttons" style="margin-left: 400px; margin-right: 50px; width: 40%; border-left: 50px; text-align: center;">
                        <div class="lable_block" id="save_button">
                            <div class="row buttons">
                                <?php echo CHtml::submitButton('Save'); ?>
                            </div>
                        </div>
                        <div class="lable_block" id="offer_letter_button">
                            <input type="button" id="generateOfferEmail" value="<?php echo Yii::t('app', 'Convert to offer'); ?>" data-offer-url="<?php echo $this->createUrl('registration/generateOfferEmail', array('jobId' => $candidateArrRecords['job_id'], 'candidateName' => $candidateArrRecords['full_name'], 'candidateId' => $candidateArrRecords['id_no'])); ?>">
                            <input type="button" id="changeCandidateStatus" data-change-url="<?php echo $this->createUrl('registration/changeCandidateStatus', array('candidateId' => $candidateArrRecords['id_no'])); ?>" style="display:none;">
                            <input type="button" id="changeCandidateStatusToSigned" data-signed-url="<?php echo $this->createUrl('registration/changeCandidateStatusToSigned', array('candidateId' => $candidateArrRecords['id_no'])); ?>" style="display:none;">
                            <input type="button" id="downloadPdf" data-download-url="<?php echo $this->createUrl('registration/downloadPdf', array('jobId' => $candidateArrRecords['job_id'], 'candidateName' => $candidateArrRecords['full_name'], 'candidateId' => $candidateArrRecords['id_no'])); ?>" style="display:none;">
                            <input id="generateOnboardingChecklistTemplate" data-generate-onboarding-url="<?php echo $this->createUrl('registration/assignItemsAndUserAccess', array('candidateId' => $candidateArrRecords['id_no'], 'departmentId'=>$candidateArrRecords['department'], 
				'fullName'=>$candidateArrRecords['full_name'], 'isManagerial'=>$candidateArrRecords['is_managerial_position'])); ?>" style="display:none;">
                        </div>
                        <div class="lable_block" id="generate_template_button">
                            <?php $generateTemplateButtonTitle = Yii::t('app', 'Generate onboarding, training template and user access for this candidate.'); ?>
                            <input type="button" name="generateTemplateButton" id="generateTemplateButton" value="Generate template" title="<?php echo $generateTemplateButtonTitle ?>">
                        </div>
                        <div class="lable_block" id="send_email_checkbox" style="width:20px;">
                            <input type="checkbox" name="sendEmailCheckbox" id="sendEmailCheckbox" value="1">
                        </div>
                        <div class="lable_block">
                            <label for="sendEmailCheckbox" title="<?php echo Yii::t('app', 'Check this if you want to send the candidate an email'); ?>">
                                <?php echo Yii::t('app', 'Send an email'); ?>
                            </label>
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
<div id="registration-common-msg">
    <div id="msg-confirm-offer-email" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to confirm this candidate?'); ?>"></div>
</div>
<div id="registration-common-msg">
    <div id="msg-confirm-generate-template" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to generate template and user access for this user?'); ?>"></div>
</div>




