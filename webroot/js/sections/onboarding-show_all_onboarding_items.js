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
  
  function _check_if_onboarding_item_belongs_to_template(objElement, objEvent){
    if ($(objElement).val() != '')
    {
      $.ajax({
        type: 'post',
        //pass in onboarding item id to query inside item mapping table
        url: $(objElement).attr('data-url') + '/' + $(objElement).val(),
        data: {
          job_id: $(objElement).val()
        },
        dataType: 'json',
        success: function (data)
        {
          if (data != null && data.result != false) {
            alert('This onboarding item belongs to template ' + data.result);
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

  function _view_selected_onboarding_item(objElement, objEvent) {
    $('#onboardingitems-list').attr('action', $(objElement).attr('data-view-url')).submit();
  }
  
  function _initCheckIfOnboardingItemBelongsToTemplate(){
    $('#deleteJobOpeningButton').unbind('click').click(function (objEvent) {
      OnboardingShowAllOnboardingItems.check_if_onboarding_item_belongs_to_template;
    });
  }

  function _init() {
    $(function () {
      $('#deleteOnboardingItemButton').unbind('click').click(function (objEvent) {
        OnboardingShowAllOnboardingItems.check_if_deletion_is_selected(this, objEvent);
      });
      
      OnboardingShowAllOnboardingItems.initCheckIfOnboardingItemBelongsToTemplate();
      
    });
  }

  return {
    init: _init,
    check_if_deletion_is_selected: _check_if_deletion_is_selected,
    check_if_onboarding_item_belongs_to_template: _check_if_onboarding_item_belongs_to_template,
    initCheckIfOnboardingItemBelongsToTemplate: _initCheckIfOnboardingItemBelongsToTemplate
  }

}();
OnboardingShowAllOnboardingItems.init();