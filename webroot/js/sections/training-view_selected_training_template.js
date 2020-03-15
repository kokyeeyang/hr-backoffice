var TrainingViewSelectedTrainingTemplate = function(){
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
            objRow.find('span.removeItemButton').html(remove_logo);
          }
        }
      });
    }
  }
  
  function _append_new_training_item(objElement, objEvent){
    var dataTable = $('#data_table');

    var appendRow = $('tr.appendItemTr');

    //deciding to put list_even or list_odd for the front end
    var counter = parseInt($('#hiddenVal').val());
    counter++;
    $('#hiddenVal').val(counter);
    var numberAfterModulus = counter%2;

    if (numberAfterModulus == 1){
      var clonedRow = $(appendRow).clone().attr('class', 'appendedItemTr list_even').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended itemDropdown ' + counter);
    } else {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedItemTr list_odd').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended itemDropdown ' + counter);
    }

    // need to reinitiate the dropdown for training title and the remove button after appending
    TrainingViewSelectedTrainingTemplate.initTrainingItemDropdown();
    TrainingViewSelectedTrainingTemplate.initRemoveTrainingItem();
  }
  
  function _remove_training_item_row(objElement, objEvent){
    var rowToBeRemoved = $(objElement).closest('tr');
    $(rowToBeRemoved).remove();
    
    var counter = parseInt($('#hiddenVal').val());
    
    counter --;
    $('#hiddenVal').val(counter);
  }
  
  function _initTrainingItemDropdown(){
    $('select[class="selectItemTitle"]').unbind('change').change(function(objEvent) {
      TrainingViewSelectedTrainingTemplate.render_training_item_details(this, objEvent);
      $('.updateTemplateButton').prop('disabled', false);
    });
  }
  
  function _initInputBoxes(){
    $('input.inputBoxes').unbind('keypress').keypress(function(objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }
  
  function _initTextArea(){
    $('textarea#templateDescription').unbind('keypress').keypress(function(objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }
  
  function _initAppendNewTrainingItem(){
    $(':button#appendItem').unbind('click').click(function(objEvent){
      TrainingViewSelectedTrainingTemplate.append_new_training_item(this, objEvent);
    });
  }
  
  function _initRemoveTrainingItem(){
    $('td.removeItemButton a').unbind('click').click(function(objEvent){
      TrainingViewSelectedTrainingTemplate.remove_training_item_row(this, objEvent);
    });
  }
  
  function _init(){
    $(function() {
      TrainingViewSelectedTrainingTemplate.initTrainingItemDropdown();
      TrainingViewSelectedTrainingTemplate.initAppendNewTrainingItem();
      TrainingViewSelectedTrainingTemplate.initRemoveTrainingItem();
      TrainingViewSelectedTrainingTemplate.initInputBoxes();
      TrainingViewSelectedTrainingTemplate.initTextArea();
    });
  }
  
  return {
    init : _init,
    initTrainingItemDropdown : _initTrainingItemDropdown,
    initAppendNewTrainingItem : _initAppendNewTrainingItem,
    initRemoveTrainingItem : _initRemoveTrainingItem,
    initInputBoxes : _initInputBoxes,
    initTextArea : _initTextArea,
    render_training_item_details : _render_training_item_details,
    append_new_training_item : _append_new_training_item,
    remove_training_item_row : _remove_training_item_row
  }
}();
TrainingViewSelectedTrainingTemplate.init();




