var TrainingViewSelectedOnboardingChecklist = function() {
	function _save_checklist(objElement, objEvent){
		if (confirm($('#msg-confirm-candidate-save').attr('data-msg'))){
			$('#onboarding-checklist').attr('action', $(objElement).attr('data-save-url')).submit();
		} else {
			objEvent.preventDefault();
		}
	}

	// function _check_for_checked_state(objElement, objEvent, checkBoxesArray, checkBoxesState){
	// 	$.ajax({
	// 		type: 'post',
	// 		url: $(objElement).attr('check-data-url'),
	// 		data: {
	// 			checked_state : $(objElement).val()
	// 		},
	// 		dataType: 'json',
	// 		success: function(data){

	// 		},
	// 		error: function(request, status, err){
	// 			alert('wrong');
	// 		}
	// 	});
	// }

	function _init(){
		$(function() {
			$('#saveChecklistButton').on('click', function(objEvent){
				// alert(checkedCheckboxes);
				alert(document.getElementById("demo").innerHTML);
				TrainingViewSelectedOnboardingChecklist.save_checklist(this, objEvent);
			});
		});

	}

	$(document).ready(function () {
		$(".completedCheckBox").change(function() {
			if ($(this).is(":checked") == true){
				var checkedCheckboxes = []; 
				var checkedItem = $(this).attr("id");
				// alert(checkedItemId);
				checkedCheckboxes.push(checkedItem);
				// $('#saveChecklistButton').on('click', function(objEvent){
				// 	alert(checkedCheckboxes);
				// });
				$('checkedStatus').attr('value', checkedCheckboxes);

				alert("checked stuff = " + checkedCheckboxes);
				document.getElementById("demo").innerHTML = checkedCheckboxes;

			}else if ($(this).is(":checked") == false){
				var uncheckedCheckboxes = [];
				var uncheckedItem = $(this).attr("id");
				// alert(uncheckedItemId);
				uncheckedCheckboxes.push(uncheckedItem);
				$('uncheckedStatus').attr('value', checkedCheckboxes);
				alert("wooo = " + uncheckedCheckboxes);
			}

			// $('#saveChecklistButton').on('click', function(objEvent){
			// 	alert("unchecked stuff = " + uncheckedCheckboxes);

			// 	alert("checked stuff = " + checkedCheckboxes);

			// 	TrainingViewSelectedOnboardingChecklist.save_checklist(this, objEvent);
			// });
		});


		$('.completedCheckBox').each(function(i, obj) {
				var individualCompleted = $(this);
			$('.uncompletedCheckBox').each(function(i, obj) {
			  var individualUncompleted = $(this);
			  individualCompleted.change(function() {
		  		if(individualCompleted.attr("value") == individualUncompleted.attr("value")){
				  	if(individualCompleted.is(":checked") == false){
				  		// var checkedItemId = individualCompleted.attr("value");
					  		console.log(individualUncompleted.attr("value"));
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
		// check_for_checked_state : _check_for_checked_state
	}

}();
TrainingViewSelectedOnboardingChecklist.init();