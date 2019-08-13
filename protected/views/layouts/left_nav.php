<div class="left_menu">   
	<ul class="nav">
		<li class="nav-header"><?php echo Yii::t('app', 'HR Back Office'); ?></li>
		<li <?php if(Yii::app()->getController()->getId() == 'site'){ ?>class="active"<?php } ?>><a class="top_level_item" href="<?php echo $this->createUrl('site/welcome'); ?>"><div class="icon icon-home"></div><?php echo Yii::t('app', 'Home'); ?></a></li>
		<?php
		if(isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin'])){
		?>
		<li class="dropdown<?php if(Yii::app()->getController()->getId() == 'report'){ ?> active<?php } ?>"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-report"></div><?php echo Yii::t('app', 'Reports'); ?></a>
			<ul>
				<?php if(in_array(Yii::app()->user->priv, ['admin'])){?><li><a class="btnGetAdminActivityLogList" href="<?php echo $this->createUrl('report/getAdminActivityLogList'); ?>"><?php echo Yii::t('app', 'Admin Activity Logs'); ?></a></li><?php } ?>
			</ul>
		</li>
		<?php
		} // - end: if

		if(isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin'])){ 
		?>
		<li class="dropdown"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-key"></div> <?php echo Yii::t('app', 'Admin Users'); ?></a>
			<ul>
				<li><a class="btnGetAdminList" rel="<?php echo $this->createUrl('admin/list'); ?>" href="javascript:void(0);"><?php echo Yii::t('app', 'Users List'); ?></a></li>
				<li><a class="btnGetAdminForm" rel="<?php echo $this->createUrl('admin/add'); ?>" href="javascript:void(0);"><?php echo Yii::t('app', 'Add User'); ?></a></li>
			</ul>
		</li>
		<?php
		} // - end: if
		?>		
		<li class="dropdown"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-people"></div> <?php echo Yii::t('app', 'Interviewees'); ?></a>
			<ul>
				<li><a href="<?php echo $this->createUrl('registration/showAllCandidates'); ?>"><?php echo Yii::t('app', 'View all interview candidates'); ?></a></li>
				<li><a href="<?php echo $this->createUrl('registration/addNewJobOpenings'); ?>"><?php echo Yii::t('app', 'Add new job openings'); ?></a></li>
				<li><a href="<?php echo $this->createUrl('registration/showAllJobOpenings'); ?>"><?php echo Yii::t('app', 'Show all job openings'); ?></a></li>
			</ul>
		</li>
		<li class="dropdown"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-people"></div> <?php echo Yii::t('app', 'Training'); ?></a>
			<ul>
				<li><a href="<?php echo $this->createUrl('training/addNewHires'); ?>"><?php echo Yii::t('app', 'Add new hires'); ?></a></li>
			</ul>
		</li>		
		<li class="dropdown"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-key"></div> <?php echo Yii::t('app', 'Whitelist Ip'); ?></a>
			<ul>
				<li><a class="btnGetWhiteListedIpList" href="<?php echo $this->createUrl('ip/showAllWhitelistIp'); ?>"><?php echo Yii::t('app', 'Show all whitelisted IPs'); ?></a></li>
				<li><a class="btnGetWhiteListIpForm" href="<?php echo $this->createUrl('ip/createNewWhitelistIp'); ?>"><?php echo Yii::t('app', 'Add new whitelist IP'); ?></a></li>
			</ul>
		</li>
	</ul>
</div>