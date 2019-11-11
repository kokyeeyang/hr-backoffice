<?php
/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $admin_id
 * @property string $admin_username
 * @property string $admin_password
 * @property string $admin_display_name
 * @property integer $admin_status
 * @property timestamp $admin_modified_datetime 
 * @property datetime $admin_datetime
 */
class Admin extends AppActiveRecord
{
	const ACTIVE				= 1;
	const INACTIVE				= 0;
	
	static $tableName			= DB_TBL_PREFIX.'admin';
	static $arrPriv				= ['admin' => 'Administrator', 'manager' => 'Manager', 'hr' => 'HR', 'normaluser' => 'Normal User'];
	// static $departmentArray = Department::model()->findAll();

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
			array('admin_username, admin_password, admin_display_name, admin_status, admin_priv, admin_department, admin_last_login, admin_modified_datetime, admin_datetime', 'required'),
			array('admin_username', 'length', 'max'=>16),
			// No validation required(safe):
			array('admin_login_retry_times', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//array('id, username, password, email', 'safe', 'on'=>'search'),
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
			'admin_id' => Yii::t('app', 'Admin ID'),
			'admin_username' => Yii::t('app', 'Username'),
			'admin_password' => Yii::t('app', 'Password'),
			'admin_status' => Yii::t('app', 'Status'),
			'admin_priv' => Yii::t('app', 'Privilege'),
			'admin_login_retry_times' => Yii::t('app', 'Login Attempts'),
			'admin_display_name' => Yii::t('app', 'Name'),
			'admin_last_login' => Yii::t('app', 'Last Login')
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/*public function beforeSave() {
		
		if($this->admin_password !== ''){
			$this->admin_password = sha1($this->admin_password);
		}
		return parent::beforeSave();		
	}*/	
	
	/***
	Method: getStatusLabel
	*/		
	public static function getStatusLabel($intStatus){
		
		switch($intStatus){
			case self::INACTIVE:
				return '<span class="css_freeze">' . Yii::t('app', 'Inactive') . '</span>';
			break;
				
			case self::ACTIVE:
				return '<span class="css_active">' . Yii::t('app', 'Active') . '</span>';
			break;
		}			
	}

	/***
	Function	: checkUsernameExist
	Description	: Check Admin Username Exist
	Return		: (1) True this username has been taken
				  (2) False username available
	*/
	public function checkUsernameExist($strUsername, $intExcludedAdminId=null){
		$sql = 'SELECT 
					'.$this -> tableName().'_id
				FROM ' . 
					$this -> tableName() . ' 
				WHERE ' . 
					$this -> tableName() . '_username = "' . $strUsername . '"';
		
		// To exclude the passed-in AdminId param  		
		if($intExcludedAdminId !== null){
			$sql .= '
				AND
					'.$this -> tableName().'_id <> ' . (int)$intExcludedAdminId;
		} // - end: if
  
		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if(!empty($arrData['admin_id'])){
			return true;
		}
		else{
			return false;
		} // - end: if else
	}

	/***
	Function	: increaseLoginRetryTimes
	Description	: To increase(by 1) the number of login retried times
	*/
	public static function increaseLoginRetryTimes($strUsername){
		
		if(empty($strUsername)){
			return false;
		}
		
		$sql = 'UPDATE ' . 
					self::$tableName . ' 
				SET '.
					self::$tableName.'_login_retry_times = '.self::$tableName.'_login_retry_times + 1
				WHERE ' . 
					self::$tableName . '_username = "' . $strUsername . '"
				LIMIT 1';
  
		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);

		if(($intResults	= $objCommand->execute()) > 0){
			return true;
		}
		else{
			return false;
		} // - end: if else	
	}
	
	/***
	Function	: resetLoginRetryTimes
	Description	: To reset the number of login retried times to be nil
	*/
	public static function resetLoginRetryTimes($strUsername){
		
		if(empty($strUsername)){
			return false;
		}
		
		$sql = 'UPDATE ' . 
					self::$tableName . ' 
				SET '.
					self::$tableName.'_login_retry_times = 0
				WHERE ' . 
					self::$tableName . '_username = "' . $strUsername . '"
				LIMIT 1';
  
		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);

