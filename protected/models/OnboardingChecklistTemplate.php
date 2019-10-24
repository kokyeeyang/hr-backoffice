<?php 

/**
This is the model class for table "onboarding_checklist_template"
*/

class OnboardingChecklistTemplate extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_template';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [																				
			'name' => Yii::t('app', 'name'),
			'description' => Yii::t('app', 'description'),
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

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}