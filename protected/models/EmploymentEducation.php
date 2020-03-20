<?php

/**
  This is the model class for table "employment_education"
 */
class EmploymentEducation extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'employment_education';

    public function tableName() {
	return self::$tableName;
    }

    public function rules() {
	return [
	    ['candidate_id, school_name, start_year, end_year, qualification, grade', 'required'],
	];
    }

    public function attributeLabels() {
	return [
	    'candidate_id' => Yii::t('app', 'candidate_id'),
	    'school_name' => Yii::t('app', 'school_name'),
	    'start_year' => Yii::t('app', 'start_year'),
	    'end_year' => Yii::t('app', 'end_year'),
	    'qualification' => Yii::t('app', 'qualification'),
	    'grade' => Yii::t('app', 'grade'),
	    'status' => Yii::t('app', 'status')
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
