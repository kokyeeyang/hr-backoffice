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
		$this->render('candidateForm');
	}

	public function actionSaveCandidate()
	{
		//this is for saving candidate details into employment_candidate table
		$candidateObjModel = new EmploymentCandidate;
		$candidateObjModel->full_name = $this->getParam('fullName', '');
		$candidateObjModel->id_no = $this->getParam('idNo', '');
		$candidateObjModel->address = $this->getParam('address', '');
		$candidateObjModel->contact_no = $this->getParam('contactNo', '');
		$candidateObjModel->email_address = $this->getParam('emailAddress', '');
		$candidateObjModel->date_of_birth = $this->getParam('DOB', '');
		$candidateObjModel->marital_status = $this->getParam('maritalStatus', '');
		$candidateObjModel->gender = $this->getParam('gender', '');
		$candidateObjModel->nationality = $this->getParam('nationality', '');
		$candidateObjModel->terminated_before = $this->getParam('terminatedBefore', '');
		$candidateObjModel->termination_reason = $this->getParam('terminatedDetails', '');
		$candidateObjModel->reference_consent = $this->getParam('consent', '');
		$candidateObjModel->refuse_reference_reason = $this->getParam('noReferenceReason', '');
		$candidateObjModel->position_applied = $this->getParam('positionApplied', '');
		
		$candidateObjModel->save();
		// 

		// this is for saving candidate education into employment_education table
		$schoolNames = $this->getParam('schoolName', '');
		$startYears = $this->getParam('startYear', '');
		$endYears = $this->getParam('endYear', '');
		$qualifications = $this->getParam('qualification', '');
		$grades = $this->getParam('cgpa', '');
// var_dump($endYears);
// exit;
		foreach ($schoolNames as $schoolName){
			foreach ($startYears as $startYear){
				foreach ($endYears as $endYear){
					foreach ($qualifications as $qualification){
						foreach ($grades as $grade){
							//only need one field to prevent creation of null rows
							if ($schoolName != false){
								$educationObjModel = new EmploymentEducation;
								$educationObjModel->candidate_id = $candidateObjModel->id_no;
								$educationObjModel->school_name = $schoolName;
								$educationObjModel->start_year = $startYear;
								$educationObjModel->end_year = $endYear;
								$educationObjModel->qualification = $qualification;
								$educationObjModel->grade = $grade;
								$educationObjModel->save();
							}
						}
					}
				}
			}
		}
		//

		// this is for saving candidate job experience into employment_job_experience table
		$companyNames = $this->getParam('companyName','');
		$startDates = $this->getParam('startDate','');
		$endDates = $this->getParam('endDate','');
		$positionsHeld = $this->getParam('positionHeld','');
		$startingSalaries = $this->getParam('startingSalary','');
		$endingSalaries = $this->getParam('endingSalary','');
		$allowances = $this->getParam('allowances','');
		$leaveReasons = $this->getParam('leaveReason','');

		foreach($companyNames as $companyName){
			foreach($startDates as $startDate){
				foreach($endDates as $endDate){
					foreach($positionsHeld as $positionHeld){
						foreach($startingSalaries as $startingSalary){
							foreach($endingSalaries as $endingSalary){
								foreach($allowances as $allowance){
									foreach($leaveReasons as $leaveReason){
										if($companyName != false){
											$experienceObjModel = new EmploymentJobExperience;
											$experienceObjModel->candidate_id = $candidateObjModel->id_no;
											$experienceObjModel->company_name = $companyName;
											$experienceObjModel->start_date = $startDate;
											$experienceObjModel->end_date = $endDate;
											$experienceObjModel->position_held = $positionHeld;
											$experienceObjModel->starting_salary = $startingSalary;
											$experienceObjModel->ending_salary = $endingSalary;
											$experienceObjModel->allowances = $allowance;
											$experienceObjModel->leave_reason = $leaveReason;
										} 
									}
								}
							}
						}
					}
				}
			}
		}

		$experienceObjModel->save();
	}
	//

	/**
	 * This is the 'captcha' action
	 */
	public function actionCaptcha()
	{
		require_once('ydl/captcha/Captcha.php');
		Captcha::genCaptcha();
	}


}