<?php 
class CommonHelper {

	public static function setImageName($imageParam, $sanitizedIdNo, $fileType){
		if($imageParam != ''){
			return "CANDIDATE_" . EmploymentCandidate::model()->encryptCandidateId($sanitizedIdNo) . "_" . date("Y-m-d") . "." . $fileType;
		} else {
			return false;
		}
	}
}