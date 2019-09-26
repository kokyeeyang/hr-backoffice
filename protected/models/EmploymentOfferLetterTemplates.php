<?php 

class EmploymentOfferLetterTemplates extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'employment_offer_letter_templates';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'offer_letter_title' => Yii::t('app', 'offer_letter_title'),
			'offer_letter_description' => Yii::t('app', 'offer_letter_description'),
			'offer_letter_content' => Yii::t('app', 'offer_letter_content'),
			'department' => Yii::t('app', 'department'),
			'is_managerial' => Yii::t('app', 'is_managerial'),
			'created_date' => Yii::t('app', 'created_date'),
			'created_by' => Yii::t('app', 'created_by'),
			'modified_date' => Yii::t('app', 'modified_date'),
			'modified_by' => Yii::t('app', 'modified_by')
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
