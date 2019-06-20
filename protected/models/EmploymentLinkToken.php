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

	public function verifyToken($tokenPassed){
		$sql = 'SELECT 
							token 
					  FROM ' .
					  	self::$tableName . '
					  WHERE token = "' . 
					  $tokenPassed . '"';

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if (!empty($arrData['token'])){
			return true;
		} else {
			return false;
		}

	}

	//Once candidate clicked save, then delete token from database
	public function deleteUsedToken($usedToken){
		$condition = 'token = "' . $usedToken . '"';
		EmploymentLinkToken::model()->deleteAll($condition);
	}
	
	public function purgeUnusedTokens(){
		$condition = 'token WHERE created_date';
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