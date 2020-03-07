var OnboardingShowAllOnboardingItems = function () {
  function _check_if_deletion_is_selected(objElement, objEvent) {
    if ($(".deleteCheckBox:checked").length <= 0) {
      alert($('#msg-select-delete').attr('data-msg'));
    } else {
      if (confirm($('#msg-confirm-delete').attr('data-msg'))) {
        $('#onboardingitems-list').attr('action', $(objElement).attr('data-delete-url')).submit();
      }
    }
  }

  function _check_if_onboarding_item_belongs_to_template(objElement, objEvent) {
    if ($(objElement).val() != '')
    {
      $.ajax({
        type: 'post',
        //pass in onboarding item id to query inside item mapping table
        url: $(objElement).attr('data-url') + '/' + $(objElement).val(),
        data: {
          onboarding_item_id: $(objElement).val()
        },
        dataType: 'json',
        success: function (data)
        {
          if (data != null && data.result != false) {
            alert('This onboarding item belongs to the following template : \r\n ' + data.result + '. Please delete in that template(s) first');
            //uncheck the boxes for onboarding item that still belong in templates
            $('#deleteCheckBox' + $(objElement).val()).prop('checked', false);

          } else if (data != null && data.result == false) {
            console.log('bye');
          }
        },
        error: function (request, status, err)
        {
          alert('wrong');
        }
      });
    }
  }

  function _initCheckIfOnboardingItemBelongsToTemplate() {
    $('.deleteCheckBox').unbind('change').change(function (objEvent) {
      OnboardingShowAllOnboardingItems.check_if_onboarding_item_belongs_to_template(this, objEvent);
    });
  }

  function _initFilterResults() {
    $("#label_filter").unbind('keypress').keypress(function (e) {
      if (e.which == 13) {
        $('form').submit;
      }
    });
  }

  function _init() {
    $(function () {
      OnboardingShowAllOnboardingItems.initCheckIfOnboardingItemBelongsToTemplate();
      OnboardingShowAllOnboardingItems.initFilterResults();
      $('#deleteOnboardingItemButton').unbind('click').click(function (objEvent) {
        OnboardingShowAllOnboardingItems.check_if_deletion_is_selected(this, objEvent);
      });
    });
  }

  return {
    init: _init,
    check_if_deletion_is_selected: _check_if_deletion_is_selected,
    check_if_onboarding_item_belongs_to_template: _check_if_onboarding_item_belongs_to_template,
    initCheckIfOnboardingItemBelongsToTemplate: _initCheckIfOnboardingItemBelongsToTemplate,
    initFilterResults: _initFilterResults
  }

}();
OnboardingShowAllOnboardingItems.init();