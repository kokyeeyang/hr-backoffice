<div class="left_menu">   
	<ul class="nav">
		<li class="nav-header"><?php echo Yii::t('app', 'HR Back Office'); ?></li>
		<li <?php if(Yii::app()->getController()->getId() == 'site'){ ?>class="active"<?php } ?>><a class="top_level_item" href="<?php echo $this->createUrl('site/welcome'); ?>"><div class="icon icon-home"></div><?php echo Yii::t('app', 'Home'); ?></a></li>
		<?php
		if(isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin', 'hr'])){
		?>
		<li class="dropdown<?php if(Yii::app()->getController()->getId() == 'report'){ ?> active<?php } ?>"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-report"></div><?php echo Yii::t('app', 'Reports'); ?></a>
			<ul>
				<?php if(in_array(Yii::app()->user->priv, ['admin'])){?><li><a class="btnGetAdminActivityLogList" href="<?php echo $this->createUrl('report/getAdminActivityLogList'); ?>"><?php echo Yii::t('app', 'Admin Activity Logs'); ?></a></li><?php } ?>
			</ul>
		</li>
		<?php
		} // - end: if

		if(isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin', 'hr'])){ 
		?>
		<li class="dropdown"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-gears"></div> <?php echo Yii::t('app', 'Settings'); ?></a>
			<ul>
				<li><a class="btnGetAdminList" rel="<?php echo $this->createUrl('admin/list'); ?>" href="javascript:void(0);"><?php echo Yii::t('app', 'Users List'); ?></a></li>
				<li><a href="<?php echo $this->createUrl('registration/showOfferLetterTemplates'); ?>"><?php echo Yii::t('app', 'Offer Letters List'); ?></a></li>
				<li><a href="<?php echo $this->createUrl('admin/showAllDepartments'); ?>"><?php echo Yii::t('app', 'Departments List'); ?></a></li>
				<li><a href="<?php echo $this->createUrl('registration/showAllCandidateStatus'); ?>"><?php echo Yii::t('app', 'Candidate Status List'); ?></a></li>
			</ul>
		</li>
		<?php
		} // - end: if
		?>		
		<li class="dropdown"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-people"></div> <?php echo Yii::t('app', 'Interviewers'); ?></a>
			<ul>
				<li><a href="<?php echo $this->createUrl('registration/showAllCandidates'); ?>"><?php echo Yii::t('app', 'Interview Candidates List'); ?></a></li>
				<li><a href="<?php echo $this->createUrl('registration/showAllJobOpenings'); ?>"><?php echo Yii::t('app', 'Job Openings List'); ?></a></li>
			</ul>
		</li>
		<li class="dropdown"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-dashboard"></div> <?php echo Yii::t('app', 'Onboarding'); ?></a>
			<ul>
				<li><a href="<?php echo $this->createUrl('onboarding/showAllOnboardingItems'); ?>"><?php echo Yii::t('app', 'Onboarding Item List'); ?></a></li>
				<li><a href="<?php echo $this->createUrl('onboarding/showAllOnboardingChecklistTemplates'); ?>"><?php echo Yii::t('app', 'Onboarding Checklist Template List'); ?></a></li>
			</ul>
		</li>
		<li class="dropdown"><a class="top_level_item" href="javascript:void(0);"><div class="icon icon-dashboard"></div> <?php echo Yii::t('app', 'Training'); ?></a>
			<ul>
				<li><a href="<?php echo $this->createUrl('training/showAllTrainingItems'); ?>"><?php echo Yii::t('app', 'Training Items List'); ?></a></li>
				<li><a href="<?php echo $this->createUrl('training/showAllTrainingTemplates'); ?>"><?php echo Yii::t('app', 'Training Templates List'); ?></a></li>
			</ul>
		</li>		
	</ul>
</div>