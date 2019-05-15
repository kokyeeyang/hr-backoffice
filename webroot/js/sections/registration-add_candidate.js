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

			var terminationReason = document.getElementById("terminationReason");
			$("input[name=terminationBefore]").click(function() {
				if ($("input[name=terminationBefore]:checked").val() == "1") {
					$("input[name=terminationDetails]").removeAttr("disabled");
				} else {
					$("input[name=terminationDetails]").attr("disabled", "yes");
				}
			})
		});
	}

	return {
		init: _init
	}
}();
RegistrationAddCandidate.init();