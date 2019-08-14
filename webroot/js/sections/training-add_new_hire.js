var TrainingAddNewHire = function() {
	function _check_for_candidate_information(objElement, objEvent){
		if($(objElement).val() != ''){
			$.ajax({
				type: 'post',
				url: $(objElement).attr('data-url'),
				data: {
					information : $(objElement).val()
				}
				dataType: 'json',
				success: function(data){
					alert('correct');
				},
				error: function(request, status, err)
				{
					alert('wrong');
				}
			});
		}
	}

	function _init(){
		$(function() {
			$('input#candidateName').bind('click', function(objEvent) {
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