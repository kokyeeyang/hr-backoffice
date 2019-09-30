<?php 

/**
This is the model class for table "departments"
*/

class Department extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'departments';

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
}