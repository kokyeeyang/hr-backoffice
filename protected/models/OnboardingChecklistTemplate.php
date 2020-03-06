<?php

/**
  This is the model class for table "onboarding_checklist_template"
 */
class OnboardingChecklistTemplate extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_template';

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
	    'created_date' => Yii::t('app', 'created_date'),
	    'created_by' => Yii::t('app', 'created_by')
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

    public function queryForOnboardingChecklistTemplateDetails($queryResults) {
	$sql = 'SELECT ' . $queryResults . ' FROM ' . self::$tableName;

	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryRow();

	return $arrData;
    }

    public function findAllOnboardingChecklistTemplates($strSortBy = false, $intPage = false, $numPerPage = false) {
	$sql = 'SELECT OCT.id, OCT.title, OCT.description, GROUP_CONCAT(D.title SEPARATOR ", ") AS department ';
	$sql .= 'FROM ' . self::$tableName . ' OCT ';
	$sql .= 'INNER JOIN onboarding_checklist_templates_mapping OCTM ';
	$sql .= 'ON OCTM.onboarding_checklist_template_id = OCT.id ';
	$sql .= 'INNER JOIN department D ';
	$sql .= 'ON OCTM.department_id = D.id ';
	
	if (isset($_POST['label_filter']) && $_POST['label_filter']) {
	    $sql .= ' WHERE OCT.title LIKE "%' . $_POST['label_filter'] . '%"';
	}
	//on first load, sort data by created_date, after that sort by whatever
	if($_POST == false && !isset($_POST["sort_key"])){
	    $strSortBy = 'OCT.created_date DESC';
	}
	
	if ($_POST != false && $_POST["sort_key"] == false) {
	    $strSortBy = 'OCT.created_date DESC';
	}
	
	$sql .= ' ORDER BY ' . $strSortBy;
	$sql .= ' LIMIT ' . CommonHelper::calculatePagination($intPage, $numPerPage) . ', ' . $numPerPage;

	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll($sql);

	return $arrData;
    }
    
    public function viewSelectedOnboardingChecklistTemplateDetails($filter){
	$sql = 'SELECT OCT.id, OCT.title, OCT.description, GROUP_CONCAT(D.title SEPARATOR ", ") AS department ';
	$sql .= 'FROM ' . self::$tableName . ' OCT ';
	$sql .= 'INNER JOIN onboarding_checklist_templates_mapping OCTM ';
	$sql .= 'ON OCTM.onboarding_checklist_template_id = OCT.id ';
	$sql .= 'INNER JOIN department D ';
	$sql .= 'ON OCTM.department_id = D.id ';
	$sql .= 'WHERE OCT.id = ' . $filter;
	$sql .= 'GROUP BY OCT.id';
	
	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll($sql);
	
	return $arrData;
    }

    public function deleteOnboardingTemplates($deleteOnboardingChecklistIds) {
	foreach ($deleteOnboardingChecklistIds as $deleteOnboardingChecklistId) {
	    $deleteCondition = 'id = ' . $deleteOnboardingChecklistId;
	    OnboardingChecklistTemplate::model()->deleteAll($deleteCondition);
	}
    }

}
