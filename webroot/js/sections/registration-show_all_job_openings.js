var RegistrationShowAllJobOpenings = function () {
  function _copy_link(objElement, objEvent) {
    if ($(objElement).val() != '') {
      $.ajax({
        type: 'post',
        url: $(objElement).attr('data-url'),
        data: {
          job_opening_id: $(objElement).val()
        },
        dataType: 'json',
        success: function (data) {
          if ((typeof data.result) !== 'undefined') {
            var link = 'http://portal.sagaos.com/registration?JT=' + data.result;
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            alert('Link is copied! Please attach link to email and send to candidate');
          } else {
            alert('wrong');
          }
        },
        error: function (request, status, err) {
          alert('wrong');
        }
      });
    }
  }

  function _check_if_job_opening_has_applicants(objElement, objEvent) {
    if ($(objElement).val() != '')
    {
      $.ajax({
        type: 'post',
        //pass in department id to query inside admin table
        url: $(objElement).attr('data-url') + '/' + $(objElement).val(),
        data: {
          department_id: $(objElement).val()
        },
        dataType: 'json',
        success: function (data)
        {
          if (data != null && data.result != false) {
            alert('There are still candidates : ' + data.result + 'for your chosen job opening, please delete them first.');
            console.log('data is not null');
//             console.log(data.result);
            //uncheck the boxes for departments that still have users
            $('#deleteCheckBox' + $(objElement).val()).prop('checked', false);

          } else if (data != null && data.result == false) {
console.log('data is null');
          }
        },
        error: function (request, status, err)
        {
          alert('wrong');
        }
      });
    }
  }

  function _generate_email(objElement, objEvent) {
    if ($(objElement).val() != '') {
      $.ajax({
        type: 'post',
        url: $(objElement).attr('data-email-url'),
        data: {
          job_opening_id: $(objElement).val(),
          job_title: $(objElement).val(),
          job_link_token: $(objElement).val()
        },

        dataType: 'json',
        success: function (data) {
          if (data != null && (typeof data.result) != 'undefined') {
            var link = $('#site_url').attr('rel') + 'registration?JT=' + data.result + '%26token=' + data.token;
            var emailSubject = 'Interview Invitation for the position of ' + data.jobTitleResult + ' at Saga OS';
            var greeting = 'Hi ,';
            var emailBody1 = 'Thank you for showing interest in the abovementioned position.'

            window.location.href = "mailto:?" + "subject=" + emailSubject + "&body=" + greeting + "%0D%0A%0D%0A"
                    + emailBody1 + "%0D%0A Please fill in the application form in the link below before attending the interview at Saga OS."
                    + "%0D%0A%0D%0A" + link + "%0D%0A";
            window.close();
          } else {
            alert('there is an error when generating the email.');
          }
        },
        error: function (request, status, err) {
          alert('something is wrong');
        }
      });
    }
  }

  function _check_if_deletion_is_selected(objElement, objEvent) {
    if ($(".deleteCheckBox:checked").length <= 0) {
      alert($('#msg-select-delete').attr('data-msg'));
    } else {
      if (confirm($('#msg-confirm-delete').attr('data-msg'))) {
        $('#jobopening-list').attr('action', $(objElement).attr('data-delete-url')).submit();
      }
    }
  }

  function _check_if_job_opening_has_candidates(objElement, objEvent) {
    if ($(objElement).val() != '')
    {
      $.ajax({
        type: 'post',
        //pass in department id to query inside admin table
        url: $(objElement).attr('data-url') + '/' + $(objElement).val(),
        data: {
          job_id: $(objElement).val()
        },
        dataType: 'json',
        success: function (data)
        {
          if (data != null && data.result != false) {
//            alert(data.result);
//            alert();
//            alert('There are candidates belonging to your chosen job opening, please delete them first.');
            //uncheck the boxes for departments that still have users
            $('#deleteCheckBox' + $(objElement).val()).prop('checked', false);

          } else if (data != null && data.result == false) {
          }
        },
        error: function (request, status, err)
        {
          alert('wrong');
        }
      });
    }
  }

  function _initGenerateEmail() {
    $('input.generateEmail').unbind('click').click(function (objEvent) {
      RegistrationShowAllJobOpenings.generate_email(this, objEvent);
    });
  }

  function _initCheckIfJobOpeningHasApplicants() {
    $('.deleteCheckBox').unbind('change').change(function (objEvent) {
      if (this.checked) {
        RegistrationShowAllJobOpenings.check_if_job_opening_has_applicants(this, objEvent);
      }
    });
  }

  function _initCheckIfDeletionIsSelected() {
    $('#deleteJobOpeningButton').unbind('click').click(function (objEvent) {
      RegistrationShowAllJobOpenings.check_if_deletion_is_selected(this, objEvent);
    });
  }

  function _initFilterResults() {
//    $("#label_filter").on("keyup", function () {
    $("#label_filter").unbind('keyup').keyup(function () {
      var value = $(this).val().toLowerCase();
      $("#data_table tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  }

  function _init() {
    $(function () {
      $(document).ready(function () {
        RegistrationShowAllJobOpenings.initGenerateEmail();
        RegistrationShowAllJobOpenings.initCheckIfJobOpeningHasApplicants();
        RegistrationShowAllJobOpenings.initCheckIfDeletionIsSelected();
        RegistrationShowAllJobOpenings.initFilterResults();
      });
    });
  }

  return {
    init: _init,
    copy_link: _copy_link,
    generate_email: _generate_email,
    check_if_deletion_is_selected: _check_if_deletion_is_selected,
    check_if_job_opening_has_applicants: _check_if_job_opening_has_applicants,
    initGenerateEmail: _initGenerateEmail,
    initCheckIfJobOpeningHasApplicants: _initCheckIfJobOpeningHasApplicants,
    initCheckIfDeletionIsSelected: _initCheckIfDeletionIsSelected,
    initFilterResults: _initFilterResults
  }
}();
RegistrationShowAllJobOpenings.init();