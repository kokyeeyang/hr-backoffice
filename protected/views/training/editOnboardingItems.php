<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Edit '); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span><?php echo Yii::t('app', 'Edit onboarding items'); ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Save Onboarding Items'); ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="editForm" name="editForm" action="<?php echo $this->createUrl('training/saveOnboardingItems') ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
        <?php foreach($onboardingItemArrRecords as $onboardingItemObjRecord){ ?>
        <tr>
          <td>
            <input type="text" value="<?php echo $onboardingItemObjRecord->onboarding_item; ?>" name="onboardingItem" id="onboardingItem" required/>
          <br/>
          </td>
          <td>
            <input type="text" value="<?php echo $onboardingItemObjRecord->responsibility; ?>" name="itemResponsibility" id="itemResponsibility" required/>
          </td>
        <?php } ?>
        </tr>
        <tr>
          <td>
            <!-- <div class="row buttons">
              <?php // echo CHtml::submitButton($objModel->isNewRecord ? 'Submit' : 'Save'); ?>
            </div> -->
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>