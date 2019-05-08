<?php
	/***
		Note:-
				This file is to declare the common functions that will be used in all the projects within the company.
	*/
	
	//==============================================================================================
	// Start: String related functions
	//==============================================================================================
	/***
		Function: str_compress
		Desc	: To compress or minify the string by removing those unnecessary spaces, new lines & tabs.
	*/    
	function str_compress($strValue) {
        /* remove comments */
        $strValue = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $strValue);
        /* remove tabs, spaces, newlines, etc. */
        $strValue = str_replace(array("\r\n","\r","\t","\n",'  ','    ','     '), '', $strValue);
        /* remove other spaces before/after ) */
        $strValue = preg_replace(array('(( )+\))','(\)( )+)'), ')', $strValue);
        return $strValue;
    }
	
	/***
		Function: str_sanitize
		Desc	: To sanitize the string for security reasons.
	*/	
	function str_sanitize($strValue){
		
		if(is_array($strValue)){ // To return empty value if the input type is incorrect.
			return '';
		} // - end: if

		$strValue = trim(stripslashes($strValue));

		// To sanitize the string that ends with backslashes, e.g. replace mystring\ by mystring\\
		if(preg_match('/([\\\\])+$/', $strValue, $arrMatches) && !empty($arrMatches[0])){

			if(strlen($arrMatches[0]) % 2 != 0){
				$strValue .= '\\';
			} // - end: if
		} // - end: if
		return str_replace(array('\'', '"', '<', '>'), array('&#039;', '&quot;', '&lt;', '&gt;'), $strValue);
	}

	/***
		Function: str_normalize
		Desc	: To normalize the string...e.g. converts the string AxxxBxxx to axxx_bxxx
	*/
	function str_normalize($strValue, $strDelim = '_'){
		
		if(($strValue2 = preg_replace('/([A-Z])/', $strDelim.'$1', $strValue)) !== NULL){
			return strtolower(trim($strValue2, $strDelim));
		}
		else{
			return $strValue;
		}
	}	
	
	/***
		Function: generate_random_string
		Desc	: To generate a random string
	*/
	function generate_random_string($intLength = 6){
		$str 			= '';  
		$aCharacters 	= array_merge(range('a','z'), range('0','9'));  
		$intMax 		= count($aCharacters) - 1;  
		
		for ($i = 0; $i < $intLength; $i++) {   
			$intRand = mt_rand(0, $intMax);  
			$str 	.= $aCharacters[$intRand];  
		} 
		
		// To replace 'l' to 'i', as it's ambiguous with '1'.
		return str_replace('l', 'i', $str); 	
	}
	
	/***
		Function: encrypt_decrypt
		Desc	: To encrypt or decrypt a string
	*/
	function encrypt_decrypt($strAction, $strInput) {
		$output 		= false;
		$encrypt_method = 'AES-256-CBC';
		$secret_key 	= 'nyzdl@80pj!';
		$secret_iv 		= 'nyzdl@80pj!ivu';

		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		if($strAction == 'encrypt') {
			$output = openssl_encrypt($strInput, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if($strAction == 'decrypt'){
			$output = openssl_decrypt(base64_decode($strInput), $encrypt_method, $key, 0, $iv);
		} // - end: if else

		return $output;
	}	
	
	//==============================================================================================
	// Start: UI-Widgets related functions
	//==============================================================================================
	/***
		Function: get_button
		Desc	: To get a button ui.
	*/	
	function get_button($strLabel, $intWidth = 0, $strUrl = '', $strElementId = '', $strColor = 'red', $strCssClass = '', $strUrlTarget = '', $strIcon = '', $strRel = '') {
		if(($intWidth - 12) > 0){
			$strCenterContentWidth = ' style="width:'.($intWidth - 12).'px"';
		}
		else{
			$strCenterContentWidth = '';
		}
		
		$strButtonWidth = ' style="width:'.$intWidth.'px"';
		
		if($strElementId !== ''){
			$strElementId = ' id="'.$strElementId.'"';
		}
		if($strIcon !== '') {
			$strContent = '<div style="float:left;padding:0px 4px;">' . $strIcon . '</div><div style="float:left;padding:0px 3px;">' . $strLabel . '</div><div class="clear"></div>';
		} else {
			$strContent = $strLabel;
		}
		
		if($strUrl === 'btnSubmitForm' || $strUrl === 'btnResetForm'){
			$strButtonContent 	= '<a rel="" class="'.$strUrl.'" href="javascript:void(0);">';
			$strCssClass		= $strUrl;
		}
		else if($strUrl !== ''){			
			$strButtonContent = '<a href="'.$strUrl.'">';
			
			if($strUrlTarget === '_blank'){
				$strButtonContent = '<a target=="'.$strUrlTarget.'" href="'.$strUrl.'">';
			}
			else{
				$strButtonContent = '<a href="'.$strUrl.'">';
			}
		}
		else{
			$strButtonContent = '<a href="javascript:void(0);">';
		}
		
		$intHeight = 27;
		
		$strButton = '
		<div rel="'.$strRel.'" class="'.$strColor.'_button '.$strCssClass.'" '.$strElementId.$strButtonWidth.'>
			<div class="'.$strColor.'_button_wrapper">' . $strButtonContent . '
				<div class="left_corner"><img src="' . Yii::app()->request->baseUrl . '/themes/'.THEME.'/images/alllanguages/btn_'.$strColor.'_left_corner.png" width="6" height="'.$intHeight.'" alt="" border="0" /></div>
				<div class="center_content"'.$strCenterContentWidth.'><div>'. $strContent .'</div></div>
				<div class="right_corner"><img src="' . Yii::app()->request->baseUrl . '/themes/'.THEME.'/images/alllanguages/btn_'.$strColor.'_right_corner.png" width="6" height="'.$intHeight.'" alt="" border="0" /></div>
				<div class="clear"><!-- Clear --></div></a>
			</div>
		</div>';
		
		return $strButton;
	}
	
	//==============================================================================================
	// Start: Date & time related functions
	//==============================================================================================
	/***
		* Function    : format_date
		* Description : To convert date from any format to any format !.
		* Dependency  : format_date_lang.
		 -------------------------------------------------------------------------------------------
		|  a  | Lowercase Ante meridiem and Post meridiem   	|   am or pm        				|    
		 -------------------------------------------------------------------------------------------
		|  A  | Uppercase Ante meridiem and Post meridiem 		|	AM or PM 						|
		 -------------------------------------------------------------------------------------------	
		|  B  |	Swatch Internet time 							|	000 through 999					|		
		 -------------------------------------------------------------------------------------------	
		|  c  | ISO 8601 date (added in PHP 5) 					|	2004-02-12T15:19:21+00:00 		|
		 -------------------------------------------------------------------------------------------	
		|  d  |	Day of the month, 								|	01 to 31						|								
		|	  |	2 digits with leading zeros 					|	 								|									
		 -------------------------------------------------------------------------------------------	
		|  D  |	A textual representation of a day,          	|   Mon through Sun 				|
		|	  |	three letters 									|									|						
		 -------------------------------------------------------------------------------------------	
		|  F  |	A full textual representation of a month,   	|	January through December		
		|	  |	such as January or March 						| 									|
		 -------------------------------------------------------------------------------------------	
		|  g  |	12-hour format of an hour without           	|	1 through 12 
		| 	  |	leading zeros 									|									|
		 -------------------------------------------------------------------------------------------	
		|  G  |	24-hour format of an hour without    			|	0 through 23
		|	  |	leading zeros 									| 									|
		 -------------------------------------------------------------------------------------------	
		|  h  |	12-hour format of an hour with leading zeros 	|	01 through 12 					|
		 -------------------------------------------------------------------------------------------	
		|  H  |	24-hour format of an hour with leading zeros 	|	00 through 23 					|
		 -------------------------------------------------------------------------------------------	
		|  i  |	Minutes with leading zeros 						|	00 to 59 						|
		 -------------------------------------------------------------------------------------------	
		|  I  |	Whether or not the date is in daylights 		|	1 if Daylight Savings Time,		|
		|	  |	savings time 									| 	0 otherwise. 
		|	  |													|									|
		 -------------------------------------------------------------------------------------------	
		|  j  |	Day of the month without leading zeros 			|	1 to 31 						|
		 -------------------------------------------------------------------------------------------	
		|  l  |	A full textual representation of 				|	Sunday through Saturday			|
		|  	  |	the day of the week 							| 									|
		 -------------------------------------------------------------------------------------------	
		|  L  |	Whether it's a leap year 1 						|	if it is a leap year,			|
		|	  |													|	0 otherwise. 					|					
		 -------------------------------------------------------------------------------------------	
		|  m  |	Numeric representation of a month, 				|	01 through 12 					|						
		|	  |	with leading zeros 								|									|
		 -------------------------------------------------------------------------------------------	
		|  M  |	A short textual representation of a month, 		|	Jan through Dec 				|				
		|	  |	three letters 									|									|
		 -------------------------------------------------------------------------------------------	
		|  n  |	Numeric representation of a month, 				|	1 through 12 					|
		|	  |	without leading zeros 							|									|
		 -------------------------------------------------------------------------------------------	
		|  O  |	Difference to Greenwich time (GMT) in hours 	|	Example: +0200 					|
		 -------------------------------------------------------------------------------------------	
		|  r  |	RFC 2822 formatted date 						|	Example: Thu, 21 Dec 2000 		|	
		|	  |													|   16:01:07 +0200 					|
		 -------------------------------------------------------------------------------------------	
		|  s  |	Seconds, with leading zeros 					|	00 through 59 					|
		 -------------------------------------------------------------------------------------------	
		|  S  |	English ordinal suffix for the day of 			|	st, nd, rd or th.				|
		|	  |	the month, 2 characters 						| 									|
		 -------------------------------------------------------------------------------------------	
		|  t  |	Number of days in the given month 				|	28 through 31 					|
		 -------------------------------------------------------------------------------------------	
		|  T  |	Timezone setting of this machine 				|	Examples: EST, MDT ... 			|
		 -------------------------------------------------------------------------------------------	
		|  U  |	Seconds since the Unix Epoch 					|	January 1 1970 00:00:00 GMT 	|
		 -------------------------------------------------------------------------------------------	
		|  w  |	Numeric representation of the day of the week 	|	0 (for Sunday) through 			|		
		|	  |													|	6 (for Saturday) 				|
		 -------------------------------------------------------------------------------------------	
		|  W  |	ISO-8601 week number of year, 					|	42 (the 42nd week in the year)	|
		|	  |	weeks starting on Monday  						| 									|
		 -------------------------------------------------------------------------------------------	
		|  Y  |	A full numeric representation of a year, 		|	1999 or 2003					|
		|	  |	4 digits 										| 									|
		 -------------------------------------------------------------------------------------------	
		|  y  |	A two digit representation of a year 			|	99 or 03 						|
		 -------------------------------------------------------------------------------------------	
		|  z  |	The day of the year (starting from 0) 			|	0 through 365 					|
		 -------------------------------------------------------------------------------------------	
		|  Z  |	Timezone offset in seconds. 					|	-43200 through 43200 			|
		|	  |	The offset for timezones west of 				|									|
		|     |	UTC is always negative, and for those east 		|									|	
		|     |	of UTC is always positive. 						|									|
		 -------------------------------------------------------------------------------------------	
		// if u pass 0202 OR 02:02 = hhii
		// if u pass 02-02 OR 02/02 = mm-dd OR mm/dd
	*/	
	function format_date($date, $format = 'Y-m-d H:i:s', $lang = 'en') {
		$strDate = '';
		
		if($date!='') {
		
			for ($i = 0; $i < strlen($format); $i++) {
	
				if (preg_match("/^[a-zA-Z]/", $format{$i})) {
	
					switch ($format{$i}) {
	
						case 'a':
						case 'A':
							$strDate .= format_date_lang($date, '%p', $lang);
							break;
	
						case 'D':
							$strDate .= format_date_lang($date, '%a', $lang);
							break;
	
						case 'l':
							$strDate .= format_date_lang($date, '%A', $lang);
							break;
	
						case 'M':
							$strDate .= format_date_lang($date, '%b', $lang);
							break;
	
						case 'F':
							$strDate .= format_date_lang($date, '%B', $lang);
							break;
	
						default:
							$strDate .= date($format{$i}, strtotime($date));
							break;
					}
				}
				else {
					$strDate .= $format{$i};
				}
			}
		}
		return $strDate;
	}

	/***
		Function    : format_date_lang
		Description : To format the language-based date format.
	*/
	function format_date_lang($date, $format = '%c', $lang = 'en') {
		
		if($date!='') {
		
			switch ($lang) {
	
				case 'fr':
					setlocale(LC_TIME, 'fr_FR.utf8', 'fr-FR.utf8', 'French');
					break;
	
				case 'es':
					setlocale(LC_TIME, 'es_ES.utf8', 'es-ES.utf8', 'Spanish');
					break;
	
				case 'cn':
				case 'zh':
					setlocale(LC_TIME, 'zh_CN.utf8', 'zh-CN.utf8', 'Chinese');
					break;
	
				case 'ja':
				case 'jp':
					setlocale(LC_TIME, 'ja_JP.utf8', 'ja-JP.utf8', 'Japanese');
					break;
	
				case 'pt':
					setlocale(LC_TIME, 'pt_PT.utf8', 'pt-PT.utf8', 'Portuguese');
					break;
	
				case 'uk':
				case 'en':
				default:
					setlocale(LC_TIME, 'en_US.utf8', 'en-US.utf8', 'English');
					break;
			}	
			return strftime($format, strtotime($date));
		}
		return;
	}
	
	/***
		Function: get_current_datetime
		Desc	: To get the current datetime.
	*/
	function get_current_datetime($strDateFormat = 'Y-m-d H:i:s', $intTimestamp = null){
		
		if(class_exists('DbServerTime')){
			return DbServerTime::getCurrentDatetime($strDateFormat, $intTimestamp);
		}
		else{
		
			if($intTimestamp === null || $intTimestamp === ''){
				return date($strDateFormat);
			}
			else{
				return date($strDateFormat, $intTimestamp);
			}		
		}
	}

	/***
		Function: is_valid_date
		Desc	: To validate the date by DateType.
		DateType: 	(1) 'ym' validates date with format 'yyyy-mm' or 'yyyy/mm'
					(2) 'ymd' validate date with format 'yyyy-mm-dd' or 'yyyy/mm/dd'
					(3) 'ymd h:m:s' validate date with format 'yyyy-mm-dd hh:mm:ss' or 'yyyy/mm/dd hh:mm:ss'
					(4) 'dmy' validate date with format 'dd-mm-yyyy' or 'dd/mm/yyyy'
					(5) 'dmy h:m:s' validate date with format 'dd-mm-yyy hh:mm:ss' or 'dd/mm/yyyy hh:mm:ss'
	*/
	function is_valid_date($strDate, $strDateType='') {
	
		if(trim($strDate) != '') {
			//get first occurrence from the date format pass in. If no delimiter found, default to dash '-'.
			$delimiter = strpos($strDate,'-') > 0 ? '-' : ((strpos($strDate,'/') > 0) ? '/' :'-');
	
			if ($strDateType =='ym') {
			
				if (eregi("^[0-9]{4}".$delimiter."[0-9]{2}$", $strDate)) {
					$intYear   = (int) substr($strDate,0,4);
					$intMonth  = (int) substr($strDate,5,2);
								
					if($intYear < 1000 || $intYear > 9999 || $intMonth <=0 || $intMonth > 12) {
						return 0;
					}					
					return 1;				
				} 
				else {
					return 0;
				}
			} 
			else {
				$strDateType2 = substr($strDateType, 0, 3); // To get dmy or ymd
				$strDate1   = $strDate;
				$strDate    = ($strDateType =='dmy h:m:s' || $strDateType =='ymd h:m:s') ? substr($strDate,0,10) : $strDate;
				$intColumn2 = 2;
				
				if($strDateType2 =='dmy') {
					$intColumn1 = 2;
					$intColumn3 = 4;						
				}
				else { //$strDateType =='ymd'
					$intColumn1 = 4;					
					$intColumn3 = 2;			
				}

				if(preg_match("/^[0-9]{".$intColumn1."}".$delimiter."[0-9]{".$intColumn2."}".$delimiter."[0-9]{".$intColumn3."}$/i", $strDate)) {
					$date_arr = explode($delimiter, $strDate);
					$intMonth = $date_arr[1];
					
					if($strDateType2 =='dmy') {						
						$intDay   = $date_arr[0];
						$intYear  = $date_arr[2];
												
					}
					else { //$strDateType =='ymd'
						$intDay   = $date_arr[2];
						$intYear  = $date_arr[0];			
					}			
						
					if ($intYear >= 1000 && $intYear <= 9999) {				 	
	
						if (checkdate($intMonth, $intDay, $intYear)) {
							//validate time format
							if ($strDateType == 'dmy h:m:s' || $strDateType == 'ymd h:m:s') {							

								$strTime= substr($strDate1, 11);
								if(preg_match("/^[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}$/i", $strTime)) {
									
									if(check_time_format($strTime)!='') {
										return $strDate1;
									}
									return 0;
								}				
								return 0;
							}
							unset($date_arr);
							return 1;
						}
						else {
							unset($date_arr);
							return 0;
						}
					}
					else {
						 unset($date_arr);
						 return 0;					
					}
				 }
				 else{
					 return 0;				 
				}
			}
		}
		return 0;
	}
	
	/***
		Function: check_time_format
		Desc	: To validate the datetime.
	*/	
	function check_time_format($strTimeInput) {

		if(!empty($strTimeInput)) {
			$strTime    = trim($strTimeInput);			
			$strHour    = (substr($strTime,0,2) > 24) ? '' : substr($strTime,0,2);					
			$strMinutes = (substr($strTime,3,2) > 60) ? '' : substr($strTime,3,2);					
			$strSecond  = (substr($strTime,6,2) > 60) ? '' : substr($strTime,6,2);					
			
			return ($strHour != '' && $strMinutes !='' && $strSecond!='') ? $strHour.':'.$strMinutes.':'.$strSecond : '';			
		}
		return '';
	}
	
	//==============================================================================================
	// Start: Email related functions
	//==============================================================================================	
	/***
		Function: is_valid_email
		Desc	: To validate the email format.
	*/	
	function is_valid_email($strInput = null) {
		
		if($strInput != '') {
			
			if(ereg("^[^@ ]+@[^@ ]+\.[^@ \.]+$", $strInput) ) {
				return true;
			}
			else {
				return false;
			}
		} 
		else{
			return false;
		}
	}
	
	/***
		Function: send_email
		Desc	: To send email.
	*/	
	function send_email($strEmailTo, $strNameTo, $strEmailFrom, $strNameFrom, $strEmailContents, $strSubject, $bolHtml = true, $arrBcc = '', $strLayout = 'config', $bolDebug = false) {
		$objMail = new YiiMailer();  // create a new object
		
		if($strLayout === null){
			$objMail->clearLayout(); // to clear layout setting in config
		}
		else if($strLayout !== 'config'){
			$objMail->setLayout($strLayout);
		} // - end: if else
		
		if ($bolHtml) {
			$objMail->IsHTML(true);
		}
		else{
			$objMail->IsHTML(false);
		} // - end: if else
		
		// see config file(under path and mail section) for more info
		if (false == SMTP_MODE) {
			$objMail->IsMail();
		}
		else {
			$objMail->IsSMTP();						// send via SMTP
			$objMail->SMTPDebug 	= $bolDebug;  	// debugging: errors and messages, non-debugging: messages only
			$objMail->SMTPSecure 	= SMTP_SECURE; 	// secure transfer
			$objMail->Host			= SMTP_HOST;	// SMTP servers
			$objMail->Port 			= SMTP_PORT;
			$objMail->SMTPAuth 		= SMTP_AUTH;	// turn on SMTP authentication
			$objMail->Username 		= SMTP_USER;	// SMTP username
			$objMail->Password 		= SMTP_PASS;	// SMTP password
		} // - end: if else

		$objMail->setFrom($strEmailFrom, $strNameFrom);
		$objMail->AddReplyTo($strEmailFrom, $strNameFrom);
		$objMail->setSubject($strSubject);
		$objMail->setBody($strEmailContents);
		$objMail->AddAddress($strEmailTo, $strNameTo); // copy this line to add a new person
		$objMail->CharSet = 'UTF-8';
		
		if (!empty($arrBcc[0])) {
			
			foreach($arrBcc as $strBcc){
				$objMail->AddBCC($strBcc);
			} // - end: foreach
		} // - end: if
	
		if((!$bolResult = $objMail->Send()) && $bolDebug === true) {
			echo "Message was not sent <p>";
			echo "Mailer Error: " . $objMail->ErrorInfo;			
		} // - end: if
		return $bolResult;
	}	

	//==============================================================================================
	// Start: Number & currency related functions
	//==============================================================================================
	/***
		Function: get_currency_format
		Desc	: To get the number in currency format. E.g. 'RMB 1,000.68'
	*/
	function get_currency_format($dblAmount = 0, $strCurrency = DEFAULT_CURRENCY){
		
		if($dblAmount == ''){
			$dblAmount = 0;
		} // - end: if
		return $strCurrency . ' ' . get_thousand_seperator_num_format($dblAmount);
	}

	/***
		Function: get_normal_number_format
		Desc	: To get the normal number format. E.g. 1000.68
	*/	
	function get_normal_number_format($dblAmount, $intDecimalPts = 2){
		return number_format((float)$dblAmount, $intDecimalPts, '.', '');
	}
	
	/***
		Function: get_thousand_seperator_num_format
		Desc	: To get the number in thousand seperator format. E.g. 1,000.68
	*/	
	function get_thousand_seperator_num_format($dblAmount, $intDecimalPts = 2){
		return number_format((float)$dblAmount, $intDecimalPts, '.', ',');
	}

	/***
		Function: get_pnl_format
		Desc	: To get the number in the PNL format.
	*/	
	function get_pnl_format($dblAmount = 0, $strCurrency = DEFAULT_CURRENCY){
		$strValue = get_currency_format($dblAmount, $strCurrency);
		
		if($dblAmount < 0){
			$strValue = '<span class="css_freeze">' . $strValue . '</span>';
		}
		else{
			$strValue = '<span class="css_active">' . $strValue . '</span>';
		} // - end: if else
		return trim($strValue);
	}
	
	/***
		Function	  : round_up
		Description : Rounds a number up to a specified number of decimal places, away from 0 (zero). It's similar to the excel function ROUNDUP().
		E.g. : round_up(3.14120, 3) = 3.142, round_up(-0.453001, 4) = -0.4531
	*/
	function round_up($dblNumber, $intDecimalPlace = 0) {
		$dblNumber 			= round((float)$dblNumber, 13);
		$intDecimalPlace 	= (int)$intDecimalPlace;
		$intMultiply 		= pow(10, $intDecimalPlace);
		return ($dblNumber >= 0 ? ceil($dblNumber * $intMultiply):floor($dblNumber * $intMultiply)) / $intMultiply;
	}
	
	//==============================================================================================
	// Start: File related functions
	//==============================================================================================
	/***
		Function: validate_file_type
		Desc	: To validate the file type
	*/	
	function validate_file_type($strFileName, $arrValidType){
		$strType 	 	= '';
		$arrFileName 	= explode('.', basename($strFileName));
		$strExtension	= strtolower(end($arrFileName));

		if(in_array($strExtension, $arrValidType)) {
			return true;
		} 
		else {
			return false;
		}
	}
	
	/***
		Function: readfile_chunked
		Desc	: To validate the file type.
				  This function is same as readfile($filename)
				  useful when providing large file download
				  this way will reduce the memory use by the server
	*/
	function readfile_chunked($strFileName) {		
		$intChunkedSize = 1*(1024*1024); // how many bytes per chunk
		$strBuffer 		= '';
		$handle 		= fopen($strFileName, 'rb');
		
		if($handle === false) {
			return false;
		}
		
		while(!feof($handle)) {
			$strBuffer = fread($handle, $intChunkedSize);
			echo $strBuffer;
			flush();
		}
		return fclose($handle);
	}
	
	/***
		Function: download_file
		Desc	: To download file.
	*/	
	function download_file($strFilename, $strPath = './') {
		Yii::import('application.vendor.ydl.filemanager.*');
		require_once 'FileManager.class.php';
		$fm = new FileManager();
		$fm -> download($strFilename, $strPath);
	}
	
	/***
		Function: upload_file
		Desc	: To upload file.
	*/	
	function upload_file($strFilename, $strTmpFilename, $strPath, $strType = null) {
		Yii::import('application.vendor.ydl.filemanager.*');
		require_once 'FileManager.class.php';	
		$fm = new FileManager();
		
		if($strUploadedFilename = $fm -> upload($strFilename, $strTmpFilename, $strPath, $strType)) {
			return $strUploadedFilename;
		}
		else {
			return false;
		} // - end: if else
	}	

	/***
		Function: remove_file
		Desc	: To remove file.
	*/	
	function remove_file($strFilename, $strPath) {
		Yii::import('application.vendor.ydl.filemanager.*');
		require_once 'FileManager.class.php';	
		$fm = new FileManager();
		$fm -> remove($strFilename, $strPath);
	}

	//==============================================================================================
	// Start: Image related functions
	//==============================================================================================	
	/***
		Function    : resize_image
		Description : To resize an image. If there is only width(or height) is provided.
					  Then, it's height(or width) will be automatically resized in the same ratio as
					  the changes in width(or height).
		Dependency  : Image Class.
	*/
	function resize_image($intWidth, $intHeight, $strOriImagePath, $strNewImagePath, $intQuality = 100) {
		// - Validations
		if(file_exists($strOriImagePath) === false) {
			return false;
		} // - end: if

		try {
			list($intOriWidth, $intOriHeight) = getimagesize($strOriImagePath);
		}
		catch (Exception $e){
			return false;
		}

		//resize image with ratio where height provided
		if($intWidth == null && $intHeight > 0){
			$intWidth = $intHeight / $intOriHeight * $intOriWidth ;
		}
		//==============================================================================================
		// Start: Resize Image
		//==============================================================================================
		Yii::import('application.vendor.ydl.image.*');
		require_once 'Image.class.php';
		$objImage = new Image();

		$objImage->Load($strOriImagePath);
		$objImage->Resize($intWidth , $intHeight);
		$objImage->SaveAs($strNewImagePath, $intQuality);
		$objImage->Flush();
		unset($objImage);
		//==============================================================================================
		// End: Resize Image
		//==============================================================================================
		return true;
	} // - end: function	
	
	//==============================================================================================
	// Start: Miscellaneous Functions
	//==============================================================================================
	/***
		Function: get_ip
		Desc	: To get the client's IP address.
	*/
	function get_ip() {

		if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) { // CloudFlareIP
			$strIp = str_sanitize($_SERVER['HTTP_CF_CONNECTING_IP']); 
		}
		else if(getenv("HTTP_CLIENT_IP")) { // check ip from share internet
			$strIp = str_sanitize(getenv("HTTP_CLIENT_IP")); 
		}
		elseif(getenv("HTTP_X_FORWARDED_FOR")) { // to check ip is pass from proxy
			$strIp = str_sanitize(getenv("HTTP_X_FORWARDED_FOR")); 
		}
		else {
			$strIp = str_sanitize(getenv("REMOTE_ADDR")); 
		}
		
		$arrIP = explode(',', $strIp);

		if(!empty($arrIP[1])){
			return trim($arrIP[1]);
		}
		else{
			return $strIp;
		}
	}
	
	/***
		 Function : json_unescaped_unicode_encode
		 Desc.	  : To json_encode the input, and it returns the data in the raw format for some kind of chars(e.g. the Chinese chars) 
	 */
	function json_unescaped_unicode_encode($input) {

		return preg_replace_callback(
			'/\\\\u([0-9a-zA-Z]{4})/',
			function ($arrMatches) {
				return mb_convert_encoding(pack('H*',$arrMatches[1]),'UTF-8','UTF-16');
			},
			json_encode($input)
		);
	}
	
	/***
		Function: json_encodes
		Desc	: To encode the input into json format
	*/	
	function json_encodes($var) {
		if (function_exists('json_encode')) {
			return json_encode($var);
		} 
		else {
			switch (gettype($var)) {
				case 'boolean':
					return $var ? 'true' : 'false'; // Lowercase necessary!
				case 'integer':
				case 'double':
					return $var;
				case 'resource':
				case 'string':
					return '"'. str_replace(array("\r", "\n", "<", ">", "&"),
						array('\r', '\n', '\x3c', '\x3e', '\x26'),
						addslashes($var)) .'"';
				case 'array':
					// Arrays in JSON can't be associative. If the array is empty or if it
					// has sequential whole number keys starting with 0, it's not associative
					// so we can go ahead and convert it as an array.
					if (empty ($var) || array_keys($var) === range(0, sizeof($var) - 1)) {
						$output = array();
						foreach ($var as $v) {
							$output[] = json_encodes($v);
						}
						return '[ '. implode(', ', $output) .' ]';
					}
					// Otherwise, fall through to convert the array as an object.
				case 'object':
					$output = array();
					foreach ($var as $k => $v) {
						$output[] = json_encodes(strval($k)) .': '. json_encodes($v);
					}
					return '{ '. implode(', ', $output) .' }';
				default:
					return 'null';
			}
		}
	}

	/***
		Function: curl_get
		Desc	: To perform a cURL request
	*/	
	function curl_get($strUrl, $arrPost=''){
		//curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
		if(defined('DEV_MODE') && DEV_MODE){
			$arrOptions = array(
				CURLOPT_RETURNTRANSFER => true,     // return web page
				CURLOPT_HEADER         => false,    // don't return headers
				CURLOPT_FOLLOWLOCATION => true,     // follow redirects
				//CURLOPT_ENCODING       => "UTF-8",       // handle compressed
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect
				//CURLOPT_PORT		   => 443,
				CURLOPT_SSL_VERIFYHOST => 1,
				CURLOPT_SSL_VERIFYPEER => false,
				//CURLOPT_CAINFO		   => 'E:\path\to\curl-ca-bundle.crt',
				CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
				CURLOPT_TIMEOUT        => 120,      // timeout on response
				CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
				//CURLOPT_HTTPHEADER     => array('Host: localhost Content-Type: text/xml;charset=UTF-8'),
				CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)',
				CURLOPT_POSTFIELDS     => $arrPost,
			);
		}
		else{
			$arrOptions = array(
				CURLOPT_RETURNTRANSFER => true,     // return web page
				CURLOPT_HEADER         => false,    // don't return headers
				CURLOPT_FOLLOWLOCATION => true,     // follow redirects
				//CURLOPT_ENCODING       => "UTF-8",       // handle compressed
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect
				//CURLOPT_PORT		   => 443,
				CURLOPT_SSL_VERIFYPEER => true,
				//CURLOPT_CAINFO		   => 'E:\path\to\curl-ca-bundle.crt',
				CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
				CURLOPT_TIMEOUT        => 120,      // timeout on response
				CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
				//CURLOPT_HTTPHEADER     => array('Host: localhost Content-Type: text/xml;charset=UTF-8'),
				CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)',
				CURLOPT_POSTFIELDS     => $arrPost,
			);
		}
		$rscCh = @curl_init($strUrl);

		curl_setopt_array($rscCh, $arrOptions);
		//curl_setopt ($rscCh, CURLOPT_HTTPHEADER, array('SOAPAction: "urn:getSubscriberProfile"'));
		$strContent	= @curl_exec($rscCh);
		$intErrNo   = @curl_errno($rscCh);
		$strErrMsg  = @curl_error($rscCh);
		$arrHeader  = (array)@curl_getinfo($rscCh);
		curl_close($rscCh);

		$arrHeader['errno']   = $intErrNo;
		$arrHeader['errmsg']  = $strErrMsg;
		$arrHeader['content'] = $strContent;
		return $arrHeader;
	}	
?>