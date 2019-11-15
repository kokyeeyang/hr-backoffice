<?php 
//output the content header
echo PageHelper::printFormListingHeader($pageType);

echo PageHelper::printFormListingBody($pageType, $strSortKey, true, $offerLetterArr, false, true, false);

if(isset($offerLetterArr[0])){   
  echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/pagination.php', array('objPagination' => $objPagination));
} // - end: if 

//output the alert message
echo PageHelper::printFormListingAlertMessage($pageType); 

?>