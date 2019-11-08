var AdminShowAllDepartmentsTest = function() {

	function _check_if_deletion_is_selected(objElement, objEvent){
		if ($(".deleteCheckBox:checked").length <= 0){
			alert($('#msg-select-department-delete').attr('data-msg'));
		} else {
			if (confirm($('#msg-confirm-department-delete').attr('data-msg'))){
				//one function to warn there users belonging to this department
				// $('#department-list-test').attr('action', $(objElement).attr('data-delete-department-url')).submit();

				$('#department-list-test').attr('action', $(objElement).attr('data-delete-url')).submit();
			}
		}
	}

	function _init(){
		$(function() {
			$('#deleteDepartmentButton').on('click', function(objEvent){
				AdminShowAllDepartmentsTest.check_if_deletion_is_selected(this, objEvent);
			});
		});
	}

	return {
		init : _init,
		check_if_deletion_is_selected : _check_if_deletion_is_selected
	}

}();
AdminShowAllDepartmentsTest.init();