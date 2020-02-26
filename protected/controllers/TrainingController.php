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

		switch ($tableNameInSql) {
		    case TrainingItemEnum::TRAINING_ITEM_TABLE_IN_SQL:
			$numPerPage = Yii::app()->params['numPerPage'];
			return TrainingItem::model()->selectAllTrainingItems($strSortBy, $intPage, $numPerPage);
			break;
		    case TrainingTemplateEnum::TRAINING_TEMPLATE_TABLE_IN_SQL:
			$numPerPage = Yii::app()->params['numPerPage'];
			return TrainingTemplate::model()->selectAllTrainingTemplates($strSortBy, $intPage, $numPerPage);
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
	    throw new CHttpException(404, 'Candidate does not exist with the requested id.');
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

	$this->redirect(array('showAllOnboardingItems'));
    }

    public function actionAddNewTrainingTemplate() {
	
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

    public function actionDeleteTrainingTemplate() {
	
    }

}
