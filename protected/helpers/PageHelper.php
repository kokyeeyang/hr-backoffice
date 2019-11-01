<?php 
class PageHelper {

	public static function printViewAllHeader(){
		return ('
			<div class="breadcrumb">
				<div class="breadcrumb_wrapper">
					<div class="breadcrumb-top"><?php echo Yii::t('app', \'Show All Departments\'); ?></div>
					<div class="breadcrumb-bottom breadcrumb-bottom-key">
						<div class="title">
							<span><?php echo Yii::t('app', \'All departments\'); ?></span>
						</div>
					</div>
				</div>
			</div>
		')
	}
}