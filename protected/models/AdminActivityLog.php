<?php
/**
 * This is the model class for table "admin_activity_log".
 *
 */
class AdminActivityLog extends AppActiveRecord
{	
	static $tableName = DB_TBL_PREFIX.'admin_activity_log';
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{	
		return self::$tableName;
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_id, admin_activity_log_ip, admin_activity_log_controller, admin_activity_log_action, admin_activity_log_params, admin_activity_log_datetime', 'required'),
			array('admin_id', 'numerical', 'integerOnly'=>true),
			// No validation required(safe):
			array('admin_activity_log_modified_datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//array('admin_id, admin_log_ip, admin_log_controller, admin_log_action, admin_log_datetime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'admin_activity_log_id' => Yii::t('app', 'ID'),
			'admin_id' => Yii::t('app', 'Admin ID'),
			'admin_activity_log_ip' => Yii::t('app', 'IP'),
			'admin_activity_log_controller' => Yii::t('app', 'Controller'),
			'admin_activity_log_action' => Yii::t('app', 'Action'),
			'admin_activity_log_params' => Yii::t('app', 'Details'),
			'admin_activity_log_modified_datetime' => Yii::t('app', 'Modified Datetime'),
			'admin_activity_log_datetime' => Yii::t('app', 'Datetime')
		);
	}
	
	/*public function beforeSave() {
		
		return parent::beforeSave();	
	}*/
	
	public static function InsertLog($intAdminId, $strController, $strAction, $strIP){
		// To filter the value of the password param for those sensitive sections.
		$strParams = str_sanitize(preg_replace('/(password|[^&]+_password[^=]*)=([^&])+/', '$1=PASSWORD', urldecode(http_build_query($_REQUEST))));
		
		$objAdminActivityLog = new AdminActivityLog;
		$objAdminActivityLog->setAttributes(	
									array(
										'admin_id' 						=> $intAdminId, 
										'admin_activity_log_ip' 		=> $strIP, 
										'admin_activity_log_controller' => $strController, 
										'admin_activity_log_action' 	=> $strAction,
										'admin_activity_log_params' 	=> $strParams,
										'admin_activity_log_datetime' 	=> get_current_datetime()
									)
								);

		$objAdminActivityLog->save();
	}

	/***
	Function	: getRecords
	Description	: To get the admin activity log records
	*/
	public function getRecords($intPage = null, $intAdminId = null, $strController = null, $strAction = null, $strStartDate = null, $strEndDate = null, $strSortBy = 'admin_activity_log_datetime DESC'){				
		$sql_cond = '
			FROM ' . 
				self::$tableName . ' AS l
			LEFT JOIN
				admin AS a
			ON
				l.admin_id = a.admin_id
			WHERE
				1 = 1 ';		
		
		if($intAdminId !== null && $intAdminId !== ''){
			$sql_cond .= '
			AND
				l.admin_id = '.(int)$intAdminId;
		} // - end: if
		
		if($strController !== null && $strController !== ''){
			$sql_cond .= '
			AND
				l.'.self::$tableName.'_controller = "'.$strController.'"';
		} // - end: if

		if($strAction !== null && $strAction !== ''){
			$sql_cond .= '
			AND
				l.'.self::$tableName.'_action = "'.$strAction.'"';
		} // - end: if	

		if(!empty($strStartDate) && !empty($strEndDate)){
			$sql_cond .= ' 	
			AND 
				l.'.self::$tableName.'_datetime >= "' . $strStartDate . '"
			AND
				l.'.self::$tableName.'_datetime <= "' . $strEndDate . '" ';
		}
		else if(!empty($strStartDate)){
			$sql_cond .= ' 	
			AND 
				l.'.self::$tableName.'_datetime >= "' . $strStartDate . '" ';
		}	
		else if(!empty($strEndDate)){
			$sql_cond .= '
			AND 
				l.'.self::$tableName.'_datetime <= "' . $strEndDate . '" ';
		} // - end: if else	
		
		$sql = '
			SELECT 
					l.*,
					a.admin_username,
					a.admin_display_name' .
			$sql_cond . '
			ORDER BY ' . 
				$strSortBy;
		
		if($intPage !== null){
			$sql_count = '
				SELECT 
					COUNT(*)  ' . $sql_cond;
			
			$arrData = self::getPageRecords($intPage, $sql, $sql_count);
		}
		else{
			$objConnection 			= Yii::app()->db;
			$objCommand				= $objConnection->createCommand($sql);
			$arrData['records']		= $objCommand->queryAll();		
		} // - end: if else
		return $arrData;
	}	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
