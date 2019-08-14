<?php

class TrainingController extends Controller
{
	public function filters() {
		return array(
			'accessControl',
		);
	}

	// public function accessRules()
	// {
	// 	return array(
	// 		array(
	// 			'allow',  // allow all users to perform the RoleHelper's returned actions
	// 			'actions'=>RoleHelper::GetRole(self::$strController, false),
	// 			'users'=>array('*'),
	// 		),
	// 		array(
	// 			'allow', // allow authenticated admin user to perform the RoleHelper's returned actions
	// 			'actions'=>RoleHelper::GetRole(self::$strController, true),
	// 			'users'=>array('@'),
	// 		),
	// 		array(
	// 			'deny',  // deny all other users access
	// 			'users'=>array('*'),
	// 		),
	// 	);	
	// }	

	public function actionAddNewHire() {
		$objModel = new EmploymentNewHire;

		$arrRecords = EmploymentCandidate::model()->findAll(array('order'=>'id ASC'));

		return $this->render("addNewHire", array('objModel'=>$objModel, 'arrRecords'=>$arrRecords));
	}

	public function actionCheckForCandidateInformation(){
		$aResult['result'] = false;
		if(Yii::app()->request->isAjaxRequest){
			$candidateName = $this->getParam('candidateName', '');
			$aResult['result'] = EmploymentNewHire::model()->checkForCandidateInformation($candidateName);
		}

		echo(json_encode($aResult));
		Yii::app()->end();
	}
}