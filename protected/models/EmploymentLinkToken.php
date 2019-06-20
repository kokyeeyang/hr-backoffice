<?php 

/**
This is the model class for table "employment_link_token"
*/

class EmploymentLinkToken extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'employment_link_token';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'token' => Yii::t('app', 'token'),
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function generateRandomToken(){
		$n = 20; 
		$result = bin2hex(random_bytes($n));

		$linkTokenObjModel = new EmploymentLinkToken;
		$linkTokenObjModel->token = $result;
		$linkTokenObjModel->save();

		return $result;
	}	

	public function purgeOldTokens(){
		$condition = 'token WHERE created_date';
	}
}