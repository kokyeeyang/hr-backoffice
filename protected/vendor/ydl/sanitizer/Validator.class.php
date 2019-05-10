<?php
	class Validator {
	
		var $arrAtt;
		var $test_value;
		var $default_value;
		var $clean_value;
		var $error;
		var $lang;
		
		static $ERROR_DESC1;
		static $ERROR_DESC2;
		static $ERROR_DESC3;
		static $ERROR_DESC4;
		
		static $FILE_ERROR_ONLY_AZ;
		static $FILE_ERROR_EMPTY;
		static $FILE_ERROR_INVALID;
		static $FILE_ERROR_INVALID_FILE_TYPE;
		
		function __construct($lang = null) {
			
			if(isset($lang) && ($lang != '') ) {
				$this -> lang = $lang;
			}
			else if(defined('LANG')){
				$this -> lang = LANG;
			}
			else {
				$this -> lang = LANG_DEFAULT;
			} // - end: if else
			
			self::$ERROR_DESC1 = Yii::t('app', ' invalid format!');
			self::$ERROR_DESC2 = Yii::t('app', ' must be in alphanumeric and not less than [#NO#] characters!');
			self::$ERROR_DESC3 = Yii::t('app', ' must be in alphanumeric and not exceed [#NO#] characters!');
			self::$ERROR_DESC4 = Yii::t('app', ' must not be empty!');
			
			self::$FILE_ERROR_ONLY_AZ 			= Yii::t('app', ' must be a-z, 0-9, "-" or "_".');
			self::$FILE_ERROR_EMPTY 			= Yii::t('app', ' is empty!');
			self::$FILE_ERROR_INVALID 			= Yii::t('app', ' is invalid file format!');
			self::$FILE_ERROR_INVALID_FILE_TYPE = Yii::t('app', ' is invalid file type!');
		}
		
		function init() {
			// if parameter didnt have any name, we will set it to nothing
			// to prevent undefine index error during the validation failed
			if(is_array($this -> arrAtt) === false){
				$this -> arrAtt = [];
			}

			if(!isset($this -> arrAtt['name'])){
				$this -> arrAtt['name'] = '';
			}
		}
		
		function setErrorHandler(&$objError) {
			if($objError != null)
				$this -> objError = $objError;
		}
		
		function execute() {
			$this -> init();
			$this -> validate();
			$this -> check_length();
			$this -> check_required();
		}
		
		function getCleanValue() {
			
			if(isset($this -> arrAtt['org']) && $this -> arrAtt['org'] == true) {
				// if 'org' is set to true
				// validator will return the original input value with safetag process
				if(is_array($this -> test_value) ) {
					foreach($this -> test_value as $k => $v) {
						$this -> test_value[$k] = $this -> safetag($v);
					}
					return $this -> test_value;
				} else {
					return $this -> safetag($this -> test_value);
				}
			} else {
				if(is_array($this -> clean_value) ) {
					/*
					foreach($this -> clean_value as $k => $v) {
						$this -> clean_value[$k] = urldecode($v);
					}
					*/
					return $this -> clean_value;
				} else {
					//return urldecode($this -> clean_value);
					return $this -> clean_value;
				}
			}
		}
		
		function set($name = null, $value = null) {
			
			if(!is_array($value))
				$this -> $name = trim($value);
			else
				$this -> $name = $value;
		}
		
		function validate() {
			if (isset($this -> arrAtt['type']) && !empty($this -> test_value)) {
				switch(strtolower($this -> arrAtt['type'])) {
				
					case 'int':
					// validate integer
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								if(ctype_digit($val)) {
									$this -> clean_value[$key] = $val;
								} else {
									$this -> clean_value[$key] = (int) $this -> default_value;
									//$this -> clean_value[$key] = (int) $val;
								}
							}
						} else {
							if(ctype_digit($this -> test_value)) {
								$this -> clean_value = $this -> test_value;
							} else {
								$this -> clean_value = (int) $this -> default_value;
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
							}
						}
						//$this -> clean_value = ((int) $this -> test_value) ? ((int) $this -> test_value) : (isset($this -> default_value) ? $this -> default_value : 0);
						break;
						
						
					case 'float':
					// validate float
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								$this -> clean_value[$key] = (float) $val;
							}
						} else {
							if(is_numeric($this -> test_value)) {
								$this -> clean_value = (float) $this -> test_value;
							} else {
								$this -> clean_value = (float) $this -> default_value;
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
							}
							//$this -> clean_value = ((float) $this -> test_value) ? ((float)$this -> test_value) : (isset($this -> default_value) ? $this -> default_value : 0);
						}
						break;
						
					case 'dd-mm-yyyy':
					// validate date dd-mm-yyyy
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								if(is_valid_date($val, 'dmy')) {
									$this -> clean_value[$key] = $val;
								} else {
									$this -> clean_value[$key] = $this -> safetag($this -> default_value);
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								}
							}
						} else {
							if(is_valid_date($this -> test_value,'dmy')) {
								$this -> clean_value = $this -> test_value;
							} else {
								$this -> clean_value = $this -> safetag($this -> default_value);
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
							}
						}
						//$this -> clean_value = (is_valid_date($this -> test_value,'dmy')) ? $this -> test_value : $this -> default_value;
						break;
						
						
					case 'yyyy-mm-dd hh:mm:ss':
					// validate date yyyy-mm-dd hh:mm:ss
						
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								if(is_valid_date($val, 'ymd h:m:s')) {
									$this -> clean_value[$key] = $val;
								} else {
									$this -> clean_value[$key] = $this -> safetag($this -> default_value);
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								}
							}
						} else {
							if(is_valid_date($this -> test_value,'ymd h:m:s')) {
								$this -> clean_value = $this -> test_value;
							} else {
								$this -> clean_value = $this -> safetag($this -> default_value);
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
							}
						}
						//$this -> clean_value = (is_valid_date($this -> test_value,'ymd h:m:s')) ? $this -> test_value : $this -> default_value;				
						break;
						
					case 'yyyy-mm-dd hh:mm':
					// validate date yyyy-mm-dd hh:mm
						
						if(is_array($this -> test_value) ) {
							foreach($this -> test_value as $key => $val) {
								if(is_valid_date($val.':00', 'ymd h:m:s')) {
									$this -> clean_value[$key] = $val;
								} else {
									$this -> clean_value[$key] = $this -> safetag($this -> default_value);
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								}
							}
						} else {
							if(is_valid_date($this -> test_value.':00','ymd h:m:s')) {
								$this -> clean_value = $this -> test_value;
							} else {
								$this -> clean_value = $this -> safetag($this -> default_value);
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
							}
						}
						//$this -> clean_value = (is_valid_date($this -> test_value,'ymd h:m:s')) ? $this -> test_value : $this -> default_value;				
						break;
						
					case 'yyyy-mm-dd':
					// validate date yyyy-mm-dd
					
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								if(is_valid_date($val, 'ymd')) {
									$this -> clean_value[$key] = $val;
								} else {
									$this -> clean_value[$key] = $this -> safetag($this -> default_value);
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								}
							}
						} else {
							if(is_valid_date($this -> test_value,'ymd')) {
								$this -> clean_value = $this -> test_value;
							} else {
								$this -> clean_value = $this -> safetag($this -> default_value);
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
							}
						}
						//$this -> clean_value = (is_valid_date($this -> test_value,'ymd')) ? $this -> test_value : $this -> default_value;
						break;
						
						
					case 'yyyy-mm':
					// validate date yyyy-mm
					
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								if(is_valid_date($val, 'ym')) {
									$this -> clean_value[$key] = $val;
								} else {
									$this -> clean_value[$key] = $this -> safetag($this -> default_value);
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								}
							}
						} else {
							if(is_valid_date($this -> test_value,'ym')) {
								$this -> clean_value = $this -> test_value;
							} else {
								$this -> clean_value = $this -> safetag($this -> default_value);
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
							}
						}
						
						//$this -> clean_value = (is_valid_date($this -> test_value,'ym')) ? $this -> test_value : $this -> default_value;
						break;
					
					case 'hh:mm:ss':
					// validate date hh:mm:ss
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								if(check_time_format($this -> test_value) !== '') {
									$this -> clean_value[$key] = $val;
								} else {
									$this -> clean_value[$key] = $this -> safetag($this -> default_value);
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								}
							}
						} else {
							if(check_time_format($this -> test_value) !== '') {
								$this -> clean_value = $this -> test_value;
							} else {
								$this -> clean_value = $this -> safetag($this -> default_value);
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
							}
						}
						break;
						
					case 'strns':	
						// string with no space
						// check if it's array
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								// check if is only alphanumeric
								if(ctype_alnum($val)) {
									$this -> clean_value[$key] = $this -> safetag($val);
								} else {
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
									$this -> clean_value = $this -> safetag($this -> default_value);
								}
							}
						} else {
							if(ctype_alnum($this -> test_value)) {
								$this -> clean_value = $this -> safetag($this -> test_value);
							} else {
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								$this -> clean_value = $this -> safetag($this -> default_value);
							}
						}	
						break;
						
					case 'strltd':		
						// string with no space
						// allow . _
						
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								if(preg_match("/^[-A-Z0-9\._]*$/i", $val)) {
									$this -> clean_value[$key] = $this -> safetag($val);
								} else {
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
									$this -> clean_value = $this -> safetag($this -> default_value);
								}
							}
						} else {
							if(preg_match("/^[-A-Z0-9\._]*$/i", $this -> test_value)) {
								$this -> clean_value = $this -> safetag($this -> test_value);
							} else {
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								$this -> clean_value = $this -> safetag($this -> default_value);
							}
						}
						break;
						
					case 'strltds':		
						// string with space 
						// allow . _
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								if(preg_match("/^[-A-Z0-9\._ ]*$/i", $val)) {
									$this -> clean_value[$key] = $this -> safetag($val);
								} else {
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
									$this -> clean_value = $this -> safetag($this -> default_value);
								}
							}
						} else {
							if(preg_match("/^[-A-Z0-9\._ ]*$/i", $this -> test_value)) {
								$this -> clean_value = $this -> safetag($this -> test_value);
							} else {
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								$this -> clean_value = $this -> safetag($this -> default_value);
							}
						}
						break;
						
					case 'email':		
						// email 
						if(is_array($this -> test_value)) {
							foreach($this -> test_value as $key => $val) {
								if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $val )) {
									$this -> clean_value[$key] = $this -> safetag($val);
								} else {
									$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
									$this -> clean_value = $this -> safetag($this -> default_value);
								}
							}
						} else {
							if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $this -> test_value )) {
								$this -> clean_value = $this -> safetag($this -> test_value);
							} else {
								$this -> error[] = $this -> arrAtt['name'] . $this -> getTranslatedError(0);
								$this -> clean_value = $this -> safetag($this -> default_value);	
							}
						}
						break;
						
					default:
						$this -> clean_value = (isset($this -> test_value) && $this -> test_value != '') ? $this -> safetag($this -> test_value) : $this -> safetag($this -> default_value);
				}
			} else {
				$this -> clean_value = (isset($this -> test_value) && $this -> test_value != '') ? $this -> safetag($this -> test_value) : $this -> safetag($this -> default_value);
			}
		}
		
		function check_length() {
			// Initialize and Clean minimum and max length value
			if(!isset($this -> arrAtt['minlen']) || trim($this -> arrAtt['minlen']) == '' ) {
				$this -> arrAtt['minlen'] = 0;
			} else {
				$this -> arrAtt['minlen'] = (int) $this -> arrAtt['minlen'];
			}
			
			if(!isset($this -> arrAtt['maxlen']) || trim($this -> arrAtt['maxlen']) == '' ) {
				$this -> arrAtt['maxlen'] = 0;
			} else {
				$this -> arrAtt['maxlen'] = (int) $this -> arrAtt['maxlen'];
			}
			
			if(!is_array($this -> test_value)) {
				// Check for data length
				if(strlen($this -> test_value) < $this -> arrAtt['minlen']) {
					//$this -> test_value = $this -> default_value;
					//$this -> error[] = $this -> arrAtt['name'] . ' accept minimun ' . $this -> arrAtt['minlen'] . ' character.';
					$tmpError = $this -> arrAtt['name'] . $this -> getTranslatedError(1);
					$this -> error[] = str_replace('[#NO#]', $this -> arrAtt['minlen'], $tmpError);
				} else if($this -> arrAtt['maxlen'] != 0 && strlen($this -> test_value) > $this -> arrAtt['maxlen']) {
					$this -> clean_value = substr($this -> test_value, 0, $this -> arrAtt['maxlen']);
					$tmpError = $this -> arrAtt['name'] . $this -> getTranslatedError(2);
					$this -> error[] = str_replace('[#NO#]', $this -> arrAtt['maxlen'], $tmpError);
				}
			}	
		}
		
		function check_required() {
			if (isset($this -> arrAtt['required'])) {
				if($this -> arrAtt['required'] == true) {
					if(is_array($this -> test_value)){
						foreach($this -> test_value as $strValue) {
							if($strValue === ''){
								$this -> error[] = $this -> arrAtt['name'] . self::$ERROR_DESC4;
								break;
							} // - end: if
						}					
					}
					else{
						if($this -> test_value === '') {
							$this -> error[] = $this -> arrAtt['name'] . self::$ERROR_DESC4;
						}					
					} // - end: if else
				}
			}
		}
		
		function checkEnum(&$param, &$default, &$arrValidStr, $arrAtt = null) {
			if(trim($param) != '' && is_array($arrValidStr) && in_array($param, $arrValidStr)) 
				return $this -> safetag($param);
			else {
				if(isset($arrAtt['required']) && $arrAtt['required'] == true) {
					isset($arrAtt['name'])? null : $arrAtt['name'] = '';
					$this -> error[] = $arrAtt['name'] . $this -> getTranslatedError(0);
				}
				return $this -> safetag($default);
			}
		}
		
		function getErrorKey() {
			if(count($this -> error) > 0){
				return (isset($this -> arrAtt['key'])) ? $this -> arrAtt['key'] : null;
			}
			else{
				return false;				
			}
		}
		
		function getError() {
			if(!empty($this -> error)){
				return implode('<hr/>', $this -> error);				
			}
		}
		
		function getTranslatedError($intErrorNo = 0) {
		/*
			$arrError['fr'] = array(' inadmissible',
									' acceptez seulement les caract&egrave;res du minimum [#NO#].',
									' acceptez les caractes du maximum [#NO#].'
									);
									
			$arrError['en'] = array(' is invalid ',
									' accept minimum [#NO#] characters.',
									' accept maximum [#NO#] characters.'
									);
			
			return $arrError[$this -> lang][$intErrorNo];
		*/
			$arrError = array(self::$ERROR_DESC1,self::$ERROR_DESC2,self::$ERROR_DESC3);
			return $arrError[$intErrorNo];
		}
		
		function safetag(&$input) {
			// convert ' " < > to htmlentities
			$cleanstr = &$input;
			if(is_array($input)) {
				
				foreach($input as $k => $v) {
					
					if(is_array($v)){
						$cleanstr[$k] = $this -> safetag($v);
					}
					else{
						$v = stripslashes($v);
						$v = str_replace(array('\'', '"', '<', '>'), array('&#039;', '&quot;', '&lt;', '&gt;'), $v);
						$v = addslashes($v);
						$cleanstr[$k] = $v;
					}
				}
			} else {
				$cleanstr = stripslashes($input);
				$cleanstr = str_replace(array('\'', '"', '<', '>'), array('&#039;', '&quot;', '&lt;', '&gt;'), $cleanstr);
				$cleanstr = addslashes($cleanstr);
			}
			return $cleanstr;
		}
		
		static function decodetag($input){
			return str_replace(array('&#039;', '&quot;', '&lt;', '&gt;'), array('\'', '"', '<', '>'), $input);
		}
		
		function clean() {
			$this -> arrAtt = null;
			$this -> test_value = null;
			$this -> default_value = null;
			$this -> clean_value = null;
			$this -> error = null;
		}
		
	}
?>