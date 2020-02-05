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
          if((typeof data['description']) !== 'undefined' && data != null){
            var description = data['description'];
            var department_owner = data['department_owner'];
            var is_offboarding_item = data['is_offboarding_item'];
            var status = data['status'];
            var objRow = $(objElement).closest('tr');
            var objColumn = $(objElement).closest('td');

            objRow.find('.description').text(description);
            objRow.find('.departmentOwner').text(department_owner);
            objRow.find('.isOffboardingItem').text(is_offboarding_item);
            objRow.find('.status').text(status);
            
//            $("input.descriptionInput").val(description);
//            $("input.departmentOwnerInput").val(department_owner);
//            $("input.isOffboardingItemInput").val(is_offboarding_item);
//            $("input.statusInput").val(status);
            
              $('input.descriptionInput').val(description);
//            $("input:hidden.departmentOwnerInput").val(department_owner);
//            $("input.isOffboardingItemInput").val(is_offboarding_item);
//            $("input.statusInput").val(status);
            
//            objColumn.find('input.descriptionInput').val(description);
//            objColumn.find('input.departmentOwnerInput').val(department_owner);
//            objColumn.find('input.isOffboardingItemInput').val(is_offboarding_item);
//            objColumn.find('input.statusInput').val(status);
          }
        }
      });
    }
  }
  
  function _init(){
    $(function() {
      var selectedOption = $("select[name='onboardingItemDropdown'] option:selected").val();
      
      $('select[name="onboardingItemDropdown"]').change(function(objEvent) {
        if (selectedOption == ""){
          console.log(selectedOption);
          OnboardingAddNewOnboardingChecklistTemplate.render_onboarding_checklist_item_details(this, objEvent);
        } else {
          $("tr.onboardingItemTr td.appendedTd").empty;
          OnboardingAddNewOnboardingChecklistTemplate.render_onboarding_checklist_item_details(this, objEvent);
        }
      });
    });
  }
  
  return {
    init : _init,
    render_onboarding_checklist_item_details : _render_onboarding_checklist_item_details
  }
}();
OnboardingAddNewOnboardingChecklistTemplate.init();




