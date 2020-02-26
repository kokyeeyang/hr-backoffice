var TrainingShowAllTrainingItems = function () {
  function _check_if_deletion_is_selected(objElement, objEvent) {
    if ($(".deleteCheckBox:checked").length <= 0) {
      alert($('#msg-select-delete').attr('data-msg'));
    } else {
      if (confirm($('#msg-confirm-delete').attr('data-msg'))) {
        $('#trainingitems-list').attr('action', $(objElement).attr('data-delete-url')).submit();
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

  function _initCheckIfDeletionIsSelected() {
    $('#deleteTrainingItemButton').on('click', function (objEvent) {
      TrainingShowAllTrainingItems.check_if_deletion_is_selected(this, objEvent);
    });
  }

  function _init() {
    TrainingShowAllTrainingItems.initCheckIfDeletionIsSelected();
    TrainingShowAllTrainingItems.initFilterResults();
  }

  return {
    init: _init,
    check_if_deletion_is_selected: _check_if_deletion_is_selected,
    initFilterResults: _initFilterResults,
    initCheckIfDeletionIsSelected: _initCheckIfDeletionIsSelected
  }
}();
TrainingShowAllTrainingItems.init();
