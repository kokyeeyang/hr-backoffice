<?php
	/***
	* This is the location for putting basic functions
	* The functions located here shouldn't be dependent on the other user-defined functions in Stdlib. 
	* Anyway, the functions here can be dependent on the other functions in which defined in the Basiclib itself.
	* Normally, these functions will be included in the main config files prior to the Stdlib.
	*/
	class Basiclib {
		/***
		* Function    : get_console_opt
		* Description : To get the cli console option value based on the format of --var1=value1.
		*               E.g. for getting the console's option --game_id=10, you can pass in 'game_id', it will return 10.
		*/
		public static function get_console_opt($strOption){
			$strResult = '';
			
			if($strOption !== '' && isset($_SERVER['argv']) && is_array($_SERVER['argv'])){

				foreach($_SERVER['argv'] as $strOptionValue){
					
					if(preg_match('/^--([A-z0-9_]+)=(.*)$/', $strOptionValue, $arrMatches) === 1 && isset($arrMatches[2]) && $arrMatches[1] == $strOption){
						$strResult = $arrMatches[2];
						break;
					} // - end: if
				} // - end: foreach
			} // - end: if
			return $strResult;
		}
	}