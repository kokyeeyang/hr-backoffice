<?php

class PageHelper {

    public static function printFormListingHeader($pageType) {

	//get predefined formData
	$formData = PageEnum::FORM_DATA[$pageType];
	//prepare variable for use later
	$breadcrumbTop = $formData['breadcrumb-top'];
	$breadcrumbBottom = $formData['breadcrumb-bottom'];
	$formTitle = $formData['form-title'];

	//format the form header response
	$formHeader = '<div class="breadcrumb">';
	$formHeader .= '<div class="breadcrumb_wrapper">';
	$formHeader .= '<div class="breadcrumb-top">' . $breadcrumbTop . '</div>';
	$formHeader .= '<div class="breadcrumb-bottom ' . $breadcrumbBottom . '">';
	$formHeader .= '<div class="title">';
	$formHeader .= '<span>' . $formTitle . '</span>';
	$formHeader .= '</div>';
	$formHeader .= '</div>';
	$formHeader .= '</div>';
	$formHeader .= '</div>';

	return $formHeader;
    }

    public static function printFormListingBody($pageType, $strSortKey, $deleteColumn = true, $dataObjects = null, $validateForeignKeyExist = false, $enableButton = false) {

	//get predefined formData
	$formData = PageEnum::FORM_DATA[$pageType];

	//prepare variable for use later
	$formId = $formData['form-id'];
	$formUrlShowAll = Yii::app()->createUrl($formData['form-action-show-all']);

	//format the form body response
	$contentBody = '<div class="common_content_wrapper">';
	$contentBody .= '<div class="common_content_inner_wrapper">';
	//beginWidget can only work in viewpage, so have to build regular html form
	$contentBody .= '<form method="post" enctype="multipart/form-data" id="' . $formId . '" action="' . $formUrlShowAll . '">';

	$contentBody .= self::prepareWidgetTitle($formData);
	$contentBody .= CHtml::hiddenField('mode', $formId);
	$contentBody .= CHtml::hiddenField('sort_key', $strSortKey);

	//format table header with the form
	$contentBody .= '<table class="widget_table grid">';
	$contentBody .= '<thead>';
	$contentBody .= '<tr>';
	$contentBody .= self::prepareTableHeader($pageType, $strSortKey);
	$contentBody .= self::prepareTableHeaderDelete($pageType, $deleteColumn);
	$contentBody .= '</tr>';
	$contentBody .= '</thead>';

	// format the body of the table to output the listing
	$contentBody .= self::prepareTableData($pageType, $dataObjects, $deleteColumn, $validateForeignKeyExist, $enableButton);

	$contentBody .= '</table>';

	return $contentBody;
    }

    /**
      get sort key which will return either the 3 asc/desc/""
     */
    private static function getSortKeyOrder($sortKey, $headerName) {
	//prepare the columnName
	$columnName = "sort_$headerName";
	$columnAsc = $columnName . "_asc";
	$columnDesc = $columnName . "_desc";
	$result = "";

	//check if the current headerName matching the current sortKey
	if ($sortKey === $columnAsc) {
	    $result = 'asc';
	} else if ($sortKey === $columnDesc) {
	    $result = 'desc';
	}

	return $result;
    }

    private static function prepareTableHeader($pageType, $strSortKey) {
	//get predefined formData
	$formData = PageEnum::FORM_DATA[$pageType];

	//prepare variable for use later
	$tableHeaders = $formData['table-header'];
	$sort = Yii::t('app', 'Sort');

	//format the table header
	$headerTitle = "";
	$headerTitle .= '<tr>';
	foreach ($tableHeaders as $tableHeader) {
	    //prepare variable for use later
	    $headerName = strtolower($tableHeader);
	    $tableHeaderAfterStrReplace = str_replace("_", " ", $headerName);
	    $columnTitle = Yii::t('app', $tableHeaderAfterStrReplace);
	    $sortResult = self::getSortKeyOrder($strSortKey, $headerName);

	    //format the header response here
	    $headerTitle .= '<th>';
	    $headerTitle .= '<div class="btnAjaxSortList sort_wrapper ' . $sortResult . '" rel="sort" rev="sort_' . $headerName . '">';
	    $headerTitle .= '<a title="' . $sort . '" href="javascript:void(0);">';
	    $headerTitle .= '<div class="sort_wrapper_inner">';
	    $headerTitle .= '<div class="sort_label_wrapper">';

	    $headerTitle .= '<div class="sort_label">';
	    $headerTitle .= $columnTitle;
	    $headerTitle .= '</div>';
	    $headerTitle .= '<div class="sort_icon_wrapper">';
	    $headerTitle .= '<div class="sort_icon">&nbsp;';
	    $headerTitle .= '</div>';

	    $headerTitle .= '</div>';
	    $headerTitle .= '</div>';
	    $headerTitle .= '</div>';
	    $headerTitle .= '</th>';
	}

	return $headerTitle;
    }

