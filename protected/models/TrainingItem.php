<?php

/**
  This is the model class for table "training_onboarding_items"
 */
class TrainingItem extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'training_item';

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
	    'responsibility' => Yii::t('app', 'responsibility'),
	    'status' => Yii::t('app', 'status'),
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

    public function selectAllTrainingItems($strSortBy, $intPage, $numPerPage) {
	$sql = 'SELECT TI.title, TI.description, A.admin_display_name AS responsibility, TI.created_date, TI.modified_date,';
	$sql .= ' CASE WHEN TI.status = 1';
	$sql .= ' THEN "Active" ';
	$sql .= ' WHEN TI.status = 0';
	$sql .= ' THEN "Inactive"';
	$sql .= ' END AS status';
	$sql .= ' FROM ' . self::$tableName . ' TI';
	$sql .= ' INNER JOIN admin A';
	$sql .= ' ON TI.responsibility = A.admin_id';
	
	if ($_POST == false && !isset($_POST["sort_key"])) {
	    $strSortBy = 'TI.created_date DESC';
	}

	if ($_POST != false && $_POST["sort_key"] == false) {
	    $strSortBy = 'TI.created_date DESC';
	}

	$sql .= ' ORDER BY ' . $strSortBy;
	$sql .= ' LIMIT ' . CommonHelper::calculatePagination($intPage, $numPerPage) . ', ' . $numPerPage;
	
	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll();

	if (!empty($arrData)) {
	    return $arrData;
	} else {
	    return false;
	}
    }

}