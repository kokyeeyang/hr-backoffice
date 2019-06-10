<?php
// NOTE: FRONTEND
Yii::import('application.vendor.*');

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
		// Put your codes here...
		// exit('Please add the new candidate form here...');
		$dateToday = date("Y-m-d");
		$link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$encryptedJobId = substr($link, strpos($link, "=") + 1);
		
		$this->render('candidateForm', array('dateToday' => $dateToday, 'encryptedJobId' => $encryptedJobId));
	}

	public function actionSaveCandidate()
	{
		//this is for saving candidate details into employment_candidate table
		$encryptedJobId = $this->getParam('encryptedJobId', '');
		$jobIdInSecretKey = base64_decode($encryptedJobId);
		$jobId = substr($jobIdInSecretKey,9);

		$candidateObjModel = new EmploymentCandidate;
		$candidateObjModel->full_name = $this->getParam('fullName', '');
		$candidateObjModel->id_no = $this->getParam('idNo', '');
		$candidateObjModel->address = $this->getParam('address', '');
		$candidateObjModel->contact_no = $this->getParam('contactNo', '');
		$candidateObjModel->email_address = $this->getParam('emailAddress', '');
		$candidateObjModel->date_of_birth = $this->getParam('DOB', '');
		$candidateObjModel->marital_status = $this->getParam('maritalStatus', '');

		if($this->getParam('findingMethod', '') != false){
			$candidateObjModel->finding_method = $this->getParam('otherFindingMethod', '');
		}else {
			$candidateObjModel->finding_method = $this->getParam('findingMethod', '');
		}

		$candidateObjModel->gender = $this->getParam('gender', '');
		$candidateObjModel->nationality = $this->getParam('nationality', '');
		$candidateObjModel->job_id = $jobId;
		$candidateObjModel->terminated_before = $this->getParam('terminatedBefore', '');
		$candidateObjModel->termination_reason = $this->getParam('terminatedDetails', '');
		$candidateObjModel->reference_consent = $this->getParam('consent', '');
		$candidateObjModel->refuse_reference_reason = $this->getParam('noReferenceReason', '');
		$candidateObjModel->candidate_signature = $this->getParam('signature','');
		$candidateObjModel->candidate_signature_date = $this->getParam('signatureDate','');
		$candidateObjModel->save();
		// 

		// this is for saving candidate education into employment_education table
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
						$educationObjModel->school_name = $schoolName;
						$educationObjModel->start_year = $startYears[$iKey];
						$educationObjModel->end_year = $endYears[$iKey];
						$educationObjModel->qualification = $qualifications[$iKey];
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
					$experienceObjModel->company_name = $companyName;
					$experienceObjModel->start_date = $startDates[$iKey];
					$experienceObjModel->end_date = $endDates[$iKey];
					$experienceObjModel->position_held = $positionsHeld[$iKey];
					$experienceObjModel->ending_salary = $endingSalaries[$iKey];
					$experienceObjModel->allowances = $allowances[$iKey];
					$experienceObjModel->leave_reason = $leaveReasons[$iKey];
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
		$yearsKnownArray = $this->getParam('yearsKnown','');

		if(empty($supervisorNames[0]) === false){
			foreach($supervisorNames as $iKey => $supervisorName){
				if($supervisorName != '' && empty($supervisorCompanies[$iKey]) === false && empty($supervisorOccupations[$iKey]) === false && empty($supervisorOccupations[$iKey]) === false && empty($supervisorContacts[$iKey]) === false && empty($yearsKnownArray[$iKey]) === false){
					$refereeObjModel = new EmploymentReferee;
					$refereeObjModel->candidate_id = $candidateObjModel->id_no;
					$refereeObjModel->supervisor_name = $supervisorName;
					$refereeObjModel->supervisor_company = $supervisorCompanies[$iKey];
					$refereeObjModel->supervisor_occupation = $supervisorOccupations[$iKey];
					$refereeObjModel->supervisor_contact = $supervisorContacts[$iKey];
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
		$generalQuestionObjModel->has_been_convicted = $this->getParam('criminalOffenseRadio','');
		$generalQuestionObjModel->offense = $this->getParam('criminalOffenseInput','');
		$generalQuestionObjModel->convicted_date = $this->getParam('convictedDate','');
		$generalQuestionObjModel->date_of_discharge = $this->getParam('dischargeDate','');
		$generalQuestionObjModel->has_company_contact = $this->getParam('sagaosRelative','');
		$generalQuestionObjModel->company_contact_name = $this->getParam('sagaosContactNameInput','');
		$generalQuestionObjModel->relationship_with_candidate = $this->getParam('sagaosFamilyInput','');
		$generalQuestionObjModel->has_conflict_of_interest = $this->getParam('interestConflict','');
		$generalQuestionObjModel->has_own_transport = $this->getParam('ownTransport','');
		$generalQuestionObjModel->has_applied_before = $this->getParam('timesApplied','');
		$generalQuestionObjModel->commencement_date = $this->getParam('commencementDate','');
		$generalQuestionObjModel->good_conduct_consent = $this->getParam('goodConductConsent','');
		$generalQuestionObjModel->expected_salary = $this->getParam('expectedSalary','');

		$generalQuestionObjModel->save();
		//

		$this->redirect("redirectAfterRegister");
	}

	public function actionShowAllCandidates() {
		$strSortKey	= $this->getParam('sort_key', '');

		$candidateArrRecords = EmploymentCandidate::model()->findAll(array('order'=>'id ASC'));

		$this->render("showAllCandidates", array('candidateArrRecords' => $candidateArrRecords, 'strSortKey' => $strSortKey));
	}

	public function actionAddNewJobOpenings() {
		$objModel = new EmploymentJobOpening;
		$this->render("addNewJobOpenings", array('objModel' => $objModel));
	}

	public function actionSaveJobOpenings() {
		$jobOpeningObjModel = new EmploymentJobOpening;
		$jobOpeningObjModel->job_title = $this->getParam('jobTitle','');
		$jobOpeningObjModel->department = $this->getParam('department','');
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
			$aResult['result'] = $base64EncodedJobTitleId;

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
		$candidateId = (int)$id;
		$candidateCondition = 'id_no = "' . $candidateId . '"';
		$otherCondition = 'candidate_id = "' . $candidateId . '"';

		$candidateArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);
		$educationArrRecords = EmploymentEducation::model()->findAll($otherCondition);
		$generalQuestionArrRecords = EmploymentGeneralQuestion::model()->findAll($otherCondition);
		$jobExperienceArrRecords = EmploymentJobExperience::model()->findAll($otherCondition);
		$refereeArrRecords = EmploymentReferee::model()->findAll($otherCondition);	

		$currentAdminId = Yii::app()->user->id;
		//this is to allow editing only for hr and admin
		$access = Admin::model()->checkForAdminPrivilege($currentAdminId, 'registration');

		$this->render('viewCandidateDetails', array('candidateArrRecords'=>$candidateArrRecords, 'educationArrRecords'=>$educationArrRecords, 'generalQuestionArrRecords'=>$generalQuestionArrRecords, 'jobExperienceArrRecords'=>$jobExperienceArrRecords, 'refereeArrRecords'=>$refereeArrRecords, 'candidateId' => $candidateId, 'access' => $access));
		
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

			if($this->getParam('findingMethod', '') != false){
				$candidateObjRecord['finding_method'] = $this->getParam('otherFindingMethod', '');
			} else {
				$candidateObjRecord['finding_method'] = $this->getParam('findingMethod', '');
			}

			$candidateObjRecord['gender'] = $this->getParam('gender', '');
			$candidateObjRecord['nationality'] = $this->getParam('nationality', '');
			$candidateObjRecord['terminated_before'] = $this->getParam('terminatedBefore', '');
			$candidateObjRecord['termination_reason'] = $this->getParam('terminatedDetails', '');
			$candidateObjRecord['reference_consent'] = $this->getParam('consent', '');
			$candidateObjRecord['refuse_reference_reason'] = $this->getParam('noReferenceReason', '');
			$candidateObjRecord['candidate_signature'] = $this->getParam('signature','');
			$candidateObjRecord['candidate_signature_date'] = $this->getParam('signatureDate','');

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

		foreach($generalQuestionArrRecords as $generalQuestionObjRecord){
			$generalQuestionObjRecord->candidate_id = $this->getParam('idNo', '');
			$generalQuestionObjRecord->has_physical_ailment = $this->getParam('illness','');
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

			$generalQuestionObjRecord->update();
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


}