var RegistrationShowOfferLetterTemplates = function(){
	function _generate_offer_letter(objElement, objEvent){
		$('#showOfferLetterTemplates').attr('action', $(objElement).attr('data-create-url')).submit();
	}

	function _init() {
		$(function() {
			$('input#generateOfferLetter').on('click', function(objEvent){
				RegistrationShowOfferLetterTemplates.generate_offer_letter(this, objEvent);
			});
		});
	}

	return {
		init : _init,
		generate_offer_letter : _generate_offer_letter
	}
}();
RegistrationShowOfferLetterTemplates.init();