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
		$token = $this->getParam('token', '', '', 'get');
		$encryptedJobId = $this->getParam('JT', '', '', 'get');
		if (isset($_GET['JT']) && isset($_GET['token'])){
			$tokenPassed = EmploymentLinkToken::model()->verifyToken($token);
			//if manage to find token inside database, then allow user to proceed to registration page
			if($tokenPassed == true){
				$dateToday = date("Y-m-d");
				$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				$queryString = $_SERVER['QUERY_STRING'];

				$this->render('candidateForm', array('dateToday' => $dateToday, 'encryptedJobId' => $encryptedJobId, 'token' => $token));
			} else {
				exit('You have already submitted an application before.');
			}
		} else {
			exit('Link is not valid.');
		}
	}

	public function actionSaveCandidate($token)
	{
		//this is for saving candidate details into employment_candidate table
		$encryptedJobId = $this->getParam('encryptedJobId', '');
		$decryptedIdRaw = base64_decode($encryptedJobId);
		$jobId = str_replace(JOB_TITLE_ID_SECRET_KEY, "", $decryptedIdRaw);
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

		//TODO:: 
		$interviewQuestionsObjModel = new EmploymentInterviewQuestions;
		$interviewQuestionsObjModel->candidate_id = $sanitizedIdNo;
		// $interviewQuestionsObjModel->suitable_experience = null;
		// $interviewQuestionsObjModel->aspirations = null;
		// $interviewQuestionsObjModel->passion = null;
		// $interviewQuestionsObjModel->background = null;
		// $interviewQuestionsObjModel->commute = null;
		// $interviewQuestionsObjModel->experience = null;
		// $interviewQuestionsObjModel->leave_reason = null;
		// $interviewQuestionsObjModel->notice_period = null;
		// $interviewQuestionsObjModel->interviewing_with_other_companies = null;
		// $interviewQuestionsObjModel->family_status = null;
		// $interviewQuestionsObjModel->modified_by = null;
		//TODO::

		//delete token from database once candidate has submitted application
		$token = $this->getParam('token', '', '', 'get');
		$deleteToken = EmploymentLinkToken::model()->deleteUsedToken($token);

		$this->render("redirectAfterRegister");
	}

	public function actionShowAllCandidates() {
		$strSortKey	= $this->getParam('sort_key', '');

		// $candidateArrRecords = EmploymentCandidate::model()->findAll(array('order'=>'id ASC'));

		$jobTitleArrRecords = EmploymentJobOpening::model()->queryForAllJobs();

		$objPagination = $this->getStrSortByList($strSortKey, EmploymentCandidateEnum::CANDIDATE_TABLE, EmploymentCandidateEnum::CANDIDATE_TABLE_IN_SQL, CommonEnum::RETURN_PAGINATION);
		$candidateArrRecord = $this->getStrSortByList($strSortKey, EmploymentCandidateEnum::CANDIDATE_TABLE, EmploymentCandidateEnum::CANDIDATE_TABLE_IN_SQL, CommonEnum::RETURN_TABLE_ARRAY_BY_SQL);

		$candidateStatusArrRecord = EmploymentCandidateStatus::model()->queryForCandidateStatus();

		if(isset($_POST['ajax']) && $_POST['ajax']==='candidate-list' && Yii::app()->request->isAjaxRequest){
			$aResult = [];
			$aResult['result'] 	= 0;
			$aResult['content'] = '';
			$aResult['msg'] 	= '';

			// if click on sorting, then it will be ajax, thus we returnpartial here
			$aResult['content'] = $this->renderPartial("showAllCandidates", array('strSortKey'=>$strSortKey, 'objPagination'=>$objPagination, 'candidateStatusArrRecord' => $candidateStatusArrRecord, 'candidateArrRecord' => $candidateArrRecord, 'jobTitleArrRecords' => $jobTitleArrRecords), true);

			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			}
			echo(json_encode($aResult));
			Yii::app()->end();
		} //-end: if

		// we return whole page here
		$this->render("showAllCandidates", array('candidateArrRecord' => $candidateArrRecord, 'jobTitleArrRecords' => $jobTitleArrRecords, 'objPagination'=>$objPagination, 'candidateStatusArrRecord' => $candidateStatusArrRecord, 'strSortKey' => $strSortKey));
	}

	public function actionAddNewJobOpenings() {
		$objModel = new EmploymentJobOpening;

		$allManagers = Admin::model()->queryForManagers();
		$departmentTitle = DepartmentEnum::DEPARTMENT_TITLE;
		$departmentArr = Department::model()->queryForDepartmentDetails($departmentTitle); 

		$this->render("jobOpeningDetails", array('objModel' => $objModel, 'allManagers' => $allManagers, 'departmentArr' => $departmentArr));
	}

	public function actionSaveJobOpenings() {
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
		$strSortKey = $this->getParam('sort_key','');
		$pageType = EmploymentJobOpeningEnum::JOB_OPENING;

		$objPagination = $this->getStrSortByList($strSortKey, EmploymentJobOpeningEnum::JOB_OPENING_TABLE, false,  CommonEnum::RETURN_PAGINATION);
		$objCriteria = $this->getStrSortByList($strSortKey, EmploymentJobOpeningEnum::JOB_OPENING_TABLE, false, CommonEnum::RETURN_CRITERIA);
		$arrRecords = $this->getStrSortByList($strSortKey, EmploymentJobOpeningEnum::JOB_OPENING_TABLE, false, CommonEnum::RETURN_TABLE_ARRAY);

		if(isset($_POST['ajax']) && $_POST['ajax']==='jobopening-list' && Yii::app()->request->isAjaxRequest){
			$aResult = [];
			$aResult['result'] 	= 0;
			$aResult['content'] = '';
			$aResult['msg'] 	= '';

			$aResult['content'] = $this->renderPartial('showAllJobOpenings', ['strSortKey'=>$strSortKey, 'arrRecords'=>$arrRecords, 'objPagination'=>$objPagination, 'pageType'=>$pageType], true);

			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			}
			echo(json_encode($aResult));
			Yii::app()->end();		
		}

		$this->render('showAllJobOpenings', ['strSortKey'=>$strSortKey, 'arrRecords'=>$arrRecords, 'objPagination'=>$objPagination, 'pageType'=>$pageType]);
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

	public function actionGenerateEmail(){
		$aResult['result'] = false;
		$id = (int)$this->getParam('id', '', '', 'get');
		$jobTitle = $this->getParam('job_title', '');
		$token = EmploymentLinkToken::model()->generateRandomToken();

		if(Yii::app()->request->isAjaxRequest){
			$base64EncodedJobTitleId = base64_encode($id . JOB_TITLE_ID_SECRET_KEY);
			$aResult['result'] = $base64EncodedJobTitleId;
			$aResult['jobTitleResult'] = $jobTitle;
			$aResult['token'] = $token;

			echo(json_encode($aResult));
		}
		Yii::app()->end();
	}

	public function actionGenerateOfferEmail($jobId, $candidateName, $candidateId){
		$aResult['candidateName'] = false;
		$jobId = $this->getParam('jobId', '', '', 'get');
		$candidateName = $this->getParam('candidateName', '', '', 'get');
		$candidateId = $this->getParam('candidateId', '', '', 'get');
		$managerName = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::INTERVIEWING_MANAGER, EmploymentJobOpeningEnum::ID);
		$jobTitle = EmploymentJobOpening::model()->queryForCandidateInformation($jobId, EmploymentJobOpeningEnum::CANDIDATE_JOB, EmploymentJobOpeningEnum::ID);
		$candidateEmail = EmploymentCandidate::model()->queryForCandidateInformation($candidateName, EmploymentCandidateEnum::EMAIL_ADDRESS, EmploymentCandidateEnum::FULL_NAME);
		$candidateStatus = 7;
		$candidateCondition = 'id_no = "' . $candidateId . '"';

		EmploymentCandidate::model()->updateAll(['candidate_status' => $candidateStatus], $candidateCondition);

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

	public function actionViewSelectedCandidate($candidateId){
		$candidateId = $this->getParam('candidateId', '', '', 'get');
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$otherCondition = 'candidate_id = "' . $candidateId . '"';
		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);

		if ($candidateArrRecords == null){
			throw new CHttpException(404,'Candidate does not exist with the requested id.');
		}

		$interviewQuestionsArrRecords = EmploymentInterviewQuestions::model()->findAll($otherCondition);
		$educationArrRecords = EmploymentEducation::model()->findAll($otherCondition);
		$jobExperienceArrRecords = EmploymentJobExperience::model()->findAll($otherCondition);
		$refereeArrRecords = EmploymentReferee::model()->findAll($otherCondition);
		$generalQuestionArrRecords = EmploymentGeneralQuestion::model()->findAll($otherCondition);

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

		$currentAdminId = Yii::app()->user->id;
		//this is to allow editing only for hr and admin
		$access = Admin::model()->checkForAdminPrivilege($currentAdminId, 'registration');
		$this->render('viewCandidateDetails', array('candidateArrRecords'=>$candidateArrRecords, 'educationArrRecords'=>$educationArrRecords, 'generalQuestionArrRecords'=>$generalQuestionArrRecords, 'jobExperienceArrRecords'=>$jobExperienceArrRecords, 'refereeArrRecords'=>$refereeArrRecords, 'interviewQuestionsArrRecords' => $interviewQuestionsArrRecords, 'candidateId' => $candidateId, 'access' => $access, 'displayCoverLetterSection'=>$displayCoverLetterSection, 'resumeSource'=>$resumeSource, 'coverLetterSource'=>$coverLetterSource, 'displayResumeSection'=>$displayResumeSection));
		
	}

	public function actionUpdateSelectedCandidate($candidateId){
		$candidateId = $this->getParam('candidateId', '', '', 'get');
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$otherCondition = 'candidate_id = "' . $candidateId . '"';

		// $candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);
		$educationArrRecords = EmploymentEducation::model()->findAll($otherCondition);
		$jobExperienceArrRecords = EmploymentJobExperience::model()->findAll($otherCondition);
		$refereeArrRecords = EmploymentReferee::model()->findAll($otherCondition);
		$generalQuestionArrRecords = EmploymentGeneralQuestion::model()->findAll($otherCondition);

		// Updating of employment_candidate table START
		if($this->getParam('findingMethod', '') == 'others'){
			$findingMethod = 'OTHERS-' . strtoupper($this->getParam('otherFindingMethod', ''));
		}else if($this->getParam('findingMethod', '') == 'internal-referral'){
			$findingMethod = 'INTERNAL-REFERRAL-' . strtoupper($this->getParam('referralFindingMethod', ''));
		} else {
			$findingMethod = strtoupper($this->getParam('findingMethod', ''));
		}

		if($this->getParam('comment','') != ''){
			$candidateRemarks = $this->getParam('comment','');
		} else {
			$candidateRemarks = null;
		}

		EmploymentCandidate::model()->updateAll([
			'full_name'=>$this->getParam('fullName', ''), 
			'id_no'=>$this->getParam('idNo', ''), 'address'=>$this->getParam('address', ''), 
			'contact_no'=>$this->getParam('contactNo', ''), 'email_address'=>$this->getParam('emailAddress', ''), 
			'date_of_birth'=>$this->getParam('DOB', ''), 'marital_status'=>$this->getParam('maritalStatus', ''), 
			'finding_method'=>$findingMethod, 'gender'=>$this->getParam('gender', ''),
			'nationality'=>$this->getParam('nationality', ''),'terminated_before'=>$this->getParam('terminatedBefore', ''),
			'termination_reason'=>$this->getParam('terminationDetails', ''),'reference_consent'=>$this->getParam('consent', ''),
			'refuse_reference_reason'=>$this->getParam('noReferenceReason', ''),'candidate_agree_terms'=>$this->getParam('agreeTerms',''),
			'candidate_signature_date'=>$this->getParam('signatureDate',''),'remarks'=>$candidateRemarks
		], $candidateCondition);
		//Updating of employment_candidate table END

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

		// if need to add more referees, then insert new record into employment_referee table
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

		//Updating of employment_general_question table START
		EmploymentGeneralQuestion::model()->updateAll([
			'candidate_id'=>$this->getParam('idNo', ''), 'has_physical_ailment'=>$this->getParam('illness',''),
			'ailment_description'=>$this->getParam('typeOfIllness',''), 'has_been_convicted'=>$this->getParam('criminalOffenseRadio',''),
			'offense'=>$this->getParam('criminalOffenseInput',''), 'convicted_date'=>$this->getParam('convictedDate',''),
			'date_of_discharge'=>$this->getParam('dischargeDate',''), 'has_company_contact'=>$this->getParam('sagaosRelative',''),
			'company_contact_name'=>$this->getParam('sagaosContactNameInput',''), 'relationship_with_candidate'=>$this->getParam('sagaosFamilyInput',''),
			'has_conflict_of_interest'=>$this->getParam('interestConflict',''), 'has_own_transport'=>$this->getParam('ownTransport',''),
			'has_applied_before'=>$this->getParam('timesApplied',''), 'commencement_date'=>$this->getParam('commencementDate',''),
			'good_conduct_consent'=>$this->getParam('goodConductConsent',''), 'expected_salary'=>$this->getParam('expectedSalary',''),
			'probationary_salary'=>$this->getParam('offerLetterProbationarySalary','')
		], $otherCondition);
		//Updating of employment_general_question table END

		// Updating of employment_interview_questions table START
		$currentUserId = Yii::app()->user->id;

		EmploymentInterviewQuestions::model()->updateAll([
			'candidate_id'=>$this->getParam('idNo', ''),'suitable_experience'=>$this->getParam('suitableExperience',''),
			'aspirations'=>$this->getParam('aspirations',''),'passion'=>$this->getParam('passion',''),
			'background'=>$this->getParam('background',''),'commute'=>$this->getParam('commute',''),
			'experience'=>$this->getParam('experience',''),'leave_reason'=>$this->getParam('leaveReason',''),
			'notice_period'=>$this->getParam('noticePeriod',''),'interviewing_with_other_companies'=>$this->getParam('interviewingWithOtherCompanies',''),
			'family_status'=>$this->getParam('familyStatus',''),'modified_by'=>$currentUserId 
		], $otherCondition);
		// Updating of employment_interview_questions table END

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

	public function actionConfirmCandidate($candidateId){
		$candidateId = $this->getParam('candidateId', '', '', 'get');
		$candidateStatus = $this->getParam('dropdown','');
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);

		EmploymentCandidate::model()->updateAll(['candidate_status' => $candidateStatus], $candidateCondition);

		$trainingOnboardingChecklistCondition = 'candidate_id = "' . $candidateId . '"';
		$duplicateCheck = TrainingOnboardingChecklist::model()->findAll($trainingOnboardingChecklistCondition);

		// TODO: Still needs further work to generate onboarding checklist
		// if ($candidateStatus == "6" && $duplicateCheck == false){
		// 	$onboardingItemIds = TrainingOnboardingItems::model()->obtainItemIds();
		// 	foreach($onboardingItemIds as $iKey => $onboardingItemId){
		// 		$onboardingChecklistObjModel = new TrainingOnboardingChecklist;
		// 		$onboardingChecklistObjModel->onboarding_item_id = implode(" ",$onboardingItemId);
		// 		$onboardingChecklistObjModel->candidate_id = $candidateId;
		// 		$onboardingChecklistObjModel->created_by = Yii::app()->user->id;
		// 		$onboardingChecklistObjModel->save();
		// 	}
		// }
				

		$this->redirect(array('showAllCandidates'));
	}

	// TODO: change function name because this is confusing
	public function actionChangeCandidateStatus($candidateId){
		$candidateCondition = 'id_no = "' . $candidateId . '"';

		EmploymentCandidate::model()->updateAll(['candidate_status'=>7], $candidateCondition);

		$this->redirect(array('showAllCandidates'));
	}

	public function actionChangeCandidateStatusToSigned($candidateId){
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		EmploymentCandidate::model()->updateAll(['candidate_status'=>6], $candidateCondition);

		$this->redirect(array('showAllCandidates'));
	}

	public function actionChangeCandidatePosition($candidateId){
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$job_id = $this->getParam('positionDropdown','');

		EmploymentCandidate::model()->updateAll(['job_id'=>$job_id], $candidateCondition);

		$this->redirect(['showAllCandidates']);
	}

	public function actionShowOfferLetterTemplates(){
		$pageType = OfferLetterEnum::OFFER_LETTER;
		$strSortKey = $this->getParam('sort_key', '');

		$objPagination = $this->getStrSortByList($strSortKey, OfferLetterEnum::OFFER_LETTER_TABLE, OfferLetterEnum::OFFER_LETTER_TABLE_IN_SQL, CommonEnum::RETURN_PAGINATION);
		$objCriteria = $this->getStrSortByList($strSortKey, OfferLetterEnum::OFFER_LETTER_TABLE, OfferLetterEnum::OFFER_LETTER_TABLE_IN_SQL, CommonEnum::RETURN_CRITERIA);
		$offerLetterArr = $this->getStrSortByList($strSortKey, OfferLetterEnum::OFFER_LETTER_TABLE, OfferLetterEnum::OFFER_LETTER_TABLE_IN_SQL, CommonEnum::RETURN_TABLE_ARRAY_BY_SQL);

		if(isset($_POST['ajax']) && $_POST['ajax']==='offerletter-list' && Yii::app()->request->isAjaxRequest){
			$aResult = [];
			$aResult['result'] 	= 0;
			$aResult['content'] = '';
			$aResult['msg'] 	= '';

			// if click on sorting, then it will be ajax, thus we returnpartial here	
			$aResult['content'] = $this->renderPartial('showAllOfferLetterTemplates', ['strSortKey'=>$strSortKey,'offerLetterArr'=>$offerLetterArr, 'objPagination'=>$objPagination, 'pageType'=>$pageType], true);

			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			}

			echo(json_encode($aResult));
			Yii::app()->end();		
		} // - end: if

		// we return whole page here
		$this->render('showAllOfferLetterTemplates', ['offerLetterArr'=>$offerLetterArr, 'pageType'=>$pageType, 'strSortKey'=>$strSortKey, 'objPagination'=>$objPagination]);
	}

	public function actionAddNewOfferLetter(){
		
		$dateToday = date("dS F Y");
		$header = Yii::t('app', 'Add New Offer Letter Template');
		$departmentTitle = DepartmentEnum::DEPARTMENT_TITLE;
		$departmentId = 'id';
		$departmentCondition = $departmentTitle . ',' . $departmentId;
		// $departmentArr = Department::model()->queryForDepartmentDetails($departmentTitle);
		$departmentArr = Department::model()->queryForDepartmentDetails($departmentCondition);

		$currentFunction = Yii::app()->getController()->getAction()->controller->action->id;

		$offerLetterTitle = ""; 
		$offerLetterDescription = "";
		$offerLetterContent = "";
		$offerLetterDepartment = "";
		$offerLetterIsManagerial = "";

		$this->render('offerLetterDetails', array('dateToday'=>$dateToday, 'departmentArr' => $departmentArr, 'currentFunction'=>$currentFunction, 'offerLetterTitle'=>$offerLetterTitle, 'offerLetterDescription'=>$offerLetterDescription, 'offerLetterContent'=>$offerLetterContent, 'offerLetterDepartment'=>$offerLetterDepartment, 'offerLetterIsManagerial'=>$offerLetterIsManagerial, 'header'=>$header));
	}

	public function actionSaveOfferLetterTemplate(){

		$offerLetterTitle = $this->getParam('offerLetterTitle', '') != null ? $this->getParam('offerLetterTitle', '') : "Untitled";
		$offerLetterDescription = $this->getParam('offerLetterDescription', '') != null ? $this->getParam('offerLetterDescription', '') : "Unspecified";

		$currentUserId = Yii::app()->user->id;

		$offerLetterDepartmentArray = $this->getParam('department', '');

		//don't need this anymore, just foreach the $offerLetterDepartmentArray and save new rows of employmentofferlettertemplatemapping
		// if ($offerLetterDepartmentArray != ''){
		// 	$offerLetterDepartments = implode(",", $offerLetterDepartmentArray);
		// } else {
		// 	$offerLetterDepartments = null;
		// }

		$offerLetterObjModel = new EmploymentOfferLetterTemplates;

		// TODO: add the new employmentofferlettertemplatemapping object here
		//foreach the $offerLetterDepartmentArray and save new rows of employmentofferlettertemplatemapping here
		$offerLetterObjModel->offer_letter_title = $offerLetterTitle;
		$offerLetterObjModel->offer_letter_description = $this->getParam('offerLetterDescription', '');

		// $offerLetterObjModel->department = $offerLetterDepartments;

		$offerLetterObjModel->is_managerial = $this->getParam('offerLetterIsManagerial', '');
		$offerLetterObjModel->offer_letter_content = $this->getParam('offerLetterTemplate', '');
		$offerLetterObjModel->created_by = $currentUserId; 
		$offerLetterObjModel->save();

		foreach ($offerLetterDepartmentArray as $offerLetterDepartmentObj){
			$offerLetterMappingObjModel = new EmploymentOfferLetterTemplatesMapping;
			$offerLetterMappingObjModel->offer_letter_template_id = $offerLetterObjModel->id;
			$offerLetterMappingObjModel->department_id = $offerLetterDepartmentObj;
			$offerLetterMappingObjModel->save();
		}

		$this->redirect('showOfferLetterTemplates');
	}

	public function actionViewSelectedOfferLetter(){
		$id = $this->getParam('id', '', '', 'get');
		$offerLetterCondition = 'EOLT.id = ' . $id;
		$header = Yii::t('app', 'Edit offer letter template');
		$departmentTitle = DepartmentEnum::DEPARTMENT_TITLE;
		$departmentId = DepartmentEnum::DEPARTMENT_ID;
		$queryResults = $departmentTitle . ', ' . $departmentId;

		$departmentArr = Department::model()->queryForDepartmentDetails($queryResults);

		$currentFunction = Yii::app()->getController()->getAction()->controller->action->id;

		if(isset($_GET['id']) && $id != null){
			// $offerLetterArr = EmploymentOfferLetterTemplates::model()->findAll($offerLetterCondition);
			$offerLetterArr = EmploymentOfferLetterTemplates::model()->findAllOfferLetters(false, false, false, $offerLetterCondition);

			if($offerLetterArr == null){
				throw new CHttpException(404,'Offer letter template does not exist with the requested id.');
			}

			if (count($offerLetterArr) > 0) {
			  $offerLetterObj = $offerLetterArr[0];
			} 

			$offerLetterTitle = $offerLetterObj['offer_letter_title'];
			$offerLetterDescription = $offerLetterObj['offer_letter_description'];
			$offerLetterContent = $offerLetterObj['offer_letter_content'];
			$offerLetterDepartment = $offerLetterObj['department_title'];

			$offerLetterIsManagerial = $offerLetterObj['is_managerial'];

			$this->render('offerLetterDetails', ['offerLetterObj'=>$offerLetterObj, 'offerLetterTitle'=>$offerLetterTitle, 'offerLetterDescription'=>$offerLetterDescription, 'offerLetterContent'=>$offerLetterContent, 'offerLetterDepartment'=>$offerLetterDepartment, 'offerLetterIsManagerial'=>$offerLetterIsManagerial, 'departmentArr'=>$departmentArr, 'id'=>$id,'header'=>$header]);

		} else if (!isset($_GET['id']) && $id == null){
			// if offer letter id is not present, then it would be copying the offer letter template
			$offerLetterTitle = $this->getParam('offerLetterTitle', ''); 
			$offerLetterDescription = $this->getParam('offerLetterDescription', '');
			$offerLetterContent = $this->getParam('offerLetterTemplate','');
			$offerLetterDepartment = implode(",", $this->getParam('department', ''));
			$offerLetterIsManagerial = $this->getParam('offerLetterIsManagerial', '');

			$this->render('offerLetterDetails', ['offerLetterTitle'=>$offerLetterTitle, 'offerLetterDescription'=>$offerLetterDescription, 'offerLetterContent'=>$offerLetterContent, 'offerLetterDepartment'=>$offerLetterDepartment, 'offerLetterIsManagerial'=>$offerLetterIsManagerial, 'departmentArr'=>$departmentArr, 'header'=>$header]);
		} else {
			throw new CHttpException(404,'The requested page does not exist.');
		}
	}

	public function actionUpdateOfferLetterTemplate($id){

		$offerLetterCondition = 'id = "' . $id . '"';
		$id = $this->getParam('id', '', '', 'get');
		$offerLetterDepartmentArray = $this->getParam('department', '');

		$departmentArrayInsideDatabase = EmploymentOfferLetterTemplatesMapping::model()->findDepartmentById($id);

		foreach($departmentArrayInsideDatabase as $departmentObjectInsideDatabase){
			$result = array_diff($offerLetterDepartmentArray, $departmentObjectInsideDatabase);
		}

		//if department choices from UI differs from record inside database, then delete and create new records inside the offer letter mapping table again
		if($result != null){
		  $columnName = OfferLetterMappingEnum::OFFER_LETTER_ID;
		  $condition = $columnName .  ' = ' . $id;
		  EmploymentOfferLetterTemplatesMapping::model()->deleteAll($condition);

			foreach($offerLetterDepartmentArray as $offerLetterDepartmentObj){
				$offerLetterMappingObjModel = new EmploymentOfferLetterTemplatesMapping;
				$offerLetterMappingObjModel->offer_letter_template_id = $id;
				$offerLetterMappingObjModel->department_id = $offerLetterDepartmentObj;
				$offerLetterMappingObjModel->save();
			}

		}

		EmploymentOfferLetterTemplates::model()->updateAll(
			['offer_letter_title' => $this->getParam('offerLetterTitle',''), 'offer_letter_description'  => $this->getParam('offerLetterDescription',''), 'is_managerial' => $this->getParam('offerLetterIsManagerial', ''),'modified_by' => Yii::app()->user->id], $offerLetterCondition);

		$this->redirect(['showOfferLetterTemplates']);
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

		if ($offerLetterTemplate == ''){
			echo OfferLetterEnum::OFFER_LETTER_NOT_FOUND_WARNING;
		}

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

		//this is where we get the photo
		$imgTag = '../../images/offer_letter/';
		$altTag = ' alt=';

		$parsedPhoto = EmploymentOfferLetterTemplates::model()->getStringBetween($offerLetterTemplate["offer_letter_content"], $imgTag, $altTag);

		$parsedPhotoAfterReplace = substr_replace($parsedPhoto, '', -6);

		$photoFormat = substr($parsedPhotoAfterReplace, strrpos($parsedPhotoAfterReplace, '.') + 1);

		//this is where we first start inserting images
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
			EmploymentOfferLetterTemplatesMapping::model()->deleteMappingItem(OfferLetterMappingEnum::OFFER_LETTER_ID, $offerLetterIds);
			EmploymentOfferLetterTemplates::model()->deleteSelectedOfferLetterTemplates($offerLetterIds);
			$this->redirect("showOfferLetterTemplates");
		} else {
			echo "No offer letter template is found with this id";
			$this->redirect("showOfferLetterTemplates");
		}
	}

	private function getStrSortByList($strSortKey, $tableName, $tableNameInSql=false, $pageVar){

		$strSortBy = self::getStrSortBy($strSortKey, $tableName);

		$objCriteria		= new CDbCriteria();
		$objCriteria->order = $strSortBy;

		$intCount 		= $tableName::model()->count($objCriteria);
		$objPagination	= new CPagination($intCount);
		$objPagination->setPageSize(Yii::app()->params['numPerPage']);
		$objPagination->setCurrentPage($this->intPage);
		$objPagination->applyLimit($objCriteria);

		$intPage = $this->intPage;

		switch($pageVar){
			case CommonEnum::RETURN_PAGINATION:
				return $objPagination;
			break;

			case CommonEnum::RETURN_CRITERIA:
				return $objCriteria;
			break;

			case CommonEnum::RETURN_TABLE_ARRAY_BY_SQL:
				switch($tableNameInSql){
					case OfferLetterEnum::OFFER_LETTER_TABLE_IN_SQL:
						$numPerPage = Yii::app()->params['numPerPage'];
						$tableArr = EmploymentOfferLetterTemplates::model()->findAllOfferLetters($strSortBy, $intPage, $numPerPage, false);
						return $tableArr;
					break;

					case EmploymentCandidateEnum::CANDIDATE_TABLE_IN_SQL:
						$numPerPage = Yii::app()->params['numPerPage'];
						$tableArr = EmploymentCandidate::model()->findAllCandidates($strSortBy, $intPage, $numPerPage);
						return $tableArr;
					break;
				}

			break;

			case CommonEnum::RETURN_TABLE_ARRAY:
				$tableArr = $tableName::model()->findAll($objCriteria);
				return $tableArr;
			break;	
		}	
	}

	private static function getStrSortBy($strSortKey, $tableName){
		switch($tableName){
			case OfferLetterEnum::OFFER_LETTER_TABLE :
				$strSortBy = self::getOfferLetterList($strSortKey);
				return $strSortBy;
			break;

			case EmploymentJobOpeningEnum::JOB_OPENING_TABLE :
				$strSortBy = self::getJobOpeningList($strSortKey);
				return $strSortBy;
			break;

			case EmploymentCandidateEnum::CANDIDATE_TABLE :
				$strSortBy = self::getCandidateList($strSortKey);
				return $strSortBy;
			break;

			case EmploymentCandidateStatusEnum::CANDIDATE_STATUS_TABLE :
				$strSortBy = self::getCandidateStatusList($strSortKey);
				return $strSortBy;
			break;
		}
	}

	private static function getOfferLetterList($strSortKey){
		switch($strSortKey){
			case 'sort_offer_letter_title_desc':
			default:
				$strSortKey = 'sort_offer_letter_title_desc';
				return 'offer_letter_title DESC';
			break;

			case 'sort_offer_letter_title_asc':
				return 'offer_letter_title ASC';
			break;

			case 'sort_department_desc':
				return 'department DESC';
			break;

			case 'sort_department_asc':
				return 'department ASC';
			break;

			case 'sort_is_managerial_desc':
				return 'is_managerial DESC';
			break;

			case 'sort_is_managerial_asc':
				return 'is_managerial ASC';
			break;
		}		
	}

	private static function getJobOpeningList($strSortKey){
		switch($strSortKey){
			case 'sort_job_title_desc':
			default:
				$strSortKey = 'sort_job_title_desc';
				return 'job_title DESC';
			break;

			case 'sort_job_title_asc':
				return 'job_title ASC';
			break;

			case 'sort_department_desc':
				return 'department DESC';
			break;

			case 'sort_department_asc':
				return 'department ASC';
			break;

			case 'sort_interviewing_manager_desc':
				return 'interviewing_manager DESC';
			break;

			case 'sort_interviewing_manager_asc':
				return 'interviewing_manager ASC';
			break;

			case 'sort_created_date_desc':
				return 'created_date DESC';
			break;

			case 'sort_created_date_asc':
				return 'created_date ASC';
			break;
		}
	}

	public function actionCheckCandidateJobOpeningExist($id){
		$aResult['result'] = false;

		if(Yii::app()->request->isAjaxRequest){
			$queryString = $id;
			$queryResult = EmploymentCandidateEnum::FULL_NAME;
			$columnName = EmploymentCandidateEnum::JOB_ID;
			//to confirm whether there are any candidates applied under this job opening
			$candidateName = EmploymentCandidate::model()->queryForCandidateInformation($queryString, $queryResult, $columnName);
			$aResult['result'] = $candidateName;
		}
		echo(json_encode($aResult));
		Yii::app()->end();
	}

	private static function getCandidateList($strSortKey){
		switch($strSortKey){
			case 'sort_full_name_desc':
			default:
				$strSortKey = 'sort_full_name_desc';
				return 'full_name DESC';
			break;

			case 'sort_full_name_asc':
				return 'full_name ASC';
			break;

			case 'sort_created_date desc':
				return 'created_date DESC';
			break;

			case 'sort_created_date asc':
				return 'created_date ASC';
			break;
		}
	}

	public function actionShowAllCandidateStatus(){
		$arrRecords = EmploymentCandidateStatus::model()->findAll(array('order'=>'id ASC'));
		$strSortKey = $this->getParam('sort_key','');
		$pageType = EmploymentCandidateStatusEnum::CANDIDATE_STATUS;

		$objPagination = $this->getStrSortByList($strSortKey, EmploymentCandidateStatusEnum::CANDIDATE_STATUS_TABLE, false,  CommonEnum::RETURN_PAGINATION);
		$objCriteria = $this->getStrSortByList($strSortKey, EmploymentCandidateStatusEnum::CANDIDATE_STATUS_TABLE, false, CommonEnum::RETURN_CRITERIA);
		$arrRecords = $this->getStrSortByList($strSortKey, EmploymentCandidateStatusEnum::CANDIDATE_STATUS_TABLE, false, CommonEnum::RETURN_TABLE_ARRAY);

		if(isset($_POST['ajax']) && $_POST['ajax']==='jobopening-list' && Yii::app()->request->isAjaxRequest){
			$aResult = [];
			$aResult['result'] 	= 0;
			$aResult['content'] = '';
			$aResult['msg'] 	= '';

			$aResult['content'] = $this->renderPartial('showAllCandidateStatus', ['strSortKey'=>$strSortKey, 'arrRecords'=>$arrRecords, 'objPagination'=>$objPagination, 'pageType'=>$pageType], true);

			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			}
			echo(json_encode($aResult));
			Yii::app()->end();				
		}

		$this->render('showAllCandidateStatus', ['strSortKey'=>$strSortKey, 'arrRecords'=>$arrRecords, 'objPagination'=>$objPagination, 'pageType'=>$pageType]);

	}

	private static function getCandidateStatusList($strSortKey){
		switch($strSortKey){
			case 'sort_title_desc':
			default:
				$strSortKey = 'sort_title_desc';
				return 'title DESC';
			break;

			case 'sort_title_asc':
				$strSortKey = 'sort_title_asc';
				return 'title ASC';
			break;
		}
	}

	public function actionAddNewCandidateStatus(){
		$formAction = $this->createUrl('registration/saveCandidateStatus');
		$header = EmploymentCandidateStatusEnum::ADD_CANDIDATE_STATUS;
		$buttonTitle = CommonEnum::SAVE_BUTTON;
		$candidateStatusTitle = '';

		$this->render('candidateStatusDetails', array('formAction' => $formAction, 'header' => $header, 'buttonTitle' => $buttonTitle, 'candidateStatusTitle' => $candidateStatusTitle));
	}

	public function actionDeleteCandidateStatus(){
		$deleteCandidateStatusIds = $this->getParam('deleteCheckBox', '');

		if ($deleteCandidateStatusIds != ''){
			EmploymentCandidateStatus::model()->deleteSelectedCandidateStatus($deleteCandidateStatusIds);
		}

		$this->redirect(array('showAllCandidateStatus'));
	}	

	public function actionSaveCandidateStatus(){
		$candidateStatusObjModel = new EmploymentCandidateStatus;
		$candidateStatusObjModel->title = $this->getParam('newCandidateStatus','');
		$candidateStatusObjModel->save();

		if(!$error = $this->objError->getError()){
			if($candidateStatusObjModel->save()){
				$this->redirect(array('showAllCandidateStatus'));
			}
		}
	}
}	