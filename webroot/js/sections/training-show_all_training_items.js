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
  
  function _check_if_training_item_belongs_to_template(objElement, objEvent) {
    if ($(objElement.val() != ''))
    {
      $.ajax({
        type: 'post',
        //pass in training item id to query inside training_item_mapping table
        url: $(objElement).attr('data-url') + '/' + $(objElement).val(),
        data: {
          training_item_id: $(objElement).val()
        },
        dataType: 'json',
        success: function (data)
        {
          if (data != null && data.result != false){
            alert('This training item belongs to training template ' + data.result + '. Please delete it in the respective templates first.');
            //uncheck the boxes for training item that still belong in templates
            $('#deleteCheckBox' + $(objElement).val()).prop('checked', false);
          } else if (data == null && data.result == false){
            console.log('bye');
          }
        },
        error: function (request, status, err)
        {
          alert('something went wrong');
        }
      });
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
      $('#deleteTrainingItemButton').on('click', function (objEvent) {
        TrainingShowAllTrainingItems.check_if_deletion_is_selected(this, objEvent);
      });
      TrainingShowAllTrainingItems.initFilterResults();
      TrainingShowAllTrainingItems.initCheckIfTrainingItemBelongsToTemplate();
    });
  }

  return {
    init: _init,
    check_if_deletion_is_selected: _check_if_deletion_is_selected,
    check_if_training_item_belongs_to_template: _check_if_training_item_belongs_to_template,
    initFilterResults: _initFilterResults,
    initCheckIfTrainingItemBelongsToTemplate: _initCheckIfTrainingItemBelongsToTemplate
  }
}();
TrainingShowAllTrainingItems.init();
