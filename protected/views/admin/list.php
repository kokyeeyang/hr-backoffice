<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'User Management') . ' - ' . Yii::t('app', 'List'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-gears">
      <div class="title">
	<span><?php echo Yii::t('app', 'Users List'); ?></span>
      </div>
    </div>
  </div>
</div>
<div class="common_content_wrapper admin_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Users List'); ?>
      <a class="btnGetAdminForm" rel="<?php echo $this->createUrl('admin/add'); ?>" href="javascript:void(0);">
	<input type="button" value="Add new" class="addNewButton" name="addNewButton">
      </a>
    </h4>
    <?php
    $objForm = $this->beginWidget(
	'CActiveForm',
	array(
	    'id' => 'admin-list',
	    'action' => $this->CreateUrl('admin/list'),
	    // Please note: When you enable ajax validation, make sure the corresponding
	    // controller action is handling ajax validation correctly.
	    // There is a call to performAjaxValidation() commented in generated controller code.
	    // See class documentation of CActiveForm for details on this.
	    'enableAjaxValidation' => false,
	)
    );
    ?>
    <?php echo CHtml::hiddenField('mode', 'admin-list'); ?>
    <?php echo CHtml::hiddenField('sort_key', $strSortKey); ?>
    <table class="widget_table grid">		
      <thead>
	<tr>
	  <th>
	    <div class="btnAjaxSortList sort_wrapper<?php if ($strSortKey === 'sort_username_desc') { ?> desc<?php } elseif ($strSortKey === 'sort_username_asc') { ?> asc<?php } ?>" rel="sort" rev="sort_username">
	      <a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
		<div class="sort_wrapper_inner">								
		  <div class="sort_label_wrapper">
		    <div class="sort_label"><?php echo Yii::t('app', 'Username'); ?></div>
		  </div>
		  <div class="sort_icon_wrapper">
		    <div class="sort_icon">&nbsp;</div>
		  </div>
		  <div class="clear"><!--clear--></div>
		</div>
	      </a>										
	    </div>					
	  </th>
	  <th>
	    <div class="btnAjaxSortList sort_wrapper<?php if ($strSortKey === 'sort_display_name_desc') { ?> desc<?php } elseif ($strSortKey === 'sort_display_name_asc') { ?> asc<?php } ?>" rel="sort" rev="sort_display_name">
	      <a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
		<div class="sort_wrapper_inner">								
		  <div class="sort_label_wrapper">
		    <div class="sort_label"><?php echo Yii::t('app', 'Name'); ?></div>
		  </div>
		  <div class="sort_icon_wrapper">
		    <div class="sort_icon">&nbsp;</div>
		  </div>
		  <div class="clear"><!--clear--></div>
		</div>
	      </a>										
	    </div>					
	  </th>
	  <th>
	    <div class="btnAjaxSortList sort_wrapper<?php if ($strSortKey === 'sort_status_desc') { ?> desc<?php } elseif ($strSortKey === 'sort_status_asc') { ?> asc<?php } ?>" rel="sort" rev="sort_status">
	      <a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
		<div class="sort_wrapper_inner">								
		  <div class="sort_label_wrapper">
		    <div class="sort_label"><?php echo Yii::t('app', 'Status'); ?></div>
		  </div>
		  <div class="sort_icon_wrapper">
		    <div class="sort_icon">&nbsp;</div>
		  </div>
		  <div class="clear"><!--clear--></div>
		</div>
	      </a>										
	    </div>					
	  </th>
	  <th>
	    <div class="btnAjaxSortList sort_wrapper<?php if ($strSortKey === 'sort_privilege_desc') { ?> desc<?php } elseif ($strSortKey === 'sort_privilege_asc') { ?> asc<?php } ?>" rel="sort" rev="sort_privilege">
	      <a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
		<div class="sort_wrapper_inner">								
		  <div class="sort_label_wrapper">
		    <div class="sort_label"><?php echo Yii::t('app', 'Privilege'); ?></div>
		  </div>
		  <div class="sort_icon_wrapper">
		    <div class="sort_icon">&nbsp;</div>
		  </div>
		  <div class="clear"><!--clear--></div>
		</div>
	      </a>										
	    </div>					
	  </th>
	  <th>
	    <div class="btnAjaxSortList sort_wrapper<?php if ($strSortKey === 'sort_login_retry_times_desc') { ?> desc<?php } elseif ($strSortKey === 'sort_login_retry_times_asc') { ?> asc<?php } ?>" rel="sort" rev="sort_login_retry_times">
	      <a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
		<div class="sort_wrapper_inner">								
		  <div class="sort_label_wrapper">
		    <div class="sort_label"><?php echo Yii::t('app', 'Login Attempts'); ?></div>
		  </div>
		  <div class="sort_icon_wrapper">
		    <div class="sort_icon">&nbsp;</div>
		  </div>
		  <div class="clear"><!--clear--></div>
		</div>
	      </a>										
	    </div>					
	  </th>
	  <th>
	    <div class="btnAjaxSortList sort_wrapper<?php if ($strSortKey === 'sort_last_login_desc') { ?> desc<?php } elseif ($strSortKey === 'sort_last_login_asc') { ?> asc<?php } ?>" rel="sort" rev="sort_last_login">
	      <a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
		<div class="sort_wrapper_inner">								
		  <div class="sort_label_wrapper">
		    <div class="sort_label"><?php echo Yii::t('app', 'Last Login'); ?></div>
		  </div>
		  <div class="sort_icon_wrapper">
		    <div class="sort_icon">&nbsp;</div>
		  </div>
		  <div class="clear"><!--clear--></div>
		</div>
	      </a>										
	    </div>					
	  </th>
	  <th><?php echo Yii::t('app', 'Function'); ?></th>
	</tr>
      </thead>
      <tbody>
	<?php if (isset($arrRecords[0])) { ?>		
	    <?php foreach ($arrRecords as $intIndex => $objRecord) { ?>
		<tr>
		  <td>
		    <div class="btnGetAdminForm" rel="<?php echo $this->createUrl('admin/edit', array('id' => $objRecord->admin_id)); ?>">
		      <?php echo $objRecord->admin_username; ?>
		    </div>
		  </td>
		  <td><?php echo $objRecord->admin_display_name; ?></td>
		  <td><?php echo Admin::getStatusLabel($objRecord->admin_status); ?></td>
		  <td><?php echo $objRecord->admin_priv; ?></td>
		  <td><?php echo $objRecord->admin_login_retry_times; ?></td>
		  <td><?php echo $objRecord->admin_last_login; ?></td>
		  <td><div class="btnGetAdminForm" rel="<?php echo $this->createUrl('admin/edit', array('id' => $objRecord->admin_id)); ?>"><?php echo get_button(Yii::t('app', 'Edit'), 80, '', '', 'grey', 'btn_edit_admin'); ?></div></td>
		</tr>
		<?php
	    } // - end: foreach
	} else {
	    ?>
    	<tr>
    	  <td colspan="7"><center><b><?php echo Yii::t('app', 'No Record'); ?></b></center></td>
          </tr>			
      <?php } // - end: if else 
      ?>
      </tbody>
    </table>
    <?php
    if (isset($arrRecords[0])) {
	echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/pagination.php', array('objPagination' => $objPagination));
    } // - end: if 
    ?>		
    <?php $this->endWidget(); ?>		
  </div>
</div>