var RegistrationShowAllHiresForOnboarding = function(){
	function _view_selected_onboarding_checklist(objElement, objEvent){
		console.log('hello');
		$('#hire-list').attr('action', $(objElement).attr('data-view-url')).submit();
		// $('#candidate-list').attr('action', $(objElement).attr('data-view-url')).submit();
	}

	function _init(){
		$(function() {
			$('input[name=editChecklistButton]').on('click', function(objEvent){
				RegistrationShowAllHiresForOnboarding.view_selected_onboarding_checklist(this,objEvent);
			});
		});
	}

	return {
		init : _init,
		view_selected_onboarding_checklist : _view_selected_onboarding_checklist
	}

}();
RegistrationShowAllHiresForOnboarding.init();