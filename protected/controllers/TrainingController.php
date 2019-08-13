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

		foreach($arrRecords as $arrRecord){

		}

		$objModel->full_name = $this->getParam('full_name', '');
		// $objModel->id_no = $this->getParam('id_no', '');
		// $objModel->addres

		$this->render("addNewHire", array('objModel'=>$objModel, 'arrRecords'=>$arrRecords));
	}
}