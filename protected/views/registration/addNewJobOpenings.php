<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Add New Job Openings'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-people">
      <div class="title">
        <span><?php echo Yii::t('app', 'Add new job openings'); ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Add new job openings'); ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="whiteListForm" name="whiteListForm" action="<?php echo $this->createUrl('registration/saveJobOpenings') ?>" >
    	<table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
    		<tr>
    			<td><?php echo Yii::t('app', 'Job title'); ?> </td>
    			<td>:</td>
    			<td>
    				<input type="text" name="jobTitle"/>
    			</td>
          <td>
            <input type="checkbox" name="isManagerialCheckbox" id="isManagerialCheckbox" value="1">
            <label for="isManagerialCheckbox"><?php echo Yii::t('app', 'Managerial position') ?></label>
          </td>
    		</tr>
    		<tr>
    			<td><?php echo Yii::t('app', 'Department'); ?></td>
    			<td>:</td>
    			<td>
    				<!-- <input type="text" name="department"/> -->
            <select name="department-dropdown" size=1>
              <option value="" selected disabled hidden>Choose here</option>
              <option value="HR"><?php echo Yii::t('app', 'HR'); ?></option>
              <option value="MARKETING"><?php echo Yii::t('app', 'MARKETING'); ?></option>
              <option value="IT"><?php echo Yii::t('app', 'IT'); ?></option>
              <option value="P&S"><?php echo Yii::t('app', 'P&S'); ?></option>
              <option value="CS"><?php echo Yii::t('app', 'CS'); ?></option>
              <option value="DESIGN"><?php echo Yii::t('app', 'DESIGN'); ?></option>
            </select>
    			</td>
    		</tr>
				<tr>
    			<td><?php echo Yii::t('app', 'Line manager'); ?></td>
    			<td>:</td>
    			<td>
    				<input type="text" name="interviewManager"/>
    			</td>
    		</tr>
    		<tr>
          <td>
            <div class="row buttons">
              <?php echo CHtml::submitButton($objModel->isNewRecord ? 'Submit' : 'Save'); ?>
              <!-- <input type="file" name="offer-letter" id="offer-letter" accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required/> -->
            </div>
          </td>
        </tr>
    	</table>
    </form>
  </div>
</div>