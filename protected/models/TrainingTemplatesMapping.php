<?php

/**
  This is the model class for table "training_templates_mapping"
 */
class TrainingTemplatesMapping extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'training_templates_mapping';

    public function tableName() {
	return self::$tableName;
    }

    public function rules() {
	return [
	];
    }

    public function attributeLabels() {
	return [
	    'department_id' => Yii::t('app', 'department_id'),
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
    
    public function queryForTrainingTemplateDepartments($trainingTemplateId){
	$sql = 'SELECT TTM.id, D.title ';
	$sql .= 'FROM training_templates_mapping TTM ';
	$sql .= 'INNER JOIN department D ';
	$sql .= 'ON TTM.department_id = D.id ';
	$sql .= 'WHERE training_template_id = ' . $trainingTemplateId;
	
	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll($sql);

	if ($arrData != '') {
	    return $arrData;
	} else {
	    return 'No data is found';
	}
    }
    
    public function deleteTrainingTemplateMappings($deleteTrainingTemplateIds){
	foreach($deleteTrainingTemplateIds as $deleteTrainingTemplateId){
	    $condition = 'training_template_id = ' . $deleteTrainingTemplateId;
	    TrainingTemplatesMapping::model()->deleteAll($condition);
	}
    }

}
