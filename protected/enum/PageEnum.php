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

												"form-id" => "department-list",
												"form-action-show-all" => "admin/showAllDepartments",
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
												"msg-foreign-key" => "Please delete the users belonging to this department first.",
												"column-details-query" => "",
												"column-details-model" => ""
											),

											"Offer Letter" => 
											array(
												"entity-name" => "OfferLetter",
												"breadcrumb-top" => "Show All Offer Letters",
												"breadcrumb-bottom" => "breadcrumb-bottom-key",
												"form-id" => "offerletter-list",
												"form-action-show-all" => "registration/showOfferLetterTemplates",
												"form-title" => "All Offer Letters",
												"form-action-add-new" => "registration/addNewOfferLetter",
												"add-new-record-title" => "Add new offer letter",
												"table-header" => array("offer_letter_title", "is_managerial"),
												"form-action-delete-selected" => "registration/deleteSelectedOfferLetters",
												"form-action-view-selected" => "registration/viewSelectedOfferLetter",
												"column-link-to-details" => "offer_letter_title",
												"column-details" => array(""),
												"alert-data-msg" => array(
												"msg-confirm-delete" => "Are you sure that you want to delete the selected offer letter templates?",
												"msg-select-delete" => "Please select a offer letter template that you would like to delete!"),
												"data-url" => "",
												"foreign-key-check" => "",
												"msg-foreign-key" => "",
												"model-query-functions" => "queryForOfferLetterIsManagerial",
												"column-details-query" => "is_managerial",
												"column-details-model" => "EmploymentOfferLetterTemplates"
											),

											"Job Opening" =>
											array(
												"entity-name" => "JobOpening",
												"breadcrumb-top" => "Show All Job Openings",
												"breadcrumb-bottom" => "breadcrumb-bottom-key",
												"form-id" => "jobopening-list",
												"form-action-show-all" => "registration/showAllJobOpenings",
												"form-title" => "All Job Openings",
												"form-action-add-new" => "registration/addNewJobOpenings",
												"add-new-record-title" => "Add new job opening",
												"table-header" => array("job_title", "department", "interviewing_manager", "created_date", "email"),
												"form-action-delete-selected" => "registration/deleteSelectedJobOpenings",
												"column-details" => array("job_title", "department", "interviewing_manager", "created_date"),
												"alert-data-msg" => array(
												"msg-confirm-delete" => "Are you sure that you want to delete the selected job openings?",
												"msg-select-delete" => "Please select a job opening that you would like to delete!"),
												"data-url" => "",
												"foreign-key-check" => "",
												"column-link-to-details" => "",
												"form-action-view-selected" => "",
												"msg-foreign-key" => "",
												"send-email-button-id" => "generateEmail",
												"data-email-url-tag" => "data-email-url=",
												"data-email-url" => "registration/generateEmail",
												"data-email-details" => array("id", "job_title"),
												"data-url" => "data-url=",
												"clickable-button-title" => "Generate Email",
												"foreign-key-check" => "registration/checkCandidateJobOpeningExist",
												"msg-foreign-key-id" => "candidateJobOpeningExist",
												"msg-foreign-key" => "Please delete the candidates under this job opening first.",
												"column-details-query" => "",
												"column-details-model" => ""
											)
										);
}