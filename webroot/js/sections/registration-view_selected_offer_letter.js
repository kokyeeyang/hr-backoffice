var RegistrationViewSelectedOfferLetter = function(){
	function _save_offer_letter_template(objElement, objEvent){
		$('#createOfferLetterForm').attr('action', $('#updateOfferLetterButton').attr('data-update-url')).submit();
	}

	function _refine_url(objElement, objEvent){
	  var currURL= window.location.href; //get current address

    //Get the URL between what's after '/' and befor '?' 
    //1- get URL after'/registration/'
    var afterDomain= currURL.substring(currURL.lastIndexOf('/registration/') + 1);
    //2- get the part before '?'
    var beforeQueryString= afterDomain.split("?")[0];  

    return beforeQueryString;
	}

	function _copy_offer_letter_template(objElement, objEvent){
		$('#createOfferLetterForm').attr('action', $('#copyOfferLetterButton').attr('data-copy-url')).submit();


		$("#copyTemplateUrl").val(copyOfferLetterUrl);
		$("#updateOfferLetterButton").hide();
		$("#saveOfferLetterButton").show();


	}

	function _init(){
		$(function(){
			$('#updateOfferLetterButton').on('click', function(objEvent){
				RegistrationViewSelectedOfferLetter.save_offer_letter_template(this, objEvent);
			});

			$('#copyOfferLetterButton').on('click', function(objEvent){
				if(confirm($('#msg-confirm-offerletter-duplicate').attr('data-msg'))){
					RegistrationViewSelectedOfferLetter.copy_offer_letter_template(this, objEvent);
				} else {
					event.preventDefault;
				}
			});

			tinymce.init({
			  selector: 'textarea#offerLetterTemplate',
			  content_style: 'textarea { margin: 50px; border: 5px solid red; padding: 3px; }',
			  height: 500,
			  menubar: "insert",
	  		images_upload_url : 'uploadOfferLetterImages',
				automatic_uploads : false,
			  plugins: [
			    'advlist autolink lists link image charmap print preview anchor save',
			    'searchreplace visualblocks code fullscreen',
			    'insertdatetime media table paste code help wordcount'
			  ],
			  toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help | preview | ExportToDoc | image',

			  content_css: [
			    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			    '//www.tiny.cloud/css/codepen.min.css'
			  ],

			  images_upload_handler: function (blobInfo, success, failure) {
			    var xhr, formData;

			    xhr = new XMLHttpRequest();
			    xhr.withCredentials = false;
			    xhr.open('POST', 'uploadOfferLetterImages');

			    xhr.onload = function() {
			      var json;

			      if (xhr.status != 200) {
			        failure('HTTP Error: ' + xhr.status);
			        return;
			      }

			      json = JSON.parse(xhr.responseText);

			      if (!json || typeof json.location != 'string') {
			        failure('Invalid JSON: ' + xhr.responseText);
			        return;
			      }

			      success(json.location);
			    };

			    formData = new FormData();
			    formData.append('file', blobInfo.blob(), blobInfo.filename());

			    xhr.send(formData);
			  }
			});
		});

	}

	return {
		init : _init,
		save_offer_letter_template : _save_offer_letter_template,
		copy_offer_letter_template : _copy_offer_letter_template,
		refine_url : _refine_url
	}
}();
RegistrationViewSelectedOfferLetter.init();