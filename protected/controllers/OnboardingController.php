<?php

class OnboardingController extends Controller {

    public function filters() {
	return array(
	    'accessControl',
	);
    }

    public function accessRules() {
	return array(
	    array(
		'allow', // allow all users to perform the RoleHelper's returned actions
		'actions' => RoleHelper::GetRole(self::$strController, false),
		'users' => array('*'),
	    ),
	    array(
		'allow', // allow authenticated admin user to perform the RoleHelper's returned actions
		'actions' => RoleHelper::GetRole(self::$strController, true),
		'users' => array('@'),
	    ),
	    array(
		'deny', // deny all other users access
		'users' => array('*'),
	    ),
	);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
	if ($error = Yii::app()->errorHandler->error) {
	    if (Yii::app()->request->isAjaxRequest) {

		if (Yii::app()->user->isGuest === false) {
		    echo $error['message'];
		} // - end: if
		Yii::app()->end();
	    } else {
		$this->render('error', $error);
	    }
	}
    }

    public function actionAddNewOnboardingItem() {
	$breadcrumbTop = Yii::t('app', 'Add New Onboarding Checklist Item');
	$title = Yii::t('app', 'Add new onboarding checklist item');
	$widgetTitle = Yii::t('app', 'Add new onboarding checklist item');
	$buttonTitle = Yii::t('app', 'Save');
	$onboardingItemObjRecord = '';
	$departmentArr = Department::model()->findAll();
	$formAction = $this->createUrl('onboarding/saveOnboardingItem');

	return $this->render("onboardingItemDetails", array('departmentArr' => $departmentArr, 'breadcrumbTop' => $breadcrumbTop, 'title' => $title, 'widgetTitle' => $widgetTitle, 'buttonTitle' => $buttonTitle, 'onboardingItemObjRecord' => $onboardingItemObjRecord, 'formAction' => $formAction));
    }

    public function actionSaveOnboardingItem() {
	$onboardingItemObjModel = new OnboardingChecklistItem;
	$onboardingItemObjModel->title = $this->getParam('onboardingItemName', '');
	$onboardingItemObjModel->description = $this->getParam('onboardingItemDescription', '');
	$onboardingItemObjModel->department_owner = $this->getParam('responsibilityDropdown', '');
	if ($this->getParam('isOffboardingCheckbox', '') == null) {
	    $onboardingItemObjModel->is_offboarding_item = 0;
	} else {
	    $onboardingItemObjModel->is_offboarding_item = $this->getParam('isOffboardingCheckbox', '');
	}
	$onboardingItemObjModel->status = $this->getParam('isActiveCheckbox', '');
	$onboardingItemObjModel->is_managerial = $this->getParam('isManagerialCheckbox', '');
	$onboardingItemObjModel->created_by = Yii::app()->user->id;
	$onboardingItemObjModel->save();

	if ($onboardingItemObjModel->save()) {
	    $this->redirect(array('showAllOnboardingItems'));
	}
    }

    public function actionShowAllOnboardingItems() {
	$arrRecords = OnboardingChecklistItem::model()->findAll(array('order' => 'id ASC'));
	$strSortKey = $this->getParam('sort_key', '');
	$pageType = OnboardingItemEnum::ONBOARDING_ITEM;

	$objPagination = self::getStrSortByList($strSortKey, OnboardingItemEnum::ONBOARDING_ITEM_TABLE, false, CommonEnum::RETURN_PAGINATION);
	$onboardingItemsArr = self::getStrSortByList($strSortKey, OnboardingItemEnum::ONBOARDING_ITEM_TABLE, OnboardingItemEnum::ONBOARDING_ITEM_TABLE_IN_SQL, CommonEnum::RETURN_TABLE_ARRAY_BY_SQL);

	if (isset($_POST['ajax']) && $_POST['ajax'] === 'onboardingitems-list' && Yii::app()->request->isAjaxRequest) {
	    $aResult = [];
	    $aResult['result'] = 0;
	    $aResult['content'] = '';
	    $aResult['msg'] = '';

	    $aResult['content'] = $this->renderPartial('showAllOnboardingItems', ['strSortKey' => $strSortKey, 'onboardingItemsArr' => $onboardingItemsArr, 'objPagination' => $objPagination, 'pageType' => $pageType], true);

	    if (!empty($aResult['content'])) {
		$aResult['result'] = 1;
	    }
	    echo(json_encode($aResult));
	    Yii::app()->end();
	}

	return $this->render("showAllOnboardingItems", ['strSortKey' => $strSortKey, 'onboardingItemsArr' => $onboardingItemsArr, 'objPagination' => $objPagination, 'pageType' => $pageType]);
    }

