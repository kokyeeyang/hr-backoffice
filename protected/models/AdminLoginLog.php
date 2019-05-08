<?php
/**
 * This is the model class for table "admin_login_log".
 *
 */
class AdminLoginLog extends AppActiveRecord
{
	const STATUS_FAIL = 1;
	const STATUS_SUCCESS = 2;
	const STATUS_RETRY_OVER = 3;
	
	static $tableName = DB_TBL_PREFIX.'admin_login_log';
	
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
			array('admin_login_log_username, admin_login_log_ip, admin_login_log_status, admin_login_log_datetime', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//array('admin_login_log_username, admin_login_log_ip, admin_login_log_status, admin_login_log_type, admin_login_log_datetime', 'safe', 'on'=>'search'),
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
			'admin_login_log_id' 		=> Yii::t('app', 'ID'),
			'admin_login_log_username' 	=> Yii::t('app', 'Username'),
			'admin_login_log_ip'		=> Yii::t('app', 'User IP'),
			'admin_login_log_status' 	=> Yii::t('app', 'Status'),
			'admin_login_log_datetime' 	=> Yii::t('app', 'Login Datetime')
		);
	}
	
	/*public function beforeSave() {
		
		return parent::beforeSave();	
	}*/
	
	/***
	Method: getStatusLabel
	*/		
	public static function getStatusLabel($intStatus){
		
		switch($intStatus){
			case self::STATUS_FAIL:
				return '<span class="css_freeze">' . Yii::t('app', 'Login Failed') . '</span>';
			break;
				
			case self::STATUS_SUCCESS:
				return '<span class="css_active">' . Yii::t('app', 'Login Success') . '</span>';
			break;
			
			case self::STATUS_RETRY_OVER:
				return '<span class="css_freeze">' . Yii::t('app', 'Login Limit Exceeded') . '</span>';
			break;			
		}			
	}	
	
	public static function InsertLog($strAdminUsername, $intStatus, $strIP){
		$objAdminLoginLog = new AdminLoginLog;
		$objAdminLoginLog->setAttributes(	
									array(
										'admin_login_log_username' 	=> $strAdminUsername, 
										'admin_login_log_ip' 		=> $strIP, 
										'admin_login_log_status' 	=> $intStatus, 
										'admin_login_log_datetime' 	=> get_current_datetime()
									)
								);

		$objAdminLoginLog->save();
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
