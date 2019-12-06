<?php 

class OnboardingController extends Controller
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
			} else {
				$this->render('error', $error);
			}
		}
	}

	public function actionAddNewOnboardingItem(){
		$breadcrumbTop = Yii::t('app', 'Add New Onboarding Checklist Item');
		$title = Yii::t('app', 'Add new onboarding checklist item');
		$widgetTitle = Yii::t('app', 'Add new onboarding checklist item');
		$buttonTitle = Yii::t('app', 'Save');
		$onboardingItemDescription = '';
		$departmentArr = Department::model()->findAll();
	
		return $this->render("onboardingItemDetails", array('departmentArr' => $departmentArr, 'breadcrumbTop' => $breadcrumbTop,'title' => $title, 'widgetTitle' => $widgetTitle, 'buttonTitle' => $buttonTitle, 'onboardingItemDescription' => $onboardingItemDescription));
	}

	public function actionSaveOnboardingItem(){
		$onboardingItemObjModel = new OnboardingChecklistItem;
		$onboardingItemObjModel->title = $this->getParam('onboardingChecklistItemName', '');
		$onboardingItemObjModel->description = $this->getParam('onboardingChecklistItemDescription', '');
		$onboardingItemObjModel->department_owner = $this->getParam('responsibilityDropdown', '');
		$onboardingItemObjModel->is_offloading_item = $this->getParam('isOffLoadingCheckBox', '');
		$onboardingItemObjModel->status = $this->getParam('isActiveCheckbox', '');
 		$onboardingItemObjModel->is_managerial = $this->getParam('isManagerialCheckBox', '');
		$onboardingItemObjModel->save();

		if ($onboardingItemObjModel->save()){
			$this->redirect(array('showAllOnboardingItems'));
		}

	}

	public function actionShowAllOnboardingItems(){
		$arrRecords = OnboardingChecklistItem::model()->findAll(array('order'=>'id ASC'));
		$strSortKey = $this->getParam('sort_key','');
		$pageType = OnboardingItemEnum::ONBOARDING_ITEM;

		$objPagination = $this->getStrSortByList($strSortKey, EmploymentCandidateStatusEnum::CANDIDATE_STATUS_TABLE, false,  CommonEnum::RETURN_PAGINATION);
		$objCriteria = $this->getStrSortByList($strSortKey, EmploymentCandidateStatusEnum::CANDIDATE_STATUS_TABLE, false, CommonEnum::RETURN_CRITERIA);
		$arrRecords = $this->getStrSortByList($strSortKey, EmploymentCandidateStatusEnum::CANDIDATE_STATUS_TABLE, false, CommonEnum::RETURN_TABLE_ARRAY);

		if(isset($_POST['ajax']) && $_POST['ajax']==='candidatestatus-list' && Yii::app()->request->isAjaxRequest){
			$aResult = [];
			$aResult['result'] 	= 0;
			$aResult['content'] = '';
			$aResult['msg'] 	= '';

			$aResult['content'] = $this->renderPartial('showAllCandidateStatus', ['strSortKey'=>$strSortKey, 'arrRecords'=>$arrRecords, 'objPagination'=>$objPagination, 'pageType'=>$pageType], true);

			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			}
			echo(json_encode($aResult));
			Yii::app()->end();				
		}

		return $this->render("showAllOnboardingItems", array('pageType' => $pageType));
	}
}