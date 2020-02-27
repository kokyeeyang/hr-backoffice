<?php

/**
  This is the model class for table "employment_candidate"
 */
class EmploymentCandidate extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'employment_candidate';

    const SERVER_DIRECTORY = "/images/candidate/";

    public function tableName() {
	return self::$tableName;
    }

    public function rules() {
	return [
	    ['full_name, id_no, address, contact_no, email_address, date_of_birth, marital_status, gender, nationality, reference_consent', 'required'],
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
	    'marital_status' => Yii::t('app', 'marital_status'),
	    'gender' => Yii::t('app', 'gender'),
	    'nationality' => Yii::t('app', 'nationality'),
	    'terminated_before' => Yii::t('app', 'terminated_before'),
	    'termination_reason' => Yii::t('app', 'termination_reason'),
	    'reference_consent' => Yii::t('app', 'reference_consent'),
	    'refuse_reference_reason' => Yii::t('app', 'refuse_reference_reason'),
	    'candidate_signature' => Yii::t('app', 'candidate_signature'),
	    'candidate_signature_date' => Yii::t('app', 'candidate_signature_date'),
	    'remarks' => Yii::t('app', 'remarks')
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

    public function deleteSelectedCandidate($candidateIds) {
	foreach ($candidateIds as $candidateId) {
	    $candidateCondition = 'id_no = "' . $candidateId . '"';
	    $otherCondition = 'candidate_id = "' . $candidateId . '"';

	    EmploymentCandidate::model()->deleteAll($candidateCondition);
	    EmploymentEducation::model()->deleteAll($otherCondition);
	    EmploymentGeneralQuestion::model()->deleteAll($otherCondition);
	    EmploymentJobExperience::model()->deleteAll($otherCondition);
	    EmploymentReferee::model()->deleteAll($otherCondition);
	}
    }

    //not used for now because candidate is not required to submit photos
    public function movePhotoToFileSystemOrS3($candidateImageName) {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    $allowed = array("JPG" => "image/jpg", "JPEG" => "image/jpeg", "GIF" => "image/gif", "PNG" => "image/png", "JPG" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	    $fileType = $_FILES["pic"]["type"];

	    if (ENV_MODE == "dev") {
		if (isset($_FILES['pic']) && $_FILES["pic"]["error"] == 0) {
		    $fileSize = $_FILES["pic"]["size"];

		    //verify file extension
		    $ext = pathinfo($candidateImageName, PATHINFO_EXTENSION);
		    if (!array_key_exists($ext, $allowed)) {
			die("Error: Please select a valid file format.");
		    }

		    //verify that the file type is allowed
		    if (in_array($fileType, $allowed)) {
			//check whether file exists before uploading
			if (file_exists("candidate/" . $candidateImageName)) {
			    echo $candidateImageName . " already exists.";
			} else {
			    move_uploaded_file($_FILES["pic"]["tmp_name"], getcwd() . "/images/candidate/" . $candidateImageName);
			}
		    } else {
			echo "Error: There was a problem uploading your file. Please try again.";
		    }
		} else {
		    echo "Error: " . $_FILES["pic"]["error"];
		}
	    } else {
		$fileTmpName = $_FILES["pic"]["tmp_name"];
		$result = S3Helper::putObject(S3_PRODUCTION_FOLDER . '/' . $candidateImageName, $fileTmpName);
		$fileObjectUrl = $result->get('ObjectURL');
	    }
	}
    }

    public function showDocument($candidateId, $documentType) {
	$sql = 'SELECT ' . $documentType;
	$sql .= ' FROM ' . self::$tableName;
	$sql .= ' WHERE ' . 'id_no = "' . $candidateId . '"';

	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryRow();

	if (!empty($arrData[$documentType])) {
	    if ($documentType == "candidate_resume") {
		$documentSource = S3_RESUMES_FOLDER . $arrData[$documentType];
		return $documentSource;
	    } else if ($documentType == "candidate_cover_letter") {
		$documentSource = S3_COVER_LETTERS_FOLDER . $arrData[$documentType];
		return $documentSource;
	    }
	}
    }

    public function encryptCandidateId($candidateId) {
	$encryptedCandidateId = str_replace('9', $candidateId, JOB_CANDIDATE_ID_SECRET_KEY);
	$base64EncodedCandidateId = base64_encode($encryptedCandidateId);

	return $base64EncodedCandidateId;
    }

    public function checkForCandidateInformation($candidateName) {
	$sql = 'SELECT full_name, id_no, address, contact_no, email_address, date_of_birth, gender, marital_status, nationality ';
	$sql .= 'FROM ' . self::$tableName;
	$sql .= ' WHERE ' . 'full_name = ' . '"' . $candidateName . '"';

	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryRow();

	if (!empty($arrData['full_name'])) {
	    return $arrData;
	} else {
	    return false;
	}
    }

    //first param is the condition, second param is the result, and third is the column name to query for
    public function queryForCandidateInformation($queryString, $queryResult, $columnName) {
	$sql = 'SELECT ' . $queryResult;
	$sql .= ' FROM ' . self::$tableName;
	//id_no or full_name
	$sql .= ' WHERE ' . $columnName . ' = "' . $queryString . '"';

	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll();

	if (!empty($arrData)) {
	    foreach ($arrData as $objData) {
		$finalArray[] = $objData[$queryResult];
	    }
	    return $finalArray;
	} else {
	    return false;
	}
    }

    public static function findAllCandidates($strSortBy, $intPage, $numPerPage, $filter = false) {
	$sql = 'SELECT EC.id_no, EC.full_name, EC.created_date, ECS.title AS candidate_status, EC.job_id, EJO.job_title, EJO.department, EJO.interviewing_manager ';
	$sql .= 'FROM employment_candidate EC ';
	$sql .= 'INNER JOIN employment_job_opening EJO ';
	$sql .= 'ON EC.job_id = EJO.id ';
	$sql .= 'INNER JOIN employment_candidate_status ECS ';
	$sql .= 'ON EC.candidate_status = ECS.id';
	if ($filter != false){
	    $sql .= ' WHERE ' . $filter;
	}
	$sql .= ' ORDER BY ' . $strSortBy;
	$sql .= ' LIMIT ' . CommonHelper::calculatePagination($intPage, $numPerPage) . ', ' . $numPerPage;
	
	
	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll($sql);

	return $arrData;
    }

}
