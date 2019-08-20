var RegistrationShowAllHiresForOnboarding = function(){
	function _view_selected_onboarding_checklist(objElement, objEvent){
		$('#hire-list').attr('action', $(objElement).attr('data-view-url')).submit();
		// $('#candidate-list').attr('action', $(objElement).attr('data-view-url')).submit();
	}

	function _init(){
		$(function() {
			$('input[name=editChecklistButton]').on('click', function(objEvent){
				RegistrationShowAllHiresForOnboarding.view_selected_onboarding_checklist(this,objEvent);
			});

			$("#label_filter").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#data_table tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
			});
		});
	}

	return {
		init : _init,
		view_selected_onboarding_checklist : _view_selected_onboarding_checklist
	}

}();
RegistrationShowAllHiresForOnboarding.init();