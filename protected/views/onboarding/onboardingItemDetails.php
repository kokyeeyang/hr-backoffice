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
            <?php isset($_GET['id'])?$onboardingItemTitle = $onboardingItemObjRecord->title:$onboardingItemTitle = ''?>
    				<input type="text" name="onboardingItemName" value="<?php echo $onboardingItemTitle ?>" value="<?php ?>"/>
    			</td>
    		</tr>
        <tr>
          <td>
            <?php echo Yii::t('app', 'Give a short description'); ?>
          </td>
          <td>:</td>
          <td>
            <?php isset($_GET['id'])?$onboardingItemDescription = $onboardingItemObjRecord->description:$onboardingItemDescription = ''?>
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
              <?php !isset($_GET['id'])?$defaultOption = 'selected':$defaultOption = ''; ?>
              <option value="" <?php echo $defaultOption ?> disabled hidden required>Choose here</option>
                <?php foreach($departmentArr as $departmentObj){ ?>
                <?php isset($_GET['id']) && $onboardingItemObjRecord->department_owner == $departmentObj['id']?$selectedStatus = "selected":$selectedStatus=''; ?>
                  <option value="<?php echo $departmentObj['id']; ?>" <?php echo $selectedStatus; ?>><?php echo $departmentObj['title']; ?></option>
                <?php } ?>
            </select>
    			</td>
    		</tr>
        <tr>
          <td>
            <?php isset($_GET['id']) && $onboardingItemObjRecord->status == 1?$checkedStatus = 'checked': $checkedStatus = ''?>
            <?php //$onboardingItemObjRecord->status == 1?$checkedStatus = 'checked': $checkedStatus = ''?>
            <input type="checkbox" name="isActiveCheckbox" id="isActiveCheckbox" value="1" <?php echo $checkedStatus ?>>
            <label for="isActiveCheckbox"><?php echo Yii::t('app', 'Is this item still active?') ?></label>
          </td>
        </tr>
        <tr>
          <td>
            <?php isset($_GET['id']) && $onboardingItemObjRecord->is_managerial == 1?$checkedStatus = 'checked':''?>
            <?php //$onboardingItemObjRecord->is_managerial == 1?$checkedStatus = 'checked':''?>
            <input type="checkbox" name="isManagerialCheckbox" id="isManagerialCheckbox" value="1" <?php echo $checkedStatus ?>>
            <label for="isManagerialCheckbox"><?php echo Yii::t('app', 'Is this item for managerial role?') ?></label>
          </td>
        </tr>
        <tr>
          <td>
            <?php isset($_GET['id']) && $onboardingItemObjRecord->is_offboarding_item == 1?$checkedStatus = 'checked':''?>
            <?php //$onboardingItemObjRecord->is_offboarding_item == 1?$checkedStatus = 'checked':''?>
            <input type="checkbox" name="isOffloadingCheckbox" id="isOffboardingCheckbox" value="1" <?php echo $checkedStatus ?>>
            <label for="isOffloadingCheckbox"><?php echo Yii::t('app', 'Is this item going to be used for offboarding purposes?') ?></label>
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