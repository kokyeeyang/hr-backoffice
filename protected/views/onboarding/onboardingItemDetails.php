<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo $breadcrumbTop; ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-people">
      <div class="title">
        <span><?php echo $title; ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo $widgetTitle; ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="onboardingChecklistForm" name="onboardingChecklistForm" action="<?php echo $this->createUrl('onboarding/saveOnboardingItem') ?>" >
    	<table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
    		<tr>
    			<td><?php echo Yii::t('app', 'Onboarding checklist item'); ?> </td>
    			<td>:</td>
    			<td>
    				<input type="text" name="onboardingChecklistItemName"/>
    			</td>
    		</tr>
        <tr>
          <td>
            <?php echo Yii::t('app', 'Give a short description'); ?>
          </td>
          <td>:</td>
          <td>
            <textarea rows="4" name="onboardingItemDescription" id="onboardingItemDescription" cols="22" required/>
              <?php echo $onboardingItemDescription; ?>
            </textarea>
          </td>
          </td>
        </tr>
    		<tr>
    			<td><?php echo Yii::t('app', 'Responsibility'); ?></td>
    			<td>:</td>
    			<td>
            <select name="responsibilityDropdown" size=1>
              <option value="" selected disabled hidden>Choose here</option>
                <?php foreach($departmentArr as $departmentObj){ ?>
                  <option value="<?php echo $departmentObj['id']; ?>"><?php echo $departmentObj['title']; ?></option>
                <?php } ?>
            </select>
    			</td>
    		</tr>
        <tr>
          <td>
            <input type="checkbox" name="isActiveCheckbox" id="isActiveCheckbox" value="1">
            <label for="isActiveCheckbox"><?php echo Yii::t('app', 'Is this item still active?') ?></label>
          </td>
        </tr>
        <tr>
          <td>
            <input type="checkbox" name="isManagerialCheckbox" id="isManagerialCheckbox" value="1">
            <label for="isManagerialCheckbox"><?php echo Yii::t('app', 'Is this item for managerial role?') ?></label>
          </td>
        </tr>
        <tr>
          <td>
            <input type="checkbox" name="isOffloadingCheckbox" id="isOffloadingCheckbox" value="1">
            <label for="isOffloadingCheckbox"><?php echo Yii::t('app', 'Is this item going to be used for offloading purposes?') ?></label>
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