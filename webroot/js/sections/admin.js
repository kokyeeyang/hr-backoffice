/*** 
 Start	: Admin Section 
 By		: KC 2013-06-30
 */
var Admin = function () {

  function _get_admin_list(objElement, objEvent) {
    var strUrl = objElement.attr('rel');
    var arrParams = convert_url_to_array(strUrl);
    var strLang = '';

    if (typeof (arrParams['lang']) != 'undefined') {
      strLang = arrParams['lang'];
    }

    $.ajax({
      type: 'post',
      url: strUrl,
      data: {
        ajax: 'admin-list'
      },
      dataType: 'json',
      success: function (data) {

        if (data != null && data.result == 1 && data.content != '') {
          // Removes Loading...
          Project.hide_loading();

          var objContentElement = $('#main_content .main_content_wrapper');

          objContentElement.html('');
          objContentElement.append(data.content);
          $($('body')[0]).attr('id', 'admin-list');

          Project.set_leftnav_active_item(objElement);
          Project.init_common_button();
          Project.init_enter_submit();
          Project.set_grid();
          Project.submit_page();
          Admin.init();
        } else if (data != null && data.msg != '') {
          Project.popup_error(data.msg);
        } else {
          Project.popup_error($('#common-msg .msg_operation_failed').attr('rel'));
        }
      },
      beforeSend: function () {
        // Adds Loading...
        Project.show_loading();
      },
      complete: function () {
        // Removes Loading...
        Project.hide_loading();
      },
      error: function (request, status, err) {
        // Removes Loading...
        Project.popup_ajax_error(request, status, err);
      }
    });
  }

  function _get_admin_form(objElement, objEvent) {
    var strUrl = objElement.attr('rel');
    var arrParams = convert_url_to_array(strUrl);
    var strLang = '';
    var intId = 0;

    if (typeof (arrParams['lang']) != 'undefined') {
      strLang = arrParams['lang'];
    }

    if (typeof (arrParams['id']) != 'undefined') {
      intId = arrParams['id'];
    }

    $.ajax({
      type: 'post',
      url: strUrl,
      data: {
        ajax: 'admin-form',
        id: intId
      },
      dataType: 'json',
      success: function (data) {

        if (data != null && data.result == 1 && data.content != '') {
          // Removes Loading...
          Project.hide_loading();

          var objContentElement = $('#main_content .main_content_wrapper');

          objContentElement.html('');
          objContentElement.append(data.content);
          $($('body')[0]).attr('id', 'admin-form');

          Project.set_leftnav_active_item(objElement);
          Project.init_common_button();
          Project.init_enter_submit();
          Admin.init();
        } else if (data != null && data.msg != '') {
          Project.popup_error(data.msg);
        } else {
          Project.popup_error($('#common-msg .msg_operation_failed').attr('rel'));
        }
      },
      beforeSend: function () {
        // Adds Loading...
        Project.show_loading();
      },
      complete: function () {
        // Removes Loading...
        Project.hide_loading();
      },
      error: function (request, status, err) {
        // Removes Loading...
        Project.popup_ajax_error(request, status, err);
      }
    });
  }

  function _submit_admin_form(objElement, objEvent) {
    var objForm = objElement.closest('form');
    var strUrl = objForm.attr('action');
    var arrParams = convert_url_to_array(strUrl);
    var strLang = '';

    if (typeof (arrParams['lang']) != 'undefined') {
      strLang = arrParams['lang'];
    }

    $.ajax({
      type: 'post',
      url: strUrl,
      data: {
        ajax: 'submit-admin-form',
        admin_username: $(objForm.find('#Admin_admin_username')).val(),
        admin_password: $(objForm.find('#Admin_admin_password')).val(),
        admin_password_confirm: $(objForm.find('#admin_password_confirm')).val(),
        admin_display_name: $(objForm.find('#Admin_admin_display_name')).val(),
        admin_status: $(objForm.find('input:radio[name="Admin[admin_status]"]:checked')).val(),
        admin_priv: $(objForm.find('select[name="Admin[admin_priv]"]')).val(),
        // admin_department				: $(objForm.find('select[name="Admin[admin_department]"]')).val()
        admin_department: $(objForm.find('select[name=admin_department]')).val()
      },
      dataType: 'json',
      success: function (data) {

        if (data != null && data.result == 1 && data.content != '') {
          // Removes Loading...
          Project.hide_loading();
          var objContentElement = $('#main_content .main_content_wrapper');

          objContentElement.html('');
          objContentElement.append(data.content);
          //Project.set_leftnav_active_item(objElement);
          Project.init_common_button();
          Project.init_enter_submit();
          Project.set_grid();
          Project.submit_page();
          Admin.init();

          if (data.msg != '') {
            Project.popup_alert(data.msg);
          }
        } else if (data != null && data.msg != '') {
          Project.popup_error(data.msg);
        } else {
          Project.popup_error($('#common-msg .msg_operation_failed').attr('rel'));
        }
      },
      beforeSend: function () {
        // Adds Loading...
        Project.show_loading();
      },
      complete: function () {
        // Removes Loading...
        Project.hide_loading();
      },
      error: function (request, status, err) {
        // Removes Loading...
        Project.popup_ajax_error(request, status, err);
      }
    });
  }

  function openTab(evt, tabType) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  function _initRemoveOnboardingChecklistItem() {
    $('td.removeItemButton a').unbind('click').click(function (objEvent) {
      console.log('hello');
    });
  }

  //start js codes for assigning onboarding items for new hirees
  function _render_onboarding_item_details(objElement, objEvent) {
    if ($(objElement).val() != '') {
      var intOnboardingItemId = $(objElement).find(":selected").val();
      $.ajax({
        type: 'post',
        url: $(objElement).attr('data-render-url'),
        data: {
          ajax: 'admin-form',
          onboarding_item_id: intOnboardingItemId
        },
        dataType: 'json',
        success: function (data)
        {
          if ((typeof data['description']) !== 'undefined' && data !== null) {
            var remove_logo = '&#x2716;';
            var objRow = $(objElement).closest('tr');
            objRow.find('.description').text(data['description']);
            objRow.find('.departmentOwner').text(data['responsibility']);
            objRow.find('.isManagerial').text(data['isManagerial']);
            objRow.find('.isOffboardingItem').text(data['isOffboardingItem']);
            objRow.find('span.removeItemButton').html(remove_logo);
          }
        }
      });
    }
  }

  function _append_new_onboarding_checklist_item(objElement, objEvent) {
    var dataTable = $('#data_table');

    var appendRow = $('tr.appendItemTr');

    //deciding to put list_even or list_odd for the front end
    var counter = $('#hiddenVal').val();
    counter++;
    $('#hiddenVal').val(counter);
    var numberAfterModulus = counter % 2;

    if (numberAfterModulus == 1) {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedItemTr list_even').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended itemDropdown ' + counter);
    } else {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedItemTr list_odd').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended itemDropdown ' + counter);
    }

    // need to reinitiate the dropdown for onboarding title and the remove button after appending
    Project.initOnboardingItemDropdown();
    Project.initRemoveOnboardingChecklistItem();
  }

  function _remove_onboarding_checklist_item_row(objElement, objEvent) {
    var rowToBeRemoved = $(objElement).closest('tr');
    $(rowToBeRemoved).remove();
    $('.updateTemplateButton').prop('disabled', false);

    var counter = parseInt($('#hiddenVal').val());
    counter--;
    $('#hiddenVal').val(counter);
  }

  function _initOnboardingInputBoxes() {
    $('input#templateTitle').unbind('keypress').keypress(function (objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initOnboardingTextArea() {
    $('textarea#templateDescription').unbind('keypress').keypress(function (objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initOnboardingItemDropdown() {
    $('select[class="selectItemTitle"]').unbind('change').change(function (objEvent) {
      Admin.render_onboarding_checklist_item_details(this, objEvent);
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initAppendNewOnboardingChecklistItem() {
    $(':button#appendItem').unbind('click').click(function (objEvent) {
      console.log('hello');
      Admin.append_new_onboarding_checklist_item(this, objEvent);
    });
  }

  function _initRemoveOnboardingChecklistItem() {
    $('td.removeItemButton a').unbind('click').click(function (objEvent) {
      Admin.remove_onboarding_checklist_item_row(this, objEvent);
    });
  }

  //end js codes for assigning onboarding items for new hirees

  //start js codes for assigning training items for new hirees
  function _render_training_item_details(objElement, objEvent) {
    if ($(objElement).val() != '') {
      var intTrainingItemId = $(objElement).find(":selected").val();
      $.ajax({
        type: 'post',
        url: $(objElement).attr('data-render-url'),
        data: {
          ajax: 'trainingTemplateForm',
          training_item_id: intTrainingItemId
        },
        dataType: 'json',
        success: function (data)
        {
          if ((typeof data['description']) !== 'undefined' && data !== null) {
            var description = data['description'];
            var responsibility = data['responsibility'];
            var remove_logo = '&#x2716;';
            var objRow = $(objElement).closest('tr');
            objRow.find('.itemDescription').text(description);
            objRow.find('.itemResponsibility').text(responsibility);
            objRow.find('span.removeItemButton').html(remove_logo);
          }
        }
      });
    }
  }

  function _append_new_training_item(objElement, objEvent) {
    var dataTable = $('#data_table');

    var appendRow = $('tr.appendItemTr');

    //deciding to put list_even or list_odd for the front end
    var counter = parseInt($('#hiddenVal').val());
    counter++;
    $('#hiddenVal').val(counter);
    var numberAfterModulus = counter % 2;

    if (numberAfterModulus == 1) {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedItemTr list_even').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended itemDropdown ' + counter);
    } else {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedItemTr list_odd').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended itemDropdown ' + counter);
    }

    // need to reinitiate the dropdown for training title and the remove button after appending
    Project.initTrainingItemDropdown();
    Project.initRemoveTrainingItem();
  }

  function _remove_training_item_row(objElement, objEvent) {
    var rowToBeRemoved = $(objElement).closest('tr');
    $(rowToBeRemoved).remove();

    var counter = parseInt($('#hiddenVal').val());

    counter--;
    $('#hiddenVal').val(counter);
  }

  function _initTrainingItemDropdown() {
    $('select[class="selectItemTitle"]').unbind('change').change(function (objEvent) {
      Project.render_training_item_details(this, objEvent);
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initTrainingInputBoxes() {
    $('input.inputBoxes').unbind('keypress').keypress(function (objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initTrainingTextArea() {
    $('textarea#templateDescription').unbind('keypress').keypress(function (objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initAppendNewTrainingItem() {
    $(':button#appendItem').unbind('click').click(function (objEvent) {
      Project.append_new_training_item(this, objEvent);
    });
  }

  function _initRemoveTrainingItem() {
    $('td.removeItemButton a').unbind('click').click(function (objEvent) {
      Project.remove_training_item_row(this, objEvent);
    });
  }
  //end assigning training items for new hirees

  function _init() {
    $(function () {
      $('.btnGetAdminList').unbind('click').click(function (objEvent) {
        Admin.get_admin_list($(this), objEvent);
      });

      $('.btnGetAdminForm').unbind('click').click(function (objEvent) {
        Admin.get_admin_form($(this), objEvent);
      });

      $('.btnSubmitAdminForm').unbind('click').click(function (objEvent) {
        Admin.submit_admin_form($(this), objEvent);
      });

      $(':button#appendItem').unbind('click').click(function (objEvent) {
        console.log('hello');
      });

      Admin.initOnboardingItemDropdown();
      Admin.initAppendNewOnboardingChecklistItem();
      Admin.initRemoveOnboardingChecklistItem();
      Admin.initOnboardingTextArea();
      Admin.initOnboardingInputBoxes();

      Admin.initTrainingItemDropdown();
      Admin.initAppendNewTrainingItem();
      Admin.initRemoveTrainingItem();
      Admin.initTrainingInputBoxes();
      Admin.initTrainingTextArea();
    });
  }

  return {
    get_admin_list: _get_admin_list,
    get_admin_form: _get_admin_form,
    submit_admin_form: _submit_admin_form,
//    initRemoveOnboardingChecklistItem: _initRemoveOnboardingChecklistItem,
    init: _init,

    initOnboardingItemDropdown: _initOnboardingItemDropdown,
    initAppendNewOnboardingChecklistItem: _initAppendNewOnboardingChecklistItem,
    initRemoveOnboardingChecklistItem: _initRemoveOnboardingChecklistItem,
    initOnboardingInputBoxes: _initOnboardingInputBoxes,
    initOnboardingTextArea: _initOnboardingTextArea,
    render_onboarding_item_details: _render_onboarding_item_details,
    append_new_onboarding_checklist_item: _append_new_onboarding_checklist_item,
    remove_onboarding_checklist_item_row: _remove_onboarding_checklist_item_row,

    initTrainingItemDropdown: _initTrainingItemDropdown,
    initAppendNewTrainingItem: _initAppendNewTrainingItem,
    initRemoveTrainingItem: _initRemoveTrainingItem,
    initTrainingInputBoxes: _initTrainingInputBoxes,
    initTrainingTextArea: _initTrainingTextArea,
    render_training_item_details: _render_training_item_details,
    append_new_training_item: _append_new_training_item,
    remove_training_item_row: _remove_training_item_row
  }
}();
Admin.init();
/*** End: Admin Section */