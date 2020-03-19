/*** 
 Start	: SiteWelcome Section 
 By		: KC 2013-11-29
 */
var SiteWelcome = function () {

  function _init() {
    $(function () {
      $('.breadcrumb .title span').artTextLight({highlightInterval: 3000, class1: 'color1', class2: 'color2'});
    });
  }

  return {
    init: _init
  }
}();
SiteWelcome.init();
/*** End: SiteWelcome Section */