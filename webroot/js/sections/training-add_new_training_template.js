var TrainingAddNewTrainingTemplate = function(){
  //query out all the checklist item details
  function _render_training_item_details(objElement, objEvent){
    if ($(objElement).val() != ''){
      var intTrainingItemId = $(objElement).find(":selected").val();
      $.ajax({
        type: 'post',
        url: $(objElement).attr('data-render-url'),
        data : {
            ajax : 'trainingTemplateForm',
            training_item_id : intTrainingItemId 
        },
        dataType: 'json',
        success: function(data)
        {
          if((typeof data['description']) !== 'undefined' && data !== null){
            var description = data['description'];
            var responsibility = data['responsibility'];
            var remove_logo = '&#x2716;';
            var objRow = $(objElement).closest('tr');
            objRow.find('.itemDescription').text(description);
            objRow.find('.itemResponsibility').text(responsibility);
            objRow.find('span.removeTrainingItemButton').html(remove_logo);
          }
        }
      });
    }
  }
  
  function _append_new_training_item(objElement, objEvent){
    var dataTable = $('#data_table');

    var appendRow = $('tr.appendTrainingItemTr');

    //deciding to put list_even or list_odd for the front end
    var counter = parseInt($('#hiddenVal').val());
    counter++;
    $('#hiddenVal').val(counter);
    var numberAfterModulus = counter%2;

    if (numberAfterModulus == 1){
      var clonedRow = $(appendRow).clone().attr('class', 'appendedTrainingItemTr list_odd').show().appendTo(dataTable);
      $(clonedRow).find('.selectTrainingItemTitle').attr('name', 'appended trainingItemDropdown ' + counter);
    } else {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedTrainingItemTr list_even').show().appendTo(dataTable);
      $(clonedRow).find('.selectTrainingItemTitle').attr('name', 'appended trainingItemDropdown ' + counter);
    }

    // need to reinitiate the dropdown for training title and the remove button after appending
    TrainingAddNewTrainingTemplate.initTrainingItemDropdown();
    TrainingAddNewTrainingTemplate.initRemoveTrainingItem();
  }
  
  function _remove_training_item_row(objElement, objEvent){
    var rowToBeRemoved = $(objElement).closest('tr');
    $(rowToBeRemoved).remove();
    
    var counter = parseInt($('#hiddenVal').val());
    counter --;
  }
  
  function _initTrainingItemDropdown(){
    $('select[class="selectTrainingItemTitle"]').unbind('change').change(function(objEvent) {
      TrainingAddNewTrainingTemplate.render_training_item_details(this, objEvent);
      $('.saveTrainingTemplateButton').prop('disabled', false);
    });
  }
  
  function _initAppendNewTrainingItem(){
    $(':button#appendTrainingItem').unbind('click').click(function(objEvent){
      TrainingAddNewTrainingTemplate.append_new_training_item(this, objEvent);
    });
  }
  
  function _initRemoveTrainingItem(){
    $('td.removeTrainingItemButton a').unbind('click').click(function(objEvent){
      TrainingAddNewTrainingTemplate.remove_training_item_row(this, objEvent);
    });
  }
  
  function _init(){
    $(function() {
      TrainingAddNewTrainingTemplate.initTrainingItemDropdown();
      TrainingAddNewTrainingTemplate.initAppendNewTrainingItem();
      TrainingAddNewTrainingTemplate.initRemoveTrainingItem();
    });
  }
  
  return {
    init : _init,
    initTrainingItemDropdown : _initTrainingItemDropdown,
    initAppendNewTrainingItem : _initAppendNewTrainingItem,
    initRemoveTrainingItem : _initRemoveTrainingItem,
    render_training_item_details : _render_training_item_details,
    append_new_training_item : _append_new_training_item,
    remove_training_item_row : _remove_training_item_row
  }
}();
TrainingAddNewTrainingTemplate.init();




