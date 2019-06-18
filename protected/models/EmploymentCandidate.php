<?php

/**
This is the model class for table "employment_candidate"
*/

class EmploymentCandidate extends AppActiveRecord
{
	static $tableName = DB_TBL_PREFIX . 'employment_candidate';

	const S3_ADDRESS = "https://hrbo-prd.s3-ap-southeast-1.amazonaws.com/hrbo-prd/production/";

	const SERVER_DIRECTORY = "/images/candidate/";

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
			'candidate_signature_date' => Yii::t('app', 'candidate_signature_date'),
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
			if($fileName != false){
				if(ENV_MODE == "dev"){	
					$deleteImage = S3Helper::deleteObject(S3_PRODUCTION_FOLDER.'/'.$fileName['candidate_image']);
				} else {
					$deleteImage = unlink(getcwd() . EmploymentCandidate::SERVER_DIRECTORY . $fileName['candidate_image']);
				}
			}
		}
	}

	public function movePhotoToFileSystem(){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$allowed = array("JPG" => "image/jpg", "JPEG" => "image/jpeg", "GIF" => "image/gif", "PNG" => "image/png", "JPG" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			$fileName = $_FILES["pic"]["name"];
      $fileType = $_FILES["pic"]["type"];

			if(ENV_MODE == "prod"){
				if(isset($_FILES['pic']) && $_FILES["pic"]["error"] == 0){
	        $fileSize = $_FILES["pic"]["size"];

	        //verify file extension
	        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
	        if(!array_key_exists($ext, $allowed)){ 
	        	die("Error: Please select a valid file format.");
	        }

	        //verify that the file type is allowed
	        if(in_array($fileType, $allowed)){
	        	//check whether file exists before uploading
	        	if(file_exists("candidate/" . $fileName)){
	        		echo $fileName . " already exists.";
	        	} else {
	        		move_uploaded_file($_FILES["pic"]["tmp_name"], getcwd() . "/images/candidate/" . $fileName);
	        	}
	        } else {
	        	echo "Error: There was a problem uploading your file. Please try again."; 
	        }
				} else{
	        echo "Error: " . $_FILES["pic"]["error"];
		    }
		  } else {
		  	$fileTmpName = $_FILES["pic"]["tmp_name"];
		  	$result = S3Helper::putObject(S3_PRODUCTION_FOLDER.'/'.$fileName, $fileTmpName);
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
				if(ENV_MODE == "prod"){
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

	public function encryptCandidateId($candidateId){
		$encryptedCandidateId = str_replace('9', $candidateId, JOB_CANDIDATE_ID_SECRET_KEY);
		$base64EncodedCandidateId = base64_encode($encryptedCandidateId);

		return $base64EncodedCandidateId;
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

}