<?php

class TrainingController extends Controller
{
	public function filters() {
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

	public function actionAddNewHire() {
		$objModel = new EmploymentNewHire;

		$arrRecords = EmploymentCandidate::model()->findAll(array('order'=>'id ASC'));

		return $this->render("addNewHire", array('objModel'=>$objModel, 'arrRecords'=>$arrRecords));
	}

	public function actionCheckForCandidateInformation(){
		$aResult['result'] = false;
		if(Yii::app()->request->isAjaxRequest){
			$candidateName = $this->getParam('candidateName', '');
			$aResult['result'] = EmploymentCandidate::model()->checkForCandidateInformation($candidateName);
		}

		echo(json_encode($aResult));
		Yii::app()->end();
	}

	public function actionSaveNewHire(){
		if ($this->getParam('full_name', '') != ''){
			$objModel = new EmploymentNewHire;
			$jobId = EmploymentCandidate::model()->queryForCandidateJobId($this->getParam('full_name', ''));

			if ($jobId != false && $jobId != '' && $jobId !== 'undefined'){
				$objModel->full_name = $this->getParam('full_name', '');
				$objModel->id_no = $this->getParam('id_no', '');
				$objModel->address = $this->getParam('address', '');
				$objModel->contact_no = $this->getParam('contact_no', '');
				$objModel->email_address = $this->getParam('email_address', '');
				$objModel->date_of_birth = $this->getParam('date_of_birth', '');
				$objModel->gender = $this->getParam('gender', '');
				$objModel->job_title = EmploymentJobOpening::model()->queryForCandidateJob($jobId);
				$objModel->marital_status = $this->getParam('marital_status', '');
				$objModel->nationality = $this->getParam('nationality', '');
				$objModel->department = EmploymentJobOpening::model()->queryForCandidateDepartment($jobId);

				$objModel->save();

				//insert a new row for each confirmed hire to keep track of onboarding checklist
				$trainingObjModel = new EmploymentOnboardingChecklist;
				$trainingObjModel->full_name = $this->getParam('full_name', '');
				$trainingObjModel->id_no = 	$this->getParam('id_no', '');
				$trainingObjModel->save();

				$idNoArray = [$this->getParam('id_no', '')];
				//delete from candidate list once person is confirmed to be hired
				$deleteCandidate = EmploymentCandidate::model()->deleteSelectedCandidate($idNoArray);


				$this->redirect(array('showAllHiresForOnboarding'));
			} else if($jobId == false || $jobId == '' || $jobId === 'undefined'){
				echo '<script language="javascript">';
				echo 'alert("There are no candidates with this name.")';
				echo '</script>';
				return false;
			}
		} 

	}

	public function actionShowAllHiresForOnboarding() {
		$candidateCondition = 'candidate_status = 1';
		$hireArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);
		return $this->render("showAllHiresForOnboarding", array('hireArrRecords'=>$hireArrRecords));
	}

	public function actionEditOnboardingItems() {
		$onboardingItemArrRecords = TrainingOnboardingItems::model()->findAll();
		return $this->render("editOnboardingItems", array('onboardingItemArrRecords'=>$onboardingItemArrRecords));
	}

	public function actionViewSelectedOnboardingChecklist($id) {
		$onboardingChecklistArrRecords = TrainingOnboardingChecklist::model()->findAll($id); 

		$this->render("viewSelectedOnboardingChecklist", array('id'=>$id, 'onboardingChecklistArrRecords'=>$onboardingChecklistArrRecords));
	}

	public function actionShowTrainingSchedules(){
		$departments = EmploymentJobOpening::model()->queryForDistinctDepartment();

		$this->render("showHiresForTraining", array('departments'=>$departments));
	}

	public function actionSaveOnboardingChecklist($id){
		$completedItemIds = $this->getParam('completedCheckBox', '');

		if($completedItemIds != ''){
			TrainingOnboardingChecklist::model()->updateOnboardingChecklist($completedItemIds, $id);
		} else if ($completedItemIds == ''){
			TrainingOnboardingChecklist::model()->revertOnboardingChecklist($id);
		}

		$this->redirect(array('showAllHiresForOnboarding'));
	}

	public function actionSaveOnboardingItems(){

	}

}