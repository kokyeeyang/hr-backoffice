<?php 

/**
This is the model class for table "departments"
*/

class Department extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'department';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [																				
			'department_title' => Yii::t('app', 'department_title'),
			'department_description' => Yii::t('app', 'department_description')
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function queryForDepartments(){
		$sql = 'SELECT department_title FROM ' . self::$tableName;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->query();

		return $arrData;
	}
}