function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}

function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}

function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function convert_url_to_array(url) {
	var request = {};
	
	if((typeof url) != 'undefined' && url != ''){
		var pairs 	= url.substring(url.indexOf('?') + 1).split('&');
		
		for (var i = 0; i < pairs.length; i++){
			var pair = pairs[i].split('=');
			request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
		}
	}
	return request;
}

function resizeIframe(obj) {
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}