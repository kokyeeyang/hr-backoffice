<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top">
      <a class="btnGetAdminList" style="text-decoration: none" rel="<?php echo $this->createUrl('admin/list'); ?>" href="javascript:void(0);">
	<?php echo Yii::t('app', 'Users List') ?>
      </a>
      >
      <?php echo Yii::t('app', 'User Management'); ?>
    </div>
    <div class="breadcrumb-bottom breadcrumb-bottom-key">
      <div class="title">
	<span><?php echo Yii::t('app', 'Edit Admin'); ?></span>
      </div>
    </div>
  </div>
</div>
<div class="common_content_wrapper admin_form">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title">
      <button class="w3-bar-item w3-button" onclick="openTab('usermanagement')">User Management</button>
      <button class="w3-bar-item w3-button" onclick="openTab('training')">Training</button>
      <button class="w3-bar-item w3-button" onclick="openTab('onboarding')">Onboarding</button>
    </h4>
    <?php $this->renderPartial('_form', array('objModel' => $objModel)); ?>
  </div>
</div>