var Registration = function () {
  
  function _initFilterResults() {
    $("#label_filter").unbind('keypress').keypress(function (e) {
      if (e.which == 13) {
        $('form').submit;
      }
    });
  }
  
  function _init() {
    $(function () {
      Registration.initFilterResults();
    });
  }
  return {
    init: _init,
    initFilterResults: _initFilterResults
  }
}();
Registration.init();