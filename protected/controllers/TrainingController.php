<?php

class TrainingController extends Controller {

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

    public function actionAddNewHire() {
	$objModel = new EmploymentNewHire;

	$arrRecords = EmploymentCandidate::model()->findAll(array('order' => 'id ASC'));

	return $this->render("addNewHire", array('objModel' => $objModel, 'arrRecords' => $arrRecords));
    }

    public function actionShowAllTrainingItems() {
	$pageType = TrainingItemEnum::TRAINING_ITEM;
	$strSortKey = $this->getParam('sort_key', '');

	$objPagination = self::getStrSortByList($strSortKey, TrainingItemEnum::TRAINING_ITEM_TABLE, false, CommonEnum::RETURN_PAGINATION);
	$trainingItemArr = self::getStrSortByList($strSortKey, TrainingItemEnum::TRAINING_ITEM_TABLE, TrainingItemEnum::TRAINING_ITEM_TABLE_IN_SQL, CommonEnum::RETURN_TABLE_ARRAY_BY_SQL);

	if (isset($_POST['ajax']) && $_POST['ajax'] === 'trainingitems-list' && Yii::app()->request->isAjaxRequest) {
	    $aResult = [];
	    $aResult['result'] = 0;
	    $aResult['content'] = '';
	    $aResult['msg'] = '';

	    $aResult['content'] = $this->renderPartial('showAllTrainingItems', ['strSortKey' => $strSortKey, 'objPagination' => $objPagination, 'trainingItemArr' => $trainingItemArr, 'pageType' => $pageType], true);

	    if (!empty($aResult['content'])) {
		$aResult['result'] = 1;
	    }
	    echo(json_encode($aResult));
	    Yii::app()->end();
	}
	return $this->render('showAllTrainingItems', array('strSortKey' => $strSortKey, 'objPagination' => $objPagination, 'trainingItemArr' => $trainingItemArr, 'pageType' => $pageType));
    }

