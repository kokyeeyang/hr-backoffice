var RegistrationCreateNewOfferLetter = function(){
	function _save_offer_letter_template(objElement, objEvent){
		var editorContent = tinyMCE.activeEditor.getContent();
		  $.post(url, { "editor-content" : tinyMCE.activeEditor.getContent() }, function(respond){

       if ( respond == ''){
          alert('Content saved to file');
          return;
      } else {
          //Error message assumed
          alert(respond);
      }
    });
	}

	function _init(){
		$(function(){
			$('#saveOfferLetterButton').on('click', function(objEvent){
				if ($(".department-dropdown:checked").length > 0){
					if(confirm($('#msg-confirm-save-template').attr('data-msg'))){
						RegistrationCreateNewOfferLetter.save_offer_letter_template(this, objEvent);
					} else {
						event.preventDefault();
					}
				} else if ($(".department-dropdown:checked").length <= 0){
					alert($("#msg-department-reminder").attr('data-msg'));
					event.preventDefault();
				}
			});

			$('#copyOfferLetterButton').on('click', function(objEvent){
				$('#offer-letter-template').select();
				document.execCommand('copy');
			});

			tinymce.init({
			  selector: 'textarea#offerLetterTemplate',
			  content_style: 'textarea { margin: 50px; border: 5px solid red; padding: 3px; }',
			  height: 500,
			  menubar: "insert",
			  images_upload_url : 'uploadOfferLetterImages',
			  plugins: [
			    'advlist autolink lists link image charmap print preview anchor save',
			    'searchreplace visualblocks code fullscreen',
			    'insertdatetime media table paste code help wordcount'
			  ],
			 	toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help | preview | ExportToDoc | image',
			  // toolbar: 'save undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help | preview | ExportToDoc',
			  content_css: [
			    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			    '//www.tiny.cloud/css/codepen.min.css'
			  ]
			});
		});

	}

	return {
		init : _init,
		save_offer_letter_template : _save_offer_letter_template

	}
}();
RegistrationCreateNewOfferLetter.init();