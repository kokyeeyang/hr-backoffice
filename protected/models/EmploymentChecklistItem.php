<?php 

/**
This is the model class for table "employment_education"
*/

class OnboardingChecklistItem extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_items';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			['name, description, status, created_date, created_by', 'required'],
		];
	}

	public function attributeLabels(){
		return [
			'name' => Yii::t('app', 'name'),
			'description' => Yii::t('app', 'description'),
			'status' => Yii::t('app', 'status'),
			'created_date' => Yii::t('app', 'created_date'),
			'created_by' => Yii::t('app', 'created_by')
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