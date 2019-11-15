<?php 
class PageHelper {

	public static function printFormListingHeader($pageType){

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

	public static function printFormListingBody($pageType, $strSortKey, $deleteColumn = true, $dataObjects = null, $validateForeignKeyExist = false, $queryFunction){

		//get predefined formData
		$formData = PageEnum::FORM_DATA[$pageType];

		//prepare variable for use later
		$formId = $formData['form-id'];
		$formUrlShowAll = Yii::app()->createUrl($formData['form-action-show-all']);
		$formTitle = Yii::t('app', $formData['form-title']);
		$formUrlAddNew = Yii::app()->createUrl($formData['form-action-add-new']);
		$addNewButtonLabel = Yii::t('app', $formData['add-new-record-title']);
		$filterResults = Yii::t('app', 'Filter results');

		//format the form body response
		$contentBody = '<div class="common_content_wrapper">';
		$contentBody .= '<div class="common_content_inner_wrapper">';
		//beginWidget can only work in viewpage, so have to build regular html form
		$contentBody .= '<form method="post" enctype="multipart/form-data" id="' . $formId . '" action="' . $formUrlShowAll . '">';

		$contentBody .= '<h4 class="widget_title">' . $formTitle;
		$contentBody .= '<input type="text" value="" placeholder="' . $filterResults . '" name="label_filter" id="label_filter" style="width:30%"/>';
		$contentBody .= '<a href="' . $formUrlAddNew . '">';
		$contentBody .= '<input type="button" value="' . $addNewButtonLabel . '">';
		$contentBody .= '</a>';
		$contentBody .= '</h4>';
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
		$contentBody .= self::prepareTableData($pageType, $dataObjects, $deleteColumn, $validateForeignKeyExist, $queryFunction);

		$contentBody .= '</table>';
		$contentBody .= '</form>';

		$contentBody .= '</div>';
		$contentBody .= '</div>';

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
			$deleteColumnHeader .= '<input type="button" title="' . $deleteButtonTitle . '" id="delete' . $entityName . 'Button" value="Delete selected entries" data-delete-url="' . $formUrlDeleteSelected . '">';
			//hidden url to check whether the chosen record to be deleted has any foreign key dependencies
			//e.g deleting department, but there are still admins belonging to that department
			//$deleteColumnHeader .= '<input type="button" title="' . $deleteButtonTitle . '" id="delete' . $entityName . 'Button" value="Delete selected entries" data-delete-url="' . $formUrlDeleteSelected . '">';
			$deleteColumnHeader .= '</div>';
			$deleteColumnHeader .= '</div>';
			$deleteColumnHeader .= '</div>';
			$deleteColumnHeader .= '</th>';
		}

		return $deleteColumnHeader;
	}

	private static function prepareTableData($pageType, $dataObjects, $deleteColumn, $validateForeignKeyExist, $queryFunction) {

		//get predefined formData
		$formData = PageEnum::FORM_DATA[$pageType];

		//prepare variable for use later
		$columnLinkToDetails = $formData['column-link-to-details'];
		$columnDetails = $formData['column-details'];
		$dataUrlTag = '';
		$foreignKeyCheckUrl = '';
		$msgForeignKeyId = $formData['msg-foreign-key-id'];
		$msgForeignKey = $formData['msg-foreign-key'];
		$model = $formData['model'];
		// $queryDetails = $dataObject->attributes[$formData['column-details-query']];

		if ($validateForeignKeyExist == true) {
			$dataUrlTag = $formData['data-url'];
			$foreignKeyCheckUrl = Yii::app()->createUrl($formData['foreign-key-check']);
		}

		// format the body of the table response here
		$tableBody = "";
		$tableBody .= '<tbody id="data_table">';
		foreach ($dataObjects as $dataObject) {
			$formUrlViewSelected = Yii::app()->createUrl($formData['form-action-view-selected'], ["id" => $dataObject->id]);

			//TODO : find out what is the actual data structure of the table body
			$tableBody .= '<tr>';

			//set the first column as hyperlink, this shall always be the name/title or anything that is prominent to this entity
			if (isset($columnLinkToDetails)) {
				$tableBody .= '<td>';
				$tableBody .= '<a href="' . $formUrlViewSelected . '">';
				$tableBody .= $dataObject->attributes[$columnLinkToDetails];	
				$tableBody .= '</a>';
				$tableBody .= '</td>';
			}

			//all the subsequent column will be looped here
			foreach($columnDetails as $columnDetail){
				$tableBody .= '<td>';
				$tableBody .= $dataObject->attributes[$columnDetail];	
				$tableBody .= '</td>';
			}

			$columnDetailsQuery = $formData['column-details-query'];
			if($queryFunction == true){
				$variable = 'queryForOfferLetterIsManagerial';
				$tableBody .= '<td>';
				$tableBody .= $formData['column-details-example']::model()->{$formData['model-query-functions']}($dataObject->id);
				$tableBody .= '</td>';
			}

			//add in the checkbox for the delete
			if ($deleteColumn == true) {
				$tableBody .= '<td>';
				$formUrlViewSelected = Yii::app()->createUrl($formData['foreign-key-check'], ["id" => $dataObject->id]);
				//check for existing users belonging to this department
				$tableBody .= '<input ' . $dataUrlTag . $foreignKeyCheckUrl . ' type="checkbox" name="deleteCheckBox[]" id="deleteCheckBox' . $dataObject->id . '" class="deleteCheckBox"' . 'value="' . $dataObject->id .'">';
				if($validateForeignKeyExist == true){
					//alert message to show there is a foreign key conflict when attempting to delete row
					$tableBody .= '<div class="' . $msgForeignKeyId . '" style="display:none;">' . $msgForeignKey;
					$tableBody .= '</div>';
				}
				$tableBody .= '</td>';
			}
			$tableBody .= '</tr>';
		}
		$tableBody .= '</tbody>';

		return $tableBody;
	}

	public static function printFormListingAlertMessage($pageType){

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

}