    private static function prepareWidgetTitle($formData) {

	//prepare variable for use later
	$formUrlAddNew = Yii::app()->createUrl($formData['form-action-add-new']);
	$addNewButtonLabel = Yii::t('app', $formData['add-new-record-title']);
	$inputBoxValue = isset($_POST['label_filter']) ? $_POST['label_filter'] : '';
	$filterResults = Yii::t('app', 'Filter results');

	$contentBody = '<h4 class="widget_title">';
	$contentBody .= '<input type="text" value="' . $inputBoxValue . '" placeholder="' . $filterResults . '" name="label_filter" id="label_filter" style="width:30%"/>';
	$contentBody .= '<a href="' . $formUrlAddNew . '">';
	//testing for filtering function, to resubmit show all function
//        $contentBody .= '';

	$contentBody .= '<input type="button" value="' . $addNewButtonLabel . '" class="addNewButton" name="addNewButton">';
	$contentBody .= '</a>';
	$contentBody .= '</h4>';

	return $contentBody;
    }

    private static function prepareTableHeaderDelete($pageType, $deleteColumn) {

	//get predefined formData
	$formData = PageEnum::FORM_DATA[$pageType];

	//prepare variable for use later
	$entityName = $formData['entity-name'];

	//create a delete checkbox column if required
	$deleteColumnHeader = "";
	if ($deleteColumn == true) {

	    $deleteButtonTitle = Yii::t('app', 'Delete this entry');
	    $formUrlDeleteSelected = Yii::app()->createUrl($formData['form-action-delete-selected']);

	    //format the delete header response here
	    $deleteColumnHeader = '<th>';
	    $deleteColumnHeader .= '<div class="sort_wrapper_inner">';
	    $deleteColumnHeader .= '<div class="sort_label_wrapper">';
	    $deleteColumnHeader .= '<div class="sort_label">';
	    $deleteColumnHeader .= '<input type="button" title="' . $deleteButtonTitle . '" id="delete' . $entityName . 'Button" value="Delete" data-delete-url="' . $formUrlDeleteSelected . '" class="deleteButton" name="deleteButton">';
	    $deleteColumnHeader .= '</div>';
	    $deleteColumnHeader .= '</div>';
	    $deleteColumnHeader .= '</div>';
	    $deleteColumnHeader .= '</th>';
	}

	return $deleteColumnHeader;
    }

    private static function prepareTableData($pageType, $dataObjects, $deleteColumn, $validateForeignKeyExist, $enableButton) {

	//get predefined formData
	$formData = PageEnum::FORM_DATA[$pageType];

	//prepare variable for use later
	$columnLinkToDetails = $formData['column-link-to-details'];
	$columnDetails = $formData['column-details'];
	$dataUrlTag = '';
	$foreignKeyCheckUrl = '';

	if ($validateForeignKeyExist == true) {
	    $dataUrlTag = $formData['data-url'];
	    $foreignKeyCheckUrl = Yii::app()->createUrl($formData['foreign-key-check']);
	}

	// format the body of the table response here
	$tableBody = "";
	$tableBody .= '<tbody id="data_table">';


	if ($dataObjects != '') {
	    foreach ($dataObjects as $dataObject) {
		$formUrlViewSelected = Yii::app()->createUrl($formData['form-action-view-selected'], ["id" => $dataObject["id"]]);

		//TODO : find out what is the actual data structure of the table body
		$tableBody .= '<tr>';

		//set the first column as hyperlink, this shall always be the name/title or anything that is prominent to this entity
		//in short, anything that can be clicked to view more
		if ($columnLinkToDetails != false) {
		    $tableBody .= '<td>';
		    $tableBody .= '<a href="' . $formUrlViewSelected . '">';
		    $tableBody .= $dataObject[$columnLinkToDetails];
		    $tableBody .= '</a>';
		    $tableBody .= '</td>';
		}

		//all the subsequent column will be looped here
		foreach ($columnDetails as $columnDetail) {
		    $tableBody .= '<td>';
		    $tableBody .= $dataObject[$columnDetail];
		    $tableBody .= '</td>';
		}

		if ($enableButton === true) {
		    $tableBody .= self::prepareEnableButton($formData, $dataObject);
		}

		//add in the checkbox for the delete
		if ($deleteColumn === true) {
		    $tableBody .= self::prepareDeleteCheckbox($formData, $dataObject, $dataUrlTag, $foreignKeyCheckUrl);
		}
		$tableBody .= '</tr>';
	    }
	}

	$tableBody .= '</tbody>';

	return $tableBody;
    }

