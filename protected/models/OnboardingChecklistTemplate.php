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
	$sql = 'SELECT id, title, description ';
	$sql .= 'FROM ' . self::$tableName;
	
	if (isset($_POST['label_filter']) && $_POST['label_filter']) {
	    $sql .= ' WHERE title LIKE "%' . $_POST['label_filter'] . '%"';
	}
	
	$sql .= ' ORDER BY ' . $strSortBy;
	$sql .= ' LIMIT ' . CommonHelper::calculatePagination($intPage, $numPerPage) . ', ' . $numPerPage;

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
