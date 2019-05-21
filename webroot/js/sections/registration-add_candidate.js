var RegistrationAddCandidate = function() {
	function _init() {
		$(function() {
			var otherInputLine = document.getElementById("otherInputLine");
			$("input[name=findingMethod]").click(function() {
				//if user checked others box, then remove disabled attribute for the input line
				if ($("input[name=findingMethod]:checked").val() == "others") {
					// $("#otherInputLine").removeAttr("disabled");
					otherInputLine.style.display = "block";
				} else {
					// $("#otherInputLine").attr("disabled", "yes");
					otherInputLine.style.display = "none";
					$("#otherInputLine").val('');
				}
			});

			var terminateBeforeLine = document.getElementById("terminationReason");
			$("input[name=terminatedBefore]").click(function() {
				//if user checked yes box, then remove disabled attribute for the input line
				if ($("input[name=terminatedBefore]:checked").val() == "1") {
					terminateBeforeLine.style.display = "block";
					// $("input[name=terminationDetails]").removeAttr("disabled");
				} else {
					// $("input[name=terminationDetails]").attr("disabled", "yes");
					terminateBeforeLine.style.display = "none";
					$("input[name=terminationDetails]").val('');
				}
			});

			$("input[name=consent]").click(function() {
				//if user checked no(refuses to give consent) box, then remove disabled attribute for the input line
				if ($("input[name=consent]:checked").val() == "0") {
					$("input[name=noReferenceReason]").removeAttr("disabled");
				} else {
					//user give consent
					$("input[name=noReferenceReason]").attr("disabled", "yes");
					$("input[name=noReferenceReason]").val('');
				}
			}); 

		});
	}

	return {
		init: _init
	}
}();
RegistrationAddCandidate.init();