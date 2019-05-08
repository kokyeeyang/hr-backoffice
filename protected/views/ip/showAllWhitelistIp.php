<div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php echo Yii::t('app', 'Show All White List Ips'); ?></div>
		<div class="breadcrumb-bottom breadcrumb-bottom-key">
			<div class="title">
				<span><?php echo Yii::t('app', 'White List IPs'); ?></span>
			</div>
		</div>
	</div>
</div>
<div class="common_content_wrapper admin_list">
	<div class="common_content_inner_wrapper">
		<?php 
			$objForm = $this->beginWidget(
				'CActiveForm', 
				array(
					'id'=>'whitelistip-list',
					'action'=>$this->CreateUrl('ip/showAllWhiteListIp'),
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
				)
			); 
		?>    	
			<h4 class="widget_title"><?php echo Yii::t('app', 'Whitelist Ip List'); ?>
			<input type="text" value="" placeholder="<?php echo Yii::t('app', 'Filter results'); ?>" name="label_filter" id="label_filter" style="width:30%"/>
			</h4>
			<?php echo CHtml::hiddenField('mode', 'whitelistip-list'); ?>
			<?php echo CHtml::hiddenField('sort_key', $strSortKey); ?>
			<table class="widget_table grid">
				<thead>
					<tr>
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										<?php echo Yii::t('app', 'Label'); ?>
									</div>
								</div>
						</th>
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										<?php echo Yii::t('app', 'Ip Address'); ?>
									</div>
								</div>
							</div>
						</th>
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										<?php echo Yii::t('app', 'Duration (days)'); ?>
									</div>
								</div>
							</div>
						</th>
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										<?php echo Yii::t('app', 'Expiry date'); ?>
									</div>
								</div>
							</div>
						</th>					
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										<?php echo Yii::t('app', 'Created date'); ?>
									</div>
								</div>
							</div>
						</th>
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										<?php echo Yii::t('app', 'Created by'); ?>
									</div>
								</div>
							</div>
						</th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										
									</div>
								</div>
							</div>
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<input type="button" title="<?php echo Yii::t('app', 'For non-admins, you can only delete ip addresses whitelisted by yourself.'); ?>" id="deleteWhitelistButton" value="Delete selected IPs" data-delete-url="<?php echo $this->createUrl('ip/deleteSelectedWhitelistIp'); ?>" />
								</div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody id="data_table">
					<?php 
					if(isset($arrRecords[0])){
				  ?>
				  <?php
				  	foreach($arrRecords as $intIndex => $objRecord){ 
				  ?>
						  <tr>
						  	<td>
						  		<?php echo $objRecord -> label ?>
						  	</td>
						  	<td>
						  		<?php echo $objRecord -> ip_address ?>
						  	</td>
						  	<td>
						  		<?php echo $objRecord -> duration ?>
						  	</td>
						  	<td>
						  		<?php echo WhitelistedIp::model()->whiteListIpEndDate($objRecord -> created_date, $objRecord -> duration); ?>
						  	</td>					  	
						  	<td>
						  		<?php echo $objRecord -> created_date ?>
						  	</td>
						  	<td>
						  		<?php echo Admin::model()->checkForCreatedBy($objRecord->created_by) ?>
						  	</td>
						  	<td>
						  		<input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox" value="<?php echo $objRecord->id ?>" style="display:<?php echo WhitelistedIp::model()->checkDeletionPriv($objRecord->id); ?>">
						  	</td>
						  </tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		<?php $this->endWidget(); ?>
	</div>
</div>
		<div id="ip-common-msg">
			<div id="msg-select-ip-delete" data-msg="<?php echo Yii::t('app', 'Please select an IP address that you would like to delete'); ?>"><!-- Dialog Buttons Label --></div>
		</div>
		<div id="ip-common-msg">
			<div id="msg-confirm-ip-delete" data-msg="<?php echo Yii::t('app', 'Are you sure that you want to delete selected IP address?'); ?>"><!-- Dialog Buttons Label --></div>
		</div>