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
			$aResult['result'] = EmploymentCandidate::model()->checkForCandidateInformation($candidateName);
		}

		echo(json_encode($aResult));
		Yii::app()->end();
	}

	public function actionShowCandidateInformation(){
		$candidateName = intval($_GET['query']);

		$sql = 'SELECT ' . 'full_name, id_no, address, contact_no, email_address, date_of_birth, gender, marital_status, nationality ';
		$sql .= 'FROM ' . 'employment_candidate';
		$sql .= 'WHERE ' . 'full_name = ' . '"' . $candidateName . '"';
		$objConnection 	= Yii::app()->db;
		$objCommand		= $objConnection->createCommand($sql);
		$arrData		= $objCommand->queryRow();

		if (!empty($arrData['full_name, id_no, address, contact_no, email_address, date_of_birth, gender, job_title, marital_status, nationality'])){
			echo "<table>
			<tr>
			<th>Full name</th>
			<th>ID No</th>
			<th>Address</th>
			<th>Contact No</th>
			<th>Email address</th>
			<th>Date of birth</th>
			<th>Gender</th>
			<th>Job title</th>
			<th>Marital status</th>
			<th>Nationality</th>
			";
			while ($row = $arrData){
				echo "<tr>";
				echo "<td>" . $row['full_name'] . "</td>";
			}
			echo "</table>";
		} else {
			return 'no data found';
		}
	}
}