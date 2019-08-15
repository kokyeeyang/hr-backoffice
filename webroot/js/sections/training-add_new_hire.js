var TrainingAddNewHire = function() {
	function _check_for_candidate_information(objElement, objEvent){
		var candidateName = $("#candidateName option:selected").val();

		if($(objElement).val() != ''){
			$.ajax({
				type: 'post',
				url: $(objElement).attr('data-url'),
				data: {
					candidateName : $(objElement).val(),
				},
				dataType: 'json',
				success: function(data){
					alert(data);
				},
				error: function(request, status, err)
				{
					alert(err);
				}
			});
		}
	}

	// filter.addEventListener('change',filterChanged);

	// function _show_candidate_information(str){
	// 	if (str == ""){
	// 		document.getElementById("txtHint").innerHTML = "";
	// 		return;
	// 	} else {
	// 		if (window.XMLHttpRequest){
	// 			xmlhttp = new XMLHttpRequest();
	// 		}
	// 	}
	// 	xmlhttp.onreadystatechange = function() {
	// 		if (this.readyState == 4 && this.status == 200) {
	// 			document.getElementById("txtHint").innerHTML = this.responseText;
	// 		}
	// 	};
	// 	xmlhttp.open("GET", "showCandidateInformation.php?query=" + str, true);
	// 	xmlhttp.send();
	// }

	function _init(){
		$(function() {
			$('select#candidateName').on('change', function(objEvent) {
				TrainingAddNewHire.check_for_candidate_information(this, objEvent);
			});
		});
	}

	return {
		init : _init,
		check_for_candidate_information : _check_for_candidate_information,
		// show_candidate_information : _show_candidate_information
	}
}();
TrainingAddNewHire.init();