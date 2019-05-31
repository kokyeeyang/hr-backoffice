var RegistrationViewSelectedCandidate = function() {
	function _init() {
		$(function() {
			var otherInputLine = document.getElementById("otherInputLine");
			$(document).ready(function() {
				//if user checked others box, then remove disabled attribute for the input line
				if ($("input[name=findingMethod]:checked").val() == "others") {
					otherInputLine.style.display = "block";
				} else {
					otherInputLine.style.display = "none";
					$("#otherInputLine").val('');
				}
			});

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

			var terminationReason = document.getElementById("terminationReason");
			$(document).ready(function() {
				//if user checked others box, then remove disabled attribute for the input line
				if ($("input[name=terminatedBefore]:checked").val() == "1") {
					terminationReason.style.display = "block";
				} else {
					terminationReason.style.display = "none";
					$("#terminationReason").val('');
				}
			});

			$("input[name=terminatedBefore]").click(function() {
				//if user checked others box, then remove disabled attribute for the input line
				if ($("input[name=terminatedBefore]:checked").val() == "1") {
					// $("#otherInputLine").removeAttr("disabled");
					terminationReason.style.display = "block";
				} else {
					// $("#otherInputLine").attr("disabled", "yes");
					terminationReason.style.display = "none";
					$("#terminationReason").val('');
				}
			});
		});
	}

	return {
		init: _init
	}
}();
RegistrationViewSelectedCandidate.init();