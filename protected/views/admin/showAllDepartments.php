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
					'id'=>'departments-list',
					'action'=>$this->CreateUrl('admin/showAllDepartments'),
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
				)
			); 
		?>    	
			<h4 class="widget_title"><?php echo Yii::t('app', 'Departments List'); ?>
			</h4>
			<?php echo CHtml::hiddenField('mode', 'department-list'); ?>
			<?php echo CHtml::hiddenField('sort_key', $strSortKey); ?>
			<table class="widget_table grid">
				<thead>
					<tr>
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										<?php echo Yii::t('app', 'Department'); ?>
									</div>
								</div>
							</div>
						</th>
						<th>
							<div class="sort_wrapper_inner">
								<div class="sort_label_wrapper">
									<div class="sort_label">
										<?php echo Yii::t('app', 'Line manager'); ?>
									</div>
								</div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody id="data_table">
					<?php 
					// if(isset($arrRecords[0])){
				  ?>
				  <?php
				  	// foreach($arrRecords as $intIndex => $objRecord){ 
				  ?>
						  <tr>
						  	<td>
						  		<?php //echo $objRecord ->department ?>
						  	</td>
						  	<td>
						  		<?php //echo $objRecord -> ip_address ?>
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