var AdminShowAllDepartments = function() {

	function _check_if_deletion_is_selected(objElement, objEvent){
		if ($(".deleteCheckBox:checked").length <= 0){
			alert($('#msg-select-department-delete').attr('data-msg'));
		} else {
			if (confirm($('#msg-confirm-department-delete').attr('data-msg'))){
				$('#departments-list').attr('action', $(objElement).attr('data-delete-url')).submit();
			}
		}
	}

	function _init(){
		$(function() {
			$('#deleteDepartmentButton').on('click', function(objEvent){
				AdminShowAllDepartments.check_if_deletion_is_selected(this, objEvent);
			});
		});
	}

	return {
		init : _init,
		check_if_deletion_is_selected : _check_if_deletion_is_selected
	}

}();
AdminShowAllDepartments.init();