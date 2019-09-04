<?php 

/**
This is the model class for table "training_onboarding_checklist"
*/

class TrainingOnboardingChecklist extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'training_onboarding_checklist';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'onboarding_item_id' => Yii::t('app', 'onboarding_item_id'),
			'candidate_id' => Yii::t('app', 'candidate_id'),
			'completed' => Yii::t('app', 'completed'),
			'completed_date' => Yii::t('app', 'completed_date'),
			'created_date' => Yii::t('app', 'created_date'),
			'created_by' => Yii::t('app', 'created_by')
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

	public function updateOnboardingChecklist($completedItemId){

		$completedStatus = 1;

		if($itemId == ''){
			$completedStatus = 0;
		}

		$sql = "UPDATE " . $tableName;
		$sql .= " SET completed = " . $completedStatus . ", completed_date" . date("Y-m-d");
		$sql .= " WHERE onboarding_item_id = " . $completedItemId;

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

	}

}