<?php

class IpController extends Controller 
{
	public function filters() {
    return array(
        'accessControl',
    );
  }

 	public function actionCheckDuplicateWhitelistIp() 
 	{	
 		$aResult['result'] = false;

 		if(Yii::app()->request->isAjaxRequest)
 		{
			$ipAddress = $this->getParam('ip_address', '');
			$aResult['result'] = WhitelistedIp::model()->checkDuplicateWhitelistIp($ipAddress);
		}
		echo(json_encode($aResult));
		Yii::app()->end();
	}

	public function actionCreateNewWhitelistIp() {
		if (Yii::app()->user->id){
			$currentAdminId = Yii::app()->user->id;
			$infinityDuration = Admin::model()->checkForAdminPrivilege($currentAdminId, 'ip');
			$durationArr = range(0,60);

			if($infinityDuration){
				$durationArr[62] = $infinityDuration;
			}
			//current ip address
			$currentIpAddress = get_ip();
			$userName = strtolower(str_replace(' ', '', Yii::app()->user->display_name));
			$labelName = $userName . "home";

			$ipAddress = $this->getParam('ip_address', '');
			$matchIpAddress = WhitelistedIp::model()->checkDuplicateWhitelistIp($currentIpAddress);

			if ($matchIpAddress == true){
				$display = 'block';
			} else {
				$display = 'none';
			}

			$objModel = new WhitelistedIp();
			$this->render('createNewWhitelistIp', array('durationArr' => $durationArr, 'currentIpAddress' => $currentIpAddress, 'labelName' => $labelName, 'objModel' => $objModel, 'display' => $display));
		} 
	}

	public function actionSaveWhitelistIp() {
		//need to get current user's admin_id in admin table
		$currentAdminId = Yii::app()->user->id;
		$objModel = new WhitelistedIp;

		$objModel->label = $this->getParam('label', '');
		$objModel->ip_address = $this->getParam('ip_address', '');
		$objModel->duration = $this->getParam('duration', '');
		$objModel->created_date = date("Y-m-d");
		$objModel->created_by = $currentAdminId;
		$objModel->save();

		if(!$error = $this->objError->getError()){
			if($objModel->save()){
				$this->redirect(array('showAllWhitelistIp'));
			}
		}
	}

	public function actionShowAllWhitelistIp() {
		//need to show id,label,ip_address,duration
		$strSortKey	= $this->getParam('sort_key', '');
		$arrRecords = WhitelistedIp::model()->findAll(array('order'=>'id ASC'));

		return $this->render('showAllWhitelistIp', array('arrRecords'=>$arrRecords, 'strSortKey'=>$strSortKey));
	}

	public function actionDeleteSelectedWhitelistIp() {
		//get the id of each selected whitelistip record in the front end check box 
		$ipRecordIds = $this->getParam('deleteCheckBox', '');

		if ($ipRecordIds != ''){
			$deleteMessage = WhitelistedIp::model()->deleteSelectedWhitelistIp($ipRecordIds);
		}

		$this->redirect(array('showAllWhitelistIp'));
	}



}