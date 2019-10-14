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
			'is_managerial_position' => Yii::t('app', 'is_managerial_position'),
			'link' => Yii::t('app', 'link')
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
			return $arrData['job_title'];
		}
	}

	public function queryForAllJobs(){
		$sql = 'SELECT id, job_title

						FROM ' . self::$tableName;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryAll();	

		if (!empty($arrData)){
			return $arrData;
		}	
	}

	// public function queryForCandidateInterviewingManager($jobId){
	// 	$sql = 'SELECT interviewing_manager 

	// 					FROM ' . self::$tableName . '
						
	// 					WHERE id = ' . $jobId;

	// 	$objConnection = Yii::app()->db;
	// 	$objCommand = $objConnection->createCommand($sql);
	// 	$arrData = $objCommand->queryRow();

	// 	if (!empty($arrData['interviewing_manager'])){
	// 		return $arrData['interviewing_manager'];
	// 	}
	// }

	public function queryForCandidateDepartment($jobId){
		$sql = 'SELECT department 
		
						FROM ' . self::$tableName . '

						WHERE id = ' . $jobId;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData['department'])){
			return $arrData['department'];
		}
	}

	public function queryForDistinctDepartment(){
		$sql = 'SELECT DISTINCT department

		        FROM ' . self::$tableName;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData['department'])){
			return $arrData['department'];
		}
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function queryForCandidateInformation($queryString, $queryResult, $columnName){
		$sql = 'SELECT ' . $queryResult . '

						FROM ' . self::$tableName . '
						
						WHERE ' . $columnName . ' = ' . $queryString;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData)){
			return $arrData[$queryResult];
		}
	}		

	public function queryForIsManagerial($jobId){
		$sql = 'SELECT is_managerial_position

						FROM ' . self::$tableName . '

						WHERE id = ' . $jobId;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData['is_managerial_position'])){
			return $arrData['is_managerial_position'];
		}
	}

}