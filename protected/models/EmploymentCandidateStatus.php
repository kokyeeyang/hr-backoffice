<?php 

/**
This is the model class for table "employment_candidate_status"
*/

class EmploymentCandidateStatus extends AppActiveRecord
{
	static $tableName = DB_TBL_PREFIX . 'employment_candidate_status';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){

	}

	public function attributeLabels(){
		return [
			'title' => Yii::t('app', 'title')
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