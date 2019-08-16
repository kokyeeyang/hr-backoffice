var TrainingAddNewHire = function() {
	function _check_for_candidate_information(objElement, objEvent){
		var candidateName = $("#candidateName option:selected").val();

		if($(objElement).val() != ''){
			$.ajax({
				type: 'POST',
				url: $(objElement).attr('data-url'),
				data: {
					candidateName : $(objElement).val(),
				},
				dataType: 'json',
				success: function(data){
					if((typeof data.result) !== 'undefined' && data.result != false && data.result != ''){
						$("#fullName").val(data.result['full_name']);
						$("#idNo").val(data.result['id_no']);
						$("#address").val(data.result['address']);
						$("#contactNo").val(data.result['contact_no']);
						$("#emailAddress").val(data.result['email_address']);
						$("#dateOfBirth").val(data.result['date_of_birth']);
						$("#gender").val(data.result['gender']);
						$("#maritalStatus").val(data.result['marital_status']);
						$("#nationality").val(data.result['nationality']);
					} else if ((typeof data.result) === 'undefined' || data.result == false || data.result == ''){
						$("#fullName").val('');
						$("#idNo").val('');
						$("#address").val('');
						$("#contactNo").val('');
						$("#emailAddress").val('');
						$("#dateOfBirth").val('');
						$("#gender").val('');
						$("#maritalStatus").val('');
						$("#nationality").val('');						
					}
				},
				error: function(request, status, err)
				{
					alert(err);
				}
			});
		}
	}

	function _check_if_candidate_is_selected(objElement, objEvent){
		if($('#nationality').val() == ''){
			alert($('#msg-select-candidate-save').attr('data-msg'));
			objEvent.preventDefault();
		}else if($('#nationality').val() != ''){
			if (confirm($('#msg-confirm-candidate-save').attr('data-msg'))){
				$('form#newHireForm').submit();
			}else {
				objEvent.preventDefault();
			};
		}
	}

	function _init(){
		$(function() {
			$('select#candidateName').on('change', function(objEvent) {
				TrainingAddNewHire.check_for_candidate_information(this, objEvent);
			});

			$('#saveButton').on('click', function(objEvent) {
				TrainingAddNewHire.check_if_candidate_is_selected(this, objEvent);
			});
		});
	}

	return {
		init : _init,
		check_for_candidate_information : _check_for_candidate_information,
		check_if_candidate_is_selected : _check_if_candidate_is_selected
	}
}();
TrainingAddNewHire.init();																																																																																																					