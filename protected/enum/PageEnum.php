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
															"form-title" => "All departments",

															"form-id" => "departments-list",
															"form-action-show-all" => "admin/showAllDepartments",
															"form-title" => "Departments List",
															"form-action-add-new" => "admin/addNewDepartment",
															"add-new-record-title" => "Add new department",
															"hidden-field-mode" => "department-list",
															"table-header" => array("Department", "Description"),
															"form-action-delete-selected" => "admin/deleteSelectedDepartments",
															"form-action-view-selected" => "admin/viewSelectedDepartment"
														),

													"Users" => array()
													);
}