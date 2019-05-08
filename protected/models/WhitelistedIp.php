<?php 

/**
This is the model class for table "whitelisted_ip"
*/

class WhitelistedIp extends AppActiveRecord
{
	static $tableName = DB_TBL_PREFIX.'whitelisted_ip';

	public function tableName()
	{
		return self::$tableName;
	}

	public function rules()
	{

		return array
		(

			array('label, ip_address, duration, created_by', 'required'),

		);
	}

	public function attributeLabels()
	{
		return array
		(
			'label' => Yii::t('app', 'Label'),
			'ip_address' => Yii::t('app', 'Ip Address'),
			'duration' => Yii::t('app', 'Duration'),
			'created_date' => Yii::t('app', 'Created date'),
			'created_by' => Yii::t('app', 'created_by')
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function checkWhitelistExist()
	{
		$currentIpAddress = $_SERVER['REMOTE_ADDR'];
		$currentDate = date("Y-m-d");
		$sql = 'SELECT '. 'ip_address ';
		$sql .= 'FROM '. 'whitelisted_ip ';
		$sql .= 'WHERE ' . 'ip_address = ' . '"' . $currentIpAddress .' "';
		//checking whether created date + duration is greater than today's date, if yes than ip is still whitelisted
		$sql .= 'AND ' . $currentDate . ' < ' . 'DATE_ADD(created_date, INTERVAL duration DAY)';
		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();
		//if results are found in database, then return true
		if (!empty($arrData['ip_address'])){
			return true; 
		} else {
			return false;
		}
	}

	public static function whiteListIpEndDate($createdDate, $duration)
	{
		$durationDays = $duration . " days";
		$createdDateTime = date_create($createdDate);
		$expiryDateTime = date_add($createdDateTime, date_interval_create_from_date_string($durationDays));
		$expiryDate = $expiryDateTime->format('Y-m-d H:i:s');

		return $expiryDate;
	}

	public function checkDuplicateWhitelistIp($ipAddress)
	{
		$sql = 'SELECT ip_address ';
		$sql .= 'FROM ' . self::$tableName;
		$sql .= ' WHERE ip_address = "' . $ipAddress . '"'; 

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if (!empty($arrData['ip_address'])){
			return true; 
		} else {
			return false;
		}
	}

	public function deleteSelectedWhitelistIp($ipRecordIds)
	{
		foreach($ipRecordIds as $ipRecordId){
			$condition = 'id = ' . $ipRecordId;
			WhitelistedIp::model()->deleteAll($condition);
		}
	}
	
//check to see if user is allowed to delete the ip address or not
	public function checkDeletionPriv($ipRecordId)
	{

		if(isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin'])){
			return true;
		} else {
			$sql = 'SELECT 
								created_by
							FROM ' . 
								self::$tableName . '
							WHERE 
								created_by = ' . Yii::app()->user->id . '
							AND
								id = ' . (int)$ipRecordId;

			$objConnection 	= Yii::app()->db;
			$objCommand		= $objConnection->createCommand($sql);
			$arrData		= $objCommand->queryRow();

			if (!empty($arrData['created_by'])){
				return 'block';
			} else {
				return 'none';
			}
		}
	}

}