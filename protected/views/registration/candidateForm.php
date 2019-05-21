<div id="tabs" class="tabs ui-tabs ui-widget ui-widget-content ui-corner-all" style="width:100%;">
  <div id="tabs-1" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
    <form method="post" action="<?php echo $this->createUrl('registration/saveCandidate') ?>" id="candidateForm" name="candidateForm">
      <div>
        <fieldset class="fieldset" style="border: 1px solid #000;">
          <legend class="legend">
            1.<?php echo Yii::t('app', 'Personal Particulars'); ?>
          </legend>
          <div class="display_inline_block">
            <div class="lables">
              <span>
                <?php echo Yii::t('app', 'Full Name as per NRIC'); ?> :
              </span>
            </div>
            <div class="lables2">
              <input type="text" name="fullName" placeholder="(<?php echo Yii::t('app', 'IN BLOCK LETTERS'); ?>)">
            </div>
          </div>
          <div class="display_inline_block">
            <div class="lables">
              <span><?php echo Yii::t('app', 'NRIC/Passport No'); ?>  :</span>
            </div>
            <div class="lables2">
              <input type="text" name="idNo">
            </div>
          </div>
          <div class="display_inline_block">
            <div class="lables">
              <span><?php echo Yii::t('app', 'Correspondence Address'); ?> :</span>
            </div>
            <div class="lables2">
              <input type="text" name="address">
            </div>
          </div>
          <div class="display_inline_block">
            <div class="lables">
              <span><?php echo Yii::t('app', 'Gender'); ?> :</span>
            </div>
            <div class="lables2">
              <input type="radio" name="gender" value="male"> <span>Male </span>          
              <input type="radio" name="gender" value="female"> <span>Female </span>
            </div>
          </div>
          <div class="display_inline_block">
            <div class="lables">
              <span><?php echo Yii::t('app', 'Email Address'); ?> :</span>
            </div>
            <div class="lables2">
              <input type="email" name="emailAddress">
            </div>
          </div>
          <div class="display_inline_block">
            <div class="lables">
              <span><?php echo Yii::t('app', 'Marital Status'); ?> :</span>
            </div>
            <div class="lables2">
              <input type="text" name="maritalStatus" value="">
            </div>
          </div>
          <div class="display_inline_block">
            <div class="lables">
              <span><?php echo Yii::t('app', 'Contact No'); ?> :</span>
            </div>
            <div class="lables2">
              <input type="text" name="contactNo">
            </div>
          </div>
          <div class="display_inline_block">
            <div class="lables">
              <span><?php echo Yii::t('app', 'Nationality'); ?> :</span>
            </div>
            <div class="lables2">
              <input type="text" name="nationality">
            </div>
          </div>
          <div class="radio-buttons">
            <input type="radio" name="findingMethod" value="jobstreet" id="jobstreet">&nbsp;
            <span>
              <label for="jobstreet">Jobstreet</label>
            </span>
            <input type="radio" name="findingMethod" value="linkedin" id="linkedin">&nbsp;
            <span>
              <label for="linkedin">LinkedIn</label>
            </span>
            <input type="radio" name="findingMethod" value="agency" id="agency">&nbsp;
            <span>
              <label for="agency">Agency</label>
            </span>
            <input type="radio" name="findingMethod" value="internal-referral" id="internal-referral">&nbsp;
            <span>
              <label for="internal-referral">Internal Referral</label>
            </span>
            <input type="radio" name="findingMethod" value="others" id="others">&nbsp;
            <span>
              <label for="others">Others</label>
            </span>
            <input type="text" name="findingMethod" class="inputLine" id="otherInputLine" style="display:none; width:20%;" placeholder="Please specify">
          </div>
        </fieldset>
        <fieldset class="fieldset" style="border: 1px solid #000;">
          <legend class="legend">
            2.<?php echo Yii::t('app', 'EDUCATION & PROFESSIONAL QUALIFICATION'); ?>
          </legend>
          <div class="grid_block">
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Name of School/College/University'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="schoolName[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Year from'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="year" name="startYear[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Year to'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="year" name="endYear[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Qualification & Subject Obtained'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="qualification[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Grade/CGPA'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="cgpa[]" class="educationSectionInput"><br>
              </div>
            </div>
          </div>
          <div class="grid_block">
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Name of School/College/University'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="schoolName[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Year from'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="year" name="startYear[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Year to'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="year" name="endYear[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Qualification & Subject Obtained'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="qualification[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Grade/CGPA'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="cgpa[]" class="educationSectionInput"><br>
              </div>
            </div>
          </div>
          <div class="grid_block">
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Name of School/College/University'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="schoolName[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Year from'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="year" name="startYear[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Year to'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="year" name="endYear[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Qualification & Subject Obtained'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="qualification[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Grade/CGPA'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="cgpa[]" class="educationSectionInput"><br>
              </div>
            </div>
          </div>
          <div class="grid_block">
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Name of School/College/University'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="schoolName[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Year from'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="year" name="startYear[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Year to'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="year" name="endYear[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Qualification & Subject Obtained'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="qualification[]" class="educationSectionInput"><br>
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Grade/CGPA'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="cgpa[]" class="educationSectionInput"><br>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="fieldset" style="border: 1px solid #000;">
          <legend class="legend">
            3.<?php echo Yii::t('app', 'PRESENT AND PREVIOUS EMPLOYMENT'); ?>
          </legend>
          <div class="grid_block">
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Name of Company'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="companyName[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'From'); ?>
              </div>
              <div class="lables2">
                <input type="year" name="startDate[]" placeholder="E.g: 01/2018 for Jan 2018">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'To'); ?>
              </div>
              <div class="lables2">
                <input type="year" name="endDate[]" placeholder="E.g: 01/2018 for Jan 2018">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Position Held'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="positionHeld[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Final Salary'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="endingSalary[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Allowances'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="allowances[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Reason for leaving'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="leaveReason[]">
              </div>
            </div>
          </div>
          <div class="grid_block">
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Name of Company'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="companyName[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'From'); ?>
              </div>
              <div class="lables2">
                <input type="year" name="startDate[]" placeholder="E.g: 01/2018 for Jan 2018">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'To'); ?>
              </div>
              <div class="lables2">
                <input type="year" name="endDate[]" placeholder="E.g: 01/2018 for Jan 2018">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Position Held'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="positionHeld[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Final Salary'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="endingSalary[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Allowances'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="allowances[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Reason for leaving'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="leaveReason[]">
              </div>
            </div>
          </div>
          <?php $this->renderPartial(’/views/layouts/company_section’); ?>
          <div class="grid_block">
            <div class="display_inline_block">
              <div class="lables">
                <span><?php echo Yii::t('app', 'Name of Company'); ?></span><br>
              </div>
              <div class="lables2">
                <input type="text" name="companyName[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'From'); ?>
              </div>
              <div class="lables2">
                <input type="year" name="startDate[]" placeholder="E.g: 01/2018 for Jan 2018">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'To'); ?>
              </div>
              <div class="lables2">
                <input type="year" name="endDate[]" placeholder="E.g: 01/2018 for Jan 2018">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Position Held'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="positionHeld[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Final Salary'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="endingSalary[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Allowances'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="allowances[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Reason for leaving'); ?>
              </div>
              <div class="lables2">
                <input type="text" name="leaveReason[]">
              </div>
            </div>
            <div class="display_inline_block">
              <div class="lables">
                <?php echo Yii::t('app', 'Have you ever been terminated/dismissed/suspended from the service of any employer'); ?>?<br>
                <?php echo Yii::t('app', 'If yes, please give details'); ?><br>
                <input type="text" name="terminationDetails" class="inputLine" id="terminationReason" style="display:none;"><br><br>
              </div>
              <div class="lables2">
                <input type="radio" name="terminatedBefore" value="1"> Yes<br>
                <input type="radio" name="terminatedBefore" value="0"> No<br>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </form>
  </div>
</div>





