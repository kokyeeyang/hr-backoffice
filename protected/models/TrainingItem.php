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
	$sql = 'SELECT TI.id, TI.title, TI.description, A.admin_display_name AS responsibility, TI.created_date, TI.modified_date,';
	$sql .= ' CASE WHEN TI.status = 1';
	$sql .= ' THEN "Active" ';
	$sql .= ' WHEN TI.status = 0';
	$sql .= ' THEN "Inactive"';
	$sql .= ' END AS status';
	$sql .= ' FROM ' . self::$tableName . ' TI';
	$sql .= ' INNER JOIN admin A';
	$sql .= ' ON TI.responsibility = A.admin_id';

	if (isset($_POST['label_filter']) && $_POST['label_filter'] != false) {
	    $sql .= ' WHERE TI.title LIKE "%' . $_POST['label_filter'] . '%"';
	}

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

    public function deleteTrainingItems($deleteTrainingItemIds) {
	foreach ($deleteTrainingItemIds as $deleteTrainingItemId) {
	    $condition = 'id = ' . $deleteTrainingItemId;
	    $deleteItem = TrainingItem::model()->deleteAll($condition);

	    if ($deleteItem == null) {
		echo 'Please delete this item from the training template first';
	    }
	}
    }

    public function queryForTrainingItemTitles() {
	$sql = 'SELECT id, title FROM ' . self::$tableName;
	$sql .= ' WHERE status = 1';

	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll();

	if (!empty($arrData)) {
	    return $arrData;
	} else {
	    return false;
	}
    }

    //used in both view selected training item and also when finding training items that belongs to a particular template
    public function findTrainingItemDetails($condition, $innerJoin) {
	$sql = 'SELECT TI.id, TI.title, TI.description, A.admin_display_name AS responsibility,';
	$sql .= ' CASE WHEN TI.status = 1';
	$sql .= ' THEN "Active" ';
	$sql .= ' WHEN TI.status = 0';
	$sql .= ' THEN "Inactive"';
	$sql .= ' END AS status';
	$sql .= ' FROM ' . self::$tableName . ' TI';
	$sql .= ' INNER JOIN admin A';
	$sql .= ' ON TI.responsibility = A.admin_id';

	if ($innerJoin != false) {
	    $sql .= ' INNER JOIN training_items_mapping TIM';
	    $sql .= ' ON TI.id = TIM.training_item_id ';
	}

	$sql .= ' WHERE ' . $condition;
	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll();

	if (!empty($arrData)) {
	    return $arrData;
	} else {
	    return false;
	}
    }
    
    public function findTrainingItems($departmentId) {
	$sql = 'SELECT TI.title AS "item_title", TIM.id, TI.is_managerial, TIM.checklist_template_id, TT.title, TTM.department_id ';
        $sql .= 'FROM ' . self::$tableName . ' TI ';
	$sql .= 'INNER JOIN training_items_mapping TIM ON TI.id = TIM.training_item_id ';
	$sql .= 'INNER JOIN training_template TT ON TIM.training_template_id = TT.id ';
	$sql .= 'INNER JOIN training_templates_mapping TTM ON TT.id = TTM.training_template_id ';
	$sql .= 'WHERE TTM.department_id = ' . $departmentId;
        
        $objConnection = Yii::app()->db;
        $objCommand = $objConnection->createCommand($sql);
        $arrData = $objCommand->queryAll($sql);

        if (!empty($arrData)) {
            return $arrData;
        } else {
            return false;
        }
    }

}
