<?php 

/**
This is the model class for table "training_onboarding_items"
*/

class TrainingItem extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'training_item';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'title' => Yii::t('app', 'title'),
			'description' => Yii::t('app', 'description'),
			'responsibility' => Yii::t('app', 'responsibility'),
			'status' => Yii::t('app', 'status'),
			'created_date' => Yii::t('app', 'created_date'),
			'created_by' => Yii::t('app', 'created_by'),
			'modified_date' => Yii::t('app', 'modified_date'),
			'modified_by' => Yii::t('app', 'modified_by')
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	

	public function obtainItemIds(){
		$sql = 'SELECT id ';
		$sql .= 'FROM ' . self::$tableName;

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryAll();

		if (!empty($arrData)){
			return $arrData; 
		} else {
			return false;
		} 
	}

	public function queryForOnboardingItem($id){
		$sql = 'SELECT onboarding_item ';
		$sql .= ' FROM ' . self::$tableName;
		$sql .= ' WHERE ' . 'id = ' . '"' . $id . '"';

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if (!empty($arrData)){
			return implode(" ", $arrData); 
		} else {
			return false;
		} 
	}

	public function queryForResponsibility($id){
		$sql = 'SELECT responsibility ';
		$sql .= ' FROM ' . self::$tableName;
		$sql .= ' WHERE ' . 'id = ' . '"' . $id . '"';

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if (!empty($arrData)){
			return implode(" ", $arrData); 
		} else {
			return false;
		} 
	}

}