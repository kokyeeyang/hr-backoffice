<?php

/**
  This is the model class for table "training_template"
 */
class TrainingTemplate extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'training_template';

    public function tableName() {
	return self::$tableName;
    }

    public function rules() {
	return [
	];
    }

    public function attributeLabels() {
	return [
	    'title' => Yii::t('app', 'title'),
	    'description' => Yii::t('app', 'description'),
	    'department_id' => Yii::t('app', 'department_id'),
	    'created_date' => Yii::t('app', 'created_date'),
	    'created_by' => Yii::t('app', 'created_by'),
	    'modified_date' => Yii::t('app', 'modified_date'),
	    'modified_by' => Yii::t('app', 'modified_by')
	];
    }

    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	);
    }

    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    public function selectAllTrainingTemplates($strSortBy=false, $intPage=false, $numPerPage=false, $condition = false, $filter = false) {
	$sql = 'SELECT TT.id, TT.title, TT.description, GROUP_CONCAT(D.title SEPARATOR ", ") AS department, TT.created_date, TT.modified_date ';
	$sql .= 'FROM training_template TT ';
	$sql .= 'INNER JOIN training_templates_mapping TTM ';
	$sql .= 'ON TTM.training_template_id = TT.id ';
	$sql .= 'INNER JOIN department D ';
	$sql .= 'ON TTM.department_id = D.id ';
	
	if ($filter != false){
	    $sql .= 'WHERE ' . $filter;
	}
	
	if ($condition != false) {
	    $sql .= 'GROUP BY TT.id';
	    
	    if ($_POST == false && !isset($_POST["sort_key"])) {
		$strSortBy = 'TT.created_date DESC';
	    }

	    if ($_POST != false && $_POST["sort_key"] == false) {
		$strSortBy = 'TT.created_date DESC';
	    }
	    $sql .= ' ORDER BY ' . $strSortBy;
	    $sql .= ' LIMIT ' . CommonHelper::calculatePagination($intPage, $numPerPage) . ', ' . $numPerPage;
	}


	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll();

	if (!empty($arrData)) {
	    return $arrData;
	} else {
	    return false;
	}
    }

    public function deleteTrainingTemplates($deleteTrainingTemplateIds) {
	foreach ($deleteTrainingTemplateIds as $deleteTrainingTemplateIds) {
	    $condition = 'id = ' . $deleteTrainingTemplateIds;
	    TrainingTemplate::model()->deleteAll($condition);
	}
    }

}
