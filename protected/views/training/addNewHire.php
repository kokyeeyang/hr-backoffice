<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Add New Hire'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span><?php echo Yii::t('app', 'Add new hire'); ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Add New Hire'); ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="newHireForm" name="newHireForm" action="<?php echo $this->createUrl('training/saveNewHire') ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
        <tr>
          <td><?php echo Yii::t('app', 'Select a candidate that you wish to hire'); ?> </td>
          <td>:</td>
          <td>
            <select id="candidateName" data-url="<?php echo $this->createUrl('training/checkForCandidateInformation') ?>" name="candidateName" required>
              <option value="candidate-name">Candidate names</option>
              <?php foreach($arrRecords as $intIndex => $objRecord){ ?>
                <option value="<?php echo $objRecord->full_name ?>">
                  <?php echo $objRecord->full_name ?>
                </option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Full Name'); ?></td>
          <td>:</td>
          <td><input name="full_name" id="fullName" type="text" /></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'ID No'); ?></td>
          <td>:</td>
          <td><input name="id_no" id="idNo" type="text" /></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Address'); ?></td>
          <td>:</td>
          <td><input name="address" id="address" type="text" /></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Contact no'); ?></td>
          <td>:</td>
          <td><input name="contact_no" id="contactNo" type="text" /></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Email address'); ?></td>
          <td>:</td>
          <td><input name="email_address" id="emailAddress" type="text" /></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Date of birth'); ?></td>
          <td>:</td>
          <td><input name="date_of_birth" id="dateOfBirth" type="text" /></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Gender'); ?></td>
          <td>:</td>
          <td><input name="gender" id="gender" type="text" /></td>
        </tr> 
        <tr>
          <td><?php echo Yii::t('app', 'Marital status'); ?></td>
          <td>:</td>
          <td><input name="marital_status" id="maritalStatus" type="text" /></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Nationality'); ?></td>
          <td>:</td>
          <td><input name="nationality" id="nationality" type="text" /></td>
        </tr>         
        <tr>
          <td>
            <div class="row buttons">
              <?php echo CHtml::submitButton($objModel->isNewRecord ? 'Submit' : 'Save'); ?>
            </div>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>