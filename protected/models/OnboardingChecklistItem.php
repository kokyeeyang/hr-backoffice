<?php 

/**
This is the model class for table "onboarding_checklist_items"
*/

class OnboardingChecklistItem extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_items';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [																				
			'description' => Yii::t('app', 'description'),
			'department_owner' => Yii::t('app', 'department_owner'),
			'is_offloading_item' => Yii::t('app', 'is_offloading_item'),
			'status' => Yii::t('app', 'status'),
			'is_managerial' => Yii::t('app', 'is_managerial')
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