<?php 

//output the content header
echo PageHelper::printFormListingHeader($pageType);

//output the body content
echo PageHelper::printFormListingBody($pageType, $strSortKey, true, $onboardingItemsArr, false, false);

if(isset($onboardingItemsArr[0])){		
	echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/pagination.php', array('objPagination' => $objPagination));
} // - end: if 
?>

</form>
</div>
</div>

<?php 
//output the alert message
echo PageHelper::printFormListingAlertMessage($pageType); 
?>