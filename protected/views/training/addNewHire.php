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
    <form method="post" enctype="multipart/form-data" id="newHireForm" name="newHireForm" action="<?php echo $this->createUrl('registration/saveNewHire') ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
        <tr>
          <td><?php echo Yii::t('app', 'Select a candidate that you wish to hire'); ?> </td>
          <td>:</td>
          <td>
            <!-- <select id="candidateName" data-url="<?php echo $this->createUrl('training/checkForCandidateInformation') ?>" name="candidateName" required> -->
            <select id="candidateName" onchange="show_candidate_information(this.value)" name="candidateName" required>
              <option value="">Candidate names</option>
              <?php foreach($arrRecords as $intIndex => $objRecord){ ?>
                <option value="<?php echo $objRecord->full_name ?>">
                  <?php echo $objRecord->full_name ?>
                </option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'id_no'); ?></td>
          <td>:</td>
          <td><input type="text" /></td>
        </tr>
        <tr id="labelGroup">
          <td title="<?php echo Yii::t('app', 'By default, this is set as your username+home.'); ?>">
            <?php echo Yii::t('app', 'Please specify a label'); ?>
          </td>
          <td>:</td>
          </td>
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