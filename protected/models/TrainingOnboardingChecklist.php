<?php 

/**
This is the model class for table "training_onboarding_checklist"
*/

class TrainingOnboardingChecklist extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'training_onboarding_checklist';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'key' => Yii::t('app', 'key'),
			'category' => Yii::t('app', 'category'),
			'responsibility' => Yii::t('app', 'responsibility'),
			'candidate_id' => Yii::t('app', 'candidate_id'),
			'completed' => Yii::t('app', 'completed'),
			'completed_date' => Yii::t('app', 'completed_date'),
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
}