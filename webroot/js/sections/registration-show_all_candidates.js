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

	function _get_candidate_form(objElement, objEvent){
		var strUrl = objElement.attr('rel');
		var arrParams = convert_url_to_array(strUrl);
		var strLang = '';
		var intId = 0;

		if(typeof(arrParams['lang']) != 'undefined'){
			strLang = arrParams['lang'];
		}

		if(typeof(arrParams['id']) != 'undefined'){
			intId = arrParams['id'];
		}

		$.ajax({
			type: 'post',
			url: strUrl,
			data: {
				ajax : 'candidate-form',
				id   : intId
			},
			dataType: 'json',
			success: function(data){
				if(data != null && data.result == 1 && data.content !=''){
					Project.hide_loading();

					var objContentElement = $('#main_content .main_content_wrapper');

					objContentElement.html('');
					objContentElement.append(data.content);
					$($('body')[0]).attr('id', 'candidate-form');

					Project.set_leftnav_active_item(objElement);
					Project.init_common_button();
					Project.init_enter_submit();
					EmploymentCandidate.init();
				} else if (data != null && data.msg != ''){
					Project.popup_error(data.msg);
				} else {
					Project.popup_error($('#common-msg .msg_operation_failed').attr('rel'));
				}
			},
			beforeSend: function(){
				Project.show_loading();
			},
			complete: function(){
				Project.hide_loading();
			},
			error: function(request, status, err){
				Project.popup_ajax_error(request, status, err);
			}
		});
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

		  $('.btnGetCandidateForm').unbind('click').click(function(objEvent){
		  	Registration.get_candidate_form($(this), objEvent);
		  });
		});
	}

  return {
  	init : _init,
  	check_if_deletion_is_selected : _check_if_deletion_is_selected,
  	get_candidate_form : _get_candidate_form
  }

}();
RegistrationShowAllCandidates.init();