<?php

class RoleHelper {

    public static function GetRole($strController, $bolAuthenticated = false) {
	// set the action which guest can access
	$arrActionsList = ['login', 'captcha'];

	switch ($strController) {
	    case 'registration':
		// All users can access the registration controller
		$arrActionsList = array_merge($arrActionsList, ['index', 'addCandidate', 'saveCandidate']);

		if ($bolAuthenticated === true && isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin', 'manager', 'hr'])) {
		    // set the actions which only admin can access
		    $arrActionsList = array_merge($arrActionsList, ['showAllCandidates', 'addNewJobOpenings', 'saveJobOpenings',
			'showAllJobOpenings', 'deleteSelectedJobOpenings', 'generateLink',
			'generateEmail', 'deleteSelectedCandidates', 'viewSelectedCandidate',
			'updateSelectedCandidate', 'confirmCandidate', 'generateOfferEmail',
			'changeCandidateStatus', 'changeCandidateStatusToSigned', 'changeCandidatePosition',
			'showOfferLetterTemplates', 'saveOfferLetterTemplate', 'viewSelectedOfferLetter',
			'updateOfferLetterTemplate', 'downloadPdf', 'uploadOfferLetterImages',
			'searchAndReplaceTermsInOfferLetter', 'deleteSelectedOfferLetters', 'addNewOfferLetter',
			'checkCandidateJobOpeningExist', 'showAllCandidateStatus', 'addNewCandidateStatus',
			'saveCandidateStatus', 'deleteCandidateStatus'
		    ]);
		}
		break;

	    case 'site':
		if ($bolAuthenticated === true && isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin', 'manager', 'hr'])) {
		    // set the actions which only admin can access
		    $arrActionsList = array_merge($arrActionsList, ['index', 'welcome', 'logout', 'error']);
		}
		break;

	    case 'admin':
		if ($bolAuthenticated === true && isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin'])) {
		    // set the actions which only admin can access
		    $arrActionsList = array_merge($arrActionsList, ['list', 'add', 'edit',
			'showAllDepartments', 'addNewDepartment', 'saveDepartment',
			'viewSelectedDepartment', 'updateDepartment', 'deleteSelectedDepartments',
			'showAllDepartmentsTest', 'checkAdminDepartmentExist'
		    ]);
		}
		break;

	    case 'report':
		if ($bolAuthenticated === true && isset(Yii::app()->user->priv)) {

		    if (in_array(Yii::app()->user->priv, ['admin'])) {
			// set the actions which only admin can access
			$arrActionsList = array_merge($arrActionsList, ['getAdminActivityLogList']);
		    } else if (in_array(Yii::app()->user->priv, ['manager', 'hr'])) {
			// set the actions which only admin can access
			$arrActionsList = array_merge($arrActionsList, []);
		    }
		}
		break;

	    case 'training':
		if ($bolAuthenticated === true && isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin', 'manager', 'hr'])) {
		    // set the actions which only admin can access
		    $arrActionsList = array_merge($arrActionsList, ['showAllTrainingItems', 'deleteTrainingItems', 'viewSelectedTrainingItem',
			'addNewTrainingItem', 'updateTrainingItem', 'saveTrainingItem',
			'showAllTrainingTemplates', 'deleteTrainingTemplate', 'viewSelectedTrainingTemplate',
			'addNewTrainingTemplate', 'updateTrainingTemplate', 'saveTrainingTemplate'
		    ]);
		}
		break;

	    case 'onboarding':
		if ($bolAuthenticated === true && isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin', 'manager', 'hr'])) {
		    $arrActionsList = array_merge($arrActionsList, ['addNewOnboardingItem', 'saveOnboardingItem', 'showAllOnboardingItems',
			'viewSelectedOnboardingItem', 'deleteOnboardingItems', 'updateOnboardingItem',
			'showAllOnboardingChecklistTemplates', 'addNewOnboardingChecklistTemplate', 'updateOnboardingChecklistTemplate',
			'queryForOnboardingItemDetails', 'saveOnboardingChecklistTemplate',
			'viewSelectedOnboardingChecklistTemplate', 'CheckOnboardingItemExistInTemplate'
		    ]);
		}
		break;
	}
	return $arrActionsList;
    }

}

?>