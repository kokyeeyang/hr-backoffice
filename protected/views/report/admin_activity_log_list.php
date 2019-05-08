<div class="breadcrumb">
	<div class="breadcrumb_wrapper">
		<div class="breadcrumb-top"><?php echo Yii::t('app', 'Report') . ' - ' . Yii::t('app', 'Administrator Activity Logs'); ?></div>
		<div class="breadcrumb-bottom breadcrumb-bottom-report">
			<div class="title">
				<span><?php echo Yii::t('app', 'Administrator Activity Logs'); ?></span>
			</div>
		</div>
	</div>
</div>
<div class="common_content_wrapper admin_activity_log_list_form">
	<div class="common_content_inner_wrapper">
		<?php 							
			$objForm = $this->beginWidget(
						'CActiveForm', 
						array(
							'id'=>'admin-activity-log-list-form',
							'action' => $this->createUrl('report/getAdminActivityLogList'),
							// Please note: When you enable ajax validation, make sure the corresponding
							// controller action is handling ajax validation correctly.
							// There is a call to performAjaxValidation() commented in generated controller code.
							// See class documentation of CActiveForm for details on this.
							'enableAjaxValidation'=>false,
						)
					); ?>
		<?php echo CHtml::hiddenField('mode', 'get-admin-activity-log-list'); ?>
		<?php echo CHtml::hiddenField('sort_key', $strSortKey); ?>
		<div class="search_box">
			<table cellpadding="3" cellspacing="3" border="0">
				<tr>
					<td class="content-text-red-medium-bold">
						<?php echo Yii::t('app', 'Username');?>:
					</td>
					<td>
						<select name="log_search_admin_id" id="log_search_admin_id">
							<option value=""><?php echo Yii::t('app', 'All'); ?></option>
					<?php
					if(isset($arrAdmins[0])){ 
						
						foreach($arrAdmins as $aRecord){ ?>
							<option value="<?php echo $aRecord['admin_id']; ?>" <?php echo (($intLogSearchAdminId == $aRecord['admin_id']) ? 'selected="selected"' : ''); ?>><?php echo $aRecord['admin_username']; ?></option>
					<?php
						} // - end: foreach
					} // - end: if ?>
						</select>
					</td>		
					<td class="content-text-red-medium-bold">
						<?php echo Yii::t('app', 'Controller');?>:
					</td>
					<td>
						<select name="log_search_controller" id="log_search_controller">
							<option value=""><?php echo Yii::t('app', 'All'); ?></option>
							<?php
							if(isset($arrControllers[0])){ 
								
								foreach($arrControllers as $oRecord){ ?>
									<option value="<?php echo $oRecord -> admin_activity_log_controller; ?>" <?php echo (($strLogSearchController == $oRecord -> admin_activity_log_controller) ? 'selected="selected"' : ''); ?>><?php echo $oRecord -> admin_activity_log_controller; ?></option>
							<?php
								} // - end: foreach
							} // - end: if ?>
						</select>
					</td>
					<td class="content-text-red-medium-bold">
						<?php echo Yii::t('app', 'Action');?>:
					</td>
					<td>
						<select name="log_search_action" id="log_search_action">
							<option value=""><?php echo Yii::t('app', 'All'); ?></option>
							<?php
							if(isset($arrActions[0])){ 
								
								foreach($arrActions as $oRecord){ ?>
									<option value="<?php echo $oRecord -> admin_activity_log_action; ?>" <?php echo (($strLogSearchAction == $oRecord -> admin_activity_log_action) ? 'selected="selected"' : ''); ?>><?php echo $oRecord -> admin_activity_log_action; ?></option>
							<?php
								} // - end: foreach
							} // - end: if ?>
						</select>
					</td>
				</tr>
				<tr>			
					<td class="content-text-red-medium-bold">
						<?php echo Yii::t('app', 'Start Datetime');?>:
					</td>
					<td>
						<input type="text" value="<?php echo $strLogSearchStartDate;?>" name="log_search_start_date" id="log_search_start_date" />
					</td>
					<td class="content-text-red-medium-bold">
						<?php echo Yii::t('app', 'End Datetime');?>:
					</td>
					<td>
						<input type="text" value="<?php echo $strLogSearchEndDate;?>" name="log_search_end_date" id="log_search_end_date" />
					</td>					
					<td>&nbsp;</td>
					<td>
						<?php echo get_button(Yii::t('app', 'Search'), 80, '', '', 'grey', 'btnRefreshPage', '', '', 'search'); ?>
					</td>
				</tr>
			</table>
		</div>	
		<h4 class="widget_title"><?php echo Yii::t('app', 'Administrator Activity Logs'); ?></h4>
			<table class="widget_table grid">
				<thead>
					<tr>
						<th>
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_log_id_desc'){?> desc<?php }elseif($strSortKey === 'sort_log_id_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_log_id">
								<a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
									<div class="sort_wrapper_inner">								
										<div class="sort_label_wrapper">
											<div class="sort_label"><?php echo Yii::t('app', 'ID'); ?></div>
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
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_log_controller_desc'){?> desc<?php }elseif($strSortKey === 'sort_log_controller_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_log_controller">
								<a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
									<div class="sort_wrapper_inner">								
										<div class="sort_label_wrapper">
											<div class="sort_label"><?php echo Yii::t('app', 'Controller'); ?></div>
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
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_log_action_desc'){?> desc<?php }elseif($strSortKey === 'sort_log_action_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_log_action">
								<a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
									<div class="sort_wrapper_inner">								
										<div class="sort_label_wrapper">
											<div class="sort_label"><?php echo Yii::t('app', 'Action'); ?></div>
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
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_log_params_desc'){?> desc<?php }elseif($strSortKey === 'sort_log_params_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_log_params">
								<a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
									<div class="sort_wrapper_inner">								
										<div class="sort_label_wrapper">
											<div class="sort_label"><?php echo Yii::t('app', 'Details'); ?></div>
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
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_admin_username_desc'){?> desc<?php }elseif($strSortKey === 'sort_admin_username_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_admin_username">
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
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_log_ip_desc'){?> desc<?php }elseif($strSortKey === 'sort_log_ip_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_log_ip">
								<a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
									<div class="sort_wrapper_inner">								
										<div class="sort_label_wrapper">
											<div class="sort_label"><?php echo Yii::t('app', 'IP'); ?></div>
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
							<div class="btnAjaxSortList sort_wrapper<?php if($strSortKey === 'sort_log_datetime_desc'){?> desc<?php }elseif($strSortKey === 'sort_log_datetime_asc'){ ?> asc<?php } ?>" rel="sort" rev="sort_log_datetime">
								<a title="<?php echo Yii::t('app', 'Sort'); ?>" href="javascript:void(0);">
									<div class="sort_wrapper_inner">								
										<div class="sort_label_wrapper">
											<div class="sort_label"><?php echo Yii::t('app', 'Datetime'); ?></div>
										</div>
										<div class="sort_icon_wrapper">
											<div class="sort_icon">&nbsp;</div>
										</div>
										<div class="clear"><!--clear--></div>
									</div>
								</a>										
							</div>						
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if(isset($arrRecords[0])){ ?>	
				<?php
					foreach($arrRecords as $intIndex => $aRecord){ ?>
					<tr>
						<td><?php echo $aRecord['admin_activity_log_id']; ?></td>
						<td><?php echo $aRecord['admin_activity_log_controller']; ?></td>
						<td><?php echo $aRecord['admin_activity_log_action']; ?></td>
						<td style="word-break:break-all;"><?php echo $aRecord['admin_activity_log_params']; ?></td>
						<td><?php echo !empty($aRecord['admin_username']) ? $aRecord['admin_username'] : '-'; ?></td>
						<td><?php echo $aRecord['admin_activity_log_ip']; ?></td>						
						<td style="white-space:nowrap;"><?php echo $aRecord['admin_activity_log_datetime']; ?></td>
					</tr>
				<?php
					} // - end: foreach ?>
				<?php
				}
				else { ?>
					<tr>
						<td colspan="7"><center><b><?php echo Yii::t('app', 'No Record'); ?></b></center></td>
					</tr>			
				<?php
				} // - end: if else ?>
				</tbody>
			</table>
			<?php
			if(isset($arrRecords[0])){		
				echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/pagination.php', array('objPagination' => $objPagination));
			} // - end: if ?>		
			<?php $this->endWidget(); ?>
	</div>
</div>