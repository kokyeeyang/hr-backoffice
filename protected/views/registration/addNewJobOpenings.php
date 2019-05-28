<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Add New Job Openings'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
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
    		</tr>
    		<tr>
    			<td><?php echo Yii::t('app', 'Department'); ?></td>
    			<td>:</td>
    			<td>
    				<input type="text" name="department"/>
    			</td>
    		</tr>
				<tr>
    			<td><?php echo Yii::t('app', 'Interview manager'); ?></td>
    			<td>:</td>
    			<td>
    				<input type="text" name="interviewManager"/>
    			</td>
    		</tr>
    		<tr>
          <td>
            <div class="row buttons">
              <?php //echo CHtml::submitButton($objModel->isNewRecord ? 'Submit' : 'Save'); ?>
            </div>
          </td>
        </tr>
    	</table>
    </form>
  </div>
</div>