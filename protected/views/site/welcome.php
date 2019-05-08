<div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php echo Yii::t('app', 'Home'); ?></div>
		<div class="breadcrumb-bottom">
			<div class="title">
				<span id="welcome-msg"><?php echo Yii::t('app', 'Welcome to HR Back Office'); ?></span>
			</div>
		</div>
	</div>
</div>

<?php
if(isset($model[0])){ ?>
<div class="common_content_wrapper admin_login_log_list">
	<div class="common_content_inner_wrapper">
		<h4 class="widget_title"><?php echo Yii::t('app', 'Admin Login Logs'); ?></h4>
		<table class="widget_table grid">		
			<thead>
				<tr>
					<th><?php echo Yii::t('app', 'Username'); ?></th>
					<th><?php echo Yii::t('app', 'IP'); ?></th>
					<th><?php echo Yii::t('app', 'Status'); ?></th>
					<th><?php echo Yii::t('app', 'Datetime'); ?></th>
				</tr>
			</thead>
			<tbody>		
			<?php
				foreach($model as $intIndex => $objRecord){ ?>
				<tr>
					<td><?php echo $objRecord -> admin_login_log_username; ?></td>
					<td><?php echo $objRecord -> admin_login_log_ip; ?></td>
					<td><?php echo AdminLoginLog::getStatusLabel($objRecord -> admin_login_log_status); ?></td>
					<td><?php echo $objRecord -> admin_login_log_datetime; ?></td>
				</tr>
			<?php
				} // - end: foreach ?>
			</tbody>
		</table>
	</div>
</div>
<?php
} // - end: if ?>