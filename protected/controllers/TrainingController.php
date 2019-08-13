<?php

class TrainingController extends TrainingController
{
	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function actionAddNewHire() {
		$objModel = new EmploymentNewHire;
		$this->render("addNewHire", array('objModel'=>$objModel));
	}
}