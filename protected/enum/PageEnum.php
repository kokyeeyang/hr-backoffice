<?php 

class PageEnum {
	const DEPARTMENT_ID = "id";
	const DEPARTMENT_TITLE = "title";
	const DEPARTMENT = "department";
	const DESCRIPTION = "Description";

	//New for Page Helper
	const PAGE_DATA = array("Department" => 
													array("breadcrumb-top" => "Show All Departments",
															"breadcrumb-bottom" => "breadcrumb-bottom-people",
															"page-title" => "All departments",


															"table-header" => array("Department", "Description")
														),

													"Users" => array()
													);
}