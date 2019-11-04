<?php 
class PageHelper {

	public static function printContentListingHeader($pageType){

		$pageData = PageEnum::PAGE_DATA[$pageType];

		$contentHeader = '<div class="breadcrumb">';
		$contentHeader .= '<div class="breadcrumb_wrapper">';
		$contentHeader .= '<div class="breadcrumb-top">' . $pageData['breadcrumb-top'] . '</div>';
		$contentHeader .= '<div class="breadcrumb-bottom ' . $pageData['breadcrumb-bottom'] . '">';
		$contentHeader .= '<div class="title">';
		$contentHeader .= '<span>' . $pageData['page-title'] . '</span>';
		$contentHeader .= '</div>';
		$contentHeader .= '</div>';
		$contentHeader .= '</div>';
		$contentHeader .= '</div>';

		return $contentHeader;
	}

	public static function printViewAllBody($pageType, $strSortKey){
		switch($pageType){
			case DepartmentEnum::DEPARTMENT:
				$pageAction = 'admin/showAllDepartments';
				$widgetTitle = Yii::t('app', 'Departments List');
				$addNewItemAction = 'addNewDepartment';
				$addNewItemButton = Yii::t('app', 'Add New Department');
				$hiddenFieldTableList = CHtml::hiddenField('mode', 'department-list');
				$hiddenFieldSortKey = CHtml::hiddenField('sort_key', $strSortKey);
				$departmentTitle = Yii::t('app', 'Department');
				$departmentDescription = Yii::t('app', 'Description');
				$columnTitles = [$departmentTitle, $departmentDescription];
				// $strSortKeys = ['sort_department_desc', 'sort_department_asc', 'sort_department_description_desc', 'sort_department_description_asc'];
			break;

		}
		
		echo "
			<h4 class=\"widget_title\">$widgetTitle
				<a href=\"$addNewItemAction\">
					<input type=\"button\" value=\"$addNewItemButton\">
				</a>
			</h4>
			$hiddenFieldTableList
			$hiddenFieldSortKey
			<table class=\"widget_table grid\">
				<thead>
					<tr>
		";
// var_dump($strSortKey);exit;
		foreach($columnTitles as $columnTitle){
			// foreach($strSortKeys as $strSortKey){
			if($strSortKey === $columnTitle . '_desc'){ 
				$sort = 'desc'; 
			}elseif($strSortKey === $columnTitle . '_asc'){
			  $sort = 'asc'; 
			}

			echo "<th>
				<div class=\"btnAjaxSortList sort_wrapper$sort\" rel=\"sort\" rev=\"$strSortKey\">
					<a title=\"Sort;\" href=\"javascript:void(0);\">
					<div class=\"sort_wrapper_inner\">
						<div class=\"sort_label_wrapper\">
							<div class=\"sort_label\">
								$columnTitle
							</div>
						</div>
						<div class=\"sort_icon_wrapper\">
							<div class=\"sort_icon\">&nbsp;</div>
						</div>
					</div>
				</div>
			</th>";
			// }
		}

		echo "
					</tr>
				</thead>
			</table>";

	}
}