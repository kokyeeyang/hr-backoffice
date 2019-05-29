<?php

/**
This is the model class for table "employment_candidate"
*/

class EmploymentCandidate extends AppActiveRecord
{
	static $tableName = DB_TBL_PREFIX . 'employment_candidate';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			['full_name, id_no, address, contact_no, email_address, date_of_birth, marital_status, gender, nationality, reference_consent', 'required'],
		];
	}

	public function attributeLabels(){
		return [
			'full_name' => Yii::t('app', 'full_name'),
			'id_no' => Yii::t('app', 'id_no'),
			'address' => Yii::t('app', 'address'),
			'contact_no' => Yii::t('app', 'contact_no'),
			'email_address' => Yii::t('app', 'email_address'),
			'date_of_birth' => Yii::t('app', 'date_of_birth'),
			'marital_status' => Yii::t('app', 'marital_status'),
			'gender' => Yii::t('app', 'gender'),
			'nationality' => Yii::t('app', 'nationality'),
			'terminated_before' => Yii::t('app', 'terminated_before'),
			'termination_reason' => Yii::t('app', 'termination_reason'),
			'reference_consent' => Yii::t('app', 'reference_consent'),
			'refuse_reference_reason' => Yii::t('app', 'refuse_reference_reason'),
			'candidate_signature' => Yii::t('app', 'candidate_signature'),
			'candidate_signature_date' => Yii::t('app', 'candidate_signature_date'),
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function deleteSelectedCandidate($candidateIds){
		foreach($candidateIds as $candidateId){
			$candidateCondition = 'id_no = ' . $candidateId;
			$otherCondition = 'candidate_id = ' . $candidateId;

			EmploymentCandidate::model()->deleteAll($candidateCondition);
			EmploymentEducation::model()->deleteAll($otherCondition);
			EmploymentGeneralQuestion::model()->deleteAll($otherCondition);
			EmploymentJobExperience::model()->deleteAll($otherCondition);
			EmploymentReferee::model()->deleteAll($otherCondition);

		}
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

}