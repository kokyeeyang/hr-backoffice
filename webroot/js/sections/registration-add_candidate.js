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
				//if user checked yes box, then display input line
				if ($("input[name=terminatedBefore]:checked").val() == "1") {
					terminateBeforeLine.style.display = "block";
				} else {
					terminateBeforeLine.style.display = "none";
					$("input[name=terminationDetails]").val('');
				}
			});

			var noReferenceLine = document.getElementById("noReference");
			$("input[name=consent]").click(function() {
				//if user checked no(refuses to give consent) box, then display input line
				if ($("input[name=consent]:checked").val() == "0") {
					noReferenceLine.style.display = "block";
				} else {
					//user give consent
					noReferenceLine.style.display = "none";
					$("input[name=noReferenceReason]").val('');
				}
			}); 

			var criminalOffenseLine = document.getElementById("criminalOffenseInput");
			var convictedDateLine = document.getElementById("convictedDate");
			var dischargeDateLine = document.getElementById("dischargeDate");
			$("input[name=criminalOffenseRadio]").click(function() {
				// if user clicks yes, then user must describe offense
				if ($("input[name=criminalOffenseRadio]:checked").val() == "1") {
					criminalOffenseLine.style.display = "block";
					convictedDateLine.style.display = "block";
					dischargeDateLine.style.display = "block";
				} else {
					//user has not committed offense
					criminalOffenseLine.style.display = "none";
					convictedDateLine.style.display = "none";
					dischargeDateLine.style.display = "none";
					$("input[name=criminalOffenseInput]").val('');
					$("input[name=convictedDate]").val('');
					$("input[name=dischargeDate]").val('');
				}
			});

			var sagaosFamilyLine = document.getElementById("sagaosFamilyInput");
			var sagaosContactNameLine = document.getElementById("sagaosContactName");
			$("input[name=sagaosRelative").click(function() {
				if ($("input[name=sagaosRelative]:checked").val() == "1"){
					sagaosFamilyLine.style.display = "block";
					sagaosContactNameLine.style.display = "block";
				} else {
					sagaosFamilyLine.style.display = "none";
					sagaosContactName.style.display = "none";
					$("input[name=sagaosFamilyInput]").val('');
					$("input[name=sagaosContactNameInput]").val('');
				}
			});
		});
	}

	return {
		init: _init
	}
}();
RegistrationAddCandidate.init();