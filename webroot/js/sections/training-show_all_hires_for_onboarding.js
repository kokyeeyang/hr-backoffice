var RegistrationShowAllHiresForOnboarding = function(){
	function _view_selected_onboarding_checklist(objElement, objEvent){
		$('#hire-list').attr('action', $(objElement).attr('data-view-url')).submit();
	}

	function _init(){
		$(function() {
			$('input[name=editChecklistButton]').on('click', function(objEvent){
				RegistrationShowAllHiresForOnboarding.view_selected_onboarding_checklist(this,objEvent);
			});
		});
	}
}();
RegistrationShowAllHiresForOnboarding.init();