var RegistrationViewSelectedCandidate = function () {
    function _generate_offer_email(objElement, objEvent) {
        if ($(objElement).val() != '') {
            $.ajax({
                type: 'post',
                url: $(objElement).attr('data-offer-url'),
                data: {
                },
                dataType: 'json',
                success: function (data) {
                    if (data != null && (typeof data.candidateName) != 'undefined') {
                        var emailSubject = "Offer for the position of " + data.jobTitle;
                        var greetings = "Hi " + data.candidateName + ",";
                        var emailBody1 = "Thank you for taking the time to attend the interview at SagaOS.";
                        var emailBody2 = "As discussed, please find the offer letter that is attached in this email for the position of " + data.jobTitle +
                            ". I would like to take this opportunity to congratulate you once again and welcome you aboard! ";
                        var emailBody3 = "Please revert back with the signed copy of the letter by";
                        var emailBody4 = "You will be reporting to " + data.manager;
                        var emailBody5 = "Thank you.";

                        window.location.href = "mailto:" + data.candidateEmail + "?subject=" + emailSubject + "&body="
                            + greetings + "%0D%0A%0D%0A" + emailBody1 + "%0D%0A%0D%0A" + emailBody2 + "%0D%0A%0D%0A" + emailBody3
                            + "%0D%0A%0D%0A" + emailBody4 + "%0D%0A%0D%0A" + emailBody5;

                        //changes candidate status to offer letter generated in the database
                        RegistrationViewSelectedCandidate.change_candidate_status(objElement, objEvent);
                        RegistrationViewSelectedCandidate.download_pdf(objElement, objEvent);

                    } else {
                        console.log(data);
                        alert('there is an error when generating the email.');
                        return false;
                    }
                },
                error: function (request, status, err) {
                    alert('something is wrong');
                }
            });
        }
    }

    function _download_pdf(objElement, objEvent) {
        $('#candidateForm').attr('action', $('#downloadPdf').attr('data-download-url')).submit();
    }

    function _change_candidate_status(objElement, objEvent) {
        $('#candidateForm').attr('action', $('#changeCandidateStatus').attr('data-change-url')).submit();
    }

    function _change_candidate_status_to_signed(objElement, objEvent) {
        $('#candidateForm').attr('action', $('#changeCandidateStatusToSigned').attr('data-signed-url')).submit();
    }
    
    function _generate_template(objElement, objEvent) {
        $('#candidateForm').attr('action', $('#generateOnboardingChecklistTemplate').attr('data-generate-onboarding-url')).submit();
        //$('#candidateForm').attr('action', $('#generateTrainingTemplate')).submit();
    }
    
//    function _generate_user(objElement, objEvent) {
//        
//    }

    function _init() {
        $(function () {
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

            $(document).ready(function () {
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

                if ($("input[name=sagaosRelative]:checked").val() == "1") {
                    sagaosFamilyLine.style.display = "block";
                    sagaosContactNameLine.style.display = "block";
                } else {
                    sagaosFamilyLine.style.display = "none";
                    sagaosContactName.style.display = "none";
                    $("input[name=sagaosFamilyInput]").val('');
                    $("input[name=sagaosContactNameInput]").val('');
                }

                if ($("input[name=illness]:checked").val() == "1") {
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

            $("input[name=findingMethod]").click(function () {
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

            $(document).ready(function () {
                //if user checked others box, then remove disabled attribute for the input line
                if ($("input[name=terminatedBefore]:checked").val() == "1") {
                    terminationReason.style.display = "block";
                } else {
                    terminationReason.style.display = "none";
                    $("#terminationReason").val('');
                }
            });

            $("input[name=terminatedBefore]").click(function () {
                //if user checked others box, then remove disabled attribute for the input line
                if ($("input[name=terminatedBefore]:checked").val() == "1") {
                    terminationReason.style.display = "block";
                } else {
                    terminationReason.style.display = "none";
                    $("#terminationReason").val('');
                }
            });

            $("input[name=criminalOffenseRadio]").click(function () {
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

            $("input[name=sagaosRelative").click(function () {
                if ($("input[name=sagaosRelative]:checked").val() == "1") {
                    sagaosFamilyLine.style.display = "block";
                    sagaosContactNameLine.style.display = "block";
                } else {
                    sagaosFamilyLine.style.display = "none";
                    sagaosContactName.style.display = "none";
                    $("input[name=sagaosFamilyInput]").val('');
                    $("input[name=sagaosContactNameInput]").val('');
                }
            });


            $("input[name=illness]").click(function () {
                if ($("input[name=illness]:checked").val() == "1") {
                    illnessDescriptionLine.style.display = "block";
                } else if ($("input[name=illness]:checked").val() == "0") {
                    illnessDescriptionLine.style.display = "none";
                    $("input[name=typeOfIllness]").val('');
                }
            });

            var noReferenceLine = document.getElementById("noReference");
            $("input[name=consent]").click(function () {
                //if user checked no(refuses to give consent) box, then display input line
                if ($("input[name=consent]:checked").val() == "0") {
                    noReferenceLine.style.display = "block";
                } else {
                    //user give consent
                    noReferenceLine.style.display = "none";
                    $("input[name=noReferenceReason]").val('');
                }
            });

            $("input[name=agreeTerms]").on('click', function () {
                if ($("input[name=findingMethod]:checked").val() == "others" && $("input[name=otherFindingMethod]").val() == "") {
                    alert($("#msg-search-method").attr('data-msg'));
                    otherInputLine.focus();
                }

                if ($("input[name=terminatedBefore]:checked").val() == "1" && $("input[name=terminationDetails]").val() == "") {
                    alert($("#msg-terminated_before").attr('data-msg'));
                    terminateBeforeLine.focus();
                }

                if ($("input[name=consent]:checked").val() == "0" && $("input[name=noReferenceReason]").val() == "") {
                    alert($("#msg-refuse-consent").attr('data-msg'));
                    noReferenceLine.focus();
                }

                var crimeLine = $("input[name=criminalOffenseInput]");
                var dateOfConviction = $("input[name=convictedDate]");
                var dateOfDischarge = $("input[name=dischargeDate]");

                if ($("input[name=criminalOffenseRadio]:checked").val() == "1") {
                    if (crimeLine.val() == "" || dateOfConviction.val() == "" || dateOfDischarge.val() == "") {
                        alert($("#msg-criminal-offence").attr('data-msg'));
                        criminalOffenseLine.focus();
                    }
                }

                var sagaosFamily = $("input[name=sagaosContactNameInput]");
                var sagaosContactName = $("input[name=sagaosFamilyInput]");

                if ($("input[name=sagaosRelative]:checked").val() == "1") {
                    if (sagaosFamily.val() == "" || sagaosContactName.val() == "") {
                        alert($("#msg-has-relative").attr('data-msg'));
                        sagaosFamilyLine.focus();
                    }
                }

            });

            //to add an extra referee section
            var extraRefereeSection1 = document.getElementById("extraReferee1");
            var extraRefereeSection2 = document.getElementById("extraReferee2");
            var flag = 1;
            $("input#add").click(function () {
                if (flag == 1) {
                    extraRefereeSection1.style.display = "inline-grid";
                } else if (flag == 2) {
                    extraRefereeSection2.style.display = "inline-grid";
                }
                flag++;
            });

            $("input[name=expectedSalary]").keyup(function () {
                $("input[name=offerLetterExpectedSalary]").val(this.value);
            });

            $("input[name=offerLetterExpectedSalary]").keyup(function () {
                $("input[name=expectedSalary]").val(this.value);
            });

            $("input[name=idNo]").keyup(function () {
                $("input[name=offerLetterIdNo]").val(this.value);
            });

            $("input[name=offerLetterIdNo]").keyup(function () {
                $("input[name=idNo]").val(this.value);
            });

            $("input[name=offerLetterFullName").keyup(function () {
                $("input[name=fullName]").val(this.value);
            });

            $("input[name=fullName").keyup(function () {
                $("input[name=offerLetterFullName]").val(this.value);
            });

            $("input#generateOfferEmail").on('click', function (objEvent) {
                console.log('hello');
                if (confirm($('#msg-confirm-offer-email').attr('data-msg'))) {
                    if ($("input[name=sendEmailCheckbox]:checked").val() == "1") {
                        RegistrationViewSelectedCandidate.generate_offer_email(this, objEvent);
                    } else if ($("input[name=sendEmailCheckbox]:checked").val() === undefined) {
                        RegistrationViewSelectedCandidate.change_candidate_status_to_signed(this, objEvent);
                        RegistrationViewSelectedCandidate.download_pdf(this, objEvent);
                    }
                }
            });

            $("input#generateTemplateButton").on('click', function (objEvent) {
                if (confirm($('#msg-confirm-generate-template').attr('data-msg'))) {
                    RegistrationViewSelectedCandidate.generate_template(this, objEvent);
                    //will need to create one more function for creating user profile for this guy as well
                }
            });
        });
    }

    return {
        init: _init,
        generate_offer_email: _generate_offer_email,
        change_candidate_status: _change_candidate_status,
        change_candidate_status_to_signed: _change_candidate_status_to_signed,
        download_pdf: _download_pdf,
        generate_template: _generate_template
    }
}();
RegistrationViewSelectedCandidate.init();