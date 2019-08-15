<?php 

class EmploymentNewHire extends AppActiveRecord
{
	static $tableName = DB_TBL_PREFIX . 'employment_new_hire';

	const S3_ADDRESS = "https://hrbo-prd.s3-ap-southeast-1.amazonaws.com/hrbo-prd/production/";

	const S3_HRBO_PRODUCTION = "hrbo-prd/production/";

	const SERVER_DIRECTORY = "/images/candidate/";

	const DOCUMENT_RESUME_DIRECTORY = "/documents/resume/";

	const DOCUMENT_COVERLETTER_DIRECTORY = "/documents/coverLetter/";

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			['full_name, id_no, address, contact_no, email_address, date_of_birth, gender, job_title, marital_status, nationality', 'required'],
		];
	}

	public function attributeLabels(){
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
			'nationality' => Yii::t('app', 'nationality')
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public static function checkForCandidateInformation(){
		$candidateName = intval($_GET['query']);

		$sql = 'SELECT ' . 'full_name, id_no, address, contact_no, email_address, date_of_birth, gender, marital_status, nationality ';
		$sql .= 'FROM ' . 'employment_candidate';
		$sql .= 'WHERE ' . 'full_name = ' . '"' . $candidateName . '"';
		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if (!empty($arrData['full_name, id_no, address, contact_no, email_address, date_of_birth, gender, job_title, marital_status, nationality'])){
			echo "<table>
			<tr>
			<th>Full name</th>
			<th>ID No</th>
			<th>Address</th>
			<th>Contact No</th>
			<th>Email address</th>
			<th>Date of birth</th>
			<th>Gender</th>
			<th>Job title</th>
			<th>Marital status</th>
			<th>Nationality</th>
			";
			while ($row = $arrData){
				echo "<tr>";
				echo "<td>" . $row['full_name'] . "</td>";
			}
			echo "</table>";
		} else {
			return 'no data found';
		}
	}
}