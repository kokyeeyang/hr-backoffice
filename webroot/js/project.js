/*** 
 Start	: Project Section 
 By		: KC 2013-06-30
 */
var Project = function () {

  function _logout() {

    $('.admin_logout').bind('click', function (objEvent) {

      if ($(this).attr('rel') != '' && (typeof $(this).attr('rel')) != 'undefined') {
        Project.show_loading();
        window.location = $(this).attr('rel');
        objEvent.preventDefault();
        return false;
      }
    });
  }

  function _change_theme() {

    $('.admin_info #theme').bind('change', function (objEvent) {

      if ($(this).attr('rel') != '' && (typeof $(this).attr('rel')) != 'undefined') {
        Project.show_loading();
        window.location = $(this).attr('rel') + '&theme=' + $(this).val();
        objEvent.preventDefault();
        return false;
      }
    });
  }

  function _set_grid() {
    // Grid Styling
    $('.grid tbody tr:even').addClass('list_even');
    $('.grid tbody tr:odd').addClass('list_odd');

    $('.grid tbody tr:even').unbind('mouseover').mouseover(function () {
      $(this).addClass('list_row_highlight');
    }).unbind('mouseout').mouseout(function () {
      $(this).removeClass('list_row_highlight');
      $(this).addClass('list_even');
    });

    $('.grid tbody tr:odd').unbind('mouseover').mouseover(function () {
      $(this).addClass('list_row_highlight');
    }).unbind('mouseout').mouseout(function () {
      $(this).removeClass('list_row_highlight');
      $(this).addClass('list_odd');
    });
  }

  function _set_leftnav_active_item(objElement) {

    if ($(objElement.parents('.left_menu .nav .dropdown')).html() != 'undefined') {
      objElement = objElement.parents('.left_menu .nav .dropdown');
    } else {
      objElement = objElement.parent('li');
    }

    // To reset the left menu by removing the current 'active' class
    $($(objElement.parents('.left_menu .nav')).children('li')).each(function (index) {
      $(this).removeClass('active');
    });
    // To set the selected menu with the 'active' class
    $(objElement).addClass('active');
  }

  function _popup_error(strMsg, strTitle, intWidth, intHeight, dblOpacity) {

    if (strMsg != '') {

      if (intWidth == null) {
        intWidth = 200;
      }

      if (intHeight == null) {
        intHeight = 80;
      }

      if (dblOpacity == null) {
        dblOpacity = 0.8;
      }

      var strContent = '<table border="0" cellpadding="0" cellspacing="0"><tr><td style="text-align:center; height:' + intHeight + 'px; width:' + intWidth + 'px; font-size:14px; color:#f4324c;"><b>' + strMsg + '</b></td></tr></table>';

      $.fancybox(strContent,
              {
                beforeShow: function () {
                  $(".fancybox-skin").css({"backgroundColor": "#e0e0e0", "opacity": dblOpacity});
                }
              });
    }
  }

  // Note: In order for the FORM elements(within the popup_msg) to work properly, the 'object' type of content would be required for the IE7. 
  function _popup_msg(content, strTitle, intWidth, intHeight, strAlign, dblOpacity, intFontSize) {

    if (content != '') {

      if (strAlign == null || strAlign == '') {
        strAlign = 'text-align:center';
      }

      if (intFontSize == null || intFontSize == '') {
        intFontSize = 14;
      }

      if ((typeof content) == 'object') {
        var strContent = content.html();
      } else {
        var strContent = content;
      }

      if (intWidth > 0 && intHeight > 0) {
        var strContent = '<table border="0" cellpadding="0" cellspacing="0"><tr><td style="' + strAlign + '; font-size:' + intFontSize + 'px; height:' + intHeight + 'px; width:' + intWidth + 'px;" id="fancybox_popup_msg_content">' + strContent + '</td></tr></table>';
      } else if (intWidth > 0) {
        var strContent = '<table border="0" cellpadding="0" cellspacing="0"><tr><td style="' + strAlign + '; font-size:' + intFontSize + 'px; width:' + intWidth + 'px;" id="fancybox_popup_msg_content">' + strContent + '</td></tr></table>';
      } else if (intHeight > 0) {
        var strContent = '<table border="0" cellpadding="0" cellspacing="0"><tr><td style="' + strAlign + '; font-size:' + intFontSize + 'px; height:' + intHeight + 'px;" id="fancybox_popup_msg_content">' + strContent + '</td></tr></table>';
      } else {
        var strContent = '<table border="0" cellpadding="0" cellspacing="0"><tr><td style="' + strAlign + '; font-size:' + intFontSize + 'px;" id="fancybox_popup_msg_content">' + strContent + '</td></tr></table>';
      }

      if (dblOpacity == null) {
        dblOpacity = 0.8;
      }

      $.fancybox(strContent,
              {
                beforeShow: function () {
                  $(".fancybox-skin").css({"backgroundColor": "#e0e0e0", "opacity": dblOpacity});
                },
                afterShow: function () {

                  // IE7 Fixes
                  if ((typeof content) == 'object') {
                    $('#fancybox_popup_msg_content').html('');
                    content.appendTo('#fancybox_popup_msg_content');
                  }
                }
              });
    }
  }

  function _popup_alert(strMsg) {

    if (strMsg != '') {
      Project.popup_msg('<div class="popup_alert">' + strMsg + '</div>', '', 200, 80);
    }
  }

  function _popup_coming_soon() {
    // Please put all kinds of the "Coming soon popups" here.
    $('.coming_soon_popup').bind('click', function (objEvent) {

      if ($(this).attr('rel') != '' && (typeof $(this).attr('rel')) != 'undefined') {
        var strMsg = $(this).attr('rel');
      } else {
        var strMsg = $('.msg_coming_soon').attr('rel');
      }

      Project.popup_error(strMsg);
      objEvent.preventDefault();
      return false;
    });
  }

  function _popup_fancybox(objElement, strWidth, strHeight, strScrolling, bolAutoResize) {

    if (strWidth == null) {
      strWidth = '100%';
    } // - end: if

    if (strHeight == null) {
      strHeight = '100%';
    } // - end: if

    if (strScrolling == null) {
      var strScrolling = 'auto';
    } // - end: if		

    if (bolAutoResize == null) {
      var bolAutoResize = true;
    } // - end: if

    $.fancybox(
            {
              type: 'iframe',
              width: strWidth,
              height: strHeight,
              padding: 10,
              href: $(objElement).attr('rel'),
              autoResize: bolAutoResize,
              iframe: {
                scrolling: strScrolling,
                preload: true
              },
              beforeLoad: function () {
                // Adds Loading...
              },
              afterLoad: function () {
              }
            });
  }

  function _popup_ajax_error(request, status, err) {

    if (status == "timeout" || status == "error" || status == "parsererror") {

      if (request.status == 403) {
        Project.popup_error($('#common-msg .msg_required_login').attr('rel'));
      } else {
        Project.popup_error($('#common-msg .msg_operation_failed').attr('rel'));
      } // - end: if else
    }
  }

  function _submit_page() {
    $('select.pagination').unbind('change').bind('change', function () {
      Project.proceed_submit_page($(this), $(this).val());
    });

    $('div.btnRefreshPage').unbind('click').bind('click', function () {
      // Reset the pagination's to the 1st page.
      if ($(this).attr('rel') == 'search') {
        Project.proceed_submit_page($(this));
      } else {
        Project.proceed_submit_page($(this), $('select.pagination').val());
      } // - end: if else
    });

    $('div.btnAjaxSortList').unbind('click').bind('click', function () {
      Project.proceed_submit_page($(this));
    });
  }

  function _proceed_submit_page(objElement, intPage) {
    var objForm = objElement.closest('form');
    var objMode = objForm.find('input[name="mode"]');
    var strUrl = objForm.attr('action');
    var arrParams = convert_url_to_array(strUrl);
    var strLang = '';
    var strMode = 'submit-pagination';
    var strSortRev = '';
    var strSortKey = '';
    var oData = {};

    if (typeof (objForm[0]) != 'undefined' && objElement.attr('name') == 'pagination') {
      objForm[0].reset();
    }

    if (typeof (arrParams['lang']) != 'undefined') {
      strLang = arrParams['lang'];
    }

    if (objMode != 'undefined') {
      strMode = objMode.val();
    }

    /***
     Start: List Sorting - Updates Sort Key
     */
    if (objElement.hasClass('btnAjaxSortList') == true) {
      strSortRev = objElement.attr('rev');
      if (objElement.hasClass('desc') == true) {
        strSortKey = strSortRev + '_asc';
      } else {
        strSortKey = strSortRev + '_desc';
      } // - end: if else
      objForm.find('#sort_key').val(strSortKey);
    }
    // To clear the manual sorting for a new search
    else if (objElement.attr('rel') == 'search') {
      objForm.find('#sort_key').val('');
    }
    /***
     End: List Sorting - Updates Sort Key
     */

    objForm.find('input, select').each(function () {
      var strName = $(this).attr('name');

      if (strName != 'mode' && strName != 'pagination') {
        oData[strName] = $(this).val();
      } // - end: if
    });

    oData.ajax = strMode;
    oData.page = ((typeof intPage) != 'undefined') ? intPage : 0;

    $.ajax({
      type: 'post',
      url: strUrl,
      data: oData,
      dataType: 'json',
      success: function (data) {
        if (data != null && data.result == 1 && data.content != '') {
          // Removes Loading...
          Project.hide_loading();
          var objContentElement = $('#main_content .main_content_wrapper');

          objContentElement.html('');
          objContentElement.append(data.content);

          /***
           Start: List Sorting - Changed Sorting Icons
           */
          if (strSortKey != '') {
            var objElement = $('div[rev="' + strSortRev + '"]');

            if (strSortKey == strSortRev + '_desc') {
              objElement.removeClass('asc').addClass('desc');
            } else {
              objElement.removeClass('desc').addClass('asc');
            }
          }
          /***
           End: List Sorting - Changed Sorting Icons
           */

          Project.init_common_button();
          Project.init_enter_submit();
          Project.set_grid();
          Project.submit_page();

          // Admin List
          if ($('#admin-list').length > 0 && (typeof Admin) == 'object') {
            Admin.init();
          }
          // Report Admin Activity Logs List
          else if ($('#admin-activity-log-list-form').length > 0 && (typeof Report) == 'object') {
            Report.init();
          } else if ($('#jobopening-list').length > 0 && (typeof RegistrationShowAllJobOpenings) == 'object') {
            RegistrationShowAllJobOpenings.init();
          }
          // else if($('#department-list-test').length > 0 && (typeof Department) == 'object'){
          // 	Department.init();
          // } 

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

  function _submit_form() {
    $('.btnSubmitForm,#btnSubmitForm').bind('click', function () {
      var bolSubmit = true;

      $($(this).closest('form')).find(".required").each(function (index) {

        if ($(this).val() == '' || $(this).val() == null) {
          bolSubmit = false;
        }
      });

      if (bolSubmit == true) {
        Project.show_loading();
        $(this).closest('form').submit();
      } else {
        Project.popup_alert($(this).attr('rel'));
      } // - end: if else
    });
  }

  function _reset_form() {
    $('.btnResetForm,#btnResetForm').unbind('click').click(function (objEvent) {
      var objForm = $(this).closest('form');

      if ((typeof objForm[0]) == 'object') {
        objForm[0].reset();
      }
    });
  }

  function _init_enter_submit() {
    // To submit form when user press 'enter' key within the text input field
    $('input[type="text"],input[type="password"]').unbind('keypress').keypress(function (objEvent) {

      if ($(this).hasClass('no_enter_submit') == false && objEvent.which == 13) {
        // Adds Loading...

        if ($($(this).closest('form')).attr('id') == 'login_form') {
          SiteLogin.submit_site_login($(this).closest('form'), objEvent);
        } else if ($($(this).closest('form')).attr('id') == 'admin-form') {
          Admin.submit_admin_form($(this), objEvent);
        } else if ($($(this).closest('form')).attr('id') == 'setting-form') {
          Setting.submit_form($(this), objEvent);
        } else {

          if ((typeof $(this).closest('form')[0]) != 'undefined') {
            Project.show_loading();
            $(this).closest('form')[0].submit();
          }
        }
        objEvent.preventDefault();
        return false;
      }
    });
  }

  function _show_loading() {
    var objImg = $('div#common-msg .msg_loading_img').clone(true);
    var strImg = '<div id="icon-loading" style="padding:5px 5px 5px 5px;">' + objImg.html() + '</div>';

    $.fancybox(strImg,
            {modal: true,
              padding: 0,
              margin: 0,
              autoSize: false,
              width: 58,
              height: 58,
              minWidth: 58,
              minHeight: 58,
              fixed: true,
              scrolling: 'no',
              beforeShow: function () {
                $('.fancybox-skin').css({'background': 'transparent', 'box-shadow': 'none'});
                $('.fancybox-inner').css({'overflow': 'hidden'});
              }
            });
  }

  function _hide_loading() {
    if ($('.fancybox-wrap #icon-loading').length > 0) {
      $.fancybox.close();
      $('.fancybox-wrap').hide();
      $('.fancybox-overlay').hide();
    }
  }

  function _copy_code() {
    if ($('.copy_code').length > 0) {
      $('.copy_code').zclip({
        path: "../js/ZeroClipboard.swf",
        copy: function () {
          return $(this).val();
        }
      });
    }
  }

  function _switch_button_theme(objElement, strThemeFrom, strThemeTo) {

    if (objElement.find('.' + strThemeFrom + '_button').length > 0) {
      var strLeftCorner = objElement.find('.left_corner > img').attr('src');
      var strRightCorner = objElement.find('.right_corner > img').attr('src');

      objElement.find('.' + strThemeFrom + '_button').removeClass(strThemeFrom + '_button').addClass(strThemeTo + '_button');
      objElement.find('.' + strThemeFrom + '_button_wrapper').removeClass(strThemeFrom + '_button_wrapper').addClass(strThemeTo + '_button_wrapper');
      objElement.find('.left_corner > img').attr('src', strLeftCorner.replace(strThemeFrom, strThemeTo));
      objElement.find('.right_corner > img').attr('src', strRightCorner.replace(strThemeFrom, strThemeTo));

      switch (strThemeTo) {
        case 'red':
          objElement.find('a').css('color', '#ffffff');
          break;

        case 'grey':
          objElement.find('a').css('color', '#333333');
          break;

        case 'green':
          objElement.find('a').css('color', '#333333');
          break;

        case 'yellow':
          objElement.find('a').css('color', '#333333');
          break;

        case 'disabled':
          objElement.find('a').css('color', '#848383');
          break;
      } // - end: switch

      Project.init_common_button();
    } // - end: if
  }

  function _onload_iframe(obj) {
    $('.common_content_wrapper .loading').remove();

    // Have to set the Cross-Origin Resource Sharing (CORS) first then re-enabled back. 
    // Uncaught DOMException: Blocked a frame with origin "http://myubuntu.local" from accessing a cross-origin frame.
    //resizeIframe(obj);
  }

  function _init_scroller() {

    if ($('.jsp-content').length > 0) {
      $('.jsp-content').jScrollPane(
              {
                showArrows: true,
                horizontalGutter: 10,
                mouseWheelSpeed: 50
              }
      );

      $('img').each(function () {
        if ($(this).height() > 0) {
          $('.jsp-content').jScrollPane(
                  {
                    showArrows: true,
                    horizontalGutter: 10,
                    mouseWheelSpeed: 50
                  }
          );
        } else {
          $(this).load(function () {
            $('.jsp-content').jScrollPane(
                    {
                      showArrows: true,
                      horizontalGutter: 10,
                      mouseWheelSpeed: 50
                    }
            );
          });
        }
      });
    }
  }

  function _init_common_button() {

    /*** Start: Generic Buttons ***/
    $('.button').unbind('click').bind('click', function () {
      var sUrl = $(this).find('a').attr('href');

      if (sUrl != '' && sUrl != '#' && sUrl.indexOf('javascript') == -1) {
        window.location = sUrl;
      }
    });

    $('.button').unbind('mouseover').mouseover(function () {
      $(this).find('a').css('color', '#ff9900');
    }).unbind('mouseout').mouseout(function () {
      $(this).find('a').css('color', '#ffffff');
    });

    $('.red_button').unbind('mouseover').mouseover(function () {
      $(this).find('a').css('color', '#ff9900');
    }).unbind('mouseout').mouseout(function () {
      $(this).find('a').css('color', '#ffffff');
    });

    $('.white_button,.grey_button').unbind('mouseover').mouseover(function () {
      $(this).find('a').css('color', '#057602');
    }).unbind('mouseout').mouseout(function () {
      $(this).find('a').css('color', '#333333');
    });

    $('.green_button').unbind('mouseover').mouseover(function () {
      $(this).find('a').css('color', '#f5ebac');
    }).unbind('mouseout').mouseout(function () {
      $(this).find('a').css('color', '#333333');
    });

    $('.yellow_button').unbind('mouseover').mouseover(function () {
      $(this).find('a').css('color', '#000000');
    }).unbind('mouseout').mouseout(function () {
      $(this).find('a').css('color', '#333333');
    });

    $('.disabled_button').unbind('mouseover').unbind('mouseout').find('a').css('color', '#848383');

    $('.btnResetForm').unbind('click').bind('click', function () {
      $(this).closest('form')[0].reset();
    });

    $('.btnPopupFancyBox').unbind('click').bind('click', function () {
      Project.popup_fancybox(this, '100%', '100%');
    });
    /*** End: Generic Buttons ***/

    /*** Start: Left Navigation Buttons */
    $('.left_menu .nav li').unbind('mouseover').bind('mouseover', function () {

      if ($(this).hasClass('active') == false && $(this).hasClass('nav-header') == false) {
        $(this).addClass('highlight');
      }
    }).unbind('mouseout').bind('mouseout', function () {

      if ($(this).hasClass('active') == false && $(this).hasClass('nav-header') == false) {
        $(this).removeClass('highlight');
      }
    });

    $('.left_menu .dropdown > a').unbind('click').click(function () {

      if (!$(this).next().is(':visible')) {
        $(this).next().slideDown('fast');
      } else {
        $(this).next().slideUp('fast');
      }
      return false;
    });

    $('.left_menu .dropdown > ul > li').unbind('click').click(function () {

      if ($(this).children('a').attr('href') == 'javascript:void(0);') {
        $('.left_menu .nav .dropdown > ul').hide();
        $(this).parents('.dropdown > ul').slideDown();
      }
    });

    if (!$('.left_menu .dropdown.active > a').next().is(':visible')) {
      $('.left_menu .dropdown.active > a').next().slideDown('fast');
    }
    /*** End: Left Navigation Buttons */
  }

  function _init_flash_error() {

    if ($('.flash_error').length > 0) {
      var strContent = $.trim($('.flash_error').html());

      if (strContent != '') {
        Project.popup_error(strContent);
      }
    }
  }

  function _init_flash_alert() {

    if ($('.flash_alert').length > 0) {
      var strContent = $.trim($('.flash_alert').html());

      if (strContent != '') {
        Project.popup_alert(strContent);
      }
    }
  }

  function _init_leftnav_iframe_link() {

    if ($('a[target="main_content_iframe"]').length > 0) {
      $('a[target="main_content_iframe"]').unbind('click').click(function () {
        $('.left_menu li').removeClass('active');
        $(this).closest('.dropdown').addClass('active');
        var objMainContentWrapper = $('#tpl_main .common_content_wrapper');
        var strLink = $(this).attr('rel');
        var strIcon = $(this).attr('data-icon');

        if (strLink != '' && (typeof strLink) != 'undefined') {
          //var strApiName = strLink.substring(strLink.lastIndexOf('/')+1);
          $('#tpl_main .breadcrumb-top').html('API URL - ' + strLink);
          $('#tpl_main .breadcrumb-bottom').remove();
          $('#tpl_main .breadcrumb-top').closest('.breadcrumb_wrapper').append('<div class="breadcrumb-bottom ' + strIcon + '"><div class="title"><span>' + $('.admin_info #theme option:selected').text() + ' : ' + $(this).text() + '</span></div></div>');
          objMainContentWrapper.html('<div class="loading"><center>Loading...</center></div><iframe src="' + strLink + '" width="100%" height="800" frameborder="0" onload="Project.onload_iframe(this)"></iframe>');
        }
      });
    }
  }

  function _filter_results() {
    $("#label_filter").unbind('keypress').keypress(function (e) {
      if (e.which == 13) {
        $('form').submit;
      }
    });
  }

  //start js codes for assigning onboarding items for new hirees
  //work on this now!
  //need to set an ajax form data to post to
  function _render_onboarding_item_details(objElement, objEvent) {
    if ($(objElement).val() != '') {
      var intOnboardingItemId = $(objElement).find(":selected").val();
      $.ajax({
        type: 'post',
        url: $(objElement).attr('data-render-url'),
        data: {
          ajax: 'render-onboarding-item-details',
          onboarding_item_id: intOnboardingItemId
        },
        dataType: 'json',
        success: function (data)
        {
          if ((typeof data['description']) !== 'undefined' && data !== null) {
            var remove_logo = '&#x2716;';
            var objRow = $(objElement).closest('tr');
            
            objRow.find('.description').text(data['description']);
            objRow.find('.departmentOwner').text(data['department_owner']);
            objRow.find('.isManagerial').text(data['is_managerial']);
            objRow.find('.isOffboardingItem').text(data['is_offboarding_item']);
            objRow.find('span.removeOnboardingTabItemButton').html(remove_logo);
          }
        }
      });
    }
  }

  function _append_new_onboarding_checklist_item(objElement, objEvent) {
    var dataTable = $('#data_table');

    var appendRow = $('tr.appendOnboardingTabItemTr');
    
    console.log(appendRow);
    //deciding to put list_even or list_odd for the front end
    var counter = $('#onboardingTabHiddenVal').val();
    counter++;
    $('#onboardingTabHiddenVal').val(counter);
    var numberAfterModulus = counter % 2;

    if (numberAfterModulus == 1) {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedOnboardingTabItemTr list_even').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended onboardingTabItemDropdown ' + counter);
    } else {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedOnboardingTabItemTr list_odd').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended onboardingTabItemDropdown ' + counter);
    }

    // need to reinitiate the dropdown for onboarding title and the remove button after appending
    Project.initOnboardingItemDropdown();
    Project.initRemoveOnboardingChecklistItem();
  }

  function _remove_onboarding_checklist_item_row(objElement, objEvent) {
    var rowToBeRemoved = $(objElement).closest('tr');
    $(rowToBeRemoved).remove();
    $('.updateTemplateButton').prop('disabled', false);

    var counter = parseInt($('#onboardingTabHiddenVal').val());
    counter--;
    $('#onboardingTabHiddenVal').val(counter);
  }

  function _initOnboardingInputBoxes() {
    $('input#templateTitle').unbind('keypress').keypress(function (objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initOnboardingTextArea() {
    $('textarea#templateDescription').unbind('keypress').keypress(function (objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initOnboardingItemDropdown() {
    $('select[class="selectItemTitle"]').unbind('change').change(function (objEvent) {
      Project.render_onboarding_item_details(this, objEvent);
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initAppendNewOnboardingChecklistItem() {
    $(':button#appendOnboardingTabItem').unbind('click').click(function (objEvent) {
      Project.append_new_onboarding_checklist_item(this, objEvent);
    });
  }

  function _initRemoveOnboardingChecklistItem() {
    $('td.removeOnboardingTabItemButton a').unbind('click').click(function (objEvent) {
      Project.remove_onboarding_checklist_item_row(this, objEvent);

    });
  }

  //end js codes for assigning onboarding items for new hirees

  //start js codes for assigning training items for new hirees
  function _render_training_item_details(objElement, objEvent) {
    if ($(objElement).val() != '') {
      var intTrainingItemId = $(objElement).find(":selected").val();
      $.ajax({
        type: 'post',
        url: $(objElement).attr('data-render-url'),
        data: {
          ajax: 'trainingTemplateForm',
          training_item_id: intTrainingItemId
        },
        dataType: 'json',
        success: function (data)
        {
          if ((typeof data['description']) !== 'undefined' && data !== null) {
            var description = data['description'];
            var responsibility = data['responsibility'];
            var remove_logo = '&#x2716;';
            var objRow = $(objElement).closest('tr');
            objRow.find('.itemDescription').text(description);
            objRow.find('.itemResponsibility').text(responsibility);
            objRow.find('span.removeItemButton').html(remove_logo);
          }
        }
      });
    }
  }

  function _append_new_training_item(objElement, objEvent) {
    var dataTable = $('#data_table');

    var appendRow = $('tr.appendItemTr');

    //deciding to put list_even or list_odd for the front end
    var counter = parseInt($('#hiddenVal').val());
    counter++;
    $('#hiddenVal').val(counter);
    var numberAfterModulus = counter % 2;

    if (numberAfterModulus == 1) {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedItemTr list_even').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended itemDropdown ' + counter);
    } else {
      var clonedRow = $(appendRow).clone().attr('class', 'appendedItemTr list_odd').show().appendTo(dataTable);
      $(clonedRow).find('.selectItemTitle').attr('name', 'appended itemDropdown ' + counter);
    }

    // need to reinitiate the dropdown for training title and the remove button after appending
    Project.initTrainingItemDropdown();
    Project.initRemoveTrainingItem();
  }

  function _remove_training_item_row(objElement, objEvent) {
    var rowToBeRemoved = $(objElement).closest('tr');
    $(rowToBeRemoved).remove();

    var counter = parseInt($('#hiddenVal').val());

    counter--;
    $('#hiddenVal').val(counter);
  }

  function _initTrainingItemDropdown() {
    $('select[class="selectItemTitle"]').unbind('change').change(function (objEvent) {
      Project.render_training_item_details(this, objEvent);
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initTrainingInputBoxes() {
    $('input.inputBoxes').unbind('keypress').keypress(function (objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

  function _initTrainingTextArea() {
    $('textarea#templateDescription').unbind('keypress').keypress(function (objEvent) {
      $('.updateTemplateButton').prop('disabled', false);
    });
  }

//  function _initAppendNewTrainingItem() {
//    $(':button#appendItem').unbind('click').click(function (objEvent) {
//      Project.append_new_training_item(this, objEvent);
//    });
//  }

  function _initRemoveTrainingItem() {
    $('td.removeItemButton a').unbind('click').click(function (objEvent) {
      Project.remove_training_item_row(this, objEvent);
    });
  }

  //end assigning training items for new hirees

  function _openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";

    Project.initAppendNewOnboardingChecklistItem();
  }

  function _init() {
    $(function () {

      Project.logout();
      Project.change_theme();
      Project.set_grid();
      Project.submit_form();
      Project.reset_form();
      Project.submit_page();
      Project.popup_coming_soon();
      Project.init_enter_submit();
      Project.init_scroller();
      Project.init_common_button();
      Project.init_flash_error();
      Project.init_flash_alert();
      Project.init_leftnav_iframe_link();
      Project.filter_results();

      Project.initOnboardingItemDropdown();
      Project.initAppendNewOnboardingChecklistItem();
      Project.initRemoveOnboardingChecklistItem();
      Project.initOnboardingTextArea();
      Project.initOnboardingInputBoxes();

      Project.initTrainingItemDropdown();
//      Project.initAppendNewTrainingItem();
      Project.initRemoveTrainingItem();
      Project.initTrainingInputBoxes();
      Project.initTrainingTextArea();
    });
  }

  return {
    init_enter_submit: _init_enter_submit,
    init_scroller: _init_scroller,
    init_common_button: _init_common_button,
    init_flash_error: _init_flash_error,
    init_flash_alert: _init_flash_alert,
    init_leftnav_iframe_link: _init_leftnav_iframe_link,
    logout: _logout,
    change_theme: _change_theme,
    set_leftnav_active_item: _set_leftnav_active_item,
    set_grid: _set_grid,
    switch_button_theme: _switch_button_theme,
    popup_error: _popup_error,
    popup_msg: _popup_msg,
    popup_alert: _popup_alert,
    popup_coming_soon: _popup_coming_soon,
    popup_fancybox: _popup_fancybox,
    popup_ajax_error: _popup_ajax_error,
    proceed_submit_page: _proceed_submit_page,
    submit_page: _submit_page,
    submit_form: _submit_form,
    reset_form: _reset_form,
    show_loading: _show_loading,
    hide_loading: _hide_loading,
    copy_code: _copy_code,
    onload_iframe: _onload_iframe,
    init: _init,
    filter_results: _filter_results,

    initOnboardingItemDropdown: _initOnboardingItemDropdown,
    initAppendNewOnboardingChecklistItem: _initAppendNewOnboardingChecklistItem,
    initRemoveOnboardingChecklistItem: _initRemoveOnboardingChecklistItem,
    initOnboardingInputBoxes: _initOnboardingInputBoxes,
    initOnboardingTextArea: _initOnboardingTextArea,
    render_onboarding_item_details: _render_onboarding_item_details,
    append_new_onboarding_checklist_item: _append_new_onboarding_checklist_item,
    remove_onboarding_checklist_item_row: _remove_onboarding_checklist_item_row,

    initTrainingItemDropdown: _initTrainingItemDropdown,
//    initAppendNewTrainingItem: _initAppendNewTrainingItem,
    initRemoveTrainingItem: _initRemoveTrainingItem,
    initTrainingInputBoxes: _initTrainingInputBoxes,
    initTrainingTextArea: _initTrainingTextArea,
    render_training_item_details: _render_training_item_details,
    append_new_training_item: _append_new_training_item,
    remove_training_item_row: _remove_training_item_row,

    openTab: _openTab

  }
}();
Project.init();
/*** End: Project Section */