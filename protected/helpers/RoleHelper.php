<?php
class RoleHelper {

	public static function GetRole($strController, $bolAuthenticated = false){
		// set the action which guest can access
		$arrActionsList = ['login', 'captcha'];

		switch($strController){
			case 'registration':
				// All users can access the registration controller
				$arrActionsList = array_merge($arrActionsList, ['index', 'addCandidate', 'saveCandidate']);

				if($bolAuthenticated === true && isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin', 'manager', 'hr'])){
					// set the actions which only admin can access
					$arrActionsList = array_merge($arrActionsList, ['showAllCandidates', 'addNewJobOpenings', 'saveJobOpenings', 'showAllJobOpenings', 'deleteSelectedJobOpenings', 'generateLink', 'generateEmail', 'deleteSelectedCandidates', 'viewSelectedCandidate', 'updateSelectedCandidate', 'confirmCandidate', 'generateOfferEmail']);
				}	
			break;

			case 'site':
				if($bolAuthenticated === true && isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin', 'manager', 'hr'])){
					// set the actions which only admin can access
					$arrActionsList = array_merge($arrActionsList, ['index', 'welcome', 'logout', 'error']);
				}
			break;
			
			case 'admin':
				if($bolAuthenticated === true && isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin'])){
					// set the actions which only admin can access
					$arrActionsList = array_merge($arrActionsList, ['list', 'add', 'edit']);
				}
			break;

			case 'report':
				if($bolAuthenticated === true && isset(Yii::app()->user->priv)){

					if(in_array(Yii::app()->user->priv, ['admin'])){
						// set the actions which only admin can access
						$arrActionsList = array_merge($arrActionsList, ['getAdminActivityLogList']);						
					}
					else if(in_array(Yii::app()->user->priv, ['manager', 'hr'])){
						// set the actions which only admin can access
						$arrActionsList = array_merge($arrActionsList,[]);				
					}
				}			
			break;	

			case 'training':
				if($bolAuthenticated === true && isset(Yii::app()->user->priv) && in_array(Yii::app()->user->priv, ['admin', 'manager', 'hr'])){
					// set the actions which only admin can access
					$arrActionsList = array_merge($arrActionsList, ['checkForCandidateInformation', 'addNewHire', 'saveNewHire', 'showAllHiresForOnboarding', 'viewSelectedHire', 'viewSelectedOnboardingChecklist', 'showTrainingSchedules', 'editOnboardingItems', 'saveOnboardingChecklist', 'saveOnboardingItems']);
				}
			break;
		}
		return $arrActionsList;
	}
}
?>