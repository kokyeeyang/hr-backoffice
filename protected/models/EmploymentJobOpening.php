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

	public function deleteSelectedJobOpening($jobOpeningIds){
		foreach($jobOpeningIds as $jobOpeningId){
			$condition = 'id = ' . $jobOpeningId;
			EmploymentJobOpening::model()->deleteAll($condition);
		}
	}

	public function queryForCandidateJob($jobId){
		$sql = 'SELECT job_title 

						FROM ' . self::$tableName . '
						
						WHERE id = ' . $jobId;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData['job_title'])){
			foreach($arrData as $objData){
				return $objData;
			}
		}
	}

	public function queryForCandidateInterviewingManager($jobId){
		$sql = 'SELECT interviewing_manager 

						FROM ' . self::$tableName . '
						
						WHERE id = ' . $jobId;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData['interviewing_manager'])){
			foreach($arrData as $objData){
				return $objData;
			}
		}
	}

	public function queryForCandidateDepartment($jobId){
		$sql = 'SELECT department 
		
						FROM ' . self::$tableName . '

						WHERE id = ' . $jobId;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData['department'])){
			foreach($arrData as $objData){
				return $objData;
			}
		}
	}

	public function queryForDistinctDepartment(){
		$sql = 'SELECT DISTINCT department

		        FROM ' . self::$tableName;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData['department'])){
			return $arrData;
		}
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

}