		if(($intResults	= $objCommand->execute()) > 0){
			return true;
		}
		else{
			return false;
		} // - end: if else	
	}

	/***
	Function	: deactivateRecord
	Description	: To deactivate the record
	*/
	public static function deactivateRecord($strUsername){
		
		if(empty($strUsername)){
			return false;
		}
		
		$sql = 'UPDATE ' . 
					self::$tableName . ' 
				SET '.
					self::$tableName.'_status = '.ADMIN::INACTIVE.'
				WHERE ' . 
					self::$tableName . '_username = "' . $strUsername . '"
				LIMIT 1';
  
		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);

		if(($intResults	= $objCommand->execute()) > 0){
			return true;
		}
		else{
			return false;
		} // - end: if else	
	}	
	
	/***
	Function	: getLoginRetryTimes
	Description	: To get the number of login retried times
	Return		: The number of login retried times
	*/
	public static function getLoginRetryTimes($strUsername){
		
		if(empty($strUsername)){
			return 0;
		}
		
		$sql = 'SELECT '.
					self::$tableName.'_login_retry_times
				FROM ' . 
					self::$tableName . ' 
				WHERE ' . 
					self::$tableName . '_username = "' . $strUsername . '"
				LIMIT 1';
  
		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if(!empty($arrData['admin_login_retry_times'])){
			return (int)$arrData['admin_login_retry_times'];
		}
		else{
			return 0;
		} // - end: if else
	}	

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	/*public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('admin_id', $this->admin_id);
		$criteria->compare('admin_username',$this->admin_username, true);
		$criteria->compare('admin_display_name',$this->admin_display_name, true);
		$criteria->compare('admin_status',$this->admin_status, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}*/

	public static function checkForCreatedBy($createdById){
		$sql = 'SELECT '. self::$tableName . '_username ';
		$sql .= 'FROM ' . self::$tableName;
		$sql .= ' WHERE ' . self::$tableName . '_id = ' . $createdById;

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		return $arrData['admin_username'];
	}

	public static function checkForAdminPrivilege($createdAdminId, $controller){
		if ($createdAdminId) {
			$sql = 'SELECT '. self::$tableName . '_priv ';
			$sql .= 'FROM ' . self::$tableName;
			$sql .= ' WHERE ' . self::$tableName . '_id = ' . $createdAdminId;

			$objConnection 	= Yii::app()->db;
			$objCommand		= $objConnection->createCommand($sql);
			$arrData		= $objCommand->queryRow();

			$infinityDuration = '';
			$access = '';

			if($arrData['admin_priv'] == "admin" || $arrData['admin_priv'] == "hr"){
				if($controller == 'ip'){
					$infinityDuration = 9999;
					return $infinityDuration;
				}else if($controller == 'registration'){
					return $access;
				}
			}else{
				$access = 'disabled';
				return $access;
			}
		}
	}

	public static function queryForManagers(){
		$sql = 'SELECT ' . self::$tableName . '_display_name';
		$sql .= ' FROM ' . self::$tableName;
		$sql .= ' WHERE ' . self::$tableName . '_priv != "normaluser"';

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryAll();

		if($arrData != null){
			return $arrData;
		} else {
			return false;
		}
	}

	public static function checkAdminDepartmentExist($id){
		$adminArr = "";
		// foreach($ids as $id){
		// 	$sql = 'SELECT ' . self::$tableName . '_username';
		// 	$sql .= ' FROM ' . self::$tableName;
		// 	$sql .= ' WHERE ' . self::$tableName . '_department = ' . $id;

		// 	$objConnection 	= Yii::app()->db;
		// 	$objCommand		= $objConnection->createCommand($sql);
		// 	$arrData		= $objCommand->queryAll();

		// 	if($arrData != null){
		// 		return $arrData;
		// 	} else {
		// 		return false;
		// 	}
		// }

		$sql = 'SELECT ' . self::$tableName . '_username';
		$sql .= ' FROM ' . self::$tableName;
		$sql .= ' WHERE ' . self::$tableName . '_department = ' . $id;

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if($arrData != null){
			return $arrData;
		} else {
			return false;
		}


	}

}
