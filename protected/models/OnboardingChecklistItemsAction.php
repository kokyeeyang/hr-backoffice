<?php 

class OnboardingChecklistItemsAction extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_items_action';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'onboarding_checklist_user_mapping_id' => Yii::t('app', 'onboarding_checklist_user_mapping_id'),
			'onboarding_remark' => Yii::t('app', 'onboarding_remark'),
			'onboarding_checked_by' => Yii::t('app', 'onboarding_checked_by'),
			'onboarding_updated_date' => Yii::t('app', 'onboarding_updated_date'),
			'offboarding_remark' => Yii::t('app', 'offboarding_remark'),
			'offboarding_checked_by' => Yii::t('app', 'offboarding_checked_by'),
			'offboarding_updated_date' => Yii::t('app', 'offboarding_updated_date'),
			'created_by' => Yii::t('app', 'created_by'),
			'created_date' => Yii::t('app', 'created_date')
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
