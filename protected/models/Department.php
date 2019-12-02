<?php 

/**
This is the model class for table "departments"
*/

class Department extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'department';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [																				
			'title' => Yii::t('app', 'title'),
			'description' => Yii::t('app', 'description')
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'id'=>[self::HAS_MANY, 'employment_offer_letter_templates_mapping', 'department_id']
		);
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function queryForDepartmentDetails($queryResults){
		$sql = 'SELECT ' . $queryResults . ' FROM ' . self::$tableName;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryAll();

		return $arrData;
	}

	public function queryForDepartmentTitle($id){
    $sql = 'SELECT title FROM ' . self::$tableName;
    $sql .= ' WHERE id=' . '"' . $id . '"';

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		return $arrData;
	}

	public function deleteSelectedDepartment($departmentIds){
		foreach($departmentIds as $departmentId){
			$condition = "id = $departmentId";
			Department::model()->deleteAll($condition);
		}
	}

}