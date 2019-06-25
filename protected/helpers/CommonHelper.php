<?php 
class CommonHelper {

	public static function setFileName($inputParam, $sanitizedIdNo, $fileType, $documentType){
		if($inputParam != ''){
			return "CANDIDATE_" . EmploymentCandidate::model()->encryptCandidateId($sanitizedIdNo) . "_" . date("Y-m-d") . "." . $fileType;
			if($documentType == "resume"){
				return "CANDIDATE_" "RESUME_". EmploymentCandidate::model()->encryptCandidateId($sanitizedIdNo) . "_" . date("Y-m-d") . "." . $fileType;
			} else if ($documentType == "cover-letter"){
				return "CANDIDATE_" "COVER_LETTER_". EmploymentCandidate::model()->encryptCandidateId($sanitizedIdNo) . "_" . date("Y-m-d") . "." . $fileType;
			}
		} else {
			return false;
		}
	}

	public static function getDocumentType($filePath){
		$fileType = pathinfo($filePath, PATHINFO_EXTENSION);
		return $fileType;
	}

	public static function moveDocumentToFileSystem($documentName, $documentKind, $fileType){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$allowed = array("pdf" => "pdf", "docx" => "docx", "doc" => "doc", "xml" => "xml");
			if(isset($_FILES['resume']) && $_FILES["resume"]["error"] == 0 && isset($_FILES['coverLetter']) && $_FILES["coverLetter"]["error"] == 0){

				if(!array_key_exists(strtolower($fileType), $allowed)){
					die("Error: Please select a valid file format.");
				}

				if(in_array($fileType, $allowed)){
					if(file_exists("document/". $documentKind . "/" . $documentName)){
						echo $documentName . "already exists.";
					} else {
						move_uploaded_file($_FILES[$documentKind]["tmp_name"], getcwd() . "/documents/" . $documentKind . "/" . $documentName);
					}
				} else {
						echo "Error: There was a problem uploading your file. Please try again."; 
				}
			} else {
				echo "Error: " . $_FILES[$documentKind]["error"];
			}
		}
	}
}