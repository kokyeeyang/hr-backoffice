<?php 

/**
This is the model class for table "employment_general_question"
*/

class EmploymentGeneralQuestion extends AppActiveRecord
{
	static $tableName = DB_TBL_PREFIX . 'employment_general_question';

	public function tableName(){
		return self::$tableName;
	}
	
	public function rules(){
		return [

		];
	}

	public function attributeLabels(){
		return [
			'candidate_id' => Yii::t('app', 'candidate_id'),
			'has_physical_ailment' => Yii::t('app', 'has_physical_ailment'),
			'ailment_description' => Yii::t('app', 'ailment_description'),
			'has_been_convicted' => Yii::t('app', 'has_been_convicted'),
			'offense' => Yii::t('app', 'offense'),
			'convicted_date' => Yii::t('app', 'convicted_date'),
			'date_of_discharge' => Yii::t('app', 'date_of_discharge'),
			'has_company_contact' => Yii::t('app', 'has_company_contact'),
			'company_contact_name' => Yii::t('app', 'company_contact_name'),
			'relationship_with_candidate' => Yii::t('app', 'relationship_with_candidate'),
			'has_conflict_of_interest' => Yii::t('app', 'has_conflict_of_interest'),
			'has_own_transport' => Yii::t('app', 'has_own_transport'),
			'has_applied_before' => Yii::t('app', 'has_applied_before'),
			'commencement_date' => Yii::t('app', 'commencement_date'),
			'good_conduct_consent' => Yii::t('app', 'good_conduct_consent'),
			'expected_salary' => Yii::t('app', 'expected_salary'),
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