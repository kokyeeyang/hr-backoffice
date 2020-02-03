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

	public function updateOnboardingChecklist($completedItemIds, $id){
		$completedStatus = 1;
		$completedDate = date("Y-m-d");

		foreach($completedItemIds as $completedItemId){
			$sql = "UPDATE " . self::$tableName;
			$sql .= " SET completed = " . $completedStatus . ", completed_date = " . "'". $completedDate . "'";
			$sql .= " WHERE onboarding_item_id = " . $completedItemId;
			$sql .= " AND candidate_id = " . "'" . $id . "'";

			$objConnection 	= Yii::app()->db;
			$objCommand		= $objConnection->createCommand($sql)->execute();

		}

		$sql = "UPDATE " . self::$tableName;
		$sql .= " SET completed = 0, completed_date = null";
		$sql .= " WHERE onboarding_item_id NOT IN ('" . implode("', '" ,$completedItemIds) . "')";
		$sql .= " AND candidate_id = " . "'" . $id . "'";

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql)->execute();

	}

	public function revertOnboardingChecklist($id){
		$sql = "UPDATE " . self::$tableName;
		$sql .= " SET completed = 0, completed_date = null";
		$sql .= " WHERE candidate_id = " . "'" . $id . "'";

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql)->execute();
	}

	public function queryForChangedItems($itemIds, $id, $completedStatus){
		if($completedStatus == true){
			foreach($itemIds as $itemId){
				$satisfied = 1;
				$sql = "SELECT onboarding_item_id FROM " . self::$tableName;
				// $sql .= " WHERE completed = " . $satisfied;
				$sql .= " WHERE onboarding_item_id = " . $itemId;

				$objConnection 	= Yii::app()->db;
				$objCommand		= $objConnection->createCommand($sql);
				$arrData		= $objCommand->queryRow();

				return $arrData;
			}
		}else if($completedStatus == false){
			foreach($itemIds as $itemId){
				$satisfied = 0;
				$sql = "SELECT onboarding_item_id FROM " . self::$tableName;
				$sql .= " WHERE onboarding_item_id = " . $itemId;

				$objConnection 	= Yii::app()->db;
				$objCommand		= $objConnection->createCommand($sql);
				$arrData		= $objCommand->queryRow();

				return $arrData;
			}
		} 
	}

}