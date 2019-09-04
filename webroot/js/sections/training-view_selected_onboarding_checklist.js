var TrainingViewSelectedOnboardingChecklist = function() {
	function _save_checklist(objElement, objEvent){
		if (confirm($('#msg-confirm-candidate-save').attr('data-msg'))){
			$('#onboarding-checklist').attr('action', $(objElement).attr('data-save-url')).submit();
		} else {
			objEvent.preventDefault();
		}
	}

	function _init(){
		$(function() {
			$('#saveChecklistButton').on('click', function(objEvent){
				TrainingViewSelectedOnboardingChecklist.save_checklist(this, objEvent);
			});
		});
	}

	return {
		init : _init,
		save_checklist : _save_checklist
	}

}();
TrainingViewSelectedOnboardingChecklist.init();