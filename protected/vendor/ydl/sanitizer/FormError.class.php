<?php
	class FormError {
		/**
			Used to capture and return validation error 
			when using check_param 
			By Chua
		*/
		var $arrErrorKey = array();
		
		function FormError() {
		
		}
		
		function addKeyError($key, $error) {
			$this -> arrKeyError[$key] = $error;
		}
		
		function getKeyError($key) {
			if(isset($this -> arrKeyError[$key]) && $this -> arrKeyError[$key] != '') {
				return $this -> arrKeyError[$key];
			} else {
				return false;
			}
		}
		
		function getError() {
			if(!empty($this -> arrKeyError)){
				return implode('<hr/>', $this -> arrKeyError);				
			}
		}
	}
?>