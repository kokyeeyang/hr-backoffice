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