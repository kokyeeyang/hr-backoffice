var RegistrationShowOfferLetterTemplates = function(){
	function _generate_offer_letter(objElement, objEvent){
		$('#offerletter-list').attr('action', $(objElement).attr('data-create-url')).submit();
	}

	function _check_if_deletion_is_selected(objElement, objEvent){
		if ($(".deleteCheckBox:checked").length <= 0){
			alert($('#msg-select-offerletter-delete').attr('data-msg'));
		} else {
			if (confirm($('#msg-confirm-offerletter-delete').attr('data-msg'))){
				$('#offerletter-list').attr('action', $(objElement).attr('data-delete-url')).submit();
			}
		}
	}

	function _init() {
		$(function() {
			$('input#generateOfferLetter').on('click', function(objEvent){
				RegistrationShowOfferLetterTemplates.generate_offer_letter(this, objEvent);
			});

			$('#deleteOfferLetterButton').on('click', function(objEvent){
				RegistrationShowOfferLetterTemplates.check_if_deletion_is_selected(this, objEvent);
			});
		});
	}

	return {
		init : _init,
		generate_offer_letter : _generate_offer_letter,
		check_if_deletion_is_selected : _check_if_deletion_is_selected
	}
}();
RegistrationShowOfferLetterTemplates.init();