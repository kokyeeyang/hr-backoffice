var OnboardingAddNewOnboardingChecklistTemplate = function(){
  //query out all the checklist item details
  function _render_onboarding_checklist_item_details(objElement, objEvent){
    if ($(objElement).val() != ''){
      var intOnboardingItemId = $(objElement).find(":selected").val();
      $.ajax({
        type: 'post',
        url: $(objElement).attr('data-render-url'),
        data : {
            ajax : 'onboardingChecklistTemplateForm',
            onboarding_item_id : intOnboardingItemId 
        },
        dataType: 'json',
        success: function(data)
        {
          if((typeof data['description']) !== 'undefined' && data !== null){
            var description = data['description'];
            var department_owner = data['department_owner'];
            var is_offboarding_item = data['is_offboarding_item'];
            
            var objRow = $(objElement).closest('tr');

            objRow.find('.description').text(description);
            objRow.find('.departmentOwner').text(department_owner);
            objRow.find('.isOffboardingItem').text(is_offboarding_item);
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
        
        console.log(numberAfterModulus);
        if (numberAfterModulus == 1){
          $(appendRow).clone().attr('class', 'appendedOnboardingItemTr list_odd').show().appendTo(dataTable);
        } else {
          $(appendRow).clone().attr('class', 'appendedOnboardingItemTr list_even').show().appendTo(dataTable);
        }
        
        // need to reinitiate the dropdown for onboarding title after appending
        OnboardingAddNewOnboardingChecklistTemplate.initOnboardingItemDropdown();
  }
  
  function _initOnboardingItemDropdown(){
      $('select[name="onboardingItemDropdown"]').unbind('change').change(function(objEvent) {
        OnboardingAddNewOnboardingChecklistTemplate.render_onboarding_checklist_item_details(this, objEvent);
      });
  }
  
  function _init(){
    $(function() {
      OnboardingAddNewOnboardingChecklistTemplate.initOnboardingItemDropdown();
      $(':button#appendOnboardingItem').unbind('click').click(function(objEvent){
        OnboardingAddNewOnboardingChecklistTemplate.append_new_onboarding_checklist_item(this, objEvent);
      });
    });
  }
  
  return {
    init : _init,
    initOnboardingItemDropdown : _initOnboardingItemDropdown,
    render_onboarding_checklist_item_details : _render_onboarding_checklist_item_details,
    append_new_onboarding_checklist_item : _append_new_onboarding_checklist_item
  }
}();
OnboardingAddNewOnboardingChecklistTemplate.init();




