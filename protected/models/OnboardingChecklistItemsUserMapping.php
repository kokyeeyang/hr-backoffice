<?php

class OnboardingChecklistItemsUserMapping extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_items_user_mapping';

    public function tableName() {
	return self::$tableName;
    }

    public function rules() {
	return [
	];
    }

    public function attributeLabels() {
	return [
	    'onboarding_checklist_items_mapping_id' => Yii::t('app', 'onboarding_checklist_items_mapping_id'),
	    'user_id' => Yii::t('app', 'user_id'),
	    'created_date' => Yii::t('app', 'created_date'),
	    'created_by' => Yii::t('app', 'created_by')
	];
    }

    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return [
	    
	];
    }

    public static function model($className = __CLASS__) {
	return parent::model($className);
    }
}
