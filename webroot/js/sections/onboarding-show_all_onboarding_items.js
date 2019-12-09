var OnboardingShowAllOnboardingItems = function() {
	function _check_if_deletion_is_selected(objElement, objEvent){
		if ($(".deleteCheckBox:checked").length <= 0){
			alert($('#msg-select-delete').attr('data-msg'));
		} else {
			if (confirm($('#msg-confirm-delete').attr('data-msg'))){
				$('#onboardingitems-list').attr('action', $(objElement).attr('data-delete-url')).submit();
			}
		}
	}

	function _view_selected_onboarding_item(objElement, objEvent){
		$('#onboardingitems-list').attr('action', $(objElement).attr('data-view-url')).submit();
	}

	function _init() {
		$(function() {
			$('#deleteOnboardingItemButton').on('click', function(objEvent){
				OnboardingShowAllOnboardingItems.check_if_deletion_is_selected(this, objEvent);
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
  	check_if_deletion_is_selected : _check_if_deletion_is_selected,
	}

}();
OnboardingShowAllOnboardingItems.init();