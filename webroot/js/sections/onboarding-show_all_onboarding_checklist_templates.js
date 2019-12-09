var OnboardingShowAllOnboardingChecklistTemplates = function(){
	function _check_if_deletion_is_selected(objElement, objEvent){
		if ($(".deleteCheckBox:checked").length <= 0){
			alert($('#msg-select-delete').attr('data-msg'));
		} else {
			if (confirm($('#msg-confirm-delete').attr('data-msg'))){
				$('#onboardingchecklisttemplates-list').attr('action', $(objElement).attr('data-delete-url')).submit();
			}
		}
	}

	function _view_selected_onboarding_item(objElement, objEvent){
		$('#onboardingchecklisttemplates-list').attr('action', $(objElement).attr('data-view-url')).submit();
	}	

	function _init() {
		$(function() {
			$('#deleteOnboardingChecklistTemplateButton').on('click', function(objEvent){
				OnboardingShowAllOnboardingChecklistTemplates.check_if_deletion_is_selected(this, objEvent);
			});
		});
	}

	return {
		init : _init,
  	check_if_deletion_is_selected : _check_if_deletion_is_selected
	}

}();
OnboardingShowAllOnboardingChecklistTemplates.init();