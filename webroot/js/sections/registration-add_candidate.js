var RegistrationAddCandidate = function() {
	function _init() {
		$(function() {
			var otherInputLine = document.getElementById("otherInputLine");
			var referralInputLine = document.getElementById("referralInputLine");
			$("input[name=findingMethod]").click(function() {
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
					sagaosContactNameLine.style.display = "none";
					$("input[name=sagaosFamilyInput]").val('');
					$("input[name=sagaosContactNameInput]").val('');
				}
			});

			var illnessDescriptionLine = document.getElementById("typeOfIllness");

			$("input[name=illness]").click(function() {
				if($("input[name=illness]:checked").val() == "1"){
					illnessDescriptionLine.style.display = "block";
				}else if($("input[name=illness]:checked").val() == "0"){
					illnessDescriptionLine.style.display = "none";
					illnessDescriptionLine.val('');
				}
			});

			$("input[name=agreeTerms]").on('click',function() {
				if ($("input[name=findingMethod]:checked").val() == "others" && $("input[name=otherFindingMethod]").val() == "") {
					alert($("#msg-search-method").attr('data-msg'));
					otherInputLine.focus();
				}

				if ($("input[name=terminatedBefore]:checked").val() == "1" && $("input[name=terminationDetails]").val() == ""){
					alert($("#msg-terminated_before").attr('data-msg'));
					terminateBeforeLine.focus();
				}

				if ($("input[name=consent]:checked").val() == "0" && $("input[name=noReferenceReason]").val() == ""){
					alert($("#msg-refuse-consent").attr('data-msg'));
					noReferenceLine.focus();
				}

				var crimeLine = $("input[name=criminalOffenseInput]");
				var dateOfConviction = $("input[name=convictedDate]");
				var dateOfDischarge = $("input[name=dischargeDate]");

				if ($("input[name=criminalOffenseRadio]:checked").val() == "1"){
					if(crimeLine.val() == "" || dateOfConviction.val() == "" || dateOfDischarge.val() == ""){
						alert($("#msg-criminal-offence").attr('data-msg'));
						criminalOffenseLine.focus();
					} 
				}

				var sagaosFamily = $("input[name=sagaosContactNameInput]");
				var sagaosContactName = $("input[name=sagaosFamilyInput]");

				if ($("input[name=sagaosRelative]:checked").val() == "1"){
					if(sagaosFamily.val() == "" || sagaosContactName.val() == ""){
						alert($("#msg-has-relative").attr('data-msg'));
						sagaosFamilyLine.focus();
					}
				}

				if ($("input[name=illness]:checked").val()=="1"){
					if(illnessDescriptionLine.val() == ""){
						alert($("#msg-describe-illness").attr('data-msg'));
						illnessDescriptionLine.focus();
					}
				}

			});

			$("#save_button").on('click',function(event) {
				if ($("input[name=signature]").val() != ""){
			    if( !confirm('Are you sure that you want to submit the form')){ 
		        event.preventDefault();
		      } 
				}
			});

		});

	}

	return {
		init: _init
	}
}();
RegistrationAddCandidate.init();