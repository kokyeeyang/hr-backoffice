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
					if((typeof data.result) !== 'undefined' && data.result != false){
						alert(data.result['address']);
						$("#fullName").val(data.result['full_name']);
						$("#idNo").val(data.result['id_no']);
						$("#address").val(data.result['address']);
						$("#contactNo").val(data.result['contact_no']);
						$("#emailAddress").val(data.result['email_address']);
						$("#dateOfBirth").val(data.result['date_of_birth']);
						$("#gender").val(data.result['gender']);
						$("#maritalStatus").val(data.result['marital_status']);
						$("#nationality").val(data.result['nationality']);
					}
				},
				error: function(request, status, err)
				{
					alert(err);
				}
			});
		}
	}

	function _init(){
		$(function() {
			$('select#candidateName').on('change', function(objEvent) {
				TrainingAddNewHire.check_for_candidate_information(this, objEvent);
			});
		});
	}

	return {
		init : _init,
		check_for_candidate_information : _check_for_candidate_information
	}
}();
TrainingAddNewHire.init();