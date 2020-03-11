/*** 
 Start	: Admin Section 
 By		: KC 2013-06-30
 */
var Admin = function () {

  function _get_admin_list(objElement, objEvent) {
    var strUrl = objElement.attr('rel');
    var arrParams = convert_url_to_array(strUrl);
    var strLang = '';

    if (typeof (arrParams['lang']) != 'undefined') {
      strLang = arrParams['lang'];
    }

    $.ajax({
      type: 'post',
      url: strUrl,
      data: {
        ajax: 'admin-list'
      },
      dataType: 'json',
      success: function (data) {

        if (data != null && data.result == 1 && data.content != '') {
          // Removes Loading...
          Project.hide_loading();

          var objContentElement = $('#main_content .main_content_wrapper');

          objContentElement.html('');
          objContentElement.append(data.content);
          $($('body')[0]).attr('id', 'admin-list');

          Project.set_leftnav_active_item(objElement);
          Project.init_common_button();
          Project.init_enter_submit();
          Project.set_grid();
          Project.submit_page();
          Admin.init();
        } else if (data != null && data.msg != '') {
          Project.popup_error(data.msg);
        } else {
          Project.popup_error($('#common-msg .msg_operation_failed').attr('rel'));
        }
      },
      beforeSend: function () {
        // Adds Loading...
        Project.show_loading();
      },
      complete: function () {
        // Removes Loading...
        Project.hide_loading();
      },
      error: function (request, status, err) {
        // Removes Loading...
        Project.popup_ajax_error(request, status, err);
      }
    });
  }

  function _get_admin_form(objElement, objEvent) {
    var strUrl = objElement.attr('rel');
    var arrParams = convert_url_to_array(strUrl);
    var strLang = '';
    var intId = 0;

    if (typeof (arrParams['lang']) != 'undefined') {
      strLang = arrParams['lang'];
    }

    if (typeof (arrParams['id']) != 'undefined') {
      intId = arrParams['id'];
    }

    $.ajax({
      type: 'post',
      url: strUrl,
      data: {
        ajax: 'admin-form',
        id: intId
      },
      dataType: 'json',
      success: function (data) {

        if (data != null && data.result == 1 && data.content != '') {
          // Removes Loading...
          Project.hide_loading();

          var objContentElement = $('#main_content .main_content_wrapper');

          objContentElement.html('');
          objContentElement.append(data.content);
          $($('body')[0]).attr('id', 'admin-form');

          Project.set_leftnav_active_item(objElement);
          Project.init_common_button();
          Project.init_enter_submit();
          Admin.init();
        } else if (data != null && data.msg != '') {
          Project.popup_error(data.msg);
        } else {
          Project.popup_error($('#common-msg .msg_operation_failed').attr('rel'));
        }
      },
      beforeSend: function () {
        // Adds Loading...
        Project.show_loading();
      },
      complete: function () {
        // Removes Loading...
        Project.hide_loading();
      },
      error: function (request, status, err) {
        // Removes Loading...
        Project.popup_ajax_error(request, status, err);
      }
    });
  }

  function _submit_admin_form(objElement, objEvent) {
    var objForm = objElement.closest('form');
    var strUrl = objForm.attr('action');
    var arrParams = convert_url_to_array(strUrl);
    var strLang = '';

    if (typeof (arrParams['lang']) != 'undefined') {
      strLang = arrParams['lang'];
    }

    $.ajax({
      type: 'post',
      url: strUrl,
      data: {
        ajax: 'submit-admin-form',
        admin_username: $(objForm.find('#Admin_admin_username')).val(),
        admin_password: $(objForm.find('#Admin_admin_password')).val(),
        admin_password_confirm: $(objForm.find('#admin_password_confirm')).val(),
        admin_display_name: $(objForm.find('#Admin_admin_display_name')).val(),
        admin_status: $(objForm.find('input:radio[name="Admin[admin_status]"]:checked')).val(),
        admin_priv: $(objForm.find('select[name="Admin[admin_priv]"]')).val(),
        // admin_department				: $(objForm.find('select[name="Admin[admin_department]"]')).val()
        admin_department: $(objForm.find('select[name=admin_department]')).val()
      },
      dataType: 'json',
      success: function (data) {

        if (data != null && data.result == 1 && data.content != '') {
          // Removes Loading...
          Project.hide_loading();
          var objContentElement = $('#main_content .main_content_wrapper');

          objContentElement.html('');
          objContentElement.append(data.content);
          //Project.set_leftnav_active_item(objElement);
          Project.init_common_button();
          Project.init_enter_submit();
          Project.set_grid();
          Project.submit_page();
          Admin.init();

          if (data.msg != '') {
            Project.popup_alert(data.msg);
          }
        } else if (data != null && data.msg != '') {
          Project.popup_error(data.msg);
        } else {
          Project.popup_error($('#common-msg .msg_operation_failed').attr('rel'));
        }
      },
      beforeSend: function () {
        // Adds Loading...
        Project.show_loading();
      },
      complete: function () {
        // Removes Loading...
        Project.hide_loading();
      },
      error: function (request, status, err) {
        // Removes Loading...
        Project.popup_ajax_error(request, status, err);
      }
    });
  }

  function openTab(evt, tabType) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  function _init() {
    $(function () {
      $('.btnGetAdminList').unbind('click').click(function (objEvent) {
        Admin.get_admin_list($(this), objEvent);
      });

      $('.btnGetAdminForm').unbind('click').click(function (objEvent) {
        Admin.get_admin_form($(this), objEvent);
      });

      $('.btnSubmitAdminForm').unbind('click').click(function (objEvent) {
        Admin.submit_admin_form($(this), objEvent);
      });
    });
  }

  return {
    get_admin_list: _get_admin_list,
    get_admin_form: _get_admin_form,
    submit_admin_form: _submit_admin_form,
    init: _init
  }
}();
Admin.init();
/*** End: Admin Section */