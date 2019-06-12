var RegistrationViewSelectedCandidate = function() {
	function _init() {
		$(function() {
			var otherInputLine = document.getElementById("otherInputLine");
			var referralInputLine = document.getElementById("referralInputLine");
			var criminalOffenseLine = document.getElementById("criminalOffenseInput");
			var convictedDateLine = document.getElementById("convictedDate");
			var dischargeDateLine = document.getElementById("dischargeDate");

			var sagaosFamilyLine = document.getElementById("sagaosFamilyInput");
			var sagaosContactNameLine = document.getElementById("sagaosContactName");

			$(document).ready(function() {
				//if user checked others box, then remove disabled attribute for the input line
				if ($("input[name=findingMethod]:checked").val() == "others") {
					otherInputLine.style.display = "block";
				} else {
					otherInputLine.style.display = "none";
					$("#otherInputLine").val('');
				}

				if ($("input[name=findingMethod]:checked").val() == "internal-referral") {
					referralInputLine.style.display = "block";
				} else {
					referralInputLine.style.display = "none";
					$("#referralInputLine").val('');
				}

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

				if ($("input[name=findingMethod]:checked").val() == "internal-referral") {
					referralInputLine.style.display = "block";
				} else {
					referralInputLine.style.display = "none";
					$("#referralInputLine").val('');
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
		});
	}

	return {
		init: _init
	}
}();
RegistrationViewSelectedCandidate.init();