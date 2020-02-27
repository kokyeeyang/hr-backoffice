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
            var department_owner = data['department'];
            var remove_logo = '&#x2716;';
            
            var objRow = $(objElement).closest('tr');

            objRow.find('.itemDescription').text(description);
            objRow.find('.itemDepartment').text(department_owner);
            objRow.find('span.removeTrainingItemButton').html(remove_logo);
          }
        }
      });
    }
  }
  
  function _append_new_onboarding_checklist_item(objElement, objEvent){
    var dataTable = $('#data_table');

    var appendRow = $('tr.appendOnboardingItemTr');

    //deciding to put list_even or list_odd for the front end
    var counter = parseInt($('#hiddenVal').val());
    counter++;
    $('#hiddenVal').val(counter);
    var numberAfterModulus = counter%2;

    if (numberAfterModulus == 1){
      var clonedRow = $(appendRow).clone().attr('class', 'appendedOnboardingItemTr list_odd').show().appendTo(dataTable);
      $(clonedRow).find('.selectOnboardingItemTitle').attr('name', 'appended onboardingItemDropdown ' + counter);
    } else {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedOnboardingItemTr list_even').show().appendTo(dataTable);
      $(clonedRow).find('.selectOnboardingItemTitle').attr('name', 'appended onboardingItemDropdown ' + counter);
    }

    // need to reinitiate the dropdown for onboarding title and the remove button after appending
    TrainingAddNewTrainingTemplate.initOnboardingItemDropdown();
    TrainingAddNewTrainingTemplate.initRemoveOnboardingChecklistItem();
  }
  
  function _remove_onboarding_checklist_item_row(objElement, objEvent){
    var rowToBeRemoved = $(objElement).closest('tr');
    $(rowToBeRemoved).remove();
    
    var counter = parseInt($('#hiddenVal').val());
    counter --;
  }
  
  function _initOnboardingItemDropdown(){
    $('select[class="selectOnboardingItemTitle"]').unbind('change').change(function(objEvent) {
      TrainingAddNewTrainingTemplate.render_onboarding_checklist_item_details(this, objEvent);
      $('.saveOnboardingChecklistTemplateButton').prop('disabled', false);
    });
  }
  
  function _initAppendNewOnboardingChecklistItem(){
    $(':button#appendOnboardingItem').unbind('click').click(function(objEvent){
      TrainingAddNewTrainingTemplate.append_new_onboarding_checklist_item(this, objEvent);
    });
  }
  
  function _initRemoveOnboardingChecklistItem(){
    $('td.removeOnboardingItemButton a').unbind('click').click(function(objEvent){
      TrainingAddNewTrainingTemplate.remove_onboarding_checklist_item_row(this, objEvent);
    });
  }
  
  function _init(){
    $(function() {
      TrainingAddNewTrainingTemplate.initOnboardingItemDropdown();
      TrainingAddNewTrainingTemplate.initAppendNewOnboardingChecklistItem();
      TrainingAddNewTrainingTemplate.initRemoveOnboardingChecklistItem();
    });
  }
  
  return {
    init : _init,
    initOnboardingItemDropdown : _initOnboardingItemDropdown,
    initAppendNewOnboardingChecklistItem : _initAppendNewOnboardingChecklistItem,
    initRemoveOnboardingChecklistItem : _initRemoveOnboardingChecklistItem,
    render_training_item_details : _render_training_item_details,
    append_new_onboarding_checklist_item : _append_new_onboarding_checklist_item,
    remove_onboarding_checklist_item_row : _remove_onboarding_checklist_item_row
  }
}();
TrainingAddNewTrainingTemplate.init();




