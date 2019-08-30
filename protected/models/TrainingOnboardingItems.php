<?php 

/**
This is the model class for table "training_onboarding_items"
*/

class TrainingOnboardingItems extends AppActiveRecord {
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
			'responsibility' => Yii::t('app', 'responsibility'),
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