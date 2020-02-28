var OnboardingViewSelectedOnboardingChecklistTemplate = function () {
  //query out all the checklist item details
  function _render_onboarding_checklist_item_details(objElement, objEvent) {
    if ($(objElement).val() != '') {
      var intOnboardingItemId = $(objElement).find(":selected").val();
      $.ajax({
        type: 'post',
        url: $(objElement).attr('data-render-url'),
        data: {
          ajax: 'onboardingChecklistTemplateForm',
          onboarding_item_id: intOnboardingItemId
        },
        dataType: 'json',
        success: function (data)
        {
          if ((typeof data['description']) !== 'undefined' && data !== null) {
            var description = data['description'];
            var department_owner = data['department_owner'];
            var is_offboarding_item = data['is_offboarding_item'];
            var remove_logo = '&#x2716;';

            var objRow = $(objElement).closest('tr');

            objRow.find('.description').text(description);
            objRow.find('.departmentOwner').text(department_owner);
            objRow.find('.isOffboardingItem').text(is_offboarding_item);
            objRow.find('span.removeOnboardingItemButton').html(remove_logo);
          }
        }
      });
    }
  }

  function _append_new_onboarding_checklist_item(objElement, objEvent) {
    var dataTable = $('#data_table');

    var appendRow = $('tr.appendOnboardingItemTr');

    //deciding to put list_even or list_odd for the front end
    var counter = $('#hiddenVal').val();
    counter++;
    $('#hiddenVal').val(counter);
    var numberAfterModulus = counter % 2;

    if (numberAfterModulus == 1) {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedOnboardingItemTr list_odd').show().appendTo(dataTable);
      $(clonedRow).find('.selectOnboardingItemTitle').attr('name', 'appended onboardingItemDropdown ' + counter);
    } else {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedOnboardingItemTr list_even').show().appendTo(dataTable);
      $(clonedRow).find('.selectOnboardingItemTitle').attr('name', 'appended onboardingItemDropdown ' + counter);
    }

    // need to reinitiate the dropdown for onboarding title and the remove button after appending
    OnboardingViewSelectedOnboardingChecklistTemplate.initOnboardingItemDropdown();
    OnboardingViewSelectedOnboardingChecklistTemplate.initRemoveOnboardingChecklistItem();
  }

  function _remove_onboarding_checklist_item_row(objElement, objEvent) {
    var rowToBeRemoved = $(objElement).closest('tr');
    $(rowToBeRemoved).remove();
    $('.updateOnboardingChecklistTemplateButton').prop('disabled', false);

    var counter = parseInt($('#hiddenVal').val());
    counter--;
    $('#hiddenVal').val(counter);
  }

  function _initInputBoxes() {
    $('input#templateTitle').unbind('keypress').keypress(function (objEvent) {
      $('.updateOnboardingChecklistTemplateButton').prop('disabled', false);
    });
  }

  function _initTextArea() {
    $('textarea#templateDescription').unbind('keypress').keypress(function (objEvent) {
      $('.updateOnboardingChecklistTemplateButton').prop('disabled', false);
    });
  }
  
  function _initOnboardingItemDropdown() {
    $('select[class="selectOnboardingItemTitle"]').unbind('change').change(function (objEvent) {
      OnboardingViewSelectedOnboardingChecklistTemplate.render_onboarding_checklist_item_details(this, objEvent);
      $('.updateOnboardingChecklistTemplateButton').prop('disabled', false);
    });
  }

  function _initAppendNewOnboardingChecklistItem() {
    $(':button#appendOnboardingItem').unbind('click').click(function (objEvent) {
      OnboardingViewSelectedOnboardingChecklistTemplate.append_new_onboarding_checklist_item(this, objEvent);
    });
  }

  function _initRemoveOnboardingChecklistItem() {
    $('td.removeOnboardingItemButton a').unbind('click').click(function (objEvent) {
      OnboardingViewSelectedOnboardingChecklistTemplate.remove_onboarding_checklist_item_row(this, objEvent);

    });
  }

  function _initDeleteOnboardingChecklistItem() {
    $('td.deleteOnboardingItemButton a').unbind('click').click(function (objEvent) {
      OnboardingViewSelectedOnboardingChecklistTemplate.delete_onboarding_checklist_item_record(this, objEvent);
    });
  }

  function _init() {
    $(function () {
      OnboardingViewSelectedOnboardingChecklistTemplate.initOnboardingItemDropdown();
      OnboardingViewSelectedOnboardingChecklistTemplate.initAppendNewOnboardingChecklistItem();
      OnboardingViewSelectedOnboardingChecklistTemplate.initRemoveOnboardingChecklistItem();
      OnboardingViewSelectedOnboardingChecklistTemplate.initDeleteOnboardingChecklistItem();
      OnboardingViewSelectedOnboardingChecklistTemplate.initTextArea();
      OnboardingViewSelectedOnboardingChecklistTemplate.initInputBoxes();
    });
  }

  return {
    init: _init,
    initOnboardingItemDropdown: _initOnboardingItemDropdown,
    initAppendNewOnboardingChecklistItem: _initAppendNewOnboardingChecklistItem,
    initRemoveOnboardingChecklistItem: _initRemoveOnboardingChecklistItem,
    initDeleteOnboardingChecklistItem: _initDeleteOnboardingChecklistItem,
    initTextArea: _initTextArea,
    initInputBoxes: _initInputBoxes,
    render_onboarding_checklist_item_details: _render_onboarding_checklist_item_details,
    append_new_onboarding_checklist_item: _append_new_onboarding_checklist_item,
    remove_onboarding_checklist_item_row: _remove_onboarding_checklist_item_row,
  }
}();
OnboardingViewSelectedOnboardingChecklistTemplate.init();