    private function getStrSortByList($strSortKey, $tableName, $tableNameInSql = false, $pageVar) {

	$strSortBy = self::getStrSortBy($strSortKey, $tableName);
	
	//for use in returning data from a single table
	$order = $strSortBy;
	
	if($_POST == false && !isset($_POST["sort_key"])){
	    $order = 'created_date DESC';
	}
	
	$objCriteria = new CDbCriteria();
	$objCriteria->order = $order;
	
	$intCount = $tableName::model()->count($objCriteria);
	$objPagination = new CPagination($intCount);
	$objPagination->setPageSize(Yii::app()->params['numPerPage']);
	$objPagination->setCurrentPage($this->intPage);
	$objPagination->applyLimit($objCriteria);

	$intPage = $this->intPage;

	switch ($pageVar) {
	    case CommonEnum::RETURN_PAGINATION:
		return $objPagination;
		break;

	    case CommonEnum::RETURN_CRITERIA:
		return $objCriteria;
		break;

	    case CommonEnum::RETURN_TABLE_ARRAY_BY_SQL:
		switch ($tableNameInSql) {
		    case OnboardingItemEnum::ONBOARDING_ITEM_TABLE_IN_SQL:
			$numPerPage = Yii::app()->params['numPerPage'];
			$tableArr = OnboardingChecklistItem::model()->findAllOnboardingItems($strSortBy, $intPage, $numPerPage);
			return $tableArr;
			break;

		    case OnboardingChecklistTemplateEnum::ONBOARDING_CHECKLIST_TEMPLATE_TABLE_IN_SQL:
			$numPerPage = Yii::app()->params['numPerPage'];
			$tableArr = OnboardingChecklistTemplate::model()->findAllOnboardingChecklistTemplates($strSortBy, $intPage, $numPerPage);
			return $tableArr;
			break;
		}
		break;
	}
    }

    private static function getStrSortBy($strSortKey, $tableName) {
	switch ($tableName) {
	    case OnboardingItemEnum::ONBOARDING_ITEM_TABLE :
		$strSortBy = self::getOnboardingItemList($strSortKey);
		return $strSortBy;
		break;

	    case OnboardingChecklistTemplateEnum::ONBOARDING_CHECKLIST_TEMPLATE_TABLE :
		$strSortBy = self::getOnboardingChecklistTemplateList($strSortKey);
		return $strSortBy;
		break;
	}
    }

