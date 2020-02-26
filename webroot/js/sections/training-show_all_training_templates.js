var TrainingShowAllTrainingTemplates = function () {
  function _check_if_deletion_is_selected(objElement, objEvent) {
    if ($(".deleteCheckBox:checked").length <= 0) {
      alert($('#msg-select-delete').attr('data-msg'));
    } else {
      if (confirm($('#msg-confirm-delete').attr('data-msg'))) {
        $('#trainingtemplates-list').attr('action', $(objElement).attr('data-delete-url')).submit();
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
    $('#deleteTrainingTemplateButton').on('click', function (objEvent) {
      TrainingShowAllTrainingTemplates.check_if_deletion_is_selected(this, objEvent);
    });
    TrainingShowAllTrainingTemplates.initFilterResults();
  }

  return {
    init: _init,
    check_if_deletion_is_selected: _check_if_deletion_is_selected,
    initFilterResults: _initFilterResults
  }
}();
TrainingShowAllTrainingTemplates.init();
