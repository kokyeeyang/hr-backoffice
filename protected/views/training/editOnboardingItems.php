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
        <?php $i = 1 ?>
        <?php foreach($onboardingItemArrRecords as $onboardingItemObjRecord){ ?>
        <tr>
          <td>
            <input type="text" value="<?php echo $onboardingItemObjRecord->onboarding_item; ?>" name="item <?php echo $i ?>" id="item <?php echo $i ?>" />
          <br/>
          </td>
          <td>
            <input type="text" value="<?php echo $onboardingItemObjRecord->responsibility; ?>" name="responsibility <?php echo $i ?>" id="responsibility <?php echo $i ?>" />
          </td>
        <?php $i++ ?>
        <?php } ?>
        </tr>
        <tr>
          <td>
            <div class="row buttons">
              <?php echo CHtml::submitButton($onboardingItemObjRecord->isNewRecord ? 'Submit' : 'Save'); ?>
            </div> 
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>