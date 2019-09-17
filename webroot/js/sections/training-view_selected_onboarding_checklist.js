var TrainingViewSelectedOnboardingChecklist = function() {
	function _save_checklist(objElement, objEvent){
		// if (confirm($('#msg-update-checklist').attr('data-msg'))){
		if (confirm($('#checkedItems').attr('data-msg'))){
			$('#onboarding-checklist').attr('action', $(objElement).attr('data-save-url')).submit();
		} else {
			objEvent.preventDefault();
		}
	}

	function _init(){
		$(function() {
			$('#saveChecklistButton').on('click', function(objEvent){
				TrainingViewSelectedOnboardingChecklist.save_checklist(this, objEvent);
			});
		});

	}
				
	$(document).ready(function () {
		var checkedCheckboxes = []; 
		$(':input[id="saveChecklistButton"]').prop('disabled', true);

		$(".completedCheckBox").change(function() {
			$(':input[id="saveChecklistButton"]').prop('disabled', false);
			if ($(this).is(":checked") == true){
				var checkedItem = $(this).attr("id");
				if (jQuery.inArray(checkedItem, checkedCheckboxes) === -1){
					checkedCheckboxes.push(checkedItem);
				}

				var confirmationMessage = "You have completed the following items : " + checkedCheckboxes + ". Are you sure that you want to proceed to saving?";
				$("#checkedItems").attr("data-msg", confirmationMessage);
			} else if ($(this).is(":checked") == false){
				var itemToBeRemoved = $(this).attr("id");

				checkedCheckboxes = jQuery.grep(checkedCheckboxes, function(value) {
					return value != itemToBeRemoved;
				});

				var confirmationMessage = "You have completed the following items : " + checkedCheckboxes + ". Are you sure that you want to proceed to saving?";
				$("#checkedItems").attr("data-msg", confirmationMessage);
			}
		});


		$('.completedCheckBox').each(function(i, obj) {
				var individualCompleted = $(this);
			$('.uncompletedCheckBox').each(function(i, obj) {
			  var individualUncompleted = $(this);
			  individualCompleted.change(function() {
		  		if(individualCompleted.attr("value") == individualUncompleted.attr("value")){
				  	if(individualCompleted.is(":checked") == false){
					  		// console.log(individualUncompleted.attr("value"));
					  		individualUncompleted.prop( "checked", true );
				  	} else if(individualCompleted.is(":checked") == true){
				  			individualUncompleted.prop( "checked", false );
				  	}
			  	}
				});
			});
		});
	});

	return {
		init : _init,
		save_checklist : _save_checklist
	}

}();
TrainingViewSelectedOnboardingChecklist.init();