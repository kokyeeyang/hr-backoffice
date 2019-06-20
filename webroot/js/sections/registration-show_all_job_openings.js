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

	function _generate_email(objElement, objEvent){
		if($(objElement).val() != ''){
			$.ajax({
				type: 'post',
				url: $(objElement).attr('data-email-url'),
				data: {
					job_opening_id : $(objElement).val(),
					job_title : $(objElement).val()
				},
				
				dataType: 'json',
				success: function(data){
					if(data != null && (typeof data.result) != 'undefined'){
						var link = $('#site_url').attr('rel') + 'registration?JT=' + data.result + '&token=' + data.token;
						var emailSubject = 'Interview Invitation for the position of ' + data.jobTitleResult + ' at Saga OS';
						var greeting = 'Hi ,';
						var emailBody1 = 'Thank you for showing interest in the abovementioned position.'

						window.location.href = "mailto:?" + "subject=" + emailSubject + "&body=" + greeting + "%0D%0A%0D%0A" 
						+ emailBody1 + "%0D%0A Please fill in the application form in the link below before attending the interview at Saga OS." 
						+ "%0D%0A%0D%0A" + link + "%0D%0A";
						window.close(); 
					} else {
						alert('there is an error when generating the email.');
					} 
				},
				error: function(request, status, err){
					alert('something is wrong');
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

			$('input#generateEmail').on('click', function(objEvent) {
				RegistrationShowAllJobOpenings.generate_email(this, objEvent);
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
		generate_email : _generate_email,
		check_if_deletion_is_selected : _check_if_deletion_is_selected
	}
}();
RegistrationShowAllJobOpenings.init();