    private static function prepareEnableButton($formData, $dataObject) {

	$emailVariables = $formData['data-email-details'];
	$clickableButtonTitle = $formData['clickable-button-title'];
	$buttonVariables = [];
	$tableBody = '<td>';

	foreach ($emailVariables as $emailVariable) {
	    $buttonVariables[$emailVariable] = $dataObject[$emailVariable];
	}

	$tableBody .= '<input type="button" class="' . $formData['send-email-button-id'] . '" ' . $formData['data-email-url-tag']
	    . Yii::app()->createUrl($formData['data-email-url'], $buttonVariables) . ' value="' . $clickableButtonTitle . '" name="' . $formData['send-email-button-id'] . '">';
	$tableBody .= '</td>';

	return $tableBody;
    }

    private static function prepareDeleteCheckbox($formData, $dataObject, $dataUrlTag, $foreignKeyCheckUrl) {

	$tableBody = '<td>';
	$tableBody .= '<input data-url="' . $foreignKeyCheckUrl . '" type="checkbox" name="deleteCheckBox[]" id="deleteCheckBox' . $dataObject['id'] . '" class="deleteCheckBox"' . 'value="' . $dataObject['id'] . '">';
	$tableBody .= '</td>';

	return $tableBody;
    }

    public static function printFormListingAlertMessage($pageType) {

	//get predefined formData
	$formData = PageEnum::FORM_DATA[$pageType];

	//prepare variable for use later
	$alertDataMessages = $formData["alert-data-msg"];

	// format the alert message available
	$alertMessage = "";
	foreach ($alertDataMessages as $dataKey => $dataValue) {
	    $message = Yii::t('app', $dataValue);

	    $alertMessage .= '<div id="registration-common-msg">';
	    $alertMessage .= '<div id="' . $dataKey . '" data-msg="' . $message . '">';
	    $alertMessage .= '</div>';
	    $alertMessage .= '</div>';
	}

	return $alertMessage;
    }

    //printing out items inside onboarding and training templates
    //can also be used for viewing, adding onboarding and training items for employees
    public static function printTemplateItems($pageType, $dataObjects, $dropdownItemTitles) {
	
	//prepare variables for use later
	$formData = PageEnum::FORM_DATA[$pageType];
	$tableHeaders = $formData['table-header'];
	$columnDetails = $formData['column-details'];
//	isset($dataObjects) && $dataObjects != null ? $hiddenVal = count($dataObjects) : $hiddenVal = 0;
	if(isset($dataObjects) && $dataObjects != null){
	    $hiddenVal = count($dataObjects);
	    $disabledStatus = 'disabled';
	} else if (!isset($dataObjects) || $dataObjects == null){
	    $hiddenVal = 0;
	    $disabledStatus = '';
	}
	
	$tableBody = '<table class="widget_table grid">';
	$tableBody .= '<thead>';
	$tableBody .= '<tr>';
	$tableBody .= self::prepareTableHeaderForTemplateItems($tableHeaders);
	$tableBody .= '</tr>';
	$tableBody .= '</thead>';
	$tableBody .= '<tbody id="' . lcfirst($pageType) . '_data_table">';
	$tableBody .= '<input type="hidden" id="' . lcfirst($pageType) . 'HiddenVal" value="' . $hiddenVal . '" />';
	$tableBody .= self::prepareTableDataForTemplateItems($dataObjects, $columnDetails, $dropdownItemTitles, $pageType);
	$tableBody .= '</tbody>';
	$tableBody .= '</table>';
	$tableBody .= '<button type="button" id="append' . $pageType . 'Item" title="Add more items to this list">+</button>';

	return $tableBody;
    }
    
    public static function prepareSaveButton($pageType, $saveUrl=null){
	return '<button title="Save" class="' . lcfirst($pageType) . 'SaveButton"' . $saveUrl . '> Save </button>';
    }

    private static function prepareTableHeaderForTemplateItems($tableHeaders) {
	$tableBody = "";
	foreach ($tableHeaders as $tableHeader) {
	    $tableBody .= '<th>';
	    $tableBody .= '<div class="sort_wrapper_inner">';
	    $tableBody .= '<div class="sort_label_wrapper">';
	    $tableBody .= '<div class="sort_label">';
	    //put table header here
	    $tableBody .= $tableHeader;
	    $tableBody .= '</div>';
	    $tableBody .= '</div>';
	    $tableBody .= '</div>';
	    $tableBody .= '</th>';
	}
	return $tableBody;
    }

