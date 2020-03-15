<style>
  body {font-family: Arial;}

  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }/*

</style>

<script>
    function openTab(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
</script>

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
    <!--<h4 class="widget_title" style="height:40px;">-->
      <div class="tab">
	<button class="tablinks" onclick="openTab(event, 'usermanagement')" value="User Management">User Management</button>
	<button class="tablinks" onclick="openTab(event, 'onboarding')" value="Onboarding">Onboarding</button>
	<button class="tablinks" onclick="openTab(event, 'training')" value="Training">Training</button>
      </div>
    <!--</h4>-->
    <div id="usermanagement" class="tabcontent">
      <?php $this->renderPartial('_form', array('objModel' => $objModel)); ?>
    </div>
    <div id="onboarding" class="tabcontent">
      <?php //var_dump ($onboardingChecklistItems); ?>
      <?php echo PageHelper::printTemplateItems($onboardingTab,$onboardingChecklistItems); ?>
    </div>
    <div id="training" class="tabcontent">
      <h3>Training stuff</h3>
      <p>Training stuff wooohooo</p> 
    </div>
  </div>
</div>
