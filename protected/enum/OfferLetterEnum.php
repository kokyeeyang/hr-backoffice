<?php

class OfferLetterEnum {
	const IMAGE_PATH = "images/offer_letter";
	const CANDIDATE_ID = "%%Candidate ID%%";
	const REGULAR_SALARY = "%%Candidate Regular Salary%%";
	const PROBATIONARY_SALARY = "%%Candidate Probationary Salary%%";
	const CANDIDATE_POSITION = "%%Candidate Position%%";
	const CANDIDATE_SUPERIOR = "%%Candidate Superior%%";
	const CANDIDATE_ADDRESS = "%%Candidate Address%%";
	const CANDIDATE_NAME = "%%Candidate Name%%";
	const COPY_MODE = "copy";
	const EDIT_MODE = "edit";
	const OFFER_LETTER = "Offer Letter";
	const OFFER_LETTER_TABLE = "EmploymentOfferLetterTemplates";
	const OFFER_LETTER_TABLE_IN_SQL = "employment_offer_letter_templates";
	const OFFER_LETTER_NOT_FOUND_WARNING = "<script type='text/javascript'>alert('No suitable offer letter has been found. Please create one first.');</script>";
	//used in offer letter listing page
	const IS_NOT_MANAGERIAL = "Non-Managerial";
	const IS_MANAGERIAL = "Managerial";
}

?>