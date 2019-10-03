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
				RegistrationCreateNewOfferLetter.save_offer_letter_template(this, objEvent);
			});

			$('#copyOfferLetterButton').on('click', function(objEvent){
				$('#offer-letter-template').select();
				document.execCommand('copy');
			});

			tinymce.init({
			  selector: 'textarea#offerLetterTemplate',
			  content_style: 'textarea { margin: 50px; border: 5px solid red; padding: 3px; }',
			  height: 500,
			  menubar: false,
			  plugins: [
			    'advlist autolink lists link image charmap print preview anchor save',
			    'searchreplace visualblocks code fullscreen',
			    'insertdatetime media table paste code help wordcount'
			  ],
			  toolbar: 'save undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help | preview | ExportToDoc',
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