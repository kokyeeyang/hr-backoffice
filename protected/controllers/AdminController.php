<?php

class AdminController extends Controller
{
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
    public function filters()
    {
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
	 * Lists all models.
	 */
	public function actionList()
	{
		$aResult 			= array();
		$aResult['result'] 	= 0;
		$aResult['content'] = '';
		$aResult['msg'] 	= '';
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-list' && Yii::app()->request->isAjaxRequest){
			$strSortKey			= $this->getParam('sort_key', '');
			$aResult['content'] = $this->getAdminList($strSortKey);
			
			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			}
		} // - end: if

		echo(json_encode($aResult));
		Yii::app()->end();
	}	

	/**
	 * Add a new model.
	 * If successful, the browser will be redirected to the 'list' page.
	 */
	public function actionAdd()
	{
		$aResult 			= array();
		$aResult['result'] 	= 0;	
		$aResult['content'] = '';
		$aResult['msg'] 	= '';
		$aResult['url'] 	= '';
		
		if(isset($_POST['ajax']) && Yii::app()->request->isAjaxRequest){
			$objModel = new Admin;
			
			if($_POST['ajax']==='submit-admin-form'){
				$strSortKey			= $this->getParam('sort_key', '');
				$strUsername 		= $this->getParam('admin_username', '', array('name' => Yii::t('app', 'Username'), 'minlen' => 3, 'maxlen' => 16));
				$strPassword 		= $this->getParam('admin_password', '', array('name' => Yii::t('app', 'Password'), 'minlen' => 6, 'maxlen' => 20));
				$strPasswordConfirm = $this->getParam('admin_password_confirm', '', array('name' => Yii::t('app', 'Confirm Password'), 'minlen' => 6, 'maxlen' => 20));
				$strDisplayName 	= $this->getParam('admin_display_name', '', array('name' => Yii::t('app', 'Name'), 'required' => true));
				$intStatus 			= (int)$this->getParam('admin_status', '', array('name' => Yii::t('app', 'Status'), 'required' => true));
				$strPriv 			= $this->getParam('admin_priv', '', array('name' => Yii::t('app', 'Privilege'), 'required' => true));
				$strDepartment 			= $this->getParam('admin_department', '', array('name' => Yii::t('app', 'Department'), 'required' => true));

				if(empty(Admin::$arrPriv[$strPriv])){
					$this->objError->addKeyError('admin_priv', Yii::t('app', 'Invalid privilege'));
				} // - end: if else
					
				if(!$error = $this->objError->getError()){
					
					if($strPassword === $strPasswordConfirm) {
						
						if(Admin::model()->checkUsernameExist($strUsername) === false){
							$objModel->attributes = array(
														'admin_username' 			=> $strUsername, 
														'admin_password' 			=> sha1($strPassword), 
														'admin_display_name' 		=> $strDisplayName, 
														'admin_status' 				=> $intStatus, 
														'admin_priv' 				=> $strPriv, 
														'admin_department' 				=> $strDepartment, 
														'admin_last_login' 			=> $this -> strCurrentDatetime,
														'admin_modified_datetime'	=> $this -> strCurrentDatetime,
														'admin_datetime'			=> $this -> strCurrentDatetime
													);
							
							if($objModel->save()){
								$aResult['content'] = $this->getAdminList($strSortKey);
								
								if(!empty($aResult['content'])){
									$aResult['result'] 	= 1;
									$aResult['msg'] 	= Yii::t('app', 'Saved Successfully');
								}
							}
							else{
								$aResult['msg'] = Yii::t('app', 'Operation Failed');
							} // - end: if else
						}
						else{
							$aResult['msg'] = Yii::t('app', 'Operation Failed') . '<br/>' . Yii::t('app', 'The username has already been taken!');
						} // - end: if else
					} 
					else {	
						$aResult['msg'] = Yii::t('app', 'Operation Failed') . '<br/>' . Yii::t('app', 'The confirm password is incorrect!');				
					}
				}
				else{
					$aResult['msg'] = Yii::t('app', 'Submit Failed') . '<br/>' . $error;	
				}
				echo(json_encode($aResult));
				Yii::app()->end();	
			}
			else{
				$objModel->admin_status = Admin::ACTIVE;
				
				$aResult['content'] = $this->renderPartial('add', array('objModel'=>$objModel), true);
			}
			
			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			} // - end: if
		} // - end: if

		echo(json_encode($aResult));
		Yii::app()->end();		
	}

	/**
	 * Updates a particular model.
	 * If successful, the browser will be redirected to the 'list' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($id)
	{
		$aResult 			= array();
		$aResult['result'] 	= 0;	
		$aResult['content'] = '';
		$aResult['msg'] 	= '';
		$aResult['url'] 	= '';
		
		if(isset($_POST['ajax']) && Yii::app()->request->isAjaxRequest){
			$intId			= (int)$id;
			$objModel 	= $this->loadModel($intId);
			
			if($_POST['ajax']==='submit-admin-form'){
				$strSortKey			= $this->getParam('sort_key', '');
				$strUsername 		= $this->getParam('admin_username', '', array('name' => Yii::t('app', 'Username'), 'minlen' => 3, 'maxlen' => 16));
				$strPassword 		= $this->getParam('admin_password', '', array('name' => Yii::t('app', 'Password')));
				$strPasswordConfirm = $this->getParam('admin_password_confirm', '', array('name' => Yii::t('app', 'Confirm Password')));
				$strDisplayName 	= $this->getParam('admin_display_name', '', array('name' => Yii::t('app', 'Name'), 'required' => true));
				$intStatus 			= (int)$this->getParam('admin_status', '', array('name' => Yii::t('app', 'Status'), 'required' => true));
				$strPriv 			= $this->getParam('admin_priv', '', array('name' => Yii::t('app', 'Privilege'), 'required' => true));
				$strDepartment 			= $this->getParam('admin_department', '', array('name' => Yii::t('app', 'Department'), 'required' => true));
				$intPasswordLength 	= strlen($strPassword);
				
				if($strPassword !== '' && ($intPasswordLength < 6 || $intPasswordLength > 20)){
					$this->objError->addKeyError('admin_password', Yii::t('app', 'Please re-enter your password'));
				}
				else if(empty(Admin::$arrPriv[$strPriv])){
					$this->objError->addKeyError('admin_priv', Yii::t('app', 'Invalid privilege'));
				} else if (empty(Department::model()->queryForDepartmentDetails())){
					$this->objError->addKeyError('admin_department', Yii::t('app', 'Invalid department'));
				}
				// - end: if else
							
				if(!$error = $this->objError->getError()){
					
					if($strPassword === $strPasswordConfirm) {
						
						if(Admin::model()->checkUsernameExist($strUsername, $intId) === false){
							$objModel-> admin_username 			= $strUsername;
							$objModel-> admin_display_name 		= $strDisplayName;
							$objModel-> admin_status 			= $intStatus;
							$objModel-> admin_priv 				= $strPriv;
							$objModel-> admin_department 				= $strDepartment;
							$objModel-> admin_modified_datetime = $this -> strCurrentDatetime;
							
							if($strPassword !== ''){
								$objModel-> admin_password = sha1($strPassword);		
							} // - end: if

							if($objModel->save()){
								
								if($intStatus == ADMIN::ACTIVE){
									Admin::resetLoginRetryTimes($strUsername);
								} // - end: if
								
								$aResult['content'] = $this->getAdminList($strSortKey);
								
								if(!empty($aResult['content'])){
									$aResult['result'] 	= 1;
									$aResult['msg'] 	= Yii::t('app', 'Saved Successfully');
								}
							}
							else{
								$aResult['msg'] = Yii::t('app', 'Operation Failed');
							} // - end: if else
						}
						else{
							$aResult['msg'] = Yii::t('app', 'Operation Failed') . '<br/>' . Yii::t('app', 'The username has already been taken!');
						} // - end: if else
					} 
					else {	
						$aResult['msg'] = Yii::t('app', 'Operation Failed') . '<br/>' . Yii::t('app', 'The confirm password is incorrect!');				
					}
				}
				else{
					$aResult['msg'] = Yii::t('app', 'Operation Failed') . '<br/>' . $error;	
				}
				echo(json_encode($aResult));
				Yii::app()->end();				
			}
			else{
				$objModel -> admin_password = '';
				$objModel -> admin_display_name = Validator::decodetag($objModel -> admin_display_name);
				$aResult['content'] = $this->renderPartial('edit', array('objModel'=>$objModel), true);
			}
			
			if(!empty($aResult['content'])){
				$aResult['result'] 	= 1;
			} // - end: if
		} // - end: if

		echo(json_encode($aResult));
		Yii::app()->end();			
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Admin the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{	$intId 		= (int)$id;
		$objModel	= Admin::model()->findByPk($intId);
		
		if($objModel===null){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $objModel;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Admin $model the model to be validated
	 */
	protected function performAjaxValidation($objModel)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-form')
		{
			echo CActiveForm::validate($objModel);
			Yii::app()->end();
		}
	}
	
	private function getAdminList($strSortKey){
		
		switch($strSortKey){
			case 'sort_modified_datetime_desc':
				$strSortBy = 'admin_modified_datetime DESC';
			break;
			
			case 'sort_modified_datetime_asc':
				$strSortBy = 'admin_modified_datetime ASC';
			break;
			
			case 'sort_last_login_desc':
				$strSortBy = 'admin_last_login DESC';
			break;
			
			case 'sort_last_login_asc':
				$strSortBy = 'admin_last_login ASC';
			break;
			
			case 'sort_login_retry_times_desc':
				$strSortBy = 'admin_login_retry_times DESC';
			break;
			
			case 'sort_login_retry_times_asc':
				$strSortBy = 'admin_login_retry_times ASC';
			break;
			
			case 'sort_status_desc':
				$strSortBy = 'admin_status DESC';
			break;
			
			case 'sort_status_asc':
				$strSortBy = 'admin_status ASC';
			break;
			
			case 'sort_display_name_desc':
				$strSortBy = 'admin_display_name DESC';
			break;
			
			case 'sort_display_name_asc':
				$strSortBy = 'admin_display_name ASC';
			break;
			
			case 'sort_username_desc':
				$strSortBy = 'admin_username DESC';
			break;
			
			case 'sort_username_asc':
			default:
				$strSortKey = 'sort_username_asc';
				$strSortBy 	= 'admin_username ASC';
			break;
		}
		
		$objCriteria		= new CDbCriteria();
		$objCriteria->order = $strSortBy;

		$intCount 		= Admin::model()->count($objCriteria);
		$objPagination	= new CPagination($intCount);
		$objPagination->setPageSize(Yii::app()->params['numPerPage']);
		$objPagination->setCurrentPage($this->intPage);
		$objPagination->applyLimit($objCriteria);
		$arrRecords		= Admin::model()->findAll($objCriteria);
				
		return $this->renderPartial('list', array('strSortKey' => $strSortKey, 'arrRecords'=>$arrRecords, 'objPagination'=>$objPagination), true);	
	}

	public function actionShowAllDepartments(){
		$departmentArr = Department::model()->findAll();

		$this->render('showAllDepartments', ['departmentArr' => $departmentArr]);
	}

	public function actionAddNewDepartment(){
		$formAction = $this->createUrl('admin/saveDepartment');
		$header = AdminEnum::ADD_DEPARTMENT;
		$buttonTitle = AdminEnum::SAVE_BUTTON;
		$departmentTitle = '';
    $departmentDescription = '';

		$this->render('departmentDetails', ['formAction'=>$formAction, 'header'=>$header, 'buttonTitle'=>$buttonTitle, 'departmentTitle'=>$departmentTitle, 'departmentDescription'=>$departmentDescription]);
	}

	public function actionSaveDepartment(){

		$newDepartmentObjModel = new Department;
		$newDepartmentObjModel->department_title = strtoupper($this->getParam('newDepartment', ''));
		$newDepartmentObjModel->department_description = $this->getParam('departmentDescription', '');
		$newDepartmentObjModel->created_by = Yii::app()->user->id;
		$newDepartmentObjModel->save();

		$this->redirect('showAllDepartments');
	}

	public function actionViewSelectedDepartment($departmentId){
		$departmentCondition = 'id = "' . $departmentId . '"';
		$departmentArr = Department::model()->findAll($departmentCondition);
		$formAction = $this->createUrl('admin/updateDepartment', ['departmentId' => $departmentId]);
		$header = AdminEnum::EDIT_DEPARTMENT;
    $buttonTitle =  AdminEnum::UPDATE_BUTTON;
    $departmentTitle = $departmentArr[0]->department_title;
    $departmentDescription = $departmentArr[0]->department_description;
		
		$this->render('departmentDetails', ['departmentArr' => $departmentArr, 'departmentId' => $departmentId, 'formAction'=>$formAction, 'header'=>$header, 'buttonTitle'=>$buttonTitle, 'departmentTitle'=>$departmentTitle, 'departmentDescription'=>$departmentDescription]);
	}

	public function actionUpdateDepartment($departmentId){
		$departmentCondition = 'id = "' . $departmentId . '"';
		$departmentArr = Department::model()->findAll($departmentCondition);
		foreach($departmentArr as $departmentObj){
			$departmentObj->department_title = $this->getParam('newDepartment', '');
			$departmentObj->department_description = $this->getParam('departmentDescription', '');
			$departmentObj->update();
		}

		$this->redirect('showAllDepartments');
	}

	public function actionDeleteSelectedDepartments(){
		$departmentIds = $this->getParam('deleteCheckBox', '');

		if($departmentIds != ''){
			$deleteDepartment = Department::model()->deleteSelectedDepartment($departmentIds);
		}
		$this->redirect('showAllDepartments');
	}
}
