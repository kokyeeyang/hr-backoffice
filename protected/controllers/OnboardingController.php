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
		$onboardingItemObjRecord = '';
		$departmentArr = Department::model()->findAll();
	
		return $this->render("onboardingItemDetails", array('departmentArr' => $departmentArr, 'breadcrumbTop' => $breadcrumbTop,'title' => $title, 'widgetTitle' => $widgetTitle, 'buttonTitle' => $buttonTitle, 'onboardingItemObjRecord' => $onboardingItemObjRecord));
	}

	public function actionSaveOnboardingItem(){
		$onboardingItemObjModel = new OnboardingChecklistItem;
		$onboardingItemObjModel->title = $this->getParam('onboardingItemName', '');
		$onboardingItemObjModel->description = $this->getParam('onboardingItemDescription', '');
		$onboardingItemObjModel->department_owner = $this->getParam('responsibilityDropdown', '');
		$onboardingItemObjModel->is_offboarding_item = $this->getParam('isOffBoardingCheckBox', '');
		$onboardingItemObjModel->status = $this->getParam('isActiveCheckbox', '');
 		$onboardingItemObjModel->is_managerial = $this->getParam('isManagerialCheckBox', '');
 		$onboardingItemObjModel->created_by = Yii::app()->user->id;
		$onboardingItemObjModel->save();

		if ($onboardingItemObjModel->save()){
			$this->redirect(array('showAllOnboardingItems'));
		}

	}

	public function actionShowAllOnboardingItems(){
		$arrRecords = OnboardingChecklistItem::model()->findAll(array('order'=>'id ASC'));
		$strSortKey = $this->getParam('sort_key','');
		$pageType = OnboardingItemEnum::ONBOARDING_ITEM;

		$objPagination = $this->getStrSortByList($strSortKey, OnboardingItemEnum::ONBOARDING_ITEM_TABLE, false,  CommonEnum::RETURN_PAGINATION);
		$objCriteria = $this->getStrSortByList($strSortKey, OnboardingItemEnum::ONBOARDING_ITEM_TABLE, false, CommonEnum::RETURN_CRITERIA);
		$onboardingItemsArr = $this->getStrSortByList($strSortKey, OnboardingItemEnum::ONBOARDING_ITEM_TABLE, true, CommonEnum::RETURN_TABLE_ARRAY_BY_SQL);

		if(isset($_POST['ajax']) && $_POST['ajax']==='onboardingitems-list' && Yii::app()->request->isAjaxRequest){
			$aResult = [];
			$aResult['result'] 	= 0;
			$aResult['content'] = '';
			$aResult['msg'] 	= '';

			$aResult['content'] = $this->renderPartial('showAllOnboardingItems', ['strSortKey'=>$strSortKey, 'onboardingItemsArr'=>$onboardingItemsArr, 'objPagination'=>$objPagination, 'pageType'=>$pageType], true);

			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			}
			echo(json_encode($aResult));
			Yii::app()->end();				
		}

		return $this->render("showAllOnboardingItems", ['strSortKey'=>$strSortKey, 'onboardingItemsArr'=>$onboardingItemsArr, 'objPagination'=>$objPagination, 'pageType'=>$pageType]);
	}

	private function getStrSortByList($strSortKey, $tableName, $tableNameInSql=false, $pageVar){

		$strSortBy = self::getStrSortBy($strSortKey, $tableName);

		$objCriteria		= new CDbCriteria();
		$objCriteria->order = $strSortBy;

		$intCount 		= $tableName::model()->count($objCriteria);
		$objPagination	= new CPagination($intCount);
		$objPagination->setPageSize(Yii::app()->params['numPerPage']);
		$objPagination->setCurrentPage($this->intPage);
		$objPagination->applyLimit($objCriteria);

		$intPage = $this->intPage;	

		switch($pageVar){
			case CommonEnum::RETURN_PAGINATION:
				return $objPagination;
			break;

			case CommonEnum::RETURN_CRITERIA:
				return $objCriteria;
			break;

			case CommonEnum::RETURN_TABLE_ARRAY_BY_SQL:
				switch($tableNameInSql){
					case OnboardingItemEnum::ONBOARDING_ITEM_TABLE_IN_SQL:
						$numPerPage = Yii::app()->params['numPerPage'];
						$tableArr = OnboardingChecklistItem::model()->findAllOnboardingItems($strSortBy, $intPage, $numPerPage);
						return $tableArr;
					break;
				}
			break;
		}		
	}

	private static function getStrSortBy($strSortKey, $tableName){
		switch($tableName){
			case OnboardingItemEnum::ONBOARDING_ITEM_TABLE :
				$strSortBy = self::getOnboardingItemList($strSortKey);
				return $strSortBy;
			break;
		}
	}

	private static function getOnboardingItemList($strSortKey){
		switch($strSortKey){
			case 'sort_title_desc':
			default: 
				$strSortKey = 'sort_title_desc';
				return 'ECI.title DESC';
			break;

			case 'sort_title_asc':
				return 'ECI.title ASC';
			break;

			case 'sort_department_owner_asc':
				return 'D.title ASC';
			break;

			case 'sort_department_owner_desc':
				return 'D.title DESC';
			break;

			case 'sort_is_offboarding_item_asc':
				return 'ECI.is_offboarding_item ASC';
			break;

			case 'sort_is_offboarding_item_desc':
				return 'ECI.is_offboarding_item DESC';
			break;

			case 'sort_status_asc':
				return 'ECI.status ASC';
			break;

			case 'sort_status_desc':
				return 'ECI.status DESC';
			break;

			case 'sort_is_managerial_asc':
				return 'ECI.is_managerial ASC';
			break;

			case 'sort_is_managerial_desc':
				return 'ECI.is_managerial DESC';
			break;
		}
	}

	public function actionViewSelectedOnboardingItem($id){
		$itemId = $this->getParam('id', '', '', 'get');
		$onboardingItemCondition = 'id = ' . $itemId;
		$onboardingItemObjRecord = OnboardingChecklistItem::model()->find($onboardingItemCondition);
		$departmentArr = Department::model()->findAll();

		$breadcrumbTop = Yii::t('app', 'Edit Onboarding Checklist Item');
		$title = Yii::t('app', 'Edit onboarding checklist item');
		$widgetTitle = Yii::t('app', 'Edit onboarding checklist item');
		$buttonTitle = Yii::t('app', 'Submit');

		if ($onboardingItemObjRecord == null){
			throw new CHttpException(404,'Onboarding item does not exist with the requested id.');
		}

		$this->render('onboardingItemDetails', array('onboardingItemObjRecord'=>$onboardingItemObjRecord, 'breadcrumbTop'=>$breadcrumbTop, 'title'=>$title, 'widgetTitle'=>$widgetTitle, 'buttonTitle'=>$buttonTitle, 'departmentArr'=>$departmentArr));
	}
}