var RegistrationShowAllJobOpenings = function() {
	function _copy_link(objElement, objEvent){
		if($(objElement).val() != ''){
			$.ajax({
				type: 'post',
				url: $(objElement).attr('data-url'),
				data: {
					job_opening_id : $(objElement).val()
				},
				dataType: 'json',
				success: function(data){
					if((typeof data.result) !== 'undefined'){
						var link = 'http://portal.sagaos.com/registration?JT=' + data.result;
						var tempInput = document.createElement("input");
				    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
				    tempInput.value = link;
				    document.body.appendChild(tempInput);
				    tempInput.select();
				    document.execCommand("copy");
				    document.body.removeChild(tempInput);
						alert('Link is copied! Please attach link to email and send to candidate');
					}
					else{
						alert('wrong');
					}
				},
				error: function(request, status, err){
					alert('wrong');
				}	
			});
		}
	}

	function _check_if_deletion_is_selected(objElement, objEvent){
		if ($(".deleteCheckBox:checked").length <= 0){
			alert($('#msg-select-registration-delete').attr('data-msg'));
		} else {
			if (confirm($('#msg-confirm-registration-delete').attr('data-msg'))){
				$('#jobopening-list').attr('action', $(objElement).attr('data-delete-url')).submit();
			}
		}
	}
	
	function _init(){
		$(function() {
			$('input#generateLink').on('click', function(objEvent) {
				RegistrationShowAllJobOpenings.copy_link(this, objEvent);
			});

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

	return {
		init : _init,
		copy_link : _copy_link,
		check_if_deletion_is_selected : _check_if_deletion_is_selected
	}
}();
RegistrationShowAllJobOpenings.init();