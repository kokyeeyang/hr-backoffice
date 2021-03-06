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
		return [
			['title', 'required']
		];
	}

	public function attributeLabels(){
		return [
			'title' => Yii::t('app', 'title'),
			'status' => Yii::t('app', 'status')
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

	public function deleteSelectedCandidateStatus($candidateStatusIds){

		if ($candidateStatusIds != ''){
			foreach($candidateStatusIds as $candidateStatusId){
				$candidateStatusCondition = 'id = ' . $candidateStatusId;

				EmploymentCandidateStatus::model()->deleteAll($candidateStatusCondition);
			}
		}
	}

	public function queryForCandidateStatus(){
		$sql = 'SELECT id, title ';
		$sql .= 'FROM ' . self::$tableName;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryAll();

		if (!empty($arrData)){
			return $arrData;
		}	
	}
}