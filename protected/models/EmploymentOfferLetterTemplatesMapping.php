<?php 

class EmploymentOfferLetterTemplatesMapping extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'employment_offer_letter_templates_mapping';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'offer_letter_template_id' => Yii::t('app', 'offer_letter_template_id'),
			'department_id' => Yii::t('app', 'department_id')
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