<?php
Class DbServerTime{

	function __construct(){
		//  -- Year Format --
		//			$dateFormatYear1 = date('y', strtotime($customDatetime));
		//			$dateFormatYear2 = date('Y', strtotime($customDatetime));
		//  -- Month Format --
		//			$dateFormatMonth1 = date('m', strtotime($customDatetime)); // Numeric representation of a month, with leading zeros :: 01 through 12
		//			$dateFormatMonth2 = date('n', strtotime($customDatetime)); // Numeric representation of a month, without leading zeros :: 1 through 12
		//			$dateFormatMonth3 = date('M', strtotime($customDatetime)); // A short textual representation of a month, three letters :: Jan through Dec
		//			$dateFormatMonth4 = date('F', strtotime($customDatetime));  // Day of the month, 2 digits with leading zeros :: 01 to 31
		//  -- Day Format --
		//			$dateFormatDay1 = date('d', strtotime($customDatetime));  // Day of the month, 2 digits with leading zeros :: 01 to 31
		//			$dateFormatDay2 = date('j', strtotime($customDatetime)); // Day of the month without leading zeros :: 1 to 31
		//			$dateFormatDay3 = date('D', strtotime($customDatetime)); // A textual representation of a day, three letters :: Mon through Sun
		//  -- Time Format --
		//			$dateFormatHour1 = date('h', strtotime($customDatetime)); // 12-hour format of an hour with leading zeros :: 01 through 12
		//			$dateFormatHour2 = date('H', strtotime($customDatetime)); // 24-hour format of an hour with leading zeros :: 00 through 23
		//			$dateFormatMinutes = date('i', strtotime($customDatetime));	// Minutes with leading zeros :: 00 to 59
		//			$dateFormatSecond = date('s', strtotime($customDatetime));   // Seconds, with leading zeros :: 00 through 59
		//			$dateFormatMicroSecond =  date('u',strtotime($customDatetime));			// Microseconds (added in PHP 5.2.2) :: Example: 654321

		//			$search = array('y', 'Y', 'm', 'n', 'M', 'F', 'd', 'j', 'D', 'h', 'H', 'i', 's');
		//			$replace = array(
		//						$dateFormatYear1, $dateFormatYear2, $dateFormatMonth1, $dateFormatMonth2, $dateFormatMonth3, $dateFormatMonth4,
		//						$dateFormatDay1, $dateFormatDay2, $dateFormatDay3, $dateFormatHour1, $dateFormatHour2, $dateFormatMinutes, $dateFormatSecond
		//						);
		//			$tempDatetime = str_replace($search, $replace, $date_Format);
	}
	
	function __destruct() {
	}

	public static function getCurrentDatetime($strDateFormat, $intTimestamp = null) {
		
		if($intTimestamp === null || $intTimestamp === ''){
			$sql 				= 'SELECT NOW() AS current_datetime';
			$objConnection 		= Yii::app()->db;
			$objCommand			= $objConnection->createCommand($sql);
			$arrData			= $objCommand->queryRow();
			
			if(!empty($arrData['current_datetime'])){
				return date($strDateFormat, strtotime($arrData['current_datetime']));
			} // - end: if
		}
		return date($strDateFormat, $intTimestamp);
	}
}