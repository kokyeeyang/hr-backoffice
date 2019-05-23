<?php

/**
This is the model class for table "employment_referee"
*/

class EmploymentReferee extends AppActiveRecord 
{
	static $tableName = DB_TBL_PREFIX . 'employment_referee';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [

		];
	}

	public function attributeLabels(){
		return [
			'candidate_id' => Yii::t('app', 'candidate_id'),
			'supervisor_name' => Yii::t('app', 'supervisor_name'),
			'supervisor_company' => Yii::t('app', 'supervisor_company'),
			'supervisor_occupation' => Yii::t('app', 'supervisor_occupation'),
			'supervisor_contact' => Yii::t('app', 'supervisor_contact'),
			'years_known' => Yii::t('app', 'years_known')
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
}