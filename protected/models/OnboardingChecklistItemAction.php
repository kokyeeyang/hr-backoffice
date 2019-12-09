<?php 

class OnboardingChecklistItemAction extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_item_action';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'checklist_user_mapping_id' => Yii::t('app', 'checklist_user_mapping_id'),
			'status' => Yii::t('app', 'status'),
			'onboarding_checked_by' => Yii::t('app', 'onboarding_checked_by'),
			'onboarding_updated_date' => Yii::t('app', 'onboarding_updated_date'),
			'offboarding_checked_by' => Yii::t('app', 'offboarding_checked_by'),
			'offboarding_updated_date' => Yii::t('app', 'offboarding_updated_date')
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}	

}