    private function getStrSortByList($strSortKey, $tableName, $tableNameInSql = false, $pageVar) {
	$strSortBy = self::getStrSortBy($strSortKey, $tableName);
	//for use in one table cases
	$order = $strSortBy;

	if ($_POST == false && !isset($_POST["sort_key"])) {
	    $order = 'created_date DESC';
	}

	if ($_POST != false && $_POST["sort_key"] == false) {
	    $order = 'created_date DESC';
	}

	$objCriteria = new CDbCriteria();
	$objCriteria->order = $order;
	//for filtering purposes
	$objCriteria->condition = self::getObjCriteria($tableName);

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

	    //for tables where we need to massage the data (inner join)
	    case CommonEnum::RETURN_TABLE_ARRAY_BY_SQL:
		$filter = false;
		switch ($tableNameInSql) {
		    case TrainingItemEnum::TRAINING_ITEM_TABLE_IN_SQL:
			$numPerPage = Yii::app()->params['numPerPage'];
			return TrainingItem::model()->selectAllTrainingItems($strSortBy, $intPage, $numPerPage);
			break;
		    case TrainingTemplateEnum::TRAINING_TEMPLATE_TABLE_IN_SQL:
			$numPerPage = Yii::app()->params['numPerPage'];
			if (isset($_POST['label_filter']) && $_POST['label_filter'] != false) {
			    $filter = 'TT.title LIKE "%' . $this->getParam('label_filter', '') . '%"';
			}
			return TrainingTemplate::model()->selectAllTrainingTemplates($strSortBy, $intPage, $numPerPage, true, $filter);
			break;
		}
		break;
	}
    }

    private static function getStrSortBy($strSortKey, $tableName) {
	switch ($tableName) {
	    case TrainingItemEnum::TRAINING_ITEM_TABLE:
		return self::getTrainingItemList($strSortKey);
		break;
	    case TrainingTemplateEnum::TRAINING_TEMPLATE_TABLE:
		return self::getTrainingTemplateList($strSortKey);
		break;
	}
    }

    private static function getTrainingItemList($strSortKey) {
	switch ($strSortKey) {
	    case 'sort_title_desc':
		return 'title DESC';
		break;
	    case 'sort_title_asc':
		return 'title ASC';
		break;
	    case 'sort_description_desc':
		return 'description DESC';
		break;
	    case 'sort_description_asc':
		return 'description ASC';
		break;
	    case 'sort_status_desc':
		return 'status DESC';
		break;
	    case 'sort_status_asc':
		return 'status ASC';
		break;
	}
    }

    private static function getTrainingTemplateList($strSortKey) {
	switch ($strSortKey) {
	    case 'sort_title_desc':
		return 'title DESC';
		break;
	    case 'sort_title_asc':
		return 'title ASC';
		break;
	    case 'sort_description_desc':
		return 'description DESC';
		break;
	    case 'sort_description_asc':
		return 'description ASC';
		break;
	    case 'sort_department_desc':
		return 'department DESC';
		break;
	    case 'sort_department_asc':
		return 'department ASC';
		break;
	}
    }

    private static function getObjCriteria($tableName) {
	if (array_key_exists('label_filter', $_POST) && $_POST['label_filter'] != null) {
	    switch ($tableName) {
		case TrainingItemEnum::TRAINING_ITEM_TABLE:
		    return 'title LIKE "%' . $_POST['label_filter'] . '%"';
		    break;
	    }
	}
    }

    public function actionAddNewTrainingItem() {
	$breadcrumbTop = Yii::t('app', 'Add New Training Item');
	$title = Yii::t('app', 'Add new training item');
	$buttonTitle = Yii::t('app', 'Save');
	$adminArr = Admin::model()->findAll();
	$formAction = $this->createUrl('training/saveTrainingItem');

	return $this->render('trainingItemDetails', array('breadcrumbTop' => $breadcrumbTop, 'title' => $title,
		'buttonTitle' => $buttonTitle, 'adminArr' => $adminArr, 'formAction' => $formAction));
    }

    public function actionSaveTrainingItem() {
	$trainingItemObjModel = new TrainingItem;
	$trainingItemObjModel->title = $this->getParam('trainingItemTitle', '');
	$trainingItemObjModel->description = $this->getParam('trainingItemDescription', '');
	$trainingItemObjModel->responsibility = $this->getParam('responsibilityDropdown', '');
	$trainingItemObjModel->status = $this->getParam('isActiveCheckbox', '');
	$trainingItemObjModel->created_by = Yii::app()->user->id;
	$trainingItemObjModel->save();

	if ($trainingItemObjModel->save()) {
	    $this->redirect(array('showAllTrainingItems'));
	}
    }

    public function actionViewSelectedTrainingItem() {
	$breadcrumbTop = Yii::t('app', 'Edit Training Item');
	$title = Yii::t('app', 'Edit Training Item');
	$buttonTitle = Yii::t('app', 'Update this item');
	$formAction = $this->createUrl('training/updateTrainingItem');

	$trainingItemId = $this->getParam('id', '', '', 'get');
	$trainingItemCondition = 'id = ' . $trainingItemId;
	$trainingItemObjRecord = TrainingItem::model()->find($trainingItemCondition);
	$adminArr = Admin::model()->findAll();

	if ($trainingItemObjRecord == null) {
	    throw new CHttpException(404, 'Training item does not exist with the requested id.');
	}
	return $this->render('trainingItemDetails', array('breadcrumbTop' => $breadcrumbTop, 'title' => $title, 'buttonTitle' => $buttonTitle,
		'adminArr' => $adminArr, 'formAction' => $formAction, 'trainingItemObjRecord' => $trainingItemObjRecord
	));
    }

    public function actionUpdateTrainingItem() {
	$id = $this->getParam('trainingItemId', '');
	$trainingItemCondition = 'id = ' . $id;

	$status = $this->getParam('isActiveCheckbox', '');

	if ($this->getParam('isActiveCheckbox', '') == null) {
	    $status = 0;
	}

	TrainingItem::model()->updateAll(array(
	    'title' => $this->getParam('trainingItemTitle', ''), 'description' => $this->getParam('trainingItemDescription', ''),
	    'responsibility' => $this->getParam('responsibilityDropdown', ''), 'status' => $this->getParam('isActiveCheckbox', ''),
	    'modified_by' => Yii::app()->user->id
	    ), $trainingItemCondition);

	$this->redirect(array('showAllTrainingItems'));
    }

    public function actionDeleteTrainingItem() {
	$deleteTrainingItemIds = $this->getParam('deleteCheckBox', '');

	if ($deleteTrainingItemIds != '') {
	    TrainingItem::model()->deleteTrainingItem($deleteTrainingItemIds);
	}

	$this->redirect(array('showAllTrainingItems'));
    }

    public function actionAddNewTrainingTemplate() {
	$header = Yii::t('app', 'Add new Training Template');
	$formAction = $this->createUrl('training/saveTrainingTemplate');
	$buttonShortTitle = Yii::t('app', 'Save');
	$buttonClass = Yii::t('app', 'saveTrainingTemplateButton');
	$buttonTitle = Yii::t('app', 'Save this template');

	$trainingItemTitleArrRecord = TrainingItem::model()->queryForTrainingItemTitles();
	$departmentId = 'id';
	$departmentCondition = DepartmentEnum::DEPARTMENT_TITLE . ',' . $departmentId;
	$departmentArr = Department::model()->queryForDepartmentDetails($departmentCondition);
	$trainingTemplateDepartment = '';
	$trainingTemplateObjRecord = false;

	if (isset($_POST['ajax']) && $_POST['ajax'] === 'trainingTemplateForm' && Yii::app()->request->isAjaxRequest) {
	    $aResult = [];
	    $aResult['result'] = 0;
	    $aResult['content'] = '';
	    $aResult['msg'] = '';

	    //comes from ajax
	    $condition = 'TI.id = ' . $this->getParam('training_item_id');
	    //put in the new function to find training item details here
	    $selectedTrainingItem = TrainingItem::model()->findTrainingItemDetails($condition, false);
	    $aResult['description'] = $selectedTrainingItem[0]['description'];
	    $aResult['responsibility'] = $selectedTrainingItem[0]['responsibility'];

	    if (!empty($aResult['content'])) {
		$aResult['result'] = 1;
	    }
	    echo(json_encode($aResult));
	    Yii::app()->end();
	}

	$this->render('trainingTemplateDetails', array('header' => $header, 'formAction' => $formAction, 'trainingItemTitleArrRecord' => $trainingItemTitleArrRecord,
	    'buttonShortTitle' => $buttonShortTitle, 'buttonClass' => $buttonClass, 'buttonTitle' => $buttonTitle, 'departmentArr' => $departmentArr,
	    'trainingTemplateDepartment' => $trainingTemplateDepartment, 'trainingTemplateObjRecord' => $trainingTemplateObjRecord
	));
    }

    public function actionShowAllTrainingTemplates() {
	$pageType = TrainingTemplateEnum::TRAINING_TEMPLATE;
	$strSortKey = $this->getParam('sort_key', '');

	$objPagination = self::getStrSortByList($strSortKey, TrainingTemplateEnum::TRAINING_TEMPLATE_TABLE, false, CommonEnum::RETURN_PAGINATION);
	$trainingTemplateArr = self::getStrSortByList($strSortKey, TrainingTemplateEnum::TRAINING_TEMPLATE_TABLE, TrainingTemplateEnum::TRAINING_TEMPLATE_TABLE_IN_SQL, CommonEnum::RETURN_TABLE_ARRAY_BY_SQL);

	if (isset($_POST['ajax']) && $_POST['ajax'] === 'trainingtemplates-list' && Yii::app()->request->isAjaxRequest) {
	    $aResult = [];
	    $aResult['result'] = 0;
	    $aResult['content'] = '';
	    $aResult['msg'] = '';

	    $aResult['content'] = $this->renderPartial('showAllTrainingTemplates', ['strSortKey' => $strSortKey, 'objPagination' => $objPagination, 'trainingTemplateArr' => $trainingTemplateArr, 'pageType' => $pageType], true);

	    if (!empty($aResult['content'])) {
		$aResult['result'] = 1;
	    }
	    echo(json_encode($aResult));
	    Yii::app()->end();
	}
	return $this->render('showAllTrainingTemplates', array('strSortKey' => $strSortKey, 'objPagination' => $objPagination, 'trainingTemplateArr' => $trainingTemplateArr, 'pageType' => $pageType));
    }

    public function actionDeleteTrainingTemplates() {
	//delete from training_template and also training_template_mapping table
	$deleteTrainingTemplateIds = $this->getParam('deleteCheckBox', '');

	if ($deleteTrainingTemplateIds != '') {
	    //need to delete training_items_mapping as well
	    TrainingItemsMapping::model()->deleteTrainingItemMappings($deleteTrainingTemplateIds);
	    TrainingTemplatesMapping::model()->deleteTrainingTemplateMappings($deleteTrainingTemplateIds);
	    TrainingTemplate::model()->deleteTrainingTemplates($deleteTrainingTemplateIds);
	}

	$this->redirect(array('showAllTrainingTemplates'));
    }

    public function actionSaveTrainingTemplate() {
	$arrayKeys = array_keys($_POST);
	
	$trainingTemplateObjModel = new TrainingTemplate;
	$trainingTemplateObjModel->title = $this->getParam('templateTitle', '');
	$trainingTemplateObjModel->description = $this->getParam('templateDescription', '');
	$trainingTemplateObjModel->created_by = Yii::app()->user->id;
	$trainingTemplateObjModel->modified_by = Yii::app()->user->id;
	$trainingTemplateObjModel->save();

	$departmentIds = $this->getParam('department', '');

	foreach ($departmentIds as $departmentId) {
	    $trainingTemplatesMappingObjModel = new TrainingTemplatesMapping;
	    $trainingTemplatesMappingObjModel->training_template_id = $trainingTemplateObjModel->id;
	    $trainingTemplatesMappingObjModel->department_id = $departmentId;
	    $trainingTemplatesMappingObjModel->save();
	}

	foreach ($arrayKeys as $arrayKey) {
	    $match = preg_match('%trainingItemDropdown%', $arrayKey);
	    if ($match != null && $this->getParam($arrayKey, '') != null) {
		$trainingItemsMappingObjModel = new TrainingItemsMapping;
		$trainingItemsMappingObjModel->training_item_id = $this->getParam($arrayKey, '');
		$trainingItemsMappingObjModel->training_template_id = $trainingTemplateObjModel->id;
		$trainingItemsMappingObjModel->save();
	    }
	}
	
	$this->redirect(array('showAllTrainingTemplates'));
    }
    
    public function actionViewSelectedTrainingTemplate(){
	$header = Yii::t('app', 'Edit Training Template');
	$formAction = $this->createUrl('training/updateTrainingTemplate');
	$buttonShortTitle = Yii::t('app', 'Update');
	$buttonClass = Yii::t('app', 'updateTrainingTemplateButton');
	$buttonTitle = Yii::t('app', 'Update this template');
	$templateId = $this->getParam('id', '', '', 'get');
	
	$trainingItemTitleArrRecord = TrainingItem::model()->queryForTrainingItemTitles();
	$departmentId = 'id';
	$departmentCondition = DepartmentEnum::DEPARTMENT_TITLE . ',' . $departmentId;
	$departmentArr = Department::model()->queryForDepartmentDetails($departmentCondition);
	
	$trainingTemplateId = $this->getParam('id', '', '', 'get');
	$trainingTemplateCondition = 'TT.id = ' . $trainingTemplateId;
	$trainingTemplateObjRecord = TrainingTemplate::model()->selectAllTrainingTemplates(false, false, false, false, $trainingTemplateCondition);
	
	$conditionForTrainingItemsInTemplate = 'TIM.training_template_id = ' . $trainingTemplateId;
	
	$trainingItemsInTemplate = TrainingItem::model()->findTrainingItemDetails($conditionForTrainingItemsInTemplate, true);

	if (isset($_POST['ajax']) && $_POST['ajax'] === 'trainingTemplateForm' && Yii::app()->request->isAjaxRequest){
	    $aResult = [];
	    $aResult['result'] = 0;
	    $aResult['content'] = '';
	    $aResult['msg'] = '';
	    
	    $condition = 'TI.id = ' . $this->getParam('training_item_id');
	    $selectedTrainingItem = TrainingItem::model()->findTrainingItemDetails($condition, false);
	    
	    $aResult['title'] = $selectedTrainingItem[0]['title'];
	    $aResult['description'] = $selectedTrainingItem[0]['description'];
	    $aResult['responsibility'] = $selectedTrainingItem[0]['responsibility'];
	    if (!empty($aResult['content'])) {
		$aResult['result'] = 1;
	    }
	    echo(json_encode($aResult));
	    Yii::app()->end();
	}
	
	if ($trainingTemplateObjRecord == null) {
	    throw new CHttpException(404, 'Training template does not exist with the requested id.');
	}
	
	$this->render('trainingTemplateDetails', array('header'=>$header, 'formAction'=>$formAction, 'buttonShortTitle'=>$buttonShortTitle, 
	    'buttonClass'=>$buttonClass, 'buttonTitle'=>$buttonTitle, 'trainingItemTitleArrRecord'=>$trainingItemTitleArrRecord, 
	    'departmentArr'=>$departmentArr, 'trainingTemplateObjRecord'=>$trainingTemplateObjRecord[0], 'templateId'=>$templateId,
	    'trainingItemsInTemplate'=>$trainingItemsInTemplate
	));
    }
    
    public function actionCheckTrainingItemExistInTemplate($id) {
	$aResult['result'] = false;
	if(Yii::app()->request->isAjaxRequest){
	    $queryString = $id;
	    $aResult['result'] = TrainingItemsMapping::model()->queryForTrainingTemplateInformation($queryString);
	}
	echo(json_encode($aResult));
	Yii::app()->end();
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
