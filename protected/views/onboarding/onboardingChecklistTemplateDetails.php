<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo $header; ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-people">
      <div class="title">
        <span><?php echo $header; ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo $header; ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="onboardingChecklistTemplateForm" name="onboardingChecklistTemplateForm" action="<?php echo $formAction; ?>">
    	<div id="offer-letter-template-input" style="margin-bottom:10px; margin-top: 10px;">
	    <tr>
		<td><?php echo Yii::t('app', 'Onboarding Checklist Template Title'); ?> </td>
		    <td>:</td>
		    <td>
			<?php isset($_GET['id'])?$templateTitle = $onboardingChecklistTemplateObjRecord->title:$templateTitle = '' ?>
			<input type="text" name="templateTitle" id="templateTitle" value="<?php echo $templateTitle; ?>"/>
		    </td>
		<td><?php echo Yii::t('app', 'Description'); ?> </td>
		<td>:</td>
		<td>
		    <?php isset($_GET['id'])?$templateDescription = $onboardingChecklistTemplateObjRecord->description:$templateDescription = '' ?>
		    <textarea name="templateDescription" id="templateDescription" rows="3"><?php echo $templateDescription; ?></textarea>
		</td>
	    </tr>
	    <table class="widget_table grid">
		<thead>
		    <tr>
			<th>
			    <div class="sort_wrapper_inner">
				<div class="sort_label_wrapper">
				    <div class="sort_label">
					<?php echo Yii::t('app', 'Title'); ?>
				    </div>
				</div>
			    </div>
			</th>
			<th>
			    <div class="sort_wrapper_inner">
				<div class="sort_label_wrapper">
				    <div class="sort_label">
					<?php echo Yii::t('app', 'Description'); ?>
				    </div>
				</div>
			    </div>
			</th>
			<th>
			    <div class="sort_wrapper_inner">
				<div class="sort_label_wrapper">
				    <div class="sort_label">
					<?php echo Yii::t('app', 'Department owner'); ?>
				    </div>
				</div>
			    </div>
			</th>
			<th>
			    <div class="sort_wrapper_inner">
				<div class="sort_label_wrapper">
				    <div class="sort_label">
					<?php echo Yii::t('app', 'Is offboarding item'); ?>
				    </div>
				</div>
			    </div>
			</th>
			<th>
			    <div class="sort_wrapper_inner">
				<div class="sort_label_wrapper">
				    <div class="sort_label">
					<?php echo Yii::t('app', 'Status'); ?>
				    </div>
				</div>
			    </div>
			</th>
		    </tr>
		</thead>
		<tbody id="data_table">
		  <tr>
		    <td>
			<select name="onboardingItemDropdown" size=1 class="selectOnboardingItemTitle">
			  <option value="" selected disabled hidden>Choose here</option>
			  <?php foreach ($onboardingItemTitleArrRecord as $intIndex => $onboardingItemTitleObjRecord){ ?>
			  <option value="<?php echo $onboardingItemTitleObjRecord['title']; ?>" data-select-url="<?php echo $this->createUrl('onboarding/queryForOnboardingItemDetails'); ?>">
			    <?php echo $onboardingItemTitleObjRecord['title']; ?>
			  </option>
			  <?php } ?>
			</select>
		    </td>
		  </tr>
		</tbody>
	    </table>
	    <!-- need to add a bar containing title, description, department owner, is_offboarding_item, status, is_managerial for onboarding items -->
	    <!-- would need ajax to append a dropdown to add onboarding items -->
	    <!-- would need to pass php array containing all the onboarding items that are available in the database into a dropdown menu for users to choose-->
	    <!-- ajax would then populate the data for the onboarding item that the user chose -->
	</div>
    </form>
  </div>
</div>