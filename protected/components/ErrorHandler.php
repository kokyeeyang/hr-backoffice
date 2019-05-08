<?php
/**
 * ErrorHandler is the customized error handler for the application.
 */
class ErrorHandler extends CErrorHandler {
    
	public function handle($event) {
		
		if($this->isAjaxRequest()){
			// By default, the following line is commented to disable the ErrorHandler for the Ajax requests.
			// This is to prevent the error message to be displayed in the browser from the Ajax requests.
			// To enable it, you can uncomment the following line of code - parent::handle($event).
			// parent::handle($event);
		}
		else{
			parent::handle($event);
		} // - end: if else
    }	
}