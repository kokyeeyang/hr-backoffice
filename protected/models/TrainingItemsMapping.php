<?php

/**
  This is the model class for table "training_items_mapping"
 */
class TrainingTemplateMapping extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'training_items_mapping';

    public function tableName() {
	return self::$tableName;
    }

    public function rules() {
	return [
	];
    }

    public function attributeLabels() {
	return [
	    'training_item_id' => Yii::t('app', 'training_item_id'),
	    'training_template_id' => Yii::t('app', 'training_template_id')
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

}
