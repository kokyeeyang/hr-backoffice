<?php 

/**
This is the model class for table "onboarding_checklist_items"
*/

class OnboardingChecklistItem extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_items';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [																				
			'description' => Yii::t('app', 'description'),
			'department_owner' => Yii::t('app', 'department_owner'),
			'is_offboarding_item' => Yii::t('app', 'is_offboarding_item'),
			'status' => Yii::t('app', 'status'),
			'is_managerial' => Yii::t('app', 'is_managerial')
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

	public function findAllOnboardingItems($strSortBy=false, $intPage=false, $numPerPage=false){
		$sql = 'SELECT ECI.id, ECI.title, D.title AS department_owner, ';
		$sql .= 'CASE WHEN ECI.is_offboarding_item = 0 THEN "No" ';
		$sql .= 'WHEN ECI.is_offboarding_item = 1 ';
		$sql .= 'THEN "Yes" ';
		$sql .= 'END AS "is_offboarding_item", ';
		$sql .= 'CASE WHEN ECI.status = 0 THEN "Inactive" ';
		$sql .= 'WHEN ECI.status = 1 ';
		$sql .= 'THEN "Active" ';
		$sql .= 'END AS "status", ';
		$sql .= 'CASE WHEN ECI.is_managerial = 0 THEN "Non-managerial" ';
		$sql .= 'WHEN ECI.is_managerial = 1 ';
		$sql .= 'THEN "Managerial" ';
		$sql .= 'END AS "is_managerial" ';
		$sql .= 'FROM onboarding_checklist_items ECI ';
		$sql .= 'INNER JOIN department D ';
		$sql .= 'ON ECI.department_owner = D.id ';
		$sql .= 'ORDER BY ' . $strSortBy;
		$sql .= ' LIMIT ' . CommonHelper::calculatePagination($intPage, $numPerPage) . ', ' . $numPerPage;
		
		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryAll($sql);

		return $arrData;		
	}

	public function deleteOnboardingItem($deleteOnboardingItemIds){
	    foreach($deleteOnboardingItemIds as $deleteOnboardingItemId){
		$condition = 'id = ' . $deleteOnboardingItemId;
		OnboardingChecklistItem::model()->deleteAll($condition);
	    }
	}
	
	public function queryForOnboardingItemTitles(){
	    $sql = 'SELECT id, title FROM ' . self::$tableName;
	    $sql .= ' WHERE status = 1'; 
	    
	    $objConnection = Yii::app()->db;
	    $objCommand = $objConnection->createCommand($sql);
	    $arrData = $objCommand->queryAll($sql);

	    return $arrData;
	}
}