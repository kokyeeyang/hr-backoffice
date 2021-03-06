<?php

class EmploymentNewHire extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'employment_new_hire';

    const S3_ADDRESS = "https://hrbo-prd.s3-ap-southeast-1.amazonaws.com/hrbo-prd/production/";
    const S3_HRBO_PRODUCTION = "hrbo-prd/production/";
    const SERVER_DIRECTORY = "/images/candidate/";
    const DOCUMENT_RESUME_DIRECTORY = "/documents/resume/";
    const DOCUMENT_COVERLETTER_DIRECTORY = "/documents/coverLetter/";

    public function tableName() {
	return self::$tableName;
    }

    public function rules() {
	return [
	    ['full_name, id_no, address, contact_no, email_address, date_of_birth, gender, job_title, marital_status, nationality', 'required'],
	];
    }

    public function attributeLabels() {
	return [
	    'full_name' => Yii::t('app', 'full_name'),
	    'id_no' => Yii::t('app', 'id_no'),
	    'address' => Yii::t('app', 'address'),
	    'contact_no' => Yii::t('app', 'contact_no'),
	    'email_address' => Yii::t('app', 'email_address'),
	    'date_of_birth' => Yii::t('app', 'date_of_birth'),
	    'gender' => Yii::t('app', 'gender'),
	    'job_title' => Yii::t('app', 'job_title'),
	    'marital_status' => Yii::t('app', 'marital_status'),
	    'nationality' => Yii::t('app', 'nationality'),
	    'status' => Yii::t('app', 'status')
	];
    }

    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TblUser the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

}
