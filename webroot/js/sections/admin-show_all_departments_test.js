var AdminShowAllDepartmentsTest = function() {

	function _check_if_deletion_is_selected(objElement, objEvent){
		if ($(".deleteCheckBox:checked").length <= 0){
			alert($('#msg-select-delete').attr('data-msg'));
		} else {
			if (confirm($('#msg-confirm-delete').attr('data-msg'))){
				//one function to warn there users belonging to this department
				// $('#department-list-test').attr('action', $(objElement).attr('data-delete-department-url')).submit();

				$('#department-list-test').attr('action', $(objElement).attr('data-delete-url')).submit();
			}
		}
	}

	function _check_if_department_has_users(objElement, objEvent){
		if($(objElement).val() != '')
		{
			$.ajax({
				type: 'post',
				//pass in department id to query inside admin table
				url: $(objElement).attr('data-url')+'/'+$(objElement).val(),
				data: {
					department_id : $(objElement).val()
				},
				dataType: 'json',
				success: function(data)
				{
					if(data != null && data.result != false){
						alert('There are users belonging to your chosen department, please delete them first.');
						//uncheck the boxes for departments that still have users
						$('#deleteCheckBox' + $(objElement).val()).prop('checked', false);

					}else if(data != null && data.result == false){
					}
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
			$('#deleteDepartmentButton').on('click', function(objEvent){
				AdminShowAllDepartmentsTest.check_if_deletion_is_selected(this, objEvent);
			});

			$('.deleteCheckBox').change(function(objEvent) {
				if(this.checked){
					AdminShowAllDepartmentsTest.check_if_department_has_users(this, objEvent);
				}
			});

		  $("#label_filter").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#data_table tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });	
		  
		});
	}

	return {
		init : _init,
		check_if_deletion_is_selected : _check_if_deletion_is_selected,
		check_if_department_has_users : _check_if_department_has_users
	}

}();
AdminShowAllDepartmentsTest.init();