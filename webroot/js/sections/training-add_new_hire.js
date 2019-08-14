var TrainingAddNewHire = function() {
	function _check_for_candidate_information(objElement, objEvent){
		var candidateName = $("#candidateName option:selected").val();

		if($(objElement).val() != ''){
			$.ajax({
				type: 'post',
				url: $(objElement).attr('data-url'),
				data: {
					candidateName : $(objElement).val()
				},
				dataType: 'json',
				success: function(data){
					alert($(objElement).attr('data-url'));
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
			$('select#candidateName').on('click', function(objEvent) {
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