    private static function prepareTableDataForTemplateItems($dataObjects, $columnDetails, $dropdownItemTitles, $pageType) {
	$tableBody = "";
	$ptn = "/_[a-z]?/";
	$counter = 0;

	if ($dataObjects != null && isset($dataObjects)) {
	    foreach ($dataObjects as $dataObject) {
		$counterAfterModulus = $counter % 2;
		if ($counterAfterModulus == 1) {
		    $lineDiff = ' list_odd';
		} else if ($counterAfterModulus == 0) {
		    $lineDiff = ' list_even';
		}
		$tableBody .= '<tr class="itemTr' . $lineDiff . '">';
		$tableBody .= self::prepareColumnDetails($columnDetails, $counter, $pageType, $dropdownItemTitles, $dataObject);
		$tableBody .= '<td class="remove' . $pageType . 'ItemButton">';
		$tableBody .= '<a href="#"><span class="remove' . $pageType . 'ItemButton" title="Remove this item">&#x2716;</span></a>';
		$tableBody .= '</td>';
		$tableBody .= '</tr>';
		$counter ++;
	    }

	}
	//class, name, id needs to be unique
	$tableBody .= '<tr class="append' . $pageType . 'ItemTr" style="display:none;">';
	$tableBody .= '<td class="item' . $pageType . 'Td">';
	$tableBody .= '<select name="append' . $pageType . 'ItemDropdown" size=1 class="' . lcfirst($pageType) . 'ItemDropdown" data-render-url="' . $_SERVER['PHP_SELF'] . '">';
	$tableBody .= '<option value="" selected>Choose here</option>';
	if ($dropdownItemTitles != null) {
	    foreach ($dropdownItemTitles as $dropdownItemTitle) {
		$tableBody .= '<option value="' . $dropdownItemTitle['id'] . '">';
		$tableBody .= $dropdownItemTitle['title'];
		$tableBody .= '</option>';
	    }
	}
	$tableBody .= '</select>';
	$tableBody .= '</td>';

	foreach ($columnDetails as $columnDetail) {
	    if ($columnDetail != 'item_title') {
		$tableBody .= '<td class="' . self::dashesToCamelCase($columnDetail) . '">';
		$tableBody .= '</td>';
	    }
	}

	$tableBody .= '<td class="remove' . $pageType . 'ItemButton">';
	$tableBody .= '<a href="#"><span class="remove' . $pageType . 'ItemButton" title="Remove this item"></span></a>';
	$tableBody .= '</td>';
	$tableBody .= '</tr>';

	return $tableBody;
    }

    private static function dashesToCamelCase($string, $capitalizeFirstCharacter = false) {

	$str = str_replace('_', '', ucwords($string, '_'));

	if (!$capitalizeFirstCharacter) {
	    $str = lcfirst($str);
	}

	return $str;
    }

    private static function prepareColumnDetails($columnDetails, $counter, $pageType, $dropdownItemTitles, $dataObject) {
	$tableBody = "";
	foreach ($columnDetails as $columnDetail) {
	    if ($columnDetail == 'item_title') {
		$tableBody .= '<td class="itemTd">';
		//we need to set a unique id or class for each onboarding and training tab
		$tableBody .= '<select name="' . lcfirst($pageType) . 'ItemDropdown ' . $counter . '" size=1 class="' . lcfirst($pageType) . 'ItemDropdown" data-render-url="' . $_SERVER['PHP_SELF'] . '">';
		$tableBody .= '<option value="">Choose here</option>';
		if ($dropdownItemTitles != null) {
		    foreach ($dropdownItemTitles as $dropdownItemTitle) {
			$dataObject[$columnDetail] === $dropdownItemTitle['title'] ? $selected = "selected" : $selected = '';
			$tableBody .= '<option value = "' . $dropdownItemTitle['id'] . '" ' . $selected . '>';
			$tableBody .= $dropdownItemTitle['title'];
			$tableBody .= '</option>';
		    }
		}
		$tableBody .= '</select>';
		$tableBody .= '</td>';
	    } else {
		$tableBody .= '<td class="' . self::dashesToCamelCase($columnDetail) . '">';
		$tableBody .= $dataObject[$columnDetail];
		$tableBody .= '</td>';
	    }
	}
	
	return $tableBody;
    }

}
