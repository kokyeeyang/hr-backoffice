<?php 

/**
This is the model class for table "employment_job_experience"
*/

class EmploymentJobExperience extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'employment_job_experience';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			['candidate_id, company_name, start_date, end_date, position_held, starting_salary, ending_salary, allowances, terminated_before', 'required'],
		];
	}	

	public function attributeLabels(){
		return [
			'candidate_id' => Yii::t('app', 'candidate_id'),
			'company_name' => Yii::t('app', 'company_name'),
			'start_date' => Yii::t('app', 'start_date'),
			'end_date' => Yii::t('app', 'end_date'),
			'position_held' => Yii::t('app', 'position_held'),
			'starting_salary' => Yii::t('app', 'starting_salary'),
			'ending_salary' => Yii::t('app', 'ending_salary'),
			'allowances' => Yii::t('app', 'allowances'),
			'terminated_before' => Yii::t('app', 'terminated_before'),
			'leave_reason' => Yii::t('app', 'leave_reason')
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