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
          <?php $this->beginContent('//registration/education_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/education_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/education_section'); ?>
          <?php $this->endContent(); ?>
          <?php $this->beginContent('//registration/education_section'); ?>
          <?php $this->endContent(); ?>
        </fieldset>
        <fieldset class="fieldset" style="border: 1px solid #000;">
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
        </fieldset>
      </div>
    </form>
  </div>
</div>





