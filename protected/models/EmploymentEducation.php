<?php 

/**
This is the model class for table "employment_education"
*/

class EmploymentEducation extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'employment_education';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			['candidate_id, school_name, from, to, qualification, grade', 'required'],
		];
	}

	public function attributeLabels(){
		return [
			'candidate_id' => Yii::t('app', 'candidate_id'),
			'school_name' => Yii::t('app', 'school_name'),
			'from' => Yii::t('app', 'from'),
			'to' => Yii::t('app', 'to'),
			'qualification' => Yii::t('app', 'qualification'),
			'grade' => Yii::t('app', 'grade')
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}