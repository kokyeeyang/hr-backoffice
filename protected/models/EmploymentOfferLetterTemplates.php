<?php

class EmploymentOfferLetterTemplates extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'employment_offer_letter_templates';

    public function tableName() {
	return self::$tableName;
    }

    public function rules() {
	return [
	];
    }

    public function attributeLabels() {
	return [
	    'offer_letter_title' => Yii::t('app', 'offer_letter_title'),
	    'offer_letter_description' => Yii::t('app', 'offer_letter_description'),
	    'offer_letter_content' => Yii::t('app', 'offer_letter_content'),
	    'is_managerial' => Yii::t('app', 'is_managerial'),
	    'offer_letter_content' => Yii::t('app', 'offer_letter_content'),
	    'status' => Yii::t('app', 'status'),
	    'created_date' => Yii::t('app', 'created_date'),
	    'created_by' => Yii::t('app', 'created_by'),
	    'modified_date' => Yii::t('app', 'modified_date'),
	    'modified_by' => Yii::t('app', 'modified_by'),
	];
    }

    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return [
	    'id' => [self::HAS_MANY, 'employment_offer_letter_templates_mapping', 'id']
	];
    }

    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    public function queryForOfferLetterTemplate($isManagerial, $department) {
	$sql = 'SELECT EOLT.offer_letter_content, D.title AS department ';
	$sql .= 'FROM ' . self::$tableName . ' EOLT ';
	$sql .= 'INNER JOIN employment_offer_letter_templates_mapping EOLTM ';
	$sql .= 'ON EOLT.id = EOLTM.offer_letter_template_id ';
	$sql .= 'INNER JOIN department D ';
	$sql .= 'ON D.id = EOLTM.department_id ';
	$sql .= 'WHERE EOLT.is_managerial = ' . $isManagerial;
	$sql .= ' AND EOLTM.department_id = ' . $department;

	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryRow();

	return $arrData;
    }

    public function searchAndReplaceOfferLetterTerms($candidateId, $jobId, $sanitizedOfferLetterTemplate) {
	//query for the candidate's information inside database

	$candidateAddress = EmploymentCandidate::model()->queryForCandidateInformation($candidateId, EmploymentCandidateEnum::ADDRESS, EmploymentCandidateEnum::ID_NO);
	$candidateName = EmploymentCandidate::model()->queryForCandidateInformation($candidateId, EmploymentCandidateEnum::FULL_NAME, EmploymentCandidateEnum::ID_NO);
	$salaryArr = EmploymentGeneralQuestion::model()->queryForSalary($candidateId);

	//the terms to be inserted into the offer letter template
	$regularSalary = $salaryArr['expected_salary'];
	$probationarySalary = $salaryArr['probationary_salary'];
	$candidatePosition = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::CANDIDATE_JOB, EmploymentJobOpeningEnum::ID);
	$candidateSuperior = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::INTERVIEWING_MANAGER, EmploymentJobOpeningEnum::ID);
	$isManagerial = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::IS_MANAGERIAL_POSITION, EmploymentJobOpeningEnum::ID);
	$department = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::DEPARTMENT, EmploymentJobOpeningEnum::ID);

	//now look for the offer letter template (array)
	$offerLetterTemplate = EmploymentOfferLetterTemplates::model()->queryForOfferLetterTemplate($isManagerial, $department);

	//assign terms into an array
	$offerLetterTerms = [$candidateName[0], $candidateAddress[0], $candidateId[0], $regularSalary, $probationarySalary, $candidatePosition, $candidateSuperior];
	$termsToBeReplaced = [OfferLetterEnum::CANDIDATE_NAME, OfferLetterEnum::CANDIDATE_ADDRESS, OfferLetterEnum::CANDIDATE_ID, OfferLetterEnum::REGULAR_SALARY, OfferLetterEnum::PROBATIONARY_SALARY, OfferLetterEnum::CANDIDATE_POSITION, OfferLetterEnum::CANDIDATE_SUPERIOR];
	//replace terms in offer letter(case-insensitive)
	$finalOfferLetter = str_ireplace($termsToBeReplaced, $offerLetterTerms, $offerLetterTemplate['offer_letter_content']);
	
	return $finalOfferLetter;
    }

    public function deleteSelectedOfferLetterTemplates($offerLetterTemplateIds) {
	foreach ($offerLetterTemplateIds as $offerLetterTemplateId) {
	    $condition = 'id = ' . $offerLetterTemplateId;
	    EmploymentOfferLetterTemplates::model()->deleteAll($condition);
	}
    }

    public function getStringBetween($string, $start, $end) {
	$string = ' ' . $string;
	$ini = strpos($string, $start);
	if ($ini == 0)
	    return '';
	$ini += strlen($start);
	$len = strpos($string, $end, $ini) - $ini;
	return substr($string, $ini, $len);
    }

    public function findAllOfferLetters($strSortBy = false, $intPage = false, $numPerPage = false, $condition = false, $filter = false) {
	$sql = 'SELECT EOLT.id, EOLT.offer_letter_title, EOLT.offer_letter_description, EOLT.offer_letter_content, GROUP_CONCAT(D.title SEPARATOR ", ") AS department_title, ';
	$sql .= 'CASE WHEN is_managerial = 0 THEN "Non-Managerial" ';
	$sql .= 'WHEN is_managerial = 1 ';
	$sql .= 'THEN "Managerial" ';
	$sql .= 'END AS "is_managerial" ';
	$sql .= 'FROM employment_offer_letter_templates EOLT ';
	$sql .= 'INNER JOIN employment_offer_letter_templates_mapping EOLTM ';
	$sql .= 'ON EOLTM.offer_letter_template_id = EOLT.id ';
	$sql .= 'INNER JOIN department D ';
	$sql .= 'ON EOLTM.department_id = D.id';
	
	if ($filter != false) {
	    $sql .= ' WHERE ' . $filter . ' AND EOLT.status = 1';
	} else if ($filter == false) {
	    $sql .= ' WHERE EOLT.status = 1';
	}

	if ($condition != false) {
	    $sql .= ' GROUP BY EOLT.id';

	    //on first load, sort records by created date, after that free to sort by whatever
	    if ($_POST == false && !isset($_POST["sort_key"])) {
		$strSortBy = 'EOLT.created_date DESC';
	    }

	    if ($_POST != false && $_POST["sort_key"] == false) {
		$strSortBy = 'EOLT.created_date DESC';
	    }

	    $sql .= ' ORDER BY ' . $strSortBy;
	    $sql .= ' LIMIT ' . CommonHelper::calculatePagination($intPage, $numPerPage) . ', ' . $numPerPage;
	}


	$objConnection = Yii::app()->db;
	$objCommand = $objConnection->createCommand($sql);
	$arrData = $objCommand->queryAll($sql);

	return $arrData;
    }

}
