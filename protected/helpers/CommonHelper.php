<?php 
class CommonHelper {

	const OFFER_LETTER_IMAGES = "";

	public static function setFileName($inputParam, $sanitizedIdNo, $fileType, $documentType){
		if($inputParam != ''){
			switch ($documentType){
				case "resume" :
					return "CANDIDATE_" . "RESUME_". EmploymentCandidate::model()->encryptCandidateId($sanitizedIdNo) . "_" . date("Y-m-d") . "." . $fileType;
					break;
				
				case "cover-letter" :
					return "CANDIDATE_" . "COVER_LETTER_". EmploymentCandidate::model()->encryptCandidateId($sanitizedIdNo) . "_" . date("Y-m-d") . "." . $fileType;
					break;				
			}
		} else {
			return false;
		}
	}

	public static function getDocumentType($filePath){
		$fileType = pathinfo($filePath, PATHINFO_EXTENSION);
		return $fileType;
	}

	public static function moveDocumentToFileSystemOrS3($fileName, $fileTmpName, $folderName, $fileType, $allowedFileExtensions, $fileDestination, $checkIfFileExist = false) {

		$response['result'] = false;
		/*
		// Disable for now as not implementing same origin checking
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			// same-origin requests won't set an origin. If the origin is set, it must be valid.
			if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
				header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
			} else {
				header("HTTP/1.1 403 Origin Denied");
	  		return;
	  	}
	  }
		*/

		//determines if the file is transferred to the server successfully
		if (!isset($_FILES) && $_FILES["error"] != 0) {
			$response['errorType'] = CommonEnum::ERROR_TYPE_MESSAGE;
			$response['errorMessage'] = "Error: " . $_FILES["error"];
		}

	  // Sanitize input, need to find out more about what this does
		if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $fileName)) {
			$response['errorType'] = CommonEnum::ERROR_TYPE_HEADER;
			$response['errorMessage'] = "HTTP/1.1 400 Invalid file name.";
	  }

		//determine if the uploaded file is within the allowed file extension
		if (!in_array($fileType, $allowedFileExtensions)) {
			$response['errorType'] = CommonEnum::ERROR_TYPE_MESSAGE;
			$response['errorMessage'] = "Error: Please select a valid file format.";
		}

		//only check file exist if required
		if ($checkIfFileExist == true) {
			if (file_exists($destinationFilePath . "/" . $fileName)) {
				$response['errorType'] = CommonEnum::ERROR_TYPE_MESSAGE;
				$response['errorMessage'] = $fileName . "already exists.";
			}
		}

		//perform moving of upload files here
		//only upload important files to S3
		if ($fileDestination == CommonEnum::S3){
			$result = S3Helper::putObject($folderName.'/'.$fileName, $fileTmpName);
		} else if ($fileDestination == CommonEnum::FILE_SYSTEM){
			$result = move_uploaded_file($fileTmpName, $folderName . "/" . $fileName);
		}
		// //perform moving of upload files here
		// $result = move_uploaded_file($_FILES["file"]["tmp_name"], $destinationFilePath . "/" . $fileName);
		// // var_dump($destinationFilePath . "/" . $fileName);exit;
		// $response['result'] = $result;

		$response['result'] = $result;

		//if upload file some how fail on the server end
		if ($result == false) {
			$response['errorType'] = CommonEnum::ERROR_TYPE_HEADER;
			$response['errorMessage'] = "HTTP/1.1 500 Server Error";
		}

		return $response;
	}

	public static function handleErrorOutput($response) {
		//only process if the result in the response is false
		if ($response['result'] == true) {
			return true;
		}

		//ensure the errorType is set
		if (isset($response['errorType'])) {

			//determine the way to output the error
			switch ($response['errorType']) {

				case CommonEnum::ERROR_TYPE_MESSAGE:
					//temporary echo it only, but proper way should be setting it or returning it if applicable
					echo $response['errorMessage'];
					break;

				case CommonEnum::ERROR_TYPE_HEADER:
					//directly header out the error here
					header($response['errorMessage']);
					//temporary don't know whether it is best to die or not
					//die();
					break;
			}
		}
	}

	//only need to use in cases where modification of sql to list out records is necessary
	public static function calculatePagination($intPage, $numPerPage){
		return $intPage * $numPerPage;
	}

	// public static function 

}
