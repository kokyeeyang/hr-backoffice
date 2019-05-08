var IpShowAllWhitelistIp = function() {
	function _check_if_deletion_is_selected(objElement, objEvent){
		//make sure that user actually selected an ip address to delete
	  if ($(".deleteCheckBox:checked").length <= 0){
	  	alert($('#msg-select-ip-delete').attr('data-msg'));
	  } else {
	  	if (confirm($('#msg-confirm-ip-delete').attr('data-msg'))){
	  		$('#whitelistip-list').attr('action', $(objElement).attr('data-delete-url')).submit();
		  }
	  }
	}

	function _init() {
		$(function() {
			$('#deleteWhitelistButton').on('click', function(objEvent){
				IpShowAllWhitelistIp.check_if_deletion_is_selected(this, objEvent);

			});

			//this is the filter box for the ip address table
		  $("#label_filter").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#data_table tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });			
		});
	}

	return {
		init : _init,
		check_if_deletion_is_selected : _check_if_deletion_is_selected
	}	
}();
IpShowAllWhitelistIp.init();
/*** End: IpShowAllWhitelistIp Section */