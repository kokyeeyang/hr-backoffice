<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top">
      <?php echo $header; ?>
    </div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span>
          <?php echo $header; ?>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo $header; ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="departmentForm" name="departmentForm" action="<?php echo $formAction; ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
        <tr>
          <td><?php echo Yii::t('app', 'Please specify your department name'); ?> </td>
          <td>:</td>
          <td><input type="text" name="newDepartment" id="newDepartment" value="<?php echo $departmentTitle; ?>" required/>
        </tr>
        <tr>
          <td>
            <?php echo Yii::t('app', 'Give a short description'); ?>
          </td>
          <td>:</td>
          <td>
            <textarea rows="4" name="departmentDescription" id="departmentDescription" cols="22" required/><?php echo $departmentDescription; ?></textarea>
          </td>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="<?php echo $buttonTitle; ?>">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>