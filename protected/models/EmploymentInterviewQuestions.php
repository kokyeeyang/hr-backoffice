<?php 

class EmploymentInterviewQuestions extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'employment_interview_questions';

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
			'suitable_experience' => Yii::t('app', 'suitable_experience'),
			'aspirations' => Yii::t('app', 'aspirations'),
			'passion' => Yii::t('app', 'passion'),
			'background' => Yii::t('app', 'background'),
			'commute' => Yii::t('app', 'commute'),
			'experience' => Yii::t('app', 'experience'),
			'leave_reason' => Yii::t('app', 'leave_reason'),
			'notice_period' => Yii::t('app', 'notice_period'),
			'interviewing_with_other_companies' => Yii::t('app', 'interviewing_with_other_companies'),
			'family_status' => Yii::t('app', 'family_status')
		];
	}	

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function queryForExistingInterviewQuestions($candidateId){
		$sql = 'SELECT candidate_id 

						FROM ' . self::$tableName . '

						WHERE candidate_id = ' . $candidateId;
		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData['candidate_id'])){
			return 'update record';
		} else {
			return 'new record';
		}
	}
}