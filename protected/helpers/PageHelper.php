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

	public static function printFormListingBody($pageType, $strSortKey, $deleteColumn = true, $dataObjects = null){

		//get predefined formData
		$formData = PageEnum::FORM_DATA[$pageType];

		//prepare variable for use later
		// $CApplication = new CApplication();
		// $yiiBase = new CBaseController();
		$yiiBase = new YiiBase();
		$formId = $formData['form-id'];
		// $formUrlShowAll = $CApplication::createUrl($formData['form-action-show-all']);
		$formUrlShowAll = Yii::app()->createUrl($formData['form-action-show-all']);
		$formTitle = Yii::t('app', $formData['form-title']);
		$formUrlAddNew = Yii::app()->createUrl($formData['form-action-add-new']);
		// $formUrlViewSelected = $CApplication::createUrl($formData['form-action-view-selected']);
		$addNewButtonLabel = Yii::t('app', $formData['add-new-record-title']);
		$hiddenFieldMode = $formData['hidden-field-mode'];
		$tableHeaders = $formData['table-header'];
		$sort = Yii::t('app', 'Sort');
		$entityName = $formData['entity-name'];

		//format the form body response
		$contentBody = '<div class="common_content_wrapper">';
		$contentBody .= '<div class="common_content_inner_wrapper">';
		//beginWidget can only work in viewpage, so have to build regular html form
		// $contentBody .= (new CController())->beginWidget('CActiveForm', array('id'=>$formId, 'action'=>$formUrlShowAll, 'enableAjaxValidation'=>false));
		$contentBody .= '<form method="post" enctype="multipart/form-data" id="' . $formId . '" action="' . $formUrlShowAll . '">';

		$contentBody .= '<h4 class="widget_title">' . $formTitle;
		$contentBody .= '<a href="' . $formUrlAddNew . '">';
		$contentBody .= '<input type="button" value="' . $addNewButtonLabel . '"';
		$contentBody .= '</a>';
		$contentBody .= '</h4>';
		$contentBody .= CHtml::hiddenField('mode', $hiddenFieldMode);
		$contentBody .= CHtml::hiddenField('sort_key', $strSortKey);
		$contentBody .= '<table class="widget_table grid">';
		$contentBody .= '<thead>';
		$contentBody .= '<tr>';

		//format the table header
		$headerTitle = "";
		foreach ($tableHeaders as $tableHeader) {
			
			//prepare variable for use later
			$headerName = strtolower($tableHeader);
			$sortResult = self::getSortKeyOrder($strSortKey, $headerName);
			$headerTitle = Yii::t('app', $tableHeader);

			$headerTitle .= '<th>';
			$headerTitle .= '<div class="btnAjaxSortList sort_wrapper ' . $sortResult . '" rel="sort" rev="sort_' . $headerName . '">';
			$headerTitle .= '<a title="' . $sort . '" href="javascript:void(0);">';
			$headerTitle .= '<div class="sort_wrapper_inner">';
			$headerTitle .= '<div class="sort_label_wrapper">';

			$headerTitle .= '<div class="sort_label">';
			$headerTitle .= $tableHeader;
			$headerTitle .= '</div>';
			$headerTitle .= '<div class="sort_icon_wrapper">';
			$headerTitle .= '<div class="sort_icon">&nbsp;';
			$headerTitle .= '</div>';

			$headerTitle .= '</div>';
			$headerTitle .= '</div>';
			$headerTitle .= '</div>';
			$headerTitle .= '</th>';
		}
		$contentBody .= $headerTitle;

		// var_dump($headerTitle);exit;

		//create a delete checkbox column if required
		if ($deleteColumn == true) {

			$deleteButtonTitle = Yii::t('app', 'Delete this entry');
			$formUrlDeleteSelected = Yii::app()->createUrl($formData['form-action-delete-selected']);

			$deleteColumnHeader = '<th>';
			$deleteColumnHeader .= '<div class="sort_wrapper_inner">';
			$deleteColumnHeader .= '<div class="sort_label_wrapper">';
			$deleteColumnHeader .= '<div class="sort_label">';
			$deleteColumnHeader .= '<input type="button" title="' . $deleteButtonTitle . '" id="delete' . $entityName . 'Button" value="Delete selected entries" data-delete-url="' . $formUrlDeleteSelected . '">';
			$deleteColumnHeader .= '</div>';
			$deleteColumnHeader .= '</div>';
			$deleteColumnHeader .= '</div>';
			$deleteColumnHeader .= '</th>';
		}
		$contentBody .= $deleteColumnHeader;
		$contentBody .= '</tr>';

		//format the body of the table to output the listing
		// foreach ($dataObjects as $intIndex=>$dataObject) {
		// 	$dataArray = (array) $dataObject;

		// 	//TODO : find out what is the actual data structure of the table body
		// 	$tableBody = '<tbody id="data_table">';
		// 	$tableBody .= '<tr>';
		// 	$tableBody .= '<td>';
		// 	$tableBody .= '<a href="' . Yii::app()->createUrl($formData['form-action-view-selected'], ['id' => $dataObject->id]) . '">';
		// 	$tableBody .= $dataObject->title;	
		// 	$tableBody .= '</a>';
		// 	$tableBody .= '</td>';
		// 	$tableBody .= '<td>';
		// 	$tableBody .= '<input type="checkbox" name="deleteCheckBox[]" class="deleteCheckBox"' . 'value="' . $dataObject->id;
		// 	$tableBody .= '</td>';
		// 	$tableBody .= '</tr>';
		// 	$tableBody .= '</tbody>';
		// }
		// $contentBody .= $tableBody;
		// $contentBody .= '</table>';

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
			$result = "asc";
		} else if ($sortKey === $columnAsc) {
			$result = "desc";
		}

		return $result;
	}

}
