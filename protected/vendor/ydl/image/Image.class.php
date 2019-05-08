<?php
	class Image {
		var $bolShowDebug;
		var $strFilename;
		var $resImage;

		function Image($bolShowDebug = false) {
			$this->bolShowDebug = ($bolShowDebug) ? true : false;
		}

		function ShowDebugMessage($strFunction, $strMessage) {

			if ($this->bolShowDebug) {
				echo "<p><strong style=\"color:#FF0000\">Error in function $strFunction:</strong> $strMessage</p>\r\n";
			}
		}

		function GetExtension($strFilename) {
			//$strExtension = strtolower(end(explode('.', $strFilename)));
			$strExtension = explode('.', $strFilename);
			$strExtension = end($strExtension);
			$strExtension = strtolower($strExtension);
			
			return ($strExtension == 'jpg') ? 'jpeg' : $strExtension;
		}

		function GetWidth() {

			if (is_null($this->resImage)) {
				$this->ShowDebugMessage('GetWidth', 'There is no image to process.');
				return false;
			}
			return imagesx($this->resImage);
		}

		function GetHeight() {

			if (is_null($this->resImage)) {
				$this->ShowDebugMessage('GetHeight', 'There is no image to process.');
				return false;
			}
			return imagesy($this->resImage);
		}

		function GetResource() {
			return is_null($this->resImage) ? null : $this->resImage;
		}

		function Load($strFilename) {

			if (! file_exists($strFilename)) {
				$this->ShowDebugMessage('Load', "The supplied file name '$strFilename' does not point to a readable file.");
				return false;
			}

			$this->strFilename = $strFilename;
			$strExtension = $this->GetExtension($strFilename);
			$strFunction  = "imagecreatefrom$strExtension";			

			if (! function_exists($strFunction)) {
				$this->ShowDebugMessage('Load', "That file cannot be loaded with the function '$strFunction'.");
				return false;
			}

			// RETURN AN IMAGE IDENTIFIER REPRESENTING THE IMAGES OBTAINED FROM THE GIVEN FILENAME
			$this->resImage = $strFunction($strFilename);

			if (is_null($this->resImage)) {
				$this->ShowDebugMessage('Load', 'The image could not be loaded.');
				return false;
			}
			return true;
		}


		function SaveAs($strFilename = '', $intQuality = 100) {

			if (is_null($this->resImage)) {
				$this->ShowDebugMessage('SaveAs', 'There is no processed image to save.');
				return false;
			}

			if ($strFilename == '') {
				$strFilename = $this->strFilename;
			}

			$strBaseName = basename($strFilename);
			$strPath 	 = str_replace('/' . $strBaseName, '', $strFilename);
			
			if (!file_exists($strPath)) {
				mkdir($strPath, 0755);
			}			
			
			$strExtension = $this->GetExtension($strFilename);
			$strFunction  = "image$strExtension";

			if (!function_exists($strFunction)) {
				$this->ShowDebugMessage('SaveAs', "That file cannot be saved with the function '$strFunction'.");
				return false;
			}

			$bolSaved = false;
			
			// CREATE THE IMAGE ($this->resImage) IN $strFilename
			if (!file_exists($strFilename)) {
				touch($strFilename); // safe mode is turn on , so need to create a blank file before create a image file
			}
			if ($strExtension == 'png') {
				$bolSaved = $strFunction($this->resImage, $strFilename);
			} 
			else if ($strExtension == 'gif') {
				$bolSaved = $strFunction($this->resImage, $strFilename);
			}
			else{
				//echo "calling: $strFunction($this->resImage, $strFilename, $intQuality)";
				$bolSaved = $strFunction($this->resImage, $strFilename, $intQuality);
			}

			if (! $bolSaved) {
				$this->ShowDebugMessage('SaveAs', "Could not save the output file '$strFilename' as a $strExtension.");
				return false;
			}

			return true;
		}


		function Resize($intNewWidth, $intNewHeight, $intQuality = 100) {

			if (is_null($this->resImage)) {
				$this->ShowDebugMessage('Resize', 'There is no processed image to resize.');
				return false;
			}

			if (($intNewWidth < 1) || ($intNewHeight < 1) || ($intQuality < 1) || ($intQuality > 100)) {
				$this->ShowDebugMessage('Resize', 'There is no correct parameters to resize.');
				return false;
			}

			// get original image size
			list($intWidth, $intHeight) = getimagesize($this->strFilename);

			if (($intWidth != $intNewWidth) || ($intHeight != $intNewHeight)) {

				// create temp new file (resource), using new width and height
				$strExtension = $this->GetExtension($this->strFilename);
				if ($strExtension == 'gif' || $strExtension == 'png') {
					// use imagecreate because maybe the gif image is transparent , so need to set it transaparent
					// imagecreate will only set the transparent one time only
					$resTempImage = imagecreate($intNewWidth, $intNewHeight);
					imagecolortransparent($resTempImage, imagecolorallocate($resTempImage, 0, 0, 0));
				}
				else {
					// other image type (eg:jpg) quality will be low if use imagecreate function
					$resTempImage = imagecreatetruecolor($intNewWidth, $intNewHeight);
				}
				// resize the image
				if (imagecopyresampled($resTempImage, $this->resImage, 0, 0, 0, 0, $intNewWidth, $intNewHeight, $intWidth, $intHeight)) {

					if (is_null($resTempImage)) {
						$this->ShowDebugMessage('Resize', 'The image could not be resized.');
						return false;
					}

					$this->resImage = $resTempImage;
					return true;
				}
				else {
					$this->ShowDebugMessage('Resize', 'Could not resize the image.');
					return false;
				}
			}
			else {
				$this->ShowDebugMessage('Resize', "The resize width (".$intWidth." - ".$intNewWidth.") and height (".$intHeight." - ".$intNewHeight.") is the same.");
				return false;
			}
		}

		function ResizeByPercent($intPercent = 100, $intQuality = 100) {

			if (is_null($this->strFilename)) {
				$this->ShowDebugMessage('Resize', 'There is no processed image to resize.');
				return false;
			}

			if (($intPercent < 1) || ($intQuality < 1) || ($intQuality > 100)) {
				$this->ShowDebugMessage('Resize', 'There is no correct parameters to resize.');
				return false;
			}

			list($intWidth, $intHeight) = getimagesize($this->strFilename);
			$intNewWidth  = floor($intWidth  * ($intPercent / 100));
			$intNewHeight = floor($intHeight * ($intPercent / 100));

			if (($intWidth != $intNewWidth) && ($intHeight != $intNewHeight)) {
				return $this->Resize($intNewWidth, $intNewHeight, $intQuality);
			}
			else {
				$this->ShowDebugMessage('ResizeByPercent', "The resize width and height is the same.");
				return false;
			}
		}

		function Flush() {
			if($this->resImage!=''){
				imagedestroy($this->resImage);
				unset($this->strFilename);
			}
		}
	}
?>