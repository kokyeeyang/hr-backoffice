var RegistrationShowAllCandidates = function() {
	function _check_if_deletion_is_selected(objElement, objEvent){
		if ($(".deleteCheckBox:checked").length <= 0){
			alert($('#msg-select-registration-delete').attr('data-msg'));
		} else {
			if (confirm($('#msg-confirm-registration-delete').attr('data-msg'))){
				$('#candidate-list').attr('action', $(objElement).attr('data-delete-url')).submit();
			}
		}
	}

	function _view_selected_candidate(objElement, objEvent){
		$('#candidate-list').attr('action', $(objElement).attr('data-view-url')).submit();
	}

	function _confirm_selected_candidate(objElement, objEvent){
		if (confirm($('#msg-confirm-candidate').attr('data-msg'))){
			$('#candidate-list').attr('action', $(objElement).attr('data-confirm-url')).submit();
		} else {
			return false;
		}
	}

	function _change_candidate_position(objElement, objEvent){
		if(confirm($('#msg-confirm-change').attr('data-msg'))){
			$('#candidate-list').attr('action', $('#changeCandidatePosition').attr('data-change-url')).submit();
		} else {
			return false;
		}
	}

	function _init() {
		$(function() {
			$('#deleteJobOpeningButton').on('click', function(objEvent){
				RegistrationShowAllCandidates.check_if_deletion_is_selected(this, objEvent);
			});

			$("#label_filter").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#data_table tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });

		  $('input[name=editCandidateButton]').on('click', function(objEvent){
		  	RegistrationShowAllCandidates.view_selected_candidate(this, objEvent);
		  });

		  // $('input[name=confirmCandidateButton]').on('click', function(objEvent){
		  // 	RegistrationShowAllCandidates.confirm_selected_candidate(this, objEvent);

		  // });

		  $('select[name="dropdown"]').change(function(objEvent) {
		    RegistrationShowAllCandidates.confirm_selected_candidate(this, objEvent);
			});

		  $('select[name="position-dropdown"]').change(function(objEvent) {
		    RegistrationShowAllCandidates.change_candidate_position(this, objEvent);
			});

		});
	}

  return {
  	init : _init,
  	check_if_deletion_is_selected : _check_if_deletion_is_selected,
  	view_selected_candidate : _view_selected_candidate,
  	confirm_selected_candidate : _confirm_selected_candidate,
  	change_candidate_position : _change_candidate_position
  }

}();
RegistrationShowAllCandidates.init();