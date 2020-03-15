/*** 
	Start	: SiteLogin Section 
	By		: KC 2013-11-29
*/
var SiteLogin = function() {

	function _submit_site_login(objForm, objEvent){

		$.ajax({
			 type: 'post',
			 url: $(objForm).attr('action'),
			 data: {
				login_emailaddress	: $(objForm).find('input[name=login_emailaddress]').val(),
				login_password	: $(objForm).find('input[name=login_password]').val(),
				login_captcha	: $(objForm).find('input[name=login_captcha]').val(),
				lang			: $(objForm).find('input[name=lang]').val()
			 },
			 dataType: 'json',
			 success: function(data)
			 {
				if(data != null && data.result == 1){				
					
					if(data.url != null && data.url != ''){
						Project.show_loading();
						window.location = data.url;
					}				
				}
				else if(data != null){
					Project.popup_error(data.msg);
					var objDate = new Date();
					var intTime	= objDate.getTime();
					var strSrc	= $(objForm).find('#login_captcha_img').attr("src");
					
					if(strSrc.indexOf('?') >= 0){
						var arrTime = strSrc.split('&');

						if((typeof arrTime[1]) != 'undefined'){
							strSrc = arrTime[0] + '&' + intTime;
						}
						else{
							strSrc = strSrc + '&' + intTime;
						}			
					}
					else{
						strSrc = strSrc + '?' + intTime;
					} // - end: if else
					$(objForm).find('#login_captcha_img').attr("src", strSrc);
					//$(objForm).find('#login_password').val('');
					$(objForm).find('#login_captcha').val('');
				}
				else{
					Project.popup_error($('#common-msg .msg_operation_failed').attr('rel'));
				}				
			},
			beforeSend: function(){
				// Adds Loading...
				Project.show_loading();
			},
			complete: function(){
				// Removes Loading...
				//Project.hide_loading();
			},
			error: function(request, status, err){
				// Removes Loading...
				//Project.hide_loading();
				Project.popup_ajax_error(request, status, err);
			}			 
		});
		objEvent.preventDefault();
		return false;	
	}
	
	function _init(){	
		$(function() {
					
			if ($("div.login_panel #login_form").length > 0){ 
				$('div.login_panel #login_form #btnLoginSubmit').bind('click', function(objEvent) {	
					SiteLogin.submit_site_login($(this).closest('form'), objEvent);					
				});
			}	
			
			$('div.login_panel div.login_captcha_img img').bind('click', function() {
				var objDate = new Date();
				var intTime	= objDate.getTime();
				var strSrc	= $(this).attr("src");
				
				if(strSrc.indexOf('?') >= 0){
					var arrTime = strSrc.split('&');

					if((typeof arrTime[1]) != 'undefined'){
						strSrc = arrTime[0] + '&' + intTime;
					}
					else{
						strSrc = strSrc + '&' + intTime;
					}			
				}
				else{
					strSrc = strSrc + '?' + intTime;
				}
				
				$(this).attr('src', strSrc);				
			});
		});
	}	
	
	return {
		init		 			: _init,
		submit_site_login		: _submit_site_login
	}
}();
SiteLogin.init();
/*** End: SiteLogin Section */