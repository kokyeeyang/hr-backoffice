var RegistrationShowAllCandidateStatus = function() {
	function _check_if_deletion_is_selected(objElement, objEvent){
		if ($(".deleteCheckBox:checked").length <= 0){
			alert($('#msg-select-registration-delete').attr('data-msg'));
		} else {
			if (confirm($('#msg-confirm-registration-delete').attr('data-msg'))){
				$('#candidatestatus-list').attr('action', $(objElement).attr('data-delete-url')).submit();
			}
		}
	}

	function _init(){
		$(function() {
		  $("#label_filter").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#data_table tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });
		  
  		$('#deleteJobOpeningButton').on('click', function(objEvent){
				RegistrationShowAllJobOpenings.check_if_deletion_is_selected(this, objEvent);
			});		  
		});
	}	
}