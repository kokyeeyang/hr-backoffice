<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Add New White List Ip'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span><?php echo Yii::t('app', 'Add new White List Ip'); ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Add New White List Ip'); ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="whiteListForm" name="whiteListForm" action="<?php echo $this->createUrl('ip/saveWhitelistIp') ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
        <tr>
          <td><?php echo Yii::t('app', 'Duration'); ?> </td>
          <td>:</td>
          <td>
            <select id="duration" name="duration" required>
              <option value="">Days</option>
              <?php foreach($durationArr as $durationObj){ ?>
                <option value="<?php echo $durationObj ?>">
                  <?php echo $durationObj ?>
                </option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Ip Address to be whitelisted'); ?></td>
          <td>:</td>
          <td><input data-url="<?php echo $this->createUrl('ip/checkDuplicateWhitelistIp') ?>" type="text" value="<?php echo $currentIpAddress; ?>" name="ip_address" id="ip_address" required/></td>
          <td id="duplicateIpAlert" style="display:<?php echo $display ?>"><?php echo Yii::t('app', 'Duplicate IP Address'); ?> </td>
        </tr>
        <tr id="labelGroup">
          <td title="<?php echo Yii::t('app', 'By default, this is set as your username+home.'); ?>">
            <?php echo Yii::t('app', 'Please specify a label'); ?>
          </td>
          <td>:</td>
          <td><input type="text" value="<?php echo $labelName; ?>" name="label" id="label" required/>
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