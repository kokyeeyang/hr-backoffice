/*** 
	Start	: Setting Section 
	By		: KC 2013-11-29
*/
var Setting = function() {

	function _get_form(objElement, objEvent){
		var strUrl 		= objElement.attr('rel');
		var arrParams 	= convert_url_to_array(strUrl);
		var strLang		= '';
		var intId		= 0;
		
		if(typeof(arrParams['lang']) != 'undefined'){
			strLang = arrParams['lang'];
		}
		
		if(typeof(arrParams['id']) != 'undefined'){
			intId = arrParams['id'];
		}		
		
		$.ajax({
			type: 'post',
			url: strUrl,
			data: {
				ajax: 'setting-form'
			},
			dataType: 'json',
			success: function(data){
				
				if(data != null && data.result == 1 && data.content != ''){
					// Removes Loading...
					Project.hide_loading();
				
					var objContentElement = $('#main_content .main_content_wrapper');
					
					objContentElement.html('');
					objContentElement.append(data.content);
					$($('body')[0]).attr('id', 'setting-edit');
					
					Project.set_leftnav_active_item(objElement);
					Project.init_common_button();
					Project.init_enter_submit();
					Setting.init();				
				}
				else if(data != null && data.msg != ''){
					Project.popup_error(data.msg);
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
				Project.hide_loading();
			},
			error: function(request, status, err){
				// Removes Loading...
				Project.popup_ajax_error(request, status, err);
			}			 
		});
	}
	
	function _submit_form(objElement, objEvent){
		var objForm			= objElement.closest('form');
		var strUrl 			= objForm.attr('action');
		var arrParams 		= convert_url_to_array(strUrl);
		var strLang			= '';
		var intId			= 0;
		var strSettingValue = '';

		if(typeof(arrParams['lang']) != 'undefined'){
			strLang = arrParams['lang'];
		}
		
		if(typeof(arrParams['id']) != 'undefined'){
			intId = arrParams['id'];
		}
		
		if(objForm.find('input[type=radio]').length > 0){
			strSettingValue = objForm.find('input:radio[name="Setting[setting_value]"]:checked').val();
		}
		else{
			strSettingValue = objForm.find('#setting_value').val();
		}

		$.ajax({
			type: 'post',
			url: strUrl,
			data: {
				ajax			: 'submit-setting-form',
				setting_value 	: strSettingValue
			},
			dataType: 'json',
			success: function(data){
				
				if(data != null && data.msg != '' && data.result == 1){
					Project.popup_alert(data.msg);
				}
				else if(data != null && data.msg != ''){
					Project.popup_error(data.msg);
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
				Project.hide_loading();
			},
			error: function(request, status, err){
				// Removes Loading...
				Project.popup_ajax_error(request, status, err);
			} 
		});
	}	
	
	function _init(){
		$(function() {
			$('.btnGetSettingForm').unbind('click').click(function(objEvent){ 
				Setting.get_form($(this), objEvent);
			});
			
			$('.btnSubmitSettingForm').unbind('click').click(function(objEvent){ 
				Setting.submit_form($(this), objEvent);
			});			
		});
	}
	
	return {
		init 		: _init,
		get_form	: _get_form,
		submit_form	: _submit_form
	}
}();
Setting.init();
/*** End: Setting Section */