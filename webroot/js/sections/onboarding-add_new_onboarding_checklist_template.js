var RegistrationAddNewOnboardingChecklistTemplate = function(){
  //query out all the checklist item details
  function _render_onboarding_checklist_item_details(objElement, objEvent){
    if ($(objElement).val() != ''){
      $ajax({
        type: 'post',
        url: $(objElement).attr('data-url'),
        data : {
          
        }
      });
    }
  }
  
  function _init(){
    
  }
  
  return {
    init : _init,
    render_onboarding_checklist_item_details : _render_onboarding_checklist_item_details
  }
}();




