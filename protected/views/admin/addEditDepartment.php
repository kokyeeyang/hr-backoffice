<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Add New Department'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span><?php echo Yii::t('app', 'Add new department'); ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Add New Department'); ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="departmentForm" name="departmentForm" action="<?php echo $currentFunction=='addNewDepartment'?$this->createUrl('admin/saveDepartment'):$this->createUrl('admin/updateDepartment', ['departmentId' => $departmentId]); ?>" >
      <table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
        <tr>
          <td><?php echo Yii::t('app', 'Please specify your department name'); ?> </td>
          <td>:</td>
          <?php 
            if($currentFunction == 'addNewDepartment'){
              $departmentArr = ['1'];
            }
          ?>
          <?php foreach($departmentArr as $departmentObj){ ?>
          <td><input type="text" name="new-department" id="new-department" value="<?php echo $currentFunction=='viewSelectedDepartment'?$departmentObj->department_title:''; ?>" required/>
        </tr>
        <tr>
          <td>
            <?php echo Yii::t('app', 'Please give a brief description of your new department'); ?>
          </td>
          <td>:</td>
          <td>
            <textarea rows="4" name="department-description" id="department-description" cols="22" required/>
              <?php echo $currentFunction=='viewSelectedDepartment'?$departmentObj->department_description:''; ?>
            </textarea>
          </td>
          <?php } ?>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="<?php echo Yii::t('app', 'Save') ?>">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>