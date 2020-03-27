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
	    "breadcrumb-top" => "Departments List",
	    "breadcrumb-bottom" => "breadcrumb-bottom-gears",
	    "form-id" => "department-list",
	    "form-action-show-all" => "admin/showAllDepartments",
	    "form-action-add-new" => "admin/addNewDepartment",
	    "form-title" => "Department List",
	    "add-new-record-title" => "Create",
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
	    "breadcrumb-top" => "Offer Letters List",
	    "breadcrumb-bottom" => "breadcrumb-bottom-gears",
	    "form-id" => "offerletter-list",
	    "form-title" => "Offer Letter List",
	    "form-action-show-all" => "registration/showOfferLetterTemplates",
	    "form-action-add-new" => "registration/addNewOfferLetter",
	    "add-new-record-title" => "Add new offer letter",
	    "table-header" => array("offer_letter_title", "is_managerial", "department_title"),
	    "form-action-delete-selected" => "registration/deleteSelectedOfferLetters",
	    "form-action-view-selected" => "registration/viewSelectedOfferLetter",
	    "column-link-to-details" => "offer_letter_title",
	    "column-details" => array("is_managerial", "department_title"),
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
	    "breadcrumb-top" => "Job Openings List",
	    "breadcrumb-bottom" => "breadcrumb-bottom-people",
	    "form-id" => "jobopening-list",
	    "form-action-show-all" => "registration/showAllJobOpenings",
	    "form-action-add-new" => "registration/addNewJobOpenings",
	    "form-title" => "Job Opening List",
	    "add-new-record-title" => "Create",
	    "table-header" => array("job_title", "department", "interviewing_manager", "created_date", "email"),
	    "form-action-delete-selected" => "registration/deleteSelectedJobOpenings",
	    "column-details" => array("job_title", "department", "interviewing_manager", "created_date"),
	    "alert-data-msg" => array(
		"msg-confirm-delete" => "Are you sure that you want to delete the selected job openings?",
		"msg-select-delete" => "Please select a job opening that you would like to delete!"),
	    "data-url" => "data-url=",
	    "foreign-key-check" => "",
	    "column-link-to-details" => "",
	    "form-action-view-selected" => "",
	    "msg-foreign-key" => "",
	    "send-email-button-id" => "generateEmail",
	    "data-email-url-tag" => "data-email-url=",
	    "data-email-url" => "registration/generateEmail",
	    "data-email-details" => array("id", "job_title"),
	    "clickable-button-title" => "Generate Email",
	    "foreign-key-check" => "registration/checkCandidateJobOpeningExist",
	    "msg-foreign-key" => "Please delete the candidates under this job opening first.",
	    "column-details-query" => "",
	    "column-details-model" => ""
	),
	"Candidate Status" =>
	array(
	    "entity-name" => "CandidateStatus",
	    "breadcrumb-top" => "Candidate Status List",
	    "breadcrumb-bottom" => "breadcrumb-bottom-gears",
	    "form-id" => "candidatestatus-list",
	    "form-title" => "Candidate Status List",
	    "form-action-show-all" => "registration/showAllCandidateStatus",
	    "form-action-add-new" => "registration/addNewCandidateStatus",
	    "add-new-record-title" => "Create",
	    "table-header" => array("title"),
	    "form-action-delete-selected" => "registration/deleteCandidateStatus",
	    "column-details" => array("title"),
	    "alert-data-msg" => array(
		"msg-confirm-delete" => "Are you sure that you want to delete the selected candidate status?",
		"msg-select-delete" => "Please select a candidate status that you would like to delete!"),
	    "data-url" => "",
	    "foreign-key-check" => "",
	    "column-link-to-details" => "",
	    "form-action-view-selected" => "",
	    "msg-foreign-key" => ""
	),
	"Onboarding Item" =>
	array(
	    "entity-name" => "OnboardingItem",
	    "breadcrumb-top" => "Onboarding Items List",
	    "breadcrumb-bottom" => "breadcrumb-bottom-dashboard",
	    "form-id" => "onboardingitems-list",
	    "form-title" => "Onboarding Item List",
	    "form-action-show-all" => "onboarding/showAllOnboardingItems",
	    "form-action-add-new" => "onboarding/addNewOnboardingItem",
	    "add-new-record-title" => "Create",
	    "table-header" => array("title", "department_owner", "is_offboarding_item", "status", "is_managerial"),
	    "form-action-delete-selected" => "onboarding/deleteOnboardingItems",
	    "column-details" => array("department_owner", "is_offboarding_item", "status", "is_managerial"),
	    "alert-data-msg" => array(
		"msg-confirm-delete" => "Are you sure that you want to delete the selected onboarding item?",
		"msg-select-delete" => "Please select a onboarding item that you would like to delete!"),
	    "data-url" => "",
	    "column-link-to-details" => "title",
	    "form-action-view-selected" => "onboarding/viewSelectedOnboardingItem",
	),
	"Onboarding Checklist Template" =>
	array(
	    "entity-name" => "OnboardingChecklistTemplate",
	    "breadcrumb-top" => "Onboarding Checklist Templates List",
	    "breadcrumb-bottom" => "breadcrumb-bottom-dashboard",
	    "form-id" => "onboardingchecklisttemplates-list",
	    "form-title" => "Onboarding Checklist Template List",
	    "form-action-show-all" => "onboarding/showAllOnboardingChecklistTemplates",
	    "form-action-add-new" => "onboarding/addNewOnboardingChecklistTemplate",
	    "add-new-record-title" => "Create",
	    "table-header" => array("title", "description", "department"),
	    "form-action-delete-selected" => "onboarding/deleteOnboardingChecklistTemplates",
	    "column-details" => array("description", "department"),
	    "alert-data-msg" => array(
		"msg-confirm-delete" => "Are you sure that you want to delete the selected onboarding checklist template?",
		"msg-select-delete" => "Please select a template that you would like to delete!"),
	    "data-url" => "",
	    "foreign-key-check" => "",
	    "column-link-to-details" => "title",
	    "form-action-view-selected" => "onboarding/viewSelectedOnboardingChecklistTemplate",
	    "msg-foreign-key" => ""
	),
	"Training Item" =>
	array(
	    "entity-name" => "TrainingItem",
	    "breadcrumb-top" => "Training Items List",
	    "breadcrumb-bottom" => "breadcrumb-bottom-dashboard",
	    "form-id" => "trainingitems-list",
	    "form-title" => "Training Items List",
	    "form-action-show-all" => "training/showAllTrainingItems",
	    "form-action-add-new" => "training/addNewTrainingItem",
	    "add-new-record-title" => "Create",
	    "table-header" => array("title", "description", "status"),
	    "form-action-delete-selected" => "training/deleteTrainingItems",
	    "column-details" => array("description", "status"),
	    "alert-data-msg" => array(
		"msg-confirm-delete" => "Are you sure that you want to delete the selected training items?",
		"msg-select-delete" => "Please select a training item that you would like to delete!"),
	    "data-url" => "",
	    "foreign-key-check" => "training/checkTrainingItemExistInTemplate",
	    "column-link-to-details" => "title",
	    "form-action-view-selected" => "training/viewSelectedTrainingItem",
	    "msg-foreign-key" => ""
	),
	"Training Template" =>
	array(
	    "entity-name" => "TrainingTemplate",
	    "breadcrumb-top" => "Training Templates List",
	    "breadcrumb-bottom" => "breadcrumb-bottom-dashboard",
	    "form-id" => "trainingtemplates-list",
	    "form-title" => "Training Templates List",
	    "form-action-show-all" => "training/showAllTrainingTemplates",
	    "form-action-add-new" => "training/addNewTrainingTemplate",
	    "add-new-record-title" => "Create",
	    "table-header" => array("title", "description", "department"),
	    "form-action-delete-selected" => "training/deleteTrainingTemplates",
	    "column-details" => array("description", "department"),
	    "alert-data-msg" => array(
		"msg-confirm-delete" => "Are you sure that you want to delete the selected training templates?",
		"msg-select-delete" => "Please select a training template that you would like to delete!"),
	    "data-url" => "",
	    "foreign-key-check" => "",
	    "column-link-to-details" => "title",
	    "form-action-view-selected" => "training/viewSelectedTrainingTemplate",
	    "msg-foreign-key" => ""
	),
	//this is not for show all page
	
	//for onboarding items for new hirees
	"OnboardingTab" =>
	array(
	    "table-header" => array("Title", "Description", "Department Owner", "Is Managerial", "Is Offboarding Item", "", "Remarks"),
	    "column-details" => array("item_title", "description", "department_owner", "is_managerial", "is_offboarding_item", "onboarding_checklist_items_user_mapping_id", "remarks")
	),
	"TrainingTab" =>
	array(
	    "table-header" => array("Title", "Description", "Responsibility", "", "Remarks"),
	    "column-details" => array("item_title", "training_description", "responsibility", "training_items_user_mapping_id", "remarks")
	)
    );

}
