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

	public function actionShowAllHiresForOnboarding() {
		$candidateCondition = 'candidate_status = 6';
		$hireArrRecords = EmploymentCandidate::model()->findAll($candidateCondition);
		return $this->render("showAllHiresForOnboarding", array('hireArrRecords'=>$hireArrRecords));
	}

	public function actionEditOnboardingItems() {
		$onboardingItemArrRecords = TrainingOnboardingItems::model()->findAll();
		return $this->render("editOnboardingItems", array('onboardingItemArrRecords'=>$onboardingItemArrRecords));
	}

	public function actionSaveOnboardingItems(){
		// TrainingOnboardingItems::model()->deleteAll();
		var_dump($_POST);exit;
	}

	public function actionViewSelectedOnboardingChecklist($id) {
		$candidateCondition = 'candidate_id = ' . $id;
		$onboardingChecklistArrRecords = TrainingOnboardingChecklist::model()->findAll($candidateCondition);
		$currentUserPriv = Yii::app()->user->priv;

		if ($currentUserPriv == "HR"){
			$displayHrResponsibility = "block";
		} else {
			$displayHrResponsibility = "none";
		}

		$this->render("viewSelectedOnboardingChecklist", array('id'=>$id, 'onboardingChecklistArrRecords'=>$onboardingChecklistArrRecords, 'displayHrResponsibility'=>$displayHrResponsibility));
	}

	public function actionShowTrainingSchedules(){
		$departments = EmploymentJobOpening::model()->queryForDistinctDepartment();

		$this->render("showHiresForTraining", array('departments'=>$departments));
	}

	public function actionSaveOnboardingChecklist($id){
		$completedItemIds = $this->getParam('completedCheckBox', '');
		$uncompletedItemIds = $this->getParam('uncompletedCheckBox', '');

		if($completedItemIds != ''){
			TrainingOnboardingChecklist::model()->updateOnboardingChecklist($completedItemIds, $id);
		} else if ($completedItemIds == ''){
			TrainingOnboardingChecklist::model()->revertOnboardingChecklist($id);
		}

		$this->redirect(array('showAllHiresForOnboarding'));
	}


}