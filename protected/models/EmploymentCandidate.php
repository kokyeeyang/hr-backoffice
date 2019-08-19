<?php

/**
This is the model class for table "employment_candidate"
*/

class EmploymentCandidate extends AppActiveRecord
{
	static $tableName = DB_TBL_PREFIX . 'employment_candidate';

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
			['full_name, id_no, address, contact_no, email_address, date_of_birth, marital_status, gender, nationality, reference_consent', 'required'],
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
			'marital_status' => Yii::t('app', 'marital_status'),
			'gender' => Yii::t('app', 'gender'),
			'nationality' => Yii::t('app', 'nationality'),
			'terminated_before' => Yii::t('app', 'terminated_before'),
			'termination_reason' => Yii::t('app', 'termination_reason'),
			'reference_consent' => Yii::t('app', 'reference_consent'),
			'refuse_reference_reason' => Yii::t('app', 'refuse_reference_reason'),
			'candidate_signature' => Yii::t('app', 'candidate_signature'),
			'candidate_signature_date' => Yii::t('app', 'candidate_signature_date')
		];
	}

	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function deleteSelectedCandidate($candidateIds){
		foreach($candidateIds as $candidateId){
			$candidateCondition = 'id_no = "' . $candidateId . '"';
			$otherCondition = 'candidate_id = "' . $candidateId . '"';

			$fileName = EmploymentCandidate::model()->showPhoto($candidateId);
			EmploymentCandidate::model()->deleteAll($candidateCondition);
			EmploymentEducation::model()->deleteAll($otherCondition);
			EmploymentGeneralQuestion::model()->deleteAll($otherCondition);
			EmploymentJobExperience::model()->deleteAll($otherCondition);
			EmploymentReferee::model()->deleteAll($otherCondition);

			//if production mode, then delete image from s3, if dev then delete from server
			$specificFileName = substr($fileName, 69);
			if($fileName != false){
				if(ENV_MODE == "prod"){	
					$deleteImage = S3Helper::deleteObject(EmploymentCandidate::S3_HRBO_PRODUCTION . $specificFileName);
				} else {
					$deleteImage = unlink(getcwd() . $fileName);
				}
			}
		}
	}

	public function movePhotoToFileSystemOrS3($candidateImageName){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$allowed = array("JPG" => "image/jpg", "JPEG" => "image/jpeg", "GIF" => "image/gif", "PNG" => "image/png", "JPG" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
      $fileType = $_FILES["pic"]["type"];

			if(ENV_MODE == "dev"){
				if(isset($_FILES['pic']) && $_FILES["pic"]["error"] == 0){
	        $fileSize = $_FILES["pic"]["size"];

	        //verify file extension
	        $ext = pathinfo($candidateImageName, PATHINFO_EXTENSION);
	        if(!array_key_exists($ext, $allowed)){ 
	        	die("Error: Please select a valid file format.");
	        }

	        //verify that the file type is allowed
	        if(in_array($fileType, $allowed)){
	        	//check whether file exists before uploading
	        	if(file_exists("candidate/" . $candidateImageName)){
	        		echo $candidateImageName . " already exists.";
	        	} else {
	        		move_uploaded_file($_FILES["pic"]["tmp_name"], getcwd() . "/images/candidate/" . $candidateImageName);
	        	}
	        } else {
	        	echo "Error: There was a problem uploading your file. Please try again."; 
	        }
				} else{
	        echo "Error: " . $_FILES["pic"]["error"];
		    }
		  } else {
		  	$fileTmpName = $_FILES["pic"]["tmp_name"];
		  	$result = S3Helper::putObject(S3_PRODUCTION_FOLDER.'/'.$candidateImageName, $fileTmpName);
		  	$fileObjectUrl = $result->get('ObjectURL');
		  }
		}
	}

	public function showPhoto($candidateId){
		$sql = 'SELECT ' . 'candidate_image ';
		$sql .= 'FROM ' . 'employment_candidate ';
		$sql .= 'WHERE ' . 'id_no = "' . $candidateId . '"';

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow(); 

		if (!empty($arrData['candidate_image'])){
			if(ENV_MODE == "dev"){
				$photoSource = EmploymentCandidate::SERVER_DIRECTORY . $arrData['candidate_image'];
				return $photoSource;
			} else {
				$photoSource = EmploymentCandidate::S3_ADDRESS . $arrData['candidate_image'];
				return $photoSource;
			}	
		} else {
			return false;
		}
	}

	public function showDocument($candidateId, $documentType){
		$sql = 'SELECT ' . $documentType;
		$sql .= ' FROM ' . 'employment_candidate ';
		$sql .= 'WHERE ' . 'id_no = "' . $candidateId . '"';

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow(); 

		if (!empty($arrData[$documentType])){
			if($documentType == "candidate_resume"){
				$documentSource = EmploymentCandidate::DOCUMENT_RESUME_DIRECTORY . $arrData[$documentType];
				return $documentSource;
			} else if ($documentType == "candidate_cover_letter"){
				$documentSource = EmploymentCandidate::DOCUMENT_COVERLETTER_DIRECTORY . $arrData[$documentType];
				return $documentSource;
			}
		}
	}

	public function encryptCandidateId($candidateId){
		$encryptedCandidateId = str_replace('9', $candidateId, JOB_CANDIDATE_ID_SECRET_KEY);
		$base64EncodedCandidateId = base64_encode($encryptedCandidateId);

		return $base64EncodedCandidateId;
	}

	public static function checkForCandidateInformation($candidateName){
		$sql = 'SELECT full_name, id_no, address, contact_no, email_address, date_of_birth, gender, marital_status, nationality ';
		$sql .= 'FROM ' . 'employment_candidate ';
		$sql .= 'WHERE ' . 'full_name = ' . '"' . $candidateName . '"';

		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if (!empty($arrData['full_name'])){
			return $arrData;
		} else {
			return false;
		}
	}

	public function queryForCandidateJobId($candidateName){
		$sql = 'SELECT job_id 
		
						FROM ' . self::$tableName . '

						WHERE full_name = ' . '"' . $candidateName . '"';

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if (!empty($arrData['job_id'])){
			foreach($arrData as $objData){
				return $objData;
			}
		}
	}

	public function queryForCandidateStatus($candidateId){
		$sql = 'SELECT candidate_status

				   	FROM ' . self::$tableName . '

				   	WHERE id_no = ' . '"' . $candidateId . '"';

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();
		// if (!empty($arrData['candidate_status'])){
			foreach($arrData as $objData){
				// var_dump($arrData);
				if($objData == "0"){
					return "Interview stage";
				} else if($objData == "1"){
					return "Confirmed";
				}
			}
		// }

	}	

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

}