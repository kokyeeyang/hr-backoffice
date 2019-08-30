<?php 

/**
This is the model class for table "training_onboarding_items"
*/

class TrainingOnboardingChecklist extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'training_onboarding_items';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'onboarding_item' => Yii::t('app', 'onboarding_item'),
			'category' => Yii::t('app', 'category'),
			'created_date' => Yii::t('app', 'created_date'),
			'created_by' => Yii::t('app', 'created_by')
		];
	}

}