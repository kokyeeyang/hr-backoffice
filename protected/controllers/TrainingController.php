<?php

class TrainingController extends Controller
{
	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function actionAddNewHire() {
		$objModel = new EmploymentNewHire;

		$arrRecords = EmploymentCandidate::model()->findAll(array('order'=>'id ASC'));

		$objModel->full_name = $this->getParam('full_name', '');

		return $this->render("addNewHire", array('objModel'=>$objModel, 'arrRecords'=>$arrRecords));
	}

	public function actionCheckForCandidateInformation(){
		$aResult['result'] = false;
		$candidateName = $this->getParam('full_name', '');

		if(Yii::app()->request->isAjaxRequest){
			$aResult['result'] = EmploymentNewHire::model()->checkForCandidateInformation($candidateName);
		}
		
		echo(json_encode($aResult));
		Yii::app()->end();
	}
}