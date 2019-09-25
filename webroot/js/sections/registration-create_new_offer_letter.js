var RegistrationCreateNewOfferLetter = function(){
	function _init(){
		$(function(){
			tinymce.init({
			  selector: 'textarea#basic-example',
			  content_style: 'textarea { margin: 50px; border: 5px solid red; padding: 3px; }',
			  height: 500,
			  menubar: false,
			  plugins: [
			    'advlist autolink lists link image charmap print preview anchor',
			    'searchreplace visualblocks code fullscreen',
			    'insertdatetime media table paste code help wordcount'
			  ],
			  toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
			  content_css: [
			    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			    '//www.tiny.cloud/css/codepen.min.css'
			  ]
			});
		});
	}

	return {
		init : _init
	}
}();
RegistrationCreateNewOfferLetter.init();