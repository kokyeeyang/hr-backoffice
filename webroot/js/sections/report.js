/*** 
	Start	: Report Section 
	By		: KC 2014-03-10
*/
var Report = function() {

	function _init(){
		$(function() {

			if($("#admin-activity-log-list-form").length > 0){
				$('#log_search_start_date').datetimepicker({
					dateFormat: "yy-mm-dd",
					timeFormat: 'HH:mm:ss',
					showSecond: true				
				});
				
				$('#log_search_end_date').datetimepicker({
					dateFormat: "yy-mm-dd",
					timeFormat: 'HH:mm:ss',
					showSecond: true				
				});				
			}			
		});
	}
	
	return {
		init : _init,
	}
}();
Report.init();
/*** End: Report Section */