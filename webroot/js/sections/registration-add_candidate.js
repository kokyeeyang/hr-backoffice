var RegistrationSaveCandidate = function() {
	function _init() {
		$(function() {
			$('#others').on('click', function()){
				document.getElementbyId('otherInputLine').disabled = false;
			}
		});
	}
}();
RegistrationSaveCandidate.init();