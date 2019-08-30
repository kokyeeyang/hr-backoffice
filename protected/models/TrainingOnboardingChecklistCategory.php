<?php 

/**
This is the model class for table "training_onboarding_checklist_category"
*/

class TrainingOnboardingChecklistCategory extends AppActiveRecord {

	static $tableName = DB_TBL_PREFIX . 'training_onboarding_checklist_category';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'category' => Yii::t('app', 'category'),
			'description' => Yii::t('app', 'description')
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
	
}