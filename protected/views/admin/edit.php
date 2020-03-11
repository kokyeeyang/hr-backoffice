<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
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
    <h4 class="widget_title" style="height:40px;">
      <ul class="nav nav-tabs">
	<button class="tablinks" onclick="openTab(event, 'usermanagement')">User Management</button>
	<button class="tablinks" onclick="openTab(event, 'training')">Training</button>
	<button class="tablinks" onclick="openTab(event, 'onboarding')">Onboarding</button>
	<!--	<li><a href="#" onclick="openTab('usermanagement')">User Management</a></li>
		<li><a href="#" onclick="openTab('training')">Training</a></li>
		<li><a href="#" onclick="openTab('onboarding')">Onboarding</a></li>-->
      </ul>
    </h4>
    <div id="usermanagement" class="tabcontent">
      <?php $this->renderPartial('_form', array('objModel' => $objModel)); ?>
    </div>
    <div id="onboarding" class="tabcontent">
      <h3>Paris</h3>
      <p>Paris is the capital of France.</p> 
    </div>
    <div id="training" class="tabcontent">
      <h3>Paris</h3>
      <p>Paris is the capital of France.</p> 
    </div>
  </div>
</div>