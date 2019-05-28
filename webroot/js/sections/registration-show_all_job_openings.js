var RegistrationShowAllJobOpenings = function() {
	function _encode_job_opening_id(objElement, objEvent){
		if($(objElement).val() != ''){
			$.ajax({
				type: 'post',
				url: $(objElement).attr('data-url'),
				data: {
					job_opening_id : $(objElement).val()
				},
				dataType: 'json',
				success: function(data){
					alert(data);
				},
				error: function(request, status, err){
					alert('wrong');
				}	
			});
		}
	}

	function _init(){
		$(function() {
			$('input#generateLink').on('click', function(objEvent) {
				RegistrationShowAllJobOpenings._encode_job_opening_id(this, objEvent);
			});

		});
	}

	return {
		init : _init,
		encode_job_opening_id : _encode_job_opening_id
	}
}();
RegistrationShowAllJobOpenings.init();