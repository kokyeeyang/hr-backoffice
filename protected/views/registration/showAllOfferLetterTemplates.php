<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Offer letter templates'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span><?php echo Yii::t('app', 'Offer letter templates'); ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Choose a template'); ?>
    <input type="button" id="generateOfferLetter" value="<?php echo Yii::t('app', 'Create new offer letter'); ?>" data-create-url="<?php echo $this->createUrl('registration/createNewOfferLetter'); ?>">
    </h4>
    <form method="post" enctype="multipart/form-data" id="showOfferLetterTemplates" name="showOfferLetterTemplates" action="<?php echo $this->createUrl('registration/showOfferLetterTemplates'); ?>">
      <table class="widget_table grid">
        <thead>
        <tr>
          <th>
            <div class="sort_wrapper_inner">
              <div class="sort_label_wrapper">
                <div class="sort_label">
                  <?php echo Yii::t('app', 'File name'); ?>
                </div>
              </div>
            </div>
          </th>
          <th>
            <div class="sort_wrapper_inner">
              <div class="sort_label_wrapper">
                <div class="sort_label">
                  <?php echo Yii::t('app', 'Department'); ?>
                </div>
              </div>
            </div>
          <th>
            <div class="sort_wrapper_inner">
              <div class="sort_label_wrapper">
                <div class="sort_label">
                  <?php echo Yii::t('app', 'Managerial role'); ?>
                </div>
              </div>
            </div>
          </th>
          <th>
            <div class="sort_wrapper_inner">
              <div class="sort_label_wrapper">
                <div class="sort_label">
                  <input type="button" title="<?php echo Yii::t('app', 'Delete this entry'); ?>" id="deleteOfferLetterButton" value="Delete selected entries" data-delete-url="<?php echo $this->createUrl('registration/deleteSelectedOfferLetters') ?>">
                </div>
              </div>
            </div>
          </th>
        </tr>
      </thead>
      <tbody id="data_table">
        <?php foreach($offerLetterArrRecords as $offerLetterObjRecord){ ?>
        <tr>
          <td>
            <a href="<?php echo $this->createUrl('registration/viewSelectedOfferLetter', array('offerLetterId' => $offerLetterObjRecord->id)); ?>">
            <?php echo $offerLetterObjRecord->offer_letter_title; ?>
            </a>
          </td>
          <td>
            <?php echo $offerLetterObjRecord->department; ?>
          </td>
          <td>
            <?php echo EmploymentOfferLetterTemplates::model()->queryForOfferLetterIsManagerial($offerLetterObjRecord->id); ?>
          </td>
          <td>
            <input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox" value="<?php echo $offerLetterObjRecord->id; ?>">
          </td>
        </tr>
        <?php } ?>
      </tbody>
    	</table>
    </form>
  </div>
</div>

<div id="registration-common-msg">
  <div id="msg-select-offerletter-delete" data-msg="<?php echo Yii::t('app', 'Please select an offer letter template that you would like to delete'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
  <div id="msg-confirm-offerletter-delete" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to delete the selected offer letter templates?'); ?>"><!-- Dialog Buttons Label --></div>
</div>