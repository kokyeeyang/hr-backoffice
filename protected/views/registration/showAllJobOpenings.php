<?php 
//output the content header
echo PageHelper::printFormListingHeader($pageType);

//output the body content
echo PageHelper::printFormListingBody($pageType, $strSortKey, true, $arrRecords, true, false, true);

if(isset($arrRecords[0])){
	echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/pagination.php', array('objPagination' => $objPagination));
}// - end: if

//output the alert message
echo PageHelper::printFormListingAlertMessage($pageType); 

?>