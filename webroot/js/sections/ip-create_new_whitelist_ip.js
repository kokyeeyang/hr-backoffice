var IpCreateNewWhitelistIp = function() {
	function _check_for_existing_ip(objElement, objEvent){
		if($(objElement).val() != '')
		{
			var duplicateIpAlert = document.getElementById("duplicateIpAlert");
			$.ajax({
				type: 'post',
				url: $(objElement).attr('data-url'),
				data: {
					ip_address : $(objElement).val()
				},
				dataType: 'json',
				success: function(data)
				{
					if(data != null && data.result == true){
						duplicateIpAlert.style.display = "block";
					}else if(data != null && data.result == false){
						duplicateIpAlert.style.display = "none";
					}
				}, 
				error: function(request, status, err)
				{
					alert('wrong');
				}
			});
		}
	}

	function _init(){	
		$(function() {
			
			$('input#ip_address').bind('keyup', function(objEvent) {
				//this refers to $('input#ip_address')
				IpCreateNewWhitelistIp.check_for_existing_ip(this, objEvent);
			});

		});
	}

	return {
		init : _init,
		check_for_existing_ip	: _check_for_existing_ip
	}
}();
IpCreateNewWhitelistIp.init();
/*** End: IpCreateNewWhitelistIp Section */