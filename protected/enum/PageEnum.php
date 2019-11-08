<?php 

class PageEnum {
	const DEPARTMENT_ID = "id";
	const DEPARTMENT_TITLE = "title";
	const DEPARTMENT = "department";
	const DESCRIPTION = "Description";

	//New for Page Helper
	const FORM_DATA = array("Department" => 
													array("entity-name" => "Department",
															"breadcrumb-top" => "Show All Departments",
															"breadcrumb-bottom" => "breadcrumb-bottom-key",

															"form-id" => "department-list-test",
															"form-action-show-all" => "admin/showAllDepartmentsTest",
															"form-title" => "All Departments",
															"form-action-add-new" => "admin/addNewDepartment",
															"add-new-record-title" => "Add new department",
															"table-header" => array("Department", "Description"),
															"form-action-delete-selected" => "admin/deleteSelectedDepartments",
															"form-action-view-selected" => "admin/viewSelectedDepartment",
															"column-link-to-details" => "title",
															"column-details" => array("description"),
															"alert-data-msg" => array(
																	"msg-confirm-delete" => "Are you sure that you want to delete the selected departments?",
																	"msg-select-delete" => "Please select a department that you would like to delete!")
														),

													"Users" => array()
													);
}