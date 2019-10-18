<?php 

class EmploymentOfferLetterTemplates extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'employment_offer_letter_templates';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'offer_letter_title' => Yii::t('app', 'offer_letter_title'),
			'offer_letter_description' => Yii::t('app', 'offer_letter_description'),
			'offer_letter_content' => Yii::t('app', 'offer_letter_content'),
			'department' => Yii::t('app', 'department'),
			'is_managerial' => Yii::t('app', 'is_managerial'),
			'offer_letter_content' => Yii::t('app', 'offer_letter_content'),
			'created_date' => Yii::t('app', 'created_date'),
			'created_by' => Yii::t('app', 'created_by'),
			'modified_date' => Yii::t('app', 'modified_date'),
			'modified_by' => Yii::t('app', 'modified_by')
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

	public function queryForOfferLetterIsManagerial($templateId){
		$sql = 'SELECT is_managerial 

						FROM ' . self::$tableName .

						' WHERE id=' . $templateId;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if ($arrData['is_managerial'] == "0"){
			return 'Non manager role';
		} else if ($arrData['is_managerial'] == "1"){
			return 'Managerial role';
		}

	}

	public function queryForOfferLetterTemplate($isManagerial,$department){

		$sql = 'SELECT offer_letter_content 

						FROM ' . self::$tableName .

						' WHERE is_managerial=' . $isManagerial . 

						' AND department LIKE "%' . $department . '%"';

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		// if ($arrData['offer_letter_content'] != ''){
			return $arrData;
		// } 
		// else {
		// 	echo OfferLetterEnum::OFFER_LETTER_NOT_FOUND_WARNING;
		// }
	}

	public function searchAndReplaceOfferLetterTerms($candidateId, $jobId, $sanitizedOfferLetterTemplate){
		//query for the candidate's information inside database

		$candidateAddress = EmploymentCandidate::model()->queryForCandidateInformation($candidateId, EmploymentCandidateEnum::ADDRESS, EmploymentCandidateEnum::ID_NO);
		$candidateName = EmploymentCandidate::model()->queryForCandidateInformation($candidateId,EmploymentCandidateEnum::FULL_NAME, EmploymentCandidateEnum::ID_NO);
		$salaryArr = EmploymentGeneralQuestion::model()->queryForSalary($candidateId);

		//the terms to be inserted into the offer letter template
		$regularSalary = $salaryArr['expected_salary'];
		$probationarySalary = $salaryArr['probationary_salary'];
		$candidatePosition = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::CANDIDATE_JOB, EmploymentJobOpeningEnum::ID);
		$candidateSuperior = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::INTERVIEWING_MANAGER, EmploymentJobOpeningEnum::ID);
		$isManagerial = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::IS_MANAGERIAL_POSITION, EmploymentJobOpeningEnum::ID);
		$department = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::DEPARTMENT, EmploymentJobOpeningEnum::ID);

		//now look for the offer letter template
		$offerLetterTemplate = EmploymentOfferLetterTemplates::model()->queryForOfferLetterTemplate($isManagerial, $department);

		//assign terms into an array
		$offerLetterTerms = [$candidateName, $candidateAddress, $candidateId, $regularSalary, $probationarySalary, $candidatePosition, $candidateSuperior];
		$termsToBeReplaced = [OfferLetterEnum::CANDIDATE_NAME, OfferLetterEnum::CANDIDATE_ADDRESS, OfferLetterEnum::CANDIDATE_ID, OfferLetterEnum::REGULAR_SALARY, OfferLetterEnum::PROBATIONARY_SALARY, OfferLetterEnum::CANDIDATE_POSITION, OfferLetterEnum::CANDIDATE_SUPERIOR];
		//replace terms in offer letter(case-insensitive)
		$finalOfferLetter = str_ireplace($termsToBeReplaced, $offerLetterTerms, $offerLetterTemplate);

		return $finalOfferLetter;		
	}

	public function deleteSelectedOfferLetterTemplates($offerLetterTemplateIds){
		foreach($offerLetterTemplateIds as $offerLetterTemplateId){
			$condition = 'id = ' . $offerLetterTemplateId;
			EmploymentOfferLetterTemplates::model()->deleteAll($condition);
		}
	}

	public function getStringBetween($string, $start, $end){
		$string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
	}
}
