<?php 

/**
This is the model class for table "employment_job_opening"
*/

class EmploymentJobOpening extends AppActiveRecord
{
	static $tableName = DB_TBL_PREFIX . 'employment_job_opening';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'job_title' => Yii::t('app', 'job_title'),
			'department' => Yii::t('app', 'department'),
			'interview_manager' => Yii::t('app', 'interview_manager'),
			'link' => Yii::t('app', 'link'),
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

	public function deleteSelectedJobOpening($jobOpeningIds){
		foreach($jobOpeningIds as $jobOpeningId){
			$condition = 'id = ' . $jobOpeningId;
			EmploymentJobOpening::model()->deleteAll($condition);
		}
	}
}