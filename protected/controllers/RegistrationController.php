<?php
// NOTE: FRONTEND
Yii::import('application.vendor.*');
use yii\web\UploadedFile;
require_once ('/var/www/portaldev.sagaos.com/tcpdf.php');
require_once ('/var/www/portaldev.sagaos.com/config/tcpdf_config.php');

class RegistrationController extends Controller
{	
	/**
	 * Declares class-based actions.
	 */
	/*public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}*/

  public function filters()
  {
      return array(
          'accessControl',
      );
  }	
  
	public function accessRules()
  {
		return array(
			array(
				'allow',  // allow all users to perform the RoleHelper's returned actions
				'actions'=>RoleHelper::GetRole(self::$strController, false),
				'users'=>array('*'),
			),
			array(
				'allow', // allow authenticated admin user to perform the RoleHelper's returned actions
				'actions'=>RoleHelper::GetRole(self::$strController, true),
				'users'=>array('@'),
			),
			array(
				'deny',  // deny all other users access
				'users'=>array('*'),
			),
		);
  }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest){
				
				if(Yii::app()->user->isGuest === false){
					echo $error['message'];
				} // - end: if
				Yii::app()->end();
			}
			else{
				$this->render('error', $error);
			}
		}
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		self::forward('registration/addCandidate');
	}

	/**
	 * Add candidate form
	 */
	public function actionAddCandidate()
	{
		// put check job title applied for and token here
		if ($_SERVER['QUERY_STRING'] != ''){
			$queryString = explode('token=', $_SERVER['QUERY_STRING']);
			$token = $queryString[1];
			$tokenPassed = EmploymentLinkToken::model()->verifyToken($token);
			//if manage to find token inside database, then allow user to proceed to registration page
			if($tokenPassed == true ){
				$dateToday = date("Y-m-d");
				$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				$queryString = $_SERVER['QUERY_STRING'];
				$encryptedJobId = substr($link, strpos($link, "=") + 1);
				
				$this->render('candidateForm', array('dateToday' => $dateToday, 'encryptedJobId' => $encryptedJobId, 'queryString' => $queryString));
			} else {
				exit('You have already submitted an application before.');
			}
		} else {
			exit('Link is not valid.');
		}
	}

	public function actionSaveCandidate($queryString)
	{
		//this is for saving candidate details into employment_candidate table
		$encryptedJobId = $this->getParam('encryptedJobId', '');
		$jobIdInSecretKey = base64_decode($encryptedJobId);
		$jobId = substr($jobIdInSecretKey,9,1);
		$sanitizedIdNo = str_replace("-", "", strtoupper($this->getParam('idNo', '')));

		$candidateObjModel = new EmploymentCandidate;
		$candidateObjModel->full_name = strtoupper($this->getParam('fullName', ''));
		$candidateObjModel->id_no = $sanitizedIdNo;
		$candidateObjModel->address = strtoupper($this->getParam('address', ''));
		$candidateObjModel->contact_no = $this->getParam('contactNo', '');
		$candidateObjModel->email_address = $this->getParam('emailAddress', '');
		$candidateObjModel->date_of_birth = $this->getParam('DOB', '');
		$candidateObjModel->marital_status = strtoupper($this->getParam('maritalStatus', ''));

		if($this->getParam('findingMethod', '') == 'others'){
			$candidateObjModel->finding_method = 'OTHERS-' . strtoupper($this->getParam('otherFindingMethod', ''));
		}else if($this->getParam('findingMethod', '') == 'internal-referral'){
			$candidateObjModel->finding_method = 'INTERNAL-REFERRAL-' . strtoupper($this->getParam('referralFindingMethod', ''));
		} else {
			$candidateObjModel->finding_method = strtoupper($this->getParam('findingMethod', ''));
		}

		$candidateObjModel->gender = strtoupper($this->getParam('gender', ''));
		$candidateObjModel->nationality = strtoupper($this->getParam('nationality', ''));
		$candidateObjModel->job_id = $jobId;
		$candidateObjModel->terminated_before = $this->getParam('terminatedBefore', '');
		$candidateObjModel->termination_reason = strtoupper($this->getParam('terminationDetails', ''));
		$candidateObjModel->reference_consent = $this->getParam('consent', '');
		$candidateObjModel->refuse_reference_reason = strtoupper($this->getParam('noReferenceReason', ''));
		$candidateObjModel->candidate_agree_terms = $this->getParam('agreeTerms','');
		$candidateObjModel->candidate_signature_date = $this->getParam('signatureDate','');

		$resumePath = $_FILES["resume"]["name"];
		$coverLetterPath = $_FILES["coverLetter"]["name"];
		//to find out what type of document is this
		$resumeFileType = CommonHelper::getDocumentType($resumePath);
		$coverLetterFileType = CommonHelper::getDocumentType($coverLetterPath);
		$candidateObjModel->candidate_resume = CommonHelper::setFileName($resumePath, $sanitizedIdNo, $resumeFileType, "resume");
		$candidateObjModel->candidate_cover_letter = CommonHelper::setFileName($coverLetterPath, $sanitizedIdNo, $coverLetterFileType, "cover-letter");

		$resumeName = $candidateObjModel->candidate_resume;
		$resumeTmpName = $_FILES["resume"]["tmp_name"];
		$resumeS3Folder = S3_RESUMES_FOLDER;
		//specifies the allowed formats for resumes and cover letters
		$allowedFileExtensions = CommonEnum::DOCUMENT_FILE_EXTENSIONS;

		if($resumePath != false){ 
			$moveResume = CommonHelper::moveDocumentToFileSystemOrS3($resumeName, $resumeTmpName, $resumeS3Folder, $resumeFileType, $allowedFileExtensions, CommonEnum::S3, false);
		}

		$coverLetterName = $candidateObjModel->candidate_cover_letter;
		$coverLetterTmpName = $_FILES["coverLetter"]["tmp_name"];
		$coverLetterS3Folder = S3_COVER_LETTERS_FOLDER;

		if($coverLetterPath != false){
			$moveResume = CommonHelper::moveDocumentToFileSystemOrS3($coverLetterName, $coverLetterTmpName, $coverLetterS3Folder, $coverLetterFileType, $allowedFileExtensions, CommonEnum::S3, false);
		}
		
		$candidateObjModel->save();
		// 

		$schoolNames = $this->getParam('schoolName', '');
		$startYears = $this->getParam('startYear', '');
		$endYears = $this->getParam('endYear', '');
		$qualifications = $this->getParam('qualification', '');
		$grades = $this->getParam('cgpa', '');

		if(empty($schoolNames[0]) === false){
			foreach ($schoolNames as $iKey => $schoolName){
				if ($schoolName != '' && empty($startYears[$iKey]) === false && empty($endYears[$iKey]) === false && empty($qualifications[$iKey]) === false && empty($grades[$iKey]) === false) {
						$educationObjModel = new EmploymentEducation;
						$educationObjModel->candidate_id = $candidateObjModel->id_no;
						$educationObjModel->school_name = strtoupper($schoolName);
						$educationObjModel->start_year = $startYears[$iKey];
						$educationObjModel->end_year = $endYears[$iKey];
						$educationObjModel->qualification = strtoupper($qualifications[$iKey]);
						$educationObjModel->grade = $grades[$iKey];
						$educationObjModel->save();
				}
			}
		}

		// this is for saving candidate job experience into employment_job_experience table
		$companyNames = $this->getParam('companyName','');
		$startDates = $this->getParam('startDate','');
		$endDates = $this->getParam('endDate','');
		$positionsHeld = $this->getParam('positionHeld','');
		$endingSalaries = $this->getParam('endingSalary','');
		$allowances = $this->getParam('allowances','');
		$leaveReasons = $this->getParam('leaveReason','');

		if(empty($companyNames[0]) === false){
			foreach($companyNames as $iKey => $companyName){
				if($companyName != '' && empty($startDates[$iKey]) === false && empty($endDates[$iKey]) === false && empty($positionsHeld[$iKey]) === false && empty($endingSalaries[$iKey]) === false && empty($allowances[$iKey]) === false && empty($leaveReasons[$iKey]) === false){
					$experienceObjModel = new EmploymentJobExperience;
					$experienceObjModel->candidate_id = $candidateObjModel->id_no;
					$experienceObjModel->company_name = strtoupper($companyName);
					$experienceObjModel->start_date = $startDates[$iKey];
					$experienceObjModel->end_date = $endDates[$iKey];
					$experienceObjModel->position_held = strtoupper($positionsHeld[$iKey]);
					$experienceObjModel->ending_salary = $endingSalaries[$iKey];
					$experienceObjModel->allowances = $allowances[$iKey];
					$experienceObjModel->leave_reason = strtoupper($leaveReasons[$iKey]);
					$experienceObjModel->save();
				}
			}
		}

		//
		
		// this is for saving candidate referees into employment_referee table
		$supervisorNames = $this->getParam('superiorName','');
		$supervisorCompanies = $this->getParam('superiorCompany','');
		$supervisorOccupations = $this->getParam('superiorOccupation','');
		$supervisorContacts = $this->getParam('superiorContact','');
		$supervisorEmails = $this->getParam('superiorEmail','');
		$yearsKnownArray = $this->getParam('yearsKnown','');

		if(empty($supervisorNames[0]) === false){
			foreach($supervisorNames as $iKey => $supervisorName){
				if($supervisorName != '' && empty($supervisorCompanies[$iKey]) === false && empty($supervisorOccupations[$iKey]) === false && empty($supervisorOccupations[$iKey]) === false && empty($supervisorContacts[$iKey]) === false && empty($yearsKnownArray[$iKey]) === false){
					$refereeObjModel = new EmploymentReferee;
					$refereeObjModel->candidate_id = $candidateObjModel->id_no;
					$refereeObjModel->supervisor_name = strtoupper($supervisorName);
					$refereeObjModel->supervisor_company = strtoupper($supervisorCompanies[$iKey]);
					$refereeObjModel->supervisor_occupation = strtoupper($supervisorOccupations[$iKey]);
					$refereeObjModel->supervisor_contact = $supervisorContacts[$iKey];
					$refereeObjModel->supervisor_email = $supervisorEmails[$iKey];
					$refereeObjModel->years_known = $yearsKnownArray[$iKey];
					$refereeObjModel->save();
				}
			}
		}
		//

		// this is for saving candidate general questions into employment_general_question table
		$generalQuestionObjModel = new EmploymentGeneralQuestion;
		$generalQuestionObjModel->candidate_id = $candidateObjModel->id_no;
		$generalQuestionObjModel->has_physical_ailment = $this->getParam('illness','');
		$generalQuestionObjModel->ailment_description = $this->getParam('typeOfIllness','');
		$generalQuestionObjModel->has_been_convicted = $this->getParam('criminalOffenseRadio','');
		$generalQuestionObjModel->offense = strtoupper($this->getParam('criminalOffenseInput',''));
		$generalQuestionObjModel->convicted_date = $this->getParam('convictedDate','');
		$generalQuestionObjModel->date_of_discharge = $this->getParam('dischargeDate','');
		$generalQuestionObjModel->has_company_contact = $this->getParam('sagaosRelative','');
		$generalQuestionObjModel->company_contact_name = strtoupper($this->getParam('sagaosContactNameInput',''));
		$generalQuestionObjModel->relationship_with_candidate = strtoupper($this->getParam('sagaosFamilyInput',''));
		$generalQuestionObjModel->has_conflict_of_interest = $this->getParam('interestConflict','');
		$generalQuestionObjModel->has_own_transport = $this->getParam('ownTransport','');
		$generalQuestionObjModel->has_applied_before = $this->getParam('timesApplied','');
		$generalQuestionObjModel->commencement_date = $this->getParam('commencementDate','');
		$generalQuestionObjModel->good_conduct_consent = $this->getParam('goodConductConsent','');
		$generalQuestionObjModel->expected_salary = $this->getParam('expectedSalary','');

		$generalQuestionObjModel->save();
		//

		$interviewQuestionsObjModel = new EmploymentInterviewQuestions;
		$interviewQuestionsObjModel->candidate_id = $sanitizedIdNo;
		$interviewQuestionsObjModel->suitable_experience = null;
		$interviewQuestionsObjModel->aspirations = null;
		$interviewQuestionsObjModel->passion = null;
		$interviewQuestionsObjModel->background = null;
		$interviewQuestionsObjModel->commute = null;
		$interviewQuestionsObjModel->experience = null;
		$interviewQuestionsObjModel->leave_reason = null;
		$interviewQuestionsObjModel->notice_period = null;
		$interviewQuestionsObjModel->interviewing_with_other_companies = null;
		$interviewQuestionsObjModel->family_status = null;
		$interviewQuestionsObjModel->modified_by = null;

		//delete token from database once candidate has submitted application
		$tokenString = explode('token=', $queryString);
		$usedToken = $tokenString[1];
		$deleteToken = EmploymentLinkToken::model()->deleteUsedToken($usedToken);

		$this->render("redirectAfterRegister");
	}

	public function actionShowAllCandidates() {
		$strSortKey	= $this->getParam('sort_key', '');

		$candidateArrRecords = EmploymentCandidate::model()->findAll(array('order'=>'id ASC'));

		$jobTitleArrRecords = EmploymentJobOpening::model()->queryForAllJobs();

		$this->render("showAllCandidates", array('candidateArrRecords' => $candidateArrRecords, 'jobTitleArrRecords' => $jobTitleArrRecords, 'strSortKey' => $strSortKey));
	}

	public function actionAddNewJobOpenings() {
		$objModel = new EmploymentJobOpening;

		$allManagers = Admin::model()->queryForManagers();

		$departmentArr = Department::model()->queryForDepartments(); 

		$this->render("addNewJobOpenings", array('objModel' => $objModel, 'allManagers' => $allManagers, 'departmentArr' => $departmentArr));
	}

	public function actionSaveJobOpenings() {
		$jobTitle = $this->getParam('jobTitle','');

		$jobOpeningObjModel = new EmploymentJobOpening;
		$jobOpeningObjModel->job_title = $this->getParam('jobTitle','');
		$jobOpeningObjModel->department = $this->getParam('departmentDropdown','');
		$jobOpeningObjModel->is_managerial_position = $this->getParam('isManagerialCheckbox', '');
		$jobOpeningObjModel->interviewing_manager = $this->getParam('interviewManager','');

		$jobOpeningObjModel->save();

		if(!$error = $this->objError->getError()){
			if($jobOpeningObjModel->save()){
				$this->redirect(array('showAllJobOpenings'));
			}
		}
	}

	public function actionShowAllJobOpenings() {
		$arrRecords = EmploymentJobOpening::model()->findAll(array('order'=>'id ASC'));
		return $this->render('showAllJobOpenings', array('arrRecords'=>$arrRecords));
	}

	// generates a job application link to send to candidate
	public function actionGenerateLink($jobId){
		$aResult['result'] = false;

		$arrRecords = EmploymentJobOpening::model()->findAll(array('order'=>'id ASC'));
		if(Yii::app()->request->isAjaxRequest){
			$encryptedJobTitleId = str_replace('9', $jobId, JOB_TITLE_ID_SECRET_KEY);
			$base64EncodedJobTitleId = base64_encode($encryptedJobTitleId);
			$aResult['jobIdResult'] = $base64EncodedJobTitleId;

			echo(json_encode($aResult));
		}
			Yii::app()->end();
	}

	public function actionGenerateEmail($jobId, $jobTitle){
		$aResult['result'] = false;
		$jobId = (int)$jobId;
		$arrRecords = EmploymentJobOpening::model()->findAll(array('order'=>'id ASC'));
		$token = EmploymentLinkToken::model()->generateRandomToken();

		if(Yii::app()->request->isAjaxRequest){
			$encryptedJobTitleId = str_replace('9', $jobId, JOB_TITLE_ID_SECRET_KEY);
			$base64EncodedJobTitleId = base64_encode($encryptedJobTitleId);
			$aResult['result'] = $base64EncodedJobTitleId;
			$aResult['jobTitleResult'] = $jobTitle;
			$aResult['token'] = $token;

			echo(json_encode($aResult));
		}
		Yii::app()->end();
	}

	public function actionGenerateOfferEmail($jobId, $candidateName, $candidateId){
		$aResult['candidateName'] = false;
		$managerName = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::INTERVIEWING_MANAGER, EmploymentJobOpeningEnum::ID);
		$jobTitle = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::CANDIDATE_JOB, EmploymentJobOpeningEnum::ID);
		$candidateEmail = EmploymentCandidate::model()->queryForCandidateInformation($candidateName, EmploymentCandidateEnum::EMAIL_ADDRESS, EmploymentCandidateEnum::FULL_NAME);

		$candidateStatus = 7;
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);

		foreach($candidateArrRecords as $candidateObjRecord){
			$candidateObjRecord->candidate_status = $candidateStatus;
			$candidateObjRecord->update();
		}

		if(Yii::app()->request->isAjaxRequest){
			$aResult['candidateName'] = $candidateName;
			$aResult['manager'] = $managerName;
			$aResult['jobTitle'] = $jobTitle;
			$aResult['candidateEmail'] = $candidateEmail;
			
			echo(json_encode($aResult));
		}
		Yii::app()->end();
	}

	public function actionDeleteSelectedJobOpenings(){
		$jobOpeningIds = $this->getParam('deleteCheckBox', '');

		if ($jobOpeningIds != ''){
			$deleteJobOpening = EmploymentJobOpening::model()->deleteSelectedJobOpening($jobOpeningIds);
		}

		$this->redirect(array('showAllJobOpenings'));
	}

	public function actionDeleteSelectedCandidates(){
		$candidateIds = $this->getParam('deleteCheckBox', '');
		if ($candidateIds != ''){
			$deleteCandidates = EmploymentCandidate::model()->deleteSelectedCandidate($candidateIds);
		}

		$this->redirect(array('showAllCandidates'));
	}

	public function actionViewSelectedCandidate($id){
		$candidateId = $id;
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$otherCondition = 'candidate_id = "' . $candidateId . '"';
		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);
		$interviewQuestionsArrRecords = EmploymentInterviewQuestions::model()->findAll($otherCondition);
		$educationArrRecords = EmploymentEducation::model()->findAll($otherCondition);
		$generalQuestionArrRecords = EmploymentGeneralQuestion::model()->findAll($otherCondition);
		$jobExperienceArrRecords = EmploymentJobExperience::model()->findAll($otherCondition);
		$refereeArrRecords = EmploymentReferee::model()->findAll($otherCondition);

		//no longer require candidate to upload image
		// $photoSource = EmploymentCandidate::model()->showPhoto($candidateId);

		$resumeSource = EmploymentCandidate::model()->showDocument($candidateId, "candidate_resume");

		$coverLetterSource = EmploymentCandidate::model()->showDocument($candidateId, "candidate_cover_letter");

		if($resumeSource != false){
			$displayResumeSection = 'inline-grid';
		}	else {
			$displayResumeSection = "none";
		}

		if($coverLetterSource != false){
			$displayCoverLetterSection = 'inline-grid';
		}	else {
			$displayCoverLetterSection = 'none';
		}

		//commented for now because candidate photo is not required
		// if($photoSource != false){
		// 	$displayPhotoSection = 'inline-grid';
		// } else {
		// 	$displayPhotoSection = 'none';
		// }

		$currentAdminId = Yii::app()->user->id;
		//this is to allow editing only for hr and admin
		$access = Admin::model()->checkForAdminPrivilege($currentAdminId, 'registration');
		$this->render('viewCandidateDetails', array('candidateArrRecords'=>$candidateArrRecords, 'educationArrRecords'=>$educationArrRecords, 'generalQuestionArrRecords'=>$generalQuestionArrRecords, 'jobExperienceArrRecords'=>$jobExperienceArrRecords, 'refereeArrRecords'=>$refereeArrRecords, 'interviewQuestionsArrRecords' => $interviewQuestionsArrRecords, 'candidateId' => $candidateId, 'access' => $access, 'displayCoverLetterSection'=>$displayCoverLetterSection, 'resumeSource'=>$resumeSource, 'coverLetterSource'=>$coverLetterSource, 'displayResumeSection'=>$displayResumeSection));
		
	}

	public function actionUpdateSelectedCandidate($candidateId){

		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$otherCondition = 'candidate_id = "' . $candidateId . '"';

		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);
		$educationArrRecords = EmploymentEducation::model()->findAll($otherCondition);
		$jobExperienceArrRecords = EmploymentJobExperience::model()->findAll($otherCondition);
		$refereeArrRecords = EmploymentReferee::model()->findAll($otherCondition);
		$generalQuestionArrRecords = EmploymentGeneralQuestion::model()->findAll($otherCondition);

		$schoolNames = $this->getParam('schoolName', '');
		$startYears = $this->getParam('startYear', '');
		$endYears = $this->getParam('endYear', '');
		$qualifications = $this->getParam('qualification', '');
		$grades = $this->getParam('cgpa', '');
		
		foreach($candidateArrRecords as $candidateObjRecord){
			$candidateObjRecord['full_name'] = $this->getParam('fullName', '');
			$candidateObjRecord['id_no'] = $this->getParam('idNo', '');
			$candidateObjRecord['address'] = $this->getParam('address', '');
			$candidateObjRecord['contact_no'] = $this->getParam('contactNo', '');
			$candidateObjRecord['email_address'] = $this->getParam('emailAddress', '');
			$candidateObjRecord['date_of_birth'] = $this->getParam('DOB', '');
			$candidateObjRecord['marital_status'] = $this->getParam('maritalStatus', '');

			if($this->getParam('findingMethod', '') == 'others'){
				$candidateObjRecord['finding_method'] = 'OTHERS-' . strtoupper($this->getParam('otherFindingMethod', ''));
				$candidateObjRecord->update();
			}else if($this->getParam('findingMethod', '') == 'internal-referral'){
				$candidateObjRecord['finding_method'] = 'INTERNAL-REFERRAL-' . strtoupper($this->getParam('referralFindingMethod', ''));
				$candidateObjRecord->update();
			} else {
				$candidateObjRecord['finding_method'] = strtoupper($this->getParam('findingMethod', ''));
				$candidateObjRecord->update();
			}

			$candidateObjRecord['gender'] = $this->getParam('gender', '');
			$candidateObjRecord['nationality'] = $this->getParam('nationality', '');
			$candidateObjRecord['terminated_before'] = $this->getParam('terminatedBefore', '');
			$candidateObjRecord['termination_reason'] = $this->getParam('terminationDetails', '');
			$candidateObjRecord['reference_consent'] = $this->getParam('consent', '');
			$candidateObjRecord['refuse_reference_reason'] = $this->getParam('noReferenceReason', '');
			$candidateObjRecord['candidate_agree_terms'] = $this->getParam('agreeTerms','');
			$candidateObjRecord['candidate_signature_date'] = $this->getParam('signatureDate','');

			if($this->getParam('comment','') != ''){
				$candidateObjRecord['remarks'] = $this->getParam('comment','');
				$candidateObjRecord->update();
			} 

			$candidateObjRecord->update();

		}

		$schoolNames = $this->getParam('schoolName', '');
		$startYears = $this->getParam('startYear', '');
		$endYears = $this->getParam('endYear', '');
		$qualifications = $this->getParam('qualification', '');
		$grades = $this->getParam('cgpa', '');

		if(empty($schoolNames[0]) === false){
			foreach ($schoolNames as $iKey => $schoolName){
				if ($schoolName != '' && empty($startYears[$iKey]) === false && empty($endYears[$iKey]) === false && empty($qualifications[$iKey]) === false && empty($grades[$iKey]) === false) {
					$educationArrRecords[$iKey]->candidate_id = $this->getParam('idNo', '');
					$educationArrRecords[$iKey]->school_name = $schoolNames[$iKey];
					$educationArrRecords[$iKey]->start_year = $startYears[$iKey];
					$educationArrRecords[$iKey]->end_year = $endYears[$iKey];
					$educationArrRecords[$iKey]->qualification = $qualifications[$iKey];
					$educationArrRecords[$iKey]->grade = $grades[$iKey];
					$educationArrRecords[$iKey]->update();
				}
			}
		}

		$companyNames = $this->getParam('companyName','');
		$startDates = $this->getParam('startDate','');
		$endDates = $this->getParam('endDate','');
		$positionsHeld = $this->getParam('positionHeld','');
		$endingSalaries = $this->getParam('endingSalary','');
		$allowances = $this->getParam('allowances','');
		$leaveReasons = $this->getParam('leaveReason','');

		if(empty($companyNames[0]) === false){
			foreach($companyNames as $iKey => $companyName){
				if($companyName != '' && empty($startDates[$iKey]) === false && empty($endDates[$iKey]) === false && empty($positionsHeld[$iKey]) === false && empty($endingSalaries[$iKey]) === false && empty($allowances[$iKey]) === false && empty($leaveReasons[$iKey]) === false){
					$jobExperienceArrRecords[$iKey]->candidate_id = $this->getParam('idNo', '');
					$jobExperienceArrRecords[$iKey]->company_name = $companyNames[$iKey];
					$jobExperienceArrRecords[$iKey]->start_date = $startDates[$iKey];
					$jobExperienceArrRecords[$iKey]->end_date = $endDates[$iKey];
					$jobExperienceArrRecords[$iKey]->position_held = $positionsHeld[$iKey];
					$jobExperienceArrRecords[$iKey]->ending_salary = $endingSalaries[$iKey];
					$jobExperienceArrRecords[$iKey]->allowances = $allowances[$iKey];
					$jobExperienceArrRecords[$iKey]->leave_reason = $leaveReasons[$iKey];

					$jobExperienceArrRecords[$iKey]->update();
				}
			}
		}

		$supervisorNames = $this->getParam('superiorName','');
		$supervisorCompanies = $this->getParam('superiorCompany','');
		$supervisorOccupations = $this->getParam('superiorOccupation','');
		$supervisorContacts = $this->getParam('superiorContact','');
		$yearsKnownArray = $this->getParam('yearsKnown','');

		if(empty($supervisorNames[0]) === false){
			foreach($supervisorNames as $iKey => $supervisorName){
				if($supervisorName != '' && empty($supervisorCompanies[$iKey]) === false && empty($supervisorOccupations[$iKey]) === false && empty($supervisorOccupations[$iKey]) === false && empty($supervisorContacts[$iKey]) === false && empty($yearsKnownArray[$iKey]) === false){
					$refereeArrRecords[$iKey]->candidate_id = $this->getParam('idNo', '');
					$refereeArrRecords[$iKey]->supervisor_name = $supervisorNames[$iKey];
					$refereeArrRecords[$iKey]->supervisor_company = $supervisorCompanies[$iKey];
					$refereeArrRecords[$iKey]->supervisor_occupation = $supervisorOccupations[$iKey];
					$refereeArrRecords[$iKey]->supervisor_contact = $supervisorContacts[$iKey];
					$refereeArrRecords[$iKey]->years_known = $yearsKnownArray[$iKey];

					$refereeArrRecords[$iKey]->update();
				}
			}
		}

		if($this->getParam('extraSuperiorName1','') != false){
			$refereeObjModel = new EmploymentReferee;
			$refereeObjModel->candidate_id = $this->getParam('idNo', '');
			$refereeObjModel->supervisor_name = strtoupper($this->getParam('extraSuperiorName1',''));
			$refereeObjModel->supervisor_company = strtoupper($this->getParam('extraSuperiorCompany1',''));
			$refereeObjModel->supervisor_occupation = strtoupper($this->getParam('extraSuperiorOccupation1',''));
			$refereeObjModel->supervisor_contact = $this->getParam('extraSuperiorContact1','');
			$refereeObjModel->supervisor_email = $this->getParam('extraSuperiorEmail1','');
			$refereeObjModel->years_known = $this->getParam('extraYearsKnown1','');
			$refereeObjModel->save();

			if($this->getParam('extraSuperiorName2','') != false){
				$refereeObjModel = new EmploymentReferee;
				$refereeObjModel->candidate_id = $this->getParam('idNo', '');
				$refereeObjModel->supervisor_name = strtoupper($this->getParam('extraSuperiorName2',''));
				$refereeObjModel->supervisor_company = strtoupper($this->getParam('extraSuperiorCompany2',''));
				$refereeObjModel->supervisor_occupation = strtoupper($this->getParam('extraSuperiorOccupation2',''));
				$refereeObjModel->supervisor_contact = $this->getParam('extraSuperiorContact2','');
				$refereeObjModel->supervisor_email = $this->getParam('extraSuperiorEmail2','');
				$refereeObjModel->years_known = $this->getParam('extraYearsKnown2','');
				$refereeObjModel->save();
			}
		}

		foreach($generalQuestionArrRecords as $generalQuestionObjRecord){
			$generalQuestionObjRecord->candidate_id = $this->getParam('idNo', '');
			$generalQuestionObjRecord->has_physical_ailment = $this->getParam('illness','');
			$generalQuestionObjRecord->ailment_description = $this->getParam('typeOfIllness','');
			$generalQuestionObjRecord->has_been_convicted = $this->getParam('criminalOffenseRadio','');
			$generalQuestionObjRecord->offense = $this->getParam('criminalOffenseInput','');
			$generalQuestionObjRecord->convicted_date = $this->getParam('convictedDate','');
			$generalQuestionObjRecord->date_of_discharge = $this->getParam('dischargeDate','');
			$generalQuestionObjRecord->has_company_contact = $this->getParam('sagaosRelative','');
			$generalQuestionObjRecord->company_contact_name = $this->getParam('sagaosContactNameInput','');
			$generalQuestionObjRecord->relationship_with_candidate = $this->getParam('sagaosFamilyInput','');
			$generalQuestionObjRecord->has_conflict_of_interest = $this->getParam('interestConflict','');
			$generalQuestionObjRecord->has_own_transport = $this->getParam('ownTransport','');
			$generalQuestionObjRecord->has_applied_before = $this->getParam('timesApplied','');
			$generalQuestionObjRecord->commencement_date = $this->getParam('commencementDate','');
			$generalQuestionObjRecord->good_conduct_consent = $this->getParam('goodConductConsent','');
			$generalQuestionObjRecord->expected_salary = $this->getParam('expectedSalary','');
			$generalQuestionObjRecord->probationary_salary = $this->getParam('offerLetterProbationarySalary','');

			$generalQuestionObjRecord->update();
		}

		$currentUserId = Yii::app()->user->id;

		$interviewQuestionsArrRecords = EmploymentInterviewQuestions::model()->findAll($otherCondition);
		foreach($interviewQuestionsArrRecords as $interviewQuestionsObjRecord){
			$interviewQuestionsObjRecord->candidate_id = $this->getParam('idNo', '');
			$interviewQuestionsObjRecord->suitable_experience = $this->getParam('suitableExperience','');
			$interviewQuestionsObjRecord->aspirations = $this->getParam('aspirations','');
			$interviewQuestionsObjRecord->passion = $this->getParam('passion','');
			$interviewQuestionsObjRecord->background = $this->getParam('background','');
			$interviewQuestionsObjRecord->commute = $this->getParam('commute','');
			$interviewQuestionsObjRecord->experience = $this->getParam('experience','');
			$interviewQuestionsObjRecord->leave_reason = $this->getParam('leaveReason','');
			$interviewQuestionsObjRecord->notice_period = $this->getParam('noticePeriod','');
			$interviewQuestionsObjRecord->interviewing_with_other_companies = $this->getParam('interviewingWithOtherCompanies','');
			$interviewQuestionsObjRecord->family_status = $this->getParam('familyStatus','');
			$interviewQuestionsObjRecord->modified_by = $currentUserId;

			$interviewQuestionsObjRecord->update();
		}

		$this->redirect(array('showAllCandidates'));
	}

	public function actionRedirectAfterRegister(){
		$this->render("redirectAfterRegister");
	}

	/**
	 * This is the 'captcha' action
	 */
	public function actionCaptcha()
	{
		require_once('ydl/captcha/Captcha.php');
		Captcha::genCaptcha();
	}

	public function actionConfirmCandidate($id){
		$candidateStatus = $this->getParam('dropdown','');
		$candidateCondition = 'id_no = "' . $id . '"';
		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);

		foreach($candidateArrRecords as $candidateObjRecord){
			$candidateObjRecord->candidate_status = $candidateStatus;
			$candidateObjRecord->update();
		}

		$trainingOnboardingChecklistCondition = 'candidate_id = "' . $id . '"';
		$duplicateCheck = TrainingOnboardingChecklist::model()->findAll($trainingOnboardingChecklistCondition);


		if ($candidateStatus == "6" && $duplicateCheck == false){
			$onboardingItemIds = TrainingOnboardingItems::model()->obtainItemIds();
			foreach($onboardingItemIds as $iKey => $onboardingItemId){
				$onboardingChecklistObjModel = new TrainingOnboardingChecklist;
				$onboardingChecklistObjModel->onboarding_item_id = implode(" ",$onboardingItemId);
				$onboardingChecklistObjModel->candidate_id = $id;
				$onboardingChecklistObjModel->created_by = Yii::app()->user->id;
				$onboardingChecklistObjModel->save();
			}
		}
				

		$this->redirect(array('showAllCandidates'));
	}

	public function actionChangeCandidateStatus($candidateId){
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);

		foreach($candidateArrRecords as $candidateObjRecord){
			$candidateObjRecord->candidate_status = 7;
			$candidateObjRecord->update();
		}

		$this->redirect(array('showAllCandidates'));
	}

	public function actionChangeCandidateStatusToSigned($candidateId){
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);

		foreach($candidateArrRecords as $candidateObjRecord){
			$candidateObjRecord->candidate_status = 6;
			$candidateObjRecord->update();
		}

		$this->redirect(array('showAllCandidates'));
	}

	public function actionChangeCandidatePosition($candidateId){
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);

		foreach($candidateArrRecords as $candidateObjRecord){
			$candidateObjRecord->job_id = $this->getParam('positionDropdown','');
			$candidateObjRecord->update();
		}

		$this->redirect('showAllCandidates');
	}

	public function actionShowOfferLetterTemplates(){
		// $candidateArrRecords = EmploymentCandidate::model()->findAll(array('order'=>'id ASC'));
		$offerLetterArrRecords = EmploymentOfferLetterTemplates::model()->findAll(['order'=>'id ASC']);
		// var_dump($offerLetterArrRecords);exit;
		$this->render('showOfferLetterTemplates', ['offerLetterArrRecords'=>$offerLetterArrRecords]);
	}

	public function actionCreateNewOfferLetter(){
		
		$dateToday = date("dS F Y");
		$departmentArr = Department::model()->queryForDepartments();

		$currentFunction = Yii::app()->getController()->getAction()->controller->action->id;

		$this->render('createNewOfferLetter', array('dateToday'=>$dateToday, 'departmentArr' => $departmentArr, 'currentFunction'=>$currentFunction));
	}

	public function actionSaveOfferLetterTemplate(){

		$offerLetterTitle = $this->getParam('offerLetterTitle', '') != null ? $this->getParam('offerLetterTitle', '') : "Untitled";
		$offerLetterDescription = $this->getParam('offerLetterDescription', '') != null ? $this->getParam('offerLetterDescription', '') : "Unspecified";

		$currentUserId = Yii::app()->user->id;

		$offerLetterDepartmentArray = $this->getParam('department', '');

		if ($offerLetterDepartmentArray != ''){
			$offerLetterDepartments = implode(",", $offerLetterDepartmentArray);
		} else {
			$offerLetterDepartments = null;
		}

		$offerLetterObjModel = new EmploymentOfferLetterTemplates;
		$offerLetterObjModel->offer_letter_title = $offerLetterTitle;
		$offerLetterObjModel->offer_letter_description = $this->getParam('offerLetterDescription', '');

		$offerLetterObjModel->department = $offerLetterDepartments;

		$offerLetterObjModel->is_managerial = $this->getParam('offerLetterIsManagerial', '');
		$offerLetterObjModel->offer_letter_content = $this->getParam('offerLetterTemplate', '');
		$offerLetterObjModel->created_by = $currentUserId; 
		$offerLetterObjModel->save();

		$this->redirect('showOfferLetterTemplates');
	}

	public function actionViewSelectedOfferLetter($offerLetterId){
		$offerLetterCondition = 'id = "' . $offerLetterId . '"';
		$offerLetterArr = EmploymentOfferLetterTemplates::model()->findAll($offerLetterCondition);
		$departmentArr = Department::model()->queryForDepartments();
		$currentFunction = Yii::app()->getController()->getAction()->controller->action->id;

		$this->render('editOfferLetter', ['offerLetterArr'=>$offerLetterArr, 'currentFunction'=>$currentFunction, 'departmentArr'=>$departmentArr, 'offerLetterId'=>$offerLetterId]);
	}

	public function actionUpdateOfferLetterTemplate($offerLetterId){
		$offerLetterCondition = 'id = "' . $offerLetterId . '"';
		$offerLetterArr = EmploymentOfferLetterTemplates::model()->findAll($offerLetterCondition);

		foreach($offerLetterArr as $offerLetterObj){
			$offerLetterObj->offer_letter_title = $this->getParam('offerLetterTitle','');
			$offerLetterObj->offer_letter_description = $this->getParam('offerLetterDescription','');
			$offerLetterDepartmentArray = $this->getParam('department', '');

			if($offerLetterDepartmentArray == ''){
				$offerLetterObj->department = null;
			}else{
				$offerLetterObj->department = implode(",", $offerLetterDepartmentArray);
			}
			$offerLetterObj->is_managerial = $this->getParam('offerLetterIsManagerial', '');
			$offerLetterObj->offer_letter_content = $this->getParam('offerLetterTemplate','');
			$offerLetterObj->modified_by = Yii::app()->user->id;
			$offerLetterObj->update();
		}
		$this->redirect('showOfferLetterTemplates');
	}

	public function actionDownloadPdf($jobId, $candidateName, $candidateId){
		//to query whether the job candidate is applying for is managerial or not
		$isManagerial = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::IS_MANAGERIAL_POSITION, EmploymentJobOpeningEnum::ID);

		if ($isManagerial == null){
			$isManagerial = "0";
		}

		//to query what department the job belongs to
		// $department = EmploymentJobOpening::model()->queryForCandidateDepartment($jobId);
		$department = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::DEPARTMENT, EmploymentJobOpeningEnum::ID);

		//we do the search and replacing of words here
		//we need candidate id, address, candidate address, candidate position, superior, probationary salary, normal salary and also candidate name

		//pick out the offer letter template based on $isManagerial and $department
		$offerLetterTemplate = EmploymentOfferLetterTemplates::model()->queryForOfferLetterTemplate($isManagerial, $department);

		//this is where we get the photo
		$imgTag = '../../images/offer_letter/';
		$altTag = ' alt=';

		$parsedPhoto = EmploymentOfferLetterTemplates::model()->getStringBetween($offerLetterTemplate["offer_letter_content"], $imgTag, $altTag);

		$parsedPhotoAfterReplace = substr_replace($parsedPhoto, '', -6);

		$photoFormat = substr($parsedPhotoAfterReplace, strrpos($parsedPhotoAfterReplace, '.') + 1);

		$finalOfferLetter = EmploymentOfferLetterTemplates::model()->searchAndReplaceOfferLetterTerms($candidateId, $jobId, $offerLetterTemplate);
		$decodedFinalOfferLetter = htmlspecialchars_decode($finalOfferLetter["offer_letter_content"]);

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    //set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $pdf->setJPEGQuality ( 90 );	

		if(@file_exists(dirname(_FILE_).'/lang.eng.php')){
			require_once(dirname(_FILE_).'/lang.eng.php');
			$pdf->setLanguageArray($l);
		}

		$pdf->SetFont('helvetica', '', 9);
		$pdf->AddPage();

		$horizontal_alignments = array('L');
		$vertical_alignments = array('T');
		//$x = x axis, $y = y-axis, $w = width, $h = height of picture
		$x = 0;
		$y = 18;
		$w = 30;
		$h = 15;

		// test all combinations of alignments
		//$i represents how many images will be printed out horizontally
		for ($i = 0; $i < 1; ++$i) {
		    $fitbox = $horizontal_alignments[$i].' ';
		    $x = 15;
	    	//$j represents how many images will be printed out vertically
		    for ($j = 0; $j < 1; ++$j) {
	        $fitbox[1] = $vertical_alignments[$j];
	        $pdf->Image(OfferLetterEnum::IMAGE_PATH . '/' . $parsedPhotoAfterReplace, $x, $y, $w, $h, $photoFormat, '', '', false, 300, '', false, false, 0, $fitbox, false, false);
	        $x += 32; // new column
		    }
		    $y += 32; // new row
		}

		//insert offer letter template
		$pdf->writeHTML($decodedFinalOfferLetter, true, false, true, false);
		$pdf->lastPage();

		//it is previewing pdf for now to speed up testing, will turn back to 'D' once done
		$pdf->Output($candidateName . ' offerletter.pdf', 'D');

		$this->redirect("showOfferLetterTemplates");
	}

	public function actionCopyOfferLetterTemplate(){
		if(Yii::app()->request->isAjaxRequest){

		} else {
			$this->render('error', $error);
		}
	}

	public function actionUploadOfferLetterImages() {

	  reset ($_FILES);
	  //only one array
	  $uploadedFile = current($_FILES);
	  $publicDestinationFilePath = OfferLetterEnum::IMAGE_PATH;

	  $allowedFileExtensions = CommonEnum::IMAGE_FILE_EXTENSIONS;
	  $fileExtension = CommonHelper::getDocumentType($uploadedFile["name"]);
	  $folderName = getcwd() . '/' . OfferLetterEnum::IMAGE_PATH;
		//perform upload file here
		$uploadFileResponse = CommonHelper::moveDocumentToFileSystemOrS3($uploadedFile["name"], $uploadedFile["tmp_name"], $folderName, $fileExtension, $allowedFileExtensions, CommonEnum::FILE_SYSTEM, false);

	  //check the upload file response if it fail
		if ($uploadFileResponse['result'] == false) {
	  	// Notify editor that the upload failed
	  	CommonHelper::handleErrorOutput($uploadFileResponse);
	  }

	  // Use a location key to specify the path to the saved image resource.
	  // { location : '/your/uploaded/image/file'}
	  echo json_encode(array('location' => '/' . $publicDestinationFilePath.'/'.$uploadedFile["name"]));
	}

	public function actionDeleteSelectedOfferLetters(){
		$offerLetterIds = $this->getParam('deleteCheckBox', '');

		if ($offerLetterIds != ''){
			$deleteJobOpening = EmploymentOfferLetterTemplates::model()->deleteSelectedOfferLetterTemplates($offerLetterIds);
			$this->redirect("showOfferLetterTemplates");
		} else {
			echo "No offer letter template is found with this id";
			$this->redirect("showOfferLetterTemplates");
		}
	}
}	