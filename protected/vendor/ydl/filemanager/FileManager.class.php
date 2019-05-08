<?php
	class FileManager{
		var $arrValidImage;
		var $arrValidDoc;
		var $arrValidMisc;
		var $arrValidFile;
		var $arrError;
		var $strLang;
		var $arrDeletedFileName;
		
		function FileManager($lang = null){
			
			if($lang != '') {
				$this -> strLang = $lang;
			}
			else if(defined('LANG')){
				$this -> strLang = LANG;
			}
			else {
				$this -> strLang = LANG_DEFAULT;
			} // - end: if else
			
			$this -> arrValidImage = array('gif', 'tiff', 'jpg', 'png', 'pcx', 'jpeg', 'bmp', 'swf', 'fla', 'swc', 'iff', 'jp2', 'jpx', 'jb2', 'jpc', 'xbm', 'wbmp');
			$this -> arrValidDoc = array('pdf', 'doc', 'rtf', 'xls', 'txt', 'csv', 'log', 'xlsx');
			$this -> arrValidMisc = array('exe', 'zip', 'rar', 'tar', 'gz', 'mp3', 'wma', 'rm', 'rmvb', 'wmv', 'mpg');
			$this -> arrValid = array_merge($this -> arrValidImage, $this -> arrValidDoc, $this -> arrValidMisc);
			$this -> arrDeletedFileName = array();
			$this -> init();
		}
		
		function init() {
			$this -> arrErrorMsg = array();
			$this -> arrErrorMsg['en'] = array(	'Filename empty or upload failed!', 
												'This is not an image file!',
												'Filename does not allow space and special character!',
												'Invalid file extension!');
												
			$this -> arrErrorMsg['fr'] = array(	'Le nom de fichier est vide ou t&eacute;l&eacute;chargement &eacute;choue!', 
												"Ce n&acute;est pas un dossier d&acute;image!",
												"Le nom de fichier ne permet pas l&acute;espace et caract&egrave;re sp&eacute;cial! ",
												'Prolongation de dossier inadmissible! '
												);
												
			$this -> arrErrorMsg['cn'] = array(	'文件名称为空或上载失败!', 
												'这不是一个图像文件！',
												'文件名不允许空格和特殊字符！',
												'无效的文件extension！');

			$this -> arrErrorMsg['hk'] = array(	'文件名稱為空或上載失敗!', 
												'這不是一個圖像文件！',
												'文件名不允許空格和特殊字符！',
												'無效的文件extension！');												
			$this -> arrError = array();
		}
		
		function isValidFileType($filename = '') {
			if(trim($filename) != '') {
				if(in_array($this -> getExtension($filename), $this -> arrValid)) {
					return true;
				} else
					return false;
			} else
				return false;
		}
		
		function download($filename, $path = './') {
			if(trim($filename) != '') { 
				$filename = basename($filename);
				$ext = $this -> getExtension($filename);
				if(in_array($ext, $this -> arrValid)) {
					if(file_exists($path . '/' . $filename)) {
						header('Last-Modified: ' . date('D, d M Y H:i:s', filemtime($path . '/' . $filename)) . ' GMT');
						//header('Last-Modified: ' . date(filemtime($path), 'D, d M Y H:i:s') . ' GMT');
						header('Cache-Control: no-cache, must-revalidate');
						header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
						header('Content-Length: ' . filesize($path . '/' . $filename));
						
						switch($ext) {
							case 'log':
								header("Content-type: text/plain");
								break;
							case 'xls':
								header("Content-type: application/msexcel"); 
								break;
							case 'csv':
								header("Content-type: application/octet-stream"); 
								break;						
							case 'pdf':
								header('Content-type: application/pdf');
								break;
							case 'doc':
								header('Content-type: application/msword');
								break;
							case 'zip':
								header('Content-type: application/zip');
								break;
							case 'gif':
								header('Content-type: image/gif');
								break;
							case 'jpg':
								header('Content-type: image/jpg');
								break;
							case 'png':
								header('Content-type: image/png');
								break;
							case 'exe':
								header('Content-type: application/x-msdownload');
								break;
						}
						header('Content-Transfer-Encoding: binary');
						header('Content-Disposition: attachment; filename="'.$filename.'"');
						
						// if large file, we need to set time_limit to 0
						//set_time_limit(0);
						readfile_chunked($path . '/' . $filename);
					} else {
						trigger_error("Page 404: Download file does not exist!", E_USER_ERROR);
						exit;
					}
				} else {
					trigger_error("Forbidden Error: Access Denied!", E_USER_ERROR);
					exit;
				}
			} else {
				trigger_error("Page 404: Download file does not exist.", E_USER_ERROR);
				exit;
			}
		}
		
		function upload($filename, $tmpfilename, $path, $type = null) {
			
			if($filename == '' || $tmpfilename == '' || $tmpfilename == 'none') {
				$this -> setError(0);	// filename empty or upload failed
				return false;
			}
			
			// Auto replaces [space] by _ 
			$filename = str_replace(' ', '_', $filename);
			
			if($type == 'img' && !getimagesize($tmpfilename)) {
				$this -> setError(1);	// not image file
				return false;
			}

			/*if(preg_match("/[\\\\|;|\'|\"| |!|@|#|$|%|^|&|*|(|)|+|=|`|~|:|?|\/|<|>|,|{|}]/is", $filename) ) {
				$this -> setError(2);
				return false;
			}*/
			
			if(!preg_match("/^[-A-Z0-9._]*$/i", $filename)) {	
				$this -> setError(2);
				return false;
			}
			
			if(in_array($this -> getExtension($filename), $this -> arrValid)) {
				// check if path exist,
				// if not found, create the particular directory
				if (!file_exists($path)) {
					mkdir($path, 0755);
				}

				// check for duplicated filename,
				// if found, append number on the current upload file
				$i = 0;
				$oldfilename = $filename;
				while (file_exists($path . '/' . $filename)) {
					$i++;

					// divide filename into its name and extension
					$name_property = explode('.', $filename);
					$file_name = $name_property[0];
					$file_ext  = '.' . $name_property[1];

					try {
						// find the last '_' in the filename
						if ($pos = strrpos($file_name, '_')) {
							// get the filename before the last '_'
							$temp_name = substr($file_name, 0, $pos);
							$temp_num = substr($file_name, $pos, strlen($file_name));

							// if after '_' is number, directly add 1 to that number
							// else just append $i
							if (is_numeric($temp_num)) {
								$filename = $temp_name . '_' . ($temp_num + 1) . $file_ext;
							}
							else {
								$filename = $temp_name . '_' . $i . $file_ext;
							}
						}
						else {
							// can't find the last '_' in the filename
							// so just append a number ($i)
							$filename = $file_name . '_' . $i . $file_ext;
						}
					}
					catch (Exception $e){
						$this -> setError(0);
						return false;
					}
				}

				// upload file to appropriate directory
				$pathfilename = $path . '/' . $filename;
				
				// added by chua 
				// to maintain the original filename on the server
				/*
				if(file_exists($path . '/' . $oldfilename))
					rename($path . '/' . $oldfilename, $pathfilename);
				
				move_uploaded_file($tmpfilename, $path . '/' . $oldfilename);
				*/
					
				move_uploaded_file($tmpfilename, $pathfilename);
				chmod($pathfilename, 0644);
				return $filename;
			} else {
				$this -> setError(3);	// invalid file extension
				return false;
			}
		}
		
		/**
		*	@desc			To delete all type of files
		*
		*	@date			6 September 2004
		*	@author			!van Teh <i.teh@netzed.com.my>
		*
		*	@param	string		$filename
		*	@param	string		$path
		*
		*	@access			private
		*/
		function remove($filename, $path, $removepath = 1) {
	
			if (($filename != '') && (file_exists($path. '/' . $filename))) {
			
				// to check if the file type are permitted to remove
				if(in_array($this -> getExtension($filename), $this -> arrValid)) {
					unlink($path . '/' . $filename);
					
					// check if current directory ($lang, eg. fr, uk) is empty,
					// if so, remove the particular directory
					$dh  = opendir($path);
		
					while (false !== ($dhfile = readdir($dh))) {
						$files[] = $dhfile;
					}
		
					if (sizeof($files) == 2 && $removepath == 1) {
						rmdir($path);
						/*
						// go to particular directory's parent directory
						if (substr($path, -1) == '/')
							$path = substr($path, 0, strrpos(substr($path, (strlen - 1)), '/'));
						else
							$path = substr($path, 0, strrpos($path, '/'));
		
						// check if parent directory ($products_id, eg. 1, 5) is empty,
						// if so, remove the particular directory
						$dh  = opendir($path);
		
						while (false !== ($dhfile = readdir($dh))) {
							$files[] = $dhfile;
						}
		
						if (sizeof($files) == 4) {
							rmdir($path);
						}*/
					}
				} else {
					$this -> setError(3);
				}
			} else {
				$this -> setError(0);
			}
		}
	
		function getExtension($filename) {
			// Get file extension
			//$tmp = split('\.', $filename);
			//$ext = $tmp[(count($tmp) - 1)];
			$tmp = explode('.', basename($filename));
			$ext = strtolower(end($tmp));
			
			return $ext;
		}
		
		function setError($intErrorNo) {
			$this -> arrError[] = $this -> arrErrorMsg[$this -> strLang][$intErrorNo];
		}
		
		function getError() {
			if(empty($this -> arrError)){
				return false;				
			}
			else{
				return implode('<hr/>', $this -> arrError);
			}
		}
		
	}
?>