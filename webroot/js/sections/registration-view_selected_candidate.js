var RegistrationViewSelectedCandidate = function() {
	function generate_offer_email(objElement, objEvent){
		if($(objElement).val() != ''){
			$.ajax({
				type: 'post',
				url: $(objElement).attr('data-offer-url'),
				data: {
					candidate_name : $(objElement).val(),
					manager : $(objElement).val(),
					position : $(objElement).val()
				},

				dataType: 'json',
				success: function(data){
					if(data != null && (typeof data.result) != 'undefined'){
						var emailSubject = "Offer for the position of " + data.position;
						var greetings = "Dear " + data.candidateName;
						var emailBody1 = "We are pleased to offer you the position of " + data.position + ".";

						window.location.href = "mailto:?" + "subject=" + emailSubject 

					} else {
						alert('there is an error when generating the email.');
					}
				}
			});
		}
	}

	function _init() {
		$(function() {
			var otherInputLine = document.getElementById("otherInputLine");
			var referralInputLine = document.getElementById("referralInputLine");
			var terminateBeforeLine = document.getElementById("terminationReason");
			var criminalOffenseLine = document.getElementById("criminalOffenseInput");
			var convictedDateLine = document.getElementById("convictedDate");
			var dischargeDateLine = document.getElementById("dischargeDate");

			var sagaosFamilyLine = document.getElementById("sagaosFamilyInput");
			var sagaosContactNameLine = document.getElementById("sagaosContactName");
			var illnessDescriptionLine = document.getElementById("typeOfIllness");
			var terminationReason = document.getElementById("terminationReason");

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

				if ($("input[name=illness]:checked").val() == "1"){
					illnessDescriptionLine.style.display = "block";
				} else {
					illnessDescriptionLine.style.display = "none";
					$("#typeOfIllness").val('');
				}

				if ($("input[name=terminatedBefore]:checked").val() == "1") {
					terminationReason.style.display = "block";
				} else {
					terminationReason.style.display = "none";
					$("#terminationReason").val('');
				}

				if ($("input[name=consent]:checked").val() == "0") {
					noReferenceLine.style.display = "block";
				} else {
					//user give consent
					noReferenceLine.style.display = "none";
					$("input[name=noReferenceReason]").val('');
				}
			});

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
					terminationReason.style.display = "block";
				} else {
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


			$("input[name=illness]").click(function() {
				if($("input[name=illness]:checked").val() == "1"){
					illnessDescriptionLine.style.display = "block";
				}else if($("input[name=illness]:checked").val() == "0"){
					illnessDescriptionLine.style.display = "none";
					$("input[name=typeOfIllness]").val('');
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

			});

			//to add an extra referee section
			var extraRefereeSection1 = document.getElementById("extraReferee1");
			var extraRefereeSection2 = document.getElementById("extraReferee2");
			var flag = 1;
			$("input#add").click(function(){
				if(flag == 1){
					extraRefereeSection1.style.display="inline-grid";
				} else if (flag == 2){
					extraRefereeSection2.style.display="inline-grid";
				}
				flag ++;
			});

			$('input#generateOfferEmail').on('click', function(objEvent){
				RegistrationViewSelectedCandidate.generate_offer_email(this, objEvent);
			});
		});
	}

	return {
		init : _init,
		generate_offer_email : _generate_offer_email
	}
}();
RegistrationViewSelectedCandidate.init();