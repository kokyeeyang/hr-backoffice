<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Offer letter templates'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span><?php echo Yii::t('app', 'Offer letter templates'); ?></span>
      </div>
    </div>
  </div>
</div>

<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Choose a template'); ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="showOfferLetterTemplates" name="showOfferLetterTemplates" action="<?php echo $this->createUrl('registration/showOfferLetterTemplates')?>">
    	<table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
    		<div>
    		</div>
    		<tr>
          <td>
            <!-- <div class="row buttons"> -->
              <input type="button" id="generateOfferLetter" value="<?php echo Yii::t('app', 'Create new offer letter'); ?>" data-create-url="<?php echo $this->createUrl('registration/createNewOfferLetter'); ?>">
            <!-- </div> -->
          </td>
        </tr>
    	</table>
    </form>
  </div>
</div>