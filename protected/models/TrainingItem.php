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

	public function selectAllTrainingItems(){
		$sql = 'SELECT *';
		$sql .= ' FROM ' . self::$tableName;
		$sql .= ' CASE WHEN status = 1';
		$sql .= ' THEN "Active" ';
		$sql .= ' WHEN status = 0';
		$sql .= ' THEN "Inactive"';

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryAll();

		if (!empty($arrData)){
			return $arrData; 
		} else {
			return false;
		} 
	}

}