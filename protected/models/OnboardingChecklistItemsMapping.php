<?php

/**
  This is the model class for table "onboarding_checklist_items_mapping"
 */
class OnboardingChecklistItemsMapping extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_items_mapping';

    public function tableName() {
	return self::$tableName;
    }

    public function rules() {
	return [
	];
    }

    public function attributeLabels() {
	return [
	    'checklist_item_id' => Yii::t('app', 'checklist_item_id'),
	    'checklist_template_id' => Yii::t('app', 'checklist_template_id')
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

    public function deleteOnboardingItemsMapping($deleteOnboardingChecklistIds) {
	foreach ($deleteOnboardingChecklistIds as $deleteOnboardingChecklistId) {
	    $deleteCondition = 'checklist_template_id = ' . $deleteOnboardingChecklistId;
	    OnboardingChecklistItemsMapping::model()->deleteAll($deleteOnboardingChecklistId);
	}
    }

    //checking whether onboarding checklist contains this item or not 
    public function queryForOnboardingTemplateInformation($queryString, $queryResult, $columnName) {
	$sql = 'SELECT ' . $queryResult;
	$sql .= ' FROM ' . self::$tableName;
	$sql .= ' WHERE ' . $columnName . ' = "' . $queryString . '"';

	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll($sql);

	if (!empty($arrData)) {
	    return $arrData[$queryResult];
	} else {
	    return false;
	}
    }

}
