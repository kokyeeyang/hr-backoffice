/*
Art Text Light jQuery plugin
Version 0.1.0 (24-May-2010)
http://www.artetics.com

Copyright (c) Artetics.com 2010

This script can be used in non-commercial projects only. You cannot claim this script as yours.
This script CANNOT be used by any company which name contains word 'soft'.
All rights for this script belong to Artetics company.

Icons included in demo package are licensed under Creative Commons license: http://www.iconfinder.com/browse/iconset/circular/#readme
Browser icons are WebBrowser Icons icon set: http://www.vistaicons.com/icon/i161s0/web_browsers_icons.htm

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this
list of conditions and the following disclaimer.

Redistributions in binary form must reproduce the above copyright notice, this
list of conditions and the following disclaimer in the documentation and/or other
materials provided with the distribution.

Neither the name of the Simon Baird nor the names of other contributors may be
used to endorse or promote products derived from this software without specific
prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT
SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR
BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
DAMAGE.
*/


(function(jQuery) {
 jQuery.fn.artTextLight = function(options) {
 
  var defaults = {
    letterHighlighSpeed: 50, // this interval will be used to highlight the next letter. milliseconds
    removeHighlighSpeed: 300, // this interval will be used to remove highligting from already highlighted letter. milliseconds
    highlightInterval: 2000, // each highlight iteration will start using this interval. milliseconds
    css1: {'color': 'white', 'text-shadow': '1px 1px 3px #FFFFFF'}, // CSS to apply to each letter in order to highlight it
    css2: {'color': 'black', 'text-shadow': 'none'}, // CSS that will be used to remove highlighting
    class1: '', // CSS to apply to each letter in order to highlight it
    class2: '' // CSS that will be used to remove highlighting	
  };
  var options = jQuery.extend(defaults, options);
    
  this.each(function(i) {
    var textElement = jQuery(this);
    textElement.hide();
    var text = textElement.text();
    var textArray = text.split('');
    var appendString = '';
    var parentClass = textElement.attr('class');
    if (typeof parentClass != 'undefined') {
      var newClass = 'arttextlight_' + textElement.attr('id') + ' ' + parentClass;
    } else {
      var newClass = 'arttextlight_' + textElement.attr('id');
    }
    for (j = 0; j < textArray.length; j++) {  
      appendString += '<span class="' + newClass + '">' + textArray[j] + '</span>';
    }
    textElement.after(appendString);
  });
  
  this.each(function(i) {
    var textElement = jQuery(this);
    window.setInterval(function() {
      jQuery('.arttextlight_' + textElement.attr('id')).eachDelay(function() {
		if(options.class1 != ''){
			jQuery(this).removeClass(options.class2).addClass(options.class1);
		}
		else{
			jQuery(this).css(options.css1);
		}
      }, options.letterHighlighSpeed);
      window.setTimeout(function() {
        jQuery('.arttextlight_' + textElement.attr('id')).eachDelay(function() {
			if(options.class2 != ''){
				jQuery(this).removeClass(options.class1).addClass(options.class2);
			}
			else{
				jQuery(this).css(options.css2);
			}		  
        }, options.letterHighlighSpeed)},
      options.removeHighlighSpeed);
    }, options.highlightInterval);
  });
  
  

 };
})(jQuery);

jQuery.fn.eachDelay = function(callback, speed) {
  return jQuery.eachDelay( this, callback, speed)
}
jQuery.extend({
  eachDelay: function(object,callback, speed) {
    var i = -1, length = object.length, id;
    id = window.setInterval(function() {
      if (++i === length || callback.call(object[i], i, object[i]) === false) 
        clearInterval(id);
    }, speed);
    return object;
  }
}); 