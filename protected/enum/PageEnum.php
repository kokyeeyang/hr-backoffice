<?php 

class PageEnum {
	const DEPARTMENT_ID = "id";
	const DEPARTMENT_TITLE = "title";
	const DEPARTMENT = "department";
	const DESCRIPTION = "Description";

	//New for Page Helper
	const FORM_DATA = array("Department" => 
											array(
												"entity-name" => "Department",
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
												"msg-select-delete" => "Please select a department that you would like to delete!"),
												"data-url" => "data-url=",
												"foreign-key-check" => "admin/checkAdminDepartmentExist",
												"msg-foreign-key-id" => "adminDepartmentExistAlert",
												"msg-foreign-key" => "Please delete the users belonging to this department first.",
												"model" => "",
												"column-details-query" => "",
												"column-details-example" => ""
											),

											"Offer Letter" => 
											array(
												"entity-name" => "Offer Letter",
												"breadcrumb-top" => "Show All Offer Letters",
												"breadcrumb-bottom" => "breadcrumb-bottom-key",
												"form-id" => "offerletter-list",
												"form-action-show-all" => "registration/showOfferLetterTemplates",
												"form-title" => "All Offer Letters",
												"form-action-add-new" => "registration/addNewOfferLetter",
												"add-new-record-title" => "Add new offer letter",
												"table-header" => array("File Name", "Department", "Managerial Role"),
												"form-action-delete-selected" => "registration/deleteSelectedOfferLetters",
												"form-action-view-selected" => "registration/viewSelectedOfferLetter",
												"column-link-to-details" => "offer_letter_title",
												"column-details" => array("department"),
												"data-url" => "",
												"foreign-key-check" => "",
												"msg-foreign-key-id" => "",
												"msg-foreign-key" => "",
												"model" => "EmploymentOfferLetterTemplates",
												"model-query-functions" => "queryForOfferLetterIsManagerial",
												"column-details-query" => "is_managerial",
												"column-details-example" => "EmploymentOfferLetterTemplates"
											)
										);
}