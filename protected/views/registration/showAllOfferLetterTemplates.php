<!-- <div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php //echo Yii::t('app', 'Offer letter templates'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-chart">
      <div class="title">
        <span><?php //echo Yii::t('app', 'Offer letter templates'); ?></span>
      </div>
    </div>
  </div>
</div> -->
<?php 
//output the content header
echo PageHelper::printFormListingHeader($pageType);

echo PageHelper::printFormListingBody($pageType, $strSortKey, true, $offerLetterArr, false, true);

?>

<div id="registration-common-msg">
  <div id="msg-select-delete" data-msg="<?php echo Yii::t('app', 'Please select an offer letter template that you would like to delete'); ?>"><!-- Dialog Buttons Label --></div>
</div>
<div id="registration-common-msg">
  <div id="msg-confirm-delete" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to delete the selected offer letter templates?'); ?>"><!-- Dialog Buttons Label --></div>
</div>