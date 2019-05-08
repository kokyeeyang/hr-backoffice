<?php

class ReportController extends Controller
{
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
    public function filters()
    {
        return array(
			'accessControl',
        );
    }

	public function accessRules()
	{
		return array(
			array(
				'allow',  // allow all users to perform the RoleHelper's returned actions
				'actions'=>RoleHelper::GetRole(self::$strController, false),
				'users'=>array('*'),
			),
			array(
				'allow', // allow authenticated admin user to perform the RoleHelper's returned actions
				'actions'=>RoleHelper::GetRole(self::$strController, true),
				'users'=>array('@'),
			),
			array(
				'deny',  // deny all other users access
				'users'=>array('*'),
			),
		);	
	}
	
	/**
	 * To get the list of records for the admin activity logs
	 */
	public function actionGetAdminActivityLogList(){

		if(isset($_POST['ajax']) && $_POST['ajax']==='get-admin-activity-log-list' && Yii::app()->request->isAjaxRequest){
			$aResult 			= array();
			$aResult['result'] 	= 0;	
			$aResult['content'] = '';
			$aResult['msg'] 	= '';
			$aResult['url'] 	= '';
			
			$aResult['content'] = $this->getAdminActivityLogList('renderPartial', $this->intPage);
			
			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			} // - end: if

			echo(json_encode($aResult));
			Yii::app()->end();		
		}
		else{
			return $this->getAdminActivityLogList('render', $this->intPage);
		} // - end: if else
	}

	/**
	 * To get the list of records for the admin activity logs(e.g. for Ajax request).
	 */
	private function getAdminActivityLogList($strMode=null, $intPage = null){
		$intPage				= (int)$intPage;
		$strSortKey				= $this->getParam('sort_key', '');
		$intLogSearchAdminId	= $this->getParam('log_search_admin_id', '', array('name' => Yii::t('app', 'Admin ID'), 'type' => 'int'));
		$strLogSearchController	= $this->getParam('log_search_controller', '', array('name' => Yii::t('app', 'Controller'), 'type' => 'strns'));
		$strLogSearchAction		= $this->getParam('log_search_action', '', array('name' => Yii::t('app', 'Action'), 'type' => 'strns'));
		$strLogSearchStartDate	= $this->getParam('log_search_start_date', get_current_datetime('Y-m-d 00:00:00', strtotime("-2 day")), array('name' => Yii::t('app', 'Start Datetime'), 'type' => 'yyyy-mm-dd hh:mm:ss'));
		$strLogSearchEndDate 	= $this->getParam('log_search_end_date', get_current_datetime('Y-m-d 23:59:59', strtotime("+0 day")), array('name' => Yii::t('app', 'End Datetime'), 'type' => 'yyyy-mm-dd hh:mm:ss'));	
		
		switch($strSortKey){
			case 'sort_log_id_asc':
				$strSortBy = 'admin_activity_log_id ASC';
			break;
			
			case 'sort_log_id_desc':
				$strSortBy = 'admin_activity_log_id DESC';
			break;

			case 'sort_log_controller_asc':
				$strSortBy = 'admin_activity_log_controller ASC';
			break;
			
			case 'sort_log_controller_desc':
				$strSortBy = 'admin_activity_log_controller DESC';
			break;
			
			case 'sort_log_action_asc':
				$strSortBy = 'admin_activity_log_action ASC';
			break;
			
			case 'sort_log_action_desc':
				$strSortBy = 'admin_activity_log_action DESC';
			break;
			
			case 'sort_log_params_asc':
				$strSortBy = 'admin_activity_log_params ASC';
			break;
			
			case 'sort_log_params_desc':
				$strSortBy = 'admin_activity_log_params DESC';
			break;
			
			case 'sort_admin_username_asc':
				$strSortBy = 'a.admin_username ASC';
			break;
			
			case 'sort_admin_username_desc':
				$strSortBy = 'a.admin_username DESC';
			break;
			
			case 'sor_log_ip_asc':
				$strSortBy = 'admin_activity_log_ip ASC';
			break;
			
			case 'sort_log_ip_desc':
				$strSortBy = 'admin_activity_log_ip DESC';
			break;
			
			case 'sort_log_datetime_asc':
				$strSortBy = 'admin_activity_log_datetime ASC';
			break;
			
			case 'sort_log_datetime_desc':
			default:
				$strSortKey = 'sort_log_datetime_desc';
				$strSortBy 	= 'admin_activity_log_datetime DESC';
			break;
		}
		
		AdminActivityLog::$num_per_page = 20;
		$arrData 						= AdminActivityLog::model()->getRecords($intPage, $intLogSearchAdminId, $strLogSearchController, $strLogSearchAction, $strLogSearchStartDate, $strLogSearchEndDate, $strSortBy);
		$arrAdmins						= Admin::model()->findAll(array('order' => 'admin_username ASC'));
		$arrControllers					= AdminActivityLog::model()->findAll(array(
																'select'	=> 'admin_activity_log_controller',
																'distinct'	=> true,
																'order'		=> 'admin_activity_log_controller ASC'
															));
		$arrActions		= AdminActivityLog::model()->findAll(array(
																'select'	=> 'admin_activity_log_action',
																'distinct'	=> true,
																'order'		=> 'admin_activity_log_action ASC'
															));
		
		switch($strMode){
			case 'render':
				$strMode 	= 'render';
				$bolReturn 	= false;
			break;
			
			case 'renderPartial':
			default:
				$strMode 	= 'renderPartial';
				$bolReturn 	= true;
			break;
		} // - end: switch
		
		$arrData['pagination'] = isset($arrData['pagination']) ? $arrData['pagination'] : '';
		return $this->$strMode('admin_activity_log_list', array(	'strSortKey'=>$strSortKey,
																	'arrRecords'=>$arrData['records'], 
																	'objPagination'=>$arrData['pagination'], 
																	'arrAdmins' => $arrAdmins, 
																	'arrControllers' => $arrControllers, 
																	'arrActions' => $arrActions, 
																	'intLogSearchAdminId' => $intLogSearchAdminId, 
																	'strLogSearchController' => $strLogSearchController,
																	'strLogSearchAction' => $strLogSearchAction, 
																	'strLogSearchStartDate' => $strLogSearchStartDate, 
																	'strLogSearchEndDate' => $strLogSearchEndDate 
																), $bolReturn);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return GameCategory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{	$intId 		= (int)$id;
		$objModel	= GameCategory::model()->findByPk($intId);
		
		if($objModel===null){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $objModel;
	}
}