    private static function getOnboardingItemList($strSortKey) {
	switch ($strSortKey) {
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

    private static function getOnboardingChecklistTemplateList($strSortKey) {
	switch ($strSortKey) {
	    case 'sort_title_desc' :
	    default:
		$strSortKey = 'sort_title_desc';
		return 'title DESC';
		break;

	    case 'sort_title_asc' :
		return 'title ASC';
		break;

	    case 'sort_description_desc' :
		return 'description DESC';
		break;

	    case 'sort_description_asc' :
		return 'description ASC';
		break;
	}
    }

    public function actionViewSelectedOnboardingItem($id) {
	$itemId = $this->getParam('id', '', '', 'get');
	$onboardingItemCondition = 'id = ' . $itemId;
	$onboardingItemObjRecord = OnboardingChecklistItem::model()->find($onboardingItemCondition);
	$departmentArr = Department::model()->findAll();
	$formAction = $this->createUrl('onboarding/updateOnboardingItem');

	$breadcrumbTop = Yii::t('app', 'Edit Onboarding Checklist Item');
	$title = Yii::t('app', 'Edit onboarding checklist item');
	$widgetTitle = Yii::t('app', 'Edit onboarding checklist item');
	$buttonTitle = Yii::t('app', 'Update');

	if ($onboardingItemObjRecord == null) {
	    throw new CHttpException(404, 'Onboarding item does not exist with the requested id.');
	}

	$this->render('onboardingItemDetails', array('onboardingItemObjRecord' => $onboardingItemObjRecord, 'breadcrumbTop' => $breadcrumbTop, 'title' => $title, 'widgetTitle' => $widgetTitle, 'buttonTitle' => $buttonTitle, 'departmentArr' => $departmentArr, 'formAction' => $formAction));
    }

    public function actionDeleteOnboardingItems() {
	$deleteOnboardingItemIds = $this->getParam('deleteCheckBox', '');

	if ($deleteOnboardingItemIds != '') {
	    OnboardingChecklistItem::model()->deleteOnboardingItem($deleteOnboardingItemIds);
	}

	$this->redirect(array('showAllOnboardingItems'));
    }

    public function actionUpdateOnboardingItem() {
	$id = $this->getParam('onboardingItemId', '');
	$onboardingItemCondition = 'id = "' . $id . '"';

	$isOffBoarding = $this->getParam('isOffboardingCheckbox', '');

	if ($this->getParam('isOffboardingCheckbox', '') == null) {
	    $isOffBoarding = 0;
	}

	OnboardingChecklistItem::model()->updateAll([
	    'title' => $this->getParam('onboardingItemName', ''), 'description' => $this->getParam('onboardingItemDescription', ''),
	    'department_owner' => $this->getParam('responsibilityDropdown', ''), 'is_offboarding_item' => $isOffBoarding,
	    'status' => $this->getParam('isActiveCheckbox', ''), 'is_managerial' => $this->getParam('isManagerialCheckbox', ''),
	    'created_by' => Yii::app()->user->id
	    ], $onboardingItemCondition);

	$this->redirect(array('showAllOnboardingItems'));
    }

    public function actionShowAllOnboardingChecklistTemplates() {
	$strSortKey = $this->getParam('sort_key', '');
	$pageType = OnboardingChecklistTemplateEnum::ONBOARDING_CHECKLIST_TEMPLATE;

	$objPagination = $this->getStrSortByList($strSortKey, OnboardingChecklistTemplateEnum::ONBOARDING_CHECKLIST_TEMPLATE_TABLE, false, CommonEnum::RETURN_PAGINATION);
	$onboardingChecklistTemplatesArr = $this->getStrSortByList($strSortKey, OnboardingChecklistTemplateEnum::ONBOARDING_CHECKLIST_TEMPLATE_TABLE, OnboardingChecklistTemplateEnum::ONBOARDING_CHECKLIST_TEMPLATE_TABLE_IN_SQL, CommonEnum::RETURN_TABLE_ARRAY_BY_SQL);

	if (isset($_POST['ajax']) && $_POST['ajax'] === 'onboardingchecklisttemplates-list' && Yii::app()->request->isAjaxRequest) {
	    $aResult = [];
	    $aResult['result'] = 0;
	    $aResult['content'] = '';
	    $aResult['msg'] = '';

	    // if click on sorting, then it will be ajax, thus we returnpartial here
	    $aResult['content'] = $this->renderPartial("showAllOnboardingChecklistTemplates", array('strSortKey' => $strSortKey, 'pageType' => $pageType, 'objPagination' => $objPagination, 'onboardingChecklistTemplatesArr' => $onboardingChecklistTemplatesArr), true);

	    if (!empty($aResult['content'])) {
		$aResult['result'] = 1;
	    }
	    echo(json_encode($aResult));
	    Yii::app()->end();
	}

	$this->render("showAllOnboardingChecklistTemplates", array('strSortKey' => $strSortKey, 'objPagination' => $objPagination, 'pageType' => $pageType, 'onboardingChecklistTemplatesArr' => $onboardingChecklistTemplatesArr));
    }

    public function actionAddNewOnboardingChecklistTemplate() {
	$header = Yii::t('app', 'Add new Onboarding Checklist Template');
	$formAction = $this->createUrl('onboarding/saveOnboardingChecklistTemplate');
	$onboardingItemTitleArrRecord = OnboardingChecklistItem::model()->queryForOnboardingItemTitles();
	$buttonShortTitle = Yii::t('app', 'Save');
	$buttonClass = Yii::t('app', 'saveOnboardingChecklistTemplateButton');
	$buttonTitle = Yii::t('app', 'Save this template');

	if (isset($_POST['ajax']) && $_POST['ajax'] === 'onboardingChecklistTemplateForm' && Yii::app()->request->isAjaxRequest) {
	    $aResult = [];
	    $aResult['result'] = 0;
	    $aResult['content'] = '';
	    $aResult['msg'] = '';

	    $onboardingItemId = $this->getParam('onboarding_item_id');
	    //put in the new function to find onboarding item details here
	    $selectedOnboardingItem = OnboardingChecklistItem::model()->findOnboardingItemDetails($onboardingItemId);
	    $aResult['description'] = $selectedOnboardingItem[0]['description'];
	    $aResult['department_owner'] = $selectedOnboardingItem[0]['department_owner'];
	    $aResult['is_offboarding_item'] = $selectedOnboardingItem[0]['is_offboarding_item'];

	    if (!empty($aResult['content'])) {
		$aResult['result'] = 1;
	    }
	    echo(json_encode($aResult));
	    Yii::app()->end();
	}

	$this->render('onboardingChecklistTemplateDetails', array('header' => $header, 'formAction' => $formAction, 'onboardingItemTitleArrRecord' => $onboardingItemTitleArrRecord,
	    'buttonShortTitle' => $buttonShortTitle, 'buttonClass' => $buttonClass, 'buttonTitle' => $buttonTitle
	));
    }

    public function actionUpdateOnboardingChecklistTemplate() {

	$templateId = $this->getParam('templateId', '');
	$arrayKeys = array_keys($_POST);
	foreach ($arrayKeys as $arrayKey) {
	    $match = preg_match('%onboardingItemDropdown%', $arrayKey);
	}

	$updateCondition = 'id = ' . $templateId;
	OnboardingChecklistTemplate::model()->updateAll([
	    'title' => $this->getParam('templateTitle', ''), 'description' => $this->getParam('templateDescription', '')
	    ], $updateCondition);

	$arrayKeys = array_keys($_POST);
	$condition = 'checklist_template_id = ' . $templateId;
	OnboardingChecklistItemsMapping::model()->deleteAll($condition);

	foreach ($arrayKeys as $arrayKey) {
	    $match = preg_match('%onboardingItemDropdown%', $arrayKey);
	    if ($match != null && $this->getParam($arrayKey, '') != null) {
		$onboardingItemMappingObjModel = new OnboardingChecklistItemsMapping;
		$onboardingItemMappingObjModel->checklist_item_id = $this->getParam($arrayKey, '');
		$onboardingItemMappingObjModel->checklist_template_id = $templateId;
		$onboardingItemMappingObjModel->save();
	    }
	}

	$this->redirect(array('showAllOnboardingChecklistTemplates'));
    }

    public function actionDeleteOnboardingChecklistTemplates() {
	$deleteOnboardingChecklistIds = $this->getParam('deleteCheckBox', '');

	if ($deleteOnboardingChecklistIds != '') {
	    OnboardingChecklistTemplate::model()->deleteOnboardingTemplates($deleteOnboardingChecklistIds);
	    OnboardingChecklistItemsMapping::model()->deleteOnboardingItemsMapping($deleteOnboardingChecklistIds);
	}

	$this->redirect(array('showAllOnboardingChecklistTemplates'));
    }

    public function actionQueryForOnboardingItemDetails() {
	if (isset($_POST['ajax']) && $_POST['ajax'] === 'onboardingChecklistTemplateForm' && Yii::app()->request->isAjaxRequest) {
	    $header = Yii::t('app', 'Add new Onboarding Checklist Template');
	    $formAction = $this->createUrl('onboarding/saveOnboardingChecklistTemplate');
	    $onboardingItemTitleArrRecord = OnboardingChecklistItem::model()->queryForOnboardingItemTitles();

	    $onboardingItemId = $this->getParam('onboardingItemDropdown');
	    $onboardingItemCondition = 'id = ' . $onboardingItemId;

	    $onboardingItemArrRecords = OnboardingChecklistItem::model()->findAll($onboardingItemCondition);

	    $aResult = [];
	    $aResult['result'] = 0;
	    $aResult['content'] = '';
	    $aResult['msg'] = '';

	    $aResult['content'] = $this->renderPartial('onboardingChecklistTemplateDetails', ['onboardingItemArrRecords' => $onboardingItemArrRecords, 'header' => $header, 'formAction' => $formAction, 'onboardingItemTitleArrRecord' => $onboardingItemTitleArrRecord], true);
	}
    }

    public function actionSaveOnboardingChecklistTemplate() {
	$onboardingChecklistTemplateObjModel = new OnboardingChecklistTemplate;
	$onboardingChecklistTemplateObjModel->title = $this->getParam('templateTitle', '');
	$onboardingChecklistTemplateObjModel->description = $this->getParam('templateDescription', '');
	$onboardingChecklistTemplateObjModel->created_by = Yii::app()->user->id;
	$onboardingChecklistTemplateObjModel->save();

	$arrayKeys = array_keys($_POST);

	foreach ($arrayKeys as $arrayKey) {
	    $match = preg_match('%onboardingItemDropdown%', $arrayKey);
	    if ($match != null && $this->getParam($arrayKey, '') != null) {
		$onboardingItemMappingObjModel = new OnboardingChecklistItemsMapping;
		$onboardingItemMappingObjModel->checklist_item_id = $this->getParam($arrayKey, '');
		$onboardingItemMappingObjModel->checklist_template_id = $onboardingChecklistTemplateObjModel->id;
		$onboardingItemMappingObjModel->save();
	    }
	}

	$this->redirect(array('showAllOnboardingChecklistTemplates'));
    }

    public function actionViewSelectedOnboardingChecklistTemplate($id) {
	$templateId = $this->getParam('id', '', '', 'get');
	$onboardingTemplateItemCondition = 'id = ' . $templateId;
	$onboardingItemTitleArrRecord = OnboardingChecklistItem::model()->queryForOnboardingItemTitles();

	$onboardingItemArrRecord = OnboardingChecklistItem::model()->findAllOnboardingItemsInTemplate($templateId);

	$onboardingTemplateObjRecord = OnboardingChecklistTemplate::model()->find($onboardingTemplateItemCondition);
	$formAction = $this->createUrl('onboarding/updateOnboardingChecklistTemplate');

	$header = Yii::t('app', 'Onboarding Checklist Template');
	$breadcrumbTop = Yii::t('app', 'Edit Onboarding Checklist Template');
	$title = Yii::t('app', 'Edit onboarding checklist template');
	$widgetTitle = Yii::t('app', 'Edit onboarding checklist template');
	$buttonShortTitle = Yii::t('app', 'Update');
	$buttonClass = Yii::t('app', 'updateOnboardingChecklistTemplateButton');
	$buttonTitle = Yii::t('app', 'Update this template');

	if (isset($_POST['ajax']) && $_POST['ajax'] === 'onboardingChecklistTemplateForm' && Yii::app()->request->isAjaxRequest) {
	    $aResult = [];
	    $aResult['result'] = 0;
	    $aResult['content'] = '';
	    $aResult['msg'] = '';

	    $onboardingItemId = $this->getParam('onboarding_item_id');
	    //put in the new function to find onboarding item details here
	    $selectedOnboardingItem = OnboardingChecklistItem::model()->findOnboardingItemDetails($onboardingItemId);
	    $aResult['description'] = $selectedOnboardingItem[0]['description'];
	    $aResult['department_owner'] = $selectedOnboardingItem[0]['department_owner'];
	    $aResult['is_offboarding_item'] = $selectedOnboardingItem[0]['is_offboarding_item'];

	    if (!empty($aResult['content'])) {
		$aResult['result'] = 1;
	    }
	    echo(json_encode($aResult));
	    Yii::app()->end();
	}

	if ($onboardingTemplateObjRecord == null) {
	    throw new CHttpException(404, 'Onboarding checklist template does not exist with the requested id.');
	}

	$this->render('onboardingChecklistTemplateDetails', array('header' => $header, 'formAction' => $formAction, 'onboardingTemplateObjRecord' => $onboardingTemplateObjRecord,
	    'onboardingItemArrRecord' => $onboardingItemArrRecord, 'breadcrumbTop' => $breadcrumbTop, 'title' => $title,
	    'widgetTitle' => $widgetTitle, 'buttonShortTitle' => $buttonShortTitle, 'templateId' => $templateId,
	    'onboardingItemTitleArrRecord' => $onboardingItemTitleArrRecord, 'buttonClass' => $buttonClass, 'buttonTitle' => $buttonTitle));
    }

    public function actionCheckOnboardingItemExistInTemplate($id) {
	$aResult['result'] = false;
	if (Yii::app()->request->isAjaxRequest) {
	    $queryString = $id;
	    $queryResult = OnboardingChecklistTemplateEnum::ONBOARDING_CHECKLIST_TEMPLATE_TITLE;
	    $columnName = OnboardingChecklistTemplateEnum::ONBOARDING_CHECKLIST_ITEM_ID;

	    $onboardingChecklistTemplateTitle = OnboardingChecklistItemsMapping::model()->queryForOnboardingTemplateInformation($queryString, $queryResult, $columnName);

	    $aResult['result'] = $onboardingChecklistTemplateTitle;
	}
	echo(json_encode($aResult));
	Yii::app()->end();
    }

}
