var RegistrationAddCandidate = function() {
	function _init() {
		$(function() {
			var otherInputLine = document.getElementById("otherInputLine");
			$("input[name=findingMethod]").click(function() {
				if ($("input[name=findingMethod]:checked").val() == "others") {
					$("#otherInputLine").removeAttr("disabled");
				} else {
					$("#otherInputLine").attr("disabled", "yes");
				}
			});
		});
	}

	return {
		init: _init
	}
}();
RegistrationAddCandidate.init();